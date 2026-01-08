<?php
require_once 'models/dbConnection.php';

$con = dbConnection();

// Feedback Table
$sql1 = "CREATE TABLE IF NOT EXISTS feedback (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    provider_name VARCHAR(100) DEFAULT 'Anonymous',
    rating INT(1) NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($con, $sql1)) {
    echo "Table feedback created successfully.<br>";
} else {
    echo "Error creating feedback table: " . mysqli_error($con) . "<br>";
}

// Reputation Scores History Table
$sql2 = "CREATE TABLE IF NOT EXISTS reputation_scores (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    score INT(3) NOT NULL,
    breakdown TEXT, -- JSON string
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($con, $sql2)) {
    echo "Table reputation_scores created successfully.<br>";
} else {
    echo "Error creating reputation_scores table: " . mysqli_error($con) . "<br>";
}
?>
