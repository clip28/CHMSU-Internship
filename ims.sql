-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2023 at 03:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(20) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Name`, `email`, `Password`) VALUES
(1254678, 'Admin', 'admin@gmail.com', '12345'),
(1414552, 'ali', 'alion@g.com', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `appID` int(255) NOT NULL,
  `STUDENT_ID` int(255) NOT NULL,
  `Job_ID` int(255) NOT NULL,
  `confirmation` varchar(3) DEFAULT NULL,
  `Proof` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `Date_Applied` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`appID`, `STUDENT_ID`, `Job_ID`, `confirmation`, `Proof`, `Status`, `Date_Applied`) VALUES
(154, 10133697, 5, NULL, NULL, NULL, '2022-05-30'),
(155, 10133697, 6, NULL, NULL, NULL, '2022-05-30'),
(156, 10133697, 3, 'YES', '156_10133697_2022-05-30.pdf', 'Confirmed', '2022-05-30'),
(157, 10133697, 4, 'NO', NULL, NULL, '2022-05-30'),
(158, 10133697, 1, NULL, NULL, NULL, '2022-05-30'),
(159, 10133697, 2, NULL, NULL, NULL, '2022-05-30'),
(188, 3456789, 5, NULL, NULL, NULL, '2023-05-15'),
(189, 3456789, 8, NULL, NULL, NULL, '2023-05-15'),
(190, 3456789, 4, NULL, NULL, NULL, '2023-05-15'),
(191, 3456789, 6, NULL, NULL, NULL, '2023-05-15'),
(192, 3456789, 3, NULL, NULL, NULL, '2023-05-15'),
(193, 3456789, 7, NULL, NULL, NULL, '2023-05-15'),
(194, 3456789, 1, NULL, NULL, NULL, '2023-05-15'),
(195, 3456789, 2, NULL, NULL, NULL, '2023-05-15'),
(196, 12345, 5, NULL, NULL, NULL, '2023-05-15'),
(197, 12345, 6, NULL, NULL, NULL, '2023-05-15'),
(198, 12345, 8, NULL, NULL, NULL, '2023-05-15'),
(199, 12345, 3, 'YES', NULL, NULL, '2023-05-15'),
(200, 12345, 4, NULL, NULL, NULL, '2023-05-15'),
(201, 12345, 7, NULL, NULL, NULL, '2023-05-15'),
(202, 12345, 1, NULL, NULL, NULL, '2023-05-15'),
(203, 12345, 2, NULL, NULL, NULL, '2023-05-15'),
(204, 10133697, 7, NULL, NULL, NULL, '2023-05-17'),
(205, 10133697, 8, NULL, NULL, NULL, '2023-05-17');

-- --------------------------------------------------------

--
-- Stand-in structure for view `confirmed_details`
-- (See below for the actual view)
--
CREATE TABLE `confirmed_details` (
`Job_ID` int(255)
,`REGIS_NO` int(20)
,`STUDENT_ID` int(255)
,`NAME` varchar(50)
,`STUDENT_EMAIL` varchar(100)
,`COURSE` varchar(50)
,`YEAR_OF_STUDY` varchar(1)
,`CV` varchar(30)
);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `appID` int(255) NOT NULL,
  `email` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `forhistory`
-- (See below for the actual view)
--
CREATE TABLE `forhistory` (
`STUDENT_ID` int(255)
,`NAME` varchar(50)
,`STUDENT_EMAIL` varchar(100)
,`COURSE` varchar(50)
,`SUPERVISOR` varchar(50)
,`YEAR_OF_STUDY` varchar(1)
,`COMPANY_NAME` varchar(50)
,`WEBSITE` varchar(50)
,`Email` varchar(255)
,`Job_Title` varchar(255)
,`Position` varchar(255)
,`Date_Applied` date
);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(255) NOT NULL,
  `Student_id` varchar(255) DEFAULT NULL,
  `Student_NAME` varchar(255) DEFAULT NULL,
  `STUDENT_EMAIL` varchar(255) DEFAULT NULL,
  `COURSE` varchar(255) DEFAULT NULL,
  `SUPERVISOR` varchar(255) DEFAULT NULL,
  `YEAR_OF_STUDY` varchar(255) DEFAULT NULL,
  `COMPANY_NAME` varchar(255) DEFAULT NULL,
  `WEBSITE` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Job_Title` varchar(255) DEFAULT NULL,
  `Position` varchar(255) DEFAULT NULL,
  `Date_Applied` date DEFAULT NULL,
  `Completion_date` date DEFAULT NULL,
  `Job_ID` int(255) DEFAULT NULL,
  `REGIS_NO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `Student_id`, `Student_NAME`, `STUDENT_EMAIL`, `COURSE`, `SUPERVISOR`, `YEAR_OF_STUDY`, `COMPANY_NAME`, `WEBSITE`, `Email`, `Job_Title`, `Position`, `Date_Applied`, `Completion_date`, `Job_ID`, `REGIS_NO`) VALUES
(23, '10122000', 'Aaina chowdhury', '10122000@students.swinburne.edu.my', 'Bachelors of Commerce', NULL, '2', 'Mircosoft ', 'www.mircosoft.com', 'MS@outlook.com', 'Looking for Data Analyst ', 'Assistant', '2022-05-30', '2022-05-30', 5, '2010312'),
(24, '10169887', 'Jessica Chong', '10169887@students.swinburne.edu.my', 'Bachelors of Engineering', NULL, '3', 'Samsung', 'www.samsung.com', 'Samsung@sm.com', 'Looking for Someone who Can troubleshoot Php ', 'Assistant', '2022-05-30', '2022-05-30', 3, '1202202'),
(25, '101224455', 'Mohammad Arsalan Hossain', '101224455@students.swinburne.edu.my', 'Bachelors of Commerce', 'Dwayne Johnson', '2', 'Samsung', 'www.samsung.com', 'Samsung@sm.com', 'Looking for Someone who Can troubleshoot Php ', 'Assistant', '2022-05-30', '2022-05-30', 3, '1202202'),
(28, '101220618', 'Ashfaque Ali Shagor', '101220618@students.swinburne.edu.my', 'Bachelors of Information Technology', 'Eric', '3', 'Samsung', 'www.samsung.com', 'Samsung@sm.com', 'Looking for Someone who Can troubleshoot Php ', 'Assistant', '2022-05-30', '2022-05-30', 3, '1202202');

-- --------------------------------------------------------

--
-- Table structure for table `industry`
--

CREATE TABLE `industry` (
  `REGIS_NO` int(255) NOT NULL,
  `COMPANY_NAME` varchar(50) NOT NULL,
  `COMPANY_ADDRESS` varchar(50) NOT NULL,
  `CONTACT_NO` varchar(20) NOT NULL,
  `WEBSITE` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `industry`
--

INSERT INTO `industry` (`REGIS_NO`, `COMPANY_NAME`, `COMPANY_ADDRESS`, `CONTACT_NO`, `WEBSITE`, `Password`, `USERNAME`, `Email`) VALUES
(1202202, 'Samsung', '123 Korea town Malaysia', '0134423556', 'www.samsung.com', '12345', 'Samsung', 'Samsung@sm.com'),
(2010312, 'Mircosoft  new', '124 America town Malaysia', ' 013442123', 'www.mircosoft.com', '12345', 'MS', 'MS@outlook.com'),
(7894521, 'Total Oil', 'kuching sarawak', '0122231577', 'www.totaloil.com', '1234', 'ttol', 'toil@tt.com');

-- --------------------------------------------------------

--
-- Table structure for table `industry_review_table`
--

CREATE TABLE `industry_review_table` (
  `FeedID` int(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `rating_question1` varchar(4) DEFAULT NULL,
  `rating_question2` varchar(4) DEFAULT NULL,
  `user_rating` int(4) DEFAULT NULL,
  `user_review` varchar(255) DEFAULT NULL,
  `datetime` date DEFAULT NULL,
  `STUDENT_ID` varchar(255) DEFAULT NULL,
  `Job_ID` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `industry_review_table`
--

INSERT INTO `industry_review_table` (`FeedID`, `user_name`, `rating_question1`, `rating_question2`, `user_rating`, `user_review`, `datetime`, `STUDENT_ID`, `Job_ID`) VALUES
(14, 'Samsung', 'Yes', 'Yes', 5, 'as', '2022-05-30', '101224455', 3),
(15, 'Mircosoft ', 'Yes', 'Yes', 5, 'asdasda', '2022-05-30', '101226858', 5),
(16, 'Mircosoft ', 'Yes', 'Yes', 5, 'asda', '2022-05-30', '101226858', 5),
(17, 'Samsung', 'Yes', 'Yes', 5, 'he was good', '2022-05-30', '101220618', 3);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `Job_ID` int(11) NOT NULL,
  `Job_Title` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Qualification` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Vacancy` varchar(255) NOT NULL,
  `REGIS_NO` int(20) NOT NULL,
  `Date_Posted` date DEFAULT NULL,
  `Date_End` date DEFAULT NULL,
  `Extra_Details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`Job_ID`, `Job_Title`, `Location`, `Qualification`, `Category`, `Position`, `Vacancy`, `REGIS_NO`, `Date_Posted`, `Date_End`, `Extra_Details`) VALUES
