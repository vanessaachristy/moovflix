-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2023 at 05:04 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moovlix`
--

-- --------------------------------------------------------

--
-- Table structure for table `Booking`
--

CREATE TABLE `Booking` (
  `id` int(11) NOT NULL,
  `showID` varchar(500) DEFAULT NULL,
  `seatID` varchar(50) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `completed` tinyint(1) DEFAULT NULL,
  `referenceID` char(24) DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `movie_name` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `banner` varchar(250) DEFAULT NULL,
  `synopsis` varchar(500) NOT NULL,
  `cast` varchar(500) NOT NULL,
  `director` varchar(50) NOT NULL,
  `languages` varchar(50) NOT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `rating` varchar(50) DEFAULT NULL,
  `poster` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `movie_name`, `genre`, `banner`, `synopsis`, `cast`, `director`, `languages`, `duration`, `rating`, `poster`) VALUES
(1, 'Avatar: The Way of Water', 'ADVENTURE', NULL, 'Set more than a decade after the events of the first film, \"Avatar: The Way of Water\" begins to tell the story of the Sully family (Jake, Neytiri, and their kids), the trouble that follows them, the lengths they go to keep each other safe, the battles they fight to stay alive, and the tragedies they endure.', 'Zoe Saldana, Sam Worthington, Sigourney Weaver, Michelle Rodriguez', 'James Cameron', 'ENGLISH', '3H 12Min', 'PG13', 'img/avatar.png'),
(2, 'Taylor Swift Eras Tour', 'CONCERT', NULL, 'The cultural phenomenon continues on the big screen! Immerse yourself in this once-in-a-lifetime concert film experience with a breathtaking, cinematic view of the history-making tour. Taylor Swift Eras Tour attire and friendship bracelets are strongly encouraged!', 'Taylor Swift', 'Sam Wrench', 'ENGLISH', '2H 48Min', 'TBA', 'img/taylorswift.png'),
(3, 'A Haunting In Venice', 'MYSTERY', NULL, 'Belgian sleuth Hercule Poirot investigates a murder while attending a Halloween seance at a haunted palazzo in Venice, Italy.', 'Tina Fey, Jamie Dornan, Michelle Yeoh, Kenneth Branagh', 'Kenneth Branagh', 'ENGLISH', '1H 43Min', 'PG13', 'img/hauntingvenice.png'),
(4, 'John Wick 4', 'ACTION', NULL, 'John Wick uncovers a path to defeating The High Table. But before he can earn his freedom, Wick must face off against a new enemy with powerful alliances across the globe and forces that turn old friends into foes.', 'Keanu Reeves, Donnie Yen, Bill Skarsgard, Laurence Fishburne', 'Chad Stahelski', 'ENGLISH', '2H 30Min', 'PG1.9', 'img/johnwick4.png');

-- --------------------------------------------------------

--
-- Table structure for table `screen`
--

CREATE TABLE `screen` (
  `id` int(11) NOT NULL,
  `cinema_name` varchar(50) DEFAULT NULL,
  `cinema_location` varchar(250) DEFAULT NULL,
  `images` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Seating`
--

