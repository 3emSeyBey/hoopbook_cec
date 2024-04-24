-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 01:11 PM
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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `image_path` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `account_type` int(11) NOT NULL DEFAULT 1 COMMENT '0-admin, 1-staff, 2-user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `firstname`, `lastname`, `email`, `password`, `image_path`, `status`, `delete_flag`, `date_created`, `date_added`, `account_type`) VALUES
(1, 'Jade', 'Lawas', 'user@email.com', 'user123', NULL, 1, 0, '2024-03-23 12:01:47', '2024-03-23 12:01:47', 2),
(3, 'Sample', 'Sample', 'client@email.com', 'client123', 'dasdaser', 1, 0, '2024-04-07 14:21:59', '2024-04-09 13:02:43', 1),
(4, 'Admin', 'Admin', 'admin@email.com', 'admin123', NULL, 1, 0, '2024-04-09 13:03:44', NULL, 0),
(18, 'Samplex', 'User', 'staff2@email.com', 'staff2123', NULL, 1, 0, NULL, NULL, 1),
(19, 'Mack', 'Bacarisas', 'mackcloydbacarisas@gmail.com', 'Ambotlang123!', NULL, 1, 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients_list`
--

CREATE TABLE `clients_list` (
  `id` int(11) NOT NULL,
  `firstname` text DEFAULT NULL,
  `lastname` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients_list`
--

INSERT INTO `clients_list` (`id`, `firstname`, `lastname`, `contact`, `email`, `address`, `account_id`) VALUES
(1, 'Client', 'One', '09123123123123', 'eemseybey@gmail.com', 'asdasdasd', 1),
(2, 'Mack', 'Bacarisas', '09122321231', NULL, 'Address', 0);

-- --------------------------------------------------------

--
-- Table structure for table `court_list`
--

CREATE TABLE `court_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `price` float(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `img_src` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court_list`
--

INSERT INTO `court_list` (`id`, `name`, `price`, `status`, `img_src`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Covered Court Gym', 1000.00, 1, '../image/facility-1.jpeg', 0, '2022-05-06 09:29:02', '2024-04-07 00:49:23'),
(2, 'Basketball Court Reservation System', 700.00, 1, '../image/facility-2.jpg', 0, '2022-05-06 09:30:05', '2024-03-20 13:52:17'),
(6, 'Baranggay', 900.00, 1, '', 1, '2024-04-06 11:12:11', '2024-04-06 11:26:52'),
(7, 'asda', 500.00, 1, '', 1, '2024-04-06 11:34:53', '2024-04-09 14:47:16'),
(8, 'Court 3', 500.00, 1, '', 0, '2024-04-07 00:49:14', '2024-04-07 00:49:14'),
(9, 'dummy', 1000000.00, 1, '', 0, '2024-04-09 14:47:29', '2024-04-09 14:47:29');

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
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court_rentals`
--

INSERT INTO `court_rentals` (`id`, `client_id`, `contact`, `court_id`, `court_price`, `datetime_start`, `datetime_end`, `hours`, `total`, `status`, `date_created`, `date_updated`) VALUES
(16, 1, 'asd', 1, 500.00, '2024-04-23 12:45:00', '2024-04-24 00:45:00', 12.00, 6000.00, 1, '2024-04-06 12:45:17', '2024-04-07 13:06:35'),
(17, 1, 'wwer', 2, 700.00, '2024-04-06 12:52:00', '2024-04-06 15:52:00', 3.00, 2100.00, 0, '2024-04-06 12:53:02', '2024-04-07 13:06:41'),
(18, 1, 'asd', 2, 700.00, '2024-04-17 12:55:00', '2024-04-17 13:55:00', 1.00, 700.00, 0, '2024-04-06 12:55:22', '2024-04-07 13:06:49'),
(19, 1, 'gfd', 1, 500.00, '2024-04-23 12:57:00', '2024-04-23 13:57:00', 1.00, 500.00, 0, '2024-04-06 12:57:38', '2024-04-07 13:06:56'),
(20, 1, '123', 2, 700.00, '2024-04-18 13:05:00', '2024-04-18 19:05:00', 6.00, 4200.00, 0, '2024-04-06 13:06:04', '2024-04-07 13:07:01'),
(21, 1, '09787876765', 1, 500.00, '2024-04-24 12:58:00', '2024-04-24 20:58:00', 8.00, 4000.00, 0, '2024-04-06 13:21:44', '2024-04-07 13:07:06'),
(22, 1, '0912323123123', 2, 700.00, '2024-04-09 12:30:00', '2024-04-09 15:30:00', 3.00, 2100.00, 1, '2024-04-06 23:36:03', '2024-04-07 13:07:11'),
(23, 1, '09123456789', 2, 700.00, '2024-04-22 12:47:00', '2024-04-22 14:47:00', 2.00, 1400.00, 1, '2024-04-07 00:45:49', '2024-04-07 13:07:16'),
(32, 1, '09787876765', 2, 700.00, '2024-06-18 13:26:00', '2024-06-18 16:26:00', 3.00, 2100.00, 0, '2024-04-07 13:26:11', '2024-04-07 13:26:11'),
(33, 7, '09123123123', 2, 700.00, '2024-07-10 14:37:00', '2024-07-10 15:37:00', 1.00, 700.00, 0, '2024-04-09 14:38:13', '2024-04-09 14:45:32'),
(34, 1, '0909898098097', 8, 500.00, '2024-04-30 14:56:00', '2024-04-30 15:56:00', 1.00, 500.00, 0, '2024-04-09 14:57:04', '2024-04-09 14:57:04'),
(35, 1, '09123456789', 8, 500.00, '2024-04-09 20:43:00', '2024-04-09 21:43:00', 1.00, 500.00, 0, '2024-04-09 15:46:26', '2024-04-09 15:46:26'),
(36, 1, '09167676543', 2, 700.00, '2024-04-23 20:02:00', '2024-04-23 21:02:00', 1.00, 700.00, 0, '2024-04-09 16:02:18', '2024-04-09 16:02:18'),
(37, 1, '09878765453', 8, 500.00, '2024-04-22 16:02:00', '2024-04-22 17:02:00', 1.00, 500.00, 0, '2024-04-09 16:02:53', '2024-04-09 16:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `sales_transaction`
--

CREATE TABLE `sales_transaction` (
  `id` int(30) NOT NULL,
  `client_id` int(11) NOT NULL,
  `total` float(12,2) NOT NULL DEFAULT 0.00,
  `court_rental_id` int(30) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `delete_flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_list`
--
ALTER TABLE `clients_list`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `clients_list`
--
ALTER TABLE `clients_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `court_list`
--
ALTER TABLE `court_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `court_rentals`
--
ALTER TABLE `court_rentals`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sales_transaction`
--
ALTER TABLE `sales_transaction`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales_transaction`
--
ALTER TABLE `sales_transaction`
  ADD CONSTRAINT `court_rental_id_fk_st` FOREIGN KEY (`court_rental_id`) REFERENCES `court_rentals` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
