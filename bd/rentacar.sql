-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2017 a las 01:04:15
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rentacar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autos`
--

CREATE TABLE `autos` (
  `id` int(5) NOT NULL,
  `marca` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `modelo` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `year` varchar(4) COLLATE utf8mb4_spanish_ci NOT NULL,
  `placa` varchar(8) COLLATE utf8mb4_spanish_ci NOT NULL,
  `color` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `tipo` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `capacidad` int(2) NOT NULL,
  `disponible` int(1) NOT NULL,
  `usd` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`id`, `marca`, `modelo`, `year`, `placa`, `color`, `tipo`, `capacidad`, `disponible`, `usd`) VALUES
(1, 'Chevrolet', 'Impala', '1969', 'P022-022', 'Negro', 'Coupe', 5, 1, '75.00'),
(2, 'Ford', 'Focus', '2008', 'P103-405', 'Morado', 'Coupe', 5, 1, '35.50'),
(3, 'Toyota', 'Corolla', '2005', 'P345-971', 'Rojo', 'Sedan', 5, 1, '25.00'),
(4, 'Ford', 'F-Series', '2007', 'P734-002', 'Azul', 'Pick-Up', 5, 1, '35.00'),
(5, 'Volkswagen', 'Wolf', '2002', 'P673-733', 'Blanco', 'Coupe', 5, 1, '20.75'),
(6, 'Volkswagen', 'Beetle', '2000', 'P825-284', 'Negro', 'Coupe', 5, 0, '25.00'),
(7, 'Ford', 'Escort', '1995', 'P003-284', 'Verde', 'Coupe', 5, 2, '12.50'),
(8, 'Honda', 'Civic', '2015', 'P322-055', 'Blanco', 'Sedan', 5, 1, '45.00'),
(9, 'Volkswagen', 'Passat', '1994', 'P813-047', 'Verde', 'Sedan', 5, 1, '12.50'),
(10, 'BMW', 'Z4', '2014', 'P158-779', 'Gris', 'Coupe', 5, 1, '35.50'),
(11, 'Mercedes-Benz', 'Clase E', '2015', 'P964-531', 'Blanco', 'Coupe', 5, 1, '40.00'),
(12, 'Hyundai', 'Tucson', '2010', 'P725-655', 'Rojo', 'Camioneta', 5, 1, '35.00'),
(13, 'Jeep', 'Wrangler', '2009', 'P246-839', 'Gris', 'Camioneta', 5, 0, '30.00'),
(14, 'Nissan ', 'Centra', '1999', 'P983-002', 'Rojo', 'Sedan', 5, 1, '20.50'),
(15, 'Nissan', 'Frontier', '2015', 'P503-702', 'Azul ElÃ©c', 'Pick-Up', 5, 0, '35.00'),
(21, 'Chevrolet', 'Spark', '2014', 'P404-503', 'Ocre', 'Sedan', 5, 1, '35.00'),
(22, 'Kia', 'Soul', '2016', 'P433-002', 'Rojo Perla', 'Sedan', 5, 1, '35.00'),
(23, 'Toyota', 'Yaris', '2007', 'P082-217', 'Verde LimÃ', 'Sedan', 5, 1, '30.50'),
(24, 'Nissan', 'Navara', '2017', 'P432-019', 'Naranja', 'Pick-Up', 5, 0, '40.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) NOT NULL,
  `nombres` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellidos` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `dui` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `licencia` varchar(17) COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion` varchar(75) COLLATE utf8mb4_spanish_ci NOT NULL,
  `tfijo` varchar(9) COLLATE utf8mb4_spanish_ci NOT NULL,
  `tcel` varchar(9) COLLATE utf8mb4_spanish_ci NOT NULL,
  `tcel2` varchar(9) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombres`, `apellidos`, `dui`, `licencia`, `direccion`, `tfijo`, `tcel`, `tcel2`, `email`) VALUES
