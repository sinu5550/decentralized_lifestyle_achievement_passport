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
-- Table structure for table `user_challenges`
--

CREATE TABLE `user_challenges` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `status` enum('Joined','Completed') NOT NULL DEFAULT 'Joined',
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_challenges`
--

INSERT INTO `user_challenges` (`id`, `user_id`, `challenge_id`, `status`, `joined_at`, `completed_at`) VALUES
(1, 3, 1, 'Completed', '2026-01-06 21:16:44', '2026-01-06 16:16:57'),
(2, 2, 1, 'Completed', '2026-01-06 21:33:12', '2026-01-06 16:33:52'),
(3, 2, 2, 'Completed', '2026-01-06 21:33:17', '2026-01-06 16:33:58'),
(4, 2, 1, 'Completed', '2026-01-06 21:34:04', '2026-01-06 16:38:27'),
(5, 2, 1, 'Completed', '2026-01-06 21:41:57', '2026-01-06 16:45:32'),
(6, 2, 2, 'Completed', '2026-01-06 21:43:42', '2026-01-06 16:43:47'),
(7, 2, 1, 'Completed', '2026-01-06 21:45:35', '2026-01-06 16:53:09'),
(8, 2, 1, 'Completed', '2026-01-06 21:53:13', '2026-01-06 16:53:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_challenges`
--
ALTER TABLE `user_challenges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `challenge_id` (`challenge_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_challenges`
--
ALTER TABLE `user_challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
