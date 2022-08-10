
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `student_advisory` (
  `Id` int(145) NOT NULL,
  `advisoryId` varchar(145) DEFAULT NULL,
  `LRN` varchar(145) DEFAULT NULL,
  `studentId` varchar(145) DEFAULT NULL,
  `last_name` varchar(145) DEFAULT NULL,
  `first_name` varchar(145) DEFAULT NULL,
  `middle_name` varchar(145) DEFAULT NULL,
  `section_name` varchar(145) DEFAULT NULL,
  `program` varchar(145) DEFAULT NULL,
  `year_level` varchar(145) DEFAULT NULL,
  `school_year` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  
ALTER TABLE `student_enrolled_subjects`
  ADD PRIMARY KEY (`Id`);
