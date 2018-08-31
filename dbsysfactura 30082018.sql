-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-08-2018 a las 06:20:00
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbsysfactura`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `IDArticulo` int(11) NOT NULL,
  `IDCategoria` int(11) NOT NULL,
  `Codigo` varchar(40) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Detalle` varchar(100) DEFAULT NULL,
  `Imagen` varchar(200) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`IDArticulo`, `IDCategoria`, `Codigo`, `Nombre`, `Stock`, `Detalle`, `Imagen`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Coca', '', 10, 'Nulo', NULL, 1, 1, 1, '2018-08-07 03:12:57', '2018-08-15 21:00:15'),
(2, 1, 'Arroz', '1', 10, 'Nulo', NULL, 1, 1, 1, '2018-08-07 03:25:47', '2018-08-07 03:25:47'),
(3, 1, '001', 'Pan', 8, 'Nulo', '1535107218.jpg', 1, 1, 1, '2018-08-07 03:34:21', '2018-08-24 10:40:18'),
(4, 1, '002', 'Numero 2', 6, 'Nulo', NULL, 1, 1, 1, '2018-08-07 04:17:00', '2018-08-09 03:47:04'),
(5, 1, '003', 'Nulo', 1, 'Nulo', NULL, 1, 1, 1, '2018-08-07 04:27:37', '2018-08-07 04:27:37'),
(6, 1, '003', 'Varios', 10, 'Nulo', NULL, 1, 1, 1, '2018-08-08 01:17:22', '2018-08-08 01:17:22'),
(7, 7, '123456', 'Imperial Vidrio 350 ml', 50, 'Bebida alcholica', '1534370552.jpg', 1, 1, 1, '2018-08-15 22:02:31', '2018-08-15 22:02:31'),
(8, 1, '123', 'Leche 1 L', 10, 'N/A', '1535092857.png', 1, 1, 1, '2018-08-24 06:40:56', '2018-08-24 06:40:56'),
(9, 13, '123', 'Martillo', 15, 'N/A', '', 1, 1, 1, '2018-08-24 06:48:50', '2018-08-24 06:48:50'),
(10, 1, '0011', 'Pan', 8, 'Nulo', '1535094944.jpg', 1, 1, 1, '2018-08-24 07:08:00', '2018-08-24 07:15:43'),
(11, 13, '123', 'Otro', 1, 'N/A', '1535107177.jpg', 1, 1, 1, '2018-08-24 10:39:37', '2018-08-24 10:39:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IDCategoria` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Detalle` varchar(100) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IDCategoria`, `Nombre`, `Detalle`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Frutas Verdes', 'N/A', 1, 1, 1, '2018-07-31 11:42:37', '2018-08-17 04:30:13'),
(7, 'Licores', 'Bebidas', 1, 1, 1, '2018-08-02 03:29:48', '2018-08-02 03:29:48'),
(11, 'jkshdk', 'kjsks', 0, 1, 1, '2018-08-02 03:49:46', '2018-08-15 21:50:18'),
(12, 'Nueva 1', 'Nueva 1', 0, 1, 1, '2018-08-02 03:50:29', '2018-08-15 21:50:25'),
(13, 'Herramientas', 'Varios', 1, 1, 1, '2018-08-02 04:13:41', '2018-08-02 04:13:41'),
(14, 'Categoria 10112', 'None none', 0, 1, 1, '2018-08-02 19:58:00', '2018-08-03 01:43:20'),
(15, 'Categoria 4', 'Categoria 4', 0, 1, 1, '2018-08-02 20:41:18', '2018-08-15 21:49:27'),
(16, 'Categoria 5', 'Categoria 5', 0, 1, 1, '2018-08-03 00:13:54', '2018-08-15 21:49:30'),
(17, 'Categoria 51', 'Categoria 5', 0, 1, 1, '2018-08-03 00:14:11', '2018-08-15 21:49:38'),
(18, 'Categoria 3351455', 'Nonenone', 0, 1, 1, '2018-08-03 00:23:50', '2018-08-15 21:49:21'),
(19, 'Categoria 3333355555', 'None', 0, 1, 1, '2018-08-03 00:25:21', '2018-08-15 21:49:14'),
(20, 'nuevo 23', 'nuevo23', 0, 1, 1, '2018-08-03 01:12:05', '2018-08-15 21:50:35'),
(21, 'Categoria 10', 'Nulo', 0, 1, 1, '2018-08-07 04:17:30', '2018-08-15 21:49:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `IDCliente` int(11) NOT NULL,
  `TipoPersona` varchar(20) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `TipoDocumento` varchar(20) NOT NULL,
  `NumeroDocumento` varchar(30) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(20) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`IDCliente`, `TipoPersona`, `Nombre`, `TipoDocumento`, `NumeroDocumento`, `Telefono`, `Correo`, `Direccion`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '', 'Hary Newman', 'Cedula Fisica', '503650408', '88548563', 'N/A', 'N/A', 1, 1, 1, '2018-08-31 00:50:21', '2018-08-31 00:50:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `IDDepartamento` int(11) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`IDDepartamento`, `Nombre`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Ventas', 1, 1, 1, '2018-07-25 05:50:50', '2018-08-07 01:32:03'),
