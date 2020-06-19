-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 19 juin 2020 à 17:02
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
-- Structure de la table `capacite`
--

DROP TABLE IF EXISTS `capacite`;
CREATE TABLE IF NOT EXISTS `capacite` (
  `id_capacite` int(11) NOT NULL,
  `intitule` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id_classe` int(11) NOT NULL AUTO_INCREMENT,
  `nom_classe` varchar(250) NOT NULL,
  `annee` year(4) NOT NULL,
  PRIMARY KEY (`id_classe`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `id_competence` int(11) NOT NULL,
  `code_competence` varchar(250) NOT NULL,
  `intitule` varchar(250) NOT NULL,
  `id_capacite` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `competence_tp`
--

DROP TABLE IF EXISTS `competence_tp`;
CREATE TABLE IF NOT EXISTS `competence_tp` (
  `id_competence_tp` int(11) NOT NULL AUTO_INCREMENT,
  `id_tp` int(11) NOT NULL,
  `id_competence` int(11) NOT NULL,
  `barem_competence` int(11) NOT NULL,
  PRIMARY KEY (`id_competence_tp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `id_eleve` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `date_naissance` date NOT NULL,
  `id_binome` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `url_photo` varchar(250) NOT NULL,
  PRIMARY KEY (`id_eleve`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id_groupe` int(11) NOT NULL,
  `nom_groupe` varchar(250) NOT NULL,
  `id_classe` int(11) NOT NULL,
  PRIMARY KEY (`id_groupe`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mot_de_passe_admin`
--

DROP TABLE IF EXISTS `mot_de_passe_admin`;
CREATE TABLE IF NOT EXISTS `mot_de_passe_admin` (
  `id_mdp` int(11) NOT NULL AUTO_INCREMENT,
  `mot_de_passe` varchar(250) NOT NULL,
  PRIMARY KEY (`id_mdp`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mot_de_passe_admin`
--

INSERT INTO `mot_de_passe_admin` (`id_mdp`, `mot_de_passe`) VALUES
(1, 'theodorian');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `Nom` varchar(250) NOT NULL,
  `Prenom` varchar(250) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`Nom`, `Prenom`, `id`) VALUES
('Keurinck', 'Stephane', 1),
('Basuyaux', 'Jean-Philipe', 2);

-- --------------------------------------------------------

--
-- Structure de la table `tp`
--

DROP TABLE IF EXISTS `tp`;
CREATE TABLE IF NOT EXISTS `tp` (
  `id_tp` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tp` varchar(250) NOT NULL,
  `Domaine` varchar(250) NOT NULL,
  `numero` int(11) NOT NULL,
  `nom_fichier` varchar(250) NOT NULL,
  `descriprif` varchar(250) NOT NULL,
  PRIMARY KEY (`id_tp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tp_note`
--

DROP TABLE IF EXISTS `tp_note`;
CREATE TABLE IF NOT EXISTS `tp_note` (
  `id_tp_note` int(11) NOT NULL AUTO_INCREMENT,
  `id_eleve` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `id_tp` int(11) NOT NULL,
  `id_professeur` int(11) NOT NULL,
  PRIMARY KEY (`id_tp_note`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
