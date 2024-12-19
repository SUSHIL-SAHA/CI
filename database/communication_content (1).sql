-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 05:35 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_skeleton`
--

-- --------------------------------------------------------

--
-- Table structure for table `communication_content`
--

CREATE TABLE `communication_content` (
  `id` int(11) NOT NULL,
  `for_page` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `display_heading` varchar(255) DEFAULT NULL,
  `sub_heading` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `display_priority` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `addedOn` datetime DEFAULT NULL,
  `modifiedOn` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `communication_content`
--

INSERT INTO `communication_content` (`id`, `for_page`, `heading`, `display_heading`, `sub_heading`, `status`, `display_priority`, `description`, `addedOn`, `modifiedOn`) VALUES
(1, 'Content', 'Contact Us', 'Yes', '', '1', 'top', '<ul>\r\n	<li>\r\n	<p>&nbsp;</p>\r\n\r\n	<p>Office Address</p>\r\n	105 Fortunegate Road<br />\r\n	North West London<br />\r\n	London<br />\r\n	NW10 9RH</li>\r\n	<li>\r\n	<p>&nbsp;</p>\r\n\r\n	<p>Call</p>\r\n\r\n	<p>07 94 005 1587</p>\r\n	</li>\r\n	<li>\r\n	<p>&nbsp;</p>\r\n\r\n	<p>Email</p>\r\n	<a href=\"mailto:sales@eclickprojects.com\">sales@eclickprojects.com</a></li>\r\n</ul>\r\n', '2022-04-22 10:57:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `communication_content`
--
ALTER TABLE `communication_content`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `communication_content`
--
ALTER TABLE `communication_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
