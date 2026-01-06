-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2026 at 04:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `user_documents`
--

CREATE TABLE `user_documents` (
  `id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_documents`
--

INSERT INTO `user_documents` (`id`, `user_email`, `file_name`, `file_path`, `upload_time`) VALUES
(2, 'intisarahmedsiyan@gmail.com', '4aylx8.jpg', '../assets/uploadDoc/1767699189_intis.jpg', '2026-01-06 11:33:09'),
(3, 'intisarahmedsiyan@gmail.com', 'coinegg.webp', '../assets/uploadDoc/1767699688_intis.webp', '2026-01-06 11:41:28'),
(4, 'intisarahmedsiyan@gmail.com', 'City Scnario.jpg', '../assets/uploadDoc/1767700111_intis.jpg', '2026-01-06 11:48:31'),
(8, 'intisarahmedsiyan@gmail.com', 'City Scnario.jpg', '../assets/uploadDoc/1767700748_intis.jpg', '2026-01-06 11:59:08'),
(9, 'intisarahmedsiyan@gmail.com', 'aiub.png', '../assets/uploadDoc/1767700760_intis.png', '2026-01-06 11:59:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_documents`
--
ALTER TABLE `user_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
