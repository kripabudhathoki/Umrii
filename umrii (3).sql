-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 10:35 PM
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
-- Database: `umrii`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `uid`, `created_at`) VALUES
(20, 4, '2024-07-30 16:17:38.000000');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `checkout_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`checkout_id`, `first_name`, `last_name`, `email`, `phone`, `address`) VALUES
(1, 'kripa', 'budhathoki', 'kripa.budhathoki10@gmail.com', 9800000002, 'kapan'),
(2, 'kripa', 'budhathoki', 'kripa.budhathoki10@gmail.com', 9800000002, 'kapan'),
(3, 'kripa', 'budhathoki', 'kripa.budhathoki10@gmail.com', 9800000002, 'kapan'),
(4, 'kripa', 'budhathoki', 'kripa.budhathoki10@gmail.com', 9800000002, 'kapan'),
(5, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, 'bhaktapur'),
(6, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, 'bhaktapur'),
(7, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, 'bhaktapur'),
(8, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, 'bhaktapur'),
(10, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, 'bhaktapur'),
(11, 'susmita', 'katuwal', 'k@gmail.com', 9800000002, 'kathmandu'),
(12, 'susmita', 'katuwal', 'k@gmail.com', 9800000002, 'kathmandu'),
(13, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, 'bhaktapur'),
(14, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, 'bhaktapur'),
(15, 'Kripa', 'Budhathoki', 'kripa.budhathoki10@gmail.com', 9800000002, 'kathmandu'),
(16, 'Kripa', 'Budhathoki', 'kripa.budhathoki10@gmail.com', 9800000002, 'kathmandu'),
(17, 'Kripa', 'Budhathoki', 'kripa.budhathoki10@gmail.com', 9800000002, 'kathmandu'),
(18, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, 'bhaktapur'),
(19, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, 'bhaktapur'),
(20, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, 'bhaktapur'),
(21, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, 'bhaktapur'),
(22, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, 'bhaktapur'),
(23, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, 'bhaktapur');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `message`) VALUES
('', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime(6) NOT NULL,
  `uid` int(11) NOT NULL,
  `checkout_id` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `status` varchar(20) NOT NULL,
  `is_paid` bit(1) NOT NULL,
  `payment_method` varchar(20) DEFAULT NULL,
  `transaction_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `uid`, `checkout_id`, `total_price`, `status`, `is_paid`, `payment_method`, `transaction_id`) VALUES
