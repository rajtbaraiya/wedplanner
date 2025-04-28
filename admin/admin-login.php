<?php
session_start();
include '../db_connection.php';

if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; // Get plain password
    
    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if(mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        // For testing: password is admin123
        if($password === 'admin123') {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: dashboard.php');
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Wedding Planner</title>
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
        }
        
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0; padding: 0;
            box-sizing: border-box;
            outline: none; border: none;
            text-decoration: none;
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: linear-gradient(45deg, var(--primary-color), var(--main-color));
        }
        
        .login-form {
            width: 100%;
            max-width: 400px;
            padding: 3rem;
            background: var(--white);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .login-form h3 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: var(--primary-color);
        }
        
        .login-form .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .login-form .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--light-black);
            font-size: 1.2rem;
        }
        
        .login-form .box {
            width: 100%;
            padding: 1.2rem 1.4rem 1.2rem 3rem;
            border: var(--border);
            font-size: 1.1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .login-form .box:focus {
            border-color: var(--main-color);
            box-shadow: 0 0 10px rgba(244,88,102,0.1);
        }
        
        .login-form .btn {
            width: 100%;
            padding: 1.2rem;
            font-size: 1.2rem;
            color: var(--white);
            background: var(--main-color);
            cursor: pointer;
            border-radius: 5px;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }
        
        .login-form .btn:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .error {
            background: #ffe6e6;
            color: #ff0000;
            padding: 1rem;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .logo i {
            font-size: 3rem;
            color: var(--main-color);
        }
        
        @media (max-width: 450px) {
            .login-form {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="" method="POST" class="login-form">
            <div class="logo">
                <i class="fas fa-user-shield"></i>
            </div>
            <h3>Admin Login</h3>
            <?php if(isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" required placeholder="Enter your username" class="box">
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" required placeholder="Enter your password" class="box">
            </div>
            <input type="submit" name="login" value="Login Now" class="btn">
        </form>
    </div>
</body>
</html>
