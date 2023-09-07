-- phpMyAdmin SQL Dump
-- version 8.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: jan 08, 2023 at 12:18 PM
-- Server version: 10.10.2-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- -Database: `forumdclic`

CREATE DATABASE forumdclic;
--

-- --------------------------------------------------------

--
- table `block_list`
--

CREATE TABLE `block_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blocked_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--  table `block_list`
--

INSERT INTO `block_list` (`id`, `user_id`, `blocked_user_id`) VALUES
(5, 8, 9);

-- --------------------------------------------------------

--
-- T table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `created_at`) VALUES
(3, 5, 8, 'ok', '2023-02-02 17:44:26'),
(4, 5, 8, 'prop', '2023-02-02 17:46:43'),
(5, 5, 8, 'ok just pour tester', '2022-12-04 17:51:50'),
(6, 5, 8, 'nice', '2023-02-0217:52:00'),
(7, 5, 8, 'sdfdsf', '2023-02-02 17:52:26'),
(8, 5, 8, 'sdfsdf', '2023-02-02 17:52:27'),
(9, 5, 8, 'sdfsdf', '2023-02-02 17:52:28'),
(10, 5, 8, 'sdfsdf', '2022-12-04 17:52:29'),
(11, 5, 8, 'sdfsdf', '2022-12-04 17:52:31'),
(12, 5, 8, 'sdfsdf', '2022-12-04 17:52:32'),
(13, 7, 8, 'this is awesome game', '2022-12-04 18:04:36'),
(14, 3, 8, 'this is aweosme project', '2022-12-04 18:05:49'),
(15, 7, 10, 'wowo, just super cool', '2022-12-04 18:07:31'),
(16, 8, 10, 'nice and funny', '2022-12-04 18:09:17'),
(17, 6, 10, 'awesome', '2022-12-04 18:12:01'),
(18, 5, 10, 'nice pic', '2022-12-04 18:15:12'),
(19, 4, 10, 'super cool man congrats', '2022-12-04 18:15:34'),
(20, 5, 10, 'aweosme and cool', '2022-12-04 18:22:03'),
(21, 1, 10, 'super cool', '2022-12-04 18:22:24'),
(22, 5, 10, 'super nice', '2022-12-04 18:23:18'),
(23, 9, 10, 'super cool', '2022-12-04 18:24:44'),
(24, 4, 10, 'thanks bro', '2022-12-04 18:26:02'),
(25, 2, 8, 'looking awesome bro', '2022-12-04 10:55:57'),
(27, 8, 10, 'this is my fav image', '2022-12-04 11:18:13'),
(28, 4, 10, 'congrats guys', '2022-12-04 11:37:42'),
(29, 9, 8, 'nice pic brother ', '2022-12-04 12:09:12'),
(30, 9, 10, 'thanks brother', '2022-12-04 12:09:36'),
(32, 10, 8, 'super cool', '2022-12-04 12:24:06'),
(34, 5, 8, 'aweomse', '2022-12-04 12:45:09'),
(38, 10, 8, 'ok bye then', '2022-12-04 16:40:00'),
(39, 10, 8, 'cool', '2022-12-04 16:44:10'),
(40, 9, 8, 'ok nice', '2022-12-04 16:50:21'),
(41, 10, 8, 'good', '2022-12-04 16:51:22'),
(42, 1, 8, 'Nice pic', '2022-12-05 05:44:25'),
(43, 9, 11, 'Hii bro', '2022-12-05 06:52:16'),
(44, 12, 10, 'awesome pic bro', '2022-12-06 08:17:41'),
(45, 5, 10, 'nice girls', '2022-12-06 08:19:08'),
(46, 5, 8, 'Thanks', '2022-12-06 08:25:30'),
(47, 6, 11, 'Awesosm', '2022-12-07 10:24:33');

-- --------------------------------------------------------

--
-- - table `follow_list`
--

CREATE TABLE `follow_list` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- table `follow_list`
--

INSERT INTO `follow_list` (`id`, `follower_id`, `user_id`) VALUES
(13, 9, 3),
(15, 9, 6),
(38, 10, 3),
(42, 10, 7),
(43, 10, 9),
(57, 8, 4),
(58, 8, 5),
(66, 10, 11),
(68, 11, 10),
(69, 11, 7),
(70, 11, 9),
(71, 11, 3);

-- --------------------------------------------------------

--
--  table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(17, 3, 8),
(30, 7, 9),
(31, 5, 9),
(45, 7, 8),
(49, 3, 10),
(56, 9, 10),
(57, 5, 10),
(67, 1, 8),
(69, 6, 10),
(74, 10, 8),
(79, 9, 11),
(88, 12, 10),
(89, 5, 8),
(90, 2, 8);

-- --------------------------------------------------------

--
--table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--  table `messages`
--

INSERT INTO `messages` (`id`, `from_user_id`, `to_user_id`, `msg`, `read_status`, `created_at`) VALUES
(27, 8, 10, 'hii amit', 1, '2022-12-07 10:47:18'),
(28, 8, 11, 'hii pankaj', 1, '2022-12-07 10:47:44'),
(29, 11, 8, 'Hii monu bro', 1, '2022-12-07 10:48:03'),
(30, 8, 11, 'ok get it', 1, '2022-12-07 10:48:15'),
(31, 11, 8, 'Thanks for unblocking me', 1, '2022-12-07 11:05:27'),
(32, 11, 8, 'No I am going to block you', 1, '2022-12-07 11:05:52'),
(33, 10, 8, 'Hii bro', 1, '2022-12-07 11:10:12'),
(34, 8, 10, 'hii man', 1, '2022-12-07 11:10:26'),
(35, 10, 8, 'So what are you doing', 1, '2022-12-07 11:10:39'),
(36, 8, 10, 'nothing big you tell', 1, '2022-12-07 11:11:00'),
(37, 10, 8, 'Ohh same here', 1, '2022-12-07 11:11:08'),
(38, 8, 10, 'lets go for party then', 1, '2022-12-07 11:11:30'),
(39, 10, 8, 'Ya sure', 1, '2022-12-07 11:11:37'),
(40, 8, 10, 'ok bye', 1, '2022-12-07 11:11:53');

-- --------------------------------------------------------

--
--  table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `from_user_id` int(11) NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT 0,
  `post_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--  table `notifications`
