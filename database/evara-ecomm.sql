-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 05:09 AM
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
-- Database: `evara-ecomm`
--

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
(1, 'Qbit-Tech', 'Qbit-Tech_1704958541.jpg', 'qbit-tech', '1', '2024-01-11 01:35:41', '2024-01-11 01:35:41');

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
  `category_icon` varchar(255) NOT NULL,
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
(1, 'QZjal28HnXR9', 'T-Shirt', NULL, 'category_image/icons/icon_1706503206.jpg', 'T-Shirt_1706503207.jpg', 't-shirt', '1', '2024-01-28 22:40:07', '2024-01-28 22:40:07'),
(2, 'VWNtQqB2E0Hc', 'Shirt', NULL, 'category_image/icons/icon_1706503228.webp', 'Shirt_1706503228.jpg', 'shirt', '1', '2024-01-28 22:40:28', '2024-01-28 22:40:28'),
(3, 'RvnlmkgT8Dwj', 'Trouser', NULL, 'category_image/icons/icon_1706503244.jpg', 'Trouser_1706503244.jpg', 'trouser', '1', '2024-01-28 22:40:44', '2024-01-28 22:40:44'),
(4, '0Rl1jdQbJF9X', 'Long Sleve Tshirt', 'T-Shirt', 'category_image/icons/icon_1706503267.jpg', 'Long Sleve Tshirt_1706503267.jpg', 'long-sleve-tshirt', '1', '2024-01-28 22:41:08', '2024-01-28 22:41:08'),
(5, 'Ap36GoNIQCKl', 'Long Sleve Shirt', 'Shirt', 'category_image/icons/icon_1706503314.jpg', NULL, 'long-sleve-shirt', '1', '2024-01-28 22:41:54', '2024-01-28 22:41:54'),
(6, 'AidmXK76JjLH', 'China Trouser', 'Trouser', 'category_image/icons/icon_1706503344.jpg', NULL, 'china-trouser', '1', '2024-01-28 22:42:24', '2024-01-28 22:42:24'),
(7, 'Ygu37AjStBil', 'China Shirt', 'Long Sleve Shirt', 'category_image/icons/icon_1706503390.webp', NULL, 'china-shirt', '1', '2024-01-28 22:43:11', '2024-01-28 22:43:11'),
(8, 'oXBICMqef4nJ', 'China big Shirt', 'Shirt', 'category_image/icons/icon_1706503491.jpg', NULL, 'china-big-shirt', '1', '2024-01-28 22:44:52', '2024-01-28 22:44:52');

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
(1, 'Red', 'rgba(245, 0, 0, 1)', 1, '2024-01-11 01:52:27', '2024-01-30 04:08:36'),
(2, 'Blue', 'rgba(0, 34, 255, 1)', 1, '2024-01-11 01:53:35', '2024-01-11 01:53:35'),
(3, 'Green', 'rgba(26, 230, 23, 1)', 1, '2024-01-30 04:18:20', '2024-01-30 04:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `email` varchar(255) NOT NULL,
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
(31, 'Arif', 'Hossen', '01303638635', 'arifhossen@gmail.com', '522/B North Shajahanpur, Dhaka.', '3', '1', '469', '0', 'registerd', '2024-01-17 04:20:37', '2024-01-24 02:06:32'),
(32, 'Hasan', 'Ali', '01303638631', 'arifhosse12@gmail.com', '23 Gondersor, chilmari, cumilla', '2', '44', '293', '0', 'not registerd', '2024-01-18 00:18:43', '2024-01-18 00:18:43'),
(33, 'Hasan', 'ahmed', '01303638637', 'arifhosse5@gmail.com', '556 Halkuti,  Amtali, Barguna.', '1', '34', '1', '0', 'registerd', '2024-01-18 01:21:02', '2024-01-24 01:07:28'),
(34, 'Abir', 'Hossain', '01795795443', 'arifhosse123@gmail.com', '512/c North Shajahanpur, Dhaka', '3', '1', '453', '10', 'registerd', '2024-01-20 22:19:02', '2024-01-20 22:19:03'),
(35, 'Hasan', 'Abir', '01601958562', 'hasan.abir@gmail.com', NULL, NULL, NULL, NULL, '0', 'not registerd', '2024-01-20 23:37:44', '2024-01-20 23:37:44'),
(36, 'Hasan', 'Abir', '01601958563', 'hasan.abir1@gmail.com', NULL, NULL, NULL, NULL, '0', 'not registerd', '2024-01-20 23:42:28', '2024-01-20 23:42:28'),
(37, 'Arif', 'Hossen', '01601958566', 'arifhossen560@gmail.com', '522/B North Shajahanpur, Dhaka', NULL, NULL, NULL, '0', 'registerd', '2024-01-20 23:47:07', '2024-01-24 04:37:42'),
(38, 'Himel', 'Vai', '01795795442', 'himel.vai@gmail.com', '522/B North Shajahanpur, Dhaka', '2', '40', '117', '10', 'not registerd', '2024-01-30 00:29:22', '2024-01-30 00:29:22');

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

--
-- Dumping data for table `delivery_zones`
--

INSERT INTO `delivery_zones` (`id`, `district_id`, `upazila`, `charge`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Dhaka Cantt.', 80.00, 'Inactive', '2024-01-29 05:12:07', '2024-01-29 05:14:48'),
(3, 1, 'Demra', 80.00, 'Active', '2024-01-29 05:13:05', '2024-01-30 01:41:08'),
(4, 2, 'Alfadanga', 20.00, 'Active', '2024-01-30 00:09:24', '2024-01-30 00:09:24'),
(5, 1, 'Khilgaon', 80.00, 'Active', '2024-01-30 01:20:54', '2024-01-30 01:24:24'),
(6, 3, 'Kaliakaar', 60.00, 'Active', '2024-01-30 01:40:13', '2024-01-30 01:40:13');

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
(14, '2023_12_26_112636_create_offers_table', 1),
(15, '2023_12_27_070522_create_coupons_table', 1),
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
(46, '2024_01_29_055920_create_delivery_zones_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(8,2) DEFAULT NULL,
  `total` varchar(255) NOT NULL,
  `delivery_charge` varchar(255) DEFAULT '0',
  `status` enum('pending','confirmed','delivered','completed','returned','cancelled','shipped') NOT NULL DEFAULT 'pending',
  `is_shipping_different` tinyint(1) NOT NULL DEFAULT 0,
  `delivered_date` date DEFAULT NULL,
  `canceled_date` date DEFAULT NULL,
  `comment` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `subtotal`, `discount`, `tax`, `total`, `delivery_charge`, `status`, `is_shipping_different`, `delivered_date`, `canceled_date`, `comment`, `created_at`, `updated_at`) VALUES
(27, 31, 15225.00, 0.00, 761.25, '0', '0', 'completed', 0, NULL, NULL, NULL, '2024-01-17 04:20:37', '2024-01-22 05:28:03'),
(28, 32, 30450.00, 0.00, 761.25, '0', '0', 'confirmed', 0, NULL, NULL, NULL, '2024-01-18 00:18:43', '2024-01-22 01:19:45'),
(29, 33, 600.00, 0.00, 30.00, '0', '0', 'confirmed', 0, NULL, NULL, NULL, '2024-01-18 01:21:02', '2024-01-22 01:19:45'),
(30, 31, 902.50, 0.00, 45.13, '0', '0', 'delivered', 0, NULL, NULL, NULL, '2024-01-18 05:13:36', '2024-01-22 05:22:37'),
(31, 31, 230222.00, 0.00, 5755.55, '0', '0', 'completed', 0, NULL, NULL, NULL, '2024-01-18 05:15:57', '2024-01-22 01:21:42'),
(32, 31, 1200.00, 0.00, 60.00, '0', '0', 'cancelled', 0, NULL, NULL, NULL, '2024-01-18 05:16:46', '2024-01-22 05:04:49'),
(33, 31, 1200.00, 0.00, 60.00, '1260', '0', 'confirmed', 0, NULL, NULL, NULL, '2024-01-18 05:55:48', '2024-01-22 01:19:45'),
(34, 31, 115111.00, 0.00, 5755.55, '122666.55', '0', 'confirmed', 0, NULL, NULL, NULL, '2024-01-18 05:56:12', '2024-01-22 01:19:45'),
(35, 31, 16727.50, 0.00, 45.13, '16772.63', '0', 'confirmed', 0, NULL, NULL, NULL, '2024-01-18 06:00:48', '2024-01-22 01:19:45'),
(36, 33, 4400.00, 0.00, 25.00, '4425', '0', 'confirmed', 0, NULL, NULL, NULL, '2024-01-18 06:04:32', '2024-01-22 01:19:45'),
(37, 33, 76125.00, 0.00, 761.25, '76886.25', '0', 'confirmed', 0, NULL, NULL, NULL, '2024-01-20 22:15:48', '2024-01-22 01:16:43'),
(38, 34, 1805.00, 0.00, 45.13, '1850.13', '0', 'confirmed', 0, NULL, NULL, NULL, '2024-01-20 22:19:03', '2024-01-22 01:16:43'),
(39, 33, 1200.00, 0.00, 60.00, '1260', '0', 'pending', 0, NULL, NULL, NULL, '2024-01-22 03:30:10', '2024-01-22 03:30:10'),
(40, 33, 1200.00, 0.00, 60.00, '1260', '0', 'pending', 0, NULL, NULL, NULL, '2024-01-22 03:31:52', '2024-01-22 03:31:52'),
(41, 33, 30450.00, 0.00, 761.25, '31211.25', '0', 'pending', 0, NULL, NULL, NULL, '2024-01-22 05:38:42', '2024-01-22 05:38:42'),
(42, 31, 60900.00, 0.00, 761.25, '61661.25', '0', 'shipped', 0, NULL, NULL, NULL, '2024-01-24 05:47:46', '2024-01-24 05:49:52'),
(43, 38, 3600.00, 0.00, 60.00, '3660', '80', 'pending', 1, NULL, NULL, NULL, '2024-01-30 00:29:22', '2024-01-30 00:29:22');

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

--
-- Dumping data for table `orderstatuses`
--

INSERT INTO `orderstatuses` (`id`, `order_id`, `status`, `confirmed_date_time`, `shipped_date_time`, `delivered_date_time`, `completed_date_time`, `returned_date_time`, `cancelled_date_time`, `created_at`, `updated_at`) VALUES
(4, 27, 'completed', '2024-01-22 07:19:45', '2024-01-22 07:08:21', '2024-01-22 10:11:32', '2024-01-22 11:28:03', '2024-01-22 06:38:39', '2024-01-22 06:38:47', '2024-01-22 00:38:01', '2024-01-22 05:28:03'),
(5, 28, 'confirmed', '2024-01-22 07:19:45', '2024-01-22 06:41:54', NULL, '2024-01-22 07:13:29', NULL, NULL, '2024-01-22 00:41:54', '2024-01-22 01:19:45'),
(6, 38, 'confirmed', '2024-01-22 07:16:43', NULL, NULL, '2024-01-22 06:52:57', NULL, NULL, '2024-01-22 00:43:17', '2024-01-22 01:16:43'),
(7, 30, 'delivered', '2024-01-22 07:19:45', NULL, '2024-01-22 11:22:37', '2024-01-22 07:21:42', NULL, NULL, '2024-01-22 00:43:29', '2024-01-22 05:22:37'),
(8, 31, 'completed', '2024-01-22 07:19:45', NULL, NULL, '2024-01-22 07:21:42', NULL, NULL, '2024-01-22 00:43:33', '2024-01-22 01:21:42'),
(9, 32, 'cancelled', '2024-01-22 07:19:45', '2024-01-22 10:27:33', NULL, '2024-01-22 07:21:42', '2024-01-22 10:31:11', '2024-01-22 11:04:49', '2024-01-22 00:43:37', '2024-01-22 05:04:49'),
(10, 33, 'confirmed', '2024-01-22 07:19:45', NULL, NULL, '2024-01-22 07:13:29', NULL, NULL, '2024-01-22 00:43:40', '2024-01-22 01:19:45'),
(11, 34, 'confirmed', '2024-01-22 07:19:45', NULL, NULL, '2024-01-22 07:13:29', NULL, NULL, '2024-01-22 00:43:42', '2024-01-22 01:19:45'),
(12, 29, 'confirmed', '2024-01-22 07:19:45', NULL, NULL, '2024-01-22 07:17:34', NULL, NULL, '2024-01-22 00:52:20', '2024-01-22 01:19:45'),
(13, 35, 'confirmed', '2024-01-22 07:19:45', NULL, NULL, '2024-01-22 07:13:29', NULL, NULL, '2024-01-22 00:52:20', '2024-01-22 01:19:45'),
(14, 36, 'confirmed', '2024-01-22 07:19:45', NULL, NULL, '2024-01-22 07:13:29', NULL, NULL, '2024-01-22 00:52:20', '2024-01-22 01:19:45'),
(15, 37, 'confirmed', '2024-01-22 07:16:43', NULL, NULL, '2024-01-22 07:14:13', NULL, NULL, '2024-01-22 01:14:13', '2024-01-22 01:16:43'),
(16, 40, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-22 03:31:52', '2024-01-22 03:31:52'),
(17, 39, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-22 03:33:28', '2024-01-22 03:33:28'),
(18, 41, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-22 05:38:42', '2024-01-22 05:38:42'),
(19, 42, 'shipped', NULL, '2024-01-24 11:49:52', NULL, NULL, NULL, NULL, '2024-01-24 05:47:46', '2024-01-24 05:49:52'),
(20, 43, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 00:29:22', '2024-01-30 00:29:22');

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
  `comment` longtext DEFAULT NULL,
  `rstatus` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `product_id`, `order_id`, `color_id`, `size_id`, `price`, `quantity`, `comment`, `rstatus`, `created_at`, `updated_at`) VALUES
(25, 1, 27, NULL, NULL, 15225.00, 1, NULL, 0, '2024-01-17 04:20:37', '2024-01-17 04:20:37'),
(26, 1, 28, NULL, NULL, 15225.00, 2, NULL, 0, '2024-01-18 00:18:43', '2024-01-18 00:18:43'),
(27, 6, 29, NULL, NULL, 600.00, 1, NULL, 0, '2024-01-18 01:21:02', '2024-01-18 01:21:02'),
(28, 3, 30, NULL, NULL, 902.50, 1, NULL, 0, '2024-01-18 05:13:36', '2024-01-18 05:13:36'),
(29, 12, 31, NULL, NULL, 115111.00, 2, NULL, 0, '2024-01-18 05:15:57', '2024-01-18 05:15:57'),
(30, 1, 32, NULL, NULL, 15225.00, 1, NULL, 0, '2024-01-18 05:16:46', '2024-01-18 05:16:46'),
(31, 3, 32, NULL, NULL, 902.50, 1, NULL, 0, '2024-01-18 05:16:46', '2024-01-18 05:16:46'),
(32, 4, 32, NULL, NULL, 500.00, 1, NULL, 0, '2024-01-18 05:16:46', '2024-01-18 05:16:46'),
(33, 6, 32, NULL, NULL, 600.00, 1, NULL, 0, '2024-01-18 05:16:46', '2024-01-18 05:16:46'),
(34, 9, 32, NULL, NULL, 1200.00, 1, NULL, 0, '2024-01-18 05:16:46', '2024-01-18 05:16:46'),
(35, 9, 33, NULL, NULL, 1200.00, 1, NULL, 0, '2024-01-18 05:55:48', '2024-01-18 05:55:48'),
(36, 6, 34, NULL, NULL, 600.00, 1, NULL, 0, '2024-01-18 05:56:12', '2024-01-18 05:56:12'),
(37, 9, 34, NULL, NULL, 1200.00, 1, NULL, 0, '2024-01-18 05:56:12', '2024-01-18 05:56:12'),
(38, 12, 34, NULL, NULL, 115111.00, 1, NULL, 0, '2024-01-18 05:56:12', '2024-01-18 05:56:12'),
(39, 6, 35, NULL, NULL, 600.00, 1, NULL, 0, '2024-01-18 06:00:48', '2024-01-18 06:00:48'),
(40, 1, 35, NULL, NULL, 15225.00, 1, NULL, 0, '2024-01-18 06:00:48', '2024-01-18 06:00:48'),
(41, 3, 35, NULL, NULL, 902.50, 1, NULL, 0, '2024-01-18 06:00:48', '2024-01-18 06:00:48'),
(42, 9, 36, NULL, NULL, 1200.00, 2, NULL, 0, '2024-01-18 06:04:32', '2024-01-18 06:04:32'),
(43, 4, 36, NULL, NULL, 500.00, 4, NULL, 0, '2024-01-18 06:04:32', '2024-01-18 06:04:32'),
(44, 1, 37, 1, 1, 15225.00, 5, NULL, 0, '2024-01-20 22:15:48', '2024-01-20 22:15:48'),
(45, 3, 38, 1, 1, 902.50, 2, NULL, 0, '2024-01-20 22:19:03', '2024-01-20 22:19:03'),
(46, 9, 40, NULL, NULL, 1200.00, 1, NULL, 0, '2024-01-22 03:31:52', '2024-01-22 03:31:52'),
(47, 1, 41, 1, 1, 15225.00, 2, NULL, 0, '2024-01-22 05:38:42', '2024-01-22 05:38:42'),
(48, 1, 42, 2, 1, 15225.00, 4, NULL, 0, '2024-01-24 05:47:46', '2024-01-24 05:47:46'),
(49, 9, 43, NULL, NULL, 1200.00, 3, NULL, 0, '2024-01-30 00:29:22', '2024-01-30 00:29:22');

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
(455, 3, 1, 'Dhaka Cantt.', 80, 'Dhaka CantonmentTSO', '1206', NULL, '2024-01-29 05:14:48'),
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
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `raw_price` varchar(255) DEFAULT NULL,
  `regular_price` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `sku` varchar(255) NOT NULL,
  `stock` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `brand_id`, `category_id`, `subcategory_id`, `raw_price`, `regular_price`, `description`, `sku`, `stock`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New Year T-shirt', 1, 1, 1, '15000', '17500', '<p>New Year Tshirt.<br></p>', 'RU2TK8WF', '10', 'new-year-t-shirt', 'active', '2024-01-11 01:56:57', '2024-01-11 03:51:38'),
(3, 'Special Cozy Cotton Pants', 1, 1, 1, '600', '950', '<div class=\"entry-content woocommerce-Tabs-panel woocommerce-Tabs-panel--description wd-active panel wc-tab\" id=\"tab-description\" role=\"tabpanel\" aria-labelledby=\"tab-title-description\" data-accordion-index=\"description\" style=\"display: block;\"><div class=\"wc-tab-inner\"><div dir=\"auto\"><img class=\"alignnone size-medium wp-image-20832\" src=\"https://daarkak.com/wp-content/uploads/2023/11/Size-400x267.png\" alt=\"\" width=\"400\" height=\"267\"></div><div dir=\"auto\"><span class=\"x3nfvp2 x1j61x8r x1fcty0u xdj266r xhhsvwb xat24cr xgzva0m xxymvpz xlup9mm x1kky2od\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tba/1.5/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\"></span>&nbsp;Made of 100% cotton</div><div dir=\"auto\"><span class=\"x3nfvp2 x1j61x8r x1fcty0u xdj266r xhhsvwb xat24cr xgzva0m xxymvpz xlup9mm x1kky2od\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tba/1.5/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\"></span>&nbsp;Covered 100% cotton waistband (woven fabric)</div><div dir=\"auto\"><span class=\"x3nfvp2 x1j61x8r x1fcty0u xdj266r xhhsvwb xat24cr xgzva0m xxymvpz xlup9mm x1kky2od\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tba/1.5/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\"></span>&nbsp;Drawstring for an adjustable fit</div><div dir=\"auto\"><span class=\"x3nfvp2 x1j61x8r x1fcty0u xdj266r xhhsvwb xat24cr xgzva0m xxymvpz xlup9mm x1kky2od\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tba/1.5/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\"></span>&nbsp;Convenient side seam pockets</div><div dir=\"auto\"><span class=\"x3nfvp2 x1j61x8r x1fcty0u xdj266r xhhsvwb xat24cr xgzva0m xxymvpz xlup9mm x1kky2od\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tba/1.5/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\"></span>&nbsp;Soft material for comfort</div><div dir=\"auto\"><span class=\"x3nfvp2 x1j61x8r x1fcty0u xdj266r xhhsvwb xat24cr xgzva0m xxymvpz xlup9mm x1kky2od\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tba/1.5/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\"></span>&nbsp;Durability tightly coupled stitches</div><div dir=\"auto\"><span class=\"x3nfvp2 x1j61x8r x1fcty0u xdj266r xhhsvwb xat24cr xgzva0m xxymvpz xlup9mm x1kky2od\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tba/1.5/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\"></span>&nbsp;Fabric type : Texture fabric.</div><div dir=\"auto\"><span class=\"x3nfvp2 x1j61x8r x1fcty0u xdj266r xhhsvwb xat24cr xgzva0m xxymvpz xlup9mm x1kky2od\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tba/1.5/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\"></span>&nbsp;premium pocketing with stitches</div><div dir=\"auto\"><span class=\"x3nfvp2 x1j61x8r x1fcty0u xdj266r xhhsvwb xat24cr xgzva0m xxymvpz xlup9mm x1kky2od\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tba/1.5/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\"></span>&nbsp;GSM : 180</div></div></div><p></p>', 'Q5TPX18C', '100', 'special-cozy-cotton-pants', 'active', '2024-01-14 02:11:57', '2024-01-14 02:11:57'),
(4, 'Award Crest', 1, 2, 2, '500', '500', '<p>rifat hossain</p>', '56MXO32Y', '80', 'award-crest', 'active', '2024-01-18 00:45:30', '2024-01-18 00:45:30'),
(6, 'Cristal Crest', 1, 2, 2, '600', '600', '<p>masud vai</p>', 'DM4FU2QJ', '561230', 'cristal-crest', 'active', '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(9, 'Fabrilife Mens Multi-Shades Hoodie - Stormy Sea', 1, 1, 5, '1000', '1200', '<ul class=\"\" style=\"margin-block-start: 1em; font-size: 14px; overflow: hidden; columns: 2; column-gap: 32px; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li class=\"\" data-spm-anchor-id=\"a2a0e.pdp.product_detail.i0.1f682d20pjOCGW\" style=\"padding-left: 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Relaxed-Fit hoodie in Cotton-blend fabric with soft brushed inside. Jersey-lined Wrapover hood with drawstring, kangaroo pocket, and long sleeves. Wide ribbing at cuff and hem.</li><li class=\"\" style=\"padding-left: 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Incredibly Soft and super comfortable, perfect for the whole winter.</li><li class=\"\" style=\"padding-left: 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Designed to shield you and keep you warm on cool windy days.</li><li class=\"\" style=\"padding-left: 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Heathered with insulating properties.</li></ul>', 'N2O5RVPX', '5000', 'fabrilife-mens-multi-shades-hoodie-stormy-sea', 'active', '2024-01-18 01:36:17', '2024-01-18 01:36:17'),
(12, 'City Boy Premium Printed Men\'s Winter Jacket', 1, 1, 1, '45454', '115111', '<p><span style=\"font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\">It\'s a high-quality Black shade digital print winter jacket for men manufactured by City Boy. It\'s a Premium quality jacket with 100% QC pass product. The fabric and swing are very high quality. High-quality and imported fabric. This is a very stylish and trendy product. Fabric is very comfortable and skin-friendly. It\'s a fashionable winter jacket for men and a stylish bomber winter jacket for men. 100% quality jacket. This is Microfiber Polyester Fabric and uses rip in the bottom, hand and in collar. This is a trendy jacket in Bangladesh.</span><br></p>', '2YL3OAXN', NULL, 'city-boy-premium-printed-mens-winter-jacket', 'active', '2024-01-18 01:56:06', '2024-01-18 01:56:06');

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
(1, 1, 1, '2024-01-11 01:56:57', '2024-01-11 01:56:57'),
(2, 1, 2, '2024-01-11 01:56:57', '2024-01-11 01:56:57'),
(5, 3, 1, '2024-01-14 02:11:57', '2024-01-14 02:11:57'),
(6, 3, 2, '2024-01-14 02:11:57', '2024-01-14 02:11:57'),
(7, 4, 1, '2024-01-18 00:45:30', '2024-01-18 00:45:30'),
(8, 6, 2, '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(10, 9, 1, '2024-01-18 01:36:17', '2024-01-18 01:36:17'),
(11, 9, 2, '2024-01-18 01:36:17', '2024-01-18 01:36:17');

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
(1, 1, 1, '2024-01-11 01:56:57', '2024-01-11 01:56:57'),
(2, 1, 2, '2024-01-11 01:56:57', '2024-01-11 01:56:57'),
(5, 3, 1, '2024-01-14 02:11:57', '2024-01-14 02:11:57'),
(6, 3, 2, '2024-01-14 02:11:57', '2024-01-14 02:11:57'),
(7, 4, 1, '2024-01-18 00:45:30', '2024-01-18 00:45:30'),
(8, 6, 1, '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(10, 9, 1, '2024-01-18 01:36:17', '2024-01-18 01:36:17'),
(11, 9, 2, '2024-01-18 01:36:17', '2024-01-18 01:36:17');

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
(1, 1, 'Frame :', 'aa', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(2, 1, 'Weight Capacity :', 'bb', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(3, 1, 'Width :', 'cc', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(4, 1, 'Height :', 'dd', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(5, 1, 'Wheels :', 'ee', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(11, 3, 'Frame :', 'aa', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(12, 3, 'Weight Capacity :', '✅ Covered 100% cotton waistband (woven fabric)', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(13, 3, 'Width :', '✅ Covered 100% cotton waistband (woven fabric)', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(14, 3, 'Height :', '✅ Covered 100% cotton waistband (woven fabric)', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(15, 3, 'Wheels :', '✅ Covered 100% cotton waistband (woven fabric)', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(16, 4, 'Frame :', 'award', '2024-01-18 00:45:30', '2024-01-18 00:45:30'),
(17, 4, 'Weight Capacity :', '1.kg', '2024-01-18 00:45:30', '2024-01-18 00:45:30'),
(18, 4, 'Width :', '1.8', '2024-01-18 00:45:30', '2024-01-18 00:45:30'),
(19, 4, 'Height :', '1.5', '2024-01-18 00:45:30', '2024-01-18 00:45:30'),
(20, 4, 'Wheels :', '25', '2024-01-18 00:45:30', '2024-01-18 00:45:30'),
(26, 6, 'Frame :', 'uygm,njd', '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(27, 6, 'Weight Capacity :', '215', '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(28, 6, 'Width :', '561230', '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(29, 6, 'Height :', '5656', '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(30, 6, 'Wheels :', '7845', '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(36, 9, 'Frame :', 'Approx.', '2024-01-18 01:36:17', '2024-01-18 01:36:17'),
(37, 9, 'Weight Capacity :', '35cm x 27cm', '2024-01-18 01:36:17', '2024-01-18 01:36:17'),
(38, 9, 'Width :', '19.84\"', '2024-01-18 01:36:17', '2024-01-18 01:36:17'),
(39, 9, 'Height :', '10.63\"', '2024-01-18 01:36:17', '2024-01-18 01:36:17'),
(40, 9, 'Wheels :', '1', '2024-01-18 01:36:17', '2024-01-18 01:36:17'),
(41, 12, 'Frame :', 'Approx.', '2024-01-18 01:56:06', '2024-01-18 01:56:06'),
(42, 12, 'Weight Capacity :', '35cm x 27cm', '2024-01-18 01:56:06', '2024-01-18 01:56:06'),
(43, 12, 'Width :', '9.84\"', '2024-01-18 01:56:06', '2024-01-18 01:56:06'),
(44, 12, 'Height :', '10.63\"', '2024-01-18 01:56:06', '2024-01-18 01:56:06'),
(45, 12, 'Wheels :', '1', '2024-01-18 01:56:06', '2024-01-18 01:56:06');

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
(1, 1, '1 Year Brand Warranty', '7 days return policy (No change of mind applicable)', '1', 'Available', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(3, 3, 'No Warranty', 'Non returnable', '1', 'Not Available', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(4, 4, '1 years', '3 days', '1', 'Available', '2024-01-18 00:45:30', '2024-01-18 00:45:30'),
(6, 6, '5year', '7days', '1', 'Available', '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(8, 9, NULL, NULL, '0', 'Available', '2024-01-18 01:36:17', '2024-01-18 01:36:17'),
(9, 12, NULL, NULL, '0', 'Available', '2024-01-18 01:56:06', '2024-01-18 01:56:06');

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
(1, 1, 'new-year-t-shirt_0_1704959817.webp', '', '2024-01-11 01:56:57', '2024-01-11 01:56:57'),
(2, 1, 'new-year-t-shirt_1_1704959817.webp', '', '2024-01-11 01:56:57', '2024-01-11 01:56:57'),
(3, 1, 'new-year-t-shirt_2_1704959817.webp', '', '2024-01-11 01:56:57', '2024-01-11 01:56:57'),
(4, 1, 'new-year-t-shirt_3_1704959817.webp', '', '2024-01-11 01:56:57', '2024-01-11 01:56:57'),
(5, 1, 'new-year-t-shirt_4_1704959817.webp', '', '2024-01-11 01:56:57', '2024-01-11 01:56:57'),
(6, 1, 'new-year-t-shirt_5_1704959817.webp', '', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(7, 1, 'new-year-t-shirt_6_1704959818.webp', '', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(8, 1, 'new-year-t-shirt_7_1704959818.webp', '', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(14, 3, 'special-cozy-cotton-pants_0_1705219917.webp', '', '2024-01-14 02:11:57', '2024-01-14 02:11:57'),
(15, 3, 'special-cozy-cotton-pants_1_1705219917.webp', '', '2024-01-14 02:11:57', '2024-01-14 02:11:57'),
(16, 3, 'special-cozy-cotton-pants_2_1705219917.webp', '', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(17, 3, 'special-cozy-cotton-pants_3_1705219918.webp', '', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(18, 3, 'special-cozy-cotton-pants_4_1705219918.webp', '', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(19, 3, 'special-cozy-cotton-pants_5_1705219918.webp', '', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(20, 4, 'award-crest_0_1705560330.png', '', '2024-01-18 00:45:30', '2024-01-18 00:45:30'),
(22, 6, 'cristal-crest_0_1705561128.png', '', '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(23, 6, 'cristal-crest_1_1705561128.jpg', '', '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(25, 9, 'fabrilife-mens-multi-shades-hoodie-stormy-sea_0_1705563377.png', '', '2024-01-18 01:36:17', '2024-01-18 01:36:17'),
(26, 12, 'city-boy-premium-printed-mens-winter-jacket_0_1705564566.png', '', '2024-01-18 01:56:06', '2024-01-18 01:56:06');

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
(1, 1, 'Packing :', 'Pack', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(2, 1, 'Color:', 'Multicolor', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(5, 3, 'Fabric', 'Made of 100% cotton', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(6, 3, 'Fabric type', 'Texture fabric', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(7, 4, 'Type Of Packing :', 'Arifuzzaman', '2024-01-18 00:45:30', '2024-01-18 00:45:30'),
(8, 4, 'badrujjaman', 'badrujjaman', '2024-01-18 00:45:30', '2024-01-18 00:45:30'),
(10, 6, 'Type Of Packing :', 'masud vai', '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(12, 9, 'Type Of Packing :', 'Paper Box', '2024-01-18 01:36:17', '2024-01-18 01:36:17'),
(13, 12, 'Type Of Packing :', 'Paper Box', '2024-01-18 01:56:06', '2024-01-18 01:56:06');

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
(1, 1, '15225', '13', '2275', '2024-01-11 01:56:58', '2024-01-11 04:50:45'),
(2, 3, '902.5', '5', '47.5', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(3, 4, '0', '0', NULL, '2024-01-18 00:45:30', '2024-01-18 00:50:20'),
(4, 6, '0', NULL, NULL, '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(5, 12, '0', NULL, NULL, '2024-01-18 01:56:06', '2024-01-18 01:56:06'),
(6, 9, '0', NULL, NULL, NULL, NULL);

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
(1, 1, 'Tshirt', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(2, 1, 'Newyear', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(3, 1, '2024', '2024-01-11 01:56:58', '2024-01-11 01:56:58'),
(4, 1, '', '2024-01-11 02:41:34', '2024-01-11 02:41:34'),
(5, 3, 'special', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(6, 3, 'cozy', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(7, 3, 'cotton', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(8, 3, 'pants', '2024-01-14 02:11:58', '2024-01-14 02:11:58'),
(9, 4, '', '2024-01-18 00:45:30', '2024-01-18 00:45:30'),
(10, 6, '', '2024-01-18 00:58:48', '2024-01-18 00:58:48'),
(11, 12, '', '2024-01-18 01:56:06', '2024-01-18 01:56:06');

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
(1, 31, '01601958560', 'arifhosse55@gmail.com', '$2y$12$oyxR.yqD4uyNmEHA3Baa6.n.JNUHpiyfkv9Ek8VugrrpPdAKAF6Hy', 'registerd', NULL, '2024-01-17 04:20:37', '2024-01-24 04:11:43'),
(2, 33, '01303638637', 'arifhosse5@gmail.com', '$2y$12$ThuQLFrM2S82H5DGhng4duqJCpMNpU1Na9fynBCn62EiGCfwjztmW', 'registerd', NULL, '2024-01-18 01:21:02', '2024-01-18 01:21:02'),
(3, 34, '01795795443', 'arifhosse123@gmail.com', '$2y$12$jNZrYx6A.vdDSKCQRMp/D.QzSFDbijOSpE.5MCNA1nFfUjEkvcQJ.', 'registerd', NULL, '2024-01-20 22:19:03', '2024-01-20 22:19:03'),
(4, 35, '01601958562', 'hasan.abir@gmail.com', '$2y$12$V1.4Ws/Br/xBPmeoaSh0puSWXgMP1c0SgoWCTXHronsICsEhnZ6Qy', 'registerd', NULL, '2024-01-20 23:37:45', '2024-01-20 23:37:45'),
(5, 36, '01601958563', 'hasan.abir1@gmail.com', '$2y$12$g/kfL3jFreg5EaF8kMonLuKfnX2VTcz3sQydIkki2NjIJKVesZzgO', 'registerd', NULL, '2024-01-20 23:42:29', '2024-01-20 23:42:29'),
(6, 37, '01601958566', 'arifhossen560@gmail.com', '$2y$12$BRNgWc5c/PW4Jt.QYvFL4eRaimLDavfMMlm5RxnwnpzdXSC8Qbvxy', 'registerd', NULL, '2024-01-20 23:47:07', '2024-01-20 23:47:07');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
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
(15, 31, 27, 'Arif', 'Hossen', '01303638635', 'arifhosse@gmail.com', '522/B North Shajahanpur, Dhaka.', '3', '1', 469, '2024-01-17 04:20:37', '2024-01-24 02:05:57'),
(16, 32, 28, 'Hasan', 'Ali', '01303638631', 'arifhosse12@gmail.com', '23 Gondersor, chilmari, cumilla', '2', '44', 293, '2024-01-18 00:18:43', '2024-01-18 00:18:43'),
(17, 33, 29, 'Arif', 'Hossen', '01601958560', 'arifhosse5@gmail.com', '23 Gondersor, chilmari, cumilla', '3', '3', 539, '2024-01-18 01:21:02', '2024-01-24 02:03:18'),
(18, 34, 38, 'Abir', 'Hossain', '01795795443', 'arifhosse123@gmail.com', '512/c North Shajahanpur, Dhaka', '3', '1', 453, '2024-01-20 22:19:03', '2024-01-20 22:19:03'),
(19, 38, 43, 'Arif', 'Hossen', '01601958560', 'arif@gmail.com', '186 east Rasulpur, Jatrabari, dhaka', '3', '1', 461, '2024-01-30 00:29:22', '2024-01-30 00:29:22');

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
(1, 'Large', 'L', '1', '2024-01-11 01:52:38', '2024-01-11 01:52:38'),
(2, 'Medium', 'M', '1', '2024-01-11 01:53:49', '2024-01-30 04:08:41'),
(3, 'Small', 'S', '1', '2024-01-30 04:18:41', '2024-01-30 04:18:41');

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

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`, `subcategory_image`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'New Subcategory', 'New Subcategory_1705563025.jpg', 'new-subcategory', '1', '2024-01-11 01:52:09', '2024-01-18 01:30:25'),
(2, 2, 'wooden crest', 'wooden crest_1705560218.png', 'wooden-crest', '1', '2024-01-18 00:43:38', '2024-01-18 00:43:38'),
(5, 1, 'Men\'s Fashion', 'Male Item_1705562540.png', 'male-item', '1', '2024-01-18 01:22:20', '2024-01-18 01:30:44'),
(6, 9, 'Man', 'Man_1705564266.png', 'man', '1', '2024-01-18 01:51:06', '2024-01-18 01:51:06');

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
(1, 'Home Tex', '01795795443', 'home.tex@gmail.com', '123 Hallway', 0.00, 'Active', '2024-01-28 22:01:35', '2024-01-28 22:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `mode` enum('cod','card','online') NOT NULL,
  `status` enum('pending','approved','declined','refunded') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_id`, `order_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES
(15, 31, 27, 'cod', 'pending', '2024-01-17 04:20:37', '2024-01-17 04:20:37'),
(16, 32, 28, 'cod', 'pending', '2024-01-18 00:18:43', '2024-01-18 00:18:43'),
(17, 33, 29, 'cod', 'pending', '2024-01-18 01:21:02', '2024-01-18 01:21:02'),
(18, 31, 30, 'cod', 'pending', '2024-01-18 05:13:36', '2024-01-18 05:13:36'),
(19, 31, 31, 'cod', 'pending', '2024-01-18 05:15:57', '2024-01-18 05:15:57'),
(20, 31, 32, 'cod', 'pending', '2024-01-18 05:16:46', '2024-01-18 05:16:46'),
(21, 31, 33, 'cod', 'pending', '2024-01-18 05:55:48', '2024-01-18 05:55:48'),
(22, 31, 34, 'cod', 'pending', '2024-01-18 05:56:12', '2024-01-18 05:56:12'),
(23, 31, 35, 'cod', 'pending', '2024-01-18 06:00:48', '2024-01-18 06:00:48'),
(24, 33, 36, 'cod', 'pending', '2024-01-18 06:04:32', '2024-01-18 06:04:32'),
(25, 33, 37, 'cod', 'pending', '2024-01-20 22:15:48', '2024-01-20 22:15:48'),
(26, 34, 38, 'cod', 'pending', '2024-01-20 22:19:03', '2024-01-20 22:19:03'),
(27, 33, 40, 'cod', 'pending', '2024-01-22 03:31:52', '2024-01-22 03:31:52'),
(28, 33, 41, 'cod', 'pending', '2024-01-22 05:38:42', '2024-01-22 05:38:42'),
(29, 31, 42, 'cod', 'pending', '2024-01-24 05:47:46', '2024-01-24 05:47:46'),
(30, 38, 43, 'cod', 'pending', '2024-01-30 00:29:22', '2024-01-30 00:29:22');

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
(1, 'Admin', 'admin@evara.com', '2024-01-11 01:33:04', '$2y$12$LYwVhmz7qzsHVZ7YrDhXnuDsLIJ7WvgJitmJ9rVjj8Hs84Wm9Tgxy', 'Lzz2REmkNKQVF6iGVcZRzwUH3I5om143JUMfeZ27Kf9xlUFMBMWgsmOU9EJJ', '2024-01-11 01:33:04', '2024-01-11 01:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `varients`
--

CREATE TABLE `varients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

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
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
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
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`);

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
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_tags_product_id_foreign` (`product_id`);

--
-- Indexes for table `register_customers`
--
ALTER TABLE `register_customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `register_customers_email_unique` (`email`),
  ADD KEY `register_customers_customer_id_foreign` (`customer_id`);

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
-- Indexes for table `varients`
--
ALTER TABLE `varients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `delivery_zones`
--
ALTER TABLE `delivery_zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `orderstatuses`
--
ALTER TABLE `orderstatuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products_colors`
--
ALTER TABLE `products_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products_sizes`
--
ALTER TABLE `products_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_additionalinfos`
--
ALTER TABLE `product_additionalinfos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product_extras`
--
ALTER TABLE `product_extras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_overviews`
--
ALTER TABLE `product_overviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `register_customers`
--
ALTER TABLE `register_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `upazillas`
--
ALTER TABLE `upazillas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=496;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `varients`
--
ALTER TABLE `varients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery_zones`
--
ALTER TABLE `delivery_zones`
  ADD CONSTRAINT `delivery_zones_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products_colors`
--
ALTER TABLE `products_colors`
  ADD CONSTRAINT `products_colors_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_colors_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products_sizes`
--
ALTER TABLE `products_sizes`
  ADD CONSTRAINT `products_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sizes_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_additionalinfos`
--
ALTER TABLE `product_additionalinfos`
  ADD CONSTRAINT `product_additionalinfos_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_extras`
--
ALTER TABLE `product_extras`
  ADD CONSTRAINT `product_extras_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_overviews`
--
ALTER TABLE `product_overviews`
  ADD CONSTRAINT `product_overviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD CONSTRAINT `product_prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD CONSTRAINT `product_tags_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `register_customers`
--
ALTER TABLE `register_customers`
  ADD CONSTRAINT `register_customers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shippings_ibfk_1` FOREIGN KEY (`area`) REFERENCES `postcodes` (`id`),
  ADD CONSTRAINT `shippings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `upazillas`
--
ALTER TABLE `upazillas`
  ADD CONSTRAINT `upazillas_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
