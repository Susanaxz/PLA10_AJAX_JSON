-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-08-2020 a las 13:10:30
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `libreria`
--
CREATE DATABASE IF NOT EXISTS `libreria` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `libreria`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

DROP TABLE IF EXISTS `libros`;
CREATE TABLE IF NOT EXISTS `libros` (
`idlibros` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `precio` decimal(6,2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`idlibros`, `titulo`, `precio`) VALUES
(1, 'Cómo construir un condensador de fluzo', '50.00'),
(2, '1001 utilidades de los clips', '125.00'),
(3, 'Cocina creativa con escorpiones', '90.00'),
(4, '100 formas de cocinar un guisante', '78.00'),
(5, 'Zacarías Satrústegui: vida y milagros', '45.00'),
(6, 'Segismundo Picaporte', '560.00'),
(7, 'Zascandil y Zahorín: dos truhanes de postín', '76.00'),
(8, 'Testaferría avanzada', '35.00'),
(9, 'Como vivir como un Rey sin dar un palo al agua', '120.00'),
(10, 'Enciclopedia de los miriapodos', '600.00'),
(11, 'Reactores de antimateria para el hogar', '90.00'),
(12, 'Construyase su propia mini central nuclear', '90.00'),
(13, 'Joao el fumao y su amigo Peretta el fumeta', '60.00'),
(14, 'Petra Pedrusco: vida y milagros', '70.00'),
(15, 'Como hacer la O con un canuto', '95.00'),
(16, 'Tirando a dar', '30.00'),
(17, 'Recetas de cocina con miriapodos', '25.00'),
(18, 'Don Pantuflo Zapatilla: vida y milagros', '75.00'),
(19, 'Rizando el rizo', '89.00'),
(20, 'Fulano, Mengano y Zutano', '45.00'),
(21, 'Como hacerse rico vendiendo cerillas', '25.00'),
(22, 'Amanecer en Sebastopol', '67.00'),
(23, 'Aprenda chino mandarín en una semana', '67.00'),
(24, 'Tucco Beneditto Pacífico Juan María Ramirez: vida y milagros', '80.00'),
(25, 'En Pau, en Pep i en Berenguera', '55.00'),
(26, 'Utilidades del bosón de Higs en la cocina moderna', '120.00'),
(27, 'Cómo separar gluones utilizando patatas', '35.00'),
(28, 'Enriquezca su propio uranio en casa', '67.00'),
(29, 'Guía del caracol de mar', '70.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
 ADD PRIMARY KEY (`idlibros`), ADD UNIQUE KEY `titulo` (`titulo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
MODIFY `idlibros` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
