-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 30 août 2020 à 14:33
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

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
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `capacite`
--

DROP TABLE IF EXISTS `capacite`;
CREATE TABLE IF NOT EXISTS `capacite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `capacite`
--

INSERT INTO `capacite` (`id`, `intitule`) VALUES
(6, 'C11: Communiquer'),
(7, 'C12: S\'informer'),
(8, 'C21: Préparer son intervention'),
(9, 'C22: Diagnostiquer un dysfonctionnement mécanique'),
(10, 'C31: Remettre en conformité les systèmes, ensembles et sous ensembles'),
(11, 'C32: Effectuer les mesures'),
(12, 'C33: effectuer les mesures'),
(13, 'C34: Régler, paramétrer un système'),
(14, 'C35: Préparer le véhicule'),
(15, 'C36: Gérer son poste de travail');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `nom_classe`, `annee`) VALUES
(3, '1 CAP G1 et G2', 2021),
(4, '1 CAP G3', 2021),
(5, 'T CAP', 2021);

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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`id`, `code_competence`, `intitule`, `capacite_id`) VALUES
(7, 'C121', 'Rendre compte de son intervention', 7),
(6, 'C112', 'Collecter les données techniques et réglementaires', 6),
(5, 'C111', 'Collecter les données d\'identification', 6),
(8, 'C122', 'Compléter un ordre de réparation, bon de commande', 7),
(9, 'C123', 'Utiliser les moyens de communication de l\'entreprise', 7),
(10, 'C211', 'Localiser sur le véhicule, les sous-ensembles, les éléments, les fluides', 8),
(11, 'C212', 'Identifier les étapes de l\'intervention', 8),
(12, 'C213', 'Choisir les équipements, les outillages', 8),
(13, 'C214', 'Collecter les pièces, les produits', 8),
(14, 'C221', 'Constater le dysfonctionnement, une anomalies', 9),
(15, 'C222', 'Comparer les résultats des mesures, contrôles et essais avec valeurs attendues', 9),
(16, 'C223', 'Identifier les sous-ensembles les éléments ou fluides defectueux', 9),
(17, 'C311', 'Remplacer les sous-ensembles, les éléments, les fluides', 10),
(18, 'C312', 'Réparer les sous-ensembles, les éléments', 10),
(19, 'C321', 'Effectuer les mesures', 11),
(20, 'C331', 'Effectuer les contrôles, les essais', 12),
(21, 'C341', 'Effectuer les réglages des différents systèmes', 13),
(22, 'C342', 'Mettre à jour les indicateurs de maintenance', 13),
(23, 'C351', 'Préparer le véhicule pour l\'intervention', 14),
(24, 'C352', 'Préparer le véhicule pour la restitution', 14),
(25, 'C361', 'Gérer son poste de travail', 15),
(26, 'C362', 'Maintenir en état son poste de travail', 15),
(27, 'C363', 'Appliquer les règles en lien avec l\'hygiène, la santé, la sécurité et l\'environnement', 15);

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
) ENGINE=MyISAM AUTO_INCREMENT=466 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competence_tp`
--

