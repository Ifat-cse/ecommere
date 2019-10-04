-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2018 at 08:40 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `menzcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `date_added` varchar(900) COLLATE latin1_general_ci NOT NULL,
  `Token` varchar(2000) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `date_added`, `Token`) VALUES
(1, 'admin', 'adhar12', '21/10/18', 'qf7bQqTD7ctBtujV');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `Id` int(11) NOT NULL,
  `Name` varchar(900) COLLATE latin1_general_ci NOT NULL,
  `Email` varchar(900) COLLATE latin1_general_ci NOT NULL,
  `Number` varchar(90) COLLATE latin1_general_ci NOT NULL,
  `Message` varchar(9000) COLLATE latin1_general_ci NOT NULL,
  `admin_read` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`Id`, `Name`, `Email`, `Number`, `Message`, `admin_read`) VALUES
(14, 'Israt shorna', 'Shorna@gmail.com', '01759865345', 'I want to exchange one products. please contact with me as soon as possible', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_information`
--

CREATE TABLE `contact_information` (
  `address` text NOT NULL,
  `address2` text NOT NULL,
  `mobile1` varchar(90) NOT NULL,
  `mobile2` varchar(90) NOT NULL,
  `mobile3` varchar(90) NOT NULL,
  `phone` varchar(90) NOT NULL,
  `email` varchar(90) NOT NULL,
  `facebook` varchar(900) DEFAULT NULL,
  `twitter` varchar(900) DEFAULT NULL,
  `instagram` varchar(900) DEFAULT NULL,
  `linkedin` varchar(900) NOT NULL,
  `googleplus` varchar(900) DEFAULT NULL,
  `gmail` varchar(900) DEFAULT NULL,
  `youtube` varchar(900) DEFAULT NULL,
  `yahoo` varchar(900) DEFAULT NULL,
  `skype` varchar(900) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_information`
--

INSERT INTO `contact_information` (`address`, `address2`, `mobile1`, `mobile2`, `mobile3`, `phone`, `email`, `facebook`, `twitter`, `instagram`, `linkedin`, `googleplus`, `gmail`, `youtube`, `yahoo`, `skype`) VALUES
('Road: 10, Sector: 10, Uttara, Dhaka-1230', '', '01680419682', '01709768008', '', '', 'info@M3nzcart.com', 'https://www.facebook.com/Weird0o', '', '', '', '', 'cse.ifat17@gmail.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `page_contents`
--

CREATE TABLE `page_contents` (
  `id` int(11) NOT NULL,
  `page` varchar(99) NOT NULL,
  `header` varchar(900) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_contents`
--

INSERT INTO `page_contents` (`id`, `page`, `header`, `content`) VALUES
(1, 'about-us', '', ''),
(3, 'term-and-condition', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `procat`
--

CREATE TABLE `procat` (
  `id` int(11) NOT NULL,
  `main` varchar(90) NOT NULL,
  `main_bn` varchar(900) DEFAULT NULL,
  `sub` varchar(90) NOT NULL,
  `header` varchar(900) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `procat`
--

INSERT INTO `procat` (`id`, `main`, `main_bn`, `sub`, `header`, `position`) VALUES
(198, 'pants', '', 'ectasy', 'bangladeshi', 2),
(192, 'shirt', '', 'ectasy', 'bangladeshi', 1),
(205, 'shirt', '', 'freeland', 'bangladeshi', 1),
(200, 'pants', 'pants', 'pants', 'pants', 2),
(207, 'pants', 'pants', 'pants', 'pants', 0),
(208, 'shoes', 'shoes', 'shoes', 'shoes', 0),
(195, 'pants', 'pants', 'pants', 'pants', 2),
(202, 'shoes', '', 'apex', 'bangladeshi', 3),
(206, 'shirt', 'shirt', 'shirt', 'shirt', 0),
(197, 'pants', '', 'freeland', 'bangladeshi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(900) NOT NULL,
  `category` varchar(900) NOT NULL,
  `subcategory` varchar(900) NOT NULL,
  `brand` varchar(90) NOT NULL,
  `size` varchar(90) NOT NULL,
  `colors` varchar(9000) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `images` varchar(900) NOT NULL,
  `date_added` date DEFAULT NULL,
  `item_left` int(11) NOT NULL,
  `others` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `subcategory`, `brand`, `size`, `colors`, `description`, `price`, `views`, `discount`, `images`, `date_added`, `item_left`, `others`) VALUES
(100107, 'Apex formal1', 'shoes', 'apex', 'Apex', '', '', '<p>Stay cool stay Formal</p>', 4500, 0, 4, '1', '2018-11-21', 3, NULL),
(100108, 'casual 1', 'shirt', 'ectasy', 'Ectasy', 'S,M,L', '', '<p>Be casual</p>', 2300, 0, 4, '1', '2018-12-20', 15, NULL),
(100112, 'Formal Shoes', 'shoes', 'apex', 'Apex', '', '', '<p>Stay elegant&nbsp;</p>', 4500, 0, 0, '1', '2018-11-21', 17, NULL),
(100110, 'Casual Shirt', 'shirt', 'freeland', 'Freeland', 'XS,S,M,L', '', '<p>Stay casual</p>', 1700, 0, 9, '1', '2018-12-06', 9, NULL),
(100111, 'Formal Shoe', 'shoes', 'apex', 'Apex', '', '', '<p>Be elegant&nbsp;</p>', 5000, 0, 0, '1', '2018-11-21', 47, NULL),
(100113, 'Jeans by Tanjim', 'pants', 'ectasy', 'Ectasy', 'S,M,L', '', '<p>Tanjim biker Ripped &nbsp;jean</p>', 2700, 0, 0, '1', '2018-11-22', 12, NULL),
(100114, 'Tanjim versatile ', 'pants', 'ectasy', 'Ectasy', 'S,M,L,XL', '', '<p>Jeans</p>', 1950, 0, 121, '1', '2018-11-22', 10, NULL),
(100116, 'Freeland Casual', 'shirt', 'freeland', 'Freeland', 'S,M,L,XL,XXL', '', '<p>stay bold</p>', 1650, 0, 0, '1', '2018-12-20', 35, NULL),
(100106, 'Jeans', 'pants', 'freeland', 'Ectasy', 'XS,S,M', '', '<p>Buy it</p>', 2450, 0, 6, '1', '2018-11-15', 45, NULL),
(100115, 'Shirt-1', 'shirt', 'ectasy', 'Ectasy', 'S,M,L,XL', '', '<p>casual</p>', 1445, 0, 0, '1', '2018-12-06', 9, NULL),
(100117, 'Ecstasy pants', 'pants', 'ectasy', 'Ectasy', 'S,M,L,XL', '', '<p>Stay cool</p>', 25499, 0, 0, '1', '2018-12-13', 14, NULL),
(100118, 'Freeland casual', 'shirt', 'freeland', 'Freeland', 'S,M,L,XL,XXL', '', '<p>be cool</p>', 1500, 0, 3, '1', '2018-12-13', 19, NULL),
(100119, 'Ecstasy Casual', 'shirt', 'ectasy', 'Ectasy', 'S,M,L,XL,XXL', '', 'tanjim cool', 2250, 0, 3, '1', '2018-12-13', 14, NULL),
(100120, 'Tanjim shirt', 'shirt', 'ectasy', 'Ectasy', 'S,M,L,XL,XXL', '', '<p>By Ecstasy&nbsp;</p>', 1850, 0, 0, '1', '2018-12-13', 18, NULL),
(100121, 'Freeland Denim', 'shirt', 'freeland', 'Freeland', 'S,M,L,XL', '', '<p>Stay &nbsp;cool</p>', 2100, 0, 0, '1', '2018-12-13', 16, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_comments`
--

CREATE TABLE `product_comments` (
  `id` int(11) NOT NULL,
  `name` varchar(900) NOT NULL,
  `email` varchar(90) NOT NULL,
  `message` text NOT NULL,
  `prid` int(11) NOT NULL,
  `admin_read` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_comments`
--

INSERT INTO `product_comments` (`id`, `name`, `email`, `message`, `prid`, `admin_read`) VALUES
(11, 'Israt shorna', 'shorna@gmail.com', 'I like the color of this shirt. also satisfy with the service of menzcart', 100110, 0);

-- --------------------------------------------------------

--
-- Table structure for table `p_order`
--

CREATE TABLE `p_order` (
  `id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `date` varchar(90) NOT NULL,
  `name` varchar(900) DEFAULT NULL,
  `phone` varchar(90) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `address` text NOT NULL,
  `shipment` varchar(99) DEFAULT NULL,
  `payment` varchar(99) NOT NULL,
  `payment_number` varchar(99) DEFAULT NULL,
  `payment_trxn_id` varchar(99) DEFAULT NULL,
  `pr_id` varchar(9000) NOT NULL,
  `pr_size` varchar(9000) NOT NULL,
  `pr_qty` varchar(9000) NOT NULL,
  `pr_color` varchar(9000) NOT NULL,
  `admin_read` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_order`
--

INSERT INTO `p_order` (`id`, `order_no`, `date`, `name`, `phone`, `email`, `address`, `shipment`, `payment`, `payment_number`, `payment_trxn_id`, `pr_id`, `pr_size`, `pr_qty`, `pr_color`, `admin_read`) VALUES
(91, 16915, '21-11-2018', 'arif Ifat', '01709768008', 'darkefrad@gmail.com', 'uttara sector 10 road 10 house 23, Dhaka, Dhaka', 'Normal', 'cod', '', '', '100105,100110,100107,100108', 'S,M,N/A,L', '1,1,1,1', 'N/A,N/A,N/A,N/A', 2),
(101, 59420, '26-11-2018', 'Guest', '0175534343', '', 'uttara', 'Normal', 'cod', '', '', '100105,100110', 'M,S', '2,1', 'N/A,N/A', 2),
(102, 46840, '26-11-2018', 'Guest', '0175534343', '', 'uttara', 'Normal', 'cod', '', '', '100105,100110', 'M,S', '2,1', 'N/A,N/A', 2),
(103, 79826, '26-11-2018', 'Guest', '0175534343', '', 'uttara', 'Normal', 'cod', '', '', '100105,100110', 'M,S', '2,1', 'N/A,N/A', 2),
(104, 63651, '27-11-2018', 'Guest', '0175534343', '', 'uttara', 'Normal', 'cod', '', '', '100110', 'M', '1', 'N/A', 2),
(105, 76296, '27-11-2018', 'Guest', '01680419688', '', 'malibag', 'Normal', 'cod', '', '', '100110', 'M', '1', 'N/A', 2),
(106, 85430, '27-11-2018', 'Guest', '01680419688', '', 'kamarpara', 'Normal', 'cod', '', '', '100110', 'M', '1', 'N/A', 2),
(107, 41402, '27-11-2018', 'Guest', '01680419682', '', 'tongi', 'Normal', 'cod', '', '', '100107', 'N/A', '1', 'N/A', 2),
(108, 88448, '09-12-2018', 'amiruzzaman munna', '21212121212121', 'munna@gmail.com', 'dsfsdfsdf, Gazipur, Dhaka', 'Normal', 'cod', '', '', '100106', 'N/A', '1', 'N/A', 2),
(109, 10201, '09-12-2018', 'amiruzzaman munna', '21212121212121', 'munna@gmail.com', 'dsfsdfsdf, Gazipur, Dhaka', 'Normal', 'cod', '', '', '100106', 'S', '1', 'N/A', 2),
(110, 81214, '16-12-2018', 'Guest', '01786573453', '', 'uttara sector 6', 'Normal', 'cod', '', '', '100110', 'S', '1', 'N/A', 2),
(111, 21903, '16-12-2018', 'Guest', '01680419682', '', 'kamarpara', 'Normal', 'cod', '', '', '100116', 'M', '1', 'N/A', 2),
(112, 23123, '17-12-2018', 'naimul ferdous', '01683541038', 'naimul@gmail.com', 'kamarpara uttara, Dhaka, Dhaka', 'Normal', 'cod', '', '', '100120,100119', 'S,S', '1,1', 'N/A,N/A', 2),
(113, 80400, '17-12-2018', 'naimul ferdous', '01683541038', 'naimul@gmail.com', 'kamarpara uttara, Dhaka, Dhaka', 'Normal', 'cod', '', '', '100110', 'S', '1', 'N/A', 2),
(114, 70456, '17-12-2018', 'naimul ferdous', '01683541038', 'naimul@gmail.com', 'kamarpara uttara, Dhaka, Dhaka', 'Normal', 'cod', '', '', '100110', 'S', '1', 'N/A', 2),
(115, 70031, '17-12-2018', 'naimul ferdous', '01683541038', 'naimul@gmail.com', 'kamarpara uttara, Dhaka, Dhaka', 'Normal', 'cod', '', '', '100113', 'M', '1', 'N/A', 2),
(116, 19154, '18-12-2018', 'Guest', '01680419682', '', 'lmi', 'Normal', 'cod', '', '', '100110', 'S', '1', 'N/A', 2),
(117, 40269, '19-12-2018', 'Guest', '015436358', '', 'kamarapara', 'Normal', 'cod', '', '', '100106,100119', 'S,M', '1,1', 'N/A,N/A', 2),
(118, 30498, '19-12-2018', 'Sahiduzzaman Shuvo', '01674398765', 'Shuvo@gmail.com', 'Narshingdi, Narshindi, Dhaka', 'Normal', 'cod', '', '', '100110,100107,100106', 'S,N/A,M', '1,2,1', 'N/A,N/A,N/A', 2),
(119, 25613, '20-12-2018', 'Guest', '6566454', '', 'vhyhftft', 'Normal', 'cod', '', '', '100119', 'M', '1', 'N/A', 2),
(120, 30813, '20-12-2018', 'Arfan Bappy', '01765456786', 'bappi@gmail.com', 'uttara sector7, Dhaka, Dhaka', 'Normal', 'cod', '', '', '100110,100106,100107,100115,100116', 'S,S,N/A,S,M', '1,1,1,1,1', 'N/A,N/A,N/A,N/A,N/A', 2),
(121, 76050, '20-12-2018', 'Arfan Bappy', '01765456786', 'bappi@gmail.com', 'uttara sector7, Dhaka, Dhaka', 'Normal', 'bkash', '01709768008', '1234', '100112,100111,100107', 'N/A,N/A,N/A', '1,1,1', 'N/A,N/A,N/A', 2),
(122, 19896, '20-12-2018', 'Israt Shorna', '01732656757', 'Shorna@gmail.com', 'ashulia, Dhaka, Dhaka', 'Normal', 'rocket', '01709768008', '345', '100119,100113,100116,100112,100111', 'M,M,M,N/A,N/A', '1,1,1,1,1', 'N/A,N/A,N/A,N/A,N/A', 2),
(123, 35149, '20-12-2018', 'hardev saha', '01456743234', 'hardev@gmail.com', 'mogbazar, Dhaka, Dhaka', 'Normal', 'cod', '', '', '100121,100120,100119,100118,100108,100113', 'M,L,L,L,M,N/A', '1,1,1,1,1,1', 'N/A,N/A,N/A,N/A,N/A,N/A', 2),
(124, 20291, '20-12-2018', 'Sazzad hossain', '015234567854', 'sazzad@gmail.com', 'pabna, Pabna, Rajshahi', 'Normal', 'cod', '', '', '100110,100106', 'S,S', '1,1', 'N/A,N/A', 2),
(125, 50167, '20-12-2018', 'Sazzad hossain', '015234567854', 'sazzad@gmail.com', 'pabna, Pabna, Rajshahi', 'Normal', 'cod', '', '', '100121', 'L', '1', 'N/A', 2),
(126, 22769, '20-12-2018', 'Fahad Islam Auni', '01712487654', 'Auni@gmail.com', 'uttara sector 5, Dhaka, Dhaka', 'Normal', 'cod', '', '', '100111,100119', 'N/A,S', '1,1', 'N/A,N/A', 2),
(127, 78385, '20-12-2018', 'Riaz ul', '0184654765', 'riaz@gmail.com', 'Madaripur, Madaripur, Dhaka', 'Normal', 'rocket', '01840066612', '12', '100112', 'N/A', '1', 'N/A', 2),
(128, 23778, '20-12-2018', 'Sahiduzzaman Shuvo', '01674398765', 'Shuvo@gmail.com', 'Narshingdi, Narshindi, Dhaka', 'Normal', 'cod', '', '', '100107', 'N/A', '3', 'N/A', 2),
(129, 82575, '20-12-2018', 'amiruzzaman munna', '0175534343', 'munna@gmail.com', 'gazipur, Gazipur, Dhaka', 'Normal', 'cod', '', '', '100107', 'N/A', '1', 'N/A', 2);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `title` varchar(900) NOT NULL,
  `page_view` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`title`, `page_view`) VALUES
('Home || M3nzcart.comà¥¤à¥¤ Bangladeshi Popular Online Shop ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image` varchar(900) DEFAULT NULL,
  `image_heading` varchar(900) DEFAULT NULL,
  `image_text1` varchar(900) DEFAULT NULL,
  `image_text2` varchar(900) DEFAULT NULL,
  `image_text3` varchar(900) DEFAULT NULL,
  `image_link` varchar(900) DEFAULT NULL,
  `heading_link` varchar(900) DEFAULT NULL,
  `text1_link` varchar(900) DEFAULT NULL,
  `text2_link` varchar(900) DEFAULT NULL,
  `text3_link` varchar(900) DEFAULT NULL,
  `page` varchar(900) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `image_heading`, `image_text1`, `image_text2`, `image_text3`, `image_link`, `heading_link`, `text1_link`, `text2_link`, `text3_link`, `page`, `position`) VALUES
(57, 'images/slider/images.jpg?1222259157.415', 'Casual Trouser and Jeans', 'Stay Casual', '', 'Shop now', '', '', '', '', 'http://localhost/m3nzcart/products/pants/all', 'index', 1),
(17, 'images/slider/Shoes-and-Bags-Cleaning-Dubai-by-Primavera-Palm-Jumeirah.jpeg?1222259157.415', '', '', '', '', '', '', '', '', '', 'index', 3),
(36, 'images/slider/vlcsnap-2018-05-04-10h51m13s112.jpg?1222259157.415', '', 'Clothing', '', 'Buy', 'checkout', '', '', '', 'http://umamah.com/products/clothing/all', 'index', 8),
(33, 'images/slider/26.jpg?1222259157.415', '', 'Get rid of<br><strong> Mosquitoes</strong> <br>in best way', 'BDT25', 'Shop Now', 'cart', '', '', '', 'index', 'index', 4),
(34, 'images/slider/26.jpg?1222259157.415', '', '70% Off', 'Kitchen', 'Shop Now', 'index', '', '', '', 'cart', 'index', 5),
(35, 'images/slider/shutterstock_175947125.jpg?1222259157.415', '', 'umamah.com', 'Discover a world of contents', 'Shop Now', 'index', '', '', '', 'http://umamah.com/products/furniture/all', 'index', 6),
(56, 'images/slider/Mens-Shirts.jpg?1222259157.415', 'Cool casual collection For You', 'Colors of Life', '', 'Shop Now', '', '', '', '', 'http://localhost/m3nzcart/products/shirt/all', 'index', 1),
(59, 'images/slider/banner.shoe.png?1222259157.415', 'Men Shoes', 'Be formal Be cool', '', 'Shop Now', '', '', '', '', 'http://localhost/m3nzcart/products/shoes/all', 'index', 1),
(58, 'images/slider/Mens-Jeans-Banner.jpg?1222259157.415', 'Jeans Lover', 'Celebrate in Style', '', 'Order Now', '', '', '', '', 'http://localhost/m3nzcart/products/pants/all', 'index', 1),
(60, 'images/slider/banner.jpg?1222259157.415', 'Wear formal', 'For Every Fantasy', '', 'Buy Now', '', '', '', '', 'http://localhost/m3nzcart/products/shoes/all', 'index', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(900) NOT NULL,
  `password` varchar(90) NOT NULL,
  `token` varchar(90) NOT NULL,
  `first_name` varchar(900) NOT NULL,
  `last_name` varchar(900) NOT NULL,
  `email` varchar(900) NOT NULL,
  `address` varchar(900) NOT NULL,
  `city` varchar(900) NOT NULL,
  `district` varchar(900) NOT NULL,
  `postalcode` varchar(900) NOT NULL,
  `mobile_number` varchar(900) NOT NULL,
  `wishlists` varchar(900) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `token`, `first_name`, `last_name`, `email`, `address`, `city`, `district`, `postalcode`, `mobile_number`, `wishlists`) VALUES
(26, 'efraddark@yahoo.com', '2345', 'WadQ3seDrCGYvuJs', 'efat', 'adhar', 'efraddark@yahoo.com', 'uttara sector 11', 'Dhaka', 'Dhaka', '', '017562242423', ''),
(25, 'darkefrad@gmail.com', '1234', '0R3njoKfwbagBvrs', 'arif', 'Ifat', 'darkefrad@gmail.com', 'uttara sector 10 road 10 house 23', 'Dhaka', 'Dhaka', '', '01709768008', ''),
(27, 'munna@gmail.com', '111111', 'oUN1h8GQYOlEDOCr', 'amiruzzaman', 'munna', 'munna@gmail.com', 'gazipur', 'Dhaka', 'Gazipur', '', '0175534343', ''),
(28, 'mithun@gmail.com', 'mithun12', '3kgixB7vHhgzDgxW', 'Tofa', 'Mithun', 'mithun@gmail.com', 'uttara sector12', 'Dhaka', 'Dhaka', '', '01676244848', ''),
(29, 'mobarak@gmail.com', 'mobarak123', '2sZdT2CyGxgpikMr', 'Mo', 'barak', 'mobarak@gmail.com', 'kamarpara', 'Dhaka', 'Dhaka', '', '01823456567', ''),
(30, 'Shorna@gmail.com', 'shorna123', '565QWTEVmTEgp8ft', 'Israt', 'Shorna', 'Shorna@gmail.com', 'ashulia', 'Dhaka', 'Dhaka', '', '01732656757', ''),
(31, 'bappi@gmail.com', 'bappy123', 'cccezfk00wCiJTJJ', 'Arfan', 'Bappy', 'bappi@gmail.com', 'uttara sector7', 'Dhaka', 'Dhaka', '', '01765456786', ''),
(32, 'naimul@gmail.com', 'naimul12', 'eP0i4PGTEnMZrt7L', 'naimul', 'ferdous', 'naimul@gmail.com', 'kamarpara uttara', 'Dhaka', 'Dhaka', '', '01683541038', ''),
(33, 'bappii@gmail.com', 'bappi12', 'ogH5cXMHd0oHitSR', 'arfan', 'bappi', 'bappii@gmail.com', 'kishorgonj', 'Dhaka', 'Kishoreganj', '', '01686247357', ''),
(34, 'rifat@gmail.com', 'rifat12', 'YOdxWDAzDR3Md66N', 'Ri', 'fat', 'rifat@gmail.com', 'comilla', 'Chittagong', 'Comilla', '', '0178654325', ''),
(35, 'hardev@gmail.com', 'hardev12', 'CLRdYYOMvHX8fTZd', 'hardev', 'saha', 'hardev@gmail.com', 'mogbazar', 'Dhaka', 'Dhaka', '', '01456743234', ''),
(36, 'sazzad@gmail.com', 'sazzad12', 'o7bmbRFDbBZ738lo', 'Sazzad', 'hossain', 'sazzad@gmail.com', 'pabna', 'Rajshahi', 'Pabna', '', '015234567854', ''),
(37, 'Auni@gmail.com', 'auni12', 'YXNdEzFxZg180KtV', 'Fahad', 'Islam Auni', 'Auni@gmail.com', 'uttara sector 5', 'Dhaka', 'Dhaka', '', '01712487654', ''),
(38, 'riaz@gmail.com', 'riaz12', 'lXhLxLwmTCSQzLph', 'Riaz', 'ul', 'riaz@gmail.com', 'Madaripur', 'Dhaka', 'Madaripur', '', '0184654765', ''),
(39, 'Shuvo@gmail.com', 'shuvo12', '1FbrCXZp0Egnpowu', 'Sahiduzzaman', 'Shuvo', 'Shuvo@gmail.com', 'Narshingdi', 'Dhaka', 'Narshindi', '', '01674398765', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `page_contents`
--
ALTER TABLE `page_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procat`
--
ALTER TABLE `procat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_comments`
--
ALTER TABLE `product_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_order`
--
ALTER TABLE `p_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `procat`
--
ALTER TABLE `procat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `product_comments`
--
ALTER TABLE `product_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `p_order`
--
ALTER TABLE `p_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
