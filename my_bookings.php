<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get user's bookings with package details
$query = "SELECT b.*, p.amount as payment_amount, p.payment_method, p.payment_status 
          FROM booking b 
          LEFT JOIN payments p ON b.BookingID = p.booking_id 
          WHERE b.UserID = ? 
          ORDER BY b.EventStartDate ASC";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - Wedding Planner</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --main-color: #f45866;
            --primary-color: #404068;
            --black: #222;
            --white: #fff;
            --light-black: #666;
            --light-white: #fff9;
            --dark-bg: rgba(0,0,0,.7);
            --light-bg: #eee;
            --border: .1rem solid #aaa;
            --box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
            --gradient: linear-gradient(135deg, var(--main-color), #e2a2d7);
        }

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
        }

        body {
            background: linear-gradient(135deg, rgba(244,88,102,0.1), rgba(226,162,215,0.1));
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background: var(--gradient);
            color: var(--white);
            border-radius: 25px;
            margin-bottom: 20px;
            transition: 0.3s;
            font-size: 0.9rem;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .bookings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .booking-card {
            background: var(--white);
            padding: 25px;
            border-radius: 15px;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .booking-card:hover {
            transform: translateY(-5px);
        }

        .booking-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .booking-title {
            font-size: 1.2em;
            color: var(--primary-color);
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .booking-date {
            color: var(--light-black);
            font-size: 0.9em;
            margin-top: 5px;
        }

        .booking-details {
            margin: 15px 0;
        }

        .booking-detail {
            margin: 10px 0;
            color: var(--light-black);
            font-size: 0.9em;
        }

        .booking-detail strong {
            color: var(--black);
        }

        .countdown-container {
            background: var(--gradient);
            border-radius: 12px;
            padding: 20px;
            color: white;
            margin-top: 15px;
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 10px;
            animation: glow 2s infinite alternate;
        }

        @keyframes glow {
            from {
                box-shadow: 0 0 10px -5px rgba(244,88,102,0.5);
            }
            to {
                box-shadow: 0 0 20px -5px rgba(244,88,102,0.8);
            }
        }

        .countdown-title {
            font-size: 1rem;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .countdown-timer {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .countdown-box {
            background: rgba(255,255,255,0.2);
            padding: 10px;
            border-radius: 8px;
            min-width: 65px;
            backdrop-filter: blur(5px);
        }

        .countdown-value {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .countdown-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            opacity: 0.9;
        }

        .package-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .package-1 {
            background: #e3f2fd;
            color: #1976d2;
        }

        .package-2 {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .package-3 {
            background: #e8f5e9;
            color: #388e3c;
        }

        .payment-status {
            margin-top: 15px;
            padding: 8px;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            font-size: 0.9em;
        }

        .status-success {
            background: #c8e6c9;
            color: #2e7d32;
        }

        .status-pending {
            background: #fff3e0;
            color: #ef6c00;
        }

        .no-bookings {
            text-align: center;
            padding: 40px;
            background: var(--white);
            border-radius: 15px;
            box-shadow: var(--box-shadow);
        }

        .no-bookings i {
            font-size: 3em;
            color: var(--main-color);
            margin-bottom: 20px;
        }

        .no-bookings p {
            color: var(--light-black);
            font-size: 1.1em;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8em;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .status-badge.pending {
            background: #fff3e0;
            color: #ef6c00;
        }
        .status-badge.confirmed {
            background: #e8f5e9;
            color: #2e7d32;
        }
        .status-badge.cancelled {
            background: #ffebee;
            color: #c62828;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="booking.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Booking
        </a>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="bookings-grid">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="booking-card">
                        <div class="booking-header">
                            <div class="booking-title">
                                Booking #<?php echo $row['BookingID']; ?>
                                <span class="status-badge <?php echo strtolower($row['status']); ?>">
                                    <?php echo ucfirst($row['status']); ?>
                                </span>
                            </div>
                            <div class="booking-date">
                                <i class="far fa-calendar-alt"></i>
                                Event Start: <?php echo date('d M Y', strtotime($row['EventStartDate'])); ?>
                            </div>
                        </div>

                        <?php if(!empty($row['name']) || !empty($row['email'])): ?>
                        <div class="booking-detail">
                            <?php if(!empty($row['name'])): ?>
                                <strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?><br>
                            <?php endif; ?>
                            <?php if(!empty($row['email'])): ?>
                                <strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="booking-detail">
                            <strong>Event Duration:</strong><br>
                            From: <?php echo date('d M Y', strtotime($row['EventStartDate'])); ?><br>
                            To: <?php echo date('d M Y', strtotime($row['EventEndDate'])); ?>
                        </div>

                        <?php if(!empty($row['AdditionalRequest'])): ?>
                            <div class="booking-detail">
                                <strong>Additional Request:</strong><br>
                                <?php echo nl2br(htmlspecialchars($row['AdditionalRequest'])); ?>
                            </div>
                        <?php endif; ?>

                        <?php
                        $package_class = '';
                        $package_name = '';
                        switch($row['PackageID']) {
                            case 1:
                                $package_class = 'package-1';
                                $package_name = 'Full Planning';
                                break;
                            case 2:
                                $package_class = 'package-2';
                                $package_name = 'Partial Planning';
                                break;
                            case 3:
                                $package_class = 'package-3';
                                $package_name = 'Day-of Coordination';
                                break;
                        }
                        ?>
                        <div class="package-badge <?php echo $package_class; ?>">
                            <?php echo $package_name; ?>
                        </div>

                        <?php if(isset($row['payment_status'])): ?>
                            <div class="payment-status <?php echo $row['payment_status'] == 'success' ? 'status-success' : 'status-pending'; ?>">
                                <div class="amount">Amount: ₹<?php echo number_format($row['payment_amount']); ?></div>
                                Payment: <?php echo ucfirst($row['payment_status']); ?>
                                <?php if($row['payment_method']): ?>
                                    <br>via <?php echo ucfirst($row['payment_method']); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="countdown-container">
                            <div class="countdown-title">Time Until Your Big Day</div>
                            <div class="countdown-timer" data-event-date="<?php echo $row['EventStartDate']; ?>">
                                <div class="countdown-box">
                                    <div class="countdown-value" id="days-<?php echo $row['BookingID']; ?>">00</div>
                                    <div class="countdown-label">Days</div>
                                </div>
                                <div class="countdown-box">
                                    <div class="countdown-value" id="hours-<?php echo $row['BookingID']; ?>">00</div>
                                    <div class="countdown-label">Hours</div>
                                </div>
                                <div class="countdown-box">
                                    <div class="countdown-value" id="minutes-<?php echo $row['BookingID']; ?>">00</div>
                                    <div class="countdown-label">Mins</div>
                                </div>
                                <div class="countdown-box">
                                    <div class="countdown-value" id="seconds-<?php echo $row['BookingID']; ?>">00</div>
                                    <div class="countdown-label">Secs</div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="no-bookings">
                <i class="fas fa-calendar-times"></i>
                <p>No bookings found. Start planning your dream wedding today!</p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function updateCountdown(eventDate, bookingId) {
            const now = new Date().getTime();
            const eventTime = new Date(eventDate).getTime();
            const timeLeft = eventTime - now;

            if (timeLeft <= 0) {
                document.querySelector(`#days-${bookingId}`).textContent = '00';
                document.querySelector(`#hours-${bookingId}`).textContent = '00';
                document.querySelector(`#minutes-${bookingId}`).textContent = '00';
                document.querySelector(`#seconds-${bookingId}`).textContent = '00';
                return;
            }

            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            document.querySelector(`#days-${bookingId}`).textContent = days.toString().padStart(2, '0');
            document.querySelector(`#hours-${bookingId}`).textContent = hours.toString().padStart(2, '0');
            document.querySelector(`#minutes-${bookingId}`).textContent = minutes.toString().padStart(2, '0');
            document.querySelector(`#seconds-${bookingId}`).textContent = seconds.toString().padStart(2, '0');
        }

        // Initialize all countdowns
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.countdown-timer').forEach(timer => {
                const eventDate = timer.dataset.eventDate;
                const bookingId = timer.closest('.booking-card').querySelector('.booking-title').textContent.match(/\d+/)[0];
                
                // Initial update
                updateCountdown(eventDate, bookingId);
                
                // Update every second
                setInterval(() => updateCountdown(eventDate, bookingId), 1000);
            });
        });
    </script>
</body>
</html>
