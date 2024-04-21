-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 10:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `attDesc` varchar(40) NOT NULL DEFAULT 'daily attandance',
  `date` date NOT NULL DEFAULT current_timestamp(),
  `missed` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `attDesc`, `date`, `missed`) VALUES
(1, 'daily attandance', '2024-04-20', 2),
(2, 'daily attandance', '2024-04-20', 2),
(3, 'daily attandance', '2024-04-20', 2),
(4, 'daily attandance', '2024-04-20', 2),
(5, 'Daily attendence', '2024-04-20', 3),
(6, 'Daily attendence', '2024-04-21', 4),
(7, 'emergency attendance', '2024-04-21', 3),
(8, 'Daily attendence', '2024-04-21', 3);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classId` int(11) NOT NULL,
  `className` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classId`, `className`) VALUES
(1, 'L5 SOD'),
(2, 'L4 SOD'),
(3, 'L5 NET'),
(4, 'L5 MLM'),
(5, 'L4 MLM');

-- --------------------------------------------------------

--
-- Table structure for table `missed`
--

CREATE TABLE `missed` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `att_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `missed`
--

INSERT INTO `missed` (`id`, `student_id`, `att_id`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 2, 2),
(4, 3, 2),
(5, 2, 3),
(6, 4, 3),
(7, 2, 4),
(8, 3, 4),
(9, 4, 5),
(10, 7, 5),
(11, 8, 5),
(12, 2, 6),
(13, 3, 6),
(14, 7, 6),
(15, 8, 6),
(16, 4, 7),
(17, 8, 7),
(18, 9, 7),
(19, 3, 8),
(20, 10, 8),
(21, 11, 8);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentId` int(11) NOT NULL,
  `fName` varchar(30) NOT NULL,
  `lName` varchar(30) NOT NULL,
  `age` int(2) NOT NULL,
  `classId` int(11) NOT NULL,
  `gender` enum('male','female') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentId`, `fName`, `lName`, `age`, `classId`, `gender`) VALUES
(2, 'kimanga', 'zagara', 15, 1, 'male'),
(3, 'cyiza', 'prince', 15, 2, 'male'),
(4, 'RUDASINGWA', 'Bienvenue', 16, 3, 'male'),
(7, 'Murajimana', 'james', 23, 3, 'male'),
(8, 'asifiwe', 'jean luc', 28, 1, 'male'),
(9, 'murekatete', 'ikimpaye', 18, 5, 'male'),
(10, 'igiraneza shami', 'berive', 4, 1, 'male'),
(11, 'ineza shimwa ', 'briella', 6, 3, 'male');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `userName`, `password`, `email`) VALUES
(1, 'cyiza', 'prince', 'admin', '123', 'cyizaprince@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classId`);

--
-- Indexes for table `missed`
--
ALTER TABLE `missed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `att_id` (`att_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentId`),
  ADD KEY `classId` (`classId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `missed`
--
ALTER TABLE `missed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `missed`
--
ALTER TABLE `missed`
  ADD CONSTRAINT `missed_ibfk_1` FOREIGN KEY (`att_id`) REFERENCES `attendance` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `missed_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`classId`) REFERENCES `class` (`classId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
