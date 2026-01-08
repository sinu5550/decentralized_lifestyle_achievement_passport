<?php
require_once 'models/db.php';

$con = getConnection();

$sql = "CREATE TABLE IF NOT EXISTS social_impact (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    title VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,
    description TEXT,
    metric_value VARCHAR(50),
    impact_date DATE,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($con, $sql)) {
    echo "Table social_impact created successfully";
} else {
    echo "Error creating table: " . mysqli_error($con);
}
?>
