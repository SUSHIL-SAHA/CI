-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2022 at 02:26 PM
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
-- Table structure for table `communication_setting`
--

CREATE TABLE `communication_setting` (
  `id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `contact_form` varchar(255) DEFAULT NULL,
  `form_heading` varchar(255) DEFAULT NULL,
  `success_msg` varchar(255) DEFAULT NULL,
  `google_recaptcha_on` varchar(255) DEFAULT NULL,
  `google_map_on` varchar(255) DEFAULT NULL,
  `contact_address` varchar(255) DEFAULT NULL,
  `email_subject` varchar(255) DEFAULT NULL,
  `email_template` text DEFAULT NULL,
  `to_mail` varchar(255) DEFAULT NULL,
  `cc_mail` varchar(255) DEFAULT NULL,
  `bcc_mail` varchar(255) DEFAULT NULL,
  `no_reply_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `communication_setting`
--

INSERT INTO `communication_setting` (`id`, `created_by`, `contact_form`, `form_heading`, `success_msg`, `google_recaptcha_on`, `google_map_on`, `contact_address`, `email_subject`, `email_template`, `to_mail`, `cc_mail`, `bcc_mail`, `no_reply_email`) VALUES
(1, 1, 'on', 'Feel free to contact us', 'Thanks for your interest. We will get back to you soon.', NULL, 'on', '', 'Contact information', '<p>Dear Administrator,</p>\r\n\r\n<p>A new contact information has been added with the following information:</p>\r\n\r\n<p>Name: {name}<br />\r\nEmail: {email}<br />\r\nPhone: {phone}<br />\r\nMessage: {comments}</p>\r\n', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `communication_setting`
--
ALTER TABLE `communication_setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `communication_setting`
--
ALTER TABLE `communication_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
