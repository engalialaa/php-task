-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2022 at 06:28 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'eng-ali alaa', 'admin@admin.com', '$2y$10$NIdmUIa1YNFhhC9BerhPBukwYQ19AwzJhVLSz2.uMkm9H99JLnDpS', NULL, '2021-12-23 12:18:15', '2022-01-21 10:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_shown` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `photo`, `is_shown`, `created_at`, `updated_at`) VALUES
(6, 'ملابس رجالى', 'public/uploads/admin/Category/20571642868107.png', 'yes', '2022-01-22 14:15:07', '2022-01-22 14:15:07'),
(7, 'مطاعم', 'public/uploads/admin/Category/97861642868122.png', 'yes', '2022-01-22 14:15:22', '2022-01-22 14:15:22'),
(8, 'ملابس اطفال', 'public/uploads/admin/Category/34401642868139.png', 'yes', '2022-01-22 14:15:39', '2022-01-22 14:15:39'),
(9, 'ملابس حريمى', 'public/uploads/admin/Category/68741642868150.png', 'yes', '2022-01-22 14:15:50', '2022-01-22 14:15:50'),
(10, 'شركات مقولات', 'public/uploads/admin/Category/6101642868185.png', 'yes', '2022-01-22 14:16:25', '2022-01-22 14:16:25'),
(11, 'شركات سياحة', 'public/uploads/admin/Category/40801642868198.png', 'yes', '2022-01-22 14:16:38', '2022-01-22 14:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_01_21_132141_create_categories_table', 1),
(5, '2022_01_21_132635_create_products_table', 2),
(6, '2022_01_21_133743_create_product__photos_table', 3),
(7, '2022_01_22_123506_create_carts_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descount` double NOT NULL DEFAULT 0,
  `is_shown` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `category_name`, `name`, `photo`, `price`, `details`, `descount`, `is_shown`, `created_at`, `updated_at`) VALUES
