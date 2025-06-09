-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2025 at 09:36 AM
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
-- Database: `op_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_name` varchar(250) NOT NULL,
  `delivery_charge` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`, `delivery_charge`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Jabalpur', '50', 'Y', '2025-06-04 05:46:07', '2025-06-04 11:16:07'),
(2, 'Sihore', '100', 'Y', '2025-06-04 05:46:12', '2025-06-04 11:16:12'),
(3, 'Katni', '150', 'Y', '2025-06-04 05:46:18', '2025-06-04 11:16:18'),
(4, 'rewa', '300', 'Y', '2025-06-04 05:46:25', '2025-06-04 11:16:25'),
(9, 'Bhopal', '100', 'Y', '2025-06-04 05:46:31', '2025-06-04 11:16:31'),
(12, 'Prayagraj', '500', 'Y', '2025-06-04 05:51:43', '2025-06-04 11:21:43'),
(13, 'UP', '1000', 'Y', '2025-06-04 05:51:49', '2025-06-04 11:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city_id` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postal` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `organization` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `anniversary_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `email`, `name`, `mobile_number`, `address`, `city_id`, `country`, `postal`, `is_active`, `created_at`, `updated_at`, `organization`, `dob`, `anniversary_date`) VALUES
(25, 'admin@gmail.com', 'Ruchi Singh', '08269431189', 'Sagar Lake View Homes, Bhopal', '1', 'India', '462041', 1, '2025-05-13 09:42:12', '2025-05-13 09:42:12', 'Retinodes', '2025-05-13', '2025-05-13'),
(31, 'REDR@gmail.com', 'RE', '9876543234', NULL, '3', NULL, NULL, 0, '2025-05-13 13:03:03', '2025-06-04 05:36:35', NULL, NULL, NULL),
(33, 'CT@gmail.com', 'CT', '3456787698', NULL, '3', NULL, NULL, 0, '2025-05-13 13:11:55', '2025-05-13 13:11:55', NULL, NULL, NULL),
(36, NULL, 'Ajay', '9876543211', NULL, '2', NULL, NULL, 0, '2025-06-03 11:03:11', '2025-06-03 11:03:11', NULL, NULL, NULL),
(37, NULL, 'Daksh', '7465321234', NULL, '12', NULL, NULL, 1, '2025-06-04 05:49:05', '2025-06-04 05:49:05', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `embroideries`
--

CREATE TABLE `embroideries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `embroidery_name` varchar(255) NOT NULL,
  `additional_cost` decimal(8,2) NOT NULL DEFAULT 0.00,
  `base_price` int(100) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `embroideries`
--

INSERT INTO `embroideries` (`id`, `warehouse_id`, `embroidery_name`, `additional_cost`, `base_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Not work', 7.00, 40, 'Y', '2025-04-22 01:13:47', '2025-04-23 00:26:46'),
(3, 1, 'Zariwork', 5.00, 50, 'Y', '2025-04-22 02:47:45', '2025-04-24 03:24:15'),
(7, 1, 'without work', 0.00, 0, 'Y', '2025-05-05 02:38:32', '2025-05-05 02:38:32'),
(8, 1, 'None', 0.00, 0, 'Y', '2025-05-06 07:17:58', '2025-05-06 07:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_14_064536_create_roles_table', 1),
(5, '2025_04_17_085947_create_shades_table', 2),
(6, '2025_04_17_085957_create_patterns_table', 2),
(7, '2025_04_17_090007_create_sizes_table', 2),
(8, '2025_04_17_090014_create_embroidery_options_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `total_amount` int(11) NOT NULL,
  `order_number` varchar(150) NOT NULL,
  `order_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delivery_date` date DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `delivery_charge` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `paid_amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `warehouse_id`, `total_amount`, `order_number`, `order_date`, `user_id`, `payment_id`, `status`, `created_at`, `updated_at`, `delivery_date`, `customer_id`, `delivery_charge`, `discount`, `paid_amount`) VALUES
(103, NULL, 450, 'ORD1749030021', '2025-06-04', 1, 2, 1, '2025-06-04 09:41:02', '2025-06-04 09:41:02', '2025-06-11', 25, 50, 0, NULL),
(105, NULL, 420, 'ORD1749450515', '2025-06-09', 1, 2, 1, '2025-06-09 06:29:32', '2025-06-09 06:31:44', '2025-06-16', 31, 0, 0, 400),
(107, NULL, 800, 'ORD1749452431', '2025-06-09', 1, 2, 1, '2025-06-09 07:01:40', '2025-06-09 07:01:40', '2025-06-16', 25, 50, 75, 500),
(108, 1, 525, 'ORD1749453044', '2025-06-09', 2, 1, 1, '2025-06-09 07:11:34', '2025-06-09 07:12:47', '2025-06-16', 25, 50, 50, 500);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `other_charges` int(11) DEFAULT NULL,
  `total_charges` int(11) DEFAULT NULL,
  `delivery_charges` int(11) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `shade_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `pattern_id` int(11) DEFAULT NULL,
  `embroidery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `warehouse_id`, `order_id`, `product_id`, `user_id`, `price`, `quantity`, `other_charges`, `total_charges`, `delivery_charges`, `delivery_date`, `created_at`, `updated_at`, `shade_id`, `size_id`, `pattern_id`, `embroidery_id`) VALUES
(163, NULL, 103, 6, 1, 400, 1, 0, 400, NULL, NULL, '2025-06-04 09:41:02', '2025-06-04 09:41:02', 5, 3, 3, 3),
(171, NULL, 105, 7, 1, 270, 1, 0, 270, NULL, NULL, '2025-06-09 06:31:44', '2025-06-09 06:31:44', 5, NULL, NULL, NULL),
(173, NULL, 107, 1, 1, 275, 3, 0, 825, NULL, NULL, '2025-06-09 07:01:40', '2025-06-09 07:01:40', 5, NULL, NULL, NULL),
(175, 1, 108, 1, 2, 525, 1, 0, 525, NULL, NULL, '2025-06-09 07:12:47', '2025-06-09 07:12:47', 5, 2, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `patterns`
--

CREATE TABLE `patterns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `base_price` int(100) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patterns`
--

INSERT INTO `patterns` (`id`, `warehouse_id`, `code`, `name`, `description`, `base_price`, `status`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 1, '11', 'Round Neck with 3 buttons', 'Round Neck with 3 buttons', 40, 'Y', NULL, '2025-04-18 00:27:05', '2025-05-05 02:05:28'),
(3, 1, '12', 'Round Neck without button', 'Round Neck without button', 50, 'Y', NULL, '2025-04-18 00:29:13', '2025-05-05 02:05:36'),
(18, 1, '21', 'V Neck', 'v neck', 60, 'Y', NULL, '2025-05-05 02:06:10', '2025-05-05 02:06:10'),
(19, 1, '0', 'None', 'none', 0, 'Y', NULL, '2025-05-06 07:18:35', '2025-05-06 07:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethods`
--

CREATE TABLE `paymentmethods` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentmethods`
--

INSERT INTO `paymentmethods` (`id`, `name`, `status`) VALUES
(1, 'Cash', 1),
(2, 'Online', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Banket (Winter)', 225, '2025-04-23 10:07:08', '2025-05-11 14:21:37'),
(3, 'Apron', 375, '2025-04-24 06:55:00', '2025-05-11 14:21:27'),
(6, 'Gloves', 100, '2025-05-05 09:36:24', '2025-05-05 09:42:05'),
(7, 'curtains', 220, '2025-05-06 08:51:32', '2025-05-06 08:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'user', NULL, NULL),
(3, 'warehouse', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shades`
--

CREATE TABLE `shades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `base_price` int(100) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shades`
--

INSERT INTO `shades` (`id`, `warehouse_id`, `code`, `name`, `description`, `status`, `base_price`, `image_path`, `created_at`, `updated_at`) VALUES
(5, 0, '01', 'Mahroon', 'Mahroon', 'Y', 50, NULL, '2025-04-17 07:01:25', '2025-04-23 02:16:29'),
(6, 0, '02', 'Pink', 'Pink', 'Active', 55, NULL, '2025-04-17 07:01:38', '2025-04-17 07:01:38'),
(19, 1, '0', 'None', 'none', 'Y', 0, NULL, '2025-05-06 07:17:20', '2025-06-04 00:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `code` int(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `base_price` int(100) NOT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `warehouse_id`, `code`, `name`, `description`, `status`, `base_price`, `image_path`, `created_at`, `updated_at`) VALUES
(2, 1, 22, 'L-10', 'Dress Size', 'Y', 50, NULL, '2025-04-18 01:04:03', '2025-05-05 02:15:08'),
(3, 1, 21, 'M-10', 'Dress Size', 'Y', 50, NULL, '2025-04-18 01:05:11', '2025-05-05 02:14:57'),
(25, 1, 21, 'S', 's', 'Y', 20, NULL, '2025-05-05 02:55:01', '2025-05-05 02:55:01'),
(26, 1, 0, 'None', '0', 'Y', 0, NULL, '2025-05-06 07:19:05', '2025-05-06 07:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `usercode` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postal` varchar(20) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `email_verified_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `warehouse_id`, `role_id`, `email`, `password`, `name`, `usercode`, `firstname`, `lastname`, `mobile_number`, `address`, `city`, `country`, `postal`, `about`, `is_active`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'admin@gmail.com', '$2y$12$rsS6l3YsnwlS2/nw3begf.pmIQecz3IpdJWXkN9ctOT3reYBiz5MC', 'admin', 'admin', 'admin', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2025-04-16 19:00:12', '2025-04-21 08:40:53'),
(2, 1, 2, 'user@gmail.com', '$2y$12$rsS6l3YsnwlS2/nw3begf.pmIQecz3IpdJWXkN9ctOT3reYBiz5MC', 'user', 'user', 'user', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2025-04-17 10:43:29', '2025-06-09 12:39:35'),
(3, 1, 3, 'warehouse@gmail.com', '$2y$12$rsS6l3YsnwlS2/nw3begf.pmIQecz3IpdJWXkN9ctOT3reYBiz5MC', 'warehouse', 'warehouse', 'warehouse', 'warehouse', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2025-04-17 10:44:54', '2025-06-09 13:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `code` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Warehouse One', 'demo', '2025-04-19 12:46:50', '2025-06-04 05:35:12'),
(3, 'Warehouse Two', 'demo2', '2025-04-25 07:16:47', '2025-05-03 13:56:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `embroideries`
--
ALTER TABLE `embroideries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patterns`
--
ALTER TABLE `patterns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patterns_code_unique` (`code`);

--
-- Indexes for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shades`
--
ALTER TABLE `shades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shades_code_unique` (`code`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `embroideries`
--
ALTER TABLE `embroideries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `patterns`
--
ALTER TABLE `patterns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shades`
--
ALTER TABLE `shades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
