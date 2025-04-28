<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $primary_color = $_POST['primary_color'];
    $secondary_color = $_POST['secondary_color'];
    $message = $_POST['message'];

    $sql = "INSERT INTO theme_colors (user_id, primary_color, secondary_color, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $user_id, $primary_color, $secondary_color, $message);
    
    if ($stmt->execute()) {
        $success = "Theme colors and message submitted successfully!";
    } else {
        $error = "Error submitting theme colors. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Theme Colors</title>
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
            max-width: 900px;
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
            width: 80px;
            height: 3px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }
        .color-preview {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            margin: 8px auto;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }
        .color-preview::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255,255,255,0.2), transparent);
        }
        .color-preview:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .form-label {
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        .form-control {
            border: 2px solid #eee;
            border-radius: 10px;
            padding: 10px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(244,88,102,0.25);
        }
        .form-control-color {
            width: 80px;
            height: 40px;
            padding: 4px;
            border-radius: 8px;
            cursor: pointer;
        }
        .btn-submit {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 20px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            margin-top: 15px;
            font-size: 0.9rem;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
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
            font-size: 0.85rem;
        }
        .btn-back:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .buttons-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .alert {
            border-radius: 12px;
            padding: 12px 15px;
            margin-bottom: 15px;
            animation: slideIn 0.5s ease-in-out;
            font-size: 0.9rem;
        }
        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .color-section {
            background: rgba(255,255,255,0.9);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .message-section {
            background: rgba(255,255,255,0.9);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .color-input-group {
            text-align: center;
            margin-bottom: 15px;
        }
        .color-label {
            font-size: 0.85rem;
            color: #666;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="buttons-container">
            <a href="index.php" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back to Home
            </a>
            <a href="my_theme_requests.php" class="btn-back">
                <i class="fas fa-list me-2"></i>View My Requests
            </a>
        </div>

        <h1 class="heading">Design Your Wedding Colors</h1>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="needs-validation" novalidate>
            <div class="color-section">
                <div class="row">
                    <div class="col-md-6">
                        <div class="color-input-group">
                            <label class="form-label">Primary Color</label>
                            <input type="color" class="form-control form-control-color mx-auto" name="primary_color" required>
                            <div id="primary_preview" class="color-preview"></div>
                            <span class="color-label">Main Wedding Color</span>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="color-input-group">
                            <label class="form-label">Secondary Color</label>
                            <input type="color" class="form-control form-control-color mx-auto" name="secondary_color" required>
                            <div id="secondary_preview" class="color-preview"></div>
                            <span class="color-label">Accent Color</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="message-section">
                <div class="mb-3">
                    <label class="form-label">Message for Admin</label>
                    <textarea class="form-control" name="message" rows="3" 
                        placeholder="Share your vision! Tell us about your wedding theme and inspiration..." 
                        required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-palette me-2"></i>Submit Theme Colors
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.querySelectorAll('input[type="color"]').forEach(input => {
            input.addEventListener('input', (e) => {
                const previewId = e.target.name === 'primary_color' ? 'primary_preview' : 'secondary_preview';
                document.getElementById(previewId).style.backgroundColor = e.target.value;
            });
            // Set initial preview color
            const previewId = input.name === 'primary_color' ? 'primary_preview' : 'secondary_preview';
            document.getElementById(previewId).style.backgroundColor = input.value;
        });
    </script>
</body>
</html>
