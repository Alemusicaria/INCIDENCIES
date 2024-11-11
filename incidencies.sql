-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2024 a las 12:15:39
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
-- Estructura de tabla para la tabla `incidencies`
--

CREATE TABLE `incidencies` (
  `id` int(11) NOT NULL,
  `creador_nom_cognoms` varchar(100) NOT NULL,
  `titol_fallo` varchar(150) NOT NULL,
  `descripcio` text NOT NULL,
  `tipus_incidencia` enum('Calefacció','Electricitat/Fontaner','Informàtica','Fusteria','Ferrer','Obres','Audiovisual','Equips de seguretat','Neteja de clavegueram') NOT NULL,
  `id_ubicacio` int(11) DEFAULT NULL,
  `data_incidencia` timestamp NOT NULL DEFAULT current_timestamp(),
  `estat` enum('Pendent','En Progrés','Resolta') DEFAULT 'Pendent',
  `prioritat` enum('Baixa','Mitjana','Alta') DEFAULT 'Baixa',
  `imatges` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 1, 1, 'Hola Maria, com estàs?', '2024-11-11 09:43:43'),
(2, 1, 2, 'Hola Aleix, tot bé. I tu?', '2024-11-11 09:43:53'),
(3, 1, 1, 'Estic bé, gràcies! Volia parlar sobre la reunió de demà.', '2024-11-11 09:44:04'),
(4, 2, 1, 'Bon dia Jordi, necessito parlar sobre la planificació d\'aquesta setmana.', '2024-11-11 09:44:15'),
(5, 2, 3, 'Bon dia Aleix, segur. Quan et va bé?', '2024-11-11 09:44:21'),
(6, 2, 1, 'Què et sembla a les 10:00 AM?', '2024-11-11 09:44:31'),
(7, 1, 1, 'fsdfsdf', '2024-11-11 09:58:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `planta` enum('Planta -1','Planta 0','Planta 1','Planta 2','Planta 3','Planta 4','Altres') NOT NULL,
  `sala` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE `usuaris` (
  `id` int(11) NOT NULL,
  `nom_cognoms` varchar(100) NOT NULL,
  `correu` varchar(100) NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `rol` enum('Professor','Tecnic','Admin') NOT NULL,
  `habilitat` tinyint(1) DEFAULT 1,
  `data_registre` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `nom_cognoms`, `correu`, `contrasenya`, `telefon`, `rol`, `habilitat`, `data_registre`, `foto`) VALUES
(1, 'Aleix Prat', 'aleix@gmail.com', '123456', '987654321', 'Professor', 1, '2024-11-11 10:35:38', NULL),
(2, 'Maria López', 'maria@gmail.com', '654321', '987654322', 'Professor', 1, '2024-11-11 10:40:00', NULL),
(3, 'Jordi González', 'jordi@gmail.com', '111222', '987654323', 'Admin', 1, '2024-11-11 10:45:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xats`
--

CREATE TABLE `xats` (
  `id` int(11) NOT NULL,
  `usuari1_id` int(11) NOT NULL,
  `usuari2_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `incidencies`
--
ALTER TABLE `incidencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ubicacio` (`id_ubicacio`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correu` (`correu`);

--
-- Indices de la tabla `xats`
--
ALTER TABLE `xats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuari1_id` (`usuari1_id`,`usuari2_id`),
  ADD UNIQUE KEY `usuari2_id` (`usuari2_id`,`usuari1_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `incidencies`
--
ALTER TABLE `incidencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `xats`
--
ALTER TABLE `xats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `incidencies`
--
ALTER TABLE `incidencies`
  ADD CONSTRAINT `incidencies_ibfk_1` FOREIGN KEY (`id_ubicacio`) REFERENCES `sales` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `xats`
--
ALTER TABLE `xats`
  ADD CONSTRAINT `xats_ibfk_1` FOREIGN KEY (`usuari1_id`) REFERENCES `usuaris` (`id`),
  ADD CONSTRAINT `xats_ibfk_2` FOREIGN KEY (`usuari2_id`) REFERENCES `usuaris` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
