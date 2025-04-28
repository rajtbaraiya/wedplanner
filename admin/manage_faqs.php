<?php
session_start();
include '../db_connection.php';

// Check if admin is logged in
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Handle FAQ actions
if(isset($_POST['action'])) {
    if($_POST['action'] === 'add') {
        $question = mysqli_real_escape_string($conn, $_POST['question']);
        $answer = mysqli_real_escape_string($conn, $_POST['answer']);
        
        $query = "INSERT INTO faqs (question, answer) VALUES ('$question', '$answer')";
        mysqli_query($conn, $query);
        
        header('Location: manage_faqs.php?success=1');
        exit();
    }
    
    if($_POST['action'] === 'edit') {
        $id = (int)$_POST['id'];
        $question = mysqli_real_escape_string($conn, $_POST['question']);
        $answer = mysqli_real_escape_string($conn, $_POST['answer']);
        
        $query = "UPDATE faqs SET question = '$question', answer = '$answer' WHERE id = $id";
        mysqli_query($conn, $query);
        
        header('Location: manage_faqs.php?success=2');
        exit();
    }
    
    if($_POST['action'] === 'delete') {
        $id = (int)$_POST['id'];
        $query = "DELETE FROM faqs WHERE id = $id";
        mysqli_query($conn, $query);
        
        header('Location: manage_faqs.php?success=3');
        exit();
    }
}

// Get all FAQs
$query = "SELECT * FROM faqs ORDER BY id DESC";
$faqs = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage FAQs - Admin Dashboard</title>
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
            max-width: 1000px;
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

        .faq-form {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .faq-form h2 {
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
            margin-bottom: 0.5rem;
            color: var(--dark-color);
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(244,88,102,0.1);
        }

        .form-group textarea {
            height: 120px;
            resize: vertical;
        }

        .faq-list {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .faq-item {
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            background: rgba(244,88,102,0.05);
        }

        .faq-item:last-child {
            border-bottom: none;
        }

        .faq-question {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .faq-answer {
            color: var(--text-color);
            margin-bottom: 1rem;
            line-height: 1.8;
        }

        .faq-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .faq-actions .btn {
            font-size: 0.9rem;
            padding: 8px 16px;
        }

        /* Edit Form Styles */
        .edit-form {
            display: none;
            margin-top: 1rem;
            padding: 1rem;
            background: var(--light-color);
            border-radius: 6px;
        }

        .edit-form.active {
            display: block;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 10px;
            }

            .faq-form,
            .faq-list {
                padding: 1.5rem;
            }

            .heading h1 {
                font-size: 24px;
            }

            .faq-actions {
                flex-direction: column;
                gap: 0.5rem;
            }

            .faq-actions .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="heading">
            <h1>Manage FAQs</h1>
            <a href="dashboard.php" class="btn">Back to Dashboard</a>
        </div>

        <?php if(isset($_GET['success'])): ?>
            <div class="success-message">
                <?php
                    switch($_GET['success']) {
                        case '1':
                            echo 'FAQ added successfully!';
                            break;
                        case '2':
                            echo 'FAQ updated successfully!';
                            break;
                        case '3':
                            echo 'FAQ deleted successfully!';
                            break;
                    }
                ?>
            </div>
        <?php endif; ?>

        <!-- Add FAQ Form -->
        <div class="faq-form">
            <h2>Add New FAQ</h2>
            <form method="POST">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label for="question">Question:</label>
                    <input type="text" id="question" name="question" required>
                </div>
                <div class="form-group">
                    <label for="answer">Answer:</label>
                    <textarea id="answer" name="answer" required></textarea>
                </div>
                <button type="submit" class="btn">Add FAQ</button>
            </form>
        </div>

        <!-- FAQ List -->
        <div class="faq-list">
            <h2>Existing FAQs</h2>
            <?php while($faq = mysqli_fetch_assoc($faqs)): ?>
                <div class="faq-item">
                    <div class="faq-question"><?php echo htmlspecialchars($faq['question']); ?></div>
                    <div class="faq-answer"><?php echo nl2br(htmlspecialchars($faq['answer'])); ?></div>
                    <div class="faq-actions">
                        <button class="btn edit-btn" onclick="editFAQ(<?php echo $faq['id']; ?>, '<?php echo addslashes($faq['question']); ?>', '<?php echo addslashes($faq['answer']); ?>')">Edit</button>
                        <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $faq['id']; ?>">
                            <button type="submit" class="btn btn-danger delete-btn">Delete</button>
                        </form>
                    </div>
                    <div class="edit-form">
                        <form method="POST">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?php echo $faq['id']; ?>">
                            <div class="form-group">
                                <label for="edit_question">Question:</label>
                                <input type="text" id="edit_question" name="question" value="<?php echo htmlspecialchars($faq['question']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_answer">Answer:</label>
                                <textarea id="edit_answer" name="answer" required><?php echo htmlspecialchars($faq['answer']); ?></textarea>
                            </div>
                            <button type="submit" class="btn">Update FAQ</button>
                            <button type="button" class="btn btn-danger" onclick="closeEditFAQ()">Cancel</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function editFAQ(id, question, answer) {
            var editForm = document.querySelector('.faq-item[data-id="' + id + '"] .edit-form');
            editForm.classList.add('active');
            document.querySelector('.faq-item[data-id="' + id + '"] .edit-form input[name="question"]').value = question;
            document.querySelector('.faq-item[data-id="' + id + '"] .edit-form textarea[name="answer"]').value = answer;
        }

        function closeEditFAQ() {
            var editForms = document.querySelectorAll('.edit-form');
            editForms.forEach(function(editForm) {
                editForm.classList.remove('active');
            });
        }

        $(document).ready(function() {
            // Smooth scroll to form after adding/editing
            <?php if(isset($_GET['success'])): ?>
                $('html, body').animate({
                    scrollTop: $('.success-message').offset().top - 100
                }, 1000);
            <?php endif; ?>
        });
    </script>
</body>
</html>
