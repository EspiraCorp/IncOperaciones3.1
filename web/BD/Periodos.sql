-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-08-2016 a las 04:03:31
-- Versión del servidor: 5.1.73
-- Versión de PHP: 5.3.3

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `incmantis_operaciones`
--

--
-- Volcado de datos para la tabla `Periodos`
--

INSERT INTO `Periodos` (`id`, `descripcion`, `periodo`, `usuario_id`, `fechaModificacion`) VALUES
(1, '', '2015-01', NULL, NULL),
(2, '', '2015-02', NULL, NULL),
(3, '', '2015-03', NULL, NULL),
(4, '', '2015-04', NULL, NULL),
(5, '', '2015-05', NULL, NULL),
(6, '', '2015-06', NULL, NULL),
(7, '', '2015-07', NULL, NULL),
(8, '', '2015-08', NULL, NULL),
(9, '', '2015-09', NULL, NULL),
(10, '', '2015-10', NULL, NULL),
(11, '', '2015-11', NULL, NULL),
(12, '', '2015-12', NULL, NULL),
(13, NULL, '2016-01', NULL, NULL),
(14, NULL, '2016-02', NULL, NULL),
(15, NULL, '2016-03', NULL, NULL),
(16, NULL, '2016-04', NULL, NULL),
(17, NULL, '2016-05', NULL, NULL),
(18, NULL, '2016-06', 1, '2016-07-21 00:00:00'),
(19, NULL, '2016-07', 1, '2016-07-21 00:00:00'),
(20, NULL, '2016-08', 1, '2016-07-21 00:00:00'),
(21, NULL, '2016-09', 1, '2016-07-21 00:00:00'),
(22, NULL, '2016-10', 1, '2016-07-21 00:00:00'),
(23, NULL, '2016-11', 1, '2016-07-21 00:00:00'),
(24, NULL, '2016-12', 1, '2016-07-21 00:00:00');
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
