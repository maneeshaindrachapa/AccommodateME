-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2017 at 02:35 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accomodate_me_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `boarding_details`
--

CREATE TABLE `boarding_details` (
  `boardingID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `boardingFor` varchar(10) NOT NULL,
  `studentCount` int(10) NOT NULL,
  `price` int(11) NOT NULL,
  `distance` int(10) NOT NULL,
  `address` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boarding_details`
--

INSERT INTO `boarding_details` (`boardingID`, `userID`, `boardingFor`, `studentCount`, `price`, `distance`, `address`) VALUES
(1, 28, 'Boys', 20, 25000, 200, 'dvfdvfvf'),
(2, 28, 'Girls', 25, 250000, 2000, 'vvffbf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(50) NOT NULL,
  `telephone` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `profPic` varchar(50) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `email`, `password`, `telephone`, `type`, `profPic`, `active`) VALUES
(5, 'a', 'a', 'aaaaaaaaaaaa@gmail.com', '123123123', 774301326, 'searcher', '', 'true'),
(6, 'a', 'a', 'aaaaaaaaa@gmail.com', '123123123', 774301326, 'searcher', 'profPic/default.jpg', 'true'),
(17, 'a', 'a', 'jkjkaaa@gmail.com', '123123123', 774301326, 'searcher', 'default.jpg', 'true'),
(18, 'a', 'a', 'jkjka@gmail.com', '123123123', 774301326, 'searcher', 'default.jpg', 'true'),
(19, 'a', 'a', 'dvdv@lk.lk', '123123123', 774301326, 'searcher', 'default.jpg', 'true'),
(20, 'a', 'a', 'dvdffv@lk.lk', '123123123', 774301326, 'searcher', '20.jpg', 'true'),
(21, 'a', 'a', 'hnnhnvdffv@lk.lk', '123123123', 774301326, 'owner', '21.jpg', 'true'),
(22, 'd', 'k', 'manee@lk.lk', 'asdasdasd', 774301328, 'searcher', '22.jpg', 'true'),
(23, 'avdfvvf', 'avdfvdfv', 'manxsasxee@lk.lk', '123123123', 774301326, 'searcher', '23.jpg', 'true'),
(24, 'n', 'nnnnn', 'nnnnnn@nn.nn', '123123123', 774301326, 'searcher', '24.jpg', 'false'),
(27, 'maneesha', 'indrachapa', 'maneeshaindrachapa@gmail.com', '123123123', 774301326, 'admin', '27.jpg', 'true');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boarding_details`
--
ALTER TABLE `boarding_details`
  ADD PRIMARY KEY (`boardingID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boarding_details`
--
ALTER TABLE `boarding_details`
  MODIFY `boardingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
