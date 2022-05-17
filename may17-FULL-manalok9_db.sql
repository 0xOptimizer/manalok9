-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 17, 2022 at 05:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.17

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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Type` varchar(255) DEFAULT NULL COMMENT '0=revenues;1=assets;2=liabilities;3=expenses;',
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `Name`, `Type`, `Description`) VALUES
(1, 'Rental Expense', '3', 'Rental Expense'),
(2, 'Cash', '1', 'Cash'),
(3, 'Sales', '0', 'Sales'),
(4, 'Purchases', '3', 'Purchases'),
(5, 'Accounts Payable', '2', 'Accounts Payable'),
(6, 'Office Supplies', '1', 'Office Supplies'),
(7, 'Utilities expense', '3', 'Utilities expense'),
(8, 'Account Receivable', '1', 'Account Receivable');

-- --------------------------------------------------------

--
-- Table structure for table `adtl_fees`
--

CREATE TABLE `adtl_fees` (
  `ID` int(11) NOT NULL,
  `AdtlFeeNo` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Qty` int(11) DEFAULT NULL,
  `UnitDiscount` varchar(32) DEFAULT '0',
  `UnitPrice` varchar(255) DEFAULT NULL,
  `Date` varchar(50) DEFAULT NULL,
  `OrderNo` varchar(64) DEFAULT NULL,
  `Status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adtl_fees`
--

INSERT INTO `adtl_fees` (`ID`, `AdtlFeeNo`, `Description`, `Qty`, `UnitDiscount`, `UnitPrice`, `Date`, `OrderNo`, `Status`) VALUES
(5, 'AF6273EADD1347D', 'TST', 1, '0', '100', '2022-05-05 23:18:53', 'SO6273EA988E0D1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `ID` int(11) NOT NULL,
  `BillNo` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Amount` varchar(255) DEFAULT NULL,
  `Type` varchar(255) DEFAULT NULL,
  `Payee` varchar(255) DEFAULT NULL,
  `Category` varchar(255) DEFAULT NULL,
  `ModeOfPayment` varchar(255) DEFAULT NULL,
  `Date` varchar(50) DEFAULT NULL,
  `OrderNo` varchar(255) DEFAULT NULL,
  `Status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`ID`, `BillNo`, `Description`, `Amount`, `Type`, `Payee`, `Category`, `ModeOfPayment`, `Date`, `OrderNo`, `Status`) VALUES
(1, 'B626D17ACB50F6', 'Test', '100', NULL, NULL, NULL, 'Test', '2022-04-30 19:04:00', 'PO626216755AC22', 0),
(2, 'B6283B10A6D7F9', 'test', '123', 'testTYPE', 'testPAYEE', 'testCATEGORY', NULL, '2022-05-17 22:28:00', NULL, 1),
(3, 'B6283B12CD598B', 'try', '325', 'tryTYPE', 'tryPAYEE', 'tryCATEGORY', NULL, '2022-05-17 22:28:00', NULL, 1),
(4, 'B6283B84DA04DB', 'test', '5745', 'testTYPE', 'testPAYEE', 'testCATEGORY', NULL, '2022-05-17 22:58:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand_category`
--

CREATE TABLE `brand_category` (
  `ID` int(11) NOT NULL,
  `Brand_Name` varchar(255) DEFAULT NULL,
  `Brand_Char` varchar(255) DEFAULT NULL,
  `Brand_Type` varchar(255) DEFAULT NULL,
  `UniqueID` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand_category`
--

INSERT INTO `brand_category` (`ID`, `Brand_Name`, `Brand_Char`, `Brand_Type`, `UniqueID`) VALUES
(12, 'SUPER DOG SOAP', '002', 'DOG SOAP', '4bb4SVs8MUNiCOIiDGbss1'),
(13, 'SUPER DOG NUTRITION', '001', 'DOG FOOD ', 'LuvmcTIFI8l7dwLxAKReET'),
(15, 'POWTECH', '004', 'DOG POWDER', 'eVh7PAI0AwOaNoTa8yJzBS'),
(18, 'MANALO K9 (V-NECK)', '005', 'T-SHIRT', 'mlsUrWds8E9sEfMIGgrpcP'),
(19, 'MANALO K9 (R-NECK)', '006', 'T-SHIRT', '40EZS77DMDU6vgg6m8Lma0'),
(20, 'SHAMPOO & CONDITIONER', '003', 'DOG SOAP', 'ITaHlDihdVcSUsgmUf9Nae'),
(22, 'SUPERDOC HITECH SOAP', '005', 'HITECH SOAP', '73omN355tY2DGhRHNEyJG4'),
(28, 'MANALO K9 (ICGD ROUND)', '007', 'T-SHIRT', 'JDOX9YBQBnGoykrChxde5u'),
(30, 'MANALO K9 (SUPERDOGGERS)', '008', 'T-SHIRT', 'hnMJ8a1Hq9kFZB5DCKEHL5'),
(31, 'MANALO K9 (SANDO-WITH A DOG)', '009', 'SANDO', 'i7cqe45O2iW9ZN12djZMQQ'),
(32, 'MANALO K9 (SANDO-YOUR PAW)', '010', 'SANDO', 'Dq1rKbHq4QCuyr5AzwQqqE'),
(34, 'MANALO K9 (SANDO-PAWSITIVE)', '011', 'SANDO', 'aeDYkMOSNMAs9rOb6zLlER'),
(35, 'MANALO K9 (FACEMASK)', '012', 'FACEMASK', 'BvnrK0OVfjZXSLiS2L0xOH'),
(36, 'MANALO K9(SPORTS JUG)', '013', 'SPORTS JUG', '84eqCTbpWMCeGX6rsXDQaA'),
(41, 'MANALO K9 (UMBRELLA)', '014', 'UMBRELLA', 'cmei3k0IfqMQfzWzNGNa1c'),
(42, 'MANALO K9 (MESH CAP)', '015', 'MESH CAP', 'pxkV3oQwgNhKTyWbbCDR91'),
(43, 'MANALO K9 (LEASH)', '016', 'LEASH', '0wuhcHmH3MWCkzEtsqlNjB'),
(44, 'MANALO K9 (COLLAR)', '017', 'COLLAR', 'gKk4teq8i0MxM6SLqaHa2H'),
(45, 'MANALO K9 (MUG)', '020', 'MUG', '367mHF4JOfpzmZsii2nrvo'),
(46, 'MANALO K9 (CANVASS BAG)', '0021', 'CANVASS BAG', 'MNJCbxsgZNN0iEInX9tThB'),
(47, 'META SHIRT', '022', 'T-SHIRT', 'abwauSmKvpLEtUIBhGx7ZU'),
(51, 'MANALO K9 (ICGD TOP DOGS)', '023', 'T-SHIRT', '160sbuqsxug8kEeulXWlyC'),
(52, 'FACEMASK (IFGD)', '024', 'FACEMASK', 'tEOx9xNusamyDmgAmNWDHo');

-- --------------------------------------------------------

--
-- Table structure for table `brand_properties`
--

CREATE TABLE `brand_properties` (
  `id` int(11) NOT NULL,
  `UniqueID` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Brand_Abbr` varchar(255) DEFAULT NULL,
  `Brand_Type_Abbr` varchar(255) NOT NULL,
  `Product_Line` varchar(255) DEFAULT NULL,
  `Product_line_Abbr` varchar(255) DEFAULT NULL,
  `Product_Type` varchar(255) DEFAULT NULL,
  `Product_Type_Abbr` varchar(255) DEFAULT NULL,
  `Product_Size` varchar(255) DEFAULT NULL,
  `Product_Size_Abbr` varchar(255) DEFAULT NULL,
  `Vcpd` varchar(255) DEFAULT NULL,
  `Vcpd_Abbr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand_properties`
--

INSERT INTO `brand_properties` (`id`, `UniqueID`, `Brand_Abbr`, `Brand_Type_Abbr`, `Product_Line`, `Product_line_Abbr`, `Product_Type`, `Product_Type_Abbr`, `Product_Size`, `Product_Size_Abbr`, `Vcpd`, `Vcpd_Abbr`) VALUES
(12, '4bb4SVs8MUNiCOIiDGbss1', 'SDS', 'DS', 'DOG SOAP', 'DS', 'PREMIUM', 'PRM', NULL, NULL, NULL, NULL),
(13, 'LuvmcTIFI8l7dwLxAKReET', 'SDN', 'DF', 'DOG FOOD', 'DF', 'PREMIUM', 'PRM', NULL, NULL, NULL, NULL),
(15, 'eVh7PAI0AwOaNoTa8yJzBS', 'POT', 'DP', 'DOG POWDER ', 'DP', 'PREMIUM', 'PRM', NULL, NULL, NULL, NULL),
(18, 'mlsUrWds8E9sEfMIGgrpcP', 'MK9', 'TS', 'MERCHANDISE', 'MERCH', 'T-SHIRT', 'TS', NULL, NULL, NULL, NULL),
(19, '40EZS77DMDU6vgg6m8Lma0', 'MK9', 'TS', 'MERCHANDISE', 'MERCH', 'T-SHIRT', 'TS', NULL, NULL, NULL, NULL),
(20, 'ITaHlDihdVcSUsgmUf9Nae', 'SCB', 'DS', 'DOG SOAP', 'DS', 'PREMIUM', 'PRM', NULL, NULL, NULL, NULL),
(22, '73omN355tY2DGhRHNEyJG4', 'SHS', 'HS', 'HITECH SOAP', 'HS', 'PREMIUM', 'PRM', NULL, NULL, NULL, NULL),
(28, 'JDOX9YBQBnGoykrChxde5u', 'MK9', 'TS', 'MERCHANDISE', 'MERCH', 'T-SHIRT', 'TS', NULL, NULL, NULL, NULL),
(30, 'hnMJ8a1Hq9kFZB5DCKEHL5', 'MK9', 'TS', 'MERCHANDISE', 'MERCH', 'T-SHIRT', 'TS', NULL, NULL, NULL, NULL),
(31, 'i7cqe45O2iW9ZN12djZMQQ', 'MK9', 'S', 'MERCHANDISE', 'MERCH', 'T-SHIRT', 'TS', NULL, NULL, NULL, NULL),
(32, 'Dq1rKbHq4QCuyr5AzwQqqE', 'MK9', 'SANDO', 'MERCHANDISE', 'MERCH', 'SANDO', 'SANDO', NULL, NULL, NULL, NULL),
(34, 'aeDYkMOSNMAs9rOb6zLlER', 'MK9', 'SANDO', 'MERCHANDISE', 'MERCH', 'SANDO', 'SANDO', NULL, NULL, NULL, NULL),
(35, 'BvnrK0OVfjZXSLiS2L0xOH', 'MK9', 'FM', 'MERCHANDISE', 'MERCH', 'FACEMASK', 'FM', NULL, NULL, NULL, NULL),
(36, '84eqCTbpWMCeGX6rsXDQaA', 'MK9 ', 'SPOJUG', 'MERCHANDISE', 'MERCH', 'SPORTS JUG', 'SPOJUG', NULL, NULL, NULL, NULL),
(41, 'cmei3k0IfqMQfzWzNGNa1c', 'MK9', 'UMB', 'MERCHANDISE', 'MERCH', 'UMBRELLA', 'UMB', NULL, NULL, NULL, NULL),
(42, 'pxkV3oQwgNhKTyWbbCDR91', 'MK9', 'MC', 'MERCHANDISE', 'MERCH', 'MESH CAP', 'MC', NULL, NULL, NULL, NULL),
(43, '0wuhcHmH3MWCkzEtsqlNjB', 'MK9', 'LEASH', 'MERCHANDISE', 'MERCH', 'LEASH', 'LEASH', NULL, NULL, NULL, NULL),
(44, 'gKk4teq8i0MxM6SLqaHa2H', 'MK9', 'COLLAR', 'MERCHANDISE', 'MERCH', 'COLLAR', 'COLLAR', NULL, NULL, NULL, NULL),
(45, '367mHF4JOfpzmZsii2nrvo', 'MK9', 'MG', 'MERCHANDISE', 'MERCH', 'MUG', 'MG', NULL, NULL, NULL, NULL),
(46, 'MNJCbxsgZNN0iEInX9tThB', 'MK9', 'CANBAG', 'MERCHANDISE', 'MERCH', 'CANVASS BAG', 'CANBAG', NULL, NULL, NULL, NULL),
(47, 'abwauSmKvpLEtUIBhGx7ZU', 'MS', 'TS', 'MERCHANDISE', 'MERCH', 'T-SHIRT', 'TS', NULL, NULL, NULL, NULL),
(51, '160sbuqsxug8kEeulXWlyC', 'MK9', 'TS', 'MERCHANDISE', 'MERCH', 'T-SHIRT', 'TS', NULL, NULL, NULL, NULL),
(52, 'tEOx9xNusamyDmgAmNWDHo', 'IFGD', 'FM', 'MERCHANDISE', 'MERCH', 'FACEMASK', 'FM', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand_size`
--

CREATE TABLE `brand_size` (
  `id` int(11) NOT NULL,
  `UniqueID` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Product_Size` varchar(255) DEFAULT NULL,
  `Product_Size_Abbr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand_size`
--

INSERT INTO `brand_size` (`id`, `UniqueID`, `Product_Size`, `Product_Size_Abbr`) VALUES
(19, '4bb4SVs8MUNiCOIiDGbss1', '150 G', '150 G'),
(20, 'LuvmcTIFI8l7dwLxAKReET', '500G', '500G'),
(21, 'LuvmcTIFI8l7dwLxAKReET', '5KG', '5KG'),
(22, 'LuvmcTIFI8l7dwLxAKReET', '15KG', '15KG'),
(24, 'eVh7PAI0AwOaNoTa8yJzBS', '150 G ', '150 G '),
(27, 'mlsUrWds8E9sEfMIGgrpcP', 'V-NECK EXTRA SMALL', 'XS'),
(28, 'mlsUrWds8E9sEfMIGgrpcP', 'V-NECK SMALL\n', 'S'),
(29, 'mlsUrWds8E9sEfMIGgrpcP', 'V-NECK MEDIUM\n', 'M'),
(30, 'mlsUrWds8E9sEfMIGgrpcP', 'V-NECK LARGE\n', 'L'),
(31, 'mlsUrWds8E9sEfMIGgrpcP', 'V-NECK X-LARGE\n', 'XL'),
(32, 'mlsUrWds8E9sEfMIGgrpcP', 'V-NECK 2X-LARGE\n', '2XL'),
(33, '40EZS77DMDU6vgg6m8Lma0', 'ROUND EXTRA SMALL', 'XS'),
(34, '40EZS77DMDU6vgg6m8Lma0', 'ROUND SMALL', 'S'),
(35, '40EZS77DMDU6vgg6m8Lma0', 'ROUND MEDIUM', 'M'),
(37, '40EZS77DMDU6vgg6m8Lma0', 'ROUND LARGE', 'L'),
(38, '40EZS77DMDU6vgg6m8Lma0', 'ROUND X-LARGE', 'XL'),
(39, '40EZS77DMDU6vgg6m8Lma0', 'ROUND 2X-LARGE', '2XL'),
(40, 'LuvmcTIFI8l7dwLxAKReET', '1KG', '1KG'),
(41, 'ITaHlDihdVcSUsgmUf9Nae', '150G', '150G'),
(45, '73omN355tY2DGhRHNEyJG4', '150G', '150G'),
(57, 'JDOX9YBQBnGoykrChxde5u', 'ROUND EXTRA SMALL', 'XS'),
(58, 'JDOX9YBQBnGoykrChxde5u', 'ROUND SMALL', 'S'),
(59, 'JDOX9YBQBnGoykrChxde5u', 'ROUND MEDIUM', 'M'),
(60, 'JDOX9YBQBnGoykrChxde5u', 'ROUND LARGE', 'L'),
(62, 'JDOX9YBQBnGoykrChxde5u', 'ROUND EXTRA LARGE', 'XL'),
(63, 'JDOX9YBQBnGoykrChxde5u', 'ROUND EXTRA EXTRA LARGE', '2XL'),
(75, 'hnMJ8a1Hq9kFZB5DCKEHL5', 'EXTRA SMALL', 'XS'),
(76, 'hnMJ8a1Hq9kFZB5DCKEHL5', 'SMALL', 'S'),
(77, 'hnMJ8a1Hq9kFZB5DCKEHL5', 'MEDIUM', 'M'),
(78, 'hnMJ8a1Hq9kFZB5DCKEHL5', 'LARGE', 'L'),
(79, 'hnMJ8a1Hq9kFZB5DCKEHL5', 'EXTRA LARGE', 'XL'),
(80, 'hnMJ8a1Hq9kFZB5DCKEHL5', 'EXTRA EXTRA LARGE', 'XXL'),
(81, 'i7cqe45O2iW9ZN12djZMQQ', 'EXTRA SMALL', 'XS'),
(82, 'i7cqe45O2iW9ZN12djZMQQ', 'SMALL', 'S'),
(83, 'i7cqe45O2iW9ZN12djZMQQ', 'MEDIUM ', 'M'),
(84, 'i7cqe45O2iW9ZN12djZMQQ', 'LARGE', 'L'),
(85, 'i7cqe45O2iW9ZN12djZMQQ', 'EXTRA LARGE', 'XL'),
(86, 'i7cqe45O2iW9ZN12djZMQQ', 'EXTRA EXTRA LARGE', 'XXL'),
(87, 'Dq1rKbHq4QCuyr5AzwQqqE', 'EXTRA SMALL', 'XS'),
(88, 'Dq1rKbHq4QCuyr5AzwQqqE', 'SMALL', 'S'),
(89, 'Dq1rKbHq4QCuyr5AzwQqqE', 'MEDIUM ', 'M'),
(90, 'Dq1rKbHq4QCuyr5AzwQqqE', 'LARGE', 'L'),
(91, 'Dq1rKbHq4QCuyr5AzwQqqE', 'EXTRA LARGE', 'XL'),
(92, 'Dq1rKbHq4QCuyr5AzwQqqE', 'EXTRA EXTRA LARGE', 'XXL'),
(94, 'aeDYkMOSNMAs9rOb6zLlER', 'EXTRA SMALL', 'XS'),
(95, 'aeDYkMOSNMAs9rOb6zLlER', 'SMALL', 'S'),
(96, 'aeDYkMOSNMAs9rOb6zLlER', 'MEDIUM', 'M'),
(97, 'aeDYkMOSNMAs9rOb6zLlER', 'LARGE', 'L'),
(98, 'aeDYkMOSNMAs9rOb6zLlER', 'EXTRA LARGE', 'XL'),
(99, 'aeDYkMOSNMAs9rOb6zLlER', 'EXTRA EXTRA LARGE', 'XXL'),
(101, 'BvnrK0OVfjZXSLiS2L0xOH', 'FREE SIZE', 'FS'),
(102, '84eqCTbpWMCeGX6rsXDQaA', 'FREE SIZE', 'FS'),
(107, 'cmei3k0IfqMQfzWzNGNa1c', 'FREE SIZE', 'FS'),
(108, 'pxkV3oQwgNhKTyWbbCDR91', 'FREE SIZE', 'FS'),
(110, '0wuhcHmH3MWCkzEtsqlNjB', 'ADULT SIZE', 'AS'),
(111, '0wuhcHmH3MWCkzEtsqlNjB', 'PUPPY SIZE', 'PPS'),
(112, 'gKk4teq8i0MxM6SLqaHa2H', 'ADULT SIZE', 'AS'),
(113, 'gKk4teq8i0MxM6SLqaHa2H', 'PUPPY SIZE', 'PPS'),
(114, '367mHF4JOfpzmZsii2nrvo', 'FREE SIZE', 'FS'),
(115, 'MNJCbxsgZNN0iEInX9tThB', '10\" X 12\" INCHES', '10\"X12\"'),
(117, 'abwauSmKvpLEtUIBhGx7ZU', 'EXTRA SMALL', 'XS'),
(118, 'abwauSmKvpLEtUIBhGx7ZU', 'SMALL', 'S'),
(119, 'abwauSmKvpLEtUIBhGx7ZU', 'MEDIUM', 'M'),
(120, 'abwauSmKvpLEtUIBhGx7ZU', 'LARGE', 'L'),
(121, 'abwauSmKvpLEtUIBhGx7ZU', 'EXTRA LARGE', 'XL'),
(122, 'abwauSmKvpLEtUIBhGx7ZU', 'EXTRA EXTRA LARGE', '2XL'),
(131, '160sbuqsxug8kEeulXWlyC', 'EXTRA SMALL', 'XS'),
(132, '160sbuqsxug8kEeulXWlyC', 'SMALL', 'S'),
(133, '160sbuqsxug8kEeulXWlyC', 'MEDIUM', 'M'),
(134, '160sbuqsxug8kEeulXWlyC', 'LARGE', 'L'),
(135, '160sbuqsxug8kEeulXWlyC', 'EXTRA LARGE', 'XL'),
(138, 'tEOx9xNusamyDmgAmNWDHo', 'FREE SIZE ', 'FREE SIZE'),
(139, '160sbuqsxug8kEeulXWlyC', 'EXTRA EXTRA LARGE', 'XXL');

-- --------------------------------------------------------

--
-- Table structure for table `brand_vcpd`
--

CREATE TABLE `brand_vcpd` (
  `id` int(11) NOT NULL,
  `UniqueID` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Vcpd` varchar(255) DEFAULT NULL,
  `Vcpd_Abbr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand_vcpd`
--

INSERT INTO `brand_vcpd` (`id`, `UniqueID`, `Vcpd`, `Vcpd_Abbr`) VALUES
(3, 'jE0iJNBbPgntppivjAeUAw', 'DOG FOOD ORIGINAL', 'ORIG'),
(4, 'suLvcnHLKUuOPf4O9UjQxn', '5 IN 1\r\n', '5IN1 RED'),
(7, 'fI3Sh24vcX0puPULEhX51x', 'YOUNG PUPPY', 'YP'),
(8, 'fI3Sh24vcX0puPULEhX51x', 'MINTY COOL', 'MC'),
(9, 'fI3Sh24vcX0puPULEhX51x', 'SHAMPOO & CONDITIONER ', 'SCB'),
(12, 'fI3Sh24vcX0puPULEhX51x', '5IN1', 'ORIG'),
(14, 'fI3Sh24vcX0puPULEhX51x', 'ACTIVATED CHARCOAL', 'AC'),
(16, '8Szdu1MwRDgACGB2ekHhCV', 'YOUNG PUPPY', 'YP'),
(17, '8Szdu1MwRDgACGB2ekHhCV', 'SDS 5IN1 ', 'SDS'),
(18, '8Szdu1MwRDgACGB2ekHhCV', 'ACTIVATED CHARCOAL', 'AC'),
(19, '8Szdu1MwRDgACGB2ekHhCV', 'SHAMPOO & CONDITIONER', 'SCB'),
(20, '8Szdu1MwRDgACGB2ekHhCV', 'MINTY COOL', 'MC'),
(21, 'Y3pPcDURqaSvhoTwkFKbip', 'POWTECH', 'POWTECH'),
(22, 'p9icIOpxNxNVyyOGYqWmUK', 'SDN DOGFOOD  ORIGINAL 500G\r\n', '500G'),
(23, 'GFOwBE7CBfgcPEGZuI6OIN', 'SDN DOGFOOD ORIGINAL  5KG\n', 'SDN 5KG'),
(24, 'GFOwBE7CBfgcPEGZuI6OIN', 'SDN DOGFOOD ORIGINAL  15KG\n', 'SDN 15KG'),
(26, 'GFOwBE7CBfgcPEGZuI6OIN', 'SDN DOGFOOD  ORIGINAL 500 G\n', 'SDN 500G'),
(31, 'qnCirlOw94OU9uSoXSr6fN', 'ORIGINAL', 'ORIG'),
(32, 'qnCirlOw94OU9uSoXSr6fN', 'ORIGINAL', 'ORIG'),
(33, 'qnCirlOw94OU9uSoXSr6fN', 'ORIGINAL', 'ORIG'),
(34, '8OhSAejbll3OKVew1KsOsc', 'MK9 T-SHIRT V-NECK EXTRA SMALL\r\n', 'MK9 V-XS'),
(35, '9Um0IOLZriKg03WAHDEg6P', 'MANALOK9 LOGO\r\n', ''),
(36, '4Ez4riqAWQRULjEgdZW7Rv', 'MANALOK9 LOGO\r\n', 'MK9L'),
(37, '4bb4SVs8MUNiCOIiDGbss1', 'YOUNG PUPPIES\r\n', 'YP'),
(38, '4bb4SVs8MUNiCOIiDGbss1', 'MINTY COOL\n', 'MC'),
(41, '4bb4SVs8MUNiCOIiDGbss1', '5 IN1 ORIGINAL\n', 'ORIG'),
(42, '4bb4SVs8MUNiCOIiDGbss1', 'ACTIVATED CHARCOAL\n', 'AC'),
(44, 'LuvmcTIFI8l7dwLxAKReET', 'ORIGINAL\r\n', 'ORIG'),
(45, 'LuvmcTIFI8l7dwLxAKReET', 'ORIGINAL', 'ORIG'),
(46, 'LuvmcTIFI8l7dwLxAKReET', 'ORIGINAL\n', 'ORIG'),
(47, 'UGLXaTmwRaiTBmUP62JcKV', 'ORIGINAL\r\nPOWTECH', 'POT'),
(48, 'eVh7PAI0AwOaNoTa8yJzBS', 'POWTECH\r\n', 'POT'),
(49, '4Ez4riqAWQRULjEgdZW7Rv', 'V-NECK SMALL\n', 'S'),
(50, 'y3b5WtYXDbmUDmiClBTj3S', 'V-NECK | MANALOK9 LOGO\r\n\r\n', 'VN'),
(51, 'tY8K1Q74vLQFPNBk4TMDSK', 'V-NECK | MANALOK9 LOGO\r\n', 'V-NECK'),
(52, 'mlsUrWds8E9sEfMIGgrpcP', 'V-NECK | MANALOK9 LOGO\r\n', 'VNECK'),
(53, '40EZS77DMDU6vgg6m8Lma0', 'ROUND | MANALOK9 LOGO', 'ROUND'),
(54, 'LuvmcTIFI8l7dwLxAKReET', 'BEEF', 'BEEF'),
(55, 'LuvmcTIFI8l7dwLxAKReET', 'LAMB', 'LAMB'),
(56, 'ITaHlDihdVcSUsgmUf9Nae', 'SHAMPOO AND CONDITIONER BAR\r\n\r\n', 'SCB'),
(57, '6dYaIcFfMexm2afCtUMgBa', ' BLUE', 'BLUE'),
(58, '6dYaIcFfMexm2afCtUMgBa', 'PINK', 'PINK'),
(59, '73omN355tY2DGhRHNEyJG4', 'BLUE', 'BLUE'),
(60, '73omN355tY2DGhRHNEyJG4', 'PINK', 'PINK'),
(61, 'lZN7C56DANlJDWO0JmCsrt', 'ICGD LOGO\r\n', 'ICGD LOGO'),
(62, 'HaA64hdEBUoOT9hwLTKq5G', 'ICGD LOGO', 'ICGD LOGO'),
(63, 'u1MT83lOfrpZwKJoAWjiqq', 'ICGD LOGO ', 'XS '),
(64, 'CTjXn6SxKRzNwM7NPQIuUd', 'ICGD LOGO', 'ICGD LOGO'),
(65, 'TczOcVvubgBxemXijrZlns', 'ICGD LOGO', 'ICGD'),
(66, 'JDOX9YBQBnGoykrChxde5u', 'ICGD LOGO', 'ICGD'),
(67, 'hnMJ8a1Hq9kFZB5DCKEHL5', 'SUPERDOGGERS ', 'SD'),
(69, 'i7cqe45O2iW9ZN12djZMQQ', 'WITH A DOG ', 'WAD'),
(70, 'Dq1rKbHq4QCuyr5AzwQqqE', 'YOUR PAWS | XS', 'YPS'),
(71, '5cOoZnVGr8neVkyR4vjK1S', 'MK9 SANDO PAWSITIVE  ', 'MK9 SANDO PAWSITIVE  '),
(72, 'aeDYkMOSNMAs9rOb6zLlER', 'PAWSITIVE LOGO', 'PAWSITIVE'),
(73, 'BvnrK0OVfjZXSLiS2L0xOH', 'MK9 FACEMASK RED FREE SIZE ', 'MK9RED'),
(74, 'BvnrK0OVfjZXSLiS2L0xOH', 'MK9 FACEMASK BLACK FREE SIZE', 'MK9BLACK'),
(76, 'BvnrK0OVfjZXSLiS2L0xOH', 'MK9 FACEMASK GRAY FREE SIZE', 'MK9GRAY'),
(82, 'BvnrK0OVfjZXSLiS2L0xOH', 'MK9 FACEMASK GOLD RED FREE SIZE ', 'MK9GOLDRED'),
(83, 'BvnrK0OVfjZXSLiS2L0xOH', 'MK9 FACEMASK ICGD WHITE FREE SIZE ', 'ICGDWHITE'),
(84, 'BvnrK0OVfjZXSLiS2L0xOH', 'MK9  FACEMASK  ICGD BLACK FREE SIZE ', 'ICGDBLACK'),
(91, 'qAF5fZwGkZuNGz5GL0pErn', 'MK9 UMBRELLA  WHITE  FREE SIZE ', 'UMBWHITE'),
(95, 'OHr2FSKpCC5VDNK1BHItES', 'MK9 UMBRELLA  WHITE  FREESIZE ', 'UMBWHITE'),
(96, 'MOqoC2AfP17ZH4vPzaPGWX', 'MK9 UMBRELLA  WHITE  FREESIZE ', 'MK9UMBWHITEFS'),
(98, 'cmei3k0IfqMQfzWzNGNa1c', 'MK9 UMBRELLA  WHITE  FREESIZE ', 'WHITE'),
(101, 'sw9CoCqzudrFPgBEl8Yi4a', 'MK9 MESH CAP BLACK AND WHITE ', ' BLACKANDWHITE '),
(102, 'pxkV3oQwgNhKTyWbbCDR91', 'MK9 MESH CAP BLACK AND WHITE FREESIZE ', 'BLACK&WHITE'),
(122, '367mHF4JOfpzmZsii2nrvo', 'MK9 MUG SUPERDOGGERS  FREE SIZE ', 'SUPPERDOGGERSMUG'),
(123, '367mHF4JOfpzmZsii2nrvo', 'MK9  MUG MANALO K9 FREE SIZE', 'MANALOK9LOGOMUG'),
(124, '367mHF4JOfpzmZsii2nrvo', 'MK9 MAGIC MUG FREE SIZE ', 'MAGICMUG'),
(126, 'gKk4teq8i0MxM6SLqaHa2H', 'MK9 COLLAR ARMY GREEN ADULT ', 'ARMYGREEN'),
(127, 'gKk4teq8i0MxM6SLqaHa2H', 'MK9 COLLAR BLACK ADULT ', 'BLACK'),
(128, 'gKk4teq8i0MxM6SLqaHa2H', 'MK9 COLLAR BEIGE ADULT ', 'BEIGE'),
(129, 'gKk4teq8i0MxM6SLqaHa2H', 'MK9 COLLAR PUPPY BLACK ', 'PUPPBLACK'),
(130, 'gKk4teq8i0MxM6SLqaHa2H', 'MK9 COLLAR PUPPY RED ', 'PUPPRED'),
(131, 'gKk4teq8i0MxM6SLqaHa2H', 'MK9 COLLAR PUPPY GRAY', 'PUPPGRAY'),
(132, 'gKk4teq8i0MxM6SLqaHa2H', 'MK9 COLLAR PUPPY YELLOW ', 'PUPPYELLOW'),
(133, 'gKk4teq8i0MxM6SLqaHa2H', 'MK9 COLLAR PUPPY BROWN ', 'PUPPBROWN'),
(134, 'gKk4teq8i0MxM6SLqaHa2H', ' MK9 COLLAR PUPPY ARMY GREEN', 'PUPPARMYGREEN'),
(135, '0wuhcHmH3MWCkzEtsqlNjB', 'MK9 LEASH PUPPY BLACK\n', 'PUPPBLACK'),
(136, '0wuhcHmH3MWCkzEtsqlNjB', 'MK9 LEASH PUPPY RED ', 'PUPPRED'),
(137, '0wuhcHmH3MWCkzEtsqlNjB', 'MK9 LEASH PUPPY GRAY ', 'PUPPGRAY'),
(138, '0wuhcHmH3MWCkzEtsqlNjB', 'MK9 LEASH PUPPY YELLOW', 'PUPPYELLOW'),
(139, '0wuhcHmH3MWCkzEtsqlNjB', 'MK9 LEASH PUPPY BROWN ', 'PUPPBROWN'),
(140, '0wuhcHmH3MWCkzEtsqlNjB', 'MK9 LEASH  PUPPY ARMY GREEN ', 'PUPPARMYGREEN'),
(141, '0wuhcHmH3MWCkzEtsqlNjB', 'MK9 LEASH ARMY GREEN ADULT ', 'ARMYGREEN'),
(142, '0wuhcHmH3MWCkzEtsqlNjB', 'MK9 LEASH BLACK ADULT ', 'BLACK'),
(143, '0wuhcHmH3MWCkzEtsqlNjB', 'MK9 LEASH BEIGE ADULT ', 'BEIGE'),
(144, '0wuhcHmH3MWCkzEtsqlNjB', 'MK9 LEASH ARMY GREEN ADULT ', 'ARMYGREEN'),
(145, '84eqCTbpWMCeGX6rsXDQaA', 'MK9 SPORTS JUG WHITE FREE SIZE ', 'WHITE'),
(146, '84eqCTbpWMCeGX6rsXDQaA', 'MK9 SPORTS JUG SILVER FREE SIZE ', 'SILVER'),
(147, 'MNJCbxsgZNN0iEInX9tThB', 'MK9 CANVASS BAG WHITE   10\"X12\"', 'CANBAG'),
(148, 'abwauSmKvpLEtUIBhGx7ZU', 'META SHIRT BLACK ROUND', 'MSBR'),
(149, 'zNdFbJN1hXNYM90VIK1UTy', 'ICGD TOPDOGS ROUND NECK', 'TD'),
(150, 'Qp70N3zJ3NnKJIOyrF1VGl', 'ICGD TOPDOGS', 'TD'),
(151, 'hUh69efBu0scDCgYsl6oef', 'ICGD TOPDOGS', 'ICGD TD'),
(152, '160sbuqsxug8kEeulXWlyC', 'ICGD TOPDOGS', 'ICGDTD'),
(153, 'tEOx9xNusamyDmgAmNWDHo', 'IFDG FACEMASK WHITE FREE SIZE \r\n', 'IFGDWHITE'),
(154, 'tEOx9xNusamyDmgAmNWDHo', 'IFDG FACEMASK BLACK FREE SIZE \n', 'IFGDBLACK');

-- --------------------------------------------------------

--
-- Table structure for table `cart_release`
--

CREATE TABLE `cart_release` (
  `cart_id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `item_code` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL,
  `time_stamp` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 = pending\r\n1 = approved\r\n2 = cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart_restocking`
--

CREATE TABLE `cart_restocking` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `product_sku` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `retail_price` varchar(255) DEFAULT NULL,
  `original_price` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `expiration` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `date_added` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT 'new = 1 ,\r\nadd to stock = 2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_restocking`
--

INSERT INTO `cart_restocking` (`id`, `uid`, `product_sku`, `quantity`, `retail_price`, `original_price`, `manufacturer`, `expiration`, `description`, `user_id`, `date_added`, `status`) VALUES
(1, '577207308284', 'SHS004HSPRMPINK150G', '2488', '150.00', '31.00', 'LEOMIE JHOY SOAP MFTG', '', '', '61a5caf447cae', '2022/04/13 10:55:07', 2),
(2, '577207308284', 'SHS004HSPRMPINK150G', '2351', '150.00', '31.00', 'LEOMIE JHOY SOAP MFTG', '', '', '61a5caf447cae', '2022/04/13 10:57:41', 2),
(3, '698562504594', 'SHS004HSPRMBLUE150G', '2488', '150.00', '31.00', 'LEOMIE JHOY SOAP MFTG', '', '', '61a5caf447cae', '2022/04/13 10:58:07', 2),
(4, '389509193021', 'SDS002DSPRMYP150 G', '14653', '150.00', '31.00', 'LEOMIE JHOY SOAP MFTG', '', '', '61a5caf447cae', '2022/04/13 11:06:13', 2),
(5, '610840330961', 'SDS002DSPRMORIG150 G', '5192', '150.00', '31.00', 'LEOMIE JHOY MFTG', '', '', '61a5caf447cae', '2022/04/13 11:06:51', 2),
(6, '305096204785', 'SDS002DSPRMMC150 G', '15679', '150.00', '31.00', '', '', '', '61a5caf447cae', '2022/04/13 11:08:26', 2),
(7, '295065421248', 'SDS002DSPRMAC150 G', '6152', '150.00', '31.00', 'LEOMIE JHOY SOAP MFTG', '', '', '61a5caf447cae', '2022/04/13 11:09:37', 2),
(8, '709591752686', 'SDN001DFPRMORIG5KG', '4873', '1100.00', '452.95', 'PET ONE, INC', '', '', '61a5caf447cae', '2022/04/13 11:10:13', 2),
(9, '673068742688', 'SDN001DFPRMORIG500G', '431', '200', '79.80', 'PET ONE, INC', '', '', '61a5caf447cae', '2022/04/13 11:10:44', 2),
(10, '503263540983', 'SDN001DFPRMORIG15KG', '3323', '3245.00', '1347.65', 'PET ONE, INC', '', '', '61a5caf447cae', '2022/04/13 11:11:39', 2),
(11, '460191712132', 'SCB003DSPRMSCB150G', '18813', '150.00', '28.50', 'LEOMIE JHOY SOAP MFTG', '', '', '61a5caf447cae', '2022/04/13 11:12:32', 2),
(12, '152418113111', 'POT004DPPRMPOT150 G ', '1083', '150.00', '70.00', '', '', '', '61a5caf447cae', '2022/04/13 11:12:54', 2),
(13, '116890230329', 'MS022MERCHTSMSBRXS', '7', '500', '157', '', '', '', '61a5caf447cae', '2022/04/13 11:13:32', 2),
(14, '754664155939', 'MS022MERCHTSMSBRS', '12', '500', '157', '', '', '', '61a5caf447cae', '2022/04/13 11:13:53', 2),
(15, '036184520117', 'MS022MERCHTSMSBRM', '22', '500', '157', '', '', '', '61a5caf447cae', '2022/04/13 11:33:16', 2),
(16, '344970933874', 'MK9UMB014MERCHUMBUMBWHITEFS', '37', '200.00', '100.00', '', '', '', '61a5caf447cae', '2022/04/13 11:35:07', 2),
(17, '085243664870', 'MK9MC015MERCHMCMCBWFS', '82', '200.00', '85.00', '', '', '', '61a5caf447cae', '2022/04/13 11:35:37', 2),
(20, '337284131266', 'MK9020MERCHMGMAGICMUGFS', '48', '350.00', '99.00', '', '', '', '61a5caf447cae', '2022/04/13 11:46:30', 2),
(21, '024433665861', 'MK9020MERCHMGMANALOK9LOGOMUGFS', '92', '200.00', '74.00', '', '', '', '61a5caf447cae', '2022/04/13 11:47:01', 2),
(22, '907192492323', 'MK9020MERCHMGSUPPERDOGGERSMUGFS', '36', '250.00', '100.00', '', '', '', '61a5caf447cae', '2022/04/13 11:47:23', 2),
(23, '072989953372', 'MK9017MERCHCOLLARPUPPYELLOWAS', '13', '1100.00', '500.00', '', '', '', '61a5caf447cae', '2022/04/13 12:56:45', 2),
(24, '684322337198', 'MK9017MERCHCOLLARPUPPREDPPS', '12', '1100.00', '500', '', '', '', '61a5caf447cae', '2022/04/13 12:57:23', 2),
(25, '606477495407', 'MK9017MERCHCOLLARPUPPGRAYPPS', '9', '1100.00', '500.00', '', '', '', '61a5caf447cae', '2022/04/13 12:57:53', 2),
(26, '942301192534', 'MK9017MERCHCOLLARPUPPBROWNPPS', '8', '1100.00', '500.00', '', '', '', '61a5caf447cae', '2022/04/13 12:58:10', 2),
(27, '465699736305', 'MK9017MERCHCOLLARPUPPBLACKPPS', '18', '1100.00', '500.00', '', '', '', '61a5caf447cae', '2022/04/13 12:58:31', 2),
(28, '892182929487', 'MK9017MERCHCOLLARPUPPARMYGREENPPS', '13', '1100.00', '500.00', '', '', '', '61a5caf447cae', '2022/04/13 12:58:51', 2),
(29, '709101705714', 'MK9017MERCHCOLLARBLACKAS', '36', '2200.00', '800.00', '', '', '', '61a5caf447cae', '2022/04/13 12:59:36', 2),
(30, '918793886681', 'MK9017MERCHCOLLARBEIGEAS', '15', '2200.00', '800.00', '', '', '', '61a5caf447cae', '2022/04/13 13:00:04', 2),
(31, '740127167506', 'MK9017MERCHCOLLARARMYGREENAS', '23', '2200.00', '800.00', '', '', '', '61a5caf447cae', '2022/04/13 13:00:27', 2),
(33, '752730284099', 'MK9016MERCHLEASHPUPPYELLOWPPS', '13', '1000.00', '320.00', '', '', '', '61a5caf447cae', '2022/04/13 13:00:56', 2),
(34, '084864035440', 'MK9016MERCHLEASHPUPPREDPPS', '11', '1000.00', '320.00', '', '', '', '61a5caf447cae', '2022/04/13 13:01:23', 2),
(35, '046419359251', 'MK9016MERCHLEASHPUPPGRAYPPS', '11', '1000.00', '320.00', '', '', '', '61a5caf447cae', '2022/04/13 13:01:42', 2),
(36, '744832546774', 'MK9016MERCHLEASHPUPPBROWNPPS', '7', '1000.00', '320.00', '', '', '', '61a5caf447cae', '2022/04/13 13:02:09', 2),
(37, '485472207141', 'MK9016MERCHLEASHPUPPARMYGREENPPS', '13', '1000.00', '320.00', '', '', '', '61a5caf447cae', '2022/04/13 13:07:40', 2),
(40, '269500872673', 'MK9016MERCHLEASHBEIGEAS', '10', '1200.00', '450.00', '', '', '', '61a5caf447cae', '2022/04/13 13:22:07', 2),
(41, '383840947492', 'MK9016MERCHLEASHARMYGREENAS', '18', '1200.00', '450.00', '', '', '', '61a5caf447cae', '2022/04/13 13:22:33', 2),
(42, '130001403748', 'MK9016MERCHLEASHPUPPBLACKPPS', '18', '1000.00', '320.00', '', '', '', '61a5caf447cae', '2022/04/13 13:33:15', 2),
(43, '217842264471', 'MK9016MERCHLEASHBLACKAS', '10', '1200.00', '450.00', '', '', '', '61a5caf447cae', '2022/04/13 13:34:56', 2),
(44, '488979674166', 'MK9012MERCHFMMK9REDFS', '73', '150.00', '37.50', '', '', '', '61a5caf447cae', '2022/04/13 13:36:29', 2),
(45, '037283241294', 'MK9012MERCHFMMK9GRAYFS', '94', '150.00', '37.50', '', '', '', '61a5caf447cae', '2022/04/13 13:37:09', 2),
(46, '334938794184', 'MK9012MERCHFMMK9GOLDREDFS', '89', '150.00', '37.50', '', '', '', '61a5caf447cae', '2022/04/13 13:37:40', 2),
(47, '727034093861', 'MK9012MERCHFMMK9BLACKFS', '63', '150.00', '37.50', '', '', '', '61a5caf447cae', '2022/04/13 13:38:03', 2),
(48, '416711264764', 'MK9012MERCHFMICGDWHITEFS', '130', '150.00', '37.50', '', '', '', '61a5caf447cae', '2022/04/13 13:38:35', 2),
(49, '669944895489', 'MK9012MERCHFMICGDBLACKFS', '100', '150.00', '37.50', '', '', '', '61a5caf447cae', '2022/04/13 13:39:00', 2),
(51, '968946069589', 'MK9 013MERCHSPOJUGWHITEFS', '48', '250.00', '65.00', '', '', '', '61a5caf447cae', '2022/04/13 13:40:27', 2),
(52, '823244491743', 'MK9 013MERCHSPOJUGSILVERFS', '44', '250.00', '65.00', '', '', '', '61a5caf447cae', '2022/04/13 13:41:09', 2),
(53, '164769382756', 'MK90021MERCHCANBAGCANBAG10', '118', '150.00', '65.00', '', '', '', '61a5caf447cae', '2022/04/13 13:41:48', 2),
(54, '960733129264', 'MS022MERCHTSMSBRL', '21', '500.00', '157.00', '', '', '', '61a5caf447cae', '2022/04/13 13:54:18', 2),
(55, '042699371240', 'MS022MERCHTSMSBRXL', '10', '500.00', '157.00', '', '', '', '61a5caf447cae', '2022/04/13 13:54:47', 2),
(56, '465903384435', 'MS022MERCHTSMSBR2XL', '5', '500.00', '157.00', '', '', '', '61a5caf447cae', '2022/04/13 13:55:13', 2),
(57, '603093634198', 'MK9008MERCHTSSDXS', '5', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:10:48', 2),
(58, '317770704841', 'MK9008MERCHTSSDS', '4', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:11:14', 2),
(59, '277624416384', 'MK9009MERCHTSWADS', '1', '123.81', '350.00', '', '', '', '61a5caf447cae', '2022/04/13 14:20:00', 2),
(60, '466107403295', 'MK9009MERCHTSWADM', '6', '123.81', '350.00', '', '', '', '61a5caf447cae', '2022/04/13 14:20:26', 2),
(61, '291156290831', 'MK9009MERCHTSWADL', '3', '123.81', '350.00', '', '', '', '61a5caf447cae', '2022/04/13 14:20:45', 2),
(62, '070549738720', 'MK9009MERCHTSWADXL', '2', '123.81', '350.00', '', '', '', '61a5caf447cae', '2022/04/13 14:21:02', 2),
(63, '538124072215', 'MK9009MERCHTSWADXXL', '2', '123.81', '350.00', '', '', '', '61a5caf447cae', '2022/04/13 14:21:22', 2),
(64, '660806621749', 'MK9010MERCHSANDOYPSS', '2', '350.00', '123.81', '', '', '', '61a5caf447cae', '2022/04/13 14:22:20', 2),
(65, '313643673607', 'MK9010MERCHSANDOYPSM', '1', '350.00', '123.81', '', '', '', '61a5caf447cae', '2022/04/13 14:22:39', 2),
(66, '796275537042', 'MK9010MERCHSANDOYPSL', '4', '350.00', '123.81', '', '', '', '61a5caf447cae', '2022/04/13 14:23:02', 2),
(67, '969935535812', 'MK9010MERCHSANDOYPSXL', '5', '350.00', '123.81', '', '', '', '61a5caf447cae', '2022/04/13 14:23:31', 2),
(68, '799845854119', 'MK9010MERCHSANDOYPSXXL', '4', '350.00', '123.81', '', '', '', '61a5caf447cae', '2022/04/13 14:23:50', 2),
(69, '090173154793', 'MK9011MERCHSANDOPAWSITIVES', '2', '350.00', '123.81', '', '', '', '61a5caf447cae', '2022/04/13 14:24:23', 2),
(70, '709737765784', 'MK9011MERCHSANDOPAWSITIVEM', '5', '350.00', '123.81', '', '', '', '61a5caf447cae', '2022/04/13 14:24:41', 2),
(71, '000445190858', 'MK9011MERCHSANDOPAWSITIVEL', '1', '350.00', '123.81', '', '', '', '61a5caf447cae', '2022/04/13 14:24:58', 2),
(72, '455256666493', 'MK9011MERCHSANDOPAWSITIVEXL', '4', '350.00', '123.81', '', '', '', '61a5caf447cae', '2022/04/13 14:25:16', 2),
(73, '661660666766', 'MK9011MERCHSANDOPAWSITIVEXXL', '2', '350.00', '123.81', '', '', '', '61a5caf447cae', '2022/04/13 14:28:36', 2),
(74, '267201450035', 'MK9005MERCHTSVNECKS', '38', '500.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:29:20', 2),
(75, '836978213027', 'MK9005MERCHTSVNECKM', '36', '500.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:29:42', 2),
(76, '348261321516', 'MK9005MERCHTSVNECKL', '29', '500.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:30:04', 2),
(77, '268332374368', 'MK9005MERCHTSVNECKXL', '38', '500.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:30:22', 2),
(78, '849855046474', 'MK9006MERCHTSROUNDXS', '28', '500.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:31:45', 2),
(79, '163889315201', 'MK9006MERCHTSROUNDS', '6', '500.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:32:04', 2),
(80, '545199272285', 'MK9006MERCHTSROUNDM', '33', '500.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:32:26', 2),
(81, '678267141100', 'MK9006MERCHTSROUNDL', '29', '500.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:41:31', 2),
(82, '551309602225', 'MK9006MERCHTSROUNDXL', '24', '500.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:41:53', 2),
(83, '619058165690', 'MK9006MERCHTSROUND2XL', '2', '500.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:42:26', 2),
(84, '704992641756', 'MK9007MERCHTSICGDXS', '19', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:43:12', 2),
(85, '833259988634', 'MK9007MERCHTSICGDS', '19', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:44:13', 2),
(86, '181222203997', 'MK9007MERCHTSICGDM', '10', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:44:56', 2),
(87, '827093288321', 'MK9007MERCHTSICGDL', '5', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:45:16', 2),
(88, '398071086767', 'MK9007MERCHTSICGDXL', '7', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:45:31', 2),
(89, '347071073154', 'MK9007MERCHTSICGD2XL', '38', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:45:52', 2),
(94, '574166262403', 'MK9008MERCHTSSDXXL', '15', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 14:56:19', 2),
(95, '478607429771', 'MK9015MERCHMCBLACK&WHITEFS', '82', '200.00', '85.00', '', '', '', '61a5caf447cae', '2022/04/13 14:58:59', 2),
(96, '369348302449', 'MK9014MERCHUMBWHITEFS', '37', '200.00', '100.00', '', '', '', '61a5caf447cae', '2022/04/13 15:00:35', 2),
(97, '009841685129', 'IFGD024MERCHFMIFGDWHITEFREE SIZE', '40', '150.00', '37.50', '', '', '', '61a5caf447cae', '2022/04/13 15:30:10', 2),
(98, '569999405760', 'IFGD024MERCHFMIFGDBLACKFREE SIZE', '30', '150.00', '37.50', '', '', '', '61a5caf447cae', '2022/04/13 15:30:32', 2),
(99, '211290277824', 'MK9023MERCHTSICGDTDXS', '10', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 15:55:19', 2),
(101, '048382164970', 'MK9023MERCHTSICGDTDS', '13', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 16:08:28', 2),
(102, '948715985404', 'MK9023MERCHTSICGDTDM', '9', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 16:08:46', 2),
(103, '405236586071', 'MK9023MERCHTSICGDTDL', '2', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 16:09:09', 2),
(104, '214511744193', 'MK9023MERCHTSICGDTDXL', '11', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 16:09:28', 2),
(105, '769702833908', 'MK9023MERCHTSICGDTDXXL', '7', '350.00', '157.40', '', '', '', '61a5caf447cae', '2022/04/13 16:09:44', 2);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ID` int(11) NOT NULL,
  `ClientNo` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `TIN` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `CityStateProvinceZip` varchar(255) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `ContactNum` varchar(255) DEFAULT NULL,
  `Category` int(11) DEFAULT NULL COMMENT '0=confirmedDistributor;\r\n1=distributorOnProbation;\r\n2=directDealer;\r\n3=directEndUser;',
  `TerritoryManager` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`ID`, `ClientNo`, `Name`, `TIN`, `Address`, `CityStateProvinceZip`, `Country`, `ContactNum`, `Category`, `TerritoryManager`, `Email`, `Status`) VALUES
(1, 'C625D04AF6BB91', 'test', '12346478897881', 'tes 12', 'cainta', 'philippines', '001916232', 2, 'test', 'test@gmail.com', 0),
(2, 'C625D04AF6BFCD', 'test', '12346478897881', 'tes 12', 'cainta', 'philippines', '001916232', 2, 'test', 'test@gmail.com', 0),
(3, 'C626CE0D8DADE3', 'John', '123 456 789 000', '123 Test', 'Antipolo', 'Philippines', '09123456789', 0, 'Test', 'john@email.com', 1),
(4, 'C62729A8CD3F5E', 'tet', '', 'test', '', '', '0452045', 0, '', '', 1),
(5, 'C62729C48C52B7', 'Test', '', 'Try', '', '', '0123', 0, '', '', 1),
(6, 'C62729C728607E', 'test', '', 'test', '', '', '0', 0, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `ID` int(11) NOT NULL,
  `InvoiceNo` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Amount` varchar(255) DEFAULT NULL,
  `ModeOfPayment` varchar(255) DEFAULT NULL,
  `Date` varchar(50) DEFAULT NULL,
  `OrderNo` varchar(255) DEFAULT NULL,
  `Status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `ID` int(11) NOT NULL,
  `JournalNo` varchar(32) DEFAULT NULL,
  `Date` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Total` varchar(255) DEFAULT NULL,
  `Type` varchar(127) DEFAULT NULL,
  `OrderNo` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`ID`, `JournalNo`, `Date`, `Description`, `Total`, `Type`, `OrderNo`) VALUES
(1, 'JT6270E9A3C70A9', '2022-05-03', 'Payment of rent', '1000', NULL, NULL),
(2, 'JT6270E9C440169', '2022-05-03', 'Cash Sales from customer, recorded using sales order', '2000', NULL, NULL),
(3, 'JT6270E9E97B69E', '2022-05-03', 'Purchase of dogfood on account , recorded using purchase order', '3000', NULL, NULL),
(4, 'JT6270E9F76608E', '2022-05-03', 'Purchase of office supplies', '1500', NULL, NULL),
(5, 'JT6270EA053C5CB', '2022-05-03', 'Payment of  utilities', '1000', NULL, NULL),
(6, 'JT6270EA1DC5264', '2022-05-03', 'Sales on credit', '2000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `journal_transactions`
--

CREATE TABLE `journal_transactions` (
  `ID` int(11) NOT NULL,
  `JournalID` int(11) DEFAULT NULL,
  `AccountID` int(11) DEFAULT NULL,
  `Debit` varchar(31) DEFAULT NULL,
  `Credit` varchar(31) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal_transactions`
--

INSERT INTO `journal_transactions` (`ID`, `JournalID`, `AccountID`, `Debit`, `Credit`) VALUES
(1, 1, 1, '1000', '0'),
(2, 1, 2, '0', '1000'),
(3, 2, 2, '2000', '0'),
(4, 2, 3, '0', '2000'),
(5, 3, 4, '3000', '0'),
(6, 3, 5, '0', '3000'),
(7, 4, 6, '1500', '0'),
(8, 4, 2, '0', '1500'),
(9, 5, 7, '1000', '0'),
(10, 5, 2, '0', '1000'),
(11, 6, 8, '2000', '0'),
(12, 6, 3, '0', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `logbook`
--

CREATE TABLE `logbook` (
  `ID` int(11) NOT NULL,
  `Event` text DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `UserID` varchar(255) DEFAULT NULL,
  `PageURL` varchar(255) DEFAULT NULL,
  `DateAdded` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logbook`
--

INSERT INTO `logbook` (`ID`, `Event`, `Description`, `UserID`, `PageURL`, `DateAdded`) VALUES
(1, 'logged in.', '', '61a5caf447cae', '', '2021-12-17 11:14:08 AM'),
(2, 'logged in.', '', '61a5caf447cae', '', '2021-12-18 01:59:10 PM'),
(3, 'logged in.', '', '61a5caf447cae', '', '2021-12-18 02:03:59 PM'),
(4, 'created a new product.', 'added a new product test [Code: SDN001DFOPRSDNDF55KG].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2021-12-18 02:26:14 PM'),
(5, 'created a new product.', 'added a new product sdn5kg [Code: SDN001DFOPRSDNDF55KG].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2021-12-18 02:58:37 PM'),
(6, 'logged in.', '', '61a5caf447cae', '', '2021-12-18 03:21:27 PM'),
(7, 'logged in.', '', '61a5caf447cae', '', '2021-12-18 03:22:17 PM'),
(8, 'created a new product.', 'added a new product SDN ORIG [Code: SDN001DFOPRORIG5KG].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2021-12-18 03:39:37 PM'),
(9, 'created a new product.', 'added a new product SDN ORIGINAL [Code: SDN001DFOPRORIG15KG].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2021-12-18 04:02:23 PM'),
(10, 'logged in.', '', '61a5caf447cae', '', '2021-12-20 02:38:17 PM'),
(11, 'logged in.', '', '61a5caf447cae', '', '2021-12-21 10:29:50 AM'),
(12, 'logged in.', '', '61a5caf447cae', '', '2021-12-21 11:07:37 AM'),
(13, 'created a new product.', 'added a new product SDS 5in1 [Code: SDS002DSPRM5IN1150G].', NULL, 'https://inventory-system-test.000webhostapp.com/admin/products', '2021-12-21 03:30:30 PM'),
(14, 'created a new product.', 'added a new product SDS YOUNG PUPPY [Code: SDS002DSPRMAC150G].', NULL, 'https://inventory-system-test.000webhostapp.com/admin/products', '2021-12-21 03:39:12 PM'),
(15, 'created a new product.', 'added a new product YP [Code: SDS002DSPRMYP150G].', NULL, 'https://inventory-system-test.000webhostapp.com/admin/products', '2021-12-21 03:40:08 PM'),
(16, 'created a new product.', 'added a new product MC [Code: SDS002DSPRMMC150G].', NULL, 'https://inventory-system-test.000webhostapp.com/admin/products', '2021-12-21 03:41:07 PM'),
(17, 'created a new product.', 'added a new product SCB [Code: SDS002DSPRMSCB150G].', NULL, 'https://inventory-system-test.000webhostapp.com/admin/products', '2021-12-21 03:53:37 PM'),
(18, 'logged in.', '', '61a5caf447cae', '', '2021-12-21 04:35:03 PM'),
(19, 'logged in.', '', '61a5caf447cae', '', '2021-12-21 04:53:43 PM'),
(20, 'logged in.', '', '61a5caf447cae', '', '2021-12-22 05:59:33 PM'),
(21, 'logged in.', '', '61a5caf447cae', '', '2021-12-27 04:32:59 PM'),
(22, 'logged in.', '', '61a5caf447cae', '', '2021-12-29 09:23:57 PM'),
(23, 'logged out.', '', '61a5caf447cae', '', '2021-12-29 09:28:03 PM'),
(24, 'logged in.', '', '61a5caf447cae', '', '2021-12-29 09:28:07 PM'),
(25, 'updated user details.', 'updated details of user John Rogers Doe [UserID: 61a5caf447cae].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2021-12-29 09:33:43 PM'),
(26, 'logged out.', '', '61a5caf447cae', '', '2021-12-29 09:33:54 PM'),
(27, 'logged in.', '', '61a5caf447cae', '', '2021-12-29 09:34:11 PM'),
(28, 'logged in.', '', '61a5caf447cae', '', '2022-01-07 08:51:00 PM'),
(29, 'logged in.', '', '61a5caf447cae', '', '2022-01-10 03:28:03 PM'),
(30, 'logged in.', '', '61a5caf447cae', '', '2022-01-10 03:58:08 PM'),
(31, 'logged in.', '', '61a5caf447cae', '', '2022-01-11 08:10:49 AM'),
(32, 'logged in.', '', '61a5caf447cae', '', '2022-01-11 02:07:37 PM'),
(33, 'created a new product.', 'added a new product SDN DOGFOOD ORIGINAL 5KG\r\n [Code: SDN001DFPRMORIG5KG].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-11 02:40:06 PM'),
(34, 'created a new product.', 'added a new product SDN DOGFOOD ORIGINAL  15KG\r\n [Code: SDN001DFPRMORIG15KG].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-11 03:05:48 PM'),
(35, 'created a new product.', 'added a new product SDN DOGFOOD  ORIGINAL 500G\r\n [Code: SDN001DFPRMORIG500G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-11 03:08:59 PM'),
(36, 'logged in.', '', '61a5caf447cae', '', '2022-01-12 09:54:40 AM'),
(37, 'logged in.', '', '61a5caf447cae', '', '2022-01-12 03:22:23 PM'),
(38, 'logged in.', '', '61a5caf447cae', '', '2022-01-13 09:59:05 AM'),
(39, 'logged in.', '', '61a5caf447cae', '', '2022-01-13 11:19:34 AM'),
(40, 'created a new product.', 'added a new product MK9 T-SHIRT V-NECK EXTRA SMALL\r\n [Code: MK9005MERCHTSMK9LXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 01:29:09 PM'),
(41, 'created a new product.', 'added a new product SDS ACTIVATED CHARCOAL 150G \r\n [Code: SDS002DSPRMAC150G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 01:32:22 PM'),
(42, 'logged out.', '', '61a5caf447cae', '', '2022-01-13 01:33:02 PM'),
(43, 'logged in.', '', '61a5caf447cae', '', '2022-01-13 01:33:09 PM'),
(44, 'created a new product.', 'added a new product ORIGINAL [Code: SDN001DFPRMORIG500G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 02:00:03 PM'),
(45, 'created a new product.', 'added a new product ORIGINAL [Code: SDN001DFPRMORIG5KG].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 02:01:27 PM'),
(46, 'created a new product.', 'added a new product ORIGINAL [Code: SDN001DFPRMORIG15KG].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 02:02:20 PM'),
(47, 'created a new product.', 'added a new product THE ONLY SOAP FOR SUPERPUPPIES [Code: SDS002DSPRMYP150 G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 02:07:46 PM'),
(48, 'created a new product.', 'added a new product THE ONLY SOAP FOR SUPERDOGS [Code: SDS002DSPRMMC150 G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 02:10:02 PM'),
(49, 'created a new product.', 'added a new product THE ONLY SOAP FOR SUPERDOGS [Code: SDS002DSPRMORIG150 G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 02:11:34 PM'),
(50, 'created a new product.', 'added a new product YOUNG PUPPIES\r\n [Code: SDS002DSPRMYP150 G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 02:20:46 PM'),
(51, 'created a new product.', 'added a new product MINTY COOL [Code: SDS002DSPRMMC150 G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 02:21:41 PM'),
(52, 'created a new product.', 'added a new product 5 IN1 ORIGINAL (RED)\r\n [Code: SDS002DSPRMORIG150 G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 02:22:56 PM'),
(53, 'created a new product.', 'added a new product ACTIVATED CHARCOAL [Code: SDS002DSPRMAC150 G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 02:23:30 PM'),
(54, 'created a new product.', 'added a new product SHAMPOO AND CONDITIONER \r\n [Code: SDS002DSPRMSCB150 G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 02:24:31 PM'),
(55, 'created a new product.', 'added a new product POWTECH [Code: POT004DPPRMPOT150 G ].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 02:41:26 PM'),
(56, 'created a new product.', 'added a new product V-NECK | MANALOK9 LOGO\r\n [Code: MK9005MERCHTSVNXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 02:55:15 PM'),
(57, 'logged in.', '', '61a5caf447cae', '', '2022-01-13 02:56:16 PM'),
(58, 'logged out.', '', '61a5caf447cae', '', '2022-01-13 02:56:34 PM'),
(59, 'created a new product.', 'added a new product V-NECK | MANALOK9 LOGO [Code: MK9005MERCHTSVNECKXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 03:05:20 PM'),
(60, 'created a new product.', 'added a new product V-NECK | MANALOK9 LOGO [Code: MK9005MERCHTSVNECKS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 03:10:36 PM'),
(61, 'created a new product.', 'added a new product V-NECK | MANALOK9 LOGO [Code: MK9005MERCHTSVNECKM].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 03:12:14 PM'),
(62, 'created a new product.', 'added a new product V-NECK | MANALOK9 LOGO [Code: MK9005MERCHTSVNECKL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 03:13:19 PM'),
(63, 'created a new product.', 'added a new product V-NECK | MANALOK9 LOGO [Code: MK9005MERCHTSVNECKXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 03:14:25 PM'),
(64, 'created a new product.', 'added a new product  V-NECK | MANALOK9 LOGO [Code: MK9005MERCHTSVNECK2XL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-13 03:15:42 PM'),
(65, 'logged in.', '', '61a5caf447cae', '', '2022-01-24 03:28:49 PM'),
(66, 'logged in.', '', '61a5caf447cae', '', '2022-01-26 08:36:20 AM'),
(67, 'created a new product.', 'added a new product ORIGINAL [Code: SDN001DFPRMORIG500G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 10:54:08 AM'),
(68, 'logged in.', '', '61a5caf447cae', '', '2022-01-26 01:10:26 PM'),
(69, 'created a new product.', 'added a new product ORIGINAL [Code: SDN001DFPRMORIG5KG].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 01:10:56 PM'),
(70, 'created a new product.', 'added a new product ORIGINAL [Code: SDN001DFPRMORIG15KG].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 01:11:51 PM'),
(71, 'created a new product.', 'added a new product SHAMPOO AND CONDITIONER BAR [Code: SCB003DSPRMSCB150G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 01:21:10 PM'),
(72, 'created a new product.', 'added a new product YP [Code: SDS002DSPRMYP150 G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 01:22:35 PM'),
(73, 'created a new product.', 'added a new product MC [Code: SDS002DSPRMMC150 G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 01:24:36 PM'),
(74, 'created a new product.', 'added a new product 5 IN1 ORIGINAL [Code: SDS002DSPRMORIG150 G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 01:25:58 PM'),
(75, 'created a new product.', 'added a new product AC [Code: SDS002DSPRMAC150 G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 01:26:40 PM'),
(76, 'created a new product.', 'added a new product SCB [Code: SCB003DSPRMSCB150G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 01:27:11 PM'),
(77, 'created a new product.', 'added a new product POWTECH [Code: POT004DPPRMPOT150 G ].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 01:33:03 PM'),
(78, 'created a new product.', 'added a new product SHS BLUE  [Code: SHS004HSPRMBLUE150].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 02:27:46 PM'),
(79, 'created a new product.', 'added a new product SHS PINK [Code: SHS004HSPRMPINK150].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 02:29:41 PM'),
(80, 'created a new product.', 'added a new product SHS BLUE [Code: SHS004HSPRMBLUE150G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 02:35:48 PM'),
(81, 'created a new product.', 'added a new product SHS PINK [Code: SHS004HSPRMPINK150G].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 02:36:42 PM'),
(82, 'created a new product.', 'added a new product MK9 LOGO | XS [Code: MK9005MERCHTSVNECKXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 02:53:43 PM'),
(83, 'created a new product.', 'added a new product MK9 LOGO | S [Code: MK9005MERCHTSVNECKS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-26 03:18:05 PM'),
(84, 'logged in.', '', '61a5caf447cae', '', '2022-01-27 10:20:36 AM'),
(85, 'created a new product.', 'added a new product MK9 LOGO | M [Code: MK9005MERCHTSVNECKM].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-27 10:27:36 AM'),
(86, 'created a new product.', 'added a new product MK9 LOGO | L [Code: MK9005MERCHTSVNECKL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-27 10:30:15 AM'),
(87, 'created a new product.', 'added a new product MK9 LOGO | XL [Code: MK9005MERCHTSVNECKXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-27 10:30:51 AM'),
(88, 'created a new product.', 'added a new product MK9 LOGO | 2XL [Code: MK9005MERCHTSVNECK2XL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-27 10:31:35 AM'),
(89, 'logged in.', '', '61a5caf447cae', '', '2022-01-28 01:17:55 PM'),
(90, 'created a new product.', 'added a new product MK9 LOGO | XS [Code: MK9006MERCHTSROUNDXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-28 01:26:37 PM'),
(91, 'created a new product.', 'added a new product MK9 LOGO | S [Code: MK9006MERCHTSROUNDS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-28 01:27:50 PM'),
(92, 'created a new product.', 'added a new product MK9 LOGO | M [Code: MK9006MERCHTSROUNDM].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-28 01:29:00 PM'),
(93, 'created a new product.', 'added a new product MK9 LOGO | L [Code: MK9006MERCHTSROUNDL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-28 01:29:33 PM'),
(94, 'created a new product.', 'added a new product MK9 LOGO | XL [Code: MK9006MERCHTSROUNDXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-28 01:30:17 PM'),
(95, 'created a new product.', 'added a new product MK9 LOGO | 2XL [Code: MK9006MERCHTSROUND2XL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-28 01:30:55 PM'),
(96, 'logged in.', '', '61a5caf447cae', '', '2022-01-29 11:00:00 AM'),
(97, 'logged in.', '', '61a5caf447cae', '', '2022-01-29 02:36:47 PM'),
(98, 'created a new registration token.', 'created a new registration token.', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/register?token=54288fe214a94b1d37a25982162b52042ba11bd2fa05352d\">', '2022-01-29 03:15:51 PM'),
(99, 'created a new registration token.', 'created a new registration token.', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/register?token=9a060bd97ad97d59bb5dc73f2bdff99fa4501e9a59b476c3\">', '2022-01-29 03:17:22 PM'),
(100, 'logged in.', '', '61a5caf447cae', '', '2022-01-29 03:33:25 PM'),
(101, 'created a new product.', 'added a new product SDN  [Code: SDN001DFPRMORIG1KG].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-01-29 03:55:19 PM'),
(102, 'logged out.', '', '61a5caf447cae', '', '2022-01-29 04:14:23 PM'),
(103, 'logged in.', '', '61a5caf447cae', '', '2022-01-31 09:17:31 AM'),
(104, 'logged in.', '', '61a5caf447cae', '', '2022-02-03 11:10:59 AM'),
(105, 'logged in.', '', '61a5caf447cae', '', '2022-02-03 11:47:39 AM'),
(106, 'logged in.', '', '61a5caf447cae', '', '2022-02-04 10:20:50 AM'),
(107, 'logged in.', '', '61a5caf447cae', '', '2022-02-04 01:30:40 PM'),
(108, 'logged in.', '', '61a5caf447cae', '', '2022-02-04 01:47:20 PM'),
(109, 'created a new product.', 'added a new product ICGD LOGO | XS [Code: MK9007MERCHTSICGD LOGOXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-04 02:11:57 PM'),
(110, 'logged in.', '', '61a5caf447cae', '', '2022-02-04 02:14:19 PM'),
(111, 'logged in.', '', '61a5caf447cae', '', '2022-02-04 02:14:19 PM'),
(112, 'logged out.', '', '61a5caf447cae', '', '2022-02-04 02:21:03 PM'),
(113, 'logged in.', '', '61a5caf447cae', '', '2022-02-04 02:21:10 PM'),
(114, 'logged out.', '', '61a5caf447cae', '', '2022-02-04 02:27:20 PM'),
(115, 'logged in.', '', '61a5caf447cae', '', '2022-02-04 03:56:58 PM'),
(116, 'logged out.', '', '61a5caf447cae', '', '2022-02-04 04:14:20 PM'),
(117, 'logged in.', '', '61a5caf447cae', '', '2022-02-04 04:14:29 PM'),
(118, 'logged in.', '', '61a5caf447cae', '', '2022-02-07 09:12:39 AM'),
(119, 'logged out.', '', '61a5caf447cae', '', '2022-02-07 10:48:51 AM'),
(120, 'logged in.', '', '61a5caf447cae', '', '2022-02-07 10:49:06 AM'),
(121, 'logged in.', '', '61a5caf447cae', '', '2022-02-07 10:49:30 AM'),
(122, 'logged in.', '', '61a5caf447cae', '', '2022-02-07 10:53:45 AM'),
(123, 'logged in.', '', '61a5caf447cae', '', '2022-02-07 10:54:01 AM'),
(124, 'logged out.', '', '61a5caf447cae', '', '2022-02-07 10:56:40 AM'),
(125, 'logged out.', '', '61a5caf447cae', '', '2022-02-07 10:57:11 AM'),
(126, 'logged in.', '', '61a5caf447cae', '', '2022-02-09 10:20:11 AM'),
(127, 'created a new product.', 'added a new product ICGD LOGO | XS [Code: MK9007MERCHTSICGDXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-09 10:36:15 AM'),
(128, 'created a new product.', 'added a new product ICGD LOGO | S [Code: MK9007MERCHTSICGDS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-09 11:00:16 AM'),
(129, 'created a new product.', 'added a new product ICGD LOGO | M [Code: MK9007MERCHTSICGDM].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-09 11:01:53 AM'),
(130, 'created a new product.', 'added a new product ICGD LOGO | XL [Code: MK9007MERCHTSICGDL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-09 11:02:48 AM'),
(131, 'created a new product.', 'added a new product ICGD LOGO | L [Code: MK9007MERCHTSICGDL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-09 11:05:28 AM'),
(132, 'created a new product.', 'added a new product ICGD LOGO | XL [Code: MK9007MERCHTSICGDXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-09 11:06:59 AM'),
(133, 'created a new product.', 'added a new product ICGD LOGO | 2XL [Code: MK9007MERCHTSICGD2XL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-09 11:08:27 AM'),
(134, 'logged in.', '', '61a5caf447cae', '', '2022-02-10 09:49:30 AM'),
(135, 'logged in.', '', '61a5caf447cae', '', '2022-02-14 09:05:04 AM'),
(136, 'logged in.', '', '61a5caf447cae', '', '2022-02-14 11:23:20 AM'),
(137, 'logged in.', '', '61a5caf447cae', '', '2022-02-16 09:14:32 AM'),
(138, 'created a new product.', 'added a new product SUPERDOGGERS LOGO / XS [Code: MK9008MERCHTSSDXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 10:37:13 AM'),
(139, 'created a new product.', 'added a new product SUPERDOGGERS LOGO | S [Code: MK9008MERCHTSSDS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 11:38:22 AM'),
(140, 'created a new product.', 'added a new product SUPERDOGGERS | M\r\n [Code: MK9008MERCHTSSDM].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 11:57:03 AM'),
(141, 'created a new product.', 'added a new product SUPERDOGGERS LOGO | L [Code: MK9008MERCHTSSDL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 11:58:04 AM'),
(142, 'created a new product.', 'added a new product SUPERDOGGERS LOGO | XL [Code: MK9008MERCHTSSDXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 11:59:12 AM'),
(143, 'created a new product.', 'added a new product SUPERDOGGERS | 2XL [Code: MK9008MERCHTSSDXXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 12:00:18 PM'),
(144, 'logged in.', '', '61a5caf447cae', '', '2022-02-16 12:39:35 PM'),
(145, 'created a new product.', 'added a new product WITH A DOG LOGO | XS [Code: MK9009MERCHTSWADXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 01:17:32 PM'),
(146, 'created a new product.', 'added a new product  WITH A DOG LOGO | S [Code: MK9009MERCHTSWADS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 01:42:05 PM'),
(147, 'created a new product.', 'added a new product WITH A DOG LOGO | MEDIUM  [Code: MK9009MERCHTSWADM].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 01:42:57 PM'),
(148, 'created a new product.', 'added a new product WITH A DOG LOGO | L [Code: MK9009MERCHTSWADL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 01:43:46 PM'),
(149, 'created a new product.', 'added a new product WITH A DOG | XL [Code: MK9009MERCHTSWADXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 01:44:26 PM'),
(150, 'created a new product.', 'added a new product WITH A DOG LOGO |  XXL [Code: MK9009MERCHTSWADXXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 01:46:11 PM'),
(151, 'created a new product.', 'added a new product YOUR PAWS LOGO | XS [Code: MK9010MERCHSANDOYPSXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 02:00:06 PM'),
(152, 'created a new product.', 'added a new product OUR PAWS LOGO | S [Code: MK9010MERCHSANDOYPSS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 02:03:24 PM'),
(153, 'created a new product.', 'added a new product YOUR PAWS LOGO | M [Code: MK9010MERCHSANDOYPSM].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 02:05:45 PM'),
(154, 'created a new product.', 'added a new product YOUR PAWS LOGO | L [Code: MK9010MERCHSANDOYPSL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 02:06:31 PM'),
(155, 'created a new product.', 'added a new product YOUR PAWS LOGO | XL [Code: MK9010MERCHSANDOYPSXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 02:19:05 PM'),
(156, 'created a new product.', 'added a new product YOUR PAWS LOGO | XXL [Code: MK9010MERCHSANDOYPSXXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 02:21:23 PM'),
(157, 'created a new product.', 'added a new product  PAWSITIVE LOGO |  XS [Code: MK9011MERCHSPAWSITIVEXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 02:44:50 PM'),
(158, 'created a new product.', 'added a new product PAWSITIVE LOGO | S [Code: MK9011MERCHSPAWSITIVES].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 02:50:04 PM'),
(159, 'logged in.', '', '61a5caf447cae', '', '2022-02-16 03:00:55 PM'),
(160, 'logged out.', '', '61a5caf447cae', '', '2022-02-16 03:55:41 PM'),
(161, 'logged in.', '', '61a5caf447cae', '', '2022-02-16 03:56:40 PM'),
(162, 'logged out.', '', '61a5caf447cae', '', '2022-02-16 03:58:04 PM'),
(163, 'logged in.', '', '61a5caf447cae', '', '2022-02-16 03:58:07 PM'),
(164, 'logged in.', '', '61a5caf447cae', '', '2022-02-16 04:03:01 PM'),
(165, 'created a new product.', 'added a new product PAWSITIVE LOGO | M [Code: MK9011MERCHSANDOPAWSITIVEM].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-16 04:08:38 PM'),
(166, 'logged out.', '', '61a5caf447cae', '', '2022-02-16 04:44:23 PM'),
(167, 'logged in.', '', '61a5caf447cae', '', '2022-02-17 09:26:33 AM'),
(168, 'created a new product.', 'added a new product PAWSITIVE LOGO | XS [Code: MK9011MERCHSANDOPAWSITIVEXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-17 09:29:10 AM'),
(169, 'created a new product.', 'added a new product PAWSITIVE LOGO | S [Code: MK9011MERCHSANDOPAWSITIVES].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-17 09:49:03 AM'),
(170, 'logged out.', '', '61a5caf447cae', '', '2022-02-17 10:09:45 AM'),
(171, 'logged in.', '', '61a5caf447cae', '', '2022-02-17 10:16:50 AM'),
(172, 'logged in.', '', '61a5caf447cae', '', '2022-02-17 10:19:15 AM'),
(173, 'logged in.', '', '61a5caf447cae', '', '2022-02-17 10:36:12 AM'),
(174, 'logged in.', '', '61a5caf447cae', '', '2022-02-18 08:25:30 AM'),
(175, 'created a new product.', 'added a new product PAWSITIVE LOGO | L  [Code: MK9011MERCHSANDOPAWSITIVEL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-18 08:28:54 AM'),
(176, 'created a new product.', 'added a new product PAWSITIVE |  XL  [Code: MK9011MERCHSANDOPAWSITIVEXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-02-18 08:33:52 AM'),
(177, 'logged in.', '', '61a5caf447cae', '', '2022-02-18 10:55:19 AM'),
(178, 'logged in.', '', '61a5caf447cae', '', '2022-02-18 10:55:19 AM'),
(179, 'logged out.', '', '61a5caf447cae', '', '2022-02-18 11:40:29 AM'),
(180, 'logged in.', '', '61a5caf447cae', '', '2022-03-09 11:02:16 AM'),
(181, 'created a new product.', 'added a new product MK9 FACEMASK | RED  [Code: MK9012MERCHFMMK9REDFZ].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 11:14:20 AM'),
(182, 'created a new product.', 'added a new product MK9 FACEMASK | BLACK [Code: MK9012MERCHFMMK9BLACKFZ].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 11:15:54 AM'),
(183, 'created a new product.', 'added a new product MK9 FACEMASK | GRAY\r\n [Code: MK9012MERCHFMMK9GRAYFZ].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 11:16:45 AM'),
(184, 'created a new product.', 'added a new product MK9 FACEMASK | GOLD RED\r\n [Code: MK9012MERCHFMMK9GOLDREDFZ].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 11:18:59 AM'),
(185, 'logged out.', '', '61a5caf447cae', '', '2022-03-09 11:26:46 AM'),
(186, 'logged in.', '', '61a5caf447cae', '', '2022-03-09 11:26:48 AM'),
(187, 'created a new product.', 'added a new product MK9 FACEMASK | RED [Code: MK9012MERCHFMMK9REDFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 11:38:13 AM'),
(188, 'created a new product.', 'added a new product MK9 FACEMASK | BLACK  [Code: MK9012MERCHFMMK9BLACKFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 11:39:01 AM'),
(189, 'created a new product.', 'added a new product MK9 FACEMASK | GRAY  [Code: MK9012MERCHFMMK9GRAYFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 11:39:36 AM'),
(190, 'created a new product.', 'added a new product MK9 FACEMASK | GOLD RED  [Code: MK9012MERCHFMMK9 GOLD REDFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 11:40:21 AM'),
(191, 'created a new product.', 'added a new product MK9 FACEMASK | GOLDRED [Code: MK9012MERCHFMMK9GOLDREDFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 11:44:34 AM'),
(192, 'created a new product.', 'added a new product MK9 FACEMASK | ICGDWHITE [Code: MK9012MERCHFMICGDWHITEFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 11:45:09 AM'),
(193, 'created a new product.', 'added a new product MK9  FACEMASK  | ICGDBLACK  [Code: MK9012MERCHFMICGDBLACKFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 11:45:48 AM'),
(194, 'created a new product.', 'added a new product MK9 SPORTS JUG | WHITE  [Code: MK9 SJ013MERCHSJMK9SJWHITEFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 11:52:47 AM'),
(195, 'created a new product.', 'added a new product MK9 SPORTS JUG | SILVER [Code: MK9 SJ013MERCHSJMK9SJSILVEFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 11:54:30 AM'),
(196, 'created a new product.', 'added a new product MK9 UMBRELLA  | WHITE  [Code: MK9UMB014MERCHUMBMK9UMBWHITEFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 01:02:04 PM'),
(197, 'created a new product.', 'added a new product MK9 UMBRELLA  | WHITE   [Code: MK9UMB014MERCHUMBUMBWHITEFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 01:03:44 PM'),
(198, 'created a new product.', 'added a new product MK9 MESH CAP | BLACK AND WHITE  [Code: MK9 MC015MERCHMCMCBWFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 01:18:57 PM'),
(199, 'created a new product.', 'added a new product MESH CAP | BLACK AND WHITE [Code: MC015MERCHMCMCBWFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 01:28:09 PM'),
(200, 'created a new product.', 'added a new product MK9 MESH CAP | BLACK AND WHITE [Code: MK9MC015MERCHMCMCBWFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 01:30:44 PM'),
(201, 'created a new product.', 'added a new product MK9 UMBRELLA | WHITE  [Code: MK9014MERCHUMBWHITEFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 02:05:33 PM'),
(202, 'created a new product.', 'added a new product MK9 MESH CAP | BLACK AND WHITE   [Code: MK9015MERCHMCBLACK&WHITEFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 02:14:20 PM'),
(203, 'created a new product.', 'added a new product MK9 LEASH | ARMY GREEN ADULT  [Code: MK9016MERCHALARMYGREENADULTFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 02:20:27 PM'),
(204, 'created a new product.', 'added a new product MK9 LEASH | BLACK ADULT  [Code: MK9016MERCHALBLACKADULTFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 02:21:23 PM'),
(205, 'created a new product.', 'added a new product MK9 LEASH | BEIGE ADULT  [Code: MK9016MERCHALBEIGEADULTFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 02:22:04 PM'),
(206, 'created a new product.', 'added a new product MK9 LEASH | ARMY GREEN ADULT  [Code: MK9016MERCHLEASHARMYGREENADULTAS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 02:40:57 PM'),
(207, 'created a new product.', 'added a new product MK9 LEASH | BLACK ADULT  [Code: MK9016MERCHLEASHBLACKADULTAS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 02:41:30 PM'),
(208, 'created a new product.', 'added a new product MK9 LEASH BEIGE ADULT  [Code: MK9016MERCHLEASHBEIGEADULTAS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 02:42:04 PM'),
(209, 'created a new product.', 'added a new product MK9 COLLAR | ARMY GREEN ADULT  [Code: MK9017MERCHCOLLARARMYGREENADULTAS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 02:54:02 PM'),
(210, 'created a new product.', 'added a new product MK9 COLLAR | BLACK ADULT  [Code: MK9017MERCHCOLLARBLACKADULTAS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 02:56:05 PM'),
(211, 'created a new product.', 'added a new product MK9 MUG | SUPERDOGGERS   [Code: MK9020MERCHMUGSUPPERDOGGERSMUGFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 03:58:18 PM'),
(212, 'created a new product.', 'added a new product MK9 MUG | SUPERDOGGERS [Code: MK9020MERCHMGSUPPERDOGGERSMUGFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 04:12:11 PM'),
(213, 'created a new product.', 'added a new product MK9 MUG | MANALO K9  [Code: MK9020MERCHMGMANALOK9LOGOMUGFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 04:14:20 PM'),
(214, 'created a new product.', 'added a new product MK9 | MAGIC MUG  [Code: MK9020MERCHMGMAGICMUGFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-09 04:18:01 PM'),
(215, 'logged out.', '', '61a5caf447cae', '', '2022-03-09 04:48:29 PM'),
(216, 'logged in.', '', '61a5caf447cae', '', '2022-03-12 04:17:50 PM'),
(217, 'logged in.', '', '61a5caf447cae', '', '2022-03-16 01:21:35 PM'),
(218, 'logged out.', '', '61a5caf447cae', '', '2022-03-16 02:47:34 PM'),
(219, 'logged in.', '', '61a5caf447cae', '', '2022-03-16 02:47:45 PM'),
(220, 'logged out.', '', '61a5caf447cae', '', '2022-03-16 02:50:11 PM'),
(221, 'logged in.', '', '61a5caf447cae', '', '2022-03-16 03:33:54 PM'),
(222, 'logged out.', '', '61a5caf447cae', '', '2022-03-16 03:41:01 PM'),
(223, 'logged in.', '', '61a5caf447cae', '', '2022-03-16 04:34:51 PM'),
(224, 'created a new product.', 'added a new product MK9 SPORTS JUG | WHITE [Code: MK9 SJ013MERCHSJWHITEFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-16 04:36:56 PM'),
(225, 'created a new product.', 'added a new product MK9 SPORTS JUG | WHITE  [Code: MK9 013MERCHSJWHITEFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-16 04:42:19 PM'),
(226, 'logged out.', '', '61a5caf447cae', '', '2022-03-16 04:53:22 PM'),
(227, 'logged in.', '', '61a5caf447cae', '', '2022-03-17 03:29:05 PM'),
(228, 'created a new product.', 'added a new product MK9 CANVASS BAG WHITE  | 10\"X 12\" [Code: MK90021MERCHBAGWHITEBAG WHITE10].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-17 03:46:02 PM'),
(229, 'created a new product.', 'added a new product MK9 CANVASS BAG | WHITE 10\"X12\" [Code: MK90021MERCHCANBAGCANBAG10].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-17 03:50:30 PM'),
(230, 'created a new product.', 'added a new product MK9 SPORTS JUG | WHITE  [Code: MK9 013MERCHSPOJUGWHITEFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-17 03:53:54 PM'),
(231, 'created a new product.', 'added a new product MK9 SPORTS JUG | SILVER  [Code: MK9 013MERCHSPOJUGSILVERFS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-17 03:54:28 PM'),
(232, 'created a new product.', 'added a new product MK9 LEASH | ARMY GREEN  [Code: MK9016MERCHLEASHARMYGREENAS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-17 03:56:16 PM'),
(233, 'created a new product.', 'added a new product MK9 LEASH | BLACK  [Code: MK9016MERCHLEASHBLACKAS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-17 03:57:09 PM'),
(234, 'created a new product.', 'added a new product MK9 LEASH | BEIGE  [Code: MK9016MERCHLEASHBEIGEAS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-17 03:58:01 PM'),
(235, 'created a new product.', 'added a new product MK9 COLLAR | ARMY GREEN  [Code: MK9017MERCHCOLLARARMYGREENAS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-17 04:05:08 PM'),
(236, 'created a new product.', 'added a new product MK9 COLLAR | BLACK  [Code: MK9017MERCHCOLLARBLACKAS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-17 04:05:53 PM'),
(237, 'created a new product.', 'added a new product MK9 COLLAR | BEIGE  [Code: MK9017MERCHCOLLARBEIGEAS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-17 04:06:41 PM'),
(238, 'logged out.', '', '61a5caf447cae', '', '2022-03-17 04:42:10 PM'),
(239, 'logged in.', '', '61a5caf447cae', '', '2022-03-18 09:36:37 AM'),
(240, 'logged in.', '', '61a5caf447cae', '', '2022-03-18 02:14:34 PM'),
(241, 'created a new product.', 'added a new product MK9 LEASH PUPPY | BLACK [Code: MK9016MERCHLEASHPUPPBLACKPPS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-18 02:47:42 PM'),
(242, 'created a new product.', 'added a new product MK9 LEASH PUPPY | RED  [Code: MK9016MERCHLEASHPUPPREDPPS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-18 02:49:29 PM'),
(243, 'created a new product.', 'added a new product MK9 LEASH PUPPY | GRAY  [Code: MK9016MERCHLEASHPUPPGRAYPPS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-18 02:50:40 PM'),
(244, 'created a new product.', 'added a new product MK9 LEASH PUPPY | YELLOW [Code: MK9016MERCHLEASHPUPPYELLOWPPS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-18 02:51:30 PM'),
(245, 'created a new product.', 'added a new product MK9 LEASH PUPPY | BROWN  [Code: MK9016MERCHLEASHPUPPBROWNPPS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-18 02:52:15 PM'),
(246, 'created a new product.', 'added a new product MK9 LEASH  PUPPY | ARMY GREEN  [Code: MK9016MERCHLEASHPUPPARMYGREENPPS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-18 02:53:09 PM'),
(247, 'created a new product.', 'added a new product MK9 COLLAR PUPPY | BLACK  [Code: MK9017MERCHCOLLARPUPPBLACKPPS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-18 02:55:51 PM'),
(248, 'created a new product.', 'added a new product MK9 COLLAR PUPPY | RED  [Code: MK9017MERCHCOLLARPUPPREDPPS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-18 03:00:12 PM'),
(249, 'created a new product.', 'added a new product MK9 COLLAR PUPPY | GRAY [Code: MK9017MERCHCOLLARPUPPGRAYPPS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-18 03:01:07 PM'),
(250, 'created a new product.', 'added a new product MK9 COLLAR PUPPY | YELLOW  [Code: MK9017MERCHCOLLARPUPPYELLOWAS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-18 03:02:18 PM'),
(251, 'created a new product.', 'added a new product MK9 COLLAR PUPPY | BROWN  [Code: MK9017MERCHCOLLARPUPPBROWNPPS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-18 03:03:12 PM'),
(252, 'created a new product.', 'added a new product  MK9 COLLAR PUPPY | ARMY GREEN [Code: MK9017MERCHCOLLARPUPPARMYGREENPPS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-18 03:04:49 PM'),
(253, 'logged out.', '', '61a5caf447cae', '', '2022-03-18 04:46:13 PM'),
(254, 'logged in.', '', '61a5caf447cae', '', '2022-03-25 08:28:09 AM'),
(255, 'logged in.', '', '61a5caf447cae', '', '2022-03-25 10:22:41 AM'),
(256, 'logged in.', '', '61a5caf447cae', '', '2022-03-25 01:31:14 PM'),
(257, 'created a new product.', 'added a new product META SHIRT ROUND | XS [Code: MS022MERCHTSMSBRXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-25 01:45:56 PM'),
(258, 'created a new product.', 'added a new product META SHIRT ROUND | S [Code: MS022MERCHTSMSBRS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-25 01:46:57 PM'),
(259, 'created a new product.', 'added a new product META SHIRT ROUND | M [Code: MS022MERCHTSMSBRM].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-03-25 01:47:43 PM'),
(260, 'logged in.', '', '61a5caf447cae', '', '2022-03-28 08:18:27 PM'),
(261, 'logged in.', '', '61a5caf447cae', '', '2022-03-28 08:35:18 PM'),
(262, 'logged in.', '', '61a5caf447cae', '', '2022-03-28 08:35:26 PM'),
(263, 'logged in.', '', '61a5caf447cae', '', '2022-03-28 10:29:24 PM'),
(264, 'logged in.', '', '61a5caf447cae', '', '2022-03-28 10:34:35 PM'),
(265, 'logged in.', '', '61a5caf447cae', '', '2022-03-29 08:06:35 AM'),
(266, 'created a new user.', 'added a new user EDNA MARIE REYES [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-29 08:08:50 AM'),
(267, 'updated user details.', 'updated details of user [UserID: ].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-29 08:12:21 AM'),
(268, 'updated user details.', 'updated details of user EDNA MARIE REYES [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-29 08:14:01 AM'),
(269, 'updated user login details.', 'updated login details of user ednarmanalok9gmail.com [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-29 08:14:01 AM'),
(270, 'created a new user.', 'added a new user RAEVEN SOTTO LOTEYRO [UserID: 624252639e2e5].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-29 08:27:15 AM'),
(271, 'updated user details.', 'updated details of user RAEVEN SOTTO LOTEYRO [UserID: 624252639e2e5].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-29 08:33:19 AM'),
(272, 'updated user login details.', 'updated login details of user raevenandrei18@hotmail.com [UserID: 624252639e2e5].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-29 08:33:19 AM'),
(273, 'logged in.', '', '624252639e2e5', '', '2022-03-29 08:34:15 AM'),
(274, 'logged out.', '', '624252639e2e5', '', '2022-03-29 08:34:31 AM'),
(275, 'logged in.', '', '624252639e2e5', '', '2022-03-29 08:36:22 AM'),
(276, 'logged in.', '', '61a5caf447cae', '', '2022-03-29 11:50:29 AM'),
(277, 'logged in.', '', '61a5caf447cae', '', '2022-03-29 11:54:13 AM'),
(278, 'logged in.', '', '61a5caf447cae', '', '2022-03-29 11:54:20 AM'),
(279, 'logged in.', '', '61a5caf447cae', '', '2022-03-29 11:55:59 AM'),
(280, 'logged in.', '', '61a5caf447cae', '', '2022-03-29 11:56:04 AM'),
(281, 'logged in.', '', '61a5caf447cae', '', '2022-03-29 12:13:07 PM'),
(282, 'updated user details.', 'updated details of user EDNA MARIE REYES [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-29 12:14:57 PM'),
(283, 'updated user login details.', 'updated login details of user ednarmanalok9gmail.com [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-29 12:14:57 PM'),
(284, 'logged in.', '', '61a5caf447cae', '', '2022-03-29 03:33:16 PM'),
(285, 'logged in.', '', '61a5caf447cae', '', '2022-03-30 11:36:42 AM'),
(286, 'logged in.', '', '61a5caf447cae', '', '2022-03-30 11:41:47 AM'),
(287, 'logged out.', '', '61a5caf447cae', '', '2022-03-30 11:42:58 AM'),
(288, 'updated user details.', 'updated details of user EDNA MARIE REYES [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 11:42:59 AM'),
(289, 'updated user login details.', 'updated login details of user ednarmanalok9@gmail.com [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 11:42:59 AM'),
(290, 'logged in.', '', '62424e1258eb0', '', '2022-03-30 11:43:20 AM'),
(291, 'logged in.', '', '61a5caf447cae', '', '2022-03-30 11:43:26 AM'),
(292, 'logged in.', '', '61a5caf447cae', '', '2022-03-30 11:43:37 AM'),
(293, 'updated user details.', 'updated details of user EDNA MARIE REYES [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 11:45:45 AM'),
(294, 'updated user login details.', 'updated login details of user ednarmanalok9@gmail.com [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 11:45:45 AM'),
(295, 'logged out.', '', '61a5caf447cae', '', '2022-03-30 11:45:56 AM'),
(296, 'logged in.', '', '62424e1258eb0', '', '2022-03-30 11:46:19 AM'),
(297, 'logged out.', '', '62424e1258eb0', '', '2022-03-30 11:47:03 AM'),
(298, 'logged out.', '', '61a5caf447cae', '', '2022-03-30 12:28:18 PM'),
(299, 'logged in.', '', '61a5caf447cae', '', '2022-03-30 12:28:23 PM'),
(300, 'updated user details.', 'updated details of user EDNA MARIE REYES [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 12:31:12 PM'),
(301, 'updated user login details.', 'updated login details of user ednarmanalok9@gmail.com [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 12:31:12 PM'),
(302, 'updated user details.', 'updated details of user RAEVEN SOTTO LOTEYRO [UserID: 624252639e2e5].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 12:32:04 PM'),
(303, 'updated user login details.', 'updated login details of user raevenandrei18@hotmail.com [UserID: 624252639e2e5].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 12:32:04 PM'),
(304, 'logged out.', '', '61a5caf447cae', '', '2022-03-30 12:32:27 PM'),
(305, 'logged out.', '', '62424e1258eb0', '', '2022-03-30 01:32:59 PM'),
(306, 'updated user details.', 'updated details of user EDNA MARIE REYES [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 01:33:57 PM'),
(307, 'updated user login details.', 'updated login details of user ednarmanalok9@gmail.com [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 01:33:57 PM'),
(308, 'logged out.', '', '61a5caf447cae', '', '2022-03-30 01:39:18 PM'),
(309, 'logged in.', '', '61a5caf447cae', '', '2022-03-30 01:40:35 PM'),
(310, 'logged in.', '', '61a5caf447cae', '', '2022-03-30 01:42:25 PM'),
(311, 'updated user details.', 'updated details of user EDNA MARIE REYES [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 01:42:26 PM'),
(312, 'updated user login details.', 'updated login details of user ednarmanalok9@gmail.com [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 01:42:26 PM'),
(313, 'logged out.', '', '61a5caf447cae', '', '2022-03-30 01:42:33 PM'),
(314, 'logged in.', '', '62424e1258eb0', '', '2022-03-30 01:42:38 PM'),
(315, 'logged out.', '', '62424e1258eb0', '', '2022-03-30 01:43:12 PM'),
(316, 'logged in.', '', '62424e1258eb0', '', '2022-03-30 01:43:14 PM'),
(317, 'logged in.', '', '61a5caf447cae', '', '2022-03-30 01:43:16 PM'),
(318, 'logged out.', '', '62424e1258eb0', '', '2022-03-30 01:43:30 PM'),
(319, 'updated user details.', 'updated details of user EDNA MARIE REYES [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 01:43:31 PM'),
(320, 'updated user login details.', 'updated login details of user ednarmanalok9@gmail.com [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 01:43:31 PM'),
(321, 'logged in.', '', '62424e1258eb0', '', '2022-03-30 01:43:56 PM'),
(322, 'logged out.', '', '62424e1258eb0', '', '2022-03-30 01:45:14 PM'),
(323, 'logged in.', '', '62424e1258eb0', '', '2022-03-30 01:45:30 PM'),
(324, 'updated user details.', 'updated details of user EDNA MARIE REYES [UserID: 62424e1258eb0].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 01:49:06 PM'),
(325, 'updated user login details.', 'updated login details of user ednarmanalok9@gmail.com [UserID: 62424e1258eb0].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 01:49:06 PM'),
(326, 'logged out.', '', '62424e1258eb0', '', '2022-03-30 01:49:10 PM'),
(327, 'logged in.', '', '62424e1258eb0', '', '2022-03-30 01:49:26 PM'),
(328, 'updated user details.', 'updated details of user EDNA MARIE REYES [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 01:51:18 PM'),
(329, 'updated user login details.', 'updated login details of user ednarmanalok9@gmail.com [UserID: 62424e1258eb0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 01:51:18 PM'),
(330, 'logged out.', '', '62424e1258eb0', '', '2022-03-30 01:51:43 PM'),
(331, 'logged in.', '', '62424e1258eb0', '', '2022-03-30 01:51:59 PM'),
(332, 'logged out.', '', '61a5caf447cae', '', '2022-03-30 01:52:22 PM'),
(333, 'updated user details.', 'updated details of user EDNA MARIE REYES [UserID: 62424e1258eb0].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 01:52:45 PM'),
(334, 'updated user login details.', 'updated login details of user ednarmanalok9@gmail.com [UserID: 62424e1258eb0].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-30 01:52:45 PM'),
(335, 'logged in.', '', '61a5caf447cae', '', '2022-03-30 01:55:46 PM');
INSERT INTO `logbook` (`ID`, `Event`, `Description`, `UserID`, `PageURL`, `DateAdded`) VALUES
(336, 'logged out.', '', '61a5caf447cae', '', '2022-03-30 03:07:39 PM'),
(337, 'logged out.', '', '62424e1258eb0', '', '2022-03-30 03:55:43 PM'),
(338, 'logged in.', '', '61a5caf447cae', '', '2022-03-30 04:48:56 PM'),
(339, 'logged out.', '', '61a5caf447cae', '', '2022-03-30 04:58:33 PM'),
(340, 'logged in.', '', '61a5caf447cae', '', '2022-03-31 01:25:41 AM'),
(341, 'logged out.', '', '61a5caf447cae', '', '2022-03-31 01:50:31 AM'),
(342, 'logged in.', '', '61a5caf447cae', '', '2022-03-31 01:52:03 AM'),
(343, 'logged out.', '', '61a5caf447cae', '', '2022-03-31 01:52:27 AM'),
(344, 'logged in.', '', '61a5caf447cae', '', '2022-03-31 01:52:39 AM'),
(345, 'logged out.', '', '61a5caf447cae', '', '2022-03-31 01:52:54 AM'),
(346, 'logged in.', '', '61a5caf447cae', '', '2022-03-31 01:52:58 AM'),
(347, 'logged in.', '', '61a5caf447cae', '', '2022-03-31 09:30:03 AM'),
(348, 'created a new user.', 'added a new user David Christopher LAZARO [UserID: 62451b84cb670].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-31 11:09:56 AM'),
(349, 'updated user details.', 'updated details of user David Christoper LAZARO [UserID: 62451b84cb670].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-31 11:12:28 AM'),
(350, 'updated user login details.', 'updated login details of user lazaro.christoper01@gmail.com [UserID: 62451b84cb670].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-03-31 11:12:28 AM'),
(351, 'logged out.', '', '61a5caf447cae', '', '2022-03-31 11:54:43 AM'),
(352, 'logged in.', '', '61a5caf447cae', '', '2022-04-03 11:26:11 PM'),
(353, 'logged in.', '', '61a5caf447cae', '', '2022-04-07 02:51:07 PM'),
(354, 'updated user details.', 'updated details of user John Rogers Doe [UserID: 61a5caf447cae].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-07 02:52:17 PM'),
(355, 'updated user login details.', 'updated login details of user test_admin@gmail.com [UserID: 61a5caf447cae].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-07 02:52:17 PM'),
(356, 'updated user details.', 'updated details of user John Rogers Doe [UserID: 61a5caf447cae].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-07 02:52:29 PM'),
(357, 'updated user login details.', 'updated login details of user test_admin@gmail.com [UserID: 61a5caf447cae].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-07 02:52:29 PM'),
(358, 'logged in.', '', '61a5caf447cae', '', '2022-04-11 09:25:11 AM'),
(359, 'logged in.', '', '61a5caf447cae', '', '2022-04-11 09:28:56 AM'),
(360, 'logged in.', '', '624252639e2e5', '', '2022-04-12 10:56:20 AM'),
(361, 'logged in.', '', '61a5caf447cae', '', '2022-04-12 11:04:49 AM'),
(362, 'created a new user.', 'added a new user RAINIEZLE DELA CRUZ CABADING [UserID: 6254f07212f03].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-12 11:22:26 AM'),
(363, 'updated user details.', 'updated details of user RAINIEZLE DELA CRUZ CABADING [UserID: 6254f07212f03].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-12 11:23:40 AM'),
(364, 'updated user login details.', 'updated login details of user rain.cabading14@gmail.com [UserID: 6254f07212f03].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-12 11:23:40 AM'),
(365, 'logged out.', '', '61a5caf447cae', '', '2022-04-12 11:41:00 AM'),
(366, 'logged in.', '', '6254f07212f03', '', '2022-04-12 11:42:49 AM'),
(367, 'logged in.', '', '61a5caf447cae', '', '2022-04-12 03:56:03 PM'),
(368, 'logged out.', '', '6254f07212f03', '', '2022-04-12 03:58:03 PM'),
(369, 'updated user details.', 'updated details of user RAINIEZLE DELA CRUZ CABADING [UserID: 6254f07212f03].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-12 03:58:28 PM'),
(370, 'updated user login details.', 'updated login details of user rain.cabading14@gmail.com [UserID: 6254f07212f03].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-12 03:58:28 PM'),
(371, 'logged in.', '', '6254f07212f03', '', '2022-04-12 03:58:42 PM'),
(372, 'created a new vendor.', 'added a new vendor SEAMS COMMERCIAL CORPORATION [ID: 1].', '6254f07212f03', 'https://inventory-system-test.000webhostapp.com/admin/vendors', '2022-04-12 04:01:52 PM'),
(373, 'logged out.', '', '61a5caf447cae', '', '2022-04-12 04:18:28 PM'),
(374, 'logged in.', '', '61a5caf447cae', '', '2022-04-13 09:59:31 AM'),
(375, 'added new transaction.', 'restocked 2488 for  SHS004HSPRMPINK150G [TransactionID: SHS004HSPRMPINK150G-62563B9865771].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=SHS004HSPRMPINK150G', '2022-04-13 10:55:20 AM'),
(376, 'logged in.', '', '61a5caf447cae', '', '2022-04-13 11:42:06 AM'),
(377, 'created a new product.', 'added a new product META SHIRT BLACK ROUND | LARGE [Code: MS022MERCHTSMSBRL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-04-13 01:47:57 PM'),
(378, 'created a new product.', 'added a new product META SHIRT BLACK ROUND | EXTRA LARGE [Code: MS022MERCHTSMSBRXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-04-13 01:51:17 PM'),
(379, 'created a new product.', 'added a new product META SHIRT BLACK ROUND | EXTRA EXTRA LARGE [Code: MS022MERCHTSMSBR2XL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-04-13 01:52:59 PM'),
(380, 'created a new product.', 'added a new product PAWSITIVE LOGO | EXTRA EXTRA LARGE [Code: MK9011MERCHSANDOPAWSITIVEXXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-04-13 02:27:52 PM'),
(381, 'added new transaction.', 'restocked 2351 for  SHS004HSPRMPINK150G [TransactionID: SHS004HSPRMPINK150G-62567396CAED2].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=SHS004HSPRMPINK150G', '2022-04-13 02:54:14 PM'),
(382, 'added new transaction.', 'restocked 2488 for  SHS004HSPRMBLUE150G [TransactionID: SHS004HSPRMBLUE150G-62567396D1090].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=SHS004HSPRMBLUE150G', '2022-04-13 02:54:14 PM'),
(383, 'added new transaction.', 'restocked 14653 for  SDS002DSPRMYP150 G [TransactionID: SDS002DSPRMYP150 G-62567396D5966].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=SDS002DSPRMYP150 G', '2022-04-13 02:54:14 PM'),
(384, 'added new transaction.', 'restocked 5192 for  SDS002DSPRMORIG150 G [TransactionID: SDS002DSPRMORIG150 G-62567396DB0C2].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=SDS002DSPRMORIG150 G', '2022-04-13 02:54:14 PM'),
(385, 'added new transaction.', 'restocked 15679 for  SDS002DSPRMMC150 G [TransactionID: SDS002DSPRMMC150 G-62567396DC249].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=SDS002DSPRMMC150 G', '2022-04-13 02:54:14 PM'),
(386, 'added new transaction.', 'restocked 6152 for  SDS002DSPRMAC150 G [TransactionID: SDS002DSPRMAC150 G-62567396DD5F4].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=SDS002DSPRMAC150 G', '2022-04-13 02:54:14 PM'),
(387, 'added new transaction.', 'restocked 4873 for  SDN001DFPRMORIG5KG [TransactionID: SDN001DFPRMORIG5KG-62567396DE907].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=SDN001DFPRMORIG5KG', '2022-04-13 02:54:14 PM'),
(388, 'added new transaction.', 'restocked 431 for  SDN001DFPRMORIG500G [TransactionID: SDN001DFPRMORIG500G-62567396DFAC4].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=SDN001DFPRMORIG500G', '2022-04-13 02:54:14 PM'),
(389, 'added new transaction.', 'restocked 3323 for  SDN001DFPRMORIG15KG [TransactionID: SDN001DFPRMORIG15KG-62567396E0AD1].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=SDN001DFPRMORIG15KG', '2022-04-13 02:54:14 PM'),
(390, 'added new transaction.', 'restocked 18813 for  SCB003DSPRMSCB150G [TransactionID: SCB003DSPRMSCB150G-62567396E1A96].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=SCB003DSPRMSCB150G', '2022-04-13 02:54:14 PM'),
(391, 'added new transaction.', 'restocked 1083 for  POT004DPPRMPOT150 G  [TransactionID: POT004DPPRMPOT150 G -62567396E29F2].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=POT004DPPRMPOT150 G ', '2022-04-13 02:54:14 PM'),
(392, 'added new transaction.', 'restocked 7 for  MS022MERCHTSMSBRXS [TransactionID: MS022MERCHTSMSBRXS-62567396E38B8].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MS022MERCHTSMSBRXS', '2022-04-13 02:54:14 PM'),
(393, 'added new transaction.', 'restocked 12 for  MS022MERCHTSMSBRS [TransactionID: MS022MERCHTSMSBRS-62567396E48A2].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MS022MERCHTSMSBRS', '2022-04-13 02:54:14 PM'),
(394, 'added new transaction.', 'restocked 22 for  MS022MERCHTSMSBRM [TransactionID: MS022MERCHTSMSBRM-62567396EA547].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MS022MERCHTSMSBRM', '2022-04-13 02:54:14 PM'),
(395, 'added new transaction.', 'restocked 37 for  MK9UMB014MERCHUMBUMBWHITEFS [TransactionID: MK9UMB014MERCHUMBUMBWHITEFS-62567396EB4B9].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9UMB014MERCHUMBUMBWHITEFS', '2022-04-13 02:54:14 PM'),
(396, 'added new transaction.', 'restocked 82 for  MK9MC015MERCHMCMCBWFS [TransactionID: MK9MC015MERCHMCMCBWFS-62567396EC455].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9MC015MERCHMCMCBWFS', '2022-04-13 02:54:14 PM'),
(397, 'added new transaction.', 'restocked 48 for  MK9020MERCHMGMAGICMUGFS [TransactionID: MK9020MERCHMGMAGICMUGFS-62567396ED391].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9020MERCHMGMAGICMUGFS', '2022-04-13 02:54:14 PM'),
(398, 'added new transaction.', 'restocked 92 for  MK9020MERCHMGMANALOK9LOGOMUGFS [TransactionID: MK9020MERCHMGMANALOK9LOGOMUGFS-62567396EE24B].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9020MERCHMGMANALOK9LOGOMUGFS', '2022-04-13 02:54:14 PM'),
(399, 'added new transaction.', 'restocked 36 for  MK9020MERCHMGSUPPERDOGGERSMUGFS [TransactionID: MK9020MERCHMGSUPPERDOGGERSMUGFS-62567396EF21D].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9020MERCHMGSUPPERDOGGERSMUGFS', '2022-04-13 02:54:14 PM'),
(400, 'added new transaction.', 'restocked 13 for  MK9017MERCHCOLLARPUPPYELLOWAS [TransactionID: MK9017MERCHCOLLARPUPPYELLOWAS-62567396F0136].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9017MERCHCOLLARPUPPYELLOWAS', '2022-04-13 02:54:14 PM'),
(401, 'added new transaction.', 'restocked 12 for  MK9017MERCHCOLLARPUPPREDPPS [TransactionID: MK9017MERCHCOLLARPUPPREDPPS-62567396F10C7].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9017MERCHCOLLARPUPPREDPPS', '2022-04-13 02:54:14 PM'),
(402, 'added new transaction.', 'restocked 9 for  MK9017MERCHCOLLARPUPPGRAYPPS [TransactionID: MK9017MERCHCOLLARPUPPGRAYPPS-62567396F1FCF].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9017MERCHCOLLARPUPPGRAYPPS', '2022-04-13 02:54:14 PM'),
(403, 'added new transaction.', 'restocked 8 for  MK9017MERCHCOLLARPUPPBROWNPPS [TransactionID: MK9017MERCHCOLLARPUPPBROWNPPS-62567396F2FC6].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9017MERCHCOLLARPUPPBROWNPPS', '2022-04-13 02:54:14 PM'),
(404, 'added new transaction.', 'restocked 18 for  MK9017MERCHCOLLARPUPPBLACKPPS [TransactionID: MK9017MERCHCOLLARPUPPBLACKPPS-62567396F4094].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9017MERCHCOLLARPUPPBLACKPPS', '2022-04-13 02:54:15 PM'),
(405, 'added new transaction.', 'restocked 13 for  MK9017MERCHCOLLARPUPPARMYGREENPPS [TransactionID: MK9017MERCHCOLLARPUPPARMYGREENPPS-6256739700E13].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9017MERCHCOLLARPUPPARMYGREENPPS', '2022-04-13 02:54:15 PM'),
(406, 'added new transaction.', 'restocked 36 for  MK9017MERCHCOLLARBLACKAS [TransactionID: MK9017MERCHCOLLARBLACKAS-6256739701DD8].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9017MERCHCOLLARBLACKAS', '2022-04-13 02:54:15 PM'),
(407, 'added new transaction.', 'restocked 15 for  MK9017MERCHCOLLARBEIGEAS [TransactionID: MK9017MERCHCOLLARBEIGEAS-6256739702E5D].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9017MERCHCOLLARBEIGEAS', '2022-04-13 02:54:15 PM'),
(408, 'added new transaction.', 'restocked 23 for  MK9017MERCHCOLLARARMYGREENAS [TransactionID: MK9017MERCHCOLLARARMYGREENAS-6256739703E42].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9017MERCHCOLLARARMYGREENAS', '2022-04-13 02:54:15 PM'),
(409, 'added new transaction.', 'restocked 13 for  MK9016MERCHLEASHPUPPYELLOWPPS [TransactionID: MK9016MERCHLEASHPUPPYELLOWPPS-6256739704DF8].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9016MERCHLEASHPUPPYELLOWPPS', '2022-04-13 02:54:15 PM'),
(410, 'added new transaction.', 'restocked 11 for  MK9016MERCHLEASHPUPPREDPPS [TransactionID: MK9016MERCHLEASHPUPPREDPPS-6256739705F27].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9016MERCHLEASHPUPPREDPPS', '2022-04-13 02:54:15 PM'),
(411, 'added new transaction.', 'restocked 11 for  MK9016MERCHLEASHPUPPGRAYPPS [TransactionID: MK9016MERCHLEASHPUPPGRAYPPS-6256739706E01].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9016MERCHLEASHPUPPGRAYPPS', '2022-04-13 02:54:15 PM'),
(412, 'added new transaction.', 'restocked 7 for  MK9016MERCHLEASHPUPPBROWNPPS [TransactionID: MK9016MERCHLEASHPUPPBROWNPPS-625673970801D].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9016MERCHLEASHPUPPBROWNPPS', '2022-04-13 02:54:15 PM'),
(413, 'added new transaction.', 'restocked 13 for  MK9016MERCHLEASHPUPPARMYGREENPPS [TransactionID: MK9016MERCHLEASHPUPPARMYGREENPPS-6256739709050].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9016MERCHLEASHPUPPARMYGREENPPS', '2022-04-13 02:54:15 PM'),
(414, 'added new transaction.', 'restocked 10 for  MK9016MERCHLEASHBEIGEAS [TransactionID: MK9016MERCHLEASHBEIGEAS-625673970A136].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9016MERCHLEASHBEIGEAS', '2022-04-13 02:54:15 PM'),
(415, 'added new transaction.', 'restocked 18 for  MK9016MERCHLEASHARMYGREENAS [TransactionID: MK9016MERCHLEASHARMYGREENAS-625673970B10F].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9016MERCHLEASHARMYGREENAS', '2022-04-13 02:54:15 PM'),
(416, 'added new transaction.', 'restocked 18 for  MK9016MERCHLEASHPUPPBLACKPPS [TransactionID: MK9016MERCHLEASHPUPPBLACKPPS-625673970C0A4].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9016MERCHLEASHPUPPBLACKPPS', '2022-04-13 02:54:15 PM'),
(417, 'added new transaction.', 'restocked 10 for  MK9016MERCHLEASHBLACKAS [TransactionID: MK9016MERCHLEASHBLACKAS-625673970D002].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9016MERCHLEASHBLACKAS', '2022-04-13 02:54:15 PM'),
(418, 'added new transaction.', 'restocked 73 for  MK9012MERCHFMMK9REDFS [TransactionID: MK9012MERCHFMMK9REDFS-625673970DF3C].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9012MERCHFMMK9REDFS', '2022-04-13 02:54:15 PM'),
(419, 'added new transaction.', 'restocked 94 for  MK9012MERCHFMMK9GRAYFS [TransactionID: MK9012MERCHFMMK9GRAYFS-625673970EF45].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9012MERCHFMMK9GRAYFS', '2022-04-13 02:54:15 PM'),
(420, 'added new transaction.', 'restocked 89 for  MK9012MERCHFMMK9GOLDREDFS [TransactionID: MK9012MERCHFMMK9GOLDREDFS-625673970FF48].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9012MERCHFMMK9GOLDREDFS', '2022-04-13 02:54:15 PM'),
(421, 'added new transaction.', 'restocked 63 for  MK9012MERCHFMMK9BLACKFS [TransactionID: MK9012MERCHFMMK9BLACKFS-6256739710E1F].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9012MERCHFMMK9BLACKFS', '2022-04-13 02:54:15 PM'),
(422, 'added new transaction.', 'restocked 130 for  MK9012MERCHFMICGDWHITEFS [TransactionID: MK9012MERCHFMICGDWHITEFS-6256739711E3A].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9012MERCHFMICGDWHITEFS', '2022-04-13 02:54:15 PM'),
(423, 'added new transaction.', 'restocked 100 for  MK9012MERCHFMICGDBLACKFS [TransactionID: MK9012MERCHFMICGDBLACKFS-6256739712E26].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9012MERCHFMICGDBLACKFS', '2022-04-13 02:54:15 PM'),
(424, 'added new transaction.', 'restocked 48 for  MK9 013MERCHSPOJUGWHITEFS [TransactionID: MK9 013MERCHSPOJUGWHITEFS-6256739713D52].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9 013MERCHSPOJUGWHITEFS', '2022-04-13 02:54:15 PM'),
(425, 'added new transaction.', 'restocked 44 for  MK9 013MERCHSPOJUGSILVERFS [TransactionID: MK9 013MERCHSPOJUGSILVERFS-6256739714D02].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9 013MERCHSPOJUGSILVERFS', '2022-04-13 02:54:15 PM'),
(426, 'added new transaction.', 'restocked 118 for  MK90021MERCHCANBAGCANBAG10 [TransactionID: MK90021MERCHCANBAGCANBAG10-6256739715BED].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK90021MERCHCANBAGCANBAG10', '2022-04-13 02:54:15 PM'),
(427, 'added new transaction.', 'restocked 21 for  MS022MERCHTSMSBRL [TransactionID: MS022MERCHTSMSBRL-6256739716C41].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MS022MERCHTSMSBRL', '2022-04-13 02:54:15 PM'),
(428, 'added new transaction.', 'restocked 10 for  MS022MERCHTSMSBRXL [TransactionID: MS022MERCHTSMSBRXL-62567397182CA].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MS022MERCHTSMSBRXL', '2022-04-13 02:54:15 PM'),
(429, 'added new transaction.', 'restocked 5 for  MS022MERCHTSMSBR2XL [TransactionID: MS022MERCHTSMSBR2XL-62567397198CD].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MS022MERCHTSMSBR2XL', '2022-04-13 02:54:15 PM'),
(430, 'added new transaction.', 'restocked 5 for  MK9008MERCHTSSDXS [TransactionID: MK9008MERCHTSSDXS-625673971B2E8].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9008MERCHTSSDXS', '2022-04-13 02:54:15 PM'),
(431, 'added new transaction.', 'restocked 4 for  MK9008MERCHTSSDS [TransactionID: MK9008MERCHTSSDS-625673971C9FF].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9008MERCHTSSDS', '2022-04-13 02:54:15 PM'),
(432, 'added new transaction.', 'restocked 1 for  MK9009MERCHTSWADS [TransactionID: MK9009MERCHTSWADS-625673971E0CF].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9009MERCHTSWADS', '2022-04-13 02:54:15 PM'),
(433, 'added new transaction.', 'restocked 6 for  MK9009MERCHTSWADM [TransactionID: MK9009MERCHTSWADM-625673971FC13].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9009MERCHTSWADM', '2022-04-13 02:54:15 PM'),
(434, 'added new transaction.', 'restocked 3 for  MK9009MERCHTSWADL [TransactionID: MK9009MERCHTSWADL-6256739720FE5].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9009MERCHTSWADL', '2022-04-13 02:54:15 PM'),
(435, 'added new transaction.', 'restocked 2 for  MK9009MERCHTSWADXL [TransactionID: MK9009MERCHTSWADXL-62567397223C4].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9009MERCHTSWADXL', '2022-04-13 02:54:15 PM'),
(436, 'added new transaction.', 'restocked 2 for  MK9009MERCHTSWADXXL [TransactionID: MK9009MERCHTSWADXXL-6256739723307].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9009MERCHTSWADXXL', '2022-04-13 02:54:15 PM'),
(437, 'added new transaction.', 'restocked 2 for  MK9010MERCHSANDOYPSS [TransactionID: MK9010MERCHSANDOYPSS-6256739724499].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9010MERCHSANDOYPSS', '2022-04-13 02:54:15 PM'),
(438, 'added new transaction.', 'restocked 1 for  MK9010MERCHSANDOYPSM [TransactionID: MK9010MERCHSANDOYPSM-62567397255AC].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9010MERCHSANDOYPSM', '2022-04-13 02:54:15 PM'),
(439, 'added new transaction.', 'restocked 4 for  MK9010MERCHSANDOYPSL [TransactionID: MK9010MERCHSANDOYPSL-62567397266B5].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9010MERCHSANDOYPSL', '2022-04-13 02:54:15 PM'),
(440, 'added new transaction.', 'restocked 5 for  MK9010MERCHSANDOYPSXL [TransactionID: MK9010MERCHSANDOYPSXL-62567397277F0].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9010MERCHSANDOYPSXL', '2022-04-13 02:54:15 PM'),
(441, 'added new transaction.', 'restocked 4 for  MK9010MERCHSANDOYPSXXL [TransactionID: MK9010MERCHSANDOYPSXXL-62567397289C5].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9010MERCHSANDOYPSXXL', '2022-04-13 02:54:15 PM'),
(442, 'added new transaction.', 'restocked 2 for  MK9011MERCHSANDOPAWSITIVES [TransactionID: MK9011MERCHSANDOPAWSITIVES-6256739729BC7].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9011MERCHSANDOPAWSITIVES', '2022-04-13 02:54:15 PM'),
(443, 'added new transaction.', 'restocked 5 for  MK9011MERCHSANDOPAWSITIVEM [TransactionID: MK9011MERCHSANDOPAWSITIVEM-625673972AB0C].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9011MERCHSANDOPAWSITIVEM', '2022-04-13 02:54:15 PM'),
(444, 'added new transaction.', 'restocked 1 for  MK9011MERCHSANDOPAWSITIVEL [TransactionID: MK9011MERCHSANDOPAWSITIVEL-625673972BC10].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9011MERCHSANDOPAWSITIVEL', '2022-04-13 02:54:15 PM'),
(445, 'added new transaction.', 'restocked 4 for  MK9011MERCHSANDOPAWSITIVEXL [TransactionID: MK9011MERCHSANDOPAWSITIVEXL-625673972CD50].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9011MERCHSANDOPAWSITIVEXL', '2022-04-13 02:54:15 PM'),
(446, 'added new transaction.', 'restocked 2 for  MK9011MERCHSANDOPAWSITIVEXXL [TransactionID: MK9011MERCHSANDOPAWSITIVEXXL-625673972DD7C].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9011MERCHSANDOPAWSITIVEXXL', '2022-04-13 02:54:15 PM'),
(447, 'added new transaction.', 'restocked 38 for  MK9005MERCHTSVNECKS [TransactionID: MK9005MERCHTSVNECKS-625673972ED53].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9005MERCHTSVNECKS', '2022-04-13 02:54:15 PM'),
(448, 'added new transaction.', 'restocked 36 for  MK9005MERCHTSVNECKM [TransactionID: MK9005MERCHTSVNECKM-625673972FF1D].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9005MERCHTSVNECKM', '2022-04-13 02:54:15 PM'),
(449, 'added new transaction.', 'restocked 29 for  MK9005MERCHTSVNECKL [TransactionID: MK9005MERCHTSVNECKL-62567397310D9].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9005MERCHTSVNECKL', '2022-04-13 02:54:15 PM'),
(450, 'added new transaction.', 'restocked 38 for  MK9005MERCHTSVNECKXL [TransactionID: MK9005MERCHTSVNECKXL-6256739732197].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9005MERCHTSVNECKXL', '2022-04-13 02:54:15 PM'),
(451, 'added new transaction.', 'restocked 28 for  MK9006MERCHTSROUNDXS [TransactionID: MK9006MERCHTSROUNDXS-625673973320F].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9006MERCHTSROUNDXS', '2022-04-13 02:54:15 PM'),
(452, 'added new transaction.', 'restocked 6 for  MK9006MERCHTSROUNDS [TransactionID: MK9006MERCHTSROUNDS-62567397341B2].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9006MERCHTSROUNDS', '2022-04-13 02:54:15 PM'),
(453, 'added new transaction.', 'restocked 33 for  MK9006MERCHTSROUNDM [TransactionID: MK9006MERCHTSROUNDM-6256739735494].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9006MERCHTSROUNDM', '2022-04-13 02:54:15 PM'),
(454, 'added new transaction.', 'restocked 29 for  MK9006MERCHTSROUNDL [TransactionID: MK9006MERCHTSROUNDL-6256739736615].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9006MERCHTSROUNDL', '2022-04-13 02:54:15 PM'),
(455, 'added new transaction.', 'restocked 24 for  MK9006MERCHTSROUNDXL [TransactionID: MK9006MERCHTSROUNDXL-62567397377C4].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9006MERCHTSROUNDXL', '2022-04-13 02:54:15 PM'),
(456, 'added new transaction.', 'restocked 2 for  MK9006MERCHTSROUND2XL [TransactionID: MK9006MERCHTSROUND2XL-6256739738A69].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9006MERCHTSROUND2XL', '2022-04-13 02:54:15 PM'),
(457, 'added new transaction.', 'restocked 19 for  MK9007MERCHTSICGDXS [TransactionID: MK9007MERCHTSICGDXS-6256739739E29].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9007MERCHTSICGDXS', '2022-04-13 02:54:15 PM'),
(458, 'added new transaction.', 'restocked 19 for  MK9007MERCHTSICGDS [TransactionID: MK9007MERCHTSICGDS-625673973B0CB].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9007MERCHTSICGDS', '2022-04-13 02:54:15 PM'),
(459, 'added new transaction.', 'restocked 10 for  MK9007MERCHTSICGDM [TransactionID: MK9007MERCHTSICGDM-625673973C120].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9007MERCHTSICGDM', '2022-04-13 02:54:15 PM'),
(460, 'added new transaction.', 'restocked 5 for  MK9007MERCHTSICGDL [TransactionID: MK9007MERCHTSICGDL-625673973D348].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9007MERCHTSICGDL', '2022-04-13 02:54:15 PM'),
(461, 'added new transaction.', 'restocked 7 for  MK9007MERCHTSICGDXL [TransactionID: MK9007MERCHTSICGDXL-625673973E344].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9007MERCHTSICGDXL', '2022-04-13 02:54:15 PM'),
(462, 'added new transaction.', 'restocked 38 for  MK9007MERCHTSICGD2XL [TransactionID: MK9007MERCHTSICGD2XL-625673973F2AE].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9007MERCHTSICGD2XL', '2022-04-13 02:54:15 PM'),
(463, 'added new transaction.', 'restocked 15 for  MK9008MERCHTSSDXXL [TransactionID: MK9008MERCHTSSDXXL-62567419986D1].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9008MERCHTSSDXXL', '2022-04-13 02:56:25 PM'),
(464, 'added new transaction.', 'restocked 82 for  MK9015MERCHMCBLACK&WHITEFS [TransactionID: MK9015MERCHMCBLACK&WHITEFS-625674BA17968].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9015MERCHMCBLACK&WHITEFS', '2022-04-13 02:59:06 PM'),
(465, 'added new transaction.', 'restocked 37 for  MK9014MERCHUMBWHITEFS [TransactionID: MK9014MERCHUMBWHITEFS-62567519F0EAF].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9014MERCHUMBWHITEFS', '2022-04-13 03:00:41 PM'),
(466, 'created a new product.', 'added a new product ICGD TOPDOGS | EXTRA SMALL [Code: MK9023MERCHTSICGDTDXS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-04-13 03:10:54 PM'),
(467, 'created a new product.', 'added a new product IFGD FACEMASK | WHITE [Code: IFGD024MERCHFMIFGDWHITEFREE SIZE].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-04-13 03:28:49 PM'),
(468, 'created a new product.', 'added a new product IFGD FACEMASK | BLACK [Code: IFGD024MERCHFMIFGDBLACKFREE SIZE].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-04-13 03:29:39 PM'),
(469, 'added new transaction.', 'restocked 40 for  IFGD024MERCHFMIFGDWHITEFREE SIZE [TransactionID: IFGD024MERCHFMIFGDWHITEFREE SIZE-62567C27BB255].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=IFGD024MERCHFMIFGDWHITEFREE SIZE', '2022-04-13 03:30:47 PM'),
(470, 'added new transaction.', 'restocked 30 for  IFGD024MERCHFMIFGDBLACKFREE SIZE [TransactionID: IFGD024MERCHFMIFGDBLACKFREE SIZE-62567C27BC7B9].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=IFGD024MERCHFMIFGDBLACKFREE SIZE', '2022-04-13 03:30:47 PM'),
(471, 'created a new product.', 'added a new product ICGD TOP DOGS | SMALL [Code: MK9023MERCHTSICGDTDS].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-04-13 03:43:23 PM'),
(472, 'created a new product.', 'added a new product ICGD TOP DOGS | MEDIUM [Code: MK9023MERCHTSICGDTDM].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-04-13 03:44:07 PM'),
(473, 'created a new product.', 'added a new product ICGD TOP DOGS | LARGE [Code: MK9023MERCHTSICGDTDL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-04-13 03:44:56 PM'),
(474, 'created a new product.', 'added a new product ICGD TOP DOGS | EXTRA LARGE [Code: MK9023MERCHTSICGDTDXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-04-13 03:45:41 PM'),
(475, 'created a new product.', 'added a new product ICGD TOP DOGS | 2XLARGE [Code: MK9023MERCHTSICGDTDXXL].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/products', '2022-04-13 03:54:16 PM'),
(476, 'added new transaction.', 'restocked 10 for  MK9023MERCHTSICGDTDXS [TransactionID: MK9023MERCHTSICGDTDXS-625685560E540].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9023MERCHTSICGDTDXS', '2022-04-13 04:09:58 PM'),
(477, 'added new transaction.', 'restocked 13 for  MK9023MERCHTSICGDTDS [TransactionID: MK9023MERCHTSICGDTDS-625685561C6B8].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9023MERCHTSICGDTDS', '2022-04-13 04:09:58 PM'),
(478, 'added new transaction.', 'restocked 9 for  MK9023MERCHTSICGDTDM [TransactionID: MK9023MERCHTSICGDTDM-625685561D992].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9023MERCHTSICGDTDM', '2022-04-13 04:09:58 PM'),
(479, 'added new transaction.', 'restocked 2 for  MK9023MERCHTSICGDTDL [TransactionID: MK9023MERCHTSICGDTDL-625685561EE27].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9023MERCHTSICGDTDL', '2022-04-13 04:09:58 PM'),
(480, 'added new transaction.', 'restocked 11 for  MK9023MERCHTSICGDTDXL [TransactionID: MK9023MERCHTSICGDTDXL-625685562020C].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9023MERCHTSICGDTDXL', '2022-04-13 04:09:58 PM'),
(481, 'added new transaction.', 'restocked 7 for  MK9023MERCHTSICGDTDXXL [TransactionID: MK9023MERCHTSICGDTDXXL-6256855621476].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=MK9023MERCHTSICGDTDXXL', '2022-04-13 04:09:58 PM'),
(482, 'logged out.', '', '61a5caf447cae', '', '2022-04-13 04:17:34 PM'),
(483, 'logged in.', '', '61a5caf447cae', '', '2022-04-14 02:57:34 AM'),
(484, 'logged in.', '', '62424e1258eb0', '', '2022-04-18 12:00:19 PM'),
(485, 'logged in.', '', '6254f07212f03', '', '2022-04-18 01:06:48 PM'),
(486, 'created a new sales order.', 'added sales order SO625D04AF6B9D2 [SalesOrderID: 1].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 02:26:55 PM'),
(487, 'updated remarks.', 'updated remarks for sales order [No: SO625D04AF6B9D2].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 02:27:33 PM'),
(488, 'approved sales order.', 'approved sales order SO625D04AF6B9D2 [SalesOrderID: 1].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 02:36:49 PM'),
(489, 'added new replacement.', 'added replacement RP625D077884A6C to sales order [SalesOrderNo: SO625D04AF6B9D2].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 02:38:48 PM'),
(490, 'added new replacement.', 'added replacement RP625D079B5D601 to sales order [SalesOrderNo: SO625D04AF6B9D2].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 02:39:23 PM'),
(491, 'added new replacement.', 'added replacement RP625D07B586A04 to sales order [SalesOrderNo: SO625D04AF6B9D2].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 02:39:49 PM'),
(492, 'added new replacement.', 'added replacement RP625D07C72A8D4 to sales order [SalesOrderNo: SO625D04AF6B9D2].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 02:40:07 PM'),
(493, 'scheduled delivery.', 'scheduled delivery for sales order [No: SO625D04AF6B9D2].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 03:24:21 PM'),
(494, 'marked SO as delivered.', 'sales order marked as delivered [No: SO625D04AF6B9D2].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 03:24:38 PM'),
(495, 'added a new additional fee.', 'adde a new additional fee [ID: 1] for sales order [OrderNo: SO625D04AF6B9D2].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 03:25:51 PM'),
(496, 'deleted client record.', 'deleted a client record [ID: ].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/clients', '2022-04-18 03:32:07 PM'),
(497, 'deleted client record.', 'deleted a client record [ID: ].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/clients', '2022-04-18 03:32:12 PM'),
(498, 'deleted client record.', 'deleted a client record [ID: ].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/clients', '2022-04-18 03:32:32 PM'),
(499, 'removed adtl fee.', 'removed adtl fee [adtlFeeNo: AF625D127FD8A78].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 04:48:58 PM'),
(500, 'marked SO as received.', 'sales order marked as received [No: SO625D04AF6B9D2].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 04:49:12 PM'),
(501, 'updated remarks.', 'updated remarks for sales order [No: SO625D04AF6B9D2].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 04:49:53 PM'),
(502, 'approved replacement.', 'approved replacement RP625D077884A6C [SalesOrderNo: 1].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 04:50:44 PM'),
(503, 'approved replacement.', 'approved replacement RP625D079B5D601 [SalesOrderNo: 1].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 04:50:53 PM'),
(504, 'approved replacement.', 'approved replacement RP625D07B586A04 [SalesOrderNo: 1].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 04:51:00 PM'),
(505, 'approved replacement.', 'approved replacement RP625D07C72A8D4 [SalesOrderNo: 1].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-18 04:51:06 PM'),
(506, 'deleted replacement.', 'deleted replacement RP625D077884A6C [SalesOrderNo: ].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=', '2022-04-18 04:51:40 PM'),
(507, 'deleted replacement.', 'deleted replacement RP625D079B5D601 [SalesOrderNo: ].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=', '2022-04-18 04:51:47 PM'),
(508, 'deleted replacement.', 'deleted replacement RP625D07B586A04 [SalesOrderNo: ].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=', '2022-04-18 04:51:54 PM'),
(509, 'deleted replacement.', 'deleted replacement RP625D07C72A8D4 [SalesOrderNo: ].', '62424e1258eb0', 'https://inventory-system-test.000webhostapp.com/admin/view_sales_order?orderNo=', '2022-04-18 04:52:01 PM'),
(510, 'logged in.', '', '61a5caf447cae', '', '2022-04-20 09:52:29 AM'),
(511, 'updated user details.', 'updated details of user David Christoper LAZARO [UserID: 62451b84cb670].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-20 09:53:17 AM'),
(512, 'updated user login details.', 'updated login details of user lazaro.christoper01@gmail.com [UserID: 62451b84cb670].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-20 09:53:17 AM'),
(513, 'updated user details.', 'updated details of user RAEVEN SOTTO LOTEYRO [UserID: 624252639e2e5].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-20 09:53:56 AM'),
(514, 'updated user login details.', 'updated login details of user raevenandrei18@hotmail.com [UserID: 624252639e2e5].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-20 09:53:56 AM'),
(515, 'updated user details.', 'updated details of user David Christoper LAZARO [UserID: 62451b84cb670].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-20 09:54:27 AM'),
(516, 'updated user login details.', 'updated login details of user lazaro.christoper01@gmail.com [UserID: 62451b84cb670].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-20 09:54:27 AM'),
(517, 'logged out.', '', '61a5caf447cae', '', '2022-04-20 10:20:50 AM'),
(518, 'logged in.', '', '61a5caf447cae', '', '2022-04-20 10:27:48 AM'),
(519, 'updated user details.', 'updated details of user David Christoper LAZARO [UserID: 62451b84cb670].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-20 10:28:22 AM'),
(520, 'updated user login details.', 'updated login details of user lazaro.christoper01@gmail.com [UserID: 62451b84cb670].', '61a5caf447cae', 'https://inventory-system-test.000webhostapp.com/admin/users', '2022-04-20 10:28:22 AM'),
(521, 'logged in.', '', '62451b84cb670', '', '2022-04-20 10:31:26 AM'),
(522, 'logged out.', '', '61a5caf447cae', '', '2022-04-20 10:36:49 AM'),
(523, 'logged in.', '', '624252639e2e5', '', '2022-04-20 10:53:07 AM'),
(524, 'added new transaction.', 'released 80 for  SCB003DSPRMSCB150G [TransactionID: SCB003DSPRMSCB150G-625F819EE8296].', '624252639e2e5', 'https://inventory-system-test.000webhostapp.com/admin/viewproduct?code=SCB003DSPRMSCB150G', '2022-04-20 11:44:30 AM'),
(525, 'logged in.', '', '61a5caf447cae', '', '2022-04-20 11:50:09 AM'),
(526, 'logged out.', '', '61a5caf447cae', '', '2022-04-20 11:54:12 AM'),
(527, 'logged in.', '', '6254f07212f03', '', '2022-04-20 12:15:36 PM'),
(528, 'logged in.', '', '624252639e2e5', '', '2022-04-22 07:56:00 AM'),
(529, 'logged in.', '', '6254f07212f03', '', '2022-04-22 10:43:08 AM'),
(530, 'created a new purchase order.', 'added purchase order PO626216755AC22 [PurchaseOrderID: 1].', '6254f07212f03', 'https://inventory-system-test.000webhostapp.com/admin/view_purchase_order?orderNo=PO626216755AC22', '2022-04-22 10:44:05 AM'),
(531, 'logged in.', '', '62424e1258eb0', '', '2022-04-28 12:01:36 PM'),
(532, 'logged in.', '', '61a5caf447cae', '', '2022-04-29 08:37:30 AM'),
(533, 'logged in.', '', '61a5caf447cae', '', '2022-04-29 09:19:18 AM'),
(534, 'logged in.', '', '61a5caf447cae', '', '2022-04-29 09:43:49 AM'),
(535, 'logged in.', '', '61a5caf447cae', '', '2022-04-30 02:44:35 PM'),
(536, 'created a new sales order.', 'added sales order SO626CE0D8DAD14 [SalesOrderID: 2].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO626CE0D8DAD14', '2022-04-30 03:10:17 PM'),
(537, 'created a new account.', 'added a new account test [ID: 1].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-04-30 03:11:59 PM'),
(538, 'created a new sales order.', 'added sales order SO626CED1C73973 [SalesOrderID: 3].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO626CED1C73973', '2022-04-30 04:02:37 PM'),
(539, 'created a new sales order.', 'added sales order SO626CED1D75D00 [SalesOrderID: 4].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO626CED1D75D00', '2022-04-30 04:02:37 PM'),
(540, 'created a new sales order.', 'added sales order SO626CF22D55123 [SalesOrderID: 5].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO626CF22D55123', '2022-04-30 04:24:13 PM'),
(541, 'created a new sales order.', 'added sales order SO626CF24B904E9 [SalesOrderID: 6].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO626CF24B904E9', '2022-04-30 04:24:44 PM'),
(542, 'created a new sales order.', 'added sales order SO626CF3E6BB90D [SalesOrderID: 7].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO626CF3E6BB90D', '2022-04-30 04:31:35 PM'),
(543, 'created a new sales order.', 'added sales order SO626CF401533B8 [SalesOrderID: 8].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO626CF401533B8', '2022-04-30 04:32:02 PM'),
(544, 'created a new sales order.', 'added sales order SO626CF4A6D3929 [SalesOrderID: 9].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO626CF4A6D3929', '2022-04-30 04:34:48 PM'),
(545, 'added a new additional fee.', 'adde a new additional fee [ID: 2] for sales order [OrderNo: SO625D04AF6B9D2].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-30 06:34:28 PM'),
(546, 'removed adtl fee.', 'removed adtl fee [adtlFeeNo: AF626D10B4867FC].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-30 06:35:48 PM'),
(547, 'added a new additional fee.', 'adde a new additional fee [ID: 3] for sales order [OrderNo: SO625D04AF6B9D2].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-04-30 06:37:05 PM'),
(548, 'generated a new bill.', 'generated a new bill [ID: 1] for purchase order [OrderNo: PO626216755AC22].', '61a5caf447cae', 'https://localhost/manalok9/admin/bills', '2022-04-30 07:04:12 PM'),
(549, 'logged in.', '', '61a5caf447cae', '', '2022-04-30 10:19:01 PM'),
(550, 'logged in.', '', '61a5caf447cae', '', '2022-05-01 11:27:40 AM'),
(551, 'logged in.', '', '61a5caf447cae', '', '2022-05-01 08:57:01 PM'),
(552, 'logged in.', '', '61a5caf447cae', '', '2022-05-03 03:31:28 PM'),
(553, 'created a new account.', 'added a new account Rental Expense [ID: 1].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:13 PM'),
(554, 'created a new account.', 'added a new account Cash [ID: 2].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:23 PM'),
(555, 'created a new account.', 'added a new account Sales [ID: 3].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:34 PM'),
(556, 'created a new account.', 'added a new account Purchases [ID: 4].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:40 PM'),
(557, 'created a new account.', 'added a new account Accounts Payable [ID: 5].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:46 PM'),
(558, 'created a new account.', 'added a new account Office Supplies [ID: 6].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:52 PM'),
(559, 'created a new account.', 'added a new account Utilities expense [ID: 7].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:58 PM'),
(560, 'created a new account.', 'added a new account Account Receivable [ID: 8].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:32:07 PM'),
(561, 'created a new account.', 'added a new account Sales/Revenue [ID: 9].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:32:21 PM'),
(562, 'updated account details.', 'updated account details Rental Expense [ID: 1].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:32:32 PM'),
(563, 'updated account details.', 'updated account details Utilities expense [ID: 7].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:32:38 PM'),
(564, 'updated account details.', 'updated account details Account Receivable [ID: 8].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:32:57 PM'),
(565, 'updated account details.', 'updated account details Cash [ID: 2].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:33:01 PM'),
(566, 'updated account details.', 'updated account details Office Supplies [ID: 6].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:33:36 PM'),
(567, 'updated account details.', 'updated account details Accounts Payable [ID: 5].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:33:56 PM'),
(568, 'updated account details.', 'updated account details Purchases [ID: 4].', '61a5caf447cae', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:34:24 PM'),
(569, 'created a new journal.', 'added a new journal [ID: 1].', '61a5caf447cae', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:36:52 PM'),
(570, 'created a new journal.', 'added a new journal [ID: 2].', '61a5caf447cae', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:37:24 PM'),
(571, 'created a new journal.', 'added a new journal [ID: 3].', '61a5caf447cae', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:38:01 PM'),
(572, 'created a new journal.', 'added a new journal [ID: 4].', '61a5caf447cae', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:38:15 PM'),
(573, 'created a new journal.', 'added a new journal [ID: 5].', '61a5caf447cae', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:38:29 PM'),
(574, 'created a new journal.', 'added a new journal [ID: 6].', '61a5caf447cae', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:38:54 PM'),
(575, 'removed adtl fee.', 'removed adtl fee [adtlFeeNo: AF626D1150D9886].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO625D04AF6B9D2', '2022-05-03 06:24:31 PM'),
(576, 'added a new manual purchase transaction.', 'added a new manual purchase transaction [ID: 1] for purchase order [OrderNo: PO626216755AC22].', '61a5caf447cae', 'https://localhost/manalok9/admin/manual_transactions', '2022-05-03 06:27:54 PM'),
(577, 'removed manual transaction.', 'removed manual transaction [manualTransactionNo: MT627103AAAA0A0].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_purchase_order?orderNo=PO626216755AC22', '2022-05-03 06:31:26 PM'),
(578, 'added a new manual purchase transaction.', 'added a new manual purchase transaction [ID: 2] for purchase order [OrderNo: PO626216755AC22].', '61a5caf447cae', 'https://localhost/manalok9/admin/manual_transactions', '2022-05-03 06:37:42 PM'),
(579, 'added a new manual purchase transaction.', 'added a new manual purchase transaction [ID: 3] for purchase order [OrderNo: PO626216755AC22].', '61a5caf447cae', 'https://localhost/manalok9/admin/manual_transactions', '2022-05-03 06:39:48 PM'),
(580, 'created a new sales order.', 'added return RT627120209E57B [ReturnNo: RT627120209E57B].', '61a5caf447cae', 'https://localhost/manalok9/admin/returns', '2022-05-03 08:29:20 PM');
INSERT INTO `logbook` (`ID`, `Event`, `Description`, `UserID`, `PageURL`, `DateAdded`) VALUES
(581, 'added product to returns.', 'added transaction SDS002DSPRMORIG150 G-625D04AF72533 to return [ReturnNo: RT627120209E57B].', '61a5caf447cae', 'https://localhost/manalok9/admin/returns', '2022-05-03 08:38:03 PM'),
(582, 'added product to returns.', 'added transaction SDS002DSPRMORIG150 G-625D04AF72533 to return [ReturnNo: RT627120209E57B].', '61a5caf447cae', 'https://localhost/manalok9/admin/returns', '2022-05-03 08:46:09 PM'),
(583, 'added product to returns.', 'added transaction SDS002DSPRMORIG150 G-625D04AF72533 to return [ReturnNo: RT627120209E57B].', '61a5caf447cae', 'https://localhost/manalok9/admin/returns', '2022-05-03 08:46:25 PM'),
(584, 'added product to returns.', 'added transaction SDS002DSPRMORIG150 G-625D04AF72533 to return [ReturnNo: RT627120209E57B].', '61a5caf447cae', 'https://localhost/manalok9/admin/returns', '2022-05-03 08:46:39 PM'),
(585, 'added product to returns.', 'added transaction SDN001DFPRMORIG5KG-625D04AF6CDC8 to return [ReturnNo: RT627120209E57B].', '61a5caf447cae', 'https://localhost/manalok9/admin/returns', '2022-05-03 09:28:38 PM'),
(586, 'created a new sales order.', 'added sales order SO62713D828AABB [SalesOrderID: 10].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO62713D828AABB', '2022-05-03 10:34:43 PM'),
(587, 'approved sales order.', 'approved sales order SO62713D828AABB [SalesOrderID: 10].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO62713D828AABB', '2022-05-03 10:35:52 PM'),
(588, 'scheduled delivery.', 'scheduled delivery for sales order [No: SO62713D828AABB].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO62713D828AABB', '2022-05-03 10:35:57 PM'),
(589, 'marked SO as delivered.', 'sales order marked as delivered [No: SO62713D828AABB].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO62713D828AABB', '2022-05-03 10:36:01 PM'),
(590, 'created a new sales order.', 'added sales order SO6271404939B00 [SalesOrderID: 11].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6271404939B00', '2022-05-03 10:46:33 PM'),
(591, 'approved sales order.', 'approved sales order SO6271404939B00 [SalesOrderID: 11].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6271404939B00', '2022-05-03 10:46:39 PM'),
(592, 'scheduled delivery.', 'scheduled delivery for sales order [No: SO6271404939B00].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6271404939B00', '2022-05-03 10:46:42 PM'),
(593, 'marked SO as delivered.', 'sales order marked as delivered [No: SO6271404939B00].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6271404939B00', '2022-05-03 10:46:46 PM'),
(594, 'marked SO as received.', 'sales order marked as received [No: SO6271404939B00].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6271404939B00', '2022-05-03 10:46:50 PM'),
(595, 'added a new additional fee.', 'adde a new additional fee [ID: 4] for sales order [OrderNo: SO6271404939B00].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6271404939B00', '2022-05-03 10:52:27 PM'),
(596, 'logged in.', '', '61a5caf447cae', '', '2022-05-04 10:20:12 PM'),
(597, 'created a new client.', 'added a new client tet [ID: 4].', '61a5caf447cae', 'https://localhost/manalok9/admin/clients', '2022-05-04 11:23:56 PM'),
(598, 'created a new sales order.', 'added sales order SO62729C28D7A6E [SalesOrderID: 12].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO62729C28D7A6E', '2022-05-04 11:30:49 PM'),
(599, 'created a new sales order.', 'added sales order SO62729C48C4DEE [SalesOrderID: 13].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO62729C48C4DEE', '2022-05-04 11:31:22 PM'),
(600, 'created a new sales order.', 'added sales order SO62729C7285CF6 [SalesOrderID: 14].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO62729C7285CF6', '2022-05-04 11:32:03 PM'),
(601, 'logged in.', '', '61a5caf447cae', '', '2022-05-05 05:38:33 PM'),
(602, 'logged in.', '', '61a5caf447cae', '', '2022-05-05 09:38:17 PM'),
(603, 'logged out.', '', '61a5caf447cae', '', '2022-05-05 10:51:45 PM'),
(604, 'logged in.', '', '61a5caf447cae', '', '2022-05-05 10:51:47 PM'),
(605, 'updated user details.', 'updated details of user John Rogers Doe [UserID: 61a5caf447cae].', '61a5caf447cae', 'https://localhost/manalok9/admin/users', '2022-05-05 10:56:22 PM'),
(606, 'updated user login details.', 'updated login details of user test_admin@gmail.com [UserID: 61a5caf447cae].', '61a5caf447cae', 'https://localhost/manalok9/admin/users', '2022-05-05 10:56:22 PM'),
(607, 'deleted Sales Order.', 'sales order deleted [No: SO62729C7285CF6].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:05:20 PM'),
(608, 'deleted Sales Order.', 'sales order deleted [No: SO62729C48C4DEE].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:13:35 PM'),
(609, 'deleted Sales Order.', 'sales order deleted [No: SO62729C28D7A6E].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:13:41 PM'),
(610, 'deleted Sales Order.', 'sales order deleted [No: SO6271404939B00].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:13:53 PM'),
(611, 'deleted Sales Order.', 'sales order deleted [No: SO62713D828AABB].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:13:59 PM'),
(612, 'deleted Sales Order.', 'sales order deleted [No: SO626CF4A6D3929].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:06 PM'),
(613, 'deleted Sales Order.', 'sales order deleted [No: SO626CF401533B8].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:12 PM'),
(614, 'deleted Sales Order.', 'sales order deleted [No: SO626CF3E6BB90D].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:19 PM'),
(615, 'deleted Sales Order.', 'sales order deleted [No: SO626CF24B904E9].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:25 PM'),
(616, 'deleted Sales Order.', 'sales order deleted [No: SO626CF22D55123].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:30 PM'),
(617, 'deleted Sales Order.', 'sales order deleted [No: SO626CED1D75D00].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:35 PM'),
(618, 'deleted Sales Order.', 'sales order deleted [No: SO626CED1C73973].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:41 PM'),
(619, 'deleted Sales Order.', 'sales order deleted [No: SO626CE0D8DAD14].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:46 PM'),
(620, 'deleted Sales Order.', 'sales order deleted [No: SO625D04AF6B9D2].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:56 PM'),
(621, 'created a new sales order.', 'added sales order SO6273EA988E0D1 [SalesOrderID: 15].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-05 11:17:45 PM'),
(622, 'approved sales order.', 'approved sales order SO6273EA988E0D1 [SalesOrderID: 15].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-05 11:18:40 PM'),
(623, 'added a new additional fee.', 'adde a new additional fee [ID: 5] for sales order [OrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-05 11:18:53 PM'),
(624, 'added new replacement.', 'added replacement RP6273ECD3CEA6C to sales order [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-05 11:27:15 PM'),
(625, 'approved replacement.', 'approved replacement RP6273ECD3CEA6C [SalesOrderNo: 15].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-05 11:27:20 PM'),
(626, 'deleted replacement.', 'deleted replacement RP6273ECD3CEA6C [SalesOrderNo: ].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=', '2022-05-05 11:27:26 PM'),
(627, 'logged out.', '', '61a5caf447cae', '', '2022-05-05 11:54:04 PM'),
(628, 'logged in.', '', '61a5caf447cae', '', '2022-05-05 11:54:05 PM'),
(629, 'deleted SO transaction.', 'deleted SO transaction SHS004HSPRMPINK150G-6273EA98ECFF3 [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-05 11:56:44 PM'),
(630, 'added new transaction.', 'added transaction SDS002DSPRMYP150 G-6273FEA1EF416 to sales order [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-06 12:43:14 AM'),
(631, 'added new transaction.', 'added transaction SDN001DFPRMORIG500G-6273FFB555521 to sales order [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-06 12:47:49 AM'),
(632, 'added new transaction.', 'added transaction SDN001DFPRMORIG15KG-6273FFC9D3CAA to sales order [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-06 12:48:10 AM'),
(633, 'deleted SO transaction.', 'deleted SO transaction SDN001DFPRMORIG15KG-6273FFC9D3CAA [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-06 12:48:38 AM'),
(634, 'scheduled delivery.', 'scheduled delivery for sales order [No: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-06 12:48:45 AM'),
(635, 'marked SO as delivered.', 'sales order marked as delivered [No: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-06 12:48:50 AM'),
(636, 'added new transaction.', 'added transaction SDN001DFPRMORIG500G-62740028B648B to sales order [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-06 12:49:45 AM'),
(637, 'logged in.', '', '61a5caf447cae', '', '2022-05-10 09:43:10 PM'),
(638, 'logged in.', '', '61a5caf447cae', '', '2022-05-11 07:03:02 AM'),
(639, 'logged in.', '', '61a5caf447cae', '', '2022-05-12 06:45:40 AM'),
(640, 'deleted SO transaction.', 'deleted SO transaction SDS002DSPRMYP150 G-6273FEA1EF416 [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-12 07:16:30 AM'),
(641, 'deleted SO transaction.', 'deleted SO transaction SDN001DFPRMORIG500G-6273FFB555521 [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-12 07:19:37 AM'),
(642, 'added new transaction.', 'added transaction SDS002DSPRMORIG150 G-627C45A1CD5A4 to sales order [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-12 07:24:18 AM'),
(643, 'added new transaction.', 'added transaction SDS002DSPRMAC150 G-627C48FB8F62F to sales order [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-12 07:38:36 AM'),
(644, 'deleted SO transaction.', 'deleted SO transaction SDN001DFPRMORIG500G-62740028B648B [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-12 07:39:00 AM'),
(645, 'deleted SO transaction.', 'deleted SO transaction SDS002DSPRMORIG150 G-627C45A1CD5A4 [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-12 07:39:04 AM'),
(646, 'updated remarks.', 'updated remarks for sales order [No: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-12 07:40:49 AM'),
(647, 'logged in.', '', '61a5caf447cae', '', '2022-05-12 12:42:21 PM'),
(648, 'logged in.', '', '61a5caf447cae', '', '2022-05-12 12:42:22 PM'),
(649, 'added new transaction.', 'added transaction SHS004HSPRMPINK150G-627C907B27293 to sales order [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-12 12:43:41 PM'),
(650, 'deleted SO transaction.', 'deleted SO transaction SHS004HSPRMPINK150G-627C907B27293 [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-12 12:44:01 PM'),
(651, 'added new transaction.', 'added transaction SHS004HSPRMPINK150G-627C90B430B77 to sales order [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-12 12:44:38 PM'),
(652, 'deleted SO transaction.', 'deleted SO transaction SHS004HSPRMPINK150G-627C90B430B77 [SalesOrderNo: SO6273EA988E0D1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6273EA988E0D1', '2022-05-12 12:45:00 PM'),
(653, 'created a new sales order.', 'added sales order SO627C90F684FF8 [SalesOrderID: 16].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO627C90F684FF8', '2022-05-12 12:45:43 PM'),
(654, 'deleted SO transaction.', 'deleted SO transaction SHS004HSPRMPINK150G-627C90F6CD6C8 [SalesOrderNo: SO627C90F684FF8].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO627C90F684FF8', '2022-05-12 12:45:58 PM'),
(655, 'added new transaction.', 'added transaction SHS004HSPRMBLUE150G-627C91194FFEE to sales order [SalesOrderNo: SO627C90F684FF8].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO627C90F684FF8', '2022-05-12 12:46:17 PM'),
(656, 'deleted SO transaction.', 'deleted SO transaction SHS004HSPRMBLUE150G-627C91194FFEE [SalesOrderNo: SO627C90F684FF8].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO627C90F684FF8', '2022-05-12 12:46:27 PM'),
(657, 'added new transaction.', 'added transaction SHS004HSPRMPINK150G-627C91341724D to sales order [SalesOrderNo: SO627C90F684FF8].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO627C90F684FF8', '2022-05-12 12:46:44 PM'),
(658, 'deleted Sales Order.', 'sales order deleted [No: SO627C90F684FF8].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:47:06 PM'),
(659, 'created a new sales order.', 'added sales order SO627C91B619408 [SalesOrderID: 17].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO627C91B619408', '2022-05-12 12:48:54 PM'),
(660, 'deleted Sales Order.', 'sales order deleted [No: SO627C91B619408].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:49:17 PM'),
(661, 'logged in.', '', '61a5caf447cae', '', '2022-05-17 07:41:10 PM'),
(662, 'created a new sales order.', 'added sales order 1 [SalesOrderID: 18].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=1', '2022-05-17 08:32:45 PM'),
(663, 'created a new sales order.', 'added sales order MK9-22-0000002 [SalesOrderID: 19].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=MK9-22-0000002', '2022-05-17 08:33:25 PM'),
(664, 'created a new sales order.', 'added sales order MK9-22-0000004 [SalesOrderID: 20].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=MK9-22-0000004', '2022-05-17 08:34:12 PM'),
(665, 'created a new purchase order.', 'added purchase order PO6283A2831A1A7 [PurchaseOrderID: 2].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_purchase_order?orderNo=PO6283A2831A1A7', '2022-05-17 09:26:27 PM'),
(666, 'added a new manual purchase transaction.', 'added a new manual purchase transaction [ID: 4] for purchase order [OrderNo: PO6283A2831A1A7].', '61a5caf447cae', 'https://localhost/manalok9/admin/manual_transactions', '2022-05-17 10:02:48 PM'),
(667, 'generated a new bill.', 'generated a new bill [ID: 2].', '61a5caf447cae', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:28:26 PM'),
(668, 'generated a new bill.', 'generated a new bill [ID: 3].', '61a5caf447cae', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:29:00 PM'),
(669, 'deleted bill.', 'deleted bill [No: B626D17ACB50F6].', '61a5caf447cae', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:43:40 PM'),
(670, 'generated a new bill.', 'generated a new bill [ID: 4].', '61a5caf447cae', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:59:25 PM');

-- --------------------------------------------------------

--
-- Table structure for table `manual_transactions`
--

CREATE TABLE `manual_transactions` (
  `ID` int(11) NOT NULL,
  `ManualTransactionNo` varchar(64) DEFAULT NULL,
  `ItemNo` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Qty` int(11) DEFAULT NULL,
  `UnitCost` varchar(255) DEFAULT NULL,
  `Date` varchar(50) DEFAULT NULL,
  `OrderNo` varchar(255) DEFAULT NULL,
  `Status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manual_transactions`
--

INSERT INTO `manual_transactions` (`ID`, `ManualTransactionNo`, `ItemNo`, `Description`, `Qty`, `UnitCost`, `Date`, `OrderNo`, `Status`) VALUES
(2, 'MT627105F693788', 'TST001', 'Test1', 3, '500', '2022-05-03 18:37:42', 'PO626216755AC22', 1),
(3, 'MT6271067444554', 'TAT', 'TSTW', 10, '300', '2022-05-03 18:39:48', 'PO626216755AC22', 1),
(4, 'MT6283AB0857D43', 'sde', 'dgdfg', 5, '4463', '2022-05-17 22:02:48', 'PO6283A2831A1A7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `U_ID` varchar(255) DEFAULT NULL,
  `Code` varchar(255) DEFAULT NULL,
  `Product_Name` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `InStock` int(255) DEFAULT 0,
  `Released` int(255) DEFAULT 0,
  `Product_Category` varchar(255) DEFAULT NULL,
  `Product_Weight` varchar(255) DEFAULT NULL,
  `Price_PerItem` varchar(255) DEFAULT NULL,
  `Cost_PerItem` varchar(255) DEFAULT NULL,
  `DateAdded` varchar(255) DEFAULT NULL,
  `PriceSelling` varchar(255) DEFAULT '0',
  `Barcode_Images` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL COMMENT '1 = added\r\n2 = archive\r\n3 = removed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `U_ID`, `Code`, `Product_Name`, `Description`, `InStock`, `Released`, `Product_Category`, `Product_Weight`, `Price_PerItem`, `Cost_PerItem`, `DateAdded`, `PriceSelling`, `Barcode_Images`, `Status`) VALUES
(33, '673068742688', 'SDN001DFPRMORIG500G', 'SDN DOGFOOD  ORIGINAL 500 G', 'ORIGINAL', 431, 30, 'PRM', '500G', '200', '79.80', '2022-01-26 10:54:08 AM', '0', 'assets/barcode_images/673068742688-pbarcode.png', 1),
(34, '709591752686', 'SDN001DFPRMORIG5KG', 'SDN DOGFOOD ORIGINAL 5KG', 'ORIGINAL', 4873, 100, 'PRM', '5KG', '1100.00', '452.95', '2022-01-26 01:10:56 PM', '0', 'assets/barcode_images/709591752686-pbarcode.png', 1),
(35, '503263540983', 'SDN001DFPRMORIG15KG', 'SDN DOGFOOD ORIGINAL  15KG', 'ORIGINAL', 3323, 0, 'PRM', '15KG', '3245.00', '1347.65', '2022-01-26 01:11:51 PM', '0', 'assets/barcode_images/503263540983-pbarcode.png', 1),
(37, '389509193021', 'SDS002DSPRMYP150 G', 'SDS YOUNG PUPPIES 150 G', 'YP', 14657, 6, 'PRM', '150 G', '150.00', '31.00', '2022-01-26 01:22:35 PM', '0', 'assets/barcode_images/389509193021-pbarcode.png', 1),
(38, '305096204785', 'SDS002DSPRMMC150 G', 'SDS MINTY COOL 150G ', 'MC', 15679, 0, 'PRM', '150 G', '150.00', '31.00', '2022-01-26 01:24:36 PM', '0', 'assets/barcode_images/305096204785-pbarcode.png', 1),
(39, '610840330961', 'SDS002DSPRMORIG150 G', 'SDS 5 IN1 ORIGINAL 150G ', '5 IN1 ORIGINAL', 5192, 140, 'PRM', '150 G', '150.00', '31.00', '2022-01-26 01:25:58 PM', '0', 'assets/barcode_images/610840330961-pbarcode.png', 1),
(40, '295065421248', 'SDS002DSPRMAC150 G', 'SDS ACTIVATED CHARCOAL 150G ', 'AC', 6092, 60, 'PRM', '150 G', '150.00', '31.00', '2022-01-26 01:26:40 PM', '0', 'assets/barcode_images/295065421248-pbarcode.png', 1),
(41, '460191712132', 'SCB003DSPRMSCB150G', 'SDS SHAMPOO AND CONDITIONER BAR 150G', 'SCB', 18733, 90, 'PRM', '150G', '150.00', '28.50', '2022-01-26 01:27:11 PM', '0', 'assets/barcode_images/460191712132-pbarcode.png', 1),
(42, '152418113111', 'POT004DPPRMPOT150 G ', 'POWTECH  POWDER 150G ', 'POWTECH', 1083, 0, 'PRM', '150 G ', '150.00', '70.00', '2022-01-26 01:33:03 PM', '0', 'assets/barcode_images/152418113111-pbarcode.png', 1),
(45, '698562504594', 'SHS004HSPRMBLUE150G', 'SUPER DOC HITECH SOAP BLUE 150G', 'SHS BLUE', 4978, 2490, 'PRM', '150G', '150.00', '31.00', '2022-01-26 02:35:48 PM', '0', 'assets/barcode_images/698562504594-pbarcode.png', 1),
(46, '577207308284', 'SHS004HSPRMPINK150G', 'SUPER DOC HITECH SOAP PINK 150G', 'SHS PINK', 9571, 7600, 'PRM', '150G', '150.00', '31.00', '2022-01-26 02:36:42 PM', '0', 'assets/barcode_images/577207308284-pbarcode.png', 1),
(47, '863993147614', 'MK9005MERCHTSVNECKXS', 'MK9 T-SHIRT V-NECK EXTRA SMALL', 'MK9 LOGO | XS', 0, 0, 'TS', 'XS', '500.00', '157.40', '2022-01-26 02:53:43 PM', '0', 'assets/barcode_images/863993147614-pbarcode.png', 1),
(48, '267201450035', 'MK9005MERCHTSVNECKS', 'MK9 T-SHIRT V-NECK SMALL', 'MK9 LOGO | S', 38, 0, 'TS', 'S', '500.00', '157.40', '2022-01-26 03:18:05 PM', '0', 'assets/barcode_images/267201450035-pbarcode.png', 1),
(49, '836978213027', 'MK9005MERCHTSVNECKM', 'MK9 T-SHIRT V-NECK MEDIUM ', 'MK9 LOGO | M', 36, 0, 'TS', 'M', '500.00', '157.40', '2022-01-27 10:27:36 AM', '0', 'assets/barcode_images/836978213027-pbarcode.png', 1),
(50, '348261321516', 'MK9005MERCHTSVNECKL', 'MK9 T-SHIRT V-NECK LARGE ', 'MK9 LOGO | L', 29, 0, 'TS', 'L', '500.00', '157.40', '2022-01-27 10:30:15 AM', '0', 'assets/barcode_images/348261321516-pbarcode.png', 1),
(51, '268332374368', 'MK9005MERCHTSVNECKXL', 'MK9 T-SHIRT V-NECK  EXTRA LARGE ', 'MK9 LOGO | XL', 38, 0, 'TS', 'XL', '500.00', '157.40', '2022-01-27 10:30:51 AM', '0', 'assets/barcode_images/268332374368-pbarcode.png', 1),
(52, '752875585619', 'MK9005MERCHTSVNECK2XL', 'MK9 T-SHIRT V-NECK EXTRA EXTRA LARGE ', 'MK9 LOGO | 2XL', 0, 0, 'TS', '2XL', '500.00', '157.40', '2022-01-27 10:31:35 AM', '0', 'assets/barcode_images/752875585619-pbarcode.png', 1),
(53, '849855046474', 'MK9006MERCHTSROUNDXS', 'MK9 T-SHIRT ROUND EXTRA SMALL', 'MK9 LOGO | XS', 28, 0, 'TS', 'XS', '500.00', '157.40', '2022-01-28 01:26:37 PM', '0', 'assets/barcode_images/849855046474-pbarcode.png', 1),
(54, '163889315201', 'MK9006MERCHTSROUNDS', 'MK9 T-SHIRT ROUND SMALL', 'MK9 LOGO | S', 6, 0, 'TS', 'S', '500.00', '157.40', '2022-01-28 01:27:50 PM', '0', 'assets/barcode_images/163889315201-pbarcode.png', 1),
(55, '545199272285', 'MK9006MERCHTSROUNDM', 'MK0 T-SHIRT ROUND MEDIUM', 'MK9 LOGO | M', 33, 0, 'TS', 'M', '500.00', '157.40', '2022-01-28 01:29:00 PM', '0', 'assets/barcode_images/545199272285-pbarcode.png', 1),
(56, '678267141100', 'MK9006MERCHTSROUNDL', 'MK9 T-SHIRT ROUND LARGE ', 'MK9 LOGO | L', 29, 0, 'TS', 'L', '500.00', '157.40', '2022-01-28 01:29:33 PM', '0', 'assets/barcode_images/678267141100-pbarcode.png', 1),
(57, '551309602225', 'MK9006MERCHTSROUNDXL', 'MK9 T-SHIRT ROUND EXTRA LARGE ', 'MK9 LOGO | XL', 24, 0, 'TS', 'XL', '500.00', '157.40', '2022-01-28 01:30:17 PM', '0', 'assets/barcode_images/551309602225-pbarcode.png', 1),
(58, '619058165690', 'MK9006MERCHTSROUND2XL', 'MK9 T-SHIRT ROUND EXTRA EXTRA LARGE ', 'MK9 LOGO | 2XL', 2, 0, 'TS', '2XL', '500.00', '157.40', '2022-01-28 01:30:55 PM', '0', 'assets/barcode_images/619058165690-pbarcode.png', 1),
(59, '065568322251', 'SDN001DFPRMORIG1KG', 'SDN DOGFOOD ORIGINAL 1KG', 'SDN | 1KG', 0, 0, 'PRM', '1KG', '259.75', '109.24', '2022-01-29 03:55:19 PM', '0', 'assets/barcode_images/065568322251-pbarcode.png', 1),
(61, '704992641756', 'MK9007MERCHTSICGDXS', 'MK9 T-SHIRT  ICGD EXTRA SMALL', 'ICGD LOGO | XS', 19, 0, 'TS', 'XS', '350.00', '157.40', '2022-02-09 10:36:15 AM', '0', 'assets/barcode_images/704992641756-pbarcode.png', 1),
(62, '833259988634', 'MK9007MERCHTSICGDS', 'MK9 T-SHIRT   ICGD SMALL', 'ICGD LOGO | S', 19, 0, 'TS', 'S', '350.00', '157.40', '2022-02-09 11:00:16 AM', '0', 'assets/barcode_images/833259988634-pbarcode.png', 1),
(63, '181222203997', 'MK9007MERCHTSICGDM', 'MK9 T-SHIRT  ICGD MEDIUM', 'ICGD LOGO | M', 10, 0, 'TS', 'M', '350.00', '157.40', '2022-02-09 11:01:53 AM', '0', 'assets/barcode_images/181222203997-pbarcode.png', 1),
(65, '827093288321', 'MK9007MERCHTSICGDL', 'MK9 T-SHIRT  ICGD LARGE ', 'ICGD LOGO | L', 5, 0, 'TS', 'L', '350.00', '157.40', '2022-02-09 11:05:28 AM', '0', 'assets/barcode_images/827093288321-pbarcode.png', 1),
(66, '398071086767', 'MK9007MERCHTSICGDXL', 'MK9 T-SHIRT  ICGD EXTRA LARGE ', 'ICGD LOGO | XL', 7, 0, 'TS', 'XL', '350.00', '157.40', '2022-02-09 11:06:59 AM', '0', 'assets/barcode_images/398071086767-pbarcode.png', 1),
(67, '347071073154', 'MK9007MERCHTSICGD2XL', 'MK9 T-SHIRT ICGD EXTRA EXTRA LARGE ', 'ICGD LOGO | 2XL', 38, 0, 'TS', '2XL', '350.00', '157.40', '2022-02-09 11:08:27 AM', '0', 'assets/barcode_images/347071073154-pbarcode.png', 1),
(68, '603093634198', 'MK9008MERCHTSSDXS', 'MK9 T-SHIRT SUPERDOGGERS EXTRA SMALL', 'SUPERDOGGERS LOGO / XS', 5, 0, 'TS', 'XS', '350.00', '157.40', '2022-02-16 10:37:13 AM', '0', 'assets/barcode_images/603093634198-pbarcode.png', 1),
(69, '317770704841', 'MK9008MERCHTSSDS', 'MK9 T-SHIRT SUPERDOGGERS SMALL', 'SUPERDOGGERS LOGO | S', 4, 0, 'TS', 'S', '350.00', '157.40', '2022-02-16 11:38:22 AM', '0', 'assets/barcode_images/317770704841-pbarcode.png', 1),
(70, '467040399410', 'MK9008MERCHTSSDM', 'MK9 T-SHIRT SUPERDOGGERS MEDIUM', 'SUPERDOGGERS | M\r\n', 0, 0, 'TS', 'M', '350.00', '157.40', '2022-02-16 11:57:03 AM', '0', 'assets/barcode_images/467040399410-pbarcode.png', 1),
(71, '300083336346', 'MK9008MERCHTSSDL', 'MK9 T-SHIRT SUPERDOGGERS LARGE ', 'SUPERDOGGERS LOGO | L', 0, 0, 'TS', 'L', '350.00', '157.40', '2022-02-16 11:58:04 AM', '0', 'assets/barcode_images/300083336346-pbarcode.png', 1),
(72, '054345304771', 'MK9008MERCHTSSDXL', 'MK9 T-SHIRT SUPERDOGGERS EXTRA LARGE ', 'SUPERDOGGERS LOGO | XL', 0, 0, 'TS', 'XL', '350.00', '157.40', '2022-02-16 11:59:12 AM', '0', 'assets/barcode_images/054345304771-pbarcode.png', 1),
(73, '574166262403', 'MK9008MERCHTSSDXXL', 'MK9 T-SHIRT SUPERDOGGERS EXTRA EXTRA LARGE ', 'SUPERDOGGERS | 2XL', 15, 0, 'TS', 'XXL', '350.00', '157.40', '2022-02-16 12:00:18 PM', '0', 'assets/barcode_images/574166262403-pbarcode.png', 1),
(74, '307321132513', 'MK9009MERCHTSWADXS', 'MK9 SANDO WITH A DOG EXTRA SMALL', 'WITH A DOG LOGO | XS', 0, 0, 'TS', 'XS', '350', '123.81', '2022-02-16 01:17:32 PM', '0', 'assets/barcode_images/307321132513-pbarcode.png', 1),
(75, '277624416384', 'MK9009MERCHTSWADS', 'MK9 SANDO WITH A DOG SMALL ', ' WITH A DOG LOGO | S', 1, 0, 'TS', 'S', '123.81', '350.00', '2022-02-16 01:42:05 PM', '0', 'assets/barcode_images/277624416384-pbarcode.png', 1),
(76, '466107403295', 'MK9009MERCHTSWADM', 'MK9 SANDO WITH A DOG MEDIUM ', 'WITH A DOG LOGO | MEDIUM ', 6, 0, 'TS', 'M', '123.81', '350.00', '2022-02-16 01:42:57 PM', '0', 'assets/barcode_images/466107403295-pbarcode.png', 1),
(77, '291156290831', 'MK9009MERCHTSWADL', 'MK9 SANDO WITH A DOG LARGE ', 'WITH A DOG LOGO | L', 3, 0, 'TS', 'L', '123.81', '350.00', '2022-02-16 01:43:46 PM', '0', 'assets/barcode_images/291156290831-pbarcode.png', 1),
(78, '070549738720', 'MK9009MERCHTSWADXL', 'MK9 SANDO WITH A DOG  EXTRA LARGE ', 'WITH A DOG | XL', 2, 0, 'TS', 'XL', '123.81', '350.00', '2022-02-16 01:44:26 PM', '0', 'assets/barcode_images/070549738720-pbarcode.png', 1),
(79, '538124072215', 'MK9009MERCHTSWADXXL', 'MK9 SANDO WITH A DOG EXTRA EXTRA LARGE ', 'WITH A DOG LOGO |  XXL', 2, 0, 'TS', 'XXL', '123.81', '350.00', '2022-02-16 01:46:11 PM', '0', 'assets/barcode_images/538124072215-pbarcode.png', 1),
(80, '129018302492', 'MK9010MERCHSANDOYPSXS', 'MK9 SANDO  YOUR PAWS EXTRA SMALL ', 'YOUR PAWS LOGO | XS', 0, 0, 'SANDO', 'XS', '350.00', '123.81', '2022-02-16 02:00:06 PM', '0', 'assets/barcode_images/129018302492-pbarcode.png', 1),
(81, '660806621749', 'MK9010MERCHSANDOYPSS', 'MK9 SANDO YOUR PAWS SMALL', 'OUR PAWS LOGO | S', 2, 0, 'SANDO', 'S', '350.00', '123.81', '2022-02-16 02:03:24 PM', '0', 'assets/barcode_images/660806621749-pbarcode.png', 1),
(82, '313643673607', 'MK9010MERCHSANDOYPSM', 'MK9 SANDO YOUR PAWS MEDIUM', 'YOUR PAWS LOGO | M', 1, 0, 'SANDO', 'M', '350.00', '123.81', '2022-02-16 02:05:45 PM', '0', 'assets/barcode_images/313643673607-pbarcode.png', 1),
(83, '796275537042', 'MK9010MERCHSANDOYPSL', 'MK9 SANDO YOUR PAWS LARGE', 'YOUR PAWS LOGO | L', 4, 0, 'SANDO', 'L', '350.00', '123.81', '2022-02-16 02:06:31 PM', '0', 'assets/barcode_images/796275537042-pbarcode.png', 1),
(84, '969935535812', 'MK9010MERCHSANDOYPSXL', 'MK9 SANDO YOUR PAWS EXTRA LARGE ', 'YOUR PAWS LOGO | XL', 5, 0, 'SANDO', 'XL', '350.00', '123.81', '2022-02-16 02:19:05 PM', '0', 'assets/barcode_images/969935535812-pbarcode.png', 1),
(85, '799845854119', 'MK9010MERCHSANDOYPSXXL', 'MK9 SANDO YOUR PAWS EXTRA EXTRA LARGE', 'YOUR PAWS LOGO | XXL', 4, 0, 'SANDO', 'XXL', '350.00', '123.81', '2022-02-16 02:21:23 PM', '0', 'assets/barcode_images/799845854119-pbarcode.png', 1),
(86, '357190706877', 'MK9011MERCHSPAWSITIVEXS', 'MK9 SANDO PAWSITIVE  EXTRA SMALL', ' PAWSITIVE LOGO |  XS', 0, 0, 'S', 'XS', '350.00', '123.81', '2022-02-16 02:44:50 PM', '0', 'assets/barcode_images/357190706877-pbarcode.png', 2),
(87, '332176801839', 'MK9011MERCHSPAWSITIVES', 'MK9 SANDO PAWSITIVE SMALL', 'PAWSITIVE LOGO | S', 0, 0, 'S', 'S', '350.00', '123.81', '2022-02-16 02:50:04 PM', '0', 'assets/barcode_images/332176801839-pbarcode.png', 2),
(88, '709737765784', 'MK9011MERCHSANDOPAWSITIVEM', 'MK9 SANDO PAWSITIVE MEDIUM', 'PAWSITIVE LOGO | M', 5, 0, 'SANDO', 'M', '350.00', '123.81', '2022-02-16 04:08:38 PM', '0', 'assets/barcode_images/709737765784-pbarcode.png', 1),
(89, '632631532361', 'MK9011MERCHSANDOPAWSITIVEXS', 'MK9 SANDO PAWSITIVE  EXTRA SMALL', 'PAWSITIVE LOGO | XS', 0, 0, 'SANDO', 'XS', '350.00', '123.81', '2022-02-17 09:29:10 AM', '0', 'assets/barcode_images/632631532361-pbarcode.png', 1),
(90, '090173154793', 'MK9011MERCHSANDOPAWSITIVES', 'MK9 SANDO PAWSITIVE SMALL', 'PAWSITIVE LOGO | S', 2, 0, 'SANDO', 'S', '350.00', '123.81', '2022-02-17 09:49:03 AM', '0', 'assets/barcode_images/090173154793-pbarcode.png', 1),
(91, '000445190858', 'MK9011MERCHSANDOPAWSITIVEL', 'MK9 SANDO PAWSITIVE LARGE ', 'PAWSITIVE LOGO | L ', 1, 0, 'SANDO', 'L', '350.00', '123.81', '2022-02-18 08:28:54 AM', '0', 'assets/barcode_images/000445190858-pbarcode.png', 1),
(92, '455256666493', 'MK9011MERCHSANDOPAWSITIVEXL', 'MK9 SANDO PAWSITIVE EXTRA LARGE ', 'PAWSITIVE |  XL ', 4, 0, 'SANDO', 'XL', '350.00', '123.81', '2022-02-18 08:33:52 AM', '0', 'assets/barcode_images/455256666493-pbarcode.png', 1),
(93, '052057423528', 'MK9012MERCHFMMK9REDFZ', 'MK9 FACEMASK RED  FREE SIZE ', 'MK9 FACEMASK | RED ', 0, 0, 'FM', 'FZ', '150', '37.50', '2022-03-09 11:14:20 AM', '0', 'assets/barcode_images/052057423528-pbarcode.png', 2),
(94, '553691430335', 'MK9012MERCHFMMK9BLACKFZ', 'MK9 FACEMASK BLACK FREE SIZE', 'MK9 FACEMASK | BLACK', 0, 0, 'FM', 'FZ', '150', '37.50', '2022-03-09 11:15:54 AM', '0', 'assets/barcode_images/553691430335-pbarcode.png', 2),
(95, '843371961293', 'MK9012MERCHFMMK9GRAYFZ', 'MK9 FACEMASK GRAY FREE SIZE ', 'MK9 FACEMASK | GRAY\r\n', 0, 0, 'FM', 'FZ', '150', '37.50', '2022-03-09 11:16:45 AM', '0', 'assets/barcode_images/843371961293-pbarcode.png', 2),
(96, '848221451239', 'MK9012MERCHFMMK9GOLDREDFZ', 'MK9 FACEMASK GOLD RED FREE SIZE ', 'MK9 FACEMASK | GOLD RED\r\n', 0, 0, 'FM', 'FZ', '150.00', '37.50', '2022-03-09 11:18:59 AM', '0', 'assets/barcode_images/848221451239-pbarcode.png', 2),
(97, '488979674166', 'MK9012MERCHFMMK9REDFS', 'MK9 FACEMASK RED  FREE SIZE ', 'MK9 FACEMASK | RED', 73, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:38:13 AM', '0', 'assets/barcode_images/488979674166-pbarcode.png', 1),
(98, '727034093861', 'MK9012MERCHFMMK9BLACKFS', 'MK9 FACEMASK BLACK FREE SIZE', 'MK9 FACEMASK | BLACK ', 63, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:39:01 AM', '0', 'assets/barcode_images/727034093861-pbarcode.png', 1),
(99, '037283241294', 'MK9012MERCHFMMK9GRAYFS', 'MK9 FACEMASK GRAY FREE SIZE ', 'MK9 FACEMASK | GRAY ', 94, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:39:36 AM', '0', 'assets/barcode_images/037283241294-pbarcode.png', 1),
(100, '698151169290', 'MK9012MERCHFMMK9 GOLD REDFS', 'MK9 FACEMASK GOLD RED FREE SIZE ', 'MK9 FACEMASK | GOLD RED ', 0, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:40:21 AM', '0', 'assets/barcode_images/698151169290-pbarcode.png', 2),
(101, '334938794184', 'MK9012MERCHFMMK9GOLDREDFS', 'MK9 FACEMASK GOLD RED FREE SIZE ', 'MK9 FACEMASK | GOLD RED', 89, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:44:34 AM', '0', 'assets/barcode_images/334938794184-pbarcode.png', 1),
(102, '416711264764', 'MK9012MERCHFMICGDWHITEFS', 'MK9 FACEMASK ICGD WHITE FREE SIZE ', 'MK9 FACEMASK | ICGD WHITE', 130, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:45:09 AM', '0', 'assets/barcode_images/416711264764-pbarcode.png', 1),
(103, '669944895489', 'MK9012MERCHFMICGDBLACKFS', 'MK9  FACEMASK  ICGD BLACK FREE SIZE ', 'MK9  FACEMASK  | ICGD BLACK ', 100, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:45:48 AM', '0', 'assets/barcode_images/669944895489-pbarcode.png', 1),
(104, '953145585349', 'MK9 SJ013MERCHSJMK9SJWHITEFS', 'MK9 SPORTS JUG WHITE FREE SIZE ', 'MK9 SPORTS JUG | WHITE ', 0, 0, 'SJ', 'FS', '250.00', '100.00', '2022-03-09 11:52:47 AM', '0', 'assets/barcode_images/953145585349-pbarcode.png', 2),
(105, '035817487583', 'MK9 SJ013MERCHSJMK9SJSILVEFS', 'MK9 SPORTS JUG SILVER FREESIZE ', 'SPORTS JUG | SILVER', 0, 0, 'SJ', 'FS', '250.00', '100.00', '2022-03-09 11:54:30 AM', '0', 'assets/barcode_images/035817487583-pbarcode.png', 2),
(107, '344970933874', 'MK9UMB014MERCHUMBUMBWHITEFS', 'MK9 UMBRELLA  WHITE  FREESIZE ', 'MK9 UMBRELLA  | WHITE  ', 37, 0, 'UMB', 'FS', '200.00', '100.00', '2022-03-09 01:03:44 PM', '0', 'assets/barcode_images/344970933874-pbarcode.png', 2),
(108, '911763444406', 'MK9 MC015MERCHMCMCBWFS', 'MK9 MESH CAP BLACK AND WHITE ', 'MESH CAP | BLACK AND WHITE ', 0, 0, 'MC', 'FS', '200.00', '85.00', '2022-03-09 01:18:57 PM', '0', 'assets/barcode_images/911763444406-pbarcode.png', 2),
(109, '782068011912', 'MC015MERCHMCMCBWFS', 'MK9 MESH CAP BLACK AND WHITE', 'MK9 MESH CAP | BLACK AND WHITE', 0, 0, 'MC', 'FS', '200.00', '85.00', '2022-03-09 01:28:09 PM', '0', 'assets/barcode_images/782068011912-pbarcode.png', 2),
(110, '085243664870', 'MK9MC015MERCHMCMCBWFS', 'MK9 MESH CAP BLACK AND WHITE ', 'MK9 MESH CAP | BLACK AND WHITE', 82, 0, 'MC', 'FS', '200.00', '85.00', '2022-03-09 01:30:44 PM', '0', 'assets/barcode_images/085243664870-pbarcode.png', 2),
(111, '369348302449', 'MK9014MERCHUMBWHITEFS', 'MK9 UMBRELLA  WHITE  FREESIZE ', 'MK9 UMBRELLA | WHITE ', 37, 0, 'UMB', 'FS', '200.00', '100.00', '2022-03-09 02:05:33 PM', '0', 'assets/barcode_images/369348302449-pbarcode.png', 1),
(112, '478607429771', 'MK9015MERCHMCBLACK&WHITEFS', 'MK9 MESH CAP BLACK AND WHITE FREESIZE ', 'MK9 MESH CAP | BLACK AND WHITE  ', 82, 0, 'MC', 'FS', '200.00', '85.00', '2022-03-09 02:14:20 PM', '0', 'assets/barcode_images/478607429771-pbarcode.png', 1),
(113, '412935801982', 'MK9016MERCHALARMYGREENADULTFS', 'MK9 LEASH ARMY GREEN ADULT ', 'MK9 LEASH | ARMY GREEN ADULT ', 0, 0, 'AL', 'FS', '1200.00', '450.00', '2022-03-09 02:20:27 PM', '0', 'assets/barcode_images/412935801982-pbarcode.png', 2),
(114, '109044199381', 'MK9016MERCHALBLACKADULTFS', 'MK9 LEASH BLACK ADULT ', 'MK9 LEASH | BLACK ADULT ', 0, 0, 'AL', 'FS', '1200', '450.00', '2022-03-09 02:21:23 PM', '0', 'assets/barcode_images/109044199381-pbarcode.png', 2),
(115, '806099910158', 'MK9016MERCHALBEIGEADULTFS', 'MK9 LEASH BEIGE ADULT ', 'MK9 LEASH | BEIGE ADULT ', 0, 0, 'AL', 'FS', '1200.00', '450.00', '2022-03-09 02:22:04 PM', '0', 'assets/barcode_images/806099910158-pbarcode.png', 2),
(116, '939956457637', 'MK9016MERCHLEASHARMYGREENADULTAS', 'MK9 LEASH ARMY GREEN ADULT ', 'MK9 LEASH | ARMY GREEN ADULT ', 0, 0, 'LEASH', 'AS', '1200', '450.00', '2022-03-09 02:40:57 PM', '0', 'assets/barcode_images/939956457637-pbarcode.png', 2),
(117, '759968444574', 'MK9016MERCHLEASHBLACKADULTAS', 'MK9 LEASH BLACK ADULT ', 'MK9 LEASH | BLACK ADULT ', 0, 0, 'LEASH', 'AS', '1200.00', '450.00', '2022-03-09 02:41:30 PM', '0', 'assets/barcode_images/759968444574-pbarcode.png', 2),
(118, '715587590197', 'MK9016MERCHLEASHBEIGEADULTAS', 'MK9 LEASH BEIGE ADULT ', 'MK9 LEASH BEIGE ADULT ', 0, 0, 'LEASH', 'AS', '1200.00', '450.00', '2022-03-09 02:42:04 PM', '0', 'assets/barcode_images/715587590197-pbarcode.png', 2),
(119, '569253218928', 'MK9017MERCHCOLLARARMYGREENADULTAS', 'MK9 COLLAR ARMY GREEN ADULT ', 'MK9 COLLAR | ARMY GREEN ADULT ', 0, 0, 'COLLAR', 'AS', '2200.00', '800', '2022-03-09 02:54:02 PM', '0', 'assets/barcode_images/569253218928-pbarcode.png', 2),
(120, '249979617010', 'MK9017MERCHCOLLARBLACKADULTAS', 'MK9 COLLAR BLACK ADULT ', 'MK9 COLLAR | BLACK ADULT ', 0, 0, 'COLLAR', 'AS', '2200.00', '800', '2022-03-09 02:56:05 PM', '0', 'assets/barcode_images/249979617010-pbarcode.png', 2),
(121, '437154435534', 'MK9020MERCHMUGSUPPERDOGGERSMUGFS', 'MK9 MUG SUPERDOGGERS  FREE SIZE ', 'MK9 MUG | SUPERDOGGERS  ', 0, 0, 'MUG', 'FS', '250.00', '100.00', '2022-03-09 03:58:18 PM', '0', 'assets/barcode_images/437154435534-pbarcode.png', 2),
(122, '907192492323', 'MK9020MERCHMGSUPPERDOGGERSMUGFS', 'MK9 MUG SUPERDOGGERS  FREE SIZE ', 'MK9 MUG | SUPERDOGGERS', 36, 0, 'MG', 'FS', '250.00', '100.00', '2022-03-09 04:12:11 PM', '0', 'assets/barcode_images/907192492323-pbarcode.png', 1),
(123, '024433665861', 'MK9020MERCHMGMANALOK9LOGOMUGFS', 'MK9 MUG MANALO K9 FREE SIZE', 'MK9 MUG | MANALO K9 ', 92, 0, 'MG', 'FS', '200.00', '74.00', '2022-03-09 04:14:20 PM', '0', 'assets/barcode_images/024433665861-pbarcode.png', 1),
(124, '337284131266', 'MK9020MERCHMGMAGICMUGFS', 'MK9 MAGIC MUG FREESIZE ', 'MK9 | MAGIC MUG ', 48, 0, 'MG', 'FS', '350.00', '99.00', '2022-03-09 04:18:01 PM', '0', 'assets/barcode_images/337284131266-pbarcode.png', 1),
(125, '724146198274', 'MK9 SJ013MERCHSJWHITEFS', 'MK9 SPORTS JUG WHITE FREESIZE ', 'MK9 SPORTS JUG | WHITE', 0, 0, 'SJ', 'FS', '250.00', '65.00', '2022-03-16 04:36:56 PM', '0', 'assets/barcode_images/724146198274-pbarcode.png', 2),
(126, '681473379354', 'MK9 013MERCHSJWHITEFS', 'MK9 SPORTS JUG WHITE FREESIZE ', 'MK9 SPORTS JUG | WHITE ', 0, 0, 'SJ', 'FS', '250.00', '65.00', '2022-03-16 04:42:19 PM', '0', 'assets/barcode_images/681473379354-pbarcode.png', 2),
(127, '544331347118', 'MK90021MERCHBAGWHITEBAG WHITE10', 'MK9 CANVASS BAG WHITE   10\"X 12\"', 'MK9 CANVASS BAG WHITE  | 10\"X 12\"', 0, 0, 'BAGWHITE', '10', '150.00', '65.00', '2022-03-17 03:46:02 PM', '0', 'assets/barcode_images/544331347118-pbarcode.png', 2),
(128, '164769382756', 'MK90021MERCHCANBAGCANBAG10', 'MK9 CANVASS BAG WHITE  ', 'MK9 CANVASS BAG | WHITE 10\"X12\"', 118, 0, 'CANBAG', '10', '150.00', '65.00', '2022-03-17 03:50:30 PM', '0', 'assets/barcode_images/164769382756-pbarcode.png', 1),
(129, '968946069589', 'MK9 013MERCHSPOJUGWHITEFS', 'MK9 SPORTS JUG WHITE ', 'MK9 SPORTS JUG | WHITE ', 48, 0, 'SPOJUG', 'FS', '250.00', '65.00', '2022-03-17 03:53:54 PM', '0', 'assets/barcode_images/968946069589-pbarcode.png', 1),
(130, '823244491743', 'MK9 013MERCHSPOJUGSILVERFS', 'MK9 SPORTS JUG SILVER ', 'MK9 SPORTS JUG | SILVER ', 44, 0, 'SPOJUG', 'FS', '250.00', '65.00', '2022-03-17 03:54:28 PM', '0', 'assets/barcode_images/823244491743-pbarcode.png', 1),
(131, '383840947492', 'MK9016MERCHLEASHARMYGREENAS', 'MK9 LEASH ARMY GREEN ', 'MK9 LEASH | ARMY GREEN ADULT', 18, 0, 'LEASH', 'AS', '1200.00', '450.00', '2022-03-17 03:56:16 PM', '0', 'assets/barcode_images/383840947492-pbarcode.png', 1),
(132, '217842264471', 'MK9016MERCHLEASHBLACKAS', 'MK9 LEASH BLACK', 'MK9 LEASH | BLACK ADULT', 10, 0, 'LEASH', 'AS', '1200.00', '450.00', '2022-03-17 03:57:09 PM', '0', 'assets/barcode_images/217842264471-pbarcode.png', 1),
(133, '269500872673', 'MK9016MERCHLEASHBEIGEAS', 'MK9 LEASH BEIGE ', 'MK9 LEASH | BEIGE ADULT', 10, 0, 'LEASH', 'AS', '1200.00', '450.00', '2022-03-17 03:58:01 PM', '0', 'assets/barcode_images/269500872673-pbarcode.png', 1),
(134, '740127167506', 'MK9017MERCHCOLLARARMYGREENAS', 'MK9 COLLAR ARMY GREEN', 'MK9 COLLAR | ARMY GREEN ADULT', 23, 0, 'COLLAR', 'AS', '2200.00', '800.00', '2022-03-17 04:05:08 PM', '0', 'assets/barcode_images/740127167506-pbarcode.png', 1),
(135, '709101705714', 'MK9017MERCHCOLLARBLACKAS', 'MK9 COLLAR BLACK ', 'MK9 COLLAR | BLACK ADULT', 36, 0, 'COLLAR', 'AS', '2200.00', '800.00', '2022-03-17 04:05:53 PM', '0', 'assets/barcode_images/709101705714-pbarcode.png', 1),
(136, '918793886681', 'MK9017MERCHCOLLARBEIGEAS', 'MK9 COLLAR BEIGE ', 'MK9 COLLAR | BEIGE ADULT', 15, 0, 'COLLAR', 'AS', '2200.00', '800.00', '2022-03-17 04:06:41 PM', '0', 'assets/barcode_images/918793886681-pbarcode.png', 1),
(137, '130001403748', 'MK9016MERCHLEASHPUPPBLACKPPS', 'MK9 LEASH PUPPY BLACK', 'MK9 LEASH PUPPY | BLACK', 18, 0, 'LEASH', 'PPS', '1000.00', '320.00', '2022-03-18 02:47:42 PM', '0', 'assets/barcode_images/130001403748-pbarcode.png', 1),
(138, '084864035440', 'MK9016MERCHLEASHPUPPREDPPS', 'MK9 LEASH PUPPY RED ', 'MK9 LEASH PUPPY | RED ', 11, 0, 'LEASH', 'PPS', '1000.00', '320.00', '2022-03-18 02:49:29 PM', '0', 'assets/barcode_images/084864035440-pbarcode.png', 1),
(139, '046419359251', 'MK9016MERCHLEASHPUPPGRAYPPS', 'MK9 LEASH PUPPY GRAY ', 'MK9 LEASH PUPPY | GRAY ', 11, 0, 'LEASH', 'PPS', '1000.00', '320.00', '2022-03-18 02:50:40 PM', '0', 'assets/barcode_images/046419359251-pbarcode.png', 1),
(140, '752730284099', 'MK9016MERCHLEASHPUPPYELLOWPPS', 'MK9 LEASH PUPPY | YELLOW', 'MK9 LEASH PUPPY | YELLOW', 13, 0, 'LEASH', 'PPS', '1000.00', '320.00', '2022-03-18 02:51:30 PM', '0', 'assets/barcode_images/752730284099-pbarcode.png', 1),
(141, '744832546774', 'MK9016MERCHLEASHPUPPBROWNPPS', 'MK9 LEASH PUPPY BROWN ', 'MK9 LEASH PUPPY | BROWN ', 7, 0, 'LEASH', 'PPS', '1000.00', '320.00', '2022-03-18 02:52:15 PM', '0', 'assets/barcode_images/744832546774-pbarcode.png', 1),
(142, '485472207141', 'MK9016MERCHLEASHPUPPARMYGREENPPS', 'MK9 LEASH  PUPPY ARMY GREEN ', 'MK9 LEASH  PUPPY | ARMY GREEN ', 13, 0, 'LEASH', 'PPS', '1000.00', '320.00', '2022-03-18 02:53:09 PM', '0', 'assets/barcode_images/485472207141-pbarcode.png', 1),
(143, '465699736305', 'MK9017MERCHCOLLARPUPPBLACKPPS', 'MK9 COLLAR PUPPY BLACK ', 'MK9 COLLAR PUPPY | BLACK ', 18, 0, 'COLLAR', 'PPS', '1100.00', '500.00', '2022-03-18 02:55:51 PM', '0', 'assets/barcode_images/465699736305-pbarcode.png', 1),
(144, '684322337198', 'MK9017MERCHCOLLARPUPPREDPPS', 'MK9 COLLAR PUPPY RED ', 'MK9 COLLAR PUPPY | RED ', 12, 0, 'COLLAR', 'PPS', '1100.00', '500', '2022-03-18 03:00:12 PM', '0', 'assets/barcode_images/684322337198-pbarcode.png', 1),
(145, '606477495407', 'MK9017MERCHCOLLARPUPPGRAYPPS', 'MK9 COLLAR PUPPY GRAY', 'MK9 COLLAR PUPPY | GRAY', 9, 0, 'COLLAR', 'PPS', '1100.00', '500.00', '2022-03-18 03:01:07 PM', '0', 'assets/barcode_images/606477495407-pbarcode.png', 1),
(146, '072989953372', 'MK9017MERCHCOLLARPUPPYELLOWAS', 'MK9 COLLAR PUPPY YELLOW ', 'MK9 COLLAR PUPPY | YELLOW ', 13, 0, 'COLLAR', 'AS', '1100.00', '500.00', '2022-03-18 03:02:18 PM', '0', 'assets/barcode_images/072989953372-pbarcode.png', 1),
(147, '942301192534', 'MK9017MERCHCOLLARPUPPBROWNPPS', 'MK9 COLLAR PUPPY BROWN ', 'MK9 COLLAR PUPPY | BROWN ', 8, 0, 'COLLAR', 'PPS', '1100.00', '500.00', '2022-03-18 03:03:12 PM', '0', 'assets/barcode_images/942301192534-pbarcode.png', 1),
(148, '892182929487', 'MK9017MERCHCOLLARPUPPARMYGREENPPS', ' MK9 COLLAR PUPPY ARMY GREEN', ' MK9 COLLAR PUPPY | ARMY GREEN', 13, 0, 'COLLAR', 'PPS', '1100.00', '500.00', '2022-03-18 03:04:49 PM', '0', 'assets/barcode_images/892182929487-pbarcode.png', 1),
(149, '116890230329', 'MS022MERCHTSMSBRXS', ' META SHIRT XS', 'META SHIRT ROUND | XS', 7, 0, 'TS', 'XS', '500', '157', '2022-03-25 01:45:56 PM', '0', 'assets/barcode_images/116890230329-pbarcode.png', 1),
(150, '754664155939', 'MS022MERCHTSMSBRS', 'META SHIRT SMALL', 'META SHIRT ROUND | S', 12, 0, 'TS', 'S', '500', '157', '2022-03-25 01:46:57 PM', '0', 'assets/barcode_images/754664155939-pbarcode.png', 1),
(151, '036184520117', 'MS022MERCHTSMSBRM', 'META SHIRT MEDIUM', 'META SHIRT ROUND | M', 22, 2, 'TS', 'M', '500', '157', '2022-03-25 01:47:43 PM', '0', 'assets/barcode_images/036184520117-pbarcode.png', 1),
(152, '960733129264', 'MS022MERCHTSMSBRL', 'META SHIRT BLACK ROUND LARGE', 'META SHIRT BLACK ROUND | LARGE', 21, 0, 'TS', 'L', '500.00', '157.00', '2022-04-13 01:47:57 PM', '0', 'assets/barcode_images/960733129264-pbarcode.png', 1),
(153, '042699371240', 'MS022MERCHTSMSBRXL', 'META SHIRT BLACK ROUND EXTRA LARGE', 'META SHIRT BLACK ROUND | EXTRA LARGE', 10, 0, 'TS', 'XL', '500.00', '157.00', '2022-04-13 01:51:17 PM', '0', 'assets/barcode_images/042699371240-pbarcode.png', 1),
(154, '465903384435', 'MS022MERCHTSMSBR2XL', 'META SHIRT BLACK ROUND EXTRA EXTRA LARGE', 'META SHIRT BLACK ROUND | EXTRA EXTRA LARGE', 5, 0, 'TS', '2XL', '500.00', '157.00', '2022-04-13 01:52:59 PM', '0', 'assets/barcode_images/465903384435-pbarcode.png', 1),
(155, '661660666766', 'MK9011MERCHSANDOPAWSITIVEXXL', 'PAWSITIVE LOGO EXTRA EXTRA LARGE', 'PAWSITIVE LOGO | EXTRA EXTRA LARGE', 2, 0, 'SANDO', 'XXL', '350.00', '123.81', '2022-04-13 02:27:52 PM', '0', 'assets/barcode_images/661660666766-pbarcode.png', 1),
(156, '211290277824', 'MK9023MERCHTSICGDTDXS', 'ICGD TOPDOGS EXTRA SMALL', 'ICGD TOPDOGS | EXTRA SMALL', 10, 0, 'TS', 'XS', '350.00', '157.40', '2022-04-13 03:10:54 PM', '0', 'assets/barcode_images/211290277824-pbarcode.png', 1),
(157, '009841685129', 'IFGD024MERCHFMIFGDWHITEFREE SIZE', 'IFGD FACEMASK WHITE FREE SIZE ', 'IFGD FACEMASK | WHITE', 40, 0, 'FM', 'FREE SIZE', '150.00', '37.50', '2022-04-13 03:28:49 PM', '0', 'assets/barcode_images/009841685129-pbarcode.png', 1),
(158, '569999405760', 'IFGD024MERCHFMIFGDBLACKFREE SIZE', 'IFGD FACEMASK BLACK FREE SIZE ', 'IFGD FACEMASK | BLACK', 30, 0, 'FM', 'FREE SIZE', '150.00', '37.50', '2022-04-13 03:29:39 PM', '0', 'assets/barcode_images/569999405760-pbarcode.png', 1),
(159, '048382164970', 'MK9023MERCHTSICGDTDS', 'ICGD TOP DOGS SMALL', 'ICGD TOP DOGS | SMALL', 13, 0, 'TS', 'S', '350.00', '157.40', '2022-04-13 03:43:23 PM', '0', 'assets/barcode_images/048382164970-pbarcode.png', 1),
(160, '948715985404', 'MK9023MERCHTSICGDTDM', 'ICGD TOP DOGS MEDIUM', 'ICGD TOP DOGS | MEDIUM', 9, 0, 'TS', 'M', '350.00', '157.40', '2022-04-13 03:44:07 PM', '0', 'assets/barcode_images/948715985404-pbarcode.png', 1),
(161, '405236586071', 'MK9023MERCHTSICGDTDL', 'ICGD TOP DOGS LARGE', 'ICGD TOP DOGS | LARGE', 2, 0, 'TS', 'L', '350.00', '157.40', '2022-04-13 03:44:56 PM', '0', 'assets/barcode_images/405236586071-pbarcode.png', 1),
(162, '214511744193', 'MK9023MERCHTSICGDTDXL', 'ICGD TOP DOGS EXTRA LARGE', 'ICGD TOP DOGS | EXTRA LARGE', 11, 0, 'TS', 'XL', '350.00', '157.40', '2022-04-13 03:45:41 PM', '0', 'assets/barcode_images/214511744193-pbarcode.png', 1),
(163, '769702833908', 'MK9023MERCHTSICGDTDXXL', 'ICGD TOP DOGS EXTRA EXTRA LARGE', 'ICGD TOP DOGS | 2XLARGE', 7, 0, 'TS', 'XXL', '350.00', '157.40', '2022-04-13 03:54:16 PM', '0', 'assets/barcode_images/769702833908-pbarcode.png', 1);

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
  `Status` int(11) NOT NULL COMMENT '0 = for approval\r\n1 = approved\r\n2 = rejected',
  `Date_Approval` varchar(255) DEFAULT NULL,
  `UserID` varchar(255) DEFAULT NULL,
  `PriceTotal` varchar(255) DEFAULT NULL,
  `Freebie` int(11) DEFAULT 0 COMMENT '0=no;1=yes;',
  `UnitDiscount` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_transactions`
--

INSERT INTO `products_transactions` (`ID`, `Code`, `TransactionID`, `OrderNo`, `stockID`, `Type`, `Amount`, `PriceUnit`, `InStock`, `Date`, `DateAdded`, `Status`, `Date_Approval`, `UserID`, `PriceTotal`, `Freebie`, `UnitDiscount`) VALUES
(1, 'SHS004HSPRMPINK150G', 'SHS004HSPRMPINK150G-62563B9865771', NULL, 1, 0, 2488, '31.00', 0, '2022/04/13 10:55:07', '2022-04-13 10:55:20 AM', 1, NULL, '61a5caf447cae', '77128', 0, 0),
(2, 'SHS004HSPRMPINK150G', 'SHS004HSPRMPINK150G-62567396CAED2', NULL, 2, 0, 2351, '31.00', 0, '2022/04/13 10:57:41', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '72881', 0, 0),
(3, 'SHS004HSPRMBLUE150G', 'SHS004HSPRMBLUE150G-62567396D1090', NULL, 3, 0, 2488, '31.00', 0, '2022/04/13 10:58:07', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '77128', 0, 0),
(4, 'SDS002DSPRMYP150 G', 'SDS002DSPRMYP150 G-62567396D5966', NULL, 4, 0, 14653, '31.00', 0, '2022/04/13 11:06:13', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '454243', 0, 0),
(5, 'SDS002DSPRMORIG150 G', 'SDS002DSPRMORIG150 G-62567396DB0C2', NULL, 5, 0, 5192, '31.00', 0, '2022/04/13 11:06:51', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '160952', 0, 0),
(6, 'SDS002DSPRMMC150 G', 'SDS002DSPRMMC150 G-62567396DC249', NULL, 6, 0, 15679, '31.00', 0, '2022/04/13 11:08:26', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '486049', 0, 0),
(7, 'SDS002DSPRMAC150 G', 'SDS002DSPRMAC150 G-62567396DD5F4', NULL, 7, 0, 6152, '31.00', 0, '2022/04/13 11:09:37', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '190712', 0, 0),
(8, 'SDN001DFPRMORIG5KG', 'SDN001DFPRMORIG5KG-62567396DE907', NULL, 8, 0, 4873, '452.95', 0, '2022/04/13 11:10:13', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '2207225.35', 0, 0),
(9, 'SDN001DFPRMORIG500G', 'SDN001DFPRMORIG500G-62567396DFAC4', NULL, 9, 0, 431, '79.80', 0, '2022/04/13 11:10:44', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '34393.8', 0, 0),
(10, 'SDN001DFPRMORIG15KG', 'SDN001DFPRMORIG15KG-62567396E0AD1', NULL, 10, 0, 3323, '1347.65', 0, '2022/04/13 11:11:39', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '4478240.95', 0, 0),
(11, 'SCB003DSPRMSCB150G', 'SCB003DSPRMSCB150G-62567396E1A96', NULL, 11, 0, 18813, '28.50', 0, '2022/04/13 11:12:32', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '536170.5', 0, 0),
(12, 'POT004DPPRMPOT150 G ', 'POT004DPPRMPOT150 G -62567396E29F2', NULL, 12, 0, 1083, '70.00', 0, '2022/04/13 11:12:54', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '75810', 0, 0),
(13, 'MS022MERCHTSMSBRXS', 'MS022MERCHTSMSBRXS-62567396E38B8', NULL, 13, 0, 7, '157', 0, '2022/04/13 11:13:32', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '1099', 0, 0),
(14, 'MS022MERCHTSMSBRS', 'MS022MERCHTSMSBRS-62567396E48A2', NULL, 14, 0, 12, '157', 0, '2022/04/13 11:13:53', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '1884', 0, 0),
(15, 'MS022MERCHTSMSBRM', 'MS022MERCHTSMSBRM-62567396EA547', NULL, 15, 0, 22, '157', 0, '2022/04/13 11:33:16', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '3454', 0, 0),
(16, 'MK9UMB014MERCHUMBUMBWHITEFS', 'MK9UMB014MERCHUMBUMBWHITEFS-62567396EB4B9', NULL, 16, 0, 37, '100.00', 0, '2022/04/13 11:35:07', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '3700', 0, 0),
(17, 'MK9MC015MERCHMCMCBWFS', 'MK9MC015MERCHMCMCBWFS-62567396EC455', NULL, 17, 0, 82, '85.00', 0, '2022/04/13 11:35:37', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '6970', 0, 0),
(18, 'MK9020MERCHMGMAGICMUGFS', 'MK9020MERCHMGMAGICMUGFS-62567396ED391', NULL, 18, 0, 48, '99.00', 0, '2022/04/13 11:46:30', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '4752', 0, 0),
(19, 'MK9020MERCHMGMANALOK9LOGOMUGFS', 'MK9020MERCHMGMANALOK9LOGOMUGFS-62567396EE24B', NULL, 19, 0, 92, '74.00', 0, '2022/04/13 11:47:01', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '6808', 0, 0),
(20, 'MK9020MERCHMGSUPPERDOGGERSMUGFS', 'MK9020MERCHMGSUPPERDOGGERSMUGFS-62567396EF21D', NULL, 20, 0, 36, '100.00', 0, '2022/04/13 11:47:23', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '3600', 0, 0),
(21, 'MK9017MERCHCOLLARPUPPYELLOWAS', 'MK9017MERCHCOLLARPUPPYELLOWAS-62567396F0136', NULL, 21, 0, 13, '500.00', 0, '2022/04/13 12:56:45', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '6500', 0, 0),
(22, 'MK9017MERCHCOLLARPUPPREDPPS', 'MK9017MERCHCOLLARPUPPREDPPS-62567396F10C7', NULL, 22, 0, 12, '500', 0, '2022/04/13 12:57:23', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '6000', 0, 0),
(23, 'MK9017MERCHCOLLARPUPPGRAYPPS', 'MK9017MERCHCOLLARPUPPGRAYPPS-62567396F1FCF', NULL, 23, 0, 9, '500.00', 0, '2022/04/13 12:57:53', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '4500', 0, 0),
(24, 'MK9017MERCHCOLLARPUPPBROWNPPS', 'MK9017MERCHCOLLARPUPPBROWNPPS-62567396F2FC6', NULL, 24, 0, 8, '500.00', 0, '2022/04/13 12:58:10', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '4000', 0, 0),
(25, 'MK9017MERCHCOLLARPUPPBLACKPPS', 'MK9017MERCHCOLLARPUPPBLACKPPS-62567396F4094', NULL, 25, 0, 18, '500.00', 0, '2022/04/13 12:58:31', '2022-04-13 02:54:14 PM', 1, NULL, '61a5caf447cae', '9000', 0, 0),
(26, 'MK9017MERCHCOLLARPUPPARMYGREENPPS', 'MK9017MERCHCOLLARPUPPARMYGREENPPS-6256739700E13', NULL, 26, 0, 13, '500.00', 0, '2022/04/13 12:58:51', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '6500', 0, 0),
(27, 'MK9017MERCHCOLLARBLACKAS', 'MK9017MERCHCOLLARBLACKAS-6256739701DD8', NULL, 27, 0, 36, '800.00', 0, '2022/04/13 12:59:36', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '28800', 0, 0),
(28, 'MK9017MERCHCOLLARBEIGEAS', 'MK9017MERCHCOLLARBEIGEAS-6256739702E5D', NULL, 28, 0, 15, '800.00', 0, '2022/04/13 13:00:04', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '12000', 0, 0),
(29, 'MK9017MERCHCOLLARARMYGREENAS', 'MK9017MERCHCOLLARARMYGREENAS-6256739703E42', NULL, 29, 0, 23, '800.00', 0, '2022/04/13 13:00:27', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '18400', 0, 0),
(30, 'MK9016MERCHLEASHPUPPYELLOWPPS', 'MK9016MERCHLEASHPUPPYELLOWPPS-6256739704DF8', NULL, 30, 0, 13, '320.00', 0, '2022/04/13 13:00:56', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '4160', 0, 0),
(31, 'MK9016MERCHLEASHPUPPREDPPS', 'MK9016MERCHLEASHPUPPREDPPS-6256739705F27', NULL, 31, 0, 11, '320.00', 0, '2022/04/13 13:01:23', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '3520', 0, 0),
(32, 'MK9016MERCHLEASHPUPPGRAYPPS', 'MK9016MERCHLEASHPUPPGRAYPPS-6256739706E01', NULL, 32, 0, 11, '320.00', 0, '2022/04/13 13:01:42', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '3520', 0, 0),
(33, 'MK9016MERCHLEASHPUPPBROWNPPS', 'MK9016MERCHLEASHPUPPBROWNPPS-625673970801D', NULL, 33, 0, 7, '320.00', 0, '2022/04/13 13:02:09', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '2240', 0, 0),
(34, 'MK9016MERCHLEASHPUPPARMYGREENPPS', 'MK9016MERCHLEASHPUPPARMYGREENPPS-6256739709050', NULL, 34, 0, 13, '320.00', 0, '2022/04/13 13:07:40', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '4160', 0, 0),
(35, 'MK9016MERCHLEASHBEIGEAS', 'MK9016MERCHLEASHBEIGEAS-625673970A136', NULL, 35, 0, 10, '450.00', 0, '2022/04/13 13:22:07', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '4500', 0, 0),
(36, 'MK9016MERCHLEASHARMYGREENAS', 'MK9016MERCHLEASHARMYGREENAS-625673970B10F', NULL, 36, 0, 18, '450.00', 0, '2022/04/13 13:22:33', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '8100', 0, 0),
(37, 'MK9016MERCHLEASHPUPPBLACKPPS', 'MK9016MERCHLEASHPUPPBLACKPPS-625673970C0A4', NULL, 37, 0, 18, '320.00', 0, '2022/04/13 13:33:15', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '5760', 0, 0),
(38, 'MK9016MERCHLEASHBLACKAS', 'MK9016MERCHLEASHBLACKAS-625673970D002', NULL, 38, 0, 10, '450.00', 0, '2022/04/13 13:34:56', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '4500', 0, 0),
(39, 'MK9012MERCHFMMK9REDFS', 'MK9012MERCHFMMK9REDFS-625673970DF3C', NULL, 39, 0, 73, '37.50', 0, '2022/04/13 13:36:29', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '2737.5', 0, 0),
(40, 'MK9012MERCHFMMK9GRAYFS', 'MK9012MERCHFMMK9GRAYFS-625673970EF45', NULL, 40, 0, 94, '37.50', 0, '2022/04/13 13:37:09', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '3525', 0, 0),
(41, 'MK9012MERCHFMMK9GOLDREDFS', 'MK9012MERCHFMMK9GOLDREDFS-625673970FF48', NULL, 41, 0, 89, '37.50', 0, '2022/04/13 13:37:40', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '3337.5', 0, 0),
(42, 'MK9012MERCHFMMK9BLACKFS', 'MK9012MERCHFMMK9BLACKFS-6256739710E1F', NULL, 42, 0, 63, '37.50', 0, '2022/04/13 13:38:03', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '2362.5', 0, 0),
(43, 'MK9012MERCHFMICGDWHITEFS', 'MK9012MERCHFMICGDWHITEFS-6256739711E3A', NULL, 43, 0, 130, '37.50', 0, '2022/04/13 13:38:35', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '4875', 0, 0),
(44, 'MK9012MERCHFMICGDBLACKFS', 'MK9012MERCHFMICGDBLACKFS-6256739712E26', NULL, 44, 0, 100, '37.50', 0, '2022/04/13 13:39:00', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '3750', 0, 0),
(45, 'MK9 013MERCHSPOJUGWHITEFS', 'MK9 013MERCHSPOJUGWHITEFS-6256739713D52', NULL, 45, 0, 48, '65.00', 0, '2022/04/13 13:40:27', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '3120', 0, 0),
(46, 'MK9 013MERCHSPOJUGSILVERFS', 'MK9 013MERCHSPOJUGSILVERFS-6256739714D02', NULL, 46, 0, 44, '65.00', 0, '2022/04/13 13:41:09', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '2860', 0, 0),
(47, 'MK90021MERCHCANBAGCANBAG10', 'MK90021MERCHCANBAGCANBAG10-6256739715BED', NULL, 47, 0, 118, '65.00', 0, '2022/04/13 13:41:48', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '7670', 0, 0),
(48, 'MS022MERCHTSMSBRL', 'MS022MERCHTSMSBRL-6256739716C41', NULL, 48, 0, 21, '157.00', 0, '2022/04/13 13:54:18', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '3297', 0, 0),
(49, 'MS022MERCHTSMSBRXL', 'MS022MERCHTSMSBRXL-62567397182CA', NULL, 49, 0, 10, '157.00', 0, '2022/04/13 13:54:47', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '1570', 0, 0),
(50, 'MS022MERCHTSMSBR2XL', 'MS022MERCHTSMSBR2XL-62567397198CD', NULL, 50, 0, 5, '157.00', 0, '2022/04/13 13:55:13', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '785', 0, 0),
(51, 'MK9008MERCHTSSDXS', 'MK9008MERCHTSSDXS-625673971B2E8', NULL, 51, 0, 5, '157.40', 0, '2022/04/13 14:10:48', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '787', 0, 0),
(52, 'MK9008MERCHTSSDS', 'MK9008MERCHTSSDS-625673971C9FF', NULL, 52, 0, 4, '157.40', 0, '2022/04/13 14:11:14', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '629.6', 0, 0),
(53, 'MK9009MERCHTSWADS', 'MK9009MERCHTSWADS-625673971E0CF', NULL, 53, 0, 1, '350.00', 0, '2022/04/13 14:20:00', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '350', 0, 0),
(54, 'MK9009MERCHTSWADM', 'MK9009MERCHTSWADM-625673971FC13', NULL, 54, 0, 6, '350.00', 0, '2022/04/13 14:20:26', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '2100', 0, 0),
(55, 'MK9009MERCHTSWADL', 'MK9009MERCHTSWADL-6256739720FE5', NULL, 55, 0, 3, '350.00', 0, '2022/04/13 14:20:45', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '1050', 0, 0),
(56, 'MK9009MERCHTSWADXL', 'MK9009MERCHTSWADXL-62567397223C4', NULL, 56, 0, 2, '350.00', 0, '2022/04/13 14:21:02', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '700', 0, 0),
(57, 'MK9009MERCHTSWADXXL', 'MK9009MERCHTSWADXXL-6256739723307', NULL, 57, 0, 2, '350.00', 0, '2022/04/13 14:21:22', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '700', 0, 0),
(58, 'MK9010MERCHSANDOYPSS', 'MK9010MERCHSANDOYPSS-6256739724499', NULL, 58, 0, 2, '123.81', 0, '2022/04/13 14:22:20', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '247.62', 0, 0),
(59, 'MK9010MERCHSANDOYPSM', 'MK9010MERCHSANDOYPSM-62567397255AC', NULL, 59, 0, 1, '123.81', 0, '2022/04/13 14:22:39', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '123.81', 0, 0),
(60, 'MK9010MERCHSANDOYPSL', 'MK9010MERCHSANDOYPSL-62567397266B5', NULL, 60, 0, 4, '123.81', 0, '2022/04/13 14:23:02', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '495.24', 0, 0),
(61, 'MK9010MERCHSANDOYPSXL', 'MK9010MERCHSANDOYPSXL-62567397277F0', NULL, 61, 0, 5, '123.81', 0, '2022/04/13 14:23:31', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '619.05', 0, 0),
(62, 'MK9010MERCHSANDOYPSXXL', 'MK9010MERCHSANDOYPSXXL-62567397289C5', NULL, 62, 0, 4, '123.81', 0, '2022/04/13 14:23:50', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '495.24', 0, 0),
(63, 'MK9011MERCHSANDOPAWSITIVES', 'MK9011MERCHSANDOPAWSITIVES-6256739729BC7', NULL, 63, 0, 2, '123.81', 0, '2022/04/13 14:24:23', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '247.62', 0, 0),
(64, 'MK9011MERCHSANDOPAWSITIVEM', 'MK9011MERCHSANDOPAWSITIVEM-625673972AB0C', NULL, 64, 0, 5, '123.81', 0, '2022/04/13 14:24:41', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '619.05', 0, 0),
(65, 'MK9011MERCHSANDOPAWSITIVEL', 'MK9011MERCHSANDOPAWSITIVEL-625673972BC10', NULL, 65, 0, 1, '123.81', 0, '2022/04/13 14:24:58', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '123.81', 0, 0),
(66, 'MK9011MERCHSANDOPAWSITIVEXL', 'MK9011MERCHSANDOPAWSITIVEXL-625673972CD50', NULL, 66, 0, 4, '123.81', 0, '2022/04/13 14:25:16', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '495.24', 0, 0),
(67, 'MK9011MERCHSANDOPAWSITIVEXXL', 'MK9011MERCHSANDOPAWSITIVEXXL-625673972DD7C', NULL, 67, 0, 2, '123.81', 0, '2022/04/13 14:28:36', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '247.62', 0, 0),
(68, 'MK9005MERCHTSVNECKS', 'MK9005MERCHTSVNECKS-625673972ED53', NULL, 68, 0, 38, '157.40', 0, '2022/04/13 14:29:20', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '5981.2', 0, 0),
(69, 'MK9005MERCHTSVNECKM', 'MK9005MERCHTSVNECKM-625673972FF1D', NULL, 69, 0, 36, '157.40', 0, '2022/04/13 14:29:42', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '5666.4', 0, 0),
(70, 'MK9005MERCHTSVNECKL', 'MK9005MERCHTSVNECKL-62567397310D9', NULL, 70, 0, 29, '157.40', 0, '2022/04/13 14:30:04', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '4564.6', 0, 0),
(71, 'MK9005MERCHTSVNECKXL', 'MK9005MERCHTSVNECKXL-6256739732197', NULL, 71, 0, 38, '157.40', 0, '2022/04/13 14:30:22', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '5981.2', 0, 0),
(72, 'MK9006MERCHTSROUNDXS', 'MK9006MERCHTSROUNDXS-625673973320F', NULL, 72, 0, 28, '157.40', 0, '2022/04/13 14:31:45', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '4407.2', 0, 0),
(73, 'MK9006MERCHTSROUNDS', 'MK9006MERCHTSROUNDS-62567397341B2', NULL, 73, 0, 6, '157.40', 0, '2022/04/13 14:32:04', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '944.4', 0, 0),
(74, 'MK9006MERCHTSROUNDM', 'MK9006MERCHTSROUNDM-6256739735494', NULL, 74, 0, 33, '157.40', 0, '2022/04/13 14:32:26', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '5194.2', 0, 0),
(75, 'MK9006MERCHTSROUNDL', 'MK9006MERCHTSROUNDL-6256739736615', NULL, 75, 0, 29, '157.40', 0, '2022/04/13 14:41:31', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '4564.6', 0, 0),
(76, 'MK9006MERCHTSROUNDXL', 'MK9006MERCHTSROUNDXL-62567397377C4', NULL, 76, 0, 24, '157.40', 0, '2022/04/13 14:41:53', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '3777.6', 0, 0),
(77, 'MK9006MERCHTSROUND2XL', 'MK9006MERCHTSROUND2XL-6256739738A69', NULL, 77, 0, 2, '157.40', 0, '2022/04/13 14:42:26', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '314.8', 0, 0),
(78, 'MK9007MERCHTSICGDXS', 'MK9007MERCHTSICGDXS-6256739739E29', NULL, 78, 0, 19, '157.40', 0, '2022/04/13 14:43:12', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '2990.6', 0, 0),
(79, 'MK9007MERCHTSICGDS', 'MK9007MERCHTSICGDS-625673973B0CB', NULL, 79, 0, 19, '157.40', 0, '2022/04/13 14:44:13', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '2990.6', 0, 0),
(80, 'MK9007MERCHTSICGDM', 'MK9007MERCHTSICGDM-625673973C120', NULL, 80, 0, 10, '157.40', 0, '2022/04/13 14:44:56', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '1574', 0, 0),
(81, 'MK9007MERCHTSICGDL', 'MK9007MERCHTSICGDL-625673973D348', NULL, 81, 0, 5, '157.40', 0, '2022/04/13 14:45:16', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '787', 0, 0),
(82, 'MK9007MERCHTSICGDXL', 'MK9007MERCHTSICGDXL-625673973E344', NULL, 82, 0, 7, '157.40', 0, '2022/04/13 14:45:31', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '1101.8', 0, 0),
(83, 'MK9007MERCHTSICGD2XL', 'MK9007MERCHTSICGD2XL-625673973F2AE', NULL, 83, 0, 38, '157.40', 0, '2022/04/13 14:45:52', '2022-04-13 02:54:15 PM', 1, NULL, '61a5caf447cae', '5981.2', 0, 0),
(84, 'MK9008MERCHTSSDXXL', 'MK9008MERCHTSSDXXL-62567419986D1', NULL, 84, 0, 15, '157.40', 0, '2022/04/13 14:56:19', '2022-04-13 02:56:25 PM', 1, NULL, '61a5caf447cae', '2361', 0, 0),
(85, 'MK9015MERCHMCBLACK&WHITEFS', 'MK9015MERCHMCBLACK&WHITEFS-625674BA17968', NULL, 85, 0, 82, '85.00', 0, '2022/04/13 14:58:59', '2022-04-13 02:59:06 PM', 1, NULL, '61a5caf447cae', '6970', 0, 0),
(86, 'MK9014MERCHUMBWHITEFS', 'MK9014MERCHUMBWHITEFS-62567519F0EAF', NULL, 86, 0, 37, '100.00', 0, '2022/04/13 15:00:35', '2022-04-13 03:00:41 PM', 1, NULL, '61a5caf447cae', '3700', 0, 0),
(87, 'IFGD024MERCHFMIFGDWHITEFREE SIZE', 'IFGD024MERCHFMIFGDWHITEFREE SIZE-62567C27BB255', NULL, 87, 0, 40, '37.50', 0, '2022/04/13 15:30:10', '2022-04-13 03:30:47 PM', 1, NULL, '61a5caf447cae', '1500', 0, 0),
(88, 'IFGD024MERCHFMIFGDBLACKFREE SIZE', 'IFGD024MERCHFMIFGDBLACKFREE SIZE-62567C27BC7B9', NULL, 88, 0, 30, '37.50', 0, '2022/04/13 15:30:32', '2022-04-13 03:30:47 PM', 1, NULL, '61a5caf447cae', '1125', 0, 0),
(89, 'MK9023MERCHTSICGDTDXS', 'MK9023MERCHTSICGDTDXS-625685560E540', NULL, 89, 0, 10, '157.40', 0, '2022/04/13 15:55:19', '2022-04-13 04:09:58 PM', 1, NULL, '61a5caf447cae', '1574', 0, 0),
(90, 'MK9023MERCHTSICGDTDS', 'MK9023MERCHTSICGDTDS-625685561C6B8', NULL, 90, 0, 13, '157.40', 0, '2022/04/13 16:08:28', '2022-04-13 04:09:58 PM', 1, NULL, '61a5caf447cae', '2046.2', 0, 0),
(91, 'MK9023MERCHTSICGDTDM', 'MK9023MERCHTSICGDTDM-625685561D992', NULL, 91, 0, 9, '157.40', 0, '2022/04/13 16:08:46', '2022-04-13 04:09:58 PM', 1, NULL, '61a5caf447cae', '1416.6', 0, 0),
(92, 'MK9023MERCHTSICGDTDL', 'MK9023MERCHTSICGDTDL-625685561EE27', NULL, 92, 0, 2, '157.40', 0, '2022/04/13 16:09:09', '2022-04-13 04:09:58 PM', 1, NULL, '61a5caf447cae', '314.8', 0, 0),
(93, 'MK9023MERCHTSICGDTDXL', 'MK9023MERCHTSICGDTDXL-625685562020C', NULL, 93, 0, 11, '157.40', 0, '2022/04/13 16:09:28', '2022-04-13 04:09:58 PM', 1, NULL, '61a5caf447cae', '1731.4', 0, 0),
(94, 'MK9023MERCHTSICGDTDXXL', 'MK9023MERCHTSICGDTDXXL-6256855621476', NULL, 94, 0, 7, '157.40', 0, '2022/04/13 16:09:44', '2022-04-13 04:09:58 PM', 1, NULL, '61a5caf447cae', '1101.8', 0, 0),
(99, 'SCB003DSPRMSCB150G', 'SCB003DSPRMSCB150G-625D0778847D5', NULL, 11, 1, 10, '150.00', 0, '2022/04/18 14:38:48', '2022-04-18 14:38:48', 2, NULL, '62424e1258eb0', '1500', 0, 0),
(100, 'SDN001DFPRMORIG5KG', 'SDN001DFPRMORIG5KG-625D079B5D2EE', NULL, 8, 1, 50, '1100.00', 0, '2022/04/18 14:39:23', '2022-04-18 14:39:23', 2, NULL, '62424e1258eb0', '55000', 0, 0),
(101, 'SDS002DSPRMORIG150 G', 'SDS002DSPRMORIG150 G-625D07B586509', NULL, 5, 1, 60, '150.00', 0, '2022/04/18 14:39:49', '2022-04-18 14:39:49', 2, NULL, '62424e1258eb0', '9000', 0, 0),
(102, 'SCB003DSPRMSCB150G', 'SCB003DSPRMSCB150G-625D07C72A670', NULL, 11, 1, 5, '150.00', 0, '2022/04/18 14:40:07', '2022-04-18 14:40:07', 2, NULL, '62424e1258eb0', '750', 0, 0),
(103, 'SCB003DSPRMSCB150G', 'SCB003DSPRMSCB150G-625F819EE8296', NULL, 11, 1, 80, '150.00', 0, '2022/04/20 11:44:30', '2022-04-20 11:44:30 AM', 1, NULL, '624252639e2e5', '12000', 0, 0),
(130, 'SHS004HSPRMPINK150G', 'SHS004HSPRMPINK150G-6273ECD3BC32A', NULL, 2, 1, 1, '150', 0, '2022/05/05 23:27:15', '2022-05-05 23:27:15', 2, NULL, '61a5caf447cae', '150', 0, 0),
(136, 'SDS002DSPRMAC150 G', 'SDS002DSPRMAC150 G-627C48FB8F62F', 'SO6273EA988E0D1', 7, 1, 60, '150.00', 0, '2022/05/12 07:38:35', '2022-05-12 07:38:35', 1, '2022-05-12 07:38:35', '61a5caf447cae', '9000', 0, 10),
(143, 'SDS002DSPRMYP150 G', 'SDS002DSPRMYP150 G-628395ECB87D6', '1', 4, 1, 4, '150.00', 0, '2022/05/17 20:32:44', '2022-05-17 20:32:44', 0, NULL, '61a5caf447cae', '600', 0, 0),
(144, 'SDN001DFPRMORIG15KG', 'SDN001DFPRMORIG15KG-628395ECDF0FD', '1', 10, 1, 3, '3245.00', 0, '2022/05/17 20:32:44', '2022-05-17 20:32:44', 0, NULL, '61a5caf447cae', '9735', 0, 0),
(145, 'SDS002DSPRMMC150 G', 'SDS002DSPRMMC150 G-628396153DEEB', 'MK9-22-0000002', 6, 1, 4, '150.00', 0, '2022/05/17 20:33:25', '2022-05-17 20:33:25', 0, NULL, '61a5caf447cae', '600', 0, 0),
(146, 'SCB003DSPRMSCB150G', 'SCB003DSPRMSCB150G-62839615526CE', 'MK9-22-0000002', 11, 1, 7, '150.00', 0, '2022/05/17 20:33:25', '2022-05-17 20:33:25', 0, NULL, '61a5caf447cae', '1050', 0, 0),
(147, 'SDS002DSPRMYP150 G', 'SDS002DSPRMYP150 G-62839643E1360', 'MK9-22-0000004', 4, 1, 4, '150.00', 0, '2022/05/17 20:34:11', '2022-05-17 20:34:11', 0, NULL, '61a5caf447cae', '600', 0, 0),
(148, 'SCB003DSPRMSCB150G', 'SCB003DSPRMSCB150G-62839644046A9', 'MK9-22-0000004', 11, 1, 6, '150.00', 0, '2022/05/17 20:34:12', '2022-05-17 20:34:12', 0, NULL, '61a5caf447cae', '900', 0, 0),
(149, 'SHS004HSPRMBLUE150G', 'SHS004HSPRMBLUE150G-6283A28348C37', 'PO6283A2831A1A7', 95, 0, 4, '31.00', 0, '2022-05-17', '2022-05-17 21:26:27', 0, NULL, '61a5caf447cae', '124', 0, 0),
(150, 'SDN001DFPRMORIG500G', 'SDN001DFPRMORIG500G-6283A283718C9', 'PO6283A2831A1A7', 96, 0, 3, '79.80', 0, '2022-05-17', '2022-05-17 21:26:27', 0, NULL, '61a5caf447cae', '239.4', 0, 0),
(151, 'SDS002DSPRMMC150 G', 'SDS002DSPRMMC150 G-6283A283A6752', 'PO6283A2831A1A7', 97, 0, 3, '31.00', 0, '2022-05-17', '2022-05-17 21:26:27', 0, NULL, '61a5caf447cae', '93', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `item_code` varchar(255) DEFAULT NULL,
  `first_brand` varchar(255) DEFAULT NULL,
  `Second_brand` varchar(255) DEFAULT NULL,
  `prd_char` varchar(255) DEFAULT NULL,
  `char_type` varchar(255) DEFAULT NULL,
  `prd_line` varchar(255) DEFAULT NULL,
  `prd_type` varchar(255) DEFAULT NULL,
  `prd_variant` varchar(255) DEFAULT NULL,
  `prd_size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `item_code`, `first_brand`, `Second_brand`, `prd_char`, `char_type`, `prd_line`, `prd_type`, `prd_variant`, `prd_size`) VALUES
(34, 'SDN001DFPRMORIG500G', 'SDN', 'SUPER DOG NUTRITION', '001', 'DOG FOOD ', 'DF', 'PRM', 'ORIG', '500G'),
(35, 'SDN001DFPRMORIG5KG', 'SDN', 'SUPER DOG NUTRITION', '001', 'DOG FOOD ', 'DF', 'PRM', 'ORIG', '5KG'),
(36, 'SDN001DFPRMORIG15KG', 'SDN', 'SUPER DOG NUTRITION', '001', 'DOG FOOD ', 'DF', 'PRM', 'ORIG', '15KG'),
(38, 'SDS002DSPRMYP150 G', 'SDS', 'SUPER DOG SOAP', '002', 'DOG SOAP', 'DS', 'PRM', 'YP', '150 G'),
(39, 'SDS002DSPRMMC150 G', 'SDS', 'SUPER DOG SOAP', '002', 'DOG SOAP', 'DS', 'PRM', 'MC', '150 G'),
(40, 'SDS002DSPRMORIG150 G', 'SDS', 'SUPER DOG SOAP', '002', 'DOG SOAP', 'DS', 'PRM', 'ORIG', '150 G'),
(41, 'SDS002DSPRMAC150 G', 'SDS', 'SUPER DOG SOAP', '002', 'DOG SOAP', 'DS', 'PRM', 'AC', '150 G'),
(42, 'SCB003DSPRMSCB150G', 'SCB', 'SHAMPOO & CONDITIONER', '003', 'DOG SOAP', 'DS', 'PRM', 'SCB', '150G'),
(43, 'POT004DPPRMPOT150 G ', 'POT', 'POWTECH', '004', 'DOG POWDER', 'DP', 'PRM', 'POT', '150 G '),
(46, 'SHS004HSPRMBLUE150G', 'SHS', 'SUPERDOC HITECH SOAP', '004', 'HITECH SOAP', 'HS', 'PRM', 'BLUE', '150G'),
(47, 'SHS004HSPRMPINK150G', 'SHS', 'SUPERDOC HITECH SOAP', '004', 'HITECH SOAP', 'HS', 'PRM', 'PINK', '150G'),
(48, 'MK9005MERCHTSVNECKXS', 'MK9', 'MANALO K9 (V-NECK)', '005', 'T-SHIRT', 'MERCH', 'TS', 'VNECK', 'XS'),
(49, 'MK9005MERCHTSVNECKS', 'MK9', 'MANALO K9 (V-NECK)', '005', 'T-SHIRT', 'MERCH', 'TS', 'VNECK', 'S'),
(50, 'MK9005MERCHTSVNECKM', 'MK9', 'MANALO K9 (V-NECK)', '005', 'T-SHIRT', 'MERCH', 'TS', 'VNECK', 'M'),
(51, 'MK9005MERCHTSVNECKL', 'MK9', 'MANALO K9 (V-NECK)', '005', 'T-SHIRT', 'MERCH', 'TS', 'VNECK', 'L'),
(52, 'MK9005MERCHTSVNECKXL', 'MK9', 'MANALO K9 (V-NECK)', '005', 'T-SHIRT', 'MERCH', 'TS', 'VNECK', 'XL'),
(53, 'MK9005MERCHTSVNECK2XL', 'MK9', 'MANALO K9 (V-NECK)', '005', 'T-SHIRT', 'MERCH', 'TS', 'VNECK', '2XL'),
(54, 'MK9006MERCHTSROUNDXS', 'MK9', 'MANALO K9 (R-NECK)', '006', 'T-SHIRT', 'MERCH', 'TS', 'ROUND', 'XS'),
(55, 'MK9006MERCHTSROUNDS', 'MK9', 'MANALO K9 (R-NECK)', '006', 'T-SHIRT', 'MERCH', 'TS', 'ROUND', 'S'),
(56, 'MK9006MERCHTSROUNDM', 'MK9', 'MANALO K9 (R-NECK)', '006', 'T-SHIRT', 'MERCH', 'TS', 'ROUND', 'M'),
(57, 'MK9006MERCHTSROUNDL', 'MK9', 'MANALO K9 (R-NECK)', '006', 'T-SHIRT', 'MERCH', 'TS', 'ROUND', 'L'),
(58, 'MK9006MERCHTSROUNDXL', 'MK9', 'MANALO K9 (R-NECK)', '006', 'T-SHIRT', 'MERCH', 'TS', 'ROUND', 'XL'),
(59, 'MK9006MERCHTSROUND2XL', 'MK9', 'MANALO K9 (R-NECK)', '006', 'T-SHIRT', 'MERCH', 'TS', 'ROUND', '2XL'),
(60, 'SDN001DFPRMORIG1KG', 'SDN', 'SUPER DOG NUTRITION', '001', 'DOG FOOD ', 'DF', 'PRM', 'ORIG', '1KG'),
(62, 'MK9007MERCHTSICGDXS', 'MK9', 'MANALO K9 (ICGD ROUND)', '007', 'T-SHIRT', 'MERCH', 'TS', 'ICGD', 'XS'),
(63, 'MK9007MERCHTSICGDS', 'MK9', 'MANALO K9 (ICGD ROUND)', '007', 'T-SHIRT', 'MERCH', 'TS', 'ICGD', 'S'),
(64, 'MK9007MERCHTSICGDM', 'MK9', 'MANALO K9 (ICGD ROUND)', '007', 'T-SHIRT', 'MERCH', 'TS', 'ICGD', 'M'),
(66, 'MK9007MERCHTSICGDL', 'MK9', 'MANALO K9 (ICGD ROUND)', '007', 'T-SHIRT', 'MERCH', 'TS', 'ICGD', 'L'),
(67, 'MK9007MERCHTSICGDXL', 'MK9', 'MANALO K9 (ICGD ROUND)', '007', 'T-SHIRT', 'MERCH', 'TS', 'ICGD', 'XL'),
(68, 'MK9007MERCHTSICGD2XL', 'MK9', 'MANALO K9 (ICGD ROUND)', '007', 'T-SHIRT', 'MERCH', 'TS', 'ICGD', '2XL'),
(69, 'MK9008MERCHTSSDXS', 'MK9', 'MANALO K9 (SUPERDOGGERS)', '008', 'T-SHIRT', 'MERCH', 'TS', 'SD', 'XS'),
(70, 'MK9008MERCHTSSDS', 'MK9', 'MANALO K9 (SUPERDOGGERS)', '008', 'T-SHIRT', 'MERCH', 'TS', 'SD', 'S'),
(71, 'MK9008MERCHTSSDM', 'MK9', 'MANALO K9 (SUPERDOGGERS)', '008', 'T-SHIRT', 'MERCH', 'TS', 'SD', 'M'),
(72, 'MK9008MERCHTSSDL', 'MK9', 'MANALO K9 (SUPERDOGGERS)', '008', 'T-SHIRT', 'MERCH', 'TS', 'SD', 'L'),
(73, 'MK9008MERCHTSSDXL', 'MK9', 'MANALO K9 (SUPERDOGGERS)', '008', 'T-SHIRT', 'MERCH', 'TS', 'SD', 'XL'),
(74, 'MK9008MERCHTSSDXXL', 'MK9', 'MANALO K9 (SUPERDOGGERS)', '008', 'T-SHIRT', 'MERCH', 'TS', 'SD', 'XXL'),
(75, 'MK9009MERCHTSWADXS', 'MK9', 'MANALO K9 (SANDO)', '009', 'T-SHIRT', 'MERCH', 'TS', 'WAD', 'XS'),
(76, 'MK9009MERCHTSWADS', 'MK9', 'MANALO K9 (SANDO)', '009', 'T-SHIRT', 'MERCH', 'TS', 'WAD', 'S'),
(77, 'MK9009MERCHTSWADM', 'MK9', 'MANALO K9 (SANDO)', '009', 'T-SHIRT', 'MERCH', 'TS', 'WAD', 'M'),
(78, 'MK9009MERCHTSWADL', 'MK9', 'MANALO K9 (SANDO)', '009', 'T-SHIRT', 'MERCH', 'TS', 'WAD', 'L'),
(79, 'MK9009MERCHTSWADXL', 'MK9', 'MANALO K9 (SANDO)', '009', 'T-SHIRT', 'MERCH', 'TS', 'WAD', 'XL'),
(80, 'MK9009MERCHTSWADXXL', 'MK9', 'MANALO K9 (SANDO)', '009', 'T-SHIRT', 'MERCH', 'TS', 'WAD', 'XXL'),
(81, 'MK9010MERCHSANDOYPSXS', 'MK9', 'MANALO K9 (SANDO-YOUR PAW)', '010', 'SANDO', 'MERCH', 'SANDO', 'YPS', 'XS'),
(82, 'MK9010MERCHSANDOYPSS', 'MK9', 'MANALO K9 (SANDO-YOUR PAW)', '010', 'SANDO', 'MERCH', 'SANDO', 'YPS', 'S'),
(83, 'MK9010MERCHSANDOYPSM', 'MK9', 'MANALO K9 (SANDO-YOUR PAW)', '010', 'SANDO', 'MERCH', 'SANDO', 'YPS', 'M'),
(84, 'MK9010MERCHSANDOYPSL', 'MK9', 'MANALO K9 (SANDO-YOUR PAW)', '010', 'SANDO', 'MERCH', 'SANDO', 'YPS', 'L'),
(85, 'MK9010MERCHSANDOYPSXL', 'MK9', 'MANALO K9 (SANDO-YOUR PAW)', '010', 'SANDO', 'MERCH', 'SANDO', 'YPS', 'XL'),
(86, 'MK9010MERCHSANDOYPSXXL', 'MK9', 'MANALO K9 (SANDO-YOUR PAW)', '010', 'SANDO', 'MERCH', 'SANDO', 'YPS', 'XXL'),
(87, 'MK9011MERCHSPAWSITIVEXS', 'MK9', 'MANALO K9 (SANDO-PAWSITIVE)', '011', 'SANDO', 'MERCH', 'S', 'PAWSITIVE', 'XS'),
(88, 'MK9011MERCHSPAWSITIVES', 'MK9', 'MANALO K9 (SANDO-PAWSITIVE)', '011', 'SANDO', 'MERCH', 'S', 'PAWSITIVE', 'S'),
(89, 'MK9011MERCHSANDOPAWSITIVEM', 'MK9', 'MANALO K9 (SANDO-PAWSITIVE)', '011', 'SANDO', 'MERCH', 'SANDO', 'PAWSITIVE', 'M'),
(90, 'MK9011MERCHSANDOPAWSITIVEXS', 'MK9', 'MANALO K9 (SANDO-PAWSITIVE)', '011', 'SANDO', 'MERCH', 'SANDO', 'PAWSITIVE', 'XS'),
(91, 'MK9011MERCHSANDOPAWSITIVES', 'MK9', 'MANALO K9 (SANDO-PAWSITIVE)', '011', 'SANDO', 'MERCH', 'SANDO', 'PAWSITIVE', 'S'),
(92, 'MK9011MERCHSANDOPAWSITIVEL', 'MK9', 'MANALO K9 (SANDO-PAWSITIVE)', '011', 'SANDO', 'MERCH', 'SANDO', 'PAWSITIVE', 'L'),
(93, 'MK9011MERCHSANDOPAWSITIVEXL', 'MK9', 'MANALO K9 (SANDO-PAWSITIVE)', '011', 'SANDO', 'MERCH', 'SANDO', 'PAWSITIVE', 'XL'),
(94, 'MK9012MERCHFMMK9REDFZ', 'MK9', 'MANALOK9 (FACEMASK)', '012', 'FACEMASK', 'MERCH', 'FM', 'MK9RED', 'FZ'),
(95, 'MK9012MERCHFMMK9BLACKFZ', 'MK9', 'MANALOK9 (FACEMASK)', '012', 'FACEMASK', 'MERCH', 'FM', 'MK9BLACK', 'FZ'),
(96, 'MK9012MERCHFMMK9GRAYFZ', 'MK9', 'MANALOK9 (FACEMASK)', '012', 'FACEMASK', 'MERCH', 'FM', 'MK9GRAY', 'FZ'),
(97, 'MK9012MERCHFMMK9GOLDREDFZ', 'MK9', 'MANALOK9 (FACEMASK)', '012', 'FACEMASK', 'MERCH', 'FM', 'MK9GOLDRED', 'FZ'),
(98, 'MK9012MERCHFMMK9REDFS', 'MK9', 'MANALOK9 (FACEMASK)', '012', 'FACEMASK', 'MERCH', 'FM', 'MK9RED', 'FS'),
(99, 'MK9012MERCHFMMK9BLACKFS', 'MK9', 'MANALOK9 (FACEMASK)', '012', 'FACEMASK', 'MERCH', 'FM', 'MK9BLACK', 'FS'),
(100, 'MK9012MERCHFMMK9GRAYFS', 'MK9', 'MANALOK9 (FACEMASK)', '012', 'FACEMASK', 'MERCH', 'FM', 'MK9GRAY', 'FS'),
(101, 'MK9012MERCHFMMK9 GOLD REDFS', 'MK9', 'MANALOK9 (FACEMASK)', '012', 'FACEMASK', 'MERCH', 'FM', 'MK9 GOLD RED', 'FS'),
(102, 'MK9012MERCHFMMK9GOLDREDFS', 'MK9', 'MANALOK9 (FACEMASK)', '012', 'FACEMASK', 'MERCH', 'FM', 'MK9GOLDRED', 'FS'),
(103, 'MK9012MERCHFMICGDWHITEFS', 'MK9', 'MANALOK9 (FACEMASK)', '012', 'FACEMASK', 'MERCH', 'FM', 'ICGDWHITE', 'FS'),
(104, 'MK9012MERCHFMICGDBLACKFS', 'MK9', 'MANALOK9 (FACEMASK)', '012', 'FACEMASK', 'MERCH', 'FM', 'ICGDBLACK', 'FS'),
(105, 'MK9 SJ013MERCHSJMK9SJWHITEFS', 'MK9 SJ', 'MK9 SPORTS JUG', '013', 'SPORTS JUG', 'MERCH', 'SJ', 'MK9SJWHITE', 'FS'),
(106, 'MK9 SJ013MERCHSJMK9SJSILVEFS', 'MK9 SJ', 'MK9 SPORTS JUG', '013', 'SPORTS JUG', 'MERCH', 'SJ', 'MK9SJSILVE', 'FS'),
(108, 'MK9UMB014MERCHUMBUMBWHITEFS', 'MK9UMB', 'MK9 UMBRELLA  ', '014', 'UMBRELLA', 'MERCH', 'UMB', 'UMBWHITE', 'FS'),
(109, 'MK9 MC015MERCHMCMCBWFS', 'MK9 MC', 'MK9 MESH CAP', '015', 'MESH CAP', 'MERCH', 'MC', 'MCBW', 'FS'),
(110, 'MC015MERCHMCMCBWFS', 'MC', 'MK9 MESH CAP', '015', 'MESH CAP', 'MERCH', 'MC', 'MCBW', 'FS'),
(111, 'MK9MC015MERCHMCMCBWFS', 'MK9MC', 'MK9 MESH CAP', '015', 'MESH CAP', 'MERCH', 'MC', 'MCBW', 'FS'),
(112, 'MK9014MERCHUMBWHITEFS', 'MK9', 'MANALO K9 (UMBRELLA)', '014', 'UMBRELLA', 'MERCH', 'UMB', 'WHITE', 'FS'),
(113, 'MK9015MERCHMCBLACK&WHITEFS', 'MK9', 'MANALO K9 (MESH CAP)', '015', 'MESH CAP', 'MERCH', 'MC', 'BLACK&WHITE', 'FS'),
(114, 'MK9016MERCHALARMYGREENADULTFS', 'MK9', 'MANALO K9 (ADULT LEASH)', '016', 'ADULT - LEASH', 'MERCH', 'AL', 'ARMYGREENADULT', 'FS'),
(115, 'MK9016MERCHALBLACKADULTFS', 'MK9', 'MANALO K9 (ADULT LEASH)', '016', 'ADULT - LEASH', 'MERCH', 'AL', 'BLACKADULT', 'FS'),
(116, 'MK9016MERCHALBEIGEADULTFS', 'MK9', 'MANALO K9 (ADULT LEASH)', '016', 'ADULT - LEASH', 'MERCH', 'AL', 'BEIGEADULT', 'FS'),
(117, 'MK9016MERCHLEASHARMYGREENADULTAS', 'MK9', 'MANALO K9 (LEASH)', '016', 'LEASH', 'MERCH', 'LEASH', 'ARMYGREENADULT', 'AS'),
(118, 'MK9016MERCHLEASHBLACKADULTAS', 'MK9', 'MANALO K9 (LEASH)', '016', 'LEASH', 'MERCH', 'LEASH', 'BLACKADULT', 'AS'),
(119, 'MK9016MERCHLEASHBEIGEADULTAS', 'MK9', 'MANALO K9 (LEASH)', '016', 'LEASH', 'MERCH', 'LEASH', 'BEIGEADULT', 'AS'),
(120, 'MK9017MERCHCOLLARARMYGREENADULTAS', 'MK9', 'MANALO K9 (COLLAR)', '017', 'COLLAR', 'MERCH', 'COLLAR', 'ARMYGREENADULT', 'AS'),
(121, 'MK9017MERCHCOLLARBLACKADULTAS', 'MK9', 'MANALO K9 (COLLAR)', '017', 'COLLAR', 'MERCH', 'COLLAR', 'BLACKADULT', 'AS'),
(122, 'MK9020MERCHMUGSUPPERDOGGERSMUGFS', 'MK9', 'MANALO K9 (MUG)', '020', 'MUG', 'MERCH', 'MUG', 'SUPPERDOGGERSMUG', 'FS'),
(123, 'MK9020MERCHMGSUPPERDOGGERSMUGFS', 'MK9', 'MANALO K9 (MUG)', '020', 'MUG', 'MERCH', 'MG', 'SUPPERDOGGERSMUG', 'FS'),
(124, 'MK9020MERCHMGMANALOK9LOGOMUGFS', 'MK9', 'MANALO K9 (MUG)', '020', 'MUG', 'MERCH', 'MG', 'MANALOK9LOGOMUG', 'FS'),
(125, 'MK9020MERCHMGMAGICMUGFS', 'MK9', 'MANALO K9 (MUG)', '020', 'MUG', 'MERCH', 'MG', 'MAGICMUG', 'FS'),
(126, 'MK9 SJ013MERCHSJWHITEFS', 'MK9 SJ', 'MANALO K9 (SPORTS JUG)', '013', 'SPORTS JUG', 'MERCH', 'SJ', 'WHITE', 'FS'),
(127, 'MK9 013MERCHSJWHITEFS', 'MK9 ', 'MANALO K9 (SPORTS JUG)', '013', 'SPORTS JUG', 'MERCH', 'SJ', 'WHITE', 'FS'),
(128, 'MK90021MERCHBAGWHITEBAG WHITE10', 'MK9', 'MANALO K9 (CANVASS BAG)', '0021', 'CANVASS BAG', 'MERCH', 'BAGWHITE', 'BAG WHITE', '10'),
(129, 'MK90021MERCHCANBAGCANBAG10', 'MK9', 'MANALO K9 (CANVASS BAG)', '0021', 'CANVASS BAG', 'MERCH', 'CANBAG', 'CANBAG', '10'),
(130, 'MK9 013MERCHSPOJUGWHITEFS', 'MK9 ', 'MANALO K9(SPORTS JUG)', '013', 'SPORTS JUG', 'MERCH', 'SPOJUG', 'WHITE', 'FS'),
(131, 'MK9 013MERCHSPOJUGSILVERFS', 'MK9 ', 'MANALO K9(SPORTS JUG)', '013', 'SPORTS JUG', 'MERCH', 'SPOJUG', 'SILVER', 'FS'),
(132, 'MK9016MERCHLEASHARMYGREENAS', 'MK9', 'MANALO K9 (LEASH)', '016', 'LEASH', 'MERCH', 'LEASH', 'ARMYGREEN', 'AS'),
(133, 'MK9016MERCHLEASHBLACKAS', 'MK9', 'MANALO K9 (LEASH)', '016', 'LEASH', 'MERCH', 'LEASH', 'BLACK', 'AS'),
(134, 'MK9016MERCHLEASHBEIGEAS', 'MK9', 'MANALO K9 (LEASH)', '016', 'LEASH', 'MERCH', 'LEASH', 'BEIGE', 'AS'),
(135, 'MK9017MERCHCOLLARARMYGREENAS', 'MK9', 'MANALO K9 (COLLAR)', '017', 'COLLAR', 'MERCH', 'COLLAR', 'ARMYGREEN', 'AS'),
(136, 'MK9017MERCHCOLLARBLACKAS', 'MK9', 'MANALO K9 (COLLAR)', '017', 'COLLAR', 'MERCH', 'COLLAR', 'BLACK', 'AS'),
(137, 'MK9017MERCHCOLLARBEIGEAS', 'MK9', 'MANALO K9 (COLLAR)', '017', 'COLLAR', 'MERCH', 'COLLAR', 'BEIGE', 'AS'),
(138, 'MK9016MERCHLEASHPUPPBLACKPPS', 'MK9', 'MANALO K9 (LEASH)', '016', 'LEASH', 'MERCH', 'LEASH', 'PUPPBLACK', 'PPS'),
(139, 'MK9016MERCHLEASHPUPPREDPPS', 'MK9', 'MANALO K9 (LEASH)', '016', 'LEASH', 'MERCH', 'LEASH', 'PUPPRED', 'PPS'),
(140, 'MK9016MERCHLEASHPUPPGRAYPPS', 'MK9', 'MANALO K9 (LEASH)', '016', 'LEASH', 'MERCH', 'LEASH', 'PUPPGRAY', 'PPS'),
(141, 'MK9016MERCHLEASHPUPPYELLOWPPS', 'MK9', 'MANALO K9 (LEASH)', '016', 'LEASH', 'MERCH', 'LEASH', 'PUPPYELLOW', 'PPS'),
(142, 'MK9016MERCHLEASHPUPPBROWNPPS', 'MK9', 'MANALO K9 (LEASH)', '016', 'LEASH', 'MERCH', 'LEASH', 'PUPPBROWN', 'PPS'),
(143, 'MK9016MERCHLEASHPUPPARMYGREENPPS', 'MK9', 'MANALO K9 (LEASH)', '016', 'LEASH', 'MERCH', 'LEASH', 'PUPPARMYGREEN', 'PPS'),
(144, 'MK9017MERCHCOLLARPUPPBLACKPPS', 'MK9', 'MANALO K9 (COLLAR)', '017', 'COLLAR', 'MERCH', 'COLLAR', 'PUPPBLACK', 'PPS'),
(145, 'MK9017MERCHCOLLARPUPPREDPPS', 'MK9', 'MANALO K9 (COLLAR)', '017', 'COLLAR', 'MERCH', 'COLLAR', 'PUPPRED', 'PPS'),
(146, 'MK9017MERCHCOLLARPUPPGRAYPPS', 'MK9', 'MANALO K9 (COLLAR)', '017', 'COLLAR', 'MERCH', 'COLLAR', 'PUPPGRAY', 'PPS'),
(147, 'MK9017MERCHCOLLARPUPPYELLOWAS', 'MK9', 'MANALO K9 (COLLAR)', '017', 'COLLAR', 'MERCH', 'COLLAR', 'PUPPYELLOW', 'AS'),
(148, 'MK9017MERCHCOLLARPUPPBROWNPPS', 'MK9', 'MANALO K9 (COLLAR)', '017', 'COLLAR', 'MERCH', 'COLLAR', 'PUPPBROWN', 'PPS'),
(149, 'MK9017MERCHCOLLARPUPPARMYGREENPPS', 'MK9', 'MANALO K9 (COLLAR)', '017', 'COLLAR', 'MERCH', 'COLLAR', 'PUPPARMYGREEN', 'PPS'),
(150, 'MS022MERCHTSMSBRXS', 'MS', 'META SHIRT', '022', 'T-SHIRT', 'MERCH', 'TS', 'MSBR', 'XS'),
(151, 'MS022MERCHTSMSBRS', 'MS', 'META SHIRT', '022', 'T-SHIRT', 'MERCH', 'TS', 'MSBR', 'S'),
(152, 'MS022MERCHTSMSBRM', 'MS', 'META SHIRT', '022', 'T-SHIRT', 'MERCH', 'TS', 'MSBR', 'M'),
(153, 'MS022MERCHTSMSBRL', 'MS', 'META SHIRT', '022', 'T-SHIRT', 'MERCH', 'TS', 'MSBR', 'L'),
(154, 'MS022MERCHTSMSBRXL', 'MS', 'META SHIRT', '022', 'T-SHIRT', 'MERCH', 'TS', 'MSBR', 'XL'),
(155, 'MS022MERCHTSMSBR2XL', 'MS', 'META SHIRT', '022', 'T-SHIRT', 'MERCH', 'TS', 'MSBR', '2XL'),
(156, 'MK9011MERCHSANDOPAWSITIVEXXL', 'MK9', 'MANALO K9 (SANDO-PAWSITIVE)', '011', 'SANDO', 'MERCH', 'SANDO', 'PAWSITIVE', 'XXL'),
(157, 'MK9023MERCHTSICGDTDXS', 'MK9', 'MANALO K9 (ICGD TOP DOGS)', '023', 'T-SHIRT', 'MERCH', 'TS', 'ICGDTD', 'XS'),
(158, 'IFGD024MERCHFMIFGDWHITEFREE SIZE', 'IFGD', 'FACEMASK (IFGD)', '024', 'FACEMASK', 'MERCH', 'FM', 'IFGDWHITE', 'FREE SIZE'),
(159, 'IFGD024MERCHFMIFGDBLACKFREE SIZE', 'IFGD', 'FACEMASK (IFGD)', '024', 'FACEMASK', 'MERCH', 'FM', 'IFGDBLACK', 'FREE SIZE'),
(160, 'MK9023MERCHTSICGDTDS', 'MK9', 'MANALO K9 (ICGD TOP DOGS)', '023', 'T-SHIRT', 'MERCH', 'TS', 'ICGDTD', 'S'),
(161, 'MK9023MERCHTSICGDTDM', 'MK9', 'MANALO K9 (ICGD TOP DOGS)', '023', 'T-SHIRT', 'MERCH', 'TS', 'ICGDTD', 'M'),
(162, 'MK9023MERCHTSICGDTDL', 'MK9', 'MANALO K9 (ICGD TOP DOGS)', '023', 'T-SHIRT', 'MERCH', 'TS', 'ICGDTD', 'L'),
(163, 'MK9023MERCHTSICGDTDXL', 'MK9', 'MANALO K9 (ICGD TOP DOGS)', '023', 'T-SHIRT', 'MERCH', 'TS', 'ICGDTD', 'XL'),
(164, 'MK9023MERCHTSICGDTDXXL', 'MK9', 'MANALO K9 (ICGD TOP DOGS)', '023', 'T-SHIRT', 'MERCH', 'TS', 'ICGDTD', 'XXL');

-- --------------------------------------------------------

--
-- Table structure for table `product_returned`
--

CREATE TABLE `product_returned` (
  `id` int(11) NOT NULL,
  `returnno` varchar(32) DEFAULT NULL,
  `stockid` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `transactionid` varchar(255) DEFAULT NULL,
  `prd_sku` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `remarks` varchar(128) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `userid` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `date_added` varchar(32) DEFAULT NULL,
  `Freebie` int(11) DEFAULT 0 COMMENT '0=no;1=yes;',
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `UserID` varchar(255) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1 COMMENT '0=not accepted;1=accepted;2=deleted;'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_stocks`
--

INSERT INTO `product_stocks` (`ID`, `UID`, `Product_SKU`, `Stocks`, `Current_Stocks`, `Released_Stocks`, `Retail_Price`, `Price_PerItem`, `Total_Price`, `Manufactured_By`, `Description`, `Expiration_Date`, `Date_Added`, `UserID`, `Status`) VALUES
(2, '577207308284', 'SHS004HSPRMPINK150G', '2351', '9571', '-7220', '150', '31', '72881', 'LEOMIE JHOY SOAP MFTG', '', '', '2022/04/13 10:57:41', '61a5caf447cae', 1),
(3, '698562504594', 'SHS004HSPRMBLUE150G', '2488', '4978', '-2490', '150.00', '31.00', '77128', 'LEOMIE JHOY SOAP MFTG', '', '', '2022/04/13 10:58:07', '61a5caf447cae', 1),
(4, '389509193021', 'SDS002DSPRMYP150 G', '14653', '14657', '-4', '150.00', '31.00', '454243', 'LEOMIE JHOY SOAP MFTG', '', '', '2022/04/13 11:06:13', '61a5caf447cae', 1),
(5, '610840330961', 'SDS002DSPRMORIG150 G', '5192', '5192', '0', '150.00', '31.00', '160952', 'LEOMIE JHOY MFTG', '', '', '2022/04/13 11:06:51', '61a5caf447cae', 1),
(6, '305096204785', 'SDS002DSPRMMC150 G', '15679', '15679', '0', '150.00', '31.00', '486049', '', '', '', '2022/04/13 11:08:26', '61a5caf447cae', 1),
(7, '295065421248', 'SDS002DSPRMAC150 G', '6152', '6092', '60', '150.00', '31.00', '190712', 'LEOMIE JHOY SOAP MFTG', '', '', '2022/04/13 11:09:37', '61a5caf447cae', 1),
(8, '709591752686', 'SDN001DFPRMORIG5KG', '4873', '4873', '0', '1100.00', '452.95', '2207225.35', 'PET ONE, INC', '', '', '2022/04/13 11:10:13', '61a5caf447cae', 1),
(9, '673068742688', 'SDN001DFPRMORIG500G', '431', '431', '0', '200', '79.80', '34393.8', 'PET ONE, INC', '', '', '2022/04/13 11:10:44', '61a5caf447cae', 1),
(10, '503263540983', 'SDN001DFPRMORIG15KG', '3323', '3323', '0', '3245.00', '1347.65', '4478240.95', 'PET ONE, INC', '', '', '2022/04/13 11:11:39', '61a5caf447cae', 1),
(11, '460191712132', 'SCB003DSPRMSCB150G', '18813', '18733', '80', '150.00', '28.50', '536170.5', 'LEOMIE JHOY SOAP MFTG', '', '', '2022/04/13 11:12:32', '61a5caf447cae', 1),
(12, '152418113111', 'POT004DPPRMPOT150 G ', '1083', '1083', '0', '150.00', '70.00', '75810', '', '', '', '2022/04/13 11:12:54', '61a5caf447cae', 1),
(13, '116890230329', 'MS022MERCHTSMSBRXS', '7', '7', '0', '500', '157', '1099', '', '', '', '2022/04/13 11:13:32', '61a5caf447cae', 1),
(14, '754664155939', 'MS022MERCHTSMSBRS', '12', '12', '0', '500', '157', '1884', '', '', '', '2022/04/13 11:13:53', '61a5caf447cae', 1),
(15, '036184520117', 'MS022MERCHTSMSBRM', '22', '22', '0', '500', '157', '3454', '', '', '', '2022/04/13 11:33:16', '61a5caf447cae', 1),
(16, '344970933874', 'MK9UMB014MERCHUMBUMBWHITEFS', '37', '37', '0', '200.00', '100.00', '3700', '', '', '', '2022/04/13 11:35:07', '61a5caf447cae', 1),
(17, '085243664870', 'MK9MC015MERCHMCMCBWFS', '82', '82', '0', '200.00', '85.00', '6970', '', '', '', '2022/04/13 11:35:37', '61a5caf447cae', 1),
(18, '337284131266', 'MK9020MERCHMGMAGICMUGFS', '48', '48', '0', '350.00', '99.00', '4752', '', '', '', '2022/04/13 11:46:30', '61a5caf447cae', 1),
(19, '024433665861', 'MK9020MERCHMGMANALOK9LOGOMUGFS', '92', '92', '0', '200.00', '74.00', '6808', '', '', '', '2022/04/13 11:47:01', '61a5caf447cae', 1),
(20, '907192492323', 'MK9020MERCHMGSUPPERDOGGERSMUGFS', '36', '36', '0', '250.00', '100.00', '3600', '', '', '', '2022/04/13 11:47:23', '61a5caf447cae', 1),
(21, '072989953372', 'MK9017MERCHCOLLARPUPPYELLOWAS', '13', '13', '0', '1100.00', '500.00', '6500', '', '', '', '2022/04/13 12:56:45', '61a5caf447cae', 1),
(22, '684322337198', 'MK9017MERCHCOLLARPUPPREDPPS', '12', '12', '0', '1100.00', '500', '6000', '', '', '', '2022/04/13 12:57:23', '61a5caf447cae', 1),
(23, '606477495407', 'MK9017MERCHCOLLARPUPPGRAYPPS', '9', '9', '0', '1100.00', '500.00', '4500', '', '', '', '2022/04/13 12:57:53', '61a5caf447cae', 1),
(24, '942301192534', 'MK9017MERCHCOLLARPUPPBROWNPPS', '8', '8', '0', '1100.00', '500.00', '4000', '', '', '', '2022/04/13 12:58:10', '61a5caf447cae', 1),
(25, '465699736305', 'MK9017MERCHCOLLARPUPPBLACKPPS', '18', '18', '0', '1100.00', '500.00', '9000', '', '', '', '2022/04/13 12:58:31', '61a5caf447cae', 1),
(26, '892182929487', 'MK9017MERCHCOLLARPUPPARMYGREENPPS', '13', '13', '0', '1100.00', '500.00', '6500', '', '', '', '2022/04/13 12:58:51', '61a5caf447cae', 1),
(27, '709101705714', 'MK9017MERCHCOLLARBLACKAS', '36', '36', '0', '2200.00', '800.00', '28800', '', '', '', '2022/04/13 12:59:36', '61a5caf447cae', 1),
(28, '918793886681', 'MK9017MERCHCOLLARBEIGEAS', '15', '15', '0', '2200.00', '800.00', '12000', '', '', '', '2022/04/13 13:00:04', '61a5caf447cae', 1),
(29, '740127167506', 'MK9017MERCHCOLLARARMYGREENAS', '23', '23', '0', '2200.00', '800.00', '18400', '', '', '', '2022/04/13 13:00:27', '61a5caf447cae', 1),
(30, '752730284099', 'MK9016MERCHLEASHPUPPYELLOWPPS', '13', '13', '0', '1000.00', '320.00', '4160', '', '', '', '2022/04/13 13:00:56', '61a5caf447cae', 1),
(31, '084864035440', 'MK9016MERCHLEASHPUPPREDPPS', '11', '11', '0', '1000.00', '320.00', '3520', '', '', '', '2022/04/13 13:01:23', '61a5caf447cae', 1),
(32, '046419359251', 'MK9016MERCHLEASHPUPPGRAYPPS', '11', '11', '0', '1000.00', '320.00', '3520', '', '', '', '2022/04/13 13:01:42', '61a5caf447cae', 1),
(33, '744832546774', 'MK9016MERCHLEASHPUPPBROWNPPS', '7', '7', '0', '1000.00', '320.00', '2240', '', '', '', '2022/04/13 13:02:09', '61a5caf447cae', 1),
(34, '485472207141', 'MK9016MERCHLEASHPUPPARMYGREENPPS', '13', '13', '0', '1000.00', '320.00', '4160', '', '', '', '2022/04/13 13:07:40', '61a5caf447cae', 1),
(35, '269500872673', 'MK9016MERCHLEASHBEIGEAS', '10', '10', '0', '1200.00', '450.00', '4500', '', '', '', '2022/04/13 13:22:07', '61a5caf447cae', 1),
(36, '383840947492', 'MK9016MERCHLEASHARMYGREENAS', '18', '18', '0', '1200.00', '450.00', '8100', '', '', '', '2022/04/13 13:22:33', '61a5caf447cae', 1),
(37, '130001403748', 'MK9016MERCHLEASHPUPPBLACKPPS', '18', '18', '0', '1000.00', '320.00', '5760', '', '', '', '2022/04/13 13:33:15', '61a5caf447cae', 1),
(38, '217842264471', 'MK9016MERCHLEASHBLACKAS', '10', '10', '0', '1200.00', '450.00', '4500', '', '', '', '2022/04/13 13:34:56', '61a5caf447cae', 1),
(39, '488979674166', 'MK9012MERCHFMMK9REDFS', '73', '73', '0', '150.00', '37.50', '2737.5', '', '', '', '2022/04/13 13:36:29', '61a5caf447cae', 1),
(40, '037283241294', 'MK9012MERCHFMMK9GRAYFS', '94', '94', '0', '150.00', '37.50', '3525', '', '', '', '2022/04/13 13:37:09', '61a5caf447cae', 1),
(41, '334938794184', 'MK9012MERCHFMMK9GOLDREDFS', '89', '89', '0', '150.00', '37.50', '3337.5', '', '', '', '2022/04/13 13:37:40', '61a5caf447cae', 1),
(42, '727034093861', 'MK9012MERCHFMMK9BLACKFS', '63', '63', '0', '150.00', '37.50', '2362.5', '', '', '', '2022/04/13 13:38:03', '61a5caf447cae', 1),
(43, '416711264764', 'MK9012MERCHFMICGDWHITEFS', '130', '130', '0', '150.00', '37.50', '4875', '', '', '', '2022/04/13 13:38:35', '61a5caf447cae', 1),
(44, '669944895489', 'MK9012MERCHFMICGDBLACKFS', '100', '100', '0', '150.00', '37.50', '3750', '', '', '', '2022/04/13 13:39:00', '61a5caf447cae', 1),
(45, '968946069589', 'MK9 013MERCHSPOJUGWHITEFS', '48', '48', '0', '250.00', '65.00', '3120', '', '', '', '2022/04/13 13:40:27', '61a5caf447cae', 1),
(46, '823244491743', 'MK9 013MERCHSPOJUGSILVERFS', '44', '44', '0', '250.00', '65.00', '2860', '', '', '', '2022/04/13 13:41:09', '61a5caf447cae', 1),
(47, '164769382756', 'MK90021MERCHCANBAGCANBAG10', '118', '118', '0', '150.00', '65.00', '7670', '', '', '', '2022/04/13 13:41:48', '61a5caf447cae', 1),
(48, '960733129264', 'MS022MERCHTSMSBRL', '21', '21', '0', '500.00', '157.00', '3297', '', '', '', '2022/04/13 13:54:18', '61a5caf447cae', 1),
(49, '042699371240', 'MS022MERCHTSMSBRXL', '10', '10', '0', '500.00', '157.00', '1570', '', '', '', '2022/04/13 13:54:47', '61a5caf447cae', 1),
(50, '465903384435', 'MS022MERCHTSMSBR2XL', '5', '5', '0', '500.00', '157.00', '785', '', '', '', '2022/04/13 13:55:13', '61a5caf447cae', 1),
(51, '603093634198', 'MK9008MERCHTSSDXS', '5', '5', '0', '350.00', '157.40', '787', '', '', '', '2022/04/13 14:10:48', '61a5caf447cae', 1),
(52, '317770704841', 'MK9008MERCHTSSDS', '4', '4', '0', '350.00', '157.40', '629.6', '', '', '', '2022/04/13 14:11:14', '61a5caf447cae', 1),
(53, '277624416384', 'MK9009MERCHTSWADS', '1', '1', '0', '123.81', '350.00', '350', '', '', '', '2022/04/13 14:20:00', '61a5caf447cae', 1),
(54, '466107403295', 'MK9009MERCHTSWADM', '6', '6', '0', '123.81', '350.00', '2100', '', '', '', '2022/04/13 14:20:26', '61a5caf447cae', 1),
(55, '291156290831', 'MK9009MERCHTSWADL', '3', '3', '0', '123.81', '350.00', '1050', '', '', '', '2022/04/13 14:20:45', '61a5caf447cae', 1),
(56, '070549738720', 'MK9009MERCHTSWADXL', '2', '2', '0', '123.81', '350.00', '700', '', '', '', '2022/04/13 14:21:02', '61a5caf447cae', 1),
(57, '538124072215', 'MK9009MERCHTSWADXXL', '2', '2', '0', '123.81', '350.00', '700', '', '', '', '2022/04/13 14:21:22', '61a5caf447cae', 1),
(58, '660806621749', 'MK9010MERCHSANDOYPSS', '2', '2', '0', '350.00', '123.81', '247.62', '', '', '', '2022/04/13 14:22:20', '61a5caf447cae', 1),
(59, '313643673607', 'MK9010MERCHSANDOYPSM', '1', '1', '0', '350.00', '123.81', '123.81', '', '', '', '2022/04/13 14:22:39', '61a5caf447cae', 1),
(60, '796275537042', 'MK9010MERCHSANDOYPSL', '4', '4', '0', '350.00', '123.81', '495.24', '', '', '', '2022/04/13 14:23:02', '61a5caf447cae', 1),
(61, '969935535812', 'MK9010MERCHSANDOYPSXL', '5', '5', '0', '350.00', '123.81', '619.05', '', '', '', '2022/04/13 14:23:31', '61a5caf447cae', 1),
(62, '799845854119', 'MK9010MERCHSANDOYPSXXL', '4', '4', '0', '350.00', '123.81', '495.24', '', '', '', '2022/04/13 14:23:50', '61a5caf447cae', 1),
(63, '090173154793', 'MK9011MERCHSANDOPAWSITIVES', '2', '2', '0', '350.00', '123.81', '247.62', '', '', '', '2022/04/13 14:24:23', '61a5caf447cae', 1),
(64, '709737765784', 'MK9011MERCHSANDOPAWSITIVEM', '5', '5', '0', '350.00', '123.81', '619.05', '', '', '', '2022/04/13 14:24:41', '61a5caf447cae', 1),
(65, '000445190858', 'MK9011MERCHSANDOPAWSITIVEL', '1', '1', '0', '350.00', '123.81', '123.81', '', '', '', '2022/04/13 14:24:58', '61a5caf447cae', 1),
(66, '455256666493', 'MK9011MERCHSANDOPAWSITIVEXL', '4', '4', '0', '350.00', '123.81', '495.24', '', '', '', '2022/04/13 14:25:16', '61a5caf447cae', 1),
(67, '661660666766', 'MK9011MERCHSANDOPAWSITIVEXXL', '2', '2', '0', '350.00', '123.81', '247.62', '', '', '', '2022/04/13 14:28:36', '61a5caf447cae', 1),
(68, '267201450035', 'MK9005MERCHTSVNECKS', '38', '38', '0', '500.00', '157.40', '5981.2', '', '', '', '2022/04/13 14:29:20', '61a5caf447cae', 1),
(69, '836978213027', 'MK9005MERCHTSVNECKM', '36', '36', '0', '500.00', '157.40', '5666.4', '', '', '', '2022/04/13 14:29:42', '61a5caf447cae', 1),
(70, '348261321516', 'MK9005MERCHTSVNECKL', '29', '29', '0', '500.00', '157.40', '4564.6', '', '', '', '2022/04/13 14:30:04', '61a5caf447cae', 1),
(71, '268332374368', 'MK9005MERCHTSVNECKXL', '38', '38', '0', '500.00', '157.40', '5981.2', '', '', '', '2022/04/13 14:30:22', '61a5caf447cae', 1),
(72, '849855046474', 'MK9006MERCHTSROUNDXS', '28', '28', '0', '500.00', '157.40', '4407.2', '', '', '', '2022/04/13 14:31:45', '61a5caf447cae', 1),
(73, '163889315201', 'MK9006MERCHTSROUNDS', '6', '6', '0', '500.00', '157.40', '944.4', '', '', '', '2022/04/13 14:32:04', '61a5caf447cae', 1),
(74, '545199272285', 'MK9006MERCHTSROUNDM', '33', '33', '0', '500.00', '157.40', '5194.2', '', '', '', '2022/04/13 14:32:26', '61a5caf447cae', 1),
(75, '678267141100', 'MK9006MERCHTSROUNDL', '29', '29', '0', '500.00', '157.40', '4564.6', '', '', '', '2022/04/13 14:41:31', '61a5caf447cae', 1),
(76, '551309602225', 'MK9006MERCHTSROUNDXL', '24', '24', '0', '500.00', '157.40', '3777.6', '', '', '', '2022/04/13 14:41:53', '61a5caf447cae', 1),
(77, '619058165690', 'MK9006MERCHTSROUND2XL', '2', '2', '0', '500.00', '157.40', '314.8', '', '', '', '2022/04/13 14:42:26', '61a5caf447cae', 1),
(78, '704992641756', 'MK9007MERCHTSICGDXS', '19', '19', '0', '350.00', '157.40', '2990.6', '', '', '', '2022/04/13 14:43:12', '61a5caf447cae', 1),
(79, '833259988634', 'MK9007MERCHTSICGDS', '19', '19', '0', '350.00', '157.40', '2990.6', '', '', '', '2022/04/13 14:44:13', '61a5caf447cae', 1),
(80, '181222203997', 'MK9007MERCHTSICGDM', '10', '10', '0', '350.00', '157.40', '1574', '', '', '', '2022/04/13 14:44:56', '61a5caf447cae', 1),
(81, '827093288321', 'MK9007MERCHTSICGDL', '5', '5', '0', '350.00', '157.40', '787', '', '', '', '2022/04/13 14:45:16', '61a5caf447cae', 1),
(82, '398071086767', 'MK9007MERCHTSICGDXL', '7', '7', '0', '350.00', '157.40', '1101.8', '', '', '', '2022/04/13 14:45:31', '61a5caf447cae', 1),
(83, '347071073154', 'MK9007MERCHTSICGD2XL', '38', '38', '0', '350.00', '157.40', '5981.2', '', '', '', '2022/04/13 14:45:52', '61a5caf447cae', 1),
(84, '574166262403', 'MK9008MERCHTSSDXXL', '15', '15', '0', '350.00', '157.40', '2361', '', '', '', '2022/04/13 14:56:19', '61a5caf447cae', 1),
(85, '478607429771', 'MK9015MERCHMCBLACK&WHITEFS', '82', '82', '0', '200.00', '85.00', '6970', '', '', '', '2022/04/13 14:58:59', '61a5caf447cae', 1),
(86, '369348302449', 'MK9014MERCHUMBWHITEFS', '37', '37', '0', '200.00', '100.00', '3700', '', '', '', '2022/04/13 15:00:35', '61a5caf447cae', 1),
(87, '009841685129', 'IFGD024MERCHFMIFGDWHITEFREE SIZE', '40', '40', '0', '150.00', '37.50', '1500', '', '', '', '2022/04/13 15:30:10', '61a5caf447cae', 1),
(88, '569999405760', 'IFGD024MERCHFMIFGDBLACKFREE SIZE', '30', '30', '0', '150.00', '37.50', '1125', '', '', '', '2022/04/13 15:30:32', '61a5caf447cae', 1),
(89, '211290277824', 'MK9023MERCHTSICGDTDXS', '10', '10', '0', '350.00', '157.40', '1574', '', '', '', '2022/04/13 15:55:19', '61a5caf447cae', 1),
(90, '048382164970', 'MK9023MERCHTSICGDTDS', '13', '13', '0', '350.00', '157.40', '2046.2', '', '', '', '2022/04/13 16:08:28', '61a5caf447cae', 1),
(91, '948715985404', 'MK9023MERCHTSICGDTDM', '9', '9', '0', '350.00', '157.40', '1416.6', '', '', '', '2022/04/13 16:08:46', '61a5caf447cae', 1),
(92, '405236586071', 'MK9023MERCHTSICGDTDL', '2', '2', '0', '350.00', '157.40', '314.8', '', '', '', '2022/04/13 16:09:09', '61a5caf447cae', 1),
(93, '214511744193', 'MK9023MERCHTSICGDTDXL', '11', '11', '0', '350.00', '157.40', '1731.4', '', '', '', '2022/04/13 16:09:28', '61a5caf447cae', 1),
(94, '769702833908', 'MK9023MERCHTSICGDTDXXL', '7', '7', '0', '351.00', '160.40', '1122.8', '', '', '', '2022/04/13 16:09:44', '61a5caf447cae', 1),
(95, '698562504594', 'SHS004HSPRMBLUE150G', '4', '4', '0', '150.00', '31.00', '124', NULL, NULL, '', '2022-05-17 21:26:27', '61a5caf447cae', 0),
(96, '673068742688', 'SDN001DFPRMORIG500G', '3', '3', '0', '200', '79.80', '239.4', NULL, NULL, '', '2022-05-17 21:26:27', '61a5caf447cae', 0),
(97, '305096204785', 'SDS002DSPRMMC150 G', '3', '3', '0', '150.00', '31.00', '93', NULL, NULL, '', '2022-05-17 21:26:27', '61a5caf447cae', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `ID` int(11) NOT NULL,
  `OrderNo` varchar(255) DEFAULT NULL,
  `Date` varchar(255) DEFAULT NULL,
  `DateCreation` varchar(255) DEFAULT NULL,
  `VendorNo` varchar(255) DEFAULT NULL,
  `ShipVia` varchar(255) DEFAULT NULL,
  `DateDelivery` varchar(255) DEFAULT NULL,
  `DateApproved` varchar(32) DEFAULT NULL,
  `TotalRemainingPayment` varchar(32) DEFAULT '0',
  `Remarks` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL COMMENT '0 = rejected; 1 = for approval; 2 = approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`ID`, `OrderNo`, `Date`, `DateCreation`, `VendorNo`, `ShipVia`, `DateDelivery`, `DateApproved`, `TotalRemainingPayment`, `Remarks`, `Status`) VALUES
(1, 'PO626216755AC22', '2022-04-22 10:43:00', '2022-04-22 10:44:05', 'V625531F0D43F0', 'delivery', '2022-04-22', NULL, '4500', NULL, 1),
(2, 'PO6283A2831A1A7', '2022-05-17 21:25:00', '2022-05-17 21:26:27', 'V6283A2831A357', 'test', '2022-05-17', NULL, '22771.4', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `replacements`
--

CREATE TABLE `replacements` (
  `ID` int(11) NOT NULL,
  `ReplacementNo` varchar(64) DEFAULT NULL,
  `TransactionID` varchar(64) DEFAULT NULL,
  `DateAdded` varchar(32) DEFAULT NULL,
  `OrderNo` varchar(64) DEFAULT NULL,
  `Cost` varchar(32) DEFAULT NULL,
  `Price` varchar(32) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `replacements`
--

INSERT INTO `replacements` (`ID`, `ReplacementNo`, `TransactionID`, `DateAdded`, `OrderNo`, `Cost`, `Price`, `Status`) VALUES
(5, 'RP6273ECD3CEA6C', 'SHS004HSPRMPINK150G-6273ECD3BC32A', '2022/05/05 23:27:15', 'SO6273EA988E0D1', '31', '150', 0);

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `ID` int(11) NOT NULL,
  `ReturnNo` varchar(255) DEFAULT NULL,
  `DateCreation` varchar(255) DEFAULT NULL,
  `SalesOrderNo` varchar(255) DEFAULT NULL COMMENT 'sales order no of returned items',
  `ClientNo` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales_history`
--

CREATE TABLE `sales_history` (
  `id` int(11) NOT NULL,
  `stockid` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `transactionid` varchar(255) DEFAULT NULL,
  `uid` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `prd_sku` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `cost` varchar(255) DEFAULT NULL,
  `total_cost` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL,
  `userid` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `date_added` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_history`
--

INSERT INTO `sales_history` (`id`, `stockid`, `transactionid`, `uid`, `prd_sku`, `quantity`, `cost`, `total_cost`, `price`, `total_price`, `userid`, `date_added`, `status`) VALUES
(1, '1', 'SHS004HSPRMPINK150G-62563B9865771', '577207308284', 'SHS004HSPRMPINK150G', '2488', NULL, NULL, NULL, NULL, '61a5caf447cae', '2022/04/13 10:55:20', 'restocked'),
(2, '2', 'SHS004HSPRMPINK150G-62567396CAED2', '577207308284', 'SHS004HSPRMPINK150G', '2351', '31', '72881', '150', '352650', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(3, '3', 'SHS004HSPRMBLUE150G-62567396D1090', '698562504594', 'SHS004HSPRMBLUE150G', '2488', '31.00', '77128', '150.00', '373200', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(4, '4', 'SDS002DSPRMYP150 G-62567396D5966', '389509193021', 'SDS002DSPRMYP150 G', '14653', '31.00', '454243', '150.00', '2197950', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(5, '5', 'SDS002DSPRMORIG150 G-62567396DB0C2', '610840330961', 'SDS002DSPRMORIG150 G', '5192', '31.00', '160952', '150.00', '778800', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(6, '6', 'SDS002DSPRMMC150 G-62567396DC249', '305096204785', 'SDS002DSPRMMC150 G', '15679', '31.00', '486049', '150.00', '2351850', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(7, '7', 'SDS002DSPRMAC150 G-62567396DD5F4', '295065421248', 'SDS002DSPRMAC150 G', '6152', '31.00', '190712', '150.00', '922800', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(8, '8', 'SDN001DFPRMORIG5KG-62567396DE907', '709591752686', 'SDN001DFPRMORIG5KG', '4873', '452.95', '2207225.35', '1100.00', '5360300', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(9, '9', 'SDN001DFPRMORIG500G-62567396DFAC4', '673068742688', 'SDN001DFPRMORIG500G', '431', '79.80', '34393.799999999996', '200', '86200', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(10, '10', 'SDN001DFPRMORIG15KG-62567396E0AD1', '503263540983', 'SDN001DFPRMORIG15KG', '3323', '1347.65', '4478240.95', '3245.00', '10783135', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(11, '11', 'SCB003DSPRMSCB150G-62567396E1A96', '460191712132', 'SCB003DSPRMSCB150G', '18813', '28.50', '536170.5', '150.00', '2821950', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(12, '12', 'POT004DPPRMPOT150 G -62567396E29F2', '152418113111', 'POT004DPPRMPOT150 G ', '1083', '70.00', '75810', '150.00', '162450', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(13, '13', 'MS022MERCHTSMSBRXS-62567396E38B8', '116890230329', 'MS022MERCHTSMSBRXS', '7', '157', '1099', '500', '3500', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(14, '14', 'MS022MERCHTSMSBRS-62567396E48A2', '754664155939', 'MS022MERCHTSMSBRS', '12', '157', '1884', '500', '6000', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(15, '15', 'MS022MERCHTSMSBRM-62567396EA547', '036184520117', 'MS022MERCHTSMSBRM', '22', '157', '3454', '500', '11000', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(16, '16', 'MK9UMB014MERCHUMBUMBWHITEFS-62567396EB4B9', '344970933874', 'MK9UMB014MERCHUMBUMBWHITEFS', '37', '100.00', '3700', '200.00', '7400', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(17, '17', 'MK9MC015MERCHMCMCBWFS-62567396EC455', '085243664870', 'MK9MC015MERCHMCMCBWFS', '82', '85.00', '6970', '200.00', '16400', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(18, '18', 'MK9020MERCHMGMAGICMUGFS-62567396ED391', '337284131266', 'MK9020MERCHMGMAGICMUGFS', '48', '99.00', '4752', '350.00', '16800', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(19, '19', 'MK9020MERCHMGMANALOK9LOGOMUGFS-62567396EE24B', '024433665861', 'MK9020MERCHMGMANALOK9LOGOMUGFS', '92', '74.00', '6808', '200.00', '18400', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(20, '20', 'MK9020MERCHMGSUPPERDOGGERSMUGFS-62567396EF21D', '907192492323', 'MK9020MERCHMGSUPPERDOGGERSMUGFS', '36', '100.00', '3600', '250.00', '9000', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(21, '21', 'MK9017MERCHCOLLARPUPPYELLOWAS-62567396F0136', '072989953372', 'MK9017MERCHCOLLARPUPPYELLOWAS', '13', '500.00', '6500', '1100.00', '14300', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(22, '22', 'MK9017MERCHCOLLARPUPPREDPPS-62567396F10C7', '684322337198', 'MK9017MERCHCOLLARPUPPREDPPS', '12', '500', '6000', '1100.00', '13200', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(23, '23', 'MK9017MERCHCOLLARPUPPGRAYPPS-62567396F1FCF', '606477495407', 'MK9017MERCHCOLLARPUPPGRAYPPS', '9', '500.00', '4500', '1100.00', '9900', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(24, '24', 'MK9017MERCHCOLLARPUPPBROWNPPS-62567396F2FC6', '942301192534', 'MK9017MERCHCOLLARPUPPBROWNPPS', '8', '500.00', '4000', '1100.00', '8800', '61a5caf447cae', '2022/04/13 14:54:14', 'restocked'),
(25, '25', 'MK9017MERCHCOLLARPUPPBLACKPPS-62567396F4094', '465699736305', 'MK9017MERCHCOLLARPUPPBLACKPPS', '18', '500.00', '9000', '1100.00', '19800', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(26, '26', 'MK9017MERCHCOLLARPUPPARMYGREENPPS-6256739700E13', '892182929487', 'MK9017MERCHCOLLARPUPPARMYGREENPPS', '13', '500.00', '6500', '1100.00', '14300', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(27, '27', 'MK9017MERCHCOLLARBLACKAS-6256739701DD8', '709101705714', 'MK9017MERCHCOLLARBLACKAS', '36', '800.00', '28800', '2200.00', '79200', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(28, '28', 'MK9017MERCHCOLLARBEIGEAS-6256739702E5D', '918793886681', 'MK9017MERCHCOLLARBEIGEAS', '15', '800.00', '12000', '2200.00', '33000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(29, '29', 'MK9017MERCHCOLLARARMYGREENAS-6256739703E42', '740127167506', 'MK9017MERCHCOLLARARMYGREENAS', '23', '800.00', '18400', '2200.00', '50600', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(30, '30', 'MK9016MERCHLEASHPUPPYELLOWPPS-6256739704DF8', '752730284099', 'MK9016MERCHLEASHPUPPYELLOWPPS', '13', '320.00', '4160', '1000.00', '13000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(31, '31', 'MK9016MERCHLEASHPUPPREDPPS-6256739705F27', '084864035440', 'MK9016MERCHLEASHPUPPREDPPS', '11', '320.00', '3520', '1000.00', '11000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(32, '32', 'MK9016MERCHLEASHPUPPGRAYPPS-6256739706E01', '046419359251', 'MK9016MERCHLEASHPUPPGRAYPPS', '11', '320.00', '3520', '1000.00', '11000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(33, '33', 'MK9016MERCHLEASHPUPPBROWNPPS-625673970801D', '744832546774', 'MK9016MERCHLEASHPUPPBROWNPPS', '7', '320.00', '2240', '1000.00', '7000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(34, '34', 'MK9016MERCHLEASHPUPPARMYGREENPPS-6256739709050', '485472207141', 'MK9016MERCHLEASHPUPPARMYGREENPPS', '13', '320.00', '4160', '1000.00', '13000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(35, '35', 'MK9016MERCHLEASHBEIGEAS-625673970A136', '269500872673', 'MK9016MERCHLEASHBEIGEAS', '10', '450.00', '4500', '1200.00', '12000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(36, '36', 'MK9016MERCHLEASHARMYGREENAS-625673970B10F', '383840947492', 'MK9016MERCHLEASHARMYGREENAS', '18', '450.00', '8100', '1200.00', '21600', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(37, '37', 'MK9016MERCHLEASHPUPPBLACKPPS-625673970C0A4', '130001403748', 'MK9016MERCHLEASHPUPPBLACKPPS', '18', '320.00', '5760', '1000.00', '18000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(38, '38', 'MK9016MERCHLEASHBLACKAS-625673970D002', '217842264471', 'MK9016MERCHLEASHBLACKAS', '10', '450.00', '4500', '1200.00', '12000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(39, '39', 'MK9012MERCHFMMK9REDFS-625673970DF3C', '488979674166', 'MK9012MERCHFMMK9REDFS', '73', '37.50', '2737.5', '150.00', '10950', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(40, '40', 'MK9012MERCHFMMK9GRAYFS-625673970EF45', '037283241294', 'MK9012MERCHFMMK9GRAYFS', '94', '37.50', '3525', '150.00', '14100', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(41, '41', 'MK9012MERCHFMMK9GOLDREDFS-625673970FF48', '334938794184', 'MK9012MERCHFMMK9GOLDREDFS', '89', '37.50', '3337.5', '150.00', '13350', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(42, '42', 'MK9012MERCHFMMK9BLACKFS-6256739710E1F', '727034093861', 'MK9012MERCHFMMK9BLACKFS', '63', '37.50', '2362.5', '150.00', '9450', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(43, '43', 'MK9012MERCHFMICGDWHITEFS-6256739711E3A', '416711264764', 'MK9012MERCHFMICGDWHITEFS', '130', '37.50', '4875', '150.00', '19500', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(44, '44', 'MK9012MERCHFMICGDBLACKFS-6256739712E26', '669944895489', 'MK9012MERCHFMICGDBLACKFS', '100', '37.50', '3750', '150.00', '15000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(45, '45', 'MK9 013MERCHSPOJUGWHITEFS-6256739713D52', '968946069589', 'MK9 013MERCHSPOJUGWHITEFS', '48', '65.00', '3120', '250.00', '12000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(46, '46', 'MK9 013MERCHSPOJUGSILVERFS-6256739714D02', '823244491743', 'MK9 013MERCHSPOJUGSILVERFS', '44', '65.00', '2860', '250.00', '11000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(47, '47', 'MK90021MERCHCANBAGCANBAG10-6256739715BED', '164769382756', 'MK90021MERCHCANBAGCANBAG10', '118', '65.00', '7670', '150.00', '17700', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(48, '48', 'MS022MERCHTSMSBRL-6256739716C41', '960733129264', 'MS022MERCHTSMSBRL', '21', '157.00', '3297', '500.00', '10500', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(49, '49', 'MS022MERCHTSMSBRXL-62567397182CA', '042699371240', 'MS022MERCHTSMSBRXL', '10', '157.00', '1570', '500.00', '5000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(50, '50', 'MS022MERCHTSMSBR2XL-62567397198CD', '465903384435', 'MS022MERCHTSMSBR2XL', '5', '157.00', '785', '500.00', '2500', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(51, '51', 'MK9008MERCHTSSDXS-625673971B2E8', '603093634198', 'MK9008MERCHTSSDXS', '5', '157.40', '787', '350.00', '1750', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(52, '52', 'MK9008MERCHTSSDS-625673971C9FF', '317770704841', 'MK9008MERCHTSSDS', '4', '157.40', '629.6', '350.00', '1400', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(53, '53', 'MK9009MERCHTSWADS-625673971E0CF', '277624416384', 'MK9009MERCHTSWADS', '1', '350.00', '350', '123.81', '123.81', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(54, '54', 'MK9009MERCHTSWADM-625673971FC13', '466107403295', 'MK9009MERCHTSWADM', '6', '350.00', '2100', '123.81', '742.86', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(55, '55', 'MK9009MERCHTSWADL-6256739720FE5', '291156290831', 'MK9009MERCHTSWADL', '3', '350.00', '1050', '123.81', '371.43', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(56, '56', 'MK9009MERCHTSWADXL-62567397223C4', '070549738720', 'MK9009MERCHTSWADXL', '2', '350.00', '700', '123.81', '247.62', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(57, '57', 'MK9009MERCHTSWADXXL-6256739723307', '538124072215', 'MK9009MERCHTSWADXXL', '2', '350.00', '700', '123.81', '247.62', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(58, '58', 'MK9010MERCHSANDOYPSS-6256739724499', '660806621749', 'MK9010MERCHSANDOYPSS', '2', '123.81', '247.62', '350.00', '700', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(59, '59', 'MK9010MERCHSANDOYPSM-62567397255AC', '313643673607', 'MK9010MERCHSANDOYPSM', '1', '123.81', '123.81', '350.00', '350', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(60, '60', 'MK9010MERCHSANDOYPSL-62567397266B5', '796275537042', 'MK9010MERCHSANDOYPSL', '4', '123.81', '495.24', '350.00', '1400', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(61, '61', 'MK9010MERCHSANDOYPSXL-62567397277F0', '969935535812', 'MK9010MERCHSANDOYPSXL', '5', '123.81', '619.05', '350.00', '1750', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(62, '62', 'MK9010MERCHSANDOYPSXXL-62567397289C5', '799845854119', 'MK9010MERCHSANDOYPSXXL', '4', '123.81', '495.24', '350.00', '1400', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(63, '63', 'MK9011MERCHSANDOPAWSITIVES-6256739729BC7', '090173154793', 'MK9011MERCHSANDOPAWSITIVES', '2', '123.81', '247.62', '350.00', '700', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(64, '64', 'MK9011MERCHSANDOPAWSITIVEM-625673972AB0C', '709737765784', 'MK9011MERCHSANDOPAWSITIVEM', '5', '123.81', '619.05', '350.00', '1750', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(65, '65', 'MK9011MERCHSANDOPAWSITIVEL-625673972BC10', '000445190858', 'MK9011MERCHSANDOPAWSITIVEL', '1', '123.81', '123.81', '350.00', '350', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(66, '66', 'MK9011MERCHSANDOPAWSITIVEXL-625673972CD50', '455256666493', 'MK9011MERCHSANDOPAWSITIVEXL', '4', '123.81', '495.24', '350.00', '1400', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(67, '67', 'MK9011MERCHSANDOPAWSITIVEXXL-625673972DD7C', '661660666766', 'MK9011MERCHSANDOPAWSITIVEXXL', '2', '123.81', '247.62', '350.00', '700', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(68, '68', 'MK9005MERCHTSVNECKS-625673972ED53', '267201450035', 'MK9005MERCHTSVNECKS', '38', '157.40', '5981.2', '500.00', '19000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(69, '69', 'MK9005MERCHTSVNECKM-625673972FF1D', '836978213027', 'MK9005MERCHTSVNECKM', '36', '157.40', '5666.400000000001', '500.00', '18000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(70, '70', 'MK9005MERCHTSVNECKL-62567397310D9', '348261321516', 'MK9005MERCHTSVNECKL', '29', '157.40', '4564.6', '500.00', '14500', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(71, '71', 'MK9005MERCHTSVNECKXL-6256739732197', '268332374368', 'MK9005MERCHTSVNECKXL', '38', '157.40', '5981.2', '500.00', '19000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(72, '72', 'MK9006MERCHTSROUNDXS-625673973320F', '849855046474', 'MK9006MERCHTSROUNDXS', '28', '157.40', '4407.2', '500.00', '14000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(73, '73', 'MK9006MERCHTSROUNDS-62567397341B2', '163889315201', 'MK9006MERCHTSROUNDS', '6', '157.40', '944.4000000000001', '500.00', '3000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(74, '74', 'MK9006MERCHTSROUNDM-6256739735494', '545199272285', 'MK9006MERCHTSROUNDM', '33', '157.40', '5194.2', '500.00', '16500', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(75, '75', 'MK9006MERCHTSROUNDL-6256739736615', '678267141100', 'MK9006MERCHTSROUNDL', '29', '157.40', '4564.6', '500.00', '14500', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(76, '76', 'MK9006MERCHTSROUNDXL-62567397377C4', '551309602225', 'MK9006MERCHTSROUNDXL', '24', '157.40', '3777.6000000000004', '500.00', '12000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(77, '77', 'MK9006MERCHTSROUND2XL-6256739738A69', '619058165690', 'MK9006MERCHTSROUND2XL', '2', '157.40', '314.8', '500.00', '1000', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(78, '78', 'MK9007MERCHTSICGDXS-6256739739E29', '704992641756', 'MK9007MERCHTSICGDXS', '19', '157.40', '2990.6', '350.00', '6650', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(79, '79', 'MK9007MERCHTSICGDS-625673973B0CB', '833259988634', 'MK9007MERCHTSICGDS', '19', '157.40', '2990.6', '350.00', '6650', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(80, '80', 'MK9007MERCHTSICGDM-625673973C120', '181222203997', 'MK9007MERCHTSICGDM', '10', '157.40', '1574', '350.00', '3500', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(81, '81', 'MK9007MERCHTSICGDL-625673973D348', '827093288321', 'MK9007MERCHTSICGDL', '5', '157.40', '787', '350.00', '1750', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(82, '82', 'MK9007MERCHTSICGDXL-625673973E344', '398071086767', 'MK9007MERCHTSICGDXL', '7', '157.40', '1101.8', '350.00', '2450', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(83, '83', 'MK9007MERCHTSICGD2XL-625673973F2AE', '347071073154', 'MK9007MERCHTSICGD2XL', '38', '157.40', '5981.2', '350.00', '13300', '61a5caf447cae', '2022/04/13 14:54:15', 'restocked'),
(84, '84', 'MK9008MERCHTSSDXXL-62567419986D1', '574166262403', 'MK9008MERCHTSSDXXL', '15', '157.40', '2361', '350.00', '5250', '61a5caf447cae', '2022/04/13 14:56:25', 'restocked'),
(85, '85', 'MK9015MERCHMCBLACK&WHITEFS-625674BA17968', '478607429771', 'MK9015MERCHMCBLACK&WHITEFS', '82', '85.00', '6970', '200.00', '16400', '61a5caf447cae', '2022/04/13 14:59:06', 'restocked'),
(86, '86', 'MK9014MERCHUMBWHITEFS-62567519F0EAF', '369348302449', 'MK9014MERCHUMBWHITEFS', '37', '100.00', '3700', '200.00', '7400', '61a5caf447cae', '2022/04/13 15:00:41', 'restocked'),
(87, '87', 'IFGD024MERCHFMIFGDWHITEFREE SIZE-62567C27BB255', '009841685129', 'IFGD024MERCHFMIFGDWHITEFREE SIZE', '40', '37.50', '1500', '150.00', '6000', '61a5caf447cae', '2022/04/13 15:30:47', 'restocked'),
(88, '88', 'IFGD024MERCHFMIFGDBLACKFREE SIZE-62567C27BC7B9', '569999405760', 'IFGD024MERCHFMIFGDBLACKFREE SIZE', '30', '37.50', '1125', '150.00', '4500', '61a5caf447cae', '2022/04/13 15:30:47', 'restocked'),
(89, '89', 'MK9023MERCHTSICGDTDXS-625685560E540', '211290277824', 'MK9023MERCHTSICGDTDXS', '10', '157.40', '1574', '350.00', '3500', '61a5caf447cae', '2022/04/13 16:09:58', 'restocked'),
(90, '90', 'MK9023MERCHTSICGDTDS-625685561C6B8', '048382164970', 'MK9023MERCHTSICGDTDS', '13', '157.40', '2046.2', '350.00', '4550', '61a5caf447cae', '2022/04/13 16:09:58', 'restocked'),
(91, '91', 'MK9023MERCHTSICGDTDM-625685561D992', '948715985404', 'MK9023MERCHTSICGDTDM', '9', '157.40', '1416.6000000000001', '350.00', '3150', '61a5caf447cae', '2022/04/13 16:09:58', 'restocked'),
(92, '92', 'MK9023MERCHTSICGDTDL-625685561EE27', '405236586071', 'MK9023MERCHTSICGDTDL', '2', '157.40', '314.8', '350.00', '700', '61a5caf447cae', '2022/04/13 16:09:58', 'restocked'),
(93, '93', 'MK9023MERCHTSICGDTDXL-625685562020C', '214511744193', 'MK9023MERCHTSICGDTDXL', '11', '157.40', '1731.4', '350.00', '3850', '61a5caf447cae', '2022/04/13 16:09:58', 'restocked'),
(94, '94', 'MK9023MERCHTSICGDTDXXL-6256855621476', '769702833908', 'MK9023MERCHTSICGDTDXXL', '7', '160.40', '1122.8', '351.00', '2457', '61a5caf447cae', '2022/04/13 16:09:58', 'restocked'),
(112, '11', 'SCB003DSPRMSCB150G-625F819EE8296', '460191712132', 'SCB003DSPRMSCB150G', '80', '28.50', '2280', '150.00', '12000', '624252639e2e5', '2022/04/20 11:44:30', 'released'),
(121, '4', 'AF627141AA850FE', NULL, NULL, '1', '31.00', '31', '150.00', '150', NULL, '2022/05/03 22:52:26', 'discount'),
(122, '5', 'AF6273EADD1347D', NULL, NULL, '1', NULL, NULL, '100', '100', NULL, '2022/05/05 23:18:53', 'discount'),
(129, '9', NULL, '673068742688', 'SDN001DFPRMORIG500G', '10', '79.80', '798', '200', '2000', '61a5caf447cae', '2022/05/06 00:49:44', 'released'),
(130, '9', NULL, '673068742688', 'SDN001DFPRMORIG500G', '10', '79.80', '798', '0', '0', '61a5caf447cae', '2022/05/06 00:49:44', 'discount'),
(131, '5', NULL, '610840330961', 'SDS002DSPRMORIG150 G', '10', '31.00', '310', '150.00', '1500', '61a5caf447cae', '2022/05/12 07:24:17', 'released'),
(132, '5', NULL, '610840330961', 'SDS002DSPRMORIG150 G', '10', '31.00', '310', '0', '0', '61a5caf447cae', '2022/05/12 07:24:17', 'discount'),
(133, '7', NULL, '295065421248', 'SDS002DSPRMAC150 G', '60', '31.00', '1860', '150.00', '9000', '61a5caf447cae', '2022/05/12 07:38:35', 'released'),
(134, '7', NULL, '295065421248', 'SDS002DSPRMAC150 G', '60', '31.00', '1860', '15', '900', '61a5caf447cae', '2022/05/12 07:38:35', 'discount'),
(135, '2', NULL, '577207308284', 'SHS004HSPRMPINK150G', '100', '31', '3100', '150', '15000', '61a5caf447cae', '2022/05/12 12:43:39', 'released'),
(136, '2', NULL, '577207308284', 'SHS004HSPRMPINK150G', '100', '31', '3100', '0', '0', '61a5caf447cae', '2022/05/12 12:43:39', 'discount'),
(137, '2', NULL, '577207308284', 'SHS004HSPRMPINK150G', '80', '31', '2480', '150', '12000', '61a5caf447cae', '2022/05/12 12:44:36', 'released'),
(138, '2', NULL, '577207308284', 'SHS004HSPRMPINK150G', '80', '31', '2480', '0', '0', '61a5caf447cae', '2022/05/12 12:44:36', 'discount');

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `ID` int(11) NOT NULL,
  `OrderNo` varchar(255) DEFAULT NULL,
  `Date` varchar(255) DEFAULT NULL,
  `DateCreation` varchar(255) DEFAULT NULL,
  `BillToClientNo` varchar(255) DEFAULT NULL,
  `ShipToClientNo` varchar(255) DEFAULT NULL,
  `DateDelivery` varchar(32) DEFAULT NULL,
  `MarkDateInvoicing` varchar(32) DEFAULT NULL,
  `MarkDateDelivery` varchar(32) DEFAULT NULL,
  `MarkDateDelivered` varchar(32) DEFAULT NULL,
  `MarkDateReceived` varchar(32) DEFAULT NULL,
  `discountOutright` int(11) DEFAULT 0,
  `discountVolume` int(11) DEFAULT 0,
  `discountPBD` int(11) DEFAULT 0,
  `discountManpower` int(11) DEFAULT 0,
  `TotalRemainingPayment` varchar(32) DEFAULT '0',
  `Remarks` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL COMMENT '0=rejected;1=for approval;2=approved/for invoicing;3=for delivery;4=delivered;5=fulfilled/received;'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`ID`, `OrderNo`, `Date`, `DateCreation`, `BillToClientNo`, `ShipToClientNo`, `DateDelivery`, `MarkDateInvoicing`, `MarkDateDelivery`, `MarkDateDelivered`, `MarkDateReceived`, `discountOutright`, `discountVolume`, `discountPBD`, `discountManpower`, `TotalRemainingPayment`, `Remarks`, `Status`) VALUES
(15, 'SO6273EA988E0D1', '2022-05-05 23:14:00', '2022-05-05 23:17:44', 'C626CE0D8DADE3', 'C626CE0D8DADE3', '2022-05-06', '2022-05-05 23:18:40', '2022-05-06 00:48:45', '2022-05-06 00:48:50', NULL, 0, 0, 0, 0, '8200', '', 4),
(18, '1', '2022-05-17 20:32:00', '2022-05-17 20:32:44', 'C626CE0D8DADE3', 'C626CE0D8DADE3', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, '10335', NULL, 1),
(19, 'MK9-22-0000002', '2022-05-17 20:32:00', '2022-05-17 20:33:24', 'C626CE0D8DADE3', 'C626CE0D8DADE3', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, '1650', NULL, 1),
(20, 'MK9-22-0000004', '2022-05-17 20:33:00', '2022-05-17 20:34:11', 'C626CE0D8DADE3', 'C626CE0D8DADE3', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, '1500', NULL, 1);

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
(4262, NULL, 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-04-29 09:43:43 AM'),
(4263, NULL, 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-04-29 09:43:49 AM'),
(4264, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-04-29 09:43:49 AM'),
(4265, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trash_bin', '2022-04-29 09:43:52 AM'),
(4266, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trash_bin', '2022-04-29 09:44:37 AM'),
(4267, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trash_bin', '2022-04-29 09:45:19 AM'),
(4268, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trash_bin', '2022-04-29 09:47:48 AM'),
(4269, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trash_bin', '2022-04-29 09:48:49 AM'),
(4270, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trash_bin', '2022-04-29 09:49:53 AM'),
(4271, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trash_bin', '2022-04-29 09:51:13 AM'),
(4272, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trash_bin', '2022-04-29 09:51:38 AM'),
(4273, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trash_bin', '2022-04-29 09:58:08 AM'),
(4274, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trash_bin', '2022-04-30 02:44:30 PM'),
(4275, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-04-30 02:44:31 PM'),
(4276, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-04-30 02:44:34 PM'),
(4277, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-04-30 02:44:35 PM'),
(4278, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-04-30 02:46:49 PM'),
(4279, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-04-30 02:47:48 PM'),
(4280, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-04-30 02:51:05 PM'),
(4281, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-04-30 02:51:41 PM'),
(4282, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-04-30 02:51:42 PM'),
(4283, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-04-30 02:51:44 PM'),
(4284, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-04-30 02:52:00 PM'),
(4285, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 02:53:12 PM'),
(4286, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:08:52 PM'),
(4287, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-04-30 03:10:16 PM'),
(4288, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:10:17 PM'),
(4289, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 03:10:20 PM'),
(4290, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 03:10:54 PM'),
(4291, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-30 03:11:44 PM'),
(4292, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addAccount', '2022-04-30 03:11:59 PM'),
(4293, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-30 03:11:59 PM'),
(4294, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 03:12:04 PM'),
(4295, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 03:12:06 PM'),
(4296, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 03:13:51 PM'),
(4297, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 03:16:19 PM'),
(4298, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 03:19:46 PM'),
(4299, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 03:19:55 PM'),
(4300, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 03:20:02 PM'),
(4301, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-30 03:20:04 PM'),
(4302, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 03:20:06 PM'),
(4303, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 03:20:12 PM'),
(4304, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 03:20:21 PM'),
(4305, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:23:06 PM'),
(4306, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:28:10 PM'),
(4307, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:28:15 PM'),
(4308, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:29:00 PM'),
(4309, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:30:40 PM'),
(4310, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:37:06 PM'),
(4311, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:41:05 PM'),
(4312, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:43:46 PM'),
(4313, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:44:09 PM'),
(4314, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:56:17 PM'),
(4315, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:57:02 PM'),
(4316, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:57:42 PM'),
(4317, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:58:16 PM'),
(4318, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 03:59:47 PM'),
(4319, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:01:03 PM'),
(4320, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-04-30 04:02:36 PM'),
(4321, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-04-30 04:02:37 PM'),
(4322, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:02:38 PM'),
(4323, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:02:50 PM'),
(4324, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:04:09 PM'),
(4325, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:05:42 PM'),
(4326, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:06:49 PM'),
(4327, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:07:32 PM'),
(4328, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:08:11 PM'),
(4329, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:08:28 PM'),
(4330, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:09:44 PM'),
(4331, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:10:37 PM'),
(4332, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:12:14 PM'),
(4333, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:12:52 PM'),
(4334, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:13:19 PM'),
(4335, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:13:45 PM'),
(4336, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:14:46 PM'),
(4337, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:15:21 PM'),
(4338, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:16:45 PM'),
(4339, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:18:17 PM'),
(4340, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:20:07 PM'),
(4341, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:22:09 PM'),
(4342, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:22:52 PM'),
(4343, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:22:59 PM'),
(4344, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:23:51 PM'),
(4345, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-04-30 04:24:13 PM'),
(4346, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:24:14 PM'),
(4347, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-04-30 04:24:43 PM'),
(4348, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:24:44 PM'),
(4349, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:31:19 PM'),
(4350, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-04-30 04:31:34 PM'),
(4351, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:31:35 PM'),
(4352, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-04-30 04:32:01 PM'),
(4353, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:32:02 PM'),
(4354, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:32:50 PM'),
(4355, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:33:47 PM'),
(4356, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-04-30 04:34:46 PM'),
(4357, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:34:48 PM'),
(4358, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 04:34:49 PM'),
(4359, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 04:34:50 PM'),
(4360, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:34:51 PM'),
(4361, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 04:34:53 PM'),
(4362, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 04:40:47 PM'),
(4363, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 04:40:49 PM'),
(4364, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 05:01:27 PM'),
(4365, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 05:03:41 PM'),
(4366, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:07:31 PM'),
(4367, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:08:48 PM'),
(4368, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:19:17 PM'),
(4369, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:31:02 PM'),
(4370, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:31:33 PM'),
(4371, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:33:11 PM'),
(4372, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:33:21 PM'),
(4373, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 05:33:35 PM'),
(4374, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 05:33:38 PM'),
(4375, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-30 05:33:40 PM'),
(4376, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 05:33:43 PM'),
(4377, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 05:33:44 PM'),
(4378, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 05:33:44 PM'),
(4379, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:34:13 PM'),
(4380, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:34:29 PM'),
(4381, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:34:41 PM'),
(4382, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 05:34:53 PM'),
(4383, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:39:49 PM'),
(4384, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:40:04 PM'),
(4385, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 05:40:09 PM'),
(4386, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:40:11 PM'),
(4387, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:46:14 PM'),
(4388, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:47:04 PM'),
(4389, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 05:47:38 PM'),
(4390, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:47:43 PM'),
(4391, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 05:47:49 PM'),
(4392, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 05:51:08 PM'),
(4393, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:51:09 PM'),
(4394, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:52:46 PM'),
(4395, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:53:14 PM'),
(4396, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:57:26 PM'),
(4397, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 05:58:06 PM'),
(4398, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 06:04:18 PM'),
(4399, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 06:04:26 PM'),
(4400, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:04:28 PM'),
(4401, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:05:06 PM'),
(4402, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:05:47 PM'),
(4403, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 06:08:16 PM'),
(4404, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:08:53 PM'),
(4405, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:09:27 PM'),
(4406, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:09:37 PM'),
(4407, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:10:24 PM'),
(4408, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:13:26 PM'),
(4409, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:13:58 PM'),
(4410, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:14:08 PM'),
(4411, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 06:21:37 PM'),
(4412, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:21:39 PM'),
(4413, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:21:51 PM'),
(4414, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:22:09 PM'),
(4415, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:22:14 PM'),
(4416, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:22:44 PM'),
(4417, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:23:10 PM'),
(4418, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:23:42 PM'),
(4419, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:25:02 PM'),
(4420, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:25:53 PM'),
(4421, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:34:11 PM'),
(4422, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOAdtlFee', '2022-04-30 06:34:28 PM'),
(4423, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 06:34:28 PM'),
(4424, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:34:32 PM'),
(4425, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:35:09 PM'),
(4426, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:35:21 PM'),
(4427, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/FORM_removeSOAdtlFee', '2022-04-30 06:35:47 PM'),
(4428, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 06:35:49 PM'),
(4429, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:35:52 PM'),
(4430, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:36:42 PM'),
(4431, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOAdtlFee', '2022-04-30 06:37:04 PM'),
(4432, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-30 06:37:05 PM'),
(4433, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:37:09 PM'),
(4434, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:41:57 PM'),
(4435, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:42:36 PM'),
(4436, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:51:43 PM'),
(4437, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:52:11 PM'),
(4438, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:52:36 PM'),
(4439, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:54:11 PM'),
(4440, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:54:38 PM'),
(4441, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:54:54 PM'),
(4442, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:55:33 PM'),
(4443, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:55:56 PM'),
(4444, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:56:28 PM'),
(4445, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:58:11 PM'),
(4446, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:58:29 PM'),
(4447, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:58:49 PM'),
(4448, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:59:44 PM'),
(4449, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 06:59:53 PM'),
(4450, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-30 07:00:04 PM'),
(4451, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-30 07:00:14 PM'),
(4452, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-04-30 07:00:15 PM'),
(4453, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2022-04-30 07:00:38 PM'),
(4454, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-04-30 07:00:40 PM'),
(4455, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-30 07:00:45 PM'),
(4456, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-04-30 07:00:46 PM'),
(4457, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-30 07:00:48 PM'),
(4458, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-04-30 07:00:49 PM'),
(4459, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-30 07:04:04 PM'),
(4460, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-04-30 07:04:05 PM'),
(4461, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addPOBill', '2022-04-30 07:04:12 PM'),
(4462, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-04-30 07:04:13 PM'),
(4463, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-30 07:04:22 PM'),
(4464, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-04-30 07:04:23 PM'),
(4465, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-04-30 07:04:43 PM'),
(4466, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-04-30 07:05:32 PM'),
(4467, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-04-30 07:05:48 PM'),
(4468, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-04-30 07:05:58 PM'),
(4469, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-04-30 07:06:08 PM'),
(4470, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-30 07:12:59 PM'),
(4471, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-30 07:13:03 PM'),
(4472, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-30 07:13:11 PM'),
(4473, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-30 10:18:58 PM'),
(4474, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-04-30 10:18:59 PM'),
(4475, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-04-30 10:19:01 PM'),
(4476, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-04-30 10:19:01 PM'),
(4477, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-30 10:19:04 PM'),
(4478, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-30 10:19:07 PM'),
(4479, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 11:27:33 AM'),
(4480, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-01 11:27:34 AM'),
(4481, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-01 11:27:40 AM'),
(4482, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-01 11:27:41 AM'),
(4483, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-01 11:27:45 AM'),
(4484, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-01 08:56:56 PM'),
(4485, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-01 08:57:01 PM'),
(4486, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-01 08:57:01 PM'),
(4487, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-01 09:17:10 PM'),
(4488, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 09:17:14 PM'),
(4489, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 09:35:06 PM'),
(4490, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 09:48:21 PM'),
(4491, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 09:48:24 PM'),
(4492, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-01 10:30:30 PM'),
(4493, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-01 10:30:30 PM'),
(4494, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-05-01 10:30:33 PM'),
(4495, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trash_bin', '2022-05-01 10:38:01 PM'),
(4496, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-05-01 10:46:25 PM'),
(4497, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-01 10:46:26 PM'),
(4498, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 10:46:27 PM'),
(4499, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 10:46:58 PM'),
(4500, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 10:47:15 PM'),
(4501, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 10:48:34 PM'),
(4502, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 10:49:04 PM'),
(4503, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 10:49:27 PM'),
(4504, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 10:49:41 PM'),
(4505, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-01 10:50:24 PM'),
(4506, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 10:50:38 PM'),
(4507, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-01 10:50:41 PM'),
(4508, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 10:50:47 PM'),
(4509, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-01 10:50:48 PM'),
(4510, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 10:50:54 PM'),
(4511, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 11:14:32 PM'),
(4512, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 11:15:47 PM'),
(4513, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 11:16:00 PM'),
(4514, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 11:16:06 PM'),
(4515, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-01 11:17:36 PM'),
(4516, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-03 03:31:02 PM'),
(4517, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-03 03:31:27 PM'),
(4518, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-03 03:31:28 PM'),
(4519, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 03:31:52 PM'),
(4520, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 03:33:03 PM'),
(4521, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 03:41:48 PM'),
(4522, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 03:42:59 PM'),
(4523, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 03:44:14 PM'),
(4524, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 03:44:54 PM'),
(4525, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 04:14:10 PM'),
(4526, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 04:15:38 PM'),
(4527, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 04:15:48 PM'),
(4528, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 04:15:53 PM'),
(4529, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:16:25 PM'),
(4530, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:16:26 PM'),
(4531, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addAccount', '2022-05-03 04:31:12 PM'),
(4532, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:14 PM'),
(4533, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addAccount', '2022-05-03 04:31:23 PM'),
(4534, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:23 PM'),
(4535, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addAccount', '2022-05-03 04:31:34 PM'),
(4536, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:34 PM'),
(4537, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addAccount', '2022-05-03 04:31:40 PM'),
(4538, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:40 PM'),
(4539, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addAccount', '2022-05-03 04:31:46 PM'),
(4540, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:46 PM'),
(4541, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addAccount', '2022-05-03 04:31:52 PM'),
(4542, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:52 PM'),
(4543, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addAccount', '2022-05-03 04:31:58 PM'),
(4544, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:31:58 PM'),
(4545, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addAccount', '2022-05-03 04:32:07 PM'),
(4546, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:32:08 PM'),
(4547, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addAccount', '2022-05-03 04:32:20 PM'),
(4548, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:32:21 PM'),
(4549, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateAccount', '2022-05-03 04:32:30 PM'),
(4550, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:32:32 PM'),
(4551, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateAccount', '2022-05-03 04:32:38 PM'),
(4552, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:32:38 PM'),
(4553, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateAccount', '2022-05-03 04:32:56 PM'),
(4554, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:32:57 PM'),
(4555, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateAccount', '2022-05-03 04:33:01 PM'),
(4556, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:33:02 PM'),
(4557, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:33:25 PM'),
(4558, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateAccount', '2022-05-03 04:33:35 PM'),
(4559, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:33:36 PM'),
(4560, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateAccount', '2022-05-03 04:33:56 PM'),
(4561, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:33:57 PM'),
(4562, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateAccount', '2022-05-03 04:34:24 PM'),
(4563, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:34:24 PM'),
(4564, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:34:39 PM'),
(4565, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addJournal', '2022-05-03 04:36:51 PM'),
(4566, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:36:52 PM'),
(4567, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addJournal', '2022-05-03 04:37:24 PM'),
(4568, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:37:25 PM'),
(4569, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addJournal', '2022-05-03 04:38:01 PM'),
(4570, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:38:02 PM'),
(4571, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addJournal', '2022-05-03 04:38:15 PM'),
(4572, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:38:16 PM'),
(4573, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addJournal', '2022-05-03 04:38:29 PM'),
(4574, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:38:29 PM'),
(4575, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addJournal', '2022-05-03 04:38:53 PM'),
(4576, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-05-03 04:38:54 PM'),
(4577, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 04:39:06 PM'),
(4578, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 04:39:10 PM'),
(4579, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 04:39:30 PM'),
(4580, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 04:47:21 PM'),
(4581, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 04:49:09 PM'),
(4582, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 04:51:10 PM'),
(4583, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 04:53:49 PM'),
(4584, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 04:54:35 PM');
INSERT INTO `security_log` (`ID`, `UserID`, `Agent`, `Platform`, `IPAddress`, `Country`, `PageURL`, `DateAdded`) VALUES
(4585, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 04:58:37 PM'),
(4586, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-03 05:59:12 PM'),
(4587, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 05:59:14 PM'),
(4588, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-03 05:59:20 PM'),
(4589, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 05:59:22 PM'),
(4590, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-03 05:59:56 PM'),
(4591, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-03 05:59:57 PM'),
(4592, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-03 06:00:00 PM'),
(4593, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-03 06:00:02 PM'),
(4594, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-03 06:23:21 PM'),
(4595, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 06:23:26 PM'),
(4596, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/FORM_removeSOAdtlFee', '2022-05-03 06:24:31 PM'),
(4597, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 06:24:31 PM'),
(4598, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-03 06:27:32 PM'),
(4599, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-03 06:27:34 PM'),
(4600, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewManualTransaction', '2022-05-03 06:27:54 PM'),
(4601, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-03 06:27:55 PM'),
(4602, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/FORM_removeManualTransaction', '2022-05-03 06:31:25 PM'),
(4603, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-03 06:31:26 PM'),
(4604, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewManualTransaction', '2022-05-03 06:37:42 PM'),
(4605, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-03 06:37:42 PM'),
(4606, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewManualTransaction', '2022-05-03 06:39:48 PM'),
(4607, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-03 06:39:48 PM'),
(4608, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-03 08:22:40 PM'),
(4609, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-03 08:26:37 PM'),
(4610, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-03 08:26:43 PM'),
(4611, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 08:28:53 PM'),
(4612, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/returns', '2022-05-03 08:29:07 PM'),
(4613, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewReturn', '2022-05-03 08:29:20 PM'),
(4614, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/returns', '2022-05-03 08:29:21 PM'),
(4615, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 08:29:24 PM'),
(4616, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewReturnProduct', '2022-05-03 08:38:02 PM'),
(4617, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 08:38:03 PM'),
(4618, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 08:40:39 PM'),
(4619, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 08:41:42 PM'),
(4620, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 08:42:29 PM'),
(4621, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 08:42:59 PM'),
(4622, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 08:43:12 PM'),
(4623, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 08:44:47 PM'),
(4624, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 08:45:20 PM'),
(4625, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/FORM_removeReturnProduct', '2022-05-03 08:45:42 PM'),
(4626, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 08:45:43 PM'),
(4627, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewReturnProduct', '2022-05-03 08:46:07 PM'),
(4628, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 08:46:09 PM'),
(4629, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewReturnProduct', '2022-05-03 08:46:24 PM'),
(4630, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 08:46:25 PM'),
(4631, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewReturnProduct', '2022-05-03 08:46:39 PM'),
(4632, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 08:46:39 PM'),
(4633, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/returns', '2022-05-03 08:47:19 PM'),
(4634, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 09:01:55 PM'),
(4635, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 09:24:18 PM'),
(4636, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 09:24:21 PM'),
(4637, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 09:24:45 PM'),
(4638, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 09:24:59 PM'),
(4639, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 09:26:37 PM'),
(4640, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewReturnProduct', '2022-05-03 09:28:37 PM'),
(4641, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_return', '2022-05-03 09:28:38 PM'),
(4642, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 10:17:06 PM'),
(4643, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:17:09 PM'),
(4644, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:22:00 PM'),
(4645, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:22:09 PM'),
(4646, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:22:19 PM'),
(4647, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:22:23 PM'),
(4648, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:22:38 PM'),
(4649, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:25:05 PM'),
(4650, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:26:05 PM'),
(4651, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:26:18 PM'),
(4652, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:26:30 PM'),
(4653, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:26:38 PM'),
(4654, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:27:08 PM'),
(4655, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:27:17 PM'),
(4656, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:28:21 PM'),
(4657, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:29:12 PM'),
(4658, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:29:25 PM'),
(4659, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:34:10 PM'),
(4660, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-03 10:34:15 PM'),
(4661, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-05-03 10:34:42 PM'),
(4662, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-03 10:34:43 PM'),
(4663, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:34:45 PM'),
(4664, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_approveSalesOrder', '2022-05-03 10:35:52 PM'),
(4665, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:35:53 PM'),
(4666, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_scheduleDelivery', '2022-05-03 10:35:57 PM'),
(4667, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:35:57 PM'),
(4668, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_markDelivered', '2022-05-03 10:36:00 PM'),
(4669, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:36:01 PM'),
(4670, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-03 10:46:10 PM'),
(4671, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-05-03 10:46:33 PM'),
(4672, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-03 10:46:34 PM'),
(4673, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:46:35 PM'),
(4674, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_approveSalesOrder', '2022-05-03 10:46:39 PM'),
(4675, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:46:39 PM'),
(4676, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_scheduleDelivery', '2022-05-03 10:46:42 PM'),
(4677, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:46:42 PM'),
(4678, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_markDelivered', '2022-05-03 10:46:45 PM'),
(4679, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:46:46 PM'),
(4680, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_markReceived', '2022-05-03 10:46:50 PM'),
(4681, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:46:50 PM'),
(4682, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-05-03 10:48:50 PM'),
(4683, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-03 10:49:43 PM'),
(4684, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:49:46 PM'),
(4685, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:51:43 PM'),
(4686, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:51:45 PM'),
(4687, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-03 10:51:48 PM'),
(4688, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:51:50 PM'),
(4689, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOAdtlFee', '2022-05-03 10:52:26 PM'),
(4690, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:52:27 PM'),
(4691, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:52:49 PM'),
(4692, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-03 10:55:37 PM'),
(4693, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-03 10:55:46 PM'),
(4694, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:55:51 PM'),
(4695, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:56:39 PM'),
(4696, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 10:58:35 PM'),
(4697, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 11:00:21 PM'),
(4698, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 11:10:57 PM'),
(4699, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 11:13:12 PM'),
(4700, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 11:14:38 PM'),
(4701, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 11:14:52 PM'),
(4702, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 11:15:17 PM'),
(4703, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-03 11:15:39 PM'),
(4704, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-04 12:16:37 AM'),
(4705, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-04 10:18:48 PM'),
(4706, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-04 10:20:12 PM'),
(4707, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-04 10:20:13 PM'),
(4708, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-04 11:20:37 PM'),
(4709, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/clients', '2022-05-04 11:21:11 PM'),
(4710, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/clients', '2022-05-04 11:23:47 PM'),
(4711, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewClient', '2022-05-04 11:23:56 PM'),
(4712, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/clients', '2022-05-04 11:23:57 PM'),
(4713, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-04 11:24:09 PM'),
(4714, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-04 11:29:50 PM'),
(4715, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-05-04 11:30:48 PM'),
(4716, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-04 11:30:49 PM'),
(4717, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-04 11:30:52 PM'),
(4718, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-04 11:30:54 PM'),
(4719, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-05-04 11:31:20 PM'),
(4720, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-04 11:31:22 PM'),
(4721, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-04 11:31:25 PM'),
(4722, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/clients', '2022-05-04 11:31:27 PM'),
(4723, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-04 11:31:32 PM'),
(4724, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-04 11:31:37 PM'),
(4725, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-05-04 11:32:02 PM'),
(4726, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-04 11:32:03 PM'),
(4727, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-04 11:33:17 PM'),
(4728, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-04 11:34:13 PM'),
(4729, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-05-04 11:35:01 PM'),
(4730, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-05 05:38:19 PM'),
(4731, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-05 05:38:33 PM'),
(4732, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-05 05:38:34 PM'),
(4733, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 09:38:12 PM'),
(4734, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-05 09:38:13 PM'),
(4735, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-05 09:38:16 PM'),
(4736, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-05 09:38:17 PM'),
(4737, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 09:38:20 PM'),
(4738, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 09:38:24 PM'),
(4739, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2022-05-05 10:51:45 PM'),
(4740, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2022-05-05 10:51:45 PM'),
(4741, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-05 10:51:45 PM'),
(4742, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-05 10:51:47 PM'),
(4743, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-05 10:51:48 PM'),
(4744, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2022-05-05 10:55:57 PM'),
(4745, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2022-05-05 10:56:21 PM'),
(4746, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2022-05-05 10:56:22 PM'),
(4747, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 10:57:50 PM'),
(4748, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 10:58:00 PM'),
(4749, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 10:58:01 PM'),
(4750, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 10:58:01 PM'),
(4751, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 10:58:03 PM'),
(4752, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 10:58:06 PM'),
(4753, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:02:08 PM'),
(4754, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:02:16 PM'),
(4755, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:02:33 PM'),
(4756, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:03:01 PM'),
(4757, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:03:11 PM'),
(4758, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:03:55 PM'),
(4759, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:04:04 PM'),
(4760, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:04:51 PM'),
(4761, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:05:20 PM'),
(4762, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:05:20 PM'),
(4763, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:08:40 PM'),
(4764, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:08:40 PM'),
(4765, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:08:43 PM'),
(4766, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:08:43 PM'),
(4767, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:08:47 PM'),
(4768, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:08:47 PM'),
(4769, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:08:48 PM'),
(4770, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:08:49 PM'),
(4771, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:08:56 PM'),
(4772, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:08:56 PM'),
(4773, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:09:34 PM'),
(4774, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:09:35 PM'),
(4775, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:09:44 PM'),
(4776, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:10:10 PM'),
(4777, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:10:12 PM'),
(4778, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:10:12 PM'),
(4779, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:13:22 PM'),
(4780, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:13:27 PM'),
(4781, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:13:27 PM'),
(4782, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:13:31 PM'),
(4783, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:13:34 PM'),
(4784, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:13:35 PM'),
(4785, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:13:37 PM'),
(4786, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:13:39 PM'),
(4787, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:13:42 PM'),
(4788, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:13:50 PM'),
(4789, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:13:53 PM'),
(4790, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:13:54 PM'),
(4791, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:13:56 PM'),
(4792, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:13:58 PM'),
(4793, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:14:00 PM'),
(4794, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:02 PM'),
(4795, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:14:04 PM'),
(4796, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:14:06 PM'),
(4797, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:08 PM'),
(4798, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:14:10 PM'),
(4799, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:14:12 PM'),
(4800, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:15 PM'),
(4801, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:14:18 PM'),
(4802, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:14:19 PM'),
(4803, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:20 PM'),
(4804, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:14:23 PM'),
(4805, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:14:25 PM'),
(4806, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:26 PM'),
(4807, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:14:29 PM'),
(4808, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:14:30 PM'),
(4809, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:31 PM'),
(4810, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:14:33 PM'),
(4811, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:14:35 PM'),
(4812, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:37 PM'),
(4813, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:14:40 PM'),
(4814, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:14:41 PM'),
(4815, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:43 PM'),
(4816, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:14:45 PM'),
(4817, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:14:46 PM'),
(4818, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:14:48 PM'),
(4819, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-05 11:14:50 PM'),
(4820, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:14:56 PM'),
(4821, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-05-05 11:17:44 PM'),
(4822, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:17:45 PM'),
(4823, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:17:48 PM'),
(4824, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_approveSalesOrder', '2022-05-05 11:18:39 PM'),
(4825, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:18:40 PM'),
(4826, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOAdtlFee', '2022-05-05 11:18:52 PM'),
(4827, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:18:53 PM'),
(4828, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:24:49 PM'),
(4829, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:26:34 PM'),
(4830, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:26:35 PM'),
(4831, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:26:39 PM'),
(4832, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:26:41 PM'),
(4833, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewReplacement', '2022-05-05 11:27:15 PM'),
(4834, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:27:16 PM'),
(4835, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_approveReplacement', '2022-05-05 11:27:20 PM'),
(4836, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:27:20 PM'),
(4837, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/FORM_removeReplacement', '2022-05-05 11:27:25 PM'),
(4838, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:27:26 PM'),
(4839, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:45:39 PM'),
(4840, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:53:52 PM'),
(4841, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2022-05-05 11:53:56 PM'),
(4842, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2022-05-05 11:54:03 PM'),
(4843, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2022-05-05 11:54:04 PM'),
(4844, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-05 11:54:04 PM'),
(4845, NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-05 11:54:05 PM'),
(4846, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-05 11:54:05 PM'),
(4847, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-05 11:54:10 PM'),
(4848, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:54:12 PM'),
(4849, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:55:22 PM'),
(4850, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:55:27 PM'),
(4851, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:55:29 PM'),
(4852, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_removeSOTransaction', '2022-05-05 11:55:32 PM'),
(4853, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:55:32 PM'),
(4854, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_removeSOTransaction', '2022-05-05 11:56:08 PM'),
(4855, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:56:09 PM'),
(4856, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_removeSOTransaction', '2022-05-05 11:56:44 PM'),
(4857, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-05 11:56:45 PM'),
(4858, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-06 12:16:19 AM'),
(4859, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-06 12:18:55 AM'),
(4860, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-06 12:43:06 AM'),
(4861, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOTransaction', '2022-05-06 12:43:13 AM'),
(4862, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-06 12:43:14 AM'),
(4863, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-06 12:47:39 AM'),
(4864, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOTransaction', '2022-05-06 12:47:49 AM'),
(4865, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-06 12:47:49 AM'),
(4866, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOTransaction', '2022-05-06 12:48:08 AM'),
(4867, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-06 12:48:10 AM'),
(4868, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_removeSOTransaction', '2022-05-06 12:48:37 AM'),
(4869, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-06 12:48:38 AM'),
(4870, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_scheduleDelivery', '2022-05-06 12:48:44 AM'),
(4871, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-06 12:48:45 AM'),
(4872, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_markDelivered', '2022-05-06 12:48:49 AM'),
(4873, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-06 12:48:50 AM'),
(4874, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-05-06 12:49:06 AM'),
(4875, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-06 12:49:19 AM'),
(4876, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-06 12:49:28 AM'),
(4877, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOTransaction', '2022-05-06 12:49:44 AM'),
(4878, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-06 12:49:46 AM'),
(4879, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-05-06 12:50:03 AM'),
(4880, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2022-05-06 12:50:20 AM'),
(4881, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-05-06 12:50:42 AM'),
(4882, NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-10 09:42:57 PM'),
(4883, NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-10 09:43:10 PM'),
(4884, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-10 09:43:11 PM'),
(4885, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:13:05 PM'),
(4886, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trial_balance', '2022-05-10 11:13:13 PM'),
(4887, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:13:20 PM'),
(4888, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-05-10 11:13:23 PM'),
(4889, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:13:27 PM'),
(4890, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:26:28 PM'),
(4891, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-10 11:26:31 PM'),
(4892, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:38:33 PM'),
(4893, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trial_balance', '2022-05-10 11:38:35 PM'),
(4894, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trial_balance', '2022-05-10 11:38:39 PM'),
(4895, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trial_balance', '2022-05-10 11:38:46 PM'),
(4896, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:38:47 PM'),
(4897, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-10 11:38:49 PM'),
(4898, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:38:54 PM'),
(4899, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trial_balance', '2022-05-10 11:38:58 PM'),
(4900, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:38:59 PM'),
(4901, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-10 11:43:43 PM'),
(4902, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:43:45 PM'),
(4903, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-10 11:43:47 PM'),
(4904, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:43:49 PM'),
(4905, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-10 11:43:58 PM'),
(4906, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:44:01 PM');
INSERT INTO `security_log` (`ID`, `UserID`, `Agent`, `Platform`, `IPAddress`, `Country`, `PageURL`, `DateAdded`) VALUES
(4907, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-10 11:44:03 PM'),
(4908, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:44:16 PM'),
(4909, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:47:16 PM'),
(4910, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trial_balance', '2022-05-10 11:47:23 PM'),
(4911, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-10 11:47:25 PM'),
(4912, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trial_balance', '2022-05-10 11:47:28 PM'),
(4913, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trial_balance', '2022-05-10 11:47:58 PM'),
(4914, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 12:10:17 AM'),
(4915, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 12:10:45 AM'),
(4916, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 12:19:12 AM'),
(4917, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 12:22:52 AM'),
(4918, NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 06:51:56 AM'),
(4919, NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-11 06:51:56 AM'),
(4920, NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-11 07:03:02 AM'),
(4921, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-11 07:03:03 AM'),
(4922, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:04:08 AM'),
(4923, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:04:11 AM'),
(4924, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:20:21 AM'),
(4925, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:20:30 AM'),
(4926, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:21:08 AM'),
(4927, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:21:10 AM'),
(4928, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:21:18 AM'),
(4929, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:21:36 AM'),
(4930, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:21:41 AM'),
(4931, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:21:48 AM'),
(4932, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:22:06 AM'),
(4933, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:22:09 AM'),
(4934, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:22:39 AM'),
(4935, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:22:56 AM'),
(4936, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:23:05 AM'),
(4937, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:23:37 AM'),
(4938, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-11 07:23:42 AM'),
(4939, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-05-11 07:23:43 AM'),
(4940, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:24:00 AM'),
(4941, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:24:03 AM'),
(4942, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:24:25 AM'),
(4943, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:24:29 AM'),
(4944, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:24:32 AM'),
(4945, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:24:33 AM'),
(4946, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:24:43 AM'),
(4947, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:24:52 AM'),
(4948, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:24:54 AM'),
(4949, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:25:27 AM'),
(4950, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:25:59 AM'),
(4951, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:26:13 AM'),
(4952, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:26:30 AM'),
(4953, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:26:32 AM'),
(4954, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:26:35 AM'),
(4955, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:26:39 AM'),
(4956, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:27:21 AM'),
(4957, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:27:34 AM'),
(4958, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:27:44 AM'),
(4959, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:28:02 AM'),
(4960, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:29:30 AM'),
(4961, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:32:27 AM'),
(4962, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-05-11 07:32:30 AM'),
(4963, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-05-11 07:39:30 AM'),
(4964, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:39:32 AM'),
(4965, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:39:35 AM'),
(4966, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:39:56 AM'),
(4967, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:40:16 AM'),
(4968, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:43:05 AM'),
(4969, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:46:59 AM'),
(4970, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:47:37 AM'),
(4971, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:47:48 AM'),
(4972, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:48:33 AM'),
(4973, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:50:43 AM'),
(4974, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:51:35 AM'),
(4975, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:51:39 AM'),
(4976, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:51:41 AM'),
(4977, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:51:47 AM'),
(4978, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:51:49 AM'),
(4979, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:51:51 AM'),
(4980, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:51:53 AM'),
(4981, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-11 07:51:55 AM'),
(4982, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:52:25 AM'),
(4983, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:52:32 AM'),
(4984, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:52:45 AM'),
(4985, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:53:33 AM'),
(4986, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:53:36 AM'),
(4987, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:53:44 AM'),
(4988, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:53:49 AM'),
(4989, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:54:32 AM'),
(4990, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:54:36 AM'),
(4991, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:54:38 AM'),
(4992, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:54:40 AM'),
(4993, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:58:20 AM'),
(4994, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:58:24 AM'),
(4995, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:58:25 AM'),
(4996, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:58:27 AM'),
(4997, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:58:29 AM'),
(4998, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:58:30 AM'),
(4999, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:58:32 AM'),
(5000, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts_summary', '2022-05-11 07:58:33 AM'),
(5001, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-11 07:59:16 AM'),
(5002, NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-12 06:25:54 AM'),
(5003, NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-12 06:45:40 AM'),
(5004, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-12 06:45:40 AM'),
(5005, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 06:46:27 AM'),
(5006, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 06:46:28 AM'),
(5007, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 07:00:31 AM'),
(5008, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:16:14 AM'),
(5009, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_removeSOTransaction', '2022-05-12 07:16:29 AM'),
(5010, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:16:30 AM'),
(5011, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 07:16:32 AM'),
(5012, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:19:30 AM'),
(5013, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_removeSOTransaction', '2022-05-12 07:19:36 AM'),
(5014, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:19:37 AM'),
(5015, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 07:19:41 AM'),
(5016, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:19:43 AM'),
(5017, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:23:00 AM'),
(5018, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 07:23:12 AM'),
(5019, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 07:23:49 AM'),
(5020, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:24:01 AM'),
(5021, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOTransaction', '2022-05-12 07:24:17 AM'),
(5022, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:24:18 AM'),
(5023, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 07:24:21 AM'),
(5024, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:38:18 AM'),
(5025, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOTransaction', '2022-05-12 07:38:35 AM'),
(5026, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:38:36 AM'),
(5027, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 07:38:40 AM'),
(5028, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:38:42 AM'),
(5029, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_removeSOTransaction', '2022-05-12 07:39:00 AM'),
(5030, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:39:00 AM'),
(5031, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_removeSOTransaction', '2022-05-12 07:39:03 AM'),
(5032, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:39:04 AM'),
(5033, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 07:39:16 AM'),
(5034, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:39:18 AM'),
(5035, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 07:39:26 AM'),
(5036, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:39:29 AM'),
(5037, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 07:40:44 AM'),
(5038, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:40:46 AM'),
(5039, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_updateSORemarks', '2022-05-12 07:40:48 AM'),
(5040, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 07:40:49 AM'),
(5041, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 07:40:50 AM'),
(5042, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 08:29:03 AM'),
(5043, NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/', '2022-05-12 12:42:16 PM'),
(5044, NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-12 12:42:20 PM'),
(5045, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-12 12:42:22 PM'),
(5046, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-12 12:42:23 PM'),
(5047, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-05-12 12:42:45 PM'),
(5048, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-05-12 12:42:48 PM'),
(5049, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 12:43:04 PM'),
(5050, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 12:43:13 PM'),
(5051, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:43:15 PM'),
(5052, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOTransaction', '2022-05-12 12:43:38 PM'),
(5053, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:43:41 PM'),
(5054, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-05-12 12:43:43 PM'),
(5055, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 12:43:52 PM'),
(5056, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:43:53 PM'),
(5057, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_removeSOTransaction', '2022-05-12 12:44:00 PM'),
(5058, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:44:01 PM'),
(5059, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 12:44:20 PM'),
(5060, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:44:23 PM'),
(5061, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOTransaction', '2022-05-12 12:44:36 PM'),
(5062, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:44:38 PM'),
(5063, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_removeSOTransaction', '2022-05-12 12:45:00 PM'),
(5064, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:45:01 PM'),
(5065, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 12:45:14 PM'),
(5066, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-05-12 12:45:42 PM'),
(5067, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 12:45:43 PM'),
(5068, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:45:46 PM'),
(5069, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_removeSOTransaction', '2022-05-12 12:45:58 PM'),
(5070, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:45:58 PM'),
(5071, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOTransaction', '2022-05-12 12:46:17 PM'),
(5072, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:46:17 PM'),
(5073, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_removeSOTransaction', '2022-05-12 12:46:27 PM'),
(5074, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:46:28 PM'),
(5075, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOTransaction', '2022-05-12 12:46:43 PM'),
(5076, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:46:44 PM'),
(5077, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-12 12:47:05 PM'),
(5078, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 12:47:06 PM'),
(5079, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-05-12 12:48:53 PM'),
(5080, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 12:48:54 PM'),
(5081, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-12 12:48:58 PM'),
(5082, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_deleteSalesOrder', '2022-05-12 12:49:17 PM'),
(5083, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 12:49:17 PM'),
(5084, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-12 12:53:33 PM'),
(5085, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-05-12 12:54:29 PM'),
(5086, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-05-12 01:07:54 PM'),
(5087, NULL, 'Desktop: Chrome 101.0.4951.64', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-16 05:52:58 AM'),
(5088, NULL, 'Desktop: Chrome 101.0.4951.64', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2022-05-17 07:41:03 PM'),
(5089, NULL, 'Desktop: Chrome 101.0.4951.64', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2022-05-17 07:41:09 PM'),
(5090, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-05-17 07:41:10 PM'),
(5091, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 07:45:33 PM'),
(5092, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 08:18:34 PM'),
(5093, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 08:18:52 PM'),
(5094, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 08:19:10 PM'),
(5095, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 08:20:04 PM'),
(5096, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 08:20:42 PM'),
(5097, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 08:21:08 PM'),
(5098, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-17 08:21:19 PM'),
(5099, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 08:32:16 PM'),
(5100, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-05-17 08:32:44 PM'),
(5101, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 08:32:45 PM'),
(5102, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-05-17 08:33:24 PM'),
(5103, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 08:33:25 PM'),
(5104, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-05-17 08:34:11 PM'),
(5105, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 08:34:12 PM'),
(5106, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-17 08:43:52 PM'),
(5107, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 08:43:57 PM'),
(5108, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-17 08:44:00 PM'),
(5109, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 09:11:49 PM'),
(5110, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-17 09:11:53 PM'),
(5111, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 09:11:55 PM'),
(5112, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 09:21:46 PM'),
(5113, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-17 09:21:47 PM'),
(5114, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/xlsSalesOrder', '2022-05-17 09:21:59 PM'),
(5115, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-17 09:23:22 PM'),
(5116, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/xlsSalesOrder', '2022-05-17 09:23:30 PM'),
(5117, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 09:24:09 PM'),
(5118, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-17 09:24:13 PM'),
(5119, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-17 09:24:30 PM'),
(5120, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-17 09:24:33 PM'),
(5121, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/xlsPurchaseOrder', '2022-05-17 09:25:02 PM'),
(5122, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-17 09:25:46 PM'),
(5123, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-17 09:25:48 PM'),
(5124, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-17 09:25:50 PM'),
(5125, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addPurchaseOrder', '2022-05-17 09:26:26 PM'),
(5126, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-17 09:26:28 PM'),
(5127, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-17 09:26:40 PM'),
(5128, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/xlsPurchaseOrder', '2022-05-17 09:26:52 PM'),
(5129, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-17 09:34:20 PM'),
(5130, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-17 09:35:21 PM'),
(5131, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/xlsPurchaseOrder', '2022-05-17 09:35:30 PM'),
(5132, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-05-17 09:36:20 PM'),
(5133, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-05-17 09:36:23 PM'),
(5134, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/xlsSalesOrder', '2022-05-17 09:36:31 PM'),
(5135, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-17 09:57:37 PM'),
(5136, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-17 09:57:39 PM'),
(5137, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-17 09:59:41 PM'),
(5138, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-17 09:59:57 PM'),
(5139, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/invoices', '2022-05-17 10:00:17 PM'),
(5140, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-17 10:00:25 PM'),
(5141, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:00:26 PM'),
(5142, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-17 10:02:28 PM'),
(5143, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-17 10:02:34 PM'),
(5144, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addNewManualTransaction', '2022-05-17 10:02:48 PM'),
(5145, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-17 10:02:49 PM'),
(5146, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-17 10:02:51 PM'),
(5147, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-05-17 10:03:01 PM'),
(5148, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-17 10:03:23 PM'),
(5149, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:03:26 PM'),
(5150, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-05-17 10:03:33 PM'),
(5151, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:05:17 PM'),
(5152, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:06:24 PM'),
(5153, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:08:03 PM'),
(5154, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:11:02 PM'),
(5155, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:11:11 PM'),
(5156, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:11:30 PM'),
(5157, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:13:29 PM'),
(5158, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:15:56 PM'),
(5159, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:17:02 PM'),
(5160, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:17:17 PM'),
(5161, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:17:39 PM'),
(5162, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:18:38 PM'),
(5163, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:28:04 PM'),
(5164, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addBill', '2022-05-17 10:28:26 PM'),
(5165, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:28:27 PM'),
(5166, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addBill', '2022-05-17 10:29:00 PM'),
(5167, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:29:01 PM'),
(5168, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-17 10:29:55 PM'),
(5169, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:30:03 PM'),
(5170, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:43:34 PM'),
(5171, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/FORM_removeBill', '2022-05-17 10:43:40 PM'),
(5172, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:43:40 PM'),
(5173, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:47:02 PM'),
(5174, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-05-17 10:47:58 PM'),
(5175, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:48:01 PM'),
(5176, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:48:25 PM'),
(5177, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:50:10 PM'),
(5178, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:50:37 PM'),
(5179, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:50:46 PM'),
(5180, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:51:01 PM'),
(5181, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:51:26 PM'),
(5182, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:51:31 PM'),
(5183, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:51:32 PM'),
(5184, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:52:16 PM'),
(5185, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:52:55 PM'),
(5186, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:53:24 PM'),
(5187, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:53:44 PM'),
(5188, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:53:51 PM'),
(5189, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:54:18 PM'),
(5190, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:55:06 PM'),
(5191, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:55:16 PM'),
(5192, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/accounting_reports', '2022-05-17 10:56:20 PM'),
(5193, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:57:03 PM'),
(5194, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:58:58 PM'),
(5195, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/FORM_addBill', '2022-05-17 10:59:24 PM'),
(5196, '61a5caf447cae', 'Desktop: Chrome 101.0.4951.64', 'Linux', '127.0.0.1', 'TBD', 'https://localhost/manalok9/admin/bills', '2022-05-17 10:59:26 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tb_itemcode`
--

CREATE TABLE `tb_itemcode` (
  `uniqueID` varchar(255) DEFAULT NULL,
  `Brand_Top` varchar(255) DEFAULT NULL,
  `Cat_Char` varchar(255) DEFAULT NULL,
  `Prod_Type` varchar(255) DEFAULT NULL,
  `Brand_Bot` varchar(255) DEFAULT NULL,
  `Prod_Line` varchar(255) DEFAULT NULL,
  `New_Type` varchar(255) DEFAULT NULL,
  `Prod_Variant` varchar(255) DEFAULT NULL,
  `Prod_Size` varchar(255) DEFAULT NULL,
  `ItemCode` varchar(255) DEFAULT NULL,
  `TimeStamp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mailsent`
--

CREATE TABLE `tb_mailsent` (
  `id` int(11) NOT NULL,
  `sent_to` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mailsent`
--

INSERT INTO `tb_mailsent` (`id`, `sent_to`, `subject`, `message`, `attachment`) VALUES
(1, 'test@gmail.com', 'Your Order Has Been Approved', 'Your sales order [Order No SO625D04AF6B9D2] has been approved and marked for invoicing.', 'No attachment'),
(2, 'test@gmail.com', 'Your Order Has Been Delivered', 'Your sales order [Order No SO625D04AF6B9D2] has been successfully delivered.', 'No attachment'),
(3, 'test@gmail.com', 'Your Order Has Been Fulfilled', 'Your sales order [Order No SO625D04AF6B9D2] has been fulfilled.', 'No attachment');

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
(1, '61a5caf447cae', 'assets/images/faces/1.jpg', 'John', 'Rogers', 'Doe', 'Jr', '1989-06-22', '09123456789', '123 Tester City', '', '3', '2022-05-05 10:56:22 PM'),
(2, '62424e1258eb0', 'assets/images/faces/1.jpg', 'EDNA', 'MARIE', 'REYES', 'MS EDS', '', '', '', '', '2', '2022-03-30 01:52:45 PM'),
(3, '624252639e2e5', 'assets/images/faces/1.jpg', 'RAEVEN', 'SOTTO', 'LOTEYRO', 'RAEVEN ', '2002-06-11', '', '', '', '2', '2022-04-20 09:53:56 AM'),
(4, '62451b84cb670', 'assets/images/faces/1.jpg', 'David Christoper', '', 'LAZARO', 'DAVE', '', '', '', '', '2', '2022-04-20 10:28:22 AM'),
(5, '6254f07212f03', 'assets/images/faces/1.jpg', 'RAINIEZLE', 'DELA CRUZ', 'CABADING', '', '', '', '', '', '2', '2022-04-12 03:58:28 PM');

-- --------------------------------------------------------

--
-- Table structure for table `users_login`
--

CREATE TABLE `users_login` (
  `ID` int(11) NOT NULL,
  `UserID` varchar(255) DEFAULT NULL,
  `LoginEmail` varchar(255) DEFAULT NULL,
  `LoginPassword` varchar(255) DEFAULT NULL,
  `LastLogin` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_login`
--

INSERT INTO `users_login` (`ID`, `UserID`, `LoginEmail`, `LoginPassword`, `LastLogin`) VALUES
(1, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$32kld93bBPGFyHCVpWpbC.GnrLoymqU9J4OBOt7bXkPQNwPN0GL/q', '2022-05-17 22:59:26'),
(2, '62424e1258eb0', 'ednarmanalok9@gmail.com', '$2y$10$1CM/iWIo6T4lnZRfnZVikOlxijzNMWoBrTgfdmQWYqUwOXXYMUmMS', '2022-04-28 13:05:32'),
(3, '624252639e2e5', 'raevenandrei18@hotmail.com', '$2y$10$UJbx0ijXRnBr297gIPQpheKUXP9PsusDATx/IIdIv3d0dJZIAu6Sm', '2022-04-22 09:47:22'),
(4, '62451b84cb670', 'lazaro.christoper01@gmail.com', '$2y$10$hT8D2d1bL7VWkaZbvEDfFOwLgcuUn9nbaUsEzILIhgMA3Ape1YSYW', '2022-04-20 12:48:27'),
(5, '6254f07212f03', 'rain.cabading14@gmail.com', '$2y$10$IrAOHPmdeF9WRLy6XLWyte5zBF0NhYPcfPJudNRxsIUuRYu9NSUuO', '2022-04-22 10:46:00');

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
(1, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$jjzVYubdsipS/A5ST.4uRucxE2yCsr6XD1fwJm/Fjx.KVXNv4xTCi', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '110.93.86.122', 1, '2021-12-17 11:14:08 AM'),
(2, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$g9a90AjZBU/mfxBjnNXm6eyly7nb/kaTwvhiXHdA9Ccge2I82Q46W', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '110.93.86.168', 1, '2021-12-18 01:59:10 PM'),
(3, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$eP2vrwUgiDsMEQDTEGJQxueznHf2dlJLzawssBo6oQjd3GN/EZWVq', 'Desktop: Chrome 96.0.4664.110', 'Linux', '112.204.52.42', 1, '2021-12-18 02:03:59 PM'),
(4, NULL, 'admin', 'admin', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '152.32.98.248', 0, '2021-12-18 02:08:24 PM'),
(5, NULL, 'admin', 'admin', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '152.32.98.248', 0, '2021-12-18 02:08:38 PM'),
(6, NULL, 'admin', 'admin', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '152.32.98.248', 0, '2021-12-18 02:09:28 PM'),
(7, NULL, 'admin', 'admin', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '152.32.98.248', 0, '2021-12-18 02:34:47 PM'),
(8, NULL, 'admin', 'admin', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '152.32.98.248', 0, '2021-12-18 02:34:50 PM'),
(9, NULL, 'admin', 'admin', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '152.32.98.248', 0, '2021-12-18 02:34:52 PM'),
(10, NULL, 'admin', 'admin', 'Desktop: Chrome 94.0.4606.85', 'Android', '136.158.11.175', 0, '2021-12-18 03:19:44 PM'),
(11, NULL, 'admin', 'admin', 'Desktop: Chrome 94.0.4606.85', 'Android', '136.158.11.175', 0, '2021-12-18 03:19:56 PM'),
(12, NULL, 'admin', 'admin', 'Desktop: Chrome 94.0.4606.85', 'Android', '136.158.11.175', 0, '2021-12-18 03:20:04 PM'),
(13, NULL, 'admin', 'admin', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '152.32.98.248', 0, '2021-12-18 03:20:37 PM'),
(14, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$h2qqmVIQAOWpAN48jB3pq.rEMjsDEzVTZWetWCTrPvOpnYokrNPDe', 'Desktop: Chrome 94.0.4606.85', 'Android', '136.158.11.175', 1, '2021-12-18 03:21:27 PM'),
(15, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$vtAxOGsZypBigJrtzSoGouBuLP.7xHrd11JZCrjNNRLKJYIjcrHoe', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '152.32.98.248', 1, '2021-12-18 03:22:17 PM'),
(16, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$S/dxinu9dJsdXsX78JBNEuuEXK4nuq8u9uKSkJ37BgdCKBK2Xingm', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '27.109.79.217', 1, '2021-12-20 02:38:17 PM'),
(17, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$dhsgeivhxZ0DznDJPnL2Eu5/LamrOobTzoIjaMe47y8uHz7DylpKe', 'Desktop: Chrome 96.0.4664.110', 'Linux', '136.158.11.235', 1, '2021-12-21 10:29:50 AM'),
(18, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$mE/qeRmT0GOWrS/9byhgyedltPJ1fkMhTuDXGQ.yQwZ0tAnLQtof2', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '110.93.85.190', 1, '2021-12-21 11:07:37 AM'),
(19, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$kGZjpXZB0lzcjjhgVLUXd.RP3O5DqtycktfQ/4cFEKJBV5r1ZA8yO', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '152.32.98.248', 1, '2021-12-21 04:35:02 PM'),
(20, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$UqhNUZGZOBhrv/5t8nSNQ.5UuwHifNXmfRblsZTdLvWOrc6Z2meFC', 'Desktop: Chrome 96.0.4664.110', 'Linux', '112.204.52.42', 1, '2021-12-21 04:53:43 PM'),
(21, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$EESKQTdpM9w1H7bca2elhuQ8s5cKuSqAPNpjIOjDiuvi7jgmJnxUi', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '152.32.98.248', 1, '2021-12-22 05:59:33 PM'),
(22, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$YJPn19D76ma1dlnniM3GLOifiNM6gpKx55ZERMSNaDehjRRC5KmM6', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '152.32.98.248', 1, '2021-12-27 04:32:59 PM'),
(23, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$j3QwxRfOUAQnEgNPYRGlZuQtHmt5IWLtkA9wnh8gcPW8uUnUF45pi', 'Desktop: Chrome 96.0.4664.110', 'Linux', '112.204.38.254', 1, '2021-12-29 09:23:57 PM'),
(24, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$Rg5iHLWX0wslpzMy9T0ZKeUaz90...LrM5P1oLrWHj7oUlzmvYbLW', 'Desktop: Chrome 96.0.4664.110', 'Linux', '112.204.38.254', 1, '2021-12-29 09:28:07 PM'),
(25, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$yYtFW8Va.WmOxw29Gb7ueetwElaCvNauXROo352.nL7Gvp/FjYDyG', 'Desktop: Chrome 96.0.4664.110', 'Linux', '112.204.38.254', 1, '2021-12-29 09:34:11 PM'),
(26, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$RVXkNqqnbl4CUlFgG/5douHnxS3U8ilYy/tarLWQAbWNyI09eThiS', 'Desktop: Chrome 97.0.4692.71', 'Linux', '112.204.38.254', 1, '2022-01-07 08:51:00 PM'),
(27, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$7vnNor1MMLg5NkKxOKNYeOayAMfxV/F2A4bZfLQR0nwt6nKnWrJzm', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '27.109.79.217', 1, '2022-01-10 03:28:03 PM'),
(28, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$Bo7qpAvtEoj9iA2CQjlNXeT9yzuun8QVHfsLBqz45fvtHbNhLtpbK', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '110.93.86.162', 1, '2022-01-10 03:58:08 PM'),
(29, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$q.k65O3au0vekazSj9VaJOYY2Zgm0EQrLuAB.lLbcA1IXeIpEwVyW', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '27.109.79.217', 1, '2022-01-11 08:10:49 AM'),
(30, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$Dmg0MX6YMPbHJahU53qMyO.UKSdE4CVuLdefNnMw6pRC.awQ.wc3m', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '27.109.79.217', 1, '2022-01-11 02:07:37 PM'),
(31, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$b45CkjPBvCfSzO/MsoGhcuFSgTfjcTbNd1Szqoh97apVAVvdpxAvu', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '111.125.120.15', 1, '2022-01-12 09:54:40 AM'),
(32, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$V7JRser8Ame0xEch8U4vLuSRf2P81rr6FxMhiuNs.RklJYPyBfHve', 'Desktop: Chrome 97.0.4692.71', 'Windows 10', '110.93.86.162', 1, '2022-01-12 03:22:23 PM'),
(33, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$vSyT3tpZ3vceZzEw.EJKceQ6mves6JQby3xN2z9kGlkIU0RqwC8DC', 'Desktop: Chrome 97.0.4692.71', 'Windows 10', '110.93.84.78', 1, '2022-01-13 09:59:05 AM'),
(34, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$ii4Pe/pcaJYSdVmImO5Yp.MEVBI.w96K9FRfJ2P0XY/W2V9Jh2.Iu', 'Desktop: Chrome 96.0.4664.110', 'Windows 10', '110.93.84.78', 1, '2022-01-13 11:19:34 AM'),
(35, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$vXYwX51YRx3cBU9D24OQpelJXWCqYNa2rbQDLCeCVAKWNGufO3iQG', 'Desktop: Chrome 97.0.4692.71', 'Windows 10', '110.93.84.78', 1, '2022-01-13 01:33:09 PM'),
(36, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$CRbgexTzRAvkBnNhTwF4ruX7TH2jnHrJLAvi6PL0pYvKwGY4LNwNy', 'Desktop: Chrome 97.0.4692.71', 'Windows 10', '110.93.84.78', 1, '2022-01-13 02:56:16 PM'),
(37, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$/9S2P2j9xf0I6ngFq/dgUuKRG2HfIqTomt94V8lTufDhnCRVoJ5yS', 'Desktop: Chrome 97.0.4692.71', 'Windows 10', '110.93.87.207', 1, '2022-01-24 03:28:49 PM'),
(38, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$kSHmmvbpSrdvxRK1f0nobudAdeoXrkfGdD.RIULfmUQFs84ycsmp.', 'Desktop: Chrome 97.0.4692.71', 'Windows 10', '110.93.87.207', 1, '2022-01-26 08:36:20 AM'),
(39, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$cK96nNq2CwZg8KJgIz2uZOtRjicRPBjeHH/bo.8RRUkFR9ECagdaO', 'Desktop: Chrome 97.0.4692.71', 'Windows 10', '110.93.87.207', 1, '2022-01-26 01:10:26 PM'),
(40, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$sQGf0Gxk0qpXZsZjLG.ftuAlYAfwVUV1d6towTpkenL2nRCwHyLYq', 'Desktop: Chrome 97.0.4692.71', 'Windows 10', '110.93.87.207', 1, '2022-01-27 10:20:36 AM'),
(41, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$uJgufOyZ6KPLSrBzcaE7ouQKqQjzbN6QevpkTbbfChb5xnloIkyuy', 'Desktop: Chrome 97.0.4692.71', 'Windows 10', '110.93.87.35', 1, '2022-01-28 01:17:55 PM'),
(42, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$RQKXpLCx27g67l37eizRI.Hdh7XvPK2T5lBj2hJo4dg9JnjC16iUS', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '27.109.79.217', 1, '2022-01-29 11:00:00 AM'),
(43, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$LiRRe.9KJ8wLWOirsdwGKuk6NgsfKBVz/fjy9/MOe2x1MGOHmh96q', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.87.233', 1, '2022-01-29 02:36:47 PM'),
(44, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$Tj7UG.pR/J1H.t.fO062dOySKcUmzQTqcsrhbgG/rfsPQ7sYOsinG', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '2001:fd8:17c2:83e8:ad11:5acd:aa00:773b', 1, '2022-01-29 03:33:25 PM'),
(45, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$UD/xJbaeeEceFBHohcxanOPMlDtM8Mg4.6s0SLAF8nUQyiUL.5pF.', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.206', 1, '2022-01-31 09:17:31 AM'),
(46, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$Dxk0eGve0QEft1IS4zl2T.yJamzatsoHL/nHVPxy8YPVHbUMcB4p2', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.206', 1, '2022-02-03 11:10:59 AM'),
(47, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$tF/Dg8kwS0g6qZGjbUyBEuMMpNUrT9xXVkoM8RFNDGowhisWf9Lfa', 'Desktop: Chrome 97.0.4692.98', 'Android', '110.93.84.206', 1, '2022-02-03 11:47:39 AM'),
(48, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$uPquoXwVNg9xWcyjpJk4suCFMu0b.uRmmq78ebk42tI/fwvWsj4XS', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.206', 1, '2022-02-04 10:20:50 AM'),
(49, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$ANfuyTz3q/PsX0qs4GbheuBOO22YmdNFIUfFwoybymw/UtmKvbRS2', 'Desktop: Chrome 97.0.4692.98', 'Android', '110.93.84.206', 1, '2022-02-04 01:30:40 PM'),
(50, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$yNIMvUr3Nj73k6rjRK32ceEmjv1OrxkKg4gH.fdeITGj0Q2JaBR5S', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.206', 1, '2022-02-04 01:47:20 PM'),
(51, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$osJ1DvOqeaG1ioKnD.RzWuBiTKOVdksEkgpvod2kE1y7I5KQRR4z2', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.206', 1, '2022-02-04 02:14:19 PM'),
(52, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$gVkhwio2PBZIkSS1gijFj.zu/m8MpWm6azHIOedHiaThc/la5BdfO', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.206', 1, '2022-02-04 02:14:19 PM'),
(53, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$dKN0ZyUOerQ1dS7m0aS08uBa1PRlThrSJAeRBE6ua9G5CbBBvSw/2', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.206', 1, '2022-02-04 02:21:10 PM'),
(54, '', 'admin', '$2y$10$hb0pCi.NDzPqBEYAPMu3wOJSYNw1255DqdSOElt4RoWj4cr4iyaSq', 'Desktop: Chrome 97.0.4692.99', 'Linux', '112.204.62.6', 0, '2022-02-04 03:55:41 PM'),
(55, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$2jJ8jY50AVw2PDl2wiYt9et1ch.w/vxRDatU3V/EkLpucv21sEogm', 'Desktop: Chrome 97.0.4692.99', 'Linux', '112.204.62.6', 1, '2022-02-04 03:56:58 PM'),
(56, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$gO691xX40wRNjA.xKx0NFeO8TSMvBlwMwDBkCbG5Va8zFH54r/rAK', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.206', 1, '2022-02-04 04:14:29 PM'),
(57, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$wpQFtBAfahNeR.tehJ/DOOdP8HTqNEHIKncaVSI1K25PkDaMgBPy2', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.186', 1, '2022-02-07 09:12:39 AM'),
(58, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$V0qalpQ7aJvp9eAYxa733.Jk08AHgZPUCjIisWpmL1aJTpW3slQC.', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.186', 0, '2022-02-07 10:48:57 AM'),
(59, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$LNRHdGrzNzjpLB4EGEPdv.r7BJa9AI2sd4FhOXSl9TnxrmbnRR7hu', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.186', 1, '2022-02-07 10:49:06 AM'),
(60, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$dPJ36JYT8fc1Y95iW4Q3k.3RG/7veaznTiBL6ohuSMLcibCPUp59W', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.186', 1, '2022-02-07 10:49:30 AM'),
(61, '', 'admin', '$2y$10$aPBcReDH2k4O103Kdp2rb.h0qdCQt38j4LSvQQU9OyjD9iTmyTp9a', 'Desktop: Chrome 98.0.4758.87', 'Windows 10', '152.32.104.88', 0, '2022-02-07 10:49:51 AM'),
(62, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$LSV/G2n8vHPYQifPPhGtiODSSeqiav4/q3TABLHEkakpGjYwawFdq', 'Desktop: Chrome 97.0.4692.99', 'Linux', '112.204.62.6', 1, '2022-02-07 10:53:45 AM'),
(63, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$zH9knxxepuYug4Pp664Td.BuXIas7nEdLSDsMH3LY2.ul905d0ggW', 'Desktop: Chrome 98.0.4758.87', 'Windows 10', '152.32.104.88', 1, '2022-02-07 10:54:01 AM'),
(64, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$0wAu07X5et./gQHd0cRZ8.mHiYL4XRYlIlM.NhN0vnD8VLVutIylW', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.186', 1, '2022-02-09 10:20:11 AM'),
(65, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$Hoxbw4GqZ8RWDnHYYHpq8.T.qxJMolaMtYURS2r/k0aYdzW7XgO5O', 'Desktop: Chrome 97.0.4692.99', 'Windows 10', '110.93.84.186', 1, '2022-02-10 09:49:30 AM'),
(66, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$9Rg9MPUgrEnalPNpSXTIsuY5I3XupmcuiLkPTfzIu0XefUNwEYFv2', 'Desktop: Chrome 98.0.4758.82', 'Windows 10', '110.93.86.131', 1, '2022-02-14 09:05:04 AM'),
(67, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$191AqOaJtk.RE5TEJr0JIOoB.JctG8D5TOBIuO7Zwy0whNlUNycYq', 'Desktop: Chrome 98.0.4758.82', 'Windows 10', '110.93.86.131', 1, '2022-02-14 11:23:20 AM'),
(68, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$gai5ay1qxmYeQivui/r2.uaNqyPoAHmMgxrSlW1lxyxKR4YjSdfq.', 'Desktop: Chrome 98.0.4758.82', 'Windows 10', '110.93.84.228', 1, '2022-02-16 09:14:32 AM'),
(69, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$qb6EhSIQD/FjVpjdvICB2OdkL1W7DrmpsaH0nP8Y8b4yO3Aes.1j.', 'Desktop: Chrome 98.0.4758.87', 'Linux', '112.204.47.228', 1, '2022-02-16 12:39:35 PM'),
(70, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$dfVJ67yNjQw9O/SdwLbml.uuyPxbcDTPsaXc4shxCp96Tg.aX/eI2', 'Desktop: Chrome 98.0.4758.87', 'Linux', '112.204.47.228', 1, '2022-02-16 03:00:55 PM'),
(71, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$E77PmIssgelo72w6GePfy.QGre1U3K4GclaT7/csZSo5zVf/0XlsC', 'Desktop: Chrome 98.0.4758.82', 'Windows 10', '110.93.84.228', 1, '2022-02-16 03:56:40 PM'),
(72, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$XPmoZI3aaV68Eorzkaq90OVQPsZS/jnE8Eyn8ZrHil61MSnSR5A6m', 'Desktop: Chrome 98.0.4758.82', 'Windows 10', '110.93.84.228', 1, '2022-02-16 03:58:07 PM'),
(73, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$tjCDy6iaRIJNsJop9w8huOo8omaFjx0.IKPSHqhMbHalzbb7gBFYi', 'Desktop: Chrome 98.0.4758.87', 'Windows 10', '152.32.104.88', 0, '2022-02-16 04:01:56 PM'),
(74, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$2r3gEB6sXiux540anP7WZuRJjr1LJI3dO4WgSS4rcgyLxYZtcntXe', 'Desktop: Chrome 98.0.4758.87', 'Windows 10', '152.32.104.88', 0, '2022-02-16 04:02:02 PM'),
(75, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$NSDemMKAWhSMKVATD7fV4evIZ7LVlzAys7aDWXTASpGUCRYKssJaW', 'Desktop: Chrome 98.0.4758.87', 'Windows 10', '152.32.104.88', 1, '2022-02-16 04:03:01 PM'),
(76, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$9rbvGvp/HvVV07wEOb98x.XmYf4tBF/Hf1VjLIBYe0AZO9IODsLwW', 'Desktop: Chrome 98.0.4758.82', 'Windows 10', '110.54.140.133', 1, '2022-02-17 09:26:33 AM'),
(77, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$iK5y5SIA3ZOVweYEcnUjs.jQLxEJFkVEiASHuSRWgbB2yl66cjkDW', 'Desktop: Chrome 98.0.4758.87', 'Android', '112.204.47.228', 1, '2022-02-17 10:16:50 AM'),
(78, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$k6r4bUmwlB4ccrK7nxPd4O1L/CT0SVmQjGJ7RYMOAX9H3a3IQruUS', 'Desktop: Chrome 98.0.4758.87', 'Linux', '112.204.47.228', 1, '2022-02-17 10:19:15 AM'),
(79, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$rLBNRXP4QQEQ2HuRXkHvMO/c.IxigWxXW7R6HU/sXLb7jsqzY2OWK', 'Desktop: Chrome 98.0.4758.87', 'Windows 10', '152.32.104.88', 1, '2022-02-17 10:36:12 AM'),
(80, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$JzcfM5n2bEz8uxF5mTANMecwCqDN790sseyfF9mQyjc9ll8.kzCq6', 'Desktop: Chrome 98.0.4758.102', 'Windows 10', '110.54.140.133', 1, '2022-02-18 08:25:29 AM'),
(81, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$t1f5v/z.R7Hz/nTRgXjHDuCYY.LV7A6Xvnmuzdd1kaQhlUfHAUL5y', 'Desktop: Chrome 98.0.4758.102', 'Windows 10', '110.54.140.133', 1, '2022-02-18 10:55:19 AM'),
(82, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$T1kLb/xelo56LwkqQZtSD.j8JuUxCfGLTRdv03fYwGTa53N9we3ci', 'Desktop: Chrome 98.0.4758.102', 'Windows 10', '110.54.140.133', 1, '2022-02-18 10:55:19 AM'),
(83, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$FodFH2LcUPAiRBTNehDZ7uH.oicpZDiOxuyEWVL6pKLoTJbwytxEe', 'Desktop: Chrome 99.0.4844.51', 'Windows 10', '110.93.84.215', 1, '2022-03-09 11:02:16 AM'),
(84, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$F9WwSIcEYf/6/CG9gQ5wp.6OuGJA2BlqOQpttQVomaesWxeaZhzqC', 'Desktop: Chrome 99.0.4844.51', 'Windows 10', '110.93.84.215', 1, '2022-03-09 11:26:48 AM'),
(85, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$ebBD6cdP69FOdW5hogk3TemOWzxKvRQNCgDh7WaAa7uaI3PhmVFvG', 'Desktop: Chrome 99.0.4844.51', 'Windows 10', '110.93.84.249', 1, '2022-03-12 04:17:50 PM'),
(86, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$LFmJrr4.V.tmlZ7oEOOkHOgpok4vCt31YK5uZMn1Ar.OAZ1.kNdzO', 'Desktop: Chrome 99.0.4844.51', 'Windows 10', '110.93.84.41', 1, '2022-03-16 01:21:35 PM'),
(87, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$QJKcgXouKHnymshpEK//xesa/eWI.ql1utMy8.rSqjcFkuQdHvzpm', 'Desktop: Chrome 99.0.4844.51', 'Windows 10', '110.93.84.41', 1, '2022-03-16 02:47:45 PM'),
(88, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.51', 'Linux', '2001:4451:8244:f100:c0c4:682:aac1:b3a2', 1, '2022-03-16 03:33:54 PM'),
(89, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.51', 'Windows 10', '110.93.84.41', 1, '2022-03-16 04:34:51 PM'),
(90, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.74', 'Windows 10', '110.93.84.41', 1, '2022-03-17 03:29:05 PM'),
(91, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.74', 'Windows 10', '110.93.84.66', 1, '2022-03-18 09:36:37 AM'),
(92, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.74', 'Windows 10', '110.93.84.66', 1, '2022-03-18 02:14:34 PM'),
(93, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.82', 'Windows 10', '27.109.79.217', 1, '2022-03-25 08:28:09 AM'),
(94, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.82', 'Windows 10', '110.93.85.43', 1, '2022-03-25 10:22:41 AM'),
(95, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.82', 'Windows 10', '27.109.79.217', 1, '2022-03-25 01:31:14 PM'),
(96, '', 'admin', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.86.41', 0, '2022-03-28 05:15:22 PM'),
(97, '', 'Admin', NULL, 'Desktop: Chrome 99.0.4844.88', 'Android', '110.93.86.41', 0, '2022-03-28 05:17:45 PM'),
(98, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.74', 'Android', '2001:4451:822d:e100:bd3b:20b1:9109:748f', 1, '2022-03-28 08:18:27 PM'),
(99, '', 'test_admin@email.com', NULL, 'Desktop: Chrome 99.0.4844.73', 'Android', '2001:4451:822d:e100:bd3b:20b1:9109:748f', 0, '2022-03-28 08:25:07 PM'),
(100, '', 'test_admin@email.com', NULL, 'Desktop: Chrome 99.0.4844.73', 'Android', '2001:4451:822d:e100:bd3b:20b1:9109:748f', 0, '2022-03-28 08:25:14 PM'),
(101, '', 'admin_test@email.com', NULL, 'Desktop: Chrome 99.0.4844.73', 'Android', '2001:4451:822d:e100:bd3b:20b1:9109:748f', 0, '2022-03-28 08:25:31 PM'),
(102, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.73', 'Android', '2001:4451:822d:e100:bd3b:20b1:9109:748f', 1, '2022-03-28 08:35:18 PM'),
(103, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.83', 'Linux', '2001:4451:822d:e100:9115:1007:50e8:4564', 1, '2022-03-28 08:35:26 PM'),
(104, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.88', 'Android', '152.32.107.216', 1, '2022-03-28 10:29:24 PM'),
(105, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.74', 'Android', '152.32.107.216', 1, '2022-03-28 10:34:35 PM'),
(106, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.82', 'Windows 10', '110.93.87.196', 1, '2022-03-29 08:06:35 AM'),
(107, '624252639e2e5', 'raevenandrei18@hotmail.com', NULL, 'Desktop: Chrome 99.0.4844.82', 'Windows 10', '110.93.87.196', 1, '2022-03-29 08:34:15 AM'),
(108, '624252639e2e5', 'raevenandrei18@hotmail.com', NULL, 'Desktop: Chrome 99.0.4844.82', 'Windows 10', '110.93.87.196', 1, '2022-03-29 08:36:22 AM'),
(109, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.74', 'Android', '112.201.73.252', 1, '2022-03-29 11:50:29 AM'),
(110, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.73', 'Android', '136.158.11.119', 1, '2022-03-29 11:54:13 AM'),
(111, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.73', 'Android', '136.158.11.119', 1, '2022-03-29 11:54:20 AM'),
(112, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.73', 'Android', '112.201.73.252', 1, '2022-03-29 11:55:59 AM'),
(113, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.73', 'Android', '112.201.73.252', 1, '2022-03-29 11:56:04 AM'),
(114, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.82', 'Windows 10', '110.93.87.196', 1, '2022-03-29 12:13:07 PM'),
(115, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.88', 'Android', '152.32.107.216', 1, '2022-03-29 03:33:16 PM'),
(116, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:28:22 AM'),
(117, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:28:41 AM'),
(118, '', 'Ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:29:02 AM'),
(119, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:29:21 AM'),
(120, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:29:42 AM'),
(121, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:29:55 AM'),
(122, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:31:20 AM'),
(123, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:31:36 AM'),
(124, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:31:51 AM'),
(125, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:32:06 AM'),
(126, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:32:58 AM'),
(127, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:33:13 AM'),
(128, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:33:30 AM'),
(129, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:35:13 AM'),
(130, '', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:35:26 AM'),
(131, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.83', 'Linux', '112.201.73.252', 1, '2022-03-30 11:36:42 AM'),
(132, '62424e1258eb0', 'ednarmanalok9gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:37:27 AM'),
(133, '62424e1258eb0', 'ednarmanalok9gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 11:37:28 AM'),
(134, '62424e1258eb0', 'ednarmanalok9gmail.com', NULL, 'Desktop: Chrome 99.0.4844.88', 'Windows 10', '136.158.11.119', 0, '2022-03-30 11:41:43 AM'),
(135, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.82', 'Windows 10', '110.93.87.8', 1, '2022-03-30 11:41:47 AM'),
(136, '62424e1258eb0', 'ednarmanalok9gmail.com', NULL, 'Desktop: Chrome 99.0.4844.88', 'Windows 10', '136.158.11.119', 0, '2022-03-30 11:42:04 AM'),
(137, '62424e1258eb0', 'ednarmanalok9gmail.com', NULL, 'Desktop: Chrome 99.0.4844.88', 'Windows 10', '136.158.11.119', 0, '2022-03-30 11:42:14 AM'),
(138, '', 'ednarmanalok9gmail.com', NULL, 'Desktop: Chrome 99.0.4844.88', 'Windows 10', '136.158.11.119', 0, '2022-03-30 11:43:06 AM'),
(139, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 1, '2022-03-30 11:43:20 AM'),
(140, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.83', 'Linux', '112.201.73.252', 1, '2022-03-30 11:43:26 AM'),
(141, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.88', 'Windows 10', '136.158.11.119', 1, '2022-03-30 11:43:37 AM'),
(142, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.88', 'Windows 10', '136.158.11.119', 1, '2022-03-30 11:46:19 AM'),
(143, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.83', 'Linux', '2001:4451:822d:e100:1fea:40e6:2aaf:5e67', 1, '2022-03-30 12:28:23 PM'),
(144, '624252639e2e5', 'raevenandrei18@hotmail.com', NULL, 'Desktop: Chrome 99.0.4844.82', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:06:20 PM'),
(145, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:34:17 PM'),
(146, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:34:31 PM'),
(147, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:35:14 PM'),
(148, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:35:27 PM'),
(149, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:35:42 PM'),
(150, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:36:05 PM'),
(151, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:37:41 PM'),
(152, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:37:54 PM'),
(153, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:38:09 PM'),
(154, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:38:09 PM'),
(155, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:38:24 PM'),
(156, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:38:42 PM'),
(157, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 0, '2022-03-30 01:39:13 PM'),
(158, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.83', 'Linux', '2001:4451:822d:e100:1fea:40e6:2aaf:5e67', 1, '2022-03-30 01:40:35 PM'),
(159, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.82', 'Windows 10', '110.93.87.8', 1, '2022-03-30 01:42:25 PM'),
(160, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.83', 'Linux', '2001:4451:822d:e100:1fea:40e6:2aaf:5e67', 1, '2022-03-30 01:42:38 PM'),
(161, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 1, '2022-03-30 01:43:14 PM'),
(162, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.83', 'Linux', '2001:4451:822d:e100:1fea:40e6:2aaf:5e67', 1, '2022-03-30 01:43:16 PM'),
(163, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 1, '2022-03-30 01:43:56 PM'),
(164, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 1, '2022-03-30 01:45:30 PM'),
(165, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 1, '2022-03-30 01:49:26 PM'),
(166, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '110.93.87.8', 1, '2022-03-30 01:51:59 PM'),
(167, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.83', 'Linux', '2001:4451:822d:e100:1fea:40e6:2aaf:5e67', 1, '2022-03-30 01:55:46 PM'),
(168, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.82', 'Windows 10', '110.93.87.8', 1, '2022-03-30 04:48:56 PM'),
(169, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.88', 'Linux', '2001:4451:822d:e100:1fea:40e6:2aaf:5e67', 1, '2022-03-31 01:25:41 AM'),
(170, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.88', 'Linux', '2001:4451:822d:e100:1fea:40e6:2aaf:5e67', 1, '2022-03-31 01:52:03 AM'),
(171, '61a5caf447cae', 'test_admin1@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.88', 'Linux', '2001:4451:822d:e100:1fea:40e6:2aaf:5e67', 1, '2022-03-31 01:52:39 AM'),
(172, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.88', 'Linux', '2001:4451:822d:e100:1fea:40e6:2aaf:5e67', 1, '2022-03-31 01:52:58 AM'),
(173, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.84', 'Windows 10', '111.125.108.98', 1, '2022-03-31 09:30:03 AM'),
(174, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.60', 'Linux', '2001:4451:82a6:e700:3fe0:8451:ac61:470', 1, '2022-04-03 11:26:11 PM'),
(175, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.79', 'Linux', '2001:4451:82a6:e700:3ddb:c76e:8498:a932', 1, '2022-04-07 02:51:07 PM'),
(176, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 99.0.4844.73', 'Android', '136.158.11.181', 1, '2022-04-11 09:25:10 AM'),
(177, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.60', 'Android', '2001:4451:8455:a200:595:7950:420b:bb84', 1, '2022-04-11 09:28:56 AM'),
(178, '624252639e2e5', 'raevenandrei18@hotmail.com', NULL, 'Desktop: Chrome 100.0.4896.75', 'Windows 10', '110.93.86.209', 0, '2022-04-12 10:55:49 AM'),
(179, '624252639e2e5', 'raevenandrei18@hotmail.com', NULL, 'Desktop: Chrome 100.0.4896.75', 'Windows 10', '110.93.86.209', 0, '2022-04-12 10:56:03 AM'),
(180, '624252639e2e5', 'raevenandrei18@hotmail.com', NULL, 'Desktop: Chrome 100.0.4896.75', 'Windows 10', '110.93.86.209', 1, '2022-04-12 10:56:20 AM'),
(181, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.75', 'Windows 10', '110.93.86.209', 1, '2022-04-12 11:04:49 AM'),
(182, '6254f07212f03', 'rain.cabading14@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.75', 'Windows 10', '110.93.86.209', 1, '2022-04-12 11:42:49 AM'),
(183, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.75', 'Windows 10', '110.93.86.209', 1, '2022-04-12 03:56:03 PM'),
(184, '6254f07212f03', 'rain.cabading14@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.75', 'Windows 10', '110.93.86.209', 1, '2022-04-12 03:58:42 PM'),
(185, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.75', 'Windows 10', '2001:fd8:411:84e1:408a:ba56:64ee:a365', 1, '2022-04-13 09:59:31 AM'),
(186, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.88', 'Linux', '2001:4451:8455:a200:72af:e2e2:e0b3:6d20', 1, '2022-04-13 11:42:06 AM'),
(187, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.88', 'Linux', '2001:4451:8455:a200:b770:3f71:9ce3:a03b', 1, '2022-04-14 02:57:34 AM'),
(188, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.88', 'Windows 10', '110.93.86.172', 1, '2022-04-18 12:00:19 PM'),
(189, '6254f07212f03', 'rain.cabading14@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.75', 'Windows 10', '110.93.86.172', 1, '2022-04-18 01:06:48 PM'),
(190, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.88', 'Windows 10', '110.93.87.228', 1, '2022-04-20 09:52:29 AM'),
(191, '62451b84cb670', 'lazaro.christoper01@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.127', 'Windows 10', '111.125.108.98', 0, '2022-04-20 10:05:38 AM'),
(192, '62451b84cb670', 'lazaro.christoper01@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.127', 'Windows 10', '111.125.108.98', 0, '2022-04-20 10:08:04 AM'),
(193, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.88', 'Windows 10', '110.93.87.228', 1, '2022-04-20 10:27:48 AM'),
(194, '62451b84cb670', 'lazaro.christoper01@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.127', 'Windows 10', '111.125.108.98', 1, '2022-04-20 10:31:26 AM'),
(195, '624252639e2e5', 'raevenandrei18@hotmail.com', NULL, 'Desktop: Chrome 100.0.4896.75', 'Windows 10', '110.93.87.228', 0, '2022-04-20 10:52:51 AM'),
(196, '624252639e2e5', 'raevenandrei18@hotmail.com', NULL, 'Desktop: Chrome 100.0.4896.75', 'Windows 10', '110.93.87.228', 1, '2022-04-20 10:53:07 AM'),
(197, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.88', 'Windows 10', '110.93.87.228', 1, '2022-04-20 11:50:09 AM'),
(198, '6254f07212f03', 'rain.cabading14@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.88', 'Windows 10', '110.93.87.228', 1, '2022-04-20 12:15:36 PM'),
(199, '624252639e2e5', 'raevenandrei18@hotmail.com', NULL, 'Desktop: Chrome 100.0.4896.75', 'Windows 10', '110.93.85.94', 0, '2022-04-22 07:55:45 AM'),
(200, '624252639e2e5', 'raevenandrei18@hotmail.com', NULL, 'Desktop: Chrome 100.0.4896.75', 'Windows 10', '110.93.85.94', 1, '2022-04-22 07:56:00 AM'),
(201, '6254f07212f03', 'rain.cabading14@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.127', 'Windows 10', '110.93.85.94', 1, '2022-04-22 10:43:08 AM'),
(202, '62424e1258eb0', 'ednarmanalok9@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.127', 'Windows 10', '110.93.84.157', 1, '2022-04-28 12:01:36 PM'),
(203, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.127', 'Windows 10', '110.93.85.149', 1, '2022-04-29 08:37:30 AM'),
(204, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.127', 'Linux', '2001:4451:8455:a200:7880:89ca:5f00:c22c', 1, '2022-04-29 09:19:18 AM'),
(205, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 1, '2022-04-29 09:43:49 AM'),
(206, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 1, '2022-04-30 02:44:35 PM'),
(207, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 1, '2022-04-30 10:19:01 PM'),
(208, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 1, '2022-05-01 11:27:40 AM'),
(209, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 1, '2022-05-01 08:57:01 PM'),
(210, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 1, '2022-05-03 03:31:28 PM'),
(211, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 1, '2022-05-04 10:20:12 PM'),
(212, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 1, '2022-05-05 05:38:33 PM'),
(213, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 1, '2022-05-05 09:38:17 PM'),
(214, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 1, '2022-05-05 10:51:47 PM'),
(215, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.41', 'Linux', '::1', 1, '2022-05-05 11:54:05 PM'),
(216, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 1, '2022-05-10 09:43:10 PM'),
(217, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 1, '2022-05-11 07:03:02 AM'),
(218, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '::1', 1, '2022-05-12 06:45:40 AM'),
(219, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 1, '2022-05-12 12:42:20 PM'),
(220, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.54', 'Linux', '127.0.0.1', 1, '2022-05-12 12:42:22 PM'),
(221, '61a5caf447cae', 'test_admin@gmail.com', NULL, 'Desktop: Chrome 101.0.4951.64', 'Linux', '::1', 1, '2022-05-17 07:41:10 PM');

-- --------------------------------------------------------

--
-- Table structure for table `users_registrations`
--

CREATE TABLE `users_registrations` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DateAdded` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_registrations`
--

INSERT INTO `users_registrations` (`id`, `email`, `token`, `DateAdded`) VALUES
(1, 'lorelynsabalos@gmail.com', '54288fe214a94b1d37a25982162b52042ba11bd2fa05352d', '2022-01-29 03:15:51 PM'),
(2, 'elonor.relato@gmail.com', '9a060bd97ad97d59bb5dc73f2bdff99fa4501e9a59b476c3', '2022-01-29 03:17:21 PM');

-- --------------------------------------------------------

--
-- Table structure for table `user_restrictions`
--

CREATE TABLE `user_restrictions` (
  `ID` int(11) NOT NULL,
  `UserID` varchar(255) DEFAULT NULL,
  `products_view` tinyint(1) DEFAULT 0,
  `products_add` tinyint(1) DEFAULT 0,
  `products_edit` tinyint(1) DEFAULT 0,
  `products_delete` tinyint(1) DEFAULT 0,
  `releasing_view` tinyint(1) DEFAULT 0,
  `releasing_scan_add_stock` tinyint(1) DEFAULT 0,
  `releasing_manual_add_stock` tinyint(1) DEFAULT 0,
  `restocking_view` tinyint(1) DEFAULT 0,
  `restocking_scan_add_stock` tinyint(1) DEFAULT 0,
  `restocking_manual_add_stock` tinyint(1) DEFAULT 0,
  `restocking_update_stock` tinyint(1) DEFAULT 0,
  `restocking_delete_stock` tinyint(1) DEFAULT 0,
  `restocking_cart_functions` tinyint(1) DEFAULT 0,
  `inventory_view` tinyint(1) DEFAULT 0,
  `users_view` tinyint(1) DEFAULT 0,
  `users_add` tinyint(1) DEFAULT 0,
  `users_edit` tinyint(1) DEFAULT 0,
  `users_edit_login` tinyint(1) DEFAULT 0,
  `users_activities` tinyint(1) DEFAULT 0,
  `vendors_view` tinyint(1) DEFAULT 0,
  `vendors_add` tinyint(1) DEFAULT 0,
  `vendors_edit` tinyint(1) DEFAULT 0,
  `vendors_delete` tinyint(1) DEFAULT 0,
  `purchase_orders_view` tinyint(1) DEFAULT 0,
  `purchase_orders_add` tinyint(1) DEFAULT 0,
  `purchase_orders_add_manual_transaction` tinyint(1) DEFAULT 0,
  `purchase_orders_remove_manual_transaction` tinyint(1) DEFAULT 0,
  `purchase_orders_approve` tinyint(1) DEFAULT 0,
  `purchase_orders_bill_creation` tinyint(1) DEFAULT 0,
  `purchase_orders_accounting` tinyint(1) DEFAULT 0,
  `purchase_orders_remarks` tinyint(1) DEFAULT 0,
  `bills_view` tinyint(1) DEFAULT 0,
  `bills_add` tinyint(1) DEFAULT 0,
  `bills_delete` tinyint(1) DEFAULT 0,
  `manual_purchases_view` tinyint(1) DEFAULT 0,
  `clients_view` tinyint(1) DEFAULT 0,
  `clients_add` tinyint(1) DEFAULT 0,
  `clients_edit` tinyint(1) DEFAULT 0,
  `clients_delete` tinyint(1) DEFAULT 0,
  `sales_orders_view` tinyint(1) DEFAULT 0,
  `sales_orders_add` tinyint(1) DEFAULT 0,
  `sales_orders_mark_for_invoicing` tinyint(1) DEFAULT 0,
  `sales_orders_schedule_delivery` tinyint(1) DEFAULT 0,
  `sales_orders_mark_as_delivered` tinyint(1) DEFAULT 0,
  `sales_orders_mark_as_received` tinyint(1) DEFAULT 0,
  `sales_orders_invoice_creation` tinyint(1) DEFAULT 0,
  `sales_orders_accounting` tinyint(1) DEFAULT 0,
  `sales_orders_remarks` tinyint(1) DEFAULT 0,
  `sales_orders_adtl_fees` tinyint(1) DEFAULT 0,
  `sales_orders_update` tinyint(1) DEFAULT 0,
  `sales_orders_delete` tinyint(1) DEFAULT 0,
  `invoice_view` tinyint(1) DEFAULT 0,
  `invoice_add` tinyint(1) DEFAULT 0,
  `invoice_delete` tinyint(1) DEFAULT 0,
  `returns_view` tinyint(1) DEFAULT 0,
  `returns_add` tinyint(1) DEFAULT 0,
  `return_product_view` tinyint(1) DEFAULT 0,
  `return_product_add` tinyint(1) DEFAULT 0,
  `return_product_delete` tinyint(1) DEFAULT 0,
  `replacements_view` tinyint(1) DEFAULT 0,
  `replacements_add` tinyint(1) DEFAULT 0,
  `replacements_approve` tinyint(1) DEFAULT 0,
  `replacements_delete` tinyint(1) DEFAULT 0,
  `accounts_view` tinyint(1) DEFAULT 0,
  `accounts_add` tinyint(1) DEFAULT 0,
  `accounts_edit` tinyint(1) DEFAULT 0,
  `journal_transactions_view` tinyint(1) DEFAULT 0,
  `journal_transactions_add` tinyint(1) DEFAULT 0,
  `journal_transactions_delete` tinyint(1) DEFAULT 0,
  `branding_view` tinyint(1) DEFAULT 0,
  `branding_add` tinyint(1) DEFAULT 0,
  `branding_edit` tinyint(1) DEFAULT 0,
  `branding_delete` tinyint(1) DEFAULT 0,
  `mail_view` tinyint(1) DEFAULT 0,
  `mail_add` tinyint(1) DEFAULT 0,
  `my_activities_view` tinyint(1) DEFAULT 0,
  `trash_bin_view` tinyint(1) DEFAULT 0,
  `trash_bin_retrieve` tinyint(1) DEFAULT 0,
  `trash_bin_delete` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_restrictions`
--

INSERT INTO `user_restrictions` (`ID`, `UserID`, `products_view`, `products_add`, `products_edit`, `products_delete`, `releasing_view`, `releasing_scan_add_stock`, `releasing_manual_add_stock`, `restocking_view`, `restocking_scan_add_stock`, `restocking_manual_add_stock`, `restocking_update_stock`, `restocking_delete_stock`, `restocking_cart_functions`, `inventory_view`, `users_view`, `users_add`, `users_edit`, `users_edit_login`, `users_activities`, `vendors_view`, `vendors_add`, `vendors_edit`, `vendors_delete`, `purchase_orders_view`, `purchase_orders_add`, `purchase_orders_add_manual_transaction`, `purchase_orders_remove_manual_transaction`, `purchase_orders_approve`, `purchase_orders_bill_creation`, `purchase_orders_accounting`, `purchase_orders_remarks`, `bills_view`, `bills_add`, `bills_delete`, `manual_purchases_view`, `clients_view`, `clients_add`, `clients_edit`, `clients_delete`, `sales_orders_view`, `sales_orders_add`, `sales_orders_mark_for_invoicing`, `sales_orders_schedule_delivery`, `sales_orders_mark_as_delivered`, `sales_orders_mark_as_received`, `sales_orders_invoice_creation`, `sales_orders_accounting`, `sales_orders_remarks`, `sales_orders_adtl_fees`, `sales_orders_update`, `sales_orders_delete`, `invoice_view`, `invoice_add`, `invoice_delete`, `returns_view`, `returns_add`, `return_product_view`, `return_product_add`, `return_product_delete`, `replacements_view`, `replacements_add`, `replacements_approve`, `replacements_delete`, `accounts_view`, `accounts_add`, `accounts_edit`, `journal_transactions_view`, `journal_transactions_add`, `journal_transactions_delete`, `branding_view`, `branding_add`, `branding_edit`, `branding_delete`, `mail_view`, `mail_add`, `my_activities_view`, `trash_bin_view`, `trash_bin_retrieve`, `trash_bin_delete`) VALUES
(1, '61a5caf447cae', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, '62424e1258eb0', 1, 1, 1, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1),
(3, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, '624252639e2e5', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(5, '62451b84cb670', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1),
(6, '6254f07212f03', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `ID` int(11) NOT NULL,
  `VendorNo` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `TIN` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `ContactNum` varchar(255) DEFAULT NULL,
  `ProductServiceKind` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`ID`, `VendorNo`, `Name`, `TIN`, `Address`, `ContactNum`, `ProductServiceKind`, `Email`, `Status`) VALUES
(1, 'V625531F0D43F0', 'SEAMS COMMERCIAL CORPORATION', '0000000', 'ANGONO RIZAL', '09176290855', 'STICKER PRINTING', 'seams.printing@yahoo.com', 1),
(2, 'V6283A2831A357', 'res', '123123', '12312', '24124', '42214', 'tgeg@324234', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `adtl_fees`
--
ALTER TABLE `adtl_fees`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `brand_category`
--
ALTER TABLE `brand_category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `brand_properties`
--
ALTER TABLE `brand_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_size`
--
ALTER TABLE `brand_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_vcpd`
--
ALTER TABLE `brand_vcpd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_release`
--
ALTER TABLE `cart_release`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cart_restocking`
--
ALTER TABLE `cart_restocking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `journal_transactions`
--
ALTER TABLE `journal_transactions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `logbook`
--
ALTER TABLE `logbook`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `manual_transactions`
--
ALTER TABLE `manual_transactions`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_returned`
--
ALTER TABLE `product_returned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `replacements`
--
ALTER TABLE `replacements`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sales_history`
--
ALTER TABLE `sales_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `security_log`
--
ALTER TABLE `security_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_mailsent`
--
ALTER TABLE `tb_mailsent`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users_registrations`
--
ALTER TABLE `users_registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_restrictions`
--
ALTER TABLE `user_restrictions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `adtl_fees`
--
ALTER TABLE `adtl_fees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brand_category`
--
ALTER TABLE `brand_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `brand_properties`
--
ALTER TABLE `brand_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `brand_size`
--
ALTER TABLE `brand_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `brand_vcpd`
--
ALTER TABLE `brand_vcpd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `cart_release`
--
ALTER TABLE `cart_release`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_restocking`
--
ALTER TABLE `cart_restocking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `journal_transactions`
--
ALTER TABLE `journal_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `logbook`
--
ALTER TABLE `logbook`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=671;

--
-- AUTO_INCREMENT for table `manual_transactions`
--
ALTER TABLE `manual_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `products_transactions`
--
ALTER TABLE `products_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `product_returned`
--
ALTER TABLE `product_returned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `replacements`
--
ALTER TABLE `replacements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_history`
--
ALTER TABLE `sales_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `security_log`
--
ALTER TABLE `security_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5197;

--
-- AUTO_INCREMENT for table `tb_mailsent`
--
ALTER TABLE `tb_mailsent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_login_history`
--
ALTER TABLE `users_login_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `users_registrations`
--
ALTER TABLE `users_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_restrictions`
--
ALTER TABLE `user_restrictions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
