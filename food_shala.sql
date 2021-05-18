-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2021 at 05:15 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_shala`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `type` varchar(255) NOT NULL,
  `menu_desc` varchar(5000) NOT NULL,
  `image` varchar(500) NOT NULL,
  `price` varchar(255) NOT NULL DEFAULT '0',
  `res_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `type`, `menu_desc`, `image`, `price`, `res_id`, `created_at`) VALUES
(4, 'Baked Honey Glazed Chicken Recipe', 'nonveg', 'dsfsdfsd fsd fsd fsd f sdf sd fs fsd fsd f sd f sdf sd fsd f sd f sd f sd f sdf sd f s dgfdhg hgf j h gf  fdg re tret re t re tre tret re tre t tr ret re tre  tter r tret r tt re  tr t tre  te rt re tr tr ', 'image/2233_1621348701.jpg', '34', 4, '2021-05-18 14:58:27'),
(5, 'mutton kosha', 'nonveg', 'safasf ssdg dfdfgd', 'image/6875_1621348739.jpg', '567', 4, '2021-05-18 14:38:59'),
(6, 'roti vendi torka', 'veg', '      vxcvsdfsd sdgsdgsd', 'image/6421_1621348810.jpg', '3534', 4, '2021-05-18 14:40:10'),
(7, 'kairi murgh', 'nonveg', '      sdfsdfs', 'image/2133_1621348886.jpg', '342', 4, '2021-05-18 14:41:26'),
(8, 'Dhosa', 'veg', '      sdfsdfdfg ddf', 'image/4905_1621348950.jpg', '341', 4, '2021-05-18 14:42:30'),
(9, 'paneer rice', 'veg', '      sdfsdf dgdfgdfgd', 'image/1273_1621349011.jpg', '456', 4, '2021-05-18 14:43:31'),
(10, 'non veg kabab shprma krelkerj rkejtlkrej erjtlkrejtkrejtk ertkerm totreot reot reot reoit reioterit erit elk jltjalruoitureoigjdkgtiret iot eroit it uoi reoit uroi ureoi e', 'nonveg', '      dfgd fdgdf', 'image/1104_1621349181.jpg', '2450', 4, '2021-05-18 14:46:21');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `res_id` int(11) NOT NULL,
  `status` int(255) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `menu_id`, `user_id`, `res_id`, `status`, `created_at`) VALUES
(25, 4, 5, 4, 0, '2021-05-18 15:09:03'),
(26, 9, 5, 4, 0, '2021-05-18 15:09:03'),
(27, 8, 5, 4, 0, '2021-05-18 15:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(5000) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `preference` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `address`, `phone`, `password`, `type`, `preference`, `created_at`) VALUES
(4, 'abcd@gmail.com', 'asdas slksdjkldsjlkdas', 'dfgds dsfsg', '342342342', '$2y$10$iQ62AoXgE3ZTYv/5993WPOsDqLtgukGwLI5arWZ/csxnPuU9oakrW', 'rest', NULL, '2021-05-18 20:06:37'),
(5, 'amit@gmail.com', 'Amit Chakraborty', 'Kodalia Shantinagar 116 mp road', '9874173663', '$2y$10$QKBS3ImPJYj4VHRDVDO85OzMPjXu7Du0JpJvKcJWTMya1NmsmurSe', 'cust', 'veg', '2021-05-18 20:37:50'),
(6, 'shanti@gmail.com', 'shanti lal', 'fdgdfh fhgfhfg fg hfg hdhd', '435345345', '$2y$10$uA0kuZ33YYcEieY33QjSjuCE3gmnvNKA1QklcZ2Wb5dYcUJH0v05y', 'rest', NULL, '2021-05-18 20:40:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
