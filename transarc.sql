-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 20 Octobre 2017 à 15:05
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `transarc`
--

-- --------------------------------------------------------

--
-- Structure de la table `tbl_directions`
--

CREATE TABLE `tbl_directions` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `numLine` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_lines`
--

CREATE TABLE `tbl_lines` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `numRegion` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbl_lines`
--

INSERT INTO `tbl_lines` (`id`, `name`, `numRegion`) VALUES
(1, '101', 1),
(2, '102', 1),
(3, '215', 1),
(4, '106', 1),
(5, '107', 1),
(6, '109', 1),
(7, '120', 1),
(8, '121', 1),
(9, '611', 1),
(10, '612', 1),
(11, '613', 1),
(12, '110', 1),
(13, '111', 1),
(14, '112', 1),
(15, '421', 1),
(16, '422', 1),
(17, '423', 1),
(18, '222', 2),
(19, '301', 2),
(20, '302', 2),
(21, '303', 2),
(22, '304', 2),
(23, '310', 2),
(24, '311', 2),
(25, '312', 2),
(26, '370', 2),
(27, '360', 2),
(28, '361', 2),
(29, '341', 3),
(30, '340', 3);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_regions`
--

CREATE TABLE `tbl_regions` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `urlname` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbl_regions`
--

INSERT INTO `tbl_regions` (`id`, `name`, `urlname`) VALUES
(1, 'Littoral & Val-de-Ruz', 'littoral-val-de-ruz'),
(2, 'La Chaux-de-Fonds', 'la-chaux-de-fonds/chaux-de-fonds-jour'),
(3, 'Le Locle, Montagnes & Val-de-Travers', 'le-locle-montagnes-val-de-travers');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_stops`
--

CREATE TABLE `tbl_stops` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `numDirection` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `tbl_directions`
--
ALTER TABLE `tbl_directions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_lines`
--
ALTER TABLE `tbl_lines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_regions`
--
ALTER TABLE `tbl_regions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_stops`
--
ALTER TABLE `tbl_stops`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `tbl_directions`
--
ALTER TABLE `tbl_directions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tbl_lines`
--
ALTER TABLE `tbl_lines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `tbl_regions`
--
ALTER TABLE `tbl_regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tbl_stops`
--
ALTER TABLE `tbl_stops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
