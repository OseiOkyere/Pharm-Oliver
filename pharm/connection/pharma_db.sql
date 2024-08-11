-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2024 at 04:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharma_db`
--
DROP DATABASE IF EXISTS `pharma_db`;
CREATE DATABASE IF NOT EXISTS `pharma_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pharma_db`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Pain Relief', 'Medications for relieving pain'),
(2, 'Antibiotics', 'Medications for treating infections'),
(3, 'Vitamins', 'Supplements to boost overall health'),
(4, 'Cough & Cold', 'Medications for cold and flu symptoms'),
(5, 'Diabetes Care', 'Products for managing diabetes'),
(6, 'Skin Care', 'Products for skincare and treatment'),
(7, 'Eye Care', 'Medications for eye conditions'),
(8, 'Allergies', 'Medications for treating allergies'),
(9, 'Digestive Health', 'Products for digestive health'),
(10, 'Heart Health', 'Medications for heart and blood pressure');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role` enum('admin','manager','staff') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `username`, `password_hash`, `first_name`, `last_name`, `role`, `created_at`, `updated_at`) VALUES
(1, 'jdoe', '5f4dcc3b5aa765d61d8327deb882cf99', 'John', 'Doe', 'admin', '2024-01-10 09:00:00', '2024-01-10 09:00:00'),
(2, 'jsmith', '5f4dcc3b5aa765d61d8327deb882cf99', 'Jane', 'Smith', 'manager', '2024-02-15 14:30:00', '2024-02-15 14:30:00'),
(3, 'ejohnson', '5f4dcc3b5aa765d61d8327deb882cf99', 'Emily', 'Johnson', 'staff', '2024-03-20 10:15:00', '2024-03-20 10:15:00'),
(4, 'mbrown', '5f4dcc3b5aa765d61d8327deb882cf99', 'Michael', 'Brown', 'manager', '2024-04-25 11:45:00', '2024-04-25 11:45:00'),
(5, 'sdavis', '5f4dcc3b5aa765d61d8327deb882cf99', 'Sarah', 'Davis', 'staff', '2024-05-30 13:00:00', '2024-05-30 13:00:00'),
(6, 'dwilson', '5f4dcc3b5aa765d61d8327deb882cf99', 'David', 'Wilson', 'admin', '2024-06-10 09:20:00', '2024-06-10 09:20:00'),
(7, 'lmartinez', '5f4dcc3b5aa765d61d8327deb882cf99', 'Laura', 'Martinez', 'staff', '2024-07-15 15:30:00', '2024-07-15 15:30:00'),
(8, 'jtaylor', '5f4dcc3b5aa765d61d8327deb882cf99', 'James', 'Taylor', 'manager', '2024-08-05 08:00:00', '2024-08-05 08:00:00'),
(9, 'athomas', '5f4dcc3b5aa765d61d8327deb882cf99', 'Anna', 'Thomas', 'staff', '2024-08-10 10:45:00', '2024-08-10 10:45:00'),
(10, 'rmoore', '5f4dcc3b5aa765d61d8327deb882cf99', 'Robert', 'Moore', 'admin', '2024-08-09 14:00:00', '2024-08-09 14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `category_id`, `supplier_id`, `created_at`, `updated_at`) VALUES
(3, 'Vitamin C', 'Immune support supplement', 6.99, 200, 3, 3, '2024-08-10 16:34:44', '2024-08-10 16:34:44'),
(4, 'Cough Syrup', 'Relief for cough and cold symptoms', 5.49, 120, 4, 4, '2024-08-10 16:34:44', '2024-08-10 16:34:44'),
(5, 'Metformin', 'Diabetes management medication', 12.99, 80, 5, 5, '2024-08-10 16:34:44', '2024-08-10 16:34:44'),
(6, 'Moisturizing Cream', 'Hydrates and softens skin', 7.99, 150, 6, 6, '2024-08-10 16:34:44', '2024-08-10 16:34:44'),
(7, 'Eye Drops', 'Relieves dry and irritated eyes', 9.49, 60, 7, 7, '2024-08-10 16:34:44', '2024-08-10 16:34:44'),
(8, 'Antihistamine Tablets', 'Relief from allergy symptoms', 10.99, 90, 8, 8, '2024-08-10 16:34:44', '2024-08-10 16:34:44'),
(9, 'Probiotics', 'Supports digestive health', 14.99, 70, 9, 9, '2024-08-10 16:34:44', '2024-08-10 16:34:44'),
(10, 'Blood Pressure Monitor', 'Home blood pressure monitoring', 29.99, 30, 10, 10, '2024-08-10 16:34:44', '2024-08-10 16:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `sale_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `sale_date`, `total_amount`, `customer_name`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, '2024-08-01 10:00:00', 15.99, 'Alice Green', 'Credit Card', '2024-08-01 10:00:00', '2024-08-01 10:00:00'),
(2, '2024-08-02 14:30:00', 29.49, 'Bob White', 'Cash', '2024-08-02 14:30:00', '2024-08-02 14:30:00'),
(3, '2024-08-03 16:45:00', 22.99, 'Charlie Black', 'Debit Card', '2024-08-03 16:45:00', '2024-08-03 16:45:00'),
(4, '2024-08-04 11:15:00', 45.89, 'Diana Blue', 'Credit Card', '2024-08-04 11:15:00', '2024-08-04 11:15:00'),
(5, '2024-08-05 09:20:00', 12.49, 'Ethan Red', 'Cash', '2024-08-05 09:20:00', '2024-08-05 09:20:00'),
(6, '2024-08-06 15:50:00', 19.99, 'Fiona Yellow', 'Debit Card', '2024-08-06 15:50:00', '2024-08-06 15:50:00'),
(7, '2024-08-07 13:10:00', 37.50, 'George Brown', 'Credit Card', '2024-08-07 13:10:00', '2024-08-07 13:10:00'),
(8, '2024-08-08 17:05:00', 26.75, 'Hannah White', 'Cash', '2024-08-08 17:05:00', '2024-08-08 17:05:00'),
(9, '2024-08-09 12:40:00', 33.89, 'Ian Green', 'Debit Card', '2024-08-09 12:40:00', '2024-08-09 12:40:00'),
(10, '2024-08-10 10:30:00', 41.20, 'Jack Black', 'Credit Card', '2024-08-10 10:30:00', '2024-08-10 10:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact_info`) VALUES
(1, 'MediSupplies Inc.', 'Phone: +123456789, Email: contact@medisupplies.com'),
(2, 'HealthPlus Pharma', 'Phone: +987654321, Email: info@healthplus.com'),
(3, 'GlobalPharm Ltd.', 'Phone: +112233445, Email: sales@globalpharm.com'),
(4, 'Care Pharmaceuticals', 'Phone: +998877665, Email: care@pharma.com'),
(5, 'Wellness Supplies', 'Phone: +556677889, Email: wellness@supplies.com'),
(6, 'PharmaLink', 'Phone: +223344556, Email: contact@pharmalink.com'),
(7, 'Optimum Health', 'Phone: +445566778, Email: info@optimumhealth.com'),
(8, 'Vital Pharma', 'Phone: +667788990, Email: support@vitalpharma.com'),
(9, 'MedCare Solutions', 'Phone: +334455667, Email: info@medcare.com'),
(10, 'HealthFirst Distributors', 'Phone: +778899001, Email: contact@healthfirst.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
