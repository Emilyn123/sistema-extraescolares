-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2025 a las 05:03:58
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `extraescolares`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_dato` (IN `busqueda` VARCHAR(50))  BEGIN
    -- Prepara el filtro para que busque "lo que empieza con..."
    SET @filtro = CONCAT(busqueda, '%');
    
    -- Ejecuta la consulta
    SELECT id_tallerista, nombre, apellido, telefono 
    FROM talleristas 
    WHERE CAST(id_tallerista AS CHAR) LIKE @filtro;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consulta_alumno` (IN `p_matricula` INT)  NO SQL
SELECT 
    id_asignacion,
    nombre_act,
    estado,
    puntos
FROM 
    asignarpts
WHERE 
    matricula = p_matricula$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consulta_alumno_admin` (IN `p_matricula` INT)  NO SQL
SELECT 
    id_asignacion,
    matricula,
    nombre_act,
    puntos,
    estado
FROM 
    asignarpts
WHERE 
    matricula = p_matricula$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `total_puntos` (`p_matricula` INT) RETURNS INT(11) NO SQL
BEGIN
DECLARE total_puntos INT;

SELECT SUM(puntos)
INTO total_puntos
FROM asignarpts
WHERE matricula = p_matricula;

IF total_puntos IS NULL THEN
    SET total_puntos = 0;
END IF;

RETURN total_puntos;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id_actividad` int(11) NOT NULL,
  `id_tallerista` int(11) DEFAULT NULL,
  `nombre_act` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `puntuacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id_actividad`, `id_tallerista`, `nombre_act`, `fecha_inicio`, `fecha_final`, `puntuacion`) VALUES
