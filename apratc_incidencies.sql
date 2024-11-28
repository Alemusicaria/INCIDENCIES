-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2024 a las 10:18:11
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
  `habilitado` tinyint(1) DEFAULT 1,
  `id_tecnico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `incidencies`
--

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
(2, 1, 2);

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
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura de tabla para la tabla `tecnics`
--

CREATE TABLE `tecnics` (
  `id` int(11) NOT NULL,
  `nom_cognoms` varchar(100) NOT NULL,
  `categoria` enum('Calefacció','Electricitat','Fontaner','Informàtica','Fusteria','Ferrer','Obres','Audiovisual','Equips de seguretat','Neteja de clavegueram','Altres') NOT NULL,
  `telefon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tecnics`
--

INSERT INTO `tecnics` (`id`, `nom_cognoms`, `categoria`, `telefon`) VALUES
(1, 'Leandro Clavijo', 'Calefacció', '+34614147941'),
(2, 'Ana Gómez', 'Electricitat', '987654321'),
(3, 'Pedro Martínez', 'Fontaner', '543216789'),
(4, 'Laura Fernández', 'Informàtica', '654321987'),
(5, 'Javier López', 'Fusteria', '321654987'),
(6, 'Miguel Ángel Ruiz', 'Ferrer', '876543210'),
(7, 'Elena Martínez', 'Obres', '123987654'),
(8, 'David Jiménez', 'Audiovisual', '456789321'),
(9, 'Sergio García', 'Equips de seguretat', '789654123'),
(10, 'María González', 'Neteja de clavegueram', '135792468'),
(11, 'Ricardo Torres', 'Calefacció', '222333444'),
(12, 'Sofía Ruiz', 'Electricitat', '555666777'),
(13, 'Fernando López', 'Fontaner', '444555666'),
(14, 'Carmen Pérez', 'Informàtica', '777888999'),
(15, 'Antonio García', 'Fusteria', '111223355'),
(16, 'Marta Sánchez', 'Ferrer', '998877665'),
(17, 'Luis Rodríguez', 'Obres', '333444555'),
(18, 'Isabel Moreno', 'Audiovisual', '666777888'),
(19, 'Victor Martínez', 'Equips de seguretat', '222111444'),
(20, 'Esther Álvarez', 'Neteja de clavegueram', '444555666');

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
(1, 'Admin', 'admin@aprat.cat', '$2y$10$.wwXvhIjjn1wkXUGBIJxo.GsWBkvz50W/dtbEIQzy61irvrVrO2B2', '684985274', 'Admin', 1, '2024-11-11 22:34:42', ' Images/Foto_Perfiles/user.png'),
(2, 'User', 'user@aprat.cat', '$2y$10$soyiSF/LJo2iS6lERp0XSOukVF4OQQBkcQo0ubYb3g3.esNWSkFX.', '987654321', 'Professor', 1, '2024-11-28 09:14:34', 'Images/Foto_Perfiles/user.png');

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
(1, 2, 1);

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
  ADD KEY `id_ubicacio` (`id_ubicacio`),
  ADD KEY `fk_tecnico` (`id_tecnico`);

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
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tecnics`
--
ALTER TABLE `tecnics`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `membres_grup`
--
ALTER TABLE `membres_grup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `missatges`
--
ALTER TABLE `missatges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tecnics`
--
ALTER TABLE `tecnics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `xats`
--
ALTER TABLE `xats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `incidencies`
--
ALTER TABLE `incidencies`
  ADD CONSTRAINT `fk_tecnico` FOREIGN KEY (`id_tecnico`) REFERENCES `tecnics` (`id`) ON DELETE SET NULL,
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
