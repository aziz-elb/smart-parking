-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2024 a las 01:04:27
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_smartparking`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `place`
--

CREATE TABLE `place` (
  `place_id` int(10) NOT NULL,
  `emplacement` varchar(20) NOT NULL,
  `est_disponible` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `place`
--

INSERT INTO `place` (`place_id`, `emplacement`, `est_disponible`) VALUES
(1, 'A01', 1),
(2, 'A02', 1),
(3, 'A03', 1),
(4, 'A04', 0),
(5, 'A05', 0),
(6, 'A06', 1),
(7, 'A07', 1),
(8, 'A08', 1),
(9, 'A09', 0),
(10, 'A10', 1),
(11, 'B01', 1),
(12, 'B02', 0),
(13, 'B03', 0),
(14, 'B04', 0),
(15, 'C01', 0),
(16, 'C02', 1),
(17, 'C03', 1),
(18, 'C04', 0),
(19, 'C05', 1),
(20, 'C06', 1),
(21, 'C07', 1),
(22, 'C08', 1),
(23, 'C09', 1),
(24, 'C10', 1),
(25, 'C11', 1),
(26, 'C12', 0),
(27, 'C13', 0),
(28, 'C14', 0),
(29, 'C15', 0),
(30, 'C16', 0),
(31, 'C17', 0),
(32, 'C18', 1),
(33, 'C19', 0),
(34, 'D01', 0),
(35, 'D02', 0),
(36, 'D03', 0),
(37, 'D04', 0),
(38, 'D05', 0),
(39, 'D06', 0),
(40, 'D07', 0),
(41, 'D08', 1),
(42, 'D09', 1),
(43, 'D10', 0),
(44, 'D11', 0),
(45, 'D12', 0),
(46, 'D13', 1),
(47, 'D14', 0),
(48, 'D15', 1),
(49, 'D16', 1),
(50, 'D17', 1),
(51, 'D18', 0),
(52, 'D19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(10) NOT NULL,
  `user_id_fk` int(10) NOT NULL,
  `place_emplacement_fk` varchar(100) NOT NULL,
  `matricule` varchar(100) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `qr_code_img` varchar(255) NOT NULL,
  `paiment` float NOT NULL,
  `jawaz_id_fk` varchar(100) NOT NULL,
  `fidelite_id_fk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `utilisateur`
--

CREATE TABLE `utilisateur` (
  `user_id` int(10) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jawaz_id` varchar(100) NOT NULL,
  `fidelite_id` varchar(100) NOT NULL,
  `token` int(10) NOT NULL,
  `token_date` datetime NOT NULL DEFAULT current_timestamp(),
  `matricule` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `est_admin` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `utilisateur`
--

INSERT INTO `utilisateur` (`user_id`, `prenom`, `nom`, `email`, `password`, `jawaz_id`, `fidelite_id`, `token`, `token_date`, `matricule`, `est_admin`) VALUES
(1, 'aziz', 'el abbassi', 'aziz@gmail.com', '$2y$10$0Z60WeDJkMo1/oX.CJOqNurVlK9R18sNtd2Uz/H6CQyHIS1hz6P8W', '', '', 232801, '2024-04-27 13:00:00', '', 0),
(2, 'amin', 'el malki', 'amin@gmail.com', '$2y$10$84sEjWrT6prXNwTr/3.0H.dqDmb8uM7KJrUBOYyJ5P6bwalHGgrEO', '123456789', '987654321', 0, '2024-04-26 19:04:13', '', 0),
(3, 'omar', 'khabou', 'omar@gmail.com', '$2y$10$RwUjQLxEH/BMNkA8g9wEeOXiJoNIRZU7AcJ6lihbh5D6JTqxaaHkK', 'hdsf98hadsf98', 'kjadshf98dsjf9', 0, '2024-04-26 19:04:13', '', 0),
(4, 'admin', 'super', 'admin123@gmail.com', '$2y$10$fNslxTTstpDT2mro8sOdLOI37v6zeUAWJ7p3KLBbkOGjo33gq/LbO', '', '', 231140, '2024-05-14 10:52:00', '', 1),
(17, 'ayyoub', 'el aulah', 'ayyoub@gmail.com', '$2y$10$Tws4HjTnKo/hxHU7zq9G0.ORrU3xjWjARBatq/bdGBF40wq3gOyfa', '', '', 0, '2024-05-15 10:45:39', '22222 - ب - 22', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indices de la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indices de la tabla `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `place`
--
ALTER TABLE `place`
  MODIFY `place_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
