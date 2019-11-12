-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2019 a las 00:42:34
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_post`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `CodArticulo` varchar(8) NOT NULL,
  `CodCategoria` varchar(8) NOT NULL,
  `NombreArticulo` varchar(50) NOT NULL,
  `Precio` decimal(11,2) NOT NULL,
  `Stock` int(11) NOT NULL DEFAULT '0',
  `CodBarra` varchar(15) DEFAULT NULL,
  `Detalle` varchar(100) DEFAULT NULL,
  `Imagen` varchar(200) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(8) DEFAULT NULL,
  `updated_by` varchar(8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`CodArticulo`, `CodCategoria`, `NombreArticulo`, `Precio`, `Stock`, `CodBarra`, `Detalle`, `Imagen`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('10', '13', 'Cerveza Imperial Lata 355 ml', '700.00', 0, '2521213', 'N/A', '', 1, '1', '1', '2018-12-20 21:13:00', '2019-02-21 16:07:06'),
('11', '11', 'Manzana Roja', '320.00', 0, '1', 'N/A', '', 1, '1', '1', '2018-11-12 19:05:32', '2019-02-22 02:17:05'),
('12', '10', 'Jabon Irex 500 gr', '650.00', 0, '751232010', 'N/A', '', 1, '1', '1', '2018-11-29 02:59:40', '2019-02-22 02:17:09'),
('13', '12', 'Cable USB 3.0 1 Mt', '2000.00', 0, '1002315110', 'Electronicos', '', 1, '4', '4', '2019-02-24 02:31:31', '2019-02-24 02:31:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `CodCategoria` varchar(8) NOT NULL,
  `NombreCategoria` varchar(50) NOT NULL,
  `Detalle` varchar(100) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(8) DEFAULT NULL,
  `updated_by` varchar(8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`CodCategoria`, `NombreCategoria`, `Detalle`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('10', 'Detergentes', 'Notas', 1, '1', '1', '2018-11-01 03:33:09', '2019-02-21 16:04:29'),
('11', 'Frutas', 'N/A', 1, '1', '1', '2018-10-31 03:30:29', '2019-02-21 16:04:32'),
('12', 'Herramientas', 'N/A', 1, '1', '1', '2018-10-31 03:57:25', '2019-02-19 07:32:54'),
('13', 'Licores', 'N/A', 1, '1', '1', '2018-11-08 00:49:11', '2019-02-19 07:33:00'),
('14', 'Pruebas TI', 'Pruebas TI', 1, '1', '4', '2018-11-08 02:26:49', '2019-02-23 17:41:31'),
('15', 'Enlatados', 'Productos enlatados', 1, '1', '1', '2019-02-22 05:08:12', '2019-02-22 05:08:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `CodDepartamento` varchar(8) NOT NULL,
  `NombreDepartamento` varchar(70) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(8) DEFAULT NULL,
  `updated_by` varchar(8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`CodDepartamento`, `NombreDepartamento`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('101', 'RRHH', 1, '1', '1', '2018-12-20 03:21:51', '2018-12-25 16:02:46'),
('102', 'IT Departments', 1, '1', '1', '2018-12-20 03:03:05', '2018-12-25 16:02:49'),
('103', 'Recursos Humanos RRHH', 1, '1', '1', '2018-12-20 03:21:20', '2018-12-26 19:22:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleingreso`
--