(21, '2024-07-31 01:56:22.000000', 1, 22, 980, 'Pending', b'0', 'cod', 's$pRwlm#^jXAZ&eN'),
(22, '2024-07-31 02:17:17.000000', 1, 23, 540, 'Pending', b'0', 'khalti', 'IKFycmzyVWt*vGZR');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `pid`, `quantity`, `unit_price`) VALUES
(28, 21, 3, 1, 220.00),
(29, 21, 7, 1, 220.00),
(30, 21, 8, 2, 220.00),
(31, 22, 13, 1, 220.00),
(32, 22, 10, 1, 220.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` varchar(600) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `isFeatured` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `product_name`, `product_description`, `product_price`, `product_image`, `isFeatured`) VALUES
(3, 'Mango Crush', 'Savor the creamy richness of Mango Crush with smooth mango puree, perfectly balanced by a splash of Fresh Lime for a tangy twist. Fresh mint leaves add a cool, refreshing finish to the luscious mango flavor, making each sip invigorating.', 220.00, 'mango crush.jpg', 0),
(4, 'Orange Crush', 'Enjoy the vibrant taste of Orange Crush with smooth orange puree, enhanced by a splash of Fresh Orange for extra citrusy zest. A hint of Lime and mint leaves provide a refreshing, cool finish, making each sip a revitalizing experience.', 220.00, 'orange crush.jpg', 0),
(5, 'Peach Crush', 'Relish the juicy sweetness of Peach Crush with smooth peach puree, complemented by a splash of Fresh Lime for a zesty touch. Fresh mint leaves add a crisp, refreshing finish, making each sip a delightful treat.', 220.00, 'peach crush.jpg', 0),
(7, 'Kiwi Crush', 'Enjoy the tangy flavor of Kiwi Crush with smooth kiwi puree, perfectly balanced by a splash of Fresh Lime. Fresh mint leaves add a cool, refreshing finish to the bold kiwi taste.', 220.00, 'kiwi crush.jpg', 0),
(8, 'Pineapple Crush', 'Taste Pineapple with smooth pineapple puree, a splash of Fresh Lime for a zesty balance, and fresh mint for a cool finish. Each sip is a tropical escape.', 220.00, 'pineapple crush.jpg', 0),
(9, 'Strawberry Crush', 'Delight in the sweet flavor of Strawberry Crush with smooth strawberry puree, balanced by a splash of Fresh Lime for a tangy kick. Fresh mint leaves offer a cool, refreshing finish to the rich strawberry taste.', 220.00, 'Strawberry crush.jpg', 0),
(10, 'Forest Fruit', 'Discover the rich blend of Strawberry, Black currant, Raspberry, Red Currant, and Cherry purees in Forest Fruit Crush. A splash of Fresh Lime and a touch of mint provide a refreshing, cool finish to the vibrant fruit medley.', 220.00, 'Forest fruit.jpg', 1),
(11, 'Lychee Crush', 'Indulge in the delicate sweetness of Lychee Crush with smooth lychee puree, complemented by a splash of Fresh Lime for a citrusy twist. Fresh mint leaves add a refreshing, cool finish to the elegant lychee flavor.', 220.00, 'lychee crush.jpg', 0),
(12, 'Umrii Special', 'Indulge in the rich and creamy delight of our Umrii Special. This luxurious drink is crafted with a perfect blend of milk and chocolate, offering a smooth and decadent experience with every sip. Whether you are in the mood for a comforting treat or a satisfying pick-me-up, the Umrii Special is your go-to choice for a deliciously indulgent moment.', 250.00, 'umrii special.jpg', 2),
(13, 'Blueberry Crush', 'Relish the rich taste of Blueberry Crush with smooth blueberry puree, enhanced by a splash of Fresh Lime for a tangy balance. Fresh mint leaves offer a cool, invigorating finish to the bold blueberry flavor.', 220.00, 'blueberry crush.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(400) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `name`, `product_name`, `rating`, `review`, `image`) VALUES
(1, 'kripa', 'forest fruit', 5, 'I loved it!!!!', 'about2.jpg'),
(2, 'pragati dahal', 'Strawberry Crush', 5, 'wow!! It\'s refreshing!', '2O0A1603.jpg'),
(3, 'Kripa Kumari Budhathoki', 'forest fruit', 5, 'very good!!', '2O0A1379.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `password` varchar(225) NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `code` mediumint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `fname`, `lname`, `email`, `phone`, `password`, `address`, `username`, `code`) VALUES
(1, 'susmita', 'katuwal', 'susmitakatuwal@gmail.com', 9800000000, '$2y$10$NnJFU5LrvIn83V8biCjAteRAic6tFuP3Vv1D9MHefZb6k3gTXIqmi', 'kathmandu', 'susmita', 0),
(2, 'pragati', 'dahal', 'pragatidahal2058@gmail.com', 9800000002, '$2y$10$FlEfeita2NT3M4UEsPtFfeB8AX30pDqGHOxN/RdY7785.FbL/RYf2', 'bhaktapur', 'pragati', 0),
(4, 'Kripa', 'Budhathoki', 'kripa.budhathoki10@gmail.com', 9800000002, '$2y$10$ZOHazQExaIkAAzn7zl9Zye4D/d9UBV4.8kPpV7z.P6aTDDHse3zgy', 'kathmandu', 'kripabudhathoki_', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `checkout_id` (`checkout_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`checkout_id`) REFERENCES `checkouts` (`checkout_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
