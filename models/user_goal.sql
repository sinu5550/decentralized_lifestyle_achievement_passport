-- Table structure for table `user_goal`

CREATE TABLE IF NOT EXISTS `user_goal` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
