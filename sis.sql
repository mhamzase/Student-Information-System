-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2021 at 08:31 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sis`
--

-- --------------------------------------------------------

--
-- Table structure for table `9th`
--

CREATE TABLE `9th` (
  `classId` varchar(10) NOT NULL,
  `totalSubjects` varchar(10) NOT NULL,
  `minRequired` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `9th`
--

INSERT INTO `9th` (`classId`, `totalSubjects`, `minRequired`) VALUES
('9', '6', '5');

-- --------------------------------------------------------

--
-- Table structure for table `9th_class_attendance`
--

CREATE TABLE `9th_class_attendance` (
  `attendance_id` int(10) NOT NULL,
  `student_id` varchar(10) DEFAULT NULL,
  `student_name` varchar(50) DEFAULT NULL,
  `course_name` varchar(40) DEFAULT NULL,
  `attendance_status` varchar(30) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `9th_class_attendance`
--

INSERT INTO `9th_class_attendance` (`attendance_id`, `student_id`, `student_name`, `course_name`, `attendance_status`, `date`) VALUES
(1, 'S5299', ' sidra ', ' English', 'present', '2020-11-28 18:54:40'),
(2, 'S5299', ' sidra ', ' Science', 'present', '2020-11-28 18:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `9th_class_details`
--

CREATE TABLE `9th_class_details` (
  `class_name` varchar(30) DEFAULT NULL,
  `subjects` varchar(255) DEFAULT NULL,
  `total_marks` varchar(30) DEFAULT NULL,
  `teacher_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `9th_class_details`
--

INSERT INTO `9th_class_details` (`class_name`, `subjects`, `total_marks`, `teacher_id`) VALUES
('9th', 'Mathematics', '100', 'unallocate'),
('9th', 'English', '100', 'T3628'),
('9th', 'Islamiyat', '100', 'T4535'),
('9th', 'Computer', '100', 'unallocate'),
('9th', 'Urdu', '100', 'T4535'),
('9th', 'Science', '100', 'T3628');

-- --------------------------------------------------------

--
-- Table structure for table `9th_class_result`
--