--

INSERT INTO `notifications` (`id`, `to_user_id`, `message`, `created_at`, `from_user_id`, `read_status`, `post_id`) VALUES
(82, 10, 'Unblocked you !', '2022-12-06 08:16:11', 8, 1, '0'),
(83, 8, 'started following you !', '2022-12-06 08:16:59', 10, 1, '0'),
(84, 8, 'liked your post !', '2022-12-06 08:17:33', 10, 1, '12'),
(85, 8, 'commented on your post', '2022-12-06 08:17:41', 10, 1, '12'),
(86, 8, 'commented on your post', '2022-12-06 08:19:07', 10, 1, '5'),
(87, 10, 'blocked you', '2022-12-06 08:20:42', 8, 1, '0'),
(88, 10, 'Unblocked you !', '2022-12-06 08:21:09', 8, 1, '0'),
(89, 8, 'started following you !', '2022-12-06 08:21:34', 10, 1, '0'),
(90, 10, 'started following you !', '2022-12-06 08:22:17', 8, 1, '0'),
(91, 3, 'Unfollowed you !', '2022-12-06 08:26:01', 8, 0, '0'),
(92, 8, 'commented on your post', '2022-12-07 10:24:33', 11, 2, '6'),
(93, 11, 'blocked you', '2022-12-07 10:48:28', 8, 1, '0'),
(94, 11, 'Unblocked you !', '2022-12-07 11:04:05', 8, 1, '0'),
(95, 8, 'blocked you', '2022-12-07 11:08:54', 11, 1, '0'),
(96, 8, 'Unblocked you !', '2022-12-07 11:09:03', 11, 1, '0'),
(97, 8, 'blocked you', '2022-12-07 11:12:50', 10, 1, '0'),
(98, 8, 'Unblocked you !', '2022-12-07 11:13:04', 10, 1, '0');

-- --------------------------------------------------------

