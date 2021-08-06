-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 02:15 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manalok9_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Code` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `InStock` int(255) DEFAULT 0,
  `Released` int(255) DEFAULT 0,
  `DateAdded` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Code`, `Description`, `InStock`, `Released`, `DateAdded`) VALUES
(1, 'TEST', 'TEST 123', 650, 0, '2021-08-03 03:18:07 AM'),
(3, 'ASD', 'ASDA12345', 275, 0, '2021-08-03 09:50:06 AM'),
(4, 'NEW', 'NEW135616316', 0, 0, '2021-08-03 06:11:02 PM'),
(5, '1', '123', 0, 0, '2021-08-03 06:25:47 PM');

-- --------------------------------------------------------

--
-- Table structure for table `products_transactions`
--

CREATE TABLE `products_transactions` (
  `ID` int(11) NOT NULL,
  `Code` varchar(255) DEFAULT NULL,
  `TransactionID` varchar(255) DEFAULT NULL,
  `Type` tinyint(1) DEFAULT NULL COMMENT '0 = Restocked; 1 = Released;',
  `Amount` int(255) DEFAULT 0,
  `InStock` int(255) DEFAULT 0,
  `Date` varchar(255) DEFAULT NULL,
  `DateAdded` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_transactions`
--

INSERT INTO `products_transactions` (`ID`, `Code`, `TransactionID`, `Type`, `Amount`, `InStock`, `Date`, `DateAdded`) VALUES
(1, 'TEST', '6108', 0, 250, -250, '2021-08-03', '2021-08-03 10:20:19 AM'),
(2, 'TEST', '6108', 0, 500, 500, '2021-08-03', '2021-08-03 10:21:29 AM'),
(3, 'TEST', 'TEST-6108FCE37539E', 0, 800, 800, '2021-08-03', '2021-08-03 10:22:59 AM'),
(4, 'TEST', 'TEST-6108FCF2BE701', 1, 100, -100, '2021-08-03', '2021-08-03 10:23:14 AM'),
(5, 'TEST', 'TEST-6108FDED404C0', 0, 500, 500, '2021-08-03', '2021-08-03 10:27:25 AM'),
(6, 'TEST', 'TEST-6108FE5650E69', 0, 500, 500, '2021-08-03', '2021-08-03 10:29:10 AM'),
(7, 'TEST', 'TEST-6108FE60310E6', 0, 250, 750, '2021-08-03', '2021-08-03 10:29:20 AM'),
(8, 'TEST', 'TEST-6108FE639AD12', 1, 100, 650, '2021-08-03', '2021-08-03 10:29:23 AM'),
(9, 'ASD', 'ASD-6109068131100', 0, 200, 200, '2021-08-03', '2021-08-03 11:04:01 AM'),
(10, 'ASD', 'ASD-610906860108B', 0, 100, 300, '2021-08-03', '2021-08-03 11:04:06 AM'),
(11, 'ASD', 'ASD-61096907810D3', 1, 125, 175, '2021-08-04', '2021-08-03 06:04:23 PM'),
(12, 'ASD', 'ASD-6109692B1005B', 0, 100, 275, '2021-08-04', '2021-08-03 06:04:59 PM');

-- --------------------------------------------------------

--
-- Table structure for table `security_log`
--

CREATE TABLE `security_log` (
  `ID` int(11) NOT NULL,
  `UserID` varchar(255) DEFAULT NULL,
  `Agent` varchar(255) DEFAULT NULL,
  `Platform` varchar(255) DEFAULT NULL,
  `IPAddress` varchar(50) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `PageURL` varchar(255) DEFAULT NULL,
  `DateAdded` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `security_log`
--

INSERT INTO `security_log` (`ID`, `UserID`, `Agent`, `Platform`, `IPAddress`, `Country`, `PageURL`, `DateAdded`) VALUES
(1, NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-08-05 03:22:52 PM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `UserID` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `NameExtension` varchar(255) DEFAULT NULL,
  `DateOfBirth` varchar(255) DEFAULT NULL,
  `ContactNumber` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Comment` varchar(255) DEFAULT NULL,
  `Privilege` varchar(2) DEFAULT NULL COMMENT '0 = None; 1 = Normal; 2 = Admin; 3 = Developer',
  `DateAdded` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `UserID`, `Image`, `FirstName`, `MiddleName`, `LastName`, `NameExtension`, `DateOfBirth`, `ContactNumber`, `Address`, `Comment`, `Privilege`, `DateAdded`) VALUES
