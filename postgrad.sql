-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2018 at 04:26 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `postgrad`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `courseID` varchar(6) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `courseStatus` varchar(10) NOT NULL,
  PRIMARY KEY (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `courseName`, `courseStatus`) VALUES
('MITC', 'MASTER OF COMPUTER SCIENCE (INTERNETWORKING TECHNOLOGY)', 'ACTIVE'),
('MITD', 'MASTER OF COMPUTER SCIENCE (DATABASE TECHNOLOGY)', 'ACTIVE'),
('MITM', 'MASTER OF COMPUTER SCIENCE (MULTIMEDIA COMPUTING)', 'ACTIVE'),
('MITS', 'MASTER OF COMPUTER SCIENCE (SOFTWARE ENGINEERING AND INTELLIGENCE)', 'ACTIVE'),
('MITZ', 'MASTER OF COMPUTER SCIENCE (SECURITY SCIENCE)', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE IF NOT EXISTS `lecturer` (
  `lectID` varchar(10) NOT NULL,
  `lectName` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `committee` varchar(5) NOT NULL,
  PRIMARY KEY (`lectID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lectID`, `lectName`, `password`, `email`, `status`, `committee`) VALUES
('11111', 'DR ZAHRIAH BINTI OTHMAN', 'abc123', 'zahriah@utem.edu.my', 'ACTIVE', 'YES'),
('22222', 'DR SABRINA BINTI AHMAD', 'abc123', 'sabrinaahmad@utem.edu.my', 'ACTIVE', 'NO'),
('25957', 'NURUL NAJEEHA BINTI SAHDAN', 'abc123', 'geembet@utem.edu.my', 'INACTIVE', 'NO'),
('33333', 'DR INTAN ERMAHANI BINTI A. JALIL', 'abc123', 'ermahani@utem.edu.my', 'ACTIVE', 'YES'),
('98989', 'ALI BIN ABU', 'abc123', 'abu@utem.edu.my', 'INACTIVE', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `lo_criteria`
--

CREATE TABLE IF NOT EXISTS `lo_criteria` (
  `loID` int(11) NOT NULL,
  `criteriaID` varchar(4) NOT NULL,
  `lo_num` varchar(4) NOT NULL DEFAULT 'NULL',
  `criteria` varchar(200) NOT NULL,
  `markAllocated` int(11) NOT NULL,
  PRIMARY KEY (`loID`,`criteriaID`,`lo_num`),
  KEY `lo_num` (`lo_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lo_criteria`
--

INSERT INTO `lo_criteria` (`loID`, `criteriaID`, `lo_num`, `criteria`, `markAllocated`) VALUES
(1, 'A1', 'LO1', 'APPROPRIATE PROBLEM STATEMENTS', 15),
(1, 'A2', 'LO1', 'CLEAR OBJECTIVES', 15),
(1, 'A3', 'LO1', 'ESTABLISH THE IMPORTANCE OF STUDY', 5),
(1, 'A4', 'LO1', 'SUFFICIENT SCOPE', 5),
(1, 'A5', 'LO2', 'COMPREHENSIVE LITERATURE REVIEW', 15),
(1, 'A6', 'LO2', 'PROPER RESEARCH METHODOLOGY', 15),
(2, 'B1', 'LO3', 'ABILITY TO EXPLAIN PROBLEM STATEMENTS AND OBJECTIVES', 5),
(2, 'B2', 'LO3', 'CRITICAL DISCUSSION ON LITERATURE REVIEW', 10),
(2, 'B3', 'LO3', 'GOOD JUSTIFICATION ON RESEARCH METHODOLOGY ', 10),
(2, 'B4', 'LO3', 'APPROPRIATE ANSWERS TO RESPONSE THE QUESTIONS', 5);

-- --------------------------------------------------------

--
-- Table structure for table `lo_element`
--

CREATE TABLE IF NOT EXISTS `lo_element` (
  `loID` int(11) NOT NULL,
  `categoryName` varchar(20) NOT NULL,
  `percentSV` double NOT NULL,
  `percentEV` double NOT NULL,
  PRIMARY KEY (`loID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lo_element`
--

INSERT INTO `lo_element` (`loID`, `categoryName`, `percentSV`, `percentEV`) VALUES
(1, 'REPORTS', 40, 30),
(2, 'PRESENTION', 15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `lo_mark`
--

CREATE TABLE IF NOT EXISTS `lo_mark` (
  `lo_num` varchar(4) NOT NULL,
  `lo_desc` varchar(100) NOT NULL,
  `percentSV` int(11) DEFAULT NULL,
  `percentEV` int(11) DEFAULT NULL,
  PRIMARY KEY (`lo_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lo_mark`
--

INSERT INTO `lo_mark` (`lo_num`, `lo_desc`, `percentSV`, `percentEV`) VALUES
('LO1', 'THIS IS LO1 DESCRIPTION', NULL, NULL),
('LO2', 'THIS IS LO2 DESCRIPTION', NULL, NULL),
('LO3', 'THIS IS LO3 DESCRIPTION', NULL, NULL),
('LO4', 'THIS IS LO4 DESCRIPTION', NULL, NULL),
('LO5', 'THIS IS LO5 DESCRIPTION', NULL, NULL),
('LO6', 'THIS IS LO6 DESCRIPTION', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lo_mark_student`
--

CREATE TABLE IF NOT EXISTS `lo_mark_student` (
  `studID` varchar(12) NOT NULL,
  `lo_num` varchar(4) NOT NULL,
  `posID` int(11) NOT NULL,
  `lo_mark` float NOT NULL,
  PRIMARY KEY (`studID`,`lo_num`,`posID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lo_mark_student`
--

INSERT INTO `lo_mark_student` (`studID`, `lo_num`, `posID`, `lo_mark`) VALUES
('B031510298', 'LO1', 1002, 6.4),
('B031510298', 'LO1', 1003, 19),
('B031510298', 'LO1', 1004, 6.6),
('B031510298', 'LO2', 1002, 5.2),
('B031510298', 'LO2', 1003, 14.7),
('B031510298', 'LO2', 1004, 5.2),
('B031510298', 'LO3', 1002, 5.5),
('B031510298', 'LO3', 1003, 12),
('B031510298', 'LO3', 1004, 5.5);

-- --------------------------------------------------------

--
-- Table structure for table `lo_mark_student_total`
--

CREATE TABLE IF NOT EXISTS `lo_mark_student_total` (
  `studID` varchar(12) NOT NULL,
  `lo_num` varchar(4) NOT NULL,
  `totalMark` float NOT NULL,
  `percentage` float NOT NULL,
  PRIMARY KEY (`studID`,`lo_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lo_mark_student_total`
--

INSERT INTO `lo_mark_student_total` (`studID`, `lo_num`, `totalMark`, `percentage`) VALUES
('B031510298', 'LO1', 32, 80),
('B031510298', 'LO2', 25.1, 83.7),
('B031510298', 'LO3', 23, 76.7);

-- --------------------------------------------------------

--
-- Table structure for table `lo_po`
--

CREATE TABLE IF NOT EXISTS `lo_po` (
  `lo_num` varchar(4) NOT NULL,
  `po_num` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lo_po`
--

INSERT INTO `lo_po` (`lo_num`, `po_num`) VALUES
('LO1', 'PO2'),
('LO2', 'PO3');

-- --------------------------------------------------------

--
-- Table structure for table `mark_student`
--

CREATE TABLE IF NOT EXISTS `mark_student` (
  `titleID` int(11) NOT NULL,
  `lectID` varchar(10) NOT NULL,
  `posID` int(11) NOT NULL,
  `markGet` int(11) DEFAULT NULL,
  PRIMARY KEY (`titleID`,`lectID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mark_student`
--

INSERT INTO `mark_student` (`titleID`, `lectID`, `posID`, `markGet`) VALUES
(1, '11111', 1003, 22),
(1, '22222', 1002, 30),
(1, '33333', 1004, NULL),
(2, '11111', 1002, 0),
(2, '22222', 1003, 0),
(2, '33333', 1004, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `posID` int(11) NOT NULL AUTO_INCREMENT,
  `posName` varchar(15) NOT NULL,
  PRIMARY KEY (`posID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1005 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`posID`, `posName`) VALUES
(1001, 'COMMITTEE'),
(1002, 'EVALUATOR 1'),
(1003, 'SUPERVISOR'),
(1004, 'EVALUATOR 2');

-- --------------------------------------------------------

--
-- Table structure for table `po_mark`
--

CREATE TABLE IF NOT EXISTS `po_mark` (
  `po_num` varchar(4) NOT NULL,
  `po_desc` varchar(100) NOT NULL,
  `percentSV` int(11) DEFAULT NULL,
  `percentEV` int(11) DEFAULT NULL,
  PRIMARY KEY (`po_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_mark`
--

INSERT INTO `po_mark` (`po_num`, `po_desc`, `percentSV`, `percentEV`) VALUES
('PO1', 'THIS IS PO1 DESCRIPTION', NULL, NULL),
('PO2', 'THIS IS PO2 DESCRIPTION', NULL, NULL),
('PO3', 'THIS IS PO3 DESCRIPTION', NULL, NULL),
('PO4', 'THIS IS PO4 DESCRIPTION', NULL, NULL),
('PO5', 'THIS IS PO5 DESCRIPTION', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `present`
--

CREATE TABLE IF NOT EXISTS `present` (
  `titleID` int(11) NOT NULL,
  `date` date NOT NULL,
  `timeStart` time NOT NULL,
  `timeEnd` time NOT NULL,
  `place` varchar(50) NOT NULL,
  PRIMARY KEY (`titleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `present`
--

INSERT INTO `present` (`titleID`, `date`, `timeStart`, `timeEnd`, `place`) VALUES
(1, '2018-04-30', '14:00:00', '14:30:00', 'MKP 1'),
(2, '2018-04-28', '15:30:00', '16:00:00', 'MKP 2');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `projectID` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`projectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2004 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectID`, `description`) VALUES
(2001, 'PROJECT 1'),
(2002, 'PROJECT 2'),
(2003, 'PROPOSAL DEFENSE');

-- --------------------------------------------------------

--
-- Table structure for table `project_student`
--

CREATE TABLE IF NOT EXISTS `project_student` (
  `titleID` int(11) NOT NULL AUTO_INCREMENT,
  `studID` varchar(12) NOT NULL,
  `projectID` int(11) NOT NULL,
  `semID` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`titleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `project_student`
--

INSERT INTO `project_student` (`titleID`, `studID`, `projectID`, `semID`, `title`) VALUES
(1, 'B031510298', 2001, '2-2017/2018', 'MANAGING RISKS FOR ENTERPRISE RESOURCE PLANNING SOFTWARE PROJECT'),
(2, 'B031510281', 2001, '2-2017/2018', 'EXPANDING CLOUD SERVICES IN TERM OF SECURITY'),
(5, 'B031510291', 2001, '2-2017/2018', 'MANAGING DATABASE'),
(6, 'B031520277', 2001, '2-2017/2018', 'CLOUD COMPUTING'),
(9, 'B031510298', 2002, '3-2017/2018', 'THIS IS A TEST');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
  `semID` varchar(20) NOT NULL,
  `details` varchar(20) NOT NULL,
  PRIMARY KEY (`semID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semID`, `details`) VALUES
('currSem', '2-2017/2018');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `studID` varchar(12) NOT NULL,
  `studName` varchar(100) NOT NULL,
  `course` varchar(5) NOT NULL,
  `email` varchar(35) NOT NULL,
  `semester` varchar(20) NOT NULL,
  PRIMARY KEY (`studID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studID`, `studName`, `course`, `email`, `semester`) VALUES
('B031510281', 'RIFHAN NUR ADIBAH BINTI MOHAMAD', 'MITA', 'B031510281@student.utem.edu.my', '2-2017/2018'),
('B031510291', 'NORLIA BINTI ISMAIL', 'MITA', 'B031510291@student.utem.edu.my', '2-2017/2018'),
('B031510298', 'SITI NUR SYAFIQAH BINTI YAHAYAH', 'MITA', 'B031510298@student.utem.edu.my', '2-2017/2018'),
('B031520277', 'SITI SARAH BINTI ZAID ', 'MITA', 'B031510277@student.utem.edu.my', '2-2017/2018'),
('B999999999', 'AMINAH BINTI JAMAL', 'MITC', 'B999999999@student.utem.edu.my', '2-2017/2018');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lo_criteria`
--
ALTER TABLE `lo_criteria`
  ADD CONSTRAINT `lo_criteria_ibfk_3` FOREIGN KEY (`loID`) REFERENCES `lo_element` (`loID`);

--
-- Constraints for table `present`
--
ALTER TABLE `present`
  ADD CONSTRAINT `present_ibfk_1` FOREIGN KEY (`titleID`) REFERENCES `project_student` (`titleID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
