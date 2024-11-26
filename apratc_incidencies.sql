-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2024 a las 12:42:32
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
-- Base de datos: `apratc_incidencies`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grups`
--

CREATE TABLE `grups` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grups`
--

INSERT INTO `grups` (`id`, `nom`) VALUES
(1, 'grup informatica'),
(2, 'DAM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencies`
--

CREATE TABLE `incidencies` (
  `id` int(11) NOT NULL,
  `creador_nom_cognoms` varchar(100) NOT NULL,
  `titol_fallo` varchar(150) NOT NULL,
  `descripcio` text NOT NULL,
  `tipus_incidencia` enum('Calefacció','Electricitat','Fontaner','Informàtica','Fusteria','Ferrer','Obres','Audiovisual','Equips de seguretat','Neteja de clavegueram','Altres') NOT NULL,
  `id_ubicacio` int(11) DEFAULT NULL,
  `data_incidencia` timestamp NOT NULL DEFAULT current_timestamp(),
  `estat` enum('Pendent','En Progrés','Resolta') DEFAULT 'Pendent',
  `prioritat` enum('Baixa','Mitjana','Alta') DEFAULT 'Baixa',
  `descripcio_resolta` text DEFAULT NULL,
  `imatges` text DEFAULT NULL,
  `id_usuari` int(11) NOT NULL,
  `habilitado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `incidencies`
--

INSERT INTO `incidencies` (`id`, `creador_nom_cognoms`, `titol_fallo`, `descripcio`, `tipus_incidencia`, `id_ubicacio`, `data_incidencia`, `estat`, `prioritat`, `descripcio_resolta`, `imatges`, `id_usuari`, `habilitado`) VALUES
(1, 'Maria Puig', 'Error projector', 'El projector no funciona correctament.', 'Audiovisual', 6, '2024-11-12 08:15:00', 'Pendent', 'Alta', NULL, NULL, 2, 1),
(2, 'Joan Riera', 'Aire condicionat', 'La calefacció de l\'aula no funciona.', 'Calefacció', 11, '2024-11-13 10:30:00', 'En Progrés', 'Mitjana', NULL, NULL, 3, 1),
(3, 'Joan Martínez', 'Calefacció no funciona', 'La calefacció de la sala no s’encén des d’ahir.', 'Calefacció', 1, '2024-11-10 09:00:00', 'Pendent', 'Mitjana', NULL, 'calefaccio_error1.jpg', 2, 1),
(4, 'Maria Pérez', 'Problema amb projector', 'El projector de la sala no mostra la imatge.', 'Audiovisual', 5, '2024-11-12 07:30:00', 'En Progrés', 'Alta', NULL, 'projector_error.jpg', 1, 1),
(5, 'Pere Llull', 'Llums foses', 'La meitat dels fluorescents de la classe no funcionen.', 'Electricitat', 12, '2024-11-14 08:00:00', 'Pendent', 'Baixa', NULL, NULL, 3, 1),
(6, 'Anna Roca', 'Tuberia amb fuites', 'Hi ha una fuga d’aigua al lavabo de la planta baixa.', 'Fontaner', 8, '2024-11-13 10:15:00', 'Resolta', 'Alta', 'S’ha substituït la canonada danyada.', 'canonada.jpg', 3, 1),
(7, 'Miquel Serra', 'Pintura de parets deteriorada', 'Les parets de la sala tenen escrostonats que s’han d’arreglar.', 'Obres', 17, '2024-11-11 14:45:00', 'Pendent', 'Mitjana', NULL, NULL, 2, 1),
(8, 'Laura Vidal', 'Porta trencada', 'La porta de la sala 011 no es pot tancar correctament.', 'Fusteria', 11, '2024-11-14 11:00:00', 'En Progrés', 'Alta', NULL, 'porta_trencada.jpg', 2, 1),
(9, 'Jordi Pons', 'Falta de seguretat al passadís', 'Els detectors de fum no estan operatius.', 'Equips de seguretat', 6, '2024-11-13 12:30:00', 'Pendent', 'Alta', NULL, 'detectors_fum.jpg', 1, 1),
(10, 'Sara Font', 'Problemes amb el router', 'No hi ha connexió a Internet a la sala 002.', 'Informàtica', 2, '2024-11-14 13:20:00', 'En Progrés', 'Mitjana', NULL, 'router_error.jpg', 3, 1),
(11, 'Carles Gómez', 'Canalització obstruïda', 'L’aigua del clavegueram no drena correctament.', 'Neteja de clavegueram', 4, '2024-11-14 15:00:00', 'Resolta', 'Alta', 'S’ha eliminat l’obstrucció.', 'clavegueram.jpg', 2, 1),
(12, 'Clara Puig', 'Caiguda de sostre', 'Part del sostre s’ha desprès al passadís.', 'Altres', 21, '2024-11-13 17:45:00', 'Pendent', 'Alta', NULL, 'sostre_caigut.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membres_grup`
--

CREATE TABLE `membres_grup` (
  `id` int(11) NOT NULL,
  `grup_id` int(11) DEFAULT NULL,
  `usuari_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `membres_grup`
--

INSERT INTO `membres_grup` (`id`, `grup_id`, `usuari_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `missatges`
--

CREATE TABLE `missatges` (
  `id` int(11) NOT NULL,
  `grup_id` int(11) DEFAULT NULL,
  `xat_id` int(11) DEFAULT NULL,
  `usuari_id` int(11) DEFAULT NULL,
  `missatge` text DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `missatges`
--

INSERT INTO `missatges` (`id`, `grup_id`, `xat_id`, `usuari_id`, `missatge`, `data`) VALUES
(22, 1, NULL, 1, 'sdfsdfsdf', '2024-11-14 07:43:45'),
(23, NULL, 1, 1, 'fsdfds', '2024-11-14 07:48:59'),
(24, NULL, 3, 2, 'Hola\\r\\n', '2024-11-14 07:59:04'),
(25, NULL, 1, 2, 'sdfsdfsdf', '2024-11-14 07:59:26'),
(26, NULL, 1, 2, 'sdfsdfsd', '2024-11-14 07:59:52'),
(27, NULL, 1, 2, 'sdfsdf', '2024-11-14 08:04:09'),
(28, NULL, 1, 1, 'sdfsdf', '2024-11-14 08:04:15'),
(29, NULL, 1, 2, 'reertwertwertwertwert', '2024-11-14 08:05:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `planta` enum('Planta -1','Planta 0','Planta 1','Planta 2','Planta 3','Planta 4','Altres') NOT NULL,
  `sala` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `planta`, `sala`) VALUES
(1, 'Planta -1', 'Sala 001'),
(2, 'Planta -1', 'Sala 002'),
(3, 'Planta -1', 'Sala 003'),
(4, 'Planta -1', 'Sala 004'),
(5, 'Planta -1', 'Sala 005'),
(6, 'Planta 0', 'Sala 006'),
(7, 'Planta 0', 'Sala 007'),
(8, 'Planta 0', 'Sala 008'),
(9, 'Planta 0', 'Sala 009'),
(10, 'Planta 0', 'Sala 010'),
(11, 'Planta 1', 'Sala 011'),
(12, 'Planta 1', 'Sala 012'),
(13, 'Planta 1', 'Sala 013'),
(14, 'Planta 1', 'Sala 014'),
(15, 'Planta 1', 'Sala 015'),
(16, 'Planta 2', 'Sala 016'),
(17, 'Planta 2', 'Sala 017'),
(18, 'Planta 2', 'Sala 018'),
(19, 'Planta 2', 'Sala 019'),
(20, 'Planta 2', 'Sala 020'),
(21, 'Planta 3', 'Sala 021'),
(22, 'Planta 3', 'Sala 022'),
(23, 'Planta 3', 'Sala 023'),
(24, 'Planta 3', 'Sala 024'),
(25, 'Planta 3', 'Sala 025'),
(26, 'Planta 4', 'Sala 026'),
(27, 'Planta 4', 'Sala 027'),
(28, 'Planta 4', 'Sala 028'),
(29, 'Planta 4', 'Sala 029'),
(30, 'Planta 4', 'Sala 030');

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
(1, 'Leandro Clavijo ', 'leandro@gmail.com', '$2y$10$tLFg6JKV3an/8GWhQma/9.8Cfs1JVmWEokEMjATt9HCZrirK47w8e', '65487958', 'Admin', 1, '2024-11-11 22:31:32', ' Images/Foto_Perfiles/WhatsApp Image 2024-10-24 at 12.38.40 PM.jpeg'),
(2, 'Steve Portella', 'steve@gmail.com', '$2y$10$.wwXvhIjjn1wkXUGBIJxo.GsWBkvz50W/dtbEIQzy61irvrVrO2B2', '684985274', 'Professor', 1, '2024-11-11 22:34:42', ' Images/Foto_Perfiles/'),
(3, 'Aleix Prat', 'aleix@gmail.com', '$2y$10$7Oa.ByYazLbG0j3SaFQMFus/ygZjQPqE5AkGHO5Aa69plku8sYDxi', '65751818', 'Tecnic', 1, '2024-11-12 20:23:09', ' Images/Foto_Perfiles/arriba1.png');

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
-- Volcado de datos para la tabla `xats`
--

INSERT INTO `xats` (`id`, `usuari1_id`, `usuari2_id`) VALUES
(1, 2, 1),
(3, 2, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grups`
--
ALTER TABLE `grups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `incidencies`
--
ALTER TABLE `incidencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ubicacio` (`id_ubicacio`);

--
-- Indices de la tabla `membres_grup`
--
ALTER TABLE `membres_grup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grup_id` (`grup_id`),
  ADD KEY `usuari_id` (`usuari_id`);

--
-- Indices de la tabla `missatges`
--
ALTER TABLE `missatges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grup_id` (`grup_id`),
  ADD KEY `xat_id` (`xat_id`),
  ADD KEY `usuari_id` (`usuari_id`);

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
-- AUTO_INCREMENT de la tabla `grups`
--
ALTER TABLE `grups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `incidencies`
--
ALTER TABLE `incidencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `membres_grup`
--
ALTER TABLE `membres_grup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `missatges`
--
ALTER TABLE `missatges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `xats`
--
ALTER TABLE `xats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `incidencies`
--
ALTER TABLE `incidencies`
  ADD CONSTRAINT `incidencies_ibfk_1` FOREIGN KEY (`id_ubicacio`) REFERENCES `sales` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `membres_grup`
--
ALTER TABLE `membres_grup`
  ADD CONSTRAINT `membres_grup_ibfk_1` FOREIGN KEY (`grup_id`) REFERENCES `grups` (`id`),
  ADD CONSTRAINT `membres_grup_ibfk_2` FOREIGN KEY (`usuari_id`) REFERENCES `usuaris` (`id`);

--
-- Filtros para la tabla `missatges`
--
ALTER TABLE `missatges`
  ADD CONSTRAINT `missatges_ibfk_1` FOREIGN KEY (`grup_id`) REFERENCES `grups` (`id`),
  ADD CONSTRAINT `missatges_ibfk_2` FOREIGN KEY (`xat_id`) REFERENCES `xats` (`id`),
  ADD CONSTRAINT `missatges_ibfk_3` FOREIGN KEY (`usuari_id`) REFERENCES `usuaris` (`id`);

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