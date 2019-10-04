-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2018 at 05:21 PM
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
-- Database: `ecommerce`
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
(1, 'admin', 'adhar12', '21/11/17', 'qf7bQqTD7ctBtujV'),
(3, 'mh', 'adminmh', '27/11/2017', 'U9m2rcIbdGnGhDa3');

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
('Road: 10, Sector: 10, Uttara, Dhaka-1230', '', '01680419682', '01709768008', '', '', 'info@M3nzcart.com', 'https://www.facebook.com/Weird0o', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `username` varchar(90) NOT NULL,
  `coupon` varchar(900) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `username`, `coupon`, `discount`) VALUES
(1, 'test@mail.com', 'asdfg', 12);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(99) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`) VALUES
(9, 'darkefrad@gmail.com');

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
(100107, 'Apex formal1', 'shoes', 'apex', 'Apex', '', '', '<p>Stay cool stay Formal</p>', 4500, 0, 4, '1', '2018-11-21', 10, NULL),
(100108, 'casual 1', 'shirt', 'ectasy', 'Ectasy', 'S,M,L', '', '<p>Be casual</p>', 2300, 0, 4, '1', '2018-11-21', 13, NULL),
(100112, 'Formal Shoes', 'shoes', 'apex', 'Apex', '', '', '<p>Stay elegant&nbsp;</p>', 4500, 0, 0, '1', '2018-11-21', 20, NULL),
(100110, 'Casual Shirt', 'shirt', 'freeland', 'Freeland', 'XS,S,M,L', '', '<p>Stay casual</p>', 1700, 0, 9, '1', '2018-11-21', 20, NULL),
(100111, 'Formal Shoe', 'shoes', 'apex', 'Apex', '', '', '<p>Be elegant&nbsp;</p>', 5000, 0, 0, '1', '2018-11-21', 50, NULL),
(100113, 'Jeans by Tanjim', 'pants', 'ectasy', 'Ectasy', 'S,M,L', '', '<p>Tanjim biker Ripped &nbsp;jean</p>', 2700, 0, 0, '1', '2018-11-22', 15, NULL),
(100114, 'Tanjim versatile ', 'pants', 'ectasy', 'Ectasy', 'S,M,L,XL', '', '<p>Jeans</p>', 1950, 0, 121, '1', '2018-11-22', 10, NULL),
(100105, 'Shirt-1', 'shirt', 'ectasy', 'Ectasy', 'S,M,L,XL', '', '<p>Testing</p>', 1799, 0, 10, '1', '2018-11-21', 5, NULL),
(100106, 'Jeans', 'pants', 'freeland', 'Ectasy', 'XS,S,M', '', '<p>Buy it</p>', 2450, 0, 6, '1', '2018-11-15', 51, NULL);

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
(91, 16915, '21-11-2018', 'arif Ifat', '01709768008', 'darkefrad@gmail.com', 'uttara sector 10 road 10 house 23, Dhaka, Dhaka', 'Normal', 'cod', '', '', '100105,100110,100107,100108', 'S,M,N/A,L', '1,1,1,1', 'N/A,N/A,N/A,N/A', 1),
(93, 81979, '21-11-2018', 'efat adhar', '017562242423', 'efraddark@yahoo.com', 'uttara sector 11, Dhaka, Dhaka', 'Normal', 'cod', '', '', '100108,100108', 'M,S', '1,1', 'N/A,N/A', 2);

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
(32, 'images/slider/jewelry.jpg?1222259157.415', '', '', '', '', 'index', '', '', '', '', 'index', 2),
(57, 'images/slider/images.jpg?1222259157.415', 'Casual Trouser and Jeans', 'Stay Casual', '', 'Shop now', '', '', '', '', '', 'index', 1),
(17, 'images/slider/Shoes-and-Bags-Cleaning-Dubai-by-Primavera-Palm-Jumeirah.jpeg?1222259157.415', '', '', '', '', '', '', '', '', '', 'index', 3),
(36, 'images/slider/vlcsnap-2018-05-04-10h51m13s112.jpg?1222259157.415', '', 'Clothing', '', 'Buy', 'checkout', '', '', '', 'http://umamah.com/products/clothing/all', 'index', 8),
(33, 'images/slider/26.jpg?1222259157.415', '', 'Get rid of<br><strong> Mosquitoes</strong> <br>in best way', 'BDT25', 'Shop Now', 'cart', '', '', '', 'index', 'index', 4),
(34, 'images/slider/26.jpg?1222259157.415', '', '70% Off', 'Kitchen', 'Shop Now', 'index', '', '', '', 'cart', 'index', 5),
(35, 'images/slider/shutterstock_175947125.jpg?1222259157.415', '', 'umamah.com', 'Discover a world of contents', 'Shop Now', 'index', '', '', '', 'http://umamah.com/products/furniture/all', 'index', 6),
(56, 'images/slider/Mens-Shirts.jpg?1222259157.415', 'Cool casual collection For You', 'Colors of Life', '', 'Shop Now', '', '', '', '', 'Buy now', 'index', 1),
(59, 'images/slider/banner.shoe.png?1222259157.415', 'Men Shoes', 'Be formal Be cool', '', 'Shop Now', '', '', '', '', 'http://shoppy71.com/products/jewelry/jewelry/all', 'index', 1),
(55, 'images/slider/banner.jeans.jpg?1222259157.415', 'Men Shirt', 'Formal or Casual', '', 'Shop Now', '', '', '', '', 'Exclusively on M3NZCART ', 'index', 1),
(58, 'images/slider/Mens-Jeans-Banner.jpg?1222259157.415', 'Jeans Lover', 'Celebrate in Style', '', 'Order Now', '', '', '', '', 'http://shoppy71.com/products/jewelry/jewelry/all', 'index', 1),
(60, 'images/slider/banner.jpg?1222259157.415', 'Wear formal', 'For Every Fantasy', '', 'Buy Now', '', '', '', '', 'http://shoppy71.com/products/jewelry/jewelry/all', 'index', 1);

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
(25, 'darkefrad@gmail.com', '1234', '0R3njoKfwbagBvrs', 'arif', 'Ifat', 'darkefrad@gmail.com', 'uttara sector 10 road 10 house 23', 'Dhaka', 'Dhaka', '', '01709768008', '');

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
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `p_order`
--
ALTER TABLE `p_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
