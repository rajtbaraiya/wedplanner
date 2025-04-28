<?php
include 'db_connection.php';

// Add foreign keys to user table
$sql = "ALTER TABLE user
        ADD FOREIGN KEY (name) REFERENCES booking(name),
        ADD FOREIGN KEY (email) REFERENCES booking(email)";

if ($conn->query($sql) === TRUE) {
    echo "User table altered successfully";
} else {
    echo "Error altering table: " . $conn->error;
}
?>
