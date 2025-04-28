<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Store booking data in session when form is submitted from booking.php
if(isset($_POST['book'])) {
    $package = (int)$_POST['package'];
    
    // Calculate amount based on package
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

    // Validate and format dates
    $start_date = date('Y-m-d', strtotime($_POST['start_date']));
    $end_date = date('Y-m-d', strtotime($_POST['end_date']));
    
    // Validate dates are not invalid
    if($start_date === '1970-01-01' || $end_date === '1970-01-01') {
        die("Invalid date format");
    }

    $_SESSION['booking_data'] = [
        'user_id' => $_SESSION['user_id'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'start_date' => $start_date,
        'end_date' => $end_date,
        'package' => $package,
        'comments' => $_POST['comments'],
        'amount' => $amount
    ];
}

// Check if booking data exists in session
if (!isset($_SESSION['booking_data'])) {
    header("Location: booking.php");
    exit();
}

$booking_data = $_SESSION['booking_data'];

if(isset($_POST['pay_now'])) {
    $user_id = $_SESSION['user_id'];
    $created_at = date('Y-m-d H:i:s');
    
    // Validate dates again before inserting
    $start_date = date('Y-m-d', strtotime($booking_data['start_date']));
    $end_date = date('Y-m-d', strtotime($booking_data['end_date']));
    
    if($start_date === '1970-01-01' || $end_date === '1970-01-01') {
        die("Invalid date format");
    }
    
    // Insert into booking table
    $sql = "INSERT INTO booking (UserID, name, email, EventStartDate, EventEndDate, PackageID, AdditionalRequest, status, CreatedAt) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issssiss", 
        $user_id, 
        $booking_data['name'],
        $booking_data['email'],
        $start_date,
        $end_date,
        $booking_data['package'],
        $booking_data['comments'],
        $created_at
    );
    
    if(mysqli_stmt_execute($stmt)) {
        $booking_id = mysqli_insert_id($conn);
        
        // Insert into payments table
        $payment_sql = "INSERT INTO payments (user_id, booking_id, amount, payment_status, payment_method, created_at) VALUES (?, ?, ?, 'success', ?, ?)";
        
        $payment_stmt = mysqli_prepare($conn, $payment_sql);
        $payment_method = $_POST['payment'];
        mysqli_stmt_bind_param($payment_stmt, "iidss", 
            $user_id,
            $booking_id,
            $booking_data['amount'],
            $payment_method,
            $created_at
        );
        
        if(mysqli_stmt_execute($payment_stmt)) {
            // Clear booking data from session
            unset($_SESSION['booking_data']);
            
        // Redirect to confirmation page
        header("Location:./payment_confirmation.php");
            exit();
        } else {
            echo "Error in payment: " . mysqli_error($conn);
        }
    } else {
        echo "Error in booking: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            min-height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            padding: 30px;
            max-width: 600px;
            width: 100%;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .total {
            font-size: 1.5em;
            color: #e74c3c;
            font-weight: bold;
            margin: 20px 0;
        }

        .payment-options {
            margin-top: 30px;
            text-align: left;
        }

        .payment-option {
            display: flex;
            align-items: center;
            padding: 15px;
            margin: 10px 0;
            background: #f9f9f9;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .payment-option:hover {
            background: #e6e6e6;
        }

        .payment-option input[type="radio"] {
            margin-right: 10px;
        }

        .payment-option i {
            margin-right: 10px;
            color: #555;
        }

        .payment-details {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background: #f1f1f1;
            border-radius: 5px;
        }

        .payment-details input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 15px;
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 10px;
            font-size: 1.1em;
            transition: background 0.3s ease;
            margin-top: 20px;
        }

        button:hover {
            background: #218838;
        }

        .empty-cart {
            color: #888;
            font-size: 1.1em;
        }

        @media (max-width: 500px) {
            .container {
                padding: 20px;
            }
            h1 {
                font-size: 1.5em;
            }
            .total {
                font-size: 1.2em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-shopping-cart"></i> Payment Page</h1>
        <div class="total">Total Amount: ₹<?php echo number_format($booking_data['amount']); ?></div>
        
        <div class="payment-options">
            <h2>Select Payment Method</h2>

            <form id="payment-form" action="" method="POST">
                <div class="payment-option">
                    <input type="radio" name="payment" value="upi" id="upi-option">
                    <label for="upi-option"><i class="fas fa-mobile-alt"></i> UPI</label>
                </div>

                <div id="upi-input" class="payment-details">
                    <input type="text" id="upi-id" name="upi_id" placeholder="Enter UPI ID (e.g., name@upi)">
                </div>

                <div class="payment-option">
                    <input type="radio" name="payment" value="card" id="card-option">
                    <label for="card-option"><i class="fas fa-credit-card"></i> Credit/Debit Card</label>
                </div>

                <div id="card-input" class="payment-details">
                    <input type="text" name="card_number" placeholder="Card Number">
                    <input type="text" name="card_expiry" placeholder="MM/YY">
                    <input type="text" name="card_cvv" placeholder="CVV">
                </div>

                <div class="payment-option">
                    <input type="radio" name="payment" value="netbanking" id="netbanking-option">
                    <label for="netbanking-option"><i class="fas fa-university"></i> Net Banking</label>
                </div>

                <div id="netbanking-input" class="payment-details">
                    <select name="bank">
                        <option value="">Select Bank</option>
                        <option value="sbi">State Bank of India</option>
                        <option value="hdfc">HDFC Bank</option>
                        <option value="icici">ICICI Bank</option>
                    </select>
                </div>

                <div class="payment-option">
                    <input type="radio" name="payment" value="wallet" id="wallet-option">
                    <label for="wallet-option"><i class="fas fa-wallet"></i> Digital Wallet</label>
                </div>

                <div id="wallet-input" class="payment-details">
                    <select name="wallet">
                        <option value="">Select Wallet</option>
                        <option value="paytm">Paytm</option>
                        <option value="phonepe">PhonePe</option>
                        <option value="googlepay">Google Pay</option>
                    </select>
                </div>

                <button type="submit" id="confirm-payment" name="pay_now">Confirm Payment</button>
            </form>
        </div>
    </div>

    <script>
        const paymentOptions = document.querySelectorAll('input[name="payment"]');
        const paymentDetails = document.querySelectorAll('.payment-details');
        const confirmPayment = document.getElementById('confirm-payment');
        const paymentForm = document.getElementById('payment-form');

        // Show/hide payment details based on selected option
        paymentOptions.forEach(option => {
            option.addEventListener('change', () => {
                paymentDetails.forEach(detail => detail.style.display = 'none');
                const selectedOption = document.querySelector(`#${option.id.replace('-option', '')}-input`);
                if (selectedOption) selectedOption.style.display = 'block';
            });
        });

        // Validate form inputs before submission
        paymentForm.addEventListener('submit', (e) => {
            const selectedPayment = document.querySelector('input[name="payment"]:checked');
            if (!selectedPayment) {
                alert('Please select a payment method.');
                e.preventDefault();
                return;
            }
            
            const paymentValue = selectedPayment.value;
            if (paymentValue === 'upi' && !document.querySelector('#upi-id').value.trim()) {
                alert('Please enter your UPI ID.');
                e.preventDefault();
            } else if (paymentValue === 'card') {
                const cardNumber = document.querySelector('input[name="card_number"]').value.trim();
                const cardExpiry = document.querySelector('input[name="card_expiry"]').value.trim();
                const cardCvv = document.querySelector('input[name="card_cvv"]').value.trim();
                if (!cardNumber || !cardExpiry || !cardCvv) {
                    alert('Please fill in all card details.');
                    e.preventDefault();
                }
            } else if (paymentValue === 'netbanking' && !document.querySelector('select[name="bank"]').value) {
                alert('Please select a bank.');
                e.preventDefault();
            } else if (paymentValue === 'wallet' && !document.querySelector('select[name="wallet"]').value) {
                alert('Please select a wallet.');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>