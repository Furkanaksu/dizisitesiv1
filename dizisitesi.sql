-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 09, 2019 at 02:22 PM
-- Server version: 8.0.16
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dizisitesi`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Category` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Id`, `Category`) VALUES
(1, 'Sci-fi'),
(2, 'Adventure'),
(4, 'Scary');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Category2` varchar(50) NOT NULL,
  `Score` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`Id`, `Name`, `Category`, `Category2`, `Score`, `Date`) VALUES
(1, 'The Lord Of The Rings', 'Fantastic', 'Adventure', 10, '2019-09-01 00:00:00'),
(2, 'Avatar', 'Adventure', 'Fantasy', 8, '2019-09-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `productsimage`
--

DROP TABLE IF EXISTS `productsimage`;
CREATE TABLE IF NOT EXISTS `productsimage` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ProductId` int(11) NOT NULL,
  `Image` int(11) NOT NULL,
  `Ad` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yonetim`
--

DROP TABLE IF EXISTS `yonetim`;
CREATE TABLE IF NOT EXISTS `yonetim` (
  `Id` int(255) NOT NULL AUTO_INCREMENT,
  `Email` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` int(11) NOT NULL,
  `Name` varchar(110) COLLATE utf8mb4_general_ci NOT NULL,
  `Surname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `AddedDate` datetime NOT NULL,
  `UpdatedDate` datetime NOT NULL,
  `Status` int(11) NOT NULL,
  `LoginDate` datetime NOT NULL,
  `IP` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `OS` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Browser` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `FailedDate` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `yonetim`
--

INSERT INTO `yonetim` (`Id`, `Email`, `Password`, `Name`, `Surname`, `AddedDate`, `UpdatedDate`, `Status`, `LoginDate`, `IP`, `OS`, `Browser`, `FailedDate`) VALUES
(6, 'furkan@furkan', 0, 'Admin', 'fsafa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '', '', '0000-00-00 00:00:00'),
(7, 'admin@admin', 123456, 'Furkan', 'Aksu', '2019-09-05 00:00:00', '2019-09-07 00:00:00', 1, '2019-09-09 12:07:48', '::1', 'Windows 10', 'Chrome', '2019-09-18 00:00:00'),
(8, 'furkan@furkan.com', 2121121212, 'aksu', 'furkan', '2019-09-09 00:00:00', '2019-09-09 00:00:00', 0, '2019-09-09 00:00:00', '0.0.0.0', 'Win 10', 'Chrome', '2019-09-09 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