INSERT INTO `competence_tp` (`id`, `barem_competence`, `tp_id`, `competence_id`) VALUES
(457, 13, 17, 6),
(456, 1, 16, 26),
(455, 14, 16, 25),
(454, 1, 16, 23),
(453, 1, 16, 17),
(452, 1, 16, 5),
(451, 9, 15, 11),
(450, 9, 15, 7),
(449, 2, 15, 6),
(448, 5, 14, 7),
(447, 5, 14, 6),
(446, 5, 14, 5),
(445, 5, 14, 9),
(444, 4, 13, 9),
(443, 2, 13, 6),
(442, 4, 13, 7),
(441, 10, 13, 10),
(440, 5, 12, 9),
(439, 5, 12, 7),
(438, 4, 11, 25),
(437, 8, 11, 23),
(436, 4, 11, 6),
(435, 4, 11, 5),
(434, 7, 9, 11),
(433, 6, 9, 5),
(432, 20, 8, 5),
(431, 20, 7, 5),
(430, 5, 6, 10),
(429, 5, 6, 8),
(428, 8, 6, 5),
(427, 2, 6, 6),
(426, 4, 5, 14),
(425, 16, 5, 8),
(424, 5, 4, 16),
(423, 13, 4, 6),
(422, 2, 4, 11),
(51, 7, 17, 12),
(52, 17, 19, 6),
(53, 3, 19, 19),
(54, 12, 20, 5),
(55, 2, 20, 6),
(56, 3, 20, 10),
(57, 3, 20, 25),
(58, 4, 21, 5),
(59, 4, 21, 6),
(60, 2, 21, 26),
(61, 10, 21, 17),
(62, 3, 22, 6),
(63, 13, 22, 17),
(64, 2, 22, 25),
(65, 2, 22, 26),
(66, 5, 24, 9),
(67, 10, 24, 8),
(68, 5, 24, 7),
(69, 2, 25, 6),
(70, 2, 25, 5),
(71, 10, 26, 7),
(72, 10, 26, 9),
(73, 15, 27, 9),
(74, 5, 27, 7),
(75, 5, 28, 7),
(76, 15, 28, 9),
(77, 13, 29, 6),
(78, 5, 29, 19),
(79, 2, 29, 25),
(80, 3, 30, 6),
(81, 2, 30, 8),
(82, 3, 30, 10),
(83, 6, 30, 17),
(84, 1, 30, 26),
(85, 3, 30, 22),
(86, 1, 30, 25),
(87, 1, 30, 24),
(88, 2, 31, 5),
(89, 2, 31, 8),
(90, 2, 31, 10),
(91, 10, 31, 17),
(92, 2, 31, 25),
(93, 2, 31, 26),
(94, 5, 32, 6),
(95, 3, 32, 17),
(96, 1, 32, 19),
(97, 8, 32, 20),
(98, 1, 32, 25),
(99, 2, 32, 26),
(100, 4, 33, 6),
(101, 4, 33, 19),
(102, 6, 33, 17),
(103, 4, 33, 20),
(104, 1, 33, 25),
(105, 1, 33, 26),
(106, 2, 18, 5),
(107, 3, 18, 6),
(108, 1, 18, 8),
(109, 13, 18, 17),
(110, 1, 18, 26),
(111, 2, 34, 5),
(112, 4, 34, 10),
(113, 10, 34, 17),
(114, 4, 34, 26),
(115, 4, 35, 6),
(116, 2, 35, 8),
(117, 10, 35, 17),
(118, 1, 35, 25),
(119, 2, 35, 23),
(120, 1, 35, 26),
(121, 10, 36, 6),
(122, 10, 36, 19),
(123, 7, 37, 5),
(124, 3, 37, 10),
(125, 7, 37, 17),
(126, 3, 37, 26),
(127, 7, 38, 6),
(128, 9, 38, 17),
(129, 2, 38, 26),
(130, 2, 38, 25),
(131, 2, 39, 9),
(132, 4, 39, 7),
(133, 10, 39, 6),
(134, 4, 39, 27),
(135, 1, 40, 5),
(136, 2, 40, 10),
(137, 2, 40, 6),
(138, 8, 40, 17),
(139, 7, 40, 26),
(140, 2, 41, 5),
(141, 2, 41, 10),
(142, 2, 41, 6),
(143, 10, 41, 17),
(144, 2, 41, 25),
(145, 2, 41, 26),
(146, 1, 42, 5),
(147, 5, 42, 6),
(148, 10, 42, 17),
(149, 2, 42, 25),
(150, 2, 42, 26),
(151, 2, 43, 6),
(152, 2, 43, 7),
(153, 2, 43, 8),
(154, 8, 43, 17),
(155, 4, 43, 20),
(156, 1, 43, 25),
(157, 1, 43, 26),
(158, 3, 44, 6),
(159, 3, 44, 10),
(160, 4, 45, 6),
(161, 2, 45, 5),
(162, 5, 45, 19),
(163, 6, 45, 20),
(164, 2, 46, 5),
(165, 2, 46, 6),
(166, 4, 46, 20),
(167, 2, 46, 26),
(168, 2, 46, 25),
(169, 2, 47, 5),
(170, 2, 47, 10),
(171, 7, 47, 17),
(172, 4, 47, 26),
(173, 6, 48, 6),
(174, 1, 48, 5),
(175, 5, 48, 17),
(176, 5, 48, 20),
(177, 3, 48, 26),
(178, 3, 49, 6),
(179, 10, 49, 17),
(180, 5, 49, 21),
(181, 1, 49, 25),
(182, 1, 49, 26),
(183, 2, 50, 5),
(184, 5, 50, 10),
(185, 4, 50, 26),
(186, 1, 51, 10),
(187, 2, 51, 6),
(188, 3, 51, 5),
(189, 10, 51, 20),
(190, 4, 51, 26),
(191, 6, 52, 10),
(192, 4, 52, 5),
(193, 4, 52, 7),
(194, 4, 52, 6),
(195, 2, 52, 26),
(196, 6, 53, 6),
(197, 14, 53, 11),
(198, 3, 54, 5),
(199, 5, 54, 6),
(200, 10, 54, 17),
(201, 2, 54, 25),
(202, 2, 54, 26),
(203, 5, 54, 20),
(204, 3, 55, 5),
(205, 3, 55, 6),
(206, 10, 55, 17),
(207, 2, 55, 25),
(208, 2, 55, 26),
(209, 2, 23, 6),
(210, 1, 23, 26),
(211, 1, 23, 25),
(212, 6, 23, 20),
(213, 8, 23, 17),
(214, 2, 56, 6),
(215, 6, 56, 19),
(216, 8, 56, 21),
(217, 2, 56, 25),
(218, 2, 56, 26),
(219, 6, 57, 6),
(220, 3, 57, 8),
(221, 7, 57, 17),
(222, 2, 57, 25),
(223, 2, 57, 26),
(224, 2, 58, 6),
(225, 2, 58, 5),
(226, 4, 58, 7),
(227, 4, 58, 8),
(228, 4, 58, 23),
(229, 4, 58, 24),
(230, 7, 59, 6),
(231, 7, 59, 17),
(232, 4, 59, 21),
(233, 1, 59, 25),
(234, 1, 59, 26),
(235, 2, 60, 6),
(236, 8, 60, 11),
(237, 8, 60, 20),
(238, 2, 60, 26),
(239, 2, 61, 8),
(240, 2, 61, 10),
(241, 2, 61, 6),
(242, 4, 61, 16),
(243, 6, 61, 18),
(244, 2, 61, 25),
(245, 2, 61, 26),
(246, 5, 62, 6),
(247, 8, 62, 17),
(248, 4, 62, 20),
(249, 1, 62, 25),
(250, 2, 62, 26),
(251, 4, 63, 6),
(252, 12, 63, 11),
(253, 6, 64, 6),
(254, 7, 64, 10),
(255, 7, 64, 11),
(256, 1, 65, 6),
(257, 2, 65, 10),
(258, 5, 65, 16),
(259, 10, 65, 17),
(260, 1, 65, 25),
(261, 1, 65, 26),
(262, 4, 66, 5),
(263, 2, 66, 10),
(264, 4, 66, 6),
(265, 5, 66, 17),
(266, 2, 66, 21),
(267, 1, 66, 25),
(268, 2, 66, 26),
(269, 1, 67, 5),
(270, 1, 67, 6),
(271, 2, 67, 8),
(272, 2, 67, 14),
(273, 2, 67, 16),
(274, 8, 67, 20),
(275, 2, 67, 25),
(276, 2, 67, 26),
(277, 5, 68, 6),
(278, 1, 68, 7),
(279, 2, 68, 8),
(280, 4, 68, 17),
(281, 6, 68, 19),
(282, 1, 68, 25),
(283, 1, 68, 26),
(284, 3, 69, 5),
(285, 4, 69, 8),
(286, 3, 69, 6),
(287, 10, 69, 17),
(288, 2, 70, 6),
(289, 1, 70, 5),
(290, 1, 70, 10),
(291, 1, 70, 15),
(292, 6, 70, 19),
(293, 6, 70, 20),
(294, 3, 70, 26),
(295, 2, 71, 5),
(296, 1, 71, 6),
(297, 1, 71, 10),
(298, 8, 71, 19),
(299, 7, 71, 20),
(300, 1, 71, 26),
(301, 4, 72, 8),
(302, 4, 72, 6),
(303, 2, 72, 26),
(304, 5, 72, 20),
(305, 5, 72, 21),
(306, 2, 73, 6),
(307, 2, 73, 5),
(308, 2, 73, 10),
(309, 5, 73, 17),
(310, 5, 73, 20),
(311, 2, 73, 23),
(312, 2, 73, 26),
(313, 2, 74, 6),
(314, 3, 74, 10),
(315, 10, 74, 17),
(316, 2, 75, 5),
(317, 1, 75, 7),
(318, 2, 75, 25),
(319, 2, 75, 26),
(320, 11, 75, 20),
(321, 1, 75, 16),
(322, 4, 76, 6),
(323, 4, 76, 5),
(324, 4, 76, 7),
(325, 4, 76, 10),
(326, 4, 76, 9),
(327, 2, 77, 5),
(328, 2, 77, 10),
(329, 2, 77, 15),
(330, 4, 77, 20),
(331, 2, 77, 23),
(332, 1, 77, 25),
(333, 1, 77, 26),
(334, 5, 91, 5),
(335, 5, 91, 10),
(336, 9, 91, 19),
(337, 1, 91, 26),
(338, 3, 78, 6),
(339, 10, 78, 19),
(340, 4, 78, 26),
(341, 6, 79, 6),
(342, 10, 79, 21),
(343, 4, 79, 26),
(344, 3, 80, 5),
(345, 3, 80, 6),
(346, 3, 80, 15),
(347, 11, 80, 19),
(348, 3, 81, 5),
(349, 3, 81, 6),
(350, 3, 81, 15),
(351, 11, 81, 19),
(352, 4, 82, 6),
(353, 6, 82, 17),
(354, 6, 82, 20),
(355, 2, 82, 25),
(356, 2, 82, 26),
(357, 1, 83, 5),
(358, 2, 83, 7),
(359, 2, 83, 8),
(360, 2, 83, 26),
(361, 10, 83, 19),
(362, 2, 84, 5),
(363, 3, 84, 6),
(364, 2, 84, 8),
(365, 2, 84, 7),
(366, 1, 84, 11),
(367, 8, 84, 19),
(368, 2, 84, 26),
(369, 3, 85, 6),
(370, 2, 85, 7),
(371, 11, 85, 20),
(372, 2, 85, 26),
(373, 2, 85, 25),
(374, 3, 86, 6),
(375, 2, 86, 8),
(376, 3, 86, 11),
(377, 11, 86, 19),
(378, 1, 86, 26),
(379, 3, 87, 5),
(380, 3, 87, 6),
(381, 10, 87, 17),
(382, 2, 87, 25),
(383, 2, 87, 26),
(384, 7, 88, 10),
(385, 6, 88, 5),
(386, 7, 88, 11),
(387, 2, 89, 5),
(388, 4, 89, 6),
(389, 4, 89, 10),
(390, 8, 89, 11),
(391, 5, 90, 11),
(392, 3, 90, 12),
(393, 10, 90, 18),
(394, 1, 90, 25),
(395, 1, 90, 26),
(396, 4, 92, 6),
(397, 10, 92, 17),
(398, 2, 92, 26),
(399, 4, 93, 6),
(400, 10, 93, 17),
(401, 4, 93, 7),
(402, 2, 93, 26),
(403, 4, 94, 6),
(404, 4, 95, 6),
(405, 4, 95, 7),
(406, 10, 95, 17),
(407, 2, 95, 26),
(408, 4, 96, 6),
(409, 4, 96, 7),
(410, 10, 96, 17),
(411, 2, 96, 26),
(412, 4, 97, 7),
(413, 2, 97, 26),
(414, 4, 98, 7),
(415, 4, 98, 6),
(416, 10, 98, 17),
(417, 2, 98, 26),
(418, 4, 99, 6),
(419, 4, 99, 7),
(420, 10, 99, 17),
(421, 2, 99, 26),
(458, 4, 100, 6),
(459, 4, 100, 7),
(460, 10, 100, 17),
(461, 2, 100, 26),
(462, 4, 101, 6),
(463, 4, 101, 7),
(464, 10, 101, 17),
(465, 2, 101, 26);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_naissance` datetime DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `url_photo` varchar(255) DEFAULT NULL,
  `binome_id` int(11) DEFAULT NULL,
  `groupe_id` int(11) DEFAULT NULL,
  `classe_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ECA105F78D4924C4` (`binome_id`),
  KEY `IDX_ECA105F77A45358C` (`groupe_id`),
  KEY `IDX_ECA105F78F5EA509` (`classe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `date_naissance`, `mail`, `url_photo`, `binome_id`, `groupe_id`, `classe_id`) VALUES