(2, 'Support TI', 1, 1, 1, '2018-08-07 04:23:29', '2018-08-15 22:46:04'),
(3, 'Recursos Humanos', 1, 1, 1, '2018-08-15 22:45:31', '2018-08-15 22:45:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleingreso`
--

CREATE TABLE `detalleingreso` (
  `IDDetalleIngreso` int(11) NOT NULL,
  `IDIngreso` int(11) NOT NULL,
  `IDArticulo` int(11) NOT NULL,
  `Cantidad` int(4) NOT NULL,
  `PrecioCompra` decimal(11,2) NOT NULL,
  `PrecioVenta` decimal(11,2) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `IDIngreso` int(11) NOT NULL,
  `IDProveedor` int(11) NOT NULL,
  `TipoComprobante` varchar(20) NOT NULL,
  `SerieComprobante` varchar(20) DEFAULT NULL,
  `NumeroComprobante` varchar(20) NOT NULL,
  `FechaComprobante` datetime NOT NULL,
  `Inpuesto` decimal(4,2) NOT NULL,
  `TotalCompra` decimal(11,2) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `IDPermiso` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Detalle` varchar(70) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`IDPermiso`, `Nombre`, `Detalle`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Lectura-Clientes', 'Lectura de datos de clientes', 1, 1, 1, '2018-08-30 09:22:35', '2018-08-30 09:22:35'),
(2, 'Escritura-Cliente', 'Escritura de Clientes', 1, 1, 1, '2018-08-31 01:10:12', '2018-08-31 01:10:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `IDProveedor` int(11) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `TipoDocumento` varchar(20) NOT NULL,
  `NumeroDocumento` varchar(30) NOT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(40) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`IDProveedor`, `Nombre`, `TipoDocumento`, `NumeroDocumento`, `Direccion`, `Telefono`, `Correo`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Coca Cola', 'Cedula Juridica', '3-01013-255', 'San Jose', '22602541', 'N/A', 0, 1, 1, '2018-08-15 23:51:57', '2018-08-28 10:49:29'),
(2, 'Gas Zeta S.A', 'Cedula Fisica', '1234', 'N/A', '22404040', 'N/A', 1, 1, 1, '2018-08-15 23:59:20', '2018-08-17 01:45:51'),
(3, 'Dos Pinos S.A', 'Cedula Fisica', '123456', 'San Jose', '22101414', 'N/A', 1, 1, 1, '2018-08-17 01:36:34', '2018-08-17 01:44:00'),
(4, 'Prueba', 'Pasaporte', 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, '2018-08-17 01:41:00', '2018-08-17 01:41:00'),
(5, 'Prueba 2', 'Cedula Fisica', 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, '2018-08-17 01:43:11', '2018-08-17 01:43:11'),
(6, 'Prueba 3', 'Cedula Fisica', 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, '2018-08-17 02:00:20', '2018-08-17 02:00:20'),
(7, 'N/A', 'Pasaporte', 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, '2018-08-17 02:05:04', '2018-08-17 02:05:16'),
(8, 'Brenes S.A', 'Cedula Juridica', 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, '2018-08-28 10:50:13', '2018-08-28 10:50:13'),
(9, 'Lomas S.A', 'Cedula Juridica', '211', 'N/A', 'N/A', 'N/A', 1, 1, 1, '2018-08-29 06:05:39', '2018-08-29 06:05:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `IDPuesto` int(11) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `IDDepartamento` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`IDPuesto`, `Nombre`, `IDDepartamento`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Asistente A1', 1, 1, 1, 1, '2018-07-25 05:51:41', '2018-08-16 01:29:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `IDRole` int(11) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`IDRole`, `Nombre`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 0, NULL, 1, '2018-07-25 05:45:15', '2018-08-22 00:18:13'),
(2, 'User', 1, 1, 1, '2018-08-22 00:18:02', '2018-08-22 00:18:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolepermiso`
--

CREATE TABLE `rolepermiso` (
  `IDRolePermiso` int(11) NOT NULL,
  `IDRole` int(11) NOT NULL,
  `IDPermiso` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IDUsuario` int(11) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `TipoDocumento` varchar(20) NOT NULL,
  `NumeroDocumento` varchar(30) NOT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(20) DEFAULT NULL,
  `IDPuesto` int(11) DEFAULT NULL,
  `IDRole` int(11) DEFAULT NULL,
  `NombreUsuario` varchar(20) NOT NULL,
  `Contrasenia` varchar(64) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IDUsuario`, `Nombre`, `TipoDocumento`, `NumeroDocumento`, `Direccion`, `Telefono`, `Correo`, `IDPuesto`, `IDRole`, `NombreUsuario`, `Contrasenia`, `Estado`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Alfred Tomas', 'Cedula', '5012401025', NULL, NULL, NULL, 1, 1, 'alfred501', '123', 0, NULL, NULL, '2018-07-25 05:49:12', '2018-08-21 02:35:42');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`IDArticulo`),
  ADD KEY `IDCategoria` (`IDCategoria`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IDCategoria`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`IDCliente`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`IDDepartamento`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `detalleingreso`
--
ALTER TABLE `detalleingreso`
  ADD PRIMARY KEY (`IDDetalleIngreso`),
  ADD KEY `IDIngreso` (`IDIngreso`),
  ADD KEY `IDArticulo` (`IDArticulo`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`IDIngreso`),
  ADD KEY `IDProveedor` (`IDProveedor`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`IDPermiso`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`IDProveedor`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`IDPuesto`),
  ADD KEY `IDDepartamento` (`IDDepartamento`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`IDRole`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `rolepermiso`
--
ALTER TABLE `rolepermiso`
  ADD PRIMARY KEY (`IDRolePermiso`),
  ADD KEY `IDRole` (`IDRole`),
  ADD KEY `IDPermiso` (`IDPermiso`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDUsuario`),
  ADD KEY `IDPuesto` (`IDPuesto`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `IDRole` (`IDRole`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `IDArticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IDCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `IDCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `IDDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalleingreso`
--
ALTER TABLE `detalleingreso`
  MODIFY `IDDetalleIngreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `IDIngreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `IDPermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `IDProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `IDPuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `IDRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rolepermiso`
--
ALTER TABLE `rolepermiso`
  MODIFY `IDRolePermiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_ibfk_1` FOREIGN KEY (`IDCategoria`) REFERENCES `categoria` (`IDCategoria`),
  ADD CONSTRAINT `articulo_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`IDUsuario`),
  ADD CONSTRAINT `articulo_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`IDUsuario`);

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`IDUsuario`),
  ADD CONSTRAINT `categoria_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`IDUsuario`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`IDUsuario`),
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`IDUsuario`);

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `departamento_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`IDUsuario`),
  ADD CONSTRAINT `departamento_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`IDUsuario`);

--
-- Filtros para la tabla `detalleingreso`
--
ALTER TABLE `detalleingreso`
  ADD CONSTRAINT `detalleingreso_ibfk_1` FOREIGN KEY (`IDIngreso`) REFERENCES `ingreso` (`IDIngreso`),
  ADD CONSTRAINT `detalleingreso_ibfk_2` FOREIGN KEY (`IDArticulo`) REFERENCES `articulo` (`IDArticulo`),
  ADD CONSTRAINT `detalleingreso_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`IDUsuario`),
  ADD CONSTRAINT `detalleingreso_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`IDUsuario`);

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`IDProveedor`) REFERENCES `proveedor` (`IDProveedor`),
  ADD CONSTRAINT `ingreso_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`IDUsuario`),
  ADD CONSTRAINT `ingreso_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`IDUsuario`);

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`IDUsuario`),
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`IDUsuario`);

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`IDUsuario`),
  ADD CONSTRAINT `proveedor_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`IDUsuario`);

--
-- Filtros para la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD CONSTRAINT `puesto_ibfk_1` FOREIGN KEY (`IDDepartamento`) REFERENCES `departamento` (`IDDepartamento`),
  ADD CONSTRAINT `puesto_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`IDUsuario`),
  ADD CONSTRAINT `puesto_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`IDUsuario`);

--
-- Filtros para la tabla `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`IDUsuario`),
  ADD CONSTRAINT `role_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`IDUsuario`);

--
-- Filtros para la tabla `rolepermiso`
--
ALTER TABLE `rolepermiso`
  ADD CONSTRAINT `rolepermiso_ibfk_1` FOREIGN KEY (`IDRole`) REFERENCES `role` (`IDRole`),
  ADD CONSTRAINT `rolepermiso_ibfk_2` FOREIGN KEY (`IDPermiso`) REFERENCES `permiso` (`IDPermiso`),
  ADD CONSTRAINT `rolepermiso_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`IDUsuario`),
  ADD CONSTRAINT `rolepermiso_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`IDUsuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IDPuesto`) REFERENCES `puesto` (`IDPuesto`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `usuario` (`IDUsuario`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `usuario` (`IDUsuario`),
  ADD CONSTRAINT `usuario_ibfk_4` FOREIGN KEY (`IDRole`) REFERENCES `role` (`IDRole`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
