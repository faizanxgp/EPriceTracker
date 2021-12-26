-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2017 at 06:21 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epricetrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `category_url`, `created_at`, `updated_at`) VALUES
(1, 'Mobiles', 'http://daraz.com/mobiles', NULL, NULL),
(2, 'Mobiles', 'http://kaymu.com/mobiles', NULL, NULL),
(3, 'new category', 'http://domain.com/category10', '2017-07-25 01:46:05', '2017-07-27 01:53:37'),
(4, '', 'http://domain.com/11', '2017-07-25 01:47:03', '2017-07-25 01:47:03'),
(5, '', 'http://domain.com/12', '2017-07-25 01:47:24', '2017-07-25 01:47:24'),
(6, 'test 123', 'http://test.com', '2017-07-27 01:56:01', '2017-07-27 01:57:47'),
(7, '', 'test222', '2017-07-27 01:56:01', '2017-07-27 01:56:01'),
(8, '', 'test333', '2017-07-27 01:56:01', '2017-07-27 01:56:01'),
(9, 'category 1', 'safdsadf', '2017-07-27 02:00:26', '2017-07-27 02:14:23'),
(10, '', 'asdfasdf', '2017-07-27 02:00:26', '2017-07-27 02:00:26'),
(11, 'test', 'safdadsfsadf', '2017-07-27 02:06:13', '2017-07-27 02:06:13'),
(12, '', 'asfasdfasdf', '2017-07-27 02:07:55', '2017-07-27 02:07:55'),
(13, '', 'asfdsafdsadf', '2017-07-27 02:07:55', '2017-07-27 02:07:55'),
(14, '', 'sdafsfdsd', '2017-07-27 02:13:46', '2017-07-27 02:13:46'),
(15, '', '3333', '2017-07-27 02:13:57', '2017-07-27 02:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `category_users`
--

CREATE TABLE `category_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `comp_category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_users`
--

INSERT INTO `category_users` (`id`, `user_id`, `category_id`, `comp_category_id`, `created_at`, `updated_at`) VALUES
(7, 1, 9, 10, '2017-07-27 02:00:26', '2017-07-27 02:00:26'),
(8, 1, 11, 12, '2017-07-27 02:07:55', '2017-07-27 02:07:55'),
(9, 1, 11, 13, '2017-07-27 02:07:55', '2017-07-27 02:07:55'),
(10, 1, 9, 14, '2017-07-27 02:13:46', '2017-07-27 02:13:46'),
(11, 1, 11, 15, '2017-07-27 02:13:57', '2017-07-27 02:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL DEFAULT '',
  `category` varchar(255) DEFAULT '',
  `product_url` varchar(255) NOT NULL DEFAULT '',
  `current_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `original_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `stock_qty` int(11) NOT NULL DEFAULT '0',
  `image_url` varchar(255) NOT NULL DEFAULT '',
  `number_reviews` int(11) NOT NULL DEFAULT '0',
  `rating` decimal(5,2) NOT NULL DEFAULT '0.00',
  `seller` varchar(255) NOT NULL DEFAULT '',
  `brand` varchar(255) DEFAULT '',
  `category_id` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_title`, `category`, `product_url`, `current_price`, `original_price`, `available`, `stock_qty`, `image_url`, `number_reviews`, `rating`, `seller`, `brand`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'product 11', 'a', 'http://domain.com/1', '100.00', '0.00', 0, 0, '', 0, '0.00', '', 'brand1', 1, '2017-08-15 03:31:48', '2017-07-27 01:01:34'),
