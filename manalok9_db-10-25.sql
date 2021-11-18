-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 24, 2021 at 03:52 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id17300669_inventory_db`
--

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
  `TerritoryManager` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`ID`, `ClientNo`, `Name`, `TIN`, `Address`, `CityStateProvinceZip`, `Country`, `ContactNum`, `Category`, `TerritoryManager`) VALUES
(1, 'C-000001', 'Client Name', 'TIN #', 'Test Address', 'City', 'Count', '09123456789', 0, 'Mngr Test'),
(2, 'C-000002', 'Client Name 1', 'TIN # 1', 'Test Address 1', 'City', 'Count', '09123456789 1', 0, 'Mngr Test 1'),
(3, 'C-000003', 'Client Name 2', 'TIN # 2', 'Test Address 2', 'City', 'Count', '09123456789 2', 1, 'Mngr Test 2'),
(4, 'C-000004', 'Name', 'TIN', 'Address', 'City', 'Count', 'Contact', 2, 'Territory'),
(5, 'C-000005', 'NameTest', 'TINTest', 'AddressTest', 'CityTest', 'CountryTest', 'ContactTest', 0, 'TerritoryTest'),
(6, 'C-000006', 'Tester', 'Tester', 'Tester', NULL, NULL, 'Tester', 3, 'Tester'),
(7, 'C-000007', 'NameTest', 'TINTest', 'AddressTest', 'CityTest', 'CountryTest', 'ContactTest', 3, 'TerritoryTest'),
(8, 'C-000008', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 0, 'Test');

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

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
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
  `Barcode_Images` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Code`, `Product_Name`, `Description`, `InStock`, `Released`, `Product_Category`, `Product_Weight`, `Price_PerItem`, `Cost_PerItem`, `DateAdded`, `PriceSelling`, `Barcode_Images`) VALUES
(8, 'SDN001ORIG500G', 'dog snack', 'Sample description', 0, 0, 'DOG FOOD', '500 g', '100', '150', '2021-10-18 11:54:19 AM', '0', 'assets/barcode_images/SDN001ORIG500G-pbarcode.png'),
(9, 'SDN001ORIG10KG', 'sadasd', 'dasdas', 0, 0, 'asdwdw', '100 g', '10', '20', '2021-10-22 12:57:54 AM', '0', 'assets/barcode_images/SDN001ORIG10KG-pbarcode.png');

-- --------------------------------------------------------

--
-- Table structure for table `products_transactions`
--

