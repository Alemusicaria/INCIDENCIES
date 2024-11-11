-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2024 a las 12:01:45
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
-- Base de datos: `incidencies`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `missatges`
--

CREATE TABLE `missatges` (
  `id` int(11) NOT NULL,
  `xat_id` int(11) NOT NULL,
  `remitent_id` int(11) NOT NULL,
  `missatge` text NOT NULL,
  `data_enviament` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `missatges`
--

INSERT INTO `missatges` (`id`, `xat_id`, `remitent_id`, `missatge`, `data_enviament`) VALUES
(1, 1, 1, 'Hola Maria, com estàs?', '2024-11-11 10:43:43'),
(2, 1, 2, 'Hola Aleix, tot bé. I tu?', '2024-11-11 10:43:53'),
(3, 1, 1, 'Estic bé, gràcies! Volia parlar sobre la reunió de demà.', '2024-11-11 10:44:04'),
(4, 2, 1, 'Bon dia Jordi, necessito parlar sobre la planificació d\'aquesta setmana.', '2024-11-11 10:44:15'),
(5, 2, 3, 'Bon dia Aleix, segur. Quan et va bé?', '2024-11-11 10:44:21'),
(6, 2, 1, 'Què et sembla a les 10:00 AM?', '2024-11-11 10:44:31'),
(7, 1, 1, 'fsdfsdf', '2024-11-11 10:58:21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `missatges`
--
ALTER TABLE `missatges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `xat_id` (`xat_id`),
  ADD KEY `remitent_id` (`remitent_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `missatges`
--
ALTER TABLE `missatges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `missatges`
--
ALTER TABLE `missatges`
  ADD CONSTRAINT `missatges_ibfk_1` FOREIGN KEY (`xat_id`) REFERENCES `xats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `missatges_ibfk_2` FOREIGN KEY (`remitent_id`) REFERENCES `usuaris` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
