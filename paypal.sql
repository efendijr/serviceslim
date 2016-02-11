-- phpMyAdmin SQL Dump
-- version 4.5.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2016 at 03:04 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paypal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_restoran`
--

CREATE TABLE `admin_restoran` (
  `admin_id` int(11) NOT NULL,
  `restoran_id` int(11) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_api` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_restoran`
--

INSERT INTO `admin_restoran` (`admin_id`, `restoran_id`, `admin_username`, `admin_email`, `admin_password`, `admin_api`, `created_at`, `updated_at`) VALUES
(1, 1, 'bejo', 'bejo@gmail.com', '$2a$10$14dc1e419db6d0e27970eOFNhr3cw64ncWUeFDCjelP2wB/ZHMAFO', 'bf0abcd9ca1718c1c1906dd0ac3e5061', '2016-01-30 16:06:17', '2016-01-30 16:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `name`, `password`, `email`, `image`, `created_at`, `updated_at`) VALUES
(3, 'efendi', '', 'efendi@gmail.com', '', '2016-01-30 10:48:28', '2016-01-30 10:50:08'),
(4, 'alvin', '', 'alvin@gmail.com', '', '2016-01-30 10:48:28', '2016-01-30 10:50:08'),
(6, 'ahmad', '', 'ahmad@gmail.com', '', '2016-01-30 10:48:28', '2016-01-30 10:50:08'),
(7, 'budi', '12345', 'budi@gmail.com', '', '2016-01-30 13:12:56', '2016-01-30 13:12:56'),
(8, 'utomo', '$2a$10$6c742feed9cdc2e5d9bb2uTWDUDRyp5y2.gBaQGgVRQ3OTaNhtFxC', 'utomo@gmail.com', '', '2016-01-30 13:24:20', '2016-01-30 13:24:20'),
(9, 'shar', '$2a$10$8732fd680c0cc89d0e272uw59qtuzw0eBESBsbEaZQCr0a3/li53i', 'shar@gmail.com', '', '2016-02-02 04:38:22', '2016-02-02 04:38:22'),
(10, 'jhon', '$2a$10$36ec8f134115feeadd3d0OaENBRAM8qF7i.uIBNhZZJ/jbZfjaUAW', 'jhon@gmail.com', '', '2016-02-02 05:18:28', '2016-02-02 05:18:28'),
(11, 'steve', '$2a$10$99f514bf969ea045ccef3unRUyYVp7WcDsJR0x17LUwcooeyfLMMi', 'steve@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-02 08:17:51', '2016-02-02 08:17:51'),
(12, 'bruce', '$2a$10$b7b57ed98a46ca4198d0ceK2CbWOPsimtdWc3lheE/9ZGKWXely/C', 'bruce@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-02 09:30:28', '2016-02-02 09:30:28'),
(13, 'Buluk', '$2a$10$0f364a5427a51e7017ffduRCXg8B33fvZ6/QnFm0pX9o1BDghFvDK', 'buluk@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-02 10:12:43', '2016-02-02 10:12:43'),
(14, 'buluk1', '$2a$10$a91ffc51f071578c353f9OlHqL4iEiMXl5OMGDzBxNyVw5LJ71VqK', 'buluk1@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-02 10:15:42', '2016-02-02 10:15:42'),
(15, 'Buluk2', '$2a$10$63c13d4ffaaf87e389bdcuWIEKV3SN.y3YhiIKz/6SsfkEyT//zc.', 'buluk2@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-02 10:18:29', '2016-02-02 10:18:29'),
(16, 'Debug', '$2a$10$0fd1816b638e3d704623euoPlzT45Zk2IQMb87lF7vHWMn/NG5lVy', 'debug@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-02 13:55:25', '2016-02-02 13:55:25'),
(17, 'House', '$2a$10$2ac0d00b3eb4be848c0eauLHnjEMnEm8u8Bjd7fsIi1vNbu5JqFPG', 'house@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-02 14:22:38', '2016-02-02 14:22:38'),
(18, 'Gor', '$2a$10$c60275bbfff911369f332un2QR135znUKnMeiFKbvLmwfLteIKk4e', 'gore@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-03 07:39:09', '2016-02-03 07:39:09'),
(19, 'Goreng', '$2a$10$7aebe7a0a65c26e849cb4O77HxwLyoqPiuZUaVnFo7PyJIwFdlwnq', 'goreng@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-03 07:45:42', '2016-02-03 07:45:42'),
(20, 'ali', '$2a$10$31ea10157830ead9b5074Oh/awmnPN4fZ4lYN3iGsKppAH1qQtVPq', 'ali@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 15:25:22', '2016-02-04 15:25:22'),
(21, 'ali1', '$2a$10$5c443ad7ae7f92938b138uff/O91k0efNeUkhYhgtdntVlp8IZR7m', 'ali1@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 15:51:40', '2016-02-04 15:51:40'),
(22, 'ali2', '$2a$10$13ff4b1c5b0079056cbecu1AlD9vgEKxLkt9/IRtHwBgz5yXhNQj2', 'ali2@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 15:58:42', '2016-02-04 15:58:42'),
(23, 'ali3', '$2a$10$1c995109b8508f2f08436uuOLuq90aX5JgBwDFmT6EkcGGh0z3HQm', 'ali3@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 16:03:15', '2016-02-04 16:03:15'),
(24, 'ali4', '$2a$10$59d2309a6299df6c761a6OwCjpizmphD2dFlae1rThfQjbBXKOcne', 'ali4@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 16:04:25', '2016-02-04 16:04:25'),
(25, 'ali5', '$2a$10$1ea9feb09839dd8c096b1OJ5Yk4ifKyn7wU.ui26hT9oLanFYQ2zu', 'ali5@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 16:06:09', '2016-02-04 16:06:09'),
(26, 'ali6', '$2a$10$960abbcfdfe0d2d228874OuFvhmbwuUl6MEA35kRNIXnctMpR2tpW', 'ali6@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 16:07:14', '2016-02-04 16:07:14'),
(27, 'ali7', '$2a$10$9c8e6851809c4c222a602ei5LYCEa.HNgq2q/re4jDvl/2Wo7nhRG', 'ali7@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 16:18:04', '2016-02-04 16:18:04'),
(28, 'ali8', '$2a$10$e0e8192ecdf42acdeb14au3QVeqN2lgwWLjeRRUxeL1bVnLppeNDS', 'ali8@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 16:19:32', '2016-02-04 16:19:32'),
(29, 'ali9', '$2a$10$e00f9b90230b4769c2f74uFr/3yK89VDOkNVixhIT6RlMmSnErshS', 'ali9@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 16:20:46', '2016-02-04 16:20:46'),
(30, 'ali10', '$2a$10$af83024f7ca6667d07182ujzQoWrx7SDd2FKkBUXIIcxUQ80URjnC', 'ali10@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 16:25:36', '2016-02-04 16:25:36'),
(31, 'ali11', '$2a$10$2ae60e17e7358de438156u7ywS2WVjE2VpYS6HcKn3QVC8.JrFcei', 'ali11@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 16:26:37', '2016-02-04 16:26:37'),
(32, 'ali11', '$2a$10$ebf21a3c709c23529bfa6ueunrug40WXNnYC/UUhHzmNw3iqy5nr6', 'ali12@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 22:27:26', '2016-02-04 22:27:26'),
(33, 'ali13', '$2a$10$1f81e8901464da8c7fb92e3Zeq6VFFSDhl1RjpSA1yY/qJcGevMCq', 'ali13@gmail.com', 'http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png', '2016-02-04 22:29:12', '2016-02-04 22:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `author_email` varchar(100) NOT NULL,
  `author_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_name`, `author_email`, `author_address`) VALUES
(1, 'ahmad', 'ahmad@gmail.com', 'sekaran');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `member_email` varchar(100) NOT NULL,
  `member_password` varchar(100) NOT NULL,
  `member_api_key` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `restoran_id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `menu_price` decimal(6,2) NOT NULL,
  `menu_kode` varchar(50) NOT NULL,
  `menu_description` text NOT NULL,
  `menu_image` text NOT NULL,
  `menu_sku` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `restoran_id`, `menu_name`, `menu_price`, `menu_kode`, `menu_description`, `menu_image`, `menu_sku`, `created_at`, `updated_at`) VALUES
