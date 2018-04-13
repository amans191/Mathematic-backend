-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2018 at 06:25 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Mathemagic`
--

-- --------------------------------------------------------

--
-- Table structure for table `Parent`
--

CREATE TABLE `Parent` (
  `parent_id` int(6) NOT NULL,
  `parentFName` varchar(50) NOT NULL,
  `parentSName` varchar(50) NOT NULL,
  `parentEmail` varchar(100) NOT NULL,
  `studentID` int(6) NOT NULL,
  `studentSName` varchar(50) NOT NULL,
  `parentPassword` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Parent`
--

INSERT INTO `Parent` (`parent_id`, `parentFName`, `parentSName`, `parentEmail`, `studentID`, `studentSName`, `parentPassword`) VALUES
(2, 'aman', 'singh', 'amans@aman.com', 123, 'singh', '06d16f811da8c51fab7f37297c7ef9cef1d7bba556eb1f59543cfbe86721544e'),
(3, 'aman', 'aman', 'man@aman.ie', 211, 'aman', '180d803a580fabe1a24ddfdf6bf51ecbea0eb81f256b69ee6b39b33d294f6ebf'),
(4, 'aman', 'aman', 'aman@gmail.com', 111, 'aman', '180d803a580fabe1a24ddfdf6bf51ecbea0eb81f256b69ee6b39b33d294f6ebf'),
(5, 'john', 'doc', 'john@gmail.com', 19, 'doc', '96d9632f363564cc3032521409cf22a852f2032eec099ed5967c0d000cec607a'),
(6, 'pam', 'sab', 'pam@google.com', 18, 'sab', 'ee96e48ac867ab59efb688ad1eaef6ef54d06bc565785570164bd9bbb03d67e3'),
(7, 'John', 'Doe', 'JohnDoe@gmail.com', 12, 'Doe', '96d9632f363564cc3032521409cf22a852f2032eec099ed5967c0d000cec607a'),
(8, 'Arsh', 'Singh', 'arsh@gmail.com', 1, 'Singh', '24e2ba9fccb97e772be6578c125785b09bc22f18b75abb593335cf1607869cc2'),
(9, 'a', 'a', 'a@a.com', 3, 'a', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb'),
(11, 'Oleg', 'Petcov', 'oleg@oleg.com', 8, 'Petcov', 'bb2feed5f90a3d02a7c70df4835f9ff0130a861b7263e9bb2cd12df78e7ed9bc'),
(12, 'Jack', 'Boyce', 'jack@gmail.com', 69, 'Boyce', '31611159e7e6ff7843ea4627745e89225fc866621cfcfdbd40871af4413747cc'),
(13, 'I', 'Phone', 'iphone@apple.com', 123, 'Phone', '241c1e30ed886aa4a8f4248024be2ca1a221fe9773b52e2dca7891ff5771f399'),
(14, 'Aman', 'singh', 'aman@dit.com', 123, 'Singh', '180d803a580fabe1a24ddfdf6bf51ecbea0eb81f256b69ee6b39b33d294f6ebf'),
(15, 'test', 'test', 'test@test.com', 1, 'test', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3');

-- --------------------------------------------------------

--
-- Table structure for table `Quiz`
--

CREATE TABLE `Quiz` (
  `quiz_id` int(11) NOT NULL,
  `teacher_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quizDateTime` datetime NOT NULL,
  `ques1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ques2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ques3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ques4` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ques5` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ans1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ans2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ans3` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ans4` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ans5` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Quiz`
--

INSERT INTO `Quiz` (`quiz_id`, `teacher_email`, `quizDateTime`, `ques1`, `ques2`, `ques3`, `ques4`, `ques5`, `ans1`, `ans2`, `ans3`, `ans4`, `ans5`) VALUES
(31, 'test@test.com', '2018-03-17 00:00:00', '1 Plus 1', '1 Plus 1', '1 + 1', '1 Plus 1', '1 + 1', '2', '2', '2', '2', '2'),
(32, 'test@test.com', '2018-03-19 00:00:00', '1 Subtract 1', '1 take away 1', '1 Subtract 1', '1 Subtract 1', '1 Minus 1', '0', '0', '0', '0', '0'),
(33, 'test@test.com', '2018-03-18 00:00:00', '1 - 1', '1 Minus 1', '1 Subtract 1', '1 Minus 1', '1 - 1', '0', '0', '0', '0', '0'),
(34, 'test@test.com', '2018-03-20 00:00:00', '1 Multiply 1', '1 x 1', '1 times 1', '1 times 1', '1 x 1', '1', '1', '1', '1', '1'),
(35, 'test@test.com', '2018-03-21 00:00:00', '1 x 1', '1 Multiply 1', '1 times 1', '1 x 1', '1 Multiply 1', '1', '1', '1', '1', '1'),
(36, 'test@test.com', '2018-03-29 00:00:00', '1 From 1', '1 ÷ 1', '1 Divided by 1', '1 Divide 1', '1 ÷ 1', '1', '1', '1', '1', '1'),
(37, 'test@test.com', '2018-03-28 00:00:00', '4 x 4', '3 x 2', '1 times 3', '1 times 1', '4 times 2', '16', '6', '3', '1', '8'),
(38, 'aman@dit.ie', '2018-04-08 00:00:00', '6 Multiply 8', '8 x 8', '6 x 8', '2 x 1', '9 x 7', '48', '64', '48', '2', '63'),
(39, 'aman@dit.ie', '2018-04-10 00:00:00', '1 + 1', '2 Add 1', '1 Add 1', '1 Plus 2', '1 Plus 1', '2', '3', '2', '3', '2'),
(40, 'aman@dit.ie', '2018-04-11 00:00:00', '5 Plus 8', '5 + 2', '1 + 8', '6 Plus 2', '6 + 2', '13', '7', '9', '8', '8'),
(41, 'aman@dit.ie', '2018-04-12 00:00:00', '5 Multiply 5', '10 x 6', '4 Times 9', '9 x 9', '9 Times 7', '25', '60', '36', '81', '63');

-- --------------------------------------------------------

--
-- Table structure for table `QuizScore`
--

CREATE TABLE `QuizScore` (
  `score_id` int(11) NOT NULL,
  `student_username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `ques1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ques2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ques3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ques4` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ques5` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ans1` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ans2` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ans3` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ans4` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ans5` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `obtainedMarks` int(11) NOT NULL,
  `totalMarks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `QuizScore`
--

INSERT INTO `QuizScore` (`score_id`, `student_username`, `quiz_id`, `ques1`, `ques2`, `ques3`, `ques4`, `ques5`, `ans1`, `ans2`, `ans3`, `ans4`, `ans5`, `obtainedMarks`, `totalMarks`) VALUES
(3, 'aman', 34, '1 Multiply 1', '1 x 1', '1 times 1', '1 times 1', '1 x 1', '1', '1', '2', '1', '1', 4, 5),
(4, 'aman', 35, '1 x 1', '1 Multiply 1', '1 times 1', '1 x 1', '1 Multiply 1', '2', '00', '0', '0', '0', 0, 5),
(12, 'aman', 37, '4 x 4', '3 x 2', '1 times 3', '1 times 1', '4 times 2', '16', '6', '3', '1', '1', 4, 5),
(13, 'aman', 38, '6 Multiply 8', '8 x 8', '6 x 8', '2 x 1', '9 x 7', '2', '3', '4', '4', '4', 0, 5),
(14, 'aman', 39, '1 + 1', '2 Add 1', '1 Add 1', '1 Plus 2', '1 Plus 1', '2', '3', '2', '3', '2', 5, 5),
(15, 'aman', 41, '5 Multiply 5', '10 x 6', '4 Times 9', '9 x 9', '9 Times 7', '25', '60', '36', '81', '63', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `studentID` int(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `studentFName` varchar(50) NOT NULL,
  `studentSName` varchar(50) NOT NULL,
  `studentPassword` varchar(400) NOT NULL,
  `teacherEmail` varchar(100) NOT NULL,
  `correctAnswers` int(11) NOT NULL DEFAULT '0',
  `totalAnswered` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`studentID`, `username`, `studentFName`, `studentSName`, `studentPassword`, `teacherEmail`, `correctAnswers`, `totalAnswered`) VALUES
(1, 'aman', 'aman', 'singh', '180d803a580fabe1a24ddfdf6bf51ecbea0eb81f256b69ee6b39b33d294f6ebf', 'aman@dit.ie', 20, 30),
(2, 'arsh', 'arsh', 'singh', '24e2ba9fccb97e772be6578c125785b09bc22f18b75abb593335cf1607869cc2', 'aman@dit.ie', 0, 0),
(3, 'anisha', 'anisha', 'singh', '40fc3451e882282df7cc37fdc6d3fd9b4a1d3673c1a05c0350ed4ce31a3ce49b', 'aman@dit.ie', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Teacher`
--

CREATE TABLE `Teacher` (
  `teacherID` int(11) NOT NULL,
  `teacherFName` varchar(50) NOT NULL,
  `teacherSName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `school` varchar(100) NOT NULL,
  `teacherPassword` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Teacher`
--

INSERT INTO `Teacher` (`teacherID`, `teacherFName`, `teacherSName`, `email`, `school`, `teacherPassword`) VALUES
(1, 'aman', 'aman', 'aman@aman.com', 'dit', '180d803a580fabe1a24ddfdf6bf51ecbea0eb81f256b69ee6b39b33d294f6ebf'),
(2, 'oleg', 'petcov', 'oleg@gmail.com', 'dit', 'bb2feed5f90a3d02a7c70df4835f9ff0130a861b7263e9bb2cd12df78e7ed9bc'),
(3, 'Aman', 'Singh', 'aman@gmail.com', 'dit', '180d803a580fabe1a24ddfdf6bf51ecbea0eb81f256b69ee6b39b33d294f6ebf'),
(4, 'aman', 'singh', 'aman@dit.ie', 'dit', '180d803a580fabe1a24ddfdf6bf51ecbea0eb81f256b69ee6b39b33d294f6ebf'),
(5, 'i', 'phone', 'iphone@apple.com', 'JSS', '241c1e30ed886aa4a8f4248024be2ca1a221fe9773b52e2dca7891ff5771f399'),
(6, 'test', 'sir', 'test@test.com', 'test highschool', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3');

-- --------------------------------------------------------

--
-- Table structure for table `Video`
--

CREATE TABLE `Video` (
  `video_id` int(11) NOT NULL,
  `heading` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `teacherEmail` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Video`
--

INSERT INTO `Video` (`video_id`, `heading`, `link`, `teacherEmail`) VALUES
(2, 'Addition', 'https://www.youtube.com/embed/AQ7THUKx6Es', 'test@test.com'),
(16, 'Addition', 'https://www.youtube.com/embed/Fe8u2I3vmHU', 'aman@dit.ie'),
(17, 'Subtraction', 'https://www.youtube.com/embed/depLStKzbIE', 'aman@dit.ie'),
(19, 'Multiplication', 'https://www.youtube.com/embed/BZ41Fh2MEVw', 'aman@dit.ie');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Parent`
--
ALTER TABLE `Parent`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `Quiz`
--
ALTER TABLE `Quiz`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `QuizScore`
--
ALTER TABLE `QuizScore`
  ADD PRIMARY KEY (`score_id`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `Teacher`
--
ALTER TABLE `Teacher`
  ADD PRIMARY KEY (`teacherID`);

--
-- Indexes for table `Video`
--
ALTER TABLE `Video`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `fk_teacher` (`teacherEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Parent`
--
ALTER TABLE `Parent`
  MODIFY `parent_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `Quiz`
--
ALTER TABLE `Quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `QuizScore`
--
ALTER TABLE `QuizScore`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `Student`
--
ALTER TABLE `Student`
  MODIFY `studentID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Teacher`
--
ALTER TABLE `Teacher`
  MODIFY `teacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Video`
--
ALTER TABLE `Video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
