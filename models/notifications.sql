-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2026 at 04:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lifestyle_passport`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `type` enum('info','success','warning','error') NOT NULL DEFAULT 'info',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `type`, `is_read`, `created_at`) VALUES
(1, 2, 'Challenge Joined', 'You joined a new challenge. Good luck!', 'info', 1, '2026-01-06 21:33:12'),
(2, 2, 'Challenge Joined', 'You joined a new challenge. Good luck!', 'info', 1, '2026-01-06 21:33:17'),
(3, 2, 'New Goal Set', 'You committed to: vhg', 'success', 1, '2026-01-06 21:33:30'),
(4, 2, 'Challenge Completed', 'Congratulations! You completed a challenge.', 'success', 1, '2026-01-06 21:33:52'),
(5, 2, 'Challenge Completed', 'Congratulations! You completed a challenge.', 'success', 1, '2026-01-06 21:33:58'),
(6, 2, 'Challenge Joined', 'You joined a new challenge. Good luck!', 'info', 1, '2026-01-06 21:34:04'),
(7, 2, 'Challenge Completed', 'Congratulations! You completed a challenge.', 'success', 1, '2026-01-06 21:38:27'),
(8, 2, 'Challenge Joined', 'You joined a new challenge. Good luck!', 'info', 1, '2026-01-06 21:41:57'),
(9, 2, 'Challenge Joined', 'You joined a new challenge. Good luck!', 'info', 1, '2026-01-06 21:43:42'),
(10, 2, 'Challenge Completed', 'Congratulations! You completed a challenge.', 'success', 1, '2026-01-06 21:43:47'),
(11, 2, 'Challenge Completed', 'Congratulations! You completed a challenge.', 'success', 1, '2026-01-06 21:45:32'),
(12, 2, 'Challenge Joined', 'You joined a new challenge. Good luck!', 'info', 1, '2026-01-06 21:45:35'),
(13, 2, 'Challenge Completed', 'Congratulations! You completed a challenge.', 'success', 1, '2026-01-06 21:53:09'),
(14, 2, 'Challenge Joined', 'You joined a new challenge. Good luck!', 'info', 1, '2026-01-06 21:53:13'),
(15, 2, 'Challenge Completed', 'Congratulations! You completed a challenge.', 'success', 1, '2026-01-06 21:53:17'),
(16, 2, 'New Goal Set', 'You committed to: kk', 'success', 1, '2026-01-06 21:53:34'),
(17, 2, 'New Goal Set', 'You committed to: kk', 'success', 0, '2026-01-06 22:32:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
