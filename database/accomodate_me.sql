-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2017 at 10:28 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accomodate_me`
--

-- --------------------------------------------------------

--
-- Table structure for table `boarding_details`
--

CREATE TABLE `boarding_details` (
  `boardingID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `studentCount` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `distance` int(11) NOT NULL,
  `address` varchar(80) NOT NULL,
  `boardingFor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boarding_details`
--

INSERT INTO `boarding_details` (`boardingID`, `userID`, `studentCount`, `price`, `distance`, `address`, `boardingFor`) VALUES
(37, 63, 1, '500', 100, 'xxcvcv', 'Boys'),
(38, 63, 1, '500', 100, 'sdvsdv', 'Girls'),
(39, 63, 5, '52200', 2000, 'scafdvsdfv', 'Girls');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `telephone` int(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `date` varchar(30) NOT NULL,
  `creditCardNo` varchar(20) DEFAULT NULL,
  `profPic` varchar(100) DEFAULT NULL,
  `activeAccount` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `email`, `password`, `telephone`, `type`, `date`, `creditCardNo`, `profPic`, `activeAccount`) VALUES
(15, 'Yasiruasdfff', 'Samarasekara', 'yasiru@gmail.com', '123', 0, 'admin', '17-07-01', '0', NULL, 'true'),
(43, 'maneesha', 'indrachapa', 'maneesh.15@cse.mrt.ac.lk', '123123123', 774301326, 'admin', '17-07-09', NULL, '43.jpg', 'true'),
(50, 'maneesha', 'indrachapa', 'maneeshaindrachapa@gmail.com', '123123123', 774301326, 'admin', '17-07-09', '2147483647', NULL, 'true'),
(63, 'm', 'mmmm', 'aaacf@gmail.com', '123456123', 774301326, 'owner', '17-07-14', '11111111111111111', '63.jpg', 'true'),
(72, 'maneesha', 'indrachapa', 'indrachapa@gmail.com', '123123123', 774301326, 'searcher', '17-07-14', NULL, '72.jpg', 'false'),
(75, 'dsfsff', 'mmmm', 'mmkl@lk.lo', '123123123', 774301326, 'searcher', '17-07-14', '0', '75.jpg', 'false');

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
  MODIFY `boardingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
