<?php
session_start();
include '../db_connection.php';

// Check if admin is logged in
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Handle review deletion
if(isset($_POST['delete_review'])) {
    $review_id = (int)$_POST['review_id'];
    
    $delete_query = "DELETE FROM review WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $review_id);
    
    if(mysqli_stmt_execute($stmt)) {
        $success = "Review deleted successfully!";
    }
}

// Get all reviews
$query = "SELECT * FROM review ORDER BY submitted_at DESC";
$reviews = mysqli_query($conn, $query);

if(!$reviews) {
    die("Error in query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --main-color: #f45866;
            --secondary-color: #e2a2d7;
            --black: #2c2c54;
            --white: #fff;
            --light-color: #666;
            --box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f8f9fa;
            min-height: 100vh;
            padding: 15px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: var(--white);
            border-radius: 10px;
            box-shadow: var(--box-shadow);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .header h2 {
            color: var(--black);
            font-size: 24px;
            font-weight: 600;
        }

        .btn {
            padding: 8px 16px;
            background: var(--main-color);
            color: var(--white);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
        }

        .reviews-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .review-card {
            background: var(--white);
            padding: 15px;
            border-radius: 8px;
            box-shadow: var(--box-shadow);
            border: 1px solid #eee;
        }

        .review-header {
            margin-bottom: 15px;
        }

        .user-info {
            font-weight: 600;
            color: var(--black);
            margin-bottom: 5px;
        }

        .contact-info {
            font-size: 0.9em;
            color: var(--light-color);
            margin-bottom: 10px;
        }

        .contact-info i {
            width: 16px;
            color: var(--main-color);
            margin-right: 5px;
        }

        .plan-info {
            display: inline-block;
            background: #e2f3ff;
            color: #0066cc;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.85em;
            font-weight: 500;
        }

        .review-content {
            color: var(--light-color);
            margin: 10px 0;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 4px;
            font-size: 0.9em;
            line-height: 1.5;
        }

        .review-date {
            color: var(--light-color);
            font-size: 0.85em;
            margin: 10px 0;
        }

        .review-date i {
            width: 16px;
            color: var(--main-color);
            margin-right: 5px;
        }

        .delete-btn {
            background: #ff4444;
            color: white;
            border: none;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 0.9em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .delete-btn:hover {
            background: #cc0000;
        }

        .success-message {
            background: #4CAF50;
            color: white;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 0.9em;
        }

        .no-reviews {
            text-align: center;
            color: var(--light-color);
            padding: 20px;
            background: #f9f9f9;
            border-radius: 4px;
            margin: 10px 0;
        }

        @media (max-width: 768px) {
            .reviews-container {
                grid-template-columns: 1fr;
            }
            
            .container {
                padding: 15px;
            }
            
            .header {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Manage Reviews</h2>
            <a href="dashboard.php" class="btn">Back to Dashboard</a>
        </div>

        <?php if(isset($success)): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php endif; ?>

        <div class="reviews-container">
            <?php if(mysqli_num_rows($reviews) > 0): ?>
                <?php while($review = mysqli_fetch_assoc($reviews)): ?>
                    <div class="review-card">
                        <div class="review-header">
                            <div class="user-info"><?php echo htmlspecialchars($review['name']); ?></div>
                            <div class="contact-info">
                                <i class="fas fa-envelope"></i> <?php echo htmlspecialchars($review['email']); ?><br>
                                <i class="fas fa-phone"></i> <?php echo htmlspecialchars($review['number']); ?>
                            </div>
                            <div class="plan-info">
                                Plan: <?php echo htmlspecialchars($review['plan']); ?>
                            </div>
                        </div>
                        <div class="review-content">
                            <strong>Message:</strong><br>
                            <?php echo nl2br(htmlspecialchars($review['message'])); ?>
                        </div>
                        <div class="review-date">
                            <i class="fas fa-calendar-alt"></i> <strong>Date:</strong> <?php echo date('d M Y', strtotime($review['date'])); ?><br>
                            <i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> <?php echo htmlspecialchars($review['address']); ?><br>
                            <i class="fas fa-clock"></i> <strong>Submitted:</strong> <?php echo date('d M Y h:i A', strtotime($review['submitted_at'])); ?>
                        </div>
                        <form method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                            <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>">
                            <button type="submit" name="delete_review" class="delete-btn">
                                <i class="fas fa-trash"></i> Delete Review
                            </button>
                        </form>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-reviews">
                    <i class="fas fa-inbox fa-3x"></i>
                    <p>No reviews found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
