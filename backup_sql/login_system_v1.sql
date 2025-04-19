-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 12:57 AM
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
-- Database: `login_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `title`, `content`, `created_at`) VALUES
(1, 2, 'first blog,', 'i love to be in the field, the air heals me', '2025-04-12 21:41:23'),
(3, 8, 'lets breathe', 'football let us breathe in positivity', '2025-04-12 21:49:40'),
(4, 8, 'blog 2', 'who hates this beautiful game? asghdhga sjgdfjga ksjb akjshgd kj.ahsdkj gaskb ajshdgjashuiayekasbn jkahsuk gasiudg akjsgd kaujsgdbaskjdb askjgb uiasgd asgbdjkhasg iugad siba sbiuas gdajks giausdg aiusdi uasbd asduiahsd basb dhjgasjhdb ajmsbd ujasgd jhasbdugasbdkjbasiud asjk basiudh akjsdbn kajsbnd iuasbdk jashdiu ashdkjas hndkuash iuashduio hasiufghasujknd aiusdh asunflkasnd uioashd klasjdnoias hdkjalsdhj uioashd sad asd asdfas iuashd iuashfioashf oiasjd lasjodiha sikujadhs iuashnd ioashdi ugasfiugasfiuasgi uas', '2025-04-12 21:52:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `jersey_number` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `blog` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `batch`, `position`, `jersey_number`, `email`, `created_at`, `blog`) VALUES
(1, 'Shahriar', 'admin', 'Shahriar Hossain', '48th', 'Midfielder', 10, 'shahriarbd10@gmail.com', '2025-04-12 21:07:35', NULL),
(2, 'Test', 'testbdwe', '', '', '', 0, '', '2025-04-12 21:08:09', 'i love to be in the ground, it heals me.'),
(5, 'shahriarbd10', 'test', '', '', '', 0, '', '2025-04-12 21:20:08', NULL),
(7, 'shahobd10', 'test', 'Shahriar Hossain', '60', 'Wing', 10, 'testbd@test.com', '2025-04-12 21:25:31', NULL),
(8, 'Test2', 'test', 'tester', '60', 'cf', 11, 'tester@bd.com', '2025-04-12 21:42:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
