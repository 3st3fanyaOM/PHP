-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 07-01-2025 a las 21:46:26
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
-- Base de datos: `cervezas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cervezas`
--

CREATE TABLE `cervezas` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `envase` varchar(50) NOT NULL,
  `cantidad` varchar(50) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `advertencia` text DEFAULT NULL,
  `fechacaducidad` date DEFAULT NULL,
  `alergenos` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `denominacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cervezas`
--

INSERT INTO `cervezas` (`id`, `tipo`, `envase`, `cantidad`, `marca`, `advertencia`, `fechacaducidad`, `alergenos`, `observaciones`, `foto`, `denominacion`) VALUES
(1, 'bitter', 'Tercio', '33cl', 'Heineken', NULL, '2025-10-30', 'Gluten', NULL, 'uploads/tercioHeinkn.jpeg', 'tercio');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cervezas`
--
ALTER TABLE `cervezas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cervezas`
--
ALTER TABLE `cervezas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
