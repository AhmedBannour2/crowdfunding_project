-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 20 fév. 2025 à 21:24
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `crowdfunding_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250209133147', '2025-02-20 14:13:14', 161),
('DoctrineMigrations\\Version20250220134253', '2025-02-20 14:13:14', 4),
('DoctrineMigrations\\Version20250220140356', '2025-02-20 14:13:14', 3),
('DoctrineMigrations\\Version20250220141342', '2025-02-20 14:13:49', 7),
('DoctrineMigrations\\Version20250220172534', '2025-02-20 17:26:14', 66),
('DoctrineMigrations\\Version20250220175236', '2025-02-20 17:52:45', 6);

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `donator_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `participant_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `participation`
--

INSERT INTO `participation` (`id`, `project_id`, `donator_id`, `amount`, `participant_date`) VALUES
(2, 9, 14, 252.91, '2024-10-15 11:57:42'),
(3, 6, 8, 160.8, '2024-11-06 21:33:37'),
(4, 10, 13, 182.71, '2024-09-11 15:52:45'),
(5, 8, 6, 175.84, '2024-09-23 20:08:46'),
(6, 3, 11, 419.29, '2024-10-20 06:52:29'),
(7, 6, 13, 571.7, '2024-12-22 00:04:09'),
(8, 5, 8, 191.75, '2024-12-30 21:50:59'),
(9, 2, 8, 510.42, '2024-12-06 21:20:22'),
(10, 7, 9, 90.97, '2024-12-13 13:52:13'),
(11, 6, 14, 862.82, '2024-12-28 21:41:49'),
(12, 8, 6, 206.57, '2024-10-17 05:11:33'),
(13, 4, 13, 356.86, '2024-12-21 05:14:29'),
(14, 5, 12, 366.71, '2024-11-20 08:33:28'),
(15, 8, 8, 977.84, '2025-02-13 19:02:26'),
(16, 5, 13, 373.9, '2024-09-21 01:08:05'),
(17, 11, 11, 699.08, '2024-10-19 10:17:16'),
(18, 9, 8, 135.51, '2024-11-20 05:55:37'),
(19, 6, 14, 659.91, '2024-09-15 05:04:10'),
(20, 11, 5, 100.89, '2025-02-14 20:38:52'),
(21, 11, 6, 41.6, '2024-09-26 12:37:46'),
(22, 9, 5, 644.38, '2024-10-26 04:31:23'),
(23, 7, 7, 761.91, '2024-09-23 16:36:22'),
(24, 4, 5, 821.23, '2024-08-30 22:08:09'),
(25, 3, 13, 529.96, '2024-10-27 18:36:48'),
(26, 4, 12, 761.59, '2024-10-02 17:19:36'),
(27, 3, 14, 278.39, '2024-10-13 15:18:54'),
(28, 6, 10, 663.55, '2024-12-14 21:21:41'),
(29, 4, 7, 278.68, '2024-11-27 01:18:21'),
(30, 10, 14, 634.45, '2025-01-15 17:25:33'),
(31, 4, 6, 264.14, '2024-12-30 01:40:14'),
(32, 2, 17, 200, '2025-02-20 19:19:11'),
(33, 12, 18, 1005, '2025-02-20 20:13:07');

-- --------------------------------------------------------

--
-- Structure de la table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `pseudonyme` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `person`
--

INSERT INTO `person` (`id`, `first_name`, `last_name`, `pseudonyme`, `email`, `country`, `roles`, `password`) VALUES
(5, 'Marc', 'Lefebvre', 'foucher.marcel', 'claire.blin@club-internet.fr', 'Koweit', '[]', '$2y$13$PjgV130BN/5XNryOwYoVeeWg9XDhJ5UvLu7HvN9ViH7AFVNcR.2Mi'),
(6, 'Raymond', 'Le Gall', 'hamon.charles', 'qollivier@yahoo.fr', 'Vietnam', '[]', '$2y$13$9zIoH3u0W1CcfCTIIfbS2OEHmWjkn3qHEtKT.NKH4ejqo.71R9.f2'),
(7, 'Thibaut', 'Hoareau', 'xvasseur', 'gilbert.noel@boyer.net', 'Madagascar', '[]', '$2y$13$sDkEtaZ17XhMIzw3pV3cferDd644/xSTlzBjea0.jD.mgviiFGv96'),
(8, 'Aimée', 'Jacquet', 'elise.perret', 'benoit.chauveau@lopez.com', 'Koweit', '[]', '$2y$13$2P62WuffFikZ1PdYhCV6J.RYZkLA7XN1RuwagaxmUHGUjoixJENYG'),
(9, 'Joseph', 'Lucas', 'xpeltier', 'joseph.claire@hotmail.fr', 'Rwanda', '[]', '$2y$13$PCUTZBFrTBU2TSA06oW7Fux5TxJ9MRxxP1678aJ9ZHC5e0alv5/dm'),
(10, 'Maurice', 'Leconte', 'dominique.pottier', 'isaac.lagarde@marques.net', 'Sainte Hélène', '[]', '$2y$13$XMeazIs.Wwr6RjhZH3vRPet84v4ySjVVpPR3nW8iI8cPlOK.HLN6e'),
(11, 'Jérôme', 'Mallet', 'hardy.alice', 'noemi60@jacob.com', 'Gibraltar', '[]', '$2y$13$aFWHdOtAc7TFobEAjZg2YOguBaoDO55imnJak/bgL2qC57TkSWZkm'),
(12, 'Pierre', 'Pons', 'zlaunay', 'glebrun@techer.fr', 'Suriname', '[]', '$2y$13$aNTJWHQB7AFXy5ypO1M3yeiQhVPu0vVQHcnE9LTqk5TrCZcVjrJua'),
(13, 'Suzanne', 'Auger', 'abegue', 'ihebert@morvan.fr', 'Maldives (Îles)', '[]', '$2y$13$75seJ72VilXicJI.iWlO6.TK0b2vgEbFKGE5JuoLMaKx2xCOZ.Cj.'),
(14, 'Alexandre', 'Pichon', 'agnes26', 'elagarde@free.fr', 'Canada', '[]', '$2y$13$aybgmfiohsGR0H8mvm0yPeelvdj9134XdXNhRTxW/wEvoUJ4FGSXq'),
(17, 'Ahmed', 'BENNOUR', 'elboh', 'ahmed.bn.tnv@gmail.com', 'Tunisia', '[\"ROLE_ADMIN\"]', '$2y$13$97NhsSjUWL/SOsPd3k2QDOTeHuYvp0maJnzgsxFbhQEFQsdqt/fQ6'),
(18, 'Ahmed', 'BENNOUR', 'elboh_user', 'ahmed.bn.tnv@tes.com', 'Tunisia', '[]', '$2y$13$pSydidjgGrcOL46f5nVFtOkcfidlwjLwK5nwmWbdQ2qa0tjbheGUa');

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `amount` int(11) NOT NULL,
  `opening_date` datetime NOT NULL,
  `closing_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `project`
