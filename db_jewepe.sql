-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 07:56 PM
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
-- Database: `db_jewepe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `username`) VALUES
(1, 'randyrisdiansyah@gmail.com', '123456789', 'Randi');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(50) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone_number` varchar(20) NOT NULL,
  `order_status` enum('pending','approved','cancelled') DEFAULT 'pending',
  `wedding_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_code`, `package_id`, `customer_name`, `customer_email`, `customer_phone_number`, `order_status`, `wedding_date`, `created_at`, `updated_at`) VALUES
(1, 'ORD1', 10, 'Randi', 'randyrisdiansyah@gmail.com', '08655565544433', 'pending', '2024-06-30', '2024-06-17 11:27:41', '2024-06-17 19:21:27'),
(7, 'ORD7', 10, 'Randi', 'randi@gmail.com', '086766662', 'pending', '2025-11-02', '2024-06-17 22:18:18', '2024-06-17 22:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `package_details`
--

CREATE TABLE `package_details` (
  `package_details_id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `package_name` varchar(255) NOT NULL,
  `package_image` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_details`
--

INSERT INTO `package_details` (`package_details_id`, `package_id`, `package_name`, `package_image`, `description`, `price`) VALUES
(4, 10, 'Paket Mahal', '666f60cc44262_product1.jpg', '<p>Banyak keuntungan yang akan didapatkan</p>', 20000000),
(8, 14, 'Paket Berlian', '666f8def50bac_product4.jpg', '<h1>Sekali semur hidup</h1><p><br></p><p>-menerima 1000+ undangan</p><p>-porsi makanan 1200+</p>', 150000000),
(9, 15, 'Paket Murmer', '66705b8b54550_product2.jpg', '<h1>test</h1><h3>test</h3>', 20000000);

-- --------------------------------------------------------

--
-- Table structure for table `wedding_package`
--

CREATE TABLE `wedding_package` (
  `package_id` int(11) NOT NULL,
  `package_code` varchar(50) NOT NULL,
  `status_publish` enum('showed','drafted') NOT NULL DEFAULT 'drafted',
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wedding_package`
--

INSERT INTO `wedding_package` (`package_id`, `package_code`, `status_publish`, `user_id`, `created_at`, `updated_at`) VALUES
(10, 'JWP001', 'showed', 1, '2023-06-01 12:00:00', '2024-06-17 17:09:53'),
(14, 'JWP14', 'drafted', 1, '2024-06-17 08:14:23', '2024-06-17 01:14:23'),
(15, 'JWP15', 'showed', 1, '2024-06-17 22:51:39', '2024-06-17 17:09:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `package_details`
--
ALTER TABLE `package_details`
  ADD PRIMARY KEY (`package_details_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `wedding_package`
--
ALTER TABLE `wedding_package`
  ADD PRIMARY KEY (`package_id`),
  ADD UNIQUE KEY `package_code` (`package_code`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `package_details`
--
ALTER TABLE `package_details`
  MODIFY `package_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wedding_package`
--
ALTER TABLE `wedding_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `wedding_package` (`package_id`) ON DELETE CASCADE;

--
-- Constraints for table `package_details`
--
ALTER TABLE `package_details`
  ADD CONSTRAINT `package_details_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `wedding_package` (`package_id`) ON DELETE CASCADE;

--
-- Constraints for table `wedding_package`
--
ALTER TABLE `wedding_package`
  ADD CONSTRAINT `wedding_package_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
