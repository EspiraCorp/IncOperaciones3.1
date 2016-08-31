-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-08-2016 a las 04:45:51
-- Versión del servidor: 5.5.47-0ubuntu0.14.04.1
-- Versión de PHP: 7.0.5-2+deb.sury.org~trusty+1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `operaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Aeconomica`
--

CREATE TABLE `Aeconomica` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Aeconomica`
--

INSERT INTO `Aeconomica` (`id`, `proveedor_id`, `usuario_id`, `codigo`, `fechaModificacion`) VALUES
(1, 358, NULL, 14, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Aeconomica_audit`
--

CREATE TABLE `Aeconomica_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Archivos`
--

CREATE TABLE `Archivos` (
  `id` int(11) NOT NULL,
  `tipoarchivo_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Archivos_audit`
--

CREATE TABLE `Archivos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `tipoarchivo_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Areas`
--

CREATE TABLE `Areas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Areas`
--

INSERT INTO `Areas` (`id`, `usuario_id`, `nombre`, `descripcion`, `fechaModificacion`) VALUES
(1, NULL, 'DiseÃ±o', '', NULL),
(2, NULL, 'Tecnologia', '', NULL),
(3, NULL, 'Comunicacion', '', NULL),
(4, NULL, 'Operaciones', '', NULL),
(5, NULL, 'Costos Adicionales', '', NULL),
(6, NULL, 'Otros Costos', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Areas_audit`
--

CREATE TABLE `Areas_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Atributosproducto`
--

CREATE TABLE `Atributosproducto` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Atributosproducto_audit`
--

CREATE TABLE `Atributosproducto_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Atributostipo`
--

CREATE TABLE `Atributostipo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Atributostipo`
--

INSERT INTO `Atributostipo` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Talla', NULL),
(2, NULL, 'Color', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Atributostipo_audit`
--

CREATE TABLE `Atributostipo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Catalogo`
--

CREATE TABLE `Catalogo` (
  `id` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha` date DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Catalogo`
--

INSERT INTO `Catalogo` (`id`, `estado_id`, `proveedor_id`, `usuario_id`, `archivo`, `ruta`, `descripcion`, `fecha`, `fechaModificacion`) VALUES
(1, 1, 359, NULL, 'Prueba manuel2015-05-30.pdf', '/web/Proveedores/90983789/Catalogos/', 'mgdgsd', '2015-05-30', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Catalogos`
--

CREATE TABLE `Catalogos` (
  `id` int(11) NOT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `valorPunto` double DEFAULT NULL,
  `puntosMaximos` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Catalogos_audit`
--

CREATE TABLE `Catalogos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `valorPunto` double DEFAULT NULL,
  `puntosMaximos` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatalogoTipo`
--

CREATE TABLE `CatalogoTipo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `CatalogoTipo`
--

INSERT INTO `CatalogoTipo` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Lineal', NULL),
(2, NULL, 'Intervalos', NULL),
(3, NULL, 'Manual', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatalogoTipo_audit`
--

CREATE TABLE `CatalogoTipo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Catalogo_audit`
--

CREATE TABLE `Catalogo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha` date DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categoria`
--

CREATE TABLE `Categoria` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abreviatura` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Categoria`
--

INSERT INTO `Categoria` (`id`, `usuario_id`, `nombre`, `abreviatura`, `fechaModificacion`) VALUES
(1, NULL, 'DEPORTES', 'DEP', NULL),
(2, NULL, 'ELECTROMENORES', 'ELE', NULL),
(3, NULL, 'AUDIO Y VIDEO', 'AUD', NULL),
(4, NULL, 'LINEA BLANCA', 'LIN', NULL),
(5, NULL, 'HOGAR', 'HOG', NULL),
(6, NULL, 'HERRAMIENTAS', 'HER', NULL),
(7, NULL, 'PERSONAL', 'PER', NULL),
(8, NULL, 'MUEBLES ', 'MUE', NULL),
(9, NULL, 'JUGUETES', 'JUG', NULL),
(10, NULL, 'BONOS', 'BON', NULL),
(11, NULL, 'NIÑOS Y BEBES', 'NIN', NULL),
(12, NULL, 'ENTRETENIMIENTO', 'ENT', NULL),
(13, NULL, 'TECNOLOGIA', 'TEC', NULL),
(14, NULL, 'VIAJES', 'VIA', NULL),
(15, NULL, 'MASCOTAS', 'MAS', NULL),
(16, NULL, 'ELLAS', 'ELA', NULL),
(17, NULL, 'ELLOS', 'ELO', NULL),
(18, NULL, 'LIBROS', 'LIB', NULL),
(19, NULL, 'MOTOS', 'MOT', NULL),
(20, NULL, 'PROMOCIONALES', 'PRO', NULL),
(21, NULL, 'INSTITUCIONAL', 'INS', NULL),
(22, NULL, 'PRODUCTOS INTERNACIONALES', 'INT', NULL),
(23, NULL, 'EXPERIENCIAS', 'EXP', NULL),
(24, NULL, 'INVESTIGACIÓN', 'INV', NULL),
(25, NULL, 'ESTUDIO CLIENTES', 'CLI', NULL),
(26, NULL, 'ESTUDIO COMPETIDORES', 'ECO', NULL),
(27, NULL, 'ESTUDIO INTERNO', 'EIN', NULL),
(28, NULL, 'AVENTURA', 'AVE', NULL),
(29, NULL, 'INFANTILES', 'INF', NULL),
(30, NULL, 'BELLEZA Y SALUD', 'BEL', NULL),
(31, NULL, 'ELECTRODOMESTICOS', 'ELD', NULL),
(32, NULL, 'ELECTRONICOS', 'ELT', NULL),
(33, NULL, 'NUTRESA', 'NUT', NULL),
(34, NULL, 'DISEÑO', 'DIS', NULL),
(35, NULL, 'OFERTAS EXCLUSIVAS', 'OFE', NULL),
(36, NULL, 'NAVIDAD', 'NAV', NULL),
(37, 1, 'PROMOCIONES', 'PRM', '2015-10-28 00:00:00'),
(38, NULL, 'LOGISTICA', 'LOG', NULL),
(39, NULL, 'ESCOLAR', 'ESC', NULL),
(40, NULL, 'PREMIOS PARA EL NEGOCIO', 'PPE', NULL),
(41, NULL, 'BONOS DE SERVICIOS PUBLICOS', 'BSP', NULL),
(42, NULL, 'PREMIOS COLECCIONABLES HOGAR', 'PCH', NULL),
(43, NULL, 'ASISTENCIAS', 'ASI', NULL),
(44, NULL, 'MES DE LA MADRE', 'MAD', NULL),
(45, NULL, 'MES DEL PADRE', 'PAD', NULL),
(46, NULL, 'GIFT CARDS', 'GFC', NULL),
(47, NULL, 'CONOCE A TU COMPRADOR', 'CTC', NULL),
(48, NULL, 'ADELANTATE A LA COMPETENCIA', 'ALC', NULL),
(49, NULL, 'CONOCE A TU EQUIPO', 'CTE', NULL),
(50, NULL, 'EVALUA TU EXHIBICION', 'ETE', NULL),
(51, NULL, 'FORMA TU EQUIPO', 'FTE', NULL),
(52, NULL, 'CONOCE A TU CLIENTE', 'CCL', NULL),
(53, NULL, 'AMOR Y AMISTAD', 'AYM', NULL),
(54, NULL, 'MIDE TU SERVICIO AL CLIENTE', 'MSC', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categoria_audit`
--

CREATE TABLE `Categoria_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abreviatura` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CentroCostos`
--

CREATE TABLE `CentroCostos` (
  `id` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `centrocostos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CentroCostos_audit`
--

CREATE TABLE `CentroCostos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `centrocostos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CierreEstado`
--

CREATE TABLE `CierreEstado` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `CierreEstado`
--

INSERT INTO `CierreEstado` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Despachado', NULL),
(2, NULL, 'Entregado', NULL),
(3, NULL, 'Novedad', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CierreEstado_audit`
--

CREATE TABLE `CierreEstado_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ciudad`
--

CREATE TABLE `Ciudad` (
  `id` int(11) NOT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dane` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poligono` longtext COLLATE utf8_unicode_ci,
  `zoom` int(11) DEFAULT NULL,
  `principal` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ciudad_audit`
--

CREATE TABLE `Ciudad_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dane` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poligono` longtext COLLATE utf8_unicode_ci,
  `zoom` int(11) DEFAULT NULL,
  `principal` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cliente`
--

CREATE TABLE `Cliente` (
  `id` int(11) NOT NULL,
  `tipodocumento_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numero_documento` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Cliente`
--

INSERT INTO `Cliente` (`id`, `tipodocumento_id`, `estado_id`, `usuario_id`, `nombre`, `numero_documento`, `direccion`, `telefono`, `correo`, `fechaModificacion`) VALUES
(1, 3, 1, NULL, 'INCTECH', '888888888', 'TEST', 'TEST', 'TEST', NULL),
(4, 3, 1, NULL, 'Terpel', '12345678', 'Calle 86A', '7293451', 'prueba@prueba.com', NULL),
(9, 3, 1, NULL, 'Terpel', '830095213 – 0', 'carrera  7-75 51 bogota', '2439400', 'operaciones2@imc.com', NULL),
(10, 3, 1, NULL, 'Boehringer', '860.000.753 – 8', 'Carrera 11 N° 84 – 09 piso 5', 'gustavo vila: 320 452 5767', 'gustavo.vila@boehringer-ingelheim.com', NULL),
(14, 3, 1, NULL, 'Brinsa', '800-221-789-2', 'km 6 via cajica-zipaquira', '3355060', 'Isabel.Ospina@brinsa.com.co', NULL),
(15, 3, 1, NULL, 'CONSORCIO EXPRESS', '900.365.740-3', 'Calle 32 sur # 3c - 08', '3134617354', 'diego.caballero@consorcioexpress.co', NULL),
(16, 3, 1, NULL, 'Kelloggs', '890900535', 'Calle 17 # 68 – 95 Bogotá (Colombia)', '425 1240 Ext: 2691', 'Daniel.Gonzalez-Giraldo@kellogg.com', NULL),
(17, 3, 1, NULL, 'Directv', '900106364-7', 'Calle 98 A # 69 C Esquina Barrio Morato', '6529800', 'hugfonb@directvla.com.co', NULL),
(18, 3, 1, NULL, 'ALQUERIA', '860.004922-4', 'avenida boyaca No. 152B- 62 piso 4', '4119200', 'aruiz@alqueria.com.co, nmejia@alqueria.com.co', NULL),
(19, 3, 1, NULL, 'MONDELEZ ', '8903006869', 'Carrera 4 N No. 64 - 10, , Cali - Valle del Cauca', '4310285', 'yolima.perez@mdlz.com', NULL),
(20, 3, 1, NULL, 'MARITZ MOTIVATION SOLUTIONS', '636.827.1665', '1400 South Highway Drive,Fenton, Missouri 63099, US', '+1 636 827 5512,+1 314 398 1497', 'Cindy.Mydlo@maritz.com', NULL),
(21, 3, 1, NULL, 'BEIERSDORF', '890305795', 'Cll 100 N° 19-54 piso 10', '3125304330', 'Andres.Barbosa@Beiersdorf.com', NULL),
(22, 3, 1, NULL, 'POSTOBON', '890903939-5', 'Carrera 52 # 47-72, Medellín, Antioquia  Piso 18', '(4) 576-53-43', 'jusuga@postobon.com.co', NULL),
(23, 3, 1, NULL, 'PEPSICO', '890.920.304 - 0', 'Calle 110 No. 9-25 P4', '5895111', 'jenny.almeida@pepsico.com,mariaalejandra.vargas@pepsico.com', NULL),
(24, 3, 1, NULL, 'Comercial Nutresa S.A.S', '900341086-0', 'CARRERA 65 B No. 11 - 40 - Zona industrial puente Aranda', '4173200', 'mmadridc@comercialnutresa.com.co', NULL),
(25, 3, 1, NULL, 'Colombiana KimberlyColpapel S.A.', '860 015 753 - 3', 'CR 11A #94-45 Piso 5 y 6  - OFs kimberly bogotá', '6 00 33 00', 'juan.d.mejia@kcc.com,Lyda.X.GarnicaL@kcc.com', NULL),
(26, 2, 1, NULL, 'QBE Seguros Colonial', '1791240014001', 'Av. Eloy Alfaro N40-270 y José Queri', '(593) 3989800', 'fpachacama@inc-group.co', NULL),
(27, 3, 1, NULL, 'Casaluker S.A', '890800718-1', 'Calle 13 #68 - 98', '4473700/8756400', 'amolano@casaluker.com.co', NULL),
(28, 3, 1, NULL, 'HERO', '900723988-9', 'km 24 vía Santander de Quilichao Zona Franca Parque Sur, Lote 6 – Villa Rica, Cauca', '3006862643', 'marcela.munoz@hmclcolombia.com', NULL),
(29, 3, 1, NULL, 'NALSANI TOTTO', '800020706-9', 'Cra. 43A Nº 20-C-55', '3444660ext5800', 'doris.veloza@totto.com', NULL),
(30, 3, 1, NULL, 'Aerovias & continente americano (Avianca)', '890100577-6', 'Av calle 26 # 59 15', '5877700 ext 2716', 'daniela.lopez@avianca.com', NULL),
(31, 3, 1, NULL, 'Comercial Nutresa S.A.S TD', '900.341.086-0', 'Carrera 52 No. 20 - 124', '574 402 80 00', 'csinisterra@comercialnutresa.com.co', NULL),
(32, 3, 1, NULL, 'Incentivate', '830133132-6', 'Carrera 69 # 75 -63', '6054071', 'recursoshumanos@inc-group.co', NULL),
(33, 3, 1, NULL, 'INCENTIVES', '830133132-6', 'CARRERA69# 75 63', '6054071', 'LFERRO@INC-GROUP.CO', NULL),
(34, 3, 1, NULL, 'McCain', '800208785', 'Calle 49 sur # 72 C - 30', '7247700', 'lralvarez@mccain.com.co', NULL),
(35, 3, 1, NULL, 'Kelloggs 2016', '890900535', 'Calle 17 # 68 – 95 Bogotá (Colombia)', '425 1240 Ext: 2691', 'Daniel.Gonzalez-Giraldo@kellogg.com', NULL),
(36, 3, 1, NULL, 'BEIERSDORF 2016', 'NIT 890305795', 'Cll 100 N° 19-54 piso 10', '3125304330', 'Andres.Barbosa@Beiersdorf.com', NULL),
(37, 3, 1, NULL, 'Internacionales', '31250723651', 'Carrera 69 # 75 -63', '3208661612', NULL, NULL),
(38, 1, 1, NULL, 'Claudia Juliana Gaitán Valencia', '1130604247', 'tranversal 56# 104b-33', '3183997446', 'cjgaitan@comercialnutresa.com.co', NULL),
(39, 3, 1, NULL, 'SANOFI AVENTIS', '830010337-0', 'tranversal 23 # 97-73', '6214400', 'GUILLERMO.LENIS@SANOFI.COM', NULL),
(40, 3, 1, NULL, 'Sanofi', '830010337-0', 'trv 23 # 97 -73 Piso 9', '6214400  Ext. 4094', 'Guillermo.Lenis@sanofi.com', NULL),
(41, 3, 1, NULL, 'Allus 2016', 'NIT 900106364-7', 'Centro Empresarial Puerto Seco. Calle 8 B 65-261', '315 3588718', 'hugfonb@directvla.com.co', NULL),
(42, 3, 1, NULL, 'MEAD JOHNSON', '9002453413', 'CALLE 76 11 - 17  P3', '3188272741', 'lilian.bonilla.bonilla@mjn.com', NULL),
(43, 3, 1, NULL, 'Copec', '99520000-7', 'calle agustinas 1382 Piso 2', '(56-2) 2690 7000', 'nbalbontin@copec.cl', NULL),
(44, 3, 1, NULL, 'Pepsico Alimentos ', '890920304-0', 'calle 110 # 9', '', 'jenny.almeida@pepsico.com', NULL),
(45, 3, 1, NULL, 'Onest Negocios de Capital SAS', '800080575-0', 'Carrera 11 # 94', '7424266', NULL, NULL),
(46, 3, 1, NULL, 'Comercial Nutresa Consumo Local ', '900.341.086-0', 'Cra 52 #20-124 Av. Guayabal (Medellin)', '', 'jerojas@comercialnutresa.com.co', NULL),
(47, 3, 1, NULL, 'GENFAR S.A', '817001644-1', 'calle 20a # 44-70', '3133337867', 'francia.galvez@sanofi.com', NULL),
(48, 3, 1, NULL, 'PRABYC INGENIEROS SAS', '800173155 - 7', 'Carrera 16 No .93A-36 Of. 704', '644 5720 / 3102861389', 'malopez@prabyc.com.co', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cliente_audit`
--

CREATE TABLE `Cliente_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `tipodocumento_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_documento` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Contacto`
--

CREATE TABLE `Contacto` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombres` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `movil` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Contacto_audit`
--

CREATE TABLE `Contacto_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombres` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `movil` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Convocatorias`
--

CREATE TABLE `Convocatorias` (
  `id` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Convocatorias`
--

INSERT INTO `Convocatorias` (`id`, `estado_id`, `solicitud_id`, `usuario_id`, `titulo`, `descripcion`, `ruta`, `archivo`, `fechaInicio`, `fechaFin`, `fechaModificacion`) VALUES
(1, 1, NULL, NULL, 'prueba', 'prueba', '/web/Archivos/Convocatorias/', 'Clipboard01.jpg', '2014-04-01', '2014-04-01', NULL),
(2, 1, 8, NULL, 'lanzamiento  postobon', 'material  pop para cngreso', '/web/Archivos/Convocatorias/', 'CENTROS DE COSTOS.xlsx', '2015-11-24', '2015-11-27', NULL),
(3, 1, 10, NULL, 'prueba', 'sfafdsa', '/web/Archivos/Convocatorias/', '20151118 - Estatus Nutresa Autoservicios 001 Ola dos.xlsx', '2015-12-02', '2016-01-07', NULL),
(4, 1, 10, NULL, 'Compra Relojes Digitales', '2700 relojes digitales con logo', '/web/Archivos/Convocatorias/', 'Reloj Digital Socios.jpg', '2015-12-02', '2015-12-07', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ConvocatoriasArchivos`
--

CREATE TABLE `ConvocatoriasArchivos` (
  `id` int(11) NOT NULL,
  `convocatoria_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ConvocatoriasArchivos_audit`
--

CREATE TABLE `ConvocatoriasArchivos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `convocatoria_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ConvocatoriasEstado`
--

CREATE TABLE `ConvocatoriasEstado` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ConvocatoriasEstado`
--

INSERT INTO `ConvocatoriasEstado` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Abierta', NULL),
(2, NULL, 'Cerrada', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ConvocatoriasEstado_audit`
--

CREATE TABLE `ConvocatoriasEstado_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ConvocatoriasHistorico`
--

CREATE TABLE `ConvocatoriasHistorico` (
  `id` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `convocatoria_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ConvocatoriasProveedores`
--

CREATE TABLE `ConvocatoriasProveedores` (
  `id` int(11) NOT NULL,
  `convocatoria_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCarga` date DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seleccionado` smallint(6) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ConvocatoriasProveedores`
--

INSERT INTO `ConvocatoriasProveedores` (`id`, `convocatoria_id`, `proveedor_id`, `usuario_id`, `ruta`, `archivo`, `fechaCarga`, `observacion`, `seleccionado`, `fechaModificacion`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 4, 385, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 4, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 4, 384, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 4, 326, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ConvocatoriasProveedores_audit`
--

CREATE TABLE `ConvocatoriasProveedores_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `convocatoria_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCarga` date DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seleccionado` smallint(6) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Convocatorias_audit`
--

CREATE TABLE `Convocatorias_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CostosLogistica`
--

CREATE TABLE `CostosLogistica` (
  `id` int(11) NOT NULL,
  `planilla_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valorUnitario` double DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `valorTotal` double DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `facturaLogistica_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CostosLogistica_audit`
--

CREATE TABLE `CostosLogistica_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `planilla_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valorUnitario` double DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `valorTotal` double DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `facturaLogistica_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cotizacion`
--

CREATE TABLE `Cotizacion` (
  `id` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `consecutivo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rutapdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `fechaVencimiento` date DEFAULT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci,
  `condiciones` longtext COLLATE utf8_unicode_ci,
  `logistica` bigint(20) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `facturaLogistica_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CotizacionesEstado`
--

CREATE TABLE `CotizacionesEstado` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `CotizacionesEstado`
--

INSERT INTO `CotizacionesEstado` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Abierta', NULL),
(2, NULL, 'Enviada', NULL),
(3, NULL, 'En Aprobacion', NULL),
(4, NULL, 'Aprobada', NULL),
(5, NULL, 'Cancelada', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CotizacionesEstado_audit`
--

CREATE TABLE `CotizacionesEstado_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CotizacionProducto`
--

CREATE TABLE `CotizacionProducto` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cotizacion_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `valorunidad` bigint(20) DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `valortotal` bigint(20) DEFAULT NULL,
  `logistica` bigint(20) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `facturaProducto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CotizacionProducto_audit`
--

CREATE TABLE `CotizacionProducto_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cotizacion_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `valorunidad` bigint(20) DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `valortotal` bigint(20) DEFAULT NULL,
  `logistica` bigint(20) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `facturaProducto_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cotizacion_audit`
--

CREATE TABLE `Cotizacion_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `consecutivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rutapdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `fechaVencimiento` date DEFAULT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci,
  `condiciones` longtext COLLATE utf8_unicode_ci,
  `logistica` bigint(20) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `facturaLogistica_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Courier`
--

CREATE TABLE `Courier` (
  `id` int(11) NOT NULL,
  `tipodocumento_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Courier_audit`
--

CREATE TABLE `Courier_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `tipodocumento_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Departamento`
--

CREATE TABLE `Departamento` (
  `id` int(11) NOT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poligono` longtext COLLATE utf8_unicode_ci,
  `zoom` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Departamento`
--

INSERT INTO `Departamento` (`id`, `pais_id`, `usuario_id`, `nombre`, `latitud`, `longitud`, `poligono`, `zoom`, `fechaModificacion`) VALUES
(2, 1, NULL, 'Antioquia', '6.91042', '-75.5917', '8.212361000000101,-76.9248579999999;8.212361000000101,-76.92652800000001;8.212083000000011,-76.92652800000001;8.212085,-76.92680399999991;8.211528999999979,-76.92680399999991;8.211528999999979,-76.927087;8.210695000000101,-76.927087;8.210695000000101,-76.92680399999991;8.209860000000109,-76.92680399999991;8.209862999999981,-76.92652800000001;8.209029000000101,-76.92652800000001;8.209029000000101,-76.92624599999991;8.208472000000031,-76.92624599999991;8.208472000000031,-76.925696;8.208194000000111,-76.925696;8.208194000000111,-76.925416;8.208472000000031,-76.925416;8.208472000000031,-76.9243079999999;8.208194000000111,-76.9243079999999;8.208194000000111,-76.92375199999999;8.20791600000001,-76.92375199999999;8.20791600000001,-76.9234699999999;8.20763800000015,-76.9234699999999;8.20764100000002,-76.92292000000001;8.207360000000049,-76.92292000000001;8.207360000000049,-76.922364;8.20680400000003,-76.922364;8.20680400000003,-76.922082;8.206528000000111,-76.922082;8.206528000000111,-76.92152299999989;8.20680400000003,-76.92152299999989;8.20680400000003,-76.92125;8.207084000000121,-76.92125;8.207084000000121,-76.92069099999991;8.207360000000049,-76.92069099999991;8.207360000000049,-76.920418;8.20764100000002,-76.920418;8.20763800000015,-76.919862;8.20791600000001,-76.919862;8.20791600000001,-76.9193029999999;8.208194000000111,-76.9193029999999;8.208194000000111,-76.9187469999999;8.208472000000031,-76.9187469999999;8.208472000000031,-76.918198;8.20875100000001,-76.918198;8.20875100000001,-76.91791499999989;8.209029000000101,-76.91791499999989;8.209029000000101,-76.91763999999991;8.20958200000001,-76.91763999999991;8.20958200000001,-76.91735899999991;8.210973000000021,-76.91735899999991;8.210973000000021,-76.917084;8.21180500000008,-76.917084;8.21180500000008,-76.91735899999991;8.212085,-76.91735899999991;8.212085,-76.918198;8.21180500000008,-76.918198;8.21180500000008,-76.9187469999999;8.211528999999979,-76.9187469999999;8.211528999999979,-76.92125;8.21125100000012,-76.92125;8.21125100000012,-76.92292000000001;8.211528999999979,-76.92292000000001;8.211528999999979,-76.92375199999999;8.21180500000008,-76.92375199999999;8.21180500000008,-76.924584;8.212085,-76.924584;8.212083000000011,-76.9248579999999;8.212361000000101,-76.9248579999999;8.85819500000008,-76.42319499999989;8.85819500000008,-76.42347099999991;8.85791700000004,-76.42347099999991;8.857918999999979,-76.423751;8.85763900000012,-76.423751;8.85763900000012,-76.4240269999999;8.857361000000029,-76.4240269999999;8.857361000000029,-76.42430899999989;8.857083000000101,-76.42430899999989;8.857083000000101,-76.424583;8.856807,-76.424583;8.856807,-76.4248589999999;8.856526000000031,-76.4248589999999;8.856526000000031,-76.4251409999999;8.856251000000039,-76.4251409999999;8.856251000000039,-76.425415;8.85597300000012,-76.425415;8.85597300000012,-76.425697;8.855695000000029,-76.425697;8.855695000000029,-76.426529;8.855417000000101,-76.426529;8.855417000000101,-76.42708500000001;8.855138000000119,-76.42708500000001;8.855141,-76.42791699999999;8.854585000000039,-76.42791699999999;8.854585000000039,-76.4284729999999;8.854029000000031,-76.4284729999999;8.854029000000031,-76.428749;8.85375000000005,-76.428749;8.85375000000005,-76.4293049999999;8.853472000000121,-76.4293049999999;8.853472000000121,-76.43042;8.85291599999994,-76.43042;8.85291599999994,-76.430695;8.85263800000001,-76.430695;8.85263800000001,-76.43096899999991;8.85236000000015,-76.43096899999991;8.85236000000015,-76.431252;8.852082000000051,-76.431252;8.852082000000051,-76.4318079999999;8.851806000000121,-76.4318079999999;8.851806000000121,-76.43208300000001;8.85152800000003,-76.43208300000001;8.85152800000003,-76.4323569999999;8.85124999999994,-76.4323569999999;8.85124999999994,-76.43263999999991;8.850972000000009,-76.43263999999991;8.850972000000009,-76.43319799999991;8.85069400000015,-76.43319799999991;8.85069400000015,-76.4343029999999;8.850416000000051,-76.4343029999999;8.850416000000051,-76.434586;8.850138000000131,-76.434586;8.850138000000131,-76.435418;8.84986200000003,-76.435418;8.84986200000003,-76.43569099999991;8.84958399999994,-76.43569099999991;8.84958399999994,-76.4359739999999;8.849306000000009,-76.4359739999999;8.849306000000009,-76.437079;8.84902800000015,-76.437079;8.84902800000015,-76.43736199999999;8.848750000000051,-76.43736199999999;8.848750000000051,-76.43763799999989;8.848472000000131,-76.43763799999989;8.848472000000131,-76.43792000000001;8.84819400000004,-76.43792000000001;8.84819400000004,-76.4384469999999;8.84819400000004,-76.43875199999999;8.847915999999939,-76.43875199999999;8.847915999999939,-76.4389349999999;8.847915999999939,-76.4393079999999;8.847640000000011,-76.4393079999999;8.847640000000011,-76.439582;8.84736200000015,-76.439582;8.84736200000015,-76.4401399999999;8.84708400000005,-76.4401399999999;8.84708400000005,-76.4406959999999;8.846806000000131,-76.4406959999999;8.846806000000131,-76.4409719999999;8.84652800000003,-76.4409719999999;8.84652800000003,-76.44152799999991;8.846249999999941,-76.44152799999991;8.846249999999941,-76.44242199999989;8.846249999999941,-76.4426429999999;8.846143000000151,-76.4426429999999;8.845972000000071,-76.4426429999999;8.845972000000071,-76.443001;8.845974000000011,-76.44347499999991;8.845694000000149,-76.44347499999991;8.845694000000149,-76.44358199999991;8.845694000000149,-76.443748;8.84541800000005,-76.443748;8.84541800000005,-76.4440309999999;8.84513800000013,-76.4440309999999;8.84513800000013,-76.4443059999999;8.844862000000029,-76.4443059999999;8.844862000000029,-76.44532100000001;8.844862000000029,-76.4454189999999;8.844583999999941,-76.4454189999999;8.844583999999941,-76.44596799999989;8.844306000000071,-76.44596799999989;8.844306000000071,-76.44652599999991;8.844028000000151,-76.44652599999991;8.844028000000151,-76.44706699999991;8.844028000000151,-76.44736499999991;8.84388600000011,-76.44736499999991;8.84375000000006,-76.44736499999991;8.84375200000005,-76.4476389999999;8.84347200000013,-76.4476389999999;8.84347200000013,-76.44819699999989;8.84319400000004,-76.44819699999989;8.843196000000029,-76.4484699999999;8.84291500000006,-76.4484699999999;8.84291500000006,-76.4487529999999;8.84264000000007,-76.4487529999999;8.84264000000007,-76.4490289999999;8.842362000000151,-76.4490289999999;8.842362000000151,-76.4495849999999;8.84208400000006,-76.4495849999999;8.84208400000006,-76.4498609999999;8.84180600000013,-76.4498609999999;8.84180600000013,-76.4501409999999;8.841527000000159,-76.4501409999999;8.841530000000031,-76.451249;8.84124900000006,-76.451249;8.84124900000006,-76.45208100000001;8.84097099999997,-76.45208100000001;8.84097400000007,-76.4523609999999;8.840693000000041,-76.4523609999999;8.840693000000041,-76.4531929999999;8.84041800000006,-76.4531929999999;8.84041800000006,-76.4537509999999;8.840139000000081,-76.4537509999999;8.840139000000081,-76.4540249999999;8.839861000000161,-76.4540249999999;8.839861000000161,-76.4551389999999;8.83958300000006,-76.4551389999999;8.83958300000006,-76.45597099999991;8.839304999999969,-76.45597099999991;8.83930800000007,-76.4565269999999;8.839027000000041,-76.4565269999999;8.839027000000041,-76.45680299999989;8.838749000000011,-76.45680299999989;8.838750999999951,-76.4570859999999;8.83847300000008,-76.4570859999999;8.83847300000008,-76.4573589999999;8.838195000000161,-76.4573589999999;8.838195000000161,-76.45764200000001;8.83791700000006,-76.45764200000001;8.83791700000006,-76.4584739999999;8.837638999999969,-76.4584739999999;8.837638999999969,-76.4593049999999;8.83736100000004,-76.4593049999999;8.83736100000004,-76.4595879999999;8.837083000000011,-76.4595879999999;8.83708499999995,-76.46069299999991;8.83680500000008,-76.46069299999991;8.83680500000008,-76.46124999999989;8.83652700000016,-76.46124999999989;8.83652900000016,-76.4615249999999;8.836251000000059,-76.4615249999999;8.836251000000059,-76.46180800000001;8.835970999999971,-76.46180800000001;8.835970999999971,-76.4629129999999;8.83569500000004,-76.4629129999999;8.83569500000004,-76.463196;8.83541700000001,-76.463196;8.83541700000001,-76.4634689999999;8.83486300000015,-76.4634689999999;8.83486300000015,-76.464028;8.83458300000007,-76.464028;8.83458300000007,-76.4645839999999;8.83430499999997,-76.4645839999999;8.834306999999971,-76.46541599999991;8.83402900000004,-76.46541599999991;8.83402900000004,-76.46597199999999;8.83374900000001,-76.46597199999999;8.83375100000001,-76.4664299999999;8.83374900000001,-76.46653000000001;8.83347300000008,-76.46653000000001;8.83347300000008,-76.4668039999999;8.83319500000016,-76.4668039999999;8.83319500000016,-76.46736199999999;8.832917000000069,-76.46736199999999;8.832917000000069,-76.467772;8.832917000000069,-76.4679179999999;8.832361000000111,-76.4679179999999;8.832361000000111,-76.468474;8.83208300000001,-76.468474;8.83208300000001,-76.46910799999991;8.83208300000001,-76.4695819999999;8.83180500000009,-76.4695819999999;8.83180500000009,-76.47013800000001;8.831526999999991,-76.47013800000001;8.831526999999991,-76.47041399999991;8.831251000000069,-76.47041399999991;8.831251000000069,-76.470697;8.831098000000051,-76.470697;8.83097299999997,-76.470697;8.83097299999997,-76.47096999999999;8.830695000000111,-76.47096999999999;8.830695000000111,-76.4713439999999;8.830695000000111,-76.472358;8.83041700000001,-76.472358;8.83041700000001,-76.473473;8.83013900000009,-76.473473;8.83013900000009,-76.474029;8.82986099999999,-76.474029;8.82986099999999,-76.474304;8.829583000000071,-76.474304;8.829583000000071,-76.4745869999999;8.82930699999997,-76.4745869999999;8.82930699999997,-76.47513600000001;8.82902900000011,-76.47513600000001;8.82902900000011,-76.4754189999999;8.828751000000009,-76.4754189999999;8.828751000000009,-76.47597499999991;8.82847300000009,-76.47597499999991;8.82847300000009,-76.476524;8.82819499999999,-76.476524;8.82819499999999,-76.4770799999999;8.82791600000002,-76.4770799999999;8.827919000000071,-76.477363;8.827638000000089,-76.477363;8.827638000000089,-76.477639;8.827360000000001,-76.477639;8.8273630000001,-76.4779119999999;8.827085000000009,-76.4779119999999;8.827085000000009,-76.4787509999999;8.82680400000004,-76.4787509999999;8.826807000000089,-76.47985900000001;8.82652800000011,-76.47985900000001;8.82652800000011,-76.4801409999999;8.82625000000002,-76.4801409999999;8.82625000000002,-76.48041499999989;8.82486200000011,-76.48041499999989;8.82486200000011,-76.48069699999991;8.824306000000091,-76.48069699999991;8.824306000000091,-76.4812469999999;8.824028,-76.4812469999999;8.824028,-76.481803;8.82375000000008,-76.481803;8.82375000000008,-76.4820849999999;8.82208400000007,-76.4820849999999;8.82208400000007,-76.482361;8.82180600000004,-76.482361;8.82180600000004,-76.482635;8.821528000000111,-76.482635;8.821528000000111,-76.4829169999999;8.821179000000029,-76.4829169999999;8.820972000000101,-76.4829169999999;8.820972000000101,-76.483193;8.820694,-76.483193;8.820694,-76.4834759999999;8.82041600000014,-76.4834759999999;8.82041600000014,-76.48369699999991;8.82041600000014,-76.48458099999991;8.820138000000039,-76.48458099999991;8.820140000000039,-76.4848639999999;8.819862000000111,-76.4848639999999;8.819862000000111,-76.485137;8.81958400000002,-76.485137;8.81958400000002,-76.48541999999991;8.819306000000101,-76.48541999999991;8.819306000000101,-76.48569599999991;8.819027999999999,-76.48569599999991;8.819027999999999,-76.48625199999989;8.81875000000014,-76.48625199999989;8.81875000000014,-76.4868079999999;8.818472000000041,-76.4868079999999;8.818472000000041,-76.4870839999999;8.81791800000002,-76.4870839999999;8.81791800000002,-76.487357;8.817361999999999,-76.487357;8.817361999999999,-76.4876399999999;8.81717899999995,-76.4876399999999;8.816806000000041,-76.4876399999999;8.816806000000041,-76.4879149999999;8.816528000000121,-76.4879149999999;8.816528000000121,-76.4881979999999;8.81625000000003,-76.4881979999999;8.81625000000003,-76.4884719999999;8.8159720000001,-76.4884719999999;8.8159720000001,-76.4890299999999;8.815696000000001,-76.4890299999999;8.815696000000001,-76.48930300000001;8.81541500000003,-76.48930300000001;8.81541500000003,-76.4895859999999;8.81514000000004,-76.4895859999999;8.81514000000004,-76.490691;8.814862000000121,-76.490691;8.814862000000121,-76.49124999999989;8.81458400000002,-76.49124999999989;8.81458600000002,-76.4918059999999;8.814305000000051,-76.4918059999999;8.814305000000051,-76.4920819999999;8.81402700000012,-76.4920819999999;8.814030000000001,-76.4926379999999;8.81347400000004,-76.4926379999999;8.81347400000004,-76.4931939999999;8.813193000000069,-76.4931939999999;8.813193000000069,-76.4937519999999;8.812917000000141,-76.4937519999999;8.812917000000141,-76.494308;8.812639000000051,-76.494308;8.812639000000051,-76.49485799999989;8.81236100000012,-76.49485799999989;8.81236100000012,-76.4954139999999;8.81208300000003,-76.4954139999999;8.81208300000003,-76.4959719999999;8.811804999999939,-76.4959719999999;8.811804999999939,-76.4965279999999;8.811527000000069,-76.4965279999999;8.811527000000069,-76.4968039999999;8.811249000000149,-76.4968039999999;8.811251000000141,-76.497643;8.81097100000005,-76.497643;8.81097100000005,-76.4990309999999;8.81041700000003,-76.4990309999999;8.81041700000003,-76.499307;8.810138999999941,-76.499307;8.810138999999941,-76.49986299999991;8.809861000000071,-76.49986299999991;8.809861000000071,-76.50013799999989;8.809583000000149,-76.50013799999989;8.809583000000149,-76.50069499999989;8.80930500000005,-76.50069499999989;8.80930500000005,-76.501251;8.80902700000013,-76.501251;8.80902700000013,-76.50180899999999;8.808751000000029,-76.50180899999999;8.808751000000029,-76.5023579999999;8.808472999999941,-76.5023579999999;8.808472999999941,-76.502639;8.808195000000071,-76.502639;8.808195000000071,-76.50334100000001;8.808195000000071,-76.503753;8.807917000000151,-76.503753;8.807917000000151,-76.5043019999999;8.80763900000005,-76.5043019999999;8.80763900000005,-76.50486099999991;8.80736100000013,-76.50486099999991;8.80736100000013,-76.505141;8.807083000000031,-76.505141;8.807083000000031,-76.50541699999999;8.80680499999994,-76.50541699999999;8.80680499999994,-76.5056899999999;8.80652900000007,-76.5056899999999;8.80652900000007,-76.506249;8.80624900000015,-76.506249;8.80624900000015,-76.50819299999991;8.80597300000005,-76.50819299999991;8.80597300000005,-76.50846899999991;8.80569500000013,-76.50846899999991;8.80569500000013,-76.508751;8.80513899999994,-76.508751;8.80513899999994,-76.5090249999999;8.80486100000007,-76.5090249999999;8.80486300000007,-76.50958300000001;8.80458300000015,-76.50958300000001;8.80458300000015,-76.510139;8.804307000000049,-76.510139;8.804307000000049,-76.5106949999999;8.804026999999961,-76.5106949999999;8.804026999999961,-76.510971;8.80375100000003,-76.510971;8.80375100000003,-76.51125399999999;8.80347299999994,-76.51125399999999;8.80347299999994,-76.5115269999999;8.80236099999996,-76.5115269999999;8.80236099999996,-76.511803;8.80208200000015,-76.511803;8.80208500000003,-76.5115269999999;8.800973000000059,-76.5115269999999;8.800973000000059,-76.511803;8.80041900000003,-76.511803;8.80041900000003,-76.512086;8.79986300000007,-76.512086;8.79986300000007,-76.5123589999999;8.798750000000149,-76.5123589999999;8.798750000000149,-76.512642;8.798197000000069,-76.512642;8.798197000000069,-76.512918;8.79764,-76.512918;8.79764,-76.51319099999991;8.796806000000061,-76.51319099999991;8.796806000000061,-76.512918;8.7962500000001,-76.512918;8.7962500000001,-76.51319099999991;8.795416000000159,-76.51319099999991;8.795418000000151,-76.512918;8.79486199999997,-76.512918;8.79486199999997,-76.512642;8.794028000000081,-76.512642;8.794028000000081,-76.512918;8.793472000000071,-76.512918;8.793472000000071,-76.51319099999991;8.79319399999997,-76.51319099999991;8.79319399999997,-76.513474;8.792916000000099,-76.513474;8.792916000000099,-76.513604;8.792916000000099,-76.513747;8.792362000000081,-76.513747;8.792362000000081,-76.51430600000001;8.79041599999999,-76.51430600000001;8.790418000000161,-76.514579;8.789563000000101,-76.514579;8.789306000000011,-76.514579;8.789306000000011,-76.51430600000001;8.788471000000021,-76.51430600000001;8.788471000000021,-76.51402999999991;8.787362000000091,-76.51402999999991;8.787362000000091,-76.513747;8.785693000000039,-76.513747;8.785695000000031,-76.51402999999991;8.785139000000021,-76.51402999999991;8.785139000000021,-76.51430600000001;8.784583,-76.51430600000001;8.784583,-76.51402999999991;8.78430500000013,-76.51402999999991;8.78430500000013,-76.513747;8.784027000000041,-76.513747;8.784029000000031,-76.513474;8.782361000000041,-76.513474;8.782361000000041,-76.513747;8.78180700000001,-76.513747;8.78180700000001,-76.51430600000001;8.7815270000001,-76.51430600000001;8.7815270000001,-76.51486199999989;8.781249000000001,-76.51486199999989;8.781250999999999,-76.515137;8.780973000000129,-76.515137;8.780973000000129,-76.51541999999991;8.780695000000041,-76.51541999999991;8.780695000000041,-76.5156939999999;8.78041700000011,-76.5156939999999;8.78041700000011,-76.5159759999999;8.78013900000002,-76.5159759999999;8.78013900000002,-76.5165249999999;8.7798610000001,-76.5165249999999;8.7798610000001,-76.5168079999999;8.779583000000001,-76.5168079999999;8.779583000000001,-76.5173639999999;8.779305000000139,-76.5173639999999;8.779305000000139,-76.51764;8.77902900000004,-76.51764;8.77902900000004,-76.51791299999999;8.77875100000011,-76.51791299999999;8.77875100000011,-76.5181959999999;8.77847300000002,-76.5181959999999;8.77847300000002,-76.51875199999991;8.777917,-76.51875199999991;8.777917,-76.519301;8.77736300000004,-76.519301;8.77736300000004,-76.5198599999999;8.77708300000012,-76.5198599999999;8.77708300000012,-76.520416;8.776807000000019,-76.520416;8.776807000000019,-76.5206919999999;8.776527000000099,-76.5206919999999;8.776527000000099,-76.5215299999999;8.775973000000141,-76.5215299999999;8.775973000000141,-76.521804;8.77569500000004,-76.521804;8.77569500000004,-76.5220869999999;8.77541700000012,-76.5220869999999;8.77541700000012,-76.5223619999999;8.775139000000021,-76.5223619999999;8.775139000000021,-76.5231939999999;8.77486000000005,-76.5231939999999;8.77486000000005,-76.52347499999991;8.77458200000012,-76.52347499999991;8.774585,-76.5243059999999;8.774304000000029,-76.5243059999999;8.774304000000029,-76.52486499999991;8.77347200000014,-76.52486499999991;8.77347200000014,-76.5251379999999;8.77319400000005,-76.5251379999999;8.77319400000005,-76.52569699999989;8.772916000000119,-76.52569699999989;8.772919,-76.526802;8.772638000000031,-76.526802;8.772638000000031,-76.52735799999989;8.77208200000007,-76.52735799999989;8.77208200000007,-76.5276409999999;8.77180600000014,-76.5276409999999;8.77180600000014,-76.5279169999999;8.77152800000005,-76.5279169999999;8.77152800000005,-76.52847299999991;8.771250000000119,-76.52847299999991;8.771250000000119,-76.52958699999991;8.770972000000031,-76.52958699999991;8.770972000000031,-76.5301359999999;8.77069399999993,-76.5301359999999;8.770697000000039,-76.5306929999999;8.77041600000007,-76.5306929999999;8.77041600000007,-76.5309749999999;8.77013800000015,-76.5309749999999;8.77013800000015,-76.5312509999999;8.76986200000005,-76.5312509999999;8.76986200000005,-76.53152399999991;8.769584000000121,-76.53152399999991;8.769584000000121,-76.53208099999991;8.769306000000031,-76.53208099999991;8.769306000000031,-76.5326389999999;8.769027999999929,-76.5326389999999;8.769027999999929,-76.53319499999991;8.76875000000007,-76.53319499999991;8.76875000000007,-76.53375299999991;8.76847200000014,-76.53375299999991;8.76847200000014,-76.5343029999999;8.768194000000049,-76.5343029999999;8.768194000000049,-76.5345829999999;8.767915999999961,-76.5345829999999;8.767915999999961,-76.5348589999999;8.76764000000003,-76.5348589999999;8.76764000000003,-76.5354149999999;8.76736,-76.5354149999999;8.76736,-76.5362469999999;8.76708400000007,-76.5362469999999;8.76708400000007,-76.536529;8.766806000000139,-76.536529;8.766806000000139,-76.537086;8.766528000000051,-76.537086;8.766528000000051,-76.5378029999999;8.766528000000051,-76.53791699999989;8.76624999999996,-76.53791699999989;8.76624999999996,-76.53819299999989;8.76597200000003,-76.53819299999989;8.76597200000003,-76.5384759999999;8.765694,-76.5384759999999;8.765694,-76.5390249999999;8.76541800000007,-76.5390249999999;8.76541800000007,-76.53930799999991;8.76513800000015,-76.53930799999991;8.76513800000015,-76.53986399999999;8.764862000000051,-76.53986399999999;8.764862000000051,-76.5404129999999;8.76458399999996,-76.5404129999999;8.76458399999996,-76.540696;8.76430600000003,-76.540696;8.76430600000003,-76.541252;8.764028,-76.541252;8.764028,-76.54235900000001;8.763750000000069,-76.54235900000001;8.76375200000007,-76.54280799999989;8.76375200000007,-76.543198;8.763472000000149,-76.543198;8.763472000000149,-76.543312;8.763472000000149,-76.5434719999999;8.763194000000061,-76.5434719999999;8.76319600000005,-76.5438089999999;8.76319600000005,-76.54403000000001;8.76307300000002,-76.54403000000001;8.76291599999996,-76.54403000000001;8.76291599999996,-76.5443129999999;8.76291599999996,-76.544586;8.762765000000121,-76.544586;8.76264000000003,-76.544586;8.76264000000003,-76.544862;8.762362,-76.544862;8.762362,-76.5453109999999;8.762362,-76.545418;8.762084000000071,-76.545418;8.762084000000071,-76.54580799999989;8.762084000000071,-76.5459739999999;8.761992000000079,-76.5459739999999;8.761806000000149,-76.5459739999999;8.761806000000149,-76.5463109999999;8.761806000000149,-76.54652299999989;8.76168900000005,-76.54652299999989;8.761528000000061,-76.54652299999989;8.761528000000061,-76.5468129999999;8.76153000000005,-76.547082;8.76137899999998,-76.547082;8.761249000000079,-76.547082;8.761249000000079,-76.54736200000001;8.760971000000151,-76.54736200000001;8.760971000000151,-76.54781300000001;8.760974000000029,-76.54875199999999;8.76069300000006,-76.54875199999999;8.76069300000006,-76.54930899999989;8.760418000000071,-76.54930899999989;8.760418000000071,-76.549858;8.760140000000151,-76.549858;8.760140000000151,-76.550414;8.759861000000001,-76.550414;8.759861000000001,-76.550697;8.759583000000079,-76.550697;8.759583000000079,-76.55124599999991;8.75930500000015,-76.55124599999991;8.759308000000029,-76.55180399999991;8.75902700000006,-76.55180399999991;8.75902700000006,-76.5520869999999;8.75874899999997,-76.5520869999999;8.758752000000071,-76.552916;8.758473000000089,-76.552916;8.758473000000089,-76.55347499999991;8.758193000000009,-76.55347499999991;8.758195000000001,-76.553748;8.757917000000081,-76.553748;8.757917000000081,-76.55458;8.75763900000015,-76.55458;8.75763900000015,-76.554863;8.75736100000006,-76.554863;8.75736100000006,-76.556527;8.75708299999997,-76.556527;8.75708299999997,-76.55708300000001;8.756805000000099,-76.55708300000001;8.756805000000099,-76.55791499999999;8.756527000000011,-76.55791499999999;8.756529000000001,-76.55819700000001;8.756251000000081,-76.55819700000001;8.756251000000081,-76.5593029999999;8.75597099999999,-76.5593029999999;8.75597300000015,-76.559861;8.75569500000006,-76.559861;8.75569500000006,-76.5604169999999;8.755416999999969,-76.5604169999999;8.755418999999961,-76.56097299999991;8.755139000000099,-76.56097299999991;8.755139000000099,-76.56180499999989;8.754861000000011,-76.56180499999989;8.754863,-76.56236299999991;8.75458300000008,-76.56236299999991;8.75458300000008,-76.5634689999999;8.75430499999999,-76.5634689999999;8.75430700000015,-76.5645829999999;8.754027000000059,-76.5645829999999;8.754027000000059,-76.5651389999999;8.753749000000029,-76.5651389999999;8.753749000000029,-76.5656979999999;8.753473000000101,-76.5656979999999;8.753473000000101,-76.56597099999991;8.753195000000011,-76.56597099999991;8.753197,-76.56652699999999;8.75291700000008,-76.56652699999999;8.75291700000008,-76.56764200000001;8.75263899999999,-76.56764200000001;8.75263899999999,-76.568191;8.752361000000059,-76.568191;8.752361000000059,-76.5698619999999;8.752083000000029,-76.5698619999999;8.752084999999971,-76.5704199999999;8.7518050000001,-76.5704199999999;8.7518050000001,-76.57096899999991;8.75152700000001,-76.57096899999991;8.75152900000001,-76.571808;8.75125100000008,-76.571808;8.75125100000008,-76.5729139999999;8.75097299999999,-76.5729139999999;8.75097299999999,-76.5737519999999;8.750695000000061,-76.5737519999999;8.750695000000061,-76.5756919999999;8.750417000000031,-76.5756919999999;8.750417000000031,-76.575974;8.7501390000001,-76.575974;8.7501390000001,-76.576531;8.74986100000001,-76.576531;8.74986100000001,-76.5770799999999;8.74958300000009,-76.5770799999999;8.74958300000009,-76.5779189999999;8.749306999999989,-76.5779189999999;8.749306999999989,-76.579307;8.749029000000061,-76.579307;8.749029000000061,-76.5795819999999;8.748751000000031,-76.5795819999999;8.748751000000031,-76.581529;8.7484730000001,-76.581529;8.7484730000001,-76.581802;8.74819500000001,-76.581802;8.74819500000001,-76.58208500000001;8.74791700000009,-76.58208500000001;8.74791700000009,-76.582641;8.74763800000011,-76.582641;8.74763800000011,-76.5831899999999;8.747360000000009,-76.5831899999999;8.747360000000009,-76.584031;8.74708500000003,-76.584031;8.74708500000003,-76.5854189999999;8.746803999999999,-76.5854189999999;8.746803999999999,-76.58625099999991;8.74708500000003,-76.58625099999991;8.74708500000003,-76.5865249999999;8.746803999999999,-76.5865249999999;8.746803999999999,-76.587639;8.74652900000001,-76.587639;8.74652900000001,-76.5879129999999;8.74625000000003,-76.5879129999999;8.74625000000003,-76.588471;8.74597200000011,-76.588471;8.74597200000011,-76.5895849999999;8.745694000000009,-76.5895849999999;8.745694000000009,-76.5929179999999;8.745416000000089,-76.5929179999999;8.745416000000089,-76.593193;8.745138000000001,-76.593193;8.7451410000001,-76.593476;8.744860000000131,-76.593476;8.744860000000131,-76.5948639999999;8.74458200000004,-76.5948639999999;8.74458200000004,-76.5956959999999;8.74430600000011,-76.5956959999999;8.74430600000011,-76.59652799999991;8.744028000000011,-76.59652799999991;8.744028000000011,-76.599304;8.743750000000089,-76.599304;8.743750000000089,-76.5998619999999;8.743472000000001,-76.5998619999999;8.743472000000001,-76.60097399999999;8.743194000000131,-76.60097399999999;8.743194000000131,-76.60124999999989;8.74291600000004,-76.60124999999989;8.74291800000003,-76.602638;8.74263800000011,-76.602638;8.74263800000011,-76.6031939999999;8.742360000000019,-76.6031939999999;8.742362000000011,-76.60347;8.742084000000091,-76.60347;8.742084000000091,-76.60402599999991;8.741806,-76.60402599999991;8.741806,-76.6045839999999;8.742084000000091,-76.6045839999999;8.742084000000091,-76.60597199999999;8.741806,-76.60597199999999;8.741806,-76.6073599999999;8.74152800000013,-76.6073599999999;8.74152800000013,-76.607919;8.74125000000004,-76.607919;8.74125000000004,-76.6081919999999;8.740694000000021,-76.6081919999999;8.740694000000021,-76.6084749999999;8.740163000000001,-76.6084749999999;8.73986200000013,-76.6084749999999;8.73986200000013,-76.60874799999991;8.738750000000101,-76.60874799999991;8.738750000000101,-76.60902399999991;8.73819400000014,-76.60902399999991;8.73819400000014,-76.6093069999999;8.73791800000004,-76.6093069999999;8.73791800000004,-76.6101389999999;8.73763800000012,-76.6101389999999;8.73763800000012,-76.61069499999989;8.737362000000021,-76.61069499999989;8.737362000000021,-76.6115269999999;8.737084000000101,-76.6115269999999;8.737084000000101,-76.6126409999999;8.73680600000006,-76.6126409999999;8.73680600000006,-76.6137469999999;8.73652800000013,-76.6137469999999;8.73652800000013,-76.61430299999989;8.736250000000039,-76.61430299999989;8.736252000000039,-76.61486099999991;8.735972000000119,-76.61486099999991;8.735972000000119,-76.61569299999989;8.73569600000002,-76.61569299999989;8.73569600000002,-76.6168049999999;8.735415000000049,-76.6168049999999;8.735415000000049,-76.618752;8.73514000000006,-76.618752;8.73514000000006,-76.619308;8.734862000000129,-76.619308;8.734862000000129,-76.62041499999999;8.734584000000041,-76.62041499999999;8.734584000000041,-76.6218029999999;8.734306000000119,-76.6218029999999;8.734306000000119,-76.6223589999999;8.73402700000014,-76.6223589999999;8.73402700000014,-76.62375;8.733749000000049,-76.62375;8.733749000000049,-76.62542000000001;8.73347099999995,-76.62542000000001;8.73347400000006,-76.626526;8.73319300000003,-76.626526;8.73319300000003,-76.6276399999999;8.732918000000041,-76.6276399999999;8.732918000000041,-76.6281959999999;8.732639000000059,-76.6281959999999;8.732639000000059,-76.628755;8.73236100000014,-76.628755;8.73236100000014,-76.630416;8.732083000000051,-76.630416;8.732083000000051,-76.6315309999999;8.73180499999995,-76.6315309999999;8.73180800000006,-76.63208;8.730695000000139,-76.63208;8.730695000000139,-76.6318059999999;8.730142000000059,-76.6318059999999;8.730142000000059,-76.6315309999999;8.72986100000003,-76.6315309999999;8.72986100000003,-76.62958399999999;8.729582999999989,-76.62958399999999;8.729582999999989,-76.62902799999991;8.729305000000069,-76.62902799999991;8.729305000000069,-76.628472;8.729027000000141,-76.628472;8.729027000000141,-76.6281959999999;8.728751000000051,-76.6281959999999;8.728751000000051,-76.627914;8.72819500000003,-76.627914;8.72819500000003,-76.6276399999999;8.72652900000003,-76.6276399999999;8.72652900000003,-76.627914;8.726248999999999,-76.627914;8.726248999999999,-76.6276399999999;8.72541700000005,-76.6276399999999;8.72541700000005,-76.627914;8.72486100000009,-76.627914;8.72486100000009,-76.6276399999999;8.72430500000007,-76.6276399999999;8.72430500000007,-76.6273579999999;8.723472999999959,-76.6273579999999;8.723472999999959,-76.6276399999999;8.723195000000089,-76.6276399999999;8.723195000000089,-76.627914;8.722917000000001,-76.627914;8.722917000000001,-76.6281959999999;8.72263900000007,-76.6281959999999;8.722641000000071,-76.628472;8.721804000000081,-76.628472;8.721804000000081,-76.628755;8.721251000000001,-76.628755;8.721251000000001,-76.62902799999991;8.720416,-76.62902799999991;8.720419000000049,-76.62930399999991;8.72013800000008,-76.62930399999991;8.72013800000008,-76.62958399999999;8.719585,-76.62958399999999;8.719585,-76.62985999999999;8.71902800000009,-76.62985999999999;8.71902800000009,-76.6301429999999;8.71875,-76.6301429999999;8.71875,-76.630416;8.71847200000008,-76.630416;8.71847200000008,-76.630692;8.718193999999979,-76.630692;8.718193999999979,-76.631248;8.717916000000059,-76.631248;8.717916000000059,-76.6315309999999;8.71763800000002,-76.6315309999999;8.71764100000007,-76.6318059999999;8.71736200000009,-76.6318059999999;8.71736200000009,-76.63263599999991;8.717082,-76.63263599999991;8.717084,-76.632919;8.716527999999981,-76.632919;8.716527999999981,-76.63263599999991;8.71597200000002,-76.63263599999991;8.71597200000002,-76.632919;8.715418,-76.632919;8.715418,-76.63346799999989;8.71513800000008,-76.63346799999989;8.71513800000008,-76.633751;8.714859999999989,-76.633751;8.714861999999981,-76.6343089999999;8.714584000000061,-76.6343089999999;8.714584000000061,-76.634582;8.71430600000002,-76.634582;8.71430799999996,-76.63486499999991;8.7140280000001,-76.63486499999991;8.7140280000001,-76.635414;8.713749999999999,-76.635414;8.713752,-76.63569699999989;8.713472000000079,-76.63569699999989;8.713472000000079,-76.6362529999999;8.713193999999991,-76.6362529999999;8.713193999999991,-76.637085;8.712916000000121,-76.637085;8.712916000000121,-76.6376409999999;8.71263800000003,-76.6376409999999;8.71263800000003,-76.63847299999991;8.7123620000001,-76.63847299999991;8.7123620000001,-76.638749;8.712084000000001,-76.638749;8.712084000000001,-76.639031;8.711806000000079,-76.639031;8.711806000000079,-76.63930499999989;8.711527999999991,-76.63930499999989;8.711527999999991,-76.6418069999999;8.71097400000002,-76.6418069999999;8.71097400000002,-76.6415249999999;8.710418000000001,-76.6415249999999;8.710418000000001,-76.6406929999999;8.710140000000081,-76.6406929999999;8.710140000000081,-76.63986299999991;8.710418000000001,-76.63986299999991;8.710418000000001,-76.639031;8.710140000000081,-76.639031;8.710140000000081,-76.63847299999991;8.70958400000012,-76.63847299999991;8.70958400000012,-76.637917;8.7090280000001,-76.637917;8.7090280000001,-76.6376409999999;8.708750000000011,-76.6376409999999;8.708750000000011,-76.6373609999999;8.708472000000089,-76.6373609999999;8.708472000000089,-76.637085;8.70764000000003,-76.637085;8.70764000000003,-76.636802;8.707362000000099,-76.636802;8.707362000000099,-76.637085;8.70652700000011,-76.637085;8.70652999999999,-76.636802;8.704861000000109,-76.636802;8.704861000000109,-76.6365289999999;8.70430500000009,-76.6365289999999;8.70430500000009,-76.6362529999999;8.70402700000005,-76.6362529999999;8.70402700000005,-76.6359699999999;8.70347100000004,-76.6359699999999;8.70347100000004,-76.63569699999989;8.70309700000001,-76.63569699999989;8.70291700000001,-76.63569699999989;8.70291700000001,-76.635414;8.70236100000005,-76.635414;8.70236100000005,-76.6351379999999;8.701527000000111,-76.6351379999999;8.701527000000111,-76.63486499999991;8.70041700000013,-76.63486499999991;8.70041700000013,-76.634582;8.69986100000011,-76.634582;8.69986100000011,-76.6343089999999;8.69930500000015,-76.6343089999999;8.69930500000015,-76.63402599999991;8.699029000000049,-76.63402599999991;8.699029000000049,-76.633751;8.698473000000041,-76.633751;8.698473000000041,-76.63346799999989;8.69819500000011,-76.63346799999989;8.69819500000011,-76.633751;8.69791700000002,-76.633751;8.69791700000002,-76.63346799999989;8.697083000000131,-76.63346799999989;8.697083000000131,-76.6331939999999;8.696807000000041,-76.6331939999999;8.696807000000041,-76.632919;8.69652699999995,-76.632919;8.69652699999995,-76.6331939999999;8.69597300000015,-76.6331939999999;8.69597300000015,-76.63346799999989;8.695417000000131,-76.63346799999989;8.695417000000131,-76.633751;8.69513900000004,-76.633751;8.69514100000004,-76.63402599999991;8.69458500000002,-76.63402599999991;8.69458500000002,-76.6343089999999;8.69180700000004,-76.6343089999999;8.69180700000004,-76.634582;8.69013799999999,-76.634582;8.690140000000159,-76.63486499999991;8.68986200000006,-76.63486499999991;8.68986200000006,-76.635414;8.68958400000014,-76.635414;8.68958400000014,-76.63569699999989;8.689306000000039,-76.63569699999989;8.689306000000039,-76.6359699999999;8.688750000000081,-76.6359699999999;8.688750000000081,-76.6362529999999;8.68847199999999,-76.6362529999999;8.68847199999999,-76.6365289999999;8.68819400000007,-76.6365289999999;8.68819400000007,-76.637085;8.68791600000014,-76.637085;8.68791600000014,-76.6373609999999;8.687640000000041,-76.6373609999999;8.687640000000041,-76.6376409999999;8.68708400000008,-76.6376409999999;8.68708400000008,-76.637917;8.68652800000007,-76.637917;8.68652800000007,-76.63818999999999;8.68625000000014,-76.63818999999999;8.68625000000014,-76.639031;8.685972000000049,-76.639031;8.685972000000049,-76.63930499999989;8.685693999999961,-76.63930499999989;8.685693999999961,-76.63958100000001;8.68513799999999,-76.63958100000001;8.68513799999999,-76.63986299999991;8.68486200000007,-76.63986299999991;8.68486200000007,-76.6401369999999;8.68458400000014,-76.6401369999999;8.68458400000014,-76.6404189999999;8.684306000000049,-76.6404189999999;8.684306000000049,-76.6406929999999;8.683750000000091,-76.6406929999999;8.683750000000091,-76.6409749999999;8.68319400000007,-76.6409749999999;8.68319400000007,-76.6412509999999;8.682915999999979,-76.6412509999999;8.682915999999979,-76.6415249999999;8.681528000000069,-76.6415249999999;8.68153000000007,-76.6418069999999;8.680974000000051,-76.6418069999999;8.680974000000051,-76.642366;8.68069599999995,-76.642366;8.68069599999995,-76.6426389999999;8.68041800000009,-76.6426389999999;8.68041800000009,-76.642915;8.679862000000069,-76.642915;8.679862000000069,-76.64319499999991;8.67930800000005,-76.64319499999991;8.67930800000005,-76.64347099999991;8.67902700000008,-76.64347099999991;8.67902700000008,-76.6437539999999;8.678473999999991,-76.6437539999999;8.678473999999991,-76.6440269999999;8.67819300000002,-76.6440269999999;8.678196000000071,-76.6437539999999;8.67791700000009,-76.6437539999999;8.67791700000009,-76.6440269999999;8.6775090000001,-76.6440269999999;8.677361000000079,-76.6440269999999;8.677361000000079,-76.644166;8.677361000000079,-76.6448589999999;8.676805000000121,-76.6448589999999;8.676805000000121,-76.64514199999989;8.67634500000003,-76.64514199999989;8.675971000000001,-76.64514199999989;8.675973000000001,-76.6454169999999;8.67541699999998,-76.6454169999999;8.67541699999998,-76.6456909999999;8.675139000000121,-76.6456909999999;8.675139000000121,-76.64653;8.674305,-76.64653;8.674307000000001,-76.6468049999999;8.674027000000081,-76.6468049999999;8.674027000000081,-76.6470879999999;8.67374899999999,-76.6470879999999;8.67375099999998,-76.6476369999999;8.67347300000012,-76.6476369999999;8.67347300000012,-76.648476;8.673195000000019,-76.648476;8.67319700000002,-76.6490249999999;8.672639,-76.6490249999999;8.672639,-76.64930799999991;8.67236100000008,-76.64930799999991;8.67236100000008,-76.6495809999999;8.67180500000012,-76.6495809999999;8.67180500000012,-76.64986399999999;8.67152700000003,-76.64986399999999;8.67152700000003,-76.651359;8.67152700000003,-76.651528;8.67140100000006,-76.651528;8.671251000000099,-76.651528;8.671251000000099,-76.65180099999991;8.670973,-76.65180099999991;8.670973,-76.6520839999999;8.670973,-76.652642;8.67069500000008,-76.652642;8.67069500000008,-76.653198;8.67041699999999,-76.653198;8.670418999999979,-76.65403000000001;8.67013900000012,-76.65403000000001;8.67013900000012,-76.65486199999999;8.669861000000029,-76.65486199999999;8.669861000000029,-76.6551359999999;8.67013900000012,-76.6551359999999;8.67013900000012,-76.6554179999999;8.669861000000029,-76.6554179999999;8.669861000000029,-76.655974;8.669307,-76.655974;8.669307,-76.6562499999999;8.66902700000009,-76.6562499999999;8.66902700000009,-76.65652399999991;8.66875099999999,-76.65652399999991;8.66875099999999,-76.656806;8.66847300000012,-76.656806;8.66847300000012,-76.657365;8.668195000000029,-76.657365;8.668195000000029,-76.65791399999991;8.667917000000101,-76.65791399999991;8.667917000000101,-76.658197;8.66763900000001,-76.658197;8.667641,-76.659026;8.667360000000031,-76.659026;8.667360000000031,-76.66069899999999;8.66708499999999,-76.66069899999999;8.66708499999999,-76.6612479999999;8.66680400000001,-76.6612479999999;8.66680400000001,-76.6620869999999;8.666529000000031,-76.6620869999999;8.666529000000031,-76.66236000000001;8.6662510000001,-76.66236000000001;8.6662510000001,-76.6629189999999;8.665972000000121,-76.6629189999999;8.665972000000121,-76.6645799999999;8.66569400000003,-76.6645799999999;8.66569400000003,-76.665139;8.665416000000111,-76.665139;8.665416000000111,-76.6654119999999;8.66513800000001,-76.6654119999999;8.66513800000001,-76.6662529999999;8.66486000000015,-76.6662529999999;8.66486000000015,-76.66708299999991;8.664582000000051,-76.66708299999991;8.664582000000051,-76.66735900000001;8.664306000000121,-76.66735900000001;8.664306000000121,-76.66791499999989;8.66402800000003,-76.66791499999989;8.66402800000003,-76.66930499999999;8.66375000000011,-76.66930499999999;8.66375000000011,-76.670135;8.663472000000009,-76.670135;8.663472000000009,-76.671525;8.66319400000015,-76.671525;8.66319400000015,-76.67208099999991;8.662916000000051,-76.67208099999991;8.662916000000051,-76.6723639999999;8.662638000000131,-76.6723639999999;8.662638000000131,-76.672637;8.662360000000041,-76.672637;8.662360000000041,-76.673469;8.66208400000011,-76.673469;8.66208400000011,-76.6751399999999;8.661806000000009,-76.6751399999999;8.661806000000009,-76.6756979999999;8.66152800000015,-76.6756979999999;8.66152800000015,-76.6765299999999;8.661250000000051,-76.6765299999999;8.661250000000051,-76.67680300000001;8.660972000000131,-76.67680300000001;8.660972000000131,-76.677359;8.66069400000004,-76.677359;8.66069400000004,-76.6784739999999;8.660415999999939,-76.6784739999999;8.660415999999939,-76.67903199999991;8.660140000000011,-76.67903199999991;8.660140000000011,-76.6793739999999;8.660140000000011,-76.6801379999999;8.66003500000005,-76.6801379999999;8.65986200000015,-76.6801379999999;8.65986200000015,-76.681405;8.65986200000015,-76.68152600000001;8.65958400000005,-76.68152600000001;8.65958400000005,-76.6820839999999;8.659306000000131,-76.6820839999999;8.659306000000131,-76.68263999999991;8.65902800000003,-76.68263999999991;8.65902800000003,-76.6834719999999;8.658474000000011,-76.6834719999999;8.658474000000011,-76.68458699999999;8.658194000000149,-76.68458699999999;8.658194000000149,-76.6854159999999;8.65791800000005,-76.6854159999999;8.65791800000005,-76.6865309999999;8.65763800000013,-76.6865309999999;8.65763800000013,-76.68736299999991;8.657362000000029,-76.68736299999991;8.657362000000029,-76.6887509999999;8.657083999999941,-76.6887509999999;8.657083999999941,-76.6895819999999;8.656806000000021,-76.6895819999999;8.656806000000021,-76.690141;8.656528000000151,-76.690141;8.656528000000151,-76.6918019999999;8.65625000000006,-76.6918019999999;8.65625200000005,-76.69291699999999;8.65597200000013,-76.69291699999999;8.65597200000013,-76.6940309999999;8.65569400000004,-76.6940309999999;8.655696000000029,-76.6948629999999;8.655415999999949,-76.6948629999999;8.655415999999949,-76.69577;8.655415999999949,-76.69596899999991;8.655140000000021,-76.69596899999991;8.655140000000021,-76.6966639999999;8.655140000000021,-76.697915;8.654862000000151,-76.697915;8.654862000000151,-76.69875399999999;8.65458400000006,-76.69875399999999;8.65458400000006,-76.70069099999991;8.65430600000013,-76.70069099999991;8.65430600000013,-76.70152999999991;8.654028000000039,-76.70152999999991;8.654030000000031,-76.7020789999999;8.65374900000006,-76.7020789999999;8.65374900000006,-76.703476;8.65347100000014,-76.703476;8.653474000000021,-76.7040249999999;8.653193000000041,-76.7040249999999;8.653193000000041,-76.70541299999999;8.65291800000006,-76.70541299999999;8.65291800000006,-76.70652799999991;8.65264000000013,-76.70652799999991;8.65264000000013,-76.7081919999999;8.652362000000039,-76.7081919999999;8.652362000000039,-76.7095859999999;8.65208300000006,-76.7095859999999;8.65208300000006,-76.71152599999991;8.65180500000014,-76.71152599999991;8.65180800000002,-76.712638;8.651527000000041,-76.712638;8.651527000000041,-76.7137529999999;8.65124899999995,-76.7137529999999;8.65125200000006,-76.7145849999999;8.65097100000008,-76.7145849999999;8.65097100000008,-76.71597299999991;8.650695000000161,-76.71597299999991;8.650695000000161,-76.7184749999999;8.65041700000006,-76.7184749999999;8.65041700000006,-76.7187509999999;8.65013900000014,-76.7187509999999;8.65013900000014,-76.7198629999999;8.64986100000004,-76.7198629999999;8.64986100000004,-76.72069499999991;8.64958299999995,-76.72069499999991;8.64958600000006,-76.72097099999991;8.64930500000008,-76.72097099999991;8.64930500000008,-76.72458499999991;8.64902700000016,-76.72458499999991;8.64902900000016,-76.72541699999989;8.648751000000059,-76.72541699999989;8.648751000000059,-76.7270809999999;8.648470999999971,-76.7270809999999;8.64847300000014,-76.7279129999999;8.64819500000004,-76.7279129999999;8.64819500000004,-76.7293099999999;8.64791699999995,-76.7293099999999;8.64791699999995,-76.72985899999991;8.64819500000004,-76.72985899999991;8.64819500000004,-76.73013999999991;8.64791699999995,-76.73013999999991;8.64791699999995,-76.7309719999999;8.64763900000008,-76.7309719999999;8.64763900000008,-76.73375;8.64736100000016,-76.73375;8.64736100000016,-76.7343059999999;8.64708300000007,-76.7343059999999;8.64708300000007,-76.734582;8.64680499999997,-76.734582;8.646807000000139,-76.734864;8.64652900000004,-76.734864;8.64652900000004,-76.73542000000001;8.64624900000001,-76.73542000000001;8.64624900000001,-76.7359699999999;8.64652900000004,-76.7359699999999;8.64652900000004,-76.737916;8.64624900000001,-76.737916;8.64625099999995,-76.73930399999991;8.64597300000008,-76.73930399999991;8.64597300000008,-76.74013599999989;8.64569500000016,-76.74013599999989;8.64569500000016,-76.740419;8.645417000000069,-76.740419;8.645417000000069,-76.740692;8.64513899999997,-76.740692;8.64513899999997,-76.741531;8.64486100000005,-76.741531;8.64486100000005,-76.74208;8.644694000000131,-76.74208;8.64458300000001,-76.74208;8.64458300000001,-76.7427299999999;8.64458300000001,-76.7434699999999;8.64445500000005,-76.7434699999999;8.64430500000009,-76.7434699999999;8.64430500000009,-76.74402600000001;8.644026999999991,-76.74402600000001;8.644026999999991,-76.74458300000001;8.643751000000069,-76.74458300000001;8.643751000000069,-76.74485799999999;8.64347299999997,-76.74485799999999;8.64347299999997,-76.7459709999999;8.643751000000069,-76.7459709999999;8.643751000000069,-76.7470849999999;8.64347299999997,-76.7470849999999;8.64347299999997,-76.7476429999999;8.64319500000005,-76.7476429999999;8.64319500000005,-76.747917;8.64291700000001,-76.747917;8.64291700000001,-76.748193;8.64263900000009,-76.748193;8.64263900000009,-76.748749;8.64236099999999,-76.748749;8.64236099999999,-76.74930499999989;8.642083000000071,-76.74930499999989;8.642083000000071,-76.74958100000001;8.64236099999999,-76.74958100000001;8.64236099999999,-76.75041899999989;8.642083000000071,-76.75041899999989;8.642083000000071,-76.7509689999999;8.64180499999998,-76.7509689999999;8.64180499999998,-76.7518069999999;8.64152900000005,-76.7518069999999;8.64152900000005,-76.7526389999999;8.641251000000009,-76.7526389999999;8.641251000000009,-76.75347099999991;8.64097300000009,-76.75347099999991;8.64097300000009,-76.75430299999989;8.64069499999999,-76.75430299999989;8.64069499999999,-76.754859;8.64041700000007,-76.754859;8.640419000000071,-76.75514199999991;8.640138000000089,-76.75514199999991;8.640138000000089,-76.7568059999999;8.639860000000001,-76.7568059999999;8.63986300000005,-76.7587519999999;8.639585000000009,-76.7587519999999;8.639585000000009,-76.7595819999999;8.63930399999998,-76.7595819999999;8.639307000000089,-76.7618039999999;8.63902899999999,-76.7618039999999;8.63902899999999,-76.7623599999999;8.63875100000007,-76.7623599999999;8.63875100000007,-76.7631919999999;8.63902899999999,-76.7631919999999;8.63902899999999,-76.763474;8.63875100000007,-76.763474;8.63875100000007,-76.76402999999991;8.638472000000091,-76.76402999999991;8.638472000000091,-76.76430600000001;8.638194,-76.76430600000001;8.638194,-76.7656939999999;8.637916000000081,-76.7656939999999;8.637916000000081,-76.7670819999999;8.63763799999998,-76.7670819999999;8.637641000000089,-76.768197;8.63736299999999,-76.768197;8.63736299999999,-76.7687529999999;8.637082000000021,-76.7687529999999;8.637084000000019,-76.76958499999991;8.636806000000091,-76.76958499999991;8.636806000000091,-76.77263600000001;8.636528,-76.77263600000001;8.636528,-76.7729189999999;8.63625000000008,-76.7729189999999;8.63625000000008,-76.77347500000001;8.635971999999979,-76.77347500000001;8.635971999999979,-76.7740239999999;8.63625000000008,-76.7740239999999;8.63625000000008,-76.77430699999999;8.635971999999979,-76.77430699999999;8.635971999999979,-76.775139;8.635694000000109,-76.775139;8.635694000000109,-76.7754119999999;8.635416000000021,-76.7754119999999;8.635418000000019,-76.7781979999999;8.635138000000101,-76.7781979999999;8.635138000000101,-76.7787469999999;8.63486,-76.7787469999999;8.634862,-76.780137;8.63458400000007,-76.780137;8.63458400000007,-76.780693;8.634305999999979,-76.780693;8.634305999999979,-76.781525;8.63458400000007,-76.781525;8.63458400000007,-76.78264;8.634305999999979,-76.78264;8.634305999999979,-76.7831959999999;8.634028000000111,-76.7831959999999;8.634028000000111,-76.78514199999999;8.633750000000021,-76.78514199999999;8.633750000000021,-76.78791799999991;8.633472000000101,-76.78791799999991;8.633472000000101,-76.78847399999999;8.633194,-76.78847399999999;8.633194,-76.7904139999999;8.63291600000008,-76.7904139999999;8.63291600000008,-76.7906939999999;8.632638000000039,-76.7906939999999;8.632639999999981,-76.7912519999999;8.632362000000111,-76.7912519999999;8.632362000000111,-76.794304;8.63208400000002,-76.794304;8.63208400000002,-76.795136;8.631806000000101,-76.795136;8.631806000000101,-76.79736299999991;8.631527999999999,-76.79736299999991;8.631527999999999,-76.7976389999999;8.63125000000008,-76.7976389999999;8.63125000000008,-76.797921;8.631527999999999,-76.797921;8.631527999999999,-76.7998579999999;8.63125000000008,-76.7998579999999;8.63125000000008,-76.8004149999999;8.631527999999999,-76.8004149999999;8.631527999999999,-76.80180300000001;8.63125000000008,-76.80180300000001;8.63125000000008,-76.80236099999991;8.630972000000041,-76.80236099999991;8.630972000000041,-76.80319299999989;8.630694000000121,-76.80319299999989;8.630694000000121,-76.8043049999999;8.63041800000002,-76.8043049999999;8.63041800000002,-76.80791499999999;8.6301400000001,-76.80791499999999;8.6301400000001,-76.8093029999999;8.63041800000002,-76.8093029999999;8.63041800000002,-76.809586;8.6301400000001,-76.809586;8.6301400000001,-76.81069099999991;8.629861999999999,-76.81069099999991;8.629861999999999,-76.8115319999999;8.6301400000001,-76.8115319999999;8.6301400000001,-76.81236199999999;8.629861999999999,-76.81236199999999;8.629861999999999,-76.81263799999989;8.629584000000079,-76.81263799999989;8.629584000000079,-76.8131939999999;8.629306000000041,-76.8131939999999;8.629306000000041,-76.8140259999999;8.629028000000121,-76.8140259999999;8.629028000000121,-76.814584;8.629306000000041,-76.814584;8.629306000000041,-76.81735999999999;8.629028000000121,-76.81735999999999;8.629028000000121,-76.8176429999999;8.629306000000041,-76.8176429999999;8.629306000000041,-76.81777199999991;8.629306000000041,-76.8181919999999;8.629028000000121,-76.8181919999999;8.629028000000121,-76.819306;8.62875000000003,-76.819306;8.62875000000003,-76.82152599999991;8.6284720000001,-76.82152599999991;8.6284720000001,-76.82236499999991;8.628196000000001,-76.82236499999991;8.628196000000001,-76.8251409999999;8.62791500000003,-76.8251409999999;8.62791500000003,-76.825417;8.62764000000004,-76.825417;8.62764000000004,-76.8276369999999;8.627362000000121,-76.8276369999999;8.627362000000121,-76.82791899999999;8.62764000000004,-76.82791899999999;8.62764000000004,-76.8284749999999;8.627362000000121,-76.8284749999999;8.627362000000121,-76.8293069999999;8.62708400000002,-76.8293069999999;8.62708400000002,-76.830415;8.627362000000121,-76.830415;8.627362000000121,-76.83069499999991;8.62708400000002,-76.83069499999991;8.62708400000002,-76.8323589999999;8.6268060000001,-76.8323589999999;8.6268060000001,-76.8331909999999;8.62708400000002,-76.8331909999999;8.62708400000002,-76.833747;8.6268060000001,-76.833747;8.6268060000001,-76.836249;8.62652700000012,-76.836249;8.626530000000001,-76.837913;8.62624900000003,-76.837913;8.62624900000003,-76.8387519999999;8.625970999999939,-76.8387519999999;8.625970999999939,-76.8395839999999;8.62624900000003,-76.8395839999999;8.62624900000003,-76.8401419999999;8.625970999999939,-76.8401419999999;8.62597400000004,-76.840698;8.625693000000011,-76.840698;8.625693000000011,-76.8443059999999;8.625418000000019,-76.8443059999999;8.625418000000019,-76.84625299999991;8.6251400000001,-76.84625299999991;8.6251400000001,-76.8479159999999;8.62486100000012,-76.8479159999999;8.62486100000012,-76.84819899999999;8.6251400000001,-76.84819899999999;8.6251400000001,-76.8484719999999;8.62486100000012,-76.8484719999999;8.62486100000012,-76.85125099999991;8.62458300000003,-76.85125099999991;8.62458300000003,-76.853471;8.624304999999939,-76.853471;8.624304999999939,-76.85485900000001;8.62458300000003,-76.85485900000001;8.62458300000003,-76.85569700000001;8.624304999999939,-76.85569700000001;8.624304999999939,-76.856529;8.624027000000011,-76.856529;8.624027000000011,-76.8576349999999;8.623749000000149,-76.8576349999999;8.623749000000149,-76.858749;8.624027000000011,-76.858749;8.624027000000011,-76.859864;8.623749000000149,-76.859864;8.623749000000149,-76.863747;8.62347100000005,-76.863747;8.62347100000005,-76.8645859999999;8.623749000000149,-76.8645859999999;8.623749000000149,-76.86624999999989;8.624027000000011,-76.86624999999989;8.624027000000011,-76.86653199999991;8.623749000000149,-76.86653199999991;8.623749000000149,-76.8676379999999;8.62347100000005,-76.8676379999999;8.62347100000005,-76.8712459999999;8.623749000000149,-76.8712459999999;8.623749000000149,-76.8715369999999;8.623749000000149,-76.872643;8.624027000000011,-76.872643;8.624027000000011,-76.8729159999999;8.623749000000149,-76.8729159999999;8.623749000000149,-76.87486299999991;8.62347100000005,-76.87486299999991;8.62347100000005,-76.8770819999999;8.623749000000149,-76.8770819999999;8.623749000000149,-76.87791399999991;8.62347100000005,-76.87791399999991;8.62347100000005,-76.8781969999999;8.623749000000149,-76.8781969999999;8.623749000000149,-76.87846999999989;8.62347100000005,-76.87846999999989;8.62347100000005,-76.8793019999999;8.623749000000149,-76.8793019999999;8.623749000000149,-76.8812489999999;8.62347100000005,-76.8812489999999;8.62347100000005,-76.881805;8.62319500000012,-76.881805;8.62319500000012,-76.8848659999999;8.62291700000003,-76.8848659999999;8.62291700000003,-76.8856949999999;8.62319500000012,-76.8856949999999;8.62319500000012,-76.885971;8.62291700000003,-76.885971;8.62291700000003,-76.8865269999999;8.622638999999941,-76.8865269999999;8.622638999999941,-76.886803;8.620417000000151,-76.886803;8.620417000000151,-76.8865269999999;8.61986100000013,-76.8865269999999;8.61986100000013,-76.88625399999999;8.61874900000015,-76.88625399999999;8.61874900000015,-76.8865269999999;8.61541700000015,-76.8865269999999;8.61541700000015,-76.886803;8.614583000000041,-76.886803;8.61458500000003,-76.887086;8.61402900000007,-76.887086;8.61402900000007,-76.8873589999999;8.61236300000007,-76.8873589999999;8.61236300000007,-76.887086;8.61041600000004,-76.887086;8.61041600000004,-76.8873589999999;8.60986200000008,-76.8873589999999;8.60986200000008,-76.887642;8.60902799999997,-76.887642;8.60902799999997,-76.887917;8.605138000000011,-76.887917;8.605140000000009,-76.887642;8.604584000000161,-76.887642;8.604584000000161,-76.8873589999999;8.604027999999969,-76.8873589999999;8.604027999999969,-76.887086;8.603472000000011,-76.887086;8.603472000000011,-76.886803;8.603194000000091,-76.886803;8.603194000000091,-76.8865269999999;8.60264000000006,-76.8865269999999;8.60264000000006,-76.88625399999999;8.601806000000011,-76.88625399999999;8.601806000000011,-76.8865269999999;8.60124999999999,-76.8865269999999;8.60124999999999,-76.886803;8.60097200000007,-76.886803;8.60097200000007,-76.887086;8.600695999999971,-76.887086;8.600695999999971,-76.8873589999999;8.60014000000001,-76.8873589999999;8.60014000000001,-76.887642;8.599862000000091,-76.887642;8.599862000000091,-76.887917;8.59930600000007,-76.887917;8.59930600000007,-76.887642;8.59902700000009,-76.887642;8.59902700000009,-76.887917;8.597083,-76.887917;8.597083,-76.88819099999991;8.59653000000009,-76.88819099999991;8.59653000000009,-76.888474;8.59624900000011,-76.888474;8.59624900000011,-76.8887469999999;8.595416999999999,-76.8887469999999;8.595416999999999,-76.88902999999991;8.594861000000041,-76.88902999999991;8.594861000000041,-76.88930499999999;8.59458300000011,-76.88930499999999;8.59458300000011,-76.8895789999999;8.5940270000001,-76.8895789999999;8.5940270000001,-76.88986199999989;8.593749000000001,-76.88986199999989;8.593750999999999,-76.890137;8.593195000000041,-76.890137;8.593195000000041,-76.8906929999999;8.59291700000011,-76.8906929999999;8.59291700000011,-76.890976;8.5923610000001,-76.890976;8.5923610000001,-76.89125;8.59152700000004,-76.89125;8.59152900000004,-76.8915249999999;8.59097300000002,-76.8915249999999;8.59097300000002,-76.89208100000001;8.5906950000001,-76.89208100000001;8.5906950000001,-76.8923639999999;8.590139000000139,-76.8923639999999;8.590139000000139,-76.89264;8.58986100000004,-76.89264;8.58986100000004,-76.89291299999989;8.58958300000012,-76.89291299999989;8.58958300000012,-76.89375199999991;8.589307000000019,-76.89375199999991;8.589307000000019,-76.89402799999991;8.588751,-76.89402799999991;8.588751,-76.894301;8.588473000000141,-76.894301;8.588473000000141,-76.894584;8.58791700000012,-76.894584;8.58791700000012,-76.8948599999999;8.587361000000101,-76.8948599999999;8.587361000000101,-76.89514200000001;8.58708200000012,-76.89514200000001;8.587085,-76.895416;8.58652900000004,-76.895416;8.58652900000004,-76.8956919999999;8.58625100000012,-76.8956919999999;8.58625100000012,-76.895974;8.585973000000021,-76.895974;8.585973000000021,-76.896248;8.585695000000101,-76.896248;8.585695000000101,-76.8965299999999;8.585138000000031,-76.8965299999999;8.585138000000031,-76.896804;8.58485999999994,-76.896804;8.584863000000039,-76.8970859999999;8.58458200000007,-76.8970859999999;8.58458200000007,-76.8973619999999;8.58430700000002,-76.8973619999999;8.58430700000002,-76.89791799999991;8.58402800000005,-76.89791799999991;8.58402800000005,-76.8984769999999;8.583750000000119,-76.8984769999999;8.583750000000119,-76.89875000000001;8.58319399999993,-76.89875000000001;8.58319399999993,-76.89902599999991;8.582360000000049,-76.89902599999991;8.582360000000049,-76.899306;8.582084000000121,-76.899306;8.582084000000121,-76.899582;8.581527999999929,-76.899582;8.581527999999929,-76.900138;8.58125000000007,-76.900138;8.58125000000007,-76.90069699999989;8.58097200000014,-76.90069699999989;8.58097200000014,-76.9012529999999;8.580694000000049,-76.9012529999999;8.580694000000049,-76.9015279999999;8.580416000000129,-76.9015279999999;8.580416000000129,-76.90235799999989;8.57985999999994,-76.90235799999989;8.57985999999994,-76.9026409999999;8.57958400000007,-76.9026409999999;8.57958400000007,-76.90291599999991;8.579306000000139,-76.90291599999991;8.579306000000139,-76.90347300000001;8.579028000000051,-76.90347300000001;8.579028000000051,-76.9040309999999;8.578750000000131,-76.9040309999999;8.578750000000131,-76.904304;8.57847200000003,-76.904304;8.57847200000003,-76.90458699999991;8.57791800000007,-76.90458699999991;8.57791800000007,-76.9048609999999;8.57763800000015,-76.9048609999999;8.57763800000015,-76.905136;8.577362000000051,-76.905136;8.577362000000051,-76.9054189999999;8.577084000000131,-76.9054189999999;8.577084000000131,-76.9062509999999;8.57680600000003,-76.9062509999999;8.57680600000003,-76.90652399999991;8.576527999999939,-76.90652399999991;8.576527999999939,-76.9068069999999;8.576250000000069,-76.9068069999999;8.57625200000007,-76.9070829999999;8.575972000000149,-76.9070829999999;8.575972000000149,-76.9073629999999;8.575694000000061,-76.9073629999999;8.57569600000005,-76.90819499999991;8.57541599999996,-76.90819499999991;8.57541599999996,-76.90875299999991;8.57514000000003,-76.90875299999991;8.57514000000003,-76.90930299999999;8.574861999999939,-76.90930299999999;8.574861999999939,-76.9098589999999;8.574584000000071,-76.9098589999999;8.574584000000071,-76.9101409999999;8.574306000000149,-76.9101409999999;8.574306000000149,-76.9104149999999;8.574028000000061,-76.9104149999999;8.57403000000005,-76.9106969999999;8.57374999999996,-76.9106969999999;8.57374999999996,-76.9112469999999;8.573471000000151,-76.9112469999999;8.573474000000029,-76.9115289999999;8.57319300000006,-76.9115289999999;8.57319300000006,-76.9118049999999;8.572918000000071,-76.9118049999999;8.572918000000071,-76.91208499999991;8.572640000000151,-76.91208499999991;8.572640000000151,-76.91236099999991;8.57236200000006,-76.91236099999991;8.57236200000006,-76.9126369999999;8.572083999999959,-76.9126369999999;8.572083999999959,-76.91319299999989;8.57180500000015,-76.91319299999989;8.571808000000029,-76.9137489999999;8.57152700000006,-76.9137489999999;8.57152700000006,-76.9140249999999;8.57124899999997,-76.9140249999999;8.571252000000071,-76.9145809999999;8.570974000000151,-76.9145809999999;8.570974000000151,-76.9151369999999;8.570693000000009,-76.9151369999999;8.57069600000005,-76.9154129999999;8.570417000000081,-76.9154129999999;8.570417000000081,-76.91596899999991;8.57013900000015,-76.91596899999991;8.57013900000015,-76.9165269999999;8.56986100000006,-76.9165269999999;8.56986100000006,-76.9168099999999;8.56958299999997,-76.9168099999999;8.56958299999997,-76.91735899999991;8.569305000000099,-76.91735899999991;8.569305000000099,-76.91763999999991;8.569027000000011,-76.91763999999991;8.569029000000001,-76.918198;8.568751000000081,-76.918198;8.568751000000081,-76.91903000000001;8.568471000000161,-76.91903000000001;8.56847300000015,-76.919586;8.56792000000007,-76.919586;8.56792000000007,-76.919862;8.567639000000099,-76.919862;8.567639000000099,-76.9201349999999;8.567361000000011,-76.9201349999999;8.567363,-76.92069099999991;8.56708300000008,-76.92069099999991;8.56708300000008,-76.9209739999999;8.56680500000016,-76.9209739999999;8.56680700000015,-76.92125;8.566527000000059,-76.92125;8.566527000000059,-76.922082;8.566248999999971,-76.922082;8.566248999999971,-76.92263799999991;8.565973000000101,-76.92263799999991;8.565973000000101,-76.92292000000001;8.56541700000008,-76.92292000000001;8.56541700000008,-76.9234699999999;8.56513900000016,-76.9234699999999;8.56513900000016,-76.9240259999999;8.564861000000059,-76.9240259999999;8.564861000000059,-76.924584;8.564582999999971,-76.924584;8.564584999999971,-76.925416;8.5643050000001,-76.925416;8.5643050000001,-76.925696;8.563195000000061,-76.925696;8.563195000000061,-76.92680399999991;8.56291699999997,-76.92680399999991;8.56291699999997,-76.927087;8.5626390000001,-76.927087;8.5626390000001,-76.92735999999999;8.56208300000009,-76.92735999999999;8.56208300000009,-76.928192;8.561804999999991,-76.928192;8.561804999999991,-76.92847499999991;8.561529000000061,-76.92847499999991;8.561529000000061,-76.928748;8.56125099999997,-76.928748;8.56125099999997,-76.9293069999999;8.5609730000001,-76.9293069999999;8.5609730000001,-76.929863;8.56069500000001,-76.929863;8.56069500000001,-76.9301379999999;8.56041700000009,-76.9301379999999;8.56041700000009,-76.930421;8.560138999999991,-76.930421;8.560138999999991,-76.9309699999999;8.559861000000071,-76.9309699999999;8.559861000000071,-76.93115899999999;8.559861000000071,-76.93152600000001;8.559303999999999,-76.9315949999999;8.559303999999999,-76.93208300000001;8.55902900000001,-76.93208300000001;8.55902900000001,-76.93235799999999;8.55875100000009,-76.93235799999999;8.55875100000009,-76.9326409999999;8.55847299999999,-76.9326409999999;8.55847299999999,-76.932914;8.558194000000009,-76.932914;8.558194000000009,-76.93319700000001;8.557638000000001,-76.93319700000001;8.5576410000001,-76.93347299999991;8.55708200000004,-76.93347299999991;8.55708200000004,-76.934029;8.55680600000011,-76.934029;8.55680600000011,-76.9343019999999;8.556528000000011,-76.9343019999999;8.556528000000011,-76.9351429999999;8.556250000000089,-76.9351429999999;8.556250000000089,-76.935417;8.555972000000001,-76.935417;8.555972000000001,-76.93597299999991;8.555694000000131,-76.93597299999991;8.555694000000131,-76.93680499999989;8.55541600000004,-76.93680499999989;8.55541800000003,-76.93708100000001;8.55513800000011,-76.93708100000001;8.55513800000011,-76.93736299999991;8.554584000000091,-76.93736299999991;8.554584000000091,-76.9376369999999;8.55402800000013,-76.9376369999999;8.55402800000013,-76.93791899999989;8.55375000000004,-76.93791899999989;8.55375000000004,-76.93819499999999;8.553472000000109,-76.93819499999999;8.553472000000109,-76.9384689999999;8.55236200000013,-76.9384689999999;8.55236200000013,-76.938751;8.55041800000004,-76.938751;8.55041800000004,-76.9384689999999;8.548472000000119,-76.9384689999999;8.548472000000119,-76.93819499999999;8.54652800000002,-76.93819499999999;8.54652800000002,-76.93791899999989;8.54486200000002,-76.93791899999989;8.54486200000002,-76.9376369999999;8.54430500000012,-76.9376369999999;8.544307999999999,-76.93736299999991;8.54263900000012,-76.93736299999991;8.54263900000012,-76.93708100000001;8.542082999999931,-76.93708100000001;8.542082999999931,-76.93680499999989;8.541527000000141,-76.93680499999989;8.541529000000139,-76.9366839999999;8.541529000000139,-76.9365309999999;8.541370000000139,-76.9365309999999;8.54069500000003,-76.9365309999999;8.54069500000003,-76.936249;8.53930499999996,-76.936249;8.53930499999996,-76.93597299999991;8.538748999999999,-76.93597299999991;8.538748999999999,-76.935693;8.53819500000014,-76.935693;8.53819500000014,-76.935417;8.537361000000031,-76.935417;8.537361000000031,-76.9351429999999;8.537083000000001,-76.9351429999999;8.537083000000001,-76.934861;8.53625100000005,-76.934861;8.53625100000005,-76.934585;8.535972999999959,-76.934585;8.535972999999959,-76.9343019999999;8.535695000000031,-76.9343019999999;8.535695000000031,-76.934029;8.535141000000071,-76.934029;8.535141000000071,-76.933746;8.53458500000005,-76.933746;8.53458500000005,-76.93347299999991;8.534304999999961,-76.93347299999991;8.534304999999961,-76.93319700000001;8.53374800000006,-76.93319700000001;8.53374800000006,-76.932914;8.53347300000007,-76.932914;8.53347300000007,-76.9326409999999;8.532919000000049,-76.9326409999999;8.532919000000049,-76.93235799999999;8.53236300000003,-76.93235799999999;8.53236300000003,-76.93208300000001;8.53208200000006,-76.93208300000001;8.53208200000006,-76.9318089999999;8.53152900000015,-76.9318089999999;8.53152900000015,-76.93152600000001;8.531251000000051,-76.93152600000001;8.531251000000051,-76.931251;8.53069400000015,-76.931251;8.53069400000015,-76.9309699999999;8.53014100000007,-76.9309699999999;8.53014100000007,-76.930695;8.52986300000015,-76.930695;8.52986300000015,-76.930421;8.52930600000008,-76.930421;8.52930600000008,-76.9301379999999;8.528750000000059,-76.9301379999999;8.528750000000059,-76.929863;8.528471999999971,-76.929863;8.528471999999971,-76.9293069999999;8.5281940000001,-76.9293069999999;8.5281940000001,-76.928748;8.527915999999999,-76.928748;8.527918,-76.92847499999991;8.52763800000008,-76.92847499999991;8.52763800000008,-76.928192;8.527359999999989,-76.928192;8.527362000000149,-76.927919;8.527084000000061,-76.927919;8.527084000000061,-76.92763599999989;8.52680599999997,-76.92763599999989;8.52680799999996,-76.927087;8.5265280000001,-76.927087;8.5265280000001,-76.9259719999999;8.526249999999999,-76.9259719999999;8.526252,-76.925416;8.525972000000079,-76.925416;8.525972000000079,-76.924584;8.526252,-76.924584;8.526249999999999,-76.92292000000001;8.5265280000001,-76.92292000000001;8.5265280000001,-76.9218059999999;8.52680799999996,-76.9218059999999;8.52680599999997,-76.9209739999999;8.527084000000061,-76.9209739999999;8.527084000000061,-76.92069099999991;8.527362000000149,-76.92069099999991;8.527359999999989,-76.920418;8.52763800000008,-76.920418;8.52763800000008,-76.9201349999999;8.527918,-76.9201349999999;8.527915999999999,-76.9193029999999;8.5281940000001,-76.9193029999999;8.5281940000001,-76.9187469999999;8.528471999999971,-76.9187469999999;8.528471999999971,-76.9184719999999;8.528750000000059,-76.9184719999999;8.528750000000059,-76.918198;8.52902800000015,-76.918198;8.52902800000015,-76.91791499999989;8.52930600000008,-76.91791499999989;8.52930600000008,-76.91735899999991;8.529584,-76.91735899999991;8.529582,-76.917084;8.52986300000015,-76.917084;8.52986300000015,-76.9168099999999;8.530416000000059,-76.9168099999999;8.530416000000059,-76.9165269999999;8.53069400000015,-76.9165269999999;8.53069400000015,-76.9156959999999;8.53097200000008,-76.9156959999999;8.53097200000008,-76.9154129999999;8.531251000000051,-76.9154129999999;8.531251000000051,-76.9151369999999;8.53152900000015,-76.9151369999999;8.53152900000015,-76.9145809999999;8.53180700000007,-76.9145809999999;8.53180700000007,-76.9140249999999;8.53208200000006,-76.9140249999999;8.53208200000006,-76.91319299999989;8.53236300000003,-76.91319299999989;8.53236000000015,-76.9126369999999;8.532638999999961,-76.9126369999999;8.532638999999961,-76.91208499999991;8.532919000000049,-76.91208499999991;8.532919000000049,-76.9115289999999;8.53347300000007,-76.9115289999999;8.53347300000007,-76.9118049999999;8.534304999999961,-76.9118049999999;8.534304999999961,-76.9112469999999;8.534029000000031,-76.9112469999999;8.534029000000031,-76.9106969999999;8.53374800000006,-76.9106969999999;8.53374800000006,-76.9104149999999;8.53347300000007,-76.9104149999999;8.53347300000007,-76.9101409999999;8.53319500000015,-76.9101409999999;8.53319500000015,-76.90930299999999;8.532917000000049,-76.90930299999999;8.532919000000049,-76.9090269999999;8.532638999999961,-76.9090269999999;8.532638999999961,-76.90875299999991;8.53208200000006,-76.90875299999991;8.53208200000006,-76.907912;8.53180700000007,-76.907912;8.53180700000007,-76.905136;8.53152900000015,-76.905136;8.53152900000015,-76.9048609999999;8.531251000000051,-76.9048609999999;8.531251000000051,-76.904304;8.53097200000008,-76.904304;8.53097200000008,-76.9040309999999;8.53069400000015,-76.9040309999999;8.53069400000015,-76.90374799999999;8.530416000000059,-76.90374799999999;8.530416000000059,-76.9031989999999;8.530137999999971,-76.9031989999999;8.53014100000007,-76.9026409999999;8.52986300000015,-76.9026409999999;8.52986300000015,-76.90235799999989;8.529582,-76.90235799999989;8.529584,-76.901802;8.52930600000008,-76.901802;8.52930600000008,-76.90097;8.52902800000015,-76.90097;8.52902800000015,-76.90069699999989;8.528750000000059,-76.90069699999989;8.528750000000059,-76.900138;8.528471999999971,-76.900138;8.528471999999971,-76.899582;8.5281940000001,-76.899582;8.5281940000001,-76.89902599999991;8.527915999999999,-76.89902599999991;8.527918,-76.8984769999999;8.52763800000008,-76.8984769999999;8.52763800000008,-76.8981939999999;8.527359999999989,-76.8981939999999;8.527362000000149,-76.89791799999991;8.527084000000061,-76.89791799999991;8.527084000000061,-76.8973619999999;8.52680599999997,-76.8973619999999;8.52680799999996,-76.896248;8.5265280000001,-76.896248;8.5265280000001,-76.895416;8.525972000000079,-76.895416;8.525972000000079,-76.89514200000001;8.525693999999991,-76.89514200000001;8.525693999999991,-76.8948599999999;8.52541600000006,-76.8948599999999;8.52541600000006,-76.894584;8.52513800000003,-76.894584;8.52513800000003,-76.89402799999991;8.5248620000001,-76.89402799999991;8.5248620000001,-76.8931959999999;8.524582000000009,-76.8931959999999;8.524584000000001,-76.89125;8.524306000000079,-76.89125;8.524306000000079,-76.8906929999999;8.524027999999991,-76.8906929999999;8.524027999999991,-76.88930499999999;8.52375000000006,-76.88930499999999;8.52375000000006,-76.8887469999999;8.52347200000003,-76.8887469999999;8.523473999999959,-76.8865269999999;8.5231940000001,-76.8865269999999;8.5231940000001,-76.8856949999999;8.522916000000009,-76.8856949999999;8.522918000000001,-76.8854149999999;8.522640000000081,-76.8854149999999;8.522640000000081,-76.883751;8.52236199999999,-76.883751;8.52236199999999,-76.88346899999991;8.52208400000006,-76.88346899999991;8.52208400000006,-76.882637;8.52236199999999,-76.882637;8.52236199999999,-76.8820809999999;8.52208400000006,-76.8820809999999;8.52208400000006,-76.881805;8.52180600000003,-76.881805;8.52180600000003,-76.8815309999999;8.5215280000001,-76.8815309999999;8.5215280000001,-76.8812489999999;8.521250000000011,-76.8812489999999;8.521250000000011,-76.8804169999999;8.520972000000089,-76.8804169999999;8.520972000000089,-76.87846999999989;8.52069599999999,-76.87846999999989;8.52069599999999,-76.877641;8.520416000000131,-76.877641;8.520416000000131,-76.877358;8.52014000000003,-76.877358;8.52014000000003,-76.8765259999999;8.519862000000099,-76.8765259999999;8.519862000000099,-76.87541899999989;8.519584000000011,-76.87541899999989;8.519584000000011,-76.87430599999991;8.519306000000091,-76.87430599999991;8.519306000000091,-76.873475;8.51902799999999,-76.873475;8.51902799999999,-76.873192;8.51874900000001,-76.873192;8.51874900000001,-76.872643;8.51902799999999,-76.872643;8.51902799999999,-76.8715279999999;8.51874900000001,-76.8715279999999;8.51874900000001,-76.8712459999999;8.51847400000003,-76.8712459999999;8.51847400000003,-76.8706959999999;8.518193,-76.8706959999999;8.518193,-76.86985799999999;8.517640000000091,-76.86985799999999;8.517640000000091,-76.8695839999999;8.517361000000109,-76.8695839999999;8.517361000000109,-76.8687519999999;8.51708300000001,-76.8687519999999;8.51708300000001,-76.868194;8.51680500000009,-76.868194;8.51680500000009,-76.8679199999999;8.51708300000001,-76.8679199999999;8.51708300000001,-76.8676379999999;8.51680500000009,-76.8676379999999;8.51680500000009,-76.86653199999991;8.516527,-76.86653199999991;8.516527,-76.8659739999999;8.51624900000013,-76.8659739999999;8.51624900000013,-76.86430300000001;8.51597100000004,-76.86430300000001;8.51597100000004,-76.863747;8.515695000000109,-76.863747;8.515695000000109,-76.8631979999999;8.51597100000004,-76.8631979999999;8.51597100000004,-76.8629149999999;8.515695000000109,-76.8629149999999;8.515695000000109,-76.8626399999999;8.51541700000001,-76.8626399999999;8.51541700000001,-76.8620829999999;8.51513900000009,-76.8620829999999;8.51513900000009,-76.8618079999999;8.514861,-76.8618079999999;8.514861,-76.860969;8.51458300000013,-76.860969;8.51458300000013,-76.86069500000001;8.514305000000039,-76.86069500000001;8.514305000000039,-76.85958099999991;8.514027000000111,-76.85958099999991;8.514027000000111,-76.8593069999999;8.51374900000002,-76.8593069999999;8.51375100000001,-76.858193;8.51347300000009,-76.858193;8.51347300000009,-76.8576349999999;8.513195,-76.8576349999999;8.513195,-76.85680499999999;8.51291700000013,-76.85680499999999;8.51291700000013,-76.85597299999991;8.512639000000039,-76.85597299999991;8.512639000000039,-76.85569700000001;8.51236100000011,-76.85569700000001;8.51236100000011,-76.8551409999999;8.51208300000002,-76.8551409999999;8.51208300000002,-76.8543089999999;8.51180500000009,-76.8543089999999;8.51180500000009,-76.853195;8.511529,-76.853195;8.511529,-76.8520799999999;8.511249000000131,-76.8520799999999;8.511249000000131,-76.85125099999991;8.510973000000041,-76.85125099999991;8.510973000000041,-76.85097499999991;8.51069500000011,-76.85097499999991;8.51069500000011,-76.85013599999991;8.51041700000002,-76.85013599999991;8.51041700000002,-76.8493039999999;8.510139000000089,-76.8493039999999;8.510139000000089,-76.8487479999999;8.509861000000059,-76.8487479999999;8.509861000000059,-76.84819899999999;8.509583000000131,-76.84819899999999;8.509583000000131,-76.847358;8.509307000000041,-76.847358;8.509307000000041,-76.8468019999999;8.509027000000121,-76.8468019999999;8.509027000000121,-76.846526;8.50875100000002,-76.846526;8.50875100000002,-76.845696;8.508473000000089,-76.845696;8.508473000000089,-76.84541399999991;8.508195000000059,-76.84541399999991;8.508195000000059,-76.8443059999999;8.507917000000131,-76.8443059999999;8.507917000000131,-76.8434739999999;8.50763900000004,-76.8434739999999;8.50764100000004,-76.8426359999999;8.50736100000012,-76.8426359999999;8.50736100000012,-76.84236199999999;8.507083000000019,-76.84236199999999;8.50708500000002,-76.8418039999999;8.50680500000016,-76.8418039999999;8.50680500000016,-76.84124799999989;8.506529000000061,-76.84124799999989;8.506529000000061,-76.84097199999989;8.50625100000013,-76.84097199999989;8.50625100000013,-76.84041599999991;8.50597300000004,-76.84041599999991;8.50597300000004,-76.83986;8.50569500000012,-76.83986;8.50569500000012,-76.83930099999991;8.505417000000021,-76.83930099999991;8.505419000000019,-76.839028;8.50513800000004,-76.839028;8.50513800000004,-76.8384719999999;8.504859999999949,-76.8384719999999;8.504863000000061,-76.8378969999999;8.504863000000061,-76.83763999999989;8.50468900000004,-76.83763999999989;8.504582000000029,-76.83763999999989;8.504582000000029,-76.83747099999989;8.504582000000029,-76.83736399999999;8.50430700000004,-76.83736399999999;8.50430700000004,-76.837081;8.504026000000071,-76.837081;8.504026000000071,-76.8365249999999;8.503750000000141,-76.8365249999999;8.503750000000141,-76.836249;8.503472000000039,-76.836249;8.503472000000039,-76.83569299999991;8.503193999999951,-76.83569299999991;8.503193999999951,-76.8354199999999;8.502916000000029,-76.8354199999999;8.502916000000029,-76.8351369999999;8.50263799999999,-76.8351369999999;8.50264100000004,-76.8345879999999;8.502360000000071,-76.8345879999999;8.502360000000071,-76.83403;8.50208400000014,-76.83403;8.50208400000014,-76.8336169999999;8.50208400000014,-76.8334729999999;8.501806000000039,-76.8334729999999;8.501806000000039,-76.8331909999999;8.501527999999951,-76.8331909999999;8.501527999999951,-76.8327649999999;8.501527999999951,-76.83264199999989;8.501250000000031,-76.83264199999989;8.501250000000031,-76.8323589999999;8.50097199999999,-76.8323589999999;8.50097199999999,-76.83180299999989;8.500883000000041,-76.83180299999989;8.50069400000007,-76.83180299999989;8.50069400000007,-76.8315269999999;8.50041600000014,-76.8315269999999;8.50041600000014,-76.83097099999991;8.499859999999959,-76.83097099999991;8.499861999999951,-76.830415;8.499584000000031,-76.830415;8.499584000000031,-76.829866;8.49902800000007,-76.829866;8.49902800000007,-76.8293069999999;8.498472000000049,-76.8293069999999;8.498472000000049,-76.828751;8.498193999999961,-76.828751;8.498193999999961,-76.8281929999999;8.497916000000091,-76.8281929999999;8.497916000000091,-76.82791899999999;8.49763799999999,-76.82791899999999;8.49763799999999,-76.8276369999999;8.49736200000007,-76.8276369999999;8.49736200000007,-76.82708;8.49708400000014,-76.82708;8.49708400000014,-76.8265309999999;8.496806000000049,-76.8265309999999;8.496806000000049,-76.826249;8.496527999999961,-76.826249;8.496527999999961,-76.82597299999991;8.496250000000091,-76.82597299999991;8.496250000000091,-76.82568999999999;8.495971999999989,-76.82568999999999;8.495971999999989,-76.825417;8.49569400000007,-76.825417;8.49569400000007,-76.8251409999999;8.49541600000015,-76.8251409999999;8.49541600000015,-76.8248609999999;8.495140000000051,-76.8248609999999;8.495140000000051,-76.824585;8.49485999999996,-76.824585;8.49485999999996,-76.824302;8.49458400000009,-76.824302;8.49458400000009,-76.8240289999999;8.494305999999989,-76.8240289999999;8.494305999999989,-76.82347;8.49375000000015,-76.82347;8.49375000000015,-76.822914;8.49347200000005,-76.822914;8.493474000000051,-76.822638;8.49319399999996,-76.822638;8.49319399999996,-76.82236499999991;8.49291800000009,-76.82236499999991;8.49291800000009,-76.822082;8.492639999999991,-76.822082;8.492639999999991,-76.82152599999991;8.492362000000069,-76.82152599999991;8.492362000000069,-76.82125000000001;8.49152700000008,-76.82125000000001;8.49152700000008,-76.8206939999999;8.49124899999998,-76.8206939999999;8.49125200000009,-76.82013599999991;8.490696000000071,-76.82013599999991;8.490696000000071,-76.81958;8.490418000000149,-76.81958;8.490418000000149,-76.819306;8.489861000000079,-76.819306;8.489861000000079,-76.8190309999999;8.48958299999998,-76.8190309999999;8.48958299999998,-76.818748;8.48930500000006,-76.818748;8.48930500000006,-76.8184739999999;8.48902700000002,-76.8184739999999;8.489030000000071,-76.8181919999999;8.488751000000089,-76.8181919999999;8.488751000000089,-76.817916;8.488195000000079,-76.817916;8.488195000000079,-76.8176429999999;8.48791699999998,-76.8176429999999;8.48791699999998,-76.81735999999999;8.48763900000006,-76.81735999999999;8.48763900000006,-76.81708399999999;8.48736100000002,-76.81708399999999;8.48736100000002,-76.81680399999991;8.4870830000001,-76.81680399999991;8.4870830000001,-76.81652799999991;8.486527000000081,-76.81652799999991;8.486527000000081,-76.816255;8.48624899999999,-76.816255;8.48625099999998,-76.8156959999999;8.485696999999959,-76.8156959999999;8.485696999999959,-76.815414;8.4854170000001,-76.815414;8.4854170000001,-76.8148569999999;8.48486100000008,-76.8148569999999;8.48486100000008,-76.814584;8.48430500000012,-76.814584;8.48430500000012,-76.814308;8.483751000000099,-76.814308;8.483751000000099,-76.81375199999999;8.483473,-76.81375199999999;8.483473,-76.8134689999999;8.482918999999979,-76.8134689999999;8.482918999999979,-76.8131939999999;8.48263900000012,-76.8131939999999;8.48263900000012,-76.81263799999989;8.482083000000101,-76.81263799999989;8.482083000000101,-76.81236199999999;8.48152700000009,-76.81236199999999;8.48152700000009,-76.81208100000001;8.48125099999999,-76.81208100000001;8.48125099999999,-76.8115319999999;8.480695000000029,-76.8115319999999;8.480695000000029,-76.81125;8.48013900000001,-76.81125;8.48013900000001,-76.810974;8.47958499999999,-76.810974;8.47958499999999,-76.810418;8.479029000000031,-76.810418;8.479029000000031,-76.810142;8.4787510000001,-76.810142;8.4787510000001,-76.8098589999999;8.478195000000079,-76.8098589999999;8.478195000000079,-76.809586;8.477916000000111,-76.809586;8.477916000000111,-76.8093029999999;8.47736000000009,-76.8093029999999;8.47736000000009,-76.80903000000001;8.47680700000001,-76.80903000000001;8.47680700000001,-76.808747;8.47625000000011,-76.808747;8.47625000000011,-76.8084709999999;8.475972000000009,-76.8084709999999;8.475972000000009,-76.80819799999991;8.475416000000051,-76.80819799999991;8.475416000000051,-76.80791499999999;8.474860000000041,-76.80791499999999;8.474860000000041,-76.8076389999999;8.47430400000002,-76.8076389999999;8.47430400000002,-76.8073569999999;8.474028000000089,-76.8073569999999;8.474028000000089,-76.80708300000001;8.473472000000131,-76.80708300000001;8.473472000000131,-76.806808;8.47319400000004,-76.806808;8.47319400000004,-76.806703;8.47319400000004,-76.8065269999999;8.47270599999996,-76.8065109999999;8.472640000000011,-76.806251;8.472362000000089,-76.806251;8.472362000000089,-76.80596899999991;8.47208400000005,-76.80596899999991;8.47208400000005,-76.8056949999999;8.47152800000003,-76.8056949999999;8.47152800000003,-76.80542;8.470972000000019,-76.80542;8.470972000000019,-76.8051369999999;8.470694000000149,-76.8051369999999;8.470694000000149,-76.8048629999999;8.47013800000013,-76.8048629999999;8.47013800000013,-76.8045809999999;8.46958400000011,-76.8045809999999;8.46958400000011,-76.8043049999999;8.46847200000013,-76.8043049999999;8.46847200000013,-76.80403200000001;8.467915999999949,-76.80403200000001;8.467915999999949,-76.803749;8.467640000000021,-76.803749;8.467640000000021,-76.80347499999991;8.466530000000031,-76.80347499999991;8.466530000000031,-76.80319299999989;8.465974000000021,-76.80319299999989;8.465974000000021,-76.80291699999999;8.465693000000041,-76.80291699999999;8.465693000000041,-76.802634;8.46541800000006,-76.802634;8.46541800000006,-76.80291699999999;8.46513700000008,-76.80291699999999;8.46513700000008,-76.802634;8.46374899999995,-76.802634;8.46375200000006,-76.80236099999991;8.46347100000008,-76.80236099999991;8.46347100000008,-76.80208500000001;8.46263900000014,-76.80208500000001;8.46263900000014,-76.80180300000001;8.46208299999995,-76.80180300000001;8.46208600000006,-76.8015289999999;8.461251000000059,-76.8015289999999;8.461251000000059,-76.80124599999991;8.46041699999995,-76.80124599999991;8.46041699999995,-76.8009729999999;8.46013900000008,-76.8009729999999;8.46013900000008,-76.8006969999999;8.45986100000016,-76.8006969999999;8.45986100000016,-76.8004149999999;8.45958300000007,-76.8004149999999;8.45958300000007,-76.8001409999999;8.458748999999949,-76.8001409999999;8.45875099999995,-76.7998579999999;8.45819500000016,-76.7998579999999;8.45819500000016,-76.7995829999999;8.457917000000069,-76.7995829999999;8.457917000000069,-76.79930899999989;8.45736100000005,-76.79930899999989;8.45736100000005,-76.7990269999999;8.455973000000141,-76.7990269999999;8.455973000000141,-76.798751;8.45513900000009,-76.798751;8.45513900000009,-76.79847;8.454583000000071,-76.79847;8.454583000000071,-76.79819499999989;8.45347300000009,-76.79819499999989;8.45347300000009,-76.797921;8.45319499999999,-76.797921;8.45319499999999,-76.7976389999999;8.45236100000005,-76.7976389999999;8.45236300000005,-76.79736299999991;8.45125100000007,-76.79736299999991;8.45125100000007,-76.7970799999999;8.44986299999999,-76.7970799999999;8.44986299999999,-76.7968069999999;8.447916000000021,-76.7968069999999;8.447918000000019,-76.79652399999991;8.447638000000101,-76.79652399999991;8.447638000000101,-76.79624799999991;8.44708400000007,-76.79624799999991;8.44708400000007,-76.79652399999991;8.446250000000021,-76.79652399999991;8.446250000000021,-76.79624799999991;8.445972000000101,-76.79624799999991;8.445972000000101,-76.7959749999999;8.44541600000008,-76.7959749999999;8.44541600000008,-76.7956919999999;8.443194000000121,-76.7956919999999;8.443194000000121,-76.795419;8.442361999999999,-76.795419;8.442361999999999,-76.795136;8.439862000000121,-76.795136;8.439862000000121,-76.7948599999999;8.437918000000019,-76.7948599999999;8.437918000000019,-76.79458700000001;8.43597100000005,-76.79458700000001;8.43597100000005,-76.794304;8.43430500000005,-76.794304;8.43430500000005,-76.7940279999999;8.433749000000031,-76.7940279999999;8.433749000000031,-76.7937459999999;8.43319500000001,-76.7937459999999;8.43319500000001,-76.79319699999991;8.43263900000005,-76.79319699999991;8.43263900000005,-76.79291599999991;8.432083000000031,-76.79291599999991;8.432083000000031,-76.79235799999999;8.43152900000001,-76.79235799999999;8.43152900000001,-76.7920839999999;8.43124900000015,-76.7920839999999;8.43124900000015,-76.7918089999999;8.43069500000013,-76.7918089999999;8.43069500000013,-76.79152599999991;8.42986100000002,-76.79152599999991;8.42986300000001,-76.7918089999999;8.429027000000129,-76.7918089999999;8.429027000000129,-76.7912519999999;8.42875100000003,-76.7912519999999;8.42875100000003,-76.7906939999999;8.42819500000002,-76.7906939999999;8.42819500000002,-76.790138;8.42791700000015,-76.790138;8.42791700000015,-76.7898639999999;8.42763900000006,-76.7898639999999;8.427641000000049,-76.7895819999999;8.42680499999994,-76.7895819999999;8.42680499999994,-76.789306;8.42609600000009,-76.789306;8.425973000000059,-76.789306;8.425973000000059,-76.789023;8.42541900000003,-76.789023;8.42541900000003,-76.78874999999989;8.424307000000059,-76.78874999999989;8.424307000000059,-76.78847399999999;8.42319700000002,-76.78847399999999;8.42319700000002,-76.78819399999991;8.422641000000061,-76.78819399999991;8.422641000000061,-76.78791799999991;8.42125000000004,-76.78791799999991;8.42125000000004,-76.787635;8.420971999999949,-76.787635;8.420975000000061,-76.7856979999999;8.420694000000079,-76.7856979999999;8.420694000000079,-76.784859;8.420975000000061,-76.784859;8.420975000000061,-76.78402800000001;8.420694000000079,-76.78402800000001;8.420694000000079,-76.7823639999999;8.420975000000061,-76.7823639999999;8.420975000000061,-76.781525;8.420694000000079,-76.781525;8.420694000000079,-76.7812489999999;8.420975000000061,-76.7812489999999;8.420975000000061,-76.780693;8.420694000000079,-76.780693;8.420694000000079,-76.780137;8.420975000000061,-76.780137;8.420975000000061,-76.7795879999999;8.420694000000079,-76.7795879999999;8.420694000000079,-76.77902899999999;8.420975000000061,-76.77902899999999;8.420971999999949,-76.7781979999999;8.42125000000004,-76.7781979999999;8.42125000000004,-76.77791499999989;8.42138900000003,-76.77791499999989;8.421531000000019,-76.77791499999989;8.421531000000019,-76.7770849999999;8.42125000000004,-76.7770849999999;8.42125000000004,-76.776527;8.420971999999949,-76.776527;8.420975000000061,-76.775695;8.420694000000079,-76.775695;8.420694000000079,-76.77458299999989;8.420416000000159,-76.77458299999989;8.420418000000151,-76.77375099999991;8.42014000000006,-76.77375099999991;8.42014000000006,-76.77347500000001;8.41985999999997,-76.77347500000001;8.419862000000141,-76.7729189999999;8.419305999999951,-76.7729189999999;8.419305999999951,-76.77263600000001;8.419028000000081,-76.77263600000001;8.419028000000081,-76.771805;8.418472000000071,-76.771805;8.418472000000071,-76.7712479999999;8.41819399999997,-76.7712479999999;8.41819399999997,-76.770973;8.41791600000005,-76.770973;8.41791600000005,-76.7706899999999;8.417638000000011,-76.7706899999999;8.417638000000011,-76.7704169999999;8.417084000000161,-76.7704169999999;8.417084000000161,-76.7698579999999;8.41680600000007,-76.7698579999999;8.41680600000007,-76.76958499999991;8.416527999999969,-76.76958499999991;8.416527999999969,-76.7693019999999;8.415972000000011,-76.7693019999999;8.415972000000011,-76.7687529999999;8.415694000000091,-76.7687529999999;8.415694000000091,-76.76846999999989;8.41514000000006,-76.76846999999989;8.41514000000006,-76.768197;8.414584000000049,-76.768197;8.414584000000049,-76.76791399999991;8.41374999999999,-76.76791399999991;8.41374999999999,-76.76763800000001;8.41264000000001,-76.76763800000001;8.41264000000001,-76.767365;8.41180600000007,-76.767365;8.41180600000007,-76.7670819999999;8.411527999999979,-76.7670819999999;8.411527999999979,-76.766806;8.41097400000001,-76.766806;8.41097400000001,-76.7665259999999;8.410140000000069,-76.7665259999999;8.410140000000069,-76.7662499999999;8.409305000000071,-76.7662499999999;8.409305000000071,-76.76597700000001;8.40874900000011,-76.76597700000001;8.40874900000011,-76.7656939999999;8.40847100000002,-76.7656939999999;8.40847300000002,-76.7654179999999;8.407916999999999,-76.7654179999999;8.407916999999999,-76.7651359999999;8.40708300000011,-76.7651359999999;8.40708300000011,-76.7645799999999;8.40680500000002,-76.7645799999999;8.40680700000001,-76.76430600000001;8.406250999999999,-76.76430600000001;8.406250999999999,-76.76402999999991;8.40569499999998,-76.76402999999991;8.40569499999998,-76.76374799999989;8.40541700000011,-76.76374799999989;8.40541700000011,-76.763474;8.4048610000001,-76.763474;8.4048610000001,-76.7631919999999;8.404583000000001,-76.7631919999999;8.404583000000001,-76.76291599999991;8.404305000000081,-76.76291599999991;8.404305000000081,-76.762642;8.40375100000011,-76.762642;8.40375100000011,-76.7623599999999;8.402917,-76.7623599999999;8.402917,-76.7620839999999;8.40236100000004,-76.7620839999999;8.40236100000004,-76.7615279999999;8.401807000000019,-76.7615279999999;8.401807000000019,-76.76125399999989;8.401251,-76.76125399999989;8.401251,-76.7609719999999;8.40041700000012,-76.7609719999999;8.40041700000012,-76.7606959999999;8.39902900000004,-76.7606959999999;8.39902900000004,-76.7604129999999;8.398473000000021,-76.7604129999999;8.398473000000021,-76.76013999999989;8.398195000000101,-76.76013999999989;8.398195000000101,-76.75986399999989;8.39680700000002,-76.75986399999989;8.39680700000002,-76.7595819999999;8.396250000000119,-76.7595819999999;8.396250000000119,-76.759308;8.39541600000001,-76.759308;8.39541600000001,-76.75902499999999;8.394306000000031,-76.75902499999999;8.394306000000031,-76.7587519999999;8.39263800000003,-76.7587519999999;8.39263800000003,-76.75846899999991;8.391250000000131,-76.75846899999991;8.391250000000131,-76.7581939999999;8.390418000000009,-76.7581939999999;8.390418000000009,-76.75846899999991;8.389027999999939,-76.75846899999991;8.389027999999939,-76.7581939999999;8.388472000000149,-76.7581939999999;8.388472000000149,-76.75846899999991;8.38791600000013,-76.75846899999991;8.38791600000013,-76.7581939999999;8.38764000000003,-76.7581939999999;8.38764000000003,-76.75846899999991;8.387084000000071,-76.75846899999991;8.387084000000071,-76.7581939999999;8.38653000000005,-76.7581939999999;8.38653000000005,-76.7579199999999;8.385418000000071,-76.7579199999999;8.385418000000071,-76.7581939999999;8.384308000000029,-76.7581939999999;8.384308000000029,-76.75846899999991;8.38402700000006,-76.75846899999991;8.38402700000006,-76.7581939999999;8.380971000000161,-76.7581939999999;8.38097300000015,-76.7579199999999;8.38042000000007,-76.7579199999999;8.38042000000007,-76.7581939999999;8.3768050000001,-76.7581939999999;8.3768050000001,-76.75846899999991;8.374304999999991,-76.75846899999991;8.374304999999991,-76.7581939999999;8.372361000000071,-76.7581939999999;8.372361000000071,-76.75846899999991;8.371803999999999,-76.75846899999991;8.371803999999999,-76.7587519999999;8.370416000000089,-76.7587519999999;8.370416000000089,-76.75902499999999;8.365972000000109,-76.75902499999999;8.365972000000109,-76.759308;8.364306000000109,-76.759308;8.364306000000109,-76.7595819999999;8.36319400000014,-76.7595819999999;8.36319400000014,-76.75986399999989;8.361806,-76.75986399999989;8.361806,-76.76013999999989;8.36172400000015,-76.76013999999989;8.3604160000001,-76.76013999999989;8.3604160000001,-76.7604129999999;8.357640000000121,-76.7604129999999;8.357640000000121,-76.7606959999999;8.35569600000002,-76.7606959999999;8.35569600000002,-76.7609719999999;8.35541500000005,-76.7609719999999;8.35541500000005,-76.7606959999999;8.35486100000003,-76.7606959999999;8.35486100000003,-76.7609719999999;8.35319500000003,-76.7609719999999;8.35319500000003,-76.7606959999999;8.35152900000003,-76.7606959999999;8.35152900000003,-76.7604129999999;8.351248999999941,-76.7604129999999;8.351248999999941,-76.7606959999999;8.349582999999941,-76.7606959999999;8.349582999999941,-76.7604129999999;8.34930500000007,-76.7604129999999;8.34930500000007,-76.76013999999989;8.349027000000151,-76.76013999999989;8.349027000000151,-76.75986399999989;8.34875100000005,-76.75986399999989;8.34875100000005,-76.7595819999999;8.34847300000013,-76.7595819999999;8.34847300000013,-76.759308;8.348195000000031,-76.759308;8.348195000000031,-76.7587519999999;8.34791699999994,-76.7587519999999;8.34791699999994,-76.75846899999991;8.34763900000007,-76.75846899999991;8.347641000000071,-76.7579199999999;8.34736100000015,-76.7579199999999;8.34736100000015,-76.7573619999999;8.347083000000049,-76.7573619999999;8.34708500000005,-76.757079;8.346529000000031,-76.757079;8.346529000000031,-76.7565299999999;8.34597300000007,-76.7565299999999;8.34597300000007,-76.7562489999999;8.345419000000049,-76.7562489999999;8.345419000000049,-76.7559739999999;8.345138999999961,-76.7559739999999;8.345138999999961,-76.755691;8.344861000000041,-76.755691;8.34486300000003,-76.75541799999991;8.34430700000007,-76.75541799999991;8.34430700000007,-76.75514199999991;8.343751000000051,-76.75514199999991;8.343751000000051,-76.754859;8.34319400000015,-76.754859;8.34319400000015,-76.75430299999989;8.34180600000008,-76.75430299999989;8.34180600000008,-76.75402699999999;8.3406940000001,-76.75402699999999;8.3406940000001,-76.7537539999999;8.339584000000061,-76.7537539999999;8.339584000000061,-76.75347099999991;8.338749999999999,-76.75347099999991;8.338749999999999,-76.7537539999999;8.3373620000001,-76.7537539999999;8.3373620000001,-76.75347099999991;8.337082000000009,-76.75347099999991;8.337084000000001,-76.7531979999999;8.336806000000079,-76.7531979999999;8.336806000000079,-76.75347099999991;8.33485999999999,-76.75347099999991;8.334862000000159,-76.7537539999999;8.33458400000006,-76.7537539999999;8.33458400000006,-76.75347099999991;8.330418000000011,-76.75347099999991;8.330418000000011,-76.7537539999999;8.326805000000039,-76.7537539999999;8.326805000000039,-76.75402699999999;8.32430500000009,-76.75402699999999;8.32430500000009,-76.75430299999989;8.321807000000041,-76.75430299999989;8.321807000000041,-76.7545859999999;8.320695000000001,-76.7545859999999;8.320695000000001,-76.754859;8.31986100000012,-76.754859;8.31986100000012,-76.75514199999991;8.31819500000012,-76.75514199999991;8.31819500000012,-76.75541799999991;8.31680700000004,-76.75541799999991;8.31680700000004,-76.755691;8.31569400000012,-76.755691;8.31569400000012,-76.7559739999999;8.314860000000071,-76.7559739999999;8.314860000000071,-76.7562489999999;8.313750000000031,-76.7562489999999;8.313750000000031,-76.7565299999999;8.31291600000014,-76.7565299999999;8.31291600000014,-76.7568059999999;8.312084000000031,-76.7568059999999;8.312084000000031,-76.757079;8.31152800000007,-76.757079;8.31152800000007,-76.7573619999999;8.31041600000003,-76.7573619999999;8.31041600000003,-76.7576369999999;8.30958400000014,-76.7576369999999;8.30958400000014,-76.7579199999999;8.309027999999961,-76.7579199999999;8.309027999999961,-76.7581939999999;8.307640000000051,-76.7581939999999;8.307640000000051,-76.75846899999991;8.30708400000003,-76.75846899999991;8.30708400000003,-76.7587519999999;8.306528000000069,-76.7587519999999;8.30653000000007,-76.75902499999999;8.305974000000051,-76.75902499999999;8.305974000000051,-76.759308;8.304862000000069,-76.759308;8.304862000000069,-76.7595819999999;8.30402799999996,-76.7595819999999;8.30402799999996,-76.75986399999989;8.30347100000006,-76.75986399999989;8.30347100000006,-76.76013999999989;8.302918000000149,-76.76013999999989;8.302918000000149,-76.7604129999999;8.30180500000006,-76.7604129999999;8.30180500000006,-76.7606959999999;8.301526999999959,-76.7606959999999;8.301530000000071,-76.7609719999999;8.30013900000006,-76.7609719999999;8.30013900000006,-76.76125399999989;8.2995830000001,-76.76125399999989;8.2995830000001,-76.7615279999999;8.299305,-76.7615279999999;8.299307000000001,-76.7618039999999;8.29847300000006,-76.7618039999999;8.29847300000006,-76.7620839999999;8.2979170000001,-76.7620839999999;8.2979170000001,-76.7623599999999;8.29736100000008,-76.7623599999999;8.29736100000008,-76.762642;8.29680500000006,-76.762642;8.29680500000006,-76.76291599999991;8.29597100000001,-76.76291599999991;8.295973,-76.7631919999999;8.295139000000059,-76.7631919999999;8.295139000000059,-76.763474;8.294583000000101,-76.763474;8.294583000000101,-76.76374799999989;8.293473000000059,-76.76374799999989;8.293473000000059,-76.76402999999991;8.293195000000029,-76.76402999999991;8.293195000000029,-76.76430600000001;8.29263900000001,-76.76430600000001;8.29263900000001,-76.7645799999999;8.29208499999999,-76.7645799999999;8.29208499999999,-76.76486199999989;8.291805000000121,-76.76486199999989;8.291805000000121,-76.7651359999999;8.2912510000001,-76.7651359999999;8.2912510000001,-76.7654179999999;8.29097300000001,-76.7654179999999;8.29097300000001,-76.7651359999999;8.290695000000079,-76.7651359999999;8.290695000000079,-76.7654179999999;8.29013800000001,-76.7654179999999;8.29013800000001,-76.7656939999999;8.289581999999999,-76.7656939999999;8.289581999999999,-76.76597700000001;8.28930700000001,-76.76597700000001;8.28930700000001,-76.7662499999999;8.287915999999999,-76.7662499999999;8.287915999999999,-76.7665259999999;8.287360000000041,-76.7665259999999;8.287360000000041,-76.766806;8.286250000000001,-76.766806;8.286250000000001,-76.7670819999999;8.285972000000131,-76.7670819999999;8.285972000000131,-76.767365;8.28541600000011,-76.767365;8.28541600000011,-76.76763800000001;8.284584000000001,-76.76763800000001;8.284584000000001,-76.76791399999991;8.28375000000011,-76.76791399999991;8.28375000000011,-76.768197;8.282362000000029,-76.768197;8.282362000000029,-76.76846999999989;8.281806000000021,-76.76846999999989;8.281806000000021,-76.7687529999999;8.28125000000006,-76.7687529999999;8.28125000000006,-76.769029;8.280696000000029,-76.769029;8.280696000000029,-76.7693019999999;8.280140000000021,-76.7693019999999;8.280140000000021,-76.76958499999991;8.27958400000006,-76.76958499999991;8.27958400000006,-76.7698579999999;8.279030000000031,-76.7698579999999;8.279030000000031,-76.770141;8.278194000000161,-76.770141;8.278194000000161,-76.7704169999999;8.27791800000006,-76.7704169999999;8.27791800000006,-76.7706899999999;8.27680800000002,-76.7706899999999;8.27680800000002,-76.770973;8.276527000000041,-76.770973;8.276527000000041,-76.7712479999999;8.275696000000041,-76.7712479999999;8.275696000000041,-76.771531;8.27458299999995,-76.771531;8.27458600000006,-76.771805;8.274030000000041,-76.771805;8.274030000000041,-76.7720869999999;8.27374900000007,-76.7720869999999;8.27374900000007,-76.772361;8.27319500000004,-76.772361;8.27319500000004,-76.77263600000001;8.27236100000016,-76.77263600000001;8.27236100000016,-76.7729189999999;8.271807000000139,-76.7729189999999;8.271807000000139,-76.77319299999991;8.27125099999995,-76.77319299999991;8.27125099999995,-76.77347500000001;8.270417000000069,-76.77347500000001;8.270417000000069,-76.77375099999991;8.26930500000009,-76.77375099999991;8.26930500000009,-76.7740239999999;8.269026999999991,-76.7740239999999;8.269026999999991,-76.77430699999999;8.266693000000149,-76.77430699999999;8.26652900000005,-76.77430699999999;8.26652900000005,-76.77458299999989;8.266248999999959,-76.77458299999989;8.266248999999959,-76.77430699999999;8.264582999999959,-76.77430699999999;8.264582999999959,-76.7740239999999;8.263195000000049,-76.7740239999999;8.263195000000049,-76.77375099999991;8.262641000000089,-76.77375099999991;8.262641000000089,-76.77347500000001;8.26208500000007,-76.77347500000001;8.26208500000007,-76.77319299999991;8.26125000000008,-76.77319299999991;8.26125000000008,-76.7729189999999;8.26069400000006,-76.7729189999999;8.26069400000006,-76.77263600000001;8.260416000000021,-76.77263600000001;8.26041900000007,-76.772361;8.260138000000101,-76.772361;8.260138000000101,-76.7720869999999;8.25986,-76.7720869999999;8.259862,-76.771805;8.25958400000007,-76.771805;8.25958400000007,-76.771531;8.259305999999979,-76.771531;8.259305999999979,-76.7712479999999;8.259028000000059,-76.7712479999999;8.259028000000059,-76.7706899999999;8.258750000000021,-76.7706899999999;8.258750000000021,-76.7704169999999;8.258472000000101,-76.7704169999999;8.258472000000101,-76.7698579999999;8.258194,-76.7698579999999;8.258194,-76.7693019999999;8.25791600000008,-76.7693019999999;8.25791600000008,-76.769029;8.257637999999989,-76.769029;8.257639999999981,-76.76846999999989;8.257362000000059,-76.76846999999989;8.257362000000059,-76.76791399999991;8.257082000000031,-76.76791399999991;8.257082000000031,-76.76747899999999;8.25708400000002,-76.767365;8.256806000000101,-76.767365;8.256806000000101,-76.766806;8.256527999999999,-76.766806;8.256527999999999,-76.7662499999999;8.25625000000008,-76.7662499999999;8.25625000000008,-76.7656939999999;8.255971999999989,-76.7656939999999;8.255971999999989,-76.7651359999999;8.255694000000121,-76.7651359999999;8.255694000000121,-76.76486199999989;8.255416000000031,-76.76486199999989;8.25541800000002,-76.76374799999989;8.2551400000001,-76.76374799999989;8.2551400000001,-76.762642;8.254861999999999,-76.762642;8.254861999999999,-76.7623599999999;8.254584000000079,-76.7623599999999;8.254584000000079,-76.7620839999999;8.254305999999991,-76.7620839999999;8.25430799999998,-76.7615279999999;8.25375000000003,-76.7615279999999;8.25375000000003,-76.76125399999989;8.2534720000001,-76.76125399999989;8.2534720000001,-76.7606959999999;8.252639999999991,-76.7606959999999;8.252639999999991,-76.7604129999999;8.2518060000001,-76.7604129999999;8.2518060000001,-76.76013999999989;8.251528000000009,-76.76013999999989;8.251528000000009,-76.75986399999989;8.249862000000009,-76.75986399999989;8.249862000000009,-76.7595819999999;8.248196000000011,-76.7595819999999;8.248196000000011,-76.759308;8.24736100000001,-76.759308;8.24736100000001,-76.7595819999999;8.24680500000005,-76.7595819999999;8.24680500000005,-76.75986399999989;8.246249000000031,-76.75986399999989;8.246249000000031,-76.7595819999999;8.24513900000005,-76.7595819999999;8.24513900000005,-76.75902499999999;8.24486100000013,-76.75902499999999;8.24486100000013,-76.7587519999999;8.24374900000015,-76.7587519999999;8.24374900000015,-76.75846899999991;8.24347300000005,-76.75846899999991;8.24347300000005,-76.7579199999999;8.24319500000013,-76.7579199999999;8.24319500000013,-76.7576369999999;8.242917000000031,-76.7576369999999;8.242917000000031,-76.7573619999999;8.242639000000111,-76.7573619999999;8.242639000000111,-76.757079;8.24236100000002,-76.757079;8.24236100000002,-76.7568059999999;8.241527000000129,-76.7568059999999;8.241527000000129,-76.7565299999999;8.240973000000111,-76.7565299999999;8.240973000000111,-76.7562489999999;8.24069500000002,-76.7562489999999;8.24069500000002,-76.7559739999999;8.240141000000049,-76.7559739999999;8.240141000000049,-76.755691;8.23958500000003,-76.755691;8.23958500000003,-76.75541799999991;8.237638999999939,-76.75541799999991;8.237638999999939,-76.75514199999991;8.23625100000004,-76.75514199999991;8.23625100000004,-76.754859;8.235972999999939,-76.754859;8.235972999999939,-76.75514199999991;8.23541600000004,-76.75514199999991;8.23541600000004,-76.754859;8.235137999999949,-76.754859;8.235141000000061,-76.7545859999999;8.230972000000071,-76.7545859999999;8.230972000000071,-76.754859;8.23041600000005,-76.754859;8.23041600000005,-76.7545859999999;8.23013799999995,-76.7545859999999;8.23013799999995,-76.754859;8.228194000000091,-76.754859;8.228194000000091,-76.7545859999999;8.224862000000091,-76.7545859999999;8.224862000000091,-76.754859;8.221526999999981,-76.754859;8.22153000000009,-76.75514199999991;8.22124900000011,-76.75514199999991;8.22124900000011,-76.754859;8.2190270000001,-76.754859;8.2190270000001,-76.7545859999999;8.218473000000071,-76.7545859999999;8.218473000000071,-76.75430299999989;8.218192999999991,-76.75430299999989;8.21819499999998,-76.75402699999999;8.21791700000011,-76.75402699999999;8.21791700000011,-76.7537539999999;8.21763900000002,-76.7537539999999;8.21763900000002,-76.752915;8.2173610000001,-76.752915;8.2173610000001,-76.752357;8.217083000000001,-76.752357;8.217083000000001,-76.7520829999999;8.21652899999998,-76.7520829999999;8.21652899999998,-76.7518069999999;8.21597300000002,-76.7518069999999;8.21597300000002,-76.751525;8.2156950000001,-76.751525;8.2156950000001,-76.7512509999999;8.214027000000099,-76.7512509999999;8.214027000000099,-76.7509689999999;8.212639000000021,-76.7509689999999;8.212639000000021,-76.75069499999999;8.211528999999979,-76.75069499999999;8.211528999999979,-76.7509689999999;8.21013900000008,-76.7509689999999;8.21013900000008,-76.75069499999999;8.209029000000101,-76.75069499999999;8.209029000000101,-76.75041899999989;8.20875100000001,-76.75041899999989;8.20875100000001,-76.7501369999999;8.20791600000001,-76.7501369999999;8.20791600000001,-76.74986299999991;8.207084000000121,-76.74986299999991;8.207084000000121,-76.74958100000001;8.20625000000001,-76.74958100000001;8.20625000000001,-76.74930499999989;8.205694000000049,-76.74930499999989;8.205694000000049,-76.7490309999999;8.204306000000139,-76.7490309999999;8.204306000000139,-76.748749;8.20125000000002,-76.748749;8.20125000000002,-76.74847299999991;8.199584000000019,-76.74847299999991;8.199584000000019,-76.748749;8.19736200000006,-76.748749;8.19736200000006,-76.74847299999991;8.195971000000039,-76.74847299999991;8.195971000000039,-76.748749;8.19486100000006,-76.748749;8.19486100000006,-76.74847299999991;8.194305000000041,-76.74847299999991;8.194305000000041,-76.748193;8.19374900000008,-76.748193;8.19374900000008,-76.747917;8.193471000000161,-76.747917;8.19347300000015,-76.7476429999999;8.19319500000006,-76.7476429999999;8.19319500000006,-76.747361;8.19291700000014,-76.747361;8.19292000000002,-76.7470849999999;8.192364000000049,-76.7470849999999;8.192364000000049,-76.7468019999999;8.19180700000015,-76.7468019999999;8.19180700000015,-76.746529;8.191527000000059,-76.746529;8.191527000000059,-76.746246;8.19069499999995,-76.746246;8.190698000000051,-76.7459709999999;8.19041700000008,-76.7459709999999;8.19041700000008,-76.74569700000001;8.189861000000059,-76.74569700000001;8.189861000000059,-76.745414;8.187639000000051,-76.745414;8.187639000000051,-76.7451409999999;8.186804999999991,-76.7451409999999;8.186804999999991,-76.74485799999999;8.18430500000011,-76.74485799999999;8.18430500000011,-76.74458300000001;8.18236000000007,-76.74458300000001;8.18236000000007,-76.7443089999999;8.18208199999998,-76.7443089999999;8.18208199999998,-76.74458300000001;8.18180699999999,-76.74458300000001;8.18180699999999,-76.7443089999999;8.181250000000089,-76.7443089999999;8.181250000000089,-76.74402600000001;8.18069400000007,-76.74402600000001;8.18069400000007,-76.743751;8.18041599999998,-76.743751;8.180419000000089,-76.7434699999999;8.179862000000011,-76.7434699999999;8.179862000000011,-76.743195;8.17874999999998,-76.743195;8.17874999999998,-76.7434699999999;8.178472000000109,-76.7434699999999;8.178472000000109,-76.743195;8.178194000000021,-76.743195;8.178194000000021,-76.742919;8.176806000000109,-76.742919;8.176806000000109,-76.7426379999999;8.175972,-76.7426379999999;8.175972,-76.74208;8.17513800000012,-76.74208;8.17513800000012,-76.7418069999999;8.174584000000101,-76.7418069999999;8.174584000000101,-76.741531;8.174306,-76.741531;8.174306,-76.741248;8.17402800000008,-76.741248;8.17402800000008,-76.74097499999991;8.173750000000039,-76.74097499999991;8.173750000000039,-76.740692;8.17319600000002,-76.740692;8.17319600000002,-76.740419;8.17236200000008,-76.740419;8.17236200000008,-76.74013599999989;8.17069400000014,-76.74013599999989;8.17069400000014,-76.73985999999999;8.170418000000041,-76.73985999999999;8.170418000000041,-76.739587;8.1695840000001,-76.739587;8.1695840000001,-76.73930399999991;8.168748999999931,-76.73930399999991;8.168748999999931,-76.73902800000001;8.16791500000005,-76.73902800000001;8.16791500000005,-76.73930399999991;8.16541699999993,-76.73930399999991;8.16541699999993,-76.739587;8.165139000000011,-76.739587;8.165139000000011,-76.73930399999991;8.164861000000141,-76.73930399999991;8.164861000000141,-76.739587;8.16347300000001,-76.739587;8.16347300000001,-76.73930399999991;8.16180500000007,-76.73930399999991;8.16180500000007,-76.739587;8.16041699999994,-76.739587;8.16041699999994,-76.73985999999999;8.15874899999994,-76.73985999999999;8.15874899999994,-76.74013599999989;8.15847300000007,-76.74013599999989;8.15847300000007,-76.73985999999999;8.15819500000015,-76.73985999999999;8.15819500000015,-76.74013599999989;8.15652600000004,-76.74013599999989;8.15652600000004,-76.740419;8.155695000000041,-76.740419;8.155695000000041,-76.740692;8.154585000000051,-76.740692;8.154585000000051,-76.74097499999991;8.153750000000059,-76.74097499999991;8.153750000000059,-76.741248;8.15236000000016,-76.741248;8.152362000000149,-76.741531;8.15152800000004,-76.741531;8.15152800000004,-76.7418069999999;8.14986200000004,-76.7418069999999;8.14986200000004,-76.74208;8.149306000000079,-76.74208;8.149306000000079,-76.742363;8.14875000000006,-76.742363;8.14875000000006,-76.7426379999999;8.14847199999997,-76.7426379999999;8.148473999999959,-76.742363;8.1481940000001,-76.742363;8.1481940000001,-76.7426379999999;8.14708400000006,-76.7426379999999;8.14708400000006,-76.742919;8.146250000000011,-76.742919;8.146250000000011,-76.7426379999999;8.14402799999999,-76.7426379999999;8.14402799999999,-76.742919;8.143193,-76.742919;8.143193,-76.743195;8.14208400000007,-76.743195;8.14208400000007,-76.7434699999999;8.14069599999999,-76.7434699999999;8.14069599999999,-76.743751;8.14013900000009,-76.743751;8.14013900000009,-76.74402600000001;8.13874900000002,-76.74402600000001;8.13875100000001,-76.7443089999999;8.138195,-76.7443089999999;8.138195,-76.74458300000001;8.137639000000039,-76.74458300000001;8.137639000000039,-76.74485799999999;8.13736100000011,-76.74485799999999;8.13736100000011,-76.7451409999999;8.13708300000002,-76.7451409999999;8.13708300000002,-76.745414;8.135973000000041,-76.745414;8.135973000000041,-76.74569700000001;8.13541700000002,-76.74569700000001;8.13541700000002,-76.7459709999999;8.135139000000089,-76.7459709999999;8.135139000000089,-76.746246;8.134583000000131,-76.746246;8.134583000000131,-76.746529;8.13375100000002,-76.746529;8.13375100000002,-76.7468019999999;8.133195000000001,-76.7468019999999;8.133195000000001,-76.7470849999999;8.13263900000004,-76.7470849999999;8.13263900000004,-76.747361;8.131805000000099,-76.747361;8.131805000000099,-76.7476429999999;8.13125100000013,-76.7476429999999;8.13125100000013,-76.747917;8.13097300000004,-76.747917;8.13097300000004,-76.748193;8.13069500000012,-76.748193;8.13069500000012,-76.74847299999991;8.130417000000021,-76.74847299999991;8.130419000000019,-76.748749;8.129863,-76.748749;8.129863,-76.7490309999999;8.129582000000029,-76.7490309999999;8.129582000000029,-76.74958100000001;8.12930700000004,-76.74958100000001;8.12930700000004,-76.74986299999991;8.128751000000021,-76.74986299999991;8.128751000000021,-76.7501369999999;8.128473000000101,-76.7501369999999;8.128473000000101,-76.75041899999989;8.127916000000029,-76.75041899999989;8.127916000000029,-76.75069499999999;8.12763799999993,-76.75069499999999;8.12764100000004,-76.7509689999999;8.127360000000071,-76.7509689999999;8.127360000000071,-76.7512509999999;8.127085000000021,-76.7512509999999;8.127085000000021,-76.751525;8.12680400000005,-76.751525;8.12680400000005,-76.7518069999999;8.126528000000119,-76.7518069999999;8.126528000000119,-76.7520829999999;8.126250000000031,-76.7520829999999;8.126250000000031,-76.752357;8.1259720000001,-76.752357;8.1259720000001,-76.7526389999999;8.12541600000014,-76.7526389999999;8.12541600000014,-76.7527529999999;8.12541600000014,-76.752915;8.12513800000005,-76.752915;8.12513800000005,-76.7531979999999;8.12486000000013,-76.7531979999999;8.124862000000119,-76.75347099999991;8.1243060000001,-76.75347099999991;8.1243060000001,-76.7537539999999;8.12319400000013,-76.7537539999999;8.12319400000013,-76.75402699999999;8.12236200000007,-76.75402699999999;8.12236200000007,-76.75430299999989;8.12208400000014,-76.75430299999989;8.12208400000014,-76.75514199999991;8.121528000000129,-76.75514199999991;8.121528000000129,-76.755691;8.12097199999994,-76.755691;8.12097199999994,-76.75541799999991;8.12041600000015,-76.75541799999991;8.12041600000015,-76.75514199999991;8.120140000000051,-76.75514199999991;8.120140000000051,-76.754859;8.11958400000003,-76.754859;8.11958400000003,-76.7545859999999;8.11819399999996,-76.7545859999999;8.11819399999996,-76.75430299999989;8.117084000000149,-76.75430299999989;8.117084000000149,-76.75402699999999;8.11652799999996,-76.75402699999999;8.11652799999996,-76.75347099999991;8.11597100000006,-76.75347099999991;8.11597100000006,-76.7531979999999;8.115418000000149,-76.7531979999999;8.115418000000149,-76.752915;8.11486199999996,-76.752915;8.11486199999996,-76.7526389999999;8.114583000000151,-76.7526389999999;8.114583000000151,-76.752357;8.11430500000006,-76.752357;8.11430500000006,-76.7520829999999;8.114026999999959,-76.7520829999999;8.114030000000071,-76.7518069999999;8.1137490000001,-76.7518069999999;8.1137490000001,-76.751525;8.113471000000001,-76.751525;8.11347400000005,-76.7512509999999;8.113195000000079,-76.7512509999999;8.113195000000079,-76.7509689999999;8.112917000000151,-76.7509689999999;8.112917000000151,-76.75069499999999;8.11263900000006,-76.75069499999999;8.11263900000006,-76.75041899999989;8.112360999999961,-76.75041899999989;8.112360999999961,-76.7501369999999;8.11180800000005,-76.7501369999999;8.11180800000005,-76.74986299999991;8.111527000000081,-76.74986299999991;8.111527000000081,-76.74958100000001;8.111249000000161,-76.74958100000001;8.11125100000015,-76.74930499999989;8.11097300000006,-76.74930499999989;8.11097300000006,-76.7490309999999;8.110694999999961,-76.7490309999999;8.11069800000007,-76.748749;8.110139,-76.748749;8.110139,-76.74847299999991;8.108473,-76.74847299999991;8.108473,-76.748193;8.10791900000015,-76.748193;8.10791900000015,-76.74847299999991;8.107639000000059,-76.74847299999991;8.107639000000059,-76.748193;8.106248999999989,-76.748193;8.106248999999989,-76.747917;8.105694999999971,-76.747917;8.105694999999971,-76.7476429999999;8.10513900000001,-76.7476429999999;8.10513900000001,-76.74750399999991;8.10513900000001,-76.747361;8.10486100000008,-76.747361;8.10486100000008,-76.7470849999999;8.104582999999989,-76.7470849999999;8.104582999999989,-76.7468019999999;8.104305000000069,-76.7468019999999;8.104305000000069,-76.746246;8.10402899999997,-76.746246;8.10402899999997,-76.7459709999999;8.10347300000001,-76.7459709999999;8.10347300000001,-76.74569700000001;8.103195000000079,-76.74569700000001;8.103195000000079,-76.745414;8.102916999999991,-76.745414;8.102916999999991,-76.74458300000001;8.102639000000069,-76.74458300000001;8.102639000000069,-76.74402600000001;8.10236000000009,-76.74402600000001;8.10236000000009,-76.743751;8.10180700000001,-76.743751;8.10180700000001,-76.7434699999999;8.10236000000009,-76.7434699999999;8.10236000000009,-76.743195;8.102916999999991,-76.743195;8.102916999999991,-76.743751;8.103195000000079,-76.743751;8.103195000000079,-76.74402600000001;8.1037510000001,-76.74402600000001;8.1037510000001,-76.7443089999999;8.10402899999997,-76.7443089999999;8.10402899999997,-76.74458300000001;8.105694999999971,-76.74458300000001;8.105694999999971,-76.74485799999999;8.106248999999989,-76.74485799999999;8.106248999999989,-76.74569700000001;8.10652700000009,-76.74569700000001;8.10652700000009,-76.7459709999999;8.107083000000101,-76.7459709999999;8.107083000000101,-76.746246;8.10736299999996,-76.746246;8.107360999999971,-76.746529;8.107639000000059,-76.746529;8.107639000000059,-76.7468019999999;8.10791900000015,-76.7468019999999;8.10791700000016,-76.747361;8.10819500000008,-76.747361;8.10819500000008,-76.7470849999999;8.108751000000099,-76.7470849999999;8.108751000000099,-76.7468019999999;8.109028999999961,-76.7468019999999;8.109026999999969,-76.7470849999999;8.10930500000006,-76.7470849999999;8.10930500000006,-76.747361;8.109583000000161,-76.747361;8.109583000000161,-76.7470849999999;8.10986100000008,-76.7470849999999;8.10986100000008,-76.7468019999999;8.110139,-76.7468019999999;8.110139,-76.746529;8.1104170000001,-76.746529;8.1104170000001,-76.746246;8.11069800000007,-76.746246;8.110694999999961,-76.7459709999999;8.11097300000006,-76.7459709999999;8.11097300000006,-76.745414;8.111527000000081,-76.745414;8.111527000000081,-76.74569700000001;8.11180800000005,-76.74569700000001;8.111805,-76.7459709999999;8.1120830000001,-76.7459709999999;8.1120830000001,-76.746246;8.112917000000151,-76.746246;8.112917000000151,-76.7459709999999;8.113195000000079,-76.7459709999999;8.113195000000079,-76.745414;8.114583000000151,-76.745414;8.114583000000151,-76.7451409999999;8.11486199999996,-76.7451409999999;8.11486199999996,-76.74458300000001;8.11514000000005,-76.74458300000001;8.11514000000005,-76.7443089999999;8.115696000000071,-76.7443089999999;8.115696000000071,-76.7434699999999;8.115418000000149,-76.7434699999999;8.115418000000149,-76.7426379999999;8.11514000000005,-76.7426379999999;8.11514000000005,-76.74208;8.11486199999996,-76.74208;8.11486199999996,-76.741531;8.114583000000151,-76.741531;8.114583000000151,-76.741248;8.114030000000071,-76.741248;8.114030000000071,-76.74097499999991;8.1137490000001,-76.74097499999991;8.1137490000001,-76.740692;8.113195000000079,-76.740692;8.113195000000079,-76.740419;8.11263900000006,-76.740419;8.11263900000006,-76.74013599999989;8.1120830000001,-76.74013599999989;8.1120830000001,-76.740419;8.111527000000081,-76.740419;8.111527000000081,-76.74013599999989;8.111249000000161,-76.74013599999989;8.11125100000015,-76.740419;8.11097300000006,-76.740419;8.11097300000006,-76.74013599999989;8.110139,-76.74013599999989;8.110139,-76.73985999999999;8.108473,-76.73985999999999;8.108473,-76.739587;8.10791900000015,-76.739587;8.10791900000015,-76.73930399999991;8.106248999999989,-76.73930399999991;8.106248999999989,-76.739587;8.10486100000008,-76.739587;8.10486100000008,-76.73930399999991;8.10069400000009,-76.73930399999991;8.10069400000009,-76.739587;8.09819400000004,-76.739587;8.09819400000004,-76.73985999999999;8.097640000000011,-76.73985999999999;8.097640000000011,-76.74013599999989;8.097084000000001,-76.74013599999989;8.097084000000001,-76.740419;8.096806000000131,-76.740419;8.096806000000131,-76.740692;8.095972000000019,-76.740692;8.095972000000019,-76.74097499999991;8.09513800000013,-76.74097499999991;8.09513800000013,-76.741248;8.09458400000011,-76.741248;8.09458400000011,-76.741531;8.094306000000021,-76.741531;8.094306000000021,-76.7418069999999;8.09375,-76.7418069999999;8.09375,-76.74208;8.09180600000013,-76.74208;8.09180600000013,-76.742363;8.090418,-76.742363;8.090418,-76.7426379999999;8.089862000000039,-76.7426379999999;8.089862000000039,-76.742363;8.089584000000119,-76.742363;8.089584000000119,-76.7426379999999;8.08791500000007,-76.7426379999999;8.08791500000007,-76.742919;8.08680500000003,-76.742919;8.08680500000003,-76.743195;8.085971000000139,-76.743195;8.08597300000014,-76.742919;8.08319500000016,-76.742919;8.08319500000016,-76.7426379999999;8.082639000000141,-76.7426379999999;8.082639000000141,-76.742363;8.08236100000005,-76.742363;8.08236100000005,-76.74208;8.082082999999949,-76.74208;8.082082999999949,-76.7418069999999;8.081251000000069,-76.7418069999999;8.081251000000069,-76.74208;8.08069500000005,-76.74208;8.08069500000005,-76.742363;8.07986099999999,-76.742363;8.07986099999999,-76.7426379999999;8.078748999999959,-76.7426379999999;8.078748999999959,-76.742919;8.07819499999999,-76.742919;8.07819499999999,-76.743195;8.07791700000007,-76.743195;8.077919000000071,-76.742919;8.07736300000005,-76.742919;8.07736300000005,-76.7426379999999;8.077082999999959,-76.7426379999999;8.077082999999959,-76.742363;8.07652600000006,-76.742363;8.07652600000006,-76.74208;8.07625100000007,-76.74208;8.07625100000007,-76.742363;8.075695000000049,-76.742363;8.075695000000049,-76.7426379999999;8.075141000000031,-76.7426379999999;8.075141000000031,-76.742919;8.07486000000006,-76.742919;8.07486000000006,-76.7426379999999;8.07458199999996,-76.7426379999999;8.07458500000007,-76.742919;8.074029000000049,-76.742919;8.074029000000049,-76.743195;8.07319400000006,-76.743195;8.07319400000006,-76.7434699999999;8.071528000000059,-76.7434699999999;8.071528000000059,-76.743751;8.070540999999929,-76.743751;8.069306000000101,-76.743751;8.069306000000101,-76.74402600000001;8.065416000000081,-76.74402600000001;8.065416000000081,-76.743751;8.06486200000006,-76.743751;8.06486200000006,-76.7434699999999;8.06458400000002,-76.7434699999999;8.06458400000002,-76.743195;8.0643060000001,-76.743195;8.0643060000001,-76.7426379999999;8.06458400000002,-76.7426379999999;8.06458400000002,-76.7418069999999;8.06486200000006,-76.7418069999999;8.06486200000006,-76.741248;8.06458400000002,-76.741248;8.06458400000002,-76.73902800000001;8.06486200000006,-76.73902800000001;8.06486200000006,-76.73874599999991;8.06625000000003,-76.73874599999991;8.06625000000003,-76.7384719999999;8.06652800000006,-76.7384719999999;8.06652800000006,-76.738196;8.066808000000149,-76.738196;8.066808000000149,-76.737084;8.06652800000006,-76.737084;8.06652800000006,-76.7368079999999;8.06625000000003,-76.7368079999999;8.06625000000003,-76.736526;8.0659720000001,-76.736526;8.0659720000001,-76.73625199999999;8.06569400000001,-76.73625199999999;8.06569400000001,-76.7359699999999;8.0659720000001,-76.7359699999999;8.0659720000001,-76.73542000000001;8.06625000000003,-76.73542000000001;8.06625000000003,-76.734864;8.06652800000006,-76.734864;8.06652800000006,-76.734582;8.067084000000079,-76.734582;8.067084000000079,-76.7343059999999;8.069027999999999,-76.7343059999999;8.069027999999999,-76.73402299999989;8.069306000000101,-76.73402299999989;8.069306000000101,-76.7343059999999;8.07014000000015,-76.7343059999999;8.070137999999989,-76.73402299999989;8.07041600000008,-76.73402299999989;8.07041600000008,-76.7334739999999;8.070694,-76.7334739999999;8.070694,-76.73319099999991;8.070972000000101,-76.73319099999991;8.070972000000101,-76.732918;8.07124999999996,-76.732918;8.07124999999996,-76.7326349999999;8.072363000000051,-76.7326349999999;8.072363000000051,-76.732918;8.07291900000007,-76.732918;8.07291900000007,-76.73319099999991;8.07347200000015,-76.73319099999991;8.07347200000015,-76.7334739999999;8.07430700000015,-76.7334739999999;8.07430700000015,-76.73375;8.07486000000006,-76.73375;8.07486000000006,-76.73402299999989;8.075695000000049,-76.73402299999989;8.075695000000049,-76.73375;8.07625100000007,-76.73375;8.07625100000007,-76.7334739999999;8.077082999999959,-76.7334739999999;8.077082999999959,-76.73375;8.080139000000029,-76.73375;8.080139000000029,-76.73402299999989;8.081251000000069,-76.73402299999989;8.081251000000069,-76.7343059999999;8.081526999999991,-76.7343059999999;8.081526999999991,-76.734582;8.082082999999949,-76.734582;8.082082999999949,-76.734864;8.082639000000141,-76.734864;8.082639000000141,-76.73513799999991;8.08375100000012,-76.73513799999991;8.08375100000012,-76.73542000000001;8.084307000000139,-76.73542000000001;8.084307000000139,-76.735694;8.08486100000016,-76.735694;8.08486100000016,-76.7359699999999;8.08569500000004,-76.7359699999999;8.08569500000004,-76.73625199999999;8.08597300000014,-76.73625199999999;8.085971000000139,-76.736526;8.08736100000004,-76.736526;8.08736100000004,-76.73625199999999;8.088196000000041,-76.73625199999999;8.088196000000041,-76.7359699999999;8.0890280000001,-76.7359699999999;8.0890280000001,-76.735694;8.089862000000039,-76.735694;8.089862000000039,-76.7359699999999;8.09125000000012,-76.7359699999999;8.09125000000012,-76.735694;8.091530000000031,-76.735694;8.091530000000031,-76.73513799999991;8.09125000000012,-76.73513799999991;8.09125000000012,-76.734864;8.0906940000001,-76.734864;8.0906940000001,-76.734582;8.089862000000039,-76.734582;8.089862000000039,-76.73375;8.089584000000119,-76.73375;8.089584000000119,-76.7334739999999;8.0890280000001,-76.7334739999999;8.0890280000001,-76.73319099999991;8.088749000000121,-76.73319099999991;8.088752,-76.7326349999999;8.088196000000041,-76.7326349999999;8.088196000000041,-76.732362;8.08764000000002,-76.732362;8.08764000000002,-76.732086;8.08736100000004,-76.732086;8.08736100000004,-76.7318029999999;8.08680500000003,-76.7318029999999;8.08680500000003,-76.73153000000001;8.08624900000007,-76.73153000000001;8.08624900000007,-76.7312469999999;8.08569500000004,-76.7312469999999;8.08569500000004,-76.7309719999999;8.08513900000003,-76.7309719999999;8.08513900000003,-76.730698;8.08486100000016,-76.730698;8.08486100000016,-76.73013999999991;8.08513900000003,-76.73013999999991;8.08513900000003,-76.72985899999991;8.08541700000012,-76.72985899999991;8.08541700000012,-76.729584;8.08624900000007,-76.729584;8.08624900000007,-76.7293099999999;8.08680500000003,-76.7293099999999;8.08680500000003,-76.728752;8.087085999999999,-76.728752;8.087085999999999,-76.72846899999991;8.08680500000003,-76.72846899999991;8.08680500000003,-76.728196;8.08624900000007,-76.728196;8.08624900000007,-76.7279129999999;8.085971000000139,-76.7279129999999;8.08597300000014,-76.7276369999999;8.08569500000004,-76.7276369999999;8.08569500000004,-76.72736399999999;8.08541700000012,-76.72736399999999;8.08541700000012,-76.7270809999999;8.08486100000016,-76.7270809999999;8.08486100000016,-76.72680799999991;8.08458300000007,-76.72680799999991;8.08458300000007,-76.7265249999999;8.084027000000051,-76.7265249999999;8.084027000000051,-76.7262489999999;8.083748999999949,-76.7262489999999;8.08375100000012,-76.7259759999999;8.08347300000003,-76.7259759999999;8.08347300000003,-76.72569299999989;8.08319500000016,-76.72569299999989;8.08319500000016,-76.72541699999989;8.082917000000069,-76.72541699999989;8.082917000000069,-76.72486099999991;8.082639000000141,-76.72486099999991;8.082639000000141,-76.7243049999999;8.08236100000005,-76.7243049999999;8.08236100000005,-76.7240289999999;8.081805000000029,-76.7240289999999;8.081805000000029,-76.7237469999999;8.081251000000069,-76.7237469999999;8.081251000000069,-76.7234729999999;8.080973000000141,-76.7234729999999;8.080973000000141,-76.723197;8.080416999999949,-76.723197;8.080416999999949,-76.7229149999999;8.07986099999999,-76.7229149999999;8.07986099999999,-76.7226409999999;8.079305000000151,-76.7226409999999;8.079305000000151,-76.7223589999999;8.07902900000005,-76.7223589999999;8.07902900000005,-76.7220829999999;8.07791700000007,-76.7220829999999;8.077919000000071,-76.7218029999999;8.07625100000007,-76.7218029999999;8.07625100000007,-76.7215269999999;8.075416999999961,-76.7215269999999;8.075416999999961,-76.72125299999991;8.07513800000015,-76.72125299999991;8.075141000000031,-76.72097099999991;8.07430700000015,-76.72097099999991;8.07430700000015,-76.72125299999991;8.074029000000049,-76.72125299999991;8.074029000000049,-76.7215269999999;8.07291900000007,-76.7215269999999;8.07291900000007,-76.7218029999999;8.072638000000101,-76.7218029999999;8.072638000000101,-76.7215269999999;8.07180600000015,-76.7215269999999;8.07180600000015,-76.7218029999999;8.070972000000101,-76.7218029999999;8.070972000000101,-76.7215269999999;8.070694,-76.7215269999999;8.070694,-76.72125299999991;8.07041600000008,-76.72125299999991;8.07041600000008,-76.72069499999991;8.069862000000059,-76.72069499999991;8.069862000000059,-76.720412;8.069027999999999,-76.720412;8.069027999999999,-76.7201389999999;8.068471999999989,-76.7201389999999;8.068471999999989,-76.7198629999999;8.068194000000061,-76.7198629999999;8.068194000000061,-76.71957999999999;8.067916000000031,-76.71957999999999;8.06791799999996,-76.7193069999999;8.0676400000001,-76.7193069999999;8.0676400000001,-76.71902399999991;8.06736000000001,-76.71902399999991;8.067361999999999,-76.7187509999999;8.066808000000149,-76.7187509999999;8.066808000000149,-76.7184749999999;8.06652800000006,-76.7184749999999;8.06652800000006,-76.7181919999999;8.06625000000003,-76.7181919999999;8.06625000000003,-76.7179189999999;8.0659720000001,-76.7179189999999;8.0659720000001,-76.717636;8.06569400000001,-76.717636;8.06569400000001,-76.7173609999999;8.065139999999991,-76.7173609999999;8.065139999999991,-76.71708699999991;8.06486200000006,-76.71708699999991;8.06486200000006,-76.716804;8.06458400000002,-76.716804;8.06458400000002,-76.7165289999999;8.064028000000009,-76.7165289999999;8.064028000000009,-76.71624799999999;8.0626400000001,-76.71624799999999;8.0626400000001,-76.71597299999991;8.06013900000011,-76.71597299999991;8.06013900000011,-76.71624799999999;8.058193000000021,-76.71624799999999;8.058193000000021,-76.7165289999999;8.056805000000111,-76.7165289999999;8.056805000000111,-76.716804;8.055972999999989,-76.716804;8.055972999999989,-76.7165289999999;8.055417000000031,-76.7165289999999;8.055417000000031,-76.716804;8.054306999999991,-76.716804;8.054306999999991,-76.71708699999991;8.05375100000003,-76.71708699999991;8.05375100000003,-76.7173609999999;8.05319500000002,-76.7173609999999;8.05319500000002,-76.717636;8.05263900000006,-76.717636;8.05263900000006,-76.7173609999999;8.051251000000089,-76.7173609999999;8.051251000000089,-76.717636;8.049307000000059,-76.717636;8.049307000000059,-76.7179189999999;8.04847300000012,-76.7179189999999;8.04847300000012,-76.7181919999999;8.045416000000159,-76.7181919999999;8.04541900000004,-76.7184749999999;8.044862000000141,-76.7184749999999;8.044862000000141,-76.7187509999999;8.044305999999951,-76.7187509999999;8.044305999999951,-76.71902399999991;8.044028000000029,-76.71902399999991;8.044028000000029,-76.7193069999999;8.043472000000071,-76.7193069999999;8.043472000000071,-76.71902399999991;8.04263799999995,-76.71902399999991;8.04263799999995,-76.7193069999999;8.04180600000007,-76.7193069999999;8.04180600000007,-76.71957999999999;8.04152800000014,-76.71957999999999;8.04152800000014,-76.7198629999999;8.040694000000091,-76.7198629999999;8.040694000000091,-76.720412;8.04041599999999,-76.720412;8.04041599999999,-76.72069499999991;8.03986000000015,-76.72069499999991;8.03986200000014,-76.72097099999991;8.039584000000049,-76.72097099999991;8.039584000000049,-76.72125299999991;8.03930599999995,-76.72125299999991;8.03930599999995,-76.7215269999999;8.03874999999999,-76.7215269999999;8.03874999999999,-76.7218029999999;8.03819400000015,-76.7218029999999;8.03819400000015,-76.7220829999999;8.037918000000049,-76.7220829999999;8.037918000000049,-76.7223589999999;8.037362000000091,-76.7223589999999;8.037362000000091,-76.7226409999999;8.03708399999999,-76.7226409999999;8.03708399999999,-76.723197;8.037362000000091,-76.723197;8.037362000000091,-76.7234729999999;8.03763799999996,-76.7234729999999;8.03763799999996,-76.7237469999999;8.037918000000049,-76.7237469999999;8.037918000000049,-76.7240289999999;8.03819400000015,-76.7240289999999;8.03819400000015,-76.72458499999991;8.037918000000049,-76.72458499999991;8.037918000000049,-76.72486099999991;8.037362000000091,-76.72486099999991;8.037362000000091,-76.7251349999999;8.03680600000007,-76.7251349999999;8.03680600000007,-76.72541699999989;8.03652800000015,-76.72541699999989;8.03652800000015,-76.72569299999989;8.036250000000051,-76.72569299999989;8.036252000000051,-76.7259759999999;8.03597199999996,-76.7259759999999;8.03597199999996,-76.7262489999999;8.035692999999981,-76.7262489999999;8.035692999999981,-76.7276369999999;8.03597199999996,-76.7276369999999;8.03597199999996,-76.728196;8.036252000000051,-76.728196;8.036250000000051,-76.72846899999991;8.03652800000015,-76.72846899999991;8.03652800000015,-76.728752;8.03680600000007,-76.728752;8.03680600000007,-76.7290269999999;8.03708399999999,-76.7290269999999;8.03708399999999,-76.72985899999991;8.037362000000091,-76.72985899999991;8.037362000000091,-76.73041499999989;8.03708399999999,-76.73041499999989;8.03708399999999,-76.7309719999999;8.03680600000007,-76.7309719999999;8.03680600000007,-76.73153000000001;8.03652800000015,-76.73153000000001;8.03652800000015,-76.7320179999999;8.03652800000015,-76.732362;8.03680600000007,-76.732362;8.03680600000007,-76.7326349999999;8.037362000000091,-76.7326349999999;8.037362000000091,-76.732918;8.03763799999996,-76.732918;8.03763799999996,-76.73319099999991;8.037918000000049,-76.73319099999991;8.037918000000049,-76.7334739999999;8.03819400000015,-76.7334739999999;8.03819400000015,-76.735694;8.03847200000007,-76.735694;8.03847200000007,-76.73625199999999;8.03819400000015,-76.73625199999999;8.03819400000015,-76.7368079999999;8.03680600000007,-76.7368079999999;8.03680600000007,-76.736526;8.03652800000015,-76.736526;8.03652800000015,-76.73625199999999;8.036250000000051,-76.73625199999999;8.036252000000051,-76.7359699999999;8.03597199999996,-76.7359699999999;8.03597199999996,-76.734864;8.035692999999981,-76.734864;8.03569600000009,-76.7343059999999;8.035417999999989,-76.7343059999999;8.035417999999989,-76.73402299999989;8.03486200000015,-76.73402299999989;8.03486200000015,-76.73375;8.03458400000005,-76.73375;8.03458400000005,-76.7334739999999;8.034305000000071,-76.7334739999999;8.034305000000071,-76.732918;8.033749000000061,-76.732918;8.033749000000061,-76.732362;8.03347100000002,-76.732362;8.033474000000069,-76.7318029999999;8.033196000000149,-76.7318029999999;8.033196000000149,-76.73153000000001;8.032916999999999,-76.73153000000001;8.032916999999999,-76.730698;8.032639000000071,-76.730698;8.032639000000071,-76.73041499999989;8.032083000000061,-76.73041499999989;8.032083000000061,-76.72985899999991;8.03180500000002,-76.72985899999991;8.031808000000069,-76.7293099999999;8.0315270000001,-76.7293099999999;8.0315270000001,-76.7290269999999;8.031249000000001,-76.7290269999999;8.031250999999999,-76.728752;8.030973000000071,-76.728752;8.030973000000071,-76.728196;8.030692999999991,-76.728196;8.03069499999998,-76.7279129999999;8.03041700000006,-76.7279129999999;8.03041700000006,-76.7276369999999;8.029305000000081,-76.7276369999999;8.029305000000081,-76.7279129999999;8.02875100000006,-76.7279129999999;8.02875100000006,-76.728196;8.0281950000001,-76.728196;8.0281950000001,-76.728752;8.027917,-76.728752;8.027917,-76.7290269999999;8.027639000000081,-76.7290269999999;8.027639000000081,-76.7293099999999;8.02708300000012,-76.7293099999999;8.02708300000012,-76.729584;8.026527000000099,-76.729584;8.026527000000099,-76.72985899999991;8.026249000000011,-76.72985899999991;8.026251,-76.73013999999991;8.025694999999979,-76.73013999999991;8.025694999999979,-76.73041499999989;8.02541700000012,-76.73041499999989;8.02541700000012,-76.730698;8.025139000000021,-76.730698;8.025139000000021,-76.7309719999999;8.024861000000101,-76.7309719999999;8.024861000000101,-76.73153000000001;8.024583000000011,-76.73153000000001;8.024585,-76.7318029999999;8.02430500000008,-76.7318029999999;8.02430500000008,-76.732086;8.024028999999979,-76.732086;8.024028999999979,-76.732362;8.02375100000012,-76.732362;8.02375100000012,-76.7326349999999;8.023473000000021,-76.7326349999999;8.023473000000021,-76.73319099999991;8.023195000000101,-76.73319099999991;8.023195000000101,-76.7334739999999;8.02291700000001,-76.7334739999999;8.022919,-76.73402299999989;8.02263900000008,-76.73402299999989;8.02263900000008,-76.734582;8.022360999999989,-76.734582;8.022362999999981,-76.734864;8.02208200000001,-76.734864;8.02208200000001,-76.73513799999991;8.02180700000002,-76.73513799999991;8.02180700000002,-76.73542000000001;8.021529000000101,-76.73542000000001;8.021529000000101,-76.735694;8.02097300000008,-76.735694;8.02097300000008,-76.736526;8.02125100000001,-76.736526;8.02125100000001,-76.7368079999999;8.021529000000101,-76.7368079999999;8.021529000000101,-76.737084;8.02208200000001,-76.737084;8.02208200000001,-76.737358;8.022362999999981,-76.737358;8.022360999999989,-76.7376399999999;8.02263900000008,-76.7376399999999;8.02263900000008,-76.738196;8.022919,-76.738196;8.02291700000001,-76.7384719999999;8.023195000000101,-76.7384719999999;8.023195000000101,-76.73930399999991;8.02291700000001,-76.73930399999991;8.022919,-76.739587;8.02180400000009,-76.739587;8.02180700000002,-76.73930399999991;8.02041600000001,-76.73930399999991;8.02041600000001,-76.739587;8.02013800000009,-76.739587;8.02014100000002,-76.73985999999999;8.019860000000049,-76.73985999999999;8.019860000000049,-76.74013599999989;8.01958500000001,-76.74013599999989;8.01958500000001,-76.74097499999991;8.01930400000003,-76.74097499999991;8.01930400000003,-76.741531;8.019028000000111,-76.741531;8.019028000000111,-76.742919;8.01930400000003,-76.742919;8.01930400000003,-76.743751;8.019028000000111,-76.743751;8.019028000000111,-76.74458300000001;8.01875000000001,-76.74458300000001;8.01875000000001,-76.74485799999999;8.01847200000009,-76.74485799999999;8.01847200000009,-76.74569700000001;8.017916000000129,-76.74569700000001;8.017916000000129,-76.74458300000001;8.01763800000003,-76.74458300000001;8.01763800000003,-76.7426379999999;8.01736000000011,-76.7426379999999;8.01736000000011,-76.741248;8.01708200000002,-76.741248;8.01708200000002,-76.740692;8.01680600000009,-76.740692;8.01680600000009,-76.740419;8.016528000000051,-76.740419;8.016528000000051,-76.74013599999989;8.016250000000131,-76.74013599999989;8.016250000000131,-76.73985999999999;8.01597200000003,-76.73985999999999;8.01597200000003,-76.74013599999989;8.01569400000011,-76.74013599999989;8.01569400000011,-76.740419;8.01541600000002,-76.740419;8.015418000000009,-76.740692;8.01430600000003,-76.740692;8.01430600000003,-76.740419;8.013472000000149,-76.740419;8.013472000000149,-76.740692;8.01291600000013,-76.740692;8.01291600000013,-76.74097499999991;8.011806000000149,-76.74097499999991;8.011806000000149,-76.740692;8.010418000000019,-76.740692;8.010418000000019,-76.74097499999991;8.010138000000151,-76.74097499999991;8.010138000000151,-76.741248;8.00958400000013,-76.741248;8.00958400000013,-76.741531;8.00930600000004,-76.741531;8.009308000000029,-76.7418069999999;8.00902799999994,-76.7418069999999;8.00902799999994,-76.74208;8.008750000000021,-76.74208;8.008752000000021,-76.742363;8.008471000000039,-76.742363;8.008471000000039,-76.7426379999999;8.008192999999951,-76.7426379999999;8.00819600000005,-76.742919;8.007915000000081,-76.742919;8.007915000000081,-76.743195;8.00736199999994,-76.743195;8.00736199999994,-76.7434699999999;8.00652699999995,-76.7434699999999;8.00652699999995,-76.7426379999999;8.006805000000041,-76.7426379999999;8.006805000000041,-76.742363;8.00708300000014,-76.742363;8.00708300000014,-76.74208;8.007640000000039,-76.74208;8.007640000000039,-76.7418069999999;8.00819600000005,-76.7418069999999;8.008192999999951,-76.741531;8.008471000000039,-76.741531;8.008471000000039,-76.741248;8.008752000000021,-76.741248;8.008750000000021,-76.74097499999991;8.00902799999994,-76.74097499999991;8.00902799999994,-76.740419;8.009308000000029,-76.740419;8.009308000000029,-76.74013599999989;8.00986200000006,-76.74013599999989;8.00986200000006,-76.73985999999999;8.010138000000151,-76.73985999999999;8.010138000000151,-76.739587;8.010418000000019,-76.739587;8.010418000000019,-76.73930399999991;8.00986200000006,-76.73930399999991;8.00986200000006,-76.739587;8.00958400000013,-76.739587;8.00958400000013,-76.73985999999999;8.008192999999951,-76.73985999999999;8.00819600000005,-76.740419;8.00708300000014,-76.740419;8.00708300000014,-76.73985999999999;8.00736199999994,-76.73985999999999;8.00736199999994,-76.739587;8.007640000000039,-76.739587;8.007640000000039,-76.73930399999991;8.00819600000005,-76.73930399999991;8.008192999999951,-76.73902800000001;8.008471000000039,-76.73902800000001;8.008471000000039,-76.7384719999999;8.008752000000021,-76.7384719999999;8.008750000000021,-76.7376399999999;8.00902799999994,-76.7376399999999;8.00902799999994,-76.737084;8.008750000000021,-76.737084;8.008752000000021,-76.7368079999999;8.008471000000039,-76.7368079999999;8.008471000000039,-76.736526;8.00736199999994,-76.736526;8.00736199999994,-76.7368079999999;8.00708300000014,-76.7368079999999;8.00708300000014,-76.737084;8.006530000000049,-76.737084;8.006530000000049,-76.737358;8.00569599999994,-76.737358;8.00569599999994,-76.7368079999999;8.00541700000014,-76.7368079999999;8.00542000000002,-76.736526;8.005139000000041,-76.736526;8.005139000000041,-76.73625199999999;8.00430500000016,-76.73625199999999;8.004308000000041,-76.736526;8.001805000000051,-76.736526;8.001805000000051,-76.7368079999999;8.000139000000051,-76.7368079999999;8.000139000000051,-76.736526;7.99986099999995,-76.736526;7.99986099999995,-76.73625199999999;7.99958300000009,-76.73625199999999;7.99958300000009,-76.7359699999999;7.999027000000069,-76.7359699999999;7.999027000000069,-76.73542000000001;7.99875100000014,-76.73542000000001;7.99875100000014,-76.734864;7.999027000000069,-76.734864;7.999027000000069,-76.73402299999989;7.99875100000014,-76.73402299999989;7.99875100000014,-76.73319099999991;7.998473000000051,-76.73319099999991;7.998473000000051,-76.732918;7.998194999999951,-76.732918;7.998194999999951,-76.732086;7.997638999999991,-76.732086;7.997638999999991,-76.7318029999999;7.99736100000007,-76.7318029999999;7.99736100000007,-76.73153000000001;7.99680500000005,-76.73153000000001;7.99680500000005,-76.7312469999999;7.99625100000009,-76.7312469999999;7.99625100000009,-76.7309719999999;7.994860000000071,-76.7309719999999;7.994860000000071,-76.730698;7.994029000000071,-76.730698;7.994029000000071,-76.73041499999989;7.993750999999971,-76.73041499999989;7.993750999999971,-76.73013999999991;7.99319400000007,-76.73013999999991;7.99319400000007,-76.72985899999991;7.992360000000021,-76.72985899999991;7.99236300000007,-76.729584;7.99124999999998,-76.729584;7.99124999999998,-76.7293099999999;7.99069400000002,-76.7293099999999;7.99069400000002,-76.7290269999999;7.989583999999979,-76.7290269999999;7.989583999999979,-76.728752;7.989028000000019,-76.728752;7.989028000000019,-76.72846899999991;7.98819400000008,-76.72846899999991;7.98819400000008,-76.728196;7.98763800000012,-76.728196;7.98764000000011,-76.7279129999999;7.986806,-76.7279129999999;7.986806,-76.7276369999999;7.986249999999981,-76.7276369999999;7.986249999999981,-76.72736399999999;7.9854180000001,-76.72736399999999;7.9854180000001,-76.7270809999999;7.98486200000008,-76.7270809999999;7.98486200000008,-76.72680799999991;7.98264000000012,-76.72680799999991;7.98264000000012,-76.7270809999999;7.98236200000002,-76.7270809999999;7.98236200000002,-76.72736399999999;7.980971000000011,-76.72736399999999;7.980971000000011,-76.7276369999999;7.9804180000001,-76.7276369999999;7.9804180000001,-76.7279129999999;7.980140000000011,-76.7279129999999;7.980140000000011,-76.728196;7.97930500000001,-76.728196;7.97930500000001,-76.72846899999991;7.97902700000014,-76.72846899999991;7.97902700000014,-76.728752;7.97847100000013,-76.728752;7.97847100000013,-76.7290269999999;7.977917000000101,-76.7290269999999;7.977917000000101,-76.7293099999999;7.977361000000141,-76.7293099999999;7.977361000000141,-76.729584;7.976805000000131,-76.729584;7.976805000000131,-76.72985899999991;7.976527000000031,-76.72985899999991;7.976527000000031,-76.73013999999991;7.975973000000011,-76.73013999999991;7.975973000000011,-76.72985899999991;7.975417000000051,-76.72985899999991;7.975417000000051,-76.73013999999991;7.97513900000013,-76.73013999999991;7.97513900000013,-76.73041499999989;7.97486100000003,-76.73041499999989;7.97486100000003,-76.730698;7.97458299999994,-76.730698;7.97458299999994,-76.7309719999999;7.97430500000002,-76.7309719999999;7.97430500000002,-76.7312469999999;7.97375100000005,-76.7312469999999;7.97375100000005,-76.73153000000001;7.973473000000129,-76.73153000000001;7.973473000000129,-76.7318029999999;7.973195000000029,-76.7318029999999;7.973195000000029,-76.732086;7.97291699999994,-76.732086;7.97291699999994,-76.732362;7.972639000000021,-76.732362;7.972639000000021,-76.7326349999999;7.97236100000015,-76.7326349999999;7.97236100000015,-76.732918;7.972083000000049,-76.732918;7.972083000000049,-76.7334739999999;7.97180500000013,-76.7334739999999;7.97180500000013,-76.73375;7.971527000000041,-76.73375;7.971527000000041,-76.73402299999989;7.97097300000002,-76.73402299999989;7.97097300000002,-76.7343059999999;7.97069500000015,-76.7343059999999;7.97069500000015,-76.734864;7.97041700000005,-76.734864;7.97041700000005,-76.73513799999991;7.97013900000013,-76.73513799999991;7.97013900000013,-76.735694;7.96986100000004,-76.735694;7.96986100000004,-76.7359699999999;7.96958299999994,-76.7359699999999;7.96958299999994,-76.73625199999999;7.96930500000008,-76.73625199999999;7.96930500000008,-76.736526;7.96902900000015,-76.736526;7.96902900000015,-76.737084;7.968751000000049,-76.737084;7.968751000000049,-76.737358;7.96847300000013,-76.737358;7.96847300000013,-76.7376399999999;7.968195000000041,-76.7376399999999;7.968195000000041,-76.738196;7.96791699999994,-76.738196;7.96791699999994,-76.7384719999999;7.96763800000014,-76.7384719999999;7.96763800000014,-76.73874599999991;7.96736000000004,-76.73874599999991;7.96736000000004,-76.73902800000001;7.967081999999951,-76.73902800000001;7.967081999999951,-76.739587;7.96680400000008,-76.739587;7.96680400000008,-76.73985999999999;7.96652900000004,-76.73985999999999;7.96652900000004,-76.74013599999989;7.96625099999994,-76.74013599999989;7.96625099999994,-76.740419;7.96597200000014,-76.740419;7.96597200000014,-76.74097499999991;7.96569400000004,-76.74097499999991;7.96569400000004,-76.741248;7.96541599999995,-76.741248;7.96541599999995,-76.7418069999999;7.96513800000008,-76.7418069999999;7.96513800000008,-76.74208;7.96486300000004,-76.74208;7.96486300000004,-76.742363;7.96458400000006,-76.742363;7.96458400000006,-76.742919;7.964306000000141,-76.742919;7.964306000000141,-76.7434699999999;7.964028000000041,-76.7434699999999;7.964028000000041,-76.74402600000001;7.96374999999995,-76.74402600000001;7.96374999999995,-76.7443089999999;7.96347200000008,-76.7443089999999;7.96347200000008,-76.74485799999999;7.96319400000016,-76.74485799999999;7.96319400000016,-76.7451409999999;7.96291600000006,-76.7451409999999;7.96291800000006,-76.745414;7.96236200000004,-76.745414;7.96236200000004,-76.74569700000001;7.96152800000016,-76.74569700000001;7.96152800000016,-76.7459709999999;7.95902800000005,-76.7459709999999;7.95902800000005,-76.74569700000001;7.95791600000007,-76.74569700000001;7.95791600000007,-76.745414;7.95680600000009,-76.745414;7.95680600000009,-76.7451409999999;7.95597199999997,-76.7451409999999;7.95597199999997,-76.74485799999999;7.95541800000001,-76.74485799999999;7.95541800000001,-76.74458300000001;7.95486199999999,-76.74458300000001;7.95486199999999,-76.7443089999999;7.95458400000007,-76.7443089999999;7.95458400000007,-76.74402600000001;7.95430599999997,-76.74402600000001;7.95430599999997,-76.743751;7.954026999999999,-76.743751;7.954026999999999,-76.7434699999999;7.95374900000007,-76.7434699999999;7.95374900000007,-76.743195;7.95347099999998,-76.743195;7.95347099999998,-76.742919;7.953195999999991,-76.742919;7.953195999999991,-76.7426379999999;7.95291800000007,-76.7426379999999;7.95291800000007,-76.742363;7.95263999999997,-76.742363;7.95263999999997,-76.74208;7.952361,-76.74208;7.952361,-76.7418069999999;7.952083000000069,-76.7418069999999;7.952083000000069,-76.741531;7.95180499999998,-76.741531;7.95180499999998,-76.741248;7.95124900000002,-76.741248;7.95125200000007,-76.74097499999991;7.9509710000001,-76.74097499999991;7.9509710000001,-76.740692;7.95041700000007,-76.740692;7.95041700000007,-76.740419;7.94958300000002,-76.740419;7.94958300000002,-76.74013599999989;7.94930500000009,-76.74013599999989;7.94930500000009,-76.73985999999999;7.94819500000011,-76.73985999999999;7.94819500000011,-76.739587;7.94763900000009,-76.739587;7.94763900000009,-76.73985999999999;7.947083000000079,-76.73985999999999;7.947083000000079,-76.739587;7.946527000000119,-76.739587;7.946529000000109,-76.73930399999991;7.94541700000008,-76.73930399999991;7.94541700000008,-76.739587;7.9443050000001,-76.739587;7.9443050000001,-76.73985999999999;7.94347300000004,-76.73985999999999;7.94347300000004,-76.74013599999989;7.94291700000002,-76.74013599999989;7.94291900000002,-76.740419;7.942641000000091,-76.740419;7.942641000000091,-76.740692;7.942363,-76.740692;7.942363,-76.74097499999991;7.942085000000081,-76.74097499999991;7.942085000000081,-76.741248;7.941529000000121,-76.741248;7.941529000000121,-76.741531;7.941251000000021,-76.741531;7.941251000000021,-76.7418069999999;7.9409730000001,-76.7418069999999;7.9409730000001,-76.74208;7.94069500000001,-76.74208;7.94069500000001,-76.742363;7.940416000000031,-76.742363;7.940416000000031,-76.7426379999999;7.940137999999931,-76.7426379999999;7.940137999999931,-76.742919;7.93986000000001,-76.742919;7.93986000000001,-76.743195;7.93958200000014,-76.743195;7.93958200000014,-76.7434699999999;7.9393070000001,-76.7434699999999;7.9393070000001,-76.74434599999989;7.9393070000001,-76.74458300000001;7.93875000000003,-76.74458300000001;7.93875000000003,-76.7451409999999;7.938472000000101,-76.7451409999999;7.938472000000101,-76.745414;7.93819400000001,-76.745414;7.93819400000001,-76.7459709999999;7.937916000000141,-76.7459709999999;7.937916000000141,-76.7468019999999;7.93819400000001,-76.7468019999999;7.93819400000001,-76.7470849999999;7.937916000000141,-76.7470849999999;7.937916000000141,-76.747917;7.93763800000005,-76.747917;7.93763800000005,-76.748749;7.93652800000001,-76.748749;7.93652800000001,-76.74847299999991;7.93625000000014,-76.74847299999991;7.93625000000014,-76.748193;7.935972000000051,-76.748193;7.935972000000051,-76.747917;7.93541600000003,-76.747917;7.93541600000003,-76.7476429999999;7.93513799999994,-76.7476429999999;7.93513799999994,-76.747361;7.93486200000001,-76.747361;7.93486200000001,-76.7470849999999;7.93430600000005,-76.7470849999999;7.93430600000005,-76.7468019999999;7.93402800000013,-76.7468019999999;7.93402800000013,-76.746529;7.93375000000003,-76.746529;7.93375000000003,-76.746246;7.93291600000015,-76.746246;7.93291600000015,-76.7459709999999;7.93236200000013,-76.7459709999999;7.93236200000013,-76.74569700000001;7.93208400000003,-76.74569700000001;7.93208400000003,-76.745414;7.931528000000069,-76.745414;7.931528000000069,-76.7451409999999;7.93125000000015,-76.7451409999999;7.93125000000015,-76.74485799999999;7.93041600000004,-76.74485799999999;7.93041600000004,-76.74458300000001;7.93013999999994,-76.74458300000001;7.93013999999994,-76.7443089999999;7.92958400000015,-76.7443089999999;7.92958400000015,-76.74402600000001;7.928471999999939,-76.74402600000001;7.928471999999939,-76.74458300000001;7.928750000000039,-76.74458300000001;7.928750000000039,-76.74485799999999;7.929028000000131,-76.74485799999999;7.929028000000131,-76.745414;7.92930600000005,-76.745414;7.92930600000005,-76.74569700000001;7.92958400000015,-76.74569700000001;7.92958400000015,-76.7459709999999;7.93041600000004,-76.7459709999999;7.93041600000004,-76.746246;7.93097200000005,-76.746246;7.93097200000005,-76.746529;7.93208400000003,-76.746529;7.93208400000003,-76.7470849999999;7.93220900000006,-76.7470849999999;7.93236200000013,-76.7470849999999;7.93236200000013,-76.747361;7.932640000000049,-76.747361;7.932640000000049,-76.7476429999999;7.93291600000015,-76.7476429999999;7.93291600000015,-76.747917;7.93347199999994,-76.747917;7.93347199999994,-76.748193;7.93402800000013,-76.748193;7.93402800000013,-76.74847299999991;7.93430600000005,-76.74847299999991;7.93430600000005,-76.7490309999999;7.93486200000001,-76.7490309999999;7.93486200000001,-76.74930499999989;7.93513799999994,-76.74930499999989;7.93513799999994,-76.74986299999991;7.93541600000003,-76.74986299999991;7.93541600000003,-76.75069499999999;7.93569400000013,-76.75069499999999;7.93569400000013,-76.7512509999999;7.935972000000051,-76.7512509999999;7.935972000000051,-76.751525;7.93625000000014,-76.751525;7.93625000000014,-76.7518069999999;7.93569400000013,-76.7518069999999;7.93569400000013,-76.751525;7.93541600000003,-76.751525;7.93541600000003,-76.7512509999999;7.93513799999994,-76.7512509999999;7.93513799999994,-76.75069499999999;7.93486200000001,-76.75069499999999;7.93486200000001,-76.75041899999989;7.93458400000014,-76.75041899999989;7.93458400000014,-76.7501369999999;7.93430600000005,-76.7501369999999;7.93430600000005,-76.74986299999991;7.93402800000013,-76.74986299999991;7.93402800000013,-76.74958100000001;7.93319400000007,-76.74958100000001;7.93319400000007,-76.74930499999989;7.932640000000049,-76.74930499999989;7.932640000000049,-76.748749;7.93236200000013,-76.748749;7.93236200000013,-76.748193;7.93208400000003,-76.748193;7.93208400000003,-76.747917;7.93180599999994,-76.747917;7.93180599999994,-76.7476429999999;7.93125000000015,-76.7476429999999;7.93125000000015,-76.747361;7.930694000000129,-76.747361;7.930694000000129,-76.7470849999999;7.92986200000007,-76.7470849999999;7.92986200000007,-76.7468019999999;7.92764000000005,-76.7468019999999;7.92764000000005,-76.7470849999999;7.92736200000013,-76.7470849999999;7.92736200000013,-76.747361;7.92680599999994,-76.747361;7.92680599999994,-76.7476429999999;7.92652699999996,-76.7476429999999;7.92652699999996,-76.747917;7.925971,-76.747917;7.925971,-76.748193;7.92513900000006,-76.748193;7.92513900000006,-76.747917;7.92291700000004,-76.747917;7.92291700000004,-76.748193;7.92236100000008,-76.748193;7.92236100000008,-76.74847299999991;7.92208300000016,-76.74847299999991;7.92208300000016,-76.748749;7.92152699999997,-76.748749;7.92152899999996,-76.7490309999999;7.920973,-76.7490309999999;7.920973,-76.74930499999989;7.92069500000008,-76.74930499999989;7.92069500000008,-76.74958100000001;7.920139000000059,-76.74958100000001;7.920139000000059,-76.7501369999999;7.91986099999997,-76.7501369999999;7.91986099999997,-76.75069499999999;7.91930500000001,-76.75069499999999;7.91930500000001,-76.7509689999999;7.91902700000009,-76.7509689999999;7.919029000000081,-76.7512509999999;7.91875100000016,-76.7512509999999;7.91875100000016,-76.751525;7.91847300000006,-76.751525;7.91847300000006,-76.7518069999999;7.91819499999997,-76.7518069999999;7.91819499999997,-76.7520829999999;7.9179170000001,-76.7520829999999;7.9179170000001,-76.7526389999999;7.917639000000009,-76.7526389999999;7.917639000000009,-76.7531979999999;7.91736100000008,-76.7531979999999;7.91736100000008,-76.75347099999991;7.91708299999999,-76.75347099999991;7.91708299999999,-76.7537539999999;7.91680500000007,-76.7537539999999;7.91680500000007,-76.75402699999999;7.91652899999997,-76.75402699999999;7.91652899999997,-76.7545859999999;7.9162510000001,-76.7545859999999;7.9162510000001,-76.754859;7.91597300000001,-76.754859;7.91597300000001,-76.75514199999991;7.915695000000079,-76.75514199999991;7.915695000000079,-76.755691;7.91541699999999,-76.755691;7.91541699999999,-76.7562489999999;7.915139000000071,-76.7562489999999;7.915139000000071,-76.7568059999999;7.914860999999971,-76.7568059999999;7.914860999999971,-76.757079;7.914582,-76.757079;7.914582,-76.7576369999999;7.91430700000001,-76.7576369999999;7.91430700000001,-76.7581939999999;7.91402900000008,-76.7581939999999;7.91402900000008,-76.75902499999999;7.91375099999999,-76.75902499999999;7.91375099999999,-76.759689;7.91375099999999,-76.75986399999989;7.91347300000007,-76.75986399999989;7.91347300000007,-76.76013999999989;7.91319499999997,-76.76013999999989;7.91319499999997,-76.7606959999999;7.912916,-76.7606959999999;7.912916,-76.7618039999999;7.91263800000007,-76.7618039999999;7.91263800000007,-76.7623599999999;7.91236000000004,-76.7623599999999;7.91236000000004,-76.76291599999991;7.91208200000011,-76.76291599999991;7.91208200000011,-76.7631919999999;7.911807000000071,-76.7631919999999;7.911807000000071,-76.763474;7.911528000000089,-76.763474;7.911528000000089,-76.76402999999991;7.91125,-76.76402999999991;7.91125,-76.7645799999999;7.911528000000089,-76.7645799999999;7.911528000000089,-76.7651359999999;7.91125,-76.7651359999999;7.91125,-76.7656939999999;7.91097200000007,-76.7656939999999;7.91097200000007,-76.7662499999999;7.91069400000004,-76.7662499999999;7.91069400000004,-76.76763800000001;7.91097200000007,-76.76763800000001;7.91097200000007,-76.76791399999991;7.91069400000004,-76.76791399999991;7.91069400000004,-76.768197;7.91041600000011,-76.768197;7.91041600000011,-76.7687529999999;7.91013800000002,-76.7687529999999;7.91013800000002,-76.7693019999999;7.90986000000009,-76.7693019999999;7.90986000000009,-76.7712479999999;7.909584000000001,-76.7712479999999;7.909584000000001,-76.771805;7.90930600000007,-76.771805;7.90930600000007,-76.77263600000001;7.909028000000031,-76.77263600000001;7.909028000000031,-76.77430699999999;7.90875000000011,-76.77430699999999;7.90875000000011,-76.774863;7.90847200000002,-76.774863;7.90847200000002,-76.775695;7.908194000000091,-76.775695;7.908194000000091,-76.77791499999989;7.907916,-76.77791499999989;7.907916,-76.780137;7.90763800000013,-76.780137;7.907640000000071,-76.7812489999999;7.90736200000003,-76.7812489999999;7.90736200000003,-76.78208099999991;7.90708400000011,-76.78208099999991;7.90708400000011,-76.78402800000001;7.90680600000002,-76.78402800000001;7.90680600000002,-76.7865299999999;7.90652800000009,-76.7865299999999;7.90652800000009,-76.78791799999991;7.906249999999999,-76.78791799999991;7.906249999999999,-76.789306;7.90597200000013,-76.789306;7.90597200000013,-76.790138;7.905140000000021,-76.790138;7.905140000000021,-76.79097;7.90486200000009,-76.79097;7.90486200000009,-76.7912519999999;7.904584,-76.7912519999999;7.904584,-76.79152599999991;7.90430600000013,-76.79152599999991;7.90430600000013,-76.7920839999999;7.90486200000009,-76.7920839999999;7.90486200000009,-76.7918089999999;7.90569400000004,-76.7918089999999;7.90569400000004,-76.79347199999999;7.90541600000012,-76.79347199999999;7.90541600000012,-76.79458700000001;7.905140000000021,-76.79458700000001;7.905140000000021,-76.79652399999991;7.90486200000009,-76.79652399999991;7.90486200000009,-76.7998579999999;7.904584,-76.7998579999999;7.904584,-76.8015289999999;7.904028000000041,-76.8015289999999;7.904028000000041,-76.80180300000001;7.90375000000012,-76.80180300000001;7.90375000000012,-76.80236099999991;7.904028000000041,-76.80236099999991;7.904028000000041,-76.80319299999989;7.90430600000013,-76.80319299999989;7.90430600000013,-76.8056949999999;7.904028000000041,-76.8056949999999;7.904028000000041,-76.806808;7.90375000000012,-76.806808;7.90375000000012,-76.81180599999991;7.90347200000002,-76.81180599999991;7.90347200000002,-76.816255;7.9031940000001,-76.816255;7.9031940000001,-76.81652799999991;7.90347200000002,-76.81652799999991;7.90347200000002,-76.8176429999999;7.9031940000001,-76.8176429999999;7.9031940000001,-76.8184739999999;7.90347200000002,-76.8184739999999;7.90347200000002,-76.82013599999991;7.9031940000001,-76.82013599999991;7.9031940000001,-76.825417;7.902915999999999,-76.825417;7.902915999999999,-76.826249;7.9031940000001,-76.826249;7.9031940000001,-76.828751;7.902915999999999,-76.828751;7.902915999999999,-76.8290249999999;7.9031940000001,-76.8290249999999;7.9031940000001,-76.845696;7.90347200000002,-76.845696;7.90347200000002,-76.85013599999991;7.90375000000012,-76.85013599999991;7.90375000000012,-76.85485900000001;7.904028000000041,-76.85485900000001;7.904028000000041,-76.859025;7.90375000000012,-76.859025;7.90375000000012,-76.85958099999991;7.90347200000002,-76.85958099999991;7.90347200000002,-76.86041999999991;7.9031940000001,-76.86041999999991;7.9031940000001,-76.86069500000001;7.902915999999999,-76.86069500000001;7.902915999999999,-76.860969;7.90264000000013,-76.860969;7.90264000000013,-76.86125199999989;7.90236200000004,-76.86125199999989;7.90236200000004,-76.861527;7.902084000000119,-76.861527;7.902084000000119,-76.8618079999999;7.901806000000019,-76.8618079999999;7.901806000000019,-76.8620829999999;7.90097100000003,-76.8620829999999;7.90097400000013,-76.862359;7.9006930000001,-76.862359;7.9006930000001,-76.86347099999991;7.90097400000013,-76.86347099999991;7.90097400000013,-76.86403;7.901252000000001,-76.86403;7.901252000000001,-76.86430300000001;7.90153000000009,-76.86430300000001;7.9015280000001,-76.864859;7.901806000000019,-76.864859;7.901806000000019,-76.865691;7.90236200000004,-76.865691;7.90236200000004,-76.8659739999999;7.902915999999999,-76.8659739999999;7.902915999999999,-76.86653199999991;7.9031940000001,-76.86653199999991;7.9031940000001,-76.8668059999999;7.90347200000002,-76.8668059999999;7.90347200000002,-76.8670819999999;7.90375000000012,-76.8670819999999;7.90375000000012,-76.867362;7.904028000000041,-76.867362;7.904028000000041,-76.8695839999999;7.90375000000012,-76.8695839999999;7.90375000000012,-76.87013999999991;7.904028000000041,-76.87013999999991;7.904028000000041,-76.8712459999999;7.90430600000013,-76.8712459999999;7.90430600000013,-76.8715279999999;7.904028000000041,-76.8715279999999;7.904028000000041,-76.87236;7.90430600000013,-76.87236;7.90430600000013,-76.87486299999991;7.904584,-76.87486299999991;7.904584,-76.8765259999999;7.90486200000009,-76.8765259999999;7.90486200000009,-76.8770819999999;7.905140000000021,-76.8770819999999;7.905140000000021,-76.877641;7.90486200000009,-76.877641;7.90486200000009,-76.88069299999989;7.905140000000021,-76.88069299999989;7.905140000000021,-76.882637;7.90541600000012,-76.882637;7.90541600000012,-76.88458299999991;7.90569400000004,-76.88458299999991;7.90569400000004,-76.8856949999999;7.90597200000013,-76.8856949999999;7.90597200000013,-76.8865269999999;7.906249999999999,-76.8865269999999;7.906249999999999,-76.887642;7.90652800000009,-76.887642;7.90652800000009,-76.88902999999991;7.90680600000002,-76.88902999999991;7.90680600000002,-76.88986199999989;7.90708400000011,-76.88986199999989;7.90708400000011,-76.89041999999991;7.90736200000003,-76.89041999999991;7.90736200000003,-76.8906929999999;7.907640000000071,-76.8906929999999;7.90763800000013,-76.8915249999999;7.907916,-76.8915249999999;7.907916,-76.89291299999989;7.908194000000091,-76.89291299999989;7.908194000000091,-76.89402799999991;7.90847200000002,-76.89402799999991;7.90847200000002,-76.894584;7.90875000000011,-76.894584;7.90875000000011,-76.896248;7.909028000000031,-76.896248;7.909028000000031,-76.8965299999999;7.90875000000011,-76.8965299999999;7.90875000000011,-76.896804;7.909028000000031,-76.896804;7.909028000000031,-76.899306;7.90930600000007,-76.899306;7.90930600000007,-76.900414;7.909584000000001,-76.900414;7.909584000000001,-76.9012529999999;7.90986000000009,-76.9012529999999;7.90986000000009,-76.90291599999991;7.91013800000002,-76.90291599999991;7.91013800000002,-76.90347300000001;7.91041600000011,-76.90347300000001;7.91041600000011,-76.9040309999999;7.91069400000004,-76.9040309999999;7.91069400000004,-76.9056919999999;7.91097200000007,-76.9056919999999;7.91097200000007,-76.9062509999999;7.91125,-76.9062509999999;7.91125,-76.9068069999999;7.911528000000089,-76.9068069999999;7.911528000000089,-76.90819499999991;7.911807000000071,-76.90819499999991;7.911807000000071,-76.9101409999999;7.91208200000011,-76.9101409999999;7.91208200000011,-76.9106969999999;7.91236000000004,-76.9106969999999;7.91236000000004,-76.9115289999999;7.91263800000007,-76.9115289999999;7.91263800000007,-76.91208499999991;7.912916,-76.91208499999991;7.912916,-76.9137489999999;7.91319499999997,-76.9137489999999;7.91319499999997,-76.91430799999991;7.91347300000007,-76.91430799999991;7.91347300000007,-76.91486399999999;7.91375099999999,-76.91486399999999;7.91375099999999,-76.9154129999999;7.91402900000008,-76.9154129999999;7.91402900000008,-76.91596899999991;7.91430700000001,-76.91596899999991;7.91430700000001,-76.916252;7.914582,-76.916252;7.914582,-76.9168099999999;7.914860999999971,-76.9168099999999;7.914860999999971,-76.91735899999991;7.915139000000071,-76.91735899999991;7.915139000000071,-76.91763999999991;7.91541699999999,-76.91763999999991;7.91541699999999,-76.918198;7.915695000000079,-76.918198;7.915695000000079,-76.9187469999999;7.91597300000001,-76.9187469999999;7.91597300000001,-76.9193029999999;7.9162510000001,-76.9193029999999;7.9162510000001,-76.919586;7.91652699999997,-76.919586;7.91654,-76.9201349999999;7.916807000000059,-76.9201349999999;7.916807000000059,-76.920258;7.916807000000059,-76.9203879999999;7.91680500000007,-76.9209739999999;7.91708299999999,-76.9209739999999;7.91708299999999,-76.9218059999999;7.91736100000008,-76.9218059999999;7.91736100000008,-76.92292000000001;7.917639000000009,-76.92292000000001;7.917639000000009,-76.923194;7.91847300000006,-76.923194;7.91847300000006,-76.9234699999999;7.919029000000081,-76.9234699999999;7.91902700000009,-76.92375199999999;7.919583000000099,-76.92375199999999;7.919583000000099,-76.9240259999999;7.920139000000059,-76.9240259999999;7.920139000000059,-76.9243079999999;7.92069500000008,-76.9243079999999;7.92069500000008,-76.924584;7.921251000000039,-76.92463699999991;7.9212490000001,-76.9248579999999;7.92148399999996,-76.9248579999999;7.92208300000016,-76.9248579999999;7.92208300000016,-76.9251399999999;7.922639,-76.9251399999999;7.922639,-76.925416;7.923194999999961,-76.925416;7.923194999999961,-76.925696;7.92375100000015,-76.925696;7.92374900000016,-76.92652800000001;7.924583000000041,-76.92652800000001;7.924583000000041,-76.92680399999991;7.92486099999996,-76.92680399999991;7.92486099999996,-76.926925;7.92486099999996,-76.92735999999999;7.92598000000004,-76.92735999999999;7.92624900000004,-76.92735999999999;7.92624900000004,-76.92746699999999;7.92624900000004,-76.92763599999989;7.92669200000012,-76.92763599999989;7.92680599999994,-76.92763599999989;7.92680599999994,-76.927919;7.92736200000013,-76.927919;7.92736200000013,-76.928192;7.92791500000004,-76.928192;7.92791500000004,-76.92847499999991;7.928471999999939,-76.92847499999991;7.928471999999939,-76.928748;7.92930600000005,-76.928748;7.92930600000005,-76.929031;7.93013999999994,-76.929031;7.93013999999994,-76.9293069999999;7.930694000000129,-76.9293069999999;7.930694000000129,-76.92958;7.93097200000005,-76.92958;7.93097200000005,-76.929863;7.931528000000069,-76.929863;7.931528000000069,-76.9301379999999;7.93180599999994,-76.9301379999999;7.93180599999994,-76.930695;7.93208400000003,-76.930695;7.93208400000003,-76.9309699999999;7.932640000000049,-76.9309699999999;7.932640000000049,-76.931251;7.93291600000015,-76.931251;7.93291600000015,-76.93152600000001;7.93347199999994,-76.93152600000001;7.93347199999994,-76.9318089999999;7.93541600000003,-76.9318089999999;7.93541600000003,-76.93152600000001;7.93625000000014,-76.93152600000001;7.93625000000014,-76.931251;7.93736000000013,-76.931251;7.93736000000013,-76.93152600000001;7.938472000000101,-76.93152600000001;7.938472000000101,-76.931702;7.938472000000101,-76.9318089999999;7.93875000000003,-76.9318089999999;7.93875000000003,-76.93235799999999;7.93986000000001,-76.93235799999999;7.93986000000001,-76.9326409999999;7.941251000000021,-76.9326409999999;7.941251000000021,-76.932914;7.941529000000121,-76.932914;7.941529000000121,-76.93319700000001;7.942363,-76.93319700000001;7.942363,-76.932914;7.943751000000079,-76.932914;7.943751000000079,-76.9326409999999;7.9443050000001,-76.9326409999999;7.9443050000001,-76.93235799999999;7.944583000000021,-76.93235799999999;7.944583000000021,-76.93208300000001;7.94486100000012,-76.93208300000001;7.94486100000012,-76.93235799999999;7.94513900000004,-76.93235799999999;7.94513900000004,-76.9326409999999;7.94597300000009,-76.9326409999999;7.94597300000009,-76.932914;7.947361,-76.932914;7.947361,-76.9326409999999;7.94819500000011,-76.9326409999999;7.94819500000011,-76.93235799999999;7.94958300000002,-76.93235799999999;7.94958300000002,-76.93208300000001;7.949861000000111,-76.93208300000001;7.949861000000111,-76.9318089999999;7.950695,-76.9318089999999;7.950693,-76.93235799999999;7.95125200000007,-76.93235799999999;7.95124900000002,-76.93208300000001;7.95180499999998,-76.93208300000001;7.95180499999998,-76.93152600000001;7.952361,-76.93152600000001;7.952361,-76.931251;7.953195999999991,-76.931251;7.953195999999991,-76.9309699999999;7.954026999999999,-76.9309699999999;7.954026999999999,-76.930695;7.95486199999999,-76.930695;7.95486199999999,-76.930421;7.955140000000089,-76.930421;7.955140000000089,-76.9301379999999;7.95541800000001,-76.9301379999999;7.95541800000001,-76.930421;7.957084000000011,-76.930421;7.957084000000011,-76.930695;7.95736200000005,-76.930695;7.95736200000005,-76.930421;7.95763799999997,-76.930421;7.95763799999997,-76.9301379999999;7.95902800000005,-76.9301379999999;7.95902800000005,-76.930421;7.959862000000161,-76.930421;7.959862000000161,-76.9301379999999;7.96041600000001,-76.9301379999999;7.96041600000001,-76.930421;7.96069400000005,-76.930421;7.96069400000005,-76.9301379999999;7.96097199999997,-76.9301379999999;7.96097199999997,-76.929863;7.96152800000016,-76.929863;7.96152800000016,-76.92958;7.962083999999951,-76.92958;7.962083999999951,-76.9293069999999;7.96264000000014,-76.9293069999999;7.96264000000014,-76.929031;7.964028000000041,-76.929031;7.964028000000041,-76.928748;7.964306000000141,-76.928748;7.964306000000141,-76.929031;7.96486300000004,-76.929031;7.964860000000161,-76.9293069999999;7.96597200000014,-76.9293069999999;7.96597200000014,-76.929031;7.96652900000004,-76.929031;7.96652900000004,-76.928748;7.96680400000008,-76.928748;7.96680400000008,-76.92847499999991;7.96736000000004,-76.92847499999991;7.96736000000004,-76.928192;7.968195000000041,-76.928192;7.968195000000041,-76.927919;7.968751000000049,-76.927919;7.968751000000049,-76.928192;7.96902900000015,-76.928192;7.96902900000015,-76.92847499999991;7.96958299999994,-76.92847499999991;7.96958299999994,-76.928748;7.97013900000013,-76.928748;7.97013900000013,-76.929031;7.972083000000049,-76.929031;7.972083000000049,-76.928748;7.97236100000015,-76.928748;7.97236100000015,-76.92847499999991;7.97291699999994,-76.92847499999991;7.97291699999994,-76.928192;7.973195000000029,-76.928192;7.973195000000029,-76.927919;7.97513900000013,-76.927919;7.97513900000013,-76.92763599999989;7.976805000000131,-76.92763599999989;7.976805000000131,-76.927919;7.97930500000001,-76.927919;7.97930500000001,-76.928748;7.97986200000008,-76.928748;7.97986200000008,-76.929031;7.980140000000011,-76.929031;7.980140000000011,-76.9293069999999;7.98069300000014,-76.9293069999999;7.98069300000014,-76.929031;7.98216800000012,-76.929031;7.98264000000012,-76.929031;7.98264000000012,-76.928871;7.98264000000012,-76.928748;7.9830070000001,-76.928712;7.98319600000008,-76.92868899999991;7.983194000000079,-76.928192;7.98458399999998,-76.928192;7.98458399999998,-76.92763599999989;7.98514,-76.92763599999989;7.98514,-76.927919;7.98549799999995,-76.927919;7.986249999999981,-76.927919;7.986249999999981,-76.928192;7.98736200000002,-76.928192;7.98736000000002,-76.927919;7.98791599999998,-76.927919;7.98791599999998,-76.92763599999989;7.99097200000011,-76.92763599999989;7.99097200000011,-76.927087;7.99124999999998,-76.927087;7.99124999999998,-76.92680399999991;7.991528000000069,-76.92680399999991;7.99152600000008,-76.92652800000001;7.992640999999991,-76.92652800000001;7.99263800000011,-76.9259719999999;7.993471999999999,-76.9259719999999;7.993471999999999,-76.925696;7.994029000000071,-76.925696;7.994029000000071,-76.9250649999999;7.994029000000071,-76.9248579999999;7.99430699999999,-76.9248579999999;7.99430699999999,-76.9240259999999;7.994581999999979,-76.9240259999999;7.994581999999979,-76.92375199999999;7.994860000000071,-76.92375199999999;7.994860000000071,-76.9234699999999;7.99513900000005,-76.9234699999999;7.99513900000005,-76.92292000000001;7.99541699999997,-76.92292000000001;7.99541699999997,-76.922364;7.99597299999999,-76.922364;7.99597299999999,-76.922082;7.99625100000009,-76.922082;7.99625100000009,-76.92152299999989;7.99708299999998,-76.92152299999989;7.99708299999998,-76.92125;7.99736100000007,-76.92125;7.99736100000007,-76.9209739999999;7.997638999999991,-76.9209739999999;7.997638999999991,-76.92069099999991;7.999027000000069,-76.92069099999991;7.999027000000069,-76.920418;7.99930499999999,-76.920418;7.99930499999999,-76.92125;7.999027000000069,-76.92125;7.999027000000069,-76.92152299999989;7.99930499999999,-76.92152299999989;7.99930499999999,-76.9218059999999;7.99986099999995,-76.9218059999999;7.99986099999995,-76.922082;8.000139000000051,-76.922082;8.00152899999995,-76.922082;8.00152899999995,-76.9218059999999;8.00208500000014,-76.9218059999999;8.00208500000014,-76.922082;8.00264100000015,-76.922082;8.00263900000016,-76.922364;8.00291700000008,-76.922364;8.00291700000008,-76.92292000000001;8.003198000000051,-76.92292000000001;8.00319499999995,-76.923194;8.003749000000139,-76.923194;8.003749000000139,-76.9234699999999;8.004027000000059,-76.9234699999999;8.004027000000059,-76.92375199999999;8.00458300000008,-76.92375199999999;8.00458300000008,-76.9248579999999;8.004864000000049,-76.9248579999999;8.00486099999995,-76.9251399999999;8.00486099999995,-76.925416;8.005139000000041,-76.925416;8.005139000000041,-76.925696;8.00542000000002,-76.925696;8.00541700000014,-76.92652800000001;8.00569599999994,-76.92652800000001;8.00569599999994,-76.92735999999999;8.00541700000014,-76.92735999999999;8.00542000000002,-76.927919;8.005139000000041,-76.927919;8.005139000000041,-76.92847499999991;8.005974000000039,-76.92847499999991;8.005971000000161,-76.928192;8.00624900000008,-76.928192;8.00624900000008,-76.92763599999989;8.006530000000049,-76.92763599999989;8.00652699999995,-76.927087;8.006805000000041,-76.927087;8.006805000000041,-76.92680399999991;8.00708300000014,-76.92680399999991;8.00708300000014,-76.92652800000001;8.007915000000081,-76.92652800000001;8.007915000000081,-76.92624599999991;8.00819600000005,-76.92624599999991;8.008192999999951,-76.9259719999999;8.008471000000039,-76.9259719999999;8.008471000000039,-76.925696;8.00902799999994,-76.925696;8.00902799999994,-76.925416;8.00958400000013,-76.925416;8.00958400000013,-76.9251399999999;8.010418000000019,-76.9251399999999;8.010418000000019,-76.9248579999999;8.010693999999941,-76.9248579999999;8.010693999999941,-76.924584;8.01291600000013,-76.924584;8.01291600000013,-76.9243079999999;8.013472000000149,-76.9243079999999;8.013472000000149,-76.924584;8.01375000000002,-76.924584;8.01375000000002,-76.925696;8.01402800000011,-76.925696;8.01402800000011,-76.92624599999991;8.01430600000003,-76.92624599999991;8.01430600000003,-76.92652800000001;8.014862000000051,-76.92652800000001;8.014862000000051,-76.92624599999991;8.015418000000009,-76.92624599999991;8.01541600000002,-76.925696;8.01597200000003,-76.925696;8.01597200000003,-76.9259719999999;8.01680600000009,-76.9259719999999;8.01680600000009,-76.92624599999991;8.017916000000129,-76.92624599999991;8.017916000000129,-76.9259719999999;8.01847200000009,-76.9259719999999;8.01847200000009,-76.925696;8.01875000000001,-76.925696;8.01875000000001,-76.925416;8.019028000000111,-76.925416;8.019028000000111,-76.9248579999999;8.01930400000003,-76.9248579999999;8.01930400000003,-76.924584;8.019028000000111,-76.924584;8.019028000000111,-76.9234699999999;8.01930400000003,-76.9234699999999;8.01930400000003,-76.923194;8.019860000000049,-76.923194;8.019860000000049,-76.9218059999999;8.01930400000003,-76.9218059999999;8.01930400000003,-76.92152299999989;8.019028000000111,-76.92152299999989;8.019028000000111,-76.9209739999999;8.01875000000001,-76.9209739999999;8.01875000000001,-76.920418;8.018194000000049,-76.920418;8.018194000000049,-76.91903000000001;8.01736000000011,-76.91903000000001;8.01736000000011,-76.9187469999999;8.01680600000009,-76.9187469999999;8.01680600000009,-76.9184719999999;8.016250000000131,-76.9184719999999;8.016250000000131,-76.9187469999999;8.01569400000011,-76.9187469999999;8.01569400000011,-76.91903000000001;8.01430600000003,-76.91903000000001;8.01430600000003,-76.9187469999999;8.01375000000002,-76.9187469999999;8.01375000000002,-76.91903000000001;8.01319600000005,-76.91903000000001;8.01319600000005,-76.9187469999999;8.01236200000011,-76.9187469999999;8.01236200000011,-76.9184719999999;8.011806000000149,-76.9184719999999;8.011806000000149,-76.917084;8.011528000000061,-76.917084;8.011528000000061,-76.9168099999999;8.011806000000149,-76.9168099999999;8.011806000000149,-76.9165269999999;8.012084000000019,-76.9165269999999;8.012084000000019,-76.916252;8.01236200000011,-76.916252;8.01236200000011,-76.9156959999999;8.01291600000013,-76.9156959999999;8.01291600000013,-76.9154129999999;8.013472000000149,-76.9154129999999;8.013472000000149,-76.9151369999999;8.01402800000011,-76.9151369999999;8.01402800000011,-76.91486399999999;8.014584000000131,-76.91486399999999;8.014584000000131,-76.9145809999999;8.01513800000015,-76.9145809999999;8.01513800000015,-76.91430799999991;8.015418000000009,-76.91430799999991;8.01541600000002,-76.9140249999999;8.01569400000011,-76.9140249999999;8.01569400000011,-76.9137489999999;8.01708200000002,-76.9137489999999;8.01708200000002,-76.9134759999999;8.01763800000003,-76.9134759999999;8.01763800000003,-76.9137489999999;8.018194000000049,-76.9137489999999;8.018194000000049,-76.9140249999999;8.01875000000001,-76.9140249999999;8.01875000000001,-76.9137489999999;8.02041600000001,-76.9137489999999;8.02041600000001,-76.9140249999999;8.02097300000008,-76.9140249999999;8.02097300000008,-76.91430799999991;8.02180700000002,-76.91430799999991;8.02180400000009,-76.9145809999999;8.022362999999981,-76.9145809999999;8.022360999999989,-76.9151369999999;8.02263900000008,-76.9151369999999;8.02263900000008,-76.9154129999999;8.022360999999989,-76.9154129999999;8.022362999999981,-76.9161449999999;8.022362999999981,-76.916252;8.02263900000008,-76.916252;8.02263900000008,-76.9165269999999;8.022919,-76.9165269999999;8.02291700000001,-76.9168099999999;8.023195000000101,-76.9168099999999;8.023195000000101,-76.91791499999989;8.02291700000001,-76.91791499999989;8.022919,-76.9184719999999;8.02263900000008,-76.9184719999999;8.02263900000008,-76.91903000000001;8.02208200000001,-76.91903000000001;8.02208200000001,-76.9193029999999;8.021529000000101,-76.9193029999999;8.021529000000101,-76.91903000000001;8.020694000000111,-76.91903000000001;8.020694000000111,-76.9187469999999;8.02013800000009,-76.9187469999999;8.02013800000009,-76.919862;8.02041600000001,-76.919862;8.02041600000001,-76.9201349999999;8.020694000000111,-76.9201349999999;8.020694000000111,-76.920418;8.02097300000008,-76.920418;8.02097300000008,-76.9209739999999;8.02125100000001,-76.9209739999999;8.02125100000001,-76.92152299999989;8.02097300000008,-76.92152299999989;8.02097300000008,-76.9218059999999;8.020694000000111,-76.9218059999999;8.020694000000111,-76.922082;8.02041600000001,-76.922082;8.02041600000001,-76.92263799999991;8.020694000000111,-76.92263799999991;8.020694000000111,-76.92292000000001;8.02097300000008,-76.92292000000001;8.02097300000008,-76.923194;8.02125100000001,-76.923194;8.02125100000001,-76.9240259999999;8.021529000000101,-76.9240259999999;8.021529000000101,-76.924584;8.02180700000002,-76.924584;8.02180700000002,-76.9243079999999;8.02208200000001,-76.9243079999999;8.02208200000001,-76.9240259999999;8.022362999999981,-76.9240259999999;8.022362999999981,-76.9243079999999;8.022919,-76.9243079999999;8.02291700000001,-76.924584;8.023195000000101,-76.924584;8.023195000000101,-76.9248579999999;8.02430500000008,-76.9248579999999;8.02430500000008,-76.924584;8.024585,-76.924584;8.024583000000011,-76.9243079999999;8.024861000000101,-76.9243079999999;8.024861000000101,-76.92375199999999;8.02597300000008,-76.92375199999999;8.02597300000008,-76.9234699999999;8.026251,-76.9234699999999;8.026249000000011,-76.923194;8.026527000000099,-76.923194;8.026527000000099,-76.92292000000001;8.026807000000019,-76.92292000000001;8.026805000000021,-76.92263799999991;8.02708300000012,-76.92263799999991;8.02708300000012,-76.922364;8.02736099999998,-76.922364;8.02736099999998,-76.922082;8.027639000000081,-76.922082;8.027639000000081,-76.92173799999991;8.027639000000081,-76.92152299999989;8.0281950000001,-76.92152299999989;8.0281950000001,-76.919862;8.027917,-76.919862;8.027917,-76.9193029999999;8.02736099999998,-76.9193029999999;8.02736099999998,-76.9187469999999;8.02708300000012,-76.9187469999999;8.02708300000012,-76.9184719999999;8.026805000000021,-76.9184719999999;8.026807000000019,-76.918198;8.026527000000099,-76.918198;8.026527000000099,-76.91791499999989;8.02708300000012,-76.91791499999989;8.02708300000012,-76.91763999999991;8.03013900000002,-76.91763999999991;8.03013900000002,-76.91791499999989;8.032083000000061,-76.91791499999989;8.032083000000061,-76.91763999999991;8.032639000000071,-76.91763999999991;8.032639000000071,-76.91735899999991;8.033196000000149,-76.91735899999991;8.033196000000149,-76.917084;8.033749000000061,-76.917084;8.033749000000061,-76.9168099999999;8.03403000000009,-76.9168099999999;8.034026999999981,-76.916252;8.034305000000071,-76.916252;8.034305000000071,-76.91596899999991;8.03569600000009,-76.91596899999991;8.035692999999981,-76.9156959999999;8.03597199999996,-76.9156959999999;8.03597199999996,-76.9151369999999;8.03652800000015,-76.9151369999999;8.03652800000015,-76.91486399999999;8.0366370000001,-76.91486399999999;8.03708399999999,-76.91486399999999;8.03708399999999,-76.9145809999999;8.037918000000049,-76.9145809999999;8.037918000000049,-76.91430799999991;8.039028000000091,-76.91430799999991;8.039028000000091,-76.9140249999999;8.03986200000014,-76.9140249999999;8.03986000000015,-76.9134759999999;8.04041599999999,-76.9134759999999;8.04041599999999,-76.91236099999991;8.040694000000091,-76.91236099999991;8.040694000000091,-76.91208499999991;8.04097199999995,-76.91208499999991;8.04097199999995,-76.9118049999999;8.04125000000005,-76.9118049999999;8.04125000000005,-76.9112469999999;8.04097199999995,-76.9112469999999;8.04097199999995,-76.9109729999999;8.04125000000005,-76.9109729999999;8.04125000000005,-76.9106969999999;8.04180600000007,-76.9106969999999;8.04180600000007,-76.9101409999999;8.042084000000161,-76.9101409999999;8.042084000000161,-76.90958499999989;8.042362000000031,-76.90958499999989;8.042362000000031,-76.90875299999991;8.04263799999995,-76.90875299999991;8.04263799999995,-76.90819499999991;8.04291600000005,-76.90819499999991;8.04291600000005,-76.9076389999999;8.04319600000014,-76.9076389999999;8.04319400000014,-76.9073629999999;8.043472000000071,-76.9073629999999;8.043472000000071,-76.9059749999999;8.04375300000004,-76.9059749999999;8.043750000000159,-76.9056919999999;8.044028000000029,-76.9056919999999;8.044028000000029,-76.905136;8.044305999999951,-76.905136;8.044305999999951,-76.9040309999999;8.044028000000029,-76.9040309999999;8.044028000000029,-76.90347300000001;8.04458400000004,-76.90347300000001;8.04458400000004,-76.9031989999999;8.044862000000141,-76.9031989999999;8.044862000000141,-76.90291599999991;8.04458400000004,-76.90291599999991;8.04458400000004,-76.901802;8.044862000000141,-76.901802;8.04486000000014,-76.9015279999999;8.045138000000071,-76.9015279999999;8.045138000000071,-76.9012529999999;8.04486000000014,-76.9012529999999;8.04486000000014,-76.90097;8.045138000000071,-76.90097;8.045138000000071,-76.8970859999999;8.04541900000004,-76.8970859999999;8.04541900000004,-76.895974;8.045138000000071,-76.895974;8.045138000000071,-76.895416;8.04486000000014,-76.895416;8.044862000000141,-76.8923639999999;8.04458400000004,-76.8923639999999;8.04458400000004,-76.89208100000001;8.044862000000141,-76.89208100000001;8.044862000000141,-76.891808;8.04458400000004,-76.891808;8.04458400000004,-76.8906929999999;8.044862000000141,-76.8906929999999;8.044862000000141,-76.887917;8.04458400000004,-76.887917;8.04458400000004,-76.8873589999999;8.044305999999951,-76.8873589999999;8.044305999999951,-76.886803;8.044028000000029,-76.886803;8.044028000000029,-76.8854149999999;8.043750000000159,-76.8854149999999;8.04375300000004,-76.8848659999999;8.043472000000071,-76.8848659999999;8.043472000000071,-76.88458299999991;8.04291600000005,-76.88458299999991;8.04291600000005,-76.883751;8.04263799999995,-76.883751;8.04263799999995,-76.88346899999991;8.042362000000031,-76.88346899999991;8.042362000000031,-76.882919;8.042084000000161,-76.882919;8.042084000000161,-76.8823629999999;8.04152800000014,-76.8823629999999;8.04152800000014,-76.8820809999999;8.04125000000005,-76.8820809999999;8.04125000000005,-76.8823629999999;8.04097199999995,-76.8823629999999;8.04097199999995,-76.881805;8.040694000000091,-76.881805;8.040694000000091,-76.8815309999999;8.04041599999999,-76.8815309999999;8.04041599999999,-76.880973;8.04014000000006,-76.880973;8.04014000000006,-76.88069299999989;8.039584000000049,-76.88069299999989;8.039584000000049,-76.8804169999999;8.039028000000091,-76.8804169999999;8.039028000000091,-76.880143;8.03847200000007,-76.880143;8.03847200000007,-76.87986099999991;8.03819400000015,-76.87986099999991;8.03819400000015,-76.87958499999991;8.037362000000091,-76.87958499999991;8.037362000000091,-76.8793019999999;8.03708399999999,-76.8793019999999;8.03708399999999,-76.8790289999999;8.03680600000007,-76.8790289999999;8.03680600000007,-76.878753;8.036250000000051,-76.878753;8.036252000000051,-76.87846999999989;8.03597199999996,-76.87846999999989;8.03597199999996,-76.8781969999999;8.035140000000069,-76.8781969999999;8.035140000000069,-76.877641;8.03486200000015,-76.877641;8.03486200000015,-76.877358;8.03458400000005,-76.877358;8.03458400000005,-76.8770819999999;8.03403000000009,-76.8770819999999;8.03403000000009,-76.87680899999999;8.033474000000069,-76.87680899999999;8.033474000000069,-76.8765259999999;8.032916999999999,-76.8765259999999;8.032916999999999,-76.8762509999999;8.03236099999998,-76.8762509999999;8.03236099999998,-76.8759679999999;8.032083000000061,-76.8759679999999;8.032083000000061,-76.8756939999999;8.0315270000001,-76.8756939999999;8.0315270000001,-76.87541899999989;8.030973000000071,-76.87541899999989;8.030973000000071,-76.87513799999989;8.03013900000002,-76.87513799999989;8.03013900000002,-76.87486299999991;8.029583000000001,-76.87486299999991;8.029583000000001,-76.8745799999999;8.025694999999979,-76.8745799999999;8.025694999999979,-76.87430599999991;8.024861000000101,-76.87430599999991;8.024861000000101,-76.8745799999999;8.024583000000011,-76.8745799999999;8.024585,-76.87430599999991;8.024028999999979,-76.87430599999991;8.024028999999979,-76.8745799999999;8.02097300000008,-76.8745799999999;8.02097300000008,-76.87374799999991;8.02125100000001,-76.87374799999991;8.02125100000001,-76.872643;8.021529000000101,-76.872643;8.021529000000101,-76.8712459999999;8.02180700000002,-76.8712459999999;8.02180700000002,-76.8706959999999;8.02208200000001,-76.8706959999999;8.02208200000001,-76.87013999999991;8.022362999999981,-76.87013999999991;8.022362999999981,-76.86985799999999;8.022919,-76.86985799999999;8.02291700000001,-76.8695839999999;8.023195000000101,-76.8695839999999;8.023195000000101,-76.869308;8.023473000000021,-76.869308;8.023473000000021,-76.8687519999999;8.02375100000012,-76.8687519999999;8.02375100000012,-76.8684699999999;8.024028999999979,-76.8684699999999;8.024028999999979,-76.868194;8.02430500000008,-76.868194;8.02430500000008,-76.8676379999999;8.024585,-76.8676379999999;8.024583000000011,-76.867362;8.025139000000021,-76.867362;8.025139000000021,-76.8670819999999;8.025694999999979,-76.8670819999999;8.025694999999979,-76.8668059999999;8.02597300000008,-76.8668059999999;8.02597300000008,-76.86653199999991;8.026251,-76.86653199999991;8.026251,-76.86541799999991;8.02597300000008,-76.86541799999991;8.02597300000008,-76.864859;8.025694999999979,-76.864859;8.025694999999979,-76.86430300000001;8.02541700000012,-76.86430300000001;8.02541700000012,-76.863747;8.025139000000021,-76.863747;8.025139000000021,-76.86347099999991;8.024861000000101,-76.86347099999991;8.024861000000101,-76.8631979999999;8.02430500000008,-76.8631979999999;8.02430500000008,-76.8629149999999;8.023473000000021,-76.8629149999999;8.023473000000021,-76.8631979999999;8.022919,-76.8631979999999;8.022919,-76.86347099999991;8.02263900000008,-76.86347099999991;8.02263900000008,-76.863747;8.02208200000001,-76.863747;8.02208200000001,-76.86403;8.021529000000101,-76.86403;8.021529000000101,-76.8645859999999;8.02125100000001,-76.8645859999999;8.02125100000001,-76.864859;8.02014100000002,-76.864859;8.02014100000002,-76.8645859999999;8.019860000000049,-76.8645859999999;8.019860000000049,-76.86403;8.020694000000111,-76.86403;8.020694000000111,-76.86347099999991;8.02041600000001,-76.86347099999991;8.02041600000001,-76.8631979999999;8.02013800000009,-76.8631979999999;8.02014100000002,-76.8626399999999;8.019860000000049,-76.8626399999999;8.019860000000049,-76.8620829999999;8.02014100000002,-76.8620829999999;8.02013800000009,-76.861527;8.02041600000001,-76.861527;8.02041600000001,-76.86125199999989;8.020694000000111,-76.86125199999989;8.020694000000111,-76.860969;8.02097300000008,-76.860969;8.02097300000008,-76.86041999999991;8.02125100000001,-76.86041999999991;8.02125100000001,-76.860137;8.021529000000101,-76.860137;8.021529000000101,-76.859864;8.02180700000002,-76.859864;8.02180700000002,-76.8593069999999;8.02208200000001,-76.8593069999999;8.02208200000001,-76.859025;8.022362999999981,-76.859025;8.022360999999989,-76.8584759999999;8.02263900000008,-76.8584759999999;8.02263900000008,-76.858193;8.022919,-76.858193;8.022919,-76.857361;8.02263900000008,-76.857361;8.02263900000008,-76.85680499999999;8.022360999999989,-76.85680499999999;8.022360999999989,-76.85569700000001;8.02263900000008,-76.85569700000001;8.02263900000008,-76.85097499999991;8.022360999999989,-76.85097499999991;8.022362999999981,-76.85013599999991;8.02208200000001,-76.85013599999991;8.02208200000001,-76.8495869999999;8.02180700000002,-76.8495869999999;8.02180700000002,-76.8493039999999;8.021529000000101,-76.8493039999999;8.021529000000101,-76.849029;8.02125100000001,-76.849029;8.02125100000001,-76.8484719999999;8.02097300000008,-76.8484719999999;8.02097300000008,-76.84819899999999;8.020694000000111,-76.84819899999999;8.020694000000111,-76.847358;8.02041600000001,-76.847358;8.02041600000001,-76.8470839999999;8.02013800000009,-76.8470839999999;8.02014100000002,-76.846526;8.019860000000049,-76.846526;8.019860000000049,-76.84625299999991;8.01958500000001,-76.84625299999991;8.01958500000001,-76.8459699999999;8.01930400000003,-76.8459699999999;8.01930400000003,-76.845696;8.018937000000051,-76.845696;8.01875000000001,-76.845696;8.01875000000001,-76.84541399999991;8.01763800000003,-76.84541399999991;8.01763800000003,-76.84513799999991;8.01736000000011,-76.84513799999991;8.01736000000011,-76.8434739999999;8.01708200000002,-76.8434739999999;8.01708200000002,-76.843194;8.01736000000011,-76.843194;8.01736000000011,-76.8429179999999;8.01763800000003,-76.8429179999999;8.01763800000003,-76.8420859999999;8.017916000000129,-76.8420859999999;8.017916000000129,-76.8418039999999;8.018194000000049,-76.8418039999999;8.018194000000049,-76.8401419999999;8.01847200000009,-76.8401419999999;8.01847200000009,-76.8384719999999;8.01875000000001,-76.8384719999999;8.01875000000001,-76.837913;8.019028000000111,-76.837913;8.019028000000111,-76.83763999999989;8.01930400000003,-76.83763999999989;8.01930400000003,-76.83736399999999;8.019860000000049,-76.83736399999999;8.019860000000049,-76.837081;8.02014100000002,-76.837081;8.02013800000009,-76.83680799999991;8.02041600000001,-76.83680799999991;8.02041600000001,-76.8365249999999;8.020694000000111,-76.8365249999999;8.020694000000111,-76.836249;8.021529000000101,-76.836249;8.021529000000101,-76.8365249999999;8.02180700000002,-76.8365249999999;8.02180700000002,-76.837081;8.02208200000001,-76.837081;8.02208200000001,-76.83736399999999;8.022362999999981,-76.83736399999999;8.022360999999989,-76.837913;8.02375100000012,-76.837913;8.02375100000012,-76.837081;8.023473000000021,-76.837081;8.023473000000021,-76.8365249999999;8.02375100000012,-76.8365249999999;8.02375100000012,-76.836249;8.02430500000008,-76.836249;8.02430500000008,-76.83763999999989;8.024585,-76.83763999999989;8.024583000000011,-76.8387519999999;8.024861000000101,-76.8387519999999;8.024861000000101,-76.8395839999999;8.025139000000021,-76.8395839999999;8.025139000000021,-76.84097199999989;8.02541700000012,-76.84097199999989;8.02541700000012,-76.84124799999989;8.02597300000008,-76.84124799999989;8.02597300000008,-76.84153000000001;8.026251,-76.84153000000001;8.026249000000011,-76.8418039999999;8.026527000000099,-76.8418039999999;8.026527000000099,-76.8429179999999;8.026807000000019,-76.8429179999999;8.026807000000019,-76.8437499999999;8.026527000000099,-76.8437499999999;8.026527000000099,-76.84402399999991;8.026807000000019,-76.84402399999991;8.026805000000021,-76.844865;8.02708300000012,-76.844865;8.02708300000012,-76.84541399999991;8.02736099999998,-76.84541399999991;8.02736099999998,-76.8459699999999;8.027639000000081,-76.8459699999999;8.027639000000081,-76.846526;8.02736099999998,-76.846526;8.02736099999998,-76.847641;8.027639000000081,-76.847641;8.027639000000081,-76.8479159999999;8.0281950000001,-76.8479159999999;8.0281950000001,-76.84819899999999;8.02902899999998,-76.84819899999999;8.02902699999999,-76.8484719999999;8.029305000000081,-76.8484719999999;8.029305000000081,-76.8487479999999;8.0298610000001,-76.8487479999999;8.0298610000001,-76.84819899999999;8.03013900000002,-76.84819899999999;8.03013900000002,-76.847358;8.03041700000006,-76.847358;8.03041700000006,-76.8470839999999;8.030973000000071,-76.8470839999999;8.030973000000071,-76.8468019999999;8.0315270000001,-76.8468019999999;8.0315270000001,-76.8470839999999;8.031808000000069,-76.8470839999999;8.03180500000002,-76.847358;8.032083000000061,-76.847358;8.032083000000061,-76.8495869999999;8.03236099999998,-76.8495869999999;8.03236099999998,-76.850419;8.032639000000071,-76.850419;8.032639000000071,-76.85097499999991;8.032916999999999,-76.85097499999991;8.032916999999999,-76.851524;8.033196000000149,-76.851524;8.033196000000149,-76.8529119999999;8.033474000000069,-76.8529119999999;8.03347100000002,-76.8533409999999;8.03347100000002,-76.853471;8.033749000000061,-76.853471;8.033749000000061,-76.8537529999999;8.03403000000009,-76.8537529999999;8.03403000000009,-76.854027;8.03458400000005,-76.854027;8.03458400000005,-76.8543089999999;8.03486200000015,-76.8543089999999;8.03486200000015,-76.85458299999991;8.035140000000069,-76.85458299999991;8.035140000000069,-76.85485900000001;8.035417999999989,-76.85485900000001;8.035417999999989,-76.85569700000001;8.035140000000069,-76.85569700000001;8.035140000000069,-76.85597299999991;8.03486200000015,-76.85597299999991;8.03486200000015,-76.856529;8.03458400000005,-76.856529;8.03458400000005,-76.8584759999999;8.03486200000015,-76.8584759999999;8.03486200000015,-76.859025;8.035140000000069,-76.859025;8.035140000000069,-76.8593069999999;8.03569600000009,-76.8593069999999;8.03569600000009,-76.85958099999991;8.036252000000051,-76.85958099999991;8.036250000000051,-76.860137;8.03652800000015,-76.860137;8.03652800000015,-76.86041999999991;8.03680600000007,-76.86041999999991;8.03680600000007,-76.86069500000001;8.03708399999999,-76.86069500000001;8.03708399999999,-76.860969;8.037918000000049,-76.860969;8.037918000000049,-76.86069500000001;8.03874999999999,-76.86069500000001;8.03874999999999,-76.85958099999991;8.03847200000007,-76.85958099999991;8.03847200000007,-76.859025;8.03819400000015,-76.859025;8.03819400000015,-76.8579169999999;8.03847200000007,-76.8579169999999;8.03847200000007,-76.857361;8.039028000000091,-76.857361;8.039028000000091,-76.8576349999999;8.03930599999995,-76.8576349999999;8.03930599999995,-76.8579169999999;8.039584000000049,-76.8579169999999;8.039584000000049,-76.858193;8.03986200000014,-76.858193;8.03986000000015,-76.8579169999999;8.04041599999999,-76.8579169999999;8.04041599999999,-76.8576349999999;8.041011000000029,-76.8576349999999;8.042362000000031,-76.8576349999999;8.042362000000031,-76.857361;8.04263799999995,-76.857361;8.04263799999995,-76.8570849999999;8.04319600000014,-76.8570849999999;8.04319400000014,-76.857361;8.043472000000071,-76.857361;8.043472000000071,-76.8576349999999;8.04375300000004,-76.8576349999999;8.04375300000004,-76.858749;8.043472000000071,-76.858749;8.043472000000071,-76.861527;8.04375300000004,-76.861527;8.043750000000159,-76.8620829999999;8.044028000000029,-76.8620829999999;8.044028000000029,-76.8626399999999;8.044305999999951,-76.8626399999999;8.044305999999951,-76.8629149999999;8.04458400000004,-76.8629149999999;8.04458400000004,-76.86403;8.044862000000141,-76.86403;8.04486000000014,-76.865135;8.045138000000071,-76.865135;8.045138000000071,-76.864859;8.045694000000029,-76.864859;8.045694000000029,-76.86403;8.046804000000069,-76.86403;8.046804000000069,-76.86430300000001;8.04708500000004,-76.86430300000001;8.04708200000016,-76.8645859999999;8.04736000000003,-76.8645859999999;8.04736000000003,-76.864859;8.047641000000061,-76.864859;8.047641000000061,-76.865135;8.04819700000002,-76.865135;8.048195000000019,-76.86541799999991;8.04902600000003,-76.86541799999991;8.04902600000003,-76.865691;8.049583000000149,-76.865691;8.049583000000149,-76.86541799999991;8.051251000000089,-76.86541799999991;8.051251000000089,-76.865135;8.05208500000003,-76.865135;8.05208500000003,-76.864859;8.05263900000006,-76.864859;8.05263900000006,-76.865135;8.05291700000009,-76.865135;8.05291700000009,-76.86541799999991;8.05319500000002,-76.86541799999991;8.05319500000002,-76.865691;8.053473000000111,-76.865691;8.053473000000111,-76.86653199999991;8.05291700000009,-76.86653199999991;8.05291700000009,-76.8668059999999;8.05263900000006,-76.8668059999999;8.05263900000006,-76.8670819999999;8.052361000000131,-76.8670819999999;8.052361000000131,-76.867362;8.05152900000002,-76.867362;8.05152900000002,-76.8676379999999;8.04819700000002,-76.8676379999999;8.04819700000002,-76.868194;8.04791600000004,-76.868194;8.04791600000004,-76.8684699999999;8.04736000000003,-76.8684699999999;8.04736000000003,-76.8687519999999;8.046804000000069,-76.8687519999999;8.046804000000069,-76.869308;8.046528000000141,-76.869308;8.046528000000141,-76.86985799999999;8.04736000000003,-76.86985799999999;8.04736000000003,-76.8695839999999;8.047641000000061,-76.8695839999999;8.047637999999949,-76.86902600000001;8.04791600000004,-76.86902600000001;8.04791600000004,-76.87013999999991;8.04819700000002,-76.87013999999991;8.048195000000019,-76.8704139999999;8.04847300000012,-76.8704139999999;8.04847300000012,-76.8706959999999;8.04875100000004,-76.8706959999999;8.04875100000004,-76.8704139999999;8.049307000000059,-76.8704139999999;8.049307000000059,-76.8706959999999;8.050139000000121,-76.8706959999999;8.050139000000121,-76.8709719999999;8.050973000000059,-76.8709719999999;8.050973000000059,-76.8706959999999;8.05152900000002,-76.8706959999999;8.05152900000002,-76.8709719999999;8.052361000000131,-76.8709719999999;8.052361000000131,-76.8712459999999;8.05263900000006,-76.8712459999999;8.05263900000006,-76.8715279999999;8.05375100000003,-76.8715279999999;8.05375100000003,-76.8709719999999;8.054027000000129,-76.8709719999999;8.054027000000129,-76.8704139999999;8.054306999999991,-76.8704139999999;8.05430500000006,-76.8695839999999;8.05458300000009,-76.8695839999999;8.05458300000009,-76.869308;8.05486100000002,-76.869308;8.05486100000002,-76.86902600000001;8.055139000000111,-76.86902600000001;8.055139000000111,-76.86691999999989;8.055139000000111,-76.86653199999991;8.05486100000002,-76.86653199999991;8.05486100000002,-76.865135;8.055139000000111,-76.865135;8.055139000000111,-76.8645859999999;8.055248000000059,-76.8645859999999;8.055417000000031,-76.8645859999999;8.055417000000031,-76.86347099999991;8.05569500000013,-76.86347099999991;8.05569500000013,-76.8626399999999;8.055972999999989,-76.8626399999999;8.055972999999989,-76.862359;8.05569500000013,-76.862359;8.05569500000013,-76.86125199999989;8.055972999999989,-76.86125199999989;8.055972999999989,-76.860137;8.05624900000009,-76.860137;8.05624900000009,-76.85958099999991;8.05652900000001,-76.85958099999991;8.05652700000002,-76.859025;8.056805000000111,-76.859025;8.056805000000111,-76.857361;8.05652700000002,-76.857361;8.05652900000001,-76.856529;8.05624900000009,-76.856529;8.05624900000009,-76.85541499999989;8.05652900000001,-76.85541499999989;8.05652900000001,-76.8537529999999;8.05624900000009,-76.8537529999999;8.05624900000009,-76.853195;8.05652900000001,-76.853195;8.05652900000001,-76.852639;8.05624900000009,-76.852639;8.05624900000009,-76.852363;8.055972999999989,-76.852363;8.055972999999989,-76.8520799999999;8.05569500000013,-76.8520799999999;8.05569500000013,-76.85180699999999;8.055417000000031,-76.85180699999999;8.055417000000031,-76.851524;8.055139000000111,-76.851524;8.055139000000111,-76.850692;8.05486100000002,-76.850692;8.05486100000002,-76.850419;8.05458300000009,-76.850419;8.05458300000009,-76.8495869999999;8.05430500000006,-76.8495869999999;8.054306999999991,-76.849029;8.054027000000129,-76.849029;8.054027000000129,-76.8487479999999;8.05375100000003,-76.8487479999999;8.05375100000003,-76.8484719999999;8.053473000000111,-76.8484719999999;8.053473000000111,-76.84819899999999;8.05319500000002,-76.84819899999999;8.05319500000002,-76.8479159999999;8.05291700000009,-76.8479159999999;8.05291700000009,-76.847358;8.05263900000006,-76.847358;8.05263900000006,-76.8468019999999;8.052361000000131,-76.8468019999999;8.052361000000131,-76.84625299999991;8.052083000000041,-76.84625299999991;8.05208500000003,-76.84541399999991;8.051805000000121,-76.84541399999991;8.051805000000121,-76.84513799999991;8.05152900000002,-76.84513799999991;8.05152900000002,-76.84541399999991;8.051251000000089,-76.84541399999991;8.051251000000089,-76.845696;8.050973000000059,-76.845696;8.050973000000059,-76.8459699999999;8.050695000000131,-76.8459699999999;8.050695000000131,-76.84625299999991;8.05041700000004,-76.84625299999991;8.05041900000003,-76.846526;8.050139000000121,-76.846526;8.050139000000121,-76.8468019999999;8.049307000000059,-76.8468019999999;8.049307000000059,-76.846526;8.04875100000004,-76.846526;8.04875100000004,-76.844865;8.04847300000012,-76.844865;8.04847300000012,-76.8445819999999;8.048195000000019,-76.8445819999999;8.04819700000002,-76.8443059999999;8.04791600000004,-76.8443059999999;8.04791600000004,-76.84402399999991;8.047637999999949,-76.84402399999991;8.047641000000061,-76.8437499999999;8.04736000000003,-76.8437499999999;8.04736000000003,-76.8426359999999;8.04708200000016,-76.8426359999999;8.04708500000004,-76.8420859999999;8.046531000000019,-76.8420859999999;8.046531000000019,-76.8418039999999;8.04625000000004,-76.8418039999999;8.04625000000004,-76.84153000000001;8.045971999999949,-76.84153000000001;8.045975000000061,-76.84097199999989;8.045694000000029,-76.84097199999989;8.045694000000029,-76.84058400000001;8.045694000000029,-76.84041599999991;8.04581300000012,-76.84041599999991;8.04625000000004,-76.84041599999991;8.04625000000004,-76.8401419999999;8.046531000000019,-76.8401419999999;8.046528000000141,-76.83986;8.04736000000003,-76.83986;8.04736000000003,-76.8401419999999;8.04791600000004,-76.8401419999999;8.04791600000004,-76.84041599999991;8.04819700000002,-76.84041599999991;8.04819700000002,-76.840698;8.04875100000004,-76.840698;8.04875100000004,-76.84097199999989;8.050139000000121,-76.84097199999989;8.050139000000121,-76.83986;8.049583000000149,-76.83986;8.049583000000149,-76.8395839999999;8.049307000000059,-76.8395839999999;8.049307000000059,-76.83930099999991;8.04902600000003,-76.83930099999991;8.04902600000003,-76.839028;8.04875100000004,-76.839028;8.04875100000004,-76.8387519999999;8.04819700000002,-76.83869900000001;8.04819700000002,-76.8384719999999;8.04736000000003,-76.8384719999999;8.04736000000003,-76.838196;8.045694000000029,-76.838196;8.045694000000029,-76.8384719999999;8.04458400000004,-76.8384719999999;8.04458400000004,-76.8387519999999;8.044305999999951,-76.8387519999999;8.044305999999951,-76.8384719999999;8.04291600000005,-76.8384719999999;8.04291600000005,-76.838196;8.04263799999995,-76.838196;8.04263799999995,-76.83763999999989;8.042362000000031,-76.83763999999989;8.042362000000031,-76.837081;8.042084000000161,-76.837081;8.042084000000161,-76.8359759999999;8.042362000000031,-76.8359759999999;8.042362000000031,-76.8354199999999;8.04291600000005,-76.8354199999999;8.04291600000005,-76.8351369999999;8.04458400000004,-76.8351369999999;8.04458400000004,-76.8348609999999;8.044862000000141,-76.8348609999999;8.04486000000014,-76.8343049999999;8.045138000000071,-76.8343049999999;8.045138000000071,-76.832917;8.04541900000004,-76.832917;8.045416000000159,-76.83264199999989;8.045694000000029,-76.83264199999989;8.045694000000029,-76.8323589999999;8.045975000000061,-76.8323589999999;8.045971999999949,-76.83208499999991;8.04625000000004,-76.83208499999991;8.04625000000004,-76.8315269999999;8.046531000000019,-76.8315269999999;8.046531000000019,-76.8312539999999;8.04625000000004,-76.8312539999999;8.04625000000004,-76.830415;8.046531000000019,-76.830415;8.046528000000141,-76.829866;8.046804000000069,-76.829866;8.046804000000069,-76.829583;8.04708500000004,-76.829583;8.04708500000004,-76.8293069999999;8.047641000000061,-76.8293069999999;8.047641000000061,-76.8290249999999;8.04875100000004,-76.8290249999999;8.04875100000004,-76.8293069999999;8.04986300000002,-76.8293069999999;8.04986300000002,-76.829583;8.05041900000003,-76.829583;8.05041700000004,-76.829866;8.050695000000131,-76.829866;8.050695000000131,-76.8301389999999;8.050973000000059,-76.8301389999999;8.050973000000059,-76.830415;8.051251000000089,-76.830415;8.051251000000089,-76.83069499999991;8.05152900000002,-76.83069499999991;8.05152900000002,-76.83097099999991;8.051805000000121,-76.83097099999991;8.051805000000121,-76.83180299999989;8.05208500000003,-76.83180299999989;8.052083000000041,-76.83264199999989;8.052361000000131,-76.83264199999989;8.052361000000131,-76.832917;8.05263900000006,-76.832917;8.05263900000006,-76.8331909999999;8.05291700000009,-76.8331909999999;8.05291700000009,-76.8334729999999;8.053473000000111,-76.8334729999999;8.053473000000111,-76.833747;8.05375100000003,-76.833747;8.05375100000003,-76.83403;8.05486100000002,-76.83403;8.05486100000002,-76.8343049999999;8.055139000000111,-76.8343049999999;8.055139000000111,-76.8345879999999;8.055417000000031,-76.8345879999999;8.055417000000031,-76.8348609999999;8.05569500000013,-76.8348609999999;8.05569500000013,-76.8351369999999;8.055972999999989,-76.8351369999999;8.055972999999989,-76.83569299999991;8.05624900000009,-76.83569299999991;8.05624900000009,-76.836249;8.05652900000001,-76.836249;8.05652700000002,-76.83680799999991;8.056805000000111,-76.83680799999991;8.056805000000111,-76.837081;8.057083000000031,-76.837081;8.057083000000031,-76.83763999999989;8.05736100000013,-76.83763999999989;8.05736100000013,-76.837913;8.058749000000031,-76.837913;8.058749000000031,-76.838196;8.05902700000013,-76.838196;8.05902700000013,-76.8384719999999;8.05930499999999,-76.8384719999999;8.05930499999999,-76.839028;8.059583000000091,-76.839028;8.059583000000091,-76.84153000000001;8.05930499999999,-76.84153000000001;8.05930499999999,-76.8420859999999;8.059583000000091,-76.8420859999999;8.059583000000091,-76.8426359999999;8.05986100000001,-76.8426359999999;8.05986100000001,-76.84402399999991;8.059583000000091,-76.84402399999991;8.059583000000091,-76.8445819999999;8.05930499999999,-76.8445819999999;8.05930499999999,-76.84513799999991;8.059583000000091,-76.84513799999991;8.059583000000091,-76.84541399999991;8.05986100000001,-76.84541399999991;8.05986100000001,-76.845696;8.06013900000011,-76.845696;8.06013900000011,-76.8470839999999;8.060415000000029,-76.8470839999999;8.060415000000029,-76.84819899999999;8.06013900000011,-76.84819899999999;8.06013900000011,-76.849029;8.05986100000001,-76.849029;8.05986100000001,-76.85013599999991;8.059583000000091,-76.85013599999991;8.059583000000091,-76.85180699999999;8.05986100000001,-76.85180699999999;8.05986100000001,-76.8520799999999;8.06013900000011,-76.8520799999999;8.06013900000011,-76.852363;8.060696000000011,-76.852363;8.060696000000011,-76.852639;8.061019000000099,-76.852639;8.06180599999999,-76.852639;8.06180599999999,-76.8529119999999;8.062362000000009,-76.8529119999999;8.062362000000009,-76.85485900000001;8.06208400000008,-76.8549109999999;8.06208400000008,-76.85541499999989;8.06180599999999,-76.85541499999989;8.06180599999999,-76.85569700000001;8.061527000000011,-76.85569700000001;8.061527000000011,-76.8562469999999;8.061249000000091,-76.8562469999999;8.061249000000091,-76.856529;8.061527000000011,-76.856529;8.061527000000011,-76.857361;8.06180599999999,-76.857361;8.06180599999999,-76.8576349999999;8.06208400000008,-76.8576349999999;8.06208400000008,-76.858193;8.062362000000009,-76.858193;8.062362000000009,-76.859025;8.06208400000008,-76.859025;8.06208400000008,-76.860137;8.062362000000009,-76.860137;8.062362000000009,-76.86041999999991;8.0626400000001,-76.86041999999991;8.0626400000001,-76.86069500000001;8.06274700000006,-76.86069500000001;8.062918000000019,-76.86069500000001;8.062918000000019,-76.862359;8.0626400000001,-76.862359;8.0626400000001,-76.8626399999999;8.0626400000001,-76.8629149999999;8.06208400000008,-76.8629149999999;8.06208400000008,-76.8631979999999;8.061527000000011,-76.8631979999999;8.061527000000011,-76.86347099999991;8.061249000000091,-76.86347099999991;8.061249000000091,-76.86430300000001;8.061527000000011,-76.86430300000001;8.061527000000011,-76.864859;8.06180599999999,-76.864859;8.06180599999999,-76.86541799999991;8.06208400000008,-76.86541799999991;8.06208400000008,-76.865691;8.062362000000009,-76.865691;8.062362000000009,-76.8659739999999;8.0626400000001,-76.8659739999999;8.0626400000001,-76.86624999999989;8.062918000000019,-76.86624999999989;8.062918000000019,-76.8663699999999;8.062918000000019,-76.8668059999999;8.06323200000003,-76.8668059999999;8.064028000000009,-76.8668059999999;8.064028000000009,-76.86653199999991;8.0643060000001,-76.86653199999991;8.0643060000001,-76.86624999999989;8.06486200000006,-76.86624999999989;8.06486200000006,-76.8659739999999;8.0659720000001,-76.8659739999999;8.0659720000001,-76.865691;8.06652800000006,-76.865691;8.06652800000006,-76.8659739999999;8.066808000000149,-76.8659739999999;8.066808000000149,-76.86624999999989;8.069027999999999,-76.86624999999989;8.069027999999999,-76.8668059999999;8.06875000000008,-76.8668059999999;8.06875000000008,-76.8670819999999;8.069027999999999,-76.8670819999999;8.069027999999999,-76.867362;8.06958399999996,-76.867362;8.06958399999996,-76.8676379999999;8.069306000000101,-76.8676379999999;8.069306000000101,-76.868194;8.069027999999999,-76.868194;8.069027999999999,-76.8684699999999;8.0676400000001,-76.8684699999999;8.0676400000001,-76.8687519999999;8.06736000000001,-76.8687519999999;8.067361999999999,-76.8684699999999;8.06652800000006,-76.8684699999999;8.06652800000006,-76.8687519999999;8.0659720000001,-76.8687519999999;8.0659720000001,-76.86902600000001;8.06569400000001,-76.86902600000001;8.06569400000001,-76.8695839999999;8.0659720000001,-76.8695839999999;8.0659720000001,-76.86985799999999;8.06652800000006,-76.86985799999999;8.06652800000006,-76.87013999999991;8.066808000000149,-76.87013999999991;8.066805999999991,-76.871742;8.066805999999991,-76.87236;8.067084000000079,-76.87236;8.067084000000079,-76.8729159999999;8.06791799999996,-76.8729159999999;8.06791799999996,-76.872643;8.068471999999989,-76.872643;8.068471999999989,-76.87236;8.069027999999999,-76.87236;8.069027999999999,-76.87208699999989;8.069306000000101,-76.87208699999989;8.069306000000101,-76.8718039999999;8.06958399999996,-76.8718039999999;8.069582000000031,-76.8715279999999;8.069862000000059,-76.8715279999999;8.069862000000059,-76.8709719999999;8.07041600000008,-76.8709719999999;8.07041600000008,-76.8706959999999;8.070694,-76.8706959999999;8.070694,-76.8704139999999;8.070972000000101,-76.8704139999999;8.070972000000101,-76.8687519999999;8.070694,-76.8687519999999;8.070694,-76.8684699999999;8.07041600000008,-76.8684699999999;8.07041600000008,-76.867362;8.070694,-76.867362;8.070694,-76.8670819999999;8.070972000000101,-76.8670819999999;8.070972000000101,-76.8668059999999;8.071528000000059,-76.8668059999999;8.071528000000059,-76.86653199999991;8.07180600000015,-76.86653199999991;8.071852000000041,-76.8668059999999;8.072363000000051,-76.8668059999999;8.07236,-76.86653199999991;8.072638000000101,-76.86653199999991;8.072638000000101,-76.8670819999999;8.07291900000007,-76.8670819999999;8.07291599999996,-76.8668059999999;8.07319400000006,-76.8668059999999;8.07319400000006,-76.86653199999991;8.07375000000008,-76.86653199999991;8.07375000000008,-76.865691;8.074029000000049,-76.865691;8.074029000000049,-76.8645859999999;8.07375000000008,-76.8645859999999;8.07375000000008,-76.86430300000001;8.07347200000015,-76.86430300000001;8.07347200000015,-76.863747;8.07319400000006,-76.863747;8.07319400000006,-76.8620829999999;8.07291599999996,-76.8620829999999;8.07291900000007,-76.8618079999999;8.072638000000101,-76.8618079999999;8.072638000000101,-76.861527;8.072464999999969,-76.861527;8.07236,-76.861527;8.072363000000051,-76.860969;8.07208400000007,-76.860969;8.07208400000007,-76.86069500000001;8.07180600000015,-76.86069500000001;8.07180600000015,-76.86041999999991;8.072363000000051,-76.86041999999991;8.07236,-76.860137;8.072638000000101,-76.860137;8.07264500000014,-76.860032;8.072659000000041,-76.859864;8.07291900000007,-76.859864;8.07291900000007,-76.8593069999999;8.07347200000015,-76.8593069999999;8.07347200000015,-76.858749;8.074029000000049,-76.858749;8.074029000000049,-76.8584759999999;8.07458500000007,-76.8584759999999;8.07458199999996,-76.858193;8.07486000000006,-76.858193;8.07486000000006,-76.85680499999999;8.07458199999996,-76.85680499999999;8.07458500000007,-76.856529;8.075141000000031,-76.856529;8.07513800000015,-76.8562469999999;8.075416999999961,-76.8562469999999;8.075416999999961,-76.853195;8.07513800000015,-76.853195;8.07513800000015,-76.852639;8.075416999999961,-76.852639;8.075416999999961,-76.8520799999999;8.075695000000049,-76.8520799999999;8.075695000000049,-76.85180699999999;8.07597300000015,-76.85180699999999;8.07597300000015,-76.85125099999991;8.07625100000007,-76.85125099999991;8.07625100000007,-76.85097499999991;8.07652600000006,-76.85097499999991;8.07652600000006,-76.850419;8.076807000000031,-76.850419;8.076807000000031,-76.85013599999991;8.07652600000006,-76.85013599999991;8.07652600000006,-76.84986000000001;8.076807000000031,-76.84986000000001;8.076807000000031,-76.8479159999999;8.07652600000006,-76.8479159999999;8.07652600000006,-76.847641;8.076807000000031,-76.847641;8.076807000000031,-76.847358;8.07652600000006,-76.847358;8.07652600000006,-76.846795;8.07652600000006,-76.84625299999991;8.07670000000007,-76.84625299999991;8.076807000000031,-76.84625299999991;8.076805000000091,-76.8459699999999;8.077082999999959,-76.8459699999999;8.077082999999959,-76.84541399999991;8.07736300000005,-76.84541399999991;8.07736100000005,-76.8445819999999;8.077639000000151,-76.8445819999999;8.077639000000151,-76.8437499999999;8.077919000000071,-76.8437499999999;8.07791700000007,-76.8434739999999;8.078748999999959,-76.8434739999999;8.078748999999959,-76.843194;8.07902900000005,-76.843194;8.07902900000005,-76.8429179999999;8.079305000000151,-76.8429179999999;8.079305000000151,-76.8426359999999;8.079583000000071,-76.8426359999999;8.079583000000071,-76.84236199999999;8.080139000000029,-76.84236199999999;8.080139000000029,-76.8420859999999;8.080973000000141,-76.8420859999999;8.080973000000141,-76.8418039999999;8.081805000000029,-76.8418039999999;8.081805000000029,-76.84153000000001;8.082082999999949,-76.84153000000001;8.082082999999949,-76.84124799999989;8.08236100000005,-76.84124799999989;8.08236100000005,-76.840698;8.082639000000141,-76.840698;8.082639000000141,-76.8395839999999;8.082917000000069,-76.8395839999999;8.082917000000069,-76.839028;8.082639000000141,-76.839028;8.082639000000141,-76.838196;8.08236100000005,-76.838196;8.08236100000005,-76.837913;8.082082999999949,-76.837913;8.082082999999949,-76.83736399999999;8.081805000000029,-76.83736399999999;8.081805000000029,-76.837081;8.081526999999991,-76.837081;8.081526999999991,-76.83680799999991;8.081251000000069,-76.83680799999991;8.081251000000069,-76.8351369999999;8.081526999999991,-76.8351369999999;8.081526999999991,-76.8348609999999;8.081805000000029,-76.8348609999999;8.081805000000029,-76.8345879999999;8.082639000000141,-76.8345879999999;8.082639000000141,-76.8343049999999;8.08375100000012,-76.8343049999999;8.08375100000012,-76.83403;8.084307000000139,-76.83403;8.084305000000141,-76.833747;8.08458300000007,-76.833747;8.08458300000007,-76.8334729999999;8.08486100000016,-76.8334729999999;8.08486100000016,-76.8331909999999;8.08513900000003,-76.8331909999999;8.08513900000003,-76.832917;8.08541700000012,-76.832917;8.08541700000012,-76.8323589999999;8.08569500000004,-76.8323589999999;8.08569500000004,-76.83208499999991;8.08597300000014,-76.83208499999991;8.085971000000139,-76.8315269999999;8.08624900000007,-76.8315269999999;8.08624900000007,-76.8312539999999;8.088196000000041,-76.8312539999999;8.088196000000041,-76.83097099999991;8.088752,-76.83097099999991;8.088749000000121,-76.83069499999991;8.0890280000001,-76.83069499999991;8.0890280000001,-76.830415;8.089862000000039,-76.830415;8.089862000000039,-76.8301389999999;8.090974000000021,-76.8301389999999;8.090974000000021,-76.829866;8.091530000000031,-76.829866;8.091528000000039,-76.829583;8.09236200000009,-76.829583;8.09236200000009,-76.829866;8.09291600000012,-76.829866;8.09291600000012,-76.830415;8.093196000000029,-76.830415;8.09319400000004,-76.83208499999991;8.09347200000013,-76.83208499999991;8.09347200000013,-76.83264199999989;8.09375,-76.83264199999989;8.09375,-76.832917;8.09402800000009,-76.832917;8.09402800000009,-76.8334729999999;8.094306000000021,-76.8334729999999;8.094306000000021,-76.833747;8.09458400000011,-76.833747;8.09458400000011,-76.8343049999999;8.094862000000029,-76.8343049999999;8.094862000000029,-76.8345879999999;8.09513800000013,-76.8345879999999;8.09513800000013,-76.8354199999999;8.095418,-76.8354199999999;8.095416,-76.8359759999999;8.095694000000091,-76.8359759999999;8.095694000000091,-76.836249;8.09625000000011,-76.836249;8.09625000000011,-76.8365249999999;8.096806000000131,-76.8365249999999;8.096806000000131,-76.83680799999991;8.097084000000001,-76.83680799999991;8.097082,-76.83736399999999;8.097362000000089,-76.83736399999999;8.097362000000089,-76.837913;8.097082,-76.837913;8.097084000000001,-76.838196;8.09625000000011,-76.838196;8.09625000000011,-76.8384719999999;8.095694000000091,-76.8384719999999;8.095694000000091,-76.838196;8.094862000000029,-76.838196;8.094862000000029,-76.837913;8.094306000000021,-76.837913;8.094306000000021,-76.83763999999989;8.09402800000009,-76.83763999999989;8.09402800000009,-76.83736399999999;8.09375,-76.83736399999999;8.09375,-76.837081;8.093196000000029,-76.837081;8.093196000000029,-76.83680799999991;8.09291600000012,-76.83680799999991;8.09291600000012,-76.8365249999999;8.092640000000021,-76.8365249999999;8.092640000000021,-76.836249;8.09236200000009,-76.836249;8.09236200000009,-76.83569299999991;8.090137000000031,-76.83569299999991;8.090137000000031,-76.836249;8.089862000000039,-76.836249;8.089862000000039,-76.83680799999991;8.089584000000119,-76.83680799999991;8.089584000000119,-76.83736399999999;8.0890280000001,-76.83736399999999;8.0890280000001,-76.8387519999999;8.089584000000119,-76.8387519999999;8.089584000000119,-76.8384719999999;8.089862000000039,-76.8384719999999;8.089862000000039,-76.837913;8.090137000000031,-76.837913;8.090137000000031,-76.83763999999989;8.090418,-76.83763999999989;8.090418,-76.837081;8.0906940000001,-76.837081;8.0906940000001,-76.83680799999991;8.09236200000009,-76.83680799999991;8.09236200000009,-76.837913;8.092084,-76.837913;8.092084,-76.8384719999999;8.09180600000013,-76.8384719999999;8.09180600000013,-76.8395839999999;8.091528000000039,-76.8395839999999;8.091530000000031,-76.83986;8.09125000000012,-76.83986;8.09125000000012,-76.84041599999991;8.09097200000002,-76.84041599999991;8.090974000000021,-76.8418039999999;8.0906940000001,-76.8418039999999;8.0906940000001,-76.8437499999999;8.090418,-76.8437499999999;8.090418,-76.84402399999991;8.090137000000031,-76.84402399999991;8.090137000000031,-76.8443059999999;8.089584000000119,-76.8443059999999;8.089584000000119,-76.8445819999999;8.08930600000002,-76.8445819999999;8.08930800000002,-76.844865;8.0890280000001,-76.844865;8.0890280000001,-76.845696;8.08930800000002,-76.845696;8.08930800000002,-76.84819899999999;8.088752,-76.84819899999999;8.088752,-76.8484719999999;8.08847100000003,-76.8484719999999;8.08847100000003,-76.84986000000001;8.088752,-76.84986000000001;8.088749000000121,-76.85013599999991;8.0890280000001,-76.85013599999991;8.0890280000001,-76.850692;8.08930800000002,-76.850692;8.08930600000002,-76.85125099999991;8.089584000000119,-76.85125099999991;8.089584000000119,-76.851524;8.089862000000039,-76.851524;8.08987500000006,-76.85180699999999;8.090418,-76.85180699999999;8.090418,-76.8520799999999;8.0906940000001,-76.8520799999999;8.0906940000001,-76.852363;8.09125000000012,-76.852363;8.09125000000012,-76.852639;8.091530000000031,-76.852639;8.091528000000039,-76.8529119999999;8.09180600000013,-76.8529119999999;8.09180600000013,-76.8537529999999;8.091528000000039,-76.8537529999999;8.091530000000031,-76.854027;8.09125000000012,-76.854027;8.09125000000012,-76.85458299999991;8.092084,-76.85458299999991;8.092084,-76.8543089999999;8.09236200000009,-76.8543089999999;8.09236200000009,-76.854027;8.092640000000021,-76.854027;8.092640000000021,-76.8537529999999;8.093196000000029,-76.8537529999999;8.09319400000004,-76.8543089999999;8.09347200000013,-76.8543089999999;8.09347200000013,-76.85458299999991;8.09375,-76.85458299999991;8.09375,-76.85485900000001;8.09402800000009,-76.85485900000001;8.09402800000009,-76.8551409999999;8.09458400000011,-76.8551409999999;8.09458400000011,-76.85485900000001;8.094862000000029,-76.85485900000001;8.094862000000029,-76.85458299999991;8.095694000000091,-76.85458299999991;8.095694000000091,-76.8543089999999;8.09625000000011,-76.8543089999999;8.09625000000011,-76.854027;8.09652800000003,-76.854027;8.09652800000003,-76.8537529999999;8.097084000000001,-76.8537529999999;8.097082,-76.853471;8.097362000000089,-76.853471;8.097362000000089,-76.853195;8.09791600000011,-76.853195;8.09791600000011,-76.8529119999999;8.09819400000004,-76.8529119999999;8.09819400000004,-76.852363;8.098472000000131,-76.852363;8.098472000000131,-76.85180699999999;8.09819400000004,-76.85180699999999;8.09819400000004,-76.85125099999991;8.098472000000131,-76.85125099999991;8.098472000000131,-76.850692;8.09791600000011,-76.850692;8.09791600000011,-76.850419;8.097638000000019,-76.850419;8.097640000000011,-76.85013599999991;8.097362000000089,-76.85013599999991;8.097362000000089,-76.8495869999999;8.097082,-76.8495869999999;8.097082,-76.849029;8.097362000000089,-76.849029;8.097362000000089,-76.8487479999999;8.09791600000011,-76.8487479999999;8.09791600000011,-76.8484719999999;8.09930400000002,-76.8484719999999;8.09930400000002,-76.8487479999999;8.09958400000011,-76.8487479999999;8.09958400000011,-76.849029;8.099860000000041,-76.849029;8.099860000000041,-76.8495869999999;8.100138000000131,-76.8495869999999;8.100138000000131,-76.84986000000001;8.10069400000009,-76.84986000000001;8.10069400000009,-76.850419;8.101250999999991,-76.850419;8.101250999999991,-76.850692;8.10180700000001,-76.850692;8.10180700000001,-76.85097499999991;8.102081999999999,-76.85097499999991;8.102081999999999,-76.85125099999991;8.102916999999991,-76.85125099999991;8.102916999999991,-76.85097499999991;8.103195000000079,-76.85097499999991;8.103195000000079,-76.85125099999991;8.1037510000001,-76.85125099999991;8.1037510000001,-76.85180699999999;8.10402899999997,-76.85180699999999;8.10402899999997,-76.852363;8.104305000000069,-76.852363;8.104305000000069,-76.853195;8.104582999999989,-76.853195;8.104582999999989,-76.8537529999999;8.105694999999971,-76.8537529999999;8.105694999999971,-76.853471;8.105973000000059,-76.853471;8.105973000000059,-76.8529119999999;8.10652700000009,-76.8529119999999;8.10652700000009,-76.852363;8.109028999999961,-76.852363;8.109026999999969,-76.852639;8.10930500000006,-76.852639;8.10930500000006,-76.8529119999999;8.109583000000161,-76.8529119999999;8.109583000000161,-76.853195;8.10986100000008,-76.853195;8.10986100000008,-76.853471;8.110139,-76.853471;8.110139,-76.8537529999999;8.1104170000001,-76.8537529999999;8.1104170000001,-76.8543089999999;8.11069800000007,-76.8543089999999;8.110694999999961,-76.85485900000001;8.11097300000006,-76.85485900000001;8.11097300000006,-76.85541499999989;8.11125100000015,-76.85541499999989;8.111249000000161,-76.85569700000001;8.111527000000081,-76.85569700000001;8.111527000000081,-76.85597299999991;8.11180800000005,-76.85597299999991;8.111805,-76.856529;8.113195000000079,-76.856529;8.113195000000079,-76.85597299999991;8.11347400000005,-76.85597299999991;8.113471000000001,-76.85569700000001;8.1137490000001,-76.85569700000001;8.1137490000001,-76.8551409999999;8.114030000000071,-76.8551409999999;8.114026999999959,-76.8543089999999;8.11430500000006,-76.8543089999999;8.11430500000006,-76.8537529999999;8.114583000000151,-76.8537529999999;8.114583000000151,-76.853195;8.11486199999996,-76.853195;8.11486199999996,-76.8529119999999;8.11514000000005,-76.8529119999999;8.11514000000005,-76.852639;8.115696000000071,-76.852639;8.115696000000071,-76.852363;8.11625200000003,-76.852363;8.11625200000003,-76.8520799999999;8.11680800000005,-76.8520799999999;8.11680600000005,-76.852363;8.117084000000149,-76.852363;8.117084000000149,-76.8529119999999;8.117362000000069,-76.8529119999999;8.117362000000069,-76.853471;8.117638,-76.853471;8.117638,-76.8537529999999;8.11929000000004,-76.8537529999999;8.120140000000051,-76.8537529999999;8.120140000000051,-76.853471;8.12041600000015,-76.853471;8.12041600000015,-76.853195;8.12069400000007,-76.853195;8.12069400000007,-76.8529119999999;8.12097199999994,-76.8529119999999;8.12097199999994,-76.852639;8.12125000000003,-76.852639;8.12125000000003,-76.851524;8.12097199999994,-76.851524;8.12097199999994,-76.85097499999991;8.12069400000007,-76.85097499999991;8.12069400000007,-76.850692;8.12041600000015,-76.850692;8.12041600000015,-76.850419;8.120140000000051,-76.850419;8.120140000000051,-76.8484719999999;8.12069400000007,-76.8484719999999;8.12069400000007,-76.84819899999999;8.12097199999994,-76.84819899999999;8.12097199999994,-76.8479159999999;8.12125000000003,-76.8479159999999;8.12125000000003,-76.847641;8.121528000000129,-76.847641;8.121528000000129,-76.8470839999999;8.121806000000049,-76.8470839999999;8.121806000000049,-76.8468019999999;8.12208400000014,-76.8468019999999;8.12208400000014,-76.846526;8.12236200000007,-76.846526;8.12236200000007,-76.8459699999999;8.12263799999994,-76.8459699999999;8.12263799999994,-76.845696;8.12291600000003,-76.845696;8.12291600000003,-76.84541399999991;8.12319400000013,-76.84541399999991;8.12319400000013,-76.844865;8.123472000000049,-76.844865;8.123472000000049,-76.8443059999999;8.12375000000014,-76.8443059999999;8.12375000000014,-76.8437499999999;8.12402800000007,-76.8437499999999;8.12402800000007,-76.8429179999999;8.1243060000001,-76.8429179999999;8.1243060000001,-76.8420859999999;8.12402800000007,-76.8420859999999;8.12402800000007,-76.84124799999989;8.12375000000014,-76.84124799999989;8.12375000000014,-76.84097199999989;8.123472000000049,-76.84097199999989;8.123472000000049,-76.840698;8.12319400000013,-76.840698;8.12319400000013,-76.84041599999991;8.12291600000003,-76.84041599999991;8.12291600000003,-76.83986;8.12263799999994,-76.83986;8.12263799999994,-76.839028;8.12291600000003,-76.839028;8.12291600000003,-76.83736399999999;8.12319400000013,-76.83736399999999;8.12319400000013,-76.837081;8.123472000000049,-76.837081;8.123472000000049,-76.8365249999999;8.12375000000014,-76.8365249999999;8.12375000000014,-76.836249;8.1243060000001,-76.836249;8.1243060000001,-76.8359759999999;8.124584000000031,-76.8359759999999;8.124584000000031,-76.83569299999991;8.12541600000014,-76.83569299999991;8.12541600000014,-76.8354199999999;8.1259720000001,-76.8354199999999;8.1259720000001,-76.8348609999999;8.126250000000031,-76.8348609999999;8.126250000000031,-76.8345879999999;8.1259720000001,-76.8345879999999;8.1259720000001,-76.8331909999999;8.12569400000007,-76.8331909999999;8.12569400000007,-76.8323589999999;8.12541600000014,-76.8323589999999;8.12541600000014,-76.83208499999991;8.12513800000005,-76.83208499999991;8.12513800000005,-76.8312539999999;8.12541600000014,-76.8312539999999;8.12541600000014,-76.83097099999991;8.12569400000007,-76.83097099999991;8.12569400000007,-76.830415;8.1259720000001,-76.830415;8.1259720000001,-76.8301389999999;8.126250000000031,-76.8301389999999;8.126250000000031,-76.829866;8.126528000000119,-76.829866;8.126528000000119,-76.829583;8.12680400000005,-76.829583;8.12680400000005,-76.8293069999999;8.127085000000021,-76.8293069999999;8.127085000000021,-76.8284749999999;8.127360000000071,-76.8284749999999;8.127360000000071,-76.8276369999999;8.127085000000021,-76.8276369999999;8.127085000000021,-76.8265309999999;8.127360000000071,-76.8265309999999;8.127360000000071,-76.826249;8.12764100000004,-76.826249;8.12763799999993,-76.82597299999991;8.127916000000029,-76.82597299999991;8.127916000000029,-76.82568999999999;8.128473000000101,-76.82568999999999;8.128473000000101,-76.825417;8.128751000000021,-76.825417;8.128751000000021,-76.8251409999999;8.12930700000004,-76.8251409999999;8.12930700000004,-76.824585;8.129582000000029,-76.824585;8.129582000000029,-76.824302;8.129863,-76.824302;8.129861000000011,-76.823753;8.130139000000099,-76.823753;8.130139000000099,-76.82347;8.130419000000019,-76.82347;8.130417000000021,-76.822914;8.13069500000012,-76.822914;8.13069500000012,-76.82236499999991;8.13097300000004,-76.82236499999991;8.13097300000004,-76.822082;8.13125100000013,-76.822082;8.13125100000013,-76.82152599999991;8.131529000000001,-76.82152599999991;8.131529000000001,-76.8206939999999;8.131805000000099,-76.8206939999999;8.131805000000099,-76.82013599999991;8.13208500000002,-76.82013599999991;8.132083000000019,-76.8190309999999;8.13236100000012,-76.8190309999999;8.13236100000012,-76.81735999999999;8.13263900000004,-76.81735999999999;8.13263900000004,-76.814584;8.13236100000012,-76.814584;8.13236100000012,-76.8140259999999;8.132083000000019,-76.8140259999999;8.13208500000002,-76.8134689999999;8.131805000000099,-76.8134689999999;8.131805000000099,-76.81292000000001;8.131529000000001,-76.81292000000001;8.131529000000001,-76.81263799999989;8.13125100000013,-76.81263799999989;8.13125100000013,-76.81236199999999;8.13097300000004,-76.81236199999999;8.13097300000004,-76.81180599999991;8.13069500000012,-76.81180599999991;8.13069500000012,-76.8115319999999;8.130417000000021,-76.8115319999999;8.130419000000019,-76.81125;8.129863,-76.81125;8.129863,-76.810974;8.129582000000029,-76.810974;8.129582000000029,-76.81069099999991;8.12930700000004,-76.81069099999991;8.12930700000004,-76.810142;8.129026000000071,-76.810142;8.129026000000071,-76.8098589999999;8.128751000000021,-76.8098589999999;8.128751000000021,-76.8093029999999;8.128473000000101,-76.8093029999999;8.128473000000101,-76.80903000000001;8.12819400000012,-76.80903000000001;8.12819400000012,-76.808747;8.127916000000029,-76.808747;8.127916000000029,-76.8084709999999;8.12763799999993,-76.8084709999999;8.12764100000004,-76.80819799999991;8.127360000000071,-76.80819799999991;8.127360000000071,-76.8076389999999;8.12764100000004,-76.8076389999999;8.12763799999993,-76.8073569999999;8.127916000000029,-76.8073569999999;8.127916000000029,-76.80708300000001;8.12819400000012,-76.80708300000001;8.12819400000012,-76.8073569999999;8.128473000000101,-76.8073569999999;8.128473000000101,-76.8076389999999;8.129026000000071,-76.8076389999999;8.129026000000071,-76.80791499999999;8.129582000000029,-76.80791499999999;8.129582000000029,-76.80819799999991;8.129863,-76.80819799999991;8.129861000000011,-76.8084709999999;8.130139000000099,-76.8084709999999;8.130139000000099,-76.808747;8.130419000000019,-76.808747;8.130417000000021,-76.80903000000001;8.13069500000012,-76.80903000000001;8.13069500000012,-76.8093029999999;8.13097300000004,-76.8093029999999;8.13097300000004,-76.8098589999999;8.13125100000013,-76.8098589999999;8.13125100000013,-76.810142;8.131529000000001,-76.810142;8.131529000000001,-76.810418;8.131805000000099,-76.810418;8.131805000000099,-76.81069099999991;8.13208500000002,-76.81069099999991;8.132083000000019,-76.810974;8.13236100000012,-76.810974;8.13236100000012,-76.8115319999999;8.13263900000004,-76.8115319999999;8.13263900000004,-76.81208100000001;8.132917000000131,-76.81208100000001;8.132917000000131,-76.81236199999999;8.133195000000001,-76.81236199999999;8.133195000000001,-76.81263799999989;8.133473000000089,-76.81263799999989;8.133473000000089,-76.81292000000001;8.13375100000002,-76.81292000000001;8.13375100000002,-76.8140259999999;8.134027000000121,-76.8140259999999;8.134027000000121,-76.814584;8.134307000000041,-76.814584;8.13430500000004,-76.81514;8.134583000000131,-76.81514;8.134583000000131,-76.815414;8.13430500000004,-76.815414;8.13430500000004,-76.8156959999999;8.134583000000131,-76.8156959999999;8.134583000000131,-76.816255;8.134861000000001,-76.816255;8.134861000000001,-76.817916;8.135139000000089,-76.817916;8.135139000000089,-76.818748;8.13541700000002,-76.818748;8.13541700000002,-76.819306;8.13569500000011,-76.819306;8.13569500000011,-76.81958;8.135973000000041,-76.81958;8.135971000000041,-76.8206939999999;8.136249000000131,-76.8206939999999;8.136249000000131,-76.82152599999991;8.136529,-76.82152599999991;8.136526999999999,-76.822082;8.13680500000009,-76.822082;8.13680500000009,-76.822638;8.13708300000002,-76.822638;8.13708300000002,-76.8251409999999;8.13680500000009,-76.8251409999999;8.13680500000009,-76.82568999999999;8.136526999999999,-76.82568999999999;8.136529,-76.826249;8.136249000000131,-76.826249;8.136249000000131,-76.82680499999989;8.135971000000041,-76.82680499999989;8.135973000000041,-76.82708;8.13569500000011,-76.82708;8.13569500000011,-76.82736299999991;8.13541700000002,-76.82736299999991;8.13541700000002,-76.8276369999999;8.135139000000089,-76.8276369999999;8.135139000000089,-76.8281929999999;8.134861000000001,-76.8281929999999;8.134861000000001,-76.8284749999999;8.134583000000131,-76.8284749999999;8.134583000000131,-76.8293069999999;8.13430500000004,-76.8293069999999;8.134307000000041,-76.829866;8.134027000000121,-76.829866;8.134027000000121,-76.8301389999999;8.13375100000002,-76.8301389999999;8.13375100000002,-76.83069499999991;8.133473000000089,-76.83069499999991;8.133473000000089,-76.83208499999991;8.133195000000001,-76.83208499999991;8.133195000000001,-76.8334729999999;8.132917000000131,-76.8334729999999;8.132917000000131,-76.836249;8.133195000000001,-76.836249;8.133195000000001,-76.8365249999999;8.133473000000089,-76.8365249999999;8.133473000000089,-76.83680799999991;8.13375100000002,-76.83680799999991;8.13375100000002,-76.837081;8.135973000000041,-76.837081;8.135971000000041,-76.83680799999991;8.136249000000131,-76.83680799999991;8.136249000000131,-76.836249;8.136529,-76.836249;8.136526999999999,-76.8359759999999;8.13680500000009,-76.8359759999999;8.13680500000009,-76.83569299999991;8.137917000000069,-76.83569299999991;8.137917000000069,-76.8359759999999;8.138195,-76.8359759999999;8.138195,-76.8384719999999;8.137917000000069,-76.8384719999999;8.137917000000069,-76.839028;8.137639000000039,-76.839028;8.137639000000039,-76.83930099999991;8.13736100000011,-76.83930099999991;8.13736100000011,-76.83986;8.13708300000002,-76.83986;8.13708300000002,-76.8420859999999;8.13680500000009,-76.8420859999999;8.13680500000009,-76.84236199999999;8.13708300000002,-76.84236199999999;8.13708300000002,-76.8434739999999;8.13680500000009,-76.8434739999999;8.13680500000009,-76.8437499999999;8.136684000000059,-76.8437499999999;8.136526999999999,-76.8437499999999;8.136529,-76.8445819999999;8.136249000000131,-76.8445819999999;8.136249000000131,-76.845696;8.135971000000041,-76.845696;8.135973000000041,-76.847358;8.13569500000011,-76.847358;8.13569500000011,-76.8484719999999;8.13541700000002,-76.8484719999999;8.13541700000002,-76.849029;8.13569500000011,-76.849029;8.13569500000011,-76.850692;8.13541700000002,-76.850692;8.13541700000002,-76.85180699999999;8.135139000000089,-76.85180699999999;8.135139000000089,-76.8529119999999;8.134861000000001,-76.8529119999999;8.134861000000001,-76.8537529999999;8.135139000000089,-76.8537529999999;8.135139000000089,-76.854027;8.134861000000001,-76.854027;8.134861000000001,-76.85569700000001;8.134583000000131,-76.85569700000001;8.134583000000131,-76.85680499999999;8.134861000000001,-76.85680499999999;8.134861000000001,-76.858749;8.134583000000131,-76.858749;8.134583000000131,-76.85958099999991;8.13430500000004,-76.85958099999991;8.134307000000041,-76.86069500000001;8.134027000000121,-76.86069500000001;8.134027000000121,-76.8618079999999;8.13375100000002,-76.8618079999999;8.13375100000002,-76.86403;8.133473000000089,-76.86403;8.133473000000089,-76.864859;8.133195000000001,-76.864859;8.133195000000001,-76.8668059999999;8.132917000000131,-76.8668059999999;8.132917000000131,-76.8679199999999;8.13263900000004,-76.8679199999999;8.13263900000004,-76.86902600000001;8.13236100000012,-76.86902600000001;8.13236100000012,-76.869308;8.132083000000019,-76.869308;8.13208500000002,-76.8695839999999;8.131805000000099,-76.8695839999999;8.131805000000099,-76.86985799999999;8.13125100000013,-76.86985799999999;8.13125100000013,-76.87013999999991;8.13097300000004,-76.87013999999991;8.13097300000004,-76.8704139999999;8.13069500000012,-76.8704139999999;8.13069500000012,-76.8715279999999;8.13097300000004,-76.8715279999999;8.13097300000004,-76.872643;8.13069500000012,-76.872643;8.13069500000012,-76.873192;8.130417000000021,-76.873192;8.130419000000019,-76.8745799999999;8.130139000000099,-76.8745799999999;8.130139000000099,-76.87541899999989;8.129861000000011,-76.87541899999989;8.129863,-76.8804169999999;8.129582000000029,-76.8804169999999;8.129582000000029,-76.8812489999999;8.129863,-76.8812489999999;8.129861000000011,-76.8840249999999;8.130139000000099,-76.8840249999999;8.130139000000099,-76.88458299999991;8.13069500000012,-76.88458299999991;8.13069500000012,-76.8865269999999;8.13097300000004,-76.8865269999999;8.13097300000004,-76.8873589999999;8.13125100000013,-76.8873589999999;8.13125100000013,-76.8887469999999;8.131529000000001,-76.8887469999999;8.131529000000001,-76.89125;8.131805000000099,-76.89125;8.131805000000099,-76.893472;8.13208500000002,-76.893472;8.132083000000019,-76.89402799999991;8.13236100000012,-76.89402799999991;8.13236100000012,-76.894584;8.132083000000019,-76.894584;8.13208500000002,-76.8948599999999;8.131805000000099,-76.8948599999999;8.131805000000099,-76.894584;8.131529000000001,-76.894584;8.131529000000001,-76.894301;8.13125100000013,-76.894301;8.13125100000013,-76.89375199999991;8.13097300000004,-76.89375199999991;8.13097300000004,-76.893472;8.13069500000012,-76.893472;8.13069500000012,-76.8931959999999;8.130417000000021,-76.8931959999999;8.130419000000019,-76.89291299999989;8.130139000000099,-76.89291299999989;8.130139000000099,-76.89264;8.129861000000011,-76.89264;8.129863,-76.8923639999999;8.12930700000004,-76.8923639999999;8.12930700000004,-76.89208100000001;8.129026000000071,-76.89208100000001;8.129026000000071,-76.8915249999999;8.12930700000004,-76.8915249999999;8.12930700000004,-76.890976;8.129026000000071,-76.890976;8.129026000000071,-76.8906929999999;8.128751000000021,-76.8906929999999;8.128751000000021,-76.89041999999991;8.127916000000029,-76.89041999999991;8.127916000000029,-76.89125;8.12819400000012,-76.89125;8.12819400000012,-76.891808;8.12680400000005,-76.891808;8.12680400000005,-76.8915249999999;8.12569400000007,-76.8915249999999;8.12569400000007,-76.89125;8.12541600000014,-76.89125;8.12541600000014,-76.890976;8.12513800000005,-76.890976;8.12513800000005,-76.8906929999999;8.12486000000013,-76.8906929999999;8.124862000000119,-76.89041999999991;8.124584000000031,-76.89041999999991;8.124584000000031,-76.88986199999989;8.1243060000001,-76.88986199999989;8.1243060000001,-76.8895789999999;8.12402800000007,-76.8895789999999;8.12402800000007,-76.88930499999999;8.12319400000013,-76.88930499999999;8.12319400000013,-76.88902999999991;8.12263799999994,-76.88902999999991;8.12263799999994,-76.8887469999999;8.11958400000003,-76.8887469999999;8.11958400000003,-76.888474;8.11875000000015,-76.888474;8.11875000000015,-76.88819099999991;8.11819399999996,-76.88819099999991;8.11819399999996,-76.887917;8.11625000000004,-76.887917;8.11625200000003,-76.88819099999991;8.115696000000071,-76.88819099999991;8.115696000000071,-76.888474;8.11514000000005,-76.888474;8.11514000000005,-76.8887469999999;8.11486199999996,-76.8887469999999;8.11486199999996,-76.88902999999991;8.114583000000151,-76.88902999999991;8.114583000000151,-76.88930499999999;8.11430500000006,-76.88930499999999;8.11430500000006,-76.8895789999999;8.114026999999959,-76.8895789999999;8.114030000000071,-76.88986199999989;8.1137490000001,-76.88986199999989;8.1137490000001,-76.89041999999991;8.113471000000001,-76.89041999999991;8.11347400000005,-76.8906929999999;8.113195000000079,-76.8906929999999;8.113195000000079,-76.89125;8.112917000000151,-76.89125;8.112917000000151,-76.8915249999999;8.11263900000006,-76.8915249999999;8.11263900000006,-76.891808;8.112360999999961,-76.891808;8.112360999999961,-76.8923639999999;8.1120830000001,-76.8923639999999;8.1120830000001,-76.89264;8.111805,-76.89264;8.11180800000005,-76.893472;8.111527000000081,-76.893472;8.111527000000081,-76.89375199999991;8.111249000000161,-76.89375199999991;8.11125100000015,-76.894301;8.11097300000006,-76.894301;8.11097300000006,-76.895416;8.110694999999961,-76.895416;8.11069800000007,-76.896248;8.1104170000001,-76.896248;8.1104170000001,-76.8965299999999;8.110139,-76.8965299999999;8.110139,-76.896804;8.109583000000161,-76.896804;8.109583000000161,-76.8970859999999;8.10930500000006,-76.8970859999999;8.10930500000006,-76.8973619999999;8.109026999999969,-76.8973619999999;8.109028999999961,-76.89763600000001;8.108473,-76.89763600000001;8.108473,-76.89791799999991;8.106807,-76.89791799999991;8.106807,-76.8981939999999;8.105973000000059,-76.8981939999999;8.105973000000059,-76.8984769999999;8.105694999999971,-76.8984769999999;8.105694999999971,-76.89875000000001;8.10513900000001,-76.89875000000001;8.10513900000001,-76.89902599999991;8.10486100000008,-76.89902599999991;8.10486100000008,-76.899306;8.104305000000069,-76.899306;8.104305000000069,-76.899582;8.10402899999997,-76.899582;8.10402899999997,-76.89986499999991;8.1037510000001,-76.89986499999991;8.1037510000001,-76.900138;8.10347300000001,-76.900138;8.10347300000001,-76.900414;8.103195000000079,-76.900414;8.103195000000079,-76.90069699999989;8.102916999999991,-76.90069699999989;8.102916999999991,-76.90097;8.102639000000069,-76.90097;8.102639000000069,-76.9012529999999;8.10236000000009,-76.9012529999999;8.10236000000009,-76.9015279999999;8.10180700000001,-76.9015279999999;8.10180700000001,-76.901802;8.101529000000079,-76.901802;8.101529000000079,-76.90235799999989;8.101250999999991,-76.90235799999989;8.101250999999991,-76.90291599999991;8.100972000000009,-76.90291599999991;8.100972000000009,-76.904304;8.10069400000009,-76.904304;8.10069400000009,-76.9048609999999;8.100415999999999,-76.9048609999999;8.100415999999999,-76.9073629999999;8.100138000000131,-76.9073629999999;8.100138000000131,-76.90819499999991;8.099860000000041,-76.90819499999991;8.099860000000041,-76.90847100000001;8.09958400000011,-76.90847100000001;8.09958400000011,-76.90875299999991;8.09930400000002,-76.90875299999991;8.09930400000002,-76.9090269999999;8.099028000000089,-76.9090269999999;8.099028000000089,-76.90958499999989;8.098750000000001,-76.90958499999989;8.098750000000001,-76.9101409999999;8.098472000000131,-76.9101409999999;8.098472000000131,-76.9106969999999;8.09819400000004,-76.9106969999999;8.09819400000004,-76.9109729999999;8.09791600000011,-76.9109729999999;8.09791600000011,-76.9115289999999;8.097638000000019,-76.9115289999999;8.097640000000011,-76.91208499999991;8.097362000000089,-76.91208499999991;8.097362000000089,-76.91236099999991;8.097082,-76.91236099999991;8.097084000000001,-76.91291699999989;8.096806000000131,-76.91291699999989;8.096806000000131,-76.9137489999999;8.09652800000003,-76.9137489999999;8.09652800000003,-76.91430799999991;8.09625000000011,-76.91430799999991;8.09625000000011,-76.91486399999999;8.095972000000019,-76.91486399999999;8.095972000000019,-76.9154129999999;8.095694000000091,-76.9154129999999;8.095694000000091,-76.916252;8.095416,-76.916252;8.095418,-76.9168099999999;8.09513800000013,-76.9168099999999;8.09513800000013,-76.917084;8.094862000000029,-76.917084;8.094862000000029,-76.91763999999991;8.09458400000011,-76.91763999999991;8.09458400000011,-76.91791499999989;8.094306000000021,-76.91791499999989;8.094306000000021,-76.9184719999999;8.09402800000009,-76.9184719999999;8.09402800000009,-76.91903000000001;8.09375,-76.91903000000001;8.09375,-76.919586;8.09347200000013,-76.919586;8.09347200000013,-76.9201349999999;8.09319400000004,-76.9201349999999;8.093196000000029,-76.9209739999999;8.09291600000012,-76.9209739999999;8.09291600000012,-76.92125;8.092640000000021,-76.92125;8.092640000000021,-76.9218059999999;8.09236200000009,-76.9218059999999;8.09236200000009,-76.922364;8.092084,-76.922364;8.092084,-76.92292000000001;8.09180600000013,-76.92292000000001;8.09180600000013,-76.9234699999999;8.091528000000039,-76.9234699999999;8.091530000000031,-76.9243079999999;8.09125000000012,-76.9243079999999;8.09125000000012,-76.9248579999999;8.09097200000002,-76.9248579999999;8.090974000000021,-76.929031;8.0906940000001,-76.929031;8.0906940000001,-76.92958;8.090974000000021,-76.92958;8.09097200000002,-76.9301379999999;8.09125000000012,-76.9301379999999;8.09125000000012,-76.930421;8.091530000000031,-76.930421;8.091528000000039,-76.9309699999999;8.09180600000013,-76.9309699999999;8.09180600000013,-76.931251;8.092084,-76.931251;8.092084,-76.93152600000001;8.092640000000021,-76.93152600000001;8.092640000000021,-76.9318089999999;8.093196000000029,-76.9318089999999;8.09319400000004,-76.93235799999999;8.09347200000013,-76.93235799999999;8.09347200000013,-76.9326409999999;8.09375,-76.9326409999999;8.09375,-76.932914;8.094306000000021,-76.932914;8.094306000000021,-76.93319700000001;8.094862000000029,-76.93319700000001;8.094862000000029,-76.93347299999991;8.095418,-76.93347299999991;8.095416,-76.933746;8.09625000000011,-76.933746;8.09625000000011,-76.934029;8.096806000000131,-76.934029;8.096806000000131,-76.934585;8.097084000000001,-76.934585;8.097082,-76.935417;8.097362000000089,-76.935417;8.097362000000089,-76.935693;8.097640000000011,-76.935693;8.097638000000019,-76.935417;8.09791600000011,-76.935417;8.09791600000011,-76.934861;8.098472000000131,-76.934861;8.098472000000131,-76.934585;8.09958400000011,-76.934585;8.09958400000011,-76.9343019999999;8.100138000000131,-76.9343019999999;8.100138000000131,-76.934585;8.10069400000009,-76.934585;8.10069400000009,-76.93680499999989;8.100415999999999,-76.93680499999989;8.100415999999999,-76.93708100000001;8.100138000000131,-76.93708100000001;8.100138000000131,-76.93736299999991;8.099860000000041,-76.93736299999991;8.099860000000041,-76.9393069999999;8.100415999999999,-76.9393069999999;8.100415999999999,-76.939857;8.10069400000009,-76.939857;8.10069400000009,-76.9401389999999;8.101250999999991,-76.9401389999999;8.101250999999991,-76.9406979999999;8.101529000000079,-76.9406979999999;8.101529000000079,-76.94097099999991;8.102081999999999,-76.94097099999991;8.102081999999999,-76.940415;8.10180700000001,-76.940415;8.10180700000001,-76.9401389999999;8.101529000000079,-76.9401389999999;8.101529000000079,-76.936249;8.10180700000001,-76.936249;8.10180700000001,-76.93597299999991;8.102081999999999,-76.93597299999991;8.102081999999999,-76.935693;8.10236000000009,-76.935693;8.10236000000009,-76.935417;8.102639000000069,-76.935417;8.102639000000069,-76.9351429999999;8.102916999999991,-76.9351429999999;8.102916999999991,-76.934861;8.10347300000001,-76.934861;8.10347300000001,-76.934585;8.10405200000014,-76.934585;8.10486100000008,-76.934585;8.10486100000008,-76.9347539999999;8.10486100000008,-76.934861;8.10513900000001,-76.934861;8.10513900000001,-76.9351429999999;8.105694999999971,-76.9351429999999;8.105694999999971,-76.935417;8.106248999999989,-76.935417;8.106248999999989,-76.935693;8.10652700000009,-76.935693;8.10652700000009,-76.93597299999991;8.107083000000101,-76.93597299999991;8.107083000000101,-76.936249;8.10791900000015,-76.936249;8.10791700000016,-76.9365309999999;8.108751000000099,-76.9365309999999;8.108751000000099,-76.935547;8.108751000000099,-76.934861;8.109028999999961,-76.934861;8.109028999999961,-76.934585;8.109583000000161,-76.934585;8.109583000000161,-76.9343019999999;8.10986100000008,-76.9343019999999;8.10986100000008,-76.934585;8.11097300000006,-76.934585;8.11097300000006,-76.934861;8.111527000000081,-76.934861;8.111527000000081,-76.9351429999999;8.11180800000005,-76.9351429999999;8.11180800000005,-76.935417;8.112360999999961,-76.935417;8.112360999999961,-76.93597299999991;8.11263900000006,-76.93597299999991;8.11263900000006,-76.936249;8.112917000000151,-76.936249;8.112917000000151,-76.9365309999999;8.113195000000079,-76.9365309999999;8.113195000000079,-76.936746;8.113195000000079,-76.93708100000001;8.11347400000005,-76.93708100000001;8.11347400000005,-76.93736299999991;8.114030000000071,-76.937416;8.114026999999959,-76.9376369999999;8.11430500000006,-76.9376369999999;8.11430500000006,-76.93791899999989;8.114583000000151,-76.93791899999989;8.114583000000151,-76.93819499999999;8.11486199999996,-76.93819499999999;8.11486199999996,-76.9384689999999;8.11514000000005,-76.9384689999999;8.11514000000005,-76.939025;8.115418000000149,-76.939025;8.115418000000149,-76.9393069999999;8.115696000000071,-76.9393069999999;8.115692999999959,-76.939583;8.11597100000006,-76.939583;8.11597100000006,-76.939857;8.11625200000003,-76.939857;8.11625000000004,-76.9401389999999;8.11652799999996,-76.9401389999999;8.11652799999996,-76.9406979999999;8.11680800000005,-76.9406979999999;8.11680600000005,-76.94152699999999;8.117084000000149,-76.94152699999999;8.117084000000149,-76.9420859999999;8.117362000000069,-76.9420859999999;8.117362000000069,-76.94291799999991;8.117638,-76.94291799999991;8.117638,-76.943749;8.11791800000003,-76.943749;8.11791800000003,-76.944579;8.11819399999996,-76.944579;8.11819399999996,-76.9451369999999;8.118474000000051,-76.9451369999999;8.11847200000005,-76.9456939999999;8.11875000000015,-76.9456939999999;8.11875000000015,-76.9462519999999;8.11903000000007,-76.9462519999999;8.119028000000069,-76.94680799999991;8.11930599999994,-76.94680799999991;8.11930599999994,-76.9470819999999;8.11958400000003,-76.9470819999999;8.11958400000003,-76.94736399999989;8.11985999999996,-76.94736399999989;8.11985999999996,-76.947913;8.12041600000015,-76.947913;8.12041600000015,-76.9484719999999;8.12069400000007,-76.9484719999999;8.12069400000007,-76.94875399999989;8.12097199999994,-76.94875399999989;8.12097199999994,-76.9490279999999;8.121528000000129,-76.9490279999999;8.121528000000129,-76.9493039999999;8.121806000000049,-76.9493039999999;8.121806000000049,-76.9495839999999;8.12208400000014,-76.9495839999999;8.12208400000014,-76.9498599999999;8.12236200000007,-76.9498599999999;8.12236200000007,-76.950142;8.12263799999994,-76.950142;8.12263799999994,-76.95041599999991;8.12291600000003,-76.95041599999991;8.12291600000003,-76.9506919999999;8.12319400000013,-76.9506919999999;8.12319400000013,-76.9509739999999;8.123472000000049,-76.9509739999999;8.123472000000049,-76.95124799999989;8.124862000000119,-76.95124799999989;8.12486000000013,-76.95152999999991;8.12541600000014,-76.95152999999991;8.12541600000014,-76.9520799999999;8.1259720000001,-76.9520799999999;8.1259720000001,-76.95236199999989;8.129863,-76.95236199999989;8.129861000000011,-76.9520799999999;8.13069500000012,-76.9520799999999;8.13069500000012,-76.95180599999991;8.131529000000001,-76.95180599999991;8.131529000000001,-76.95152999999991;8.133195000000001,-76.95152999999991;8.133195000000001,-76.95124799999989;8.133473000000089,-76.95124799999989;8.133473000000089,-76.9509739999999;8.13375100000002,-76.9509739999999;8.13375100000002,-76.95041599999991;8.134027000000121,-76.95041599999991;8.134027000000121,-76.9498599999999;8.134307000000041,-76.9498599999999;8.134307000000041,-76.9495839999999;8.134861000000001,-76.9495839999999;8.134861000000001,-76.9493039999999;8.13541700000002,-76.9493039999999;8.13541700000002,-76.9490279999999;8.14069599999999,-76.9490279999999;8.14069599999999,-76.9493039999999;8.14124900000007,-76.9493039999999;8.14124900000007,-76.9495839999999;8.14208400000007,-76.9495839999999;8.14208400000007,-76.9498599999999;8.14236199999999,-76.9498599999999;8.14236199999999,-76.950142;8.143193,-76.950142;8.143193,-76.95041599999991;8.14375000000007,-76.95041599999991;8.14375000000007,-76.950142;8.145139999999969,-76.950142;8.145139999999969,-76.9498599999999;8.14569399999999,-76.9498599999999;8.14569399999999,-76.9493039999999;8.1465280000001,-76.9493039999999;8.1465280000001,-76.9490279999999;8.14708400000006,-76.9490279999999;8.14708400000006,-76.94875399999989;8.147362000000159,-76.94875399999989;8.147362000000159,-76.9484719999999;8.147918000000001,-76.9484719999999;8.147918000000001,-76.9481959999999;8.148473999999959,-76.9481959999999;8.14847199999997,-76.947913;8.14875000000006,-76.947913;8.14875000000006,-76.94763999999989;8.149028000000159,-76.94763999999989;8.149028000000159,-76.94736399999989;8.149306000000079,-76.94736399999989;8.149306000000079,-76.9470819999999;8.149584000000001,-76.9470819999999;8.149582000000009,-76.94680799999991;8.15013799999997,-76.94680799999991;8.15013799999997,-76.94652499999999;8.15041600000006,-76.94652499999999;8.15041600000006,-76.9462519999999;8.150972000000079,-76.9462519999999;8.150972000000079,-76.94596899999991;8.151249999999999,-76.94596899999991;8.151249999999999,-76.9456939999999;8.152362000000149,-76.9456939999999;8.152362000000149,-76.9454199999999;8.15291900000005,-76.9454199999999;8.152915999999999,-76.9451369999999;8.15319400000004,-76.9451369999999;8.15319400000004,-76.9448619999999;8.153471999999971,-76.9448619999999;8.153471999999971,-76.944579;8.153750000000059,-76.944579;8.153750000000059,-76.9440299999999;8.15402800000015,-76.9440299999999;8.15402800000015,-76.943749;8.154307000000131,-76.943749;8.154307000000131,-76.9434739999999;8.154585000000051,-76.9434739999999;8.154582,-76.943191;8.155416000000059,-76.943191;8.155416000000059,-76.9434739999999;8.155973000000129,-76.9434739999999;8.155973000000129,-76.943749;8.15652600000004,-76.943749;8.15652600000004,-76.9440299999999;8.15847300000007,-76.9440299999999;8.15847300000007,-76.943749;8.159029000000031,-76.943749;8.159029000000031,-76.9440299999999;8.15958500000005,-76.9440299999999;8.15958500000005,-76.9443059999999;8.16014100000001,-76.9443059999999;8.16014100000001,-76.944579;8.160695000000031,-76.944579;8.160695000000031,-76.9448619999999;8.16097300000013,-76.9448619999999;8.16097300000013,-76.9451369999999;8.16125100000005,-76.9451369999999;8.16125100000005,-76.9454199999999;8.162082999999941,-76.9454199999999;8.162082999999941,-76.9456939999999;8.16319500000014,-76.9456939999999;8.16319500000014,-76.944579;8.16291700000005,-76.944579;8.16291700000005,-76.9443059999999;8.162361000000031,-76.9443059999999;8.162361000000031,-76.944579;8.162082999999941,-76.944579;8.162082999999941,-76.944374;8.162082999999941,-76.9440299999999;8.16180500000007,-76.9440299999999;8.16180500000007,-76.943749;8.161527000000151,-76.943749;8.161527000000151,-76.9434739999999;8.16125100000005,-76.9434739999999;8.16125100000005,-76.943191;8.16097300000013,-76.943191;8.16097300000013,-76.94291799999991;8.160695000000031,-76.94291799999991;8.160695000000031,-76.9420859999999;8.16097300000013,-76.9420859999999;8.16097300000013,-76.94180299999989;8.16180500000007,-76.94180299999989;8.16180500000007,-76.9420859999999;8.162082999999941,-76.9420859999999;8.162082999999941,-76.942359;8.162361000000031,-76.942359;8.162361000000031,-76.94264199999991;8.16319500000014,-76.94264199999991;8.16319500000014,-76.94291799999991;8.16347300000001,-76.94291799999991;8.16347300000001,-76.943191;8.164027000000029,-76.943191;8.164027000000029,-76.9434739999999;8.16458300000005,-76.9434739999999;8.16458300000005,-76.943191;8.164861000000141,-76.943191;8.164861000000141,-76.94291799999991;8.166527000000141,-76.94291799999991;8.166527000000141,-76.94264199999991;8.166805000000011,-76.94264199999991;8.166805000000011,-76.94152699999999;8.166527000000141,-76.94152699999999;8.166527000000141,-76.94097099999991;8.16624900000005,-76.94097099999991;8.16624900000005,-76.9401389999999;8.16597100000013,-76.9401389999999;8.16597300000012,-76.939857;8.165693000000029,-76.939857;8.165693000000029,-76.939583;8.16541699999993,-76.939583;8.16541699999993,-76.938751;8.165139000000011,-76.938751;8.165139000000011,-76.9384689999999;8.164861000000141,-76.9384689999999;8.164861000000141,-76.93819499999999;8.16458300000005,-76.93819499999999;8.16458300000005,-76.93736299999991;8.164861000000141,-76.93736299999991;8.164861000000141,-76.93708100000001;8.16541699999993,-76.93708100000001;8.16541699999993,-76.9365309999999;8.165693000000029,-76.9365309999999;8.165693000000029,-76.93597299999991;8.16541699999993,-76.93597299999991;8.16541699999993,-76.935693;8.164861000000141,-76.935693;8.164861000000141,-76.935417;8.162082999999941,-76.935417;8.162082999999941,-76.935693;8.161527000000151,-76.935693;8.161527000000151,-76.93597299999991;8.16041699999994,-76.93597299999991;8.16041699999994,-76.935693;8.160006999999951,-76.935693;8.159583000000049,-76.935693;8.15958500000005,-76.935417;8.15930500000013,-76.935417;8.15930500000013,-76.9351429999999;8.159029000000031,-76.9351429999999;8.159029000000031,-76.934861;8.15874899999994,-76.934861;8.15874899999994,-76.934585;8.15847300000007,-76.934585;8.15847300000007,-76.933746;8.15819500000015,-76.933746;8.15819500000015,-76.93319700000001;8.15847300000007,-76.93319700000001;8.15847300000007,-76.9326409999999;8.15874899999994,-76.9326409999999;8.15874899999994,-76.93208300000001;8.159029000000031,-76.93208300000001;8.159029000000031,-76.9318089999999;8.15930500000013,-76.9318089999999;8.15930500000013,-76.93152600000001;8.15958500000005,-76.93152600000001;8.159583000000049,-76.931251;8.15986100000015,-76.931251;8.15986100000015,-76.9309699999999;8.16014100000001,-76.9309699999999;8.16013900000007,-76.930695;8.16041699999994,-76.930695;8.16041699999994,-76.930421;8.160695000000031,-76.930421;8.160695000000031,-76.9301379999999;8.16097300000013,-76.9301379999999;8.16097300000013,-76.929863;8.16291700000005,-76.929863;8.16291700000005,-76.929031;8.16263900000013,-76.929031;8.16263900000013,-76.928748;8.162082999999941,-76.928748;8.162082999999941,-76.92624599999991;8.162361000000031,-76.92624599999991;8.162361000000031,-76.9259719999999;8.16319500000014,-76.9259719999999;8.16319500000014,-76.92652800000001;8.16347300000001,-76.92652800000001;8.16347300000001,-76.92735999999999;8.163748999999941,-76.92735999999999;8.163748999999941,-76.927919;8.164027000000029,-76.927919;8.164027000000029,-76.928192;8.16430500000013,-76.928192;8.16430500000013,-76.92847499999991;8.16458300000005,-76.92847499999991;8.16458300000005,-76.928748;8.165139000000011,-76.928748;8.165139000000011,-76.92847499999991;8.16541699999993,-76.92847499999991;8.16541699999993,-76.928192;8.166805000000011,-76.928192;8.166805000000011,-76.928748;8.16708600000004,-76.928748;8.167082999999931,-76.929031;8.16736100000003,-76.929031;8.16736100000003,-76.9293069999999;8.16763900000012,-76.9293069999999;8.16763900000012,-76.92958;8.16791500000005,-76.92958;8.16791500000005,-76.929863;8.16819600000002,-76.929863;8.16819600000002,-76.9301379999999;8.168471000000009,-76.9301379999999;8.168471000000009,-76.930695;8.168748999999931,-76.930695;8.168748999999931,-76.9318089999999;8.16902700000003,-76.9318089999999;8.16902700000003,-76.9326409999999;8.169307999999999,-76.9326409999999;8.16930600000001,-76.932914;8.1695840000001,-76.932914;8.1695840000001,-76.93319700000001;8.170140000000121,-76.93319700000001;8.170140000000121,-76.932914;8.170418000000041,-76.932914;8.170418000000041,-76.9326409999999;8.17069400000014,-76.9326409999999;8.17069400000014,-76.93235799999999;8.17153000000002,-76.93235799999999;8.17152800000002,-76.93208300000001;8.171806000000119,-76.93208300000001;8.171806000000119,-76.9318089999999;8.172084000000041,-76.9318089999999;8.172084000000041,-76.93152600000001;8.17236200000008,-76.93152600000001;8.17236200000008,-76.931251;8.17264,-76.931251;8.17264,-76.9309699999999;8.1729160000001,-76.9309699999999;8.1729160000001,-76.92958;8.17319600000002,-76.92958;8.17319600000002,-76.9293069999999;8.17402800000008,-76.9293069999999;8.17402800000008,-76.929031;8.174306,-76.929031;8.174306,-76.927919;8.17402800000008,-76.927919;8.17402800000008,-76.92763599999989;8.173750000000039,-76.92763599999989;8.173750000000039,-76.92735999999999;8.173472000000119,-76.92735999999999;8.173472000000119,-76.927087;8.17319600000002,-76.927087;8.17319600000002,-76.92680399999991;8.1729160000001,-76.92680399999991;8.1729160000001,-76.92652800000001;8.17236200000008,-76.92652800000001;8.17236200000008,-76.92624599999991;8.17152800000002,-76.92624599999991;8.17153000000002,-76.925696;8.1712500000001,-76.925696;8.1712500000001,-76.925416;8.17153000000002,-76.925416;8.17152800000002,-76.92292000000001;8.171806000000119,-76.92292000000001;8.171806000000119,-76.922082;8.17152800000002,-76.922082;8.17152800000002,-76.92125;8.171806000000119,-76.92125;8.171806000000119,-76.9209739999999;8.172084000000041,-76.9209739999999;8.172084000000041,-76.92125;8.17236200000008,-76.92125;8.17236200000008,-76.92152299999989;8.17264,-76.92152299999989;8.17264,-76.9218059999999;8.1729160000001,-76.9218059999999;8.1729160000001,-76.922082;8.17319600000002,-76.922082;8.17319600000002,-76.922364;8.173472000000119,-76.922364;8.173472000000119,-76.92263799999991;8.173750000000039,-76.92263799999991;8.173750000000039,-76.92292000000001;8.174862000000021,-76.92292000000001;8.174862000000021,-76.923194;8.175417999999979,-76.923194;8.175416000000039,-76.9234699999999;8.176250000000101,-76.9234699999999;8.176250000000101,-76.92375199999999;8.176528000000021,-76.92375199999999;8.176528000000021,-76.9234699999999;8.177083999999979,-76.9234699999999;8.17708200000004,-76.92292000000001;8.17736200000007,-76.92292000000001;8.17736200000007,-76.9218059999999;8.17708200000004,-76.9218059999999;8.177083999999979,-76.92152299999989;8.176806000000109,-76.92152299999989;8.176806000000109,-76.92125;8.176528000000021,-76.92125;8.176528000000021,-76.920418;8.176250000000101,-76.920418;8.176250000000101,-76.9184719999999;8.176528000000021,-76.9184719999999;8.176528000000021,-76.91763999999991;8.176806000000109,-76.91763999999991;8.176806000000109,-76.91735899999991;8.177083999999979,-76.91735899999991;8.17708200000004,-76.9165269999999;8.17736200000007,-76.9165269999999;8.17736200000007,-76.91596899999991;8.17764,-76.91596899999991;8.17764,-76.9156959999999;8.178194000000021,-76.9156959999999;8.178194000000021,-76.9151369999999;8.178472000000109,-76.9151369999999;8.178472000000109,-76.9145809999999;8.17902800000007,-76.9145809999999;8.17902800000007,-76.91430799999991;8.179306,-76.91430799999991;8.179306,-76.9140249999999;8.179584000000091,-76.9140249999999;8.179584000000091,-76.91430799999991;8.18013800000011,-76.91430799999991;8.18013800000011,-76.9145809999999;8.18069400000007,-76.9145809999999;8.18069400000007,-76.9115289999999;8.180972000000001,-76.9115289999999;8.180972000000001,-76.9112469999999;8.18180699999999,-76.9112469999999;8.18180699999999,-76.9115289999999;8.18208199999998,-76.9115289999999;8.18208199999998,-76.9126369999999;8.18236000000007,-76.9126369999999;8.18236000000007,-76.91291699999989;8.18264100000005,-76.91291699999989;8.182638000000001,-76.91319299999989;8.183195000000071,-76.91319299999989;8.183195000000071,-76.9134759999999;8.18347299999999,-76.9134759999999;8.18347299999999,-76.9137489999999;8.18375100000009,-76.9137489999999;8.18375100000009,-76.9140249999999;8.18402900000001,-76.9140249999999;8.18402900000001,-76.91430799999991;8.18430500000011,-76.91430799999991;8.18430500000011,-76.9156959999999;8.18402900000001,-76.9156959999999;8.18402900000001,-76.91596899999991;8.18375100000009,-76.91596899999991;8.18375100000009,-76.916252;8.183195000000071,-76.916252;8.183195000000071,-76.9165269999999;8.18291699999997,-76.9165269999999;8.18291699999997,-76.917084;8.182638000000001,-76.917084;8.182638000000001,-76.918198;8.18291699999997,-76.918198;8.18291699999997,-76.9184719999999;8.18375100000009,-76.9184719999999;8.18375100000009,-76.91735899999991;8.18402900000001,-76.91735899999991;8.18402900000001,-76.917084;8.18430500000011,-76.917084;8.18430500000011,-76.9168099999999;8.184861000000071,-76.9168099999999;8.184861000000071,-76.9165269999999;8.18569500000001,-76.9165269999999;8.18569500000001,-76.916252;8.186529000000061,-76.916252;8.186529000000061,-76.91596899999991;8.187639000000051,-76.91596899999991;8.187639000000051,-76.916252;8.188195000000061,-76.916252;8.188195000000061,-76.9165269999999;8.18875100000008,-76.9165269999999;8.18875100000008,-76.916252;8.18902899999995,-76.916252;8.18902700000001,-76.91596899999991;8.190973000000041,-76.91596899999991;8.190973000000041,-76.9156959999999;8.19180700000015,-76.9156959999999;8.19180700000015,-76.9151369999999;8.191527000000059,-76.9151369999999;8.191527000000059,-76.91486399999999;8.191248999999971,-76.91486399999999;8.191248999999971,-76.91430799999991;8.190973000000041,-76.91430799999991;8.190973000000041,-76.91319299999989;8.19069499999995,-76.91319299999989;8.19069499999995,-76.9126369999999;8.190973000000041,-76.9126369999999;8.190973000000041,-76.91236099999991;8.19180700000015,-76.91236099999991;8.19180700000015,-76.9126369999999;8.192364000000049,-76.9126369999999;8.19236099999995,-76.91291699999989;8.192639000000041,-76.91291699999989;8.192639000000041,-76.91319299999989;8.19292000000002,-76.91319299999989;8.19291700000014,-76.9134759999999;8.19319500000006,-76.9134759999999;8.19319500000006,-76.9140249999999;8.19347300000015,-76.9140249999999;8.193471000000161,-76.9145809999999;8.19374900000008,-76.9145809999999;8.19374900000008,-76.91486399999999;8.194030000000049,-76.91486399999999;8.19402699999995,-76.9156959999999;8.194305000000041,-76.9156959999999;8.194305000000041,-76.91763999999991;8.193471000000161,-76.91763999999991;8.19347300000015,-76.91791499999989;8.19319500000006,-76.91791499999989;8.19319500000006,-76.91763999999991;8.19236099999995,-76.91763999999991;8.192364000000049,-76.9168099999999;8.19208300000008,-76.9168099999999;8.19208300000008,-76.9165269999999;8.191527000000059,-76.9165269999999;8.191527000000059,-76.9168099999999;8.191248999999971,-76.9168099999999;8.191248999999971,-76.917084;8.191527000000059,-76.917084;8.191527000000059,-76.91735899999991;8.19180700000015,-76.91735899999991;8.19180500000016,-76.91763999999991;8.19208300000008,-76.91763999999991;8.19208300000008,-76.918198;8.192364000000049,-76.918198;8.19236099999995,-76.9187469999999;8.192639000000041,-76.9187469999999;8.192639000000041,-76.9193029999999;8.19292000000002,-76.9193029999999;8.19291700000014,-76.919586;8.19319500000006,-76.919586;8.19319500000006,-76.919862;8.19347300000015,-76.919862;8.193471000000161,-76.9201349999999;8.19374900000008,-76.9201349999999;8.19374900000008,-76.92069099999991;8.194305000000041,-76.92069099999991;8.194305000000041,-76.9209739999999;8.19486100000006,-76.9209739999999;8.19486100000006,-76.92152299999989;8.195140000000039,-76.92152299999989;8.195140000000039,-76.9218059999999;8.195415000000081,-76.9218059999999;8.195415000000081,-76.922082;8.196252000000021,-76.922082;8.19624900000014,-76.922364;8.19708400000013,-76.922364;8.19708400000013,-76.92263799999991;8.197637000000039,-76.92263799999991;8.197637000000039,-76.92292000000001;8.198474000000029,-76.92292000000001;8.19847200000004,-76.923194;8.199306000000149,-76.923194;8.199306000000149,-76.9234699999999;8.199861999999939,-76.9234699999999;8.199861999999939,-76.92375199999999;8.20069600000005,-76.92375199999999;8.200694000000061,-76.9240259999999;8.201527999999939,-76.9240259999999;8.201527999999939,-76.9243079999999;8.202084000000131,-76.9243079999999;8.202084000000131,-76.924584;8.202918000000009,-76.924584;8.202918000000009,-76.9248579999999;8.203750000000131,-76.9248579999999;8.203750000000131,-76.9251399999999;8.204028000000051,-76.9251399999999;8.204028000000051,-76.925416;8.20513800000003,-76.925416;8.20513800000003,-76.925696;8.205416000000129,-76.925696;8.205416000000129,-76.9259719999999;8.20597200000014,-76.9259719999999;8.20597200000014,-76.92652800000001;8.20625000000001,-76.92652800000001;8.20625000000001,-76.92680399999991;8.20680400000003,-76.92680399999991;8.20680400000003,-76.927087;8.207084000000121,-76.927087;8.207084000000121,-76.92735999999999;8.207360000000049,-76.92735999999999;8.207360000000049,-76.92763599999989;8.20764100000002,-76.92763599999989;8.20763800000015,-76.927919;8.20791600000001,-76.927919;8.20791600000001,-76.928192;8.208194000000111,-76.928192;8.208194000000111,-76.928748;8.20875100000001,-76.928748;8.20875100000001,-76.9293069999999;8.208472000000031,-76.9293069999999;8.208472000000031,-76.929863;8.208194000000111,-76.929863;8.208194000000111,-76.9301379999999;8.20791600000001,-76.9301379999999;8.20791600000001,-76.930421;8.20763800000015,-76.930421;8.20763800000015,-76.9309699999999;8.20791600000001,-76.9309699999999;8.20791600000001,-76.93152600000001;8.20763800000015,-76.93152600000001;8.20764100000002,-76.9318089999999;8.207360000000049,-76.9318089999999;8.207360000000049,-76.93152600000001;8.207084000000121,-76.93152600000001;8.207084000000121,-76.931251;8.20680400000003,-76.931251;8.20680400000003,-76.9309699999999;8.206528000000111,-76.9309699999999;8.206528000000111,-76.930421;8.20597200000014,-76.930421;8.20597200000014,-76.9301379999999;8.205416000000129,-76.9301379999999;8.205416000000129,-76.92958;8.20485999999994,-76.92958;8.20485999999994,-76.9293069999999;8.204306000000139,-76.9293069999999;8.204306000000139,-76.929031;8.203750000000131,-76.929031;8.203750000000131,-76.928748;8.202918000000009,-76.928748;8.202918000000009,-76.929031;8.20263800000015,-76.929031;8.20263800000015,-76.9293069999999;8.202362000000051,-76.9293069999999;8.202362000000051,-76.930421;8.20263800000015,-76.930421;8.20263800000015,-76.930695;8.202918000000009,-76.930695;8.202918000000009,-76.931251;8.20319399999994,-76.931251;8.20319399999994,-76.9326409999999;8.20347200000003,-76.9326409999999;8.20347200000003,-76.93319700000001;8.203750000000131,-76.93319700000001;8.203750000000131,-76.933746;8.204028000000051,-76.933746;8.204028000000051,-76.9343019999999;8.204306000000139,-76.9343019999999;8.204306000000139,-76.934585;8.204584000000009,-76.934585;8.204584000000009,-76.934861;8.20485999999994,-76.934861;8.20485999999994,-76.9351429999999;8.20513800000003,-76.9351429999999;8.20513800000003,-76.935417;8.205416000000129,-76.935417;8.205416000000129,-76.935693;8.205694000000049,-76.935693;8.205694000000049,-76.93597299999991;8.20625000000001,-76.93597299999991;8.20625000000001,-76.936249;8.20680400000003,-76.936249;8.20680400000003,-76.9365309999999;8.20764100000002,-76.9365309999999;8.20763800000015,-76.93680499999989;8.20791600000001,-76.93680499999989;8.20791600000001,-76.93708100000001;8.208194000000111,-76.93708100000001;8.208194000000111,-76.93736299999991;8.208472000000031,-76.93736299999991;8.208472000000031,-76.938774;8.208472000000031,-76.9401389999999;8.20875100000001,-76.9401389999999;8.20875100000001,-76.940415;8.209029000000101,-76.940415;8.209029000000101,-76.9406979999999;8.20930700000002,-76.9406979999999;8.20930700000002,-76.94097099999991;8.20958200000001,-76.94097099999991;8.20958200000001,-76.94180299999989;8.209862999999981,-76.94180299999989;8.209860000000109,-76.9420859999999;8.21013900000008,-76.9420859999999;8.21013900000008,-76.942359;8.210419,-76.942359;8.21041700000001,-76.94291799999991;8.210695000000101,-76.94291799999991;8.210695000000101,-76.9434739999999;8.20958200000001,-76.9434739999999;8.20958200000001,-76.943191;8.209029000000101,-76.943191;8.209029000000101,-76.94291799999991;8.208472000000031,-76.94291799999991;8.208472000000031,-76.94264199999991;8.206528000000111,-76.94264199999991;8.206528000000111,-76.942359;8.20625000000001,-76.942359;8.20625000000001,-76.9420859999999;8.20597200000014,-76.9420859999999;8.20597200000014,-76.94180299999989;8.205824000000121,-76.94180299999989;8.205694000000049,-76.94180299999989;8.205694000000049,-76.9412539999999;8.205416000000129,-76.9412539999999;8.205416000000129,-76.94097099999991;8.20513800000003,-76.94097099999991;8.20513800000003,-76.9406979999999;8.204584000000009,-76.9406979999999;8.204584000000009,-76.940415;8.204028000000051,-76.940415;8.204028000000051,-76.9401389999999;8.20347200000003,-76.9401389999999;8.20347200000003,-76.939857;8.202918000000009,-76.939857;8.202918000000009,-76.939583;8.202362000000051,-76.939583;8.202362000000051,-76.9393069999999;8.20180600000003,-76.9393069999999;8.20180600000003,-76.939583;8.20069600000005,-76.939583;8.20069600000005,-76.9393069999999;8.20014000000003,-76.9393069999999;8.20014000000003,-76.939025;8.199861999999939,-76.939025;8.199861999999939,-76.938751;8.199584000000019,-76.938751;8.199584000000019,-76.9384689999999;8.199306000000149,-76.9384689999999;8.199306000000149,-76.93819499999999;8.199028000000061,-76.93819499999999;8.19903000000005,-76.93791899999989;8.19875000000013,-76.93791899999989;8.19875000000013,-76.93708100000001;8.19847200000004,-76.93708100000001;8.198474000000029,-76.93680499999989;8.198193999999941,-76.93680499999989;8.198193999999941,-76.9365309999999;8.197637000000039,-76.9365309999999;8.197637000000039,-76.936249;8.19736200000006,-76.936249;8.19736200000006,-76.934585;8.19708400000013,-76.934585;8.19708400000013,-76.9343019999999;8.19624900000014,-76.9343019999999;8.196252000000021,-76.934585;8.195971000000039,-76.934585;8.195971000000039,-76.934861;8.195692999999951,-76.934861;8.19569600000005,-76.9351429999999;8.195140000000039,-76.9351429999999;8.195140000000039,-76.935417;8.19458300000014,-76.935417;8.19458300000014,-76.9351429999999;8.192639000000041,-76.9351429999999;8.192639000000041,-76.934861;8.190973000000041,-76.934861;8.190973000000041,-76.9351429999999;8.19069499999995,-76.9351429999999;8.190698000000051,-76.934861;8.18902899999995,-76.934861;8.18902899999995,-76.9351429999999;8.18875100000008,-76.9351429999999;8.18875100000008,-76.935417;8.188470999999989,-76.935417;8.18847300000016,-76.935693;8.188195000000061,-76.935693;8.188195000000061,-76.93597299999991;8.18791699999997,-76.93597299999991;8.18791699999997,-76.9361419999999;8.18791699999997,-76.936249;8.187639000000051,-76.936249;8.187639000000051,-76.9365309999999;8.18708300000009,-76.9365309999999;8.18708300000009,-76.93680499999989;8.186248999999981,-76.93680499999989;8.186248999999981,-76.93708100000001;8.18569500000001,-76.93708100000001;8.18569500000001,-76.9376369999999;8.18541700000009,-76.9376369999999;8.18541700000009,-76.93791899999989;8.185138999999991,-76.93791899999989;8.185138999999991,-76.9384689999999;8.18402900000001,-76.9384689999999;8.18402900000001,-76.938751;8.18291699999997,-76.938751;8.18291699999997,-76.939025;8.18208199999998,-76.939025;8.18208199999998,-76.9393069999999;8.18180699999999,-76.9393069999999;8.18180699999999,-76.939583;8.18152900000007,-76.939583;8.18152900000007,-76.939857;8.181250000000089,-76.939857;8.181250000000089,-76.9406979999999;8.18069400000007,-76.9406979999999;8.18069400000007,-76.94152699999999;8.18041599999998,-76.94152699999999;8.180419000000089,-76.94180299999989;8.18013800000011,-76.94180299999989;8.18013800000011,-76.943749;8.18069400000007,-76.943749;8.18069400000007,-76.9440299999999;8.180972000000001,-76.9440299999999;8.180972000000001,-76.9443059999999;8.18152900000007,-76.9443059999999;8.18152900000007,-76.944579;8.18236000000007,-76.944579;8.18236000000007,-76.9448619999999;8.18264100000005,-76.9448619999999;8.182638000000001,-76.9451369999999;8.18430500000011,-76.9451369999999;8.18430500000011,-76.9454199999999;8.184861000000071,-76.9454199999999;8.184861000000071,-76.9456939999999;8.185138999999991,-76.9456939999999;8.185138999999991,-76.94596899999991;8.18541700000009,-76.94596899999991;8.18541700000009,-76.948021;8.18541700000009,-76.9484719999999;8.185138999999991,-76.9484719999999;8.185138999999991,-76.94857;8.185138999999991,-76.9490279999999;8.184861000000071,-76.9490279999999;8.184861000000071,-76.9491189999999;8.184861000000071,-76.9493039999999;8.18458299999998,-76.9493039999999;8.18458299999998,-76.9495839999999;8.18402900000001,-76.9495839999999;8.18402900000001,-76.9498599999999;8.18347299999999,-76.9498599999999;8.18347299999999,-76.950142;8.183195000000071,-76.950142;8.183195000000071,-76.9506919999999;8.18291699999997,-76.9506919999999;8.18291699999997,-76.95124799999989;8.183195000000071,-76.95124799999989;8.183195000000071,-76.95180599999991;8.18347299999999,-76.95180599999991;8.18347299999999,-76.95347700000001;8.18375100000009,-76.95347700000001;8.18375100000009,-76.95541399999991;8.18402900000001,-76.95541399999991;8.18402900000001,-76.95596999999989;8.18430500000011,-76.95596999999989;8.18430500000011,-76.956529;8.18458299999998,-76.956529;8.18458299999998,-76.95708499999991;8.184861000000071,-76.95708499999991;8.184861000000071,-76.9573599999999;8.185138999999991,-76.9573599999999;8.185138999999991,-76.957641;8.18541700000009,-76.957641;8.18541700000009,-76.9579169999999;8.18597300000005,-76.9579169999999;8.18597300000005,-76.9581899999999;8.186248999999981,-76.9581899999999;8.186248999999981,-76.958473;8.186804999999991,-76.958473;8.186804999999991,-76.9587479999999;8.18875100000008,-76.9587479999999;8.18875100000008,-76.959031;8.189305000000051,-76.959031;8.189305000000051,-76.959305;8.189861000000059,-76.959305;8.189861000000059,-76.9595869999999;8.19041700000008,-76.9595869999999;8.19041700000008,-76.959861;8.19178200000005,-76.959861;8.19319500000006,-76.959861;8.19319500000006,-76.96013599999991;8.19347300000015,-76.96013599999991;8.193471000000161,-76.9604189999999;8.19374900000008,-76.9604189999999;8.19374900000008,-76.96069299999991;8.194030000000049,-76.96069299999991;8.19402699999995,-76.96097500000001;8.194305000000041,-76.96097500000001;8.194305000000041,-76.9615239999999;8.195140000000039,-76.9615239999999;8.195140000000039,-76.96180699999999;8.195415000000081,-76.96180699999999;8.195415000000081,-76.9615239999999;8.196252000000021,-76.9615239999999;8.19624900000014,-76.96180699999999;8.19708400000013,-76.96180699999999;8.19708400000013,-76.96208299999989;8.197637000000039,-76.96208299999989;8.197637000000039,-76.962363;8.199584000000019,-76.962363;8.199584000000019,-76.962639;8.20014000000003,-76.962639;8.20014000000003,-76.9629119999999;8.20069600000005,-76.9629119999999;8.200694000000061,-76.963195;8.200972000000149,-76.963195;8.200972000000149,-76.963471;8.201527999999939,-76.963471;8.201527999999939,-76.9637529999999;8.20263800000015,-76.9637529999999;8.20263800000015,-76.964027;8.20319399999994,-76.964027;8.20319399999994,-76.964303;8.20513800000003,-76.964303;8.20513800000003,-76.9645849999999;8.205416000000129,-76.9645849999999;8.205416000000129,-76.965141;8.205694000000049,-76.965141;8.205694000000049,-76.96541499999989;8.20680400000003,-76.96541499999989;8.20680400000003,-76.965141;8.20791600000001,-76.965141;8.20791600000001,-76.96541499999989;8.208472000000031,-76.96541499999989;8.208472000000031,-76.96569700000001;8.20875100000001,-76.96569700000001;8.20875100000001,-76.96597300000001;8.20958200000001,-76.96597300000001;8.20958200000001,-76.9662469999999;8.210695000000101,-76.9662469999999;8.210695000000101,-76.96652899999999;8.21180500000008,-76.96652899999999;8.21180500000008,-76.9662469999999;8.212085,-76.9662469999999;8.212083000000011,-76.96652899999999;8.21347300000008,-76.96652899999999;8.21347300000008,-76.9662469999999;8.214307000000019,-76.9662469999999;8.214307000000019,-76.96597300000001;8.21597300000002,-76.96597300000001;8.215971000000019,-76.96569700000001;8.21625100000011,-76.96569700000001;8.21625100000011,-76.96597300000001;8.218750999999999,-76.96597300000001;8.218750999999999,-76.96569700000001;8.220416999999999,-76.96569700000001;8.220416999999999,-76.96541499999989;8.22153000000009,-76.96541499999989;8.221526999999981,-76.965141;8.221805000000071,-76.965141;8.221805000000071,-76.964859;8.222361999999981,-76.964859;8.222361999999981,-76.9645849999999;8.22319600000009,-76.9645849999999;8.223192999999981,-76.964859;8.22430600000007,-76.964859;8.22430600000007,-76.965141;8.224862000000091,-76.965141;8.224862000000091,-76.96541499999989;8.22513999999995,-76.96541499999989;8.22513999999995,-76.965141;8.225693999999979,-76.965141;8.225693999999979,-76.96541499999989;8.22624999999999,-76.96541499999989;8.22624999999999,-76.96569700000001;8.227084000000049,-76.96569700000001;8.227084000000049,-76.96597300000001;8.22735999999998,-76.96597300000001;8.22735999999998,-76.9662469999999;8.22764000000006,-76.9662469999999;8.22764000000006,-76.96652899999999;8.22791599999999,-76.96652899999999;8.22791599999999,-76.96680499999999;8.228194000000091,-76.96680499999999;8.228194000000091,-76.967361;8.22847199999995,-76.967361;8.22847199999995,-76.967637;8.22875000000005,-76.967637;8.22875000000005,-76.9679169999999;8.22902800000014,-76.9679169999999;8.22902800000014,-76.968193;8.229862000000081,-76.968193;8.229862000000081,-76.968476;8.23041600000005,-76.968476;8.23041600000005,-76.969025;8.23069400000014,-76.969025;8.23069400000014,-76.9687489999999;8.230972000000071,-76.9687489999999;8.230972000000071,-76.968476;8.231252000000151,-76.968476;8.231250000000159,-76.967637;8.231528000000081,-76.967637;8.231528000000081,-76.967361;8.232362000000141,-76.967361;8.23236000000014,-76.9670879999999;8.234306000000061,-76.9670879999999;8.234306000000061,-76.96680499999999;8.23541600000004,-76.96680499999999;8.23541600000004,-76.9670879999999;8.23625100000004,-76.9670879999999;8.23625100000004,-76.967361;8.23930499999994,-76.967361;8.23930499999994,-76.967637;8.239861000000131,-76.967637;8.239861000000131,-76.9679169999999;8.24041700000015,-76.9679169999999;8.24041700000015,-76.968193;8.241986999999989,-76.968193;8.24319500000013,-76.968193;8.24319500000013,-76.9679169999999;8.24347300000005,-76.9679169999999;8.24347300000005,-76.967637;8.24374900000015,-76.967637;8.24374900000015,-76.967361;8.24402900000001,-76.967361;8.24402700000002,-76.9670879999999;8.244305000000111,-76.9670879999999;8.244305000000111,-76.9645849999999;8.24402700000002,-76.9645849999999;8.24402900000001,-76.964303;8.24319500000013,-76.964303;8.24319500000013,-76.9645849999999;8.241527000000129,-76.9645849999999;8.241527000000129,-76.964859;8.240973000000111,-76.964859;8.240973000000111,-76.965141;8.24041700000015,-76.965141;8.24041700000015,-76.96541499999989;8.239861000000131,-76.96541499999989;8.239861000000131,-76.965141;8.23930499999994,-76.965141;8.23930499999994,-76.964859;8.238473000000059,-76.964859;8.238473000000059,-76.964303;8.23791900000003,-76.964303;8.23791900000003,-76.964027;8.237638999999939,-76.964027;8.237638999999939,-76.96208299999989;8.23736100000002,-76.96208299999989;8.23736100000002,-76.96180699999999;8.237638999999939,-76.96180699999999;8.237638999999939,-76.9615239999999;8.23791900000003,-76.9615239999999;8.23791700000004,-76.96069299999991;8.238195000000131,-76.96069299999991;8.238195000000131,-76.9595869999999;8.238473000000059,-76.9595869999999;8.238473000000059,-76.959031;8.23875100000015,-76.959031;8.23875100000015,-76.9579169999999;8.238573000000139,-76.9579169999999;8.238195000000131,-76.9579169999999;8.238195000000131,-76.957641;8.23736100000002,-76.957641;8.23736300000002,-76.9573599999999;8.23569700000002,-76.9573599999999;8.23569700000002,-76.95708499999991;8.23541600000004,-76.95708499999991;8.23541600000004,-76.9568019999999;8.234860000000079,-76.9568019999999;8.234860000000079,-76.956529;8.234306000000061,-76.956529;8.234306000000061,-76.9562529999999;8.234028000000141,-76.9562529999999;8.234028000000141,-76.95596999999989;8.234306000000061,-76.95596999999989;8.234306000000061,-76.95541399999991;8.234860000000079,-76.95541399999991;8.234860000000079,-76.95513799999991;8.23569700000002,-76.95513799999991;8.235694000000141,-76.954865;8.235972999999939,-76.954865;8.235972999999939,-76.9545819999999;8.23625100000004,-76.9545819999999;8.23625100000004,-76.954865;8.23708200000004,-76.954865;8.23708200000004,-76.9545819999999;8.23791900000003,-76.9545819999999;8.23791900000003,-76.954309;8.241807000000049,-76.954309;8.241807000000049,-76.9540259999999;8.24236100000002,-76.9540259999999;8.24236100000002,-76.9537499999999;8.24319500000013,-76.9537499999999;8.24319500000013,-76.95347700000001;8.244305000000111,-76.95347700000001;8.244305000000111,-76.9531939999999;8.24486100000013,-76.9531939999999;8.24486100000013,-76.9529179999999;8.24541700000009,-76.9529179999999;8.24541700000009,-76.9526359999999;8.24652700000013,-76.9526359999999;8.24652700000013,-76.95236199999989;8.24736100000001,-76.95236199999989;8.24736100000001,-76.9520799999999;8.24763900000011,-76.9520799999999;8.24763900000011,-76.95152999999991;8.247915000000029,-76.95152999999991;8.247915000000029,-76.95124799999989;8.249027000000011,-76.95124799999989;8.249027000000011,-76.9509739999999;8.24958400000008,-76.9509739999999;8.24958400000008,-76.9506919999999;8.2501400000001,-76.9506919999999;8.2501400000001,-76.95041599999991;8.251528000000009,-76.95041599999991;8.251528000000009,-76.950142;8.2518060000001,-76.950142;8.2518060000001,-76.9498599999999;8.251528000000009,-76.9498599999999;8.251528000000009,-76.9493039999999;8.251250000000081,-76.9493039999999;8.251250000000081,-76.9490279999999;8.25097199999999,-76.9490279999999;8.250973999999991,-76.94875399999989;8.250693000000011,-76.94875399999989;8.250693000000011,-76.9484719999999;8.250418000000019,-76.9484719999999;8.250418000000019,-76.9481959999999;8.2501400000001,-76.9481959999999;8.2501400000001,-76.947913;8.249862000000009,-76.947913;8.249862000000009,-76.94763999999989;8.249027000000011,-76.94763999999989;8.249027000000011,-76.94736399999989;8.24847100000005,-76.94736399999989;8.24847100000005,-76.9470819999999;8.248196000000011,-76.9470819999999;8.248196000000011,-76.94680799999991;8.247915000000029,-76.94680799999991;8.247915000000029,-76.94652499999999;8.24736100000001,-76.94652499999999;8.24736100000001,-76.9462519999999;8.247083000000091,-76.9462519999999;8.247083000000091,-76.9456939999999;8.24680500000005,-76.9456939999999;8.24680500000005,-76.9454199999999;8.245693000000021,-76.9454199999999;8.245693000000021,-76.9456939999999;8.244583000000031,-76.9456939999999;8.244583000000031,-76.9451369999999;8.24486100000013,-76.9451369999999;8.24486100000013,-76.9448619999999;8.24513900000005,-76.9448619999999;8.24513900000005,-76.944579;8.24541700000009,-76.944579;8.24541700000009,-76.9443059999999;8.246249000000031,-76.9443059999999;8.246249000000031,-76.9440299999999;8.24652700000013,-76.9440299999999;8.24652700000013,-76.943749;8.247083000000091,-76.943749;8.247083000000091,-76.9434739999999;8.249027000000011,-76.9434739999999;8.249027000000011,-76.943749;8.24930500000011,-76.943749;8.24930500000011,-76.9440299999999;8.24958400000008,-76.9440299999999;8.24958400000008,-76.9443059999999;8.249862000000009,-76.9443059999999;8.249862000000009,-76.9448619999999;8.2501400000001,-76.9448619999999;8.2501400000001,-76.9451369999999;8.250418000000019,-76.9451369999999;8.250418000000019,-76.9456939999999;8.250693000000011,-76.9456939999999;8.250693000000011,-76.94596899999991;8.250973999999991,-76.94596899999991;8.25097199999999,-76.9462519999999;8.251250000000081,-76.9462519999999;8.251250000000081,-76.94680799999991;8.251528000000009,-76.94680799999991;8.251528000000009,-76.9470819999999;8.2518060000001,-76.9470819999999;8.2518060000001,-76.94736399999989;8.25208400000002,-76.94736399999989;8.25208400000002,-76.947913;8.252362000000121,-76.947913;8.252362000000121,-76.94875399999989;8.252639999999991,-76.94875399999989;8.252639999999991,-76.9493039999999;8.252916000000081,-76.9493039999999;8.252916000000081,-76.9495839999999;8.25319400000001,-76.9495839999999;8.25319400000001,-76.9498599999999;8.2534720000001,-76.9498599999999;8.2534720000001,-76.950142;8.25375000000003,-76.950142;8.25375000000003,-76.95047099999989;8.25375000000003,-76.9509739999999;8.254028000000121,-76.9509739999999;8.254028000000121,-76.9520799999999;8.25430799999998,-76.9520799999999;8.254305999999991,-76.9526359999999;8.254584000000079,-76.9526359999999;8.254584000000079,-76.95347700000001;8.254861999999999,-76.95347700000001;8.254861999999999,-76.9540259999999;8.2551400000001,-76.9540259999999;8.2551400000001,-76.954865;8.25541800000002,-76.954865;8.255416000000031,-76.955697;8.255694000000121,-76.955697;8.255694000000121,-76.956529;8.255971999999989,-76.956529;8.255971999999989,-76.95708499999991;8.25625000000008,-76.95708499999991;8.25625000000008,-76.9579169999999;8.256527999999999,-76.9579169999999;8.256527999999999,-76.96125099999991;8.256806000000101,-76.96125099999991;8.256806000000101,-76.962363;8.25708400000002,-76.962363;8.257082000000031,-76.964303;8.257362000000059,-76.964303;8.257362000000059,-76.9662469999999;8.257639999999981,-76.9662469999999;8.257639999999981,-76.9679169999999;8.257362000000059,-76.9679169999999;8.257362000000059,-76.969025;8.257082000000031,-76.969025;8.25708400000002,-76.96958099999991;8.256806000000101,-76.96958099999991;8.256806000000101,-76.97041299999989;8.256527999999999,-76.97041299999989;8.256527999999999,-76.971801;8.256806000000101,-76.971801;8.256806000000101,-76.973472;8.25708400000002,-76.973472;8.25708400000002,-76.9737469999999;8.256806000000101,-76.9737469999999;8.256806000000101,-76.975694;8.25708400000002,-76.975694;8.257082000000031,-76.97597399999999;8.257362000000059,-76.97597399999999;8.257362000000059,-76.9770819999999;8.257082000000031,-76.9770819999999;8.25708400000002,-76.9781959999999;8.256806000000101,-76.9781959999999;8.256806000000101,-76.9787519999999;8.256527999999999,-76.9787519999999;8.256527999999999,-76.97902600000001;8.25625000000008,-76.97902600000001;8.25625000000008,-76.9793079999999;8.255971999999989,-76.9793079999999;8.255971999999989,-76.97985799999999;8.25541800000002,-76.97985799999999;8.25541800000002,-76.98013999999991;8.254028000000121,-76.98013999999991;8.254028000000121,-76.97985799999999;8.2501400000001,-76.97985799999999;8.2501400000001,-76.9795839999999;8.24847100000005,-76.9795839999999;8.24847100000005,-76.97985799999999;8.248196000000011,-76.97985799999999;8.248196000000011,-76.9795839999999;8.247083000000091,-76.9795839999999;8.247083000000091,-76.9793079999999;8.24680500000005,-76.9793079999999;8.24680500000005,-76.9795839999999;8.24486100000013,-76.9795839999999;8.24486100000013,-76.97985799999999;8.244305000000111,-76.97985799999999;8.244305000000111,-76.98041599999991;8.24652700000013,-76.98041599999991;8.24652700000013,-76.9806989999999;8.247915000000029,-76.9806989999999;8.247915000000029,-76.98097199999999;8.249027000000011,-76.98097199999999;8.249027000000011,-76.98124799999989;8.2501400000001,-76.98124799999989;8.2501400000001,-76.9815279999999;8.25208400000002,-76.9815279999999;8.25208400000002,-76.981804;8.252639999999991,-76.981804;8.252639999999991,-76.98208699999989;8.25319400000001,-76.98208699999989;8.25321200000008,-76.9823599999999;8.25430799999998,-76.9823599999999;8.254305999999991,-76.98208699999989;8.254584000000079,-76.98208699999989;8.254584000000079,-76.9815279999999;8.254861999999999,-76.9815279999999;8.254861999999999,-76.98124799999989;8.2551400000001,-76.98124799999989;8.2551400000001,-76.9815279999999;8.25541800000002,-76.9815279999999;8.255416000000031,-76.98208699999989;8.255694000000121,-76.98208699999989;8.255694000000121,-76.9823599999999;8.255971999999989,-76.9823599999999;8.255971999999989,-76.982636;8.25625000000008,-76.982636;8.25625000000008,-76.983192;8.256527999999999,-76.983192;8.256527999999999,-76.9834749999999;8.25625000000008,-76.9834749999999;8.25625000000008,-76.9843069999999;8.255971999999989,-76.9843069999999;8.255971999999989,-76.9845799999999;8.255694000000121,-76.9845799999999;8.255694000000121,-76.98569499999989;8.255416000000031,-76.98569499999989;8.25541800000002,-76.98704600000001;8.25541800000002,-76.9873579999999;8.2551400000001,-76.9873579999999;8.2551400000001,-76.9879149999999;8.254861999999999,-76.9879149999999;8.254861999999999,-76.9890289999999;8.254584000000079,-76.9890289999999;8.254584000000079,-76.990134;8.254861999999999,-76.990134;8.254861999999999,-76.9915309999999;8.2551400000001,-76.9915309999999;8.2551400000001,-76.9918049999999;8.254861999999999,-76.9918049999999;8.254861999999999,-76.9923629999999;8.254584000000079,-76.9923629999999;8.254584000000079,-76.9926369999999;8.254028000000121,-76.9926369999999;8.254028000000121,-76.9940269999999;8.25430799999998,-76.9940269999999;8.254305999999991,-76.9966959999999;8.250892000000141,-76.9966959999999;8.24570000000006,-76.99642299999989;8.230117000000011,-76.9939659999999;8.2191840000001,-76.9928669999999;8.204425000000009,-76.9854899999999;8.182556000000149,-76.9764709999999;8.17873200000014,-76.973731;8.162058,-76.97236599999989;8.13718099999994,-76.97154999999989;8.11422100000004,-76.972093;8.101921000000001,-76.9685439999999;8.09126100000015,-76.9641639999999;8.080052000000141,-76.9625319999999;8.070487000000069,-76.9636229999999;8.06611300000003,-76.9674459999999;8.05312900000007,-76.9792009999999;8.0478500000001,-76.983306;8.04280000000006,-76.9924019999999;8.029599000000079,-77.0056009999999;8.00599900000014,-77.021698;7.99849999999998,-77.021698;7.99040000000002,-77.0188969999999;7.98000100000007,-77.019401;7.97130099999998,-77.030402;7.95629999999994,-77.03379799999991;7.941900000000091,-77.0297999999999;7.91819900000013,-77.0366969999999;7.91019999999997,-77.0395959999999;7.883101000000121,-77.06320099999991;7.87040100000002,-77.071196;7.863598000000079,-77.08560299999991;7.85729900000007,-77.099503;7.84860200000008,-77.108704;7.83420000000001,-77.1156009999999;7.83140100000008,-77.12539699999989;7.83489900000012,-77.1363979999999;7.82220000000012,-77.1490019999999;7.795001000000131,-77.132897;7.76659999999998,-77.114997;7.740600000000091,-77.10169999999989;7.728999000000159,-77.08850199999991;7.71449899999999,-77.0677019999999;7.69070100000005,-77.0382989999999;7.67670000000015,-77.02100299999999;7.6604000000001,-76.9962009999999;7.64249900000004,-76.9776989999999;7.6314000000001,-76.95929799999991;7.60410000000013,-76.9241029999999;7.57800000000009,-76.8928999999999;7.56399900000002,-76.8704979999999;7.542500000000019,-76.84339900000001;7.511800000000111,-76.8116009999999;7.496698000000039,-76.800102;7.45559899999995,-76.7776029999999;7.42490100000003,-76.759103;7.402301000000021,-76.74069900000001;7.37100000000009,-76.71700300000001;7.35479900000007,-76.700301;7.33910100000008,-76.6876;7.32580000000002,-76.6807029999999;7.32917700000002,-76.6725459999999;7.32280000000014,-76.648399;7.31630000000001,-76.619002;7.301201000000051,-76.5971;7.279200000000059,-76.5785979999999;7.26240100000012,-76.5578009999999;7.25420100000002,-76.5422979999999;7.226399999999959,-76.5260999999999;7.198701000000029,-76.5221019999999;7.16220100000015,-76.51629799999991;7.15410099999997,-76.5104969999999;7.1402010000001,-76.5029989999999;7.127000000000121,-76.5065;7.11429800000002,-76.514504;7.09930100000014,-76.52089699999991;7.08780100000007,-76.52950300000001;7.07860000000011,-76.5334999999999;7.06010000000009,-76.5432959999999;7.043399000000079,-76.544999;7.023699999999959,-76.5473029999999;7.00349999999997,-76.546699;6.9884990000001,-76.546699;6.98160000000007,-76.5495979999999;6.97239900000011,-76.5535959999999;6.970600999999991,-76.556;6.97359999999998,-76.57379999999991;6.9864,-76.5887989999999;6.99860000000012,-76.611299;6.998099000000019,-76.633796;7.00050100000004,-76.6475989999999;7.007500000000051,-76.6632009999999;7.01160000000016,-76.68049599999991;7.026100000000159,-76.7059009999999;7.02680000000015,-76.7156989999999;7.02620000000007,-76.72200100000001;7.01880000000011,-76.7334969999999;7.012498000000051,-76.75599699999999;7.01260100000002,-76.7814019999999;7.01270099999994,-76.7951979999999;7.01160000000016,-76.8125009999999;7.01110100000005,-76.8303989999999;7.01050000000009,-76.832703;7.00940100000008,-76.8343959999999;7.00190000000015,-76.838996;6.99440000000004,-76.84020099999999;6.98400000000004,-76.83840100000001;6.97010000000012,-76.83670099999991;6.96030200000001,-76.8343959999999;6.94980200000003,-76.831497;6.94350000000014,-76.825699;6.93130000000002,-76.8170999999999;6.923434000000041,-76.8187409999999;6.92030000000011,-76.8193969999999;6.91169900000006,-76.814201;6.900700000000031,-76.811302;6.884500000000059,-76.810096;6.87179999999995,-76.8124009999999;6.86659900000006,-76.8244999999999;6.86030000000005,-76.833198;6.84940100000011,-76.8377989999999;6.83730100000014,-76.844703;6.836699000000069,-76.8527;6.84490000000005,-76.8676989999999;6.84490000000005,-76.87870099999989;6.83339900000004,-76.88619899999991;6.8154990000001,-76.8884959999999;6.80630000000014,-76.8971019999999;6.795901000000011,-76.9051979999999;6.77800000000002,-76.90860099999991;6.76650000000006,-76.907997;6.74739800000003,-76.902299;6.736398999999951,-76.900498;6.72320100000007,-76.90920199999989;6.718599000000149,-76.91030099999991;6.707600000000131,-76.91030099999991;6.6966010000001,-76.913804;6.691400000000159,-76.9213019999999;6.68170000000015,-76.92639799999991;6.67819900000001,-76.9200969999999;6.666600999999959,-76.921204;6.658501,-76.92469800000001;6.64640099999997,-76.93049599999991;6.64410100000009,-76.929901;6.64460000000003,-76.91089599999989;6.63930100000016,-76.8924029999999;6.63010000000003,-76.8906999999999;6.62200000000007,-76.8946999999999;6.62610100000006,-76.899299;6.61800000000005,-76.9021979999999;6.593801000000101,-76.90390099999991;6.59090200000003,-76.9096989999999;6.582200000000001,-76.9003979999999;6.57520099999999,-76.8895039999999;6.570000000000049,-76.881401;6.5677,-76.880303;6.56070099999999,-76.873901;6.54560100000009,-76.864098;6.53179900000015,-76.8560029999999;6.53170100000006,-76.8480009999999;6.513199000000041,-76.83930099999991;6.51040000000006,-76.855401;6.49650000000003,-76.85140299999991;6.49470100000002,-76.8455959999999;6.50740100000013,-76.84050000000001;6.510902000000041,-76.8352969999999;6.51080100000007,-76.82779600000001;6.51190000000003,-76.8145;6.50150000000002,-76.8093029999999;6.49340000000001,-76.7955009999999;6.48880099999997,-76.7983999999999;6.48829900000004,-76.8173989999999;6.48770000000002,-76.8272009999999;6.4738000000001,-76.818;6.46230100000008,-76.81849699999999;6.45069799999999,-76.82199799999999;6.44499999999999,-76.823701;6.44490000000008,-76.80989799999991;6.446600000000049,-76.80349799999991;6.44720000000012,-76.7955009999999;6.44189800000004,-76.789101;6.43099999999998,-76.7919999999999;6.428101000000141,-76.80290099999991;6.425299999999989,-76.805802;6.42010100000005,-76.8087019999999;6.41370100000006,-76.80290099999991;6.40730100000008,-76.7959979999999;6.40210000000013,-76.80180300000001;6.40099900000001,-76.80519799999991;6.38770099999999,-76.80639699999991;6.38650200000006,-76.80059900000001;6.37780000000004,-76.794297;6.37150100000002,-76.80000199999991;6.36520100000013,-76.808098;6.35660000000007,-76.813301;6.345600000000159,-76.81210399999991;6.34029900000013,-76.80349799999991;6.32480100000015,-76.80519799999991;6.312099000000101,-76.8075029999999;6.298801000000081,-76.8069009999999;6.29990100000015,-76.79650100000001;6.303899000000001,-76.7873;6.30329999999998,-76.7780999999999;6.289399,-76.7665029999999;6.28009999999995,-76.7716969999999;6.263401000000101,-76.7740019999999;6.25120099999998,-76.76020199999989;6.243101000000021,-76.74859599999991;6.223999000000111,-76.741699;6.21360000000016,-76.74459899999989;6.19049800000005,-76.7423009999999;6.184101000000109,-76.736503;6.17830000000009,-76.7319039999999;6.171301000000091,-76.724998;6.1648990000001,-76.7035969999999;6.16300100000012,-76.6714019999999;6.163499999999999,-76.6483009999999;6.15760100000006,-76.627;6.156399999999959,-76.605599;6.15800000000002,-76.58139900000001;6.1648990000001,-76.56410199999991;6.16649900000016,-76.541703;6.16640100000006,-76.51509899999991;6.16640100000006,-76.5029989999999;6.16800100000012,-76.48290399999991;6.171402000000109,-76.456901;6.17360099999996,-76.43499799999999;6.17469900000009,-76.4159999999999;6.175700000000119,-76.3865959999999;6.1773,-76.3618019999999;6.1871000000001,-76.33820400000001;6.19049800000005,-76.32199899999991;6.192700000000001,-76.3041989999999;6.19489900000002,-76.289802;6.19600000000003,-76.2771;6.186701000000139,-76.2632;6.17400000000015,-76.25569899999989;6.14799900000014,-76.26149700000001;6.13130000000012,-76.26550399999989;6.11399900000004,-76.26550399999989;6.09949900000004,-76.259202;6.07989900000013,-76.2591019999999;6.062500000000109,-76.2516029999999;6.041700000000051,-76.2475969999999;6.029500000000099,-76.244697;6.02029899999997,-76.2441029999999;6.012202000000059,-76.23780099999991;6.006401000000041,-76.23200300000001;6.00350000000003,-76.22619499999991;6.00000100000005,-76.2228019999999;5.99359900000007,-76.21929900000001;5.992401000000091,-76.2129969999999;5.991300000000081,-76.203796;5.99060000000009,-76.1974029999999;5.98999800000001,-76.19159599999991;5.98830000000004,-76.1812959999999;5.98770100000002,-76.176697;5.98590000000007,-76.164002;5.98530100000005,-76.15709699999989;5.983500000000051,-76.1500999999999;5.98170000000016,-76.14089899999991;5.97480100000007,-76.1316979999999;5.97069900000014,-76.132796;5.963301000000001,-76.13919900000001;5.95399900000001,-76.14209799999991;5.94420100000008,-76.1419969999999;5.93560000000002,-76.1500999999999;5.92920000000004,-76.1494979999999;5.915300000000121,-76.1461019999999;5.90030100000007,-76.1494979999999;5.88300000000015,-76.15239699999999;5.86450000000013,-76.154701;5.843199000000029,-76.155198;5.82410000000016,-76.1593029999999;5.805701,-76.1597969999999;5.784199000000109,-76.14769699999989;5.773200000000091,-76.1408009999999;5.75530000000015,-76.13159999999991;5.745999000000099,-76.12870099999989;5.74080000000015,-76.129205;5.729901000000039,-76.139;5.71250000000003,-76.12290299999989;5.70209999999997,-76.123498;5.68540100000013,-76.1286009999999;5.67210000000006,-76.128097;5.660000000000081,-76.12979899999991;5.65300100000007,-76.129205;5.65070099999997,-76.13269799999991;5.63629900000012,-76.12689999999991;5.62470100000007,-76.12110199999989;5.61129900000003,-76.1066979999999;5.59800100000001,-76.09519999999991;5.589901,-76.0899969999999;5.58350100000001,-76.077904;5.57249900000011,-76.0698009999999;5.55340000000007,-76.0652019999999;5.54300100000012,-76.0674969999999;5.53030100000007,-76.0662999999999;5.5141010000001,-76.0640029999999;5.49150100000014,-76.0467;5.48860000000008,-76.03739899999989;5.48630000000003,-76.0281979999999;5.475301,-76.023004;5.47180000000003,-76.017304;5.47340000000008,-76.0039979999999;5.47050100000001,-75.98670199999999;5.47040100000009,-75.9775009999999;5.47209900000007,-75.955001;5.47090000000003,-75.93939999999991;5.47080000000005,-75.9336999999999;5.47080000000005,-75.9198;5.47250000000003,-75.911796;5.47190100000006,-75.9019999999999;5.47180000000003,-75.8962019999999;5.47300100000012,-75.892701;5.47513700000007,-75.8865059999999;5.48330100000004,-75.8853009999999;5.48910099999995,-75.882402;5.49770000000001,-75.8685989999999;5.49830000000009,-75.85990200000001;5.505201,-75.8517999999999;5.51430200000004,-75.8408959999999;5.51490100000001,-75.8346029999999;5.51430200000004,-75.8229979999999;5.51419900000002,-75.81030300000001;5.51879800000006,-75.797096;5.52220100000005,-75.7866979999999;5.52500000000003,-75.7723009999999;5.52380100000011,-75.76419900000001;5.52319900000003,-75.757897;5.52440100000001,-75.754403;5.52610100000015,-75.74980099999991;5.52719900000005,-75.74410399999989;5.52380100000011,-75.74410399999989;5.52029999999996,-75.7406009999999;5.51800100000003,-75.73829599999991;5.51220000000001,-75.73539699999991;5.5064000000001,-75.7285009999999;5.50460199999998,-75.7169039999999;5.50400000000008,-75.71230300000001;5.50509900000009,-75.7095039999999;5.50800000000015,-75.7060009999999;5.51080100000007,-75.693901;5.51249900000005,-75.6800989999999;5.51480100000009,-75.67030299999991;5.51770000000016,-75.6679989999999;5.51940000000013,-75.6593009999999;5.51989900000001,-75.65239799999991;5.51870000000014,-75.6339029999999;5.512902,-75.623597;5.51509900000008,-75.6143049999999;5.52260000000001,-75.6155009999999;5.53129899999999,-75.6166999999999;5.54290000000015,-75.6166999999999;5.55610100000007,-75.6155009999999;5.57410200000004,-75.6173019999999;5.59780000000006,-75.626502;5.60010000000011,-75.626502;5.61680099999995,-75.6219029999999;5.63650200000006,-75.61959899999989;5.65150100000011,-75.62419799999989;5.66590099999996,-75.62709699999991;5.6717010000001,-75.62309999999999;5.679801000000049,-75.6173019999999;5.68840000000012,-75.6184999999999;5.70120000000014,-75.62249799999999;5.717299999999971,-75.62599899999989;5.73070100000001,-75.62999599999991;5.72660100000002,-75.6184999999999;5.72529900000012,-75.604698;5.721299999999991,-75.592598;5.71719899999999,-75.58219799999991;5.717701000000151,-75.57530199999989;5.71650000000005,-75.572997;5.71360099999998,-75.5665979999999;5.707799999999961,-75.563202;5.70030000000008,-75.56199599999999;5.691700000000139,-75.5590969999999;5.68699900000001,-75.551002;5.68180000000007,-75.542999;5.67310000000003,-75.5372009999999;5.67130000000014,-75.52570299999989;5.668399000000081,-75.5141;5.66020099999997,-75.5077979999999;5.662500000000139,-75.498595;5.66590099999996,-75.48470399999999;5.67679900000002,-75.4698029999999;5.68310100000008,-75.4559019999999;5.68720100000002,-75.4535979999999;5.6871010000001,-75.441498;5.68359999999996,-75.433998;5.68359999999996,-75.4259039999999;5.67720100000008,-75.4196029999999;5.66850099999999,-75.41210199999991;5.66440100000005,-75.405196;5.65920000000011,-75.39649899999991;5.65340000000003,-75.39359999999991;5.651100000000159,-75.393096;5.634401000000139,-75.39939800000001;5.62049999999994,-75.402801;5.60550100000006,-75.40920299999991;5.59970100000015,-75.4017019999999;5.60140100000012,-75.3925009999999;5.60140100000012,-75.38610199999989;5.59789999999998,-75.376901;5.59499900000014,-75.37400199999991;5.58690100000013,-75.37400199999991;5.57480100000015,-75.375198;5.56840200000005,-75.3704989999999;5.55510000000004,-75.3675989999999;5.53320000000008,-75.366501;5.51690000000002,-75.353797;5.5025,-75.3508979999999;5.49780100000004,-75.3497009999999;5.48509899999993,-75.3497009999999;5.4746990000001,-75.3473969999999;5.46430000000015,-75.34400099999991;5.45800000000008,-75.33989699999989;5.45680100000016,-75.33650299999989;5.45730000000003,-75.32319699999989;5.46020000000004,-75.31339899999991;5.46009900000001,-75.30300199999991;5.45830100000012,-75.2880029999999;5.46000100000009,-75.2862999999999;5.46460100000002,-75.27419999999999;5.47320000000008,-75.2545999999999;5.49109999999996,-75.247102;5.51240100000012,-75.23500199999999;5.51690000000002,-75.21949699999991;5.51800100000003,-75.2044979999999;5.52029999999996,-75.192398;5.52260000000001,-75.179703;5.52770100000004,-75.1716009999999;5.53120100000007,-75.166999;5.53750099999996,-75.161301;5.54560100000015,-75.1589969999999;5.55480000000011,-75.1566999999999;5.56350100000009,-75.1531989999999;5.56800000000015,-75.1468969999999;5.57089900000005,-75.1399999999999;5.573801,-75.13069899999989;5.58070000000009,-75.124397;5.59160099999997,-75.124397;5.59800100000001,-75.1249989999999;5.61240000000015,-75.1267019999999;5.62110000000001,-75.1227039999999;5.6309,-75.12100199999991;5.64190100000002,-75.11979599999999;5.64820100000009,-75.1157979999999;5.64929900000016,-75.1111989999999;5.653901000000079,-75.094497;5.653901000000079,-75.0910039999999;5.65959900000007,-75.0794979999999;5.662500000000139,-75.06970299999991;5.666500000000159,-75.060502;5.669901000000039,-75.0477979999999;5.674400000000111,-75.03510299999991;5.681301000000019,-75.02649699999991;5.69110099999995,-75.0201039999999;5.70559900000012,-75.0167009999999;5.707799999999961,-75.00920099999991;5.71120100000002,-74.9959019999999;5.71180000000004,-74.9856029999999;5.713500000000009,-74.97579999999989;5.71460100000013,-74.9653999999999;5.715700000000141,-74.9555979999999;5.71799900000008,-74.9434959999999;5.72360200000003,-74.918099;5.72529900000012,-74.91349799999991;5.726501000000101,-74.9083009999999;5.727599,-74.901398;5.730500000000059,-74.89330199999991;5.73220100000009,-74.88580399999989;5.733901000000059,-74.87719800000001;5.73089900000002,-74.872596;5.72460000000001,-74.866798;5.72050000000007,-74.8638989999999;5.71420000000001,-74.863297;5.70890100000014,-74.861;5.70030000000008,-74.85870299999991;5.69619900000004,-74.8534989999999;5.69440100000014,-74.84200300000001;5.690899999999999,-74.835098;5.68920000000003,-74.82759900000001;5.68629900000002,-74.82180099999989;5.679300000000009,-74.8067999999999;5.67749900000001,-74.7982029999999;5.67860000000002,-74.79010099999989;5.68030000000016,-74.778001;5.68260000000004,-74.7698979999999;5.68310100000008,-74.765297;5.69,-74.757796;5.70500200000009,-74.7549969999999;5.71600099999995,-74.747497;5.731501000000089,-74.741097;5.742500000000119,-74.73370299999991;5.75980100000004,-74.7227019999999;5.762600000000021,-74.71520099999999;5.762600000000021,-74.7048039999999;5.76200000000011,-74.69850199999991;5.752699000000061,-74.6949989999999;5.75100100000009,-74.68470000000001;5.75839900000005,-74.6765969999999;5.75839900000005,-74.6742999999999;5.76190000000003,-74.6742999999999;5.77920100000011,-74.6742999999999;5.79710100000005,-74.6732019999999;5.82020000000006,-74.6673969999999;5.82940100000002,-74.6633989999999;5.840400000000051,-74.664001;5.84284800000012,-74.662834;5.84899999999999,-74.6598959999999;5.85659800000002,-74.6605;5.86919999999998,-74.6512989999999;5.872101000000041,-74.6432039999999;5.87670000000008,-74.6356959999999;5.882400000000081,-74.62359600000001;5.88870000000014,-74.609199;5.89390100000008,-74.60809999999989;5.91070000000002,-74.6173009999999;5.91990100000015,-74.6213989999999;5.929799000000001,-74.62539700000001;5.938399,-74.62539700000001;5.95690099999996,-74.6259979999999;5.96209900000002,-74.6184999999999;5.96489999999994,-74.61099899999989;5.968401000000089,-74.6017989999999;5.97289999999998,-74.5907969999999;5.9799020000001,-74.5874029999999;5.983300000000041,-74.5874029999999;5.99260100000009,-74.58910399999991;5.99950000000001,-74.59320200000001;6.008199000000161,-74.602402;6.014599000000151,-74.6057959999999;6.022100000000141,-74.604698;6.02960100000013,-74.601197;6.03249999999997,-74.59839599999989;6.03649999999999,-74.59429999999991;6.04339800000002,-74.59140100000001;6.04859900000014,-74.5874029999999;6.05839999999995,-74.5896989999999;6.060200000000071,-74.5938029999999;6.0614010000001,-74.6017989999999;6.06199800000013,-74.6070019999999;6.06719900000007,-74.61109999999999;6.07069999999999,-74.61389799999991;6.07940000000008,-74.624298;6.09270100000015,-74.630096;6.10999900000002,-74.62950099999991;6.13079900000008,-74.6225959999999;6.14519800000005,-74.6134039999999;6.1579000000001,-74.6082009999999;6.167700000000079,-74.6082009999999;6.1843990000001,-74.6047979999999;6.1977,-74.6018989999999;6.210901000000151,-74.592698;6.22300099999995,-74.5858009999999;6.234600000000059,-74.5783009999999;6.23630000000003,-74.5754019999999;6.25130100000013,-74.5668019999999;6.252999000000101,-74.5609969999999;6.25469900000007,-74.555801;6.247379000000141,-74.55178699999991;6.24879900000002,-74.5437009999999;6.263800000000061,-74.531601;6.26550000000003,-74.530503;6.27190000000007,-74.5235969999999;6.279300000000029,-74.51550399999989;6.3001000000001,-74.49990099999999;6.312099000000101,-74.485496;6.32709800000015,-74.4751969999999;6.34670100000011,-74.46079999999991;6.3669010000001,-74.4475009999999;6.36910100000006,-74.4383;6.37139999999999,-74.42269899999999;6.37710000000004,-74.3991009999999;6.38690100000002,-74.39449999999989;6.39260100000007,-74.396202;6.40540000000016,-74.40950099999991;6.4228020000001,-74.417603;6.43200000000013,-74.417603;6.454001000000119,-74.423896;6.465600999999941,-74.43139699999991;6.48290000000009,-74.43199799999989;6.49680100000006,-74.4315039999999;6.50950000000006,-74.43379899999999;6.53090100000009,-74.4441989999999;6.5378,-74.4406979999999;6.5424020000001,-74.4383999999999;6.551099000000081,-74.43209899999989;6.563700000000149,-74.421699;6.575800000000021,-74.418198;6.588502000000061,-74.40560099999991;6.603500999999939,-74.3923029999999;6.60859900000003,-74.3778979999999;6.6085010000001,-74.3554009999999;6.61250099999995,-74.3444979999999;6.61820099999994,-74.3352969999999;6.63370100000009,-74.312202;6.644701000000001,-74.3012989999999;6.64750200000015,-74.2885969999999;6.66769900000003,-74.2781979999999;6.688900000000101,-74.2556979999999;6.69810100000001,-74.241303;6.70100000000008,-74.22640199999999;6.712400000000061,-74.2004019999999;6.72269900000009,-74.18540299999999;6.734802000000001,-74.1715999999999;6.748599000000071,-74.1548989999999;6.757199000000009,-74.1456979999999;6.76700099999999,-74.142799;6.785501000000011,-74.13649699999991;6.80160100000001,-74.12899899999989;6.82410000000016,-74.11340299999991;6.84820000000008,-74.0846029999999;6.85511300000007,-74.0757149999999;6.87240000000008,-74.05349799999991;6.89760000000001,-74.021202;6.90800000000007,-74.0085989999999;6.91880100000003,-73.972297;6.92910000000006,-73.95320199999991;6.95730000000009,-73.92620099999991;6.97799900000001,-73.903702;6.99240100000003,-73.896203;6.99700000000007,-73.896203;7.007999000000099,-73.9008019999999;7.02939999999995,-73.9077989999999;7.037600999999939,-73.91639600000001;7.057801000000099,-73.9284959999999;7.08390100000014,-73.940102;7.106401000000009,-73.9377969999999;7.124901000000019,-73.9372029999999;7.15550000000013,-73.9458999999999;7.17289900000014,-73.9505009999999;7.17810000000009,-73.95169799999989;7.21040000000005,-73.95459700000001;7.24280000000016,-73.9557049999999;7.26360199999999,-73.9540019999999;6.985201000000069,-74.2483979999999;6.98530100000005,-74.261704;6.98650000000009,-74.267999;6.98480200000012,-74.2771989999999;6.983698999999999,-74.2853019999999;6.98600100000004,-74.2899009999999;6.986407000000039,-74.296531;6.98660100000012,-74.299697;6.98430100000007,-74.3095019999999;6.979202000000039,-74.31639799999989;6.982701000000019,-74.33550199999991;6.98800000000006,-74.345298;6.99720100000002,-74.355103;6.99730100000011,-74.3584979999999;6.99730100000011,-74.3654019999999;7.00080000000008,-74.3718039999999;7.00600099999997,-74.373497;7.02159900000004,-74.3718039999999;7.042401000000101,-74.3723989999999;7.05630100000002,-74.3793019999999;7.07360000000011,-74.3856949999999;7.093301000000001,-74.4001019999999;7.110100000000159,-74.406404;7.1280000000001,-74.4093029999999;7.14589800000005,-74.4162969999999;7.17020100000002,-74.4272009999999;7.18699999999996,-74.4278019999999;7.192800999999969,-74.426102;7.20839900000004,-74.4232029999999;7.23779999999999,-74.41860200000001;7.245166000000149,-74.41993699999991;7.25049899999999,-74.42089900000001;7.26150100000007,-74.42269899999999;7.26500100000015,-74.422095;7.282300000000079,-74.4250039999999;7.29910000000012,-74.426697;7.31060000000002,-74.4261999999999;7.32100000000008,-74.4209969999999;7.32960100000008,-74.40540300000001;7.3365,-74.3973009999999;7.34169900000012,-74.3916009999999;7.35319900000002,-74.38239999999991;7.35950100000008,-74.372002;7.37100000000009,-74.364502;7.38370100000009,-74.36280100000001;7.39820100000009,-74.3703;7.40740000000005,-74.375503;7.4190000000001,-74.375503;7.43399900000014,-74.37779999999999;7.44560000000007,-74.38130099999989;7.46240000000012,-74.386498;7.47100099999994,-74.3893969999999;7.46929900000004,-74.391701;7.46069900000003,-74.402;7.45320100000015,-74.4055029999999;7.44460000000009,-74.4117959999999;7.43420000000009,-74.4222029999999;7.42380000000003,-74.4261999999999;7.41459900000007,-74.42909899999999;7.405399000000051,-74.430802;7.3904,-74.4343029999999;7.3771010000001,-74.4383;7.36100100000004,-74.4561999999999;7.351800000000081,-74.4664999999999;7.34429900000015,-74.4693989999999;7.33100100000013,-74.471099;7.32700100000011,-74.47460199999991;7.32470100000006,-74.4821009999999;7.32470100000006,-74.489;7.322499999999989,-74.4971019999999;7.31730100000004,-74.50689800000001;7.31910100000016,-74.5160979999999;7.32660000000016,-74.52130199999991;7.33299900000003,-74.5264959999999;7.34509900000006,-74.530503;7.357300000000071,-74.54149699999989;7.37010200000009,-74.557602;7.37239900000003,-74.569701;7.38520100000005,-74.580703;7.393900000000031,-74.58820299999999;7.400300000000019,-74.592201;7.4072010000001,-74.595704;7.41760099999999,-74.600898;7.4217010000001,-74.60949700000001;7.428700000000111,-74.614097;7.454099000000041,-74.615897;7.468501000000061,-74.61129799999991;7.49500000000006,-74.5979989999999;7.540601000000089,-74.57959699999989;7.56479899999994,-74.5744009999999;7.57860100000011,-74.5703969999999;7.60350100000011,-74.570998;7.615601000000081,-74.56350000000001;7.62420200000014,-74.55259699999991;7.63450000000012,-74.53299799999991;7.648901000000079,-74.515098;7.678799000000081,-74.48979899999991;7.69720099999995,-74.4770959999999;7.70940100000007,-74.4805989999999;7.727399000000101,-74.5008009999999;7.74190199999998,-74.5151979999999;7.766202000000079,-74.5238039999999;7.796799000000019,-74.53420199999989;7.81880000000001,-74.53479900000001;7.85690000000011,-74.5394979999999;7.88640100000015,-74.53829999999989;7.904900999999939,-74.5389009999999;7.91990000000004,-74.547601;7.927528,-74.5551609999999;7.94200000000001,-74.5695029999999;7.976201000000059,-74.602897;7.995900000000011,-74.62660199999991;8.018600000000051,-74.6508019999999;8.048700999999991,-74.67729899999991;8.07310100000001,-74.70790099999989;8.096300000000159,-74.7292019999999;8.11600100000004,-74.749398;8.13920000000002,-74.778801;8.151401000000019,-74.7881019999999;8.161299000000099,-74.79499899999991;8.16710200000011,-74.8065039999999;8.17930000000001,-74.8198019999999;8.18532999999996,-74.833938;8.182201000000081,-74.8399959999999;8.17249900000007,-74.8543999999999;8.162101000000011,-74.8636029999999;8.14490100000012,-74.87909599999991;8.12470100000013,-74.89589599999989;8.102800000000119,-74.90740099999989;8.08840100000009,-74.9107969999999;8.06830100000008,-74.933297;8.05050100000005,-74.9586039999999;8.048199000000009,-74.97020000000001;8.04770000000013,-74.9944;8.043199000000021,-75.02950299999991;8.041100000000091,-75.0566019999999;8.035901000000139,-75.0734019999999;8.03660099999996,-75.0901029999999;8.03839900000008,-75.105102;8.036199000000121,-75.1293019999999;8.032200000000159,-75.1546029999999;8.032300000000079,-75.176002;8.03180100000003,-75.201897;8.03190100000012,-75.2163009999999;8.024399999999959,-75.2289959999999;8.009499000000011,-75.236504;8.00080000000003,-75.244004;7.99160100000006,-75.25430399999991;7.97950100000008,-75.25720299999991;7.96909900000009,-75.26069699999989;7.968000999999959,-75.2675999999999;7.96740100000005,-75.2727969999999;7.966902,-75.281403;7.96230099999997,-75.2854;7.951299000000061,-75.289498;7.94560200000012,-75.289498;7.93349900000004,-75.3010029999999;7.93240099999997,-75.309096;7.93180100000006,-75.32169999999989;7.91800100000012,-75.33380199999991;7.90990099999993,-75.3349989999999;7.89029800000014,-75.341301;7.8752990000001,-75.342499;7.85679999999996,-75.3464969999999;7.84650000000005,-75.360901;7.84020100000004,-75.37470399999999;7.83050100000003,-75.396599;7.824801000000039,-75.411598;7.82020100000011,-75.43119899999991;7.81110100000001,-75.45079699999999;7.81,-75.457703;7.80769999999995,-75.473901;7.79439900000006,-75.4756009999999;7.788601000000141,-75.4732969999999;7.775902000000141,-75.4698029999999;7.76899999999995,-75.472702;7.759800000000099,-75.47730299999991;7.750002,-75.48359599999991;7.74660100000011,-75.49340099999991;7.73439900000005,-75.4899979999999;7.72579900000005,-75.491698;7.71999900000014,-75.497399;7.71310000000005,-75.502602;7.70730000000015,-75.5031969999999;7.70680100000004,-75.5072009999999;7.70559900000006,-75.5130009999999;7.70510000000002,-75.52110399999999;7.70510000000002,-75.52800000000001;7.70520100000005,-75.5361029999999;7.70810000000006,-75.545304;7.71220000000005,-75.5557009999999;7.715700999999971,-75.564904;7.72610000000009,-75.57470000000001;7.733699000000001,-75.58509700000001;7.733699000000001,-75.592598;7.73090000000008,-75.60810100000001;7.726299000000041,-75.626603;7.71310000000005,-75.6495969999999;7.70050099999997,-75.662903;7.68899999999996,-75.671502;7.678601000000009,-75.676101;7.656098999999981,-75.68240299999999;7.64159900000004,-75.681899;7.621502000000021,-75.68879799999991;7.603601000000029,-75.6967999999999;7.58339900000004,-75.70079800000001;7.56089900000001,-75.7146979999999;7.546500000000039,-75.7232969999999;7.53150099999999,-75.73429899999999;7.51949900000011,-75.7463989999999;7.499901000000021,-75.7624959999999;7.4826000000001,-75.7745959999999;7.460100000000071,-75.7866979999999;7.441701000000021,-75.8004989999999;7.42499900000013,-75.81030300000001;7.41689899999994,-75.8195039999999;7.40889900000008,-75.82579699999999;7.40950099999998,-75.8356019999999;7.388702000000021,-75.84139999999989;7.36879999999996,-75.9116979999999;7.3530990000001,-76.03040399999991;7.35160000000008,-76.34169799999999;7.353300000000051,-76.3469009999999;7.36320000000012,-76.35900100000001;7.37130000000008,-76.367103;7.3904,-76.37979799999989;7.40380100000016,-76.39649899999991;7.4112990000001,-76.4046019999999;7.422900000000029,-76.4103999999999;7.44780000000003,-76.4253989999999;7.45880100000005,-76.4293989999999;7.47150000000005,-76.43579800000001;7.48950099999996,-76.44609799999991;7.51090000000005,-76.4560009999999;7.529402000000059,-76.4662999999999;7.535200000000151,-76.477302;7.56070099999999,-76.481903;7.580299000000079,-76.4877009999999;7.59770100000003,-76.50269999999991;7.60990100000009,-76.505599;7.62030100000015,-76.509597;7.636999999999999,-76.51479999999999;7.64570100000014,-76.5183029999999;7.657899000000099,-76.51889799999989;7.678099000000091,-76.5142959999999;7.69370000000004,-76.5142959999999;7.71849900000001,-76.509102;7.73920100000015,-76.50450099999991;7.76640000000015,-76.501098;7.7745000000001,-76.50007699999991;7.79810000000003,-76.4971;7.83510000000007,-76.4901969999999;7.85240100000016,-76.4814999999999;7.87659800000012,-76.4682989999999;7.884101000000041,-76.4637;7.89389900000003,-76.4608009999999;7.910001000000019,-76.4555969999999;7.92040100000008,-76.44809699999991;7.948599000000119,-76.43199900000001;7.957300000000091,-76.42849799999991;7.973400000000139,-76.4227979999999;7.9815000000001,-76.4215989999999;7.984399,-76.4205009999999;7.998799000000021,-76.417602;8.019000999999999,-76.4164959999999;8.02650199999999,-76.41529800000001;8.04329899999993,-76.4164959999999;8.06230000000005,-76.41480299999991;8.06410099999999,-76.413597;8.07329900000008,-76.4130029999999;8.083100000000121,-76.4067009999999;8.0877010000001,-76.405602;8.09810100000016,-76.40100099999999;8.10330200000004,-76.39919999999989;8.11940200000009,-76.3952019999999;8.131000000000141,-76.392303;8.133302000000009,-76.3928979999999;8.146501000000001,-76.38539999999991;8.15028800000016,-76.3827129999999;8.16440100000005,-76.3727029999999;8.18920000000008,-76.364701;8.20010100000002,-76.3548959999999;8.232998000000009,-76.34279600000001;8.252598999999981,-76.327797;8.2745010000001,-76.31230099999991;8.294599000000011,-76.29900499999999;8.318299000000019,-76.2834999999999;8.349900000000099,-76.2656019999999;8.36949999999996,-76.2540969999999;8.37530100000015,-76.24659799999991;8.388499000000079,-76.234002;8.40230200000013,-76.21949699999991;8.416701000000099,-76.20049999999991;8.418399000000081,-76.19650300000001;8.42650100000003,-76.195398;8.43800000000005,-76.1958989999999;8.451301000000109,-76.1976989999999;8.46399999999994,-76.20060099999991;8.47159900000003,-76.20169899999991;8.487701000000071,-76.20519999999991;8.50100000000015,-76.20809899999991;8.521899000000079,-76.2115019999999;8.534601000000119,-76.212097;8.551299999999969,-76.2144009999999;8.563998999999971,-76.216201;8.57160000000005,-76.21729999999999;8.57909900000004,-76.2277;8.58370000000008,-76.2270959999999;8.589599000000019,-76.2397999999999;8.593601000000041,-76.25190000000001;8.60350100000011,-76.2629009999999;8.608800000000141,-76.2761999999999;8.61750000000001,-76.2917019999999;8.61639700000006,-76.298102;8.61930000000007,-76.30729599999999;8.62570000000011,-76.322304;8.633800000000059,-76.3303979999999;8.635601000000071,-76.3337999999999;8.63850000000008,-76.33730299999991;8.65300200000007,-76.3494029999999;8.68130000000002,-76.3598029999999;8.69520000000011,-76.3649969999999;8.710299000000081,-76.37419800000001;8.72930100000008,-76.37709699999991;8.740300000000101,-76.3799979999999;8.753601,-76.3812019999999;8.767501000000101,-76.3834989999999;8.77910000000003,-76.3874969999999;8.79120000000006,-76.38980100000001;8.797000000000139,-76.39160099999999;8.81320000000011,-76.3944029999999;8.82530000000008,-76.397302;8.833400000000101,-76.399102;8.84210000000013,-76.40479999999999;8.85079900000011,-76.4151999999999;8.85719900000009,-76.4215989999999;8.858332000000081,-76.42319499999989;9.000139000000051,-76.99986199999989;9.000139000000051,-77.00013799999989;8.99986100000012,-77.00013799999989;8.99986100000012,-76.99986199999989;', 8, NULL),
(3, 1, NULL, 'Arauca', '6.54783', '-70.9546', '7.09091000000006,-70.687798;7.09255100000013,-70.6914669999999;7.08735700000011,-70.701623;7.087491,-70.7167879999999;7.08424100000002,-70.7391189999999;7.08745500000003,-70.7510139999999;7.08851400000009,-70.7549429999999;7.088348,-70.7620699999999;7.08595000000003,-70.7660589999999;7.08223300000014,-70.7722329999999;7.075195000000121,-70.7817159999999;7.076403000000031,-70.7888339999999;7.07875699999994,-70.795022;7.07791400000002,-70.80399300000001;7.07566700000007,-70.809524;7.06756900000011,-70.8293619999999;7.06879500000008,-70.83854699999991;7.07097600000009,-70.85140299999991;7.05402200000009,-70.8570559999999;7.05128700000012,-70.8593759999999;7.0518130000001,-70.8671889999999;7.05603000000013,-70.87657899999989;7.05681599999997,-70.8878329999999;7.05796300000003,-70.887826;7.05735400000009,-70.89702699999999;7.05188900000002,-70.9025879999999;7.0376260000001,-70.9003979999999;7.03304500000013,-70.9020459999999;7.026711000000089,-70.9138169999999;7.02259300000003,-70.915689;7.02544400000005,-70.926697;7.016751,-70.93113700000001;7.00720800000005,-70.9436259999999;6.98592099999996,-70.95298699999999;6.98137400000002,-70.9587709999999;6.98026199999998,-70.962915;6.98148200000003,-70.9711829999999;6.99352500000015,-70.9825739999999;6.994942000000151,-70.98716;6.99293200000011,-70.9938419999999;6.98409599999997,-71.0077129999999;6.97910000000013,-71.0155559999999;6.98296800000008,-71.065865;6.98313399999995,-71.08562499999989;6.98319500000002,-71.09298;6.98673700000001,-71.10421599999999;6.994628000000091,-71.11380699999999;6.999247000000029,-71.116989;7.00446199999999,-71.108672;7.008651000000041,-71.1150809999999;7.01013900000004,-71.12816599999999;7.026032000000041,-71.13310199999989;7.02907200000004,-71.1395179999999;7.02918600000004,-71.1530769999999;7.02754300000015,-71.157455;7.023566000000069,-71.1680599999999;7.01981000000001,-71.186249;7.01910100000015,-71.21199899999991;7.02129100000013,-71.22692099999991;7.019744000000061,-71.2342839999999;7.012925,-71.243301;7.01299099999994,-71.2511139999999;7.02809000000013,-71.27168999999989;7.026975000000049,-71.279557;7.026786000000071,-71.2808899999999;7.02272000000005,-71.2894279999999;7.02146400000009,-71.30461200000001;7.01834000000002,-71.3161239999999;7.01471600000002,-71.3223569999999;7.012480000000149,-71.330186;7.01444200000009,-71.34557199999991;7.015771000000139,-71.36785999999999;7.01794300000006,-71.38094199999991;7.02004199999999,-71.3850629999999;7.02443600000015,-71.388482;7.02907900000008,-71.3944229999999;7.03214200000002,-71.4042809999999;7.03319500000009,-71.42106;7.03144900000007,-71.4327929999999;7.03010900000004,-71.4374009999999;7.020961,-71.44275;7.01419400000003,-71.4586629999999;7.011247000000081,-71.463736;7.011037000000099,-71.46627099999991;7.02576700000014,-71.46938399999991;7.02992500000005,-71.47210799999991;7.02836099999996,-71.4778669999999;7.01514200000014,-71.491524;7.02652000000006,-71.5068439999999;7.02528899999999,-71.5256949999999;7.02701200000013,-71.54016899999991;7.02964000000014,-71.55324499999991;7.027806999999999,-71.5584639999999;7.023570000000059,-71.570534;7.020418000000011,-71.5785979999999;7.02073499999995,-71.5900869999999;7.02834500000006,-71.59348299999991;7.041667000000129,-71.593155;7.046751000000139,-71.5970319999999;7.04772200000002,-71.6039119999999;7.04000100000013,-71.61546300000001;7.038212000000039,-71.62168;7.038820000000099,-71.62526799999991;7.03965399999998,-71.6301789999999;7.04639100000003,-71.64001399999989;7.04806400000007,-71.645659;7.051334999999989,-71.65087800000001;7.05116800000002,-71.6556919999999;7.047648999999979,-71.6594939999999;7.04348300000009,-71.660989;7.03301500000015,-71.65961400000001;7.022359999999941,-71.660118;7.02113400000013,-71.66327;7.02177900000004,-71.66514599999989;7.0354900000001,-71.6792609999999;7.037441000000061,-71.6871869999999;7.03731400000004,-71.6961899999999;7.036299000000039,-71.6997519999999;7.0365250000001,-71.70142299999991;7.03562900000003,-71.7187969999999;7.03480200000001,-71.719635;7.03767600000015,-71.7251119999999;7.03862900000013,-71.726929;7.04115600000011,-71.72921;7.05791000000011,-71.732629;7.06168900000011,-71.7344749999999;7.06194600000009,-71.7399129999999;7.0596920000001,-71.745164;7.05037100000015,-71.754859;7.04977800000012,-71.7588429999999;7.05187700000005,-71.759871;7.056899999999981,-71.7606669999999;7.066300000000069,-71.7595449999999;7.071738000000039,-71.76012400000001;7.071979000000109,-71.7638849999999;7.07013299999994,-71.7678759999999;7.05785499999996,-71.7742549999999;7.05287500000003,-71.7784799999999;7.05520200000001,-71.781601;7.05876499999994,-71.78261500000001;7.06883600000009,-71.78692699999991;7.06718400000005,-71.7892379999999;7.061779999999999,-71.79263400000001;7.05658400000016,-71.7960209999999;7.05409700000007,-71.7987669999999;7.05746800000009,-71.8016659999999;7.05519299999997,-71.8044059999999;7.04812300000015,-71.80864699999989;7.04628000000008,-71.813057;7.047570000000061,-71.8172299999999;7.04574400000013,-71.82034400000001;7.03698800000006,-71.823967;7.02296000000001,-71.822219;7.011324999999939,-71.8331069999999;7.007702999999941,-71.8404839999999;7.00866499999995,-71.8462209999999;7.00909600000011,-71.87357299999999;7.01415100000003,-71.904802;7.01059300000014,-71.9209129999999;7.010267,-71.939071;7.010187000000139,-71.9597559999999;7.008635000000141,-71.9671249999999;7.01027800000003,-71.9830849999999;6.89840000000015,-72.0036999999999;6.88870000000014,-72.0151979999999;6.86899900000003,-72.02040199999991;6.854600000000061,-72.0289979999999;6.844300000000149,-72.03420199999989;6.83040000000005,-72.03710099999989;6.81770100000006,-72.044501;6.807301,-72.047403;6.79810000000009,-72.0485989999999;6.7779000000001,-72.0542989999999;6.766399999999981,-72.05549599999991;6.751401000000101,-72.0630029999999;6.74330000000003,-72.0658039999999;6.73060100000004,-72.0727009999999;6.721400000000069,-72.077904;6.70580000000007,-72.084801;6.69370000000004,-72.0912009999999;6.678801000000079,-72.09870099999991;6.67240100000009,-72.1009989999999;6.66029900000007,-72.10839899999991;6.64820100000009,-72.1193999999999;6.632701000000109,-72.12799699999989;6.61709999999999,-72.133201;6.596900000000011,-72.14070100000001;6.57559900000007,-72.1458979999999;6.55420100000009,-72.1475979999999;6.53460000000007,-72.151605;6.51380100000011,-72.1545039999999;6.49700100000007,-72.15619700000001;6.484399999999989,-72.16079599999991;6.47340100000014,-72.165398;6.46019999999999,-72.176903;6.444599000000039,-72.191902;6.436598999999999,-72.20290299999991;6.42109900000003,-72.221298;6.41299900000007,-72.23110299999991;6.41249999999997,-72.2437979999999;6.410799999999991,-72.259902;6.41090000000014,-72.270302;6.41090000000014,-72.27950299999991;6.41789900000015,-72.30029999999989;6.42030100000011,-72.3049019999999;6.421400000000061,-72.309501;6.41570000000007,-72.31700099999991;6.40530000000007,-72.31700099999991;6.39320000000004,-72.31700099999991;6.38280000000003,-72.313498;6.36600100000004,-72.313498;6.35310600000003,-72.3166439999999;6.34410100000008,-72.3249969999999;6.34240099999994,-72.331902;6.331499000000121,-72.3491969999999;6.329199999999959,-72.3555989999999;6.32860000000005,-72.358397;6.318299000000081,-72.3722999999999;6.306201000000041,-72.3826;6.29529999999994,-72.393601;6.283799000000099,-72.397599;6.27050100000014,-72.40799800000001;6.25610100000006,-72.4159999999999;6.2437480000001,-72.4223859999999;6.23999900000007,-72.4206019999999;6.22669999999994,-72.41950300000001;6.21040000000005,-72.403296;6.18609999999995,-72.395798;6.18029899999993,-72.381401;6.182000000000019,-72.364699;6.180101000000089,-72.344497;6.17949900000002,-72.330704;6.17309900000004,-72.312202;6.166702000000099,-72.3093029999999;6.16150100000016,-72.307602;6.148799000000111,-72.30989699999991;6.136100000000059,-72.3087009999999;6.126801,-72.30409899999999;6.114701000000031,-72.292603;6.108299000000051,-72.28800199999991;6.096101000000091,-72.2792979999999;6.09139900000008,-72.262603;6.08209999999997,-72.242401;6.07340099999999,-72.2274019999999;6.06059900000002,-72.2054969999999;6.05470099999997,-72.1882029999999;6.049500000000081,-72.172698;6.04190099999994,-72.15879799999991;6.04010100000005,-72.15070400000001;6.04010100000005,-72.14559899999991;6.04300000000012,-72.13810099999991;6.04699900000008,-72.13110399999989;6.053897999999949,-72.12370300000001;6.066500000000129,-72.1116029999999;6.07110099999994,-72.10639999999989;6.074000000000011,-72.1011969999999;6.08549900000003,-72.08910400000001;6.09180000000003,-72.0753009999999;6.09800000000001,-72.0498959999999;6.100901000000021,-72.039498;6.1037,-72.02400299999989;6.106501000000091,-72.01239699999989;6.11170000000004,-72.0002969999999;6.115699000000009,-71.9899979999999;6.1203010000001,-71.98020199999991;6.12770100000006,-71.970901;6.13060000000013,-71.96350099999989;6.13400100000013,-71.952499;6.131100000000119,-71.9352029999999;6.12979999999999,-71.915001;6.13540000000006,-71.856796;6.13700000000011,-71.8476019999999;6.14050100000009,-71.83840099999991;6.15030100000001,-71.829697;6.16290000000009,-71.81759700000001;6.17320000000001,-71.7979969999999;6.175499,-71.79049599999991;6.18180100000006,-71.77149899999991;6.18690000000009,-71.747901;6.19200000000001,-71.7312019999999;6.19600000000003,-71.70639799999999;6.19990000000013,-71.6850969999999;6.200401,-71.664902;6.19399900000002,-71.64589599999989;6.18750100000005,-71.6290969999999;6.17480000000006,-71.6146989999999;6.17070000000012,-71.6090019999999;6.1648990000001,-71.5951009999999;6.169501000000031,-71.58989799999991;6.17410000000007,-71.5852959999999;6.171700000000099,-71.5801;6.16530000000006,-71.56459699999991;6.16880100000003,-71.560502;6.17679900000007,-71.55819700000001;6.177999999999999,-71.548402;6.16979900000001,-71.53630200000001;6.16800100000012,-71.5196;6.17659999999995,-71.51100099999989;6.17600100000016,-71.4964989999999;6.17709900000006,-71.48159800000001;6.18509900000009,-71.4660039999999;6.19200000000001,-71.45970199999989;6.196700000000021,-71.45970199999989;6.204099999999979,-71.45390399999999;6.197201000000061,-71.4464039999999;6.196600000000101,-71.4411999999999;6.200600000000121,-71.430801;6.20110099999999,-71.427398;6.20110099999999,-71.4216;6.20340100000004,-71.4159019999999;6.20680099999998,-71.400903;6.2016000000001,-71.393402;6.19920000000013,-71.389899;6.19920000000013,-71.384201;6.19920000000013,-71.3743969999999;6.203701000000019,-71.360496;6.208900000000141,-71.34780099999991;6.21460000000013,-71.337996;6.22899999999999,-71.3184959999999;6.23010100000016,-71.3109979999999;6.22950100000008,-71.30059799999999;6.226600000000019,-71.291397;6.23230000000001,-71.28559899999991;6.23520100000007,-71.2809979999999;6.23280100000011,-71.26999599999991;6.23050000000012,-71.2578959999999;6.23039900000015,-71.2499009999999;6.241398000000001,-71.239501;6.24600000000009,-71.23829600000001;6.24770000000007,-71.23660199999991;6.25050100000016,-71.22339700000001;6.24290000000008,-71.2042999999999;6.2371,-71.183601;6.2364,-71.16860199999989;6.22950100000008,-71.1628039999999;6.22600100000005,-71.1490009999999;6.22710100000012,-71.13510100000001;6.22930100000002,-71.12359600000001;6.22920000000005,-71.100602;6.223999000000111,-71.0832979999999;6.22209900000013,-71.0631029999999;6.22090000000003,-71.04920300000001;6.220300000000121,-71.0301969999999;6.212699000000039,-71.0186989999999;6.2016000000001,-70.995103;6.19579999999996,-70.97309799999989;6.19460100000009,-70.95989899999989;6.19150100000007,-70.92929700000001;6.186300000000021,-70.916099;6.184500000000069,-70.9039989999999;6.184500000000069,-70.8965009999999;6.188399000000119,-70.8803029999999;6.19940100000002,-70.868798;6.199300000000051,-70.851501;6.19920000000013,-70.835898;6.200900000000101,-70.826103;6.204900000000121,-70.81349899999989;6.20479999999998,-70.79499899999991;6.196101,-70.781798;6.19150100000007,-70.7743;6.19079900000008,-70.763299;6.19140100000016,-70.7501;6.19130100000007,-70.736802;6.19130100000007,-70.72350299999989;6.191200000000039,-70.7136999999999;6.19060100000007,-70.7068009999999;6.186501000000079,-70.687798;6.18810099999996,-70.668801;6.19090000000011,-70.6416999999999;6.19600000000003,-70.6227029999999;6.1977,-70.6099999999999;6.20400000000006,-70.58809699999991;6.20390000000015,-70.5737;6.20560000000012,-70.5604009999999;6.20440100000002,-70.5495;6.20200100000005,-70.53849799999991;6.214101000000031,-70.5292979999999;6.20600100000007,-70.51599899999989;6.20600100000007,-70.510802;6.2111000000001,-70.5033039999999;6.21630099999999,-70.49870199999999;6.22380100000009,-70.4906999999999;6.22490000000005,-70.4803009999999;6.225401000000151,-70.46700199999999;6.23060200000003,-70.457801;6.24209999999999,-70.4468999999999;6.24200000000008,-70.43710400000001;6.24200000000008,-70.4179979999999;6.244801,-70.412902;6.244801,-70.3973009999999;6.24579900000015,-70.3678959999999;6.24570100000005,-70.35459999999991;6.24220099999997,-70.33159600000001;6.23910100000001,-70.29409799999991;6.24019999999996,-70.272797;6.243600000000069,-70.25779799999999;6.24579900000015,-70.2369979999999;6.24630100000013,-70.2088009999999;6.24390099999994,-70.200699;6.24330100000003,-70.1856999999999;6.24850200000014,-70.18229699999991;6.24790099999996,-70.172501;6.240300000000101,-70.1678999999999;6.21950000000004,-70.158601;6.20320200000015,-70.13330000000001;6.178899999999999,-70.111901;6.167201000000151,-70.0870969999999;6.152100000000021,-70.0749969999999;6.13530000000014,-70.058296;6.1203010000001,-70.05709899999989;6.10820100000007,-70.0548019999999;6.1058010000001,-70.04560100000001;6.1058010000001,-70.030602;6.10679900000008,-70.00810299999991;6.11020000000008,-69.9999999999999;6.105500000000059,-69.9815989999999;6.09789900000015,-69.958;6.0788,-69.940597;6.074702,-69.9355009999999;6.06719900000007,-69.9291009999999;6.05792300000013,-69.923164;6.05619999999999,-69.9176029999999;6.04980100000012,-69.9209989999999;6.03480200000001,-69.9187009999999;6.02560100000011,-69.91529799999989;6.016300000000059,-69.91120099999991;6.01280100000008,-69.904297;6.01050100000003,-69.8955999999999;6.00690000000014,-69.88179699999991;6.00690000000014,-69.872002;6.00510000000008,-69.858803;6.004500000000009,-69.851799;6.00488100000007,-69.8478699999999;6.0091000000001,-69.846099;6.0021010000001,-69.820701;6.0003000000001,-69.8057019999999;6.00480100000004,-69.7941969999999;6.008801000000059,-69.783799;6.00530000000009,-69.77059799999989;5.998200999999989,-69.7387999999999;5.991199000000111,-69.7128979999999;5.992900000000131,-69.69560299999991;5.993401000000011,-69.679497;5.991500000000141,-69.655297;5.98909999999995,-69.63220199999989;5.988501000000159,-69.623002;5.992501,-69.606797;6.00169900000003,-69.59069699999991;6.0073010000001,-69.563598;6.01760100000001,-69.541703;6.0204,-69.52100299999989;6.02259900000001,-69.4897999999999;6.02200000000005,-69.480599;6.03060100000005,-69.47019899999989;6.03290100000015,-69.45760199999999;6.04040100000003,-69.4517969999999;6.05130000000014,-69.4517969999999;6.05590000000007,-69.4477999999999;6.06579300000004,-69.442444;6.08279600000003,-69.442444;6.10824400000007,-69.43656799999999;6.115118000000051,-69.43656799999999;6.112889000000001,-69.44143699999999;6.11445300000008,-69.4478839999999;6.116736,-69.4504229999999;6.11945500000007,-69.4523699999999;6.18264700000009,-69.4975669999999;6.20873400000005,-69.516609;6.22776700000014,-69.5306689999999;6.23097800000005,-69.5330419999999;6.232302,-69.5340199999999;6.24512200000009,-69.542389;6.25335200000001,-69.54911899999991;6.29958000000005,-69.581879;6.32680900000003,-69.6011579999999;6.3419110000001,-69.61207499999991;6.376464,-69.6362459999999;6.42016199999995,-69.66761799999991;6.43115199999994,-69.674134;6.442812000000001,-69.68364699999989;6.45151200000004,-69.689003;6.461569999999989,-69.6973559999999;6.478041000000021,-69.708747;6.49199200000004,-69.719436;6.50206500000002,-69.725487;6.54004000000009,-69.7524559999999;6.54100000000011,-69.7531519999999;6.55833699999999,-69.76570099999989;6.57321300000001,-69.77547300000001;6.57960800000012,-69.78104399999999;6.59036800000007,-69.787797;6.605916000000089,-69.7996439999999;6.62239,-69.810577;6.66561400000001,-69.841728;6.68482700000004,-69.855216;6.71180700000002,-69.8749759999999;6.725300000000001,-69.884742;6.734900000000099,-69.892411;6.74291500000015,-69.8966139999999;6.79230899999999,-69.93173299999999;6.8023730000001,-69.938484;6.825919,-69.9561539999999;6.83507400000008,-69.961517;6.84969700000011,-69.973136;6.85998500000011,-69.9805749999999;6.87640400000004,-69.9942639999999;6.88100100000008,-69.9999999999999;6.896951,-70.01190200000001;6.91522700000013,-70.02460599999991;6.92171400000001,-70.0302879999999;6.931414000000071,-70.0352559999999;6.93142,-70.03617899999991;6.980695000000141,-70.07113;6.99826700000011,-70.08268699999989;7.00246800000008,-70.0893169999999;7.00205500000015,-70.09414699999989;6.9930050000001,-70.1087099999999;6.98296800000008,-70.11984199999991;6.98051099999998,-70.12191799999989;6.97724700000015,-70.12947799999991;6.97711500000003,-70.136589;6.98034700000011,-70.14555300000001;6.98106400000012,-70.1539149999999;6.9768370000001,-70.1692279999999;6.973587000000011,-70.1780459999999;6.973049000000061,-70.1864179999999;6.97223500000001,-70.1885209999999;6.97290300000003,-70.192489;6.972365000000141,-70.200653;6.97211700000003,-70.21655199999989;6.971967999999949,-70.22241199999991;6.96668499999998,-70.23690000000001;6.96152799999999,-70.2432249999999;6.955975999999959,-70.2520679999999;6.94459800000004,-70.2634819999999;6.940702999999989,-70.270629;6.939292000000141,-70.2756659999999;6.93923300000006,-70.2898859999999;6.93454700000012,-70.3014459999999;6.93254400000012,-70.309831;6.932852000000029,-70.3190309999999;6.93566199999998,-70.32778999999989;6.9401610000001,-70.3384089999999;6.94845200000009,-70.351502;6.956495000000129,-70.361045;6.956764000000019,-70.3666929999999;6.96514000000008,-70.3680719999999;6.96536400000014,-70.36932299999999;6.96728700000006,-70.373284;6.97085900000002,-70.37513;6.97759600000006,-70.3796609999999;6.981436000000141,-70.38694700000001;6.9821290000001,-70.39342499999989;6.98118099999999,-70.4026349999999;6.98247099999998,-70.4061809999999;6.98251599999998,-70.410363;6.981696,-70.4131689999999;6.98425100000003,-70.4257429999999;6.99097400000011,-70.43235;6.99975300000011,-70.43779000000001;7.00254500000005,-70.441444;7.00447300000002,-70.451545;7.00658900000013,-70.456582;7.006623000000101,-70.4604879999999;6.99639200000001,-70.47229900000001;6.99854300000004,-70.4812469999999;7.00389200000012,-70.4885559999999;7.00536900000009,-70.4995729999999;7.01165300000008,-70.50825399999989;7.02042700000004,-70.5132369999999;7.02665199999996,-70.515479;7.03336600000006,-70.5214;7.03784900000005,-70.534234;7.043643000000029,-70.53993199999999;7.05651800000004,-70.540969;7.06806599999999,-70.54776800000001;7.07691400000004,-70.56079800000001;7.07496900000007,-70.57437899999999;7.070474999999989,-70.5856789999999;7.06638800000007,-70.5912329999999;7.06416600000006,-70.599525;7.064526,-70.614234;7.064273000000069,-70.6374519999999;7.06756900000011,-70.64615599999991;7.075254000000031,-70.6580509999999;7.07901499999997,-70.66744299999991;7.09091000000006,-70.687798;', 8, NULL),
(4, 1, NULL, 'Atlántico', '10.7171', '-74.9032', '11.107918,-74.84764199999989;11.107916,-74.84848099999989;11.107918,-74.8498619999999;11.1059720000001,-74.8498619999999;11.1059720000001,-74.85097399999989;11.105694,-74.85097399999989;11.105694,-74.8523639999999;11.1054160000001,-74.8523639999999;11.1054160000001,-74.853668;11.1054160000001,-74.85402599999991;11.1065280000001,-74.85402599999991;11.1065280000001,-74.8543079999999;11.1070840000001,-74.8543079999999;11.1070840000001,-74.854584;11.107362,-74.854584;11.107362,-74.85513999999991;11.1065280000001,-74.85513999999991;11.1065280000001,-74.85485799999989;11.1054160000001,-74.85485799999989;11.1054160000001,-74.854584;11.104028,-74.854584;11.104028,-74.8543079999999;11.1026400000001,-74.8543079999999;11.1026400000001,-74.85402599999991;11.1015280000001,-74.85402599999991;11.1015280000001,-74.853752;11.10014,-74.853752;11.10014,-74.85347;11.0987490000001,-74.85347;11.0987520000001,-74.8531959999999;11.0973610000001,-74.8531959999999;11.0973610000001,-74.8529139999999;11.0959710000001,-74.8529139999999;11.095973,-74.852638;11.0945829999999,-74.852638;11.0945829999999,-74.8523639999999;11.0934730000001,-74.8523639999999;11.0934730000001,-74.8520819999999;11.0920830000001,-74.8520819999999;11.0920850000001,-74.8518059999999;11.0906950000002,-74.8518059999999;11.0906950000002,-74.8515229999999;11.0893070000001,-74.8515229999999;11.0893070000001,-74.85124999999989;11.0879169999999,-74.85124999999989;11.0879169999999,-74.85097399999989;11.086529,-74.85097399999989;11.086531,-74.85069399999991;11.0854190000001,-74.85069399999991;11.0854190000001,-74.85041799999991;11.084028,-74.85041799999991;11.084028,-74.850135;11.082638,-74.850135;11.082638,-74.8498619999999;11.0812500000001,-74.8498619999999;11.0812500000001,-74.849586;11.0801400000001,-74.849586;11.0801400000001,-74.849304;11.07875,-74.849304;11.07875,-74.8490299999999;11.077638,-74.8490299999999;11.077638,-74.8487469999999;11.0762500000001,-74.8487469999999;11.0762520000001,-74.848472;11.074862,-74.848472;11.074862,-74.8481979999999;11.0737490000001,-74.8481979999999;11.0737490000001,-74.8479159999999;11.072361,-74.8479159999999;11.072361,-74.84764199999989;11.071251,-74.84764199999989;11.071251,-74.8473589999999;11.0698610000001,-74.8473589999999;11.0698610000001,-74.8470839999999;11.0687510000001,-74.8470839999999;11.0687510000001,-74.846801;11.0676390000001,-74.846801;11.0676390000001,-74.84652799999991;11.066805,-74.84652799999991;11.066807,-74.84625199999989;11.0659730000001,-74.84625199999989;11.0659730000001,-74.845969;11.065139,-74.845969;11.065139,-74.8456959999999;11.064583,-74.8456959999999;11.064585,-74.84541299999999;11.064029,-74.84541299999999;11.064029,-74.8456959999999;11.0637510000001,-74.8456959999999;11.0637510000001,-74.845969;11.063473,-74.845969;11.063473,-74.84625199999989;11.0631950000001,-74.84625199999989;11.0631950000001,-74.84652799999991;11.062917,-74.84652799999991;11.062917,-74.846801;11.0626389999999,-74.846801;11.0626389999999,-74.8470839999999;11.062361,-74.8470839999999;11.062363,-74.8473589999999;11.0620830000001,-74.8473589999999;11.0620830000001,-74.84764199999989;11.061807,-74.84764199999989;11.061807,-74.8479159999999;11.0615290000001,-74.8479159999999;11.0615290000001,-74.848472;11.061251,-74.848472;11.061251,-74.8487469999999;11.0609729999999,-74.8487469999999;11.0609729999999,-74.8490299999999;11.060695,-74.8490299999999;11.060695,-74.849304;11.060416,-74.849304;11.060416,-74.849586;11.0601379999999,-74.849586;11.0601379999999,-74.8498619999999;11.0598600000001,-74.8498619999999;11.0598600000001,-74.850135;11.059585,-74.850135;11.059585,-74.85041799999991;11.0593040000001,-74.85041799999991;11.0593040000001,-74.85069399999991;11.0590280000001,-74.85069399999991;11.0590280000001,-74.85097399999989;11.05875,-74.85097399999989;11.05875,-74.8515229999999;11.0584719999999,-74.8515229999999;11.0584719999999,-74.8523639999999;11.0581940000001,-74.8523639999999;11.0581940000001,-74.8529139999999;11.0579160000001,-74.8529139999999;11.0579160000001,-74.853752;11.0576380000001,-74.853752;11.05764,-74.8543079999999;11.0573600000001,-74.8543079999999;11.0573600000001,-74.85485799999989;11.057082,-74.85485799999989;11.057084,-74.8556959999999;11.0568059999999,-74.8556959999999;11.0568059999999,-74.85624799999989;11.0565280000001,-74.85624799999989;11.0565280000001,-74.8568039999999;11.0562500000001,-74.8568039999999;11.0562500000001,-74.857636;11.0559720000001,-74.857636;11.0559720000001,-74.8581919999999;11.0556940000001,-74.8581919999999;11.0556940000001,-74.85902399999991;11.055416,-74.85902399999991;11.055418,-74.8595799999999;11.0551379999999,-74.8595799999999;11.0551379999999,-74.860421;11.0548600000001,-74.860421;11.0548620000001,-74.861251;11.0545840000001,-74.861251;11.0545840000001,-74.862083;11.0543060000001,-74.862083;11.0543060000001,-74.86282299999991;11.0543060000001,-74.863197;11.0540280000001,-74.863197;11.0540280000001,-74.864029;11.05375,-74.864029;11.05375,-74.86486099999991;11.0534719999999,-74.86486099999991;11.0534719999999,-74.86569299999989;11.0531940000001,-74.86569299999989;11.0531940000001,-74.86653200000001;11.0529160000002,-74.86653200000001;11.0529160000002,-74.8676369999999;11.0526400000001,-74.8676369999999;11.0526400000001,-74.86846899999991;11.0523620000001,-74.86846899999991;11.0523620000001,-74.86930699999991;11.052084,-74.86930699999991;11.052084,-74.87041499999999;11.0518059999999,-74.87041499999999;11.0518059999999,-74.871247;11.0515280000001,-74.871247;11.0515280000001,-74.872359;11.0512500000002,-74.872359;11.0512500000002,-74.872918;11.050138,-74.872918;11.050138,-74.8734739999999;11.0498620000001,-74.8734739999999;11.0498620000001,-74.8740319999999;11.0495840000002,-74.8740319999999;11.0495840000002,-74.87486199999999;11.0493060000001,-74.87486199999999;11.0493080000001,-74.87542000000001;11.049028,-74.87542000000001;11.049028,-74.87625199999999;11.04875,-74.87625199999999;11.048752,-74.877084;11.048472,-74.877084;11.048472,-74.877914;11.0481960000001,-74.877914;11.0481960000001,-74.8784719999999;11.0479150000001,-74.8784719999999;11.0479150000001,-74.87930399999991;11.0476400000001,-74.87930399999991;11.0476400000001,-74.8801429999999;11.047362,-74.8801429999999;11.047362,-74.8809739999999;11.047084,-74.8809739999999;11.047084,-74.8818059999999;11.0468050000001,-74.8818059999999;11.0468050000001,-74.8826379999999;11.046527,-74.8826379999999;11.046527,-74.88346799999989;11.0462490000001,-74.88346799999989;11.0462490000001,-74.8843089999999;11.045971,-74.8843089999999;11.0459740000001,-74.8851379999999;11.0456930000001,-74.8851379999999;11.0456930000001,-74.8859699999999;11.0454170000002,-74.8859699999999;11.0454170000002,-74.8868019999999;11.0451390000001,-74.8868019999999;11.0451390000001,-74.8876409999999;11.044861,-74.8876409999999;11.0448640000001,-74.88847299999991;11.0445830000001,-74.88847299999991;11.0445830000001,-74.8901369999999;11.044305,-74.8901369999999;11.0443080000001,-74.8918069999999;11.0440270000001,-74.8918069999999;11.0440270000001,-74.89347099999991;11.043749,-74.89347099999991;11.0437510000002,-74.8954169999999;11.0434730000001,-74.8954169999999;11.0434730000001,-74.897361;11.043195,-74.897361;11.043195,-74.901528;11.0434730000001,-74.901528;11.0434730000001,-74.9045859999999;11.0437510000002,-74.9045859999999;11.043749,-74.9062499999999;11.0440270000001,-74.9062499999999;11.0440270000001,-74.90763800000001;11.0443080000001,-74.90763800000001;11.044305,-74.90875199999989;11.0445830000001,-74.90875199999989;11.0445830000001,-74.909858;11.0448640000001,-74.909858;11.044861,-74.91069899999999;11.0451390000001,-74.91069899999999;11.0451390000001,-74.911804;11.0454170000002,-74.911804;11.0454170000002,-74.915695;11.0456930000001,-74.915695;11.0456930000001,-74.9209749999999;11.0454170000002,-74.9209749999999;11.0454170000002,-74.9216319999999;11.0454170000002,-74.9218069999999;11.0450710000001,-74.9218069999999;11.044861,-74.9218069999999;11.044861,-74.92191199999991;11.0448640000001,-74.92208099999991;11.0445310000001,-74.92208099999991;11.043749,-74.92208099999991;11.0437510000002,-74.92236299999991;11.0429170000001,-74.92236299999991;11.0429170000001,-74.922637;11.0418050000001,-74.922637;11.0418050000001,-74.92291999999991;11.0395830000001,-74.92291999999991;11.0395830000001,-74.922637;11.0390290000001,-74.922637;11.0390290000001,-74.92236299999991;11.038749,-74.92236299999991;11.038749,-74.92208099999991;11.038195,-74.92208099999991;11.038195,-74.9218069999999;11.0379170000001,-74.9218069999999;11.0379170000001,-74.921525;11.0373610000001,-74.921525;11.0373610000001,-74.9212489999999;11.037083,-74.9212489999999;11.037083,-74.9209749999999;11.0368050000001,-74.9209749999999;11.0368050000001,-74.920693;11.0362510000001,-74.920693;11.0362510000001,-74.9204169999999;11.0345850000001,-74.9204169999999;11.0345850000001,-74.920134;11.0326380000001,-74.920134;11.0326380000001,-74.9204169999999;11.031806,-74.9204169999999;11.031806,-74.920693;11.03125,-74.920693;11.03125,-74.9209749999999;11.030694,-74.9209749999999;11.030694,-74.9212489999999;11.03014,-74.9212489999999;11.03014,-74.921525;11.029584,-74.921525;11.029584,-74.9218069999999;11.029028,-74.9218069999999;11.029028,-74.92208099999991;11.028472,-74.92208099999991;11.028472,-74.92236299999991;11.027918,-74.92236299999991;11.027918,-74.922637;11.0276380000001,-74.922637;11.0276380000001,-74.92291999999991;11.02736,-74.92291999999991;11.027362,-74.92319499999989;11.0270840000001,-74.92319499999989;11.0270840000001,-74.923469;11.026806,-74.923469;11.026808,-74.9237509999999;11.0265280000001,-74.9237509999999;11.0265280000001,-74.924027;11.02625,-74.924027;11.026252,-74.92430999999991;11.0259720000001,-74.92430999999991;11.0259720000001,-74.924859;11.025694,-74.924859;11.025694,-74.9251389999999;11.0254160000001,-74.9251389999999;11.0254160000001,-74.9254149999999;11.025138,-74.9254149999999;11.025138,-74.92597099999991;11.0248620000001,-74.92597099999991;11.0248620000001,-74.9262469999999;11.024584,-74.9262469999999;11.024584,-74.9265299999999;11.0243060000001,-74.9265299999999;11.0243060000001,-74.92680300000001;11.024028,-74.92680300000001;11.02403,-74.9273619999999;11.0237500000001,-74.9273619999999;11.0237500000001,-74.927635;11.023472,-74.927635;11.023474,-74.92791799999991;11.0231940000001,-74.92791799999991;11.0231940000001,-74.928191;11.022918,-74.928191;11.022918,-74.92874999999989;11.0226400000001,-74.92874999999989;11.0226400000001,-74.92903199999991;11.022362,-74.92903199999991;11.022362,-74.9295819999999;11.0220840000001,-74.9295819999999;11.0220840000001,-74.9301379999999;11.021806,-74.9301379999999;11.021806,-74.9306939999999;11.0215280000001,-74.9306939999999;11.0215280000001,-74.9312519999999;11.0212500000001,-74.9312519999999;11.021252,-74.931808;11.020971,-74.931808;11.020971,-74.932357;11.020696,-74.932357;11.020696,-74.9329139999999;11.0204150000001,-74.9329139999999;11.0204150000001,-74.9334719999999;11.02014,-74.9334719999999;11.02014,-74.9340279999999;11.0198620000001,-74.9340279999999;11.0198620000001,-74.935143;11.0195830000001,-74.935143;11.0195830000001,-74.93930899999999;11.019305,-74.93930899999999;11.019305,-74.9398579999999;11.0187490000001,-74.9398579999999;11.0187490000001,-74.94096999999989;11.0190269999999,-74.94096999999989;11.0190269999999,-74.941253;11.019305,-74.941253;11.019305,-74.94208500000001;11.0190269999999,-74.94208500000001;11.0190269999999,-74.94291699999999;11.018474,-74.94291699999999;11.018474,-74.94319299999989;11.017639,-74.94319299999989;11.017639,-74.94291699999999;11.0170830000001,-74.94291699999999;11.0170830000001,-74.942643;11.0165270000001,-74.942643;11.016529,-74.94291699999999;11.016249,-74.94291699999999;11.016249,-74.94319299999989;11.0156949999999,-74.94319299999989;11.0156949999999,-74.943473;11.0154170000001,-74.943473;11.0154170000001,-74.943749;11.0149110000001,-74.943794;11.0148610000001,-74.94384699999991;11.0148610000001,-74.9440309999999;11.014583,-74.9440699999999;11.014583,-74.944305;11.014305,-74.944305;11.014027,-74.944305;11.014027,-74.944581;11.0134730000001,-74.944581;11.0134730000001,-74.9448629999999;11.012917,-74.9448629999999;11.012917,-74.945137;11.012639,-74.945137;11.012639,-74.945419;11.0120850000001,-74.945419;11.0120850000001,-74.9456949999999;11.0115290000001,-74.9456949999999;11.0115290000001,-74.94596799999989;11.010973,-74.94596799999989;11.010973,-74.946251;11.0104190000001,-74.946251;11.0104190000001,-74.9465249999999;11.0101390000002,-74.9465249999999;11.0101390000002,-74.94787599999999;11.0101390000002,-74.9498589999999;11.0098610000001,-74.9498589999999;11.0098630000001,-74.950142;11.009307,-74.950142;11.009307,-74.950417;11.009027,-74.950417;11.009027,-74.95069099999991;11.0087510000001,-74.95069099999991;11.0087510000001,-74.951249;11.0084730000002,-74.951249;11.0084730000002,-74.95152999999991;11.0081950000001,-74.95152999999991;11.0081950000001,-74.95180499999999;11.007917,-74.95180499999999;11.007917,-74.9523609999999;11.0076390000001,-74.9523609999999;11.007641,-74.952637;11.0073600000001,-74.952637;11.0073600000001,-74.9531929999999;11.0059720000002,-74.9531929999999;11.0059720000002,-74.9534759999999;11.0054190000001,-74.9534759999999;11.0054190000001,-74.9531929999999;11.0045840000001,-74.9531929999999;11.0045840000001,-74.95291999999991;11.0042490000001,-74.95291999999991;11.0040280000001,-74.95291999999991;11.0040280000001,-74.9531929999999;11.00375,-74.9531929999999;11.00375,-74.9533459999999;11.00375,-74.95375199999999;11.003194,-74.95375199999999;11.003196,-74.9534759999999;11.0018060000001,-74.9534759999999;11.0018060000001,-74.952637;11.001528,-74.952637;11.001528,-74.952079;11.000418,-74.952079;11.000418,-74.9523609999999;11.0001400000001,-74.9523609999999;10.99986,-74.9523609999999;10.9995840000001,-74.9523609999999;10.9995840000001,-74.952637;10.99875,-74.952637;10.99875,-74.95291999999991;10.998194,-74.95291999999991;10.998194,-74.9531929999999;10.997638,-74.9531929999999;10.997638,-74.9534759999999;10.997084,-74.9534759999999;10.997084,-74.95375199999999;10.996528,-74.95375199999999;10.996528,-74.9540249999999;10.995972,-74.9540249999999;10.995972,-74.9543079999999;10.9956940000001,-74.9543079999999;10.9956940000001,-74.95458100000001;10.9951400000001,-74.95458100000001;10.9951400000001,-74.9548639999999;10.994862,-74.9548639999999;10.994862,-74.95514;10.994306,-74.95514;10.994306,-74.95541299999999;10.9940280000001,-74.95541299999999;10.9940300000001,-74.9556959999999;10.9934740000001,-74.9556959999999;10.9934740000001,-74.955972;10.993196,-74.955972;10.993196,-74.95625199999991;10.99264,-74.95625199999991;10.99264,-74.957084;10.992361,-74.957084;10.992361,-74.9573599999999;10.9920830000001,-74.9573599999999;10.9920830000001,-74.95764199999989;10.9915270000001,-74.95764199999989;10.9915270000001,-74.957916;10.991249,-74.957916;10.9912520000001,-74.9581919999999;10.9909730000001,-74.9581919999999;10.9909730000001,-74.9584739999999;10.9904170000001,-74.9584739999999;10.9904170000001,-74.958748;10.990139,-74.958748;10.990139,-74.9595859999999;10.9898610000001,-74.9595859999999;10.9898610000001,-74.9598619999999;10.9893050000001,-74.9598619999999;10.9893050000001,-74.96013600000001;10.989027,-74.96013600000001;10.989029,-74.96041799999991;10.9887510000001,-74.96041799999991;10.9887510000001,-74.9606939999999;10.9884710000001,-74.9606939999999;10.988473,-74.9609769999999;10.987917,-74.9609769999999;10.987917,-74.96125000000001;10.9876390000001,-74.96125000000001;10.9876390000001,-74.96152599999991;10.987361,-74.96152599999991;10.987361,-74.9618059999999;10.9870830000001,-74.9618059999999;10.9870830000001,-74.962082;10.9868050000001,-74.962082;10.986807,-74.96236499999991;10.9865270000001,-74.96236499999991;10.9865270000001,-74.9626379999999;10.986249,-74.9626379999999;10.986251,-74.962914;10.9859730000001,-74.962914;10.9859730000001,-74.9631959999999;10.985695,-74.9631959999999;10.985697,-74.96347;10.9854170000001,-74.96347;10.9854170000001,-74.9637529999999;10.9851390000001,-74.9637529999999;10.9851390000001,-74.964302;10.9848610000001,-74.964302;10.9848610000001,-74.96485799999989;10.984583,-74.96485799999989;10.984583,-74.9651409999999;10.9843050000001,-74.9651409999999;10.9843050000001,-74.965699;10.984029,-74.965699;10.984029,-74.96624799999999;10.9837510000001,-74.96624799999999;10.9837510000001,-74.9668039999999;10.9834730000001,-74.9668039999999;10.9834730000001,-74.9673599999999;10.9831950000001,-74.9673599999999;10.9831950000001,-74.9679189999999;10.982917,-74.9679189999999;10.982919,-74.9681919999999;10.9826390000001,-74.9681919999999;10.9826390000001,-74.9687509999999;10.982361,-74.9687509999999;10.982363,-74.9693069999999;10.9820830000002,-74.9693069999999;10.9820830000002,-74.969863;10.9818070000001,-74.969863;10.9818070000001,-74.970412;10.981526,-74.970412;10.981526,-74.97069499999991;10.981251,-74.97069499999991;10.981251,-74.9718029999999;10.9809730000001,-74.9718029999999;10.9809730000001,-74.97208499999989;10.980695,-74.97208499999989;10.980697,-74.9726409999999;10.9804170000002,-74.9726409999999;10.9804170000002,-74.9729149999999;10.980138,-74.9729149999999;10.9801410000001,-74.973197;10.97986,-74.973197;10.97986,-74.9737469999999;10.979585,-74.9737469999999;10.979585,-74.974029;10.9793040000001,-74.974029;10.9793040000001,-74.974588;10.97875,-74.974588;10.97875,-74.9751369999999;10.978472,-74.9751369999999;10.978472,-74.97541699999989;10.978194,-74.97541699999989;10.978194,-74.97680699999989;10.978472,-74.97680699999989;10.978472,-74.9770809999999;10.97875,-74.9770809999999;10.97875,-74.9776389999999;10.979029,-74.9776389999999;10.979029,-74.9779129999999;10.9793040000001,-74.9779129999999;10.9793040000001,-74.97846899999991;10.979585,-74.97846899999991;10.979585,-74.978752;10.97986,-74.978752;10.97986,-74.97846899999991;10.9809730000001,-74.97846899999991;10.9809730000001,-74.978752;10.9818070000001,-74.978752;10.9818070000001,-74.97846899999991;10.9826390000001,-74.97846899999991;10.9826390000001,-74.978195;10.9831950000001,-74.978195;10.9831950000001,-74.9779129999999;10.9837510000001,-74.9779129999999;10.9837510000001,-74.9776389999999;10.984029,-74.9776389999999;10.984029,-74.97736399999999;10.9843050000001,-74.97736399999999;10.9843050000001,-74.9770809999999;10.984583,-74.9770809999999;10.984583,-74.97680699999989;10.9848610000001,-74.97680699999989;10.9848610000001,-74.9765249999999;10.9851390000001,-74.9765249999999;10.9851390000001,-74.9759759999999;10.986251,-74.9759759999999;10.986249,-74.9762489999999;10.9865270000001,-74.9762489999999;10.9865270000001,-74.9765249999999;10.986249,-74.9765249999999;10.986251,-74.97680699999989;10.9859730000001,-74.97680699999989;10.9859730000001,-74.9770809999999;10.985695,-74.9770809999999;10.985697,-74.978195;10.9848610000001,-74.978195;10.9848610000001,-74.9793099999999;10.9851390000001,-74.9793099999999;10.9851390000001,-74.97958299999991;10.9854170000001,-74.97958299999991;10.9854170000001,-74.98013999999991;10.9851390000001,-74.98013999999991;10.9851390000001,-74.980698;10.9848610000001,-74.980698;10.9848610000001,-74.98153000000001;10.9851390000001,-74.98153000000001;10.9851390000001,-74.982362;10.9854170000001,-74.982362;10.9854170000001,-74.982918;10.9851390000001,-74.982918;10.9851390000001,-74.98319100000001;10.9848610000001,-74.98319100000001;10.9848610000001,-74.9834739999999;10.984583,-74.9834739999999;10.984583,-74.98375;10.9843050000001,-74.98375;10.9843050000001,-74.984582;10.984029,-74.984582;10.984029,-74.984864;10.9837510000001,-74.984864;10.9837510000001,-74.98513799999991;10.9843050000001,-74.98513799999991;10.9843050000001,-74.985694;10.984583,-74.985694;10.984583,-74.9859699999999;10.9843050000001,-74.9859699999999;10.9843050000001,-74.986526;10.984029,-74.986526;10.984029,-74.987084;10.9837510000001,-74.987084;10.9837510000001,-74.987916;10.9834730000001,-74.987916;10.9834730000001,-74.9884719999999;10.9831950000001,-74.9884719999999;10.9831950000001,-74.99041800000001;10.9834730000001,-74.99041800000001;10.9834730000001,-74.991248;10.9837510000001,-74.991248;10.9837510000001,-74.9926379999999;10.984029,-74.9926379999999;10.984029,-74.9934699999999;10.9843050000001,-74.9934699999999;10.9843050000001,-74.9937509999999;10.984029,-74.9937509999999;10.984029,-74.99402600000001;10.9837510000001,-74.99402600000001;10.9837510000001,-74.99458199999999;10.9834730000001,-74.99458199999999;10.9834730000001,-74.99569700000001;10.9837510000001,-74.99569700000001;10.9837510000001,-74.9970849999999;10.9834730000001,-74.9970849999999;10.9834730000001,-74.9979169999999;10.9831950000001,-74.9979169999999;10.9831950000001,-74.99986299999991;10.9834730000001,-74.99986299999991;10.983906,-74.99986299999991;10.99986,-74.99986299999991;10.99986,-75.0001369999999;10.9839220000001,-75.0001369999999;10.9834730000001,-75.0001369999999;10.9834730000001,-75.00041899999989;10.9831950000001,-75.00041899999989;10.9831950000001,-75.00069499999999;10.982917,-75.00069499999999;10.982919,-75.0009689999999;10.9826390000001,-75.0009689999999;10.9826390000001,-75.001527;10.982361,-75.001527;10.982363,-75.0020829999999;10.9820830000002,-75.0020829999999;10.9820830000002,-75.0026389999999;10.9818070000001,-75.0026389999999;10.9818070000001,-75.0031979999999;10.981526,-75.0031979999999;10.981526,-75.00347099999991;10.981251,-75.00347099999991;10.981251,-75.0045859999999;10.9809730000001,-75.0045859999999;10.9809730000001,-75.004859;10.980695,-75.004859;10.980697,-75.0062489999999;10.9801410000001,-75.0062489999999;10.9801410000001,-75.0068049999999;10.97986,-75.0068049999999;10.97986,-75.0073619999999;10.979585,-75.0073619999999;10.979585,-75.0076369999999;10.97875,-75.0076369999999;10.97875,-75.0079199999999;10.978472,-75.0079199999999;10.978472,-75.00819299999991;10.978194,-75.00819299999991;10.978194,-75.00846899999991;10.977916,-75.00846899999991;10.977916,-75.00902499999999;10.9776380000001,-75.00902499999999;10.9776380000001,-75.009308;10.9773600000001,-75.009308;10.9773600000001,-75.00986399999989;10.9770820000001,-75.00986399999989;10.9770820000001,-75.01014000000001;10.976929,-75.01014000000001;10.976806,-75.01014000000001;10.976806,-75.0104129999999;10.976528,-75.0104129999999;10.976528,-75.010972;10.97625,-75.010972;10.97625,-75.01125399999989;10.9759720000001,-75.01125399999989;10.9759720000001,-75.0115279999999;10.9754160000001,-75.0115279999999;10.9754160000001,-75.0120839999999;10.975138,-75.0120839999999;10.975138,-75.0118039999999;10.974862,-75.0118039999999;10.974862,-75.0120839999999;10.974584,-75.0120839999999;10.974584,-75.012642;10.9743060000001,-75.012642;10.9743060000001,-75.01291599999991;10.9740280000001,-75.01291599999991;10.9740280000001,-75.0131919999999;10.9737500000001,-75.0131919999999;10.9737500000001,-75.013474;10.973472,-75.013474;10.973472,-75.01430600000001;10.9726400000001,-75.01430600000001;10.9726400000001,-75.0145799999999;10.9723620000001,-75.0145799999999;10.9723620000001,-75.01486199999989;10.9720840000001,-75.01486199999989;10.9720840000001,-75.0151359999999;10.9715280000001,-75.0151359999999;10.9715280000001,-75.0154179999999;10.97125,-75.0154179999999;10.97125,-75.0156939999999;10.9706940000002,-75.0156939999999;10.9706940000002,-75.01597700000001;10.9704180000001,-75.01597700000001;10.9704180000001,-75.0162499999999;10.9698620000001,-75.0162499999999;10.9698620000001,-75.016809;10.9690280000002,-75.016809;10.9690280000002,-75.0170819999999;10.9687500000001,-75.0170819999999;10.9687520000001,-75.017365;10.9686040000001,-75.017365;10.9681940000001,-75.017365;10.9681960000001,-75.01763800000001;10.9679150000001,-75.01763800000001;10.9679150000001,-75.018197;10.9676400000001,-75.018197;10.9676400000001,-75.01846999999999;10.9673620000002,-75.01846999999999;10.9673620000002,-75.0187529999999;10.9670840000001,-75.0187529999999;10.9670840000001,-75.019302;10.966806,-75.019302;10.966806,-75.01958500000001;10.966527,-75.01958500000001;10.9665300000001,-75.020141;10.9662490000001,-75.020141;10.9662490000001,-75.0204159999999;10.965971,-75.0204159999999;10.9659740000001,-75.0206899999999;10.9654180000001,-75.0206899999999;10.9654180000001,-75.020973;10.9651390000001,-75.020973;10.9651390000001,-75.0212479999999;10.9645830000001,-75.0212479999999;10.9645830000001,-75.021531;10.964861,-75.0215899999999;10.964861,-75.021804;10.9645830000001,-75.021804;10.9645830000001,-75.0220869999999;10.964305,-75.0220869999999;10.9643080000001,-75.022363;10.9640270000001,-75.022363;10.9640270000001,-75.02263600000001;10.963749,-75.02263600000001;10.963751,-75.0229189999999;10.9634730000001,-75.0229189999999;10.9634730000001,-75.02347500000001;10.963195,-75.02347500000001;10.963195,-75.0240239999999;10.9629170000001,-75.0240239999999;10.9629170000001,-75.02430699999999;10.962083,-75.02430699999999;10.962083,-75.02458300000001;10.9618050000001,-75.02458300000001;10.9618050000001,-75.024863;10.961527,-75.024863;10.961529,-75.0254149999999;10.9612510000001,-75.0254149999999;10.9612510000001,-75.025971;10.960971,-75.025971;10.960973,-75.0262529999999;10.9606950000001,-75.0262529999999;10.9606950000001,-75.026527;10.960417,-75.026527;10.960417,-75.0270849999999;10.9601390000001,-75.0270849999999;10.9601390000001,-75.027359;10.959861,-75.027359;10.959861,-75.02819699999991;10.9601390000001,-75.02819699999991;10.9601390000001,-75.02847300000001;10.960417,-75.02847300000001;10.960417,-75.0287469999999;10.9590290000001,-75.0287469999999;10.9590290000001,-75.0290289999999;10.958749,-75.0290289999999;10.958749,-75.02930499999999;10.9590290000001,-75.02930499999999;10.9590290000001,-75.0295879999999;10.958749,-75.0295879999999;10.958751,-75.0304169999999;10.9584730000001,-75.0304169999999;10.9584730000001,-75.030693;10.958195,-75.030693;10.958195,-75.031808;10.9584730000001,-75.031808;10.9584730000001,-75.0323639999999;10.9579170000001,-75.0323639999999;10.9579170000001,-75.032639;10.957639,-75.032639;10.957639,-75.0331959999999;10.9573610000001,-75.0331959999999;10.9573610000001,-75.033469;10.957083,-75.033469;10.957083,-75.03375199999989;10.9568050000001,-75.03375199999989;10.9568050000001,-75.0340269999999;10.956527,-75.0340269999999;10.956527,-75.035972;10.9562510000001,-75.035972;10.9562510000001,-75.0365299999999;10.955973,-75.0365299999999;10.955973,-75.0370859999999;10.9556950000001,-75.0370859999999;10.9556950000001,-75.037635;10.955417,-75.037635;10.955417,-75.03791799999991;10.9551390000001,-75.03791799999991;10.9551390000001,-75.03847399999999;10.954861,-75.03847399999999;10.954861,-75.039023;10.9545830000001,-75.039023;10.9545830000001,-75.039306;10.954307,-75.039306;10.954307,-75.0395819999999;10.9540290000001,-75.0395819999999;10.9540290000001,-75.0398639999999;10.9534730000001,-75.0398639999999;10.9534730000001,-75.0404139999999;10.953195,-75.0404139999999;10.953195,-75.0406959999999;10.952916,-75.0406959999999;10.9529190000001,-75.04097;10.952085,-75.04097;10.952085,-75.041252;10.951804,-75.041252;10.9518070000001,-75.04152599999991;10.9509720000001,-75.04152599999991;10.9509720000001,-75.041252;10.950138,-75.041252;10.95014,-75.04097;10.9493060000001,-75.04097;10.9493060000001,-75.0406959999999;10.9481940000001,-75.0406959999999;10.9481940000001,-75.0404139999999;10.9473600000001,-75.0404139999999;10.9473620000001,-75.040138;10.9470840000001,-75.040138;10.9470840000001,-75.0398639999999;10.946806,-75.0398639999999;10.946806,-75.0395819999999;10.9465280000001,-75.0395819999999;10.9465280000001,-75.039306;10.94625,-75.039306;10.94625,-75.03874999999989;10.9465280000001,-75.03874999999989;10.9465280000001,-75.03819399999991;10.946806,-75.03819399999991;10.946806,-75.0373619999999;10.9470840000001,-75.0373619999999;10.9470840000001,-75.03680300000001;10.9473620000001,-75.03680300000001;10.9473620000001,-75.035972;10.947918,-75.035972;10.947916,-75.0356979999999;10.9481940000001,-75.0356979999999;10.9481940000001,-75.0354149999999;10.9493060000001,-75.0354149999999;10.9493060000001,-75.034859;10.949584,-75.034859;10.949582,-75.0345839999999;10.9498620000001,-75.0345839999999;10.9498620000001,-75.034301;10.95014,-75.034301;10.950138,-75.0340269999999;10.9504160000001,-75.0340269999999;10.9504160000001,-75.03375199999989;10.9506940000001,-75.03375199999989;10.9506940000001,-75.0331959999999;10.9509720000001,-75.0331959999999;10.9509720000001,-75.03291299999999;10.95125,-75.03291299999999;10.95125,-75.0323639999999;10.9515280000001,-75.0323639999999;10.9515280000001,-75.030137;10.95125,-75.030137;10.95125,-75.029861;10.9509720000001,-75.029861;10.9509720000001,-75.0295879999999;10.9506940000001,-75.0295879999999;10.9506940000001,-75.0290289999999;10.9504160000001,-75.0290289999999;10.9504160000001,-75.0287469999999;10.950138,-75.0287469999999;10.95014,-75.02819699999991;10.949584,-75.02819699999991;10.949584,-75.02791499999999;10.9493060000001,-75.02791499999999;10.9493060000001,-75.027359;10.948472,-75.027359;10.948472,-75.0270849999999;10.947918,-75.0270849999999;10.947918,-75.026803;10.9476380000002,-75.026803;10.9476380000002,-75.026527;10.9470840000001,-75.026527;10.9470840000001,-75.026803;10.946806,-75.026803;10.946806,-75.026527;10.9456940000001,-75.026527;10.9456940000001,-75.0262529999999;10.9454160000001,-75.0262529999999;10.9454160000001,-75.026527;10.944584,-75.026527;10.944584,-75.0262529999999;10.9423620000001,-75.0262529999999;10.9423620000001,-75.026527;10.9420840000001,-75.026527;10.9420840000001,-75.026803;10.941806,-75.026803;10.941806,-75.0270849999999;10.9415279999999,-75.0270849999999;10.9415279999999,-75.027359;10.94125,-75.027359;10.94125,-75.02791499999999;10.94014,-75.02791499999999;10.94014,-75.027641;10.9381930000001,-75.027641;10.9381930000001,-75.02791499999999;10.9379170000001,-75.02791499999999;10.9379170000001,-75.02819699999991;10.937639,-75.02819699999991;10.937639,-75.02847300000001;10.9365270000001,-75.02847300000001;10.9365270000001,-75.02819699999991;10.935695,-75.02819699999991;10.935695,-75.02847300000001;10.9354170000001,-75.02847300000001;10.9354170000001,-75.0287469999999;10.9348610000001,-75.0287469999999;10.9348610000001,-75.0290289999999;10.9345830000001,-75.0290289999999;10.9345830000001,-75.0295879999999;10.9331950000001,-75.0295879999999;10.9331950000001,-75.029861;10.932361,-75.029861;10.932361,-75.0295879999999;10.9320830000001,-75.0295879999999;10.9320850000001,-75.029861;10.931805,-75.029861;10.931805,-75.030976;10.9315290000001,-75.030976;10.9315290000001,-75.0312489999999;10.931249,-75.0312489999999;10.931249,-75.031525;10.930695,-75.031525;10.930695,-75.03208099999991;10.9304170000001,-75.03208099999991;10.9304190000001,-75.0323639999999;10.930139,-75.0323639999999;10.930139,-75.032639;10.9298610000001,-75.032639;10.9298630000001,-75.03291299999999;10.929583,-75.03291299999999;10.929583,-75.0331959999999;10.929027,-75.0331959999999;10.929027,-75.03336399999991;10.929027,-75.033469;10.928473,-75.033469;10.928473,-75.03375199999989;10.9281950000001,-75.03375199999989;10.9281950000001,-75.0340269999999;10.927917,-75.0340269999999;10.927917,-75.034301;10.927361,-75.034301;10.927361,-75.0345839999999;10.927082,-75.0345839999999;10.9270850000001,-75.034859;10.9268040000001,-75.034859;10.9268040000001,-75.0354149999999;10.9265290000001,-75.0354149999999;10.9265290000001,-75.0356979999999;10.926251,-75.0356979999999;10.926251,-75.035972;10.9259730000001,-75.035972;10.9259730000001,-75.0362469999999;10.9256940000001,-75.0362469999999;10.9256940000001,-75.0365299999999;10.925416,-75.0365299999999;10.9254190000001,-75.03680300000001;10.9251380000001,-75.03680300000001;10.9251380000001,-75.0370859999999;10.92486,-75.0370859999999;10.9248630000001,-75.0373619999999;10.924585,-75.0373619999999;10.924585,-75.037635;10.924306,-75.037635;10.924306,-75.03791799999991;10.9240280000001,-75.03791799999991;10.9240280000001,-75.03819399999991;10.92375,-75.03819399999991;10.92375,-75.03847399999999;10.9234720000001,-75.03847399999999;10.9234720000001,-75.03874999999989;10.923194,-75.03874999999989;10.9231970000001,-75.039023;10.9229160000001,-75.039023;10.9229160000001,-75.039306;10.922638,-75.039306;10.92264,-75.0395819999999;10.922084,-75.0395819999999;10.922084,-75.0398639999999;10.9218060000001,-75.0398639999999;10.9218060000001,-75.040138;10.921528,-75.040138;10.921528,-75.0404139999999;10.920972,-75.0404139999999;10.920974,-75.0406959999999;10.9206940000001,-75.0406959999999;10.9206940000001,-75.04097;10.9201400000001,-75.04097;10.9201400000001,-75.041252;10.9195840000001,-75.041252;10.9195840000001,-75.04152599999991;10.9190280000001,-75.04152599999991;10.9190280000001,-75.0418079999999;10.9184720000001,-75.0418079999999;10.9184720000001,-75.0420839999999;10.9179160000001,-75.0420839999999;10.9179160000001,-75.04235799999989;10.916528,-75.04235799999989;10.916528,-75.04263999999991;10.914862,-75.04263999999991;10.914862,-75.04291599999991;10.9129180000001,-75.04291599999991;10.9129180000001,-75.0431989999999;10.9104170000001,-75.0431989999999;10.9104170000001,-75.04347199999999;10.9081950000001,-75.04347199999999;10.9081950000001,-75.04374799999989;10.9069940000001,-75.04374799999989;10.9059730000001,-75.04374799999989;10.9059730000001,-75.0440279999999;10.904029,-75.0440279999999;10.904029,-75.044304;10.9020829999999,-75.044304;10.9020829999999,-75.04458700000001;10.9009730000001,-75.04458700000001;10.9009730000001,-75.044304;10.9012510000001,-75.044304;10.9012510000001,-75.0440279999999;10.9015270000002,-75.0440279999999;10.9015270000002,-75.04374799999989;10.901807,-75.04374799999989;10.901807,-75.04347199999999;10.902363,-75.04347199999999;10.902361,-75.0431989999999;10.9026390000001,-75.0431989999999;10.9026390000001,-75.04291599999991;10.904029,-75.04291599999991;10.904029,-75.04263999999991;10.905139,-75.04263999999991;10.905139,-75.04235799999989;10.9054169999999,-75.04235799999989;10.9054169999999,-75.0418079999999;10.905139,-75.0418079999999;10.905139,-75.04152599999991;10.9048610000002,-75.04152599999991;10.9048610000002,-75.04097;10.905139,-75.04097;10.905139,-75.0404139999999;10.904029,-75.0404139999999;10.904029,-75.04097;10.9037509999999,-75.04097;10.9037509999999,-75.041252;10.903473,-75.041252;10.903473,-75.0418079999999;10.9029170000001,-75.0418079999999;10.9029170000001,-75.0420839999999;10.902363,-75.0420839999999;10.902363,-75.04235799999989;10.9015270000002,-75.04235799999989;10.9015270000002,-75.04263999999991;10.9012510000001,-75.04263999999991;10.9012510000001,-75.04291599999991;10.9009730000001,-75.04291599999991;10.9009730000001,-75.0431989999999;10.900695,-75.0431989999999;10.900695,-75.04291599999991;10.9004169999999,-75.04291599999991;10.9004169999999,-75.0431989999999;10.89986,-75.0431989999999;10.89986,-75.04347199999999;10.899582,-75.04347199999999;10.899582,-75.04374799999989;10.8993040000001,-75.04374799999989;10.8993040000001,-75.0440279999999;10.8984720000001,-75.0440279999999;10.8984720000001,-75.044304;10.8979190000001,-75.044304;10.8979190000001,-75.04458700000001;10.8976380000001,-75.04458700000001;10.8976380000001,-75.045136;10.89736,-75.045136;10.897363,-75.045419;10.8970820000001,-75.045419;10.8970820000001,-75.0456919999999;10.8968060000001,-75.0456919999999;10.8968060000001,-75.04652399999991;10.896528,-75.04652399999991;10.896528,-75.0470799999999;10.89625,-75.0470799999999;10.89625,-75.04736299999991;10.8959720000001,-75.04736299999991;10.8959720000001,-75.04763799999991;10.895694,-75.04763799999991;10.8956960000002,-75.047921;10.8954160000001,-75.047921;10.8954160000001,-75.04819499999989;10.895138,-75.04819499999989;10.895138,-75.04930899999989;10.894862,-75.04930899999989;10.894862,-75.0498579999999;10.894584,-75.0498579999999;10.894584,-75.0504139999999;10.8943060000001,-75.0504139999999;10.8943060000001,-75.0509729999999;10.894028,-75.0509729999999;10.894028,-75.05236099999991;10.8937500000001,-75.05236099999991;10.8937500000001,-75.052634;10.893472,-75.052634;10.893472,-75.05291699999999;10.8931940000001,-75.05291699999999;10.8931940000001,-75.0543049999999;10.892916,-75.0543049999999;10.892916,-75.054581;10.8931940000001,-75.054581;10.8931940000001,-75.054863;10.892916,-75.054863;10.892916,-75.0556949999999;10.8926400000001,-75.0556949999999;10.8926400000001,-75.0565269999999;10.89236,-75.0565269999999;10.89236,-75.05819799999991;10.8920840000001,-75.05819799999991;10.8920840000001,-75.0584709999999;10.8915280000001,-75.0584709999999;10.8915280000001,-75.0593029999999;10.89125,-75.0593029999999;10.89125,-75.059586;10.8909720000001,-75.059586;10.8909720000001,-75.0601419999999;10.890694,-75.0601419999999;10.890694,-75.06069099999991;10.890138,-75.06069099999991;10.890138,-75.060974;10.889584,-75.060974;10.889584,-75.061249;10.889028,-75.061249;10.889028,-75.06208100000001;10.8887500000001,-75.06208100000001;10.8887520000001,-75.06292000000001;10.888472,-75.06292000000001;10.888472,-75.06375199999999;10.8881940000001,-75.06375199999999;10.8881960000001,-75.0640249999999;10.887916,-75.0640249999999;10.887916,-75.06541300000001;10.8876400000001,-75.06541300000001;10.8876400000001,-75.0656959999999;10.887362,-75.0656959999999;10.887362,-75.06541300000001;10.886806,-75.06541300000001;10.886806,-75.0656959999999;10.8870840000001,-75.0656959999999;10.8870840000001,-75.065972;10.887362,-75.065972;10.887362,-75.067086;10.8870840000001,-75.067086;10.8870840000001,-75.0684739999999;10.886806,-75.0684739999999;10.886806,-75.0690299999999;10.8865280000001,-75.0690299999999;10.8865300000001,-75.0701379999999;10.8862490000001,-75.0701379999999;10.8862490000001,-75.0706939999999;10.885971,-75.0706939999999;10.885971,-75.0718089999999;10.8862490000001,-75.0718089999999;10.8862490000001,-75.07236499999991;10.885971,-75.07236499999991;10.8859740000001,-75.07264099999991;10.8856930000001,-75.07264099999991;10.8856930000001,-75.07319699999989;10.8859740000001,-75.07319699999989;10.885971,-75.0737529999999;10.8862490000001,-75.0737529999999;10.8862490000001,-75.07736299999991;10.8865300000001,-75.07736299999991;10.8865280000001,-75.0790699999999;10.8865280000001,-75.0793069999999;10.8866760000001,-75.0793069999999;10.886806,-75.0793069999999;10.886806,-75.0795209999999;10.886806,-75.0812529999999;10.8865280000001,-75.0812529999999;10.8865300000001,-75.0815269999999;10.8859740000001,-75.0815269999999;10.8859740000001,-75.08180299999989;10.8854180000001,-75.08180299999989;10.8854180000001,-75.08208499999991;10.88514,-75.08208499999991;10.88514,-75.0823589999999;10.8845830000001,-75.0823589999999;10.8845830000001,-75.0826409999999;10.8840270000001,-75.0826409999999;10.8840270000001,-75.0829169999999;10.883193,-75.0829169999999;10.883195,-75.0831909999999;10.8829170000001,-75.0831909999999;10.8829170000001,-75.0834729999999;10.8823610000001,-75.0834729999999;10.8823610000001,-75.083747;10.8806950000001,-75.083747;10.8806950000001,-75.084029;10.8795830000001,-75.084029;10.8795830000001,-75.0843049999999;10.8790270000001,-75.0843049999999;10.8790270000001,-75.0845879999999;10.878749,-75.0845879999999;10.878749,-75.084861;10.8784730000001,-75.084861;10.8784730000001,-75.0851369999999;10.8779170000001,-75.0851369999999;10.8779170000001,-75.0854199999999;10.877639,-75.0854199999999;10.877639,-75.085976;10.8773610000001,-75.085976;10.8773610000001,-75.0862489999999;10.877083,-75.0862489999999;10.877085,-75.0865249999999;10.8768050000001,-75.0865249999999;10.8768050000001,-75.08763999999989;10.876527,-75.08763999999989;10.876529,-75.0887519999999;10.8762510000001,-75.0887519999999;10.8762510000001,-75.0895839999999;10.875417,-75.0895839999999;10.875417,-75.089859;10.8745830000001,-75.089859;10.8745830000001,-75.093194;10.874307,-75.093194;10.874307,-75.093476;10.8740290000001,-75.093476;10.8740290000001,-75.0945819999999;10.873751,-75.0945819999999;10.873751,-75.0968019999999;10.873195,-75.0968019999999;10.873195,-75.0970839999999;10.8729170000001,-75.0970839999999;10.8729170000001,-75.097358;10.871529,-75.097358;10.871529,-75.09764;10.87125,-75.09764;10.87125,-75.0979159999999;10.8709719999999,-75.0979159999999;10.8709719999999,-75.099028;10.872085,-75.099028;10.872085,-75.0995869999999;10.87236,-75.0995869999999;10.87236,-75.09986000000001;10.8726379999999,-75.09986000000001;10.8726379999999,-75.100692;10.872085,-75.100692;10.872085,-75.1004189999999;10.8687500000001,-75.1004189999999;10.8687500000001,-75.100692;10.8681940000001,-75.100692;10.8681940000001,-75.10097499999991;10.8676379999999,-75.10097499999991;10.8676379999999,-75.101524;10.8673600000001,-75.101524;10.867362,-75.10180699999999;10.8670840000001,-75.10180699999999;10.8670840000001,-75.1029119999999;10.8665280000001,-75.1029119999999;10.8665280000001,-75.10347;10.86625,-75.10347;10.86625,-75.104027;10.8659719999999,-75.104027;10.8659719999999,-75.10458299999991;10.8656940000001,-75.10458299999991;10.8656940000001,-75.1062459999999;10.8654160000002,-75.1062459999999;10.8654160000002,-75.1070849999999;10.8656940000001,-75.1070849999999;10.8656940000001,-75.108193;10.8654160000002,-75.108193;10.8654160000002,-75.1087489999999;10.8651400000001,-75.1087489999999;10.8651400000001,-75.1093069999999;10.8654160000002,-75.1093069999999;10.8654160000002,-75.10958099999991;10.8651400000001,-75.10958099999991;10.8651400000001,-75.109863;10.864584,-75.109863;10.864584,-75.11041999999991;10.8643059999999,-75.11041999999991;10.8643059999999,-75.11069500000001;10.864584,-75.11069500000001;10.864584,-75.1112509999999;10.8648620000001,-75.1112509999999;10.8648620000001,-75.1120829999999;10.8643059999999,-75.1120829999999;10.8643059999999,-75.112359;10.8640280000001,-75.112359;10.8640280000001,-75.1131979999999;10.8643059999999,-75.1131979999999;10.8643059999999,-75.11347099999991;10.864584,-75.11347099999991;10.864584,-75.1137469999999;10.8648620000001,-75.1137469999999;10.8648620000001,-75.1145859999999;10.8651400000001,-75.1145859999999;10.8651400000001,-75.1148619999999;10.8648620000001,-75.1148619999999;10.8648620000001,-75.1159739999999;10.864584,-75.1159739999999;10.864584,-75.115691;10.8640280000001,-75.115691;10.8640280000001,-75.11624999999989;10.8637500000002,-75.11624999999989;10.8637500000002,-75.1168059999999;10.8634720000001,-75.1168059999999;10.8634740000001,-75.1173639999999;10.862918,-75.1173639999999;10.862918,-75.1179199999999;10.8631940000001,-75.1179199999999;10.8631940000001,-75.11846899999991;10.8634740000001,-75.11846899999991;10.8634720000001,-75.11902600000001;10.8637500000002,-75.11902600000001;10.8637500000002,-75.119308;10.8634720000001,-75.119308;10.8634740000001,-75.1212449999999;10.8631940000001,-75.1212449999999;10.8631940000001,-75.1220859999999;10.862918,-75.1220859999999;10.862918,-75.122643;10.8626379999999,-75.122643;10.8626379999999,-75.1229179999999;10.8623620000001,-75.1229179999999;10.8623620000001,-75.1231919999999;10.8626379999999,-75.1231919999999;10.8626379999999,-75.123474;10.8623620000001,-75.123474;10.8623620000001,-75.1240309999999;10.8618060000001,-75.1240309999999;10.8618060000001,-75.1245799999999;10.8615280000001,-75.1245799999999;10.8615280000001,-75.12486199999989;10.8618060000001,-75.12486199999989;10.8618060000001,-75.12680899999999;10.8620840000002,-75.12680899999999;10.8620840000002,-75.12791399999991;10.8618060000001,-75.12791399999991;10.8618060000001,-75.1290289999999;10.8620840000002,-75.1290289999999;10.8620840000002,-75.1293019999999;10.8623620000001,-75.1293019999999;10.8623620000001,-75.12958500000001;10.8626379999999,-75.12958500000001;10.8626379999999,-75.12986099999991;10.862918,-75.12986099999991;10.862918,-75.130143;10.8626379999999,-75.130143;10.8626379999999,-75.1306919999999;10.8620840000002,-75.1306919999999;10.8620840000002,-75.13041699999999;10.8618060000001,-75.13041699999999;10.8618060000001,-75.130143;10.8615280000001,-75.130143;10.8615280000001,-75.12986099999991;10.8609719999999,-75.12986099999991;10.8609719999999,-75.12958500000001;10.8598620000001,-75.12958500000001;10.8598620000001,-75.12986099999991;10.859027,-75.12986099999991;10.859027,-75.130143;10.858471,-75.130143;10.8584740000001,-75.13041699999999;10.857918,-75.13041699999999;10.857918,-75.1306919999999;10.8576390000001,-75.1306919999999;10.8576390000001,-75.130973;10.857361,-75.130973;10.8573640000001,-75.131805;10.857083,-75.131805;10.857083,-75.1323629999999;10.856805,-75.1323629999999;10.8568080000001,-75.132637;10.8548610000001,-75.132637;10.8548610000001,-75.132919;10.854583,-75.132919;10.854583,-75.135139;10.854027,-75.135139;10.854027,-75.13569699999989;10.8543050000001,-75.13569699999989;10.8543050000001,-75.136803;10.854027,-75.136803;10.854027,-75.137085;10.853751,-75.137085;10.853751,-75.137642;10.853471,-75.137642;10.853473,-75.13819099999991;10.8531950000001,-75.13819099999991;10.8531950000001,-75.13847300000001;10.852917,-75.13847300000001;10.852917,-75.13902999999991;10.8531950000001,-75.13902999999991;10.8531950000001,-75.1398609999999;10.853473,-75.1398609999999;10.853473,-75.14125199999999;10.8531950000001,-75.14125199999999;10.8531950000001,-75.141808;10.852917,-75.141808;10.852917,-75.1423639999999;10.8526390000001,-75.1423639999999;10.8526390000001,-75.14264;10.852361,-75.14264;10.852361,-75.1431959999999;10.8520830000001,-75.1431959999999;10.8520830000001,-75.143472;10.8509730000001,-75.143472;10.8509730000001,-75.1437539999999;10.850139,-75.1437539999999;10.850139,-75.14402799999991;10.8498610000001,-75.14402799999991;10.8498610000001,-75.14430299999999;10.849583,-75.14430299999999;10.849583,-75.144584;10.8493050000001,-75.144584;10.8493050000001,-75.1448599999999;10.8487510000001,-75.1448599999999;10.8487510000001,-75.14514199999989;10.848473,-75.14514199999989;10.848473,-75.145416;10.8481950000001,-75.145416;10.8481950000001,-75.1456909999999;10.847917,-75.1456909999999;10.847917,-75.145974;10.8470830000001,-75.145974;10.8470850000001,-75.146248;10.8468040000001,-75.146248;10.8468040000001,-75.145974;10.8465290000001,-75.145974;10.8465290000001,-75.146248;10.846251,-75.146248;10.846251,-75.146806;10.8443070000001,-75.146806;10.8443070000001,-75.1470859999999;10.84375,-75.1470859999999;10.84375,-75.1473619999999;10.84264,-75.1473619999999;10.84264,-75.1470859999999;10.8423620000001,-75.1470859999999;10.8423620000001,-75.1473619999999;10.842082,-75.1473619999999;10.842084,-75.14763600000001;10.8418060000001,-75.14763600000001;10.8418060000001,-75.14791799999991;10.841528,-75.14791799999991;10.841528,-75.14875000000001;10.840972,-75.14875000000001;10.840972,-75.14902599999991;10.838752,-75.14902599999991;10.838752,-75.149582;10.8384720000001,-75.149582;10.8384720000001,-75.14986499999991;10.8379160000001,-75.14986499999991;10.8379160000001,-75.149582;10.837638,-75.149582;10.837638,-75.14986499999991;10.8362500000001,-75.14986499999991;10.8362500000001,-75.150138;10.835972,-75.150138;10.835974,-75.150414;10.8356940000001,-75.150414;10.8356940000001,-75.1506959999999;10.835418,-75.1506959999999;10.835418,-75.15097;10.8351400000001,-75.15097;10.8351400000001,-75.1515279999999;10.834862,-75.1515279999999;10.834862,-75.1526409999999;10.8351400000001,-75.1526409999999;10.8351400000001,-75.15347199999989;10.8345840000001,-75.15347199999989;10.8345840000001,-75.15374799999999;10.83375,-75.15374799999999;10.83375,-75.1540309999999;10.8334720000001,-75.1540309999999;10.8334720000001,-75.15374799999999;10.833196,-75.15374799999999;10.833196,-75.1540309999999;10.83264,-75.1540309999999;10.83264,-75.15458699999991;10.831805,-75.15458699999991;10.831805,-75.15652399999991;10.8315269999999,-75.15652399999991;10.8315269999999,-75.1570829999999;10.8312490000001,-75.1570829999999;10.8312490000001,-75.1598589999999;10.8306930000001,-75.1598589999999;10.8306930000001,-75.1601409999999;10.830139,-75.1601409999999;10.830139,-75.1604149999999;10.8298609999999,-75.1604149999999;10.8298609999999,-75.1609729999999;10.8295830000001,-75.1609729999999;10.8295830000001,-75.1640249999999;10.8293050000001,-75.1640249999999;10.8293050000001,-75.16430699999989;10.8290270000001,-75.16430699999989;10.8290300000001,-75.1654129999999;10.8287490000001,-75.1654129999999;10.8287490000001,-75.165695;10.828471,-75.165695;10.828471,-75.1665269999999;10.8287490000001,-75.1665269999999;10.8287490000001,-75.1668099999999;10.8290300000001,-75.1668099999999;10.8290270000001,-75.16791499999989;10.8293050000001,-75.16791499999989;10.8293050000001,-75.169586;10.8290270000001,-75.169586;10.8290270000001,-75.170418;10.8295830000001,-75.170418;10.8295830000001,-75.17125;10.8298609999999,-75.17125;10.8298609999999,-75.172364;10.830139,-75.172364;10.830139,-75.17375199999999;10.8298609999999,-75.17375199999999;10.8298609999999,-75.1743079999999;10.8295830000001,-75.1743079999999;10.8295830000001,-75.174584;10.8298609999999,-75.174584;10.8298609999999,-75.175416;10.830139,-75.175416;10.830139,-75.1759719999999;10.8304170000001,-75.1759719999999;10.8304170000001,-75.17763599999989;10.830139,-75.17763599999989;10.830139,-75.178192;10.8298609999999,-75.178192;10.8298609999999,-75.178748;10.830139,-75.178748;10.830139,-75.179863;10.8298609999999,-75.179863;10.8298609999999,-75.1804209999999;10.8295830000001,-75.1804209999999;10.8295830000001,-75.1809699999999;10.8293050000001,-75.1809699999999;10.8293050000001,-75.181251;10.8290270000001,-75.181251;10.8290300000001,-75.18152600000001;10.8287490000001,-75.18152600000001;10.8287490000001,-75.18208199999999;10.828471,-75.18208199999999;10.828471,-75.1826409999999;10.8281949999999,-75.1826409999999;10.8281949999999,-75.182914;10.8279170000001,-75.182914;10.8279170000001,-75.18319700000001;10.8276390000001,-75.18319700000001;10.8276390000001,-75.18347299999991;10.8273610000001,-75.18347299999991;10.8273610000001,-75.183746;10.8270830000001,-75.183746;10.8270830000001,-75.184029;10.826805,-75.184029;10.826805,-75.1843019999999;10.8265269999999,-75.1843019999999;10.8265269999999,-75.1845849999999;10.8262490000001,-75.1845849999999;10.8262510000001,-75.1851429999999;10.8256950000001,-75.1851429999999;10.8256950000001,-75.185417;10.8248609999999,-75.185417;10.8248609999999,-75.18708100000001;10.825139,-75.18708100000001;10.825139,-75.18791899999989;10.8243050000002,-75.18791899999989;10.8243050000002,-75.18819499999999;10.823749,-75.18819499999999;10.823749,-75.1884689999999;10.823473,-75.1884689999999;10.823473,-75.1887509999999;10.8231949999999,-75.1887509999999;10.8231949999999,-75.189027;10.8229170000001,-75.189027;10.8229170000001,-75.1893069999999;10.8226390000002,-75.1893069999999;10.8226390000002,-75.1895829999999;10.822083,-75.1895829999999;10.822083,-75.189857;10.821527,-75.189857;10.821527,-75.1901389999999;10.8212510000001,-75.1901389999999;10.8212510000001,-75.190415;10.8206950000001,-75.190415;10.8206950000001,-75.1915289999999;10.820417,-75.1915289999999;10.820417,-75.192359;10.8193040000001,-75.192359;10.8193040000001,-75.193191;10.8195850000001,-75.193191;10.8195850000001,-75.1929169999999;10.820141,-75.1929169999999;10.820141,-75.193191;10.819861,-75.193191;10.819861,-75.1937489999999;10.819582,-75.1937489999999;10.8195850000001,-75.1943049999999;10.8190290000001,-75.1943049999999;10.8190290000001,-75.1945809999999;10.8181940000001,-75.1945809999999;10.8181940000001,-75.1948619999999;10.817916,-75.1948619999999;10.817916,-75.19596899999991;10.8181940000001,-75.19596899999991;10.8181940000001,-75.1962519999999;10.818473,-75.1962519999999;10.818473,-75.196808;10.8181940000001,-75.196808;10.8181940000001,-75.1970809999999;10.817916,-75.1970809999999;10.8179190000001,-75.1979129999999;10.8176380000001,-75.1979129999999;10.8176380000001,-75.200142;10.8179190000001,-75.200142;10.8179190000001,-75.2006919999999;10.818473,-75.2006919999999;10.818473,-75.20124799999989;10.8181940000001,-75.20124799999989;10.8181940000001,-75.2029179999999;10.818473,-75.2029179999999;10.818473,-75.2037499999999;10.8181940000001,-75.2037499999999;10.8181940000001,-75.204865;10.817916,-75.204865;10.817916,-75.205697;10.8181940000001,-75.205697;10.8181940000001,-75.20596999999989;10.818473,-75.20596999999989;10.818473,-75.2062529999999;10.818751,-75.2062529999999;10.818751,-75.2079159999999;10.818473,-75.2079159999999;10.818473,-75.2081899999999;10.8181940000001,-75.2081899999999;10.8181940000001,-75.208473;10.8176380000001,-75.208473;10.8176380000001,-75.209031;10.81736,-75.209031;10.8173630000001,-75.209304;10.8170820000001,-75.209304;10.8170820000001,-75.2095869999999;10.8168060000002,-75.2095869999999;10.816809,-75.209863;10.8165280000001,-75.209863;10.8165280000001,-75.21013600000001;10.81625,-75.21013600000001;10.81625,-75.2104189999999;10.8159720000001,-75.2104189999999;10.8159720000001,-75.2106919999999;10.815694,-75.2106919999999;10.8156970000001,-75.21097500000001;10.8154160000001,-75.21097500000001;10.8154160000001,-75.2115239999999;10.8143060000001,-75.2115239999999;10.8143060000001,-75.21208299999989;10.814028,-75.21208299999989;10.814028,-75.21236500000001;10.8137500000001,-75.21236500000001;10.8137500000001,-75.2129149999999;10.812916,-75.2129149999999;10.812918,-75.213195;10.8126400000001,-75.213195;10.8126400000001,-75.213471;10.81236,-75.213471;10.812362,-75.214027;10.811806,-75.214027;10.811806,-75.214303;10.8115280000001,-75.214303;10.8115280000001,-75.2145849999999;10.81125,-75.2145849999999;10.81125,-75.214859;10.8109720000001,-75.214859;10.8109720000001,-75.215141;10.808472,-75.215141;10.808472,-75.2154169999999;10.8081940000001,-75.2154169999999;10.8081940000001,-75.21569700000001;10.807916,-75.21569700000001;10.807916,-75.21597300000001;10.8076400000001,-75.21597300000001;10.8076400000001,-75.2162469999999;10.8070840000001,-75.2162469999999;10.8070840000001,-75.21652899999999;10.8065300000001,-75.21652899999999;10.8065300000001,-75.21680499999999;10.80625,-75.21680499999999;10.80625,-75.2170879999999;10.8045830000001,-75.2170879999999;10.8045830000001,-75.21680499999999;10.8040270000001,-75.21680499999999;10.8040270000001,-75.21652899999999;10.803474,-75.21652899999999;10.803474,-75.2162469999999;10.8023610000001,-75.2162469999999;10.8023610000001,-75.21652899999999;10.801527,-75.21652899999999;10.801529,-75.21680499999999;10.801194,-75.216819;10.8012510000001,-75.2170879999999;10.8006950000001,-75.2170879999999;10.8006950000001,-75.217361;10.800417,-75.217361;10.800417,-75.217637;10.8001390000001,-75.217637;10.8001390000001,-75.21791999999991;10.799861,-75.21791999999991;10.799861,-75.218193;10.799307,-75.218193;10.799307,-75.218476;10.7990270000001,-75.218476;10.7990270000001,-75.2187489999999;10.798749,-75.2187489999999;10.798751,-75.219025;10.7984730000001,-75.219025;10.7984730000001,-75.219308;10.7979170000001,-75.219308;10.7979170000001,-75.21958099999991;10.797639,-75.21958099999991;10.797639,-75.2198639999999;10.7973610000001,-75.2198639999999;10.7973610000001,-75.220139;10.797083,-75.220139;10.797083,-75.2206959999999;10.7968050000001,-75.2206959999999;10.7968050000001,-75.22097100000001;10.796527,-75.22097100000001;10.796527,-75.221801;10.7962510000001,-75.221801;10.7962510000001,-75.2220839999999;10.796527,-75.2220839999999;10.796527,-75.222359;10.7962510000001,-75.222359;10.7962510000001,-75.2231979999999;10.795973,-75.2231979999999;10.795973,-75.2237469999999;10.7956950000001,-75.2237469999999;10.7956950000001,-75.22430300000001;10.795417,-75.22430300000001;10.795419,-75.2248619999999;10.7951390000001,-75.2248619999999;10.7951390000001,-75.232636;10.795419,-75.232636;10.795417,-75.2373579999999;10.7956950000001,-75.2373579999999;10.7956950000001,-75.2390289999999;10.795973,-75.2390289999999;10.795973,-75.24069299999989;10.7962510000001,-75.24069299999989;10.7962510000001,-75.2420809999999;10.796527,-75.2420809999999;10.796527,-75.243751;10.7968050000001,-75.243751;10.7968050000001,-75.2451389999999;10.797083,-75.2451389999999;10.797083,-75.2468029999999;10.7973610000001,-75.2468029999999;10.7973610000001,-75.24819099999991;10.797639,-75.24819099999991;10.797639,-75.24958100000001;10.7979170000001,-75.24958100000001;10.7979170000001,-75.25042000000001;10.798197,-75.25042000000001;10.798195,-75.2515249999999;10.7984730000001,-75.2515249999999;10.7984730000001,-75.2523569999999;10.798751,-75.2523569999999;10.798749,-75.253472;10.7990270000001,-75.253472;10.7990270000001,-75.25430399999991;10.799307,-75.25430399999991;10.799305,-75.255416;10.7995830000001,-75.255416;10.7995830000001,-75.256248;10.799861,-75.256248;10.799861,-75.25708;10.8001390000001,-75.25708;10.8001390000001,-75.257638;10.800417,-75.257638;10.800417,-75.25846799999989;10.8006950000001,-75.25846799999989;10.8006950000001,-75.25902599999991;10.800973,-75.25902599999991;10.800973,-75.25986499999991;10.801529,-75.25986499999991;10.801527,-75.26061900000001;10.7560990000001,-75.25129699999999;10.7394,-75.25299799999991;10.7336000000001,-75.2524029999999;10.7249,-75.24960399999991;10.7134020000001,-75.249;10.701801,-75.25129699999999;10.685701,-75.25589699999991;10.6666,-75.2633969999999;10.6573990000001,-75.2650979999999;10.644702,-75.2668;10.6290990000001,-75.2678989999999;10.6176010000001,-75.26909499999989;10.604899,-75.274299;10.5962000000001,-75.2806029999999;10.577798,-75.2806029999999;10.5697,-75.2806029999999;10.5541019999999,-75.27600099999989;10.537902,-75.2718959999999;10.5280010000001,-75.2695989999999;10.5142010000001,-75.2685;10.4996990000001,-75.265;10.4945,-75.26149700000001;10.4864,-75.251701;10.483401,-75.23670199999989;10.477001,-75.22640199999989;10.4723990000001,-75.2193989999999;10.4613,-75.20729899999991;10.456101,-75.2015989999999;10.4492,-75.19409999999991;10.4462990000001,-75.189401;10.4434000000001,-75.185401;10.4340010000001,-75.169296;10.423601,-75.15950100000001;10.4097,-75.154297;10.4033010000001,-75.15080399999989;10.400399,-75.144502;10.3992000000001,-75.1334979999999;10.3969010000001,-75.1207959999999;10.3957,-75.11450099999991;10.393901,-75.1057969999999;10.3927,-75.100601;10.388099,-75.09309999999989;10.3810999999999,-75.0839;10.375901,-75.076401;10.371199,-75.0717999999999;10.363101,-75.0614019999999;10.3585,-75.05680099999989;10.3543989999999,-75.0464009999999;10.3543989999999,-75.0411979999999;10.3549010000001,-75.034301;10.345101,-75.0234;10.3339990000001,-75.00840099999991;10.3247000000001,-74.99569700000001;10.3130990000001,-74.9887999999999;10.304999,-74.9801029999999;10.282399,-74.965699;10.2766010000001,-74.95880199999991;10.2749010000001,-74.95760299999991;10.274299,-74.9517989999999;10.2505010000001,-74.924697;10.2580010000001,-74.9281999999999;10.268401,-74.92590299999991;10.2811,-74.92590299999991;10.2892,-74.9218989999999;10.2989,-74.9080959999999;10.3127,-74.89540099999989;10.3295000000001,-74.886704;10.3410000000001,-74.8815989999999;10.343302,-74.87640500000001;10.3612000000001,-74.8705969999999;10.3813,-74.856797;10.3934000000002,-74.85099700000001;10.4055,-74.8406979999999;10.4153000000001,-74.8384019999999;10.4256999999999,-74.83319899999989;10.4413010000001,-74.8292019999999;10.448801,-74.8292019999999;10.4534010000001,-74.8274009999999;10.4638,-74.81880199999991;10.4763990000001,-74.81300399999991;10.5005990000001,-74.7957989999999;10.5219000000001,-74.7744;10.5357000000001,-74.76059699999991;10.5489990000002,-74.7468039999999;10.5628010000001,-74.743301;10.5732010000002,-74.7427969999999;10.5790010000001,-74.7427969999999;10.585301,-74.74099699999989;10.591699,-74.7445;10.5991990000001,-74.7473989999999;10.613701,-74.7531969999999;10.621801,-74.7543019999999;10.6326999999999,-74.753799;10.641999,-74.7526019999999;10.7107010000001,-74.74340099999991;10.7123010000001,-74.707703;10.709901,-74.696702;10.707501,-74.6875009999999;10.7081010000001,-74.674797;10.7092020000001,-74.65699699999991;10.7107990000001,-74.6344999999999;10.7119,-74.6218019999999;10.715301,-74.6084969999999;10.7220990000001,-74.5745009999999;10.7277990000001,-74.56529999999999;10.730698,-74.54920299999991;10.726001,-74.53589700000001;10.7219010000001,-74.522599;10.7184000000001,-74.51570200000001;10.7149020000001,-74.501899;10.7119,-74.48290299999999;10.7055,-74.46959699999989;10.704899,-74.4615019999999;10.7118000000001,-74.4655999999999;10.7193010000001,-74.4655999999999;10.7268010000001,-74.4655999999999;10.737201,-74.4655999999999;10.7482,-74.46729999999999;10.763801,-74.47019899999989;10.7760010000001,-74.47309799999989;10.7887000000001,-74.4770959999999;10.808401,-74.4822989999999;10.818801,-74.48290299999999;10.8303010000001,-74.486998;10.8384010000001,-74.48930299999989;10.8546010000001,-74.4991009999999;10.8622000000001,-74.5065989999999;10.8703000000001,-74.50949799999989;10.891701,-74.51930299999989;10.9090000000001,-74.5227969999999;10.922301,-74.5157999999999;10.9834730000001,-74.50028999999989;10.9834730000001,-74.5009699999999;10.9837510000001,-74.5009699999999;10.9837510000001,-74.502358;10.984029,-74.502358;10.984029,-74.50402799999991;10.9843050000001,-74.50402799999991;10.9843050000001,-74.5054159999999;10.984583,-74.5054159999999;10.984583,-74.5065309999999;10.9848610000001,-74.5065309999999;10.9848610000001,-74.50763599999991;10.9851390000001,-74.50763599999991;10.9851390000001,-74.50902599999991;10.9854170000001,-74.50902599999991;10.9854170000001,-74.5101389999999;10.985697,-74.5101389999999;10.985695,-74.5112529999999;10.9859730000001,-74.5112529999999;10.9859730000001,-74.5123609999999;10.986251,-74.5123609999999;10.986249,-74.51347299999991;10.9865270000001,-74.51347299999991;10.9865270000001,-74.51458099999989;10.986807,-74.51458099999989;10.9868050000001,-74.515975;10.9870830000001,-74.515975;10.9870830000001,-74.5170829999999;10.987361,-74.5170829999999;10.987361,-74.51819499999991;10.9876390000001,-74.51819499999991;10.9876390000001,-74.51930299999989;10.987917,-74.51930299999989;10.987917,-74.5204149999999;10.9881950000001,-74.5204149999999;10.9881950000001,-74.52153;10.988473,-74.52153;10.9884710000001,-74.52291799999991;10.9887510000001,-74.52291799999991;10.9887510000001,-74.5240249999999;10.989029,-74.5240249999999;10.989027,-74.52513999999999;10.9893050000001,-74.52513999999999;10.9893050000001,-74.5262519999999;10.989583,-74.5262519999999;10.989583,-74.52736;10.9898610000001,-74.52736;10.9898610000001,-74.52874799999989;10.990139,-74.52874799999989;10.990139,-74.52986199999999;10.9904170000001,-74.52986199999999;10.9904170000001,-74.5312499999999;10.990695,-74.5312499999999;10.990693,-74.5323649999999;10.9909730000001,-74.5323649999999;10.9909730000001,-74.53375299999991;10.9912520000001,-74.53375299999991;10.991249,-74.534858;10.9915270000001,-74.534858;10.9915270000001,-74.5362479999999;10.9918080000001,-74.5362479999999;10.991805,-74.53736000000001;10.9920830000001,-74.53736000000001;10.9920830000001,-74.53875099999991;10.992361,-74.53875099999991;10.992361,-74.5398629999999;10.99264,-74.5398629999999;10.99264,-74.5412529999999;10.9929180000001,-74.5412529999999;10.9929180000001,-74.54235900000001;10.993196,-74.54235900000001;10.993196,-74.54347299999991;10.9934740000001,-74.54347299999991;10.993471,-74.54430499999999;10.9937490000001,-74.54430499999999;10.9937490000001,-74.5454169999999;10.9940300000001,-74.5454169999999;10.9940280000001,-74.5465249999999;10.994306,-74.5465249999999;10.994306,-74.547637;10.9945840000001,-74.547637;10.9945840000001,-74.548469;10.994862,-74.548469;10.994862,-74.5495839999999;10.9951400000001,-74.5495839999999;10.9951400000001,-74.5506979999999;10.995416,-74.5506979999999;10.995416,-74.5515299999999;10.9956940000001,-74.5515299999999;10.9956940000001,-74.552635;10.995972,-74.552635;10.995972,-74.55374999999999;10.9962500000001,-74.55374999999999;10.9962500000001,-74.5548619999999;10.996528,-74.5548619999999;10.996528,-74.5556939999999;10.9968060000001,-74.5556939999999;10.9968060000001,-74.556808;10.9969310000001,-74.556808;10.997084,-74.556808;10.997084,-74.55763999999991;10.9973620000001,-74.55763999999991;10.9973620000001,-74.5587459999999;10.997638,-74.5587459999999;10.997638,-74.55958699999999;10.9979160000001,-74.55958699999999;10.9979160000001,-74.5606919999999;10.998194,-74.5606919999999;10.998194,-74.56135499999991;10.998194,-74.5615309999999;10.9984720000001,-74.5615309999999;10.9984720000001,-74.5619139999999;10.9984720000001,-74.56263799999989;10.99875,-74.56263799999989;10.99875,-74.5634679999999;10.9990280000001,-74.5634679999999;10.9990280000001,-74.564582;10.999306,-74.564582;10.999306,-74.565414;10.9995840000001,-74.565414;10.9995840000001,-74.5665289999999;10.99986,-74.5665289999999;10.99986,-74.564712;10.99986,-74.56430899999999;11.0001400000001,-74.56430899999999;11.000199,-74.5652689999999;11.0002090000001,-74.565414;11.000418,-74.565414;11.000416,-74.5658339999999;11.000416,-74.566253;11.0006940000001,-74.566253;11.0006940000001,-74.56639199999989;11.0006940000001,-74.56736099999991;11.000972,-74.56736099999991;11.000972,-74.56819299999989;11.0012500000001,-74.56819299999989;11.0012500000001,-74.569305;11.001528,-74.569305;11.001528,-74.570419;11.0018060000001,-74.570419;11.0018060000001,-74.5715249999999;11.0020870000001,-74.5715249999999;11.002084,-74.572915;11.0023620000001,-74.572915;11.0023620000001,-74.5740269999999;11.002638,-74.5740269999999;11.002638,-74.5751419999999;11.0029160000001,-74.5751419999999;11.0029160000001,-74.576247;11.003196,-74.576247;11.003194,-74.577637;11.0034720000001,-74.577637;11.0034720000001,-74.57875;11.00375,-74.57875;11.00375,-74.5801399999999;11.0040280000001,-74.5801399999999;11.0040280000001,-74.58125199999991;11.004309,-74.58125199999991;11.0043060000002,-74.58264199999989;11.0045840000001,-74.58264199999989;11.0045840000001,-74.5834739999999;11.0048630000001,-74.5834739999999;11.00486,-74.5843039999999;11.0051380000001,-74.5843039999999;11.0051380000001,-74.58541799999991;11.0054190000001,-74.58541799999991;11.005416,-74.58625000000001;11.0056940000001,-74.58625000000001;11.0056940000001,-74.587082;11.0059720000002,-74.587082;11.0059720000002,-74.587914;11.006251,-74.587914;11.006251,-74.5887529999999;11.0065290000001,-74.5887529999999;11.0065290000001,-74.58985799999989;11.0068040000001,-74.58985799999989;11.0068040000001,-74.590699;11.0070850000001,-74.590699;11.007082,-74.59152899999999;11.0073600000001,-74.59152899999999;11.0073600000001,-74.592361;11.007641,-74.592361;11.0076390000001,-74.5931919999999;11.007917,-74.5931919999999;11.007917,-74.5943069999999;11.0081950000001,-74.5943069999999;11.0081950000001,-74.5951389999999;11.0084730000002,-74.5951389999999;11.0084730000002,-74.59597099999991;11.0087510000001,-74.59597099999991;11.0087510000001,-74.5968029999999;11.009027,-74.5968029999999;11.009027,-74.597641;11.009307,-74.597641;11.009307,-74.5984729999999;11.009583,-74.5984729999999;11.009583,-74.5993049999999;11.0098630000001,-74.5993049999999;11.0098610000001,-74.60041699999989;11.0101390000002,-74.60041699999989;11.0101390000002,-74.6012489999999;11.0104190000001,-74.6012489999999;11.0104170000001,-74.6020809999999;11.010695,-74.6020809999999;11.010695,-74.6029129999999;11.010973,-74.6029129999999;11.010973,-74.603752;11.011249,-74.603752;11.011249,-74.604584;11.0115290000001,-74.604584;11.0115290000001,-74.60541499999989;11.0118050000002,-74.60541499999989;11.0118050000002,-74.6062469999999;11.0120850000001,-74.6062469999999;11.0120830000001,-74.607362;11.012361,-74.607362;11.012361,-74.60819100000001;11.012639,-74.60819100000001;11.012639,-74.60902299999999;11.012917,-74.60902299999999;11.012917,-74.609864;11.0131950000001,-74.609864;11.0131950000001,-74.610694;11.0134730000001,-74.610694;11.0134730000001,-74.61125199999989;11.0137510000001,-74.61125199999989;11.0137510000001,-74.6120839999999;11.014027,-74.6120839999999;11.014027,-74.6126399999999;11.014305,-74.6126399999999;11.014305,-74.6134719999999;11.014583,-74.6134719999999;11.014583,-74.61402800000001;11.0148610000001,-74.61402800000001;11.0148610000001,-74.6145869999999;11.0151390000001,-74.6145869999999;11.0151390000001,-74.6154189999999;11.0154170000001,-74.6154189999999;11.0154170000001,-74.61597499999991;11.0156949999999,-74.61597499999991;11.0156949999999,-74.6165309999999;11.015971,-74.6165309999999;11.015971,-74.617363;11.016249,-74.617363;11.016249,-74.6179189999999;11.016529,-74.6179189999999;11.0165270000001,-74.6187509999999;11.0168050000001,-74.6187509999999;11.0168050000001,-74.619309;11.0170830000001,-74.619309;11.0170830000001,-74.620141;11.0173609999999,-74.620141;11.0173609999999,-74.6209709999999;11.017639,-74.6209709999999;11.017639,-74.6218019999999;11.0179170000001,-74.6218019999999;11.0179170000001,-74.622643;11.0181930000001,-74.622643;11.0181930000001,-74.623473;11.018474,-74.623473;11.018474,-74.62430499999989;11.0187490000001,-74.62430499999989;11.0187490000001,-74.6251369999999;11.0190269999999,-74.6251369999999;11.0190269999999,-74.6259689999999;11.019305,-74.6259689999999;11.019305,-74.626807;11.0195830000001,-74.626807;11.0195830000001,-74.627639;11.0198620000001,-74.627639;11.0198620000001,-74.62847100000001;11.02014,-74.62847100000001;11.02014,-74.62902699999989;11.0204150000001,-74.62902699999989;11.0204150000001,-74.6298589999999;11.020696,-74.6298589999999;11.020696,-74.630691;11.020971,-74.630691;11.020971,-74.6312489999999;11.021252,-74.6312489999999;11.0212500000001,-74.63207899999991;11.0215280000001,-74.63207899999991;11.0215280000001,-74.63292;11.021806,-74.63292;11.021806,-74.633752;11.0220840000001,-74.633752;11.0220840000001,-74.634308;11.022362,-74.634308;11.022362,-74.63514000000001;11.0226400000001,-74.63514000000001;11.0226400000001,-74.635972;11.022918,-74.635972;11.022918,-74.6365279999999;11.0231940000001,-74.6365279999999;11.0231940000001,-74.6373599999999;11.023474,-74.6373599999999;11.023472,-74.6381919999999;11.0237500000001,-74.6381919999999;11.0237500000001,-74.63874799999989;11.02403,-74.63874799999989;11.024028,-74.6395799999999;11.0243060000001,-74.6395799999999;11.0243060000001,-74.640136;11.024584,-74.640136;11.024584,-74.64097700000001;11.0248620000001,-74.64097700000001;11.0248620000001,-74.641806;11.025138,-74.641806;11.025138,-74.6423649999999;11.0254160000001,-74.6423649999999;11.0254160000001,-74.6431969999999;11.025694,-74.6431969999999;11.025694,-74.6437529999999;11.0259720000001,-74.6437529999999;11.0259720000001,-74.64458500000001;11.026252,-74.64458500000001;11.02625,-74.645141;11.0265280000001,-74.645141;11.0265280000001,-74.645973;11.026808,-74.645973;11.026806,-74.646805;11.0270840000001,-74.646805;11.0270840000001,-74.64763600000001;11.027362,-74.64763600000001;11.02736,-74.64847500000001;11.0276380000001,-74.64847500000001;11.0276380000001,-74.64930699999999;11.027918,-74.64930699999999;11.027916,-74.650139;11.0281940000001,-74.650139;11.0281940000001,-74.650971;11.028472,-74.650971;11.028472,-74.651803;11.0287500000001,-74.651803;11.0287500000001,-74.652641;11.029028,-74.652641;11.029028,-74.65347300000001;11.0293060000001,-74.65347300000001;11.0293060000001,-74.654588;11.029584,-74.654588;11.029582,-74.6554169999999;11.0298620000001,-74.6554169999999;11.0298620000001,-74.6562489999999;11.03014,-74.6562489999999;11.030138,-74.65708099999991;11.0304160000001,-74.65708099999991;11.0304160000001,-74.65791299999999;11.030694,-74.65791299999999;11.030694,-74.65875199999989;11.0309720000001,-74.65875199999989;11.0309720000001,-74.6595839999999;11.03125,-74.6595839999999;11.03125,-74.6604159999999;11.0315280000001,-74.6604159999999;11.0315280000001,-74.6612469999999;11.031806,-74.6612469999999;11.031806,-74.662086;11.032085,-74.662086;11.032085,-74.66291799999991;11.0323630000001,-74.66291799999991;11.03236,-74.66374999999989;11.0326380000001,-74.66374999999989;11.0326380000001,-74.6648639999999;11.0329190000001,-74.6648639999999;11.032916,-74.6656939999999;11.0331940000001,-74.6656939999999;11.0331940000001,-74.6668089999999;11.0334730000001,-74.6668089999999;11.0334730000001,-74.66763999999991;11.033751,-74.66763999999991;11.033751,-74.66819700000001;11.0340290000001,-74.66819700000001;11.0340290000001,-74.6690279999999;11.034307,-74.6690279999999;11.034307,-74.6701359999999;11.0345850000001,-74.6701359999999;11.034582,-74.6709749999999;11.034861,-74.6709749999999;11.034861,-74.6718069999999;11.0351410000001,-74.6718069999999;11.0351390000001,-74.6726389999999;11.035417,-74.6726389999999;11.035417,-74.672921;11.0356950000001,-74.672921;11.0356950000001,-74.673751;11.035973,-74.673751;11.035973,-74.674583;11.0362510000001,-74.674583;11.0362510000001,-74.6751409999999;11.036527,-74.6751409999999;11.036527,-74.6759729999999;11.0368050000001,-74.6759729999999;11.0368050000001,-74.67680299999989;11.037083,-74.67680299999989;11.037083,-74.6776339999999;11.0373610000001,-74.6776339999999;11.0373610000001,-74.67819299999999;11.037639,-74.67819299999999;11.037639,-74.67903200000001;11.0379170000001,-74.67903200000001;11.0379170000001,-74.679863;11.038195,-74.679863;11.038195,-74.680695;11.0384730000001,-74.680695;11.0384730000001,-74.681251;11.038749,-74.681251;11.038749,-74.68208300000001;11.0390290000001,-74.68208300000001;11.0390290000001,-74.68291499999999;11.039305,-74.68291499999999;11.039305,-74.6834709999999;11.0395830000001,-74.6834709999999;11.0395830000001,-74.6843029999999;11.039861,-74.6843029999999;11.039861,-74.684859;11.0401390000001,-74.684859;11.0401390000001,-74.685418;11.040417,-74.685418;11.040417,-74.6859739999999;11.0406950000001,-74.6859739999999;11.0406950000001,-74.68680599999991;11.040973,-74.68680599999991;11.040971,-74.68736199999999;11.0412510000001,-74.68736199999999;11.0412510000001,-74.68791999999991;11.041527,-74.68791999999991;11.041527,-74.6884689999999;11.0418050000001,-74.6884689999999;11.0418050000001,-74.6893079999999;11.042083,-74.6893079999999;11.042083,-74.689857;11.0423610000001,-74.689857;11.0423610000001,-74.690414;11.042641,-74.690414;11.042639,-74.6912549999999;11.0429170000001,-74.6912549999999;11.0429170000001,-74.69180399999991;11.043195,-74.69180399999991;11.043195,-74.69235999999999;11.0434730000001,-74.69235999999999;11.0434730000001,-74.692916;11.0437510000002,-74.692916;11.043749,-74.693748;11.0440270000001,-74.693748;11.0440270000001,-74.6943059999999;11.0443080000001,-74.6943059999999;11.044305,-74.6948619999999;11.0445830000001,-74.6948619999999;11.0445830000001,-74.6956939999999;11.0448640000001,-74.6956939999999;11.044861,-74.69624999999991;11.0451390000001,-74.69624999999991;11.0451390000001,-74.6968089999999;11.0454170000002,-74.6968089999999;11.0454170000002,-74.69736499999991;11.0456930000001,-74.69736499999991;11.0456930000001,-74.697914;11.0459740000001,-74.697914;11.045971,-74.69819699999989;11.0462490000001,-74.69819699999989;11.0462490000001,-74.6987529999999;11.046527,-74.6987529999999;11.046527,-74.6993019999999;11.0468050000001,-74.6993019999999;11.0468050000001,-74.70097299999991;11.047084,-74.70097299999991;11.047084,-74.70236299999991;11.047362,-74.70236299999991;11.047362,-74.7040249999999;11.0476400000001,-74.7040249999999;11.0476400000001,-74.7054149999999;11.0479150000001,-74.7054149999999;11.0479150000001,-74.70569499999991;11.0481960000001,-74.70569499999991;11.0481960000001,-74.7062539999999;11.048472,-74.7062539999999;11.048472,-74.70680299999989;11.048752,-74.70680299999989;11.04875,-74.7073589999999;11.049028,-74.7073589999999;11.049028,-74.7079169999999;11.0493080000001,-74.7079169999999;11.0493060000001,-74.7087469999999;11.0495840000002,-74.7087469999999;11.0495840000002,-74.7093049999999;11.0498620000001,-74.7093049999999;11.0498620000001,-74.709861;11.050138,-74.709861;11.050138,-74.7104199999999;11.050418,-74.7104199999999;11.050418,-74.710976;11.050694,-74.710976;11.050694,-74.7115249999999;11.0509740000001,-74.7115249999999;11.0509720000001,-74.71180800000001;11.0512500000002,-74.71180800000001;11.0512500000002,-74.71236399999999;11.0515280000001,-74.71236399999999;11.0515280000001,-74.71263999999999;11.0518059999999,-74.71263999999999;11.0518059999999,-74.713196;11.052084,-74.713196;11.052084,-74.713472;11.0523620000001,-74.713472;11.0523620000001,-74.714028;11.0526400000001,-74.714028;11.0526400000001,-74.71430099999991;11.0529160000002,-74.71430099999991;11.0529160000002,-74.71486;11.0531940000001,-74.71486;11.0531940000001,-74.715142;11.0534719999999,-74.715142;11.0534719999999,-74.71597199999999;11.05375,-74.71597199999999;11.05375,-74.716804;11.0540280000001,-74.716804;11.0540280000001,-74.717636;11.0543060000001,-74.717636;11.0543060000001,-74.718194;11.0545840000001,-74.718194;11.0545840000001,-74.71902400000001;11.0548620000001,-74.71902400000001;11.0548600000001,-74.719865;11.0551379999999,-74.719865;11.0551379999999,-74.720696;11.055418,-74.720696;11.055416,-74.724029;11.0556940000001,-74.724029;11.0556940000001,-74.7245869999999;11.0559720000001,-74.7245869999999;11.0559720000001,-74.72513600000001;11.0562500000001,-74.72513600000001;11.0562500000001,-74.7254189999999;11.0565280000001,-74.7254189999999;11.0565280000001,-74.72597499999991;11.0568059999999,-74.72597499999991;11.0568059999999,-74.726524;11.057084,-74.726524;11.057082,-74.7270799999999;11.0573600000001,-74.7270799999999;11.0573600000001,-74.7273629999999;11.05764,-74.7273629999999;11.0576380000001,-74.7279119999999;11.0579160000001,-74.7279119999999;11.0579160000001,-74.728471;11.0581940000001,-74.728471;11.0581940000001,-74.729027;11.0584719999999,-74.729027;11.0584719999999,-74.7293089999999;11.05875,-74.7293089999999;11.05875,-74.72985900000001;11.0590280000001,-74.72985900000001;11.0590280000001,-74.73041499999989;11.0593040000001,-74.73041499999989;11.0593040000001,-74.73097299999991;11.059585,-74.73097299999991;11.059585,-74.7315289999999;11.0598600000001,-74.7315289999999;11.0598600000001,-74.73180499999999;11.0601379999999,-74.73180499999999;11.0601379999999,-74.7323609999999;11.060416,-74.7323609999999;11.060416,-74.7329169999999;11.060695,-74.7329169999999;11.060695,-74.7334759999999;11.0609729999999,-74.7334759999999;11.0609729999999,-74.7337489999999;11.061251,-74.7337489999999;11.061251,-74.7343069999999;11.0615290000001,-74.7343069999999;11.0615290000001,-74.7348639999999;11.061807,-74.7348639999999;11.061807,-74.73569499999989;11.0620830000001,-74.73569499999989;11.0620830000001,-74.73625199999989;11.062363,-74.73625199999989;11.062361,-74.7370829999999;11.0626389999999,-74.7370829999999;11.0626389999999,-74.7376399999999;11.062917,-74.7376399999999;11.062917,-74.73847099999991;11.0631950000001,-74.73847099999991;11.0631950000001,-74.7390299999999;11.063473,-74.7390299999999;11.063473,-74.7398589999999;11.0637510000001,-74.7398589999999;11.0637510000001,-74.74041799999991;11.064029,-74.74041799999991;11.064029,-74.74124999999989;11.0643049999999,-74.74124999999989;11.0643049999999,-74.7418059999999;11.064585,-74.7418059999999;11.064583,-74.7426379999999;11.0648610000001,-74.7426379999999;11.0648610000001,-74.744584;11.065139,-74.744584;11.065139,-74.74485799999989;11.0654170000001,-74.74485799999989;11.0654170000001,-74.7454139999999;11.065695,-74.7454139999999;11.065695,-74.7456959999999;11.0659730000001,-74.7456959999999;11.0659730000001,-74.7459719999999;11.066249,-74.7459719999999;11.066249,-74.7462459999999;11.0665270000001,-74.7462459999999;11.0665270000001,-74.7468039999999;11.066807,-74.7468039999999;11.066805,-74.74708699999999;11.0670830000001,-74.74708699999999;11.0670830000001,-74.747483;11.0670830000001,-74.747643;11.067363,-74.747643;11.067361,-74.748475;11.0676390000001,-74.748475;11.0676390000001,-74.7495799999999;11.067919,-74.7495799999999;11.067917,-74.75041899999999;11.0681950000001,-74.75041899999999;11.0681950000001,-74.7515259999999;11.068473,-74.7515259999999;11.068471,-74.7523579999999;11.0687510000001,-74.7523579999999;11.0687510000001,-74.75346999999989;11.069029,-74.75346999999989;11.069027,-74.754104;11.069027,-74.7543019999999;11.0693050000001,-74.7543019999999;11.0693050000001,-74.75486099999991;11.069583,-74.75486099999991;11.069583,-74.75541699999999;11.0698610000001,-74.75541699999999;11.0698610000001,-74.755973;11.070139,-74.755973;11.070139,-74.7565309999999;11.0704170000001,-74.7565309999999;11.0704170000001,-74.756805;11.070695,-74.756805;11.070693,-74.7573629999999;11.0709730000001,-74.7573629999999;11.0709730000001,-74.757919;11.071251,-74.757919;11.071249,-74.75846899999991;11.0715270000001,-74.75846899999991;11.0715270000001,-74.7590249999999;11.0718080000001,-74.7590249999999;11.071805,-74.75958300000001;11.0720830000001,-74.75958300000001;11.0720830000001,-74.760139;11.072361,-74.760139;11.072361,-74.7606949999999;11.0726390000001,-74.7606949999999;11.0726390000001,-74.760971;11.0729180000001,-74.760971;11.0729180000001,-74.7615269999999;11.073196,-74.7615269999999;11.073196,-74.762086;11.0734740000001,-74.762086;11.073471,-74.7626419999999;11.0737490000001,-74.7626419999999;11.0737490000001,-74.76319099999991;11.0740300000001,-74.76319099999991;11.074027,-74.76402999999991;11.074306,-74.76402999999991;11.074306,-74.76486199999989;11.0745840000001,-74.76486199999989;11.0745840000001,-74.7656929999999;11.074862,-74.7656929999999;11.074862,-74.765924;11.074862,-74.7665249999999;11.074957,-74.7665249999999;11.0751400000001,-74.7665249999999;11.0751400000001,-74.7673639999999;11.0754150000001,-74.7673639999999;11.0754150000001,-74.7681959999999;11.0756960000001,-74.7681959999999;11.0756940000001,-74.76902799999991;11.075972,-74.76902799999991;11.075972,-74.7698599999999;11.0762520000001,-74.7698599999999;11.0762500000001,-74.7706919999999;11.076528,-74.7706919999999;11.076528,-74.7715299999999;11.0768060000001,-74.7715299999999;11.0768060000001,-74.7723619999999;11.077084,-74.7723619999999;11.077084,-74.7731939999999;11.0773620000001,-74.7731939999999;11.0773620000001,-74.77375000000001;11.077638,-74.77375000000001;11.077638,-74.774582;11.0779180000001,-74.774582;11.0779180000001,-74.775414;11.078194,-74.775414;11.078194,-74.7776409999999;11.0779180000001,-74.7776409999999;11.0779180000001,-74.77847299999991;11.078194,-74.77847299999991;11.078194,-74.779031;11.0783690000001,-74.779031;11.0784720000001,-74.779031;11.0784720000001,-74.77934999999989;11.0784720000001,-74.77958699999991;11.07875,-74.77958699999991;11.07875,-74.7798609999999;11.07903,-74.7798609999999;11.0790280000001,-74.7804189999999;11.079306,-74.7804189999999;11.079306,-74.7809749999999;11.0795840000001,-74.7809749999999;11.0795840000001,-74.78152399999991;11.07986,-74.78152399999991;11.07986,-74.7820829999999;11.0801400000001,-74.7820829999999;11.0801400000001,-74.7826389999999;11.080416,-74.7826389999999;11.080416,-74.782912;11.0806940000001,-74.782912;11.0806940000001,-74.78347099999991;11.080972,-74.78347099999991;11.080972,-74.784027;11.0812500000001,-74.784027;11.0812500000001,-74.7859729999999;11.081528,-74.7859729999999;11.081528,-74.787361;11.0818060000001,-74.787361;11.0818060000001,-74.7876349999999;11.082084,-74.7876349999999;11.082084,-74.7884759999999;11.082362,-74.7884759999999;11.082362,-74.789025;11.082638,-74.789025;11.082638,-74.78986399999999;11.0829160000001,-74.78986399999999;11.0829160000001,-74.7904129999999;11.0831960000002,-74.7904129999999;11.083194,-74.791252;11.0834720000001,-74.791252;11.0834720000001,-74.79235900000001;11.08375,-74.79235900000001;11.08375,-74.7937469999999;11.084028,-74.7937469999999;11.084028,-74.794862;11.084306,-74.794862;11.084306,-74.7959739999999;11.0845820000001,-74.7959739999999;11.0845820000001,-74.79763799999991;11.0848620000002,-74.79763799999991;11.08486,-74.79856100000001;11.08486,-74.7993079999999;11.0851380000001,-74.7993079999999;11.0851380000001,-74.800696;11.0854190000001,-74.800696;11.0854190000001,-74.80347499999991;11.0851380000001,-74.80347499999991;11.0851380000001,-74.8054209999999;11.0854190000001,-74.8054209999999;11.085416,-74.8062509999999;11.085694,-74.8062509999999;11.085694,-74.8068089999999;11.085972,-74.8068089999999;11.085972,-74.8076409999999;11.0862500000001,-74.8076409999999;11.0862850000001,-74.80847299999991;11.086531,-74.80847299999991;11.086529,-74.8093019999999;11.0868040000001,-74.8093019999999;11.0868040000001,-74.810143;11.087082,-74.810143;11.087082,-74.810693;11.08736,-74.810693;11.08736,-74.8110889999999;11.08736,-74.8115309999999;11.087638,-74.8115309999999;11.087638,-74.81236299999991;11.0879169999999,-74.81236299999991;11.0879169999999,-74.81291899999989;11.088195,-74.81291899999989;11.088195,-74.8134689999999;11.0884730000001,-74.8134689999999;11.0884730000001,-74.814025;11.0887510000001,-74.814025;11.0887510000001,-74.8145829999999;11.089026,-74.8145829999999;11.089026,-74.8151389999999;11.0893070000001,-74.8151389999999;11.0893070000001,-74.8156979999999;11.0895829999999,-74.8156979999999;11.0895829999999,-74.81652699999999;11.089863,-74.81652699999999;11.089861,-74.8170859999999;11.0901390000001,-74.8170859999999;11.0901390000001,-74.81764200000001;11.0904170000001,-74.81764200000001;11.0904170000001,-74.818191;11.0906950000002,-74.818191;11.0906950000002,-74.8187489999999;11.0909730000001,-74.8187489999999;11.0909730000001,-74.819306;11.0912509999999,-74.819306;11.0912509999999,-74.8198619999999;11.091529,-74.8198619999999;11.091529,-74.8204199999999;11.0918050000001,-74.8204199999999;11.0918050000001,-74.8206939999999;11.0920850000001,-74.8206939999999;11.0920830000001,-74.8212519999999;11.0923610000002,-74.8212519999999;11.0923610000002,-74.82152499999999;11.0926390000001,-74.82152499999999;11.0926390000001,-74.8220819999999;11.0929169999999,-74.8220819999999;11.0929169999999,-74.82236399999989;11.093195,-74.82236399999989;11.093195,-74.8229129999999;11.0934730000001,-74.8229129999999;11.0934730000001,-74.823472;11.0937510000001,-74.823472;11.0937510000001,-74.82375399999999;11.0940270000002,-74.82375399999999;11.0940270000002,-74.824304;11.094307,-74.824304;11.0943050000001,-74.8245839999999;11.0945829999999,-74.8245839999999;11.0945829999999,-74.825142;11.094861,-74.825142;11.094861,-74.82541599999991;11.0951390000001,-74.82541599999991;11.0951390000001,-74.825974;11.0954170000001,-74.825974;11.0954170000001,-74.82624799999989;11.0956950000001,-74.82624799999989;11.0956950000001,-74.82680600000001;11.095973,-74.82680600000001;11.0959710000001,-74.82736199999989;11.0962489999999,-74.82736199999989;11.0962489999999,-74.829309;11.096529,-74.829309;11.096527,-74.8298649999999;11.0968050000001,-74.8298649999999;11.0968050000001,-74.83013800000001;11.0970830000001,-74.83013800000001;11.0970830000001,-74.83041399999991;11.0973610000001,-74.83041399999991;11.0973610000001,-74.830697;11.097639,-74.830697;11.097639,-74.83096999999999;11.0979169999999,-74.83096999999999;11.0979169999999,-74.8312529999999;11.098195,-74.8312529999999;11.098195,-74.833473;11.0979169999999,-74.833473;11.0979169999999,-74.8354189999999;11.098195,-74.8354189999999;11.098193,-74.83625099999991;11.0984730000001,-74.83625099999991;11.0984730000001,-74.83708300000001;11.0987520000001,-74.83708300000001;11.0987490000001,-74.8379119999999;11.0990270000001,-74.8379119999999;11.0990270000001,-74.8387529999999;11.099305,-74.8387529999999;11.099305,-74.839303;11.0995829999999,-74.839303;11.0995829999999,-74.8395849999999;11.099861,-74.8395849999999;11.099861,-74.840141;11.10014,-74.840141;11.10014,-74.84041499999999;11.1004180000001,-74.84041499999999;11.1004180000001,-74.84097300000001;11.100696,-74.84097300000001;11.100696,-74.841247;11.100971,-74.841247;11.100971,-74.84180499999999;11.1012489999999,-74.84180499999999;11.1012489999999,-74.842088;11.1015280000001,-74.842088;11.1015280000001,-74.842637;11.101806,-74.842637;11.101806,-74.8429169999999;11.1020840000001,-74.8429169999999;11.1020840000001,-74.8431929999999;11.102362,-74.8431929999999;11.102362,-74.8434759999999;11.1026400000001,-74.8434759999999;11.1026400000001,-74.8437489999999;11.1031940000001,-74.8437489999999;11.1031940000001,-74.844025;11.103472,-74.844025;11.103472,-74.844308;11.1037500000001,-74.844308;11.1037500000001,-74.84458099999991;11.104028,-74.84458099999991;11.104028,-74.8448639999999;11.1043060000001,-74.8448639999999;11.1043060000001,-74.84514;11.1048620000001,-74.84514;11.1048620000001,-74.84541299999999;11.10514,-74.84541299999999;11.105138,-74.8456959999999;11.1054160000001,-74.8456959999999;11.1054160000001,-74.845969;11.105694,-74.845969;11.105694,-74.84625199999989;11.1059720000001,-74.84625199999989;11.1059720000001,-74.84652799999991;11.1065280000001,-74.84652799999991;11.1065280000001,-74.846801;11.106808,-74.846801;11.106806,-74.8470839999999;11.1070840000001,-74.8470839999999;11.1070840000001,-74.8473589999999;11.1076400000001,-74.8473589999999;11.1076400000001,-74.84764199999989;11.107918,-74.84764199999989;', 9, NULL),
(5, 1, NULL, 'Bolívar', '8.71291', '-74.5145', '10.801527,-75.26061900000001;10.801529,-75.26097;10.8012510000001,-75.26097;10.8012510000001,-75.261253;10.800971,-75.261253;10.800971,-75.2615289999999;10.800417,-75.2615289999999;10.800417,-75.261672;10.800417,-75.261802;10.799943,-75.261802;10.797639,-75.261802;10.797639,-75.262085;10.797083,-75.262085;10.797083,-75.2623599999999;10.796527,-75.2623599999999;10.796527,-75.2626429999999;10.7956950000001,-75.2626429999999;10.7956950000001,-75.2623599999999;10.7951390000001,-75.2623599999999;10.7951390000001,-75.2626429999999;10.794307,-75.2626429999999;10.794307,-75.262916;10.7940270000001,-75.262916;10.7940270000001,-75.2631919999999;10.792085,-75.2631919999999;10.792085,-75.26347299999991;10.7887499999999,-75.26347299999991;10.7887499999999,-75.26374800000001;10.7884720000001,-75.26374800000001;10.7884720000001,-75.2640309999999;10.7881940000001,-75.2640309999999;10.7881940000001,-75.2643039999999;10.7879160000001,-75.2643039999999;10.7879160000001,-75.26458;10.78736,-75.26458;10.78736,-75.265136;10.7870839999999,-75.265136;10.7870839999999,-75.26552599999999;10.7870839999999,-75.26569499999989;10.7868560000001,-75.26569499999989;10.7865280000001,-75.26569499999989;10.7865280000001,-75.2659749999999;10.7862500000001,-75.2659749999999;10.7862500000001,-75.2661439999999;10.7862500000001,-75.266251;10.7861110000001,-75.266251;10.785972,-75.266251;10.785972,-75.26652399999991;10.7857420000001,-75.26652399999991;10.785416,-75.26652399999991;10.785416,-75.2668069999999;10.7831940000002,-75.2668069999999;10.7831940000002,-75.267083;10.782638,-75.267083;10.782638,-75.267365;10.782362,-75.267365;10.782362,-75.2676389999999;10.782084,-75.2676389999999;10.782084,-75.267915;10.7815280000002,-75.267915;10.7815280000002,-75.26819499999991;10.7812500000001,-75.26819499999991;10.7812520000001,-75.2690269999999;10.780972,-75.2690269999999;10.780972,-75.2698589999999;10.7806940000001,-75.2698589999999;10.780696,-75.2701409999999;10.780416,-75.2701409999999;10.780416,-75.2706909999999;10.7801400000001,-75.2706909999999;10.7801400000001,-75.2709729999999;10.7795840000001,-75.2709729999999;10.7795840000001,-75.271247;10.7784740000001,-75.271247;10.7784740000001,-75.2709729999999;10.77764,-75.2709729999999;10.77764,-75.2706909999999;10.7770830000001,-75.2706909999999;10.7770830000001,-75.270417;10.776805,-75.270417;10.7768080000001,-75.2706909999999;10.7748610000001,-75.2706909999999;10.7748610000001,-75.2709729999999;10.773471,-75.2709729999999;10.773473,-75.271247;10.770139,-75.271247;10.770139,-75.2709729999999;10.7681950000001,-75.2709729999999;10.7681950000001,-75.2706909999999;10.7676390000001,-75.2706909999999;10.7676390000001,-75.270417;10.765695,-75.270417;10.765695,-75.2701409999999;10.764304,-75.2701409999999;10.7643070000001,-75.2698589999999;10.7634720000001,-75.2698589999999;10.7634720000001,-75.26930299999989;10.761528,-75.26930299999989;10.761528,-75.2690269999999;10.760972,-75.2690269999999;10.760972,-75.2687529999999;10.75875,-75.2687529999999;10.75875,-75.26847099999991;10.754306,-75.26847099999991;10.754306,-75.26819499999991;10.75264,-75.26819499999991;10.75264,-75.267915;10.750139,-75.267915;10.750139,-75.26819499999991;10.749583,-75.26819499999991;10.749583,-75.26847099999991;10.7487490000001,-75.26847099999991;10.748752,-75.2687529999999;10.748195,-75.2687529999999;10.748195,-75.2690269999999;10.747639,-75.2690269999999;10.747639,-75.26930299999989;10.746527,-75.26930299999989;10.746527,-75.26958499999991;10.742639,-75.26958499999991;10.742639,-75.26930299999989;10.7406950000001,-75.26930299999989;10.7406950000001,-75.2690269999999;10.7401410000001,-75.2690269999999;10.7401410000001,-75.2687529999999;10.7393040000001,-75.2687529999999;10.7393040000001,-75.26847099999991;10.7387510000001,-75.26847099999991;10.7387510000001,-75.26819499999991;10.737916,-75.26819499999991;10.7379190000001,-75.267915;10.7368070000001,-75.267915;10.7368070000001,-75.2676389999999;10.7359720000001,-75.2676389999999;10.7359720000001,-75.267365;10.735138,-75.267365;10.7351410000001,-75.2676389999999;10.734584,-75.2676389999999;10.734584,-75.26819499999991;10.7343060000001,-75.26819499999991;10.7343060000001,-75.26847099999991;10.734028,-75.26847099999991;10.734028,-75.2687529999999;10.7337500000001,-75.2687529999999;10.7337500000001,-75.2690269999999;10.7331940000001,-75.2690269999999;10.7331940000001,-75.26930299999989;10.732916,-75.26930299999989;10.732918,-75.26958499999991;10.7326400000001,-75.26958499999991;10.7326400000001,-75.2701409999999;10.73236,-75.2701409999999;10.732362,-75.2706909999999;10.7320840000001,-75.2706909999999;10.7320840000001,-75.2709729999999;10.731806,-75.2709729999999;10.731808,-75.271247;10.7315280000001,-75.271247;10.7315280000001,-75.271529;10.73125,-75.271529;10.731252,-75.2718049999999;10.730694,-75.2718049999999;10.730694,-75.2720879999999;10.7304160000001,-75.2720879999999;10.7304160000001,-75.2723609999999;10.730138,-75.2723609999999;10.730138,-75.2729199999999;10.7298620000001,-75.2729199999999;10.7298620000001,-75.273749;10.729028,-75.273749;10.729028,-75.2740249999999;10.728472,-75.2740249999999;10.728472,-75.27430799999991;10.727918,-75.27430799999991;10.727918,-75.274581;10.7270840000001,-75.274581;10.7270840000001,-75.27486399999999;10.726806,-75.27486399999999;10.726806,-75.27513999999989;10.72625,-75.27513999999989;10.72625,-75.275413;10.72514,-75.275413;10.72514,-75.27513999999989;10.724305,-75.27513999999989;10.724305,-75.27486399999999;10.722918,-75.27486399999999;10.722918,-75.274581;10.7223610000001,-75.274581;10.7223610000001,-75.27430799999991;10.720971,-75.27430799999991;10.720973,-75.2740249999999;10.7190270000002,-75.2740249999999;10.7190270000002,-75.273749;10.7187490000001,-75.273749;10.7187510000001,-75.2734759999999;10.7179170000001,-75.2734759999999;10.7179170000001,-75.273749;10.717639,-75.273749;10.717639,-75.27430799999991;10.7170830000001,-75.27430799999991;10.7170830000001,-75.2740249999999;10.715973,-75.2740249999999;10.715973,-75.27430799999991;10.7151390000001,-75.27430799999991;10.7151390000001,-75.274581;10.714861,-75.274581;10.714861,-75.27486399999999;10.7145829999999,-75.27486399999999;10.7145829999999,-75.275413;10.714307,-75.275413;10.714307,-75.275696;10.7140270000002,-75.275696;10.7140270000002,-75.2759709999999;10.7137510000001,-75.2759709999999;10.7137510000001,-75.2762519999999;10.7134730000001,-75.2762519999999;10.7134730000001,-75.276527;10.713195,-75.276527;10.713195,-75.27680099999991;10.7129169999999,-75.27680099999991;10.7129169999999,-75.2770839999999;10.712639,-75.2770839999999;10.712639,-75.27791499999989;10.7123610000002,-75.27791499999989;10.7123610000002,-75.278198;10.712082,-75.278198;10.712082,-75.278747;10.7118040000001,-75.278747;10.7118040000001,-75.2793029999999;10.711529,-75.2793029999999;10.711529,-75.2795859999999;10.7112509999999,-75.2795859999999;10.7112509999999,-75.27986199999999;10.710973,-75.27986199999999;10.710973,-75.2801349999999;10.710694,-75.2801349999999;10.710694,-75.280976;10.710416,-75.280976;10.7104190000001,-75.2812499999999;10.709863,-75.2812499999999;10.709863,-75.281526;10.7095820000001,-75.281526;10.7095820000001,-75.2818059999999;10.709028,-75.2818059999999;10.709028,-75.2820819999999;10.7084720000001,-75.2820819999999;10.7084720000001,-75.282364;10.708194,-75.282364;10.708197,-75.28263799999991;10.7079160000001,-75.28263799999991;10.7079160000001,-75.2834699999999;10.7076380000001,-75.2834699999999;10.7076380000001,-75.28402800000001;10.7073600000001,-75.28402800000001;10.7073600000001,-75.284858;10.707084,-75.284858;10.707084,-75.2854159999999;10.7068060000001,-75.2854159999999;10.7068060000001,-75.28569899999999;10.706528,-75.28569899999999;10.706528,-75.2862479999999;10.7062500000001,-75.2862479999999;10.7062500000001,-75.2868039999999;10.7059720000001,-75.2868039999999;10.7059720000001,-75.2870869999999;10.7056940000001,-75.2870869999999;10.7056940000001,-75.28763599999991;10.705416,-75.28763599999991;10.705416,-75.289863;10.7051400000001,-75.289863;10.7051400000001,-75.290138;10.70486,-75.290138;10.70486,-75.2904119999999;10.7045840000001,-75.2904119999999;10.7045840000001,-75.290695;10.7043060000001,-75.290695;10.7043060000001,-75.2909699999999;10.70375,-75.2909699999999;10.70375,-75.2926409999999;10.7034720000001,-75.2926409999999;10.7034720000001,-75.2929139999999;10.703194,-75.2929139999999;10.703194,-75.29319700000001;10.7029180000001,-75.29319700000001;10.7029180000001,-75.29347299999991;10.703194,-75.29347299999991;10.703194,-75.2937459999999;10.7029180000001,-75.2937459999999;10.7029180000001,-75.2954169999999;10.702638,-75.2954169999999;10.702638,-75.295693;10.7023620000001,-75.295693;10.7023620000001,-75.296525;10.702084,-75.296525;10.702084,-75.297363;10.7018060000001,-75.297363;10.7018060000001,-75.297637;10.701528,-75.297637;10.701528,-75.29791899999989;10.700972,-75.29791899999989;10.700972,-75.29819500000001;10.7006940000001,-75.29819500000001;10.7006960000001,-75.2987509999999;10.700416,-75.2987509999999;10.700416,-75.2995829999999;10.7001400000001,-75.2995829999999;10.7001400000001,-75.3001389999999;10.699862,-75.3001389999999;10.699862,-75.3004149999999;10.6995840000001,-75.3004149999999;10.6995840000001,-75.3006979999999;10.699306,-75.3006979999999;10.699306,-75.30153;10.6995840000001,-75.30153;10.6995840000001,-75.30180300000001;10.699306,-75.30180300000001;10.699306,-75.30291799999991;10.6990280000001,-75.30291799999991;10.6990300000001,-75.3037489999999;10.69875,-75.3037489999999;10.69875,-75.3043059999999;10.698471,-75.3043059999999;10.6984740000001,-75.3045809999999;10.6981930000001,-75.3045809999999;10.6981930000001,-75.3051369999999;10.6979180000001,-75.3051369999999;10.6979180000001,-75.305694;10.69764,-75.305694;10.69764,-75.30652499999999;10.6973620000001,-75.30652499999999;10.6973620000001,-75.3081959999999;10.6970830000001,-75.3081959999999;10.6970830000001,-75.3084719999999;10.696805,-75.3084719999999;10.6968080000001,-75.3090279999999;10.6965270000001,-75.3090279999999;10.6965270000001,-75.310974;10.696249,-75.310974;10.6962520000001,-75.311806;10.695974,-75.311806;10.695974,-75.312921;10.695693,-75.312921;10.6956960000001,-75.3140259999999;10.6954170000001,-75.3140259999999;10.6954170000001,-75.3145819999999;10.6956960000001,-75.3145819999999;10.6956960000001,-75.315141;10.6954170000001,-75.315141;10.6954170000001,-75.3156969999999;10.695139,-75.3156969999999;10.695139,-75.315972;10.6948610000001,-75.315972;10.6948610000001,-75.316253;10.694583,-75.316253;10.694583,-75.3168019999999;10.6943050000001,-75.3168019999999;10.6943050000001,-75.3179169999999;10.694583,-75.3179169999999;10.694583,-75.318473;10.6943050000001,-75.318473;10.6943050000001,-75.3190309999999;10.694027,-75.3190309999999;10.694029,-75.319305;10.6937510000001,-75.319305;10.6937510000001,-75.3195799999999;10.693471,-75.3195799999999;10.693473,-75.3206949999999;10.6931950000001,-75.3206949999999;10.6931950000001,-75.321251;10.693473,-75.321251;10.693473,-75.3215239999999;10.6931950000001,-75.3215239999999;10.6931950000001,-75.32208299999991;10.692917,-75.32208299999991;10.6929200000001,-75.324303;10.6926390000001,-75.324303;10.6926390000001,-75.325141;10.692361,-75.325141;10.692363,-75.32652899999989;10.6920830000001,-75.32652899999989;10.6920830000001,-75.329308;10.691805,-75.329308;10.691807,-75.3323589999999;10.6915270000001,-75.3323589999999;10.6915270000001,-75.33513499999999;10.691249,-75.33513499999999;10.691249,-75.3354499999999;10.691249,-75.33736399999989;10.6909730000001,-75.33736399999989;10.6909730000001,-75.3415309999999;10.690695,-75.3415309999999;10.690697,-75.3451389999999;10.6904170000001,-75.3451389999999;10.6904170000001,-75.3510279999999;10.6904170000001,-75.35346899999991;10.690139,-75.35346899999991;10.690139,-75.35458299999991;10.6898610000001,-75.35458299999991;10.6898610000001,-75.3559709999999;10.689583,-75.3559709999999;10.689583,-75.357086;10.6893050000001,-75.357086;10.6893050000001,-75.3584739999999;10.689027,-75.3584739999999;10.689029,-75.35958099999991;10.6887510000001,-75.35958099999991;10.6887510000001,-75.360024;10.6887510000001,-75.3609689999999;10.688578,-75.3609689999999;10.688473,-75.3609689999999;10.688473,-75.3615259999999;10.688473,-75.3623569999999;10.6883180000002,-75.3623569999999;10.6881950000001,-75.3623569999999;10.6881950000001,-75.362916;10.687917,-75.362916;10.687917,-75.363196;10.6876390000001,-75.363196;10.6876390000001,-75.363748;10.687361,-75.363748;10.687363,-75.36430399999991;10.6870830000001,-75.36430399999991;10.6870830000001,-75.3659739999999;10.686805,-75.3659739999999;10.686805,-75.3676379999999;10.6865290000001,-75.3676379999999;10.6865290000001,-75.36902600000001;10.686251,-75.36902600000001;10.686251,-75.37069700000001;10.6859730000001,-75.37069700000001;10.6859730000001,-75.372085;10.685695,-75.372085;10.685695,-75.373749;10.6854170000001,-75.373749;10.6854170000001,-75.3751369999999;10.685139,-75.3751369999999;10.685139,-75.3768069999999;10.68486,-75.3768069999999;10.68486,-75.3781969999999;10.684585,-75.3781969999999;10.684585,-75.379859;10.6843040000001,-75.379859;10.6843040000001,-75.381249;10.684029,-75.381249;10.684029,-75.3826369999999;10.6837510000001,-75.3826369999999;10.6837510000001,-75.38402499999999;10.683473,-75.38402499999999;10.683473,-75.3856959999999;10.683194,-75.3856959999999;10.683194,-75.3870859999999;10.6829160000001,-75.3870859999999;10.6829160000001,-75.38930599999991;10.6826380000001,-75.38930599999991;10.6826380000001,-75.39153999999991;10.6826380000001,-75.39346999999989;10.6829160000001,-75.39346999999989;10.6829160000001,-75.3937529999999;10.683194,-75.3937529999999;10.683194,-75.3943019999999;10.6829160000001,-75.3943019999999;10.6829160000001,-75.3945839999999;10.6823600000001,-75.3945839999999;10.6823600000001,-75.3948599999999;10.682082,-75.3948599999999;10.6820850000001,-75.395141;10.6818060000001,-75.395141;10.6818060000001,-75.3954159999999;10.6806940000001,-75.3954159999999;10.6806940000001,-75.395141;10.680416,-75.395141;10.680418,-75.3948599999999;10.6801379999999,-75.3948599999999;10.6801379999999,-75.395141;10.678194,-75.395141;10.678194,-75.3954159999999;10.677064,-75.3954159999999;10.675418,-75.3954159999999;10.675418,-75.3956899999999;10.6729160000002,-75.3956899999999;10.6729160000002,-75.395972;10.6701399999999,-75.395972;10.6701399999999,-75.3962479999999;10.6690270000001,-75.3962479999999;10.6690270000001,-75.395972;10.6681950000001,-75.395972;10.6681950000001,-75.3962479999999;10.666527,-75.3962479999999;10.666527,-75.396531;10.665417,-75.396531;10.665417,-75.3968039999999;10.664861,-75.3968039999999;10.664861,-75.3970869999999;10.6640290000001,-75.3970869999999;10.6640290000001,-75.397363;10.6634730000001,-75.397363;10.6634730000001,-75.39763599999991;10.662639,-75.39763599999991;10.662639,-75.3979189999999;10.662083,-75.3979189999999;10.662083,-75.3981919999999;10.661527,-75.3981919999999;10.661527,-75.39847500000001;10.661251,-75.39847500000001;10.661251,-75.39875099999991;10.660973,-75.39875099999991;10.660973,-75.3990239999999;10.660417,-75.3990239999999;10.660417,-75.39930699999999;10.6601390000001,-75.39930699999999;10.6601410000001,-75.39958299999989;10.659861,-75.39958299999989;10.659861,-75.39986500000001;10.6595830000001,-75.39986500000001;10.659585,-75.400139;10.659305,-75.400139;10.659305,-75.4004139999999;10.658751,-75.4004139999999;10.658751,-75.400695;10.6584730000001,-75.400695;10.6584730000001,-75.400971;10.658195,-75.400971;10.658195,-75.4012529999999;10.6579170000001,-75.4012529999999;10.657919,-75.401527;10.6576380000001,-75.401527;10.6576380000001,-75.4018019999999;10.65736,-75.4018019999999;10.6573630000001,-75.402359;10.6570820000001,-75.402359;10.6570820000001,-75.402641;10.6568070000001,-75.402641;10.6568070000001,-75.4029169999999;10.656529,-75.4029169999999;10.656529,-75.40319700000001;10.6562510000001,-75.40319700000001;10.6562510000001,-75.40347300000001;10.6559720000001,-75.40347300000001;10.6559720000001,-75.4037469999999;10.655694,-75.4037469999999;10.655694,-75.40430499999999;10.6554160000001,-75.40430499999999;10.6554160000001,-75.4045879999999;10.655138,-75.4045879999999;10.6551410000001,-75.404861;10.654863,-75.404861;10.654863,-75.4062489999999;10.6543060000001,-75.4062489999999;10.6543060000001,-75.406525;10.654028,-75.406525;10.654028,-75.406807;10.6537500000001,-75.406807;10.6537500000001,-75.407364;10.653472,-75.407364;10.653472,-75.40791299999989;10.6531940000001,-75.40791299999989;10.6531940000001,-75.40819500000001;10.652916,-75.40819500000001;10.652918,-75.40875199999989;10.6526380000001,-75.40875199999989;10.6526380000001,-75.409027;10.65236,-75.409027;10.65236,-75.4120859999999;10.6526380000001,-75.4120859999999;10.6526380000001,-75.412362;10.652918,-75.412362;10.652918,-75.413194;10.653472,-75.413194;10.653472,-75.41374999999989;10.6531940000001,-75.41374999999989;10.6531940000001,-75.414025;10.652916,-75.414025;10.652918,-75.414306;10.6526380000001,-75.414306;10.6526380000001,-75.4145819999999;10.65236,-75.4145819999999;10.652362,-75.4148639999999;10.6520840000001,-75.4148639999999;10.6520840000001,-75.415138;10.651806,-75.415138;10.651808,-75.4154129999999;10.6515280000001,-75.4154129999999;10.6515280000001,-75.4156959999999;10.650694,-75.4156959999999;10.650694,-75.41597;10.649582,-75.41597;10.649582,-75.4162519999999;10.6481940000001,-75.4162519999999;10.6481940000001,-75.41652600000001;10.647362,-75.41652600000001;10.647362,-75.4168079999999;10.6468030000001,-75.4168079999999;10.646806,-75.4170839999999;10.64625,-75.4170839999999;10.64625,-75.41735799999999;10.6459720000001,-75.41735799999999;10.6459720000001,-75.41763999999991;10.645696,-75.41763999999991;10.645696,-75.41791599999991;10.645415,-75.41791599999991;10.645415,-75.41847199999999;10.64514,-75.41847199999999;10.64514,-75.41874799999989;10.6448620000001,-75.41874799999989;10.6448620000001,-75.4190279999999;10.6443060000001,-75.4190279999999;10.6443060000001,-75.419304;10.644028,-75.419304;10.64403,-75.41958699999989;10.643749,-75.41958699999989;10.643749,-75.4198599999999;10.643474,-75.4198599999999;10.643474,-75.420136;10.6431930000001,-75.420136;10.6431930000001,-75.4212499999999;10.642918,-75.4212499999999;10.642918,-75.4218059999999;10.6426400000001,-75.4218059999999;10.6426400000001,-75.42263799999991;10.6423609999999,-75.42263799999991;10.6423609999999,-75.4231939999999;10.642083,-75.4231939999999;10.642083,-75.42375300000001;10.6418050000001,-75.42375300000001;10.6418050000001,-75.42430899999989;10.6415270000001,-75.42430899999989;10.6415300000001,-75.4245819999999;10.6412490000001,-75.4245819999999;10.6412490000001,-75.4251409999999;10.640971,-75.4251409999999;10.640971,-75.4254139999999;10.6406949999999,-75.4254139999999;10.6406949999999,-75.4256969999999;10.640417,-75.4256969999999;10.640417,-75.42624599999991;10.6401390000001,-75.42624599999991;10.6401390000001,-75.4265289999999;10.6398610000001,-75.4265289999999;10.6398610000001,-75.4268049999999;10.6395830000001,-75.4268049999999;10.6395830000001,-75.42736099999991;10.639305,-75.42736099999991;10.639305,-75.427634;10.6390269999999,-75.427634;10.6390269999999,-75.42819299999989;10.6387490000001,-75.42819299999989;10.638751,-75.4287489999999;10.6384730000001,-75.4287489999999;10.6384730000001,-75.4295809999999;10.6381950000001,-75.4295809999999;10.6381950000001,-75.4301369999999;10.6379170000001,-75.4301369999999;10.6379170000001,-75.4306949999999;10.637639,-75.4306949999999;10.637639,-75.4315269999999;10.6373609999999,-75.4315269999999;10.6373609999999,-75.43235899999991;10.6370830000001,-75.43235899999991;10.6370830000001,-75.43319799999991;10.6368050000002,-75.43319799999991;10.6368050000002,-75.4340289999999;10.6365290000001,-75.4340289999999;10.6365290000001,-75.4348609999999;10.6362490000001,-75.4348609999999;10.6362490000001,-75.43569099999991;10.635973,-75.43569099999991;10.635973,-75.436249;10.6356949999999,-75.436249;10.6356949999999,-75.43875199999999;10.6354170000001,-75.43875199999999;10.6354170000001,-75.4390249999999;10.6351390000002,-75.4390249999999;10.6351390000002,-75.439584;10.6348610000001,-75.439584;10.6348610000001,-75.4398569999999;10.6345830000001,-75.4398569999999;10.6345830000001,-75.44041300000001;10.634307,-75.44041300000001;10.634307,-75.4406959999999;10.6340269999999,-75.4406959999999;10.6340269999999,-75.441254;10.6337510000001,-75.441254;10.6337510000001,-75.44152799999991;10.6334730000002,-75.44152799999991;10.6334730000002,-75.44180399999991;10.6331950000001,-75.44180399999991;10.6331950000001,-75.44235999999989;10.6329170000001,-75.44235999999989;10.6329170000001,-75.44264200000001;10.632639,-75.44264200000001;10.632641,-75.4431919999999;10.6323609999999,-75.4431919999999;10.6323609999999,-75.442916;10.6320830000001,-75.442916;10.6320850000001,-75.442086;10.6315290000001,-75.442086;10.6315290000001,-75.44235999999989;10.630973,-75.44235999999989;10.630973,-75.4440299999999;10.6312510000001,-75.4440299999999;10.6312510000001,-75.444306;10.630973,-75.444306;10.630973,-75.44458;10.6306949999999,-75.44458;10.6306949999999,-75.445138;10.630973,-75.445138;10.630973,-75.4456939999999;10.6304190000001,-75.4456939999999;10.6304170000001,-75.44652599999991;10.6306949999999,-75.44652599999991;10.6306949999999,-75.4468089999999;10.6307880000001,-75.4468089999999;10.630973,-75.4468089999999;10.630973,-75.44736499999991;10.6312510000001,-75.44736499999991;10.6312510000001,-75.44764000000001;10.630973,-75.44764000000001;10.630973,-75.44847;10.6306949999999,-75.44847;10.6306949999999,-75.4490279999999;10.62986,-75.4490279999999;10.6298630000001,-75.449302;10.6290260000001,-75.449302;10.6290260000001,-75.4506919999999;10.62875,-75.4506919999999;10.62875,-75.45097299999991;10.628472,-75.45097299999991;10.628472,-75.45124800000001;10.62875,-75.45124800000001;10.62875,-75.4515309999999;10.6290260000001,-75.4515309999999;10.6290260000001,-75.451804;10.62875,-75.451804;10.62875,-75.45208;10.62486,-75.45208;10.624862,-75.45236299999991;10.624306,-75.45236299999991;10.624306,-75.452636;10.62375,-75.452636;10.62375,-75.45208;10.6218060000001,-75.45208;10.6218060000001,-75.45236299999991;10.619306,-75.45236299999991;10.619306,-75.452636;10.61875,-75.452636;10.61875,-75.45291899999999;10.6181930000001,-75.45291899999999;10.6181930000001,-75.45319499999989;10.6179180000001,-75.45319499999989;10.6179180000001,-75.4534749999999;10.61764,-75.4534749999999;10.61764,-75.453751;10.6173620000001,-75.453751;10.6173620000001,-75.45402399999991;10.617084,-75.45402399999991;10.617084,-75.4543069999999;10.6168060000001,-75.4543069999999;10.6168080000001,-75.4548649999999;10.6165270000001,-75.4548649999999;10.6165270000001,-75.455415;10.616249,-75.455415;10.6162520000001,-75.4556969999999;10.615974,-75.4556969999999;10.615974,-75.4551389999999;10.615418,-75.4551389999999;10.615418,-75.454583;10.614027,-75.454583;10.6140300000001,-75.4543069999999;10.612917,-75.4543069999999;10.612917,-75.454583;10.6126390000001,-75.454583;10.6126390000001,-75.4548649999999;10.611805,-75.4548649999999;10.611807,-75.4551389999999;10.6109730000001,-75.4551389999999;10.6109730000001,-75.455415;10.610139,-75.455415;10.610139,-75.4556969999999;10.609027,-75.4556969999999;10.609027,-75.45597099999991;10.607917,-75.45597099999991;10.607919,-75.4562529999999;10.606807,-75.4562529999999;10.606807,-75.4565269999999;10.5970840000001,-75.4565269999999;10.5970840000001,-75.4562529999999;10.5959720000001,-75.4562529999999;10.5959720000001,-75.45597099999991;10.5940280000002,-75.45597099999991;10.5940280000002,-75.4556969999999;10.593818,-75.4556969999999;10.593194,-75.4556969999999;10.593196,-75.45597099999991;10.5920840000001,-75.45597099999991;10.5920840000001,-75.4562529999999;10.59153,-75.4562529999999;10.59153,-75.4565269999999;10.59125,-75.4565269999999;10.59125,-75.45680299999999;10.5909720000001,-75.45680299999999;10.5909740000001,-75.4573589999999;10.5906930000001,-75.4573589999999;10.5906930000001,-75.4576409999999;10.5904180000001,-75.4576409999999;10.5904180000001,-75.457917;10.5901370000001,-75.457917;10.5901370000001,-75.4581909999999;10.589862,-75.4581909999999;10.589862,-75.458749;10.589584,-75.458749;10.589584,-75.4590289999999;10.589305,-75.4590289999999;10.5893080000001,-75.4593049999999;10.5890270000001,-75.4593049999999;10.5890270000001,-75.4595879999999;10.588749,-75.4595879999999;10.5887520000001,-75.4598609999999;10.5884710000001,-75.4598609999999;10.5884710000001,-75.4601369999999;10.588196,-75.4601369999999;10.588196,-75.4604199999999;10.5879170000001,-75.4604199999999;10.5879170000001,-75.4609759999999;10.587639,-75.4609759999999;10.587639,-75.4615249999999;10.5873610000001,-75.4615249999999;10.5873610000001,-75.462081;10.587083,-75.462081;10.587083,-75.462913;10.5868050000001,-75.462913;10.5868050000001,-75.463196;10.5865270000002,-75.463196;10.5865290000002,-75.4634709999999;10.5862510000001,-75.4634709999999;10.5862510000001,-75.4637519999999;10.585971,-75.4637519999999;10.585973,-75.4640269999999;10.5856950000001,-75.4640269999999;10.5856950000001,-75.4645839999999;10.585417,-75.4645839999999;10.585417,-75.4651419999999;10.5851390000001,-75.4651419999999;10.5851390000001,-75.46541499999999;10.5848610000002,-75.46541499999999;10.5848610000002,-75.4659739999999;10.5845830000001,-75.4659739999999;10.5845830000001,-75.46653000000001;10.584305,-75.46653000000001;10.584307,-75.4670859999999;10.5840290000001,-75.4670859999999;10.5840290000001,-75.4679179999999;10.583749,-75.4679179999999;10.583749,-75.4687499999999;10.5834730000001,-75.4687499999999;10.5834730000001,-75.4695819999999;10.5831950000002,-75.4695819999999;10.5831950000002,-75.47013799999991;10.5829170000001,-75.47013799999991;10.5829170000001,-75.47041399999991;10.582639,-75.47041399999991;10.582639,-75.47125199999989;10.5823610000001,-75.47125199999989;10.5823610000001,-75.4718019999999;10.582083,-75.4718019999999;10.582083,-75.4726399999999;10.5818050000001,-75.4726399999999;10.5818050000001,-75.4743039999999;10.581527,-75.4743039999999;10.581527,-75.474587;10.5812510000001,-75.474587;10.5812510000001,-75.47486000000001;10.580973,-75.47486000000001;10.580973,-75.47513599999991;10.5806950000001,-75.47513599999991;10.5806950000001,-75.475692;10.580417,-75.475692;10.580417,-75.47624999999989;10.5801390000001,-75.47624999999989;10.5801390000001,-75.4776379999999;10.579861,-75.4776379999999;10.579861,-75.478195;10.5795830000001,-75.478195;10.5795830000001,-75.4793089999999;10.579305,-75.4793089999999;10.579305,-75.48180499999999;10.5790290000001,-75.48180499999999;10.5790290000001,-75.4826369999999;10.578751,-75.4826369999999;10.578751,-75.482917;10.5784730000001,-75.482917;10.5784730000001,-75.4834749999999;10.578195,-75.4834749999999;10.578195,-75.48541899999989;10.5779170000001,-75.48541899999989;10.5779170000001,-75.48569500000001;10.578195,-75.48569500000001;10.578195,-75.4859689999999;10.5779170000001,-75.4859689999999;10.5779190000001,-75.4876389999999;10.577639,-75.4876389999999;10.577639,-75.48847099999991;10.5773610000001,-75.48847099999991;10.5773630000001,-75.4912489999999;10.5770820000001,-75.4912489999999;10.5770820000001,-75.4918059999999;10.576804,-75.4918059999999;10.5768070000001,-75.4937519999999;10.576529,-75.4937519999999;10.576529,-75.4943079999999;10.5768070000001,-75.4943079999999;10.5768070000001,-75.494857;10.576529,-75.494857;10.576529,-75.495696;10.5762510000001,-75.495696;10.5762510000001,-75.496528;10.576529,-75.496528;10.576529,-75.497642;10.5762510000001,-75.497642;10.5762510000001,-75.50291399999991;10.575973,-75.50291399999991;10.575973,-75.5031969999999;10.575694,-75.5031969999999;10.575694,-75.503472;10.5754160000001,-75.503472;10.5754160000001,-75.5040289999999;10.575138,-75.5040289999999;10.5751410000001,-75.5043019999999;10.574863,-75.5043019999999;10.574863,-75.50597500000001;10.574582,-75.50597500000001;10.5745850000001,-75.5062479999999;10.5743060000001,-75.5062479999999;10.5743060000001,-75.5065309999999;10.574028,-75.5065309999999;10.574028,-75.506805;10.5737500000001,-75.506805;10.5737500000001,-75.5081949999999;10.573472,-75.5081949999999;10.573472,-75.5087509999999;10.5731940000001,-75.5087509999999;10.5731940000001,-75.51069699999989;10.572916,-75.51069699999989;10.572918,-75.5115269999999;10.5726380000001,-75.5115269999999;10.5726380000001,-75.512085;10.57236,-75.512085;10.572362,-75.5123589999999;10.571806,-75.5123589999999;10.571806,-75.512641;10.57125,-75.512641;10.57125,-75.5129169999999;10.5709720000001,-75.5129169999999;10.5709720000001,-75.51319099999991;10.570694,-75.51319099999991;10.570694,-75.51347300000001;10.5704160000001,-75.51347300000001;10.5704160000001,-75.51374899999991;10.570138,-75.51374899999991;10.57014,-75.51402899999989;10.5676400000001,-75.51402899999989;10.5676400000001,-75.51374899999991;10.5654160000001,-75.51374899999991;10.5654160000001,-75.51402899999989;10.564584,-75.51402899999989;10.564584,-75.51430499999999;10.5640280000001,-75.51430499999999;10.5640280000001,-75.5148609999999;10.5637500000001,-75.5148609999999;10.5637500000001,-75.515137;10.563629,-75.515137;10.5634709999999,-75.515137;10.5634709999999,-75.51541999999991;10.5631930000001,-75.51541999999991;10.5631930000001,-75.5156929999999;10.5615270000001,-75.5156929999999;10.5615270000001,-75.515976;10.5609710000001,-75.515976;10.5609710000001,-75.5156929999999;10.5606950000001,-75.5156929999999;10.5606950000001,-75.51541999999991;10.5601389999999,-75.51541999999991;10.5601389999999,-75.515137;10.5595830000001,-75.515137;10.5595830000001,-75.51402899999989;10.5593050000001,-75.51402899999989;10.5593050000001,-75.51374899999991;10.559027,-75.51374899999991;10.559027,-75.51347300000001;10.558749,-75.51347300000001;10.558749,-75.51319099999991;10.5584729999999,-75.51319099999991;10.5584729999999,-75.5129169999999;10.5579170000001,-75.5129169999999;10.5579170000001,-75.512641;10.557361,-75.512641;10.557361,-75.5123589999999;10.556805,-75.5123589999999;10.556805,-75.50930700000001;10.5565290000001,-75.50930700000001;10.5565290000001,-75.5090269999999;10.5562490000002,-75.5090269999999;10.5562490000002,-75.50846799999989;10.5559730000001,-75.50846799999989;10.5559730000001,-75.5079189999999;10.555417,-75.5079189999999;10.555417,-75.50763599999991;10.5548630000001,-75.50763599999991;10.5548630000001,-75.5070799999999;10.5545830000002,-75.5070799999999;10.5545830000002,-75.5065309999999;10.5548630000001,-75.5065309999999;10.5548630000001,-75.5062479999999;10.5545830000002,-75.5062479999999;10.5545830000002,-75.50597500000001;10.5543070000001,-75.50597500000001;10.5543070000001,-75.50458499999991;10.554027,-75.50458499999991;10.554027,-75.5043019999999;10.553473,-75.5043019999999;10.553473,-75.5040289999999;10.5531950000001,-75.5040289999999;10.5531950000001,-75.5037529999999;10.5529170000002,-75.5037529999999;10.5529170000002,-75.5031969999999;10.5526390000001,-75.5031969999999;10.5526410000001,-75.502358;10.552361,-75.502358;10.552361,-75.50180899999999;10.5520830000001,-75.50180899999999;10.552085,-75.501526;10.551805,-75.501526;10.551805,-75.5012499999999;10.5515290000001,-75.5012499999999;10.5515290000001,-75.5009699999999;10.551805,-75.5009699999999;10.551805,-75.500694;10.552085,-75.500694;10.5520830000001,-75.50013799999989;10.552361,-75.50013799999989;10.552361,-75.4995799999999;10.5520830000001,-75.4995799999999;10.552085,-75.49902999999991;10.5509730000001,-75.49902999999991;10.5509730000001,-75.49930599999991;10.550695,-75.49930599999991;10.550695,-75.49986199999989;10.5504170000001,-75.49986199999989;10.550419,-75.50013799999989;10.550139,-75.50013799999989;10.550139,-75.500694;10.5487510000001,-75.500694;10.5487510000001,-75.5004209999999;10.5481970000001,-75.5004209999999;10.548194,-75.49902999999991;10.5484720000001,-75.49902999999991;10.5484720000001,-75.498474;10.5487510000001,-75.498474;10.5487510000001,-75.4979179999999;10.5493070000001,-75.4979179999999;10.5493070000001,-75.497642;10.5495820000001,-75.497642;10.5495820000001,-75.49736;10.5498630000001,-75.49736;10.5498630000001,-75.496528;10.5495820000001,-75.496528;10.5495820000001,-75.496245;10.549029,-75.496245;10.549029,-75.4959719999999;10.5487510000001,-75.4959719999999;10.5487510000001,-75.495696;10.5484720000001,-75.495696;10.5484720000001,-75.49541599999991;10.548194,-75.49541599999991;10.5481970000001,-75.49513999999991;10.5479160000001,-75.49513999999991;10.5479160000001,-75.494857;10.547638,-75.494857;10.5476410000001,-75.4945839999999;10.5473600000001,-75.4945839999999;10.5473600000001,-75.4943079999999;10.5468060000001,-75.4943079999999;10.5468060000001,-75.49402499999999;10.546528,-75.49402499999999;10.546528,-75.4937519999999;10.545416,-75.4937519999999;10.5454180000002,-75.49346899999991;10.543194,-75.49346899999991;10.543194,-75.4937519999999;10.5429160000001,-75.4937519999999;10.5429160000001,-75.49346899999991;10.5423620000001,-75.49346899999991;10.5423620000001,-75.493194;10.542084,-75.493194;10.542084,-75.4929199999999;10.541528,-75.4929199999999;10.541528,-75.4926369999999;10.5412500000001,-75.4926369999999;10.5412500000001,-75.4929199999999;10.5337490000001,-75.4929199999999;10.5337490000001,-75.493194;10.532361,-75.493194;10.532361,-75.49346899999991;10.531251,-75.49346899999991;10.531251,-75.4937519999999;10.530695,-75.4937519999999;10.530695,-75.49402499999999;10.5295830000001,-75.49402499999999;10.5295830000001,-75.4943079999999;10.528473,-75.4943079999999;10.528473,-75.4945839999999;10.5279170000001,-75.4945839999999;10.5279170000001,-75.494857;10.527361,-75.494857;10.527361,-75.49513999999991;10.5265270000002,-75.49513999999991;10.5265270000002,-75.49541599999991;10.5254170000001,-75.49541599999991;10.5254170000001,-75.495696;10.5245830000001,-75.495696;10.5245830000001,-75.4959719999999;10.524029,-75.4959719999999;10.524029,-75.496245;10.5231950000002,-75.496245;10.5231950000002,-75.496528;10.52236,-75.496528;10.522363,-75.4968039999999;10.52125,-75.4968039999999;10.52125,-75.4970859999999;10.5201380000001,-75.4970859999999;10.5201380000001,-75.49736;10.5187500000001,-75.49736;10.5187500000001,-75.497642;10.5184720000001,-75.497642;10.5184720000001,-75.49736;10.5181940000001,-75.49736;10.5181940000001,-75.497642;10.5176380000001,-75.497642;10.5176380000001,-75.498192;10.51736,-75.498192;10.51736,-75.498474;10.5168060000001,-75.498474;10.5168060000001,-75.49874799999991;10.5159720000001,-75.49874799999991;10.5159720000001,-75.49902999999991;10.515694,-75.49902999999991;10.515694,-75.49930599999991;10.5154180000001,-75.49930599999991;10.5154180000001,-75.4995799999999;10.5151380000001,-75.4995799999999;10.5151380000001,-75.49986199999989;10.5143060000001,-75.49986199999989;10.5143060000001,-75.50013799999989;10.5137520000001,-75.500152;10.5137520000001,-75.5004209999999;10.5134720000001,-75.5004209999999;10.5134720000001,-75.500694;10.512916,-75.500694;10.512916,-75.5009699999999;10.5118060000001,-75.5009699999999;10.5118060000001,-75.5012499999999;10.5115280000001,-75.5012499999999;10.5115300000001,-75.501526;10.5109740000001,-75.501526;10.5109740000001,-75.50180899999999;10.510694,-75.50180899999999;10.510694,-75.5020819999999;10.5098620000001,-75.5020819999999;10.5098620000001,-75.50180899999999;10.509584,-75.50180899999999;10.509584,-75.501526;10.5093060000001,-75.501526;10.5093080000001,-75.500694;10.5087520000001,-75.500694;10.5087520000001,-75.5004209999999;10.507918,-75.5004209999999;10.507918,-75.500694;10.5068050000001,-75.500694;10.5068050000001,-75.5009699999999;10.505971,-75.5009699999999;10.505973,-75.5012499999999;10.5056950000001,-75.5012499999999;10.5056950000001,-75.501526;10.504861,-75.501526;10.504863,-75.50180899999999;10.504307,-75.50180899999999;10.504307,-75.5020819999999;10.5040270000001,-75.5020819999999;10.5040270000001,-75.502358;10.503195,-75.502358;10.503197,-75.502641;10.5012510000001,-75.502641;10.5012510000001,-75.502358;10.500971,-75.502358;10.500973,-75.5020819999999;10.5006950000001,-75.5020819999999;10.5006950000001,-75.501526;10.5001390000001,-75.501526;10.5001390000001,-75.5012499999999;10.4990290000001,-75.5012499999999;10.4990290000001,-75.500694;10.498751,-75.500694;10.498751,-75.5004209999999;10.4984730000001,-75.5004209999999;10.4984730000001,-75.49986199999989;10.498751,-75.49986199999989;10.498751,-75.49930599999991;10.498195,-75.49930599999991;10.498195,-75.4995799999999;10.4973610000001,-75.4995799999999;10.4973610000001,-75.49930599999991;10.497085,-75.49930599999991;10.497085,-75.498474;10.4968040000001,-75.498474;10.4968040000001,-75.4979179999999;10.496529,-75.4979179999999;10.496529,-75.497642;10.4962510000001,-75.497642;10.4962510000001,-75.4970859999999;10.495973,-75.4970859999999;10.495973,-75.4968039999999;10.4956950000001,-75.4968039999999;10.4956950000001,-75.4959719999999;10.4954160000001,-75.4959719999999;10.4954160000001,-75.496245;10.4951380000001,-75.496245;10.4951410000001,-75.4959719999999;10.4948600000001,-75.4959719999999;10.4948600000001,-75.49541599999991;10.494582,-75.49541599999991;10.4945850000001,-75.49513999999991;10.494307,-75.49513999999991;10.494307,-75.494857;10.494028,-75.494857;10.494028,-75.4945839999999;10.4937500000001,-75.4945839999999;10.4937500000001,-75.49402499999999;10.4934720000001,-75.49402499999999;10.4934720000001,-75.4937519999999;10.4929190000001,-75.4937519999999;10.4929190000001,-75.49346899999991;10.4920840000001,-75.49346899999991;10.4920840000001,-75.493194;10.4918060000001,-75.493194;10.4918060000001,-75.4929199999999;10.4909720000001,-75.4929199999999;10.4909720000001,-75.4926369999999;10.490694,-75.4926369999999;10.490694,-75.492364;10.4904160000002,-75.492364;10.4904160000002,-75.492081;10.4901380000001,-75.492081;10.4901400000001,-75.4918059999999;10.489028,-75.4918059999999;10.489028,-75.49153199999991;10.4887500000002,-75.49153199999991;10.4887500000002,-75.49041799999991;10.4881940000001,-75.49041799999991;10.4881940000001,-75.48930300000001;10.487916,-75.48930300000001;10.487918,-75.48903;10.487362,-75.48903;10.487362,-75.488747;10.4870840000002,-75.488747;10.4870840000002,-75.48847099999991;10.4865280000001,-75.48847099999991;10.4865280000001,-75.488198;10.485696,-75.488198;10.485696,-75.48847099999991;10.4854160000002,-75.48847099999991;10.4854160000002,-75.488747;10.485696,-75.488747;10.485696,-75.48903;10.48625,-75.48903;10.48625,-75.48930300000001;10.4868060000001,-75.48930300000001;10.4868060000001,-75.4909739999999;10.4865280000001,-75.4909739999999;10.4865280000001,-75.4912489999999;10.48625,-75.4912489999999;10.48625,-75.49153199999991;10.4851400000001,-75.49153199999991;10.4851400000001,-75.4918059999999;10.4837500000002,-75.4918059999999;10.4837500000002,-75.492081;10.4826399999999,-75.492081;10.4826399999999,-75.492364;10.4820840000002,-75.492364;10.4820840000002,-75.4926369999999;10.481805,-75.4926369999999;10.481805,-75.4929199999999;10.481249,-75.4929199999999;10.481249,-75.493194;10.4809710000001,-75.493194;10.4809710000001,-75.49346899999991;10.4804150000001,-75.49346899999991;10.4804150000001,-75.4937519999999;10.4796680000001,-75.4937519999999;10.4793050000001,-75.4937519999999;10.4793050000001,-75.49402499999999;10.4787490000001,-75.49402499999999;10.4787490000001,-75.4943079999999;10.478471,-75.4943079999999;10.478473,-75.494477;10.478473,-75.4945839999999;10.478289,-75.4945839999999;10.477917,-75.4945839999999;10.477917,-75.494857;10.4776390000001,-75.494857;10.4776390000001,-75.49497100000001;10.4776390000001,-75.49513999999991;10.4773610000001,-75.49513999999991;10.4773610000001,-75.49541599999991;10.4769100000001,-75.49541599999991;10.476805,-75.49541599999991;10.476805,-75.495696;10.4764430000001,-75.495696;10.475417,-75.495696;10.475417,-75.4959719999999;10.475139,-75.4959719999999;10.475139,-75.496482;10.475139,-75.4970859999999;10.4743050000001,-75.4970859999999;10.4743050000001,-75.49736;10.4736870000001,-75.49736;10.473473,-75.49736;10.473473,-75.49749;10.473473,-75.497642;10.47322,-75.497642;10.4726390000001,-75.497642;10.4726410000001,-75.4979179999999;10.472361,-75.4979179999999;10.472361,-75.498192;10.471805,-75.498192;10.471805,-75.498474;10.4715290000001,-75.498474;10.4715290000001,-75.49874799999991;10.4709730000001,-75.49874799999991;10.4709730000001,-75.49902999999991;10.470695,-75.49902999999991;10.470695,-75.49930599999991;10.4704170000001,-75.49930599999991;10.470419,-75.4995799999999;10.4698630000001,-75.4995799999999;10.4698630000001,-75.49986199999989;10.4695820000001,-75.49986199999989;10.4695820000001,-75.50013799999989;10.469029,-75.50013799999989;10.469029,-75.5004209999999;10.4687510000001,-75.5004209999999;10.4687510000001,-75.500694;10.468194,-75.500694;10.468194,-75.5009699999999;10.4676410000001,-75.5009699999999;10.4676410000001,-75.5012499999999;10.467363,-75.5012499999999;10.467363,-75.501526;10.4668060000001,-75.501526;10.4668060000001,-75.50180899999999;10.466528,-75.50180899999999;10.466528,-75.5020819999999;10.4662500000001,-75.5020819999999;10.4662500000001,-75.502358;10.465972,-75.502358;10.465972,-75.502641;10.465418,-75.502641;10.465418,-75.50291399999991;10.4651380000001,-75.50291399999991;10.4651380000001,-75.5031969999999;10.46486,-75.5031969999999;10.464862,-75.503472;10.4645840000001,-75.503472;10.4645840000001,-75.5037529999999;10.464306,-75.5037529999999;10.4643090000001,-75.5040289999999;10.4640280000001,-75.5040289999999;10.4640280000001,-75.5043019999999;10.4634720000001,-75.5043019999999;10.4634720000001,-75.50458499999991;10.463194,-75.50458499999991;10.463194,-75.50485999999989;10.4629160000001,-75.50485999999989;10.4629160000001,-75.505143;10.462638,-75.505143;10.462638,-75.5054169999999;10.4623620000001,-75.5054169999999;10.4623620000001,-75.505692;10.462082,-75.505692;10.462082,-75.50597500000001;10.4618060000001,-75.50597500000001;10.4618060000001,-75.5062479999999;10.461528,-75.5062479999999;10.461528,-75.5065309999999;10.460974,-75.5065309999999;10.460974,-75.506805;10.4606940000001,-75.506805;10.4606940000001,-75.5070799999999;10.460416,-75.5070799999999;10.460418,-75.5073629999999;10.4601400000001,-75.5073629999999;10.4601400000001,-75.50763599999991;10.45986,-75.50763599999991;10.45986,-75.5079189999999;10.4595840000001,-75.5079189999999;10.4595840000001,-75.5081949999999;10.459306,-75.5081949999999;10.459306,-75.50846799999989;10.4590280000001,-75.50846799999989;10.4590280000001,-75.5087509999999;10.45875,-75.5087509999999;10.45875,-75.5090269999999;10.4584720000001,-75.5090269999999;10.4584720000001,-75.50930700000001;10.458194,-75.50930700000001;10.458194,-75.50958299999991;10.45764,-75.50958299999991;10.45764,-75.5104149999999;10.4573620000001,-75.5104149999999;10.4573620000001,-75.51069699999989;10.457084,-75.51069699999989;10.457084,-75.510971;10.456528,-75.510971;10.456528,-75.511253;10.4562500000001,-75.511253;10.4562500000001,-75.5115269999999;10.455974,-75.5115269999999;10.455974,-75.512085;10.4556930000001,-75.512085;10.4556930000001,-75.5123589999999;10.455418,-75.5123589999999;10.455418,-75.512641;10.4551400000001,-75.512641;10.4551400000001,-75.5129169999999;10.454862,-75.5129169999999;10.454862,-75.51319099999991;10.454583,-75.51319099999991;10.454583,-75.51347300000001;10.4543050000001,-75.51347300000001;10.4543050000001,-75.51374899999991;10.4540270000001,-75.51374899999991;10.4540300000001,-75.51402899999989;10.4537490000001,-75.51402899999989;10.4537490000001,-75.51430499999999;10.4531950000001,-75.51430499999999;10.4531950000001,-75.5145789999999;10.452917,-75.5145789999999;10.452917,-75.5148609999999;10.4526390000001,-75.5148609999999;10.4526390000001,-75.515137;10.4523610000001,-75.515137;10.4523610000001,-75.5156929999999;10.4520830000001,-75.5156929999999;10.4520830000001,-75.515976;10.451805,-75.515976;10.451805,-75.51625199999999;10.4515269999999,-75.51625199999999;10.4515269999999,-75.5165249999999;10.451249,-75.5165249999999;10.451251,-75.516808;10.4509730000001,-75.516808;10.4509730000001,-75.51708099999991;10.4506930000001,-75.51708099999991;10.4506950000001,-75.5173639999999;10.4504170000001,-75.5173639999999;10.4504170000001,-75.51764;10.450139,-75.51764;10.450139,-75.51791299999989;10.4498609999999,-75.51791299999989;10.4498609999999,-75.518196;10.449583,-75.518196;10.449583,-75.51847100000001;10.4493050000002,-75.51847100000001;10.4493050000002,-75.5187539999999;10.4490270000001,-75.5187539999999;10.4490290000001,-75.51902799999991;10.4487490000001,-75.51902799999991;10.4487490000001,-75.51930299999999;10.448473,-75.51930299999999;10.448473,-75.519584;10.4481949999999,-75.519584;10.4481949999999,-75.5198589999999;10.447917,-75.5198589999999;10.447917,-75.520416;10.4476390000002,-75.520416;10.4476390000002,-75.5206909999999;10.4473610000001,-75.5206909999999;10.4473610000001,-75.520974;10.4470830000001,-75.520974;10.4470830000001,-75.5212469999999;10.446807,-75.5212469999999;10.446807,-75.5215299999999;10.4465269999999,-75.5215299999999;10.4465269999999,-75.5220859999999;10.446251,-75.5220859999999;10.446251,-75.5223619999999;10.4459730000002,-75.5223619999999;10.4459730000002,-75.52263499999999;10.4456950000001,-75.52263499999999;10.4456950000001,-75.52291799999991;10.4454170000001,-75.52291799999991;10.4454170000001,-75.523476;10.445139,-75.523476;10.445141,-75.52375000000001;10.4448609999999,-75.52375000000001;10.4448609999999,-75.52486399999989;10.4445830000001,-75.52486399999989;10.444585,-75.525414;10.4443050000002,-75.525414;10.4443050000002,-75.5256959999999;10.4440290000001,-75.5256959999999;10.4440290000001,-75.52597;10.4437510000001,-75.52597;10.4437510000001,-75.5262519999999;10.443473,-75.5262519999999;10.443473,-75.526802;10.4431949999999,-75.526802;10.4431949999999,-75.5270839999999;10.4420820000001,-75.5270839999999;10.4420820000001,-75.5273599999999;10.441807,-75.5273599999999;10.441807,-75.52791599999991;10.4415260000001,-75.52791599999991;10.4415260000001,-75.52847199999999;10.4412510000001,-75.52847199999999;10.4412510000001,-75.52874799999999;10.440972,-75.52874799999999;10.440972,-75.52986299999991;10.440694,-75.52986299999991;10.440694,-75.5304189999999;10.4404160000001,-75.5304189999999;10.4404160000001,-75.5309749999999;10.440138,-75.5309749999999;10.440141,-75.53152399999991;10.4398600000001,-75.53152399999991;10.4398600000001,-75.531807;10.439306,-75.531807;10.439306,-75.532639;10.439028,-75.532639;10.439028,-75.53319499999991;10.4387500000001,-75.53319499999991;10.4387500000001,-75.533753;10.438472,-75.533753;10.438472,-75.534302;10.4381940000001,-75.534302;10.4381940000001,-75.5348579999999;10.43764,-75.5348579999999;10.43764,-75.5354149999999;10.43736,-75.5354149999999;10.437362,-75.5359729999999;10.4370840000001,-75.5359729999999;10.4370840000001,-75.536805;10.4365280000001,-75.536805;10.4365280000001,-75.537087;10.43625,-75.537087;10.43625,-75.53819299999989;10.435972,-75.53819299999989;10.435972,-75.5390249999999;10.435694,-75.5390249999999;10.435694,-75.53930699999989;10.4354160000001,-75.53930699999989;10.4354160000001,-75.5395809999999;10.435138,-75.5395809999999;10.435138,-75.5398629999999;10.4354160000001,-75.5398629999999;10.4354160000001,-75.5401389999999;10.435694,-75.5401389999999;10.435694,-75.5406949999999;10.4354160000001,-75.5406949999999;10.4354160000001,-75.541251;10.435138,-75.541251;10.435138,-75.5415269999999;10.434584,-75.5415269999999;10.434584,-75.5418099999999;10.434028,-75.5418099999999;10.434028,-75.54208299999991;10.4337500000001,-75.54208299999991;10.4337500000001,-75.5426419999999;10.433472,-75.5426419999999;10.433472,-75.543198;10.4331940000001,-75.543198;10.4331940000001,-75.5434709999999;10.432916,-75.5434709999999;10.432916,-75.54402999999991;10.43264,-75.54402999999991;10.43264,-75.5448619999999;10.43236,-75.5448619999999;10.43236,-75.5459739999999;10.4320840000001,-75.5459739999999;10.4320840000001,-75.5464089999999;10.4320840000001,-75.54652299999989;10.4319080000001,-75.54652299999989;10.431806,-75.54652299999989;10.431806,-75.5468059999999;10.4315280000001,-75.5468059999999;10.4315300000001,-75.547364;10.43125,-75.547364;10.43125,-75.54763799999991;10.430694,-75.54763799999991;10.430694,-75.54792000000001;10.4301370000001,-75.54792000000001;10.4301370000001,-75.5484689999999;10.4298620000001,-75.5484689999999;10.4298620000001,-75.549584;10.4287520000001,-75.549584;10.4287520000001,-75.5498569999999;10.4281960000001,-75.5498569999999;10.4281960000001,-75.550416;10.427918,-75.550416;10.427918,-75.5509719999999;10.4276400000001,-75.5509719999999;10.4276400000001,-75.55152800000001;10.4273610000001,-75.55152800000001;10.4273610000001,-75.55180399999991;10.427083,-75.55180399999991;10.427083,-75.552086;10.4268050000001,-75.552086;10.4268050000001,-75.55235999999989;10.426527,-75.55235999999989;10.4265300000001,-75.55263599999989;10.426252,-75.55263599999989;10.426252,-75.5531919999999;10.425971,-75.5531919999999;10.425973,-75.5534739999999;10.4256950000001,-75.5534739999999;10.4256950000001,-75.55374999999999;10.425417,-75.55374999999999;10.425417,-75.55403;10.4251390000001,-75.55403;10.4251390000001,-75.5543059999999;10.4245830000001,-75.5543059999999;10.4245830000001,-75.55458;10.4240270000001,-75.55458;10.4240270000001,-75.5543059999999;10.4234730000001,-75.5543059999999;10.4234730000001,-75.55403;10.422639,-75.55403;10.422639,-75.55374999999999;10.421527,-75.55374999999999;10.421527,-75.5534739999999;10.4201390000001,-75.5534739999999;10.4201390000001,-75.5531919999999;10.4195830000001,-75.5531919999999;10.4195830000001,-75.55291800000001;10.419305,-75.55291800000001;10.419307,-75.55263599999989;10.418869,-75.55263599999989;10.4184730000001,-75.55263599999989;10.4184730000001,-75.55235999999989;10.4173610000001,-75.55235999999989;10.4173610000001,-75.552086;10.416529,-75.552086;10.416529,-75.55180399999991;10.415417,-75.55180399999991;10.415417,-75.551248;10.4148600000001,-75.551248;10.4148600000001,-75.5509719999999;10.4145820000001,-75.5509719999999;10.4145820000001,-75.551248;10.4140290000001,-75.551248;10.4140290000001,-75.55152800000001;10.4131940000001,-75.55152800000001;10.4131940000001,-75.55180399999991;10.4126380000001,-75.55180399999991;10.4126380000001,-75.552086;10.4118040000001,-75.552086;10.4118040000001,-75.55180399999991;10.4112500000001,-75.55180399999991;10.4112500000001,-75.552086;10.410694,-75.552086;10.410694,-75.55235999999989;10.41014,-75.55235999999989;10.41014,-75.55263599999989;10.4098620000001,-75.55263599999989;10.4098620000001,-75.55235999999989;10.409028,-75.55235999999989;10.409028,-75.55263599999989;10.4087499999999,-75.55263599999989;10.4087499999999,-75.5531919999999;10.4084720000001,-75.5531919999999;10.4084720000001,-75.5534739999999;10.4081940000002,-75.5534739999999;10.4081940000002,-75.55374999999999;10.4076380000001,-75.55374999999999;10.4076380000001,-75.55403;10.4068060000001,-75.55403;10.4068060000001,-75.5543059999999;10.4065280000002,-75.5543059999999;10.4065280000002,-75.55458;10.4062500000001,-75.55458;10.4062500000001,-75.5551379999999;10.4059720000001,-75.5551379999999;10.4059720000001,-75.555421;10.405694,-75.555421;10.405696,-75.555694;10.4051400000001,-75.555694;10.4051400000001,-75.5559699999999;10.4048620000002,-75.5559699999999;10.4048620000002,-75.55652600000001;10.4045840000001,-75.55652600000001;10.4045840000001,-75.5568089999999;10.4031940000002,-75.5568089999999;10.4031940000002,-75.55708199999999;10.4029180000001,-75.55708199999999;10.4029180000001,-75.55735799999989;10.402362,-75.55735799999989;10.402362,-75.5576409999999;10.4020839999999,-75.5576409999999;10.4020839999999,-75.55819700000001;10.4018060000001,-75.55819700000001;10.4018080000001,-75.558746;10.401527,-75.558746;10.401527,-75.559029;10.4009710000001,-75.559029;10.4009710000001,-75.559585;10.400696,-75.559585;10.400696,-75.560417;10.4009710000001,-75.560417;10.4009710000001,-75.560692;10.400696,-75.560692;10.400696,-75.5609749999999;10.399861,-75.5609749999999;10.399861,-75.561249;10.399583,-75.561249;10.399583,-75.56180499999989;10.3990270000002,-75.56180499999989;10.3990270000002,-75.5621809999999;10.39903,-75.56236299999991;10.3987490000001,-75.56236299999991;10.3987490000001,-75.56291899999999;10.398471,-75.56291899999999;10.398473,-75.56319499999999;10.398195,-75.56319499999999;10.398195,-75.563751;10.397917,-75.563751;10.397917,-75.564583;10.396251,-75.564583;10.396251,-75.5643069999999;10.3959730000001,-75.5643069999999;10.3959730000001,-75.564027;10.3956950000002,-75.564027;10.3956950000002,-75.5634679999999;10.395139,-75.5634679999999;10.395139,-75.56319499999999;10.394583,-75.56319499999999;10.394583,-75.56291899999999;10.3943050000001,-75.56291899999999;10.3943050000001,-75.5626369999999;10.394027,-75.5626369999999;10.394027,-75.56236299999991;10.3937510000001,-75.56236299999991;10.3937510000001,-75.56208;10.393473,-75.56208;10.393473,-75.5615309999999;10.3931950000001,-75.5615309999999;10.3931950000001,-75.560692;10.392917,-75.560692;10.392917,-75.5593039999999;10.3926390000001,-75.5593039999999;10.3926390000001,-75.559029;10.392917,-75.559029;10.392917,-75.558746;10.393473,-75.558746;10.393473,-75.55847299999991;10.3937510000001,-75.55847299999991;10.3937510000001,-75.55819700000001;10.3943050000001,-75.55819700000001;10.3943050000001,-75.55847299999991;10.394583,-75.55847299999991;10.394583,-75.558746;10.3948610000001,-75.558746;10.3948610000001,-75.5593039999999;10.395139,-75.5593039999999;10.395139,-75.5609749999999;10.3954170000001,-75.5609749999999;10.3954170000001,-75.5615309999999;10.3959730000001,-75.5615309999999;10.3959730000001,-75.56180499999989;10.396251,-75.56180499999989;10.396251,-75.5615309999999;10.396807,-75.5615309999999;10.396805,-75.560692;10.3967320000002,-75.560692;10.396529,-75.560692;10.396529,-75.56036399999989;10.396529,-75.5601429999999;10.3963770000001,-75.5601429999999;10.396249,-75.5601429999999;10.396249,-75.559861;10.3961600000001,-75.559861;10.3959730000001,-75.559861;10.3959730000001,-75.559585;10.3956950000002,-75.559585;10.3956950000002,-75.55914299999991;10.3956950000002,-75.558746;10.3954170000001,-75.558746;10.3954170000001,-75.55819700000001;10.395139,-75.55819700000001;10.395139,-75.5568089999999;10.3948610000001,-75.5568089999999;10.3948610000001,-75.5551379999999;10.394583,-75.5551379999999;10.394583,-75.55458;10.3943050000001,-75.55458;10.3943050000001,-75.55403;10.394027,-75.55403;10.394027,-75.55374999999999;10.3937510000001,-75.55374999999999;10.3937510000001,-75.55291800000001;10.393473,-75.55291800000001;10.393473,-75.55263599999989;10.3931950000001,-75.55263599999989;10.3931950000001,-75.552086;10.392917,-75.552086;10.392917,-75.55152800000001;10.3926390000001,-75.55152800000001;10.3926390000001,-75.5509719999999;10.392361,-75.5509719999999;10.392361,-75.550698;10.3920830000001,-75.550698;10.3920830000001,-75.5501399999999;10.391805,-75.5501399999999;10.391805,-75.549584;10.3915290000001,-75.549584;10.3915290000001,-75.5490259999999;10.391249,-75.5490259999999;10.391249,-75.54875199999999;10.3909730000001,-75.54875199999999;10.3909730000001,-75.548196;10.390695,-75.548196;10.390695,-75.54763799999991;10.3904170000001,-75.54763799999991;10.3904170000001,-75.5468059999999;10.390695,-75.5468059999999;10.390695,-75.54652299999989;10.3904170000001,-75.54652299999989;10.3904170000001,-75.545135;10.390695,-75.545135;10.390695,-75.5448619999999;10.3920830000001,-75.5448619999999;10.3920830000001,-75.545418;10.392361,-75.545418;10.392361,-75.54625;10.3926390000001,-75.54625;10.3926390000001,-75.5468059999999;10.392917,-75.5468059999999;10.392917,-75.547364;10.3931950000001,-75.547364;10.3931950000001,-75.54763799999991;10.393473,-75.54763799999991;10.393473,-75.548196;10.3937510000001,-75.548196;10.3937510000001,-75.5484689999999;10.394027,-75.5484689999999;10.394027,-75.54875199999999;10.3943050000001,-75.54875199999999;10.3943050000001,-75.5493079999999;10.394583,-75.5493079999999;10.394583,-75.5501399999999;10.3948610000001,-75.5501399999999;10.3948610000001,-75.550416;10.395139,-75.550416;10.395139,-75.550698;10.3954170000001,-75.550698;10.3954170000001,-75.551248;10.3959730000001,-75.551248;10.3959730000001,-75.55152800000001;10.396251,-75.55152800000001;10.396249,-75.55180399999991;10.396529,-75.55180399999991;10.396529,-75.552086;10.396807,-75.552086;10.396805,-75.55235999999989;10.3970830000001,-75.55235999999989;10.3970830000001,-75.55291800000001;10.3973610000002,-75.55291800000001;10.3973610000002,-75.5534739999999;10.3976390000001,-75.5534739999999;10.3976390000001,-75.55403;10.397917,-75.55403;10.397917,-75.5543059999999;10.398473,-75.5543059999999;10.398471,-75.55403;10.3987490000001,-75.55403;10.3987490000001,-75.55374999999999;10.39903,-75.55374999999999;10.3990270000002,-75.5534739999999;10.3993050000001,-75.5534739999999;10.3993050000001,-75.5531919999999;10.399861,-75.5531919999999;10.399861,-75.55291800000001;10.4009710000001,-75.55291800000001;10.4009710000001,-75.55263599999989;10.4026370000001,-75.55263599999989;10.4026370000001,-75.55235999999989;10.4031940000002,-75.55235999999989;10.4031940000002,-75.552086;10.40403,-75.552086;10.40403,-75.55180399999991;10.4045840000001,-75.55180399999991;10.4045840000001,-75.55152800000001;10.4048620000002,-75.55152800000001;10.4048620000002,-75.551248;10.4054159999999,-75.551248;10.4054159999999,-75.5509719999999;10.405696,-75.5509719999999;10.405694,-75.550698;10.4059720000001,-75.550698;10.4059720000001,-75.550416;10.4065280000002,-75.550416;10.4065280000002,-75.5501399999999;10.4068060000001,-75.5501399999999;10.4068060000001,-75.5498569999999;10.4070839999999,-75.5498569999999;10.4070839999999,-75.549584;10.4076380000001,-75.549584;10.4076380000001,-75.5493079999999;10.4079180000001,-75.5493079999999;10.4079160000001,-75.5490259999999;10.4081940000002,-75.5490259999999;10.4081940000002,-75.54875199999999;10.4087499999999,-75.54875199999999;10.4087499999999,-75.5484689999999;10.4093060000001,-75.5484689999999;10.4093060000001,-75.548196;10.4095840000001,-75.548196;10.4095840000001,-75.54792000000001;10.4098620000001,-75.54792000000001;10.4098620000001,-75.547364;10.41014,-75.547364;10.4101380000001,-75.54708099999991;10.4104159999999,-75.54708099999991;10.4104159999999,-75.5468059999999;10.410694,-75.5468059999999;10.410694,-75.54652299999989;10.4112500000001,-75.54652299999989;10.4112500000001,-75.54625;10.413472,-75.54625;10.413472,-75.54652299999989;10.4140290000001,-75.54652299999989;10.4140290000001,-75.5468059999999;10.414307,-75.5468059999999;10.414307,-75.54708099999991;10.4145820000001,-75.54708099999991;10.4145820000001,-75.547364;10.4148600000001,-75.547364;10.4148600000001,-75.54763799999991;10.415417,-75.54763799999991;10.415417,-75.54792000000001;10.415973,-75.54792000000001;10.415973,-75.548196;10.416529,-75.548196;10.416529,-75.5484689999999;10.4173610000001,-75.5484689999999;10.4173610000001,-75.5490259999999;10.417639,-75.5490259999999;10.417639,-75.549584;10.4179170000001,-75.549584;10.4179170000001,-75.5498569999999;10.418195,-75.5498569999999;10.418195,-75.5501399999999;10.4184730000001,-75.5501399999999;10.4184730000001,-75.550416;10.418751,-75.550416;10.418749,-75.550698;10.419863,-75.550698;10.419861,-75.550416;10.4201390000001,-75.550416;10.4201390000001,-75.549584;10.419861,-75.549584;10.419863,-75.5490259999999;10.4195830000001,-75.5490259999999;10.4195830000001,-75.54875199999999;10.419305,-75.54875199999999;10.419307,-75.548196;10.4190270000001,-75.548196;10.4190270000001,-75.54792000000001;10.418751,-75.54792000000001;10.418751,-75.54763799999991;10.4184730000001,-75.54763799999991;10.4184730000001,-75.547364;10.418195,-75.547364;10.418195,-75.54708099999991;10.4179170000001,-75.54708099999991;10.4179170000001,-75.54652299999989;10.417639,-75.54652299999989;10.417639,-75.545586;10.417639,-75.545418;10.4173610000001,-75.545418;10.4173610000001,-75.545135;10.417639,-75.545135;10.417639,-75.5448619999999;10.4179170000001,-75.5448619999999;10.4179170000001,-75.5443029999999;10.4192230000002,-75.5443029999999;10.4195830000001,-75.5443029999999;10.4195830000001,-75.54402999999991;10.420973,-75.54402999999991;10.420971,-75.5437469999999;10.4212510000001,-75.5437469999999;10.4212510000001,-75.5434709999999;10.421527,-75.5434709999999;10.421527,-75.5415269999999;10.419432,-75.5415269999999;10.4190270000001,-75.5415269999999;10.4190270000001,-75.5418099999999;10.418751,-75.5418099999999;10.418751,-75.54235899999991;10.4184730000001,-75.54235899999991;10.4184730000001,-75.5426419999999;10.4179170000001,-75.5426419999999;10.4179170000001,-75.543198;10.4173610000001,-75.543198;10.4173610000001,-75.54402999999991;10.417085,-75.54402999999991;10.417085,-75.5443029999999;10.415417,-75.5443029999999;10.415417,-75.545135;10.4148600000001,-75.545135;10.4148600000001,-75.544586;10.4145820000001,-75.544586;10.4145820000001,-75.5443029999999;10.414307,-75.5443029999999;10.414307,-75.54402999999991;10.4137499999999,-75.54402999999991;10.4137499999999,-75.5434709999999;10.4126380000001,-75.5434709999999;10.4126380000001,-75.543198;10.41236,-75.543198;10.41236,-75.54291499999989;10.4118040000001,-75.54291499999989;10.4118040000001,-75.5426419999999;10.4115280000001,-75.5426419999999;10.4115280000001,-75.54235899999991;10.4109720000001,-75.54235899999991;10.4109720000001,-75.54208299999991;10.410694,-75.54208299999991;10.410694,-75.5418099999999;10.4104159999999,-75.5418099999999;10.4104159999999,-75.5395809999999;10.4101380000001,-75.5395809999999;10.41014,-75.5390249999999;10.4095840000001,-75.5390249999999;10.4095840000001,-75.5387489999999;10.4087499999999,-75.5387489999999;10.4087499999999,-75.53847499999991;10.4076380000001,-75.53847499999991;10.4076380000001,-75.53819299999989;10.4068060000001,-75.53819299999989;10.4068060000001,-75.53791699999989;10.4059720000001,-75.53791699999989;10.4059720000001,-75.537637;10.4054159999999,-75.537637;10.4054159999999,-75.53736099999991;10.4051400000001,-75.53736099999991;10.4051400000001,-75.537087;10.4048620000002,-75.537087;10.4048620000002,-75.534302;10.4045840000001,-75.534302;10.4045840000001,-75.5340269999999;10.4043060000001,-75.5340269999999;10.4043060000001,-75.533753;10.4031940000002,-75.533753;10.4031940000002,-75.53346999999999;10.4026370000001,-75.53346999999999;10.4026370000001,-75.53319499999991;10.402362,-75.53319499999991;10.402362,-75.532639;10.4026370000001,-75.532639;10.4026370000001,-75.5323629999999;10.4029180000001,-75.5323629999999;10.4029180000001,-75.5320819999999;10.4031940000002,-75.5320819999999;10.4031940000002,-75.531807;10.4034740000001,-75.531807;10.4034740000001,-75.53152399999991;10.40403,-75.53152399999991;10.40403,-75.5273599999999;10.4037499999999,-75.5273599999999;10.4037499999999,-75.5270839999999;10.40403,-75.5270839999999;10.40403,-75.5265279999999;10.4045840000001,-75.5265279999999;10.4045840000001,-75.5245429999999;10.4045840000001,-75.52430800000001;10.4043060000001,-75.52430800000001;10.4043060000001,-75.52375000000001;10.4029180000001,-75.52375000000001;10.4029180000001,-75.52402599999991;10.4020839999999,-75.52402599999991;10.4020839999999,-75.52430800000001;10.400696,-75.52430800000001;10.400696,-75.52402599999991;10.3990270000002,-75.52402599999991;10.39903,-75.52430800000001;10.398195,-75.52430800000001;10.398195,-75.525138;10.3987490000001,-75.525138;10.3987490000001,-75.525414;10.3993050000001,-75.525414;10.3993050000001,-75.5256959999999;10.4004150000001,-75.5256959999999;10.4004150000001,-75.52597;10.400696,-75.52597;10.400696,-75.5265279999999;10.4009710000001,-75.5265279999999;10.4009710000001,-75.5270839999999;10.4012520000001,-75.5270839999999;10.401249,-75.5278769999999;10.4012520000001,-75.5281989999999;10.4009710000001,-75.528251;10.4009710000001,-75.52874799999999;10.400696,-75.52874799999999;10.400696,-75.5290309999999;10.400388,-75.5290309999999;10.3993050000001,-75.5290309999999;10.3993050000001,-75.529304;10.3976390000001,-75.529304;10.3976390000001,-75.52847199999999;10.3973610000002,-75.52847199999999;10.3973610000002,-75.5281989999999;10.3970830000001,-75.5281989999999;10.3970830000001,-75.52791599999991;10.396805,-75.52791599999991;10.396807,-75.5270839999999;10.396529,-75.5270839999999;10.396529,-75.526802;10.3956950000002,-75.526802;10.3956950000002,-75.52764000000001;10.3959730000001,-75.52764000000001;10.3959730000001,-75.52791599999991;10.396251,-75.52791599999991;10.396251,-75.52847199999999;10.3959730000001,-75.52847199999999;10.3959730000001,-75.52874799999999;10.3956950000002,-75.52874799999999;10.3956950000002,-75.5290309999999;10.3954170000001,-75.5290309999999;10.3954170000001,-75.529304;10.3948610000001,-75.529304;10.3948610000001,-75.52986299999991;10.395139,-75.52986299999991;10.395139,-75.530136;10.3948610000001,-75.530136;10.3948610000001,-75.5304189999999;10.394583,-75.5304189999999;10.394583,-75.5309749999999;10.394027,-75.5309749999999;10.394027,-75.5312509999999;10.393473,-75.5312509999999;10.393473,-75.531807;10.3931950000001,-75.531807;10.3931950000001,-75.5320819999999;10.392917,-75.5320819999999;10.392917,-75.532639;10.392361,-75.532639;10.392361,-75.53353900000001;10.392361,-75.534302;10.3926390000001,-75.534302;10.3926390000001,-75.53458499999989;10.392917,-75.53458499999989;10.392917,-75.5351409999999;10.3931950000001,-75.5351409999999;10.3931950000001,-75.5356969999999;10.393473,-75.5356969999999;10.393473,-75.5359729999999;10.3937510000001,-75.5359729999999;10.3937510000001,-75.5365289999999;10.3943050000001,-75.5365289999999;10.3943050000001,-75.536805;10.394027,-75.536805;10.394027,-75.537087;10.392917,-75.537087;10.392917,-75.536805;10.392361,-75.536805;10.392361,-75.5359729999999;10.3920830000001,-75.5359729999999;10.3920830000001,-75.5356969999999;10.391805,-75.5356969999999;10.391805,-75.5351409999999;10.3915290000001,-75.5351409999999;10.3915290000001,-75.5348579999999;10.391249,-75.5348579999999;10.391249,-75.534302;10.390695,-75.534302;10.390695,-75.5340269999999;10.390139,-75.5340269999999;10.390139,-75.53291399999991;10.3898610000001,-75.53291399999991;10.3898630000001,-75.53253099999991;10.3898630000001,-75.5323629999999;10.389583,-75.5323629999999;10.389583,-75.5320819999999;10.389304,-75.5320819999999;10.3893070000001,-75.53152399999991;10.3889760000001,-75.53152399999991;10.388473,-75.53152399999991;10.388473,-75.531807;10.3881950000001,-75.531807;10.3881950000001,-75.53152399999991;10.3879160000001,-75.53152399999991;10.3879160000001,-75.5312509999999;10.387638,-75.5312509999999;10.3876410000001,-75.5309749999999;10.387363,-75.5309749999999;10.387363,-75.5306919999999;10.386807,-75.5306919999999;10.386807,-75.5304189999999;10.3862500000001,-75.5304189999999;10.3862500000001,-75.530136;10.385972,-75.530136;10.385972,-75.52986299999991;10.3851380000001,-75.52986299999991;10.3851380000001,-75.529304;10.38486,-75.529304;10.384862,-75.5290309999999;10.3845840000001,-75.5290309999999;10.3845840000001,-75.52847199999999;10.384306,-75.52847199999999;10.384306,-75.5281989999999;10.3840280000001,-75.5281989999999;10.3840280000001,-75.52764000000001;10.38375,-75.52764000000001;10.38375,-75.5270839999999;10.3834720000001,-75.5270839999999;10.3834720000001,-75.526802;10.383194,-75.526802;10.383194,-75.5265279999999;10.3829160000001,-75.5265279999999;10.3829160000001,-75.5262519999999;10.382638,-75.5262519999999;10.38264,-75.52597;10.3823620000001,-75.52597;10.3823620000001,-75.5256959999999;10.382082,-75.5256959999999;10.382084,-75.525414;10.381528,-75.525414;10.381528,-75.525138;10.3812500000001,-75.525138;10.3812500000001,-75.52486399999989;10.381528,-75.52486399999989;10.381528,-75.52430800000001;10.3818060000001,-75.52430800000001;10.3818060000001,-75.52402599999991;10.382084,-75.52402599999991;10.382082,-75.52375000000001;10.3829160000001,-75.52375000000001;10.3829160000001,-75.52430800000001;10.383194,-75.52430800000001;10.383194,-75.52486399999989;10.3834720000001,-75.52486399999989;10.3834720000001,-75.525414;10.38375,-75.525414;10.38375,-75.52597;10.3840280000001,-75.52597;10.3840280000001,-75.5262519999999;10.384306,-75.5262519999999;10.384306,-75.526802;10.3845840000001,-75.526802;10.3845840000001,-75.5270839999999;10.384862,-75.5270839999999;10.38486,-75.526802;10.3851380000001,-75.526802;10.3851380000001,-75.5270839999999;10.3870850000001,-75.5270839999999;10.387082,-75.526802;10.3880490000001,-75.526802;10.3881950000001,-75.526802;10.3881950000001,-75.5270839999999;10.3898630000001,-75.5270839999999;10.3898610000001,-75.526802;10.390139,-75.526802;10.390139,-75.5265279999999;10.3904190000001,-75.5265279999999;10.3904170000001,-75.5262519999999;10.390695,-75.5262519999999;10.390695,-75.5256959999999;10.389583,-75.5256959999999;10.389583,-75.52597;10.3887510000001,-75.52597;10.3887510000001,-75.5262519999999;10.3880710000001,-75.5262519999999;10.385972,-75.5262519999999;10.385972,-75.52597;10.3856940000001,-75.52597;10.3856940000001,-75.5256959999999;10.385416,-75.5256959999999;10.3854190000001,-75.52486399999989;10.3851380000001,-75.52486399999989;10.3851380000001,-75.5223619999999;10.3854190000001,-75.5223619999999;10.385416,-75.5220859999999;10.3856940000001,-75.5220859999999;10.3856940000001,-75.5215299999999;10.385972,-75.5215299999999;10.385972,-75.5212469999999;10.3862500000001,-75.5212469999999;10.3862500000001,-75.520974;10.386528,-75.520974;10.386528,-75.5206909999999;10.3862500000001,-75.5206909999999;10.3862500000001,-75.52014200000001;10.385972,-75.52014200000001;10.385972,-75.51930299999999;10.3856940000001,-75.51930299999999;10.3856940000001,-75.51847100000001;10.385416,-75.51847100000001;10.3854190000001,-75.518196;10.3851380000001,-75.518196;10.3851380000001,-75.51764;10.3845840000001,-75.51764;10.3845840000001,-75.5173639999999;10.384306,-75.5173639999999;10.384306,-75.51708099999991;10.3840280000001,-75.51708099999991;10.3840280000001,-75.516808;10.3834720000001,-75.516808;10.3834720000001,-75.5165249999999;10.383194,-75.5165249999999;10.383194,-75.51625199999999;10.3829160000001,-75.51625199999999;10.3829160000001,-75.515976;10.3823620000001,-75.515976;10.3823620000001,-75.5156929999999;10.382082,-75.5156929999999;10.382084,-75.515137;10.3818060000001,-75.515137;10.3818060000001,-75.51430499999999;10.38264,-75.51430499999999;10.382638,-75.51402899999989;10.3829160000001,-75.51402899999989;10.3829160000001,-75.51347300000001;10.382638,-75.51347300000001;10.38264,-75.5129169999999;10.3823620000001,-75.5129169999999;10.3823620000001,-75.512641;10.3818060000001,-75.512641;10.3818060000001,-75.5123589999999;10.3812500000001,-75.5123589999999;10.3812500000001,-75.51213799999989;10.3812500000001,-75.511803;10.3806940000001,-75.511803;10.3806940000001,-75.5115269999999;10.380416,-75.5115269999999;10.380418,-75.511253;10.3801400000001,-75.511253;10.3801400000001,-75.5104149999999;10.379862,-75.5104149999999;10.379862,-75.510139;10.3795840000001,-75.510139;10.3795840000001,-75.50986499999991;10.379306,-75.50986499999991;10.379308,-75.510139;10.3790280000001,-75.510139;10.3790280000001,-75.51069699999989;10.37875,-75.51069699999989;10.37875,-75.511253;10.3784720000001,-75.511253;10.3784720000001,-75.5115269999999;10.3779160000001,-75.5115269999999;10.3779160000001,-75.511253;10.377084,-75.511253;10.377084,-75.510971;10.3768060000001,-75.510971;10.3768060000001,-75.51069699999989;10.376528,-75.51069699999989;10.376528,-75.5104149999999;10.375972,-75.5104149999999;10.375972,-75.510139;10.3756930000001,-75.510139;10.3756930000001,-75.5099949999999;10.3756930000001,-75.50986499999991;10.3753540000001,-75.50986499999991;10.3734710000001,-75.50986499999991;10.3734710000001,-75.50958299999991;10.372915,-75.50958299999991;10.372915,-75.50930700000001;10.371249,-75.50930700000001;10.371249,-75.5090269999999;10.3709729999999,-75.5090269999999;10.3709729999999,-75.50930700000001;10.3690270000001,-75.50930700000001;10.3690290000001,-75.50986499999991;10.3687490000002,-75.50986499999991;10.3687490000002,-75.50958299999991;10.3684730000001,-75.50958299999991;10.3684730000001,-75.50930700000001;10.3681950000001,-75.50930700000001;10.3681950000001,-75.50958299999991;10.367917,-75.50958299999991;10.367917,-75.50986499999991;10.3676389999999,-75.50986499999991;10.3676389999999,-75.510139;10.3673610000001,-75.510139;10.3673610000001,-75.5104149999999;10.364585,-75.5104149999999;10.364585,-75.510971;10.364305,-75.510971;10.364305,-75.511253;10.3640290000001,-75.511253;10.3640290000001,-75.5115269999999;10.3623630000001,-75.5115269999999;10.3623630000001,-75.511253;10.3620820000001,-75.511253;10.3620820000001,-75.510971;10.3615260000001,-75.510971;10.3615260000001,-75.51069699999989;10.360973,-75.51069699999989;10.360973,-75.5104149999999;10.360694,-75.5104149999999;10.3606970000001,-75.510139;10.3604160000001,-75.510139;10.3604160000001,-75.5104149999999;10.3587500000001,-75.5104149999999;10.3587500000001,-75.50986499999991;10.358472,-75.50986499999991;10.3584750000001,-75.510139;10.3576400000001,-75.510139;10.3576400000001,-75.5104149999999;10.35736,-75.5104149999999;10.357362,-75.510971;10.3570840000001,-75.510971;10.3570840000001,-75.511253;10.356806,-75.511253;10.356806,-75.511803;10.3562520000002,-75.511803;10.3562520000002,-75.512085;10.3559720000001,-75.512085;10.3559720000001,-75.511803;10.3543060000001,-75.511803;10.3543060000001,-75.5115269999999;10.354028,-75.5115269999999;10.354028,-75.511253;10.353472,-75.511253;10.353472,-75.510971;10.352916,-75.510971;10.352916,-75.511253;10.3520840000001,-75.511253;10.3520840000001,-75.5115269999999;10.3515280000001,-75.5115269999999;10.3515280000001,-75.511803;10.3509720000001,-75.511803;10.3509720000001,-75.512085;10.3493060000001,-75.512085;10.3493060000001,-75.510971;10.3498620000001,-75.510971;10.3498620000001,-75.51069699999989;10.3504180000001,-75.51069699999989;10.3504180000001,-75.5104149999999;10.35125,-75.5104149999999;10.35125,-75.510139;10.3515280000001,-75.510139;10.3515280000001,-75.50986499999991;10.351806,-75.50986499999991;10.351806,-75.50930700000001;10.3493060000001,-75.50930700000001;10.3493060000001,-75.50958299999991;10.349028,-75.50958299999991;10.349028,-75.50986499999991;10.3487500000001,-75.50986499999991;10.3487520000001,-75.510139;10.3484710000001,-75.510139;10.3484710000001,-75.5104149999999;10.348193,-75.5104149999999;10.3481960000001,-75.51069699999989;10.347918,-75.51069699999989;10.347918,-75.510971;10.3476400000001,-75.510971;10.3476400000001,-75.511803;10.3481960000001,-75.511803;10.348193,-75.512085;10.3484710000001,-75.512085;10.3484710000001,-75.5123589999999;10.349028,-75.5123589999999;10.349028,-75.512641;10.3509720000001,-75.512641;10.3509720000001,-75.5129169999999;10.3520840000001,-75.5129169999999;10.3520840000001,-75.51319099999991;10.352916,-75.51319099999991;10.352916,-75.51347300000001;10.3531940000001,-75.51347300000001;10.3531940000001,-75.51374899999991;10.353472,-75.51374899999991;10.353472,-75.51402899999989;10.3537500000001,-75.51402899999989;10.3537500000001,-75.5145789999999;10.354028,-75.5145789999999;10.354028,-75.5148609999999;10.3543060000001,-75.5148609999999;10.3543060000001,-75.51541999999991;10.3545840000002,-75.51541999999991;10.3545840000002,-75.5156929999999;10.3543060000001,-75.5156929999999;10.3543060000001,-75.515976;10.3531940000001,-75.515976;10.3531940000001,-75.51625199999999;10.3526400000001,-75.51625199999999;10.3526400000001,-75.515976;10.3515280000001,-75.515976;10.3515280000001,-75.5156929999999;10.35125,-75.5156929999999;10.35125,-75.51541999999991;10.350694,-75.51541999999991;10.350694,-75.515137;10.3498620000001,-75.515137;10.3498620000001,-75.5148609999999;10.349584,-75.5148609999999;10.349584,-75.5145789999999;10.3493060000001,-75.5145789999999;10.3493060000001,-75.51430499999999;10.3487500000001,-75.51430499999999;10.3487520000001,-75.51402899999989;10.3481960000001,-75.51402899999989;10.3481960000001,-75.51374899999991;10.347918,-75.51374899999991;10.347918,-75.51347300000001;10.3476400000001,-75.51347300000001;10.3476400000001,-75.51319099999991;10.347362,-75.51319099999991;10.347362,-75.512641;10.347083,-75.512641;10.347083,-75.512085;10.3468050000001,-75.512085;10.3468050000001,-75.511803;10.346527,-75.511803;10.346527,-75.5104149999999;10.3468050000001,-75.5104149999999;10.3468050000001,-75.510139;10.346527,-75.510139;10.3465300000001,-75.50930700000001;10.3462490000001,-75.50930700000001;10.3462490000001,-75.509147;10.3462490000001,-75.50846799999989;10.3456950000001,-75.50846799999989;10.3456950000001,-75.5081949999999;10.345417,-75.5081949999999;10.345417,-75.5079189999999;10.344861,-75.5079189999999;10.344861,-75.5081949999999;10.344307,-75.5081949999999;10.344307,-75.50846799999989;10.343751,-75.50846799999989;10.343751,-75.5087509999999;10.342639,-75.5087509999999;10.342639,-75.5090269999999;10.3423610000001,-75.5090269999999;10.3423610000001,-75.50930700000001;10.3418050000001,-75.50930700000001;10.3418050000001,-75.50958299999991;10.341527,-75.50958299999991;10.341529,-75.5097419999999;10.341529,-75.50986499999991;10.3405400000001,-75.50986499999991;10.340417,-75.50986499999991;10.340417,-75.510139;10.339861,-75.510139;10.339861,-75.5115269999999;10.3395830000001,-75.5115269999999;10.3395830000001,-75.511803;10.3379170000001,-75.511803;10.3379170000001,-75.5115269999999;10.3373610000001,-75.5115269999999;10.3373610000001,-75.511253;10.3368050000001,-75.511253;10.3368050000001,-75.510971;10.3362510000001,-75.510971;10.3362510000001,-75.5104149999999;10.3356950000001,-75.5104149999999;10.3356950000001,-75.510139;10.3351390000001,-75.510139;10.3351390000001,-75.50986499999991;10.3340290000001,-75.50986499999991;10.3340290000001,-75.510139;10.3337510000001,-75.510139;10.3337510000001,-75.50986499999991;10.3329160000001,-75.50986499999991;10.3329160000001,-75.50930700000001;10.3320840000001,-75.50930700000001;10.3320840000001,-75.50986499999991;10.331804,-75.50986499999991;10.331804,-75.510139;10.3312500000001,-75.510139;10.3312500000001,-75.5104149999999;10.3293060000001,-75.5104149999999;10.3293060000001,-75.510139;10.3279180000001,-75.510139;10.3279180000001,-75.5104149999999;10.3276380000001,-75.5104149999999;10.3276380000001,-75.51069699999989;10.3273620000001,-75.51069699999989;10.3273620000001,-75.510971;10.327084,-75.510971;10.327084,-75.511253;10.326806,-75.511253;10.326806,-75.511803;10.326528,-75.511803;10.326528,-75.5115269999999;10.3262500000001,-75.5115269999999;10.3262500000001,-75.511253;10.3259720000001,-75.511253;10.3259720000001,-75.510971;10.3256940000001,-75.510971;10.3256960000001,-75.5104149999999;10.325416,-75.5104149999999;10.325416,-75.510139;10.32514,-75.510139;10.32514,-75.50986499999991;10.3245840000001,-75.50986499999991;10.3245840000001,-75.50958299999991;10.3240300000001,-75.50958299999991;10.3240300000001,-75.50986499999991;10.3229180000001,-75.50986499999991;10.3229180000001,-75.50958299999991;10.3226370000001,-75.50958299999991;10.3226370000001,-75.50930700000001;10.322084,-75.50930700000001;10.322084,-75.50986499999991;10.3218060000001,-75.50986499999991;10.321808,-75.510139;10.3209710000001,-75.510139;10.3209710000001,-75.5104149999999;10.320418,-75.5104149999999;10.320418,-75.50958299999991;10.319583,-75.50958299999991;10.319583,-75.50930700000001;10.3193050000001,-75.50930700000001;10.3193050000001,-75.5090269999999;10.3187490000001,-75.5090269999999;10.3187490000001,-75.50930700000001;10.318471,-75.50930700000001;10.3184730000002,-75.50958299999991;10.3181950000001,-75.50958299999991;10.3181950000001,-75.511253;10.3176390000001,-75.511253;10.3176390000001,-75.512085;10.3181950000001,-75.512085;10.3181950000001,-75.512641;10.317917,-75.512641;10.3179200000001,-75.5129169999999;10.3168070000002,-75.5129169999999;10.3168070000002,-75.512641;10.3165270000001,-75.512641;10.3165270000001,-75.5123589999999;10.316249,-75.5123589999999;10.316249,-75.512085;10.315695,-75.512085;10.315695,-75.5115269999999;10.3159730000001,-75.5115269999999;10.3159730000001,-75.510971;10.316249,-75.510971;10.316249,-75.5104149999999;10.3159730000001,-75.5104149999999;10.3159730000001,-75.50930700000001;10.315695,-75.50930700000001;10.315697,-75.50846799999989;10.3154170000001,-75.50846799999989;10.3154170000001,-75.5079189999999;10.315139,-75.5079189999999;10.315139,-75.50763599999991;10.3148610000001,-75.50763599999991;10.3148610000001,-75.5073629999999;10.314583,-75.5073629999999;10.314585,-75.5070799999999;10.3143050000001,-75.5070799999999;10.3143050000001,-75.506805;10.314027,-75.506805;10.3139790000001,-75.5065309999999;10.3137510000001,-75.5065309999999;10.3137510000001,-75.5062479999999;10.3131950000001,-75.5062479999999;10.3131950000001,-75.50597500000001;10.312917,-75.50597500000001;10.312917,-75.505692;10.311805,-75.505692;10.311805,-75.5054169999999;10.3115290000001,-75.5054169999999;10.3115290000001,-75.505143;10.311249,-75.505143;10.311249,-75.50485999999989;10.3104170000001,-75.50485999999989;10.3104170000001,-75.50458499999991;10.310139,-75.50458499999991;10.310139,-75.5043019999999;10.3098610000001,-75.5043019999999;10.3098610000001,-75.5040289999999;10.309029,-75.5040289999999;10.309029,-75.5037529999999;10.307917,-75.5037529999999;10.307917,-75.5040289999999;10.3073600000001,-75.5040289999999;10.3073600000001,-75.50458499999991;10.306807,-75.50458499999991;10.306807,-75.5043019999999;10.3065290000001,-75.5043019999999;10.3065290000001,-75.5040289999999;10.305972,-75.5040289999999;10.305972,-75.5037529999999;10.3045840000001,-75.5037529999999;10.3045840000001,-75.503472;10.30375,-75.503472;10.30375,-75.5031969999999;10.3018060000001,-75.5031969999999;10.3018060000001,-75.503472;10.3009720000001,-75.503472;10.3009720000001,-75.5037529999999;10.3006940000001,-75.5037529999999;10.3006940000001,-75.5040289999999;10.300416,-75.5040289999999;10.300418,-75.50458499999991;10.3001380000001,-75.50458499999991;10.3001380000001,-75.50485999999989;10.299862,-75.50485999999989;10.299862,-75.5054169999999;10.2995840000001,-75.5054169999999;10.2995840000001,-75.5070799999999;10.2993060000001,-75.5070799999999;10.2993060000001,-75.5073629999999;10.2995840000001,-75.5073629999999;10.2995840000001,-75.5079189999999;10.299862,-75.5079189999999;10.299862,-75.5081949999999;10.2995840000001,-75.5081949999999;10.2995840000001,-75.5087509999999;10.2993060000001,-75.5087509999999;10.2993060000001,-75.50930700000001;10.2990280000001,-75.50930700000001;10.2990280000001,-75.510139;10.2993060000001,-75.510139;10.2993060000001,-75.51069699999989;10.2995840000001,-75.51069699999989;10.2995840000001,-75.510971;10.3006940000001,-75.510971;10.3006940000001,-75.511253;10.3009720000001,-75.511253;10.3009720000001,-75.510971;10.3012500000001,-75.510971;10.3012500000001,-75.51069699999989;10.3018060000001,-75.51069699999989;10.3018060000001,-75.510139;10.3023620000001,-75.510139;10.3023620000001,-75.51069699999989;10.30264,-75.51069699999989;10.3026380000001,-75.5115269999999;10.3029160000001,-75.5115269999999;10.3029160000001,-75.512641;10.3026380000001,-75.512641;10.30264,-75.51319099999991;10.3023620000001,-75.51319099999991;10.3023620000001,-75.5156929999999;10.302082,-75.5156929999999;10.302084,-75.515976;10.3018060000001,-75.515976;10.3018060000001,-75.516808;10.301528,-75.516808;10.301528,-75.5173639999999;10.3012500000001,-75.5173639999999;10.3012500000001,-75.51764;10.3009720000001,-75.51764;10.3009720000001,-75.51791299999989;10.300418,-75.51791299999989;10.300418,-75.518196;10.3001380000001,-75.518196;10.3001380000001,-75.51847100000001;10.2993060000001,-75.51847100000001;10.2993060000001,-75.518196;10.2990280000001,-75.518196;10.2990280000001,-75.51791299999989;10.2993060000001,-75.51791299999989;10.2993060000001,-75.51764;10.2990280000001,-75.51764;10.2990280000001,-75.5173639999999;10.29875,-75.5173639999999;10.29875,-75.516808;10.2984720000001,-75.516808;10.2984720000001,-75.5165249999999;10.298196,-75.5165249999999;10.298196,-75.51625199999999;10.2979160000002,-75.51625199999999;10.2979160000002,-75.5165249999999;10.2976400000001,-75.5165249999999;10.2976400000001,-75.516808;10.2973620000001,-75.516808;10.2973620000001,-75.51708099999991;10.297084,-75.51708099999991;10.297084,-75.5173639999999;10.2968060000001,-75.5174089999999;10.2968060000001,-75.51764;10.2962500000002,-75.51764;10.2962500000002,-75.51791299999989;10.2959720000001,-75.51791299999989;10.2959720000001,-75.5187539999999;10.2962500000002,-75.5187539999999;10.2962500000002,-75.51902799999991;10.2968060000001,-75.51902799999991;10.2968060000001,-75.51930299999999;10.297084,-75.51930299999999;10.297084,-75.519584;10.2973620000001,-75.519584;10.2973620000001,-75.5198589999999;10.2976400000001,-75.5198589999999;10.2976400000001,-75.52014200000001;10.298196,-75.52014200000001;10.298196,-75.520416;10.29875,-75.520416;10.29875,-75.5212469999999;10.2976400000001,-75.5212469999999;10.2976400000001,-75.520974;10.297084,-75.520974;10.297084,-75.5206909999999;10.2968060000001,-75.5206909999999;10.2968060000001,-75.520416;10.296528,-75.520416;10.296528,-75.52014200000001;10.2959720000001,-75.52014200000001;10.2959720000001,-75.5197909999999;10.2959740000001,-75.519584;10.2956940000001,-75.519584;10.2956940000001,-75.51930299999999;10.2951400000001,-75.51930299999999;10.2951400000001,-75.5198589999999;10.294862,-75.5198589999999;10.294862,-75.520416;10.2945840000002,-75.520416;10.2945840000002,-75.520974;10.2943060000001,-75.520974;10.2943060000001,-75.5215299999999;10.2945840000002,-75.5215299999999;10.2945840000002,-75.5223619999999;10.294862,-75.5223619999999;10.294862,-75.52263499999999;10.2949760000001,-75.52263499999999;10.2951400000001,-75.52263499999999;10.2951400000001,-75.523476;10.295418,-75.523476;10.295418,-75.52375000000001;10.2956940000001,-75.52375000000001;10.2956940000001,-75.52402599999991;10.2959740000001,-75.52402599999991;10.2959720000001,-75.52430800000001;10.296528,-75.52430800000001;10.296528,-75.524582;10.2968060000001,-75.524582;10.2968060000001,-75.52486399999989;10.297084,-75.52486399999989;10.297084,-75.525138;10.2976400000001,-75.525138;10.2976400000001,-75.525414;10.2984720000001,-75.525414;10.2984720000001,-75.5256959999999;10.2995840000001,-75.5256959999999;10.2995840000001,-75.525414;10.3001380000001,-75.525414;10.3001380000001,-75.525138;10.300418,-75.525138;10.300416,-75.52486399999989;10.3006940000001,-75.52486399999989;10.3006940000001,-75.524582;10.3012500000001,-75.524582;10.3012500000001,-75.525138;10.301528,-75.525138;10.301528,-75.525414;10.3018060000001,-75.525414;10.3018060000001,-75.5262519999999;10.302084,-75.5262519999999;10.302084,-75.5265279999999;10.30264,-75.5265279999999;10.30264,-75.5273599999999;10.3018060000001,-75.5273599999999;10.3018060000001,-75.5270839999999;10.300416,-75.5270839999999;10.300418,-75.526802;10.29875,-75.526802;10.29875,-75.5265279999999;10.2973620000001,-75.5265279999999;10.2973620000001,-75.5262519999999;10.2962500000002,-75.5262519999999;10.2962500000002,-75.52597;10.2956940000001,-75.52597;10.2956940000001,-75.5256959999999;10.2951400000001,-75.5256959999999;10.2951400000001,-75.525414;10.294862,-75.525414;10.294862,-75.525138;10.2945840000002,-75.525138;10.2945840000002,-75.52486399999989;10.2940730000001,-75.52486399999989;10.2934710000001,-75.52486399999989;10.2934710000001,-75.524582;10.292639,-75.524582;10.292639,-75.52430800000001;10.2915270000001,-75.52430800000001;10.2915270000001,-75.52402599999991;10.2906930000001,-75.52402599999991;10.2906930000001,-75.52375000000001;10.2895830000001,-75.52375000000001;10.2895830000001,-75.523476;10.288749,-75.523476;10.288749,-75.52402599999991;10.289305,-75.52402599999991;10.289305,-75.52430800000001;10.2898610000001,-75.52430800000001;10.2898610000001,-75.524582;10.290417,-75.524582;10.290417,-75.52486399999989;10.2912490000001,-75.52486399999989;10.2912490000001,-75.525138;10.2918050000001,-75.525138;10.2918050000001,-75.525414;10.292639,-75.525414;10.292639,-75.5256959999999;10.2937220000001,-75.5256959999999;10.2943080000001,-75.5256959999999;10.2943060000001,-75.52597;10.2945840000002,-75.52597;10.2945840000002,-75.5262519999999;10.2951400000001,-75.5262519999999;10.2951400000001,-75.5265279999999;10.2956940000001,-75.5265279999999;10.2956940000001,-75.526802;10.296528,-75.526802;10.296528,-75.5270839999999;10.2976400000001,-75.5270839999999;10.2976400000001,-75.5273599999999;10.2984720000001,-75.5273599999999;10.2984720000001,-75.52764000000001;10.29875,-75.52764000000001;10.29875,-75.52791599999991;10.2990280000001,-75.52791599999991;10.2990280000001,-75.5281989999999;10.2993060000001,-75.5281989999999;10.2993060000001,-75.52847199999999;10.2995840000001,-75.52847199999999;10.2995840000001,-75.5290309999999;10.299862,-75.5290309999999;10.299862,-75.529304;10.3001380000001,-75.529304;10.3001380000001,-75.530136;10.2993060000001,-75.530136;10.2993060000001,-75.52986299999991;10.2990280000001,-75.52986299999991;10.2990280000001,-75.529304;10.2984720000001,-75.529304;10.2984720000001,-75.5290309999999;10.2973620000001,-75.5290309999999;10.2973620000001,-75.52874799999999;10.2962500000002,-75.52874799999999;10.2962500000002,-75.52847199999999;10.2956940000001,-75.52847199999999;10.2956940000001,-75.5281989999999;10.2951400000001,-75.5281989999999;10.2951400000001,-75.52791599999991;10.2929150000001,-75.52791599999991;10.2929150000001,-75.5281989999999;10.2926620000001,-75.5281989999999;10.2912490000001,-75.5281989999999;10.2912490000001,-75.52847199999999;10.290971,-75.52847199999999;10.290973,-75.5290309999999;10.2906930000001,-75.5290309999999;10.2906930000001,-75.52958699999991;10.290417,-75.52958699999991;10.290417,-75.530136;10.2901390000001,-75.530136;10.2901390000001,-75.5309749999999;10.2898610000001,-75.5309749999999;10.2898610000001,-75.5312509999999;10.2895830000001,-75.5312509999999;10.2895830000001,-75.53152399999991;10.289305,-75.53152399999991;10.289305,-75.5320819999999;10.2890270000001,-75.5320819999999;10.2890270000001,-75.532639;10.288749,-75.532639;10.288749,-75.53291399999991;10.2884730000001,-75.53291399999991;10.2884730000001,-75.533753;10.2881950000001,-75.533753;10.2881950000001,-75.5340269999999;10.287917,-75.5340269999999;10.287917,-75.534302;10.287639,-75.534302;10.287639,-75.53458499999989;10.2873610000001,-75.53458499999989;10.2873610000001,-75.5348579999999;10.287083,-75.5348579999999;10.287083,-75.5351409999999;10.2868050000001,-75.5351409999999;10.2868050000001,-75.5354149999999;10.2865270000001,-75.5354149999999;10.2865270000001,-75.53624599999991;10.2868050000001,-75.53624599999991;10.2868050000001,-75.5365289999999;10.2865270000001,-75.5365289999999;10.2865270000001,-75.536805;10.286251,-75.536805;10.286251,-75.537087;10.285973,-75.537087;10.285973,-75.53736099999991;10.2856950000001,-75.53736099999991;10.2856950000001,-75.537637;10.285417,-75.537637;10.285417,-75.53791699999989;10.2851390000001,-75.53791699999989;10.2851410000001,-75.53819299999989;10.2848610000001,-75.53819299999989;10.2848610000001,-75.53847499999991;10.2845830000001,-75.53847499999991;10.284585,-75.5387489999999;10.284305,-75.5387489999999;10.284305,-75.5395809999999;10.2840290000001,-75.5395809999999;10.2840290000001,-75.5398629999999;10.283749,-75.5398629999999;10.283749,-75.5404129999999;10.2834730000001,-75.5404129999999;10.2834730000001,-75.540969;10.2831950000001,-75.540969;10.2831950000001,-75.541251;10.2829170000001,-75.541251;10.282919,-75.5418099999999;10.282639,-75.5418099999999;10.282639,-75.5426419999999;10.2823610000001,-75.5426419999999;10.2823630000001,-75.54402999999991;10.282083,-75.54402999999991;10.282083,-75.544586;10.2818070000001,-75.544586;10.2818070000001,-75.5443029999999;10.2815260000001,-75.5443029999999;10.2815260000001,-75.5437469999999;10.2818070000001,-75.5437469999999;10.2818070000001,-75.5426419999999;10.282083,-75.5426419999999;10.282083,-75.5415269999999;10.282639,-75.5415269999999;10.282639,-75.541251;10.2823610000001,-75.541251;10.2823610000001,-75.540969;10.282639,-75.540969;10.282639,-75.5404129999999;10.282919,-75.5404129999999;10.2829170000001,-75.5398629999999;10.2831950000001,-75.5398629999999;10.2831950000001,-75.5390249999999;10.2834730000001,-75.5390249999999;10.2834730000001,-75.53847499999991;10.2840290000001,-75.53847499999991;10.2840290000001,-75.53791699999989;10.284305,-75.53791699999989;10.284305,-75.537087;10.284585,-75.537087;10.284585,-75.536805;10.2851410000001,-75.536805;10.2851390000001,-75.5359729999999;10.285417,-75.5359729999999;10.285417,-75.5348579999999;10.2851390000001,-75.5348579999999;10.2851410000001,-75.53458499999989;10.284585,-75.53458499999989;10.284585,-75.534302;10.284305,-75.534302;10.284305,-75.5340269999999;10.283749,-75.5340269999999;10.283749,-75.533753;10.2834730000001,-75.533753;10.2834730000001,-75.53346999999999;10.282919,-75.53346999999999;10.282919,-75.53319499999991;10.282639,-75.53319499999991;10.282639,-75.53291399999991;10.2823610000001,-75.53291399999991;10.2823630000001,-75.532639;10.2815260000001,-75.532639;10.2815260000001,-75.5323629999999;10.2812510000001,-75.5323629999999;10.281205,-75.5320819999999;10.2804160000001,-75.5320819999999;10.2804160000001,-75.5323629999999;10.279582,-75.5323629999999;10.2795850000001,-75.532639;10.279028,-75.532639;10.279028,-75.53319499999991;10.2781940000001,-75.53319499999991;10.2781940000001,-75.53346999999999;10.2776380000001,-75.53346999999999;10.2776380000001,-75.533753;10.27736,-75.533753;10.277362,-75.534302;10.2770840000001,-75.534302;10.2770840000001,-75.5348579999999;10.276806,-75.5348579999999;10.2768090000001,-75.5359729999999;10.276252,-75.5359729999999;10.276252,-75.5365289999999;10.2768090000001,-75.5365289999999;10.2768090000001,-75.536805;10.2765280000001,-75.536805;10.2765280000001,-75.53847499999991;10.27625,-75.53847499999991;10.276252,-75.5387489999999;10.2759720000001,-75.5387489999999;10.2759720000001,-75.53930699999989;10.276252,-75.53930699999989;10.276252,-75.5401389999999;10.2759720000001,-75.5401389999999;10.2759720000001,-75.5404129999999;10.275694,-75.5404129999999;10.275694,-75.541251;10.276252,-75.541251;10.27625,-75.54235899999991;10.2765280000001,-75.54235899999991;10.2765280000001,-75.544586;10.2768090000001,-75.544586;10.276806,-75.5448619999999;10.2770840000001,-75.5448619999999;10.2770840000001,-75.545135;10.277362,-75.545135;10.27736,-75.545418;10.2776380000001,-75.545418;10.2776380000001,-75.5456929999999;10.278472,-75.5456929999999;10.278472,-75.545418;10.2789670000001,-75.545418;10.279307,-75.545418;10.279307,-75.5456929999999;10.2795850000001,-75.5456929999999;10.279582,-75.54625;10.2798600000001,-75.54625;10.2798600000001,-75.54708099999991;10.279307,-75.54708099999991;10.279307,-75.54792000000001;10.279028,-75.54792000000001;10.279028,-75.5484689999999;10.2787500000001,-75.5484689999999;10.2787500000001,-75.5490259999999;10.278472,-75.5490259999999;10.278472,-75.5498569999999;10.2781940000001,-75.5498569999999;10.2781940000001,-75.5501399999999;10.277916,-75.5501399999999;10.2779190000001,-75.550698;10.2776380000001,-75.550698;10.2776380000001,-75.551248;10.27736,-75.551248;10.277362,-75.55152800000001;10.2770840000001,-75.55152800000001;10.2770840000001,-75.55263599999989;10.276806,-75.55263599999989;10.2768090000001,-75.5534739999999;10.2765280000001,-75.5534739999999;10.2765280000001,-75.55403;10.27625,-75.55403;10.276252,-75.55458;10.2759720000001,-75.55458;10.2759720000001,-75.555421;10.275694,-75.555421;10.275694,-75.5559699999999;10.2754160000001,-75.5559699999999;10.2754160000001,-75.55652600000001;10.275138,-75.55652600000001;10.275138,-75.55708199999999;10.2748620000001,-75.55708199999999;10.2748620000001,-75.55735799999989;10.2743060000001,-75.55735799999989;10.2743060000001,-75.557914;10.2737500000001,-75.557914;10.2737500000001,-75.55847299999991;10.273472,-75.55847299999991;10.273474,-75.558746;10.2731940000001,-75.558746;10.2731940000001,-75.559029;10.272916,-75.559029;10.272918,-75.5593039999999;10.2726400000001,-75.5593039999999;10.2726400000001,-75.559585;10.27236,-75.559585;10.272362,-75.559861;10.2720840000001,-75.559861;10.2720840000001,-75.5601429999999;10.271806,-75.5601429999999;10.271806,-75.560692;10.27125,-75.560692;10.27125,-75.561249;10.2709720000001,-75.561249;10.2709720000001,-75.5615309999999;10.2704160000001,-75.5615309999999;10.2704160000001,-75.56208;10.2698620000001,-75.56208;10.2698620000001,-75.5626369999999;10.269584,-75.5626369999999;10.269584,-75.56319499999999;10.2698620000001,-75.56319499999999;10.2698620000001,-75.563751;10.27014,-75.563751;10.27014,-75.564027;10.2704160000001,-75.564027;10.2704160000001,-75.5643069999999;10.270694,-75.5643069999999;10.270694,-75.564583;10.2709720000001,-75.564583;10.2709720000001,-75.565415;10.27125,-75.565415;10.27125,-75.5656969999999;10.2709720000001,-75.5656969999999;10.2709720000001,-75.5665289999999;10.270694,-75.5665289999999;10.270694,-75.5676409999999;10.2704160000001,-75.5676409999999;10.2704160000001,-75.56791699999999;10.27014,-75.56791699999999;10.27014,-75.568191;10.269584,-75.568191;10.269584,-75.5684729999999;10.2693060000001,-75.5684729999999;10.2693060000001,-75.5704199999999;10.269584,-75.5704199999999;10.269584,-75.57096899999991;10.2698620000001,-75.57096899999991;10.2698620000001,-75.57152499999999;10.27014,-75.57152499999999;10.27014,-75.5720839999999;10.2704160000001,-75.5720839999999;10.2704160000001,-75.57263999999989;10.270694,-75.57263999999989;10.270694,-75.5734719999999;10.2709720000001,-75.5734719999999;10.2709720000001,-75.5740279999999;10.27125,-75.5740279999999;10.27125,-75.5745859999999;10.271806,-75.5745859999999;10.271806,-75.5751419999999;10.2720840000001,-75.5751419999999;10.2720840000001,-75.57541599999991;10.2726400000001,-75.57541599999991;10.2726400000001,-75.5759739999999;10.2731940000001,-75.5759739999999;10.2731940000001,-75.57624800000001;10.273474,-75.57624800000001;10.273472,-75.57652999999991;10.2737500000001,-75.57652999999991;10.2737500000001,-75.57680599999991;10.274028,-75.57680599999991;10.274028,-75.577079;10.2743060000001,-75.577079;10.2743060000001,-75.57736199999989;10.274582,-75.57736199999989;10.274582,-75.57763799999989;10.2748620000001,-75.57763799999989;10.2748620000001,-75.5779179999999;10.275138,-75.5779179999999;10.275138,-75.5781939999999;10.2754160000001,-75.5781939999999;10.2754160000001,-75.57847700000001;10.2759720000001,-75.57847700000001;10.2759720000001,-75.5795819999999;10.276252,-75.5795819999999;10.276252,-75.579864;10.2768090000001,-75.579864;10.276806,-75.5801399999999;10.2770840000001,-75.5801399999999;10.2770840000001,-75.58041399999991;10.277362,-75.58041399999991;10.27736,-75.580696;10.2781940000001,-75.580696;10.2781940000001,-75.58096999999989;10.2787500000001,-75.58096999999989;10.2787500000001,-75.58125199999991;10.2795850000001,-75.58125199999991;10.279582,-75.58096999999989;10.2798600000001,-75.58096999999989;10.2798600000001,-75.58041399999991;10.2812510000001,-75.58041399999991;10.2812510000001,-75.580696;10.2818070000001,-75.580696;10.2818070000001,-75.58125199999991;10.282083,-75.58125199999991;10.282083,-75.5818019999999;10.2823630000001,-75.5818019999999;10.2823610000001,-75.5820839999999;10.282639,-75.5820839999999;10.282639,-75.5823599999999;10.282919,-75.5823599999999;10.2829170000001,-75.5826399999999;10.284305,-75.5826399999999;10.284305,-75.5820839999999;10.284585,-75.5820839999999;10.2845830000001,-75.5818019999999;10.2848610000001,-75.5818019999999;10.2848610000001,-75.58152799999991;10.285417,-75.58152799999991;10.285417,-75.58125199999991;10.2856950000001,-75.58125199999991;10.2856950000001,-75.580696;10.285973,-75.580696;10.285973,-75.58041399999991;10.286251,-75.58041399999991;10.286251,-75.5801399999999;10.2868050000001,-75.5801399999999;10.2868050000001,-75.579819;10.2868050000001,-75.5795819999999;10.286251,-75.5795819999999;10.286251,-75.57847700000001;10.2868050000001,-75.57847700000001;10.2868050000001,-75.5781939999999;10.287917,-75.5781939999999;10.287917,-75.57847700000001;10.2884730000001,-75.57847700000001;10.2884730000001,-75.5787499999999;10.289239,-75.5787499999999;10.2901390000001,-75.5787499999999;10.2901390000001,-75.5790259999999;10.2906930000001,-75.5790259999999;10.2906930000001,-75.5787499999999;10.290973,-75.5787499999999;10.290971,-75.5790259999999;10.2918050000001,-75.5790259999999;10.2918050000001,-75.5787499999999;10.292361,-75.5787499999999;10.292361,-75.5781939999999;10.292639,-75.5781939999999;10.292639,-75.5779179999999;10.293196,-75.5779179999999;10.293196,-75.57763799999989;10.2934710000001,-75.57763799999989;10.2934710000001,-75.5779179999999;10.2945840000002,-75.5779179999999;10.2945840000002,-75.57763799999989;10.294862,-75.57763799999989;10.294862,-75.5779179999999;10.2951400000001,-75.5779179999999;10.2951400000001,-75.5781939999999;10.295418,-75.5781939999999;10.295418,-75.57847700000001;10.2956940000001,-75.57847700000001;10.2956940000001,-75.5801399999999;10.295418,-75.5801399999999;10.295418,-75.58096999999989;10.2959740000001,-75.58096999999989;10.2959720000001,-75.580696;10.2962500000002,-75.580696;10.2962500000002,-75.58041399999991;10.296528,-75.58041399999991;10.296528,-75.579864;10.2968060000001,-75.579864;10.2968060000001,-75.5795819999999;10.297084,-75.5795819999999;10.297084,-75.5787499999999;10.2973620000001,-75.5787499999999;10.2973620000001,-75.57847700000001;10.2976400000001,-75.57847700000001;10.2976400000001,-75.5781939999999;10.297884,-75.5781939999999;10.2984720000001,-75.5781939999999;10.2984720000001,-75.57847700000001;10.2987250000001,-75.57847700000001;10.299862,-75.57847700000001;10.299862,-75.5787499999999;10.300418,-75.5787499999999;10.300416,-75.579039;10.300418,-75.5801399999999;10.3001380000001,-75.5801399999999;10.3001380000001,-75.58041399999991;10.299862,-75.58041399999991;10.299862,-75.580696;10.2995840000001,-75.580696;10.2995840000001,-75.58096999999989;10.2993060000001,-75.58096999999989;10.2993060000001,-75.58125199999991;10.2990280000001,-75.58125199999991;10.2990280000001,-75.5818019999999;10.29875,-75.5818019999999;10.29875,-75.5820839999999;10.2984720000001,-75.5820839999999;10.2984720000001,-75.5826399999999;10.298196,-75.5826399999999;10.298196,-75.5831919999999;10.2979160000002,-75.5831919999999;10.2979160000002,-75.5834719999999;10.298196,-75.5834719999999;10.298196,-75.584863;10.2984720000001,-75.584863;10.2984720000001,-75.5865239999999;10.298196,-75.5865239999999;10.298196,-75.58680699999999;10.2979160000002,-75.58680699999999;10.2979160000002,-75.58708299999989;10.2976400000001,-75.58708299999989;10.2976400000001,-75.58736500000001;10.297084,-75.58736500000001;10.297084,-75.587639;10.2968060000001,-75.587639;10.2968060000001,-75.5879139999999;10.296528,-75.5879139999999;10.296528,-75.5887529999999;10.2962500000002,-75.5887529999999;10.2962500000002,-75.589027;10.2959720000001,-75.589027;10.2959740000001,-75.5893019999999;10.295418,-75.5893019999999;10.295418,-75.5895849999999;10.2951400000001,-75.5895849999999;10.2951400000001,-75.589859;10.294862,-75.589859;10.294862,-75.590141;10.2945840000002,-75.590141;10.2945840000002,-75.5904169999999;10.2943060000001,-75.5904169999999;10.2943080000001,-75.59069700000001;10.294027,-75.59069700000001;10.294027,-75.59097300000001;10.293196,-75.59097300000001;10.293196,-75.5912469999999;10.292639,-75.5912469999999;10.292639,-75.59152899999999;10.2918050000001,-75.59152899999999;10.2918050000001,-75.59180499999999;10.290971,-75.59180499999999;10.290973,-75.5920879999999;10.289305,-75.5920879999999;10.289305,-75.592361;10.288749,-75.592361;10.288749,-75.592637;10.2884730000001,-75.592637;10.2884730000001,-75.5929189999999;10.2865270000001,-75.5929189999999;10.2865270000001,-75.593193;10.285973,-75.593193;10.285973,-75.593475;10.2856950000001,-75.593475;10.2856950000001,-75.5937489999999;10.285417,-75.5937489999999;10.285417,-75.594025;10.2848610000001,-75.594025;10.2848610000001,-75.594307;10.283749,-75.594307;10.283749,-75.594025;10.2831950000001,-75.594025;10.2831950000001,-75.594307;10.282639,-75.594307;10.282639,-75.59458099999991;10.282083,-75.59458099999991;10.282083,-75.594863;10.2818070000001,-75.594863;10.2818070000001,-75.595139;10.2812510000001,-75.595139;10.2812510000001,-75.59541299999989;10.2806950000001,-75.59541299999989;10.2806950000001,-75.59569500000001;10.2804160000001,-75.59569500000001;10.2804160000001,-75.59597100000001;10.280138,-75.59597100000001;10.2801410000001,-75.5962509999999;10.2779190000001,-75.5962509999999;10.2779190000001,-75.59597100000001;10.2776380000001,-75.59597100000001;10.2776380000001,-75.59569500000001;10.27736,-75.59569500000001;10.277362,-75.59541299999989;10.2768090000001,-75.59541299999989;10.2768090000001,-75.595139;10.276252,-75.595139;10.276252,-75.594863;10.2759720000001,-75.594863;10.2759720000001,-75.59458099999991;10.275694,-75.59458099999991;10.275694,-75.594307;10.2754160000001,-75.594307;10.2754160000001,-75.594025;10.2748620000001,-75.594025;10.2748620000001,-75.5937489999999;10.274582,-75.5937489999999;10.274582,-75.594025;10.2743060000001,-75.594025;10.2743060000001,-75.5937489999999;10.272916,-75.5937489999999;10.272918,-75.593475;10.272362,-75.593475;10.272362,-75.5937489999999;10.271804,-75.5937489999999;10.271806,-75.594025;10.2709720000001,-75.594025;10.2709720000001,-75.594307;10.27014,-75.594307;10.27014,-75.59458099999991;10.2681930000001,-75.59458099999991;10.2681930000001,-75.594863;10.267918,-75.594863;10.267918,-75.595139;10.2676400000001,-75.595139;10.2676400000001,-75.59458099999991;10.2670840000001,-75.59458099999991;10.2670840000001,-75.594307;10.2665270000001,-75.594307;10.2665300000001,-75.594025;10.2662490000001,-75.594025;10.2662490000001,-75.5937489999999;10.265971,-75.5937489999999;10.265971,-75.593475;10.265696,-75.593475;10.265696,-75.592637;10.265417,-75.592637;10.265417,-75.5920879999999;10.2651390000001,-75.5920879999999;10.2651390000001,-75.59180499999999;10.2648610000001,-75.59180499999999;10.2648610000001,-75.59152899999999;10.2645830000001,-75.59152899999999;10.2645830000001,-75.5912469999999;10.2640270000001,-75.5912469999999;10.2640270000001,-75.59095000000001;10.2640270000001,-75.59069700000001;10.263749,-75.59069700000001;10.263751,-75.5893019999999;10.2634730000001,-75.5893019999999;10.2634730000001,-75.5879139999999;10.2631930000001,-75.5879139999999;10.2631950000001,-75.58680699999999;10.2629170000001,-75.58680699999999;10.2629170000001,-75.5856919999999;10.262639,-75.5856919999999;10.262639,-75.5854189999999;10.2612490000001,-75.5854189999999;10.2612490000001,-75.58597500000001;10.260971,-75.58597500000001;10.260971,-75.58680699999999;10.2612490000001,-75.58680699999999;10.2612490000001,-75.587639;10.2615290000001,-75.587639;10.2615270000001,-75.5887529999999;10.2618050000002,-75.5887529999999;10.2618050000002,-75.589027;10.262083,-75.589027;10.262083,-75.5893019999999;10.2623610000001,-75.5893019999999;10.2623610000001,-75.59069700000001;10.262639,-75.59069700000001;10.262639,-75.59097300000001;10.2629170000001,-75.59097300000001;10.2629170000001,-75.5912469999999;10.2634730000001,-75.5912469999999;10.2634730000001,-75.59180499999999;10.263751,-75.59180499999999;10.263751,-75.592361;10.2634730000001,-75.592361;10.2634730000001,-75.593193;10.263751,-75.593193;10.263749,-75.594025;10.2640270000001,-75.594025;10.2640270000001,-75.594863;10.263749,-75.594863;10.263751,-75.595139;10.2634730000001,-75.595139;10.2634730000001,-75.59541299999989;10.2631930000001,-75.59541299999989;10.2631950000001,-75.59569500000001;10.2629170000001,-75.59569500000001;10.2629170000001,-75.59597100000001;10.2623610000001,-75.59597100000001;10.2623610000001,-75.5962509999999;10.2618050000002,-75.5962509999999;10.2618050000002,-75.596527;10.2615270000001,-75.596527;10.2615290000001,-75.5970829999999;10.2612490000001,-75.5970829999999;10.2612490000001,-75.597359;10.260971,-75.597359;10.260973,-75.59764199999999;10.2606950000001,-75.59764199999999;10.2606950000001,-75.5979149999999;10.2601390000002,-75.5979149999999;10.2601390000002,-75.598198;10.2598610000001,-75.598198;10.2598610000001,-75.598474;10.2595830000001,-75.598474;10.2595830000001,-75.5987469999999;10.259305,-75.5987469999999;10.259307,-75.59930300000001;10.259182,-75.59930300000001;10.2590269999999,-75.59930300000001;10.2590269999999,-75.6015779999999;10.2590269999999,-75.601806;10.259307,-75.601806;10.259307,-75.6029129999999;10.2590269999999,-75.6029129999999;10.2590269999999,-75.603196;10.259307,-75.603196;10.259307,-75.60485799999999;10.2590269999999,-75.60485799999999;10.2590269999999,-75.6056279999999;10.2590269999999,-75.606528;10.258751,-75.606528;10.258751,-75.60736;10.2584730000002,-75.60736;10.2584730000002,-75.6079179999999;10.2581950000001,-75.6079179999999;10.2581950000001,-75.60902400000001;10.2584730000002,-75.60902400000001;10.2584730000002,-75.61013799999991;10.258751,-75.61013799999991;10.258751,-75.6106939999999;10.2590269999999,-75.6106939999999;10.2590269999999,-75.611526;10.259307,-75.611526;10.259305,-75.61180899999989;10.2595830000001,-75.61180899999989;10.2595830000001,-75.6120819999999;10.2598610000001,-75.6120819999999;10.2598610000001,-75.6126409999999;10.2601390000002,-75.6126409999999;10.2601390000002,-75.6130209999999;10.2601390000002,-75.6134729999999;10.2598060000001,-75.6134729999999;10.2595830000001,-75.6134729999999;10.2595830000001,-75.61374599999991;10.259305,-75.61374599999991;10.259307,-75.6134729999999;10.2590269999999,-75.6134729999999;10.2590269999999,-75.61374599999991;10.258751,-75.61374599999991;10.258751,-75.6143049999999;10.2584730000002,-75.6143049999999;10.2584730000002,-75.615264;10.2584730000002,-75.61541699999989;10.2583610000001,-75.61541699999989;10.2581950000001,-75.61541699999989;10.2581950000001,-75.615647;10.2581950000001,-75.6162489999999;10.257746,-75.6162489999999;10.2568050000002,-75.6162489999999;10.2568050000002,-75.6165309999999;10.2562510000001,-75.6165309999999;10.2562510000001,-75.6168069999999;10.255973,-75.6168069999999;10.255973,-75.6170809999999;10.2556949999999,-75.6170809999999;10.2556949999999,-75.6173629999999;10.255417,-75.6173629999999;10.255419,-75.6176369999999;10.2548630000001,-75.6176369999999;10.2548630000001,-75.617919;10.2545820000001,-75.617919;10.2545820000001,-75.6181949999999;10.2540260000001,-75.6181949999999;10.2540260000001,-75.61846799999999;10.253751,-75.61846799999999;10.253751,-75.6190269999999;10.2534730000002,-75.6190269999999;10.2534730000002,-75.619309;10.253194,-75.619309;10.253194,-75.61958299999991;10.2529160000001,-75.61958299999991;10.2529160000001,-75.6201389999999;10.252638,-75.6201389999999;10.252641,-75.62069699999989;10.2523600000001,-75.62069699999989;10.2523600000001,-75.6212469999999;10.252085,-75.6212469999999;10.252085,-75.622085;10.251804,-75.622085;10.251804,-75.6223609999999;10.2512500000001,-75.6223609999999;10.2512500000001,-75.622085;10.2506940000001,-75.622085;10.2506940000001,-75.6218029999999;10.2487500000001,-75.6218029999999;10.2487500000001,-75.6215289999999;10.248194,-75.6215289999999;10.248194,-75.6209709999999;10.2479160000001,-75.6209709999999;10.2479160000001,-75.619309;10.247638,-75.619309;10.247638,-75.6187509999999;10.246806,-75.6187509999999;10.246806,-75.61846799999999;10.2462500000001,-75.61846799999999;10.2462500000001,-75.6170809999999;10.246528,-75.6170809999999;10.246528,-75.6168069999999;10.2462500000001,-75.6168069999999;10.2462500000001,-75.61597499999991;10.245972,-75.61597499999991;10.245972,-75.61569299999989;10.2456940000001,-75.61569299999989;10.2456940000001,-75.61458499999991;10.245972,-75.61458499999991;10.245972,-75.6140289999999;10.2456940000001,-75.6140289999999;10.2456940000001,-75.6131969999999;10.245416,-75.6131969999999;10.245416,-75.6126409999999;10.24514,-75.6126409999999;10.24514,-75.61180899999989;10.24486,-75.61180899999989;10.24486,-75.61097;10.2445840000001,-75.61097;10.2445840000001,-75.6106939999999;10.244306,-75.6106939999999;10.244306,-75.6104209999999;10.2440280000001,-75.6104209999999;10.2440300000001,-75.61013799999991;10.243474,-75.61013799999991;10.243474,-75.60986199999989;10.243194,-75.60986199999989;10.243194,-75.6095799999999;10.2429180000001,-75.6095799999999;10.2429180000001,-75.6093059999999;10.242638,-75.6093059999999;10.242638,-75.60902400000001;10.242084,-75.60902400000001;10.242084,-75.6084739999999;10.2418060000001,-75.6084739999999;10.241808,-75.608192;10.241528,-75.608192;10.241528,-75.6079179999999;10.2412500000001,-75.6079179999999;10.2412520000001,-75.607636;10.2409710000001,-75.607636;10.2409710000001,-75.6070859999999;10.240418,-75.6070859999999;10.240418,-75.60624799999989;10.2401400000001,-75.60624799999989;10.2401400000001,-75.60597199999999;10.239862,-75.60597199999999;10.239862,-75.6056989999999;10.239583,-75.6056989999999;10.239583,-75.60541599999991;10.2393050000001,-75.60541599999991;10.2393050000001,-75.60513999999991;10.239027,-75.60513999999991;10.2390300000001,-75.60485799999999;10.2387490000001,-75.60485799999999;10.2387490000001,-75.6045839999999;10.2393050000001,-75.6045839999999;10.2393050000001,-75.6043079999999;10.239583,-75.6043079999999;10.239583,-75.6037519999999;10.239862,-75.6037519999999;10.239862,-75.60347;10.2401400000001,-75.60347;10.2401400000001,-75.601806;10.239862,-75.601806;10.239862,-75.60124999999989;10.2401400000001,-75.60124999999989;10.2401400000001,-75.600694;10.239862,-75.600694;10.239862,-75.60041799999991;10.2401400000001,-75.60041799999991;10.2401400000001,-75.599862;10.239862,-75.599862;10.239862,-75.59930300000001;10.239583,-75.59930300000001;10.239583,-75.5987469999999;10.2393050000001,-75.5987469999999;10.2393050000001,-75.598198;10.239583,-75.598198;10.239583,-75.5979149999999;10.2393050000001,-75.5979149999999;10.2393050000001,-75.59764199999999;10.2387490000001,-75.59764199999999;10.2387490000001,-75.597359;10.2390300000001,-75.597359;10.2390300000001,-75.59569500000001;10.2384740000001,-75.59569500000001;10.2384740000001,-75.594307;10.2381950000001,-75.594307;10.2381950000001,-75.59458099999991;10.237361,-75.59458099999991;10.237361,-75.594307;10.236807,-75.594307;10.236807,-75.593475;10.2365270000001,-75.593475;10.2365270000001,-75.59180499999999;10.236249,-75.59180499999999;10.236249,-75.59152899999999;10.2365270000001,-75.59152899999999;10.2365270000001,-75.59097300000001;10.236249,-75.59097300000001;10.236251,-75.59069700000001;10.2359730000001,-75.59069700000001;10.2359730000001,-75.5895849999999;10.2354170000001,-75.5895849999999;10.2354170000001,-75.589027;10.235139,-75.589027;10.235139,-75.5884709999999;10.2348610000001,-75.5884709999999;10.2348610000001,-75.588195;10.2343050000001,-75.588195;10.2343050000001,-75.5879139999999;10.234583,-75.5879139999999;10.234583,-75.587639;10.2337510000001,-75.587639;10.2337510000001,-75.58736500000001;10.233471,-75.58736500000001;10.233473,-75.587639;10.232919,-75.587639;10.232919,-75.58736500000001;10.231807,-75.58736500000001;10.231807,-75.58708299999989;10.230695,-75.58708299999989;10.230695,-75.58680699999999;10.2304170000001,-75.58680699999999;10.2304170000001,-75.58708299999989;10.230139,-75.58708299999989;10.230139,-75.58680699999999;10.229583,-75.58680699999999;10.229583,-75.5865239999999;10.2293050000001,-75.5865239999999;10.2293050000001,-75.58625099999991;10.228473,-75.58625099999991;10.228473,-75.58597500000001;10.227917,-75.58597500000001;10.227917,-75.5856919999999;10.2270820000001,-75.5856919999999;10.2270820000001,-75.58597500000001;10.2265290000001,-75.58597500000001;10.2265290000001,-75.5865239999999;10.226251,-75.5865239999999;10.226251,-75.58680699999999;10.2256940000001,-75.58680699999999;10.2256940000001,-75.587639;10.2251380000001,-75.587639;10.2251380000001,-75.588195;10.2254160000001,-75.588195;10.2254160000001,-75.59069700000001;10.2256940000001,-75.59069700000001;10.2256940000001,-75.59097300000001;10.225972,-75.59097300000001;10.225972,-75.5912469999999;10.226251,-75.5912469999999;10.226251,-75.59152899999999;10.226807,-75.59152899999999;10.226807,-75.59180499999999;10.2273600000001,-75.59180499999999;10.2273600000001,-75.59069700000001;10.2276390000001,-75.59069700000001;10.2276390000001,-75.590141;10.227917,-75.590141;10.227917,-75.5895849999999;10.2281950000001,-75.5895849999999;10.2281950000001,-75.5893019999999;10.228473,-75.5893019999999;10.228473,-75.587639;10.229583,-75.587639;10.229583,-75.5879139999999;10.2298610000001,-75.5879139999999;10.2298610000001,-75.588195;10.230139,-75.588195;10.230139,-75.5884709999999;10.2304170000001,-75.5884709999999;10.2304170000001,-75.5895849999999;10.230695,-75.5895849999999;10.230695,-75.59069700000001;10.2309730000001,-75.59069700000001;10.2309730000001,-75.59152899999999;10.231249,-75.59152899999999;10.231249,-75.5920879999999;10.2315270000001,-75.5920879999999;10.2315270000001,-75.593193;10.231807,-75.593193;10.231805,-75.5937489999999;10.2320830000001,-75.5937489999999;10.2320830000001,-75.59541299999989;10.232363,-75.59541299999989;10.232361,-75.5962509999999;10.2326390000001,-75.5962509999999;10.2326390000001,-75.596527;10.232361,-75.596527;10.232363,-75.5968009999999;10.2320830000001,-75.5968009999999;10.2320830000001,-75.5970829999999;10.231805,-75.5970829999999;10.231807,-75.597359;10.2315270000001,-75.597359;10.2315270000001,-75.59764199999999;10.231249,-75.59764199999999;10.231249,-75.598198;10.2309730000001,-75.598198;10.2309730000001,-75.5987469999999;10.231249,-75.5987469999999;10.231249,-75.59930300000001;10.2320830000001,-75.59930300000001;10.2320830000001,-75.5995859999999;10.233473,-75.5995859999999;10.233471,-75.599862;10.234027,-75.599862;10.234027,-75.60041799999991;10.2343050000001,-75.60041799999991;10.2343050000001,-75.6009759999999;10.234583,-75.6009759999999;10.234583,-75.60124999999989;10.2348610000001,-75.60124999999989;10.2348610000001,-75.601806;10.235139,-75.601806;10.235139,-75.6023639999999;10.2354170000001,-75.6023639999999;10.2354170000001,-75.602638;10.2356980000001,-75.602638;10.235695,-75.6029129999999;10.2359730000001,-75.6029129999999;10.2359730000001,-75.603196;10.2365270000001,-75.603196;10.2365270000001,-75.6037519999999;10.2370830000001,-75.6037519999999;10.2370830000001,-75.604028;10.2376390000001,-75.604028;10.2376390000001,-75.6043079999999;10.2370830000001,-75.6043079999999;10.2370830000001,-75.60485799999999;10.236805,-75.60485799999999;10.236807,-75.60513999999991;10.2365270000001,-75.60513999999991;10.2365270000001,-75.60541599999991;10.234027,-75.60541599999991;10.234027,-75.60513999999991;10.2331950000001,-75.60513999999991;10.2331950000001,-75.60485799999999;10.2315270000001,-75.60485799999999;10.2315270000001,-75.60513999999991;10.230695,-75.60513999999991;10.230695,-75.60541599999991;10.229583,-75.60541599999991;10.229583,-75.6056989999999;10.229029,-75.6056989999999;10.229029,-75.60597199999999;10.228473,-75.60597199999999;10.228473,-75.60624799999989;10.227917,-75.60624799999989;10.227917,-75.606528;10.2273600000001,-75.606528;10.2273600000001,-75.606804;10.226807,-75.606804;10.226807,-75.6070859999999;10.225972,-75.6070859999999;10.225972,-75.60736;10.2251380000001,-75.60736;10.2251380000001,-75.607636;10.224304,-75.607636;10.224304,-75.6079179999999;10.2237500000001,-75.6079179999999;10.2237500000001,-75.608192;10.223194,-75.608192;10.223194,-75.6084739999999;10.2229159999999,-75.6084739999999;10.2229159999999,-75.6087499999999;10.222638,-75.6087499999999;10.22264,-75.60902400000001;10.2223620000001,-75.60902400000001;10.2223620000001,-75.6095799999999;10.2220820000001,-75.6095799999999;10.2220840000001,-75.60986199999989;10.221528,-75.60986199999989;10.221528,-75.61013799999991;10.2212499999999,-75.61013799999991;10.2212499999999,-75.6104209999999;10.2206940000002,-75.6104209999999;10.2206940000002,-75.6106939999999;10.2201380000001,-75.6106939999999;10.2201380000001,-75.61097;10.219862,-75.61097;10.219862,-75.61125299999991;10.2195839999999,-75.61125299999991;10.2195839999999,-75.611526;10.219306,-75.611526;10.219306,-75.61180899999989;10.2187500000001,-75.61180899999989;10.2187500000001,-75.6120819999999;10.2184720000001,-75.6120819999999;10.2184720000001,-75.6126409999999;10.218194,-75.6126409999999;10.218196,-75.6129139999999;10.2179159999999,-75.6129139999999;10.2179159999999,-75.6134729999999;10.21764,-75.6134729999999;10.21764,-75.6143049999999;10.2170840000001,-75.6143049999999;10.2170840000001,-75.61486099999991;10.2168060000001,-75.61486099999991;10.2168060000001,-75.615134;10.2162499999999,-75.615134;10.2162499999999,-75.61541699999989;10.2159720000001,-75.61541699999989;10.215974,-75.61569299999989;10.2156940000002,-75.61569299999989;10.2156940000002,-75.61597499999991;10.2154180000001,-75.61597499999991;10.2154180000001,-75.6162489999999;10.2151370000001,-75.6162489999999;10.2151370000001,-75.617919;10.214862,-75.617919;10.214862,-75.61846799999999;10.2145839999999,-75.61846799999999;10.2145839999999,-75.6187509999999;10.2143060000001,-75.6187509999999;10.214308,-75.6190269999999;10.2140280000002,-75.6190269999999;10.2140280000002,-75.619309;10.2133279999999,-75.619309;10.213196,-75.619309;10.213196,-75.61958299999991;10.212751,-75.61958299999991;10.212083,-75.61958299999991;10.212083,-75.61985899999991;10.2118050000001,-75.61985899999991;10.2118050000001,-75.6200339999999;10.2118050000001,-75.6201389999999;10.211577,-75.6201389999999;10.2112490000001,-75.6201389999999;10.2112490000001,-75.61958299999991;10.210695,-75.61958299999991;10.210695,-75.619309;10.2098610000002,-75.619309;10.2098610000002,-75.61958299999991;10.2093070000001,-75.61958299999991;10.2093070000001,-75.61985899999991;10.209027,-75.61985899999991;10.209027,-75.6201389999999;10.208749,-75.6201389999999;10.2087509999999,-75.6204149999999;10.2084730000001,-75.6204149999999;10.2084730000001,-75.62069699999989;10.2081950000002,-75.62069699999989;10.2081950000002,-75.6204149999999;10.2079170000001,-75.6204149999999;10.2079170000001,-75.62069699999989;10.207639,-75.62069699999989;10.207639,-75.6209709999999;10.207083,-75.6209709999999;10.207083,-75.6212469999999;10.2062510000001,-75.6212469999999;10.2062510000001,-75.6215289999999;10.205417,-75.6215289999999;10.205417,-75.622085;10.2051390000001,-75.622085;10.2051390000001,-75.6223609999999;10.204861,-75.6223609999999;10.204861,-75.622917;10.2045830000001,-75.622917;10.2045830000001,-75.623473;10.204305,-75.623473;10.204305,-75.623597;10.204305,-75.6237489999999;10.203977,-75.6237489999999;10.203749,-75.6237489999999;10.203749,-75.623856;10.203749,-75.6240319999999;10.203382,-75.6240319999999;10.203195,-75.6240319999999;10.203195,-75.62430499999989;10.2029170000001,-75.62430499999989;10.2029190000001,-75.62458099999991;10.202363,-75.62458099999991;10.202363,-75.6251369999999;10.202083,-75.6251369999999;10.202083,-75.6256929999999;10.2015260000001,-75.6256929999999;10.2015260000001,-75.6259689999999;10.2012510000001,-75.6259689999999;10.2012510000001,-75.62625199999999;10.200417,-75.62625199999999;10.200417,-75.6265249999999;10.200138,-75.6265249999999;10.2001410000001,-75.626808;10.1998600000001,-75.626808;10.1998600000001,-75.627084;10.199582,-75.627084;10.1995850000001,-75.628472;10.1990290000001,-75.628472;10.1990290000001,-75.628754;10.198472,-75.628754;10.198472,-75.62902799999991;10.1979190000001,-75.62902799999991;10.1979190000001,-75.62930399999991;10.1976380000001,-75.62930399999991;10.1976380000001,-75.629586;10.19736,-75.629586;10.197362,-75.62985999999989;10.19625,-75.62985999999989;10.19625,-75.63014200000001;10.1959720000001,-75.63014200000001;10.1959720000001,-75.63041800000001;10.195694,-75.63041800000001;10.195694,-75.630974;10.19514,-75.630974;10.19514,-75.631248;10.1945910000001,-75.631248;10.1943060000001,-75.631248;10.1943060000001,-75.6315299999999;10.1931940000001,-75.6315299999999;10.1931940000001,-75.63207899999991;10.19236,-75.63207899999991;10.192362,-75.6323619999999;10.19125,-75.6323619999999;10.19125,-75.632638;10.1909720000001,-75.632638;10.1909720000001,-75.632918;10.190694,-75.632918;10.190694,-75.6334669999999;10.1904160000001,-75.6334669999999;10.1904160000001,-75.63402599999991;10.19014,-75.63402599999991;10.19014,-75.636253;10.1898620000001,-75.636253;10.1898620000001,-75.6373599999999;10.189584,-75.6373599999999;10.189584,-75.637916;10.1893060000001,-75.637916;10.1893060000001,-75.6388229999999;10.1893060000001,-75.6390309999999;10.1891870000001,-75.6390309999999;10.189028,-75.6390309999999;10.189028,-75.639304;10.1887500000001,-75.639304;10.1887500000001,-75.63958;10.188472,-75.63958;10.188474,-75.6400679999999;10.187918,-75.640136;10.187918,-75.64041899999999;10.1876400000001,-75.64041899999999;10.1876400000001,-75.64069499999989;10.186806,-75.64069499999989;10.186806,-75.6409749999999;10.186527,-75.6409749999999;10.186527,-75.641251;10.1862490000001,-75.641251;10.1862490000001,-75.64152399999991;10.1859710000001,-75.64152399999991;10.1859710000001,-75.6418229999999;10.1859710000001,-75.642083;10.185696,-75.642083;10.185696,-75.6423649999999;10.185415,-75.6423649999999;10.185415,-75.642639;10.1851389999999,-75.642639;10.1851389999999,-75.642915;10.184861,-75.642915;10.184861,-75.6431969999999;10.1845830000001,-75.6431969999999;10.1845830000001,-75.64347100000001;10.1843050000001,-75.64347100000001;10.1843050000001,-75.6440269999999;10.1840270000001,-75.6440269999999;10.1840270000001,-75.64458500000001;10.183749,-75.64458500000001;10.183749,-75.6448589999999;10.1831930000001,-75.6448589999999;10.1831930000001,-75.6451409999999;10.1829170000001,-75.6451409999999;10.1829170000001,-75.6456899999999;10.1823610000001,-75.6456899999999;10.1823610000001,-75.6459729999999;10.182083,-75.6459729999999;10.182083,-75.6465289999999;10.181529,-75.6465289999999;10.181529,-75.6470879999999;10.1809730000001,-75.6470879999999;10.1809730000001,-75.647637;10.180417,-75.647637;10.180417,-75.6473609999999;10.1801389999999,-75.6473609999999;10.1801389999999,-75.6470879999999;10.1798610000001,-75.6470879999999;10.1798610000001,-75.6468049999999;10.179772,-75.6468049999999;10.1793050000001,-75.6468049999999;10.1793070000001,-75.6465289999999;10.178751,-75.6465289999999;10.178751,-75.6468049999999;10.1781950000001,-75.6468049999999;10.1781950000001,-75.6473609999999;10.1779170000002,-75.6473609999999;10.1779170000002,-75.647637;10.1776390000001,-75.647637;10.1776390000001,-75.649581;10.1773610000001,-75.649581;10.1773610000001,-75.6501389999999;10.177083,-75.6501389999999;10.177083,-75.651375;10.177083,-75.6515269999999;10.1773610000001,-75.6515269999999;10.1773610000001,-75.65208299999991;10.1776390000001,-75.65208299999991;10.1776390000001,-75.6534739999999;10.1779170000002,-75.6534739999999;10.1779170000002,-75.65430599999991;10.1776390000001,-75.65430599999991;10.1776390000001,-75.6545859999999;10.1773610000001,-75.6545859999999;10.1773610000001,-75.6548619999999;10.1756950000001,-75.6548619999999;10.1756950000001,-75.6551349999999;10.1745830000002,-75.6551349999999;10.1745830000002,-75.6554179999999;10.1743070000001,-75.6554179999999;10.1743070000001,-75.6551349999999;10.1734729999999,-75.6551349999999;10.1734729999999,-75.6548619999999;10.1731950000001,-75.6548619999999;10.1731970000001,-75.6545859999999;10.1726410000001,-75.6545859999999;10.1726410000001,-75.6548619999999;10.172085,-75.6548619999999;10.172085,-75.6551349999999;10.1718040000001,-75.6551349999999;10.1718040000001,-75.6554179999999;10.171528,-75.6554179999999;10.171528,-75.6556939999999;10.17125,-75.6556939999999;10.17125,-75.6559759999999;10.170972,-75.6559759999999;10.1709750000001,-75.6562499999999;10.1706940000001,-75.6562499999999;10.1706940000001,-75.6565259999999;10.1704160000002,-75.6565259999999;10.170419,-75.6568059999999;10.1701380000001,-75.6568059999999;10.1701380000001,-75.657364;10.170419,-75.657364;10.170419,-75.65763799999991;10.1701380000001,-75.65763799999991;10.1701380000001,-75.6584699999999;10.16986,-75.6584699999999;10.16986,-75.65902800000001;10.1701380000001,-75.65902800000001;10.1701380000001,-75.6593009999999;10.16986,-75.6593009999999;10.169862,-75.665694;10.169584,-75.665694;10.169584,-75.666253;10.169306,-75.666253;10.169306,-75.66735799999999;10.1690280000001,-75.66735799999999;10.1690280000001,-75.6679139999999;10.1687500000002,-75.6679139999999;10.168753,-75.66847299999991;10.1684720000001,-75.66847299999991;10.1684720000001,-75.6687459999999;10.168194,-75.6687459999999;10.168194,-75.669029;10.167638,-75.669029;10.167638,-75.6693049999999;10.166528,-75.6693049999999;10.166528,-75.66958700000001;10.1651400000001,-75.66958700000001;10.1651400000001,-75.669861;10.1640280000001,-75.669861;10.1640280000001,-75.6693049999999;10.16375,-75.6693049999999;10.16375,-75.669029;10.1634720000001,-75.669029;10.1634720000001,-75.66847299999991;10.163194,-75.66847299999991;10.163194,-75.6679139999999;10.1629180000001,-75.6679139999999;10.1629180000001,-75.66735799999999;10.16375,-75.66735799999999;10.16375,-75.6676409999999;10.1640280000001,-75.6676409999999;10.1640280000001,-75.6679139999999;10.1645840000001,-75.6679139999999;10.1645840000001,-75.66819700000001;10.1656940000001,-75.66819700000001;10.1656940000001,-75.66847299999991;10.1662500000001,-75.66847299999991;10.1662500000001,-75.66819700000001;10.1668060000001,-75.66819700000001;10.1668060000001,-75.6679139999999;10.166528,-75.6679139999999;10.166528,-75.6676409999999;10.1662500000001,-75.6676409999999;10.1662500000001,-75.6659699999999;10.166528,-75.6659699999999;10.166528,-75.6654119999999;10.1668060000001,-75.6654119999999;10.1668060000001,-75.664863;10.1673620000001,-75.664863;10.1673620000001,-75.6643059999999;10.167638,-75.6643059999999;10.167638,-75.6640239999999;10.1679160000001,-75.6640239999999;10.1679160000001,-75.66374999999989;10.168194,-75.66374999999989;10.168194,-75.66347499999991;10.1684720000001,-75.66347499999991;10.1684720000001,-75.6631919999999;10.168753,-75.6631919999999;10.1687500000002,-75.66236000000001;10.1690280000001,-75.66236000000001;10.1690280000001,-75.6612479999999;10.1687500000002,-75.6612479999999;10.168753,-75.66069899999999;10.168192,-75.66069899999999;10.168194,-75.6609719999999;10.167638,-75.6609719999999;10.167638,-75.66069899999999;10.1673620000001,-75.66069899999999;10.1673620000001,-75.6609719999999;10.1668060000001,-75.6609719999999;10.1668060000001,-75.6595839999999;10.1670840000002,-75.6595839999999;10.1670840000002,-75.6593009999999;10.167638,-75.6593009999999;10.167638,-75.65902800000001;10.168194,-75.65902800000001;10.168192,-75.65875199999989;10.168753,-75.65875199999989;10.168753,-75.658196;10.1684720000001,-75.658196;10.1684720000001,-75.65791299999999;10.167638,-75.65791299999999;10.167638,-75.65763799999991;10.166528,-75.65763799999991;10.166528,-75.657364;10.1662500000001,-75.657364;10.1662500000001,-75.6565259999999;10.166528,-75.6565259999999;10.166528,-75.6559759999999;10.1668060000001,-75.6559759999999;10.1668060000001,-75.6545859999999;10.1670840000002,-75.6545859999999;10.1670840000002,-75.65403000000001;10.1673620000001,-75.65403000000001;10.1673620000001,-75.6534739999999;10.1670840000002,-75.6534739999999;10.1670840000002,-75.653198;10.1673620000001,-75.653198;10.1673620000001,-75.65291499999999;10.167638,-75.65291499999999;10.167638,-75.6526419999999;10.169306,-75.6526419999999;10.169306,-75.65291499999999;10.169605,-75.65291499999999;10.171528,-75.65291499999999;10.171528,-75.6526419999999;10.1718040000001,-75.6526419999999;10.1718040000001,-75.6524729999999;10.1718040000001,-75.65235899999991;10.172085,-75.65235899999991;10.1720820000002,-75.65208299999991;10.1723600000001,-75.65208299999991;10.1723600000001,-75.6506949999999;10.1720820000002,-75.6506949999999;10.172085,-75.64986399999989;10.171528,-75.64986399999989;10.171528,-75.649581;10.170972,-75.649581;10.1709750000001,-75.64986399999989;10.169862,-75.64986399999989;10.169862,-75.6501389999999;10.168753,-75.6501389999999;10.168753,-75.650413;10.1684720000001,-75.650413;10.1684720000001,-75.6506949999999;10.1679160000001,-75.6506949999999;10.1679160000001,-75.6512539999999;10.167638,-75.6512539999999;10.167638,-75.6518029999999;10.1673620000001,-75.6518029999999;10.1673620000001,-75.65208299999991;10.1670840000002,-75.65208299999991;10.1670840000002,-75.65235899999991;10.166528,-75.65235899999991;10.166528,-75.6526419999999;10.165972,-75.6526419999999;10.165972,-75.65291499999999;10.1656940000001,-75.65291499999999;10.1656940000001,-75.653198;10.1651400000001,-75.653198;10.1651400000001,-75.6534739999999;10.16486,-75.6534739999999;10.16486,-75.653747;10.1645840000001,-75.653747;10.1645840000001,-75.65430599999991;10.16527,-75.65430599999991;10.165416,-75.65430599999991;10.165416,-75.6545859999999;10.1656940000001,-75.6545859999999;10.1656940000001,-75.6554179999999;10.165416,-75.6554179999999;10.165416,-75.6556939999999;10.1646680000001,-75.6556939999999;10.1640280000001,-75.6556939999999;10.1640280000001,-75.6551349999999;10.16375,-75.6551349999999;10.16375,-75.6554179999999;10.1634720000001,-75.6554179999999;10.1634720000001,-75.6556939999999;10.1629180000001,-75.6556939999999;10.1629180000001,-75.6565259999999;10.162638,-75.6565259999999;10.162638,-75.6568059999999;10.1623620000001,-75.6568059999999;10.1623620000001,-75.6570819999999;10.162084,-75.6570819999999;10.162084,-75.657364;10.1618060000001,-75.657364;10.1618060000001,-75.65763799999991;10.162084,-75.65763799999991;10.162084,-75.65791299999999;10.1618060000001,-75.65791299999999;10.1618060000001,-75.658196;10.161528,-75.658196;10.161528,-75.65875199999989;10.1612500000001,-75.65875199999989;10.1612520000001,-75.6593009999999;10.160972,-75.6593009999999;10.160972,-75.66069899999999;10.160693,-75.66069899999999;10.1606960000001,-75.6609719999999;10.160418,-75.6609719999999;10.160418,-75.6618039999999;10.1601400000001,-75.6618039999999;10.1601400000001,-75.66347499999991;10.159862,-75.66347499999991;10.159862,-75.6643059999999;10.1595840000001,-75.6643059999999;10.1595840000001,-75.665694;10.1593050000001,-75.665694;10.1593050000001,-75.6668089999999;10.159027,-75.6668089999999;10.159027,-75.667085;10.1593050000001,-75.667085;10.1593050000001,-75.66847299999991;10.159027,-75.66847299999991;10.159027,-75.6687459999999;10.1593050000001,-75.6687459999999;10.1593050000001,-75.669029;10.159027,-75.669029;10.159027,-75.6693049999999;10.1593050000001,-75.6693049999999;10.1593050000001,-75.669861;10.159027,-75.669861;10.159027,-75.670417;10.1593050000001,-75.670417;10.1593050000001,-75.670693;10.159027,-75.670693;10.1590300000001,-75.672363;10.1587490000001,-75.672363;10.1587490000001,-75.67319500000001;10.1590300000001,-75.67319500000001;10.1590300000001,-75.673751;10.1587490000001,-75.673751;10.1587490000001,-75.674027;10.1590300000001,-75.674027;10.159027,-75.67430999999991;10.1593050000001,-75.67430999999991;10.1593050000001,-75.674583;10.1595840000001,-75.674583;10.1595840000001,-75.67597099999991;10.1593050000001,-75.67597099999991;10.1593050000001,-75.676247;10.159027,-75.676247;10.1590300000001,-75.6770859999999;10.1587490000001,-75.6770859999999;10.1587490000001,-75.67736100000001;10.158471,-75.67736100000001;10.1584740000001,-75.67819299999999;10.157917,-75.67819299999999;10.157917,-75.6784739999999;10.1576390000001,-75.6784739999999;10.1576390000001,-75.679864;10.157917,-75.679864;10.1579310000001,-75.6801369999999;10.1584740000001,-75.6801369999999;10.158471,-75.6804199999999;10.1587490000001,-75.6804199999999;10.1587490000001,-75.68069300000001;10.1590300000001,-75.68069300000001;10.159027,-75.68096899999991;10.1593050000001,-75.68096899999991;10.1593050000001,-75.6812519999999;10.159862,-75.6812519999999;10.159862,-75.68096899999991;10.160418,-75.68096899999991;10.160418,-75.6818079999999;10.159862,-75.6818079999999;10.159862,-75.682357;10.1595840000001,-75.682357;10.1595840000001,-75.6834719999999;10.1593050000001,-75.6834719999999;10.1593050000001,-75.683745;10.159027,-75.683745;10.1590300000001,-75.684028;10.1587490000001,-75.684028;10.1587490000001,-75.6843039999999;10.158471,-75.6843039999999;10.1584740000001,-75.68486;10.157917,-75.68486;10.157917,-75.6851419999999;10.157361,-75.6851419999999;10.157361,-75.6854179999999;10.1568080000001,-75.6854179999999;10.1568080000001,-75.6859739999999;10.1565270000001,-75.6859739999999;10.1565270000001,-75.68680599999991;10.156249,-75.68680599999991;10.156251,-75.68736199999999;10.1559730000001,-75.68736199999999;10.1559730000001,-75.68763799999989;10.1554170000001,-75.68763799999989;10.1554170000001,-75.68736199999999;10.1548610000001,-75.68736199999999;10.1548610000001,-75.68652999999991;10.1543050000001,-75.68652999999991;10.1543050000001,-75.68624799999991;10.1541270000001,-75.68624799999991;10.152917,-75.68624799999991;10.152917,-75.68652999999991;10.1526390000001,-75.68652999999991;10.1526390000001,-75.68680599999991;10.152361,-75.68680599999991;10.152361,-75.68708;10.1520830000001,-75.68708;10.1520830000001,-75.68736199999999;10.151805,-75.68736199999999;10.151807,-75.688194;10.1515270000001,-75.688194;10.1515270000001,-75.6884699999999;10.1509730000001,-75.6884699999999;10.1509730000001,-75.68930899999999;10.151251,-75.68930899999999;10.151251,-75.6895819999999;10.1509730000001,-75.6895819999999;10.1509730000001,-75.6901399999999;10.149029,-75.6901399999999;10.149029,-75.69041399999991;10.1487510000001,-75.69041399999991;10.1487510000001,-75.6906969999999;10.148473,-75.6906969999999;10.148473,-75.6909719999999;10.1476390000001,-75.6909719999999;10.1476390000001,-75.6912529999999;10.1459730000001,-75.6912529999999;10.1459730000001,-75.6909719999999;10.1451380000001,-75.6909719999999;10.145141,-75.6912529999999;10.1448600000001,-75.6912529999999;10.1448600000001,-75.69152799999991;10.144304,-75.69152799999991;10.144304,-75.6912529999999;10.1431940000001,-75.6912529999999;10.1431940000001,-75.69152799999991;10.1429160000001,-75.69152799999991;10.1429160000001,-75.6918019999999;10.1423599999999,-75.6918019999999;10.1423599999999,-75.6940309999999;10.142638,-75.6940309999999;10.142638,-75.6945799999999;10.1429160000001,-75.6945799999999;10.1429160000001,-75.6948629999999;10.1440279999999,-75.6948629999999;10.1440279999999,-75.69513599999991;10.144304,-75.69513599999991;10.144304,-75.69596799999989;10.144585,-75.69596799999989;10.144585,-75.6962509999999;10.145141,-75.6962509999999;10.1451380000001,-75.69596799999989;10.1456939999999,-75.69596799999989;10.1456939999999,-75.6948629999999;10.1454160000001,-75.6948629999999;10.1454160000001,-75.69347500000001;10.1459730000001,-75.69347500000001;10.1459730000001,-75.6937479999999;10.146807,-75.6937479999999;10.146807,-75.6940309999999;10.1470820000001,-75.6940309999999;10.1470820000001,-75.6943039999999;10.1476390000001,-75.6943039999999;10.1476390000001,-75.6940309999999;10.1481950000001,-75.6940309999999;10.1481950000001,-75.6937479999999;10.1487510000001,-75.6937479999999;10.1487510000001,-75.69235999999999;10.149029,-75.69235999999999;10.149029,-75.6918019999999;10.149583,-75.6918019999999;10.149583,-75.69208499999991;10.1498610000001,-75.69208499999991;10.1498610000001,-75.6937479999999;10.149583,-75.6937479999999;10.149583,-75.6948629999999;10.1493050000001,-75.6948629999999;10.1493050000001,-75.69513599999991;10.1487510000001,-75.69513599999991;10.1487510000001,-75.6948629999999;10.148473,-75.6948629999999;10.148473,-75.69513599999991;10.1481950000001,-75.69513599999991;10.1481950000001,-75.6962509999999;10.147917,-75.6962509999999;10.147919,-75.69680700000001;10.147363,-75.69680700000001;10.147363,-75.69708299999991;10.1465290000001,-75.69708299999991;10.1465290000001,-75.697639;10.146251,-75.697639;10.146251,-75.6979149999999;10.1459730000001,-75.6979149999999;10.1459730000001,-75.6989219999999;10.1459730000001,-75.6990289999999;10.1456939999999,-75.6990289999999;10.1456939999999,-75.6998589999999;10.1454160000001,-75.6998589999999;10.1454160000001,-75.7004169999999;10.1451380000001,-75.7004169999999;10.145141,-75.70069099999991;10.1448600000001,-75.70069099999991;10.1448600000001,-75.70097300000001;10.144585,-75.70097300000001;10.144585,-75.70180499999999;10.144304,-75.70180499999999;10.144304,-75.702637;10.1440279999999,-75.702637;10.1440279999999,-75.70291999999991;10.1437500000001,-75.70291999999991;10.1437500000001,-75.7031929999999;10.1429160000001,-75.7031929999999;10.1429160000001,-75.703476;10.1423599999999,-75.703476;10.1423599999999,-75.7037509999999;10.1420820000001,-75.7037509999999;10.1420820000001,-75.7040249999999;10.1418060000001,-75.7040249999999;10.1418060000001,-75.704308;10.1415280000001,-75.704308;10.1415280000001,-75.7040249999999;10.1406939999999,-75.7040249999999;10.1406939999999,-75.7037509999999;10.1398620000001,-75.7037509999999;10.1398620000001,-75.703476;10.1390279999999,-75.703476;10.1390279999999,-75.7031929999999;10.1381940000001,-75.7031929999999;10.1381960000001,-75.70291999999991;10.13764,-75.70291999999991;10.13764,-75.702637;10.1373619999999,-75.702637;10.1373619999999,-75.7023609999999;10.1368060000001,-75.7023609999999;10.1368060000001,-75.70208099999989;10.13625,-75.70208099999989;10.13625,-75.70180499999999;10.135694,-75.70180499999999;10.135694,-75.70152899999989;10.1354180000001,-75.70152899999989;10.1354180000001,-75.70097300000001;10.1351380000002,-75.70097300000001;10.1351380000002,-75.7004169999999;10.1348620000001,-75.7004169999999;10.1348620000001,-75.700141;10.134584,-75.700141;10.134584,-75.6998589999999;10.134306,-75.6998589999999;10.134308,-75.6990289999999;10.134028,-75.6990289999999;10.134028,-75.6987529999999;10.133193,-75.6987529999999;10.1331960000001,-75.69736499999991;10.1329150000001,-75.69736499999991;10.1329150000001,-75.69680700000001;10.13264,-75.69680700000001;10.13264,-75.6965269999999;10.132362,-75.6965269999999;10.132362,-75.69596799999989;10.132083,-75.69596799999989;10.132083,-75.6954189999999;10.1318050000001,-75.6954189999999;10.1318050000001,-75.69513599999991;10.131527,-75.69513599999991;10.1315300000001,-75.6948629999999;10.1312490000001,-75.6948629999999;10.1312490000001,-75.6940309999999;10.1309710000002,-75.6940309999999;10.1309710000002,-75.6937479999999;10.1312490000001,-75.6937479999999;10.1312490000001,-75.69328299999989;10.1312490000001,-75.69316000000001;10.1312490000001,-75.6929159999999;10.1309710000002,-75.6929159999999;10.130974,-75.69208499999991;10.1306950000001,-75.69208499999991;10.1306950000001,-75.6901399999999;10.130417,-75.6901399999999;10.130417,-75.689858;10.1306950000001,-75.689858;10.1306950000001,-75.689026;10.130974,-75.689026;10.1309710000002,-75.6884699999999;10.1312490000001,-75.6884699999999;10.1312490000001,-75.68708;10.1309710000002,-75.68708;10.1309710000002,-75.68680599999991;10.1312490000001,-75.68680599999991;10.1312490000001,-75.6859739999999;10.1315300000001,-75.6859739999999;10.131527,-75.6845859999999;10.1318050000001,-75.6845859999999;10.1318050000001,-75.6843039999999;10.132362,-75.6843039999999;10.132362,-75.684028;10.1329150000001,-75.684028;10.1329150000001,-75.683745;10.1334710000001,-75.683745;10.1334710000001,-75.6834719999999;10.1337520000001,-75.6834719999999;10.1337500000001,-75.683196;10.134028,-75.683196;10.134028,-75.68291599999991;10.135694,-75.68291599999991;10.135694,-75.68263999999991;10.135974,-75.68263999999991;10.135972,-75.682357;10.1365280000001,-75.682357;10.1365280000001,-75.6820839999999;10.136676,-75.6820839999999;10.1370840000001,-75.6820839999999;10.1370840000001,-75.6818079999999;10.1373619999999,-75.6818079999999;10.1373619999999,-75.6820839999999;10.13764,-75.6820839999999;10.13764,-75.6818079999999;10.137916,-75.6818079999999;10.137916,-75.68152499999999;10.1381960000001,-75.68152499999999;10.1381940000001,-75.6812519999999;10.1384720000001,-75.6812519999999;10.1384720000001,-75.6804199999999;10.1387500000001,-75.6804199999999;10.1387500000001,-75.679581;10.1390279999999,-75.679581;10.1390279999999,-75.67909999999991;10.1390279999999,-75.6776349999999;10.1387500000001,-75.6776349999999;10.1387500000001,-75.6751409999999;10.1384720000001,-75.6751409999999;10.1384720000001,-75.674859;10.1381940000001,-75.674859;10.1381960000001,-75.674027;10.137916,-75.674027;10.137916,-75.6734689999999;10.13764,-75.6734689999999;10.13764,-75.67291899999999;10.1373619999999,-75.67291899999999;10.1373619999999,-75.6718069999999;10.13764,-75.6718069999999;10.13764,-75.671249;10.1373619999999,-75.671249;10.1373619999999,-75.670693;10.1370840000001,-75.670693;10.1370840000001,-75.669861;10.1368060000001,-75.669861;10.1368060000001,-75.66958700000001;10.1373619999999,-75.66958700000001;10.1373619999999,-75.6693049999999;10.13764,-75.6693049999999;10.13764,-75.6687459999999;10.137916,-75.6687459999999;10.137916,-75.66847299999991;10.1381960000001,-75.66847299999991;10.1381940000001,-75.66819700000001;10.1390279999999,-75.66819700000001;10.1390279999999,-75.6679139999999;10.1398620000001,-75.6679139999999;10.1398620000001,-75.66735799999999;10.1404180000001,-75.66735799999999;10.1404160000001,-75.667085;10.1406939999999,-75.667085;10.1406939999999,-75.6668089999999;10.140972,-75.6668089999999;10.140972,-75.66652600000001;10.1412500000001,-75.66652600000001;10.1412500000001,-75.6659699999999;10.1415280000001,-75.6659699999999;10.1415280000001,-75.665694;10.1420820000001,-75.665694;10.1420820000001,-75.6651379999999;10.1423599999999,-75.6651379999999;10.1423599999999,-75.664863;10.1429160000001,-75.664863;10.1429160000001,-75.6645819999999;10.1431940000001,-75.6645819999999;10.1431940000001,-75.6643059999999;10.1434720000001,-75.6643059999999;10.1434720000001,-75.66374999999989;10.1437500000001,-75.66374999999989;10.1437500000001,-75.66347499999991;10.144304,-75.66347499999991;10.144304,-75.6631919999999;10.144585,-75.6631919999999;10.144585,-75.66291799999991;10.145141,-75.66291799999991;10.1451380000001,-75.66263599999991;10.1454160000001,-75.66263599999991;10.1454160000001,-75.66236000000001;10.1459730000001,-75.66236000000001;10.1459730000001,-75.6618039999999;10.146251,-75.6618039999999;10.146251,-75.6612479999999;10.146807,-75.6612479999999;10.146807,-75.6609719999999;10.1470820000001,-75.6609719999999;10.1470820000001,-75.6604159999999;10.1476390000001,-75.6604159999999;10.1476390000001,-75.6598579999999;10.1481950000001,-75.6598579999999;10.1481950000001,-75.6595839999999;10.148473,-75.6595839999999;10.148473,-75.6593009999999;10.1487510000001,-75.6593009999999;10.1487510000001,-75.65902800000001;10.149029,-75.65902800000001;10.149029,-75.65875199999989;10.1493050000001,-75.65875199999989;10.1493050000001,-75.6584699999999;10.149583,-75.6584699999999;10.149583,-75.65791299999999;10.150139,-75.65791299999999;10.150139,-75.657364;10.1504170000001,-75.657364;10.1504170000001,-75.6570819999999;10.150695,-75.6570819999999;10.150695,-75.6568059999999;10.1509730000001,-75.6568059999999;10.1509730000001,-75.6565259999999;10.151251,-75.6565259999999;10.151251,-75.6562499999999;10.1515270000001,-75.6562499999999;10.1515270000001,-75.6556939999999;10.1520830000001,-75.6556939999999;10.1520830000001,-75.6551349999999;10.152361,-75.6551349999999;10.152361,-75.6545859999999;10.152917,-75.6545859999999;10.152917,-75.65430599999991;10.1537510000001,-75.65430599999991;10.1537510000001,-75.653747;10.1543050000001,-75.653747;10.1543050000001,-75.6534739999999;10.154583,-75.6534739999999;10.154583,-75.653198;10.155139,-75.653198;10.155139,-75.65291499999999;10.1554170000001,-75.65291499999999;10.1554170000001,-75.6526419999999;10.155695,-75.6526419999999;10.155693,-75.65235899999991;10.1559730000001,-75.65235899999991;10.1559730000001,-75.65208299999991;10.1568080000001,-75.65208299999991;10.156805,-75.6518029999999;10.1576390000001,-75.6518029999999;10.1576390000001,-75.6515269999999;10.1584740000001,-75.6515269999999;10.158471,-75.6512539999999;10.1587490000001,-75.6512539999999;10.1587490000001,-75.6509709999999;10.1593050000001,-75.6509709999999;10.1593050000001,-75.650413;10.1595840000001,-75.650413;10.1595840000001,-75.6501389999999;10.1601400000001,-75.6501389999999;10.1601400000001,-75.64986399999989;10.1611060000001,-75.64986399999989;10.162084,-75.64986399999989;10.162084,-75.649581;10.1623620000001,-75.649581;10.1623620000001,-75.64930699999989;10.163194,-75.64930699999989;10.163194,-75.6490249999999;10.1645840000001,-75.6490249999999;10.1645840000001,-75.64875099999991;10.16486,-75.64875099999991;10.16486,-75.6484759999999;10.1651400000001,-75.6484759999999;10.1651400000001,-75.64819299999991;10.165416,-75.64819299999991;10.165416,-75.6479189999999;10.1656940000001,-75.6479189999999;10.1656940000001,-75.647637;10.1662500000001,-75.647637;10.1662500000001,-75.6473609999999;10.1668060000001,-75.6473609999999;10.1668060000001,-75.6470879999999;10.1670840000002,-75.6470879999999;10.1670840000002,-75.6468049999999;10.1673620000001,-75.6468049999999;10.1673620000001,-75.6465289999999;10.167638,-75.6465289999999;10.167638,-75.646249;10.1679160000001,-75.646249;10.1679160000001,-75.64608;10.1679160000001,-75.6459729999999;10.168194,-75.6459729999999;10.168194,-75.6456899999999;10.1684720000001,-75.6456899999999;10.1684720000001,-75.645417;10.1690280000001,-75.645417;10.1690280000001,-75.6451409999999;10.169306,-75.6451409999999;10.169306,-75.6448589999999;10.169584,-75.6448589999999;10.169584,-75.64458500000001;10.169862,-75.64458500000001;10.16986,-75.64430299999999;10.1701380000001,-75.64430299999999;10.1701380000001,-75.6440269999999;10.170419,-75.6440269999999;10.1704160000002,-75.64347100000001;10.1706940000001,-75.64347100000001;10.1706940000001,-75.642915;10.1718040000001,-75.642915;10.1718040000001,-75.642639;10.172085,-75.642639;10.1720820000002,-75.6423649999999;10.1723600000001,-75.6423649999999;10.1723600000001,-75.642083;10.1726410000001,-75.642083;10.172638,-75.64152399999991;10.172916,-75.64152399999991;10.172916,-75.641251;10.1734729999999,-75.641251;10.1734729999999,-75.6409749999999;10.173751,-75.6409749999999;10.173751,-75.64069499999989;10.1740260000001,-75.64069499999989;10.1740260000001,-75.64041899999999;10.1743070000001,-75.64041899999999;10.1743070000001,-75.63986299999991;10.1748630000001,-75.63986299999991;10.1748630000001,-75.63958;10.175419,-75.63958;10.175417,-75.639304;10.1762510000001,-75.639304;10.1762510000001,-75.63958;10.1768049999999,-75.63958;10.1768049999999,-75.63986299999991;10.1773610000001,-75.63986299999991;10.1773610000001,-75.640136;10.1779170000002,-75.640136;10.1779170000002,-75.64041899999999;10.1795830000002,-75.64041899999999;10.1795830000002,-75.64069499999989;10.1798610000001,-75.64069499999989;10.1798610000001,-75.6409749999999;10.1800890000001,-75.6409749999999;10.180417,-75.6409749999999;10.180417,-75.641251;10.1812490000002,-75.641251;10.1812490000002,-75.6409749999999;10.1818049999999,-75.6409749999999;10.1818049999999,-75.64069499999989;10.1823610000001,-75.64069499999989;10.1823610000001,-75.64054899999999;10.1823610000001,-75.640136;10.1826390000001,-75.640136;10.1826390000001,-75.63986299999991;10.1831930000001,-75.63986299999991;10.1831930000001,-75.639304;10.1834729999999,-75.639304;10.1834729999999,-75.6390309999999;10.183695,-75.6390309999999;10.1840270000001,-75.6390309999999;10.1840270000001,-75.63874800000001;10.1845830000001,-75.63874800000001;10.1845830000001,-75.63847199999999;10.185415,-75.63847199999999;10.185415,-75.6381919999999;10.1859710000001,-75.6381919999999;10.1859710000001,-75.637916;10.186527,-75.637916;10.186527,-75.637084;10.1859710000001,-75.637084;10.1859710000001,-75.636802;10.1845650000001,-75.636802;10.1840270000001,-75.636802;10.1840270000001,-75.6365279999999;10.183749,-75.6365279999999;10.183749,-75.636253;10.1834729999999,-75.636253;10.1834729999999,-75.63597;10.1831930000001,-75.63597;10.1831930000001,-75.635414;10.1829170000001,-75.635414;10.1829170000001,-75.63514000000001;10.1823610000001,-75.63514000000001;10.1823610000001,-75.635414;10.182083,-75.635414;10.182083,-75.6356959999999;10.1806950000001,-75.6356959999999;10.1806950000001,-75.63597;10.180417,-75.63597;10.180417,-75.6365279999999;10.1801389999999,-75.6365279999999;10.1801389999999,-75.636802;10.1798610000001,-75.636802;10.1798610000001,-75.6373599999999;10.1795830000002,-75.6373599999999;10.1795830000002,-75.6376429999999;10.1793050000001,-75.6376429999999;10.1793070000001,-75.637916;10.178751,-75.637916;10.178751,-75.6381919999999;10.177085,-75.6381919999999;10.177085,-75.6376429999999;10.1776390000001,-75.6376429999999;10.1776390000001,-75.6373599999999;10.1779170000002,-75.6373599999999;10.1779170000002,-75.637084;10.1781950000001,-75.637084;10.1781950000001,-75.636802;10.1784729999999,-75.636802;10.1784729999999,-75.6365279999999;10.1790270000001,-75.6365279999999;10.1790270000001,-75.636253;10.1793070000001,-75.636253;10.1793050000001,-75.63597;10.1795830000002,-75.63597;10.1795830000002,-75.6356959999999;10.1798610000001,-75.6356959999999;10.1798610000001,-75.635414;10.1801389999999,-75.635414;10.1801389999999,-75.63514000000001;10.1809730000001,-75.63514000000001;10.1809730000001,-75.634582;10.1812490000002,-75.634582;10.1812490000002,-75.634308;10.181529,-75.634308;10.1815270000001,-75.63402599999991;10.1818049999999,-75.63402599999991;10.1818049999999,-75.6334669999999;10.182083,-75.6334669999999;10.182083,-75.6331939999999;10.1823610000001,-75.6331939999999;10.1823610000001,-75.632918;10.1826390000001,-75.632918;10.1826390000001,-75.631806;10.1829170000001,-75.631806;10.1829170000001,-75.6315299999999;10.1834729999999,-75.6315299999999;10.1834729999999,-75.630974;10.1840270000001,-75.630974;10.1840270000001,-75.6306919999999;10.1843050000001,-75.6306919999999;10.1843050000001,-75.63041800000001;10.184861,-75.63041800000001;10.184861,-75.63014200000001;10.1851389999999,-75.63014200000001;10.1851389999999,-75.62985999999989;10.185415,-75.62985999999989;10.185415,-75.629586;10.185696,-75.629586;10.185696,-75.62930399999991;10.1862490000001,-75.62930399999991;10.1862490000001,-75.62902799999991;10.186527,-75.62902799999991;10.186527,-75.628754;10.1870840000001,-75.628754;10.1870840000001,-75.628472;10.1876400000001,-75.628472;10.1876400000001,-75.6281959999999;10.187918,-75.6281959999999;10.187918,-75.62764;10.1881940000001,-75.62764;10.1881940000001,-75.627084;10.188474,-75.627084;10.188472,-75.626808;10.1887500000001,-75.626808;10.1887500000001,-75.6265249999999;10.189028,-75.6265249999999;10.189028,-75.62625199999999;10.1893060000001,-75.62625199999999;10.1893060000001,-75.6259689999999;10.189584,-75.6259689999999;10.189584,-75.6251369999999;10.1898620000001,-75.6251369999999;10.1898620000001,-75.6248639999999;10.19014,-75.6248639999999;10.19014,-75.62458099999991;10.1904160000001,-75.62458099999991;10.1904160000001,-75.62430499999989;10.1909720000001,-75.62430499999989;10.1909720000001,-75.6237489999999;10.191808,-75.6237489999999;10.191808,-75.623473;10.192362,-75.623473;10.192362,-75.62319099999991;10.193472,-75.62319099999991;10.193472,-75.622917;10.1937500000001,-75.622917;10.1937500000001,-75.622642;10.1943060000001,-75.622642;10.1943060000001,-75.6223609999999;10.194584,-75.6223609999999;10.194584,-75.6218029999999;10.19514,-75.6218029999999;10.19514,-75.6215289999999;10.195694,-75.6215289999999;10.195694,-75.6212469999999;10.1959720000001,-75.6212469999999;10.1959720000001,-75.6209709999999;10.19625,-75.6209709999999;10.19625,-75.62069699999989;10.1965280000001,-75.62069699999989;10.1965280000001,-75.6204149999999;10.196806,-75.6204149999999;10.196806,-75.6201389999999;10.1970840000001,-75.6201389999999;10.1970840000001,-75.61958299999991;10.197362,-75.61958299999991;10.19736,-75.617919;10.1976380000001,-75.617919;10.1976380000001,-75.61597499999991;10.1979190000001,-75.61597499999991;10.197916,-75.61374599999991;10.1981940000001,-75.61374599999991;10.1981940000001,-75.6129139999999;10.197916,-75.6129139999999;10.197916,-75.612358;10.1981940000001,-75.612358;10.1981940000001,-75.61180899999989;10.197916,-75.61180899999989;10.197916,-75.611526;10.1981940000001,-75.611526;10.1981940000001,-75.60736;10.198472,-75.60736;10.198472,-75.60513999999991;10.1987500000001,-75.60513999999991;10.1987500000001,-75.6043079999999;10.1990290000001,-75.6043079999999;10.1990290000001,-75.604028;10.199307,-75.604028;10.199307,-75.60347;10.1995850000001,-75.60347;10.199582,-75.603196;10.1998600000001,-75.603196;10.1998600000001,-75.6029129999999;10.2001410000001,-75.6029129999999;10.200138,-75.6023639999999;10.200417,-75.6023639999999;10.200417,-75.6020819999999;10.2006950000001,-75.6020819999999;10.2006950000001,-75.601806;10.2012510000001,-75.601806;10.2012510000001,-75.601525;10.2015260000001,-75.601525;10.2015260000001,-75.60124999999989;10.2018070000001,-75.60124999999989;10.2018050000001,-75.6009759999999;10.2022470000001,-75.6009759999999;10.202363,-75.6009759999999;10.2023610000001,-75.600694;10.202639,-75.600694;10.202639,-75.60041799999991;10.2029190000001,-75.60041799999991;10.2029170000001,-75.600135;10.203195,-75.600135;10.203195,-75.5995859999999;10.2034730000001,-75.5995859999999;10.2034730000001,-75.59930300000001;10.203749,-75.59930300000001;10.203749,-75.59903;10.204029,-75.59903;10.204029,-75.5987469999999;10.204305,-75.5987469999999;10.204305,-75.598474;10.2045830000001,-75.598474;10.2045830000001,-75.5979149999999;10.204861,-75.5979149999999;10.204861,-75.59764199999999;10.2051390000001,-75.59764199999999;10.2051390000001,-75.597359;10.205417,-75.597359;10.205417,-75.5970829999999;10.205695,-75.5970829999999;10.205695,-75.5968009999999;10.205973,-75.5968009999999;10.205973,-75.596527;10.2062510000001,-75.596527;10.2062510000001,-75.59597100000001;10.206527,-75.59597100000001;10.206527,-75.59569500000001;10.2068050000001,-75.59569500000001;10.2068050000001,-75.59541299999989;10.207083,-75.59541299999989;10.207083,-75.595139;10.207361,-75.595139;10.207361,-75.59458099999991;10.2079170000001,-75.59458099999991;10.2079170000001,-75.594025;10.2081950000002,-75.594025;10.2081950000002,-75.593475;10.2087509999999,-75.593475;10.208749,-75.593193;10.209027,-75.593193;10.209027,-75.5929189999999;10.2095830000001,-75.5929189999999;10.2095830000001,-75.592361;10.2098610000002,-75.592361;10.2098610000002,-75.59152899999999;10.2101390000001,-75.59152899999999;10.2101390000001,-75.59097300000001;10.2104169999999,-75.59097300000001;10.2104169999999,-75.59069700000001;10.2109730000001,-75.59069700000001;10.2109730000001,-75.5904169999999;10.21153,-75.5904169999999;10.2115270000002,-75.590141;10.2118050000001,-75.590141;10.2118050000001,-75.589859;10.212083,-75.589859;10.212083,-75.589027;10.212361,-75.589027;10.212361,-75.5887529999999;10.2126400000001,-75.5887529999999;10.2126400000001,-75.5884709999999;10.213196,-75.5884709999999;10.213196,-75.5879139999999;10.2134710000001,-75.5879139999999;10.2134710000001,-75.587639;10.2140280000002,-75.587639;10.2140280000002,-75.58708299999989;10.214308,-75.58708299999989;10.2143060000001,-75.58680699999999;10.2151370000001,-75.58680699999999;10.2151370000001,-75.5865239999999;10.2154040000001,-75.5865239999999;10.2156940000002,-75.5865239999999;10.2156940000002,-75.58625099999991;10.2162499999999,-75.58625099999991;10.2162499999999,-75.58597500000001;10.2168060000001,-75.58597500000001;10.2168060000001,-75.5856919999999;10.2170840000001,-75.5856919999999;10.2170840000001,-75.5854189999999;10.2173620000002,-75.5854189999999;10.2173620000002,-75.58513599999991;10.21764,-75.58513599999991;10.21764,-75.5845869999999;10.218196,-75.5845869999999;10.218196,-75.584031;10.2187500000001,-75.584031;10.2187500000001,-75.5834719999999;10.2190280000002,-75.5834719999999;10.2190280000002,-75.5831919999999;10.219306,-75.5831919999999;10.219306,-75.5826399999999;10.2195839999999,-75.5826399999999;10.2195839999999,-75.5820839999999;10.219862,-75.5820839999999;10.219862,-75.58125199999991;10.2201380000001,-75.58125199999991;10.2201380000001,-75.58041399999991;10.2206940000002,-75.58041399999991;10.2206940000002,-75.5801399999999;10.220972,-75.5801399999999;10.220972,-75.579864;10.2212499999999,-75.579864;10.2212499999999,-75.5795819999999;10.221528,-75.5795819999999;10.221528,-75.5793079999999;10.2218060000001,-75.5793079999999;10.2218060000001,-75.5790259999999;10.2220840000001,-75.5790259999999;10.2220820000001,-75.5787499999999;10.2223620000001,-75.5787499999999;10.2223620000001,-75.57847700000001;10.2229159999999,-75.57847700000001;10.2229159999999,-75.5779179999999;10.223194,-75.5779179999999;10.223194,-75.57763799999989;10.2234720000001,-75.57763799999989;10.2234720000001,-75.57652999999991;10.2237500000001,-75.57652999999991;10.2237500000001,-75.5748599999999;10.2240280000001,-75.5748599999999;10.2240280000001,-75.5745859999999;10.224304,-75.5745859999999;10.224304,-75.5743029999999;10.2245840000001,-75.5743029999999;10.2245840000001,-75.5733479999999;10.2245840000001,-75.5731959999999;10.22486,-75.5731959999999;10.22486,-75.572913;10.2251380000001,-75.572913;10.2251380000001,-75.5723409999999;10.2251380000001,-75.5720839999999;10.22528,-75.5720839999999;10.2254160000001,-75.5720839999999;10.2254160000001,-75.571831;10.2254160000001,-75.5712519999999;10.2256940000001,-75.5712519999999;10.2256940000001,-75.5701369999999;10.225972,-75.5701369999999;10.225972,-75.5698609999999;10.226251,-75.5698609999999;10.226251,-75.56903199999989;10.2265290000001,-75.56903199999989;10.2265290000001,-75.568749;10.226807,-75.568749;10.226807,-75.568191;10.2270820000001,-75.568191;10.2270820000001,-75.5676409999999;10.2273600000001,-75.5676409999999;10.2273600000001,-75.565415;10.2276390000001,-75.565415;10.2276390000001,-75.55847299999991;10.227917,-75.55847299999991;10.227917,-75.55819700000001;10.2281950000001,-75.55819700000001;10.2281950000001,-75.557914;10.228473,-75.557914;10.228473,-75.5576409999999;10.229029,-75.5576409999999;10.229029,-75.55708199999999;10.229583,-75.55708199999999;10.229583,-75.5568089999999;10.2298610000001,-75.5568089999999;10.2298610000001,-75.55652600000001;10.2304170000001,-75.55652600000001;10.2304170000001,-75.5559699999999;10.2309730000001,-75.5559699999999;10.2309730000001,-75.555694;10.231249,-75.555694;10.231249,-75.5551379999999;10.2315270000001,-75.5551379999999;10.2315270000001,-75.554862;10.231807,-75.554862;10.231805,-75.5543059999999;10.2320830000001,-75.5543059999999;10.2320830000001,-75.55403;10.232363,-75.55403;10.232361,-75.55374999999999;10.2326390000001,-75.55374999999999;10.2326390000001,-75.5534739999999;10.232919,-75.5534739999999;10.232919,-75.5531919999999;10.233473,-75.5531919999999;10.233471,-75.55291800000001;10.2337510000001,-75.55291800000001;10.2337510000001,-75.55235999999989;10.2343050000001,-75.55235999999989;10.2343050000001,-75.552086;10.2348610000001,-75.552086;10.2348610000001,-75.55152800000001;10.235139,-75.55152800000001;10.235139,-75.551248;10.2356980000001,-75.551248;10.2356980000001,-75.5509719999999;10.236251,-75.5509719999999;10.236249,-75.550698;10.2365270000001,-75.550698;10.2365270000001,-75.550416;10.237361,-75.550416;10.237361,-75.5498569999999;10.237917,-75.5498569999999;10.237917,-75.549584;10.2384740000001,-75.549584;10.238471,-75.5493079999999;10.2387490000001,-75.5493079999999;10.2387490000001,-75.5490259999999;10.2393050000001,-75.5490259999999;10.2393050000001,-75.5484689999999;10.240021,-75.5484689999999;10.2401400000001,-75.5484689999999;10.2401400000001,-75.548301;10.2401400000001,-75.548196;10.240418,-75.548196;10.240418,-75.54792000000001;10.2409710000001,-75.54792000000001;10.2409710000001,-75.547364;10.2412520000001,-75.547364;10.2412500000001,-75.5468059999999;10.241528,-75.5468059999999;10.241528,-75.54625;10.242084,-75.54625;10.242084,-75.5459739999999;10.2423620000001,-75.5459739999999;10.2423620000001,-75.5456929999999;10.242638,-75.5456929999999;10.242638,-75.545418;10.2429180000001,-75.545418;10.2429180000001,-75.5448619999999;10.243194,-75.5448619999999;10.243194,-75.544586;10.243474,-75.544586;10.2434720000001,-75.54402999999991;10.24375,-75.54402999999991;10.24375,-75.5434709999999;10.2440300000001,-75.5434709999999;10.2440300000001,-75.54291499999989;10.2439280000002,-75.54291499999989;10.24375,-75.54291499999989;10.24375,-75.54235899999991;10.2440300000001,-75.54235899999991;10.2440300000001,-75.541251;10.24375,-75.541251;10.24375,-75.5398629999999;10.2434720000001,-75.5398629999999;10.243474,-75.53930699999989;10.243194,-75.53930699999989;10.243194,-75.53819299999989;10.2429180000001,-75.53819299999989;10.2429180000001,-75.53736099999991;10.242638,-75.53736099999991;10.242638,-75.537087;10.2423620000001,-75.537087;10.2423620000001,-75.53624599999991;10.242084,-75.53624599999991;10.242084,-75.5356969999999;10.2418060000001,-75.5356969999999;10.241808,-75.5351409999999;10.2412520000001,-75.5351409999999;10.2412520000001,-75.53458499999989;10.2409710000001,-75.53458499999989;10.2409710000001,-75.5340269999999;10.240418,-75.5340269999999;10.240418,-75.53319499999991;10.2401400000001,-75.53319499999991;10.2401400000001,-75.532639;10.239862,-75.532639;10.239862,-75.5320819999999;10.239583,-75.5320819999999;10.239583,-75.5309749999999;10.2393050000001,-75.5309749999999;10.2393050000001,-75.5304189999999;10.239027,-75.5304189999999;10.2390300000001,-75.52986299999991;10.2387490000001,-75.52986299999991;10.2387490000001,-75.5290309999999;10.238471,-75.5290309999999;10.2384740000001,-75.5281989999999;10.2381950000001,-75.5281989999999;10.2381950000001,-75.5270839999999;10.237917,-75.5270839999999;10.237917,-75.5265279999999;10.2376390000001,-75.5265279999999;10.2376390000001,-75.5256959999999;10.237361,-75.5256959999999;10.237361,-75.525414;10.2370830000001,-75.525414;10.2370830000001,-75.525138;10.236805,-75.525138;10.236807,-75.523194;10.2359730000001,-75.523194;10.2359730000001,-75.523476;10.235695,-75.523476;10.2356980000001,-75.52375000000001;10.2354170000001,-75.52375000000001;10.2354170000001,-75.524582;10.235139,-75.524582;10.235139,-75.525138;10.2348610000001,-75.525138;10.2348610000001,-75.52597;10.234583,-75.52597;10.234583,-75.5265279999999;10.2343050000001,-75.5265279999999;10.2343050000001,-75.5270839999999;10.234027,-75.5270839999999;10.234027,-75.5273599999999;10.2343050000001,-75.5273599999999;10.2343050000001,-75.52791599999991;10.234583,-75.52791599999991;10.234583,-75.5281989999999;10.2348610000001,-75.5281989999999;10.2348610000001,-75.5290309999999;10.235139,-75.5290309999999;10.235139,-75.530136;10.2348610000001,-75.530136;10.2348610000001,-75.5309749999999;10.2343050000001,-75.5309749999999;10.2343050000001,-75.53152399999991;10.234027,-75.53152399999991;10.234027,-75.531807;10.2337510000001,-75.531807;10.2337510000001,-75.5320819999999;10.233471,-75.5320819999999;10.233473,-75.53291399999991;10.2331950000001,-75.53291399999991;10.2331950000001,-75.53346999999999;10.232917,-75.53346999999999;10.232917,-75.534302;10.2330700000001,-75.534302;10.2331950000001,-75.534302;10.2331950000001,-75.5348579999999;10.233473,-75.5348579999999;10.233473,-75.5351409999999;10.2331950000001,-75.5351409999999;10.2331950000001,-75.5359729999999;10.233473,-75.5359729999999;10.233471,-75.537087;10.2337510000001,-75.537087;10.2337510000001,-75.53736099999991;10.233471,-75.53736099999991;10.233473,-75.537637;10.2331950000001,-75.537637;10.2331950000001,-75.53791699999989;10.232917,-75.53791699999989;10.232919,-75.53819299999989;10.2309730000001,-75.53819299999989;10.2309730000001,-75.5387489999999;10.2304170000001,-75.5387489999999;10.2304170000001,-75.5398629999999;10.230695,-75.5398629999999;10.230695,-75.541251;10.2309730000001,-75.541251;10.2309730000001,-75.54208299999991;10.230695,-75.54208299999991;10.230695,-75.54235899999991;10.2304170000001,-75.54235899999991;10.2304170000001,-75.5426419999999;10.2298610000001,-75.5426419999999;10.2298610000001,-75.54291499999989;10.229583,-75.54291499999989;10.229583,-75.543198;10.229029,-75.543198;10.229029,-75.5456929999999;10.229583,-75.5456929999999;10.229583,-75.54652299999989;10.2293050000001,-75.54652299999989;10.2293050000001,-75.5468059999999;10.228473,-75.5468059999999;10.228473,-75.54652299999989;10.2276390000001,-75.54652299999989;10.2276390000001,-75.54625;10.226807,-75.54625;10.226807,-75.5459739999999;10.225972,-75.5459739999999;10.225972,-75.54625;10.2251380000001,-75.54625;10.2251380000001,-75.5459739999999;10.2245840000001,-75.5459739999999;10.2245840000001,-75.5448619999999;10.224304,-75.5448619999999;10.224304,-75.544586;10.223194,-75.544586;10.223194,-75.5448619999999;10.2218060000001,-75.5448619999999;10.2218060000001,-75.545135;10.2212499999999,-75.545135;10.2212499999999,-75.5456929999999;10.2206940000002,-75.5456929999999;10.2206940000002,-75.5459739999999;10.2201380000001,-75.5459739999999;10.2201380000001,-75.54625;10.219306,-75.54625;10.219306,-75.54652299999989;10.2184720000001,-75.54652299999989;10.2184720000001,-75.5468059999999;10.21764,-75.5468059999999;10.21764,-75.54652299999989;10.2173620000002,-75.54652299999989;10.2173620000002,-75.5448619999999;10.2170840000001,-75.5448619999999;10.2170840000001,-75.54402999999991;10.2168060000001,-75.54402999999991;10.2168060000001,-75.54291499999989;10.21764,-75.54291499999989;10.21764,-75.5426419999999;10.2190280000002,-75.5426419999999;10.2190280000002,-75.54235899999991;10.219306,-75.54235899999991;10.219306,-75.5426419999999;10.2204180000001,-75.5426419999999;10.2204160000001,-75.54291499999989;10.2206940000002,-75.54291499999989;10.2206940000002,-75.5426419999999;10.2212499999999,-75.5426419999999;10.2212499999999,-75.54208299999991;10.221528,-75.54208299999991;10.221528,-75.5418099999999;10.2218060000001,-75.5418099999999;10.2218060000001,-75.54208299999991;10.2220840000001,-75.54208299999991;10.2220820000001,-75.5418099999999;10.2223620000001,-75.5418099999999;10.2223620000001,-75.54208299999991;10.2229159999999,-75.54208299999991;10.2229159999999,-75.5418099999999;10.223194,-75.5418099999999;10.223194,-75.5415269999999;10.2237500000001,-75.5415269999999;10.2237500000001,-75.541251;10.2245840000001,-75.541251;10.2245840000001,-75.540969;10.2251380000001,-75.540969;10.2251380000001,-75.5406949999999;10.225972,-75.5406949999999;10.225972,-75.5401389999999;10.226251,-75.5401389999999;10.226251,-75.53847499999991;10.2265290000001,-75.53847499999991;10.2265290000001,-75.537637;10.226807,-75.537637;10.226807,-75.5354149999999;10.2270820000001,-75.5354149999999;10.2270820000001,-75.533753;10.2273600000001,-75.533753;10.2273600000001,-75.53319499999991;10.2270820000001,-75.53319499999991;10.2270820000001,-75.53152399999991;10.226807,-75.53152399999991;10.226807,-75.5306919999999;10.2265290000001,-75.5306919999999;10.2265290000001,-75.530136;10.226251,-75.530136;10.226251,-75.52986299999991;10.2256940000001,-75.52986299999991;10.2256940000001,-75.52958699999991;10.2251380000001,-75.52958699999991;10.2251380000001,-75.529304;10.2240280000001,-75.529304;10.2240280000001,-75.5290309999999;10.2237500000001,-75.5290309999999;10.2237500000001,-75.52874799999999;10.2229159999999,-75.52874799999999;10.2229159999999,-75.52847199999999;10.2220820000001,-75.52847199999999;10.2220840000001,-75.5281989999999;10.2201380000001,-75.5281989999999;10.2201380000001,-75.52791599999991;10.2206940000002,-75.52791599999991;10.2206940000002,-75.5270839999999;10.2212499999999,-75.5270839999999;10.2212499999999,-75.526802;10.221528,-75.526802;10.221528,-75.5265279999999;10.2218060000001,-75.5265279999999;10.2218060000001,-75.5256959999999;10.221528,-75.5256959999999;10.221528,-75.525414;10.2212499999999,-75.525414;10.2212499999999,-75.525138;10.2179159999999,-75.525138;10.2179159999999,-75.525414;10.2156940000002,-75.525414;10.2156940000002,-75.5256959999999;10.2140280000002,-75.5256959999999;10.2140280000002,-75.52597;10.213749,-75.52597;10.2137520000001,-75.5256959999999;10.2134710000001,-75.5256959999999;10.2134710000001,-75.52597;10.212361,-75.52597;10.212361,-75.5256959999999;10.2101390000001,-75.5256959999999;10.2101390000001,-75.52597;10.2062510000001,-75.52597;10.2062510000001,-75.5262519999999;10.204861,-75.5262519999999;10.204861,-75.52597;10.204305,-75.52597;10.204305,-75.5256959999999;10.203749,-75.5256959999999;10.203749,-75.525414;10.203195,-75.525414;10.203195,-75.525138;10.2018050000001,-75.525138;10.2018070000001,-75.52486399999989;10.2012510000001,-75.52486399999989;10.2012510000001,-75.524582;10.2006950000001,-75.524582;10.2006950000001,-75.52430800000001;10.2001410000001,-75.52430800000001;10.2001410000001,-75.524582;10.1995850000001,-75.524582;10.1995850000001,-75.52430800000001;10.1990290000001,-75.52430800000001;10.1990290000001,-75.52402599999991;10.1979190000001,-75.52402599999991;10.1979190000001,-75.52375000000001;10.1976380000001,-75.52375000000001;10.1976380000001,-75.523476;10.1970840000001,-75.523476;10.1970840000001,-75.523194;10.1954160000001,-75.523194;10.1954160000001,-75.52291799999991;10.1948620000001,-75.52291799999991;10.1948620000001,-75.523194;10.194582,-75.523194;10.194584,-75.52291799999991;10.194028,-75.52291799999991;10.194028,-75.52263499999999;10.1931940000001,-75.52263499999999;10.1931940000001,-75.5220859999999;10.1920840000001,-75.5220859999999;10.1920840000001,-75.521806;10.186527,-75.521806;10.186527,-75.5220859999999;10.1859710000001,-75.5220859999999;10.1859710000001,-75.521806;10.185415,-75.521806;10.185415,-75.5220859999999;10.1843050000001,-75.5220859999999;10.1843050000001,-75.521806;10.183749,-75.521806;10.183749,-75.5220859999999;10.1829170000001,-75.5220859999999;10.1829170000001,-75.5223619999999;10.1823610000001,-75.5223619999999;10.1823610000001,-75.5224829999999;10.1823610000001,-75.52263499999999;10.1812490000002,-75.52263499999999;10.1812490000002,-75.52291799999991;10.1801389999999,-75.52291799999991;10.1801389999999,-75.523194;10.1790270000001,-75.523194;10.1790270000001,-75.523476;10.1781950000001,-75.523476;10.1781950000001,-75.52375000000001;10.1776390000001,-75.52375000000001;10.1776390000001,-75.523476;10.1773610000001,-75.523476;10.1773610000001,-75.523194;10.1768049999999,-75.523194;10.1768049999999,-75.52291799999991;10.1756950000001,-75.52291799999991;10.1756950000001,-75.523194;10.1751389999999,-75.523194;10.1751389999999,-75.523476;10.1748610000001,-75.523476;10.1748630000001,-75.52375000000001;10.1745830000002,-75.52375000000001;10.1745830000002,-75.52402599999991;10.1743070000001,-75.52402599999991;10.1743070000001,-75.52426;10.1743070000001,-75.52597;10.1740260000001,-75.52597;10.1740260000001,-75.526802;10.173751,-75.526802;10.173751,-75.52874799999999;10.1740260000001,-75.52874799999999;10.1740260000001,-75.529304;10.1743070000001,-75.529304;10.1743070000001,-75.52986299999991;10.1745830000002,-75.52986299999991;10.1745830000002,-75.5304189999999;10.1748630000001,-75.5304189999999;10.1748610000001,-75.5309749999999;10.1751389999999,-75.5309749999999;10.1751389999999,-75.53152399999991;10.175419,-75.53152399999991;10.175417,-75.5320819999999;10.1756950000001,-75.5320819999999;10.1756950000001,-75.532639;10.1759730000001,-75.532639;10.1759730000001,-75.53319499999991;10.1756950000001,-75.53319499999991;10.1756950000001,-75.533753;10.1751389999999,-75.533753;10.1751389999999,-75.5340269999999;10.1748610000001,-75.5340269999999;10.1748630000001,-75.53458499999989;10.1745830000002,-75.53458499999989;10.1745830000002,-75.534302;10.173751,-75.534302;10.173751,-75.53458499999989;10.1734729999999,-75.53458499999989;10.1734729999999,-75.5348579999999;10.173751,-75.5348579999999;10.173751,-75.5356969999999;10.1743070000001,-75.5356969999999;10.1743070000001,-75.5359729999999;10.175419,-75.5359729999999;10.175417,-75.537087;10.1756950000001,-75.537087;10.1756950000001,-75.5387489999999;10.1759730000001,-75.5387489999999;10.1759730000001,-75.5390249999999;10.1762510000001,-75.5390249999999;10.1762510000001,-75.53930699999989;10.1768049999999,-75.53930699999989;10.1768049999999,-75.5395809999999;10.177085,-75.5395809999999;10.177083,-75.5398629999999;10.1779170000002,-75.5398629999999;10.1779170000002,-75.5401389999999;10.178751,-75.5401389999999;10.178751,-75.5398629999999;10.1790270000001,-75.5398629999999;10.1790270000001,-75.5395809999999;10.1793070000001,-75.5395809999999;10.1793050000001,-75.53930699999989;10.1795830000002,-75.53930699999989;10.1795830000002,-75.5387489999999;10.1798610000001,-75.5387489999999;10.1798610000001,-75.53847499999991;10.180417,-75.53847499999991;10.180417,-75.53819299999989;10.1806950000001,-75.53819299999989;10.1806950000001,-75.537637;10.1809730000001,-75.537637;10.1809730000001,-75.53736099999991;10.1806950000001,-75.53736099999991;10.1806950000001,-75.5365289999999;10.1809730000001,-75.5365289999999;10.1809730000001,-75.5359729999999;10.1812490000002,-75.5359729999999;10.1812490000002,-75.5356969999999;10.1818049999999,-75.5356969999999;10.1818049999999,-75.5359729999999;10.1823610000001,-75.5359729999999;10.1823610000001,-75.53624599999991;10.1831930000001,-75.53624599999991;10.1831930000001,-75.536805;10.1834729999999,-75.536805;10.1834729999999,-75.537087;10.183749,-75.537087;10.183749,-75.53736099999991;10.1845830000001,-75.53736099999991;10.1845830000001,-75.537087;10.1851389999999,-75.537087;10.1851389999999,-75.536805;10.185696,-75.536805;10.185696,-75.5365289999999;10.1859710000001,-75.5365289999999;10.1859710000001,-75.53624599999991;10.1862490000001,-75.53624599999991;10.1862490000001,-75.5359729999999;10.1870840000001,-75.5359729999999;10.1870840000001,-75.5365289999999;10.187362,-75.5365289999999;10.187362,-75.536805;10.1870840000001,-75.536805;10.1870840000001,-75.53736099999991;10.187362,-75.53736099999991;10.187362,-75.537637;10.1876400000001,-75.537637;10.1876400000001,-75.53791699999989;10.187918,-75.53791699999989;10.187918,-75.53819299999989;10.1876400000001,-75.53819299999989;10.1876400000001,-75.5387489999999;10.186806,-75.5387489999999;10.186806,-75.5390249999999;10.186527,-75.5390249999999;10.186527,-75.53930699999989;10.1862490000001,-75.53930699999989;10.1862490000001,-75.5395809999999;10.1859710000001,-75.5395809999999;10.1859710000001,-75.5401389999999;10.185696,-75.5401389999999;10.185696,-75.5404129999999;10.1851389999999,-75.5404129999999;10.1851389999999,-75.5406949999999;10.184861,-75.5406949999999;10.184861,-75.540969;10.1845830000001,-75.540969;10.1845830000001,-75.541251;10.183749,-75.541251;10.183749,-75.5415269999999;10.1831930000001,-75.5415269999999;10.1831930000001,-75.54208299999991;10.1829170000001,-75.54208299999991;10.1829170000001,-75.5426419999999;10.1826390000001,-75.5426419999999;10.1826390000001,-75.5434709999999;10.1823610000001,-75.5434709999999;10.1823610000001,-75.5437469999999;10.1809730000001,-75.5437469999999;10.1809730000001,-75.5434709999999;10.180417,-75.5434709999999;10.180417,-75.543198;10.1795830000002,-75.543198;10.1795830000002,-75.5434709999999;10.1793050000001,-75.5434709999999;10.1793050000001,-75.5437469999999;10.1795830000002,-75.5437469999999;10.1795830000002,-75.544586;10.1798610000001,-75.544586;10.1798610000001,-75.5448619999999;10.1801389999999,-75.5448619999999;10.1801389999999,-75.545135;10.180417,-75.545135;10.180417,-75.5456929999999;10.1806950000001,-75.5456929999999;10.1806950000001,-75.5459739999999;10.1809730000001,-75.5459739999999;10.1809730000001,-75.54625;10.1812490000002,-75.54625;10.1812490000002,-75.547364;10.1798610000001,-75.547364;10.1798610000001,-75.54708099999991;10.1793070000001,-75.54708099999991;10.1793070000001,-75.5468059999999;10.1790270000001,-75.5468059999999;10.1790270000001,-75.54708099999991;10.178751,-75.54708099999991;10.178751,-75.547364;10.1790270000001,-75.547364;10.1790270000001,-75.54792000000001;10.1793070000001,-75.54792000000001;10.1793070000001,-75.5490259999999;10.178751,-75.5490259999999;10.178751,-75.549584;10.1784729999999,-75.549584;10.1784729999999,-75.5498569999999;10.1776390000001,-75.5498569999999;10.1776390000001,-75.5490259999999;10.1779170000002,-75.5490259999999;10.1779170000002,-75.54875199999999;10.1781950000001,-75.54875199999999;10.1781950000001,-75.54763799999991;10.1776390000001,-75.54763799999991;10.1776390000001,-75.54792000000001;10.177085,-75.54792000000001;10.177085,-75.548196;10.1768049999999,-75.548196;10.1768049999999,-75.5484689999999;10.1765290000001,-75.5484689999999;10.1765290000001,-75.548196;10.1762510000001,-75.548196;10.1762510000001,-75.54763799999991;10.1765290000001,-75.54763799999991;10.1765290000001,-75.54652299999989;10.1762510000001,-75.54652299999989;10.1762510000001,-75.5456929999999;10.1759730000001,-75.5456929999999;10.1759730000001,-75.545418;10.175419,-75.545418;10.175419,-75.545135;10.1748630000001,-75.545135;10.1748630000001,-75.5448619999999;10.1745830000002,-75.5448619999999;10.1745830000002,-75.5443029999999;10.1743070000001,-75.5443029999999;10.1743070000001,-75.54402999999991;10.1740260000001,-75.54402999999991;10.1740260000001,-75.5437469999999;10.1734729999999,-75.5437469999999;10.1734729999999,-75.5434709999999;10.1731950000001,-75.5434709999999;10.1731970000001,-75.54291499999989;10.172916,-75.54291499999989;10.172916,-75.5426419999999;10.1723600000001,-75.5426419999999;10.1723600000001,-75.54235899999991;10.1704160000002,-75.54235899999991;10.170419,-75.54208299999991;10.1701380000001,-75.54208299999991;10.1701380000001,-75.5418099999999;10.169306,-75.5418099999999;10.169306,-75.54208299999991;10.1690280000001,-75.54208299999991;10.1690280000001,-75.5426419999999;10.1687500000002,-75.5426419999999;10.168753,-75.54291499999989;10.1684720000001,-75.54291499999989;10.1684720000001,-75.543198;10.1679160000001,-75.543198;10.1679160000001,-75.5434709999999;10.167638,-75.5434709999999;10.167638,-75.5437469999999;10.1670840000002,-75.5437469999999;10.1670840000002,-75.54402999999991;10.166528,-75.54402999999991;10.166528,-75.5443029999999;10.1656940000001,-75.5443029999999;10.1656940000001,-75.544586;10.164306,-75.544586;10.164306,-75.5448619999999;10.159027,-75.5448619999999;10.159027,-75.544586;10.1593050000001,-75.544586;10.1593050000001,-75.5437469999999;10.1595840000001,-75.5437469999999;10.1595840000001,-75.543198;10.159862,-75.543198;10.159862,-75.54291499999989;10.1601400000001,-75.54291499999989;10.1601400000001,-75.5426419999999;10.160418,-75.5426419999999;10.160418,-75.54235899999991;10.1606960000001,-75.54235899999991;10.1606960000001,-75.54208299999991;10.1612520000001,-75.54208299999991;10.1612500000001,-75.5418099999999;10.161528,-75.5418099999999;10.161528,-75.5415269999999;10.1618060000001,-75.5415269999999;10.1618060000001,-75.541251;10.162084,-75.541251;10.162084,-75.540969;10.16486,-75.540969;10.16486,-75.5406949999999;10.1651400000001,-75.5406949999999;10.1651400000001,-75.5404129999999;10.1656940000001,-75.5404129999999;10.1656940000001,-75.5398629999999;10.165972,-75.5398629999999;10.165972,-75.5387489999999;10.1662500000001,-75.5387489999999;10.1662500000001,-75.53819299999989;10.166528,-75.53819299999989;10.166528,-75.53736099999991;10.1668060000001,-75.53736099999991;10.1668060000001,-75.536805;10.166528,-75.536805;10.166528,-75.5365289999999;10.1662500000001,-75.5365289999999;10.1662500000001,-75.5359729999999;10.1656940000001,-75.5359729999999;10.1656940000001,-75.5356969999999;10.165416,-75.5356969999999;10.165416,-75.5354149999999;10.16486,-75.5354149999999;10.16486,-75.5351409999999;10.16375,-75.5351409999999;10.16375,-75.5348579999999;10.163194,-75.5348579999999;10.163194,-75.53458499999989;10.1629180000001,-75.53458499999989;10.1629180000001,-75.5340269999999;10.163194,-75.5340269999999;10.163194,-75.53346999999999;10.1634720000001,-75.53346999999999;10.1634720000001,-75.53319499999991;10.16375,-75.53319499999991;10.16375,-75.53291399999991;10.1634720000001,-75.53291399999991;10.1634720000001,-75.53280699999991;10.1634720000001,-75.532639;10.162638,-75.532639;10.162638,-75.53291399999991;10.161528,-75.53291399999991;10.161528,-75.53319499999991;10.160972,-75.53319499999991;10.160972,-75.53346999999999;10.160693,-75.53346999999999;10.1606960000001,-75.5340269999999;10.1601400000001,-75.5340269999999;10.1601400000001,-75.5354149999999;10.1595840000001,-75.5354149999999;10.1595840000001,-75.5356969999999;10.1593050000001,-75.5356969999999;10.1593050000001,-75.5359729999999;10.159027,-75.5359729999999;10.1590300000001,-75.53624599999991;10.1587490000001,-75.53624599999991;10.1587490000001,-75.536805;10.158471,-75.536805;10.1584740000001,-75.53736099999991;10.158196,-75.53736099999991;10.158196,-75.538788;10.158196,-75.5390249999999;10.157917,-75.5390249999999;10.157917,-75.5391089999999;10.157917,-75.53930699999989;10.1577400000001,-75.53930699999989;10.1576390000001,-75.53930699999989;10.1576390000001,-75.53942099999991;10.1576390000001,-75.5398629999999;10.157361,-75.5398629999999;10.157361,-75.5404129999999;10.1570830000001,-75.5404129999999;10.1570830000001,-75.5406949999999;10.156805,-75.5406949999999;10.1568080000001,-75.541251;10.1565270000001,-75.541251;10.1565270000001,-75.54235899999991;10.156249,-75.54235899999991;10.156251,-75.5426419999999;10.1559730000001,-75.5426419999999;10.1559730000001,-75.54291499999989;10.155693,-75.54291499999989;10.155695,-75.543198;10.155139,-75.543198;10.155139,-75.5434709999999;10.1548610000001,-75.5434709999999;10.1548610000001,-75.5437469999999;10.1543050000001,-75.5437469999999;10.1543050000001,-75.54402999999991;10.154027,-75.54402999999991;10.154029,-75.5443029999999;10.1537510000001,-75.5443029999999;10.1537510000001,-75.544586;10.153471,-75.544586;10.153473,-75.5448619999999;10.152917,-75.5448619999999;10.152917,-75.545135;10.1526390000001,-75.545135;10.1526390000001,-75.545418;10.1523430000001,-75.545418;10.1520830000001,-75.545418;10.1520830000001,-75.5456929999999;10.151805,-75.5456929999999;10.151807,-75.5459739999999;10.1515270000001,-75.5459739999999;10.1515270000001,-75.54625;10.151251,-75.54625;10.151251,-75.54652299999989;10.151174,-75.54652299999989;10.150695,-75.54652299999989;10.150695,-75.5468059999999;10.150139,-75.5468059999999;10.150139,-75.54708099999991;10.1493050000001,-75.54708099999991;10.1493050000001,-75.547364;10.1487510000001,-75.547364;10.1487510000001,-75.54763799999991;10.147917,-75.54763799999991;10.147919,-75.54792000000001;10.1459730000001,-75.54792000000001;10.1459730000001,-75.548196;10.1456939999999,-75.548196;10.1456939999999,-75.54875199999999;10.1454160000001,-75.54875199999999;10.1454160000001,-75.5493079999999;10.1448600000001,-75.5493079999999;10.1448600000001,-75.549584;10.144585,-75.549584;10.144585,-75.5501399999999;10.144304,-75.5501399999999;10.144304,-75.550416;10.1440279999999,-75.550416;10.1440279999999,-75.550698;10.1437500000001,-75.550698;10.1437500000001,-75.5509719999999;10.1434720000001,-75.5509719999999;10.1434720000001,-75.55152800000001;10.1431940000001,-75.55152800000001;10.1431940000001,-75.55180399999991;10.1429160000001,-75.55180399999991;10.1429160000001,-75.55235999999989;10.142638,-75.55235999999989;10.142638,-75.553117;10.142638,-75.55374999999999;10.1423599999999,-75.55374999999999;10.1423599999999,-75.5543059999999;10.1420820000001,-75.5543059999999;10.1420820000001,-75.55458;10.1418060000001,-75.55458;10.1418060000001,-75.5551379999999;10.1415280000001,-75.5551379999999;10.1415280000001,-75.555694;10.1412500000001,-75.555694;10.1412500000001,-75.5559699999999;10.140972,-75.5559699999999;10.140972,-75.556253;10.1406939999999,-75.556253;10.1406939999999,-75.55652600000001;10.1404160000001,-75.55652600000001;10.1404180000001,-75.5568089999999;10.1398620000001,-75.5568089999999;10.1398620000001,-75.55708199999999;10.1395840000001,-75.55708199999999;10.1395840000001,-75.55735799999989;10.1384720000001,-75.55735799999989;10.1384720000001,-75.55708199999999;10.1373619999999,-75.55708199999999;10.1373619999999,-75.55652600000001;10.1370290000001,-75.55652600000001;10.1368060000001,-75.55652600000001;10.1368060000001,-75.55663300000001;10.1368060000001,-75.5568089999999;10.1364280000001,-75.5568089999999;10.1354180000001,-75.5568089999999;10.1354180000001,-75.55708199999999;10.1348620000001,-75.55708199999999;10.1348620000001,-75.55735799999989;10.134308,-75.55735799999989;10.134308,-75.5576409999999;10.1329150000001,-75.5576409999999;10.1329150000001,-75.557914;10.132362,-75.557914;10.132362,-75.55819700000001;10.1318050000001,-75.55819700000001;10.1318050000001,-75.55847299999991;10.1312490000001,-75.55847299999991;10.1312490000001,-75.558746;10.1309710000002,-75.558746;10.130974,-75.559029;10.1306950000001,-75.559029;10.1306950000001,-75.5593039999999;10.130417,-75.5593039999999;10.1304200000001,-75.559585;10.1301390000001,-75.559585;10.1301390000001,-75.559747;10.1301390000001,-75.559861;10.129861,-75.559861;10.1298640000001,-75.5601429999999;10.1295830000001,-75.5601429999999;10.1295830000001,-75.560417;10.1290270000001,-75.560417;10.1290270000001,-75.560692;10.1284730000001,-75.560692;10.1284730000001,-75.5609749999999;10.1279170000001,-75.5609749999999;10.1279170000001,-75.5615309999999;10.1273610000001,-75.5615309999999;10.1273610000001,-75.56180499999989;10.1268050000001,-75.56180499999989;10.1268050000001,-75.56208;10.126527,-75.56208;10.126529,-75.56236299999991;10.1262510000001,-75.5624089999999;10.1262510000001,-75.5626369999999;10.125971,-75.5626369999999;10.1259730000002,-75.56291899999999;10.1257429999999,-75.562958;10.1256950000001,-75.5630189999999;10.1256950000001,-75.56319499999999;10.125417,-75.56319499999999;10.125417,-75.56330199999989;10.125417,-75.5634679999999;10.1252570000001,-75.5634679999999;10.1251390000001,-75.5634679999999;10.1251390000001,-75.5635909999999;10.1251390000001,-75.563751;10.1249930000001,-75.563751;10.1245830000001,-75.563751;10.1245830000001,-75.564027;10.124305,-75.564027;10.124305,-75.5643069999999;10.123749,-75.5643069999999;10.123749,-75.564583;10.123195,-75.564583;10.123195,-75.5665289999999;10.1234730000001,-75.5665289999999;10.1234730000001,-75.568749;10.123195,-75.568749;10.123195,-75.57069299999991;10.1234730000001,-75.57069299999991;10.1234730000001,-75.57096899999991;10.123749,-75.57096899999991;10.123749,-75.57152499999999;10.1240290000001,-75.57152499999999;10.1240290000001,-75.57263999999989;10.124305,-75.57263999999989;10.124305,-75.5734719999999;10.1245830000001,-75.5734719999999;10.1245830000001,-75.5740279999999;10.124861,-75.5740279999999;10.124861,-75.5745859999999;10.125417,-75.5745859999999;10.125417,-75.5748599999999;10.1259730000002,-75.5748599999999;10.125971,-75.5751419999999;10.1262510000001,-75.5751419999999;10.1262510000001,-75.5759739999999;10.1268050000001,-75.5759739999999;10.1268050000001,-75.57624800000001;10.127085,-75.57624800000001;10.127083,-75.57680599999991;10.1273610000001,-75.57680599999991;10.1273610000001,-75.57736199999989;10.1276390000002,-75.57736199999989;10.1276390000002,-75.5793079999999;10.1273610000001,-75.5793079999999;10.1273610000001,-75.579413;10.1273610000001,-75.579864;10.127083,-75.579864;10.127085,-75.5801399999999;10.1268050000001,-75.5801399999999;10.1268050000001,-75.58041399999991;10.126527,-75.58041399999991;10.126529,-75.580696;10.1259730000002,-75.580696;10.1259730000002,-75.58096999999989;10.1256950000001,-75.58096999999989;10.1256950000001,-75.58125199999991;10.124861,-75.58125199999991;10.124861,-75.58152799999991;10.1234730000001,-75.58152799999991;10.1234730000001,-75.58125199999991;10.1218050000001,-75.58125199999991;10.1218050000001,-75.58096999999989;10.1212510000001,-75.58096999999989;10.1212510000001,-75.58125199999991;10.120417,-75.58125199999991;10.120417,-75.58152799999991;10.1198600000001,-75.58152799999991;10.1198600000001,-75.5818019999999;10.119582,-75.5818019999999;10.1195850000001,-75.5820839999999;10.119307,-75.5820839999999;10.119307,-75.5818019999999;10.118472,-75.5818019999999;10.118472,-75.58152799999991;10.116806,-75.58152799999991;10.116806,-75.58125199999991;10.11625,-75.58125199999991;10.11625,-75.580696;10.1159720000001,-75.580696;10.1159720000001,-75.58047499999989;10.1159720000001,-75.579864;10.1154160000001,-75.579864;10.1154160000001,-75.5801399999999;10.1134580000001,-75.5801399999999;10.1131940000001,-75.5801399999999;10.1131940000001,-75.58041399999991;10.112916,-75.58041399999991;10.112918,-75.580696;10.1126380000001,-75.580696;10.1126380000001,-75.58096999999989;10.11236,-75.58096999999989;10.112362,-75.580696;10.1115280000001,-75.580696;10.1115280000001,-75.58041399999991;10.110694,-75.58041399999991;10.110696,-75.5801399999999;10.109584,-75.5801399999999;10.109584,-75.579864;10.109028,-75.579864;10.109028,-75.5795819999999;10.1076400000001,-75.5795819999999;10.1076400000001,-75.5793079999999;10.1068060000001,-75.5793079999999;10.106808,-75.5790259999999;10.1065280000001,-75.5790259999999;10.1065280000001,-75.5787499999999;10.1062489999999,-75.5787499999999;10.1062489999999,-75.5786359999999;10.1062489999999,-75.57847700000001;10.1056430000001,-75.57847700000001;10.1045829999999,-75.57847700000001;10.104586,-75.5781939999999;10.1040270000001,-75.5781939999999;10.1040270000001,-75.578041;10.1040270000001,-75.5779179999999;10.1035760000001,-75.5779179999999;10.103193,-75.5779179999999;10.103193,-75.57781299999991;10.103193,-75.57763799999989;10.1026390000001,-75.57763799999989;10.1026390000001,-75.57736199999989;10.101805,-75.57736199999989;10.101805,-75.577079;10.101249,-75.577079;10.101249,-75.57680599999991;10.1009730000001,-75.57680599999991;10.1009730000001,-75.57652999999991;10.100139,-75.57652999999991;10.100139,-75.57680599999991;10.099861,-75.57680599999991;10.099861,-75.57652999999991;10.0984250000001,-75.57652999999991;10.098195,-75.57652999999991;10.098195,-75.57624800000001;10.0973610000001,-75.576241;10.0973610000001,-75.5759739999999;10.0967750000002,-75.5759739999999;10.0954170000001,-75.5759739999999;10.095419,-75.57569099999991;10.093473,-75.57569099999991;10.093473,-75.57541599999991;10.0931950000001,-75.57541599999991;10.0931950000001,-75.5751419999999;10.0923600000001,-75.5751419999999;10.0923600000001,-75.57541599999991;10.0915290000001,-75.57541599999991;10.0915290000001,-75.5751419999999;10.0912500000001,-75.5751419999999;10.0912500000001,-75.5748599999999;10.0884720000001,-75.5748599999999;10.0884720000001,-75.5745859999999;10.0873620000001,-75.5745859999999;10.0873620000001,-75.5743029999999;10.086528,-75.5743029999999;10.086528,-75.5740279999999;10.085974,-75.5740279999999;10.085974,-75.57375399999989;10.0856940000001,-75.57375399999989;10.0856940000001,-75.5731959999999;10.085416,-75.5731959999999;10.085418,-75.572913;10.084862,-75.572913;10.084862,-75.57263999999989;10.0844380000001,-75.57263999999989;10.085081,-75.5691369999999;10.0851580000001,-75.5690449999999;10.086799,-75.5529999999999;10.091902,-75.547202;10.0977000000001,-75.544296;10.1012010000001,-75.54089999999989;10.1081,-75.5356969999999;10.1138,-75.531098;10.1173010000001,-75.52590099999991;10.1178,-75.517799;10.120102,-75.5131999999999;10.1166010000001,-75.50689800000001;10.1114,-75.50569899999989;10.102199,-75.51149699999991;10.0895,-75.5167009999999;10.0780020000001,-75.5206979999999;10.0635000000001,-75.5235969999999;10.0491000000001,-75.5263979999999;10.0410000000001,-75.52590099999991;10.0329000000002,-75.5148999999999;10.024201,-75.503899;10.0195009999999,-75.4959029999999;10.013701,-75.48490200000001;10.0043990000001,-75.481499;9.994599000000109,-75.4785999999999;9.984800999999999,-75.477401;9.971500000000111,-75.4767999999999;9.96280100000013,-75.474502;9.947799000000151,-75.471603;9.934500999999949,-75.47049800000001;9.921200000000059,-75.4728019999999;9.9085,-75.477898;9.895901000000091,-75.483102;9.88490200000007,-75.483102;9.878500000000029,-75.47910400000001;9.87959900000004,-75.46350099999999;9.884702000000001,-75.45030199999999;9.887001,-75.4382029999999;9.88060099999996,-75.4236979999999;9.87240100000008,-75.3972009999999;9.867601000000089,-75.36779799999989;9.86529900000005,-75.35279899999991;9.864100000000009,-75.3448039999999;9.85370100000006,-75.3378;9.83859900000016,-75.3360969999999;9.819001000000069,-75.3395;9.78550000000001,-75.3395;9.76930000000004,-75.34120299999999;9.756099000000059,-75.3481969999999;9.74169900000004,-75.354499;9.725501999999951,-75.3562019999999;9.716301000000041,-75.3636999999999;9.70129999999995,-75.3780969999999;9.688099000000021,-75.3879019999999;9.66620100000006,-75.39190000000001;9.65170100000006,-75.3912959999999;9.630299999999981,-75.3867029999999;9.62339900000012,-75.3814999999999;9.618701000000041,-75.37750199999989;9.61990000000014,-75.3693999999999;9.628502000000079,-75.360801;9.63769999999994,-75.3625029999999;9.653301000000109,-75.36419699999991;9.664300000000139,-75.36419699999991;9.667200999999981,-75.3572999999999;9.66889899999995,-75.3526979999999;9.672300000000011,-75.341797;9.676302000000019,-75.329103;9.678000000000001,-75.31989900000001;9.677900000000079,-75.2985009999999;9.67599899999999,-75.2668;9.67599899999999,-75.2518009999999;9.66889899999995,-75.2269969999999;9.65730100000013,-75.1970969999999;9.645101000000009,-75.1877979999999;9.62250100000006,-75.16999800000001;9.61030000000005,-75.161301;9.603301000000039,-75.1509019999999;9.594100000000079,-75.140502;9.58250000000004,-75.1302019999999;9.573800000000009,-75.1214979999999;9.566801,-75.105401;9.56030100000004,-75.08000199999999;9.556201000000099,-75.0655979999999;9.548000000000121,-75.043098;9.54280200000011,-75.033303;9.53410000000002,-75.024102;9.52710100000002,-75.017098;9.51987999999994,-75.009308;9.513198000000051,-75.0020989999999;9.50100000000015,-74.9935;9.492300000000061,-74.989997;9.48019800000009,-74.9807959999999;9.473199000000079,-74.9773019999999;9.46340100000009,-74.972703;9.45530100000013,-74.96869599999999;9.44370200000003,-74.965797;9.43500100000006,-74.9593969999999;9.43270100000001,-74.95659599999991;9.429802000000111,-74.94789899999989;9.423400000000131,-74.9403979999999;9.41640100000012,-74.936401;9.40950200000003,-74.93000099999991;9.39850000000013,-74.93350199999991;9.37720200000007,-74.9339979999999;9.347701000000029,-74.9334039999999;9.33090100000015,-74.93229599999999;9.2992010000001,-74.9281999999999;9.28240100000005,-74.9281999999999;9.26799899999997,-74.92710199999991;9.2448,-74.92530099999991;9.23209800000012,-74.92130400000001;9.21940100000012,-74.9178009999999;9.21207800000013,-74.9172129999999;9.20106100000004,-74.91378;9.20190400000013,-74.9112709999999;9.19340100000005,-74.9063019999999;9.18290100000007,-74.9021979999999;9.17370000000011,-74.9021979999999;9.16790200000003,-74.8970039999999;9.148201000000091,-74.885498;9.12040000000002,-74.86930099999989;9.10359800000003,-74.8519969999999;9.101900000000059,-74.8503039999999;9.089700000000111,-74.846801;9.0718,-74.84339799999999;9.06079900000015,-74.82839900000001;9.05200099999996,-74.816299;9.04340000000013,-74.8122009999999;9.032900000000151,-74.80239899999999;9.028900000000141,-74.7994999999999;9.019500999999989,-74.7805029999999;9.014801000000091,-74.7568959999999;9.01239900000013,-74.7400959999999;8.999100000000061,-74.715897;8.98740100000003,-74.6962959999999;8.96600000000012,-74.673799;8.93579900000009,-74.65479999999999;8.894702000000001,-74.6248019999999;8.87620000000004,-74.616096;8.86170000000004,-74.60169999999989;8.840298999999961,-74.5913009999999;8.82409900000005,-74.5843969999999;8.81129900000002,-74.5809009999999;8.79000100000013,-74.580299;8.787699000000091,-74.579201;8.770899000000041,-74.5751029999999;8.75469900000007,-74.580299;8.736300000000091,-74.59700100000001;8.7306000000001,-74.6136999999999;8.729501000000081,-74.620102;8.72430000000003,-74.6240999999999;8.718500000000059,-74.6252989999999;8.701801000000049,-74.6258;8.6787010000001,-74.61949799999989;8.6613000000001,-74.61659899999999;8.64570000000003,-74.61599799999991;8.628899999999989,-74.6108009999999;8.611601000000061,-74.6067969999999;8.58790100000004,-74.6050029999999;8.574000000000069,-74.6050029999999;8.56540100000001,-74.5997999999999;8.551501000000091,-74.5905989999999;8.54220200000003,-74.594002;8.526601000000079,-74.59580199999991;8.511600000000041,-74.58940200000001;8.500601000000019,-74.58019899999989;8.492501000000001,-74.5708999999999;8.484300000000021,-74.5669029999999;8.474000999999991,-74.5691979999999;8.465901000000031,-74.5686029999999;8.44909899999999,-74.561095;8.432300000000049,-74.55880000000001;8.417301000000011,-74.55880000000001;8.40930100000014,-74.5673969999999;8.39890100000008,-74.57199899999991;8.390199000000051,-74.57669799999999;8.380998000000091,-74.577797;8.370599000000141,-74.577797;8.36200000000008,-74.5876019999999;8.36200000000008,-74.5934;8.36200000000008,-74.5968029999999;8.36200000000008,-74.60369899999991;8.36779799999999,-74.6089029999999;8.370802000000079,-74.62100199999991;8.36790000000013,-74.62280300000001;8.330399,-74.6290979999999;8.314801000000161,-74.630798;8.313101000000019,-74.6406029999999;8.308499000000101,-74.65149699999991;8.298200000000071,-74.656097;8.29070100000007,-74.6641989999999;8.28029900000001,-74.675697;8.283200999999959,-74.68379999999991;8.287401000000051,-74.6999969999999;8.287401000000051,-74.71260100000001;8.276500000000111,-74.73339799999999;8.26500000000004,-74.7511979999999;8.25870000000015,-74.7540969999999;8.254700000000071,-74.76909600000001;8.249499000000011,-74.77310299999991;8.23920000000015,-74.784699;8.22589900000008,-74.7828989999999;8.214400999999951,-74.7881019999999;8.203502000000009,-74.8024969999999;8.19720200000012,-74.816901;8.196101000000001,-74.827905;8.194900000000081,-74.8365019999999;8.18532999999996,-74.833938;8.17930000000001,-74.8198019999999;8.16710200000011,-74.8065039999999;8.161299000000099,-74.79499899999991;8.151401000000019,-74.7881019999999;8.13920000000002,-74.778801;8.11600100000004,-74.749398;8.096300000000159,-74.7292019999999;8.07310100000001,-74.70790099999989;8.048700999999991,-74.67729899999991;8.018600000000051,-74.6508019999999;7.995900000000011,-74.62660199999991;7.976201000000059,-74.602897;7.94200000000001,-74.5695029999999;7.927528,-74.5551609999999;7.91990000000004,-74.547601;7.904900999999939,-74.5389009999999;7.88640100000015,-74.53829999999989;7.85690000000011,-74.5394979999999;7.81880000000001,-74.53479900000001;7.796799000000019,-74.53420199999989;7.766202000000079,-74.5238039999999;7.74190199999998,-74.5151979999999;7.727399000000101,-74.5008009999999;7.70940100000007,-74.4805989999999;7.69720099999995,-74.4770959999999;7.678799000000081,-74.48979899999991;7.648901000000079,-74.515098;7.63450000000012,-74.53299799999991;7.62420200000014,-74.55259699999991;7.615601000000081,-74.56350000000001;7.60350100000011,-74.570998;7.57860100000011,-74.5703969999999;7.56479899999994,-74.5744009999999;7.540601000000089,-74.57959699999989;7.49500000000006,-74.5979989999999;7.468501000000061,-74.61129799999991;7.454099000000041,-74.615897;7.428700000000111,-74.614097;7.4217010000001,-74.60949700000001;7.41760099999999,-74.600898;7.4072010000001,-74.595704;7.400300000000019,-74.592201;7.393900000000031,-74.58820299999999;7.38520100000005,-74.580703;7.37239900000003,-74.569701;7.37010200000009,-74.557602;7.357300000000071,-74.54149699999989;7.34509900000006,-74.530503;7.33299900000003,-74.5264959999999;7.32660000000016,-74.52130199999991;7.31910100000016,-74.5160979999999;7.31730100000004,-74.50689800000001;7.322499999999989,-74.4971019999999;7.32470100000006,-74.489;7.32470100000006,-74.4821009999999;7.32700100000011,-74.47460199999991;7.33100100000013,-74.471099;7.34429900000015,-74.4693989999999;7.351800000000081,-74.4664999999999;7.36100100000004,-74.4561999999999;7.3771010000001,-74.4383;7.3904,-74.4343029999999;7.405399000000051,-74.430802;7.41459900000007,-74.42909899999999;7.42380000000003,-74.4261999999999;7.43420000000009,-74.4222029999999;7.44460000000009,-74.4117959999999;7.45320100000015,-74.4055029999999;7.46069900000003,-74.402;7.46929900000004,-74.391701;7.47100099999994,-74.3893969999999;7.46240000000012,-74.386498;7.44560000000007,-74.38130099999989;7.43399900000014,-74.37779999999999;7.4190000000001,-74.375503;7.40740000000005,-74.375503;7.39820100000009,-74.3703;7.38370100000009,-74.36280100000001;7.37100000000009,-74.364502;7.35950100000008,-74.372002;7.35319900000002,-74.38239999999991;7.34169900000012,-74.3916009999999;7.3365,-74.3973009999999;7.32960100000008,-74.40540300000001;7.32100000000008,-74.4209969999999;7.31060000000002,-74.4261999999999;7.29910000000012,-74.426697;7.282300000000079,-74.4250039999999;7.26500100000015,-74.422095;7.26150100000007,-74.42269899999999;7.25049899999999,-74.42089900000001;7.245166000000149,-74.41993699999991;7.23779999999999,-74.41860200000001;7.20839900000004,-74.4232029999999;7.192800999999969,-74.426102;7.18699999999996,-74.4278019999999;7.17020100000002,-74.4272009999999;7.14589800000005,-74.4162969999999;7.1280000000001,-74.4093029999999;7.110100000000159,-74.406404;7.093301000000001,-74.4001019999999;7.07360000000011,-74.3856949999999;7.05630100000002,-74.3793019999999;7.042401000000101,-74.3723989999999;7.02159900000004,-74.3718039999999;7.00600099999997,-74.373497;7.00080000000008,-74.3718039999999;6.99730100000011,-74.3654019999999;6.99730100000011,-74.3584979999999;6.99720100000002,-74.355103;6.98800000000006,-74.345298;6.982701000000019,-74.33550199999991;6.979202000000039,-74.31639799999989;6.98430100000007,-74.3095019999999;6.98660100000012,-74.299697;6.986407000000039,-74.296531;6.98600100000004,-74.2899009999999;6.983698999999999,-74.2853019999999;6.98480200000012,-74.2771989999999;6.98650000000009,-74.267999;6.98530100000005,-74.261704;6.985201000000069,-74.2483979999999;7.26360199999999,-73.9540019999999;7.27510000000012,-73.95860399999999;7.286699000000059,-73.952904;7.29770000000008,-73.9534979999999;7.31320100000011,-73.941902;7.344999000000141,-73.93849899999989;7.38070000000016,-73.92700099999991;7.39340100000015,-73.9263989999999;7.428700000000111,-73.9281999999999;7.43858000000012,-73.93289300000001;7.4593000000001,-73.9357009999999;7.470901000000031,-73.9339979999999;7.48870100000005,-73.91439799999991;7.50710000000004,-73.89540099999989;7.51849800000008,-73.8898529999999;7.52150000000012,-73.8883969999999;7.5578000000001,-73.86889699999991;7.58140000000003,-73.856797;7.593000999999959,-73.856797;7.59930100000003,-73.8544999999999;7.61840000000007,-73.8441;7.6524,-73.840699;7.66919899999999,-73.8413009999999;7.680100000000101,-73.8366989999999;7.693400999999991,-73.83719599999991;7.716498,-73.8366989999999;7.72570100000013,-73.8285969999999;7.74359900000007,-73.8245999999999;7.76040100000012,-73.8245999999999;7.77250100000009,-73.8337999999999;7.79620000000006,-73.840797;7.819400999999971,-73.8464979999999;7.837900999999991,-73.8464979999999;7.86440000000016,-73.8482979999999;7.88580200000013,-73.85520199999991;7.90840100000003,-73.8638989999999;7.92230000000001,-73.8662029999999;7.950600000000121,-73.87599899999999;7.97610100000014,-73.89040299999991;7.997500000000001,-73.89279999999999;8.01360000000005,-73.89279999999999;8.02810200000005,-73.89160199999991;8.037300000000069,-73.88870300000001;8.049400000000111,-73.88870300000001;8.05700100000001,-73.8881989999999;8.062701000000001,-73.884101;8.069001000000069,-73.8767009999999;8.078801,-73.86460099999989;8.08859900000016,-73.84780099999991;8.09830099999999,-73.83519799999991;8.11330000000004,-73.823098;8.12055500000008,-73.818977;8.118317000000051,-73.8076019999999;8.126501000000021,-73.809197;8.13050100000004,-73.80059799999989;8.13340000000011,-73.80349699999989;8.14439900000013,-73.80180399999991;8.15590200000014,-73.8023009999999;8.1681000000001,-73.807;8.17679900000007,-73.8093039999999;8.18540100000001,-73.79889799999999;8.200400000000061,-73.7937009999999;8.21879900000005,-73.78449999999999;8.232099999999949,-73.77300200000001;8.25629999999995,-73.77590099999991;8.26729899999998,-73.7724009999999;8.28109900000015,-73.768998;8.29330000000016,-73.77130199999991;8.31810099999996,-73.77709999999991;8.34070100000014,-73.77770199999991;8.36090100000013,-73.77709999999991;8.38400000000013,-73.7718969999999;8.42270000000013,-73.7718969999999;8.440600000000069,-73.77480300000001;8.44180099999994,-73.77709999999991;8.4590980000001,-73.7818;8.474199000000061,-73.7903969999999;8.4892000000001,-73.80079599999991;8.510602000000061,-73.80660399999989;8.53030000000007,-73.806;8.55160100000001,-73.807198;8.566700000000029,-73.81240200000001;8.578799999999999,-73.818703;8.59560200000004,-73.8267969999999;8.617600000000101,-73.8434979999999;8.640701000000149,-73.8412009999999;8.65460000000013,-73.83609799999989;8.665501000000059,-73.8326039999999;8.672500000000071,-73.8302999999999;8.685202000000119,-73.827401;8.70250000000016,-73.8263019999999;8.722100999999951,-73.8245999999999;8.73359900000008,-73.8210989999999;8.75670000000008,-73.815399;8.778701000000069,-73.8177029999999;8.79430200000002,-73.8310019999999;8.815199000000121,-73.8477029999999;8.82390100000015,-73.85749899999991;8.839501000000039,-73.864997;8.85519800000009,-73.87129899999999;8.879400000000089,-73.878303;8.905501000000021,-73.8863979999999;8.92280100000005,-73.884598;8.94590000000005,-73.87999599999991;8.95679899999999,-73.8771969999999;8.97029900000001,-73.90889799999999;8.969802000000129,-73.93079999999991;8.96930000000015,-73.9515;8.978599000000029,-73.97460099999989;8.978100000000151,-73.985497;8.975301,-74.00280099999991;8.97750100000013,-74.0120859999999;8.97939899999994,-74.0201039999999;8.989199999999981,-74.018401;8.99619899999999,-74.024199;9.002601000000031,-74.044404;9.018798999999939,-74.0530009999999;9.02060100000006,-74.06970200000001;9.00330100000002,-74.083001;9.001701000000139,-74.0951009999999;9.00690200000008,-74.11640199999989;9.00529900000015,-74.1285019999999;9.00710200000009,-74.14240199999991;9.008800000000059,-74.1446999999999;9.008201000000099,-74.1470039999999;9.009399000000091,-74.1503969999999;9.01459800000004,-74.149299;9.02380099999993,-74.149299;9.032501000000019,-74.147599;9.043000999999951,-74.16539899999989;9.0517000000001,-74.184997;9.059800000000109,-74.195998;9.067900000000069,-74.1995009999999;9.07370100000009,-74.20349899999999;9.08759900000001,-74.2127;9.128199,-74.25430299999989;9.13980000000009,-74.263497;9.1486000000001,-74.2796019999999;9.151000000000071,-74.30210099999989;9.14759900000001,-74.31939800000001;9.14700000000005,-74.322898;9.153999000000059,-74.32689600000001;9.15969900000005,-74.3170999999999;9.16370199999994,-74.31079799999991;9.173000000000121,-74.308998;9.18160000000006,-74.311897;9.187998999999991,-74.321198;9.19030100000003,-74.325203;9.19849900000014,-74.344803;9.20430000000016,-74.35459899999999;9.208999000000061,-74.3638;9.20620100000002,-74.380501;9.20279800000003,-74.39209799999991;9.198800000000009,-74.4082039999999;9.196503000000011,-74.41220199999999;9.19190100000009,-74.424897;9.197699,-74.43240399999991;9.205802000000061,-74.4319;9.21270100000015,-74.4319;9.22720100000015,-74.445099;9.235401000000021,-74.45150099999999;9.243499000000041,-74.4607019999999;9.238400000000009,-74.483199;9.23439999999999,-74.4953009999999;9.226300000000039,-74.50679699999991;9.22229999999996,-74.5159979999999;9.22360000000009,-74.53389799999999;9.230500999999951,-74.53619999999989;9.24550000000005,-74.540802;9.26580000000013,-74.5593039999999;9.282100000000011,-74.57369900000001;9.303598999999959,-74.60140199999999;9.31750199999993,-74.623902;9.333201000000029,-74.633697;9.35170100000005,-74.6377039999999;9.3621,-74.6399989999999;9.37080200000003,-74.649804;9.3766,-74.6682969999999;9.39750200000015,-74.6798019999999;9.40270100000004,-74.68679899999989;9.410615999999999,-74.752304;9.410001000000079,-74.7656999999999;9.416302999999971,-74.7721019999999;9.423899000000009,-74.78250199999999;9.428002000000051,-74.7946019999999;9.428601000000009,-74.80899699999991;9.433799999999961,-74.811898;9.44140100000004,-74.8142;9.450599000000119,-74.81590299999991;9.46390000000002,-74.81590299999991;9.47540100000003,-74.81300399999991;9.49390000000011,-74.8102029999999;9.507199000000011,-74.809601;9.5141000000001,-74.80850199999991;9.51640000000015,-74.809601;9.527400999999999,-74.806702;9.541799000000079,-74.81079799999991;9.55220100000008,-74.80850199999991;9.55970099999996,-74.79699700000001;9.569502,-74.789497;9.583900999999971,-74.7843029999999;9.58560099999994,-74.781404;9.600600000000041,-74.77739699999999;9.61160200000012,-74.7878029999999;9.62150000000003,-74.7964019999999;9.63769999999994,-74.81079799999991;9.65219999999994,-74.81890199999999;9.66030000000012,-74.82640000000001;9.666101000000079,-74.8321989999999;9.67940199999998,-74.84079800000001;9.691000000000029,-74.8466029999999;9.705500000000031,-74.845497;9.71240100000011,-74.84079800000001;9.72620100000006,-74.831597;9.74180000000001,-74.82469999999989;9.75220200000007,-74.8242029999999;9.761400000000091,-74.8229979999999;9.77240200000006,-74.828796;9.78170100000011,-74.83339699999991;9.788000000000119,-74.8396989999999;9.79899900000015,-74.84380400000001;9.80480199999994,-74.84380400000001;9.81230000000005,-74.85299600000001;9.81579899999997,-74.8524009999999;9.826198000000151,-74.85299600000001;9.84010100000012,-74.8570999999999;9.851100000000139,-74.86689799999991;9.859200000000101,-74.87719800000001;9.873700000000101,-74.8818969999999;9.884702000000001,-74.88480299999991;9.897401,-74.89;9.906700000000059,-74.8917;9.912400000000099,-74.8888009999999;9.92220000000003,-74.885398;9.93090000000007,-74.8772959999999;9.934300000000009,-74.87329800000001;9.94289900000007,-74.86170199999999;9.94690100000008,-74.85189699999989;9.951501000000009,-74.834603;9.954302000000149,-74.8289029999999;9.958901000000029,-74.8122009999999;9.97210000000001,-74.80239899999999;9.98660199999995,-74.8105009999999;10.0017010000001,-74.81970199999989;10.019601,-74.8294979999999;10.035202,-74.8347009999999;10.0474000000001,-74.84049899999999;10.0497,-74.8422019999999;10.056699,-74.846801;10.073501,-74.8675999999999;10.0799000000001,-74.8807989999999;10.0823000000001,-74.90160299999999;10.079499,-74.9263999999999;10.084798,-74.9419029999999;10.094102,-74.95459700000001;10.105101,-74.95639799999989;10.1137000000001,-74.9569019999999;10.1264020000002,-74.95229999999999;10.1426020000001,-74.9505999999999;10.1593010000001,-74.942595;10.1743,-74.940804;10.1864,-74.9396959999999;10.2031990000002,-74.935097;10.2141030000001,-74.9275959999999;10.2164000000001,-74.9275959999999;10.223402,-74.9321979999999;10.2349000000002,-74.92880200000001;10.2406980000001,-74.9281999999999;10.2505010000001,-74.924697;10.274299,-74.9517989999999;10.2749010000001,-74.95760299999991;10.2766010000001,-74.95880199999991;10.282399,-74.965699;10.304999,-74.9801029999999;10.3130990000001,-74.9887999999999;10.3247000000001,-74.99569700000001;10.3339990000001,-75.00840099999991;10.345101,-75.0234;10.3549010000001,-75.034301;10.3543989999999,-75.0411979999999;10.3543989999999,-75.0464009999999;10.3585,-75.05680099999989;10.363101,-75.0614019999999;10.371199,-75.0717999999999;10.375901,-75.076401;10.3810999999999,-75.0839;10.388099,-75.09309999999989;10.3927,-75.100601;10.393901,-75.1057969999999;10.3957,-75.11450099999991;10.3969010000001,-75.1207959999999;10.3992000000001,-75.1334979999999;10.400399,-75.144502;10.4033010000001,-75.15080399999989;10.4097,-75.154297;10.423601,-75.15950100000001;10.4340010000001,-75.169296;10.4434000000001,-75.185401;10.4462990000001,-75.189401;10.4492,-75.19409999999991;10.456101,-75.2015989999999;10.4613,-75.20729899999991;10.4723990000001,-75.2193989999999;10.477001,-75.22640199999989;10.483401,-75.23670199999989;10.4864,-75.251701;10.4945,-75.26149700000001;10.4996990000001,-75.265;10.5142010000001,-75.2685;10.5280010000001,-75.2695989999999;10.537902,-75.2718959999999;10.5541019999999,-75.27600099999989;10.5697,-75.2806029999999;10.577798,-75.2806029999999;10.5962000000001,-75.2806029999999;10.604899,-75.274299;10.6176010000001,-75.26909499999989;10.6290990000001,-75.2678989999999;10.644702,-75.2668;10.6573990000001,-75.2650979999999;10.6666,-75.2633969999999;10.685701,-75.25589699999991;10.701801,-75.25129699999999;10.7134020000001,-75.249;10.7249,-75.24960399999991;10.7336000000001,-75.2524029999999;10.7394,-75.25299799999991;10.7560990000001,-75.25129699999999;10.801527,-75.26061900000001;', 8, NULL),
(6, 1, NULL, 'Boyacá', '5.75953', '-73.1218', '7.02750000000015,-72.212998;7.02579900000012,-72.21929900000001;7.01320000000004,-72.2268;7.00620100000003,-72.23200300000001;6.99360000000013,-72.237802;6.98490000000004,-72.243499;6.97969900000015,-72.2470019999999;6.976299000000039,-72.252197;6.97230099999996,-72.2573019999999;6.969999000000141,-72.263702;6.96599900000007,-72.269997;6.965400000000101,-72.274101;6.964901,-72.2791969999999;6.964299000000099,-72.28620099999991;6.96950000000004,-72.2856;6.97470100000015,-72.2856;6.98110100000014,-72.285005;6.983900000000121,-72.2844009999999;6.98680099999996,-72.2856;6.99260100000009,-72.2901989999999;6.99260100000009,-72.294297;6.99330100000009,-72.30169699999991;6.99269900000002,-72.3075019999999;6.988700000000049,-72.31379699999999;6.984100000000131,-72.3179019999999;6.97139900000013,-72.322501;6.958699000000021,-72.328796;6.94890100000009,-72.33229900000001;6.932799000000051,-72.339797;6.92300100000011,-72.344399;6.909101000000021,-72.3535999999999;6.90400000000005,-72.3575969999999;6.894701,-72.3656999999999;6.88730099999998,-72.3709029999999;6.88330099999996,-72.3812019999999;6.878100000000069,-72.3898999999999;6.873501000000029,-72.3991;6.86780100000004,-72.405997;6.86489900000009,-72.41179800000001;6.857400999999981,-72.423303;6.85750100000013,-72.4318999999999;6.85750100000013,-72.43939999999991;6.85929900000002,-72.44809699999991;6.86279999999994,-72.46019699999989;6.8669000000001,-72.4664989999999;6.872701000000121,-72.47350299999989;6.87680100000006,-72.4879;6.880798000000029,-72.4867009999999;6.88260100000014,-72.4959019999999;6.886100000000109,-72.501099;6.888399000000109,-72.5127039999999;6.8925000000001,-72.5184019999999;6.89309900000012,-72.5259019999999;6.89429999999999,-72.5310969999999;6.87179999999995,-72.5345999999999;6.85439900000011,-72.52649699999991;6.846299000000159,-72.525299;6.83130000000011,-72.5246969999999;6.82090099999994,-72.52359799999989;6.79949900000003,-72.51949999999989;6.78100000000006,-72.5160979999999;6.764299999999929,-72.51779999999999;6.74920100000014,-72.517196;6.739401000000041,-72.51889899999991;6.72730100000001,-72.521798;6.71810000000005,-72.523498;6.71520100000004,-72.523498;6.695001000000051,-72.523498;6.68290100000002,-72.525201;6.67130000000009,-72.5280999999999;6.65339999999998,-72.5241019999999;6.64239899999995,-72.523498;6.62100000000009,-72.5258019999999;6.61119999999994,-72.527496;6.598000999999949,-72.5395959999999;6.58650100000006,-72.554604;6.57380099999995,-72.56210400000001;6.57210099999998,-72.56089899999991;6.570282000000129,-72.56191299999991;6.561701000000139,-72.5667039999999;6.55080000000004,-72.570099;6.53860000000014,-72.57240399999991;6.52299899999997,-72.570701;6.50400000000008,-72.5661019999999;6.49179999999996,-72.56549800000001;6.482002000000019,-72.56369700000001;6.47329999999994,-72.56549800000001;6.470465000000051,-72.56783399999991;6.47170000000011,-72.5757969999999;6.464701000000101,-72.5803989999999;6.46530100000001,-72.582801;6.464802000000079,-72.58910299999999;6.463600000000099,-72.59429900000001;6.45730100000014,-72.5977019999999;6.45390000000009,-72.60289899999989;6.44980000000015,-72.609298;6.44470000000007,-72.616204;6.43830000000003,-72.62020199999991;6.43430000000001,-72.62480100000001;6.43030000000016,-72.629403;6.42740100000009,-72.632897;6.42340100000007,-72.6386029999999;6.41940100000005,-72.6433029999999;6.41590000000014,-72.65070299999999;6.41540100000003,-72.65540300000001;6.41370100000006,-72.661103;6.413099000000159,-72.6640019999999;6.41430000000008,-72.67259899999991;6.41260000000011,-72.6807009999999;6.41260000000011,-72.68530300000001;6.41730000000013,-72.6911009999999;6.4248,-72.695099;6.42830100000015,-72.6968989999999;6.433500000000089,-72.69860199999989;6.438700999999979,-72.70150099999999;6.439799000000111,-72.70320099999989;6.44100000000014,-72.7049039999999;6.443900000000101,-72.7067039999999;6.446201000000089,-72.7100979999999;6.44910100000004,-72.71189799999991;6.4509010000001,-72.714797;6.45150000000012,-72.7175979999999;6.4654010000001,-72.72689699999999;6.47460000000007,-72.72689699999999;6.48390100000012,-72.730904;6.49250000000001,-72.7338029999999;6.50119900000016,-72.73780099999991;6.50990100000001,-72.74249999999989;6.52210100000013,-72.7488019999999;6.52730200000002,-72.7574989999999;6.530801,-72.7638009999999;6.5668,-72.80190399999989;6.562200000000019,-72.80650300000001;6.554700000000141,-72.81169899999991;6.54780100000005,-72.8168019999999;6.544899000000101,-72.821404;6.544899000000101,-72.833;6.53689999999995,-72.8387;6.51080100000007,-72.827797;6.49520100000001,-72.812798;6.47199900000015,-72.79319699999991;6.4633,-72.78569899999989;6.456899999999961,-72.7781979999999;6.44650000000013,-72.770698;6.439501000000121,-72.7655029999999;6.428498999999991,-72.7584999999999;6.423298000000101,-72.75679699999991;6.40950100000003,-72.757401;6.39910100000014,-72.75969600000001;6.39159999999998,-72.76080399999999;6.38460099999998,-72.762604;6.37890099999998,-72.7619999999999;6.369599999999929,-72.762604;6.36620200000016,-72.76370299999989;6.363802000000021,-72.76370299999989;6.34310000000005,-72.768897;6.325199999999939,-72.7741;6.30960100000016,-72.78150099999991;6.29230099999995,-72.787301;6.27839999999998,-72.7844019999999;6.265199,-72.78379799999991;6.24440000000004,-72.7883999999999;6.23110100000014,-72.7890009999999;6.21900100000011,-72.7941979999999;6.19879899999995,-72.81150100000001;6.190200000000119,-72.8258979999999;6.184500000000069,-72.8332989999999;6.17640000000011,-72.8403019999999;6.16840000000008,-72.845399;6.15630000000004,-72.85520099999999;6.14940099999995,-72.8673009999999;6.143099000000061,-72.87539700000001;6.13850000000008,-72.882302;6.127601000000139,-72.8904049999999;6.11780099999999,-72.8966969999999;6.113199000000071,-72.90479999999999;6.10970100000003,-72.906502;6.10220000000004,-72.9111009999999;6.10170099999999,-72.9133989999999;6.10050000000007,-72.917998;6.0988000000001,-72.91980099999989;6.0827000000001,-72.92729899999991;6.07919900000013,-72.932405;6.067700999999999,-72.938203;6.06310200000001,-72.94339699999991;6.058500000000089,-72.94740399999991;6.052699999999959,-72.9542999999999;6.045801000000041,-72.960098;6.04530199999999,-72.96639999999999;6.04010100000005,-72.97219799999991;6.037801000000001,-72.97509699999991;6.032600000000119,-72.9796989999999;6.02400100000006,-72.984298;6.01650000000006,-72.9877009999999;6.01010000000008,-72.9934989999999;6.00089900000012,-72.997497;5.99630000000008,-73.0003959999999;5.99230000000006,-73.00160099999989;5.98770100000002,-73.00269999999991;5.974999000000139,-73.0130999999999;5.97330099999999,-73.0183029999999;5.96810000000005,-73.02860199999991;5.96470000000011,-73.03559899999991;5.961801000000039,-73.0412969999999;5.957801000000019,-73.0425029999999;5.953801,-73.0482029999999;5.952600000000069,-73.051697;5.954400000000019,-73.060898;5.95330000000013,-73.0672999999999;5.9511,-73.0892019999999;5.95279800000014,-73.0971969999999;5.95639900000003,-73.11279999999989;5.95639900000003,-73.117402;5.95810000000006,-73.12550400000001;5.958199999999979,-73.1330029999999;5.95710100000002,-73.143897;5.955900000000101,-73.1508029999999;5.95650000000001,-73.1559989999999;5.95889900000009,-73.1647029999999;5.959501000000161,-73.1692959999999;5.961801000000039,-73.175597;5.963599000000159,-73.1779019999999;5.96470000000011,-73.180801;5.96939900000007,-73.189498;5.964800000000029,-73.2026989999999;5.9654000000001,-73.20680299999999;5.96660100000003,-73.21019699999989;5.97010100000006,-73.2153999999999;5.975299999999999,-73.2240969999999;5.97760000000005,-73.2321019999999;5.977100999999951,-73.236701;5.97019899999998,-73.24189799999991;5.95350000000013,-73.248803;5.94080100000014,-73.251098;5.93210100000005,-73.2557;5.91999900000008,-73.2602989999999;5.91370000000006,-73.262603;5.90149900000006,-73.2660969999999;5.896401000000141,-73.2689959999999;5.893500000000069,-73.27529800000001;5.885999000000141,-73.2873979999999;5.86930000000007,-73.294297;5.861200000000109,-73.2966009999999;5.85090000000002,-73.3023989999999;5.84680000000003,-73.30819799999991;5.84520000000003,-73.3179019999999;5.84060099999999,-73.3237;5.83830100000012,-73.33350299999989;5.83780000000002,-73.34850399999991;5.83549999999997,-73.3593979999999;5.83439900000002,-73.3692009999999;5.83439900000002,-73.3749989999999;5.82410000000016,-73.3877029999999;5.819500999999951,-73.3906019999999;5.81490100000002,-73.3928989999999;5.80910100000011,-73.3945999999999;5.79520100000002,-73.39520400000001;5.790000000000129,-73.3956979999999;5.78480100000002,-73.3968969999999;5.77220000000011,-73.4089969999999;5.75599900000009,-73.418198;5.75370000000009,-73.4205019999999;5.74510100000003,-73.4240029999999;5.74050100000011,-73.429703;5.74520099999995,-73.4383999999999;5.75150000000014,-73.44699899999991;5.75500100000011,-73.44760100000001;5.76200000000011,-73.44989800000001;5.76830000000001,-73.4522019999999;5.770600000000061,-73.45339900000001;5.778200000000079,-73.4562979999999;5.78909899999996,-73.4615009999999;5.79030000000006,-73.46320399999991;5.792101000000059,-73.4701009999999;5.79730199999995,-73.47640199999989;5.80140000000011,-73.478798;5.80830099999997,-73.48219999999991;5.81470100000001,-73.48629800000001;5.822199000000071,-73.489701;5.826201000000081,-73.4932019999999;5.83260100000012,-73.4961009999999;5.83780000000002,-73.49659799999991;5.84530100000001,-73.49780300000001;5.84240100000005,-73.4816969999999;5.85390000000007,-73.471299;5.86020200000013,-73.46839799999999;5.86434700000007,-73.467299;5.86669300000005,-73.46752100000001;5.86826500000006,-73.464874;5.87060100000008,-73.462096;5.87570000000011,-73.451104;5.88609900000006,-73.4470969999999;5.894801000000091,-73.4412989999999;5.90400000000005,-73.4367;5.91260100000011,-73.430398;5.928200000000061,-73.4241029999999;5.9461,-73.412498;5.953001000000091,-73.4091039999999;5.960499000000139,-73.40390099999991;5.96849900000001,-73.4028019999999;5.98469900000015,-73.4091039999999;5.99460000000011,-73.4160009999999;6.0021010000001,-73.419501;6.01080200000007,-73.42529999999989;6.01660000000015,-73.431;6.0206,-73.4316009999999;6.02530000000007,-73.432199;6.040901000000021,-73.43740200000001;6.0455,-73.440805;6.05080100000004,-73.450698;6.051900000000051,-73.45529999999999;6.056599000000009,-73.463897;6.06530100000003,-73.476601;6.0682000000001,-73.48519999999991;6.07000100000005,-73.495597;6.072900000000119,-73.50140399999989;6.077601000000071,-73.5054019999999;6.08510000000007,-73.5083009999999;6.089699000000111,-73.51349500000001;6.09030099999995,-73.5169979999999;6.08980200000008,-73.52559699999991;6.09440100000012,-73.5330959999999;6.083500000000019,-73.53939799999991;6.068501000000139,-73.54920199999989;6.064501000000119,-73.5510029999999;6.05640099999994,-73.55500099999991;6.05120000000005,-73.55729599999999;6.046001000000101,-73.560799;6.02990100000005,-73.5659019999999;6.01949900000005,-73.57399700000001;6.0091000000001,-73.5791999999999;6.00569900000005,-73.5843969999999;5.99990100000014,-73.5913;5.99650100000002,-73.5976019999999;5.98970000000003,-73.6039039999999;5.986192000000071,-73.605071;5.974001000000159,-73.610901;5.96889999999996,-73.6166009999999;5.962001000000099,-73.622399;5.95559900000006,-73.62580199999989;5.94640100000004,-73.63040099999991;5.93540200000001,-73.629898;5.927302,-73.62930299999989;5.918700000000059,-73.629898;5.91230000000007,-73.63040099999991;5.905399000000161,-73.6350029999999;5.89850000000007,-73.63619900000001;5.89499900000015,-73.6379019999999;5.884000000000131,-73.634399;5.866698999999981,-73.6280969999999;5.85969999999998,-73.625198;5.84010000000012,-73.625198;5.834901,-73.6314999999999;5.821101,-73.635598;5.809500000000069,-73.6372979999999;5.802002000000019,-73.639602;5.787000000000029,-73.64070100000001;5.77779900000007,-73.64009900000001;5.76270000000011,-73.6383959999999;5.75290000000001,-73.6361009999999;5.74370100000004,-73.63719999999989;5.734998999999959,-73.64589699999991;5.727599,-73.6521989999999;5.712600000000121,-73.659102;5.70909899999998,-73.6631999999999;5.70800100000008,-73.6649029999999;5.70570100000003,-73.6763989999999;5.711498999999999,-73.686798;5.719100000000079,-73.695999;5.72780000000012,-73.7017969999999;5.736401,-73.704697;5.74510100000003,-73.7121969999999;5.75150000000014,-73.7155999999999;5.75560100000001,-73.72309799999989;5.75740100000007,-73.7352979999999;5.758600000000001,-73.74510100000001;5.75919899999997,-73.75769799999991;5.761501000000011,-73.7669989999999;5.761000000000139,-73.77559599999999;5.75870000000009,-73.7814029999999;5.751801,-73.79519599999991;5.74610100000001,-73.8079;5.7357990000001,-73.8223039999999;5.73470100000003,-73.8292009999999;5.7353,-73.8424999999999;5.737101,-73.85340099999991;5.73249900000008,-73.86779799999989;5.72970000000009,-73.88220200000001;5.72100099999994,-73.8873989999999;5.71530099999995,-73.8919979999999;5.70890100000014,-73.894302;5.70609999999999,-73.90300000000001;5.70669900000001,-73.908203;5.71300100000008,-73.906997;5.72059999999999,-73.91390299999991;5.721299999999991,-73.95490199999991;5.72140000000013,-73.9761959999999;5.7219990000001,-73.987701;5.72210000000013,-73.99810099999991;5.72500099999996,-74.0055989999999;5.727900000000029,-74.0095969999999;5.73480100000012,-74.0095969999999;5.74930100000012,-74.0102009999999;5.75740100000007,-74.019997;5.76319899999999,-74.027497;5.769000000000011,-74.027497;5.778200000000079,-74.027497;5.78980100000001,-74.0401989999999;5.794501000000029,-74.0609959999999;5.794601000000109,-74.07830199999989;5.79590000000013,-74.0972979999999;5.7994010000001,-74.1071009999999;5.81089900000001,-74.11170199999999;5.82249999999993,-74.1110979999999;5.832300000000091,-74.1110979999999;5.83980100000002,-74.118599;5.845699000000079,-74.1272959999999;5.8515000000001,-74.135398;5.85619900000006,-74.1538;5.85790000000009,-74.16589999999989;5.86030000000005,-74.175698;5.86900100000003,-74.1848989999999;5.87710100000004,-74.194198;5.88119900000015,-74.2027969999999;5.87600000000003,-74.2022019999999;5.865699000000061,-74.2137979999999;5.85930100000002,-74.2155009999999;5.84840000000008,-74.224098;5.84440000000006,-74.22930100000001;5.840300000000131,-74.2339029999999;5.837498999999979,-74.240303;5.835801,-74.24829800000001;5.835801,-74.250602;5.837498999999979,-74.2518009999999;5.84210100000013,-74.2546999999999;5.84330199999999,-74.2564;5.85260100000005,-74.2586969999999;5.85950000000014,-74.2604979999999;5.87050100000016,-74.26100200000001;5.88430099999994,-74.26280199999999;5.89070100000015,-74.26390099999991;5.89360000000005,-74.26450199999989;5.8959000000001,-74.26390099999991;5.90459900000008,-74.2615959999999;5.91549999999995,-74.2592989999999;5.92070100000007,-74.26110199999989;5.925398000000031,-74.273202;5.9334990000001,-74.28759699999991;5.941700999999971,-74.2910999999999;5.954400000000019,-74.292198;5.963599000000159,-74.292198;5.97169900000011,-74.2899009999999;5.97979900000007,-74.28759699999991;5.9907,-74.287002;6.00000100000005,-74.29049600000001;6.01150200000006,-74.29049600000001;6.02420100000006,-74.29049600000001;6.03930100000014,-74.29049600000001;6.049700000000091,-74.29229599999999;6.06069900000011,-74.30499999999989;6.05790100000007,-74.32109799999991;6.04929900000013,-74.3360969999999;6.03889900000007,-74.3423989999999;6.02969900000005,-74.35160000000001;6.02570100000003,-74.3666009999999;6.022401000000001,-74.38909799999991;6.02299999999997,-74.398903;6.025902000000141,-74.414497;6.03170000000006,-74.4207989999999;6.04160000000013,-74.424302;6.04560000000015,-74.42999999999989;6.047401000000091,-74.4410009999999;6.050400000000081,-74.4553979999999;6.05669900000009,-74.4641049999999;6.06950100000012,-74.476195;6.07639999999998,-74.47910399999989;6.089699000000111,-74.481399;6.10130000000004,-74.481399;6.113400000000009,-74.481399;6.119799999999999,-74.4853959999999;6.12560200000013,-74.489501;6.13540000000006,-74.495796;6.160899000000091,-74.5045019999999;6.175301000000159,-74.50509699999991;6.18340100000012,-74.5045019999999;6.19210099999998,-74.505601;6.19960100000009,-74.5142979999999;6.208900000000141,-74.5276039999999;6.22050100000007,-74.5379029999999;6.23380000000014,-74.5459979999999;6.24430000000012,-74.55010299999999;6.247379000000141,-74.55178699999991;6.25469900000007,-74.555801;6.252999000000101,-74.5609969999999;6.25130100000013,-74.5668019999999;6.23630000000003,-74.5754019999999;6.234600000000059,-74.5783009999999;6.22300099999995,-74.5858009999999;6.210901000000151,-74.592698;6.1977,-74.6018989999999;6.1843990000001,-74.6047979999999;6.167700000000079,-74.6082009999999;6.1579000000001,-74.6082009999999;6.14519800000005,-74.6134039999999;6.13079900000008,-74.6225959999999;6.10999900000002,-74.62950099999991;6.09270100000015,-74.630096;6.07940000000008,-74.624298;6.07069999999999,-74.61389799999991;6.06719900000007,-74.61109999999999;6.06199800000013,-74.6070019999999;6.0614010000001,-74.6017989999999;6.060200000000071,-74.5938029999999;6.05839999999995,-74.5896989999999;6.04859900000014,-74.5874029999999;6.04339800000002,-74.59140100000001;6.03649999999999,-74.59429999999991;6.03249999999997,-74.59839599999989;6.02960100000013,-74.601197;6.022100000000141,-74.604698;6.014599000000151,-74.6057959999999;6.008199000000161,-74.602402;5.99950000000001,-74.59320200000001;5.99260100000009,-74.58910399999991;5.983300000000041,-74.5874029999999;5.9799020000001,-74.5874029999999;5.97289999999998,-74.5907969999999;5.968401000000089,-74.6017989999999;5.96489999999994,-74.61099899999989;5.96209900000002,-74.6184999999999;5.95690099999996,-74.6259979999999;5.938399,-74.62539700000001;5.929799000000001,-74.62539700000001;5.91990100000015,-74.6213989999999;5.91070000000002,-74.6173009999999;5.89390100000008,-74.60809999999989;5.88870000000014,-74.609199;5.882400000000081,-74.62359600000001;5.87670000000008,-74.6356959999999;5.872101000000041,-74.6432039999999;5.86919999999998,-74.6512989999999;5.85659800000002,-74.6605;5.84899999999999,-74.6598959999999;5.84284800000012,-74.662834;5.840400000000051,-74.664001;5.82940100000002,-74.6633989999999;5.82020000000006,-74.6673969999999;5.79710100000005,-74.6732019999999;5.77920100000011,-74.6742999999999;5.76190000000003,-74.6742999999999;5.75839900000005,-74.6742999999999;5.75839900000005,-74.666802;5.753100000000019,-74.6564019999999;5.74850099999998,-74.64829999999991;5.74270100000007,-74.640298;5.73690000000005,-74.63099699999989;5.738500000000099,-74.616096;5.741399,-74.607398;5.742500000000119,-74.59470399999999;5.744799999999999,-74.5901039999999;5.747601000000149,-74.58609799999989;5.754001000000129,-74.583198;5.75970100000012,-74.5768969999999;5.76090000000005,-74.5693959999999;5.76140100000009,-74.564202;5.76600000000013,-74.5602039999999;5.772399999999949,-74.5560999999999;5.771700000000121,-74.54229700000001;5.76190000000003,-74.541101;5.76180000000005,-74.5272979999999;5.76640100000009,-74.51920299999991;5.76180000000005,-74.5122989999999;5.763500000000021,-74.49960399999991;5.76400100000012,-74.496202;5.75649900000008,-74.4921039999999;5.751801,-74.4834979999999;5.75120000000004,-74.4748009999999;5.74540100000002,-74.46849899999999;5.74939900000004,-74.459802;5.755198999999951,-74.4501039999999;5.757498999999999,-74.4442989999999;5.76090000000005,-74.4396969999999;5.76200000000011,-74.432197;5.766600000000041,-74.4160009999999;5.77289900000005,-74.407997;5.78150099999999,-74.40280299999991;5.789001000000039,-74.39179899999991;5.79190000000011,-74.38720000000001;5.80170100000015,-74.3808979999999;5.81089900000001,-74.3733969999999;5.81610000000012,-74.368798;5.820602000000121,-74.3544009999999;5.805001000000001,-74.347999;5.80210000000011,-74.34689999999991;5.796898999999999,-74.3416969999999;5.7847010000001,-74.335404;5.77660100000008,-74.3348;5.76799900000015,-74.33650299999989;5.761000000000139,-74.331901;5.74889999999994,-74.32959700000001;5.741399,-74.3290019999999;5.73789900000014,-74.326103;5.72750100000007,-74.3198009999999;5.722799000000071,-74.319199;5.703799999999939,-74.32150399999991;5.69460000000009,-74.3243019999999;5.68870100000015,-74.3127969999999;5.68119999999999,-74.30590099999991;5.670801000000041,-74.30529899999991;5.65700100000009,-74.3140029999999;5.64260100000001,-74.3202979999999;5.63159999999999,-74.3311989999999;5.6259,-74.33930100000001;5.62070100000005,-74.34509899999991;5.61209900000011,-74.3461979999999;5.60159899999996,-74.341599;5.59300000000013,-74.33809599999999;5.57790100000011,-74.32890399999999;5.56750100000011,-74.31970299999991;5.55240000000009,-74.312699;5.54320099999995,-74.30579999999991;5.52580000000012,-74.29540299999999;5.50900000000007,-74.29250399999989;5.49800100000004,-74.292;5.48530000000005,-74.28099899999999;5.47019999999998,-74.2624969999999;5.46380100000005,-74.2498999999999;5.46140100000008,-74.2434999999999;5.460801,-74.2388989999999;5.460801,-74.2307959999999;5.46140100000008,-74.2210009999999;5.46130000000011,-74.21810099999991;5.46130000000011,-74.2157969999999;5.46070100000009,-74.208901;5.45839900000004,-74.20429899999991;5.45609899999999,-74.20140000000001;5.45199900000006,-74.195702;5.44440100000003,-74.179497;5.43920000000008,-74.16909800000001;5.44090000000006,-74.1575999999999;5.44310100000013,-74.1494969999999;5.44370100000003,-74.138603;5.43960100000004,-74.135102;5.43440000000015,-74.13110499999991;5.42980000000006,-74.1281959999999;5.4251010000001,-74.1265029999999;5.41649900000016,-74.123597;5.41409899999996,-74.12190099999999;5.40200000000004,-74.114898;5.39270100000016,-74.1073989999999;5.386301,-74.10399699999989;5.38289999999995,-74.0964959999999;5.38050000000015,-74.0821009999999;5.36660000000006,-74.07340099999991;5.35669899999994,-74.0642009999999;5.35320100000007,-74.05500000000001;5.35550100000012,-74.0479959999999;5.35840200000001,-74.0451969999999;5.35840200000001,-74.0428019999999;5.354671,-74.040352;5.36810000000003,-74.027901;5.38310100000007,-74.017501;5.39059899999995,-74.0129019999999;5.39460099999997,-73.9990989999999;5.40030200000007,-73.986999;5.40660100000008,-73.97370099999991;5.41760000000011,-73.97080199999991;5.426199,-73.9633029999999;5.43480100000011,-73.95989999999991;5.44580000000013,-73.95590299999991;5.45100100000008,-73.947801;5.45270100000005,-73.94319899999989;5.45440100000002,-73.9409019999999;5.46419899999995,-73.93740099999999;5.466499,-73.93679899999999;5.47059899999999,-73.9357009999999;5.47860100000003,-73.9345019999999;5.48790000000008,-73.9293969999999;5.50049900000016,-73.92530099999991;5.50170000000003,-73.9229969999999;5.51150100000007,-73.91549600000001;5.51659899999999,-73.8988039999999;5.520601,-73.8901979999999;5.52520000000004,-73.883796;5.53039900000016,-73.879203;5.53790000000015,-73.8716959999999;5.5390010000001,-73.868302;5.54650099999998,-73.8636999999999;5.55109800000002,-73.859101;5.55690100000004,-73.853303;5.564301,-73.84470399999989;5.57120000000009,-73.8326039999999;5.57120000000009,-73.829696;5.57350000000014,-73.825103;5.57920000000013,-73.81639899999991;5.56710000000015,-73.813003;5.54630100000014,-73.8100969999999;5.53420099999994,-73.812896;5.51509900000008,-73.8216029999999;5.50299900000005,-73.8192979999999;5.49659999999994,-73.820999;5.48790000000008,-73.82643899999989;5.48450000000014,-73.81639899999991;5.47580000000005,-73.800201;5.47510099999994,-73.788696;5.47170000000011,-73.7846989999999;5.46880100000004,-73.7811959999999;5.4670000000001,-73.778297;5.46410100000003,-73.7736969999999;5.46519999999998,-73.76329800000001;5.4629000000001,-73.7581039999999;5.46050000000014,-73.7535019999999;5.46050000000014,-73.74949699999991;5.46050000000014,-73.74659799999991;5.45240000000001,-73.72820399999991;5.44999999999999,-73.717202;5.44940100000002,-73.708001;5.44180000000011,-73.6923979999999;5.43540000000013,-73.6906959999999;5.42270100000007,-73.68379899999999;5.41340000000002,-73.6756969999999;5.40590100000009,-73.6606979999999;5.39660000000003,-73.64969599999991;5.38850000000002,-73.6417009999999;5.38149900000002,-73.635903;5.38100000000014,-73.643401;5.37289999999996,-73.642196;5.36590000000007,-73.642196;5.36130100000003,-73.6405019999999;5.35669899999994,-73.6405019999999;5.34340100000014,-73.64160099999999;5.33470100000005,-73.6370019999999;5.33010000000002,-73.636398;5.32490100000012,-73.6324;5.32260100000008,-73.6307;5.30630100000002,-73.61799599999991;5.3016990000001,-73.61340299999991;5.28320000000014,-73.601196;5.26869999999997,-73.5966039999999;5.26640200000008,-73.5896979999999;5.26570000000009,-73.57700300000001;5.26510100000007,-73.571296;5.25120100000004,-73.56379800000001;5.23560000000009,-73.560897;5.22180000000009,-73.56030199999999;5.19980100000009,-73.559096;5.19280000000015,-73.5521999999999;5.17149899999998,-73.5486989999999;5.15289900000005,-73.5330959999999;5.13839900000005,-73.52619900000001;5.1280000000001,-73.52390200000001;5.11880099999996,-73.52220199999989;5.11359500000003,-73.51859399999989;5.11130000000003,-73.5169979999999;5.09849800000001,-73.5128999999999;5.09270000000009,-73.5101019999999;5.07370099999997,-73.5112;5.06040000000007,-73.511802;5.05120000000005,-73.5151979999999;5.04660000000013,-73.516403;5.03499900000003,-73.52100299999989;5.02170100000001,-73.51920200000001;5.01540100000011,-73.5250029999999;5.00900100000007,-73.52559699999991;5.00040000000007,-73.527902;4.98940100000004,-73.5307;4.98250000000013,-73.53649899999991;4.9796,-73.5371029999999;4.97559800000016,-73.5382009999999;4.97210000000007,-73.5388029999999;4.96459900000013,-73.5411;4.95480100000015,-73.54920199999989;4.94510100000014,-73.5549;4.92320100000001,-73.5659019999999;4.90990000000011,-73.571602;4.90410000000003,-73.572801;4.89720100000011,-73.571602;4.892,-73.5687029999999;4.89022199999999,-73.5663689999999;4.88620200000008,-73.566399;4.88209900000004,-73.5630029999999;4.87979899999999,-73.5606979999999;4.8775,-73.5559989999999;4.87169900000004,-73.5479969999999;4.87280000000015,-73.5382009999999;4.87280000000015,-73.532403;4.87270000000007,-73.5289999999999;4.87329900000003,-73.5196989999999;4.87329900000003,-73.51570100000001;4.87379800000014,-73.5018989999999;4.87200000000007,-73.48400100000001;4.87070100000005,-73.4654989999999;4.87130100000013,-73.459801;4.8712000000001,-73.4481959999999;4.86540000000002,-73.43730099999991;4.8607980000001,-73.43270199999991;4.8567000000001,-73.4245979999999;4.850301,-73.4160009999999;4.84569900000008,-73.4131019999999;4.84050000000002,-73.4131019999999;4.83240000000001,-73.4148019999999;4.827202,-73.403297;4.81960100000009,-73.39980299999991;4.80750100000006,-73.39920099999991;4.78730100000013,-73.403199;4.78150000000011,-73.4038;4.77860100000004,-73.40209999999991;4.77110100000016,-73.3888009999999;4.76470099999995,-73.373802;4.76350000000008,-73.3703999999999;4.76120000000003,-73.36630200000001;4.75420100000002,-73.35479699999991;4.74370100000004,-73.346704;4.73679999999996,-73.3438049999999;4.72930099999996,-73.342697;4.71770000000004,-73.3380979999999;4.71079900000001,-73.33460100000001;4.70839899999999,-73.3264989999999;4.70839899999999,-73.3161019999999;4.70949999999999,-73.29650100000001;4.71060099999994,-73.28209699999999;4.71169900000001,-73.2768999999999;4.70759900000007,-73.26309999999999;4.69539899999995,-73.259597;4.681601,-73.260803;4.67350099999999,-73.261398;4.66540100000003,-73.2562039999999;4.66130100000009,-73.2423009999999;4.65610000000015,-73.23429899999989;4.6461010000001,-73.2014019999999;4.64260100000001,-73.193297;4.64200099999994,-73.1864009999999;4.64420100000007,-73.1726;4.65000100000003,-73.16100399999991;4.65050000000008,-73.15119900000001;4.65050000000008,-73.146103;4.64870000000002,-73.143204;4.64760100000001,-73.13569699999989;4.64929899999999,-73.1287999999999;4.65849999999995,-73.1235969999999;4.6683000000001,-73.119004;4.67630000000014,-73.1144029999999;4.68499900000012,-73.110902;4.69600100000002,-73.10690199999991;4.70519900000011,-73.1039959999999;4.71210100000008,-73.0988;4.71780100000007,-73.08609799999989;4.71430000000009,-73.0781029999999;4.71889900000014,-73.0781029999999;4.72180100000008,-73.0774989999999;4.73170100000016,-73.079803;4.74150100000008,-73.081002;4.76690000000002,-73.0868;4.77850100000012,-73.0988999999999;4.78020100000009,-73.094802;4.79060100000009,-73.0902029999999;4.79810200000009,-73.0868;4.8044010000001,-73.083297;4.81019900000001,-73.081597;4.82579999999996,-73.07640000000001;4.83730000000008,-73.0707029999999;4.84829900000011,-73.067803;4.86330100000009,-73.0642999999999;4.885201,-73.05970099999991;4.90889900000008,-73.059197;4.9205,-73.060898;4.95220099999995,-73.047095;4.95499900000004,-73.040199;4.95729900000009,-73.03150099999991;4.95840000000004,-73.02690200000001;4.96130100000011,-73.019401;4.96360100000015,-73.0102009999999;4.96590100000003,-73.006203;4.97100100000011,-72.9963979999999;4.97390000000001,-72.98829599999991;4.98190000000005,-72.9768;4.98710099999994,-72.9686979999999;4.99510100000003,-72.9582979999999;5.00139999999999,-72.94850199999991;5.012901,-72.938203;5.01439100000005,-72.935525;5.01580000000007,-72.9329989999999;5.02159999999998,-72.9300999999999;5.02390000000003,-72.9312969999999;5.03720100000015,-72.93470000000001;5.04469900000004,-72.9329989999999;5.05570099999994,-72.9300999999999;5.06260000000003,-72.933601;5.06839999999994,-72.94339699999991;5.07190100000008,-72.9485999999999;5.09050100000002,-72.96530199999999;5.10260100000005,-72.976303;5.11419900000004,-72.986099;5.12749999999994,-72.98200300000001;5.14020000000005,-72.977402;5.16210000000001,-72.96820099999989;5.18110100000007,-72.95839599999989;5.18860000000006,-72.9589999999999;5.19560100000007,-72.9589999999999;5.19960100000009,-72.9625009999999;5.20540099999999,-72.9647979999999;5.21010100000007,-72.9717039999999;5.221,-72.9613039999999;5.22669999999999,-72.9514989999999;5.24220000000008,-72.93199900000001;5.259501,-72.9129019999999;5.27960100000007,-72.89739899999989;5.28940100000005,-72.88239999999991;5.31129900000002,-72.8702999999999;5.3216010000001,-72.8604959999999;5.32800100000009,-72.8507;5.34120100000001,-72.83170299999991;5.34289900000016,-72.8236009999999;5.3399,-72.8086999999999;5.33010000000002,-72.8012019999999;5.3225010000001,-72.789596;5.31549900000005,-72.77979999999999;5.303899,-72.7716979999999;5.29180100000002,-72.7601999999999;5.27840000000003,-72.7527019999999;5.27210000000008,-72.748704;5.27610000000016,-72.739403;5.25470100000007,-72.726195;5.24829900000009,-72.72039699999991;5.23499999999996,-72.7135;5.23610100000013,-72.7093959999999;5.24360000000013,-72.7024989999999;5.25280000000015,-72.6961969999999;5.27070099999997,-72.6899019999999;5.28050100000013,-72.686401;5.28280100000001,-72.6818;5.29030100000006,-72.67549799999991;5.3053000000001,-72.67259899999991;5.31789900000001,-72.66799999999991;5.325402,-72.65529599999989;5.32770000000005,-72.646699;5.32820100000015,-72.63629899999989;5.33390100000014,-72.622497;5.33959900000013,-72.6080019999999;5.35120000000006,-72.598801;5.35120000000006,-72.60289899999989;5.3546,-72.6034019999999;5.36160000000007,-72.5994019999999;5.36389900000006,-72.598801;5.37020100000012,-72.5982969999999;5.37830100000014,-72.5924989999999;5.38230100000015,-72.5803989999999;5.3891000000001,-72.5660019999999;5.4029000000001,-72.5492999999999;5.41270000000003,-72.5382989999999;5.42539900000003,-72.52619900000001;5.43690000000004,-72.5169979999999;5.45130000000012,-72.50720200000001;5.46400100000011,-72.501502;5.4772000000001,-72.4870979999999;5.48060200000003,-72.4749979999999;5.49270000000001,-72.459999;5.49439999999998,-72.4571;5.49900000000014,-72.4535969999999;5.50190100000015,-72.45249799999991;5.51000100000016,-72.45079799999991;5.52210100000013,-72.443901;5.53070000000002,-72.440398;5.53700000000009,-72.4329;5.5428,-72.4208;5.54270000000008,-72.41619899999991;5.53870000000006,-72.4069979999999;5.52880199999998,-72.4057989999999;5.51960100000008,-72.4011999999999;5.51029900000009,-72.39769699999989;5.49870100000004,-72.3908;5.48950000000013,-72.3815989999999;5.48130200000003,-72.3718029999999;5.47379900000004,-72.359703;5.46510000000006,-72.3545;5.46560099999999,-72.34349899999999;5.47130100000015,-72.3267969999999;5.48690000000011,-72.3210989999999;5.49790100000013,-72.3245019999999;5.50770100000005,-72.3251039999999;5.51520000000005,-72.3256989999999;5.53200100000004,-72.323998;5.54930000000013,-72.315299;5.56940000000003,-72.309601;5.58910100000008,-72.30789899999991;5.61100100000004,-72.3067019999999;5.62370000000004,-72.3056039999999;5.632901000000001,-72.2964029999999;5.641500000000061,-72.28430299999999;5.64840100000009,-72.271599;5.66013700000002,-72.252785;5.66920099999999,-72.2618029999999;5.67610000000008,-72.27100399999991;5.694100000000111,-72.286598;5.70690000000013,-72.299897;5.718501000000061,-72.3068;5.73120000000006,-72.3114019999999;5.74860100000006,-72.32180099999989;5.7636,-72.3368;5.77699900000016,-72.3592979999999;5.785200000000151,-72.3748029999999;5.79970000000014,-72.40709800000001;5.800901000000009,-72.40889799999989;5.80150000000003,-72.4129029999999;5.80620000000005,-72.4187009999999;5.81370000000015,-72.431298;5.81610000000012,-72.44229899999991;5.81610000000012,-72.455001;5.82890200000014,-72.475196;5.83350099999996,-72.47460100000001;5.83810100000005,-72.4682999999999;5.84620100000006,-72.4619;5.85600099999999,-72.455598;5.86749900000012,-72.446404;5.87200100000013,-72.42970200000001;5.871401000000051,-72.424499;5.87549900000016,-72.4198999999999;5.88470000000012,-72.4141019999999;5.891600999999979,-72.40949999999999;5.912398,-72.405997;5.931399000000059,-72.4013979999999;5.94869999999997,-72.3985969999999;5.96260100000001,-72.3956979999999;5.98160000000007,-72.39050400000001;5.990901000000121,-72.387101;6.003600000000121,-72.38480300000001;6.02259900000001,-72.3772959999999;6.03120099999995,-72.373802;6.042801,-72.36810199999999;6.04910100000006,-72.362899;6.054300000000009,-72.3599999999999;6.06350000000003,-72.3589009999999;6.0682000000001,-72.36460099999989;6.0682000000001,-72.3710029999999;6.06879900000007,-72.3772959999999;6.07000100000005,-72.38359799999991;6.07580100000001,-72.3906019999999;6.08390100000014,-72.395798;6.089102000000081,-72.3974979999999;6.093701000000121,-72.40270199999991;6.10240100000016,-72.406097;6.11230100000006,-72.4089969999999;6.140601000000001,-72.4188989999999;6.15560000000005,-72.4263999999999;6.169501000000031,-72.4338979999999;6.182799000000049,-72.43270199999991;6.19319900000005,-72.4280999999999;6.20299900000003,-72.4206019999999;6.21630099999999,-72.421204;6.22669999999994,-72.41950300000001;6.23999900000007,-72.4206019999999;6.2437480000001,-72.4223859999999;6.25610100000006,-72.4159999999999;6.27050100000014,-72.40799800000001;6.283799000000099,-72.397599;6.29529999999994,-72.393601;6.306201000000041,-72.3826;6.318299000000081,-72.3722999999999;6.32860000000005,-72.358397;6.329199999999959,-72.3555989999999;6.331499000000121,-72.3491969999999;6.34240099999994,-72.331902;6.34410100000008,-72.3249969999999;6.35310600000003,-72.3166439999999;6.36600100000004,-72.313498;6.38280000000003,-72.313498;6.39320000000004,-72.31700099999991;6.40530000000007,-72.31700099999991;6.41570000000007,-72.31700099999991;6.421400000000061,-72.309501;6.42030100000011,-72.3049019999999;6.41789900000015,-72.30029999999989;6.41090000000014,-72.27950299999991;6.41090000000014,-72.270302;6.410799999999991,-72.259902;6.41249999999997,-72.2437979999999;6.41299900000007,-72.23110299999991;6.42109900000003,-72.221298;6.436598999999999,-72.20290299999991;6.444599000000039,-72.191902;6.46019999999999,-72.176903;6.47340100000014,-72.165398;6.484399999999989,-72.16079599999991;6.49700100000007,-72.15619700000001;6.51380100000011,-72.1545039999999;6.53460000000007,-72.151605;6.55420100000009,-72.1475979999999;6.57559900000007,-72.1458979999999;6.596900000000011,-72.14070100000001;6.61709999999999,-72.133201;6.632701000000109,-72.12799699999989;6.64820100000009,-72.1193999999999;6.66029900000007,-72.10839899999991;6.67240100000009,-72.1009989999999;6.678801000000079,-72.09870099999991;6.69370000000004,-72.0912009999999;6.70580000000007,-72.084801;6.721400000000069,-72.077904;6.73060100000004,-72.0727009999999;6.74330000000003,-72.0658039999999;6.751401000000101,-72.0630029999999;6.766399999999981,-72.05549599999991;6.7779000000001,-72.0542989999999;6.79810000000009,-72.0485989999999;6.807301,-72.047403;6.81770100000006,-72.044501;6.83040000000005,-72.03710099999989;6.844300000000149,-72.03420199999989;6.854600000000061,-72.0289979999999;6.86899900000003,-72.02040199999991;6.88870000000014,-72.0151979999999;6.89840000000015,-72.0036999999999;7.01027800000003,-71.9830849999999;7.010860000000041,-71.98871699999999;7.00892900000014,-72.00780500000001;7.01107399999995,-72.01836399999991;7.013873000000099,-72.0243219999999;7.022007000000031,-72.0321569999999;7.01914400000015,-72.03859799999989;7.01977800000003,-72.0531849999999;7.014701999999939,-72.07094599999991;7.01597200000003,-72.086806;7.01490100000007,-72.09020199999991;7.02070099999997,-72.10170099999991;7.022501000000091,-72.10809999999999;7.023101,-72.111503;7.023101,-72.114997;7.023101,-72.1178959999999;7.024300000000041,-72.12419799999989;7.02490100000006,-72.1305999999999;7.023699999999959,-72.1345979999999;7.02199999999999,-72.13800000000001;7.01920100000007,-72.1437989999999;7.01799999999997,-72.15070400000001;7.018699999999971,-72.1600029999999;7.0175010000001,-72.16860200000001;7.01519900000005,-72.1732019999999;7.01529900000014,-72.1789999999999;7.01529900000014,-72.18589899999991;7.016500000000061,-72.1917039999999;7.01820100000009,-72.19740399999991;7.02060100000006,-72.20030300000001;7.024601000000079,-72.20379699999999;7.024601000000079,-72.206101;7.02750000000015,-72.212998;', 8, NULL),
(7, 1, NULL, 'Caldas', '5.33203', '-75.339', '5.752699000000061,-74.6949989999999;5.76200000000011,-74.69850199999991;5.762600000000021,-74.7048039999999;5.762600000000021,-74.71520099999999;5.75980100000004,-74.7227019999999;5.742500000000119,-74.73370299999991;5.731501000000089,-74.741097;5.71600099999995,-74.747497;5.70500200000009,-74.7549969999999;5.69,-74.757796;5.68310100000008,-74.765297;5.68260000000004,-74.7698979999999;5.68030000000016,-74.778001;5.67860000000002,-74.79010099999989;5.67749900000001,-74.7982029999999;5.679300000000009,-74.8067999999999;5.68629900000002,-74.82180099999989;5.68920000000003,-74.82759900000001;5.690899999999999,-74.835098;5.69440100000014,-74.84200300000001;5.69619900000004,-74.8534989999999;5.70030000000008,-74.85870299999991;5.70890100000014,-74.861;5.71420000000001,-74.863297;5.72050000000007,-74.8638989999999;5.72460000000001,-74.866798;5.73089900000002,-74.872596;5.733901000000059,-74.87719800000001;5.73220100000009,-74.88580399999989;5.730500000000059,-74.89330199999991;5.727599,-74.901398;5.726501000000101,-74.9083009999999;5.72529900000012,-74.91349799999991;5.72360200000003,-74.918099;5.71799900000008,-74.9434959999999;5.715700000000141,-74.9555979999999;5.71460100000013,-74.9653999999999;5.713500000000009,-74.97579999999989;5.71180000000004,-74.9856029999999;5.71120100000002,-74.9959019999999;5.707799999999961,-75.00920099999991;5.70559900000012,-75.0167009999999;5.69110099999995,-75.0201039999999;5.681301000000019,-75.02649699999991;5.674400000000111,-75.03510299999991;5.669901000000039,-75.0477979999999;5.666500000000159,-75.060502;5.662500000000139,-75.06970299999991;5.65959900000007,-75.0794979999999;5.653901000000079,-75.0910039999999;5.653901000000079,-75.094497;5.64929900000016,-75.1111989999999;5.64820100000009,-75.1157979999999;5.64190100000002,-75.11979599999999;5.6309,-75.12100199999991;5.62110000000001,-75.1227039999999;5.61240000000015,-75.1267019999999;5.59800100000001,-75.1249989999999;5.59160099999997,-75.124397;5.58070000000009,-75.124397;5.573801,-75.13069899999989;5.57089900000005,-75.1399999999999;5.56800000000015,-75.1468969999999;5.56350100000009,-75.1531989999999;5.55480000000011,-75.1566999999999;5.54560100000015,-75.1589969999999;5.53750099999996,-75.161301;5.53120100000007,-75.166999;5.52770100000004,-75.1716009999999;5.52260000000001,-75.179703;5.52029999999996,-75.192398;5.51800100000003,-75.2044979999999;5.51690000000002,-75.21949699999991;5.51240100000012,-75.23500199999999;5.49109999999996,-75.247102;5.47320000000008,-75.2545999999999;5.46460100000002,-75.27419999999999;5.46000100000009,-75.2862999999999;5.45830100000012,-75.2880029999999;5.46009900000001,-75.30300199999991;5.46020000000004,-75.31339899999991;5.45730000000003,-75.32319699999989;5.45680100000016,-75.33650299999989;5.45800000000008,-75.33989699999989;5.46430000000015,-75.34400099999991;5.4746990000001,-75.3473969999999;5.48509899999993,-75.3497009999999;5.49780100000004,-75.3497009999999;5.5025,-75.3508979999999;5.51690000000002,-75.353797;5.53320000000008,-75.366501;5.55510000000004,-75.3675989999999;5.56840200000005,-75.3704989999999;5.57480100000015,-75.375198;5.58690100000013,-75.37400199999991;5.59499900000014,-75.37400199999991;5.59789999999998,-75.376901;5.60140100000012,-75.38610199999989;5.60140100000012,-75.3925009999999;5.59970100000015,-75.4017019999999;5.60550100000006,-75.40920299999991;5.62049999999994,-75.402801;5.634401000000139,-75.39939800000001;5.651100000000159,-75.393096;5.65340000000003,-75.39359999999991;5.65920000000011,-75.39649899999991;5.66440100000005,-75.405196;5.66850099999999,-75.41210199999991;5.67720100000008,-75.4196029999999;5.68359999999996,-75.4259039999999;5.68359999999996,-75.433998;5.6871010000001,-75.441498;5.68720100000002,-75.4535979999999;5.68310100000008,-75.4559019999999;5.67679900000002,-75.4698029999999;5.66590099999996,-75.48470399999999;5.662500000000139,-75.498595;5.66020099999997,-75.5077979999999;5.668399000000081,-75.5141;5.67130000000014,-75.52570299999989;5.67310000000003,-75.5372009999999;5.68180000000007,-75.542999;5.68699900000001,-75.551002;5.691700000000139,-75.5590969999999;5.70030000000008,-75.56199599999999;5.707799999999961,-75.563202;5.71360099999998,-75.5665979999999;5.71650000000005,-75.572997;5.717701000000151,-75.57530199999989;5.71719899999999,-75.58219799999991;5.721299999999991,-75.592598;5.72529900000012,-75.604698;5.72660100000002,-75.6184999999999;5.73070100000001,-75.62999599999991;5.717299999999971,-75.62599899999989;5.70120000000014,-75.62249799999999;5.68840000000012,-75.6184999999999;5.679801000000049,-75.6173019999999;5.6717010000001,-75.62309999999999;5.66590099999996,-75.62709699999991;5.65150100000011,-75.62419799999989;5.63650200000006,-75.61959899999989;5.61680099999995,-75.6219029999999;5.60010000000011,-75.626502;5.59780000000006,-75.626502;5.57410200000004,-75.6173019999999;5.55610100000007,-75.6155009999999;5.54290000000015,-75.6166999999999;5.53129899999999,-75.6166999999999;5.52260000000001,-75.6155009999999;5.51509900000008,-75.6143049999999;5.512902,-75.623597;5.51870000000014,-75.6339029999999;5.51989900000001,-75.65239799999991;5.51940000000013,-75.6593009999999;5.51770000000016,-75.6679989999999;5.51480100000009,-75.67030299999991;5.51249900000005,-75.6800989999999;5.51080100000007,-75.693901;5.50800000000015,-75.7060009999999;5.50509900000009,-75.7095039999999;5.50400000000008,-75.71230300000001;5.50460199999998,-75.7169039999999;5.5064000000001,-75.7285009999999;5.51220000000001,-75.73539699999991;5.51800100000003,-75.73829599999991;5.52029999999996,-75.7406009999999;5.52380100000011,-75.74410399999989;5.52719900000005,-75.74410399999989;5.52610100000015,-75.74980099999991;5.52440100000001,-75.754403;5.52319900000003,-75.757897;5.52380100000011,-75.76419900000001;5.52500000000003,-75.7723009999999;5.52220100000005,-75.7866979999999;5.51879800000006,-75.797096;5.51419900000002,-75.81030300000001;5.51430200000004,-75.8229979999999;5.51490100000001,-75.8346029999999;5.51430200000004,-75.8408959999999;5.505201,-75.8517999999999;5.49830000000009,-75.85990200000001;5.49770000000001,-75.8685989999999;5.48910099999995,-75.882402;5.48330100000004,-75.8853009999999;5.47513700000007,-75.8865059999999;5.47178199999996,-75.88677299999991;5.46140100000008,-75.88760499999999;5.44409999999999,-75.8870009999999;5.42959999999999,-75.88870299999989;5.41230100000007,-75.8933029999999;5.39910000000009,-75.8973;5.39040100000011,-75.8984989999999;5.38119999999998,-75.9008029999999;5.37020100000012,-75.90360200000001;5.362101,-75.9030979999999;5.35280000000012,-75.89499599999991;5.35280000000012,-75.88749799999989;5.35280000000012,-75.8799969999999;5.35680000000013,-75.87309999999999;5.35680000000013,-75.866204;5.36020000000008,-75.85520200000001;5.36190000000005,-75.8470999999999;5.36359800000002,-75.840203;5.36650000000014,-75.83499999999999;5.36990000000009,-75.8321989999999;5.36990000000009,-75.82640099999991;5.37039900000002,-75.8217989999999;5.37849900000015,-75.81079800000001;5.37840100000005,-75.7964029999999;5.37950000000001,-75.783699;5.37950000000001,-75.7734;5.38060100000001,-75.76239800000001;5.38050000000015,-75.751504;5.38110000000006,-75.7359009999999;5.38100000000014,-75.733597;5.36190000000005,-75.7226019999999;5.35790100000008,-75.7226019999999;5.33820000000003,-75.7144999999999;5.33190000000013,-75.7144999999999;5.33070100000003,-75.70189600000001;5.32949999999994,-75.69259700000001;5.32940000000002,-75.6834029999999;5.32589900000011,-75.6781999999999;5.32080099999996,-75.6856979999999;5.30750200000006,-75.6955029999999;5.30410200000011,-75.6995009999999;5.29140000000007,-75.70300399999989;5.28389900000008,-75.7046969999999;5.2752000000001,-75.70760299999991;5.26950000000011,-75.71340100000001;5.26430100000016,-75.716797;5.2557000000001,-75.72599799999991;5.25220099999996,-75.734702;5.25050099999999,-75.7445;5.24879800000014,-75.749703;5.24940000000004,-75.75659999999991;5.25930099999999,-75.7693019999999;5.26510100000007,-75.77729699999991;5.27099900000013,-75.7893989999999;5.2745000000001,-75.7968969999999;5.2752000000001,-75.8005899999999;5.27560100000005,-75.8026959999999;5.27690000000007,-75.8199989999999;5.27860000000004,-75.8321009999999;5.27810099999994,-75.84249800000001;5.27810099999994,-75.847702;5.27700000000016,-75.85569700000001;5.27700000000016,-75.85859599999991;5.27360000000004,-75.8673019999999;5.26640899999995,-75.86550199999991;5.26199900000012,-75.864403;5.24180100000012,-75.8569029999999;5.22270000000015,-75.85399699999989;5.21289999999999,-75.8516989999999;5.19609999999994,-75.8488;5.18750100000011,-75.85109799999989;5.17419999999998,-75.8602979999999;5.16040000000004,-75.86949899999991;5.15120100000007,-75.8769999999999;5.14190000000002,-75.8787;5.13439900000003,-75.88099799999991;5.12579999999997,-75.8815989999999;5.11600000000004,-75.883903;5.11249900000007,-75.885597;5.10910099999995,-75.8897019999999;5.108,-75.9029;5.12070200000005,-75.9126959999999;5.12480000000005,-75.918503;5.12480000000005,-75.9218989999999;5.12480000000005,-75.931702;5.12355500000007,-75.93628699999989;5.12260000000009,-75.9397969999999;5.11279999999994,-75.9531029999999;5.08740100000006,-75.950204;5.08390099999997,-75.950204;5.07520100000011,-75.952499;5.05620000000005,-75.9535969999999;5.04640000000006,-75.9548029999999;5.03385500000002,-75.9538959999999;5.03249900000009,-75.9495999999999;5.02089799999999,-75.94210099999989;5.0134000000001,-75.9397969999999;5.00300000000004,-75.93740199999991;4.99780200000004,-75.938003;4.97810100000015,-75.92880200000001;4.96480200000002,-75.922997;4.95499900000004,-75.921302;4.94860000000011,-75.9149019999999;4.94510100000014,-75.9068979999999;4.94444900000002,-75.90055;4.92080100000004,-75.9068;4.91960000000012,-75.89420299999991;4.9149000000001,-75.877403;4.9149000000001,-75.8687969999999;4.91660099999996,-75.859002;4.91710000000006,-75.8498009999999;4.91650000000016,-75.8377009999999;4.9176010000001,-75.82039499999991;4.91750100000002,-75.81169799999989;4.92220000000015,-75.8112039999999;4.92909900000006,-75.81349899999989;4.93719900000002,-75.8187019999999;4.9448000000001,-75.834198;4.95290000000006,-75.84169799999999;4.95919999999995,-75.837097;4.97080100000011,-75.832498;4.98120000000006,-75.832498;4.9898,-75.83139899999991;4.99730000000005,-75.8181;5.00589900000011,-75.8123999999999;5.01629899999995,-75.805396;5.02490100000011,-75.79679899999999;5.030102,-75.7910009999999;5.03240099999999,-75.784102;5.01900000000001,-75.7749019999999;5.0046000000001,-75.7674029999999;4.99420100000015,-75.7615959999999;4.9803,-75.758202;4.96530100000012,-75.7575979999999;4.953101,-75.7575979999999;4.93460099999999,-75.74780300000001;4.92350000000005,-75.72640199999989;4.92179900000002,-75.722999;4.92170100000004,-75.710899;4.92230099999995,-75.69699799999989;4.92860000000013,-75.68839899999991;4.94710000000015,-75.6877979999999;4.95749999999998,-75.68839899999991;4.95910000000003,-75.6785969999999;4.95499900000004,-75.66190399999989;4.94460000000009,-75.65209899999989;4.93420000000003,-75.6509029999999;4.92660100000012,-75.6388009999999;4.92540000000002,-75.623802;4.92660100000012,-75.6192019999999;4.92480100000006,-75.616303;4.92480100000006,-75.604798;4.92410100000006,-75.58229899999991;4.92290000000014,-75.571899;4.92110000000008,-75.548301;4.91580100000004,-75.5338969999999;4.91050200000001,-75.51889799999999;4.89140000000009,-75.4974969999999;4.87460100000015,-75.48490200000001;4.86240000000015,-75.474999;4.85080000000011,-75.4600979999999;4.839201,-75.4450989999999;4.82700100000005,-75.4306039999999;4.81540000000012,-75.4236979999999;4.80670100000015,-75.423103;4.80270100000013,-75.4214029999999;4.80550000000005,-75.4132979999999;4.81189899999998,-75.4121999999999;4.81880099999995,-75.40529599999989;4.83150000000001,-75.394897;4.83490000000012,-75.38629999999991;4.83600100000007,-75.37930299999989;4.83890000000014,-75.36779799999989;4.84579900000006,-75.3585969999999;4.85149900000005,-75.35459899999989;4.86480000000012,-75.3551029999999;4.87400100000008,-75.35339999999989;4.88150000000002,-75.35339999999989;4.8850000000001,-75.35339999999989;4.89080100000007,-75.3569029999999;4.90180000000015,-75.3598029999999;4.90870100000001,-75.361503;4.91220000000015,-75.362702;4.92840000000012,-75.3637999999999;4.93998900000014,-75.362084;4.94449999999995,-75.361503;4.953801,-75.358704;4.967601,-75.3535009999999;4.98380100000014,-75.3466039999999;4.99360100000007,-75.3448039999999;5.00170100000003,-75.3482969999999;5.01500200000015,-75.3482969999999;5.02650099999994,-75.35639999999999;5.03349999999995,-75.357001;5.0433000000001,-75.35990099999989;5.05080100000009,-75.36219800000001;5.06809900000013,-75.36099899999989;5.08370000000008,-75.36099899999989;5.08600000000013,-75.35929899999999;5.08829900000006,-75.35639999999999;5.0981000000001,-75.3466039999999;5.10500100000002,-75.3414989999999;5.11660200000011,-75.335099;5.12690100000015,-75.325301;5.12860100000012,-75.310897;5.12510100000009,-75.3000029999999;5.12389900000011,-75.2912989999999;5.12440100000003,-75.2745969999999;5.12610100000001,-75.264197;5.12780099999998,-75.2538;5.13060000000013,-75.2423019999999;5.13690000000003,-75.2291029999999;5.14379900000012,-75.21749799999991;5.15360100000004,-75.207702;5.15470000000005,-75.196197;5.15459900000002,-75.189904;5.15459900000002,-75.18699599999999;5.15289900000005,-75.1840969999999;5.14590000000004,-75.1765969999999;5.14530000000013,-75.16619899999991;5.14530000000013,-75.162201;5.14929999999998,-75.1558999999999;5.1533,-75.15070299999999;5.16720099999998,-75.1448979999999;5.18040100000007,-75.13629899999999;5.20580000000001,-75.12480099999991;5.2231010000001,-75.11550199999991;5.24040000000002,-75.1057969999999;5.25322000000011,-75.094306;5.2559,-75.0919039999999;5.25700100000012,-75.0873019999999;5.25809900000002,-75.076401;5.27080100000012,-75.0631019999999;5.273101,-75.0515969999999;5.27760000000006,-75.036598;5.27819900000009,-75.0314019999999;5.27810099999994,-75.0251;5.28039900000005,-75.0112;5.28066100000001,-75.004898;5.28090000000009,-74.9990999999999;5.28090000000009,-74.9865029999999;5.28080199999999,-74.973197;5.28130100000004,-74.9599009999999;5.28130100000004,-74.947799;5.28120100000012,-74.924798;5.2817,-74.90979899999989;5.28690100000011,-74.9005979999999;5.29150000000016,-74.8912969999999;5.29140000000007,-74.87640500000001;5.29080100000004,-74.86479899999991;5.29010100000005,-74.855598;5.29010100000005,-74.8504019999999;5.28200100000004,-74.8441;5.28139899999996,-74.8399959999999;5.28080199999999,-74.8209989999999;5.28069899999997,-74.8135009999999;5.278299,-74.79740099999999;5.27660100000003,-74.7834999999999;5.27299800000014,-74.7656999999999;5.27650100000011,-74.76509899999991;5.27880100000016,-74.7611009999999;5.28109800000016,-74.755303;5.28740000000005,-74.74720099999991;5.31220200000013,-74.7397999999999;5.32310000000012,-74.7340019999999;5.33580000000006,-74.7293999999999;5.3503,-74.73000399999999;5.35430000000002,-74.72309899999991;5.35770199999996,-74.717902;5.36580000000015,-74.714996;5.37160000000006,-74.71730100000001;5.37970000000007,-74.7184989999999;5.38540100000012,-74.7162019999999;5.38600000000014,-74.70290299999991;5.396299,-74.6970979999999;5.404402,-74.6976999999999;5.41950100000003,-74.7017979999999;5.42580100000009,-74.70120300000001;5.42580100000009,-74.695396;5.42230200000012,-74.693101;5.421199,-74.6902019999999;5.42170000000004,-74.68559999999989;5.42459900000011,-74.683296;5.42580100000009,-74.6850959999999;5.445401,-74.69029999999989;5.46390100000002,-74.6908029999999;5.48070000000013,-74.69259699999991;5.49970200000013,-74.686204;5.514701,-74.6810989999999;5.53490000000005,-74.6713029999999;5.54590200000001,-74.674699;5.55690100000004,-74.6850959999999;5.56840200000005,-74.6804969999999;5.58450100000016,-74.6725;5.59780000000006,-74.6678999999999;5.60930100000007,-74.6632989999999;5.63190100000003,-74.66100399999991;5.64110100000005,-74.65920299999991;5.654401999999951,-74.659798;5.66190099999994,-74.6568989999999;5.66820000000013,-74.6489039999999;5.683300000000029,-74.6696009999999;5.68909999999994,-74.6765969999999;5.695500000000149,-74.6793989999999;5.70470100000006,-74.677696;5.710499000000031,-74.67890199999989;5.717500000000029,-74.6852029999999;5.72500099999996,-74.683503;5.729001000000039,-74.6822979999999;5.73880100000014,-74.6765969999999;5.73990000000015,-74.6731039999999;5.74629900000002,-74.67540099999989;5.75839900000005,-74.6765969999999;5.75100100000009,-74.68470000000001;5.752699000000061,-74.6949989999999;', 8, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Departamento_audit`
--

CREATE TABLE `Departamento_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poligono` longtext COLLATE utf8_unicode_ci,
  `zoom` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DespachoGuia`
--

CREATE TABLE `DespachoGuia` (
  `id` int(11) NOT NULL,
  `despacho_id` int(11) DEFAULT NULL,
  `guia_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `fechaEntrega` datetime DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cierreEstado_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DespachoGuia_audit`
--

CREATE TABLE `DespachoGuia_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `despacho_id` int(11) DEFAULT NULL,
  `guia_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `fechaEntrega` datetime DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cierreEstado_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DespachoOrdenes`
--

CREATE TABLE `DespachoOrdenes` (
  `id` int(11) NOT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DespachoOrdenes_audit`
--

CREATE TABLE `DespachoOrdenes_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Despachos`
--

CREATE TABLE `Despachos` (
  `id` int(11) NOT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `planilla_id` int(11) DEFAULT NULL,
  `ordendespacho_id` int(11) DEFAULT NULL,
  `ordenproducto_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `documento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departamentoNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documentoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccionContacto` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrioContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefonoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celularContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departamentoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Despachos_audit`
--

CREATE TABLE `Despachos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `planilla_id` int(11) DEFAULT NULL,
  `ordendespacho_id` int(11) DEFAULT NULL,
  `ordenproducto_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `documento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departamentoNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documentoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccionContacto` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrioContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefonoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celularContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departamentoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EstadoAprobacion`
--

CREATE TABLE `EstadoAprobacion` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `EstadoAprobacion`
--

INSERT INTO `EstadoAprobacion` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Aprobado Operaciones', NULL),
(2, NULL, 'Aprobado Comercial', NULL),
(3, NULL, 'Aprobado Director', NULL),
(4, NULL, 'Aprobado Cliente', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EstadoAprobacion_audit`
--

CREATE TABLE `EstadoAprobacion_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EstadoCatalogo`
--

CREATE TABLE `EstadoCatalogo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `EstadoCatalogo`
--

INSERT INTO `EstadoCatalogo` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'No aprobado', NULL),
(2, NULL, 'Aprobado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EstadoCatalogo_audit`
--

CREATE TABLE `EstadoCatalogo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estados`
--

CREATE TABLE `Estados` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Estados`
--

INSERT INTO `Estados` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Activo', NULL),
(2, NULL, 'Retirado', NULL),
(4, NULL, 'Inactivo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estados_audit`
--

CREATE TABLE `Estados_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Excel`
--

CREATE TABLE `Excel` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `excel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ExcelProveedor`
--

CREATE TABLE `ExcelProveedor` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `excel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ExcelProveedor_audit`
--

CREATE TABLE `ExcelProveedor_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `excel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Excel_audit`
--

CREATE TABLE `Excel_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `excel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Factura`
--

CREATE TABLE `Factura` (
  `id` int(11) NOT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `periodo_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `numero` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rutapdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pdfLogistica` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logistica` tinyint(1) DEFAULT NULL,
  `requisiciones` tinyint(1) DEFAULT NULL,
  `premios` tinyint(1) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Facturacostos`
--

CREATE TABLE `Facturacostos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valor` bigint(20) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Facturacostos_audit`
--

CREATE TABLE `Facturacostos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valor` bigint(20) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FacturaDetalle`
--

CREATE TABLE `FacturaDetalle` (
  `id` int(11) NOT NULL,
  `factura_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valorUnitario` double DEFAULT NULL,
  `valorTotal` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FacturaDetalle_audit`
--

CREATE TABLE `FacturaDetalle_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `factura_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valorUnitario` double DEFAULT NULL,
  `valorTotal` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Facturaestado`
--

CREATE TABLE `Facturaestado` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Facturaestado_audit`
--

CREATE TABLE `Facturaestado_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FacturaLogistica`
--

CREATE TABLE `FacturaLogistica` (
  `id` int(11) NOT NULL,
  `factura_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valorUnitario` double DEFAULT NULL,
  `valorTotal` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FacturaLogistica_audit`
--

CREATE TABLE `FacturaLogistica_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `factura_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valorUnitario` double DEFAULT NULL,
  `valorTotal` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FacturaProductos`
--

CREATE TABLE `FacturaProductos` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `factura_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valorUnitario` double DEFAULT NULL,
  `valorTotal` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FacturaProductos_audit`
--

CREATE TABLE `FacturaProductos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `factura_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valorUnitario` double DEFAULT NULL,
  `valorTotal` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Factura_audit`
--

CREATE TABLE `Factura_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `periodo_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `numero` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rutapdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pdfLogistica` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logistica` tinyint(1) DEFAULT NULL,
  `requisiciones` tinyint(1) DEFAULT NULL,
  `premios` tinyint(1) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupo`
--

CREATE TABLE `Grupo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Grupo`
--

INSERT INTO `Grupo` (`id`, `usuario_id`, `nombre`, `role`, `fechaModificacion`) VALUES
(1, NULL, 'Administrador', 'ROLE_ADMIN', NULL),
(2, NULL, 'Director de Operaciones', 'ROLE_DIR', NULL),
(3, NULL, 'Asistente de Operaciones', 'ROLE_ASIS', NULL),
(4, NULL, 'Proveedor', 'ROLE_PROV', NULL),
(7, NULL, 'Asistente de Compras', 'ROLE_ASISCOMP', NULL),
(8, NULL, 'Ejecutivo de Cuenta', 'ROLE_EJEC', NULL),
(9, NULL, 'Call Center', 'ROLE_CALL', NULL),
(10, NULL, 'Servicio al Cliente', 'ROLE_SERV', NULL),
(11, NULL, 'Calidad', 'ROLE_CALD', NULL),
(12, NULL, 'Logistica', 'ROLE_LOGIS', NULL),
(13, NULL, 'Asistente de Catalogos', 'ROLE_CAT', NULL),
(14, NULL, 'Director Comercial', 'ROLE_COM', NULL),
(15, NULL, 'Cliente', 'ROLE_CLI', NULL),
(16, NULL, 'Operador Logistico', 'ROLE_BOD', NULL),
(17, NULL, 'Diseño', 'ROLE_DIS', NULL),
(18, NULL, 'Demo Cliente', 'ROLE_CLIDEMO', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupo_audit`
--

CREATE TABLE `Grupo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GuiaEnvio`
--

CREATE TABLE `GuiaEnvio` (
  `id` int(11) NOT NULL,
  `courier_id` int(11) DEFAULT NULL,
  `inventario_id` int(11) DEFAULT NULL,
  `redencionenvio_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `guia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `operador` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor` bigint(20) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `ordenProducto_id` int(11) DEFAULT NULL,
  `facturaLogistica_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GuiaEnvio_audit`
--

CREATE TABLE `GuiaEnvio_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `courier_id` int(11) DEFAULT NULL,
  `inventario_id` int(11) DEFAULT NULL,
  `redencionenvio_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `guia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `operador` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor` bigint(20) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `ordenProducto_id` int(11) DEFAULT NULL,
  `facturaLogistica_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Idiomas`
--

CREATE TABLE `Idiomas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Idiomas`
--

INSERT INTO `Idiomas` (`id`, `usuario_id`, `nombre`, `codigo`, `fechaModificacion`) VALUES
(1, NULL, 'Español', 'es', NULL),
(2, NULL, 'Ingles', 'en', NULL),
(3, NULL, 'Portugues', 'pt', NULL),
(4, NULL, 'Frances', 'fr', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Imagenproducto`
--

CREATE TABLE `Imagenproducto` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Imagenproducto_audit`
--

CREATE TABLE `Imagenproducto_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Intervalos`
--

CREATE TABLE `Intervalos` (
  `id` int(11) NOT NULL,
  `catalogos_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `minimo` double DEFAULT NULL,
  `maximo` double DEFAULT NULL,
  `puntos` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Intervalos_audit`
--

CREATE TABLE `Intervalos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `catalogos_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `minimo` double DEFAULT NULL,
  `maximo` double DEFAULT NULL,
  `puntos` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inventario`
--

CREATE TABLE `Inventario` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `convocatoria_id` int(11) DEFAULT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `planilla_id` int(11) DEFAULT NULL,
  `orden_id` int(11) DEFAULT NULL,
  `ordenproducto_id` int(11) DEFAULT NULL,
  `despacho_id` int(11) DEFAULT NULL,
  `envio_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `ingreso` tinyint(1) DEFAULT NULL,
  `salio` tinyint(1) DEFAULT NULL,
  `fechaEntrada` datetime DEFAULT NULL,
  `fechaSalida` datetime DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valorCompra` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `InventarioGuia`
--

CREATE TABLE `InventarioGuia` (
  `id` int(11) NOT NULL,
  `inventario_id` int(11) DEFAULT NULL,
  `guia_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `fechaEntrega` datetime DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cierreEstado_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `InventarioGuia_audit`
--

CREATE TABLE `InventarioGuia_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `inventario_id` int(11) DEFAULT NULL,
  `guia_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `fechaEntrega` datetime DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cierreEstado_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `InventarioHistorico`
--

CREATE TABLE `InventarioHistorico` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `convocatoria_id` int(11) DEFAULT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `planilla_id` int(11) DEFAULT NULL,
  `orden_id` int(11) DEFAULT NULL,
  `ordenproducto_id` int(11) DEFAULT NULL,
  `inventario_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valorCompra` double DEFAULT NULL,
  `ingreso` tinyint(1) DEFAULT NULL,
  `salio` tinyint(1) DEFAULT NULL,
  `fechaEntrada` datetime DEFAULT NULL,
  `fechaSalida` datetime DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo` bigint(20) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inventario_audit`
--

CREATE TABLE `Inventario_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `convocatoria_id` int(11) DEFAULT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `planilla_id` int(11) DEFAULT NULL,
  `orden_id` int(11) DEFAULT NULL,
  `ordenproducto_id` int(11) DEFAULT NULL,
  `despacho_id` int(11) DEFAULT NULL,
  `envio_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `ingreso` tinyint(1) DEFAULT NULL,
  `salio` tinyint(1) DEFAULT NULL,
  `fechaEntrada` datetime DEFAULT NULL,
  `fechaSalida` datetime DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valorCompra` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Justificacion`
--

CREATE TABLE `Justificacion` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Justificacion`
--

INSERT INTO `Justificacion` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Proveedor bloqueado', NULL),
(2, NULL, 'Compra Tarde', NULL),
(3, NULL, 'Despacho tarde', NULL),
(4, NULL, 'Demora en pago', NULL),
(5, NULL, 'Premio averiado', NULL),
(6, NULL, 'Entrega tarde del proveedor', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Justificacion_audit`
--

CREATE TABLE `Justificacion_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Menu`
--

CREATE TABLE `Menu` (
  `id` int(11) NOT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Menu_audit`
--

CREATE TABLE `Menu_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_grupo`
--

CREATE TABLE `menu_grupo` (
  `menu_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MonedaTipo`
--

CREATE TABLE `MonedaTipo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MonedaTipo_audit`
--

CREATE TABLE `MonedaTipo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Novedades`
--

CREATE TABLE `Novedades` (
  `id` int(11) NOT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `accion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacionaccion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `solucion` varchar(1500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `devolucionTipo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Novedadesaccion`
--

CREATE TABLE `Novedadesaccion` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Novedadesaccion`
--

INSERT INTO `Novedadesaccion` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Recompra', NULL),
(2, NULL, 'Nuevo Despacho', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Novedadesaccion_audit`
--

CREATE TABLE `Novedadesaccion_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `NovedadesDevolucionTipo`
--

CREATE TABLE `NovedadesDevolucionTipo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `NovedadesDevolucionTipo`
--

INSERT INTO `NovedadesDevolucionTipo` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Dirección errada', NULL),
(2, NULL, 'Se traslado', NULL),
(3, NULL, 'Se rehusa a recibir', NULL),
(4, NULL, 'No lo conocen', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `NovedadesDevolucionTipo_audit`
--

CREATE TABLE `NovedadesDevolucionTipo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Novedadesestado`
--

CREATE TABLE `Novedadesestado` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Novedadesestado`
--

INSERT INTO `Novedadesestado` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Registrada', NULL),
(2, NULL, 'Aprobada', NULL),
(3, NULL, 'En tramite', NULL),
(4, NULL, 'Cerrada', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Novedadesestado_audit`
--

CREATE TABLE `Novedadesestado_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Novedadestipo`
--

CREATE TABLE `Novedadestipo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Novedadestipo`
--

INSERT INTO `Novedadestipo` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Devolucion', NULL),
(2, NULL, 'Perdida', NULL),
(3, NULL, 'Daño - Garantia', NULL),
(4, NULL, 'Cambio- producto no conforme', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Novedadestipo_audit`
--

CREATE TABLE `Novedadestipo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Novedades_audit`
--

CREATE TABLE `Novedades_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `accion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacionaccion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `solucion` varchar(1500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `devolucionTipo_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OrdenesCompra`
--

CREATE TABLE `OrdenesCompra` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `aprobo_id` int(11) DEFAULT NULL,
  `creador_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `consecutivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rutapdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rutapdfcodes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `fechaVencimiento` date DEFAULT NULL,
  `fechaRecepcion` date DEFAULT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci,
  `cancelado` tinyint(1) DEFAULT NULL,
  `aplicaIva` tinyint(1) DEFAULT NULL,
  `facturarCostos` tinyint(1) DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `trm` double DEFAULT NULL,
  `comisionBancaria` double DEFAULT NULL,
  `servicioLogistico` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `domicilio` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `ordenesTipo_id` int(11) DEFAULT NULL,
  `monedaTipo_id` int(11) DEFAULT NULL,
  `ordenesEstado_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OrdenesCompraHistorico`
--

CREATE TABLE `OrdenesCompraHistorico` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `ordencompra_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `consecutivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rutapdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `fechaVencimiento` date DEFAULT NULL,
  `fechaRecepcion` date DEFAULT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci,
  `cancelado` tinyint(1) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `ordenesTipo_id` int(11) DEFAULT NULL,
  `ordenesEstado_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OrdenesCompra_audit`
--

CREATE TABLE `OrdenesCompra_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `aprobo_id` int(11) DEFAULT NULL,
  `creador_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `consecutivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rutapdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rutapdfcodes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `fechaVencimiento` date DEFAULT NULL,
  `fechaRecepcion` date DEFAULT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci,
  `cancelado` tinyint(1) DEFAULT NULL,
  `aplicaIva` tinyint(1) DEFAULT NULL,
  `facturarCostos` tinyint(1) DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `trm` double DEFAULT NULL,
  `comisionBancaria` double DEFAULT NULL,
  `servicioLogistico` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `domicilio` double DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `ordenesTipo_id` int(11) DEFAULT NULL,
  `monedaTipo_id` int(11) DEFAULT NULL,
  `ordenesEstado_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OrdenesEstado`
--

CREATE TABLE `OrdenesEstado` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `OrdenesEstado`
--

INSERT INTO `OrdenesEstado` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Abierta', NULL),
(2, NULL, 'Aprobada', NULL),
(3, NULL, 'Cancelada', NULL),
(4, NULL, 'Incompleta', NULL),
(5, NULL, 'Cerrada', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OrdenesEstado_audit`
--

CREATE TABLE `OrdenesEstado_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OrdenesProducto`
--

CREATE TABLE `OrdenesProducto` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `cantidadrecibida` int(11) DEFAULT NULL,
  `valorunidad` double DEFAULT NULL,
  `valortotal` double DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `precioCliente` double DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `centrocostos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `ordenesCompra_id` int(11) DEFAULT NULL,
  `productoCotizacion_id` int(11) DEFAULT NULL,
  `facturaProducto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OrdenesProductoHistorico`
--

CREATE TABLE `OrdenesProductoHistorico` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `ordencompra_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `cantidadrecibida` int(11) DEFAULT NULL,
  `valorunidad` bigint(20) DEFAULT NULL,
  `valortotal` bigint(20) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `ordenesCompra_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OrdenesProducto_audit`
--

CREATE TABLE `OrdenesProducto_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `cantidadrecibida` int(11) DEFAULT NULL,
  `valorunidad` double DEFAULT NULL,
  `valortotal` double DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `precioCliente` double DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `centrocostos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `ordenesCompra_id` int(11) DEFAULT NULL,
  `productoCotizacion_id` int(11) DEFAULT NULL,
  `facturaProducto_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OrdenesTipo`
--

CREATE TABLE `OrdenesTipo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `OrdenesTipo`
--

INSERT INTO `OrdenesTipo` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Requisiciones', NULL),
(2, NULL, 'Redenciones', NULL),
(3, NULL, 'Pendientes', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OrdenesTipo_audit`
--

CREATE TABLE `OrdenesTipo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pais`
--

CREATE TABLE `Pais` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poligono` longtext COLLATE utf8_unicode_ci,
  `zoom` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Pais`
--

INSERT INTO `Pais` (`id`, `usuario_id`, `nombre`, `latitud`, `longitud`, `poligono`, `zoom`, `fechaModificacion`) VALUES
(1, NULL, 'COLOMBIA', '', '', '', 0, NULL),
(2, NULL, 'ESTADOS UNIDOS', '', '', '', 0, NULL),
(3, NULL, 'ARGENTINA', '', '', '', 0, NULL),
(4, NULL, 'BOLIVIA', '', '', '', 0, NULL),
(5, NULL, 'BRASIL', '', '', '', 0, NULL),
(6, NULL, 'CHILE ', '', '', '', 0, NULL),
(8, NULL, 'COSTARICA', '', '', '', 0, NULL),
(9, NULL, 'ECUADOR', '', '', '', 0, NULL),
(10, NULL, 'EL SALVADOR', '', '', '', 0, NULL),
(12, NULL, 'GUATEMALA', '', '', '', 0, NULL),
(13, NULL, 'HONDURAS', '', '', '', 0, NULL),
(14, NULL, 'MEXICO', '', '', '', 0, NULL),
(15, NULL, 'NICARAGUA', '', '', '', 0, NULL),
(16, NULL, 'PANAMA', '', '', '', 0, NULL),
(17, NULL, 'PARAGUAY', '', '', '', 0, NULL),
(18, NULL, 'PERU', '', '', '', 0, NULL),
(19, NULL, 'REPUBLICA DOMINICANA', '', '', '', 0, NULL),
(20, NULL, 'URUGUAY', '', '', '', 0, NULL),
(21, NULL, 'VENEZUELA', '', '', '', 0, NULL),
(22, NULL, 'ARUBA & CURAZAO', '', '', '', 0, NULL),
(23, NULL, 'CANADA', '', '', '', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pais_audit`
--

CREATE TABLE `Pais_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poligono` longtext COLLATE utf8_unicode_ci,
  `zoom` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Participantes`
--

CREATE TABLE `Participantes` (
  `id` int(11) NOT NULL,
  `tipodocumento_id` int(11) DEFAULT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `participanteestado_id` int(11) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `participante` int(11) DEFAULT NULL,
  `documento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `llave` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Participantesestado`
--

CREATE TABLE `Participantesestado` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Participantesestado`
--

INSERT INTO `Participantesestado` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Activo', NULL),
(2, NULL, 'Inactivo', NULL),
(3, NULL, 'Retirado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Participantesestado_audit`
--

CREATE TABLE `Participantesestado_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Participantes_audit`
--

CREATE TABLE `Participantes_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `tipodocumento_id` int(11) DEFAULT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `participanteestado_id` int(11) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `participante` int(11) DEFAULT NULL,
  `documento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `llave` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Periodos`
--

CREATE TABLE `Periodos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `periodo` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Periodos_audit`
--

CREATE TABLE `Periodos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `periodo` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Planilla`
--

CREATE TABLE `Planilla` (
  `id` int(11) NOT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `consecutivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `planillaEstado_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PlanillaEstado`
--

CREATE TABLE `PlanillaEstado` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `PlanillaEstado`
--

INSERT INTO `PlanillaEstado` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Generada', NULL),
(2, NULL, 'Descargada', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PlanillaEstado_audit`
--

CREATE TABLE `PlanillaEstado_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PlanillaTipo`
--

CREATE TABLE `PlanillaTipo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PlanillaTipo_audit`
--

CREATE TABLE `PlanillaTipo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Planilla_audit`
--

CREATE TABLE `Planilla_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `consecutivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `planillaEstado_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Preciohistorico`
--

CREATE TABLE `Preciohistorico` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `precio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `principal` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Premios`
--

CREATE TABLE `Premios` (
  `id` int(11) NOT NULL,
  `catalogos_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `operaciones_id` int(11) DEFAULT NULL,
  `comercial_id` int(11) DEFAULT NULL,
  `director_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `agotado` tinyint(1) DEFAULT NULL,
  `referencia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marca` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `puntosTemporal` int(11) DEFAULT NULL,
  `precioTemporal` double DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `incrementoTemporal` double DEFAULT NULL,
  `logisticaTemporal` double DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `fechaInactivacion` datetime DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `estadoAprobacion_id` int(11) DEFAULT NULL,
  `aproboOperaciones_id` int(11) DEFAULT NULL,
  `aproboComercial_id` int(11) DEFAULT NULL,
  `aproboDirector_id` int(11) DEFAULT NULL,
  `aproboCliente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PremiosProductos`
--

CREATE TABLE `PremiosProductos` (
  `id` int(11) NOT NULL,
  `premio_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PremiosProductos_audit`
--

CREATE TABLE `PremiosProductos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `premio_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Premios_audit`
--

CREATE TABLE `Premios_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `catalogos_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `operaciones_id` int(11) DEFAULT NULL,
  `comercial_id` int(11) DEFAULT NULL,
  `director_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `agotado` tinyint(1) DEFAULT NULL,
  `referencia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marca` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `puntosTemporal` int(11) DEFAULT NULL,
  `precioTemporal` double DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `incrementoTemporal` double DEFAULT NULL,
  `logisticaTemporal` double DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `fechaInactivacion` datetime DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `estadoAprobacion_id` int(11) DEFAULT NULL,
  `aproboOperaciones_id` int(11) DEFAULT NULL,
  `aproboComercial_id` int(11) DEFAULT NULL,
  `aproboDirector_id` int(11) DEFAULT NULL,
  `aproboCliente_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Presupuestos`
--

CREATE TABLE `Presupuestos` (
  `id` int(11) NOT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valor` bigint(20) DEFAULT NULL,
  `mensual` bigint(20) DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Presupuestoshistorico`
--

CREATE TABLE `Presupuestoshistorico` (
  `id` int(11) NOT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `presupuesto_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valor` bigint(20) DEFAULT NULL,
  `mensual` bigint(20) DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCambio` datetime DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Presupuestos_audit`
--

CREATE TABLE `Presupuestos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valor` bigint(20) DEFAULT NULL,
  `mensual` bigint(20) DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Prioridad`
--

CREATE TABLE `Prioridad` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Prioridad_audit`
--

CREATE TABLE `Prioridad_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Producto`
--

CREATE TABLE `Producto` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `clasificacion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referencia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marca` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `codEAN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eanTemp` tinyint(1) DEFAULT NULL,
  `codInc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alto` double DEFAULT NULL,
  `largo` double DEFAULT NULL,
  `ancho` double DEFAULT NULL,
  `peso` double DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `iva` double DEFAULT NULL,
  `estadoIva` tinyint(1) DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `fechacreacion` date DEFAULT NULL,
  `fechaactualizacion` date DEFAULT NULL,
  `codImg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProductoCalificacion`
--

CREATE TABLE `ProductoCalificacion` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `catalogo_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valor` smallint(6) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProductoCalificacion_audit`
--

CREATE TABLE `ProductoCalificacion_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `catalogo_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valor` smallint(6) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productocatalogo`
--

CREATE TABLE `Productocatalogo` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `catalogos_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `operaciones_id` int(11) DEFAULT NULL,
  `comercial_id` int(11) DEFAULT NULL,
  `director_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  `puntos` int(11) DEFAULT NULL,
  `actualizacion` tinyint(1) DEFAULT NULL,
  `agotado` tinyint(1) DEFAULT NULL,
  `puntosTemporal` int(11) DEFAULT NULL,
  `precioTemporal` double DEFAULT NULL,
  `incrementoTemporal` double DEFAULT NULL,
  `logisticaTemporal` double DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `fechaInactivacion` datetime DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `estadoAprobacion_id` int(11) DEFAULT NULL,
  `aproboOperaciones_id` int(11) DEFAULT NULL,
  `aproboComercial_id` int(11) DEFAULT NULL,
  `aproboDirector_id` int(11) DEFAULT NULL,
  `aproboCliente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProductocatalogoHistorico`
--

CREATE TABLE `ProductocatalogoHistorico` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `catalogos_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `productocatalogo_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `operaciones_id` int(11) DEFAULT NULL,
  `comercial_id` int(11) DEFAULT NULL,
  `director_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  `puntos` int(11) DEFAULT NULL,
  `actualizacion` tinyint(1) DEFAULT NULL,
  `agotado` tinyint(1) NOT NULL,
  `puntosTemporal` int(11) DEFAULT NULL,
  `precioTemporal` double DEFAULT NULL,
  `incrementoTemporal` double DEFAULT NULL,
  `logisticaTemporal` double DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `fechaInactivacion` datetime DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `aproboOperaciones_id` int(11) DEFAULT NULL,
  `aproboComercial_id` int(11) DEFAULT NULL,
  `aproboDirector_id` int(11) DEFAULT NULL,
  `aproboCliente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productocatalogo_audit`
--

CREATE TABLE `Productocatalogo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `catalogos_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `operaciones_id` int(11) DEFAULT NULL,
  `comercial_id` int(11) DEFAULT NULL,
  `director_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `actualizacion` tinyint(1) DEFAULT NULL,
  `agotado` tinyint(1) DEFAULT NULL,
  `puntosTemporal` int(11) DEFAULT NULL,
  `precioTemporal` double DEFAULT NULL,
  `incrementoTemporal` double DEFAULT NULL,
  `logisticaTemporal` double DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `fechaInactivacion` datetime DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `estadoAprobacion_id` int(11) DEFAULT NULL,
  `aproboOperaciones_id` int(11) DEFAULT NULL,
  `aproboComercial_id` int(11) DEFAULT NULL,
  `aproboDirector_id` int(11) DEFAULT NULL,
  `aproboCliente_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productoclasificacion`
--

CREATE TABLE `Productoclasificacion` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Productoclasificacion`
--

INSERT INTO `Productoclasificacion` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Basico', NULL),
(2, NULL, 'Medium', NULL),
(3, NULL, 'Premium', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productoclasificacion_audit`
--

CREATE TABLE `Productoclasificacion_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProductoIdiomas`
--

CREATE TABLE `ProductoIdiomas` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `idioma_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProductoIdiomas_audit`
--

CREATE TABLE `ProductoIdiomas_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `idioma_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productoprecio`
--

CREATE TABLE `Productoprecio` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `precioDolares` double DEFAULT NULL,
  `principal` tinyint(1) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productoprecio_audit`
--

CREATE TABLE `Productoprecio_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `precioDolares` double DEFAULT NULL,
  `principal` tinyint(1) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProductoTipo`
--

CREATE TABLE `ProductoTipo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProductoTipo_audit`
--

CREATE TABLE `ProductoTipo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Producto_audit`
--

CREATE TABLE `Producto_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `clasificacion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referencia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marca` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `codEAN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eanTemp` tinyint(1) DEFAULT NULL,
  `codInc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alto` double DEFAULT NULL,
  `largo` double DEFAULT NULL,
  `ancho` double DEFAULT NULL,
  `peso` double DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `iva` double DEFAULT NULL,
  `estadoIva` tinyint(1) DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `fechacreacion` date DEFAULT NULL,
  `fechaactualizacion` date DEFAULT NULL,
  `codImg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Programa`
--

CREATE TABLE `Programa` (
  `id` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fechainicio` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `iva` tinyint(1) DEFAULT NULL,
  `diasentrega` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `centroCostos_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Programa_audit`
--

CREATE TABLE `Programa_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fechainicio` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `iva` tinyint(1) DEFAULT NULL,
  `diasentrega` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `centroCostos_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Promociones`
--

CREATE TABLE `Promociones` (
  `id` int(11) NOT NULL,
  `premio_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `puntos` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `redimidos` int(11) DEFAULT NULL,
  `disponibles` int(11) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Promociones_audit`
--

CREATE TABLE `Promociones_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `premio_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `puntos` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `redimidos` int(11) DEFAULT NULL,
  `disponibles` int(11) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proveedores`
--

CREATE TABLE `Proveedores` (
  `id` int(11) NOT NULL,
  `tipodocumento_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `regimen_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `clasificacion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_documento` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sede_principal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registro_camara` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lineaAtencion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sedes` tinyint(1) DEFAULT NULL,
  `datos_sedes` longtext COLLATE utf8_unicode_ci,
  `pagina` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cobertura` longtext COLLATE utf8_unicode_ci,
  `condiciones_comerciales` longtext COLLATE utf8_unicode_ci,
  `tiempo_entrega` int(11) DEFAULT NULL,
  `cupo_asignado` bigint(20) DEFAULT NULL,
  `fecha` date NOT NULL,
  `directo` tinyint(1) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProveedoresArea`
--

CREATE TABLE `ProveedoresArea` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProveedoresArea_audit`
--

CREATE TABLE `ProveedoresArea_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProveedoresCalificacion`
--

CREATE TABLE `ProveedoresCalificacion` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `calificacion` double DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `periodo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estadoPlan` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `observacion` longtext COLLATE utf8_unicode_ci,
  `resultado` tinyint(1) DEFAULT NULL,
  `planAccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacionproveedor` longtext COLLATE utf8_unicode_ci,
  `fechaPlan` date DEFAULT NULL,
  `observacionfinal` longtext COLLATE utf8_unicode_ci,
  `estado` int(11) DEFAULT NULL,
  `ce` double DEFAULT NULL,
  `cpi` double DEFAULT NULL,
  `bep` double DEFAULT NULL,
  `pd` double DEFAULT NULL,
  `aoc` double DEFAULT NULL,
  `cfp` double DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `carta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProveedoresCalificacion_audit`
--

CREATE TABLE `ProveedoresCalificacion_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `calificacion` double DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `periodo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estadoPlan` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `observacion` longtext COLLATE utf8_unicode_ci,
  `resultado` tinyint(1) DEFAULT NULL,
  `planAccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacionproveedor` longtext COLLATE utf8_unicode_ci,
  `fechaPlan` date DEFAULT NULL,
  `observacionfinal` longtext COLLATE utf8_unicode_ci,
  `estado` int(11) DEFAULT NULL,
  `ce` double DEFAULT NULL,
  `cpi` double DEFAULT NULL,
  `bep` double DEFAULT NULL,
  `pd` double DEFAULT NULL,
  `aoc` double DEFAULT NULL,
  `cfp` double DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `carta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProveedoresClasificacion`
--

CREATE TABLE `ProveedoresClasificacion` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProveedoresClasificacion_audit`
--

CREATE TABLE `ProveedoresClasificacion_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProveedoresHistorico`
--

CREATE TABLE `ProveedoresHistorico` (
  `id` int(11) NOT NULL,
  `tipodocumento_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `regimen_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_documento` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sede_principal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registro_camara` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sedes` tinyint(1) DEFAULT NULL,
  `datos_sedes` longtext COLLATE utf8_unicode_ci,
  `pagina` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cobertura` longtext COLLATE utf8_unicode_ci,
  `condiciones_comerciales` longtext COLLATE utf8_unicode_ci,
  `tiempo_entrega` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cupo_asignado` bigint(20) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProveedoresTipo`
--

CREATE TABLE `ProveedoresTipo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ProveedoresTipo`
--

INSERT INTO `ProveedoresTipo` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Nacional', NULL),
(2, NULL, 'Internacional', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProveedoresTipo_audit`
--

CREATE TABLE `ProveedoresTipo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proveedores_audit`
--

CREATE TABLE `Proveedores_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `tipodocumento_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `regimen_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `clasificacion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_documento` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sede_principal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registro_camara` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lineaAtencion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sedes` tinyint(1) DEFAULT NULL,
  `datos_sedes` longtext COLLATE utf8_unicode_ci,
  `pagina` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cobertura` longtext COLLATE utf8_unicode_ci,
  `condiciones_comerciales` longtext COLLATE utf8_unicode_ci,
  `tiempo_entrega` int(11) DEFAULT NULL,
  `cupo_asignado` bigint(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `directo` tinyint(1) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Redenciones`
--

CREATE TABLE `Redenciones` (
  `id` int(11) NOT NULL,
  `participante_id` int(11) DEFAULT NULL,
  `premio_id` int(11) DEFAULT NULL,
  `promocion_id` int(11) DEFAULT NULL,
  `redencionestado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `justificacion_id` int(11) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `valorLogistica` double DEFAULT NULL,
  `valorOrden` double DEFAULT NULL,
  `valorCompra` double DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `valorVenta` double DEFAULT NULL,
  `diasEntrega` int(11) DEFAULT NULL,
  `puntos` double DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `fechaAutorizacion` datetime DEFAULT NULL,
  `fechaDespacho` datetime DEFAULT NULL,
  `fechaEntrega` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `otros` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redimidopor` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigoredencion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `totalPass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mensajeTotalPass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `observacionJustificacion` longtext COLLATE utf8_unicode_ci,
  `ordenesProducto_id` int(11) DEFAULT NULL,
  `facturaProducto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Redencionesatributos`
--

CREATE TABLE `Redencionesatributos` (
  `id` int(11) NOT NULL,
  `atributos_id` int(11) DEFAULT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Redencionesatributos_audit`
--

CREATE TABLE `Redencionesatributos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `atributos_id` int(11) DEFAULT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Redencionesenvios`
--

CREATE TABLE `Redencionesenvios` (
  `id` int(11) NOT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departamentoNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documentoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccionContacto` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrioContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefonoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celularContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departamentoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Redencionesenvios_audit`
--

CREATE TABLE `Redencionesenvios_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departamentoNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documentoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccionContacto` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrioContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefonoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celularContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departamentoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Redencionesestado`
--

CREATE TABLE `Redencionesestado` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Redencionesestado`
--

INSERT INTO `Redencionesestado` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Por Autorizar', NULL),
(2, NULL, 'Autorizado', NULL),
(3, NULL, 'En compra', NULL),
(4, NULL, 'En alistamiento', NULL),
(5, NULL, 'Despachado', NULL),
(6, NULL, 'Entregado', NULL),
(7, NULL, 'Cancelado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Redencionesestado_audit`
--

CREATE TABLE `Redencionesestado_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RedencionesHistorico`
--

CREATE TABLE `RedencionesHistorico` (
  `id` int(11) NOT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `participante_id` int(11) DEFAULT NULL,
  `productocatalogo_id` int(11) DEFAULT NULL,
  `redencionestado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `puntos` double DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `fechaAutorizacion` datetime DEFAULT NULL,
  `fechaDespacho` datetime DEFAULT NULL,
  `fechaEntrega` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `atributos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redimidopor` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigoredencion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `totalPass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mensajeTotalPass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `ordenesProducto_id` int(11) DEFAULT NULL,
  `facturaProducto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RedencionesProductos`
--

CREATE TABLE `RedencionesProductos` (
  `id` int(11) NOT NULL,
  `redencion_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `precioLogistica` double DEFAULT NULL,
  `precioCompra` double DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `diasEntrega` int(11) DEFAULT NULL,
  `fechaAutorizacion` datetime DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `fechaDespacho` datetime DEFAULT NULL,
  `fechaEntrega` datetime DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `ordenesProducto_id` int(11) DEFAULT NULL,
  `facturaProducto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Redenciones_audit`
--

CREATE TABLE `Redenciones_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `participante_id` int(11) DEFAULT NULL,
  `premio_id` int(11) DEFAULT NULL,
  `promocion_id` int(11) DEFAULT NULL,
  `redencionestado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `justificacion_id` int(11) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `valorLogistica` double DEFAULT NULL,
  `valorOrden` double DEFAULT NULL,
  `valorCompra` double DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `logistica` double DEFAULT NULL,
  `valorVenta` double DEFAULT NULL,
  `diasEntrega` int(11) DEFAULT NULL,
  `puntos` double DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `fechaAutorizacion` datetime DEFAULT NULL,
  `fechaDespacho` datetime DEFAULT NULL,
  `fechaEntrega` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `otros` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redimidopor` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigoredencion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `totalPass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mensajeTotalPass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `observacionJustificacion` longtext COLLATE utf8_unicode_ci,
  `ordenesProducto_id` int(11) DEFAULT NULL,
  `facturaProducto_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Regimen`
--

CREATE TABLE `Regimen` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Regimen`
--

INSERT INTO `Regimen` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Comun', NULL),
(2, NULL, 'Simplificado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Regimen_audit`
--

CREATE TABLE `Regimen_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Requisicion`
--

CREATE TABLE `Requisicion` (
  `id` int(11) NOT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `consecutivo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rutapdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Requisicionesenvios`
--

CREATE TABLE `Requisicionesenvios` (
  `id` int(11) NOT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `documento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departamentoNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documentoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccionContacto` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrioContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefonoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celularContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departamentoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Requisicionesenvios`
--

INSERT INTO `Requisicionesenvios` (`id`, `ciudad_id`, `usuario_id`, `documento`, `nombre`, `observaciones`, `ciudadNombre`, `direccion`, `barrio`, `telefono`, `celular`, `departamentoNombre`, `nombreContacto`, `documentoContacto`, `ciudadContacto`, `direccionContacto`, `barrioContacto`, `telefonoContacto`, `celularContacto`, `departamentoContacto`, `fechaModificacion`) VALUES
(2, NULL, NULL, '', 'RAFAEL MUNAR', 'PLANILLA 3438', 'MEDELLIN', 'Cra 79 a # 53b- 92 apto 401 Edificio Hero, Barrio los Colores Medellin.', '', '', '3182111673', 'antioquia', '', '', '', '', '', '', '', '', NULL),
(3, NULL, NULL, '', 'RAFAEL MUNAR', 'PLANILLA 3438', 'MEDELLIN', 'Cra 79 a # 53b- 92 apto 401 Edificio Hero, Barrio los Colores Medellin.', '', '', '3182111673', 'ANTIOQUIA', '', '', '', '', '', '', '', '', NULL),
(4, NULL, NULL, 'N/A', 'Carolina Gonzalez/Fredy Castillo', 'Planilla 3411', 'Bogota', 'Carrera 65B No.11-40', 'ZONA INDUSTRIAL', '3118335435', '3118335435', 'Cundinamarca', 'Carolina Gonzalez/Fredy Castillo', 'N/A', 'BOGOTA', 'Carrera 65B No.11-40', 'ZONA INDUSTRIAL', '3118335435', '3118335435', 'CUNDINAMARCA', NULL),
(5, NULL, NULL, '', 'JOHANA LEON/ ELECTO MORENO', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL),
(6, NULL, NULL, '', 'JOHANA LEON/ ELECTO MORENO', '', 'BOGOTA', 'Marcas y distribuciones CLL 22 A NO 97 - 22 FONTIBON', '', '3182111404/ 3175788355 electo moreno', '3182111404/ 3175788355 electo moreno', 'cundinamarca', 'LUZ MARINA DAZA CRUZ', '', '', '', '', '', '', '', NULL),
(7, NULL, NULL, 'N/A', 'Katherine Pulido', '', 'CALI', 'Calle 64norte # 5b-146 Centro Empresa oficina 43', 'N/A', '3213278645', '3213278645', 'VALLE DEL CAUCA', 'Oscar Javier Casallas', 'N/A', '', '', '', '', '', '', NULL),
(8, NULL, NULL, 'N/A', 'Katherine Pulido', '', 'CALI', 'Calle 64norte # 5b-146 Centro Empresa oficina 43', 'N/A', '3213278645', '3213278645', 'VALLE DEL CAUCA', 'Oscar Javier Casallas', 'N/A', 'CALI', 'Calle 64norte # 5b-146 Centro Empresa oficina 43', 'N/A', '3213278645', '3213278645', 'VALLE DEL CAUCA', NULL),
(9, NULL, NULL, 'N/A', 'Leiner Ortiz', '', 'MEDELLIN', 'Calle 79 sur#52a-45 Interior 2 ', 'San Agustin-La estrella', '3223459875', '3223459875', 'ANTIOQUIA', 'Leiner Ortiz', 'N/A', 'MEDELLIN', 'Calle 79 sur#52a-45 Interior 2 ', 'San Agustin-La estrella', '3223459875', '3223459875', 'ANTIOQUIA', NULL),
(10, NULL, NULL, 'N/A', 'Rene Hernandez', '', 'BARRANQUILLA', 'Calle 111 # 6-335 Bodega Pic 0 Parque Internacional de Caribe', 'Junto a Metroparque', '3158549533', '3158549533', 'ATLANTICO', 'Rene Hernandez', 'N/A', 'BARRANQUILLA', 'Calle 111 # 6-335 Bodega Pic 0 Parque Internacional de Caribe', 'Junto a Metroparque', '3158549533', '3158549533', 'ATLANTICO', NULL),
(11, NULL, NULL, 'N/A', 'Diego Leon', '', 'BOGOTA', 'Calle 18 # 69-75 Zona Industrial', 'Montevideo', '3112903727', '3112903727', 'CUNDINAMARCA', 'Diego Leon', 'N/A', 'BOGOTA', 'Calle 18 # 69-75 Zona Industrial', 'Montevideo', '3112903727', '3112903727', 'CUNDINAMARCA', NULL),
(12, NULL, NULL, 'N/A', 'Hector Villegas', '', 'DOSQUEBRADAS', 'Autopista la Romelia El Pollo Centro Logistico Eje cafetero Bodega 48', '', '3128382589', '3128382589', 'RISARALDA', 'Hector Villegas', 'N/A', 'DOSQUEBRADAS', 'Autopista la Romelia El Pollo Centro Logistico Eje cafetero Bodega 48', 'N/A', '3128382589', '3128382589', 'RISARALDA', NULL),
(13, NULL, NULL, 'N/A', 'Oscar Javier Casallas', '', 'CALI', 'Calle 64norte # 5b-146 Centro Empresa oficina 43', 'N/A', '3213278645', '3213278645', 'VALLE DEL CAUCA', 'Oscar Javier Casallas', 'N/A', 'CALI', 'Calle 64norte # 5b-146 Centro Empresa oficina 43', 'N/A', '3213278645', '3213278645', 'V', NULL),
(14, NULL, NULL, 'N/A', 'Leiner Ortiz', '', 'MEDELLIN', 'Calle 79 sur#52a-45 Interior 2 ', 'San Agustin-La estrella', '3223459875', '3223459875', 'ANTIOQUIA', 'Leiner Ortiz', 'N/A', 'MEDELLIN', 'Calle 79 sur#52a-45 Interior 2 ', 'San Agustin-La estrella', '3223459875', '3223459875', 'ANTIOQUIA', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Requisicionesenvios_audit`
--

CREATE TABLE `Requisicionesenvios_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `documento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departamentoNombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documentoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudadContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccionContacto` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barrioContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefonoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celularContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departamentoContacto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RequisicionProducto`
--

CREATE TABLE `RequisicionProducto` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `requisicion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `valorunidad` bigint(20) DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `valortotal` bigint(20) DEFAULT NULL,
  `logistica` bigint(20) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `facturaProducto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RequisicionProducto_audit`
--

CREATE TABLE `RequisicionProducto_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `requisicion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `valorunidad` bigint(20) DEFAULT NULL,
  `incremento` double DEFAULT NULL,
  `valortotal` bigint(20) DEFAULT NULL,
  `logistica` bigint(20) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `facturaProducto_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Requisicion_audit`
--

CREATE TABLE `Requisicion_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `consecutivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rutapdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revisions`
--

CREATE TABLE `revisions` (
  `id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Servicios`
--

CREATE TABLE `Servicios` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Servicios`
--

INSERT INTO `Servicios` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Catalogo', NULL),
(2, NULL, 'Categorias', NULL),
(3, NULL, 'RedencionNueva', NULL),
(4, NULL, 'RedencionAutorizada', NULL),
(5, NULL, 'InventarioEntrada', NULL),
(6, NULL, 'InventarioSalida', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ServiciosLog`
--

CREATE TABLE `ServiciosLog` (
  `id` int(11) NOT NULL,
  `servicio_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `url` longtext COLLATE utf8_unicode_ci,
  `datos` longtext COLLATE utf8_unicode_ci,
  `parametros` longtext COLLATE utf8_unicode_ci,
  `resultado` int(11) DEFAULT NULL,
  `mensaje` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `cliente` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ServiciosLog`
--

INSERT INTO `ServiciosLog` (`id`, `servicio_id`, `usuario_id`, `url`, `datos`, `parametros`, `resultado`, `mensaje`, `fecha`, `cliente`, `fechaModificacion`) VALUES
(23, 5, NULL, '/servicios/inventarioentrada', 'ordencompra=556', NULL, 0, 'No se encontro la orden de compra No. ', '2014-03-25 10:08:48', '186.84.6.190', NULL),
(24, 5, NULL, '/servicios/inventarioentrada', '[{"cantidad":1,"ean":7704789722285,"f_teklado":"19/04/2013","h_teklado":"07:30:45","m_producto":"TULA FUTBOL","m_teklado":"YULI CATHERINE","ordencompra":"52.00","o_notas":"Tula Futbol:N\\/A","s_idpremio":"0","s_marca":"TOTTO","s_producto":"","s_programa":"N\\/A","s_ref":"MA054CT002","s_seller":"","v_declara":72105}]', NULL, 0, 'No se encontro la orden de compra No. ', '2014-03-25 14:45:30', '181.135.188.128', NULL),
(25, 5, NULL, '/servicios/inventarioentrada', '[{"cantidad":1,"ean":7704789722285,"f_teklado":"19/04/2013","h_teklado":"07:30:45","m_producto":"TULA FUTBOL","m_teklado":"YULI CATHERINE","ordencompra":"52.00","o_notas":"Tula Futbol:N\\/A","s_idpremio":"0","s_marca":"TOTTO","s_producto":"","s_programa":"N\\/A","s_ref":"MA054CT002","s_seller":"","v_declara":72105}]', NULL, 0, 'No se encontro la orden de compra No. ', '2014-03-25 16:17:06', '186.84.6.190', NULL),
(26, 5, NULL, '/servicios/inventarioentrada', '[{"cantidad":1,"ean":7704789722285,"f_teklado":"19/04/2013","h_teklado":"07:30:45","m_producto":"TULA FUTBOL","m_teklado":"YULI CATHERINE","ordencompra":"52.00","o_notas":"Tula Futbol:N\\/A","s_idpremio":"0","s_marca":"TOTTO","s_producto":"","s_programa":"N\\/A","s_ref":"MA054CT002","s_seller":"","v_declara":72105}]', NULL, 0, 'No se encontro la orden de compra No. ', '2014-03-25 16:19:50', '186.84.6.190', NULL),
(27, 5, NULL, '/servicios/inventarioentrada', '[{"cantidad":1,"ean":7704789722285,"f_teklado":"19/04/2013","h_teklado":"07:30:45","m_producto":"TULA FUTBOL","m_teklado":"YULI CATHERINE","ordencompra":"52.00","o_notas":"Tula Futbol:N\\/A","s_idpremio":"0","s_marca":"TOTTO","s_producto":"","s_programa":"N\\/A","s_ref":"MA054CT002","s_seller":"","v_declara":72105}]', NULL, 0, 'No se encontro la orden de compra No. ', '2014-03-25 16:20:22', '186.84.6.190', NULL),
(28, 5, NULL, '/servicios/inventarioentrada', '[{"cantidad":1,"ean":7704789722285,"f_teklado":"19/04/2013","h_teklado":"07:30:45","m_producto":"TULA FUTBOL","m_teklado":"YULI CATHERINE","ordencompra":"52.00","o_notas":"Tula Futbol:N\\/A","s_idpremio":"0","s_marca":"TOTTO","s_producto":"","s_programa":"N\\/A","s_ref":"MA054CT002","s_seller":"","v_declara":72105}]', NULL, 0, 'No se encontro la orden de compra No. ', '2014-03-25 16:21:10', '186.84.6.190', NULL),
(29, 5, NULL, '/servicios/inventarioentrada', '[{"cantidad":1,"ean":7704789722285,"f_teklado":"19/04/2013","h_teklado":"07:30:45","m_producto":"TULA FUTBOL","m_teklado":"YULI CATHERINE","ordencompra":"52.00","o_notas":"Tula Futbol:N\\/A","s_idpremio":"0","s_marca":"TOTTO","s_producto":"","s_programa":"N\\/A","s_ref":"MA054CT002","s_seller":"","v_declara":72105}]', NULL, 0, 'No se encontro la orden de compra No. 52.00', '2014-03-25 16:24:41', '186.84.6.190', NULL),
(30, 5, NULL, '/servicios/inventarioentrada', '[{"cantidad":1,"ean":7704789722285,"f_teklado":"19/04/2013","h_teklado":"07:30:45","m_producto":"TULA FUTBOL","m_teklado":"YULI CATHERINE","ordencompra":"52.00","o_notas":"Tula Futbol:N\\/A","s_idpremio":"0","s_marca":"TOTTO","s_producto":"","s_programa":"N\\/A","s_ref":"MA054CT002","s_seller":"","v_declara":72105}]', NULL, 0, 'No se encontro la orden de compra No. 52.00', '2014-03-25 17:21:23', '186.84.6.190', NULL),
(31, 5, NULL, '/servicios/inventariodespacho', '[{"ean":7704789722285,"codigodespacho":334455444,"guia":938393938393}]', NULL, 0, 'No se recibio el codigo de despacho', '2014-03-25 17:24:33', '186.84.6.190', NULL),
(32, 5, NULL, '/servicios/inventariodespacho', '[{"ean":7704789722285,"codigodespacho":334455444,"guia":938393938393}]', NULL, 1, 'Salida exitosa', '2014-03-25 17:25:07', '186.84.6.190', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ServiciosLog_audit`
--

CREATE TABLE `ServiciosLog_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `servicio_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `url` longtext COLLATE utf8_unicode_ci,
  `datos` longtext COLLATE utf8_unicode_ci,
  `parametros` longtext COLLATE utf8_unicode_ci,
  `resultado` int(11) DEFAULT NULL,
  `mensaje` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `cliente` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Servicios_audit`
--

CREATE TABLE `Servicios_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Solicitud`
--

CREATE TABLE `Solicitud` (
  `id` int(11) NOT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `prioridad_id` int(11) DEFAULT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `solicitante_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `descripcion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordenDespacho` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mantis` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_solicitud` date DEFAULT NULL,
  `observacionesSolicitante` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacionesOperaciones` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `centroCostos_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SolicitudesArchivos`
--

CREATE TABLE `SolicitudesArchivos` (
  `id` int(11) NOT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SolicitudesArchivos_audit`
--

CREATE TABLE `SolicitudesArchivos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SolicitudesAsignar`
--

CREATE TABLE `SolicitudesAsignar` (
  `id` int(11) NOT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SolicitudesAsignar_audit`
--

CREATE TABLE `SolicitudesAsignar_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SolicitudesEstado`
--

CREATE TABLE `SolicitudesEstado` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `SolicitudesEstado`
--

INSERT INTO `SolicitudesEstado` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Solicitada', NULL),
(2, NULL, 'Aceptada', NULL),
(3, NULL, 'Cancelada', NULL),
(4, NULL, 'Incompleta', NULL),
(5, NULL, 'Completada', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SolicitudesEstado_audit`
--

CREATE TABLE `SolicitudesEstado_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SolicitudesObservaciones`
--

CREATE TABLE `SolicitudesObservaciones` (
  `id` int(11) NOT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `Observacion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SolicitudesObservaciones_audit`
--

CREATE TABLE `SolicitudesObservaciones_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `Observacion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SolicitudTipo`
--

CREATE TABLE `SolicitudTipo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SolicitudTipo_audit`
--

CREATE TABLE `SolicitudTipo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Solicitud_audit`
--

CREATE TABLE `Solicitud_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `prioridad_id` int(11) DEFAULT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `solicitante_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `descripcion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordenDespacho` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mantis` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_solicitud` date DEFAULT NULL,
  `observacionesSolicitante` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacionesOperaciones` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `centroCostos_id` int(11) DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipoarchivo`
--

CREATE TABLE `Tipoarchivo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Tipoarchivo`
--

INSERT INTO `Tipoarchivo` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Camara de comercio', NULL),
(2, NULL, 'RUT', NULL),
(3, NULL, 'Estado financiero', NULL),
(4, NULL, 'Referencia bancaria', NULL),
(5, NULL, 'Referencia comercial', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipoarchivo_audit`
--

CREATE TABLE `Tipoarchivo_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipocostos`
--

CREATE TABLE `Tipocostos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Tipocostos`
--

INSERT INTO `Tipocostos` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'Costos Fijos', NULL),
(2, NULL, 'Costos Variables', NULL),
(3, NULL, 'Otros Costos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipocostos_audit`
--

CREATE TABLE `Tipocostos_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipodocumento`
--

CREATE TABLE `Tipodocumento` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Tipodocumento`
--

INSERT INTO `Tipodocumento` (`id`, `usuario_id`, `nombre`, `fechaModificacion`) VALUES
(1, NULL, 'C.C.', NULL),
(2, NULL, 'C.E.', NULL),
(3, NULL, 'NIT', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipodocumento_audit`
--

CREATE TABLE `Tipodocumento_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tracking`
--

CREATE TABLE `Tracking` (
  `id` int(11) NOT NULL,
  `ordenproducto_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `tracking` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordenAmazon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tarjeta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tracking_audit`
--

CREATE TABLE `Tracking_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `ordenproducto_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `tracking` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordenAmazon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tarjeta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios_audit`
--

CREATE TABLE `Usuarios_audit` (
  `id` int(11) NOT NULL,
  `rev` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `revtype` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_grupo`
--

CREATE TABLE `usuario_grupo` (
  `usuario_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Aeconomica`
--
ALTER TABLE `Aeconomica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_742F633ACB305D73` (`proveedor_id`),
  ADD KEY `IDX_742F633ADB38439E` (`usuario_id`);

--
-- Indices de la tabla `Aeconomica_audit`
--
ALTER TABLE `Aeconomica_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Archivos`
--
ALTER TABLE `Archivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E1FB66E5E919E768` (`tipoarchivo_id`),
  ADD KEY `IDX_E1FB66E59F5A440B` (`estado_id`),
  ADD KEY `IDX_E1FB66E5CB305D73` (`proveedor_id`),
  ADD KEY `IDX_E1FB66E5DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Archivos_audit`
--
ALTER TABLE `Archivos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Areas`
--
ALTER TABLE `Areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_99719D58DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Areas_audit`
--
ALTER TABLE `Areas_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Atributosproducto`
--
ALTER TABLE `Atributosproducto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23EF7AD17645698E` (`producto_id`),
  ADD KEY `IDX_23EF7AD1A9276E6C` (`tipo_id`),
  ADD KEY `IDX_23EF7AD19F5A440B` (`estado_id`),
  ADD KEY `IDX_23EF7AD1DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Atributosproducto_audit`
--
ALTER TABLE `Atributosproducto_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Atributostipo`
--
ALTER TABLE `Atributostipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5B24578ADB38439E` (`usuario_id`);

--
-- Indices de la tabla `Atributostipo_audit`
--
ALTER TABLE `Atributostipo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Catalogo`
--
ALTER TABLE `Catalogo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1EDA09139F5A440B` (`estado_id`),
  ADD KEY `IDX_1EDA0913CB305D73` (`proveedor_id`),
  ADD KEY `IDX_1EDA0913DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Catalogos`
--
ALTER TABLE `Catalogos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9FAE54DCFD8A7328` (`programa_id`),
  ADD KEY `IDX_9FAE54DC9F5A440B` (`estado_id`),
  ADD KEY `IDX_9FAE54DCA9276E6C` (`tipo_id`),
  ADD KEY `IDX_9FAE54DCC604D5C6` (`pais_id`),
  ADD KEY `IDX_9FAE54DCDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Catalogos_audit`
--
ALTER TABLE `Catalogos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `CatalogoTipo`
--
ALTER TABLE `CatalogoTipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1CBA6171DB38439E` (`usuario_id`);

--
-- Indices de la tabla `CatalogoTipo_audit`
--
ALTER TABLE `CatalogoTipo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Catalogo_audit`
--
ALTER TABLE `Catalogo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CCE1908EDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Categoria_audit`
--
ALTER TABLE `Categoria_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `CentroCostos`
--
ALTER TABLE `CentroCostos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7FF495A09F5A440B` (`estado_id`),
  ADD KEY `IDX_7FF495A0DE734E51` (`cliente_id`),
  ADD KEY `IDX_7FF495A0DB38439E` (`usuario_id`);

--
-- Indices de la tabla `CentroCostos_audit`
--
ALTER TABLE `CentroCostos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `CierreEstado`
--
ALTER TABLE `CierreEstado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_59E29F6CDB38439E` (`usuario_id`);

--
-- Indices de la tabla `CierreEstado_audit`
--
ALTER TABLE `CierreEstado_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Ciudad`
--
ALTER TABLE `Ciudad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_892A00A85A91C08D` (`departamento_id`),
  ADD KEY `IDX_892A00A8DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Ciudad_audit`
--
ALTER TABLE `Ciudad_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Cliente`
--
ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3BA1A2B92E595373` (`tipodocumento_id`),
  ADD KEY `IDX_3BA1A2B99F5A440B` (`estado_id`),
  ADD KEY `IDX_3BA1A2B9DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Cliente_audit`
--
ALTER TABLE `Cliente_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Contacto`
--
ALTER TABLE `Contacto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DE372B6ACB305D73` (`proveedor_id`),
  ADD KEY `IDX_DE372B6ADB38439E` (`usuario_id`);

--
-- Indices de la tabla `Contacto_audit`
--
ALTER TABLE `Contacto_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Convocatorias`
--
ALTER TABLE `Convocatorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E474E3909F5A440B` (`estado_id`),
  ADD KEY `IDX_E474E3901CB9D6E4` (`solicitud_id`),
  ADD KEY `IDX_E474E390DB38439E` (`usuario_id`);

--
-- Indices de la tabla `ConvocatoriasArchivos`
--
ALTER TABLE `ConvocatoriasArchivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B1D440564EE93BE6` (`convocatoria_id`),
  ADD KEY `IDX_B1D440569F5A440B` (`estado_id`),
  ADD KEY `IDX_B1D44056DB38439E` (`usuario_id`);

--
-- Indices de la tabla `ConvocatoriasArchivos_audit`
--
ALTER TABLE `ConvocatoriasArchivos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `ConvocatoriasEstado`
--
ALTER TABLE `ConvocatoriasEstado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1955002EDB38439E` (`usuario_id`);

--
-- Indices de la tabla `ConvocatoriasEstado_audit`
--
ALTER TABLE `ConvocatoriasEstado_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `ConvocatoriasHistorico`
--
ALTER TABLE `ConvocatoriasHistorico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5D637AD99F5A440B` (`estado_id`),
  ADD KEY `IDX_5D637AD94EE93BE6` (`convocatoria_id`),
  ADD KEY `IDX_5D637AD9DB38439E` (`usuario_id`);

--
-- Indices de la tabla `ConvocatoriasProveedores`
--
ALTER TABLE `ConvocatoriasProveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AFC4D9424EE93BE6` (`convocatoria_id`),
  ADD KEY `IDX_AFC4D942CB305D73` (`proveedor_id`),
  ADD KEY `IDX_AFC4D942DB38439E` (`usuario_id`);

--
-- Indices de la tabla `ConvocatoriasProveedores_audit`
--
ALTER TABLE `ConvocatoriasProveedores_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Convocatorias_audit`
--
ALTER TABLE `Convocatorias_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `CostosLogistica`
--
ALTER TABLE `CostosLogistica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_11F785B4F747F090` (`planilla_id`),
  ADD KEY `IDX_11F785B46E3C888` (`facturaLogistica_id`),
  ADD KEY `IDX_11F785B4DB38439E` (`usuario_id`);

--
-- Indices de la tabla `CostosLogistica_audit`
--
ALTER TABLE `CostosLogistica_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Cotizacion`
--
ALTER TABLE `Cotizacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BF8EFD36E3C888` (`facturaLogistica_id`),
  ADD KEY `IDX_BF8EFD39F5A440B` (`estado_id`),
  ADD KEY `IDX_BF8EFD31CB9D6E4` (`solicitud_id`),
  ADD KEY `IDX_BF8EFD3DB38439E` (`usuario_id`);

--
-- Indices de la tabla `CotizacionesEstado`
--
ALTER TABLE `CotizacionesEstado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_43F1F312DB38439E` (`usuario_id`);

--
-- Indices de la tabla `CotizacionesEstado_audit`
--
ALTER TABLE `CotizacionesEstado_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `CotizacionProducto`
--
ALTER TABLE `CotizacionProducto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ADA669277645698E` (`producto_id`),
  ADD KEY `IDX_ADA66927307090AA` (`cotizacion_id`),
  ADD KEY `IDX_ADA669279F5A440B` (`estado_id`),
  ADD KEY `IDX_ADA669277A8BC25A` (`facturaProducto_id`),
  ADD KEY `IDX_ADA66927DB38439E` (`usuario_id`);

--
-- Indices de la tabla `CotizacionProducto_audit`
--
ALTER TABLE `CotizacionProducto_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Cotizacion_audit`
--
ALTER TABLE `Cotizacion_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Courier`
--
ALTER TABLE `Courier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AE75E02E595373` (`tipodocumento_id`),
  ADD KEY `IDX_AE75E0DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Courier_audit`
--
ALTER TABLE `Courier_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Departamento`
--
ALTER TABLE `Departamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_58D54C13C604D5C6` (`pais_id`),
  ADD KEY `IDX_58D54C13DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Departamento_audit`
--
ALTER TABLE `Departamento_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `DespachoGuia`
--
ALTER TABLE `DespachoGuia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7475D3D299C08BC` (`despacho_id`),
  ADD KEY `IDX_7475D3D62AA81F` (`guia_id`),
  ADD KEY `IDX_7475D3DDB38439E` (`usuario_id`),
  ADD KEY `IDX_7475D3D1794DC32` (`cierreEstado_id`);

--
-- Indices de la tabla `DespachoGuia_audit`
--
ALTER TABLE `DespachoGuia_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `DespachoOrdenes`
--
ALTER TABLE `DespachoOrdenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FE882C8B1CB9D6E4` (`solicitud_id`),
  ADD KEY `IDX_FE882C8B9F5A440B` (`estado_id`),
  ADD KEY `IDX_FE882C8BDB38439E` (`usuario_id`);

--
-- Indices de la tabla `DespachoOrdenes_audit`
--
ALTER TABLE `DespachoOrdenes_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Despachos`
--
ALTER TABLE `Despachos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CBB2E46BE8608214` (`ciudad_id`),
  ADD KEY `IDX_CBB2E46B7645698E` (`producto_id`),
  ADD KEY `IDX_CBB2E46B55804572` (`redencion_id`),
  ADD KEY `IDX_CBB2E46B1CB9D6E4` (`solicitud_id`),
  ADD KEY `IDX_CBB2E46BF747F090` (`planilla_id`),
  ADD KEY `IDX_CBB2E46BF01FA5EC` (`ordendespacho_id`),
  ADD KEY `IDX_CBB2E46BAFC6C4DE` (`ordenproducto_id`),
  ADD KEY `IDX_CBB2E46BDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Despachos_audit`
--
ALTER TABLE `Despachos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `EstadoAprobacion`
--
ALTER TABLE `EstadoAprobacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B2A7BC13DB38439E` (`usuario_id`);

--
-- Indices de la tabla `EstadoAprobacion_audit`
--
ALTER TABLE `EstadoAprobacion_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `EstadoCatalogo`
--
ALTER TABLE `EstadoCatalogo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_85A73F67DB38439E` (`usuario_id`);

--
-- Indices de la tabla `EstadoCatalogo_audit`
--
ALTER TABLE `EstadoCatalogo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Estados`
--
ALTER TABLE `Estados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ED9618B4DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Estados_audit`
--
ALTER TABLE `Estados_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Excel`
--
ALTER TABLE `Excel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EEA56FBFDB38439E` (`usuario_id`);

--
-- Indices de la tabla `ExcelProveedor`
--
ALTER TABLE `ExcelProveedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_33FAD10DDB38439E` (`usuario_id`);

--
-- Indices de la tabla `ExcelProveedor_audit`
--
ALTER TABLE `ExcelProveedor_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Excel_audit`
--
ALTER TABLE `Excel_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Factura`
--
ALTER TABLE `Factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_36569995FD8A7328` (`programa_id`),
  ADD KEY `IDX_36569995C604D5C6` (`pais_id`),
  ADD KEY `IDX_365699959C3921AB` (`periodo_id`),
  ADD KEY `IDX_36569995DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Facturacostos`
--
ALTER TABLE `Facturacostos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7AE6AF16DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Facturacostos_audit`
--
ALTER TABLE `Facturacostos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `FacturaDetalle`
--
ALTER TABLE `FacturaDetalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AA0EC6AAF04F795F` (`factura_id`),
  ADD KEY `IDX_AA0EC6AAA9276E6C` (`tipo_id`),
  ADD KEY `IDX_AA0EC6AABD0F409C` (`area_id`),
  ADD KEY `IDX_AA0EC6AA55804572` (`redencion_id`),
  ADD KEY `IDX_AA0EC6AADB38439E` (`usuario_id`);

--
-- Indices de la tabla `FacturaDetalle_audit`
--
ALTER TABLE `FacturaDetalle_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Facturaestado`
--
ALTER TABLE `Facturaestado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7960EA2EDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Facturaestado_audit`
--
ALTER TABLE `Facturaestado_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `FacturaLogistica`
--
ALTER TABLE `FacturaLogistica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FD29DE14F04F795F` (`factura_id`),
  ADD KEY `IDX_FD29DE14DB38439E` (`usuario_id`);

--
-- Indices de la tabla `FacturaLogistica_audit`
--
ALTER TABLE `FacturaLogistica_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `FacturaProductos`
--
ALTER TABLE `FacturaProductos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D66E82D37645698E` (`producto_id`),
  ADD KEY `IDX_D66E82D3F04F795F` (`factura_id`),
  ADD KEY `IDX_D66E82D3DB38439E` (`usuario_id`);

--
-- Indices de la tabla `FacturaProductos_audit`
--
ALTER TABLE `FacturaProductos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Factura_audit`
--
ALTER TABLE `Factura_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Grupo`
--
ALTER TABLE `Grupo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4DCFB4D757698A6A` (`role`),
  ADD KEY `IDX_4DCFB4D7DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Grupo_audit`
--
ALTER TABLE `Grupo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `GuiaEnvio`
--
ALTER TABLE `GuiaEnvio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1768DF91295A4B09` (`ordenProducto_id`),
  ADD KEY `IDX_1768DF91E3D8151C` (`courier_id`),
  ADD KEY `IDX_1768DF916E3C888` (`facturaLogistica_id`),
  ADD KEY `IDX_1768DF91DFDFBE2A` (`inventario_id`),
  ADD KEY `IDX_1768DF913ED062CC` (`redencionenvio_id`),
  ADD KEY `IDX_1768DF91DB38439E` (`usuario_id`);

--
-- Indices de la tabla `GuiaEnvio_audit`
--
ALTER TABLE `GuiaEnvio_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Idiomas`
--
ALTER TABLE `Idiomas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DD1872E2DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Imagenproducto`
--
ALTER TABLE `Imagenproducto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DC6524F47645698E` (`producto_id`),
  ADD KEY `IDX_DC6524F4DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Imagenproducto_audit`
--
ALTER TABLE `Imagenproducto_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Intervalos`
--
ALTER TABLE `Intervalos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3D56AE6B155AC4BC` (`catalogos_id`),
  ADD KEY `IDX_3D56AE6BDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Intervalos_audit`
--
ALTER TABLE `Intervalos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Inventario`
--
ALTER TABLE `Inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_25444D257645698E` (`producto_id`),
  ADD KEY `IDX_25444D254EE93BE6` (`convocatoria_id`),
  ADD KEY `IDX_25444D2555804572` (`redencion_id`),
  ADD KEY `IDX_25444D251CB9D6E4` (`solicitud_id`),
  ADD KEY `IDX_25444D25F747F090` (`planilla_id`),
  ADD KEY `IDX_25444D259750851F` (`orden_id`),
  ADD KEY `IDX_25444D25AFC6C4DE` (`ordenproducto_id`),
  ADD KEY `IDX_25444D25299C08BC` (`despacho_id`),
  ADD KEY `IDX_25444D2595BC4699` (`envio_id`),
  ADD KEY `IDX_25444D25DB38439E` (`usuario_id`);

--
-- Indices de la tabla `InventarioGuia`
--
ALTER TABLE `InventarioGuia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CB888BDADFDFBE2A` (`inventario_id`),
  ADD KEY `IDX_CB888BDA62AA81F` (`guia_id`),
  ADD KEY `IDX_CB888BDADB38439E` (`usuario_id`),
  ADD KEY `IDX_CB888BDA1794DC32` (`cierreEstado_id`);

--
-- Indices de la tabla `InventarioGuia_audit`
--
ALTER TABLE `InventarioGuia_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `InventarioHistorico`
--
ALTER TABLE `InventarioHistorico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_928062F67645698E` (`producto_id`),
  ADD KEY `IDX_928062F64EE93BE6` (`convocatoria_id`),
  ADD KEY `IDX_928062F655804572` (`redencion_id`),
  ADD KEY `IDX_928062F61CB9D6E4` (`solicitud_id`),
  ADD KEY `IDX_928062F6F747F090` (`planilla_id`),
  ADD KEY `IDX_928062F69750851F` (`orden_id`),
  ADD KEY `IDX_928062F6AFC6C4DE` (`ordenproducto_id`),
  ADD KEY `IDX_928062F6DFDFBE2A` (`inventario_id`),
  ADD KEY `IDX_928062F6DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Inventario_audit`
--
ALTER TABLE `Inventario_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Justificacion`
--
ALTER TABLE `Justificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_588F7172DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Justificacion_audit`
--
ALTER TABLE `Justificacion_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Menu`
--
ALTER TABLE `Menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DD3795AD613CEC58` (`padre_id`),
  ADD KEY `IDX_DD3795ADDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Menu_audit`
--
ALTER TABLE `Menu_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `menu_grupo`
--
ALTER TABLE `menu_grupo`
  ADD PRIMARY KEY (`menu_id`,`grupo_id`),
  ADD KEY `IDX_1DA2B8B4CCD7E912` (`menu_id`),
  ADD KEY `IDX_1DA2B8B49C833003` (`grupo_id`);

--
-- Indices de la tabla `MonedaTipo`
--
ALTER TABLE `MonedaTipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D197050CDB38439E` (`usuario_id`);

--
-- Indices de la tabla `MonedaTipo_audit`
--
ALTER TABLE `MonedaTipo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Novedades`
--
ALTER TABLE `Novedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5F6398A755804572` (`redencion_id`),
  ADD KEY `IDX_5F6398A79F5A440B` (`estado_id`),
  ADD KEY `IDX_5F6398A7A9276E6C` (`tipo_id`),
  ADD KEY `IDX_5F6398A75DCDADC` (`devolucionTipo_id`),
  ADD KEY `IDX_5F6398A73F4B5275` (`accion_id`),
  ADD KEY `IDX_5F6398A7DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Novedadesaccion`
--
ALTER TABLE `Novedadesaccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_211E9F53DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Novedadesaccion_audit`
--
ALTER TABLE `Novedadesaccion_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `NovedadesDevolucionTipo`
--
ALTER TABLE `NovedadesDevolucionTipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5C490106DB38439E` (`usuario_id`);

--
-- Indices de la tabla `NovedadesDevolucionTipo_audit`
--
ALTER TABLE `NovedadesDevolucionTipo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Novedadesestado`
--
ALTER TABLE `Novedadesestado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8D419D04DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Novedadesestado_audit`
--
ALTER TABLE `Novedadesestado_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Novedadestipo`
--
ALTER TABLE `Novedadestipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E695A1B2DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Novedadestipo_audit`
--
ALTER TABLE `Novedadestipo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Novedades_audit`
--
ALTER TABLE `Novedades_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `OrdenesCompra`
--
ALTER TABLE `OrdenesCompra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_73BE9CCCCB305D73` (`proveedor_id`),
  ADD KEY `IDX_73BE9CCCFD8A7328` (`programa_id`),
  ADD KEY `IDX_73BE9CCC1CB9D6E4` (`solicitud_id`),
  ADD KEY `IDX_73BE9CCCDB7E080F` (`ordenesTipo_id`),
  ADD KEY `IDX_73BE9CCCCF3985D2` (`monedaTipo_id`),
  ADD KEY `IDX_73BE9CCC755BCA5B` (`ordenesEstado_id`),
  ADD KEY `IDX_73BE9CCCC604D5C6` (`pais_id`),
  ADD KEY `IDX_73BE9CCC3397707A` (`categoria_id`),
  ADD KEY `IDX_73BE9CCC9AA3B30E` (`aprobo_id`),
  ADD KEY `IDX_73BE9CCC62F40C3D` (`creador_id`),
  ADD KEY `IDX_73BE9CCCDB38439E` (`usuario_id`);

--
-- Indices de la tabla `OrdenesCompraHistorico`
--
ALTER TABLE `OrdenesCompraHistorico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D47BADB9CB305D73` (`proveedor_id`),
  ADD KEY `IDX_D47BADB9DB7E080F` (`ordenesTipo_id`),
  ADD KEY `IDX_D47BADB9755BCA5B` (`ordenesEstado_id`),
  ADD KEY `IDX_D47BADB94DC260` (`ordencompra_id`),
  ADD KEY `IDX_D47BADB9DB38439E` (`usuario_id`);

--
-- Indices de la tabla `OrdenesCompra_audit`
--
ALTER TABLE `OrdenesCompra_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `OrdenesEstado`
--
ALTER TABLE `OrdenesEstado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CB224CD0DB38439E` (`usuario_id`);

--
-- Indices de la tabla `OrdenesEstado_audit`
--
ALTER TABLE `OrdenesEstado_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `OrdenesProducto`
--
ALTER TABLE `OrdenesProducto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FBB7510F7645698E` (`producto_id`),
  ADD KEY `IDX_FBB7510F18E68A87` (`ordenesCompra_id`),
  ADD KEY `IDX_FBB7510FFD8A7328` (`programa_id`),
  ADD KEY `IDX_FBB7510FF2358319` (`productoCotizacion_id`),
  ADD KEY `IDX_FBB7510F9F5A440B` (`estado_id`),
  ADD KEY `IDX_FBB7510F7A8BC25A` (`facturaProducto_id`),
  ADD KEY `IDX_FBB7510FDB38439E` (`usuario_id`);

--
-- Indices de la tabla `OrdenesProductoHistorico`
--
ALTER TABLE `OrdenesProductoHistorico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D3E913B47645698E` (`producto_id`),
  ADD KEY `IDX_D3E913B418E68A87` (`ordenesCompra_id`),
  ADD KEY `IDX_D3E913B44DC260` (`ordencompra_id`),
  ADD KEY `IDX_D3E913B4DB38439E` (`usuario_id`);

--
-- Indices de la tabla `OrdenesProducto_audit`
--
ALTER TABLE `OrdenesProducto_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `OrdenesTipo`
--
ALTER TABLE `OrdenesTipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8996293CDB38439E` (`usuario_id`);

--
-- Indices de la tabla `OrdenesTipo_audit`
--
ALTER TABLE `OrdenesTipo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Pais`
--
ALTER TABLE `Pais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DE6F81C1DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Pais_audit`
--
ALTER TABLE `Pais_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Participantes`
--
ALTER TABLE `Participantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AA98AA312E595373` (`tipodocumento_id`),
  ADD KEY `IDX_AA98AA31FD8A7328` (`programa_id`),
  ADD KEY `IDX_AA98AA31238999DE` (`participanteestado_id`),
  ADD KEY `IDX_AA98AA31E8608214` (`ciudad_id`),
  ADD KEY `IDX_AA98AA31DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Participantesestado`
--
ALTER TABLE `Participantesestado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7FF7A321DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Participantesestado_audit`
--
ALTER TABLE `Participantesestado_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Participantes_audit`
--
ALTER TABLE `Participantes_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Periodos`
--
ALTER TABLE `Periodos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3CB0255CDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Periodos_audit`
--
ALTER TABLE `Periodos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Planilla`
--
ALTER TABLE `Planilla`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6DA6E045B4CC6DAB` (`planillaEstado_id`),
  ADD KEY `IDX_6DA6E045FD8A7328` (`programa_id`),
  ADD KEY `IDX_6DA6E045A9276E6C` (`tipo_id`),
  ADD KEY `IDX_6DA6E045C604D5C6` (`pais_id`),
  ADD KEY `IDX_6DA6E0453397707A` (`categoria_id`),
  ADD KEY `IDX_6DA6E045DB38439E` (`usuario_id`),
  ADD KEY `IDX_6DA6E0451CB9D6E4` (`solicitud_id`);

--
-- Indices de la tabla `PlanillaEstado`
--
ALTER TABLE `PlanillaEstado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7EBFA67FDB38439E` (`usuario_id`);

--
-- Indices de la tabla `PlanillaEstado_audit`
--
ALTER TABLE `PlanillaEstado_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `PlanillaTipo`
--
ALTER TABLE `PlanillaTipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1E69CC5CDB38439E` (`usuario_id`);

--
-- Indices de la tabla `PlanillaTipo_audit`
--
ALTER TABLE `PlanillaTipo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Planilla_audit`
--
ALTER TABLE `Planilla_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Preciohistorico`
--
ALTER TABLE `Preciohistorico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7E8D910C7645698E` (`producto_id`),
  ADD KEY `IDX_7E8D910CCB305D73` (`proveedor_id`),
  ADD KEY `IDX_7E8D910CDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Premios`
--
ALTER TABLE `Premios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CA2EAA1155AC4BC` (`catalogos_id`),
  ADD KEY `IDX_CA2EAA13397707A` (`categoria_id`),
  ADD KEY `IDX_CA2EAA19F5A440B` (`estado_id`),
  ADD KEY `IDX_CA2EAA15E677940` (`estadoAprobacion_id`),
  ADD KEY `IDX_CA2EAA13DA55B37` (`aproboOperaciones_id`),
  ADD KEY `IDX_CA2EAA1CD8E1E42` (`operaciones_id`),
  ADD KEY `IDX_CA2EAA18038F3D2` (`aproboComercial_id`),
  ADD KEY `IDX_CA2EAA1E2AAC521` (`comercial_id`),
  ADD KEY `IDX_CA2EAA1C6B49F3A` (`aproboDirector_id`),
  ADD KEY `IDX_CA2EAA1899FB366` (`director_id`),
  ADD KEY `IDX_CA2EAA12AAD40F2` (`aproboCliente_id`),
  ADD KEY `IDX_CA2EAA1DE734E51` (`cliente_id`),
  ADD KEY `IDX_CA2EAA1DB38439E` (`usuario_id`);

--
-- Indices de la tabla `PremiosProductos`
--
ALTER TABLE `PremiosProductos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B2BCBF7FFB5CD01B` (`premio_id`),
  ADD KEY `IDX_B2BCBF7F7645698E` (`producto_id`),
  ADD KEY `IDX_B2BCBF7FDB38439E` (`usuario_id`);

--
-- Indices de la tabla `PremiosProductos_audit`
--
ALTER TABLE `PremiosProductos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Premios_audit`
--
ALTER TABLE `Premios_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Presupuestos`
--
ALTER TABLE `Presupuestos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1CFEF4F5FD8A7328` (`programa_id`),
  ADD KEY `IDX_1CFEF4F5BD0F409C` (`area_id`),
  ADD KEY `IDX_1CFEF4F5A9276E6C` (`tipo_id`),
  ADD KEY `IDX_1CFEF4F5DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Presupuestoshistorico`
--
ALTER TABLE `Presupuestoshistorico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6ABF2A6BFD8A7328` (`programa_id`),
  ADD KEY `IDX_6ABF2A6BBD0F409C` (`area_id`),
  ADD KEY `IDX_6ABF2A6BA9276E6C` (`tipo_id`),
  ADD KEY `IDX_6ABF2A6B90119F0F` (`presupuesto_id`),
  ADD KEY `IDX_6ABF2A6BDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Presupuestos_audit`
--
ALTER TABLE `Presupuestos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Prioridad`
--
ALTER TABLE `Prioridad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2179E0F1DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Prioridad_audit`
--
ALTER TABLE `Prioridad_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Producto`
--
ALTER TABLE `Producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5ECD64433397707A` (`categoria_id`),
  ADD KEY `IDX_5ECD64439F5A440B` (`estado_id`),
  ADD KEY `IDX_5ECD6443A9276E6C` (`tipo_id`),
  ADD KEY `IDX_5ECD644378ECAC4A` (`clasificacion_id`),
  ADD KEY `IDX_5ECD6443DB38439E` (`usuario_id`);

--
-- Indices de la tabla `ProductoCalificacion`
--
ALTER TABLE `ProductoCalificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_22AB6AF7645698E` (`producto_id`),
  ADD KEY `IDX_22AB6AF4979D753` (`catalogo_id`),
  ADD KEY `IDX_22AB6AFDB38439E` (`usuario_id`);

--
-- Indices de la tabla `ProductoCalificacion_audit`
--
ALTER TABLE `ProductoCalificacion_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Productocatalogo`
--
ALTER TABLE `Productocatalogo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1512BA7D7645698E` (`producto_id`),
  ADD KEY `IDX_1512BA7D155AC4BC` (`catalogos_id`),
  ADD KEY `IDX_1512BA7D3397707A` (`categoria_id`),
  ADD KEY `IDX_1512BA7D9F5A440B` (`estado_id`),
  ADD KEY `IDX_1512BA7D5E677940` (`estadoAprobacion_id`),
  ADD KEY `IDX_1512BA7D3DA55B37` (`aproboOperaciones_id`),
  ADD KEY `IDX_1512BA7DCD8E1E42` (`operaciones_id`),
  ADD KEY `IDX_1512BA7D8038F3D2` (`aproboComercial_id`),
  ADD KEY `IDX_1512BA7DE2AAC521` (`comercial_id`),
  ADD KEY `IDX_1512BA7DC6B49F3A` (`aproboDirector_id`),
  ADD KEY `IDX_1512BA7D899FB366` (`director_id`),
  ADD KEY `IDX_1512BA7D2AAD40F2` (`aproboCliente_id`),
  ADD KEY `IDX_1512BA7DDE734E51` (`cliente_id`),
  ADD KEY `IDX_1512BA7DDB38439E` (`usuario_id`);

--
-- Indices de la tabla `ProductocatalogoHistorico`
--
ALTER TABLE `ProductocatalogoHistorico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EADB47EB7645698E` (`producto_id`),
  ADD KEY `IDX_EADB47EB155AC4BC` (`catalogos_id`),
  ADD KEY `IDX_EADB47EB3397707A` (`categoria_id`),
  ADD KEY `IDX_EADB47EBF17F7F48` (`productocatalogo_id`),
  ADD KEY `IDX_EADB47EB9F5A440B` (`estado_id`),
  ADD KEY `IDX_EADB47EB3DA55B37` (`aproboOperaciones_id`),
  ADD KEY `IDX_EADB47EBCD8E1E42` (`operaciones_id`),
  ADD KEY `IDX_EADB47EB8038F3D2` (`aproboComercial_id`),
  ADD KEY `IDX_EADB47EBE2AAC521` (`comercial_id`),
  ADD KEY `IDX_EADB47EBC6B49F3A` (`aproboDirector_id`),
  ADD KEY `IDX_EADB47EB899FB366` (`director_id`),
  ADD KEY `IDX_EADB47EB2AAD40F2` (`aproboCliente_id`),
  ADD KEY `IDX_EADB47EBDE734E51` (`cliente_id`),
  ADD KEY `IDX_EADB47EBDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Productocatalogo_audit`
--
ALTER TABLE `Productocatalogo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Productoclasificacion`
--
ALTER TABLE `Productoclasificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F60FCEFDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Productoclasificacion_audit`
--
ALTER TABLE `Productoclasificacion_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `ProductoIdiomas`
--
ALTER TABLE `ProductoIdiomas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1C904B17645698E` (`producto_id`),
  ADD KEY `IDX_1C904B1DEDC0611` (`idioma_id`),
  ADD KEY `IDX_1C904B1DB38439E` (`usuario_id`);

--
-- Indices de la tabla `ProductoIdiomas_audit`
--
ALTER TABLE `ProductoIdiomas_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Productoprecio`
--
ALTER TABLE `Productoprecio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_11D25D8C7645698E` (`producto_id`),
  ADD KEY `IDX_11D25D8CCB305D73` (`proveedor_id`),
  ADD KEY `IDX_11D25D8C9F5A440B` (`estado_id`),
  ADD KEY `IDX_11D25D8CDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Productoprecio_audit`
--
ALTER TABLE `Productoprecio_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `ProductoTipo`
--
ALTER TABLE `ProductoTipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E4E7F3A6DB38439E` (`usuario_id`);

--
-- Indices de la tabla `ProductoTipo_audit`
--
ALTER TABLE `ProductoTipo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Producto_audit`
--
ALTER TABLE `Producto_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Programa`
--
ALTER TABLE `Programa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FB86765B9F5A440B` (`estado_id`),
  ADD KEY `IDX_FB86765BDE734E51` (`cliente_id`),
  ADD KEY `IDX_FB86765B811AEEEB` (`centroCostos_id`),
  ADD KEY `IDX_FB86765BDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Programa_audit`
--
ALTER TABLE `Programa_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Promociones`
--
ALTER TABLE `Promociones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BE8728ADFB5CD01B` (`premio_id`),
  ADD KEY `IDX_BE8728AD9F5A440B` (`estado_id`),
  ADD KEY `IDX_BE8728ADDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Promociones_audit`
--
ALTER TABLE `Promociones_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Proveedores`
--
ALTER TABLE `Proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D327262E595373` (`tipodocumento_id`),
  ADD KEY `IDX_D327263397707A` (`categoria_id`),
  ADD KEY `IDX_D32726C604D5C6` (`pais_id`),
  ADD KEY `IDX_D327265A91C08D` (`departamento_id`),
  ADD KEY `IDX_D32726E8608214` (`ciudad_id`),
  ADD KEY `IDX_D3272664832107` (`regimen_id`),
  ADD KEY `IDX_D327269F5A440B` (`estado_id`),
  ADD KEY `IDX_D32726BD0F409C` (`area_id`),
  ADD KEY `IDX_D32726A9276E6C` (`tipo_id`),
  ADD KEY `IDX_D3272678ECAC4A` (`clasificacion_id`),
  ADD KEY `IDX_D32726DB38439E` (`usuario_id`);

--
-- Indices de la tabla `ProveedoresArea`
--
ALTER TABLE `ProveedoresArea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_65E8A40DDB38439E` (`usuario_id`);

--
-- Indices de la tabla `ProveedoresArea_audit`
--
ALTER TABLE `ProveedoresArea_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `ProveedoresCalificacion`
--
ALTER TABLE `ProveedoresCalificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7E86F9E6CB305D73` (`proveedor_id`),
  ADD KEY `IDX_7E86F9E6DB38439E` (`usuario_id`);

--
-- Indices de la tabla `ProveedoresCalificacion_audit`
--
ALTER TABLE `ProveedoresCalificacion_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `ProveedoresClasificacion`
--
ALTER TABLE `ProveedoresClasificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B362E261DB38439E` (`usuario_id`);

--
-- Indices de la tabla `ProveedoresClasificacion_audit`
--
ALTER TABLE `ProveedoresClasificacion_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `ProveedoresHistorico`
--
ALTER TABLE `ProveedoresHistorico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_97283E772E595373` (`tipodocumento_id`),
  ADD KEY `IDX_97283E773397707A` (`categoria_id`),
  ADD KEY `IDX_97283E77C604D5C6` (`pais_id`),
  ADD KEY `IDX_97283E775A91C08D` (`departamento_id`),
  ADD KEY `IDX_97283E77E8608214` (`ciudad_id`),
  ADD KEY `IDX_97283E7764832107` (`regimen_id`),
  ADD KEY `IDX_97283E77A9276E6C` (`tipo_id`),
  ADD KEY `IDX_97283E77CB305D73` (`proveedor_id`),
  ADD KEY `IDX_97283E77DB38439E` (`usuario_id`);

--
-- Indices de la tabla `ProveedoresTipo`
--
ALTER TABLE `ProveedoresTipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C2518422DB38439E` (`usuario_id`);

--
-- Indices de la tabla `ProveedoresTipo_audit`
--
ALTER TABLE `ProveedoresTipo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Proveedores_audit`
--
ALTER TABLE `Proveedores_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Redenciones`
--
ALTER TABLE `Redenciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D45E8521F6F50196` (`participante_id`),
  ADD KEY `IDX_D45E8521FB5CD01B` (`premio_id`),
  ADD KEY `IDX_D45E8521B1E453D4` (`promocion_id`),
  ADD KEY `IDX_D45E852184F08D54` (`redencionestado_id`),
  ADD KEY `IDX_D45E8521C6FE70FC` (`ordenesProducto_id`),
  ADD KEY `IDX_D45E85217A8BC25A` (`facturaProducto_id`),
  ADD KEY `IDX_D45E8521DB38439E` (`usuario_id`),
  ADD KEY `IDX_D45E85216D28D42D` (`justificacion_id`);

--
-- Indices de la tabla `Redencionesatributos`
--
ALTER TABLE `Redencionesatributos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6291B3DFC3604172` (`atributos_id`),
  ADD KEY `IDX_6291B3DF55804572` (`redencion_id`),
  ADD KEY `IDX_6291B3DFDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Redencionesatributos_audit`
--
ALTER TABLE `Redencionesatributos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Redencionesenvios`
--
ALTER TABLE `Redencionesenvios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F966A26BE8608214` (`ciudad_id`),
  ADD KEY `IDX_F966A26B55804572` (`redencion_id`),
  ADD KEY `IDX_F966A26BDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Redencionesenvios_audit`
--
ALTER TABLE `Redencionesenvios_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Redencionesestado`
--
ALTER TABLE `Redencionesestado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_32F9EDEFDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Redencionesestado_audit`
--
ALTER TABLE `Redencionesestado_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `RedencionesHistorico`
--
ALTER TABLE `RedencionesHistorico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7B4F664455804572` (`redencion_id`),
  ADD KEY `IDX_7B4F6644F6F50196` (`participante_id`),
  ADD KEY `IDX_7B4F6644F17F7F48` (`productocatalogo_id`),
  ADD KEY `IDX_7B4F664484F08D54` (`redencionestado_id`),
  ADD KEY `IDX_7B4F6644C6FE70FC` (`ordenesProducto_id`),
  ADD KEY `IDX_7B4F66447A8BC25A` (`facturaProducto_id`),
  ADD KEY `IDX_7B4F6644DB38439E` (`usuario_id`);

--
-- Indices de la tabla `RedencionesProductos`
--
ALTER TABLE `RedencionesProductos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8091C3C855804572` (`redencion_id`),
  ADD KEY `IDX_8091C3C87645698E` (`producto_id`),
  ADD KEY `IDX_8091C3C89F5A440B` (`estado_id`),
  ADD KEY `IDX_8091C3C8C6FE70FC` (`ordenesProducto_id`),
  ADD KEY `IDX_8091C3C87A8BC25A` (`facturaProducto_id`),
  ADD KEY `IDX_8091C3C8DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Redenciones_audit`
--
ALTER TABLE `Redenciones_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Regimen`
--
ALTER TABLE `Regimen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EEAC2113DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Regimen_audit`
--
ALTER TABLE `Regimen_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Requisicion`
--
ALTER TABLE `Requisicion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5EB3A24F1CB9D6E4` (`solicitud_id`),
  ADD KEY `IDX_5EB3A24FDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Requisicionesenvios`
--
ALTER TABLE `Requisicionesenvios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_475DB6B3E8608214` (`ciudad_id`),
  ADD KEY `IDX_475DB6B3DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Requisicionesenvios_audit`
--
ALTER TABLE `Requisicionesenvios_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `RequisicionProducto`
--
ALTER TABLE `RequisicionProducto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_653966347645698E` (`producto_id`),
  ADD KEY `IDX_653966341EBA4B16` (`requisicion_id`),
  ADD KEY `IDX_653966347A8BC25A` (`facturaProducto_id`),
  ADD KEY `IDX_65396634DB38439E` (`usuario_id`);

--
-- Indices de la tabla `RequisicionProducto_audit`
--
ALTER TABLE `RequisicionProducto_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Requisicion_audit`
--
ALTER TABLE `Requisicion_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `revisions`
--
ALTER TABLE `revisions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Servicios`
--
ALTER TABLE `Servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_428F028CDB38439E` (`usuario_id`);

--
-- Indices de la tabla `ServiciosLog`
--
ALTER TABLE `ServiciosLog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_106C30B071CAA3E7` (`servicio_id`),
  ADD KEY `IDX_106C30B0DB38439E` (`usuario_id`);

--
-- Indices de la tabla `ServiciosLog_audit`
--
ALTER TABLE `ServiciosLog_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Servicios_audit`
--
ALTER TABLE `Servicios_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Solicitud`
--
ALTER TABLE `Solicitud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1423FE63A9276E6C` (`tipo_id`),
  ADD KEY `IDX_1423FE63BDD13D7A` (`prioridad_id`),
  ADD KEY `IDX_1423FE63FD8A7328` (`programa_id`),
  ADD KEY `IDX_1423FE639F5A440B` (`estado_id`),
  ADD KEY `IDX_1423FE63C680A87` (`solicitante_id`),
  ADD KEY `IDX_1423FE63811AEEEB` (`centroCostos_id`),
  ADD KEY `IDX_1423FE63DB38439E` (`usuario_id`);

--
-- Indices de la tabla `SolicitudesArchivos`
--
ALTER TABLE `SolicitudesArchivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_193F9BCD1CB9D6E4` (`solicitud_id`),
  ADD KEY `IDX_193F9BCD9F5A440B` (`estado_id`),
  ADD KEY `IDX_193F9BCDDB38439E` (`usuario_id`);

--
-- Indices de la tabla `SolicitudesArchivos_audit`
--
ALTER TABLE `SolicitudesArchivos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `SolicitudesAsignar`
--
ALTER TABLE `SolicitudesAsignar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E682E95B1CB9D6E4` (`solicitud_id`),
  ADD KEY `IDX_E682E95B53C59D72` (`responsable_id`),
  ADD KEY `IDX_E682E95B9F5A440B` (`estado_id`),
  ADD KEY `IDX_E682E95BDB38439E` (`usuario_id`);

--
-- Indices de la tabla `SolicitudesAsignar_audit`
--
ALTER TABLE `SolicitudesAsignar_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `SolicitudesEstado`
--
ALTER TABLE `SolicitudesEstado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CEE75E70DB38439E` (`usuario_id`);

--
-- Indices de la tabla `SolicitudesEstado_audit`
--
ALTER TABLE `SolicitudesEstado_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `SolicitudesObservaciones`
--
ALTER TABLE `SolicitudesObservaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BDF3161D1CB9D6E4` (`solicitud_id`),
  ADD KEY `IDX_BDF3161DDB38439E` (`usuario_id`);

--
-- Indices de la tabla `SolicitudesObservaciones_audit`
--
ALTER TABLE `SolicitudesObservaciones_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `SolicitudTipo`
--
ALTER TABLE `SolicitudTipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E2A51752DB38439E` (`usuario_id`);

--
-- Indices de la tabla `SolicitudTipo_audit`
--
ALTER TABLE `SolicitudTipo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Solicitud_audit`
--
ALTER TABLE `Solicitud_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Tipoarchivo`
--
ALTER TABLE `Tipoarchivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DF3F2ACEDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Tipoarchivo_audit`
--
ALTER TABLE `Tipoarchivo_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Tipocostos`
--
ALTER TABLE `Tipocostos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E602D15FDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Tipocostos_audit`
--
ALTER TABLE `Tipocostos_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Tipodocumento`
--
ALTER TABLE `Tipodocumento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FDCA7A9BDB38439E` (`usuario_id`);

--
-- Indices de la tabla `Tipodocumento_audit`
--
ALTER TABLE `Tipodocumento_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Tracking`
--
ALTER TABLE `Tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_510A004AAFC6C4DE` (`ordenproducto_id`),
  ADD KEY `IDX_510A004ADB38439E` (`usuario_id`);

--
-- Indices de la tabla `Tracking_audit`
--
ALTER TABLE `Tracking_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F780E5A4F85E0677` (`username`),
  ADD KEY `IDX_F780E5A4CB305D73` (`proveedor_id`),
  ADD KEY `IDX_F780E5A4DE734E51` (`cliente_id`),
  ADD KEY `IDX_F780E5A4DB38439E` (`usuario_id`);

--
-- Indices de la tabla `Usuarios_audit`
--
ALTER TABLE `Usuarios_audit`
  ADD PRIMARY KEY (`id`,`rev`);

--
-- Indices de la tabla `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  ADD PRIMARY KEY (`usuario_id`,`grupo_id`),
  ADD KEY `IDX_91D0F1CDDB38439E` (`usuario_id`),
  ADD KEY `IDX_91D0F1CD9C833003` (`grupo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Aeconomica`
--
ALTER TABLE `Aeconomica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `Archivos`
--
ALTER TABLE `Archivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Areas`
--
ALTER TABLE `Areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `Atributosproducto`
--
ALTER TABLE `Atributosproducto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Atributostipo`
--
ALTER TABLE `Atributostipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `Catalogo`
--
ALTER TABLE `Catalogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `Catalogos`
--
ALTER TABLE `Catalogos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `CatalogoTipo`
--
ALTER TABLE `CatalogoTipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `CentroCostos`
--
ALTER TABLE `CentroCostos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `CierreEstado`
--
ALTER TABLE `CierreEstado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `Ciudad`
--
ALTER TABLE `Ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Cliente`
--
ALTER TABLE `Cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `Contacto`
--
ALTER TABLE `Contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Convocatorias`
--
ALTER TABLE `Convocatorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `ConvocatoriasArchivos`
--
ALTER TABLE `ConvocatoriasArchivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ConvocatoriasEstado`
--
ALTER TABLE `ConvocatoriasEstado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ConvocatoriasHistorico`
--
ALTER TABLE `ConvocatoriasHistorico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ConvocatoriasProveedores`
--
ALTER TABLE `ConvocatoriasProveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `CostosLogistica`
--
ALTER TABLE `CostosLogistica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Cotizacion`
--
ALTER TABLE `Cotizacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `CotizacionesEstado`
--
ALTER TABLE `CotizacionesEstado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `CotizacionProducto`
--
ALTER TABLE `CotizacionProducto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Courier`
--
ALTER TABLE `Courier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Departamento`
--
ALTER TABLE `Departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `DespachoGuia`
--
ALTER TABLE `DespachoGuia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `DespachoOrdenes`
--
ALTER TABLE `DespachoOrdenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Despachos`
--
ALTER TABLE `Despachos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `EstadoAprobacion`
--
ALTER TABLE `EstadoAprobacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `EstadoCatalogo`
--
ALTER TABLE `EstadoCatalogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `Estados`
--
ALTER TABLE `Estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `Excel`
--
ALTER TABLE `Excel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ExcelProveedor`
--
ALTER TABLE `ExcelProveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Factura`
--
ALTER TABLE `Factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Facturacostos`
--
ALTER TABLE `Facturacostos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `FacturaDetalle`
--
ALTER TABLE `FacturaDetalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Facturaestado`
--
ALTER TABLE `Facturaestado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `FacturaLogistica`
--
ALTER TABLE `FacturaLogistica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `FacturaProductos`
--
ALTER TABLE `FacturaProductos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Grupo`
--
ALTER TABLE `Grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `GuiaEnvio`
--
ALTER TABLE `GuiaEnvio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Idiomas`
--
ALTER TABLE `Idiomas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `Imagenproducto`
--
ALTER TABLE `Imagenproducto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Intervalos`
--
ALTER TABLE `Intervalos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Inventario`
--
ALTER TABLE `Inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `InventarioGuia`
--
ALTER TABLE `InventarioGuia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `InventarioHistorico`
--
ALTER TABLE `InventarioHistorico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Justificacion`
--
ALTER TABLE `Justificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `Menu`
--
ALTER TABLE `Menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `MonedaTipo`
--
ALTER TABLE `MonedaTipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Novedades`
--
ALTER TABLE `Novedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Novedadesaccion`
--
ALTER TABLE `Novedadesaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `NovedadesDevolucionTipo`
--
ALTER TABLE `NovedadesDevolucionTipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `Novedadesestado`
--
ALTER TABLE `Novedadesestado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `Novedadestipo`
--
ALTER TABLE `Novedadestipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `OrdenesCompra`
--
ALTER TABLE `OrdenesCompra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `OrdenesCompraHistorico`
--
ALTER TABLE `OrdenesCompraHistorico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `OrdenesEstado`
--
ALTER TABLE `OrdenesEstado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `OrdenesProducto`
--
ALTER TABLE `OrdenesProducto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `OrdenesProductoHistorico`
--
ALTER TABLE `OrdenesProductoHistorico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `OrdenesTipo`
--
ALTER TABLE `OrdenesTipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `Pais`
--
ALTER TABLE `Pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `Participantes`
--
ALTER TABLE `Participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Participantesestado`
--
ALTER TABLE `Participantesestado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `Periodos`
--
ALTER TABLE `Periodos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `Planilla`
--
ALTER TABLE `Planilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `PlanillaEstado`
--
ALTER TABLE `PlanillaEstado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `PlanillaTipo`
--
ALTER TABLE `PlanillaTipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Preciohistorico`
--
ALTER TABLE `Preciohistorico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Premios`
--
ALTER TABLE `Premios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `PremiosProductos`
--
ALTER TABLE `PremiosProductos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Presupuestos`
--
ALTER TABLE `Presupuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Presupuestoshistorico`
--
ALTER TABLE `Presupuestoshistorico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Prioridad`
--
ALTER TABLE `Prioridad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Producto`
--
ALTER TABLE `Producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ProductoCalificacion`
--
ALTER TABLE `ProductoCalificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Productocatalogo`
--
ALTER TABLE `Productocatalogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ProductocatalogoHistorico`
--
ALTER TABLE `ProductocatalogoHistorico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Productoclasificacion`
--
ALTER TABLE `Productoclasificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ProductoIdiomas`
--
ALTER TABLE `ProductoIdiomas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Productoprecio`
--
ALTER TABLE `Productoprecio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ProductoTipo`
--
ALTER TABLE `ProductoTipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Programa`
--
ALTER TABLE `Programa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Promociones`
--
ALTER TABLE `Promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Proveedores`
--
ALTER TABLE `Proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ProveedoresArea`
--
ALTER TABLE `ProveedoresArea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ProveedoresCalificacion`
--
ALTER TABLE `ProveedoresCalificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ProveedoresClasificacion`
--
ALTER TABLE `ProveedoresClasificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ProveedoresHistorico`
--
ALTER TABLE `ProveedoresHistorico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ProveedoresTipo`
--
ALTER TABLE `ProveedoresTipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `Redenciones`
--
ALTER TABLE `Redenciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Redencionesatributos`
--
ALTER TABLE `Redencionesatributos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Redencionesenvios`
--
ALTER TABLE `Redencionesenvios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Redencionesestado`
--
ALTER TABLE `Redencionesestado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `RedencionesHistorico`
--
ALTER TABLE `RedencionesHistorico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `RedencionesProductos`
--
ALTER TABLE `RedencionesProductos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Regimen`
--
ALTER TABLE `Regimen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `Requisicion`
--
ALTER TABLE `Requisicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Requisicionesenvios`
--
ALTER TABLE `Requisicionesenvios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `RequisicionProducto`
--
ALTER TABLE `RequisicionProducto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `revisions`
--
ALTER TABLE `revisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Servicios`
--
ALTER TABLE `Servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `ServiciosLog`
--
ALTER TABLE `ServiciosLog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `Solicitud`
--
ALTER TABLE `Solicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `SolicitudesArchivos`
--
ALTER TABLE `SolicitudesArchivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `SolicitudesAsignar`
--
ALTER TABLE `SolicitudesAsignar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `SolicitudesEstado`
--
ALTER TABLE `SolicitudesEstado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `SolicitudesObservaciones`
--
ALTER TABLE `SolicitudesObservaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `SolicitudTipo`
--
ALTER TABLE `SolicitudTipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Tipoarchivo`
--
ALTER TABLE `Tipoarchivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `Tipocostos`
--
ALTER TABLE `Tipocostos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `Tipodocumento`
--
ALTER TABLE `Tipodocumento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `Tracking`
--
ALTER TABLE `Tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Aeconomica`
--
ALTER TABLE `Aeconomica`
  ADD CONSTRAINT `FK_742F633ADB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_742F633ACB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedores` (`id`);

--
-- Filtros para la tabla `Archivos`
--
ALTER TABLE `Archivos`
  ADD CONSTRAINT `FK_E1FB66E5DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_E1FB66E59F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`),
  ADD CONSTRAINT `FK_E1FB66E5CB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedores` (`id`),
  ADD CONSTRAINT `FK_E1FB66E5E919E768` FOREIGN KEY (`tipoarchivo_id`) REFERENCES `Tipoarchivo` (`id`);

--
-- Filtros para la tabla `Areas`
--
ALTER TABLE `Areas`
  ADD CONSTRAINT `FK_99719D58DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Atributosproducto`
--
ALTER TABLE `Atributosproducto`
  ADD CONSTRAINT `FK_23EF7AD1DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_23EF7AD17645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_23EF7AD19F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`),
  ADD CONSTRAINT `FK_23EF7AD1A9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `Atributostipo` (`id`);

--
-- Filtros para la tabla `Atributostipo`
--
ALTER TABLE `Atributostipo`
  ADD CONSTRAINT `FK_5B24578ADB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Catalogo`
--
ALTER TABLE `Catalogo`
  ADD CONSTRAINT `FK_1EDA0913DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_1EDA09139F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`),
  ADD CONSTRAINT `FK_1EDA0913CB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedores` (`id`);

--
-- Filtros para la tabla `Catalogos`
--
ALTER TABLE `Catalogos`
  ADD CONSTRAINT `FK_9FAE54DCDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_9FAE54DC9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`),
  ADD CONSTRAINT `FK_9FAE54DCA9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `CatalogoTipo` (`id`),
  ADD CONSTRAINT `FK_9FAE54DCC604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `Pais` (`id`),
  ADD CONSTRAINT `FK_9FAE54DCFD8A7328` FOREIGN KEY (`programa_id`) REFERENCES `Programa` (`id`);

--
-- Filtros para la tabla `CatalogoTipo`
--
ALTER TABLE `CatalogoTipo`
  ADD CONSTRAINT `FK_1CBA6171DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Categoria`
--
ALTER TABLE `Categoria`
  ADD CONSTRAINT `FK_CCE1908EDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `CentroCostos`
--
ALTER TABLE `CentroCostos`
  ADD CONSTRAINT `FK_7FF495A0DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_7FF495A09F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`),
  ADD CONSTRAINT `FK_7FF495A0DE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `Cliente` (`id`);

--
-- Filtros para la tabla `CierreEstado`
--
ALTER TABLE `CierreEstado`
  ADD CONSTRAINT `FK_59E29F6CDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Ciudad`
--
ALTER TABLE `Ciudad`
  ADD CONSTRAINT `FK_892A00A8DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_892A00A85A91C08D` FOREIGN KEY (`departamento_id`) REFERENCES `Departamento` (`id`);

--
-- Filtros para la tabla `Cliente`
--
ALTER TABLE `Cliente`
  ADD CONSTRAINT `FK_3BA1A2B9DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_3BA1A2B92E595373` FOREIGN KEY (`tipodocumento_id`) REFERENCES `Tipodocumento` (`id`),
  ADD CONSTRAINT `FK_3BA1A2B99F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`);

--
-- Filtros para la tabla `Contacto`
--
ALTER TABLE `Contacto`
  ADD CONSTRAINT `FK_DE372B6ADB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_DE372B6ACB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedores` (`id`);

--
-- Filtros para la tabla `Convocatorias`
--
ALTER TABLE `Convocatorias`
  ADD CONSTRAINT `FK_E474E390DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_E474E3901CB9D6E4` FOREIGN KEY (`solicitud_id`) REFERENCES `Solicitud` (`id`),
  ADD CONSTRAINT `FK_E474E3909F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `ConvocatoriasEstado` (`id`);

--
-- Filtros para la tabla `ConvocatoriasArchivos`
--
ALTER TABLE `ConvocatoriasArchivos`
  ADD CONSTRAINT `FK_B1D44056DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_B1D440564EE93BE6` FOREIGN KEY (`convocatoria_id`) REFERENCES `Convocatorias` (`id`),
  ADD CONSTRAINT `FK_B1D440569F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`);

--
-- Filtros para la tabla `ConvocatoriasEstado`
--
ALTER TABLE `ConvocatoriasEstado`
  ADD CONSTRAINT `FK_1955002EDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `ConvocatoriasHistorico`
--
ALTER TABLE `ConvocatoriasHistorico`
  ADD CONSTRAINT `FK_5D637AD9DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_5D637AD94EE93BE6` FOREIGN KEY (`convocatoria_id`) REFERENCES `Convocatorias` (`id`),
  ADD CONSTRAINT `FK_5D637AD99F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `ConvocatoriasEstado` (`id`);

--
-- Filtros para la tabla `ConvocatoriasProveedores`
--
ALTER TABLE `ConvocatoriasProveedores`
  ADD CONSTRAINT `FK_AFC4D942DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_AFC4D9424EE93BE6` FOREIGN KEY (`convocatoria_id`) REFERENCES `Convocatorias` (`id`),
  ADD CONSTRAINT `FK_AFC4D942CB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedores` (`id`);

--
-- Filtros para la tabla `CostosLogistica`
--
ALTER TABLE `CostosLogistica`
  ADD CONSTRAINT `FK_11F785B4DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_11F785B46E3C888` FOREIGN KEY (`facturaLogistica_id`) REFERENCES `FacturaLogistica` (`id`),
  ADD CONSTRAINT `FK_11F785B4F747F090` FOREIGN KEY (`planilla_id`) REFERENCES `Planilla` (`id`);

--
-- Filtros para la tabla `Cotizacion`
--
ALTER TABLE `Cotizacion`
  ADD CONSTRAINT `FK_BF8EFD3DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_BF8EFD31CB9D6E4` FOREIGN KEY (`solicitud_id`) REFERENCES `Solicitud` (`id`),
  ADD CONSTRAINT `FK_BF8EFD36E3C888` FOREIGN KEY (`facturaLogistica_id`) REFERENCES `FacturaLogistica` (`id`),
  ADD CONSTRAINT `FK_BF8EFD39F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `CotizacionesEstado` (`id`);

--
-- Filtros para la tabla `CotizacionesEstado`
--
ALTER TABLE `CotizacionesEstado`
  ADD CONSTRAINT `FK_43F1F312DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `CotizacionProducto`
--
ALTER TABLE `CotizacionProducto`
  ADD CONSTRAINT `FK_ADA66927DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_ADA66927307090AA` FOREIGN KEY (`cotizacion_id`) REFERENCES `Cotizacion` (`id`),
  ADD CONSTRAINT `FK_ADA669277645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_ADA669277A8BC25A` FOREIGN KEY (`facturaProducto_id`) REFERENCES `FacturaProductos` (`id`),
  ADD CONSTRAINT `FK_ADA669279F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `OrdenesEstado` (`id`);

--
-- Filtros para la tabla `Courier`
--
ALTER TABLE `Courier`
  ADD CONSTRAINT `FK_AE75E0DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_AE75E02E595373` FOREIGN KEY (`tipodocumento_id`) REFERENCES `Tipodocumento` (`id`);

--
-- Filtros para la tabla `Departamento`
--
ALTER TABLE `Departamento`
  ADD CONSTRAINT `FK_58D54C13DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_58D54C13C604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `Pais` (`id`);

--
-- Filtros para la tabla `DespachoGuia`
--
ALTER TABLE `DespachoGuia`
  ADD CONSTRAINT `FK_7475D3D1794DC32` FOREIGN KEY (`cierreEstado_id`) REFERENCES `CierreEstado` (`id`),
  ADD CONSTRAINT `FK_7475D3D299C08BC` FOREIGN KEY (`despacho_id`) REFERENCES `Despachos` (`id`),
  ADD CONSTRAINT `FK_7475D3D62AA81F` FOREIGN KEY (`guia_id`) REFERENCES `GuiaEnvio` (`id`),
  ADD CONSTRAINT `FK_7475D3DDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `DespachoOrdenes`
--
ALTER TABLE `DespachoOrdenes`
  ADD CONSTRAINT `FK_FE882C8BDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_FE882C8B1CB9D6E4` FOREIGN KEY (`solicitud_id`) REFERENCES `Solicitud` (`id`),
  ADD CONSTRAINT `FK_FE882C8B9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`);

--
-- Filtros para la tabla `Despachos`
--
ALTER TABLE `Despachos`
  ADD CONSTRAINT `FK_CBB2E46BDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_CBB2E46B1CB9D6E4` FOREIGN KEY (`solicitud_id`) REFERENCES `Solicitud` (`id`),
  ADD CONSTRAINT `FK_CBB2E46B55804572` FOREIGN KEY (`redencion_id`) REFERENCES `Redenciones` (`id`),
  ADD CONSTRAINT `FK_CBB2E46B7645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_CBB2E46BAFC6C4DE` FOREIGN KEY (`ordenproducto_id`) REFERENCES `OrdenesProducto` (`id`),
  ADD CONSTRAINT `FK_CBB2E46BE8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `Ciudad` (`id`),
  ADD CONSTRAINT `FK_CBB2E46BF01FA5EC` FOREIGN KEY (`ordendespacho_id`) REFERENCES `DespachoOrdenes` (`id`),
  ADD CONSTRAINT `FK_CBB2E46BF747F090` FOREIGN KEY (`planilla_id`) REFERENCES `Planilla` (`id`);

--
-- Filtros para la tabla `EstadoAprobacion`
--
ALTER TABLE `EstadoAprobacion`
  ADD CONSTRAINT `FK_B2A7BC13DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `EstadoCatalogo`
--
ALTER TABLE `EstadoCatalogo`
  ADD CONSTRAINT `FK_85A73F67DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Estados`
--
ALTER TABLE `Estados`
  ADD CONSTRAINT `FK_ED9618B4DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Excel`
--
ALTER TABLE `Excel`
  ADD CONSTRAINT `FK_EEA56FBFDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `ExcelProveedor`
--
ALTER TABLE `ExcelProveedor`
  ADD CONSTRAINT `FK_33FAD10DDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Factura`
--
ALTER TABLE `Factura`
  ADD CONSTRAINT `FK_36569995DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_365699959C3921AB` FOREIGN KEY (`periodo_id`) REFERENCES `Periodos` (`id`),
  ADD CONSTRAINT `FK_36569995C604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `Pais` (`id`),
  ADD CONSTRAINT `FK_36569995FD8A7328` FOREIGN KEY (`programa_id`) REFERENCES `Programa` (`id`);

--
-- Filtros para la tabla `Facturacostos`
--
ALTER TABLE `Facturacostos`
  ADD CONSTRAINT `FK_7AE6AF16DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `FacturaDetalle`
--
ALTER TABLE `FacturaDetalle`
  ADD CONSTRAINT `FK_AA0EC6AADB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_AA0EC6AA55804572` FOREIGN KEY (`redencion_id`) REFERENCES `Redenciones` (`id`),
  ADD CONSTRAINT `FK_AA0EC6AAA9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `Tipocostos` (`id`),
  ADD CONSTRAINT `FK_AA0EC6AABD0F409C` FOREIGN KEY (`area_id`) REFERENCES `Areas` (`id`),
  ADD CONSTRAINT `FK_AA0EC6AAF04F795F` FOREIGN KEY (`factura_id`) REFERENCES `Factura` (`id`);

--
-- Filtros para la tabla `Facturaestado`
--
ALTER TABLE `Facturaestado`
  ADD CONSTRAINT `FK_7960EA2EDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `FacturaLogistica`
--
ALTER TABLE `FacturaLogistica`
  ADD CONSTRAINT `FK_FD29DE14DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_FD29DE14F04F795F` FOREIGN KEY (`factura_id`) REFERENCES `Factura` (`id`);

--
-- Filtros para la tabla `FacturaProductos`
--
ALTER TABLE `FacturaProductos`
  ADD CONSTRAINT `FK_D66E82D3DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_D66E82D37645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_D66E82D3F04F795F` FOREIGN KEY (`factura_id`) REFERENCES `Factura` (`id`);

--
-- Filtros para la tabla `Grupo`
--
ALTER TABLE `Grupo`
  ADD CONSTRAINT `FK_4DCFB4D7DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `GuiaEnvio`
--
ALTER TABLE `GuiaEnvio`
  ADD CONSTRAINT `FK_1768DF91DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_1768DF91295A4B09` FOREIGN KEY (`ordenProducto_id`) REFERENCES `OrdenesProducto` (`id`),
  ADD CONSTRAINT `FK_1768DF913ED062CC` FOREIGN KEY (`redencionenvio_id`) REFERENCES `Redencionesenvios` (`id`),
  ADD CONSTRAINT `FK_1768DF916E3C888` FOREIGN KEY (`facturaLogistica_id`) REFERENCES `FacturaLogistica` (`id`),
  ADD CONSTRAINT `FK_1768DF91DFDFBE2A` FOREIGN KEY (`inventario_id`) REFERENCES `Inventario` (`id`),
  ADD CONSTRAINT `FK_1768DF91E3D8151C` FOREIGN KEY (`courier_id`) REFERENCES `Courier` (`id`);

--
-- Filtros para la tabla `Idiomas`
--
ALTER TABLE `Idiomas`
  ADD CONSTRAINT `FK_DD1872E2DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Imagenproducto`
--
ALTER TABLE `Imagenproducto`
  ADD CONSTRAINT `FK_DC6524F4DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_DC6524F47645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`);

--
-- Filtros para la tabla `Intervalos`
--
ALTER TABLE `Intervalos`
  ADD CONSTRAINT `FK_3D56AE6BDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_3D56AE6B155AC4BC` FOREIGN KEY (`catalogos_id`) REFERENCES `Catalogos` (`id`);

--
-- Filtros para la tabla `Inventario`
--
ALTER TABLE `Inventario`
  ADD CONSTRAINT `FK_25444D25DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_25444D251CB9D6E4` FOREIGN KEY (`solicitud_id`) REFERENCES `Solicitud` (`id`),
  ADD CONSTRAINT `FK_25444D25299C08BC` FOREIGN KEY (`despacho_id`) REFERENCES `Despachos` (`id`),
  ADD CONSTRAINT `FK_25444D254EE93BE6` FOREIGN KEY (`convocatoria_id`) REFERENCES `Convocatorias` (`id`),
  ADD CONSTRAINT `FK_25444D2555804572` FOREIGN KEY (`redencion_id`) REFERENCES `Redenciones` (`id`),
  ADD CONSTRAINT `FK_25444D257645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_25444D2595BC4699` FOREIGN KEY (`envio_id`) REFERENCES `Requisicionesenvios` (`id`),
  ADD CONSTRAINT `FK_25444D259750851F` FOREIGN KEY (`orden_id`) REFERENCES `OrdenesCompra` (`id`),
  ADD CONSTRAINT `FK_25444D25AFC6C4DE` FOREIGN KEY (`ordenproducto_id`) REFERENCES `OrdenesProducto` (`id`),
  ADD CONSTRAINT `FK_25444D25F747F090` FOREIGN KEY (`planilla_id`) REFERENCES `Planilla` (`id`);

--
-- Filtros para la tabla `InventarioGuia`
--
ALTER TABLE `InventarioGuia`
  ADD CONSTRAINT `FK_CB888BDA1794DC32` FOREIGN KEY (`cierreEstado_id`) REFERENCES `CierreEstado` (`id`),
  ADD CONSTRAINT `FK_CB888BDA62AA81F` FOREIGN KEY (`guia_id`) REFERENCES `GuiaEnvio` (`id`),
  ADD CONSTRAINT `FK_CB888BDADB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_CB888BDADFDFBE2A` FOREIGN KEY (`inventario_id`) REFERENCES `Inventario` (`id`);

--
-- Filtros para la tabla `InventarioHistorico`
--
ALTER TABLE `InventarioHistorico`
  ADD CONSTRAINT `FK_928062F6DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_928062F61CB9D6E4` FOREIGN KEY (`solicitud_id`) REFERENCES `Solicitud` (`id`),
  ADD CONSTRAINT `FK_928062F64EE93BE6` FOREIGN KEY (`convocatoria_id`) REFERENCES `Convocatorias` (`id`),
  ADD CONSTRAINT `FK_928062F655804572` FOREIGN KEY (`redencion_id`) REFERENCES `Redenciones` (`id`),
  ADD CONSTRAINT `FK_928062F67645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_928062F69750851F` FOREIGN KEY (`orden_id`) REFERENCES `OrdenesCompra` (`id`),
  ADD CONSTRAINT `FK_928062F6AFC6C4DE` FOREIGN KEY (`ordenproducto_id`) REFERENCES `OrdenesProducto` (`id`),
  ADD CONSTRAINT `FK_928062F6DFDFBE2A` FOREIGN KEY (`inventario_id`) REFERENCES `Inventario` (`id`),
  ADD CONSTRAINT `FK_928062F6F747F090` FOREIGN KEY (`planilla_id`) REFERENCES `Planilla` (`id`);

--
-- Filtros para la tabla `Justificacion`
--
ALTER TABLE `Justificacion`
  ADD CONSTRAINT `FK_588F7172DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Menu`
--
ALTER TABLE `Menu`
  ADD CONSTRAINT `FK_DD3795ADDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_DD3795AD613CEC58` FOREIGN KEY (`padre_id`) REFERENCES `Menu` (`id`);

--
-- Filtros para la tabla `menu_grupo`
--
ALTER TABLE `menu_grupo`
  ADD CONSTRAINT `FK_1DA2B8B49C833003` FOREIGN KEY (`grupo_id`) REFERENCES `Grupo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1DA2B8B4CCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `Menu` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `MonedaTipo`
--
ALTER TABLE `MonedaTipo`
  ADD CONSTRAINT `FK_D197050CDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Novedades`
--
ALTER TABLE `Novedades`
  ADD CONSTRAINT `FK_5F6398A7DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_5F6398A73F4B5275` FOREIGN KEY (`accion_id`) REFERENCES `Novedadesaccion` (`id`),
  ADD CONSTRAINT `FK_5F6398A755804572` FOREIGN KEY (`redencion_id`) REFERENCES `Redenciones` (`id`),
  ADD CONSTRAINT `FK_5F6398A75DCDADC` FOREIGN KEY (`devolucionTipo_id`) REFERENCES `NovedadesDevolucionTipo` (`id`),
  ADD CONSTRAINT `FK_5F6398A79F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Novedadesestado` (`id`),
  ADD CONSTRAINT `FK_5F6398A7A9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `Novedadestipo` (`id`);

--
-- Filtros para la tabla `Novedadesaccion`
--
ALTER TABLE `Novedadesaccion`
  ADD CONSTRAINT `FK_211E9F53DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `NovedadesDevolucionTipo`
--
ALTER TABLE `NovedadesDevolucionTipo`
  ADD CONSTRAINT `FK_5C490106DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Novedadesestado`
--
ALTER TABLE `Novedadesestado`
  ADD CONSTRAINT `FK_8D419D04DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Novedadestipo`
--
ALTER TABLE `Novedadestipo`
  ADD CONSTRAINT `FK_E695A1B2DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `OrdenesCompra`
--
ALTER TABLE `OrdenesCompra`
  ADD CONSTRAINT `FK_73BE9CCCDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_73BE9CCC1CB9D6E4` FOREIGN KEY (`solicitud_id`) REFERENCES `Solicitud` (`id`),
  ADD CONSTRAINT `FK_73BE9CCC3397707A` FOREIGN KEY (`categoria_id`) REFERENCES `Categoria` (`id`),
  ADD CONSTRAINT `FK_73BE9CCC62F40C3D` FOREIGN KEY (`creador_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_73BE9CCC755BCA5B` FOREIGN KEY (`ordenesEstado_id`) REFERENCES `OrdenesEstado` (`id`),
  ADD CONSTRAINT `FK_73BE9CCC9AA3B30E` FOREIGN KEY (`aprobo_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_73BE9CCCC604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `Pais` (`id`),
  ADD CONSTRAINT `FK_73BE9CCCCB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedores` (`id`),
  ADD CONSTRAINT `FK_73BE9CCCCF3985D2` FOREIGN KEY (`monedaTipo_id`) REFERENCES `MonedaTipo` (`id`),
  ADD CONSTRAINT `FK_73BE9CCCDB7E080F` FOREIGN KEY (`ordenesTipo_id`) REFERENCES `OrdenesTipo` (`id`),
  ADD CONSTRAINT `FK_73BE9CCCFD8A7328` FOREIGN KEY (`programa_id`) REFERENCES `Programa` (`id`);

--
-- Filtros para la tabla `OrdenesCompraHistorico`
--
ALTER TABLE `OrdenesCompraHistorico`
  ADD CONSTRAINT `FK_D47BADB9DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_D47BADB94DC260` FOREIGN KEY (`ordencompra_id`) REFERENCES `OrdenesCompra` (`id`),
  ADD CONSTRAINT `FK_D47BADB9755BCA5B` FOREIGN KEY (`ordenesEstado_id`) REFERENCES `OrdenesEstado` (`id`),
  ADD CONSTRAINT `FK_D47BADB9CB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedores` (`id`),
  ADD CONSTRAINT `FK_D47BADB9DB7E080F` FOREIGN KEY (`ordenesTipo_id`) REFERENCES `OrdenesTipo` (`id`);

--
-- Filtros para la tabla `OrdenesEstado`
--
ALTER TABLE `OrdenesEstado`
  ADD CONSTRAINT `FK_CB224CD0DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `OrdenesProducto`
--
ALTER TABLE `OrdenesProducto`
  ADD CONSTRAINT `FK_FBB7510FDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_FBB7510F18E68A87` FOREIGN KEY (`ordenesCompra_id`) REFERENCES `OrdenesCompra` (`id`),
  ADD CONSTRAINT `FK_FBB7510F7645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_FBB7510F7A8BC25A` FOREIGN KEY (`facturaProducto_id`) REFERENCES `FacturaProductos` (`id`),
  ADD CONSTRAINT `FK_FBB7510F9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`),
  ADD CONSTRAINT `FK_FBB7510FF2358319` FOREIGN KEY (`productoCotizacion_id`) REFERENCES `CotizacionProducto` (`id`),
  ADD CONSTRAINT `FK_FBB7510FFD8A7328` FOREIGN KEY (`programa_id`) REFERENCES `Programa` (`id`);

--
-- Filtros para la tabla `OrdenesProductoHistorico`
--
ALTER TABLE `OrdenesProductoHistorico`
  ADD CONSTRAINT `FK_D3E913B4DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_D3E913B418E68A87` FOREIGN KEY (`ordenesCompra_id`) REFERENCES `OrdenesCompra` (`id`),
  ADD CONSTRAINT `FK_D3E913B44DC260` FOREIGN KEY (`ordencompra_id`) REFERENCES `OrdenesProducto` (`id`),
  ADD CONSTRAINT `FK_D3E913B47645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`);

--
-- Filtros para la tabla `OrdenesTipo`
--
ALTER TABLE `OrdenesTipo`
  ADD CONSTRAINT `FK_8996293CDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Pais`
--
ALTER TABLE `Pais`
  ADD CONSTRAINT `FK_DE6F81C1DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Participantes`
--
ALTER TABLE `Participantes`
  ADD CONSTRAINT `FK_AA98AA31DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_AA98AA31238999DE` FOREIGN KEY (`participanteestado_id`) REFERENCES `Participantesestado` (`id`),
  ADD CONSTRAINT `FK_AA98AA312E595373` FOREIGN KEY (`tipodocumento_id`) REFERENCES `Tipodocumento` (`id`),
  ADD CONSTRAINT `FK_AA98AA31E8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `Ciudad` (`id`),
  ADD CONSTRAINT `FK_AA98AA31FD8A7328` FOREIGN KEY (`programa_id`) REFERENCES `Programa` (`id`);

--
-- Filtros para la tabla `Participantesestado`
--
ALTER TABLE `Participantesestado`
  ADD CONSTRAINT `FK_7FF7A321DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Periodos`
--
ALTER TABLE `Periodos`
  ADD CONSTRAINT `FK_3CB0255CDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Planilla`
--
ALTER TABLE `Planilla`
  ADD CONSTRAINT `FK_6DA6E0451CB9D6E4` FOREIGN KEY (`solicitud_id`) REFERENCES `Solicitud` (`id`),
  ADD CONSTRAINT `FK_6DA6E0453397707A` FOREIGN KEY (`categoria_id`) REFERENCES `Categoria` (`id`),
  ADD CONSTRAINT `FK_6DA6E045A9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `PlanillaTipo` (`id`),
  ADD CONSTRAINT `FK_6DA6E045B4CC6DAB` FOREIGN KEY (`planillaEstado_id`) REFERENCES `PlanillaEstado` (`id`),
  ADD CONSTRAINT `FK_6DA6E045C604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `Pais` (`id`),
  ADD CONSTRAINT `FK_6DA6E045DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_6DA6E045FD8A7328` FOREIGN KEY (`programa_id`) REFERENCES `Programa` (`id`);

--
-- Filtros para la tabla `PlanillaEstado`
--
ALTER TABLE `PlanillaEstado`
  ADD CONSTRAINT `FK_7EBFA67FDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `PlanillaTipo`
--
ALTER TABLE `PlanillaTipo`
  ADD CONSTRAINT `FK_1E69CC5CDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Preciohistorico`
--
ALTER TABLE `Preciohistorico`
  ADD CONSTRAINT `FK_7E8D910CDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_7E8D910C7645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_7E8D910CCB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedores` (`id`);

--
-- Filtros para la tabla `Premios`
--
ALTER TABLE `Premios`
  ADD CONSTRAINT `FK_CA2EAA1DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_CA2EAA1155AC4BC` FOREIGN KEY (`catalogos_id`) REFERENCES `Catalogos` (`id`),
  ADD CONSTRAINT `FK_CA2EAA12AAD40F2` FOREIGN KEY (`aproboCliente_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_CA2EAA13397707A` FOREIGN KEY (`categoria_id`) REFERENCES `Categoria` (`id`),
  ADD CONSTRAINT `FK_CA2EAA13DA55B37` FOREIGN KEY (`aproboOperaciones_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_CA2EAA15E677940` FOREIGN KEY (`estadoAprobacion_id`) REFERENCES `EstadoAprobacion` (`id`),
  ADD CONSTRAINT `FK_CA2EAA18038F3D2` FOREIGN KEY (`aproboComercial_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_CA2EAA1899FB366` FOREIGN KEY (`director_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_CA2EAA19F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_CA2EAA1C6B49F3A` FOREIGN KEY (`aproboDirector_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_CA2EAA1CD8E1E42` FOREIGN KEY (`operaciones_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_CA2EAA1DE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_CA2EAA1E2AAC521` FOREIGN KEY (`comercial_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `PremiosProductos`
--
ALTER TABLE `PremiosProductos`
  ADD CONSTRAINT `FK_B2BCBF7FDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_B2BCBF7F7645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_B2BCBF7FFB5CD01B` FOREIGN KEY (`premio_id`) REFERENCES `Premios` (`id`);

--
-- Filtros para la tabla `Presupuestos`
--
ALTER TABLE `Presupuestos`
  ADD CONSTRAINT `FK_1CFEF4F5DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_1CFEF4F5A9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `Tipocostos` (`id`),
  ADD CONSTRAINT `FK_1CFEF4F5BD0F409C` FOREIGN KEY (`area_id`) REFERENCES `Areas` (`id`),
  ADD CONSTRAINT `FK_1CFEF4F5FD8A7328` FOREIGN KEY (`programa_id`) REFERENCES `Programa` (`id`);

--
-- Filtros para la tabla `Presupuestoshistorico`
--
ALTER TABLE `Presupuestoshistorico`
  ADD CONSTRAINT `FK_6ABF2A6BDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_6ABF2A6B90119F0F` FOREIGN KEY (`presupuesto_id`) REFERENCES `Presupuestos` (`id`),
  ADD CONSTRAINT `FK_6ABF2A6BA9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `Tipocostos` (`id`),
  ADD CONSTRAINT `FK_6ABF2A6BBD0F409C` FOREIGN KEY (`area_id`) REFERENCES `Areas` (`id`),
  ADD CONSTRAINT `FK_6ABF2A6BFD8A7328` FOREIGN KEY (`programa_id`) REFERENCES `Programa` (`id`);

--
-- Filtros para la tabla `Prioridad`
--
ALTER TABLE `Prioridad`
  ADD CONSTRAINT `FK_2179E0F1DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Producto`
--
ALTER TABLE `Producto`
  ADD CONSTRAINT `FK_5ECD6443DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_5ECD64433397707A` FOREIGN KEY (`categoria_id`) REFERENCES `Categoria` (`id`),
  ADD CONSTRAINT `FK_5ECD644378ECAC4A` FOREIGN KEY (`clasificacion_id`) REFERENCES `Productoclasificacion` (`id`),
  ADD CONSTRAINT `FK_5ECD64439F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`),
  ADD CONSTRAINT `FK_5ECD6443A9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `ProductoTipo` (`id`);

--
-- Filtros para la tabla `ProductoCalificacion`
--
ALTER TABLE `ProductoCalificacion`
  ADD CONSTRAINT `FK_22AB6AFDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_22AB6AF4979D753` FOREIGN KEY (`catalogo_id`) REFERENCES `Catalogos` (`id`),
  ADD CONSTRAINT `FK_22AB6AF7645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`);

--
-- Filtros para la tabla `Productocatalogo`
--
ALTER TABLE `Productocatalogo`
  ADD CONSTRAINT `FK_1512BA7DDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_1512BA7D155AC4BC` FOREIGN KEY (`catalogos_id`) REFERENCES `Catalogos` (`id`),
  ADD CONSTRAINT `FK_1512BA7D2AAD40F2` FOREIGN KEY (`aproboCliente_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_1512BA7D3397707A` FOREIGN KEY (`categoria_id`) REFERENCES `Categoria` (`id`),
  ADD CONSTRAINT `FK_1512BA7D3DA55B37` FOREIGN KEY (`aproboOperaciones_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_1512BA7D5E677940` FOREIGN KEY (`estadoAprobacion_id`) REFERENCES `EstadoAprobacion` (`id`),
  ADD CONSTRAINT `FK_1512BA7D7645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_1512BA7D8038F3D2` FOREIGN KEY (`aproboComercial_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_1512BA7D899FB366` FOREIGN KEY (`director_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_1512BA7D9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_1512BA7DC6B49F3A` FOREIGN KEY (`aproboDirector_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_1512BA7DCD8E1E42` FOREIGN KEY (`operaciones_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_1512BA7DDE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_1512BA7DE2AAC521` FOREIGN KEY (`comercial_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `ProductocatalogoHistorico`
--
ALTER TABLE `ProductocatalogoHistorico`
  ADD CONSTRAINT `FK_EADB47EBDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_EADB47EB155AC4BC` FOREIGN KEY (`catalogos_id`) REFERENCES `Catalogos` (`id`),
  ADD CONSTRAINT `FK_EADB47EB2AAD40F2` FOREIGN KEY (`aproboCliente_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_EADB47EB3397707A` FOREIGN KEY (`categoria_id`) REFERENCES `Categoria` (`id`),
  ADD CONSTRAINT `FK_EADB47EB3DA55B37` FOREIGN KEY (`aproboOperaciones_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_EADB47EB7645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_EADB47EB8038F3D2` FOREIGN KEY (`aproboComercial_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_EADB47EB899FB366` FOREIGN KEY (`director_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_EADB47EB9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_EADB47EBC6B49F3A` FOREIGN KEY (`aproboDirector_id`) REFERENCES `EstadoCatalogo` (`id`),
  ADD CONSTRAINT `FK_EADB47EBCD8E1E42` FOREIGN KEY (`operaciones_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_EADB47EBDE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_EADB47EBE2AAC521` FOREIGN KEY (`comercial_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_EADB47EBF17F7F48` FOREIGN KEY (`productocatalogo_id`) REFERENCES `Productocatalogo` (`id`);

--
-- Filtros para la tabla `Productoclasificacion`
--
ALTER TABLE `Productoclasificacion`
  ADD CONSTRAINT `FK_F60FCEFDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `ProductoIdiomas`
--
ALTER TABLE `ProductoIdiomas`
  ADD CONSTRAINT `FK_1C904B1DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_1C904B17645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_1C904B1DEDC0611` FOREIGN KEY (`idioma_id`) REFERENCES `Idiomas` (`id`);

--
-- Filtros para la tabla `Productoprecio`
--
ALTER TABLE `Productoprecio`
  ADD CONSTRAINT `FK_11D25D8CDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_11D25D8C7645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_11D25D8C9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`),
  ADD CONSTRAINT `FK_11D25D8CCB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedores` (`id`);

--
-- Filtros para la tabla `ProductoTipo`
--
ALTER TABLE `ProductoTipo`
  ADD CONSTRAINT `FK_E4E7F3A6DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Programa`
--
ALTER TABLE `Programa`
  ADD CONSTRAINT `FK_FB86765BDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_FB86765B811AEEEB` FOREIGN KEY (`centroCostos_id`) REFERENCES `CentroCostos` (`id`),
  ADD CONSTRAINT `FK_FB86765B9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`),
  ADD CONSTRAINT `FK_FB86765BDE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `Cliente` (`id`);

--
-- Filtros para la tabla `Promociones`
--
ALTER TABLE `Promociones`
  ADD CONSTRAINT `FK_BE8728ADDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_BE8728AD9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`),
  ADD CONSTRAINT `FK_BE8728ADFB5CD01B` FOREIGN KEY (`premio_id`) REFERENCES `Premios` (`id`);

--
-- Filtros para la tabla `Proveedores`
--
ALTER TABLE `Proveedores`
  ADD CONSTRAINT `FK_D327262E595373` FOREIGN KEY (`tipodocumento_id`) REFERENCES `Tipodocumento` (`id`),
  ADD CONSTRAINT `FK_D327263397707A` FOREIGN KEY (`categoria_id`) REFERENCES `Categoria` (`id`),
  ADD CONSTRAINT `FK_D327265A91C08D` FOREIGN KEY (`departamento_id`) REFERENCES `Departamento` (`id`),
  ADD CONSTRAINT `FK_D3272664832107` FOREIGN KEY (`regimen_id`) REFERENCES `Regimen` (`id`),
  ADD CONSTRAINT `FK_D3272678ECAC4A` FOREIGN KEY (`clasificacion_id`) REFERENCES `ProveedoresClasificacion` (`id`),
  ADD CONSTRAINT `FK_D327269F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`),
  ADD CONSTRAINT `FK_D32726A9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `ProveedoresTipo` (`id`),
  ADD CONSTRAINT `FK_D32726BD0F409C` FOREIGN KEY (`area_id`) REFERENCES `ProveedoresArea` (`id`),
  ADD CONSTRAINT `FK_D32726C604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `Pais` (`id`),
  ADD CONSTRAINT `FK_D32726DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_D32726E8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `Ciudad` (`id`);

--
-- Filtros para la tabla `ProveedoresArea`
--
ALTER TABLE `ProveedoresArea`
  ADD CONSTRAINT `FK_65E8A40DDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `ProveedoresCalificacion`
--
ALTER TABLE `ProveedoresCalificacion`
  ADD CONSTRAINT `FK_7E86F9E6DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_7E86F9E6CB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedores` (`id`);

--
-- Filtros para la tabla `ProveedoresClasificacion`
--
ALTER TABLE `ProveedoresClasificacion`
  ADD CONSTRAINT `FK_B362E261DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `ProveedoresHistorico`
--
ALTER TABLE `ProveedoresHistorico`
  ADD CONSTRAINT `FK_97283E77DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_97283E772E595373` FOREIGN KEY (`tipodocumento_id`) REFERENCES `Tipodocumento` (`id`),
  ADD CONSTRAINT `FK_97283E773397707A` FOREIGN KEY (`categoria_id`) REFERENCES `Categoria` (`id`),
  ADD CONSTRAINT `FK_97283E775A91C08D` FOREIGN KEY (`departamento_id`) REFERENCES `Departamento` (`id`),
  ADD CONSTRAINT `FK_97283E7764832107` FOREIGN KEY (`regimen_id`) REFERENCES `Regimen` (`id`),
  ADD CONSTRAINT `FK_97283E77A9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `ProveedoresTipo` (`id`),
  ADD CONSTRAINT `FK_97283E77C604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `Pais` (`id`),
  ADD CONSTRAINT `FK_97283E77CB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedores` (`id`),
  ADD CONSTRAINT `FK_97283E77E8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `Ciudad` (`id`);

--
-- Filtros para la tabla `ProveedoresTipo`
--
ALTER TABLE `ProveedoresTipo`
  ADD CONSTRAINT `FK_C2518422DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Redenciones`
--
ALTER TABLE `Redenciones`
  ADD CONSTRAINT `FK_D45E85216D28D42D` FOREIGN KEY (`justificacion_id`) REFERENCES `Justificacion` (`id`),
  ADD CONSTRAINT `FK_D45E85217A8BC25A` FOREIGN KEY (`facturaProducto_id`) REFERENCES `FacturaProductos` (`id`),
  ADD CONSTRAINT `FK_D45E852184F08D54` FOREIGN KEY (`redencionestado_id`) REFERENCES `Redencionesestado` (`id`),
  ADD CONSTRAINT `FK_D45E8521B1E453D4` FOREIGN KEY (`promocion_id`) REFERENCES `Promociones` (`id`),
  ADD CONSTRAINT `FK_D45E8521C6FE70FC` FOREIGN KEY (`ordenesProducto_id`) REFERENCES `OrdenesProducto` (`id`),
  ADD CONSTRAINT `FK_D45E8521DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_D45E8521F6F50196` FOREIGN KEY (`participante_id`) REFERENCES `Participantes` (`id`),
  ADD CONSTRAINT `FK_D45E8521FB5CD01B` FOREIGN KEY (`premio_id`) REFERENCES `Premios` (`id`);

--
-- Filtros para la tabla `Redencionesatributos`
--
ALTER TABLE `Redencionesatributos`
  ADD CONSTRAINT `FK_6291B3DFDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_6291B3DF55804572` FOREIGN KEY (`redencion_id`) REFERENCES `Redenciones` (`id`),
  ADD CONSTRAINT `FK_6291B3DFC3604172` FOREIGN KEY (`atributos_id`) REFERENCES `Atributosproducto` (`id`);

--
-- Filtros para la tabla `Redencionesenvios`
--
ALTER TABLE `Redencionesenvios`
  ADD CONSTRAINT `FK_F966A26BDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_F966A26B55804572` FOREIGN KEY (`redencion_id`) REFERENCES `Redenciones` (`id`),
  ADD CONSTRAINT `FK_F966A26BE8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `Ciudad` (`id`);

--
-- Filtros para la tabla `Redencionesestado`
--
ALTER TABLE `Redencionesestado`
  ADD CONSTRAINT `FK_32F9EDEFDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `RedencionesHistorico`
--
ALTER TABLE `RedencionesHistorico`
  ADD CONSTRAINT `FK_7B4F6644DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_7B4F664455804572` FOREIGN KEY (`redencion_id`) REFERENCES `Redenciones` (`id`),
  ADD CONSTRAINT `FK_7B4F66447A8BC25A` FOREIGN KEY (`facturaProducto_id`) REFERENCES `FacturaProductos` (`id`),
  ADD CONSTRAINT `FK_7B4F664484F08D54` FOREIGN KEY (`redencionestado_id`) REFERENCES `Redencionesestado` (`id`),
  ADD CONSTRAINT `FK_7B4F6644C6FE70FC` FOREIGN KEY (`ordenesProducto_id`) REFERENCES `OrdenesProducto` (`id`),
  ADD CONSTRAINT `FK_7B4F6644F17F7F48` FOREIGN KEY (`productocatalogo_id`) REFERENCES `Productocatalogo` (`id`),
  ADD CONSTRAINT `FK_7B4F6644F6F50196` FOREIGN KEY (`participante_id`) REFERENCES `Participantes` (`id`);

--
-- Filtros para la tabla `RedencionesProductos`
--
ALTER TABLE `RedencionesProductos`
  ADD CONSTRAINT `FK_8091C3C8DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_8091C3C855804572` FOREIGN KEY (`redencion_id`) REFERENCES `Redenciones` (`id`),
  ADD CONSTRAINT `FK_8091C3C87645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_8091C3C87A8BC25A` FOREIGN KEY (`facturaProducto_id`) REFERENCES `FacturaProductos` (`id`),
  ADD CONSTRAINT `FK_8091C3C89F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Redencionesestado` (`id`),
  ADD CONSTRAINT `FK_8091C3C8C6FE70FC` FOREIGN KEY (`ordenesProducto_id`) REFERENCES `OrdenesProducto` (`id`);

--
-- Filtros para la tabla `Regimen`
--
ALTER TABLE `Regimen`
  ADD CONSTRAINT `FK_EEAC2113DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Requisicion`
--
ALTER TABLE `Requisicion`
  ADD CONSTRAINT `FK_5EB3A24FDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_5EB3A24F1CB9D6E4` FOREIGN KEY (`solicitud_id`) REFERENCES `Solicitud` (`id`);

--
-- Filtros para la tabla `Requisicionesenvios`
--
ALTER TABLE `Requisicionesenvios`
  ADD CONSTRAINT `FK_475DB6B3DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_475DB6B3E8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `Ciudad` (`id`);

--
-- Filtros para la tabla `RequisicionProducto`
--
ALTER TABLE `RequisicionProducto`
  ADD CONSTRAINT `FK_65396634DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_653966341EBA4B16` FOREIGN KEY (`requisicion_id`) REFERENCES `Requisicion` (`id`),
  ADD CONSTRAINT `FK_653966347645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_653966347A8BC25A` FOREIGN KEY (`facturaProducto_id`) REFERENCES `FacturaProductos` (`id`);

--
-- Filtros para la tabla `Servicios`
--
ALTER TABLE `Servicios`
  ADD CONSTRAINT `FK_428F028CDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `ServiciosLog`
--
ALTER TABLE `ServiciosLog`
  ADD CONSTRAINT `FK_106C30B0DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_106C30B071CAA3E7` FOREIGN KEY (`servicio_id`) REFERENCES `Servicios` (`id`);

--
-- Filtros para la tabla `Solicitud`
--
ALTER TABLE `Solicitud`
  ADD CONSTRAINT `FK_1423FE63DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_1423FE63811AEEEB` FOREIGN KEY (`centroCostos_id`) REFERENCES `CentroCostos` (`id`),
  ADD CONSTRAINT `FK_1423FE639F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `SolicitudesEstado` (`id`),
  ADD CONSTRAINT `FK_1423FE63A9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `SolicitudTipo` (`id`),
  ADD CONSTRAINT `FK_1423FE63BDD13D7A` FOREIGN KEY (`prioridad_id`) REFERENCES `Prioridad` (`id`),
  ADD CONSTRAINT `FK_1423FE63C680A87` FOREIGN KEY (`solicitante_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_1423FE63FD8A7328` FOREIGN KEY (`programa_id`) REFERENCES `Programa` (`id`);

--
-- Filtros para la tabla `SolicitudesArchivos`
--
ALTER TABLE `SolicitudesArchivos`
  ADD CONSTRAINT `FK_193F9BCDDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_193F9BCD1CB9D6E4` FOREIGN KEY (`solicitud_id`) REFERENCES `Solicitud` (`id`),
  ADD CONSTRAINT `FK_193F9BCD9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`);

--
-- Filtros para la tabla `SolicitudesAsignar`
--
ALTER TABLE `SolicitudesAsignar`
  ADD CONSTRAINT `FK_E682E95BDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_E682E95B1CB9D6E4` FOREIGN KEY (`solicitud_id`) REFERENCES `Solicitud` (`id`),
  ADD CONSTRAINT `FK_E682E95B53C59D72` FOREIGN KEY (`responsable_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_E682E95B9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estados` (`id`);

--
-- Filtros para la tabla `SolicitudesEstado`
--
ALTER TABLE `SolicitudesEstado`
  ADD CONSTRAINT `FK_CEE75E70DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `SolicitudesObservaciones`
--
ALTER TABLE `SolicitudesObservaciones`
  ADD CONSTRAINT `FK_BDF3161DDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_BDF3161D1CB9D6E4` FOREIGN KEY (`solicitud_id`) REFERENCES `Solicitud` (`id`);

--
-- Filtros para la tabla `SolicitudTipo`
--
ALTER TABLE `SolicitudTipo`
  ADD CONSTRAINT `FK_E2A51752DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Tipoarchivo`
--
ALTER TABLE `Tipoarchivo`
  ADD CONSTRAINT `FK_DF3F2ACEDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Tipocostos`
--
ALTER TABLE `Tipocostos`
  ADD CONSTRAINT `FK_E602D15FDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Tipodocumento`
--
ALTER TABLE `Tipodocumento`
  ADD CONSTRAINT `FK_FDCA7A9BDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Tracking`
--
ALTER TABLE `Tracking`
  ADD CONSTRAINT `FK_510A004ADB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_510A004AAFC6C4DE` FOREIGN KEY (`ordenproducto_id`) REFERENCES `OrdenesProducto` (`id`);

--
-- Filtros para la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `FK_F780E5A4DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`),
  ADD CONSTRAINT `FK_F780E5A4CB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedores` (`id`),
  ADD CONSTRAINT `FK_F780E5A4DE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `Cliente` (`id`);

--
-- Filtros para la tabla `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  ADD CONSTRAINT `FK_91D0F1CD9C833003` FOREIGN KEY (`grupo_id`) REFERENCES `Grupo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_91D0F1CDDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
