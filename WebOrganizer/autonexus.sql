-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2020 at 10:24 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autonexus`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `organizer` varchar(255) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `eventType` varchar(255) DEFAULT NULL,
  `people` int(50) NOT NULL,
  `foodType` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `organizer`, `start`, `end`, `eventType`, `people`, `foodType`, `description`) VALUES
(1, 'All Day Event', '#40E0D0', '', '2020-06-01 00:00:00', '0000-00-00 00:00:00', NULL, 0, NULL, ''),
(2, 'Music Festival', '#FF0000', '', '2020-06-07 00:00:00', '2016-01-10 00:00:00', NULL, 0, NULL, ''),
(4, 'Conference', '#40E0D0', '', '2020-06-11 00:00:00', '2016-01-13 00:00:00', NULL, 0, NULL, ''),
(5, 'Meeting', '#000', '', '2020-06-12 10:30:00', '2016-01-12 12:30:00', NULL, 0, NULL, ''),
(6, 'Lunch', '#0071c5', '', '2020-06-12 12:00:00', '0000-00-00 00:00:00', NULL, 0, NULL, ''),
(7, 'Happy Hour', '#0071c5', '', '2020-06-12 17:30:00', '0000-00-00 00:00:00', NULL, 0, NULL, ''),
(8, 'Dinner', '#0071c5', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, NULL, ''),
(9, 'Birthday Party', '#0071c5', '', '2020-05-14 07:00:00', '2020-05-14 07:00:00', NULL, 0, NULL, ''),
(10, 'Double click to change', '#008000', '', '2020-06-28 00:00:00', '0000-00-00 00:00:00', NULL, 0, NULL, ''),
(23, 'Neshto', '#008000', 'Oganizer 2', '2016-01-05 00:00:00', '2016-01-06 00:00:00', 'Private Party', 21, 'Menu', ''),
(24, 'Hello', '#40E0D0', 'Oganizer 5', '2016-01-06 00:00:00', '2016-01-07 00:00:00', 'Birthday party', 16, 'Menu', ''),
(25, 'Hello', '#FF8C00', 'Oganizer 2', '2016-01-09 00:00:00', '2016-01-10 00:00:00', 'Conference', 12, 'Menu', ''),
(27, 'Hello', '#40E0D0', 'Oganizer 4', '2020-06-10 00:00:00', '2020-06-11 00:00:00', 'Wedding', 21, 'Catering', 'Hello'),
(28, 'Hello', '#0071c5', 'Oganizer 3', '2020-06-09 00:00:00', '2020-06-10 00:00:00', 'Team building', 21, 'Menu', ''),
(29, 'Hello', '#008000', 'Oganizer 5', '2020-06-16 00:00:00', '2020-06-17 00:00:00', 'Birthday party', 321, 'Menu', ''),
(30, 'Partyyy', '#FF8C00', 'Oganizer 5', '2020-06-02 00:00:00', '2020-06-03 00:00:00', 'Birthday party', 21, 'Menu', 'Party hard'),
(35, 'Party more', '#008000', 'Oganizer 1', '2020-07-10 00:00:00', '2020-07-11 00:00:00', 'Private Party', 21, 'Catering', '');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `organizer` varchar(255) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `eventType` varchar(255) DEFAULT NULL,
  `people` int(50) NOT NULL,
  `foodType` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `title`, `color`, `organizer`, `start`, `end`, `eventType`, `people`, `foodType`, `description`) VALUES
(23, 'Party', '#008000', 'Oganizer 2', '2020-07-13 00:00:00', '2020-07-14 00:00:00', 'Private Party', 21, 'Menu', ''),
(24, 'Happy Birthday Tiffany', '#40E0D0', 'Oganizer 5', '2020-07-16 00:00:00', '2020-07-17 00:00:00', 'Birthday party', 16, 'Menu', ''),
(25, 'Conference', '#FF8C00', 'Oganizer 2', '2020-07-20 00:00:00', '2020-07-22 00:00:00', 'Conference', 12, 'Menu', ''),
(27, 'Birthday', '#40E0D0', 'Oganizer 4', '2020-07-08 00:00:00', '2020-07-09 00:00:00', 'Birthday party', 16, 'Menu', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `type`, `email`) VALUES
(4, 'admin', '$2y$10$gIFXpCRx5V.cOMYSvy/nD.sy48yVb6UtZ33GiLF2vXh2FyWLmW4vi', 1, 'admin@danielradst.com'),
(8, 'teya1', '$2y$10$E9oDqBhRkD4RL/jE97FTk.4233aXtW4ZUZv5VY50ze.pLNSmpPKIe', 1, 'teya1@mail.com'),
(9, 'teya2', '$2y$10$qF4ZFUc6ZBBCxVeEPfzoqeqV6wgqfkOJDl7oJ7BbhiwYaPjm1AW0m', 2, 'teya123@mail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;