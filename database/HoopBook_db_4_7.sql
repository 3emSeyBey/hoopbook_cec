-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 09:27 AM
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
-- Database: `hoopbook_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_list`
--

CREATE TABLE `client_list` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `image_path` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_added` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_list`
--

INSERT INTO `client_list` (`id`, `firstname`, `lastname`, `contact`, `address`, `email`, `password`, `image_path`, `status`, `delete_flag`, `date_created`, `date_added`) VALUES
(1, 'Jade', 'Lawas', '09123456789', 'Sample Address', 'jadelawas16@gmail.com', 'c7162ff89c647f444fcaa5c635dac8c3', NULL, 1, 0, '2024-03-23 12:01:47', '2024-03-23 12:01:47'),
(3, 'Sample', 'Sample', '09123123123123123', 'asdasfsDfzs', 'client@email.com', '123', 'dasdaser', 1, 0, '2024-04-07 14:21:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `court_list`
--

CREATE TABLE `court_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `price` float(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court_list`
--

INSERT INTO `court_list` (`id`, `name`, `price`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Covered Court Gym', 1000.00, 1, 0, '2022-05-06 09:29:02', '2024-04-07 00:49:23'),
(2, 'Basketball Court Reservation System', 700.00, 1, 0, '2022-05-06 09:30:05', '2024-03-20 13:52:17'),
(6, 'Baranggay', 900.00, 1, 1, '2024-04-06 11:12:11', '2024-04-06 11:26:52'),
(7, 'asda', 123.00, 1, 0, '2024-04-06 11:34:53', '2024-04-06 11:34:53'),
(8, 'Court 3', 500.00, 1, 0, '2024-04-07 00:49:14', '2024-04-07 00:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `court_rentals`
--

CREATE TABLE `court_rentals` (
  `id` int(30) NOT NULL,
  `client_id` int(11) NOT NULL,
  `contact` text NOT NULL,
  `court_id` int(30) NOT NULL,
  `court_price` float(12,2) NOT NULL,
  `datetime_start` datetime NOT NULL,
  `datetime_end` datetime NOT NULL,
  `hours` float(12,2) NOT NULL DEFAULT 0.00,
  `total` float(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = on-going,\r\n1 = Done',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court_rentals`
--

INSERT INTO `court_rentals` (`id`, `client_id`, `contact`, `court_id`, `court_price`, `datetime_start`, `datetime_end`, `hours`, `total`, `status`, `date_created`, `date_updated`) VALUES
(13, 1, 'w', 2, 700.00, '2024-04-07 16:35:00', '2024-04-07 18:35:00', 2.00, 1400.00, 0, '2024-04-06 12:35:50', '2024-04-07 13:06:27'),
(16, 1, 'asd', 1, 500.00, '2024-04-23 12:45:00', '2024-04-24 00:45:00', 12.00, 6000.00, 0, '2024-04-06 12:45:17', '2024-04-07 13:06:35'),
(17, 1, 'wwer', 2, 700.00, '2024-04-06 12:52:00', '2024-04-06 15:52:00', 3.00, 2100.00, 0, '2024-04-06 12:53:02', '2024-04-07 13:06:41'),
(18, 1, 'asd', 2, 700.00, '2024-04-17 12:55:00', '2024-04-17 13:55:00', 1.00, 700.00, 0, '2024-04-06 12:55:22', '2024-04-07 13:06:49'),
(19, 1, 'gfd', 1, 500.00, '2024-04-23 12:57:00', '2024-04-23 13:57:00', 1.00, 500.00, 0, '2024-04-06 12:57:38', '2024-04-07 13:06:56'),
(20, 1, '123', 2, 700.00, '2024-04-18 13:05:00', '2024-04-18 19:05:00', 6.00, 4200.00, 0, '2024-04-06 13:06:04', '2024-04-07 13:07:01'),
(21, 1, '09787876765', 1, 500.00, '2024-04-24 12:58:00', '2024-04-24 20:58:00', 8.00, 4000.00, 0, '2024-04-06 13:21:44', '2024-04-07 13:07:06'),
(22, 1, '0912323123123', 2, 700.00, '2024-04-09 12:30:00', '2024-04-09 15:30:00', 3.00, 2100.00, 1, '2024-04-06 23:36:03', '2024-04-07 13:07:11'),
(23, 1, '09123456789', 2, 700.00, '2024-04-22 12:47:00', '2024-04-22 14:47:00', 2.00, 1400.00, 1, '2024-04-07 00:45:49', '2024-04-07 13:07:16'),
(32, 1, '09787876765', 2, 700.00, '2024-06-18 13:26:00', '2024-06-18 16:26:00', 3.00, 2100.00, 0, '2024-04-07 13:26:11', '2024-04-07 13:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `sales_transaction`
--

CREATE TABLE `sales_transaction` (
  `id` int(30) NOT NULL,
  `client_name` text NOT NULL,
  `contact` text NOT NULL,
  `total` float(12,2) NOT NULL DEFAULT 0.00,
  `court_rental_id` int(30) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_transaction`
--

CREATE TABLE `service_transaction` (
  `id` int(30) NOT NULL,
  `client_name` text NOT NULL,
  `contact` text NOT NULL,
  `total` float(12,2) NOT NULL DEFAULT 0.00,
  `court_rental_id` int(30) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Pending,\r\n1 = Done',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'administrator', '', 'admin', 'admin123', NULL, NULL, 1, '2021-01-20 14:02:37', '2024-04-07 15:19:11'),
(5, 'jade', 'lawas', 'jade', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 2, '2024-03-20 13:57:24', '2024-04-06 11:49:46'),
(6, 'Mack', 'Bacarisas', 'mcb4real', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 1, '2024-04-06 11:10:56', '2024-04-06 11:49:11'),
(7, 'User', 'User', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', NULL, NULL, 2, '2024-04-06 11:11:25', '2024-04-07 14:07:50'),
(8, 'Sample', 'User', 'sample', '332532dcfaa1cbf61e2a266bd723612c', NULL, NULL, 1, '2024-04-07 00:50:34', '2024-04-07 00:51:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_list`
--
ALTER TABLE `client_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indexes for table `court_list`
--
ALTER TABLE `court_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `court_rentals`
--
ALTER TABLE `court_rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `court_id` (`court_id`);

--
-- Indexes for table `sales_transaction`
--
ALTER TABLE `sales_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `court_rental_id_fk_st` (`court_rental_id`);

--
-- Indexes for table `service_transaction`
--
ALTER TABLE `service_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `court_rental_id` (`court_rental_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_list`
--
ALTER TABLE `client_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `court_list`
--
ALTER TABLE `court_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `court_rentals`
--
ALTER TABLE `court_rentals`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sales_transaction`
--
ALTER TABLE `sales_transaction`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_transaction`
--
ALTER TABLE `service_transaction`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales_transaction`
--
ALTER TABLE `sales_transaction`
  ADD CONSTRAINT `court_rental_id_fk_st` FOREIGN KEY (`court_rental_id`) REFERENCES `court_rentals` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `service_transaction`
--
ALTER TABLE `service_transaction`
  ADD CONSTRAINT `court_rental_id_fk_st2` FOREIGN KEY (`court_rental_id`) REFERENCES `court_rentals` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