(1, 'Internship For data entry ', 'Kuching', '3rd Year', 'Oil Industry', 'Supervisor', '122', 7894521, '2022-05-30', '2022-08-30', 'car oil'),
(2, 'Internship for database management', 'Miri', 'Third Year', 'Oil Industry', 'Assistant', '123', 7894521, '2022-05-30', '2022-09-30', 'car oil'),
(3, 'Looking for Someone who Can troubleshoot Php', 'Bacolod', 'third year', 'ICT Industry', ' Assistant', '123', 1202202, '2022-05-30', '2022-09-30', 'data infrastucture'),
(4, 'Secretary for Coffee Man', 'los angelos', 'second year', 'Food Industry', ' supervisor', '123', 1202202, '2022-05-30', '2022-09-30', 'Cafe'),
(5, 'Looking for Data Analyst ', 'Kuching', 'third year', 'ICT Industry', 'Assistant', '123', 2010312, '2022-05-30', '2022-06-30', 'software'),
(6, 'Software Developer', 'canada', 'third year', 'ICT Industry', 'Supervisor', '123', 2010312, '2022-05-30', '2022-10-30', 'software'),
(7, 'Internship For data entry ', 'Kuching', 'Third Year', 'Food Industry', 'Assistant', '123', 1202202, '2022-05-30', '2022-08-30', 'Cafe'),
(8, 'Secretary for Juice Man', 'canada', 'Third Year', 'ICT Industry', 'Supervisor', '122', 2010312, '2022-05-30', '2022-10-30', 'software');

