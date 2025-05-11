-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 11 mai 2025 à 12:53
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
-- Base de données : `forum_prison`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `id` int(11) NOT NULL,
  `action_type` varchar(50) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `target_username` varchar(255) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin_logs`
--

INSERT INTO `admin_logs` (`id`, `action_type`, `admin_username`, `target_username`, `post_id`, `created_at`) VALUES
(46, '', 'admin_user', 'userF1553./', NULL, '2025-04-27 19:32:21'),
(47, '', 'admin_user', 'System', NULL, '2025-04-27 19:32:23'),
(48, '', 'admin_user', 'USER5555k.', NULL, '2025-04-27 19:32:26'),
(49, '', 'admin_user', 'USER5555k.', NULL, '2025-04-27 19:32:28'),
(50, '', 'admin_user', 'System', NULL, '2025-04-27 19:35:04'),
(51, '', 'admin_user', 'System', NULL, '2025-04-27 19:35:06'),
(52, '', 'admin_user', 'john_doe', NULL, '2025-04-27 19:36:10'),
(53, '', 'admin_user', 'USER5555k.', NULL, '2025-04-27 19:36:13'),
(54, '', 'admin_user', 'System', NULL, '2025-04-28 00:53:40'),
(55, '', 'admin_user', 'USER5555k.', NULL, '2025-04-28 00:54:04'),
(56, '', 'admin_user', 'john_doe', NULL, '2025-04-28 00:56:46'),
(57, '', 'admin_user', 'userF1553./', NULL, '2025-04-28 00:56:50'),
(58, '', 'admin_user', 'System', NULL, '2025-04-28 00:58:57'),
(59, '', 'admin_user', 'System', NULL, '2025-04-28 00:59:01'),
(60, '', 'admin_user', 'System', NULL, '2025-04-28 00:59:03'),
(61, '', 'admin_user', 'USER5555k.', NULL, '2025-04-28 00:59:08'),
(62, '', 'admin_user', 'john_doe', NULL, '2025-04-28 00:59:13'),
(63, '', 'admin_user', 'john_doe', NULL, '2025-04-28 00:59:16'),
(64, '', 'admin_user', 'userF1553./', NULL, '2025-04-28 01:02:46'),
(65, '', 'admin_user', 'userF1553./', NULL, '2025-04-28 01:02:48'),
(66, '', 'admin_user', 'userF1553./', NULL, '2025-04-28 01:02:50'),
(67, '', 'admin_user', 'USER5555k.', NULL, '2025-04-28 01:02:53'),
(68, '', 'admin_user', 'john_doe', NULL, '2025-04-28 01:03:04'),
(69, '', 'admin_user', 'john_doe', NULL, '2025-04-28 01:03:08'),
(70, '', 'admin_user', 'john_doe', NULL, '2025-04-28 01:03:11'),
(71, '', 'admin_user', 'john_doe', NULL, '2025-04-28 01:03:14'),
(72, 'warn_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:06:17'),
(73, 'promote_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:06:20'),
(74, 'ban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:06:24'),
(75, 'unban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:06:26'),
(76, 'demote_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:06:29'),
(77, 'promote_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:17:10'),
(78, 'ban_user', 'admin_user', 'userF1553./', NULL, '2025-04-28 01:24:57'),
(79, 'unban_user', 'admin_user', 'userF1553./', NULL, '2025-04-28 01:25:00'),
(80, 'ban_user', 'admin_user', 'userF1553./', NULL, '2025-04-28 01:26:32'),
(81, 'unban_user', 'admin_user', 'userF1553./', NULL, '2025-04-28 01:26:35'),
(82, 'ban_user', 'admin_user', 'USER5555k.', NULL, '2025-04-28 01:26:45'),
(83, 'ban_user', 'admin_user', 'john_doe', NULL, '2025-04-28 01:30:16'),
(84, 'ban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:35:28'),
(85, 'unban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:35:32'),
(86, 'ban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:35:45'),
(87, 'unban_user', 'admin_user', 'USER5555k.', NULL, '2025-04-28 01:38:16'),
(88, 'ban_user', 'admin_user', 'USER5555k.', NULL, '2025-04-28 01:38:34'),
(89, 'ban_user', 'admin_user', 'userF1553./', NULL, '2025-04-28 01:42:08'),
(90, 'ban_user', 'admin_user', 'System', NULL, '2025-04-28 01:43:28'),
(91, 'unban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:44:59'),
(92, 'ban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:45:04'),
(93, 'unban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:45:08'),
(94, 'ban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:45:12'),
(95, 'unban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:45:15'),
(96, 'ban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:45:20'),
(97, 'unban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:45:23'),
(98, 'ban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:45:30'),
(99, 'unban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:46:08'),
(100, 'ban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:46:16'),
(101, 'unban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:47:38'),
(102, 'ban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:47:45'),
(103, 'unban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:47:56'),
(104, 'ban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:47:59'),
(105, 'unban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:49:17'),
(106, 'ban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:49:24'),
(107, 'unban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:49:33'),
(108, 'ban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:49:40'),
(109, 'unban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:52:08'),
(110, 'ban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 01:52:18'),
(111, 'unban_user', 'admin_user', 'userF1553./', NULL, '2025-04-28 17:03:49'),
(112, 'unban_user', 'admin_user', 'john_doe', NULL, '2025-04-28 17:03:53'),
(113, 'unban_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 17:03:55'),
(114, 'unban_user', 'admin_user', 'USER5555k.', NULL, '2025-04-28 17:03:56'),
(115, 'unban_user', 'admin_user', 'System', NULL, '2025-04-28 17:03:59'),
(116, 'warn_user', 'admin_user', 'userF1553./', NULL, '2025-04-28 17:04:02'),
(117, 'promote_user', 'admin_user', 'System', NULL, '2025-04-28 17:04:04'),
(118, 'demote_user', 'admin_user', 'System', NULL, '2025-04-28 17:04:05'),
(119, 'demote_user', 'admin_user', 'jane_doe', NULL, '2025-04-28 17:22:36'),
(120, 'promote_user', 'admin_user', 'john_doe', NULL, '2025-04-28 18:41:11'),
(121, 'ban_user', 'admin_user', 'john_doe', NULL, '2025-04-28 18:41:28'),
(122, 'unban_user', 'admin_user', 'john_doe', NULL, '2025-04-28 18:41:35'),
(123, 'warn_user', 'admin_user', 'john_doe', NULL, '2025-04-28 18:41:36'),
(124, 'demote_user', 'admin_user', 'john_doe', NULL, '2025-04-28 18:41:39'),
(125, 'promote_user', 'admin_user', 'john_doe', NULL, '2025-04-28 18:41:40'),
(126, 'ban_user', 'admin_user', 'john_doed', NULL, '2025-04-28 19:33:35'),
(127, 'unban_user', 'admin_user', 'john_doed', NULL, '2025-04-28 19:33:38'),
(128, 'warn_user', 'admin_user', 'john_doed', NULL, '2025-04-28 19:33:39'),
(129, 'warn_user', 'admin_user', 'john_doed', NULL, '2025-04-28 19:33:42'),
(130, 'VALIDATE_POST', 'admin_user', NULL, 5, '2025-05-04 18:09:04'),
(131, 'VALIDATE_POST', 'admin_user', NULL, 16, '2025-05-10 20:52:23'),
(132, 'VALIDATE_POST', 'admin_user', NULL, 15, '2025-05-10 20:52:25'),
(133, 'promote_user', 'admin_user', 'Fullzzuptest@gl.com93sf', NULL, '2025-05-11 03:26:19'),
(134, 'demote_user', 'admin_user', 'Fullzzuptest@gl.com93sf', NULL, '2025-05-11 03:26:20'),
(135, 'promote_user', 'admin_user', 'Fullzzuptest@gl.com93sf', NULL, '2025-05-11 03:37:49'),
(136, 'ban_user', 'admin_user', 'Fullhhhhhuptest@gl.vcom93', NULL, '2025-05-11 03:40:38'),
(137, 'unban_user', 'admin_user', 'Fullhhhhhuptest@gl.vcom93', NULL, '2025-05-11 03:44:09'),
(138, 'unban_user', 'admin_user', 'Fullhhhhhuptest@gl.vcom93', NULL, '2025-05-11 03:44:22'),
(139, 'ban_user', 'admin_user', 'Fullhhhhhuptest@gl.vcom93', NULL, '2025-05-11 03:44:30');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  `dislikes` int(11) DEFAULT 0,
  `reported` tinyint(1) DEFAULT 0,
  `tag` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `last_activity_at` datetime DEFAULT current_timestamp(),
  `validated_by_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `parent_id`, `author`, `content`, `attachment`, `user_id`, `likes`, `dislikes`, `reported`, `tag`, `created_at`, `updated_at`, `last_activity_at`, `validated_by_admin`) VALUES
