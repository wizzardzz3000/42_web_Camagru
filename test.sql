-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  Dim 05 mai 2019 à 09:39
-- Version du serveur :  5.6.43
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `picture_id`, `user_id`, `author`, `comment`, `comment_date`) VALUES
(8, 1, 0, 'Jojo', 'C\'est moi !', '2017-09-28 19:50:14'),
(9, 5, 0, 'Mathieu', 'Retest\r\nEncore', '2017-10-27 11:46:50'),
(11, 9, 0, 'coucou', 'yes', '2019-04-24 17:17:09'),
(13, 11, 2, 'Martin', 'Cool', '2019-04-25 11:57:35');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `picture_id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`picture_id`, `user_id`, `content`) VALUES
(3, 2, '1556813760.png'),
(4, 2, '1556813780.png'),
(5, 1, '1556813804.png'),
(8, 2, '1556898792.png'),
(9, 1, '1556899986.png'),
(11, 2, '1556976077.png');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` text NOT NULL,
  `hash` text NOT NULL,
  `account_valid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `hash`, `account_valid`) VALUES
(1, 'Jusix75', 'wrsv@ewrdf.fr', '63fdfee16cfe8db69def7ed8c5fffcde313f364e612576710b159553467e835edba57b84ec44d637c24e44e09496beb04b91ec698816980e5b0e89379847009c', 'a0d2792bd2ea2e410e89a27df5d187e06c47204d9fe39bfb5d0b2187c4f26af5ab20e06559cc70111b29524e119bbec7daae6e426d8e8150629c3ec4551f853a', 1),
(2, 'Martin', 'balaton.scaglia@live.fr', '63fdfee16cfe8db69def7ed8c5fffcde313f364e612576710b159553467e835edba57b84ec44d637c24e44e09496beb04b91ec698816980e5b0e89379847009c', 'e36a51b347f577d4fad9bbf4ff999ba3b82e7bee1755d806c9446ec97096e21b0ddad1736e253af77acd79e88bfd61de4a9c483be9307e6366d374dc85200279', 1),
(3, 'Papi', 'mrtscg@gmail.com', '63fdfee16cfe8db69def7ed8c5fffcde313f364e612576710b159553467e835edba57b84ec44d637c24e44e09496beb04b91ec698816980e5b0e89379847009c', '4663891216ba642aa950c4b6f502d33ce7d4ed391f8fd483810345d0ab9f6a5838d014700e1968f541452f7e898d1850b56f4de953bcdf36081a1cfc0ad8d47e', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`picture_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
