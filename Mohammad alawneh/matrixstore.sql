-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2020 at 10:05 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matrixstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `add_id` int(5) NOT NULL,
  `country` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `sr_name` varchar(50) NOT NULL,
  `bil_num` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`add_id`, `country`, `city`, `sr_name`, `bil_num`) VALUES
(40, 'Jordan', 'amman', 'King Abdullah', 1030),
(42, 'England', 'amman', 'King Abdullah', 1030),
(43, 'England', 'amman', 'King Abdullah', 1030);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ad_id` int(4) NOT NULL,
  `ad_fname` varchar(32) NOT NULL,
  `ad_mname` varchar(32) NOT NULL,
  `ad_lname` varchar(32) NOT NULL,
  `ad_email` varchar(75) NOT NULL,
  `ad_pass` varchar(100) NOT NULL,
  `ad_img` varchar(100) NOT NULL,
  `ad_phone` varchar(20) NOT NULL,
  `ad_address` varchar(100) NOT NULL,
  `ad_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ad_id`, `ad_fname`, `ad_mname`, `ad_lname`, `ad_email`, `ad_pass`, `ad_img`, `ad_phone`, `ad_address`, `ad_status`) VALUES
(3, 'Jameel', 'Deeb', 'alawneh', 'mohammadmalawneh@gmail.com', '0799823683', 'mohammad\'salawnehPhoto.jpeg', '0799823683', 'Irbid Jordan', 1),
(5, 'momen', 'mamon', 'alawneh', 'mones.alawneh@gmail.com', '0799823683', '1600681429rp3.jpg', '0799823683', 'Karak-Jordan', 0),
(7, 'Kamel', 'Ameen', 'thabet', 'Kamel.thabet@gmail.com', '0799823683', '1600440211rp4.jpg', '0799823683', 'Irbid-Jordan', 1),
(11, 'Saif aldeen', 'Ibrahim', 'Alawneh', 'saif.alawneh@gmail.com', '0799823683', '1601468966DBdesign.png', '0776219747', 'maldifs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ad_privileges`
--

CREATE TABLE `ad_privileges` (
  `ad_id` int(4) NOT NULL,
  `privileges` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ad_privileges`
--

INSERT INTO `ad_privileges` (`ad_id`, `privileges`) VALUES
(11, 6),
(11, 7),
(3, 1),
(3, 2),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 3),
(7, 6),
(7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `bigcat`
--

CREATE TABLE `bigcat` (
  `bigcat_id` int(3) NOT NULL,
  `bigcat_name` varchar(100) NOT NULL,
  `bigcat_img` varchar(100) NOT NULL,
  `bigcat_sta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bigcat`
--

INSERT INTO `bigcat` (`bigcat_id`, `bigcat_name`, `bigcat_img`, `bigcat_sta`) VALUES
(1, 'Clothes', '16008034561.jpg', 1),
(2, 'Shoses', '1600799594feature_3.png', 1),
(3, 'Perfumes', '1600799784IL201906061151574833.jpg', 1),
(4, 'Electronics', '1600799836colorful-wireless-technology-objects-set_1284-36282.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `br_id` int(5) NOT NULL,
  `br_name` varchar(100) NOT NULL,
  `br_img` varchar(100) NOT NULL,
  `br_sta` int(11) NOT NULL,
  `bigcat_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`br_id`, `br_name`, `br_img`, `br_sta`, `bigcat_id`) VALUES
