-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 03:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `midterm_ddl`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `register_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `email`, `created_at`, `register_id`) VALUES
(1, 'james', 'james@gmail.com', '2024-10-29 13:22:45', 9),
(2, 'kristan', 'kristan@gmail.com', '2024-10-29 13:23:08', 9),
(3, 'raymund', 'raymund@gmail.com', '2024-10-29 13:23:34', 9),
(4, 'sherwin', 'sherwin@gmail.com', '2024-10-29 13:26:29', 10),
(5, 'john', 'john@gmail.com', '2024-10-29 13:34:42', 9),
(6, 'clint', 'clint@gmail.com', '2024-10-29 14:14:20', 9);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `stock`, `created_at`, `customer_id`) VALUES
(101, 'Spark Plug', 350.00, 150, '2024-10-29 13:23:45', 9),
(102, 'Brake Pad Set', 2500.00, 75, '2024-10-29 13:24:01', 10),
(103, 'Air Filter', 800.00, 200, '2024-10-29 13:26:45', 11),
(104, 'Car Battery', 7000.00, 50, '2024-10-29 13:36:46', 8),
(105, 'Oil Filter', 450.00, 300, '2024-10-29 14:14:38', 13),
(106, 'Timing Belt', 3000.00, 120, '2024-10-29 14:20:00', 9),
(107, 'Radiator', 12500.00, 30, '2024-10-29 14:30:15', 10),
(108, 'LED Headlights', 5500.00, 80, '2024-10-29 14:40:25', 11);


-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `register_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO register (register_id, username, password, email, created_at) VALUES
(9, 'james', '$2y$10$I9vY00ROLCyYqYUuh1ZcGuPBzxD77BL8BqUOexK4N.boVL5c2IWmK', 'james@gmail.com', '2024-10-29 13:21:48'),
(10, 'anton', '$2y$10$3M6ueuMd21PYfkcnIWGdcuA5tVWVHDENh1lJmV9aS.MwtAVcEimMS', 'anton@gmail.com', '2024-10-29 13:26:03'),
(11, 'jacob', '$2y$10$w8uH0CZ/pNeD08M1jx61eeihJd18F6PrXel8lmz1SMO2bQ00IuaIi', 'jacob@gmail.com', '2024-10-29 21:22:45'),
(12, 'sherwin', '$2y$10$uA0CjEjkM8z5Rp47DPdMhNlPpC7z22.Vn.9J51ct2.TlAKIb.HCKu', 'sherwin@gmail.com', '2024-10-29 21:23:08'),
(13, 'raymund', '$2y$10$0YnhE0TFA9J9fH59vFxtMe6nKmj.6J0mTebz0VpQxA1MAsgAYMjSu', 'raymund@gmail.com', '2024-10-29 21:23:34'),
(14, 'anton', '$2y$10$3M6ueuMd21PYfkcnIWGdcuA5tVWVHDENh1lJmV9aS.MwtAVcEimMS', 'anton@gmail.com', '2024-10-29 21:26:29'),
(15, 'james', '$2y$10$I9vY00ROLCyYqYUuh1ZcGuPBzxD77BL8BqUOexK4N.boVL5c2IWmK', 'james@gmail.com', '2024-10-29 21:34:42'),
(16, 'kristan', '$2y$10$Ml9nPv8bCwhRbkXKH6.KleOd5ir8aOdCe9X3ht9mhMkmDgHtGiUy', 'kristan@gmail.com', '2024-10-29 22:14:20'),
(17, 'tanly', '$2y$10$0YfhytpFmDq1qYrHq02RmXTk38c9nqhd5.R4qgXJz.Xm7E70kbyF', 'tanly@gmail.com', '2024-11-13 17:58:19');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `fk_register` (`register_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_customer` (`customer_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`register_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `register_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_register` FOREIGN KEY (`register_id`) REFERENCES `register` (`register_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