(25101, 2025101, 'Ajedrez', '2025-02-10', '2025-05-09', 10),
(25102, 2025102, 'Danza', '2025-02-10', '2025-05-09', 10),
(25103, 2025102, 'Pintura', '2025-08-20', '2025-12-07', 10),
(25104, 2025102, 'Lectura', '2025-11-12', '2025-11-30', 10),
(25105, 2025101, 'Lectura', '2025-09-24', '2025-11-08', 10),
(25201, 2025201, 'Pintura', '2025-09-08', '2025-11-28', 10),
(25202, 2025202, 'Lectura', '2025-09-08', '2025-11-28', 10),
(25203, 2025101, 'Pintura', '2025-08-20', '2025-12-07', 10),
(25204, 2025102, 'Pintura', '2025-08-01', '2025-11-01', 10),
(25205, 2025101, 'Lectura', '2025-11-12', '2025-11-27', 10),
(25206, 2025101, 'Ajedrez', '2025-11-12', '2025-11-27', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignarpts`
--

CREATE TABLE `asignarpts` (
  `id_asignacion` int(11) NOT NULL,
  `id_tallerista` int(11) DEFAULT NULL,
  `matricula` int(11) DEFAULT NULL,
  `nombre_act` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `estado` enum('pendiente','completado','no completado') COLLATE latin1_general_ci DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `asignarpts`
--

INSERT INTO `asignarpts` (`id_asignacion`, `id_tallerista`, `matricula`, `nombre_act`, `estado`, `puntos`) VALUES
(1, 2025201, 23890340, 'Pintura', 'completado', 10),
(2, 2025201, 23890341, 'Pintura', 'completado', 10),
(3, 2025202, 23890342, 'Lectura', 'completado', 10),
(4, 2025202, 23890343, 'Lectura', 'no completado', 0),
(5, 2025101, 23890344, 'Ajedrez', 'completado', 10),
(6, 2025101, 23890345, 'Ajedrez', 'completado', 10),
(7, 2025102, 23890346, 'Danza', 'no completado', 0),
(8, 2025101, 23890340, 'Ajedrez', 'completado', 10),
(9, 2025101, 23890342, 'Ajedrez', 'completado', 10),
(10, 2025202, 23890345, 'Lectura', 'completado', 10),
(11, 2025102, 23890341, 'Danza', 'completado', 10),
(12, 2025201, 23890340, 'Lectura', 'pendiente', 0),
(13, 2025201, 23890340, 'Lectura', 'pendiente', 0),
(14, 2025201, 23890340, 'Lectura', 'completado', 10),
(15, 2025201, 23890340, 'Lectura', 'completado', 10),
(16, 2025201, 23890340, 'Lectura', 'completado', 10),
(17, 2025201, 23890342, 'Lectura', 'completado', 10),
(18, 2025202, 23890340, 'Pintura', 'completado', 10),
(19, 1, 23890346, 'Pintura', 'completado', 10),
(20, 2025201, 0, '', '', 0),
(21, 1, 23890350, 'Pintura', 'completado', 10),
(22, 1, 23890350, 'Pintura', 'completado', 10),
(23, 1, 23890350, 'Pintura', 'pendiente', 10),
(24, 1, 23890341, 'Pintura', 'pendiente', 10),
(25, 2025101, 23890340, 'Lectura', 'pendiente', 10),
(26, 2025101, 23890342, 'Pintura', 'completado', 10),
(27, 2025101, 23890342, 'Lectura', 'completado', 10),
(28, 1, 23890346, 'Lectura', 'completado', 10),
(29, 1, 23890346, 'Lectura', 'completado', 10),
(30, 1, 23890346, 'Lectura', 'completado', 10),
(31, 1, 23890346, 'Lectura', 'completado', 10),
(32, 1, 23890346, 'Lectura', 'completado', 10),
(33, 1, 23890340, 'Lectura', 'completado', 10),
(34, 2025101, 23890350, 'Lectura', 'pendiente', 10),
(35, 2025101, 23890350, 'Lectura', 'pendiente', 10),
(36, 2025101, 23890350, 'Lectura', 'pendiente', 10),
(37, 2025101, 23890350, 'Lectura', 'completado', 10),
(38, 2025101, 23890350, 'Lectura', 'completado', 10),
(39, 2025101, 23890350, 'Lectura', 'completado', 10),
(40, 2025101, 23890350, 'Lectura', 'completado', 10),
(41, 2025101, 23890350, 'Lectura', 'completado', 10),
(42, 2025101, 23890350, 'Lectura', 'completado', 10),
(43, 2025101, 23890343, 'Lectura', 'completado', 10),
(44, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(45, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(46, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(47, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(48, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(49, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(50, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(51, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(52, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(53, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(54, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(55, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(56, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(57, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(58, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(59, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(60, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(61, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(62, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(63, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(64, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(65, 2025101, 23890343, 'Lectura', 'pendiente', 10),
(66, 1, 23890340, 'Lectura', 'completado', 10),
(67, 1, 23890340, 'Lectura', 'completado', 10),
(68, 1, 23890340, 'Lectura', 'completado', 10),
(69, 1, 23890340, 'Lectura', 'completado', 10),
(70, 1, 23890340, 'Lectura', 'completado', 10),
(71, 1, 23890340, 'Lectura', 'completado', 10),
(72, 1, 23890340, 'Lectura', 'completado', 10),
(73, 1, 23890342, 'Lectura', 'completado', 10),
(74, 1, 23890350, 'Lectura', 'completado', 10),
(76, 1, 23890342, 'Lectura', 'no completado', 0),
(77, 2025201, 23890343, 'Pintura', 'no completado', 0),
(78, 2025201, 23890343, 'Pintura', 'no completado', 0),
(79, 2025201, 23890343, 'Pintura', 'no completado', 0),
(80, 2025201, 23890343, 'Pintura', 'no completado', 0),
(81, 2025201, 23890343, 'Pintura', 'no completado', 0),
(82, 2025201, 23890343, 'Pintura', 'no completado', 0),
(83, 2025201, 23890343, 'Pintura', 'no completado', 0),
(84, 2025201, 23890343, 'Pintura', 'no completado', 0),
(85, 2025201, 23890343, 'Pintura', 'no completado', 0),
(86, 2025201, 23890343, 'Pintura', 'no completado', 0),
(87, 2025201, 23890343, 'Pintura', 'no completado', 0),
(88, 2025201, 23890343, 'Pintura', 'no completado', 0),
(89, 2025201, 23890343, 'Pintura', 'no completado', 0),
(90, 2025201, 23890343, 'Pintura', 'no completado', 0),
(91, 2025201, 23890343, 'Pintura', 'no completado', 0),
(92, 2025201, 23890343, 'Pintura', 'no completado', 0),
(93, 2025201, 23890343, 'Pintura', 'no completado', 0),
(94, 2025201, 23890343, 'Pintura', 'no completado', 0),
(95, 2025201, 23890343, 'Pintura', 'no completado', 0),
(96, 2025201, 23890343, 'Pintura', 'no completado', 0),
(97, 2025201, 23890343, 'Pintura', 'no completado', 0),
(98, 2025201, 23890343, 'Pintura', 'no completado', 0),
(99, 2025201, 23890343, 'Pintura', 'no completado', 0),
(100, 2025201, 23890343, 'Pintura', 'no completado', 0),
(101, 2025201, 23890343, 'Pintura', 'no completado', 0),
(102, 2025201, 23890343, 'Pintura', 'no completado', 0),
(103, 2025201, 23890343, 'Pintura', 'no completado', 0),
(104, 2025201, 23890343, 'Pintura', 'no completado', 0),
(105, 2025201, 23890343, 'Pintura', 'no completado', 0),
(106, 2025201, 23890343, 'Pintura', 'no completado', 0),
(107, 2025201, 23890343, 'Pintura', 'no completado', 0),
(108, 2025201, 23890343, 'Pintura', 'no completado', 0),
(109, 2025201, 23890343, 'Pintura', 'no completado', 0),
(110, 2025201, 23890343, 'Pintura', 'no completado', 0),
(111, 2025201, 23890343, 'Pintura', 'no completado', 0),
(112, 2025201, 23890343, 'Pintura', 'no completado', 0),
(113, 2025201, 23890343, 'Pintura', 'pendiente', 0),
(114, 1, 23890350, 'Lectura', 'completado', 10),
(115, 2025201, 23890340, 'Pintura', 'pendiente', 0),
(116, 2025201, 23890340, 'Pintura', 'pendiente', 0),
(117, 2025201, 23890346, 'Pintura', 'pendiente', 0),
(118, 2025201, 23890350, 'Lectura', 'pendiente', 0),
(119, 2025201, 23890346, 'Pintura', 'completado', 10),
(120, 2025201, 23890342, 'Pintura', 'no completado', 0),
(121, 2025201, 23890342, 'Pintura', 'pendiente', 0),
(122, 2025201, 23890350, 'Pintura', 'pendiente', 0),
(123, 2025101, 23890346, 'Pintura', 'no completado', 0),
(124, 2025101, 23890340, 'Lectura', 'pendiente', 5),
(125, 2025101, 23890342, 'Pintura', 'no completado', 0),
(126, 2025101, 23890340, 'Pintura', 'pendiente', 5),
(127, 2025101, 23890341, 'Pintura', 'pendiente', 5),
(128, 2025101, 23890341, 'Lectura', 'pendiente', 5),
(129, 2025101, 23890341, 'Lectura', 'no completado', 0),
(130, 2025101, 23890341, 'Lectura', 'pendiente', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regalumnos`
--

CREATE TABLE `regalumnos` (
  `id_registro` int(11) NOT NULL,
  `matricula` int(11) DEFAULT NULL,
  `id_actividad` int(11) DEFAULT NULL,
  `id_tallerista` int(11) DEFAULT NULL,
  `nombre_act` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nombrea` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `apellidoa` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `carrera` enum('IINF','BIO','ADMON','IGE','IAGR') COLLATE latin1_general_ci DEFAULT NULL,
  `semestre` enum('1','2','3','4','5','6','7','8','9') COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `regalumnos`
--

INSERT INTO `regalumnos` (`id_registro`, `matricula`, `id_actividad`, `id_tallerista`, `nombre_act`, `nombrea`, `apellidoa`, `carrera`, `semestre`) VALUES
(1, 23890340, 25201, 2025201, 'Pintura', 'Marinthia Alejandra', 'Cetz Navarro', 'IINF', '5'),
(2, 23890341, 25201, 2025201, 'Pintura', 'Romina', 'Mena Peraza', 'IINF', '5'),
(3, 23890342, 25202, 2025202, 'Lectura', 'Emily del Carmen', 'Navarro Puch', 'BIO', '5'),
(4, 23890343, 25202, 2025202, 'Lectura', 'Gerardo de Jesús', 'Alcocer Tec', 'BIO', '5'),
(5, 23890344, 25101, 2025101, 'Ajedrez', 'Alison', 'Matos Rodríguez', 'ADMON', '1'),
(6, 23890345, 25101, 2025101, 'Ajedrez', 'Rubi', 'Rodríguez Hernández', 'IAGR', '3'),
(7, 23890346, 25102, 2025102, 'Danza', 'Alexander de Jesús', 'Basto Dzul', 'IGE', '3'),
(8, 23890340, 25101, 2025101, 'Ajedrez', 'Marinthia Alejandra', 'Cetz Navarro', 'IINF', '4'),
(9, 23890342, 25101, 2025101, 'Ajedrez', 'Emily del Carmen', 'Navarro Puch', 'BIO', '4'),
(10, 23890345, 25202, 2025202, 'Lectura', 'Rubi', 'Rodríguez Hernández', 'IAGR', '4'),
(11, 23890341, 25102, 2025102, 'Danza', 'Romina', 'Mena Peraza', 'IINF', '4'),
(13, 23890342, 25201, 2025201, 'Pintura', 'marinthia ', 'ctez', 'IINF', '7'),
(14, 23890340, 25101, 25201, 'Lectura', 'Rogelio', 'Dominguez', 'ADMON', '5'),
(15, 23890340, 25101, 25201, 'Lectura', 'Rogelio', 'Dominguez', 'ADMON', '5'),
(16, 23890340, 25101, 25201, 'Lectura', 'Rogelio', 'Dominguez', 'ADMON', '5'),
(17, 23890340, 25101, 25201, 'Lectura', 'Rogelio', 'Dominguez', 'ADMON', '5'),
(18, 23890340, 25201, 25201, 'Lectura', 'Rogelio', 'Dominguez', 'ADMON', '5'),
(19, 23890349, 25201, 2025201, 'pintura', 'Jonatan Israel ', 'Poot Medina', 'IINF', '5'),
(20, 23890350, 25201, 25201, 'Lectura', 'Rogelio', 'Dominguez', 'IINF', '1'),
(21, 23890350, 25201, 25201, 'Lectura', 'Rogelio', 'Dominguez', 'IINF', '1'),
(22, 23890346, 25201, 25201, 'Pintura', 'Daniel', 'Guemez', 'IGE', '7'),
(23, 23890340, 25201, 2025101, 'Pintura', 'Marinthia ', 'Cetz', 'IAGR', '5'),
(24, 23890346, 25201, 2025101, 'Pintura', 'Daniel', 'Guemez', 'IINF', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talleristas`
--

CREATE TABLE `talleristas` (
  `id_tallerista` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `apellido` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `telefono` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `talleristas`
--

INSERT INTO `talleristas` (`id_tallerista`, `nombre`, `apellido`, `telefono`) VALUES
(2025101, 'María Elena ', 'Aguilar Sansores', '9861200505'),
(2025102, 'Lorena', 'Mena Ortega', '9861108896'),
(2025103, 'Marinthia', 'Cetz', '9861115794'),
(2025201, 'Ana', 'Martínez Osorio', '9861011008'),
(2025202, 'Adrían', 'López Aguilar', '9861091010'),
(2025203, 'Erika', 'Sosa', '9869990140'),
(2025205, 'Williamcito', 'Mandujano', '9869990168'),
(2025206, 'Mayra', 'Peniche', '9861200511'),
(2025207, 'Armando', 'Torres', '9869990145'),
(2025208, 'Melisa', 'Herrera', '9861200000'),
(2025209, 'Melisa', 'Herrera', '9861200000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_perfil` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `tipo` enum('Administrador','Alumno','Tallerista') DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_perfil`, `nombre`, `apellido`, `tipo`, `usuario`, `contrasena`) VALUES
(1, 'Alejandrina', 'Gamboa', 'Administrador', 'extalejandrina01', 'admin001'),
(2025101, 'María Elena', 'Aguilar Sansores', 'Tallerista', '2025101', 'taller003'),
(2025102, 'Lorena ', 'Mena Ortega', 'Tallerista', '2025102', 'taller004'),
(2025201, 'Ana ', 'Martínez Osorio', 'Tallerista', '2025201', 'taller001'),
(2025202, 'Adrían', 'López Aguilar', 'Tallerista', '2025202', 'taller002'),
(23890340, 'Marinthia Alejandra', 'Cetz Navarro', 'Alumno', '23890340', 'alumno001'),
(23890341, 'Romina', 'Mena Peraza', 'Alumno', '23890341', 'alumno002'),
(23890342, 'Emily del Carmen', 'Navarro Puch', 'Alumno', '23890342', 'alumno003'),
(23890343, 'Gerardo de Jesús', 'Alcocer Tec', 'Alumno', '23890343', 'alumno004'),
(23890344, 'Alison', 'Matos Rodríguez', 'Alumno', '23890344', 'alumno005'),
(23890345, 'Rubí', 'Rodríguez Hernández', 'Alumno', '23890345', 'alumno006'),
(23890346, 'Alexander de Jesús', 'Basto Dzul', 'Alumno', '23890346', 'alumno007');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `id_tallerista` (`id_tallerista`);

--
-- Indices de la tabla `asignarpts`
--
ALTER TABLE `asignarpts`
  ADD PRIMARY KEY (`id_asignacion`);

--
-- Indices de la tabla `regalumnos`
--
ALTER TABLE `regalumnos`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- Indices de la tabla `talleristas`
--
ALTER TABLE `talleristas`
  ADD PRIMARY KEY (`id_tallerista`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignarpts`
--
ALTER TABLE `asignarpts`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `regalumnos`
--
ALTER TABLE `regalumnos`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `talleristas`
--
ALTER TABLE `talleristas`
  MODIFY `id_tallerista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2025210;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`id_tallerista`) REFERENCES `talleristas` (`id_tallerista`);

--
-- Filtros para la tabla `regalumnos`
--
ALTER TABLE `regalumnos`
  ADD CONSTRAINT `regalumnos_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
