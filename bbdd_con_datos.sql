-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2021 a las 15:59:41
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `discos`
--
CREATE DATABASE IF NOT EXISTS discos;
USE discos;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lanzamientos`
--

CREATE TABLE `lanzamientos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `imagen` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lanzamientos`
--

INSERT INTO `lanzamientos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`) VALUES
(11, 'I want u babe', 'Single junto a Rubén Urgal', '1.29', '1636291359_I Want U Babe (Portada).jpg'),
(12, 'Gata traviesa', 'Single de reggaeton', '1.29', '1636291468_Gata Traviesa (Portada).png'),
(13, 'De descontrol', 'Single de reggaeton', '1.29', '1636291500_De Descontrol (Portada).png'),
(14, 'Sumbame', 'Single de electrolatino', '0.99', '1636291559_Sumbame (Portada).jpg'),
(15, 'Lo que dicta el corazón', 'Álbum de música popular', '10.00', '1636291602_Lo Que Dicta El Corazón (Portada).png'),
(16, 'Te olvidaré', 'Single de reggaeton', '1.29', '1636292147_Te Olvidaré (Portada).png'),
(17, 'Shorty girl', 'Single de pop', '0.99', '1636292219_Shorty Girl (Portada).jpg'),
(18, 'Tu quieres', 'Single junto a Andrew Boss', '1.29', '1636292266_Tú Quieres (Portada).jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `precio_producto` decimal(5,2) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `n_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`pedido_id`, `producto_id`, `nombre_producto`, `precio_producto`, `fecha`, `n_pedido`) VALUES
(15, 13, 'De descontrol', '1.29', '2021-11-11 12:22:49', 1),
(16, 12, 'Gata traviesa', '1.29', '2021-11-11 12:22:49', 1),
(17, 14, 'Sumbame', '0.99', '2021-11-11 12:22:49', 1),
(18, 16, 'Te olvidaré', '1.29', '2021-11-11 15:48:14', 2),
(19, 13, 'De descontrol', '1.29', '2021-11-11 15:48:14', 2),
(20, 18, 'Tu quieres', '1.29', '2021-11-11 15:48:14', 2),
(21, 15, 'Lo que dicta el corazón', '10.00', '2021-11-11 15:48:14', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lanzamientos`
--
ALTER TABLE `lanzamientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedido_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lanzamientos`
--
ALTER TABLE `lanzamientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