CREATE TABLE `Seating` (
  `ID` varchar(50) NOT NULL,
  `screenID` varchar(500) DEFAULT NULL,
  `rowNumber` varchar(50) DEFAULT NULL,
  `seatIdx` int(11) NOT NULL,
  `seatNumber` varchar(50) DEFAULT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `bookingID` varchar(50) DEFAULT NULL,
  `price` float NOT NULL DEFAULT 12.5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Seating`
--

INSERT INTO `Seating` (`ID`, `screenID`, `rowNumber`, `seatIdx`, `seatNumber`, `available`, `bookingID`, `price`) VALUES
('A1', 'screen1', 'A', 1, 'A1', 1, NULL, 12.5),
('A10', 'screen1', 'A', 10, 'A10', 1, NULL, 12.5),
('A11', 'screen1', 'A', 11, 'A11', 1, NULL, 12.5),
('A12', 'screen1', 'A', 12, 'A12', 1, NULL, 12.5),
('A13', 'screen1', 'A', 13, 'A13', 1, NULL, 12.5),
('A14', 'screen1', 'A', 14, 'A14', 1, NULL, 12.5),
('A15', 'screen1', 'A', 15, 'A15', 1, NULL, 12.5),
('A16', 'screen1', 'A', 16, 'A16', 1, NULL, 12.5),
('A17', 'screen1', 'A', 17, 'A17', 1, NULL, 12.5),
('A18', 'screen1', 'A', 18, 'A18', 1, NULL, 12.5),
('A19', 'screen1', 'A', 19, 'A19', 1, NULL, 12.5),
('A2', 'screen1', 'A', 2, 'A2', 1, NULL, 12.5),
('A20', 'screen1', 'A', 20, 'A20', 1, NULL, 12.5),
('A3', 'screen1', 'A', 3, 'A3', 1, NULL, 12.5),
('A4', 'screen1', 'A', 4, 'A4', 1, NULL, 12.5),
('A5', 'screen1', 'A', 5, 'A5', 1, NULL, 12.5),
('A6', 'screen1', 'A', 6, 'A6', 1, NULL, 12.5),
('A7', 'screen1', 'A', 7, 'A7', 1, NULL, 12.5),
('A8', 'screen1', 'A', 8, 'A8', 1, NULL, 12.5),
('A9', 'screen1', 'A', 9, 'A9', 1, NULL, 12.5),
('B1', 'screen1', 'B', 1, 'B1', 1, NULL, 12.5),
('B10', 'screen1', 'B', 10, 'B10', 1, NULL, 12.5),
('B11', 'screen1', 'B', 11, 'B11', 1, NULL, 12.5),
('B12', 'screen1', 'B', 12, 'B12', 1, NULL, 12.5),
('B13', 'screen1', 'B', 13, 'B13', 1, NULL, 12.5),
('B14', 'screen1', 'B', 14, 'B14', 1, NULL, 12.5),
('B15', 'screen1', 'B', 15, 'B15', 1, NULL, 12.5),
('B16', 'screen1', 'B', 16, 'B16', 1, NULL, 12.5),
('B17', 'screen1', 'B', 17, 'B17', 1, NULL, 12.5),
('B18', 'screen1', 'B', 18, 'B18', 1, NULL, 12.5),
('B19', 'screen1', 'B', 19, 'B19', 1, NULL, 12.5),
('B2', 'screen1', 'B', 2, 'B2', 1, NULL, 12.5),
('B20', 'screen1', 'B', 20, 'B20', 1, NULL, 12.5),
('B3', 'screen1', 'B', 3, 'B3', 1, NULL, 12.5),
('B4', 'screen1', 'B', 4, 'B4', 1, NULL, 12.5),
('B5', 'screen1', 'B', 5, 'B5', 1, NULL, 12.5),
('B6', 'screen1', 'B', 6, 'B6', 1, NULL, 12.5),
('B7', 'screen1', 'B', 7, 'B7', 1, NULL, 12.5),
('B8', 'screen1', 'B', 8, 'B8', 1, NULL, 12.5),
('B9', 'screen1', 'B', 9, 'B9', 1, NULL, 12.5),
('C1', 'screen1', 'C', 1, 'C1', 1, NULL, 12.5),
('C10', 'screen1', 'C', 10, 'C10', 1, NULL, 12.5),
('C11', 'screen1', 'C', 11, 'C11', 1, NULL, 12.5),
('C12', 'screen1', 'C', 12, 'C12', 1, NULL, 12.5),
('C13', 'screen1', 'C', 13, 'C13', 1, NULL, 12.5),
('C14', 'screen1', 'C', 14, 'C14', 1, NULL, 12.5),
('C15', 'screen1', 'C', 15, 'C15', 1, NULL, 12.5),
('C16', 'screen1', 'C', 16, 'C16', 1, NULL, 12.5),
('C17', 'screen1', 'C', 17, 'C17', 1, NULL, 12.5),
('C18', 'screen1', 'C', 18, 'C18', 1, NULL, 12.5),
('C19', 'screen1', 'C', 19, 'C19', 1, NULL, 12.5),
('C2', 'screen1', 'C', 2, 'C2', 1, NULL, 12.5),
('C20', 'screen1', 'C', 20, 'C20', 1, NULL, 12.5),
('C3', 'screen1', 'C', 3, 'C3', 1, NULL, 12.5),
('C4', 'screen1', 'C', 4, 'C4', 1, NULL, 12.5),
('C5', 'screen1', 'C', 5, 'C5', 1, NULL, 12.5),
('C6', 'screen1', 'C', 6, 'C6', 1, NULL, 12.5),
('C7', 'screen1', 'C', 7, 'C7', 1, NULL, 12.5),
('C8', 'screen1', 'C', 8, 'C8', 1, NULL, 12.5),
('C9', 'screen1', 'C', 9, 'C9', 1, NULL, 12.5),
('D1', 'screen1', 'D', 1, 'D1', 1, NULL, 12.5),
('D10', 'screen1', 'D', 10, 'D10', 1, NULL, 12.5),
('D11', 'screen1', 'D', 11, 'D11', 1, NULL, 12.5),
('D12', 'screen1', 'D', 12, 'D12', 1, NULL, 12.5),
('D13', 'screen1', 'D', 13, 'D13', 1, NULL, 12.5),
('D14', 'screen1', 'D', 14, 'D14', 1, NULL, 12.5),
('D15', 'screen1', 'D', 15, 'D15', 1, NULL, 12.5),
('D16', 'screen1', 'D', 16, 'D16', 1, NULL, 12.5),
('D17', 'screen1', 'D', 17, 'D17', 1, NULL, 12.5),
('D18', 'screen1', 'D', 18, 'D18', 1, NULL, 12.5),
('D19', 'screen1', 'D', 19, 'D19', 1, NULL, 12.5),
('D2', 'screen1', 'D', 2, 'D2', 1, NULL, 12.5),
('D20', 'screen1', 'D', 20, 'D20', 1, NULL, 12.5),
('D3', 'screen1', 'D', 3, 'D3', 1, NULL, 12.5),
('D4', 'screen1', 'D', 4, 'D4', 1, NULL, 12.5),
('D5', 'screen1', 'D', 5, 'D5', 1, NULL, 12.5),
('D6', 'screen1', 'D', 6, 'D6', 1, NULL, 12.5),
('D7', 'screen1', 'D', 7, 'D7', 1, NULL, 12.5),
('D8', 'screen1', 'D', 8, 'D8', 1, NULL, 12.5),
('D9', 'screen1', 'D', 9, 'D9', 1, NULL, 12.5),
('E1', 'screen1', 'E', 1, 'E1', 1, NULL, 12.5),
('E10', 'screen1', 'E', 10, 'E10', 1, NULL, 12.5),
('E11', 'screen1', 'E', 11, 'E11', 1, NULL, 12.5),
('E12', 'screen1', 'E', 12, 'E12', 1, NULL, 12.5),
('E13', 'screen1', 'E', 13, 'E13', 1, NULL, 12.5),
('E14', 'screen1', 'E', 14, 'E14', 1, NULL, 12.5),
('E15', 'screen1', 'E', 15, 'E15', 1, NULL, 12.5),
('E16', 'screen1', 'E', 16, 'E16', 1, NULL, 12.5),
('E17', 'screen1', 'E', 17, 'E17', 1, NULL, 12.5),
('E18', 'screen1', 'E', 18, 'E18', 1, NULL, 12.5),
('E19', 'screen1', 'E', 19, 'E19', 1, NULL, 12.5),
('E2', 'screen1', 'E', 2, 'E2', 1, NULL, 12.5),
('E20', 'screen1', 'E', 20, 'E20', 1, NULL, 12.5),
('E3', 'screen1', 'E', 3, 'E3', 1, NULL, 12.5),
('E4', 'screen1', 'E', 4, 'E4', 1, NULL, 12.5),
('E5', 'screen1', 'E', 5, 'E5', 1, NULL, 12.5),
('E6', 'screen1', 'E', 6, 'E6', 1, NULL, 12.5),
('E7', 'screen1', 'E', 7, 'E7', 1, NULL, 12.5),
('E8', 'screen1', 'E', 8, 'E8', 1, NULL, 12.5),
('E9', 'screen1', 'E', 9, 'E9', 1, NULL, 12.5);

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `id` int(11) NOT NULL,
  `dates` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `movieID` int(11) DEFAULT NULL,
  `screenID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Booking`
--
ALTER TABLE `Booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `screen`
--
ALTER TABLE `screen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Seating`
--
ALTER TABLE `Seating`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movieID` (`movieID`),
  ADD KEY `screenID` (`screenID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Booking`
--
ALTER TABLE `Booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shows`
--
ALTER TABLE `shows`
  ADD CONSTRAINT `shows_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `shows_ibfk_2` FOREIGN KEY (`screenID`) REFERENCES `screen` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
