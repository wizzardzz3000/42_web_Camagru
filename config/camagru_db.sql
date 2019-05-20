-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 20 mai 2019 à 09:44
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
-- Base de données :  `camagru`
--
CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `camagru`;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `picture_id`, `user_id`, `comment`, `comment_date`) VALUES
(6, 28, 7, 'hello', '2019-05-20 14:23:13'),
(7, 28, 7, 'hi \\\r\n\r\n\r\n\r\nfssf\r\n\r\n\r\n\r\n\r\nf', '2019-05-20 14:23:18'),
(8, 28, 7, 'f\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nsf', '2019-05-20 14:23:30'),
(9, 28, 7, 'ff\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nwwf', '2019-05-20 14:24:02'),
(10, 35, 1, 'rg', '2019-05-20 16:04:52'),
(11, 35, 1, 'fw\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nfw', '2019-05-20 16:06:20'),
(12, 35, 1, 'fe\r\n\r\n\r\n\r\n\r\n\r\n\r\nfw', '2019-05-20 16:09:50'),
(13, 35, 1, 'hey', '2019-05-20 16:18:27'),
(14, 35, 1, 'yo', '2019-05-20 16:23:12'),
(15, 35, 1, ':)', '2019-05-20 16:23:34'),
(16, 38, 1, 'hey', '2019-05-20 16:42:04'),
(17, 38, 1, 'g\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nff', '2019-05-20 16:42:10'),
(18, 43, 7, 'hey', '2019-05-20 17:34:48'),
(21, 46, 7, 'hey', '2019-05-20 18:35:00');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `picture_id`, `user_id`) VALUES
(2, 35, 1),
(3, 32, 1),
(4, 43, 7);

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
(28, 7, '0.30362800:1558354592.png'),
(29, 7, '0.10103900:1558355276.png'),
(30, 7, '0.56436500:1558355285.png'),
(31, 7, '0.65837600:1558355421.png'),
(32, 7, '0.24902500:1558355436.png'),
(33, 7, '0.30558200:1558355444.png'),
(34, 7, '0.87155900:1558356625.png'),
(35, 1, '0.44283800:1558361072.png'),
(36, 1, '0.82901100:1558361967.png'),
(37, 1, '0.71073200:1558363087.png'),
(38, 1, '0.52886200:1558363280.png'),
(39, 1, '0.48731600:1558363434.png'),
(40, 7, '0.71860700:1558363755.png'),
(41, 7, '0.42446600:1558363896.png'),
(42, 7, '0.75796100:1558363908.png'),
(43, 7, '0.27997800:1558364163.png'),
(45, 7, '0.00401400:1558366406.png'),
(46, 7, '0.92314800:1558369840.png');

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
  `account_valid` int(11) NOT NULL,
  `notifications` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `hash`, `account_valid`, `notifications`) VALUES
(1, 'Jusix75', 'wrsv@ewrdf.fr', '63fdfee16cfe8db69def7ed8c5fffcde313f364e612576710b159553467e835edba57b84ec44d637c24e44e09496beb04b91ec698816980e5b0e89379847009c', 'a0d2792bd2ea2e410e89a27df5d187e06c47204d9fe39bfb5d0b2187c4f26af5ab20e06559cc70111b29524e119bbec7daae6e426d8e8150629c3ec4551f853a', 1, 0),
(2, 'Martin75', 'vuheferi@simpleemail.info', '63fdfee16cfe8db69def7ed8c5fffcde313f364e612576710b159553467e835edba57b84ec44d637c24e44e09496beb04b91ec698816980e5b0e89379847009c', 'e36a51b347f577d4fad9bbf4ff999ba3b82e7bee1755d806c9446ec97096e21b0ddad1736e253af77acd79e88bfd61de4a9c483be9307e6366d374dc85200279', 1, 1),
(3, 'Papi', 'mrtscg@gmail.com', '63fdfee16cfe8db69def7ed8c5fffcde313f364e612576710b159553467e835edba57b84ec44d637c24e44e09496beb04b91ec698816980e5b0e89379847009c', '4663891216ba642aa950c4b6f502d33ce7d4ed391f8fd483810345d0ab9f6a5838d014700e1968f541452f7e898d1850b56f4de953bcdf36081a1cfc0ad8d47e', 0, 0),
(4, 'f', 'f', '47c7f9b44e004f44f171e082a69cd1385091ec452c69348477c1719f22c73b46e4afe702b33a77dee4a68ae581dba29c85fc90ce7199d1ff2cf03d5183371a18', 'c3b7ff2bab880ce8ea62c5fda2a8829cd8dbf2eb79a783655430950e8e140586ccfe53dcdf145fa360fe7078e59bf1d3178339c7b88966ed00791ccbec2f8db6', 0, 1),
(5, 'h', 'h', '24fc871e81329c1019c11186642e5937298d10be03010244cf770a7ae306b539f3991b36a5f42f8cf7325f22411bc7a3b14351b42f26335f44786bdbf29c317f', 'd088720fba708aa1e418094a98140311db276f4350e161e26650fdda3c4950d9070ce4c54fd578120c66cae8b4b14b4cb6dbe613fcff854d65286dcdf528695d', 0, 1),
(6, 'Jusix', 'xiziwihom@royalmail.top', '63fdfee16cfe8db69def7ed8c5fffcde313f364e612576710b159553467e835edba57b84ec44d637c24e44e09496beb04b91ec698816980e5b0e89379847009c', '5e38cbc49c97f1445a1abc41501520b20cdfb7daadf38e5a9f56bee7d83503c7ff48698d5d87fdc6cfa472529e44b29e3dd576e82f2e24308e5f10e94d7e101d', 0, 1),
(7, 'Babibel', 'dodixarabi@mrmail.info', '63fdfee16cfe8db69def7ed8c5fffcde313f364e612576710b159553467e835edba57b84ec44d637c24e44e09496beb04b91ec698816980e5b0e89379847009c', 'd434ac6a79a89a20b8568de3c76d28df3f16c10f2ab14c676bc0d323d6dfdc8dba676fcff1a988a9feaa43761f08d10486efa8b47c9637554887f60f3410b11b', 1, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
