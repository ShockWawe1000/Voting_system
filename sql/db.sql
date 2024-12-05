-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 03:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `endorsements`
--

CREATE TABLE `endorsements` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `votee_id` int(11) NOT NULL,
  `work_fun` tinyint(1) NOT NULL,
  `team_player` tinyint(1) NOT NULL,
  `culture_champ` tinyint(1) NOT NULL,
  `diff_maker` tinyint(1) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `endorsements`
--

INSERT INTO `endorsements` (`id`, `voter_id`, `votee_id`, `work_fun`, `team_player`, `culture_champ`, `diff_maker`, `comment`, `timestamp`) VALUES
(32, 18, 23, 1, 1, 0, 0, 'as ', '2024-12-05 01:35:31'),
(33, 18, 25, 0, 0, 1, 1, 'ds ', '2024-12-05 01:35:36'),
(34, 18, 26, 0, 0, 1, 1, 'asdasd ', '2024-12-05 01:36:05'),
(35, 18, 27, 0, 0, 1, 1, 'asdasd ', '2024-12-05 01:36:08'),
(36, 18, 28, 0, 0, 1, 1, 'asdsad ', '2024-12-05 01:36:11'),
(37, 18, 27, 0, 0, 1, 1, 'asd ', '2024-12-05 01:36:44'),
(38, 18, 27, 0, 0, 1, 1, 'asd ', '2024-12-05 01:39:07'),
(39, 23, 21, 0, 1, 0, 0, 'x ', '2024-12-05 01:58:53'),
(40, 23, 25, 0, 1, 0, 0, 'x ', '2024-12-05 01:58:57'),
(41, 23, 26, 0, 0, 1, 0, 'x ', '2024-12-05 01:59:00'),
(42, 23, 27, 0, 0, 1, 0, 'x ', '2024-12-05 01:59:02'),
(43, 23, 38, 0, 1, 0, 0, 'x ', '2024-12-05 01:59:10'),
(44, 23, 31, 0, 1, 0, 0, 's ', '2024-12-05 02:00:17'),
(45, 23, 31, 0, 1, 0, 0, 'x ', '2024-12-05 02:00:27'),
(46, 23, 31, 0, 1, 0, 0, 'x ', '2024-12-05 02:00:30'),
(47, 23, 31, 0, 1, 0, 0, 'x ', '2024-12-05 02:00:32'),
(48, 23, 31, 0, 1, 0, 0, 'x ', '2024-12-05 02:00:34'),
(49, 23, 31, 0, 1, 0, 0, 'x ', '2024-12-05 02:00:36'),
(50, 23, 31, 0, 1, 0, 0, 'x ', '2024-12-05 02:00:38'),
(51, 23, 31, 0, 1, 0, 0, 'x ', '2024-12-05 02:00:42'),
(52, 23, 40, 1, 1, 1, 1, 'asd ', '2024-12-05 02:04:12'),
(53, 23, 21, 1, 1, 1, 1, 'asd ', '2024-12-05 02:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `username`, `password`) VALUES
(18, 'admin', 'admin', 'admin', 'admin'),
(21, 'Edis', 'Usein', 'edis', 'edis'),
(23, 'Ana', 'Angelic', 'ana', 'ana'),
(25, 'Vanja', 'Sala', 'vana', 'vana'),
(26, 'MArio', 'Poetreski', 'mario', 'mario'),
(27, 'Anjasta', 'Marleva', 'Anjasta', 'Anjasta'),
(28, 'Fedora', 'Mitco', 'eaeasd', 'eaeasd'),
(29, 'Led', 'Sam', 'fff', 'fff'),
(30, 'Jocker', 'Fele', 'ddd', 'ddd'),
(31, 'Aster', 'Ausa', 'ass', 'ass'),
(32, 'Admin', 'adsa', 'asd', 'asd'),
(33, 'Elena', 'Penkova', 'penkova1', '123'),
(38, 'Eren', 'Jaeger', 'mymomded', 'ihatemyfather'),
(39, 'Stole', 'Macorot', 'x', 'x'),
(40, 'Assassins', 'Creed', 'ubisoftTakeMyMoney', 'lootboxes'),
(41, 'Stefan', 'TojPopon', 'popce140', 'godisgreat'),
(42, 'Kama', 'Sutra', 'utre', 'sama');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `endorsements`
--
ALTER TABLE `endorsements`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `votee` (`votee_id`),
  ADD KEY `voter` (`voter_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `endorsements`
--
ALTER TABLE `endorsements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `endorsements`
--
ALTER TABLE `endorsements`
  ADD CONSTRAINT `votee` FOREIGN KEY (`votee_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `voter` FOREIGN KEY (`voter_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
