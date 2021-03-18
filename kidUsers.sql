-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2021 at 01:33 AM
-- Server version: 10.2.37-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blezylsa_grc`
--

-- --------------------------------------------------------

--
-- Table structure for table `kidUsers`
--

CREATE TABLE `kidUsers` (
  `user_id` int(3) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `grade` int(2) DEFAULT NULL,
  `passwd` varchar(100) DEFAULT NULL,
  `isPro` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kidUsers`
--
ALTER TABLE `kidUsers`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kidUsers`
--
ALTER TABLE `kidUsers`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT;
COMMIT;


ALTER TABLE kidUsers
DROP COLUMN user_id;

ALTER TABLE kidUsers ADD PRIMARY KEY(username);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
