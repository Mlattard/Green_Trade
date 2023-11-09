-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 08 nov. 2023 à 23:42
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `greentrade`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `ida` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `etat` varchar(20) DEFAULT NULL,
  `photo` varchar(255) DEFAULT 'logo.png',
  `statut` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`ida`, `nom`, `description`, `categorie`, `prix`, `etat`, `photo`, `statut`) VALUES
(5, 'Livre \"Le Seigneur des Anneaux\"', 'Trilogie complète en édition de poche, comme neuf.', 'Livres', 29.99, 'Neuf', 'seigneurdesanneaux1698511952.jpg', 'I'),
(6, 'Table à manger en bois massif', 'Table rectangulaire en chêne massif avec quatre chaises assorties.', 'Mobilier', 349.00, 'Usagé', 'table1698511985.jpg', 'I'),
(7, 'Ordinateur portable HP Pavilion', 'Ordinateur portable avec processeur Intel Core i5, 8 Go de RAM, et SSD 256 Go.', 'Électronique', 699.99, 'Occasion', 'laptop1698512168.jpg', 'I'),
(8, 'Appareil photo Canon EOS Rebel', 'Appareil photo reflex numérique avec objectif 18-55 mm, idéal pour les amateurs de photographie.', 'Électronique', 449.50, 'Occasion', 'camera1698509940.jpg', 'I'),
(9, 'Console de jeux vidéo Xbox One', 'Console avec manette sans fil et jeux préinstallés.', 'Jeux vidéo', 249.00, 'Usagé', 'logo.png', 'I'),
(11, 'Chaise de bureau ergonomique', 'Chaise réglable en hauteur avec support lombaire, idéale pour le travail à domicile.', 'Mobilier', 129.00, 'Neuf', 'logo.png', 'I'),
(12, 'Sac à dos de randonnée Columbia', 'Sac spacieux avec plusieurs compartiments pour les amateurs de plein air.', 'Sport et loisirs', 59.50, 'Usagé', 'logo.png', 'I'),
(13, 'Console de jeux Nintendo Switch', 'Console polyvalente avec manettes détachables et support pour jouer en mode portable.', 'Jeux vidéo', 299.99, 'Neuf', 'logo.png', 'I'),
(14, 'Guitare acoustique Yamaha', 'Guitare acoustique avec table en épicéa et dos en acajou, son riche et clair.', 'Instruments de musique', 199.00, 'Usagé', 'logo.png', 'I'),
(15, 'Aspirateur sans fil Dyson V8', 'Aspirateur sans fil avec une puissante aspiration, idéal pour les petits espaces.', 'Électroménager', 149.99, 'Occasion', 'logo.png', 'I'),
(16, 'Tablette Samsung Galaxy Tab A', 'Tablette Android avec écran 10 pouces, 32 Go de stockage et connectivité Wi-Fi.', 'Électronique', 179.50, 'Usagé', 'logo.png', 'I'),
(17, 'Lampe de bureau LED', 'Lampe de bureau réglable avec éclairage LED, parfaite pour le travail et la lecture.', 'Maison et décoration', 39.99, 'Neuf', 'logo.png', 'I'),
(18, 'Raquette de tennis Wilson Pro Staff', 'Raquette de tennis haut de gamme pour les joueurs expérimentés.', 'Sport et loisirs', 129.00, 'Usagé', 'logo.png', 'I'),
(19, 'Machine à café Nespresso', 'Machine à café avec système de capsules, en excellent état de fonctionnement.', 'Électroménager', 89.00, 'Occasion', 'logo.png', 'I'),
(20, 'Enceinte Bluetooth JBL Charge 4', 'Enceinte portable étanche avec une autonomie de 20 heures.', 'Électronique', 129.99, 'Neuf', 'logo.png', 'I'),
(21, 'Lunettes de soleil Ray-Ban Aviator', 'Lunettes de soleil classiques avec monture dorée et verres teintés.', 'Mode', 79.00, 'Neuf', 'logo.png', 'I'),
(22, 'Tapis de yoga antidérapant', 'Tapis de yoga confortable et antidérapant, idéal pour les séances à domicile.', 'Sport et loisirs', 29.50, 'Neuf', 'logo.png', 'I'),
(23, 'Console de jeux PlayStation 4', 'Console avec manette sans fil et jeux inclus, en bon état de fonctionnement.', 'Jeux vidéo', 199.00, 'Usagé', 'logo.png', 'I'),
(24, 'Valise de voyage Samsonite', 'Valise rigide avec quatre roues pivotantes, idéale pour les voyages.', 'Bagages', 89.99, 'Occasion', 'logo.png', 'I'),
(25, 'Robe de soirée élégante', 'Robe longue en soie avec détails en dentelle, parfaite pour les occasions spéciales.', 'Mode', 149.00, 'Neuf', 'logo.png', 'I'),
(26, 'Tondeuse à gazon électrique', 'Tondeuse légère et facile à manœuvrer pour l\'entretien de votre pelouse.', 'Jardin et extérieur', 129.50, 'Occasion', 'logo.png', 'A'),
(27, 'Casque audio Sony WH-1000XM4', 'Casque sans fil avec réduction de bruit, qualité audio exceptionnelle.', 'Électronique', 299.00, 'Neuf', 'logo.png', 'A'),
(28, 'Manteau d\'hiver pour homme', 'Manteau chaud et imperméable avec capuche, idéal pour l\'hiver.', 'Mode', 179.99, 'Neuf', 'logo.png', 'A'),
(29, 'Table de ping-pong pliante', 'Table de ping-pong facile à plier et à ranger, avec filet et raquettes.', 'Sport et loisirs', 249.00, 'Usagé', 'logo.png', 'A'),
(32, 'Pomme', 'Déjà croquée', 'Alimentation', 1.00, 'Occasion', 'logo.png', 'A'),
(33, 'Poire', 'Pas une pomme', 'Alimentation', 5.00, 'Neuf', 'logo.png', 'A'),
(36, 'Abricot', 'Pas une poire', 'Alimentation', 6.00, 'Neuf', 'Abricot1698348095.jpg', 'A');

