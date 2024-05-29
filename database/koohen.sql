-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2024 at 05:50 AM
-- Server version: 10.6.17-MariaDB-cll-lve
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koohen_evara`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutuses`
--

CREATE TABLE `aboutuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `about_desc` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aboutuses`
--

INSERT INTO `aboutuses` (`id`, `title`, `about_desc`, `created_at`, `updated_at`) VALUES
(1, 'We are Building The Destination For Getting Things Done', '<p>Koohen offers a wide range of clothing, including T-shirts, hoodies, \ntraditional Panjabi and Sharee dresses. Orders are carefully handled \nfrom Dhaka and delivered across Bangladesh!<br>Registered Address: TRAD/DSCC/042967/2022</p>', '2024-03-30 01:15:58', '2024-03-30 13:40:03');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `btntext` varchar(255) DEFAULT NULL,
  `shop_url` varchar(255) DEFAULT NULL,
  `is_featured` varchar(255) DEFAULT NULL,
  `is_feature_no` varchar(255) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `header`, `title`, `btntext`, `shop_url`, `is_featured`, `is_feature_no`, `image`, `status`, `created_at`, `updated_at`) VALUES
(4, 'EID SALE 2024', 'Ramadan Special Collection', NULL, 'https://koohen.com/shop', '1', '1', 'ads_banner/1711140292.png', 1, '2024-02-08 09:02:16', '2024-05-05 11:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `applied_coupones`
--

CREATE TABLE `applied_coupones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupone_id` bigint(20) UNSIGNED NOT NULL,
  `coupone_code` varchar(255) NOT NULL,
  `is_ordered` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_image` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_image`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'কহেন - KOHEN', 'koohen_1707222230.png', 'koohen', '1', '2024-02-06 11:23:50', '2024-02-07 08:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `camp_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `camp_offer` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('Draft','Published') NOT NULL DEFAULT 'Draft',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `camp_products`
--

CREATE TABLE `camp_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `regular_price` decimal(8,2) NOT NULL,
  `camp_price` decimal(8,2) DEFAULT NULL,
  `camp_qty` decimal(8,2) DEFAULT NULL,
  `start_date` decimal(8,2) DEFAULT NULL,
  `end_date` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categories_id` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `parent_category` varchar(255) DEFAULT NULL,
  `category_icon` varchar(255) DEFAULT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories_id`, `category_name`, `parent_category`, `category_icon`, `category_image`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(10, 'GNdOMgmSQtp4', 'Premium Panjabi', NULL, 'category_image/icons/icon_1707296266.jpg', 'Premium Panjabi_1707296266.jpg', 'premium-panjabi', '1', '2024-02-07 07:57:46', '2024-02-07 07:57:46'),
(11, 'S6JGf5LMBIvF', 'Classic Panjabi', NULL, 'category_image/icons/icon_1707296284.jpg', 'Classic Panjabi_1707296284.jpg', 'classic-panjabi', '1', '2024-02-07 07:58:04', '2024-02-07 07:58:04'),
(12, '7a0il4xV6G3S', 'Regular Panjabi', NULL, 'category_image/icons/icon_1707296302.jpg', 'Printed Panjabi_1707296302.jpg', 'printed-panjabi', '1', '2024-02-07 07:58:22', '2024-03-22 19:20:51'),
(13, 'vqj9l267stce', 'standard Panjabi', NULL, 'category_image/icons/icon_1710958579.jpg', 'standard Panjabi_1710958579.jpg', 'standard-panjabi', '1', '2024-03-20 18:16:19', '2024-03-20 18:16:19'),
(14, '382QucJAxURw', 'Premium Pajama', NULL, 'category_image/icons/icon_1711306633.jpg', 'Premium Pajama_1711306633.jpg', 'premium-pajama', '1', '2024-03-24 18:57:13', '2024-03-24 18:57:13'),
(17, 'xYHdmAnXN2Pq', 'Women Collection', NULL, NULL, NULL, 'womens-collection', '1', '2024-05-13 07:18:25', '2024-05-16 09:40:20'),
(18, 'mgA0qkSxKJQn', 'Co-Ords', 'Women Collection', NULL, NULL, 'co-ords', '1', '2024-05-13 07:26:46', '2024-05-16 09:40:30'),
(19, 'Nidk6DFR3X0g', 'Kaftan Co-Ords', 'Women Collection', NULL, NULL, 'kaftan-co-ords', '1', '2024-05-13 07:27:12', '2024-05-16 09:40:36');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_name` varchar(255) NOT NULL,
  `color_code` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `color_code`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Dark midnight blue', 'rgba(0, 51, 102, 1)', 1, '2024-02-07 08:01:17', '2024-02-07 08:01:28'),
(6, 'Light Olive', 'rgba(155, 179, 143, 1)', 1, '2024-02-07 08:04:10', '2024-02-07 08:04:10'),
(7, 'Chocolate Brown', 'rgba(65, 25, 0, 1)', 1, '2024-02-07 08:05:04', '2024-02-07 08:05:04'),
(8, 'Cream', 'rgba(255, 253, 208, 1)', 1, '2024-02-07 08:05:49', '2024-02-07 08:05:49'),
(9, 'Black Rainbow', 'rgba(0, 0, 0, 1)', 1, '2024-02-07 08:07:16', '2024-02-07 08:07:16'),
(10, 'Black', 'rgba(0, 0, 0, 1)', 1, '2024-02-07 08:07:26', '2024-02-07 08:07:26'),
(11, 'White', 'rgba(255, 255, 255, 1)', 1, '2024-02-07 08:07:35', '2024-02-07 08:07:35'),
(12, 'Irish Mint', 'rgba(224, 242, 238, 1)', 1, '2024-03-20 18:42:27', '2024-03-20 18:42:27'),
(13, 'Sandstone', 'rgba(120, 109, 95, 1)', 1, '2024-03-21 05:43:18', '2024-03-21 05:43:18'),
(14, 'Deep Tan', 'rgba(114, 103, 81, 1)', 1, '2024-03-21 05:45:26', '2024-03-21 14:29:21'),
(15, 'Baby Blue', 'rgba(161, 202, 241, 1)', 1, '2024-03-21 14:21:10', '2024-03-21 14:21:10'),
(16, 'Mountain Peak White', 'rgba(252, 249, 239, 1)', 1, '2024-03-21 14:22:13', '2024-03-21 14:22:13'),
(17, 'Matt Midnight Blue', 'rgba(32, 68, 100, 1)', 1, '2024-03-21 14:23:44', '2024-03-21 14:23:44'),
(18, 'Light Sky Blue', 'rgba(223, 253, 255, 1)', 1, '2024-03-21 14:27:29', '2024-03-21 14:27:29'),
(19, 'Cream Color', 'rgba(253, 250, 226, 1)', 1, '2024-03-21 14:29:07', '2024-03-21 14:29:07'),
(20, 'Maroon', 'rgba(101, 0, 0, 1)', 1, '2024-03-21 14:31:48', '2024-03-21 14:31:48'),
(21, 'Mint Green', 'rgba(169, 200, 190, 1)', 1, '2024-03-21 14:34:07', '2024-03-21 14:34:07'),
(22, 'Brown', 'rgba(102, 88, 77, 1)', 1, '2024-03-21 14:35:02', '2024-03-21 14:35:02'),
(23, 'Teal', 'rgba(0, 128, 128, 1)', 1, '2024-03-21 14:35:49', '2024-03-21 14:35:49'),
(24, 'Grayish blue', 'rgba(185, 190, 204, 1)', 1, '2024-05-09 12:40:21', '2024-05-09 12:40:31'),
(25, 'Gray', 'rgba(182, 190, 195, 1)', 1, '2024-05-09 12:41:06', '2024-05-09 12:41:06'),
(26, 'Printed', 'rgba(255, 255, 255, 1)', 1, '2024-05-13 06:42:58', '2024-05-13 06:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `contactinfos`
--

CREATE TABLE `contactinfos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) NOT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `officehour` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contactinfos`
--

INSERT INTO `contactinfos` (`id`, `phone`, `whatsapp`, `email`, `address`, `officehour`, `created_at`, `updated_at`) VALUES
(1, '01303638635', '01303638635', 'mail@email.com', '522/B North ShajahanPur, Dhaka.', 'Sat - Thu , 10AM to 6PM', '2024-05-06 01:11:04', '2024-05-06 02:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupons_title` varchar(255) NOT NULL,
  `coupons_code` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `free_shipping` tinyint(1) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `percent_value` int(11) DEFAULT NULL,
  `fixed` double DEFAULT NULL,
  `discounts_type` enum('percent','fixed') NOT NULL DEFAULT 'percent',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `division` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `loyalty_point` varchar(255) NOT NULL DEFAULT '0',
  `status` enum('registerd','not registerd') NOT NULL DEFAULT 'not registerd',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstName`, `lastName`, `phone`, `email`, `billing_address`, `division`, `district`, `area`, `loyalty_point`, `status`, `created_at`, `updated_at`) VALUES
(90, 'Md. Riyazul Islam', ' ', '01774998632', ' ', '522, North Shahjahanpur, Dhaka-1217', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 16:48:49', '2024-03-24 16:48:49'),
(91, 'Md. Kazi Mehedi', ' ', '01914644706', ' ', 'Chowdhuri para, Mukharji Ghat, Chadpur Sador', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 19:36:40', '2024-03-24 19:36:40'),
(92, 'Abu', 'Naim', '01771805956', NULL, 'Hat Chandra, Jamalpur Sador.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 19:49:14', '2024-03-25 07:04:54'),
(93, 'Abu Sufian', ' ', '01703419528', ' ', '20th Floor, Rupayan Shelford, 23/6 Mirpur Road, Dhaka 1207.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 19:57:14', '2024-03-24 19:57:14'),
(94, 'Abu Sufian', ' ', '01703419528', ' ', '20th Floor, Rupayan Shelford, 23/6 Mirpur Road, Dhaka 1207.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 19:57:23', '2024-03-24 19:57:23'),
(95, 'Mr. Rifat Hossain', ' ', '01738758133', ' ', 'Madaripur', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 20:05:08', '2024-03-24 20:05:08'),
(96, 'Masud Ahmed', ' ', '01751218778', ' ', '522/B, North Shahjahanpur, Dhaka-1217', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 20:14:40', '2024-03-24 20:14:40'),
(97, 'Dipu Ray', ' ', '01704389890', ' ', 'Begum Rokeya University, Parker More,Rangpur, Bangladesh', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 20:41:02', '2024-03-24 20:41:02'),
(98, 'Ismail Hossen', ' ', '01760442924', ' ', 'Nagorpur Govt. College Gate, Nagorpur, Tangail', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 20:43:08', '2024-03-24 20:43:08'),
(99, 'Ismail Hossen', ' ', '01760442924', ' ', 'Nagorpur Govt. College Gate, Nagorpur, Tangail', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 20:43:14', '2024-03-24 20:43:14'),
(100, 'Ismail Hossen', ' ', '01760442924', ' ', 'Nagorpur Govt. College Gate, Nagorpur, Tangail', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 20:43:23', '2024-03-24 20:43:23'),
(101, 'Ismail Hossen', ' ', '01760442924', ' ', 'Nagorpur Govt. College Gate, Nagorpur, Tangail', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 20:45:55', '2024-03-24 20:45:55'),
(102, 'Rubaiya', ' ', '01612535662', ' ', 'Nalonda school building 3rd floor, Modern mor, Rangpur.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 20:50:10', '2024-03-24 20:50:10'),
(103, 'BODRUL SAIKAT', ' ', '01304519972', ' ', 'Hanail nomania kamil madrasha, joypurhat sadar, joypurhat', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 20:52:02', '2024-03-24 20:52:02'),
(104, 'Kamrul Hossain', ' ', '01737386567', ' ', 'Norundi Bazar, Jamalpur Sadar, Jamalpur', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 20:53:58', '2024-03-24 20:53:58'),
(105, 'Abir Hasan', ' ', '01782457649', ' ', 'বটতৈল মোড়,কুষ্টিয়া', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 20:55:47', '2024-03-24 20:55:47'),
(106, 'Naim Abdullah', ' ', '01703052003', ' ', 'Eid-ga Road, Amtoli Upozila, Borguna', NULL, NULL, NULL, '0', 'not registerd', '2024-03-24 20:57:56', '2024-03-24 20:57:56'),
(110, 'Watana Islam Neha', ' ', '01709054861', ' ', 'Girls Hostel, Sheikh Hasina Medical College Tangail Sadar', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 13:05:30', '2024-03-25 13:05:30'),
(111, 'Watana Islam Neha', ' ', '01709054861', ' ', 'Girls Hostel,  Sheikh Hasina Medical College Tangail Sadar', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 13:18:06', '2024-03-25 13:18:06'),
(112, 'Jebin sultana', ' ', '01939821382', ' ', 'Genda upozila,  savar dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 13:21:26', '2024-03-25 13:21:26'),
(113, 'Mr. Rajib', ' ', '01672621826', ' ', 'Panthopath, Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 13:31:02', '2024-03-25 13:31:02'),
(114, 'MD Mazedur Rahman Tuhin', ' ', '01826740745', ' ', '453, Ashkona medical road, Hajjcamp, Dakshinkhan, Dhaka -1230', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 18:41:15', '2024-03-25 18:41:15'),
(115, 'Mr. Rishad', ' ', '01586296647', ' ', 'Amdoi Bazar, Joypur Hat', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 18:43:49', '2024-03-25 18:43:49'),
(116, 'Tarikul Islam Munna', ' ', '01988414806', ' ', 'House-102/1, Block-B, Road-4/6 , Mirpur-12, Dhaka 1216', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 18:45:27', '2024-03-25 18:45:27'),
(117, 'Mr. Rishad', ' ', '01586296647', ' ', 'Amdoi Bazar, Joypur Hat', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 18:47:23', '2024-03-25 18:47:23'),
(118, 'Mahbuba Rahman', ' ', '01794794592', ' ', 'Plot-1771, Boithakhalir Mor, Merul badda, Thana Road.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 19:06:49', '2024-03-25 19:06:49'),
(119, 'Md. Foysal', ' ', '01300366407', ' ', '15th Floor Dormitory BPATC, Savar, Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 19:18:12', '2024-03-25 19:18:12'),
(120, 'Al Amin Islam', ' ', '01927607899', ' ', 'Konapara, Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 19:25:16', '2024-03-25 19:25:16'),
(121, 'Al Amin', ' ', '01713 545080', ' ', 'Kakkol, Rupsha, Ulail, Shibaloy, Manikganj', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 19:48:26', '2024-03-25 19:48:26'),
(122, 'Abdullah Al Fahad', ' ', '01675665086', ' ', 'Demra, Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 19:51:38', '2024-03-25 19:51:38'),
(123, 'AKM Ashikuzzaman', ' ', '01776300277', ' ', 'Bangladesh Scouts', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 21:03:04', '2024-03-25 21:03:04'),
(124, 'Advocate Ashif Ul Haque', ' ', '01756019132', ' ', 'JuryCase, Mirpur Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 21:05:14', '2024-03-25 21:05:14'),
(125, 'Mr. Shamim', ' ', '01912268196', ' ', 'Al Amin Road, Rabeya Tower,', NULL, NULL, NULL, '0', 'not registerd', '2024-03-25 21:33:17', '2024-03-25 21:33:17'),
(126, 'Mr. Ruhan', ' ', '01331151490', ' ', 'Patalkandi bazar, Bhuyapur, Tangail', NULL, NULL, NULL, '0', 'not registerd', '2024-03-26 18:28:48', '2024-03-26 18:28:48'),
(127, 'MD Saikat Hossain', ' ', '01912534202', ' ', 'Shahadatpur, Khilari Tek, Badda', NULL, NULL, NULL, '0', 'not registerd', '2024-03-26 18:33:04', '2024-03-26 18:33:04'),
(129, 'Mr. Ruhan', ' ', '01331151490', ' ', 'Patalkandi bazar, Bhuyapur, Tangail', NULL, NULL, NULL, '0', 'not registerd', '2024-03-27 13:11:32', '2024-03-27 13:11:32'),
(130, 'A K M Ashiquzzaman', ' ', '01776300277', ' ', 'Bangladesh Scouts', NULL, NULL, NULL, '0', 'not registerd', '2024-03-27 14:13:25', '2024-03-27 14:13:25'),
(131, 'Md. Miraj Hossain', ' ', '01930758968, 01789157882', ' ', 'বাংলাদেশ শিশু হাসপাতাল ও ইন্সটিটিউট, শ্যামলি, শেরে বাংলা নগর ঢাকা ১২০৭.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-27 14:19:35', '2024-03-27 14:19:35'),
(132, 'Md. Tanvir', ' ', '01758569575', ' ', 'Jhikorgachai., Jessore.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-27 14:22:17', '2024-03-27 14:22:17'),
(133, 'Md zahid', ' ', '01635152924', ' ', 'Raozan,  Amir Hat, Chittagong', NULL, NULL, NULL, '0', 'not registerd', '2024-03-27 19:18:19', '2024-03-27 19:18:19'),
(134, 'Taslimuzzaman Akash', ' ', '01759157407', ' ', 'Binodiya Park er Pashe, Jessore Sadar', NULL, NULL, NULL, '0', 'not registerd', '2024-03-27 19:24:01', '2024-03-27 19:24:01'),
(135, 'Shofiul Bari', ' ', '01728245883', ' ', 'Niyamotpur Bazar, Niyamotpur Bazar, Nowga', NULL, NULL, NULL, '0', 'not registerd', '2024-03-27 19:30:07', '2024-03-27 19:30:07'),
(136, 'Md. Lokman', ' ', '01845355169', ' ', 'Najirhat Bazar, Fotiksori, Chottogram', NULL, NULL, NULL, '0', 'not registerd', '2024-03-27 19:35:01', '2024-03-27 19:35:01'),
(137, 'Junayed Chowdhury', ' ', '01836307809', ' ', 'Bogar Bazar , Trishal, Mymenshingh', NULL, NULL, NULL, '0', 'not registerd', '2024-03-28 13:35:22', '2024-03-28 13:35:22'),
(138, 'Nur A Towhid', ' ', '01706155636', ' ', 'Road-9, House-20, Rupnagar Abashik, Beside BUBT University, Mirpur-2, Dhaka-1216', NULL, NULL, NULL, '0', 'not registerd', '2024-03-28 13:39:37', '2024-03-28 13:39:37'),
(139, 'Mr. Parvez Mosarrof', ' ', '01744563755', ' ', 'House: 770, Block: G, Road: 23 , Boshundhara, Dhaka.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-28 13:56:39', '2024-03-28 13:56:39'),
(140, 'Tamjid ( Al- Amin Vai)', ' ', '01732042366', ' ', 'Alamin Road, Rabeya Tower, Demra konapara.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-28 15:12:39', '2024-03-28 15:12:39'),
(141, 'Sabbir Hoshen Khan', ' ', '01559675554, 01829765460', ' ', 'Bashundhara R/A, North South University Gate-1', NULL, NULL, NULL, '0', 'not registerd', '2024-03-29 12:53:35', '2024-03-29 12:53:35'),
(142, 'Md. Amzad', ' ', '01723981886', ' ', 'Jila: Nilfamari, District: Rongpur, Thana: Dimla', NULL, NULL, NULL, '0', 'not registerd', '2024-03-29 13:00:30', '2024-03-29 13:00:30'),
(143, 'Khondokar Kholil', ' ', '01921412145', ' ', 'Pakdi Chowrasta, Madaripur', NULL, NULL, NULL, '0', 'not registerd', '2024-03-29 13:03:14', '2024-03-29 13:03:14'),
(144, 'Mim', ' ', '01867032950', ' ', 'Changir Gao Bazar, Ramganj, Lakshmipur', NULL, NULL, NULL, '0', 'not registerd', '2024-03-29 13:10:00', '2024-03-29 13:10:00'),
(145, 'Mr. Ruman ( Al- Amin)', ' ', '01515622264', ' ', 'Bashabo, Dhaka.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-29 15:42:40', '2024-03-29 15:42:40'),
(146, 'Md. Rajib', ' ', '01308495788', ' ', 'Sylhet Housing Streat, Lane No: 2, Sylhet Sadar, Sylhet', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 12:50:13', '2024-03-30 12:50:13'),
(147, 'Md. Jahirul Islam Mazumder', ' ', '01720382192', ' ', 'Haziganj Govt. Model Pilot High School And College, Hajiganj, Chandpur', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 12:55:28', '2024-03-30 12:55:28'),
(148, 'Md. Mohin Khan', ' ', '01776567234', ' ', '55, Dhanmondi 9/a, Mina bazar er Pisone, Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 13:05:10', '2024-03-30 13:05:10'),
(149, 'Misbahul Fardin', ' ', '01623108619', ' ', 'Gholduba Bazar, Shahbajpur, Nobinogor, Hobiganj', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 13:09:10', '2024-03-30 13:09:10'),
(150, 'Mahmudul Hasan Joy', ' ', '01758132081', ' ', 'Pach Rastar Mor , Jamalpur Shadar', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 13:35:57', '2024-03-30 13:35:57'),
(151, 'Md Oliur Rahman', ' ', '01904822304', ' ', 'M A Rashid Hospital, Jamalpur', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 13:38:53', '2024-03-30 13:38:53'),
(152, 'Mr. Rana', ' ', '01890817393', ' ', 'Vill: Fakirganj, Thana: Pirganj, Zilla: Thakurgao', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 13:41:43', '2024-03-30 13:41:43'),
(153, 'Mr. Tahim', ' ', '01930880786', ' ', 'Vill: Bibirhat, Thana: Fatikchori Zilla: Chottogram', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 13:45:49', '2024-03-30 13:45:49'),
(154, 'Sultana Zubaera', ' ', '01644826625', ' ', 'Koborastan Mosjid, Dilalpur, Muradnagar, Cumilla', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 13:52:42', '2024-03-30 13:52:42'),
(155, 'Shorab Hossain', ' ', '01712013027', ' ', 'Hatchandra (Near BDR Camp), Jamalpur Shadar', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 13:58:31', '2024-03-30 13:58:31'),
(156, 'Mr Rana', ' ', '01811565266', ' ', 'Vatiyari, Chottogram', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 14:03:41', '2024-03-30 14:03:41'),
(157, 'Nurul Hasan', ' ', '01637920425', ' ', 'Village:Hasher Kandi-(Post Office Taltola Dakhil Madrasha, Union: Raj Nogor, Thana: Noria District: SoriyotPur.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 17:15:22', '2024-03-30 17:15:22'),
(158, 'Mr. Moniruzzaman', ' ', '01631463748', ' ', 'Kazi lohagora hatchery, Chunoti, Lohagora, Chattogram', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 17:47:53', '2024-03-30 17:47:53'),
(159, 'Abu Hasnat', ' ', '01760731966', ' ', 'Level:4, Culture Ceter, DOHS, Mirpur 12, Dhaka 1216.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 19:10:09', '2024-03-30 19:10:09'),
(160, 'Mehedi hasan Shuvo', ' ', '01609507662', ' ', 'Chondrokona, KPM, KRC School, Kaptai.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 19:33:22', '2024-03-30 19:33:22'),
(161, 'Md Sojib Islam', ' ', '01748320243', ' ', 'Rayan Khola Moshjid Gate, Mirpur 1, Dhaka.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 20:35:29', '2024-03-30 20:35:29'),
(162, 'Jubaer', ' ', '01567891322', ' ', 'Mirpur 11, blck:D, Road:25House: 31', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 21:06:19', '2024-03-30 21:06:19'),
(163, 'Babor Miayaji', ' ', '01998648745', ' ', 'comilla,Naggolkota,Banggadanga.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 22:25:04', '2024-03-30 22:25:04'),
(164, 'Adiba', ' ', '01896293232', ' ', 'A-7, Dhaka Commerce College Teachers Quarter, Mirpur-2, Dhaka.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-30 22:34:41', '2024-03-30 22:34:41'),
(165, 'Kazi Hridoy', ' ', '01634256538', ' ', 'Rabbani Market, Tin Mor, Moheshpur, 4no. dokkhin Khosbas Union, Borura, Cumilla', NULL, NULL, NULL, '0', 'not registerd', '2024-03-31 10:41:02', '2024-03-31 10:41:02'),
(166, 'Hasna Shorif', ' ', '01844167627', ' ', 'Block - B, Road/Lane: 1/1, Mirpur-13, Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-03-31 10:50:53', '2024-03-31 10:50:53'),
(167, 'Faruk Hossain', ' ', '01304604868', ' ', 'Union:  Brobihanali ,Kalishur Gram, Thana: BagMara, Zila: Raajshahi.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-31 18:15:23', '2024-03-31 18:15:23'),
(168, 'Md. Rifat', ' ', '0167286960', ' ', 'Mathertek, Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-03-31 18:45:06', '2024-03-31 18:45:06'),
(169, 'Sabbir Hossain', ' ', '01880482398', ' ', 'Dhaka gandariya Dupkhola math Riyazul jannah jame moshjid', NULL, NULL, NULL, '0', 'not registerd', '2024-03-31 19:54:27', '2024-03-31 19:54:27'),
(170, 'Mr. Eyakub', ' ', '01614333943', ' ', 'Zamadar bazar,chan miyar dokan. Sonagazi, Feni.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-31 19:59:08', '2024-03-31 19:59:08'),
(171, 'Mitu', ' ', '01621941595', ' ', 'Kodom toli,opposite to SP banglo, khagrachari sadar.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-31 20:05:39', '2024-03-31 20:05:39'),
(172, 'Mehedi Hasan', 'Simul', '01824890845', NULL, 'BUBT C-36,Arambag 8 number Gate,Mirpur 6', NULL, NULL, NULL, '0', 'not registerd', '2024-03-31 20:17:39', '2024-03-31 20:25:34'),
(173, 'Sizan Taimur', ' ', '01408587378', ' ', 'noyabati Putatol awamilig office khalishpur, khulna.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-31 20:31:38', '2024-03-31 20:31:38'),
(174, 'Abdur rahim', ' ', '01612931928', ' ', ',Balughat Bazar, Ba Bi khati bongobondhu Gate, Mirpur Cantonment, Dhaka.', NULL, NULL, NULL, '0', 'not registerd', '2024-03-31 20:37:32', '2024-03-31 20:37:32'),
(175, 'Ahammad Abdullah', 'Nayeem', '01764885783', NULL, 'Village : Kandarpodia (Kondorpodia), Post: Monohordia , Thana: Islamic University , Kushtia', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 11:12:41', '2024-04-01 13:05:03'),
(176, 'Emon Mahbub', ' ', '01716708613', ' ', 'Bahubol Hospital Road, Mocca medical Pharmacy,  Thana: bahubol, Zila:  Hobigonj.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 11:41:13', '2024-04-01 11:41:13'),
(177, 'Mohammad', 'Shahin', '01321198919', 'shahin229737@gmail.com', NULL, NULL, NULL, NULL, '0', 'registerd', '2024-04-01 12:05:35', '2024-04-01 12:05:35'),
(178, 'Abudullah al mamun Titash ( Al-Amin)', ' ', '01754911571', ' ', 'Nobabpur bazar, Chandina,  Comilla.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 13:37:38', '2024-04-01 13:37:38'),
(179, 'Abudullah al mamun Titash ( Al-Amin)', ' ', '01754911571', ' ', 'Nobabpur bazar, Chandina,  Comilla.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 13:37:44', '2024-04-01 13:37:44'),
(180, 'Abudullah al mamun Titash ( Al-Amin)', ' ', '01754911571', ' ', 'Nobabpur bazar, Chandina,  Comilla.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 13:37:53', '2024-04-01 13:37:53'),
(181, 'Abudullah al mamun Titash ( Al-Amin)', ' ', '01754911571', ' ', 'Nobabpur bazar, Chandina,  Comilla.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 13:37:58', '2024-04-01 13:37:58'),
(182, 'Abudullah al mamun Titash ( Al-Amin)', ' ', '01754911571', ' ', 'Nobabpur bazar, Chandina,  Comilla.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 13:38:50', '2024-04-01 13:38:50'),
(183, 'Abdullah Al mamun-( Al-Amin)', ' ', '01754911571', ' ', 'nobabpur bazar, Chandina, Comila.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 13:45:11', '2024-04-01 13:45:11'),
(184, 'Rubel', ' ', '01744515883', ' ', 'post Office: Fulbarihat, Dinajpur', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 14:13:42', '2024-04-01 14:13:42'),
(185, 'Rubel', ' ', '01744515883', ' ', 'post Office: Fulbarihat, Dinajpur', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 14:13:45', '2024-04-01 14:13:45'),
(186, 'Rubel', ' ', '01744515883', ' ', 'post Office: Fulbarihat, Dinajpur', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 14:13:58', '2024-04-01 14:13:58'),
(187, 'Israt', ' ', '016084000565', ' ', 'DOHS, Road: 10, House no; 1280, Avenue: 2', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 15:15:17', '2024-04-01 15:15:17'),
(188, 'Adrita Hasan adrita', ' ', '01846032111', ' ', 'Mujib Doctor Bari,Duaru, Mirsorai, Chattogram.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 19:28:41', '2024-04-01 19:28:41'),
(189, 'Aiyub', ' ', 'Dinajpur Sador, Dinajpur.', ' ', '01407878154', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 19:32:03', '2024-04-01 19:32:03'),
(190, 'Rabbi', ' ', '0167904053', ' ', 'Aqua Firoz Library Mor, Mymenshing Sador.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 20:13:29', '2024-04-01 20:13:29'),
(191, 'Saifur Rahman', ' ', '01630580014', ' ', 'jurain koborostan, Dhaka.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-01 20:43:51', '2024-04-01 20:43:51'),
(192, 'Rabbi', ' ', '01851855380', ' ', 'Village  beala, matrai Thana Kalai  Zilla joypurhat', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 08:46:26', '2024-04-02 08:46:26'),
(193, 'Naim Uddin', ' ', '01858229424', ' ', 'BokhotPur,Santir hat bazar,Tana; Fotikchori, chittagong', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 08:50:36', '2024-04-02 08:50:36'),
(194, 'Sakib', ' ', '01789151066', ' ', 'Bardi Bazar, Thana: Sonargaon,Narayanganj', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 09:04:55', '2024-04-02 09:04:55'),
(195, 'Nusrat Amin Niha', ' ', '01989470138', ' ', 'যাত্রাবাড়ী কাজলা ব্রিজ এর ঢালে সরকারি স্কুল গলি থেকে ওয়াশা 30 ফুট রাস্তার শেষে ৩তালা বাড়ি, বাড়ি: ৯১৭', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 10:02:27', '2024-04-02 10:02:27'),
(196, 'Ratul- ( Al-amin)', ' ', '01682449694', ' ', '522.B North Sajahalpur,Dhaka.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 11:18:51', '2024-04-02 11:18:51'),
(197, 'Anik Munshi', ' ', '01603895544', ' ', 'Cumilla Chauddaream', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 13:05:16', '2024-04-02 13:05:16'),
(198, 'BM Tanvir', ' ', '০১৬০৭৮৩৭৭৯৮', ' ', 'থানা : মহেশপুর..  জেলা : ঝিনাইদহ।', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 14:02:54', '2024-04-02 14:02:54'),
(199, 'ফারহান তানভীর অভি', ' ', '01628009764  / 01628009764', ' ', 'ঠিকানা: রোয়াচালা, শ্রীকাইল ইউনিয়ন,মুরাদনগর, কুমিল্লা।', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 14:09:15', '2024-04-02 14:09:15'),
(200, 'Muhammad Bin Haider', ' ', '01921117222', ' ', '1074/3, East Jurain Commisioner Road, Bagan bari, Jurain Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 14:47:07', '2024-04-02 14:47:07'),
(201, 'Arif', 'Hossen', '01303638635', NULL, '522/B, North Shahjahanpur, Dhaka-1217', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 16:49:22', '2024-04-03 05:22:41'),
(202, 'Al Amin Vai', ' ', '01927607899', ' ', 'Konapara, Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 17:32:26', '2024-04-02 17:32:26'),
(203, 'আরিফুল', ' ', '01757549835', ' ', 'উপজেলা রোড, গাইটাল, কিশোরগঞ্জ সদর .', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 18:49:35', '2024-04-02 18:49:35'),
(204, 'Mr. Asif', ' ', '০১৬৭০১৮১৫৫৬', ' ', 'বাড়ি :৩৭,রোড :০৮,ব্লক :ডি,রামপুরা বনশ্রী', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 19:46:54', '2024-04-02 19:46:54'),
(205, 'সামিউল আলিম', ' ', '০১৬০২৬০৮৯২১', ' ', 'যাত্রাপুর বাজার, বাগেরহাট  থানা,জেলা: বাগেরহাট', NULL, NULL, NULL, '0', 'not registerd', '2024-04-02 22:39:57', '2024-04-02 22:39:57'),
(206, 'Arif', 'Hossen', '01601958560', 'arifhossen853@gmail.com', '1/86 East Rasulpur, Kajla, Jatrabari, Dhaka 1236', '3', '1', '461', '10', 'registerd', '2024-04-03 05:23:27', '2024-04-03 05:23:27'),
(207, 'Shukanna', ' ', '01632837317', ' ', 'Musafir Bhaban (Kobi Bari)  Mosjid Road,  Hafiz Nagar Prodhan Sorok, Sonadanga Khulna', NULL, NULL, NULL, '0', 'not registerd', '2024-04-03 07:55:07', '2024-04-03 07:55:07'),
(208, 'Hizbul Bahar', ' ', '01309904899', ' ', 'Mymensingh, Bhaloka, Shibgong', NULL, NULL, NULL, '0', 'not registerd', '2024-04-03 11:13:52', '2024-04-03 11:13:52'),
(209, 'Ahad ali', ' ', '01765035302', ' ', 'Gaibandha, polashbri, dhaperhat, jaulabzr Recive point: jaulabzr', NULL, NULL, NULL, '0', 'not registerd', '2024-04-03 12:03:01', '2024-04-03 12:03:01'),
(210, 'Md Shifat', ' ', '01760639070', ' ', 'Barundi;Manikganj;Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-04-03 13:25:33', '2024-04-03 13:25:33'),
(211, 'Mukul Shekh', ' ', '01968410057', ' ', 'Nabinagar prodhan bari mosque,ponchoboti,fatullah, Narayanganj', NULL, NULL, NULL, '0', 'not registerd', '2024-04-03 14:24:12', '2024-04-03 14:24:12'),
(212, 'Tasnim Tamanna', ' ', '01647591948', ' ', 'Central Medical College campus, Girls hostel, Paduar bazar, Bishwaroad, Cumilla', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 06:52:46', '2024-04-04 06:52:46'),
(213, 'Md Atiar Rahman', ' ', '01740431368', ' ', 'Dugdugihat Ghoraghat Dinajpur.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 07:39:21', '2024-04-04 07:39:21'),
(214, 'Sabiha', ' ', '01879468949', ' ', 'মগনামা(ফুলতলা স্টেশন ) উপজেলা - পেকুয়া,জেলা- কক্সবাজার।', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 07:49:59', '2024-04-04 07:49:59'),
(215, 'Mohammed Salauddin', ' ', '01325877624', ' ', 'Charlakshya , Board Bazar, karna fully , chittagong', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 08:01:50', '2024-04-04 08:01:50'),
(216, 'Tuhin', ' ', '01572079507', ' ', 'গ্রাম : উত্তর সুজাপুর,  পোস্ট  ও থানা ফুলবাড়ি, জেলা : দিনাজপুর', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 09:37:25', '2024-04-04 09:37:25'),
(217, 'Mumitul islam', ' ', '01610429394', ' ', 'Khatley , Bhola sodor Bhola', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 10:12:15', '2024-04-04 10:12:15'),
(218, 'Sharf uddin raihan', ' ', '01600142239', ' ', 'shapla kanon,kalibari, bashabo  dhaka 1214', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 10:30:55', '2024-04-04 10:30:55'),
(219, 'তানিম', ' ', '০১৮৩০৪৭১৯৪৬', ' ', 'সোনাগাজি, ফেনি', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 11:05:27', '2024-04-04 11:05:27'),
(220, 'Noman Abdullah', ' ', '01576589987', ' ', '202 East Goran Khilgaon, Dhaka- 1219.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 12:10:54', '2024-04-04 12:10:54'),
(221, 'Sufian', ' ', '01607705300', ' ', 'jorpul, kashimpur, matlab south, chandpur', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 13:59:26', '2024-04-04 13:59:26'),
(222, 'শিশির মোহাম্মাদ আজাদ', ' ', '01713750345', ' ', 'সিটি গেইট, বিশ্ব ব‍্যাংক কলোনী, চট্টগ্রাম', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 14:25:50', '2024-04-04 14:25:50'),
(223, 'অমিত হাসান', ' ', '০১৮২৪২৯৭১৩৫', ' ', 'ফেনী, দাগনভূঞা', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 14:49:49', '2024-04-04 14:49:49'),
(224, 'মো:তুহিন', ' ', '01772751006', ' ', 'পয়াত প্রথমিক বিদ্যালয় থানা:বুড়িচং  জেলা :কুমিল্লা', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 18:51:29', '2024-04-04 18:51:29'),
(225, 'umme khadija', ' ', '01771348722', ' ', '878,middle monipur mirpur 2,dhaka 1216 4.mirpur  thana', NULL, NULL, NULL, '0', 'not registerd', '2024-04-04 18:57:40', '2024-04-04 18:57:40'),
(226, 'Md Munimul Islam', ' ', '01799846537', ' ', 'Dhaka Nodda Sohid Abdul Ajij Sarak  Jamuna Feature parker pase', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 07:41:54', '2024-04-05 07:41:54'),
(227, 'ফয়সাল আহমেদ', ' ', '০১৬৩২৭৯১৩৬১', ' ', 'দোহার-নবাবগন্জ(নবাবগঞ্জ বাস স্টান্ট).  জেলা ঢাকা', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 07:44:01', '2024-04-05 07:44:01'),
(228, 'আরমান', ' ', '০১৯৭৯০৯০৩৬৮', ' ', 'বঙ্গবন্ধু এভিনিউ হাটহাজারী চট্টগ্রাম', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 07:46:16', '2024-04-05 07:46:16'),
(229, 'Johirul islam Jahid', ' ', 'Telghat Keraniganj', ' ', 'বিসিক ফকির মার্কেট হাজী সাঈদ ল্যাবরেটরী স্কুলের পাশে স্টেশন রোড থেকে ভিতরে টঙ্গী গাজীপুর।', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 07:56:51', '2024-04-05 07:56:51'),
(230, 'Taher', 'tuhin', '0132697070', NULL, 'শাহবাজপুর (উমা টেলিকম) মধ্য বাজার, থাকাঃ বড়লেখা জেলাঃ মোলভিবাজার', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 07:59:19', '2024-04-05 10:48:28'),
(231, 'Kamrul Hasan', ' ', '01316104633', ' ', 'Fulghar, Haidorabad, Bangor bazar thana, Cumilla.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 08:06:27', '2024-04-05 08:06:27'),
(232, 'JU Rishad', ' ', '01834050372', ' ', 'khulna, khalispur, girls polytechnic,', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 08:15:35', '2024-04-05 08:15:35'),
(233, 'টিটন মিয়া', ' ', '০১৭৪৪১৭২৬৯০', ' ', 'গ্রাম :বাজার গোপালপুর  থানা জেলা :ঝিনাইদহ সদর', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 08:33:24', '2024-04-05 08:33:24'),
(234, 'MD Rifat', ' ', '01631163644', ' ', 'লক্ষীপুর, চন্দ্রগঞ্জ পশ্চিম বাজার', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 10:33:57', '2024-04-05 10:33:57'),
(235, 'Rashed Uzzaman Thuhid', ' ', '01647637119', ' ', '312/A, Dali Bari, Apollo Link Road, Bashundhara,Vatara,Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 11:26:09', '2024-04-05 11:26:09'),
(236, 'উৎস', ' ', '০১৩১৪৭৯৯২৬০', ' ', 'ডাক্তারের গাট মোর, মসুয়া, কটিয়াদি, কিশোরগঞ্জ', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 13:08:10', '2024-04-05 13:08:10'),
(237, 'Md. Rashed', ' ', '01645354916', ' ', 'Noahali, Shonaimuri, Deoti', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 13:10:02', '2024-04-05 13:10:02'),
(238, 'Md. Shakil', ' ', '01811017801', ' ', 'Dhamrai Bazar, Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 13:11:51', '2024-04-05 13:11:51'),
(239, 'খলিলুর রহমান', ' ', '01701376656', ' ', 'গ্রাম :মিরপুর,  উপজেলা: বাহুবল, জেলা :হবিগঞ্জ', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 13:16:36', '2024-04-05 13:16:36'),
(240, 'Niloy Mahmud', ' ', '01994796186', ' ', 'গাজীপুর শ্রীপুর মাওনা কাওরান বাজার', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 13:21:43', '2024-04-05 13:21:43'),
(241, 'Khan Parvej', ' ', '01313360743', ' ', 'Boropul, Rajshahi', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 13:31:44', '2024-04-05 13:31:44'),
(242, 'Sahal Islam', ' ', '01799555920', ' ', 'Shah ji Bazar, Sylhet, Habiganj, madhabpur,', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 13:36:30', '2024-04-05 13:36:30'),
(243, 'MD ABIR', ' ', '01903555540', ' ', 'নারায়ণগন্জ থানা,  ১ নং রেল গেইট, সুগন্দা বেকারি।', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 13:38:59', '2024-04-05 13:38:59'),
(244, 'badhon', ' ', '01758445614', ' ', 'zohurimolla 33/4, shymoli, Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 13:47:14', '2024-04-05 13:47:14'),
(245, 'Nuruddin', ' ', '01789705322', ' ', 'feni sonagazi, sonagazi, Feni', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 13:57:40', '2024-04-05 13:57:40'),
(246, 'Tuhin', ' ', '01572079507', ' ', 'গ্রাম : উত্তর সুজাপুর,  পোস্ট  ও থানা ফুলবাড়ি, জেলা : দিনাজপুর', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 14:01:16', '2024-04-05 14:01:16'),
(247, 'Arif', ' ', '01762723364', ' ', '(Mochmail Bazar) Village: Paikpara, Post Office: Mochmail, Sub District: Bagmara, District: Rajshahi', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 15:12:46', '2024-04-05 15:12:46'),
(248, 'ফরহাদ', ' ', '০১৮১২৬৮৪৯২৮', ' ', 'পুর্ব ডেঙ্গাপাড়া স্কুলের সামনে, পোস্ট -ডেঙ্গাপাড়া, থানা-পটিয়া, জেলা-চট্টগ্রাম।', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 15:34:13', '2024-04-05 15:34:13'),
(249, 'Nahid', ' ', '01783909786', ' ', 'Barisal, muladi thana sadar.', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 15:49:39', '2024-04-05 15:49:39'),
(250, 'জিসান', ' ', '01722998832', ' ', 'সোনালী ব্যাংক পিএলসি কলেজ রোড শাখা , বরিশাল', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 16:24:42', '2024-04-05 16:24:42'),
(251, 'Saifuddin Tamim', ' ', '01304903918', ' ', 'District :Patuakhali,   Thana: Dhasmina', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 19:19:53', '2024-04-05 19:19:53'),
(252, 'Sami', ' ', '01932401533', ' ', '522/B, North Shahjahanpur', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 20:08:07', '2024-04-05 20:08:07'),
(253, 'তনিমা রহমান', ' ', '01312683350', ' ', 'চন্দন বাড়ি কামিল মাদ্রাসা, জেলা: নরসিংদী,  উপজেলা : মনোহরদী', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 20:58:22', '2024-04-05 20:58:22'),
(254, 'Mr. Shakib LMS', ' ', '01774822555', ' ', 'Japan', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 21:24:57', '2024-04-05 21:24:57'),
(255, 'রেদওয়ান আহমেমেদ', ' ', '০১৮৮০১৩৪৮৩০', ' ', 'সাতক্ষীরা জেলার আশাশুনি থানার Brack office এর এখানে', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 22:40:08', '2024-04-05 22:40:08'),
(256, 'শাহ আলম', ' ', '01600738412', ' ', 'থানা গৌরীপুর  বোড বাজার ,  জেলা ময়মনসিংহ', NULL, NULL, NULL, '0', 'not registerd', '2024-04-05 23:17:32', '2024-04-05 23:17:32'),
(257, 'allan Nahid', ' ', '01913432620', ' ', 'Tongi chragali bustand molla supar market', NULL, NULL, NULL, '0', 'not registerd', '2024-04-06 10:15:52', '2024-04-06 10:15:52'),
(258, 'Afsana Afroz', ' ', '01867499416', ' ', 'Matir Mosjid, Baipail,Savar Dhaka Thana : Ashulia', NULL, NULL, NULL, '0', 'not registerd', '2024-04-06 10:24:05', '2024-04-06 10:24:05'),
(259, 'Saila pathan', ' ', '01580626957', ' ', 'ম ১০৫/৭ পশ্চিম মেরুল বাড্ডা,মদিনা টাওয়ার', NULL, NULL, NULL, '0', 'not registerd', '2024-04-06 10:36:02', '2024-04-06 10:36:02'),
(260, 'নাহিদ হাসান', ' ', '০১৯৬৫৩৬৩৫৮০', ' ', 'উত্তরা , ৮ নং সেক্টর আইচি মেডিকেল ( তুরাগ নদীর সাথে)', NULL, NULL, NULL, '0', 'not registerd', '2024-04-06 13:15:34', '2024-04-06 13:15:34'),
(261, 'Shila', ' ', '01914631126', ' ', 'Konapara', NULL, NULL, NULL, '0', 'not registerd', '2024-04-06 16:01:39', '2024-04-06 16:01:39'),
(262, 'Md. Naim', ' ', '01935507616', ' ', 'Shomitir Hat, Muktar Mollar Madrasha, Kalkini, Madaripur', NULL, NULL, NULL, '0', 'not registerd', '2024-04-06 17:06:40', '2024-04-06 17:06:40'),
(263, 'Kotha', ' ', '01761086970', ' ', 'Shyamoli', NULL, NULL, NULL, '0', 'not registerd', '2024-04-06 17:53:46', '2024-04-06 17:53:46'),
(264, 'Alvi Rahman', ' ', '0154003750', ' ', 'ECB, Mirpur', NULL, NULL, NULL, '0', 'not registerd', '2024-04-06 18:17:12', '2024-04-06 18:17:12'),
(265, 'Md. Shagor-Al Amin', ' ', '01786941583', ' ', 'Kuakata', NULL, NULL, NULL, '0', 'not registerd', '2024-04-06 20:45:00', '2024-04-06 20:45:00'),
(266, 'Holi Apu (Naim)', ' ', '01794320704', ' ', 'Jamalpur, Mainpur', NULL, NULL, NULL, '0', 'not registerd', '2024-04-08 09:22:48', '2024-04-08 09:22:48'),
(267, 'fdhd', ' ', '01764885783', ' ', 'wrt', NULL, NULL, NULL, '0', 'not registerd', '2024-04-28 16:24:56', '2024-04-28 16:24:56'),
(268, 'br', ' ', '01764885783', ' ', 'df', NULL, NULL, NULL, '0', 'not registerd', '2024-04-29 11:19:07', '2024-04-29 11:19:07'),
(269, 'Abdul Aziz Rony', ' ', '01981-316613', ' ', 'মীরহাজীরবাগ, (হাবু কমিশনের বাড়ির সামনে), যাত্রাবাড়ী।', NULL, NULL, NULL, '0', 'not registerd', '2024-05-13 10:05:41', '2024-05-13 10:05:41'),
(270, 'Junayed Chowdhury', ' ', '01836307809', ' ', 'Bogar Bazar , Trishal ,Mymenshingh', NULL, NULL, NULL, '0', 'not registerd', '2024-05-13 11:29:07', '2024-05-13 11:29:07'),
(271, 'Foysal (Al-Amin)', ' ', '01705567455', ' ', 'Konapara, Demra, Dhaka', NULL, NULL, NULL, '0', 'not registerd', '2024-05-15 08:05:47', '2024-05-15 08:05:47'),
(272, 'Sakib', ' ', '01780965781', ' ', 'Zila:Netrokona,  Upazila :Durgapur,  Union:Chandigor,Shatasi bazar.', NULL, NULL, NULL, '0', 'not registerd', '2024-05-18 07:51:12', '2024-05-18 07:51:12'),
(273, 'Amir Hamza', ' ', '০১৭৭৯৫২৪২৮২', ' ', 'সিলেট, কানিশাইল,১নং রোড,প্রাতাশা ৫৪,তাহের শপ', NULL, NULL, NULL, '0', 'not registerd', '2024-05-19 08:16:52', '2024-05-19 08:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_zones`
--

CREATE TABLE `delivery_zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `upazila` varchar(255) NOT NULL,
  `charge` decimal(8,2) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bn_name` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `zone_charge` decimal(10,0) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `long`, `zone_charge`, `created_at`, `updated_at`) VALUES
(1, 3, 'Dhaka', 'ঢাকা', '23.7115253', '90.4111451', 50, NULL, '2024-01-29 02:16:24'),
(2, 3, 'Faridpur', 'ফরিদপুর', '23.6070822', '89.8429406', 130, NULL, NULL),
(3, 3, 'Gazipur', 'গাজীপুর', '24.0022858', '90.4264283', 130, NULL, NULL),
(4, 3, 'Gopalganj', 'গোপালগঞ্জ', '23.0050857', '89.8266059', 130, NULL, NULL),
(5, 8, 'Jamalpur', 'জামালপুর', '24.937533', '89.937775', 130, NULL, NULL),
(6, 3, 'Kishoreganj', 'কিশোরগঞ্জ', '24.444937', '90.776575', 130, NULL, NULL),
(7, 3, 'Madaripur', 'মাদারীপুর', '23.164102', '90.1896805', 130, NULL, NULL),
(8, 3, 'Manikganj', 'মানিকগঞ্জ', '23.8644', '90.0047', 130, NULL, NULL),
(9, 3, 'Munshiganj', 'মুন্সিগঞ্জ', '23.5422', '90.5305', 130, NULL, NULL),
(10, 8, 'Mymensingh', 'ময়মনসিংহ', '24.7471', '90.4203', 130, NULL, NULL),
(11, 3, 'Narayanganj', 'নারায়াণগঞ্জ', '23.63366', '90.496482', 130, NULL, NULL),
(12, 3, 'Narsingdi', 'নরসিংদী', '23.932233', '90.71541', 130, NULL, NULL),
(13, 8, 'Netrokona', 'নেত্রকোণা', '24.870955', '90.727887', 130, NULL, NULL),
(14, 3, 'Rajbari', 'রাজবাড়ি', '23.7574305', '89.6444665', 130, NULL, NULL),
(15, 3, 'Shariatpur', 'শরীয়তপুর', '23.2423', '90.4348', 130, NULL, NULL),
(16, 8, 'Sherpur', 'শেরপুর', '25.0204933', '90.0152966', 130, NULL, NULL),
(17, 3, 'Tangail', 'টাঙ্গাইল', '24.2513', '89.9167', 130, NULL, NULL),
(18, 5, 'Bogura', 'বগুড়া', '24.8465228', '89.377755', 130, NULL, NULL),
(19, 5, 'Joypurhat', 'জয়পুরহাট', '25.0968', '89.0227', 130, NULL, NULL),
(20, 5, 'Naogaon', 'নওগাঁ', '24.7936', '88.9318', 130, NULL, NULL),
(21, 5, 'Natore', 'নাটোর', '24.420556', '89.000282', 130, NULL, NULL),
(22, 5, 'Nawabganj', 'নবাবগঞ্জ', '24.5965034', '88.2775122', 130, NULL, NULL),
(23, 5, 'Pabna', 'পাবনা', '23.998524', '89.233645', 130, NULL, NULL),
(24, 5, 'Rajshahi', 'রাজশাহী', '24.3745', '88.6042', 130, NULL, NULL),
(25, 5, 'Sirajgonj', 'সিরাজগঞ্জ', '24.4533978', '89.7006815', 130, NULL, NULL),
(26, 6, 'Dinajpur', 'দিনাজপুর', '25.6217061', '88.6354504', 130, NULL, NULL),
(27, 6, 'Gaibandha', 'গাইবান্ধা', '25.328751', '89.528088', 130, NULL, NULL),
(28, 6, 'Kurigram', 'কুড়িগ্রাম', '25.805445', '89.636174', 130, NULL, NULL),
(29, 6, 'Lalmonirhat', 'লালমনিরহাট', '25.9923', '89.2847', 130, NULL, NULL),
(30, 6, 'Nilphamari', 'নীলফামারী', '25.931794', '88.856006', 130, NULL, NULL),
(31, 6, 'Panchagarh', 'পঞ্চগড়', '26.3411', '88.5541606', 130, NULL, NULL),
(32, 6, 'Rangpur', 'রংপুর', '25.7558096', '89.244462', 130, NULL, NULL),
(33, 6, 'Thakurgaon', 'ঠাকুরগাঁও', '26.0336945', '88.4616834', 130, NULL, NULL),
(34, 1, 'Barguna', 'বরগুনা', '22.0953', '90.1121', 130, NULL, NULL),
(35, 1, 'Barishal', 'বরিশাল', '22.7010', '90.3535', 130, NULL, NULL),
(36, 1, 'Bhola', 'ভোলা', '22.685923', '90.648179', 130, NULL, NULL),
(37, 1, 'Jhalokati', 'ঝালকাঠি', '22.6406', '90.1987', 130, NULL, NULL),
(38, 1, 'Patuakhali', 'পটুয়াখালী', '22.3596316', '90.3298712', 130, NULL, NULL),
(39, 1, 'Pirojpur', 'পিরোজপুর', '22.5841', '89.9720', 130, NULL, NULL),
(40, 2, 'Bandarban', 'বান্দরবান', '22.1953275', '92.2183773', 130, NULL, NULL),
(41, 2, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', '23.9570904', '91.1119286', 130, NULL, NULL),
(42, 2, 'Chandpur', 'চাঁদপুর', '23.2332585', '90.6712912', 130, NULL, NULL),
(43, 2, 'Chattogram', 'চট্টগ্রাম', '22.335109', '91.834073', 130, NULL, NULL),
(44, 2, 'Cumilla', 'কুমিল্লা', '23.4682747', '91.1788135', 130, NULL, NULL),
(45, 2, 'Cox\'s Bazar', 'কক্স বাজার', '21.4272', '92.0058', 130, NULL, NULL),
(46, 2, 'Feni', 'ফেনী', '23.0159', '91.3976', 130, NULL, NULL),
(47, 2, 'Khagrachari', 'খাগড়াছড়ি', '23.119285', '91.984663', 130, NULL, NULL),
(48, 2, 'Lakshmipur', 'লক্ষ্মীপুর', '22.942477', '90.841184', 130, NULL, NULL),
(49, 2, 'Noakhali', 'নোয়াখালী', '22.869563', '91.099398', 130, NULL, NULL),
(50, 2, 'Rangamati', 'রাঙ্গামাটি', '22.7324', '92.2985', 130, NULL, NULL),
(51, 7, 'Habiganj', 'হবিগঞ্জ', '24.374945', '91.41553', 130, NULL, NULL),
(52, 7, 'Maulvibazar', 'মৌলভীবাজার', '24.482934', '91.777417', 130, NULL, NULL),
(53, 7, 'Sunamganj', 'সুনামগঞ্জ', '25.0658042', '91.3950115', 130, NULL, NULL),
(54, 7, 'Sylhet', 'সিলেট', '24.8897956', '91.8697894', 130, NULL, NULL),
(55, 4, 'Bagerhat', 'বাগেরহাট', '22.651568', '89.785938', 130, NULL, NULL),
(56, 4, 'Chuadanga', 'চুয়াডাঙ্গা', '23.6401961', '88.841841', 130, NULL, NULL),
(57, 4, 'Jashore', 'যশোর', '23.16643', '89.2081126', 130, NULL, NULL),
(58, 4, 'Jhenaidah', 'ঝিনাইদহ', '23.5448176', '89.1539213', 130, NULL, NULL),
(59, 4, 'Khulna', 'খুলনা', '22.815774', '89.568679', 130, NULL, NULL),
(60, 4, 'Kushtia', 'কুষ্টিয়া', '23.901258', '89.120482', 130, NULL, NULL),
(61, 4, 'Magura', 'মাগুরা', '23.487337', '89.419956', 130, NULL, NULL),
(62, 4, 'Meherpur', 'মেহেরপুর', '23.762213', '88.631821', 130, NULL, NULL),
(63, 4, 'Narail', 'নড়াইল', '23.172534', '89.512672', 130, NULL, NULL),
(64, 4, 'Satkhira', 'সাতক্ষীরা', '22.7185', '89.0705', 130, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bn_name` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(1, 'Barishal', 'বরিশাল', '22.701002', '90.353451', NULL, NULL),
(2, 'Chattogram', 'চট্টগ্রাম', '22.356851', '91.783182', NULL, NULL),
(3, 'Dhaka', 'ঢাকা', '23.810332', '90.412518', NULL, NULL),
(4, 'Khulna', 'খুলনা', '22.845641', '89.540328', NULL, NULL),
(5, 'Rajshahi', 'রাজশাহী', '24.363589', '88.624135', NULL, NULL),
(6, 'Rangpur', 'রংপুর', '25.743892', '89.275227', NULL, NULL),
(7, 'Sylhet', 'সিলেট', '24.894929', '91.868706', NULL, NULL),
(8, 'Mymensingh', 'ময়মনসিংহ', '24.747149', '90.420273', NULL, NULL);

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
-- Table structure for table `feature_categories`
--

CREATE TABLE `feature_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_featured` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_categories`
--

INSERT INTO `feature_categories` (`id`, `category_id`, `title`, `text`, `image`, `status`, `is_featured`, `created_at`, `updated_at`) VALUES
(7, 10, 'Summer Friendly Premium Panjabi', NULL, 'feature/category/1715587499.jpg', 'Active', '1', '2024-05-13 08:05:00', '2024-05-13 08:05:00'),
(8, 13, 'Summer Panjabi Collection', NULL, 'feature/category/1715587662.jpg', 'Active', '2', '2024-05-13 08:07:43', '2024-05-13 08:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `feature_products`
--

CREATE TABLE `feature_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_products_title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feature_products_with_pivot`
--

CREATE TABLE `feature_products_with_pivot` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_products_id` bigint(20) UNSIGNED NOT NULL,
  `products_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_12_20_065626_create_subcategories_table', 1),
(7, '2023_12_20_065636_create_brands_table', 1),
(8, '2023_12_20_065711_create_colors_table', 1),
(9, '2023_12_20_065724_create_sizes_table', 1),
(10, '2023_12_21_055317_create_products_table', 1),
(11, '2023_12_21_061717_create_varients_table', 1),
(16, '2023_12_27_100009_create_media_table', 1),
(17, '2023_12_28_060721_create_products_colors_table', 1),
(18, '2023_12_28_060740_create_products_sizes_table', 1),
(19, '2023_12_30_063527_create_product_tags_table', 1),
(20, '2023_12_30_063545_create_product_overviews_table', 1),
(21, '2023_12_30_063847_create_product_additionalinfos_table', 1),
(22, '2023_12_30_063858_create_product_images_table', 1),
(23, '2023_12_30_063908_create_product_extras_table', 1),
(24, '2024_01_04_150814_create_product_prices_table', 1),
(25, '2024_01_08_070143_create_carts_table', 1),
(26, '2024_01_08_091312_create_shoppingcart_table', 1),
(27, '2024_01_14_041713_create_districts_table', 2),
(28, '2024_01_14_042136_create_upazillas_table', 3),
(29, '2024_01_13_044915_create_divisions_table', 4),
(33, '2024_01_14_044937_create_postcodes_table', 5),
(34, '2023_12_23_122959_create_customers_table', 6),
(36, '2023_12_24_054642_create_orders_table', 6),
(37, '2024_01_14_095315_create_order_items_table', 6),
(38, '2024_01_14_095428_create_shippings_table', 7),
(39, '2024_01_14_095446_create_transactions_table', 7),
(40, '2023_12_23_132528_create_register_customers_table', 8),
(42, '2024_01_22_054321_create_orderstatuses_table', 9),
(43, '2023_12_20_041449_create_suppliers_table', 10),
(44, '2023_12_20_065612_create_categories_table', 11),
(46, '2024_01_29_055920_create_delivery_zones_table', 12),
(47, '2024_02_04_052438_create_feature_categories_table', 13),
(48, '2024_02_06_072336_create_product_thumbnails_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 9),
(5, 'App\\Models\\User', 3),
(5, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 10);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_type_id` bigint(20) UNSIGNED NOT NULL,
  `offer_name` varchar(255) NOT NULL,
  `offer_percent` double NOT NULL,
  `to_date` varchar(255) DEFAULT NULL,
  `from_date` varchar(255) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offer_types`
--

CREATE TABLE `offer_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_type_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offer_types`
--

INSERT INTO `offer_types` (`id`, `offer_type_name`, `created_at`, `updated_at`) VALUES
(5, 'Summer', '2024-04-24 08:28:50', '2024-04-24 08:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `order_track_id` varchar(255) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) NOT NULL,
  `total_paid` decimal(8,2) DEFAULT 0.00,
  `total_due` decimal(8,2) DEFAULT 0.00,
  `delivery_charge` decimal(8,2) DEFAULT 0.00,
  `status` enum('pending','confirmed','delivered','completed','returned','cancelled','shipped') NOT NULL DEFAULT 'pending',
  `is_shipping_different` tinyint(1) NOT NULL DEFAULT 0,
  `order_from` varchar(255) DEFAULT NULL,
  `canceled_date` date DEFAULT NULL,
  `return_confirm` tinyint(1) DEFAULT 0,
  `comment` longtext DEFAULT NULL,
  `is_pos` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice_no`, `order_track_id`, `customer_id`, `subtotal`, `discount`, `tax`, `total`, `total_paid`, `total_due`, `delivery_charge`, `status`, `is_shipping_different`, `order_from`, `canceled_date`, `return_confirm`, `comment`, `is_pos`, `created_at`, `updated_at`) VALUES
(6, '052425', NULL, 269, 1230.00, 0.00, NULL, 1300.00, 0.00, 1300.00, 70.00, 'completed', 0, 'Facebook', NULL, 0, 'Pos order', 1, '2024-05-13 10:05:41', '2024-05-13 10:05:41'),
(7, '052402', NULL, 270, 880.00, 0.00, NULL, 1000.00, 0.00, 1000.00, 120.00, 'completed', 0, 'Facebook', NULL, 0, 'Pos order', 1, '2024-05-13 11:29:07', '2024-05-13 11:29:07'),
(8, '052401', NULL, 271, 6550.00, 0.00, NULL, 6550.00, 6550.00, 0.00, 0.00, 'completed', 0, 'Koohen', NULL, 0, 'Pos order', 1, '2024-05-15 08:05:47', '2024-05-15 08:05:47'),
(9, '052438', NULL, 271, 8200.00, 0.00, NULL, 8200.00, 8200.00, 0.00, 0.00, 'completed', 0, 'Koohen', NULL, 0, 'Pos order', 1, '2024-05-15 08:09:44', '2024-05-15 10:12:44'),
(10, '052459', NULL, 271, 3075.00, 0.00, NULL, 3075.00, 0.00, 3075.00, 0.00, 'completed', 0, 'Koohen', NULL, 0, 'Pos order', 1, '2024-05-15 08:11:11', '2024-05-15 08:11:11'),
(11, '052489', NULL, 271, 7175.00, 0.00, NULL, 7175.00, 0.00, 7175.00, 0.00, 'completed', 0, 'Koohen', NULL, 0, 'Pos order', 1, '2024-05-15 08:12:57', '2024-05-15 08:12:57'),
(12, '052406', NULL, 272, 1130.00, 0.00, NULL, 1250.00, 0.00, 1250.00, 120.00, 'completed', 0, 'Koohen', NULL, 0, 'Pos order', 1, '2024-05-18 07:51:12', '2024-05-18 07:51:12'),
(13, '052416', NULL, 273, 2160.00, 0.00, NULL, 2300.00, 0.00, 2300.00, 140.00, 'completed', 0, 'Facebook', NULL, 0, 'Pos order', 1, '2024-05-19 08:16:52', '2024-05-19 08:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `orderstatuses`
--

CREATE TABLE `orderstatuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','confirmed','shipped','delivered','completed','returned','cancelled') NOT NULL DEFAULT 'pending',
  `confirmed_date_time` datetime DEFAULT NULL,
  `shipped_date_time` datetime DEFAULT NULL,
  `delivered_date_time` datetime DEFAULT NULL,
  `completed_date_time` datetime DEFAULT NULL,
  `returned_date_time` datetime DEFAULT NULL,
  `cancelled_date_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `size_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rstatus` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `product_id`, `order_id`, `color_id`, `size_id`, `price`, `quantity`, `rstatus`, `created_at`, `updated_at`) VALUES
(14, 36, 6, 20, 6, 1230.00, 1, 0, '2024-05-13 10:05:41', '2024-05-13 10:05:41'),
(15, 48, 7, 14, 6, 880.00, 1, 0, '2024-05-13 11:29:07', '2024-05-13 11:29:07'),
(16, 71, 8, 11, 7, 1500.00, 1, 0, '2024-05-15 08:05:47', '2024-05-15 08:05:47'),
(17, 71, 8, 11, 8, 1500.00, 1, 0, '2024-05-15 08:05:47', '2024-05-15 08:05:47'),
(18, 71, 8, 11, 18, 1500.00, 1, 0, '2024-05-15 08:05:47', '2024-05-15 08:05:47'),
(19, 49, 8, 5, 8, 1025.00, 1, 0, '2024-05-15 08:05:47', '2024-05-15 08:05:47'),
(20, 49, 8, 5, 18, 1025.00, 1, 0, '2024-05-15 08:05:47', '2024-05-15 08:05:47'),
(21, 58, 9, 20, 8, 1025.00, 3, 0, '2024-05-15 08:09:44', '2024-05-15 08:17:52'),
(22, 58, 9, 20, 7, 1025.00, 3, 0, '2024-05-15 08:09:44', '2024-05-15 08:09:44'),
(24, 58, 9, 20, 18, 1025.00, 1, 0, '2024-05-15 08:09:44', '2024-05-15 08:09:44'),
(25, 57, 10, 23, 7, 1025.00, 2, 0, '2024-05-15 08:11:11', '2024-05-15 08:11:11'),
(26, 57, 10, 23, 8, 1025.00, 1, 0, '2024-05-15 08:11:11', '2024-05-15 08:11:11'),
(27, 48, 11, 14, 6, 1025.00, 1, 0, '2024-05-15 08:12:57', '2024-05-15 08:12:57'),
(28, 48, 11, 14, 7, 1025.00, 2, 0, '2024-05-15 08:12:57', '2024-05-15 08:12:57'),
(29, 48, 11, 14, 8, 1025.00, 3, 0, '2024-05-15 08:12:57', '2024-05-15 08:12:57'),
(30, 48, 11, 14, 18, 1025.00, 1, 0, '2024-05-15 08:12:57', '2024-05-15 08:12:57'),
(31, 58, 9, 20, 8, 1025.00, 3, 0, '2024-05-15 08:16:38', '2024-05-15 08:16:38'),
(32, 38, 12, 5, 7, 1130.00, 1, 0, '2024-05-18 07:51:12', '2024-05-18 07:51:12'),
(33, 34, 13, 11, 6, 1080.00, 1, 0, '2024-05-19 08:16:52', '2024-05-19 08:16:52'),
(34, 34, 13, 11, 7, 1080.00, 1, 0, '2024-05-19 08:16:52', '2024-05-19 08:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `postcodes`
--

CREATE TABLE `postcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `upazila` varchar(255) NOT NULL,
  `zone_charge` decimal(10,0) DEFAULT 0,
  `postOffice` varchar(255) NOT NULL,
  `postCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postcodes`
--

INSERT INTO `postcodes` (`id`, `division_id`, `district_id`, `upazila`, `zone_charge`, `postOffice`, `postCode`, `created_at`, `updated_at`) VALUES
(1, 1, 34, 'Amtali', 130, 'Amtali', '8710', NULL, NULL),
(2, 1, 34, 'Bamna', 130, 'Bamna', '8730', NULL, NULL),
(3, 1, 34, 'Barguna Sadar', 130, 'Barguna Sadar', '8700', NULL, NULL),
(4, 1, 34, 'Barguna Sadar', 130, 'Nali Bandar', '8701', NULL, NULL),
(5, 1, 34, 'Betagi', 130, 'Betagi', '8740', NULL, NULL),
(6, 1, 34, 'Betagi', 130, 'Darul Ulam', '8741', NULL, NULL),
(7, 1, 34, 'Patharghata', 130, 'Kakchira', '8721', NULL, NULL),
(8, 1, 34, 'Patharghata', 130, 'Patharghata', '8720', NULL, NULL),
(9, 1, 35, 'Agailzhara', 130, 'Agailzhara', '8240', NULL, NULL),
(10, 1, 35, 'Agailzhara', 130, 'Gaila', '8241', NULL, NULL),
(11, 1, 35, 'Agailzhara', 130, 'Paisarhat', '8242', NULL, NULL),
(12, 1, 35, 'Babuganj', 130, 'Babuganj', '8210', NULL, NULL),
(13, 1, 35, 'Babuganj', 130, 'Barisal Cadet', '8216', NULL, NULL),
(14, 1, 35, 'Babuganj', 130, 'Chandpasha', '8212', NULL, NULL),
(15, 1, 35, 'Babuganj', 130, 'Madhabpasha', '8213', NULL, NULL),
(16, 1, 35, 'Babuganj', 130, 'Nizamuddin College', '8215', NULL, NULL),
(17, 1, 35, 'Babuganj', 130, 'Rahamatpur', '8211', NULL, NULL),
(18, 1, 35, 'Babuganj', 130, 'Thakur Mallik', '8214', NULL, NULL),
(19, 1, 35, 'Barajalia', 130, 'Barajalia', '8260', NULL, NULL),
(20, 1, 35, 'Barajalia', 130, 'Osman Manjil', '8261', NULL, NULL),
(21, 1, 35, 'Barisal Sadar', 130, 'Barisal Sadar', '8200', NULL, NULL),
(22, 1, 35, 'Barisal Sadar', 130, 'Bukhainagar', '8201', NULL, NULL),
(23, 1, 35, 'Barisal Sadar', 130, 'Jaguarhat', '8206', NULL, NULL),
(24, 1, 35, 'Barisal Sadar', 130, 'Kashipur', '8205', NULL, NULL),
(25, 1, 35, 'Barisal Sadar', 130, 'Patang', '8204', NULL, NULL),
(26, 1, 35, 'Barisal Sadar', 130, 'Saheberhat', '8202', NULL, NULL),
(27, 1, 35, 'Barisal Sadar', 130, 'Sugandia', '8203', NULL, NULL),
(28, 1, 35, 'Gouranadi', 130, 'Batajor', '8233', NULL, NULL),
(29, 1, 35, 'Gouranadi', 130, 'Gouranadi', '8230', NULL, NULL),
(30, 1, 35, 'Gouranadi', 130, 'Kashemabad', '8232', NULL, NULL),
(31, 1, 35, 'Gouranadi', 130, 'Tarki Bandar', '8231', NULL, NULL),
(32, 1, 35, 'Mahendiganj', 130, 'Langutia', '8274', NULL, NULL),
(33, 1, 35, 'Mahendiganj', 130, 'Laskarpur', '8271', NULL, NULL),
(34, 1, 35, 'Mahendiganj', 130, 'Mahendiganj', '8270', NULL, NULL),
(35, 1, 35, 'Mahendiganj', 130, 'Nalgora', '8273', NULL, NULL),
(36, 1, 35, 'Mahendiganj', 130, 'Ulania', '8272', NULL, NULL),
(37, 1, 35, 'Muladi', 130, 'Charkalekhan', '8252', NULL, NULL),
(38, 1, 35, 'Muladi', 130, 'Kazirchar', '8251', NULL, NULL),
(39, 1, 35, 'Muladi', 130, 'Muladi', '8250', NULL, NULL),
(40, 1, 35, 'Sahebganj', 130, 'Charamandi', '8281', NULL, NULL),
(41, 1, 35, 'Sahebganj', 130, 'kalaskati', '8284', NULL, NULL),
(42, 1, 35, 'Sahebganj', 130, 'Padri Shibpur', '8282', NULL, NULL),
(43, 1, 35, 'Sahebganj', 130, 'Sahebganj', '8280', NULL, NULL),
(44, 1, 35, 'Sahebganj', 130, 'Shialguni', '8283', NULL, NULL),
(45, 1, 35, 'Uzirpur', 130, 'Dakuarhat', '8223', NULL, NULL),
(46, 1, 35, 'Uzirpur', 130, 'Dhamura', '8221', NULL, NULL),
(47, 1, 35, 'Uzirpur', 130, 'Jugirkanda', '8222', NULL, NULL),
(48, 1, 35, 'Uzirpur', 130, 'Shikarpur', '8224', NULL, NULL),
(49, 1, 35, 'Uzirpur', 130, 'Uzirpur', '8220', NULL, NULL),
(50, 1, 36, 'Bhola Sadar', 130, 'Bhola Sadar', '8300', NULL, NULL),
(51, 1, 36, 'Bhola Sadar', 130, 'Joynagar', '8301', NULL, NULL),
(52, 1, 36, 'Borhanuddin UPO', 130, 'Borhanuddin UPO', '8320', NULL, NULL),
(53, 1, 36, 'Borhanuddin UPO', 130, 'Mirzakalu', '8321', NULL, NULL),
(54, 1, 36, 'Charfashion', 130, 'Charfashion', '8340', NULL, NULL),
(55, 1, 36, 'Charfashion', 130, 'Dularhat', '8341', NULL, NULL),
(56, 1, 36, 'Charfashion', 130, 'Keramatganj', '8342', NULL, NULL),
(57, 1, 36, 'Doulatkhan', 130, 'Doulatkhan', '8310', NULL, NULL),
(58, 1, 36, 'Doulatkhan', 130, 'Hajipur', '8311', NULL, NULL),
(59, 1, 36, 'Hajirhat', 130, 'Hajirhat', '8360', NULL, NULL),
(60, 1, 36, 'Hatshoshiganj', 130, 'Hatshoshiganj', '8350', NULL, NULL),
(61, 1, 36, 'Lalmohan UPO', 130, 'Daurihat', '8331', NULL, NULL),
(62, 1, 36, 'Lalmohan UPO', 130, 'Gazaria', '8332', NULL, NULL),
(63, 1, 36, 'Lalmohan UPO', 130, 'Lalmohan UPO', '8330', NULL, NULL),
(64, 1, 37, 'Jhalokathi Sadar', 130, 'Baukathi', '8402', NULL, NULL),
(65, 1, 37, 'Jhalokathi Sadar', 130, 'Gabha', '8403', NULL, NULL),
(66, 1, 37, 'Jhalokathi Sadar', 130, 'Jhalokathi Sadar', '8400', NULL, NULL),
(67, 1, 37, 'Jhalokathi Sadar', 130, 'Nabagram', '8401', NULL, NULL),
(68, 1, 37, 'Jhalokathi Sadar', 130, 'Shekherhat', '8404', NULL, NULL),
(69, 1, 37, 'Kathalia', 130, 'Amua', '8431', NULL, NULL),
(70, 1, 37, 'Kathalia', 130, 'Kathalia', '8430', NULL, NULL),
(71, 1, 37, 'Kathalia', 130, 'Niamatee', '8432', NULL, NULL),
(72, 1, 37, 'Kathalia', 130, 'Shoulajalia', '8433', NULL, NULL),
(73, 1, 37, 'Nalchhiti', 130, 'Beerkathi', '8421', NULL, NULL),
(74, 1, 37, 'Nalchhiti', 130, 'Nalchhiti', '8420', NULL, NULL),
(75, 1, 37, 'Rajapur', 130, 'Rajapur', '8410', NULL, NULL),
(76, 1, 38, 'Bauphal', 130, 'Bagabandar', '8621', NULL, NULL),
(77, 1, 38, 'Bauphal', 130, 'Bauphal', '8620', NULL, NULL),
(78, 1, 38, 'Bauphal', 130, 'Birpasha', '8622', NULL, NULL),
(79, 1, 38, 'Bauphal', 130, 'Kalaia', '8624', NULL, NULL),
(80, 1, 38, 'Bauphal', 130, 'Kalishari', '8623', NULL, NULL),
(81, 1, 38, 'Dashmina', 130, 'Dashmina', '8630', NULL, NULL),
(82, 1, 38, 'Galachipa', 130, 'Galachipa', '8640', NULL, NULL),
(83, 1, 38, 'Galachipa', 130, 'Gazipur Bandar', '8641', NULL, NULL),
(84, 1, 38, 'Khepupara', 130, 'Khepupara', '8650', NULL, NULL),
(85, 1, 38, 'Khepupara', 130, 'Mahipur', '8651', NULL, NULL),
(86, 1, 38, 'Patuakhali Sadar', 130, 'Dumkee', '8602', NULL, NULL),
(87, 1, 38, 'Patuakhali Sadar', 130, 'Moukaran', '8601', NULL, NULL),
(88, 1, 38, 'Patuakhali Sadar', 130, 'Patuakhali Sadar', '8600', NULL, NULL),
(89, 1, 38, 'Patuakhali Sadar', 130, 'Rahimabad', '8603', NULL, NULL),
(90, 1, 38, 'Subidkhali', 130, 'Subidkhali', '8610', NULL, NULL),
(91, 1, 39, 'Banaripara', 130, 'Banaripara', '8530', NULL, NULL),
(92, 1, 39, 'Banaripara', 130, 'Chakhar', '8531', NULL, NULL),
(93, 1, 39, 'Bhandaria', 130, 'Bhandaria', '8550', NULL, NULL),
(94, 1, 39, 'Bhandaria', 130, 'Dhaoa', '8552', NULL, NULL),
(95, 1, 39, 'Bhandaria', 130, 'Kanudashkathi', '8551', NULL, NULL),
(96, 1, 39, 'kaukhali', 130, 'Jolagati', '8513', NULL, NULL),
(97, 1, 39, 'kaukhali', 130, 'Joykul', '8512', NULL, NULL),
(98, 1, 39, 'kaukhali', 130, 'Kaukhali', '8510', NULL, NULL),
(99, 1, 39, 'kaukhali', 130, 'Keundia', '8511', NULL, NULL),
(100, 1, 39, 'Mathbaria', 130, 'Betmor Natun Hat', '8565', NULL, NULL),
(101, 1, 39, 'Mathbaria', 130, 'Gulishakhali', '8563', NULL, NULL),
(102, 1, 39, 'Mathbaria', 130, 'Halta', '8562', NULL, NULL),
(103, 1, 39, 'Mathbaria', 130, 'Mathbaria', '8560', NULL, NULL),
(104, 1, 39, 'Mathbaria', 130, 'Shilarganj', '8566', NULL, NULL),
(105, 1, 39, 'Mathbaria', 130, 'Tiarkhali', '8564', NULL, NULL),
(106, 1, 39, 'Mathbaria', 130, 'Tushkhali', '8561', NULL, NULL),
(107, 1, 39, 'Nazirpur', 130, 'Nazirpur', '8540', NULL, NULL),
(108, 1, 39, 'Nazirpur', 130, 'Sriramkathi', '8541', NULL, NULL),
(109, 1, 39, 'Pirojpur Sadar', 130, 'Hularhat', '8501', NULL, NULL),
(110, 1, 39, 'Pirojpur Sadar', 130, 'Parerhat', '8502', NULL, NULL),
(111, 1, 39, 'Pirojpur Sadar', 130, 'Pirojpur Sadar', '8500', NULL, NULL),
(112, 1, 39, 'Swarupkathi', 130, 'Darus Sunnat', '8521', NULL, NULL),
(113, 1, 39, 'Swarupkathi', 130, 'Jalabari', '8523', NULL, NULL),
(114, 1, 39, 'Swarupkathi', 130, 'Kaurikhara', '8522', NULL, NULL),
(115, 1, 39, 'Swarupkathi', 130, 'Swarupkathi', '8520', NULL, NULL),
(116, 2, 40, 'Alikadam', 130, 'Alikadam', '4650', NULL, NULL),
(117, 2, 40, 'Bandarban Sadar', 130, 'Bandarban Sadar', '4600', NULL, NULL),
(118, 2, 40, 'Naikhong', 130, 'Naikhong', '4660', NULL, NULL),
(119, 2, 40, 'Roanchhari', 130, 'Roanchhari', '4610', NULL, NULL),
(120, 2, 40, 'Ruma', 130, 'Ruma', '4620', NULL, NULL),
(121, 2, 40, 'Thanchi', 130, 'Lama', '4641', NULL, NULL),
(122, 2, 40, 'Thanchi', 130, 'Thanchi', '4630', NULL, NULL),
(123, 2, 41, 'Akhaura', 130, 'Akhaura', '3450', NULL, NULL),
(124, 2, 41, 'Akhaura', 130, 'Azampur', '3451', NULL, NULL),
(125, 2, 41, 'Akhaura', 130, 'Gangasagar', '3452', NULL, NULL),
(126, 2, 41, 'Banchharampur', 130, 'Banchharampur', '3420', NULL, NULL),
(127, 2, 41, 'Brahamanbaria Sadar', 130, 'Ashuganj', '3402', NULL, NULL),
(128, 2, 41, 'Brahamanbaria Sadar', 130, 'Ashuganj Share', '3403', NULL, NULL),
(129, 2, 41, 'Brahamanbaria Sadar', 130, 'Brahamanbaria Sadar', '3400', NULL, NULL),
(130, 2, 41, 'Brahamanbaria Sadar', 130, 'Poun', '3404', NULL, NULL),
(131, 2, 41, 'Brahamanbaria Sadar', 130, 'Talshahar', '3401', NULL, NULL),
(132, 2, 41, 'Kasba', 130, 'Chandidar', '3462', NULL, NULL),
(133, 2, 41, 'Kasba', 130, 'Chargachh', '3463', NULL, NULL),
(134, 2, 41, 'Kasba', 130, 'Gopinathpur', '3464', NULL, NULL),
(135, 2, 41, 'Kasba', 130, 'Kasba', '3460', NULL, NULL),
(136, 2, 41, 'Kasba', 130, 'Kuti', '3461', NULL, NULL),
(137, 2, 41, 'Nabinagar', 130, 'Jibanganj', '3419', NULL, NULL),
(138, 2, 41, 'Nabinagar', 130, 'Kaitala', '3417', NULL, NULL),
(139, 2, 41, 'Nabinagar', 130, 'Laubfatehpur', '3411', NULL, NULL),
(140, 2, 41, 'Nabinagar', 130, 'Nabinagar', '3410', NULL, NULL),
(141, 2, 41, 'Nabinagar', 130, 'Rasullabad', '3412', NULL, NULL),
(142, 2, 41, 'Nabinagar', 130, 'Ratanpur', '3414', NULL, NULL),
(143, 2, 41, 'Nabinagar', 130, 'Salimganj', '3418', NULL, NULL),
(144, 2, 41, 'Nabinagar', 130, 'Shahapur', '3415', NULL, NULL),
(145, 2, 41, 'Nabinagar', 130, 'Shamgram', '3413', NULL, NULL),
(146, 2, 41, 'Nasirnagar', 130, 'Fandauk', '3441', NULL, NULL),
(147, 2, 41, 'Nasirnagar', 130, 'Nasirnagar', '3440', NULL, NULL),
(148, 2, 41, 'Sarail', 130, 'Chandura', '3432', NULL, NULL),
(149, 2, 41, 'Sarail', 130, 'Sarial', '3430', NULL, NULL),
(150, 2, 41, 'Sarail', 130, 'Shahbajpur', '3431', NULL, NULL),
(151, 2, 42, 'Chandpur Sadar', 130, 'Baburhat', '3602', NULL, NULL),
(152, 2, 42, 'Chandpur Sadar', 130, 'Chandpur Sadar', '3600', NULL, NULL),
(153, 2, 42, 'Chandpur Sadar', 130, 'Puranbazar', '3601', NULL, NULL),
(154, 2, 42, 'Chandpur Sadar', 130, 'Sahatali', '3603', NULL, NULL),
(155, 2, 42, 'Faridganj', 130, 'Chandra', '3651', NULL, NULL),
(156, 2, 42, 'Faridganj', 130, 'Faridganj', '3650', NULL, NULL),
(157, 2, 42, 'Faridganj', 130, 'Gridkaliandia', '3653', NULL, NULL),
(158, 2, 42, 'Faridganj', 130, 'Islampur Shah Isain', '3655', NULL, NULL),
(159, 2, 42, 'Faridganj', 130, 'Rampurbazar', '3654', NULL, NULL),
(160, 2, 42, 'Faridganj', 130, 'Rupsha', '3652', NULL, NULL),
(161, 2, 42, 'Hajiganj', 130, 'Bolakhal', '3611', NULL, NULL),
(162, 2, 42, 'Hajiganj', 130, 'Hajiganj', '3610', NULL, NULL),
(163, 2, 42, 'Hayemchar', 130, 'Gandamara', '3661', NULL, NULL),
(164, 2, 42, 'Hayemchar', 130, 'Hayemchar', '3660', NULL, NULL),
(165, 2, 42, 'Kachua', 130, 'Kachua', '3630', NULL, NULL),
(166, 2, 42, 'Kachua', 130, 'Pak Shrirampur', '3631', NULL, NULL),
(167, 2, 42, 'Kachua', 130, 'Rahima Nagar', '3632', NULL, NULL),
(168, 2, 42, 'Kachua', 130, 'Shachar', '3633', NULL, NULL),
(169, 2, 42, 'Matlobganj', 130, 'Kalipur', '3642', NULL, NULL),
(170, 2, 42, 'Matlobganj', 130, 'Matlobganj', '3640', NULL, NULL),
(171, 2, 42, 'Matlobganj', 130, 'Mohanpur', '3641', NULL, NULL),
(172, 2, 42, 'Shahrasti', 130, 'Chotoshi', '3623', NULL, NULL),
(173, 2, 42, 'Shahrasti', 130, 'Islamia Madrasha', '3624', NULL, NULL),
(174, 2, 42, 'Shahrasti', 130, 'Khilabazar', '3621', NULL, NULL),
(175, 2, 42, 'Shahrasti', 130, 'Pashchim Kherihar Al', '3622', NULL, NULL),
(176, 2, 42, 'Shahrasti', 130, 'Shahrasti', '3620', NULL, NULL),
(177, 2, 43, 'Anawara', 130, 'Anowara', '4376', NULL, NULL),
(178, 2, 43, 'Anawara', 130, 'Battali', '4378', NULL, NULL),
(179, 2, 43, 'Anawara', 130, 'Paroikora', '4377', NULL, NULL),
(180, 2, 43, 'Boalkhali', 130, 'Boalkhali', '4366', NULL, NULL),
(181, 2, 43, 'Boalkhali', 130, 'Charandwip', '4369', NULL, NULL),
(182, 2, 43, 'Boalkhali', 130, 'Iqbal Park', '4365', NULL, NULL),
(183, 2, 43, 'Boalkhali', 130, 'Kadurkhal', '4368', NULL, NULL),
(184, 2, 43, 'Boalkhali', 130, 'Kanungopara', '4363', NULL, NULL),
(185, 2, 43, 'Boalkhali', 130, 'Sakpura', '4367', NULL, NULL),
(186, 2, 43, 'Boalkhali', 130, 'Saroatoli', '4364', NULL, NULL),
(187, 2, 43, 'Chittagong Sadar', 130, 'Al- Amin Baria Madra', '4221', NULL, NULL),
(188, 2, 43, 'Chittagong Sadar', 130, 'Amin Jute Mills', '4211', NULL, NULL),
(189, 2, 43, 'Chittagong Sadar', 130, 'Anandabazar', '4215', NULL, NULL),
(190, 2, 43, 'Chittagong Sadar', 130, 'Bayezid Bostami', '4210', NULL, NULL),
(191, 2, 43, 'Chittagong Sadar', 130, 'Chandgaon', '4212', NULL, NULL),
(192, 2, 43, 'Chittagong Sadar', 130, 'Chawkbazar', '4203', NULL, NULL),
(193, 2, 43, 'Chittagong Sadar', 130, 'Chitt. Cantonment', '4220', NULL, NULL),
(194, 2, 43, 'Chittagong Sadar', 130, 'Chitt. Customs Acca', '4219', NULL, NULL),
(195, 2, 43, 'Chittagong Sadar', 130, 'Chitt. Politechnic In', '4209', NULL, NULL),
(196, 2, 43, 'Chittagong Sadar', 130, 'Chitt. Sailers Colon', '4218', NULL, NULL),
(197, 2, 43, 'Chittagong Sadar', 130, 'Chittagong Airport', '4205', NULL, NULL),
(198, 2, 43, 'Chittagong Sadar', 130, 'Chittagong Bandar', '4100', NULL, NULL),
(199, 2, 43, 'Chittagong Sadar', 130, 'Chittagong GPO', '4000', NULL, NULL),
(200, 2, 43, 'Chittagong Sadar', 130, 'Export Processing', '4223', NULL, NULL),
(201, 2, 43, 'Chittagong Sadar', 130, 'Firozshah', '4207', NULL, NULL),
(202, 2, 43, 'Chittagong Sadar', 130, 'Halishahar', '4216', NULL, NULL),
(203, 2, 43, 'Chittagong Sadar', 130, 'Halishshar', '4225', NULL, NULL),
(204, 2, 43, 'Chittagong Sadar', 130, 'Jalalabad', '4214', NULL, NULL),
(205, 2, 43, 'Chittagong Sadar', 130, 'Jaldia Merine Accade', '4206', NULL, NULL),
(206, 2, 43, 'Chittagong Sadar', 130, 'Middle Patenga', '4222', NULL, NULL),
(207, 2, 43, 'Chittagong Sadar', 130, 'Mohard', '4208', NULL, NULL),
(208, 2, 43, 'Chittagong Sadar', 130, 'North Halishahar', '4226', NULL, NULL),
(209, 2, 43, 'Chittagong Sadar', 130, 'North Katuli', '4217', NULL, NULL),
(210, 2, 43, 'Chittagong Sadar', 130, 'Pahartoli', '4202', NULL, NULL),
(211, 2, 43, 'Chittagong Sadar', 130, 'Patenga', '4204', NULL, NULL),
(212, 2, 43, 'Chittagong Sadar', 130, 'Rampura TSO', '4224', NULL, NULL),
(213, 2, 43, 'Chittagong Sadar', 130, 'Wazedia', '4213', NULL, NULL),
(214, 2, 43, 'East Joara', 130, 'Barma', '4383', NULL, NULL),
(215, 2, 43, 'East Joara', 130, 'Dohazari', '4382', NULL, NULL),
(216, 2, 43, 'East Joara', 130, 'East Joara', '4380', NULL, NULL),
(217, 2, 43, 'East Joara', 130, 'Gachbaria', '4381', NULL, NULL),
(218, 2, 43, 'Fatikchhari', 130, 'Bhandar Sharif', '4352', NULL, NULL),
(219, 2, 43, 'Fatikchhari', 130, 'Fatikchhari', '4350', NULL, NULL),
(220, 2, 43, 'Fatikchhari', 130, 'Harualchhari', '4354', NULL, NULL),
(221, 2, 43, 'Fatikchhari', 130, 'Najirhat', '4353', NULL, NULL),
(222, 2, 43, 'Fatikchhari', 130, 'Nanupur', '4351', NULL, NULL),
(223, 2, 43, 'Fatikchhari', 130, 'Narayanhat', '4355', NULL, NULL),
(224, 2, 43, 'Hathazari', 130, 'Chitt.University', '4331', NULL, NULL),
(225, 2, 43, 'Hathazari', 130, 'Fatahabad', '4335', NULL, NULL),
(226, 2, 43, 'Hathazari', 130, 'Gorduara', '4332', NULL, NULL),
(227, 2, 43, 'Hathazari', 130, 'Hathazari', '4330', NULL, NULL),
(228, 2, 43, 'Hathazari', 130, 'Katirhat', '4333', NULL, NULL),
(229, 2, 43, 'Hathazari', 130, 'Madrasa', '4339', NULL, NULL),
(230, 2, 43, 'Hathazari', 130, 'Mirzapur', '4334', NULL, NULL),
(231, 2, 43, 'Hathazari', 130, 'Nuralibari', '4337', NULL, NULL),
(232, 2, 43, 'Hathazari', 130, 'Yunus Nagar', '4338', NULL, NULL),
(233, 2, 43, 'Jaldi', 130, 'Banigram', '4393', NULL, NULL),
(234, 2, 43, 'Jaldi', 130, 'Gunagari', '4392', NULL, NULL),
(235, 2, 43, 'Jaldi', 130, 'Jaldi', '4390', NULL, NULL),
(236, 2, 43, 'Jaldi', 130, 'Khan Bahadur', '4391', NULL, NULL),
(237, 2, 43, 'Lohagara', 130, 'Chunti', '4398', NULL, NULL),
(238, 2, 43, 'Lohagara', 130, 'Lohagara', '4396', NULL, NULL),
(239, 2, 43, 'Lohagara', 130, 'Padua', '4397', NULL, NULL),
(240, 2, 43, 'Mirsharai', 130, 'Abutorab', '4321', NULL, NULL),
(241, 2, 43, 'Mirsharai', 130, 'Azampur', '4325', NULL, NULL),
(242, 2, 43, 'Mirsharai', 130, 'Bharawazhat', '4323', NULL, NULL),
(243, 2, 43, 'Mirsharai', 130, 'Darrogahat', '4322', NULL, NULL),
(244, 2, 43, 'Mirsharai', 130, 'Joarganj', '4324', NULL, NULL),
(245, 2, 43, 'Mirsharai', 130, 'Korerhat', '4327', NULL, NULL),
(246, 2, 43, 'Mirsharai', 130, 'Mirsharai', '4320', NULL, NULL),
(247, 2, 43, 'Mirsharai', 130, 'Mohazanhat', '4328', NULL, NULL),
(248, 2, 43, 'Patiya', 130, 'Budhpara', '4371', NULL, NULL),
(249, 2, 43, 'Patiya', 130, 'Patiya Head Office', '4370', NULL, NULL),
(250, 2, 43, 'Rangunia', 130, 'Dhamair', '4361', NULL, NULL),
(251, 2, 43, 'Rangunia', 130, 'Rangunia', '4360', NULL, NULL),
(252, 2, 43, 'Rouzan', 130, 'B.I.T Post Office', '4349', NULL, NULL),
(253, 2, 43, 'Rouzan', 130, 'Beenajuri', '4341', NULL, NULL),
(254, 2, 43, 'Rouzan', 130, 'Dewanpur', '4347', NULL, NULL),
(255, 2, 43, 'Rouzan', 130, 'Fatepur', '4345', NULL, NULL),
(256, 2, 43, 'Rouzan', 130, 'Gahira', '4343', NULL, NULL),
(257, 2, 43, 'Rouzan', 130, 'Guzra Noapara', '4346', NULL, NULL),
(258, 2, 43, 'Rouzan', 130, 'jagannath Hat', '4344', NULL, NULL),
(259, 2, 43, 'Rouzan', 130, 'Kundeshwari', '4342', NULL, NULL),
(260, 2, 43, 'Rouzan', 130, 'Mohamuni', '4348', NULL, NULL),
(261, 2, 43, 'Rouzan', 130, 'Rouzan', '4340', NULL, NULL),
(262, 2, 43, 'Sandwip', 130, 'Sandwip', '4300', NULL, NULL),
(263, 2, 43, 'Sandwip', 130, 'Shiberhat', '4301', NULL, NULL),
(264, 2, 43, 'Sandwip', 130, 'Urirchar', '4302', NULL, NULL),
(265, 2, 43, 'Satkania', 130, 'Baitul Ijjat', '4387', NULL, NULL),
(266, 2, 43, 'Satkania', 130, 'Bazalia', '4388', NULL, NULL),
(267, 2, 43, 'Satkania', 130, 'Satkania', '4386', NULL, NULL),
(268, 2, 43, 'Sitakunda', 130, 'Barabkunda', '4312', NULL, NULL),
(269, 2, 43, 'Sitakunda', 130, 'Baroidhala', '4311', NULL, NULL),
(270, 2, 43, 'Sitakunda', 130, 'Bawashbaria', '4313', NULL, NULL),
(271, 2, 43, 'Sitakunda', 130, 'Bhatiari', '4315', NULL, NULL),
(272, 2, 43, 'Sitakunda', 130, 'Fouzdarhat', '4316', NULL, NULL),
(273, 2, 43, 'Sitakunda', 130, 'Jafrabad', '4317', NULL, NULL),
(274, 2, 43, 'Sitakunda', 130, 'Kumira', '4314', NULL, NULL),
(275, 2, 43, 'Sitakunda', 130, 'Sitakunda', '4310', NULL, NULL),
(276, 2, 44, 'Barura', 130, 'Barura', '3560', NULL, NULL),
(277, 2, 44, 'Barura', 130, 'Murdafarganj', '3562', NULL, NULL),
(278, 2, 44, 'Barura', 130, 'Poyalgachha', '3561', NULL, NULL),
(279, 2, 44, 'Brahmanpara', 130, 'Brahmanpara', '3526', NULL, NULL),
(280, 2, 44, 'Burichang', 130, 'Burichang', '3520', NULL, NULL),
(281, 2, 44, 'Burichang', 130, 'Maynamoti bazar', '3521', NULL, NULL),
(282, 2, 44, 'Chandina', 130, 'Chandia', '3510', NULL, NULL),
(283, 2, 44, 'Chandina', 130, 'Madhaiabazar', '3511', NULL, NULL),
(284, 2, 44, 'Chouddagram', 130, 'Batisa', '3551', NULL, NULL),
(285, 2, 44, 'Chouddagram', 130, 'Chiora', '3552', NULL, NULL),
(286, 2, 44, 'Chouddagram', 130, 'Chouddagram', '3550', NULL, NULL),
(287, 2, 44, 'Comilla Sadar', 130, 'Comilla Contoment', '3501', NULL, NULL),
(288, 2, 44, 'Comilla Sadar', 130, 'Comilla Sadar', '3500', NULL, NULL),
(289, 2, 44, 'Comilla Sadar', 130, 'Courtbari', '3503', NULL, NULL),
(290, 2, 44, 'Comilla Sadar', 130, 'Halimanagar', '3502', NULL, NULL),
(291, 2, 44, 'Comilla Sadar', 130, 'Suaganj', '3504', NULL, NULL),
(292, 2, 44, 'Daudkandi', 130, 'Dashpara', '3518', NULL, NULL),
(293, 2, 44, 'Daudkandi', 130, 'Daudkandi', '3516', NULL, NULL),
(294, 2, 44, 'Daudkandi', 130, 'Eliotganj', '3519', NULL, NULL),
(295, 2, 44, 'Daudkandi', 130, 'Gouripur', '3517', NULL, NULL),
(296, 2, 44, 'Davidhar', 130, 'Barashalghar', '3532', NULL, NULL),
(297, 2, 44, 'Davidhar', 130, 'Davidhar', '3530', NULL, NULL),
(298, 2, 44, 'Davidhar', 130, 'Dhamtee', '3533', NULL, NULL),
(299, 2, 44, 'Davidhar', 130, 'Gangamandal', '3531', NULL, NULL),
(300, 2, 44, 'Homna', 130, 'Homna', '3546', NULL, NULL),
(301, 2, 44, 'Laksam', 130, 'Bipulasar', '3572', NULL, NULL),
(302, 2, 44, 'Laksam', 130, 'Laksam', '3570', NULL, NULL),
(303, 2, 44, 'Laksam', 130, 'Lakshamanpur', '3571', NULL, NULL),
(304, 2, 44, 'Langalkot', 130, 'Chhariabazar', '3582', NULL, NULL),
(305, 2, 44, 'Langalkot', 130, 'Dhalua', '3581', NULL, NULL),
(306, 2, 44, 'Langalkot', 130, 'Gunabati', '3583', NULL, NULL),
(307, 2, 44, 'Langalkot', 130, 'Langalkot', '3580', NULL, NULL),
(308, 2, 44, 'Muradnagar', 130, 'Bangra', '3543', NULL, NULL),
(309, 2, 44, 'Muradnagar', 130, 'Companyganj', '3542', NULL, NULL),
(310, 2, 44, 'Muradnagar', 130, 'Muradnagar', '3540', NULL, NULL),
(311, 2, 44, 'Muradnagar', 130, 'Pantibazar', '3545', NULL, NULL),
(312, 2, 44, 'Muradnagar', 130, 'Ramchandarpur', '3541', NULL, NULL),
(313, 2, 44, 'Muradnagar', 130, 'Sonakanda', '3544', NULL, NULL),
(314, 2, 45, 'Chiringga', 130, 'Badarkali', '4742', NULL, NULL),
(315, 2, 45, 'Chiringga', 130, 'Chiringga', '4740', NULL, NULL),
(316, 2, 45, 'Chiringga', 130, 'Chiringga S.O', '4741', NULL, NULL),
(317, 2, 45, 'Chiringga', 130, 'Malumghat', '4743', NULL, NULL),
(318, 2, 45, 'Coxs Bazar Sadar', 130, 'Coxs Bazar Sadar', '4700', NULL, NULL),
(319, 2, 45, 'Coxs Bazar Sadar', 130, 'Eidga', '4702', NULL, NULL),
(320, 2, 45, 'Coxs Bazar Sadar', 130, 'Zhilanja', '4701', NULL, NULL),
(321, 2, 45, 'Gorakghat', 130, 'Gorakghat', '4710', NULL, NULL),
(322, 2, 45, 'Kutubdia', 130, 'Kutubdia', '4720', NULL, NULL),
(323, 2, 45, 'Ramu', 130, 'Ramu', '4730', NULL, NULL),
(324, 2, 45, 'Teknaf', 130, 'Hnila', '4761', NULL, NULL),
(325, 2, 45, 'Teknaf', 130, 'St.Martin', '4762', NULL, NULL),
(326, 2, 45, 'Teknaf', 130, 'Teknaf', '4760', NULL, NULL),
(327, 2, 45, 'Ukhia', 130, 'Ukhia', '4750', NULL, NULL),
(328, 2, 46, 'Chhagalnaia', 130, 'Chhagalnaia', '3910', NULL, NULL),
(329, 2, 46, 'Chhagalnaia', 130, 'Daraga Hat', '3912', NULL, NULL),
(330, 2, 46, 'Chhagalnaia', 130, 'Maharajganj', '3911', NULL, NULL),
(331, 2, 46, 'Chhagalnaia', 130, 'Puabashimulia', '3913', NULL, NULL),
(332, 2, 46, 'Dagonbhuia', 130, 'Chhilonia', '3922', NULL, NULL),
(333, 2, 46, 'Dagonbhuia', 130, 'Dagondhuia', '3920', NULL, NULL),
(334, 2, 46, 'Dagonbhuia', 130, 'Dudmukha', '3921', NULL, NULL),
(335, 2, 46, 'Dagonbhuia', 130, 'Rajapur', '3923', NULL, NULL),
(336, 2, 46, 'Feni Sadar', 130, 'Fazilpur', '3901', NULL, NULL),
(337, 2, 46, 'Feni Sadar', 130, 'Feni Sadar', '3900', NULL, NULL),
(338, 2, 46, 'Feni Sadar', 130, 'Laskarhat', '3903', NULL, NULL),
(339, 2, 46, 'Feni Sadar', 130, 'Sharshadie', '3902', NULL, NULL),
(340, 2, 46, 'Pashurampur', 130, 'Fulgazi', '3942', NULL, NULL),
(341, 2, 46, 'Pashurampur', 130, 'Munshirhat', '3943', NULL, NULL),
(342, 2, 46, 'Pashurampur', 130, 'Pashurampur', '3940', NULL, NULL),
(343, 2, 46, 'Pashurampur', 130, 'Shuarbazar', '3941', NULL, NULL),
(344, 2, 46, 'Sonagazi', 130, 'Ahmadpur', '3932', NULL, NULL),
(345, 2, 46, 'Sonagazi', 130, 'Kazirhat', '3933', NULL, NULL),
(346, 2, 46, 'Sonagazi', 130, 'Motiganj', '3931', NULL, NULL),
(347, 2, 46, 'Sonagazi', 130, 'Sonagazi', '3930', NULL, NULL),
(348, 2, 47, 'Diginala', 130, 'Diginala', '4420', NULL, NULL),
(349, 2, 47, 'Khagrachari Sadar', 130, 'Khagrachari Sadar', '4400', NULL, NULL),
(350, 2, 47, 'Laxmichhari', 130, 'Laxmichhari', '4470', NULL, NULL),
(351, 2, 47, 'Mahalchhari', 130, 'Mahalchhari', '4430', NULL, NULL),
(352, 2, 47, 'Manikchhari', 130, 'Manikchhari', '4460', NULL, NULL),
(353, 2, 47, 'Matiranga', 130, 'Matiranga', '4450', NULL, NULL),
(354, 2, 47, 'Panchhari', 130, 'Panchhari', '4410', NULL, NULL),
(355, 2, 47, 'Ramghar Head Office', 130, 'Ramghar Head Office', '4440', NULL, NULL),
(356, 2, 48, 'Char Alexgander', 130, 'Char Alexgander', '3730', NULL, NULL),
(357, 2, 48, 'Char Alexgander', 130, 'Hajirghat', '3731', NULL, NULL),
(358, 2, 48, 'Char Alexgander', 130, 'Ramgatirhat', '3732', NULL, NULL),
(359, 2, 48, 'Lakshimpur Sadar', 130, 'Amani Lakshimpur', '3709', NULL, NULL),
(360, 2, 48, 'Lakshimpur Sadar', 130, 'Bhabaniganj', '3702', NULL, NULL),
(361, 2, 48, 'Lakshimpur Sadar', 130, 'Chandraganj', '3708', NULL, NULL),
(362, 2, 48, 'Lakshimpur Sadar', 130, 'Choupalli', '3707', NULL, NULL),
(363, 2, 48, 'Lakshimpur Sadar', 130, 'Dalal Bazar', '3701', NULL, NULL),
(364, 2, 48, 'Lakshimpur Sadar', 130, 'Duttapara', '3706', NULL, NULL),
(365, 2, 48, 'Lakshimpur Sadar', 130, 'Keramatganj', '3704', NULL, NULL),
(366, 2, 48, 'Lakshimpur Sadar', 130, 'Lakshimpur Sadar', '3700', NULL, NULL),
(367, 2, 48, 'Lakshimpur Sadar', 130, 'Mandari', '3703', NULL, NULL),
(368, 2, 48, 'Lakshimpur Sadar', 130, 'Rupchara', '3705', NULL, NULL),
(369, 2, 48, 'Ramganj', 130, 'Alipur', '3721', NULL, NULL),
(370, 2, 48, 'Ramganj', 130, 'Dolta', '3725', NULL, NULL),
(371, 2, 48, 'Ramganj', 130, 'Kanchanpur', '3723', NULL, NULL),
(372, 2, 48, 'Ramganj', 130, 'Naagmud', '3724', NULL, NULL),
(373, 2, 48, 'Ramganj', 130, 'Panpara', '3722', NULL, NULL),
(374, 2, 48, 'Ramganj', 130, 'Ramganj', '3720', NULL, NULL),
(375, 2, 48, 'Raypur', 130, 'Bhuabari', '3714', NULL, NULL),
(376, 2, 48, 'Raypur', 130, 'Haydarganj', '3713', NULL, NULL),
(377, 2, 48, 'Raypur', 130, 'Nagerdighirpar', '3712', NULL, NULL),
(378, 2, 48, 'Raypur', 130, 'Rakhallia', '3711', NULL, NULL),
(379, 2, 48, 'Raypur', 130, 'Raypur', '3710', NULL, NULL),
(380, 2, 49, 'Basurhat', 130, 'Basur Hat', '3850', NULL, NULL),
(381, 2, 49, 'Basurhat', 130, 'Charhajari', '3851', NULL, NULL),
(382, 2, 49, 'Begumganj', 130, 'Alaiarpur', '3831', NULL, NULL),
(383, 2, 49, 'Begumganj', 130, 'Amisha Para', '3847', NULL, NULL),
(384, 2, 49, 'Begumganj', 130, 'Banglabazar', '3822', NULL, NULL),
(385, 2, 49, 'Begumganj', 130, 'Bazra', '3824', NULL, NULL),
(386, 2, 49, 'Begumganj', 130, 'Begumganj', '3820', NULL, NULL),
(387, 2, 49, 'Begumganj', 130, 'Bhabani Jibanpur', '3837', NULL, NULL),
(388, 2, 49, 'Begumganj', 130, 'Choumohani', '3821', NULL, NULL),
(389, 2, 49, 'Begumganj', 130, 'Dauti', '3843', NULL, NULL),
(390, 2, 49, 'Begumganj', 130, 'Durgapur', '3848', NULL, NULL),
(391, 2, 49, 'Begumganj', 130, 'Gopalpur', '3828', NULL, NULL),
(392, 2, 49, 'Begumganj', 130, 'Jamidar Hat', '3825', NULL, NULL),
(393, 2, 49, 'Begumganj', 130, 'Joyag', '3844', NULL, NULL),
(394, 2, 49, 'Begumganj', 130, 'Joynarayanpur', '3829', NULL, NULL),
(395, 2, 49, 'Begumganj', 130, 'Khalafat Bazar', '3833', NULL, NULL),
(396, 2, 49, 'Begumganj', 130, 'Khalishpur', '3842', NULL, NULL),
(397, 2, 49, 'Begumganj', 130, 'Maheshganj', '3838', NULL, NULL),
(398, 2, 49, 'Begumganj', 130, 'Mir Owarishpur', '3823', NULL, NULL),
(399, 2, 49, 'Begumganj', 130, 'Nadona', '3839', NULL, NULL),
(400, 2, 49, 'Begumganj', 130, 'Nandiapara', '3841', NULL, NULL),
(401, 2, 49, 'Begumganj', 130, 'Oachhekpur', '3835', NULL, NULL),
(402, 2, 49, 'Begumganj', 130, 'Rajganj', '3834', NULL, NULL),
(403, 2, 49, 'Begumganj', 130, 'Sonaimuri', '3827', NULL, NULL),
(404, 2, 49, 'Begumganj', 130, 'Tangirpar', '3832', NULL, NULL),
(405, 2, 49, 'Begumganj', 130, 'Thanar Hat', '3845', NULL, NULL),
(406, 2, 49, 'Chatkhil', 130, 'Bansa Bazar', '3879', NULL, NULL),
(407, 2, 49, 'Chatkhil', 130, 'Bodalcourt', '3873', NULL, NULL),
(408, 2, 49, 'Chatkhil', 130, 'Chatkhil', '3870', NULL, NULL),
(409, 2, 49, 'Chatkhil', 130, 'Dosh Gharia', '3878', NULL, NULL),
(410, 2, 49, 'Chatkhil', 130, 'Karihati', '3877', NULL, NULL),
(411, 2, 49, 'Chatkhil', 130, 'Khilpara', '3872', NULL, NULL),
(412, 2, 49, 'Chatkhil', 130, 'Palla', '3871', NULL, NULL),
(413, 2, 49, 'Chatkhil', 130, 'Rezzakpur', '3874', NULL, NULL),
(414, 2, 49, 'Chatkhil', 130, 'Sahapur', '3881', NULL, NULL),
(415, 2, 49, 'Chatkhil', 130, 'Sampara', '3882', NULL, NULL),
(416, 2, 49, 'Chatkhil', 130, 'Shingbahura', '3883', NULL, NULL),
(417, 2, 49, 'Chatkhil', 130, 'Solla', '3875', NULL, NULL),
(418, 2, 49, 'Hatiya', 130, 'Afazia', '3891', NULL, NULL),
(419, 2, 49, 'Hatiya', 130, 'Hatiya', '3890', NULL, NULL),
(420, 2, 49, 'Hatiya', 130, 'Tamoraddi', '3892', NULL, NULL),
(421, 2, 49, 'Noakhali Sadar', 130, 'Chaprashir Hat', '3811', NULL, NULL),
(422, 2, 49, 'Noakhali Sadar', 130, 'Char Jabbar', '3812', NULL, NULL),
(423, 2, 49, 'Noakhali Sadar', 130, 'Charam Tua', '3809', NULL, NULL),
(424, 2, 49, 'Noakhali Sadar', 130, 'Din Monir Hat', '3803', NULL, NULL),
(425, 2, 49, 'Noakhali Sadar', 130, 'Kabirhat', '3807', NULL, NULL),
(426, 2, 49, 'Noakhali Sadar', 130, 'Khalifar Hat', '3808', NULL, NULL),
(427, 2, 49, 'Noakhali Sadar', 130, 'Mriddarhat', '3806', NULL, NULL),
(428, 2, 49, 'Noakhali Sadar', 130, 'Noakhali College', '3801', NULL, NULL),
(429, 2, 49, 'Noakhali Sadar', 130, 'Noakhali Sadar', '3800', NULL, NULL),
(430, 2, 49, 'Noakhali Sadar', 130, 'Pak Kishoreganj', '3804', NULL, NULL),
(431, 2, 49, 'Noakhali Sadar', 130, 'Sonapur', '3802', NULL, NULL),
(432, 2, 49, 'Senbag', 130, 'Beezbag', '3862', NULL, NULL),
(433, 2, 49, 'Senbag', 130, 'Chatarpaia', '3864', NULL, NULL),
(434, 2, 49, 'Senbag', 130, 'Kallyandi', '3861', NULL, NULL),
(435, 2, 49, 'Senbag', 130, 'Kankirhat', '3863', NULL, NULL),
(436, 2, 49, 'Senbag', 130, 'Senbag', '3860', NULL, NULL),
(437, 2, 49, 'Senbag', 130, 'T.P. Lamua', '3865', NULL, NULL),
(438, 2, 50, 'Barakal', 130, 'Barakal', '4570', NULL, NULL),
(439, 2, 50, 'Bilaichhari', 130, 'Bilaichhari', '4550', NULL, NULL),
(440, 2, 50, 'Jarachhari', 130, 'Jarachhari', '4560', NULL, NULL),
(441, 2, 50, 'Kalampati', 130, 'Betbunia', '4511', NULL, NULL),
(442, 2, 50, 'Kalampati', 130, 'Kalampati', '4510', NULL, NULL),
(443, 2, 50, 'kaptai', 130, 'Chandraghona', '4531', NULL, NULL),
(444, 2, 50, 'kaptai', 130, 'Kaptai', '4530', NULL, NULL),
(445, 2, 50, 'kaptai', 130, 'Kaptai Nuton Bazar', '4533', NULL, NULL),
(446, 2, 50, 'kaptai', 130, 'Kaptai Project', '4532', NULL, NULL),
(447, 2, 50, 'Longachh', 130, 'Longachh', '4580', NULL, NULL),
(448, 2, 50, 'Marishya', 130, 'Marishya', '4590', NULL, NULL),
(449, 2, 50, 'Naniachhar', 130, 'Nanichhar', '4520', NULL, NULL),
(450, 2, 50, 'Rajsthali', 130, 'Rajsthali', '4540', NULL, NULL),
(451, 2, 50, 'Rangamati Sadar', 130, 'Rangamati Sadar', '4500', NULL, NULL),
(452, 3, 1, 'Demra', 80, 'Demra', '1360', NULL, '2024-01-29 05:15:04'),
(453, 3, 1, 'Demra', 80, 'Matuail', '1362', NULL, '2024-01-29 05:15:04'),
(454, 3, 1, 'Demra', 80, 'Sarulia', '1361', NULL, '2024-01-29 05:15:04'),
(455, 3, 1, 'Dhaka Cantt.', 80, 'Dhaka CantonmentTSO', '1206', NULL, '2024-02-20 05:20:09'),
(456, 3, 1, 'Dhamrai', 80, 'Dhamrai', '1350', NULL, NULL),
(457, 3, 1, 'Dhamrai', 80, 'Kamalpur', '1351', NULL, NULL),
(458, 3, 1, 'Dhanmondi', 80, 'Jigatala TSO', '1209', NULL, NULL),
(459, 3, 1, 'Gulshan', 80, 'Banani TSO', '1213', NULL, NULL),
(460, 3, 1, 'Gulshan', 80, 'Gulshan Model Town', '1212', NULL, NULL),
(461, 3, 1, 'Jatrabari', 80, 'Dhania TSO', '1232', NULL, NULL),
(462, 3, 1, 'Joypara', 80, 'Joypara', '1330', NULL, NULL),
(463, 3, 1, 'Joypara', 80, 'Narisha', '1332', NULL, NULL),
(464, 3, 1, 'Joypara', 80, 'Palamganj', '1331', NULL, NULL),
(465, 3, 1, 'Keraniganj', 80, 'Ati', '1312', NULL, NULL),
(466, 3, 1, 'Keraniganj', 80, 'Dhaka Jute Mills', '1311', NULL, NULL),
(467, 3, 1, 'Keraniganj', 80, 'Kalatia', '1313', NULL, NULL),
(468, 3, 1, 'Keraniganj', 80, 'Keraniganj', '1310', NULL, NULL),
(469, 3, 1, 'Khilgaon', 80, 'KhilgaonTSO', '1219', NULL, '2024-01-30 01:24:24'),
(470, 3, 1, 'Khilkhet', 80, 'KhilkhetTSO', '1229', NULL, NULL),
(471, 3, 1, 'Lalbag', 80, 'Posta TSO', '1211', NULL, NULL),
(472, 3, 1, 'Mirpur', 80, 'Mirpur TSO', '1216', NULL, NULL),
(473, 3, 1, 'Mohammadpur', 80, 'Mohammadpur Housing', '1207', NULL, NULL),
(474, 3, 1, 'Mohammadpur', 80, 'Sangsad BhabanTSO', '1225', NULL, NULL),
(475, 3, 1, 'Motijheel', 80, 'BangabhabanTSO', '1222', NULL, NULL),
(476, 3, 1, 'Motijheel', 80, 'DilkushaTSO', '1223', NULL, NULL),
(477, 3, 1, 'Nawabganj', 80, 'Agla', '1323', NULL, NULL),
(478, 3, 1, 'Nawabganj', 80, 'Churain', '1325', NULL, NULL),
(479, 3, 1, 'Nawabganj', 80, 'Daudpur', '1322', NULL, NULL),
(480, 3, 1, 'Nawabganj', 80, 'Hasnabad', '1321', NULL, NULL),
(481, 3, 1, 'Nawabganj', 80, 'Khalpar', '1324', NULL, NULL),
(482, 3, 1, 'Nawabganj', 80, 'Nawabganj', '1320', NULL, NULL),
(483, 3, 1, 'New market', 80, 'New Market TSO', '1205', NULL, NULL),
(484, 3, 1, 'Palton', 80, 'Dhaka GPO', '1000', NULL, NULL),
(485, 3, 1, 'Ramna', 80, 'Shantinagr TSO', '1217', NULL, NULL),
(486, 3, 1, 'Sabujbag', 80, 'Basabo TSO', '1214', NULL, NULL),
(487, 3, 1, 'Savar', 80, 'Amin Bazar', '1348', NULL, NULL),
(488, 3, 1, 'Savar', 80, 'Dairy Farm', '1341', NULL, NULL),
(489, 3, 1, 'Savar', 80, 'EPZ', '1349', NULL, NULL),
(490, 3, 1, 'Savar', 80, 'Jahangirnagar Univer', '1342', NULL, NULL),
(491, 3, 1, 'Savar', 80, 'Kashem Cotton Mills', '1346', NULL, NULL),
(492, 3, 1, 'Savar', 80, 'Rajphulbaria', '1347', NULL, NULL),
(493, 3, 1, 'Savar', 80, 'Savar', '1340', NULL, NULL),
(494, 3, 1, 'Savar', 80, 'Savar Canttonment', '1344', NULL, NULL),
(495, 3, 1, 'Savar', 80, 'Saver P.A.T.C', '1343', NULL, NULL),
(496, 3, 1, 'Savar', 80, 'Shimulia', '1345', NULL, NULL),
(497, 3, 1, 'Sutrapur', 80, 'Dhaka Sadar HO', '1100', NULL, NULL),
(498, 3, 1, 'Sutrapur', 80, 'Gendaria TSO', '1204', NULL, NULL),
(499, 3, 1, 'Sutrapur', 80, 'Wari TSO', '1203', NULL, NULL),
(500, 3, 1, 'Tejgaon', 80, 'Tejgaon TSO', '1215', NULL, NULL),
(501, 3, 1, 'Tejgaon Industrial Area', 80, 'Dhaka Politechnic', '1208', NULL, NULL),
(502, 3, 1, 'Uttara', 80, 'Uttara Model TwonTSO', '1230', NULL, NULL),
(503, 3, 2, 'Alfadanga', 20, 'Alfadanga', '7870', NULL, '2024-01-30 00:09:24'),
(504, 3, 2, 'Bhanga', 130, 'Bhanga', '7830', NULL, NULL),
(505, 3, 2, 'Boalmari', 130, 'Boalmari', '7860', NULL, NULL),
(506, 3, 2, 'Boalmari', 130, 'Rupatpat', '7861', NULL, NULL),
(507, 3, 2, 'Charbhadrasan', 130, 'Charbadrashan', '7810', NULL, NULL),
(508, 3, 2, 'Faridpur Sadar', 130, 'Ambikapur', '7802', NULL, NULL),
(509, 3, 2, 'Faridpur Sadar', 130, 'Baitulaman Politecni', '7803', NULL, NULL),
(510, 3, 2, 'Faridpur Sadar', 130, 'Faridpursadar', '7800', NULL, NULL),
(511, 3, 2, 'Faridpur Sadar', 130, 'Kanaipur', '7801', NULL, NULL),
(512, 3, 2, 'Madukhali', 130, 'Kamarkali', '7851', NULL, NULL),
(513, 3, 2, 'Madukhali', 130, 'Madukhali', '7850', NULL, NULL),
(514, 3, 2, 'Nagarkanda', 130, 'Nagarkanda', '7840', NULL, NULL),
(515, 3, 2, 'Nagarkanda', 130, 'Talma', '7841', NULL, NULL),
(516, 3, 2, 'Sadarpur', 130, 'Bishwa jaker Manjil', '7822', NULL, NULL),
(517, 3, 2, 'Sadarpur', 130, 'Hat Krishapur', '7821', NULL, NULL),
(518, 3, 2, 'Sadarpur', 130, 'Sadarpur', '7820', NULL, NULL),
(519, 3, 2, 'Shriangan', 130, 'Shriangan', '7804', NULL, NULL),
(520, 3, 3, 'Gazipur Sadar', 130, 'B.O.F', '1703', NULL, NULL),
(521, 3, 3, 'Gazipur Sadar', 130, 'B.R.R', '1701', NULL, NULL),
(522, 3, 3, 'Gazipur Sadar', 130, 'Chandna', '1702', NULL, NULL),
(523, 3, 3, 'Gazipur Sadar', 130, 'Gazipur Sadar', '1700', NULL, NULL),
(524, 3, 3, 'Gazipur Sadar', 130, 'National University', '1704', NULL, NULL),
(525, 3, 3, 'Kaliakaar', 60, 'Kaliakaar', '1750', NULL, '2024-01-30 01:40:13'),
(526, 3, 3, 'Kaliakaar', 60, 'Safipur', '1751', NULL, '2024-01-30 01:40:13'),
(527, 3, 3, 'Kaliganj', 130, 'Kaliganj', '1720', NULL, NULL),
(528, 3, 3, 'Kaliganj', 130, 'Pubail', '1721', NULL, NULL),
(529, 3, 3, 'Kaliganj', 130, 'Santanpara', '1722', NULL, NULL),
(530, 3, 3, 'Kaliganj', 130, 'Vaoal Jamalpur', '1723', NULL, NULL),
(531, 3, 3, 'Kapashia', 130, 'kapashia', '1730', NULL, NULL),
(532, 3, 3, 'Monnunagar', 130, 'Ershad Nagar', '1712', NULL, NULL),
(533, 3, 3, 'Monnunagar', 130, 'Monnunagar', '1710', NULL, NULL),
(534, 3, 3, 'Monnunagar', 130, 'Nishat Nagar', '1711', NULL, NULL),
(535, 3, 3, 'Sreepur', 130, 'Barmi', '1743', NULL, NULL),
(536, 3, 3, 'Sreepur', 130, 'Bashamur', '1747', NULL, NULL),
(537, 3, 3, 'Sreepur', 130, 'Boubi', '1748', NULL, NULL),
(538, 3, 3, 'Sreepur', 130, 'Kawraid', '1745', NULL, NULL),
(539, 3, 3, 'Sreepur', 130, 'Satkhamair', '1744', NULL, NULL),
(540, 3, 3, 'Sreepur', 130, 'Sreepur', '1740', NULL, NULL),
(541, 3, 3, 'Sripur', 130, 'Rajendrapur', '1741', NULL, NULL),
(542, 3, 3, 'Sripur', 130, 'Rajendrapur Canttome', '1742', NULL, NULL),
(543, 3, 4, 'Gopalganj Sadar', 130, 'Barfa', '8102', NULL, NULL),
(544, 3, 4, 'Gopalganj Sadar', 130, 'Chandradighalia', '8013', NULL, NULL),
(545, 3, 4, 'Gopalganj Sadar', 130, 'Gopalganj Sadar', '8100', NULL, NULL),
(546, 3, 4, 'Gopalganj Sadar', 130, 'Ulpur', '8101', NULL, NULL),
(547, 3, 4, 'Kashiani', 130, 'Jonapur', '8133', NULL, NULL),
(548, 3, 4, 'Kashiani', 130, 'Kashiani', '8130', NULL, NULL),
(549, 3, 4, 'Kashiani', 130, 'Ramdia College', '8131', NULL, NULL),
(550, 3, 4, 'Kashiani', 130, 'Ratoil', '8132', NULL, NULL),
(551, 3, 4, 'Kotalipara', 130, 'Kotalipara', '8110', NULL, NULL),
(552, 3, 4, 'Maksudpur', 130, 'Batkiamari', '8141', NULL, NULL),
(553, 3, 4, 'Maksudpur', 130, 'Khandarpara', '8142', NULL, NULL),
(554, 3, 4, 'Maksudpur', 130, 'Maksudpur', '8140', NULL, NULL),
(555, 3, 4, 'Tungipara', 130, 'Patgati', '8121', NULL, NULL),
(556, 3, 4, 'Tungipara', 130, 'Tungipara', '8120', NULL, NULL),
(557, 3, 5, 'Dewangonj', 130, 'Dewangonj', '2030', NULL, NULL),
(558, 3, 5, 'Dewangonj', 130, 'Dewangonj S. Mills', '2031', NULL, NULL),
(559, 3, 5, 'Islampur', 130, 'Durmoot', '2021', NULL, NULL),
(560, 3, 5, 'Islampur', 130, 'Gilabari', '2022', NULL, NULL),
(561, 3, 5, 'Islampur', 130, 'Islampur', '2020', NULL, NULL),
(562, 3, 5, 'Jamalpur', 130, 'Jamalpur', '2000', NULL, NULL),
(563, 3, 5, 'Jamalpur', 130, 'Nandina', '2001', NULL, NULL),
(564, 3, 5, 'Jamalpur', 130, 'Narundi', '2002', NULL, NULL),
(565, 3, 5, 'Malandah', 130, 'Jamalpur', '2011', NULL, NULL),
(566, 3, 5, 'Malandah', 130, 'Mahmoodpur', '2013', NULL, NULL),
(567, 3, 5, 'Malandah', 130, 'Malancha', '2012', NULL, NULL),
(568, 3, 5, 'Malandah', 130, 'Malandah', '2010', NULL, NULL),
(569, 3, 5, 'Mathargonj', 130, 'Balijhuri', '2041', NULL, NULL),
(570, 3, 5, 'Mathargonj', 130, 'Mathargonj', '2040', NULL, NULL),
(571, 3, 5, 'Shorishabari', 130, 'Bausee', '2052', NULL, NULL),
(572, 3, 5, 'Shorishabari', 130, 'Gunerbari', '2051', NULL, NULL),
(573, 3, 5, 'Shorishabari', 130, 'Jagannath Ghat', '2053', NULL, NULL),
(574, 3, 5, 'Shorishabari', 130, 'Jamuna Sar Karkhana', '2055', NULL, NULL),
(575, 3, 5, 'Shorishabari', 130, 'Pingna', '2054', NULL, NULL),
(576, 3, 5, 'Shorishabari', 130, 'Shorishabari', '2050', NULL, NULL),
(577, 3, 6, 'Bajitpur', 130, 'Bajitpur', '2336', NULL, NULL),
(578, 3, 6, 'Bajitpur', 130, 'Laksmipur', '2338', NULL, NULL),
(579, 3, 6, 'Bajitpur', 130, 'Sararchar', '2337', NULL, NULL),
(580, 3, 6, 'Bhairob', 130, 'Bhairab', '2350', NULL, NULL),
(581, 3, 6, 'Hossenpur', 130, 'Hossenpur', '2320', NULL, NULL),
(582, 3, 6, 'Itna', 130, 'Itna', '2390', NULL, NULL),
(583, 3, 6, 'Karimganj', 130, 'Karimganj', '2310', NULL, NULL),
(584, 3, 6, 'Katiadi', 130, 'Gochhihata', '2331', NULL, NULL),
(585, 3, 6, 'Katiadi', 130, 'Katiadi', '2330', NULL, NULL),
(586, 3, 6, 'Kishoreganj Sadar', 130, 'Kishoreganj S.Mills', '2301', NULL, NULL),
(587, 3, 6, 'Kishoreganj Sadar', 130, 'Kishoreganj Sadar', '2300', NULL, NULL),
(588, 3, 6, 'Kishoreganj Sadar', 130, 'Maizhati', '2302', NULL, NULL),
(589, 3, 6, 'Kishoreganj Sadar', 130, 'Nilganj', '2303', NULL, NULL),
(590, 3, 6, 'Kuliarchar', 130, 'Chhoysuti', '2341', NULL, NULL),
(591, 3, 6, 'Kuliarchar', 130, 'Kuliarchar', '2340', NULL, NULL),
(592, 3, 6, 'Mithamoin', 130, 'Abdullahpur', '2371', NULL, NULL),
(593, 3, 6, 'Mithamoin', 130, 'MIthamoin', '2370', NULL, NULL),
(594, 3, 6, 'Nikli', 130, 'Nikli', '2360', NULL, NULL),
(595, 3, 6, 'Ostagram', 130, 'Ostagram', '2380', NULL, NULL),
(596, 3, 6, 'Pakundia', 130, 'Pakundia', '2326', NULL, NULL),
(597, 3, 6, 'Tarial', 130, 'Tarial', '2316', NULL, NULL),
(598, 3, 7, 'Barhamganj', 130, 'Bahadurpur', '7932', NULL, NULL),
(599, 3, 7, 'Barhamganj', 130, 'Barhamganj', '7930', NULL, NULL),
(600, 3, 7, 'Barhamganj', 130, 'Nilaksmibandar', '7931', NULL, NULL),
(601, 3, 7, 'Barhamganj', 130, 'Umedpur', '7933', NULL, NULL),
(602, 3, 7, 'kalkini', 130, 'Kalkini', '7920', NULL, NULL),
(603, 3, 7, 'kalkini', 130, 'Sahabrampur', '7921', NULL, NULL),
(604, 3, 7, 'Madaripur Sadar', 130, 'Charmugria', '7901', NULL, NULL),
(605, 3, 7, 'Madaripur Sadar', 130, 'Habiganj', '7903', NULL, NULL),
(606, 3, 7, 'Madaripur Sadar', 130, 'Kulpaddi', '7902', NULL, NULL),
(607, 3, 7, 'Madaripur Sadar', 130, 'Madaripur Sadar', '7900', NULL, NULL),
(608, 3, 7, 'Madaripur Sadar', 130, 'Mustafapur', '7904', NULL, NULL),
(609, 3, 7, 'Rajoir', 130, 'Khalia', '7911', NULL, NULL),
(610, 3, 7, 'Rajoir', 130, 'Rajoir', '7910', NULL, NULL),
(611, 3, 8, 'Doulatpur', 130, 'Doulatpur', '1860', NULL, NULL),
(612, 3, 8, 'Gheor', 130, 'Gheor', '1840', NULL, NULL),
(613, 3, 8, 'Lechhraganj', 130, 'Jhitka', '1831', NULL, NULL),
(614, 3, 8, 'Lechhraganj', 130, 'Lechhraganj', '1830', NULL, NULL),
(615, 3, 8, 'Manikganj Sadar', 130, 'Barangail', '1804', NULL, NULL),
(616, 3, 8, 'Manikganj Sadar', 130, 'Gorpara', '1802', NULL, NULL),
(617, 3, 8, 'Manikganj Sadar', 130, 'Mahadebpur', '1803', NULL, NULL),
(618, 3, 8, 'Manikganj Sadar', 130, 'Manikganj Bazar', '1801', NULL, NULL),
(619, 3, 8, 'Manikganj Sadar', 130, 'Manikganj Sadar', '1800', NULL, NULL),
(620, 3, 8, 'Saturia', 130, 'Baliati', '1811', NULL, NULL),
(621, 3, 8, 'Saturia', 130, 'Saturia', '1810', NULL, NULL),
(622, 3, 8, 'Shibloya', 130, 'Aricha', '1851', NULL, NULL),
(623, 3, 8, 'Shibloya', 130, 'Shibaloy', '1850', NULL, NULL),
(624, 3, 8, 'Shibloya', 130, 'Tewta', '1852', NULL, NULL),
(625, 3, 8, 'Shibloya', 130, 'Uthli', '1853', NULL, NULL),
(626, 3, 8, 'Singari', 130, 'Baira', '1821', NULL, NULL),
(627, 3, 8, 'Singari', 130, 'joymantop', '1822', NULL, NULL),
(628, 3, 8, 'Singari', 130, 'Singair', '1820', NULL, NULL),
(629, 3, 9, 'Gajaria', 130, 'Gajaria', '1510', NULL, NULL),
(630, 3, 9, 'Gajaria', 130, 'Hossendi', '1511', NULL, NULL),
(631, 3, 9, 'Gajaria', 130, 'Rasulpur', '1512', NULL, NULL),
(632, 3, 9, 'Lohajong', 130, 'Gouragonj', '1334', NULL, NULL),
(633, 3, 9, 'Lohajong', 130, 'Gouragonj', '1534', NULL, NULL),
(634, 3, 9, 'Lohajong', 130, 'Haldia SO', '1532', NULL, NULL),
(635, 3, 9, 'Lohajong', 130, 'Haridia', '1333', NULL, NULL),
(636, 3, 9, 'Lohajong', 130, 'Haridia DESO', '1533', NULL, NULL),
(637, 3, 9, 'Lohajong', 130, 'Korhati', '1531', NULL, NULL),
(638, 3, 9, 'Lohajong', 130, 'Lohajang', '1530', NULL, NULL),
(639, 3, 9, 'Lohajong', 130, 'Madini Mandal', '1335', NULL, NULL),
(640, 3, 9, 'Lohajong', 130, 'Medini Mandal EDSO', '1535', NULL, NULL),
(641, 3, 9, 'Munshiganj Sadar', 130, 'Kathakhali', '1503', NULL, NULL),
(642, 3, 9, 'Munshiganj Sadar', 130, 'Mirkadim', '1502', NULL, NULL),
(643, 3, 9, 'Munshiganj Sadar', 130, 'Munshiganj Sadar', '1500', NULL, NULL),
(644, 3, 9, 'Munshiganj Sadar', 130, 'Rikabibazar', '1501', NULL, NULL),
(645, 3, 9, 'Sirajdikhan', 130, 'Ichapur', '1542', NULL, NULL),
(646, 3, 9, 'Sirajdikhan', 130, 'Kola', '1541', NULL, NULL),
(647, 3, 9, 'Sirajdikhan', 130, 'Malkha Nagar', '1543', NULL, NULL),
(648, 3, 9, 'Sirajdikhan', 130, 'Shekher Nagar', '1544', NULL, NULL),
(649, 3, 9, 'Sirajdikhan', 130, 'Sirajdikhan', '1540', NULL, NULL),
(650, 3, 9, 'Srinagar', 130, 'Baghra', '1557', NULL, NULL),
(651, 3, 9, 'Srinagar', 130, 'Barikhal', '1551', NULL, NULL),
(652, 3, 9, 'Srinagar', 130, 'Bhaggyakul', '1558', NULL, NULL),
(653, 3, 9, 'Srinagar', 130, 'Hashara', '1553', NULL, NULL),
(654, 3, 9, 'Srinagar', 130, 'Kolapara', '1554', NULL, NULL),
(655, 3, 9, 'Srinagar', 130, 'Kumarbhog', '1555', NULL, NULL),
(656, 3, 9, 'Srinagar', 130, 'Mazpara', '1552', NULL, NULL),
(657, 3, 9, 'Srinagar', 130, 'Srinagar', '1550', NULL, NULL),
(658, 3, 9, 'Srinagar', 130, 'Vaggyakul SO', '1556', NULL, NULL),
(659, 3, 9, 'Tangibari', 130, 'Bajrajugini', '1523', NULL, NULL),
(660, 3, 9, 'Tangibari', 130, 'Baligao', '1522', NULL, NULL),
(661, 3, 9, 'Tangibari', 130, 'Betkahat', '1521', NULL, NULL),
(662, 3, 9, 'Tangibari', 130, 'Dighirpar', '1525', NULL, NULL),
(663, 3, 9, 'Tangibari', 130, 'Hasail', '1524', NULL, NULL),
(664, 3, 9, 'Tangibari', 130, 'Pura', '1527', NULL, NULL),
(665, 3, 9, 'Tangibari', 130, 'Pura EDSO', '1526', NULL, NULL),
(666, 3, 9, 'Tangibari', 130, 'Tangibari', '1520', NULL, NULL),
(667, 3, 10, 'Bhaluka', 130, 'Bhaluka', '2240', NULL, NULL),
(668, 3, 10, 'Fulbaria', 130, 'Fulbaria', '2216', NULL, NULL),
(669, 3, 10, 'Gaforgaon', 130, 'Duttarbazar', '2234', NULL, NULL),
(670, 3, 10, 'Gaforgaon', 130, 'Gaforgaon', '2230', NULL, NULL),
(671, 3, 10, 'Gaforgaon', 130, 'Kandipara', '2233', NULL, NULL),
(672, 3, 10, 'Gaforgaon', 130, 'Shibganj', '2231', NULL, NULL),
(673, 3, 10, 'Gaforgaon', 130, 'Usti', '2232', NULL, NULL),
(674, 3, 10, 'Gouripur', 130, 'Gouripur', '2270', NULL, NULL),
(675, 3, 10, 'Gouripur', 130, 'Ramgopalpur', '2271', NULL, NULL),
(676, 3, 10, 'Haluaghat', 130, 'Dhara', '2261', NULL, NULL),
(677, 3, 10, 'Haluaghat', 130, 'Haluaghat', '2260', NULL, NULL),
(678, 3, 10, 'Haluaghat', 130, 'Munshirhat', '2262', NULL, NULL),
(679, 3, 10, 'Isshwargonj', 130, 'Atharabari', '2282', NULL, NULL),
(680, 3, 10, 'Isshwargonj', 130, 'Isshwargonj', '2280', NULL, NULL),
(681, 3, 10, 'Isshwargonj', 130, 'Sohagi', '2281', NULL, NULL),
(682, 3, 10, 'Muktagachha', 130, 'Muktagachha', '2210', NULL, NULL),
(683, 3, 10, 'Mymensingh Sadar', 130, 'Agriculture Universi', '2202', NULL, NULL),
(684, 3, 10, 'Mymensingh Sadar', 130, 'Biddyaganj', '2204', NULL, NULL),
(685, 3, 10, 'Mymensingh Sadar', 130, 'Kawatkhali', '2201', NULL, NULL),
(686, 3, 10, 'Mymensingh Sadar', 130, 'Mymensingh Sadar', '2200', NULL, NULL),
(687, 3, 10, 'Mymensingh Sadar', 130, 'Pearpur', '2205', NULL, NULL),
(688, 3, 10, 'Mymensingh Sadar', 130, 'Shombhuganj', '2203', NULL, NULL),
(689, 3, 10, 'Nandail', 130, 'Gangail', '2291', NULL, NULL),
(690, 3, 10, 'Nandail', 130, 'Nandail', '2290', NULL, NULL),
(691, 3, 10, 'Phulpur', 130, 'Beltia', '2251', NULL, NULL),
(692, 3, 10, 'Phulpur', 130, 'Phulpur', '2250', NULL, NULL),
(693, 3, 10, 'Phulpur', 130, 'Tarakanda', '2252', NULL, NULL),
(694, 3, 10, 'Trishal', 130, 'Ahmadbad', '2221', NULL, NULL),
(695, 3, 10, 'Trishal', 130, 'Dhala', '2223', NULL, NULL),
(696, 3, 10, 'Trishal', 130, 'Ram Amritaganj', '2222', NULL, NULL),
(697, 3, 10, 'Trishal', 130, 'Trishal', '2220', NULL, NULL),
(698, 3, 11, 'Araihazar', 130, 'Araihazar', '1450', NULL, NULL),
(699, 3, 11, 'Araihazar', 130, 'Gopaldi', '1451', NULL, NULL),
(700, 3, 11, 'Baidder Bazar', 130, 'Baidder Bazar', '1440', NULL, NULL),
(701, 3, 11, 'Baidder Bazar', 130, 'Bara Nagar', '1441', NULL, NULL),
(702, 3, 11, 'Baidder Bazar', 130, 'Barodi', '1442', NULL, NULL),
(703, 3, 11, 'Bandar', 130, 'Bandar', '1410', NULL, NULL),
(704, 3, 11, 'Bandar', 130, 'BIDS', '1413', NULL, NULL),
(705, 3, 11, 'Bandar', 130, 'D.C Mills', '1411', NULL, NULL),
(706, 3, 11, 'Bandar', 130, 'Madanganj', '1414', NULL, NULL),
(707, 3, 11, 'Bandar', 130, 'Nabiganj', '1412', NULL, NULL),
(708, 3, 11, 'Fatullah', 130, 'Fatulla Bazar', '1421', NULL, NULL),
(709, 3, 11, 'Fatullah', 130, 'Fatullah', '1420', NULL, NULL),
(710, 3, 11, 'Narayanganj Sadar', 130, 'Narayanganj Sadar', '1400', NULL, NULL),
(711, 3, 11, 'Rupganj', 130, 'Bhulta', '1462', NULL, NULL),
(712, 3, 11, 'Rupganj', 130, 'Kanchan', '1461', NULL, NULL),
(713, 3, 11, 'Rupganj', 130, 'Murapara', '1464', NULL, NULL),
(714, 3, 11, 'Rupganj', 130, 'Nagri', '1463', NULL, NULL),
(715, 3, 11, 'Rupganj', 130, 'Rupganj', '1460', NULL, NULL),
(716, 3, 11, 'Siddirganj', 130, 'Adamjeenagar', '1431', NULL, NULL),
(717, 3, 11, 'Siddirganj', 130, 'LN Mills', '1432', NULL, NULL),
(718, 3, 11, 'Siddirganj', 130, 'Siddirganj', '1430', NULL, NULL),
(719, 3, 12, 'Belabo', 130, 'Belabo', '1640', NULL, NULL),
(720, 3, 12, 'Monohordi', 130, 'Hatirdia', '1651', NULL, NULL),
(721, 3, 12, 'Monohordi', 130, 'Katabaria', '1652', NULL, NULL),
(722, 3, 12, 'Monohordi', 130, 'Monohordi', '1650', NULL, NULL),
(723, 3, 12, 'Narshingdi Sadar', 130, 'Karimpur', '1605', NULL, NULL),
(724, 3, 12, 'Narshingdi Sadar', 130, 'Madhabdi', '1604', NULL, NULL),
(725, 3, 12, 'Narshingdi Sadar', 130, 'Narshingdi College', '1602', NULL, NULL),
(726, 3, 12, 'Narshingdi Sadar', 130, 'Narshingdi Sadar', '1600', NULL, NULL),
(727, 3, 12, 'Narshingdi Sadar', 130, 'Panchdona', '1603', NULL, NULL),
(728, 3, 12, 'Narshingdi Sadar', 130, 'UMC Jute Mills', '1601', NULL, NULL),
(729, 3, 12, 'Palash', 130, 'Char Sindhur', '1612', NULL, NULL),
(730, 3, 12, 'Palash', 130, 'Ghorashal', '1613', NULL, NULL),
(731, 3, 12, 'Palash', 130, 'Ghorashal Urea Facto', '1611', NULL, NULL),
(732, 3, 12, 'Palash', 130, 'Palash', '1610', NULL, NULL),
(733, 3, 12, 'Raypura', 130, 'Bazar Hasnabad', '1631', NULL, NULL),
(734, 3, 12, 'Raypura', 130, 'Radhaganj bazar', '1632', NULL, NULL),
(735, 3, 12, 'Raypura', 130, 'Raypura', '1630', NULL, NULL),
(736, 3, 12, 'Shibpur', 130, 'Shibpur', '1620', NULL, NULL),
(737, 3, 13, 'Susung Durgapur', 130, 'Susnng Durgapur', '2420', NULL, NULL),
(738, 3, 13, 'Atpara', 130, 'Atpara', '2470', NULL, NULL),
(739, 3, 13, 'Barhatta', 130, 'Barhatta', '2440', NULL, NULL),
(740, 3, 13, 'Dharmapasha', 130, 'Dharampasha', '2450', NULL, NULL),
(741, 3, 13, 'Dhobaura', 130, 'Dhobaura', '2416', NULL, NULL),
(742, 3, 13, 'Dhobaura', 130, 'Sakoai', '2417', NULL, NULL),
(743, 3, 13, 'Kalmakanda', 130, 'Kalmakanda', '2430', NULL, NULL),
(744, 3, 13, 'Kendua', 130, 'Kendua', '2480', NULL, NULL),
(745, 3, 13, 'Khaliajuri', 130, 'Khaliajhri', '2460', NULL, NULL),
(746, 3, 13, 'Khaliajuri', 130, 'Shaldigha', '2462', NULL, NULL),
(747, 3, 13, 'Madan', 130, 'Madan', '2490', NULL, NULL),
(748, 3, 13, 'Moddhynagar', 130, 'Moddoynagar', '2456', NULL, NULL),
(749, 3, 13, 'Mohanganj', 130, 'Mohanganj', '2446', NULL, NULL),
(750, 3, 13, 'Netrakona Sadar', 130, 'Baikherhati', '2401', NULL, NULL),
(751, 3, 13, 'Netrakona Sadar', 130, 'Netrakona Sadar', '2400', NULL, NULL),
(752, 3, 13, 'Purbadhola', 130, 'Jaria Jhanjhail', '2412', NULL, NULL),
(753, 3, 13, 'Purbadhola', 130, 'Purbadhola', '2410', NULL, NULL),
(754, 3, 13, 'Purbadhola', 130, 'Shamgonj', '2411', NULL, NULL),
(755, 3, 14, 'Baliakandi', 130, 'Baliakandi', '7730', NULL, NULL),
(756, 3, 14, 'Baliakandi', 130, 'Nalia', '7731', NULL, NULL),
(757, 3, 14, 'Pangsha', 130, 'Mrigibazar', '7723', NULL, NULL),
(758, 3, 14, 'Pangsha', 130, 'Pangsha', '7720', NULL, NULL),
(759, 3, 14, 'Pangsha', 130, 'Ramkol', '7721', NULL, NULL),
(760, 3, 14, 'Pangsha', 130, 'Ratandia', '7722', NULL, NULL),
(761, 3, 14, 'Rajbari Sadar', 130, 'Goalanda', '7710', NULL, NULL),
(762, 3, 14, 'Rajbari Sadar', 130, 'Khankhanapur', '7711', NULL, NULL),
(763, 3, 14, 'Rajbari Sadar', 130, 'Rajbari Sadar', '7700', NULL, NULL),
(764, 3, 15, 'Bhedorganj', 130, 'Bhedorganj', '8030', NULL, NULL),
(765, 3, 15, 'Damudhya', 130, 'Damudhya', '8040', NULL, NULL),
(766, 3, 15, 'Gosairhat', 130, 'Gosairhat', '8050', NULL, NULL),
(767, 3, 15, 'Jajira', 130, 'Jajira', '8010', NULL, NULL),
(768, 3, 15, 'Naria', 130, 'Bhozeshwar', '8021', NULL, NULL),
(769, 3, 15, 'Naria', 130, 'Gharisar', '8022', NULL, NULL),
(770, 3, 15, 'Naria', 130, 'Kartikpur', '8024', NULL, NULL),
(771, 3, 15, 'Naria', 130, 'Naria', '8020', NULL, NULL),
(772, 3, 15, 'Naria', 130, 'Upshi', '8023', NULL, NULL),
(773, 3, 15, 'Shariatpur Sadar', 130, 'Angaria', '8001', NULL, NULL),
(774, 3, 15, 'Shariatpur Sadar', 130, 'Chikandi', '8002', NULL, NULL),
(775, 3, 15, 'Shariatpur Sadar', 130, 'Shariatpur Sadar', '8000', NULL, NULL),
(776, 3, 16, 'Bakshigonj', 130, 'Bakshigonj', '2140', NULL, NULL),
(777, 3, 16, 'Jhinaigati', 130, 'Jhinaigati', '2120', NULL, NULL),
(778, 3, 16, 'Nakla', 130, 'Gonopaddi', '2151', NULL, NULL),
(779, 3, 16, 'Nakla', 130, 'Nakla', '2150', NULL, NULL),
(780, 3, 16, 'Nalitabari', 130, 'Hatibandha', '2111', NULL, NULL);
INSERT INTO `postcodes` (`id`, `division_id`, `district_id`, `upazila`, `zone_charge`, `postOffice`, `postCode`, `created_at`, `updated_at`) VALUES
(781, 3, 16, 'Nalitabari', 130, 'Nalitabari', '2110', NULL, NULL),
(782, 3, 16, 'Sherpur Shadar', 130, 'Sherpur Shadar', '2100', NULL, NULL),
(783, 3, 16, 'Shribardi', 130, 'Shribardi', '2130', NULL, NULL),
(784, 3, 17, 'Basail', 130, 'Basail', '1920', NULL, NULL),
(785, 3, 17, 'Bhuapur', 130, 'Bhuapur', '1960', NULL, NULL),
(786, 3, 17, 'Delduar', 130, 'Delduar', '1910', NULL, NULL),
(787, 3, 17, 'Delduar', 130, 'Elasin', '1913', NULL, NULL),
(788, 3, 17, 'Delduar', 130, 'Hinga Nagar', '1914', NULL, NULL),
(789, 3, 17, 'Delduar', 130, 'Jangalia', '1911', NULL, NULL),
(790, 3, 17, 'Delduar', 130, 'Lowhati', '1915', NULL, NULL),
(791, 3, 17, 'Delduar', 130, 'Patharail', '1912', NULL, NULL),
(792, 3, 17, 'Ghatail', 130, 'D. Pakutia', '1982', NULL, NULL),
(793, 3, 17, 'Ghatail', 130, 'Dhalapara', '1983', NULL, NULL),
(794, 3, 17, 'Ghatail', 130, 'Ghatial', '1980', NULL, NULL),
(795, 3, 17, 'Ghatail', 130, 'Lohani', '1984', NULL, NULL),
(796, 3, 17, 'Ghatail', 130, 'Zahidganj', '1981', NULL, NULL),
(797, 3, 17, 'Gopalpur', 130, 'Gopalpur', '1990', NULL, NULL),
(798, 3, 17, 'Gopalpur', 130, 'Hemnagar', '1992', NULL, NULL),
(799, 3, 17, 'Gopalpur', 130, 'Jhowail', '1991', NULL, NULL),
(800, 3, 17, 'Kalihati', 130, 'Ballabazar', '1973', NULL, NULL),
(801, 3, 17, 'Kalihati', 130, 'Elinga', '1974', NULL, NULL),
(802, 3, 17, 'Kalihati', 130, 'Kalihati', '1970', NULL, NULL),
(803, 3, 17, 'Kalihati', 130, 'Nagarbari', '1977', NULL, NULL),
(804, 3, 17, 'Kalihati', 130, 'Nagarbari SO', '1976', NULL, NULL),
(805, 3, 17, 'Kalihati', 130, 'Nagbari', '1972', NULL, NULL),
(806, 3, 17, 'Kalihati', 130, 'Palisha', '1975', NULL, NULL),
(807, 3, 17, 'Kalihati', 130, 'Rajafair', '1971', NULL, NULL),
(808, 3, 17, 'Kashkaolia', 130, 'Kashkawlia', '1930', NULL, NULL),
(809, 3, 17, 'Madhupur', 130, 'Dhobari', '1997', NULL, NULL),
(810, 3, 17, 'Madhupur', 130, 'Madhupur', '1996', NULL, NULL),
(811, 3, 17, 'Mirzapur', 130, 'Gorai', '1941', NULL, NULL),
(812, 3, 17, 'Mirzapur', 130, 'Jarmuki', '1944', NULL, NULL),
(813, 3, 17, 'Mirzapur', 130, 'M.C. College', '1942', NULL, NULL),
(814, 3, 17, 'Mirzapur', 130, 'Mirzapur', '1940', NULL, NULL),
(815, 3, 17, 'Mirzapur', 130, 'Mohera', '1945', NULL, NULL),
(816, 3, 17, 'Mirzapur', 130, 'Warri paikpara', '1943', NULL, NULL),
(817, 3, 17, 'Nagarpur', 130, 'Dhuburia', '1937', NULL, NULL),
(818, 3, 17, 'Nagarpur', 130, 'Nagarpur', '1936', NULL, NULL),
(819, 3, 17, 'Nagarpur', 130, 'Salimabad', '1938', NULL, NULL),
(820, 3, 17, 'Sakhipur', 130, 'Kochua', '1951', NULL, NULL),
(821, 3, 17, 'Sakhipur', 130, 'Sakhipur', '1950', NULL, NULL),
(822, 3, 17, 'Tangail Sadar', 130, 'Kagmari', '1901', NULL, NULL),
(823, 3, 17, 'Tangail Sadar', 130, 'Korotia', '1903', NULL, NULL),
(824, 3, 17, 'Tangail Sadar', 130, 'Purabari', '1904', NULL, NULL),
(825, 3, 17, 'Tangail Sadar', 130, 'Santosh', '1902', NULL, NULL),
(826, 3, 17, 'Tangail Sadar', 130, 'Tangail Sadar', '1900', NULL, NULL),
(827, 4, 55, 'Bagerhat Sadar', 130, 'Bagerhat Sadar', '9300', NULL, NULL),
(828, 4, 55, 'Bagerhat Sadar', 130, 'P.C College', '9301', NULL, NULL),
(829, 4, 55, 'Bagerhat Sadar', 130, 'Rangdia', '9302', NULL, NULL),
(830, 4, 55, 'Chalna Ankorage', 130, 'Chalna Ankorage', '9350', NULL, NULL),
(831, 4, 55, 'Chalna Ankorage', 130, 'Mongla Port', '9351', NULL, NULL),
(832, 4, 55, 'Chitalmari', 130, 'Barabaria', '9361', NULL, NULL),
(833, 4, 55, 'Chitalmari', 130, 'Chitalmari', '9360', NULL, NULL),
(834, 4, 55, 'Fakirhat', 130, 'Bhanganpar Bazar', '9372', NULL, NULL),
(835, 4, 55, 'Fakirhat', 130, 'Fakirhat', '9370', NULL, NULL),
(836, 4, 55, 'Fakirhat', 130, 'Mansa', '9371', NULL, NULL),
(837, 4, 55, 'Kachua UPO', 130, 'Kachua', '9310', NULL, NULL),
(838, 4, 55, 'Kachua UPO', 130, 'Sonarkola', '9311', NULL, NULL),
(839, 4, 55, 'Mollahat', 130, 'Charkulia', '9383', NULL, NULL),
(840, 4, 55, 'Mollahat', 130, 'Dariala', '9382', NULL, NULL),
(841, 4, 55, 'Mollahat', 130, 'Kahalpur', '9381', NULL, NULL),
(842, 4, 55, 'Mollahat', 130, 'Mollahat', '9380', NULL, NULL),
(843, 4, 55, 'Mollahat', 130, 'Nagarkandi', '9384', NULL, NULL),
(844, 4, 55, 'Mollahat', 130, 'Pak Gangni', '9385', NULL, NULL),
(845, 4, 55, 'Morelganj', 130, 'Morelganj', '9320', NULL, NULL),
(846, 4, 55, 'Morelganj', 130, 'Sannasi Bazar', '9321', NULL, NULL),
(847, 4, 55, 'Morelganj', 130, 'Telisatee', '9322', NULL, NULL),
(848, 4, 55, 'Rampal', 130, 'Foylahat', '9341', NULL, NULL),
(849, 4, 55, 'Rampal', 130, 'Gourambha', '9343', NULL, NULL),
(850, 4, 55, 'Rampal', 130, 'Rampal', '9340', NULL, NULL),
(851, 4, 55, 'Rampal', 130, 'Sonatunia', '9342', NULL, NULL),
(852, 4, 55, 'Rayenda', 130, 'Rayenda', '9330', NULL, NULL),
(853, 4, 56, 'Alamdanga', 130, 'Alamdanga', '7210', NULL, NULL),
(854, 4, 56, 'Alamdanga', 130, 'Hardi', '7211', NULL, NULL),
(855, 4, 56, 'Chuadanga Sadar', 130, 'Chuadanga Sadar', '7200', NULL, NULL),
(856, 4, 56, 'Chuadanga Sadar', 130, 'Munshiganj', '7201', NULL, NULL),
(857, 4, 56, 'Damurhuda', 130, 'Andulbaria', '7222', NULL, NULL),
(858, 4, 56, 'Damurhuda', 130, 'Damurhuda', '7220', NULL, NULL),
(859, 4, 56, 'Damurhuda', 130, 'Darshana', '7221', NULL, NULL),
(860, 4, 56, 'Doulatganj', 130, 'Doulatganj', '7230', NULL, NULL),
(861, 4, 57, 'Bagharpara', 130, 'Bagharpara', '7470', NULL, NULL),
(862, 4, 57, 'Bagharpara', 130, 'Gouranagar', '7471', NULL, NULL),
(863, 4, 57, 'Chaugachha', 130, 'Chougachha', '7410', NULL, NULL),
(864, 4, 57, 'Jessore Sadar', 130, 'Basundia', '7406', NULL, NULL),
(865, 4, 57, 'Jessore Sadar', 130, 'Chanchra', '7402', NULL, NULL),
(866, 4, 57, 'Jessore Sadar', 130, 'Churamankathi', '7407', NULL, NULL),
(867, 4, 57, 'Jessore Sadar', 130, 'Jessore Airbach', '7404', NULL, NULL),
(868, 4, 57, 'Jessore Sadar', 130, 'Jessore canttonment', '7403', NULL, NULL),
(869, 4, 57, 'Jessore Sadar', 130, 'Jessore Sadar', '7400', NULL, NULL),
(870, 4, 57, 'Jessore Sadar', 130, 'Jessore Upa-Shahar', '7401', NULL, NULL),
(871, 4, 57, 'Jessore Sadar', 130, 'Rupdia', '7405', NULL, NULL),
(872, 4, 57, 'Jhikargachha', 130, 'Jhikargachha', '7420', NULL, NULL),
(873, 4, 57, 'Keshabpur', 130, 'Keshobpur', '7450', NULL, NULL),
(874, 4, 57, 'Monirampur', 130, 'Monirampur', '7440', NULL, NULL),
(875, 4, 57, 'Noapara', 130, 'Bhugilhat', '7462', NULL, NULL),
(876, 4, 57, 'Noapara', 130, 'Noapara', '7460', NULL, NULL),
(877, 4, 57, 'Noapara', 130, 'Rajghat', '7461', NULL, NULL),
(878, 4, 57, 'Sarsa', 130, 'Bag Achra', '7433', NULL, NULL),
(879, 4, 57, 'Sarsa', 130, 'Benapole', '7431', NULL, NULL),
(880, 4, 57, 'Sarsa', 130, 'Jadabpur', '7432', NULL, NULL),
(881, 4, 57, 'Sarsa', 130, 'Sarsa', '7430', NULL, NULL),
(882, 4, 58, 'Harinakundu', 130, 'Harinakundu', '7310', NULL, NULL),
(883, 4, 58, 'Jinaidaha Sadar', 130, 'Jinaidaha Cadet College', '7301', NULL, NULL),
(884, 4, 58, 'Jinaidaha Sadar', 130, 'Jinaidaha Sadar', '7300', NULL, NULL),
(885, 4, 58, 'Kotchandpur', 130, 'Kotchandpur', '7330', NULL, NULL),
(886, 4, 58, 'Maheshpur', 130, 'Maheshpur', '7340', NULL, NULL),
(887, 4, 58, 'Naldanga', 130, 'Hatbar Bazar', '7351', NULL, NULL),
(888, 4, 58, 'Naldanga', 130, 'Naldanga', '7350', NULL, NULL),
(889, 4, 58, 'Shailakupa', 130, 'Kumiradaha', '7321', NULL, NULL),
(890, 4, 58, 'Shailakupa', 130, 'Shailakupa', '7320', NULL, NULL),
(891, 4, 59, 'Alaipur', 130, 'Alaipur', '9240', NULL, NULL),
(892, 4, 59, 'Alaipur', 130, 'Belphulia', '9242', NULL, NULL),
(893, 4, 59, 'Alaipur', 130, 'Rupsha', '9241', NULL, NULL),
(894, 4, 59, 'Batiaghat', 130, 'Batiaghat', '9260', NULL, NULL),
(895, 4, 59, 'Batiaghat', 130, 'Surkalee', '9261', NULL, NULL),
(896, 4, 59, 'Chalna Bazar', 130, 'Bajua', '9272', NULL, NULL),
(897, 4, 59, 'Chalna Bazar', 130, 'Chalna Bazar', '9270', NULL, NULL),
(898, 4, 59, 'Chalna Bazar', 130, 'Dakup', '9271', NULL, NULL),
(899, 4, 59, 'Chalna Bazar', 130, 'Nalian', '9273', NULL, NULL),
(900, 4, 59, 'Digalia', 130, 'Chandni Mahal', '9221', NULL, NULL),
(901, 4, 59, 'Digalia', 130, 'Digalia', '9220', NULL, NULL),
(902, 4, 59, 'Digalia', 130, 'Gazirhat', '9224', NULL, NULL),
(903, 4, 59, 'Digalia', 130, 'Ghoshghati', '9223', NULL, NULL),
(904, 4, 59, 'Digalia', 130, 'Senhati', '9222', NULL, NULL),
(905, 4, 59, 'Khulna Sadar', 130, 'Atra Shilpa Area', '9207', NULL, NULL),
(906, 4, 59, 'Khulna Sadar', 130, 'BIT Khulna', '9203', NULL, NULL),
(907, 4, 59, 'Khulna Sadar', 130, 'Doulatpur', '9202', NULL, NULL),
(908, 4, 59, 'Khulna Sadar', 130, 'Jahanabad Canttonmen', '9205', NULL, NULL),
(909, 4, 59, 'Khulna Sadar', 130, 'Khula Sadar', '9100', NULL, NULL),
(910, 4, 59, 'Khulna Sadar', 130, 'Khulna G.P.O', '9000', NULL, NULL),
(911, 4, 59, 'Khulna Sadar', 130, 'Khulna Shipyard', '9201', NULL, NULL),
(912, 4, 59, 'Khulna Sadar', 130, 'Khulna University', '9208', NULL, NULL),
(913, 4, 59, 'Khulna Sadar', 130, 'Siramani', '9204', NULL, NULL),
(914, 4, 59, 'Khulna Sadar', 130, 'Sonali Jute Mills', '9206', NULL, NULL),
(915, 4, 59, 'Madinabad', 130, 'Amadee', '9291', NULL, NULL),
(916, 4, 59, 'Madinabad', 130, 'Madinabad', '9290', NULL, NULL),
(917, 4, 59, 'Paikgachha', 130, 'Chandkhali', '9284', NULL, NULL),
(918, 4, 59, 'Paikgachha', 130, 'Garaikhali', '9285', NULL, NULL),
(919, 4, 59, 'Paikgachha', 130, 'Godaipur', '9281', NULL, NULL),
(920, 4, 59, 'Paikgachha', 130, 'Kapilmoni', '9282', NULL, NULL),
(921, 4, 59, 'Paikgachha', 130, 'Katipara', '9283', NULL, NULL),
(922, 4, 59, 'Paikgachha', 130, 'Paikgachha', '9280', NULL, NULL),
(923, 4, 59, 'Phultala', 130, 'Phultala', '9210', NULL, NULL),
(924, 4, 59, 'Sajiara', 130, 'Chuknagar', '9252', NULL, NULL),
(925, 4, 59, 'Sajiara', 130, 'Ghonabanda', '9251', NULL, NULL),
(926, 4, 59, 'Sajiara', 130, 'Sajiara', '9250', NULL, NULL),
(927, 4, 59, 'Sajiara', 130, 'Shahapur', '9253', NULL, NULL),
(928, 4, 59, 'Terakhada', 130, 'Pak Barasat', '9231', NULL, NULL),
(929, 4, 59, 'Terakhada', 130, 'Terakhada', '9230', NULL, NULL),
(930, 4, 60, 'Bheramara', 130, 'Allardarga', '7042', NULL, NULL),
(931, 4, 60, 'Bheramara', 130, 'Bheramara', '7040', NULL, NULL),
(932, 4, 60, 'Bheramara', 130, 'Ganges Bheramara', '7041', NULL, NULL),
(933, 4, 60, 'Janipur', 130, 'Janipur', '7020', NULL, NULL),
(934, 4, 60, 'Janipur', 130, 'Khoksa', '7021', NULL, NULL),
(935, 4, 60, 'Kumarkhali', 130, 'Kumarkhali', '7010', NULL, NULL),
(936, 4, 60, 'Kumarkhali', 130, 'Panti', '7011', NULL, NULL),
(937, 4, 60, 'Kustia Sadar', 130, 'Islami University', '7003', NULL, NULL),
(938, 4, 60, 'Kustia Sadar', 130, 'Jagati', '7002', NULL, NULL),
(939, 4, 60, 'Kustia Sadar', 130, 'Kushtia Mohini', '7001', NULL, NULL),
(940, 4, 60, 'Kustia Sadar', 130, 'Kustia Sadar', '7000', NULL, NULL),
(941, 4, 60, 'Mirpur', 130, 'Amla Sadarpur', '7032', NULL, NULL),
(942, 4, 60, 'Mirpur', 130, 'Mirpur', '7030', NULL, NULL),
(943, 4, 60, 'Mirpur', 130, 'Poradaha', '7031', NULL, NULL),
(944, 4, 60, 'Rafayetpur', 130, 'Khasmathurapur', '7052', NULL, NULL),
(945, 4, 60, 'Rafayetpur', 130, 'Rafayetpur', '7050', NULL, NULL),
(946, 4, 60, 'Rafayetpur', 130, 'Taragunia', '7051', NULL, NULL),
(947, 4, 61, 'Arpara', 130, 'Arpara', '7620', NULL, NULL),
(948, 4, 61, 'Magura Sadar', 130, 'Magura Sadar', '7600', NULL, NULL),
(949, 4, 61, 'Mohammadpur', 130, 'Binodpur', '7631', NULL, NULL),
(950, 4, 61, 'Mohammadpur', 130, 'Mohammadpur', '7630', NULL, NULL),
(951, 4, 61, 'Mohammadpur', 130, 'Nahata', '7632', NULL, NULL),
(952, 4, 61, 'Shripur', 130, 'Langalbadh', '7611', NULL, NULL),
(953, 4, 61, 'Shripur', 130, 'Nachol', '7612', NULL, NULL),
(954, 4, 61, 'Shripur', 130, 'Shripur', '7610', NULL, NULL),
(955, 4, 62, 'Gangni', 130, 'Gangni', '7110', NULL, NULL),
(956, 4, 62, 'Meherpur Sadar', 130, 'Amjhupi', '7101', NULL, NULL),
(957, 4, 62, 'Meherpur Sadar', 130, 'Amjhupi', '7152', NULL, NULL),
(958, 4, 62, 'Meherpur Sadar', 130, 'Meherpur Sadar', '7100', NULL, NULL),
(959, 4, 62, 'Meherpur Sadar', 130, 'Mujib Nagar Complex', '7102', NULL, NULL),
(960, 4, 63, 'Kalia', 130, 'Kalia', '7520', NULL, NULL),
(961, 4, 63, 'Laxmipasha', 130, 'Baradia', '7514', NULL, NULL),
(962, 4, 63, 'Laxmipasha', 130, 'Itna', '7512', NULL, NULL),
(963, 4, 63, 'Laxmipasha', 130, 'Laxmipasha', '7510', NULL, NULL),
(964, 4, 63, 'Laxmipasha', 130, 'Lohagora', '7511', NULL, NULL),
(965, 4, 63, 'Laxmipasha', 130, 'Naldi', '7513', NULL, NULL),
(966, 4, 63, 'Mohajan', 130, 'Mohajan', '7521', NULL, NULL),
(967, 4, 63, 'Narail Sadar', 130, 'Narail Sadar', '7500', NULL, NULL),
(968, 4, 63, 'Narail Sadar', 130, 'Ratanganj', '7501', NULL, NULL),
(969, 4, 64, 'Ashashuni', 130, 'Ashashuni', '9460', NULL, NULL),
(970, 4, 64, 'Ashashuni', 130, 'Baradal', '9461', NULL, NULL),
(971, 4, 64, 'Debbhata', 130, 'Debbhata', '9430', NULL, NULL),
(972, 4, 64, 'Debbhata', 130, 'Gurugram', '9431', NULL, NULL),
(973, 4, 64, 'kalaroa', 130, 'Chandanpur', '9415', NULL, NULL),
(974, 4, 64, 'kalaroa', 130, 'Hamidpur', '9413', NULL, NULL),
(975, 4, 64, 'kalaroa', 130, 'Jhaudanga', '9412', NULL, NULL),
(976, 4, 64, 'kalaroa', 130, 'kalaroa', '9410', NULL, NULL),
(977, 4, 64, 'kalaroa', 130, 'Khordo', '9414', NULL, NULL),
(978, 4, 64, 'kalaroa', 130, 'Murarikati', '9411', NULL, NULL),
(979, 4, 64, 'Kaliganj UPO', 130, 'Kaliganj UPO', '9440', NULL, NULL),
(980, 4, 64, 'Kaliganj UPO', 130, 'Nalta Mubaroknagar', '9441', NULL, NULL),
(981, 4, 64, 'Kaliganj UPO', 130, 'Ratanpur', '9442', NULL, NULL),
(982, 4, 64, 'Nakipur', 130, 'Buri Goalini', '9453', NULL, NULL),
(983, 4, 64, 'Nakipur', 130, 'Gabura', '9454', NULL, NULL),
(984, 4, 64, 'Nakipur', 130, 'Habinagar', '9455', NULL, NULL),
(985, 4, 64, 'Nakipur', 130, 'Nakipur', '9450', NULL, NULL),
(986, 4, 64, 'Nakipur', 130, 'Naobeki', '9452', NULL, NULL),
(987, 4, 64, 'Nakipur', 130, 'Noornagar', '9451', NULL, NULL),
(988, 4, 64, 'Satkhira Sadar', 130, 'Budhhat', '9403', NULL, NULL),
(989, 4, 64, 'Satkhira Sadar', 130, 'Gunakar kati', '9402', NULL, NULL),
(990, 4, 64, 'Satkhira Sadar', 130, 'Satkhira Islamia Acc', '9401', NULL, NULL),
(991, 4, 64, 'Satkhira Sadar', 130, 'Satkhira Sadar', '9400', NULL, NULL),
(992, 4, 64, 'Taala', 130, 'Patkelghata', '9421', NULL, NULL),
(993, 4, 64, 'Taala', 130, 'Taala', '9420', NULL, NULL),
(994, 5, 18, 'Alamdighi', 130, 'Adamdighi', '5890', NULL, NULL),
(995, 5, 18, 'Alamdighi', 130, 'Nasharatpur', '5892', NULL, NULL),
(996, 5, 18, 'Alamdighi', 130, 'Santahar', '5891', NULL, NULL),
(997, 5, 18, 'Bogra Sadar', 130, 'Bogra Canttonment', '5801', NULL, NULL),
(998, 5, 18, 'Bogra Sadar', 130, 'Bogra Sadar', '5800', NULL, NULL),
(999, 5, 18, 'Dhunat', 130, 'Dhunat', '5850', NULL, NULL),
(1000, 5, 18, 'Dhunat', 130, 'Gosaibari', '5851', NULL, NULL),
(1001, 5, 18, 'Dupchachia', 130, 'Dupchachia', '5880', NULL, NULL),
(1002, 5, 18, 'Dupchachia', 130, 'Talora', '5881', NULL, NULL),
(1003, 5, 18, 'Gabtoli', 130, 'Gabtoli', '5820', NULL, NULL),
(1004, 5, 18, 'Gabtoli', 130, 'Sukhanpukur', '5821', NULL, NULL),
(1005, 5, 18, 'Kahalu', 130, 'Kahalu', '5870', NULL, NULL),
(1006, 5, 18, 'Nandigram', 130, 'Nandigram', '5860', NULL, NULL),
(1007, 5, 18, 'Sariakandi', 130, 'Chandan Baisha', '5831', NULL, NULL),
(1008, 5, 18, 'Sariakandi', 130, 'Sariakandi', '5830', NULL, NULL),
(1009, 5, 18, 'Sherpur', 130, 'Chandaikona', '5841', NULL, NULL),
(1010, 5, 18, 'Sherpur', 130, 'Palli Unnyan Accadem', '5842', NULL, NULL),
(1011, 5, 18, 'Sherpur', 130, 'Sherpur', '5840', NULL, NULL),
(1012, 5, 18, 'Shibganj', 130, 'Shibganj', '5810', NULL, NULL),
(1013, 5, 18, 'Sonatola', 130, 'Sonatola', '5826', NULL, NULL),
(1014, 5, 22, 'Bholahat', 130, 'Bholahat', '6330', NULL, NULL),
(1015, 5, 22, 'Chapinawabganj Sadar', 130, 'Amnura', '6303', NULL, NULL),
(1016, 5, 22, 'Chapinawabganj Sadar', 130, 'Chapinawbganj Sadar', '6300', NULL, NULL),
(1017, 5, 22, 'Chapinawabganj Sadar', 130, 'Rajarampur', '6301', NULL, NULL),
(1018, 5, 22, 'Chapinawabganj', 130, 'Ramchandrapur', '6302', NULL, NULL),
(1019, 5, 22, 'Nachol', 130, 'Mandumala', '6311', NULL, NULL),
(1020, 5, 22, 'Nachol', 130, 'Nachol', '6310', NULL, NULL),
(1021, 5, 22, 'Rohanpur', 130, 'Gomashtapur', '6321', NULL, NULL),
(1022, 5, 22, 'Rohanpur', 130, 'Rohanpur', '6320', NULL, NULL),
(1023, 5, 22, 'Shibganj U.P.O', 130, 'Kansart', '6341', NULL, NULL),
(1024, 5, 22, 'Shibganj U.P.O', 130, 'Manaksha', '6342', NULL, NULL),
(1025, 5, 22, 'Shibganj U.P.O', 130, 'Shibganj U.P.O', '6340', NULL, NULL),
(1026, 5, 19, 'Akkelpur', 130, 'Akklepur', '5940', NULL, NULL),
(1027, 5, 19, 'Akkelpur', 130, 'jamalganj', '5941', NULL, NULL),
(1028, 5, 19, 'Akkelpur', 130, 'Tilakpur', '5942', NULL, NULL),
(1029, 5, 19, 'Joypurhat Sadar', 130, 'Joypurhat Sadar', '5900', NULL, NULL),
(1030, 5, 19, 'kalai', 130, 'kalai', '5930', NULL, NULL),
(1031, 5, 19, 'Khetlal', 130, 'Khetlal', '5920', NULL, NULL),
(1032, 5, 19, 'panchbibi', 130, 'Panchbibi', '5910', NULL, NULL),
(1033, 5, 20, 'Ahsanganj', 130, 'Ahsanganj', '6596', NULL, NULL),
(1034, 5, 20, 'Ahsanganj', 130, 'Bandai', '6597', NULL, NULL),
(1035, 5, 20, 'Badalgachhi', 130, 'Badalgachhi', '6570', NULL, NULL),
(1036, 5, 20, 'Dhamuirhat', 130, 'Dhamuirhat', '6580', NULL, NULL),
(1037, 5, 20, 'Mahadebpur', 130, 'Mahadebpur', '6530', NULL, NULL),
(1038, 5, 20, 'Naogaon Sadar', 130, 'Naogaon Sadar', '6500', NULL, NULL),
(1039, 5, 20, 'Niamatpur', 130, 'Niamatpur', '6520', NULL, NULL),
(1040, 5, 20, 'Nitpur', 130, 'Nitpur', '6550', NULL, NULL),
(1041, 5, 20, 'Nitpur', 130, 'Panguria', '6552', NULL, NULL),
(1042, 5, 20, 'Nitpur', 130, 'Porsa', '6551', NULL, NULL),
(1043, 5, 20, 'Patnitala', 130, 'Patnitala', '6540', NULL, NULL),
(1044, 5, 20, 'Prasadpur', 130, 'Balihar', '6512', NULL, NULL),
(1045, 5, 20, 'Prasadpur', 130, 'Manda', '6511', NULL, NULL),
(1046, 5, 20, 'Prasadpur', 130, 'Prasadpur', '6510', NULL, NULL),
(1047, 5, 20, 'Raninagar', 130, 'Kashimpur', '6591', NULL, NULL),
(1048, 5, 20, 'Raninagar', 130, 'Raninagar', '6590', NULL, NULL),
(1049, 5, 20, 'Sapahar', 130, 'Moduhil', '6561', NULL, NULL),
(1050, 5, 20, 'Sapahar', 130, 'Sapahar', '6560', NULL, NULL),
(1051, 5, 21, 'Gopalpur UPO', 130, 'Abdulpur', '6422', NULL, NULL),
(1052, 5, 21, 'Gopalpur UPO', 130, 'Gopalpur U.P.O', '6420', NULL, NULL),
(1053, 5, 21, 'Gopalpur UPO', 130, 'Lalpur S.O', '6421', NULL, NULL),
(1054, 5, 21, 'Harua', 130, 'Baraigram', '6432', NULL, NULL),
(1055, 5, 21, 'Harua', 130, 'Dayarampur', '6431', NULL, NULL),
(1056, 5, 21, 'Harua', 130, 'Harua', '6430', NULL, NULL),
(1057, 5, 21, 'Hatgurudaspur', 130, 'Hatgurudaspur', '6440', NULL, NULL),
(1058, 5, 21, 'Laxman', 130, 'Laxman', '6410', NULL, NULL),
(1059, 5, 21, 'Natore Sadar', 130, 'Baiddyabal Gharia', '6402', NULL, NULL),
(1060, 5, 21, 'Natore Sadar', 130, 'Digapatia', '6401', NULL, NULL),
(1061, 5, 21, 'Natore Sadar', 130, 'Madhnagar', '6403', NULL, NULL),
(1062, 5, 21, 'Natore Sadar', 130, 'Natore Sadar', '6400', NULL, NULL),
(1063, 5, 21, 'Singra', 130, 'Singra', '6450', NULL, NULL),
(1064, 5, 22, 'Banwarinagar', 130, 'Banwarinagar', '6650', NULL, NULL),
(1065, 5, 22, 'Bera', 130, 'Bera', '6680', NULL, NULL),
(1066, 5, 22, 'Bera', 130, 'Kashinathpur', '6682', NULL, NULL),
(1067, 5, 22, 'Bera', 130, 'Nakalia', '6681', NULL, NULL),
(1068, 5, 22, 'Bera', 130, 'Puran Bharenga', '6683', NULL, NULL),
(1069, 5, 22, 'Bhangura', 130, 'Bhangura', '6640', NULL, NULL),
(1070, 5, 22, 'Chatmohar', 130, 'Chatmohar', '6630', NULL, NULL),
(1071, 5, 22, 'Debottar', 130, 'Debottar', '6610', NULL, NULL),
(1072, 5, 22, 'Ishwardi', 130, 'Dhapari', '6621', NULL, NULL),
(1073, 5, 22, 'Ishwardi', 130, 'Ishwardi', '6620', NULL, NULL),
(1074, 5, 22, 'Ishwardi', 130, 'Pakshi', '6622', NULL, NULL),
(1075, 5, 22, 'Ishwardi', 130, 'Rajapur', '6623', NULL, NULL),
(1076, 5, 22, 'Pabna Sadar', 130, 'Hamayetpur', '6602', NULL, NULL),
(1077, 5, 22, 'Pabna Sadar', 130, 'Kaliko Cotton Mills', '6601', NULL, NULL),
(1078, 5, 22, 'Pabna Sadar', 130, 'Pabna Sadar', '6600', NULL, NULL),
(1079, 5, 22, 'Sathia', 130, 'Sathia', '6670', NULL, NULL),
(1080, 5, 22, 'Sujanagar', 130, 'Sagarkandi', '6661', NULL, NULL),
(1081, 5, 22, 'Sujanagar', 130, 'Sujanagar', '6660', NULL, NULL),
(1082, 5, 24, 'Bagha', 130, 'Arani', '6281', NULL, NULL),
(1083, 5, 24, 'Bagha', 130, 'Bagha', '6280', NULL, NULL),
(1084, 5, 24, 'Bhabaniganj', 130, 'Bhabaniganj', '6250', NULL, NULL),
(1085, 5, 24, 'Bhabaniganj', 130, 'Taharpur', '6251', NULL, NULL),
(1086, 5, 24, 'Charghat', 130, 'Charghat', '6270', NULL, NULL),
(1087, 5, 24, 'Charghat', 130, 'Sarda', '6271', NULL, NULL),
(1088, 5, 24, 'Durgapur', 130, 'Durgapur', '6240', NULL, NULL),
(1089, 5, 24, 'Godagari', 130, 'Godagari', '6290', NULL, NULL),
(1090, 5, 24, 'Godagari', 130, 'Premtoli', '6291', NULL, NULL),
(1091, 5, 24, 'Khod Mohanpur', 130, 'Khodmohanpur', '6220', NULL, NULL),
(1092, 5, 24, 'Lalitganj', 130, 'Lalitganj', '6210', NULL, NULL),
(1093, 5, 24, 'Lalitganj', 130, 'Rajshahi Sugar Mills', '6211', NULL, NULL),
(1094, 5, 24, 'Lalitganj', 130, 'Shyampur', '6212', NULL, NULL),
(1095, 5, 24, 'Putia', 130, 'Putia', '6260', NULL, NULL),
(1096, 5, 24, 'Rajshahi Sadar', 130, 'Binodpur Bazar', '6206', NULL, NULL),
(1097, 5, 24, 'Rajshahi Sadar', 130, 'Ghuramara', '6100', NULL, NULL),
(1098, 5, 24, 'Rajshahi Sadar', 130, 'Kazla', '6204', NULL, NULL),
(1099, 5, 24, 'Rajshahi Sadar', 130, 'Rajshahi Canttonment', '6202', NULL, NULL),
(1100, 5, 24, 'Rajshahi Sadar', 130, 'Rajshahi Court', '6201', NULL, NULL),
(1101, 5, 24, 'Rajshahi Sadar', 130, 'Rajshahi Sadar', '6000', NULL, NULL),
(1102, 5, 24, 'Rajshahi Sadar', 130, 'Rajshahi University', '6205', NULL, NULL),
(1103, 5, 24, 'Rajshahi Sadar', 130, 'Sapura', '6203', NULL, NULL),
(1104, 5, 24, 'Tanor', 130, 'Tanor', '6230', NULL, NULL),
(1105, 5, 25, 'Baiddya Jam Toil', 130, 'Baiddya Jam Toil', '6730', NULL, NULL),
(1106, 5, 25, 'Belkuchi', 130, 'Belkuchi', '6740', NULL, NULL),
(1107, 5, 25, 'Belkuchi', 130, 'Enayetpur', '6751', NULL, NULL),
(1108, 5, 25, 'Belkuchi', 130, 'Rajapur', '6742', NULL, NULL),
(1109, 5, 25, 'Belkuchi', 130, 'Sohagpur', '6741', NULL, NULL),
(1110, 5, 25, 'Belkuchi', 130, 'Sthal', '6752', NULL, NULL),
(1111, 5, 25, 'Dhangora', 130, 'Dhangora', '6720', NULL, NULL),
(1112, 5, 25, 'Dhangora', 130, 'Malonga', '6721', NULL, NULL),
(1113, 5, 25, 'Kazipur', 130, 'Gandail', '6712', NULL, NULL),
(1114, 5, 25, 'Kazipur', 130, 'Kazipur', '6710', NULL, NULL),
(1115, 5, 25, 'Kazipur', 130, 'Shuvgachha', '6711', NULL, NULL),
(1116, 5, 25, 'Shahjadpur', 130, 'Jamirta', '6772', NULL, NULL),
(1117, 5, 25, 'Shahjadpur', 130, 'Kaijuri', '6773', NULL, NULL),
(1118, 5, 25, 'Shahjadpur', 130, 'Porjana', '6771', NULL, NULL),
(1119, 5, 25, 'Shahjadpur', 130, 'Shahjadpur', '6770', NULL, NULL),
(1120, 5, 25, 'Sirajganj Sadar', 130, 'Raipur', '6701', NULL, NULL),
(1121, 5, 25, 'Sirajganj Sadar', 130, 'Rashidabad', '6702', NULL, NULL),
(1122, 5, 25, 'Sirajganj Sadar', 130, 'Sirajganj Sadar', '6700', NULL, NULL),
(1123, 5, 25, 'Tarash', 130, 'Tarash', '6780', NULL, NULL),
(1124, 5, 25, 'Ullapara', 130, 'Lahiri Mohanpur', '6762', NULL, NULL),
(1125, 5, 25, 'Ullapara', 130, 'Salap', '6763', NULL, NULL),
(1126, 5, 25, 'Ullapara', 130, 'Ullapara', '6760', NULL, NULL),
(1127, 5, 25, 'Ullapara', 130, 'Ullapara R.S', '6761', NULL, NULL),
(1128, 6, 26, 'Bangla Hili', 130, 'Bangla Hili', '5270', NULL, NULL),
(1129, 6, 26, 'Biral', 130, 'Biral', '5210', NULL, NULL),
(1130, 6, 26, 'Birampur', 130, 'Birampur', '5266', NULL, NULL),
(1131, 6, 26, 'Birganj', 130, 'Birganj', '5220', NULL, NULL),
(1132, 6, 26, 'Chrirbandar', 130, 'Chrirbandar', '5240', NULL, NULL),
(1133, 6, 26, 'Chrirbandar', 130, 'Ranirbandar', '5241', NULL, NULL),
(1134, 6, 26, 'Dinajpur Sadar', 130, 'Dinajpur Rajbari', '5201', NULL, NULL),
(1135, 6, 26, 'Dinajpur Sadar', 130, 'Dinajpur Sadar', '5200', NULL, NULL),
(1136, 6, 26, 'Khansama', 130, 'Khansama', '5230', NULL, NULL),
(1137, 6, 26, 'Khansama', 130, 'Pakarhat', '5231', NULL, NULL),
(1138, 6, 26, 'Maharajganj', 130, 'Maharajganj', '5226', NULL, NULL),
(1139, 6, 26, 'Nababganj', 130, 'Daudpur', '5281', NULL, NULL),
(1140, 6, 26, 'Nababganj', 130, 'Gopalpur', '5282', NULL, NULL),
(1141, 6, 26, 'Nababganj', 130, 'Nababganj', '5280', NULL, NULL),
(1142, 6, 26, 'Osmanpur', 130, 'Ghoraghat', '5291', NULL, NULL),
(1143, 6, 26, 'Osmanpur', 130, 'Osmanpur', '5290', NULL, NULL),
(1144, 6, 26, 'Parbatipur', 130, 'Parbatipur', '5250', NULL, NULL),
(1145, 6, 26, 'Phulbari', 130, 'Phulbari', '5260', NULL, NULL),
(1146, 6, 26, 'Setabganj', 130, 'Setabganj', '5216', NULL, NULL),
(1147, 6, 27, 'Bonarpara', 130, 'Bonarpara', '5750', NULL, NULL),
(1148, 6, 27, 'Bonarpara', 130, 'saghata', '5751', NULL, NULL),
(1149, 6, 27, 'Gaibandha Sadar', 130, 'Gaibandha Sadar', '5700', NULL, NULL),
(1150, 6, 27, 'Gobindaganj', 130, 'Gobindhaganj', '5740', NULL, NULL),
(1151, 6, 27, 'Gobindaganj', 130, 'Mahimaganj', '5741', NULL, NULL),
(1152, 6, 27, 'Palashbari', 130, 'Palashbari', '5730', NULL, NULL),
(1153, 6, 27, 'Phulchhari', 130, 'Bharatkhali', '5761', NULL, NULL),
(1154, 6, 27, 'Phulchhari', 130, 'Phulchhari', '5760', NULL, NULL),
(1155, 6, 27, 'Saadullapur', 130, 'Naldanga', '5711', NULL, NULL),
(1156, 6, 27, 'Saadullapur', 130, 'Saadullapur', '5710', NULL, NULL),
(1157, 6, 27, 'Sundarganj', 130, 'Bamandanga', '5721', NULL, NULL),
(1158, 6, 27, 'Sundarganj', 130, 'Sundarganj', '5720', NULL, NULL),
(1159, 6, 28, 'Bhurungamari', 130, 'Bhurungamari', '5670', NULL, NULL),
(1160, 6, 28, 'Chilmari', 130, 'Chilmari', '5630', NULL, NULL),
(1161, 6, 28, 'Chilmari', 130, 'Jorgachh', '5631', NULL, NULL),
(1162, 6, 28, 'Kurigram Sadar', 130, 'Kurigram Sadar', '5600', NULL, NULL),
(1163, 6, 28, 'Kurigram Sadar', 130, 'Pandul', '5601', NULL, NULL),
(1164, 6, 28, 'Kurigram Sadar', 130, 'Phulbari', '5680', NULL, NULL),
(1165, 6, 28, 'Nageshwar', 130, 'Nageshwar', '5660', NULL, NULL),
(1166, 6, 28, 'Rajarhat', 130, 'Nazimkhan', '5611', NULL, NULL),
(1167, 6, 28, 'Rajarhat', 130, 'Rajarhat', '5610', NULL, NULL),
(1168, 6, 28, 'Rajibpur', 130, 'Rajibpur', '5650', NULL, NULL),
(1169, 6, 28, 'Roumari', 130, 'Roumari', '5640', NULL, NULL),
(1170, 6, 28, 'Ulipur', 130, 'Bazarhat', '5621', NULL, NULL),
(1171, 6, 28, 'Ulipur', 130, 'Ulipur', '5620', NULL, NULL),
(1172, 6, 29, 'Aditmari', 130, 'Aditmari', '5510', NULL, NULL),
(1173, 6, 29, 'Hatibandha', 130, 'Hatibandha', '5530', NULL, NULL),
(1174, 6, 29, 'Lalmonirhat Sadar', 130, 'Kulaghat SO', '5502', NULL, NULL),
(1175, 6, 29, 'Lalmonirhat Sadar', 130, 'Lalmonirhat Sadar', '5500', NULL, NULL),
(1176, 6, 29, 'Lalmonirhat Sadar', 130, 'Moghalhat', '5501', NULL, NULL),
(1177, 6, 29, 'Patgram', 130, 'Baura', '5541', NULL, NULL),
(1178, 6, 29, 'Patgram', 130, 'Burimari', '5542', NULL, NULL),
(1179, 6, 29, 'Patgram', 130, 'Patgram', '5540', NULL, NULL),
(1180, 6, 29, 'Tushbhandar', 130, 'Tushbhandar', '5520', NULL, NULL),
(1181, 6, 30, 'Dimla', 130, 'Dimla', '5350', NULL, NULL),
(1182, 6, 30, 'Dimla', 130, 'Ghaga Kharibari', '5351', NULL, NULL),
(1183, 6, 30, 'Domar', 130, 'Chilahati', '5341', NULL, NULL),
(1184, 6, 30, 'Domar', 130, 'Domar', '5340', NULL, NULL),
(1185, 6, 30, 'Jaldhaka', 130, 'Jaldhaka', '5330', NULL, NULL),
(1186, 6, 30, 'Kishoriganj', 130, 'Kishoriganj', '5320', NULL, NULL),
(1187, 6, 30, 'Nilphamari Sadar', 130, 'Nilphamari Sadar', '5300', NULL, NULL),
(1188, 6, 30, 'Nilphamari Sadar', 130, 'Nilphamari Sugar Mil', '5301', NULL, NULL),
(1189, 6, 30, 'Syedpur', 130, 'Syedpur', '5310', NULL, NULL),
(1190, 6, 30, 'Syedpur', 130, 'Syedpur Upashahar', '5311', NULL, NULL),
(1191, 6, 31, 'Boda', 130, 'Boda', '5010', NULL, NULL),
(1192, 6, 31, 'Chotto Dab', 130, 'Chotto Dab', '5040', NULL, NULL),
(1193, 6, 31, 'Chotto Dab', 130, 'Mirjapur', '5041', NULL, NULL),
(1194, 6, 31, 'Dabiganj', 130, 'Dabiganj', '5020', NULL, NULL),
(1195, 6, 31, 'Panchagarh Sadar', 130, 'Panchagarh Sadar', '5000', NULL, NULL),
(1196, 6, 31, 'Tetulia', 130, 'Tetulia', '5030', NULL, NULL),
(1197, 6, 32, 'Badarganj', 130, 'Badarganj', '5430', NULL, NULL),
(1198, 6, 32, 'Badarganj', 130, 'Shyampur', '5431', NULL, NULL),
(1199, 6, 32, 'Gangachara', 130, 'Gangachara', '5410', NULL, NULL),
(1200, 6, 32, 'Kaunia', 130, 'Haragachh', '5441', NULL, NULL),
(1201, 6, 32, 'Kaunia', 130, 'Kaunia', '5440', NULL, NULL),
(1202, 6, 32, 'Mithapukur', 130, 'Mithapukur', '5460', NULL, NULL),
(1203, 6, 32, 'Pirgachha', 130, 'Pirgachha', '5450', NULL, NULL),
(1204, 6, 32, 'Rangpur Sadar', 130, 'Alamnagar', '5402', NULL, NULL),
(1205, 6, 32, 'Rangpur Sadar', 130, 'Mahiganj', '5403', NULL, NULL),
(1206, 6, 32, 'Rangpur Sadar', 130, 'Rangpur Cadet Colleg', '5404', NULL, NULL),
(1207, 6, 32, 'Rangpur Sadar', 130, 'Rangpur Carmiecal Col', '5405', NULL, NULL),
(1208, 6, 32, 'Rangpur Sadar', 130, 'Rangpur Sadar', '5400', NULL, NULL),
(1209, 6, 32, 'Rangpur Sadar', 130, 'Rangpur Upa-Shahar', '5401', NULL, NULL),
(1210, 6, 32, 'Taraganj', 130, 'Taraganj', '5420', NULL, NULL),
(1211, 6, 33, 'Baliadangi', 130, 'Baliadangi', '5140', NULL, NULL),
(1212, 6, 33, 'Baliadangi', 130, 'Lahiri', '5141', NULL, NULL),
(1213, 6, 33, 'Jibanpur', 130, 'Jibanpur', '5130', NULL, NULL),
(1214, 6, 33, 'Pirganj', 130, 'Pirganj', '5110', NULL, NULL),
(1215, 6, 33, 'Pirganj', 130, 'Pirganj', '5470', NULL, NULL),
(1216, 6, 33, 'Rani Sankail', 130, 'Nekmarad', '5121', NULL, NULL),
(1217, 6, 33, 'Rani Sankail', 130, 'Rani Sankail', '5120', NULL, NULL),
(1218, 6, 33, 'Thakurgaon Sadar', 130, 'Ruhia', '5103', NULL, NULL),
(1219, 6, 33, 'Thakurgaon Sadar', 130, 'Shibganj', '5102', NULL, NULL),
(1220, 6, 33, 'Thakurgaon Sadar', 130, 'Thakurgaon Road', '5101', NULL, NULL),
(1221, 6, 33, 'Thakurgaon Sadar', 130, 'Thakurgaon Sadar', '5100', NULL, NULL),
(1222, 7, 51, 'Azmireeganj', 130, 'Azmireeganj', '3360', NULL, NULL),
(1223, 7, 51, 'Bahubal', 130, 'Bahubal', '3310', NULL, NULL),
(1224, 7, 51, 'Baniachang', 130, 'Baniachang', '3350', NULL, NULL),
(1225, 7, 51, 'Baniachang', 130, 'Jatrapasha', '3351', NULL, NULL),
(1226, 7, 51, 'Baniachang', 130, 'Kadirganj', '3352', NULL, NULL),
(1227, 7, 51, 'Chunarughat', 130, 'Chandpurbagan', '3321', NULL, NULL),
(1228, 7, 51, 'Chunarughat', 130, 'Chunarughat', '3320', NULL, NULL),
(1229, 7, 51, 'Chunarughat', 130, 'Narapati', '3322', NULL, NULL),
(1230, 7, 51, 'Hobiganj Sadar', 130, 'Gopaya', '3302', NULL, NULL),
(1231, 7, 51, 'Hobiganj Sadar', 130, 'Hobiganj Sadar', '3300', NULL, NULL),
(1232, 7, 51, 'Hobiganj Sadar', 130, 'Shaestaganj', '3301', NULL, NULL),
(1233, 7, 51, 'Kalauk', 130, 'Kalauk', '3340', NULL, NULL),
(1234, 7, 51, 'Kalauk', 130, 'Lakhai', '3341', NULL, NULL),
(1235, 7, 51, 'Madhabpur', 130, 'Itakhola', '3331', NULL, NULL),
(1236, 7, 51, 'Madhabpur', 130, 'Madhabpur', '3330', NULL, NULL),
(1237, 7, 51, 'Madhabpur', 130, 'Saihamnagar', '3333', NULL, NULL),
(1238, 7, 51, 'Madhabpur', 130, 'Shahajibazar', '3332', NULL, NULL),
(1239, 7, 51, 'Nabiganj', 130, 'Digalbak', '3373', NULL, NULL),
(1240, 7, 51, 'Nabiganj', 130, 'Golduba', '3372', NULL, NULL),
(1241, 7, 51, 'Nabiganj', 130, 'Goplarbazar', '3371', NULL, NULL),
(1242, 7, 51, 'Nabiganj', 130, 'Inathganj', '3374', NULL, NULL),
(1243, 7, 51, 'Nabiganj', 130, 'Nabiganj', '3370', NULL, NULL),
(1244, 7, 52, 'Baralekha', 130, 'Baralekha', '3250', NULL, NULL),
(1245, 7, 52, 'Baralekha', 130, 'Dhakkhinbag', '3252', NULL, NULL),
(1246, 7, 52, 'Baralekha', 130, 'Juri', '3251', NULL, NULL),
(1247, 7, 52, 'Baralekha', 130, 'Purbashahabajpur', '3253', NULL, NULL),
(1248, 7, 52, 'Kamalganj', 130, 'Kamalganj', '3220', NULL, NULL),
(1249, 7, 52, 'Kamalganj', 130, 'Keramatnaga', '3221', NULL, NULL),
(1250, 7, 52, 'Kamalganj', 130, 'Munshibazar', '3224', NULL, NULL),
(1251, 7, 52, 'Kamalganj', 130, 'Patrakhola', '3222', NULL, NULL),
(1252, 7, 52, 'Kamalganj', 130, 'Shamsher Nagar', '3223', NULL, NULL),
(1253, 7, 52, 'Kulaura', 130, 'Baramchal', '3237', NULL, NULL),
(1254, 7, 52, 'Kulaura', 130, 'Kajaldhara', '3234', NULL, NULL),
(1255, 7, 52, 'Kulaura', 130, 'Karimpur', '3235', NULL, NULL),
(1256, 7, 52, 'Kulaura', 130, 'Kulaura', '3230', NULL, NULL),
(1257, 7, 52, 'Kulaura', 130, 'Langla', '3232', NULL, NULL),
(1258, 7, 52, 'Kulaura', 130, 'Prithimpasha', '3233', NULL, NULL),
(1259, 7, 52, 'Kulaura', 130, 'Tillagaon', '3231', NULL, NULL),
(1260, 7, 52, 'Moulvibazar Sadar', 130, 'Afrozganj', '3203', NULL, NULL),
(1261, 7, 52, 'Moulvibazar Sadar', 130, 'Barakapan', '3201', NULL, NULL),
(1262, 7, 52, 'Moulvibazar Sadar', 130, 'Monumukh', '3202', NULL, NULL),
(1263, 7, 52, 'Moulvibazar Sadar', 130, 'Moulvibazar Sadar', '3200', NULL, NULL),
(1264, 7, 52, 'Rajnagar', 130, 'Rajnagar', '3240', NULL, NULL),
(1265, 7, 52, 'Srimangal', 130, 'Kalighat', '3212', NULL, NULL),
(1266, 7, 52, 'Srimangal', 130, 'Khejurichhara', '3213', NULL, NULL),
(1267, 7, 52, 'Srimangal', 130, 'Narain Chora', '3211', NULL, NULL),
(1268, 7, 52, 'Srimangal', 130, 'Satgaon', '3214', NULL, NULL),
(1269, 7, 52, 'Srimangal', 130, 'Srimangal', '3210', NULL, NULL),
(1270, 7, 53, 'Bishamsarpur', 130, 'Bishamsapur', '3010', NULL, NULL),
(1271, 7, 53, 'Chhatak', 130, 'Chhatak', '3080', NULL, NULL),
(1272, 7, 53, 'Chhatak', 130, 'Chhatak Cement Facto', '3081', NULL, NULL),
(1273, 7, 53, 'Chhatak', 130, 'Chhatak Paper Mills', '3082', NULL, NULL),
(1274, 7, 53, 'Chhatak', 130, 'Chourangi Bazar', '3893', NULL, NULL),
(1275, 7, 53, 'Chhatak', 130, 'Gabindaganj', '3083', NULL, NULL),
(1276, 7, 53, 'Chhatak', 130, 'Gabindaganj Natun Ba', '3084', NULL, NULL),
(1277, 7, 53, 'Chhatak', 130, 'Islamabad', '3088', NULL, NULL),
(1278, 7, 53, 'Chhatak', 130, 'jahidpur', '3087', NULL, NULL),
(1279, 7, 53, 'Chhatak', 130, 'Khurma', '3085', NULL, NULL),
(1280, 7, 53, 'Chhatak', 130, 'Moinpur', '3086', NULL, NULL),
(1281, 7, 53, 'Dhirai Chandpur', 130, 'Dhirai Chandpur', '3040', NULL, NULL),
(1282, 7, 53, 'Dhirai Chandpur', 130, 'Jagdal', '3041', NULL, NULL),
(1283, 7, 53, 'Duara bazar', 130, 'Duara bazar', '3070', NULL, NULL),
(1284, 7, 53, 'Ghungiar', 130, 'Ghungiar', '3050', NULL, NULL),
(1285, 7, 53, 'Jagnnathpur', 130, 'Atuajan', '3062', NULL, NULL),
(1286, 7, 53, 'Jagnnathpur', 130, 'Hasan Fatemapur', '3063', NULL, NULL),
(1287, 7, 53, 'Jagnnathpur', 130, 'Jagnnathpur', '3060', NULL, NULL),
(1288, 7, 53, 'Jagnnathpur', 130, 'Rasulganj', '3064', NULL, NULL),
(1289, 7, 53, 'Jagnnathpur', 130, 'Shiramsi', '3065', NULL, NULL),
(1290, 7, 53, 'Jagnnathpur', 130, 'Syedpur', '3061', NULL, NULL),
(1291, 7, 53, 'Sachna', 130, 'Sachna', '3020', NULL, NULL),
(1292, 7, 53, 'Sunamganj Sadar', 130, 'Pagla', '3001', NULL, NULL),
(1293, 7, 53, 'Sunamganj Sadar', 130, 'Patharia', '3002', NULL, NULL),
(1294, 7, 53, 'Sunamganj Sadar', 130, 'Sunamganj Sadar', '3000', NULL, NULL),
(1295, 7, 53, 'Tahirpur', 130, 'Tahirpur', '3030', NULL, NULL),
(1296, 7, 54, 'Balaganj', 130, 'Balaganj', '3120', NULL, NULL),
(1297, 7, 54, 'Balaganj', 130, 'Begumpur', '3125', NULL, NULL),
(1298, 7, 54, 'Balaganj', 130, 'Brahman Shashon', '3122', NULL, NULL),
(1299, 7, 54, 'Balaganj', 130, 'Gaharpur', '3128', NULL, NULL),
(1300, 7, 54, 'Balaganj', 130, 'Goala Bazar', '3124', NULL, NULL),
(1301, 7, 54, 'Balaganj', 130, 'Karua', '3121', NULL, NULL),
(1302, 7, 54, 'Balaganj', 130, 'Kathal Khair', '3127', NULL, NULL),
(1303, 7, 54, 'Balaganj', 130, 'Natun Bazar', '3129', NULL, NULL),
(1304, 7, 54, 'Balaganj', 130, 'Omarpur', '3126', NULL, NULL),
(1305, 7, 54, 'Balaganj', 130, 'Tajpur', '3123', NULL, NULL),
(1306, 7, 54, 'Bianibazar', 130, 'Bianibazar', '3170', NULL, NULL),
(1307, 7, 54, 'Bianibazar', 130, 'Churkai', '3175', NULL, NULL),
(1308, 7, 54, 'Bianibazar', 130, 'jaldup', '3171', NULL, NULL),
(1309, 7, 54, 'Bianibazar', 130, 'Kurar bazar', '3173', NULL, NULL),
(1310, 7, 54, 'Bianibazar', 130, 'Mathiura', '3172', NULL, NULL),
(1311, 7, 54, 'Bianibazar', 130, 'Salia bazar', '3174', NULL, NULL),
(1312, 7, 54, 'Bishwanath', 130, 'Bishwanath', '3130', NULL, NULL),
(1313, 7, 54, 'Bishwanath', 130, 'Dashghar', '3131', NULL, NULL),
(1314, 7, 54, 'Bishwanath', 130, 'Deokalas', '3133', NULL, NULL),
(1315, 7, 54, 'Bishwanath', 130, 'Doulathpur', '3132', NULL, NULL),
(1316, 7, 54, 'Bishwanath', 130, 'Singer kanch', '3134', NULL, NULL),
(1317, 7, 54, 'Fenchuganj', 130, 'Fenchuganj', '3116', NULL, NULL),
(1318, 7, 54, 'Fenchuganj', 130, 'Fenchuganj SareKarkh', '3117', NULL, NULL),
(1319, 7, 54, 'Jaintapur', 130, 'Chiknagul', '3152', NULL, NULL),
(1320, 7, 54, 'Gowainghat', 130, 'Gowainghat', '3150', NULL, NULL),
(1321, 7, 54, 'Gowainghat', 130, 'Jaflong', '3151', NULL, NULL),
(1322, 7, 54, 'Gopalganj', 130, 'banigram', '3164', NULL, NULL),
(1323, 7, 54, 'Gopalganj', 130, 'Chandanpur', '3165', NULL, NULL),
(1324, 7, 54, 'Gopalganj', 130, 'Dakkhin Bhadashore', '3162', NULL, NULL),
(1325, 7, 54, 'Gopalganj', 130, 'Dhaka Dakkhin', '3161', NULL, NULL),
(1326, 7, 54, 'Gopalganj', 130, 'Gopalgannj', '3160', NULL, NULL),
(1327, 7, 54, 'Gopalganj', 130, 'Ranaping', '3163', NULL, NULL),
(1328, 7, 54, 'Jaintapur', 130, 'Jaintapur', '3156', NULL, NULL),
(1329, 7, 54, 'Jakiganj', 130, 'Ichhamati', '3191', NULL, NULL),
(1330, 7, 54, 'Jakiganj', 130, 'Jakiganj', '3190', NULL, NULL),
(1331, 7, 54, 'Kanaighat', 130, 'Chatulbazar', '3181', NULL, NULL),
(1332, 7, 54, 'Kanaighat', 130, 'Gachbari', '3183', NULL, NULL),
(1333, 7, 54, 'Kanaighat', 130, 'Kanaighat', '3180', NULL, NULL),
(1334, 7, 54, 'Kanaighat', 130, 'Manikganj', '3182', NULL, NULL),
(1335, 7, 54, 'Kompanyganj', 130, 'Kompanyganj', '3140', NULL, NULL),
(1336, 7, 54, 'Sylhet Sadar', 130, 'Birahimpur', '3106', NULL, NULL),
(1337, 7, 54, 'Sylhet Sadar', 130, 'Jalalabad', '3107', NULL, NULL),
(1338, 7, 54, 'Sylhet Sadar', 130, 'Jalalabad Cantoment', '3104', NULL, NULL),
(1339, 7, 54, 'Sylhet Sadar', 130, 'Kadamtali', '3111', NULL, NULL),
(1340, 7, 54, 'Sylhet Sadar', 130, 'Kamalbazer', '3112', NULL, NULL),
(1341, 7, 54, 'Sylhet Sadar', 130, 'Khadimnagar', '3103', NULL, NULL),
(1342, 7, 54, 'Sylhet Sadar', 130, 'Lalbazar', '3113', NULL, NULL),
(1343, 7, 54, 'Sylhet Sadar', 130, 'Mogla', '3108', NULL, NULL),
(1344, 7, 54, 'Sylhet Sadar', 130, 'Ranga Hajiganj', '3109', NULL, NULL),
(1345, 7, 54, 'Sylhet Sadar', 130, 'Shahajalal Science &', '3114', NULL, NULL),
(1346, 7, 54, 'Sylhet Sadar', 130, 'Silam', '3105', NULL, NULL),
(1347, 7, 54, 'Sylhet Sadar', 130, 'Sylhe Sadar', '3100', NULL, NULL),
(1348, 7, 54, 'Sylhet Sadar', 130, 'Sylhet Biman Bondar', '3102', NULL, NULL),
(1349, 7, 54, 'Sylhet Sadar', 130, 'Sylhet Cadet Col', '3101', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `raw_price` varchar(255) DEFAULT NULL,
  `regular_price` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `sku` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `brand_id`, `category_id`, `supplier_id`, `raw_price`, `regular_price`, `description`, `sku`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(27, 'Koohen Premium Punjabi - SA01', 2, 10, 2, '1157', '1750', '<p><span style=\"font-size: 16px; font-weight: 400;\">Fabric Type: Cotton</span></p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable </p><p>Durability: Durable and long-lasting<br></p>', 'KHPP - SA01', 'koohen-premium-punjabi-sa01', 'active', '2024-03-22 20:12:00', '2024-05-13 11:49:16'),
(28, 'Koohen Premium Punjabi - SA02', 2, 10, 2, '157', '1750', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHPP - SA02', 'koohen-premium-punjabi-sa02', 'active', '2024-03-22 20:19:25', '2024-05-13 11:49:38'),
(29, 'Koohen Premium Punjabi - SA03', 2, 10, 2, '1291', '2250', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHPP - SA03', 'koohen-premium-punjabi-sa03', 'active', '2024-03-22 20:23:44', '2024-05-13 11:50:05'),
(31, 'Koohen Premium Punjabi - SA04', 2, 10, 2, '831', '1450', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHPP - SA04', 'koohen-premium-punjabi-sa04', 'active', '2024-03-22 20:49:37', '2024-05-13 11:50:23'),
(32, 'Koohen Premium Punjabi - SA05', 2, 10, 2, '831', '1450', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHPP - SA05', 'koohen-premium-punjabi-sa05', 'active', '2024-03-22 20:53:24', '2024-05-13 11:50:39'),
(33, 'Koohen Premium Punjabi - SA06', 2, 10, 2, '791', '1750', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHPP - SA06', 'koohen-premium-punjabi-sa06', 'active', '2024-03-22 20:59:12', '2024-05-13 11:51:02'),
(34, 'Koohen Standard Punjabi - SA07', 2, 13, 2, '925.56', '1450', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHSP - SA07', 'koohen-standard-punjabi-sa07', 'active', '2024-03-22 21:02:47', '2024-05-13 11:47:56'),
(35, 'Koohen Standard Punjabi - SA08', 2, 13, 2, '889', '1450', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHSP - SA08', 'koohen-standard-punjabi-sa08', 'active', '2024-03-22 21:12:59', '2024-05-13 11:48:03'),
(36, 'Koohen Standard Punjabi - SA09', 2, 13, 2, '753.22', '1750', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHSP - SA09', 'koohen-standard-punjabi-sa09', 'active', '2024-03-22 21:15:33', '2024-05-13 11:51:59'),
(37, 'Koohen Standard Punjabi - SA10', 2, 13, 2, '753.61', '1450', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHSP - SA10', 'koohen-standard-punjabi-sa10', 'active', '2024-03-22 21:18:35', '2024-05-13 11:48:17'),
(38, 'Koohen Standard Punjabi - SA11', 2, 13, 2, '749.22', '1450', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHSP - SA11', 'koohen-standard-punjabi-sa11', 'active', '2024-03-22 21:21:24', '2024-05-13 11:48:26'),
(39, 'Koohen Standard Punjabi - SA12', 2, 13, 2, '781.72', '1450', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHSP - SA12', 'koohen-standard-punjabi-sa12', 'active', '2024-03-22 21:28:28', '2024-05-13 11:52:49'),
(40, 'Koohen Regular Punjabi - PR07', 2, 12, 2, '662', '1250', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHRP - PR07', 'koohen-regular-punjabi-pr07', 'active', '2024-03-22 21:35:16', '2024-05-13 11:53:25'),
(41, 'Koohen Regular Punjabi - PR06', 2, 12, 2, '662', '1250', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHRP - PR06', 'koohen-regular-punjabi-pr06', 'active', '2024-03-22 21:38:40', '2024-05-13 11:58:02'),
(42, 'Koohen Standard Punjabi - PR05', 2, 13, 2, '663', '1250', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHSP - PR05', 'koohen-standard-punjabi-pr05', 'active', '2024-03-22 21:43:38', '2024-05-13 11:45:50'),
(43, 'Koohen Standard Punjabi - PR04', 2, 13, 2, '663', '1250', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHSP - PR04', 'koohen-standard-punjabi-pr04', 'active', '2024-03-22 22:37:35', '2024-05-13 11:45:41'),
(44, 'Koohen Standard Punjabi - PR01', 2, 13, 2, '642', '1250', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHSP - PR01', 'koohen-standard-punjabi-pr01', 'active', '2024-03-22 22:46:38', '2024-05-13 11:45:30'),
(45, 'Koohen Standard Punjabi - PR02', 2, 13, 2, '642', '1250', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHSP - PR02', 'koohen-standard-punjabi-pr02', 'active', '2024-03-22 22:48:06', '2024-05-13 11:45:23'),
(46, 'Koohen Standard Punjabi - PR03', 2, 13, 2, '642', '1250', '<p>Fabric Type: Cotton</p><p>Type: Regular Fit</p><p>Breathability: Highly breathable and comfortable</p><p>Durability: Durable and long-lasting</p>', 'KHSP - PR03', 'koohen-standard-punjabi-pr03', 'active', '2024-03-22 22:49:07', '2024-05-13 11:45:04'),
(47, 'Koohen Regular Punjabi - PR08', 2, 12, 2, '567', '1250', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHRP - PR08', 'koohen-regular-punjabi-pr08', 'active', '2024-03-23 20:46:05', '2024-05-11 15:15:36'),
(48, 'Koohen Regular Punjabi - PR09', 2, 12, 2, '613.13', '1250', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHRP - PR09', 'koohen-regular-punjabi-pr09', 'active', '2024-03-23 20:49:10', '2024-05-11 15:16:02'),
(49, 'Koohen Regular Punjabi - PR10', 2, 12, 2, '613.2', '1250', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHRP - PR10', 'koohen-regular-punjabi-pr10', 'active', '2024-03-23 20:50:39', '2024-05-11 15:16:28'),
(50, 'Men\'s Premium Pajama - SW01', 2, 14, 2, '429.67', '950', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHMP-SW01', 'mens-premium-pajama-sw01', 'active', '2024-03-24 19:03:33', '2024-05-11 15:17:15'),
(52, 'Men\'s Standard Punjabi - SA14', 2, 13, 2, '920', '1750', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHSP-SA14', 'mens-standard-punjabi-sa14', 'active', '2024-05-09 12:50:38', '2024-05-15 07:49:26'),
(53, 'Men\'s Standard Punjabi - SA15', 2, 13, 2, '920', '1750', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHSP-SA15', 'mens-standard-punjabi-sa15', 'active', '2024-05-09 12:53:12', '2024-05-15 07:49:43'),
(55, 'Men\'s Premium Punjabi - SA16', 2, 10, 2, '970', '2250', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHPP-SA16', 'mens-premium-punjabi-sa16', 'active', '2024-05-09 13:10:20', '2024-05-15 07:50:07'),
(56, 'Men\'s Premium Punjabi - SA17', 2, 10, 2, '920', '1750', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHPP - SA17', 'mens-premium-punjabi-sa17', 'active', '2024-05-09 13:15:58', '2024-05-15 07:50:33'),
(57, 'Men\'s Standard Punjabi - PR11', 2, 13, 2, '702', '1250', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHSP - PR11', 'mens-standard-punjabi-pr11', 'active', '2024-05-09 13:30:29', '2024-05-15 07:50:53'),
(58, 'Men\'s Standard Punjabi - PR12', 2, 13, 2, '692', '1250', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHSP - PR12', 'koohen-standard-punjabi-pr12', 'active', '2024-05-09 17:03:10', '2024-05-15 07:51:20'),
(59, 'Women\'s Co-Ords Set - CRDS01', 2, 18, 2, '850', '1099', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHLD-CRDS01', 'womens-co-ords-set-crds01', 'active', '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(60, 'Women\'s Co-Ords Set - CRDS02', 2, 18, 2, '850', '1099', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHLD-CRDS02', 'womens-co-ords-set-crds02', 'active', '2024-05-13 07:38:05', '2024-05-13 07:38:05'),
(61, 'Women\'s Co-Ords Set - CRDS03', 2, 18, 2, '850', '1099', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHLD-CRDS03', 'womens-co-ords-set-crds03', 'active', '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(62, 'Women\'s Co-Ords Set - CRDS04', 2, 18, 2, '950', '1350', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHLD-CRDS04', 'womens-co-ords-set-crds04', 'active', '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(63, 'Women\'s Co-Ords Set - CRDS05', 2, 18, 2, '950', '1350', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHLD-CRDS05', 'womens-co-ords-set-crds05', 'active', '2024-05-13 07:45:07', '2024-05-13 07:45:07'),
(64, 'Women\'s Co-Ords Set - CRDS06', 2, 18, 2, '950', '1350', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHLD-CRDS06', 'womens-co-ords-set-crds06', 'active', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(65, 'Women\'s Kaftan Set - KFTN01', 2, 19, 2, '950', '1350', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHLD-KFTN01', 'womens-kaftan-set-kftn01', 'active', '2024-05-13 07:49:12', '2024-05-13 07:49:12'),
(67, 'Women\'s Kaftan Set - KFTN02', 2, 19, 2, '950', '1350', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHLD-KFTN02', 'womens-kaftan-set-kftn02', 'active', '2024-05-13 07:56:08', '2024-05-13 07:56:08'),
(68, 'Women\'s Kaftan Set - KFTN03', 2, 19, 2, '950', '1350', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHLD-KFTN03', 'womens-kaftan-set-kftn03', 'active', '2024-05-13 07:59:15', '2024-05-13 07:59:15'),
(69, 'Women\'s Kaftan Set - KFTN04', 2, 19, 2, '950', '1350', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHLD-KFTN04', 'womens-kaftan-set-kftn04', 'active', '2024-05-13 08:00:48', '2024-05-13 08:00:48'),
(70, 'Women\'s Kaftan Set - KFTN06', 2, 19, 2, '950', '1350', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHLD-KFTN05', 'womens-kaftan-set-kftn06', 'active', '2024-05-13 08:03:03', '2024-05-13 08:03:03'),
(71, 'Men\'s Premium Punjabi - SA13', 2, 10, 2, '1400', '2250', '<p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Fabric Type: Cotton</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Type: Regular Fit</p><p style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Breathability: Highly breathable and comfortable</p><p style=\"margin-bottom: 5px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 1rem; line-height: 24px; font-family: Roboto, sans-serif; color: rgb(70, 91, 82);\">Durability: Durable and long-lasting</p>', 'KHPP-SA13', 'mens-premium-punjabi-sa13', 'active', '2024-05-15 07:48:52', '2024-05-15 07:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `products_colors`
--

CREATE TABLE `products_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_colors`
--

INSERT INTO `products_colors` (`id`, `product_id`, `color_id`, `created_at`, `updated_at`) VALUES
(24, 27, 16, '2024-03-22 20:12:00', '2024-03-22 20:12:00'),
(25, 28, 6, '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(26, 29, 11, '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(27, 31, 15, '2024-03-22 20:49:37', '2024-03-22 20:49:37'),
(28, 32, 14, '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(29, 33, 19, '2024-03-22 20:59:12', '2024-03-22 20:59:12'),
(30, 34, 11, '2024-03-22 21:02:47', '2024-03-22 21:02:47'),
(31, 35, 10, '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(32, 36, 20, '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(33, 37, 21, '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(34, 38, 5, '2024-03-22 21:21:24', '2024-03-22 21:21:24'),
(35, 39, 16, '2024-03-22 21:28:28', '2024-03-22 21:28:28'),
(36, 40, 18, '2024-03-22 21:35:16', '2024-03-22 21:35:16'),
(37, 41, 19, '2024-03-22 21:38:40', '2024-03-22 21:38:40'),
(38, 42, 9, '2024-03-22 21:43:38', '2024-03-22 21:43:38'),
(39, 43, 20, '2024-03-22 22:37:35', '2024-03-22 22:37:35'),
(40, 44, 23, '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(41, 45, 22, '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(42, 46, 20, '2024-03-22 22:49:07', '2024-03-22 22:49:07'),
(43, 47, 9, '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(44, 48, 14, '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(45, 49, 5, '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(46, 50, 11, '2024-03-24 19:03:33', '2024-03-24 19:03:33'),
(48, 52, 25, '2024-05-09 12:50:38', '2024-05-09 12:50:38'),
(49, 53, 24, '2024-05-09 12:53:12', '2024-05-09 12:53:12'),
(51, 55, 18, '2024-05-09 13:10:20', '2024-05-09 13:10:20'),
(52, 56, 7, '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(53, 57, 23, '2024-05-09 13:30:29', '2024-05-09 13:30:29'),
(54, 58, 20, '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(55, 59, 26, '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(56, 60, 26, '2024-05-13 07:38:05', '2024-05-13 07:38:05'),
(57, 61, 26, '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(58, 62, 26, '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(59, 63, 26, '2024-05-13 07:45:07', '2024-05-13 07:45:07'),
(60, 64, 26, '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(61, 65, 26, '2024-05-13 07:49:12', '2024-05-13 07:49:12'),
(62, 67, 26, '2024-05-13 07:56:08', '2024-05-13 07:56:08'),
(63, 68, 26, '2024-05-13 07:59:15', '2024-05-13 07:59:15'),
(64, 69, 26, '2024-05-13 08:00:48', '2024-05-13 08:00:48'),
(65, 70, 26, '2024-05-13 08:03:03', '2024-05-13 08:03:03'),
(66, 71, 11, '2024-05-15 07:48:52', '2024-05-15 07:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `products_sizes`
--

CREATE TABLE `products_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_sizes`
--

INSERT INTO `products_sizes` (`id`, `product_id`, `size_id`, `created_at`, `updated_at`) VALUES
(46, 24, 6, '2024-02-07 10:20:35', '2024-02-07 10:20:35'),
(47, 24, 7, '2024-02-07 10:20:35', '2024-02-07 10:20:35'),
(48, 24, 8, '2024-02-07 10:20:35', '2024-02-07 10:20:35'),
(49, 25, 5, '2024-02-07 10:31:34', '2024-02-07 10:31:34'),
(50, 25, 6, '2024-02-07 10:31:34', '2024-02-07 10:31:34'),
(51, 25, 7, '2024-02-07 10:31:34', '2024-02-07 10:31:34'),
(52, 25, 8, '2024-02-07 10:31:34', '2024-02-07 10:31:34'),
(53, 26, 5, '2024-02-07 10:38:18', '2024-02-07 10:38:18'),
(54, 26, 6, '2024-02-07 10:38:18', '2024-02-07 10:38:18'),
(55, 26, 7, '2024-02-07 10:38:18', '2024-02-07 10:38:18'),
(56, 26, 8, '2024-02-07 10:38:18', '2024-02-07 10:38:18'),
(57, 27, 5, '2024-03-22 20:12:00', '2024-03-22 20:12:00'),
(58, 27, 6, '2024-03-22 20:12:00', '2024-03-22 20:12:00'),
(59, 27, 7, '2024-03-22 20:12:00', '2024-03-22 20:12:00'),
(60, 27, 8, '2024-03-22 20:12:00', '2024-03-22 20:12:00'),
(63, 28, 5, '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(64, 28, 6, '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(65, 28, 7, '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(66, 28, 8, '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(69, 29, 5, '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(70, 29, 6, '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(71, 29, 7, '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(72, 29, 8, '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(75, 31, 5, '2024-03-22 20:49:37', '2024-03-22 20:49:37'),
(76, 31, 6, '2024-03-22 20:49:37', '2024-03-22 20:49:37'),
(77, 31, 7, '2024-03-22 20:49:37', '2024-03-22 20:49:37'),
(78, 31, 8, '2024-03-22 20:49:37', '2024-03-22 20:49:37'),
(81, 32, 5, '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(82, 32, 6, '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(83, 32, 7, '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(84, 32, 8, '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(87, 33, 5, '2024-03-22 20:59:12', '2024-03-22 20:59:12'),
(88, 33, 6, '2024-03-22 20:59:12', '2024-03-22 20:59:12'),
(89, 33, 7, '2024-03-22 20:59:12', '2024-03-22 20:59:12'),
(90, 33, 8, '2024-03-22 20:59:12', '2024-03-22 20:59:12'),
(93, 34, 5, '2024-03-22 21:02:47', '2024-03-22 21:02:47'),
(94, 34, 6, '2024-03-22 21:02:47', '2024-03-22 21:02:47'),
(95, 34, 7, '2024-03-22 21:02:47', '2024-03-22 21:02:47'),
(96, 34, 8, '2024-03-22 21:02:47', '2024-03-22 21:02:47'),
(99, 35, 5, '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(100, 35, 6, '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(101, 35, 7, '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(102, 35, 8, '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(105, 36, 5, '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(106, 36, 6, '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(107, 36, 7, '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(108, 36, 8, '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(111, 37, 5, '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(112, 37, 6, '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(113, 37, 7, '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(114, 37, 8, '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(117, 38, 5, '2024-03-22 21:21:24', '2024-03-22 21:21:24'),
(118, 38, 6, '2024-03-22 21:21:24', '2024-03-22 21:21:24'),
(119, 38, 7, '2024-03-22 21:21:24', '2024-03-22 21:21:24'),
(120, 38, 8, '2024-03-22 21:21:24', '2024-03-22 21:21:24'),
(123, 39, 5, '2024-03-22 21:28:28', '2024-03-22 21:28:28'),
(124, 39, 6, '2024-03-22 21:28:28', '2024-03-22 21:28:28'),
(125, 39, 7, '2024-03-22 21:28:28', '2024-03-22 21:28:28'),
(126, 39, 8, '2024-03-22 21:28:28', '2024-03-22 21:28:28'),
(129, 40, 5, '2024-03-22 21:35:16', '2024-03-22 21:35:16'),
(130, 40, 6, '2024-03-22 21:35:16', '2024-03-22 21:35:16'),
(131, 40, 7, '2024-03-22 21:35:16', '2024-03-22 21:35:16'),
(132, 40, 8, '2024-03-22 21:35:16', '2024-03-22 21:35:16'),
(135, 41, 5, '2024-03-22 21:38:40', '2024-03-22 21:38:40'),
(136, 41, 6, '2024-03-22 21:38:40', '2024-03-22 21:38:40'),
(137, 41, 7, '2024-03-22 21:38:40', '2024-03-22 21:38:40'),
(138, 41, 8, '2024-03-22 21:38:40', '2024-03-22 21:38:40'),
(141, 42, 5, '2024-03-22 21:43:38', '2024-03-22 21:43:38'),
(142, 42, 6, '2024-03-22 21:43:38', '2024-03-22 21:43:38'),
(143, 42, 7, '2024-03-22 21:43:38', '2024-03-22 21:43:38'),
(144, 42, 8, '2024-03-22 21:43:38', '2024-03-22 21:43:38'),
(148, 43, 6, '2024-03-22 22:37:35', '2024-03-22 22:37:35'),
(149, 43, 7, '2024-03-22 22:37:35', '2024-03-22 22:37:35'),
(150, 43, 8, '2024-03-22 22:37:35', '2024-03-22 22:37:35'),
(153, 44, 5, '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(154, 44, 6, '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(155, 44, 7, '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(156, 44, 8, '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(159, 45, 5, '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(160, 45, 6, '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(161, 45, 7, '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(162, 45, 8, '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(165, 46, 5, '2024-03-22 22:49:07', '2024-03-22 22:49:07'),
(166, 46, 6, '2024-03-22 22:49:07', '2024-03-22 22:49:07'),
(167, 46, 7, '2024-03-22 22:49:07', '2024-03-22 22:49:07'),
(168, 46, 8, '2024-03-22 22:49:07', '2024-03-22 22:49:07'),
(171, 47, 5, '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(172, 47, 6, '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(173, 47, 7, '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(174, 47, 8, '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(175, 48, 5, '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(176, 48, 6, '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(177, 48, 7, '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(178, 48, 8, '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(179, 49, 5, '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(180, 49, 6, '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(181, 49, 7, '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(182, 49, 8, '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(183, 50, 5, '2024-03-24 19:03:33', '2024-03-24 19:03:33'),
(184, 50, 6, '2024-03-24 19:03:33', '2024-03-24 19:03:33'),
(185, 50, 7, '2024-03-24 19:03:33', '2024-03-24 19:03:33'),
(190, 52, 5, '2024-05-09 12:50:38', '2024-05-09 12:50:38'),
(191, 52, 6, '2024-05-09 12:50:38', '2024-05-09 12:50:38'),
(192, 52, 7, '2024-05-09 12:50:38', '2024-05-09 12:50:38'),
(193, 52, 8, '2024-05-09 12:50:38', '2024-05-09 12:50:38'),
(194, 53, 5, '2024-05-09 12:53:12', '2024-05-09 12:53:12'),
(195, 53, 6, '2024-05-09 12:53:12', '2024-05-09 12:53:12'),
(196, 53, 7, '2024-05-09 12:53:12', '2024-05-09 12:53:12'),
(197, 53, 8, '2024-05-09 12:53:12', '2024-05-09 12:53:12'),
(202, 55, 5, '2024-05-09 13:10:20', '2024-05-09 13:10:20'),
(203, 55, 6, '2024-05-09 13:10:20', '2024-05-09 13:10:20'),
(204, 55, 7, '2024-05-09 13:10:20', '2024-05-09 13:10:20'),
(205, 55, 8, '2024-05-09 13:10:20', '2024-05-09 13:10:20'),
(206, 56, 5, '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(207, 56, 6, '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(208, 56, 7, '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(209, 56, 8, '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(210, 57, 5, '2024-05-09 13:30:29', '2024-05-09 13:30:29'),
(211, 57, 6, '2024-05-09 13:30:29', '2024-05-09 13:30:29'),
(212, 57, 7, '2024-05-09 13:30:29', '2024-05-09 13:30:29'),
(213, 57, 8, '2024-05-09 13:30:29', '2024-05-09 13:30:29'),
(214, 43, 18, NULL, NULL),
(215, 58, 6, '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(216, 58, 7, '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(217, 58, 8, '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(218, 58, 18, '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(219, 48, 18, NULL, NULL),
(220, 49, 18, NULL, NULL),
(221, 59, 26, '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(222, 59, 27, '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(223, 59, 28, '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(224, 60, 26, '2024-05-13 07:38:05', '2024-05-13 07:38:05'),
(225, 60, 27, '2024-05-13 07:38:05', '2024-05-13 07:38:05'),
(226, 60, 28, '2024-05-13 07:38:05', '2024-05-13 07:38:05'),
(227, 61, 26, '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(228, 61, 27, '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(229, 61, 28, '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(230, 62, 26, '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(231, 62, 27, '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(232, 62, 28, '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(233, 63, 26, '2024-05-13 07:45:07', '2024-05-13 07:45:07'),
(234, 63, 27, '2024-05-13 07:45:07', '2024-05-13 07:45:07'),
(235, 63, 28, '2024-05-13 07:45:07', '2024-05-13 07:45:07'),
(236, 64, 26, '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(237, 64, 27, '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(238, 64, 28, '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(251, 70, 31, '2024-05-13 08:03:03', '2024-05-13 08:03:03'),
(252, 69, 31, NULL, NULL),
(253, 68, 31, NULL, NULL),
(254, 67, 31, NULL, NULL),
(255, 65, 31, NULL, NULL),
(256, 71, 6, '2024-05-15 07:48:52', '2024-05-15 07:48:52'),
(257, 71, 7, '2024-05-15 07:48:52', '2024-05-15 07:48:52'),
(258, 71, 8, '2024-05-15 07:48:52', '2024-05-15 07:48:52'),
(259, 71, 18, '2024-05-15 07:48:52', '2024-05-15 07:48:52'),
(260, 71, 19, '2024-05-15 07:48:52', '2024-05-15 07:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_additionalinfos`
--

CREATE TABLE `product_additionalinfos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `additional_name` varchar(255) DEFAULT NULL,
  `additional_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_additionalinfos`
--

INSERT INTO `product_additionalinfos` (`id`, `product_id`, `additional_name`, `additional_value`, `created_at`, `updated_at`) VALUES
(86, 21, 'Frame :', NULL, '2024-02-07 10:10:00', '2024-02-07 10:10:00'),
(87, 21, 'Weight Capacity :', NULL, '2024-02-07 10:10:00', '2024-02-07 10:10:00'),
(88, 21, 'Width :', NULL, '2024-02-07 10:10:00', '2024-02-07 10:10:00'),
(89, 21, 'Height :', NULL, '2024-02-07 10:10:00', '2024-02-07 10:10:00'),
(90, 21, 'Wheels :', NULL, '2024-02-07 10:10:00', '2024-02-07 10:10:00'),
(91, 22, 'Frame :', NULL, '2024-02-07 10:13:39', '2024-02-07 10:13:39'),
(92, 22, 'Weight Capacity :', NULL, '2024-02-07 10:13:39', '2024-02-07 10:13:39'),
(93, 22, 'Width :', NULL, '2024-02-07 10:13:39', '2024-02-07 10:13:39'),
(94, 22, 'Height :', NULL, '2024-02-07 10:13:39', '2024-02-07 10:13:39'),
(95, 22, 'Wheels :', NULL, '2024-02-07 10:13:39', '2024-02-07 10:13:39'),
(96, 23, 'Frame :', NULL, '2024-02-07 10:15:50', '2024-02-07 10:15:50'),
(97, 23, 'Weight Capacity :', NULL, '2024-02-07 10:15:50', '2024-02-07 10:15:50'),
(98, 23, 'Width :', NULL, '2024-02-07 10:15:50', '2024-02-07 10:15:50'),
(99, 23, 'Height :', NULL, '2024-02-07 10:15:50', '2024-02-07 10:15:50'),
(100, 23, 'Wheels :', NULL, '2024-02-07 10:15:50', '2024-02-07 10:15:50'),
(101, 24, 'Frame :', NULL, '2024-02-07 10:20:40', '2024-02-07 10:20:40'),
(102, 24, 'Weight Capacity :', NULL, '2024-02-07 10:20:40', '2024-02-07 10:20:40'),
(103, 24, 'Width :', NULL, '2024-02-07 10:20:40', '2024-02-07 10:20:40'),
(104, 24, 'Height :', NULL, '2024-02-07 10:20:40', '2024-02-07 10:20:40'),
(105, 24, 'Wheels :', NULL, '2024-02-07 10:20:40', '2024-02-07 10:20:40'),
(106, 25, 'Frame :', NULL, '2024-02-07 10:31:39', '2024-02-07 10:31:39'),
(107, 25, 'Weight Capacity :', NULL, '2024-02-07 10:31:39', '2024-02-07 10:31:39'),
(108, 25, 'Width :', NULL, '2024-02-07 10:31:39', '2024-02-07 10:31:39'),
(109, 25, 'Height :', NULL, '2024-02-07 10:31:39', '2024-02-07 10:31:39'),
(110, 25, 'Wheels :', NULL, '2024-02-07 10:31:39', '2024-02-07 10:31:39'),
(111, 26, 'Frame :', NULL, '2024-02-07 10:38:23', '2024-02-07 10:38:23'),
(112, 26, 'Weight Capacity :', NULL, '2024-02-07 10:38:23', '2024-02-07 10:38:23'),
(113, 26, 'Width :', NULL, '2024-02-07 10:38:23', '2024-02-07 10:38:23'),
(114, 26, 'Height :', NULL, '2024-02-07 10:38:23', '2024-02-07 10:38:23'),
(115, 26, 'Wheels :', NULL, '2024-02-07 10:38:23', '2024-02-07 10:38:23'),
(116, 27, 'Frame :', NULL, '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(117, 27, 'Weight Capacity :', NULL, '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(118, 27, 'Width :', NULL, '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(119, 27, 'Height :', NULL, '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(120, 27, 'Wheels :', NULL, '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(121, 28, 'Frame :', NULL, '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(122, 28, 'Weight Capacity :', NULL, '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(123, 28, 'Width :', NULL, '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(124, 28, 'Height :', NULL, '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(125, 28, 'Wheels :', NULL, '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(126, 29, 'Frame :', NULL, '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(127, 29, 'Weight Capacity :', NULL, '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(128, 29, 'Width :', NULL, '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(129, 29, 'Height :', NULL, '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(130, 29, 'Wheels :', NULL, '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(131, 31, 'Frame :', NULL, '2024-03-22 20:49:38', '2024-03-22 20:49:38'),
(132, 31, 'Weight Capacity :', NULL, '2024-03-22 20:49:38', '2024-03-22 20:49:38'),
(133, 31, 'Width :', NULL, '2024-03-22 20:49:38', '2024-03-22 20:49:38'),
(134, 31, 'Height :', NULL, '2024-03-22 20:49:38', '2024-03-22 20:49:38'),
(135, 31, 'Wheels :', NULL, '2024-03-22 20:49:38', '2024-03-22 20:49:38'),
(136, 32, 'Frame :', NULL, '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(137, 32, 'Weight Capacity :', NULL, '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(138, 32, 'Width :', NULL, '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(139, 32, 'Height :', NULL, '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(140, 32, 'Wheels :', NULL, '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(141, 33, 'Frame :', NULL, '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(142, 33, 'Weight Capacity :', NULL, '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(143, 33, 'Width :', NULL, '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(144, 33, 'Height :', NULL, '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(145, 33, 'Wheels :', NULL, '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(146, 34, 'Frame :', NULL, '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(147, 34, 'Weight Capacity :', NULL, '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(148, 34, 'Width :', NULL, '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(149, 34, 'Height :', NULL, '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(150, 34, 'Wheels :', NULL, '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(151, 35, 'Frame :', NULL, '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(152, 35, 'Weight Capacity :', NULL, '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(153, 35, 'Width :', NULL, '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(154, 35, 'Height :', NULL, '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(155, 35, 'Wheels :', NULL, '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(156, 36, 'Frame :', NULL, '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(157, 36, 'Weight Capacity :', NULL, '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(158, 36, 'Width :', NULL, '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(159, 36, 'Height :', NULL, '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(160, 36, 'Wheels :', NULL, '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(161, 37, 'Frame :', NULL, '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(162, 37, 'Weight Capacity :', NULL, '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(163, 37, 'Width :', NULL, '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(164, 37, 'Height :', NULL, '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(165, 37, 'Wheels :', NULL, '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(166, 38, 'Frame :', NULL, '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(167, 38, 'Weight Capacity :', NULL, '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(168, 38, 'Width :', NULL, '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(169, 38, 'Height :', NULL, '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(170, 38, 'Wheels :', NULL, '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(171, 39, 'Frame :', NULL, '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(172, 39, 'Weight Capacity :', NULL, '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(173, 39, 'Width :', NULL, '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(174, 39, 'Height :', NULL, '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(175, 39, 'Wheels :', NULL, '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(176, 40, 'Frame :', NULL, '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(177, 40, 'Weight Capacity :', NULL, '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(178, 40, 'Width :', NULL, '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(179, 40, 'Height :', NULL, '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(180, 40, 'Wheels :', NULL, '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(181, 41, 'Frame :', NULL, '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(182, 41, 'Weight Capacity :', NULL, '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(183, 41, 'Width :', NULL, '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(184, 41, 'Height :', NULL, '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(185, 41, 'Wheels :', NULL, '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(186, 42, 'Frame :', NULL, '2024-03-22 21:43:39', '2024-03-22 21:43:39'),
(187, 42, 'Weight Capacity :', NULL, '2024-03-22 21:43:39', '2024-03-22 21:43:39'),
(188, 42, 'Width :', NULL, '2024-03-22 21:43:39', '2024-03-22 21:43:39'),
(189, 42, 'Height :', NULL, '2024-03-22 21:43:39', '2024-03-22 21:43:39'),
(190, 42, 'Wheels :', NULL, '2024-03-22 21:43:39', '2024-03-22 21:43:39'),
(191, 43, 'Frame :', NULL, '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(192, 43, 'Weight Capacity :', NULL, '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(193, 43, 'Width :', NULL, '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(194, 43, 'Height :', NULL, '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(195, 43, 'Wheels :', NULL, '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(196, 44, 'Frame :', NULL, '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(197, 44, 'Weight Capacity :', NULL, '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(198, 44, 'Width :', NULL, '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(199, 44, 'Height :', NULL, '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(200, 44, 'Wheels :', NULL, '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(201, 45, 'Frame :', NULL, '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(202, 45, 'Weight Capacity :', NULL, '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(203, 45, 'Width :', NULL, '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(204, 45, 'Height :', NULL, '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(205, 45, 'Wheels :', NULL, '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(206, 46, 'Frame :', NULL, '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(207, 46, 'Weight Capacity :', NULL, '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(208, 46, 'Width :', NULL, '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(209, 46, 'Height :', NULL, '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(210, 46, 'Wheels :', NULL, '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(211, 47, 'Frame :', NULL, '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(212, 47, 'Weight Capacity :', NULL, '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(213, 47, 'Width :', NULL, '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(214, 47, 'Height :', NULL, '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(215, 47, 'Wheels :', NULL, '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(216, 48, 'Frame :', NULL, '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(217, 48, 'Weight Capacity :', NULL, '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(218, 48, 'Width :', NULL, '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(219, 48, 'Height :', NULL, '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(220, 48, 'Wheels :', NULL, '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(221, 49, 'Frame :', NULL, '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(222, 49, 'Weight Capacity :', NULL, '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(223, 49, 'Width :', NULL, '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(224, 49, 'Height :', NULL, '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(225, 49, 'Wheels :', NULL, '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(226, 50, NULL, NULL, '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(227, 50, NULL, NULL, '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(228, 50, NULL, NULL, '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(229, 50, NULL, NULL, '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(230, 50, NULL, NULL, '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(236, 52, 'Frame :', NULL, '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(237, 52, 'Weight Capacity :', NULL, '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(238, 52, 'Width :', NULL, '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(239, 52, 'Height :', NULL, '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(240, 52, 'Wheels :', NULL, '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(241, 53, 'Frame :', NULL, '2024-05-09 12:53:13', '2024-05-09 12:53:13'),
(242, 53, 'Weight Capacity :', NULL, '2024-05-09 12:53:13', '2024-05-09 12:53:13'),
(243, 53, 'Width :', NULL, '2024-05-09 12:53:13', '2024-05-09 12:53:13'),
(244, 53, 'Height :', NULL, '2024-05-09 12:53:13', '2024-05-09 12:53:13'),
(245, 53, 'Wheels :', NULL, '2024-05-09 12:53:13', '2024-05-09 12:53:13'),
(251, 55, 'Frame :', NULL, '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(252, 55, 'Weight Capacity :', NULL, '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(253, 55, 'Width :', NULL, '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(254, 55, 'Height :', NULL, '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(255, 55, 'Wheels :', NULL, '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(256, 56, 'Frame :', NULL, '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(257, 56, 'Weight Capacity :', NULL, '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(258, 56, 'Width :', NULL, '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(259, 56, 'Height :', NULL, '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(260, 56, 'Wheels :', NULL, '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(261, 57, 'Frame :', NULL, '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(262, 57, 'Weight Capacity :', NULL, '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(263, 57, 'Width :', NULL, '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(264, 57, 'Height :', NULL, '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(265, 57, 'Wheels :', NULL, '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(266, 58, 'Frame :', NULL, '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(267, 58, 'Weight Capacity :', NULL, '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(268, 58, 'Width :', NULL, '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(269, 58, 'Height :', NULL, '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(270, 58, 'Wheels :', NULL, '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(271, 59, 'Frame :', NULL, '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(272, 59, 'Weight Capacity :', NULL, '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(273, 59, 'Width :', NULL, '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(274, 59, 'Height :', NULL, '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(275, 59, 'Wheels :', NULL, '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(276, 60, 'Frame :', NULL, '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(277, 60, 'Weight Capacity :', NULL, '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(278, 60, 'Width :', NULL, '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(279, 60, 'Height :', NULL, '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(280, 60, 'Wheels :', NULL, '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(281, 61, 'Frame :', NULL, '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(282, 61, 'Weight Capacity :', NULL, '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(283, 61, 'Width :', NULL, '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(284, 61, 'Height :', NULL, '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(285, 61, 'Wheels :', NULL, '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(286, 62, 'Frame :', NULL, '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(287, 62, 'Weight Capacity :', NULL, '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(288, 62, 'Width :', NULL, '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(289, 62, 'Height :', NULL, '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(290, 62, 'Wheels :', NULL, '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(291, 63, 'Frame :', NULL, '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(292, 63, 'Weight Capacity :', NULL, '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(293, 63, 'Width :', NULL, '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(294, 63, 'Height :', NULL, '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(295, 63, 'Wheels :', NULL, '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(296, 64, 'Frame :', NULL, '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(297, 64, 'Weight Capacity :', NULL, '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(298, 64, 'Width :', NULL, '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(299, 64, 'Height :', NULL, '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(300, 64, 'Wheels :', NULL, '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(301, 65, 'Frame :', NULL, '2024-05-13 07:49:13', '2024-05-13 07:49:13'),
(302, 65, 'Weight Capacity :', NULL, '2024-05-13 07:49:13', '2024-05-13 07:49:13'),
(303, 65, 'Width :', NULL, '2024-05-13 07:49:13', '2024-05-13 07:49:13'),
(304, 65, 'Height :', NULL, '2024-05-13 07:49:13', '2024-05-13 07:49:13'),
(305, 65, 'Wheels :', NULL, '2024-05-13 07:49:13', '2024-05-13 07:49:13'),
(306, 67, 'Frame :', NULL, '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(307, 67, 'Weight Capacity :', NULL, '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(308, 67, 'Width :', NULL, '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(309, 67, 'Height :', NULL, '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(310, 67, 'Wheels :', NULL, '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(311, 68, 'Frame :', NULL, '2024-05-13 07:59:16', '2024-05-13 07:59:16'),
(312, 68, 'Weight Capacity :', NULL, '2024-05-13 07:59:16', '2024-05-13 07:59:16'),
(313, 68, 'Width :', NULL, '2024-05-13 07:59:16', '2024-05-13 07:59:16'),
(314, 68, 'Height :', NULL, '2024-05-13 07:59:16', '2024-05-13 07:59:16'),
(315, 68, 'Wheels :', NULL, '2024-05-13 07:59:16', '2024-05-13 07:59:16'),
(316, 69, 'Frame :', NULL, '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(317, 69, 'Weight Capacity :', NULL, '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(318, 69, 'Width :', NULL, '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(319, 69, 'Height :', NULL, '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(320, 69, 'Wheels :', NULL, '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(321, 70, 'Frame :', NULL, '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(322, 70, 'Weight Capacity :', NULL, '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(323, 70, 'Width :', NULL, '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(324, 70, 'Height :', NULL, '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(325, 70, 'Wheels :', NULL, '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(326, 71, 'Frame :', NULL, '2024-05-15 07:48:52', '2024-05-15 07:48:52'),
(327, 71, 'Weight Capacity :', NULL, '2024-05-15 07:48:52', '2024-05-15 07:48:52'),
(328, 71, 'Width :', NULL, '2024-05-15 07:48:52', '2024-05-15 07:48:52'),
(329, 71, 'Height :', NULL, '2024-05-15 07:48:52', '2024-05-15 07:48:52'),
(330, 71, 'Wheels :', NULL, '2024-05-15 07:48:52', '2024-05-15 07:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_extras`
--

CREATE TABLE `product_extras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `warranty_type` varchar(255) DEFAULT NULL,
  `return_policy` varchar(255) DEFAULT NULL,
  `delivery_type` varchar(255) DEFAULT NULL,
  `emi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_extras`
--

INSERT INTO `product_extras` (`id`, `product_id`, `warranty_type`, `return_policy`, `delivery_type`, `emi`, `created_at`, `updated_at`) VALUES
(24, 27, NULL, NULL, '1', 'Not Available', '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(25, 28, NULL, NULL, '1', 'Not Available', '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(26, 29, NULL, NULL, '1', 'Not Available', '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(27, 31, NULL, NULL, '1', 'Not Available', '2024-03-22 20:49:38', '2024-03-22 20:49:38'),
(28, 32, NULL, NULL, '1', 'Not Available', '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(29, 33, NULL, NULL, '1', 'Not Available', '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(30, 34, NULL, NULL, '1', 'Not Available', '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(31, 35, NULL, NULL, '1', 'Not Available', '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(32, 36, NULL, NULL, '1', 'Not Available', '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(33, 37, NULL, NULL, '1', 'Not Available', '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(34, 38, NULL, NULL, '1', 'Not Available', '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(35, 39, NULL, NULL, '1', 'Not Available', '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(36, 40, NULL, NULL, '1', 'Not Available', '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(37, 41, NULL, NULL, '1', 'Not Available', '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(38, 42, NULL, NULL, '1', 'Not Available', '2024-03-22 21:43:39', '2024-03-22 21:43:39'),
(39, 43, NULL, NULL, '1', 'Not Available', '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(40, 44, NULL, NULL, '1', 'Not Available', '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(41, 45, NULL, NULL, '1', 'Not Available', '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(42, 46, NULL, NULL, '1', 'Not Available', '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(43, 47, NULL, NULL, '1', 'Not Available', '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(44, 48, NULL, NULL, '1', 'Not Available', '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(45, 49, NULL, NULL, '1', 'Not Available', '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(46, 50, NULL, NULL, '1', 'Not Available', '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(48, 52, NULL, NULL, '1', 'Not Available', '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(49, 53, NULL, NULL, '1', 'Not Available', '2024-05-09 12:53:13', '2024-05-09 12:53:13'),
(51, 55, NULL, NULL, '1', 'Not Available', '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(52, 56, NULL, NULL, '1', 'Not Available', '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(53, 57, NULL, NULL, '1', 'Not Available', '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(54, 58, NULL, NULL, '1', 'Not Available', '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(55, 59, NULL, NULL, '1', 'Not Available', '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(56, 60, NULL, NULL, '1', 'Not Available', '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(57, 61, NULL, NULL, '1', 'Not Available', '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(58, 62, NULL, NULL, '1', 'Not Available', '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(59, 63, NULL, NULL, '1', 'Not Available', '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(60, 64, NULL, NULL, '1', 'Not Available', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(61, 65, NULL, NULL, '1', 'Not Available', '2024-05-13 07:49:13', '2024-05-13 07:49:13'),
(62, 67, NULL, NULL, '1', 'Not Available', '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(63, 68, NULL, NULL, '1', 'Not Available', '2024-05-13 07:59:16', '2024-05-13 07:59:16'),
(64, 69, NULL, NULL, '1', 'Not Available', '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(65, 70, NULL, NULL, '1', 'Not Available', '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(66, 71, NULL, NULL, '1', 'Not Available', '2024-05-15 07:48:52', '2024-05-15 07:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `product_image`, `slug`, `created_at`, `updated_at`) VALUES
(68, 23, 'mens-premium-panjabi-sa06_0.jpg', '', '2024-02-07 10:15:47', '2024-02-07 10:15:47'),
(69, 23, 'mens-premium-panjabi-sa06_1.jpg', '', '2024-02-07 10:15:48', '2024-02-07 10:15:48'),
(70, 23, 'mens-premium-panjabi-sa06_2.jpg', '', '2024-02-07 10:15:49', '2024-02-07 10:15:49'),
(71, 23, 'mens-premium-panjabi-sa06_3.jpg', '', '2024-02-07 10:15:50', '2024-02-07 10:15:50'),
(72, 23, 'mens-premium-panjabi-sa06_4.jpg', '', '2024-02-07 10:15:50', '2024-02-07 10:15:50'),
(73, 24, 'mens-printed-panjabi-pr05_0.jpg', '', '2024-02-07 10:20:36', '2024-02-07 10:20:36'),
(74, 24, 'mens-printed-panjabi-pr05_1.jpg', '', '2024-02-07 10:20:37', '2024-02-07 10:20:37'),
(75, 24, 'mens-printed-panjabi-pr05_2.jpg', '', '2024-02-07 10:20:38', '2024-02-07 10:20:38'),
(76, 24, 'mens-printed-panjabi-pr05_3.jpg', '', '2024-02-07 10:20:39', '2024-02-07 10:20:39'),
(77, 24, 'mens-printed-panjabi-pr05_4.jpg', '', '2024-02-07 10:20:40', '2024-02-07 10:20:40'),
(78, 25, 'mens-printed-panjabi-pr04_0.jpg', '', '2024-02-07 10:31:35', '2024-02-07 10:31:35'),
(79, 25, 'mens-printed-panjabi-pr04_1.jpg', '', '2024-02-07 10:31:36', '2024-02-07 10:31:36'),
(80, 25, 'mens-printed-panjabi-pr04_2.jpg', '', '2024-02-07 10:31:37', '2024-02-07 10:31:37'),
(81, 25, 'mens-printed-panjabi-pr04_3.jpg', '', '2024-02-07 10:31:38', '2024-02-07 10:31:38'),
(82, 25, 'mens-printed-panjabi-pr04_4.jpg', '', '2024-02-07 10:31:39', '2024-02-07 10:31:39'),
(83, 26, 'mens-printed-panjabi-pr03_0.jpg', '', '2024-02-07 10:38:20', '2024-02-07 10:38:20'),
(84, 26, 'mens-printed-panjabi-pr03_1.jpg', '', '2024-02-07 10:38:21', '2024-02-07 10:38:21'),
(85, 26, 'mens-printed-panjabi-pr03_2.jpg', '', '2024-02-07 10:38:22', '2024-02-07 10:38:22'),
(86, 26, 'mens-printed-panjabi-pr03_3.jpg', '', '2024-02-07 10:38:22', '2024-02-07 10:38:22'),
(87, 26, 'mens-printed-panjabi-pr03_4.jpg', '', '2024-02-07 10:38:23', '2024-02-07 10:38:23'),
(88, 27, 'koohen-premium-punjabi-sa01_0.jpg', '', '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(89, 27, 'koohen-premium-punjabi-sa01_1.jpg', '', '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(90, 27, 'koohen-premium-punjabi-sa01_2.jpg', '', '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(91, 28, 'koohen-premium-punjabi-sa02_0.jpg', '', '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(92, 28, 'koohen-premium-punjabi-sa02_1.jpg', '', '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(93, 28, 'koohen-premium-punjabi-sa02_2.jpg', '', '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(94, 29, 'koohen-premium-punjabi-sa03_0.jpg', '', '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(95, 29, 'koohen-premium-punjabi-sa03_1.jpg', '', '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(96, 29, 'koohen-premium-punjabi-sa03_2.jpg', '', '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(97, 31, 'koohen-premium-punjabi-sa04_0.jpg', '', '2024-03-22 20:49:37', '2024-03-22 20:49:37'),
(98, 31, 'koohen-premium-punjabi-sa04_1.jpg', '', '2024-03-22 20:49:38', '2024-03-22 20:49:38'),
(99, 31, 'koohen-premium-punjabi-sa04_2.jpg', '', '2024-03-22 20:49:38', '2024-03-22 20:49:38'),
(100, 32, 'koohen-premium-punjabi-sa05_0.jpg', '', '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(101, 32, 'koohen-premium-punjabi-sa05_1.jpg', '', '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(102, 32, 'koohen-premium-punjabi-sa05_2.jpg', '', '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(103, 33, 'koohen-premium-punjabi-sa06_0.jpg', '', '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(104, 33, 'koohen-premium-punjabi-sa06_1.jpg', '', '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(105, 33, 'koohen-premium-punjabi-sa06_2.jpg', '', '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(106, 34, 'koohen-standard-punjabi-sa07_0.jpg', '', '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(107, 34, 'koohen-standard-punjabi-sa07_1.jpg', '', '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(108, 34, 'koohen-standard-punjabi-sa07_2.jpg', '', '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(109, 35, 'koohen-standard-punjabi-sa08_0.jpg', '', '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(110, 36, 'koohen-standard-punjabi-sa09_0.jpg', '', '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(111, 36, 'koohen-standard-punjabi-sa09_1.jpg', '', '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(112, 36, 'koohen-standard-punjabi-sa09_2.jpg', '', '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(113, 37, 'koohen-standard-punjabi-sa10_0.jpg', '', '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(114, 37, 'koohen-standard-punjabi-sa10_1.jpg', '', '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(115, 37, 'koohen-standard-punjabi-sa10_2.jpg', '', '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(116, 38, 'koohen-standard-punjabi-sa11_0.jpg', '', '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(117, 38, 'koohen-standard-punjabi-sa11_1.jpg', '', '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(118, 38, 'koohen-standard-punjabi-sa11_2.jpg', '', '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(119, 39, 'koohen-standard-punjabi-sa12_0.jpg', '', '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(120, 39, 'koohen-standard-punjabi-sa12_1.jpg', '', '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(121, 39, 'koohen-standard-punjabi-sa12_2.jpg', '', '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(122, 40, 'koohen-regular-punjabi-pr07_0.jpg', '', '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(123, 40, 'koohen-regular-punjabi-pr07_1.jpg', '', '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(124, 40, 'koohen-regular-punjabi-pr07_2.jpg', '', '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(125, 41, 'koohen-regular-punjabi-pr06_0.jpg', '', '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(126, 41, 'koohen-regular-punjabi-pr06_1.jpg', '', '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(127, 41, 'koohen-regular-punjabi-pr06_2.jpg', '', '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(128, 42, 'koohen-standard-punjabi-pr05_0.jpg', '', '2024-03-22 21:43:38', '2024-03-22 21:43:38'),
(129, 42, 'koohen-standard-punjabi-pr05_1.jpg', '', '2024-03-22 21:43:39', '2024-03-22 21:43:39'),
(130, 42, 'koohen-standard-punjabi-pr05_2.jpg', '', '2024-03-22 21:43:39', '2024-03-22 21:43:39'),
(131, 43, 'koohen-standard-punjabi-pr04_0.jpg', '', '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(132, 43, 'koohen-standard-punjabi-pr04_1.jpg', '', '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(133, 43, 'koohen-standard-punjabi-pr04_2.jpg', '', '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(134, 44, 'koohen-standard-punjabi-pr01_0.jpg', '', '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(135, 44, 'koohen-standard-punjabi-pr01_1.jpg', '', '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(136, 44, 'koohen-standard-punjabi-pr01_2.jpg', '', '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(137, 45, 'koohen-standard-punjabi-pr02_0.jpg', '', '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(138, 45, 'koohen-standard-punjabi-pr02_1.jpg', '', '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(139, 45, 'koohen-standard-punjabi-pr02_2.jpg', '', '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(140, 46, 'koohen-standard-punjabi-pr03_0.jpg', '', '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(141, 46, 'koohen-standard-punjabi-pr03_1.jpg', '', '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(142, 46, 'koohen-standard-punjabi-pr03_2.jpg', '', '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(143, 47, 'koohen-regular-punjabi-pr08_0.jpg', '', '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(144, 47, 'koohen-regular-punjabi-pr08_1.jpg', '', '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(145, 48, 'koohen-regular-punjabi-pr09_0.jpg', '', '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(146, 48, 'koohen-regular-punjabi-pr09_1.jpg', '', '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(147, 49, 'koohen-regular-punjabi-pr10_0.jpg', '', '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(148, 49, 'koohen-regular-punjabi-pr10_1.jpg', '', '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(149, 50, 'mens-premium-pajama-sw01_0.jpg', '', '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(151, 52, 'mens-standard-punjabi-sa14_0.jpg', '', '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(152, 52, 'mens-standard-punjabi-sa14_1.jpg', '', '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(153, 52, 'mens-standard-punjabi-sa14_2.jpg', '', '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(154, 52, 'mens-standard-punjabi-sa14_3.jpg', '', '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(155, 53, 'mens-standard-punjabi-sa15_0.jpg', '', '2024-05-09 12:53:12', '2024-05-09 12:53:12'),
(156, 53, 'mens-standard-punjabi-sa15_1.jpg', '', '2024-05-09 12:53:12', '2024-05-09 12:53:12'),
(157, 53, 'mens-standard-punjabi-sa15_2.jpg', '', '2024-05-09 12:53:13', '2024-05-09 12:53:13'),
(163, 55, 'mens-premium-punjabi-sa16_0.jpg', '', '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(164, 55, 'mens-premium-punjabi-sa16_1.jpg', '', '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(165, 55, 'mens-premium-punjabi-sa16_2.jpg', '', '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(166, 55, 'mens-premium-punjabi-sa16_3.jpg', '', '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(167, 56, 'mens-premium-punjabi-sa17_0.jpg', '', '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(168, 56, 'mens-premium-punjabi-sa17_1.jpg', '', '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(169, 56, 'mens-premium-punjabi-sa17_2.jpg', '', '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(170, 57, 'mens-standard-punjabi-pr11_0.jpg', '', '2024-05-09 13:30:29', '2024-05-09 13:30:29'),
(171, 57, 'mens-standard-punjabi-pr11_1.jpg', '', '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(172, 57, 'mens-standard-punjabi-pr11_2.jpg', '', '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(173, 57, 'mens-standard-punjabi-pr11_3.jpg', '', '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(174, 58, 'koohen-standard-punjabi-pr12_0.jpg', '', '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(175, 58, 'koohen-standard-punjabi-pr12_1.jpg', '', '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(176, 59, 'womens-co-ords-set-crds01_0.jpg', '', '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(177, 59, 'womens-co-ords-set-crds01_1.jpg', '', '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(178, 59, 'womens-co-ords-set-crds01_2.jpg', '', '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(179, 59, 'womens-co-ords-set-crds01_3.jpg', '', '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(180, 60, 'womens-co-ords-set-crds02_0.jpg', '', '2024-05-13 07:38:05', '2024-05-13 07:38:05'),
(181, 60, 'womens-co-ords-set-crds02_1.jpg', '', '2024-05-13 07:38:05', '2024-05-13 07:38:05'),
(182, 60, 'womens-co-ords-set-crds02_2.jpg', '', '2024-05-13 07:38:05', '2024-05-13 07:38:05'),
(183, 60, 'womens-co-ords-set-crds02_3.jpg', '', '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(184, 60, 'womens-co-ords-set-crds02_4.jpg', '', '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(185, 61, 'womens-co-ords-set-crds03_0.jpg', '', '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(186, 61, 'womens-co-ords-set-crds03_1.jpg', '', '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(187, 61, 'womens-co-ords-set-crds03_2.jpg', '', '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(188, 61, 'womens-co-ords-set-crds03_3.jpg', '', '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(189, 62, 'womens-co-ords-set-crds04_0.jpg', '', '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(190, 62, 'womens-co-ords-set-crds04_1.jpg', '', '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(191, 62, 'womens-co-ords-set-crds04_2.jpg', '', '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(192, 62, 'womens-co-ords-set-crds04_3.jpg', '', '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(193, 63, 'womens-co-ords-set-crds05_0.jpg', '', '2024-05-13 07:45:07', '2024-05-13 07:45:07'),
(194, 63, 'womens-co-ords-set-crds05_1.jpg', '', '2024-05-13 07:45:07', '2024-05-13 07:45:07'),
(195, 63, 'womens-co-ords-set-crds05_2.jpg', '', '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(196, 63, 'womens-co-ords-set-crds05_3.jpg', '', '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(197, 63, 'womens-co-ords-set-crds05_4.jpg', '', '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(198, 64, 'womens-co-ords-set-crds06_0.jpg', '', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(199, 64, 'womens-co-ords-set-crds06_1.jpg', '', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(200, 64, 'womens-co-ords-set-crds06_2.jpg', '', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(201, 64, 'womens-co-ords-set-crds06_3.jpg', '', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(202, 64, 'womens-co-ords-set-crds06_4.jpg', '', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(203, 65, 'womens-kaftan-set-kftn01_0.jpg', '', '2024-05-13 07:49:12', '2024-05-13 07:49:12'),
(204, 65, 'womens-kaftan-set-kftn01_1.jpg', '', '2024-05-13 07:49:12', '2024-05-13 07:49:12'),
(205, 65, 'womens-kaftan-set-kftn01_2.jpg', '', '2024-05-13 07:49:12', '2024-05-13 07:49:12'),
(206, 65, 'womens-kaftan-set-kftn01_3.jpg', '', '2024-05-13 07:49:12', '2024-05-13 07:49:12'),
(207, 65, 'womens-kaftan-set-kftn01_4.jpg', '', '2024-05-13 07:49:13', '2024-05-13 07:49:13'),
(208, 67, 'womens-kaftan-set-kftn02_0.jpg', '', '2024-05-13 07:56:08', '2024-05-13 07:56:08'),
(209, 67, 'womens-kaftan-set-kftn02_1.jpg', '', '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(210, 67, 'womens-kaftan-set-kftn02_2.jpg', '', '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(211, 67, 'womens-kaftan-set-kftn02_3.jpg', '', '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(212, 67, 'womens-kaftan-set-kftn02_4.jpg', '', '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(213, 68, 'womens-kaftan-set-kftn03_0.jpg', '', '2024-05-13 07:59:15', '2024-05-13 07:59:15'),
(214, 68, 'womens-kaftan-set-kftn03_1.jpg', '', '2024-05-13 07:59:15', '2024-05-13 07:59:15'),
(215, 68, 'womens-kaftan-set-kftn03_2.jpg', '', '2024-05-13 07:59:15', '2024-05-13 07:59:15'),
(216, 68, 'womens-kaftan-set-kftn03_3.jpg', '', '2024-05-13 07:59:15', '2024-05-13 07:59:15'),
(217, 68, 'womens-kaftan-set-kftn03_4.jpg', '', '2024-05-13 07:59:16', '2024-05-13 07:59:16'),
(218, 69, 'womens-kaftan-set-kftn04_0.jpg', '', '2024-05-13 08:00:48', '2024-05-13 08:00:48'),
(219, 69, 'womens-kaftan-set-kftn04_1.jpg', '', '2024-05-13 08:00:48', '2024-05-13 08:00:48'),
(220, 69, 'womens-kaftan-set-kftn04_2.jpg', '', '2024-05-13 08:00:48', '2024-05-13 08:00:48'),
(221, 69, 'womens-kaftan-set-kftn04_3.jpg', '', '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(222, 69, 'womens-kaftan-set-kftn04_4.jpg', '', '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(223, 70, 'womens-kaftan-set-kftn06_0.jpg', '', '2024-05-13 08:03:03', '2024-05-13 08:03:03'),
(224, 70, 'womens-kaftan-set-kftn06_1.jpg', '', '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(225, 70, 'womens-kaftan-set-kftn06_2.jpg', '', '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(226, 70, 'womens-kaftan-set-kftn06_3.jpg', '', '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(227, 70, 'womens-kaftan-set-kftn06_4.jpg', '', '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(228, 71, 'mens-premium-punjabi-sa13_0.jpg', '', '2024-05-15 07:48:52', '2024-05-15 07:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_offer_types`
--

CREATE TABLE `product_offer_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `offer_product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_overviews`
--

CREATE TABLE `product_overviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `overview_name` varchar(255) DEFAULT NULL,
  `overview_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_overviews`
--

INSERT INTO `product_overviews` (`id`, `product_id`, `overview_name`, `overview_value`, `created_at`, `updated_at`) VALUES
(49, 25, 'Fabric Type :', 'Cotton + Polyester', '2024-02-07 10:31:39', '2024-02-07 10:31:39'),
(50, 25, 'Type :', 'Regular Fit', '2024-02-07 10:31:39', '2024-02-07 17:22:40'),
(51, 25, 'Breathability :', 'Highly breathable and comfortable', '2024-02-07 10:31:39', '2024-02-07 10:31:39'),
(52, 25, 'Durability :', 'Durable and long-lasting', '2024-02-07 10:31:39', '2024-02-07 10:31:39'),
(53, 26, 'Fabric Type :', 'Cotton + Polyester', '2024-02-07 10:38:23', '2024-02-07 10:38:23'),
(54, 26, 'Type :', 'Regular Fit', '2024-02-07 10:38:23', '2024-02-07 10:38:23'),
(55, 26, 'Breathability :', 'Highly breathable and comfortable', '2024-02-07 10:38:23', '2024-02-07 10:38:23'),
(56, 26, 'Durability :', 'Durable and long-lasting', '2024-02-07 10:38:23', '2024-02-07 10:38:23'),
(57, 27, 'Fabric Type:', 'Cotton', '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(58, 27, 'Type:', 'Regular Fit', '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(59, 27, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(60, 27, 'Durability:', 'Durable and long-lasting', '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(61, 28, 'Fabric Type:', 'Cotton', '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(62, 28, 'Type:', 'Regular Fit', '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(63, 28, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(64, 28, 'Durability:', 'Durable and long-lasting', '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(65, 29, 'Fabric Type:', 'Cotton', '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(66, 29, 'Type:', 'Regular Fit', '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(67, 29, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(68, 29, 'Durability:', 'Durable and long-lasting', '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(69, 31, 'Fabric Type:', 'Cotton', '2024-03-22 20:49:38', '2024-03-22 20:49:38'),
(70, 31, 'Type:', 'Regular Fit', '2024-03-22 20:49:38', '2024-03-22 20:49:38'),
(71, 31, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 20:49:38', '2024-03-22 20:49:38'),
(72, 31, 'Durability:', 'Durable and long-lasting', '2024-03-22 20:49:38', '2024-03-22 20:49:38'),
(73, 32, 'Fabric Type:', 'Cotton', '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(74, 32, 'Type:', 'Regular Fit', '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(75, 32, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(76, 32, 'Durability:', 'Durable and long-lasting', '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(77, 33, 'Fabric Type:', 'Cotton', '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(78, 33, 'Type:', 'Regular Fit', '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(79, 33, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(80, 33, 'Durability:', 'Durable and long-lasting', '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(81, 34, 'Fabric Type:', 'Cotton', '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(82, 34, 'Type:', 'Regular Fit', '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(83, 34, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(84, 34, 'Durability:', 'Durable and long-lasting', '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(85, 35, 'Fabric Type:', 'Cotton', '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(86, 35, 'Type:', 'Regular Fit', '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(87, 35, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(88, 35, 'Durability:', 'Durable and long-lasting', '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(89, 36, 'Fabric Type:', 'Cotton', '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(90, 36, 'Type:', 'Regular Fit', '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(91, 36, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(92, 36, 'Durability:', 'Durable and long-lasting', '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(93, 37, 'Fabric Type:', 'Cotton', '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(94, 37, 'Type:', 'Regular Fit', '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(95, 37, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(96, 37, 'Durability:', 'Durable and long-lasting', '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(97, 38, 'Fabric Type:', 'Cotton', '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(98, 38, 'Type:', 'Regular Fit', '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(99, 38, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(100, 38, 'Durability:', 'Durable and long-lasting', '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(101, 39, 'Fabric Type:', 'Cotton', '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(102, 39, 'Type:', 'Regular Fit', '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(103, 39, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(104, 39, 'Durability:', 'Durable and long-lasting', '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(105, 40, 'Fabric Type:', 'Cotton', '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(106, 40, 'Type:', 'Regular Fit', '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(107, 40, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(108, 40, 'Durability:', 'Durable and long-lasting', '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(109, 41, 'Fabric Type:', 'Cotton', '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(110, 41, 'Type:', 'Regular Fit', '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(111, 41, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(112, 41, 'Durability:', 'Durable and long-lasting', '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(113, 42, 'Fabric Type:', 'Cotton', '2024-03-22 21:43:39', '2024-03-22 21:43:39'),
(114, 42, 'Type:', 'Regular Fit', '2024-03-22 21:43:39', '2024-03-22 21:43:39'),
(115, 42, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 21:43:39', '2024-03-22 21:43:39'),
(116, 42, 'Durability:', 'Durable and long-lasting', '2024-03-22 21:43:39', '2024-03-22 21:43:39'),
(117, 43, 'Fabric Type:', 'Cotton', '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(118, 43, 'Type:', 'Regular Fit', '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(119, 43, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(120, 43, 'Durability:', 'Durable and long-lasting', '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(121, 44, 'Fabric Type:', 'Cotton', '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(122, 44, 'Type:', 'Regular Fit', '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(123, 44, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(124, 44, 'Durability:', 'Durable and long-lasting', '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(125, 45, 'Fabric Type:', 'Cotton', '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(126, 45, 'Type:', 'Regular Fit', '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(127, 45, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(128, 45, 'Durability:', 'Durable and long-lasting', '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(129, 46, 'Fabric Type:', 'Cotton', '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(130, 46, 'Type:', 'Regular Fit', '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(131, 46, 'Breathability:', 'Highly breathable and comfortable', '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(132, 46, 'Durability:', 'Durable and long-lasting', '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(133, 47, 'Fabric Type:', 'Cotton', '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(134, 47, 'Type:', 'Regular Fit', '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(135, 47, 'Breathability:', 'Highly breathable and comfortable', '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(136, 47, 'Durability:', 'Durable and long-lasting', '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(137, 48, 'Fabric Type:', 'Cotton', '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(138, 48, 'Type:', 'Regular Fit', '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(139, 48, 'Breathability:', 'Highly breathable and comfortable', '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(140, 48, 'Durability:', 'Durable and long-lasting', '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(141, 49, 'Fabric Type:', 'Cotton', '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(142, 49, 'Type:', 'Regular Fit', '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(143, 49, 'Breathability:', 'Highly breathable and comfortable', '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(144, 49, 'Durability:', 'Durable and long-lasting', '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(145, 50, 'Fabric Type:', 'Tencil Cotton', '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(146, 50, 'Type:', 'Regular Fit', '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(147, 50, 'Breathability:', 'Highly breathable and comfortable', '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(148, 50, 'Durability:', 'Durable and long-lasting', '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(150, 52, 'Fabric Type:', 'Cotton', '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(151, 52, 'Type:', 'Regular Fit', '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(152, 52, 'Breathability:', 'Highly breathable and comfortable', '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(153, 52, 'Durability:', 'Durable and long-lasting', '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(154, 53, 'Fabric Type:', 'Cotton', '2024-05-09 12:53:13', '2024-05-09 12:53:13'),
(155, 53, 'Type:', 'Regular Fit', '2024-05-09 12:53:13', '2024-05-09 12:53:13'),
(156, 53, 'Breathability:', 'Highly breathable and comfortable', '2024-05-09 12:53:13', '2024-05-09 12:53:13'),
(157, 53, 'Durability:', 'Durable and long-lasting', '2024-05-09 12:53:13', '2024-05-09 12:53:13'),
(162, 55, 'Fabric Type:', 'Cotton', '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(163, 55, 'Type:', 'Regular Fit', '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(164, 55, 'Breathability:', 'Highly breathable and comfortable', '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(165, 55, 'Durability:', 'Durable and long-lasting', '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(166, 56, 'Fabric Type:', 'Cotton', '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(167, 56, 'Type:', 'Regular Fit', '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(168, 56, 'Breathability:', 'Highly breathable and comfortable', '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(169, 56, 'Durability:', 'Durable and long-lasting', '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(170, 57, 'Fabric Type:', 'Cotton', '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(171, 57, 'Type:', 'Regular Fit', '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(172, 57, 'Breathability:', 'Highly breathable and comfortable', '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(173, 57, 'Durability:', 'Durable and long-lasting', '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(174, 58, 'Fabric Type:', 'Cotton', '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(175, 58, 'Type:', 'Regular Fit', '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(176, 58, 'Breathability:', 'Highly breathable and comfortable', '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(177, 58, 'Durability:', 'Durable and long-lasting', '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(178, 59, 'Fabric Type:', 'Cotton', '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(179, 59, 'Type:', 'Regular Fit', '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(180, 59, 'Breathability:', 'Highly breathable and comfortable', '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(181, 59, 'Durability:', 'Durable and long-lasting', '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(182, 60, 'Fabric Type:', 'Cotton', '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(183, 60, 'Type:', 'Regular Fit', '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(184, 60, 'Breathability:', 'Highly breathable and comfortable', '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(185, 60, 'Durability:', 'Durable and long-lasting', '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(186, 61, 'Fabric Type:', 'Cotton', '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(187, 61, 'Type:', 'Regular Fit', '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(188, 61, 'Breathability:', 'Highly breathable and comfortable', '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(189, 61, 'Durability:', 'Durable and long-lasting', '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(190, 62, 'Fabric Type:', 'China Georgette', '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(191, 62, 'Type:', 'Regular Fit', '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(192, 62, 'Breathability:', 'Highly breathable and comfortable', '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(193, 62, 'Durability:', 'Durable and long-lasting', '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(194, 63, 'Fabric Type:', 'China Georgette', '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(195, 63, 'Type:', 'Regular Fit', '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(196, 63, 'Breathability:', 'Highly breathable and comfortable', '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(197, 63, 'Durability:', 'Durable and long-lasting', '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(198, 64, 'Fabric Type:', 'China Georgette', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(199, 64, 'Type:', 'Regular Fit', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(200, 64, 'Breathability:', 'Highly breathable and comfortable', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(201, 64, 'Durability:', 'Durable and long-lasting', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(202, 65, 'Fabric Type:', 'Cotton', '2024-05-13 07:49:13', '2024-05-13 07:49:13'),
(203, 65, 'Type:', 'Regular Fit', '2024-05-13 07:49:13', '2024-05-13 07:49:13'),
(204, 65, 'Breathability:', 'Highly breathable and comfortable', '2024-05-13 07:49:13', '2024-05-13 07:49:13'),
(205, 65, 'Durability:', 'Durable and long-lasting', '2024-05-13 07:49:13', '2024-05-13 07:49:13'),
(206, 67, 'Fabric Type:', 'Cotton', '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(207, 67, 'Type:', 'Regular Fit', '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(208, 67, 'Breathability:', 'Highly breathable and comfortable', '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(209, 67, 'Durability:', 'Durable and long-lasting', '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(210, 68, 'Fabric Type:', 'China Georgette', '2024-05-13 07:59:16', '2024-05-13 07:59:16'),
(211, 68, 'Type:', 'Regular Fit', '2024-05-13 07:59:16', '2024-05-13 07:59:16'),
(212, 68, 'Breathability:', 'Highly breathable and comfortable', '2024-05-13 07:59:16', '2024-05-13 07:59:16'),
(213, 68, 'Durability:', 'Durable and long-lasting', '2024-05-13 07:59:16', '2024-05-13 07:59:16'),
(214, 69, 'Fabric Type:', 'China Georgette', '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(215, 69, 'Type:', 'Regular Fit', '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(216, 69, 'Breathability:', 'Highly breathable and comfortable', '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(217, 69, 'Durability:', 'Durable and long-lasting', '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(218, 70, 'Fabric Type:', 'China Georgette', '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(219, 70, 'Type:', 'Regular Fit', '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(220, 70, 'Breathability:', 'Highly breathable and comfortable', '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(221, 70, 'Durability:', 'Durable and long-lasting', '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(222, 71, 'Fabric Type:', 'Cotton', '2024-05-15 07:48:52', '2024-05-15 07:48:52'),
(223, 71, 'Type:', 'Regular Fit', '2024-05-15 07:48:52', '2024-05-15 07:48:52'),
(224, 71, 'Breathability:', 'Highly breathable and comfortable', '2024-05-15 07:48:52', '2024-05-15 07:48:52'),
(225, 71, 'Durability:', 'Durable and long-lasting', '2024-05-15 07:48:52', '2024-05-15 07:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `offer_price` varchar(255) DEFAULT NULL,
  `percentage` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_prices`
--

INSERT INTO `product_prices` (`id`, `product_id`, `offer_price`, `percentage`, `amount`, `created_at`, `updated_at`) VALUES
(21, 27, '1350', '23', '560', '2024-03-22 20:12:01', '2024-05-13 11:49:16'),
(22, 28, '1350', '23', '560', '2024-03-22 20:19:25', '2024-05-13 11:49:38'),
(23, 29, '1450', '36', '675', '2024-03-22 20:23:44', '2024-05-13 11:50:05'),
(24, 31, '1250', '14', '420.5', '2024-03-22 20:49:38', '2024-05-13 11:50:23'),
(25, 32, '1250', '14', '420.5', '2024-03-22 20:53:24', '2024-05-13 11:50:39'),
(26, 33, '1450', '17', '245', '2024-03-22 20:59:13', '2024-05-13 11:51:03'),
(27, 34, '1250', '14', '420.5', '2024-03-22 21:02:48', '2024-05-13 11:51:19'),
(28, 35, '1250', '14', '420.5', '2024-03-22 21:12:59', '2024-05-13 11:51:30'),
(29, 36, '1450', '17', '507.5', '2024-03-22 21:15:33', '2024-05-13 11:51:59'),
(30, 37, '1250', '14', '420.5', '2024-03-22 21:18:35', '2024-05-13 11:52:10'),
(31, 38, '1250', '14', '1247', '2024-03-22 21:21:25', '2024-05-13 11:53:56'),
(32, 39, '1150', '21', '435', '2024-03-22 21:28:29', '2024-05-13 11:52:49'),
(33, 40, '1099', '12', '150', '2024-03-22 21:35:17', '2024-05-13 11:55:13'),
(34, 41, '1099', '12', '250', '2024-03-22 21:38:41', '2024-05-13 11:58:02'),
(35, 42, '1099', '12', '250', '2024-03-22 21:43:39', '2024-05-13 11:55:28'),
(36, 43, '1099', '12', '250', '2024-03-22 22:37:36', '2024-05-13 11:55:43'),
(37, 44, '1099', '12', '250', '2024-03-22 22:46:38', '2024-05-13 11:55:56'),
(38, 45, '1099', '12', '250', '2024-03-22 22:48:06', '2024-05-13 11:56:09'),
(39, 46, '1099', '12', '250', '2024-03-22 22:49:08', '2024-05-13 11:56:24'),
(40, 47, '1099', '12', '250', '2024-03-23 20:46:05', '2024-05-13 11:56:41'),
(41, 48, '1099', '12', '250', '2024-03-23 20:49:10', '2024-05-13 11:56:55'),
(42, 49, '1099', '12', '250', '2024-03-23 20:50:39', '2024-05-13 11:57:09'),
(43, 50, '600', '37', '418', '2024-03-24 19:03:34', '2024-05-11 15:17:15'),
(45, 52, '1450', '17', '297.5', '2024-05-09 12:50:39', '2024-05-15 07:49:26'),
(46, 53, '1450', '17', '297.5', '2024-05-09 12:53:13', '2024-05-15 07:49:43'),
(48, 55, '1450', '36', '810', '2024-05-09 13:10:21', '2024-05-15 07:50:07'),
(49, 56, '1450', '17', '297.5', '2024-05-09 13:15:58', '2024-05-15 07:50:33'),
(50, 57, '0', NULL, NULL, '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(51, 58, '0', NULL, NULL, '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(52, 59, '0', NULL, NULL, '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(53, 60, '0', NULL, NULL, '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(54, 61, '0', NULL, NULL, '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(55, 62, '0', NULL, NULL, '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(56, 63, '0', NULL, NULL, '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(57, 64, '0', NULL, NULL, '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(58, 65, '0', NULL, NULL, '2024-05-13 07:49:13', '2024-05-13 07:49:13'),
(59, 67, '0', NULL, NULL, '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(60, 68, '0', NULL, NULL, '2024-05-13 07:59:16', '2024-05-13 07:59:16'),
(61, 69, '0', NULL, NULL, '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(62, 70, '0', NULL, NULL, '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(63, 71, '1500', '33.3', '750', '2024-05-15 07:48:52', '2024-05-15 07:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `inStock` varchar(255) NOT NULL DEFAULT '0',
  `outStock` varchar(255) NOT NULL DEFAULT '0',
  `price` varchar(255) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_stocks`
--

INSERT INTO `product_stocks` (`id`, `product_id`, `size_id`, `inStock`, `outStock`, `price`, `purchase_date`, `created_at`, `updated_at`) VALUES
(9, 33, 5, '2', '0', NULL, '2024-05-02', '2024-05-02 07:07:02', '2024-05-11 16:10:43'),
(10, 33, 6, '7', '0', NULL, '2024-05-02', '2024-05-02 07:07:02', '2024-05-11 16:10:43'),
(11, 33, 7, '2', '0', NULL, '2024-05-02', '2024-05-02 07:07:02', '2024-05-11 16:10:43'),
(12, 33, 8, '0', '0', NULL, '2024-05-02', '2024-05-02 07:07:02', '2024-05-11 16:10:43'),
(13, 34, 5, '5', '0', NULL, '2024-05-02', '2024-05-02 07:07:18', '2024-05-13 11:47:56'),
(14, 34, 6, '7', '1', NULL, '2024-05-02', '2024-05-02 07:07:18', '2024-05-19 08:16:52'),
(15, 34, 7, '4', '1', NULL, '2024-05-02', '2024-05-02 07:07:18', '2024-05-19 08:16:52'),
(16, 34, 8, '0', '0', NULL, '2024-05-02', '2024-05-02 07:07:18', '2024-05-13 11:47:56'),
(17, 35, 5, '3', '0', NULL, '2024-05-02', '2024-05-02 07:07:37', '2024-05-13 11:48:03'),
(18, 35, 6, '7', '0', NULL, '2024-05-02', '2024-05-02 07:07:37', '2024-05-13 11:48:03'),
(19, 35, 7, '7', '0', NULL, '2024-05-02', '2024-05-02 07:07:37', '2024-05-13 11:48:03'),
(20, 35, 8, '0', '0', NULL, '2024-05-02', '2024-05-02 07:07:37', '2024-05-13 11:48:03'),
(21, 36, 5, '4', '0', NULL, '2024-05-02', '2024-05-02 07:08:09', '2024-05-13 11:48:10'),
(22, 36, 6, '4', '1', NULL, '2024-05-02', '2024-05-02 07:08:09', '2024-05-13 11:48:10'),
(23, 36, 7, '5', '0', NULL, '2024-05-02', '2024-05-02 07:08:09', '2024-05-13 11:48:10'),
(24, 36, 8, '3', '0', NULL, '2024-05-02', '2024-05-02 07:08:09', '2024-05-13 11:48:10'),
(25, 37, 5, '3', '0', NULL, '2024-05-02', '2024-05-02 07:08:49', '2024-05-13 11:48:17'),
(26, 37, 6, '7', '0', NULL, '2024-05-02', '2024-05-02 07:08:49', '2024-05-13 11:48:17'),
(27, 37, 7, '1', '0', NULL, '2024-05-02', '2024-05-02 07:08:49', '2024-05-13 11:48:17'),
(28, 37, 8, '0', '0', NULL, '2024-05-02', '2024-05-02 07:08:49', '2024-05-13 11:48:17'),
(29, 38, 5, '4', '0', NULL, '2024-05-02', '2024-05-02 07:09:46', '2024-05-13 11:48:26'),
(30, 38, 6, '5', '0', NULL, '2024-05-02', '2024-05-02 07:09:46', '2024-05-13 11:48:26'),
(31, 38, 7, '1', '1', NULL, '2024-05-02', '2024-05-02 07:09:46', '2024-05-18 07:51:12'),
(32, 38, 8, '1', '0', NULL, '2024-05-02', '2024-05-02 07:09:46', '2024-05-13 11:48:26'),
(33, 27, 5, '0', '0', NULL, '2024-05-05', '2024-05-02 07:14:16', '2024-05-13 11:34:31'),
(34, 27, 6, '2', '0', NULL, '2024-05-05', '2024-05-02 07:14:16', '2024-05-13 11:34:31'),
(35, 27, 7, '1', '0', NULL, '2024-05-05', '2024-05-02 07:14:16', '2024-05-13 11:34:31'),
(36, 27, 8, '0', '0', NULL, '2024-05-05', '2024-05-02 07:14:16', '2024-05-13 11:34:31'),
(37, 28, 5, '0', '0', NULL, '2024-05-05', '2024-05-02 07:14:29', '2024-05-13 11:34:53'),
(38, 28, 6, '3', '0', NULL, '2024-05-05', '2024-05-02 07:14:29', '2024-05-13 11:34:53'),
(39, 28, 7, '2', '0', NULL, '2024-05-05', '2024-05-02 07:14:29', '2024-05-13 11:34:53'),
(40, 28, 8, '2', '0', NULL, '2024-05-05', '2024-05-02 07:14:29', '2024-05-13 11:34:53'),
(41, 29, 5, '0', '0', NULL, '2024-05-05', '2024-05-02 07:15:09', '2024-05-13 11:36:48'),
(42, 29, 6, '1', '0', NULL, '2024-05-05', '2024-05-02 07:15:09', '2024-05-13 11:36:48'),
(43, 29, 7, '1', '0', NULL, '2024-05-05', '2024-05-02 07:15:09', '2024-05-13 11:36:48'),
(44, 29, 8, '0', '0', NULL, '2024-05-05', '2024-05-02 07:15:09', '2024-05-13 11:36:48'),
(45, 31, 5, '1', '0', NULL, '2024-05-05', '2024-05-02 07:16:08', '2024-05-13 11:36:40'),
(46, 31, 6, '0', '0', NULL, '2024-05-05', '2024-05-02 07:16:08', '2024-05-13 11:36:40'),
(47, 31, 7, '1', '0', NULL, '2024-05-05', '2024-05-02 07:16:08', '2024-05-13 11:36:40'),
(48, 31, 8, '0', '0', NULL, '2024-05-05', '2024-05-02 07:16:08', '2024-05-13 11:36:40'),
(49, 32, 5, '1', '0', NULL, '2024-05-05', '2024-05-02 07:17:20', '2024-05-13 11:36:28'),
(50, 32, 6, '2', '0', NULL, '2024-05-05', '2024-05-02 07:17:20', '2024-05-13 11:36:28'),
(51, 32, 7, '1', '0', NULL, '2024-05-05', '2024-05-02 07:17:20', '2024-05-13 11:36:28'),
(52, 32, 8, '0', '0', NULL, '2024-05-05', '2024-05-02 07:17:20', '2024-05-13 11:36:28'),
(53, 44, 5, '1', '0', NULL, '2024-05-05', '2024-05-02 07:17:45', '2024-05-13 11:45:30'),
(54, 44, 6, '2', '0', NULL, '2024-05-05', '2024-05-02 07:17:45', '2024-05-13 11:45:30'),
(55, 44, 7, '0', '0', NULL, '2024-05-05', '2024-05-02 07:17:45', '2024-05-13 11:45:30'),
(56, 44, 8, '0', '0', NULL, '2024-05-05', '2024-05-02 07:17:45', '2024-05-13 11:45:30'),
(57, 45, 5, '2', '0', NULL, '2024-05-05', '2024-05-02 07:18:06', '2024-05-13 11:45:23'),
(58, 45, 6, '2', '0', NULL, '2024-05-05', '2024-05-02 07:18:06', '2024-05-13 11:45:23'),
(59, 45, 7, '1', '0', NULL, '2024-05-05', '2024-05-02 07:18:06', '2024-05-13 11:45:23'),
(60, 45, 8, '0', '0', NULL, '2024-05-05', '2024-05-02 07:18:06', '2024-05-13 11:45:23'),
(61, 46, 5, '2', '0', NULL, '2024-05-05', '2024-05-02 07:20:06', '2024-05-13 11:45:04'),
(62, 46, 6, '3', '0', NULL, '2024-05-05', '2024-05-02 07:20:06', '2024-05-13 11:45:04'),
(63, 46, 7, '3', '0', NULL, '2024-05-05', '2024-05-02 07:20:06', '2024-05-13 11:45:04'),
(64, 46, 8, '0', '0', NULL, '2024-05-05', '2024-05-02 07:20:06', '2024-05-13 11:45:04'),
(65, 43, 5, '0', '0', NULL, NULL, '2024-05-02 07:20:26', '2024-05-09 13:39:47'),
(66, 43, 6, '0', '0', NULL, '2024-05-05', '2024-05-02 07:20:26', '2024-05-13 11:45:41'),
(67, 43, 7, '1', '0', NULL, '2024-05-05', '2024-05-02 07:20:26', '2024-05-13 11:45:41'),
(68, 43, 8, '2', '0', NULL, '2024-05-05', '2024-05-02 07:20:26', '2024-05-13 11:45:41'),
(69, 42, 5, '2', '0', NULL, '2024-05-05', '2024-05-02 07:20:59', '2024-05-13 11:45:50'),
(70, 42, 6, '0', '0', NULL, '2024-05-05', '2024-05-02 07:20:59', '2024-05-13 11:45:50'),
(71, 42, 7, '0', '0', NULL, '2024-05-05', '2024-05-02 07:20:59', '2024-05-13 11:45:50'),
(72, 42, 8, '0', '0', NULL, '2024-05-05', '2024-05-02 07:20:59', '2024-05-13 11:45:50'),
(73, 41, 5, '2', '0', NULL, '2024-05-05', '2024-05-02 07:21:34', '2024-05-13 11:42:54'),
(74, 41, 6, '0', '0', NULL, '2024-05-05', '2024-05-02 07:21:34', '2024-05-13 11:42:54'),
(75, 41, 7, '4', '0', NULL, '2024-05-05', '2024-05-02 07:21:34', '2024-05-13 11:42:54'),
(76, 41, 8, '2', '0', NULL, '2024-05-05', '2024-05-02 07:21:34', '2024-05-13 11:42:54'),
(77, 40, 5, '2', '0', NULL, '2024-05-05', '2024-05-02 07:21:58', '2024-05-13 11:43:21'),
(78, 40, 6, '3', '0', NULL, '2024-05-05', '2024-05-02 07:21:58', '2024-05-13 11:43:21'),
(79, 40, 7, '4', '0', NULL, '2024-05-05', '2024-05-02 07:21:58', '2024-05-13 11:43:21'),
(80, 40, 8, '0', '0', NULL, '2024-05-05', '2024-05-02 07:21:58', '2024-05-13 11:43:21'),
(81, 50, 5, '2', '0', NULL, '2024-05-02', '2024-05-02 09:15:52', '2024-05-11 16:16:07'),
(82, 50, 6, '9', '0', NULL, '2024-05-02', '2024-05-02 09:15:52', '2024-05-11 16:16:07'),
(83, 50, 7, '12', '0', NULL, '2024-05-02', '2024-05-02 09:15:52', '2024-05-11 16:16:07'),
(84, 48, 5, '5', '0', NULL, NULL, '2024-05-04 18:33:33', '2024-05-12 16:15:07'),
(85, 48, 6, '2', '2', NULL, NULL, '2024-05-04 18:33:33', '2024-05-15 08:12:57'),
(86, 48, 7, '6', '2', NULL, NULL, '2024-05-04 18:33:33', '2024-05-15 08:12:57'),
(87, 48, 8, '4', '3', NULL, NULL, '2024-05-04 18:33:33', '2024-05-15 08:12:57'),
(88, 47, 5, '4', '0', NULL, '2024-05-02', '2024-05-04 18:34:23', '2024-05-11 16:13:25'),
(89, 47, 6, '5', '0', NULL, '2024-05-02', '2024-05-04 18:34:23', '2024-05-11 16:13:25'),
(90, 47, 7, '8', '0', NULL, '2024-05-02', '2024-05-04 18:34:23', '2024-05-11 16:13:25'),
(91, 47, 8, '1', '0', NULL, '2024-05-02', '2024-05-04 18:34:23', '2024-05-11 16:13:25'),
(92, 49, 5, '3', '0', NULL, NULL, '2024-05-04 18:35:38', '2024-05-12 16:16:23'),
(93, 49, 6, '7', '0', NULL, NULL, '2024-05-04 18:35:38', '2024-05-12 16:16:23'),
(94, 49, 7, '9', '0', NULL, NULL, '2024-05-04 18:35:38', '2024-05-12 16:16:23'),
(95, 49, 8, '6', '1', NULL, NULL, '2024-05-04 18:35:38', '2024-05-15 08:05:47'),
(96, 39, 5, '2', '0', NULL, '2024-05-02', '2024-05-04 18:36:50', '2024-05-11 16:13:04'),
(97, 39, 6, '2', '0', NULL, '2024-05-02', '2024-05-04 18:36:50', '2024-05-11 16:13:04'),
(98, 39, 7, '4', '0', NULL, '2024-05-02', '2024-05-04 18:36:50', '2024-05-11 16:13:04'),
(99, 39, 8, '1', '0', NULL, '2024-05-02', '2024-05-04 18:36:50', '2024-05-11 16:13:04'),
(100, 55, 5, '0', '0', NULL, '2024-05-10', '2024-05-09 13:11:27', '2024-05-12 16:00:35'),
(101, 55, 6, '5', '0', NULL, '2024-05-10', '2024-05-09 13:11:27', '2024-05-12 16:00:35'),
(102, 55, 7, '10', '0', NULL, '2024-05-10', '2024-05-09 13:11:27', '2024-05-12 16:00:35'),
(103, 55, 8, '6', '0', NULL, '2024-05-10', '2024-05-09 13:11:27', '2024-05-12 16:00:35'),
(104, 56, 5, '0', '0', NULL, '2024-05-10', '2024-05-09 13:17:08', '2024-05-12 16:02:37'),
(105, 56, 6, '4', '0', NULL, '2024-05-10', '2024-05-09 13:17:08', '2024-05-12 16:02:37'),
(106, 56, 7, '15', '0', NULL, '2024-05-10', '2024-05-09 13:17:08', '2024-05-12 16:02:37'),
(107, 56, 8, '8', '0', NULL, '2024-05-10', '2024-05-09 13:17:08', '2024-05-12 16:02:37'),
(108, 52, 5, '0', '0', NULL, '2024-05-10', '2024-05-09 13:19:39', '2024-05-12 15:59:04'),
(109, 52, 6, '5', '0', NULL, '2024-05-10', '2024-05-09 13:19:39', '2024-05-12 15:59:04'),
(110, 52, 7, '1', '0', NULL, '2024-05-10', '2024-05-09 13:19:39', '2024-05-12 15:59:04'),
(111, 52, 8, '7', '0', NULL, '2024-05-10', '2024-05-09 13:19:39', '2024-05-12 15:59:04'),
(112, 53, 5, '0', '0', NULL, '2024-05-10', '2024-05-09 13:19:57', '2024-05-12 15:59:43'),
(113, 53, 6, '0', '0', NULL, '2024-05-10', '2024-05-09 13:19:57', '2024-05-12 15:59:43'),
(114, 53, 7, '13', '0', NULL, '2024-05-10', '2024-05-09 13:19:57', '2024-05-12 15:59:43'),
(115, 53, 8, '0', '0', NULL, '2024-05-10', '2024-05-09 13:19:57', '2024-05-12 15:59:43'),
(116, 57, 5, '0', '0', NULL, '2024-05-10', '2024-05-09 13:32:35', '2024-05-13 11:44:33'),
(117, 57, 6, '3', '0', NULL, '2024-05-10', '2024-05-09 13:32:35', '2024-05-13 11:44:33'),
(118, 57, 7, '9', '2', NULL, '2024-05-10', '2024-05-09 13:32:35', '2024-05-15 08:11:11'),
(119, 57, 8, '4', '1', NULL, '2024-05-10', '2024-05-09 13:32:35', '2024-05-15 08:11:11'),
(120, 43, 18, '1', '0', NULL, '2024-05-05', '2024-05-09 13:39:47', '2024-05-13 11:45:41'),
(121, 48, 18, '1', '1', NULL, NULL, '2024-05-11 16:15:29', '2024-05-15 08:12:57'),
(122, 49, 18, '1', '1', NULL, NULL, '2024-05-11 16:15:49', '2024-05-15 08:05:47'),
(123, 58, 6, '5', '0', NULL, '2024-05-10', '2024-05-12 16:10:14', '2024-05-15 08:17:52'),
(124, 58, 7, '18', '3', NULL, '2024-05-10', '2024-05-12 16:10:14', '2024-05-15 08:09:44'),
(125, 58, 8, '10', '6', NULL, '2024-05-10', '2024-05-12 16:10:14', '2024-05-15 08:17:52'),
(126, 58, 18, '1', '1', NULL, '2024-05-10', '2024-05-12 16:10:14', '2024-05-15 08:09:44'),
(127, 71, 6, '0', '0', NULL, '2024-05-10', '2024-05-15 08:02:29', '2024-05-15 08:02:29'),
(128, 71, 7, '1', '1', NULL, '2024-05-10', '2024-05-15 08:02:29', '2024-05-15 08:05:47'),
(129, 71, 8, '6', '1', NULL, '2024-05-10', '2024-05-15 08:02:29', '2024-05-15 08:05:47'),
(130, 71, 18, '1', '1', NULL, '2024-05-10', '2024-05-15 08:02:29', '2024-05-15 08:05:47'),
(131, 71, 19, '1', '0', NULL, '2024-05-10', '2024-05-15 08:02:29', '2024-05-15 08:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tags`
--

INSERT INTO `product_tags` (`id`, `product_id`, `tag`, `created_at`, `updated_at`) VALUES
(58, 27, 'Premium Punjabi', '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(59, 28, 'Premium Punjabi', '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(60, 29, 'Premium Punjabi', '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(61, 31, '', '2024-03-22 20:49:38', '2024-03-22 20:49:38'),
(62, 32, 'Premium Punjabi', '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(63, 33, 'Premium Punjabi', '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(64, 34, 'Standard Punjabi', '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(65, 35, 'Standard Punjabi', '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(66, 36, 'Standard Punjabi', '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(67, 37, 'Standard Punjabi', '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(68, 38, 'Standard Punjabi', '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(69, 39, 'Standard Punjabi', '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(70, 40, 'Regular Punjabi', '2024-03-22 21:35:17', '2024-03-22 21:35:17'),
(71, 41, 'Regular Punjabi', '2024-03-22 21:38:41', '2024-03-22 21:38:41'),
(72, 42, 'Standard Punjabi', '2024-03-22 21:43:39', '2024-03-22 21:43:39'),
(73, 43, 'Standard Punjabi', '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(74, 44, 'Standard Punjabi', '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(75, 45, 'Standard Punjabi', '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(76, 46, 'Standard Punjabi', '2024-03-22 22:49:08', '2024-03-22 22:49:08'),
(77, 27, '', '2024-03-23 10:31:04', '2024-03-23 10:31:04'),
(78, 47, 'Regular Punjabi', '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(79, 48, 'Regular Punjabi', '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(80, 49, 'Regular Punjabi', '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(81, 36, '', '2024-03-23 21:23:55', '2024-03-23 21:23:55'),
(82, 50, 'pajama', '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(83, 50, 'payjama', '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(84, 50, 'trouser', '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(85, 28, '', '2024-03-24 19:09:36', '2024-03-24 19:09:36'),
(86, 29, '', '2024-03-24 19:10:29', '2024-03-24 19:10:29'),
(87, 32, '', '2024-03-24 19:11:43', '2024-03-24 19:11:43'),
(88, 33, '', '2024-03-24 19:12:26', '2024-03-24 19:12:26'),
(89, 34, '', '2024-03-24 19:13:01', '2024-03-24 19:13:01'),
(90, 35, '', '2024-03-24 19:13:46', '2024-03-24 19:13:46'),
(91, 37, '', '2024-03-24 19:15:26', '2024-03-24 19:15:26'),
(92, 38, '', '2024-03-24 19:16:01', '2024-03-24 19:16:01'),
(93, 39, '', '2024-03-24 19:17:12', '2024-03-24 19:17:12'),
(94, 40, '', '2024-03-24 19:18:36', '2024-03-24 19:18:36'),
(95, 41, '', '2024-03-24 19:19:03', '2024-03-24 19:19:03'),
(96, 42, '', '2024-03-24 19:20:15', '2024-03-24 19:20:15'),
(97, 43, '', '2024-03-24 19:20:35', '2024-03-24 19:20:35'),
(98, 44, '', '2024-03-24 19:21:03', '2024-03-24 19:21:03'),
(99, 45, '', '2024-03-24 19:21:29', '2024-03-24 19:21:29'),
(100, 46, '', '2024-03-24 19:21:49', '2024-03-24 19:21:49'),
(101, 47, '', '2024-03-24 19:22:31', '2024-03-24 19:22:31'),
(102, 48, '', '2024-03-24 19:23:01', '2024-03-24 19:23:01'),
(103, 49, '', '2024-03-24 19:23:51', '2024-03-24 19:23:51'),
(105, 50, '', '2024-04-25 14:48:38', '2024-04-25 14:48:38'),
(106, 52, 'PANJABI', '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(107, 53, '', '2024-05-09 12:53:13', '2024-05-09 12:53:13'),
(109, 55, '', '2024-05-09 13:10:21', '2024-05-09 13:10:21'),
(110, 56, '', '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(111, 57, '', '2024-05-09 13:30:30', '2024-05-09 13:30:30'),
(112, 58, '', '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(113, 59, '', '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(114, 60, '', '2024-05-13 07:38:06', '2024-05-13 07:38:06'),
(115, 61, '', '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(116, 62, '', '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(117, 63, '', '2024-05-13 07:45:08', '2024-05-13 07:45:08'),
(118, 64, '', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(119, 65, '', '2024-05-13 07:49:13', '2024-05-13 07:49:13'),
(120, 67, '', '2024-05-13 07:56:09', '2024-05-13 07:56:09'),
(121, 68, '', '2024-05-13 07:59:16', '2024-05-13 07:59:16'),
(122, 69, '', '2024-05-13 08:00:49', '2024-05-13 08:00:49'),
(123, 70, '', '2024-05-13 08:03:04', '2024-05-13 08:03:04'),
(124, 52, '', '2024-05-13 11:58:40', '2024-05-13 11:58:40'),
(125, 71, '', '2024-05-15 07:48:52', '2024-05-15 07:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_thumbnails`
--

CREATE TABLE `product_thumbnails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_thumbnail` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_thumbnails`
--

INSERT INTO `product_thumbnails` (`id`, `product_id`, `product_thumbnail`, `slug`, `created_at`, `updated_at`) VALUES
(29, 27, 'koohen-premium-punjabi-sa01_0.jpg', '', '2024-03-22 20:12:00', '2024-03-22 20:12:00'),
(30, 27, 'koohen-premium-punjabi-sa01_1.jpg', '', '2024-03-22 20:12:01', '2024-03-22 20:12:01'),
(31, 28, 'koohen-premium-punjabi-sa02_0.jpg', '', '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(32, 28, 'koohen-premium-punjabi-sa02_1.jpg', '', '2024-03-22 20:19:25', '2024-03-22 20:19:25'),
(33, 29, 'koohen-premium-punjabi-sa03_0.jpg', '', '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(34, 29, 'koohen-premium-punjabi-sa03_1.jpg', '', '2024-03-22 20:23:44', '2024-03-22 20:23:44'),
(35, 31, 'koohen-premium-punjabi-sa04_0.jpg', '', '2024-03-22 20:49:37', '2024-03-22 20:49:37'),
(36, 31, 'koohen-premium-punjabi-sa04_1.jpg', '', '2024-03-22 20:49:37', '2024-03-22 20:49:37'),
(37, 32, 'koohen-premium-punjabi-sa05_0.jpg', '', '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(38, 32, 'koohen-premium-punjabi-sa05_1.jpg', '', '2024-03-22 20:53:24', '2024-03-22 20:53:24'),
(39, 33, 'koohen-premium-punjabi-sa06_0.jpg', '', '2024-03-22 20:59:12', '2024-03-22 20:59:12'),
(40, 33, 'koohen-premium-punjabi-sa06_1.jpg', '', '2024-03-22 20:59:13', '2024-03-22 20:59:13'),
(41, 34, 'koohen-standard-punjabi-sa07_0.jpg', '', '2024-03-22 21:02:47', '2024-03-22 21:02:47'),
(42, 34, 'koohen-standard-punjabi-sa07_1.jpg', '', '2024-03-22 21:02:48', '2024-03-22 21:02:48'),
(43, 35, 'koohen-standard-punjabi-sa08_0.jpg', '', '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(44, 35, 'koohen-standard-punjabi-sa08_1.jpg', '', '2024-03-22 21:12:59', '2024-03-22 21:12:59'),
(45, 36, 'koohen-standard-punjabi-sa09_0.jpg', '', '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(46, 36, 'koohen-standard-punjabi-sa09_1.jpg', '', '2024-03-22 21:15:33', '2024-03-22 21:15:33'),
(47, 37, 'koohen-standard-punjabi-sa10_0.jpg', '', '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(48, 37, 'koohen-standard-punjabi-sa10_1.jpg', '', '2024-03-22 21:18:35', '2024-03-22 21:18:35'),
(49, 38, 'koohen-standard-punjabi-sa11_0.jpg', '', '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(50, 38, 'koohen-standard-punjabi-sa11_1.jpg', '', '2024-03-22 21:21:25', '2024-03-22 21:21:25'),
(51, 39, 'koohen-standard-punjabi-sa12_0.jpg', '', '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(52, 39, 'koohen-standard-punjabi-sa12_1.jpg', '', '2024-03-22 21:28:29', '2024-03-22 21:28:29'),
(53, 40, 'koohen-regular-punjabi-pr07_0.jpg', '', '2024-03-22 21:35:16', '2024-03-22 21:35:16'),
(54, 40, 'koohen-regular-punjabi-pr07_1.jpg', '', '2024-03-22 21:35:16', '2024-03-22 21:35:16'),
(55, 41, 'koohen-regular-punjabi-pr06_0.jpg', '', '2024-03-22 21:38:40', '2024-03-22 21:38:40'),
(56, 41, 'koohen-regular-punjabi-pr06_1.jpg', '', '2024-03-22 21:38:40', '2024-03-22 21:38:40'),
(57, 42, 'koohen-standard-punjabi-pr05_0.jpg', '', '2024-03-22 21:43:38', '2024-03-22 21:43:38'),
(58, 42, 'koohen-standard-punjabi-pr05_1.jpg', '', '2024-03-22 21:43:38', '2024-03-22 21:43:38'),
(59, 43, 'koohen-standard-punjabi-pr04_0.jpg', '', '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(60, 43, 'koohen-standard-punjabi-pr04_1.jpg', '', '2024-03-22 22:37:36', '2024-03-22 22:37:36'),
(61, 44, 'koohen-standard-punjabi-pr01_0.jpg', '', '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(62, 44, 'koohen-standard-punjabi-pr01_1.jpg', '', '2024-03-22 22:46:38', '2024-03-22 22:46:38'),
(63, 45, 'koohen-standard-punjabi-pr02_0.jpg', '', '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(64, 45, 'koohen-standard-punjabi-pr02_1.jpg', '', '2024-03-22 22:48:06', '2024-03-22 22:48:06'),
(65, 46, 'koohen-standard-punjabi-pr03_0.jpg', '', '2024-03-22 22:49:07', '2024-03-22 22:49:07'),
(66, 46, 'koohen-standard-punjabi-pr03_1.jpg', '', '2024-03-22 22:49:07', '2024-03-22 22:49:07'),
(67, 47, 'koohen-regular-punjabi-pr08_0.jpg', '', '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(68, 47, 'koohen-regular-punjabi-pr08_1.jpg', '', '2024-03-23 20:46:05', '2024-03-23 20:46:05'),
(69, 48, 'koohen-regular-punjabi-pr09_0.jpg', '', '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(70, 48, 'koohen-regular-punjabi-pr09_1.jpg', '', '2024-03-23 20:49:10', '2024-03-23 20:49:10'),
(71, 49, 'koohen-regular-punjabi-pr10_0.jpg', '', '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(72, 49, 'koohen-regular-punjabi-pr10_1.jpg', '', '2024-03-23 20:50:39', '2024-03-23 20:50:39'),
(73, 50, 'mens-premium-pajama-sw01_0.jpg', '', '2024-03-24 19:03:33', '2024-03-24 19:03:33'),
(74, 50, 'mens-premium-pajama-sw01_1.jpg', '', '2024-03-24 19:03:34', '2024-03-24 19:03:34'),
(75, 51, 'koohen-premium-punjabi-sa03354654_0.png', '', '2024-04-24 16:38:32', '2024-04-24 16:38:32'),
(76, 52, 'mens-standard-punjabi-sa14_0.jpg', '', '2024-05-09 12:50:38', '2024-05-09 12:50:38'),
(77, 52, 'mens-standard-punjabi-sa14_1.jpg', '', '2024-05-09 12:50:39', '2024-05-09 12:50:39'),
(78, 53, 'mens-standard-punjabi-sa15_0.jpg', '', '2024-05-09 12:53:12', '2024-05-09 12:53:12'),
(79, 53, 'mens-standard-punjabi-sa15_1.jpg', '', '2024-05-09 12:53:12', '2024-05-09 12:53:12'),
(80, 54, 'mens-standard-punjabi-sa16_0.jpg', '', '2024-05-09 12:55:40', '2024-05-09 12:55:40'),
(81, 54, 'mens-standard-punjabi-sa16_1.jpg', '', '2024-05-09 12:55:40', '2024-05-09 12:55:40'),
(82, 55, 'mens-premium-punjabi-sa16_0.jpg', '', '2024-05-09 13:10:20', '2024-05-09 13:10:20'),
(83, 55, 'mens-premium-punjabi-sa16_1.jpg', '', '2024-05-09 13:10:20', '2024-05-09 13:10:20'),
(84, 56, 'mens-premium-punjabi-sa17_0.jpg', '', '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(85, 56, 'mens-premium-punjabi-sa17_1.jpg', '', '2024-05-09 13:15:58', '2024-05-09 13:15:58'),
(86, 57, 'mens-standard-punjabi-pr11_0.jpg', '', '2024-05-09 13:30:29', '2024-05-09 13:30:29'),
(87, 57, 'mens-standard-punjabi-pr11_1.jpg', '', '2024-05-09 13:30:29', '2024-05-09 13:30:29'),
(88, 58, 'koohen-standard-punjabi-pr12_0.jpg', '', '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(89, 58, 'koohen-standard-punjabi-pr12_1.jpg', '', '2024-05-09 17:03:10', '2024-05-09 17:03:10'),
(90, 59, 'womens-co-ords-set-crds01_0.jpg', '', '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(91, 59, 'womens-co-ords-set-crds01_1.jpg', '', '2024-05-13 07:36:00', '2024-05-13 07:36:00'),
(92, 60, 'womens-co-ords-set-crds02_0.jpg', '', '2024-05-13 07:38:05', '2024-05-13 07:38:05'),
(93, 60, 'womens-co-ords-set-crds02_1.jpg', '', '2024-05-13 07:38:05', '2024-05-13 07:38:05'),
(94, 61, 'womens-co-ords-set-crds03_0.jpg', '', '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(95, 61, 'womens-co-ords-set-crds03_1.jpg', '', '2024-05-13 07:39:59', '2024-05-13 07:39:59'),
(96, 62, 'womens-co-ords-set-crds04_0.jpg', '', '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(97, 62, 'womens-co-ords-set-crds04_1.jpg', '', '2024-05-13 07:42:31', '2024-05-13 07:42:31'),
(98, 63, 'womens-co-ords-set-crds05_0.jpg', '', '2024-05-13 07:45:07', '2024-05-13 07:45:07'),
(99, 63, 'womens-co-ords-set-crds05_1.jpg', '', '2024-05-13 07:45:07', '2024-05-13 07:45:07'),
(100, 64, 'womens-co-ords-set-crds06_0.jpg', '', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(101, 64, 'womens-co-ords-set-crds06_1.jpg', '', '2024-05-13 07:46:42', '2024-05-13 07:46:42'),
(102, 65, 'womens-kaftan-set-kftn01_0.jpg', '', '2024-05-13 07:49:12', '2024-05-13 07:49:12'),
(103, 65, 'womens-kaftan-set-kftn01_1.jpg', '', '2024-05-13 07:49:12', '2024-05-13 07:49:12'),
(104, 67, 'womens-kaftan-set-kftn02_0.jpg', '', '2024-05-13 07:56:08', '2024-05-13 07:56:08'),
(105, 67, 'womens-kaftan-set-kftn02_1.jpg', '', '2024-05-13 07:56:08', '2024-05-13 07:56:08'),
(106, 68, 'womens-kaftan-set-kftn03_0.jpg', '', '2024-05-13 07:59:15', '2024-05-13 07:59:15'),
(107, 68, 'womens-kaftan-set-kftn03_1.jpg', '', '2024-05-13 07:59:15', '2024-05-13 07:59:15'),
(108, 69, 'womens-kaftan-set-kftn04_0.jpg', '', '2024-05-13 08:00:48', '2024-05-13 08:00:48'),
(109, 69, 'womens-kaftan-set-kftn04_1.jpg', '', '2024-05-13 08:00:48', '2024-05-13 08:00:48'),
(110, 70, 'womens-kaftan-set-kftn06_0.jpg', '', '2024-05-13 08:03:03', '2024-05-13 08:03:03'),
(111, 70, 'womens-kaftan-set-kftn06_1.jpg', '', '2024-05-13 08:03:03', '2024-05-13 08:03:03'),
(112, 71, 'mens-premium-punjabi-sa13_0.jpg', '', '2024-05-15 07:48:52', '2024-05-15 07:48:52'),
(113, 71, 'mens-premium-punjabi-sa13_1.jpg', '', '2024-05-15 07:48:52', '2024-05-15 07:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `register_customers`
--

CREATE TABLE `register_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('registerd','not registerd') NOT NULL DEFAULT 'registerd',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_customers`
--

INSERT INTO `register_customers` (`id`, `customer_id`, `phone`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(25, 88, '01738758133', 'rifatakhon@gmail.com', '$2y$12$xY1igSkwKfn80Pkx01KbQuNtszX42MOcSQOiEhW9tz0xrdCn1Q02W', 'registerd', NULL, '2024-03-24 16:38:57', '2024-03-24 16:38:57'),
(26, 89, '01844674502', 'admin@koohen.com', '$2y$12$AZSjq25ykEsOVj4ZUdGjneugblX/CQvS0maVCPNhs7.dh0fFyKjwm', 'registerd', NULL, '2024-03-24 16:40:58', '2024-03-24 16:40:58'),
(27, 109, '01640357386', 'kohenlifestyle@gmail.com', '$2y$12$rIZKMfgMs9ODkWWrvKghG..yxYu7R8aso4kh8OmNmY0aOMhm/hVcm', 'registerd', NULL, '2024-03-25 08:14:21', '2024-03-25 08:14:21'),
(28, 128, '01884238552', 'mdashikmia1765@gmail.com', '$2y$12$2KYnetETrjDcxwUGzWPYzuqUNTUEl6n4uVYXy5sw1wFv/Whppwkoa', 'registerd', NULL, '2024-03-27 04:56:36', '2024-03-27 04:56:36'),
(29, 177, '01321198919', 'shahin229737@gmail.com', '$2y$12$Yanq.WsVeDoXmvAWrCWV/OAFtl9b6Ys9O0Yg4sz.5ksBI.iN6VgZC', 'registerd', NULL, '2024-04-01 12:05:35', '2024-04-01 12:05:35'),
(30, 206, '01601958560', 'arifhossen853@gmail.com', '$2y$12$Xab0jSdxG.lqlgThYg1ce.vYy2db5NEhwmAExpe0DPLoe69enxExS', 'registerd', NULL, '2024-04-03 05:23:27', '2024-04-03 05:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'Super Admin', 'web', '2024-03-21 04:41:50', '2024-03-21 12:06:04'),
(3, 'Admin', 'web', '2024-03-21 04:41:55', '2024-03-21 04:41:55'),
(4, 'Manager', 'web', '2024-03-21 04:42:02', '2024-03-21 04:42:02'),
(5, 'User', 'web', '2024-03-21 04:42:08', '2024-03-21 04:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seoTitle` varchar(255) NOT NULL,
  `seoLogo` varchar(255) NOT NULL,
  `seoDescription` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `seoTitle`, `seoLogo`, `seoDescription`, `created_at`, `updated_at`) VALUES
(2, 'Koohen', '1714553583.png', 'Koohen offers a wide range of clothing, including T-shirts, hoodies, traditional Panjabi and Sharee dresses. Orders are carefully handled from Dhaka and delivered across Bangladesh!', '2024-05-01 02:53:03', '2024-05-01 02:53:03'),
(3, 'Koohen', '1714554658.png', 'Koohen offers a wide range of clothing, including T-shirts, hoodies, traditional Panjabi and Sharee dresses. Orders are carefully handled from Dhaka and delivered across Bangladesh!', '2024-05-01 09:10:58', '2024-05-01 09:10:58'),
(4, 'Koohen', '1714554671.png', 'Koohen offers a wide range of clothing, including T-shirts, hoodies, traditional Panjabi and Sharee dresses. Orders are carefully handled from Dhaka and delivered across Bangladesh!', '2024-05-01 09:11:11', '2024-05-01 09:11:11'),
(5, 'Koohen', '1714554732.png', 'Koohen offers a wide range of clothing, including T-shirts, hoodies, traditional Panjabi and Sharee dresses. Orders are carefully handled from Dhaka and delivered across Bangladesh!', '2024-05-01 09:12:12', '2024-05-01 09:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `primary_mobile_no` varchar(255) DEFAULT NULL,
  `secondary_mobile_no` varchar(255) DEFAULT NULL,
  `whatsapp_url` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `company_short_details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `primary_mobile_no`, `secondary_mobile_no`, `whatsapp_url`, `email`, `company_address`, `company_short_details`, `created_at`, `updated_at`) VALUES
(1, '+880 1751218778', '+8809639174502', 'https://wa.link/3qi05h', 'support@koohen.com', '522/B, North Shahjahanpur, Dhaka-1217', 'Koohen offers a wide range of clothing, including T-shirts, hoodies, traditional Panjabi and Sharee dresses. Orders are carefully handled from Dhaka and delivered across Bangladesh!', NULL, '2024-02-18 08:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `s_phone` varchar(255) NOT NULL,
  `s_email` varchar(255) NOT NULL,
  `shipping_add` text NOT NULL,
  `division` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `area` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `customer_id`, `order_id`, `first_name`, `last_name`, `s_phone`, `s_email`, `shipping_add`, `division`, `district`, `area`, `created_at`, `updated_at`) VALUES
(33, 88, 99, 'MD RIFAT', 'HOSSAIN', '01738758133', 'rifatakhon@gmail.com', '522/B, North Sahjahanpur', '3', '1', 455, '2024-03-24 16:38:57', '2024-03-24 16:38:57'),
(34, 89, 100, 'Rifat', 'Hossain', '01844674502', 'admin@koohen.com', 'Dhaka', '3', '6', 582, '2024-03-24 16:40:58', '2024-03-24 16:40:58'),
(35, 109, 123, 'fdsaf', 'fdsaf', '01640357386', 'kohenlifestyle@gmail.com', 'satkhira', '4', '64', 991, '2024-03-25 08:14:21', '2024-03-25 08:14:21'),
(36, 128, 142, 'Ashik', 'Hossen', '01884238552', 'mdashikmia1765@gmail.com', 'Rajshai road', '5', '24', 1093, '2024-03-27 04:56:36', '2024-03-27 04:56:36'),
(37, 206, 224, 'Arif', 'Hossen', '01601958560', 'arifhossen853@gmail.com', '1/86 East Rasulpur, Kajla, Jatrabari, Dhaka 1236', '3', '1', 461, '2024-04-03 05:23:27', '2024-04-03 05:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(255) NOT NULL,
  `instance` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size_name` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size_name`, `size`, `status`, `created_at`, `updated_at`) VALUES
(5, '38', '38', '1', '2024-02-07 08:17:02', '2024-02-07 08:17:02'),
(6, '40', '40', '1', '2024-02-07 08:17:10', '2024-02-07 08:17:10'),
(7, '42', '42', '1', '2024-02-07 08:17:18', '2024-02-07 08:17:18'),
(8, '44', '44', '1', '2024-02-07 08:17:26', '2024-02-07 08:17:26'),
(18, '48', '48', '1', '2024-05-09 13:36:52', '2024-05-09 13:36:52'),
(19, '46', '46', '1', '2024-05-11 16:15:01', '2024-05-11 16:15:01'),
(26, 'S', 'Small', '1', '2024-05-13 06:40:25', '2024-05-13 06:40:25'),
(27, 'M', 'Medium', '1', '2024-05-13 06:40:37', '2024-05-13 06:40:37'),
(28, 'L', 'Large', '1', '2024-05-13 06:40:48', '2024-05-13 06:40:48'),
(29, 'XL', 'Extra Large', '1', '2024-05-13 06:41:09', '2024-05-13 06:41:09'),
(30, 'XXL', 'Double Extra Large', '1', '2024-05-13 06:41:26', '2024-05-13 06:41:26'),
(31, 'Free Size', 'Free Size', '1', '2024-05-13 06:42:09', '2024-05-13 06:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `btntext` varchar(255) DEFAULT NULL,
  `slider_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `subtitle`, `btntext`, `slider_url`, `image`, `created_at`, `updated_at`) VALUES
(5, 'New Arrivals', 'Summer Collection 2024', 'View More', 'https://koohen.com/shop', 'slider/1715242980.jpg', '2024-02-08 08:56:27', '2024-05-09 08:23:00'),
(8, 'New Arrivals', 'Summer Collection 2024', 'View More', 'https://koohen.com/shop', 'slider/1715243000.jpg', '2024-05-09 08:23:20', '2024-05-09 08:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `socialinfos`
--

CREATE TABLE `socialinfos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `social_title` varchar(255) NOT NULL,
  `title_value` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socialinfos`
--

INSERT INTO `socialinfos` (`id`, `social_title`, `title_value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Phone', '+8809639174502', '1', '2024-05-05 00:05:57', '2024-05-05 11:35:58'),
(2, 'Email', 'support@koohen.com', '1', '2024-05-05 00:05:57', '2024-05-05 01:41:43'),
(3, 'WhatsApp', '01844674502', '1', '2024-05-05 00:05:57', '2024-05-05 11:52:53'),
(4, 'Facebook', 'https://www.facebook.com/koohen', '1', '2024-05-05 00:05:57', '2024-05-05 11:43:05'),
(5, 'Instagram', 'https://www.instagram.com', '1', '2024-05-05 00:05:57', '2024-05-05 00:05:57'),
(6, 'LinkedIn', 'https://www.linkedin.com', '1', '2024-05-05 00:05:57', '2024-05-05 00:05:57'),
(7, 'YouTube', 'https://www.youtube.com', '1', '2024-05-05 00:05:57', '2024-05-05 00:05:57'),
(8, 'Twitter', 'https://www.twitter.com', '1', '2024-05-05 00:05:57', '2024-05-07 06:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `subcategory_image` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `balance` decimal(8,2) NOT NULL DEFAULT 0.00,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `phone`, `email`, `address`, `balance`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Haji Embroidery', '01827313588', NULL, 'Kamrangirchor, Nobinagar', 0.00, 'Active', '2024-02-07 08:21:22', '2024-02-07 08:21:22');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mode` enum('cod','card','online','cash','bkash','nagad','rocket') NOT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `status` enum('paid','unpaid','declined','refunded') DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_id`, `order_id`, `mode`, `transaction_no`, `status`, `created_at`, `updated_at`) VALUES
(6, 269, 6, 'cash', NULL, 'unpaid', '2024-05-13 10:05:41', '2024-05-13 10:05:41'),
(7, 270, 7, 'cash', NULL, 'unpaid', '2024-05-13 11:29:07', '2024-05-13 11:29:07'),
(8, 271, 8, 'cash', NULL, 'paid', '2024-05-15 08:05:47', '2024-05-15 08:05:47'),
(9, 271, 9, 'cash', NULL, 'paid', '2024-05-15 08:09:44', '2024-05-15 10:12:44'),
(10, 271, 10, 'cash', NULL, 'unpaid', '2024-05-15 08:11:11', '2024-05-15 08:11:11'),
(11, 271, 11, 'cash', NULL, 'unpaid', '2024-05-15 08:12:57', '2024-05-15 08:12:57'),
(12, 272, 12, 'cash', NULL, 'unpaid', '2024-05-18 07:51:12', '2024-05-18 07:51:12'),
(13, 273, 13, 'cash', NULL, 'unpaid', '2024-05-19 08:16:52', '2024-05-19 08:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `upazillas`
--

CREATE TABLE `upazillas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bn_name` varchar(255) NOT NULL,
  `zone_charge` decimal(10,0) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upazillas`
--

INSERT INTO `upazillas` (`id`, `district_id`, `name`, `bn_name`, `zone_charge`, `created_at`, `updated_at`) VALUES
(1, 34, 'Amtali', 'আমতলী', 130, NULL, NULL),
(2, 34, 'Bamna', 'বামনা', 130, NULL, NULL),
(3, 34, 'Barguna Sadar', 'বরগুনা সদর', 130, NULL, NULL),
(4, 34, 'Betagi', 'বেতাগি', 130, NULL, NULL),
(5, 34, 'Patharghata', 'পাথরঘাটা', 130, NULL, NULL),
(6, 34, 'Taltali', 'তালতলী', 130, NULL, NULL),
(7, 35, 'Muladi', 'মুলাদি', 130, NULL, NULL),
(8, 35, 'Babuganj', 'বাবুগঞ্জ', 130, NULL, NULL),
(9, 35, 'Agailjhara', 'আগাইলঝরা', 130, NULL, NULL),
(10, 35, 'Barisal Sadar', 'বরিশাল সদর', 130, NULL, NULL),
(11, 35, 'Bakerganj', 'বাকেরগঞ্জ', 130, NULL, NULL),
(12, 35, 'Banaripara', 'বানাড়িপারা', 130, NULL, NULL),
(13, 35, 'Gaurnadi', 'গৌরনদী', 130, NULL, NULL),
(14, 35, 'Hizla', 'হিজলা', 130, NULL, NULL),
(15, 35, 'Mehendiganj', 'মেহেদিগঞ্জ ', 130, NULL, NULL),
(16, 35, 'Wazirpur', 'ওয়াজিরপুর', 130, NULL, NULL),
(17, 36, 'Bhola Sadar', 'ভোলা সদর', 130, NULL, NULL),
(18, 36, 'Burhanuddin', 'বুরহানউদ্দিন', 130, NULL, NULL),
(19, 36, 'Char Fasson', 'চর ফ্যাশন', 130, NULL, NULL),
(20, 36, 'Daulatkhan', 'দৌলতখান', 130, NULL, NULL),
(21, 36, 'Lalmohan', 'লালমোহন', 130, NULL, NULL),
(22, 36, 'Manpura', 'মনপুরা', 130, NULL, NULL),
(23, 36, 'Tazumuddin', 'তাজুমুদ্দিন', 130, NULL, NULL),
(24, 37, 'Jhalokati Sadar', 'ঝালকাঠি সদর', 130, NULL, NULL),
(25, 37, 'Kathalia', 'কাঁঠালিয়া', 130, NULL, NULL),
(26, 37, 'Nalchity', 'নালচিতি', 130, NULL, NULL),
(27, 37, 'Rajapur', 'রাজাপুর', 130, NULL, NULL),
(28, 38, 'Bauphal', 'বাউফল', 130, NULL, NULL),
(29, 38, 'Dashmina', 'দশমিনা', 130, NULL, NULL),
(30, 38, 'Galachipa', 'গলাচিপা', 130, NULL, NULL),
(31, 38, 'Kalapara', 'কালাপারা', 130, NULL, NULL),
(32, 38, 'Mirzaganj', 'মির্জাগঞ্জ ', 130, NULL, NULL),
(33, 38, 'Patuakhali Sadar', 'পটুয়াখালী সদর', 130, NULL, NULL),
(34, 38, 'Dumki', 'ডুমকি', 130, NULL, NULL),
(35, 38, 'Rangabali', 'রাঙ্গাবালি', 130, NULL, NULL),
(36, 39, 'Bhandaria', 'ভ্যান্ডারিয়া', 130, NULL, NULL),
(37, 39, 'Kaukhali', 'কাউখালি', 130, NULL, NULL),
(38, 39, 'Mathbaria', 'মাঠবাড়িয়া', 130, NULL, NULL),
(39, 39, 'Nazirpur', 'নাজিরপুর', 130, NULL, NULL),
(40, 39, 'Nesarabad', 'নেসারাবাদ', 130, NULL, NULL),
(41, 39, 'Pirojpur Sadar', 'পিরোজপুর সদর', 130, NULL, NULL),
(42, 39, 'Zianagar', 'জিয়ানগর', 130, NULL, NULL),
(43, 40, 'Bandarban Sadar', 'বান্দরবন সদর', 130, NULL, NULL),
(44, 40, 'Thanchi', 'থানচি', 130, NULL, NULL),
(45, 40, 'Lama', 'লামা', 130, NULL, NULL),
(46, 40, 'Naikhongchhari', 'নাইখংছড়ি ', 130, NULL, NULL),
(47, 40, 'Ali kadam', 'আলী কদম', 130, NULL, NULL),
(48, 40, 'Rowangchhari', 'রউয়াংছড়ি ', 130, NULL, NULL),
(49, 40, 'Ruma', 'রুমা', 130, NULL, NULL),
(50, 41, 'Brahmanbaria Sadar', 'ব্রাহ্মণবাড়িয়া সদর', 130, NULL, NULL),
(51, 41, 'Ashuganj', 'আশুগঞ্জ', 130, NULL, NULL),
(52, 41, 'Nasirnagar', 'নাসির নগর', 130, NULL, NULL),
(53, 41, 'Nabinagar', 'নবীনগর', 130, NULL, NULL),
(54, 41, 'Sarail', 'সরাইল', 130, NULL, NULL),
(55, 41, 'Shahbazpur Town', 'শাহবাজপুর টাউন', 130, NULL, NULL),
(56, 41, 'Kasba', 'কসবা', 130, NULL, NULL),
(57, 41, 'Akhaura', 'আখাউরা', 130, NULL, NULL),
(58, 41, 'Bancharampur', 'বাঞ্ছারামপুর', 130, NULL, NULL),
(59, 41, 'Bijoynagar', 'বিজয় নগর', 130, NULL, NULL),
(60, 42, 'Chandpur Sadar', 'চাঁদপুর সদর', 130, NULL, NULL),
(61, 42, 'Faridganj', 'ফরিদগঞ্জ', 130, NULL, NULL),
(62, 42, 'Haimchar', 'হাইমচর', 130, NULL, NULL),
(63, 42, 'Haziganj', 'হাজীগঞ্জ', 130, NULL, NULL),
(64, 42, 'Kachua', 'কচুয়া', 130, NULL, NULL),
(65, 42, 'Matlab Uttar', 'মতলব উত্তর', 130, NULL, NULL),
(66, 42, 'Matlab Dakkhin', 'মতলব দক্ষিণ', 130, NULL, NULL),
(67, 42, 'Shahrasti', 'শাহরাস্তি', 130, NULL, NULL),
(68, 43, 'Anwara', 'আনোয়ারা', 130, NULL, NULL),
(69, 43, 'Banshkhali', 'বাশখালি', 130, NULL, NULL),
(70, 43, 'Boalkhali', 'বোয়ালখালি', 130, NULL, NULL),
(71, 43, 'Chandanaish', 'চন্দনাইশ', 130, NULL, NULL),
(72, 43, 'Fatikchhari', 'ফটিকছড়ি', 130, NULL, NULL),
(73, 43, 'Hathazari', 'হাঠহাজারী', 130, NULL, NULL),
(74, 43, 'Lohagara', 'লোহাগারা', 130, NULL, NULL),
(75, 43, 'Mirsharai', 'মিরসরাই', 130, NULL, NULL),
(76, 43, 'Patiya', 'পটিয়া', 130, NULL, NULL),
(77, 43, 'Rangunia', 'রাঙ্গুনিয়া', 130, NULL, NULL),
(78, 43, 'Raozan', 'রাউজান', 130, NULL, NULL),
(79, 43, 'Sandwip', 'সন্দ্বীপ', 130, NULL, NULL),
(80, 43, 'Satkania', 'সাতকানিয়া', 130, NULL, NULL),
(81, 43, 'Sitakunda', 'সীতাকুণ্ড', 130, NULL, NULL),
(82, 44, 'Barura', 'বড়ুরা', 130, NULL, NULL),
(83, 44, 'Brahmanpara', 'ব্রাহ্মণপাড়া', 130, NULL, NULL),
(84, 44, 'Burichong', 'বুড়িচং', 130, NULL, NULL),
(85, 44, 'Chandina', 'চান্দিনা', 130, NULL, NULL),
(86, 44, 'Chauddagram', 'চৌদ্দগ্রাম', 130, NULL, NULL),
(87, 44, 'Daudkandi', 'দাউদকান্দি', 130, NULL, NULL),
(88, 44, 'Debidwar', 'দেবীদ্বার', 130, NULL, NULL),
(89, 44, 'Homna', 'হোমনা', 130, NULL, NULL),
(90, 44, 'Comilla Sadar', 'কুমিল্লা সদর', 130, NULL, NULL),
(91, 44, 'Laksam', 'লাকসাম', 130, NULL, NULL),
(92, 44, 'Monohorgonj', 'মনোহরগঞ্জ', 130, NULL, NULL),
(93, 44, 'Meghna', 'মেঘনা', 130, NULL, NULL),
(94, 44, 'Muradnagar', 'মুরাদনগর', 130, NULL, NULL),
(95, 44, 'Nangalkot', 'নাঙ্গালকোট', 130, NULL, NULL),
(96, 44, 'Comilla Sadar South', 'কুমিল্লা সদর দক্ষিণ', 130, NULL, NULL),
(97, 44, 'Titas', 'তিতাস', 130, NULL, NULL),
(98, 45, 'Chakaria', 'চকরিয়া', 130, NULL, NULL),
(100, 45, '{{198}}\'\'{{199}}', 'কক্স বাজার সদর', 130, NULL, NULL),
(101, 45, 'Kutubdia', 'কুতুবদিয়া', 130, NULL, NULL),
(102, 45, 'Maheshkhali', 'মহেশখালী', 130, NULL, NULL),
(103, 45, 'Ramu', 'রামু', 130, NULL, NULL),
(104, 45, 'Teknaf', 'টেকনাফ', 130, NULL, NULL),
(105, 45, 'Ukhia', 'উখিয়া', 130, NULL, NULL),
(106, 45, 'Pekua', 'পেকুয়া', 130, NULL, NULL),
(107, 46, 'Feni Sadar', 'ফেনী সদর', 130, NULL, NULL),
(108, 46, 'Chagalnaiya', 'ছাগল নাইয়া', 130, NULL, NULL),
(109, 46, 'Daganbhyan', 'দাগানভিয়া', 130, NULL, NULL),
(110, 46, 'Parshuram', 'পরশুরাম', 130, NULL, NULL),
(111, 46, 'Fhulgazi', 'ফুলগাজি', 130, NULL, NULL),
(112, 46, 'Sonagazi', 'সোনাগাজি', 130, NULL, NULL),
(113, 47, 'Dighinala', 'দিঘিনালা ', 130, NULL, NULL),
(114, 47, 'Khagrachhari', 'খাগড়াছড়ি', 130, NULL, NULL),
(115, 47, 'Lakshmichhari', 'লক্ষ্মীছড়ি', 130, NULL, NULL),
(116, 47, 'Mahalchhari', 'মহলছড়ি', 130, NULL, NULL),
(117, 47, 'Manikchhari', 'মানিকছড়ি', 130, NULL, NULL),
(118, 47, 'Matiranga', 'মাটিরাঙ্গা', 130, NULL, NULL),
(119, 47, 'Panchhari', 'পানছড়ি', 130, NULL, NULL),
(120, 47, 'Ramgarh', 'রামগড়', 130, NULL, NULL),
(121, 48, 'Lakshmipur Sadar', 'লক্ষ্মীপুর সদর', 130, NULL, NULL),
(122, 48, 'Raipur', 'রায়পুর', 130, NULL, NULL),
(123, 48, 'Ramganj', 'রামগঞ্জ', 130, NULL, NULL),
(124, 48, 'Ramgati', 'রামগতি', 130, NULL, NULL),
(125, 48, 'Komol Nagar', 'কমল নগর', 130, NULL, NULL),
(126, 49, 'Noakhali Sadar', 'নোয়াখালী সদর', 130, NULL, NULL),
(127, 49, 'Begumganj', 'বেগমগঞ্জ', 130, NULL, NULL),
(128, 49, 'Chatkhil', 'চাটখিল', 130, NULL, NULL),
(129, 49, 'Companyganj', 'কোম্পানীগঞ্জ', 130, NULL, NULL),
(130, 49, 'Shenbag', 'শেনবাগ', 130, NULL, NULL),
(131, 49, 'Hatia', 'হাতিয়া', 130, NULL, NULL),
(132, 49, 'Kobirhat', 'কবিরহাট ', 130, NULL, NULL),
(133, 49, 'Sonaimuri', 'সোনাইমুরি', 130, NULL, NULL),
(134, 49, 'Suborno Char', 'সুবর্ণ চর ', 130, NULL, NULL),
(135, 50, 'Rangamati Sadar', 'রাঙ্গামাটি সদর', 130, NULL, NULL),
(136, 50, 'Belaichhari', 'বেলাইছড়ি', 130, NULL, NULL),
(137, 50, 'Bagaichhari', 'বাঘাইছড়ি', 130, NULL, NULL),
(138, 50, 'Barkal', 'বরকল', 130, NULL, NULL),
(139, 50, 'Juraichhari', 'জুরাইছড়ি', 130, NULL, NULL),
(140, 50, 'Rajasthali', 'রাজাস্থলি', 130, NULL, NULL),
(141, 50, 'Kaptai', 'কাপ্তাই', 130, NULL, NULL),
(142, 50, 'Langadu', 'লাঙ্গাডু', 130, NULL, NULL),
(143, 50, 'Nannerchar', 'নান্নেরচর ', 130, NULL, NULL),
(144, 50, 'Kaukhali', 'কাউখালি', 130, NULL, NULL),
(145, 1, 'Dhamrai', 'ধামরাই', 80, NULL, NULL),
(146, 1, 'Dohar', 'দোহার', 80, NULL, '2024-01-29 03:04:04'),
(147, 1, 'Keraniganj', 'কেরানীগঞ্জ', 80, NULL, NULL),
(148, 1, 'Nawabganj', 'নবাবগঞ্জ', 80, NULL, NULL),
(149, 1, 'Savar', 'সাভার', 80, NULL, NULL),
(150, 2, 'Faridpur Sadar', 'ফরিদপুর সদর', 130, NULL, NULL),
(151, 2, 'Boalmari', 'বোয়ালমারী', 130, NULL, NULL),
(152, 2, 'Alfadanga', 'আলফাডাঙ্গা', 130, NULL, NULL),
(153, 2, 'Madhukhali', 'মধুখালি', 130, NULL, NULL),
(154, 2, 'Bhanga', 'ভাঙ্গা', 130, NULL, NULL),
(155, 2, 'Nagarkanda', 'নগরকান্ড', 130, NULL, NULL),
(156, 2, 'Charbhadrasan', 'চরভদ্রাসন ', 130, NULL, NULL),
(157, 2, 'Sadarpur', 'সদরপুর', 130, NULL, NULL),
(158, 2, 'Shaltha', 'শালথা', 130, NULL, NULL),
(159, 3, 'Gazipur Sadar-Joydebpur', 'গাজীপুর সদর', 130, NULL, NULL),
(160, 3, 'Kaliakior', 'কালিয়াকৈর', 130, NULL, NULL),
(161, 3, 'Kapasia', 'কাপাসিয়া', 130, NULL, NULL),
(162, 3, 'Sripur', 'শ্রীপুর', 50, NULL, '2024-01-29 03:51:16'),
(163, 3, 'Kaliganj', 'কালীগঞ্জ', 130, NULL, NULL),
(164, 3, 'Tongi', 'টঙ্গি', 130, NULL, NULL),
(165, 4, 'Gopalganj Sadar', 'গোপালগঞ্জ সদর', 130, NULL, NULL),
(166, 4, 'Kashiani', 'কাশিয়ানি', 130, NULL, NULL),
(167, 4, 'Kotalipara', 'কোটালিপাড়া', 130, NULL, NULL),
(168, 4, 'Muksudpur', 'মুকসুদপুর', 130, NULL, NULL),
(169, 4, 'Tungipara', 'টুঙ্গিপাড়া', 130, NULL, NULL),
(170, 5, 'Dewanganj', 'দেওয়ানগঞ্জ', 130, NULL, NULL),
(171, 5, 'Baksiganj', 'বকসিগঞ্জ', 130, NULL, NULL),
(172, 5, 'Islampur', 'ইসলামপুর', 130, NULL, NULL),
(173, 5, 'Jamalpur Sadar', 'জামালপুর সদর', 130, NULL, NULL),
(174, 5, 'Madarganj', 'মাদারগঞ্জ', 130, NULL, NULL),
(175, 5, 'Melandaha', 'মেলানদাহা', 130, NULL, NULL),
(176, 5, 'Sarishabari', 'সরিষাবাড়ি ', 130, NULL, NULL),
(177, 5, 'Narundi Police I.C', 'নারুন্দি', 130, NULL, NULL),
(178, 6, 'Astagram', 'অষ্টগ্রাম', 130, NULL, NULL),
(179, 6, 'Bajitpur', 'বাজিতপুর', 130, NULL, NULL),
(180, 6, 'Bhairab', 'ভৈরব', 130, NULL, NULL),
(181, 6, 'Hossainpur', 'হোসেনপুর ', 130, NULL, NULL),
(182, 6, 'Itna', 'ইটনা', 130, NULL, NULL),
(183, 6, 'Karimganj', 'করিমগঞ্জ', 130, NULL, NULL),
(184, 6, 'Katiadi', 'কতিয়াদি', 130, NULL, NULL),
(185, 6, 'Kishoreganj Sadar', 'কিশোরগঞ্জ সদর', 130, NULL, NULL),
(186, 6, 'Kuliarchar', 'কুলিয়ারচর', 130, NULL, NULL),
(187, 6, 'Mithamain', 'মিঠামাইন', 130, NULL, NULL),
(188, 6, 'Nikli', 'নিকলি', 130, NULL, NULL),
(189, 6, 'Pakundia', 'পাকুন্ডা', 130, NULL, NULL),
(190, 6, 'Tarail', 'তাড়াইল', 130, NULL, NULL),
(191, 7, 'Madaripur Sadar', 'মাদারীপুর সদর', 130, NULL, NULL),
(192, 7, 'Kalkini', 'কালকিনি', 130, NULL, NULL),
(193, 7, 'Rajoir', 'রাজইর', 130, NULL, NULL),
(194, 7, 'Shibchar', 'শিবচর', 130, NULL, NULL),
(195, 8, 'Manikganj Sadar', 'মানিকগঞ্জ সদর', 130, NULL, NULL),
(196, 8, 'Singair', 'সিঙ্গাইর', 130, NULL, NULL),
(197, 8, 'Shibalaya', 'শিবালয়', 130, NULL, NULL),
(198, 8, 'Saturia', 'সাটুরিয়া', 130, NULL, NULL),
(199, 8, 'Harirampur', 'হরিরামপুর', 130, NULL, NULL),
(200, 8, 'Ghior', 'ঘিওর', 130, NULL, NULL),
(201, 8, 'Daulatpur', 'দৌলতপুর', 130, NULL, NULL),
(202, 9, 'Lohajang', 'লোহাজং', 130, NULL, NULL),
(203, 9, 'Sreenagar', 'শ্রীনগর', 130, NULL, NULL),
(204, 9, 'Munshiganj Sadar', 'মুন্সিগঞ্জ সদর', 130, NULL, NULL),
(205, 9, 'Sirajdikhan', 'সিরাজদিখান', 130, NULL, NULL),
(206, 9, 'Tongibari', 'টঙ্গিবাড়ি', 130, NULL, NULL),
(207, 9, 'Gazaria', 'গজারিয়া', 130, NULL, NULL),
(208, 10, 'Bhaluka', 'ভালুকা', 130, NULL, NULL),
(209, 10, 'Trishal', 'ত্রিশাল', 130, NULL, NULL),
(210, 10, 'Haluaghat', 'হালুয়াঘাট', 130, NULL, NULL),
(211, 10, 'Muktagachha', 'মুক্তাগাছা', 130, NULL, NULL),
(212, 10, 'Dhobaura', 'ধবারুয়া', 130, NULL, NULL),
(213, 10, 'Fulbaria', 'ফুলবাড়িয়া', 130, NULL, NULL),
(214, 10, 'Gaffargaon', 'গফরগাঁও', 130, NULL, NULL),
(215, 10, 'Gauripur', 'গৌরিপুর', 130, NULL, NULL),
(216, 10, 'Ishwarganj', 'ঈশ্বরগঞ্জ', 130, NULL, NULL),
(217, 10, 'Mymensingh Sadar', 'ময়মনসিং সদর', 130, NULL, NULL),
(218, 10, 'Nandail', 'নন্দাইল', 130, NULL, NULL),
(219, 10, 'Phulpur', 'ফুলপুর', 130, NULL, NULL),
(220, 11, 'Araihazar', 'আড়াইহাজার', 130, NULL, NULL),
(221, 11, 'Sonargaon', 'সোনারগাঁও', 130, NULL, NULL),
(222, 11, 'Bandar', 'বান্দার', 130, NULL, NULL),
(223, 11, 'Naryanganj Sadar', 'নারায়ানগঞ্জ সদর', 130, NULL, NULL),
(224, 11, 'Rupganj', 'রূপগঞ্জ', 130, NULL, NULL),
(225, 11, 'Siddirgonj', 'সিদ্ধিরগঞ্জ', 130, NULL, NULL),
(226, 12, 'Belabo', 'বেলাবো', 130, NULL, NULL),
(227, 12, 'Monohardi', 'মনোহরদি', 130, NULL, NULL),
(228, 12, 'Narsingdi Sadar', 'নরসিংদী সদর', 130, NULL, NULL),
(229, 12, 'Palash', 'পলাশ', 130, NULL, NULL),
(230, 12, 'Raipura, Narsingdi', 'রায়পুর', 130, NULL, NULL),
(231, 12, 'Shibpur', 'শিবপুর', 130, NULL, NULL),
(232, 13, 'Kendua Upazilla', 'কেন্দুয়া', 130, NULL, NULL),
(233, 13, 'Atpara Upazilla', 'আটপাড়া', 130, NULL, NULL),
(234, 13, 'Barhatta Upazilla', 'বরহাট্টা', 130, NULL, NULL),
(235, 13, 'Durgapur Upazilla', 'দুর্গাপুর', 130, NULL, NULL),
(236, 13, 'Kalmakanda Upazilla', 'কলমাকান্দা', 130, NULL, NULL),
(237, 13, 'Madan Upazilla', 'মদন', 130, NULL, NULL),
(238, 13, 'Mohanganj Upazilla', 'মোহনগঞ্জ', 130, NULL, NULL),
(239, 13, 'Netrakona-S Upazilla', 'নেত্রকোনা সদর', 130, NULL, NULL),
(240, 13, 'Purbadhala Upazilla', 'পূর্বধলা', 130, NULL, NULL),
(241, 13, 'Khaliajuri Upazilla', 'খালিয়াজুরি', 130, NULL, NULL),
(242, 14, 'Baliakandi', 'বালিয়াকান্দি', 130, NULL, NULL),
(243, 14, 'Goalandaghat', 'গোয়ালন্দ ঘাট', 130, NULL, NULL),
(244, 14, 'Pangsha', 'পাংশা', 130, NULL, NULL),
(245, 14, 'Kalukhali', 'কালুখালি', 130, NULL, NULL),
(246, 14, 'Rajbari Sadar', 'রাজবাড়ি সদর', 130, NULL, NULL),
(247, 15, 'Shariatpur Sadar -Palong', 'শরীয়তপুর সদর ', 130, NULL, NULL),
(248, 15, 'Damudya', 'দামুদিয়া', 130, NULL, NULL),
(249, 15, 'Naria', 'নড়িয়া', 130, NULL, NULL),
(250, 15, 'Jajira', 'জাজিরা', 130, NULL, NULL),
(251, 15, 'Bhedarganj', 'ভেদারগঞ্জ', 130, NULL, NULL),
(252, 15, 'Gosairhat', 'গোসাইর হাট ', 130, NULL, NULL),
(253, 16, 'Jhenaigati', 'ঝিনাইগাতি', 130, NULL, NULL),
(254, 16, 'Nakla', 'নাকলা', 130, NULL, NULL),
(255, 16, 'Nalitabari', 'নালিতাবাড়ি', 130, NULL, NULL),
(256, 16, 'Sherpur Sadar', 'শেরপুর সদর', 130, NULL, NULL),
(257, 16, 'Sreebardi', 'শ্রীবরদি', 130, NULL, NULL),
(258, 17, 'Tangail Sadar', 'টাঙ্গাইল সদর', 130, NULL, NULL),
(259, 17, 'Sakhipur', 'সখিপুর', 130, NULL, NULL),
(260, 17, 'Basail', 'বসাইল', 130, NULL, NULL),
(261, 17, 'Madhupur', 'মধুপুর', 130, NULL, NULL),
(262, 17, 'Ghatail', 'ঘাটাইল', 130, NULL, NULL),
(263, 17, 'Kalihati', 'কালিহাতি', 130, NULL, NULL),
(264, 17, 'Nagarpur', 'নগরপুর', 130, NULL, NULL),
(265, 17, 'Mirzapur', 'মির্জাপুর', 130, NULL, NULL),
(266, 17, 'Gopalpur', 'গোপালপুর', 130, NULL, NULL),
(267, 17, 'Delduar', 'দেলদুয়ার', 130, NULL, NULL),
(268, 17, 'Bhuapur', 'ভুয়াপুর', 130, NULL, NULL),
(269, 17, 'Dhanbari', 'ধানবাড়ি', 130, NULL, NULL),
(270, 55, 'Bagerhat Sadar', 'বাগেরহাট সদর', 130, NULL, NULL),
(271, 55, 'Chitalmari', 'চিতলমাড়ি', 130, NULL, NULL),
(272, 55, 'Fakirhat', 'ফকিরহাট', 130, NULL, NULL),
(273, 55, 'Kachua', 'কচুয়া', 130, NULL, NULL),
(274, 55, 'Mollahat', 'মোল্লাহাট ', 130, NULL, NULL),
(275, 55, 'Mongla', 'মংলা', 130, NULL, NULL),
(276, 55, 'Morrelganj', 'মরেলগঞ্জ', 130, NULL, NULL),
(277, 55, 'Rampal', 'রামপাল', 130, NULL, NULL),
(278, 55, 'Sarankhola', 'স্মরণখোলা', 130, NULL, NULL),
(279, 56, 'Damurhuda', 'দামুরহুদা', 130, NULL, NULL),
(280, 56, 'Chuadanga-S', 'চুয়াডাঙ্গা সদর', 130, NULL, NULL),
(281, 56, 'Jibannagar', 'জীবন নগর ', 130, NULL, NULL),
(282, 56, 'Alamdanga', 'আলমডাঙ্গা', 130, NULL, NULL),
(283, 57, 'Abhaynagar', 'অভয়নগর', 130, NULL, NULL),
(284, 57, 'Keshabpur', 'কেশবপুর', 130, NULL, NULL),
(285, 57, 'Bagherpara', 'বাঘের পাড়া ', 130, NULL, NULL),
(286, 57, 'Jessore Sadar', 'যশোর সদর', 130, NULL, NULL),
(287, 57, 'Chaugachha', 'চৌগাছা', 130, NULL, NULL),
(288, 57, 'Manirampur', 'মনিরামপুর ', 130, NULL, NULL),
(289, 57, 'Jhikargachha', 'ঝিকরগাছা', 130, NULL, NULL),
(290, 57, 'Sharsha', 'সারশা', 130, NULL, NULL),
(291, 58, 'Jhenaidah Sadar', 'ঝিনাইদহ সদর', 130, NULL, NULL),
(292, 58, 'Maheshpur', 'মহেশপুর', 130, NULL, NULL),
(293, 58, 'Kaliganj', 'কালীগঞ্জ', 130, NULL, NULL),
(294, 58, 'Kotchandpur', 'কোট চাঁদপুর ', 130, NULL, NULL),
(295, 58, 'Shailkupa', 'শৈলকুপা', 130, NULL, NULL),
(296, 58, 'Harinakunda', 'হাড়িনাকুন্দা', 130, NULL, NULL),
(297, 59, 'Terokhada', 'তেরোখাদা', 130, NULL, NULL),
(298, 59, 'Batiaghata', 'বাটিয়াঘাটা ', 130, NULL, NULL),
(299, 59, 'Dacope', 'ডাকপে', 130, NULL, NULL),
(300, 59, 'Dumuria', 'ডুমুরিয়া', 130, NULL, NULL),
(301, 59, 'Dighalia', 'দিঘলিয়া', 130, NULL, NULL),
(302, 59, 'Koyra', 'কয়ড়া', 130, NULL, NULL),
(303, 59, 'Paikgachha', 'পাইকগাছা', 130, NULL, NULL),
(304, 59, 'Phultala', 'ফুলতলা', 130, NULL, NULL),
(305, 59, 'Rupsa', 'রূপসা', 130, NULL, NULL),
(306, 60, 'Kushtia Sadar', 'কুষ্টিয়া সদর', 130, NULL, NULL),
(307, 60, 'Kumarkhali', 'কুমারখালি', 130, NULL, NULL),
(308, 60, 'Daulatpur', 'দৌলতপুর', 130, NULL, NULL),
(309, 60, 'Mirpur', 'মিরপুর', 130, NULL, NULL),
(310, 60, 'Bheramara', 'ভেরামারা', 130, NULL, NULL),
(311, 60, 'Khoksa', 'খোকসা', 130, NULL, NULL),
(312, 61, 'Magura Sadar', 'মাগুরা সদর', 130, NULL, NULL),
(313, 61, 'Mohammadpur', 'মোহাম্মাদপুর', 130, NULL, NULL),
(314, 61, 'Shalikha', 'শালিখা', 130, NULL, NULL),
(315, 61, 'Sreepur', 'শ্রীপুর', 130, NULL, NULL),
(316, 62, 'angni', 'আংনি', 130, NULL, NULL),
(317, 62, 'Mujib Nagar', 'মুজিব নগর', 130, NULL, NULL),
(318, 62, 'Meherpur-S', 'মেহেরপুর সদর', 130, NULL, NULL),
(319, 63, 'Narail-S Upazilla', 'নড়াইল সদর', 130, NULL, NULL),
(320, 63, 'Lohagara Upazilla', 'লোহাগাড়া', 130, NULL, NULL),
(321, 63, 'Kalia Upazilla', 'কালিয়া', 130, NULL, NULL),
(322, 64, 'Satkhira Sadar', 'সাতক্ষীরা সদর', 130, NULL, NULL),
(323, 64, 'Assasuni', 'আসসাশুনি ', 130, NULL, NULL),
(324, 64, 'Debhata', 'দেভাটা', 130, NULL, NULL),
(325, 64, 'Tala', 'তালা', 130, NULL, NULL),
(326, 64, 'Kalaroa', 'কলরোয়া', 130, NULL, NULL),
(327, 64, 'Kaliganj', 'কালীগঞ্জ', 130, NULL, NULL),
(328, 64, 'Shyamnagar', 'শ্যামনগর', 130, NULL, NULL),
(329, 18, 'Adamdighi', 'আদমদিঘী', 130, NULL, NULL),
(330, 18, 'Bogra Sadar', 'বগুড়া সদর', 130, NULL, NULL),
(331, 18, 'Sherpur', 'শেরপুর', 130, NULL, NULL),
(332, 18, 'Dhunat', 'ধুনট', 130, NULL, NULL),
(333, 18, 'Dhupchanchia', 'দুপচাচিয়া', 130, NULL, NULL),
(334, 18, 'Gabtali', 'গাবতলি', 130, NULL, NULL),
(335, 18, 'Kahaloo', 'কাহালু', 130, NULL, NULL),
(336, 18, 'Nandigram', 'নন্দিগ্রাম', 130, NULL, NULL),
(337, 18, 'Sahajanpur', 'শাহজাহানপুর', 130, NULL, NULL),
(338, 18, 'Sariakandi', 'সারিয়াকান্দি', 130, NULL, NULL),
(339, 18, 'Shibganj', 'শিবগঞ্জ', 130, NULL, NULL),
(340, 18, 'Sonatala', 'সোনাতলা', 130, NULL, NULL),
(341, 19, 'Joypurhat S', 'জয়পুরহাট সদর', 130, NULL, NULL),
(342, 19, 'Akkelpur', 'আক্কেলপুর', 130, NULL, NULL),
(343, 19, 'Kalai', 'কালাই', 130, NULL, NULL),
(344, 19, 'Khetlal', 'খেতলাল', 130, NULL, NULL),
(345, 19, 'Panchbibi', 'পাঁচবিবি', 130, NULL, NULL),
(346, 20, 'Naogaon Sadar', 'নওগাঁ সদর', 130, NULL, NULL),
(347, 20, 'Mohadevpur', 'মহাদেবপুর', 130, NULL, NULL),
(348, 20, 'Manda', 'মান্দা', 130, NULL, NULL),
(349, 20, 'Niamatpur', 'নিয়ামতপুর', 130, NULL, NULL),
(350, 20, 'Atrai', 'আত্রাই', 130, NULL, NULL),
(351, 20, 'Raninagar', 'রাণীনগর', 130, NULL, NULL),
(352, 20, 'Patnitala', 'পত্নীতলা', 130, NULL, NULL),
(353, 20, 'Dhamoirhat', 'ধামইরহাট ', 130, NULL, NULL),
(354, 20, 'Sapahar', 'সাপাহার', 130, NULL, NULL),
(355, 20, 'Porsha', 'পোরশা', 130, NULL, NULL),
(356, 20, 'Badalgachhi', 'বদলগাছি', 130, NULL, NULL),
(357, 21, 'Natore Sadar', 'নাটোর সদর', 130, NULL, NULL),
(358, 21, 'Baraigram', 'বড়াইগ্রাম', 130, NULL, NULL),
(359, 21, 'Bagatipara', 'বাগাতিপাড়া', 130, NULL, NULL),
(360, 21, 'Lalpur', 'লালপুর', 130, NULL, NULL),
(361, 21, 'Natore Sadar', 'নাটোর সদর', 130, NULL, NULL),
(362, 21, 'Baraigram', 'বড়াই গ্রাম', 130, NULL, NULL),
(363, 22, 'Bholahat', 'ভোলাহাট', 130, NULL, NULL),
(364, 22, 'Gomastapur', 'গোমস্তাপুর', 130, NULL, NULL),
(365, 22, 'Nachole', 'নাচোল', 130, NULL, NULL),
(366, 22, 'Nawabganj Sadar', 'নবাবগঞ্জ সদর', 130, NULL, NULL),
(367, 22, 'Shibganj', 'শিবগঞ্জ', 130, NULL, NULL),
(368, 23, 'Atgharia', 'আটঘরিয়া', 130, NULL, NULL),
(369, 23, 'Bera', 'বেড়া', 130, NULL, NULL),
(370, 23, 'Bhangura', 'ভাঙ্গুরা', 130, NULL, NULL),
(371, 23, 'Chatmohar', 'চাটমোহর', 130, NULL, NULL),
(372, 23, 'Faridpur', 'ফরিদপুর', 130, NULL, NULL),
(373, 23, 'Ishwardi', 'ঈশ্বরদী', 130, NULL, NULL),
(374, 23, 'Pabna Sadar', 'পাবনা সদর', 130, NULL, NULL),
(375, 23, 'Santhia', 'সাথিয়া', 130, NULL, NULL),
(376, 23, 'Sujanagar', 'সুজানগর', 130, NULL, NULL),
(377, 24, 'Bagha', 'বাঘা', 130, NULL, NULL),
(378, 24, 'Bagmara', 'বাগমারা', 130, NULL, NULL),
(379, 24, 'Charghat', 'চারঘাট', 130, NULL, NULL),
(380, 24, 'Durgapur', 'দুর্গাপুর', 130, NULL, NULL),
(381, 24, 'Godagari', 'গোদাগারি', 130, NULL, NULL),
(382, 24, 'Mohanpur', 'মোহনপুর', 130, NULL, NULL),
(383, 24, 'Paba', 'পবা', 130, NULL, NULL),
(384, 24, 'Puthia', 'পুঠিয়া', 130, NULL, NULL),
(385, 24, 'Tanore', 'তানোর', 130, NULL, NULL),
(386, 25, 'Sirajganj Sadar', 'সিরাজগঞ্জ সদর', 130, NULL, NULL),
(387, 25, 'Belkuchi', 'বেলকুচি', 130, NULL, NULL),
(388, 25, 'Chauhali', 'চৌহালি', 130, NULL, NULL),
(389, 25, 'Kamarkhanda', 'কামারখান্দা', 130, NULL, NULL),
(390, 25, 'Kazipur', 'কাজীপুর', 130, NULL, NULL),
(391, 25, 'Raiganj', 'রায়গঞ্জ', 130, NULL, NULL),
(392, 25, 'Shahjadpur', 'শাহজাদপুর', 130, NULL, NULL),
(393, 25, 'Tarash', 'তারাশ', 130, NULL, NULL),
(394, 25, 'Ullahpara', 'উল্লাপাড়া', 130, NULL, NULL),
(395, 26, 'Birampur', 'বিরামপুর', 130, NULL, NULL),
(396, 26, 'Birganj', 'বীরগঞ্জ', 130, NULL, NULL),
(397, 26, 'Biral', 'বিড়াল', 130, NULL, NULL),
(398, 26, 'Bochaganj', 'বোচাগঞ্জ', 130, NULL, NULL),
(399, 26, 'Chirirbandar', 'চিরিরবন্দর', 130, NULL, NULL),
(400, 26, 'Phulbari', 'ফুলবাড়ি', 130, NULL, NULL),
(401, 26, 'Ghoraghat', 'ঘোড়াঘাট', 130, NULL, NULL),
(402, 26, 'Hakimpur', 'হাকিমপুর', 130, NULL, NULL),
(403, 26, 'Kaharole', 'কাহারোল', 130, NULL, NULL),
(404, 26, 'Khansama', 'খানসামা', 130, NULL, NULL),
(405, 26, 'Dinajpur Sadar', 'দিনাজপুর সদর', 130, NULL, NULL),
(406, 26, 'Nawabganj', 'নবাবগঞ্জ', 130, NULL, NULL),
(407, 26, 'Parbatipur', 'পার্বতীপুর', 130, NULL, NULL),
(408, 27, 'Fulchhari', 'ফুলছড়ি', 130, NULL, NULL),
(409, 27, 'Gaibandha sadar', 'গাইবান্ধা সদর', 130, NULL, NULL),
(410, 27, 'Gobindaganj', 'গোবিন্দগঞ্জ', 130, NULL, NULL),
(411, 27, 'Palashbari', 'পলাশবাড়ী', 130, NULL, NULL),
(412, 27, 'Sadullapur', 'সাদুল্যাপুর', 130, NULL, NULL),
(413, 27, 'Saghata', 'সাঘাটা', 130, NULL, NULL),
(414, 27, 'Sundarganj', 'সুন্দরগঞ্জ', 130, NULL, NULL),
(415, 28, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', 130, NULL, NULL),
(416, 28, 'Nageshwari', 'নাগেশ্বরী', 130, NULL, NULL),
(417, 28, 'Bhurungamari', 'ভুরুঙ্গামারি', 130, NULL, NULL),
(418, 28, 'Phulbari', 'ফুলবাড়ি', 130, NULL, NULL),
(419, 28, 'Rajarhat', 'রাজারহাট', 130, NULL, NULL),
(420, 28, 'Ulipur', 'উলিপুর', 130, NULL, NULL),
(421, 28, 'Chilmari', 'চিলমারি', 130, NULL, NULL),
(422, 28, 'Rowmari', 'রউমারি', 130, NULL, NULL),
(423, 28, 'Char Rajibpur', 'চর রাজিবপুর', 130, NULL, NULL),
(424, 29, 'Lalmanirhat Sadar', 'লালমনিরহাট সদর', 130, NULL, NULL),
(425, 29, 'Aditmari', 'আদিতমারি', 130, NULL, NULL),
(426, 29, 'Kaliganj', 'কালীগঞ্জ', 130, NULL, NULL),
(427, 29, 'Hatibandha', 'হাতিবান্ধা', 130, NULL, NULL),
(428, 29, 'Patgram', 'পাটগ্রাম', 130, NULL, NULL),
(429, 30, 'Nilphamari Sadar', 'নীলফামারী সদর', 130, NULL, NULL),
(430, 30, 'Saidpur', 'সৈয়দপুর', 130, NULL, NULL),
(431, 30, 'Jaldhaka', 'জলঢাকা', 130, NULL, NULL),
(432, 30, 'Kishoreganj', 'কিশোরগঞ্জ', 130, NULL, NULL),
(433, 30, 'Domar', 'ডোমার', 130, NULL, NULL),
(434, 30, 'Dimla', 'ডিমলা', 130, NULL, NULL),
(435, 31, 'Panchagarh Sadar', 'পঞ্চগড় সদর', 130, NULL, NULL),
(436, 31, 'Debiganj', 'দেবীগঞ্জ', 130, NULL, NULL),
(437, 31, 'Boda', 'বোদা', 130, NULL, NULL),
(438, 31, 'Atwari', 'আটোয়ারি', 130, NULL, NULL),
(439, 31, 'Tetulia', 'তেঁতুলিয়া', 130, NULL, NULL),
(440, 32, 'Badarganj', 'বদরগঞ্জ', 130, NULL, NULL),
(441, 32, 'Mithapukur', 'মিঠাপুকুর', 130, NULL, NULL),
(442, 32, 'Gangachara', 'গঙ্গাচরা', 130, NULL, NULL),
(443, 32, 'Kaunia', 'কাউনিয়া', 130, NULL, NULL),
(444, 32, 'Rangpur Sadar', 'রংপুর সদর', 130, NULL, NULL),
(445, 32, 'Pirgachha', 'পীরগাছা', 130, NULL, NULL),
(446, 32, 'Pirganj', 'পীরগঞ্জ', 130, NULL, NULL),
(447, 32, 'Taraganj', 'তারাগঞ্জ', 130, NULL, NULL),
(448, 33, 'Thakurgaon Sadar', 'ঠাকুরগাঁও সদর', 130, NULL, NULL),
(449, 33, 'Pirganj', 'পীরগঞ্জ', 130, NULL, NULL),
(450, 33, 'Baliadangi', 'বালিয়াডাঙ্গি', 130, NULL, NULL),
(451, 33, 'Haripur', 'হরিপুর', 130, NULL, NULL),
(452, 33, 'Ranisankail', 'রাণীসংকইল', 130, NULL, NULL),
(453, 51, 'Ajmiriganj', 'আজমিরিগঞ্জ', 130, NULL, NULL),
(454, 51, 'Baniachang', 'বানিয়াচং', 130, NULL, NULL),
(455, 51, 'Bahubal', 'বাহুবল', 130, NULL, NULL),
(456, 51, 'Chunarughat', 'চুনারুঘাট', 130, NULL, NULL),
(457, 51, 'Habiganj Sadar', 'হবিগঞ্জ সদর', 130, NULL, NULL),
(458, 51, 'Lakhai', 'লাক্ষাই', 130, NULL, NULL),
(459, 51, 'Madhabpur', 'মাধবপুর', 130, NULL, NULL),
(460, 51, 'Nabiganj', 'নবীগঞ্জ', 130, NULL, NULL),
(461, 51, 'Shaistagonj', 'শায়েস্তাগঞ্জ', 130, NULL, NULL),
(462, 52, 'Moulvibazar Sadar', 'মৌলভীবাজার', 130, NULL, NULL),
(463, 52, 'Barlekha', 'বড়লেখা', 130, NULL, NULL),
(464, 52, 'Juri', 'জুড়ি', 130, NULL, NULL),
(465, 52, 'Kamalganj', 'কামালগঞ্জ', 130, NULL, NULL),
(466, 52, 'Kulaura', 'কুলাউরা', 130, NULL, NULL),
(467, 52, 'Rajnagar', 'রাজনগর', 130, NULL, NULL),
(468, 52, 'Sreemangal', 'শ্রীমঙ্গল', 130, NULL, NULL),
(469, 53, 'Bishwamvarpur', 'বিসশম্ভারপুর', 130, NULL, NULL),
(470, 53, 'Chhatak', 'ছাতক', 130, NULL, NULL),
(471, 53, 'Derai', 'দেড়াই', 130, NULL, NULL),
(472, 53, 'Dharampasha', 'ধরমপাশা', 130, NULL, NULL),
(473, 53, 'Dowarabazar', 'দোয়ারাবাজার', 130, NULL, NULL),
(474, 53, 'Jagannathpur', 'জগন্নাথপুর', 130, NULL, NULL),
(475, 53, 'Jamalganj', 'জামালগঞ্জ', 130, NULL, NULL),
(476, 53, 'Sulla', 'সুল্লা', 130, NULL, NULL),
(477, 53, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', 130, NULL, NULL),
(478, 53, 'Shanthiganj', 'শান্তিগঞ্জ', 130, NULL, NULL),
(479, 53, 'Tahirpur', 'তাহিরপুর', 130, NULL, NULL),
(480, 54, 'Sylhet Sadar', 'সিলেট সদর', 130, NULL, NULL),
(481, 54, 'Beanibazar', 'বেয়ানিবাজার', 130, NULL, NULL),
(482, 54, 'Bishwanath', 'বিশ্বনাথ', 130, NULL, NULL),
(483, 54, 'Dakshin Surma', 'দক্ষিণ সুরমা', 130, NULL, NULL),
(484, 54, 'Balaganj', 'বালাগঞ্জ', 130, NULL, NULL),
(485, 54, 'Companiganj', 'কোম্পানিগঞ্জ', 130, NULL, NULL),
(486, 54, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', 130, NULL, NULL),
(487, 54, 'Golapganj', 'গোলাপগঞ্জ', 130, NULL, NULL),
(488, 54, 'Gowainghat', 'গোয়াইনঘাট', 130, NULL, NULL),
(489, 54, 'Jointapur', 'জৈন্তাপুর', 130, NULL, NULL),
(490, 54, 'Kanaighat', 'কানাইঘাট', 130, NULL, NULL),
(491, 54, 'Zakiganj', 'জাকিগঞ্জ', 130, NULL, NULL),
(492, 54, 'Nobigonj', 'নবীগঞ্জ', 130, NULL, NULL),
(493, 45, 'Eidgaon', 'ঈদগাঁও', 130, NULL, NULL),
(494, 53, 'Modhyanagar', 'মধ্যনগর', 130, NULL, NULL),
(495, 7, 'Dasar', 'দশর', 130, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'admin@koohen.com', NULL, '$2y$12$s6TdvHBXLPIytJnk3w1kp.WAH6ZgXJ90oBD8haOFLBFkPvIga3Dxq', '0rwFoGv0o4E4eatHokz6xrw7J7ecgw1DJ2iX4PcPUtxK4Yh4SkIm6aUc33Ne', '2024-01-11 01:33:04', '2024-03-27 06:12:11'),
(3, 'Koohen', 'user@koohen.com', NULL, '$2y$12$j9OsoWA9IBKpe6EK/N6AcuQn7kJxKbWCbtmx7EOwKA7XLa9eLZlEW', NULL, '2024-02-08 09:05:30', '2024-02-08 09:05:30'),
(4, 'Product Manager', 'support@koohen.com', NULL, '$2y$12$4yOgh89nVZJDAmKYknucxO1Hq2gdSUf.2frEeQeRqXxYNcj4biznK', NULL, '2024-03-27 06:11:50', '2024-03-27 06:11:50'),
(5, 'Order User', 'sales@koohen.com', NULL, '$2y$12$B7ZvArt7tn0JqTlQUQcThuKwy7X/A1mG8r0/QHcjVs1r6sIbm9pHq', 'IgUiSZgSpQIf7MK0aIuXGaOgA2LPTwH3chGpJh6fO4swtoF8Q5JUkXUNL7uv', '2024-03-27 06:12:44', '2024-03-28 11:00:17'),
(6, 'Arif Hossen', 'arifhossen853@gmail.com', NULL, '$2y$12$YWS0kw.afh3igoNyExBdv.qkWG1V.KqJUvZVwwECOlVPsUDFcT55W', 'VgQ2UNHvYjWGaXaGTvK3dEtzxugFBtxFIR6m5eWFqHkHxiVO3Q37YhJJ0CZJ', '2024-03-29 06:36:32', '2024-03-29 06:36:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appName` varchar(255) NOT NULL,
  `ownerName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `weblogo` varchar(255) DEFAULT NULL,
  `webfavicon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `appName`, `ownerName`, `email`, `phone`, `address`, `description`, `startDate`, `weblogo`, `webfavicon`, `created_at`, `updated_at`) VALUES
(1, 'Koohen', 'Masud Ahemd', 'support@koohen.com', '01795795441', '522/B, North Shahjahanpur, Dhaka-1217', 'Koohen offers a wide range of clothing, including T-shirts, hoodies, traditional Panjabi and Sharee dresses. Orders are carefully handled from Dhaka and delivered across Bangladesh!', '2024-03-01', '1714554640.png', '1714554640.png', '2024-04-30 19:57:22', '2024-05-01 16:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `varients`
--

CREATE TABLE `varients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `webmessages`
--

CREATE TABLE `webmessages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `webmessages`
--

INSERT INTO `webmessages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'Test@gmail.com', '0147859635', 'Test', 'Test', '2024-03-13 01:49:27', '2024-03-13 01:49:27'),
(2, 'test2', 'test2@gmail.com', '0147852369', 'Testing', 'Testing message', '2024-03-13 02:14:47', '2024-03-13 02:14:47'),
(3, 'a', 'a@gmailcom', '12345566576', 'test', 'sadfsafe', '2024-03-13 02:55:17', '2024-03-13 02:55:17'),
(4, 'Arif', 'qbittech.dev1@gmail.com', '01795795441', 'Test', 'Test', '2024-03-14 04:37:08', '2024-03-14 04:37:08'),
(5, 'Mike Allford', 'mikeAnally@gmail.com', '82467977575', 'NEW: Semrush Backlinks', 'Howdy \r\n \r\nThis is Mike Allford\r\n \r\nLet me show you our latest research results from our constant SEO feedbacks that we have from our plans: \r\n \r\nhttps://www.strictlydigital.net/product/semrush-backlinks/ \r\n \r\nThe new Semrush Backlinks, which will make your koohen.com SEO trend have an immediate push. \r\nThe method is actually very simple, we are building links from domains that have a high number of keywords ranking for them.  \r\n \r\nForget about the SEO metrics or any other factors that so many tools try to teach you that is good. The most valuable link is the one that comes from a website that has a healthy trend and lots of ranking keywords. \r\nWe thought about that, so we have built this plan for you \r\n \r\nCheck in detail here: \r\nhttps://www.strictlydigital.net/product/semrush-backlinks/ \r\n \r\nCheap and effective \r\n \r\nTry it anytime soon \r\n \r\nRegards \r\nMike Allford\r\n \r\nmike@strictlydigital.net', '2024-03-24 01:33:59', '2024-03-24 01:33:59'),
(6, 'Mike Goldman', 'mikeVEINDLOPYOWEDO@gmail.com', '82988711221', 'Increase sales for your local business', 'This service is perfect for boosting your local business\' visibility on the map in a specific location. \r\n \r\nWe provide Google Maps listing management, optimization, and promotion services that cover everything needed to rank in the Google 3-Pack. \r\n \r\nMore info: \r\nhttps://www.speed-seo.net/ranking-in-the-maps-means-sales/ \r\n \r\n \r\nThanks and Regards \r\nMike Goldman\r\n \r\n \r\nPS: Want a ONE-TIME comprehensive local plan that covers everything? \r\nhttps://www.speed-seo.net/product/local-seo-bundle/', '2024-03-28 02:34:11', '2024-03-28 02:34:11'),
(7, 'Mike Ralphs', 'mikeVEINDLOPYOWEDO@gmail.com', '85854367133', 'Increase sales for your local business', 'This service is perfect for boosting your local business\' visibility on the map in a specific location. \r\n \r\nWe provide Google Maps listing management, optimization, and promotion services that cover everything needed to rank in the Google 3-Pack. \r\n \r\nMore info: \r\nhttps://www.speed-seo.net/ranking-in-the-maps-means-sales/ \r\n \r\n \r\nThanks and Regards \r\nMike Ralphs\r\n \r\n \r\nPS: Want a ONE-TIME comprehensive local plan that covers everything? \r\nhttps://www.speed-seo.net/product/local-seo-bundle/', '2024-04-28 03:18:01', '2024-04-28 03:18:01'),
(8, 'Mike Bosworth', 'mikeAnally@gmail.com', '81311155888', 'NEW: Semrush Backlinks', 'Greetings \r\n \r\nThis is Mike Bosworth\r\n \r\nLet me introduce to you our latest research results from our constant SEO feedbacks that we have from our plans: \r\n \r\nhttps://www.strictlydigital.net/product/semrush-backlinks/ \r\n \r\nThe new Semrush Backlinks, which will make your koohen.com SEO trend have an immediate push. \r\nThe method is actually very simple, we are building links from domains that have a high number of keywords ranking for them.  \r\n \r\nForget about the SEO metrics or any other factors that so many tools try to teach you that is good. The most valuable link is the one that comes from a website that has a healthy trend and lots of ranking keywords. \r\nWe thought about that, so we have built this plan for you \r\n \r\nCheck in detail here: \r\nhttps://www.strictlydigital.net/product/semrush-backlinks/ \r\n \r\nCheap and effective \r\n \r\nTry it anytime soon \r\n \r\nRegards \r\nMike Bosworth\r\n \r\nmike@strictlydigital.net', '2024-05-17 03:27:49', '2024-05-17 03:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `web_infos`
--

CREATE TABLE `web_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appName` varchar(255) NOT NULL,
  `ownerName` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `weblogo` varchar(255) NOT NULL,
  `webfavicon` varchar(255) NOT NULL,
  `marquee` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_infos`
--

INSERT INTO `web_infos` (`id`, `appName`, `ownerName`, `address`, `description`, `startDate`, `weblogo`, `webfavicon`, `marquee`, `copyright`, `created_at`, `updated_at`) VALUES
(1, 'Koohen', 'Mr Koohen', '522/B, North Shahjahanpur, Dhaka-1217', 'Koohen offers a wide range of clothing, including T-shirts, hoodies, traditional Panjabi and Sharee dresses. Orders are carefully handled from Dhaka and delivered across Bangladesh!', NULL, '1714909402.png', '1714909402.png', NULL, '2024 © All rights reserved', '2024-05-05 05:14:15', '2024-05-05 11:43:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutuses`
--
ALTER TABLE `aboutuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applied_coupones`
--
ALTER TABLE `applied_coupones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applied_coupones_coupone_id_foreign` (`coupone_id`),
  ADD KEY `applied_coupones_customer_id_foreign` (`customer_id`),
  ADD KEY `applied_coupones_order_id_foreign` (`order_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `camp_products`
--
ALTER TABLE `camp_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `camp_products_campaign_id_foreign` (`campaign_id`),
  ADD KEY `camp_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_categories_id_unique` (`categories_id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactinfos`
--
ALTER TABLE `contactinfos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_zones`
--
ALTER TABLE `delivery_zones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_zones_district_id_foreign` (`district_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feature_categories`
--
ALTER TABLE `feature_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `feature_products`
--
ALTER TABLE `feature_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_products_with_pivot`
--
ALTER TABLE `feature_products_with_pivot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_products_with_pivot_feature_products_id_foreign` (`feature_products_id`),
  ADD KEY `feature_products_with_pivot_products_id_foreign` (`products_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_offer_type_id_foreign` (`offer_type_id`);

--
-- Indexes for table `offer_types`
--
ALTER TABLE `offer_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_track_id` (`order_track_id`),
  ADD UNIQUE KEY `invoice no` (`invoice_no`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `orderstatuses`
--
ALTER TABLE `orderstatuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderstatuses_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_color_id_foreign` (`color_id`),
  ADD KEY `order_items_size_id_foreign` (`size_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `postcodes`
--
ALTER TABLE `postcodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postcodes_division_id_foreign` (`division_id`),
  ADD KEY `postcodes_district_id_foreign` (`district_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`supplier_id`);

--
-- Indexes for table `products_colors`
--
ALTER TABLE `products_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_colors_product_id_foreign` (`product_id`),
  ADD KEY `products_colors_color_id_foreign` (`color_id`);

--
-- Indexes for table `products_sizes`
--
ALTER TABLE `products_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_sizes_product_id_foreign` (`product_id`),
  ADD KEY `products_sizes_size_id_foreign` (`size_id`);

--
-- Indexes for table `product_additionalinfos`
--
ALTER TABLE `product_additionalinfos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_additionalinfos_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_extras`
--
ALTER TABLE `product_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_extras_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_offer_types`
--
ALTER TABLE `product_offer_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_offer_types_offer_id_foreign` (`offer_id`),
  ADD KEY `product_offer_types_offer_product_id_foreign` (`offer_product_id`);

--
-- Indexes for table `product_overviews`
--
ALTER TABLE `product_overviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_overviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_prices_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_stocks_product_id_foreign` (`product_id`),
  ADD KEY `product_stocks_size_id_foreign` (`size_id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_tags_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_thumbnails`
--
ALTER TABLE `product_thumbnails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_thumbnails_product_id_foreign` (`product_id`);

--
-- Indexes for table `register_customers`
--
ALTER TABLE `register_customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `register_customers_email_unique` (`email`),
  ADD KEY `register_customers_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_customer_id_foreign` (`customer_id`),
  ADD KEY `shippings_order_id_foreign` (`order_id`),
  ADD KEY `area` (`area`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socialinfos`
--
ALTER TABLE `socialinfos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategories_slug_unique` (`slug`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_customer_id_foreign` (`customer_id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`);

--
-- Indexes for table `upazillas`
--
ALTER TABLE `upazillas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upazillas_district_id_foreign` (`district_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `varients`
--
ALTER TABLE `varients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webmessages`
--
ALTER TABLE `webmessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_infos`
--
ALTER TABLE `web_infos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutuses`
--
ALTER TABLE `aboutuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `applied_coupones`
--
ALTER TABLE `applied_coupones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `camp_products`
--
ALTER TABLE `camp_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `contactinfos`
--
ALTER TABLE `contactinfos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT for table `delivery_zones`
--
ALTER TABLE `delivery_zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feature_categories`
--
ALTER TABLE `feature_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feature_products`
--
ALTER TABLE `feature_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feature_products_with_pivot`
--
ALTER TABLE `feature_products_with_pivot`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `offer_types`
--
ALTER TABLE `offer_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orderstatuses`
--
ALTER TABLE `orderstatuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postcodes`
--
ALTER TABLE `postcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1350;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `products_colors`
--
ALTER TABLE `products_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `products_sizes`
--
ALTER TABLE `products_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `product_additionalinfos`
--
ALTER TABLE `product_additionalinfos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `product_extras`
--
ALTER TABLE `product_extras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `product_offer_types`
--
ALTER TABLE `product_offer_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_overviews`
--
ALTER TABLE `product_overviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `product_thumbnails`
--
ALTER TABLE `product_thumbnails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `register_customers`
--
ALTER TABLE `register_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `socialinfos`
--
ALTER TABLE `socialinfos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `upazillas`
--
ALTER TABLE `upazillas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=496;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `varients`
--
ALTER TABLE `varients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `webmessages`
--
ALTER TABLE `webmessages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `web_infos`
--
ALTER TABLE `web_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applied_coupones`
--
ALTER TABLE `applied_coupones`
  ADD CONSTRAINT `applied_coupones_coupone_id_foreign` FOREIGN KEY (`coupone_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applied_coupones_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applied_coupones_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `camp_products`
--
ALTER TABLE `camp_products`
  ADD CONSTRAINT `camp_products_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `camp_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `delivery_zones`
--
ALTER TABLE `delivery_zones`
  ADD CONSTRAINT `delivery_zones_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feature_categories`
--
ALTER TABLE `feature_categories`
  ADD CONSTRAINT `feature_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feature_products_with_pivot`
--
ALTER TABLE `feature_products_with_pivot`
  ADD CONSTRAINT `feature_products_with_pivot_feature_products_id_foreign` FOREIGN KEY (`feature_products_id`) REFERENCES `feature_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feature_products_with_pivot_products_id_foreign` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_offer_type_id_foreign` FOREIGN KEY (`offer_type_id`) REFERENCES `offer_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orderstatuses`
--
ALTER TABLE `orderstatuses`
  ADD CONSTRAINT `orderstatuses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `postcodes`
--
ALTER TABLE `postcodes`
  ADD CONSTRAINT `postcodes_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `postcodes_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_offer_types`
--
ALTER TABLE `product_offer_types`
  ADD CONSTRAINT `product_offer_types_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_offer_types_offer_product_id_foreign` FOREIGN KEY (`offer_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD CONSTRAINT `product_stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_stocks_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
