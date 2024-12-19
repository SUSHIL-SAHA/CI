-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2022 at 01:26 PM
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
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `parent_module` int(11) NOT NULL,
  `permission` char(10) NOT NULL,
  `permalink` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `module_name`, `parent_module`, `permission`, `permalink`, `sort`) VALUES
(1, 'Dashboard', 0, 'ALL', 'dashboard', 1),
(2, 'Site Settings', 0, 'REQUIRE', 'sitesettings', 2),
(3, 'Banner Management', 0, 'REQUIRE', 'bannermanagement', 3),
(4, 'Home Banner List', 3, 'REQUIRE', 'homebanner', 1),
(5, 'Inner Banner', 3, 'REQUIRE', 'innerbanner', 2),
(6, 'Content Management', 0, 'REQUIRE', 'cms', 4),
(7, 'Service', 0, 'REQUIRE', 'service', 5),
(8, 'All Service Category', 7, 'REQUIRE', 'servicecategory', 1),
(9, 'All Service', 7, 'REQUIRE', 'allservice', 2),
(10, 'Communication', 0, 'REQUIRE', 'communication', 6),
(11, 'Settings', 10, 'REQUIRE', 'communicationsettings', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
