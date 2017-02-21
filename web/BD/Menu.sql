-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-08-2016 a las 00:44:47
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
-- Volcado de datos para la tabla `Menu`
--

INSERT INTO `Menu` (`id`, `nombre`, `link`, `icono`, `tipo`, `orden`, `estado`, `padre_id`) VALUES
(1, 'Inicio', '_inicio', 'icon-home', 2, 0, 0, NULL),
(2, 'Proveedores', '', '', 3, 10, 1, NULL),
(3, 'Proveedores', 'proveedores', 'icon-th-list', 2, 11, 1, 2),
(4, 'Configuracion', '', '', 3, 100, 1, NULL),
(5, 'Usuarios', 'usuarios', 'icon-user', 2, 101, 1, 4),
(6, 'Contactos', '', 'icon-user', 1, 13, 0, 2),
(7, 'Catalogos', '', 'icon-th', 1, 14, 0, 2),
(8, 'Convocatorias', 'convocatorias', 'icon-bullhorn', 2, 18, 1, 50),
(9, 'Datos', 'proveedores_datos', 'icon-th-list', 2, 12, 1, 2),
(10, 'Convocatorias', 'convocatorias_proveedor', 'icon-bullhorn', 2, 18, 1, 2),
(11, 'Ordenes Compra', 'ordenes', 'icon-folder-open', 2, 41, 1, 15),
(12, 'Contactos', 'proveedores_contactos', 'icon-user', 2, 13, 0, 2),
(13, 'Documentos', 'proveedores_documentos', 'icon-file', 2, 14, 0, 2),
(14, 'Catalogos', 'proveedores_catalogos', 'icon-th-large', 2, 15, 0, 2),
(15, 'Ordenes Compra', '', '', 3, 40, 1, NULL),
(16, 'Catalogos', '', '', 3, 20, 1, NULL),
(17, 'Productos Catalogo', 'producto', 'icon-barcode', 2, 21, 1, 16),
(18, 'Catalogos', 'catalogo', 'icon-book', 2, 23, 1, 16),
(19, 'Programas', 'programa', 'icon-star-empty', 2, 24, 1, 16),
(20, 'Clientes', 'cliente', 'icon-list-alt', 2, 25, 1, 16),
(21, 'Catalogo Maestro', 'productocatalogo_maestro', 'icon-th', 2, 26, 1, 16),
(22, 'Imagenes', 'catalogo_navegar', 'icon-eye-open', 2, 27, 1, 16),
(23, 'Redenciones', '', '', 3, 30, 1, NULL),
(24, 'Redenciones', 'redenciones', '', 2, 31, 1, 23),
(27, 'Logistica', '', '', 3, 50, 1, NULL),
(28, 'Inventario', 'inventario_listado', '', 2, 64, 1, 42),
(29, 'Planillas', 'planillas_lista', '', 2, 52, 1, 27),
(30, 'Premios pendientes', 'ordenredencion_pendientes', '', 2, 42, 1, NULL),
(31, 'Facturacion', '', '', 3, 85, 1, NULL),
(32, 'Presupuesto', 'presupuesto_listado', '', 2, 86, 0, 31),
(33, 'Garantias', '', '', 3, 70, 1, NULL),
(34, 'Registrar', 'garantias_redenciones', '', 2, 71, 1, 33),
(35, 'Novedades', 'garantiasnovedades_listado', '', 2, 72, 1, 33),
(36, 'Reportes', 'presupuesto_reportes', '', 2, 87, 0, 31),
(37, 'Facturas', 'facturacion_listado', '', 2, 88, 1, 31),
(38, 'Ingreso', 'ordenes_ingreso_listado', '', 2, 43, 1, 15),
(39, 'Guias', 'logistica_importar_guias', '', 2, 54, 1, 27),
(40, 'Recompras', 'garantiasrecompras_listado', '', 2, 73, 1, 33),
(41, 'Datos Envio', 'garantias_reenvios', '', 2, 74, 1, 33),
(42, 'Inventario', '', '', 3, 60, 1, NULL),
(43, 'Salidas', 'inventario_listadosalida', '', 2, 62, 1, 42),
(44, 'Entradas', 'inventario_ingreso', '', 2, 61, 1, 42),
(45, 'Total Pass', 'redenciones_programastotalpass', '', 2, 32, 1, 23),
(46, 'Aprobar Calificacion', 'calificaciones', '', 2, 14, 1, 2),
(47, 'Plan Accion', 'planes', '', 2, 15, 1, 2),
(48, 'Solicitudes', 'solicitudes', '', 2, 17, 1, 50),
(49, 'Cotizaciones', 'cotizaciones', '', 2, 19, 1, 50),
(50, 'Solicitudes', '', '', 3, 16, 1, NULL),
(52, 'Productos General', 'producto_listadouniversal', '', 2, 22, 1, 16),
(53, 'Cierre', 'inventario_planilla_cierre', '', 2, 52, 1, 27),
(54, 'Rentabilidad', 'rentabilidad_general', '', 2, 89, 1, 31),
(55, 'Rentabilidad x Programa', 'rentabilidad', '', 2, 90, 1, 31),
(56, 'Reporte', 'inventario_exportar', '', 2, 65, 1, 42),
(57, 'Detalle Reporte', 'inventario_exportar_detalle', '', 2, 66, 1, 42),
(58, 'Inventario', 'inventario', '', 2, 61, 0, 42),
(59, 'Liberar', 'inventario_listadoliberar', '', 2, 63, 1, 42);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