(1, '60bc6643380bb', 'uploads/60bc6643380bb/119885521_653071058972274_4010704502296133963_n.jpg', 'chiruno', '', 'borger', '', '', '', '', '', NULL, '2021-06-06 08:08:03 AM'),
(3, '60bf510d64ba8', 'uploads/60bf510d64ba8/image5.jpg', 'first', 'middle', 'last', 'name ext', '2021-06-02', '1231233a2', '', '', '2', '2021-07-24 09:25:14 AM');

-- --------------------------------------------------------

--
-- Table structure for table `users_login`
--

CREATE TABLE `users_login` (
  `ID` int(11) NOT NULL,
  `UserID` varchar(255) DEFAULT NULL,
  `LoginEmail` varchar(255) DEFAULT NULL,
  `LoginPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_login`
--

INSERT INTO `users_login` (`ID`, `UserID`, `LoginEmail`, `LoginPassword`) VALUES
(1, '60bf510d64ba8', 'admin', '$2y$10$wwa2SWPK1P1E.24TsBJUGu7Xn8eRBDliJkxeMMeo8QoHc1wGks7ie');

-- --------------------------------------------------------

--
-- Table structure for table `users_login_history`
--

CREATE TABLE `users_login_history` (
  `ID` int(11) NOT NULL,
  `UserID` varchar(255) DEFAULT NULL,
  `LoginEmail` varchar(255) DEFAULT NULL,
  `LoginPassword` varchar(255) DEFAULT NULL,
  `Agent` varchar(255) DEFAULT NULL,
  `Platform` varchar(255) DEFAULT NULL,
  `IPAddress` varchar(255) DEFAULT NULL,
  `Success` tinyint(1) DEFAULT NULL COMMENT '0 = failed; 1 = success',
  `DateAdded` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_login_history`
--

INSERT INTO `users_login_history` (`ID`, `UserID`, `LoginEmail`, `LoginPassword`, `Agent`, `Platform`, `IPAddress`, `Success`, `DateAdded`) VALUES
(1, '60bf510d64ba8', 'first', 'middle', 'last', 'name ext', NULL, NULL, NULL),
(2, '60bf510d64ba8', 'first', 'middle', 'last', 'name ext', NULL, NULL, '2021-06-15 07:51:48 PM'),
(3, '60bf510d64ba8', 'first', 'middle', 'last', 'name ext', NULL, NULL, '2021-06-16 12:19:18 AM'),
(4, '60bf510d64ba8', 'first', 'middle', 'last', 'name ext', NULL, NULL, '2021-06-17 02:46:41 AM'),
(5, '60bf510d64ba8', 'first', 'middle', 'last', 'name ext', NULL, NULL, '2021-06-17 02:46:41 AM'),
(6, '60bf510d64ba8', 'asd', '1', 'Desktop: Chrome 91.0.4472.101', 'Windows 7', '::1', 1, '2021-06-17 03:07:25 AM'),
(7, '60bf510d64ba8', 'asd', '1', 'Desktop: Chrome 91.0.4472.101', 'Windows 7', '::1', 1, '2021-06-17 03:07:34 AM'),
(8, '60bf510d64ba8', 'asd', '1', 'Desktop: Chrome 91.0.4472.101', 'Windows 7', '::1', 1, '2021-06-17 03:07:34 AM'),
(9, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.101', 'Windows 7', '::1', 1, '2021-06-17 03:10:42 AM'),
(10, NULL, 'asdad', 'asdasd', 'Desktop: Chrome 91.0.4472.101', 'Windows 7', '::1', 0, '2021-06-17 03:11:27 AM'),
(11, NULL, 'asdasdasd', 'asdasdsad', 'Desktop: Chrome 91.0.4472.101', 'Windows 7', '::1', 0, '2021-06-17 03:11:31 AM'),
(12, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.106', 'Windows 7', '::1', 1, '2021-06-19 10:27:32 AM'),
(13, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.106', 'Windows 7', '::1', 1, '2021-06-19 10:27:32 AM'),
(14, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.106', 'Windows 7', '::1', 1, '2021-06-19 11:09:42 AM'),
(15, NULL, 'asd', 'asd', 'Desktop: Chrome 91.0.4472.114', 'Windows 7', '::1', 0, '2021-06-30 11:35:12 AM'),
(16, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.114', 'Windows 7', '::1', 1, '2021-06-30 11:35:14 AM'),
(17, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.114', 'Windows 7', '::1', 1, '2021-06-30 03:11:18 PM'),
(18, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.114', 'Windows 7', '::1', 1, '2021-06-30 11:02:38 PM'),
(19, NULL, 'asd', '`1', 'Desktop: Chrome 91.0.4472.114', 'Windows 7', '::1', 0, '2021-07-01 06:43:03 AM'),
(20, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.114', 'Windows 7', '::1', 1, '2021-07-01 06:43:05 AM'),
(21, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.114', 'Windows 7', '::1', 1, '2021-07-01 12:47:21 PM'),
(22, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.114', 'Windows 7', '::1', 1, '2021-07-03 10:52:49 AM'),
(23, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.114', 'Windows 7', '::1', 1, '2021-07-03 02:19:29 PM'),
(24, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-04 11:03:08 AM'),
(25, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-04 11:03:08 AM'),
(26, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-06 09:38:29 AM'),
(27, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-06 09:38:29 AM'),
(28, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-06 03:07:06 PM'),
(29, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-06 05:53:38 PM'),
(30, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-08 10:08:57 AM'),
(31, NULL, 'asd', '1', 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 0, '2021-07-08 01:03:48 PM'),
(32, NULL, 'asd', '1', 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 0, '2021-07-08 01:03:48 PM'),
(33, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-08 01:05:10 PM'),
(34, NULL, 'asd', '1', 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 0, '2021-07-09 07:07:13 AM'),
(35, NULL, 'asd', '1', 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 0, '2021-07-09 07:07:14 AM'),
(36, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-09 07:07:16 AM'),
(37, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-09 07:07:16 AM'),
(38, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-10 12:38:16 AM'),
(39, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-10 12:38:16 AM'),
(40, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-10 10:39:50 AM'),
(41, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-13 09:14:07 AM'),
(42, '60bf510d64ba8', 'asd', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-13 09:14:07 AM'),
(43, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 91.0.4472.124', 'Windows 7', '::1', 1, '2021-07-13 09:14:27 AM'),
(44, NULL, 'asd', '2', 'Desktop: Chrome 91.0.4472.164', 'Windows 7', '::1', 0, '2021-07-23 04:41:41 AM'),
(45, NULL, 'asd', '1', 'Desktop: Chrome 91.0.4472.164', 'Windows 7', '::1', 0, '2021-07-23 04:41:45 AM'),
(46, NULL, 'asd', '2', 'Desktop: Chrome 91.0.4472.164', 'Windows 7', '::1', 0, '2021-07-23 04:41:55 AM'),
(47, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 91.0.4472.164', 'Windows 7', '::1', 1, '2021-07-23 04:41:59 AM'),
(48, NULL, 'asd', '2', 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 0, '2021-07-23 11:37:27 PM'),
(49, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 1, '2021-07-23 11:39:00 PM'),
(50, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 1, '2021-07-24 07:43:46 AM'),
(51, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 1, '2021-07-24 09:48:13 AM'),
(52, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 1, '2021-07-25 06:54:32 AM'),
(53, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 1, '2021-07-25 07:08:58 AM'),
(54, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 1, '2021-07-26 07:23:36 AM'),
(55, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 1, '2021-07-26 08:09:29 AM'),
(56, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 1, '2021-08-02 04:11:16 PM'),
(57, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 1, '2021-08-03 01:37:36 AM'),
(58, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 1, '2021-08-03 05:43:37 PM'),
(59, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 1, '2021-08-04 01:05:20 AM'),
(60, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 1, '2021-08-04 05:24:40 AM'),
(61, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 92.0.4515.107', 'Windows 7', '::1', 1, '2021-08-05 05:35:40 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products_transactions`
--
ALTER TABLE `products_transactions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `security_log`
--
ALTER TABLE `security_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users_login_history`
--
ALTER TABLE `users_login_history`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products_transactions`
--
ALTER TABLE `products_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `security_log`
--
ALTER TABLE `security_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_login_history`
--
ALTER TABLE `users_login_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
