-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 25, 2022 at 02:14 PM
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
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `ID` int(11) NOT NULL,
  `Date` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Total` varchar(255) DEFAULT NULL,
  `Type` varchar(127) DEFAULT NULL,
  `OrderNo` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `manual_transactions`
--

CREATE TABLE `manual_transactions` (
  `ID` int(11) NOT NULL,
  `OrderNo` varchar(255) DEFAULT NULL,
  `ItemNo` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Qty` int(11) DEFAULT NULL,
  `UnitCost` varchar(255) DEFAULT NULL,
  `Date` varchar(50) DEFAULT NULL,
  `Status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Freebie` int(11) DEFAULT 0 COMMENT '0=no;1=yes;'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `product_released`
--

CREATE TABLE `product_released` (
  `id` int(11) NOT NULL,
  `stockid` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `transactionid` varchar(255) DEFAULT NULL,
  `uid` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `prd_sku` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `retail_price` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL,
  `userid` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `date_added` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `Freebie` int(11) DEFAULT 0 COMMENT '0=no;1=yes;'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_returned`
--

CREATE TABLE `product_returned` (
  `id` int(11) NOT NULL,
  `returnno` varchar(32) DEFAULT NULL,
  `stockid` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `transactionid` varchar(255) DEFAULT NULL,
  `prd_sku` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  `quantity_total` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `returned` int(11) DEFAULT 0 COMMENT 'qty returned to inventory',
  `userid` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `date_added` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
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
  `Action` varchar(127) DEFAULT NULL,
  `Allowed` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `product_released`
--
ALTER TABLE `product_released`
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
-- Indexes for table `returns`
--
ALTER TABLE `returns`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_category`
--
ALTER TABLE `brand_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_properties`
--
ALTER TABLE `brand_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_size`
--
ALTER TABLE `brand_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_vcpd`
--
ALTER TABLE `brand_vcpd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_release`
--
ALTER TABLE `cart_release`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_restocking`
--
ALTER TABLE `cart_restocking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_transactions`
--
ALTER TABLE `journal_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logbook`
--
ALTER TABLE `logbook`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manual_transactions`
--
ALTER TABLE `manual_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_transactions`
--
ALTER TABLE `products_transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_released`
--
ALTER TABLE `product_released`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_returned`
--
ALTER TABLE `product_returned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
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
-- AUTO_INCREMENT for table `tb_mailsent`
--
ALTER TABLE `tb_mailsent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
