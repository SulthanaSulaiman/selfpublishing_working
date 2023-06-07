-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 03:28 PM
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
-- Table structure for table `covers`
--

CREATE TABLE `covers` (
  `cover_id` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `cover_image_subject` varchar(255) NOT NULL,
  `cover_image` text NOT NULL,
  `cover_usage` varchar(255) NOT NULL,
  `background_color` varchar(255) NOT NULL,
  `internal_colors` varchar(255) NOT NULL,
  `orientation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `covers`
--

INSERT INTO `covers` (`cover_id`, `category`, `cover_image_subject`, `cover_image`, `cover_usage`, `background_color`, `internal_colors`, `orientation`) VALUES
('Book_001', 'Abstract', 'Spikes of multocolor', 'Cover_Template_001 copy.jpg', 'Front and Back Same', 'Black', 'Multicolor', 'Portrait'),
('Book_002', 'Abstract', 'Philosophy', 'Cover_Template_002 copy.jpg', 'Front only', 'Olive green', 'Red yellow', 'Lanscape'),
('Book_003', 'Adventure', 'Circular rings in shades of yellow/sand dunes?', 'Cover_Template_003 copy.jpg', 'Front and Back Same', 'Peach', 'Shades of yellow', 'Portrait'),
('Book_004', 'Adventure', 'Patches of pastel shades', 'Cover_Template_004 copy.jpg', 'Front and Back Single continuous', 'Brown', 'Shades of peach', 'Portrait'),
('Book_005', 'Adventure', 'Circles of pastel shades', 'Cover_Template_005 copy.jpg', 'Front and Back Single continuous', 'Light blue', 'Shades of peach', 'Lanscape'),
('Book_006', 'Biology', 'Geometric illustration', 'Cover_Template_006 copy.jpg', 'Front and Back Single continuous', 'Black', 'Shades of black green', 'Portrait'),
('Book_007', 'Biology', 'Curls of yellow on a red background', 'Cover_Template_007 copy.jpg', 'Front and Back Different', 'Greyish blue', 'Red yellow', 'Portrait'),
('Book_008', 'Biology', 'Lines and curves', 'Cover_Template_008 copy.jpg', 'Front and Back Different', 'Brown', 'Red off-white black', 'Portrait'),
('Book_009', 'Gambling', 'Wood surface', 'Cover_Template_009 copy.jpg', 'Front and Back Single continuous', 'Peach', 'Brown peach', 'Portrait'),
('Book_010', 'Gambling', 'Maple and oak leaves', 'Cover_Template_010 copy.jpg', 'Front and Back Different', 'Burnt red', 'Brown peach', 'Lanscape');

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
