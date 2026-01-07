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
-- Table structure for table `goal_milestones`
--

CREATE TABLE `goal_milestones` (
  `id` int(11) NOT NULL,
  `goal_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goal_milestones`
--

INSERT INTO `goal_milestones` (`id`, `goal_id`, `title`, `is_completed`, `created_at`) VALUES
(1, 5, 'week 1', 1, '2026-01-06 20:57:02'),
(2, 5, 'week 2', 0, '2026-01-06 20:57:13'),
(3, 6, 'day 1', 0, '2026-01-06 20:59:10'),
(4, 6, 'day 2', 1, '2026-01-06 20:59:17'),
(5, 6, 'day 3', 1, '2026-01-06 20:59:23'),
(6, 6, 'day 4', 1, '2026-01-06 20:59:30'),
(7, 6, 'day 5', 1, '2026-01-06 20:59:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `goal_milestones`
--
ALTER TABLE `goal_milestones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goal_id` (`goal_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `goal_milestones`
--
ALTER TABLE `goal_milestones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
