-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2016 at 01:22 AM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 5.6.25-1+deb.sury.org~xenial+1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `incoperaciones_new`
--

--
-- Dumping data for table `Programa`
--

INSERT INTO `Programa` (`id`, `estado_id`, `cliente_id`, `usuario_id`, `nombre`, `descripcion`, `fechainicio`, `fechafin`, `logistica`, `iva`, `diasentrega`, `fechaModificacion`, `centroCostos_id`) VALUES
(1, 1, 1, NULL, 'DEMO', 'Programa de demostración', '2014-02-01', '2015-01-01', 9, 1, 20, NULL, 1),
(3, 1, 4, NULL, 'PITS ', 'Programa de incentivos para los Administradores', '2014-08-12', '2015-08-12', 0, 0, 25, NULL, 3),
(4, 1, 10, NULL, 'BI-CHC', 'Programa de incentivos ', '2014-08-22', '2015-08-22', 0, 0, 0, NULL, 4),
(8, 1, 15, NULL, 'Formula ganadora', 'Programa de incentivos', '2014-12-31', '2015-05-31', NULL, 1, 30, NULL, 8),
(9, 1, 16, NULL, 'Ganas porque Ganas con Kellogs', 'Programa de incentivos', '2015-03-01', '2015-12-31', NULL, 1, 30, NULL, 9),
(10, 1, 17, NULL, 'Tu esfuerzo vale', 'Programa de incentivos', '2015-01-01', '2015-12-31', NULL, 1, 15, NULL, 10),
(11, 1, 18, NULL, 'Salimos contoda 2015', 'programa de incentivos', '2015-02-01', '2015-11-30', NULL, 1, 30, NULL, 11),
(12, 1, 19, NULL, 'a ganar  deliciosa mente', 'programa de incentivos', '2015-02-01', '2015-11-30', NULL, 1, 30, NULL, 12),
(13, 1, 20, NULL, 'MARITZ', 'Programa de incentivos', '2013-02-01', '2018-02-01', NULL, 1, 30, NULL, 13),
(14, 1, 21, NULL, 'A la fija con BDF 2015', 'Programa de incentivos', '2015-03-01', '2015-10-31', NULL, 0, 5, NULL, 14),
(15, 1, 21, NULL, 'PLAN ELITE 2015', 'Programa de incentivos', '2015-05-01', '2015-11-30', NULL, 0, 30, NULL, 15),
(16, 1, 22, NULL, 'Que Equipazo 2015', 'Programa de incentivos', '2015-04-01', '2015-06-30', NULL, 0, 5, NULL, 16),
(17, 1, 23, NULL, 'SOCIO ESTRELLA 2015', 'Programa de incentivos', '2015-01-01', '2015-12-31', NULL, 0, 20, NULL, 17),
(18, 1, 14, NULL, 'Brinsa premium', 'programa de incentivos', '2015-02-01', '2015-11-30', NULL, 0, 10, NULL, 18),
(19, 1, 14, NULL, 'Brinsa club', 'programas de incentivos', '2015-04-01', '2015-12-31', NULL, 0, 10, NULL, 19),
(20, 1, 24, NULL, 'Socios Nutresa Autoservicios', 'Programa de incentivos', '2015-04-01', '2015-12-31', NULL, 0, 30, NULL, 20),
(21, 1, 25, NULL, 'FANATIKOS', 'Programa de incentivos', '2015-03-01', '2015-12-31', NULL, 0, 5, NULL, 21),
(22, 1, 26, NULL, 'Conquistadores QBE', 'Programa de incentivos dirigidos a los asesores comerciales o brokers de seguros, f&i y asesores f&i que los premia por la colocación de pólizas de vehículos con QBE', '2015-06-01', '2016-05-31', NULL, 1, 45, NULL, 22),
(23, 1, 27, NULL, 'Casaluker Comercial', 'Programa de redención de puntos', '2015-05-01', '2015-07-31', NULL, 1, 15, NULL, 23),
(24, 1, 27, NULL, 'Casaluker Mercaderistas', 'Catalogo de redención de puntos', '2015-05-01', '2015-07-31', NULL, 1, 30, NULL, 24),
(25, 1, 27, NULL, 'Casaluker Águilas', 'Catalogo redención de puntos', '2015-05-01', '2015-07-31', NULL, 1, 30, NULL, 25),
(26, 1, 28, NULL, 'HERO', 'Catalogo de redención de puntos', '2015-05-01', '2015-12-31', NULL, 0, 15, NULL, 26),
(27, 1, 1, NULL, 'prueba', 'Prueba', '2015-08-31', '2015-08-31', NULL, 1, 20, NULL, 27),
(29, 1, 1, NULL, 'prueba', 'Prueba', '2015-08-31', '2016-01-30', NULL, 1, 25, NULL, 29),
(30, 1, 29, NULL, 'EXPEDICIÓN AL ÉXITO', 'CATALOG DE PUNTOS', '2015-04-01', '2016-03-31', NULL, 1, 30, NULL, 30),
(31, 1, 25, NULL, 'Club Huggies', 'Catalogo', '2015-08-07', '2016-08-07', NULL, 1, 30, NULL, 31),
(32, 1, 30, 4, 'Socios & Amigos internacionales', 'tiqueteadores / agencias de viajes', '2015-08-01', '2017-07-31', NULL, 0, 15, '2016-02-01 11:50:58', 32),
(33, 1, 24, NULL, 'Nutresa', 'Catalogo de redención de sellos', '2015-06-01', '2016-05-31', NULL, 1, 15, NULL, 33),
(34, 1, 24, NULL, 'Nutresa', 'Catalogo de redención de sellos', '2015-06-01', '2016-05-31', NULL, 1, 15, NULL, 34),
(35, 1, 31, NULL, 'Socios Nutresa Amigos para crecer tiendas', 'Catatalogo sellos', '2016-05-31', '2016-05-31', NULL, 0, 15, NULL, 35),
(36, 1, 32, 13, 'Catalogo Incentivos', 'Catalogo de redención de estrellas', '2015-05-11', '2016-04-30', NULL, 1, 15, '2015-09-28 14:42:18', 36),
(37, 1, 17, 13, 'Allus', 'Catalogo de redención de puntos', '2015-02-15', '2015-12-31', NULL, 1, 8, '2015-10-08 08:51:21', 37),
(38, 1, 32, 4, 'iNCENTIVATE', 'PROGRAM INTERNO', '2015-05-01', '2016-04-30', NULL, 1, 30, '2015-11-17 16:27:47', 38),
(39, 1, 30, 4, 'Socios & Amigos Colombia', 'tiqueteadores / agencias de viajes', '2015-08-01', '2017-07-31', NULL, 1, 15, '2016-02-01 11:51:57', 39),
(40, 1, 34, 13, 'Club McCain', 'Catalogo de redención de puntos de McCain', '2016-02-01', '2016-12-31', NULL, 0, 20, '2016-01-04 08:50:08', 40),
(41, 1, 16, 13, 'Ganas Porque Ganas', 'Catalogo de redención de puntos', '2016-02-01', '2016-12-31', NULL, 0, 21, '2016-01-06 14:21:21', 41),
(42, 1, 35, 13, 'Ganas Porque Ganas 2016', 'Catalogo Redención de puntos', '2016-02-01', '2016-12-31', NULL, 0, 21, '2016-01-06 14:22:16', 42),
(43, 1, 24, 13, 'Socios Nutresa Minimercados Bogota ', 'catalogo de redención de puntos', '2016-04-01', '2016-12-31', NULL, 1, 15, '2016-06-28 09:33:25', 43),
(44, 1, 36, 13, 'PLAN ELITE 2016 DUEÑOS ', 'catalogo de pre redenciones', '2016-03-01', '2016-11-30', NULL, 0, 20, '2016-01-18 11:17:28', 44),
(45, 1, 36, 13, 'PLAN ELITE 2016 DEPENDIENTE', 'Catalogo de acumulación de puntos', '2016-03-01', '2016-11-30', NULL, 1, 20, '2016-01-18 11:49:05', 45),
(46, 1, 24, 13, 'Socios Nutresa amigos para crecer Mayoristas 2016', 'Catalogo de  premios inmediatos', '2016-02-01', '2016-12-31', NULL, 0, 20, '2016-07-26 09:10:39', 46),
(47, 1, 18, 14, 'Salimos con toda 2016', 'catalogo de redención de puntos', '2016-03-01', '2016-11-30', NULL, 1, 30, '2016-02-05 11:56:13', 47),
(48, 1, 37, 13, 'Catalogos internacionales Av Bussines', 'Catalogo Internacionales', '2016-01-31', '2016-12-31', NULL, 0, 20, '2016-01-25 09:52:46', 48),
(49, 1, 37, 13, 'Catalogos internacionales EDENRED', 'Catálogos internacionales', '2016-02-01', '2016-12-31', NULL, 1, 20, '2016-01-25 09:53:56', 49),
(50, 1, 37, 13, 'Catalogos internacionales MARITZ', 'catalogo de MARITZ', '2016-01-31', '2016-12-31', NULL, 1, 20, '2016-01-25 09:54:50', 50),
(51, 1, 24, 13, 'Socios Nutresa amigos para crecer Autoservicios  2016', 'Catalogo Autoservicios', '2016-01-31', '2016-12-30', NULL, 0, 30, '2016-01-27 12:26:41', 51),
(52, 1, 25, 13, 'Fanatikos 2016', 'catalogo redencion de puntos', '2016-02-01', '2016-12-30', NULL, 1, 20, '2016-01-27 14:11:30', 52),
(53, 1, 25, 13, 'Club mayoristas', 'catalogo de redención de puntos', '2016-02-01', '2016-12-30', NULL, 1, 20, '2016-01-27 14:12:47', 53),
(54, 1, 25, 13, 'Club pañalero 2016', 'catalogo de redención de puntos', '2016-01-01', '2016-12-30', NULL, 1, 20, '2016-01-27 14:14:10', 54),
(55, 1, 39, 13, 'CONECTADOS CON SANOFI', 'Programa de lealtad', '2016-03-01', '2016-12-31', NULL, 1, 20, '2016-02-02 10:15:43', 55),
(56, 1, 9, 13, 'PITS 2015', 'CATALOGO DE REDENCIÓN', '2015-01-04', '2015-11-30', NULL, 1, 20, '2016-02-02 14:51:35', 56),
(57, 1, 41, 13, 'Allus 2016', NULL, '2015-01-15', '2016-12-30', NULL, 1, 30, '2016-02-08 10:30:00', 57),
(58, 1, 42, 13, 'Encantados', 'Programa de visitas.', '2016-03-01', '2016-12-30', NULL, 1, 15, '2016-02-09 11:50:45', 58),
(59, 1, 43, 13, 'PITS COPEC ', 'Programa dirigido a los atendedores de las estaciones de servicio de Chile', '2016-03-01', '2017-02-28', NULL, 1, 30, '2016-05-17 11:51:03', 59),
(60, 1, 44, 13, 'Socio estrella 2016', 'Compras', '2016-01-01', '2016-12-31', NULL, 1, 15, '2016-02-17 11:15:21', 60),
(61, 1, 19, 13, 'A ganar 2016', 'Programa de incentivos', '2016-02-01', '2016-12-30', NULL, 1, 30, '2016-03-02 15:21:41', 61),
(62, 1, 9, 13, 'PITS 2016', 'Programa de incentivos', '2016-01-01', '2016-12-31', NULL, 1, 20, '2016-03-03 10:57:04', 62),
(63, 1, 9, 13, 'Altoque 2016', 'Programa de incentivos', '2016-02-01', '2016-12-31', NULL, 1, 20, '2016-03-03 10:59:12', 63),
(64, 1, 9, 13, 'Carrera de Gazelas 2016', 'Programa de incentivos', '2016-02-01', '2016-12-31', NULL, 1, 20, '2016-03-03 11:00:40', 64),
(65, 1, 21, 13, 'A LA FIJA 2016', 'Catalogo de  recargas', '2016-02-01', '2016-11-30', NULL, 1, 15, '2016-03-31 12:45:25', 65),
(66, 1, 45, 13, 'Preferidos', 'Catalogo de Preferidos Asesores y Directivos de venta', '2016-01-01', '2016-12-31', NULL, 0, 20, '2016-04-11 07:30:17', 66),
(67, 1, 46, 13, 'Socios Nutresa Consumo Local', '', '2016-07-01', '2016-12-31', NULL, 1, 30, '2016-04-28 16:15:06', 67),
(68, 1, 47, 13, 'Merial', 'Catalogo para clínicas veterinarias y pets shops', '2016-07-01', '2016-12-31', NULL, 0, 15, '2016-06-17 12:10:47', 68),
(69, 1, 48, 13, 'Preferidos - Prabyc 2016', 'Catálogo para redención de puntos para Referidos y Clientes.', '2016-08-01', '2017-01-31', NULL, 1, 20, '2016-06-09 16:24:34', 69),
(70, 1, 48, 13, 'Cazadores', 'programa dirigido a vendedores.', '2016-07-01', '2017-02-28', NULL, 1, 15, '2016-06-28 15:19:55', 70),
(71, 1, 17, 13, 'Tu esfuerzo vale 2016', 'No hay catalogo porque el plan paga por total pass\r\n solo es para hacer solicitudes de cotización, compra, despachos.', '2015-10-01', '2016-12-31', NULL, 1, 20, '2016-06-13 08:02:29', 71),
(72, 1, 29, 13, 'Expedicion totto 2016 - 2017', 'Catalo', '2016-04-01', '2017-03-31', NULL, 1, 15, '2016-06-14 09:20:33', 72),
(73, 1, 24, 14, 'Socios Nutresa Minimercados Pereira', 'Catalogo de redención', '2016-04-01', '2016-12-31', NULL, 1, 25, '2016-06-29 10:54:13', 73),
(74, 1, 31, 13, 'Socios Nutresa Tiendas 2016 - 2017', 'Catalogo redención de estrellas', '2016-07-01', '2017-12-30', NULL, 1, 15, '2016-07-21 09:57:08', 74),
(75, 1, 34, 13, 'Fuerza Elite', 'Catalogo redención de puntos.', '2016-07-01', '2017-06-01', NULL, 1, 20, '2016-07-27 12:52:18', 75),
(76, 1, 19, 14, 'Milla Extra', 'Es el programa de incentivos que te llevará exitosamente por un mar de  ventas. Durante esta gran travesía tendrás divertidas actividades abordo,  donde involucrarás y compartirás una experiencia única con tu familia.', '2016-08-01', '2017-02-28', NULL, 1, 4, '2016-08-16 11:11:35', 76);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
