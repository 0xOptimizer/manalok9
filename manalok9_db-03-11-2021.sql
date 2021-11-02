-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2021 at 06:59 PM
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
(37, '60bf510d64ba8', 'SDN001ORIG500G', '10', '1000', '2021-11-03 01:45:38', 1);

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

--
-- Dumping data for table `logbook`
--

INSERT INTO `logbook` (`ID`, `Event`, `Description`, `UserID`, `PageURL`, `DateAdded`) VALUES
(1, 'added new transaction.', 'restocked 500 for  SDS [TransactionID: SDS-613CAF90750DD].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SDS', '2021-09-11 09:30:56 PM'),
(2, 'added new transaction.', 'restocked 5000 for  MC [TransactionID: MC-613CAF9D6D3A7].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=MC', '2021-09-11 09:31:09 PM'),
(3, 'added new transaction.', 'restocked 5000 for  YP [TransactionID: YP-613CAFA896A3B].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=YP', '2021-09-11 09:31:20 PM'),
(4, 'added new transaction.', 'restocked 4500 for  SDS [TransactionID: SDS-613CAFB589753].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SDS', '2021-09-11 09:31:33 PM'),
(5, 'added new transaction.', 'restocked 5000 for  POWTECH [TransactionID: POWTECH-613CAFBD34BC9].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=POWTECH', '2021-09-11 09:31:41 PM'),
(6, 'added new transaction.', 'restocked 5000 for  SDN [TransactionID: SDN-613CAFC9BA285].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SDN', '2021-09-11 09:31:53 PM'),
(7, 'added new transaction.', 'restocked 5000 for  SCB [TransactionID: SCB-613CAFD410FC8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SCB', '2021-09-11 09:32:04 PM'),
(8, 'added new transaction.', 'restocked 5000 for  SCB [TransactionID: SCB-613CAFD410FC8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SCB', '2021-09-11 09:32:21 PM'),
(9, 'added new transaction.', 'restocked 5000 for  SDN [TransactionID: SDN-613CAFC9BA285].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SDN', '2021-09-11 09:32:26 PM'),
(10, 'added new transaction.', 'restocked 4500 for  SDS [TransactionID: SDS-613CAFB589753].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SDS', '2021-09-11 09:32:30 PM'),
(11, 'added new transaction.', 'restocked 5000 for  POWTECH [TransactionID: POWTECH-613CAFBD34BC9].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=POWTECH', '2021-09-11 09:32:35 PM'),
(12, 'added new transaction.', 'restocked 5000 for  YP [TransactionID: YP-613CAFA896A3B].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=YP', '2021-09-11 09:32:41 PM'),
(13, 'added new transaction.', 'restocked 5000 for  MC [TransactionID: MC-613CAF9D6D3A7].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=MC', '2021-09-11 09:32:46 PM'),
(14, 'added new transaction.', 'restocked 500 for  SDS [TransactionID: SDS-613CAF90750DD].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SDS', '2021-09-11 09:32:50 PM'),
(15, 'added new transaction.', 'released 200 for  SDS [TransactionID: SDS-613CB1BE98AEC].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SDS', '2021-09-11 09:40:14 PM'),
(16, 'added new transaction.', 'released 300 for  POWTECH [TransactionID: POWTECH-613CB1C957297].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=POWTECH', '2021-09-11 09:40:25 PM'),
(17, 'added new transaction.', 'released 450 for  SCB [TransactionID: SCB-613CB1D2EC939].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SCB', '2021-09-11 09:40:35 PM'),
(18, 'added new transaction.', 'released 150 for  SCB [TransactionID: SCB-613CB1D97A01A].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SCB', '2021-09-11 09:40:41 PM'),
(19, 'created a new purchase order.', 'added a new purchase order Series No. POSAMPLE-000001 [PurchaseOrderID: 1].', '60bf510d64ba8', 'https://localhost/manalok9/admin/orders', '2021-09-11 09:41:10 PM'),
(20, 'approved purchase order.', 'approved a purchase order Series No.  [PurchaseOrderID: 1].', '60bf510d64ba8', 'https://localhost/manalok9/admin/orders', '2021-09-11 09:42:10 PM'),
(21, 'remove transaction from purchase order.', 'removed transaction SCB-613CB1D97A01A from purchase order Series No. POSAMPLE-000001 [PurchaseOrderID: 1].', '60bf510d64ba8', 'https://localhost/manalok9/admin/orders', '2021-09-11 09:43:36 PM'),
(22, 'created a new purchase order.', 'added a new purchase order Series No. POSAMPLE-000002 [PurchaseOrderID: 2].', '60bf510d64ba8', 'https://localhost/manalok9/admin/orders', '2021-09-11 09:45:17 PM'),
(23, 'created a new purchase order.', 'added a new purchase order Series No. POSAMPLE-000003 [PurchaseOrderID: 3].', '60bf510d64ba8', 'https://localhost/manalok9/admin/orders', '2021-09-11 09:45:32 PM'),
(24, 'added new transaction.', 'released 150 for  YP [TransactionID: YP-613CB3649B407].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=YP', '2021-09-11 09:47:16 PM'),
(25, 'added new transaction.', 'released 350 for  YP [TransactionID: YP-613CB36998305].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=YP', '2021-09-11 09:47:21 PM'),
(26, 'added new transaction.', 'released 500 for  SDS [TransactionID: SDS-613CB373E2842].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SDS', '2021-09-11 09:47:31 PM'),
(27, 'added new transaction.', 'released 350 for  SDN [TransactionID: SDN-613CB37FECDF3].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SDN', '2021-09-11 09:47:44 PM'),
(28, 'logged in.', '', '60bf510d64ba8', '', '2021-09-16 01:58:55 PM'),
(29, 'logged in.', '', '60bf510d64ba8', '', '2021-09-16 06:18:51 PM'),
(30, 'created a new vendor.', 'added a new vendor Test [ID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/vendors', '2021-09-16 07:09:25 PM'),
(31, 'created a new vendor.', 'added a new vendor Nam [ID: 5].', '60bf510d64ba8', 'https://localhost/manalok9/admin/vendors', '2021-09-16 07:10:18 PM'),
(32, 'logged in.', '', '60bf510d64ba8', '', '2021-09-16 09:08:09 PM'),
(33, 'created a new client.', 'added a new client Name [ID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/clients', '2021-09-16 09:34:14 PM'),
(34, 'updated vendor details.', 'updated details of vendor Name [vendorID: ].', '60bf510d64ba8', 'https://localhost/manalok9/admin/vendors', '2021-09-16 11:24:39 PM'),
(35, 'created a new vendor.', 'added a new vendor test [ID: 6].', '60bf510d64ba8', 'https://localhost/manalok9/admin/vendors', '2021-09-16 11:26:14 PM'),
(36, 'updated vendor details.', 'updated details of vendor Name [vendorID: 5].', '60bf510d64ba8', 'https://localhost/manalok9/admin/vendors', '2021-09-16 11:26:25 PM'),
(37, 'created a new client.', 'added a new client test [ID: 5].', '60bf510d64ba8', 'https://localhost/manalok9/admin/clients', '2021-09-16 11:38:22 PM'),
(38, 'updated client details.', 'updated details of client Name [clientID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/clients', '2021-09-16 11:39:50 PM'),
(39, 'updated client details.', 'updated details of client Namee [clientID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/clients', '2021-09-16 11:40:04 PM'),
(40, 'updated client details.', 'updated details of client Name [clientID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/clients', '2021-09-16 11:40:08 PM'),
(41, 'logged in.', '', '60bf510d64ba8', '', '2021-09-18 11:52:28 AM'),
(42, 'remove transaction from purchase order.', 'removed transaction SDS-613CB1BE98AEC from purchase order Series No. POSAMPLE-000001 [PurchaseOrderID: 1].', '60bf510d64ba8', 'https://localhost/manalok9/admin/orders', '2021-09-18 11:53:41 AM'),
(43, 'approved purchase order.', 'approved a purchase order Series No.  [PurchaseOrderID: 2].', '60bf510d64ba8', 'https://localhost/manalok9/admin/orders', '2021-09-18 11:54:50 AM'),
(44, 'created a new purchase order.', 'added a new purchase order Series No. POSAMPLE-000004 [PurchaseOrderID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/orders', '2021-09-18 12:12:28 PM'),
(45, 'logged out.', '', NULL, '', '2021-09-20 08:20:47 AM'),
(46, 'logged in.', '', '60bf510d64ba8', '', '2021-09-20 08:20:54 AM'),
(47, 'added new transaction.', 'released  for  [TransactionID: SDS-613CB373E2842SDS-613CB373E2842].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=', '2021-09-20 09:40:05 AM'),
(48, 'added new transaction.', 'released  for  [TransactionID: SDS-613CB373E2842SDS-613CB373E2842].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=', '2021-09-20 09:40:15 AM'),
(49, 'created a new purchase order.', 'added a new purchase order Order No. SOSAMPLE-000005 [SalesOrderID: 5].', '60bf510d64ba8', 'https://localhost/manalok9/admin/orders', '2021-09-20 10:42:49 AM'),
(50, 'logged in.', '', '60bf510d64ba8', '', '2021-09-20 12:04:26 PM'),
(51, 'created a new purchase order.', 'added a new purchase order Order No. SOSAMPLE-000007 [SalesOrderID: 7].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-09-20 01:23:07 PM'),
(52, 'created a new purchase order.', 'added a new purchase order Order No. SOSAMPLE-000008 [SalesOrderID: 8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-09-20 02:06:28 PM'),
(53, 'remove transaction from sales order.', 'removed transaction SDS-613CB1BE98AEC from sales order Sales Order # SOSAMPLE-000008 [OrderNo: 8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000008', '2021-09-20 02:06:43 PM'),
(54, 'remove transaction from sales order.', 'removed transaction YP-613CB3649B407 from sales order Sales Order # SOSAMPLE-000008 [OrderNo: 8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000008', '2021-09-20 02:06:47 PM'),
(55, 'created a new purchase order.', 'added a new purchase order Order No. SOSAMPLE-000009 [SalesOrderID: 9].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-09-20 02:24:28 PM'),
(56, 'remove transaction from sales order.', 'removed transaction YP-613CB3649B407 from sales order Sales Order # SOSAMPLE-000009 [OrderNo: 9].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000009', '2021-09-20 02:24:36 PM'),
(57, 'remove transaction from sales order.', 'removed transaction SDS-613CB1BE98AEC from sales order Sales Order # SOSAMPLE-000009 [OrderNo: 9].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000009', '2021-09-20 02:24:40 PM'),
(58, 'created a new purchase order.', 'added sales order SOSAMPLE-000010 [SalesOrderID: 10].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-09-20 03:06:07 PM'),
(59, 'approved sales order.', 'approved sales order SOSAMPLE-000010 [SalesOrderID: 10].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000010', '2021-09-20 03:07:20 PM'),
(60, 'remove transaction from sales order.', 'removed transaction SDS-613CB1BE98AEC from sales order SOSAMPLE-000010 [SalesOrderID: 10].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000010', '2021-09-20 03:13:20 PM'),
(61, 'remove transaction from sales order.', 'removed transaction YP-613CB3649B407 from sales order SOSAMPLE-000010 [SalesOrderID: 10].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000010', '2021-09-20 03:13:24 PM'),
(62, 'created a new purchase order.', 'added sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-09-20 03:13:31 PM'),
(63, 'approved sales order.', 'approved sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 03:13:42 PM'),
(64, 'approved sales order.', 'approved sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 03:15:34 PM'),
(65, 'approved sales order.', 'approved sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 03:19:10 PM'),
(66, 'approved sales order.', 'approved sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 03:21:33 PM'),
(67, 'approved sales order.', 'approved sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 03:23:33 PM'),
(68, 'approved sales order.', 'approved sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 03:24:05 PM'),
(69, 'approved sales order.', 'approved sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 03:25:16 PM'),
(70, 'approved sales order.', 'approved sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 03:25:30 PM'),
(71, 'approved sales order.', 'approved sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 03:26:47 PM'),
(72, 'approved sales order.', 'approved sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 03:27:19 PM'),
(73, 'approved sales order.', 'approved sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 03:28:07 PM'),
(74, 'approved sales order.', 'approved sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 03:28:20 PM'),
(75, 'approved sales order.', 'approved sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 03:33:59 PM'),
(76, 'rejected sales order.', 'rejected sales order SOSAMPLE-000011 [SalesOrderID: 11].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000011', '2021-09-20 04:03:24 PM'),
(77, 'rejected sales order.', 'rejected sales order SOSAMPLE-000006 [SalesOrderID: 6].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000006', '2021-09-20 04:08:32 PM'),
(78, 'rejected sales order.', 'rejected sales order SOSAMPLE-000007 [SalesOrderID: 7].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000007', '2021-09-20 04:08:37 PM'),
(79, 'rejected sales order.', 'rejected sales order SOSAMPLE-000005 [SalesOrderID: 5].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000005', '2021-09-20 04:08:42 PM'),
(80, 'rejected sales order.', 'rejected sales order POSAMPLE-000004 [SalesOrderID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=POSAMPLE-000004', '2021-09-20 04:08:47 PM'),
(81, 'rejected sales order.', 'rejected sales order POSAMPLE-000003 [SalesOrderID: 3].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=POSAMPLE-000003', '2021-09-20 04:08:52 PM'),
(82, 'logged in.', '', '60bf510d64ba8', '', '2021-09-20 08:56:31 PM'),
(83, 'created a new purchase order.', 'added sales order SOSAMPLE-000001 [SalesOrderID: 1].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-09-20 09:45:40 PM'),
(84, 'remove transaction from sales order.', 'removed transaction YP-613CB3649B407 from sales order SOSAMPLE-000001 [SalesOrderID: 1].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000001', '2021-09-20 09:54:49 PM'),
(85, 'remove transaction from sales order.', 'removed transaction POWTECH-613CB1C957297 from sales order SOSAMPLE-000001 [SalesOrderID: 1].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000001', '2021-09-20 09:55:06 PM'),
(86, 'created a new purchase order.', 'added sales order SOSAMPLE-000002 [SalesOrderID: 2].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-09-20 09:55:38 PM'),
(87, 'rejected sales order.', 'rejected sales order SOSAMPLE-000002 [SalesOrderID: 2].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000002', '2021-09-20 09:56:47 PM'),
(88, 'added new transaction.', 'released 200 for  POWTECH [TransactionID: POWTECH-614893929BB4F].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=POWTECH', '2021-09-20 09:58:42 PM'),
(89, 'created a new purchase order.', 'added sales order SOSAMPLE-000003 [SalesOrderID: 3].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-09-20 10:19:50 PM'),
(90, 'remove transaction from sales order.', 'removed transaction SDN-613CB37FECDF3 from sales order SOSAMPLE-000003 [SalesOrderID: 3].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000003', '2021-09-20 10:47:04 PM'),
(91, 'logged in.', '', '60bf510d64ba8', '', '2021-09-21 11:18:30 AM'),
(92, 'approved sales order.', 'approved sales order SOSAMPLE-000003 [SalesOrderID: 3].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SOSAMPLE-000003', '2021-09-21 11:41:23 AM'),
(93, 'logged in.', '', '60bf510d64ba8', '', '2021-09-21 04:22:10 PM'),
(94, 'created a new sales order.', 'added sales order SO-000004 [SalesOrderID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-09-21 09:53:11 PM'),
(95, 'approved sales order.', 'approved sales order SO-000004 [SalesOrderID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000004', '2021-09-21 10:01:58 PM'),
(96, 'created a new sales order.', 'added sales order SO-000005 [SalesOrderID: 5].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-09-21 10:02:23 PM'),
(97, 'rejected sales order.', 'rejected sales order SO-000005 [SalesOrderID: 5].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000005', '2021-09-21 10:02:36 PM'),
(98, 'updated client details.', 'updated details of client NameTest [clientID: 5].', '60bf510d64ba8', 'https://localhost/manalok9/admin/clients', '2021-09-21 10:55:45 PM'),
(99, 'updated client details.', 'updated details of client NameTest [clientID: 5].', '60bf510d64ba8', 'https://localhost/manalok9/admin/clients', '2021-09-21 10:56:00 PM'),
(100, 'created a new client.', 'added a new client Tester [ID: 6].', '60bf510d64ba8', 'https://localhost/manalok9/admin/clients', '2021-09-21 10:56:13 PM'),
(101, 'created a new client.', 'added a new client NameTest [ID: 7].', '60bf510d64ba8', 'https://localhost/manalok9/admin/clients', '2021-09-21 10:59:00 PM'),
(102, 'created a new client.', 'added a new client Test [ID: 8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/clients', '2021-09-21 10:59:21 PM'),
(103, 'created a new vendor.', 'added a new vendor NameTest [ID: 7].', '60bf510d64ba8', 'https://localhost/manalok9/admin/vendors', '2021-09-21 11:30:40 PM'),
(104, 'created a new purchase order.', 'added purchase order PO-000002 [PurchaseOrderID: 2].', '60bf510d64ba8', 'https://localhost/manalok9/admin/purchase_orders', '2021-09-22 12:08:30 AM'),
(105, 'removed transaction from purchase order.', 'removed transaction SDS-000022 from purchase order PO-000002 [PurchaseOrderID: 2].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_purchase_order?orderNo=PO-000002', '2021-09-22 12:32:22 AM'),
(106, 'approved purchase order.', 'approved purchase order PO-000002 [PurchaseOrderID: 2].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_purchase_order?orderNo=PO-000002', '2021-09-22 12:39:01 AM'),
(107, 'created a new purchase order.', 'added purchase order PO-000003 [PurchaseOrderID: 3].', '60bf510d64ba8', 'https://localhost/manalok9/admin/purchase_orders', '2021-09-22 12:39:58 AM'),
(108, 'approved purchase order.', 'approved purchase order PO-000003 [PurchaseOrderID: 3].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_purchase_order?orderNo=PO-000003', '2021-09-22 12:40:07 AM'),
(109, 'created a new purchase order.', 'added purchase order PO-000004 [PurchaseOrderID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/purchase_orders', '2021-09-22 12:40:34 AM'),
(110, 'rejected purchase order.', 'rejected purchase order PO-000004 [PurchaseOrderID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_purchase_order?orderNo=PO-000004', '2021-09-22 12:41:17 AM'),
(111, 'created a new purchase order.', 'added purchase order PO-000005 [PurchaseOrderID: 5].', '60bf510d64ba8', 'https://localhost/manalok9/admin/purchase_orders', '2021-09-22 12:44:36 AM'),
(112, 'rejected purchase order.', 'rejected purchase order PO-000005 [PurchaseOrderID: 5].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_purchase_order?orderNo=PO-000005', '2021-09-22 12:44:43 AM'),
(113, 'created a new sales order.', 'added sales order SO-000006 [SalesOrderID: 6].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-09-22 12:47:22 AM'),
(114, 'approved sales order.', 'approved sales order SO-000006 [SalesOrderID: 6].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000006', '2021-09-22 12:47:48 AM'),
(115, 'created a new sales order.', 'added sales order SO-000007 [SalesOrderID: 7].', '60bf510d64ba8', 'https://localhost/manalok9/admin/sales_orders', '2021-09-22 12:48:07 AM'),
(116, 'rejected sales order.', 'rejected sales order SO-000007 [SalesOrderID: 7].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000007', '2021-09-22 12:48:12 AM'),
(117, 'logged in.', '', '60bf510d64ba8', '', '2021-09-22 03:39:23 PM'),
(118, 'logged in.', '', '60bf510d64ba8', '', '2021-09-22 03:55:14 PM'),
(119, 'created a new product.', 'added a new product [Code: ].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-09-22 03:56:55 PM'),
(120, 'created a new product.', 'added a new product [Code: 2312312].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-09-22 03:57:52 PM'),
(121, 'created a new product.', 'added a new product dasdsad [Code: halllow].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-09-22 04:03:46 PM'),
(122, 'created a new product.', 'added a new product fdsfds [Code: hghfghfgh].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-09-22 04:06:10 PM'),
(123, 'created a new product.', 'added a new product fffff [Code: ffdfsdf].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-09-22 04:07:31 PM'),
(124, 'created a new product.', 'added a new product g [Code: gggggg].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-09-22 04:22:43 PM'),
(125, 'created a new product.', 'added a new product sample [Code: 43rewrwepoujfpofguop].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-09-22 04:23:18 PM'),
(126, 'created a new product.', 'added a new product asdasd [Code: 3213213123123].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-09-22 04:24:08 PM'),
(127, 'created a new product.', 'added a new product Long TExt [Code: sample123].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-09-22 04:26:22 PM'),
(128, 'created a new product.', 'added a new product afritada recipe by Gordon Ramsay [Code: sample123].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-09-22 04:29:08 PM'),
(129, 'created a new product.', 'added a new product Tuna flakes by chef boy logro [Code: 456789].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-09-22 04:44:14 PM'),
(130, 'logged in.', '', '60bf510d64ba8', '', '2021-09-22 06:21:12 PM'),
(131, 'logged in.', '', '60bf510d64ba8', '', '2021-09-22 06:24:04 PM'),
(132, 'logged in.', '', '60bf510d64ba8', '', '2021-09-22 06:41:36 PM'),
(133, 'logged in.', '', '60bf510d64ba8', '', '2021-09-22 06:49:04 PM'),
(134, 'logged in.', '', '60bf510d64ba8', '', '2021-09-22 06:59:56 PM'),
(135, 'logged in.', '', '60bf510d64ba8', '', '2021-09-22 07:01:13 PM'),
(136, 'logged out.', '', '60bf510d64ba8', '', '2021-09-22 07:02:18 PM'),
(137, 'logged in.', '', '60bf510d64ba8', '', '2021-09-22 07:16:20 PM'),
(138, 'logged in.', '', '60bf510d64ba8', '', '2021-09-22 07:28:09 PM'),
(139, 'logged in.', '', '60bf510d64ba8', '', '2021-09-22 08:44:52 PM'),
(140, 'logged in.', '', '60bf510d64ba8', '', '2021-09-30 03:44:23 PM'),
(141, 'logged in.', '', '60bf510d64ba8', '', '2021-09-30 03:47:22 PM'),
(142, 'logged out.', '', NULL, '', '2021-09-30 06:52:15 PM'),
(143, 'logged in.', '', '60bf510d64ba8', '', '2021-09-30 06:52:20 PM'),
(144, 'logged in.', '', '60bf510d64ba8', '', '2021-09-30 06:53:50 PM'),
(145, 'logged out.', '', '60bf510d64ba8', '', '2021-09-30 06:53:56 PM'),
(146, 'logged out.', '', NULL, '', '2021-09-30 06:55:14 PM'),
(147, 'logged in.', '', '60bf510d64ba8', '', '2021-09-30 06:55:18 PM'),
(148, 'logged in.', '', '60bf510d64ba8', '', '2021-09-30 06:55:31 PM'),
(149, 'logged out.', '', '60bf510d64ba8', '', '2021-09-30 06:55:40 PM'),
(150, 'logged in.', '', '60bf510d64ba8', '', '2021-09-30 06:56:50 PM'),
(151, 'logged out.', '', '60bf510d64ba8', '', '2021-09-30 06:56:52 PM'),
(152, 'created a new product.', 'added a new product dsadwwww [Code: SDN001ORIG500G].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-09-30 08:18:57 PM'),
(153, 'created a new product.', 'added a new product dddd [Code: 1234567890].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-09-30 08:19:54 PM'),
(154, 'created a new product.', 'added a new product dasd [Code: SDN001ORIG500G].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-10-01 02:02:11 AM'),
(155, 'logged in.', '', '60bf510d64ba8', '', '2021-10-09 02:01:53 PM'),
(156, 'logged in.', '', '60bf510d64ba8', '', '2021-10-11 05:58:13 PM'),
(157, 'created a new product.', 'added a new product Tuna flakes dog food [Code: SDN001ORIG500G].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-10-11 08:24:56 PM'),
(158, 'logged in.', '', '60bf510d64ba8', '', '2021-10-12 01:07:27 AM'),
(159, 'logged out.', '', NULL, '', '2021-10-12 05:12:26 AM'),
(160, 'logged in.', '', '60bf510d64ba8', '', '2021-10-14 07:41:41 PM'),
(161, 'logged out.', '', '60bf510d64ba8', '', '2021-10-14 11:56:47 PM'),
(162, 'logged in.', '', '60bf510d64ba8', '', '2021-10-18 11:49:51 AM'),
(163, 'created a new product.', 'added a new product SAMPLE DESCRIPTION [Code: SDN001ORIG500G].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-10-18 11:52:48 AM'),
(164, 'created a new product.', 'added a new product Sample description [Code: SDN001ORIG500G].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-10-18 11:54:19 AM'),
(165, 'logged in.', '', '60bf510d64ba8', '', '2021-10-20 07:19:13 PM'),
(166, 'logged out.', '', NULL, '', '2021-10-21 01:49:55 PM'),
(167, 'logged in.', '', '60bf510d64ba8', '', '2021-10-21 01:50:00 PM'),
(168, 'logged in.', '', '60bf510d64ba8', '', '2021-10-21 09:57:47 PM'),
(169, 'logged out.', '', '60bf510d64ba8', '', '2021-10-21 11:18:06 PM'),
(170, 'logged in.', '', '60bf510d64ba8', '', '2021-10-21 11:18:11 PM'),
(171, 'created a new product.', 'added a new product dasdas [Code: SDN001ORIG10KG].', '60bf510d64ba8', 'https://localhost/manalok9/admin/products', '2021-10-22 12:57:54 AM'),
(172, 'logged in.', '', '60bf510d64ba8', '', '2021-10-23 06:05:44 PM'),
(173, 'logged in.', '', '60bf510d64ba8', '', '2021-10-23 10:49:12 PM'),
(174, 'logged in.', '', '60bf510d64ba8', '', '2021-11-02 03:21:35 PM'),
(175, 'logged out.', '', NULL, '', '2021-11-02 08:49:07 PM'),
(176, 'logged in.', '', '60bf510d64ba8', '', '2021-11-02 08:50:22 PM'),
(177, 'added new transaction.', 'released 10 for  SDN001ORIG500G [TransactionID: SDN001ORIG500G-61817952A08A2].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SDN001ORIG500G', '2021-11-03 01:45:54 AM'),
(178, 'added new transaction.', 'restocked 30 for  SDN001ORIG10KG [TransactionID: SDN001ORIG10KG-61817BD94938E].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SDN001ORIG10KG', '2021-11-03 01:56:41 AM'),
(179, 'added new transaction.', 'restocked 100 for  SDN001ORIG500G [TransactionID: SDN001ORIG500G-61817BD96BE37].', '60bf510d64ba8', 'https://localhost/manalok9/admin/viewproduct?code=SDN001ORIG500G', '2021-11-03 01:56:41 AM');

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
(8, 'SDN001ORIG500G', 'dog snack', 'Sample description', 100, 60, 'DOG FOOD', '500 g', '100', '150', '2021-10-18 11:54:19 AM', '0', 'assets/barcode_images/SDN001ORIG500G-pbarcode.png'),
(9, 'SDN001ORIG10KG', 'sadasd', 'dasdas', 100, 30, 'asdwdw', '100 g', '10', '20', '2021-10-22 12:57:54 AM', '0', 'assets/barcode_images/SDN001ORIG10KG-pbarcode.png');

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
  `UserID` varchar(255) DEFAULT NULL,
  `PriceTotal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_transactions`
