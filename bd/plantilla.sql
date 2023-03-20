-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2023 a las 22:00:15
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `plantilla`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `nombre_completo` text NOT NULL,
  `correo_electronico` text NOT NULL,
  `contrasena` text NOT NULL,
  `confirmar_contrasena` text NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nivel` text NOT NULL,
  `imagen` text NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha_alta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nombre_completo`, `correo_electronico`, `contrasena`, `confirmar_contrasena`, `fecha_nacimiento`, `nivel`, `imagen`, `estado`, `fecha_alta`) VALUES
(1, 'NOE NORBERTO GUZMAN LOPEZ', 'noe.guzman@uabc.edu.mx', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', '1997-06-01', 'Administrador', 'views/assets/img/usuario_default.png', 0, '2023-03-18'),
(2, 'RICHELLE ANN GERONIMO APAN', 'richelle.geronimo@uabc.edu.mx', '$2a$07$asxx54ahjppf45sd87a5auqvBLORXx0K0k2BO/CtnzfiwTzbNOZgO', '$2a$07$asxx54ahjppf45sd87a5auqvBLORXx0K0k2BO/CtnzfiwTzbNOZgO', '1999-02-05', 'Supervisor', '', NULL, '2023-03-19'),
(3, 'MARIA ANGELICA ASTORGA VARGAS', 'angelica.astorga@uabc.edu.mx', '$2a$07$asxx54ahjppf45sd87a5aukR8YBxUa8PWKOmCouU4GOJTI4VuXKa2', '$2a$07$asxx54ahjppf45sd87a5aukR8YBxUa8PWKOmCouU4GOJTI4VuXKa2', '1987-05-02', 'Administrador', '', NULL, '2023-03-19'),
(4, 'DANIELA CHAVEZ HERNANDEZ', 'daniela.chavez@uabc.edu.mx', '$2a$07$asxx54ahjppf45sd87a5aufU9zR.QEVeGtiFhIxJyIKwa7gHQGUeW', '$2a$07$asxx54ahjppf45sd87a5aufU9zR.QEVeGtiFhIxJyIKwa7gHQGUeW', '1998-03-04', 'Supervisor', '', NULL, '2023-03-19'),
(5, 'MONICA CRISTINA LAM MORA', 'monica.lam@uabc.edu.mx', '$2a$07$asxx54ahjppf45sd87a5augvirCmnMWmoK/HslmxtLawzEUEr/l/O', '$2a$07$asxx54ahjppf45sd87a5augvirCmnMWmoK/HslmxtLawzEUEr/l/O', '1988-07-22', 'Administrador', '', NULL, '2023-03-19'),
(6, 'JOEL HUMBERTO GUZMAN LOPEZ', 'joel.guzman@uabc.edu.mx', '$2a$07$asxx54ahjppf45sd87a5aur3y3hpOZhQHOXxL.eNM6VSgO2mE2Tt6', '$2a$07$asxx54ahjppf45sd87a5aur3y3hpOZhQHOXxL.eNM6VSgO2mE2Tt6', '1996-03-02', 'Supervisor', '', NULL, '2023-03-20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