(1, 1, 'rendang', '20.00', 'makanan', 'rendang enak', 'http://masteresep.com/wp-content/uploads/2014/07/resep-rendang-padang.jpg', 'sku44t45t46', '2016-01-29 16:16:39', '2016-01-30 10:50:56'),
(2, 1, 'mie aceh', '10.00', 'makanan', 'mie aceh enak', 'https://img-global.cpcdn.com/003_recipes/Recipe_2014_06_07_16_48_56_307_c420f9/664x470cq70/photo.jpg', 'sku44t45tdgfd', '2016-01-29 16:30:03', '2016-01-30 10:50:56'),
(3, 1, 'soto lamongan', '10.00', 'makanan', 'soto enak', 'http://mangcook.com/wp-content/uploads/2015/08/Cara-Membuat-Soto-Khas-Lamongan-Sedap-Gurih.jpg', 'sku44t45tfrfd', '2016-01-29 16:30:03', '2016-01-30 10:50:56'),
(4, 1, 'sate madura', '10.00', 'makanan', 'soto maduran enak', 'http://www.resepumi.com/wp-content/uploads/2014/09/Resep-Sate-Madura.jpg\r\n', 'sku44t45fddrfd', '2016-01-29 16:30:03', '2016-01-30 10:50:56'),
(5, 1, 'sup buntut', '20.00', 'makanan', 'sup buntut enak', 'http://delimarestaurant.com.au/product_image/471sopbuntut.jpg', 'sku44t45fddwwrdd435', '2016-01-29 16:30:03', '2016-01-30 10:50:56'),
(6, 1, 'gurami asam manis', '10.00', 'makanan', 'gurami enak', 'http://4.bp.blogspot.com/-I1RcNACLHPg/UHJUEWx-6nI/AAAAAAAAAFI/E7xb9BILQj0/s1600/Resep+Gurame+Asam+Manis.jpg', 'sku44t45fddwwrdfd5', '2016-01-29 16:30:03', '2016-01-30 10:50:56'),
(7, 1, 'kepiting saus ', '30.00', 'makanan', 'kpiting saus', 'http://infokuliner.com/wp-content/uploads/2015/05/64.-kepiting-saus-padang.jpg', 'sku44t4t4', '2016-01-29 16:30:03', '2016-01-30 10:50:56'),
(8, 1, 'iga bakar', '30.00', 'makanan', 'iga bakar', 'http://www.tokomesin.com/wp-content/uploads/2015/05/qmeals-beverages-iga-bakar-tokomesin.jpg\r\n', 'sku44tdf', '2016-01-29 16:30:03', '2016-01-30 10:50:56'),
(9, 1, 'es degan', '0.50', 'minuman', 'es degan seger', 'http://www.bisnismakanan.com/wp-content/uploads/2014/09/es-kelapa-muda-di-indonesiaproud-wordpress-com.jpg\r\n', 'sku4454fdg', '2016-01-29 16:30:03', '2016-01-30 10:50:56'),
(10, 1, 'es doger', '0.40', 'minuman', 'es doger seger', 'http://www.tokomesin.com/wp-content/uploads/2015/07/es-doger-tokomesin.jpg', 'sku456rt', '2016-01-29 16:30:03', '2016-01-30 10:50:56'),
(11, 1, 'es goyobot', '0.60', 'minuman', 'es goyobot seger', 'http://bandung.panduanwisata.id/files/2012/11/goyobod-kiliningan2.jpg\r\n', 'sku45464', '2016-01-29 16:30:03', '2016-01-30 10:50:56'),
(12, 1, 'es campur', '1.00', 'minuman', 'es campur seger', 'http://portalmadura.com/wp-content/uploads/2015/11/es-campur.png', 'sku4544', '2016-01-29 16:30:03', '2016-01-30 10:50:56'),
(13, 1, 'cappucino', '1.00', 'minuman', 'cappucino', 'https://resepminuman.files.wordpress.com/2012/02/27-cappucino-double-sugar.jpg', 'sku4544wr43', '2016-01-29 16:30:03', '2016-01-30 10:50:56'),
(14, 1, 'nasi goreng', '2.00', 'makanan', 'nasi goreng enak', 'https://resepminuman.files.wordpress.com/2012/02/27-cappucino-double-sugar.jpg', 'sdf34534dwr', '2016-01-30 10:30:56', '2016-01-30 10:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `paypalPaymentId` text NOT NULL,
  `create_time` text NOT NULL,
  `update_time` text NOT NULL,
  `state` varchar(15) NOT NULL,
  `amount` decimal(6,2) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `userId`, `paypalPaymentId`, `create_time`, `update_time`, `state`, `amount`, `currency`, `created_at`) VALUES
