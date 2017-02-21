-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-08-2016 a las 23:08:48
-- Versión del servidor: 5.1.73
-- Versión de PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `incmantis_operaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pais`
--

CREATE TABLE IF NOT EXISTS `Pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poligono` longtext COLLATE utf8_unicode_ci,
  `zoom` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DE6F81C1DB38439E` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `Pais`
--

INSERT INTO `Pais` (`id`, `nombre`, `latitud`, `longitud`, `poligono`, `zoom`, `usuario_id`, `fechaModificacion`) VALUES
(1, 'COLOMBIA', '', '', '', 0, NULL, NULL),
(2, 'ESTADOS UNIDOS', '', '', '', 0, NULL, NULL),
(3, 'ARGENTINA', '', '', '', 0, NULL, NULL),
(4, 'BOLIVIA', '', '', '', 0, NULL, NULL),
(5, 'BRASIL', '', '', '', 0, NULL, NULL),
(6, 'CHILE ', '', '', '', 0, NULL, NULL),
(8, 'COSTARICA', '', '', '', 0, NULL, NULL),
(9, 'ECUADOR', '', '', '', 0, NULL, NULL),
(10, 'EL SALVADOR', '', '', '', 0, NULL, NULL),
(12, 'GUATEMALA', '', '', '', 0, NULL, NULL),
(13, 'HONDURAS', '', '', '', 0, NULL, NULL),
(14, 'MEXICO', '', '', '', 0, NULL, NULL),
(15, 'NICARAGUA', '', '', '', 0, NULL, NULL),
(16, 'PANAMA', '', '', '', 0, NULL, NULL),
(17, 'PARAGUAY', '', '', '', 0, NULL, NULL),
(18, 'PERU', '', '', '', 0, NULL, NULL),
(19, 'REPUBLICA DOMINICANA', '', '', '', 0, NULL, NULL),
(20, 'URUGUAY', '', '', '', 0, NULL, NULL),
(21, 'VENEZUELA', '', '', '', 0, NULL, NULL),
(22, 'ARUBA & CURAZAO', '', '', '', 0, NULL, NULL),
(23, 'CANADA', '', '', '', 0, NULL, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Pais`
--
ALTER TABLE `Pais`
  ADD CONSTRAINT `FK_DE6F81C1DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
