-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 12 sep. 2019 à 14:24
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `monblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_billet`
--

DROP TABLE IF EXISTS `t_billet`;
CREATE TABLE IF NOT EXISTS `t_billet` (
  `BIL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `BIL_DATE` datetime NOT NULL,
  `BIL_TITRE` varchar(100) NOT NULL,
  `BIL_CONTENU` varchar(400) NOT NULL,
  PRIMARY KEY (`BIL_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_billet`
--

INSERT INTO `t_billet` (`BIL_ID`, `BIL_DATE`, `BIL_TITRE`, `BIL_CONTENU`) VALUES
(1, '2019-08-17 14:05:34', '<p>Premier billet(edited)</p>', '<p>Bonjour monde ! Ceci est le premier billet sur mon blog. dfskgnsdkfnglm</p>'),
(2, '2019-08-13 14:15:34', '<p>Au travail (edited)</p>', '<p>Il faut enrichir ce blog d&egrave;s maintenant. Tentative d\'edition</p>\r\n<p>edition tinyMCE ble ble ble</p>'),
(3, '2019-08-19 23:05:38', '<p>bonjour</p>', '<p><strong>j\'aime les pommes de terre</strong></p>'),
(4, '2019-09-06 15:30:06', '<p>sdmljkqsjd</p>', '<p>GSDFSQDFSDF</p>'),
(5, '2019-09-06 15:36:05', '<p>sdmljkqsjd</p>', '<p>GSDFSQDFSDF</p>');

-- --------------------------------------------------------

--
-- Structure de la table `t_commentaire`
--

DROP TABLE IF EXISTS `t_commentaire`;
CREATE TABLE IF NOT EXISTS `t_commentaire` (
  `COM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `COM_DATE` datetime NOT NULL,
  `COM_AUTEUR` varchar(100) NOT NULL,
  `COM_CONTENU` varchar(255) NOT NULL,
  `COM_STATUT` int(11) NOT NULL,
  `BIL_ID` int(11) NOT NULL,
  PRIMARY KEY (`COM_ID`),
  KEY `BIL_ID` (`BIL_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_commentaire`
--

INSERT INTO `t_commentaire` (`COM_ID`, `COM_DATE`, `COM_AUTEUR`, `COM_CONTENU`, `COM_STATUT`, `BIL_ID`) VALUES
(1, '2019-06-03 21:58:19', 'A. Nonyme', 'Bravo pour ce début', 1, 1),
(2, '2019-06-03 21:58:19', 'Moi', 'Merci ! Je vais continuer sur ma lancée', 1, 1),
(3, '2019-06-24 17:52:14', 'bonjour', 'dfssqdfqsdf', 2, 1),
(4, '2019-06-25 14:04:09', 'gfmlsdhfg', 'dsqfqsdfqs', 3, 1),
(5, '2019-08-06 13:56:55', 'gfmlsdhfg', 'qsdqDQSD', 1, 1),
(6, '2019-08-17 13:49:48', 'ludo', 'c\'est vrai c\'est plutot simpa dans les raclettes', 3, 3),
(7, '2019-08-20 14:31:31', 'fdqsfqsdf', 'qsdfqsdfqs', 0, 1),
(8, '2019-08-20 14:32:15', 'fdqsfqsdf', 'qsdfqsdfqs', 0, 1),
(9, '2019-08-20 14:34:41', 'fdqsfqsdf', 'qsdfqsdfqs', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_login`
--

DROP TABLE IF EXISTS `t_login`;
CREATE TABLE IF NOT EXISTS `t_login` (
  `LOG_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LOG_USER` varchar(100) NOT NULL,
  `LOG_PASS` varchar(100) NOT NULL,
  PRIMARY KEY (`LOG_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_login`
--

INSERT INTO `t_login` (`LOG_ID`, `LOG_USER`, `LOG_PASS`) VALUES
(1, 'Fromage', '$2y$12$Je/ECVsXnVG6hIjyFAbfZuATKJDXp//hquhdOmHrSwp.i4.9h8S6K');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
