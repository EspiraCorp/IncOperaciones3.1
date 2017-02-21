-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-08-2016 a las 02:07:33
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
-- Volcado de datos para la tabla `Requisicionesenvios`
--

INSERT INTO `Requisicionesenvios` (`id`, `ciudad_id`, `usuario_id`, `nombre`, `documento`, `ciudadNombre`, `direccion`, `barrio`, `telefono`, `celular`, `departamentoNombre`, `nombreContacto`, `documentoContacto`, `ciudadContacto`, `direccionContacto`, `barrioContacto`, `telefonoContacto`, `celularContacto`, `departamentoContacto`, `observaciones`, `fechaModificacion`) VALUES
(2, NULL, NULL, 'RAFAEL MUNAR', '', 'MEDELLIN', 'Cra 79 a # 53b- 92 apto 401 Edificio Hero, Barrio los Colores Medellin.', '', '', '3182111673', 'antioquia', '', '', '', '', '', '', '', '', 'PLANILLA 3438', NULL),
(3, NULL, NULL, 'RAFAEL MUNAR', '', 'MEDELLIN', 'Cra 79 a # 53b- 92 apto 401 Edificio Hero, Barrio los Colores Medellin.', '', '', '3182111673', 'ANTIOQUIA', '', '', '', '', '', '', '', '', 'PLANILLA 3438', NULL),
(4, NULL, NULL, 'Carolina Gonzalez/Fredy Castillo', 'N/A', 'Bogota', 'Carrera 65B No.11-40', 'ZONA INDUSTRIAL', '3118335435', '3118335435', 'Cundinamarca', 'Carolina Gonzalez/Fredy Castillo', 'N/A', 'BOGOTA', 'Carrera 65B No.11-40', 'ZONA INDUSTRIAL', '3118335435', '3118335435', 'CUNDINAMARCA', 'Planilla 3411', NULL),
(5, NULL, NULL, 'JOHANA LEON/ ELECTO MORENO', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL),
(6, NULL, NULL, 'JOHANA LEON/ ELECTO MORENO', '', 'BOGOTA', 'Marcas y distribuciones CLL 22 A NO 97 - 22 FONTIBON', '', '3182111404/ 3175788355 electo moreno', '3182111404/ 3175788355 electo moreno', 'cundinamarca', 'LUZ MARINA DAZA CRUZ', '', '', '', '', '', '', '', '', NULL),
(7, NULL, NULL, 'Katherine Pulido', 'N/A', 'CALI', 'Calle 64norte # 5b-146 Centro Empresa oficina 43', 'N/A', '3213278645', '3213278645', 'VALLE DEL CAUCA', 'Oscar Javier Casallas', 'N/A', '', '', '', '', '', '', '', NULL),
(8, NULL, NULL, 'Katherine Pulido', 'N/A', 'CALI', 'Calle 64norte # 5b-146 Centro Empresa oficina 43', 'N/A', '3213278645', '3213278645', 'VALLE DEL CAUCA', 'Oscar Javier Casallas', 'N/A', 'CALI', 'Calle 64norte # 5b-146 Centro Empresa oficina 43', 'N/A', '3213278645', '3213278645', 'VALLE DEL CAUCA', '', NULL),
(9, NULL, NULL, 'Leiner Ortiz', 'N/A', 'MEDELLIN', 'Calle 79 sur#52a-45 Interior 2 ', 'San Agustin-La estrella', '3223459875', '3223459875', 'ANTIOQUIA', 'Leiner Ortiz', 'N/A', 'MEDELLIN', 'Calle 79 sur#52a-45 Interior 2 ', 'San Agustin-La estrella', '3223459875', '3223459875', 'ANTIOQUIA', '', NULL),
(10, NULL, NULL, 'Rene Hernandez', 'N/A', 'BARRANQUILLA', 'Calle 111 # 6-335 Bodega Pic 0 Parque Internacional de Caribe', 'Junto a Metroparque', '3158549533', '3158549533', 'ATLANTICO', 'Rene Hernandez', 'N/A', 'BARRANQUILLA', 'Calle 111 # 6-335 Bodega Pic 0 Parque Internacional de Caribe', 'Junto a Metroparque', '3158549533', '3158549533', 'ATLANTICO', '', NULL),
(11, NULL, NULL, 'Diego Leon', 'N/A', 'BOGOTA', 'Calle 18 # 69-75 Zona Industrial', 'Montevideo', '3112903727', '3112903727', 'CUNDINAMARCA', 'Diego Leon', 'N/A', 'BOGOTA', 'Calle 18 # 69-75 Zona Industrial', 'Montevideo', '3112903727', '3112903727', 'CUNDINAMARCA', '', NULL),
(12, NULL, NULL, 'Hector Villegas', 'N/A', 'DOSQUEBRADAS', 'Autopista la Romelia El Pollo Centro Logistico Eje cafetero Bodega 48', '', '3128382589', '3128382589', 'RISARALDA', 'Hector Villegas', 'N/A', 'DOSQUEBRADAS', 'Autopista la Romelia El Pollo Centro Logistico Eje cafetero Bodega 48', 'N/A', '3128382589', '3128382589', 'RISARALDA', '', NULL),
(13, NULL, NULL, 'Oscar Javier Casallas', 'N/A', 'CALI', 'Calle 64norte # 5b-146 Centro Empresa oficina 43', 'N/A', '3213278645', '3213278645', 'VALLE DEL CAUCA', 'Oscar Javier Casallas', 'N/A', 'CALI', 'Calle 64norte # 5b-146 Centro Empresa oficina 43', 'N/A', '3213278645', '3213278645', 'V', '', NULL),
(14, NULL, NULL, 'Leiner Ortiz', 'N/A', 'MEDELLIN', 'Calle 79 sur#52a-45 Interior 2 ', 'San Agustin-La estrella', '3223459875', '3223459875', 'ANTIOQUIA', 'Leiner Ortiz', 'N/A', 'MEDELLIN', 'Calle 79 sur#52a-45 Interior 2 ', 'San Agustin-La estrella', '3223459875', '3223459875', 'ANTIOQUIA', '', NULL);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
