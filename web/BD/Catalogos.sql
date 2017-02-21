-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2016 at 01:28 AM
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
-- Dumping data for table `Catalogos`
--

INSERT INTO `Catalogos` (`id`, `programa_id`, `estado_id`, `tipo_id`, `pais_id`, `usuario_id`, `nombre`, `descripcion`, `valorPunto`, `puntosMaximos`, `fechaModificacion`) VALUES
(1, 1, 2, 1, 1, NULL, 'DEMO', 'Catalogo de Demostración', 1000, 30000, NULL),
(4, 3, 2, 1, 1, NULL, 'Pits Administrador prueba.', 'prueba', 0, 23, NULL),
(5, 3, 2, 1, 1, NULL, 'Pits isleros ', 'Catalogo para Isleros', 0, 21, NULL),
(6, 4, 2, 1, 1, NULL, 'Chc-Boehringer-Participante', 'Chc-Boehringer-Participante', 0, 0, NULL),
(7, 4, 2, 1, 1, NULL, 'Chc-Boehringer-Chequera', 'Chc-Boehringer-Chequera ', 0, 0, NULL),
(8, 4, 2, 1, 1, NULL, 'Los cuatro Fantasticos', 'Programa de Incentivos ', 0, 0, NULL),
(9, 3, 2, 1, 1, NULL, 'Pits Administrador', 'Catalogo Pits administrador', 0, 23, NULL),
(13, 8, 2, 1, 1, NULL, 'Consorcio express Mecanicos y Lef', 'Programa de incentivo', 0, 600, NULL),
(14, 9, 2, 1, 1, NULL, 'Kelloggs', 'Programa de incentivos', 488, 1990, NULL),
(15, 10, 1, 1, 1, NULL, 'Directv', 'Programa de incentivos', 719, 1619, NULL),
(16, 11, 2, 2, 1, NULL, 'Alqueria', 'Programa de incentivos', 92, 26660, NULL),
(17, 8, 2, 1, 1, NULL, 'Consorcio express Operadores', 'programa de incentivos', 300, 750, NULL),
(18, 17, 1, 1, 1, NULL, 'PEPSICO SOCIO ESTRELLA', 'PROGRAMA DE INCENTIVOS', 0, 0, NULL),
(19, 14, 1, 1, 1, NULL, 'BDF A LA FIJA', 'Programa de incentivos', 0, 0, NULL),
(20, 12, 1, 1, 1, NULL, 'mondelez', 'Programa de incentivos', 0, 0, NULL),
(21, 16, 2, 1, 1, NULL, 'POSTOBON', 'Programa de incentivos', 0, 0, NULL),
(22, 18, 2, 1, 1, NULL, 'Brinsa premium', 'programa de incentivos', 0, 0, NULL),
(23, 19, 2, 1, 1, NULL, 'Brinsa club', 'programa de incentivos', 0, 0, NULL),
(24, 20, 1, 1, 1, NULL, 'Nutresa Autoservicio Colaborativo', 'Programa de incentivos', 120000, 18, NULL),
(25, 20, 1, 1, 1, NULL, 'Nutresa autoservicios Plan de negocio', 'Programa de incentivos', 65000, 15, NULL),
(26, 21, 1, 1, 1, NULL, 'Fanatikos', 'Programa de incentivos', 0, 0, NULL),
(27, 22, 1, 1, 9, NULL, 'Catálogo Conquistadores QBE', 'Premios de diversas categorías para el programa Conquistadores QBE. Los premios están en dólares', 1, 15598, NULL),
(28, 15, 2, 3, 1, NULL, 'Dependientes Diamante', 'Catálogo de puntos, Diamante', 44000, 16000, NULL),
(29, 15, 2, 3, 1, NULL, 'Dependientes plata', 'Dependientes plata', 22222, 16000, NULL),
(30, 15, 2, 3, 1, NULL, 'Dependientes Oro', 'Dependientes Oro', 33333, 16000, NULL),
(31, 15, 2, 3, 1, NULL, 'Dueños  diamante', 'Dueños  diamante', 175000, 16000, NULL),
(32, 15, 2, 3, 1, NULL, 'Dueños  plata', 'Dueños  plata', 125000, 16000, NULL),
(33, 15, 2, 3, 1, NULL, 'Dueños  Oro', 'Dueños  Oro', 75000, 16000, NULL),
(34, 23, 2, 3, 1, NULL, 'Casaluker Comercial', 'Catalogo de redención de puntos', 5000, 690, NULL),
(35, 25, 2, 1, 1, NULL, 'CasaLuker Águilas', 'Catalogo de redención de puntos', 5000, 690, NULL),
(36, 24, 2, 3, 1, NULL, 'CasaLuker Mercaderistas', 'Catálogo de redención de puntos', 1500, 2200, NULL),
(37, 23, 2, 1, 1, NULL, 'p lina', 'prueba', 5000, 100000, NULL),
(38, 26, 1, 2, 1, NULL, 'La Liga Hero administradores', 'Catalogo de redención de puntos', 35353, 40, NULL),
(39, 26, 1, 2, 1, NULL, 'La Liga Hero asesores ', 'Catalogo de redención de puntos.', 50000, 16, NULL),
(40, 27, 2, 1, 1, NULL, 'Prueba', 'Prueba', 13000, 2000, NULL),
(41, 29, 2, 1, 1, NULL, 'Prueba', 'Prueba', 1000, NULL, NULL),
(42, 30, 1, 2, 1, NULL, 'Expedición al éxito Categoría 1', 'Catalogo redención de puntos', 136, 149, NULL),
(43, 30, 1, 2, 1, NULL, 'Expedición al éxito Categoría 2', 'Catalogo redención de puntos', 102, 112, NULL),
(44, 30, 1, 2, 1, NULL, 'Expedición al éxito Categoría 3', 'Catalogo de redención de puntos', 102, 112, NULL),
(45, 30, 1, 2, 1, NULL, 'Expedición al éxito Categoría 4', 'Catalogo de redención de puntos', 68, 75, NULL),
(46, 30, 1, 2, 1, NULL, 'Expedición al éxito Categoría 5', 'Catalogo de redención de puntos', 60, 65, NULL),
(47, 30, 1, 2, 1, NULL, 'Expedición al éxito Categoría 6', 'Catalogo de redención de puntos', 44, 49, NULL),
(48, 31, 1, 1, 1, NULL, 'Club Huggies', 'Catalogo', 0, 0, NULL),
(49, 32, 2, 1, 1, NULL, 'Socios & Amigos Colombia', 'Tiqueteadores Colombia', 271, NULL, NULL),
(50, 35, 1, 3, 1, NULL, 'Tiendas Bogota Nutresa', 'Catalogo de sellos de experiencias', 35000, 4, NULL),
(51, 35, 1, 3, 1, NULL, 'Tiendas Barranquilla Nutresa', 'Catalogo de redención de sellos', 35000, 4, NULL),
(52, 35, 1, 3, 1, NULL, 'Tiendas Pereira  Nutresa', 'Catalogo de redención de sellos', 35000, 4, NULL),
(53, 35, 1, 3, 1, NULL, 'Tiendas Manizales  Nutresa', 'Catalogo redención de sellos', 35000, 4, NULL),
(54, 32, 1, 1, 22, NULL, 'Curazao', 'Catalogo de redención de puntos', 0.132195, 1000000000, NULL),
(55, 35, 1, 3, 1, NULL, 'Tiendas Armenia  Nutresa', 'Catalogo de redención de puntos', 35000, 4, NULL),
(56, 32, 1, 1, 23, NULL, 'Canada', 'Catalogo de redencion de puntos', 0.13219512, 10000000, NULL),
(57, 32, 1, 1, 8, NULL, 'Costa Rica', 'Catalogo de redencion de puntos', 0.13219512, 10000000, NULL),
(58, 32, 1, 1, 9, NULL, 'Ecuador', 'Catalogo de redencion de puntos', 0.13219512, 10000000, NULL),
(59, 32, 1, 1, 10, NULL, 'El Salvador', 'Catalogo de redencion de puntos', 0.13219512, 10000000, NULL),
(60, 32, 1, 1, 2, NULL, 'USA', 'Catalogo de redencion de puntos', 0.13219512, 10000000, NULL),
(61, 32, 1, 1, 12, NULL, 'Guatemala', 'Catalogo de redencion de puntos', 0.13219512, 10000000, NULL),
(62, 32, 1, 1, 13, NULL, 'Honduras', 'Catalogo de redencion de puntos', 0.13219512, 10000000, NULL),
(63, 32, 1, 1, 14, NULL, 'México', 'Catalogo de redencion de puntos', 0.13219512, 10000000, NULL),
(64, 32, 1, 1, 15, NULL, 'Nicaragua', 'Catalogo de redencion de puntos', 0.13219512, 10000000, NULL),
(65, 32, 1, 1, 16, NULL, 'Panama', 'Catalogo de redencion de puntos', 0.13219512, 10000000, NULL),
(66, 32, 1, 1, 18, NULL, 'Peru', 'Catalogo de redencion de puntos', 0.13219512, 10000000, NULL),
(67, 32, 1, 1, 19, NULL, 'República Dominicana', 'Catalogo de redencion de puntos', 0.13219512, 10000000, NULL),
(68, 10, 1, 1, 1, NULL, 'Catalogo Directv 2015', 'Catalogo de redención de puntos', 0.3, 1619, NULL),
(69, 37, 1, 1, 1, NULL, 'Catalogo Allus', 'Catalogo de redención de puntos', 719.205, 1619, NULL),
(70, 32, 1, 1, 22, NULL, 'Aruba', 'Catalogo de redención de puntos', 0.132195, 100000000, NULL),
(71, 38, 1, 2, 1, NULL, 'incentivate Catalogo 1  rango 1', 'interno', 77, 12500, NULL),
(72, 38, 1, 2, 1, NULL, 'incentivate Catalogo2 rango 2', 'interno', 115, 12500, NULL),
(73, 38, 1, 2, 1, NULL, 'incentivate Catalogo 3 rango 3', 'Interno', 177, 12500, NULL),
(74, 40, 1, 1, 1, NULL, 'McCain Oro ', 'Catalogo de redención de puntos', 5, 100000000, NULL),
(75, 40, 1, 1, 1, NULL, 'McCain Plata', 'Catalogo de redención de puntos', 5, 10000000, NULL),
(76, 40, 1, 1, 1, NULL, 'McCain Bronce', 'Catalogo de redención de puntos', 5, 10000, NULL),
(77, 42, 2, 1, 1, NULL, 'Ganas Porque Ganas 2016', 'Catalogo de redención de puntos', 5000, 30, NULL),
(78, 43, 1, 3, 1, NULL, 'Tu socio te premia Bogota ', 'catalogo de redención de puntos', 1, 100000000, NULL),
(79, 44, 1, 3, 1, NULL, 'DUEÑOS DIAMANTE 2016', 'catalogo de pre redenciones', 1, 500000, NULL),
(80, 44, 1, 3, 1, NULL, 'DUEÑOS ORO 2016', 'Catalogo de  pre redenciones', 1, 400000, NULL),
(81, 44, 1, 3, 1, NULL, 'DUEÑOS PLATA  2016', 'Catalogo de pre redenciones', 1, 240000, NULL),
(82, 45, 1, 3, 1, NULL, 'DEPENDIENTE  DIAMANTE 2016', 'Catalogo redención de puntos', 1, 25, NULL),
(83, 45, 1, 3, 1, NULL, 'DEPENDIENTE ORO  2016', 'Catalogo redención de puntos', 1, 19, NULL),
(84, 45, 1, 3, 1, NULL, 'DEPENDIENTE PLATA 2016', 'Catalogo de redención de puntos', 1, 13, NULL),
(85, 46, 1, 3, 1, NULL, 'Nutresa Mayoristas Cliente tipo A  2016', 'Catalogo de  premios inmediatos', 1, 100000000, NULL),
(86, 47, 1, 3, 1, NULL, 'Salimos con toda 2016', 'Catalogo de redención de puntos (kms)', 85, 4500, NULL),
(87, 48, 2, 3, 1, NULL, 'Av Bussines', 'catalogo Av Bussines', 1, 100000000, NULL),
(88, 49, 1, 3, 1, NULL, 'Edenred', 'catalogo edenred', 1, 100000000, NULL),
(89, 50, 2, 3, 1, NULL, 'Catalogo Maritz', 'catalogo maritz', 1, 10000000, NULL),
(90, 51, 1, 3, 1, NULL, 'Nutresa Superetes Plan de negocios ', 'Plan de negocios \r\n\r\n', 1, 100000000, NULL),
(91, 51, 1, 3, 1, NULL, 'Nutresa Superetes Colaborativo', 'catalogo de redención de estrellas', 1, 15, NULL),
(92, 55, 2, 1, 1, NULL, 'Conectados con SanoFI', 'catalogo de redención de puntos', 800, 100000000, NULL),
(93, 59, 1, 3, 6, NULL, 'Pits Copec', 'Programa dirigido a los atendedores de las estaciones de servicio de Chile', 0, 100000000000, NULL),
(94, 39, 1, 1, 1, NULL, 'Colombia Socios y Amigos', 'catalogo de redencion de puntos', 271, 100000000, NULL),
(95, 66, 1, 1, 1, NULL, 'Preferidos – Asesores Comerciales ', 'Redención de billetes.', 30, NULL, NULL),
(96, 66, 2, 1, 1, NULL, 'Preferidos Platinum', 'Catalogo de redención de billetes', 60, NULL, NULL),
(97, 66, 2, 1, 1, NULL, 'Preferidos Gold', 'Catalogo de redención de Billetes', 70, 3457143, NULL),
(98, 66, 2, 1, 1, NULL, 'Preferidos Silver', 'Catalogo redención de Billetes', 80, 37500, NULL),
(99, 65, 1, 1, 1, NULL, 'A LA FIJA 2016', 'Programa de incentivos', 0, 0, NULL),
(100, 67, 2, 3, 1, NULL, 'Sello Rojo', 'catalogo para vendedores', 1, 1000, NULL),
(101, 67, 1, 3, 1, NULL, 'Consumo Local Panaderías', 'Catalogo para dueños de panaderías', 1, 1000, NULL),
(102, 68, 1, 3, 1, NULL, 'WOW silver', 'Catalogo para clinicas veterinarias y pet shops', 0, 3, NULL),
(103, 68, 1, 3, 1, NULL, 'WOW Gold', 'Catalogo para clínicas Veterinarias y Pets shops', 0, 3, NULL),
(104, 68, 1, 3, 1, NULL, 'WOW Premium', 'Catalogo para clínicas Veterinarias y Pets shops', 0, 3, NULL),
(105, 68, 1, 3, 1, NULL, 'WOW shoppers', 'Catalogo para compradores de clínicas veterinarias', 0, 3, NULL),
(106, 69, 1, 1, 1, NULL, 'Preferidos', 'Catálogo para redención de puntos para Referidos y Clientes.', 50, 400000, NULL),
(107, 72, 1, 2, 1, NULL, 'Expedición Totto Categoría 1', 'Catalogo de redención de totto coins Para director de tiendas nacional.\r\n\r\n', 0, 0, NULL),
(108, 73, 1, 3, 1, NULL, 'Minimercados Pereira', 'catalogo de redención', 1, 0, NULL),
(109, 46, 1, 3, 1, NULL, 'Nutresa Mayoristas Cliente tipo B 2016', 'Catalogo de premios inmediatos', 1, 100000000, NULL),
(110, 46, 1, 3, 1, NULL, 'Nutresa Mayoristas Cliente tipo C  2016', 'Catalogo de  premios inmediatos', 1, 100000000, NULL),
(111, 75, 1, 1, 1, NULL, 'Fuerza Elite Oro', 'Catalogo de redención de puntos', 63, 90000, NULL),
(112, 75, 1, 1, 1, NULL, 'Fuerza Elite Plata', 'Catalogo de redención de puntos', 67, 60000, NULL),
(113, 75, 1, 1, 1, NULL, 'Fuerza Elite Bronce', 'Catalogo redención de puntos', 100, 30000, NULL),
(114, 72, 1, 2, 1, NULL, 'Expedición totto Categoria 2 ', 'Catalogo de redención de totto coins  Directores cadenas - director distribuidores.						\r\n', 0, 0, NULL),
(115, 66, 1, 1, 1, NULL, 'Preferidos – Directores de Oficina', 'redención de billetes', 40, NULL, NULL),
(116, 66, 1, 1, 1, NULL, 'Preferidos – Directores Regionales', 'catalogo de redención de billetes', 50, NULL, NULL),
(117, 59, 1, 3, 1, NULL, 'Pits Copec Administradores', 'Programa dirigido a los Administradores de las estaciones de servicio de Chile.', 0, 100000000, NULL),
(118, 72, 1, 2, 1, NULL, 'Expedición totto Categoria 3', 'Catalogo de redención de totto coins  Director Negocios - Director de Franquicias.', 1, 10000, NULL),
(119, 72, 1, 2, 1, NULL, 'Expedición Totto Categoría 4', 'Catalogo de redención de totto coins  Jefe Comercial - Jefe Rocka', 1, 10000000, NULL),
(120, 72, 1, 2, 1, NULL, 'Expedición totto Categoria 5', 'Catalogo de redención de totto coins Administrador- Administrador mck - Administrador fts - Administrador mck-Concesión - Coordinador Franquicia - Ejecutivo Cadenas - Ejecutivo.', 1, 100000000, NULL),
(121, 72, 1, 2, 1, NULL, 'Expedición totto Categoria 6', 'Catalogo de redención de totto coins Directores cadenas - Director distribuidores. Vendedor - Vendedor concesión - Cajero - Auxiliar logistico - Auxiliar prevención - Mercaderista.', 1, 100000000, NULL);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
