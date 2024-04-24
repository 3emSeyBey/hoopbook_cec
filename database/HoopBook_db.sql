-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 01:20 AM
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
  `account_type` int(11) NOT NULL DEFAULT 2 COMMENT '0-admin, 1-staff, 2-user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `firstname`, `lastname`, `email`, `password`, `image_path`, `status`, `delete_flag`, `date_created`, `date_added`, `account_type`) VALUES
(1, 'Jade', 'Lawas', 'user@email.com', 'user123', NULL, 1, 0, '2024-03-23 12:01:47', '2024-03-23 12:01:47', 2),
(3, 'Sample', 'Sample', 'client@email.com', 'client123', 'dasdaser', 1, 0, '2024-04-07 14:21:59', '2024-04-09 13:02:43', 1),
(4, 'Admin', 'Admin', 'admin@email.com', 'admin123', NULL, 1, 0, '2024-04-09 13:03:44', NULL, 0),
(18, 'Samplex', 'User', 'staff2@email.com', 'staff2123', NULL, 1, 0, NULL, NULL, 1);

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
(2, 'Mack', 'Bacarisas', '09122321231', NULL, 'Address', 0),
(3, 'Mack Cloyd', 'Bacarisas', '09123456789', NULL, 'Sitio Gwapo', 0);

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
  `ref_number` text NOT NULL,
  `court_id` int(30) NOT NULL,
  `court_price` float(12,2) NOT NULL,
  `datetime_start` datetime NOT NULL,
  `datetime_end` datetime NOT NULL,
  `hours` float(12,2) NOT NULL DEFAULT 0.00,
  `total` float(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = on-going,\r\n1 = Done',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court_rentals`
--

INSERT INTO `court_rentals` (`id`, `client_id`, `ref_number`, `court_id`, `court_price`, `datetime_start`, `datetime_end`, `hours`, `total`, `status`, `date_created`, `date_updated`) VALUES
(43, 1, 'HB1-04251.00_R86Q', 2, 700.00, '2024-04-25 19:00:00', '2024-04-25 20:00:00', 1.00, 700.00, 0, '2024-04-25 02:53:26', '2024-04-25 02:53:26'),
(44, 1, 'HB1-042903_81GV', 8, 500.00, '2024-04-29 20:00:00', '2024-04-29 23:00:00', 3.00, 1500.00, 0, '2024-04-25 02:55:51', '2024-04-25 02:55:51'),
(45, 1, 'HB1-043002_122W', 2, 700.00, '2024-04-30 19:00:00', '2024-04-30 21:00:00', 2.00, 1400.00, 0, '2024-04-25 06:59:45', '2024-04-25 06:59:45'),
(46, 1, 'HB1-050103_52ZT', 2, 700.00, '2024-05-01 20:00:00', '2024-05-01 23:00:00', 3.00, 2100.00, 0, '2024-04-25 07:00:16', '2024-04-25 07:00:16');

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `clients_list`
--
ALTER TABLE `clients_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `court_list`
--
ALTER TABLE `court_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `court_rentals`
--
ALTER TABLE `court_rentals`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
