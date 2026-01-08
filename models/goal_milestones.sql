SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `goal_milestones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goal_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `goal_id` (`goal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `goal_milestones` (`id`, `goal_id`, `title`, `is_completed`, `created_at`) VALUES
(1, 5, 'week 1', 1, '2026-01-06 20:57:02'),
(2, 5, 'week 2', 0, '2026-01-06 20:57:13'),
(3, 6, 'day 1', 0, '2026-01-06 20:59:10'),
(4, 6, 'day 2', 1, '2026-01-06 20:59:17'),
(5, 6, 'day 3', 1, '2026-01-06 20:59:23'),
(6, 6, 'day 4', 1, '2026-01-06 20:59:30'),
(7, 6, 'day 5', 1, '2026-01-06 20:59:36');

COMMIT;