(10, 7, 'مطاعم', 'شاورما', 'public/uploads/Product/40971642868424.png', 100, 'الشاورما نوع من أنواع مأكولات الشرق الأوسط التي تعود جذورها إلى بلاد الشام، والدولة العثمانية، وهي عبارة عن لحم مشوي بطريقة خاصة حيث يشوى اللحم بواسطة الحرارة والأشعاع الناتج من مصدر الحرارة والذي يمكن أن يكون مصدر كهربائي أو غازي أو من الفحم. وتباع الشاورما في مطاعم الوجبات', 10, 'yes', '2022-01-22 14:20:24', '2022-01-22 14:20:24'),
(11, 6, 'ملابس رجالى', 'تيشرت رجالى بولو', 'public/uploads/Product/53571642868582.png', 150, 'تحفه بجد دي تاني مرة اخد منكوا حاجه وتطلع جميله كدا ولسه ف مرات كتير أن شاء الله\r\nالاوردار بيوصل بسرعه جدا  وناس محترمه ودي حاجه ممتازة بصراحه شكرآ ليكوا بجد', 30, 'yes', '2022-01-22 14:23:02', '2022-01-22 14:23:02'),
(12, 6, 'ملابس رجالى', 'سويت شيرت بسوسته وكابشون', 'public/uploads/Product/75561642868801.png', 300, 'buy online from 2S, and it won\'t be the last.  The purchase is fast. The delivery staff are decent. The material is awesome   better than I expect, identical to the advertised items. The sizes are perfect. A real success of a promising company.  Thanks for your good service.', 25, 'yes', '2022-01-22 14:26:41', '2022-01-22 14:26:41'),
(13, 6, 'ملابس رجالى', 'بنطلون رجالي ساده', 'public/uploads/Product/85921642869059.png', 100, 'بنطلون رجالي ساده بنطلون رجالي ساده', 10, 'yes', '2022-01-22 14:30:59', '2022-01-22 14:30:59'),
(14, 8, 'ملابس اطفال', 'سويت شيرت بسوستة وكابشون', 'public/uploads/Product/72581642869148.png', 150, 'عجبني جدا خامة تقبله اخدت مقاس ١٦ لولد عنده ١١ سنه وواحد  تاني مقاس ١٠ لولد ٧ سنين', 25, 'yes', '2022-01-22 14:32:28', '2022-01-22 14:32:28'),
(15, 8, 'ملابس اطفال', 'A MAP بيجاما اولادي', 'public/uploads/Product/63381642869268.png', 200, 'A MAP بيجاما اولادي\r\n2segypt\r\n \r\n(1)\r\n227.50 EGP 325.00 EGP\r\nخصم 30% 97.50 EGP\r\nSIZE10121416\r\nاللون منت\r\nمنت\r\nالكمية\r\n-\r\n1\r\n+\r\nأضف إلى السلة\r\nهل هذا المنتج متوفر في الفروع؟\r\n\r\nبيجاما اولادي ميلتون قطن 100% بوبرة داخلية', 30, 'yes', '2022-01-22 14:34:28', '2022-01-22 14:34:28'),
(16, 9, 'ملابس حريمى', 'بيجاما حريمي بزراير كلاسيك', 'public/uploads/Product/31401642869346.png', 200, 'بيجاما حريمي قطن %100', 30, 'yes', '2022-01-22 14:35:46', '2022-01-22 14:35:46'),
(17, 9, 'ملابس حريمى', 'بنطلون خطوط ومربعات حريمي منقوش', 'public/uploads/Product/45491642869596.png', 200, 'بنطلون حريمي منقوش ميلتون قطن %100', 10, 'yes', '2022-01-22 14:39:56', '2022-01-22 15:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `product__photos`
--

CREATE TABLE `product__photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product__photos`
--

INSERT INTO `product__photos` (`id`, `product_id`, `photo`, `created_at`, `updated_at`) VALUES
(25, 10, 'public/uploads/Product/67741642868424.png', '2022-01-22 14:20:24', '2022-01-22 14:20:24'),
(26, 10, 'public/uploads/Product/72701642868424.png', '2022-01-22 14:20:24', '2022-01-22 14:20:24'),
(27, 11, 'public/uploads/Product/67041642868582.png', '2022-01-22 14:23:02', '2022-01-22 14:23:02'),
(28, 12, 'public/uploads/Product/73811642868801.png', '2022-01-22 14:26:41', '2022-01-22 14:26:41'),
(29, 12, 'public/uploads/Product/78431642868801.png', '2022-01-22 14:26:41', '2022-01-22 14:26:41'),
(30, 12, 'public/uploads/Product/24641642868801.png', '2022-01-22 14:26:41', '2022-01-22 14:26:41'),
(31, 13, 'public/uploads/Product/43011642869059.png', '2022-01-22 14:30:59', '2022-01-22 14:30:59'),
(32, 13, 'public/uploads/Product/73561642869059.png', '2022-01-22 14:30:59', '2022-01-22 14:30:59'),
(33, 13, 'public/uploads/Product/59871642869059.png', '2022-01-22 14:30:59', '2022-01-22 14:30:59'),
(34, 14, 'public/uploads/Product/26571642869148.png', '2022-01-22 14:32:28', '2022-01-22 14:32:28'),
(35, 14, 'public/uploads/Product/14891642869148.png', '2022-01-22 14:32:28', '2022-01-22 14:32:28'),
(36, 15, 'public/uploads/Product/72131642869268.png', '2022-01-22 14:34:28', '2022-01-22 14:34:28'),
(37, 16, 'public/uploads/Product/78891642869346.png', '2022-01-22 14:35:46', '2022-01-22 14:35:46'),
(38, 16, 'public/uploads/Product/69931642869346.png', '2022-01-22 14:35:46', '2022-01-22 14:35:46'),
(39, 17, 'public/uploads/Product/68881642869596.png', '2022-01-22 14:39:56', '2022-01-22 14:39:56'),
(40, 17, 'public/uploads/Product/74931642869596.png', '2022-01-22 14:39:56', '2022-01-22 14:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(11) UNSIGNED DEFAULT NULL,
  `total` double DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_type` enum('online','cash') COLLATE utf8mb4_unicode_ci DEFAULT 'online',
  `is_end` int(11) NOT NULL DEFAULT 0,
  `is_paid` enum('paid','unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `status` enum('new','confirm','refusal','making','delivry') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `total`, `first_name`, `last_name`, `email`, `phone`, `street`, `other_details`, `pay_type`, `is_end`, `is_paid`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 227, 'ali', 'alaa', 'ali@ali.com', '01015310144', 'aaaaaaaaa', 'aaaaaaaaaaa', 'cash', 1, 'unpaid', 'confirm', '2022-01-22 12:49:29', '2022-01-22 14:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(11) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `product_id`, `product_name`, `product_photo`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 'تيست', 'public/uploads/Product/72521642862913.jpg', 1, NULL, '2022-01-22 12:49:29', '2022-01-22 12:49:29'),
(2, 1, 9, 'تيست تست', 'public/uploads/Product/64621642862939.jpg', 1, NULL, '2022-01-22 12:49:29', '2022-01-22 12:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ali', 'alaa', 'ali@ali.com', '01015310144', NULL, '$2y$10$AVgHbQP34d/krClg2AiBJej775sdtiaCVvOg9B.xf5eAxSx7W1oWm', NULL, '2022-01-22 09:45:44', '2022-01-22 09:45:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product__photos`
--
ALTER TABLE `product__photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product__photos_category_id_foreign` (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_user_id_user_id_Forein_Key` (`user_id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_details_sale_id_sales_id_Forein_Key` (`sale_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product__photos`
--
ALTER TABLE `product__photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product__photos`
--
ALTER TABLE `product__photos`
  ADD CONSTRAINT `product__photos_category_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_sale_id_sales_id_Forein_Key` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
