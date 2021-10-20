-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2021 at 10:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `matrixstore`
--
-- --------------------------------------------------------
--
-- Table structure for table `address`
--
CREATE TABLE `address` (
  `address_id` int(5) NOT NULL,
  `country` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `street_name` varchar(50) NOT NULL,
  `building_number` int(4) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `address`
--
INSERT INTO `address` (
    `address_id`,
    `country`,
    `city`,
    `street_name`,
    `building_number`
  )
VALUES (40, 'Jordan', 'amman', 'King Abdullah', 1030),
  (42, 'England', 'amman', 'King Abdullah', 1030),
  (43, 'England', 'amman', 'King Abdullah', 1030);
-- --------------------------------------------------------
--
-- Table structure for table `admin`
--
CREATE TABLE `admin` (
  `admin_id` int(4) NOT NULL,
  `admin_fname` varchar(32) NOT NULL,
  `admin_mname` varchar(32) NOT NULL,
  `admin_lname` varchar(32) NOT NULL,
  `admin_email` varchar(75) NOT NULL,
  `admin_pass` varchar(100) NOT NULL,
  `admin_img` varchar(100) NOT NULL,
  `admin_phone` varchar(20) NOT NULL,
  `admin_address` varchar(100) NOT NULL,
  `add_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin_status` tinyint(1) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `admin`
--
INSERT INTO `admin` (
    `admin_id`,
    `admin_fname`,
    `admin_mname`,
    `admin_lname`,
    `admin_email`,
    `admin_pass`,
    `admin_img`,
    `admin_phone`,
    `admin_address`,
    `add_at`,
    `admin_status`
  )
VALUES (
    3,
    'Jameel',
    'Deeb',
    'alawneh',
    'mohammadmalawneh@gmail.com',
    '0799823683',
    'mohammad\'salawnehPhoto.jpeg',
    '0799823683',
    'Irbid Jordan',
    '2021-10-20 20:58:34',
    1
  ),
  (
    5,
    'momen',
    'mamon',
    'alawneh',
    'mones.alawneh@gmail.com',
    '0799823683',
    '1600681429rp3.jpg',
    '0799823683',
    'Karak-Jordan',
    '2021-10-20 20:58:34',
    0
  ),
  (
    7,
    'Kamel',
    'Ameen',
    'thabet',
    'Kamel.thabet@gmail.com',
    '0799823683',
    '1600440211rp4.jpg',
    '0799823683',
    'Irbid-Jordan',
    '2021-10-20 20:58:34',
    1
  ),
  (
    11,
    'Saif aldeen',
    'Ibrahim',
    'Alawneh',
    'saif.alawneh@gmail.com',
    '0799823683',
    '1601468966DBdesign.png',
    '0776219747',
    'maldifs',
    '2021-10-20 20:58:34',
    1
  );
-- --------------------------------------------------------
--
-- Table structure for table `admin_privileges`
--
CREATE TABLE `admin_privileges` (
  `admin_id` int(4) NOT NULL,
  `privileges` int(5) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `admin_privileges`
--
INSERT INTO `admin_privileges` (`admin_id`, `privileges`)
VALUES (11, 6),
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
  `bigcat_img_url` varchar(100) NOT NULL,
  `bigcat_status` tinyint(1) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `bigcat`
--
INSERT INTO `bigcat` (
    `bigcat_id`,
    `bigcat_name`,
    `bigcat_img_url`,
    `bigcat_status`
  )
VALUES (1, 'Clothes', '16008034561.jpg', 1),
  (2, 'Shoses', '1600799594feature_3.png', 1),
  (
    3,
    'Perfumes',
    '1600799784IL201906061151574833.jpg',
    1
  ),
  (
    4,
    'Electronics',
    '1600799836colorful-wireless-technology-objects-set_1284-36282.jpg',
    1
  );
-- --------------------------------------------------------
--
-- Table structure for table `brand`
--
CREATE TABLE `brand` (
  `brand_id` int(5) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `brand_img` varchar(100) NOT NULL,
  `brand_sta` int(11) NOT NULL,
  `bigcat_id` int(3) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `brand`
--
INSERT INTO `brand` (
    `brand_id`,
    `brand_name`,
    `brand_img`,
    `brand_sta`,
    `bigcat_id`
  )
VALUES (1, 'VERSACE', '', 1, 1),
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
  `customer_id` int(7) NOT NULL,
  `customer_fname` varchar(32) NOT NULL,
  `customer_mname` varchar(32) NOT NULL,
  `customer_lname` varchar(32) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_mobile` varchar(15) NOT NULL,
  `customer_status` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `customer`
--
INSERT INTO `customer` (
    `customer_id`,
    `customer_fname`,
    `customer_mname`,
    `customer_lname`,
    `customer_email`,
    `customer_pass`,
    `customer_mobile`,
    `customer_status`
  )
VALUES (
    1,
    'mohammad',
    'Jameel',
    'alawneh',
    'mohammadmalawneh@gmail.com',
    '0mLbgHaiTuEuGj',
    '0776219747',
    1
  ),
  (
    4,
    'saif',
    'Ibrahem',
    'alawneh',
    'saif.alawneh@gmail.com',
    '0776219747',
    '07762197478',
    1
  );
-- --------------------------------------------------------
--
-- Table structure for table `orders`
--
CREATE TABLE `orders` (
  `order_id` int(9) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customer_id` int(7) NOT NULL,
  `address_id` int(11) NOT NULL,
  `total` decimal(6, 2) NOT NULL,
  `order_notes` varchar(500) NOT NULL,
  `order_status` tinyint(1) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `orders`
--
INSERT INTO `orders` (
    `order_id`,
    `order_date`,
    `customer_id`,
    `address_id`,
    `total`,
    `order_notes`,
    `order_status`
  )
VALUES (
    24,
    '2020-09-28 21:00:00',
    1,
    42,
    '177.50',
    '',
    1
  );
-- --------------------------------------------------------
--
-- Table structure for table `order_details`
--
CREATE TABLE `order_details` (
  `order_details_id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `product_id` int(7) NOT NULL,
  `product_price` decimal(4, 2) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `order_details`
--
INSERT INTO `order_details` (
    `order_details_id`,
    `order_id`,
    `product_id`,
    `product_price`
  )
VALUES (100, 24, 28, '25.00'),
  (101, 24, 31, '25.00'),
  (102, 24, 32, '30.00'),
  (103, 24, 33, '40.00');
-- --------------------------------------------------------
--
-- Table structure for table `product`
--
CREATE TABLE `product` (
  `product_id` int(6) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_desc` varchar(300) NOT NULL,
  `product_price` decimal(4, 2) NOT NULL,
  `product_descount` int(11) NOT NULL,
  `product_qty` int(4) NOT NULL,
  `brand_id` int(5) NOT NULL,
  `bigcat_id` int(3) NOT NULL,
  `subcat_id` int(4) NOT NULL,
  `vindor_id` int(5) NOT NULL,
  `product_sta` tinyint(1) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `product`
--
INSERT INTO `product` (
    `product_id`,
    `product_name`,
    `product_desc`,
    `product_price`,
    `product_descount`,
    `product_qty`,
    `brand_id`,
    `bigcat_id`,
    `subcat_id`,
    `vindor_id`,
    `product_sta`
  )
VALUES (
    28,
    'Women\'s Kaftan Dress Elegant Lace Patchwork Long Sleeve High Waist Muslim Kaftan',
    '',
    '25.00',
    10,
    45,
    29,
    1,
    2,
    1,
    1
  ),
  (
    31,
    'Women\'s Kaftan Dress Embroidery Long Sleeve Stand Collar Muslim Arabian Clothing',
    '',
    '25.00',
    0,
    36,
    29,
    1,
    2,
    1,
    1
  ),
  (
    32,
    'Women\'s Kaftan Dress Flare Sleeve High Waist Fashion Arabian Clothing',
    '',
    '30.00',
    0,
    29,
    29,
    1,
    2,
    1,
    1
  ),
  (
    33,
    'Women\'s Kaftan Dress Loose Batwing Sleeve Applique Muslim Arabian Clothing',
    '',
    '40.00',
    0,
    -4,
    29,
    1,
    2,
    1,
    1
  ),
  (
    34,
    'Women\'s A Line Dress Polka Dot Lantern Sleeve Elastic Waist Casual Long Dress',
    '',
    '10.00',
    0,
    993,
    29,
    1,
    2,
    1,
    1
  ),
  (
    35,
    'MUZDAN Men\'s Thob With Classic Collar And One Button Cuffs',
    '',
    '65.00',
    0,
    993,
    29,
    1,
    1,
    1,
    1
  ),
  (
    36,
    'Men\'s Cardigan Plaid Striped Button Fashion Knitwear',
    '',
    '10.00',
    0,
    100,
    29,
    1,
    1,
    1,
    1
  ),
  (
    38,
    'Mens Cardigan Zipper Gingham Stand Collar Knitwear',
    '',
    '19.00',
    0,
    100,
    29,
    1,
    1,
    1,
    1
  ),
  (
    39,
    'Men\'s Cardigan Casual Solid Color Long Sleeve Knitwear',
    '',
    '15.00',
    0,
    96,
    29,
    1,
    1,
    1,
    1
  ),
  (
    40,
    'Men\'s Cardigan Long Sleeve Solid Fashion Slim Knitwear',
    '',
    '21.00',
    0,
    100,
    29,
    1,
    1,
    1,
    1
  ),
  (
    41,
    'Men\'s Cardigan Stand Collar Patchwork Zipper Knitwear',
    '',
    '15.00',
    0,
    25,
    29,
    1,
    1,
    1,
    1
  ),
  (
    42,
    'Teen Boy\'s 2 Pieces Pants Set Long Sleeve Patchwork Hoodie Loose Trousers Set',
    '',
    '13.00',
    0,
    47,
    29,
    1,
    3,
    1,
    1
  ),
  (
    43,
    'Boys Boy\'s 2 Pcs Striped Pants Suit Zipper Long Sleeve Stylish Set',
    '',
    '20.00',
    0,
    100,
    29,
    1,
    3,
    1,
    1
  ),
  (
    44,
    'Teen Boy\'s 3 Pieces Tracksuit Fashion Hooded Vest Long Sleeve Wings Sweatshirt Loose Trousers Set',
    '',
    '65.00',
    0,
    100,
    29,
    1,
    3,
    1,
    1
  ),
  (
    46,
    'Boy\'s Two-Piece Tracksuit Letter Pattern Turn Down Collar Fashion Denim Coat Jeans Suit',
    '',
    '20.00',
    0,
    100,
    29,
    1,
    3,
    1,
    1
  ),
  (
    47,
    'German Lucur',
    '			',
    '10.00',
    0,
    96,
    30,
    1,
    1,
    1,
    1
  ),
  (
    48,
    'Long Red T-shirts',
    '',
    '15.00',
    0,
    100,
    6,
    1,
    2,
    1,
    1
  ),
  (
    49,
    'Black Long Dress',
    '',
    '13.00',
    0,
    100,
    4,
    1,
    2,
    1,
    1
  );
-- --------------------------------------------------------
--
-- Table structure for table `product_img`
--
CREATE TABLE `product_img` (
  `image_id` int(15) NOT NULL,
  `product_id` int(7) NOT NULL,
  `product_img` varchar(300) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `product_img`
--
INSERT INTO `product_img` (`image_id`, `product_id`, `product_img`)
VALUES (1, 27, '160081434470.jpg'),
  (
    2,
    27,
    '1600814344733ceebd-b7c3-43f5-a803-b454d6a29977.jpg_210x280x80.jpg'
  ),
  (
    3,
    27,
    '1600814344b8559dd4-c884-42f7-a775-60d00af2a2ff.jpg_210x280x80.jpg'
  ),
  (
    4,
    27,
    '1600814344c34c26bd-fba4-4351-ab36-ced8c4caaa0c.jpg_210x280x80.jpg'
  ),
  (5, 28, '160081471345.jpg'),
  (6, 28, '160081471380.jpg'),
  (7, 28, '160081471383.jpg'),
  (8, 28, '1600814714x80.jpg'),
  (
    17,
    31,
    '160081518763ce837d-76cc-4ba4-bafd-cf0f44e17330.jpg_210x280x80.jpg'
  ),
  (
    18,
    31,
    '160081518783f70ea8-512e-4283-a2dd-c38d4c0a679d.jpg_210x280x80.jpg'
  ),
  (
    19,
    31,
    '160081518725662b55-577c-4589-9ef3-5b4fb7e15637.jpg'
  ),
  (
    20,
    32,
    '1600815342037ad378-c679-4b8f-be6b-cad6bcbeb901.jpg_210x280x80.jpg'
  ),
  (
    21,
    32,
    '160081534239276aee-c660-480e-95cf-d5c75bb64af8.jpg_210x280x80.jpg'
  ),
  (
    22,
    32,
    '16008153423874482e-ddec-42b3-a2d7-e52392dedffb.jpg_210x280x80.jpg'
  ),
  (
    23,
    33,
    '16008155288e9919c5-eab1-49a0-a7a4-a5c3ab0be041.jpg_210x280x80.jpg'
  ),
  (
    24,
    33,
    '160081552926c7782e-93ab-4998-b10b-1980d3c59bf4.jpg_210x280x80.jpg'
  ),
  (
    25,
    33,
    '160081552939dedfb7-a7fd-4819-8bb0-d09bbe30014f.jpg_210x280x80.jpg'
  ),
  (
    26,
    33,
    '1600815529ec71a4d1-7c86-407c-99dd-2a7972d802d7.jpg_210x280x80.jpg'
  ),
  (
    27,
    34,
    '160081569497a75d9a-8936-489f-8ac6-9d353243671e.jpg_210x280x80.jpg'
  ),
  (
    28,
    34,
    '160081569440859298-2041-4ed7-914a-b9ff37a1741f.jpg_210x280x80.jpg'
  ),
  (
    29,
    34,
    '1600815694fe2f0f34-7791-46d4-b6e3-0cfc0a479a35.jpg_210x280x80.jpg'
  ),
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
  (
    46,
    40,
    '16008167273ad7286c-0444-429c-b757-75e6bcfa9aa1.jpg_210x280x80.jpg'
  ),
  (47, 41, '16008171653.jpg'),
  (48, 41, '16008171656.jpg'),
  (
    49,
    41,
    '1600817165cfa8bd7a-c860-4ae6-b3ff-5bb29a837836.jpg_210x280x80.jpg'
  ),
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
  `product_id` int(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `com_name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `com_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `com_text` varchar(500) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `reviews`
--
INSERT INTO `reviews` (
    `com_id`,
    `product_id`,
    `email`,
    `com_name`,
    `mobile`,
    `com_time`,
    `com_text`
  )
VALUES (
    1,
    40,
    'mohammadmalawneh@gmail.com',
    'Mohammad Jameel Alawneh',
    '0776219747',
    '2020-09-23 18:49:00',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo'
  ),
  (
    2,
    40,
    'mohammadmalawneh@gmail.com',
    'Mohammad Jameel Alawneh',
    '0776219747',
    '2020-09-23 18:49:00',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo'
  ),
  (
    5,
    28,
    'mohammadmin_kao@yahoo.com',
    'anamalal',
    '0799823683',
    '2020-09-28 22:39:18',
    'this product is so good'
  ),
  (
    6,
    28,
    'mohammadmin_kao@yahoo.com',
    'anamalal',
    '0799823683',
    '2020-09-28 22:39:55',
    'this product is so good'
  ),
  (
    7,
    28,
    'saif_alawneh@yahoo.com',
    'Saif Ibrahim alawneh',
    '0799826595',
    '2020-09-28 22:42:25',
    'Its very good Prduct'
  );
-- --------------------------------------------------------
--
-- Table structure for table `subcat`
--
CREATE TABLE `subcat` (
  `subcat_id` int(4) NOT NULL,
  `subcat_name` varchar(50) NOT NULL,
  `subcat_sta` tinyint(1) NOT NULL,
  `bigcat_id` int(3) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `subcat`
--
INSERT INTO `subcat` (
    `subcat_id`,
    `subcat_name`,
    `subcat_sta`,
    `bigcat_id`
  )
VALUES (1, 'man', 1, 1),
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
  `vindor_id` int(5) NOT NULL,
  `vindor_fname` varchar(32) NOT NULL,
  `vindor_mname` varchar(32) NOT NULL,
  `vindor_lname` varchar(32) NOT NULL,
  `vindor_pass` varchar(100) NOT NULL,
  `vindor_email` varchar(100) NOT NULL,
  `bigcat_id` int(3) NOT NULL,
  `vindor_mobile` varchar(15) NOT NULL,
  `vindor_img` varchar(100) NOT NULL,
  `vindor_address` varchar(100) NOT NULL,
  `vindor_sdate` date NOT NULL,
  `admin_id` int(4) NOT NULL,
  `vindor_status` tinyint(1) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `vindor`
--
INSERT INTO `vindor` (
    `vindor_id`,
    `vindor_fname`,
    `vindor_mname`,
    `vindor_lname`,
    `vindor_pass`,
    `vindor_email`,
    `bigcat_id`,
    `vindor_mobile`,
    `vindor_img`,
    `vindor_address`,
    `vindor_sdate`,
    `admin_id`,
    `vindor_status`
  )
VALUES (
    1,
    'mamon',
    'jameel',
    'alawneh',
    '0776219747',
    'mohammadmalawneh@gmail.com',
    1,
    '0799823683',
    '1600684059G1.jpg',
    'Amman Jordan',
    '2020-09-11',
    5,
    1
  ),
  (
    3,
    'Jameel',
    'Deeb',
    'Alawneh',
    '0799823683',
    'jameel.alawneh@gmail.com',
    3,
    '0772211216',
    '1600454289bg-2.jpg',
    'Sanaa Yaman',
    '2020-09-18',
    3,
    1
  );
--
-- Indexes for dumped tables
--
--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
ADD PRIMARY KEY (`admin_id`);
--
-- Indexes for table `admin_privileges`
--
ALTER TABLE `admin_privileges`
ADD KEY `admin_id` (`admin_id`);
--
-- Indexes for table `bigcat`
--
ALTER TABLE `bigcat`
ADD PRIMARY KEY (`bigcat_id`);
--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
ADD PRIMARY KEY (`brand_id`),
  ADD KEY `bigcat_id` (`bigcat_id`);
--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
ADD PRIMARY KEY (`customer_id`);
--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
ADD PRIMARY KEY (`order_id`),
  ADD KEY `costmer_id` (`customer_id`),
  ADD KEY `address_id` (`address_id`);
--
-- Indexes for table `product`
--
ALTER TABLE `product`
ADD PRIMARY KEY (`product_id`),
  ADD KEY `bigcat_id` (`bigcat_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `subcat_id` (`subcat_id`),
  ADD KEY `vindor_id` (`vindor_id`);
--
-- Indexes for table `product_img`
--
ALTER TABLE `product_img`
ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);
--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
ADD PRIMARY KEY (`com_id`),
  ADD KEY `fr6_id` (`product_id`);
--
-- Indexes for table `subcat`
--
ALTER TABLE `subcat`
ADD PRIMARY KEY (`subcat_id`);
--
-- Indexes for table `vindor`
--
ALTER TABLE `vindor`
ADD PRIMARY KEY (`vindor_id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `admin_id` int(4) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 13;
--
-- AUTO_INCREMENT for table `bigcat`
--
ALTER TABLE `bigcat`
MODIFY `bigcat_id` int(3) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 13;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
MODIFY `brand_id` int(5) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 31;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;