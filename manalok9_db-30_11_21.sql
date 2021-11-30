-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2021 at 09:17 AM
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
(2, 'I-000002', 'SO-000001', '150', 'Cash', '2021-11-30'),
(3, 'I-000003', 'SO-000004', '500', 'Cash', '2021-11-30'),
(6, 'I-000003', 'SO-000002', '200', 'Cash', '2021-11-30'),
(7, 'I-000004', 'SO-000002', '225', 'Cash', '2021-11-30'),
(8, 'I-000005', 'SO-000001', '350', 'Cash', '2021-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `ID` int(11) NOT NULL,
  `Date` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Total` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`ID`, `Date`, `Description`, `Total`) VALUES
(1, '2021-11-26', NULL, NULL),
(2, '2021-11-26', 'Payment of rent', '1000'),
(3, '2021-11-26', 'Payment of rent', NULL),
(4, '2021-11-26', 'Cash Sales from customer, recorded using sales order', NULL),
(5, '2021-11-26', 'Purchase of office supplies', NULL);

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
(1, 3, 4, '1000', '0'),
(2, 3, 2, '0', '1000'),
(3, 4, 2, '2000', '0'),
(4, 4, 6, '0', '2000'),
(5, 5, 8, '1500', '0'),
(6, 5, 2, '0', '1500');

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
(1, 'created a new vendor.', 'added a new vendor Grey Mann [ID: 8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/vendors', '2021-11-30 08:02:38 AM'),
(2, 'generated a new bill.', 'generated a new bill [ID: 1].', '60bf510d64ba8', 'https://localhost/manalok9/admin/bills', '2021-11-30 08:15:31 AM'),
(3, 'generated a new bill.', 'generated a new bill [ID: 2].', '60bf510d64ba8', 'https://localhost/manalok9/admin/bills', '2021-11-30 08:16:19 AM'),
(4, 'generated a new invoice.', 'generated a new invoice [ID: 3].', '60bf510d64ba8', 'https://localhost/manalok9/admin/invoices', '2021-11-30 09:42:59 AM'),
(5, 'generated a new invoice.', 'generated a new invoice [ID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/invoices', '2021-11-30 09:45:54 AM'),
(6, 'approved sales order.', 'approved sales order SO-000004 [SalesOrderID: 4].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000004', '2021-11-30 12:18:26 PM'),
(7, 'scheduled delivery.', 'scheduled delivery for sales order [No: SO-000004].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000004', '2021-11-30 12:45:10 PM'),
(8, 'scheduled delivery.', 'scheduled delivery for sales order [No: SO-000004].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000004', '2021-11-30 12:46:24 PM'),
(9, 'approved sales order.', 'approved sales order SO-000002 [SalesOrderID: 2].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000002', '2021-11-30 01:29:53 PM'),
(10, 'generated a new invoice.', 'generated a new invoice [ID: 5].', '60bf510d64ba8', 'https://localhost/manalok9/admin/invoices', '2021-11-30 01:30:03 PM'),
(11, 'generated a new invoice.', 'generated a new invoice [ID: 6].', '60bf510d64ba8', 'https://localhost/manalok9/admin/invoices', '2021-11-30 01:30:39 PM'),
(12, 'generated a new invoice.', 'generated a new invoice [ID: 7].', '60bf510d64ba8', 'https://localhost/manalok9/admin/invoices', '2021-11-30 01:30:48 PM'),
(13, 'scheduled delivery.', 'scheduled delivery for sales order [No: ].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=', '2021-11-30 01:31:05 PM'),
(14, 'scheduled delivery.', 'scheduled delivery for sales order [No: ].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=', '2021-11-30 01:32:18 PM'),
(15, 'scheduled delivery.', 'scheduled delivery for sales order [No: SO-000002].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000002', '2021-11-30 01:32:46 PM'),
(16, 'marked SO as delivered.', 'sales order marked as delivered [No: ].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=', '2021-11-30 01:32:56 PM'),
(17, 'marked SO as delivered.', 'sales order marked as delivered [No: SO-000002].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000002', '2021-11-30 01:34:52 PM'),
(18, 'marked SO as received.', 'sales order marked as received [No: SO-000002].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000002', '2021-11-30 01:36:25 PM'),
(19, 'generated a new invoice.', 'generated a new invoice [ID: 8].', '60bf510d64ba8', 'https://localhost/manalok9/admin/invoices', '2021-11-30 01:37:59 PM'),
(20, 'scheduled delivery.', 'scheduled delivery for sales order [No: SO-000001].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000001', '2021-11-30 01:38:15 PM'),
(21, 'marked SO as delivered.', 'sales order marked as delivered [No: SO-000001].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000001', '2021-11-30 01:38:22 PM'),
(22, 'marked SO as received.', 'sales order marked as received [No: SO-000001].', '60bf510d64ba8', 'https://localhost/manalok9/admin/view_sales_order?orderNo=SO-000001', '2021-11-30 01:38:25 PM'),
(23, 'logged in.', '', '60bf510d64ba8', '', '2021-11-30 03:50:34 PM'),
(24, 'logged in.', '', '60bf510d64ba8', '', '2021-11-30 04:14:36 PM'),
(25, 'updated user details.', 'updated details of user chiruno borger [UserID: 60bc6643380bb].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-11-30 04:15:20 PM'),
(26, 'updated user details.', 'updated details of user chiruno borger [UserID: 60bc6643380bb].', '60bf510d64ba8', 'https://localhost/manalok9/admin/users', '2021-11-30 04:16:09 PM');

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
  `Barcode_Images` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL COMMENT '1 = added\r\n2 = archive\r\n3 = removed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Code`, `Product_Name`, `Description`, `InStock`, `Released`, `Product_Category`, `Product_Weight`, `Price_PerItem`, `Cost_PerItem`, `DateAdded`, `PriceSelling`, `Barcode_Images`, `Status`) VALUES
