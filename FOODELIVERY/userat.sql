-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2024 at 02:11 PM
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
-- Database: `userat`
--

-- --------------------------------------------------------

--
-- Table structure for table `perdoruesit`
--

CREATE TABLE `perdoruesit` (
  `id` int(11) NOT NULL,
  `emri_perdoruesit` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwordat` varchar(255) NOT NULL,
  `adresa` varchar(100) NOT NULL,
  `data_rregjistrimit` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `perdoruesit`
--

INSERT INTO `perdoruesit` (`id`, `emri_perdoruesit`, `email`, `passwordat`, `adresa`, `data_rregjistrimit`) VALUES
(4, 'ASDFASDF', 'ASDFASDF', '$2y$10$t0EcSdujeXgV55tn9xrF3.luSJj/9wOtC5i7yWmm2UV', 'ASDFAF', '2024-01-29 17:29:14'),
(5, 'asdfa', '', '$2y$10$bfGHg4GRX5lO9ONsQivC8uGOXbZDIWGkYxV/RfH8rs5QHzuw8sXYy', 'asdfa', '2024-01-29 17:56:50'),
(7, '123', '12312', '$2y$10$wCuRwFVcl48oJFuZzp6gx.O8Www2n3.Qrq7n5BR6iP5.ZrayNQlva', '12312312313', '2024-01-29 17:58:45'),
(13, 'granit', 'granit@g.com', '$2y$10$pzR5dkQVpwj62dfbiUQsAuN7Mh.7UqkNclJAd3OlIFS00RtArmehi', 'prizren', '2024-01-30 15:33:22'),
(15, 'asdfaasdfa', 'asdfa@ubt.com', '$2y$10$6kOl7BXl7AukZQZ3d7Cf6.M.Xhwo6cOdqnrikREtiXZP0mKk2x1Ci', 'sadfasfdasfda', '2024-01-30 15:40:31'),
(16, 'rezon123', 'rezon@h.com', '$2y$10$UQgYP5fJRQ5JzE8c99uXi.HB7eGYzUs01sLZEYb7lEVOYtMbCaALq', 'asdfasd', '2024-01-30 16:16:24'),
(17, 'granitadmin', 'gra@h.com', '$2y$10$/A6D5yBxGhAxMb3Kzr7nYeUXcy043zkznAXbtSUCRZ8Ivi.RbbacO', 'prozrren', '2024-01-30 16:24:41'),
(18, 'admingranit', 'g@abc.com', '$2y$10$xLY4pXgCm.Z5QsYqPs7aa.Xk2FBccTwRuVDKwlE7isOHj1zT1ekPm', 'fasdfasdf', '2024-01-31 14:29:26'),
(19, 'grankogranko', 'g@abc.com', '$2y$10$cozwutZ0cAZXMnDr3SyyZetuUvNvL1TSoLYhalPjhN6fycr8cAtA.', 'prizren', '2024-01-31 14:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `adresa` varchar(255) NOT NULL,
  `orari` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `emri`, `adresa`, `orari`) VALUES
(2, 'HYSKA', 'BAZHDARHANE', '21:00:'),
(7, 'bahtijari', 'BAZHDARHANE', '23:00'),
(8, 'BURGER KING', 'RRUGA', '22:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `perdoruesit`
--
ALTER TABLE `perdoruesit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emri_perdoruesit` (`emri_perdoruesit`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perdoruesit`
--
ALTER TABLE `perdoruesit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
