-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 10:10 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `books`
--

-- --------------------------------------------------------

--
-- Table structure for table `autores`
--

CREATE TABLE `autores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `universidad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `autores`
--

INSERT INTO `autores` (`id`, `nombre`, `universidad`) VALUES
(2, 'asd234', 'asdt'),
(4, 'asdas', 'dddsakjn ');

-- --------------------------------------------------------

--
-- Table structure for table `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombre_del_autor` varchar(50) NOT NULL,
  `anio_publicacion` int(11) DEFAULT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `id_autor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `libros`
--

INSERT INTO `libros` (`id`, `nombre`, `nombre_del_autor`, `anio_publicacion`, `descripcion`, `id_autor`) VALUES
(1, 'asd', 'asdasd', 21231, 'asd', NULL),
(6, 'dsadas', 'asdads', 222212, '', NULL),
(7, 'a', 'dasdas', 555, '', NULL),
(8, 'El sonámbulo', 'asd', 2019, 'El arquitecto Leon Nader y su mujer, Natalie, acaban de instalarse en un bonito piso. Una mañana, Natalie empieza a empaquetar sus cosas y abandona rápidamente la vivienda, con la cara amoratada y los brazos heridos. Leon sale en su búsqueda desconcertado y pronto se da cuenta de que Natalie ha desaparecido. Leon, quien padecía sonambulismo cuando era pequeño, había llegado a recibir tratamiento psiquiátrico debido a su comportamiento agresivo mientras dormía. Ahora piensa que la desaparición de su esposa puede estar relacionada con su antigua enfermedad. ¿Será él el único culpable? ¿Pudo hacerle algo a Natalie mientras dormía?', NULL),
(9, 'El héroe perdido', 'asd', 2014, 'Cuando Jason despierta sabe que algo va muy mal. Está en un autobúscamino de un campamento para chicos problemáticos. Y le acompañan Piper-una muchacha (bastante guapa, por cierto) que dice que es su novia- yel que parece ser su mejor amigo, Leo...Pero él no recuerda nada: ni quién es ni cómo ha llegado allí.Pocas horas después, los tres descubrirán no solo que son hijos dedioses del Olimpo sino que su destino es cumplir una profecía de locos:liberar a Hera, diosa de la furia, de las garras de un enemigo que llevamucho tiempo planeando su venganza...«Con toda la acción, el ingenio y el corazón habituales en Riordan.»Publisher\'s Weekly', NULL),
(10, 'La marca de Antenea', 'sad', 2014, 'El destino de la humanidad pende de un hilo: Gea ha abierto de par enpar las Puertas de la Muerte para liberar a sus despiadados monstruos.Los únicos que pueden cerrarlas son Percy, Jason, Piper, Hazel, Frank,Leo y Annabeth, el equipo de semidioses griegos y romanos elegido poruna antigua profecía. Pero su misión es todavía más difícil de lo queparece: sospechan que para encontrar las puertas deberán cruzar elocéano, tienen solo seis días para conseguirlo y, por si fuera poco,acaba de estallar la guerra entre sus dos campamentos y ahora ellos sonun objetivo...¿Lograrán ganar esta carrera de obstáculos contrarreloj?', NULL),
(11, 'das', 'asd', 33, '33a', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
(1, 'webadmin@admin.com', '$2a$12$Si3doIhGGL3t0xd34VKGaeZEGxai4/T5gFl710LI.FWUj/CmvK9/2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor` (`id_autor`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autores`
--
ALTER TABLE `autores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
