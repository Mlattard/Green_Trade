-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2023 at 10:46 PM
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
-- Table structure for table `connexion`
--

CREATE TABLE `connexion` (
  `idm` int(11) NOT NULL,
  `courriel` varchar(256) NOT NULL,
  `pass` varchar(12) NOT NULL,
  `role` varchar(1) DEFAULT 'M',
  `statut` varchar(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `connexion`
--

INSERT INTO `connexion` (`idm`, `courriel`, `pass`, `role`, `statut`) VALUES
(1, 'admin@greentrade.com', 'admin', 'A', 'A'),
(2, 'johndoe@example.com', 'password1', 'U', 'A'),
(3, 'janesmith@example.com', 'password2', 'U', 'A'),
(4, 'robertjohnson@example.com', 'password3', 'U', 'A'),
(5, 'emilywilliams@example.com', 'password4', 'U', 'A'),
(6, 'michaelbrown@example.com', 'password5', 'U', 'A'),
(7, 'sarahdavis@example.com', 'password6', 'U', 'A'),
(8, 'dananderson@example.com', 'password7', 'U', 'A'),
(9, 'oliviawilson@example.com', 'password8', 'U', 'A'),
(10, 'jessicalee@example.com', 'password9', 'U', 'A'),
(11, 'davidgarcia@example.com', 'password10', 'U', 'A'),
(12, 'walezka.marrder@gmail.com', 'Wm123!', 'M', 'A'),
(13, 'ludwid-m@hotmail.com', 'Wm1!', 'M', 'A');

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
(1, 'Bond', 'James', 'admin@greentrade.com', 'M', '1968-02-16', 'avatarMembre.png'),
(2, 'Doe', 'John', 'johndoe@example.com', 'M', '1990-05-15', 'avatarMembre.png'),
(3, 'Smith', 'Jane', 'janesmith@example.com', 'F', '1985-12-10', 'avatarMembre.png'),
(4, 'Johnson', 'Robert', 'robertjohnson@example.com', 'M', '1982-07-22', 'avatarMembre.png'),
(5, 'Williams', 'Emily', 'emilywilliams@example.com', 'F', '1995-03-30', 'avatarMembre.png'),
(6, 'Brown', 'Michael', 'michaelbrown@example.com', 'M', '1993-09-05', 'avatarMembre.png'),
(7, 'Davis', 'Sarah', 'sarahdavis@example.com', 'F', '1988-11-18', 'avatarMembre.png'),
(8, 'Anderson', 'Daniel', 'dananderson@example.com', 'M', '1991-04-27', 'avatarMembre.png'),
(9, 'Wilson', 'Olivia', 'oliviawilson@example.com', 'F', '1997-01-12', 'avatarMembre.png'),
(10, 'Lee', 'Jessica', 'jessicalee@example.com', 'F', '1987-06-25', 'avatarMembre.png'),
(11, 'Garcia', 'David', 'davidgarcia@example.com', 'M', '1994-08-08', 'avatarMembre.png'),
(12, 'MARRDER', 'WALEZKA', 'walezka.marrder@gmail.com', 'F', '1994-03-21', 'avatarMembre.png'),
(13, 'Quiroz', 'Ligia', 'ludwid-m@hotmail.com', 'M', '1995-05-05', 'b0dae0e4eb7beba17fc58ff022a5b23a0fc88a16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connexion`
--
ALTER TABLE `connexion`
  ADD KEY `connexion_idm_FK` (`idm`);

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
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `connexion`
--
ALTER TABLE `connexion`
  ADD CONSTRAINT `connexion_idm_FK` FOREIGN KEY (`idm`) REFERENCES `membres` (`idm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
