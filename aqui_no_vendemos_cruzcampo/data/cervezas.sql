-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 11-02-2025 a las 15:09:51
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
(2, 'cerveza', 'Alhambra', 'rubia', 'botella', 'tercio', 'Sin alérgenos', '2025-02-19', 'uploads/alhambra.jpg', 3, 'la mejor cerveza'),
(3, 'Vol Damm', 'DAM', 'lager', 'botella', 'tercio', 'Cacahuete, Sulfitos, Huevo', '2025-02-25', 'uploads/damm.jpg', 4, 'MUCHO alcohol'),
(4, 'Artesana', 'Alhambra', 'rubia', 'lata', 'pack', 'Huevo', '2025-02-24', 'uploads/estrella.jpeg', 2, 'servir muy fria'),
(5, 'Sierra Nevada', 'Alhambra', 'pale ale', 'botella', 'tercio', '[\"Gluten\"]', '2025-12-19', 'uploads/paleale.jpg', 5, 'cerveza con toque de uva');

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
  MODIFY `id_cerveza` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
