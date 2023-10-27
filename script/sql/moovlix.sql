-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2023 at 03:43 PM
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
(1, 'Avatar: The Way of Water', 'ADVENTURE', 'img/avatar.png', 'Set more than a decade after the events of the first film, \"Avatar: The Way of Water\" begins to tell the story of the Sully family (Jake, Neytiri, and their kids), the trouble that follows them, the lengths they go to keep each other safe, the battles they fight to stay alive, and the tragedies they endure.', 'Zoe Saldana, Sam Worthington, Sigourney Weaver, Michelle Rodriguez', 'James Cameron', 'ENGLISH', '3H 12Min', 'PG13', 'img/avatar-poster.png'),
(2, 'Taylor Swift Eras Tour', 'CONCERT', 'img/taylorswift.png', 'The cultural phenomenon continues on the big screen! Immerse yourself in this once-in-a-lifetime concert film experience with a breathtaking, cinematic view of the history-making tour. Taylor Swift Eras Tour attire and friendship bracelets are strongly encouraged!', 'Taylor Swift', 'Sam Wrench', 'ENGLISH', '2H 48Min', 'TBA', 'img/taylorswift-poster.png'),
(3, 'A Haunting In Venice', 'MYSTERY', 'img/hauntingvenice.png', 'Belgian sleuth Hercule Poirot investigates a murder while attending a Halloween seance at a haunted palazzo in Venice, Italy.', 'Tina Fey, Jamie Dornan, Michelle Yeoh, Kenneth Branagh', 'Kenneth Branagh', 'ENGLISH', '1H 43Min', 'PG13', 'img/hauntingvenice-poster.png'),
(4, 'John Wick 4', 'ACTION', 'img/johnwick4.png', 'John Wick uncovers a path to defeating The High Table. But before he can earn his freedom, Wick must face off against a new enemy with powerful alliances across the globe and forces that turn old friends into foes.', 'Keanu Reeves, Donnie Yen, Bill Skarsgard, Laurence Fishburne', 'Chad Stahelski', 'ENGLISH', '2H 30Min', 'PG1.9', 'img/johnwick-poster.png');

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

--
-- Dumping data for table `screen`
--

