-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2024 a las 10:15:34
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correu` (`correu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
