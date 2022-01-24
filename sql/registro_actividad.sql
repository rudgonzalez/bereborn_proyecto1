-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-01-2022 a las 04:36:32
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
-- Estructura de tabla para la tabla `registro_actividad`
--

CREATE TABLE `registro_actividad` (
  `id` int(11) NOT NULL,
  `idCiudadano` int(11) NOT NULL,
  `idActividad` int(11) NOT NULL,
  `comentario` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `registro_actividad`
--

INSERT INTO `registro_actividad` (`id`, `idCiudadano`, `idActividad`, `comentario`, `id_usuario`, `fecha`) VALUES
(2, 1, 2, '', 1, '2022-01-23 05:15:33'),
(4, 1, 4, '', 1, '2022-01-23 05:28:09'),
(5, 1, 5, '', 1, '2022-01-23 05:29:00'),
(7, 4, 4, '', 1, '2022-01-23 09:18:22'),
(9, 4, 8, 'Se dono una nevera y estufa.', 1, '2022-01-23 10:09:27'),
(10, 4, 1, '', 1, '2022-01-23 10:10:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registro_actividad`
--
ALTER TABLE `registro_actividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCiudadano` (`idCiudadano`),
  ADD KEY `idActividad` (`idActividad`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registro_actividad`
--
ALTER TABLE `registro_actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `registro_actividad`
--
ALTER TABLE `registro_actividad`
  ADD CONSTRAINT `registro_actividad_ibfk_1` FOREIGN KEY (`idActividad`) REFERENCES `actividades` (`id`),
  ADD CONSTRAINT `registro_actividad_ibfk_2` FOREIGN KEY (`idCiudadano`) REFERENCES `ciudadanos` (`id`),
  ADD CONSTRAINT `registro_actividad_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
