-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2017 at 07:48 PM
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
-- Table structure for table `bet_details`
--

CREATE TABLE `bet_details` (
  `boardingID` int(11) NOT NULL,
  `ownerID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `betAmount` int(11) NOT NULL,
  `isBooked` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bet_details`
--

INSERT INTO `bet_details` (`boardingID`, `ownerID`, `studentID`, `betAmount`, `isBooked`) VALUES
(9, 30, 30, 2500000, 'false'),
(8, 30, 30, 28000, 'false'),
(4, 30, 30, 25000, 'false'),
(9, 30, 63, 2502000, 'false');

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
(2, 28, 'Girls', 25, 250000, 2000, 'vvffbf'),
(3, 29, 'Girls', 1, 500, 300, 'scscs'),
(4, 30, 'Girls', 10, 25000, 200, 'cdcssdcd'),
(5, 30, 'Girls', 10, 25000, 200, 'cdcssdcd'),
(6, 30, 'Girls', 10, 25000, 200, 'cdcssdcd'),
(7, 30, 'Girls', 10, 25000, 200, 'cdcssdcd'),
(8, 30, 'Girls', 10, 25000, 200, 'cdcssdcd'),
(9, 30, 'Girls', 10, 25000, 200, 'cdcssdcd'),
(10, 30, 'Girls', 2, 25000, 200, 'fdbfdfb');

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
  `active` varchar(10) NOT NULL,
  `confirmationCode` int(10) NOT NULL,
  `confirmationCodeCheck` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `email`, `password`, `telephone`, `type`, `profPic`, `active`, `confirmationCode`, `confirmationCodeCheck`) VALUES
(18, 'a', 'a', 'jkjka@gmail.com', '123123123', 774301326, 'searcher', '18.jpg', 'true', 0, NULL),
(19, 'a', 'a', 'dvdv@lk.lk', '123123123', 774301326, 'searcher', 'default.jpg', 'true', 0, NULL),
(20, 'a', 'a', 'dvdffv@lk.lk', '123123123', 774301326, 'searcher', '20.jpg', 'true', 0, 0),
(21, 'a', 'a', 'hnnhnvdffv@lk.lk', '123123123', 774301326, 'owner', '21.jpg', 'true', 0, NULL),
(24, 'n', 'nnnnn', 'nnnnnn@nn.nn', '123123123', 774301326, 'searcher', '24.jpg', 'false', 0, NULL),
(27, 'maneesha', 'indrachapa', 'maneeshaindrachapa@gmail.com', '123123123', 774301326, 'admin', '27.jpg', 'true', 0, 0),
(30, 'kavindu', 'Kc', 'kc@kc.kc', '123123123', 774301326, 'owner', '30.jpg', 'true', 0, NULL),
(35, 'a', 'a', 'aaaa@aaa.lk', '123123123', 774301326, 'searcher', '35.jpg', 'true', 0, NULL),
(36, 'a', 'a', 'aaaa@llaaa.lk', '123123123', 774301326, 'searcher', '36.jpg', 'true', 0, NULL),
(37, 'avdfvvf', 'a', 'aaaaaaaaaacscacasaaaaa@gmail.com', '123123123', 774301326, 'searcher', '37.jpg', 'true', 0, NULL),
(39, 'avdfvvf', 'a', 'cscacasaaa@gmail.com', '123123123', 774301326, 'searcher', 'default.jpg', 'true', 0, NULL),
(41, 'abc', 'abc', 'abc@gmail.com', '123123123', 774301326, 'searcher', 'default.jpg', 'true', 0, NULL),
(63, ' zx', ' x ', 'xxxcxcxc@lk.lk', '123123123', 774301326, 'searcher', '63.jpg', 'true', 123123123, 123123123),
(64, ' zx', ' x ', 'xfffxxcxcxc@lk.lk', '123123123', 774301326, 'searcher', 'default.jpg', 'true', 123123123, 123123123),
(65, 'a', 'a', 'sxssxxsxs@gmi.lk', '123123123', 774301326, 'searcher', '65.jpg', 'true', 1059630177, 1059630177),
(66, 'maneesha', 'klj', 'dddd@hhgg.lk', '123123123', 774301326, 'searcher', 'default.jpg', 'true', 1092504989, 1092504989),
(67, 'mmm', 'mmmm', 'mmmm@mko.lk', '123123123', 774301326, 'owner', 'default.jpg', 'true', 1148543591, 1148543591),
(68, 'bb', 'bfbb', 'bbfbfbfbf@as.lk', '123123123', 774301326, 'searcher', 'default.jpg', 'true', 1323779977, NULL);

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
  MODIFY `boardingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
