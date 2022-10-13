-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2022 at 03:52 AM
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
-- Table structure for table `class_82566785`
--

CREATE TABLE `class_82566785` (
  `Id` int(145) NOT NULL,
  `classId` varchar(145) DEFAULT NULL,
  `LRN` varchar(145) DEFAULT NULL,
  `studentId` varchar(145) DEFAULT NULL,
  `last_name` varchar(145) DEFAULT NULL,
  `first_name` varchar(145) DEFAULT NULL,
  `middle_name` varchar(145) DEFAULT NULL,
  `program` varchar(145) DEFAULT NULL,
  `subjectId` varchar(145) DEFAULT NULL,
  `year_level` varchar(145) DEFAULT NULL,
  `semester` varchar(145) DEFAULT NULL,
  `school_year` varchar(145) DEFAULT NULL,
  `subject_grade_Q1` varchar(145) DEFAULT NULL,
  `subject_grade_Q2` varchar(145) DEFAULT NULL,
  `final_subject_grade_1st_sem` varchar(145) DEFAULT NULL,
  `subject_grade_Q3` varchar(145) DEFAULT NULL,
  `subject_grade_Q4` varchar(145) DEFAULT NULL,
  `final_subject_grade_2nd_sem` varchar(145) DEFAULT NULL,
  `edit_grade` enum('request','edit') NOT NULL DEFAULT 'request',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_82566785`
--

INSERT INTO `class_82566785` (`Id`, `classId`, `LRN`, `studentId`, `last_name`, `first_name`, `middle_name`, `program`, `subjectId`, `year_level`, `semester`, `school_year`, `subject_grade_Q1`, `subject_grade_Q2`, `final_subject_grade_1st_sem`, `subject_grade_Q3`, `subject_grade_Q4`, `final_subject_grade_2nd_sem`, `edit_grade`, `created_at`, `updated_at`) VALUES
(1, '82566785', '106027090003', '2018006160', 'ANCIENTE', 'ROMMEL', 'PANO', '41341843', '1', 'Grade11', 'First Semester', '2021-2022', NULL, NULL, NULL, NULL, NULL, NULL, 'request', '2022-09-11 01:51:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_82566785`
--
ALTER TABLE `class_82566785`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_82566785`
--
ALTER TABLE `class_82566785`
  MODIFY `Id` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
