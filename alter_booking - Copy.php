<?php
include 'db_connection.php';

// Drop venue foreign key if exists
$sql1 = "ALTER TABLE booking DROP FOREIGN KEY booking_ibfk_2";
$conn->query($sql1);

// Drop VenueID column
$sql2 = "ALTER TABLE booking DROP COLUMN VenueID";
$conn->query($sql2);

// Add name and email columns with foreign keys
$sql3 = "ALTER TABLE booking 
         ADD COLUMN name VARCHAR(255) AFTER UserID,
         ADD COLUMN email VARCHAR(255) AFTER name,
         ADD FOREIGN KEY (name) REFERENCES user(name),
         ADD FOREIGN KEY (email) REFERENCES user(email)";

if ($conn->query($sql3) === TRUE) {
    echo "Table altered successfully";
} else {
    echo "Error altering table: " . $conn->error;
}
?>
