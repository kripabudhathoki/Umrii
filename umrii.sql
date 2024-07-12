-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 07:37 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime(6) NOT NULL,
  `uid` int(20) NOT NULL,
  `price` double NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` varchar(600) NOT NULL,
  `product_price` decimal(10,0) NOT NULL,
  `product_image` varchar(22) NOT NULL,
  `isFeatured` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `product_name`, `product_description`, `product_price`, `product_image`, `isFeatured`) VALUES
(5, 'Peach Iced Tea', 'Peach iced tea is a harmonious fusion of brisk tea and the luscious essence of ripe peaches. This chilled beverage combines the robust notes of tea with the mellow sweetness of peaches, delivering a revitalizing and flavorful experience. Garnished with peach slices and served over ice, it offers a delightful blend of fruity aroma and cool refreshment, making it a beloved choice to savor during warm weather or as a complement to any leisurely moment.', '220', '2O0A1243.jpg', 1),
(8, 'Umrii Special', 'Indulge in the rich and creamy delight of our Umrii Special. This luxurious drink is crafted with a perfect blend of milk and chocolate, offering a smooth and decadent experience with every sip. Whether you are in the mood for a comforting treat or a satisfying pick-me-up, the Umrii Special is your go-to choice for a deliciously indulgent moment.', '220', 'special.jpg', 2),
(9, 'Strawberry Iced Tea', 'Strawberry iced tea blends the refreshing qualities of chilled tea with the vibrant sweetness of ripe strawberries. This delightful beverage offers a perfect balance of fruity flavors and the soothing essence of tea, creating a refreshing and invigorating drink ideal for hot summer days. Garnished with fresh strawberry slices and ice cubes, its not only a treat for the taste buds but also a feast for the eyes, making it a popular choice for any occasion where cool, fruity refreshment is desired.', '230', 'gallery4.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `address` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `fname`, `lname`, `email`, `phone`, `password`, `address`, `username`) VALUES
(3, 'Kripa', 'Dhungana', 'shushantadhungana0@gmail.com', 9865062545, '$2y$10$0ZP3tYtew3RkQDybjLsqSe88LoYD659pEur99BWIYRBcD0OI65Qvq', 'Boudha', 'Shushanta'),
(4, 'Hello', 'Dhungana', 'hello@gmail.com', 9865062545, '$2y$10$zIJkyTD3fBMaWXJbrvs1aegi0KlandWb3W0xeMutmiEgWcjtcf5w2', 'Boudha', 'KRIPASUCKS'),
(5, 'Shushanta', 'Dhungana', 'haha@gmail.com', 9865062545, '$2y$10$2AbJ3ehXvD5tffNsbW6GPOv/jlnoQ2wj/iRavvLyrnUMrT2E7jPsq', 'ramhiti', 'hahahatry'),
(10, 'Shushanta', 'Dhungana', 'kripa@gmail.com', 9865062545, '$2y$10$u0wAtxrZT8sN9vRr2PxarOTDsIRATPcisIfffF/P.NO7oqeMnMza6', 'Boudha', 'KripaDon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