-- --------------------------------------------------------

--
-- Stand-in structure for view `seetowork`
-- (See below for the actual view)
--
CREATE TABLE `seetowork` (
`STUDENT_ID` int(255)
,`NAME` varchar(50)
,`STUDENT_EMAIL` varchar(100)
,`COURSE` varchar(50)
,`ENROLL` varchar(255)
,`SUPERVISOR` varchar(50)
,`GENDER` varchar(7)
,`CURRENT_RESIDENCE` varchar(100)
,`CONTACT_NO` varchar(20)
,`YEAR_OF_STUDY` varchar(1)
,`PASSWORD` varchar(20)
,`CV` varchar(30)
,`USERNAME` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `STUDENT_ID` int(255) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `STUDENT_EMAIL` varchar(100) NOT NULL,
  `COURSE` varchar(50) NOT NULL,
  `ENROLL` varchar(255) DEFAULT NULL,
  `SUPERVISOR` varchar(50) DEFAULT NULL,
  `GENDER` varchar(7) NOT NULL,
  `CURRENT_RESIDENCE` varchar(100) NOT NULL,
  `CONTACT_NO` varchar(20) NOT NULL,
  `YEAR_OF_STUDY` varchar(1) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `CV` varchar(30) DEFAULT NULL,
  `USERNAME` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`STUDENT_ID`, `NAME`, `STUDENT_EMAIL`, `COURSE`, `ENROLL`, `SUPERVISOR`, `GENDER`, `CURRENT_RESIDENCE`, `CONTACT_NO`, `YEAR_OF_STUDY`, `PASSWORD`, `CV`, `USERNAME`) VALUES
