-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2024 a las 14:19:15
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `santamaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empleados`
--

CREATE TABLE `tbl_empleados` (
  `ced_empleado` varchar(30) NOT NULL,
  `nombre_empleado` varchar(30) NOT NULL,
  `apellido_empleado` varchar(30) NOT NULL,
  `telefono_empleado` varchar(20) NOT NULL,
  `email_empleado` varchar(80) NOT NULL,
  `status_empleado` int(10) NOT NULL,
  `rol_empleado` int(10) NOT NULL,
  `password_empleado` varchar(255) DEFAULT NULL,
  `direccion_empleado` varchar(255) NOT NULL,
  `fecha_empleado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_empleados`
--

INSERT INTO `tbl_empleados` (`ced_empleado`, `nombre_empleado`, `apellido_empleado`, `telefono_empleado`, `email_empleado`, `status_empleado`, `rol_empleado`, `password_empleado`, `direccion_empleado`, `fecha_empleado`) VALUES
('0916106727', 'Mario', 'Juaquin', '1478547874', 'mario@hotmail.com', 1, 3, '$2y$10$BYc/buzUDFEY4i8wosaS4OquWJen7SKJ0.2deKVIRyz.nCPA3l0GC', 'los seibos', '2024-06-14'),
('0944028356', 'Killertyh', 'Sssrrhj', '4521785471', 'killer@hotmail.com', 1, 3, '$2y$10$7fl0eyJwuMDKDpOwlxkseeHppDdnUVnYHEzPQwyllzX7WC6QdQBHm', 'central', '2024-06-26'),
('0950664334', 'Miguel Efrain', 'Carpio Gomez', '0858526431', 'miguelcarpio1996@hotmail.com', 1, 2, '$2y$10$ENCsTqw4utK15X09hWwRl.nse9twWaYvnQXD7u7Yt4nIV2dmeWKcG', 'LAS ORQUIDEA', '2024-06-23'),
('0951633247', 'Roman Romanty', 'Romanf Arjonaf', '0858526431', 'romana1234@hotmail.com', 1, 3, '$2y$10$ny1G4..y2BwoXOXGKRZPIOQY0Dkjr89RHZN/IHd8vwrHN3YvyvEwK', 'LAS ORQUIDEA', '2024-06-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_registrodeasistencia`
--

CREATE TABLE `tbl_registrodeasistencia` (
  `id_empleado` int(50) NOT NULL,
  `ced_empleado` varchar(20) NOT NULL,
  `hora_salida` time DEFAULT NULL,
  `hora_entrada` time DEFAULT NULL,
  `fecha_empleados` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_registrodeasistencia`
--

INSERT INTO `tbl_registrodeasistencia` (`id_empleado`, `ced_empleado`, `hora_salida`, `hora_entrada`, `fecha_empleados`) VALUES
(1, '0950664334', '17:34:00', '08:30:00', '2024-06-24'),
(2, '0950664334', '00:52:00', '00:24:00', '2024-06-23'),
(3, '0950664334', '00:55:00', '00:55:00', '2024-06-22'),
(4, '0950664334', '01:00:00', '01:00:00', '2024-06-25'),
(5, '0916106727', '01:53:00', '01:53:00', '2024-06-25'),
(6, '0951633247', '10:09:00', '10:09:00', '2024-06-19'),
(7, '0950664334', '18:43:00', '18:43:00', '2024-06-26'),
(8, '0951633247', '19:40:00', '19:40:00', '2024-06-26'),
(9, '0916106727', '01:51:00', '01:49:00', '2024-06-26'),
(10, '0944028356', '07:07:00', '07:01:00', '2024-06-23'),
(11, '0944028356', '07:10:00', '07:09:00', '2024-06-20'),
(12, '0944028356', '07:14:00', '07:11:00', '2024-06-26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_empleados`
--
ALTER TABLE `tbl_empleados`
  ADD PRIMARY KEY (`ced_empleado`);

--
-- Indices de la tabla `tbl_registrodeasistencia`
--
ALTER TABLE `tbl_registrodeasistencia`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `ced_empleado` (`ced_empleado`),
  ADD KEY `ced_empleado_2` (`ced_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_registrodeasistencia`
--
ALTER TABLE `tbl_registrodeasistencia`
  MODIFY `id_empleado` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
