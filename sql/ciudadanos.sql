-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-01-2022 a las 04:36:25
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectodonbosco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudadanos`
--

CREATE TABLE `ciudadanos` (
  `id` int(11) NOT NULL,
  `cedula` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_paterno` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_materno` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_resid` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_ofi` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `celular1` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `celular2` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `sector` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `facebook` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `instagram` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ciudadanos`
--

INSERT INTO `ciudadanos` (`id`, `cedula`, `nombre`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `sexo`, `correo`, `telefono_resid`, `telefono_ofi`, `celular1`, `celular2`, `sector`, `direccion`, `facebook`, `instagram`) VALUES
(1, '8-844-492', 'Ruben ', 'Gonzalez', 'Carcamo', '1990-12-09', 'Masculino', 'ruben09_elrubb@hotmail.com', '', '', '6299-4483', '', 'Don Bosco', 'Calle X, Casa 20A', '', ''),
(4, 'E-8-120252', 'Fernando', 'Zamora', 'Santracruz', '1982-09-15', 'Masculino', 'Fzamora1982@gmail.com', '', '', '6282-9868', '', 'Versalles', 'Las acacias ', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudadanos`
--
ALTER TABLE `ciudadanos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudadanos`
--
ALTER TABLE `ciudadanos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
