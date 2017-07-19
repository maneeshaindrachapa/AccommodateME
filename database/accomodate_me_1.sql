-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2017 at 08:22 AM
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
(14, 74, 75, 41000, 'true'),
(15, 74, 75, 50000, 'true');

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
(14, 74, 'Boys', 10, 40000, 200, '23/56 katubedda, moratuwa'),
(15, 74, 'Boys', 10, 50000, 500, '56/7 katubedda, moratuwa.'),
(16, 74, 'Boys', 15, 70000, 200, '34/67 moratuwa'),
(17, 74, 'Girls', 10, 50000, 200, '45/78 katubedda, moratuwa.');

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
(74, 'Yasiru', 'Janith', 'yasirujanith001@gmail.com', '123123123', 776097828, 'owner', '74.jpg', 'true', 1061044282, 1061044282),
(75, 'Kavindu', 'Chamiran', 'kavindu.chamiran@gmail.com', '123123123', 776097827, 'searcher', '75.jpg', 'true', 1055049979, 1055049979),
(79, 'Milky', 'Coperation', 'maneesh.15@cse.mrt.ac.lk', '123123123', 777456123, 'admin', '79.jpg', 'true', 1074096596, 1074096596);

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
  MODIFY `boardingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
