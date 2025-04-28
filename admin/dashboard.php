<?php
session_start();
include '../db_connection.php';

// Check if admin is logged in
if(!isset($_SESSION['admin_id'])) {
    header('Location: admin-login.php');
    exit();
}

// Handle photo upload
if(isset($_POST['upload_photo'])) {
    $target_dir = "../images/invitations/";
    if(!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is actual image
    if(getimagesize($_FILES["photo"]["tmp_name"]) !== false) {
        if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO invitation_photos (image_path) VALUES ('$target_file')";
            mysqli_query($conn, $query);
            $success = "Photo uploaded successfully!";
        }
    }
}

// Handle photo deletion
if(isset($_POST['delete_photo'])) {
    $photo_id = $_POST['photo_id'];
    $query = "SELECT image_path FROM invitation_photos WHERE id = $photo_id";
    $result = mysqli_query($conn, $query);
    if($photo = mysqli_fetch_assoc($result)) {
        unlink($photo['image_path']);
        mysqli_query($conn, "DELETE FROM invitation_photos WHERE id = $photo_id");
        $success = "Photo deleted successfully!";
    }
}

// Get statistics
$total_bookings = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM booking"));
$total_users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user"));

// Get recent bookings with user information
$recent_bookings = mysqli_query($conn, "SELECT b.*, u.name as user_name, u.email as user_email 
                                      FROM booking b 
                                      LEFT JOIN user u ON b.UserID = u.id 
                                      ORDER BY b.CreatedAt DESC LIMIT 5");

// Get photos
$photos = mysqli_query($conn, "SELECT * FROM invitation_photos ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Wedding Planner</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            font-family: 'Poppins', sans-serif;
            margin: 0; padding: 0;
            box-sizing: border-box;
            outline: none; border: none;
            text-decoration: none;
        }
        
        body {
            background: var(--light-color);
            min-height: 100vh;
        }
        
        .dashboard {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 280px;
            background: var(--dark-color);
            padding: 2rem;
            color: var(--light-color);
            position: fixed;
            height: 100vh;
            transition: all 0.3s ease;
        }
        
        .sidebar .logo {
            font-size: 1.8rem;
            margin-bottom: 2.5rem;
            color: var(--light-color);
            text-align: center;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar .menu {
            margin-top: 2rem;
        }
        
        .sidebar .menu a {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            margin: 0.5rem 0;
            color: var(--light-color);
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .sidebar .menu a:hover,
        .sidebar .menu a.active {
            background: var(--gradient);
            transform: translateX(10px);
        }
        
        .sidebar .menu i {
            margin-right: 1rem;
            font-size: 1.2rem;
        }
        
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            background: var(--light-color);
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
        
        .header h2 {
            color: var(--dark-color);
            font-size: 1.5rem;
        }
        
        .header .logout {
            padding: 0.8rem 1.5rem;
            background: var(--gradient);
            color: white;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .header .logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(244,88,102,0.2);
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 2.5rem;
        }
        
        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient);
        }
        
        .stat-card i {
            font-size: 3rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1.5rem;
        }
        
        .stat-card h3 {
            font-size: 2.5rem;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .stat-card p {
            color: var(--text-color);
            font-size: 1.1rem;
        }
        
        .content-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
            margin-bottom: 2.5rem;
        }
        
        .content-section h3 {
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
            font-size: 1.3rem;
        }
        
        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .photo-item {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }
        
        .photo-item:hover {
            transform: translateY(-5px);
        }
        
        .photo-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: all 0.3s ease;
        }
        
        .photo-item:hover img {
            transform: scale(1.1);
        }
        
        .photo-item .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255,0,0,0.8);
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0;
        }
        
        .photo-item:hover .delete-btn {
            opacity: 1;
        }
        
        .photo-item .delete-btn:hover {
            background: red;
            transform: scale(1.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        
        table th,
        table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        table th {
            background: var(--light-color);
            color: var(--dark-color);
            font-weight: 600;
        }
        
        table tr:hover {
            background: rgba(244,88,102,0.05);
        }
        
        .upload-form {
            margin-top: 2rem;
        }
        
        .upload-form input[type="file"] {
            margin-bottom: 1rem;
        }
        
        .upload-form button {
            padding: 0.8rem 1.5rem;
            background: var(--gradient);
            color: white;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .upload-form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(244,88,102,0.2);
        }
        
        @media (max-width: 1024px) {
            .sidebar {
                width: 250px;
            }
            
            .main-content {
                margin-left: 250px;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                padding: 0;
                opacity: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .stats {
                grid-template-columns: 1fr;
            }
            
            .photo-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }
    </style>
    
    <!-- Add Font Awesome for icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <div class="logo">
                <span>Frente</span>
            </div>
            <div class="menu">
                <a href="#" class="active"><i class="fas fa-home"></i>Dashboard</a>
                <a href="#bookings"><i class="fas fa-calendar"></i>Recent Bookings</a>
                <a href="manage_users.php"><i class="fas fa-users"></i>Users</a>
                <a href="manage_reviews.php"><i class="fas fa-cog"></i>Manage Review</a>
                <a href="manage_bookings.php" class="btn">Manage Bookings</a>
                <a href="manage_faqs.php" class="btn">Manage FAQs</a>
                <a href="manage_gallery.php" class="btn">Manage Gallery</a>
                <a href="manage_theme_colors.php" class="btn"><i class="fas fa-palette"></i>Manage Theme Colors</a>
            </div>
        </div>
        
        <div class="main-content">
            <div class="header">
                <h2>Welcome, <?php echo $_SESSION['admin_username']; ?></h2>
                <a href="logout.php" class="logout">Logout</a>
            </div>
            
            <div class="stats">
                <div class="stat-card">
                    <i class="fas fa-calendar"></i>
                    <h3><?php echo $total_bookings; ?></h3>
                    <p>Total Bookings</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <h3><?php echo $total_users; ?></h3>
                    <p>Total Users</p>
                </div>
            </div>
            
            <div id="bookings" class="content-section">
                <h3>Recent Bookings</h3>
                <div class="header-actions">
                    <a href="manage_bookings.php" class="btn">View All Bookings</a>
                    <!--<a href="manage_users.php" class="btn">Manage Users</a>-->
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Event Start Date</th>
                            <th>Event End Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($booking = mysqli_fetch_assoc($recent_bookings)): ?>
                            <tr>
                                <td>#<?php echo $booking['BookingID']; ?></td>
                                <td><?php echo htmlspecialchars($booking['user_name']); ?></td>
                                <td><?php echo htmlspecialchars($booking['user_email']); ?></td>
                                <td><?php echo date('d M Y', strtotime($booking['EventStartDate'])); ?></td>
                                <td><?php echo date('d M Y', strtotime($booking['EventEndDate'])); ?></td>
                                <td>
                                    <span class="status <?php echo strtolower($booking['status']); ?>">
                                        <?php echo ucfirst($booking['status']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