--

INSERT INTO `products_transactions` (`ID`, `Code`, `TransactionID`, `OrderNo`, `Type`, `Amount`, `PriceUnit`, `InStock`, `Date`, `DateAdded`, `Status`, `Date_Approval`, `UserID`, `PriceTotal`) VALUES
(30, 'SDN001ORIG500G', 'SDN001ORIG500G-61817952A08A2', NULL, 1, 10, '100', 0, '2021-11-03 01:45:38', '2021-11-03 01:45:54 AM', 1, NULL, '60bf510d64ba8', '1000'),
(31, 'SDN001ORIG10KG', 'SDN001ORIG10KG-61817BD94938E', NULL, 0, 30, '10', 0, '', '2021-11-03 01:56:41 AM', 1, NULL, NULL, '300'),
(32, 'SDN001ORIG500G', 'SDN001ORIG500G-61817BD96BE37', NULL, 0, 100, '100', 0, '', '2021-11-03 01:56:41 AM', 1, NULL, NULL, '10000');

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

--
-- Dumping data for table `security_log`
--

INSERT INTO `security_log` (`ID`, `UserID`, `Agent`, `Platform`, `IPAddress`, `Country`, `PageURL`, `DateAdded`) VALUES
(1, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/security', '2021-10-23 10:48:57 PM'),
(2, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/', '2021-10-23 10:49:06 PM'),
(3, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-10-23 10:49:09 PM'),
(4, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/', '2021-10-23 10:49:09 PM'),
(5, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-10-23 10:49:12 PM'),
(6, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-10-23 10:49:12 PM'),
(7, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/security', '2021-10-23 10:49:14 PM'),
(8, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/security', '2021-10-23 10:49:17 PM'),
(9, NULL, 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/', '2021-11-02 03:21:29 PM'),
(10, NULL, 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-11-02 03:21:35 PM'),
(11, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-11-02 03:21:35 PM'),
(12, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 03:22:04 PM'),
(13, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:22:05 PM'),
(14, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 03:22:10 PM'),
(15, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/inventory', '2021-11-02 03:22:15 PM'),
(16, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:22:16 PM'),
(17, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 03:22:16 PM'),
(18, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:22:17 PM'),
(19, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 03:22:18 PM'),
(20, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:34:43 PM'),
(21, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 03:34:44 PM'),
(22, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:34:45 PM'),
(23, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 03:34:46 PM'),
(24, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:34:47 PM'),
(25, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 03:34:48 PM'),
(26, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:34:48 PM'),
(27, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 03:34:49 PM'),
(28, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:34:50 PM'),
(29, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 03:35:02 PM'),
(30, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:35:04 PM'),
(31, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 03:35:08 PM'),
(32, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 03:37:13 PM'),
(33, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:37:14 PM'),
(34, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:37:53 PM'),
(35, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:37:54 PM'),
(36, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:38:13 PM'),
(37, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 03:46:09 PM'),
(38, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 04:14:37 PM'),
(39, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 04:53:43 PM'),
(40, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 04:54:19 PM'),
(41, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 04:54:20 PM'),
(42, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 04:54:21 PM'),
(43, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 04:54:22 PM'),
(44, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 04:54:23 PM'),
(45, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 04:54:24 PM'),
(46, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 04:57:58 PM'),
(47, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-11-02 06:03:57 PM'),
(48, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 06:10:10 PM'),
(49, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 06:10:11 PM'),
(50, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 06:10:11 PM'),
(51, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 06:10:12 PM'),
(52, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 06:10:59 PM'),
(53, NULL, 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 08:49:02 PM'),
(54, NULL, 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 08:49:03 PM'),
(55, NULL, 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 08:49:03 PM'),
(56, NULL, 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/logout', '2021-11-02 08:49:07 PM'),
(57, NULL, 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/login', '2021-11-02 08:49:07 PM'),
(58, NULL, 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/FORM_loginValidation', '2021-11-02 08:50:22 PM'),
(59, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-11-02 08:50:23 PM'),
(60, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 08:50:24 PM'),
(61, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 08:52:09 PM'),
(62, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 08:52:58 PM'),
(63, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:53:16 PM'),
(64, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:53:17 PM'),
(65, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:53:17 PM'),
(66, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:53:17 PM'),
(67, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:53:17 PM'),
(68, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:53:17 PM'),
(69, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 08:53:33 PM'),
(70, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:53:44 PM'),
(71, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:53:44 PM'),
(72, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 08:56:09 PM'),
(73, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:56:16 PM'),
(74, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:56:16 PM'),
(75, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 08:56:19 PM'),
(76, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 08:57:03 PM'),
(77, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 08:57:05 PM'),
(78, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(79, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(80, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(81, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(82, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(83, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(84, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(85, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(86, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(87, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(88, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(89, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(90, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(91, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(92, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(93, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(94, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(95, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:38 PM'),
(96, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(97, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(98, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(99, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(100, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(101, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(102, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(103, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(104, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(105, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(106, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(107, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(108, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(109, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(110, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(111, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(112, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(113, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(114, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(115, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(116, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(117, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(118, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(119, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:39 PM'),
(120, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:40 PM'),
(121, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:57:40 PM'),
(122, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 08:57:59 PM'),
(123, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 08:57:59 PM'),
(124, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:04 PM'),
(125, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:04 PM'),
(126, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:04 PM'),
(127, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:04 PM'),
(128, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:04 PM'),
(129, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:04 PM'),
(130, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:04 PM'),
(131, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:04 PM'),
(132, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:04 PM'),
(133, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:04 PM'),
(134, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:04 PM'),
(135, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:05 PM'),
(136, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:05 PM'),
(137, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:05 PM'),
(138, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:05 PM'),
(139, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:05 PM'),
(140, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:05 PM'),
(141, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:05 PM'),
(142, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:05 PM'),
(143, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:05 PM'),
(144, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:05 PM'),
(145, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:05 PM'),
(146, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 08:58:05 PM'),
(147, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-02 09:05:28 PM'),
(148, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 09:05:33 PM'),
(149, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:05:37 PM'),
(150, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:05:38 PM'),
(151, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:05:38 PM'),
(152, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:05:38 PM'),
(153, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:05:38 PM'),
(154, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:05:38 PM'),
(155, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:05:38 PM'),
(156, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:05:38 PM'),
(157, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 09:07:32 PM'),
(158, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(159, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(160, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(161, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(162, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(163, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(164, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(165, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(166, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(167, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(168, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(169, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(170, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(171, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:07:40 PM'),
(172, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 09:08:14 PM'),
(173, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 09:08:21 PM'),
(174, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 09:08:22 PM'),
(175, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 09:08:26 PM'),
(176, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 09:08:50 PM'),
(177, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:09:02 PM'),
(178, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:09:02 PM'),
(179, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:09:02 PM'),
(180, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:09:02 PM'),
(181, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:09:02 PM'),
(182, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:09:02 PM'),
(183, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:09:02 PM'),
(184, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 09:09:02 PM'),
(185, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:03:15 PM'),
(186, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:03:16 PM'),
(187, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:03:25 PM'),
(188, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:03:25 PM'),
(189, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:03:34 PM'),
(190, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:03:36 PM'),
(191, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:05:30 PM'),
(192, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:05:38 PM'),
(193, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:05:38 PM'),
(194, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:05:47 PM'),
(195, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:07:44 PM'),
(196, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:07:50 PM'),
(197, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:07:50 PM'),
(198, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:09:30 PM'),
(199, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:09:37 PM'),
(200, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:09:37 PM'),
(201, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:09:37 PM'),
(202, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:09:37 PM'),
(203, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:09:37 PM'),
(204, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:09:37 PM'),
(205, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:09:37 PM'),
(206, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:10:55 PM'),
(207, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:05 PM'),
(208, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:05 PM'),
(209, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:05 PM'),
(210, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:05 PM'),
(211, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(212, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(213, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(214, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(215, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(216, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(217, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(218, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(219, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(220, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(221, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(222, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(223, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(224, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:11:06 PM'),
(225, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:13:37 PM'),
(226, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:13:46 PM'),
(227, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:13:46 PM'),
(228, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:13:46 PM'),
(229, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:13:46 PM'),
(230, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:13:46 PM'),
(231, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:13:46 PM'),
(232, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:13:46 PM'),
(233, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:13:46 PM'),
(234, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:13:46 PM'),
(235, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:13:46 PM'),
(236, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:18:25 PM'),
(237, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:32 PM'),
(238, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:32 PM'),
(239, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:32 PM'),
(240, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:32 PM'),
(241, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(242, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(243, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(244, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(245, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(246, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(247, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(248, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(249, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(250, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(251, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(252, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(253, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(254, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:18:33 PM'),
(255, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:18:44 PM'),
(256, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:19:47 PM'),
(257, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:19:55 PM'),
(258, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:19:55 PM'),
(259, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:19:55 PM'),
(260, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:19:55 PM'),
(261, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:19:55 PM'),
(262, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:19:55 PM'),
(263, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:19:55 PM'),
(264, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:19:55 PM'),
(265, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:21:20 PM'),
(266, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:21:20 PM'),
(267, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:21:37 PM'),
(268, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:21:37 PM'),
(269, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:21:37 PM'),
(270, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:21:37 PM'),
(271, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:21:37 PM'),
(272, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:21:37 PM'),
(273, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:22:29 PM'),
(274, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:22:42 PM'),
(275, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:22:43 PM'),
(276, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:22:43 PM'),
(277, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:22:43 PM'),
(278, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:22:43 PM'),
(279, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:22:43 PM'),
(280, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:22:43 PM'),
(281, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:22:43 PM'),
(282, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:22:43 PM'),
(283, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:22:43 PM'),
(284, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:23:50 PM'),
(285, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:23:56 PM'),
(286, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:24:04 PM'),
(287, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:24:04 PM'),
(288, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:24:04 PM'),
(289, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:24:04 PM'),
(290, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:24:04 PM'),
(291, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:24:04 PM'),
(292, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:24:04 PM'),
(293, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:24:04 PM'),
(294, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:24:04 PM'),
(295, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:24:04 PM'),
(296, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:26:59 PM'),
(297, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:07 PM'),
(298, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:07 PM'),
(299, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:07 PM'),
(300, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:07 PM'),
(301, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:07 PM'),
(302, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:07 PM'),
(303, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:07 PM'),
(304, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:07 PM'),
(305, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:08 PM'),
(306, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:08 PM'),
(307, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:08 PM'),
(308, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:08 PM'),
(309, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:08 PM'),
(310, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:27:08 PM');
INSERT INTO `security_log` (`ID`, `UserID`, `Agent`, `Platform`, `IPAddress`, `Country`, `PageURL`, `DateAdded`) VALUES
(311, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:29:26 PM'),
(312, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:33 PM'),
(313, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:33 PM'),
(314, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:34 PM'),
(315, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:34 PM'),
(316, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:34 PM'),
(317, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:34 PM'),
(318, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:34 PM'),
(319, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:34 PM'),
(320, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:34 PM'),
(321, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:34 PM'),
(322, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:34 PM'),
(323, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:34 PM'),
(324, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:34 PM'),
(325, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:34 PM'),
(326, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:29:34 PM'),
(327, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:31:21 PM'),
(328, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:27 PM'),
(329, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:27 PM'),
(330, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:32 PM'),
(331, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:32 PM'),
(332, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:32 PM'),
(333, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:32 PM'),
(334, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:41 PM'),
(335, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:41 PM'),
(336, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:41 PM'),
(337, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:41 PM'),
(338, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:41 PM'),
(339, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:41 PM'),
(340, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:41 PM'),
(341, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:41 PM'),
(342, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:41 PM'),
(343, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:41 PM'),
(344, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:42 PM'),
(345, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:31:42 PM'),
(346, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:33:28 PM'),
(347, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:33:39 PM'),
(348, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:33:39 PM'),
(349, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:33:39 PM'),
(350, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:33:39 PM'),
(351, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:33:39 PM'),
(352, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:33:39 PM'),
(353, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:33:39 PM'),
(354, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:33:39 PM'),
(355, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:33:39 PM'),
(356, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:33:39 PM'),
(357, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:37:18 PM'),
(358, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:37:31 PM'),
(359, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:37:31 PM'),
(360, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:37:31 PM'),
(361, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:37:31 PM'),
(362, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:37:31 PM'),
(363, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:37:31 PM'),
(364, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:37:31 PM'),
(365, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:37:31 PM'),
(366, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:37:31 PM'),
(367, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:37:31 PM'),
(368, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:38:59 PM'),
(369, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:38:59 PM'),
(370, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(371, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(372, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(373, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(374, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(375, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(376, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(377, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(378, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(379, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(380, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(381, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(382, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(383, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(384, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(385, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(386, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(387, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(388, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(389, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:39:05 PM'),
(390, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:43:25 PM'),
(391, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:43:30 PM'),
(392, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:43:32 PM'),
(393, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:43:49 PM'),
(394, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:43:54 PM'),
(395, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:43:54 PM'),
(396, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:43:54 PM'),
(397, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:43:54 PM'),
(398, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:45:26 PM'),
(399, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:47:19 PM'),
(400, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:47:27 PM'),
(401, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:47:27 PM'),
(402, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:47:27 PM'),
(403, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:47:27 PM'),
(404, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:47:27 PM'),
(405, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:47:27 PM'),
(406, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:47:27 PM'),
(407, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:47:27 PM'),
(408, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:47:27 PM'),
(409, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:47:27 PM'),
(410, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:47:28 PM'),
(411, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:47:28 PM'),
(412, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:47:28 PM'),
(413, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:47:59 PM'),
(414, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:48:15 PM'),
(415, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:48:15 PM'),
(416, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:48:15 PM'),
(417, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:48:15 PM'),
(418, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:48:15 PM'),
(419, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:48:15 PM'),
(420, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:48:15 PM'),
(421, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:48:15 PM'),
(422, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:48:15 PM'),
(423, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:48:16 PM'),
(424, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:48:16 PM'),
(425, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:53:33 PM'),
(426, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:53:41 PM'),
(427, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:53:48 PM'),
(428, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:53:53 PM'),
(429, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:53:57 PM'),
(430, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:54:01 PM'),
(431, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:54:33 PM'),
(432, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:54:40 PM'),
(433, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:54:40 PM'),
(434, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:55:11 PM'),
(435, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:55:18 PM'),
(436, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:55:18 PM'),
(437, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:55:18 PM'),
(438, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:55:18 PM'),
(439, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:55:18 PM'),
(440, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:55:18 PM'),
(441, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:55:18 PM'),
(442, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:55:18 PM'),
(443, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:55:18 PM'),
(444, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:55:18 PM'),
(445, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:55:18 PM'),
(446, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:55:18 PM'),
(447, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:56:06 PM'),
(448, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:56:14 PM'),
(449, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:56:15 PM'),
(450, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 10:59:22 PM'),
(451, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:59:34 PM'),
(452, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 10:59:34 PM'),
(453, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:00:10 PM'),
(454, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:00:59 PM'),
(455, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:01:04 PM'),
(456, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:01:09 PM'),
(457, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:01:09 PM'),
(458, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:01:09 PM'),
(459, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:01:09 PM'),
(460, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:01:09 PM'),
(461, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:01:09 PM'),
(462, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:01:09 PM'),
(463, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:01:09 PM'),
(464, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:01:09 PM'),
(465, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:01:10 PM'),
(466, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:01:34 PM'),
(467, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:01:38 PM'),
(468, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:01:39 PM'),
(469, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:01:39 PM'),
(470, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:01:43 PM'),
(471, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:02:03 PM'),
(472, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:02:03 PM'),
(473, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:02:03 PM'),
(474, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:02:03 PM'),
(475, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:02:03 PM'),
(476, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:02:03 PM'),
(477, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:02:04 PM'),
(478, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:02:04 PM'),
(479, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:02:04 PM'),
(480, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:02:04 PM'),
(481, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:02:10 PM'),
(482, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:03:32 PM'),
(483, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:03:32 PM'),
(484, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:39 PM'),
(485, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:39 PM'),
(486, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:39 PM'),
(487, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:39 PM'),
(488, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:39 PM'),
(489, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:39 PM'),
(490, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:40 PM'),
(491, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:40 PM'),
(492, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:40 PM'),
(493, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:40 PM'),
(494, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:40 PM'),
(495, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:40 PM'),
(496, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:40 PM'),
(497, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:40 PM'),
(498, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:40 PM'),
(499, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:40 PM'),
(500, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:40 PM'),
(501, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:03:40 PM'),
(502, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:03:45 PM'),
(503, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:10:03 PM'),
(504, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:10:28 PM'),
(505, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:10:42 PM'),
(506, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:11:16 PM'),
(507, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:11:53 PM'),
(508, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:12:20 PM'),
(509, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:12:44 PM'),
(510, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:13:01 PM'),
(511, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:14:19 PM'),
(512, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:14:52 PM'),
(513, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:15:15 PM'),
(514, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:15:32 PM'),
(515, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:16:04 PM'),
(516, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:16:24 PM'),
(517, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:17:21 PM'),
(518, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:21:43 PM'),
(519, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:22:16 PM'),
(520, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:22:22 PM'),
(521, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:23:33 PM'),
(522, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:24:05 PM'),
(523, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:27:29 PM'),
(524, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:27:29 PM'),
(525, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:29:17 PM'),
(526, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:29:29 PM'),
(527, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:29:45 PM'),
(528, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:33:04 PM'),
(529, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:33:05 PM'),
(530, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:33:32 PM'),
(531, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:33:39 PM'),
(532, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:33:57 PM'),
(533, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:34:04 PM'),
(534, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:34:11 PM'),
(535, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:36:40 PM'),
(536, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:36:46 PM'),
(537, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:37:30 PM'),
(538, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:38:59 PM'),
(539, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:39:15 PM'),
(540, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:39:53 PM'),
(541, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:40:04 PM'),
(542, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:40:17 PM'),
(543, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:40:31 PM'),
(544, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:40:51 PM'),
(545, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:41:05 PM'),
(546, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:41:32 PM'),
(547, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:42:14 PM'),
(548, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:42:55 PM'),
(549, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Android', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:43:53 PM'),
(550, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:45:02 PM'),
(551, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:45:02 PM'),
(552, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:45:27 PM'),
(553, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:45:32 PM'),
(554, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:45:54 PM'),
(555, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:46:40 PM'),
(556, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:46:48 PM'),
(557, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:47:05 PM'),
(558, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:47:26 PM'),
(559, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:48:23 PM'),
(560, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:48:39 PM'),
(561, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:52:50 PM'),
(562, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 11:52:53 PM'),
(563, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/Restock_from_cart', '2021-11-02 11:52:57 PM'),
(564, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 11:52:57 PM'),
(565, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/Restock_from_cart', '2021-11-02 11:53:13 PM'),
(566, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 11:53:13 PM'),
(567, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 11:53:40 PM'),
(568, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:47 PM'),
(569, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:47 PM'),
(570, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:47 PM'),
(571, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:47 PM'),
(572, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:47 PM'),
(573, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:47 PM'),
(574, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:47 PM'),
(575, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:47 PM'),
(576, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:48 PM'),
(577, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:48 PM'),
(578, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:48 PM'),
(579, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:48 PM'),
(580, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:48 PM'),
(581, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:48 PM'),
(582, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-02 11:53:48 PM'),
(583, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/Restock_from_cart', '2021-11-02 11:54:05 PM'),
(584, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 11:54:05 PM'),
(585, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-02 11:54:26 PM'),
(586, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-02 11:54:28 PM'),
(587, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 12:00:20 AM'),
(588, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 12:00:23 AM'),
(589, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-11-03 12:00:35 AM'),
(590, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/users', '2021-11-03 12:00:36 AM'),
(591, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-11-03 12:00:39 AM'),
(592, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/clients', '2021-11-03 12:00:40 AM'),
(593, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/bills', '2021-11-03 12:00:41 AM'),
(594, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-11-03 12:00:42 AM'),
(595, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-11-03 12:00:43 AM'),
(596, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-11-03 12:00:45 AM'),
(597, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/bills', '2021-11-03 12:00:45 AM'),
(598, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/bills', '2021-11-03 12:03:27 AM'),
(599, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-11-03 12:03:28 AM'),
(600, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-11-03 12:03:29 AM'),
(601, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-11-03 12:03:30 AM'),
(602, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-11-03 12:03:35 AM'),
(603, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/getVendorDetails', '2021-11-03 12:03:36 AM'),
(604, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/getVendorDetails', '2021-11-03 12:03:38 AM'),
(605, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 12:03:41 AM'),
(606, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 12:03:41 AM'),
(607, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-11-03 12:03:42 AM'),
(608, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 12:03:43 AM'),
(609, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-11-03 12:03:43 AM'),
(610, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 12:03:45 AM'),
(611, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 12:03:46 AM'),
(612, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 12:03:52 AM'),
(613, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 12:03:55 AM'),
(614, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 12:06:15 AM'),
(615, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 12:06:23 AM'),
(616, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 12:17:33 AM'),
(617, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:17:35 AM'),
(618, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 12:17:37 AM'),
(619, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 12:31:28 AM');
INSERT INTO `security_log` (`ID`, `UserID`, `Agent`, `Platform`, `IPAddress`, `Country`, `PageURL`, `DateAdded`) VALUES
(620, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:31:30 AM'),
(621, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 12:31:32 AM'),
(622, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:32:24 AM'),
(623, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:32:55 AM'),
(624, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 12:32:56 AM'),
(625, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:32:58 AM'),
(626, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:36:49 AM'),
(627, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:36:58 AM'),
(628, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:37:13 AM'),
(629, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:37:16 AM'),
(630, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:37:16 AM'),
(631, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:37:16 AM'),
(632, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:37:28 AM'),
(633, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:37:32 AM'),
(634, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 12:37:36 AM'),
(635, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:38:02 AM'),
(636, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:38:12 AM'),
(637, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:38:30 AM'),
(638, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:38:39 AM'),
(639, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:38:40 AM'),
(640, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:39:06 AM'),
(641, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:39:11 AM'),
(642, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:39:19 AM'),
(643, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:39:31 AM'),
(644, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:39:42 AM'),
(645, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:40:00 AM'),
(646, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:40:18 AM'),
(647, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:40:32 AM'),
(648, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:42:01 AM'),
(649, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:42:01 AM'),
(650, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:42:17 AM'),
(651, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:42:25 AM'),
(652, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:42:52 AM'),
(653, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:46:30 AM'),
(654, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:46:31 AM'),
(655, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 12:46:32 AM'),
(656, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:46:36 AM'),
(657, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:46:42 AM'),
(658, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:47:09 AM'),
(659, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:47:26 AM'),
(660, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:48:36 AM'),
(661, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:49:13 AM'),
(662, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:49:14 AM'),
(663, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:49:14 AM'),
(664, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:49:14 AM'),
(665, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:49:14 AM'),
(666, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:49:14 AM'),
(667, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:49:55 AM'),
(668, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:50:03 AM'),
(669, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:50:18 AM'),
(670, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:50:30 AM'),
(671, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:50:38 AM'),
(672, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:50:39 AM'),
(673, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:50:39 AM'),
(674, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:50:55 AM'),
(675, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:50:55 AM'),
(676, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:51:27 AM'),
(677, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:51:27 AM'),
(678, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:51:28 AM'),
(679, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:51:53 AM'),
(680, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:51:57 AM'),
(681, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:52:06 AM'),
(682, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:52:22 AM'),
(683, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 12:58:14 AM'),
(684, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:03:32 AM'),
(685, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:05:03 AM'),
(686, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:05:07 AM'),
(687, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:05:09 AM'),
(688, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:05:30 AM'),
(689, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:06:09 AM'),
(690, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:06:28 AM'),
(691, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:06:36 AM'),
(692, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:06:36 AM'),
(693, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:06:36 AM'),
(694, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:07:50 AM'),
(695, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:08:19 AM'),
(696, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:08:20 AM'),
(697, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:09:19 AM'),
(698, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:09:25 AM'),
(699, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:09:29 AM'),
(700, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:09:33 AM'),
(701, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:09:47 AM'),
(702, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:09:48 AM'),
(703, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:09:49 AM'),
(704, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:10:09 AM'),
(705, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:10:52 AM'),
(706, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:11:21 AM'),
(707, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:11:22 AM'),
(708, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:11:22 AM'),
(709, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:11:24 AM'),
(710, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:11:33 AM'),
(711, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:11:39 AM'),
(712, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:11:39 AM'),
(713, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:11:39 AM'),
(714, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:11:39 AM'),
(715, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:11:45 AM'),
(716, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:12:32 AM'),
(717, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:37 AM'),
(718, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:37 AM'),
(719, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:12:45 AM'),
(720, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:12:46 AM'),
(721, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(722, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(723, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(724, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(725, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(726, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(727, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(728, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(729, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(730, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(731, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(732, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(733, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(734, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(735, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(736, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(737, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(738, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(739, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:12:51 AM'),
(740, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:13:09 AM'),
(741, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:19:17 AM'),
(742, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:19:41 AM'),
(743, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:19:41 AM'),
(744, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:19:41 AM'),
(745, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:19:41 AM'),
(746, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:19:41 AM'),
(747, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:19:41 AM'),
(748, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:19:41 AM'),
(749, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:19:41 AM'),
(750, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:19:41 AM'),
(751, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:19:41 AM'),
(752, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:19:42 AM'),
(753, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:19:42 AM'),
(754, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:19:42 AM'),
(755, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:21:19 AM'),
(756, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:21:36 AM'),
(757, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:21:43 AM'),
(758, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:22:00 AM'),
(759, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:08 AM'),
(760, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:08 AM'),
(761, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(762, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(763, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(764, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(765, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(766, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(767, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(768, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(769, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(770, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(771, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(772, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(773, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(774, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(775, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(776, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(777, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(778, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(779, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(780, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:22:09 AM'),
(781, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:22:31 AM'),
(782, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:22:31 AM'),
(783, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:23:32 AM'),
(784, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(785, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(786, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(787, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(788, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(789, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(790, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(791, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(792, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(793, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(794, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(795, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(796, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(797, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(798, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(799, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:24:05 AM'),
(800, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:24:13 AM'),
(801, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:24:56 AM'),
(802, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:25:03 AM'),
(803, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:36:57 AM'),
(804, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-11-03 01:37:07 AM'),
(805, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-11-03 01:37:08 AM'),
(806, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/bills', '2021-11-03 01:37:09 AM'),
(807, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-11-03 01:37:10 AM'),
(808, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/vendors', '2021-11-03 01:37:18 AM'),
(809, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-11-03 01:37:19 AM'),
(810, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/clients', '2021-11-03 01:37:19 AM'),
(811, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-11-03 01:37:20 AM'),
(812, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/invoices', '2021-11-03 01:37:35 AM'),
(813, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:37:39 AM'),
(814, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:37:41 AM'),
(815, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:37:42 AM'),
(816, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:44:28 AM'),
(817, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:18 AM'),
(818, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:18 AM'),
(819, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:18 AM'),
(820, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:18 AM'),
(821, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:18 AM'),
(822, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:18 AM'),
(823, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:18 AM'),
(824, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:18 AM'),
(825, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:18 AM'),
(826, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:18 AM'),
(827, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:31 AM'),
(828, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:31 AM'),
(829, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:31 AM'),
(830, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:31 AM'),
(831, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:31 AM'),
(832, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:31 AM'),
(833, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:31 AM'),
(834, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:31 AM'),
(835, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:31 AM'),
(836, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:31 AM'),
(837, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:32 AM'),
(838, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:32 AM'),
(839, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:32 AM'),
(840, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:32 AM'),
(841, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:45:32 AM'),
(842, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:45:40 AM'),
(843, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/release_fromcart', '2021-11-03 01:45:54 AM'),
(844, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:47:19 AM'),
(845, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:47:20 AM'),
(846, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:47:24 AM'),
(847, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:47:26 AM'),
(848, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:47:26 AM'),
(849, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:47:28 AM'),
(850, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:47:29 AM'),
(851, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:47:30 AM'),
(852, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:47:31 AM'),
(853, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:47:32 AM'),
(854, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:47:33 AM'),
(855, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:47:35 AM'),
(856, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:47:37 AM'),
(857, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/clients', '2021-11-03 01:47:43 AM'),
(858, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/invoices', '2021-11-03 01:47:43 AM'),
(859, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/sales_orders', '2021-11-03 01:47:45 AM'),
(860, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/purchase_orders', '2021-11-03 01:47:57 AM'),
(861, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:48:34 AM'),
(862, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:48:46 AM'),
(863, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:48:47 AM'),
(864, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:48:48 AM'),
(865, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:48:49 AM'),
(866, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:48:50 AM'),
(867, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:49:16 AM'),
(868, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:55:53 AM'),
(869, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(870, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(871, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(872, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(873, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(874, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(875, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(876, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(877, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(878, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(879, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(880, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(881, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(882, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:00 AM'),
(883, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:01 AM'),
(884, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:01 AM'),
(885, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:16 AM'),
(886, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:16 AM'),
(887, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:26 AM'),
(888, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:26 AM'),
(889, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:26 AM'),
(890, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:26 AM'),
(891, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:27 AM'),
(892, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/get_productDetails', '2021-11-03 01:56:27 AM'),
(893, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/Restock_from_cart', '2021-11-03 01:56:41 AM'),
(894, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:56:41 AM'),
(895, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:56:56 AM'),
(896, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin', '2021-11-03 01:57:00 AM'),
(897, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:57:02 AM'),
(898, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:57:03 AM'),
(899, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:57:07 AM'),
(900, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:57:09 AM'),
(901, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:57:11 AM'),
(902, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:57:19 AM'),
(903, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:57:25 AM'),
(904, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:57:27 AM'),
(905, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/viewproduct', '2021-11-03 01:57:28 AM'),
(906, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:57:30 AM'),
(907, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:57:45 AM'),
(908, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:57:47 AM'),
(909, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:57:50 AM'),
(910, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:57:51 AM'),
(911, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:57:52 AM'),
(912, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:57:52 AM'),
(913, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:57:53 AM'),
(914, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:57:53 AM'),
(915, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:57:54 AM'),
(916, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/viewproduct', '2021-11-03 01:57:56 AM'),
(917, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:58:01 AM'),
(918, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:58:03 AM'),
(919, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/viewproduct', '2021-11-03 01:58:05 AM'),
(920, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:58:06 AM'),
(921, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/viewproduct', '2021-11-03 01:58:07 AM'),
(922, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:58:25 AM'),
(923, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:58:28 AM'),
(924, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:58:29 AM'),
(925, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:58:43 AM'),
(926, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/products', '2021-11-03 01:58:44 AM'),
(927, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:58:49 AM'),
(928, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:58:50 AM');
INSERT INTO `security_log` (`ID`, `UserID`, `Agent`, `Platform`, `IPAddress`, `Country`, `PageURL`, `DateAdded`) VALUES
(929, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_restocking', '2021-11-03 01:58:53 AM'),
(930, '60bf510d64ba8', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 'TBD', 'https://localhost/manalok9/admin/product_releasing', '2021-11-03 01:58:55 AM');

-- --------------------------------------------------------

--
-- Table structure for table `tb_brand`
--

CREATE TABLE `tb_brand` (
  `U_ID` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Category` varchar(255) DEFAULT NULL,
  `Product_Type` varchar(255) DEFAULT NULL,
  `Time_Stamp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_brand_properties`
--

CREATE TABLE `tb_brand_properties` (
  `U_ID` varchar(255) DEFAULT NULL,
  `Brand` varchar(255) DEFAULT NULL,
  `Product_Line` varchar(255) DEFAULT NULL,
  `Product_Type` varchar(255) DEFAULT NULL,
  `Variant_ID` varchar(255) DEFAULT NULL,
  `Product_Size` varchar(255) DEFAULT NULL,
  `Time_Stamp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('lK3rp8pINH0Td3lQV5mMvOAn1cclOfGgvBBV8lqWF343', 'SDN', 'sad', 'asdwdw', 'SDN', 'dsadas', 'asdasdas', 'ORIGINAL', '10 KG', 'SDN001ORIG10KG', 'Asia/Manila'),
('TREKJSx9yJsv9OdEesqiSS9faTMyTEesaYqGfVf6X0CY', 'SDN', '001', 'DOG FOOD', 'SDN', 'DOG FOOD', 'PREMIUM', 'ORIGINAL', '500 G', 'SDN001ORIG500G', 'Asia/Manila'),
('lK3rp8pINH0Td3lQV5mMvOAn1cclOfGgvBBV8lqWF343', 'SDN', 'sad', 'asdwdw', 'SDN', 'dsadas', 'asdasdas', 'ORIGINAL', '10 KG', 'SDN001ORIG10KG', 'Asia/Manila');

-- --------------------------------------------------------

--
-- Table structure for table `tb_variant_properties`
--

CREATE TABLE `tb_variant_properties` (
  `Variant_ID` varchar(255) DEFAULT NULL,
  `Variant` varchar(255) DEFAULT NULL,
  `Color` varchar(255) DEFAULT NULL,
  `Print` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Time_Stamp` varchar(255) DEFAULT NULL
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
(57, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 1, '2021-10-21 11:18:11 PM'),
(58, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 1, '2021-10-23 06:05:44 PM'),
(59, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 95.0.4638.54', 'Windows 10', '::1', 1, '2021-10-23 10:49:12 PM'),
(60, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 1, '2021-11-02 03:21:35 PM'),
(61, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 1, '2021-11-02 08:50:22 PM');

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
-- AUTO_INCREMENT for table `cart_release`
--
ALTER TABLE `cart_release`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `logbook`
--
ALTER TABLE `logbook`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products_transactions`
--
ALTER TABLE `products_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=931;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