(1, 1, 'PAY-75W67879M5874310UK2ZVEVI', '2016-02-04T13:30:15Z', '2016-02-04T13:30:04Z', 'approved', '4.50', '4.5', '2016-02-04 13:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `sku` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `sku`, `created_at`) VALUES
(1, 'Google Nexus 6', '690.50', 'Midnight Blue, with 32 GB', 'http://api.androidhive.info/images/nexus5.jpeg', 'sku-2123wers100', '2015-02-04 16:19:42'),
(2, 'Sandisk Cruzer Blade 16 GB Flash Pendrive', '4.50', 'USB 2.0, 16 GB, Black & Red, Read 17.62 MB/sec, Write 4.42 MB/sec', 'http://api.androidhive.info/images/sandisk.jpeg', 'sku-78955545w', '2015-02-10 15:54:28'),
(3, 'Kanvas Katha Backpack', '11.25', '1 Zippered Pocket Outside at Front, Loop Handle, Dual Padded Straps at the Back, 1 Compartment', 'http://api.androidhive.info/images/backpack.jpeg', 'sku-8493948kk4', '2015-02-10 15:55:34'),
(4, 'Prestige Pressure Cooker', '30.00', 'Prestige Induction Starter Pack Deluxe Plus Pressure Cooker 5 L', 'http://api.androidhive.info/images/prestige.jpeg', 'sku-90903034ll', '2015-02-10 15:59:25'),
(5, 'bubur', '2.50', 'bubur adalah beras yang sudah hancur', '', '', '2016-01-28 14:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `restoran`
--

CREATE TABLE `restoran` (
  `restoran_id` int(11) NOT NULL,
  `restoran_name` varchar(100) NOT NULL,
  `restoran_logo` text NOT NULL,
  `restoran_address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restoran`
--

INSERT INTO `restoran` (`restoran_id`, `restoran_name`, `restoran_logo`, `restoran_address`, `created_at`, `updated_at`) VALUES
(1, 'makan makan', 'https://sribu-sg.s3.amazonaws.com/assets/media/contest_detail/2013/9/bikin-logo-utk-resto-yg-ber-nama-makan-makan-522f038aa4b1b02dec0010b9/normal_8c2a2c2723.jpg', 'jalan bebek goreng no.23 malang', '2016-01-30 09:23:41', '2016-01-30 10:51:18'),
(3, 'makan yuk', 'https://sribu-sg.s3.amazonaws.com/assets/media/contest_detail/2013/9/bikin-logo-utk-resto-yg-ber-nama-makan-makan-522f038aa4b1b02dec0010b9/normal_8c2a2c2723.jpg', 'jalan merpati no.45 malang', '2016-01-31 02:20:41', '2016-01-31 02:20:41');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `paymentId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `state` varchar(15) NOT NULL,
  `salePrice` decimal(6,2) NOT NULL,
  `quantity` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `paymentId`, `productId`, `state`, `salePrice`, `quantity`) VALUES
(1, 1, 2, 'completed', '4.50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tes`
--

CREATE TABLE `tes` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tes`
--

INSERT INTO `tes` (`id`, `nama`, `kota`, `anggota_id`, `created_at`) VALUES
(11, 'ahmad', 'lamongan', 0, '2016-02-04 15:56:28'),
(12, 'efendi', 'malang', 0, '2016-02-04 15:56:28'),
(13, 'rohman', 'jakarta', 0, '2016-02-04 15:56:28'),
(14, 'wawan', 'malang', 0, '2016-02-04 15:56:28'),
(15, 'abdul', 'makasar', 0, '2016-02-04 15:56:28'),
(16, 'ali', 'bwi', 0, '2016-02-04 15:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `tutorial`
--

CREATE TABLE `tutorial` (
  `tutorial_id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `tutorial_title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutorial`
--

INSERT INTO `tutorial` (`tutorial_id`, `author_id`, `tutorial_title`) VALUES
(1, 1, 'learn mysql');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`) VALUES
(1, 'Android Hive', 'androidhive@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_restoran`
--
ALTER TABLE `admin_restoran`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `restoran_id` (`restoran_id`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `member_email` (`member_email`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `restoran_id` (`restoran_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restoran`
--
ALTER TABLE `restoran`
  ADD PRIMARY KEY (`restoran_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paymentId` (`paymentId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `tes`
--
ALTER TABLE `tes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutorial`
--
ALTER TABLE `tutorial`
  ADD PRIMARY KEY (`tutorial_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_restoran`
--
ALTER TABLE `admin_restoran`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `restoran`
--
ALTER TABLE `restoran`
  MODIFY `restoran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tes`
--
ALTER TABLE `tes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tutorial`
--
ALTER TABLE `tutorial`
  MODIFY `tutorial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_restoran`
--
ALTER TABLE `admin_restoran`
  ADD CONSTRAINT `admin_restoran_ibfk_1` FOREIGN KEY (`restoran_id`) REFERENCES `restoran` (`restoran_id`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`restoran_id`) REFERENCES `restoran` (`restoran_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`paymentId`) REFERENCES `payments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tutorial`
--
ALTER TABLE `tutorial`
  ADD CONSTRAINT `tutorial_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