(1, 'VERSACE', '', 1, 1),
(2, 'BURBURRY', '', 1, 1),
(3, 'RALPH LAURAEN', '', 1, 1),
(4, 'CHANEL', '', 1, 1),
(5, 'PRADA', '', 1, 1),
(6, 'GUCCI', '', 1, 1),
(8, 'NIKE', '', 1, 2),
(9, 'ADDIDAS', '', 1, 2),
(10, 'NIKE', '', 1, 2),
(11, 'JORDAN', '', 1, 2),
(12, 'REEBOK', '', 1, 2),
(13, 'VANS', '', 1, 2),
(14, 'CONVERSE', '', 1, 2),
(16, 'CHANEL', '', 1, 3),
(17, 'DIOR', '', 1, 3),
(18, 'VERSACE', '', 1, 3),
(19, 'ARMANI', '', 1, 3),
(20, 'DOCE & GABBANA', '', 1, 3),
(21, 'GUCCI', '', 1, 3),
(22, 'Dell', '', 1, 4),
(23, 'Samsung', '', 1, 4),
(24, 'Toshipa', '', 1, 4),
(27, 'HP', '1600607570blog1.jpg', 1, 4),
(29, 'BTS', '16008127763.jpg', 1, 1),
(30, 'Puma', '16009642759.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cos_id` int(7) NOT NULL,
  `cos_fname` varchar(32) NOT NULL,
  `cos_mname` varchar(32) NOT NULL,
  `cos_lname` varchar(32) NOT NULL,
  `cos_email` varchar(100) NOT NULL,
  `cos_pass` varchar(100) NOT NULL,
  `cos_mobile` varchar(15) NOT NULL,
  `cos_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cos_id`, `cos_fname`, `cos_mname`, `cos_lname`, `cos_email`, `cos_pass`, `cos_mobile`, `cos_status`) VALUES
