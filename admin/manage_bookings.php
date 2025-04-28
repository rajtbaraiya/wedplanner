<?php
session_start();
include '../db_connection.php';

// Check if admin is logged in
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Handle status update
if(isset($_POST['update_status'])) {
    $booking_id = (int)$_POST['booking_id'];
    $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);
    
    $update_query = "UPDATE booking SET status = ? WHERE BookingID = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, "si", $new_status, $booking_id);
    
    if(mysqli_stmt_execute($stmt)) {
        $success = "Booking status updated successfully!";
    }
}

// Get all bookings with user information
$query = "SELECT b.*, u.name, u.email 
          FROM booking b 
          INNER JOIN user u ON b.UserID = u.id 
          ORDER BY b.CreatedAt DESC";
$bookings = mysqli_query($conn, $query);

if(!$bookings) {
    die("Error in query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #f45866;
            --secondary-color: #e2a2d7;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
            --text-color: #444;
            --border-color: #e0e0e0;
            --shadow: 0 5px 15px rgba(0,0,0,0.1);
            --gradient: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--light-color);
            line-height: 1.6;
            padding: 20px;
            color: var(--text-color);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1.5rem 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
        }

        h2 {
            color: var(--dark-color);
            font-size: 1.5rem;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background: var(--light-color);
            color: var(--dark-color);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background-color: rgba(244,88,102,0.05);
        }

        .status {
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.9rem;
            display: inline-block;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .confirmed {
            background: #d4edda;
            color: #155724;
        }

        .cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .status-select {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background: white;
            color: var(--text-color);
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .status-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(244,88,102,0.1);
        }

        .btn-update {
            display: inline-block;
            padding: 8px 16px;
            background: var(--gradient);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(244,88,102,0.2);
        }

        .success-message {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            text-align: center;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: var(--gradient);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(244,88,102,0.2);
        }

        td {
            vertical-align: middle;
            font-size: 0.95rem;
        }

        td:first-child {
            font-weight: 600;
            color: var(--primary-color);
        }

        .date-info {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .date-info span {
            display: block;
            font-size: 0.9rem;
        }

        .date-label {
            color: var(--text-color);
            font-weight: 500;
        }

        .package-id {
            font-weight: 500;
            color: var(--dark-color);
            background: var(--light-color);
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        .additional-request {
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .additional-request:hover {
            white-space: normal;
            overflow: visible;
        }

        @media (max-width: 1200px) {
            .container {
                padding: 10px;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Recent Bookings</h2>
            <a href="dashboard.php" class="btn">Back to Dashboard</a>
        </div>

        <?php if(isset($success)): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Event Dates</th>
                    <th>Package ID</th>
                    <th>Additional Request</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($booking = mysqli_fetch_assoc($bookings)): ?>
                    <tr>
                        <td>#<?php echo $booking['BookingID']; ?></td>
                        <td><?php echo htmlspecialchars($booking['name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['email']); ?></td>
                        <td>
                            <div class="date-info">
                                <span class="date-label">Start:</span>
                                <span><?php echo date('d M Y', strtotime($booking['EventStartDate'])); ?></span>
                            </div>
                            <div class="date-info">
                                <span class="date-label">End:</span>
                                <span><?php echo date('d M Y', strtotime($booking['EventEndDate'])); ?></span>
                            </div>
                        </td>
                        <td>
                            <span class="package-id"><?php echo $booking['PackageID']; ?></span>
                        </td>
                        <td class="additional-request"><?php echo nl2br(htmlspecialchars($booking['AdditionalRequest'])); ?></td>
                        <td>
                            <span class="status <?php echo strtolower($booking['status']); ?>">
                                <?php echo ucfirst($booking['status']); ?>
                            </span>
                        </td>
                        <td>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="booking_id" value="<?php echo $booking['BookingID']; ?>">
                                <select name="new_status" class="status-select">
                                    <option value="">Select Status</option>
                                    <option value="pending" <?php echo ($booking['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="confirmed" <?php echo ($booking['status'] == 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                                    <option value="cancelled" <?php echo ($booking['status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                </select>
                                <input type="hidden" name="update_status" value="1">
                                <button type="submit" class="btn-update">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
