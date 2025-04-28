<?php
session_start();
include '../db_connection.php';

// Check if admin is logged in
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Handle multiple photo uploads
if(isset($_POST['upload'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    
    // Handle multiple file uploads
    $target_dir = "../images/gallery/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $uploaded_count = 0;
    $files = $_FILES['images'];
    
    for($i = 0; $i < count($files['name']); $i++) {
        $file_name = time() . '_' . $i . '_' . basename($files['name'][$i]);
        $target_file = $target_dir . $file_name;
        $image_path = "images/gallery/" . $file_name;
        
        // Check if image file is valid
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        
        if(in_array($imageFileType, $allowed_types)) {
            if(move_uploaded_file($files['tmp_name'][$i], $target_file)) {
                $query = "INSERT INTO gallery (image_path, title) VALUES ('$image_path', '$title')";
                mysqli_query($conn, $query);
                $uploaded_count++;
            }
        }
    }
    
    if($uploaded_count > 0) {
        header('Location: manage_gallery.php?success=1&count=' . $uploaded_count);
        exit();
    }
}

// Handle multiple photo deletions
if(isset($_POST['delete_selected'])) {
    if(isset($_POST['selected_photos'])) {
        $deleted_count = 0;
        foreach($_POST['selected_photos'] as $id) {
            $id = (int)$id;
            
            // Get image path before deleting
            $query = "SELECT image_path FROM gallery WHERE id = $id";
            $result = mysqli_query($conn, $query);
            $photo = mysqli_fetch_assoc($result);
            
            if($photo) {
                // Delete file from server
                $file_path = "../" . $photo['image_path'];
                if(file_exists($file_path)) {
                    unlink($file_path);
                }
                
                // Delete from database
                $query = "DELETE FROM gallery WHERE id = $id";
                mysqli_query($conn, $query);
                $deleted_count++;
            }
        }
        
        header('Location: manage_gallery.php?success=2&count=' . $deleted_count);
        exit();
    }
}

// Get all photos
$query = "SELECT * FROM gallery ORDER BY created_at DESC";
$photos = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --primary-color: #f45866;
            --secondary-color: #e2a2d7;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
            --text-color: #444;
            --border-color: #e0e0e0;
            --shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--light-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .heading {
            text-align: center;
            margin-bottom: 2rem;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .heading h1 {
            color: var(--dark-color);
            margin-bottom: 1rem;
            font-size: 28px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(244,88,102,0.2);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff4444, #cc0000);
        }

        .success-message {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            padding: 15px;
            margin-bottom: 2rem;
            border-radius: 8px;
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

        .upload-form {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .upload-form h2 {
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            font-size: 24px;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.8rem;
            color: var(--dark-color);
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(244,88,102,0.1);
        }

        .gallery-controls {
            background: white;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .gallery-item {
            position: relative;
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item .title {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .photo-checkbox {
            position: absolute;
            top: 15px;
            left: 15px;
            transform: scale(1.5);
            z-index: 2;
            cursor: pointer;
        }

        .photo-checkbox input[type="checkbox"] {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            border: 2px solid white;
            background: transparent;
            cursor: pointer;
        }

        .preview-images {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .preview-image {
            position: relative;
            width: 100%;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
        }

        .preview-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-preview {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255,0,0,0.8);
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .remove-preview:hover {
            background: red;
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 10px;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                padding: 1rem;
            }

            .gallery-controls {
                flex-direction: column;
                gap: 1rem;
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
        <div class="heading">
            <h1>Manage Gallery</h1>
            <a href="dashboard.php" class="btn">Back to Dashboard</a>
        </div>

        <?php if(isset($_GET['success'])): ?>
            <div class="success-message">
                <?php
                    $count = isset($_GET['count']) ? (int)$_GET['count'] : 0;
                    switch($_GET['success']) {
                        case '1':
                            echo $count . ' photo(s) uploaded successfully!';
                            break;
                        case '2':
                            echo $count . ' photo(s) deleted successfully!';
                            break;
                    }
                ?>
            </div>
        <?php endif; ?>

        <!-- Upload Form -->
        <div class="upload-form">
            <h2>Upload Photos</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title for all photos:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="images">Select Multiple Images:</label>
                    <input type="file" id="images" name="images[]" accept="image/*" multiple required onchange="previewImages(this)">
                </div>
                <div class="preview-images" id="imagePreview"></div>
                <button type="submit" name="upload" class="btn">Upload Photos</button>
            </form>
        </div>

        <!-- Gallery Section -->
        <form method="POST" id="galleryForm">
            <div class="gallery-controls">
                <div>
                    <button type="button" class="btn" onclick="selectAll()">Select All</button>
                    <button type="button" class="btn" onclick="deselectAll()">Deselect All</button>
                </div>
                <button type="submit" name="delete_selected" class="btn btn-danger" onclick="return confirmDelete()">Delete Selected</button>
            </div>

            <div class="gallery-grid">
                <?php while($photo = mysqli_fetch_assoc($photos)): ?>
                    <div class="gallery-item">
                        <input type="checkbox" name="selected_photos[]" value="<?php echo $photo['id']; ?>" class="photo-checkbox">
                        <img src="../<?php echo htmlspecialchars($photo['image_path']); ?>" alt="">
                        <div class="title"><?php echo htmlspecialchars($photo['title']); ?></div>
                    </div>
                <?php endwhile; ?>
            </div>
        </form>
    </div>

    <script>
        function selectAll() {
            document.querySelectorAll('.photo-checkbox').forEach(checkbox => checkbox.checked = true);
        }

        function deselectAll() {
            document.querySelectorAll('.photo-checkbox').forEach(checkbox => checkbox.checked = false);
        }

        function confirmDelete() {
            const selectedPhotos = document.querySelectorAll('input[name="selected_photos[]"]:checked');
            if (selectedPhotos.length === 0) {
                alert('Please select at least one photo to delete.');
                return false;
            }
            return confirm('Are you sure you want to delete the selected photos?');
        }

        function previewImages(input) {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';

            if (input.files) {
                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const previewWrapper = document.createElement('div');
                        previewWrapper.className = 'preview-image';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        
                        const removeBtn = document.createElement('button');
                        removeBtn.className = 'remove-preview';
                        removeBtn.innerHTML = '×';
                        removeBtn.onclick = function() {
                            previewWrapper.remove();
                        };
                        
                        previewWrapper.appendChild(img);
                        previewWrapper.appendChild(removeBtn);
                        previewContainer.appendChild(previewWrapper);
                    }
                    
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
</body>
</html>