(1, 'mohammad', 'Jameel', 'alawneh', 'mohammadmalawneh@gmail.com', '0mLbgHaiTuEuGj', '0776219747', 1),
(4, 'saif', 'Ibrahem', 'alawneh', 'saif.alawneh@gmail.com', '0776219747', '07762197478', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `or_id` int(9) NOT NULL,
  `or_date` date NOT NULL,
  `cos_id` int(7) NOT NULL,
  `add_id` int(11) NOT NULL,
  `total` decimal(6,2) NOT NULL,
  `or_notes` varchar(500) NOT NULL,
  `or_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`or_id`, `or_date`, `cos_id`, `add_id`, `total`, `or_notes`, `or_status`) VALUES
(24, '2020-09-29', 1, 42, '177.50', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `or_det`
--

CREATE TABLE `or_det` (
  `order_d_id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `pro_id` int(7) NOT NULL,
  `pro_price` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `or_det`
--

INSERT INTO `or_det` (`order_d_id`, `order_id`, `pro_id`, `pro_price`) VALUES
(100, 24, 28, '25.00'),
(101, 24, 31, '25.00'),
(102, 24, 32, '30.00'),
(103, 24, 33, '40.00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` int(6) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `pro_desc` varchar(300) NOT NULL,
  `pro_price` decimal(4,2) NOT NULL,
  `pro_descount` int(11) NOT NULL,
  `pro_qty` int(4) NOT NULL,
  `br_id` int(5) NOT NULL,
  `bigcat_id` int(3) NOT NULL,
  `subcat_id` int(4) NOT NULL,
  `vin_id` int(5) NOT NULL,
  `pro_sta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `pro_desc`, `pro_price`, `pro_descount`, `pro_qty`, `br_id`, `bigcat_id`, `subcat_id`, `vin_id`, `pro_sta`) VALUES
(28, 'Women\'s Kaftan Dress Elegant Lace Patchwork Long Sleeve High Waist Muslim Kaftan', '				', '25.00', 10, 45, 29, 1, 2, 1, 1),
(31, 'Women\'s Kaftan Dress Embroidery Long Sleeve Stand Collar Muslim Arabian Clothing', '				', '25.00', 0, 36, 29, 1, 2, 1, 1),
(32, 'Women\'s Kaftan Dress Flare Sleeve High Waist Fashion Arabian Clothing', '					', '30.00', 0, 29, 29, 1, 2, 1, 1),
(33, 'Women\'s Kaftan Dress Loose Batwing Sleeve Applique Muslim Arabian Clothing', '					', '40.00', 0, -4, 29, 1, 2, 1, 1),
(34, 'Women\'s A Line Dress Polka Dot Lantern Sleeve Elastic Waist Casual Long Dress', '	\r\n									', '10.00', 0, 993, 29, 1, 2, 1, 1),
(35, 'MUZDAN Men\'s Thob With Classic Collar And One Button Cuffs', '	\r\n									', '65.00', 0, 993, 29, 1, 1, 1, 1),
(36, 'Men\'s Cardigan Plaid Striped Button Fashion Knitwear', '	\r\n									', '10.00', 0, 100, 29, 1, 1, 1, 1),
(38, 'Mens Cardigan Zipper Gingham Stand Collar Knitwear', '	\r\n									', '19.00', 0, 100, 29, 1, 1, 1, 1),
(39, 'Men\'s Cardigan Casual Solid Color Long Sleeve Knitwear', '	\r\n									', '15.00', 0, 96, 29, 1, 1, 1, 1),
(40, 'Men\'s Cardigan Long Sleeve Solid Fashion Slim Knitwear', '	\r\n									', '21.00', 0, 100, 29, 1, 1, 1, 1),
(41, 'Men\'s Cardigan Stand Collar Patchwork Zipper Knitwear', '	\r\n									', '15.00', 0, 25, 29, 1, 1, 1, 1),
(42, 'Teen Boy\'s 2 Pieces Pants Set Long Sleeve Patchwork Hoodie Loose Trousers Set', '	\r\n									', '13.00', 0, 47, 29, 1, 3, 1, 1),
(43, 'Boys Boy\'s 2 Pcs Striped Pants Suit Zipper Long Sleeve Stylish Set', '	\r\n									', '20.00', 0, 100, 29, 1, 3, 1, 1),
(44, 'Teen Boy\'s 3 Pieces Tracksuit Fashion Hooded Vest Long Sleeve Wings Sweatshirt Loose Trousers Set', '	\r\n									', '65.00', 0, 100, 29, 1, 3, 1, 1),
(46, 'Boy\'s Two-Piece Tracksuit Letter Pattern Turn Down Collar Fashion Denim Coat Jeans Suit', '	\r\n									', '20.00', 0, 100, 29, 1, 3, 1, 1),
(47, 'German Lucur', '			', '10.00', 0, 96, 30, 1, 1, 1, 1),
(48, 'Long Red T-shirts', '	\r\n									', '15.00', 0, 100, 6, 1, 2, 1, 1),
(49, 'Black Long Dress', '	\r\n									', '13.00', 0, 100, 4, 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pro_img`
--

CREATE TABLE `pro_img` (
  `ID` int(15) NOT NULL,
  `pro_id` int(7) NOT NULL,
  `pro_img` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pro_img`
--

INSERT INTO `pro_img` (`ID`, `pro_id`, `pro_img`) VALUES
(1, 27, '160081434470.jpg'),
(2, 27, '1600814344733ceebd-b7c3-43f5-a803-b454d6a29977.jpg_210x280x80.jpg'),
(3, 27, '1600814344b8559dd4-c884-42f7-a775-60d00af2a2ff.jpg_210x280x80.jpg'),
(4, 27, '1600814344c34c26bd-fba4-4351-ab36-ced8c4caaa0c.jpg_210x280x80.jpg'),
(5, 28, '160081471345.jpg'),
(6, 28, '160081471380.jpg'),
(7, 28, '160081471383.jpg'),
(8, 28, '1600814714x80.jpg'),
(17, 31, '160081518763ce837d-76cc-4ba4-bafd-cf0f44e17330.jpg_210x280x80.jpg'),
(18, 31, '160081518783f70ea8-512e-4283-a2dd-c38d4c0a679d.jpg_210x280x80.jpg'),
(19, 31, '160081518725662b55-577c-4589-9ef3-5b4fb7e15637.jpg'),
(20, 32, '1600815342037ad378-c679-4b8f-be6b-cad6bcbeb901.jpg_210x280x80.jpg'),
(21, 32, '160081534239276aee-c660-480e-95cf-d5c75bb64af8.jpg_210x280x80.jpg'),
(22, 32, '16008153423874482e-ddec-42b3-a2d7-e52392dedffb.jpg_210x280x80.jpg'),
(23, 33, '16008155288e9919c5-eab1-49a0-a7a4-a5c3ab0be041.jpg_210x280x80.jpg'),
(24, 33, '160081552926c7782e-93ab-4998-b10b-1980d3c59bf4.jpg_210x280x80.jpg'),
(25, 33, '160081552939dedfb7-a7fd-4819-8bb0-d09bbe30014f.jpg_210x280x80.jpg'),
(26, 33, '1600815529ec71a4d1-7c86-407c-99dd-2a7972d802d7.jpg_210x280x80.jpg'),
(27, 34, '160081569497a75d9a-8936-489f-8ac6-9d353243671e.jpg_210x280x80.jpg'),
(28, 34, '160081569440859298-2041-4ed7-914a-b9ff37a1741f.jpg_210x280x80.jpg'),
(29, 34, '1600815694fe2f0f34-7791-46d4-b6e3-0cfc0a479a35.jpg_210x280x80.jpg'),
(30, 35, '16008159210.jpg'),
(31, 35, '16008159211.jpg'),
(34, 35, '160081592212.jpg'),
(36, 36, '16008162243.jpg'),
(37, 36, '16008162247.jpg'),
(38, 36, '16008162371.jpg'),
(39, 36, '16008162373.jpg'),
(40, 36, '16008162377.jpg'),
(41, 38, '16008164031.jpg'),
(42, 38, '16008164032.jpg'),
(43, 38, '16008164033.jpg'),
(44, 38, '16008164034.jpg'),
(45, 39, '16008166196.jpg'),
(46, 40, '16008167273ad7286c-0444-429c-b757-75e6bcfa9aa1.jpg_210x280x80.jpg'),
(47, 41, '16008171653.jpg'),
(48, 41, '16008171656.jpg'),
(49, 41, '1600817165cfa8bd7a-c860-4ae6-b3ff-5bb29a837836.jpg_210x280x80.jpg'),
(50, 42, '16008176773.jpg'),
(51, 42, '16008176784.jpg'),
(52, 43, '16008180093.jpg'),
(53, 43, '16008180099.jpg'),
(54, 43, '160081800995.jpg'),
(55, 44, '16008185713.jpg'),
(56, 44, '16008186283.jpg'),
(57, 46, '160081884699.jpg'),
(58, 47, '16009643241.png'),
(59, 48, '16009662502.png'),
(60, 49, '16009663854.png'),
(61, 49, '16009664634.png');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `com_id` int(8) NOT NULL,
  `pro_id` int(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `com_name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `com_time` datetime NOT NULL,
  `com_text` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`com_id`, `pro_id`, `email`, `com_name`, `mobile`, `com_time`, `com_text`) VALUES
(1, 40, 'mohammadmalawneh@gmail.com', 'Mohammad Jameel Alawneh', '0776219747', '2020-09-23 18:49:00', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo'),
(2, 40, 'mohammadmalawneh@gmail.com', 'Mohammad Jameel Alawneh', '0776219747', '2020-09-23 18:49:00', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo'),
(5, 28, 'mohammad_kao@yahoo.com', 'anamalal', '0799823683', '2020-09-28 22:39:18', 'this product is so good'),
(6, 28, 'mohammad_kao@yahoo.com', 'anamalal', '0799823683', '2020-09-28 22:39:55', 'this product is so good'),
(7, 28, 'saif_alawneh@yahoo.com', 'Saif Ibrahim alawneh', '0799826595', '2020-09-28 22:42:25', 'Its very good Prduct');

-- --------------------------------------------------------

--
-- Table structure for table `subcat`
--

CREATE TABLE `subcat` (
  `subcat_id` int(4) NOT NULL,
  `subcat_name` varchar(50) NOT NULL,
  `subcat_sta` tinyint(1) NOT NULL,
  `bigcat_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcat`
--

INSERT INTO `subcat` (`subcat_id`, `subcat_name`, `subcat_sta`, `bigcat_id`) VALUES
(1, 'man', 1, 1),
(2, 'Women', 1, 1),
(3, 'Kids', 1, 1),
(4, 'Man', 1, 2),
(5, 'Woman', 1, 2),
(6, 'Kid', 1, 2),
(7, 'Man', 1, 3),
(8, 'Women', 1, 3),
(9, 'Kids', 1, 3),
(10, 'TV', 1, 4),
(11, 'Smart tv', 1, 4),
(12, 'Mini Laptop', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vindor`
--

CREATE TABLE `vindor` (
  `vin_id` int(5) NOT NULL,
  `vin_fname` varchar(32) NOT NULL,
  `vin_mname` varchar(32) NOT NULL,
  `vin_lname` varchar(32) NOT NULL,
  `vin_pass` varchar(100) NOT NULL,
  `vin_email` varchar(100) NOT NULL,
  `bigcat_id` int(3) NOT NULL,
  `vin_mobile` varchar(15) NOT NULL,
  `vin_img` varchar(100) NOT NULL,
  `vin_address` varchar(100) NOT NULL,
  `vin_sdate` date NOT NULL,
  `ad_id` int(4) NOT NULL,
  `vin_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vindor`
--

INSERT INTO `vindor` (`vin_id`, `vin_fname`, `vin_mname`, `vin_lname`, `vin_pass`, `vin_email`, `bigcat_id`, `vin_mobile`, `vin_img`, `vin_address`, `vin_sdate`, `ad_id`, `vin_status`) VALUES
(1, 'mamon', 'jameel', 'alawneh', '0776219747', 'mohammadmalawneh@gmail.com', 1, '0799823683', '1600684059G1.jpg', 'Amman Jordan', '2020-09-11', 5, 1),
(3, 'Jameel', 'Deeb', 'Alawneh', '0799823683', 'jameel.alawneh@gmail.com', 3, '0772211216', '1600454289bg-2.jpg', 'Sanaa Yaman', '2020-09-18', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`add_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `ad_privileges`
--
ALTER TABLE `ad_privileges`
  ADD KEY `ad_id` (`ad_id`);

--
-- Indexes for table `bigcat`
--
ALTER TABLE `bigcat`
  ADD PRIMARY KEY (`bigcat_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`br_id`),
  ADD KEY `bigcat_id` (`bigcat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cos_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`or_id`),
  ADD KEY `cos_id` (`cos_id`),
  ADD KEY `add_id` (`add_id`);

--
-- Indexes for table `or_det`
--
ALTER TABLE `or_det`
  ADD PRIMARY KEY (`order_d_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `bigcat_id` (`bigcat_id`),
  ADD KEY `br_id` (`br_id`),
  ADD KEY `subcat_id` (`subcat_id`),
  ADD KEY `vin_id` (`vin_id`);

--
-- Indexes for table `pro_img`
--
ALTER TABLE `pro_img`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `fr6_id` (`pro_id`);

--
-- Indexes for table `subcat`
--
ALTER TABLE `subcat`
  ADD PRIMARY KEY (`subcat_id`);

--
-- Indexes for table `vindor`
--
ALTER TABLE `vindor`
  ADD PRIMARY KEY (`vin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `add_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ad_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bigcat`
--
ALTER TABLE `bigcat`
  MODIFY `bigcat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `br_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cos_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `or_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `or_det`
--
ALTER TABLE `or_det`
  MODIFY `order_d_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pro_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `pro_img`
--
ALTER TABLE `pro_img`
  MODIFY `ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `com_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subcat`
--
ALTER TABLE `subcat`
  MODIFY `subcat_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vindor`
--
ALTER TABLE `vindor`
  MODIFY `vin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ad_privileges`
--
ALTER TABLE `ad_privileges`
  ADD CONSTRAINT `ad_privileges_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `admin` (`ad_id`);

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`bigcat_id`) REFERENCES `bigcat` (`bigcat_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cos_id`) REFERENCES `customer` (`cos_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`add_id`) REFERENCES `address` (`add_id`);

--
-- Constraints for table `or_det`
--
ALTER TABLE `or_det`
  ADD CONSTRAINT `or_det_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`or_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`bigcat_id`) REFERENCES `bigcat` (`bigcat_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`br_id`) REFERENCES `brand` (`br_id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`subcat_id`) REFERENCES `subcat` (`subcat_id`),
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`vin_id`) REFERENCES `vindor` (`vin_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fr6_id` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
