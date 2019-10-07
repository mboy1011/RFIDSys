-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2017 at 12:15 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acls`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `cour_id` int(11) NOT NULL,
  `cour_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cour_id`, `cour_description`) VALUES
(1, 'BSMT'),
(2, 'BSMarE'),
(3, 'BSIEng''g'),
(4, 'BSME'),
(5, 'BSEE'),
(6, 'BSInfoTech'),
(7, 'BSIT'),
(9, 'BEEd'),
(10, 'BSHTE'),
(11, 'BSEd'),
(12, 'BSSM'),
(13, 'ABComm'),
(14, 'BSHRM CSM'),
(21, 'High School'),
(23, 'Employee'),
(24, 'Faculty');

-- --------------------------------------------------------

--
-- Table structure for table `logged_book`
--

CREATE TABLE `logged_book` (
  `logb_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `logb_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logged_book`
--

INSERT INTO `logged_book` (`logb_id`, `stud_id`, `logb_login`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sect_id` int(11) NOT NULL,
  `sect_description` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sect_id`, `sect_description`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'F'),
(7, '1'),
(8, '2'),
(9, '3'),
(10, '4'),
(12, 'No'),
(21, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stud_id` int(11) NOT NULL,
  `stud_studentID` int(11) NOT NULL,
  `stud_RFID` int(11) NOT NULL,
  `stud_fName` varchar(50) NOT NULL,
  `stud_mName` varchar(50) NOT NULL,
  `stud_lName` varchar(50) NOT NULL,
  `stud_nEx` varchar(10) NOT NULL,
  `stud_photo` varchar(50) NOT NULL,
  `stud_address` varchar(100) NOT NULL,
  `year_id` int(11) NOT NULL,
  `sect_id` int(11) NOT NULL,
  `cour_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stud_id`, `stud_studentID`, `stud_RFID`, `stud_fName`, `stud_mName`, `stud_lName`, `stud_nEx`, `stud_photo`, `stud_address`, `year_id`, `sect_id`, `cour_id`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `trash_photos`
--

CREATE TABLE `trash_photos` (
  `trash_id` int(11) NOT NULL,
  `trash_location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `year_id` int(11) NOT NULL,
  `year_description` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`year_id`, `year_description`) VALUES
(1, 'I'),
(2, 'II'),
(3, 'III'),
(4, 'IV'),
(5, 'V'),
(6, 'Grade 7'),
(7, 'Grade 8'),
(8, 'Grade 9'),
(9, 'Grade 10'),
(12, 'None');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cour_id`);

--
-- Indexes for table `logged_book`
--
ALTER TABLE `logged_book`
  ADD PRIMARY KEY (`logb_id`),
  ADD KEY `stud_id` (`stud_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sect_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stud_id`),
  ADD KEY `cour_id` (`cour_id`),
  ADD KEY `year_id` (`year_id`),
  ADD KEY `sect_id` (`sect_id`);

--
-- Indexes for table `trash_photos`
--
ALTER TABLE `trash_photos`
  ADD PRIMARY KEY (`trash_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `cour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `logged_book`
--
ALTER TABLE `logged_book`
  MODIFY `logb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `sect_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `trash_photos`
--
ALTER TABLE `trash_photos`
  MODIFY `trash_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `logged_book`
--
ALTER TABLE `logged_book`
  ADD CONSTRAINT `logged_book_ibfk_1` FOREIGN KEY (`stud_id`) REFERENCES `students` (`stud_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`cour_id`) REFERENCES `course` (`cour_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`year_id`) REFERENCES `year` (`year_id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`sect_id`) REFERENCES `section` (`sect_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
