-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 03:22 PM
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
-- Table structure for table `academic_programs`
--

CREATE TABLE `academic_programs` (
  `Id` int(145) NOT NULL,
  `programID` varchar(145) DEFAULT NULL,
  `programs` varchar(145) DEFAULT NULL,
  `acronym` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_programs`
--

INSERT INTO `academic_programs` (`Id`, `programID`, `programs`, `acronym`, `created_at`, `updated_at`) VALUES
(1, '80874241', 'Science, Technology, Engineering, and Mathematics', 'STEM', '2022-07-11 13:31:34', NULL),
(2, '94374304', 'Tech-Voc Track', 'TVL', '2022-07-12 00:03:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `userId` int(145) NOT NULL,
  `employeeId` varchar(145) DEFAULT NULL,
  `adminPosition` varchar(145) DEFAULT NULL,
  `adminFirst_Name` varchar(145) DEFAULT NULL,
  `adminMiddle_Name` varchar(145) DEFAULT NULL,
  `adminLast_Name` varchar(145) DEFAULT NULL,
  `adminEmail` varchar(145) DEFAULT NULL,
  `adminPassword` varchar(145) DEFAULT NULL,
  `adminStatus` enum('Y','N') DEFAULT 'N',
  `tokencode` varchar(145) DEFAULT NULL,
  `adminProfile` varchar(1145) NOT NULL DEFAULT 'profile.png',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userId`, `employeeId`, `adminPosition`, `adminFirst_Name`, `adminMiddle_Name`, `adminLast_Name`, `adminEmail`, `adminPassword`, `adminStatus`, `tokencode`, `adminProfile`, `created_at`, `updated_at`) VALUES
