-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 03:27 PM
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
-- Database: `s4c`
--

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` varchar(255) NOT NULL,
  `authorName` text NOT NULL,
  `authorEmail` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `bookTitle` text DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `interiorDesign` varchar(255) DEFAULT NULL,
  `editorialComplexity` varchar(255) DEFAULT NULL,
  `nuberOfMenuscriptPages` int(255) DEFAULT NULL,
  `bookSubtitle` text DEFAULT NULL,
  `coverType` text DEFAULT NULL,
  `trimSizeWidth` double DEFAULT NULL,
  `trimSizeHeight` double DEFAULT NULL,
  `paperWeight` double DEFAULT NULL,
  `dimenSpecification` varchar(255) DEFAULT NULL,
  `bookCoverFront` text DEFAULT NULL,
  `spine` text DEFAULT NULL,
  `bookCoverBack` text DEFAULT NULL,
  `priceBarcode` double DEFAULT NULL,
  `authorImage` varchar(255) DEFAULT NULL,
  `artImage` varchar(255) DEFAULT NULL,
  `visionDesign` text DEFAULT NULL,
  `template_id` varchar(255) DEFAULT NULL,
  `trimSize` text DEFAULT NULL,
  `visonInteriorDesign` text DEFAULT NULL,
  `requestedServices` varchar(255) DEFAULT NULL,
  `userName` varchar(255) NOT NULL,
  `userMail` text NOT NULL,
  `submitCount` int(11) NOT NULL DEFAULT 0,
  `fileName` varchar(255) DEFAULT NULL,
  `other` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
