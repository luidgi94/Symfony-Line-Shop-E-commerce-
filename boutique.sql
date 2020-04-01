-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 01 avr. 2020 à 11:39
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `console`
--

DROP TABLE IF EXISTS `console`;
CREATE TABLE IF NOT EXISTS `console` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `console`
--

INSERT INTO `console` (`id`, `product_name`, `price`, `quantity`, `description`, `image`) VALUES
(1, 'XBOX SERIES X', 499, 130, 'Découvrez la Xbox la plus rapide et la plus puissante de tous les temps avec la nouvelle Xbox Series X. Transformez votre expérience de jeu avec cette console ...\r\n', 'xbox.jpg'),
(2, 'NINTENDO SWITCH', 199, 50, 'Qu\'est-ce que la Nintendo Switch a de plus que les autres consoles ? Son principal atout est d\'être à la fois une console de salon et une console nomade.\r\n', 'switch.jpg'),
(3, 'PS4 PRO', 399, 25, ' La PS4 surpuissante offrant un rendu des images beaucoup plus proche de la façon dont nos yeux voient la réalité.', 'ps4.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_console` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`id`, `product_name`, `price`, `quantity`, `id_console`, `description`, `image`, `annee`) VALUES
(1, 'HALO INFINITE', 69, 120, 'XBOX', 'Halo Infinite est un un jeu vidéo de tir à la première personne développé par 343 Industries et édité par Xbox Game Studios. Sa sortie est prévue fin 2020.', 'halo.jpg', '2020-06-19'),
(2, 'FORZA HORIZON 4', 59, 230, 'XBOX', 'Collectionnez, modifiez et pilotez plus de 450 voitures. Course, coup de pub, création et exploration, tracez votre propre chemin pour devenir une star d\'Horizon.\r\n', 'forza.jpg', '2018-10-16'),
(3, 'MARIO KART', 29, 123, 'SWITCH', 'meilleur jeux de kart du monde ! sur nintendo !', 'mariokart.webp', '2019-01-23'),
(4, 'ZELDA BREATHE OF THE WILD', 59, 200, 'SWITCH', 'The Legend of Zelda : Breath of the Wild est un jeu d\'action/aventure. Link se réveille d\'un sommeil de 100 ans dans un royaume d\'Hyrule dévasté. Il lui faudra ...\r\n', 'zelda.jpg', '2017-10-19'),
(5, 'DRAGONBALL FIGHTER Z ', 49, 30, 'PS4', 'Dragon Ball FighterZ est un jeu de combat 2D développé par Arc System Works et édité par Bandai Namco. Cette nouvelle adaptation de la franchise Dragon ...\r\n', 'dbzPS4.jpg', '2017-06-22'),
(6, 'FAR CRY 5', 59, 45, 'PS4', 'Far Cry 5 est un FPS en monde ouvert sur PC, PS4 et Xbox One, édité par Ubisoft et développé par Ubisoft Montréal . Annoncé le 26 mai 2017, ...\r\n', 'farcry5ps4.jpg', '2019-06-18');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200330212900', '2020-03-30 21:29:11');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_order` datetime NOT NULL,
  `amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orderslines`
--

DROP TABLE IF EXISTS `orderslines`;
CREATE TABLE IF NOT EXISTS `orderslines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` int(11) NOT NULL,
  `city` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `username`, `firstname`, `address`, `postal_code`, `city`) VALUES
(3, 'aaa@afpa.fr', '[]', '$2y$13$/Y8.ctR0aX.kvPRQ6bftu.Y9ZQuXc5qldh4MtMIRH7IpYadsWuyvq', 'afpa_7755', 'Apfa_user', 'sdfd', 'dsf', 86468, 'sswf'),
(5, 'luid@live.fr', '[]', '$2y$13$CJBro4TU7xvDEXbfQFaYQuj2zkl80mvkCcEDWGzZGwtQ769kbX8Ha', 'luidgi', 'hgjkgh', 'ghfgh', 'dhfghfg', 91380, 'CHILLY MAZARIN');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
