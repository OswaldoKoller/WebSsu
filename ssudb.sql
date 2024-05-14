-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2023 a las 20:06:29
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ssu`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id_ficha` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_especialidad` int(11) DEFAULT NULL,
  `fecha_atencion` date DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `id_medico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id_ficha`, `id_paciente`, `id_especialidad`, `fecha_atencion`, `estado`, `id_medico`) VALUES
(1, 1, 1, '2023-10-18', '1', NULL),
(2, 5, 1, '2023-11-07', '1', NULL),
(3, 1, 1, '2023-11-10', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_clinica`
--

CREATE TABLE `historia_clinica` (
  `id_historia` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `atencion` date DEFAULT NULL,
  `motivo_consulta` text DEFAULT NULL,
  `diagnostico` text DEFAULT NULL,
  `analisis` text DEFAULT NULL,
  `tratamiento` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `historia_clinica`
--

INSERT INTO `historia_clinica` (`id_historia`, `fecha`, `atencion`, `motivo_consulta`, `diagnostico`, `analisis`, `tratamiento`) VALUES
(1, '2023-09-11', '2023-09-11', 'fiebre', 'infeccion ', 'hemograma', 'paracetamol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `medicos` int(11) DEFAULT NULL,
  `dia` varchar(20) NOT NULL,
  `hora_ini` time NOT NULL,
  `hora_fin` time NOT NULL,
  `canti_ficha` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasignacion`
--

CREATE TABLE `tasignacion` (
  `id_asignacion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `fecha_asignacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tasignacion`
--

INSERT INTO `tasignacion` (`id_asignacion`, `id_usuario`, `id_rol`, `fecha_asignacion`) VALUES
(1, 3, 2, '0000-00-00 00:00:00'),
(2, 20, 2, '2023-09-02 15:55:52'),
(3, 1, 1, '2023-09-02 18:06:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tespecialidad`
--

CREATE TABLE `tespecialidad` (
  `id_especialidad` int(11) NOT NULL,
  `nombre_especialidad` varchar(255) NOT NULL,
  `estado` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tespecialidad`
--

INSERT INTO `tespecialidad` (`id_especialidad`, `nombre_especialidad`, `estado`) VALUES
(1, 'MEDICO GENERAL', 1),
(2, 'PEDIATRIA', 1),
(13, 'CARDIOLOGIA', 1),
(14, 'PEDIATRIA', 1),
(15, 'OTORRINA', 0),
(16, 'DERMATOLOGIA', 1),
(17, 'GERIATRIA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tficha`
--

CREATE TABLE `tficha` (
  `id_ficha` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `fecha_atencion` date NOT NULL,
  `estado` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tficha`
--

INSERT INTO `tficha` (`id_ficha`, `id_paciente`, `id_especialidad`, `id_medico`, `fecha_atencion`, `estado`) VALUES
(1, 1, 1, 3, '2023-11-11', '1'),
(2, 2, 2, 2, '2023-11-11', '1'),
(3, 2, 1, 1, '2023-11-11', '1'),
(4, 11, 1, 2, '2023-11-09', '1'),
(5, 14, 1, 3, '2023-11-12', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmedico`
--

CREATE TABLE `tmedico` (
  `id_medico` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `estado` int(2) DEFAULT NULL,
  `id_especialidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tmedico`
--

INSERT INTO `tmedico` (`id_medico`, `id_persona`, `estado`, `id_especialidad`) VALUES
(1, 3, 1, 1),
(2, 5, 1, 1),
(3, 7, 1, 1),
(4, 31, 1, 2),
(5, 7, 1, 2),
(6, 26, 1, 13),
(7, 39, 1, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmedicos`
--

CREATE TABLE `tmedicos` (
  `id_medico` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `id_persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tmedicos`
--

INSERT INTO `tmedicos` (`id_medico`, `estado`, `id_persona`) VALUES
(1, 1, 0),
(2, 1, 0),
(3, 0, 0),
(4, 0, 0),
(5, 1, 0),
(6, 0, 0),
(7, 0, 0),
(8, 0, 0),
(9, 1, 0),
(10, 1, 0),
(11, 1, 0),
(12, 1, 0),
(13, 1, 0),
(14, 1, 0),
(15, 0, 0),
(16, 0, 0),
(17, 0, 0),
(18, 0, 0),
(19, 1, 0),
(20, 1, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpaciente`
--

CREATE TABLE `tpaciente` (
  `id_paciente` int(11) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tpaciente`
--

INSERT INTO `tpaciente` (`id_paciente`, `id_persona`, `fecha_creacion`) VALUES
(1, 10, '2023-09-08'),
(2, 33, '2023-09-08'),
(3, 30, '2023-09-09'),
(4, 3, '2023-09-09'),
(5, 8, '2023-09-09'),
(7, 26, '2023-09-20'),
(8, 28, '2023-09-20'),
(9, 27, '2023-10-24'),
(10, 34, '2023-10-24'),
(11, 35, '2023-10-24'),
(12, 17, '2023-10-31'),
(13, 36, '2023-10-31'),
(14, 1, '2023-11-03'),
(15, 41, '2023-11-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpersona`
--

CREATE TABLE `tpersona` (
  `id_persona` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tpersona`
--

INSERT INTO `tpersona` (`id_persona`, `nombre`, `apellido`, `fecha_nacimiento`, `telefono`, `correo`, `direccion`, `fecha_creacion`, `estado`) VALUES
(1, 'OSWALDO MAURICIO', 'KOLLER', '1997-11-28', '70877507', 'okoller@ssusrz.org', 'z/ norte', '2023-06-22 17:53:18', 1),
(3, 'JOAQUIN', 'SORIA', '1970-11-20', '77664112', 'jsoria@ssusrz.org', 'av. alemana', '2023-06-22 17:57:05', 1),
(5, 'oscar', 'arancibia', '1997-11-28', '7777777', 'oarancibia@example.org', 'sur', '2023-07-18 16:05:56', 1),
(6, 'ricardo', 'rojo ortiz', '1990-01-26', '708777452', 'rrojo@ssusrz.org', 'b/ la colorada 5to anillo', '2023-07-18 20:48:09', 1),
(7, 'mario', 'sanchez', '1945-01-28', '7412589', 'msanchez@ssusrz.org', 'alemana 4to anillo', '2023-07-18 20:55:35', 0),
(8, 'mauricio', 'Olguin', '1997-11-28', '77664771', 'qwertysext@gmail.com', '3035 juan pablo II 3035', '2023-07-18 21:02:28', 1),
(9, 'Cesar', 'Montoya', '1945-04-25', '12345678', 'cmontoya@ssusrz.org', 'cotoca', '2023-07-19 19:30:51', 1),
(10, 'German', 'Torrico', '1970-09-08', '5286447', 'gtorrico@ssusrz.org', 's/b', '2023-07-19 19:34:33', 0),
(11, 'Oswaldo', 'Olguin', '1997-11-28', '77665542', 'qwertysext@gmail.com', '3035 juan pablo II 3035', '2023-08-15 23:46:14', 1),
(12, 'pablo', 'dura', '1999-08-20', '202312355', 'pdura@ssusrz.org', 'norte', '2023-08-16 18:45:07', 1),
(13, 'pablo', 'duran', '1999-08-20', '2023123456', 'pduran@ssusrz.org', 'norte', '2023-08-16 18:49:13', 1),
(16, 'ricardo', 'rojo', '1970-01-26', '7894562', 'rrojo@ssusrz.org', 'norte', '2023-08-16 18:57:07', 1),
(17, 'joaquin', 'iver', '1985-09-28', '528494442', 'jiver@ssusrz.org', 'centro', '2023-08-16 19:01:23', 1),
(18, 'test', 'test', '1991-09-01', '123', 'asda@ssusrz.org', 'norte', '2023-08-17 00:20:16', 0),
(19, 'test1', 'teste1', '1991-02-01', '123456', 'hola@ssusr.org', 'noete', '2023-08-17 00:23:16', 0),
(20, 'nuevo', 'tester', '1992-01-01', '223789', 'nuevo@ssusrz.org', 'norte', '2023-08-17 00:33:40', 1),
(25, 'susy', 'olguin', '1970-03-03', '70493070', 'solguin@ssusrz.org', 'sureste', '2023-08-19 04:57:46', 1),
(26, 'ybeth', 'maura', '2023-08-01', '123456789', 'ymaura@ssusrz.org', 'norte', '2023-08-19 19:40:58', 1),
(27, 'liliana', 'castillo', '1993-08-10', '12345678', 'lcastillo@ssusrz.org', 'sur', '2023-08-19 19:44:02', 1),
(28, 'daymi', 'calderon', '2022-02-02', '1234567', 'jcalderon@ssusrz.org', 'norte', '2023-08-19 20:21:00', 1),
(29, 'cristian', 'laime', '1999-08-28', '857496', 'claime@ssusrz.org', 'norte', '2023-08-19 22:38:13', 1),
(30, 'CESAR EMILIO', 'MONTOYA QUIROGA', '1980-05-08', '78945622', 'cmontoya@ssusrz.org', 'cotoca coty', '2023-08-21 12:14:05', 1),
(31, 'JIMENA', 'CUELLAR', '2022-01-28', '12345687', 'JCUELLAR@SSUSRZ.ORG', 'NORTE', '2023-08-30 17:44:22', 1),
(32, 'FLAVIA ', 'TERRAZAS', '2007-01-26', '70493055', 'fterrazas@ssusrz.org', '3 PASOS ', '2023-09-02 00:38:04', 1),
(33, 'mireya', 'paz', '1199-11-28', '123456', 'mpaz@ssusrz.org', 'norte', '2023-09-08 17:29:02', 1),
(34, 'nicol', 'guzman', '1975-11-28', '70841991', 'nguzman@ssusrz.org', 'el palmar', '2023-10-24 18:38:36', 1),
(35, 'naida', 'cardozo', '2000-05-12', '7984566', 'ncardozo@ssusrz.org', 'los lotes', '2023-10-24 18:40:44', 1),
(36, 'rosa maria', 'ribera', '1970-10-06', '70411582', 'rribera@ssursz.org', 'remanzo', '2023-10-24 18:41:35', 1),
(39, 'KATERINE', 'CRUZ', '1997-02-01', '7412589', 'kcruz@ssusrz.org', 'av. jujuy', '2023-11-06 18:07:01', 1),
(41, 'ROGER', 'FOREST', '1970-02-15', '74586922', 'rforest@ssusrz.org', 'norte', '2023-11-06 18:14:15', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trol`
--

CREATE TABLE `trol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(100) NOT NULL,
  `descripcion_rol` varchar(100) DEFAULT NULL,
  `estado_rol` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `trol`
--

INSERT INTO `trol` (`id_rol`, `nombre_rol`, `descripcion_rol`, `estado_rol`) VALUES
(1, 'ADMINISTRADOR', 'ACCESO TOTAL', '1'),
(2, 'USUARIO', 'TIENE ACCESO A CIERTAS AREAS DEL SISTEMA', '1'),
(3, 'MEDICO', 'ATENCION DE CONSULTA EXTERNA', '1'),
(4, 'USUARIO', 'Usuario del sistema', '0'),
(5, 'MAESTRO', 'maestro', '0'),
(6, 'PACIENTE', 'Paciente sin acceso al sistema', '0'),
(7, 'ODONTOLOGO', 'odontologos de tiempo completo', '0'),
(8, 'PACIENTE', 'medicos que atienden las consultas', '0'),
(9, 'MEDICO2', 'medicos que atienden las consultas', '0'),
(10, 'ENDODONCIA', 'tratamientos de endodoncia', '0'),
(11, 'AUXILIAR', 'auxiliar de odontologia', '0'),
(13, 'SUPERVISOR', 'supervisa el sistema para ver los usuarios', '0'),
(14, 'CAJERO', 'Cajero que recibe los pagos de los pacientes', '0'),
(15, 'MEDICO', 'TIENE ACCESO A LA TRANSACCIONALES DEL SISTEMA', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuario`
--

CREATE TABLE `tusuario` (
  `id_persona` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) DEFAULT NULL,
  `pass_usuario` varchar(100) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tusuario`
--

INSERT INTO `tusuario` (`id_persona`, `id_usuario`, `nombre_usuario`, `pass_usuario`, `estado`) VALUES
(1, 1, 'omko', 'be273ec31b3401f18a6c6b7254ce1f75', '1'),
(3, 3, 'jsoria', 'jsoria1234', '1'),
(5, 4, 'oarancibia1', 'b4500c8ce4a3b58432dedd3a08950fd5', '1'),
(6, 13, 'rrojo', '8a97994e1d21623ad09ed30c954613b3', '0'),
(7, 14, 'mario', 'aeb34368c5d53aee32431b5386f71c56', '1'),
(8, 15, 'mauricio123', 'b0aa51bf1f1ee0df54109e5d313ba0af', '1'),
(25, 16, 'susyo', 'susy123', '1'),
(26, 17, 'ymaura', 'ymaura', '1'),
(27, 18, 'lcastillo', 'lcastillo', '1'),
(28, 19, 'daymi', 'jcalderon123', '1'),
(29, 20, 'claime', 'claime', '1'),
(30, 21, 'cmontoya', 'cmontoya', '0'),
(31, 22, 'jcuellar', 'jcuellar', '1'),
(32, 23, 'fterrazas', 'fterrazas', '1'),
(33, 24, 'mpaz', 'mpaz', '1'),
(34, 25, 'nguzman', 'nguzmaan00$$', '1'),
(35, 26, 'ncardozo', 'ncardozo00$$', '1'),
(36, 27, 'rribera', 'rribera00$$', '1'),
(39, 30, 'kcruz', 'kcruz', '1'),
(41, 32, 'rforest', 'rforest123', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`id_ficha`),
  ADD KEY `fk_ficha_paciente` (`id_paciente`),
  ADD KEY `fk_ficha_especialidad` (`id_especialidad`);

--
-- Indices de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD PRIMARY KEY (`id_historia`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `tasignacion`
--
ALTER TABLE `tasignacion`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `tespecialidad`
--
ALTER TABLE `tespecialidad`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `tficha`
--
ALTER TABLE `tficha`
  ADD PRIMARY KEY (`id_ficha`),
  ADD KEY `fk_tficha_paciente` (`id_paciente`),
  ADD KEY `fk_tficha_especialidad` (`id_especialidad`),
  ADD KEY `fk_tficha_medico` (`id_medico`);

--
-- Indices de la tabla `tmedico`
--
ALTER TABLE `tmedico`
  ADD PRIMARY KEY (`id_medico`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `fk_tmedico_tespecialidad` (`id_especialidad`);

--
-- Indices de la tabla `tmedicos`
--
ALTER TABLE `tmedicos`
  ADD PRIMARY KEY (`id_medico`);

--
-- Indices de la tabla `tpaciente`
--
ALTER TABLE `tpaciente`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `tpersona`
--
ALTER TABLE `tpersona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `trol`
--
ALTER TABLE `trol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tusuario`
--
ALTER TABLE `tusuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_persona` (`id_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id_ficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  MODIFY `id_historia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tasignacion`
--
ALTER TABLE `tasignacion`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tespecialidad`
--
ALTER TABLE `tespecialidad`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tficha`
--
ALTER TABLE `tficha`
  MODIFY `id_ficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tmedico`
--
ALTER TABLE `tmedico`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tmedicos`
--
ALTER TABLE `tmedicos`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tpaciente`
--
ALTER TABLE `tpaciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tpersona`
--
ALTER TABLE `tpersona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `trol`
--
ALTER TABLE `trol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tusuario`
--
ALTER TABLE `tusuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `ficha_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `tpaciente` (`id_paciente`),
  ADD CONSTRAINT `ficha_ibfk_2` FOREIGN KEY (`id_especialidad`) REFERENCES `tespecialidad` (`id_especialidad`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`medicos`) REFERENCES `tmedicos` (`id_medico`);

--
-- Filtros para la tabla `tasignacion`
--
ALTER TABLE `tasignacion`
  ADD CONSTRAINT `tasignacion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tusuario` (`id_usuario`),
  ADD CONSTRAINT `tasignacion_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `trol` (`id_rol`);

--
-- Filtros para la tabla `tficha`
--
ALTER TABLE `tficha`
  ADD CONSTRAINT `fk_tficha_especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `tespecialidad` (`id_especialidad`),
  ADD CONSTRAINT `fk_tficha_medico` FOREIGN KEY (`id_medico`) REFERENCES `tmedico` (`id_medico`),
  ADD CONSTRAINT `fk_tficha_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `tpaciente` (`id_paciente`);

--
-- Filtros para la tabla `tmedico`
--
ALTER TABLE `tmedico`
  ADD CONSTRAINT `fk_tmedico_tespecialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `tespecialidad` (`id_especialidad`),
  ADD CONSTRAINT `tmedico_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `tpersona` (`id_persona`);

--
-- Filtros para la tabla `tpaciente`
--
ALTER TABLE `tpaciente`
  ADD CONSTRAINT `tpaciente_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `tpersona` (`id_persona`);

--
-- Filtros para la tabla `tusuario`
--
ALTER TABLE `tusuario`
  ADD CONSTRAINT `tusuario_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `tpersona` (`id_persona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