(0, 'Julius Medel', 'julius@gmail.com', 'Bachelors of Science in Entrepreneurship', '', NULL, 'Male', 'Hinagaran', '09385247103', '3', '123', '', 'juls'),
(12345, 'Julius Medel', 'pogi@gmail.com', 'Bachelor of Science in Office Administration', NULL, 'Mama', ' Male', 'Estefania', '0134423556', '3', '123', 'profile12345.pdf', 'juls'),
(3456789, 'sasdfghj', 'aryan@gmail.com', 'Bachelors of Science in Management Accounting', NULL, 'Correct', ' Male', 'adfdghjhkjl;', '234567890', '2', '123', '\n', 'asd'),
(10133697, 'Julius Villarbas', 'villarbas@gmail.com', 'Bachelors of Science in Management Accounting', '', 'MIko', ' Male', 'Tagda Hinigaran', '589347', '3', '123456', '', 'Julss');

-- --------------------------------------------------------

--
-- Stand-in structure for view `students_nonappliedjobs`
-- (See below for the actual view)
--
CREATE TABLE `students_nonappliedjobs` (
`NAME` varchar(50)
,`STUDENT_ID` int(255)
,`REGIS_NO` int(20)
,`Job_ID` int(11)
,`Job_Title` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_job_details`
-- (See below for the actual view)
--
CREATE TABLE `student_job_details` (
`STUDENT_ID` int(255)
,`REGIS_NO` int(20)
,`COMPANY_NAME` varchar(50)
,`Job_ID` int(11)
,`Job_Title` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `student_review_table`
--

CREATE TABLE `student_review_table` (
  `FeedID` int(255) NOT NULL,
  `STUDENT_ID` int(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `rating_question1` varchar(4) DEFAULT NULL,
  `rating_question2` varchar(4) DEFAULT NULL,
  `user_rating` int(5) DEFAULT NULL,
  `user_review` varchar(255) DEFAULT NULL,
  `datetime` date DEFAULT NULL,
  `Job_ID` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `confirmed_details`
--
DROP TABLE IF EXISTS `confirmed_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `confirmed_details`  AS SELECT `a`.`Job_ID` AS `Job_ID`, `j`.`REGIS_NO` AS `REGIS_NO`, `s`.`STUDENT_ID` AS `STUDENT_ID`, `s`.`NAME` AS `NAME`, `s`.`STUDENT_EMAIL` AS `STUDENT_EMAIL`, `s`.`COURSE` AS `COURSE`, `s`.`YEAR_OF_STUDY` AS `YEAR_OF_STUDY`, `s`.`CV` AS `CV` FROM (((`student` `s` join `applicants` `a` on(`s`.`STUDENT_ID` = `a`.`STUDENT_ID`)) join `jobs` `j` on(`a`.`Job_ID` = `j`.`Job_ID`)) join `industry` `i` on(`j`.`REGIS_NO` = `i`.`REGIS_NO`)) WHERE `s`.`ENROLL` = 'confirmed\'confirmed\'confirmed\'confirmed\'confirmed\'confirmed\'confirmed\'confirmed' ;

-- --------------------------------------------------------

--
-- Structure for view `forhistory`
--
DROP TABLE IF EXISTS `forhistory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `forhistory`  AS SELECT `s`.`STUDENT_ID` AS `STUDENT_ID`, `s`.`NAME` AS `NAME`, `s`.`STUDENT_EMAIL` AS `STUDENT_EMAIL`, `s`.`COURSE` AS `COURSE`, `s`.`SUPERVISOR` AS `SUPERVISOR`, `s`.`YEAR_OF_STUDY` AS `YEAR_OF_STUDY`, `i`.`COMPANY_NAME` AS `COMPANY_NAME`, `i`.`WEBSITE` AS `WEBSITE`, `i`.`Email` AS `Email`, `j`.`Job_Title` AS `Job_Title`, `j`.`Position` AS `Position`, `a`.`Date_Applied` AS `Date_Applied` FROM (((`student` `s` join `applicants` `a` on(`s`.`STUDENT_ID` = `a`.`STUDENT_ID`)) join `jobs` `j` on(`a`.`Job_ID` = `j`.`Job_ID`)) join `industry` `i` on(`j`.`REGIS_NO` = `i`.`REGIS_NO`)) ;

-- --------------------------------------------------------

--
-- Structure for view `seetowork`
--
DROP TABLE IF EXISTS `seetowork`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `seetowork`  AS SELECT `student`.`STUDENT_ID` AS `STUDENT_ID`, `student`.`NAME` AS `NAME`, `student`.`STUDENT_EMAIL` AS `STUDENT_EMAIL`, `student`.`COURSE` AS `COURSE`, `student`.`ENROLL` AS `ENROLL`, `student`.`SUPERVISOR` AS `SUPERVISOR`, `student`.`GENDER` AS `GENDER`, `student`.`CURRENT_RESIDENCE` AS `CURRENT_RESIDENCE`, `student`.`CONTACT_NO` AS `CONTACT_NO`, `student`.`YEAR_OF_STUDY` AS `YEAR_OF_STUDY`, `student`.`PASSWORD` AS `PASSWORD`, `student`.`CV` AS `CV`, `student`.`USERNAME` AS `USERNAME` FROM `student` WHERE 11111111 ;

-- --------------------------------------------------------

--
-- Structure for view `students_nonappliedjobs`
--
DROP TABLE IF EXISTS `students_nonappliedjobs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`trial for more options`@`%` SQL SECURITY DEFINER VIEW `students_nonappliedjobs`  AS SELECT `a`.`NAME` AS `NAME`, `a`.`STUDENT_ID` AS `STUDENT_ID`, `j`.`REGIS_NO` AS `REGIS_NO`, `j`.`Job_ID` AS `Job_ID`, `j`.`Job_Title` AS `Job_Title` FROM ((`student` `a` join `applicants` `o` on(`a`.`STUDENT_ID` = `o`.`STUDENT_ID`)) join `jobs` `j` on(`o`.`Job_ID` = `j`.`Job_ID`)) WHERE `a`.`STUDENT_ID` <> 99999999999999999999999999999999999999999999999999999999999999999 ;

-- --------------------------------------------------------

--
-- Structure for view `student_job_details`
--
DROP TABLE IF EXISTS `student_job_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_job_details`  AS SELECT `s`.`STUDENT_ID` AS `STUDENT_ID`, `j`.`REGIS_NO` AS `REGIS_NO`, `i`.`COMPANY_NAME` AS `COMPANY_NAME`, `j`.`Job_ID` AS `Job_ID`, `j`.`Job_Title` AS `Job_Title` FROM (((`student` `s` join `applicants` `a` on(`s`.`STUDENT_ID` = `a`.`STUDENT_ID`)) join `jobs` `j` on(`a`.`Job_ID` = `j`.`Job_ID`)) join `industry` `i` on(`j`.`REGIS_NO` = `i`.`REGIS_NO`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`appID`),
  ADD KEY `STUDENT_ID` (`STUDENT_ID`),
  ADD KEY `Job_ID` (`Job_ID`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`appID`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industry`
--
ALTER TABLE `industry`
  ADD PRIMARY KEY (`REGIS_NO`);

--
-- Indexes for table `industry_review_table`
--
ALTER TABLE `industry_review_table`
  ADD PRIMARY KEY (`FeedID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`Job_ID`),
  ADD KEY `REGIS_NO` (`REGIS_NO`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`STUDENT_ID`);

--
-- Indexes for table `student_review_table`
--
ALTER TABLE `student_review_table`
  ADD PRIMARY KEY (`FeedID`),
  ADD KEY `STUDENT_ID` (`STUDENT_ID`),
  ADD KEY `Job_ID` (`Job_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `appID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `appID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `industry_review_table`
--
ALTER TABLE `industry_review_table`
  MODIFY `FeedID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `Job_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_review_table`
--
ALTER TABLE `student_review_table`
  MODIFY `FeedID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicants_ibfk_1` FOREIGN KEY (`STUDENT_ID`) REFERENCES `student` (`STUDENT_ID`),
  ADD CONSTRAINT `applicants_ibfk_2` FOREIGN KEY (`Job_ID`) REFERENCES `jobs` (`Job_ID`);

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`REGIS_NO`) REFERENCES `industry` (`REGIS_NO`);

--
-- Constraints for table `student_review_table`
--
ALTER TABLE `student_review_table`
  ADD CONSTRAINT `student_review_table_ibfk_1` FOREIGN KEY (`STUDENT_ID`) REFERENCES `student` (`STUDENT_ID`),
  ADD CONSTRAINT `student_review_table_ibfk_2` FOREIGN KEY (`Job_ID`) REFERENCES `jobs` (`Job_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
