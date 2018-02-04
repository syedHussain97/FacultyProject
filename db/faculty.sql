-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2012 at 11:53 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `faculty`
--

-- --------------------------------------------------------

--
-- Table structure for table `se_categories`
--

CREATE TABLE IF NOT EXISTS `se_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `se_categories`
--

INSERT INTO `se_categories` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'PRINCIPLE', 'Head of Institue'),
(2, 'INSTRUCTOR', 'Course Instructor'),
(3, 'EXAMINER', 'Will take student''s Exam and update their marks');

-- --------------------------------------------------------

--
-- Table structure for table `se_category_roles`
--

CREATE TABLE IF NOT EXISTS `se_category_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `role_description` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `se_category_roles`
--

INSERT INTO `se_category_roles` (`role_id`, `role_name`, `role_description`, `category_id`) VALUES
(1, 'ADD_FACULTY', 'Add new faculty', 1),
(2, 'VIEW_FACULTY_PROFILE', 'View all faculty profile', 1),
(3, 'VIEW_STUDENT_PROFILE', 'Can view only student and his own profile', 2),
(4, 'UPDATE_ATTENDENCE', 'Update student attendence', 2),
(5, 'MARK_ATTENDENCE', 'Mark attendence of student', 2),
(6, 'UPDATE_MARKS', 'Update student marks', 3),
(7, 'VIEW_STUDENT_MARKS', 'Only has privilege to view student marks', 2),
(8, 'LECTURE_UPDATE', 'Update course status report after each lecture', 2),
(9, 'VIEW_LECTURE_UPDATE', 'Can only view lecture update', 2),
(10, 'PROFILE_OWNER', 'If a person has a profile', 2),
(11, 'VIEW_COURSE', 'List of Courses', 2);

-- --------------------------------------------------------

--
-- Table structure for table `se_course`
--