(9, 'BILLAU', 'Lucas', '1956-04-08 00:00:00', NULL, 'Billau.JPG', 10, NULL, 5),
(10, 'BERTH', 'David', NULL, NULL, NULL, 9, NULL, 5),
(30, 'TULLIER', 'Nathan', NULL, NULL, NULL, 31, NULL, 4),
(12, 'BRUNIN', 'Mathys', NULL, NULL, 'Brunin.JPG', 13, NULL, 5),
(13, 'BUCHON', 'Théo', NULL, NULL, NULL, 12, NULL, 5),
(14, 'CHARLES', 'Steevy', NULL, NULL, NULL, 15, NULL, 5),
(15, 'CHOQUET', 'Vianney', NULL, NULL, NULL, 14, NULL, 5),
(16, 'COURBY', 'Théo', NULL, NULL, NULL, 17, NULL, 5),
(17, 'DELECROIX', 'Paul', NULL, NULL, NULL, 16, NULL, 5),
(18, 'DUTHOIT', 'Jérémy', NULL, NULL, NULL, 19, NULL, 5),
(19, 'DUVAL', 'Enzo', NULL, NULL, NULL, 18, NULL, 5),
(20, 'IVART', 'Gauthier', NULL, NULL, NULL, 21, NULL, 5),
(21, 'LEMOINE', 'Thomas', NULL, NULL, NULL, 20, NULL, 5),
(22, 'VERMON', 'Hugo', NULL, NULL, NULL, 23, NULL, 5),
(23, 'MENIN', 'Vincent', NULL, NULL, NULL, 22, NULL, 5),
(24, 'MESURE', 'Gwendal', NULL, NULL, NULL, 25, NULL, 5),
(25, 'PECQUEUX', 'Nathan', NULL, NULL, NULL, 24, NULL, 5),
(26, 'PLOEGAERTS', 'Victor', NULL, NULL, NULL, 27, NULL, 5),
(27, 'SENECHAL', 'Brandon', NULL, NULL, NULL, 26, NULL, 5),
(28, 'THOREZ', 'Victorien', NULL, NULL, NULL, 29, NULL, 5),
(29, 'VERCHELDE', 'Lucas', NULL, NULL, NULL, 28, NULL, 5),
(31, 'TURBE', 'Noa', NULL, NULL, NULL, 30, NULL, 4),
(32, 'VERSTRAETE', 'Carl', NULL, NULL, NULL, 32, NULL, 4),
(33, 'XXX', 'KKK', NULL, NULL, NULL, 34, NULL, 3),
(34, 'AAA', 'JJJ', NULL, NULL, NULL, 33, NULL, 3);

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
(1, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

DROP TABLE IF EXISTS `niveau`;
CREATE TABLE IF NOT EXISTS `niveau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`id`, `nom`) VALUES
(1, 'Découverte de l\'automobile'),
(2, 'Initiation à la réparation'),
(3, 'Perfectionnement à la réparation'),
(4, 'Contrôle, réglage, mesure'),
(5, 'Révision'),
(6, 'Approfondissement à la réparation'),
(7, 'Sujet d\'examen'),
(8, 'Préparation au bac pro');

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

DROP TABLE IF EXISTS `planning`;
CREATE TABLE IF NOT EXISTS `planning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couleur` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `classe_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `planning`
--

INSERT INTO `planning` (`id`, `couleur`, `date`, `classe_id`) VALUES
(1, '#ff0000', '2020-01-01', 5),
(2, '#00ff00', '2020-01-02', 5),
(3, '#0000ff', '2020-01-03', 5),
(4, '#ffff00', '2020-01-04', 5),
(5, '#ff00ff', '2020-01-05', 5),
(6, '#ff00a2', '2020-01-06', 5),
(7, '#00fffb', '2020-01-07', 5),
(8, '#76789e', '2020-01-08', 5),
(9, '#7343a3', '2020-01-09', 5),
(10, '#b48e8e', '2020-01-10', 5),
(11, '#ff9500', '2020-01-01', 3),
(12, '#66abf5', '2020-01-12', 5),
(13, '#dcf9dd', '2020-01-13', 5),
(14, '#cac0ce', '2020-01-14', 5),
(22, '#b7c21e', '2020-01-18', 5),
(21, '#6e6fbf', '2020-01-17', 5),
(20, '#1cb55e', '2020-01-16', 5),
(19, '#d51010', '2020-01-15', 5),
(23, '#d279c8', '2020-01-19', 5),
(24, '#14d8db', '2020-01-20', 5),
(25, '#b98b27', '2020-01-21', 5),
(26, '#1fa866', '2020-01-22', 5),
(27, '#b65858', '2020-01-23', 5),
(28, '#6280a7', '2020-01-24', 5),
(29, '#869730', '2020-01-25', 5),
(30, '#ff0000', '2022-06-19', 4);

-- --------------------------------------------------------

--
-- Structure de la table `planning_eleve`
--

DROP TABLE IF EXISTS `planning_eleve`;
CREATE TABLE IF NOT EXISTS `planning_eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eleve_id` int(11) NOT NULL,
  `planning_id` int(11) DEFAULT NULL,
  `binome_id` int(11) NOT NULL,
  `tp_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=328 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `planning_eleve`
--

INSERT INTO `planning_eleve` (`id`, `eleve_id`, `planning_id`, `binome_id`, `tp_id`) VALUES
(203, 20, 1, 21, 97),
(198, 9, 1, 10, 92),
(199, 12, 1, 13, 93),
(201, 16, 1, 17, 95),
(202, 18, 1, 19, 96),
(204, 22, 1, 23, 98),
(205, 24, 1, 25, 100),
(206, 26, 1, 27, 101),
(207, 28, 1, 29, 102),
(208, 14, 1, 15, 94),
(209, 9, 2, 10, 93),
(210, 9, 3, 10, 94),
(211, 9, 4, 10, 95),
(212, 9, 5, 10, 96),
(213, 9, 6, 10, 97),
(214, 9, 7, 10, 98),
(215, 9, 8, 10, 100),
(216, 9, 9, 10, 101),
(217, 9, 10, 10, 102),
(218, 12, 2, 13, 94),
(219, 12, 3, 13, 95),
(220, 12, 4, 13, 96),
(229, 12, 6, 13, 98),
(228, 12, 5, 13, 97),
(223, 12, 7, 13, 100),
(224, 12, 8, 13, 101),
(225, 12, 9, 13, 102),
(226, 12, 10, 13, 92),
(230, 14, 2, 15, 95),
(231, 14, 3, 15, 96),
(232, 14, 4, 15, 97),
(234, 14, 5, 15, 98),
(235, 14, 6, 15, 100),
(236, 14, 7, 15, 101),
(237, 14, 8, 15, 102),
(238, 14, 9, 15, 92),
(239, 14, 10, 15, 93),
(240, 16, 2, 17, 96),
(241, 16, 3, 17, 97),
(242, 16, 4, 17, 98),
(243, 16, 5, 17, 100),
(244, 16, 6, 17, 101),
(245, 16, 7, 17, 102),
(246, 16, 8, 17, 92),
(247, 16, 9, 17, 93),
(248, 16, 10, 17, 94),
(249, 18, 2, 19, 97),
(250, 18, 3, 19, 98),
(251, 18, 4, 19, 100),
(252, 18, 5, 19, 101),
(253, 18, 6, 19, 102),
(254, 18, 7, 19, 92),
(255, 18, 8, 19, 93),
(256, 18, 9, 19, 94),
(257, 18, 10, 19, 95),
(258, 20, 2, 21, 98),
(259, 20, 3, 21, 100),
(260, 20, 4, 21, 101),
(261, 20, 5, 21, 102),
(262, 20, 6, 21, 92),
(263, 20, 7, 21, 93),
(264, 20, 8, 21, 94),
(265, 20, 9, 21, 95),
(266, 20, 10, 21, 96),
(267, 22, 2, 23, 100),
(268, 22, 3, 23, 101),
(269, 22, 4, 23, 92),
(270, 22, 5, 23, 92),
(271, 22, 6, 23, 93),
(272, 22, 7, 23, 94),
(273, 22, 8, 23, 95),
(274, 22, 9, 23, 96),
(275, 22, 10, 23, 97),
(276, 22, 4, 23, 102),
(277, 24, 2, 25, 101),
(278, 24, 3, 25, 102),
(279, 24, 4, 25, 92),
(280, 24, 5, 25, 93),
(281, 24, 6, 25, 94),
(282, 24, 7, 25, 95),
(283, 24, 8, 25, 96),
(284, 24, 9, 25, 97),
(285, 24, 10, 25, 98),
(286, 26, 2, 27, 102),
(287, 26, 3, 27, 92),
(288, 26, 4, 27, 93),
(289, 26, 5, 27, 94),
(290, 26, 6, 27, 95),
(291, 26, 7, 27, 96),
(292, 26, 8, 27, 97),
(293, 26, 9, 27, 98),
(294, 26, 10, 27, 100),
(295, 28, 2, 29, 92),
(296, 28, 3, 29, 93),
(297, 28, 4, 29, 94),
(298, 28, 5, 29, 95),
(303, 28, 6, 29, 96),
(304, 28, 7, 29, 97),
(305, 28, 8, 29, 98),
(306, 28, 9, 29, 100),
(307, 28, 10, 29, 101),
(309, 33, 11, 34, 5),
(310, 33, 12, 34, 4),
(311, 33, 13, 34, 6),
(312, 33, 14, 34, 7),
(313, 33, 19, 34, 8),
(314, 33, 20, 34, 9),
(324, 33, 25, 34, 14),
(323, 33, 24, 34, 13),
(322, 33, 23, 34, 12),
(321, 33, 22, 34, 11),
(320, 33, 21, 34, 10),
(325, 33, 25, 34, 15),
(326, 33, 27, 34, 16),
(327, 33, 28, 34, 17);

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
  `niveau_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tp`
--

INSERT INTO `tp` (`id`, `nom_tp`, `domaine`, `numero`, `nom_fichier`, `descriptif`, `niveau_id`) VALUES
(5, 'Carte grise', 'Service gestion', 2, 'AS102-carte', 'L’élève doit être capable de prendre de compléter toutes les informations afin d\'établir les documents obligatoires', 1),
(4, 'Hygiènne et Sécurité', 'Service travail', 1, 'AS101-Hyg', 'L’élève doit être capable de conaitre les règles de sécurité, maitriser la signalétique, lire et décoder les infos sur un extincteur', 1),
(6, 'Réception véhicule', 'Service gestion', 3, 'AS103-recep', 'L’élève doit être capable de décoder une carte grise afin d\'en sortir les documents comptable', 1),
(7, 'Reconaitre une carrosserie', 'Service gestion', 4, 'AS104-carro', 'L’élève doit être capable de reconnaitre toutes les formes de voitures en vue compléter les OR, les devis, les factures et retrouver les manuels de réparation', 1),
(8, 'Identifier les caractéristiques véhicule', 'Service gestion', 5, 'AS105-ident', 'L’élève doit être capable de préparer le véhicule et compléter les documents', 1),
(9, 'Utiliser un cric rouleur', 'Service travail', 6, 'AS106-cric', 'L’élève doit être capable de positionner un cric sous le véhicule et remplacer une roue', 1),
(10, 'utiliser un pont élévateur', 'Service travail', 7, 'AS107-pont', 'L’élève doit identifier les points de levage', 1),
(11, 'déposer et reposer une roue', 'Service travail', 8, 'AS108-depo', 'L’élève doit déposer et reposer une roue', 1),
(12, 'poste de conduite', 'Service travail', 9, 'AS109-post', 'L’élève doit être capable d\'identifier les éléments du tableau de bord', 1),
(13, 'Localiser un élément', 'Service travail', 10, 'AS110-local', 'L’élève doit être capable de retrouver l’emplacement des éléments d’une voiture', 1),
(14, 'éléments sous capot', 'Service travail', 11, 'AS111-capo', 'L’élève doit être capable de nommer chacun des éléments du moteur et de reconnaître un moteur diesel ou essence', 1),
(15, 'Choix de son équipement', 'Service travail', 12, 'AS112-équip', 'L’élève doit être capable de choisir le meilleur équipement pour travailler dans de bonne condition à l’atelier.', 1),
(16, 'Préparer son poste de travail', 'Service travail', 13, 'AS113-poste', 'L’élève doit être capable de comprendre la procédure, préparer le véhicule à l’intervention, sélectionner son outillage, lever le véhicule en toute sécurité et ranger son matériel après son intervention', 1),
(17, 'Sélection outillage', 'Service travail', 14, 'AS114-outi', 'L’élève doit être capable de reconnaitre tout l’outillage de l’atelier, choisir les outils les plus adapter à l’intervention.', 1),
(18, 'effectuer les opérations d\'entretiens périodiques', 'Motorisation', 29, 'MA101-entr', 'L’élève doit localiser identifier et effectuer un entretien périodique', 6),
(19, 'Le multimètre', 'Gestion énergie électrique', 15, 'GE101-multi', 'L’élève doit être capable d\'identifié les différentes unités de mesure électriques et de les relevés', 2),
(20, 'Remplacement de roulement de roue', 'Liaison au sol', 16, 'LS101-roul', 'L’élève doit identifier contrôler et remplacer un roulement', 2),
(21, 'remise en conformité d\'une ligne d\'échappement', 'Motorisation', 17, 'MA102-echap', 'L’élève doit identifier localiser et remplacer un élément de la ligne d\'échappement', 2),
(22, 'Remise en conformité des Freins', 'Freinage', 18, 'F101-avant', 'L’élève doit être capable de vérifier l’état des disques et plaquettes et de les remplacer', 2),
(23, 'Contrôle frein tambour', 'Freinage', 52, 'F106-tamb', 'L’élève doit être capable de contrôler l’état des freins tambours et de les remplacer', 3),
(24, 'Compléter un OR', 'Service gestion', 19, 'AS123-OR', 'L’élève doit être capable de compléter un O.R. sans erreur', 2),
(25, 'Remplacement amortisseur AR', 'Liaison au sol', 20, 'LS102-amoar', 'L’élève doit être capable de choisir le meilleur équipement pour travailler dans de bonne condition à l’atelier.', 2),
(26, 'Revue technique informatique', 'Service gestion', 21, 'AS115-reor', 'L’élève doit être capable de rechercher des informations sur une revue technique', 2),
(27, 'Caractéristique pneu', 'Liaison au sol', 22, 'LS105-capneu', 'L’élève doit être capable de contrôler l’état d\'un pneumatique et de relever ses caractéristiques', 2),
(28, 'Equipement d\'un atelier de maintenance', 'Service travail', 23, 'AS116-équip', 'L’élève doit être capable de Reconnaitre des équipements, Donner leur fonction, Les situer sur un plan', 6),
(29, 'Serrage contrôlé', 'Service travail', 24, 'AS117-serco', 'L’élève doit être capable de serrer au couple au moyen d’une clé dynamométrique ou d’une clé angulaire afin de respecter les données constructeur', 6),
(30, 'Remplacement rotule', 'Liaison au sol', 25, 'LS104-rotu', 'L’élève doit être capable de déposer une rotule de direction et de la remonter à son état initial', 6),
(31, 'Filtration', 'Motorisation', 26, 'MA103-filt', 'L’élève doit être capable d\'identifier, localiser et remplacer les filtres', 6),
(32, 'Contrôler La culasse', 'Motorisation', 27, 'MA105-culas', 'L’élève doit être capable de contrôler l’état de surface d’une culasse', 6),
(33, 'La cylindrée', 'Motorisation', 28, 'MA107-cyle', 'L’élève doit être capable de relever les caractéristiques du moteur', 6),
(34, 'dépose démarreur', 'Gestion énergie électrique', 30, 'GE102-dem', 'L’élève doit déposer et reposer un démarreur', 6),
(35, 'Remplacement pneu', 'Liaison au sol', 31, 'LS106-repneu', 'L’élève doit être capable de déposer, remplacer et remonter une enveloppe dans les règles de l’art', 6),
(36, 'Les appareils de mesure mécanique', 'Service travail', 32, 'AS118-mesu', 'L’élève doit être capable de connaitre et utiliser tous les appareils de mesure de pièces mécaniques', 6),
(37, 'Remplacement amortisseur avant', 'Liaison au sol', 33, 'LS107-amoav', 'L’élève doit identifier localiser et reposer une suspension avant', 6),
(38, 'les bougies de pré chauffage', 'Gestion énergie électrique', 34, 'GE103-bougi', 'L’élève doit être capable de remplacer et contrôler les bougies de préchauffage', 6),
(39, 'Gestion recyclage', 'Service gestion', 35, 'AS119-recy', 'L’élève doit être capable de connaitre la réglementation en vigueur sur le tri sélectif et la récupération des déchets automobile, et trier l’ensemble', 6),
(40, 'remplacement transmission', 'Transmission', 36, 'T101-tran', 'L’élève doit identifier déposer et reposer une transmission', 6),
(41, 'Remplacement d\'un triangle inférieur', 'Liaison au sol', 37, 'LS108-tria', 'L’élève doit identifier et remplacer un triangle inférieur', 6),
(42, 'Dépose d\'un flexible de frein', 'Freinage', 38, 'F103-fle', 'L’élève doit être capable de remplacer un flexible de feins et de purger le circuit de freinage', 3),
(43, 'Frein avant', 'Freinage', 39, 'F104-frav', 'L’élève doit être capable de relever les caractéristiques des frein avant et analyser leurs états', 3),
(44, 'dépose soupapes', 'Motorisation', 40, 'MA110-desou', 'L’élève doit être capable de remplacer les soupapes d\'un moteur', 3),
(45, 'Contrôle bougies d\'allumage', 'Gestion énergie électrique', 41, 'GE106-bou2', 'L’élève doit être capable de remplacer et contrôler les bougies d\'allumage', 3),
(46, 'Contrôle Frein à disques arrières', 'Freinage', 42, 'F107-cofra', 'L’élève doit être capable de remplacer et contrôler les freins à disques arrières', 3),
(47, 'Remplacer  un kit de distribution', 'Motorisation', 43, 'MA104-dist', 'L’élève doit remplace un kit de distribution', 3),
(48, 'déposer contrôler une pompe à huile', 'Motorisation', 44, 'MA106-pomp', 'L’élève doit déposer contrôler et reposer une pompe à huile', 3),
(49, 'Rodage soupape', 'Motorisation', 45, 'MA109-roda', 'L’élève doit être capable de roder les sièges de soupapes et de contrôler leurs étanchéités', 3),
(50, 'dépose d\'un alternateur', 'Gestion énergie électrique', 46, 'GE104-alter', 'L’élève doit identifier déposer et reposer un alternateur', 3),
(51, 'Charger une batterie', 'Gestion énergie électrique', 47, 'GE109-bate', 'L’élève doit remettre en charge une batterie', 3),
(52, 'Identifier l\'allumage', 'Gestion énergie électrique', 48, 'GE110-alum', 'L’élève doit identifier et situer les différents composants d\'un circuit d\'allumage', 3),
(53, 'Lecture de schéma électrique', 'Gestion énergie électrique', 49, 'GE112-sche', 'L’élève doit être capable de retrouver les circuits électriques sur schémas', 3),
(54, 'Branchement électrique', 'Gestion énergie électrique', 50, 'GE113-bran', 'L’élève doit être capable d\'identifier les différents composants électriques et les brancher', 3),
(55, 'Remplacement embrayage', 'Transmission', 51, 'T102-embr', 'L’élève doit remplacer un mécanisme d\'embrayage', 3),
(56, 'utilisation de l\'inclinomètre', 'Liaison au sol', 53, 'LS110-incl', 'L’élève doit être capable manipuler un inclinomètre et régler des angles', 3),
(57, 'Circuit de chauffage', 'Motorisation', 54, 'MTE102-chau', 'L’élève doit être capable de mesurer la température qui sort du ventilateur et purger le circuit de chauffage', 3),
(58, 'Réception véhicule 2', 'Service gestion', 55, 'AS125-rece', 'L’élève doit être capable de rechercher des références dans un catalogue de pièce', 3),
(59, 'Contrôle phares', 'Gestion énergie électrique', 56, 'MTE102-chau', 'L’élève doit être capable de mettre en place l’appareil de contrôle optique de phare et de les régler', 4),
(60, 'Soudure étain', 'Gestion énergie électrique', 57, 'GE108-soue', 'L’élève doit être capable d’identifier, localiser, souder réaliser un schéma puis montage électrique', 4),
(61, 'Crevaison', 'Liaison au sol', 58, 'LS11-crev', 'L’élève doit être capable de réparer une crevaison sur un pneumatique', 4),
(62, 'Contrôle vilebrequin', 'Motorisation', 59, 'MA108-vile', 'L’élève doit être capable de déposer, de contrôler et reposer le vilebrequin du moteur', 4),
(63, 'shémat électrique PSA', 'Gestion énergie électrique', 60, 'GE119-psa', 'L’élève doit être capable de décoder un schéma électrique PSA', 4),
(64, 'shémat électrique Renault', 'Gestion énergie électrique', 60, 'GE120-ren', 'L’élève doit être capable de décoder un schéma électrique Renault', 4),
(65, 'découverte de la B.V.', 'Transmission', 61, 'T104-bv', 'L’élève doit être capable d’identifier, de démonter une boite de vitesses mécanique et de comprendre son fonctionnement', 4),
(66, 'Remplacement commande d\'embrayage', 'Transmission', 62, 'T103-come', 'L’élève doit être capable de contrôler et régler le frein de stationnement', 4),
(67, 'Pré contrôle technique', 'Service travail', 63, 'AS126-préCT', 'L’élève doit être capable de vérifier rapidement les points qui imposeraient une contre visite', 4),
(68, 'La climatisation', 'Confort', 64, 'CO101-clim', 'L’élève doit être capable de relever des températures sur le circuit de clim. et d’entretenir le circuit de froid', 4),
(69, 'Prise de remorque', 'Gestion énergie électrique', 65, 'GE111-prise', 'L’élève doit être capable de brancher correctement la prise de remorques en respectant le code européen', 4),
(70, 'Circuit de démarrage', 'Gestion énergie électrique', 66, 'GE114-dema', 'L’élève doit être capable d’identifier, de localiser et contrôler le circuit de démarrage', 7),
(71, 'Circuit de charge', 'Gestion énergie électrique', 67, 'GE116-char', 'L’élève doit être capable d’identifier et contrôler le circuit de charge', 7),
(72, 'Contrôle géométrie', 'Liaison au sol', 68, 'LS113-géom', 'L’élève doit être capable de mettre en place le matériel de contrôle géométrique et de relever les valeurs', 7),
(73, 'pompe de gavage', 'Motorisation', 69, 'MA114-pomg', 'L’élève doit être capable de remplacer la pompe de gavage', 4),
(74, 'remplacement synchro', 'Transmission', 70, 'T102-synch', 'L’élève doit être capable de remplacer un synchroniseur de 5ème vitesse', 4),
(75, 'Analyse des informations C.T.', 'Service travail', 71, 'AS127-CT', 'L’élève doit être capable d’identifier les différents points de contrôle du véhicule afin de l’amener au contrôle technique sans problème', 4),
(76, 'Réception véhicule 2', 'Service gestion', 72, 'AS124-rece', 'L’élève doit être capable de retrouver l’emplacement de la plaque d’identification, d’interpréter les différents codes, de donner les informations moteur.', 4),
(77, 'Feux de recul', 'Gestion énergie électrique', 73, 'GE117-recu', 'L’élève doit identifier les composants du système, identifier les circuits, comprendre le principe de fonctionnement, effectuer des mesures électriques sur le système', 7),
(78, 'Contrôler les compressions', 'Motorisation', 75, 'MA111-comp', 'L’élève doit être capable d’identifier, de localiser et contrôler les compressions', 7),
(79, 'Réglage des culbuteurs', 'Motorisation', 76, 'MA112-culb', 'L’élève doit être capable de régler les culbuteurs parfaitement', 4),
(80, 'contrôler un circuit de lubrification', 'Motorisation', 77, 'MA118-lubr', 'L’élève doit identifier localiser et relevés les pressions d\'huile', 7),
(81, 'contrôler un circuit de refroidissement', 'Motorisation', 78, 'MA119-refr', 'L’élève doit identifier localiser et relevés les pression du circuit de refroidissement', 7),
(82, 'Remplacement Maître cylindre', 'Freinage', 79, 'F108-mc', 'L’élève doit être capable de contrôler et mesurer les pressions de freinage', 8),
(83, 'Vitre électrique', 'Gestion énergie électrique', 80, 'GE117-vitre', 'L’élève doit identifier les composants du système, comprendre le principe de fonctionnement, effectuer des mesures électriques sur le système', 8),
(84, 'fermeture centralisé', 'Gestion énergie électrique', 81, 'GE118-centre', 'L’élève doit identifier le véhicule, identifier un système de fermeture centralisé, rechercher le schéma électrique du système, remettre en conformité le système.', 8),
(85, 'contrôle sur banc de freinage', 'Freinage', 82, 'F107-banc', 'L’élève doit être capable de relever les efforts de freinage sur les essieux', 8),
(86, 'Identifier codes défauts', 'Gestion énergie électrique', 83, 'GE107-code', 'L’élève doit être capable de brancher la station de diagnostique et de donner les codes défauts.', 8),
(87, 'distribution sur moteur 3 cylindres', 'Motorisation', 84, 'MA120-dis3', 'L’élève doit être capable de caler une distribution d\'un moteur 3 cylindres', 8),
(88, 'Epure de distribution', 'Motorisation', 85, 'MA116-épur', 'L’élève doit être capable de relever les points de la distribution sur un moteur au banc', 8),
(89, 'L\'injection essence', 'Motorisation', 86, 'MA119-inje', 'L’élève doit être capable d’identifier et de situer les éléments du système d’injection essence. Identifier le faisceau électrique du système', 8),
(90, 'Mise en forme d\'une pièce', 'Service travail', 87, 'AS128-ajust', 'L’élève doit être capable de fabriquer une pièce pour son travail', 8),
(91, 'GNV', 'Gestion énergie électrique', 74, 'GE115-GMV', 'L’élève doit identifier les composants du système, identifier les circuits, comprendre le principe de fonctionnement, effectuer des mesures électriques sur le système', 4),
(92, 'Révision alternateur', 'Gestion énergie électrique', 91, 'GE120-real', 'L’élève doit être capable de Remplacer, contrôler un alternateur', 5),
(93, 'révision bougies', 'Gestion énergie électrique', 92, 'GE121-rebo', 'L’élève doit être capable de Remplacer, contrôler les bougies de moteur essence et diesel', 5),
(94, 'Révision demarreur', 'Gestion énergie électrique', 93, 'GE122-rede', 'L’élève doit être capable de Remplacer, contrôler un démarreur', 5),
(95, 'Révision embrayage', 'Transmission', 94, 'T308-reem', 'L’élève doit être capable de Remplacer, contrôler un embrayage', 5),
(96, 'Révision freins', 'Freinage', 95, 'F109-refr', 'L’élève doit être capable de Remplacer, contrôler les freins', 5),
(97, 'Révision service pneu', 'Service gestion', 96, 'AS129-rein', 'L’élève doit être capable de d’utiliser le système informatique pour compléter les documents administratifs', 5),
(98, 'Révision moteur', 'Motorisation', 97, 'MA121-recu', 'L’élève doit être capable de Remplacer, contrôler une culasse', 5),
(100, 'Révision vidange', 'Motorisation', 99, 'MA120-reep', 'L’élève doit être capable de faire la vidange moteur, remplacer tous les filtres, vérifier les niveaux', 5),
(101, 'Révision transmission', 'Transmission', 100, 'TE309-retr', 'L’élève doit identifier déposer et reposer une transmission', 5),
(102, 'Révision direction', 'Liaison au sol', 101, 'LS115-reti', 'L’élève doit être capable de remplacer un triangle inférieur', 5);

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
) ENGINE=MyISAM AUTO_INCREMENT=180 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
