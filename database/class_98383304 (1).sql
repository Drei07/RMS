-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2022 at 06:32 AM
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
-- Table structure for table `student_enrolled_subjects`
--

CREATE TABLE `student_enrolled_subjects` (
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
  `subject_grade` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_enrolled_subjects`
--

INSERT INTO `student_enrolled_subjects` (`classId`, `LRN`, `studentId`, `last_name`, `first_name`, `middle_name`, `program`, `subjectId`, `year_level`, `semester`, `school_year`, `subject_grade`, `created_at`, `updated_at`) VALUES
('98383304', '106027090003', '2018006160', 'ANCIENTE', 'ROMMEL', 'PANO', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:24:14', '2022-07-31 04:25:51'),
('98383304', '106038090006', '201840', 'AQUINO', 'RISSEL JANE', 'FLORES', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:24:19', '2022-07-31 04:26:00'),
('98383304', '106026080004', '2018006161', 'BELTRAN', 'CHARLIE', 'BUHALE', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:24:22', '2022-07-31 04:26:05'),
('98383304', '106028090001', '2018006162', 'BERCASIO', 'TYRON', 'DELA CRUZ', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:24:25', '2022-07-31 04:26:09'),
('98383304', '106026090010', '2018006163', 'CAPATI', 'JANCEE JOERN', 'MENDOZA', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:24:30', '2022-07-31 04:26:15'),
('98383304', '136484090213', '2018006164', 'DABU', 'JOHN PHILIP', 'LAZARO', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:24:35', '2022-07-31 04:26:20'),
('98383304', '106032090030', '2018006165', 'DABU', 'NATHANIEL', 'EBOJO', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:24:46', '2022-07-31 04:26:25'),
('98383304', '159501120015', '201826', 'DABU', 'RIXMON', 'CUDUG', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:24:50', '2022-07-31 04:26:30'),
('98383304', '300894120088', '201827', 'DE GUZMAN', 'RODOLFO JR', 'ANTANG', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:24:54', '2022-07-31 04:26:35'),
('98383304', '106030090015', '201828', 'DELA PENA', 'GARBRIEL NIKOLAI', 'GAMAD', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:25:19', '2022-07-31 04:26:41'),
('98383304', '106030090018', '201829', 'DIZON', 'FIAZ ALI', 'TOMNES', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '74', '2022-07-30 13:25:23', '2022-07-31 04:26:49'),
('98383304', '106024070024', '201830', 'GERONIMO', 'RAYMOND', '', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:25:27', '2022-07-31 04:26:55'),
('98383304', '106032090057', '201831', 'LASCANO', 'LEEANN', 'TORNO', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:25:30', '2022-07-31 04:27:00'),
('98383304', '106028090012', '201832', 'LOZANO', 'ALDRIN', 'PUCUT', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:25:53', '2022-07-31 04:27:05'),
('98383304', '106030090038', '201841', 'LUGTU', 'KATRINA JANE', 'SUNGA', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:25:57', '2022-07-31 04:27:10'),
('98383304', '106030090039', '201842', 'LUGTU', 'KEITH ANN', 'SUNGA', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '73', '2022-07-30 13:26:03', '2022-07-31 04:27:20'),
('98383304', '106032090071', '201833', 'MALLARI', 'FRANZ', 'LUATON', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '87', '2022-07-30 13:26:07', '2022-07-31 04:27:28'),
('98383304', '106026120173', '201834', 'MALLARI', 'JOHN LENON', 'GABAYAN', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '78', '2022-07-30 13:26:10', '2022-07-31 04:27:33'),
('98383304', '106032090073', '201835', 'MALLARI', 'MAISON SEDRICK', 'GAQUING', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:26:14', '2022-07-31 04:27:38'),
('98383304', '114421090051', '201836', 'MIRANDO', 'ARON', 'DAIT', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:26:18', '2022-07-31 04:27:44'),
('98383304', '106032090091', '201843', 'PINEDA', 'KAYLEEN', 'DAVID', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '98', '2022-07-30 13:38:33', '2022-07-31 04:27:53'),
('98383304', '106038090061', '201845', 'QUIMBAO', 'GLAIZA', 'MALIG', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '75', '2022-07-30 13:38:42', '2022-07-31 04:28:09'),
('98383304', '106269080034', '201837', 'RAZON', 'ATHAN TYRON', 'ANCHETA', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '78', '2022-07-30 13:38:53', '2022-07-31 04:28:16'),
('98383304', '103884090175', '201838', 'REGALA', 'IVAN EZEKIEL', 'MANALO', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '95', '2022-07-30 13:39:02', '2022-07-31 04:28:25'),
('98383304', '106038090082', '201839', 'YAMBAO', 'JAYMAR', 'RONQUILLO', '41341843', '10', 'Grade11', 'First Semester', '2021-2022', '76', '2022-07-30 13:39:11', '2022-07-31 04:28:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_enrolled_subjects`
--
ALTER TABLE `student_enrolled_subjects`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_enrolled_subjects`
--
ALTER TABLE `student_enrolled_subjects`
  MODIFY `Id` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
