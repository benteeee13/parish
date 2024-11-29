-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2024 at 07:35 PM
-- Server version: 9.0.1
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parish`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin1', 'admin1@gmail.com', 'cuteko'),
(2, 'admin2', 'admin2@gmail.com', 'cuteko');

-- --------------------------------------------------------

--
-- Table structure for table `available_schedule`
--

CREATE TABLE `available_schedule` (
  `id` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` enum('available','scheduled') COLLATE utf8mb4_general_ci DEFAULT 'available',
  `details` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `available_schedule`
--

INSERT INTO `available_schedule` (`id`, `date`, `time`, `status`, `details`, `created_at`, `updated_at`) VALUES
(1, '2024-11-22', '07:30:00', 'available', 'Available', '2024-11-22 10:01:28', '2024-11-22 10:01:28'),
(2, '2024-11-25', '10:30:00', 'scheduled', 'Scheduled', '2024-11-22 10:02:48', '2024-11-22 10:02:48'),
(3, '2024-11-27', '10:00:00', 'available', 'Free\r\n', '2024-11-22 13:33:11', '2024-11-22 13:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `baptism_applications`
--

CREATE TABLE `baptism_applications` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `child_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `godmother_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `godfather_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_baptized` date NOT NULL,
  `time_baptized` time NOT NULL,
  `contact_info` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_general_ci,
  `status` enum('pending','approved','rejected','completed','cancelled') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `is_forwarded` tinyint(1) DEFAULT '0',
  `application_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baptism_applications`
--

INSERT INTO `baptism_applications` (`id`, `username`, `child_name`, `mother_name`, `father_name`, `godmother_name`, `godfather_name`, `date_baptized`, `time_baptized`, `contact_info`, `comments`, `status`, `is_forwarded`, `application_date`, `is_deleted`) VALUES
(1, 'renn07', 'Ethan C. Porter', 'Evelyn V. Turner', 'James C. Porter', 'Lily V. Turner', 'Noah S. Walker', '2024-11-21', '18:12:00', '09123456789', 'Thanks', 'completed', 1, '2024-11-21 09:24:15', 0),
(2, 'renn07', '1', '2', '3', '4', '5', '2024-11-22', '08:30:00', '6', '7', 'completed', 1, '2024-11-21 09:37:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `baptism_requests`
--

CREATE TABLE `baptism_requests` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `child_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `godmother_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `godfather_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `baptism_date` date NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `comments` text COLLATE utf8mb4_general_ci,
  `request_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baptism_requests`
--

INSERT INTO `baptism_requests` (`id`, `username`, `child_name`, `mother_name`, `father_name`, `godmother_name`, `godfather_name`, `baptism_date`, `contact`, `comments`, `request_date`) VALUES
(1, 'inno', 'Test', 'Test', 'Test', 'Test', 'Test', '2024-09-23', 'Test', 'Test', '2024-11-25 14:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `funeral_applications`
--

CREATE TABLE `funeral_applications` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deceased_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `requestor_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_of_mass` date NOT NULL,
  `time_of_mass` time NOT NULL,
  `contact_info` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_place` enum('church','house') COLLATE utf8mb4_general_ci NOT NULL,
  `comments` text COLLATE utf8mb4_general_ci,
  `status` enum('pending','approved','rejected','completed','cancelled') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `is_forwarded` tinyint(1) DEFAULT '0',
  `application_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `funeral_applications`
--

INSERT INTO `funeral_applications` (`id`, `username`, `deceased_name`, `requestor_name`, `date_of_mass`, `time_of_mass`, `contact_info`, `service_place`, `comments`, `status`, `is_forwarded`, `application_date`, `is_deleted`) VALUES
(1, NULL, 'User1', 'Requestor1', '2024-11-24', '22:00:00', '09154336214', 'church', 'N/A', 'completed', 1, '2024-11-22 14:08:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mass_applications`
--

CREATE TABLE `mass_applications` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `requester_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_of_mass` date NOT NULL,
  `time_of_mass` time NOT NULL,
  `have_parish_choir` enum('yes','no') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_info` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_general_ci,
  `status` enum('pending','approved','rejected','completed','cancelled') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `is_forwarded` tinyint(1) DEFAULT '0',
  `application_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mass_applications`
--

INSERT INTO `mass_applications` (`id`, `username`, `requester_name`, `address`, `date_of_mass`, `time_of_mass`, `have_parish_choir`, `contact_info`, `comments`, `status`, `is_forwarded`, `application_date`, `is_deleted`) VALUES
(1, 'inno', 'Inno', 'Pulilan, Bulacan', '2024-12-25', '09:00:00', 'no', '09154336214', 'N/A', 'approved', 1, '2024-11-22 12:58:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `body` text COLLATE utf8mb4_general_ci NOT NULL,
  `date_sent` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) DEFAULT '0',
  `sender` enum('user','admin') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `receiver` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `username`, `subject`, `body`, `date_sent`, `is_read`, `sender`, `receiver`) VALUES
(75, 'inno', '', 'How can I book a mass?', '2024-11-26 10:56:37', 1, 'user', NULL),
(76, 'inno', '', 'How can I book a mass?', '2024-11-26 10:56:37', 1, 'user', NULL),
(77, 'inno', '', 'Hey', '2024-11-26 10:58:22', 1, 'admin', NULL),
(78, 'inno', '', 'What is the process for canceling a reservation?', '2024-11-26 10:58:29', 1, 'user', NULL),
(79, 'inno', '', 'How are you?', '2024-11-26 11:02:30', 1, 'admin', NULL),
(80, 'equi', '', 'How can I book a mass?', '2024-11-26 11:03:29', 1, 'user', NULL),
(81, 'inno', '', 'Hi', '2024-11-26 11:11:33', 1, 'user', NULL),
(82, 'inno', '', 'What are the available schedules for masses?', '2024-11-26 11:50:08', 1, 'user', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `otp_verification`
--

CREATE TABLE `otp_verification` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `otp_code` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `is_used` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_verification`
--

INSERT INTO `otp_verification` (`id`, `user_id`, `otp_code`, `expires_at`, `is_used`) VALUES
(1, 3, '822892', '2024-11-25 14:49:03', 0),
(26, 3, '864250', '2024-11-25 14:49:22', 1),
(27, 3, '731805', '2024-11-25 14:49:41', 0),
(28, 3, '527736', '2024-11-25 14:50:40', 0),
(29, 3, '859698', '2024-11-25 15:25:21', 1),
(30, 3, '572140', '2024-11-25 16:11:08', 1),
(31, 3, '907723', '2024-11-26 11:02:58', 0),
(32, 3, '444022', '2024-11-26 11:03:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'superAdmin1', 'admin1@example.com', 'cuteko'),
(2, 'superAdmin2', 'admin2@example.com', 'cuteko');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_num` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_pic` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `is_restricted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `contact_num`, `password`, `created_at`, `profile_pic`, `address`, `birthday`, `is_restricted`) VALUES
(1, 'renn07@gmail.com', 'renn07', '09983784684', '$2y$10$/nxRyvz1ekhJIx48ZbITcesZMH7IeKjFc6YycH6CWC/D9ITmgfVFi', '2024-11-21 08:09:09', '../uploads/profile_pictures/6748b514005927.75261663.jpg', 'Pulilan, Bulacan', '2002-03-07', 0),
(2, 'user1@gmail.com', 'user1', '09987654321', '$2y$10$T9j1xDKerGxf0Upx/CzcceqnhNrJaF7RlpvPhUF7H2A1e3ao5wpVm', '2024-11-21 09:25:24', NULL, NULL, NULL, 0),
(3, 'innovatrix10@gmail.com', 'inno', '09755135579', '$2y$10$w9Gp8RMi26IKmKwawdJKpuYbp04.Jfp/QRzj8YlNrdU9KWYwzUlNi', '2024-11-22 12:56:32', '../uploads/profile_pictures/6740a326dc81a1.61748244.png', '', '0000-00-00', 0),
(4, 'ezpz4equi@gmail.com', 'equi', '09312254587', '$2y$10$Nc/LSJ/J.uIeDrgPokYM/O3nUMl/pNMLZHtUD/ToV7qy7rH6656IC', '2024-11-22 17:27:12', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wedding_applications`
--

CREATE TABLE `wedding_applications` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `groom_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bride_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_married` date NOT NULL,
  `time_married` time NOT NULL,
  `contact_info` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `comments` text COLLATE utf8mb4_general_ci,
  `status` enum('pending','approved','rejected','completed','canceled') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `is_forwarded` tinyint(1) DEFAULT '0',
  `application_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wedding_applications`
--

INSERT INTO `wedding_applications` (`id`, `username`, `groom_name`, `bride_name`, `date_married`, `time_married`, `contact_info`, `comments`, `status`, `is_forwarded`, `application_date`, `is_deleted`) VALUES
(1, NULL, 'Ethan Michael Reyes', 'Sophia Anne Cruz', '2020-06-12', '10:30:00', 'ethan123@gmail.com', NULL, 'completed', 1, '2024-11-28 12:02:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wedding_requests`
--

CREATE TABLE `wedding_requests` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `groom_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bride_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `wedding_date` date NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `comments` text COLLATE utf8mb4_general_ci,
  `request_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `available_schedule`
--
ALTER TABLE `available_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baptism_applications`
--
ALTER TABLE `baptism_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baptism_requests`
--
ALTER TABLE `baptism_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funeral_applications`
--
ALTER TABLE `funeral_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mass_applications`
--
ALTER TABLE `mass_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_verification`
--
ALTER TABLE `otp_verification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wedding_applications`
--
ALTER TABLE `wedding_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wedding_requests`
--
ALTER TABLE `wedding_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `available_schedule`
--
ALTER TABLE `available_schedule`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `baptism_applications`
--
ALTER TABLE `baptism_applications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `baptism_requests`
--
ALTER TABLE `baptism_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `funeral_applications`
--
ALTER TABLE `funeral_applications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mass_applications`
--
ALTER TABLE `mass_applications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `otp_verification`
--
ALTER TABLE `otp_verification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wedding_applications`
--
ALTER TABLE `wedding_applications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wedding_requests`
--
ALTER TABLE `wedding_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `otp_verification`
--
ALTER TABLE `otp_verification`
  ADD CONSTRAINT `otp_verification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
