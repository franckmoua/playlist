-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 18 mai 2020 à 21:04
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `playlist`
--

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `year` varchar(225) NOT NULL,
  `artist_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `albums_artists_id` (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`id`, `name`, `year`, `artist_id`) VALUES
(1, 'Album test', '1524', 13),
(2, 'Meteora', '2003', 13),
(3, 'Human', '2015', 19);

-- --------------------------------------------------------

--
-- Structure de la table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `biography` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `label_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `artist_label_link` (`label_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `artists`
--

INSERT INTO `artists` (`id`, `name`, `biography`, `image`, `label_id`) VALUES
(13, 'Artiste test', 'qsf', NULL, 7),
(18, 'Linkin Park', 'Linkin Park is an American rock band from Agoura Hills.', NULL, 5),
(19, 'three days grace', 'three days grace is a rock band', NULL, 5),
(20, 'ko', '', NULL, 5),
(27, 'aezr', '<p style=\"color:red;\">test</p>', NULL, 5);

-- --------------------------------------------------------

--
-- Structure de la table `labels`
--

DROP TABLE IF EXISTS `labels`;
CREATE TABLE IF NOT EXISTS `labels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `labels`
--

INSERT INTO `labels` (`id`, `name`, `parent_id`) VALUES
(5, 'sony music', NULL),
(6, 'universal music', NULL),
(7, 'test', 5),
(8, 'sous-label de \"test', 7),
(9, 'Nirvana', NULL),
(10, 'Eminem', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE IF NOT EXISTS `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `album_link` (`album_id`),
  KEY `artist_link` (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist_id`, `album_id`) VALUES
(1, 'Don\'t leave me', 13, 1),
(2, 'Numb', 13, 2),
(3, 'qsfq', 27, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_artists_id` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `artists`
--
ALTER TABLE `artists`
  ADD CONSTRAINT `label_link` FOREIGN KEY (`label_id`) REFERENCES `labels` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `album_link` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artist_link` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