(2, 'product 2', '''''', 'http://domain.com/2\r\n', '50.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-08-08 04:39:18', '0000-00-00 00:00:00'),
(3, 'product 3', '''''', 'http://domain.com/3', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-22 07:18:04', '0000-00-00 00:00:00'),
(4, 'Product 4', '''''', 'http://domain.com/4', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-22 07:29:22', '0000-00-00 00:00:00'),
(5, 'Samsung Phone', '''''', 'http://domain.com/5', '0.00', '0.00', 1, 0, '', 0, '0.00', '', 'Samsung', 0, '2017-07-24 02:38:24', '2017-07-24 02:38:24'),
(6, 'Samsung Phone', '''''', 'http://domain.com/6', '0.00', '0.00', 1, 0, '', 0, '0.00', '', 'Samsung', 0, '2017-07-24 02:40:21', '2017-07-24 02:40:21'),
(7, 'aaa', '''''', 'http://domain.com/20', '0.00', '0.00', 1, 0, '', 0, '0.00', '', 'ccc', 0, '2017-07-24 02:42:13', '2017-07-24 02:42:13'),
(8, 'aaa', '''''', 'http://domain.com/30', '0.00', '0.00', 1, 0, '', 0, '0.00', '', 'ccc', 0, '2017-07-24 02:52:38', '2017-07-24 02:52:38'),
(9, '', '''''', 'http://domain.com/31', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-24 02:52:38', '2017-07-24 02:52:38'),
(10, '', '''''', 'http://domain.com/32', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-24 02:52:38', '2017-07-24 02:52:38'),
(11, 'bbb ljslajdf laskj flaks jddflj asldfj asjfd ksajfd l kasjdfj safdlkj aslfdj slkja fdkl jsakfld jlska jfklasjflkj asfklj asljkf lskaj flkjsaflkj asfld', '''''', 'http://domain.com/40', '0.00', '0.00', 1, 0, '', 0, '0.00', '', 'brand1', 0, '2017-08-29 14:53:55', '2017-08-29 09:53:55'),
(12, '', '''''', 'http://domain.com/41', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-24 02:57:23', '2017-07-24 02:57:23'),
(13, '', '''''', 'http://domain.com/42', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-24 02:57:23', '2017-07-24 02:57:23'),
(14, '', '''''', 'http://domain.com/21', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-24 02:57:23', '2017-07-24 02:57:23'),
(15, 'iPhone 7', '''''', 'http://domain.com/100', '1180.00', '0.00', 1, 0, '', 0, '0.00', '', 'Apple', 0, '2017-08-29 10:27:41', '2017-07-24 06:02:48'),
(16, '', '''''', 'http://domain.com/101', '1190.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-08-29 10:27:45', '2017-07-24 06:02:48'),
(17, '', '''''', 'http://domain.com/102', '1199.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-08-29 10:27:50', '2017-07-24 06:02:48'),
(18, 'a', 'c', 'd', '0.00', '0.00', 1, 0, '', 0, '0.00', '', 'b', 0, '2017-07-26 23:23:25', '2017-07-26 23:23:25'),
(19, '', '', 'e', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-26 23:23:25', '2017-07-26 23:23:25'),
(20, '', '', 'f', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-26 23:23:25', '2017-07-26 23:23:25'),
(21, '', '', 'g', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-26 23:23:25', '2017-07-26 23:23:25'),
(22, '', '', 'h', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-26 23:23:25', '2017-07-26 23:23:25'),
(23, '', '', 'i', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-26 23:23:25', '2017-07-26 23:23:25'),
(24, 'aa', 'cc', 'dd', '0.00', '0.00', 1, 0, '', 0, '0.00', '', 'bb', 0, '2017-07-26 23:23:25', '2017-07-26 23:23:25'),
(25, '', '', 'ee', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-26 23:23:26', '2017-07-26 23:23:26'),
(26, '', '', 'ff', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-26 23:23:26', '2017-07-26 23:23:26'),
(27, '', '', 'gg', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-26 23:23:26', '2017-07-26 23:23:26'),
(28, 'ccc', 'ccc', 'ddd', '0.00', '0.00', 1, 0, '', 0, '0.00', '', 'bbb', 0, '2017-07-27 06:30:18', '2017-07-27 01:30:18'),
(29, '', '', 'eee', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-26 23:23:26', '2017-07-26 23:23:26'),
(30, '', '', 'fff', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-26 23:23:26', '2017-07-26 23:23:26'),
(31, '', '', 'ggg', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-26 23:23:26', '2017-07-26 23:23:26'),
(32, '', '', 'http://domain.com/999', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-27 01:21:27', '2017-07-27 01:21:27'),
(33, '', '', 'http://domain.com/901', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-27 01:27:36', '2017-07-27 01:27:36'),
(34, '', '', 'http://domain.com/902', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-27 01:30:40', '2017-07-27 01:30:40'),
(35, '', '', 'http://domain.com/910', '0.00', '0.00', 0, 0, '', 0, '0.00', '', '', 0, '2017-08-16 11:22:43', '2017-07-27 01:34:40'),
(36, 'test 111', 'aa', 'cc', '0.00', '0.00', 1, 0, '', 0, '0.00', '', 'bb', 0, '2017-07-27 07:25:04', '2017-07-27 02:25:04'),
(37, '', '', 'bb', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-07-27 02:25:28', '2017-07-27 02:25:28'),
(38, 'asdfadsf', NULL, 'http://domain.com/110', '0.00', '0.00', 0, 0, '', 0, '0.00', '', NULL, 0, '2017-08-16 11:22:54', '2017-08-05 00:01:27'),
(39, '', '', 'http://domain.com/111', '0.00', '0.00', 0, 0, '', 0, '0.00', '', '', 0, '2017-08-16 11:25:44', '2017-08-05 00:01:27'),
(40, '', '', 'http://domain.com/1122', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-08-05 00:24:55', '2017-08-05 00:24:55'),
(41, '', '', 'http://domain.com/1123', '100.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-08-08 04:39:36', '2017-08-05 00:29:03'),
(42, 'Product 12', 'Something', 'http://domain.com/401', '199.00', '0.00', 1, 0, '', 0, '0.00', '', 'Some', 0, '2017-08-26 15:20:59', '2017-08-08 23:40:47'),
(43, '', '', 'http://domain.com/402', '100.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-08-26 15:21:34', '2017-08-08 23:40:47'),
(44, '', '', 'http://domain.com/403', '200.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-08-26 15:21:59', '2017-08-08 23:40:47'),
(45, '', '', 'http://domain.com/404', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-08-08 23:44:13', '2017-08-08 23:44:13'),
(46, 'Test', NULL, 'http://domain.com/1001', '0.00', '0.00', 1, 0, '', 0, '0.00', '', NULL, 0, '2017-08-16 07:00:19', '2017-08-16 07:00:19'),
(47, '', '', 'http://domain.com/1002', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-08-16 07:00:19', '2017-08-16 07:00:19'),
(48, 'lsdjasdlfjk', NULL, 'http://domain.com/1009', '0.00', '0.00', 1, 0, '', 0, '0.00', '', NULL, 0, '2017-08-16 07:00:46', '2017-08-16 07:00:46'),
(49, '', '', 'http://domain.com/1019', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-08-16 07:00:46', '2017-08-16 07:00:46'),
(50, 'product 1 with 2', 'mobile', 'http://daraz.com/iphone7', '0.00', '0.00', 1, 0, '', 0, '0.00', '', 'apple', 0, '2017-08-21 03:18:38', '2017-08-20 22:18:38'),
(51, '', '', 'http://kaymu.com/iphone7', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-08-20 22:17:55', '2017-08-20 22:17:55'),
(52, '', '', 'http://amazon.com/iphone7', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-08-20 22:17:56', '2017-08-20 22:17:56'),
(53, '', '', 'http://domain.com/category4', '0.00', '0.00', 1, 0, '', 0, '0.00', '', '', 0, '2017-08-20 22:42:25', '2017-08-20 22:42:25'),
(54, 'safdsdf', 'sadf', 'http://daraz.com/iphone7-11', '0.00', '0.00', 1, 0, '', 0, '0.00', '', 'dsaf', 0, '2017-08-27 22:41:12', '2017-08-27 22:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `product_histories`
--

CREATE TABLE `product_histories` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `current_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `original_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `stock_qty` int(11) NOT NULL DEFAULT '0',
  `number_reviews` int(11) NOT NULL DEFAULT '0',
  `rating` decimal(5,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_histories`
--

INSERT INTO `product_histories` (`id`, `product_id`, `current_price`, `original_price`, `available`, `stock_qty`, `number_reviews`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, '80.00', '0.00', 0, 0, 0, '0.00', '2017-08-08 04:40:11', '0000-00-00 00:00:00'),
(2, 1, '90.00', '0.00', 0, 0, 0, '0.00', '2017-08-08 04:40:30', '0000-00-00 00:00:00'),
(3, 1, '110.00', '0.00', 0, 0, 0, '0.00', '2017-08-08 13:49:09', '0000-00-00 00:00:00'),
(4, 17, '50.00', '0.00', 0, 0, 0, '0.00', '2017-08-10 06:58:38', '0000-00-00 00:00:00'),
(5, 2, '100.00', '0.00', 0, 0, 0, '0.00', '2017-08-08 14:15:21', '0000-00-00 00:00:00'),
(6, 2, '110.00', '0.00', 0, 0, 0, '0.00', '2017-08-10 05:13:09', '0000-00-00 00:00:00'),
(7, 2, '120.00', '0.00', 0, 0, 0, '0.00', '2017-08-10 05:13:09', '0000-00-00 00:00:00'),
(8, 15, '99.00', '0.00', 0, 0, 0, '0.00', '2017-08-10 06:57:00', '0000-00-00 00:00:00'),
(9, 16, '105.00', '0.00', 0, 0, 0, '0.00', '2017-08-10 06:57:06', '0000-00-00 00:00:00'),
(10, 15, '88.00', '0.00', 0, 0, 0, '0.00', '2017-08-10 07:01:26', '0000-00-00 00:00:00'),
(11, 16, '121.00', '0.00', 0, 0, 0, '0.00', '2017-08-10 07:01:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_users`
--

CREATE TABLE `product_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comp_product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_users`
--

INSERT INTO `product_users` (`id`, `user_id`, `product_id`, `comp_product_id`, `created_at`, `updated_at`) VALUES
(2, 2, 3, 1, '2017-07-22 07:19:31', '0000-00-00 00:00:00'),
(3, 2, 3, 2, '2017-07-22 07:19:44', '0000-00-00 00:00:00'),
(5, 1, 1, 2, '2017-07-22 07:31:12', '0000-00-00 00:00:00'),
(9, 1, 11, 13, '2017-07-24 02:57:23', '2017-07-24 02:57:23'),
(10, 1, 11, 7, '2017-07-24 02:57:23', '2017-07-24 02:57:23'),
(11, 1, 11, 14, '2017-07-24 02:57:23', '2017-07-24 02:57:23'),
(12, 1, 15, 16, '2017-07-24 06:02:48', '2017-07-24 06:02:48'),
(13, 1, 15, 17, '2017-07-24 06:02:48', '2017-07-24 06:02:48'),
(22, 1, 28, 29, '2017-07-26 23:23:26', '2017-07-26 23:23:26'),
(23, 1, 28, 30, '2017-07-26 23:23:26', '2017-07-26 23:23:26'),
(24, 1, 28, 31, '2017-07-26 23:23:26', '2017-07-26 23:23:26'),
(25, 1, 28, 32, '2017-07-27 01:21:27', '2017-07-27 01:21:27'),
(29, 1, 11, 33, '2017-07-27 01:27:36', '2017-07-27 01:27:36'),
(30, 1, 28, 34, '2017-07-27 01:30:40', '2017-07-27 01:30:40'),
(31, 1, 28, 35, '2017-07-27 01:34:40', '2017-07-27 01:34:40'),
(38, 1, 1, 41, '2017-08-05 00:29:03', '2017-08-05 00:29:03'),
(39, 1, 42, 43, '2017-08-08 23:40:47', '2017-08-08 23:40:47'),
(40, 1, 42, 44, '2017-08-08 23:40:47', '2017-08-08 23:40:47'),
(42, 1, 46, 47, '2017-08-16 07:00:19', '2017-08-16 07:00:19'),
(43, 1, 54, 16, '2017-08-27 22:41:12', '2017-08-27 22:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  `email_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `provder_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `website`, `verified`, `email_token`, `remember_token`, `provider`, `provder_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'safs', 'test01@yahoo.com', '$2y$10$K8V/d.caJ3LtsKVSjKvAN.7u0udkw5N32dl3zCCbruQv25Hk5qBKq', '1', 'http://www.aabizsol.com', 1, NULL, 'ccnLSBnhTPxyTzR3RfaNE5TZzWHC8aeHZBSINVczLAjVfBtWL1bmL65bpFw1', '', '', '2017-07-21 00:47:34', '2017-08-14 23:05:32'),
(2, 'ayaz', 'ahmed', 'test02@yahoo.com', '$2y$10$K8V/d.caJ3LtsKVSjKvAN.7u0udkw5N32dl3zCCbruQv25Hk5qBKq', '923001212121', 'http://ayazahmed.com', 0, NULL, NULL, '', '', '2017-07-22 02:05:12', '2017-07-22 02:05:12'),
(3, 'Ayaz', 'Ahmed', 'test19@yahoo.com', '$2y$10$Lgz/Y8xcYluESs0qKzS4B.oUiVYppOrAb3JBey83TCbsAyWEBONn.', 'sadf', 'sadf', 0, NULL, NULL, '', '', '2017-07-31 06:07:08', '2017-07-31 06:07:08'),
(5, 'Ayaz', 'Ahmed', 'test03@yahoo.com', '$2y$10$4XHFDubpvBh9pjt/zeOt4.KCj8VaOHCqePXURBEEy2oKYd2mOwfyC', NULL, 'http://aabizsol.com', 1, 'gXxyt7eCys', 'Vh8oxTe8lbTcCOEzx2wLvZn5x3eE83gbk2xlvxhT8FYEEGds6dkWM1OtnhRA', '', '', '2017-08-20 22:14:56', '2017-08-20 22:14:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_users`
--
ALTER TABLE `category_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`category_id`,`comp_category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_histories`
--
ALTER TABLE `product_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_users`
--
ALTER TABLE `product_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `category_users`
--
ALTER TABLE `category_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `product_histories`
--
ALTER TABLE `product_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `product_users`
--
ALTER TABLE `product_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
