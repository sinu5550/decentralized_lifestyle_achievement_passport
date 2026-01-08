SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `user_challenges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `status` enum('Joined','Completed') NOT NULL DEFAULT 'Joined',
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `challenge_id` (`challenge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user_challenges` (`id`, `user_id`, `challenge_id`, `status`, `joined_at`, `completed_at`) VALUES
(1, 3, 1, 'Completed', '2026-01-06 21:16:44', '2026-01-06 16:16:57'),
(2, 2, 1, 'Completed', '2026-01-06 21:33:12', '2026-01-06 16:33:52'),
(3, 2, 2, 'Completed', '2026-01-06 21:33:17', '2026-01-06 16:33:58'),
(4, 2, 1, 'Completed', '2026-01-06 21:34:04', '2026-01-06 16:38:27'),
(5, 2, 1, 'Completed', '2026-01-06 21:41:57', '2026-01-06 16:45:32'),
(6, 2, 2, 'Completed', '2026-01-06 21:43:42', '2026-01-06 16:43:47'),
(7, 2, 1, 'Completed', '2026-01-06 21:45:35', '2026-01-06 16:53:09'),
(8, 2, 1, 'Completed', '2026-01-06 21:53:13', '2026-01-06 16:53:17');

COMMIT;
