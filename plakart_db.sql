-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/02/2025 às 03:31
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `plakart_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `campeonatos`
--

CREATE TABLE `campeonatos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `etapas` int(11) NOT NULL DEFAULT 1 COMMENT 'Mínimo: 1, Máximo: 16',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `campeonatos`
--

INSERT INTO `campeonatos` (`id`, `nome`, `etapas`, `created_at`, `updated_at`) VALUES
(1, 'Champions', 4, '2025-02-02 02:10:15', '2025-02-02 03:12:28'),
(2, 'Betinhas', 6, '2025-02-02 03:17:49', '2025-02-03 06:27:19');

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipes`
--

CREATE TABLE `equipes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `campeonato_id` bigint(20) UNSIGNED NOT NULL,
  `chefe_nome` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `equipes`
--

INSERT INTO `equipes` (`id`, `nome`, `campeonato_id`, `chefe_nome`, `created_at`, `updated_at`) VALUES
(7, 'Ferrari', 1, 'Vasemir', '2025-02-02 03:49:57', '2025-02-02 03:49:57'),
(8, 'Mercedes', 1, 'Toto Wolf', '2025-02-02 03:50:47', '2025-02-02 03:50:47'),
(11, 'Red Bull Oracle', 1, 'Cristhian Horner', '2025-02-02 05:01:19', '2025-02-03 01:24:23'),
(12, 'Mclaren', 2, 'Geralt De Rivia', '2025-02-03 01:16:47', '2025-02-03 01:19:32'),
(13, 'IFMS-Fasters', 2, 'Ivones', '2025-02-03 06:26:05', '2025-02-03 06:27:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipe_piloto`
--

CREATE TABLE `equipe_piloto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipe_id` bigint(20) UNSIGNED NOT NULL,
  `piloto_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `equipe_piloto`
--

INSERT INTO `equipe_piloto` (`id`, `equipe_id`, `piloto_id`, `created_at`, `updated_at`) VALUES
(13, 7, 13, NULL, NULL),
(14, 7, 14, NULL, NULL),
(15, 8, 15, NULL, NULL),
(16, 8, 16, NULL, NULL),
(21, 11, 21, NULL, NULL),
(22, 11, 22, NULL, NULL),
(23, 12, 23, NULL, NULL),
(24, 12, 24, NULL, NULL),
(25, 13, 25, NULL, NULL),
(26, 13, 26, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `etapas`
--

CREATE TABLE `etapas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campeonato_id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `etapas`
--

INSERT INTO `etapas` (`id`, `campeonato_id`, `nome`, `numero`, `data`, `created_at`, `updated_at`) VALUES
(1, 1, 'GP do Brasil', 1, '2025-03-10', '2025-02-03 04:24:58', '2025-02-03 04:24:58'),
(4, 1, 'GP de Corumbá', 2, '2025-02-18', '2025-02-03 04:57:55', '2025-02-03 04:57:55'),
(5, 2, 'GP de Corumbá', 1, '2025-03-25', '2025-02-03 04:59:52', '2025-02-03 04:59:52'),
(6, 2, 'GP de Aquiduana', 2, '2025-02-20', '2025-02-03 06:24:29', '2025-02-03 06:24:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `etapa_piloto`
--

CREATE TABLE `etapa_piloto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `etapa_id` bigint(20) UNSIGNED NOT NULL,
  `piloto_id` bigint(20) UNSIGNED NOT NULL,
  `posicao` int(11) NOT NULL,
  `pontos` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `etapa_piloto`
--

INSERT INTO `etapa_piloto` (`id`, `etapa_id`, `piloto_id`, `posicao`, `pontos`, `created_at`, `updated_at`) VALUES
(1, 1, 14, 4, 12, NULL, NULL),
(2, 1, 13, 1, 25, NULL, NULL),
(3, 1, 21, 3, 15, NULL, NULL),
(4, 1, 15, 6, 8, NULL, NULL),
(5, 1, 16, 2, 18, NULL, NULL),
(6, 1, 22, 5, 10, NULL, NULL),
(7, 4, 13, 1, 25, NULL, NULL),
(8, 4, 22, 2, 18, NULL, NULL),
(9, 4, 14, 3, 15, NULL, NULL),
(10, 4, 21, 4, 12, NULL, NULL),
(11, 4, 15, 5, 10, NULL, NULL),
(12, 4, 16, 6, 8, NULL, NULL),
(13, 5, 24, 3, 15, NULL, NULL),
(14, 5, 23, 1, 25, NULL, NULL),
(15, 5, 25, 2, 18, NULL, NULL),
(16, 5, 26, 4, 12, NULL, NULL),
(17, 6, 26, 1, 25, NULL, NULL),
(18, 6, 23, 2, 18, NULL, NULL),
(19, 6, 24, 3, 15, NULL, NULL),
(20, 6, 25, 4, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
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
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_02_01_182738_create_pilotos_table', 1),
(6, '2025_02_01_182739_create_campeonatos_table', 1),
(7, '2025_02_01_182740_create_equipes_table', 1),
(8, '2025_02_01_183536_create_equipe_piloto_table', 1),
(10, '2025_02_02_224645_create_etapas_table', 2),
(11, '2025_02_03_011314_create_etapa_piloto_table', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pilotos`
--

CREATE TABLE `pilotos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pilotos`
--

INSERT INTO `pilotos` (`id`, `nome`, `numero`, `created_at`, `updated_at`) VALUES
(13, 'Lewis Hamilton', 44, '2025-02-02 03:49:57', '2025-02-02 03:49:57'),
(14, 'Charles Leclerc', 16, '2025-02-02 03:49:57', '2025-02-02 03:53:19'),
(15, 'Kimi Antonielle', 12, '2025-02-02 03:50:47', '2025-02-02 03:50:47'),
(16, 'Russell', 27, '2025-02-02 03:50:47', '2025-02-02 03:50:47'),
(21, 'Max Vestappen', 33, '2025-02-02 05:01:19', '2025-02-02 05:01:19'),
(22, 'Lian Lawson', 85, '2025-02-02 05:01:19', '2025-02-03 01:02:59'),
(23, 'Albatroz Feroz', 22, '2025-02-03 01:16:47', '2025-02-03 01:16:47'),
(24, 'Renatin Cariani', 45, '2025-02-03 01:16:47', '2025-02-03 01:16:47'),
(25, 'Lucas Silva', 31, '2025-02-03 06:26:05', '2025-02-03 06:26:05'),
(26, 'Gustavo Sabia', 19, '2025-02-03 06:26:05', '2025-02-03 06:26:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
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
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `campeonatos`
--
ALTER TABLE `campeonatos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipes_campeonato_id_foreign` (`campeonato_id`);

--
-- Índices de tabela `equipe_piloto`
--
ALTER TABLE `equipe_piloto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipe_piloto_equipe_id_foreign` (`equipe_id`),
  ADD KEY `equipe_piloto_piloto_id_foreign` (`piloto_id`);

--
-- Índices de tabela `etapas`
--
ALTER TABLE `etapas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_etapas_campeonato` (`campeonato_id`);

--
-- Índices de tabela `etapa_piloto`
--
ALTER TABLE `etapa_piloto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etapa_piloto_etapa_id_foreign` (`etapa_id`),
  ADD KEY `etapa_piloto_piloto_id_foreign` (`piloto_id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `pilotos`
--
ALTER TABLE `pilotos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pilotos_numero_unique` (`numero`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `campeonatos`
--
ALTER TABLE `campeonatos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `equipe_piloto`
--
ALTER TABLE `equipe_piloto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `etapas`
--
ALTER TABLE `etapas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `etapa_piloto`
--
ALTER TABLE `etapa_piloto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pilotos`
--
ALTER TABLE `pilotos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `equipes_campeonato_id_foreign` FOREIGN KEY (`campeonato_id`) REFERENCES `campeonatos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `equipe_piloto`
--
ALTER TABLE `equipe_piloto`
  ADD CONSTRAINT `equipe_piloto_equipe_id_foreign` FOREIGN KEY (`equipe_id`) REFERENCES `equipes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `equipe_piloto_piloto_id_foreign` FOREIGN KEY (`piloto_id`) REFERENCES `pilotos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `etapas`
--
ALTER TABLE `etapas`
  ADD CONSTRAINT `fk_etapas_campeonato` FOREIGN KEY (`campeonato_id`) REFERENCES `campeonatos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `etapa_piloto`
--
ALTER TABLE `etapa_piloto`
  ADD CONSTRAINT `etapa_piloto_etapa_id_foreign` FOREIGN KEY (`etapa_id`) REFERENCES `etapas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `etapa_piloto_piloto_id_foreign` FOREIGN KEY (`piloto_id`) REFERENCES `pilotos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
