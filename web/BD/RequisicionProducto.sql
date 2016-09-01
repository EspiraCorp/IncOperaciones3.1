-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2016 at 02:23 AM
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
-- Dumping data for table `RequisicionProducto`
--

INSERT INTO `RequisicionProducto` (`id`, `producto_id`, `requisicion_id`, `usuario_id`, `cantidad`, `valorunidad`, `incremento`, `valortotal`, `logistica`, `fechaModificacion`, `facturaProducto_id`, `estado_id`) VALUES
(1, 10231, 1, NULL, 1, 700000, 30, 1000000, 0, NULL, NULL, NULL),
(2, 10778, 2, NULL, 10, 5000000, 0, 50000000, 616800, NULL, NULL, NULL);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