CREATE TABLE `9th_class_result` (
  `f_m` int(30) NOT NULL,
  `student_id` varchar(10) DEFAULT NULL,
  `course_name` varchar(30) DEFAULT NULL,
  `total_marks` varchar(30) DEFAULT NULL,
  `obtain_marks` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `9th_class_result`
--

INSERT INTO `9th_class_result` (`f_m`, `student_id`, `course_name`, `total_marks`, `obtain_marks`) VALUES
(1, 'S5299', ' English ', ' 100', '89'),
(2, 'S5299', ' Science ', ' 100', '67');

-- --------------------------------------------------------

--
-- Table structure for table `9th_class_students`
--

CREATE TABLE `9th_class_students` (
  `st_id` varchar(255) NOT NULL,
  `Mathematics` text DEFAULT NULL,
  `English` text DEFAULT NULL,
  `Islamiyat` text DEFAULT NULL,
  `Computer` text DEFAULT NULL,
  `Urdu` text DEFAULT NULL,
  `Science` text NOT NULL,
  `totalMarks` int(11) DEFAULT NULL,
  `obtainMarks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `9th_class_students`
--

INSERT INTO `9th_class_students` (`st_id`, `Mathematics`, `English`, `Islamiyat`, `Computer`, `Urdu`, `Science`, `totalMarks`, `obtainMarks`) VALUES
('S5299', 'selected', 'selected', 'selected', 'selected', 'selected', 'unselected', 500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `all_classes`
--

CREATE TABLE `all_classes` (
  `classId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `all_classes`
--

INSERT INTO `all_classes` (`classId`) VALUES
('9th');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `message` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`message`, `date`) VALUES
('Admin have rejected your time table 😢😢', '2020/11/07'),
('Admin have rejected your time table 😢😢', '2020/11/07'),
('Admin have rejected your time table 😢😢', '2020/11/07'),
('Admin have rejected your time table 😢😢', '2020/11/17'),
('Admin have approved your time table 🎉🎉', '2020/11/17'),
('Admin have approved your time table 🎉🎉', '2020/11/23'),
('Admin have rejected your time table 😢😢', '2020/11/23');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `child_id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `fullname`, `email`, `password`, `address`, `phone`, `gender`, `child_id`, `token`) VALUES
('P1362', 'abdul ghafoor', 'ghafoor@gmail.com', '66', 'lahore', '0305-9335745', 'male', 'S5299', '7cd1e848b89e4b20691c360413ed8f');

-- --------------------------------------------------------

--
-- Table structure for table `schooltimetable`
--

CREATE TABLE `schooltimetable` (
  `classname` varchar(200) NOT NULL,
  `subjectname` varchar(200) NOT NULL,
  `Monday` varchar(200) NOT NULL,
  `TUESDAY` varchar(200) NOT NULL,
  `WEDNESDAY` varchar(200) NOT NULL,
  `THURSDAY` varchar(200) NOT NULL,
  `FRIDAY` varchar(200) NOT NULL,
  `SATURDAY` varchar(200) NOT NULL,
  `teacherId` varchar(200) NOT NULL,
  `teacherName` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'pendding'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schooltimetable`
--

INSERT INTO `schooltimetable` (`classname`, `subjectname`, `Monday`, `TUESDAY`, `WEDNESDAY`, `THURSDAY`, `FRIDAY`, `SATURDAY`, `teacherId`, `teacherName`, `status`) VALUES
('9thclass', 'urdu', '10:00 AM', '', '', '', '', '', 'T5109', 'rasheed ', 'accepted'),
('9thclass', 'urdu', '10:30 AM', '', '', '', '', '', 'T5109', 'rasheed ', 'accepted'),
('9thclass', 'math', '', '11:00 AM', '', '', '', '', 'T5109', 'rasheed ', 'accepted'),
('9thclass', 'urdu', '', '', '', '', '11:00 AM', '', 'T5109', 'rasheed ', 'accepted'),
('9thclass', 'oop', '11:00 AM', '', '', '', '', '', 't8212', 'ali hussain', 'accepted'),
('9thclass', 'oop', '', '11:30 AM', '', '', '', '', 't8212', 'ali hussain', 'accepted'),
('9thclass', 'oop', '', '', '10:30 AM', '', '', '', 't8212', 'ali hussain', 'accepted'),
('9thclass', 'oop', '', '', '', '12:00 AM', '', '', 't8212', 'ali hussain', 'accepted'),
('9thclass', 'oop', '', '', '', '', '10:00 AM', '', 't8212', 'ali hussain', 'accepted'),
('9th', 'Mathematics', '9:00 AM', '', '', '', '', '', 'T3628', 'rashid ali', 'accepted'),
('9th', 'Mathematics', '', '10:00 AM', '', '', '', '', 'T3628', 'rashid ali', 'accepted'),
('9th', 'Mathematics', '', '', '12:00 AM', '', '', '', 'T3628', 'rashid ali', 'accepted'),
('9th', 'Mathematics', '', '', '', '11:00 AM', '', '', 'T3628', 'rashid ali', 'accepted'),
('9th', 'Mathematics', '', '', '', '', '1:00 AM', '', 'T3628', 'rashid ali', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` varchar(20) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `study_program` varchar(20) NOT NULL,
  `parent_id` varchar(10) NOT NULL,
  `token` varchar(255) NOT NULL,
  `enrolled_class` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fullname`, `email`, `password`, `address`, `phone`, `gender`, `dob`, `study_program`, `parent_id`, `token`, `enrolled_class`) VALUES
('S5299', 'sidra', 'sidra@gmail.com', '55', 'lahore', '0305-9685745', 'female', '2020-11-25', '9th', 'P1362', 'b1e6d3c1e26cbd9ed5b8843294a5b5', '9th');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `fullname`, `email`, `password`, `address`, `phone`, `gender`, `dob`, `qualification`, `token`) VALUES
('T3628', 'rashid ali', 'rashid@gmail.com', '666', 'lahore', '0305-6311152', 'male', '2020-11-11', 'bs_physics', 'd89a9a33f4a67d4154a651d08b677e'),
('T4535', 'Sheraz Ali', 'sheraz@gmail.com', '123', 'lahore', '0305-6352652', 'male', '2002-07-10', 'bscs', '5793feb8a999f948a3e4544461dd61');

-- --------------------------------------------------------

--
-- Table structure for table `timerecord`
--

CREATE TABLE `timerecord` (
  `time` varchar(200) NOT NULL,
  `reservedClass` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timerecord`
--

INSERT INTO `timerecord` (`time`, `reservedClass`, `day`) VALUES
('9:00 AM', '9thclass', ''),
('9:30 AM', '9thclass', '');

-- --------------------------------------------------------

--
-- Table structure for table `timetablerequests`
--

CREATE TABLE `timetablerequests` (
  `teacherId` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timetablerequests`
--

INSERT INTO `timetablerequests` (`teacherId`, `status`) VALUES
('t8212', 'accepted'),
('T3628', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `password`, `status`, `role`) VALUES
('admin', 'ad123', 'active', 'admin'),
('P1362', '66', 'active', 'parent'),
('S5299', '55', 'active', 'student'),
('T3628', '666', 'active', 'teacher'),
('T4535', '123', 'active', 'teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `9th`
--
ALTER TABLE `9th`
  ADD PRIMARY KEY (`classId`);

--
-- Indexes for table `9th_class_attendance`
--
ALTER TABLE `9th_class_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `9th_class_result`
--
ALTER TABLE `9th_class_result`
  ADD PRIMARY KEY (`f_m`);

--
-- Indexes for table `9th_class_students`
--
ALTER TABLE `9th_class_students`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `all_classes`
--
ALTER TABLE `all_classes`
  ADD PRIMARY KEY (`classId`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `child_id` (`child_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `9th_class_attendance`
--
ALTER TABLE `9th_class_attendance`
  MODIFY `attendance_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `9th_class_result`
--
ALTER TABLE `9th_class_result`
  MODIFY `f_m` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
