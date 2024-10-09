-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2023 at 01:14 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diary`
--

-- --------------------------------------------------------

--
-- Table structure for table `diary_write`
--

CREATE TABLE `diary_write` (
  `diaryID` int NOT NULL,
  `userID` int NOT NULL,
  `date_write` date NOT NULL,
  `income` int NOT NULL,
  `fee` int NOT NULL,
  `data_write` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `feeling` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `diary_write`
--

INSERT INTO `diary_write` (`diaryID`, `userID`, `date_write`, `income`, `fee`, `data_write`, `pic`, `feeling`) VALUES
(28, 1, '2023-03-14', 500, 500, 'วันนี่แม่งโคตรเหี้ยเลยหวะ กูอยากต่อยครูชิบหายยยยยยยยย', 'NEW2023M03D14.png', 25),
(29, 1, '2023-03-14', 200, 200, 'ฟหกฟหกกหหฟกหฟกหฟ', 'NEW2023M03D14.png', 100),
(36, 14, '2023-03-14', 50, 10, 'asdasd', '2023M03D14.png', 100),
(37, 20, '2023-03-15', 223, 600, 'good errr', 'NEW2023M03D15.png', 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fName` varchar(100) NOT NULL,
  `lName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `fName`, `lName`) VALUES
(1, 'champ', '191', 'Wutthichai', 'Srisan'),
(14, 'nuy', '123', 'nuy', 'kuythai'),
(20, 'champxy', '123', 'champ', 'cash');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diary_write`
--
ALTER TABLE `diary_write`
  ADD PRIMARY KEY (`diaryID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diary_write`
--
ALTER TABLE `diary_write`
  MODIFY `diaryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