(1, '724758478978497', 'web Dev', 'Andrei', 'Manalansan', 'Viscayno', 'andrei.m.viscayno@gmail.com', '169b7c16679df9a7daa4efe1cdd43e55', 'Y', 'd5cbbb984afb41c1adf88a8e19740cc9', 'profile.png', '2022-07-07 05:19:44', '2022-07-12 11:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `email_config`
--

CREATE TABLE `email_config` (
  `Id` int(145) NOT NULL,
  `email` varchar(145) DEFAULT NULL,
  `password` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_config`
--

INSERT INTO `email_config` (`Id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'andrei.m.viscayno@gmail.com', 'zgyivspimzmjortq', '2022-07-08 04:41:51', '2022-07-08 09:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `google_recaptcha_api`
--

CREATE TABLE `google_recaptcha_api` (
  `Id` int(11) NOT NULL,
  `site_key` varchar(145) DEFAULT NULL,
  `site_secret_key` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `google_recaptcha_api`
--

INSERT INTO `google_recaptcha_api` (`Id`, `site_key`, `site_secret_key`, `created_at`, `updated_at`) VALUES
(1, '6LfeHlkdAAAAABiHm93II8UuYYtIs8WFhSIiWQ-B', '6LfeHlkdAAAAAA3NYvNccc_FqzGi2Y6wiGGCOG1s', '2022-07-08 04:29:37', '2022-07-12 07:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `userId` int(145) NOT NULL,
  `studentId` varchar(145) DEFAULT NULL,
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
  `emergency_contact_person` varchar(145) DEFAULT NULL,
  `emergency_address` varchar(145) DEFAULT NULL,
  `emergency_mobile_number` varchar(145) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`userId`, `studentId`, `first_name`, `middle_name`, `last_name`, `sex`, `birth_date`, `age`, `place_of_birth`, `civil_status`, `nationality`, `religion`, `phone_number`, `email`, `province`, `city`, `barangay`, `emergency_contact_person`, `emergency_address`, `emergency_mobile_number`, `created_at`, `updated_at`) VALUES
(1, '2018006164', 'Andrei', 'Manalansan', 'Viscayno', 'Male', '2000-07-01', '22', 'Lubao. Pampanga', 'Married', 'Philippines', 'Roman Catholic', '9776621929', 'andrei@gmail.com', '0308', '030805', '030805017', 'Nolita Viscayno', 'Same', '09776621919', '2022-07-06 08:08:20', '2022-07-12 12:56:20'),
(2, '2018006164', 'Andrei', 'Manalansan', 'Viscayno', 'Male', '2000-07-01', '22', 'Lubao. Pampanga', 'Married', 'Philippines', 'Roman Catholic', '9776621929', 'andrei@gmail.com', 'Bataan', 'Hermosa', 'Saba', 'Nolita Viscayno', 'Same', '09776621919', '2022-07-06 08:11:13', '2022-07-12 12:57:04'),
(3, '2018006164', 'Andrei', 'Manalansan', 'Viscayno', 'Male', '2000-07-01', '22', 'Lubao. Pampanga', 'Married', 'Philippines', 'Roman Catholic', '9776621929', 'andrei@gmail.com', '0308', '030805', '030805017', 'Nolita Viscayno', 'Same', '09776621919', '2022-07-06 10:28:26', '2022-07-12 12:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `subjects_80874241`
--

CREATE TABLE `subjects_80874241` (
  `subjectId` int(145) NOT NULL,
  `year_level` varchar(125) DEFAULT NULL,
  `subject_name` varchar(125) DEFAULT NULL,
  `subject_code` varchar(125) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects_80874241`
--

INSERT INTO `subjects_80874241` (`subjectId`, `year_level`, `subject_name`, `subject_code`, `created_at`, `updated_at`) VALUES
(1, 'Grade11', 'Filipino', '1234', '2022-07-11 13:32:26', NULL),
(2, 'Grade12', 'English', '2345', '2022-07-11 13:32:26', '2022-07-11 13:32:52'),
(4, 'Grade11', 'Math', '954445', '2022-07-12 01:25:25', NULL),
(5, 'Grade12', 'Science', '25254', '2022-07-12 01:26:53', NULL),
(6, 'Grade12', 'AP', '7769', '2022-07-12 01:27:59', NULL),
(7, 'Grade11', 'SAMPLE', '982396', '2022-07-12 01:30:32', NULL),
(8, 'Grade12', 'Sample', '143143', '2022-07-12 01:48:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects_94374304`
--

CREATE TABLE `subjects_94374304` (
  `subjectId` int(145) NOT NULL,
  `year_level` varchar(125) DEFAULT NULL,
  `subject_name` varchar(125) DEFAULT NULL,
  `subject_code` varchar(125) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `superadminId` int(145) NOT NULL,
  `name` varchar(145) DEFAULT NULL,
  `email` varchar(145) DEFAULT NULL,
  `password` varchar(145) DEFAULT NULL,
  `tokencode` varchar(145) DEFAULT NULL,
  `profile` varchar(1145) NOT NULL DEFAULT 'profile.png',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`superadminId`, `name`, `email`, `password`, `tokencode`, `profile`, `created_at`, `updated_at`) VALUES
(1, 'Andrei Shania', 'andrei.m.viscayno@gmail.com', '24b35e91f6650c460b66bceaa1590664', 'cf3d41ef87dbd96fe6b963af1eb9c0f6', '277399615_569876624139676_2603790700276582101_n.jpg', '2022-07-03 00:09:13', '2022-07-12 11:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `system_config`
--

CREATE TABLE `system_config` (
  `Id` int(14) NOT NULL,
  `system_name` varchar(145) DEFAULT NULL,
  `system_number` varchar(145) DEFAULT NULL,
  `system_email` varchar(145) DEFAULT NULL,
  `copy_right` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_config`
--

INSERT INTO `system_config` (`Id`, `system_name`, `system_number`, `system_email`, `copy_right`, `created_at`, `updated_at`) VALUES
(1, 'RMS PH', '9776621929', 'andrei.m.viscayno@gmail.com', 'Copyright 2022 AMV. All right reserved', '2022-07-08 12:38:28', '2022-07-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `system_logo`
--

CREATE TABLE `system_logo` (
  `Id` int(145) NOT NULL,
  `logo` varchar(1145) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_logo`
--

INSERT INTO `system_logo` (`Id`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'SVNSH.jpg', '2022-07-08 08:11:27', '2022-07-09 09:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `tb_logs`
--

CREATE TABLE `tb_logs` (
  `activityId` int(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `email` varchar(145) NOT NULL,
  `activity` varchar(145) NOT NULL,
  `date` varchar(145) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_logs`
--

INSERT INTO `tb_logs` (`activityId`, `user`, `email`, `activity`, `date`) VALUES
(1, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:08:43 PM'),
(2, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:08:59 PM'),
(3, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:09:12 PM'),
(4, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:09:24 PM'),
(5, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:11:05 PM'),
(6, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:17:15 PM'),
(7, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-11-20 01:17:40 PM'),
(8, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:30:24 PM'),
(9, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:33:01 PM'),
(10, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:33:21 PM'),
(11, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-11-20 01:34:05 PM'),
(12, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:35:39 PM'),
(13, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:36:08 PM'),
(14, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:36:39 PM'),
(15, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-11-20 01:37:16 PM'),
(16, 'Admin andrei', 'andrei@gmail.com', 'Has successfully signed in', '2021-11-20 08:19:03 PM'),
(17, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 08:19:55 PM'),
(18, 'Admin andrei', 'andrei@gmail.com', 'Has successfully signed in', '2021-11-20 08:20:19 PM'),
(19, 'Admin andrei', 'andrei@gmail.com', 'Has successfully signed in', '2021-11-21 07:16:21 AM'),
(20, 'Admin Jollibee', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-11-21 11:15:25 AM'),
(21, 'Admin andrei', 'andrei@gmail.com', 'Has successfully signed in', '2021-11-21 12:22:57 PM'),
(22, 'Admin Mcdo', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-21 02:32:39 PM'),
(23, 'Admin andrei', 'andrei@gmail.com', 'Has successfully signed in', '2021-11-21 08:23:49 PM'),
(24, 'Admin Mcdo', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-21 08:26:17 PM'),
(25, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-24 11:02:44 PM'),
(26, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-25 09:34:11 AM'),
(27, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-25 09:56:43 AM'),
(28, 'Admin Mcdo', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-28 09:26:43 AM'),
(29, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-01 09:26:07 AM'),
(30, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-05 07:37:34 AM'),
(31, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-05 08:06:58 AM'),
(32, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-08 08:17:55 AM'),
(33, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-12-08 09:57:24 PM'),
(34, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-09 02:33:18 PM'),
(35, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-10 04:48:44 PM'),
(36, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-12-13 09:06:17 AM'),
(37, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-12-13 01:40:46 PM'),
(38, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-22 03:19:25 PM'),
(39, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-12-24 09:33:37 AM'),
(40, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-12-24 12:50:46 PM'),
(41, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-24 08:32:36 PM'),
(42, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-28 04:16:33 PM'),
(43, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-28 04:50:24 PM'),
(44, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-12-28 08:33:37 PM'),
(45, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-29 09:45:52 AM'),
(46, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 08:21:50 AM'),
(47, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 09:38:23 AM'),
(48, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 09:39:26 AM'),
(49, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 09:58:49 AM'),
(50, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 09:59:21 AM'),
(51, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 09:59:30 AM'),
(52, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 09:59:59 AM'),
(53, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 10:40:26 AM'),
(54, 'Admin Jollibee Hermosa', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-03 10:42:14 AM'),
(55, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 10:43:10 AM'),
(56, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 05:47:43 PM'),
(57, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-04 10:12:06 AM'),
(58, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-04 10:53:54 AM'),
(59, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-04 12:50:00 PM'),
(60, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-05 11:35:33 AM'),
(61, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-05 12:55:56 PM'),
(62, 'Admin BDO Lubao, Pampanga', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-06 05:15:44 PM'),
(63, 'Admin BDO Lubao, Pampanga', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-07 09:04:43 AM'),
(64, 'Admin BDO Lubao Pampanga', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-07 09:08:40 AM'),
(65, 'Admin BDO Lubao Pampanga', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-07 09:09:24 AM'),
(66, 'Admin BDO Lubao Pampanga', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-07 09:12:39 AM'),
(67, 'Admin BDO Lubao Pampanga', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-07 09:14:13 AM'),
(68, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-07 01:44:10 PM'),
(69, 'Admin Cebuana Lhuillier Pawnshop Lubao', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-07 03:19:50 PM'),
(70, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-07 03:20:39 PM'),
(71, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-06-30 09:03:00 PM'),
(72, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-06-30 09:04:36 PM'),
(73, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-06-30 09:09:04 PM'),
(74, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-06-30 09:11:25 PM'),
(75, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-06-30 09:12:02 PM'),
(76, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-06-30 09:25:20 PM'),
(77, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 08:19:01 AM'),
(78, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 09:00:51 AM'),
(79, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 09:02:56 AM'),
(80, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 09:05:08 AM'),
(81, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 09:16:14 AM'),
(82, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 09:23:13 AM'),
(83, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 09:44:05 AM'),
(84, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-01 10:53:12 AM'),
(85, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-01 10:53:37 AM'),
(86, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-01 03:15:00 PM'),
(87, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-02 07:14:23 AM'),
(88, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-02 07:54:30 AM'),
(89, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-02 08:19:01 AM'),
(90, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-02 08:25:52 AM'),
(91, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-02 09:43:49 AM'),
(92, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-02 09:55:58 PM'),
(93, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:17:19 AM'),
(94, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:21:05 AM'),
(95, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:22:03 AM'),
(96, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:22:37 AM'),
(97, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-03 08:24:52 AM'),
(98, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-03 08:25:26 AM'),
(99, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:25:48 AM'),
(100, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:26:09 AM'),
(101, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:26:24 AM'),
(102, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:27:41 AM'),
(103, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:31:00 AM'),
(104, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:31:11 AM'),
(105, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:32:01 AM'),
(106, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:34:00 AM'),
(107, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:45:58 AM'),
(108, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 09:16:38 AM'),
(109, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 09:14:33 PM'),
(110, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-04 06:57:22 AM'),
(111, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-04 01:25:00 PM'),
(112, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-04 07:22:34 PM'),
(113, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-04 07:27:44 PM'),
(114, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-04 11:43:38 PM'),
(115, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-04 11:44:48 PM'),
(116, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 09:43:19 AM'),
(117, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 09:50:00 AM'),
(118, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 10:28:15 AM'),
(119, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 11:38:02 AM'),
(120, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 11:46:38 AM'),
(121, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 01:04:39 PM'),
(122, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 04:59:30 PM'),
(123, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 07:35:18 PM'),
(124, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-06 06:55:27 AM'),
(125, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-06 08:12:32 AM'),
(126, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 11:47:49 AM'),
(127, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:26:52 PM'),
(128, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:27:18 PM'),
(129, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:29:26 PM'),
(130, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:30:50 PM'),
(131, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:32:06 PM'),
(132, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:33:53 PM'),
(133, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:34:33 PM'),
(134, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:34:50 PM'),
(135, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:35:40 PM'),
(136, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:35:55 PM'),
(137, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:37:43 PM'),
(138, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:38:00 PM'),
(139, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:40:03 PM'),
(140, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:41:26 PM'),
(141, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:41:52 PM'),
(142, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:42:45 PM'),
(143, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:43:14 PM'),
(144, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:43:41 PM'),
(145, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:44:04 PM'),
(146, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:47:16 PM'),
(147, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:47:37 PM'),
(148, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:48:33 PM'),
(149, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:48:42 PM'),
(150, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 04:25:41 PM'),
(151, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 04:35:32 PM'),
(152, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 04:36:20 PM'),
(153, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 07:57:00 PM'),
(154, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-08 10:10:04 AM'),
(155, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-08 11:34:42 AM'),
(156, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-08 07:38:41 PM'),
(157, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-09 07:46:27 AM'),
(158, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-09 08:45:13 PM'),
(159, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-10 07:11:34 AM'),
(160, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-10 07:11:52 AM'),
(161, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-10 09:17:21 AM'),
(162, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-10 10:44:13 AM'),
(163, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-11 07:42:58 AM'),
(164, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-11 07:43:10 AM'),
(165, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-11 10:57:13 AM'),
(166, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-12 07:51:51 AM'),
(167, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-12 09:06:48 PM'),
(168, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-12 09:08:14 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tb_preregistration`
--

CREATE TABLE `tb_preregistration` (
  `userId` int(11) NOT NULL,
  `userFirst_name` varchar(100) NOT NULL,
  `userMiddle_name` varchar(100) NOT NULL,
  `userLast_name` varchar(100) NOT NULL,
  `userPhone_number` varchar(100) NOT NULL COMMENT '+63',
  `userBirth_date` varchar(100) NOT NULL,
  `userAge` varchar(100) NOT NULL,
  `userSex` varchar(123) NOT NULL,
  `house_number` varchar(145) NOT NULL,
  `street` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPassword` varchar(100) NOT NULL,
  `userStatus` enum('Y','N') NOT NULL DEFAULT 'N',
  `tokencode` varchar(100) NOT NULL,
  `qrcode` varchar(125) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_preregistration`
--

INSERT INTO `tb_preregistration` (`userId`, `userFirst_name`, `userMiddle_name`, `userLast_name`, `userPhone_number`, `userBirth_date`, `userAge`, `userSex`, `house_number`, `street`, `barangay`, `municipality`, `province`, `userEmail`, `userPassword`, `userStatus`, `tokencode`, `qrcode`, `Date`) VALUES
(3, 'Shania', 'Manalansan', 'Viscayno', '9776621929', '2000-07-01', '21', 'Male     ', '1872', 'Centro', 'San Agustin    ', 'Lubao', 'Pampanga', 'andrei.m.viscayno@gmail.com', '24b35e91f6650c460b66bceaa1590664', 'Y', '1166af07d59364ce3c5a7f54562c9eff', 'dc9e2ef5b25b715e1f3d079d2a7448fb', '2021-11-20 05:01:53'),
(19, 'Sunny', 'Oban', 'Viscayno', '9776621929', '1976-08-11', '45', 'Male', '', '', 'San Jose Apunan', 'Lubao', 'Pampanga', 'andreihfajj@gmail.com', '24b35e91f6650c460b66bceaa1590664', 'N', '559e220be980ba34f5c289a03b99bc91', '8a0e58f59668a3b1d25ae54e6a5ac30e', '2021-12-07 09:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(255) NOT NULL,
  `employeeId` varchar(145) DEFAULT NULL,
  `userPosition` varchar(145) DEFAULT NULL,
  `userFirst_Name` varchar(145) DEFAULT NULL,
  `userMiddle_Name` varchar(145) DEFAULT NULL,
  `userLast_Name` varchar(145) DEFAULT NULL,
  `userPhone_Number` varchar(145) DEFAULT NULL,
  `userEmail` varchar(145) DEFAULT NULL,
  `userPassword` varchar(145) DEFAULT NULL,
  `userStatus` enum('Y','N') DEFAULT 'N',
  `tokencode` varchar(145) DEFAULT NULL,
  `userProfile` varchar(1145) NOT NULL DEFAULT 'profile.png',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `employeeId`, `userPosition`, `userFirst_Name`, `userMiddle_Name`, `userLast_Name`, `userPhone_Number`, `userEmail`, `userPassword`, `userStatus`, `tokencode`, `userProfile`, `created_at`, `updated_at`) VALUES
(197, '2o2458285824582', 'Web Dev', 'Andrei', 'Manalansan', 'Viscayno', '9776621929', 'andreishania07012000@gmail.com', '24b35e91f6650c460b66bceaa1590664', 'Y', 'b3c2dc375edf8a69d45bcbeac8f805a5', 'coe_logo512px.png', '2022-07-05 11:39:33', '2022-07-12 08:00:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_programs`
--
ALTER TABLE `academic_programs`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `email_config`
--
ALTER TABLE `email_config`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `google_recaptcha_api`
--
ALTER TABLE `google_recaptcha_api`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `subjects_80874241`
--
ALTER TABLE `subjects_80874241`
  ADD PRIMARY KEY (`subjectId`);

--
-- Indexes for table `subjects_94374304`
--
ALTER TABLE `subjects_94374304`
  ADD PRIMARY KEY (`subjectId`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`superadminId`);

--
-- Indexes for table `system_config`
--
ALTER TABLE `system_config`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `system_logo`
--
ALTER TABLE `system_logo`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tb_logs`
--
ALTER TABLE `tb_logs`
  ADD PRIMARY KEY (`activityId`);

--
-- Indexes for table `tb_preregistration`
--
ALTER TABLE `tb_preregistration`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_programs`
--
ALTER TABLE `academic_programs`
  MODIFY `Id` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `userId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_config`
--
ALTER TABLE `email_config`
  MODIFY `Id` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `google_recaptcha_api`
--
ALTER TABLE `google_recaptcha_api`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `userId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects_80874241`
--
ALTER TABLE `subjects_80874241`
  MODIFY `subjectId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subjects_94374304`
--
ALTER TABLE `subjects_94374304`
  MODIFY `subjectId` int(145) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `superadminId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `system_config`
--
ALTER TABLE `system_config`
  MODIFY `Id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_logo`
--
ALTER TABLE `system_logo`
  MODIFY `Id` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_logs`
--
ALTER TABLE `tb_logs`
  MODIFY `activityId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `tb_preregistration`
--
ALTER TABLE `tb_preregistration`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
