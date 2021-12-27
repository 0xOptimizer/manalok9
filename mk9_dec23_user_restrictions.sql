-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 23, 2021 at 09:06 AM
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
(32, '61c3f4a7912c4', 'products_view', b'1'),
(33, '61c3f4a7912c4', 'products_add', b'1'),
(34, '61c3f4a7912c4', 'products_edit', b'1'),
(35, '61c3f4a7912c4', 'products_delete', b'1'),
(36, '61c3f4a7912c4', 'releasing', b'1'),
(37, '61c3f4a7912c4', 'restocking', b'1'),
(38, '61c3f4a7912c4', 'vendors_view', b'1'),
(39, '61c3f4a7912c4', 'vendors_add', b'1'),
(40, '61c3f4a7912c4', 'vendors_edit', b'1'),
(41, '61c3f4a7912c4', 'vendors_delete', b'1'),
(42, '61c3f4a7912c4', 'purchase_orders_view', b'1'),
(43, '61c3f4a7912c4', 'purchase_orders_add', b'1'),
(44, '61c3f4a7912c4', 'purchase_orders_approve', b'1'),
(45, '61c3f4a7912c4', 'purchase_orders_bill_creation', b'1'),
(46, '61c3f4a7912c4', 'bills_view', b'1'),
(47, '61c3f4a7912c4', 'sales_orders_view', b'1'),
(48, '61c3f4a7912c4', 'sales_orders_add', b'1'),
(49, '61c3f4a7912c4', 'sales_orders_mark_for_invoicing', b'1'),
(50, '61c3f4a7912c4', 'sales_orders_schedule_delivery', b'1'),
(51, '61c3f4a7912c4', 'sales_orders_mark_as_delivered', b'1'),
(52, '61c3f4a7912c4', 'sales_orders_mark_as_received', b'1'),
(53, '61c3f4a7912c4', 'sales_orders_invoice_creation', b'1'),
(54, '61c3f4a7912c4', 'invoice_view', b'1'),
(55, '61c3f4a7912c4', 'brand_category_view', b'1'),
(56, '61c3f4a7912c4', 'trash_bin_view', b'1'),
(57, '61c3f4a7912c4', 'accounts_view', b'1'),
(58, '61c3f4a7912c4', 'accounts_add', NULL),
(59, '61c3f4a7912c4', 'accounts_edit', NULL),
(60, '61c3f4a7912c4', 'journal_transactions_view', NULL),
(61, '61c3f4a7912c4', 'journal_transactions_add', NULL),
(62, '61c3f4a7912c4', 'journal_transactions_delete', NULL),
(63, '60bf510d64ba8', 'products_view', b'1'),
(64, '60bf510d64ba8', 'products_add', NULL),
(65, '60bf510d64ba8', 'products_edit', NULL),
(66, '60bf510d64ba8', 'products_delete', NULL),
(67, '60bf510d64ba8', 'releasing', NULL),
(68, '60bf510d64ba8', 'restocking', NULL),
(69, '60bf510d64ba8', 'vendors_view', b'1'),
(70, '60bf510d64ba8', 'vendors_add', NULL),
(71, '60bf510d64ba8', 'vendors_edit', NULL),
(72, '60bf510d64ba8', 'vendors_delete', NULL),
(73, '60bf510d64ba8', 'purchase_orders_view', NULL),
(74, '60bf510d64ba8', 'purchase_orders_add', NULL),
(75, '60bf510d64ba8', 'purchase_orders_approve', NULL),
(76, '60bf510d64ba8', 'purchase_orders_bill_creation', NULL),
(77, '60bf510d64ba8', 'bills_view', NULL),
(78, '60bf510d64ba8', 'sales_orders_view', NULL),
(79, '60bf510d64ba8', 'sales_orders_add', NULL),
(80, '60bf510d64ba8', 'sales_orders_mark_for_invoicing', NULL),
(81, '60bf510d64ba8', 'sales_orders_schedule_delivery', NULL),
(82, '60bf510d64ba8', 'sales_orders_mark_as_delivered', NULL),
(83, '60bf510d64ba8', 'sales_orders_mark_as_received', NULL),
(84, '60bf510d64ba8', 'sales_orders_invoice_creation', NULL),
(85, '60bf510d64ba8', 'invoice_view', NULL),
(86, '60bf510d64ba8', 'brand_category_view', b'1'),
(87, '60bf510d64ba8', 'trash_bin_view', NULL),
(88, '60bf510d64ba8', 'accounts_view', NULL),
(89, '60bf510d64ba8', 'accounts_add', NULL),
(90, '60bf510d64ba8', 'accounts_edit', NULL),
(91, '60bf510d64ba8', 'journal_transactions_view', NULL),
(92, '60bf510d64ba8', 'journal_transactions_add', NULL),
(93, '60bf510d64ba8', 'journal_transactions_delete', NULL),
(94, '61c42b794f0b1', 'products_view', NULL),
(95, '61c42b794f0b1', 'products_add', NULL),
(96, '61c42b794f0b1', 'products_edit', NULL),
(97, '61c42b794f0b1', 'products_delete', NULL),
(98, '61c42b794f0b1', 'releasing', NULL),
(99, '61c42b794f0b1', 'restocking', b'1'),
(100, '61c42b794f0b1', 'vendors_view', NULL),
(101, '61c42b794f0b1', 'vendors_add', NULL),
(102, '61c42b794f0b1', 'vendors_edit', NULL),
(103, '61c42b794f0b1', 'vendors_delete', NULL),
(104, '61c42b794f0b1', 'purchase_orders_view', NULL),
(105, '61c42b794f0b1', 'purchase_orders_add', NULL),
(106, '61c42b794f0b1', 'purchase_orders_approve', NULL),
(107, '61c42b794f0b1', 'purchase_orders_bill_creation', NULL),
(108, '61c42b794f0b1', 'bills_view', NULL),
(109, '61c42b794f0b1', 'sales_orders_view', NULL),
(110, '61c42b794f0b1', 'sales_orders_add', NULL),
(111, '61c42b794f0b1', 'sales_orders_mark_for_invoicing', NULL),
(112, '61c42b794f0b1', 'sales_orders_schedule_delivery', NULL),
(113, '61c42b794f0b1', 'sales_orders_mark_as_delivered', NULL),
(114, '61c42b794f0b1', 'sales_orders_mark_as_received', NULL),
(115, '61c42b794f0b1', 'sales_orders_invoice_creation', NULL),
(116, '61c42b794f0b1', 'invoice_view', NULL),
(117, '61c42b794f0b1', 'brand_category_view', b'1'),
(118, '61c42b794f0b1', 'trash_bin_view', NULL),
(119, '61c42b794f0b1', 'accounts_view', NULL),
(120, '61c42b794f0b1', 'accounts_add', NULL),
(121, '61c42b794f0b1', 'accounts_edit', NULL),
(122, '61c42b794f0b1', 'journal_transactions_view', NULL),
(123, '61c42b794f0b1', 'journal_transactions_add', NULL),
(124, '61c42b794f0b1', 'journal_transactions_delete', NULL),
(156, '61c42c3d66939', 'products_view', b'1'),
(157, '61c42c3d66939', 'products_add', b'1'),
(158, '61c42c3d66939', 'products_edit', b'1'),
(159, '61c42c3d66939', 'products_delete', b'1'),
(160, '61c42c3d66939', 'releasing', b'1'),
(161, '61c42c3d66939', 'restocking', b'1'),
(162, '61c42c3d66939', 'inventory_view', b'1'),
(163, '61c42c3d66939', 'users_view', b'1'),
(164, '61c42c3d66939', 'users_add', b'1'),
(165, '61c42c3d66939', 'users_edit', b'1'),
(166, '61c42c3d66939', 'vendors_view', b'1'),
(167, '61c42c3d66939', 'vendors_add', b'1'),
(168, '61c42c3d66939', 'vendors_edit', b'1'),
(169, '61c42c3d66939', 'vendors_delete', b'1'),
(170, '61c42c3d66939', 'purchase_orders_view', b'1'),
(171, '61c42c3d66939', 'purchase_orders_add', b'1'),
(172, '61c42c3d66939', 'purchase_orders_approve', b'1'),
(173, '61c42c3d66939', 'purchase_orders_bill_creation', b'1'),
(174, '61c42c3d66939', 'bills_view', b'1'),
(175, '61c42c3d66939', 'sales_orders_view', b'1'),
(176, '61c42c3d66939', 'sales_orders_add', b'1'),
(177, '61c42c3d66939', 'sales_orders_mark_for_invoicing', b'1'),
(178, '61c42c3d66939', 'sales_orders_schedule_delivery', b'1'),
(179, '61c42c3d66939', 'sales_orders_mark_as_delivered', b'1'),
(180, '61c42c3d66939', 'sales_orders_mark_as_received', b'1'),
(181, '61c42c3d66939', 'sales_orders_invoice_creation', b'1'),
(182, '61c42c3d66939', 'invoice_view', b'1'),
(183, '61c42c3d66939', 'brand_category_view', b'1'),
(184, '61c42c3d66939', 'trash_bin_view', b'1'),
(185, '61c42c3d66939', 'accounts_view', b'1'),
(186, '61c42c3d66939', 'accounts_add', b'1'),
(187, '61c42c3d66939', 'accounts_edit', b'1'),
(188, '61c42c3d66939', 'journal_transactions_view', b'1'),
(189, '61c42c3d66939', 'journal_transactions_add', b'1'),
(190, '61c42c3d66939', 'journal_transactions_delete', b'1');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
