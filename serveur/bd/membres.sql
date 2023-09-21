-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2023 at 03:55 PM
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
-- Database: `greentrade`
--

-- --------------------------------------------------------

--
-- Table structure for table `membres`
--

CREATE TABLE `membres` (
  `idm` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `courriel` varchar(256) NOT NULL,
  `sexe` varchar(1) DEFAULT NULL,
  `datenaissance` date DEFAULT NULL,
  `photo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `membres`
--

INSERT INTO `membres` (`idm`, `nom`, `prenom`, `courriel`, `sexe`, `datenaissance`, `photo`) VALUES
(1, 'Bond', 'James', 'admin@compagnie.com', 'M', '1968-02-16', ''),
(2, 'Doe', 'John', 'johndoe@example.com', 'M', '1990-05-15', ''),
(3, 'Smith', 'Jane', 'janesmith@example.com', 'F', '1985-12-10', ''),
(4, 'Johnson', 'Robert', 'robertjohnson@example.com', 'M', '1982-07-22', ''),
(5, 'Williams', 'Emily', 'emilywilliams@example.com', 'F', '1995-03-30', ''),
(6, 'Brown', 'Michael', 'michaelbrown@example.com', 'M', '1993-09-05', ''),
(7, 'Davis', 'Sarah', 'sarahdavis@example.com', 'F', '1988-11-18', ''),
(8, 'Anderson', 'Daniel', 'dananderson@example.com', 'M', '1991-04-27', ''),
(9, 'Wilson', 'Olivia', 'oliviawilson@example.com', 'F', '1997-01-12', ''),
(10, 'Lee', 'Jessica', 'jessicalee@example.com', 'F', '1987-06-25', ''),
(11, 'Garcia', 'David', 'davidgarcia@example.com', 'M', '1994-08-08', ''),
(12, 'MARRDER', 'WALEZKA', 'walezka.marrder@gmail.com', 'F', '1994-03-21', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`idm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `membres`
--
ALTER TABLE `membres`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
