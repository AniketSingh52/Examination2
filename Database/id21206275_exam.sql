-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 04, 2024 at 05:27 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21206275_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `allotment`
--

CREATE TABLE `allotment` (
  `p_id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `role` enum('rs','js','ss') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  `sem` varchar(50) NOT NULL,
  `pr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`c_id`, `c_name`, `sem`, `pr_id`) VALUES
(1, 'java', '1', 1),
(2, 'python', '3', 1),
(3, 'artificial intelligance', '2', 2),
(4, 'book keeping', '3', 3),
(22, 'oops', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `d_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nrs` int(11) NOT NULL,
  `nvs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`d_id`, `name`, `nrs`, `nvs`) VALUES
(1, 'physics', 60, 6),
(2, 'maths', 55, 23),
(3, 'chemistry', 67, 34),
(4, 'it', 5, 3),
(5, 'commerce', 15, 4);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `e_id` int(11) NOT NULL,
  `type` enum('C','R','A') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`e_id`, `type`) VALUES
(1, 'C'),
(2, 'R'),
(3, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` enum('A','O') NOT NULL,
  `status` enum('A','I') NOT NULL,
  `p_id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `type`, `status`, `p_id`, `email`) VALUES
('abc', '111', 'A', 'A', 1, ''),
('Arn', '12', 'A', 'A', 1, ''),
('aryan2', '22221', 'O', 'I', 2, ''),
('Godike', '1234', 'O', 'I', 24, 'walfra52777@gmail.com'),
('it23', '1234', 'A', 'A', 1, ''),
('nitin07', '818180', 'A', 'A', 1, ''),
('Nitin12', 'nitin111', 'A', 'A', 1, ''),
('qq', 'qq', 'A', 'A', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `p_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `doj` date NOT NULL,
  `reg_sfc` enum('reg','sfc','both') NOT NULL,
  `designation` varchar(50) NOT NULL,
  `type` enum('R','V') NOT NULL,
  `ecm` enum('yes','no') NOT NULL,
  `d_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`p_id`, `name`, `doj`, `reg_sfc`, `designation`, `type`, `ecm`, `d_id`) VALUES
(1, 'Nitin23', '2023-08-10', 'both', 'HOD', 'V', 'yes', 4),
(2, 'aryan', '2023-08-13', 'reg', 'HOD', 'V', 'no', 5),
(17, 'vvv', '2023-08-11', 'reg', 'yes', 'R', 'yes', 3),
(24, 'Ajay', '2023-09-16', 'reg', 'yes', 'R', 'yes', 1),
(25, 'Ajay', '2023-09-28', 'sfc', 'no', 'R', 'no', 1),
(28, 'Omkar', '2023-09-01', 'sfc', 'yes', 'R', 'yes', 1),
(35, 'test', '2023-09-05', 'reg', 'yes', 'R', 'yes', 1),
(37, 'Vipul', '2023-09-03', 'both', 'no', 'R', 'no', 3);

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE `programme` (
  `pr_id` int(11) NOT NULL,
  `pr_name` varchar(50) NOT NULL,
  `strength` int(11) NOT NULL,
  `d_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`pr_id`, `pr_name`, `strength`, `d_id`) VALUES
(1, 'bsc-it', 80, 4),
(2, 'msc-it', 60, 4),
(3, 'bcom', 60, 5),
(22, 'mechanical', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `pr_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `f_time` time NOT NULL,
  `t_time` time NOT NULL,
  `nob` int(11) DEFAULT NULL,
  `academic_year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`pr_id`, `c_id`, `e_id`, `date`, `f_time`, `t_time`, `nob`, `academic_year`) VALUES
(1, 1, 2, '2023-09-19', '00:11:00', '02:11:00', 60, '2023'),
(3, 4, 3, '2023-09-28', '05:38:00', '05:38:00', 10, '2024'),
(1, 2, 3, '2023-09-05', '03:19:00', '02:19:00', 10, '2023'),
(1, 1, 1, '2023-09-21', '09:49:00', '05:53:00', 0, '2023'),
(1, 22, 1, '2023-09-06', '06:49:00', '06:49:00', 0, '2023'),
(2, 3, 2, '2023-09-20', '01:49:00', '02:49:00', 0, '2023');

-- --------------------------------------------------------

--
-- Table structure for table `unavailability`
--

CREATE TABLE `unavailability` (
  `date` date NOT NULL,
  `reason` varchar(100) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unavailability`
--

INSERT INTO `unavailability` (`date`, `reason`, `p_id`) VALUES
('2023-08-01', 'reason 1', 1),
('2023-09-15', 'Ok', 1),
('2023-09-15', 'Mai nahi bataunga ', 1),
('2023-09-23', 'Jfkdkskxn', 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allotment`
--
ALTER TABLE `allotment`
  ADD KEY `allotment_ibfk_1` (`c_id`),
  ADD KEY `allotment_ibfk_2` (`e_id`),
  ADD KEY `allotment_ibfk_3` (`pr_id`),
  ADD KEY `allotment_ibfk_4` (`p_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `course_ibfk_1` (`pr_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `professor_ibfk_1` (`d_id`);

--
-- Indexes for table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `programme_ibfk_1` (`d_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD KEY `timetable_ibfk_1` (`pr_id`),
  ADD KEY `timetable_ibfk_2` (`c_id`),
  ADD KEY `timetable_ibfk_3` (`e_id`);

--
-- Indexes for table `unavailability`
--
ALTER TABLE `unavailability`
  ADD KEY `unavailability_ibfk_1` (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `programme`
--
ALTER TABLE `programme`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allotment`
--
ALTER TABLE `allotment`
  ADD CONSTRAINT `allotment_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `course` (`c_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `allotment_ibfk_2` FOREIGN KEY (`e_id`) REFERENCES `exam` (`e_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `allotment_ibfk_3` FOREIGN KEY (`pr_id`) REFERENCES `programme` (`pr_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `allotment_ibfk_4` FOREIGN KEY (`p_id`) REFERENCES `professor` (`p_id`) ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`pr_id`) REFERENCES `programme` (`pr_id`) ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `professor` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `department` (`d_id`) ON UPDATE CASCADE;

--
-- Constraints for table `programme`
--
ALTER TABLE `programme`
  ADD CONSTRAINT `programme_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `department` (`d_id`) ON UPDATE CASCADE;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`pr_id`) REFERENCES `programme` (`pr_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `course` (`c_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`e_id`) REFERENCES `exam` (`e_id`) ON UPDATE CASCADE;

--
-- Constraints for table `unavailability`
--
ALTER TABLE `unavailability`
  ADD CONSTRAINT `unavailability_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `professor` (`p_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