CREATE TABLE `detalleingreso` (
  `IDDetalleIngreso` int(11) NOT NULL,
  `CodIngreso` int(11) NOT NULL,
  `CodArticulo` varchar(8) NOT NULL,
  `Cantidad` int(4) NOT NULL,
  `PrecioCompra` decimal(11,2) NOT NULL,
  `PrecioVenta` decimal(11,2) NOT NULL,
  `Estado` varchar(10) NOT NULL DEFAULT 'Activo',
  `created_by` varchar(8) NOT NULL DEFAULT '1',
  `updated_by` varchar(8) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleingreso`
--

INSERT INTO `detalleingreso` (`IDDetalleIngreso`, `CodIngreso`, `CodArticulo`, `Cantidad`, `PrecioCompra`, `PrecioVenta`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 2, '12', 1, '1.00', '1.00', 'Activo', '1', '1', '2019-03-08 23:03:41', '2019-03-08 23:03:41'),
(3, 2, '11', 10, '150.00', '200.00', 'Activo', '1', '1', '2019-03-08 23:05:26', '2019-03-08 23:05:26'),
(4, 2, '12', 11, '15.00', '25.00', 'Activo', '1', '1', '2019-03-08 23:05:27', '2019-03-08 23:05:27'),
(5, 2, '13', 7, '25.00', '28.00', 'Activo', '1', '1', '2019-03-08 23:05:27', '2019-03-08 23:05:27'),
(6, 2, '10', 8, '125.00', '145.00', 'Activo', '1', '1', '2019-03-08 23:05:27', '2019-03-08 23:05:27'),
(7, 2, '11', 15, '255.00', '275.00', 'Activo', '4', '4', '2019-03-08 23:19:27', '2019-03-08 23:19:27'),
(8, 2, '12', 10, '300.00', '350.00', 'Activo', '4', '4', '2019-03-08 23:19:27', '2019-03-08 23:19:27'),
(9, 12, '12', 10, '15.00', '25.00', 'Activo', '4', '4', '2019-03-08 19:52:15', '2019-03-08 19:52:15'),
(10, 13, '11', 10, '200.00', '350.00', 'Activo', '4', '4', '2019-03-08 19:54:31', '2019-03-08 19:54:31'),
(11, 13, '10', 20, '550.00', '1100.00', 'Activo', '4', '4', '2019-03-08 19:54:31', '2019-03-08 19:54:31'),
(12, 13, '12', 15, '200.00', '350.00', 'Activo', '4', '4', '2019-03-08 19:54:31', '2019-03-08 19:54:31'),
(13, 13, '13', 8, '900.00', '1500.00', 'Activo', '4', '4', '2019-03-08 19:54:31', '2019-03-08 19:54:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleingresoaux`
--

CREATE TABLE `detalleingresoaux` (
  `IDDetalleIngresoAux` int(11) NOT NULL,
  `CodIngreso` int(11) NOT NULL,
  `CodArticulo` varchar(8) NOT NULL,
  `Cantidad` int(4) NOT NULL,
  `PrecioCompra` decimal(11,2) NOT NULL,
  `PrecioVenta` decimal(11,2) NOT NULL,
  `created_by` varchar(8) NOT NULL,
  `sessionid` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresomaterias`
--

CREATE TABLE `ingresomaterias` (
  `CodIngreso` int(11) NOT NULL,
  `CodProveedor` varchar(8) NOT NULL,
  `TipoComprobante` varchar(20) NOT NULL,
  `SerieComprobante` varchar(20) DEFAULT NULL,
  `NumeroComprobante` varchar(20) NOT NULL,
  `FechaComprobante` datetime NOT NULL,
  `Impuesto` decimal(4,2) NOT NULL,
  `TotalCompra` decimal(11,2) NOT NULL,
  `Estado` varchar(10) NOT NULL DEFAULT 'Activo',
  `created_by` varchar(8) DEFAULT '1',
  `updated_by` varchar(8) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ingresomaterias`
--

INSERT INTO `ingresomaterias` (`CodIngreso`, `CodProveedor`, `TipoComprobante`, `SerieComprobante`, `NumeroComprobante`, `FechaComprobante`, `Impuesto`, `TotalCompra`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, '11', 'Factura', '10', '10', '2019-02-23 00:00:00', '13.00', '2.00', 'Anulado', '4', '4', '2019-02-23 23:32:37', '2019-03-06 02:16:19'),
(3, '11', 'Factura', '7', '7', '2019-03-05 00:00:00', '13.00', '1.00', 'Anulado', '1', '1', '2019-03-06 02:27:13', '2019-03-06 02:36:55'),
(4, '11', 'Factura', '8', '8', '2019-03-05 00:00:00', '13.00', '1.00', 'Anulado', '1', '1', '2019-03-06 02:37:59', '2019-03-06 19:10:26'),
(5, '11', 'Factura', '9', '9', '2019-03-05 00:00:00', '13.00', '30.00', 'Anulado', '1', '1', '2019-03-06 02:38:41', '2019-03-06 19:10:23'),
(6, '11', 'Factura', '15', '15', '2019-02-05 00:00:00', '13.00', '2.00', 'Anulado', '1', '1', '2019-03-06 19:09:51', '2019-03-06 19:10:41'),
(7, '11', 'Factura', '16', '16', '2019-03-06 00:00:00', '13.00', '1.00', 'Anulado', '1', '1', '2019-03-06 22:54:47', '2019-03-08 19:49:07'),
(9, '11', 'Factura', '33', '33', '2019-03-08 00:00:00', '13.00', '1.00', 'Anulado', '4', '4', '2019-03-08 23:37:21', '2019-03-08 19:51:39'),
(10, '10', 'Factura', '34', '34', '2019-03-08 00:00:00', '13.00', '3620.00', 'Anulado', '4', '4', '2019-03-08 23:39:03', '2019-03-08 19:51:43'),
(11, '11', 'Factura', '41', '41', '2019-03-08 00:00:00', '13.00', '150.00', 'Anulado', '4', '4', '2019-03-08 19:49:38', '2019-03-08 19:51:49'),
(12, '11', 'Factura', '42', '42', '2019-03-08 00:00:00', '13.00', '150.00', 'Activo', '4', '4', '2019-03-08 19:52:15', '2019-03-08 19:52:15'),
(13, '10', 'Factura', '43', '43', '2019-03-08 00:00:00', '13.00', '23200.00', 'Activo', '4', '4', '2019-03-08 19:54:31', '2019-03-08 19:54:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menuclasificaciones`
--

CREATE TABLE `menuclasificaciones` (
  `IDMenuClasificacion` int(11) NOT NULL,
  `NombreMenuClasifica` varchar(50) NOT NULL,
  `Estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `CodPermiso` varchar(8) NOT NULL,
  `NombrePermiso` varchar(50) NOT NULL,
  `Detalle` varchar(70) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(8) DEFAULT NULL,
  `updated_by` varchar(8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`CodPermiso`, `NombrePermiso`, `Detalle`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1', 'Consultas Compras', 'N/A', 1, '1', '1', '2019-02-19 07:10:59', '2019-02-19 07:28:04'),
('10', 'Mantenimiento de Puestos', 'N/A', 1, '1', '1', '2019-01-09 18:37:11', '2019-02-19 07:30:56'),
('11', 'Mantenimiento de Roles', 'N/A', 1, '1', '1', '2019-01-09 18:48:20', '2019-02-19 07:31:05'),
('12', 'Mantenimiento de Usuarios', 'N/A', 1, '1', '1', '2019-01-09 18:40:39', '2019-02-19 07:31:12'),
('13', 'Modulo Ventas', 'N/A', 1, '1', '1', '2019-01-04 04:57:03', '2019-02-19 07:31:23'),
('2', 'Consultas Ventas', 'N/A', 1, '1', '1', '2019-01-04 05:10:57', '2019-02-19 07:28:09'),
('3', 'Mantenimiento de Articulos', 'N/A', 1, '1', '1', '2019-01-09 18:48:20', '2019-02-19 07:29:53'),
('4', 'Mantenimiento de Categorias', 'N/A', 1, '1', '1', '2019-01-09 18:38:01', '2019-02-19 07:30:00'),
('5', 'Mantenimiento de Departamentos', 'N/A', 1, '1', '1', '2019-01-09 18:40:00', '2019-02-19 07:30:06'),
('6', 'Mantenimiento de Facturas', 'N/A', 1, '1', '1', '2019-01-09 18:48:20', '2019-02-19 07:30:12'),
('7', 'Mantenimiento de Password', 'N/A', 1, '1', '1', '2019-01-09 18:48:20', '2019-02-19 07:30:31'),
('8', 'Mantenimiento de Permisos', 'N/A', 1, '1', '1', '2019-01-09 18:48:20', '2019-02-19 07:30:38'),
('9', 'Mantenimiento de Proveedores', 'N/A', 1, '1', '1', '2019-01-08 02:11:57', '2019-02-19 07:30:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `CodProveedor` varchar(8) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `TipoDocumento` varchar(20) NOT NULL,
  `NumeroDocumento` varchar(30) NOT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(40) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(8) DEFAULT NULL,
  `updated_by` varchar(8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`CodProveedor`, `Nombre`, `TipoDocumento`, `NumeroDocumento`, `Direccion`, `Telefono`, `Correo`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('10', 'Needs it Tech', 'Cedula Juridica', '3103201156', 'Sta. Monica, California', '22124563', 'dashboard@yahoo.com', 1, '', '1', '2018-12-25 16:08:15', '2019-02-22 01:10:52'),
('11', 'AYA', 'Cedula Juridica', '10201314569', 'San Jose, Costa Rica', '22454223', 'xample@xample.com', 1, '1', '1', '2018-11-09 01:06:53', '2019-02-22 04:41:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `CodPuesto` varchar(8) NOT NULL,
  `NombrePuesto` varchar(70) NOT NULL,
  `CodDepartamento` varchar(8) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(8) DEFAULT NULL,
  `updated_by` varchar(8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`CodPuesto`, `NombrePuesto`, `CodDepartamento`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1001', 'Asistente TI', '102', 1, '1', '1', '2018-12-25 17:32:15', '2018-12-28 02:33:42'),
('1002', 'Tecnico de Aplicaciones', '102', 1, '1', '1', '2018-12-28 02:32:52', '2019-02-19 03:50:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `CodRole` varchar(8) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(8) DEFAULT NULL,
  `updated_by` varchar(8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`CodRole`, `Nombre`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('10', 'Usuario Estandar', 1, '1', '1', '2018-12-28 03:58:52', '2018-12-28 03:58:52'),
('11', 'Supervisor', 1, '1', '1', '2018-12-28 03:58:52', '2019-01-09 03:32:39'),
('12', 'Cajero', 1, '4', '4', '2019-03-09 20:58:49', '2019-03-09 20:58:49'),
('13', 'Auxiliar', 1, '4', '4', '2019-03-09 21:02:20', '2019-03-09 21:02:20'),
('9', 'Administradors', 1, '1', '4', '2019-01-24 03:35:45', '2019-03-09 21:52:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolepermiso`
--

CREATE TABLE `rolepermiso` (
  `CodRolePermiso` int(11) NOT NULL,
  `CodRole` varchar(8) NOT NULL,
  `CodPermiso` varchar(8) NOT NULL,
  `created_by` varchar(8) DEFAULT NULL,
  `updated_by` varchar(8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rolepermiso`
--

INSERT INTO `rolepermiso` (`CodRolePermiso`, `CodRole`, `CodPermiso`, `created_by`, `updated_by`, `created_at`, `updated_at`, `Estado`) VALUES
(1, '9', '1', '1', '1', '2019-02-21 15:57:04', '2019-02-21 15:57:04', 1),
(2, '9', '2', '1', '1', '2019-02-21 15:57:04', '2019-02-21 15:57:04', 1),
(3, '9', '3', '1', '1', '2019-02-21 16:00:41', '2019-02-21 16:00:41', 1),
(5, '9', '5', '1', '1', '2019-02-21 16:00:41', '2019-02-21 16:00:41', 1),
(6, '9', '6', '1', '1', '2019-02-21 16:00:41', '2019-02-21 16:00:41', 1),
(7, '9', '7', '1', '1', '2019-02-21 16:00:41', '2019-02-21 16:00:41', 1),
(8, '9', '8', '1', '1', '2019-02-21 16:00:41', '2019-02-21 16:00:41', 1),
(9, '9', '9', '1', '1', '2019-02-21 16:00:41', '2019-02-21 16:00:41', 1),
(10, '9', '10', '1', '1', '2019-02-21 16:00:42', '2019-02-21 16:00:42', 1),
(11, '9', '11', '1', '1', '2019-02-21 16:00:42', '2019-02-21 16:00:42', 1),
(12, '9', '12', '1', '1', '2019-02-21 16:00:42', '2019-02-21 16:00:42', 1),
(13, '9', '13', '1', '1', '2019-02-21 16:00:42', '2019-02-21 16:00:42', 1),
(14, '10', '1', '4', '4', '2019-02-26 06:53:17', '2019-02-26 06:53:17', 1),
(15, '10', '2', '4', '4', '2019-02-26 06:53:23', '2019-02-26 06:53:23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `submenu`
--

CREATE TABLE `submenu` (
  `IDSubMenu` int(11) NOT NULL,
  `NumSubMenu` int(11) NOT NULL,
  `NombreSubMenu` varchar(50) NOT NULL,
  `Estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `submenu`
--

INSERT INTO `submenu` (`IDSubMenu`, `NumSubMenu`, `NombreSubMenu`, `Estado`) VALUES
(1, 1, 'Desayunos', 1),
(2, 2, 'Almuerzos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subsubmenu`
--

CREATE TABLE `subsubmenu` (
  `IDSubSubMenu` int(11) NOT NULL,
  `IDSubMenu` int(11) NOT NULL,
  `CodArticulo` varchar(8) NOT NULL,
  `Detalle1` varchar(12) NOT NULL,
  `Detalle2` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subsubmenu`
--

INSERT INTO `subsubmenu` (`IDSubSubMenu`, `IDSubMenu`, `CodArticulo`, `Detalle1`, `Detalle2`) VALUES
(7, 1, '11', 'Prueba 1', 'Prueba 1'),
(8, 2, '11', 'Manzana', 'roja grand'),
(9, 2, '10', 'Imperial', '355 Vidrio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subsubmenuaux`
--

CREATE TABLE `subsubmenuaux` (
  `IDSubSubMenu` int(11) NOT NULL,
  `IDSubMenu` int(11) NOT NULL,
  `CodArticulo` varchar(8) NOT NULL,
  `Detalle1` varchar(12) NOT NULL,
  `Detalle2` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subsubmenuaux`
--

INSERT INTO `subsubmenuaux` (`IDSubSubMenu`, `IDSubMenu`, `CodArticulo`, `Detalle1`, `Detalle2`) VALUES
(1, 1, '11', 'Prueba', 'Prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipohorario`
--

CREATE TABLE `tipohorario` (
  `CodTipoHorario` varchar(8) NOT NULL,
  `NombreHorario` varchar(30) NOT NULL,
  `DetalleHorario` varchar(40) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(8) NOT NULL,
  `updated_by` varchar(8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipohorario`
--

INSERT INTO `tipohorario` (`CodTipoHorario`, `NombreHorario`, `DetalleHorario`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1', 'Nocturno', '1s', 1, '1', '1', '2019-02-21 15:54:35', '2019-02-21 15:54:42'),
('2', 'Diurnos', 'N/As', 1, '1', '1', '2019-02-21 15:43:09', '2019-02-21 15:47:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `CodUsuario` varchar(8) NOT NULL,
  `NombreCompleto` varchar(70) NOT NULL,
  `TipoDocumento` varchar(20) NOT NULL,
  `NumeroDocumento` varchar(30) NOT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(20) DEFAULT NULL,
  `CodPuesto` varchar(8) DEFAULT NULL,
  `CodRole` varchar(8) DEFAULT NULL,
  `NombreUsuario` varchar(20) NOT NULL,
  `Contrasenia` varchar(100) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(8) DEFAULT NULL,
  `updated_by` varchar(8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`CodUsuario`, `NombreCompleto`, `TipoDocumento`, `NumeroDocumento`, `Direccion`, `Telefono`, `Correo`, `CodPuesto`, `CodRole`, `NombreUsuario`, `Contrasenia`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1', 'Alfred Thommas', 'Cedula Fisica', '501230102', 'San Jose', '22003212', 'alfred@dipcmi.co.cr', '1001', '10', 'alfredt501', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, '1', '1', '2018-11-01 04:10:10', '2019-02-22 04:43:33'),
('2', 'Cesar Zapata Solar', 'Cedula Fisica', '203210124', 'San Jose, Costa Rica', '22602210', 'cesar@gmail.com', '1002', '11', 'cesarz203', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 0, '1', '1', '2019-01-04 03:29:11', '2019-02-22 04:43:03'),
('3', 'Maria Estrada Campos', 'Cedula Fisica', '201230201', 'San Jose', '22124545', 'maira.estrada.c@gmai', '1001', '10', 'mariae201', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 0, '1', '1', '2019-01-09 02:42:03', '2019-02-22 04:43:23'),
('4', 'David Guti Sol', 'Cedula Fisica', '603650408', 'Sta Rita', '60601212', 'masonhsp@yahoo.com', '1002', '9', 'dgutierrez603', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, '1', '1', '2019-02-18 15:54:58', '2019-02-19 06:41:18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`CodArticulo`),
  ADD KEY `CodCategoria` (`CodCategoria`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CodCategoria`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`CodDepartamento`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `detalleingreso`
--
ALTER TABLE `detalleingreso`
  ADD PRIMARY KEY (`IDDetalleIngreso`),
  ADD KEY `CodIngreso` (`CodIngreso`),
  ADD KEY `CodArticulo` (`CodArticulo`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `ingresomaterias`
--
ALTER TABLE `ingresomaterias`
  ADD PRIMARY KEY (`CodIngreso`),
  ADD KEY `CodProveedor` (`CodProveedor`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `menuclasificaciones`
--
ALTER TABLE `menuclasificaciones`
  ADD PRIMARY KEY (`IDMenuClasificacion`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`CodPermiso`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`CodProveedor`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`CodPuesto`),
  ADD KEY `CodDepartamento` (`CodDepartamento`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`CodRole`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `rolepermiso`
--
ALTER TABLE `rolepermiso`
  ADD PRIMARY KEY (`CodRolePermiso`),
  ADD KEY `CodRole` (`CodRole`),
  ADD KEY `CodPermiso` (`CodPermiso`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`IDSubMenu`),
  ADD UNIQUE KEY `NumSubMenu` (`NumSubMenu`);

--
-- Indices de la tabla `subsubmenu`
--
ALTER TABLE `subsubmenu`
  ADD PRIMARY KEY (`IDSubSubMenu`),
  ADD KEY `IDSubMenu` (`IDSubMenu`),
  ADD KEY `CodArticulo` (`CodArticulo`);

--
-- Indices de la tabla `subsubmenuaux`
--
ALTER TABLE `subsubmenuaux`
  ADD PRIMARY KEY (`IDSubSubMenu`),
  ADD KEY `IDSubMenu` (`IDSubMenu`),
  ADD KEY `CodArticulo` (`CodArticulo`);

--
-- Indices de la tabla `tipohorario`
--
ALTER TABLE `tipohorario`
  ADD PRIMARY KEY (`CodTipoHorario`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`CodUsuario`),
  ADD KEY `CodPuesto` (`CodPuesto`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `CodRole` (`CodRole`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalleingreso`
--
ALTER TABLE `detalleingreso`
  MODIFY `IDDetalleIngreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ingresomaterias`
--
ALTER TABLE `ingresomaterias`
  MODIFY `CodIngreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `menuclasificaciones`
--
ALTER TABLE `menuclasificaciones`
  MODIFY `IDMenuClasificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rolepermiso`
--
ALTER TABLE `rolepermiso`
  MODIFY `CodRolePermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `submenu`
--
ALTER TABLE `submenu`
  MODIFY `IDSubMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subsubmenu`
--
ALTER TABLE `subsubmenu`
  MODIFY `IDSubSubMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `subsubmenuaux`
--
ALTER TABLE `subsubmenuaux`
  MODIFY `IDSubSubMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleingreso`
--
ALTER TABLE `detalleingreso`
  ADD CONSTRAINT `detalleingreso_ibfk_1` FOREIGN KEY (`CodIngreso`) REFERENCES `ingresomaterias` (`CodIngreso`),
  ADD CONSTRAINT `detalleingreso_ibfk_2` FOREIGN KEY (`CodArticulo`) REFERENCES `articulo` (`CodArticulo`),
  ADD CONSTRAINT `detalleingreso_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`CodUsuario`),
  ADD CONSTRAINT `detalleingreso_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`CodUsuario`);

--
-- Filtros para la tabla `ingresomaterias`
--
ALTER TABLE `ingresomaterias`
  ADD CONSTRAINT `ingresoproducto_ibfk_1` FOREIGN KEY (`CodProveedor`) REFERENCES `proveedor` (`CodProveedor`),
  ADD CONSTRAINT `ingresoproducto_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`CodUsuario`),
  ADD CONSTRAINT `ingresoproducto_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`CodUsuario`);

--
-- Filtros para la tabla `subsubmenu`
--
ALTER TABLE `subsubmenu`
  ADD CONSTRAINT `subsubmenu_ibfk_1` FOREIGN KEY (`CodArticulo`) REFERENCES `articulo` (`CodArticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `subsubmenu_ibfk_2` FOREIGN KEY (`IDSubMenu`) REFERENCES `submenu` (`IDSubMenu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subsubmenuaux`
--
/*ALTER TABLE `subsubmenuaux`
  ADD CONSTRAINT `subsubmenuaux_ibfk_1` FOREIGN KEY (`IDSubMenu`) REFERENCES `submenu` (`IDSubMenu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `subsubmenuaux_ibfk_2` FOREIGN KEY (`CodArticulo`) REFERENCES `articulo` (`CodArticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
*/
--
-- Filtros para la tabla `tipohorario`
--
ALTER TABLE `tipohorario`
  ADD CONSTRAINT `tipohorario_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`CodUsuario`),
  ADD CONSTRAINT `tipohorario_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`CodUsuario`);
--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_ibfk_1` FOREIGN KEY (`CodCategoria`) REFERENCES `categoria` (`CodCategoria`),
  ADD CONSTRAINT `articulo_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`CodUsuario`),
  ADD CONSTRAINT `articulo_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`CodUsuario`);
--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`CodUsuario`),
  ADD CONSTRAINT `categoria_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`CodUsuario`);
--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `departamento_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`CodUsuario`),
  ADD CONSTRAINT `departamento_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`CodUsuario`);
--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`CodUsuario`),
  ADD CONSTRAINT `proveedor_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`CodUsuario`);
--
-- Filtros para la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD CONSTRAINT `puesto_ibfk_1` FOREIGN KEY (`CodDepartamento`) REFERENCES `departamento` (`CodDepartamento`),
  ADD CONSTRAINT `puesto_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`CodUsuario`),
  ADD CONSTRAINT `puesto_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`CodUsuario`);
--
-- Filtros para la tabla `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`CodUsuario`),
  ADD CONSTRAINT `role_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`CodUsuario`);
--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`CodUsuario`),
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`CodUsuario`);
--
-- Filtros para la tabla `rolepermiso`
--
ALTER TABLE `rolepermiso`
  ADD CONSTRAINT `rolepermiso_ibfk_1` FOREIGN KEY (`CodRole`) REFERENCES `role` (`CodRole`),
  ADD CONSTRAINT `rolepermiso_ibfk_2` FOREIGN KEY (`CodPermiso`) REFERENCES `permiso` (`CodPermiso`),
  ADD CONSTRAINT `rolepermiso_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`CodUsuario`),
  ADD CONSTRAINT `rolepermiso_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`CodUsuario`);
--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`CodPuesto`) REFERENCES `puesto` (`CodPuesto`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`CodRole`) REFERENCES `role` (`CodRole`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`CodUsuario`),
  ADD CONSTRAINT `usuario_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`CodUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
