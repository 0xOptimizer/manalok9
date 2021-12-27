-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 27, 2021 at 11:38 AM
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
(0, 'Accounts Receivable', '1', 'accounts receivable'),
(1, 'test', '2', 'try'),
(2, 'Cash', '1', 'cash'),
(3, 'Fuel and oil', '1', 'fuel + oil\r\n'),
(4, 'Rental Expense', '3', 'expense'),
(5, 'Utilities Expense', '3', 'utilities'),
(6, 'Sales', '0', 'sales'),
(7, 'Purchases', '3', 'purchases'),
(8, 'Office Supplies', '1', 'office supplies'),
(9, 'Accounts Payable', '2', 'accounts payable');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `ID` int(11) NOT NULL,
  `BillNo` varchar(255) DEFAULT NULL,
  `OrderNo` varchar(255) DEFAULT NULL,
  `Amount` varchar(255) DEFAULT NULL,
  `ModeOfPayment` varchar(255) DEFAULT NULL,
  `Date` varchar(50) DEFAULT NULL
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
(1, 'SUPER DOG NUTRITION', '001', 'DOG FOOD', 'JwwWrJLbURsr0Yv91v3535'),
(2, 'SUPER DOG SOAP', '002', 'DOG SOAP', '8X8Tmm3yMrc26heuilTJVt');

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
(1, 'JwwWrJLbURsr0Yv91v3535', 'SDN', 'DGFD', 'DOG FOOD', 'DGFD', 'PREMIUM', 'PREM', NULL, NULL, NULL, NULL),
(2, '8X8Tmm3yMrc26heuilTJVt', 'SDS', 'DS', 'DOG SOAP', 'DS', 'PREMIUM', 'PRM', NULL, NULL, NULL, NULL);

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
(3, 'JwwWrJLbURsr0Yv91v3535', '10KG', '10KG'),
(4, 'JwwWrJLbURsr0Yv91v3535', '20KG', '20KG'),
(5, 'JwwWrJLbURsr0Yv91v3535', '30KG', '30KG'),
(6, '8X8Tmm3yMrc26heuilTJVt', '150 G', '150G'),
(7, '8X8Tmm3yMrc26heuilTJVt', '300 G', '300G');

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
(6, 'JwwWrJLbURsr0Yv91v3535', 'ORIGINAL', 'ORIG'),
(7, 'JwwWrJLbURsr0Yv91v3535', 'CLONE', 'CL'),
(8, 'JwwWrJLbURsr0Yv91v3535', 'HALF', 'HF'),
(9, '8X8Tmm3yMrc26heuilTJVt', '5 IN 1 ORIGINAL', '51O'),
(10, '8X8Tmm3yMrc26heuilTJVt', '3 IN 1', '31O');

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

--
-- Dumping data for table `cart_release`
--

INSERT INTO `cart_release` (`cart_id`, `user_id`, `item_code`, `quantity`, `total_price`, `time_stamp`, `status`) VALUES
(33, '60bf510d64ba8', 'SDN001ORIG10KG', '10', '100', '2021-11-03 01:13:01', 1),
(34, '60bf510d64ba8', 'SDN001ORIG10KG', '10', '100', '2021-11-03 01:20:59', 1),
(35, '60bf510d64ba8', 'SDN001ORIG10KG', '10', '100', '2021-11-03 01:22:16', 1),
(36, '60bf510d64ba8', 'SDN001ORIG500G', '50', '5000', '2021-11-03 01:24:11', 1),
(37, '60bf510d64ba8', 'SDN001ORIG500G', '10', '1000', '2021-11-03 01:45:38', 1),
(38, '60bf510d64ba8', 'SDN001DGFDPREMORIG10KG', '100', '200', '2021-12-10 18:50:13', 1),
(39, '60bf510d64ba8', 'SDS002DSPRM51O300G', '100', '15000', '2021-12-16 16:34:22', 1),
(40, '60bf510d64ba8', 'SDS002DSPRM51O300G', '10', '1500', '2021-12-16 16:34:52', 1),
(41, '60bf510d64ba8', 'SDN001DGFDPREMORIG10KG', '50', '6000', '2021-12-23 11:02:21', 0);

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
(8, 'C-000008', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 0, 'Test'),
(9, 'C-000009', 'test11', '58872', 'antipoyo', 'tsda', 'test', '02825', 2, 'Tester');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `ID` int(11) NOT NULL,
  `InvoiceNo` varchar(255) DEFAULT NULL,
  `OrderNo` varchar(255) DEFAULT NULL,
  `Amount` varchar(255) DEFAULT NULL,
  `ModeOfPayment` varchar(255) DEFAULT NULL,
  `Date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`ID`, `InvoiceNo`, `OrderNo`, `Amount`, `ModeOfPayment`, `Date`) VALUES
(2, 'I-000001', 'SO-000001', '4500', 'Cash', '2021-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `ID` int(11) NOT NULL,
  `Date` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Total` varchar(255) DEFAULT NULL,
  `Type` varchar(127) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`ID`, `Date`, `Description`, `Total`, `Type`) VALUES
