-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2026 at 01:57 PM
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
  `category_id` int(11) NOT NULL COMMENT 'Foreign key for a category'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

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
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for a product';

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
