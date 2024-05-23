-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 04:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtualroboticstrainingplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `AttendeeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`AttendeeID`, `UserID`) VALUES
(1, 1),
(4, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `CertificateID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `WorkshopID` int(11) NOT NULL,
  `IssuedDate` date NOT NULL,
  `CertificateURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`CertificateID`, `UserID`, `WorkshopID`, `IssuedDate`, `CertificateURL`) VALUES
(1, 3, 4, '2024-05-19', 'http://example.com/certificate1'),
(2, 2, 1, '2024-05-20', 'http://example.com/certificate2'),
(3, 2, 3, '2024-05-21', 'http://example.com/certificate3'),
(4, 1, 2, '2024-05-22', 'http://example.com/certificate4');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `WorkshopID` int(11) NOT NULL,
  `Rating` int(11) DEFAULT NULL CHECK (`Rating` >= 1 and `Rating` <= 5),
  `Comment` text DEFAULT NULL,
  `FeedbackDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `UserID`, `WorkshopID`, `Rating`, `Comment`, `FeedbackDate`) VALUES
(1, 3, 1, 5, 'Great workshop!', '0000-00-00 00:00:00'),
(2, 2, 2, 4, 'Enjoyed it.', '0000-00-00 00:00:00'),
(3, 3, 3, 3, 'Could be better.', '2024-05-21 07:00:00'),
(4, 1, 4, 5, 'Awesome experience!', '2024-05-22 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `InstructorID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`InstructorID`, `UserID`, `Bio`) VALUES
(1, 2, 'Experienced robotics engineer.'),
(2, 1, 'Passionate about teaching robotics.'),
(3, 2, 'Expert in robotics programming.'),
(4, 3, 'Specializes in robotics automation.');

-- --------------------------------------------------------

--
-- Table structure for table `instructorworkshops`
--

CREATE TABLE `instructorworkshops` (
  `InstructorWorkshopID` int(11) NOT NULL,
  `InstructorID` int(11) NOT NULL,
  `WorkshopID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructorworkshops`
--

INSERT INTO `instructorworkshops` (`InstructorWorkshopID`, `InstructorID`, `WorkshopID`) VALUES
(1, 3, 1),
(2, 4, 2),
(3, 1, 3),
(4, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `roboticsresources`
--

CREATE TABLE `roboticsresources` (
  `ResourceID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roboticsresources`
--

INSERT INTO `roboticsresources` (`ResourceID`, `Title`, `URL`, `Description`) VALUES
(1, 'Robotics Basics', 'http://example.com/resource1', 'Introduction to robotics concepts.'),
(2, 'Advanced Robotics', 'http://example.com/resource2', 'In-depth exploration of robotics technologies.'),
(3, 'Robotics Programming', 'http://example.com/resource3', 'Learning programming languages for robotics.'),
(4, 'Robotics Automation', 'http://example.com/resource4', 'Automating tasks using robotics.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'uwamariya', 'alice', 'aliceuwa', 'uwamariyaalice644@gmail.com', '0783554366', '$2y$10$j3QXHRyO5wfSkZ0NSUOjm.lCGO/RMziArhkYeZz1crDsggaM.aXPe', '2024-05-20 13:08:43', '2343', 0),
(2, 'patrick', 'itangishaka', 'pazzoo', 'itangpazoo@gmail.com', '07865443433', '$2y$10$sSyU52Sgq22/V6UL6/JyduSHRpwTiJF4snjlpOfDEaMF1FBVBKYHK', '2024-05-20 13:09:33', '57457', 0),
(3, 'uwera ', 'ruth', 'uwerarth', 'ruthuwera@gmail.com', '0798765332', '$2y$10$e2LAoeuLKdDmwRtaqTk7tu5WIps58zUXmBeZNNHlRg.30K2S6iGIW', '2024-05-20 13:10:34', '344443', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workshopattendance`
--

CREATE TABLE `workshopattendance` (
  `AttendanceID` int(11) NOT NULL,
  `WorkshopID` int(11) NOT NULL,
  `AttendeeID` int(11) NOT NULL,
  `AttendanceDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshopattendance`
--

INSERT INTO `workshopattendance` (`AttendanceID`, `WorkshopID`, `AttendeeID`, `AttendanceDate`) VALUES
(1, 1, 3, '2024-05-19'),
(2, 2, 2, '2024-05-20'),
(3, 3, 3, '2024-05-21'),
(4, 4, 1, '2024-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `workshopregistration`
--

CREATE TABLE `workshopregistration` (
  `RegistrationID` int(11) NOT NULL,
  `WorkshopID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshopregistration`
--

INSERT INTO `workshopregistration` (`RegistrationID`, `WorkshopID`, `UserID`, `RegistrationDate`) VALUES
(1, 1, 3, '2024-05-19 07:00:00'),
(2, 2, 2, '2024-05-20 07:00:00'),
(3, 3, 3, '2024-05-21 07:00:00'),
(4, 4, 1, '2024-05-22 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `WorkshopID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `InstructorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`WorkshopID`, `Title`, `Description`, `StartDate`, `EndDate`, `InstructorID`) VALUES
(1, 'Intro to Robotics', 'Basic concepts and principles of robotics.', '2024-05-19', '2024-05-20', 1),
(2, 'Robotics Workshop', 'Hands-on workshop on robotics.', '2024-05-20', '2024-05-21', 2),
(3, 'Advanced Robotics', 'Advanced topics in robotics engineering.', '2024-05-21', '2024-05-22', 3),
(4, 'Robotics Automation', 'Automation techniques using robotics.', '2024-05-22', '2024-05-23', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`AttendeeID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`CertificateID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `WorkshopID` (`WorkshopID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `WorkshopID` (`WorkshopID`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`InstructorID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `instructorworkshops`
--
ALTER TABLE `instructorworkshops`
  ADD PRIMARY KEY (`InstructorWorkshopID`),
  ADD KEY `InstructorID` (`InstructorID`),
  ADD KEY `WorkshopID` (`WorkshopID`);

--
-- Indexes for table `roboticsresources`
--
ALTER TABLE `roboticsresources`
  ADD PRIMARY KEY (`ResourceID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workshopattendance`
--
ALTER TABLE `workshopattendance`
  ADD PRIMARY KEY (`AttendanceID`),
  ADD KEY `WorkshopID` (`WorkshopID`),
  ADD KEY `AttendeeID` (`AttendeeID`);

--
-- Indexes for table `workshopregistration`
--
ALTER TABLE `workshopregistration`
  ADD PRIMARY KEY (`RegistrationID`),
  ADD KEY `WorkshopID` (`WorkshopID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`WorkshopID`),
  ADD KEY `InstructorID` (`InstructorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `AttendeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `CertificateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `InstructorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `instructorworkshops`
--
ALTER TABLE `instructorworkshops`
  MODIFY `InstructorWorkshopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roboticsresources`
--
ALTER TABLE `roboticsresources`
  MODIFY `ResourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `workshopattendance`
--
ALTER TABLE `workshopattendance`
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workshopregistration`
--
ALTER TABLE `workshopregistration`
  MODIFY `RegistrationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `WorkshopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `certificates_ibfk_2` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `instructorworkshops`
--
ALTER TABLE `instructorworkshops`
  ADD CONSTRAINT `instructorworkshops_ibfk_1` FOREIGN KEY (`InstructorID`) REFERENCES `instructors` (`InstructorID`),
  ADD CONSTRAINT `instructorworkshops_ibfk_2` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `workshopattendance`
--
ALTER TABLE `workshopattendance`
  ADD CONSTRAINT `workshopattendance_ibfk_1` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`),
  ADD CONSTRAINT `workshopattendance_ibfk_2` FOREIGN KEY (`AttendeeID`) REFERENCES `attendees` (`AttendeeID`);

--
-- Constraints for table `workshopregistration`
--
ALTER TABLE `workshopregistration`
  ADD CONSTRAINT `workshopregistration_ibfk_1` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`),
  ADD CONSTRAINT `workshopregistration_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `workshops`
--
ALTER TABLE `workshops`
  ADD CONSTRAINT `workshops_ibfk_1` FOREIGN KEY (`InstructorID`) REFERENCES `instructors` (`InstructorID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
