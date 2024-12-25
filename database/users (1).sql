-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Dec 25, 2024 at 08:49 PM
-- Server version: 10.11.8-MariaDB-ubu2204-log
-- PHP Version: 8.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `gender`, `password`, `created_at`, `updated_at`, `role`) VALUES
(1, 'afaq', 'afaq@gmail.com', '0293092309', 'Male', '$2y$10$9xYAzRcZ08we5X4KcTK0.OvAtQThVsrQPwnzj8ped07dX1OqHPQyu', '2024-12-25 10:48:44', '2024-12-25 10:48:44', 'user'),
(2, 'irfan', 'irfanullah8874@gmail.com', '03143896166', 'Male', '$2y$10$yEFg0OntmbQPUgIt0rqhOu2N8tchxWSyioZvvznc.L0xfPpdG9sDe', '2024-12-25 10:56:25', '2024-12-25 20:21:52', 'admin'),
(4, 'bilal', 'bilal@gmail.com', '123456789', 'Male', '$2y$10$fP0PbE2qE3/a/pVuR3N1bOB5CsMWiu52uqafqXQorrW5Vbw.IZYv6', '2024-12-25 11:03:23', '2024-12-25 11:03:23', 'user'),
(5, 'wasim', 'wasim@gmail.com', '64839249932277', 'Male', '$2y$10$Fudp.oyl5bU1K5Tc19.R5.4HCN1OXyJ1HKeRnizUKbyJsuwf/m9Wy', '2024-12-25 11:42:37', '2024-12-25 11:42:37', 'user'),
(6, 'afaq', 'afaqraza0220@gmail.com', '323092302', 'Male', '$2y$10$RjhtFylszHbn/MXfDWboHODZ.ENjGoVrXMyWSPA3KwLlJsPx2tWoW', '2024-12-25 11:47:39', '2024-12-25 11:47:39', 'user'),
(9, 'admin', 'admin@gmail.com', '12345', 'Male', '$2y$10$5dprKD1nje6qklAc1de3BuwOKaAlBtHavoeIPQDLVJwI2uDuLFnyC', '2024-12-25 20:27:19', '2024-12-25 20:27:19', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
