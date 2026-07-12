-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2026 a las 19:58:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `ID_Ingreso` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `ID_Proveedor` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fecha_Ingreso` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`ID_Ingreso`, `ID_Producto`, `ID_Proveedor`, `Cantidad`, `Fecha_Ingreso`) VALUES
(1, 5, 2, 15, '2026-06-22 21:32:46'),
(2, 6, 3, 15, '2026-06-24 21:41:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_Producto` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Stock` int(11) NOT NULL DEFAULT 0,
  `Precio` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_Producto`, `Nombre`, `Stock`, `Precio`) VALUES
(2, 'Producto B', 5, 200.00),
(3, 'Laptop HP', 10, 15000.00),
(4, 'Laptop HP', 10, 15000.00),
(5, 'Laptop HP', 10, 15000.00),
(6, 'Laptop HP', 10, 15000.00),
(7, 'Laptop HP', 10, 15000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `ID_Proveedor` int(11) NOT NULL,
  `Razon_Social` varchar(50) NOT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `Numero` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`ID_Proveedor`, `Razon_Social`, `Correo`, `Numero`) VALUES
(1, 'Tech Distribuidora SA', 'ventas@tech.com', '5551234567'),
(2, 'Computación MX', 'info@compmx.com', '5559876543'),
(3, 'NI IDEA', 'AMOYA@GMAIL.COM', '985685475');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `ID_Salida` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Razon` varchar(50) DEFAULT NULL,
  `Fecha_Salida` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`ID_Salida`, `ID_Producto`, `Cantidad`, `Razon`, `Fecha_Salida`) VALUES
(1, 5, 5, 'dañado', '2026-06-22 21:33:16'),
(2, 6, 6, 'dañado', '2026-06-24 21:42:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `ID_Venta` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Fecha_Venta` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`ID_Ingreso`),
  ADD KEY `ID_Producto` (`ID_Producto`),
  ADD KEY `ID_Proveedor` (`ID_Proveedor`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_Producto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`ID_Proveedor`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`ID_Salida`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ID_Venta`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `ID_Ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `ID_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `ID_Salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ID_Venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`),
  ADD CONSTRAINT `ingresos_ibfk_2` FOREIGN KEY (`ID_Proveedor`) REFERENCES `proveedores` (`ID_Proveedor`);

--
-- Filtros para la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD CONSTRAINT `salidas_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;