--
--  table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_img` text NOT NULL,
  `post_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--  table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_img`, `post_text`, `created_at`) VALUES
(1, 8, '1638039262wolf-g17d3951f3_1920.jpg', 'this is my first image post', '2022-11-27 18:54:22'),
(2, 8, '1638040069IMG_20220215_074954_1.jpg', '', '2022-11-27 19:07:49'),
(3, 6, '1638040508Screenshot (3).png', 'my fisrt web app', '2022-11-27 19:15:08'),
(5, 8, '1638040774post2.jpg', 'say hii to everyone', '2022-11-27 19:19:34'),
(7, 6, '1638243863vlcsnap-2022-10-05-20h25m29s906.png', '', '2022-11-30 03:44:23'),
(9, 10, '1638469199post4.jpg', '', '2022-12-04 18:19:59');

-- --------------------------------------------------------

--
-- table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `profile_pic` VARCHAR(255) DEFAULT 'default_profile.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ac_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=non vérifié, 1=actif, 2=bloqué DEFAULT 1'
  `name` varchar(255)  NULL,
  `domain_name` varchar(255)  NULL,
  `adresse` varchar(255) NOT NULL,
  `link` varchar(255)  NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
--  table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `username`, `password`, `profile_pic`, `created_at`, `updated_at`, `ac_status`) VALUES
(3, 'Mohans', 'Giri', 0, 'iri2@gmail.com', 'whomonugiri', 'c68710d3fe56fc88f7905cb15f06cf5c', 'default_profile.jpg', '2022-11-19 08:54:47', '2022-11-25 08:21:35', 0),
(4, 'Mohans', 'Giri', 0, 'whoonugirdfgfi@gmail.com', 'asdsd', 'c68710d3fe56fc88f7905cb15f06cf5c', 'default_profile.jpg', '2022-11-22 02:34:06', '2022-11-25 08:21:40', 0),
(5, 'Mohans', 'Giri', 1, 'workwithmohan@gmail.com', 'oyeitsmgasdasd', 'c68710d3fe56fc88f7905cb15f06cf5c', 'default_profile.jpg', '2022-11-23 12:00:13', '2022-11-25 08:21:43', 1),
(6, 'Mohans', 'Giri', 1, 'mailtomonugiri@gmail.com', 'oyeitsmgasd', '970af30e481057c48f87e101b61e6994', 'default_profile.jpg', '2022-11-23 13:24:40', '2022-11-27 19:12:06', 1),
(7, 'Monu', 'Giri', 1, 'officialmohankumar@gmail.com', 'iamtheking', 'e10adc3949ba59abbe56e057f20f883e', '1637830104profile7.jpg', '2022-11-25 08:45:24', '2022-11-25 08:49:44', 1),
(8, 'Monu', 'Giri', 1, 'whomonugiri@gmail.com', 'devninja', '970af30e481057c48f87e101b61e6994', '1638035490IMG_20220217_172513 (1).jpg', '2022-11-26 16:53:17', '2022-11-27 17:51:30', 1),
(9, 'Test', 'Kumar', 1, 'test@gmail.com', 'testman', 'e10adc3949ba59abbe56e057f20f883e', '1638244233bot.png', '2022-11-30 03:45:35', '2022-11-30 03:50:33', 1),
(10, 'Amit', 'Sharma', 1, 'amith@gmail.com', 'amithero', 'e10adc3949ba59abbe56e057f20f883e', '1638468543profile8.jpg', '2022-12-04 18:06:37', '2022-12-04 18:09:03', 1),
(11, 'Pankaj', 'Mishra', 1, 'officialmohankumar12@gmail.com', 'pankaj1427', 'e10adc3949ba59abbe56e057f20f883e', '1638686483IMG-20221130-WA0023.jpg', '2022-12-05 06:36:14', '2022-12-05 07:16:41', 1);

--
-
--

--
-- table `block_list`
--
ALTER TABLE `block_list`
  ADD PRIMARY KEY (`id`);

--
-- table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
--  table `follow_list`
--
ALTER TABLE `follow_list`
  ADD PRIMARY KEY (`id`);

--
--  table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
--  table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
--  table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
--  table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
--
--

--
--  table `block_list`
--
ALTER TABLE `block_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- table `follow_list`
--
ALTER TABLE `follow_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT POUR LA table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT POUR LA table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT POUR LA table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT  POUR LA table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT  POUR LA table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;


-- FIN (echo"Placez votre le dossier Forum_dclic dans le htodcs (pour xamp)  et (www pour wamp) ou dans le dossier approprié pour les autres serveur pour lancé la plateform ...")



-- NB: Assurer vous d'avoir renseignez le nom de la bd ainsi que votre DB_user et DB_PASS dans le fichier config.php