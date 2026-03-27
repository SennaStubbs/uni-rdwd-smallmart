-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2026 at 12:49 AM
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
  `category_image` varchar(100) NOT NULL COMMENT 'Image URL for a category',
  `category_details` text NOT NULL COMMENT 'Details of a category, separated by commas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`, `category_details`) VALUES
(1, 'Food', '/smallmart/website/assets/categories/food.jpg', 'bg_col=#0077FF,button_col=#027ADC,button_acc_col=#0035BA,text_col=var(--text-light),featured=1'),
(2, 'Musical Instruments', '/smallmart/website/assets/categories/musical_instruments.webp', 'featured=2'),
(3, 'Kitchen Collection', '/smallmart/website/assets/categories/kitchen_collection.jpg', 'featured=3'),
(4, 'Foliage', '/smallmart/website/assets/categories/foliage.jpg', 'featured=4'),
(5, 'House Furniture', '/smallmart/website/assets/categories/', ''),
(6, 'Outdoor Furniture', '/smallmart/website/assets/categories/', ''),
(7, 'Miscellaneous', '/smallmart/website/assets/categories/', ''),
(8, 'Featured', '', ''),
(9, 'Newly Added', '', ''),
(10, 'On Sale', '', ''),
(11, 'Popular', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL COMMENT 'Primary key for a product',
  `product_name` varchar(50) NOT NULL COMMENT 'Name of a product',
  `product_description` text NOT NULL COMMENT 'Description of a product',
  `product_image` text NOT NULL COMMENT 'Image URL for a product, separated by commas',
  `product_price` int(5) NOT NULL COMMENT 'Price of a product',
  `product_details` text NOT NULL COMMENT 'Details of a product, separated by commas',
  `category_id` text NOT NULL COMMENT 'List of foreign keys for categories, separated by commas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_image`, `product_price`, `product_details`, `category_id`) VALUES
(1, 'Burger', 'Crafted to perfection, our Miniature Burgers will add a touch of realism to your dollhouse. Made with precise attention to detail, these perfectly scaled burgers are an essential addition to any miniature kitchen. Indulge in 1:12 scale perfection with our Dollhouse Miniature Burgers. Types available: Type A, Type B.', '/smallmart/website/assets/products/burger_1.jpg', 32, '', '1'),
(2, 'Brownie', 'Enhance your dollhouse with this intricately detailed brownie miniature. Each piece is handcrafted to perfection, adding a touch of realism to your miniature world. Made with high-quality materials for long-lasting durability. Perfect for collectors or dollhouse enthusiasts.', '/smallmart/website/assets/products/brownie_1.jpg', 40, 'featured=2', '9'),
(3, 'Bread', 'Experience the charm of a dollhouse with our miniatures. Each random piece of bread adds a unique touch to your collection. Expertly crafted with attention to detail, these miniatures are essential for any dollhouse enthusiast. Bring your imagination to life with these intricate pieces.', '/smallmart/website/assets/products/bread_1.jpg', 24, 'featured=9', '8'),
(4, 'Alcoholic Beverage Bottle', 'This miniature alcoholic beverage bottle (random colour) is the perfect addition to any dollhouse or collection. Made with attention to detail, this tiny bottle adds a realistic touch to any miniature setting. Crafted with high-quality materials, it is sure to impress and enhance any display.', '/smallmart/website/assets/products/alcoholic-beverage-bottle_1.jpg', 32, 'featured=10', '8'),
(5, 'Air Fryer', 'This Miniature Air Fryer is the perfect addition to your doll house kitchen! With its realistic details and tiny size, it brings authenticity to your miniature world. Add this to your collection and bring your doll house kitchen to life.', '/smallmart/website/assets/products/air-fryer_1.jpg', 514, 'featured=8', '8,9'),
(6, 'Cooking Decor Set', 'Enhance your child\'s imaginative play with our Cooking Decor Set, complete with a doll house for added fun. Stimulate creativity and fine motor skills as they pretend to cook and decorate with realistic accessories. Perfect for ages 3 and up.', '/smallmart/website/assets/products/cooking-decor-set_1.jpg', 138, '', '1'),
(7, 'Coffee Mug', 'This miniature coffee mug is the perfect addition to any dollhouse. Expertly crafted, it provides a realistic touch to any miniature kitchen or dining room. Made with precision and attention to detail, it is a must-have for any dollhouse enthusiast.', '/smallmart/website/assets/products/coffee-mug_1.jpg', 24, 'featured=4', '9'),
(8, 'Clock', 'Miniature Clock (random colour). Expertly crafted, this clock is a perfect addition to any dollhouse. With its miniature size, it adds a touch of elegance and functionality to any room.', '/smallmart/website/assets/products/clock_1.jpg', 17, 'featured=3', '9'),
(9, 'Carpet', 'Miniature Carpet (15 cm x 10 cm). Expertly crafted for dollhouse enthusiasts, this miniature carpet adds a touch of elegance and realism to any miniature setting. Made to scale, its intricate design and quality materials make it a must-have for any collector. Available colours: Light Blue, Red.', '/smallmart/website/assets/products/carpet_1.jpg', 142, 'featured=1', '9'),
(10, 'Candle Set', 'Crafted for dollhouse enthusiasts, this Miniature Candle Set adds a realistic touch to any miniature scene. Hand-crafted with intricate detail, these candles provide the perfect accent piece for creating a cozy and charming atmosphere. A must-have set for your miniature collection.', '/smallmart/website/assets/products/candle-set_1.jpg', 119, 'featured=1', '8'),
(11, 'Biscuits', 'With a realistic design and intricate details, our Miniature Biscuits is a delightful addition to any dollhouse. Crafted with precision, this tiny treat adds a touch of charm to your miniature world. Immerse yourself in the tiny world with our lifelike miniature biscuits.', '/smallmart/website/assets/products/biscuits_1.jpg', 16, 'featured=11', '8'),
(12, 'Chair', 'This dollhouse miniature chair per piece random colour is expertly crafted for a realistic and charming addition to your miniature setting. Made with precision and detail, it boasts an authentic design that will elevate the aesthetic of any miniature scene. Enhance the ambiance and visual appeal with this delightful chair.', '/smallmart/website/assets/products/chair_1.jpg', 59, 'featured=7,discounted-price=43', '10'),
(13, 'Cookies Set', 'Expertly crafted and detailed, this Cookies Set features dollhouse miniatures that will enhance any playtime experience. Each piece is made with high-quality materials and intricate designs, providing endless opportunities for imaginative play. With a variety of delectable treats, this set is perfect for tea parties, kitchen play, and more.', '/smallmart/website/assets/products/cookies-set_1.jpg', 103, 'featured=5,discounted-price=82', '10'),
(14, 'Design Plate', 'This dollhouse miniature  design plate per piece random is perfect for giving your dollhouse a realistic touch. Each plate is unique and adds character to your miniature home. Expertly crafted to resemble real plates, these pieces are a must-have for dollhouse enthusiasts and collectors.', '/smallmart/website/assets/products/design-plate_1.jpg', 32, '', ''),
(15, 'Donut Flower Vase', 'Introducing the Donut Flower Vase, a dollhouse miniature that adds a touch of whimsy to any home decor. Crafted with the finest details, this vase is a perfect addition to your miniature collection. With its unique design and intricate craftsmanship, it will surely be the centerpiece of any room.', '/smallmart/website/assets/products/donut-flower-vase_1.jpg', 63, 'featured=3,discounted-price=52', '10'),
(16, 'Dustbin', 'Expertly crafted, this 1 piece dollhouse miniature dustbin is the perfect addition to any dollhouse. Made with attention to detail and precision, it adds a realistic touch to any miniature setting. Made to scale and durable, it provides a functional and aesthetically pleasing solution for your dollhouse\'s waste management needs.', '/smallmart/website/assets/products/dustbin_1.png', 41, 'featured=2,discounted-price=29', '10'),
(17, 'Ferrero Rocher Chocolate', 'This miniature Ferrero rocher is the perfect addition to any dollhouse, adding a touch of realism and charm. Crafted with intricate details, it will bring your miniature world to life. Made with high-quality materials, it is a must-have for any collector or enthusiast. Elevate your miniature scenes with this exquisite piece.', '/smallmart/website/assets/products/ferrero-rocher-chocolate_1.jpg', 138, 'featured=14', '8'),
(18, 'Fish Tank', 'This Miniature Fish Tank per piece is the perfect addition to any dollhouse setup. Made with precision and attention to detail, it adds a touch of realism to your miniature world. Crafted with high-quality materials, it is both durable and visually appealing. Bring your dollhouse to life with this exquisite dollhouse miniature.', '/smallmart/website/assets/products/fish-tank_1.jpg', 296, 'featured=3', '8'),
(19, 'Flower Potted Vase', 'Expertly crafted miniature flower potted vase per piece, perfect for dollhouses or adding a touch of elegance to any small scale setting. Fine attention to detail and high-quality materials make this piece a must-have for collectors and hobbyists alike.', '/smallmart/website/assets/products/flower-potted-vase_1.jpg', 36, 'featured=1,discounted-price=30', '10'),
(20, 'French Fries', 'Expertly crafted to be a perfect scale replica, these Miniature French Fries will add realistic charm to your dollhouse. Created with precision and attention to detail, this tiny beauty is a true collector\'s item.', '/smallmart/website/assets/products/french-fries_1.jpg', 24, 'featured=4,discounted-price=12', '10'),
(21, 'Guitar', 'Our Guitar is a beautifully crafted miniature, perfect for adding a touch of musical charm to any dollhouse. Made with expert precision and attention to detail, it provides an accurate representation of the real-life instrument. Complete your dollhouse with this high-quality guitar and enhance its overall aesthetic.', '/smallmart/website/assets/products/guitar_1.jpg', 36, 'featured=6,discounted-price=28', '10'),
(22, 'Gulab Jamun Set', 'Experience the deliciousness of Gulab Jamun in a miniature form with our Miniature Gulab Jamun Set. This set includes dollhouse miniatures that are made with precision and attention to detail. Bring a taste of India to your dollhouse and add a touch of authenticity to your collection.', '/smallmart/website/assets/products/gulab-jamun-set_1.jpg', 103, '', ''),
(23, 'Hanging Swing', 'This dollhouse miniature hanging swing adds a charming touch to any dollhouse or miniature scene. With expertly crafted details, this miniature swing captures the essence of a real-life swing, providing a realistic addition to your mini world. Perfect for collectors and enthusiasts alike.', '/smallmart/website/assets/products/hanging-swing_1.jpg', 387, 'featured=2', '8'),
(24, 'Laddu Sweet', 'This 3 piece of Laddu Sweet features a dollhouse miniature design, providing a charming and realistic touch to any miniature setting. Handcrafted with intricate detail, it adds a delightful and authentic touch to your miniature collection. Made with high-quality materials, it is a perfect addition for miniature enthusiasts.', '/smallmart/website/assets/products/laddu-sweet_1.jpg', 47, 'featured=9,discounted-price=38', '10'),
(25, 'Laddu Sweet Box', 'This Laddu Sweet Box ( Box design may vary)is a miniature replica of the traditional sweet box often found in Indian households. With its intricate details and realistic design, it is perfect for dollhouse enthusiasts or as a unique piece for home decor. Handcrafted with precision, this miniature Laddu Sweet Box is a delightful addition to any collection.', '/smallmart/website/assets/products/laddu-sweet-box_1.jpg', 174, '', ''),
(26, 'Macroon Box', 'This Miniature Macroon Box is a 1-inch dollhouse miniature, perfect for adding a touch of charm and realism to your miniature scenes. Crafted with attention to detail, this miniature is sure to delight any miniature enthusiast. Add it to your collection and create beautiful, realistic scenes.', '/smallmart/website/assets/products/macroon-box_1.jpg', 150, 'featured=10', '9'),
(27, 'Milk Cream Sweet Box', 'This Milk Cream Sweet Box ( Box design may vary) is a dollhouse miniature that will add the perfect touch of sweetness to any dollhouse interior. Made with high-quality materials and attention to detail, this miniature will bring a realistic and charming element to your decor. Perfect for collectors and dollhouse enthusiasts.', '/smallmart/website/assets/products/milk-cream-sweet-box_1.jpg', 174, '', ''),
(28, 'Mini Flower Bud Vase', 'Mini Flower Bud  Vase per piece .This dollhouse miniature is delicately crafted to add a touch of charm to your miniature world. With its intricate details and realistic design, it\'s the perfect choice for any dollhouse enthusiast. Bring your miniature world to life with the Mini Flower Bud.', '/smallmart/website/assets/products/mini-flower-bud-vase_1.jpg', 40, 'featured=13', '8'),
(29, 'Muffins', 'Enhance your dollhouse miniature set with these delicate Miniature Muffins. Made with attention to detail, these tiny treats add a realistic touch to any miniature kitchen. Perfect for collectors or dollhouse enthusiasts looking to elevate their display.', '/smallmart/website/assets/products/muffins_1.jpg', 24, '', ''),
(30, 'Pastry Set', 'This Pastry Set includes a beautifully crafted dollhouse miniature, perfect for collectors and enthusiasts alike. Each intricate detail is meticulously designed, providing a realistic and charming addition to any collection. Made with high-quality materials, this set is sure to impress with its stunning craftsmanship.', '/smallmart/website/assets/products/pastry-set_1.jpg', 119, '', ''),
(31, 'Pizza With Box', 'Expertly crafted with realistic details, this miniature pizza is the perfect addition to any dollhouse. Made to scale, it comes complete with a tiny pizza box for an added touch of authenticity. Add this charming piece to your collection today.', '/smallmart/website/assets/products/pizza-with-box_1.jpg', 119, '', '8'),
(32, 'Radio', 'Expertly crafted and perfectly detailed, this dollhouse miniature Radio adds an authentic touch to any miniature setting. Made with precision and attention to detail, this model accurately captures the design and functionality of a real radio. Display it in your dollhouse or collection for a touch of nostalgia.', '/smallmart/website/assets/products/radio_1.jpg', 55, 'featured=10,discounted-price=42', '10'),
(33, 'Roll Pastry', 'Experience the realistic detail of our 1 Piece Roll Pastry miniature. Crafted with expert precision, each piece captures the intricate layers of a traditional bun, adding stunning realism to your dollhouse scenes. Made with high-quality materials, your collection will stand out with our miniature buns.', '/smallmart/website/assets/products/roll-pastry_1.jpg', 24, '', ''),
(34, 'Sewing Machine', 'This sewing machine is the perfect addition to any dollhouse, featuring a miniature design for realistic play. With its intricate details and realistic features, it provides endless creative opportunities for children to develop their sewing skills while having fun. A must-have for any dollhouse enthusiast.', '/smallmart/website/assets/products/sewing-machine_1.jpg', 46, 'featured=8,discounted-price=39', '10'),
(35, 'Suitcase', 'This miniature dollhouse suitcase is the perfect addition for any collector or enthusiast. Crafted with intricate details, this piece is made from high-quality materials for durability and authenticity. Display it in your dollhouse or use it for imaginative play, the possibilities are endless. Enhance your miniature world with this charming suitcase.', '/smallmart/website/assets/products/suitcase_1.jpg', 36, 'featured=7', '9'),
(36, 'Sweet Pidi Kozhukattai', '3 piece Experience the enchanting world of miniature dollhouses with Sweet Pidi kozhukattai .  Each piece is expertly crafted for a realistic and intricate design, perfect for collectors and hobbyists alike. Bring your imagination to life and create stunning scenes with these detailed miniature pieces.', '/smallmart/website/assets/products/sweet-pidi-kozhukattai_1.jpg', 47, '', ''),
(37, 'Swing', 'Expertly crafted for dollhouse enthusiasts, this Swing is a 1/12 scale miniature that adds a touch of charm to any dollhouse setting. Enjoy the intricate details and impeccable design of this realistic addition to your collection.', '/smallmart/website/assets/products/swing_1.jpg', 435, 'featured=12', '8'),
(38, 'Telephone', 'This telephone is a realistic dollhouse miniature that will add authenticity to your miniature world. With intricate details and high-quality construction, it is the perfect addition to any miniature scene. Bring your imagination to life with this miniature telephone.', '/smallmart/website/assets/products/telephone_1.jpg', 36, 'featured=9', '9'),
(39, 'Traditional Lamp', 'This traditional lamp is a dollhouse miniature that adds a touch of elegance to any room. Crafted with intricate details, this lamp will enhance the beauty of your miniature home. Made with quality materials, it is a perfect addition to any collector\'s collection.', '/smallmart/website/assets/products/traditional-lamp_1.jpg', 174, '', ''),
(40, 'Traditional Radio', 'This dollhouse miniature traditional radio is a perfect addition to any miniature home. It boasts realistic details and intricate design, making it a charming and authentic piece for your collection. With its small size, it will fit perfectly into any tiny room, allowing your miniature family to enjoy music and news just like in a real home.', '/smallmart/website/assets/products/traditional-radio_1.jpg', 36, '', ''),
(41, 'Traditional Set', 'Experience the timeless charm and intricate detail of our Traditional Set. This set features a beautifully crafted dollhouse miniature that will transport you to a world of imagination and creativity. Adorned with intricate designs and classic features, this set is perfect for collectors and dollhouse enthusiasts alike.', '/smallmart/website/assets/products/traditional-set_1.jpg', 95, '', ''),
(42, 'Trophy', 'This miniature dollhouse is a must-have for any collector. Crafted with exquisite detail, this 1/12 scale replica boasts hand-painted features and intricate furnishings. Perfect for showcasing your love for exquisite craftsmanship and interior design.', '/smallmart/website/assets/products/trophy_1.jpg', 111, 'featured=5', '9'),
(43, 'Vase Set', 'Expertly crafted with precision, this miniature set of vases is the perfect addition to any dollhouse. Made with attention to detail and high-quality materials, these vases provide a realistic and elegant touch to any miniature home. Enhance your dollhouse decor with this beautiful vase set.', '/smallmart/website/assets/products/vase-set_1.jpg', 59, '', ''),
(44, 'Waffle Toaster', 'Introducing our Waffle Toaster, perfect for any miniature collection. With its compact design, it\'s easy to store and display. Enjoy perfectly toasted waffles without taking up too much space. A must-have for avid collectors.', '/smallmart/website/assets/products/waffle-toaster_1.jpg', 190, 'featured=6', '9'),
(45, 'Water Filter', 'This Water Filter is a perfect addition to any dollhouse. With its miniature size, it will fit seamlessly into any room. Add a touch of realism to your dollhouse.', '/smallmart/website/assets/products/water-filter_1.jpg', 36, '', '');

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for a category', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for a product', AUTO_INCREMENT=46;

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
