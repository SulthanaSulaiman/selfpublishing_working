-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2023 at 01:30 PM
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
-- Database: `selfpublish`
--

-- --------------------------------------------------------

--
-- Table structure for table `covers`
--

CREATE TABLE `covers` (
  `cover_id` varchar(255) NOT NULL,
  `cover_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `covers`
--

INSERT INTO `covers` (`cover_id`, `cover_image`) VALUES
('Template_001', 'Cover_Template_001.jpg'),
('Template_002', 'Cover_Template_002.jpg'),
('Template_003', 'Cover_Template_003.jpg'),
('Template_004', 'Cover_Template_004.jpg'),
('Template_005', 'Cover_Template_005.jpg'),
('Template_006', 'Cover_Template_006.jpg'),
('Template_007', 'Cover_Template_007.jpg'),
('Template_008', 'Cover_Template_008.jpg'),
('Template_009', 'Cover_Template_009.jpg'),
('Template_010', 'Cover_Template_010.jpg'),
('Template_011', 'Cover_Template_011.jpg'),
('Template_012', 'Cover_Template_012.jpg'),
('Template_013', 'Cover_Template_013.jpg'),
('Template_014', 'Cover_Template_014.jpg'),
('Template_015', 'Cover_Template_015.jpg'),
('Template_016', 'Cover_Template_016.jpg'),
('Template_017', 'Cover_Template_017.jpg'),
('Template_018', 'Cover_Template_018.jpg'),
('Template_019', 'Cover_Template_019.jpg'),
('Template_020', 'Cover_Template_020.jpg'),
('Template_021', 'Cover_Template_021.jpg'),
('Template_022', 'Cover_Template_022.jpg'),
('Template_023', 'Cover_Template_023.jpg'),
('Template_024', 'Cover_Template_024.jpg'),
('Template_025', 'Cover_Template_025.jpg'),
('Template_026', 'Cover_Template_026.jpg'),
('Template_027', 'Cover_Template_027.jpg'),
('Template_028', 'Cover_Template_028.jpg'),
('Template_029', 'Cover_Template_029.jpg'),
('Template_030', 'Cover_Template_030.jpg'),
('Template_031', 'Cover_Template_031.jpg'),
('Template_032', 'Cover_Template_032.jpg'),
('Template_033', 'Cover_Template_033.jpg'),
('Template_034', 'Cover_Template_034.jpg'),
('Template_035', 'Cover_Template_035.jpg'),
('Template_036', 'Cover_Template_036.jpg'),
('Template_037', 'Cover_Template_037.jpg'),
('Template_038', 'Cover_Template_038.jpg'),
('Template_039', 'Cover_Template_039.jpg'),
('Template_040', 'Cover_Template_040.jpg'),
('Template_041', 'Cover_Template_041.jpg'),
('Template_042', 'Cover_Template_042.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `covers`
--
ALTER TABLE `covers`
  ADD PRIMARY KEY (`cover_id`(200));
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
