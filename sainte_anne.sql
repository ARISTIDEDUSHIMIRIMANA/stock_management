-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2025 at 10:51 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sainte_anne`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Stationery', 'School supplies like pens, pencils, notebooks, etc.', '2025-06-05 09:49:20', '2025-06-05 09:49:20'),
(2, 'Books', 'Textbooks and reference materials', '2025-06-05 09:49:20', '2025-06-05 09:49:20'),
(3, 'Cleaning Supplies', 'Cleaning materials and sanitation products', '2025-06-05 09:49:20', '2025-06-05 09:49:20'),
(4, 'Sports Equipment', 'Sports and physical education materials', '2025-06-05 09:49:20', '2025-06-05 09:49:20'),
(5, 'Office Supplies', 'Administrative and office materials', '2025-06-05 09:49:20', '2025-06-05 09:49:20'),
(6, 'kk', 'kk', '2025-06-05 10:06:16', '2025-06-05 10:06:16');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_06_000001_create_categories_table', 1),
(6, '2024_03_06_000001_create_products_table', 1),
(7, '2024_03_06_000001_create_stock_in_table', 1),
(8, '2024_03_06_000002_create_stock_out_table', 1),
(9, '2024_03_06_000003_add_phone_and_role_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductId` bigint(20) UNSIGNED NOT NULL,
  `Product_Name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `Unit` varchar(255) DEFAULT NULL,
  `minimum_stock` int(11) NOT NULL DEFAULT 0,
  `current_stock` int(11) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductId`, `Product_Name`, `description`, `Unit`, `minimum_stock`, `current_stock`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Notebooks', 'A5 size, 200 pages', 'Piece', 50, 328, 1, '2025-06-05 09:49:20', '2025-06-05 09:49:21'),
(2, 'Pencils', 'HB grade pencils', 'Box', 20, 293, 1, '2025-06-05 09:49:21', '2025-06-05 09:49:21'),
(3, 'Mathematics Textbook', 'Primary level mathematics book', 'Piece', 30, 364, 2, '2025-06-05 09:49:21', '2025-06-05 09:49:21'),
(4, 'English Reader', 'Primary level English reading book', 'Piece', 30, 431, 2, '2025-06-05 09:49:21', '2025-06-05 09:49:21'),
(5, 'Broom', 'Standard cleaning broom', 'Piece', 10, 252, 3, '2025-06-05 09:49:21', '2025-06-05 09:49:21'),
(6, 'Soap', 'Hand washing soap', 'Box', 15, 280, 3, '2025-06-05 09:49:21', '2025-06-05 09:49:21'),
(7, 'Football', 'Standard size football', 'Piece', 5, 441, 4, '2025-06-05 09:49:21', '2025-06-05 09:49:21'),
(8, 'Jump Rope', 'Exercise jump rope', 'Piece', 10, 415, 4, '2025-06-05 09:49:21', '2025-06-05 09:49:21'),
(9, 'Printer Paper', 'A4 size printer paper', 'Ream', 20, 501, 5, '2025-06-05 09:49:21', '2025-06-05 09:49:21'),
(10, 'Stapler', 'Standard office stapler', 'Piece', 5, 456, 5, '2025-06-05 09:49:21', '2025-06-05 09:49:21'),
(11, 'amashaza', NULL, NULL, 0, 0, NULL, '2025-06-05 10:07:01', '2025-06-05 10:07:01'),
(12, 'milk', NULL, NULL, 0, 0, NULL, '2025-06-09 17:04:40', '2025-06-09 17:04:40'),
(13, 'pens', NULL, NULL, 0, 0, NULL, '2025-06-09 18:02:18', '2025-06-09 18:02:18'),
(14, 'Books', NULL, NULL, 0, 0, NULL, '2025-06-09 18:02:49', '2025-06-09 18:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

CREATE TABLE `stock_in` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Product_Id` bigint(20) UNSIGNED NOT NULL,
  `Date` date NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Unit_Price` decimal(10,2) NOT NULL,
  `Total_Price` decimal(12,2) NOT NULL,
  `Supplier` varchar(255) NOT NULL,
  `Reference_Number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_in`
--

INSERT INTO `stock_in` (`id`, `Product_Id`, `Date`, `Quantity`, `Unit_Price`, `Total_Price`, `Supplier`, `Reference_Number`, `created_at`, `updated_at`) VALUES
(32, 12, '2025-06-09', 2, '200.00', '400.00', 'jimmy', '500', '2025-06-09 17:04:40', '2025-06-09 17:04:40'),
(33, 13, '2025-06-09', 20, '40.00', '800.00', 'jems', '20', '2025-06-09 18:02:18', '2025-06-09 18:02:18'),
(34, 14, '2025-06-09', 40, '90.00', '3600.00', 'kevin', '7', '2025-06-09 18:02:49', '2025-06-09 18:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out`
--

CREATE TABLE `stock_out` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Product_Id` bigint(20) UNSIGNED NOT NULL,
  `Date` date NOT NULL,
  `Quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_out`
--

INSERT INTO `stock_out` (`id`, `Product_Id`, `Date`, `Quantity`, `created_at`, `updated_at`) VALUES
(1, 10, '2025-06-09', 1, '2025-06-09 17:27:49', '2025-06-09 17:27:49'),
(2, 12, '2025-06-09', 1, '2025-06-09 18:03:10', '2025-06-09 18:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'store_manager',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@sainteanne.com', '0788123456', 'admin', NULL, '$2y$10$Dy/URZHTYvMcWnmgElJHm.S8wopnSEwmFZc6eE1.LANCAEDgKKKBW', NULL, '2025-06-05 09:49:20', '2025-06-05 09:49:20'),
(2, 'Store Manager', 'store@sainteanne.com', '0788234567', 'store_manager', NULL, '$2y$10$7v6sGq1KLlz7HsyuUEEzHO53HSGGajXqOw4qckZ0zxoAOl1KcZgjO', NULL, '2025-06-05 09:49:20', '2025-06-05 09:49:20'),
(3, 'zaraduhaye egide', 'egidechaba@gmail.com', '0793289884', 'store_manager', NULL, '$2y$10$hH4FJU6JdoxBEgxmniF3SuaHSevVsydCsKJXVNr/wo6IlPfp7zynu', NULL, '2025-06-05 10:01:26', '2025-06-05 10:01:26'),
(4, 'aristide', 'aristide4k@gmail.com', '0783211171', 'store_manager', NULL, '$2y$10$TPNDpvOdTsxNTvrTYPkOv./Src2q/uuRW.ljwOLAAbzRE01cQRTGa', NULL, '2025-06-09 07:12:24', '2025-06-09 07:12:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stock_in_reference_number_unique` (`Reference_Number`),
  ADD KEY `stock_in_product_id_foreign` (`Product_Id`);

--
-- Indexes for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_out_product_id_foreign` (`Product_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD CONSTRAINT `stock_in_product_id_foreign` FOREIGN KEY (`Product_Id`) REFERENCES `products` (`ProductId`);

--
-- Constraints for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD CONSTRAINT `stock_out_product_id_foreign` FOREIGN KEY (`Product_Id`) REFERENCES `products` (`ProductId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