(1, 'SND001DGFDPREMORIGXS', '123', '123', 10, 0, 'PREM', 'XS', '13', '13', '2021-11-18 12:32:01 AM', '0', 'assets/barcode_images/SND001DGFDPREMORIGXS-pbarcode.png', 1),
(2, 'SND001DGFDPREMORIGS', 'dasdsadsa', '2312', 500, 0, 'PREM', 'S', '32', '32', '2021-11-19 09:21:26 PM', '0', 'assets/barcode_images/SND001DGFDPREMORIGS-pbarcode.png', 1),
(8, 'SDN001ORIG500G', 'dog snack', 'Sample description', 190, 110, 'DOG FOOD', '500 g', '100', '150', '2021-10-18 11:54:19 AM', '0', 'assets/barcode_images/SDN001ORIG500G-pbarcode.png', 1),
(9, 'SDN001ORIG10KG', 'sadasd', 'dasdas', 0, 0, 'asdwdw', '100 g', '10', '20', '2021-10-22 12:57:54 AM', '0', 'assets/barcode_images/SDN001ORIG10KG-pbarcode.png', 2);

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
(32, 'SDN001ORIG500G', 'SDN001ORIG500G-61817BD96BE37', NULL, 0, 100, '100', 0, '', '2021-11-03 01:56:41 AM', 1, NULL, NULL, '10000'),
(33, 'SND001DGFDPREMORIGXS', 'SND001DGFDPREMORIGXS-61952B3A94ECB', NULL, 0, 100, '321', 0, '', '2021-11-18 12:18:02 AM', 1, NULL, NULL, '32100'),
(34, 'SND001DGFDPREMORIGXS', 'SND001DGFDPREMORIGXS-61A0EF9193A81', NULL, 0, 10, '13', 0, '', '2021-11-26 10:30:41 PM', 1, NULL, NULL, '130'),
(35, 'SND001DGFDPREMORIGS', 'SND001DGFDPREMORIGS-000006', 'PO-000001', 0, 500, '32', 0, '2021-11-29', '2021-11-29 11:58:52 PM', 1, '2021-11-29-23-59-00', '60bf510d64ba8', NULL),
(36, 'SDN001ORIG500G', 'SDN001ORIG500G-000007', 'PO-000001', 0, 300, '150', 0, '2021-11-29', '2021-11-29 11:58:52 PM', 1, '2021-11-29-23-59-00', '60bf510d64ba8', NULL),
(37, 'SDN001ORIG500G', 'SDN001ORIG500G-000008', 'SO-000001', 1, 5, '100', 0, '2021-11-30', '2021-11-30 04:29:42 AM', 1, '2021-11-30-04-29-51', '60bf510d64ba8', NULL),
(38, 'SDN001ORIG500G', 'SDN001ORIG500G-000009', 'SO-000002', 1, 5, '100', 0, '2021-11-30', '2021-11-30 04:50:26 AM', 1, '2021-11-30-13-29-53', '60bf510d64ba8', NULL),
(39, 'SDN001ORIG500G', 'SDN001ORIG500G-000010', 'SO-000003', 1, 5, '100', 0, '2021-11-30', '2021-11-30 04:59:37 AM', 0, NULL, '60bf510d64ba8', NULL),
(40, 'SDN001ORIG500G', 'SDN001ORIG500G-000011', 'SO-000004', 1, 100, '100', 0, '2021-11-30', '2021-11-30 05:16:42 AM', 1, '2021-11-30-12-18-26', '60bf510d64ba8', NULL);

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
(1, 'SND001DGFDPREMORIGXS', 'SND', 'SDN', '001', 'DGFD', 'DGFD', 'PREM', 'ORIG', 'XS'),
(2, 'SND001DGFDPREMORIGS', 'SND', 'SDN', '001', 'DGFD', 'DGFD', 'PREM', 'ORIG', 'S');

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
(1, 'PO-000001', '2021-11-29', '2021-11-29 11:58:52 PM', 'V-000001', 'test', NULL, 2);

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
(1, 'SO-000001', '2021-11-30', '2021-11-30 04:29:42 AM', 'C-000008', 'C-000008', '2021-12-11', '0', 5),
(2, 'SO-000002', '2021-11-30', '2021-11-30 04:50:26 AM', 'C-000006', 'C-000006', '2021-11-25', '15', 5),
(3, 'SO-000003', '2021-11-30', '2021-11-30 04:59:37 AM', 'C-000006', 'C-000006', NULL, '20', 1),
(4, 'SO-000004', '2021-11-30', '2021-11-30 05:16:42 AM', 'C-000008', 'C-000006', '2021-12-12', '25', 3);

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
(1, '60bc6643380bb', 'uploads/60bc6643380bb/hosoinu.png', 'chiruno', '', 'borger', '', '', '', '', '', NULL, '2021-11-30 04:16:09 PM'),
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
(61, '60bf510d64ba8', 'admin', NULL, 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 1, '2021-11-02 08:50:22 PM'),
(62, '60bf510d64ba8', 'admin', '$2y$10$1XXzyv0M3x9YSW5Au6Tn6.N6135pI8lBITHhZlkFFDqfB2iLGsxfG', 'Desktop: Chrome 95.0.4638.69', 'Windows 10', '::1', 1, '2021-11-12 03:32:06 PM'),
(63, '60bf510d64ba8', 'admin', '$2y$10$mC4ZOYqQ5ldP2KGWKOChxeTvMZyKRZZhLC7EVPrg/ZYD2KYOKydXK', 'Desktop: Chrome 96.0.4664.45', 'Windows 10', '::1', 1, '2021-11-17 07:56:20 PM'),
(64, '60bf510d64ba8', 'admin', '$2y$10$l5uSmpeLih6.iOm.Qagp/eOmoZDFTMm5mMk9jCY5T6eM6/fhy4FBu', 'Desktop: Chrome 96.0.4664.45', 'Windows 10', '::1', 1, '2021-11-19 08:42:02 PM'),
(65, '60bf510d64ba8', 'admin', '$2y$10$eOXIqcJPuZ/2pPQQKjk9y.5aT8zXjZilsLXZlk6fTPuIRaFKuVPti', 'Desktop: Chrome 96.0.4664.45', 'Windows 10', '::1', 1, '2021-11-23 04:10:07 PM'),
(66, '60bf510d64ba8', 'admin', '$2y$10$LAzY2baI42m4skW6Vmzv/OzJODa9TRz/MsqTj3LHjHFsJASyMjQSO', 'Desktop: Chrome 96.0.4664.45', 'Windows 10', '::1', 1, '2021-11-25 10:19:48 PM'),
(67, '60bf510d64ba8', 'admin', '$2y$10$0fijs4fPI2kiOXXjaWPzZOLZE0gEhvp.b7MnWGakyzdh8P.IYBD8.', 'Desktop: Chrome 96.0.4664.45', 'Windows 10', '::1', 1, '2021-11-26 08:43:25 PM'),
(68, '60bf510d64ba8', 'admin', '$2y$10$9vk0hBekGKmv3wpRQXj6GOQPU5q4x/F6PNraJxnsqW7SNJ4YEUePS', 'Desktop: Chrome 96.0.4664.45', 'Linux', '::1', 1, '2021-11-30 03:14:53 AM'),
(69, '60bf510d64ba8', 'admin', '$2y$10$5UnIZ5Ik4Upc.bnhejj8OeivPJlH.QhVkSt5DUeCUe03HQ8Q4Jcvu', 'Desktop: Chrome 96.0.4664.45', 'Linux', '::1', 1, '2021-11-30 07:18:19 AM'),
(70, '60bf510d64ba8', 'admin', '$2y$10$rX/7XWfii1fAjQN1jj7EaOZA/NG/7.2wcbXRSCVI.rRuhp6dvuff6', 'Desktop: Chrome 96.0.4664.45', 'Linux', '::1', 1, '2021-11-30 03:50:34 PM'),
(71, '60bf510d64ba8', 'admin', '$2y$10$0AE0KyZQmqrA5pLgMoJOYuZD4yxRY4ghxhUc8Hr7mwvMsjCTmtCEK', 'Desktop: Chrome 96.0.4664.45', 'Linux', '::1', 1, '2021-11-30 04:14:36 PM');

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
(7, 'V-000007', 'NameTest', 'TINTest', 'AddressTest', 'ContactTest', 'KindTest'),
(8, 'V-000008', 'Grey Mann', '123456', 'Test Address', '09123456789', 'Test');

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
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `journal_transactions`
--
ALTER TABLE `journal_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logbook`
--
ALTER TABLE `logbook`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products_transactions`
--
ALTER TABLE `products_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