CREATE TABLE IF NOT EXISTS `se_course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_instructor` int(11) NOT NULL,
  `course_examiner` int(11) DEFAULT NULL,
  `course_outline` varchar(999) DEFAULT NULL,
  PRIMARY KEY (`course_id`),
  KEY `course_instructor` (`course_instructor`),
  KEY `course_examiner` (`course_examiner`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `se_course`
--

INSERT INTO `se_course` (`course_id`, `course_code`, `course_name`, `course_instructor`, `course_examiner`, `course_outline`) VALUES
(1, 'CS-201', 'Computer Programming', 5, 3, 'If an underscore or % is needed as a literal character in the string, the character should be preceded by an escape character, which is specified after the string using the keyword ESCAPE. For example, ''AB\\_CD\\%EF'' ESCAPE ''\\'' represents the literal string ''AB_CD%EF'', because \\ is specified as the escape character. Any character not used in the string can be chosen as the escape character. Also, we need a rule to specify apostrophes or single quotation marks (") if they are to be included in a string, because they are used to begin and end strings. If an apostrophe ('') is needed, it is represented as two consecutive apostrophes (") so that it will not be interpreted as ending the string. Another feature allows the use of arithmetic in queries. The standard arithmetic operators for addition (+), subtraction (-), multiplication (*), and division (/) can be applied tonumeric values or attributes with numeric domains. For example, suppose that we want to see the effect of giving all employ'),
(2, 'CS-202', 'Data Structures', 1, 25, 'If an underscore or % is needed as a literal character in the string, the character should be preceded by an escape character, which is specified after the string using the keyword ESCAPE. For example, ''AB\\_CD\\%EF'' ESCAPE ''\\'' represents the literal string ''AB_CD%EF'', because \\ is specified as the escape character. Any character not used in the string can be chosen as the escape character. Also, we need a rule to specify apostrophes or single quotation marks (") if they are to be included in a string, because they are used to begin and end strings. If an apostrophe ('') is needed, it is represented as two consecutive apostrophes (") so that it will not be interpreted as ending the string. Another feature allows the use of arithmetic in queries. The standard arithmetic operators for addition (+), subtraction (-), multiplication (*), and division (/) can be applied tonumeric values or attributes with numeric domains. For example, suppose that we want to see the effect of giving all employ');

-- --------------------------------------------------------

--
-- Table structure for table `se_course_lecture`
--

CREATE TABLE IF NOT EXISTS `se_course_lecture` (
  `lecture_id` int(11) NOT NULL AUTO_INCREMENT,
  `lecture_number` int(11) NOT NULL,
  `lecture_course_id` int(11) NOT NULL,
  `lecture_updates` varchar(255) NOT NULL,
  `lecture_date` varchar(255) NOT NULL,
  `lecture_duration` int(11) NOT NULL,
  PRIMARY KEY (`lecture_id`),
  KEY `lecture_course_id` (`lecture_course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `se_course_lecture`
--

INSERT INTO `se_course_lecture` (`lecture_id`, `lecture_number`, `lecture_course_id`, `lecture_updates`, `lecture_date`, `lecture_duration`) VALUES
(14, 1, 1, 'DESCRIPTION_PRODUCT_TYPE_SPLIT', '26-3-2012', 2),
(19, 1, 1, 'DESCRIPTION_PRODUCT_TYPE_SPLIT', '25-3-2012', 2),
(20, 1, 1, 'DESCRIPTION_PRODUCT_TYPE_SPLIT', '25-3-2012', 2),
(21, 1, 1, 'DESCRIPTION_PRODUCT_TYPE_SPLIT', '25-3-2012', 2),
(22, 1, 1, 'DESCRIPTION_PRODUCT_TYPE_SPLIT', '25-3-2012', 2),
(23, 1, 1, 'DESCRIPTION_PRODUCT_TYPE_SPLIT', '25-3-2012', 2),
(24, 1, 1, 'DESCRIPTION_PRODUCT_TYPE_SPLIT', '25-3-2012', 2),
(25, 1, 1, 'DESCRIPTION_PRODUCT_TYPE_SPLIT', '25-3-2012', 2),
(26, 1, 1, 'DESCRIPTION_PRODUCT_TYPE_SPLIT', '25-3-2012', 2),
(27, 1, 1, 'DESCRIPTION_PRODUCT_TYPE_SPLIT', '25-3-2012', 2),
(28, 1, 1, 'DESCRIPTION_PRODUCT_TYPE_SPLIT', '25-3-2012', 2),
(29, 1, 1, 'DESCRIPTION_PRODUCT_TYPE_SPLIT', '25-3-2012', 2),
(30, 1, 1, 'DESCRIPTION_PRODUCT_TYPE_SPLIT', '25-3-2012', 2),
(31, 2, 1, 'dasdasas', '26-3-2012', 2),
(32, 3, 1, 'sdasdasdsdas', '26-3-2012', 2),
(33, 3, 1, 'sdasdasdsdas', '26-3-2012', 2);

-- --------------------------------------------------------

--
-- Table structure for table `se_course_marks`
--

CREATE TABLE IF NOT EXISTS `se_course_marks` (
  `course_marks_course_id` int(11) NOT NULL,
  `course_marks_student_id` int(11) NOT NULL,
  `course_marks_marks` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`course_marks_course_id`,`course_marks_student_id`),
  KEY `course_marks_student_id` (`course_marks_student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `se_course_marks`
--

INSERT INTO `se_course_marks` (`course_marks_course_id`, `course_marks_student_id`, `course_marks_marks`) VALUES
(1, 1, 75),
(1, 2, 69),
(1, 3, 68),
(1, 4, 75),
(2, 1, 70),
(2, 2, 65);

-- --------------------------------------------------------

--
-- Table structure for table `se_course_offered_in`
--

CREATE TABLE IF NOT EXISTS `se_course_offered_in` (
  `course_id` int(11) NOT NULL,
  `course_institute_id` int(11) NOT NULL,
  PRIMARY KEY (`course_id`,`course_institute_id`),
  KEY `course_institute_id` (`course_institute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `se_course_offered_in`
--

INSERT INTO `se_course_offered_in` (`course_id`, `course_institute_id`) VALUES
(1, 1),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `se_faculty`
--

CREATE TABLE IF NOT EXISTS `se_faculty` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_institue_id` int(11) NOT NULL,
  `faculty_firstname` varchar(255) NOT NULL,
  `faculty_lastname` varchar(255) NOT NULL,
  `faculty_qualification` varchar(255) NOT NULL,
  `faculty_nic` varchar(255) NOT NULL,
  `faculty_username` varchar(255) NOT NULL,
  `faculty_email` varchar(255) NOT NULL,
  `faculty_password` varchar(255) NOT NULL,
  `faculty_address` varchar(255) DEFAULT NULL,
  `faculty_landline` varchar(255) DEFAULT NULL,
  `faculty_mobile` varchar(255) DEFAULT NULL,
  `faculty_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `faculty_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`faculty_id`),
  KEY `faculty_institue_id` (`faculty_institue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `se_faculty`
--

INSERT INTO `se_faculty` (`faculty_id`, `faculty_institue_id`, `faculty_firstname`, `faculty_lastname`, `faculty_qualification`, `faculty_nic`, `faculty_username`, `faculty_email`, `faculty_password`, `faculty_address`, `faculty_landline`, `faculty_mobile`, `faculty_creation_date`, `faculty_image`) VALUES
(1, 1, 'Nauman', 'Durrani', 'PhD (in Networks)', '42504-2345695-06', 'nauman.durrani', 'nauman.durrani@ste.edu.pk', '098f6bcd4621d373cade4e832627b4f6', NULL, NULL, NULL, '2012-03-23 16:15:58', ''),
(2, 2, 'Samreen', 'Fatima', 'MS (in Mathematics)', '41784-3625682-03', 'samreen.fatima', 'samreen.fatima@ste.edu.pk', '098f6bcd4621d373cade4e832627b4f6', NULL, NULL, NULL, '2012-03-23 16:15:58', NULL),
(3, 1, 'Zubair', 'Shekih', 'sab kuch parh leya', '42045-45287902-09', 'zubair.sheikh', 'zubair.shekih@ste.edu.pk', '098f6bcd4621d373cade4e832627b4f6', '', '', '', '2012-03-23 17:49:48', 'Penguins13.jpg'),
(5, 1, 'Muhammad', 'Rafi', 'MS (in Graphics)', '42045-45287902-06', 'muhammad.rafi', 'muhammad.rafi@ste.edu.pk', '098f6bcd4621d373cade4e832627b4f6', '', '', '', '2012-03-24 18:44:06', NULL),
(24, 1, 'sdasdas', 'sdasdas', 'sdasdfas', 'sfsdfsddf', 'asdasdasa', 'sdasdasda', 'ac6555bfe23f5fe7e98fdcc0cd5f2451', 'dfsdgwc', 'sdfsdfsdfsdf', 'dfsdfsdfsdfsd', '2012-03-25 16:45:26', NULL),
(25, 1, 'sdsdasad', 'sadasdas', 'dasdasdas', 'dadasdasa', 'abc.bca', 'dasdasasdsa', '098f6bcd4621d373cade4e832627b4f6', NULL, NULL, NULL, '2012-03-26 10:48:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `se_faculty_categories`
--

CREATE TABLE IF NOT EXISTS `se_faculty_categories` (
  `faculty_category_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  PRIMARY KEY (`faculty_category_id`,`faculty_id`),
  KEY `faculty_id` (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `se_faculty_categories`
--

INSERT INTO `se_faculty_categories` (`faculty_category_id`, `faculty_id`) VALUES
(2, 1),
(3, 2),
(1, 3),
(2, 5),
(3, 24),
(3, 25);

-- --------------------------------------------------------

--
-- Table structure for table `se_faculty_roles`
--

CREATE TABLE IF NOT EXISTS `se_faculty_roles` (
  `faculty_roles_id` int(11) NOT NULL,
  `faculty_roles_faculty_id` int(11) NOT NULL,
  PRIMARY KEY (`faculty_roles_id`,`faculty_roles_faculty_id`),
  KEY `faculty_roles_faculty_id` (`faculty_roles_faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `se_faculty_roles`
--

INSERT INTO `se_faculty_roles` (`faculty_roles_id`, `faculty_roles_faculty_id`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(10, 1),
(11, 1),
(10, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(3, 5),
(4, 5),
(5, 5),
(7, 5),
(8, 5),
(10, 5),
(11, 5),
(6, 24),
(6, 25),
(10, 25),
(11, 25);

-- --------------------------------------------------------

--
-- Table structure for table `se_institute`
--

CREATE TABLE IF NOT EXISTS `se_institute` (
  `institue_id` int(11) NOT NULL AUTO_INCREMENT,
  `institute_code` varchar(255) NOT NULL,
  `institute_name` varchar(255) NOT NULL,
  `institute_city` varchar(255) NOT NULL,
  `institue_contact` varchar(255) NOT NULL,
  PRIMARY KEY (`institue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `se_institute`
--

INSERT INTO `se_institute` (`institue_id`, `institute_code`, `institute_name`, `institute_city`, `institue_contact`) VALUES
(1, 'STE-01', 'Sindh Polytechnic', 'Sakkhar', '03423346756'),
(2, 'STE-02', 'Sindh Technical Education', 'Jamshoro', '03123365789');

-- --------------------------------------------------------

--
-- Table structure for table `se_lecture_attendence`
--

CREATE TABLE IF NOT EXISTS `se_lecture_attendence` (
  `lecture_attendence_lecture_id` int(11) NOT NULL,
  `lecture_attendence_student_id` int(11) NOT NULL,
  `lecture_attendence_status` enum('P','A') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`lecture_attendence_lecture_id`,`lecture_attendence_student_id`),
  KEY `lecture_attendence_student_id` (`lecture_attendence_student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `se_lecture_attendence`
--

INSERT INTO `se_lecture_attendence` (`lecture_attendence_lecture_id`, `lecture_attendence_student_id`, `lecture_attendence_status`) VALUES
(14, 1, 'P'),
(14, 2, 'P'),
(14, 3, 'P'),
(14, 4, 'P'),
(19, 1, 'P'),
(19, 2, 'A'),
(19, 3, 'P'),
(19, 4, 'P'),
(20, 1, 'P'),
(20, 2, 'P'),
(20, 3, 'P'),
(20, 4, 'P'),
(20, 6, 'P'),
(21, 1, 'P'),
(21, 2, 'P'),
(21, 3, 'P'),
(21, 4, 'P'),
(21, 6, 'P'),
(22, 1, 'P'),
(22, 2, 'P'),
(22, 3, 'P'),
(22, 4, 'P'),
(22, 6, 'P'),
(23, 1, 'P'),
(23, 2, 'P'),
(23, 3, 'P'),
(23, 4, 'P'),
(23, 6, 'P'),
(24, 1, 'P'),
(24, 2, 'P'),
(24, 3, 'P'),
(24, 4, 'P'),
(24, 6, 'P'),
(25, 1, 'P'),
(25, 2, 'P'),
(25, 3, 'P'),
(25, 4, 'P'),
(25, 6, 'P'),
(26, 1, 'P'),
(26, 2, 'P'),
(26, 3, 'P'),
(26, 4, 'P'),
(26, 6, 'P'),
(27, 1, 'P'),
(27, 2, 'P'),
(27, 3, 'P'),
(27, 4, 'P'),
(27, 6, 'P'),
(28, 1, 'P'),
(28, 2, 'P'),
(28, 3, 'P'),
(28, 4, 'P'),
(28, 6, 'P'),
(29, 1, 'A'),
(29, 2, 'A'),
(29, 3, 'A'),
(29, 4, 'A'),
(29, 6, 'A'),
(30, 1, 'A'),
(30, 2, 'A'),
(30, 3, 'A'),
(30, 4, 'A'),
(30, 6, 'A'),
(31, 1, 'P'),
(31, 2, 'P'),
(31, 3, 'A'),
(31, 4, 'P'),
(32, 1, 'P'),
(32, 2, 'P'),
(32, 3, 'P'),
(32, 4, 'P'),
(33, 1, 'A'),
(33, 2, 'P'),
(33, 3, 'A'),
(33, 4, 'P');

-- --------------------------------------------------------

--
-- Table structure for table `se_sessions`
--

CREATE TABLE IF NOT EXISTS `se_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `se_sessions`
--

INSERT INTO `se_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('8a032082c6fee75006769ac55031e5ff', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:7.0) Gecko/20100101 Firefox/7.0', 1332747530, '');

-- --------------------------------------------------------

--
-- Table structure for table `se_student`
--

CREATE TABLE IF NOT EXISTS `se_student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_roll_number` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_institute_id` int(11) NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `student_institute_id` (`student_institute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `se_student`
--

INSERT INTO `se_student` (`student_id`, `student_roll_number`, `student_name`, `student_institute_id`) VALUES
(1, 2106, 'Qasim Hussain', 1),
(2, 2103, 'Muhammad Hussain', 1),
(3, 2149, 'Talha Qasim', 1),
(4, 2051, 'Muhammad Ahmed', 1),
(5, 2037, 'Farooq Ahmed', 2),
(6, 2060, 'Wasif Zia', 2);

-- --------------------------------------------------------

--
-- Table structure for table `se_student_course`
--

CREATE TABLE IF NOT EXISTS `se_student_course` (
  `registered_student_id` int(11) NOT NULL,
  `registered_course_id` int(11) NOT NULL,
  KEY `registered_student_id` (`registered_student_id`),
  KEY `registered_course_id` (`registered_course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `se_student_course`
--

INSERT INTO `se_student_course` (`registered_student_id`, `registered_course_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(4, 1),
(5, 2),
(6, 2),
(6, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `se_category_roles`
--
ALTER TABLE `se_category_roles`
  ADD CONSTRAINT `se_category_roles_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `se_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `se_course`
--
ALTER TABLE `se_course`
  ADD CONSTRAINT `se_course_ibfk_1` FOREIGN KEY (`course_instructor`) REFERENCES `se_faculty` (`faculty_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `se_course_ibfk_2` FOREIGN KEY (`course_examiner`) REFERENCES `se_faculty` (`faculty_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `se_course_lecture`
--
ALTER TABLE `se_course_lecture`
  ADD CONSTRAINT `se_course_lecture_ibfk_1` FOREIGN KEY (`lecture_course_id`) REFERENCES `se_course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `se_course_marks`
--
ALTER TABLE `se_course_marks`
  ADD CONSTRAINT `se_course_marks_ibfk_1` FOREIGN KEY (`course_marks_course_id`) REFERENCES `se_course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `se_course_marks_ibfk_2` FOREIGN KEY (`course_marks_student_id`) REFERENCES `se_student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `se_course_offered_in`
--
ALTER TABLE `se_course_offered_in`
  ADD CONSTRAINT `se_course_offered_in_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `se_course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `se_course_offered_in_ibfk_2` FOREIGN KEY (`course_institute_id`) REFERENCES `se_institute` (`institue_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `se_faculty`
--
ALTER TABLE `se_faculty`
  ADD CONSTRAINT `se_faculty_ibfk_1` FOREIGN KEY (`faculty_institue_id`) REFERENCES `se_institute` (`institue_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `se_faculty_categories`
--
ALTER TABLE `se_faculty_categories`
  ADD CONSTRAINT `se_faculty_categories_ibfk_1` FOREIGN KEY (`faculty_category_id`) REFERENCES `se_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `se_faculty_categories_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `se_faculty` (`faculty_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `se_faculty_roles`
--
ALTER TABLE `se_faculty_roles`
  ADD CONSTRAINT `se_faculty_roles_ibfk_1` FOREIGN KEY (`faculty_roles_id`) REFERENCES `se_category_roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `se_faculty_roles_ibfk_2` FOREIGN KEY (`faculty_roles_faculty_id`) REFERENCES `se_faculty` (`faculty_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `se_lecture_attendence`
--
ALTER TABLE `se_lecture_attendence`
  ADD CONSTRAINT `se_lecture_attendence_ibfk_1` FOREIGN KEY (`lecture_attendence_lecture_id`) REFERENCES `se_course_lecture` (`lecture_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `se_lecture_attendence_ibfk_2` FOREIGN KEY (`lecture_attendence_student_id`) REFERENCES `se_student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `se_student`
--
ALTER TABLE `se_student`
  ADD CONSTRAINT `se_student_ibfk_1` FOREIGN KEY (`student_institute_id`) REFERENCES `se_institute` (`institue_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `se_student_course`
--
ALTER TABLE `se_student_course`
  ADD CONSTRAINT `se_student_course_ibfk_1` FOREIGN KEY (`registered_student_id`) REFERENCES `se_student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `se_student_course_ibfk_2` FOREIGN KEY (`registered_course_id`) REFERENCES `se_course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;
