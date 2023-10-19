-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 03:50 PM
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
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `ida` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `etat` varchar(20) DEFAULT NULL,
  `photo` varchar(255) DEFAULT 'logo.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`ida`, `nom`, `description`, `categorie`, `prix`, `etat`, `photo`) VALUES
(1, 'Télévision LED Samsung 42 pouces', 'Télévision en parfait état de fonctionnement, avec télécommande.', 'Électronique', 299.99, 'Comme neuf', 'logo.png'),
(2, 'Vélo de montagne tout-terrain', 'Vélo en aluminium avec suspension avant, idéal pour les sentiers de montagne.', 'Sport et loisirs', 499.50, 'Bon état', 'logo.png'),
(3, 'Canapé en cuir noir', 'Canapé 3 places en cuir véritable, confortable et élégant.', 'Mobilier', 799.00, 'Usagé', 'logo.png'),
(4, 'iPhone X 64 Go', 'iPhone X en excellent état, débloqué, avec chargeur et boîte d\'origine.', 'Électronique', 599.99, 'Très bon état', 'logo.png'),
(5, 'Livre \"Le Seigneur des Anneaux\"', 'Trilogie complète en édition de poche, comme neuf.', 'Livres', 29.99, 'Comme neuf', 'logo.png'),
(6, 'Table à manger en bois massif', 'Table rectangulaire en chêne massif avec quatre chaises assorties.', 'Mobilier', 349.00, 'Usagé', 'logo.png'),
(7, 'Ordinateur portable HP Pavilion', 'Ordinateur portable avec processeur Intel Core i5, 8 Go de RAM, et SSD 256 Go.', 'Électronique', 699.99, 'Très bon état', 'logo.png'),
(8, 'Appareil photo Canon EOS Rebel', 'Appareil photo reflex numérique avec objectif 18-55 mm, idéal pour les amateurs de photographie.', 'Électronique', 449.50, 'Bon état', 'logo.png'),
(9, 'Console de jeux vidéo Xbox One', 'Console avec manette sans fil et jeux préinstallés.', 'Jeux vidéo', 249.00, 'Usagé', 'logo.png'),
(10, 'Montre-bracelet en acier inoxydable', 'Montre élégante avec bracelet en acier inoxydable, résistante à l\'eau.', 'Mode', 79.99, 'Neuf', 'logo.png'),
(11, 'Chaise de bureau ergonomique', 'Chaise réglable en hauteur avec support lombaire, idéale pour le travail à domicile.', 'Mobilier', 129.00, 'Très bon état', 'logo.png'),
(12, 'Sac à dos de randonnée Columbia', 'Sac spacieux avec plusieurs compartiments pour les amateurs de plein air.', 'Sport et loisirs', 59.50, 'Usagé', 'logo.png'),
(13, 'Console de jeux Nintendo Switch', 'Console polyvalente avec manettes détachables et support pour jouer en mode portable.', 'Jeux vidéo', 299.99, 'Comme neuf', 'logo.png'),
(14, 'Guitare acoustique Yamaha', 'Guitare acoustique avec table en épicéa et dos en acajou, son riche et clair.', 'Instruments de musique', 199.00, 'Bon état', 'logo.png'),
(15, 'Aspirateur sans fil Dyson V8', 'Aspirateur sans fil avec une puissante aspiration, idéal pour les petits espaces.', 'Électroménager', 149.99, 'Très bon état', 'logo.png'),
(16, 'Tablette Samsung Galaxy Tab A', 'Tablette Android avec écran 10 pouces, 32 Go de stockage et connectivité Wi-Fi.', 'Électronique', 179.50, 'Bon état', 'logo.png'),
(17, 'Lampe de bureau LED', 'Lampe de bureau réglable avec éclairage LED, parfaite pour le travail et la lecture.', 'Maison et décoration', 39.99, 'Neuf', 'logo.png'),
(18, 'Raquette de tennis Wilson Pro Staff', 'Raquette de tennis haut de gamme pour les joueurs expérimentés.', 'Sport et loisirs', 129.00, 'Usagé', 'logo.png'),
(19, 'Machine à café Nespresso', 'Machine à café avec système de capsules, en excellent état de fonctionnement.', 'Électroménager', 89.00, 'Très bon état', 'logo.png'),
(20, 'Enceinte Bluetooth JBL Charge 4', 'Enceinte portable étanche avec une autonomie de 20 heures.', 'Électronique', 129.99, 'Comme neuf', 'logo.png'),
(21, 'Lunettes de soleil Ray-Ban Aviator', 'Lunettes de soleil classiques avec monture dorée et verres teintés.', 'Mode', 79.00, 'Neuf', 'logo.png'),
(22, 'Tapis de yoga antidérapant', 'Tapis de yoga confortable et antidérapant, idéal pour les séances à domicile.', 'Sport et loisirs', 29.50, 'Neuf', 'logo.png'),
(23, 'Console de jeux PlayStation 4', 'Console avec manette sans fil et jeux inclus, en bon état de fonctionnement.', 'Jeux vidéo', 199.00, 'Usagé', 'logo.png'),
(24, 'Valise de voyage Samsonite', 'Valise rigide avec quatre roues pivotantes, idéale pour les voyages.', 'Bagages', 89.99, 'Très bon état', 'logo.png'),
(25, 'Robe de soirée élégante', 'Robe longue en soie avec détails en dentelle, parfaite pour les occasions spéciales.', 'Mode', 149.00, 'Comme neuf', 'logo.png'),
(26, 'Tondeuse à gazon électrique', 'Tondeuse légère et facile à manœuvrer pour l\'entretien de votre pelouse.', 'Jardin et extérieur', 129.50, 'Bon état', 'logo.png'),
(27, 'Casque audio Sony WH-1000XM4', 'Casque sans fil avec réduction de bruit, qualité audio exceptionnelle.', 'Électronique', 299.00, 'Très bon état', 'logo.png'),
(28, 'Manteau d\'hiver pour homme', 'Manteau chaud et imperméable avec capuche, idéal pour l\'hiver.', 'Mode', 179.99, 'Neuf', 'logo.png'),
(29, 'Table de ping-pong pliante', 'Table de ping-pong facile à plier et à ranger, avec filet et raquettes.', 'Sport et loisirs', 249.00, 'Usagé', 'logo.png');

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
(1, 'admin@greentrade.com', 'admin123!', 'A', 'A'),
(2, 'johndoe@example.com', 'test123!', 'U', 'A'),
(3, 'janesmith@example.com', 'test123!', 'U', 'A'),
(4, 'robertjohnson@example.com', 'test123!', 'U', 'A'),
(5, 'emilywilliams@example.com', 'test123!', 'U', 'A'),
(6, 'michaelbrown@example.com', 'test123!', 'U', 'A'),
(7, 'sarahdavis@example.com', 'test123!', 'U', 'A'),
(8, 'dananderson@example.com', 'test123!', 'U', 'A'),
(9, 'oliviawilson@example.com', 'test123!', 'U', 'A'),
(10, 'jessicalee@example.com', 'test123!', 'U', 'A'),
(11, 'davidgarcia@example.com', 'test123!', 'U', 'A'),
(16, 'walezka.marrder@gmail.com', 'test123!', 'M', 'A'),
(23, 'martin@gmail.com', 'test123!', 'M', 'A'),
(25, 'bparisotlino@gmail.com', 'Wm123!', 'M', 'A');

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
(16, 'MARRDER', 'WALEZKA', 'walezka.marrder@gmail.com', 'F', '2023-09-21', 'walezka.jpeg'),
(23, 'Tremblay', 'Martin', 'martin@gmail.com', 'M', '1992-10-13', 'TremblayMartin1696095823.png'),
(25, 'boran', 'lino', 'bparisotlino@gmail.com', 'M', '2023-09-19', 'avatarMembre.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ida`);

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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `ida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `membres`
--
ALTER TABLE `membres`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
