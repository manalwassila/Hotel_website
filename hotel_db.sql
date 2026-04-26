-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 04:52 PM
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
-- Database: `hotel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
('EQYJaB96HcaTtxag6J7d', 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2'),
('q33skOuHdrH9nASrc0SN', 'manal', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2'),
('257L65ACTjJP2REfcaI7', 'hiba', '1c6637a8f2e1f75e06ff9984894d6bd16a3a36a9');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `user_id` varchar(20) NOT NULL,
  `booking_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `rooms` int(1) NOT NULL,
  `check_in` varchar(10) NOT NULL,
  `check_out` varchar(10) NOT NULL,
  `adults` int(1) NOT NULL,
  `childs` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`user_id`, `booking_id`, `name`, `email`, `number`, `rooms`, `check_in`, `check_out`, `adults`, `childs`) VALUES
('VFGXYmjEGB5BZyOK8OGC', '3MX7vAjGDHjC3vAJAGAc', 'monsieur1', '1@gmail.com', '3343434343', 1, '2025-05-16', '2025-05-26', 1, 0),
('VFGXYmjEGB5BZyOK8OGC', 'hsLSuWPHeMPX0hKqoYeC', 'rayane', 'rayaneramzi@gmail.com', '0666666666', 1, '2025-05-22', '2025-05-28', 2, 0),
('VFGXYmjEGB5BZyOK8OGC', '0DFV4hry39Ru8yfv17lA', 'amine', 'manalwassila@gmail.com', '0836464643', 1, '2025-06-07', '2025-06-07', 1, 0),
('VFGXYmjEGB5BZyOK8OGC', 'gKMi0K4irrsv067BogaK', 'hiba', '1@gmail.com', '0836464643', 4, '2025-05-16', '2025-05-27', 1, 0),
('VFGXYmjEGB5BZyOK8OGC', 'mVSnog2Ia72i0ByEfJtG', 'hiba', '1@gmail.com', '0836464643', 1, '2025-05-16', '2025-05-27', 1, 0),
('VFGXYmjEGB5BZyOK8OGC', 'wrnpoK2C130Ms5X7MDWK', 'soumia', 'manalwassila@gmail.com', '0836464643', 3, '2025-05-16', '2025-05-27', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'monsieur1', '1@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '2025-05-18 12:21:34'),
(2, 'rayane', 'rayaneramzi@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '2025-05-20 13:12:01'),
(3, 'amine', 'hajarwassila2@hotmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '2025-05-20 14:33:52');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `number`, `message`) VALUES
('JmnCQ9DOPlyO1Gs6pHCe', 'amine', 'manalwassila@gmail.com', '0836464643', '22ew32r3w42343q'),
('rw4JaOAs1a5pPTbdZcn7', 'amine', 'manalwassila@gmail.com', '0836464643', 'ui\r\n'),
('6IaFyrjUILYiCTKH87gv', 'amine', 'manalwassila@gmail.com', '0836464643', 'sdddsdsd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
