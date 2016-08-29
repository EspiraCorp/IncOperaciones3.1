-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-08-2016 a las 22:00:21
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
-- Estructura de tabla para la tabla `Programa`
--

CREATE TABLE IF NOT EXISTS `Programa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `centrocostos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fechainicio` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `iva` tinyint(1) DEFAULT NULL,
  `diasentrega` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FB86765BDE734E51` (`cliente_id`),
  KEY `IDX_FB86765B9F5A440B` (`estado_id`),
  KEY `IDX_FB86765BDB38439E` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=77 ;

--
-- Volcado de datos para la tabla `Programa`
--

INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(1, 1, 'DEMO', '1710', 'Programa de demostración', '2014-02-01', '2015-01-01', 1, 9, 1, 20, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(3, 4, 'PITS ', '3100', 'Programa de incentivos para los Administradores', '2014-08-12', '2015-08-12', NULL, 0, 0, 25, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(4, 10, 'BI-CHC', '4000', 'Programa de incentivos ', '2014-08-22', '2015-08-22', NULL, 0, 0, 0, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(8, 15, 'Formula ganadora', '7601', 'Programa de incentivos', '2014-12-31', '2015-05-31', NULL, NULL, 1, 30, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(9, 16, 'Ganas porque Ganas con Kellogs', '7202', 'Programa de incentivos', '2015-03-01', '2015-12-31', NULL, NULL, 1, 30, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(10, 17, 'Tu esfuerzo vale', '6902', 'Programa de incentivos', '2015-01-01', '2015-12-31', NULL, NULL, 1, 15, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(11, 18, 'Salimos contoda 2015', '1806', 'programa de incentivos', '2015-02-01', '2015-11-30', NULL, NULL, 1, 30, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(12, 19, 'a ganar  deliciosa mente', '1710', 'programa de incentivos', '2015-02-01', '2015-11-30', NULL, NULL, 1, 30, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(13, 20, 'MARITZ', '7000', 'Programa de incentivos', '2013-02-01', '2018-02-01', NULL, NULL, 1, 30, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(14, 21, 'A la fija con BDF 2015', '3506', 'Programa de incentivos', '2015-03-01', '2015-10-31', NULL, NULL, 0, 5, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(15, 21, 'PLAN ELITE 2015', '3507', 'Programa de incentivos', '2015-05-01', '2015-11-30', NULL, NULL, 0, 30, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(16, 22, 'Que Equipazo 2015', '7701', 'Programa de incentivos', '2015-04-01', '2015-06-30', NULL, NULL, 0, 5, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(17, 23, 'SOCIO ESTRELLA 2015', '6402', 'Programa de incentivos', '2015-01-01', '2015-12-31', NULL, NULL, 0, 20, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(18, 14, 'Brinsa premium', '6703', 'programa de incentivos', '2015-02-01', '2015-11-30', NULL, NULL, 0, 10, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(19, 14, 'Brinsa club', '6704', 'programas de incentivos', '2015-04-01', '2015-12-31', NULL, NULL, 0, 10, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(20, 24, 'Socios Nutresa Autoservicios', '5808', 'Programa de incentivos', '2015-04-01', '2015-12-31', NULL, NULL, 0, 30, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(21, 25, 'FANATIKOS', '6105', 'Programa de incentivos', '2015-03-01', '2015-12-31', NULL, NULL, 0, 5, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(22, 26, 'Conquistadores QBE', '1007-5101', 'Programa de incentivos dirigidos a los asesores comerciales o brokers de seguros, f&i y asesores f&i que los premia por la colocación de pólizas de vehículos con QBE', '2015-06-01', '2016-05-31', NULL, NULL, 1, 45, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(23, 27, 'Casaluker Comercial', '2033', 'Programa de redención de puntos', '2015-05-01', '2015-07-31', NULL, NULL, 1, 15, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(24, 27, 'Casaluker Mercaderistas', '2032', 'Catalogo de redención de puntos', '2015-05-01', '2015-07-31', NULL, NULL, 1, 30, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(25, 27, 'Casaluker Águilas', '2033', 'Catalogo redención de puntos', '2015-05-01', '2015-07-31', NULL, NULL, 1, 30, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(26, 28, 'HERO', '7801', 'Catalogo de redención de puntos', '2015-05-01', '2015-12-31', NULL, NULL, 0, 15, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(27, 1, 'prueba', '7777', 'Prueba', '2015-08-31', '2015-08-31', NULL, NULL, 1, 20, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(29, 1, 'prueba', '6799', 'Prueba', '2015-08-31', '2016-01-30', NULL, NULL, 1, 25, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(30, 29, 'EXPEDICIÓN AL ÉXITO', '5304', 'CATALOG DE PUNTOS', '2015-04-01', '2016-03-31', NULL, NULL, 1, 30, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(31, 25, 'Club Huggies', '6109', 'Catalogo', '2015-08-07', '2016-08-07', NULL, NULL, 1, 30, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(32, 30, 'Socios & Amigos internacionales', '2703', 'tiqueteadores / agencias de viajes', '2015-08-01', '2017-07-31', NULL, NULL, 0, 15, 4, '2016-02-01 11:50:58');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(33, 24, 'Nutresa', '5807', 'Catalogo de redención de sellos', '2015-06-01', '2016-05-31', NULL, NULL, 1, 15, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(34, 24, 'Nutresa', '5807', 'Catalogo de redención de sellos', '2015-06-01', '2016-05-31', NULL, NULL, 1, 15, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(35, 31, 'Socios Nutresa Amigos para crecer tiendas', '5807', 'Catatalogo sellos', '2016-05-31', '2016-05-31', NULL, NULL, 0, 15, NULL, NULL);
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(36, 32, 'Catalogo Incentivos', '1017', 'Catalogo de redención de estrellas', '2015-05-11', '2016-04-30', NULL, NULL, 1, 15, 13, '2015-09-28 14:42:18');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(37, 17, 'Allus', '6903', 'Catalogo de redención de puntos', '2015-02-15', '2015-12-31', NULL, NULL, 1, 8, 13, '2015-10-08 08:51:21');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(38, 32, 'iNCENTIVATE', '1017', 'PROGRAM INTERNO', '2015-05-01', '2016-04-30', NULL, NULL, 1, 30, 4, '2015-11-17 16:27:47');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(39, 30, 'Socios & Amigos Colombia', '2702', 'tiqueteadores / agencias de viajes', '2015-08-01', '2017-07-31', NULL, NULL, 1, 15, 4, '2016-02-01 11:51:57');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(40, 34, 'Club McCain', '8201', 'Catalogo de redención de puntos de McCain', '2016-02-01', '2016-12-31', NULL, NULL, 0, 20, 13, '2016-01-04 08:50:08');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(41, 16, 'Ganas Porque Ganas', '7203', 'Catalogo de redención de puntos', '2016-02-01', '2016-12-31', NULL, NULL, 0, 21, 13, '2016-01-06 14:21:21');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(42, 35, 'Ganas Porque Ganas 2016', '7203', 'Catalogo Redención de puntos', '2016-02-01', '2016-12-31', NULL, NULL, 0, 21, 13, '2016-01-06 14:22:16');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(43, 24, 'Socios Nutresa Minimercados Bogota ', '5804', 'catalogo de redención de puntos', '2016-04-01', '2016-12-31', NULL, NULL, 1, 15, 13, '2016-06-28 09:33:25');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(44, 36, 'PLAN ELITE 2016 DUEÑOS ', '3509', 'catalogo de pre redenciones', '2016-03-01', '2016-11-30', NULL, NULL, 0, 20, 13, '2016-01-18 11:17:28');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(45, 36, 'PLAN ELITE 2016 DEPENDIENTE', '3509', 'Catalogo de acumulación de puntos', '2016-03-01', '2016-11-30', NULL, NULL, 1, 20, 13, '2016-01-18 11:49:05');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(46, 24, 'Socios Nutresa amigos para crecer Mayoristas 2016', '5810', 'Catalogo de  premios inmediatos', '2016-02-01', '2016-12-31', NULL, NULL, 0, 20, 13, '2016-07-26 09:10:39');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(47, 18, 'Salimos con toda 2016', '1807', 'catalogo de redención de puntos', '2016-03-01', '2016-11-30', NULL, NULL, 1, 30, 14, '2016-02-05 11:56:13');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(48, 37, 'Catalogos internacionales Av Bussines', '8000', 'Catalogo Internacionales', '2016-01-31', '2016-12-31', NULL, NULL, 0, 20, 13, '2016-01-25 09:52:46');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(49, 37, 'Catalogos internacionales EDENRED', '7002', 'Catálogos internacionales', '2016-02-01', '2016-12-31', NULL, NULL, 1, 20, 13, '2016-01-25 09:53:56');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(50, 37, 'Catalogos internacionales MARITZ', '7000', 'catalogo de MARITZ', '2016-01-31', '2016-12-31', NULL, NULL, 1, 20, 13, '2016-01-25 09:54:50');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(51, 24, 'Socios Nutresa amigos para crecer Autoservicios  2016', '5812', 'Catalogo Autoservicios', '2016-01-31', '2016-12-30', NULL, NULL, 0, 30, 13, '2016-01-27 12:26:41');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(52, 25, 'Fanatikos 2016', '6111', 'catalogo redencion de puntos', '2016-02-01', '2016-12-30', NULL, NULL, 1, 20, 13, '2016-01-27 14:11:30');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(53, 25, 'Club mayoristas', '6113', 'catalogo de redención de puntos', '2016-02-01', '2016-12-30', NULL, NULL, 1, 20, 13, '2016-01-27 14:12:47');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(54, 25, 'Club pañalero 2016', '6112', 'catalogo de redención de puntos', '2016-01-01', '2016-12-30', NULL, NULL, 1, 20, 13, '2016-01-27 14:14:10');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(55, 39, 'CONECTADOS CON SANOFI', '8301', 'Programa de lealtad', '2016-03-01', '2016-12-31', NULL, NULL, 1, 20, 13, '2016-02-02 10:15:43');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(56, 9, 'PITS 2015', '4309', 'CATALOGO DE REDENCIÓN', '2015-01-04', '2015-11-30', NULL, NULL, 1, 20, 13, '2016-02-02 14:51:35');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(57, 41, 'Allus 2016', '6905', NULL, '2015-01-15', '2016-12-30', NULL, NULL, 1, 30, 13, '2016-02-08 10:30:00');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(58, 42, 'Encantados', '123456', 'Programa de visitas.', '2016-03-01', '2016-12-30', NULL, NULL, 1, 15, 13, '2016-02-09 11:50:45');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(59, 43, 'PITS COPEC ', '12345678', 'Programa dirigido a los atendedores de las estaciones de servicio de Chile', '2016-03-01', '2017-02-28', NULL, NULL, 1, 30, 13, '2016-05-17 11:51:03');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(60, 44, 'Socio estrella 2016', '6404', 'Compras', '2016-01-01', '2016-12-31', NULL, NULL, 1, 15, 13, '2016-02-17 11:15:21');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(61, 19, 'A ganar 2016', '1711', 'Programa de incentivos', '2016-02-01', '2016-12-30', NULL, NULL, 1, 30, 13, '2016-03-02 15:21:41');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(62, 9, 'PITS 2016', '4312', 'Programa de incentivos', '2016-01-01', '2016-12-31', NULL, NULL, 1, 20, 13, '2016-03-03 10:57:04');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(63, 9, 'Altoque 2016', '4311', 'Programa de incentivos', '2016-02-01', '2016-12-31', NULL, NULL, 1, 20, 13, '2016-03-03 10:59:12');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(64, 9, 'Carrera de Gazelas 2016', '4409', 'Programa de incentivos', '2016-02-01', '2016-12-31', NULL, NULL, 1, 20, 13, '2016-03-03 11:00:40');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(65, 21, 'A LA FIJA 2016', '3508', 'Catalogo de  recargas', '2016-02-01', '2016-11-30', NULL, NULL, 1, 15, 13, '2016-03-31 12:45:25');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(66, 45, 'Preferidos', '8401', 'Catalogo de Preferidos Asesores y Directivos de venta', '2016-01-01', '2016-12-31', NULL, NULL, 0, 20, 13, '2016-04-11 07:30:17');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(67, 46, 'Socios Nutresa Consumo Local', '5815', '', '2016-07-01', '2016-12-31', NULL, NULL, 1, 30, 13, '2016-04-28 16:15:06');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(68, 47, 'Merial', '8601', 'Catalogo para clínicas veterinarias y pets shops', '2016-07-01', '2016-12-31', NULL, NULL, 0, 15, 13, '2016-06-17 12:10:47');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(69, 48, 'Preferidos - Prabyc 2016', '8701', 'Catálogo para redención de puntos para Referidos y Clientes.', '2016-08-01', '2017-01-31', NULL, NULL, 1, 20, 13, '2016-06-09 16:24:34');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(70, 48, 'Cazadores', '8702', 'programa dirigido a vendedores.', '2016-07-01', '2017-02-28', NULL, NULL, 1, 15, 13, '2016-06-28 15:19:55');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(71, 17, 'Tu esfuerzo vale 2016', '6904', 'No hay catalogo porque el plan paga por total pass\r\n solo es para hacer solicitudes de cotización, compra, despachos.', '2015-10-01', '2016-12-31', NULL, NULL, 1, 20, 13, '2016-06-13 08:02:29');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(72, 29, 'Expedicion totto 2016 - 2017', '5305', 'Catalo', '2016-04-01', '2017-03-31', NULL, NULL, 1, 15, 13, '2016-06-14 09:20:33');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(73, 24, 'Socios Nutresa Minimercados Pereira', '5814', 'Catalogo de redención', '2016-04-01', '2016-12-31', NULL, NULL, 1, 25, 14, '2016-06-29 10:54:13');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(74, 31, 'Socios Nutresa Tiendas 2016 - 2017', '5813', 'Catalogo redención de estrellas', '2016-07-01', '2017-12-30', NULL, NULL, 1, 15, 13, '2016-07-21 09:57:08');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(75, 34, 'Fuerza Elite', '8201', 'Catalogo redención de puntos.', '2016-07-01', '2017-06-01', NULL, NULL, 1, 20, 13, '2016-07-27 12:52:18');
INSERT INTO `Programa` (`id`, `cliente_id`, `nombre`, `centrocostos`, `descripcion`, `fechainicio`, `fechafin`, `estado_id`, `logistica`, `iva`, `diasentrega`, `usuario_id`, `fechaModificacion`) VALUES(76, 19, 'Milla Extra', '1713', 'Es el programa de incentivos que te llevará exitosamente por un mar de  ventas. Durante esta gran travesía tendrás divertidas actividades abordo,  donde involucrarás y compartirás una experiencia única con tu familia.', '2016-08-01', '2017-02-28', NULL, NULL, 1, 4, 14, '2016-08-16 11:11:35');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Programa`
--
ALTER TABLE `Programa`
  ADD CONSTRAINT `FK_FB86765BDE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `Cliente` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
