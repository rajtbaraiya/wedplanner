<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';
$success = '';
$show_security = false;
$show_new_password = false;
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wedplanner";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['email']) && !isset($_POST['security_answer']) && !isset($_POST['new_password'])) {
            // Step 1: Verify email and get security question
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $stmt = $conn->prepare("SELECT id, security_question FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch();
                $_SESSION['reset_user_id'] = $user['id'];
                $_SESSION['reset_email'] = $email;
                $show_security = true;
                $security_question = $user['security_question'];
            } else {
                $error = "Email not found";
            }
        } 
        else if (isset($_POST['security_answer']) && isset($_SESSION['reset_user_id'])) {
            // Step 2: Verify security answer
            $security_answer = $_POST['security_answer'];
            $stmt = $conn->prepare("SELECT security_answer FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['reset_user_id']]);
            $user = $stmt->fetch();
            
            if (password_verify(strtolower($security_answer), $user['security_answer'])) {
                $show_new_password = true;
                $show_security = false;
            } else {
                $error = "Incorrect security answer";
                $show_security = true;
            }
        }
        else if (isset($_POST['new_password']) && isset($_SESSION['reset_user_id'])) {
            // Step 3: Update password
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                $stmt->execute([$hashed_password, $_SESSION['reset_user_id']]);
                
                // Clear reset session variables
                unset($_SESSION['reset_user_id']);
                unset($_SESSION['reset_email']);
                
                $success = "Password updated successfully! You can now login with your new password.";
            } else {
                $error = "Passwords do not match";
                $show_new_password = true;
            }
        }
    } catch(PDOException $e) {
        $error = "Connection failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Wed Planner</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --pink: #ef5777;
            --white: #fff;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: url(images/bg2-booking.jpeg);
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .forgot-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
        }
        .forgot-container h2 {
            color: var(--pink);
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        .btn {
            background: var(--pink);
            color: var(--white);
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #ff3366;
        }
        .error {
            color: #ff0000;
            margin-bottom: 1rem;
            text-align: center;
        }
        .success {
            color: #008000;
            margin-bottom: 1rem;
            text-align: center;
        }
        .login-link {
            text-align: center;
            margin-top: 1rem;
        }
        .login-link a {
            color: var(--pink);
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <h2>Reset Password</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div>
        <?php else: ?>
            <form method="POST" action="">
                <?php if (!$show_security && !$show_new_password): ?>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>">
                    </div>
                    <button type="submit" class="btn">Continue</button>
                <?php endif; ?>
                
                <?php if ($show_security): ?>
                    <div class="form-group">
                        <label>Security Question:</label>
                        <p style="margin-bottom: 1rem;"><?php echo htmlspecialchars($security_question); ?></p>
                        <label for="security_answer">Your Answer:</label>
                        <input type="text" id="security_answer" name="security_answer" required>
                    </div>
                    <button type="submit" class="btn">Verify Answer</button>
                <?php endif; ?>
                
                <?php if ($show_new_password): ?>
                    <div class="form-group">
                        <label for="new_password">New Password:</label>
                        <input type="password" id="new_password" name="new_password" required minlength="6">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required minlength="6">
                    </div>
                    <button type="submit" class="btn">Reset Password</button>
                <?php endif; ?>
            </form>
        <?php endif; ?>
        <div class="login-link">
            <a href="login.php">Back to Login</a>
        </div>
    </div>
</body>
</html>
