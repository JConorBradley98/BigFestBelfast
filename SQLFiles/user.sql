-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 14, 2020 at 04:44 PM
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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `secques` varchar(50) NOT NULL,
  `secans` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phonenumber` varchar(11) NOT NULL,
  `profileimg` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `usertype` varchar(10) NOT NULL,
  `venue` tinyint(4) DEFAULT NULL,
  `restricted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `secques`, `secans`, `email`, `phonenumber`, `profileimg`, `dob`, `usertype`, `venue`, `restricted`) VALUES
(1, 'GregDavies', '86266ee937d97f812a8e57d22b62ee29', 'Name of first pet?', '06d80eb0c50b49a509b49f2424e8c805', 'gregdavies@gmail.com', '921302381', '8037gregdavies.jpg', '1968-05-14', 'performer', NULL, 1),
(2, 'DZ_DEATHRAYS', '5f4dcc3b5aa765d61d8327deb882cf99', 'First guitar', 'cb4a605c55127d17ef8ba174fe905717', 'dz@gmail.com', '921302381', '9087dzdeathrays.jpg', '1994-12-05', 'performer', NULL, 0),
(3, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'What is my password?', 'password', 'admin@admin.com', '123142312', 'admin.jpg', '2020-02-10', 'admin', NULL, NULL),
(4, 'Ulster Hall', '5f4dcc3b5aa765d61d8327deb882cf99', 'How old is the door on the third floor?', '89ee81dad12fa06ec6a5b8461129cdd0', 'ulsterhall@ulsterhall.co.uk', '92131212', '7122ulsterhall.jpg', '1994-12-10', 'venue', 1, 0),
(5, 'Jsmith', '5f4dcc3b5aa765d61d8327deb882cf99', 'Name of first pet?', 'd077f244def8a70e5ea758bd8352fcd8', 'Jsmith@gmail.com', '92131121', '7653man.jpg', '1989-03-16', 'public', NULL, 0),
(7, 'resettest', '86266ee937d97f812a8e57d22b62ee29', 'Name of first pet?', '06d80eb0c50b49a509b49f2424e8c805', 'reset@gmail.com', '921302381', '6249man.jpg', '2020-02-12', 'public', NULL, 0),
(9, 'Kevin', '9d5e3ecdeb4cdb7acfd63075ae046672', 'Name of first pet?', '06d80eb0c50b49a509b49f2424e8c805', 'Kevin@kevin.com', '2314231', '6264kevin.jpg', '1994-10-14', 'performer', NULL, NULL),
(10, 'venue', 'venue', 'venue', 'venue', 'vene', '132213', 'venue', '2020-02-02', 'venue', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
