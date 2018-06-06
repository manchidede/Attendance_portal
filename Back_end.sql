-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2018 at 12:05 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.1.17-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Back_end`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `userId` int(11) NOT NULL,
  `timein` varchar(15) DEFAULT NULL,
  `timeout` varchar(15) DEFAULT 'none',
  `date` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`userId`, `timein`, `timeout`, `date`) VALUES
(14, '04:43:23 PM', '04:44:01 PM', '06/05/2018');

-- --------------------------------------------------------

--
-- Table structure for table `personalInfo`
--

CREATE TABLE `personalInfo` (
  `id` int(11) NOT NULL,
  `first_name` varchar(199) DEFAULT NULL,
  `last_name` varchar(199) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(199) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` text,
  `dob` date DEFAULT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personalInfo`
--

INSERT INTO `personalInfo` (`id`, `first_name`, `last_name`, `username`, `password`, `gender`, `email`, `phone`, `address`, `dob`, `image`) VALUES
(14, 'Okafor', 'Callistus', 'admin', '$2y$10$iP/./P5yDDCDybD6D5pvaOg2lWoYZsRiFIcEK/LNC/Yg.Fd/r7vy.', 'male', 'olotu@devsq.co', '8063483130', 'No 2 chukwu street', '2018-10-01', 'uploads/IMG_20170806_164616.jpg'),
(15, 'Tonye', 'Lian', 'lian', '$2y$10$bNTALmVU/125hbA780lVxeahddf9nPqyYZkC4dNWkmvZRRWXMXv1a', 'female', 'Tonye@devsq.co', '0902384855', 'No 2 Isiokpo Junction, Borikiri', '2000-06-14', 'uploads/IMG_20170122_145001.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ref` varchar(20) NOT NULL,
  `amount` double NOT NULL,
  `status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `ref`, `amount`, `status`) VALUES
(2, 2, 'ABCD', 30.3, 0),
(4, 3, 'AfrD', 30.3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`) VALUES
(2, 'Mine', 'michael@olotu.co', 0),
(3, 'Philip', 'Phil@olotu.co', 0),
(4, 'tony', 'tony@olotu.co', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `personalInfo`
--
ALTER TABLE `personalInfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ref` (`ref`),
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
-- AUTO_INCREMENT for table `personalInfo`
--
ALTER TABLE `personalInfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `personalInfo` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
