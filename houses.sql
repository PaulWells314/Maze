-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2015 at 01:29 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `houses`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE IF NOT EXISTS `avatars` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `type` varchar(128) DEFAULT NULL,
  `room_id` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `avatars`
--

INSERT INTO `avatars` (`id`, `name`, `type`, `room_id`) VALUES
(1, 'paul', 'dragon', 1),
(2, 'john', 'bear', 2),
(3, 'wells', 'rabit', 3),
(4, 'Kent', 'superman', 4),
(0, '', '', 14);

-- --------------------------------------------------------

--
-- Table structure for table `doors`
--

CREATE TABLE IF NOT EXISTS `doors` (
  `walls_id_1` int(10) unsigned DEFAULT NULL,
  `walls_id_2` int(10) unsigned DEFAULT NULL,
  `id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doors`
--

INSERT INTO `doors` (`walls_id_1`, `walls_id_2`, `id`) VALUES
(2, 8, 1),
(3, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE IF NOT EXISTS `houses` (
  `address` varchar(128) DEFAULT NULL,
`id` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`address`, `id`) VALUES
('101 Jericho Road', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `name` varchar(128) DEFAULT NULL,
`id` int(10) unsigned NOT NULL,
  `house_id` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`name`, `id`, `house_id`) VALUES
('hall', 1, 1),
('living room', 2, 1),
('dining room', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `walls`
--

CREATE TABLE IF NOT EXISTS `walls` (
`id` int(10) unsigned NOT NULL,
  `room_id` int(10) unsigned DEFAULT NULL,
  `direction` char(1) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `walls`
--

INSERT INTO `walls` (`id`, `room_id`, `direction`) VALUES
(1, 1, 'N'),
(2, 1, 'E'),
(3, 1, 'S'),
(4, 1, 'W'),
(5, 2, 'N'),
(6, 2, 'E'),
(7, 2, 'S'),
(8, 2, 'W'),
(9, 3, 'N'),
(10, 3, 'E'),
(11, 3, 'S'),
(12, 3, 'W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doors`
--
ALTER TABLE `doors`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
 ADD PRIMARY KEY (`id`), ADD KEY `house_id` (`house_id`);

--
-- Indexes for table `walls`
--
ALTER TABLE `walls`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `walls`
--
ALTER TABLE `walls`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
