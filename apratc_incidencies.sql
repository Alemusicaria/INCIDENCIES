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

INSERT INTO `incidencies` (`id`, `creador_nom_cognoms`, `titol_fallo`, `descripcio`, `tipus_incidencia`, `id_ubicacio`, `data_incidencia`, `estat`, `prioritat`, `descripcio_resolta`, `imatges`, `id_usuari`, `habilitado`, `id_tecnico`) VALUES
(1, 'Aleix Prat', 'dsfgfgdssdfgdfgs32443524352', 'dsfegrfdgsdfsgdfgsdfgsdfsgfdgsfdgsdfgs', 'Fontaner', 2, '2024-11-18 09:01:15', 'Pendent', 'Baixa', NULL, 'Images/Evidencia/Captura de pantalla 2024-10-17 225004.png', 3, 1, NULL),
(2, 'Steve Portella', 'asdasdasd', 'fafsdgsdg', 'Ferrer', 6, '2024-11-19 11:14:10', 'Pendent', 'Mitjana', NULL, 'Images/Evidencia/moneda de 0.02.png,Images/Evidencia/moneda de 0.05.png,Images/Evidencia/moneda de 0.10.png,Images/Evidencia/moneda de 0.20.png', 2, 1, NULL),
(3, 'Leandro Clavijo ', 'dsadasfas', 'fasfasf', 'Fontaner', 1, '2024-11-19 12:18:39', 'Pendent', 'Baixa', '', 'Images/Evidencia/billete de 50.jpeg,Images/Evidencia/673eff2ca555d_billete de 10.jpeg', 1, 1, NULL),
(4, 'Leandro Clavijo ', 'dasdasd', '22222222222dasd', 'Informàtica', 12, '2024-11-19 12:22:25', 'En Progrés', 'Mitjana', 'ADIOS', 'Images/Evidencia/moneda de 2.png,Images/Evidencia/673efd2753bed_image-removebg-preview (64).png,Images/Evidencia/673efd275431f_images-removebg-preview (1).png,Images/Evidencia/673efdf31c775_image-removebg-preview (62).png,Images/Evidencia/673efec105c9e_image-removebg-preview (61).png', 1, 1, NULL),
(5, 'Leandro Clavijo ', 'dsadasfas', 'fasfasf', 'Calefacció', 7, '2024-11-21 08:25:25', 'Pendent', 'Alta', 'SE ACOOOO TODOSOSS', '', 1, 1, NULL),
(6, 'Leandro Clavijo ', 'HOLAAAAA MUNDOODDD', 'HOLAAAAA MUNDOODDD', 'Calefacció', 2, '2024-11-21 09:40:38', 'Pendent', 'Mitjana', 'SE ACABOOOO ESTOS BEBE', 'Images/Evidencia/image-removebg-preview (73).png,Images/Evidencia/image-removebg-preview (71).png,', 1, 1, NULL),
(7, 'Leandro Clavijo ', 'ajkdhakjsdh', 'jkhskjadha', 'Calefacció', 3, '2024-11-21 09:43:22', 'Pendent', 'Mitjana', '', 'Images/Evidencia/image-removebg-preview (69).png,Images/Evidencia/image-removebg-preview (68).png,', 1, 1, NULL),
(8, 'Leandro Clavijo ', 'holaaaaaaaaaaaaaaaaa', 'holaaaaaaaaaaaaa', 'Ferrer', 13, '2024-11-25 09:08:14', 'Pendent', 'Mitjana', 'ya se resolvio la incidencias', 'Images/Evidencia/67444797dab79_Texto del párrafo (1).png,Images/Evidencia/6744685821615_image-removebg-preview (75).png,Images/Evidencia/6744685822830_image-removebg-preview (74).png', 1, 1, NULL),
(9, 'Steve Portella', 'dlasjhdkasjd54d685asd', 'dasdkjashdd5a1s586d', 'Informàtica', 2, '2024-11-25 12:18:59', 'Pendent', 'Baixa', NULL, 'Images/Evidencia/WhatsApp Image 2024-11-21 at 8.57.09 PM.jpeg', 2, 1, NULL),
(10, 'Steve Portella', '5d4as56d1as', 'dasd564as6d5as', 'Informàtica', 21, '2024-11-25 12:19:19', 'Pendent', 'Mitjana', NULL, 'Images/Evidencia/image-removebg-preview (76).png,Images/Evidencia/image-removebg-preview (75).png,Images/Evidencia/image-removebg-preview (74).png', 2, 1, NULL),
(11, 'Steve Portella', 'das56das25d', 'dasd1as54d', 'Informàtica', 2, '2024-11-25 12:19:45', 'Pendent', 'Baixa', NULL, 'Images/Evidencia/image-removebg-preview (71).png,Images/Evidencia/image-removebg-preview (70).png,Images/Evidencia/image-removebg-preview (69).png,Images/Evidencia/image-removebg-preview (68).png', 2, 1, NULL),
(12, 'Leandro Clavijo ', 'Prueba_Eliminar', 'dad', 'Calefacció', 1, '2024-11-25 12:48:05', 'Pendent', 'Baixa', NULL, 'Images/Evidencia/Texto del párrafo (2).png,Images/Evidencia/Texto del párrafo (1).png', 1, 0, NULL),
(13, 'Leandro Clavijo ', 'sadasdas', 'dasdasdas', 'Electricitat', 6, '2024-11-26 11:01:51', 'Pendent', 'Baixa', NULL, 'Images/Evidencia/Texto del párrafo (2).png', 1, 1, NULL),
(14, 'Leandro Clavijo ', 'asdasdas', 'dasdasda', 'Obres', 11, '2024-11-26 11:02:37', 'Pendent', 'Baixa', NULL, 'Images/Evidencia/image-removebg-preview (76).png', 1, 1, NULL),
(15, 'Leandro Clavijo ', 'dasdas', 'dasdasda', 'Fontaner', 6, '2024-11-26 11:24:41', 'Pendent', 'Baixa', NULL, '', 1, 1, NULL),
(18, 'Leandro Clavijo ', 'Holaaaaaaaaaaaaaa', 'KLDASLKDJASD', 'Informàtica', 2, '2024-11-26 11:55:54', 'Pendent', 'Baixa', '', 'Images/Evidencia/image-removebg-preview (75).png', 1, 1, NULL),
(20, 'Leandro Clavijo ', 'xzczxc', 'zczxcz', 'Electricitat', 1, '2024-11-27 12:23:20', 'Pendent', 'Mitjana', NULL, 'Images/Evidencia/image-removebg-preview (76).png', 1, 1, 2),
(21, 'Leandro Clavijo ', 'zxczxc', 'vzvzxvz', 'Informàtica', 3, '2024-11-27 12:37:41', 'Pendent', 'Baixa', NULL, 'Images/Evidencia/image-removebg-preview (76).png,Images/Evidencia/image-removebg-preview (75).png', 1, 1, NULL),
(22, 'Leandro Clavijo ', 'dasdasdasd', 'dasdasda', 'Calefacció', 2, '2024-11-27 13:22:26', 'Pendent', 'Baixa', NULL, 'Images/Evidencia/image-removebg-preview (76).png', 1, 1, NULL),
(23, 'Leandro Clavijo ', 'aaaaaaaaaa', 'sasas', 'Calefacció', 19, '2024-11-27 13:54:42', 'Pendent', 'Mitjana', NULL, 'Images/Evidencia/image-removebg-preview (74).png', 1, 1, 1),
(24, 'Leandro Clavijo ', '43534', '6765', 'Calefacció', 8, '2024-11-27 14:25:10', 'Pendent', 'Baixa', NULL, '', 1, 1, 1),
(25, 'Leandro Clavijo ', 'barceolonaaaaaa', 'Barcelonaaaaaa', 'Calefacció', 8, '2024-11-27 19:32:21', 'En Progrés', 'Alta', '', 'Images/Evidencia/67478568a2dc6_WhatsApp Image 2024-11-21 at 10.06.07 PM.jpeg,Images/Evidencia/67478568a365f_hotel.png', 1, 1, 11),
(26, 'Leandro Clavijo ', 'dadasd', 'asdasdas', 'Altres', 11, '2024-11-27 22:17:01', 'Pendent', 'Baixa', '', 'Images/Evidencia/image-removebg-preview (76).png', 1, 1, NULL);

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
(29, NULL, 1, 2, 'reertwertwertwertwert', '2024-11-14 08:05:21'),
(33, NULL, 1, 1, 'putin\r\n', '2024-11-19 11:02:52'),
(34, NULL, 3, 3, 'hola bebe\r\n', '2024-11-19 11:12:35'),
(35, NULL, 3, 2, 'ctmr :3\r\n', '2024-11-19 11:13:13');

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
(1, 'Leandro Clavijo ', 'leandro@gmail.com', '$2y$10$tLFg6JKV3an/8GWhQma/9.8Cfs1JVmWEokEMjATt9HCZrirK47w8e', '65487958', 'Admin', 1, '2024-11-11 22:31:32', ' Images/Foto_Perfiles/WhatsApp Image 2024-10-24 at 12.38.40 PM.jpeg'),
(2, 'Steve Portella', 'steve@gmail.com', '$2y$10$.wwXvhIjjn1wkXUGBIJxo.GsWBkvz50W/dtbEIQzy61irvrVrO2B2', '684985274', 'Professor', 1, '2024-11-11 22:34:42', ' Images/Foto_Perfiles/'),
(3, 'Aleix Prat', 'aleix@gmail.com', '$2y$10$7Oa.ByYazLbG0j3SaFQMFus/ygZjQPqE5AkGHO5Aa69plku8sYDxi', '65751818', 'Tecnic', 1, '2024-11-12 20:23:09', ' Images/Foto_Perfiles/arriba1.png'),
(4, 'User', 'user@aprat.cat', '$2y$10$soyiSF/LJo2iS6lERp0XSOukVF4OQQBkcQo0ubYb3g3.esNWSkFX.', '987654321', 'Professor', 1, '2024-11-28 09:14:34', 'Images/Foto_Perfiles/6748347ad6f5a.png');

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
