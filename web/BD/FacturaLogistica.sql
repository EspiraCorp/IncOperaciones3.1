-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2016 at 05:01 AM
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
-- Dumping data for table `FacturaLogistica`
--

INSERT INTO `FacturaLogistica` (`id`, `factura_id`, `usuario_id`, `cantidad`, `descripcion`, `valorUnitario`, `valorTotal`, `fechaModificacion`) VALUES
(1, 59, NULL, 1, 'Guia 84758573', 2000, 2000, NULL),
(2, 59, NULL, 1, 'Guia 9585859', 1000, 1000, NULL),
(3, 59, NULL, 1, 'Guia 65781232', 5000, 5000, NULL),
(4, 62, NULL, 1, 'Guia 543986', 10000, 10000, NULL),
(5, 62, NULL, 1, 'Guia 192039', 10000, 10000, NULL),
(6, 62, NULL, 1, 'Guia 11111', 20000, 20000, NULL),
(7, 63, NULL, 1, 'Guia 2345', 9900, 9900, NULL),
(8, 63, NULL, 1, 'Guia 2345', 9900, 9900, NULL),
(9, 63, NULL, 1, 'Guia 2345', 9900, 9900, NULL),
(10, 63, NULL, 1, 'Guia 2345', 9900, 9900, NULL),
(11, 63, NULL, 1, 'Guia 24689', 13579, 13579, NULL),
(12, 63, NULL, 1, 'Guia 24689', 234560, 234560, NULL),
(13, 63, NULL, 1, 'Guia 24689', 9900, 9900, NULL),
(14, 63, NULL, 1, 'Guia 24689', 9900, 9900, NULL),
(15, 63, NULL, 1, 'Guia 24689', 9900, 9900, NULL),
(16, 63, NULL, 1, 'Guia 24689', 9900, 9900, NULL),
(17, 229, NULL, 1, 'Solicitud 73', 571510, 571510, NULL),
(18, 229, NULL, 1, 'Solicitud 76', 571510, 571510, NULL),
(19, 229, NULL, 1, 'Solicitud 77', 244209, 244209, NULL),
(20, 231, NULL, 1, 'Solicitud 100', 164000, 164000, NULL),
(21, 231, NULL, 1, 'Solicitud 125', 45000, 45000, NULL),
(22, 231, NULL, 1, 'Solicitud 155', 89499, 89499, NULL),
(23, 231, NULL, 1, 'Solicitud 156', 89499, 89499, NULL),
(24, 231, NULL, 1, 'Solicitud 157', 97154, 97154, NULL),
(25, 233, NULL, 1, 'Solicitud 140', 1579115, 1579115, NULL),
(26, 233, NULL, 1, 'Solicitud 141', 1794449, 1794449, NULL),
(27, 252, NULL, 1, 'Cotización 23', 112000, 112000, NULL),
(28, 254, NULL, 1, 'Cotización 61', 414655, 414655, NULL),
(29, 254, NULL, 1, 'Cotización 149', 36000, 36000, NULL),
(30, 254, NULL, 1, 'Cotización 150', 28350, 28350, NULL),
(31, 255, NULL, 1, 'Cotización 158', 43756, 43756, NULL),
(32, 256, NULL, 1, 'Cotización 53', 30000, 30000, NULL),
(33, 256, NULL, 1, 'Cotización 58', 60000, 60000, NULL),
(34, 256, NULL, 1, 'Cotización 69', 340000, 340000, NULL),
(35, 256, NULL, 1, 'Cotización 120', 43756, 43756, NULL),
(36, 256, NULL, 1, 'Cotización 186', 897500, 897500, NULL),
(37, 256, NULL, 1, 'Cotización 187', 876000, 876000, NULL),
(38, 258, NULL, 1, 'Cotización 25', 1153040, 1153040, NULL),
(39, 259, NULL, 1, 'Cotización 47', 157000, 157000, NULL),
(40, 263, NULL, 1, 'Cotización 159', 43756, 43756, NULL),
(41, 263, NULL, 1, 'Cotización 160', 248302, 248302, NULL),
(42, 265, NULL, 1, 'Cotización 11', 68000, 68000, NULL),
(43, 265, NULL, 1, 'Cotización 202', 80120, 80120, NULL),
(44, 265, NULL, 1, 'Cotización 205', 91483, 91483, NULL),
(45, 266, NULL, 1, 'Cotización 27', 648483, 648483, NULL),
(46, 266, NULL, 1, 'Cotización 35', 38700, 38700, NULL),
(47, 266, NULL, 1, 'Cotización 46', 80000, 80000, NULL),
(48, 266, NULL, 1, 'Cotización 48', 684700, 684700, NULL),
(49, 270, NULL, 1, 'Cotización 131', 15655, 15655, NULL),
(50, 272, NULL, 1, 'Cotización 147', 215000, 215000, NULL),
(51, 273, NULL, 1, 'Cotización 17', 26711, 26711, NULL),
(52, 297, NULL, 1, 'Cotización 210', 90233, 90233, NULL),
(53, 297, NULL, 1, 'Cotización 223', 41150, 41150, NULL),
(54, 332, NULL, 1, 'Cotización 258', 39722, 39722, NULL),
(55, 332, NULL, 1, 'Cotización 259', 90233, 90233, NULL),
(56, 324, NULL, 3, 'BODEGAJE (3 ESTIBAS)', 39800, 119400, NULL),
(57, 323, NULL, 3, 'BODEGAJE (3 ESTIBAS)', 39800, 119400, NULL);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
