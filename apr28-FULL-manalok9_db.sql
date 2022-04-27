-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2022 at 01:04 AM
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
(1, 'Rental Expense', '3', 'rental expense'),
(2, 'Cash', '1', 'cash'),
(3, 'Sales', '0', 'sales'),
(4, 'Purchases', '3', 'purchases'),
(5, 'Accounts Payable', '2', 'accounts payable'),
(6, 'Office Supplies', '1', 'office supplies'),
(7, 'Utilities Expense', '3', 'utilities expense'),
(8, 'Accounts Receivable', '1', 'accounts receivable');

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

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `ID` int(11) NOT NULL,
  `BillNo` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Amount` varchar(255) DEFAULT NULL,
  `ModeOfPayment` varchar(255) DEFAULT NULL,
  `Date` varchar(50) DEFAULT NULL,
  `OrderNo` varchar(255) DEFAULT NULL,
  `Status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(47, 'META SHIRT', '022', 'T-SHIRT', 'abwauSmKvpLEtUIBhGx7ZU');

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
(47, 'abwauSmKvpLEtUIBhGx7ZU', 'MS', 'TS', 'MERCHANDISE', 'MERCH', 'T-SHIRT', 'TS', NULL, NULL, NULL, NULL);

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
(122, 'abwauSmKvpLEtUIBhGx7ZU', 'EXTRA EXTRA LARGE', '2XL');

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
(148, 'abwauSmKvpLEtUIBhGx7ZU', 'META SHIRT BLACK ROUND', 'MSBR');

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
(1, '577207308284', 'SHS004HSPRMPINK150G', '125', '150.00', '31.00', '', '', '', '61a5caf447cae', '2022/04/22 07:05:31', 2),
(2, '065568322251', 'SDN001DFPRMORIG1KG', '100', '259.75', '109.24', '', '', '', '61a5caf447cae', '2022/04/22 07:05:41', 2),
(3, '024433665861', 'MK9020MERCHMGMANALOK9LOGOMUGFS', '190', '200.00', '74.00', '', '', '', '61a5caf447cae', '2022/04/22 07:05:51', 2),
(4, '740127167506', 'MK9017MERCHCOLLARARMYGREENAS', '80', '2200.00', '800.00', '', '', '', '61a5caf447cae', '2022/04/22 07:05:59', 2),
(5, '046419359251', 'MK9016MERCHLEASHPUPPGRAYPPS', '50', '1000.00', '320.00', '', '', '', '61a5caf447cae', '2022/04/22 07:06:07', 2),
(6, '709737765784', 'MK9011MERCHSANDOPAWSITIVEM', '60', '350.00', '123.81', '', '', '', '61a5caf447cae', '2022/04/22 07:06:16', 2),
(7, '389509193021', 'SDS002DSPRMYP150 G', '30', '150.00', '31.5', '', '', '', '61a5caf447cae', '2022/04/22 09:17:27', 2),
(8, '389509193021', 'SDS002DSPRMYP150 G', '20', '150.00', '35', '', '', '', '61a5caf447cae', '2022/04/22 09:18:00', 2);

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
(1, 'C6249A37492296', 'John', '123', '123', '123', '123', '123', 0, '123', '123@123.123', 1);

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

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`ID`, `InvoiceNo`, `Description`, `Amount`, `ModeOfPayment`, `Date`, `OrderNo`, `Status`) VALUES
(1, 'I62621672A4E73', 'ytrtd', '3000000', 'hhj', '2022-04-22 10:43:00', 'SO6261E50EC3BDE', 1);

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
(1, 'JT624BF7A254869', '2022-04-05', 'Payment of rent', '1000', NULL, NULL),
(2, 'JT624BF7A28342D', '2022-04-05', 'Cash sales from customer', '2000', NULL, NULL),
(3, 'JT624BF7A28E1CC', '2022-04-05', 'Purchase of dogfood on account', '3000', NULL, NULL),
(4, 'JT624BF7A298FE3', '2022-04-05', 'Purchase of office supplies', '1500', NULL, NULL),
(5, 'JT624BF7A2A3DCA', '2022-04-05', 'Payment of utilities', '1000', NULL, NULL),
(6, 'JT624BF7A2AEC3E', '2022-04-05', 'Sales on credit', '2000', NULL, NULL);

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
(1, 'added new transaction.', 'restocked 125 for  SHS004HSPRMPINK150G [TransactionID: SHS004HSPRMPINK150G-6261E3774E239].', '61a5caf447cae', 'https://localhost/manalok9/admin/viewproduct?code=SHS004HSPRMPINK150G', '2022-04-22 07:06:31 AM'),
(2, 'added new transaction.', 'restocked 100 for  SDN001DFPRMORIG1KG [TransactionID: SDN001DFPRMORIG1KG-6261E377C0AC6].', '61a5caf447cae', 'https://localhost/manalok9/admin/viewproduct?code=SDN001DFPRMORIG1KG', '2022-04-22 07:06:31 AM'),
(3, 'added new transaction.', 'restocked 190 for  MK9020MERCHMGMANALOK9LOGOMUGFS [TransactionID: MK9020MERCHMGMANALOK9LOGOMUGFS-6261E37846CD3].', '61a5caf447cae', 'https://localhost/manalok9/admin/viewproduct?code=MK9020MERCHMGMANALOK9LOGOMUGFS', '2022-04-22 07:06:32 AM'),
(4, 'added new transaction.', 'restocked 80 for  MK9017MERCHCOLLARARMYGREENAS [TransactionID: MK9017MERCHCOLLARARMYGREENAS-6261E378A89FD].', '61a5caf447cae', 'https://localhost/manalok9/admin/viewproduct?code=MK9017MERCHCOLLARARMYGREENAS', '2022-04-22 07:06:32 AM'),
(5, 'added new transaction.', 'restocked 50 for  MK9016MERCHLEASHPUPPGRAYPPS [TransactionID: MK9016MERCHLEASHPUPPGRAYPPS-6261E3790E25F].', '61a5caf447cae', 'https://localhost/manalok9/admin/viewproduct?code=MK9016MERCHLEASHPUPPGRAYPPS', '2022-04-22 07:06:33 AM'),
(6, 'added new transaction.', 'restocked 60 for  MK9011MERCHSANDOPAWSITIVEM [TransactionID: MK9011MERCHSANDOPAWSITIVEM-6261E3796A7C9].', '61a5caf447cae', 'https://localhost/manalok9/admin/viewproduct?code=MK9011MERCHSANDOPAWSITIVEM', '2022-04-22 07:06:33 AM'),
(7, 'created a new sales order.', 'added sales order SO6261E50EC3BDE [SalesOrderID: 1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6261E50EC3BDE', '2022-04-22 07:13:19 AM'),
(8, 'approved sales order.', 'approved sales order SO6261E50EC3BDE [SalesOrderID: 1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6261E50EC3BDE', '2022-04-22 07:13:32 AM'),
(9, 'added a new additional fee.', 'adde a new additional fee [ID: 1] for sales order [OrderNo: SO6261E50EC3BDE].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6261E50EC3BDE', '2022-04-22 07:14:09 AM'),
(10, 'added new transaction.', 'restocked 30 for  SDS002DSPRMYP150 G [TransactionID: SDS002DSPRMYP150 G-62620250E4DD2].', '61a5caf447cae', 'https://localhost/manalok9/admin/viewproduct?code=SDS002DSPRMYP150 G', '2022-04-22 09:18:09 AM'),
(11, 'added new transaction.', 'restocked 20 for  SDS002DSPRMYP150 G [TransactionID: SDS002DSPRMYP150 G-626202516DA63].', '61a5caf447cae', 'https://localhost/manalok9/admin/viewproduct?code=SDS002DSPRMYP150 G', '2022-04-22 09:18:09 AM'),
(12, 'added new transaction.', 'released 30 for  SDS002DSPRMYP150 G [TransactionID: SDS002DSPRMYP150 G-626202AF30F9F].', '61a5caf447cae', 'https://localhost/manalok9/admin/viewproduct?code=SDS002DSPRMYP150 G', '2022-04-22 09:19:43 AM'),
(13, 'created a new purchase order.', 'added purchase order PO6262030FC3B23 [PurchaseOrderID: 1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_purchase_order?orderNo=PO6262030FC3B23', '2022-04-22 09:21:19 AM'),
(14, 'added a new manual purchase transaction.', 'added a new manual purchase transaction [ID: 1] for purchase order [OrderNo: PO6262030FC3B23].', '61a5caf447cae', 'https://localhost/manalok9/admin/manual_transactions', '2022-04-22 09:22:02 AM'),
(15, 'added new replacement.', 'added replacement RP626204379812B to sales order [SalesOrderNo: SO6261E50EC3BDE].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6261E50EC3BDE', '2022-04-22 09:26:15 AM'),
(16, 'rejected replacement.', 'rejected replacement RP626204379812B [SalesOrderNo: 1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6261E50EC3BDE', '2022-04-22 09:26:30 AM'),
(17, 'added new replacement.', 'added replacement RP6262046594758 to sales order [SalesOrderNo: SO6261E50EC3BDE].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6261E50EC3BDE', '2022-04-22 09:27:01 AM'),
(18, 'approved replacement.', 'approved replacement RP6262046594758 [SalesOrderNo: 1].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6261E50EC3BDE', '2022-04-22 09:27:13 AM'),
(19, 'deleted replacement.', 'deleted replacement RP6262046594758 [SalesOrderNo: ].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=', '2022-04-22 09:27:37 AM'),
(20, 'added new replacement.', 'added replacement RP626204A39F97F to sales order [SalesOrderNo: SO6261E50EC3BDE].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6261E50EC3BDE', '2022-04-22 09:28:03 AM'),
(21, 'scheduled delivery.', 'scheduled delivery for sales order [No: SO6261E50EC3BDE].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6261E50EC3BDE', '2022-04-22 09:46:57 AM'),
(22, 'marked SO as delivered.', 'sales order marked as delivered [No: SO6261E50EC3BDE].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6261E50EC3BDE', '2022-04-22 09:47:05 AM'),
(23, 'marked SO as received.', 'sales order marked as received [No: SO6261E50EC3BDE].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6261E50EC3BDE', '2022-04-22 09:47:11 AM'),
(24, 'removed adtl fee.', 'removed adtl fee [adtlFeeNo: AF6261E540D2A96].', '61a5caf447cae', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO6261E50EC3BDE', '2022-04-22 09:48:16 AM'),
(25, 'generated a new invoice.', 'generated a new invoice [ID: 1] for sales order [OrderNo: SO6261E50EC3BDE].', '61a5caf447cae', 'https://localhost/manalok9/admin/invoices', '2022-04-22 10:44:02 AM');

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
(1, 'MT62620339B6884', 'Test', 'Test ', 5, '50', '2022-04-22 09:22:01', 'PO6262030FC3B23', 1);

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
(33, '673068742688', 'SDN001DFPRMORIG500G', 'SDN DOGFOOD  ORIGINAL 500 G', 'ORIGINAL', 0, 0, 'PRM', '500G', '200', '79.80', '2022-01-26 10:54:08 AM', '0', 'assets/barcode_images/673068742688-pbarcode.png', 1),
(34, '709591752686', 'SDN001DFPRMORIG5KG', 'SDN DOGFOOD ORIGINAL 5KG', 'ORIGINAL', 0, 0, 'PRM', '5KG', '1100.00', '452.95', '2022-01-26 01:10:56 PM', '0', 'assets/barcode_images/709591752686-pbarcode.png', 1),
(35, '503263540983', 'SDN001DFPRMORIG15KG', 'SDN DOGFOOD ORIGINAL  15KG', 'ORIGINAL', 0, 0, 'PRM', '15KG', '3245.00', '1347.65', '2022-01-26 01:11:51 PM', '0', 'assets/barcode_images/503263540983-pbarcode.png', 1),
(37, '389509193021', 'SDS002DSPRMYP150 G', 'SDS YOUNG PUPPIES 150 G', 'YP', 20, 30, 'PRM', '150 G', '150.00', '31.00', '2022-01-26 01:22:35 PM', '0', 'assets/barcode_images/389509193021-pbarcode.png', 1),
(38, '305096204785', 'SDS002DSPRMMC150 G', 'SDS MINTY COOL 150G ', 'MC', 0, 0, 'PRM', '150 G', '150.00', '31.00', '2022-01-26 01:24:36 PM', '0', 'assets/barcode_images/305096204785-pbarcode.png', 1),
(39, '610840330961', 'SDS002DSPRMORIG150 G', 'SDS 5 IN1 ORIGINAL 150G ', '5 IN1 ORIGINAL', 0, 0, 'PRM', '150 G', '150.00', '31.00', '2022-01-26 01:25:58 PM', '0', 'assets/barcode_images/610840330961-pbarcode.png', 1),
(40, '295065421248', 'SDS002DSPRMAC150 G', 'SDS ACTIVATED CHARCOAL 150G ', 'AC', 0, 0, 'PRM', '150 G', '150.00', '31.00', '2022-01-26 01:26:40 PM', '0', 'assets/barcode_images/295065421248-pbarcode.png', 1),
(41, '460191712132', 'SCB003DSPRMSCB150G', 'SDS SHAMPOO AND CONDITIONER BAR 150G', 'SCB', 0, 0, 'PRM', '150G', '150.00', '28.50', '2022-01-26 01:27:11 PM', '0', 'assets/barcode_images/460191712132-pbarcode.png', 1),
(42, '152418113111', 'POT004DPPRMPOT150 G ', 'POWTECH  POWDER 150G ', 'POWTECH', 0, 0, 'PRM', '150 G ', '150.00', '70.00', '2022-01-26 01:33:03 PM', '0', 'assets/barcode_images/152418113111-pbarcode.png', 1),
(45, '698562504594', 'SHS004HSPRMBLUE150G', 'SUPER DOC HITECH SOAP BLUE 150G', 'SHS BLUE', 0, 0, 'PRM', '150G', '150.00', '31.00', '2022-01-26 02:35:48 PM', '0', 'assets/barcode_images/698562504594-pbarcode.png', 1),
(46, '577207308284', 'SHS004HSPRMPINK150G', 'SUPER DOC HITECH SOAP PINK 150G', 'SHS PINK', 110, 15, 'PRM', '150G', '150.00', '31.00', '2022-01-26 02:36:42 PM', '0', 'assets/barcode_images/577207308284-pbarcode.png', 1),
(47, '863993147614', 'MK9005MERCHTSVNECKXS', 'MK9 T-SHIRT V-NECK EXTRA SMALL', 'MK9 LOGO | XS', 0, 0, 'TS', 'XS', '500.00', '157.40', '2022-01-26 02:53:43 PM', '0', 'assets/barcode_images/863993147614-pbarcode.png', 1),
(48, '267201450035', 'MK9005MERCHTSVNECKS', 'MK9 T-SHIRT V-NECK SMALL', 'MK9 LOGO | S', 0, 0, 'TS', 'S', '500.00', '157.40', '2022-01-26 03:18:05 PM', '0', 'assets/barcode_images/267201450035-pbarcode.png', 1),
(49, '836978213027', 'MK9005MERCHTSVNECKM', 'MK9 T-SHIRT V-NECK MEDIUM ', 'MK9 LOGO | M', 0, 0, 'TS', 'M', '500.00', '157.40', '2022-01-27 10:27:36 AM', '0', 'assets/barcode_images/836978213027-pbarcode.png', 1),
(50, '348261321516', 'MK9005MERCHTSVNECKL', 'MK9 T-SHIRT V-NECK LARGE ', 'MK9 LOGO | L', 0, 0, 'TS', 'L', '500.00', '157.40', '2022-01-27 10:30:15 AM', '0', 'assets/barcode_images/348261321516-pbarcode.png', 1),
(51, '268332374368', 'MK9005MERCHTSVNECKXL', 'MK9 T-SHIRT V-NECK  EXTRA LARGE ', 'MK9 LOGO | XL', 0, 0, 'TS', 'XL', '500.00', '157.40', '2022-01-27 10:30:51 AM', '0', 'assets/barcode_images/268332374368-pbarcode.png', 1),
(52, '752875585619', 'MK9005MERCHTSVNECK2XL', 'MK9 T-SHIRT V-NECK EXTRA EXTRA LARGE ', 'MK9 LOGO | 2XL', 0, 0, 'TS', '2XL', '500.00', '157.40', '2022-01-27 10:31:35 AM', '0', 'assets/barcode_images/752875585619-pbarcode.png', 1),
(53, '849855046474', 'MK9006MERCHTSROUNDXS', 'MK9 T-SHIRT ROUND EXTRA SMALL', 'MK9 LOGO | XS', 0, 0, 'TS', 'XS', '500.00', '157.40', '2022-01-28 01:26:37 PM', '0', 'assets/barcode_images/849855046474-pbarcode.png', 1),
(54, '163889315201', 'MK9006MERCHTSROUNDS', 'MK9 T-SHIRT ROUND SMALL', 'MK9 LOGO | S', 0, 0, 'TS', 'S', '500.00', '157.40', '2022-01-28 01:27:50 PM', '0', 'assets/barcode_images/163889315201-pbarcode.png', 1),
(55, '545199272285', 'MK9006MERCHTSROUNDM', 'MK0 T-SHIRT ROUND MEDIUM', 'MK9 LOGO | M', 0, 0, 'TS', 'M', '500.00', '157.40', '2022-01-28 01:29:00 PM', '0', 'assets/barcode_images/545199272285-pbarcode.png', 1),
(56, '678267141100', 'MK9006MERCHTSROUNDL', 'MK9 T-SHIRT ROUND LARGE ', 'MK9 LOGO | L', 0, 0, 'TS', 'L', '500.00', '157.40', '2022-01-28 01:29:33 PM', '0', 'assets/barcode_images/678267141100-pbarcode.png', 1),
(57, '551309602225', 'MK9006MERCHTSROUNDXL', 'MK9 T-SHIRT ROUND EXTRA LARGE ', 'MK9 LOGO | XL', 0, 0, 'TS', 'XL', '500.00', '157.40', '2022-01-28 01:30:17 PM', '0', 'assets/barcode_images/551309602225-pbarcode.png', 1),
(58, '619058165690', 'MK9006MERCHTSROUND2XL', 'MK9 T-SHIRT ROUND EXTRA EXTRA LARGE ', 'MK9 LOGO | 2XL', 0, 0, 'TS', '2XL', '500.00', '157.40', '2022-01-28 01:30:55 PM', '0', 'assets/barcode_images/619058165690-pbarcode.png', 1),
(59, '065568322251', 'SDN001DFPRMORIG1KG', 'SDN DOGFOOD ORIGINAL 1KG', 'SDN | 1KG', 100, 0, 'PRM', '1KG', '259.75', '109.24', '2022-01-29 03:55:19 PM', '0', 'assets/barcode_images/065568322251-pbarcode.png', 1),
(61, '704992641756', 'MK9007MERCHTSICGDXS', 'MK9 T-SHIRT  ICGD EXTRA SMALL', 'ICGD LOGO | XS', 0, 0, 'TS', 'XS', '350.00', '157.40', '2022-02-09 10:36:15 AM', '0', 'assets/barcode_images/704992641756-pbarcode.png', 1),
(62, '833259988634', 'MK9007MERCHTSICGDS', 'MK9 T-SHIRT   ICGD SMALL', 'ICGD LOGO | S', 0, 0, 'TS', 'S', '350.00', '157.40', '2022-02-09 11:00:16 AM', '0', 'assets/barcode_images/833259988634-pbarcode.png', 1),
(63, '181222203997', 'MK9007MERCHTSICGDM', 'MK9 T-SHIRT  ICGD MEDIUM', 'ICGD LOGO | M', 0, 0, 'TS', 'M', '350.00', '157.40', '2022-02-09 11:01:53 AM', '0', 'assets/barcode_images/181222203997-pbarcode.png', 1),
(65, '827093288321', 'MK9007MERCHTSICGDL', 'MK9 T-SHIRT  ICGD LARGE ', 'ICGD LOGO | L', 0, 0, 'TS', 'L', '350.00', '157.40', '2022-02-09 11:05:28 AM', '0', 'assets/barcode_images/827093288321-pbarcode.png', 1),
(66, '398071086767', 'MK9007MERCHTSICGDXL', 'MK9 T-SHIRT  ICGD EXTRA LARGE ', 'ICGD LOGO | XL', 0, 0, 'TS', 'XL', '350.00', '157.40', '2022-02-09 11:06:59 AM', '0', 'assets/barcode_images/398071086767-pbarcode.png', 1),
(67, '347071073154', 'MK9007MERCHTSICGD2XL', 'MK9 T-SHIRT ICGD EXTRA EXTRA LARGE ', 'ICGD LOGO | 2XL', 0, 0, 'TS', '2XL', '350.00', '157.40', '2022-02-09 11:08:27 AM', '0', 'assets/barcode_images/347071073154-pbarcode.png', 1),
(68, '603093634198', 'MK9008MERCHTSSDXS', 'MK9 T-SHIRT SUPERDOGGERS EXTRA SMALL', 'SUPERDOGGERS LOGO / XS', 0, 0, 'TS', 'XS', '350.00', '157.40', '2022-02-16 10:37:13 AM', '0', 'assets/barcode_images/603093634198-pbarcode.png', 1),
(69, '317770704841', 'MK9008MERCHTSSDS', 'MK9 T-SHIRT SUPERDOGGERS SMALL', 'SUPERDOGGERS LOGO | S', 0, 0, 'TS', 'S', '350.00', '157.40', '2022-02-16 11:38:22 AM', '0', 'assets/barcode_images/317770704841-pbarcode.png', 1),
(70, '467040399410', 'MK9008MERCHTSSDM', 'MK9 T-SHIRT SUPERDOGGERS MEDIUM', 'SUPERDOGGERS | M\r\n', 0, 0, 'TS', 'M', '350.00', '157.40', '2022-02-16 11:57:03 AM', '0', 'assets/barcode_images/467040399410-pbarcode.png', 1),
(71, '300083336346', 'MK9008MERCHTSSDL', 'MK9 T-SHIRT SUPERDOGGERS LARGE ', 'SUPERDOGGERS LOGO | L', 0, 0, 'TS', 'L', '350.00', '157.40', '2022-02-16 11:58:04 AM', '0', 'assets/barcode_images/300083336346-pbarcode.png', 1),
(72, '054345304771', 'MK9008MERCHTSSDXL', 'MK9 T-SHIRT SUPERDOGGERS EXTRA LARGE ', 'SUPERDOGGERS LOGO | XL', 0, 0, 'TS', 'XL', '350.00', '157.40', '2022-02-16 11:59:12 AM', '0', 'assets/barcode_images/054345304771-pbarcode.png', 1),
(73, '574166262403', 'MK9008MERCHTSSDXXL', 'MK9 T-SHIRT SUPERDOGGERS EXTRA EXTRA LARGE ', 'SUPERDOGGERS | 2XL', 0, 0, 'TS', 'XXL', '350.00', '157.40', '2022-02-16 12:00:18 PM', '0', 'assets/barcode_images/574166262403-pbarcode.png', 1),
(74, '307321132513', 'MK9009MERCHTSWADXS', 'MK9 SANDO WITH A DOG EXTRA SMALL', 'WITH A DOG LOGO | XS', 0, 0, 'TS', 'XS', '350', '123.81', '2022-02-16 01:17:32 PM', '0', 'assets/barcode_images/307321132513-pbarcode.png', 1),
(75, '277624416384', 'MK9009MERCHTSWADS', 'MK9 SANDO WITH A DOG SMALL ', ' WITH A DOG LOGO | S', 0, 0, 'TS', 'S', '123.81', '350.00', '2022-02-16 01:42:05 PM', '0', 'assets/barcode_images/277624416384-pbarcode.png', 1),
(76, '466107403295', 'MK9009MERCHTSWADM', 'MK9 SANDO WITH A DOG MEDIUM ', 'WITH A DOG LOGO | MEDIUM ', 0, 0, 'TS', 'M', '123.81', '350.00', '2022-02-16 01:42:57 PM', '0', 'assets/barcode_images/466107403295-pbarcode.png', 1),
(77, '291156290831', 'MK9009MERCHTSWADL', 'MK9 SANDO WITH A DOG LARGE ', 'WITH A DOG LOGO | L', 0, 0, 'TS', 'L', '123.81', '350.00', '2022-02-16 01:43:46 PM', '0', 'assets/barcode_images/291156290831-pbarcode.png', 1),
(78, '070549738720', 'MK9009MERCHTSWADXL', 'MK9 SANDO WITH A DOG  EXTRA LARGE ', 'WITH A DOG | XL', 0, 0, 'TS', 'XL', '123.81', '350.00', '2022-02-16 01:44:26 PM', '0', 'assets/barcode_images/070549738720-pbarcode.png', 1),
(79, '538124072215', 'MK9009MERCHTSWADXXL', 'MK9 SANDO WITH A DOG EXTRA EXTRA LARGE ', 'WITH A DOG LOGO |  XXL', 0, 0, 'TS', 'XXL', '123.81', '350.00', '2022-02-16 01:46:11 PM', '0', 'assets/barcode_images/538124072215-pbarcode.png', 1),
(80, '129018302492', 'MK9010MERCHSANDOYPSXS', 'MK9 SANDO  YOUR PAWS EXTRA SMALL ', 'YOUR PAWS LOGO | XS', 0, 0, 'SANDO', 'XS', '350.00', '123.81', '2022-02-16 02:00:06 PM', '0', 'assets/barcode_images/129018302492-pbarcode.png', 1),
(81, '660806621749', 'MK9010MERCHSANDOYPSS', 'MK9 SANDO YOUR PAWS SMALL', 'OUR PAWS LOGO | S', 0, 0, 'SANDO', 'S', '350.00', '123.81', '2022-02-16 02:03:24 PM', '0', 'assets/barcode_images/660806621749-pbarcode.png', 1),
(82, '313643673607', 'MK9010MERCHSANDOYPSM', 'MK9 SANDO YOUR PAWS MEDIUM', 'YOUR PAWS LOGO | M', 0, 0, 'SANDO', 'M', '350.00', '123.81', '2022-02-16 02:05:45 PM', '0', 'assets/barcode_images/313643673607-pbarcode.png', 1),
(83, '796275537042', 'MK9010MERCHSANDOYPSL', 'MK9 SANDO YOUR PAWS LARGE', 'YOUR PAWS LOGO | L', 0, 0, 'SANDO', 'L', '350.00', '123.81', '2022-02-16 02:06:31 PM', '0', 'assets/barcode_images/796275537042-pbarcode.png', 1),
(84, '969935535812', 'MK9010MERCHSANDOYPSXL', 'MK9 SANDO YOUR PAWS EXTRA LARGE ', 'YOUR PAWS LOGO | XL', 0, 0, 'SANDO', 'XL', '350.00', '123.81', '2022-02-16 02:19:05 PM', '0', 'assets/barcode_images/969935535812-pbarcode.png', 1),
(85, '799845854119', 'MK9010MERCHSANDOYPSXXL', 'MK9 SANDO YOUR PAWS EXTRA EXTRA LARGE', 'YOUR PAWS LOGO | XXL', 0, 0, 'SANDO', 'XXL', '350.00', '123.81', '2022-02-16 02:21:23 PM', '0', 'assets/barcode_images/799845854119-pbarcode.png', 1),
(86, '357190706877', 'MK9011MERCHSPAWSITIVEXS', 'MK9 SANDO PAWSITIVE  EXTRA SMALL', ' PAWSITIVE LOGO |  XS', 0, 0, 'S', 'XS', '350.00', '123.81', '2022-02-16 02:44:50 PM', '0', 'assets/barcode_images/357190706877-pbarcode.png', 2),
(87, '332176801839', 'MK9011MERCHSPAWSITIVES', 'MK9 SANDO PAWSITIVE SMALL', 'PAWSITIVE LOGO | S', 0, 0, 'S', 'S', '350.00', '123.81', '2022-02-16 02:50:04 PM', '0', 'assets/barcode_images/332176801839-pbarcode.png', 2),
(88, '709737765784', 'MK9011MERCHSANDOPAWSITIVEM', 'MK9 SANDO PAWSITIVE MEDIUM', 'PAWSITIVE LOGO | M', 60, 0, 'SANDO', 'M', '350.00', '123.81', '2022-02-16 04:08:38 PM', '0', 'assets/barcode_images/709737765784-pbarcode.png', 1),
(89, '632631532361', 'MK9011MERCHSANDOPAWSITIVEXS', 'MK9 SANDO PAWSITIVE  EXTRA SMALL', 'PAWSITIVE LOGO | XS', 0, 0, 'SANDO', 'XS', '350.00', '123.81', '2022-02-17 09:29:10 AM', '0', 'assets/barcode_images/632631532361-pbarcode.png', 1),
(90, '090173154793', 'MK9011MERCHSANDOPAWSITIVES', 'MK9 SANDO PAWSITIVE SMALL', 'PAWSITIVE LOGO | S', 0, 0, 'SANDO', 'S', '350.00', '123.81', '2022-02-17 09:49:03 AM', '0', 'assets/barcode_images/090173154793-pbarcode.png', 1),
(91, '000445190858', 'MK9011MERCHSANDOPAWSITIVEL', 'MK9 SANDO PAWSITIVE LARGE ', 'PAWSITIVE LOGO | L ', 0, 0, 'SANDO', 'L', '350.00', '123.81', '2022-02-18 08:28:54 AM', '0', 'assets/barcode_images/000445190858-pbarcode.png', 1),
(92, '455256666493', 'MK9011MERCHSANDOPAWSITIVEXL', 'MK9 SANDO PAWSITIVE EXTRA LARGE ', 'PAWSITIVE |  XL ', 0, 0, 'SANDO', 'XL', '350.00', '123.81', '2022-02-18 08:33:52 AM', '0', 'assets/barcode_images/455256666493-pbarcode.png', 1),
(93, '052057423528', 'MK9012MERCHFMMK9REDFZ', 'MK9 FACEMASK RED  FREE SIZE ', 'MK9 FACEMASK | RED ', 0, 0, 'FM', 'FZ', '150', '37.50', '2022-03-09 11:14:20 AM', '0', 'assets/barcode_images/052057423528-pbarcode.png', 2),
(94, '553691430335', 'MK9012MERCHFMMK9BLACKFZ', 'MK9 FACEMASK BLACK FREE SIZE', 'MK9 FACEMASK | BLACK', 0, 0, 'FM', 'FZ', '150', '37.50', '2022-03-09 11:15:54 AM', '0', 'assets/barcode_images/553691430335-pbarcode.png', 2),
(95, '843371961293', 'MK9012MERCHFMMK9GRAYFZ', 'MK9 FACEMASK GRAY FREE SIZE ', 'MK9 FACEMASK | GRAY\r\n', 0, 0, 'FM', 'FZ', '150', '37.50', '2022-03-09 11:16:45 AM', '0', 'assets/barcode_images/843371961293-pbarcode.png', 2),
(96, '848221451239', 'MK9012MERCHFMMK9GOLDREDFZ', 'MK9 FACEMASK GOLD RED FREE SIZE ', 'MK9 FACEMASK | GOLD RED\r\n', 0, 0, 'FM', 'FZ', '150.00', '37.50', '2022-03-09 11:18:59 AM', '0', 'assets/barcode_images/848221451239-pbarcode.png', 2),
(97, '488979674166', 'MK9012MERCHFMMK9REDFS', 'MK9 FACEMASK RED  FREE SIZE ', 'MK9 FACEMASK | RED', 0, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:38:13 AM', '0', 'assets/barcode_images/488979674166-pbarcode.png', 1),
(98, '727034093861', 'MK9012MERCHFMMK9BLACKFS', 'MK9 FACEMASK BLACK FREE SIZE', 'MK9 FACEMASK | BLACK ', 0, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:39:01 AM', '0', 'assets/barcode_images/727034093861-pbarcode.png', 1),
(99, '037283241294', 'MK9012MERCHFMMK9GRAYFS', 'MK9 FACEMASK GRAY FREE SIZE ', 'MK9 FACEMASK | GRAY ', 0, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:39:36 AM', '0', 'assets/barcode_images/037283241294-pbarcode.png', 1),
(100, '698151169290', 'MK9012MERCHFMMK9 GOLD REDFS', 'MK9 FACEMASK GOLD RED FREE SIZE ', 'MK9 FACEMASK | GOLD RED ', 0, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:40:21 AM', '0', 'assets/barcode_images/698151169290-pbarcode.png', 2),
(101, '334938794184', 'MK9012MERCHFMMK9GOLDREDFS', 'MK9 FACEMASK GOLD RED FREE SIZE ', 'MK9 FACEMASK | GOLD RED', 0, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:44:34 AM', '0', 'assets/barcode_images/334938794184-pbarcode.png', 1),
(102, '416711264764', 'MK9012MERCHFMICGDWHITEFS', 'MK9 FACEMASK ICGD WHITE FREE SIZE ', 'MK9 FACEMASK | ICGD WHITE', 0, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:45:09 AM', '0', 'assets/barcode_images/416711264764-pbarcode.png', 1),
(103, '669944895489', 'MK9012MERCHFMICGDBLACKFS', 'MK9  FACEMASK  ICGD BLACK FREE SIZE ', 'MK9  FACEMASK  | ICGD BLACK ', 0, 0, 'FM', 'FS', '150.00', '37.50', '2022-03-09 11:45:48 AM', '0', 'assets/barcode_images/669944895489-pbarcode.png', 1),
(104, '953145585349', 'MK9 SJ013MERCHSJMK9SJWHITEFS', 'MK9 SPORTS JUG WHITE FREE SIZE ', 'MK9 SPORTS JUG | WHITE ', 0, 0, 'SJ', 'FS', '250.00', '100.00', '2022-03-09 11:52:47 AM', '0', 'assets/barcode_images/953145585349-pbarcode.png', 2),
(105, '035817487583', 'MK9 SJ013MERCHSJMK9SJSILVEFS', 'MK9 SPORTS JUG SILVER FREESIZE ', 'SPORTS JUG | SILVER', 0, 0, 'SJ', 'FS', '250.00', '100.00', '2022-03-09 11:54:30 AM', '0', 'assets/barcode_images/035817487583-pbarcode.png', 2),
(106, '563634177885', 'MK9UMB014MERCHUMBMK9UMBWHITEFS', 'MK9 UMBRELLA  WHITE  FREESIZE ', 'MK9 UMBRELLA  | WHITE ', 0, 0, 'UMB', 'FS', '200.00', '100.00', '2022-03-09 01:02:04 PM', '0', 'assets/barcode_images/563634177885-pbarcode.png', 2),
(107, '344970933874', 'MK9UMB014MERCHUMBUMBWHITEFS', 'MK9 UMBRELLA  WHITE  FREESIZE ', 'MK9 UMBRELLA  | WHITE  ', 0, 0, 'UMB', 'FS', '200.00', '100.00', '2022-03-09 01:03:44 PM', '0', 'assets/barcode_images/344970933874-pbarcode.png', 2),
(108, '911763444406', 'MK9 MC015MERCHMCMCBWFS', 'MK9 MESH CAP BLACK AND WHITE ', 'MESH CAP | BLACK AND WHITE ', 0, 0, 'MC', 'FS', '200.00', '85.00', '2022-03-09 01:18:57 PM', '0', 'assets/barcode_images/911763444406-pbarcode.png', 2),
(109, '782068011912', 'MC015MERCHMCMCBWFS', 'MK9 MESH CAP BLACK AND WHITE', 'MK9 MESH CAP | BLACK AND WHITE', 0, 0, 'MC', 'FS', '200.00', '85.00', '2022-03-09 01:28:09 PM', '0', 'assets/barcode_images/782068011912-pbarcode.png', 2),
(110, '085243664870', 'MK9MC015MERCHMCMCBWFS', 'MK9 MESH CAP BLACK AND WHITE ', 'MK9 MESH CAP | BLACK AND WHITE', 0, 0, 'MC', 'FS', '200.00', '85.00', '2022-03-09 01:30:44 PM', '0', 'assets/barcode_images/085243664870-pbarcode.png', 2),
(111, '369348302449', 'MK9014MERCHUMBWHITEFS', 'MK9 UMBRELLA  WHITE  FREESIZE ', 'MK9 UMBRELLA | WHITE ', 0, 0, 'UMB', 'FS', '200.00', '100.00', '2022-03-09 02:05:33 PM', '0', 'assets/barcode_images/369348302449-pbarcode.png', 1),
(112, '478607429771', 'MK9015MERCHMCBLACK&WHITEFS', 'MK9 MESH CAP BLACK AND WHITE FREESIZE ', 'MK9 MESH CAP | BLACK AND WHITE  ', 0, 0, 'MC', 'FS', '200.00', '85.00', '2022-03-09 02:14:20 PM', '0', 'assets/barcode_images/478607429771-pbarcode.png', 1),
(113, '412935801982', 'MK9016MERCHALARMYGREENADULTFS', 'MK9 LEASH ARMY GREEN ADULT ', 'MK9 LEASH | ARMY GREEN ADULT ', 0, 0, 'AL', 'FS', '1200.00', '450.00', '2022-03-09 02:20:27 PM', '0', 'assets/barcode_images/412935801982-pbarcode.png', 2),
(114, '109044199381', 'MK9016MERCHALBLACKADULTFS', 'MK9 LEASH BLACK ADULT ', 'MK9 LEASH | BLACK ADULT ', 0, 0, 'AL', 'FS', '1200', '450.00', '2022-03-09 02:21:23 PM', '0', 'assets/barcode_images/109044199381-pbarcode.png', 2),
(115, '806099910158', 'MK9016MERCHALBEIGEADULTFS', 'MK9 LEASH BEIGE ADULT ', 'MK9 LEASH | BEIGE ADULT ', 0, 0, 'AL', 'FS', '1200.00', '450.00', '2022-03-09 02:22:04 PM', '0', 'assets/barcode_images/806099910158-pbarcode.png', 2),
(116, '939956457637', 'MK9016MERCHLEASHARMYGREENADULTAS', 'MK9 LEASH ARMY GREEN ADULT ', 'MK9 LEASH | ARMY GREEN ADULT ', 0, 0, 'LEASH', 'AS', '1200', '450.00', '2022-03-09 02:40:57 PM', '0', 'assets/barcode_images/939956457637-pbarcode.png', 2),
(117, '759968444574', 'MK9016MERCHLEASHBLACKADULTAS', 'MK9 LEASH BLACK ADULT ', 'MK9 LEASH | BLACK ADULT ', 0, 0, 'LEASH', 'AS', '1200.00', '450.00', '2022-03-09 02:41:30 PM', '0', 'assets/barcode_images/759968444574-pbarcode.png', 2),
(118, '715587590197', 'MK9016MERCHLEASHBEIGEADULTAS', 'MK9 LEASH BEIGE ADULT ', 'MK9 LEASH BEIGE ADULT ', 0, 0, 'LEASH', 'AS', '1200.00', '450.00', '2022-03-09 02:42:04 PM', '0', 'assets/barcode_images/715587590197-pbarcode.png', 2),
(119, '569253218928', 'MK9017MERCHCOLLARARMYGREENADULTAS', 'MK9 COLLAR ARMY GREEN ADULT ', 'MK9 COLLAR | ARMY GREEN ADULT ', 0, 0, 'COLLAR', 'AS', '2200.00', '800', '2022-03-09 02:54:02 PM', '0', 'assets/barcode_images/569253218928-pbarcode.png', 2),
(120, '249979617010', 'MK9017MERCHCOLLARBLACKADULTAS', 'MK9 COLLAR BLACK ADULT ', 'MK9 COLLAR | BLACK ADULT ', 0, 0, 'COLLAR', 'AS', '2200.00', '800', '2022-03-09 02:56:05 PM', '0', 'assets/barcode_images/249979617010-pbarcode.png', 2),
(121, '437154435534', 'MK9020MERCHMUGSUPPERDOGGERSMUGFS', 'MK9 MUG SUPERDOGGERS  FREE SIZE ', 'MK9 MUG | SUPERDOGGERS  ', 0, 0, 'MUG', 'FS', '250.00', '100.00', '2022-03-09 03:58:18 PM', '0', 'assets/barcode_images/437154435534-pbarcode.png', 2),
(122, '907192492323', 'MK9020MERCHMGSUPPERDOGGERSMUGFS', 'MK9 MUG SUPERDOGGERS  FREE SIZE ', 'MK9 MUG | SUPERDOGGERS', 0, 0, 'MG', 'FS', '250.00', '100.00', '2022-03-09 04:12:11 PM', '0', 'assets/barcode_images/907192492323-pbarcode.png', 1),
(123, '024433665861', 'MK9020MERCHMGMANALOK9LOGOMUGFS', 'MK9 MUG MANALO K9 FREE SIZE', 'MK9 MUG | MANALO K9 ', 190, 0, 'MG', 'FS', '200.00', '74.00', '2022-03-09 04:14:20 PM', '0', 'assets/barcode_images/024433665861-pbarcode.png', 1),
(124, '337284131266', 'MK9020MERCHMGMAGICMUGFS', 'MK9 MAGIC MUG FREESIZE ', 'MK9 | MAGIC MUG ', 0, 0, 'MG', 'FS', '350.00', '99.00', '2022-03-09 04:18:01 PM', '0', 'assets/barcode_images/337284131266-pbarcode.png', 1),
(125, '724146198274', 'MK9 SJ013MERCHSJWHITEFS', 'MK9 SPORTS JUG WHITE FREESIZE ', 'MK9 SPORTS JUG | WHITE', 0, 0, 'SJ', 'FS', '250.00', '65.00', '2022-03-16 04:36:56 PM', '0', 'assets/barcode_images/724146198274-pbarcode.png', 2),
(126, '681473379354', 'MK9 013MERCHSJWHITEFS', 'MK9 SPORTS JUG WHITE FREESIZE ', 'MK9 SPORTS JUG | WHITE ', 0, 0, 'SJ', 'FS', '250.00', '65.00', '2022-03-16 04:42:19 PM', '0', 'assets/barcode_images/681473379354-pbarcode.png', 2),
(127, '544331347118', 'MK90021MERCHBAGWHITEBAG WHITE10', 'MK9 CANVASS BAG WHITE   10\"X 12\"', 'MK9 CANVASS BAG WHITE  | 10\"X 12\"', 0, 0, 'BAGWHITE', '10', '150.00', '65.00', '2022-03-17 03:46:02 PM', '0', 'assets/barcode_images/544331347118-pbarcode.png', 2),
(128, '164769382756', 'MK90021MERCHCANBAGCANBAG10', 'MK9 CANVASS BAG WHITE  ', 'MK9 CANVASS BAG | WHITE 10\"X12\"', 0, 0, 'CANBAG', '10', '150.00', '65.00', '2022-03-17 03:50:30 PM', '0', 'assets/barcode_images/164769382756-pbarcode.png', 1),
(129, '968946069589', 'MK9 013MERCHSPOJUGWHITEFS', 'MK9 SPORTS JUG WHITE ', 'MK9 SPORTS JUG | WHITE ', 0, 0, 'SPOJUG', 'FS', '250.00', '65.00', '2022-03-17 03:53:54 PM', '0', 'assets/barcode_images/968946069589-pbarcode.png', 1),
(130, '823244491743', 'MK9 013MERCHSPOJUGSILVERFS', 'MK9 SPORTS JUG SILVER ', 'MK9 SPORTS JUG | SILVER ', 0, 0, 'SPOJUG', 'FS', '250.00', '65.00', '2022-03-17 03:54:28 PM', '0', 'assets/barcode_images/823244491743-pbarcode.png', 1),
(131, '383840947492', 'MK9016MERCHLEASHARMYGREENAS', 'MK9 LEASH ARMY GREEN ', 'MK9 LEASH | ARMY GREEN ADULT', 0, 0, 'LEASH', 'AS', '1200.00', '450.00', '2022-03-17 03:56:16 PM', '0', 'assets/barcode_images/383840947492-pbarcode.png', 1),
(132, '217842264471', 'MK9016MERCHLEASHBLACKAS', 'MK9 LEASH BLACK', 'MK9 LEASH | BLACK ADULT', 0, 0, 'LEASH', 'AS', '1200.00', '450.00', '2022-03-17 03:57:09 PM', '0', 'assets/barcode_images/217842264471-pbarcode.png', 1),
(133, '269500872673', 'MK9016MERCHLEASHBEIGEAS', 'MK9 LEASH BEIGE ', 'MK9 LEASH | BEIGE ADULT', 0, 0, 'LEASH', 'AS', '1200.00', '450.00', '2022-03-17 03:58:01 PM', '0', 'assets/barcode_images/269500872673-pbarcode.png', 1),
(134, '740127167506', 'MK9017MERCHCOLLARARMYGREENAS', 'MK9 COLLAR ARMY GREEN', 'MK9 COLLAR | ARMY GREEN ADULT', 70, 10, 'COLLAR', 'AS', '2200.00', '800.00', '2022-03-17 04:05:08 PM', '0', 'assets/barcode_images/740127167506-pbarcode.png', 1),
(135, '709101705714', 'MK9017MERCHCOLLARBLACKAS', 'MK9 COLLAR BLACK ', 'MK9 COLLAR | BLACK ADULT', 0, 0, 'COLLAR', 'AS', '2200.00', '800.00', '2022-03-17 04:05:53 PM', '0', 'assets/barcode_images/709101705714-pbarcode.png', 1),
(136, '918793886681', 'MK9017MERCHCOLLARBEIGEAS', 'MK9 COLLAR BEIGE ', 'MK9 COLLAR | BEIGE ADULT', 0, 0, 'COLLAR', 'AS', '2200.00', '800.00', '2022-03-17 04:06:41 PM', '0', 'assets/barcode_images/918793886681-pbarcode.png', 1),
(137, '130001403748', 'MK9016MERCHLEASHPUPPBLACKPPS', 'MK9 LEASH PUPPY BLACK', 'MK9 LEASH PUPPY | BLACK', 0, 0, 'LEASH', 'PPS', '1000.00', '320.00', '2022-03-18 02:47:42 PM', '0', 'assets/barcode_images/130001403748-pbarcode.png', 1),
(138, '084864035440', 'MK9016MERCHLEASHPUPPREDPPS', 'MK9 LEASH PUPPY RED ', 'MK9 LEASH PUPPY | RED ', 0, 0, 'LEASH', 'PPS', '1000.00', '320.00', '2022-03-18 02:49:29 PM', '0', 'assets/barcode_images/084864035440-pbarcode.png', 1),
(139, '046419359251', 'MK9016MERCHLEASHPUPPGRAYPPS', 'MK9 LEASH PUPPY GRAY ', 'MK9 LEASH PUPPY | GRAY ', 50, 0, 'LEASH', 'PPS', '1000.00', '320.00', '2022-03-18 02:50:40 PM', '0', 'assets/barcode_images/046419359251-pbarcode.png', 1),
(140, '752730284099', 'MK9016MERCHLEASHPUPPYELLOWPPS', 'MK9 LEASH PUPPY | YELLOW', 'MK9 LEASH PUPPY | YELLOW', 0, 0, 'LEASH', 'PPS', '1000.00', '320.00', '2022-03-18 02:51:30 PM', '0', 'assets/barcode_images/752730284099-pbarcode.png', 1),
(141, '744832546774', 'MK9016MERCHLEASHPUPPBROWNPPS', 'MK9 LEASH PUPPY BROWN ', 'MK9 LEASH PUPPY | BROWN ', 0, 0, 'LEASH', 'PPS', '1000.00', '320.00', '2022-03-18 02:52:15 PM', '0', 'assets/barcode_images/744832546774-pbarcode.png', 1),
(142, '485472207141', 'MK9016MERCHLEASHPUPPARMYGREENPPS', 'MK9 LEASH  PUPPY ARMY GREEN ', 'MK9 LEASH  PUPPY | ARMY GREEN ', 0, 0, 'LEASH', 'PPS', '1000.00', '320.00', '2022-03-18 02:53:09 PM', '0', 'assets/barcode_images/485472207141-pbarcode.png', 1),
(143, '465699736305', 'MK9017MERCHCOLLARPUPPBLACKPPS', 'MK9 COLLAR PUPPY BLACK ', 'MK9 COLLAR PUPPY | BLACK ', 0, 0, 'COLLAR', 'PPS', '1100.00', '500.00', '2022-03-18 02:55:51 PM', '0', 'assets/barcode_images/465699736305-pbarcode.png', 1),
(144, '684322337198', 'MK9017MERCHCOLLARPUPPREDPPS', 'MK9 COLLAR PUPPY RED ', 'MK9 COLLAR PUPPY | RED ', 0, 0, 'COLLAR', 'PPS', '1100.00', '500', '2022-03-18 03:00:12 PM', '0', 'assets/barcode_images/684322337198-pbarcode.png', 1),
(145, '606477495407', 'MK9017MERCHCOLLARPUPPGRAYPPS', 'MK9 COLLAR PUPPY GRAY', 'MK9 COLLAR PUPPY | GRAY', 0, 0, 'COLLAR', 'PPS', '1100.00', '500.00', '2022-03-18 03:01:07 PM', '0', 'assets/barcode_images/606477495407-pbarcode.png', 1),
(146, '072989953372', 'MK9017MERCHCOLLARPUPPYELLOWAS', 'MK9 COLLAR PUPPY YELLOW ', 'MK9 COLLAR PUPPY | YELLOW ', 0, 0, 'COLLAR', 'AS', '1100.00', '500.00', '2022-03-18 03:02:18 PM', '0', 'assets/barcode_images/072989953372-pbarcode.png', 1),
(147, '942301192534', 'MK9017MERCHCOLLARPUPPBROWNPPS', 'MK9 COLLAR PUPPY BROWN ', 'MK9 COLLAR PUPPY | BROWN ', 0, 0, 'COLLAR', 'PPS', '1100.00', '500.00', '2022-03-18 03:03:12 PM', '0', 'assets/barcode_images/942301192534-pbarcode.png', 1),
(148, '892182929487', 'MK9017MERCHCOLLARPUPPARMYGREENPPS', ' MK9 COLLAR PUPPY ARMY GREEN', ' MK9 COLLAR PUPPY | ARMY GREEN', 0, 0, 'COLLAR', 'PPS', '1100.00', '500.00', '2022-03-18 03:04:49 PM', '0', 'assets/barcode_images/892182929487-pbarcode.png', 1),
(149, '116890230329', 'MS022MERCHTSMSBRXS', ' META SHIRT XS', 'META SHIRT ROUND | XS', 0, 0, 'TS', 'XS', '500', '157', '2022-03-25 01:45:56 PM', '0', 'assets/barcode_images/116890230329-pbarcode.png', 1),
(150, '754664155939', 'MS022MERCHTSMSBRS', 'META SHIRT SMALL', 'META SHIRT ROUND | S', 0, 0, 'TS', 'S', '500', '157', '2022-03-25 01:46:57 PM', '0', 'assets/barcode_images/754664155939-pbarcode.png', 1),
(151, '036184520117', 'MS022MERCHTSMSBRM', 'META SHIRT MEDIUM', 'META SHIRT ROUND | M', 0, 0, 'TS', 'M', '500', '157', '2022-03-25 01:47:43 PM', '0', 'assets/barcode_images/036184520117-pbarcode.png', 1);

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
(1, 'SHS004HSPRMPINK150G', 'SHS004HSPRMPINK150G-6261E3774E239', NULL, 1, 0, 125, '31.00', 0, '2022/04/22 07:05:31', '2022-04-22 07:06:31 AM', 1, NULL, '61a5caf447cae', '3875', 0, 0),
(2, 'SDN001DFPRMORIG1KG', 'SDN001DFPRMORIG1KG-6261E377C0AC6', NULL, 2, 0, 100, '109.24', 0, '2022/04/22 07:05:41', '2022-04-22 07:06:31 AM', 1, NULL, '61a5caf447cae', '10924', 0, 0),
(3, 'MK9020MERCHMGMANALOK9LOGOMUGFS', 'MK9020MERCHMGMANALOK9LOGOMUGFS-6261E37846CD3', NULL, 3, 0, 190, '74.00', 0, '2022/04/22 07:05:51', '2022-04-22 07:06:32 AM', 1, NULL, '61a5caf447cae', '14060', 0, 0),
(4, 'MK9017MERCHCOLLARARMYGREENAS', 'MK9017MERCHCOLLARARMYGREENAS-6261E378A89FD', NULL, 4, 0, 80, '800.00', 0, '2022/04/22 07:05:59', '2022-04-22 07:06:32 AM', 1, NULL, '61a5caf447cae', '64000', 0, 0),
(5, 'MK9016MERCHLEASHPUPPGRAYPPS', 'MK9016MERCHLEASHPUPPGRAYPPS-6261E3790E25F', NULL, 5, 0, 50, '320.00', 0, '2022/04/22 07:06:07', '2022-04-22 07:06:33 AM', 1, NULL, '61a5caf447cae', '16000', 0, 0),
(6, 'MK9011MERCHSANDOPAWSITIVEM', 'MK9011MERCHSANDOPAWSITIVEM-6261E3796A7C9', NULL, 6, 0, 60, '123.81', 0, '2022/04/22 07:06:16', '2022-04-22 07:06:33 AM', 1, NULL, '61a5caf447cae', '7428.6', 0, 0),
(7, 'SHS004HSPRMPINK150G', 'SHS004HSPRMPINK150G-6261E50ED0323', 'SO6261E50EC3BDE', 1, 1, 15, '150.00', 0, '2022/04/22 07:13:18', '2022-04-22 07:13:18', 1, '2022-04-22 09:47:04', '61a5caf447cae', '2250', 0, 0),
(8, 'MK9017MERCHCOLLARARMYGREENAS', 'MK9017MERCHCOLLARARMYGREENAS-6261E50EDB71F', 'SO6261E50EC3BDE', 4, 1, 10, '2200.00', 0, '2022/04/22 07:13:18', '2022-04-22 07:13:18', 1, '2022-04-22 09:47:04', '61a5caf447cae', '22000', 0, 0),
(9, 'SDS002DSPRMYP150 G', 'SDS002DSPRMYP150 G-62620250E4DD2', NULL, 7, 0, 30, '31.5', 0, '2022/04/22 09:17:27', '2022-04-22 09:18:08 AM', 1, NULL, '61a5caf447cae', '945', 0, 0),
(10, 'SDS002DSPRMYP150 G', 'SDS002DSPRMYP150 G-626202516DA63', NULL, 8, 0, 20, '35', 0, '2022/04/22 09:18:00', '2022-04-22 09:18:09 AM', 1, NULL, '61a5caf447cae', '700', 0, 0),
(11, 'SDS002DSPRMYP150 G', 'SDS002DSPRMYP150 G-626202AF30F9F', NULL, 7, 1, 30, '150.00', 0, '2022/04/22 09:19:43', '2022-04-22 09:19:43 AM', 1, NULL, '61a5caf447cae', '4500', 0, 0),
(12, 'SDN001DFPRMORIG1KG', 'SDN001DFPRMORIG1KG-6262043789E0A', NULL, 2, 1, 2, '259.75', 0, '2022/04/22 09:26:15', '2022-04-22 09:26:15', 0, NULL, '61a5caf447cae', '519.5', 0, 0),
(13, 'SDS002DSPRMYP150 G', 'SDS002DSPRMYP150 G-626204658A285', NULL, 8, 1, 5, '150.00', 0, '2022/04/22 09:27:01', '2022-04-22 09:27:01', 2, NULL, '61a5caf447cae', '750', 0, 0),
(14, 'SHS004HSPRMPINK150G', 'SHS004HSPRMPINK150G-626204A395794', NULL, 1, 1, 5, '150.00', 0, '2022/04/22 09:28:03', '2022-04-22 09:28:03', 0, NULL, '61a5caf447cae', '750', 0, 0);

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
(107, 'MK9UMB014MERCHUMBMK9UMBWHITEFS', 'MK9UMB', 'MK9 UMBRELLA  ', '014', 'UMBRELLA', 'MERCH', 'UMB', 'MK9UMBWHITE', 'FS'),
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
(152, 'MS022MERCHTSMSBRM', 'MS', 'META SHIRT', '022', 'T-SHIRT', 'MERCH', 'TS', 'MSBR', 'M');

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
  `Freebie` int(11) DEFAULT 0 COMMENT '0=no;1=yes;'
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
  `Status` int(11) NOT NULL DEFAULT 1 COMMENT '0=not accepted;1=accepted;'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_stocks`
--

INSERT INTO `product_stocks` (`ID`, `UID`, `Product_SKU`, `Stocks`, `Current_Stocks`, `Released_Stocks`, `Retail_Price`, `Price_PerItem`, `Total_Price`, `Manufactured_By`, `Description`, `Expiration_Date`, `Date_Added`, `UserID`, `Status`) VALUES
(1, '577207308284', 'SHS004HSPRMPINK150G', '125', '110', '15', '150.00', '31.00', '3875', '', '', '', '2022/04/22 07:05:31', '61a5caf447cae', 1),
(2, '065568322251', 'SDN001DFPRMORIG1KG', '100', '100', '0', '259.75', '109.24', '10924', '', '', '', '2022/04/22 07:05:41', '61a5caf447cae', 1),
(3, '024433665861', 'MK9020MERCHMGMANALOK9LOGOMUGFS', '190', '190', '0', '200.00', '74.00', '14060', '', '', '', '2022/04/22 07:05:51', '61a5caf447cae', 1),
(4, '740127167506', 'MK9017MERCHCOLLARARMYGREENAS', '80', '70', '10', '2200.00', '800.00', '64000', '', '', '', '2022/04/22 07:05:59', '61a5caf447cae', 1),
(5, '046419359251', 'MK9016MERCHLEASHPUPPGRAYPPS', '50', '50', '0', '1000.00', '320.00', '16000', '', '', '', '2022/04/22 07:06:07', '61a5caf447cae', 1),
(6, '709737765784', 'MK9011MERCHSANDOPAWSITIVEM', '60', '60', '0', '350.00', '123.81', '7428.6', '', '', '', '2022/04/22 07:06:16', '61a5caf447cae', 1),
(7, '389509193021', 'SDS002DSPRMYP150 G', '30', '0', '30', '150.00', '31.5', '945', '', '', '', '2022/04/22 09:17:27', '61a5caf447cae', 1),
(8, '389509193021', 'SDS002DSPRMYP150 G', '20', '20', '0', '150.00', '35', '700', '', '', '', '2022/04/22 09:18:00', '61a5caf447cae', 1);

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
(1, 'PO6262030FC3B23', '2022-04-22 09:20:00', '2022-04-22 09:21:19', 'V6262030FC3E21', 'Test', '2022-04-22', NULL, '250', NULL, 1);

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
(1, 'RP626204379812B', 'SDN001DFPRMORIG1KG-6262043789E0A', '2022/04/22 09:26:15', 'SO6261E50EC3BDE', '109.24', '259.75', 0),
(2, 'RP6262046594758', 'SDS002DSPRMYP150 G-626204658A285', '2022/04/22 09:27:01', 'SO6261E50EC3BDE', '35', '150.00', 0),
(3, 'RP626204A39F97F', 'SHS004HSPRMPINK150G-626204A395794', '2022/04/22 09:28:03', 'SO6261E50EC3BDE', '31.00', '150.00', 1);

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
  `price` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL,
  `userid` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `date_added` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_history`
--

INSERT INTO `sales_history` (`id`, `stockid`, `transactionid`, `uid`, `prd_sku`, `quantity`, `price`, `total_price`, `userid`, `date_added`, `status`) VALUES
(1, '1', 'SHS004HSPRMPINK150G-6261E3774E239', '577207308284', 'SHS004HSPRMPINK150G', '125', '150.00', '18750', '61a5caf447cae', '2022/04/22 07:06:31', 'restocked'),
(2, '2', 'SDN001DFPRMORIG1KG-6261E377C0AC6', '065568322251', 'SDN001DFPRMORIG1KG', '100', '259.75', '25975', '61a5caf447cae', '2022/04/22 07:06:31', 'restocked'),
(3, '3', 'MK9020MERCHMGMANALOK9LOGOMUGFS-6261E37846CD3', '024433665861', 'MK9020MERCHMGMANALOK9LOGOMUGFS', '190', '200.00', '38000', '61a5caf447cae', '2022/04/22 07:06:32', 'restocked'),
(4, '4', 'MK9017MERCHCOLLARARMYGREENAS-6261E378A89FD', '740127167506', 'MK9017MERCHCOLLARARMYGREENAS', '80', '2200.00', '176000', '61a5caf447cae', '2022/04/22 07:06:32', 'restocked'),
(5, '5', 'MK9016MERCHLEASHPUPPGRAYPPS-6261E3790E25F', '046419359251', 'MK9016MERCHLEASHPUPPGRAYPPS', '50', '1000.00', '50000', '61a5caf447cae', '2022/04/22 07:06:33', 'restocked'),
(6, '6', 'MK9011MERCHSANDOPAWSITIVEM-6261E3796A7C9', '709737765784', 'MK9011MERCHSANDOPAWSITIVEM', '60', '350.00', '21000', '61a5caf447cae', '2022/03/22 07:06:33', 'restocked'),
(8, '7', 'SDS002DSPRMYP150 G-62620250E4DD2', '389509193021', 'SDS002DSPRMYP150 G', '30', '150.00', '4500', '61a5caf447cae', '2022/04/22 09:18:09', 'restocked'),
(9, '8', 'SDS002DSPRMYP150 G-626202516DA63', '389509193021', 'SDS002DSPRMYP150 G', '20', '150.00', '3000', '61a5caf447cae', '2022/04/22 09:18:09', 'restocked'),
(10, '7', 'SDS002DSPRMYP150 G-626202AF30F9F', '389509193021', 'SDS002DSPRMYP150 G', '30', '150.00', '4500', '61a5caf447cae', '2022/04/22 09:19:43', 'released'),
(13, '1', 'SHS004HSPRMPINK150G-6261E50ED0323', '577207308284', 'SHS004HSPRMPINK150G', '15', '150', '2250', '61a5caf447cae', '2022/04/22 09:47:04', 'released'),
(14, '1', 'SHS004HSPRMPINK150G-6261E50ED0323', '577207308284', 'SHS004HSPRMPINK150G', '15', '0', '0', '61a5caf447cae', '2022/04/22 09:47:04', 'discount'),
(15, '4', 'MK9017MERCHCOLLARARMYGREENAS-6261E50EDB71F', '740127167506', 'MK9017MERCHCOLLARARMYGREENAS', '10', '2200', '22000', '61a5caf447cae', '2022/04/22 09:47:04', 'released'),
(16, '4', 'MK9017MERCHCOLLARARMYGREENAS-6261E50EDB71F', '740127167506', 'MK9017MERCHCOLLARARMYGREENAS', '10', '0', '0', '61a5caf447cae', '2022/04/22 09:47:04', 'discount');

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
(1, 'SO6261E50EC3BDE', '2022-04-22 07:12:00', '2022-04-22 07:13:18', 'C6249A37492296', 'C6249A37492296', '2022-04-22', '2022-04-22 07:13:32', '2022-04-22 09:46:57', '2022-04-22 09:47:05', '2022-04-22 09:47:10', 0, 0, 0, 0, '-2975750', NULL, 5);

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
(1, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-04-22 07:03:15 AM'),
(2, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-04-22 07:04:55 AM'),
(3, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/returns', '2022-04-22 07:12:25 AM'),
(4, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 07:12:41 AM'),
(5, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2022-04-22 07:13:18 AM'),
(6, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 07:13:19 AM'),
(7, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 07:13:22 AM'),
(8, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_approveSalesOrder', '2022-04-22 07:13:32 AM'),
(9, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 07:13:33 AM'),
(10, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewSOAdtlFee', '2022-04-22 07:14:08 AM'),
(11, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 07:14:09 AM'),
(12, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 07:15:14 AM'),
(13, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 07:15:17 AM'),
(14, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 07:17:10 AM'),
(15, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 07:17:12 AM'),
(16, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 07:18:18 AM'),
(17, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 07:18:29 AM'),
(18, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 07:19:54 AM'),
(19, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 07:19:57 AM'),
(20, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 07:20:47 AM'),
(21, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 07:24:51 AM'),
(22, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 07:27:57 AM'),
(23, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 07:30:59 AM'),
(24, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 07:33:56 AM'),
(25, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 07:34:22 AM'),
(26, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-04-22 07:34:26 AM'),
(27, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_settings_bcat', '2022-04-22 07:34:31 AM'),
(28, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-04-22 09:16:20 AM'),
(29, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 09:20:11 AM'),
(30, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 09:20:15 AM'),
(31, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 09:20:23 AM'),
(32, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2022-04-22 09:20:28 AM'),
(33, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 09:20:44 AM'),
(34, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addPurchaseOrder', '2022-04-22 09:21:19 AM'),
(35, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 09:21:20 AM'),
(36, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-04-22 09:21:22 AM'),
(37, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewManualTransaction', '2022-04-22 09:22:01 AM'),
(38, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-04-22 09:22:02 AM'),
(39, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-04-22 09:23:21 AM'),
(40, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/returns', '2022-04-22 09:24:43 AM'),
(41, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 09:24:57 AM'),
(42, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:24:59 AM'),
(43, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/returns', '2022-04-22 09:25:10 AM'),
(44, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/replacements', '2022-04-22 09:25:45 AM'),
(45, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 09:25:47 AM'),
(46, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:25:49 AM'),
(47, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewReplacement', '2022-04-22 09:26:15 AM'),
(48, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:26:15 AM'),
(49, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_approveReplacement', '2022-04-22 09:26:30 AM'),
(50, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:26:31 AM'),
(51, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-04-22 09:26:42 AM'),
(52, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:26:48 AM'),
(53, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewReplacement', '2022-04-22 09:27:01 AM'),
(54, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:27:01 AM'),
(55, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_approveReplacement', '2022-04-22 09:27:13 AM'),
(56, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:27:14 AM'),
(57, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-04-22 09:27:16 AM'),
(58, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:27:22 AM'),
(59, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/FORM_removeReplacement', '2022-04-22 09:27:37 AM'),
(60, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:27:38 AM'),
(61, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-04-22 09:27:42 AM'),
(62, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:27:49 AM'),
(63, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewReplacement', '2022-04-22 09:28:03 AM'),
(64, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:28:03 AM'),
(65, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2022-04-22 09:28:06 AM'),
(66, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 09:28:23 AM'),
(67, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:28:24 AM'),
(68, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 09:28:50 AM'),
(69, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:32:09 AM'),
(70, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 09:32:45 AM'),
(71, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 09:33:44 AM'),
(72, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:33:48 AM'),
(73, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:34:23 AM'),
(74, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 09:34:26 AM'),
(75, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 09:34:50 AM'),
(76, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/replacements', '2022-04-22 09:35:50 AM'),
(77, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 09:35:56 AM'),
(78, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-04-22 09:35:58 AM'),
(79, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-04-22 09:37:16 AM'),
(80, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-04-22 09:37:19 AM'),
(81, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 09:39:23 AM'),
(82, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-04-22 09:39:25 AM'),
(83, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 09:40:06 AM'),
(84, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-04-22 09:40:08 AM'),
(85, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-04-22 09:41:12 AM'),
(86, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 09:41:32 AM'),
(87, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-04-22 09:41:37 AM'),
(88, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:42:02 AM'),
(89, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 09:42:06 AM'),
(90, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 09:43:07 AM'),
(91, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-04-22 09:43:09 AM'),
(92, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:45:14 AM'),
(93, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 09:45:25 AM'),
(94, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 09:46:16 AM'),
(95, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:46:19 AM'),
(96, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 09:46:51 AM'),
(97, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:46:52 AM'),
(98, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_scheduleDelivery', '2022-04-22 09:46:57 AM'),
(99, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:46:58 AM'),
(100, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_markDelivered', '2022-04-22 09:47:04 AM'),
(101, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:47:05 AM'),
(102, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_markReceived', '2022-04-22 09:47:10 AM'),
(103, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:47:11 AM'),
(104, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:47:16 AM'),
(105, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 09:47:19 AM'),
(106, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 09:47:45 AM'),
(107, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:47:47 AM'),
(108, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/FORM_removeSOAdtlFee', '2022-04-22 09:48:16 AM'),
(109, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:48:16 AM'),
(110, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:48:31 AM'),
(111, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 09:48:34 AM'),
(112, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 09:50:23 AM'),
(113, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 09:50:25 AM'),
(114, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:50:40 AM'),
(115, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-04-22 09:51:29 AM'),
(116, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:52:10 AM'),
(117, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-04-22 09:52:16 AM'),
(118, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:52:39 AM'),
(119, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 09:52:43 AM'),
(120, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:54:56 AM'),
(121, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 09:55:18 AM'),
(122, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 09:55:43 AM'),
(123, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:55:44 AM'),
(124, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 09:55:45 AM'),
(125, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:55:56 AM'),
(126, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 09:56:18 AM'),
(127, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:57:33 AM'),
(128, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 09:57:47 AM'),
(129, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 09:58:11 AM'),
(130, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 10:00:40 AM'),
(131, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:07:57 AM'),
(132, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 10:08:27 AM'),
(133, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 10:08:48 AM'),
(134, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:09:33 AM'),
(135, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 10:11:09 AM'),
(136, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 10:11:13 AM'),
(137, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 10:11:54 AM'),
(138, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 10:12:03 AM'),
(139, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 10:15:25 AM'),
(140, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 10:15:50 AM'),
(141, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 10:16:10 AM'),
(142, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-04-22 10:26:50 AM'),
(143, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 10:26:54 AM'),
(144, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-04-22 10:26:58 AM'),
(145, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 10:26:59 AM'),
(146, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 10:28:37 AM'),
(147, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2022-04-22 10:28:39 AM'),
(148, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 10:29:31 AM'),
(149, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-04-22 10:30:17 AM'),
(150, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 10:31:52 AM'),
(151, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:32:40 AM'),
(152, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 10:32:42 AM'),
(153, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 10:33:41 AM'),
(154, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-04-22 10:33:43 AM'),
(155, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:34:22 AM'),
(156, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-22 10:34:23 AM'),
(157, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 10:35:16 AM'),
(158, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_summary', '2022-04-22 10:35:18 AM'),
(159, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 10:35:51 AM'),
(160, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-04-22 10:36:34 AM'),
(161, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 10:36:37 AM'),
(162, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 10:36:39 AM'),
(163, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 10:37:22 AM'),
(164, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:38:54 AM'),
(165, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-22 10:38:56 AM'),
(166, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2022-04-22 10:41:21 AM'),
(167, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2022-04-22 10:41:29 AM'),
(168, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:41:33 AM'),
(169, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-22 10:41:34 AM'),
(170, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:42:29 AM'),
(171, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 10:42:30 AM'),
(172, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:42:55 AM'),
(173, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-22 10:42:56 AM'),
(174, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:43:02 AM'),
(175, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 10:43:04 AM'),
(176, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:43:23 AM'),
(177, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-22 10:43:25 AM'),
(178, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:43:31 AM'),
(179, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-22 10:43:32 AM'),
(180, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:43:36 AM'),
(181, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 10:43:38 AM'),
(182, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:43:45 AM'),
(183, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 10:43:52 AM'),
(184, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSOInvoice', '2022-04-22 10:44:02 AM'),
(185, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 10:44:03 AM'),
(186, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:44:05 AM'),
(187, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2022-04-22 10:44:07 AM'),
(188, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2022-04-22 10:44:09 AM'),
(189, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_summary', '2022-04-22 10:44:10 AM'),
(190, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2022-04-22 10:47:27 AM'),
(191, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/income_statement', '2022-04-22 10:48:13 AM'),
(192, '61a5caf447cae', 'Desktop: Chrome 100.0.4896.127', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2022-04-22 10:52:16 AM');

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
(1, '61a5caf447cae', 'assets/images/faces/1.jpg', 'John', 'Rogers', 'Doe', 'Jr', '1989-06-22', '09123456789', '123 Tester City', '', '3', '2022-03-31 01:47:29 AM'),
(2, '62424e1258eb0', 'assets/images/faces/1.jpg', 'EDNA', 'MARIE', 'REYES', 'MS EDS', '', '', '', '', '2', '2022-03-30 01:52:45 PM'),
(3, '624252639e2e5', 'assets/images/faces/1.jpg', 'RAEVEN', 'SOTTO', 'LOTEYRO', 'RAEVEN ', '', '', '', '', '2', '2022-03-30 12:32:04 PM');

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
(1, '61a5caf447cae', 'test_admin@gmail.com', '$2y$10$rpcXGsyKl6bjAlhlyjE8uupwib.8omu/FLrVim6SS54ZhQpWYxsMm', '2022-04-22 10:52:16'),
(2, '62424e1258eb0', 'ednarmanalok9@gmail.com', '$2y$10$1CM/iWIo6T4lnZRfnZVikOlxijzNMWoBrTgfdmQWYqUwOXXYMUmMS', '2022-03-30 15:55:43'),
(3, '624252639e2e5', 'raevenandrei18@hotmail.com', '$2y$10$5m6mTD1euku6GuNHbV80K.tfvmupvYZmPCI9qMPTeLQSYljR436pe', '2022-03-29 00:33:19');

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

INSERT INTO `user_restrictions` (`ID`, `UserID`, `products_view`, `products_add`, `products_edit`, `products_delete`, `releasing_view`, `releasing_scan_add_stock`, `releasing_manual_add_stock`, `restocking_view`, `restocking_scan_add_stock`, `restocking_manual_add_stock`, `restocking_update_stock`, `restocking_delete_stock`, `restocking_cart_functions`, `inventory_view`, `users_view`, `users_add`, `users_edit`, `users_edit_login`, `users_activities`, `vendors_view`, `vendors_add`, `vendors_edit`, `vendors_delete`, `purchase_orders_view`, `purchase_orders_add`, `purchase_orders_add_manual_transaction`, `purchase_orders_remove_manual_transaction`, `purchase_orders_approve`, `purchase_orders_bill_creation`, `purchase_orders_accounting`, `purchase_orders_remarks`, `bills_view`, `bills_add`, `bills_delete`, `manual_purchases_view`, `clients_view`, `clients_add`, `clients_edit`, `clients_delete`, `sales_orders_view`, `sales_orders_add`, `sales_orders_mark_for_invoicing`, `sales_orders_schedule_delivery`, `sales_orders_mark_as_delivered`, `sales_orders_mark_as_received`, `sales_orders_invoice_creation`, `sales_orders_accounting`, `sales_orders_remarks`, `sales_orders_adtl_fees`, `invoice_view`, `invoice_add`, `invoice_delete`, `returns_view`, `returns_add`, `return_product_view`, `return_product_add`, `return_product_delete`, `replacements_view`, `replacements_add`, `replacements_approve`, `replacements_delete`, `accounts_view`, `accounts_add`, `accounts_edit`, `journal_transactions_view`, `journal_transactions_add`, `journal_transactions_delete`, `branding_view`, `branding_add`, `branding_edit`, `branding_delete`, `mail_view`, `mail_add`, `my_activities_view`, `trash_bin_view`, `trash_bin_retrieve`, `trash_bin_delete`) VALUES
(1, '61a5caf447cae', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, '62424e1258eb0', 1, 1, 1, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1),
(3, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, '624252639e2e5', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1);

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
(1, 'V624998FFADE64', 'Jane', '123', '123', '123', '123', '123@123.123', 1),
(2, 'V6262030FC3E21', 'Jane', 'Test', 'Test', 'Test', 'Test', 'Test@Test', 1);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `adtl_fees`
--
ALTER TABLE `adtl_fees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_category`
--
ALTER TABLE `brand_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `brand_properties`
--
ALTER TABLE `brand_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `brand_size`
--
ALTER TABLE `brand_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `brand_vcpd`
--
ALTER TABLE `brand_vcpd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `cart_release`
--
ALTER TABLE `cart_release`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_restocking`
--
ALTER TABLE `cart_restocking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `journal_transactions`
--
ALTER TABLE `journal_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `logbook`
--
ALTER TABLE `logbook`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `manual_transactions`
--
ALTER TABLE `manual_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `products_transactions`
--
ALTER TABLE `products_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `product_returned`
--
ALTER TABLE `product_returned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `replacements`
--
ALTER TABLE `replacements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_history`
--
ALTER TABLE `sales_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `security_log`
--
ALTER TABLE `security_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `tb_mailsent`
--
ALTER TABLE `tb_mailsent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_login_history`
--
ALTER TABLE `users_login_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_registrations`
--
ALTER TABLE `users_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_restrictions`
--
ALTER TABLE `user_restrictions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
