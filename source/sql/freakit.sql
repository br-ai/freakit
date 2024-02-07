-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 05 fév. 2024 à 12:19
-- Version du serveur : 5.7.40
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `freakit`
--

-- --------------------------------------------------------

--
-- Structure de la table `adminactions`
--

DROP TABLE IF EXISTS `adminactions`;
CREATE TABLE IF NOT EXISTS `adminactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_admin` int(11) NOT NULL,
  `action` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_FK_1` (`user_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `adminactions`
--

INSERT INTO `adminactions` (`id`, `user_admin`, `action`, `date_created`) VALUES
(3, 24, 'a fermer le forum  21', '2024-02-04 22:38:21'),
(4, 24, 'a supprimÃ© le forum 21', '2024-02-04 22:40:28'),
(5, 24, 'a supprimÃ© la category 7', '2024-02-04 23:01:51'),
(6, 24, 'a ajouter une category', '2024-02-04 23:20:06'),
(7, 24, 'a supprimÃ© la category 10', '2024-02-04 23:20:19'),
(8, 24, 'a supprimÃ© la category 9', '2024-02-04 23:20:24'),
(9, 24, 'a ajouter une category', '2024-02-04 23:20:36'),
(10, 24, 'a ajouter une category', '2024-02-04 23:31:48'),
(11, 24, 'a ajouter une category', '2024-02-04 23:33:39'),
(12, 24, 'a modifier la category 13', '2024-02-04 23:35:30'),
(13, 24, 'a modifier la category 1', '2024-02-04 23:36:08'),
(14, 24, 'a modifier la category 1', '2024-02-04 23:37:13'),
(15, 24, 'a modifier la category 2', '2024-02-04 23:37:25'),
(16, 24, 'a modifier la category 6', '2024-02-04 23:38:02'),
(17, 24, 'a ajouter une category', '2024-02-04 23:48:03'),
(18, 24, 'a ajouter une category', '2024-02-04 23:51:54'),
(19, 24, 'a supprimÃ© la category 15', '2024-02-05 10:55:03'),
(20, 24, 'a fermer le forum  22', '2024-02-05 11:06:18'),
(21, 24, 'a supprimÃ© le forum 22', '2024-02-05 11:07:02'),
(22, 24, 'a supprimÃ© utilisateur 26', '2024-02-05 11:07:18'),
(23, 24, 'a modifier la category 14', '2024-02-05 11:07:44');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `date_created`) VALUES
(1, 'costume de noel et paque', '2024-01-30 17:41:54'),
(2, 'informatique generale', '2024-01-30 17:42:26'),
(3, 'maintenance informatique', '2024-01-30 17:42:41'),
(4, 'developpement web', '2024-01-30 17:42:49'),
(5, 'droit des affaires', '2024-01-30 17:42:56'),
(6, 'fifa 22', '2024-01-30 17:43:03'),
(8, 'football', '2024-02-04 23:17:27'),
(11, 'tennis', '2024-02-04 23:20:36'),
(12, 'basket', '2024-02-04 23:31:48'),
(13, 'cyclisme', '2024-02-04 23:33:39'),
(14, 'parachutiste ff', '2024-02-04 23:48:03');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `forum_id_FK_1` (`forum_id`),
  KEY `user_id_FK_1` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `forum_id`, `user_id`, `comment`, `image`, `date_created`) VALUES
(23, 23, 27, 'il suffit d\'utiliser un cache et aussi optimiser les requetes dans ta base de donnees', '', '2024-02-05 11:49:42'),
(25, 23, 24, 'compresse les images et tu les rognent avant de les sauvegarder dans ta base de donnÃ©e [image=\'https://picsum.photos/id/1/200/300\']', '', '2024-02-05 11:53:50'),
(26, 23, 28, 'Merci a tous :)', '', '2024-02-05 11:54:24');

-- --------------------------------------------------------

--
-- Structure de la table `dislikes`
--

DROP TABLE IF EXISTS `dislikes`;
CREATE TABLE IF NOT EXISTS `dislikes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `comment_id` (`comment_id`,`user_id`),
  KEY `user_FK_1` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_creator_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en cours',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_creator_id_FK_1` (`user_creator_id`),
  KEY `category_id_FK_1` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `forum`
--

INSERT INTO `forum` (`id`, `user_creator_id`, `category_id`, `title`, `message`, `status`, `date_created`) VALUES
(23, 28, 4, 'Comment rendre mon appli plus rapide', 'J\'ai developpÃ© une appli en php et j\'aimerai la rendre plus rapide, svp quelles sont les moyens qui me parviendront a faire ce que je veux merci ', 'en cours', '2024-02-05 11:48:58'),
(24, 27, 1, 'Costume en vente', 'j\'aimerai que quelqun me prete son costume depaque pour que je realise une piece de theatre si non m\'indique oÃ¹ je peux en acheter', 'Cloture', '2024-02-05 11:56:32');

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_1` int(11) NOT NULL,
  `user_id_2` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_FK_1` (`user_id_1`),
  KEY `user_FK_2` (`user_id_2`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `friends`
--

INSERT INTO `friends` (`id`, `user_id_1`, `user_id_2`, `status`, `date_created`) VALUES
(16, 27, 28, 'accepted', '2024-02-05 11:56:53'),
(17, 27, 24, 'pending', '2024-02-05 11:57:29');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`comment_id`),
  KEY `comment_FK_1` (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `comment_id`, `date_created`) VALUES
(5, 24, 23, '2024-02-05 11:49:56');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `banner` varchar(250) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `verificationCode` varchar(255) NOT NULL,
  `verified` tinyint(1) DEFAULT '0',
  `role` varchar(50) DEFAULT 'user',
  `active` tinyint(1) DEFAULT '1',
  `date_joined` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `birthday`, `banner`, `avatar`, `password`, `verificationCode`, `verified`, `role`, `active`, `date_joined`) VALUES
(24, 'sited', 'brandonsitedjeya@gmail.com', '1999-10-23', 'ma banniere genial super animanteetjaime pasetre seul sur ce reseau de merdre', 'user_avatar/MyAvatarhDNrW.png', '$2y$10$QZUQCwwtt/ZJt7/r/ilaiufgtZZfPaRe/Mz1gBaH/66hl7Zi59Ore', '65bffa81ceb2e', 1, 'admin', 1, '2024-02-04 21:58:42'),
(27, 'florinda', 'guiademflorinda@gmail.com', '2003-04-18', 'follow me at https://www.florinda.fr', 'user_avatar/MyAvatar.png', '$2y$10$SwQTU/VkyeCR1fh8EOFdvOD3LwP3guhue/JbbQjL0sNYOKDel/592', '65c0bc520aabe', 1, 'user', 1, '2024-02-05 11:45:38'),
(28, 'stael', 'staelfotso@gmail.com', '1999-10-23', 'Lazy people are the most productive', 'user_avatar/MyAvatarbKwhl.png', '$2y$10$l6O6jGlETcx7F3Rdg34wPuhYt8B5C3aUwY1xOQqBSAOaTmT3DAm56', '65c0bcac2892f', 1, 'user', 1, '2024-02-05 11:47:08');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
