-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 08 août 2020 à 07:38
-- Version du serveur :  5.7.24
-- Version de PHP :  7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ltpnb`
--

-- --------------------------------------------------------

--
-- Structure de la table `acquisition`
--

DROP TABLE IF EXISTS `acquisition`;
CREATE TABLE IF NOT EXISTS `acquisition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acquisition`
--

INSERT INTO `acquisition` (`id`, `nom`) VALUES
(3, 'A'),
(1, 'NA'),
(2, 'EA'),
(4, 'AM');

-- --------------------------------------------------------

--
-- Structure de la table `acquisition_tp_eleve`
--

DROP TABLE IF EXISTS `acquisition_tp_eleve`;
CREATE TABLE IF NOT EXISTS `acquisition_tp_eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eleve_id` int(11) NOT NULL,
  `competence_tp_id` int(11) NOT NULL,
  `acquisition_id` int(11) NOT NULL,
  `professeur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acquisition_tp_eleve`
--

INSERT INTO `acquisition_tp_eleve` (`id`, `eleve_id`, `competence_tp_id`, `acquisition_id`, `professeur_id`) VALUES
(72, 2, 4, 1, 1),
(71, 2, 3, 1, 1),
(70, 2, 2, 1, 1),
(69, 2, 1, 1, 1),
(68, 1, 4, 1, 1),
(67, 1, 3, 1, 1),
(66, 1, 2, 1, 1),
(65, 1, 1, 1, 1),
(64, 1, 7, 4, 1),
(63, 1, 6, 4, 1),
(62, 1, 5, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `capacite`
--

DROP TABLE IF EXISTS `capacite`;
CREATE TABLE IF NOT EXISTS `capacite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `capacite`
--

INSERT INTO `capacite` (`id`, `intitule`) VALUES
(1, 'C1 Communiquer, S\'informer'),
(2, 'savoir faire');

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_classe` varchar(255) NOT NULL,
  `annee` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `nom_classe`, `annee`) VALUES
(1, 'LA1', 2021),
(2, 'LA2', 2021);

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_competence` varchar(255) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `capacite_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_94D4687F7C79189D` (`capacite_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`id`, `code_competence`, `intitule`, `capacite_id`) VALUES
(1, 'C111', 'Collecter les donnees d\'identification', 1),
(2, 'C112', 'collecter les donnees technique et reglementaire', 1),
(3, 'SF02', 'percer un trou', 2),
(4, 'C121', 'Rendre compte de son intervention', 1);

-- --------------------------------------------------------

--
-- Structure de la table `competence_tp`
--

DROP TABLE IF EXISTS `competence_tp`;
CREATE TABLE IF NOT EXISTS `competence_tp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barem_competence` int(11) NOT NULL,
  `tp_id` int(11) DEFAULT NULL,
  `competence_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F0C0A5CA384F0DAC` (`tp_id`),
  KEY `IDX_F0C0A5CA15761DAB` (`competence_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competence_tp`
--

INSERT INTO `competence_tp` (`id`, `barem_competence`, `tp_id`, `competence_id`) VALUES
(1, 1, 1, 2),
(2, 5, 1, 3),
(3, 8, 1, 1),
(4, 6, 1, 4),
(5, 8, 2, 3),
(6, 7, 2, 4),
(7, 5, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `mail` varchar(255) NOT NULL,
  `url_photo` varchar(255) NOT NULL,
  `binome_id` int(11) DEFAULT NULL,
  `groupe_id` int(11) DEFAULT NULL,
  `classe_id` int(11) DEFAULT NULL,
  `couleur` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ECA105F78D4924C4` (`binome_id`),
  KEY `IDX_ECA105F77A45358C` (`groupe_id`),
  KEY `IDX_ECA105F78F5EA509` (`classe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `date_naissance`, `mail`, `url_photo`, `binome_id`, `groupe_id`, `classe_id`, `couleur`) VALUES
(1, 'keurinck', 'dorian', '1999-09-25', 'dorian.keurinck@gmail.com', 'data.jpg', 2, 1, 1, ''),
(2, 'branlant', 'theodorine', '2000-04-24', 'theodorine.branlant@gmail.com', 'data2.png', 1, 1, 1, ''),
(3, 'barczyk', 'alexandre', '2020-01-30', 'fsdgsdfhgsd', 'shdfshfsfh', 4, 1, 2, ''),
(4, 'perard', 'anschaire', '2020-08-27', 'srgdsqdfhs', 'dgs>gs', 3, 1, 2, '');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_groupe` varchar(255) NOT NULL,
  `classe_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4B98C218F5EA509` (`classe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nom_groupe`, `classe_id`) VALUES
(1, 'A1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `mot_de_passe_admin`
--

DROP TABLE IF EXISTS `mot_de_passe_admin`;
CREATE TABLE IF NOT EXISTS `mot_de_passe_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mot_de_passe_admin`
--

INSERT INTO `mot_de_passe_admin` (`id`, `mot_de_passe`) VALUES
(1, 'theodorian');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`nom`, `prenom`, `id`) VALUES
('Keurinck', 'Stephane', 1),
('Basuyaux', 'Jean-Philipe', 2);

-- --------------------------------------------------------

--
-- Structure de la table `tp`
--

DROP TABLE IF EXISTS `tp`;
CREATE TABLE IF NOT EXISTS `tp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tp` varchar(255) NOT NULL,
  `domaine` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `nom_fichier` varchar(255) NOT NULL,
  `descriptif` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tp`
--

INSERT INTO `tp` (`id`, `nom_tp`, `domaine`, `numero`, `nom_fichier`, `descriptif`) VALUES
(1, 'exemple1', 'astro', 1, 'blabla.txt', 'sdoighoshgj'),
(2, 'exmple2', 'bla', 2, 'osldgiqh.txt', 'zrfsghsfh'),
(3, 'dqfdqd', 'qddqgcq', 3, 'qdgqchsc', 'qhgfchchc');

-- --------------------------------------------------------

--
-- Structure de la table `tp_note`
--

DROP TABLE IF EXISTS `tp_note`;
CREATE TABLE IF NOT EXISTS `tp_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` decimal(4,2) DEFAULT NULL,
  `eleve_id` int(11) DEFAULT NULL,
  `tp_id` int(11) DEFAULT NULL,
  `professeur_id` int(11) DEFAULT NULL,
  `etat` varchar(250) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DAD35B95A6CC7B2` (`eleve_id`),
  KEY `IDX_DAD35B95384F0DAC` (`tp_id`),
  KEY `IDX_DAD35B95ABC1F7FE` (`professeur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tp_note`
--

INSERT INTO `tp_note` (`id`, `note`, `eleve_id`, `tp_id`, `professeur_id`, `etat`, `date`) VALUES
(51, '0.00', 1, 1, 1, 'noté', '2020-08-07'),
(52, '0.00', 2, 1, 1, 'noté', '2020-08-07'),
(50, NULL, 2, 2, 1, 'abs', '2020-07-28'),
(49, '20.00', 1, 2, 1, 'noté', '2020-07-28');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
