<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['book'])) {
    $user_id = $_SESSION['user_id'];
    
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Validate and format dates
    $start_date = date('Y-m-d', strtotime($_POST['start_date']));
    $end_date = date('Y-m-d', strtotime($_POST['end_date']));
    
    // Validate dates are not invalid
    if($start_date === '1970-01-01' || $end_date === '1970-01-01') {
        die("Invalid date format");
    }
    
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);
    $package = (int)$_POST['package'];

    // Set amount based on package
    switch($package) {
        case 1:
            $amount = 400000;
            break;
        case 2:
            $amount = 200000;
            break;
        case 3:
            $amount = 90000;
            break;
        default:
            die("Invalid package selected");
    }

    $created_at = date('Y-m-d H:i:s');

    // Store booking data in session
    $_SESSION['booking_data'] = array(
        'name' => $name,
        'email' => $email,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'comments' => $comments,
        'amount' => $amount,
        'package' => $package,
        'created_at' => $created_at
    );

    header("Location: payment.php");
    exit();
}

if(isset($_POST['pay_now']) && isset($_SESSION['booking_data'])) {
    $user_id = $_SESSION['user_id'];
    $booking_data = $_SESSION['booking_data'];
    
    // Get form data
    $name = mysqli_real_escape_string($conn, $booking_data['name']);
    $email = mysqli_real_escape_string($conn, $booking_data['email']);
    $start_date = $booking_data['start_date'];
    $end_date = $booking_data['end_date'];
    $comments = mysqli_real_escape_string($conn, $booking_data['comments']);
    $package = $booking_data['package'];
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment']);
    $created_at = date('Y-m-d H:i:s');

    // Insert into booking table
    $sql = "INSERT INTO booking (UserID, name, email, EventStartDate, EventEndDate, PackageID, AdditionalRequest, status, CreatedAt) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isssssss", $user_id, $name, $email, $start_date, $end_date, $package, $comments, $created_at);
    
    if(mysqli_stmt_execute($stmt)) {
        $booking_id = mysqli_insert_id($conn);
        
        // Insert into payments table
        $payment_sql = "INSERT INTO payments (user_id, booking_id, amount, payment_status, payment_method, created_at) 
                       VALUES (?, ?, ?, 'success', ?, ?)";
        
        $payment_stmt = mysqli_prepare($conn, $payment_sql);
        $amount = $booking_data['amount'];
        mysqli_stmt_bind_param($payment_stmt, "iidss", $user_id, $booking_id, $amount, $payment_method, $created_at);
        
        if(mysqli_stmt_execute($payment_stmt)) {
            // Clear booking data from session
            unset($_SESSION['booking_data']);
            
            header("Location: success.php");
            exit();
        } else {
            echo "Error in payment: " . mysqli_error($conn);
        }
    } else {
        echo "Error in booking: " . mysqli_error($conn);
    }
}
?>