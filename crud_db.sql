-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2017 at 06:56 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuwait_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `kudb_employees`
--

CREATE TABLE `kudb_employees` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kudb_employees`
--

INSERT INTO `kudb_employees` (`id`, `firstName`, `lastName`, `gender`, `address`, `dob`) VALUES
(1, 'Airi', 'Satou', 'female', 'Tokyo', '1964-03-04'),
(2, 'Garrett', 'Winters', 'male', 'Tokyo', '1988-09-02'),
(3, 'John', 'Doe', 'male', 'Kansas', '1972-11-06'),
(4, 'Tatyana', 'Fitzpatrick', 'female', 'Londond', '1989-01-01'),
(5, 'Quinnd', 'Flynn', 'male', 'Edinburgh', '1977-03-24'),
(8, 'mohammed', 'shafeek', 'male', 'nil', '1977-03-10'),
(9, 'Suresh', 'CS', 'male', 'Sample man', '1977-03-12'),
(10, 'Sanu', 'mon', 'female', 'nilcxc', '1977-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `kudb_users`
--

CREATE TABLE `kudb_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kudb_users`
--

INSERT INTO `kudb_users` (`id`, `username`, `email`, `password`, `gender`, `phone`, `created`, `modified`, `status`) VALUES
(1, 'shafeek', 'shafeek@sampledomain.in', '805c97123983fea2daf886f82db0bfa2', 'Male', '8956235689', '2017-03-10 16:25:20', '2017-03-15 19:00:21', 1),
(2, 'shafeek-2', 'shafeek2@sampledomain.in', '458d30a10e02e79752f7b3d58a39314c', 'Male', '8956235682', '2017-03-10 16:25:20', '2017-03-15 18:57:43', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kudb_employees`
--
ALTER TABLE `kudb_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kudb_users`
--
ALTER TABLE `kudb_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kudb_employees`
--
ALTER TABLE `kudb_employees`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `kudb_users`
--
ALTER TABLE `kudb_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
