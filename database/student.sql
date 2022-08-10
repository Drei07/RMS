-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2022 at 04:32 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `userId` int(145) NOT NULL,
  `LRN` varchar(145) DEFAULT NULL,
  `studentId` varchar(145) DEFAULT NULL,
  `program` varchar(145) DEFAULT NULL,
  `first_name` varchar(145) DEFAULT NULL,
  `middle_name` varchar(145) DEFAULT NULL,
  `last_name` varchar(145) DEFAULT NULL,
  `sex` varchar(145) DEFAULT NULL,
  `birth_date` varchar(145) DEFAULT NULL,
  `age` varchar(145) DEFAULT NULL,
  `place_of_birth` varchar(145) DEFAULT NULL,
  `civil_status` varchar(145) DEFAULT NULL,
  `nationality` varchar(145) DEFAULT NULL,
  `religion` varchar(145) DEFAULT NULL,
  `phone_number` varchar(145) DEFAULT NULL,
  `email` varchar(145) DEFAULT NULL,
  `province` varchar(145) DEFAULT NULL,
  `city` varchar(145) DEFAULT NULL,
  `barangay` varchar(147) DEFAULT NULL,
  `street` varchar(145) DEFAULT NULL,
  `mother_first_name` varchar(145) DEFAULT NULL,
  `mother_middle_name` varchar(145) DEFAULT NULL,
  `mother_last_name` varchar(145) DEFAULT NULL,
  `mother_phone_number` varchar(145) DEFAULT NULL,
  `father_first_name` varchar(145) DEFAULT NULL,
  `father_middle_name` varchar(145) DEFAULT NULL,
  `father_last_name` varchar(145) DEFAULT NULL,
  `father_phone_number` varchar(145) DEFAULT NULL,
  `emergency_contact_person` varchar(145) DEFAULT NULL,
  `emergency_address` varchar(145) DEFAULT NULL,
  `emergency_mobile_number` varchar(145) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`userId`, `studentId`, `program`, `first_name`, `middle_name`, `last_name`, `sex`, `birth_date`, `age`, `place_of_birth`, `civil_status`, `nationality`, `religion`, `phone_number`, `email`, `province`, `city`, `barangay`, `emergency_contact_person`, `emergency_address`, `emergency_mobile_number`, `created_at`, `updated_at`) VALUES
(1, '2018006164', 'Humanities and Social Sciences	', 'Andrei', 'Manalansan', 'Viscayno', 'Male', '2000-07-01', '22', 'Lubao. Pampanga', 'Married', 'Philippines', 'Roman Catholic', '9776621929', 'andrei@gmail.com', '0308', '030805', '030805017', 'Nolita Viscayno', 'Same', '09776621919', '2022-07-06 08:08:20', '2022-07-25 01:42:49'),
(2, '2018006165', 'Accountancy and Business Management	', 'Andrei', 'Manalansan', 'Viscayno', 'Male', '2000-07-01', '22', 'Lubao. Pampanga', 'Married', 'Philippines', 'Roman Catholic', '9776621929', 'andrei@gmail.com', 'Bataan', 'Hermosa', 'Saba', 'Nolita Viscayno', 'Same', '09776621919', '2022-07-06 08:11:13', '2022-07-25 01:42:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `userId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
