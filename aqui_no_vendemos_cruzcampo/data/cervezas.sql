-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 13-02-2025 a las 11:31:23
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
-- Base de datos: `daw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cervezas`
--

CREATE TABLE `cervezas` (
  `id_cerveza` int(3) NOT NULL,
  `denominacion` varchar(100) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `formato` varchar(100) NOT NULL,
  `tamanio` varchar(100) NOT NULL,
  `alergenos` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `foto` varchar(200) NOT NULL,
  `precio` int(50) NOT NULL,
  `observaciones` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cervezas`
--

INSERT INTO `cervezas` (`id_cerveza`, `denominacion`, `marca`, `tipo`, `formato`, `tamanio`, `alergenos`, `fecha`, `foto`, `precio`, `observaciones`) VALUES
(10, 'cerveza', 'Estrella Galicia', 'lager', 'botella', 'tercio', 'Sin alérgenos', '2025-02-17', 'uploads/images.jpeg', 1, 'cerveza para el fin de semana'),
(11, 'cerveza', 'Mahou', 'pale ale', 'lata', 'media', 'Cacahuete, Soja', '2025-02-18', 'uploads/0000337_33119_600.jpeg', 1, 'cerveza para pasar la tarde de jueves'),
(12, 'cerveza', 'Alhambra', 'pale ale', 'botella', 'tercio', 'Sin alérgenos', '2025-02-10', 'uploads/alhambra.jpg', 1, 'cerveza EXCEPCIONAL'),
(13, 'cerveza', 'Alhambra', 'abadia', 'botella', 'tercio', 'Sin alérgenos', '2025-03-01', 'uploads/reserva_1925.jpg', 1, 'reserva 1925'),
(14, 'cerveza', 'Mahou', 'rubia', 'botella', 'litrona', 'Gluten', '2025-02-07', 'uploads/mahou_litro.jpg', 1, 'servir muy fría'),
(15, 'cerveza', 'DAM', 'lager', 'botella', 'tercio', 'Sin alérgenos', '2025-02-14', 'uploads/volldamm-web.jpg', 1, 'cerveza con mucho alcohol');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cervezas`
--
ALTER TABLE `cervezas`
  ADD PRIMARY KEY (`id_cerveza`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cervezas`
--
ALTER TABLE `cervezas`
  MODIFY `id_cerveza` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
