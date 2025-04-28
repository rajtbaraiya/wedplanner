<?php
include 'db_connection.php';

// Add name and email columns
$sql1 = "ALTER TABLE booking
         ADD COLUMN name VARCHAR(255) AFTER UserID,
         ADD COLUMN email VARCHAR(255) AFTER name";

// Add foreign key constraints
$sql2 = "ALTER TABLE booking
         ADD CONSTRAINT fk_user_name FOREIGN KEY (name) REFERENCES user(name),
         ADD CONSTRAINT fk_user_email FOREIGN KEY (email) REFERENCES user(email)";

if ($conn->query($sql1) === TRUE) {
    echo "Columns added successfully<br>";
    
    if ($conn->query($sql2) === TRUE) {
        echo "Foreign keys added successfully";
    } else {
        echo "Error adding foreign keys: " . $conn->error;
    }
} else {
    echo "Error adding columns: " . $conn->error;
}
?>
