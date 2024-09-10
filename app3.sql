-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 05:25 AM
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
-- Database: `app3`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `code_cart` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `total` int(11) NOT NULL,
  `pay_method` int(50) NOT NULL COMMENT '1:Tiền mặt;2:Chuyển khoản;3:VNPAY',
  `pay_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Chưa thanh toán;\r\n1: Đã thanh toán',
  `cart_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Chưa xử lý;\r\n1: Đã xác nhận; \r\n2: Đang giao hàng\r\n3: Hoàn tất',
  `cart_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `code_cart`, `user_id`, `fullname`, `address`, `email`, `telephone`, `total`, `pay_method`, `pay_status`, `cart_status`, `cart_date`) VALUES
(29, 'BeeTech878', 93, 'Huỳnh Ngọc Đức', '756 Trần Phú', 'sneakynetgametop@gmail.com', '0794651158', 53025000, 1, 1, 1, '2024-03-26 14:42:42'),
(30, 'BeeTech714', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 53025000, 1, 1, 3, '2024-03-29 15:42:43'),
(32, 'BeeTech931', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 15800000, 1, 1, 3, '2024-03-31 07:54:11'),
(33, 'BeeTech186', 106, 'Vũ Huy Hoàng', '756 Trần Phú', 'vuhuyhoangbz@gmail.com', '0794651158', 15800000, 3, 0, 0, '2024-03-31 08:13:06'),
(34, 'BeeTech55', 107, 'ádsadsadas', '756/7 Trần Phú', 'sneakynetgameto2p@gmail.com', '0794651159', 31500000, 3, 1, 2, '2024-03-31 08:16:46'),
(35, 'BeeTech560', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 36750000, 3, 0, 0, '2024-03-31 08:17:21'),
(36, 'BeeTech837', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 15800000, 3, 0, 0, '2024-03-31 08:18:07'),
(37, 'BeeTech631', 108, 'ádsadsadas', '756/7 Trần Phú', 'hoangtomato.2@gmail.com', '0794651158', 15800000, 3, 0, 3, '2024-03-31 08:19:15'),
(38, 'BeeTech940', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 15800000, 3, 1, 3, '2024-03-31 08:20:53'),
(39, 'BeeTech355', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 15800000, 3, 0, 0, '2024-03-31 08:30:17'),
(40, 'BeeTech593', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 15800000, 3, 0, 0, '2024-03-31 08:31:24'),
(41, 'BeeTech928', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 36750000, 3, 0, 0, '2024-03-31 08:32:01'),
(42, 'BeeTech740', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 21000000, 3, 0, 0, '2024-03-31 08:34:18'),
(43, 'BeeTech315', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 15800000, 1, 0, 0, '2024-03-31 08:48:30'),
(45, 'BeeTech464', 109, 'Testing', '756 Trần Phú', 'Testing@gmail.com', '0794651159', 15800000, 1, 0, 0, '2024-03-31 15:48:31'),
(46, 'BeeTech586', 110, 'Testing2', '756 Trần Phú', 'Testing2@gmail.com', '0794651159', 32025000, 3, 1, 2, '2024-03-31 15:49:18'),
(47, 'BeeTech844', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 103950000, 1, 0, 0, '2024-04-01 08:15:49'),
(48, 'BeeTech611', 112, '', '866/34 30 tháng 4', 'minhduy8888@gmail.com', '0794651159', 65100000, 3, 0, 3, '2024-04-02 09:01:45'),
(49, 'BeeTech830', 112, 'Duy Nguyen', '866/34 30 tháng 4', 'minhduy8888@gmail.com', '0342458491', 95575000, 1, 0, 0, '2024-04-02 09:20:42'),
(51, 'BeeTech393', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 99750000, 1, 1, 3, '2024-04-06 01:42:52'),
(52, 'BeeTech723', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 173775000, 1, 1, 3, '2024-04-06 01:57:40'),
(53, 'BeeTech920', 115, 'Vũ Huy Hoàng', '756 Trần Phú', 'giahaokhung12321113@gmail.com', '0794651158', 16325000, 1, 0, 0, '2024-04-07 05:10:09'),
(54, 'BeeTech357', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 15800000, 1, 0, 0, '2024-04-07 05:11:33'),
(55, 'BeeTech910', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 21000000, 3, 0, 0, '2024-04-07 05:11:47'),
(57, 'BeeTech663', 126, 'Nguyễn Hoàng Hữu Phước', 'vungtau', 'tinhyeulainhcuu2@gmail.com', '0339424437', 86625000, 1, 0, 0, '2024-04-07 06:17:59'),
(58, 'BeeTech150', 138, 'Hồ Hoàng Lâm', 'phước tỉnh', 'lamhoang29504@gmail.com', '0332834717', 209997900, 1, 0, 0, '2024-04-07 06:22:11'),
(68, 'BeeTech599', 148, 'tuanh', 'qwertyuio', 'lethituanh8839@gmail.com', '0987654321', 15800000, 1, 0, 0, '2024-04-07 06:25:50'),
(70, 'BeeTech796', 151, 'thanh tuan', '47 trần bình trọnng', 'trumzoom@gmail.com', '0342458491', 21000000, 1, 0, 0, '2024-04-10 17:02:58'),
(71, 'BeeTech346', 1, '', '756 Trần Phú', 'adminvhh@gmail.com', '0794651158', 15800000, 1, 1, 3, '2024-04-12 06:14:57'),
(72, 'BeeTech890', 156, '', '47 trần bình trọnng', '123@gmail.com', '0342458491', 8028950, 2, 1, 3, '2024-04-20 09:25:14'),
(73, 'BeeTech941', 156, '', '47 trần bình trọnng', '123@gmail.com', '0342458491', 32550000, 3, 1, 3, '2024-04-20 09:25:52'),
(74, 'BeeTech324', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 38640000, 1, 1, 3, '2024-04-21 06:54:02'),
(75, 'BeeTech867', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 31500000, 1, 1, 3, '2024-04-21 06:55:25'),
(76, 'BeeTech276', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 9489500, 1, 1, 3, '2024-04-21 06:55:49'),
(77, 'BeeTech555', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 21722400, 1, 1, 3, '2024-04-21 07:05:18'),
(78, 'BeeTech681', 1, '', '756 Trần Phú', 'adminvhh@gmail.com', '0794651158', 1308950, 1, 1, 3, '2024-04-21 07:10:19'),
(79, 'BeeTech111', 1, '', '756/7 Trần Phú', 'adminvhh@gmail.com', '0342458491', 5300000, 1, 1, 3, '2024-04-21 07:14:22'),
(80, 'BeeTech696', 157, 'Nguyễn Thuý Ngân', '756 Trần Phú', 'nthuyngan0729@gmail.com', '0794651159', 995000, 1, 1, 3, '2024-04-21 07:22:00'),
(81, 'BeeTech81', 158, 'thanhtuan', '0123456789', 'thanhtuan@gmail.com', '0123456789', 995000, 1, 0, 0, '2024-04-24 03:22:44'),
(82, 'BeeTech4', 159, '', '0123456789', 'thanhtuan123@gmail.com', '0123456789', 995000, 3, 0, 0, '2024-04-24 03:55:25'),
(84, 'BeeTech473', 159, '', '0123456789', 'thanhtuan123@gmail.com', '0123456789', 995000, 1, 0, 0, '2024-04-24 03:56:20'),
(85, 'BeeTech198', 161, 'm', 'mm', 'nguyenmai10481@gmail.com', '09863333', 5300000, 1, 0, 0, '2024-04-26 00:46:09'),
(86, 'BeeTech720', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 31500000, 1, 0, 0, '2024-04-30 02:36:01'),
(87, 'BeeTech638', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 9489500, 1, 0, 0, '2024-04-30 02:36:14'),
(89, 'BeeTech669', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 332450, 1, 0, 0, '2024-05-03 14:41:57'),
(90, 'BeeTech780', 1, '', '756 Trần Phú', 'adminvhh@gmail.com', '0794651158', 31782450, 1, 1, 0, '2024-05-07 17:04:22'),
(91, 'BeeTech385', 162, 'Vũ Huy Hoàng', '756 Trần Phú', 'sneakynetga1metop@gmail.com', '0794651158', 9489500, 1, 1, 3, '2024-05-21 09:11:04'),
(92, 'BeeTech117', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 9288950, 1, 0, 0, '2024-05-21 09:18:55'),
(93, 'BeeTech33', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 9489500, 1, 0, 0, '2024-05-22 00:53:29'),
(94, 'BeeTech250', 154, 'asdasd1112222', '756 Trần Phú', 'v12321312@gmail.com', '0794651158', 69258000, 1, 0, 0, '2024-05-22 03:45:05'),
(95, 'BeeTech691', 154, 'asdasd1112222', '756 Trần Phú', 'v12321312@gmail.com', '0794651158', 31500000, 1, 0, 0, '2024-05-22 03:47:19'),
(96, 'BeeTech626', 154, 'asdasd1112222', '756 Trần Phú', 'v12321312@gmail.com', '0794651158', 50178450, 1, 0, 0, '2024-05-22 03:48:06'),
(97, 'BeeTech539', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 9489500, 1, 1, 3, '2024-05-22 04:42:50'),
(98, 'BeeTech554', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 31500000, 3, 0, 0, '2024-05-23 08:17:41'),
(99, 'BeeTech713', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 9288950, 3, 0, 0, '2024-05-23 09:22:37'),
(100, 'BeeTech280', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 9288950, 3, 0, 0, '2024-05-23 09:27:48'),
(101, 'BeeTech532', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 18527900, 3, 0, 0, '2024-05-23 09:28:54'),
(102, 'BeeTech839', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 31500000, 3, 0, 0, '2024-05-23 09:29:27'),
(103, 'BeeTech247', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 9288950, 3, 0, 0, '2024-05-23 09:29:48'),
(104, 'BeeTech651', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 31500000, 3, 0, 0, '2024-05-23 09:32:39'),
(105, 'BeeTech620', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 9489500, 3, 0, 0, '2024-05-23 13:04:51'),
(106, 'BeeTech761', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 9489500, 3, 0, 0, '2024-05-23 13:06:00'),
(107, 'BeeTech271', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 9288950, 3, 0, 0, '2024-05-23 13:06:49'),
(108, 'BeeTech402', 2, 'Vũ Huy Hoàng', '759 Trần Phú', 'usertest@gmail.com', '0794651157', 9288950, 3, 0, 0, '2024-05-23 13:11:39'),
(109, 'BeeTech139', 178, 'ádsadsadas', '700 Trần Phú', 'nthuyngan079@gmail.com', '0794651159', 44100000, 1, 0, 0, '2024-08-01 07:38:53'),
(110, 'BeeTech863', 179, 'ádsdas', '756 Trần Phú', 'zxczxczcz@gmail.ca', '0794651158', 273779, 1, 0, 0, '2024-08-07 08:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `detail_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`detail_id`, `cart_id`, `product_id`, `name`, `quantity`, `price`) VALUES
(27, 30, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(28, 30, 28, 'BEE-TECH Gaming i5-12400F', 1, 15500000),
(29, 30, 30, 'BEE-TECH Gaming i7-12700K', 1, 20000000),
(30, 32, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(31, 33, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(32, 34, 29, 'BEE-TECH Gaming i3-12100F', 2, 30000000),
(33, 35, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(34, 35, 30, 'BEE-TECH Gaming i7-12700K', 1, 20000000),
(35, 36, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(36, 37, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(37, 38, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(38, 39, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(39, 40, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(40, 41, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(41, 41, 30, 'BEE-TECH Gaming i7-12700K', 1, 20000000),
(42, 42, 30, 'BEE-TECH Gaming i7-12700K', 1, 20000000),
(43, 43, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(44, 45, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(45, 46, 28, 'BEE-TECH Gaming i5-12400F', 1, 15500000),
(46, 46, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(47, 47, 28, 'BEE-TECH Gaming i5-12400F', 1, 15500000),
(48, 47, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(49, 47, 30, 'BEE-TECH Gaming i7-12700K', 1, 20000000),
(50, 47, 31, 'BEE-TECH Gaming i5-10400F', 1, 12500000),
(51, 47, 32, 'BEE-TECH Gaming i3-9100F', 3, 36000000),
(52, 48, 28, 'BEE-TECH Gaming i5-12400F', 4, 62000000),
(53, 49, 29, 'BEE-TECH Gaming i3-12100F', 3, 45000000),
(54, 49, 28, 'BEE-TECH Gaming i5-12400F', 3, 46500000),
(56, 51, 30, 'BEE-TECH Gaming i7-12700K', 1, 20000000),
(57, 51, 29, 'BEE-TECH Gaming i3-12100F', 5, 75000000),
(58, 52, 28, 'BEE-TECH Gaming i5-12400F', 1, 15500000),
(59, 52, 29, 'BEE-TECH Gaming i3-12100F', 6, 90000000),
(60, 52, 30, 'BEE-TECH Gaming i7-12700K', 3, 60000000),
(61, 53, 28, 'BEE-TECH Gaming i5-12400F', 1, 15500000),
(62, 54, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(63, 55, 30, 'BEE-TECH Gaming i7-12700K', 1, 20000000),
(65, 57, 30, 'BEE-TECH Gaming i7-12700K', 1, 20000000),
(66, 57, 32, 'BEE-TECH Gaming i3-9100F', 2, 24000000),
(67, 57, 28, 'BEE-TECH Gaming i5-12400F', 1, 15500000),
(68, 57, 35, 'BEE-TECH Gaming i7-13700K', 1, 23000000),
(69, 58, 41, 'Dell AlienWare X16', 2, 199998000),
(71, 68, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(73, 70, 30, 'BEE-TECH Gaming i7-12700K', 1, 20000000),
(74, 71, 29, 'BEE-TECH Gaming i3-12100F', 1, 15000000),
(75, 72, 223, 'Bee-Tech Đồ họa', 1, 7599000),
(76, 73, 28, 'BEE-TECH Gaming i5-12400F', 2, 31000000),
(77, 74, 230, 'Rx6700 XT', 1, 5000000),
(78, 74, 229, 'BEE-TECH Gaming i9-11900k', 1, 30000000),
(79, 74, 228, 'Combo Logitech', 2, 1800000),
(80, 75, 229, 'BEE-TECH Gaming i9-11900k', 1, 30000000),
(81, 76, 225, 'Bee-Tech Đồ họa', 1, 8990000),
(82, 77, 224, 'Bee-Tech Đồ họa', 2, 17598000),
(83, 77, 222, 'Router ASUS', 1, 3090000),
(84, 78, 166, 'RAM Kingston', 1, 1199000),
(85, 79, 230, 'Rx6700 XT', 1, 5000000),
(86, 80, 228, 'Combo Logitech', 1, 900000),
(87, 81, 228, 'Combo Logitech', 1, 900000),
(88, 82, 228, 'Combo Logitech', 1, 900000),
(89, 84, 228, 'Combo Logitech', 1, 900000),
(90, 85, 230, 'Rx6700 XT', 1, 5000000),
(91, 86, 229, 'BEE-TECH Gaming i9-11900k', 1, 30000000),
(92, 87, 225, 'Bee-Tech Đồ họa', 1, 8990000),
(94, 89, 226, 'Combo DareU', 1, 269000),
(95, 90, 229, 'BEE-TECH Gaming i9-11900k', 1, 30000000),
(96, 90, 226, 'Combo DareU', 1, 269000),
(97, 91, 225, 'Bee-Tech Đồ họa ', 1, 8990000),
(98, 92, 224, 'Bee-Tech Đồ họa', 1, 8799000),
(99, 93, 225, 'Bee-Tech Đồ họa ', 1, 8990000),
(100, 94, 229, 'BEE-TECH Gaming i9-11900k', 1, 30000000),
(101, 94, 225, 'Bee-Tech Đồ họa ', 4, 35960000),
(102, 95, 229, 'BEE-TECH Gaming i9-11900k', 1, 30000000),
(103, 96, 225, 'Bee-Tech Đồ họa ', 1, 8990000),
(104, 96, 229, 'BEE-TECH Gaming i9-11900k', 1, 30000000),
(105, 96, 224, 'Bee-Tech Đồ họa', 1, 8799000),
(106, 97, 225, 'Bee-Tech Đồ họa ', 1, 8990000),
(107, 98, 229, 'BEE-TECH Gaming i9-11900k', 1, 30000000),
(108, 99, 224, 'Bee-Tech Đồ họa', 1, 8799000),
(109, 100, 224, 'Bee-Tech Đồ họa', 1, 8799000),
(110, 101, 224, 'Bee-Tech Đồ họa', 2, 17598000),
(111, 102, 229, 'BEE-TECH Gaming i9-11900k', 1, 30000000),
(112, 103, 224, 'Bee-Tech Đồ họa', 1, 8799000),
(113, 104, 229, 'BEE-TECH Gaming i9-11900k', 1, 30000000),
(114, 105, 225, 'Bee-Tech Đồ họa ', 1, 8990000),
(115, 106, 225, 'Bee-Tech Đồ họa ', 1, 8990000),
(116, 107, 224, 'Bee-Tech Đồ họa', 1, 8799000),
(117, 108, 224, 'Bee-Tech Đồ họa', 1, 8799000),
(118, 109, 245, 'asdasd', 1, 12000000),
(119, 109, 229, 'BEE-TECH Gaming i9-11900k', 1, 30000000),
(120, 110, 246, 'Nguyễn Thị Thuý Ngân', 1, 213123);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'PC'),
(2, 'Laptop'),
(3, 'Gear'),
(4, 'Linh kiện'),
(30, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `category_details`
--

CREATE TABLE `category_details` (
  `category_details_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_details`
--

INSERT INTO `category_details` (`category_details_id`, `category_id`, `name`) VALUES
(1, 1, 'PC gaming'),
(2, 1, 'PC đồ họa'),
(3, 1, 'PC văn phòng'),
(4, 2, 'Laptop gaming'),
(5, 2, 'Laptop văn phòng'),
(6, 3, 'Chuột'),
(7, 3, 'Phím'),
(8, 3, 'Tai nghe'),
(9, 3, 'Combo'),
(10, 4, 'CPU'),
(11, 4, 'VGA'),
(12, 4, 'Mainboard'),
(20, 4, 'Linh kiện mạng'),
(21, 4, 'SSD'),
(22, 4, 'HDD'),
(23, 4, 'Nguồn'),
(25, 4, 'RAM'),
(26, 4, 'Case'),
(27, 4, 'Tản nhiệt'),
(32, 3, 'Loa'),
(36, 4, 'Gear'),
(38, 3, 'Màn'),
(56, 30, 'test1');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `discount_rate` float NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `code`, `name`, `img`, `content`, `discount_rate`, `start`, `end`) VALUES
(29, '0803', 'Ngày Quốc tế Phụ nữ', 'pngtree-8-march-women-day-background-banner-with-pink-flower-picture-image_1261601.jpg', '<p>Ngày Quốc tế Phụ nữ</p>', 300000, '2024-03-08 00:00:00', '2024-03-09 00:00:00'),
(30, '2911', 'Black Friday', 'download.png', '<p>Black Friday</p>', 300000, '2024-11-01 00:00:00', '2024-11-30 00:00:00'),
(33, '0108', 'Back to School', '227-sd.png', '<p>Back to School</p>', 300000, '2024-08-01 00:00:00', '2024-10-01 00:00:00'),
(34, '2010', 'Ngày Phụ nữ Việt Nam', 'bannerphunuvietnam.jpg', '<p>Ngày Phụ nữ Việt Nam</p>', 300000, '2024-10-20 00:00:00', '2024-10-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `firm` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_details_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 50,
  `description` text DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `img`, `firm`, `category_id`, `category_details_id`, `price`, `quantity`, `description`, `create_at`) VALUES
(28, 'BEE-TECH Gaming i5-12400F', '10139_1.jpg', 'GTX 1660 Super', 1, 1, 15500000, 80, NULL, '0000-00-00 00:00:00'),
(29, 'BEE-TECH Gaming i3-12100F', '041f00cfd1112ce33487ceda876e2fde.jpg', 'RTX 2060 Super', 1, 1, 15000000, 100, NULL, '0000-00-00 00:00:00'),
(30, 'BEE-TECH Gaming i7-12700K', 'vo-case-galax-revolution-07-06.jpg', 'RTX 3060 Super', 1, 1, 20000000, 100, NULL, '0000-00-00 00:00:00'),
(31, 'BEE-TECH Gaming i5-10400F', '1682301929-1461209840-case-es1-genshin-impact.jpg', 'GTX 1650 Super', 1, 1, 12500000, 50, NULL, '0000-00-00 00:00:00'),
(32, 'BEE-TECH Gaming i3-9100F', 'bmw-pc-ring-02.jpg', 'GTX 1060 6GB Super', 1, 1, 12000000, 50, NULL, '0000-00-00 00:00:00'),
(33, 'BEE-TECH Gaming i9-12900K', 'case-pc-la-gi-4.jpeg', 'RTX 4060 Super', 1, 1, 2500000, 50, NULL, '0000-00-00 00:00:00'),
(34, 'BEE-TECH Gaming i5-11400F', 'case-GALAX-REVOLUTION-05-WHITE.jpg', 'GTX 3060 Super', 1, 1, 14500000, 50, NULL, '0000-00-00 00:00:00'),
(35, 'BEE-TECH Gaming i7-13700K', '812BXSN478L.jpg', 'GTX 3080 Ti', 1, 1, 23000000, 50, NULL, '0000-00-00 00:00:00'),
(36, 'BEE-TECH Gaming i9-14900K', '81BoLJiVacL.jpg', 'GTX 4070 Super', 1, 1, 30000000, 50, NULL, '0000-00-00 00:00:00'),
(37, 'Dell AlienWare M15 R3 i7 10th', '12_(3).jpg', 'Dell', 2, 4, 15000000, 50, NULL, '0000-00-00 00:00:00'),
(38, 'SamSung i5-12400F', '62fcb05b945551cb470ae717-mi-100-full-box-laptop-samsung-galaxy-book-pro-13-laptop-siu-nh-cha-ti-1kg-core-i5-1135g7-ram-8g-ssd-256g-mn-133-fhd-amoled-jpeg.webp', 'Samsung', 2, 5, 13500000, 50, NULL, '0000-00-00 00:00:00'),
(39, 'Dell i7-12700U', '6731_3.jpg', 'Dell', 2, 5, 20000000, 50, NULL, '0000-00-00 00:00:00'),
(40, 'Acer i5-10400F', 'acer-swift-3-sf314-512-56qn-i5-nxk0fsv002-ab-thumb-600x600.jpg', 'Acer', 2, 4, 12500000, 50, '', '0000-00-00 00:00:00'),
(41, 'Dell AlienWare X16', 'ces2023hands-on_alienwarex16new16-inchflagshipampsupthepowerrgbbling1-8screenshot_1280x720-800-resize.jpg', 'Dell', 2, 4, 99999000, 10, NULL, '0000-00-00 00:00:00'),
(44, 'Dell Gaming i7-12700K', 'HP-Laptop-PNG-Image.png', 'Dell', 2, 4, 20000000, 50, '', '0000-00-00 00:00:00'),
(45, 'MSI Gaming i5-10400', 'msi-modern-14-b5m-r5-203vn-2-2.jpg', 'MSI', 2, 5, 12000000, 50, '', '0000-00-00 00:00:00'),
(82, 'Chuột Asus Wireless', '70572_chuot_khong_day_gaming_asus_rog_harpe_ace_aim_lab0_001.jpg', 'ASUS', 3, 6, 3000000, 50, '<ul><li>Chuột game không dây Asus TUF M4 Wireless</li><li>Chuẩn kết nối: Wireless 2.4Ghz / Bluetooth</li><li>Mắt cảm biến PMW3331 với độ phân giải 12k DPI cho độ chính xác cao</li></ul>', '2024-04-07 06:56:30'),
(83, 'Chuột Logitech Bluetooth', 'chuotlogitech.jpg', 'Logitech', 3, 6, 780000, 50, '<p>Chuột Logitech Wireless</p>', '2024-04-07 07:21:10'),
(84, 'Chuột Rapoo Wireless', 'chuotrapoo.jpg', 'Rapoo', 3, 6, 200000, 50, '<p>Chuột Rapoo Wireless</p>', '2024-04-07 07:25:12'),
(85, 'Chuột DareU Wireless', 'chuotdareu.jpg', 'DareU', 3, 6, 100000, 50, '<p>Chuột DareU Wireless</p>', '2024-04-07 07:26:55'),
(86, 'Chuột DareU Bluetooth', 'chuotdareubluetooth.jpg', 'DareU', 3, 6, 260000, 50, '<p>Chuột DareU Bluetooth</p>', '2024-04-07 07:29:09'),
(87, 'Chuột Gaming Asus', 'chuotgamingasus.jpg', 'ASUS', 3, 6, 290000, 50, '<p>Chuột Gaming Asus</p>', '2024-04-07 07:31:52'),
(88, 'Phím Bluetooth Dareu', 'banphimcobluetoothdareu.jpg', 'Dareu', 3, 7, 990, 50, '<p>Phím Bluetooth Dareu</p>', '2024-04-07 07:38:09'),
(89, 'Phím Cơ Gaming', 'banphimcodaygamingrapoo.jpeg', 'Rapoo', 3, 7, 390000, 50, '<p>Phím Cơ Gaming</p>', '2024-04-07 07:40:05'),
(90, 'Phím Bluetooth Rapoo', 'phimbluetoothrapoo.jpg', 'Rapoo', 3, 7, 2000000, 50, '', '2024-04-07 07:47:57'),
(91, 'Phím Gaming Asus', 'cogamingasus.jpeg', 'ASUS', 3, 7, 860000, 50, '<p>Phím Gaming Asus</p>', '2024-04-07 07:53:18'),
(92, 'Phím Cơ Asus', 'phimgamingasus.jpg', 'ASUS', 3, 7, 3320000, 50, '<p>Phím Cơ Asus</p>', '2024-04-07 07:56:06'),
(93, 'Phím Cơ Có Dây DareU', 'codaydareu.jpg', 'DareU', 3, 7, 500000, 50, '<p>Phím Cơ Có Dây DareU</p>', '2024-04-07 08:02:40'),
(94, 'Tai nghe Bluetooth ', 'tainghebluetoothtruewirelessxiaomi.jpg', 'Xiaomi', 3, 8, 900000, 50, '<p>Tai nghe Bluetooth</p>', '2024-04-07 08:13:52'),
(96, 'Tai nghe Bluetooth ', 'tainghebluetoothtruewirelesssony.jpg', 'Sony', 3, 8, 2190000, 50, '<p>Tai nghe Bluetooth&nbsp;</p>', '2024-04-07 08:22:40'),
(97, 'Tai nghe Gaming', 'tainghechuptaigamingasus.jpg', 'ASUS', 3, 8, 900000, 50, '<p>Tai nghe Gaming</p>', '2024-04-07 08:33:19'),
(98, 'Tai nghe Gaming', 'taingherapoo.jpg', 'Rapoo', 3, 8, 390000, 50, '<p>Tai nghe Gaming</p>', '2024-04-07 08:50:00'),
(99, 'Tai nghe Gaming', 'tainghedareu.jpg', 'DareU', 3, 8, 830000, 50, '<p>Tai nghe Gaming</p>', '2024-04-07 08:51:11'),
(100, 'VGA 3060TI', 'adef193e561a42878f224827e4184884.jpeg', 'Asus', 4, 11, 6300000, 50, '<p>3060ti asus 2nd</p>', '2024-04-09 06:41:34'),
(107, 'CPU Intel Core i3 12100F', 'i312100f.jpg', 'Intel', 4, 10, 2300000, 50, '<p>CPU Intel Core i3 12100F</p>', '2024-04-09 08:13:52'),
(108, 'CPU Intel Core i5 12400f', 'i512400f.jpg', 'Intel', 4, 10, 3500000, 50, '<p>CPU Intel Core i5 12400f</p>', '2024-04-09 08:15:00'),
(109, 'CPU Intel Core i5 10400F', 'i510400f.jpg', 'Intel', 4, 10, 2700000, 50, '<p>CPU Intel Core i5 10400F</p>', '2024-04-09 08:16:04'),
(110, 'CPU Intel Core i7 12700K', 'i510400f.jpg', 'Intel', 4, 10, 7900000, 50, '<p>CPU Intel Core i7 12700K</p>', '2024-04-09 08:16:47'),
(111, 'CPU Intel Core i9 12900K', 'i912900k.jpg', 'Intel', 4, 10, 11490000, 50, '<p>CPU Intel Core i9 12900K</p>', '2024-04-09 08:17:33'),
(114, 'VGA GIGABYTE RTX 2060 SUPER', '2060S.jpg', 'GIGABYTE', 4, 11, 7999000, 50, '<p>VGA GIGABYTE RTX 2060 SUPER</p>', '2024-04-09 08:26:29'),
(115, 'VGA GIGABYTE RTX 3060 SUPER', '3060S.jpg', 'GIGABYTE', 4, 11, 9000000, 50, '<p>VGA GIGABYTE RTX 3060 SUPER</p>', '2024-04-09 08:28:13'),
(116, 'VGA MSI GTX 1650 SUPER', '1650S.png', 'MSI', 4, 11, 3600000, 50, '<p>VGA MSI GTX 1650 SUPER</p>', '2024-04-09 08:30:39'),
(117, 'VGA ASUS GTX 1060 SUPER', '1060S.jpg', 'ASUS', 4, 11, 2000000, 50, '<p>VGA ASUS GTX 1060 SUPER</p>', '2024-04-09 08:33:35'),
(118, 'VGA GIGABYTE RTX 4060 SUPER', '4060s.jpg', 'GIGABYTE', 4, 11, 10000000, 50, '<p>VGA GIGABYTE RTX 4060 SUPER</p>', '2024-04-09 08:36:45'),
(120, 'SSD APACER ', 'ssdapacer.jpg', 'APACER', 4, 21, 339000, 50, '<p>SSD APACER</p>', '2024-04-09 08:42:20'),
(122, 'SSD GIGABYTE', 'gigabytesata.jpg', 'GIGABYTE', 4, 21, 459000, 50, '<p>SSD GIGABYTE</p>', '2024-04-09 08:44:16'),
(123, 'SSD GIGABYTE', '250_62643_o_cung_ssd_gigabytesata.jpg', 'GIGABYTE', 4, 21, 680000, 50, '<p>SSD GIGABYTE</p>', '2024-04-09 08:45:12'),
(124, 'SSD KINGFAST', '250_45560_ssd_kingfast_nvme_m_2_2280_128gb_read_1500mbs_write_500mbs_1.jpg', 'KINGFAST', 4, 21, 379000, 50, '<p>SSD KINGFAST</p>', '2024-04-09 08:46:00'),
(125, 'SSD ADATA', '250_47539_____c___ng_ssd_adata_asx6000lnp_128gb_m_2_2280_pcie_nvme.jpg', 'ADATA', 4, 21, 399000, 50, '<p>SSD ADATA</p>', '2024-04-09 08:47:00'),
(126, 'SSD WD', 'ssdwdsn350green250gb.jpg', 'WD', 4, 21, 860000, 50, '<p>SSD WD</p>', '2024-04-09 08:57:28'),
(127, 'HDD WD', '250_17739_hdd_western_purple_1tb5400_sata_3_64mb_001.jpg', 'WD', 4, 22, 1259000, 50, '<p>HDD WD</p>', '2024-04-09 08:58:14'),
(128, 'HDD WD', '250_50317_anh_hdd.jpg', 'WD', 4, 22, 1400000, 50, '<p>HDD WD</p>', '2024-04-09 08:58:55'),
(129, 'HDD WD', '250_77902__o_cung_hdd_wd_purple_3tb_3__1_.jpg', 'WD', 4, 22, 2350000, 50, '<p>HDD WD</p>', '2024-04-09 08:59:46'),
(130, 'Nguồn ASUS', '250_66952_rog_thor_1600t_02__2_.jpg', 'ASUS', 4, 23, 16899000, 50, '<p>Nguồn ASUS&nbsp;</p>', '2024-04-09 09:11:18'),
(131, 'MAINBOARD ASUS A320M', '250_37407_prime_a320m_k_2d.png', 'ASUS', 4, 12, 1400000, 50, '<p>MAINBOARD ASUS A320M</p>', '2024-04-09 09:18:49'),
(132, 'MAINBOARD ASUS H610M', '250_63412_mainboard_asus_prime_h610m_k_d4_1.jpg', 'ASUS', 4, 12, 2000000, 50, '<p>MAINBOARD ASUS H610M</p>', '2024-04-09 09:19:56'),
(133, 'MAINBOARD GIGABYTE H610M', '250_74881_mainboard_gigabyte_h610m_s2_v2_ddr4__2_.jpg', 'GIGABYTE', 4, 12, 2000000, 50, '<p>MAINBOARD GIGABYTE H610M</p>', '2024-04-09 09:20:55'),
(134, 'MAINBOARD ASROCK B660M', '250_63437_mainboard_asrock_b660m_hdv_intel_b660_m_atx_2_khe_ram_ddr4_1.jpg', 'ASROCK', 4, 12, 2499000, 50, '<p>MAINBOARD ASROCK B660M</p>', '2024-04-09 09:22:20'),
(135, 'MAINBOARD ASROCK B550M', '250_53498_b550m_pro4_l1_.jpg', 'ASROCK', 4, 12, 2599000, 50, '<p>MAINBOARD ASROCK B550M</p>', '2024-04-09 09:23:04'),
(136, 'MAINBOARD GIGABYTE B460M', '250_52957_gigabyte_b460m_d3h.jpg', 'GIGABYTE', 4, 12, 2629000, 50, '<p>MAINBOARD GIGABYTE B460M</p>', '2024-04-09 09:24:27'),
(137, 'Nguồn MSI ', '250_74913_ngu___n_m__y_t__nh_msi_mag_a850gl_pcie_5_2.jpg', 'MSI', 4, 23, 2899000, 50, '<p>Nguồn MSI&nbsp;</p>', '2024-04-09 09:24:34'),
(138, 'Nguồn ASUS', '250_81853_ngu___n_asus_rog_strix_1200g_aura_gaming__7_.jpg', 'ASUS', 4, 23, 6489000, 50, '<p>Nguồn ASUS&nbsp;</p>', '2024-04-09 09:27:51'),
(139, 'Nguồn CENTAUR ', '250_78711_centaur_750__4.jpg', 'CENTAUR', 4, 23, 949000, 50, '<p>Nguồn CENTAUR</p>', '2024-04-09 09:30:36'),
(140, 'Nguồn CENTAUR ', '250_78710_650_4.jpg', 'CENTAUR', 4, 23, 799000, 50, '<p>Nguồn CENTAUR</p>', '2024-04-09 09:32:29'),
(141, 'Nguồn COOLER MASTER', '250_55275_cooler_master_mwe_v2_230v_650_650w_plus_bronze_0007_1__2_.jpg', 'COOLER MASTER', 4, 23, 1439000, 50, '<p>Nguồn COOLER MASTER</p>', '2024-04-09 09:34:54'),
(142, 'Nguồn COOLER MASTER', '250_52101__cooler_master_elite_v3_230v_pc500_500w_0000_1__5_.jpg', 'COOLER MASTER', 4, 23, 829000, 50, '<p>Nguồn COOLER MASTER</p>', '2024-04-09 09:40:36'),
(143, 'Ổ CỨNG HDD SEAGATE FIRECUDA 4TB', '250_64525_o_cung_hdd_seagate_firecuda_4tb_3_5_inch_st4000dx005_1.jpg', 'SEAGATE', 4, 22, 4199000, 50, '<p>Ổ CỨNG HDD SEAGATE FIRECUDA 4TB</p>', '2024-04-10 03:11:19'),
(144, 'Ổ CỨNG HDD SEAGATE BARRACUDA 1TB', '250_77887_44444_hdd_seagate_barracuda_2tb7200_sata_256mb_35quot___st2000dm008_s.jpg', 'SEAGATE', 4, 22, 1459000, 50, '<p>Ổ CỨNG HDD SEAGATE BARRACUDA 1TB</p>', '2024-04-10 03:12:51'),
(145, 'Ổ CỨNG HDD SEAGATE IRONWOLF 10TB', '250_65339_o_cung_hdd_seagate_ironwolf_10tb_3_5_inch_st10000vn000__1_.jpg', 'SEAGATE', 4, 22, 8599000, 50, '<p>Ổ CỨNG HDD SEAGATE IRONWOLF 10TB</p>', '2024-04-10 03:13:56'),
(148, 'BEE-TECH Văn phòng', '250_46369_50196_asus_s500md_p1.jpg', 'CPU Intel Core i3 12100', 1, 3, 9050000, 50, '<p>Intel Core i3-12100</p>', '2024-04-10 04:19:18'),
(149, 'BEE-TECH Văn phòng', '250_47921_52991_may_tinh_de_ban_lenovo_thinkcentre_neo_50t_gen4_1.jpg', 'CPU Intel Core i3-13100', 1, 3, 9450000, 50, '<p>BEE-TECH Văn phòng</p>', '2024-04-10 04:20:26'),
(150, 'BEE-TECH Văn phòng', '250_47967_may_bo_dell_optiplex_7010_tower_plus_i7_42ot701007_124218.jpg', 'CPU Intel Core i3 12100', 1, 3, 10400000, 50, '<p>BEE-TECH Văn phòng</p>', '2024-04-10 06:26:32'),
(162, 'RAM Kingston', '250_39385_ktc_product_memory_beast_ddr4_rgb_single_1_lg.jpg', 'Kingston', 4, 25, 559000, 50, '<p>RAM Kingston</p>', '2024-04-13 01:50:55'),
(165, 'RAM Kingston', '250_46890_46874_ram_kingston_fury_beast_rgb_16gb__1x16gb__ddr4_3200mhz__1_.jpg', 'Kingston', 4, 25, 800000, 50, '<p>RAM Kingston</p>', '2024-04-13 02:27:04'),
(166, 'RAM Kingston', '250_36952_ktc_product_memory_beast_ddr4_single_1_lg.jpg', 'Kingston', 4, 25, 1199000, 50, '<p>RAM Kingston</p>', '2024-04-13 02:31:14'),
(169, 'Loa LG', '244667-1-600x600.jpg', 'LG', 3, 32, 1290000, 50, '<p>Loa LG</p>', '2024-04-13 02:53:03'),
(170, 'Loa LG', '225990-600x600.jpg', 'LG', 3, 32, 2990000, 50, '<p>Loa LG</p>', '2024-04-13 02:53:50'),
(171, 'Loa LG', '309067-600x600.jpg', 'LG', 3, 32, 6490000, 50, '<p>Loa LG</p>', '2024-04-13 02:54:35'),
(175, 'Loa Enkor', 'loa-vi-tinh-21-enkor-e700-den-thumb-5-600x600.jpg', 'Enkor', 3, 32, 640000, 50, '<p>Loa Enkor</p>', '2024-04-13 03:13:43'),
(176, 'Loa Enkor', 'loa-vi-tinh-21-enkor-s2880-den-thumb-5-600x600.jpg', 'Enkor', 3, 32, 1295000, 50, '<p>Loa Enkor</p>', '2024-04-13 03:14:14'),
(177, 'Quạt JONSBO', '250_45855_b____3_qu___t_jonsbo_zg_120b_black__3_in_1_.jpg', 'JONSBO', 4, 27, 699000, 50, '<p>Quạt JONSBO</p>', '2024-04-13 03:26:53'),
(179, 'Quạt JONSBO', '250_46700_b____3_qu___t_jonsbo_zh_120wr_white_infinity_3.jpg', 'JONSBO', 4, 27, 799000, 50, '<p>Quạt JONSBO</p>', '2024-04-13 03:28:28'),
(186, 'Case KENOO', '250_40244_z3020227429568_63a0fb62af5b4b6ffb8170e4ff3b0e32.jpg', 'KENOO', 4, 26, 699000, 50, '<p>Case KENOO</p>', '2024-04-13 03:51:35'),
(187, 'Case KENOO', '250_40245_z3020227421693_1820be84702cc673e26fd638b8996ba9.jpg', 'KENOO', 4, 26, 699000, 50, '<p>Case KENOO</p>', '2024-04-13 03:51:53'),
(190, 'Case KENOO', '250_42521_v1_5.jpg', 'KENOO', 4, 26, 799000, 50, '<p>Case KENOO</p>', '2024-04-13 03:58:36'),
(191, 'Case KENOO', '250_47903_v____case_m__y_t__nh_kenoo_esport_af100___3f_mesh_black___2_.jpg', 'KENOO', 4, 26, 799000, 50, '<p>Case KENOO</p>', '2024-04-13 03:59:05'),
(192, 'Case KENOO', '250_47904_v____case_m__y_t__nh_kenoo_esport_af100___3f_mesh_white__2_.jpg', 'KENOO', 4, 26, 799000, 50, '<p>Case KENOO</p>', '2024-04-13 03:59:26'),
(212, 'Case KENOO', '250_45267_v____case_kenoo_esport_fm800__eatx_.jpg', 'KENOO', 4, 26, 899000, 50, '<p>Case KENOO</p>', '2024-04-13 04:05:08'),
(216, 'Màn LG UltraGear1', '250_42567_lg_ultragear_27gq50f_b_upweb_1a.jpg', 'LG', 3, 38, 3479000, 50, '<p>Màn LG</p>', '2024-04-13 06:36:30'),
(217, 'Màn hình MSI OPTIC', '47950_msi_g274f_upweb_1.jpg', 'MSI', 3, 38, 4289000, 50, '<p>Màn hình MSI</p>', '2024-04-13 06:41:24'),
(219, 'Router ASUS', '41750_1.jpg', 'ASUS', 4, 20, 1135000, 50, '<p>Router ASUS</p>', '2024-04-13 07:01:48'),
(220, 'Router ASUS', 'bo-phat-song-wifi-router-chuan-wifi-6-asus-ax1800hp-den-thumb-600x600.jpg', 'ASUS', 4, 20, 1400000, 50, '<p>Router ASUS</p>', '2024-04-13 08:24:37'),
(222, 'Router ASUS 5', 'router-wifi-chuan-wifi-6-asus-tuf-gaming-ax4200-thumb-600x600.jpg', 'ASUS', 4, 20, 3090000, 50, '<p>Router ASUS</p>', '2024-04-13 08:26:17'),
(223, 'Bee-Tech Đồ họa', '250_45707_pcapt0046_pba.png', 'Ryzen 5 5600G', 1, 2, 7599000, 50, '<p>Bee-Tech Đồ họa</p>', '2024-04-20 02:18:23'),
(224, 'Bee-Tech Đồ họa', '250_45705_pcdsbasic.png', 'Ryzen 5 5500', 1, 2, 8799000, 50, '<p>Bee-Tech Đồ họa</p>', '2024-04-20 02:19:08'),
(225, 'Bee-Tech Đồ họa ', '250_45702_pcdsbasic.png', 'i3-10105F', 1, 1, 8990000, 50, '<p>Bee-Tech Đồ họa</p>', '2024-04-20 02:19:54'),
(229, 'BEE-TECH Gaming i9-11900k', 'z5171321895798_bd01baeaa72c62c2e05080688f87d435.jpg', 'RX6800XT', 1, 1, 30000000, 50, '<p>BEE-TECH Gaming i9-11900k</p>', '2024-04-21 03:54:46'),
(245, 'asdasd', 'z5375222721377_8ebc24e8a0dcc703dcd08e853ff2014b.jpg', 'aaaaaaaaaa', 30, 56, 12000000, 50, '', '2024-07-14 15:49:32'),
(246, 'Nguyễn Thị Thuý Ngân', 'z5400980506500_2836529ac2f3b689116069a525822b3a.jpg', '123123', 30, 56, 213123, 50, '<p>aaaa</p>', '2024-07-14 15:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `product_id`, `user_id`, `rating`) VALUES
(1, 29, 2, 5),
(2, 29, 2, 4),
(3, 29, 2, 3),
(4, 29, 2, 2),
(5, 29, 2, 4),
(6, 29, 2, 5),
(7, 29, 2, 2),
(8, 29, 2, 1),
(9, 29, 2, 1),
(10, 28, 112, 5),
(11, 29, 112, 4),
(12, 44, 2, 5),
(13, 45, 2, 1),
(14, 28, 155, 4),
(15, 225, 156, 5),
(16, 225, 156, 3),
(17, 225, 156, 5),
(18, 225, 156, 3),
(19, 225, 156, 3),
(20, 223, 156, 5),
(21, 29, 158, 5),
(22, 229, 158, 5),
(24, 29, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `product_id`, `comment`, `create_at`) VALUES
(2, 2, 28, '12321321321', '2024-03-28 16:25:09'),
(3, 2, 28, '123213', '2024-03-28 16:25:11'),
(4, 2, 28, 'sản phẩm rất tuyệt vời', '2024-03-28 16:26:03'),
(5, 2, 29, 'Sản phẩm 1 sao', '2024-03-29 05:52:26'),
(6, 112, 28, 'Giá hơi đắt', '2024-04-02 09:17:56'),
(7, 112, 28, 'Giá quá đắt không cho bình luận\r\n', '2024-04-02 09:18:29'),
(8, 112, 28, 'Aaaaa', '2024-04-02 09:18:40'),
(9, 112, 29, 'ÁDAsa', '2024-04-02 09:22:14'),
(10, 113, 29, '123', '2024-04-02 10:51:01'),
(11, 113, 29, '123', '2024-04-02 10:51:21'),
(12, 113, 29, '123', '2024-04-02 10:52:37'),
(13, 113, 29, 'aaa', '2024-04-02 10:55:28'),
(14, 113, 29, 'aaaa', '2024-04-02 10:58:05'),
(15, 113, 29, 'bbbbbb', '2024-04-02 10:58:11'),
(16, 113, 29, 'bbhbhbh', '2024-04-02 11:01:06'),
(17, 155, 28, 'shop te', '2024-04-20 02:18:50'),
(18, 155, 28, 'shop qua te', '2024-04-20 02:19:01'),
(19, 156, 225, 'shop tặng 1 bộ đi sốp', '2024-04-20 09:22:28'),
(20, 156, 225, 'shop tặng 1 bộ đi sốp', '2024-04-20 09:22:28'),
(21, 156, 225, 'shop tặng 1 bộ đi sốp', '2024-04-20 09:22:28'),
(22, 156, 225, 'shop tặng 1 bộ đi sốp', '2024-04-20 09:22:28'),
(23, 156, 225, 'shop tặng 1 bộ đi sốp', '2024-04-20 09:22:28'),
(25, 158, 229, 'aaaaa', '2024-04-24 03:19:43'),
(27, 2, 229, 'Laura is the face in the misted light\r\nFootsteps that you hear down the hall\r\nThe love that floats on a summer night\r\nThat you can never quite recall', '2024-04-25 10:50:42'),
(29, 2, 229, 'xzczzzzzzzzzzzz', '2024-04-25 10:51:18'),
(30, 2, 28, 'dasdasda\r\nsadasdsa\r\n', '2024-04-30 02:18:18'),
(31, 2, 28, 'Laura is the face in the misted light\r\nFootsteps that you hear down the hall\r\nThe love that floats on a summer night\r\nThat you can never quite recall\r\n\r\nHave you see Laura on the train that is passing through\r\nThose eyes, how familiar they seem\r\nShe give your very first kiss to you\r\nThat was Laura, but she\'s only a dream', '2024-04-30 02:32:37');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` tinyint(1) DEFAULT 0,
  `creat_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `passwd`, `email`, `role`, `creat_at`) VALUES
(1, 'Vũ Huy Hoàng', '01768c82a678de357f05e2c3bfffdd46', 'adminvhh@gmail.com', 1, '2024-02-13 02:52:49'),
(2, 'Vũ Huy Hoàng', 'e10adc3949ba59abbe56e057f20f883e', 'usertest@gmail.com', 0, '2024-02-13 08:14:58'),
(93, 'bee356', 'e10adc3949ba59abbe56e057f20f883e', 'sneakynetgametop@gmail.com', 0, '2024-03-26 14:42:42'),
(94, 'vhh3101', 'e10adc3949ba59abbe56e057f20f883e', 'vhh3101@gmail.com', 0, '2024-03-27 07:05:20'),
(96, 'bee261', 'e10adc3949ba59abbe56e057f20f883e', 'vuhuyhoang999123@gmail.com', 0, '2024-03-31 07:56:45'),
(99, 'bee679', 'e10adc3949ba59abbe56e057f20f883e', 'vuhuyhoang9992123@gmail.com', 0, '2024-03-31 08:03:49'),
(106, 'bee423', 'e10adc3949ba59abbe56e057f20f883e', 'vuhuyhoangbz@gmail.com', 0, '2024-03-31 08:13:06'),
(107, 'bee410', 'e10adc3949ba59abbe56e057f20f883e', 'sneakynetgameto2p@gmail.com', 0, '2024-03-31 08:16:46'),
(108, 'bee631', 'e10adc3949ba59abbe56e057f20f883e', 'hoangtomato.2@gmail.com', 0, '2024-03-31 08:19:15'),
(109, 'bee189', 'e10adc3949ba59abbe56e057f20f883e', 'Testing@gmail.com', 0, '2024-03-31 15:48:31'),
(110, 'bee197', 'e10adc3949ba59abbe56e057f20f883e', 'Testing2@gmail.com', 0, '2024-03-31 15:49:18'),
(112, 'duynguyen', 'b060195601a9229736e6c86845d03635', 'minhduy8888@gmail.com', 0, '2024-04-02 08:57:16'),
(113, 'beeabc nè', 'e10adc3949ba59abbe56e057f20f883e', 'vhh123@gmail.com', 0, '2024-04-02 10:50:24'),
(115, 'bee207', 'e10adc3949ba59abbe56e057f20f883e', 'giahaokhung12321113@gmail.com', 0, '2024-04-07 05:10:09'),
(126, 'bee481', 'e10adc3949ba59abbe56e057f20f883e', 'tinhyeulainhcuu2@gmail.com', 0, '2024-04-07 06:17:59'),
(138, 'bee719', 'e10adc3949ba59abbe56e057f20f883e', 'lamhoang29504@gmail.com', 0, '2024-04-07 06:22:11'),
(148, 'bee250', 'e10adc3949ba59abbe56e057f20f883e', 'lethituanh8839@gmail.com', 0, '2024-04-07 06:25:50'),
(151, 'bee400', 'e10adc3949ba59abbe56e057f20f883e', 'trumzoom@gmail.com', 0, '2024-04-10 17:02:58'),
(152, 'Nguyễn Thuý Ngân', '01768c82a678de357f05e2c3bfffdd46', 'thuyngan@gmail.com', 0, '2024-04-13 06:15:30'),
(153, 'Vũ Huy Hoàng', '01768c82a678de357f05e2c3bfffdd46', 'vuhuyhoang310199@gmail.com', 0, '2024-04-15 13:53:43'),
(154, 'asdasd1112222', 'e10adc3949ba59abbe56e057f20f883e', 'v12321312@gmail.com', 0, '2024-04-15 13:55:33'),
(155, 'duynho', '202cb962ac59075b964b07152d234b70', 'minhduy07062002@gmail.com', 0, '2024-04-20 02:17:47'),
(156, 'tuanne', 'e10adc3949ba59abbe56e057f20f883e', '123@gmail.com', 0, '2024-04-20 09:19:58'),
(157, 'bee192', 'e10adc3949ba59abbe56e057f20f883e', 'nthuyngan0729@gmail.com', 0, '2024-04-21 07:22:00'),
(158, 'thanhtuan', '7cd20ef68ec43e9f0bfb44b62d6cf2f2', 'thanhtuan@gmail.com', 0, '2024-04-24 03:16:54'),
(159, 'thanhtuan', '7c5fc2d2c51828414be18437e4b5bcc8', 'thanhtuan123@gmail.com', 0, '2024-04-24 03:54:32'),
(161, 'bee990', 'e10adc3949ba59abbe56e057f20f883e', 'nguyenmai10481@gmail.com', 0, '2024-04-26 00:46:09'),
(162, 'bee923', 'e10adc3949ba59abbe56e057f20f883e', 'sneakynetga1metop@gmail.com', 0, '2024-05-21 09:11:04'),
(164, 'usertest99', 'e10adc3949ba59abbe56e057f20f883e', 'usertest99@gmail.com', 0, '2024-05-21 15:23:19'),
(170, 'usertest2@gmail.com', '7ccd87754682f5e994a8a70389836ba2', 'usertest2@gmail.com', 0, '2024-05-21 15:42:27'),
(177, 'usertest5', 'e10adc3949ba59abbe56e057f20f883e', 'usertest5@gmail.com', 0, '2024-05-21 16:18:08'),
(178, 'bee675', 'e10adc3949ba59abbe56e057f20f883e', 'nthuyngan079@gmail.com', 0, '2024-08-01 07:38:53'),
(179, 'bee853', 'e10adc3949ba59abbe56e057f20f883e', 'zxczxczcz@gmail.ca', 0, '2024-08-07 08:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_details_id`, `user_id`, `fullname`, `sex`, `tel`, `address`) VALUES
(48, 2, 'Vũ Huy Hoàng', 0, '0794651157', '759 Trần Phú'),
(52, 154, 'asdasd1112222', 0, '0794651158', '756 Trần Phú'),
(53, 158, 'thanhtuan', 1, '0123456789', '0123456789'),
(54, 164, 'ádsad', 0, '0794651158', '756 Trần Phú');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `code_cart` (`code_cart`),
  ADD KEY `fk_order_user` (`user_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `fk_orderdt_order` (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_details`
--
ALTER TABLE `category_details`
  ADD PRIMARY KEY (`category_details_id`),
  ADD KEY `fk_cd_c` (`category_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_category` (`category_id`),
  ADD KEY `fk_product_category_details` (`category_details_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `fk_rating_user` (`user_id`),
  ADD KEY `fk_rating_product` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_reviews_user` (`user_id`),
  ADD KEY `fk_reviews_product` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_details_id`),
  ADD UNIQUE KEY `unique_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `category_details`
--
ALTER TABLE `category_details`
  MODIFY `category_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `fk_orderdt_order` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`) ON DELETE CASCADE;

--
-- Constraints for table `category_details`
--
ALTER TABLE `category_details`
  ADD CONSTRAINT `fk_cd_c` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `fk_product_category_details` FOREIGN KEY (`category_details_id`) REFERENCES `category_details` (`category_details_id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rating_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