INSERT INTO `screen` (`id`, `cinema_name`, `cinema_location`, `images`) VALUES
(1, 'MOOVLIX ION ORCHARD', '2 Orchard Turn, Singapore 238801', 'img/orchard.jpg'),
(2, 'MOOVLIX MARINA BAY SANDS', '10 Bayfront Ave, Singapore 018956', 'img/marina.png'),
(3, 'MOOVLIX NANYANG', '50 Nanyang Ave, Singapore 639798', 'img/ntu.png'),
(4, 'MOOVLIX JURONG EAST', '50 Jurong Gateway Rd, Singapore 608549', 'img/jem.png');

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
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`id`, `dates`, `movieID`, `screenID`) VALUES
(1, '2023-11-24 02:00:00', 1, 1),
(2, '2023-11-24 08:30:00', 1, 1),
(3, '2023-11-24 12:00:00', 1, 1),
(4, '2023-11-25 02:00:00', 1, 1),
(5, '2023-11-25 08:30:00', 1, 1),
(6, '2023-11-25 12:00:00', 1, 1),
(7, '2023-11-26 02:00:00', 1, 1),
(8, '2023-11-26 08:30:00', 1, 1),
(9, '2023-11-26 12:00:00', 1, 1),
(10, '2023-11-27 02:00:00', 1, 1),
(11, '2023-11-27 08:30:00', 1, 1),
(12, '2023-11-27 12:00:00', 1, 1),
(13, '2023-11-28 02:00:00', 1, 1),
(14, '2023-11-28 09:00:00', 1, 1),
(15, '2023-11-28 13:00:00', 1, 1),
(16, '2023-11-29 08:30:00', 1, 1),
(17, '2023-11-29 12:00:00', 1, 1),
(18, '2023-11-29 15:00:00', 1, 1),
(19, '2023-11-30 08:30:00', 1, 1),
(20, '2023-11-30 12:00:00', 1, 1),
(21, '2023-11-30 15:00:00', 1, 1),
(22, '2023-11-24 02:00:00', 1, 2),
(23, '2023-11-24 08:30:00', 1, 2),
(24, '2023-11-24 12:00:00', 1, 2),
(25, '2023-11-25 02:00:00', 1, 2),
(26, '2023-11-25 08:30:00', 1, 2),
(27, '2023-11-25 12:00:00', 1, 2),
(28, '2023-11-26 02:00:00', 1, 2),
(29, '2023-11-26 08:30:00', 1, 2),
(30, '2023-11-26 12:00:00', 1, 2),
(31, '2023-11-27 02:00:00', 1, 2),
(32, '2023-11-27 08:30:00', 1, 2),
(33, '2023-11-27 12:00:00', 1, 2),
(34, '2023-11-28 02:00:00', 1, 2),
(35, '2023-11-28 09:00:00', 1, 2),
(36, '2023-11-28 13:00:00', 1, 2),
(37, '2023-11-29 08:30:00', 1, 2),
(38, '2023-11-29 12:00:00', 1, 2),
(39, '2023-11-29 15:00:00', 1, 2),
(40, '2023-11-30 08:30:00', 1, 2),
(41, '2023-11-30 12:00:00', 1, 2),
(42, '2023-11-30 15:00:00', 1, 2),
(43, '2023-11-24 02:00:00', 1, 3),
(44, '2023-11-24 08:30:00', 1, 3),
(45, '2023-11-24 12:00:00', 1, 3),
(46, '2023-11-25 02:00:00', 1, 3),
(47, '2023-11-25 08:30:00', 1, 3),
(48, '2023-11-25 12:00:00', 1, 3),
(49, '2023-11-26 02:00:00', 1, 3),
(50, '2023-11-26 08:30:00', 1, 3),
(51, '2023-11-26 12:00:00', 1, 3),
(52, '2023-11-27 02:00:00', 1, 3),
(53, '2023-11-27 08:30:00', 1, 3),
(54, '2023-11-27 12:00:00', 1, 3),
(55, '2023-11-28 02:00:00', 1, 3),
(56, '2023-11-28 09:00:00', 1, 3),
(57, '2023-11-28 13:00:00', 1, 3),
(58, '2023-11-29 08:30:00', 1, 3),
(59, '2023-11-29 12:00:00', 1, 3),
(60, '2023-11-29 15:00:00', 1, 3),
(61, '2023-11-30 08:30:00', 1, 3),
(62, '2023-11-30 12:00:00', 1, 3),
(63, '2023-11-30 15:00:00', 1, 3),
(64, '2023-11-24 02:00:00', 1, 4),
(65, '2023-11-24 08:30:00', 1, 4),
(66, '2023-11-24 12:00:00', 1, 4),
(67, '2023-11-25 02:00:00', 1, 4),
(68, '2023-11-25 08:30:00', 1, 4),
(69, '2023-11-25 12:00:00', 1, 4),
(70, '2023-11-26 02:00:00', 1, 4),
(71, '2023-11-26 08:30:00', 1, 4),
(72, '2023-11-26 12:00:00', 1, 4),
(73, '2023-11-27 02:00:00', 1, 4),
(74, '2023-11-27 08:30:00', 1, 4),
(75, '2023-11-27 12:00:00', 1, 4),
(76, '2023-11-28 02:00:00', 1, 4),
(77, '2023-11-28 09:00:00', 1, 4),
(78, '2023-11-28 13:00:00', 1, 4),
(79, '2023-11-29 08:30:00', 1, 4),
(80, '2023-11-29 12:00:00', 1, 4),
(81, '2023-11-29 15:00:00', 1, 4),
(82, '2023-11-30 08:30:00', 1, 4),
(83, '2023-11-30 12:00:00', 1, 4),
(84, '2023-11-30 15:00:00', 1, 4),
(85, '2023-11-24 02:00:00', 2, 1),
(86, '2023-11-24 08:30:00', 2, 1),
(87, '2023-11-24 12:00:00', 2, 1),
(88, '2023-11-25 02:00:00', 2, 1),
(89, '2023-11-25 08:30:00', 2, 1),
(90, '2023-11-25 12:00:00', 2, 1),
(91, '2023-11-26 02:00:00', 2, 1),
(92, '2023-11-26 08:30:00', 2, 1),
(93, '2023-11-26 12:00:00', 2, 1),
(94, '2023-11-27 02:00:00', 2, 1),
(95, '2023-11-27 08:30:00', 2, 1),
(96, '2023-11-27 12:00:00', 2, 1),
(97, '2023-11-28 02:00:00', 2, 1),
(98, '2023-11-28 09:00:00', 2, 1),
(99, '2023-11-28 13:00:00', 2, 1),
(100, '2023-11-29 08:30:00', 2, 1),
(101, '2023-11-29 12:00:00', 2, 1),
(102, '2023-11-29 15:00:00', 2, 1),
(103, '2023-11-30 08:30:00', 2, 1),
(104, '2023-11-30 12:00:00', 2, 1),
(105, '2023-11-30 15:00:00', 2, 1),
(106, '2023-11-24 02:00:00', 2, 2),
(107, '2023-11-24 08:30:00', 2, 2),
(108, '2023-11-24 12:00:00', 2, 2),
(109, '2023-11-25 02:00:00', 2, 2),
(110, '2023-11-25 08:30:00', 2, 2),
(111, '2023-11-25 12:00:00', 2, 2),
(112, '2023-11-26 02:00:00', 2, 2),
(113, '2023-11-26 08:30:00', 2, 2),
(114, '2023-11-26 12:00:00', 2, 2),
(115, '2023-11-27 02:00:00', 2, 2),
(116, '2023-11-27 08:30:00', 2, 2),
(117, '2023-11-27 12:00:00', 2, 2),
(118, '2023-11-28 02:00:00', 2, 2),
(119, '2023-11-28 09:00:00', 2, 2),
(120, '2023-11-28 13:00:00', 2, 2),
(121, '2023-11-29 08:30:00', 2, 2),
(122, '2023-11-29 12:00:00', 2, 2),
(123, '2023-11-29 15:00:00', 2, 2),
(124, '2023-11-30 08:30:00', 2, 2),
(125, '2023-11-30 12:00:00', 2, 2),
(126, '2023-11-30 15:00:00', 2, 2),
(127, '2023-11-24 02:00:00', 2, 3),
(128, '2023-11-24 08:30:00', 2, 3),
(129, '2023-11-24 12:00:00', 2, 3),
(130, '2023-11-25 02:00:00', 2, 3),
(131, '2023-11-25 08:30:00', 2, 3),
(132, '2023-11-25 12:00:00', 2, 3),
(133, '2023-11-26 02:00:00', 2, 3),
(134, '2023-11-26 08:30:00', 2, 3),
(135, '2023-11-26 12:00:00', 2, 3),
(136, '2023-11-27 02:00:00', 2, 3),
(137, '2023-11-27 08:30:00', 2, 3),
(138, '2023-11-27 12:00:00', 2, 3),
(139, '2023-11-28 02:00:00', 2, 3),
(140, '2023-11-28 09:00:00', 2, 3),
(141, '2023-11-28 13:00:00', 2, 3),
(142, '2023-11-29 08:30:00', 2, 3),
(143, '2023-11-29 12:00:00', 2, 3),
(144, '2023-11-29 15:00:00', 2, 3),
(145, '2023-11-30 08:30:00', 2, 3),
(146, '2023-11-30 12:00:00', 2, 3),
(147, '2023-11-30 15:00:00', 2, 3),
(148, '2023-11-24 02:00:00', 2, 4),
(149, '2023-11-24 08:30:00', 2, 4),
(150, '2023-11-24 12:00:00', 2, 4),
(151, '2023-11-25 02:00:00', 2, 4),
(152, '2023-11-25 08:30:00', 2, 4),
(153, '2023-11-25 12:00:00', 2, 4),
(154, '2023-11-26 02:00:00', 2, 4),
(155, '2023-11-26 08:30:00', 2, 4),
(156, '2023-11-26 12:00:00', 2, 4),
(157, '2023-11-27 02:00:00', 2, 4),
(158, '2023-11-27 08:30:00', 2, 4),
(159, '2023-11-27 12:00:00', 2, 4),
(160, '2023-11-28 02:00:00', 2, 4),
(161, '2023-11-28 09:00:00', 2, 4),
(162, '2023-11-28 13:00:00', 2, 4),
(163, '2023-11-29 08:30:00', 2, 4),
(164, '2023-11-29 12:00:00', 2, 4),
(165, '2023-11-29 15:00:00', 2, 4),
(166, '2023-11-30 08:30:00', 2, 4),
(167, '2023-11-30 12:00:00', 2, 4),
(168, '2023-11-30 15:00:00', 2, 4),
(169, '2023-11-24 02:00:00', 3, 1),
(170, '2023-11-24 08:30:00', 3, 1),
(171, '2023-11-24 12:00:00', 3, 1),
(172, '2023-11-25 02:00:00', 3, 1),
(173, '2023-11-25 08:30:00', 3, 1),
(174, '2023-11-25 12:00:00', 3, 1),
(175, '2023-11-26 02:00:00', 3, 1),
(176, '2023-11-26 08:30:00', 3, 1),
(177, '2023-11-26 12:00:00', 3, 1),
(178, '2023-11-27 02:00:00', 3, 1),
(179, '2023-11-27 08:30:00', 3, 1),
(180, '2023-11-27 12:00:00', 3, 1),
(181, '2023-11-28 02:00:00', 3, 1),
(182, '2023-11-28 09:00:00', 3, 1),
(183, '2023-11-28 13:00:00', 3, 1),
(184, '2023-11-29 08:30:00', 3, 1),
(185, '2023-11-29 12:00:00', 3, 1),
(186, '2023-11-29 15:00:00', 3, 1),
(187, '2023-11-30 08:30:00', 3, 1),
(188, '2023-11-30 12:00:00', 3, 1),
(189, '2023-11-30 15:00:00', 3, 1),
(190, '2023-11-24 02:00:00', 3, 2),
(191, '2023-11-24 08:30:00', 3, 2),
(192, '2023-11-24 12:00:00', 3, 2),
(193, '2023-11-25 02:00:00', 3, 2),
(194, '2023-11-25 08:30:00', 3, 2),
(195, '2023-11-25 12:00:00', 3, 2),
(196, '2023-11-26 02:00:00', 3, 2),
(197, '2023-11-26 08:30:00', 3, 2),
(198, '2023-11-26 12:00:00', 3, 2),
(199, '2023-11-27 02:00:00', 3, 2),
(200, '2023-11-27 08:30:00', 3, 2),
(201, '2023-11-27 12:00:00', 3, 2),
(202, '2023-11-28 02:00:00', 3, 2),
(203, '2023-11-28 09:00:00', 3, 2),
(204, '2023-11-28 13:00:00', 3, 2),
(205, '2023-11-29 08:30:00', 3, 2),
(206, '2023-11-29 12:00:00', 3, 2),
(207, '2023-11-29 15:00:00', 3, 2),
(208, '2023-11-30 08:30:00', 3, 2),
(209, '2023-11-30 12:00:00', 3, 2),
(210, '2023-11-30 15:00:00', 3, 2),
(211, '2023-11-24 02:00:00', 3, 3),
(212, '2023-11-24 08:30:00', 3, 3),
(213, '2023-11-24 12:00:00', 3, 3),
(214, '2023-11-25 02:00:00', 3, 3),
(215, '2023-11-25 08:30:00', 3, 3),
(216, '2023-11-25 12:00:00', 3, 3),
(217, '2023-11-26 02:00:00', 3, 3),
(218, '2023-11-26 08:30:00', 3, 3),
(219, '2023-11-26 12:00:00', 3, 3),
(220, '2023-11-27 02:00:00', 3, 3),
(221, '2023-11-27 08:30:00', 3, 3),
(222, '2023-11-27 12:00:00', 3, 3),
(223, '2023-11-28 02:00:00', 3, 3),
(224, '2023-11-28 09:00:00', 3, 3),
(225, '2023-11-28 13:00:00', 3, 3),
(226, '2023-11-29 08:30:00', 3, 3),
(227, '2023-11-29 12:00:00', 3, 3),
(228, '2023-11-29 15:00:00', 3, 3),
(229, '2023-11-30 08:30:00', 3, 3),
(230, '2023-11-30 12:00:00', 3, 3),
(231, '2023-11-30 15:00:00', 3, 3),
(232, '2023-11-24 02:00:00', 3, 4),
(233, '2023-11-24 08:30:00', 3, 4),
(234, '2023-11-24 12:00:00', 3, 4),
(235, '2023-11-25 02:00:00', 3, 4),
(236, '2023-11-25 08:30:00', 3, 4),
(237, '2023-11-25 12:00:00', 3, 4),
(238, '2023-11-26 02:00:00', 3, 4),
(239, '2023-11-26 08:30:00', 3, 4),
(240, '2023-11-26 12:00:00', 3, 4),
(241, '2023-11-27 02:00:00', 3, 4),
(242, '2023-11-27 08:30:00', 3, 4),
(243, '2023-11-27 12:00:00', 3, 4),
(244, '2023-11-28 02:00:00', 3, 4),
(245, '2023-11-28 09:00:00', 3, 4),
(246, '2023-11-28 13:00:00', 3, 4),
(247, '2023-11-29 08:30:00', 3, 4),
(248, '2023-11-29 12:00:00', 3, 4),
(249, '2023-11-29 15:00:00', 3, 4),
(250, '2023-11-30 08:30:00', 3, 4),
(251, '2023-11-30 12:00:00', 3, 4),
(252, '2023-11-30 15:00:00', 3, 4),
(253, '2023-11-24 02:00:00', 4, 1),
(254, '2023-11-24 08:30:00', 4, 1),
(255, '2023-11-24 12:00:00', 4, 1),
(256, '2023-11-25 02:00:00', 4, 1),
(257, '2023-11-25 08:30:00', 4, 1),
(258, '2023-11-25 12:00:00', 4, 1),
(259, '2023-11-26 02:00:00', 4, 1),
(260, '2023-11-26 08:30:00', 4, 1),
(261, '2023-11-26 12:00:00', 4, 1),
(262, '2023-11-27 02:00:00', 4, 1),
(263, '2023-11-27 08:30:00', 4, 1),
(264, '2023-11-27 12:00:00', 4, 1),
(265, '2023-11-28 02:00:00', 4, 1),
(266, '2023-11-28 09:00:00', 4, 1),
(267, '2023-11-28 13:00:00', 4, 1),
(268, '2023-11-29 08:30:00', 4, 1),
(269, '2023-11-29 12:00:00', 4, 1),
(270, '2023-11-29 15:00:00', 4, 1),
(271, '2023-11-30 08:30:00', 4, 1),
(272, '2023-11-30 12:00:00', 4, 1),
(273, '2023-11-30 15:00:00', 4, 1),
(274, '2023-11-24 02:00:00', 4, 2),
(275, '2023-11-24 08:30:00', 4, 2),
(276, '2023-11-24 12:00:00', 4, 2),
(277, '2023-11-25 02:00:00', 4, 2),
(278, '2023-11-25 08:30:00', 4, 2),
(279, '2023-11-25 12:00:00', 4, 2),
(280, '2023-11-26 02:00:00', 4, 2),
(281, '2023-11-26 08:30:00', 4, 2),
(282, '2023-11-26 12:00:00', 4, 2),
(283, '2023-11-27 02:00:00', 4, 2),
(284, '2023-11-27 08:30:00', 4, 2),
(285, '2023-11-27 12:00:00', 4, 2),
(286, '2023-11-28 02:00:00', 4, 2),
(287, '2023-11-28 09:00:00', 4, 2),
(288, '2023-11-28 13:00:00', 4, 2),
(289, '2023-11-29 08:30:00', 4, 2),
(290, '2023-11-29 12:00:00', 4, 2),
(291, '2023-11-29 15:00:00', 4, 2),
(292, '2023-11-30 08:30:00', 4, 2),
(293, '2023-11-30 12:00:00', 4, 2),
(294, '2023-11-30 15:00:00', 4, 2),
(295, '2023-11-24 02:00:00', 4, 3),
(296, '2023-11-24 08:30:00', 4, 3),
(297, '2023-11-24 12:00:00', 4, 3),
(298, '2023-11-25 02:00:00', 4, 3),
(299, '2023-11-25 08:30:00', 4, 3),
(300, '2023-11-25 12:00:00', 4, 3),
(301, '2023-11-26 02:00:00', 4, 3),
(302, '2023-11-26 08:30:00', 4, 3),
(303, '2023-11-26 12:00:00', 4, 3),
(304, '2023-11-27 02:00:00', 4, 3),
(305, '2023-11-27 08:30:00', 4, 3),
(306, '2023-11-27 12:00:00', 4, 3),
(307, '2023-11-28 02:00:00', 4, 3),
(308, '2023-11-28 09:00:00', 4, 3),
(309, '2023-11-28 13:00:00', 4, 3),
(310, '2023-11-29 08:30:00', 4, 3),
(311, '2023-11-29 12:00:00', 4, 3),
(312, '2023-11-29 15:00:00', 4, 3),
(313, '2023-11-30 08:30:00', 4, 3),
(314, '2023-11-30 12:00:00', 4, 3),
(315, '2023-11-30 15:00:00', 4, 3),
(316, '2023-11-24 02:00:00', 4, 4),
(317, '2023-11-24 08:30:00', 4, 4),
(318, '2023-11-24 12:00:00', 4, 4),
(319, '2023-11-25 02:00:00', 4, 4),
(320, '2023-11-25 08:30:00', 4, 4),
(321, '2023-11-25 12:00:00', 4, 4),
(322, '2023-11-26 02:00:00', 4, 4),
(323, '2023-11-26 08:30:00', 4, 4),
(324, '2023-11-26 12:00:00', 4, 4),
(325, '2023-11-27 02:00:00', 4, 4),
(326, '2023-11-27 08:30:00', 4, 4),
(327, '2023-11-27 12:00:00', 4, 4),
(328, '2023-11-28 02:00:00', 4, 4),
(329, '2023-11-28 09:00:00', 4, 4),
(330, '2023-11-28 13:00:00', 4, 4),
(331, '2023-11-29 08:30:00', 4, 4),
(332, '2023-11-29 12:00:00', 4, 4),
(333, '2023-11-29 15:00:00', 4, 4),
(334, '2023-11-30 08:30:00', 4, 4),
(335, '2023-11-30 12:00:00', 4, 4),
(336, '2023-11-30 15:00:00', 4, 4);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

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
