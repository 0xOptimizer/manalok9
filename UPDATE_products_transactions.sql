-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 08, 2022 at 04:40 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `products_transactions`
--

CREATE TABLE `products_transactions` (
  `ID` int(11) NOT NULL,
  `Code` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `TransactionID` varchar(255) DEFAULT NULL,
  `OrderNo` varchar(255) DEFAULT NULL,
  `stockID` int(11) DEFAULT NULL,
  `Type` tinyint(1) DEFAULT NULL COMMENT '0 = Restocked; 1 = Released;',
  `Amount` int(255) DEFAULT 0,
  `PriceUnit` varchar(255) DEFAULT '0',
  `InStock` int(255) DEFAULT 0,
  `Date` varchar(255) DEFAULT NULL,
  `DateAdded` varchar(255) DEFAULT NULL,
  `Status` int(11) NOT NULL COMMENT '0 = for approval\r\n1 = approved',
  `Date_Approval` varchar(255) DEFAULT NULL,
  `UserID` varchar(255) DEFAULT NULL,
  `PriceTotal` varchar(255) DEFAULT NULL,
  `JournalID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products_transactions`
--
ALTER TABLE `products_transactions`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products_transactions`
--
ALTER TABLE `products_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