(74, 7, NULL, '', 'grzgrezgergegr99999', NULL, 13, 0, 0, 0, NULL, '2025-05-04 22:45:34', '2025-05-06 02:25:44', '2025-05-04 22:45:34', 1),
(76, 7, NULL, '', '1', '6817dc9f8e41d_HQwHI.jpg', 59, 0, 0, 0, NULL, '2025-05-04 23:31:11', NULL, '2025-05-04 23:31:11', 1),
(77, 7, NULL, '', 'DGDG', NULL, 59, 0, 0, 0, '9333', '2025-05-05 00:40:37', NULL, '2025-05-05 00:40:37', 1),
(78, 7, NULL, '', 'ah bah we hein', NULL, 13, 0, 0, 0, '9330', '2025-05-05 20:38:54', NULL, '2025-05-05 20:38:54', 0),
(79, 7, NULL, '', '1', NULL, 13, 0, 0, 0, 'Aide', '2025-05-06 02:26:10', NULL, '2025-05-06 02:26:10', 0),
(80, 7, NULL, '', '111', NULL, 13, 0, 0, 0, 'Aide', '2025-05-06 02:27:24', NULL, '2025-05-06 02:27:24', 0),
(81, 7, NULL, '', 'f', NULL, 13, 0, 0, 0, 'Question', '2025-05-06 02:37:01', NULL, '2025-05-06 02:37:01', 0),
(82, 7, NULL, '', 'f', NULL, 13, 0, 0, 0, 'Important', '2025-05-06 02:37:12', '2025-05-06 02:55:34', '2025-05-06 02:37:12', 0),
(83, 7, NULL, '', 'a', NULL, 13, 0, 0, 0, 'Discussion', '2025-05-06 02:37:18', NULL, '2025-05-06 02:37:18', 0),
(84, 7, NULL, '', '2', NULL, 13, 0, 0, 0, NULL, '2025-05-06 03:12:34', NULL, '2025-05-06 03:12:34', 0),
(85, 8, NULL, '', 'THTTH', NULL, 13, 0, 0, 0, NULL, '2025-05-10 01:43:48', NULL, '2025-05-10 01:43:48', 0),
(86, 8, NULL, '', '333', NULL, 13, 0, 0, 0, NULL, '2025-05-10 02:03:02', NULL, '2025-05-10 02:03:02', 0),
(87, 8, NULL, '', 'th', NULL, 13, 0, 0, 0, NULL, '2025-05-10 15:28:35', NULL, '2025-05-10 15:28:35', 0),
(88, 9, NULL, '', 'd', NULL, 13, 0, 0, 0, NULL, '2025-05-10 15:29:37', NULL, '2025-05-10 15:29:37', 0),
(89, 9, NULL, '', 'rgzeg', NULL, 13, 0, 0, 0, NULL, '2025-05-10 15:40:15', NULL, '2025-05-10 15:40:15', 0),
(90, 8, NULL, '', 'h', NULL, 13, 0, 0, 0, NULL, '2025-05-10 15:52:46', NULL, '2025-05-10 15:52:46', 0),
(91, 10, NULL, '', ',', NULL, 13, 0, 0, 0, NULL, '2025-05-10 15:59:10', NULL, '2025-05-10 15:59:10', 0),
(92, 10, NULL, '', 'ngngfn', NULL, 13, 0, 0, 0, 'Discussion', '2025-05-10 16:24:24', NULL, '2025-05-10 16:24:24', 0),
(93, 10, 92, '', '> @undefined : undefined\r\n\r\nnnggfn', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:24:30', NULL, '2025-05-10 16:24:30', 0),
(94, 10, 93, '', '> @undefined : undefined\r\n\r\ngnddwgn', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:24:36', NULL, '2025-05-10 16:24:36', 0),
(95, 10, 92, '', '> @admin_user : ngngfn\n\ngtherherherhrhehrzhzhrzserraraz9r9ra5rar2ara2eae2\ndherherh\nhzh\nrh\nzh\nh', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:26:35', '2025-05-10 16:26:57', '2025-05-10 16:26:35', 0),
(96, 10, 95, '', '> @admin_user : > @admin_user : ngngfn\r\n\r\ng\r\n\r\nbghggg', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:27:03', NULL, '2025-05-10 16:27:03', 0),
(97, 10, 95, '', '> @admin_user : > @admin_user : ngngfn\r\n\r\ngtherherherhrhehrzhzhrzserraraz9r9ra5rar2ara2eae2\r\ndhe...\r\n\r\n9393', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:27:20', NULL, '2025-05-10 16:27:20', 0),
(98, 10, 97, '', '> @admin_user : > @admin_user : > @admin_user : ngngfn\r\n\r\ngtherherherhrhehrzhzhrzserraraz9r9r...\r\n\r\nhreherh', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:28:39', NULL, '2025-05-10 16:28:39', 0),
(99, 10, 98, '', '> @admin_user : > @admin_user : > @admin_user : > @admin_user : ngngfn\r\n\r\ngtherherherhrhehrzh...', '681f62a3d0564_hsfd.png', 13, 0, 0, 0, NULL, '2025-05-10 16:28:51', NULL, '2025-05-10 16:28:51', 0),
(100, 10, 91, '', '> @admin_user : ,\r\n\r\n2', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:43:55', NULL, '2025-05-10 16:43:55', 0),
(101, 10, 94, '', '> @admin_user : > @undefined : undefined\r\n\r\ngnddwgn\r\n\r\nggg', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:44:23', NULL, '2025-05-10 16:44:23', 0),
(102, 10, 91, '', '> @admin_user : ,\r\n\r\ngzegrz', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:50:11', NULL, '2025-05-10 16:50:11', 0),
(103, 10, 91, '', '> @admin_user : ,\r\n\r\ngggg', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:50:15', NULL, '2025-05-10 16:50:15', 0),
(104, 10, 103, '', '> @admin_user : > @admin_user : ,\r\n\r\ngggg\r\n\r\nrgrg', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:50:43', NULL, '2025-05-10 16:50:43', 0),
(105, 10, 92, '', '> @admin_user : ngngfn\r\n\r\nhhh', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:50:49', NULL, '2025-05-10 16:50:49', 0),
(106, 10, 91, '', '> @admin_user : ,\r\n\r\nfef', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:51:26', NULL, '2025-05-10 16:51:26', 0),
(107, 10, 91, '', '> @admin_user : ,\r\n\r\nggg', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:52:12', NULL, '2025-05-10 16:52:12', 0),
(108, 10, 91, '', '> @admin_user : ,\r\n\r\nrr', NULL, 13, 0, 0, 0, '', '2025-05-10 16:54:33', NULL, '2025-05-10 16:54:33', 0),
(109, 10, 91, '', '> @admin_user : ,\r\n\r\n3666', NULL, 13, 0, 0, 0, '', '2025-05-10 16:54:39', NULL, '2025-05-10 16:54:39', 0),
(110, 10, 100, '', '> @admin_user : > @admin_user : ,\r\n\r\n2\r\n\r\nf', NULL, 13, 0, 0, 0, '', '2025-05-10 16:54:44', NULL, '2025-05-10 16:54:44', 0),
(111, 10, 91, '', '> @admin_user : ,\r\n\r\nff', NULL, 13, 0, 0, 0, '', '2025-05-10 16:56:43', NULL, '2025-05-10 16:56:43', 0),
(112, 10, NULL, '', 'ggg', NULL, 13, 0, 0, 0, '', '2025-05-10 16:57:19', NULL, '2025-05-10 16:57:19', 0),
(113, 10, NULL, '', 'ggg', NULL, 13, 0, 0, 0, '', '2025-05-10 16:57:19', NULL, '2025-05-10 16:57:19', 0),
(114, 10, NULL, '', 'fff', NULL, 13, 0, 0, 0, '', '2025-05-10 16:57:36', NULL, '2025-05-10 16:57:36', 0),
(115, 10, NULL, '', 'fzgz', NULL, 13, 0, 0, 0, '', '2025-05-10 16:57:40', NULL, '2025-05-10 16:57:40', 0),
(116, 10, 91, '', '> @admin_user : ,\r\n\r\nsgsdg', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:57:44', NULL, '2025-05-10 16:57:44', 0),
(117, 10, 115, '', '> @admin_user : fzgz\r\n\r\n9327ze', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:57:56', NULL, '2025-05-10 16:57:56', 0),
(118, 10, 91, '', '> @admin_user : ,\r\n\r\ngg', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:59:18', NULL, '2025-05-10 16:59:18', 0),
(119, 8, 85, '', '> @admin_user : THTTH\r\n\r\ngg', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:59:27', NULL, '2025-05-10 16:59:27', 0),
(120, 8, 119, '', '> @admin_user : > @admin_user : THTTH\r\n\r\ngg\r\n\r\n12', NULL, 13, 0, 0, 0, NULL, '2025-05-10 16:59:32', NULL, '2025-05-10 16:59:32', 0),
(121, 8, NULL, '', 'bb', NULL, 13, 0, 0, 0, '', '2025-05-10 16:59:36', NULL, '2025-05-10 16:59:36', 0),
(122, 8, NULL, '', 'bb', NULL, 13, 0, 0, 0, '', '2025-05-10 16:59:39', NULL, '2025-05-10 16:59:39', 0),
(123, 8, 85, '', '> @admin_user : THTTH\r\n\r\n93', NULL, 59, 0, 0, 0, NULL, '2025-05-10 17:21:49', NULL, '2025-05-10 17:21:49', 0),
(124, 8, 120, '', '> @admin_user : > @admin_user : > @admin_user : THTTH\r\n\r\ngg\r\n\r\n12\r\n\r\n222', NULL, 59, 0, 0, 0, NULL, '2025-05-10 17:22:01', NULL, '2025-05-10 17:22:01', 0),
(125, 57, NULL, '', '555', NULL, 13, 0, 0, 0, '', '2025-05-11 00:37:52', NULL, '2025-05-11 00:37:52', 0),
(126, 57, 125, '', '> @admin_user : 555\r\n\r\n5', NULL, 13, 0, 0, 0, NULL, '2025-05-11 00:38:00', NULL, '2025-05-11 00:38:00', 0),
(127, 57, NULL, '', '5', NULL, 13, 0, 0, 0, '', '2025-05-11 00:38:03', NULL, '2025-05-11 00:38:03', 0),
(128, 57, NULL, '', '6', NULL, 13, 0, 0, 0, '', '2025-05-11 00:38:06', NULL, '2025-05-11 00:38:06', 0),
(129, 57, 128, '', '> @admin_user : 6\r\n\r\n8', NULL, 13, 0, 0, 0, NULL, '2025-05-11 00:38:11', NULL, '2025-05-11 00:38:11', 0),
(130, 57, 125, '', '> @admin_user : 555\r\n\r\n3333', NULL, 59, 0, 0, 0, NULL, '2025-05-11 00:38:55', NULL, '2025-05-11 00:38:55', 0),
(131, 57, 125, '', '> @admin_user : 555\r\n\r\naaa', NULL, 59, 0, 0, 0, NULL, '2025-05-11 00:39:43', NULL, '2025-05-11 00:39:43', 0),
(132, 57, 128, '', '> @admin_user : 6\r\n\r\ngg', NULL, 59, 0, 0, 0, NULL, '2025-05-11 01:05:13', NULL, '2025-05-11 01:05:13', 0),
(133, 57, 131, '', '> @Fullhhhhhuptest@gl.vcom93 : > @admin_user : 555\r\n\r\naaa\r\n\r\n4', NULL, 13, 0, 0, 0, NULL, '2025-05-11 01:10:48', NULL, '2025-05-11 01:10:48', 0),
(134, 57, 130, '', '> @Fullhhhhhuptest@gl.vcom93 : > @admin_user : 555\r\n\r\n3333\r\n\r\n4', NULL, 13, 0, 0, 0, NULL, '2025-05-11 01:10:52', NULL, '2025-05-11 01:10:52', 0),
(135, 57, 131, '', '> @Fullhhhhhuptest@gl.vcom93 : > @admin_user : 555\r\n\r\naaa\r\n\r\n5', NULL, 13, 0, 0, 0, NULL, '2025-05-11 01:10:57', NULL, '2025-05-11 01:10:57', 0),
(136, 57, 130, '', '> @Fullhhhhhuptest@gl.vcom93 : > @admin_user : 555\r\n\r\n3333\r\n\r\n7', NULL, 13, 0, 0, 0, NULL, '2025-05-11 01:11:01', NULL, '2025-05-11 01:11:01', 0),
(137, 57, 130, '', '> @Fullhhhhhuptest@gl.vcom93 : > @admin_user : 555\r\n\r\n3333\r\n\r\n8', NULL, 13, 0, 0, 0, NULL, '2025-05-11 01:11:06', NULL, '2025-05-11 01:11:06', 0),
(138, 57, 125, '', '> @admin_user : 555\r\n\r\na', NULL, 59, 0, 0, 0, NULL, '2025-05-11 01:16:48', NULL, '2025-05-11 01:16:48', 0),
(139, 57, 125, '', '> @admin_user : 555\r\n\r\na', NULL, 59, 0, 0, 0, NULL, '2025-05-11 01:16:52', NULL, '2025-05-11 01:16:52', 0),
(140, 57, 125, '', '> @admin_user : 555\r\n\r\nz', NULL, 59, 0, 0, 0, NULL, '2025-05-11 01:16:54', NULL, '2025-05-11 01:16:54', 0),
(141, 57, 125, '', '> @admin_user : 555\r\n\r\nd', NULL, 59, 0, 0, 0, NULL, '2025-05-11 01:16:57', NULL, '2025-05-11 01:16:57', 0),
(142, 57, 125, '', '> @admin_user : 555\r\n\r\ns', NULL, 59, 0, 0, 0, NULL, '2025-05-11 01:16:59', NULL, '2025-05-11 01:16:59', 0),
(143, 57, 125, '', '> @admin_user : 555\r\n\r\nq', NULL, 59, 0, 0, 0, NULL, '2025-05-11 01:17:01', NULL, '2025-05-11 01:17:01', 0),
(144, 57, 125, '', '> @admin_user : 555\r\n\r\nc', NULL, 59, 0, 0, 0, NULL, '2025-05-11 01:17:03', NULL, '2025-05-11 01:17:03', 0),
(145, 57, 125, '', '> @admin_user : 555\r\n\r\nx', NULL, 59, 0, 0, 0, NULL, '2025-05-11 01:17:05', NULL, '2025-05-11 01:17:05', 0),
(146, 57, 125, '', '> @admin_user : 555\r\n\r\nw', NULL, 59, 0, 0, 0, NULL, '2025-05-11 01:17:08', NULL, '2025-05-11 01:17:08', 0),
(147, 57, 125, '', '> @admin_user : 555\r\n\r\nr', NULL, 59, 0, 0, 0, NULL, '2025-05-11 01:17:11', NULL, '2025-05-11 01:17:11', 0),
(148, 57, 125, '', '> @admin_user : 555\r\n\r\ne', NULL, 59, 0, 0, 0, NULL, '2025-05-11 01:17:15', NULL, '2025-05-11 01:17:15', 0),
(149, 37, NULL, '', 'a', NULL, 13, 0, 0, 0, '', '2025-05-11 02:11:31', NULL, '2025-05-11 02:11:31', 0),
(150, 37, NULL, '', 'e', NULL, 13, 0, 0, 0, '', '2025-05-11 02:11:35', NULL, '2025-05-11 02:11:35', 0),
(151, 37, NULL, '', 'z', NULL, 13, 0, 0, 0, '', '2025-05-11 02:11:37', NULL, '2025-05-11 02:11:37', 0),
(152, 57, 131, '', '> @Fullhhhhhuptest@gl.vcom93 : > @admin_user : 555\r\n\r\naaa\r\n\r\nd', NULL, 13, 0, 0, 0, NULL, '2025-05-11 02:11:55', NULL, '2025-05-11 02:11:55', 0),
(153, 57, 148, '', '> @Fullhhhhhuptest@gl.vcom93 : > @admin_user : 555\r\n\r\ne\r\n\r\nv', NULL, 13, 0, 0, 0, NULL, '2025-05-11 02:12:02', NULL, '2025-05-11 02:12:02', 0),
(154, 57, 143, '', '> @Fullhhhhhuptest@gl.vcom93 : > @admin_user : 555\r\n\r\nq\r\n\r\nvc', NULL, 13, 0, 0, 0, NULL, '2025-05-11 02:12:08', NULL, '2025-05-11 02:12:08', 0),
(155, 57, 140, '', '> @Fullhhhhhuptest@gl.vcom93 : > @admin_user : 555\r\n\r\nz\r\n\r\nb', NULL, 13, 0, 0, 0, NULL, '2025-05-11 02:12:13', NULL, '2025-05-11 02:12:13', 0),
(156, 57, 125, '', '> @admin_user : 555\r\n\r\na', NULL, 59, 0, 0, 0, NULL, '2025-05-11 02:23:47', NULL, '2025-05-11 02:23:47', 0),
(157, 57, 125, '', '> @admin_user : 555\r\n\r\nz', NULL, 59, 0, 0, 0, NULL, '2025-05-11 02:23:52', NULL, '2025-05-11 02:23:52', 0),
(158, 57, 125, '', '> @admin_user : 555\r\n\r\ne', NULL, 59, 0, 0, 0, NULL, '2025-05-11 02:23:56', NULL, '2025-05-11 02:23:56', 0),
(159, 57, 125, '', '> @admin_user : 555\r\n\r\nt', NULL, 59, 0, 0, 0, NULL, '2025-05-11 02:23:59', NULL, '2025-05-11 02:23:59', 0),
(160, 57, 125, '', '> @admin_user : 555\r\n\r\ng', NULL, 59, 0, 0, 0, NULL, '2025-05-11 02:24:02', NULL, '2025-05-11 02:24:02', 0),
(161, 57, 125, '', '> @admin_user : 555\r\n\r\nf', NULL, 59, 0, 0, 0, NULL, '2025-05-11 02:24:06', NULL, '2025-05-11 02:24:06', 0),
(162, 57, 125, '', '> @admin_user : 555\r\n\r\nd', NULL, 59, 0, 0, 0, NULL, '2025-05-11 02:24:10', NULL, '2025-05-11 02:24:10', 0),
(163, 57, 125, '', '> @admin_user : 555\r\n\r\nq', NULL, 59, 0, 0, 0, NULL, '2025-05-11 02:24:14', NULL, '2025-05-11 02:24:14', 0),
(164, 57, 125, '', '> @admin_user : 555\r\n\r\nc', NULL, 59, 0, 0, 0, NULL, '2025-05-11 02:24:18', NULL, '2025-05-11 02:24:18', 0),
(165, 57, 131, '', '> @Fullhhhhhuptest@gl.vcom93 : > @admin_user : 555\r\n\r\naaa\r\n\r\n1', NULL, 13, 0, 0, 0, NULL, '2025-05-11 02:30:31', NULL, '2025-05-11 02:30:31', 0),
(166, 75, NULL, '', 'a', NULL, 13, 0, 0, 0, '', '2025-05-11 03:01:42', NULL, '2025-05-11 03:01:42', 0),
(167, 75, 166, '', '> @admin_user : a\r\n\r\n1', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:02:30', NULL, '2025-05-11 03:02:30', 0),
(168, 75, 166, '', '> @admin_user : a\r\n\r\n2', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:02:32', NULL, '2025-05-11 03:02:32', 0),
(169, 75, 166, '', '> @admin_user : a\r\n\r\n3', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:02:35', NULL, '2025-05-11 03:02:35', 0),
(170, 75, 166, '', '> @admin_user : a\r\n\r\n4', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:02:37', NULL, '2025-05-11 03:02:37', 0),
(171, 75, 166, '', '> @admin_user : a\r\n\r\n5', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:02:39', NULL, '2025-05-11 03:02:39', 0),
(172, 75, 166, '', '> @admin_user : a\r\n\r\n6', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:02:41', NULL, '2025-05-11 03:02:41', 0),
(173, 75, 166, '', '> @admin_user : a\r\n\r\n7', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:02:45', NULL, '2025-05-11 03:02:45', 0),
(174, 75, 166, '', '> @admin_user : a\r\n\r\n8', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:02:47', NULL, '2025-05-11 03:02:47', 0),
(175, 75, 166, '', '> @admin_user : a\r\n\r\n9', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:02:49', NULL, '2025-05-11 03:02:49', 0),
(176, 75, 166, '', '> @admin_user : a\r\n\r\n1000', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:02:52', NULL, '2025-05-11 03:02:52', 0),
(177, 75, NULL, '', '55', NULL, 59, 0, 0, 0, '', '2025-05-11 03:02:59', NULL, '2025-05-11 03:02:59', 0),
(178, 75, 166, '', '> @admin_user : a\r\n\r\n1', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:14:08', NULL, '2025-05-11 03:14:08', 0),
(179, 75, 166, '', '> @admin_user : a\r\n\r\n2', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:14:12', NULL, '2025-05-11 03:14:12', 0),
(180, 75, 166, '', '> @admin_user : a\r\n\r\n3', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:14:15', NULL, '2025-05-11 03:14:15', 0),
(181, 75, 166, '', '> @admin_user : a\r\n\r\n4', NULL, 59, 0, 0, 0, NULL, '2025-05-11 03:14:18', NULL, '2025-05-11 03:14:18', 0),
(182, 9, NULL, '', '5', NULL, 59, 0, 0, 0, '', '2025-05-11 03:14:34', NULL, '2025-05-11 03:14:34', 0),
(183, 9, 182, '', '> @Fullhhhhhuptest@gl.vcom93 : 5\r\n\r\n1', NULL, 13, 0, 0, 0, NULL, '2025-05-11 03:17:00', NULL, '2025-05-11 03:17:00', 0),
(184, 9, 182, '', '> @Fullhhhhhuptest@gl.vcom93 : 5\r\n\r\n2', NULL, 13, 0, 0, 0, NULL, '2025-05-11 03:17:08', NULL, '2025-05-11 03:17:08', 0);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` enum('like','dislike') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `type` enum('reply') DEFAULT 'reply',
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `recipient_id`, `sender_id`, `comment_id`, `post_id`, `type`, `is_read`, `created_at`) VALUES
(27, 'Test notification', 1, 1, NULL, NULL, 'reply', 0, '2025-05-11 02:23:00'),
(38, 'Bienvenue admin_user 👋', 1, 1, NULL, NULL, 'reply', 0, '2025-05-11 02:39:24');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_approved` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `author`, `content`, `is_approved`, `created_at`, `user_id`) VALUES
(7, 'f', 'admin_user', 'f', 1, '2025-05-04 22:32:50', 1),
(8, 'TH', 'admin_user', 'TH', 1, '2025-05-10 01:43:41', 1),
(9, '3', 'admin_user', '3', 1, '2025-05-10 15:29:32', 1),
(10, '95 92', 'admin_user', '...33', 1, '2025-05-10 15:59:05', 1),
(14, '4', 'Fullhhhhhuptest@gl.vcom93', '4', 1, '2025-05-10 20:38:47', 1),
(15, '5', 'Fullhhhhhuptest@gl.vcom93', '5', 1, '2025-05-10 20:38:49', 1),
(16, '6', 'Fullhhhhhuptest@gl.vcom93', '6', 1, '2025-05-10 20:38:50', 1),
(18, '7', 'Fullhhhhhuptest@gl.vcom93', '7', 1, '2025-05-10 21:12:53', 1),
(19, '8', 'Fullhhhhhuptest@gl.vcom93', '8', 1, '2025-05-10 21:12:56', 1),
(20, '9', 'Fullhhhhhuptest@gl.vcom93', '9', 1, '2025-05-10 21:12:58', 1),
(22, '7', 'Fullhhhhhuptest@gl.vcom93', '7', 1, '2025-05-10 21:13:02', 1),
(24, '2', 'Fullhhhhhuptest@gl.vcom93', '2', 1, '2025-05-10 21:17:20', 1),
(26, '4', 'Fullhhhhhuptest@gl.vcom93', '4', 1, '2025-05-10 21:17:23', 1),
(28, '6', 'Fullhhhhhuptest@gl.vcom93', '6', 1, '2025-05-10 21:17:27', 1),
(29, '7', 'Fullhhhhhuptest@gl.vcom93', '7', 1, '2025-05-10 21:17:29', 1),
(30, '8', 'Fullhhhhhuptest@gl.vcom93', '8', 1, '2025-05-10 21:17:30', 1),
(31, '9', 'Fullhhhhhuptest@gl.vcom93', '9', 1, '2025-05-10 21:17:32', 1),
(33, '1', 'Fullhhhhhuptest@gl.vcom93', '1', 1, '2025-05-10 21:48:14', 1),
(35, '4', 'Fullhhhhhuptest@gl.vcom93', '4', 1, '2025-05-10 21:48:18', 1),
(37, '5', 'Fullhhhhhuptest@gl.vcom93', '5', 1, '2025-05-10 21:48:39', 1),
(39, 'a', 'Fullhhhhhuptest@gl.vcom93', 'a', 1, '2025-05-10 21:48:43', 1),
(40, 'a', 'Fullhhhhhuptest@gl.vcom93', 'ad', 1, '2025-05-10 21:48:46', 1),
(41, 'a', 'Fullhhhhhuptest@gl.vcom93', 'a', 1, '2025-05-10 21:48:48', 1),
(43, 'f', 'Fullhhhhhuptest@gl.vcom93', 'f', 1, '2025-05-10 21:48:53', 1),
(44, 'a', 'Fullhhhhhuptest@gl.vcom93', 'a', 1, '2025-05-10 21:59:13', 1),
(45, 'z', 'Fullhhhhhuptest@gl.vcom93', 'z', 1, '2025-05-10 21:59:15', 1),
(46, 'e', 'Fullhhhhhuptest@gl.vcom93', 'e', 1, '2025-05-10 21:59:17', 1),
(47, 'r', 'Fullhhhhhuptest@gl.vcom93', 'r', 1, '2025-05-10 21:59:18', 1),
(48, 't', 'Fullhhhhhuptest@gl.vcom93', 't', 1, '2025-05-10 21:59:20', 1),
(49, 'y', 'Fullhhhhhuptest@gl.vcom93', 'y', 1, '2025-05-10 21:59:21', 1),
(52, 'o', 'Fullhhhhhuptest@gl.vcom93', 'o', 1, '2025-05-10 21:59:25', 1),
(53, 'p', 'Fullhhhhhuptest@gl.vcom93', 'o', 1, '2025-05-10 21:59:28', 1),
(57, 'ù', 'Fullhhhhhuptest@gl.vcom93', 'ù', 1, '2025-05-10 21:59:37', 1),
(58, '1', 'Fullhhhhhuptest@gl.vcom93', '1', 1, '2025-05-11 02:34:03', NULL),
(59, 'a', 'Fullhhhhhuptest@gl.vcom93', 'a', 1, '2025-05-11 02:59:05', NULL),
(60, '2', 'Fullhhhhhuptest@gl.vcom93', '2', 0, '2025-05-11 02:59:08', NULL),
(61, '3', 'Fullhhhhhuptest@gl.vcom93', '3', 1, '2025-05-11 02:59:10', NULL),
(62, '4', 'Fullhhhhhuptest@gl.vcom93', '4', 0, '2025-05-11 02:59:11', NULL),
(63, '5', 'Fullhhhhhuptest@gl.vcom93', '5', 1, '2025-05-11 02:59:12', NULL),
(64, '6', 'Fullhhhhhuptest@gl.vcom93', '6', 1, '2025-05-11 02:59:14', NULL),
(65, '7', 'Fullhhhhhuptest@gl.vcom93', '7', 0, '2025-05-11 02:59:15', NULL),
(66, '8', 'Fullhhhhhuptest@gl.vcom93', '8', 0, '2025-05-11 02:59:17', NULL),
(67, '9', 'Fullhhhhhuptest@gl.vcom93', '9', 1, '2025-05-11 02:59:18', NULL),
(68, '11', 'Fullhhhhhuptest@gl.vcom93', '11', 1, '2025-05-11 02:59:21', NULL),
(69, '22', 'Fullhhhhhuptest@gl.vcom93', '22', 1, '2025-05-11 02:59:22', NULL),
(70, '33', 'Fullhhhhhuptest@gl.vcom93', '33', 1, '2025-05-11 02:59:24', NULL),
(71, '444', 'Fullhhhhhuptest@gl.vcom93', '444', 1, '2025-05-11 02:59:26', NULL),
(72, '353', 'Fullhhhhhuptest@gl.vcom93', '5344', 1, '2025-05-11 02:59:29', NULL),
(73, '555', 'Fullhhhhhuptest@gl.vcom93', '555', 1, '2025-05-11 02:59:31', NULL),
(74, '333', 'Fullhhhhhuptest@gl.vcom93', '3', 1, '2025-05-11 02:59:32', NULL),
(75, '888', 'Fullhhhhhuptest@gl.vcom93', '88', 1, '2025-05-11 02:59:35', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `private_messages`
--

CREATE TABLE `private_messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `is_anonymous` tinyint(1) DEFAULT 0,
  `revealed` tinyint(1) DEFAULT 0,
  `self_destruct` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `private_messages`
--

INSERT INTO `private_messages` (`id`, `sender_id`, `receiver_id`, `subject`, `content`, `is_read`, `is_anonymous`, `revealed`, `self_destruct`, `created_at`) VALUES
(1, 12, 7, 's', 's', 0, 1, 0, 1, '2025-04-26 20:24:27'),
(3, 1, 12, '⚠️ Avertissement officiel', '⚠️ Vous avez reçu un avertissement de la part de l\'administration.', 0, 0, 0, 0, '2025-04-26 23:49:42'),
(4, 1, 7, '⚠️ Avertissement officiel', '⚠️ Vous avez reçu un avertissement de la part de l\'administration.', 0, 0, 0, 0, '2025-04-26 23:49:59'),
(5, 1, 8, '⚠️ Avertissement officiel', '⚠️ Vous avez reçu un avertissement de la part de l\'administration.', 0, 0, 0, 0, '2025-04-26 23:51:30'),
(6, 1, 14, '⚠️ Avertissement officiel', '⚠️ Vous avez reçu un avertissement de la part de l\'administration.', 1, 0, 0, 0, '2025-04-26 23:58:50'),
(7, 1, 14, '⚠️ Avertissement officiel', '⚠️ Vous avez reçu un avertissement de la part de l\'administration.', 0, 0, 0, 0, '2025-04-27 00:20:18'),
(8, 1, 14, '⚠️ Avertissement officiel', '⚠️ Vous avez reçu un avertissement de la part de l\'administration.', 0, 0, 0, 0, '2025-04-27 00:20:34'),
(9, 13, 14, 'aa', 'a', 1, 0, 0, 0, '2025-04-27 00:20:59'),
(10, 1, 14, '⚠️ Avertissement officiel', '⚠️ Vous avez reçu un avertissement de la part de l\'administration.', 0, 0, 0, 0, '2025-04-27 00:32:53'),
(11, 1, 14, '⚠️ Avertissement officiel', '⚠️ Vous avez reçu un avertissement de la part de l\'administration.', 1, 0, 0, 0, '2025-04-27 01:53:59'),
(12, 1, 14, '⚠️ Avertissement officiel', '⚠️ Vous avez reçu un avertissement de la part de l\'administration.', 0, 0, 0, 0, '2025-04-27 01:58:44'),
(13, 13, 8, 'qq', 'aaa', 0, 1, 0, 1, '2025-04-27 02:32:06'),
(14, 13, 37, '1', '2\r\n3\r\n3\r\n3\r\n3\r\n3', 0, 1, 0, 1, '2025-05-06 02:29:19');

-- --------------------------------------------------------

--
-- Structure de la table `private_message_replies`
--

CREATE TABLE `private_message_replies` (
  `id` int(11) NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('membre','admin') DEFAULT 'membre',
  `avatar` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `is_banned` tinyint(1) DEFAULT 0,
  `ban_until` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `avatar`, `bio`, `created_at`, `is_banned`, `ban_until`) VALUES
(1, 'System', 'system@forum-prison.local', '', 'membre', NULL, NULL, '2025-04-26 23:49:18', 0, NULL),
(7, 'john_doe', 'john@example.com', '$2y$10$QZgUQ3dV.luOuvQpRH3SvOVJLgnMKXu7Wle0CvFPoJZmWDt9YKMjC', 'admin', NULL, 'Membre test John.', '2025-04-26 20:19:26', 0, NULL),
(8, 'jane_doe', 'jane@example.com', '$2y$10$7NRB1r5DdA/8.OFklp9RrulBP6DF4eeXUMeovPMTIv4DyJna4JXsy', 'membre', NULL, 'Membre test Jane.', '2025-04-26 20:19:26', 0, NULL),
(12, 'USER5555k.', 'mohamedbougUSER5555.hmadi93300@gmail.com', '$2y$10$67vy3OC2tQmMcNby6cdiMeEiVDgJvr3P.EC3/0FoibF0kbV2YiGBu', 'membre', NULL, NULL, '2025-04-26 20:24:05', 0, NULL),
(13, 'admin_user', 'mohamedboughadmin_usermadi93300@gmail.com', '$2y$10$n0TOTYD7akbE3HVT2Tn8pu1.Mngk5Lj2a4Kn628Cm5WAXZXkF.zpS', 'admin', '1746886263_Capture d’écran 2024-10-27 115558.png', NULL, '2025-04-26 20:27:51', 0, NULL),
(14, 'userF1553./', 'mohamedboughuserF1553./madi93300@gmail.com', '$2y$10$LOnV/GRck/rQkuRxuaPwL.j95B7gGouQ2b24f8Cb0lGmYKD50KMtW', 'membre', NULL, NULL, '2025-04-26 23:58:06', 0, NULL),
(15, 'john_doed', 'mohamedboughjohn_doedmadi93300@gmail.com', '$2y$10$mSs/x4whMi/vxz1qTzymeeCF3jZQHFTpyYE8LnMv5/Jwx5zyDt25q', 'membre', NULL, NULL, '2025-04-28 03:03:31', 0, NULL),
(16, 'userFff1553./', 'mohamedboughmuserFff1553./adi93300@gmail.com', '$2y$10$6joLTS34UPNhG.97G2mefuGY9a7RdWvcCimUCMhJcxolLioUhbK4y', 'membre', NULL, NULL, '2025-04-29 18:04:53', 0, NULL),
(17, 'userFfffff553./', 'mohamedboughmuserFfffff553./adi93300@gmail.com', '$2y$10$7iO9UNti9NlnJUYS5A6lTOfdIQYQysJcWzYJcA4qGu2TUfYjiJmKq', 'membre', NULL, NULL, '2025-04-30 00:01:11', 0, NULL),
(18, 'userFfffff553./userFfffff553./', 'mohamedbuserFfffff553./userFfffff553./oughmadi93300@gmail.com', '$2y$10$qBqhBQwHZwUy5ic8ujjooeb6Lj9jEZX7BJ22qpncwoAy/8VyVOnQO', 'membre', NULL, NULL, '2025-04-30 01:32:17', 0, NULL),
(19, 'mohamemohamedboughmadi93300@gmail.comdboughmadi93300@gmail.com', 'mohamedboughmmohamedboughmadi93300adi93300@gmail.com', '$2y$10$iShBW/58XrLvg9RhHhVuWO7KqZWXTRYyU3naldmnoI/2wclzKbEIq', 'membre', NULL, NULL, '2025-04-30 18:39:22', 0, NULL),
(20, 'UUUUFFD8.CC', 'mUUUUFFD8.CCohamedboughmadi93300@gmail.com', '$2y$10$fGwvZg.MM/WCXBZk.ZKnueQTPhRVQvky3Knwysq4ReztqHpxXikYW', 'membre', NULL, NULL, '2025-04-30 18:39:47', 0, NULL),
(21, 'UUUUFFFFD8.CC', 'mohamedboughmUUUUFFFFD8.CCadi93300@gmail.com', '$2y$10$3OojaeGiltnzovZyMM1CJuN.ncLEku6tkgfBkNHwtv2CkU5DI0rxu', 'membre', NULL, NULL, '2025-04-30 18:43:51', 0, NULL),
(22, 'UUUUUUUFFFFD8.CCUFFFFD8.CC', 'mohamUUUUFFFFD8.CCedboughmadi93300@gmail.com', '$2y$10$txStiU5k.tefve8fPwxuAe3BwnC5jKovjb9n4R6HQpJgOOrh/jHku', 'membre', NULL, NULL, '2025-04-30 19:02:18', 0, NULL),
(23, 'UUUUFFFFD8.CCUUUUFFFFD8.CCUUUUFFFFD8.CC', 'mohamedbUUUUFFFFD8.CCUUUUFFFFD8.CCUUUUFFFFD8.CCoughmadi93300@gmail.com', '$2y$10$K.KCbsWdZfGK8ULR7E1piO7yfSlPIE.qxgFeCBg9t0VrwZRvSeDeC', 'membre', NULL, NULL, '2025-04-30 19:02:52', 0, NULL),
(24, 'test93.PPp', 'test93.PPpmohamedboughmadi93300@gmail.com', '$2y$10$Z16dEd3L0AhLrMMb704eju0Pe.uj66tvmMJfCco5jI3NCvoi8PpZ2', 'membre', NULL, NULL, '2025-04-30 19:05:32', 0, NULL),
(25, 'mohamedbotest93.PPpughmadi93300@gmail.com', 'mohamedboughmaditest93.PPp93300@gmail.com', '$2y$10$JIcmZwN5AmZ4BSVWpliKwujIhLPxA4HmvOwD7b8PRqURvNXeUDJjC', 'membre', NULL, NULL, '2025-04-30 19:07:46', 0, NULL),
(26, 'fiiiiiiiOPM9/', 'mohfiiiiiiiOPM9/amedboughmadi93300@gmail.com', '$2y$10$DBSMNNLLEhIVyRgoQ56/Zel550mnuoySK5f.7LuYtLm1MV.QAitjG', 'membre', NULL, NULL, '2025-04-30 19:12:57', 0, NULL),
(27, 'useruserFfffff553./Ffffff553./', 'mohameuserFfffff553./dboughmadi93300@gmail.com', '$2y$10$J8cZ.dKeJysIZoEkHsb9J.DLxkG6GXPmzSt.Bl2FrQ4bWT6CPX8A6', 'membre', NULL, NULL, '2025-04-30 19:16:48', 0, NULL),
(28, 'userFfffffuserFfffff553./553./', 'mohamedbouuserFfffff553./userFfffff553./ghmadi93300@gmail.com', '$2y$10$OR.V.nlLfHB59B9oOsVC/.6eJyZZ/fSSj44X0FwWdl8/rcBu8f6fC', 'membre', NULL, NULL, '2025-04-30 19:20:26', 0, NULL),
(29, 'userFfuserFfffff553./ffff553.userFfffff553.//', 'mohamedboughmuserFfffff553./userFfffff553./adi93300@gmail.com', '$2y$10$uyqKxMghZTwfVI5KaDT84.lWpz76eN1nFMgMknhXPhsc9nJ/5BGSa', 'membre', NULL, NULL, '2025-04-30 19:21:33', 0, NULL),
(30, 'useuserFfffff553./rFfffuserFfffff553./ff553./', 'mohamedboughuserFfffff553./userFfffff553./madi93300@gmail.com', '$2y$10$vE3.vkZ2JMsspMaroE/tnOhZtvNYPLSLLiedFMzYfnhjjB9jgdjMi', 'membre', NULL, NULL, '2025-04-30 19:25:13', 0, NULL),
(31, 'mohamedboughcmohamedboughcccgmadi93300@gmail.comccgmadi93300@gmail.com', 'mohamedboughcccgmadi93300@gmail.com', '$2y$10$9CObag3XpSItmM8yzDHA6..hR5ALHpNmcLkCCxtcTEOvNLTFqC7i6', 'membre', NULL, NULL, '2025-04-30 20:53:23', 0, NULL),
(32, 'UUUUUUUUUUUFFFFD8.CCUFFFFD8.CCFFFFD8.CC', 'mohameUUUUFFFFD8.CCdboUUUUFFFFD8.CCughmadi93300@gmail.com', '$2y$10$mDBHVZgJKqGywPq6V2iHgeHqJ1JXbenpoDPDO40FCHzZO.M1Y4vOi', 'membre', NULL, NULL, '2025-05-01 13:58:55', 0, NULL),
(33, 'TESTULTIMEREGISTER93.', 'mohameTESTULTIMEREGISTER93.dboughmadi93300@gmail.com', '$2y$10$6SSpTtnVtj0Sh3JIVBaaEOfgodDSG7tTr8lYo7sLC296NDI1JZ9ee', 'membre', NULL, NULL, '2025-05-01 14:08:00', 0, NULL),
(34, 'TESTULTIMEREGIS1TER93.', 'mohamedbouTESTULTIMEREGIS1TER93.ghmadi93300@gmail.com', '$2y$10$TSznGyAeL0RgAJEkCOM5v.VwhdtV4XPh3iivrpw.1bgjkIMCEAxIS', 'membre', NULL, NULL, '2025-05-01 14:18:20', 0, NULL),
(35, 'TESTULTIMERE11GIS1TER93.', 'mohamedbouTESTULTIMERE11GIS1TER93.ghmadi93300@gmail.com', '$2y$10$1JkriUgmEEy80b30Xpz3seelvaRIKU52eIKE85LwynGpoB2n6e4Mu', 'membre', NULL, NULL, '2025-05-01 14:19:00', 0, NULL),
(36, 'test93.P88Pp', 'mohamedboutest93.P88Ppghmadi93300@gmail.com', '$2y$10$reCXop3DlMb8Xw6E41T63u2TzOvRTjIIrefExyp8GLc.7I3dltnwq', 'membre', NULL, NULL, '2025-05-01 14:56:55', 0, NULL),
(37, 'fftest93.PPp', 'mohamedbougfftest93.PPphmadi93300@gmail.com', '$2y$10$dhiF4BwtbpQFMYkOuzKD3e0uYyH35Q9Ukojw7wSyIFgyVFjSIYKm6', 'membre', NULL, NULL, '2025-05-01 15:02:17', 0, NULL),
(38, 'vfftest93.PPp', 'mohamedbfftest93.PPpoughmadi93300@gmail.com', '$2y$10$hjm71BG.JE81dMscIffXBuH9Peu8NlMrmOa/YA3OYebD87nNEfleK', 'membre', NULL, NULL, '2025-05-01 15:02:50', 0, NULL),
(39, 'test93111g.PPp', 'mohamedboughmadi93300@gmail.comtest93111g.PPp', '$2y$10$/fkbRmSW3fMO0sWhCdug2udH5EctKmHjNo6y/DQXH49MEXUah8qTS', 'membre', NULL, NULL, '2025-05-01 15:18:08', 0, NULL),
(40, 'test93VV.PPp', 'mohamedboughtest93VV.PPpmadi93300@gmail.com', '$2y$10$DzxdSxYOgoN3zl4dJ22pOenXPT6FSOCssp91goKLrXHsHyZcUHqfa', 'membre', NULL, NULL, '2025-05-01 15:26:21', 0, NULL),
(41, 'test93VV.test93VV.PPpPPp', 'mohtest93VV.PPptest93VV.PPpamedboughmadi93300@gmail.com', '$2y$10$bhCvk9oGntPq2frVC4qWWuQxjuoBsMrPfRiosh8/O3qtXEolnl8Lq', 'membre', NULL, NULL, '2025-05-01 15:26:53', 0, NULL),
(42, 'TESTUvvvLTIMEREGIS1TER93.', 'mohamedbouTESTUvvvLTIMEREGIS1TER93.ghmadi93300@gmail.com', '$2y$10$vjukKAhQRO0Blr6pnwezm.tM1acdebQMapcGkOypuLDEL2bQaq7Sq', 'membre', NULL, NULL, '2025-05-01 15:31:16', 0, NULL),
(43, 'test9test93.PPp3.PPp', 'mohamedbougtest93.PPphmadi93300@gmail.com', '$2y$10$M453jURGFMjem.Z.U2t1qO9OO9ajFrzp6.tTPI/mBaQA6Z0FtWRty', 'membre', NULL, NULL, '2025-05-01 16:42:34', 0, NULL),
(44, 'TESTUTESTULTIMEREGISTER93.LTIMEREGISTER93.', 'mTESTULTIMERTESTULTIMEREGISTER93.EGISTER93.ohamedboughmadi93300@gmail.com', '$2y$10$pS8qor2A18w/94zvfXtfiu8nGd/3L9pGfuT5lIC6CnrRhCxycuiNm', 'membre', NULL, NULL, '2025-05-01 16:44:00', 0, NULL),
(45, 'TESTULTIMERvvvEGISTER93.', 'mohamedbouTESTULTIMERvvvEGISTER93.ghmadi93300@gmail.com', '$2y$10$YMSg02FhpneTpRbVpINItOFvtTexEEtTWHxvf92VrbLg/lLjKJlOa', 'membre', NULL, NULL, '2025-05-01 20:09:11', 0, NULL),
(46, 'test93.bbsqgPPp', 'mohamedboughtest93.bbsqgPPpmadi93300@gmail.com', '$2y$10$aAilutyY19qzdzamPqlBWuYeVVH6c.K7XcMh.AcRhwjb2Dn06LIsS', 'membre', NULL, NULL, '2025-05-01 20:21:25', 0, NULL),
(47, 'test93.Ptest93.PPpPp', 'test93.PPpmohvtest93.PPpamedboughmadi93300@gmail.com', '$2y$10$UJQyHWL/vW/T1F/EKLozA.889iXJoOelB47OOILtQ2w0LMMZXKQyG', 'membre', NULL, NULL, '2025-05-01 20:34:43', 0, NULL),
(48, 'test93.Ptest93.PscscPpPp', 'mohamedbougcSCScschmadi93300@gmail.com', '$2y$10$Rr/7S.w8uvXzipKQt4ho6ujX0JKURz3dBRBoLAYtYRXf11765WB.q', 'membre', NULL, NULL, '2025-05-01 20:43:44', 0, NULL),
(49, 'teNWDNDst93.PPp', 'mohamedboughteNWDNDst93.PPpmadi93300@gmail.com', '$2y$10$KNKNMHuCPrlZPNLMphETbe9KQzf/WYTKTkC437ypR4xeYNBSfd5kS', 'membre', NULL, NULL, '2025-05-01 20:50:51', 0, NULL),
(50, 'teNNst93.PPp', 'mohamedbougteNNst93.PPphmadi93300@gmail.com', '$2y$10$Wd.cELyDnDJHgOw8rQfBlu2W4FvcFi5VBawP5RNAS.4hQhIKo1ffi', 'membre', NULL, NULL, '2025-05-01 20:52:04', 0, NULL),
(51, 'test93ERA.PPp', 'mohamedboughmadi9test93ERA.PPp3300@gmail.com', '$2y$10$RHkTHy0JkSqEOKh.wEWLZ.aem.t3THqAoeARkIHbU00FrkSxsy46K', 'membre', NULL, NULL, '2025-05-01 20:54:07', 0, NULL),
(52, 'Fulluptest@gl.com93', 'Fulluptest@gl.com93', '$2y$10$TLRNpFoZ4iQPSojRYgSA5OHrjK4jFHBvuS1RyOFTWitd4x6VtIyPC', 'membre', NULL, NULL, '2025-05-01 20:55:56', 0, NULL),
(53, 'Fulluptest@gl.vcom93', 'Fulluptest@gl.vcom93', '$2y$10$jXDCzJ75vlzeQz4SQiRPEehqxyfmR4.DRpd93Z7DHCZV6fZj6XHhC', 'membre', NULL, NULL, '2025-05-01 21:06:13', 0, NULL),
(54, 'Fullzzuptest@gl.com93', 'Fullzzuptest@gl.com93', '$2y$10$fqQdvfwl8kyzjFkQZ1wsvOUtLKSHG2arTmBaN3UXs/lURHXeBLkbm', 'membre', NULL, NULL, '2025-05-01 21:08:09', 0, NULL),
(55, 'Fullueeeptest@gl.com93', 'Fullueeeptest@gl.com93', '$2y$10$lJWH2REkO2/IG8u0Bt.bj.j2ThQn4UuIqUHbVlNEkkPYSi0biFCB.', 'membre', NULL, NULL, '2025-05-01 21:09:56', 0, NULL),
(56, 'Fullupgegtest@gl.vcom93', 'Fullupgegtest@gl.vcom93', '$2y$10$CDPUWV95Q5NivXZ8JWAGKe1co4dOQwXx1kzrooNWIFGw9Kk5VFDr6', 'membre', NULL, NULL, '2025-05-01 21:13:01', 0, NULL),
(57, 'Fulluptekytst@gl.com93', 'Fulluptekytst@gl.com93', '$2y$10$qpcDWAP62Rbv87Bg0oTHJ.hnci2ZmLO23rDjtZguFEy9Ph92LDT7O', 'membre', NULL, NULL, '2025-05-01 21:15:24', 0, NULL),
(58, 'Fulluazaztest@gl.com93', 'Fulluazaztest@gl.com93', '$2y$10$wO4sZ2CVSg/4T8Uge/tYcuPaiOJlN7wZ91uisq/UeloItHEImn7Um', 'membre', NULL, NULL, '2025-05-01 21:16:35', 0, NULL),
(59, 'Fullhhhhhuptest@gl.vcom93', 'Fullhhhhhuptest@gl.vcom93', '$2y$10$6iqXuMKccozsNi4GqjciCe9x/wqsHXXRO8pf9WusOJkt/7aOvHNxG', 'membre', NULL, NULL, '2025-05-01 21:18:41', 1, '2025-05-12 03:44:30'),
(60, 'zrtyzFulluptest@gl.com93', 'zrtyzFulluptest@gl.com93', '$2y$10$bIezLtnoGBLTdf.EQtbGeOVOO2mb0ER1fQH5/QRyrwenv9Dhy45zi', 'membre', NULL, NULL, '2025-05-01 21:20:39', 0, NULL),
(61, 'TESTULTIMEggREGISTER93.', 'mohamedboughmTESTULTIMEggREGISTER93.adi93300@gmail.com', '$2y$10$2qcUn9RY7aAmxyR2/YK0DelGIOYmtQCm3g6jCEnlNiXT6eeFg/RKi', 'membre', NULL, NULL, '2025-05-01 22:58:54', 0, NULL),
(63, 'Fulluptest@gl.vcom93her', 'Fulluptest@gl.vcom93her', '$2y$10$32Vk.fGYyfE2FLLLEWi.purp8UxkaY7FoZJPpQpwLkx2lzezgkQhq', 'membre', NULL, NULL, '2025-05-01 23:30:39', 0, NULL),
(64, 'Fulluptest@gl.com93RRR', 'Fulluptest@gl.com93RRR', '$2y$10$58nQ7dnj.z5/bXJW.E/i1enJxfs3C/jGy78EUWIq5ZhJxKWDiXHie', 'membre', NULL, NULL, '2025-05-01 23:33:33', 0, NULL),
(65, 'Fullueeeptest@gl.com93rrr', 'Fullueeeptest@gl.com93rrr', '$2y$10$WhtNU.zovKgnP1E./N8gtexu.OCgN1i1w1YN/z.7AsHOCg/vjCVzi', 'membre', NULL, NULL, '2025-05-01 23:34:54', 0, NULL),
(66, 'Fullupgegtest@gl.vcom9vvv3', 'Fullupgegtest@gl.vcom9vvv3', '$2y$10$mejdI1qJ489zRv7vypaCCO7d6DJRS/68t9YgwogEUTM6Biuxv5Wkq', 'membre', NULL, NULL, '2025-05-01 23:46:44', 0, NULL),
(67, 'Fullupgegtest@gl.vcom93DQE', 'Fullupgegtest@gl.vcom93DQE', '$2y$10$Gnjua8khbZc9PbaIdpVqB.NMC9t7f5RQ8yS4PWj8vcFMVb.mGJs4y', 'membre', NULL, NULL, '2025-05-01 23:48:36', 0, NULL),
(68, 'Fullueeezzaaptest@gl.com93', 'Fullueeezzaaptest@gl.com93', '$2y$10$F8sFmbxFRMgwBDhV1rSf/unHECWXQhWlZYJiPJjrXCJmpwDdb4NZa', 'membre', NULL, NULL, '2025-05-01 23:52:59', 0, NULL),
(69, 'Fulluptest@gl.com9344', 'Fulluptest@gl.com9344', '$2y$10$/V7EHI0bUy1umBjrVRFa6e9Gx5eBxB3mH6.EKBhUyphTjvT69Kf82', 'membre', NULL, NULL, '2025-05-02 01:16:57', 0, NULL),
(70, 'Fullzzuptest@gl.com93fffez', 'Fullzzuptest@gl.com93fffez', '$2y$10$TVziBBo/C97//PjAENcUJuztBt..4nnFFDBKY9dYiuKZwDfslpn06', 'membre', NULL, NULL, '2025-05-02 01:18:48', 0, NULL),
(71, 'Fullueeeptest@gl.com93aaa', 'Fullueeeptest@gl.com93aaa', '$2y$10$var2k8VwQiKB2elmohYCH.GU.EViHI.s6i7hh2B/9hagHe0M375iu', 'membre', NULL, NULL, '2025-05-02 01:19:30', 0, NULL),
(72, 'Fullzzuptest@gl.com93sf', 'Fullzzuptest@gl.com93sf', '$2y$10$mgOOYWI/Xd0enlYn5uQd9O4dmiF4m4LgKQ4RCXH26STjD4g.6kmKu', 'admin', NULL, NULL, '2025-05-02 01:21:46', 0, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_comment_vote` (`comment_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipient_id` (`recipient_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `private_messages`
--
ALTER TABLE `private_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Index pour la table `private_message_replies`
--
ALTER TABLE `private_message_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `private_messages`
--
ALTER TABLE `private_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `private_message_replies`
--
ALTER TABLE `private_message_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `notifications_ibfk_4` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Contraintes pour la table `private_messages`
--
ALTER TABLE `private_messages`
  ADD CONSTRAINT `private_messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `private_messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `private_message_replies`
--
ALTER TABLE `private_message_replies`
  ADD CONSTRAINT `private_message_replies_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `private_messages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `private_message_replies_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
