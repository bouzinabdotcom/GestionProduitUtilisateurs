-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2020 at 12:26 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devoir`
--

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `idproduit` int(11) NOT NULL,
  `libelle` varchar(254) NOT NULL,
  `img` varchar(254) NOT NULL,
  `description` text NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`idproduit`, `libelle`, `img`, `description`, `prix`) VALUES
(2, 'Couscous', 'couscous.jpeg', 'Couscous is a tiny pasta made of wheat or barley. Although couscous was traditionally hand-rolled, these days it\'s made by machine: Coarsely-ground durum wheat (semolina) is moistened and tossed with fine wheat flour until it forms tiny, round balls.', 69),
(3, 'Paella', 'paella.jpeg', 'Paella is a traditional dish of Spain. Its home is Valencia, but variations exist in the different Spanish provinces. A colorful mixture of saffron-flavored rice and various meats, paella\'s name comes from the paellera, the flat, round pan in which it is cooked.', 200),
(12, 'Tacos', 'tacos.jpeg', 'Un tacos français ou un tacos de Lyon, aussi appelé matelas, par opposition au taco, originaire du Mexique, se compose d\'une galette de blé repliée sur elle-même et grillée contenant toujours une garniture qui est le plus souvent à base de viande certifiée halal, de frites et de sauce.', 69);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `login` varchar(254) NOT NULL,
  `pwd` varchar(254) NOT NULL,
  `role` enum('admin','lecteur') NOT NULL DEFAULT 'lecteur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `login`, `pwd`, `role`) VALUES
(1, 'omar', 'test', 'lecteur'),
(4, 'adam', 'pwd', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idproduit`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `loginuniq` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `idproduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
