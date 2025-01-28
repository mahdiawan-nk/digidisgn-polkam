-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 21 Jan 2025 pada 15.34
-- Versi server: 8.0.30
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app-qrsurat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jabatans`
--

CREATE TABLE `data_jabatans` (
  `id` int UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_jabatans`
--

INSERT INTO `data_jabatans` (`id`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Direktur', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(2, 'WD 1', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(3, 'WD 2', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(4, 'WD 3', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(5, 'Ka BPM', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(6, 'Ka P3M', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(7, 'Ka BPP', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(8, 'Ka Prodi TPS', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(9, 'Ka Prodi PPM', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(10, 'Ka Prodi TIF', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(11, 'Ka Prodi ABI', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(12, 'Ka Prodi TPKS', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(13, 'Ka Prodi PP', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(14, 'Ka Prodi MAB', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(15, 'Ka Prodi TRL', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(16, 'Ka BAA', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(17, 'Ka BAK', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(18, 'Ka BAKKU', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(19, 'Ka BAKHA', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(20, 'Ka UPT ICT', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(21, 'Ka UPT Perpustakaan', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(22, 'Ka Sub BAKU', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(23, 'Ka UPT PPA', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(24, 'Ka UPT Bisnis dan Pemasaran', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(25, 'Ka UPT PMB', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(26, 'Ka UPT Media Center', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(27, 'Ka UPT PPK-PK', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(28, 'Ka Lab TPS', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(29, 'Ka Workshop', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(30, 'Ka Lab TIF', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(31, 'Ka Lab PP', '2025-01-11 09:14:06', '2025-01-11 09:14:06'),
(32, 'Staff', '2025-01-11 10:16:33', '2025-01-11 10:16:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_14_091211_create_permission_tables', 1),
(5, '2024_12_14_092723_create_data_jabatans_table', 1),
(6, '2024_12_15_130308_create_surats_table', 1),
(7, '2025_01_10_220339_create_surat_validation_steps_table', 1),
(8, '2025_01_10_221252_create_surat_validation_logs_table', 1),
(9, '2025_01_11_150701_create_user_jabatans_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(7, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 6),
(7, 'App\\Models\\User', 6),
(5, 'App\\Models\\User', 7),
(7, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 9),
(6, 'App\\Models\\User', 9),
(4, 'App\\Models\\User', 10),
(6, 'App\\Models\\User', 10),
(4, 'App\\Models\\User', 11),
(6, 'App\\Models\\User', 11),
(4, 'App\\Models\\User', 12),
(6, 'App\\Models\\User', 12),
(8, 'App\\Models\\User', 13),
(8, 'App\\Models\\User', 14),
(8, 'App\\Models\\User', 15),
(8, 'App\\Models\\User', 16);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'surat-access', 'web', NULL, NULL),
(2, 'surat-create', 'web', NULL, NULL),
(3, 'surat-update', 'web', NULL, NULL),
(4, 'surat-delete', 'web', NULL, NULL),
(5, 'surat-validation', 'web', NULL, NULL),
(6, 'surat-verification', 'web', NULL, NULL),
(7, 'jabatan-access', 'web', NULL, NULL),
(8, 'jabatan-create', 'web', NULL, NULL),
(9, 'jabatan-update', 'web', NULL, NULL),
(10, 'jabatan-delete', 'web', NULL, NULL),
(11, 'user-access', 'web', NULL, NULL),
(12, 'user-create', 'web', NULL, NULL),
(13, 'user-update', 'web', NULL, NULL),
(14, 'user-delete', 'web', NULL, NULL),
(15, 'role-access', 'web', NULL, NULL),
(16, 'role-create', 'web', NULL, NULL),
(17, 'role-update', 'web', NULL, NULL),
(18, 'role-delete', 'web', NULL, NULL),
(19, 'permission-access', 'web', NULL, NULL),
(20, 'permission-create', 'web', NULL, NULL),
(21, 'permission-update', 'web', NULL, NULL),
(22, 'permission-delete', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2025-01-11 09:14:17', '2025-01-11 09:14:17'),
(2, 'operator', 'web', '2025-01-11 09:14:17', '2025-01-11 09:14:17'),
(3, 'validator-direktur', 'web', '2025-01-11 09:14:17', '2025-01-11 09:14:17'),
(4, 'validator-kabag', 'web', '2025-01-11 09:14:17', '2025-01-11 09:14:17'),
(5, 'validator-wd', 'web', '2025-01-11 09:14:17', '2025-01-11 09:14:17'),
(6, 'verifikator-kabag', 'web', '2025-01-11 09:14:17', '2025-01-11 09:14:17'),
(7, 'verifikator-wd', 'web', '2025-01-11 09:14:17', '2025-01-11 09:14:17'),
(8, 'staff', 'web', '2025-01-11 09:14:17', '2025-01-11 09:14:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(1, 3),
(5, 3),
(1, 4),
(5, 4),
(1, 5),
(5, 5),
(1, 6),
(6, 6),
(1, 7),
(6, 7),
(1, 8),
(2, 8),
(3, 8),
(4, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surats`
--

CREATE TABLE `surats` (
  `id` int UNSIGNED NOT NULL,
  `nomor_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_surat` date NOT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pengajuan` enum('in prosess','in verification','in validation','returned','finished','re-submited') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in prosess',
  `pengirim_id` bigint UNSIGNED NOT NULL,
  `validation_rule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qr_code_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_validation_logs`
--

CREATE TABLE `surat_validation_logs` (
  `id` int UNSIGNED NOT NULL,
  `surat_id` int UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `validation_step` int NOT NULL,
  `action` enum('submited','verified','approved','rejected','re-submited') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_validation_steps`
--

CREATE TABLE `surat_validation_steps` (
  `id` int UNSIGNED NOT NULL,
  `surat_id` int UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `step_order` int NOT NULL,
  `role_required` enum('verifikator-kabag','verifikator-wd','validator-kabag','validator-wd','validator-direktur') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@mail.com', NULL, '$2y$12$n3VChN/GzpYpQKiH/kkqR.q8iZf/q8egQtwmUTYF2GU8.ybKcywIK', NULL, '2025-01-11 09:16:24', '2025-01-11 09:16:24'),
(3, 'Staff Humas', 'staff-humas@mail.com', NULL, '$2y$12$uSJMJi5u60q6jjfIDpMom.eCnXWSu7Q/wF7pse78c21FU7czlZ2DC', 'utNmMSPNP3bUFVjLxrqm2XQVo2aSS9qv5VRdQ9ENly106vEaPBCczOFG8DVo', '2025-01-11 10:17:21', '2025-01-11 10:17:21'),
(4, 'Direktur', 'direktur@mail.com', NULL, '$2y$12$Au3lDm7McwT24v0UkOf1su/xswccPOFSIRSz1gsYc1G4wga7phHLG', 'AnYFw2sf33VJo12zwZ3BDMcMS8QOut38hax6IQvBaKTk4DsZy8HJW3oyjwLc', '2025-01-11 10:29:26', '2025-01-11 10:29:26'),
(5, 'Wakil Direktur 1', 'wadir_1@mail.com', NULL, '$2y$12$pQHctfTt9C9MHAEyyIqPde4wSVINMuJe92/Fik03NlwdG2d.YE5J.', NULL, '2025-01-11 10:30:43', '2025-01-11 10:30:43'),
(6, 'Wakil Direktur 2', 'wadir_2@mail.com', NULL, '$2y$12$F.rM573cG/zuM8AErj991O5QccBoB0Wl9sHUaItEEenPGhaOiLIaq', NULL, '2025-01-11 10:31:53', '2025-01-11 10:31:53'),
(7, 'Wakil Direktur 3', 'wadir_3@mail.com', NULL, '$2y$12$.0XdJDIHi3I7VVdOgYjV4.N41/yUXlkQ95LwTXpavt0uQgMORZEoq', NULL, '2025-01-11 10:32:48', '2025-01-11 10:32:48'),
(9, 'Ketua BAA', 'baa@mail.com', NULL, '$2y$12$OKMr7swAeWq8hwUWzpGDPeZm8tUv9e/cDc3SPyzshVr5BQG12zosC', '2gE1MAToTMke8DyTCM13blaPVGPicUlo60wYBDIxQODJDhgqg1psJs4Qav6N', '2025-01-11 10:37:30', '2025-01-11 10:37:30'),
(10, 'Ketua BAK', 'bak@mail.com', NULL, '$2y$12$hNWz88eDrjKH4AyuMEfDDe7qN6NdrSbuwWjfEgAGvs7E7rOHKAiMC', NULL, '2025-01-11 10:38:12', '2025-01-11 10:38:12'),
(11, 'Ketua BAKKU', 'bakku@mail.com', NULL, '$2y$12$WDYQCgV2aiCNqQTRmyQLjeu.imX877fRmx17kmmX45StiikboyF5C', NULL, '2025-01-11 10:38:54', '2025-01-11 10:38:54'),
(12, 'Ketua BAKHA', 'bakha@mail.com', NULL, '$2y$12$xjrmvaQYe/XbTEsBVKNhd.tjAj87iFtWHIwK9O7MQLqeWlTghkg/m', NULL, '2025-01-11 10:39:46', '2025-01-11 10:39:46'),
(13, 'Staff BAA', 'staff-baa@mail.com', NULL, '$2y$12$mnfgXbIqq5BFqocel//tr.70pINkbHukTzbM9PEDceLzyHRw1QASq', NULL, '2025-01-11 10:43:36', '2025-01-11 10:43:36'),
(14, 'Staff BAK', 'staff-bak@mail.com', NULL, '$2y$12$/.QAsLicR/f3JxOZanrDj.6u85qgA1IN6cIKWCwUWUeT1gFjtPfGC', NULL, '2025-01-11 10:44:30', '2025-01-11 10:44:30'),
(15, 'Staff BAKKU', 'staff-bakku@mail.com', NULL, '$2y$12$EhbJK19pkp060SAoywJlqu91GMLSIsFj5QMvv0U4AdFZugBKuJee6', NULL, '2025-01-11 10:45:29', '2025-01-11 10:45:29'),
(16, 'Staff BAKHA', 'staff-bakha@mail.com', NULL, '$2y$12$qRpWNwO/XBMMFY2oTk/oYeBSPc6nMh9qQGIh2Tj02Rxn1T3pTcM2S', NULL, '2025-01-11 10:46:07', '2025-01-11 10:46:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_jabatans`
--

CREATE TABLE `user_jabatans` (
  `id` int UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `jabatan_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_jabatans`
--

INSERT INTO `user_jabatans` (`id`, `user_id`, `jabatan_id`, `created_at`, `updated_at`) VALUES
(1, 1, 20, '2025-01-11 09:46:29', '2025-01-11 09:46:29'),
(3, 3, 32, '2025-01-11 10:17:21', '2025-01-11 10:17:21'),
(4, 4, 1, '2025-01-11 10:29:26', '2025-01-11 10:29:26'),
(5, 5, 2, '2025-01-11 10:30:43', '2025-01-11 10:30:43'),
(6, 6, 3, '2025-01-11 10:31:53', '2025-01-11 10:31:53'),
(7, 7, 4, '2025-01-11 10:32:48', '2025-01-11 10:32:48'),
(9, 9, 16, '2025-01-11 10:37:30', '2025-01-11 10:37:30'),
(10, 10, 17, '2025-01-11 10:38:12', '2025-01-11 10:38:12'),
(11, 11, 18, '2025-01-11 10:38:54', '2025-01-11 10:38:54'),
(12, 12, 19, '2025-01-11 10:39:46', '2025-01-11 10:39:46'),
(13, 13, 32, '2025-01-11 10:43:36', '2025-01-11 10:43:36'),
(14, 14, 32, '2025-01-11 10:44:30', '2025-01-11 10:44:30'),
(15, 15, 32, '2025-01-11 10:45:29', '2025-01-11 10:45:29'),
(16, 16, 32, '2025-01-11 10:46:07', '2025-01-11 10:46:07');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `data_jabatans`
--
ALTER TABLE `data_jabatans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `surats`
--
ALTER TABLE `surats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_validation_logs`
--
ALTER TABLE `surat_validation_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_validation_logs_surat_id_foreign` (`surat_id`),
  ADD KEY `surat_validation_logs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `surat_validation_steps`
--
ALTER TABLE `surat_validation_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_validation_steps_surat_id_foreign` (`surat_id`),
  ADD KEY `surat_validation_steps_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `user_jabatans`
--
ALTER TABLE `user_jabatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_jabatans_user_id_foreign` (`user_id`),
  ADD KEY `user_jabatans_jabatan_id_foreign` (`jabatan_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_jabatans`
--
ALTER TABLE `data_jabatans`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `surats`
--
ALTER TABLE `surats`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `surat_validation_logs`
--
ALTER TABLE `surat_validation_logs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `surat_validation_steps`
--
ALTER TABLE `surat_validation_steps`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user_jabatans`
--
ALTER TABLE `user_jabatans`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_validation_logs`
--
ALTER TABLE `surat_validation_logs`
  ADD CONSTRAINT `surat_validation_logs_surat_id_foreign` FOREIGN KEY (`surat_id`) REFERENCES `surats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `surat_validation_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_validation_steps`
--
ALTER TABLE `surat_validation_steps`
  ADD CONSTRAINT `surat_validation_steps_surat_id_foreign` FOREIGN KEY (`surat_id`) REFERENCES `surats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `surat_validation_steps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_jabatans`
--
ALTER TABLE `user_jabatans`
  ADD CONSTRAINT `user_jabatans_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `data_jabatans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_jabatans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