-- --------------------------------------------------------

--
-- Structure de la table `articlespanier`
--

CREATE TABLE `articlespanier` (
  `idp` int(11) NOT NULL,
  `ida` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articlespanier`
--

INSERT INTO `articlespanier` (`idp`, `ida`, `nom`, `prix`) VALUES
(22, 5, 'Livre \"Le Seigneur des Anneaux\"', 29.99),
(22, 6, 'Table à manger en bois massif', 349.00),
(23, 7, 'Ordinateur portable HP Pavilion', 699.99),
(23, 8, 'Appareil photo Canon EOS Rebel', 449.50),
(23, 9, 'Console de jeux vidéo Xbox One', 249.00),
(24, 11, 'Chaise de bureau ergonomique', 129.00),
(25, 12, 'Sac à dos de randonnée Columbia', 59.50),
(26, 13, 'Console de jeux Nintendo Switch', 299.99),
(27, 14, 'Guitare acoustique Yamaha', 199.00),
(27, 15, 'Aspirateur sans fil Dyson V8', 149.99),
(28, 16, 'Tablette Samsung Galaxy Tab A', 179.50),
(28, 17, 'Lampe de bureau LED', 39.99),
(29, 20, 'Enceinte Bluetooth JBL Charge 4', 129.99),
(29, 21, 'Lunettes de soleil Ray-Ban Aviator', 79.00),
(30, 18, 'Raquette de tennis Wilson Pro Staff', 129.00),
(32, 23, 'Console de jeux PlayStation 4', 199.00),
(33, 22, 'Tapis de yoga antidérapant', 29.50),
(33, 24, 'Valise de voyage Samsonite', 89.99),
(34, 19, 'Machine à café Nespresso', 89.00),
(34, 25, 'Robe de soirée élégante', 149.00);

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `idm` int(11) NOT NULL,
  `courriel` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pass` varchar(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `role` varchar(1) DEFAULT 'M',
  `statut` varchar(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `connexion`
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
(25, 'bparisotlino@gmail.com', 'Wm123!', 'M', 'A'),
(30, 'maxime@lattard.fr', 'Qwe123!', 'M', 'A'),
(43, 'ppp@ppp.fr', 'qqq111!', 'M', 'A'),
(44, 'ooo@ooo.fr', 'ooo111!', 'M', 'A'),
(45, 'iii@iii.fr', 'iii111!', 'M', 'A'),
(46, 'mnm@mnm.fr', 'mnm111!', 'M', 'A'),
(47, 'bnm@bnm.fr', 'bnm111!', 'M', 'A'),
(48, 'poi', '', 'M', 'A'),
(49, 'poi@poi.fr', 'poi111!', 'M', 'A'),
(50, 'qwe@qwe.fr', 'qwe111!', 'M', 'A'),
(51, 'maxmax@lattard.fr', 'qqq111!', 'M', 'A');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
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
-- Déchargement des données de la table `membres`
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
(25, 'boran', 'lino', 'bparisotlino@gmail.com', 'M', '2023-09-19', 'avatarMembre.png'),
(30, 'Lattard', 'Maxime', 'maxime@lattard.fr', 'M', '1992-12-23', 'LattardMaxime1697753696.jpg'),
(43, 'ppp', 'ppp', 'ppp@ppp.fr', 'M', '1111-11-11', 'pppppp1698331417.jpg'),
(44, 'ooo', 'ooo', 'ooo@ooo.fr', 'M', '1111-11-11', 'avatarMembre.png'),
(45, 'iii', 'iii', 'iii@iii.fr', 'M', '1111-11-11', 'avatarMembre.png'),
(46, 'mnm', 'mnm', 'mnm@mnm.fr', 'M', '1111-11-11', 'avatarMembre.png'),
(47, 'bnm', 'bnm', 'bnm@bnm.fr', 'M', '1111-11-11', 'bnmbnm1698342744.jpg'),
(48, 'poi', 'poi', 'poi', 'M', '0000-00-00', 'avatarMembre.png'),
(49, 'poi', 'poi', 'poi@poi.fr', 'M', '1111-11-11', 'poipoi1698344814.jpg'),
(50, 'qwe', 'qwe', 'qwe@qwe.fr', 'M', '1111-11-11', 'qweqwe1698345277.jpg'),
(51, 'Lattard', 'Maxmax', 'maxmax@lattard.fr', 'M', '1992-12-23', 'LattardMaxmax1698846798.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

CREATE TABLE `paniers` (
  `idp` int(11) NOT NULL,
  `idm` int(11) DEFAULT NULL,
  `statut` varchar(1) NOT NULL,
  `date_creation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paniers`
--

INSERT INTO `paniers` (`idp`, `idm`, `statut`, `date_creation`) VALUES
(22, 30, 'I', '2023-11-01'),
(23, 30, 'I', '2023-11-01'),
(24, 30, 'I', '2023-11-01'),
(25, 30, 'I', '2023-11-01'),
(26, 30, 'I', '2023-11-01'),
(27, 30, 'I', '2023-11-01'),
(28, 30, 'I', '2023-11-01'),
(29, 30, 'I', '2023-11-01'),
(30, 51, 'I', '2023-11-01'),
(31, 51, 'A', '2023-11-01'),
(32, 30, 'I', '2023-11-01'),
(33, 30, 'I', '2023-11-05'),
(34, 30, 'I', '2023-11-05'),
(35, 30, 'A', '2023-11-05');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ida`);

--
-- Index pour la table `articlespanier`
--
ALTER TABLE `articlespanier`
  ADD PRIMARY KEY (`idp`,`ida`),
  ADD KEY `ida` (`ida`);

--
-- Index pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD KEY `connexion_idm_FK` (`idm`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`idm`);

--
-- Index pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD PRIMARY KEY (`idp`),
  ADD KEY `idm` (`idm`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `ida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articlespanier`
--
ALTER TABLE `articlespanier`
  ADD CONSTRAINT `articlespanier_ibfk_1` FOREIGN KEY (`idp`) REFERENCES `paniers` (`idp`),
  ADD CONSTRAINT `articlespanier_ibfk_2` FOREIGN KEY (`ida`) REFERENCES `articles` (`ida`);

--
-- Contraintes pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD CONSTRAINT `connexion_idm_FK` FOREIGN KEY (`idm`) REFERENCES `membres` (`idm`);

--
-- Contraintes pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD CONSTRAINT `paniers_ibfk_1` FOREIGN KEY (`idm`) REFERENCES `membres` (`idm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
