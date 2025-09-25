-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 17 sep. 2025 à 17:24
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vote_pell`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidats`
--

CREATE TABLE `candidats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categorie_id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `votes` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `candidats`
--

INSERT INTO `candidats` (`id`, `categorie_id`, `nom`, `description`, `image`, `votes`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ibra Ndiaye', 'Plateforme de soumission PELL', '1752682773.avif', 2, '2025-07-16 16:19:33', '2025-07-16 16:19:33'),
(2, 1, 'Commune YOFF', '« NDÉKKI SAMA FONDÉ » - « Mon bol de bouillie matinale »', '1752773686.avif', 1, '2025-07-17 17:34:46', '2025-07-17 17:34:46'),
(3, 1, 'Kozah2', '« Kozah2, une commune qui rend compte : l’innovation d’une reddition publique des comptes depuis 2021', '1752773718.avif', 1, '2025-07-17 17:35:18', '2025-07-17 17:35:18'),
(4, 1, 'Bohicon', 'VERS DES TERRITOIRES CONNECTES ET VIVANTS : L’EXPERIENCE DE LA COMMUNE DE BOHICON', '1752773752.avif', 1, '2025-07-17 17:35:52', '2025-07-17 17:35:52');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `badge_color` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `badge_color`, `created_at`, `updated_at`) VALUES
(1, 'PARTICIPATION ET ENGAGEMENT CITOYEN / PARTICIPATION ET ENGAGEMENT CITOYEN / PARTICIPAÇÃO E ENVOLVIMENTO CIDADÃO', 'primary', '2025-07-16 13:39:28', '2025-07-16 13:39:28'),
(2, 'TERRITORIALISATION DES POLITIQUES PUBLIQUES ET AGENDAS INTERNATIONAUX DE DÉVELOPPEMENT / TERRITORIALIZATION OF PUBLIC POLICIES AND INTERNATIONAL DEVELOPMENT AGENDAS / TERRITORIALIZAÇÃO DE POLÍTICAS PÚBLICAS E AGENDAS INTERNACIONAIS DE DESENVOLVIMENTO', 'primary', '2025-07-16 13:39:50', '2025-07-16 13:39:50'),
(3, 'EFFICACITÉ ET EFFICIENCE BUDGÉTAIRE / BUDGETARY EFFICIENCY AND EFFECTIVENESS / EFICÁCIA E EFICIÊNCIA ORÇAMENTÁRIA', 'primary', '2025-07-16 13:40:09', '2025-07-16 13:40:09'),
(4, 'INCLUSION, EGALITÉ ET EQUITÉ /INCLUSION, EQUALITY AND EQUITY / INCLUSÃO, IGUALDADE E EQUIDADE', 'primary', '2025-07-16 13:40:30', '2025-07-16 13:40:30'),
(5, 'SOLIDARITÉ ET ASSISTANCE AUX COMMUNAUTÉS VULNÉRABLES / SOLIDARITY AND ASSISTANCE TO VULNERABLE COMMUNITIES / SOLIDARIEDADE E ASSISTÊNCIA A COMUNIDADES VULNERÁVEIS', 'primary', '2025-07-16 13:40:49', '2025-07-16 13:40:49'),
(6, 'TRANSPARENCE ET REDDITION DES COMPTES / TRANSPARENCY AND ACCOUNTABILITY / TRANSPARÊNCIA E PRESTAÇÃO DE CONTAS', 'primary', '2025-07-16 13:41:08', '2025-07-16 13:41:08');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_07_16_120003_create_categories_table', 1),
(6, '2025_07_16_120156_create_candidats_table', 1),
(7, '2025_07_17_111757_create_votes_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ibra Ndiaye', 'ibra789ndiaye@gmail.com', NULL, '$2y$10$Ns1HkTXGi3xgFCxr8WEE5OT6BHBgvrq5sF4w1NufMqSUJYOVHGh4u', NULL, '2025-07-16 16:43:43', '2025-07-16 16:43:43');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidat_id` bigint(20) UNSIGNED NOT NULL,
  `ip_adresse` varchar(255) NOT NULL,
  `voix` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `votes`
--

INSERT INTO `votes` (`id`, `candidat_id`, `ip_adresse`, `voix`, `created_at`, `updated_at`) VALUES
(1, 1, '127.0.0.2', 1, '2025-07-17 12:08:29', '2025-07-17 12:08:29'),
(2, 1, '127.0.0.3', 1, '2025-07-17 12:08:35', '2025-07-17 12:08:35'),
(3, 1, '127.0.0.4', 1, '2025-07-17 12:08:41', '2025-07-17 12:08:41'),
(4, 1, '127.0.0.5', 1, '2025-07-17 12:10:18', '2025-07-17 12:10:18'),
(7, 1, '127.0.0.6', 1, '2025-07-17 12:24:41', '2025-07-17 12:24:41'),
(8, 1, '127.0.0.1', 1, '2025-07-17 12:25:02', '2025-07-17 12:25:02'),
(9, 2, '127.0.0.1', 1, '2025-07-17 17:36:07', '2025-07-17 17:36:07'),
(10, 3, '127.0.0.1', 1, '2025-07-17 17:36:14', '2025-07-17 17:36:14'),
(11, 4, '127.0.0.1', 1, '2025-07-30 11:52:37', '2025-07-30 11:52:37');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidats`
--
ALTER TABLE `candidats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidats_categorie_id_foreign` (`categorie_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `votes_candidat_id_foreign` (`candidat_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidats`
--
ALTER TABLE `candidats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidats`
--
ALTER TABLE `candidats`
  ADD CONSTRAINT `candidats_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_candidat_id_foreign` FOREIGN KEY (`candidat_id`) REFERENCES `candidats` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
