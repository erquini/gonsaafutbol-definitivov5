-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2025 a las 17:15:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gonsa_futbol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opiniones`
--

CREATE TABLE `opiniones` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `puntuacion` tinyint(4) DEFAULT NULL CHECK (`puntuacion` between 1 and 5),
  `comentario` text DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `opiniones`
--

INSERT INTO `opiniones` (`id`, `producto_id`, `usuario_id`, `puntuacion`, `comentario`, `ciudad`, `fecha`) VALUES
(18, NULL, 18, 5, '¡Excelente calidad y muy rápido el envío!', 'Madrid', '2025-05-20 12:37:00'),
(19, NULL, 19, 4, 'Buena atención al cliente. Me resolvieron dudas enseguida.', 'Sevilla', '2025-05-20 12:37:00'),
(20, NULL, 20, 3, 'Buena camiseta pero el tallaje era un poco justo.', 'Valencia', '2025-05-20 12:37:00'),
(21, NULL, 21, 5, 'Me encantó el diseño retro. Repetiré sin duda.', 'Granada', '2025-05-20 12:37:00'),
(22, NULL, 22, 4, 'Llegó a tiempo y bien empaquetado. Recomiendo.', 'Barcelona', '2025-05-20 12:37:00'),
(23, NULL, 23, 5, 'La camiseta es preciosa. Muy buena calidad.', 'Bilbao', '2025-05-20 12:37:00'),
(24, NULL, 24, 4, 'Todo bien, aunque tardó un día más de lo esperado.', 'Zaragoza', '2025-05-20 12:37:00'),
(25, NULL, 25, 5, 'Perfecto para regalar. Le encantó a mi pareja.', 'Córdoba', '2025-05-20 12:37:00'),
(26, NULL, 26, 3, 'Correcto, aunque esperaba mejor calidad en la tela.', 'Alicante', '2025-05-20 12:37:00'),
(27, NULL, 27, 5, 'Muy fácil de pedir y con muchas opciones de personalización.', 'Málaga', '2025-05-20 12:37:00'),
(32, NULL, 17, 3, 'Deja mucho que desear', 'Madrid', '2025-05-23 19:07:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) DEFAULT 0.00,
  `estado` enum('pendiente','pagado','enviado','entregado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `categoria`) VALUES
(1, 'Camiseta de Maldini 2006/2007', 'Camiseta icónica de Maldini en la temporada 2006/07.', 59.99, 12, 'assets/images/camiesta-maldini.jpg', 'AC Milan'),
(2, 'Camiseta de Maradona 1986', 'Camiseta legendaria de Maradona en el Mundial de 1986.', 69.99, 5, 'assets/images/camiseta_maradadona_futbol.jpg', 'Argentina'),
(3, 'Camiseta de ronaldo 2002', 'Camiseta con la que Ronaldo llevó a Brasil a la victoria en 2002.', 65.99, 20, 'assets/images/camiseta-ronaldo.jpg', 'Brasil'),
(4, 'Camiseta de Messi 2010', 'Camiseta de Messi en el Mundial de Sudáfrica 2010.', 74.99, 3, 'assets/images/barcelona.jpg', 'Barcelona'),
(5, 'Camiseta de Zidane 1998', 'Camiseta de Zidane en la Copa del Mundo 1998.', 79.99, 10, 'assets/images/zidane.jpg', 'Francia'),
(6, 'Camiseta de Ronaldinho 2005', 'Camiseta con la que Ronaldinho ganó el Balón de Oro en 2005.', 69.99, 7, 'assets/images/barcelona.jpg', 'FC Barcelona'),
(7, 'Camiseta de Cristiano Ronaldo 2008', 'Camiseta de Cristiano Ronaldo en su época dorada con el Manchester United.', 89.99, 4, 'assets/images/camiseta-ronaldi.jpg', 'Manchester United'),
(8, 'Camiseta de Neymar 2013', 'Camiseta de Neymar en su primera temporada con el FC Barcelona.', 79.99, 6, 'assets/images/ney.jpg', 'FC Barcelona'),
(9, 'Camiseta de Pelé 1970', 'La famosa camiseta de Pelé en el Mundial de 1970, una de las más legendarias.', 120.00, 2, 'assets/images/pele.jpg', 'Brasil'),
(10, 'Camiseta de Beckham 2003', 'Camiseta de David Beckham durante su tiempo en el Manchester United.', 85.99, 9, 'assets/images/beckam.jpg', 'Manchester United'),
(11, 'Camiseta de Thierry Henry 2004', 'Camiseta de Thierry Henry en su histórica temporada con el Arsenal.', 89.99, 5, 'assets/images/henry.jpg', 'Francia'),
(12, 'Camiseta de Van Basten 1988', 'Camiseta de Marco Van Basten en la Eurocopa 1988.', 79.99, 6, 'assets/images/van-basten.jpg', 'Holanda'),
(13, 'Camiseta de Messi 2014', 'Camiseta de Messi durante el Mundial de Brasil 2014.', 74.99, 8, 'assets/images/messi-2014.jpg', 'Barcelona'),
(14, 'Camiseta de Ronaldo 2016', 'Camiseta de Cristiano Ronaldo en su triunfo con Portugal en la Euro 2016.', 89.99, 4, 'assets/images/cris.jpg', 'Real Madrid'),
(15, 'Camiseta Edición Limitada', 'Una camiseta exclusiva en tirada limitada.', 39.99, 10, 'assets/images/recomendacion1.jpg', 'Especial'),
(16, 'Camiseta Retro 90s', 'Estilo clásico de los años 90, ideal para nostálgicos.', 29.99, 15, 'assets/images/recomendacion2.jpg', 'Vintage'),
(17, 'Pack 3 Camisetas Personalizadas', 'Pack especial con 3 camisetas totalmente personalizadas.', 59.99, 5, 'assets/images/recomendacion3.jpg', 'Varios'),
(18, 'Camiseta de Iniesta 2010', 'Camiseta con la que Iniesta marcó el gol de la final del Mundial 2010.', 84.99, 7, 'assets/images/iniesta.jpg', 'España'),
(19, 'Camiseta de Buffon 2006', 'Camiseta del mítico portero italiano en el Mundial de Alemania 2006.', 69.99, 4, 'assets/images/buffon.jpg', 'Italia'),
(20, 'Camiseta de Rooney 2004', 'Camiseta de Wayne Rooney en la Euro 2004 con Inglaterra.', 74.99, 6, 'assets/images/rooney.jpg', 'Inglaterra'),
(21, 'Camiseta de Xavi 2008', 'Camiseta de Xavi en la Eurocopa 2008 ganada por España.', 79.99, 5, 'assets/images/xavi.jpg', 'España'),
(22, 'Camiseta de Drogba 2007', 'Camiseta clásica de Didier Drogba durante su etapa en el Chelsea.', 69.99, 8, 'assets/images/drogba.jpg', 'Chelsea'),
(23, 'Camiseta de Kaká 2007', 'Camiseta del año en que Kaká ganó el Balón de Oro con el Milan.', 79.99, 4, 'assets/images/kaka.jpg', 'AC Milan'),
(24, 'Camiseta de Del Piero 2002', 'Camiseta retro de Del Piero en sus mejores años en la Juventus.', 69.99, 5, 'assets/images/delpiero.jpg', 'Juventus'),
(25, 'Camiseta de Robben 2014', 'Camiseta de Robben durante el Mundial de Brasil 2014.', 74.99, 6, 'assets/images/robben.jpg', 'Holanda'),
(26, 'Camiseta de Griezmann 2018', 'Camiseta del Mundial 2018 ganada por Francia.', 84.99, 5, 'assets/images/griezmann.jpg', 'Francia'),
(27, 'Camiseta de Lewandowski 2020', 'Camiseta de uno de los delanteros más letales del mundo.', 69.99, 7, 'assets/images/lewandowski.jpg', 'Polonia'),
(28, 'Camiseta de Totti 2006', 'Camiseta de Francesco Totti durante el Mundial de Alemania.', 79.99, 3, 'assets/images/totti.jpg', 'Italia'),
(29, 'Camiseta de Benzema 2022', 'Camiseta con la que Benzema brilló en la Champions 2022.', 89.99, 9, 'assets/images/benzema.jpg', 'Real Madrid'),
(30, 'Camiseta de Modric 2018', 'Camiseta de Modric cuando lideró a Croacia a la final del Mundial.', 89.99, 6, 'assets/images/modric.jpg', 'Croacia'),
(31, 'Camiseta de Haaland 2023', 'Camiseta de Erling Haaland tras su temporada goleadora histórica en el City.', 94.99, 7, 'assets/images/haaland.jpg', 'Manchester City'),
(32, 'Camiseta de Bellingham 2024', 'Camiseta de la revelación inglesa en su primera gran temporada con el Madrid.', 89.99, 6, 'assets/images/bellingham.jpg', 'Real Madrid');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('cliente','admin') DEFAULT 'cliente',
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `fecha_registro`, `telefono`, `direccion`, `avatar`) VALUES
(17, 'Gonzalo', 'gonzalocarbonelld@gmail.com', '123456', 'admin', '2025-05-14 16:28:20', '634830373', 'Calle Imagen 8', 'uploads/avatar_682f40ab408dc_WIN_20250522_17_20_03_Pro.jpg'),
(18, 'Carlos', 'carlos.madrid@example.com', '123456', 'cliente', '2025-05-20 12:34:50', '612345678', 'Calle Mayor 10', 'uploads/avatar3.jpg'),
(19, 'LauraF', 'laura.f@example.com', '123456', 'cliente', '2025-05-20 12:34:50', '623456789', 'Avenida Andalucía 45', 'uploads/avatar1.jpg'),
(20, 'PedroR', 'pedro.r@example.com', '123456', 'cliente', '2025-05-20 12:34:50', '634567890', 'Calle Río 12', 'uploads/avatar11.jpg'),
(21, 'SofíaG', 'sofia.g@example.com', '123456', 'cliente', '2025-05-20 12:34:50', '645678901', 'Camino del Sur 33', 'uploads/avatar2.jpg'),
(22, 'MarioA', 'mario.a@example.com', '123456', 'cliente', '2025-05-20 12:34:50', '656789012', 'Calle Luna 17', 'uploads/avatar5.jpg'),
(23, 'LucíaZ', 'lucia.z@example.com', '123456', 'cliente', '2025-05-20 12:34:50', '667890123', 'Av. Constitución 9', 'uploads/avatar9.jpg'),
(24, 'JorgeV', 'jorge.v@example.com', '123456', 'cliente', '2025-05-20 12:34:50', '678901234', 'Paseo de la Estación 21', 'uploads/avatar8.jpg'),
(25, 'ClaraM', 'clara.m@example.com', '123456', 'cliente', '2025-05-20 12:34:50', '689012345', 'Calle Olivo 88', 'uploads/avatar4.jpg'),
(26, 'DanielT', 'daniel.t@example.com', '123456', 'cliente', '2025-05-20 12:34:50', '690123456', 'Calle Pintor Rosales 50', 'uploads/avatar10.jpg'),
(27, 'AnaB', 'ana.b@example.com', '123456', 'cliente', '2025-05-20 12:34:50', '601234567', 'Av. Reyes Católicos 18', 'uploads/avatar6.jpg'),
(29, 'Alejandro', 'ale@gmail.com', '123456', 'cliente', '2025-05-23 16:59:53', '685784587', 'Calle alparraga', 'uploads/avatar_6830bd3e64c95_3208_juan_20241016233534.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `opiniones`
--
ALTER TABLE `opiniones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`producto_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `opiniones`
--
ALTER TABLE `opiniones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `opiniones`
--
ALTER TABLE `opiniones`
  ADD CONSTRAINT `opiniones_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `opiniones_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