(1, '2021-12-20', 'payment', NULL, NULL),
(2, '2021-12-20', 'Rent payment', NULL, NULL),
(3, '2021-12-20', 'Cash sales', NULL, 'RELEASE'),
(4, '2021-12-20', 'Purchase on account', NULL, 'RESTOCK'),
(5, '2021-12-20', 'Purchase of office supplies', NULL, NULL),
(6, '2021-12-20', 'Payment of utilities', NULL, NULL),
(7, '2021-12-20', 'Sales on credit', NULL, 'RELEASE'),
(8, '2021-12-01', 'Restocking - December', NULL, NULL),
(9, '2021-12-20', 'Cash payment for AR', NULL, NULL),
(10, '2021-12-20', 'Sales cash', NULL, 'RELEASE'),
(11, '2021-12-21', 'Purchase Cash', NULL, 'RESTOCK'),
(12, '2021-12-21', 'Sales Cash', NULL, 'RELEASE');

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
(1, 1, 2, '100', '0'),
(2, 1, 9, '0', '100'),
(3, 2, 4, '1000', '0'),
(4, 2, 2, '0', '01000'),
(5, 3, 2, '2000', '0'),
(6, 3, 6, '0', '2000'),
(7, 4, 7, '3000', '0'),
(8, 4, 9, '0', '3000'),
(9, 5, 8, '1500', '0'),
(10, 5, 2, '0', '1500'),
(11, 6, 5, '1000', '0'),
(12, 6, 2, '0', '1000'),
(13, 7, 0, '02000', '0'),
(14, 7, 6, '0', '02000'),
(15, 8, 7, '50000', '0'),
(16, 8, 2, '0', '50000'),
(17, 9, 2, '2000', '0'),
(18, 9, 0, '0', '2000'),
(19, 10, 2, '10000', '0'),
(20, 10, 6, '0', '10000'),
(21, 11, 7, '500', '0'),
(22, 11, 2, '0', '500'),
(23, 12, 6, '200', '0'),
(24, 12, 2, '0', '200');

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
(1, 'approved purchase order.', 'approved purchase order PO-000004 [PurchaseOrderID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_purchase_order?orderNo=PO-000004', '2021-12-23 10:56:48 AM'),
(2, 'added new transaction.', 'released 10 for  SDS002DSPRM51O300G [TransactionID: SDS002DSPRM51O300G-61C3E6C22D0F9].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SDS002DSPRM51O300G', '2021-12-23 11:02:26 AM'),
(3, 'created a new sales order.', 'added sales order SO-000003 [SalesOrderID: 3].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 11:20:40 AM'),
(4, 'approved sales order.', 'approved sales order SO-000003 [SalesOrderID: 3].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000003', '2021-12-23 11:21:35 AM'),
(5, 'scheduled delivery.', 'scheduled delivery for sales order [No: SO-000003].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000003', '2021-12-23 11:22:33 AM'),
(6, 'marked SO as delivered.', 'sales order marked as delivered [No: SO-000003].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000003', '2021-12-23 11:24:35 AM'),
(7, 'created a new user.', 'added a new user Test Test Test [UserID: 61c3f4a7912c4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 12:01:45 PM'),
(8, 'updated user details.', 'updated details of user Test Test Test [UserID: 61c3f4a7912c4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 03:24:05 PM'),
(9, 'updated user details.', 'updated details of user Test Test Test [UserID: 61c3f4a7912c4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 03:25:28 PM'),
(10, 'updated user details.', 'updated details of user Test Test Test [UserID: 61c3f4a7912c4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 03:27:57 PM'),
(11, 'updated user details.', 'updated details of user Test Test Test [UserID: 61c3f4a7912c4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 03:29:11 PM'),
(12, 'updated user details.', 'updated details of user Test Test Test [UserID: 61c3f4a7912c4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 03:31:00 PM'),
(13, 'updated user details.', 'updated details of user Test Test Test [UserID: 61c3f4a7912c4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 03:34:26 PM'),
(14, 'updated user details.', 'updated details of user Test Test Test [UserID: 61c3f4a7912c4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 03:49:02 PM'),
(15, 'updated user details.', 'updated details of user Test Test Test [UserID: 61c3f4a7912c4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 03:49:46 PM'),
(16, 'updated user details.', 'updated details of user first middle last [UserID: 60bf510d64ba8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 03:54:50 PM'),
(17, 'created a new user.', 'added a new user Tester Tester Tester [UserID: 61c42b794f0b1].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 03:55:39 PM'),
(18, 'created a new user.', 'added a new user Joker Joker Joker [UserID: 61c42c3d66939].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 03:58:54 PM'),
(19, 'updated user details.', 'updated details of user Joker Joker Joker [UserID: 61c42c3d66939].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 04:04:54 PM'),
(20, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 04:23:20 PM'),
(21, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 04:28:03 PM'),
(22, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 04:28:54 PM'),
(23, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 04:31:13 PM'),
(24, 'updated user details.', 'updated details of user first middle last [UserID: 60bf510d64ba8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 04:33:30 PM'),
(25, 'updated user details.', 'updated details of user Testing Testing Testing [UserID: 6117f910ce15a].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 04:40:37 PM'),
(26, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 04:41:55 PM'),
(27, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 04:41:58 PM'),
(28, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 04:43:27 PM'),
(29, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 04:43:32 PM'),
(30, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 04:46:58 PM'),
(31, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 04:47:02 PM'),
(32, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 04:55:25 PM'),
(33, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 04:55:30 PM'),
(34, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:01:49 PM'),
(35, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:01:58 PM'),
(36, 'updated user details.', 'updated details of user first middle last [UserID: 60bf510d64ba8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 05:02:16 PM'),
(37, 'updated user details.', 'updated details of user first middle last [UserID: 60bf510d64ba8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 05:03:45 PM'),
(38, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:03:54 PM'),
(39, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:03:59 PM'),
(40, 'updated user details.', 'updated details of user first middle last [UserID: 60bf510d64ba8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 05:04:55 PM'),
(41, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:06:06 PM'),
(42, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:06:10 PM'),
(43, 'updated user details.', 'updated details of user first middle last [UserID: 60bf510d64ba8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 05:06:36 PM'),
(44, 'updated user details.', 'updated details of user first middle last [UserID: 60bf510d64ba8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 05:09:46 PM'),
(45, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:09:49 PM'),
(46, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:09:53 PM'),
(47, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:11:19 PM'),
(48, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:11:24 PM'),
(49, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:11:51 PM'),
(50, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:11:54 PM'),
(51, 'updated user details.', 'updated details of user first middle last [UserID: 60bf510d64ba8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 05:12:09 PM'),
(52, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:12:16 PM'),
(53, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:12:18 PM'),
(54, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:15:52 PM'),
(55, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:15:54 PM'),
(56, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:16:18 PM'),
(57, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:16:20 PM'),
(58, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:16:49 PM'),
(59, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:16:51 PM'),
(60, 'created a new purchase order.', 'added purchase order PO-000005 [PurchaseOrderID: 5].', '60bf510d64ba8', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 05:35:01 PM'),
(61, 'created a new sales order.', 'added sales order SO-000004 [SalesOrderID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 05:44:15 PM'),
(62, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:56:39 PM'),
(63, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:56:41 PM'),
(64, 'updated user details.', 'updated details of user first middle last [UserID: 60bf510d64ba8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 05:57:29 PM'),
(65, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:57:50 PM'),
(66, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:57:52 PM'),
(67, 'approved sales order.', 'approved sales order SO-000004 [SalesOrderID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000004', '2021-12-23 05:58:03 PM'),
(68, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:58:41 PM'),
(69, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:58:43 PM'),
(70, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:59:36 PM'),
(71, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:59:37 PM'),
(72, 'logged out.', '', '60bf510d64ba8', '', '2021-12-23 05:59:55 PM'),
(73, 'logged in.', '', '60bf510d64ba8', '', '2021-12-23 05:59:58 PM'),
(74, 'scheduled delivery.', 'scheduled delivery for sales order [No: SO-000004].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000004', '2021-12-23 06:00:11 PM'),
(75, 'marked SO as delivered.', 'sales order marked as delivered [No: SO-000004].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000004', '2021-12-23 06:00:14 PM'),
(76, 'marked SO as received.', 'sales order marked as received [No: SO-000004].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000004', '2021-12-23 06:00:17 PM'),
(77, 'updated user details.', 'updated details of user first middle last [UserID: 60bf510d64ba8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-12-23 06:11:22 PM'),
(78, 'logged in.', '', '60bf510d64ba8', '', '2021-12-27 06:31:04 PM');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `U_ID` int(11) DEFAULT NULL,
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
(21, 2147483647, 'SDS002DSPRM51O300G', 'manalo dog soap', 'manalo dog soap 300 grams', 50, 200, 'PRM', '300G', '150', '100', '2021-12-16 04:30:03 PM', '0', 'assets/barcode_images/836744295551-pbarcode.png', 1),
(22, 2147483647, 'SDN001DGFDPREMORIG10KG', 'tset', 'tst', 25, 25, 'PREM', '10KG', '120', '100', '2021-12-18 02:10:45 PM', '0', 'assets/barcode_images/165139543215-pbarcode.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_transactions`
--

CREATE TABLE `products_transactions` (
  `ID` int(11) NOT NULL,
  `Code` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
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
  `UserID` varchar(255) DEFAULT NULL,
  `PriceTotal` varchar(255) DEFAULT NULL,
  `JournalID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_transactions`
--

INSERT INTO `products_transactions` (`ID`, `Code`, `TransactionID`, `OrderNo`, `Type`, `Amount`, `PriceUnit`, `InStock`, `Date`, `DateAdded`, `Status`, `Date_Approval`, `UserID`, `PriceTotal`, `JournalID`) VALUES
(43, 'SDS002DSPRM51O300G', 'SDS002DSPRM51O300G-61BAF9F4EE9B6', NULL, 0, 150, '150', 0, '', '2021-12-16 04:33:56 PM', 1, NULL, '60bf510d64ba8', '22500', NULL),
(44, 'SDS002DSPRM51O300G', 'SDS002DSPRM51O300G-61BAFA378DD18', NULL, 1, 100, '150', 0, '2021-12-16 16:34:22', '2021-12-16 04:35:03 PM', 1, NULL, '60bf510d64ba8', '15000', NULL),
(45, 'SDS002DSPRM51O300G', 'SDS002DSPRM51O300G-000003', 'SO-000001', 1, 40, '150', 0, '2021-12-16', '2021-12-16 04:40:41 PM', 1, '2021-12-16-16-41-08', '60bf510d64ba8', NULL, NULL),
(46, 'SDS002DSPRM51O300G', 'SDS002DSPRM51O300G-000004', 'PO-000002', 0, 0, '100', 0, '2021-12-16', '2021-12-16 04:53:50 PM', 1, '2021-12-21-09-52-37', '60bf510d64ba8', NULL, NULL),
(47, 'SDS002DSPRM51O300G', 'SDS002DSPRM51O300G-000005', 'PO-000003', 0, 100, '100', 0, '2021-12-16', '2021-12-16 04:54:06 PM', 1, '2021-12-16-16-54-12', '60bf510d64ba8', NULL, NULL),
(48, 'SDN001DGFDPREMORIG10KG', 'SDN001DGFDPREMORIG10KG-000006', 'PO-000004', 0, 100, '100', 0, '2021-12-21', '2021-12-21 10:01:15 AM', 1, '2021-12-23 10:56:48 AM', '60bf510d64ba8', NULL, NULL),
(49, 'SDS002DSPRM51O300G', 'SDS002DSPRM51O300G-000007', 'SO-000002', 1, 50, '150', 0, '2021-12-21', '2021-12-21 12:26:58 PM', 1, '2021-12-21 12:27:17 PM', '60bf510d64ba8', '7500', NULL),
(50, 'SDS002DSPRM51O300G', 'SDS002DSPRM51O300G-61C3E6C22D0F9', NULL, 1, 10, '150', 0, '2021-12-16 16:34:52', '2021-12-23 11:02:26 AM', 1, NULL, '60bf510d64ba8', '1500', NULL),
(51, 'SDN001DGFDPREMORIG10KG', 'SDN001DGFDPREMORIG10KG-000009', 'SO-000003', 1, 10, '120', 0, '2021-12-23', '2021-12-23 11:20:40 AM', 1, '2021-12-23 11:21:35 AM', '60bf510d64ba8', '1200', NULL),
(52, 'SDN001DGFDPREMORIG10KG', 'SDN001DGFDPREMORIG10KG-000010', 'PO-000005', 0, 60, '100', 0, '2021-12-23', '2021-12-23 05:35:01 PM', 0, NULL, '60bf510d64ba8', '6000', NULL),
(53, 'SDN001DGFDPREMORIG10KG', 'SDN001DGFDPREMORIG10KG-000011', 'SO-000004', 1, 15, '120', 0, '2021-12-23', '2021-12-23 05:44:15 PM', 1, '2021-12-23 05:58:03 PM', '60bf510d64ba8', '1800', NULL);

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
(14, 'SDS002DSPRM51O300G', 'SDS', 'SUPER DOG SOAP', '002', 'DOG SOAP', 'DS', 'PRM', '51O', '300G'),
(15, 'SDN001DGFDPREMORIG10KG', 'SDN', 'SUPER DOG NUTRITION', '001', 'DOG FOOD', 'DGFD', 'PREM', 'ORIG', '10KG');

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

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`ID`, `OrderNo`, `Date`, `DateCreation`, `VendorNo`, `ShipVia`, `DateDelivery`, `Status`) VALUES
(1, 'PO-000001', '2021-12-16', '2021-12-16 03:54:59 PM', 'V-000003', 'test', NULL, 1),
(2, 'PO-000002', '2021-12-16', '2021-12-16 04:53:50 PM', 'V-000001', 'test', NULL, 2),
(3, 'PO-000003', '2021-12-16', '2021-12-16 04:54:06 PM', 'V-000003', 'test', NULL, 2),
(4, 'PO-000004', '2021-12-21', '2021-12-21 10:01:15 AM', 'V-000004', 'test', NULL, 2),
(5, 'PO-000005', '2021-12-23', '2021-12-23 05:35:01 PM', 'V-000002', 'test', NULL, 1);

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
  `DateDelivery` varchar(255) DEFAULT NULL,
  `Discount` varchar(255) DEFAULT NULL COMMENT '%',
  `Status` int(11) DEFAULT NULL COMMENT '0 = rejected; 1 = for approval; 2 = approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`ID`, `OrderNo`, `Date`, `DateCreation`, `BillToClientNo`, `ShipToClientNo`, `DateDelivery`, `Discount`, `Status`) VALUES
(1, 'SO-000001', '2021-12-16', '2021-12-16 04:40:41 PM', 'C-000009', 'C-000009', '2021-12-25', '25', 5),
(2, 'SO-000002', '2021-12-21', '2021-12-21 12:26:58 PM', 'C-000006', 'C-000006', NULL, '0', 2),
(3, 'SO-000003', '2021-12-23', '2021-12-23 11:20:40 AM', 'C-000008', 'C-000008', '2021-12-23', '35', 4),
(4, 'SO-000004', '2021-12-23', '2021-12-23 05:44:15 PM', 'C-000009', 'C-000009', '2021-12-23', '0', 5);

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
(1, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 10:10:10 AM'),
(2, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 10:10:28 AM'),
(3, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:12:02 AM'),
(4, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:16:26 AM'),
(5, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:16:40 AM'),
(6, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:17:16 AM'),
(7, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:19:12 AM'),
(8, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:22:51 AM'),
(9, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:23:22 AM'),
(10, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:23:50 AM'),
(11, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:24:12 AM'),
(12, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:25:38 AM'),
(13, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:25:50 AM'),
(14, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:26:16 AM'),
(15, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:26:44 AM'),
(16, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:27:14 AM'),
(17, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:27:54 AM'),
(18, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:32:01 AM'),
(19, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:34:16 AM'),
(20, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:34:45 AM'),
(21, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:35:08 AM'),
(22, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:35:20 AM'),
(23, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:36:00 AM'),
(24, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-12-23 10:36:15 AM'),
(25, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/viewproduct', '2021-12-23 10:36:19 AM'),
(26, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-12-23 10:36:22 AM'),
(27, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/viewproduct', '2021-12-23 10:36:32 AM'),
(28, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-12-23 10:36:33 AM'),
(29, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:36:35 AM'),
(30, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:37:12 AM'),
(31, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:37:23 AM'),
(32, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:37:48 AM'),
(33, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:39:18 AM'),
(34, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:46:05 AM'),
(35, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:46:30 AM'),
(36, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:46:52 AM'),
(37, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:47:01 AM'),
(38, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:47:13 AM'),
(39, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:47:24 AM'),
(40, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:47:47 AM'),
(41, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:47:55 AM'),
(42, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:48:12 AM'),
(43, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:49:11 AM'),
(44, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:50:38 AM'),
(45, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:50:58 AM'),
(46, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:51:35 AM'),
(47, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:51:57 AM'),
(48, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:52:09 AM'),
(49, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:52:33 AM'),
(50, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 10:55:06 AM'),
(51, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2021-12-23 10:55:16 AM'),
(52, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 10:55:29 AM'),
(53, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2021-12-23 10:55:33 AM'),
(54, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_approvePurchaseOrder', '2021-12-23 10:56:48 AM'),
(55, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2021-12-23 10:56:48 AM'),
(56, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-12-23 10:57:12 AM'),
(57, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/getVendorDetails', '2021-12-23 10:57:13 AM'),
(58, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2021-12-23 10:57:14 AM'),
(59, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:57:26 AM'),
(60, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:57:48 AM'),
(61, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:57:52 AM'),
(62, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:58:16 AM'),
(63, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:58:23 AM'),
(64, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:58:56 AM'),
(65, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 10:59:46 AM'),
(66, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:00:30 AM'),
(67, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:01:05 AM'),
(68, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-12-23 11:01:51 AM'),
(69, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-12-23 11:02:04 AM'),
(70, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-12-23 11:02:08 AM'),
(71, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-12-23 11:02:11 AM'),
(72, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-12-23 11:02:15 AM'),
(73, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-12-23 11:02:23 AM'),
(74, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-12-23 11:02:26 AM'),
(75, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-12-23 11:02:26 AM'),
(76, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/remove_thisicode', '2021-12-23 11:02:42 AM'),
(77, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/settings_itemcodepage', '2021-12-23 11:02:42 AM'),
(78, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-12-23 11:02:48 AM'),
(79, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 11:03:42 AM'),
(80, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2021-12-23 11:03:44 AM'),
(81, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2021-12-23 11:04:36 AM'),
(82, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 11:04:50 AM'),
(83, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2021-12-23 11:04:53 AM'),
(84, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 11:04:55 AM'),
(85, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:05:30 AM'),
(86, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:06:04 AM'),
(87, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:06:21 AM'),
(88, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:07:16 AM'),
(89, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_settings_bcat', '2021-12-23 11:08:42 AM'),
(90, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2021-12-23 11:11:07 AM'),
(91, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2021-12-23 11:12:02 AM'),
(92, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2021-12-23 11:12:28 AM'),
(93, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2021-12-23 11:13:58 AM'),
(94, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2021-12-23 11:15:01 AM'),
(95, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2021-12-23 11:15:49 AM'),
(96, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:15:50 AM'),
(97, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2021-12-23 11:17:52 AM'),
(98, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/getJournalDetails', '2021-12-23 11:17:56 AM'),
(99, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/getJournalTransactions', '2021-12-23 11:17:57 AM'),
(100, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 11:20:10 AM'),
(101, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2021-12-23 11:20:40 AM'),
(102, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 11:20:40 AM'),
(103, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 11:20:44 AM'),
(104, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_approveSalesOrder', '2021-12-23 11:21:35 AM'),
(105, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 11:21:35 AM'),
(106, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_scheduleDelivery', '2021-12-23 11:22:33 AM'),
(107, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 11:22:33 AM'),
(108, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_markDelivered', '2021-12-23 11:24:35 AM'),
(109, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 11:24:35 AM'),
(110, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:25:06 AM'),
(111, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:34:38 AM'),
(112, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:35:20 AM'),
(113, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:37:29 AM'),
(114, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:38:45 AM'),
(115, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:38:57 AM'),
(116, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:39:53 AM'),
(117, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:41:20 AM'),
(118, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:43:11 AM'),
(119, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 11:43:57 AM'),
(120, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 12:00:28 PM'),
(121, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewUser', '2021-12-23 12:01:43 PM'),
(122, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 12:01:46 PM'),
(123, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 12:04:25 PM'),
(124, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 12:06:53 PM'),
(125, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 12:07:06 PM'),
(126, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 12:10:38 PM'),
(127, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 01:50:58 PM'),
(128, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 01:52:41 PM'),
(129, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 01:54:00 PM'),
(130, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 01:55:06 PM'),
(131, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:01:23 PM'),
(132, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:03:56 PM'),
(133, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:06:49 PM'),
(134, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:07:37 PM'),
(135, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:08:36 PM'),
(136, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:09:16 PM'),
(137, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:15:04 PM'),
(138, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:18:19 PM'),
(139, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:18:48 PM'),
(140, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:19:11 PM'),
(141, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:21:11 PM'),
(142, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:21:58 PM'),
(143, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:23:11 PM'),
(144, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:23:22 PM'),
(145, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:23:54 PM'),
(146, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:25:47 PM'),
(147, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:26:11 PM'),
(148, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:26:41 PM'),
(149, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:29:22 PM'),
(150, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:38:22 PM'),
(151, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:39:00 PM'),
(152, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:39:38 PM'),
(153, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:40:43 PM'),
(154, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:41:26 PM'),
(155, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:41:35 PM'),
(156, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:41:57 PM'),
(157, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:42:26 PM'),
(158, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:44:49 PM'),
(159, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:45:28 PM'),
(160, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:49:16 PM'),
(161, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:50:00 PM'),
(162, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:50:28 PM'),
(163, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:50:42 PM'),
(164, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:52:55 PM'),
(165, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:57:15 PM'),
(166, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 02:58:55 PM'),
(167, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:00:21 PM'),
(168, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:00:58 PM'),
(169, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:02:24 PM'),
(170, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:03:28 PM'),
(171, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:04:10 PM'),
(172, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:04:39 PM'),
(173, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:05:29 PM'),
(174, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:06:26 PM'),
(175, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:06:50 PM'),
(176, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:07:23 PM'),
(177, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:08:15 PM'),
(178, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:09:22 PM'),
(179, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:09:32 PM'),
(180, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:09:47 PM'),
(181, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:09:54 PM'),
(182, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:19:41 PM'),
(183, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:20:00 PM'),
(184, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:23:44 PM'),
(185, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 03:24:04 PM'),
(186, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:24:05 PM'),
(187, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:25:16 PM'),
(188, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 03:25:27 PM'),
(189, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:25:28 PM'),
(190, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:26:10 PM'),
(191, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:27:48 PM'),
(192, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 03:27:57 PM'),
(193, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:27:57 PM'),
(194, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:29:05 PM'),
(195, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 03:29:11 PM'),
(196, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:29:11 PM'),
(197, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 03:30:59 PM'),
(198, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:31:00 PM'),
(199, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:34:06 PM'),
(200, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 03:34:25 PM'),
(201, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:34:26 PM'),
(202, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:36:30 PM'),
(203, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:37:00 PM'),
(204, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:41:15 PM'),
(205, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-12-23 03:44:07 PM'),
(206, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:44:16 PM'),
(207, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:48:49 PM'),
(208, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 03:49:01 PM'),
(209, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:49:02 PM'),
(210, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:49:28 PM'),
(211, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 03:49:44 PM'),
(212, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:49:47 PM'),
(213, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:54:09 PM'),
(214, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 03:54:48 PM'),
(215, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:54:50 PM'),
(216, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewUser', '2021-12-23 03:55:37 PM'),
(217, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:55:39 PM'),
(218, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:58:14 PM'),
(219, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addNewUser', '2021-12-23 03:58:53 PM'),
(220, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 03:58:55 PM'),
(221, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 04:01:28 PM'),
(222, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 04:01:31 PM'),
(223, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 04:04:42 PM'),
(224, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 04:04:52 PM'),
(225, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 04:04:54 PM'),
(226, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 04:16:22 PM'),
(227, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-12-23 04:21:17 PM'),
(228, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:22:20 PM'),
(229, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:22:33 PM'),
(230, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-12-23 04:23:11 PM'),
(231, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/getVendorDetails', '2021-12-23 04:23:13 PM'),
(232, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 04:23:20 PM'),
(233, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 04:23:21 PM'),
(234, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:23:21 PM'),
(235, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:23:24 PM'),
(236, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:23:25 PM'),
(237, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:23:30 PM'),
(238, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:23:30 PM'),
(239, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounting_test', '2021-12-23 04:23:59 PM'),
(240, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:23:59 PM'),
(241, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:24:02 PM'),
(242, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:24:03 PM'),
(243, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:24:08 PM'),
(244, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:24:08 PM'),
(245, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:24:20 PM'),
(246, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:24:20 PM'),
(247, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:25:03 PM'),
(248, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:25:03 PM'),
(249, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:25:27 PM'),
(250, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:25:27 PM'),
(251, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:26:47 PM'),
(252, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:26:52 PM'),
(253, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:26:52 PM'),
(254, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:27:19 PM'),
(255, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:28:03 PM'),
(256, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:28:04 PM'),
(257, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:28:46 PM'),
(258, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:28:51 PM'),
(259, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:28:51 PM'),
(260, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 04:28:54 PM'),
(261, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 04:28:54 PM'),
(262, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:28:54 PM'),
(263, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:28:58 PM'),
(264, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:28:58 PM'),
(265, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:29:03 PM'),
(266, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:29:03 PM'),
(267, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:31:10 PM'),
(268, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:31:13 PM'),
(269, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:31:14 PM'),
(270, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:31:38 PM'),
(271, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:31:50 PM'),
(272, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:33:09 PM'),
(273, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 04:33:17 PM'),
(274, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 04:33:28 PM'),
(275, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 04:33:30 PM'),
(276, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 04:39:48 PM'),
(277, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 04:40:35 PM'),
(278, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 04:40:37 PM'),
(279, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 04:41:34 PM'),
(280, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 04:41:55 PM'),
(281, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 04:41:55 PM'),
(282, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:41:55 PM'),
(283, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:41:58 PM'),
(284, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:41:58 PM'),
(285, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:42:46 PM'),
(286, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:43:08 PM'),
(287, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 04:43:27 PM'),
(288, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 04:43:27 PM'),
(289, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:43:28 PM'),
(290, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:43:31 PM'),
(291, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:43:32 PM'),
(292, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:43:41 PM'),
(293, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:44:42 PM'),
(294, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 04:46:58 PM'),
(295, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 04:46:58 PM'),
(296, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:46:58 PM'),
(297, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:47:01 PM'),
(298, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:47:02 PM'),
(299, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:55:20 PM'),
(300, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 04:55:25 PM'),
(301, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 04:55:25 PM'),
(302, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 04:55:25 PM'),
(303, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 04:55:30 PM'),
(304, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:55:30 PM'),
(305, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:55:47 PM'),
(306, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:58:43 PM'),
(307, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:58:54 PM'),
(308, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 04:59:49 PM'),
(309, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/profile', '2021-12-23 05:01:44 PM'),
(310, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:01:49 PM'),
(311, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:01:49 PM'),
(312, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:01:49 PM'),
(313, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:01:58 PM'),
(314, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:01:58 PM'),
(315, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:02:04 PM'),
(316, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 05:02:15 PM'),
(317, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:02:16 PM'),
(318, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:03:38 PM'),
(319, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 05:03:43 PM'),
(320, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:03:46 PM'),
(321, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/profile', '2021-12-23 05:03:49 PM'),
(322, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:03:54 PM'),
(323, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:03:54 PM'),
(324, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:03:54 PM'),
(325, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:03:59 PM'),
(326, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:03:59 PM'),
(327, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:04:32 PM'),
(328, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 05:04:54 PM'),
(329, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:04:56 PM'),
(330, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:06:06 PM'),
(331, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:06:06 PM'),
(332, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:06:06 PM'),
(333, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:06:10 PM'),
(334, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:06:10 PM'),
(335, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:06:18 PM'),
(336, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 05:06:35 PM'),
(337, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:06:37 PM'),
(338, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-12-23 05:06:44 PM'),
(339, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:08:09 PM'),
(340, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:08:20 PM'),
(341, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:09:05 PM'),
(342, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:09:33 PM'),
(343, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 05:09:46 PM'),
(344, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:09:46 PM');
INSERT INTO `security_log` (`ID`, `UserID`, `Agent`, `Platform`, `IPAddress`, `Country`, `PageURL`, `DateAdded`) VALUES
(345, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:09:49 PM'),
(346, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:09:49 PM'),
(347, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:09:49 PM'),
(348, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:09:52 PM'),
(349, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:09:53 PM'),
(350, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:09:55 PM'),
(351, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:11:13 PM'),
(352, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:11:19 PM'),
(353, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:11:19 PM'),
(354, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:11:19 PM'),
(355, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:11:24 PM'),
(356, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:11:24 PM'),
(357, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:11:51 PM'),
(358, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:11:52 PM'),
(359, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:11:52 PM'),
(360, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:11:53 PM'),
(361, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:11:54 PM'),
(362, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:11:56 PM'),
(363, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 05:12:08 PM'),
(364, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:12:09 PM'),
(365, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:12:16 PM'),
(366, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:12:16 PM'),
(367, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:12:16 PM'),
(368, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:12:17 PM'),
(369, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:12:18 PM'),
(370, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:12:21 PM'),
(371, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-12-23 05:12:44 PM'),
(372, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-12-23 05:13:13 PM'),
(373, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/getVendorDetails', '2021-12-23 05:13:22 PM'),
(374, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-12-23 05:14:38 PM'),
(375, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/getVendorDetails', '2021-12-23 05:14:42 PM'),
(376, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-12-23 05:15:31 PM'),
(377, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:15:34 PM'),
(378, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:15:52 PM'),
(379, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:15:52 PM'),
(380, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:15:52 PM'),
(381, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:15:53 PM'),
(382, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:15:54 PM'),
(383, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:15:58 PM'),
(384, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:16:18 PM'),
(385, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:16:18 PM'),
(386, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:16:18 PM'),
(387, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:16:20 PM'),
(388, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:16:20 PM'),
(389, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:16:23 PM'),
(390, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-12-23 05:16:30 PM'),
(391, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-12-23 05:16:46 PM'),
(392, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:16:49 PM'),
(393, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:16:49 PM'),
(394, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:16:49 PM'),
(395, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:16:51 PM'),
(396, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:16:51 PM'),
(397, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-12-23 05:16:55 PM'),
(398, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/getVendorDetails', '2021-12-23 05:16:57 PM'),
(399, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 05:17:15 PM'),
(400, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:17:50 PM'),
(401, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-12-23 05:20:54 PM'),
(402, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:26:16 PM'),
(403, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/clients', '2021-12-23 05:26:24 PM'),
(404, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/invoices', '2021-12-23 05:28:17 PM'),
(405, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 05:29:58 PM'),
(406, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2021-12-23 05:32:38 PM'),
(407, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 05:33:13 PM'),
(408, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2021-12-23 05:33:15 PM'),
(409, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 05:34:42 PM'),
(410, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2021-12-23 05:34:44 PM'),
(411, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 05:34:47 PM'),
(412, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addPurchaseOrder', '2021-12-23 05:35:01 PM'),
(413, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 05:35:01 PM'),
(414, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_purchase_order', '2021-12-23 05:35:06 PM'),
(415, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 05:41:59 PM'),
(416, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 05:42:29 PM'),
(417, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 05:43:50 PM'),
(418, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_addSalesOrder', '2021-12-23 05:44:14 PM'),
(419, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 05:44:15 PM'),
(420, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 05:44:17 PM'),
(421, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:55:36 PM'),
(422, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:56:31 PM'),
(423, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:56:38 PM'),
(424, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:56:39 PM'),
(425, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:56:39 PM'),
(426, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:56:40 PM'),
(427, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:56:41 PM'),
(428, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:56:43 PM'),
(429, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:57:08 PM'),
(430, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 05:57:26 PM'),
(431, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 05:57:29 PM'),
(432, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:57:50 PM'),
(433, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:57:50 PM'),
(434, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:57:50 PM'),
(435, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:57:51 PM'),
(436, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:57:52 PM'),
(437, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 05:57:55 PM'),
(438, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 05:57:57 PM'),
(439, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_approveSalesOrder', '2021-12-23 05:58:03 PM'),
(440, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 05:58:04 PM'),
(441, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 05:58:37 PM'),
(442, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:58:41 PM'),
(443, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:58:41 PM'),
(444, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:58:42 PM'),
(445, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:58:43 PM'),
(446, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:58:43 PM'),
(447, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 05:58:46 PM'),
(448, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 05:58:48 PM'),
(449, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:59:36 PM'),
(450, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:59:36 PM'),
(451, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:59:36 PM'),
(452, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:59:37 PM'),
(453, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:59:37 PM'),
(454, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 05:59:40 PM'),
(455, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 05:59:42 PM'),
(456, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-12-23 05:59:55 PM'),
(457, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-12-23 05:59:56 PM'),
(458, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-23 05:59:56 PM'),
(459, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-23 05:59:57 PM'),
(460, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-23 05:59:58 PM'),
(461, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 06:00:00 PM'),
(462, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 06:00:08 PM'),
(463, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_scheduleDelivery', '2021-12-23 06:00:11 PM'),
(464, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 06:00:11 PM'),
(465, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_markDelivered', '2021-12-23 06:00:14 PM'),
(466, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 06:00:14 PM'),
(467, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_markReceived', '2021-12-23 06:00:17 PM'),
(468, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 06:00:17 PM'),
(469, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 06:00:20 PM'),
(470, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 06:00:40 PM'),
(471, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 06:00:47 PM'),
(472, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/invoices', '2021-12-23 06:00:56 PM'),
(473, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 06:01:03 PM'),
(474, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/invoices', '2021-12-23 06:01:05 PM'),
(475, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2021-12-23 06:01:12 PM'),
(476, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2021-12-23 06:02:57 PM'),
(477, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/getJournalTransactions', '2021-12-23 06:08:04 PM'),
(478, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/getJournalDetails', '2021-12-23 06:08:04 PM'),
(479, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/trash_bin', '2021-12-23 06:09:11 PM'),
(480, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/user', '2021-12-23 06:09:16 PM'),
(481, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_settings_bcat', '2021-12-23 06:09:27 PM'),
(482, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/journals', '2021-12-23 06:09:29 PM'),
(483, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/accounts', '2021-12-23 06:09:50 PM'),
(484, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/invoices', '2021-12-23 06:09:54 PM'),
(485, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/view_sales_order', '2021-12-23 06:09:58 PM'),
(486, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-12-23 06:10:00 PM'),
(487, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/clients', '2021-12-23 06:10:02 PM'),
(488, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/bills', '2021-12-23 06:10:03 PM'),
(489, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/clients', '2021-12-23 06:10:05 PM'),
(490, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/getClientDetails', '2021-12-23 06:10:06 PM'),
(491, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/getClientDetails', '2021-12-23 06:10:08 PM'),
(492, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/bills', '2021-12-23 06:10:11 PM'),
(493, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-12-23 06:10:13 PM'),
(494, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-12-23 06:10:16 PM'),
(495, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 06:10:40 PM'),
(496, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_updateUser', '2021-12-23 06:11:20 PM'),
(497, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-12-23 06:11:23 PM'),
(498, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/', '2021-12-27 06:30:59 PM'),
(499, NULL, 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-12-27 06:31:02 PM'),
(500, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-27 06:31:04 PM'),
(501, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-27 06:33:14 PM'),
(502, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-27 06:36:01 PM'),
(503, '60bf510d64ba8', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-12-27 06:36:03 PM');

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
(3, '60bf510d64ba8', 'uploads/60bf510d64ba8/image5.jpg', 'first', 'middle', 'last', 'name ext', '2021-06-02', '1231233a2', '', '', '2', '2021-12-23 06:11:20 PM'),
(6, '6117f910ce15a', 'assets/images/faces/1.jpg', 'Testing', 'Testing', 'Testing', 'Testing', '2003-06-06', 'Testing', 'Testing', 'Testing', '1', '2021-12-23 04:40:36 PM'),
(7, '61c3f4a7912c4', 'assets/images/faces/1.jpg', 'Test', 'Test', 'Test', 'Test', '2000-06-06', '09123456789', 'Test', '', '3', '2021-12-23 03:49:45 PM'),
(8, '61c42b794f0b1', 'assets/images/faces/1.jpg', 'Tester', 'Tester', 'Tester', 'Tester', '2006-06-06', 'Tester', 'Tester', '', '2', '2021-12-23 03:55:37 PM'),
(9, '61c42c3d66939', 'assets/images/faces/1.jpg', 'Joker', 'Joker', 'Joker', 'Joker', '2000-06-06', 'Joker', 'Joker', '', '1', '2021-12-23 04:04:52 PM');

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
(1, '60bf510d64ba8', 'admin', '$2y$10$BUBbDSD4n2OSQToK6UVoCuc5miuuQseMcaLelV2Xb4qQ1Qhxkslqu', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 04:28:03 PM'),
(2, '60bf510d64ba8', 'admin', '$2y$10$jrrJ/ZiDPPtKjCsyFZCcIO9fLlAjuC8AjP1ezDKUhc5D6riIlvqxS', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 04:31:13 PM'),
(3, '60bf510d64ba8', 'admin', '$2y$10$LBgH9DT/ltisxzYk1kHuEe7hdiLc4YUbOTYzdQj7UG08ZL8xPi3SG', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 04:41:58 PM'),
(4, '60bf510d64ba8', 'admin', '$2y$10$O9k3ESjdM/62MwLlbplKoOtLVTTV0khaVhTKUhNSP5cazjnuDhHkS', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 04:43:32 PM'),
(5, '60bf510d64ba8', 'admin', '$2y$10$0ecYOgG8yKMbNH2F0VIHVOQf9.hKyZwTvpVR8.RVLMsSW6/AtKGha', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 04:47:02 PM'),
(6, '60bf510d64ba8', 'admin', '$2y$10$IkzdHBL0US1NCggm5G1iGeTuJGW5/zmg/9zpK7Kcnow89hG0DLNWu', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 04:55:30 PM'),
(7, '60bf510d64ba8', 'admin', '$2y$10$OdFg9sbbLvRXCeJ4ZiHAmuUQqhNxAQRzoQDDxAjZIqJb6MGAm8ZLG', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:01:58 PM'),
(8, '60bf510d64ba8', 'admin', '$2y$10$zBUzekrkJ6qICfAMk5ohguMvHniJPH7Thy51V1L4NVt3G9gVFhTV2', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:03:59 PM'),
(9, '60bf510d64ba8', 'admin', '$2y$10$46Yq54jZz0OVYPNa0Sgna.TyA4nBC6KiVFdE6Iv9FFP66aXt7jQXO', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:06:10 PM'),
(10, '60bf510d64ba8', 'admin', '$2y$10$GB.mY.1WZjajIE9xOSnjr.qfhzk2/I2I8yPvBTO70X7eQGjaKfYgC', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:09:52 PM'),
(11, '60bf510d64ba8', 'admin', '$2y$10$Q6Zq1DpwyASjRCYDhtmUy.Lv65Kvf5zf2TtfM5xn7CldWBAY6/pc.', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:11:24 PM'),
(12, '60bf510d64ba8', 'admin', '$2y$10$Q4ZlRfazZ/PRjJME6BcaruPicfLnSm6fE2ScUeJUDIaq4sbrsUk0i', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:11:54 PM'),
(13, '60bf510d64ba8', 'admin', '$2y$10$OlVO2f8hzy4eoCuFwS16a.wFAuUYSGT76iDqN0xhSJhpS19WScJY.', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:12:17 PM'),
(14, '60bf510d64ba8', 'admin', '$2y$10$irgCUaOVl./I9HbI2N702OyBrN9yFLR/JUGWjnxofkN0kSUZrkbXO', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:15:54 PM'),
(15, '60bf510d64ba8', 'admin', '$2y$10$w1l1hg7br8tgfUqgy0oTbeEXYCSAka92M8gBNkDZXuOOmMNlkMc/y', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:16:20 PM'),
(16, '60bf510d64ba8', 'admin', '$2y$10$RLtM4dgxcu0tZyB5pEPKyuAk0DjIaTLb5ej01oinlzWkTq45HUiVm', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:16:51 PM'),
(17, '60bf510d64ba8', 'admin', '$2y$10$HVB77I1bRRBiXc2XuSzXveoHATywDl9Pe11IB.BWWdC1WGdt7RwSu', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:56:40 PM'),
(18, '60bf510d64ba8', 'admin', '$2y$10$IWhKKGUlS.cnjvdX.ScjLOrsXIDUUUn8E2Dhpj0DxeoQuEefemoYC', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:57:52 PM'),
(19, '60bf510d64ba8', 'admin', '$2y$10$hUjfdPugfcaGjB0zgcTMFu7BKWhbloz2HUdlMGUTbircqd8PwNm2y', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:58:43 PM'),
(20, '60bf510d64ba8', 'admin', '$2y$10$wwEqr37eQ0StqTSwlS0Dc.8zz7D49wI.pLzvfbMXXguSVZdMfryVG', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:59:37 PM'),
(21, '60bf510d64ba8', 'admin', '$2y$10$mFKlSMs6/.D9w4zt11XJKe.mbblkeV82pcJZZV2SPE/dGowjpFGi.', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-23 05:59:58 PM'),
(22, '60bf510d64ba8', 'admin', '$2y$10$G2u.cyoExqKi/yxDwFR6W.LJqv7eV1DXTx9AHEdIXVuQiP8H2hGsq', 'Desktop: Chrome 96.0.4664.110', 'Linux', '::1', 1, '2021-12-27 06:31:03 PM');

-- --------------------------------------------------------

--
-- Table structure for table `user_restrictions`
--

CREATE TABLE `user_restrictions` (
  `ID` int(11) NOT NULL,
  `UserID` varchar(255) DEFAULT NULL,
  `Action` varchar(127) DEFAULT NULL,
  `Allowed` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_restrictions`
--

INSERT INTO `user_restrictions` (`ID`, `UserID`, `Action`, `Allowed`) VALUES
(1, '60bf510d64ba8', 'products_view', b'1'),
(2, '60bf510d64ba8', 'products_add', b'1'),
(3, '60bf510d64ba8', 'products_edit', b'1'),
(4, '60bf510d64ba8', 'products_delete', b'1'),
(5, '60bf510d64ba8', 'releasing_view', b'1'),
(6, '60bf510d64ba8', 'restocking_view', b'1'),
(7, '60bf510d64ba8', 'inventory_view', b'1'),
(8, '60bf510d64ba8', 'users_view', b'1'),
(9, '60bf510d64ba8', 'users_add', b'1'),
(10, '60bf510d64ba8', 'users_edit', b'1'),
(11, '60bf510d64ba8', 'vendors_view', b'1'),
(12, '60bf510d64ba8', 'vendors_add', b'1'),
(13, '60bf510d64ba8', 'vendors_edit', b'1'),
(14, '60bf510d64ba8', 'vendors_delete', b'1'),
(15, '60bf510d64ba8', 'purchase_orders_view', b'1'),
(16, '60bf510d64ba8', 'purchase_orders_add', b'1'),
(17, '60bf510d64ba8', 'purchase_orders_approve', b'1'),
(18, '60bf510d64ba8', 'purchase_orders_bill_creation', b'1'),
(19, '60bf510d64ba8', 'bills_view', b'1'),
(20, '60bf510d64ba8', 'clients_view', b'1'),
(21, '60bf510d64ba8', 'clients_add', b'1'),
(22, '60bf510d64ba8', 'clients_edit', b'1'),
(23, '60bf510d64ba8', 'clients_delete', b'1'),
(24, '60bf510d64ba8', 'sales_orders_view', b'1'),
(25, '60bf510d64ba8', 'sales_orders_add', b'1'),
(26, '60bf510d64ba8', 'sales_orders_mark_for_invoicing', b'1'),
(27, '60bf510d64ba8', 'sales_orders_schedule_delivery', b'1'),
(28, '60bf510d64ba8', 'sales_orders_mark_as_delivered', b'1'),
(29, '60bf510d64ba8', 'sales_orders_mark_as_received', b'1'),
(30, '60bf510d64ba8', 'sales_orders_fulfill', b'1'),
(31, '60bf510d64ba8', 'sales_orders_invoice_creation', b'1'),
(32, '60bf510d64ba8', 'invoice_view', b'1'),
(33, '60bf510d64ba8', 'accounts_view', b'1'),
(34, '60bf510d64ba8', 'accounts_add', b'1'),
(35, '60bf510d64ba8', 'accounts_edit', b'1'),
(36, '60bf510d64ba8', 'journal_transactions_view', b'1'),
(37, '60bf510d64ba8', 'journal_transactions_add', b'1'),
(38, '60bf510d64ba8', 'journal_transactions_delete', b'1'),
(39, '60bf510d64ba8', 'brand_category_view', b'1'),
(40, '60bf510d64ba8', 'trash_bin_view', b'1');

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
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
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
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_category`
--
ALTER TABLE `brand_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand_properties`
--
ALTER TABLE `brand_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand_size`
--
ALTER TABLE `brand_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brand_vcpd`
--
ALTER TABLE `brand_vcpd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart_release`
--
ALTER TABLE `cart_release`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `journal_transactions`
--
ALTER TABLE `journal_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `logbook`
--
ALTER TABLE `logbook`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products_transactions`
--
ALTER TABLE `products_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `security_log`
--
ALTER TABLE `security_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=504;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_login_history`
--
ALTER TABLE `users_login_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_restrictions`
--
ALTER TABLE `user_restrictions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