--

INSERT INTO `project` (`id`, `creator_id`, `title`, `description`, `amount`, `opening_date`, `closing_date`) VALUES
(2, 12, 'Ratione distinctio dolor.', 'Dolor id dolor autem consequatur qui aut quis. Possimus aspernatur recusandae est in voluptatum voluptas. Atque et magni harum. Voluptatem laborum explicabo adipisci omnis. Sed at sit odit facere nesciunt qui. Et ut aperiam rerum. Quos earum sapiente quisquam aut dolorem temporibus iusto.', 70756, '2024-03-07 15:09:16', '2025-12-08'),
(3, 10, 'Et aut vitae.', 'Voluptas inventore tenetur non nostrum. Quaerat quia debitis et ut. Recusandae maiores cumque officia et non nisi consequatur. Et cum deleniti praesentium reiciendis. Inventore non rerum numquam soluta. Recusandae non est voluptatum amet.', 99235, '2024-09-26 01:06:46', '2025-09-14'),
(4, 11, 'Sit provident officia ipsa.', 'Saepe qui cupiditate quisquam. Rem voluptatem reprehenderit non et. Ut dolores et nisi. Quasi alias dolorem repudiandae sequi sapiente. Nihil molestiae odio perspiciatis quis voluptas. Consequatur deserunt nemo et et aliquam est. Commodi ut aut modi voluptatibus.', 3744, '2024-08-06 21:39:31', '2025-10-09'),
(5, 6, 'Necessitatibus dolorem.', 'Beatae autem sequi cumque ab. Hic eum nulla rerum omnis recusandae est. Explicabo esse ut in velit. Omnis optio eos ut aut qui cum neque accusantium.', 66273, '2024-11-11 02:03:08', '2026-01-31'),
(6, 7, 'Aperiam iusto quas.', 'Quo rerum et perspiciatis itaque. Voluptas in totam corporis. Beatae dolor iste temporibus asperiores doloribus. Repudiandae aut sequi aliquam.', 36231, '2024-12-09 06:40:49', '2025-07-23'),
(7, 14, 'Accusantium unde tempore magni.', 'Non quo non quis ea molestias mollitia reprehenderit dolor. Dicta corrupti temporibus unde dolorem aperiam corrupti accusamus. Natus est quis fugit quis. Nemo molestiae distinctio sint. Dolorem cupiditate inventore perferendis quo animi ratione. Aut nulla in porro deserunt blanditiis. Iure tempora sed et qui possimus voluptas laudantium.', 73557, '2024-09-07 18:19:41', '2025-12-14'),
(8, 12, 'Fuga placeat eius officiis doloribus.', 'Dignissimos qui quasi et voluptatibus. Velit ad voluptatum accusantium. Sint corrupti quia id in aut. Et hic recusandae saepe soluta. Iste explicabo amet est est perspiciatis facilis pariatur. Doloribus consectetur qui et quia ab qui tempore.', 67720, '2024-10-29 13:49:12', '2025-05-02'),
(9, 10, 'Impedit reprehenderit et.', 'Incidunt laudantium fuga doloribus qui necessitatibus blanditiis. Illum laudantium quaerat veritatis id quisquam. Sed dicta nobis pariatur laudantium molestias modi veritatis. Aut sit id impedit minima nemo sunt aliquid. Quisquam nulla est aliquid et nihil commodi sed. Sunt magnam illo non et. Expedita quia et doloribus neque non.', 70369, '2024-05-01 18:55:51', '2025-12-10'),
(10, 7, 'Omnis non similique consequatur necessitatibus.', 'Repudiandae exercitationem magnam perspiciatis ratione iure laudantium. Qui ea quae tempora. Qui pariatur qui quod corrupti reprehenderit molestias necessitatibus. Iusto deserunt earum nihil explicabo. Eos qui molestiae nulla et. Qui quidem animi doloremque sed.', 33247, '2024-12-06 00:24:18', '2025-05-03'),
(11, 13, 'Est sed distinctio provident eum.', 'Qui tempora inventore non facere et aut sed culpa. Inventore eum officiis dolor aut a fugiat. Voluptatem esse sunt et nemo voluptatem architecto. Sunt laudantium modi accusamus dolores. Est quidem non corrupti. Quisquam et facilis neque distinctio voluptas similique et. Exercitationem officia illo ad omnis et maiores ea.', 99682, '2024-02-20 22:29:20', '2025-11-10'),
(12, 17, 'php Advanced', 'projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfonyprojet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony projet symfony', 10000, '2025-02-20 20:23:00', '2025-03-21');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AB55E24F166D1F9C` (`project_id`),
  ADD KEY `IDX_AB55E24F831BACAF` (`donator_id`);

--
-- Index pour la table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_34DCD1761FE3BDAF` (`pseudonyme`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2FB3D0EE61220EA6` (`creator_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `participation`
--
ALTER TABLE `participation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `FK_AB55E24F166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_AB55E24F831BACAF` FOREIGN KEY (`donator_id`) REFERENCES `person` (`id`);

--
-- Contraintes pour la table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `FK_2FB3D0EE61220EA6` FOREIGN KEY (`creator_id`) REFERENCES `person` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
