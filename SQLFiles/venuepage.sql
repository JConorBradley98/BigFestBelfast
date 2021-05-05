-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 14, 2020 at 04:45 PM
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
-- Table structure for table `venuepage`
--

CREATE TABLE `venuepage` (
  `id` int(11) NOT NULL,
  `venueid` int(11) NOT NULL,
  `managerid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `maintext` varchar(250) NOT NULL,
  `img1` varchar(50) NOT NULL,
  `img2` varchar(50) NOT NULL,
  `img3` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `venuepage`
--
ALTER TABLE `venuepage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venueid` (`venueid`,`managerid`),
  ADD KEY `venuepageowner` (`managerid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `venuepage`
--
ALTER TABLE `venuepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `venuepage`
--
ALTER TABLE `venuepage`
  ADD CONSTRAINT `venuepageowner` FOREIGN KEY (`managerid`) REFERENCES `venue` (`managerid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venuepagevenue` FOREIGN KEY (`venueid`) REFERENCES `venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
