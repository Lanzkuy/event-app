-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2023 at 05:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(3, 'Concert'),
(4, 'Festival'),
(5, 'Game'),
(6, 'Fashion'),
(7, 'Sport'),
(8, 'Education'),
(9, 'Culture');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `status` varchar(25) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `user_id`, `category_id`, `title`, `description`, `image`, `location`, `start_datetime`, `end_datetime`, `status`, `created_at`, `deleted_at`) VALUES
(9, 26, 7, 'Fun Game with TIMTEM', 'Main bola bareng dan seru seruan bareng', '1673866340x1.jpg', 'Rawamangun, Jakarta Timur', '2023-01-21 14:00:00', '2023-01-21 16:00:00', NULL, '2023-01-16 04:52:20', NULL),
(10, 26, 3, 'Akar2023', 'Konser dengan berisikan artis Tulus, Raisa, dan masih banyak lagi', '1673866539x2.jpg', 'Depok Timur', '2023-05-20 18:00:00', '2023-05-21 00:00:00', NULL, '2023-01-16 04:55:39', NULL),
(11, 26, 5, 'ML REGION CHAMPIONSHIP', 'Tonton turnamen Mobile Legend tingkat DKI Jakarta', '1673866891x3.jpg', 'Istora Senayan, Jakarta Pusat', '2023-02-17 00:00:00', '2023-02-20 00:00:00', NULL, '2023-01-16 05:01:31', NULL),
(12, 26, 5, 'PUBG Mobile NATIONAL CHAMPIONSHIP', 'Tonton turnamen PUBG Mobile tingkat Nasional', '1673867094x4.jpg', 'Istora Senayan, Jakarta Pusat', '2023-06-16 00:00:00', '2023-06-19 00:00:00', NULL, '2023-01-16 05:04:54', NULL),
(13, 30, 8, 'Lomba Cerdas Cermat Kota Depok', 'Tonton lomba Cerdas Cermat SMA tingkat Kota Depok', '1673867615x5.jpg', 'SMA Negeri 2 Depok', '2023-03-01 08:00:00', '2023-01-05 12:12:00', NULL, '2023-01-16 05:13:35', NULL),
(14, 23, 6, 'Jakarta Fashion Week', 'Jakarta Fashion Week atau JFW adalah sebuah pameran mode yang digelar setahun sekali di Jakarta, Indonesia. JFW disebut sebagai pameran mode terbesar di Asia Tenggara.', '1673872249jfw.jpg', 'Pondok Indah Mall', '2023-12-14 17:30:00', '2023-12-16 20:30:00', NULL, '2023-01-16 06:30:49', NULL),
(15, 24, 9, 'Tujuh Belas an', 'merayakan kemerdekaan indonesia. Dengan Upacara Bendera, Bazaar dan Perlombaan yang meriah', '167387320817an.jpg', 'Violet Garden', '2023-08-17 08:00:00', '2023-08-20 17:30:00', NULL, '2023-01-16 06:46:48', NULL),
(16, 25, 4, 'Ani-fest', 'Anime Festival. Ada Pameran Manga, Figure, Cosplay dll.', '1673875235anifest.jpg', 'Mall Of Indonesia', '2023-11-07 10:00:00', '2023-11-09 16:20:00', NULL, '2023-01-16 07:20:35', NULL),
(17, 27, 3, 'Born Pink World Tour', 'BlackPink Concert. Membawakan lagu lagu dari Album terbaruuu!', '1673875680born pink.jpg', 'Stadion Gelora Bung Karno', '2023-10-22 19:30:00', '2023-10-24 22:30:00', NULL, '2023-01-16 07:28:00', NULL),
(18, 28, 7, 'AFF world Cup', 'Piala Dunia U-20 yang diselenggarakan di INDONESIA!!!', '1673876158aff.jpg', 'Jakarta International Stadium', '2023-09-20 15:35:00', '2023-09-30 22:30:00', NULL, '2023-01-16 07:35:58', '2023-01-16 09:20:52'),
(19, 28, 7, 'AFF world Cup', 'Piala Dunia U-20 yang diselenggarakan di INDONESIA!!!', '1673876158aff.jpg', 'Jakarta International Stadium', '2023-09-20 15:35:00', '2023-09-30 22:30:00', NULL, '2023-01-16 07:35:58', '2023-01-16 09:20:52'),
(20, 28, 7, 'AFF world Cup', 'Piala Dunia U-20 yang diselenggarakan di INDONESIA!!!', '1673876158aff.jpg', 'Jakarta International Stadium', '2023-09-20 15:35:00', '2023-09-30 22:30:00', NULL, '2023-01-16 07:35:58', '2023-01-16 09:20:52'),
(21, 28, 7, 'AFF world Cup', 'Piala Dunia U-20 yang diselenggarakan di INDONESIA!!!', '1673876158aff.jpg', 'Jakarta International Stadium', '2023-09-20 15:35:00', '2023-09-30 22:30:00', NULL, '2023-01-16 07:35:58', '2023-01-16 09:20:52'),
(22, 28, 7, 'AFF world Cup', 'Piala Dunia U-20 yang diselenggarakan di INDONESIA!!!', '1673876158aff.jpg', 'Jakarta International Stadium', '2023-09-20 15:35:00', '2023-09-30 22:30:00', NULL, '2023-01-16 07:35:58', '2023-01-16 09:20:52'),
(23, 28, 7, 'AFF world Cup', 'Piala Dunia U-20 yang diselenggarakan di INDONESIA!!!', '1673876158aff.jpg', 'Jakarta International Stadium', '2023-09-20 15:35:00', '2023-09-30 22:30:00', NULL, '2023-01-16 07:35:58', '2023-01-16 09:20:51'),
(24, 28, 7, 'AFF world Cup', 'Piala Dunia U-20 yang diselenggarakan di INDONESIA!!!', '1673876158aff.jpg', 'Jakarta International Stadium', '2023-09-20 15:35:00', '2023-09-30 22:30:00', NULL, '2023-01-16 07:35:58', '2023-01-16 09:20:51'),
(25, 28, 7, 'AFF world Cup', 'Piala Dunia U-20 yang diselenggarakan di INDONESIA!!!', '1673876158aff.jpg', 'Jakarta International Stadium', '2023-09-20 15:35:00', '2023-09-30 22:30:00', NULL, '2023-01-16 07:35:58', '2023-01-16 10:03:04'),
(26, 33, 6, 'Test1', 'test', '1673884077php.png', 'Test', '2023-01-17 22:47:00', '2023-01-20 22:47:00', NULL, '2023-01-16 09:47:57', '2023-01-16 09:48:12'),
(27, 36, 3, 'Konser Lagu', 'Konser Accoustic', '1673884517php.png', 'Jakarta', '2023-01-16 22:54:00', '2023-01-19 22:54:00', NULL, '2023-01-16 09:55:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `total_qty` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `order_date`, `total_qty`, `total_price`, `status`, `created_at`, `deleted_at`) VALUES
(2, 31, '2023-01-16 00:00:00', 7, '550000.00', 2, '2023-01-16 05:06:06', NULL),
(3, 32, '2023-01-16 00:00:00', 15, '1005000.00', 0, '2023-01-16 07:38:23', NULL),
(4, 31, '2023-01-16 00:00:00', 6, '4900000.00', 0, '2023-01-16 07:43:06', NULL),
(5, 30, '2023-01-16 00:00:00', 3, '2000000.00', 0, '2023-01-16 07:44:02', NULL),
(6, 29, '2023-01-16 00:00:00', 10, '650000.00', 0, '2023-01-16 07:44:55', NULL),
(7, 28, '2023-01-16 00:00:00', 2, '30000.00', 0, '2023-01-16 07:46:42', NULL),
(8, 30, '2023-02-03 21:01:23', 1, '30000.00', 0, '2023-01-16 14:02:29', NULL),
(9, 30, '2023-03-04 21:01:23', 2, '60000.00', 0, '2023-01-16 14:02:29', NULL),
(10, 29, '2023-03-14 21:02:48', 3, '450000.00', 0, '2023-01-16 14:04:12', NULL),
(11, 29, '2023-04-15 21:02:48', 1, '150000.00', 0, '2023-01-16 14:04:12', NULL),
(12, 28, '2023-04-16 21:04:31', 5, '8300000.00', 2, '2023-01-16 14:06:01', NULL),
(13, 28, '2023-05-17 21:04:31', 6, '3740000.00', 2, '2023-01-16 14:06:01', NULL),
(14, 27, '2023-02-22 21:06:18', 1, '75000.00', 0, '2023-01-16 14:08:39', NULL),
(15, 26, '2023-02-21 21:06:18', 1, '75000.00', 0, '2023-01-16 14:08:39', NULL),
(16, 25, '2023-02-06 21:06:18', 2, '150000.00', 0, '2023-01-16 14:08:39', NULL),
(17, 24, '2023-02-09 21:06:18', 1, '50000.00', 0, '2023-01-16 14:08:39', NULL),
(18, 23, '2023-02-28 21:06:18', 2, '10000.00', 0, '2023-01-16 14:08:39', NULL),
(19, 31, '2023-02-04 00:00:00', 7, '550000.00', 2, '2023-01-16 05:06:06', NULL),
(20, 32, '2023-02-01 00:00:00', 15, '1005000.00', 0, '2023-01-16 07:38:23', NULL),
(21, 31, '2023-01-02 00:00:00', 6, '4900000.00', 0, '2023-01-16 07:43:06', NULL),
(22, 30, '2023-02-08 00:00:00', 3, '2000000.00', 0, '2023-01-16 07:44:02', NULL),
(23, 29, '2023-02-15 00:00:00', 10, '650000.00', 0, '2023-01-16 07:44:55', NULL),
(24, 28, '2023-02-12 00:00:00', 2, '30000.00', 0, '2023-01-16 07:46:42', NULL),
(25, 30, '2023-02-23 21:01:23', 1, '30000.00', 0, '2023-01-16 14:02:29', NULL),
(26, 30, '2023-02-08 21:01:23', 2, '60000.00', 0, '2023-01-16 14:02:29', NULL),
(27, 30, '2023-02-22 21:01:23', 2, '60000.00', 0, '2023-01-16 14:02:29', NULL),
(28, 29, '2023-02-10 21:02:48', 3, '450000.00', 0, '2023-01-16 14:04:12', NULL),
(29, 29, '2023-03-11 21:02:48', 1, '150000.00', 0, '2023-01-16 14:04:12', NULL),
(30, 28, '2023-03-12 21:04:31', 2, '2400000.00', 0, '2023-01-16 14:06:01', NULL),
(31, 28, '2023-03-13 21:04:31', 1, '3500000.00', 0, '2023-01-16 14:06:01', NULL),
(32, 27, '2023-03-14 21:06:18', 1, '75000.00', 0, '2023-01-16 14:08:39', NULL),
(33, 26, '2023-03-15 21:06:18', 1, '75000.00', 0, '2023-01-16 14:08:39', NULL),
(34, 25, '2023-03-16 21:06:18', 2, '150000.00', 0, '2023-01-16 14:08:39', NULL),
(35, 24, '2023-03-17 21:06:18', 1, '50000.00', 0, '2023-01-16 14:08:39', NULL),
(36, 23, '2023-03-18 21:06:18', 2, '10000.00', 0, '2023-01-16 14:08:39', NULL),
(37, 31, '2023-03-19 00:00:00', 7, '550000.00', 2, '2023-01-16 05:06:06', NULL),
(38, 32, '2023-03-20 00:00:00', 15, '1005000.00', 0, '2023-01-16 07:38:23', NULL),
(39, 31, '2023-02-21 00:00:00', 6, '4900000.00', 0, '2023-01-16 07:43:06', NULL),
(40, 30, '2023-03-22 00:00:00', 3, '2000000.00', 0, '2023-01-16 07:44:02', NULL),
(41, 30, '2023-03-25 21:01:23', 1, '30000.00', 0, '2023-01-16 14:02:29', NULL),
(42, 30, '2023-04-26 21:01:23', 2, '60000.00', 0, '2023-01-16 14:02:29', NULL),
(43, 30, '2023-03-27 21:01:23', 2, '60000.00', 0, '2023-01-16 14:02:29', NULL),
(44, 29, '2023-03-28 21:02:48', 3, '450000.00', 0, '2023-01-16 14:04:12', NULL),
(45, 29, '2023-02-19 21:02:48', 1, '150000.00', 0, '2023-01-16 14:04:12', NULL),
(46, 29, '2023-03-06 00:00:00', 10, '650000.00', 0, '2023-01-16 07:44:55', NULL),
(47, 28, '2023-03-07 00:00:00', 2, '30000.00', 0, '2023-01-16 07:46:42', NULL),
(48, 30, '2023-03-08 21:01:23', 1, '30000.00', 0, '2023-01-16 14:02:29', NULL),
(49, 30, '2023-03-09 21:01:23', 2, '60000.00', 0, '2023-01-16 14:02:29', NULL),
(50, 29, '2023-04-10 21:02:48', 3, '450000.00', 0, '2023-01-16 14:04:12', NULL),
(51, 31, '2023-04-01 00:00:00', 7, '550000.00', 2, '2023-01-16 05:06:06', NULL),
(52, 36, '2023-01-16 00:00:00', 2, '2400000.00', 2, '2023-01-16 09:55:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `ticket_id`, `qty`, `total_price`) VALUES
(3, 2, 14, 3, '150000.00'),
(4, 2, 15, 4, '400000.00'),
(5, 3, 28, 4, '300000.00'),
(6, 3, 29, 2, '300000.00'),
(7, 3, 24, 6, '180000.00'),
(8, 3, 24, 6, '180000.00'),
(9, 3, 25, 3, '225000.00'),
(10, 3, 25, 3, '225000.00'),
(11, 3, 25, 3, '225000.00'),
(12, 3, 25, 3, '225000.00'),
(13, 4, 26, 1, '1200000.00'),
(14, 4, 27, 1, '3500000.00'),
(15, 5, 20, 2, '1000000.00'),
(16, 5, 21, 1, '1000000.00'),
(17, 6, 22, 7, '350000.00'),
(18, 6, 23, 3, '300000.00'),
(19, 7, 18, 1, '10000.00'),
(20, 7, 19, 1, '20000.00'),
(21, 4, 22, 4, '200000.00'),
(22, 4, 22, 4, '200000.00'),
(23, 12, 27, 1, '3500000.00'),
(24, 12, 26, 2, '2400000.00'),
(25, 13, 24, 3, '90000.00'),
(26, 13, 25, 2, '150000.00'),
(27, 13, 25, 1, '75000.00'),
(28, 52, 26, 2, '2400000.00');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `type` enum('Reguler','VIP') NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `event_id`, `price`, `stock`, `type`, `description`, `created_at`, `deleted_at`) VALUES
(10, 9, '75000.00', 20, 'Reguler', 'Main aja', '2023-01-16 10:52:20', NULL),
(11, 9, '100000.00', 20, 'VIP', 'Main + dapet foto', '2023-01-16 10:52:20', NULL),
(12, 10, '175000.00', 300, 'Reguler', 'Baris belakang', '2023-01-16 10:55:39', NULL),
(13, 10, '250000.00', 150, 'VIP', 'Baris depan', '2023-01-16 10:55:39', NULL),
(14, 11, '50000.00', 297, 'Reguler', 'Baris belakang', '2023-01-16 11:01:31', NULL),
(15, 11, '100000.00', 196, 'VIP', 'Baris depan', '2023-01-16 11:01:31', NULL),
(16, 12, '50000.00', 300, 'Reguler', 'Baris belakang', '2023-01-16 11:04:54', NULL),
(17, 12, '100000.00', 200, 'VIP', 'Baris depan', '2023-01-16 11:04:54', NULL),
(18, 13, '10000.00', 29, 'Reguler', 'Baris belakang', '2023-01-16 11:13:35', NULL),
(19, 13, '20000.00', 29, 'VIP', 'Baris depan + Snack', '2023-01-16 11:13:35', NULL),
(20, 14, '500000.00', 98, 'Reguler', 'Bangku Belakang', '2023-01-16 12:30:49', NULL),
(21, 14, '1000000.00', 49, 'VIP', 'Bangku Depan', '2023-01-16 12:30:49', NULL),
(22, 15, '50000.00', 39, 'Reguler', 'hanya 5 lomba', '2023-01-16 12:46:48', NULL),
(23, 15, '100000.00', 27, 'VIP', 'semua lomba + snack', '2023-01-16 12:46:48', NULL),
(24, 16, '30000.00', 141, 'Reguler', 'ticket only', '2023-01-16 13:20:35', NULL),
(25, 16, '75000.00', 70, 'VIP', 'include snack + merchandise', '2023-01-16 13:20:35', NULL),
(26, 17, '1200000.00', 995, 'Reguler', 'Bangku Belakang', '2023-01-16 13:28:00', NULL),
(27, 17, '3500000.00', 498, 'VIP', 'Bangku Depan', '2023-01-16 13:28:00', NULL),
(28, 18, '75000.00', 696, 'Reguler', 'Bangku Belakang', '2023-01-16 13:35:58', '2023-01-15 21:01:52'),
(29, 18, '150000.00', 298, 'VIP', 'Bangku Depan', '2023-01-16 13:35:58', '2023-01-15 21:01:52'),
(30, 14, '20000.00', 100, 'Reguler', 'Test Reguler 2', '2023-01-16 15:48:51', NULL),
(31, 27, '1000000.00', 100, 'Reguler', 'Konser Reguler', '2023-01-16 15:55:17', NULL),
(32, 27, '2000000.00', 50, 'VIP', 'Konser Reguler', '2023-01-16 15:55:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`, `role`, `created_at`, `deleted_at`) VALUES
(23, 'alice@gmail.com', '$2y$10$QQjJBJl5lDa/91jxOyuhMuxyoeP6XGoSXFkRo0LvDCPglbJwy6Z7m', 'Alice', 'user', '2023-01-16 10:37:57', NULL),
(24, 'bryan@gmail.com', '$2y$10$5wvOBNBl94Mmc/bI/uyHauHhyS16k.bOXh2itesAyrIb3HiZEGWZe', 'Bryan', 'user', '2023-01-16 10:38:26', NULL),
(25, 'chad@gmail.com', '$2y$10$RxU5mf1Ym41J7.Af89Ok3OC3WO3.bm/VZHKhloQRnbVAsitt59Odq', 'Chad', 'user', '2023-01-16 10:38:55', NULL),
(26, 'dave@gmail.com', '$2y$10$.cCmRKFKybJCaOv0psJJzeM1LXB39OxvbrGeDqoiPMF5X604ZXmW2', 'Dave', 'user', '2023-01-16 10:39:23', NULL),
(27, 'evan@gmail.com', '$2y$10$pU33KuV0MhuZGxdUonTbzekWQiNHFbJJFigwP3X1SFnT06HgseAmO', 'Evan', 'user', '2023-01-16 10:39:44', NULL),
(28, 'fabrizio@gmail.com', '$2y$10$IfvWwUsL5uhcbA2C6bX3LOo/L9wphatuEhz5IIDJfIW5WMR9F9BKK', 'Fabrizio', 'user', '2023-01-16 10:42:11', NULL),
(29, 'gerrad@gmail.com', '$2y$10$DzCpOZChGwL49MKul5HGeeTnBvaOtx/mYlWGO2EkHR.CXy05f6BHq', 'Gerrad', 'user', '2023-01-16 10:42:30', NULL),
(30, 'hugo@gmail.com', '$2y$10$F2bda4VNgy1sKLro18wuJeCEoCFYYd2HobueVQPHaz8J0Z387wTaS', 'Hugo', 'user', '2023-01-16 10:42:48', NULL),
(31, 'ivan@gmail.com', '$2y$10$nAIqrZpu.awtRsc16Cqgsub.kByc8r6XeMP/1o4kXQvv0q1buJGdK', 'Ivan', 'user', '2023-01-16 10:43:40', NULL),
(32, 'jack@gmail.com', '$2y$10$wWpxG0mCkYetvKy4hjNoyOm6e8oQ.7Aapm8LqlqLo/Mg5FfpPIArm', 'Jack', 'user', '2023-01-16 10:44:13', NULL),
(33, 'admin@gmail.com', '$2y$10$pFiY0wOnxzH2M7Ko6AzAc.jgklCedrx8YSA2W82WWvOYIMW3BgIhq', 'adminn', 'admin', '2023-01-16 14:39:37', NULL),
(34, 'user1@gmail.com', '$2y$10$BOkQfnGabVVaOODH6/wTu.F6AqeNSQTp0DQvKF9eh26CssL1KmxSa', 'User1', 'user', '2023-01-16 14:39:57', NULL),
(35, 'test23@gmail.com', '$2y$10$oYrSkOTL.QFTStNF8xYREefR9ZI4/BBQb1GdkCZqxpAYA4jmKW402', 'test', 'user', '2023-01-16 15:31:21', '2023-01-15 21:01:36'),
(36, 'user2@gmail.com', '$2y$10$ZLExPQ5z4piF/2RjTK31T.f0q0EH/pvKN/XMtdqAF9XTsS4PxlNJe', 'User2', 'user', '2023-01-16 15:43:39', NULL),
(37, 'test234@gmail.com', '$2y$10$Tg.DETMVlOYwvvmr3CSMiOSkodbwASiKh1AM9oG4DB8cDq0xsxB4.', 'test234t', 'user', '2023-01-16 15:46:22', '2023-01-15 21:01:07'),
(38, 'tesaa@gmail.com', '$2y$10$gcSvEuwBarMCkAyIgHYeVucvU4o1UpZmWcwqXR2gSXSJUGn7NKymq', 'tesaa', 'user', '2023-01-16 16:06:09', NULL),
(39, 'tesss@gmail.com', '$2y$10$Er3e4tnIxR7YBCa3wlaKF.kwhj08dnNB4NPOPilq85KsUfnDcAfiu', 'tesss', 'user', '2023-01-16 16:10:21', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_category` (`category_id`),
  ADD KEY `event_user` (`user_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderdetail_ticket` (`ticket_id`),
  ADD KEY `orderdetail_order` (`order_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_event` (`event_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `event_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `orderdetail_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