(1, 'Camilo Eduardo', 'Morales', '12168345-8', '1207-101282-104-5', 'Colonia Louisiana, #12, Chinameca, San Miguel', '2665-1019', '7280-5008', '7375-0059', 'cem@hotmail.com'),
(2, 'Melvin Edenilson', 'Perez', '94723591-8', '1202-170290-982-3', '3Â° Av, Sur, #8, Panchimalco, San Salvador', '2661-5113', '7456-1298', '7270-2910', 'melvin.perez@yahoo.com'),
(3, 'Sear J.', 'ClÃ­maco', '09876543-2', '1201-230591-103-6', '6ta Calle Pte. #13, Barrio Yusique Chinameca', '2661-0931', '7678-2099', '7861-3342', 'searclimaco@gmail.com'),
(4, 'Ronald Alexis', 'MartÃ­nez', '12784066-7', '1204-230989-666-8', 'Colonia Los Naranjos, Pol. B, #60, Nueva Guadalupe', '2668-7321', '6520-8811', '', 'gebisys@gmail.com'),
(5, 'SofÃ­a Elizabeth', 'Marquez Argueta', '65210874-5', '1205-140594-863-7', 'Urbanizacion Nuevo EdÃ©n,Pje 29, #17, Jucuapa', '2662-0921', '7428-5121', '7834-9981', 'sofiaargueta94@hotmail.com'),
(7, 'Keyri BeatrÃ­z', 'LÃ³pez', '12345678-9', '1201-111291-101-3', 'UrbanizaciÃ³n Jardines De Monte Blanco, Pje 21, #12', '2663-1215', '7378-0050', '', 'bealopez91@hotmail.com'),
(8, 'Roger', 'Merlos', '73081026-7', '1205-251260-104-8', 'CantÃ³n San Antonio, #12, Chinameca', '', '7368-1161', '', ''),
(9, 'Salvador Victoriano', 'ChÃ¡vez Romero', '36917389-5', '1205-150276-101-8', 'Colonia El Cafetal, Pje Principal, #22, Chinameca', '2661-1122', '7688-3355', '6509-0021', 'chambachavez@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rentas`
--

CREATE TABLE `rentas` (
  `id` int(10) NOT NULL,
  `clientid` int(10) NOT NULL,
  `autoid` int(10) NOT NULL,
  `dateo` date NOT NULL,
  `datei` date NOT NULL,
  `datet` date NOT NULL,
  `total` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `rentas`
--

INSERT INTO `rentas` (`id`, `clientid`, `autoid`, `dateo`, `datei`, `datet`, `total`) VALUES
(1, 3, 1, '2016-10-03', '2016-10-05', '2016-10-03', '150.00'),
(2, 2, 6, '2016-10-03', '2016-10-06', '2016-10-03', '75.00'),
(3, 1, 21, '2016-10-04', '2016-10-05', '2016-10-04', '35.00'),
(7, 4, 9, '2016-10-05', '2016-10-07', '2016-10-05', '25.00'),
(8, 9, 13, '2016-10-05', '2016-10-08', '2016-10-05', '90.00'),
(9, 5, 15, '2016-10-10', '2016-10-14', '2016-10-05', '140.00'),
(11, 8, 8, '2016-10-06', '2016-10-12', '2016-10-06', '270.00'),
(12, 1, 10, '2016-10-07', '2016-10-12', '2016-10-07', '177.50'),
(13, 9, 2, '2016-10-14', '2016-10-18', '2016-10-14', '142.00'),
(14, 7, 4, '2016-10-19', '2016-10-22', '2016-10-19', '105.00'),
(15, 2, 23, '2016-10-16', '2016-10-20', '2016-10-20', '122.00'),
(16, 3, 13, '2016-10-13', '2016-10-15', '2016-10-20', '60.00'),
(17, 5, 15, '2016-10-17', '2016-10-21', '2016-10-20', '140.00'),
(18, 4, 21, '2016-10-18', '2016-10-21', '2016-10-20', '105.00'),
(19, 3, 1, '2016-10-20', '2016-10-27', '2016-10-20', '525.00'),
(20, 8, 6, '2016-10-20', '2016-10-22', '2016-10-20', '50.00'),
(22, 8, 24, '2016-11-01', '2016-11-05', '2016-11-01', '160.00'),
(23, 7, 15, '2016-11-01', '2016-11-08', '2016-11-01', '245.00'),
(24, 1, 13, '2016-11-01', '2016-11-02', '2016-11-01', '30.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `pass` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL,
  `alias` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `alias`, `level`) VALUES
(1, 'Sear', '827ccb0eea8a706c4c34a16891f84e7b', 'Searito', 0),
(2, 'Searito', '2dad14b492a18c7cabc05ed07a339bfc', 'Sear ClÃ­maco', 1),
(3, 'Marcelo', 'e10adc3949ba59abbe56e057f20f883e', 'Marcelo MorÃ¡n', 0),
(4, 'Marceline', '72c6f15e23d4ff35164bf813f53a4fdc', 'Marceline Portillo', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placa` (`placa`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dui` (`dui`,`licencia`,`tcel`);

--
-- Indices de la tabla `rentas`
--
ALTER TABLE `rentas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autos`
--
ALTER TABLE `autos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `rentas`
--
ALTER TABLE `rentas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
