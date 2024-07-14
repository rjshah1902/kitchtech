-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 08:47 PM
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
-- Database: `kitchtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'chicken', 1, '2024-07-13 00:50:00', '2024-07-13 00:50:00'),
(2, 'pork', 1, '2024-07-13 00:50:00', '2024-07-13 00:50:22'),
(3, 'fish', 1, '2024-07-13 00:50:15', '2024-07-13 00:50:15'),
(4, 'veg', 1, '2024-07-13 00:50:15', '2024-07-13 00:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(11) NOT NULL,
  `food_name` varchar(200) NOT NULL,
  `food_category_id` int(11) NOT NULL,
  `food_type_id` int(11) NOT NULL,
  `food_terminology_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `food_name`, `food_category_id`, `food_type_id`, `food_terminology_id`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Milk Shak', 4, 1, 2, 1, 0, '2024-07-14 17:41:34', '2024-07-14 17:41:34'),
(2, 'Butter Kulcha', 4, 2, 7, 1, 0, '2024-07-14 17:42:02', '2024-07-15 00:14:54'),
(3, 'Badam Shake', 4, 1, 3, 1, 0, '2024-07-14 17:43:36', '2024-07-14 17:43:36'),
(4, 'Mango Shake', 4, 1, 3, 1, 0, '2024-07-14 17:43:51', '2024-07-15 00:14:39'),
(5, 'Matter Paneer', 4, 2, 9, 1, 0, '2024-07-14 17:44:03', '2024-07-15 00:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `food_terminology`
--

CREATE TABLE `food_terminology` (
  `id` int(11) NOT NULL,
  `food_type_id` int(11) NOT NULL,
  `terminology_name` varchar(200) NOT NULL,
  `terminology_number` smallint(6) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_terminology`
--

INSERT INTO `food_terminology` (`id`, `food_type_id`, `terminology_name`, `terminology_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'thin', 0, 1, '2024-07-13 01:01:59', '2024-07-13 01:01:59'),
(2, 1, 'slightly thick', 1, 1, '2024-07-13 01:02:56', '2024-07-13 01:02:56'),
(3, 1, 'mildly thick', 2, 1, '2024-07-13 01:03:19', '2024-07-13 01:03:19'),
(4, 1, 'moderately thick', 3, 1, '2024-07-13 01:03:40', '2024-07-13 01:03:40'),
(5, 1, 'extermely thick', 4, 1, '2024-07-13 01:04:07', '2024-07-13 01:04:07'),
(6, 2, 'liquidised', 3, 1, '2024-07-13 01:04:42', '2024-07-13 01:04:42'),
(7, 2, 'pureed', 4, 1, '2024-07-13 01:04:55', '2024-07-13 01:04:55'),
(8, 2, 'minced & moist', 5, 1, '2024-07-13 01:05:19', '2024-07-13 01:05:19'),
(9, 2, 'soft & bite-sized', 6, 1, '2024-07-13 01:05:40', '2024-07-13 01:05:40'),
(10, 2, 'regular', 7, 1, '2024-07-13 01:05:55', '2024-07-15 00:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `food_type`
--

CREATE TABLE `food_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_type`
--

INSERT INTO `food_type` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'drink', 1, '2024-07-13 00:54:04', '2024-07-13 01:00:54'),
(2, 'food', 1, '2024-07-13 00:54:04', '2024-07-13 01:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `home_residents`
--

CREATE TABLE `home_residents` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `food_type_id` int(11) NOT NULL,
  `food_terminology_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_residents`
--

INSERT INTO `home_residents` (`id`, `name`, `food_type_id`, `food_terminology_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home Residents', 2, 12, 1, '2024-07-15 00:09:13', '2024-07-15 00:09:13'),
(2, 'Nursing Home Residents', 2, 6, 1, '2024-07-15 00:09:21', '2024-07-15 00:09:36'),
(3, 'Home Residents 2', 1, 4, 1, '2024-07-15 00:09:21', '2024-07-15 00:09:44'),
(4, 'Home Residents 3', 1, 5, 1, '2024-07-15 00:09:21', '2024-07-15 00:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `contact`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rahul Shah', 'rjshah1902', 'rjshah1902@gmail.com', '7898335057', '12345', 1, '2024-07-12 23:43:08', '2024-07-13 00:47:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_terminology`
--
ALTER TABLE `food_terminology`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_type`
--
ALTER TABLE `food_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_residents`
--
ALTER TABLE `home_residents`
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
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `food_terminology`
--
ALTER TABLE `food_terminology`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `food_type`
--
ALTER TABLE `food_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_residents`
--
ALTER TABLE `home_residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
