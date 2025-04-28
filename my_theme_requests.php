<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch user's theme color requests
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM theme_colors WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Theme Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #f45866;
            --secondary-color: #e2a2d7;
        }
        body {
            background: linear-gradient(135deg, rgba(244,88,102,0.1), rgba(226,162,215,0.1));
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            padding: 15px 0;
        }
        .container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 25px;
            margin-top: 15px;
            animation: fadeIn 0.5s ease-in-out;
            max-width: 1000px;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .heading {
            text-align: center;
            color: #333;
            font-size: 2rem;
            padding-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
            position: relative;
        }
        .heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }
        .color-box {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: inline-block;
            margin: 3px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }
        .color-box::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255,255,255,0.2), transparent);
        }
        .color-box:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .status {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .status:hover {
            transform: translateY(-2px);
        }
        .status.pending {
            background: linear-gradient(135deg, #ffd700, #ffa500);
            color: #000;
        }
        .status.approved {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        .status.rejected {
            background: linear-gradient(135deg, #dc3545, #c71f3a);
            color: white;
        }
        .btn-back {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            font-size: 0.9rem;
        }
        .btn-back:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .request-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .request-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .colors-container {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        .color-label {
            font-size: 11px;
            color: #666;
            margin-top: 3px;
            text-align: center;
        }
        .message-box {
            background: rgba(0,0,0,0.02);
            padding: 12px;
            border-radius: 8px;
            margin: 12px 0;
            font-style: italic;
            color: #555;
            font-size: 0.9rem;
        }
        .date-label {
            color: #888;
            font-size: 0.8rem;
            margin-top: 8px;
        }
        .empty-state {
            text-align: center;
            padding: 30px 20px;
            color: #666;
        }
        .empty-state i {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <a href="index.php" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back to Home
            </a>
            <h1 class="heading mb-0">My Theme Colors</h1>
            <a href="theme_colors.php" class="btn-back">
                <i class="fas fa-plus me-2"></i>New Request
            </a>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="request-card">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="colors-container">
                                <div>
                                    <div class="color-box" style="background-color: <?php echo htmlspecialchars($row['primary_color']); ?>"></div>
                                    <div class="color-label">Primary</div>
                                </div>
                                <div>
                                    <div class="color-box" style="background-color: <?php echo htmlspecialchars($row['secondary_color']); ?>"></div>
                                    <div class="color-label">Secondary</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <span class="status <?php echo strtolower($row['status']); ?>">
                                <i class="fas fa-<?php echo $row['status'] === 'approved' ? 'check' : ($row['status'] === 'rejected' ? 'times' : 'clock'); ?> me-2"></i>
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                            <div class="message-box">
                                <i class="fas fa-quote-left me-2 text-muted"></i>
                                <?php echo nl2br(htmlspecialchars($row['message'])); ?>
                            </div>
                            <div class="date-label">
                                <i class="far fa-calendar-alt me-2"></i>
                                Requested on <?php echo date('d M Y', strtotime($row['created_at'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-palette"></i>
                <h3>No Theme Requests Yet</h3>
                <p class="text-muted">Start by creating your first theme color request!</p>
                <a href="theme_colors.php" class="btn-back mt-3">
                    <i class="fas fa-plus me-2"></i>Create New Request
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
