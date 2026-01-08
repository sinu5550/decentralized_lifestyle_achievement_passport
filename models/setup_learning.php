<?php
require_once 'models/db.php';

$con = getConnection();

$sql = "CREATE TABLE IF NOT EXISTS learning_progress (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    title VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,
    progress INT(3) DEFAULT 0,
    status VARCHAR(20) DEFAULT 'In Progress',
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($con, $sql)) {
    echo "Table learning_progress created successfully";
} else {
    echo "Error creating table: " . mysqli_error($con);
}
?>
