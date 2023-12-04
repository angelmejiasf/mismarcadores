-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2023 a las 17:31:25
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
-- Base de datos: `mismarcadores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bundesliga`
--

CREATE TABLE `bundesliga` (
  `equipolocal` varchar(30) NOT NULL,
  `equipovisitante` varchar(30) NOT NULL,
  `resultadolocal` int(2) NOT NULL,
  `resultadovisitante` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bundesliga`
--

INSERT INTO `bundesliga` (`equipolocal`, `equipovisitante`, `resultadolocal`, `resultadovisitante`) VALUES
('Bayern de Munich', '1. FC Heidenheim 1846', 2, 0),
('RB Leipzig', 'Eintracht Frankfurt', 2, 1),
('Borussia Dortmund', 'VfB Stuttgart', 2, 2),
('Werder Bremen', 'Bayern Leverkusen', 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laligaeasports`
--

CREATE TABLE `laligaeasports` (
  `equipolocal` varchar(30) NOT NULL,
  `equipovisitante` varchar(30) NOT NULL,
  `resultadolocal` int(2) NOT NULL,
  `resultadovisitante` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `laligaeasports`
--

INSERT INTO `laligaeasports` (`equipolocal`, `equipovisitante`, `resultadolocal`, `resultadovisitante`) VALUES
('RCD Mallorca', 'Cadiz CF', 0, 1),
('FC Barcelona', 'UD ALMERIA', 3, 1),
('ATLETICO DE MADRID', 'Deportivo Alaves', 0, 1),
('REAL MADRID CF', 'VALENCIA CF', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premierleague`
--

CREATE TABLE `premierleague` (
  `equipolocal` varchar(30) NOT NULL,
  `equipovisitante` varchar(30) NOT NULL,
  `resultadolocal` int(2) NOT NULL,
  `resultadovisitante` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `premierleague`
--

INSERT INTO `premierleague` (`equipolocal`, `equipovisitante`, `resultadolocal`, `resultadovisitante`) VALUES
('Chelsea FC', 'Everton FC', 1, 1),
('Liverpool FC', 'Luton Town FC', 4, 0),
('Manchester United FC', 'Burnley FC', 0, 0),
('Manchester City FC', 'Arsenal FC', 2, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
