-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2015 a las 19:26:25
-- Versión del servidor: 5.6.26-log
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `admision`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE IF NOT EXISTS `estudiante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nacionalidad` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) NOT NULL,
  `estado_Civil` varchar(30) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `id_Tutor` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudianteaprobado`
--

CREATE TABLE IF NOT EXISTS `estudianteaprobado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nacionalidad` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) NOT NULL,
  `estado_Civil` varchar(30) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `id_Tutor` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_Usuario` int(11) NOT NULL,
  `id_EstudianteViejo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `estudianteaprobado`
--

INSERT INTO `estudianteaprobado` (`id`, `nombres`, `apellidos`, `fecha_nacimiento`, `nacionalidad`, `telefono`, `celular`, `direccion`, `estado_Civil`, `sexo`, `id_Tutor`, `fecha`, `id_Usuario`, `id_EstudianteViejo`) VALUES
(1, 'Leandro', 'Jimenez Jimenez', '1990-02-07', 'Dominicana', '1121212', '454545', 'Calle Dajabon #157', 'Casado(a)', 'Maculino', 1, '2015-12-04', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajeriaadmin`
--

CREATE TABLE IF NOT EXISTS `mensajeriaadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asunto` varchar(40) NOT NULL,
  `cuerpo` text NOT NULL,
  `fecha` date NOT NULL,
  `usuario` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `mensajeriaadmin`
--

INSERT INTO `mensajeriaadmin` (`id`, `asunto`, `cuerpo`, `fecha`, `usuario`) VALUES
(1, 'Inscripci&oacute;n', '<font size= "4" style="font-family: Courrier New;  text-align: justify;"><p>El solicitante "Leandro" ha completado su formulario de  inscrito y traido todos los papeles correspondientes, esta listo para el examen de admisi&oacute;n, notifique si todos sus papeles estan correctos.</p></font>\r\n			<font size= "4" style="font-family: Courrier New;  text-align: justify;"><p>Click en <a href= "verFormulario.php?vorm=aansoeker&id=1" style = "text-decoration:none">link</a> para ver formulario de inscripci&oacute;n de este solicitante.</p></font>', '2015-12-04', 'Leandro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajesestudiantes`
--

CREATE TABLE IF NOT EXISTS `mensajesestudiantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asunto` varchar(50) NOT NULL,
  `cuerpo` text NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `mensajesestudiantes`
--

INSERT INTO `mensajesestudiantes` (`id`, `asunto`, `cuerpo`, `id_usuario`, `fecha`) VALUES
(1, 'Inscripci&oacute;n!', 'Su formulario de inscripci&oacute;n ha llegado exitosamente, se le notificara si se encuentra alg&uacute;n error en sus datos.', 1, '2015-12-04'),
(2, 'Has sido aprobado!', 'Felicidades usted ha sido aceptado, para ingresar a esta instituci&oacute;n.', 1, '2015-12-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notificacion` text NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutores`
--

CREATE TABLE IF NOT EXISTS `tutores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `nacionalidad` varchar(30) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `profesion` varchar(30) NOT NULL,
  `estado_Civil` varchar(30) NOT NULL,
  `sexo` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tutores`
--

INSERT INTO `tutores` (`id`, `nombres`, `apellidos`, `nacionalidad`, `telefono`, `celular`, `direccion`, `profesion`, `estado_Civil`, `sexo`) VALUES
(1, 'Jose Rafael', 'Aquino', 'Dominicana', '47878444', '77878878', 'Calle Dajabon #157', 'Profesor', 'Comprometido(a)', 'Maculino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `estado` varchar(50) DEFAULT '"No hay solicitud!"',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `telefono`, `celular`, `usuario`, `email`, `clave`, `estado`) VALUES
(1, 'Leandro Jimenez', '1212152', '212121', 'Leandro', 'elhombremasbello@hotmail.com', '123', '"Aprobado!"');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
