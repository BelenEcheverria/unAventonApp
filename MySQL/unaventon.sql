-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2018 a las 03:54:23
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `unaventon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `rol` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `puntuacion` int(11) NOT NULL,
  `comentario` varchar(500) COLLATE latin1_spanish_ci DEFAULT NULL,
  `idUsuarioAutor` int(11) DEFAULT NULL,
  `idUsuarioCalificado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL,
  `ciudad` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `provincia` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `ciudad`, `provincia`) VALUES
(1, 'La Plata', 'Buenos Aires'),
(2, 'CABA', ''),
(3, 'Mar del Plata', 'Buenos Aires'),
(4, 'Tandil', 'Buenos Aires'),
(5, 'Posadas', 'Misiones'),
(6, 'Rosario', 'Santa Fe'),
(7, 'Villa General Belgrano', 'Cordoba'),
(8, 'Carlos Paz', 'Cordoba'),
(9, 'San Rafel', 'Mendoza'),
(10, 'Bariloche', 'Neuquen'),
(11, 'San Martin de los Andes', 'Neuquen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadospostulacion`
--

CREATE TABLE `estadospostulacion` (
  `id` int(11) NOT NULL,
  `estado` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `estadospostulacion`
--

INSERT INTO `estadospostulacion` (`id`, `estado`) VALUES
(1, 'Aceptada'),
(3, 'Cancelada'),
(2, 'Rechazada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadosviaje`
--

CREATE TABLE `estadosviaje` (
  `id` int(11) NOT NULL,
  `estado` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `estadosviaje`
--

INSERT INTO `estadosviaje` (`id`, `estado`) VALUES
(5, 'Cancelado'),
(4, 'Finalizado, pago'),
(3, 'Finalizado, sin pagar'),
(1, 'Pendiente'),
(6, 'Periodico'),
(2, 'Viajando');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulaciones`
--

CREATE TABLE `postulaciones` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idViaje` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `idViaje` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `respuesta` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `idPregunta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `mail` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `nacimiento` date NOT NULL,
  `contenidoimagen` longblob,
  `tipoimagen` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `esAdministrador` bit(1) NOT NULL DEFAULT b'0',
  `estaActivo` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `mail`, `password`, `nombre`, `apellido`, `nacimiento`, `contenidoimagen`, `tipoimagen`, `esAdministrador`, `estaActivo`) VALUES
(1, 'usuario1@mail.com', 'Contra10', 'Martin', 'Martinez', '1990-12-22', NULL, NULL, b'0', b'1'),
(2, 'usuario2@mail.com', 'Contra10', 'Lucia', 'Lopez', '1988-05-20', NULL, NULL, b'0', b'1'),
(3, 'usuario3@mail.com', 'Contra10', 'Dario', 'Diaz', '1996-06-21', NULL, NULL, b'0', b'1'),
(4, 'usuario4@mail.com', 'Contra10', 'Susana', 'Sanchez', '1960-09-23', NULL, NULL, b'0', b'1'),
(5, 'usuario5@mail.com', 'Contra10', 'Gabriel', 'Gonzalez', '1989-01-16', NULL, NULL, b'0', b'1'),
(6, 'usuario6@mail.com', 'Contra10', 'Rita', 'Ramirez', '1994-05-08', NULL, NULL, b'0', b'1'),
(100, 'usuarioA@gmail.com', 'Contra10', 'Paula', 'Biterotti', '1990-05-15', NULL, NULL, b'1', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `patente` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `tipo` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `asientos` int(11) NOT NULL,
  `modelo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `color` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `estaActivo` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `idUsuario`, `patente`, `tipo`, `asientos`, `modelo`, `color`, `estaActivo`) VALUES
(1, 1, 'UNO001', 'auto', 4, 'Audi', 'negro', b'1'),
(2, 3, 'TRS001', 'moto', 2, 'Harley-Davidson', 'negro', b'1'),
(4, 2, 'DOS001', 'auto', 4, 'BMW', 'gris', b'1'),
(6, 2, 'DOS002', 'camioneta', 4, 'Jeep', 'negro', b'1'),
(7, 3, 'TRS002', 'auto', 4, 'Volkswagen New Beetle', 'crema', b'1'),
(8, 3, 'TRS003', 'auto', 4, 'Fiat 600', 'Blanco', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` int(11) DEFAULT NULL,
  `minuto` int(11) DEFAULT NULL,
  `duracionHoras` int(11) DEFAULT NULL,
  `duracionMinutos` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `texto` varchar(500) COLLATE latin1_spanish_ci DEFAULT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idOrigen` int(11) DEFAULT NULL,
  `idDestino` int(11) DEFAULT NULL,
  `idVehiculo` int(11) DEFAULT NULL,
  `idConductor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadospostulacion`
--
ALTER TABLE `estadospostulacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estado` (`estado`);

--
-- Indices de la tabla `estadosviaje`
--
ALTER TABLE `estadosviaje`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estado` (`estado`);

--
-- Indices de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `estadospostulacion`
--
ALTER TABLE `estadospostulacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estadosviaje`
--
ALTER TABLE `estadosviaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
