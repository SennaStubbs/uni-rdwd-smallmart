-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2026 at 12:04 AM
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
-- Database: `smallmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL COMMENT 'Primary key for a category',
  `category_name` varchar(20) NOT NULL COMMENT 'Name of a category',
  `category_filters` varchar(100) NOT NULL COMMENT 'List of filters a category has, separated by commas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL COMMENT 'Primary key for a product',
  `product_name` varchar(50) NOT NULL COMMENT 'Name of a product',
  `product_description` text NOT NULL COMMENT 'Description of a product',
  `product_image` varchar(100) NOT NULL COMMENT 'Image URL for a product',
  `product_price` int(5) NOT NULL COMMENT 'Price of a product',
  `product_details` text NOT NULL COMMENT 'Details of a product, separated by commas.',
  `category_id` text NOT NULL COMMENT 'List of foreign keys for categories, separated by commas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_image`, `product_price`, `product_details`, `category_id`) VALUES
(1, 'Burger', 'Crafted to perfection, our Miniature Burgers will add a touch of realism to your dollhouse. Made with precise attention to detail, these perfectly scaled burgers are an essential addition to any miniature kitchen. Indulge in 1:12 scale perfection with our Dollhouse Miniature Burgers. Types available: Type A, Type B.', '/smallmart/website/assets/products/burger_1.jpg', 32, '', '1'),
(2, 'Brownie', 'Enhance your dollhouse with this intricately detailed brownie miniature. Each piece is handcrafted to perfection, adding a touch of realism to your miniature world. Made with high-quality materials for long-lasting durability. Perfect for collectors or dollhouse enthusiasts.', '/smallmart/website/assets/products/brownie_1.jpg', 40, '', '1'),
(3, 'Bread', 'Experience the charm of a dollhouse with our miniatures. Each random piece of bread adds a unique touch to your collection. Expertly crafted with attention to detail, these miniatures are essential for any dollhouse enthusiast. Bring your imagination to life with these intricate pieces.', '/smallmart/website/assets/products/bread_1.jpg', 24, '', '1'),
(4, 'Alcoholic Beverage Bottle', 'This miniature alcoholic beverage bottle (random colour) is the perfect addition to any dollhouse or collection. Made with attention to detail, this tiny bottle adds a realistic touch to any miniature setting. Crafted with high-quality materials, it is sure to impress and enhance any display.', '/smallmart/website/assets/products/alcoholic-beverage-bottle_1.jpg', 32, '', '1'),
(5, 'Air Fryer', 'This Miniature Air Fryer is the perfect addition to your doll house kitchen! With its realistic details and tiny size, it brings authenticity to your miniature world. Add this to your collection and bring your doll house kitchen to life.', '/smallmart/website/assets/products/air-fryer_1.jpg', 514, '', '1'),
(6, 'Cooking Decor Set', 'Enhance your child\'s imaginative play with our Cooking Decor Set, complete with a doll house for added fun. Stimulate creativity and fine motor skills as they pretend to cook and decorate with realistic accessories. Perfect for ages 3 and up.', '/smallmart/website/assets/products/cooking-decor-set_1.jpg', 138, '', '1'),
(7, 'Coffee Mug', 'This miniature coffee mug is the perfect addition to any dollhouse. Expertly crafted, it provides a realistic touch to any miniature kitchen or dining room. Made with precision and attention to detail, it is a must-have for any dollhouse enthusiast.', '/smallmart/website/assets/products/coffee-mug_1.jpg', 24, '', '1'),
(8, 'Clock', 'Miniature Clock (random colour). Expertly crafted, this clock is a perfect addition to any dollhouse. With its miniature size, it adds a touch of elegance and functionality to any room.', '/smallmart/website/assets/products/clock_1.jpg', 17, '', '1'),
(9, 'Carpet', 'Miniature Carpet (15 cm x 10 cm). Expertly crafted for dollhouse enthusiasts, this miniature carpet adds a touch of elegance and realism to any miniature setting. Made to scale, its intricate design and quality materials make it a must-have for any collector. Available colours: Light Blue, Red.', '/smallmart/website/assets/products/carpet_1.jpg', 142, '', '1'),
(10, 'Candle Set', 'Crafted for dollhouse enthusiasts, this Miniature Candle Set adds a realistic touch to any miniature scene. Hand-crafted with intricate detail, these candles provide the perfect accent piece for creating a cozy and charming atmosphere. A must-have set for your miniature collection.', '/smallmart/website/assets/products/candle-set_1.jpg', 119, '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL COMMENT 'Primary key for a review',
  `review_title` varchar(50) NOT NULL COMMENT 'The title of a review',
  `review_text` text NOT NULL COMMENT 'The text of a review',
  `review_published_datetime` datetime NOT NULL COMMENT 'Datetime of when a review was published',
  `review_rating` float NOT NULL COMMENT 'Star rating for a review',
  `product_id` int(11) NOT NULL COMMENT 'Foreign key for a product',
  `user_id` int(11) NOT NULL COMMENT 'Foreign key for a user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL COMMENT 'Primary key for a user',
  `username` varchar(20) NOT NULL COMMENT 'A user''s username',
  `user_display_name` varchar(30) NOT NULL COMMENT 'Display name for a user',
  `user_password` varchar(30) NOT NULL COMMENT 'The (hashed) password of a user',
  `user_access_level` int(1) NOT NULL COMMENT 'The access level of a user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_product`
--

CREATE TABLE `wishlist_product` (
  `wishlist_prod_id` int(11) NOT NULL COMMENT 'Primary key for a wishlist product',
  `user_id` int(11) NOT NULL COMMENT 'Foreign key for a user',
  `product_id` int(11) NOT NULL COMMENT 'Foreign key for a product'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist_product`
--
ALTER TABLE `wishlist_product`
  ADD PRIMARY KEY (`wishlist_prod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for a category';

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for a product', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for a review';

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for a user';

--
-- AUTO_INCREMENT for table `wishlist_product`
--
ALTER TABLE `wishlist_product`
  MODIFY `wishlist_prod_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for a wishlist product';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
