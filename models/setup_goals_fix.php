<?php
require_once('models/db.php');

$con = getConnection();


$dropSql = "DROP TABLE IF EXISTS `user_goal`";
if (mysqli_query($con, $dropSql)) {
    echo "Old table dropped.<br>";
} else {
    echo "Error dropping table: " . mysqli_error($con) . "<br>";
}


$sql = "CREATE TABLE `user_goal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `deadline` date DEFAULT NULL,
  `status` enum('Active','Completed','Archived') NOT NULL DEFAULT 'Active',
  `progress` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if (mysqli_query($con, $sql)) {
    echo "Table 'user_goal' created successfully.<br>";
} else {
    echo "Error creating table: " . mysqli_error($con) . "<br>";
    exit(); 
}


$testSql = "INSERT INTO user_goal (user_id, title, description, deadline, status, progress) 
            VALUES (1, 'Sample Goal', 'This is a sample goal for testing.', '2026-12-31', 'Active', 0)";

if (mysqli_query($con, $testSql)) {
    echo "Sample goal inserted.<br>";
} else {
    echo "Error inserting sample goal: " . mysqli_error($con) . "<br>";
}

$checkSql = "SELECT * FROM user_goal";
$checkRes = mysqli_query($con, $checkSql);
if ($checkRes) {
    echo "Verification Select: Success. Found " . mysqli_num_rows($checkRes) . " rows.<br>";
} else {
    echo "Verification Select: Failed. " . mysqli_error($con) . "<br>";
}
?>