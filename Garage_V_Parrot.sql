-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 18 juil. 2023 à 15:05
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Garage_V_Parrot`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--
DROP TABLE IF EXISTS `avis`;
CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentary` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` int(11) NOT NULL,
  `is_moderate` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `name`, `commentary`, `note`, `is_moderate`, `created_at`) VALUES
(21, 'John Doe', 'Très bien reçu par cette équipe de professionnel qui ont su réparer ma voiture à la perfection', 5, 1, '2023-07-10 15:32:46'),
(22, 'Mr Smith', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!', 4, 1, '2023-07-10 15:32:46'),
(23, 'Bob le bricoleur', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!', 3, 0, '2023-07-10 15:32:46'),
(24, 'Optimus Prime', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!', 4, 1, '2023-07-10 15:32:46'),
(25, 'Bumbelbee', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!', 5, 1, '2023-07-10 15:32:46'),
(26, 'Arthur Weasley', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!', 2, 0, '2023-07-10 15:32:46'),
(27, 'Megatron', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!', 3, 1, '2023-07-10 15:32:46'),
(28, 'Starscream', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!', 4, 1, '2023-07-10 15:32:46'),
(29, 'Ironhide', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!', 2, 1, '2023-07-10 15:32:46'),
(30, 'Ratchet', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!', 1, 1, '2023-07-10 15:32:46'),
(31, 'Jazz', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!', 0, 1, '2023-07-10 15:32:46');

-- --------------------------------------------------------

--
-- Structure de la table `car`
--
DROP TABLE IF EXISTS `car`;
CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `circulation_date` int(11) NOT NULL,
  `km` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `title`, `price`, `image`, `circulation_date`, `km`) VALUES
(38, 'Audi presque neuve', 15000, 'audi.avif', 2018, 40000),
(39, 'BMW rétro', 12000, 'bmw-648da1badd604.avif', 2001, 220000),
(40, 'Chevrolet vintage', 8000, 'Chevrolet.avif', 1998, 240000),
(41, 'Honda récente', 9950, 'honda.avif', 2020, 110000);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--
DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230615195549', '2023-06-15 19:58:05', 13),
('DoctrineMigrations\\Version20230616154532', '2023-06-16 15:47:11', 16),
('DoctrineMigrations\\Version20230617122044', '2023-06-17 12:21:22', 24),
('DoctrineMigrations\\Version20230617125733', '2023-06-17 12:58:13', 10),
('DoctrineMigrations\\Version20230617142202', '2023-06-17 14:22:49', 15),
('DoctrineMigrations\\Version20230620155728', '2023-06-20 15:58:27', 18),
('DoctrineMigrations\\Version20230620161630', '2023-06-20 16:16:59', 14);

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--
DROP TABLE IF EXISTS `planning`;
CREATE TABLE `planning` (
  `id` int(11) NOT NULL,
  `day_of_the_week` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `morning_start` time DEFAULT NULL,
  `morning_end` time DEFAULT NULL,
  `afternoon_start` time DEFAULT NULL,
  `afternoon_end` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `planning`
--

INSERT INTO `planning` (`id`, `day_of_the_week`, `morning_start`, `morning_end`, `afternoon_start`, `afternoon_end`) VALUES
(36, 'Lundi', '08:45:00', '12:00:00', '14:00:00', '18:00:00'),
(37, 'Mardi', '08:45:00', '12:00:00', '14:00:00', '18:00:00'),
(38, 'Mercredi', '08:45:00', '12:00:00', '14:00:00', '18:00:00'),
(39, 'Jeudi', '08:45:00', '12:00:00', '14:00:00', '18:00:00'),
(40, 'Vendredi', '08:45:00', '12:00:00', '14:00:00', '18:00:00'),
(41, 'Samedi', '08:45:00', '12:00:00', NULL, NULL),
(42, 'Dimanche', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--
DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `title`, `description`) VALUES
(21, 'Révision', 'Celle-ci se réalise sur différents éléments de votre voiture, dont l’identification, la direction, la visibilité, l’éclairage, la liaison au sol, la mécanique, le niveau de pollution, la carrosserie, etc'),
(22, 'Entretien', 'Vérifications au niveau du pare-brise, des feux et des essuie-glaces, des contrôles internes et externes, niveaux et pneumatique.'),
(23, 'Réparation', 'Diverses qui peuvent aller de la remise en état des pneus, des plaquettes de frein, des amortisseurs et des autres organes mécaniques à la carroserie');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(22, 'vincent.parrot@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$2VKoBOM9hMKe3qSZ46mwK./9RTCgyOgkeUjZMU1SBzih3Ym15YKvS'),
(23, 'employe@gmail.com', '[]', '$2y$13$pBbaOEYMUkZGnB9ubypHheJx8lBwbpsR7C261N8RzYluarb0X9zI.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D499BFF6C7D48B80` (`day_of_the_week`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
