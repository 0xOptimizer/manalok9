-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 23, 2021 at 11:11 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_restrictions`
--
ALTER TABLE `user_restrictions`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_restrictions`
--
ALTER TABLE `user_restrictions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
