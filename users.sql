-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 11:11 PM
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
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fullname`, `email`, `password`) VALUES
(1, 'g', 'g', 'g'),
(2, 'efszq', 'qsf@sdfq.fsd', 'a'),
(3, 'a', 'a@gmail.com', 'aaa'),
(4, 'eee', 'aa@gmail.com', 'eee'),
(5, 'yahiaten Said', 'yahiaten@gmail.com', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `demandes`
--

CREATE TABLE `demandes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `typefichier` varchar(255) NOT NULL,
  `addon` date NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `numerotlfn` varchar(255) DEFAULT NULL,
  `descriptions` varchar(255) DEFAULT NULL,
  `urgent` tinyint(1) DEFAULT NULL,
  `urgentdate` date DEFAULT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `statu` varchar(100) NOT NULL,
  `foreign_key` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `demandes`
--

INSERT INTO `demandes` (`id`, `typefichier`, `addon`, `email`, `numerotlfn`, `descriptions`, `urgent`, `urgentdate`, `observation`, `statu`, `foreign_key`) VALUES
(39, 'releve', '2024-11-25', '', '', '', 1, '2024-01-01', NULL, 'inprocess', 31216717),
(48, 'certificat', '2024-11-29', 'ttt', 'sq', 'd', 0, NULL, NULL, 'inprocess', 31216713),
(49, 'releve', '2024-11-29', '', '', '', 1, '2024-01-31', '', 'ready', 31216713),
(51, 'releve', '2024-11-29', 'sqdf', 'sf', 'sqdf', 0, NULL, NULL, 'inprocess', 31216713),
(52, 'certificat', '2024-11-29', 'fqsd', 'sdqf', 'qsdf', 1, '2024-01-31', NULL, 'inprocess', 31216713);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matricule` bigint(20) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `styear` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `matricule`, `password`, `name`, `surname`, `styear`) VALUES
(1, 31216713, 'password', 'Gouffi', 'mohamed ryad', 3),
(2, 31216714, 'password', 'salhi', 'nabil', 3),
(4, 31216715, 'password', 'anis', 'boussaha', 2),
(7, 31216716, 'password', 'BOUCHMOUKHA', 'RAID', 1),
(8, 31216717, 'password', 'OUZIA', 'ALI', 4),
(9, 31216718, 'password', 'YAHIAOUI', 'MOHAMED', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `demandes`
--
ALTER TABLE `demandes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
