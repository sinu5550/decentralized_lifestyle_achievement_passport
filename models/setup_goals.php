<?php
require_once('models/db.php');

$con = getConnection();

$sql = "CREATE TABLE IF NOT EXISTS `user_goal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `deadline` date DEFAULT NULL,
  `status` enum('Active','Completed','Archived') NOT NULL DEFAULT 'Active',
  `progress` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if (mysqli_query($con, $sql)) {
    echo "Table 'user_goal' created or already exists.<br>";
} else {
    echo "Error creating table: " . mysqli_error($con) . "<br>";
}


$testSql = "INSERT INTO user_goal (user_id, title, description, deadline, status, progress) 
            VALUES (1, 'Test Goal', 'This is a test goal created by the setup script.', '2026-12-31', 'Active', 0)";

$checkSql = "SELECT * FROM user_goal WHERE title='Test Goal' AND user_id=1";
$checkRes = mysqli_query($con, $checkSql);
if (mysqli_num_rows($checkRes) == 0) {
    if (mysqli_query($con, $testSql)) {
        echo "Test goal inserted.<br>";
    } else {
        echo "Error inserting test goal: " . mysqli_error($con) . "<br>";
    }
} else {
    echo "Test goal already exists.<br>";
}
?>