CREATE TABLE `products_transactions` (
  `ID` int(11) NOT NULL,
  `Code` varchar(255) DEFAULT NULL,
  `TransactionID` varchar(255) DEFAULT NULL,
  `OrderNo` varchar(255) DEFAULT NULL,
  `Type` tinyint(1) DEFAULT NULL COMMENT '0 = Restocked; 1 = Released;',
  `Amount` int(255) DEFAULT 0,
  `PriceUnit` varchar(255) DEFAULT '0',
  `InStock` int(255) DEFAULT 0,
  `Date` varchar(255) DEFAULT NULL,
  `DateAdded` varchar(255) DEFAULT NULL,
  `Status` int(11) NOT NULL COMMENT '0 = for approval\r\n1 = approved',
  `Date_Approval` varchar(255) DEFAULT NULL,
  `UserID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `Status` int(11) DEFAULT NULL COMMENT '0 = rejected; 1 = for approval; 2 = approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Status` int(11) DEFAULT NULL COMMENT '0 = rejected; 1 = for approval; 2 = approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Dumping data for table `tb_itemcode`
--

INSERT INTO `tb_itemcode` (`uniqueID`, `Brand_Top`, `Cat_Char`, `Prod_Type`, `Brand_Bot`, `Prod_Line`, `New_Type`, `Prod_Variant`, `Prod_Size`, `ItemCode`, `TimeStamp`) VALUES
('TREKJSx9yJsv9OdEesqiSS9faTMyTEesaYqGfVf6X0CY', 'SDN', '001', 'DOG FOOD', 'SDN', 'DOG FOOD', 'PREMIUM', 'ORIGINAL', '500 G', 'SDN001ORIG500G', 'Asia/Manila'),
('lK3rp8pINH0Td3lQV5mMvOAn1cclOfGgvBBV8lqWF343', 'SDN', 'sad', 'asdwdw', 'SDN', 'dsadas', 'asdasdas', 'ORIGINAL', '10 KG', 'SDN001ORIG10KG', 'Asia/Manila');

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
(1, '60bc6643380bb', 'uploads/60bc6643380bb/119885521_653071058972274_4010704502296133963_n.jpg', 'chiruno', '', 'borger', '', '', '', '', '', '1', '2021-09-08 09:36:06 PM'),
(3, '60bf510d64ba8', 'uploads/60bf510d64ba8/image5.jpg', 'first', 'middle', 'last', 'name ext', '2021-06-02', '1231233a2', '', '', '2', '2021-07-24 09:25:14 AM'),
(6, '6117f910ce15a', 'assets/images/faces/1.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-08-15 01:10:41 AM');

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
(1, '60bf510d64ba8', 'admin', '$2y$10$wwa2SWPK1P1E.24TsBJUGu7Xn8eRBDliJkxeMMeo8QoHc1wGks7ie'),
(2, '60bc6643380bb', 'borgir', '$2y$10$yNYdn.5KwqTYUvRldqDMQeNmqq5pJG.mb2LNftqHFjll/WOw/2AKG');

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
(1, '60bc6643380bb', 'borgir', NULL, 'Desktop: Firefox 90.0', 'Windows 10', '127.0.0.1', 1, '2021-08-18 11:38:42 PM'),
(2, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-02 09:20:24 PM'),
(3, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-04 08:56:15 PM'),
(4, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-06 11:39:30 AM'),
(5, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-06 12:00:51 PM'),
(6, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-06 08:48:21 PM'),
(7, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-07 06:08:02 PM'),
(8, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-08 06:53:56 PM'),
(9, NULL, 'borgir', 'borgirborgir', 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 0, '2021-09-08 09:29:38 PM'),
(10, '60bc6643380bb', 'borgir', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-08 09:29:42 PM'),
(11, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-08 09:31:15 PM'),
(12, '60bc6643380bb', 'borgir', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-08 09:32:23 PM'),
(13, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-08 09:32:54 PM'),
(14, '60bc6643380bb', 'borgir', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-08 09:36:17 PM'),
(15, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-08 09:36:33 PM'),
(16, '60bc6643380bb', 'borgir', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-08 09:37:17 PM'),
(17, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-08 09:37:35 PM'),
(18, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-09 06:34:00 PM'),
(19, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-10 08:35:25 PM'),
(20, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-11 02:48:22 PM'),
(21, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-11 08:00:56 PM'),
(22, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-16 01:58:54 PM'),
(23, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-16 06:18:51 PM'),
(24, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-16 09:08:09 PM'),
(25, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-18 11:52:27 AM'),
(26, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-20 08:20:54 AM'),
(27, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-20 12:04:26 PM'),
(28, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-20 08:56:31 PM'),
(29, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-21 11:18:30 AM'),
(30, '60bf510d64ba8', 'admin', NULL, 'Desktop: Firefox 91.0', 'Windows 10', '127.0.0.1', 1, '2021-09-21 04:22:10 PM'),
(31, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 93.0.4577.82', 'Windows 10', '::1', 1, '2021-09-22 03:39:23 PM'),
(32, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 93.0.4577.82', 'Windows 10', '::1', 1, '2021-09-22 03:55:14 PM'),
(33, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 93.0.4577.82', 'Windows 10', '::1', 1, '2021-09-22 06:21:12 PM'),
(34, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 93.0.4577.82', 'Windows 10', '::1', 1, '2021-09-22 06:24:04 PM'),
(35, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 93.0.4577.82', 'Windows 10', '::1', 1, '2021-09-22 06:41:36 PM'),
(36, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 93.0.4577.82', 'Windows 10', '::1', 1, '2021-09-22 06:49:04 PM'),
(37, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 93.0.4577.82', 'Windows 10', '::1', 1, '2021-09-22 06:59:56 PM'),
(38, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 89.0.4389.72', 'Windows 10', '::1', 1, '2021-09-22 07:01:13 PM'),
(39, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 93.0.4577.82', 'Windows 10', '::1', 1, '2021-09-22 07:16:20 PM'),
(40, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 93.0.4577.82', 'Windows 10', '::1', 1, '2021-09-22 07:28:09 PM'),
(41, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 93.0.4577.82', 'Windows 10', '::1', 1, '2021-09-22 08:44:52 PM'),
(42, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 94.0.4606.61', 'Windows 10', '::1', 1, '2021-09-30 03:44:23 PM'),
(43, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 94.0.4606.61', 'Windows 10', '::1', 1, '2021-09-30 03:47:22 PM'),
(44, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 94.0.4606.61', 'Windows 10', '::1', 1, '2021-09-30 06:52:20 PM'),
(45, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 94.0.4606.61', 'Windows 10', '::1', 1, '2021-09-30 06:53:50 PM'),
(46, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 94.0.4606.61', 'Windows 10', '::1', 1, '2021-09-30 06:55:18 PM'),
(47, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 94.0.4606.61', 'Windows 10', '::1', 1, '2021-09-30 06:55:31 PM'),
(48, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 94.0.4606.61', 'Windows 10', '::1', 1, '2021-09-30 06:56:50 PM'),
(49, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 94.0.4606.71', 'Windows 10', '::1', 1, '2021-10-09 02:01:52 PM'),
(50, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 94.0.4606.71', 'Windows 10', '::1', 1, '2021-10-11 05:58:13 PM'),
(51, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 94.0.4606.71', 'Windows 10', '::1', 1, '2021-10-12 01:07:27 AM'),
(52, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 94.0.4606.81', 'Windows 10', '::1', 1, '2021-10-14 07:41:41 PM'),
(53, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 94.0.4606.81', 'Windows 10', '::1', 1, '2021-10-18 11:49:51 AM'),
(54, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 94.0.4606.81', 'Windows 10', '::1', 1, '2021-10-20 07:19:13 PM'),
(55, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 1, '2021-10-21 01:50:00 PM'),
(56, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 1, '2021-10-21 09:57:47 PM'),
(57, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 1, '2021-10-21 11:18:11 PM');

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
  `ProductServiceKind` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`ID`, `VendorNo`, `Name`, `TIN`, `Address`, `ContactNum`, `ProductServiceKind`) VALUES
(1, 'V-000001', 'Test Vendor', 'TIN #', 'Test Address', '09123456789', 'Merch'),
(2, 'V-000002', 'Test Vendor 1', 'TIN # 1', 'Test Address 1', '09123456789 1', 'Merch 1'),
(3, 'V-000003', 'Test Vendor 2', 'TIN # 2', 'Test Address 2', '09123456789 2', 'Merch 2'),
(4, 'V-000004', 'Test', 'Test', 'Test', 'Test', 'Test'),
(5, 'V-000005', 'Name', 'TIN', 'Address', 'Contact', 'Kind'),
(6, 'V-000006', 'test', 'test', 'test', 'test', 'test'),
(7, 'V-000007', 'NameTest', 'TINTest', 'AddressTest', 'ContactTest', 'KindTest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `logbook`
--
ALTER TABLE `logbook`
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
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `logbook`
--
ALTER TABLE `logbook`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products_transactions`
--
ALTER TABLE `products_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `security_log`
--
ALTER TABLE `security_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_login_history`
--
ALTER TABLE `users_login_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
