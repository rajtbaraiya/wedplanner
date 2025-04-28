<?php
session_start();
require_once '../db_connection.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit;
}

// Update status if action is taken
if (isset($_POST['action']) && isset($_POST['theme_id'])) {
    $status = $_POST['action'] === 'approve' ? 'approved' : 'rejected';
    $theme_id = $_POST['theme_id'];
    
    $sql = "UPDATE theme_colors SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $theme_id);
    if ($stmt->execute()) {
        $success = "Status updated successfully!";
    } else {
        $error = "Error updating status.";
    }
}

// Fetch all theme color submissions with user details
$sql = "SELECT tc.*, u.name, u.email 
        FROM theme_colors tc 
        JOIN user u ON tc.user_id = u.id 
        ORDER BY tc.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Theme Colors - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #f45866;
            --secondary-color: #e2a2d7;
        }
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 30px;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .color-box {
            width: 50px;
            height: 50px;
            border: 1px solid #ccc;
            display: inline-block;
            margin-right: 10px;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }
        .color-box:hover {
            transform: scale(1.1);
        }
        .status {
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .status.pending {
            background-color: #ffd700;
            color: #000;
        }
        .status.approved {
            background-color: #28a745;
            color: white;
        }
        .status.rejected {
            background-color: #dc3545;
            color: white;
        }
        .btn-action {
            padding: 8px 15px;
            margin: 0 5px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
            margin-top: 20px;
        }
        .table th {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 15px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .table td {
            vertical-align: middle;
            padding: 15px;
        }
        .table tr {
            transition: all 0.3s ease;
        }
        .table tr:hover {
            background-color: #f8f9fa;
        }
        h2 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
        }
        .btn-back {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
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
            margin-bottom: 30px;
        }
        .alert {
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
            animation: slideIn 0.5s ease-in-out;
        }
        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <a href="dashboard.php" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
            </a>
            <h2><i class="fas fa-palette me-2"></i>Theme Color Submissions</h2>
            <div style="width: 135px;"></div>
        </div>

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
        
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><i class="fas fa-user me-2"></i>User</th>
                        <th><i class="fas fa-palette me-2"></i>Colors</th>
                        <th><i class="fas fa-comment me-2"></i>Message</th>
                        <th><i class="fas fa-info-circle me-2"></i>Status</th>
                        <th><i class="fas fa-calendar me-2"></i>Date</th>
                        <th><i class="fas fa-cogs me-2"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <strong><?php echo htmlspecialchars($row['name']); ?></strong><br>
                                    <small class="text-muted"><?php echo htmlspecialchars($row['email']); ?></small>
                                </td>
                                <td>
                                    <div class="color-box" style="background-color: <?php echo htmlspecialchars($row['primary_color']); ?>" title="Primary Color"></div>
                                    <div class="color-box" style="background-color: <?php echo htmlspecialchars($row['secondary_color']); ?>" title="Secondary Color"></div>
                                </td>
                                <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                                <td>
                                    <span class="status <?php echo strtolower($row['status']); ?>">
                                        <?php echo ucfirst($row['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                                <td>
                                    <?php if ($row['status'] === 'pending'): ?>
                                        <form method="POST" class="d-inline">
                                            <input type="hidden" name="theme_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="action" value="approve" class="btn btn-success btn-action" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button type="submit" name="action" value="reject" class="btn btn-danger btn-action" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-inbox fa-2x mb-3 text-muted"></i>
                                <p class="text-muted">No theme color submissions found.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
