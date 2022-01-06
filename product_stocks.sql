-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2022 at 08:55 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

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
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `ID` int(11) NOT NULL,
  `UID` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Product_SKU` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Stocks` varchar(255) DEFAULT NULL,
  `Current_Stocks` varchar(255) DEFAULT NULL,
  `Released_Stocks` varchar(255) DEFAULT NULL,
  `Retail_Price` varchar(255) DEFAULT NULL,
  `Price_PerItem` varchar(255) DEFAULT NULL,
  `Total_Price` varchar(255) DEFAULT NULL,
  `Manufactured_By` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Expiration_Date` varchar(255) DEFAULT NULL,
  `Date_Added` varchar(255) DEFAULT NULL,
  `UserID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
