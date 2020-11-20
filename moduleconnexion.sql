-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 20 nov. 2020 à 10:06
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `moduleconnexion`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `prenom`, `nom`, `password`) VALUES
(6, 'toto', 'leo', 'manie', '$2y$10$xUZiJ2zAWZcVEtoEHcgJ8.Tn/23gW2y7BHcSUqu91ATGRNsOqLtCu'),
(2, 'isa', 'isa', 'plume', '$2y$10$qtaba/R0xnB8PanurmvTM.1EHkUogHLRseLcDPiKv/t3RFS2SqTIm'),
(3, 'juju', 'julien', 'legee', '$2y$10$E0YyhdVGcfZT27FqjZLOPetG12EB4fg6vAZM48QNvlCBkRQUDIliW'),
(5, 'admin', 'admin', 'admin', 'admin'),
(7, 'mims', 'Ã©milie', 'cardon', '$2y$10$VOjJgW0V5OCqADQSPsD6C.P3T58.2sAFk7ko6azkiUmRqM.ewMZyy'),
(8, 'bb', 'barnabÃ©', 'damien', '$2y$10$pt5xsPljT5SUd6uxy2xDX.UXGG6dQM2TnHaGMo0apXH6MUaZKfH32'),
(9, 'josh', 'joshua', 'berry', '$2y$10$lAx8KK9m60sYeQGhLRfFaehSWf5wJ9Z6AkHZF737Ax2T1qsoTC0rq');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
