SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `challenges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `points_reward` int(11) NOT NULL DEFAULT 10,
  `duration_days` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `challenges` (`id`, `title`, `description`, `points_reward`, `duration_days`, `created_at`) VALUES
(1, 'Morning Jog', 'Jog for 30 minutes every morning for a week.', 50, 7, '2026-01-06 21:15:21'),
(2, 'No Sugar', 'Avoid sugary drinks and sweets for 3 days.', 30, 3, '2026-01-06 21:15:21'),
(3, 'Read a Book', 'Read 20 pages of a self-improvement book today.', 15, 1, '2026-01-06 21:15:21'),
(4, 'Meditation', 'Meditate for 10 minutes.', 10, 1, '2026-01-06 21:15:21'),
(5, 'Water Intake', 'Drink 3 liters of water today.', 10, 1, '2026-01-06 21:15:21');

COMMIT;
