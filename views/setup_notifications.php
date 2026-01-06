<?php
require_once('models/db.php');

$con = getConnection();

// Notifications Table
$sql = "CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `type` enum('info','success','warning','error') NOT NULL DEFAULT 'info',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if (mysqli_query($con, $sql)) {
    echo "Table 'notifications' created successfully.<br>";

    // Seed a welcome notification for all existing users (optional, or just for testing)
    // Let's just create one for the current user if we knew the ID, but safer to just let the app logic handle it.
    // Instead, let's create a generic 'Welcome' notification for demonstration if table was empty.
} else {
    echo "Error creating table: " . mysqli_error($con);
}
?>