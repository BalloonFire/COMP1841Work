-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 12:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentforum`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `AContent` text NOT NULL,
  `UserID` int(11) NOT NULL,
  `QuestionID` int(11) NOT NULL,
  `ADate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `AContent`, `UserID`, `QuestionID`, `ADate`) VALUES
(1, 'You need to do research yourself to achieve greatness.', 3, 1, '2022-01-02 11:47:15'),
(2, 'Apple is good. Might be 1890. Idk', 1, 3, '2023-10-29 17:48:07'),
(3, 'Its 2.', 3, 2, '2023-10-29 17:48:54'),
(4, 'Calculate height and base. Is it right triangle or normal triangle?', 2, 4, '2023-04-29 17:52:11'),
(5, 'haha', 2, 1, '2023-11-06 23:54:09'),
(6, '2', 1, 1, '2023-11-18 09:48:21'),
(7, 'aaaaaa', 7, 1, '2023-11-19 18:43:29'),
(9, 'aadad', 5, 1, '2023-11-19 18:45:19'),
(13, 'ad', 8, 1, '2023-11-25 13:28:30'),
(14, '2. Duh. Dum.', 8, 2, '2023-11-25 13:30:23'),
(26, 'Qaaa', 8, 2, '2023-11-25 14:16:36'),
(27, 'That\'s the neat part. You don\'t.', 8, 4, '2023-11-25 14:17:55'),
(29, 'Two Phones, Two Ears! Perfect!', 8, 29, '2023-11-25 19:51:54'),
(33, 'Bee Movie:\r\nAccording to all known laws of aviation, there is no way a bee should be able to fly. It\'s wings are too small to get its fat little body off the ground. The bee, of course, flies anyway, because bees don\'t care what humans think is impossible.', 8, 28, '2023-11-26 14:12:44'),
(36, 'Thanks!', 1, 39, '2023-11-26 15:07:06'),
(50, 'Just Chillin!', 8, 39, '2023-11-27 01:41:02'),
(52, 'One fell off and spill their drink', 3, 65, '2023-11-28 10:44:10'),
(53, 'Give me an apple ringo apfel pomo', 12, 71, '2024-04-24 03:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `ModuleName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `ModuleName`) VALUES
(1, 'IT'),
(2, 'Math'),
(3, 'History'),
(4, 'Science'),
(13, 'Music'),
(14, 'Physics');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `QTitle` varchar(255) NOT NULL,
  `QContent` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  `ModuleID` int(11) NOT NULL,
  `QDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `QTitle`, `QContent`, `image`, `UserID`, `ModuleID`, `QDate`) VALUES
(1, 'Question on the module', 'How can i GET success for this module? For research.', NULL, 1, 1, '2022-01-01 12:50:23'),
(2, 'Question on the math', 'What is 1+1?', NULL, 2, 2, '2023-10-26 23:39:40'),
(3, 'Help me with this history question', 'When was apple born?edit', 'uploads/662809121aa7b.png', 2, 3, '2023-10-26 23:56:36'),
(4, 'Need help with math', 'How can i calculate triangle?', NULL, 3, 2, '2023-04-12 23:57:54'),
(26, 'Test', 'TEST', 'uploads/Aaaaa.png', 8, 2, '2023-11-25 17:34:29'),
(28, 'Bee', 'Bee', 'uploads/beemei.png', 8, 3, '2023-11-25 17:56:09'),
(29, 'Phone', 'Can\'t have too much phone! Can\'t I? What is one phone plus one phone equals?', 'uploads/vlcsnap-2023-11-25-18h31m11s813.png', 8, 2, '2023-11-25 18:32:06'),
(30, 'admintesting', 'administired', 'uploads/vlcsnap-2023-11-25-23h02m26s736.png', 8, 1, '2023-11-26 07:48:08'),
(39, 'Done. At last!', 'Thanks for checking by!', '', 1, 2, '2023-11-26 15:06:47'),
(64, 'Nylonz', 'How much do two miyl costs?', '../uploads/656561337fc5e.png', 8, 2, '2023-11-28 10:40:35'),
(65, 'Mywo', 'Three mily jumping on the cup. Finish it!', '../uploads/6565615a229cb.png', 8, 13, '2023-11-28 10:41:14'),
(71, 'Physics Apple', 'Apple arcade. ', 'uploads/6627fce6bcedc.png', 12, 14, '2024-04-24 01:24:38'),
(72, 'Physics Test', 'How to make physics work. I dont know how to sling this red bird', 'uploads/6627fd1497711.png', 12, 14, '2024-04-24 01:25:24'),
(73, 'testingEDIT', 'test test testEDIT', 'uploads/662821075e75c.png', 12, 2, '2024-04-24 01:26:00'),
(75, 'test final', 'I do test more this time.', 'uploads/6627fda366db1.png', 3, 14, '2024-04-24 01:27:47'),
(76, 'last question. how to beat this question.', 'Test is hard', 'uploads/6627fe0cf2085.png', 2, 2, '2024-04-24 01:29:32');

-- --------------------------------------------------------

--
-- Table structure for table `usermessages`
--

CREATE TABLE `usermessages` (
  `MessageID` int(11) NOT NULL,
  `MContent` text NOT NULL,
  `UserID` int(11) NOT NULL,
  `MDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usermessages`
--

INSERT INTO `usermessages` (`MessageID`, `MContent`, `UserID`, `MDate`) VALUES
(1, 'Will it get updated?', 2, '2022-11-29 17:38:39'),
(2, 'Can you tell me how to use this forum?', 1, '2023-06-29 18:39:11'),
(3, 'This forum helps alot. Thank you!', 3, '2023-10-29 21:00:44'),
(4, 'Good Job!', 8, '2023-11-25 18:45:40'),
(5, 'It all worked out! Thank you!', 3, '2023-11-26 09:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `admin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Username`, `Email`, `Password`, `admin`) VALUES
(1, 'Student A', 'A@mail.com', '11770b3ea657fe68cba19675143e4715c8de9d763d3c21a85af6b7513d43997d', 'N'),
(2, 'Student B', 'B@mail.com', 'e70573603f1535501b9e485f4323c06a8ed9ae72150088ed908d040fa7dce9b1', 'N'),
(3, 'Student C', 'C@mail.com', '00a86c0bf4f383efe3888760f51e9aa20a4b188eaf8cf2a57559e5385cd6074e', 'N'),
(4, 'AAA', 'BBB@gmail.com', '8c55ff95a660f37cb05e644e7691e6c66593f453cb2cbaa4d64aa59b40ae8032', 'N'),
(5, 'Cx', 'bn@gre.ac.uk', '6f67d899399ed4fc17dfac7e9ecd114b4ec88b0c8b3128bd8608aa6aaa7d3d6f', 'N'),
(7, 'Test', 'Test@test', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'Y'),
(8, 'admin', 'admin@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'Y'),
(10, 'Newbie', 'N@N.com', '18fdd549b2ed367ac0c74cbec1214644728515b30edbcb78e7d322757a7c8359', 'N'),
(12, 'New User', 'Check@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_ibfk_2` (`QuestionID`),
  ADD KEY `answers_ibfk_1` (`UserID`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_ibfk_1` (`UserID`),
  ADD KEY `questions_ibfk_2` (`ModuleID`);

--
-- Indexes for table `usermessages`
--
ALTER TABLE `usermessages`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `usermessages_ibfk_1` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `usermessages`
--
ALTER TABLE `usermessages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`QuestionID`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`ModuleID`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `usermessages`
--
ALTER TABLE `usermessages`
  ADD CONSTRAINT `usermessages_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
