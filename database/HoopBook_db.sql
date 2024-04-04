-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 06:57 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_list`
--

INSERT INTO `client_list` (`id`, `firstname`, `lastname`, `contact`, `address`, `email`, `password`, `status`, `delete_flag`, `date_created`, `date_added`) VALUES
(1, 'Jade', 'Lawas', '09123456789', 'Sample Address', 'jadelawas16@gmail.com', 'c7162ff89c647f444fcaa5c635dac8c3', 1, 0, '2024-03-23 12:01:47', '2024-03-23 12:01:47');


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
(1, 'Covered Court Gym', 500.00, 1, 0, '2022-05-06 09:29:02', '2024-03-20 13:52:04'),
(2, 'Basketball Court Reservation System', 700.00, 1, 0, '2022-05-06 09:30:05', '2024-03-20 13:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `court_rentals`
--

CREATE TABLE `court_rentals` (
  `id` int(30) NOT NULL,
  `client_name` text NOT NULL,
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

INSERT INTO `court_rentals` (`id`, `client_name`, `contact`, `court_id`, `court_price`, `datetime_start`, `datetime_end`, `hours`, `total`, `status`, `date_created`, `date_updated`) VALUES
(3, 'JADE', '2131231231', 2, 700.00, '2024-03-20 13:00:00', '2024-03-20 17:00:00', 4.00, 2800.00, 0, '2024-03-20 13:54:57', '2024-03-20 13:54:57');

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

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'administrator', NULL, 'admin', '0192023a7bbd73250516f069df18b500', NULL, 1, '2021-01-20 14:02:37', '2022-04-13 15:24:24'),
(5, 'jade', 'lawas', 'jade', '0192023a7bbd73250516f069df18b500', NULL, 2, '2024-03-20 13:57:24', '2024-03-20 13:57:24');

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `court_list`
--
ALTER TABLE `court_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `court_rentals`
--
ALTER TABLE `court_rentals`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
