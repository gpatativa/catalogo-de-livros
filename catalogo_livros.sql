-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 11:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catalogo_livros`
--

-- --------------------------------------------------------

--
-- Table structure for table `autores`
--

CREATE TABLE `autores` (
  `Id_autor` int(11) NOT NULL,
  `nome_autor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `autores`
--

INSERT INTO `autores` (`Id_autor`, `nome_autor`) VALUES
(2, 'teste'),
(3, 'Banana Kong');

-- --------------------------------------------------------

--
-- Table structure for table `generos`
--

CREATE TABLE `generos` (
  `Id_genero` int(11) NOT NULL,
  `nome_genero` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `generos`
--

INSERT INTO `generos` (`Id_genero`, `nome_genero`) VALUES
(1, 'Ficção Científica'),
(2, 'Fantasia'),
(3, 'Romance'),
(4, 'Mistério'),
(5, 'Suspense'),
(6, 'Terror'),
(7, 'Aventura'),
(8, 'Drama'),
(9, 'Ficção Histórica'),
(10, 'Distopia'),
(11, 'Biografia/Autobiografia'),
(12, 'Memórias'),
(13, 'Autoajuda'),
(14, 'Poesia'),
(15, 'Ensaio'),
(16, 'Contos'),
(17, 'Literatura Clássica'),
(20, 'Infantil/Juvenil'),
(21, 'Quadrinhos'),
(22, 'Literatura Gótica'),
(23, 'Humor'),
(24, 'Realismo Mágico');

-- --------------------------------------------------------

--
-- Table structure for table `livros`
--

CREATE TABLE `livros` (
  `Id_livro` int(11) NOT NULL,
  `nome_livro` text NOT NULL,
  `ano_publicacao` year(4) DEFAULT NULL,
  `Id_autor` int(11) NOT NULL,
  `Id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livros`
--

INSERT INTO `livros` (`Id_livro`, `nome_livro`, `ano_publicacao`, `Id_autor`, `Id_genero`) VALUES
(3, 'teste', '0000', 2, 1),
(4, 'Harry Potter', '1997', 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`Id_autor`);

--
-- Indexes for table `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`Id_genero`);

--
-- Indexes for table `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`Id_livro`),
  ADD KEY `fk_livro_autor` (`Id_autor`),
  ADD KEY `fk_livro_genero` (`Id_genero`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autores`
--
ALTER TABLE `autores`
  MODIFY `Id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `generos`
--
ALTER TABLE `generos`
  MODIFY `Id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `livros`
--
ALTER TABLE `livros`
  MODIFY `Id_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `livros`
--
ALTER TABLE `livros`
  ADD CONSTRAINT `fk_livro_autor` FOREIGN KEY (`Id_autor`) REFERENCES `autores` (`Id_autor`),
  ADD CONSTRAINT `fk_livro_genero` FOREIGN KEY (`Id_genero`) REFERENCES `generos` (`Id_genero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
