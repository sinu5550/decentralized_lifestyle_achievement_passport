<?php
require_once('models/db.php');

$con = getConnection();

$sql = "CREATE TABLE IF NOT EXISTS `goal_milestones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goal_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `goal_id` (`goal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if (mysqli_query($con, $sql)) {
  echo "Table 'goal_milestones' created successfully.<br>";
} else {
  echo "Error creating table: " . mysqli_error($con) . "<br>";
}
?>