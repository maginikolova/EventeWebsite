-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2020 at 01:08 PM
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
(1, 'Teambuilding', '#40E0D0', 'teya3', '2020-06-01 00:00:00', '0000-00-00 00:00:00', NULL, 0, NULL, ''),
(2, 'Music Festival', '#FF0000', 'teya2', '2020-06-07 00:00:00', '2016-01-10 00:00:00', NULL, 0, NULL, ''),
(4, 'Conference', '#40E0D0', '', '2020-06-11 00:00:00', '2016-01-13 00:00:00', NULL, 0, NULL, ''),
(5, 'Meeting', '#000', 'teya3', '2020-06-12 10:30:00', '2016-01-12 12:30:00', NULL, 0, NULL, ''),
(6, 'Lunch', '#0071c5', 'teya2', '2020-06-12 12:00:00', '0000-00-00 00:00:00', NULL, 0, NULL, ''),
(7, 'Happy Hour', '#0071c5', 'teya2', '2020-06-12 17:30:00', '0000-00-00 00:00:00', NULL, 0, NULL, ''),
(8, 'Dinner', '#0071c5', 'teya2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, NULL, ''),
(9, 'Birthday Party', '#0071c5', 'teya3', '2020-05-14 07:00:00', '2020-05-14 07:00:00', NULL, 0, NULL, ''),
(10, 'Title ', '#FFD700', 'Oganizer 1', '2020-06-28 00:00:00', '0000-00-00 00:00:00', 'Private Party', 0, 'Menu', ''),
(24, 'Wedding', '#40E0D0', 'teya2', '2016-01-06 00:00:00', '2016-01-07 00:00:00', 'Birthday party', 16, 'Menu', ''),
(25, 'Title', '#FF8C00', 'Oganizer 2', '2016-01-09 00:00:00', '2016-01-10 00:00:00', 'Conference', 12, 'Menu', ''),
(27, 'Conference', '#40E0D0', 'teya3', '2020-06-10 00:00:00', '2020-06-11 00:00:00', 'Wedding', 21, 'Catering', 'Hello'),
(29, 'Title', '#008000', 'Oganizer 5', '2020-06-16 00:00:00', '2020-06-17 00:00:00', 'Birthday party', 321, 'Menu', ''),
(30, 'Party', '#FF8C00', 'teya3', '2020-06-02 00:00:00', '2020-06-03 00:00:00', 'Birthday party', 21, 'Menu', 'Party hard'),
(35, 'Party more', '#0071c5', 'Oganizer 1', '2020-07-10 00:00:00', '2020-07-11 00:00:00', 'Private Party', 21, 'Catering', ''),
(36, 'Title', '#0071c5', 'teya2', '2020-05-06 00:00:00', '2020-05-06 02:00:00', 'Private Party', 2, 'Menu', 'hehe');

-- --------------------------------------------------------

--
-- Table structure for table `galery`
--

CREATE TABLE `galery` (
  `id` int(255) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `picProfile` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galery`
--

INSERT INTO `galery` (`id`, `username`, `picProfile`) VALUES
(1, 'Teambuilding', '93908.jpg'),
(2, 'Music Festival', '865602.jpg'),
(5, 'Meeting', '427331.jpg'),
(6, 'Lunch', '646840.jpg'),
(7, 'Happy Hour', '63666.jpg'),
(8, 'Dinner', '422393.jpg'),
(9, 'Birthday Party', '484008.jpg'),
(24, 'Wedding', '573957.jpg'),
(27, 'Conference', '605459.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `client` varchar(255) NOT NULL,
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

INSERT INTO `requests` (`id`, `title`, `color`, `client`, `organizer`, `start`, `end`, `eventType`, `people`, `foodType`, `description`) VALUES
(23, 'Party', '#008000', 'teya1', 'teya2', '2020-07-13 00:00:00', '2020-07-14 00:00:00', 'Private Party', 21, 'Menu', ''),
(24, 'Happy Birthday Tiffany', '#40E0D0', 'teya1', 'teya3', '2020-07-16 00:00:00', '2020-07-17 00:00:00', 'Birthday party', 16, 'Menu', ''),
(25, 'Conference', '#FF8C00', 'teya1', 'Oganizer 2', '2020-07-20 00:00:00', '2020-07-22 00:00:00', 'Conference', 12, 'Menu', ''),
(27, 'Birthday', '#40E0D0', 'teya1', 'Oganizer 4', '2020-07-08 00:00:00', '2020-07-09 00:00:00', 'Birthday party', 16, 'Menu', ''),
(29, 'tey', '#0071c5', '', 'Oganizer 1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Private Party', 0, 'Menu', ''),
(30, 'Anniversary', '#40E0D0', '', 'teya3', '2020-05-06 00:00:00', '2016-01-06 00:00:00', 'Other', 12, 'Catering', 'Wedding anniversary'),
(38, 'asdsda', '', 'teya1', 'teya3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', '');

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
(9, 'teya2', '$2y$10$qF4ZFUc6ZBBCxVeEPfzoqeqV6wgqfkOJDl7oJ7BbhiwYaPjm1AW0m', 2, 'teya123@mail.com'),
(10, 'teya3', '$2y$10$/Rm8UeidBrxzL9s3d9pKQOOwnia8.fALcIFZNY4BSjJOnbwgV/JY6', 2, 'teya3@mail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galery`
--
ALTER TABLE `galery`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `galery`
--
ALTER TABLE `galery`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
