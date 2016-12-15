-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 14 Décembre 2016 à 15:55
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bookkeeper`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `cover` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contenu de la table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `created_at`, `created_by`, `status`, `cover`) VALUES
(3, 'jean', 'jean', '2016-12-13 10:35:22', 0, 1, NULL),
(4, 'aze', 'aze', '2016-12-13 15:41:42', 11, 1, 'aze'),
(5, 'aze', 'aze', '2016-12-13 15:44:41', 11, 1, 'aze'),
(6, 'aze', 'aze', '2016-12-13 15:46:15', 11, 1, 'aze'),
(7, 'aze', 'aze', '2016-12-13 15:47:02', 11, 1, 'aze'),
(8, 'aze', 'aze', '2016-12-13 15:49:19', 11, 1, 'aze'),
(9, 'aze', 'aze', '2016-12-13 15:49:53', 11, 1, 'aze'),
(10, 'aze', 'aze', '2016-12-13 15:50:15', 11, 1, 'aze'),
(11, 'aze', 'aze', '2016-12-13 15:52:20', 11, 1, 'aze'),
(12, 'de', 'ed', '2016-12-13 17:08:38', 11, 1, 'ed'),
(13, 'un livre de jean claude', 'jean claude ', '2016-12-14 10:47:19', 11, 1, 'te');

-- --------------------------------------------------------

--
-- Structure de la table `books_categories`
--

CREATE TABLE `books_categories` (
  `book_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `content` text COLLATE utf8mb4_bin NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contenu de la table `quotes`
--

INSERT INTO `quotes` (`id`, `user_id`, `book_id`, `content`, `author`, `updated_at`, `created_at`) VALUES
(6, 11, -1, 'aze', 'aze', NULL, '2016-12-13 09:23:53'),
(7, 11, -1, 'test', 'clement', '2016-12-13 10:23:31', '2016-12-13 09:25:54'),
(8, 11, -1, 'azer', 'azr', NULL, '2016-12-13 09:46:36'),
(9, 11, -1, 'cde', 'cde', NULL, '2016-12-13 09:59:35');

-- --------------------------------------------------------

--
-- Structure de la table `reading_list`
--

CREATE TABLE `reading_list` (
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contenu de la table `reading_list`
--

INSERT INTO `reading_list` (`book_id`, `user_id`, `read_status`) VALUES
(13, 11, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_bin NOT NULL DEFAULT 'user',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `token` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `avatar`, `role`, `status`, `token`, `created_at`, `updated_at`) VALUES
(11, 'clement.godin59310@gmail.com', '$2y$10$fePiKJGuRpNcKgX76gGiTuSbFmOzusHUbRWUvDLsB3kB.dypWaOVy', 'clementgodin', NULL, 'user', 1, '', '2016-12-12 13:04:25', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `books_categories`
--
ALTER TABLE `books_categories`
  ADD KEY `book_id` (`book_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Index pour la table `reading_list`
--
ALTER TABLE `reading_list`
  ADD KEY `book_id` (`book_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `books_categories`
--
ALTER TABLE `books_categories`
  ADD CONSTRAINT `books_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `quotes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reading_list`
--
ALTER TABLE `reading_list`
  ADD CONSTRAINT `reading_list_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `reading_list_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
