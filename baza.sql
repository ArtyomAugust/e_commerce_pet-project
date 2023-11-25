-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 06:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baza`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_category`) VALUES
(1, 'Technic'),
(2, 'Clothes'),
(3, 'Mobile phones');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(80) NOT NULL,
  `photo_name` varchar(80) NOT NULL,
  `video_name` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `uploaded` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` double NOT NULL,
  `discount` double DEFAULT NULL,
  `hot` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `label`, `photo_name`, `video_name`, `description`, `category_id`, `user_id`, `uploaded`, `price`, `discount`, `hot`) VALUES
(10, 'Nothing phone 10', 'nothing_phone_10.jpg', '', 'A brand new phone', 3, 50, '2023-11-25 15:08:05', 394.45, 200.99, NULL),
(22, 'New computer', 'computer8.jpg', '', 'a new computer', 1, 50, '2023-11-25 15:28:56', 524.45, 435.22, NULL),
(23, 'new T-shirt', 't_skirt_green.jpg', '', 'a new green t-shirt', 2, 50, '2023-11-25 15:28:23', 50.44, 30.55, NULL),
(24, 'Nothing Phone 5', 'nothing_phone_5.jpg', '', 'A new phone', 3, 50, '2023-11-25 16:29:34', 50.88, 100.55, NULL),
(25, 'Yellow T-shirt', 'yellow_T_shirt.jpg', '', 'New Yellow T-shirt', 2, 50, '2023-11-25 15:15:11', 30.44, 0, NULL),
(26, 'Tot phone ', 'tot_phone.jpg', '', 'A brand new phone', 3, 50, '2023-11-24 23:22:10', 105.44, 0, NULL),
(28, 'T-shirt blue', 't_shirt_blue.jpg', '', 'a new blue t-shirt', 2, 50, '2023-11-25 16:30:14', 30.44, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` varchar(50) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `remember` tinyint(1) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `first_name`, `last_name`, `email`, `password`, `remember`, `admin`) VALUES
(50, 'user', 'Kara', 'Karalov', 'user@gmail.com', '$2y$10$/Rh1WhuVADzTpUQBzF06w.GTzTiAeFPGw7DD3cPPxIzy4s1KbUNHS', NULL, NULL),
(51, 'marta', 'Artur', 'Arturovich', 'marta@gmail.com', '$2y$10$0BhRucbPV43hQQA7VVzXwOOXxZbC9pEdI76exmLNzqy7huasIXp5y', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
