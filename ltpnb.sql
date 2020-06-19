-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 12 juin 2020 à 17:27
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";




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
  `nom_capacite` varchar(250) NOT NULL,
  `intitule` varchar(250) NOT NULL,
  `id_competence` int(11) NOT NULL
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
  `nom_competence` varchar(250) NOT NULL,
  `intitule` varchar(250) NOT NULL,
  `id_capacite` int(11) NOT NULL
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
-- Structure de la table `tps`
--

DROP TABLE IF EXISTS `tps`;
CREATE TABLE IF NOT EXISTS `tps` (
  `id_tps` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tps` varchar(250) NOT NULL,
  PRIMARY KEY (`id_tps`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tps_note`
--

DROP TABLE IF EXISTS `tps_note`;
CREATE TABLE IF NOT EXISTS `tps_note` (
  `id_tp_note` int(11) NOT NULL AUTO_INCREMENT,
  `id_eleve` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `id_tp` int(11) NOT NULL,
  PRIMARY KEY (`id_tp_note`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


