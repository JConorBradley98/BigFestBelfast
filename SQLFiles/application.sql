-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 14, 2020 at 04:41 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lrobinson46`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `performerid` int(11) NOT NULL,
  `venueid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `confirmed` tinyint(4) DEFAULT NULL,
  `title` varchar(25) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `performerid`, `venueid`, `date`, `confirmed`, `title`, `message`) VALUES
(1, 1, 1, '2020-02-19 17:40:16', 1, 'Hello', 'This is a test message'),
(2, 1, 1, '2020-02-08 18:20:00', 0, 'Ha ha this is  a test', 'Hello i want to hold a test show'),
(3, 1, 1, '2020-02-29 05:20:00', 0, 'Test of text area', 'Text area text area'),
(4, 1, 1, '2020-02-29 05:20:00', 0, 'Test of text area', 'Text area text area'),
(5, 9, 1, '2020-02-28 18:34:00', 1, 'Test message', 'Text Test ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `performerid` (`performerid`,`venueid`),
  ADD KEY `desiredvenue` (`venueid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `applicant` FOREIGN KEY (`performerid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `desiredvenue` FOREIGN KEY (`venueid`) REFERENCES `venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
