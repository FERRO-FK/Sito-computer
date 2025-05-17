-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              11.7.2-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win64
-- HeidiSQL Versione:            12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dump della struttura del database sito
CREATE DATABASE IF NOT EXISTS `sito` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;
USE `sito`;

-- Dump della struttura di tabella sito.computer
CREATE TABLE IF NOT EXISTS `computer` (
  `IDProdotto` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) DEFAULT NULL,
  `Descrizione` text DEFAULT NULL,
  `Prezzo` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`IDProdotto`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella sito.computer: ~2 rows (circa)
DELETE FROM `computer`;
INSERT INTO `computer` (`IDProdotto`, `Nome`, `Descrizione`, `Prezzo`) VALUES
	(10, 'pc gaming 5060 ti', 'pc da gaming con nvidia 5060 ti ', 1200.00),
	(11, 'PC AMD ryzen5 5600g', 'pc con cpu ryzen 5 ideale per gaming', 900.00);

-- Dump della struttura di tabella sito.indirizzo
CREATE TABLE IF NOT EXISTS `indirizzo` (
  `IDIndirizzo` int(11) NOT NULL AUTO_INCREMENT,
  `Via` varchar(255) DEFAULT NULL,
  `NumeroCivico` varchar(10) DEFAULT NULL,
  `Citta` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IDIndirizzo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella sito.indirizzo: ~2 rows (circa)
DELETE FROM `indirizzo`;
INSERT INTO `indirizzo` (`IDIndirizzo`, `Via`, `NumeroCivico`, `Citta`) VALUES
	(3, 'via ferretti ', '82', 'faenza'),
	(4, 'via ferretti ', '82', 'faenza');

-- Dump della struttura di tabella sito.interessiutente
CREATE TABLE IF NOT EXISTS `interessiutente` (
  `IdUtente` int(11) NOT NULL,
  `IdTag` int(11) NOT NULL,
  `Punteggio` int(11) DEFAULT 0,
  PRIMARY KEY (`IdUtente`,`IdTag`),
  KEY `fk_interessiutente_tag` (`IdTag`),
  CONSTRAINT `fk_interessiutente_tag` FOREIGN KEY (`IdTag`) REFERENCES `tag` (`IdTag`) ON DELETE CASCADE,
  CONSTRAINT `fk_interessiutente_utente` FOREIGN KEY (`IdUtente`) REFERENCES `utente` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella sito.interessiutente: ~0 rows (circa)
DELETE FROM `interessiutente`;

-- Dump della struttura di tabella sito.tag
CREATE TABLE IF NOT EXISTS `tag` (
  `IdTag` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdTag`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella sito.tag: ~16 rows (circa)
DELETE FROM `tag`;
INSERT INTO `tag` (`IdTag`, `Nome`) VALUES
	(1, 'Gaming'),
	(2, 'Nvidia 4000'),
	(3, 'Laptop'),
	(4, 'All-in-One'),
	(5, 'AMD Ryzen'),
	(6, 'Nvidia 3000'),
	(7, 'Nvidia 5000'),
	(8, 'AMD RX 5000'),
	(9, 'video editing'),
	(10, 'AMD RX 6000'),
	(11, 'AMD RX 7000'),
	(12, 'AMD RX 9000'),
	(13, 'Intel'),
	(14, 'pc-casa'),
	(15, 'leggero'),
	(16, 'professionale');

-- Dump della struttura di tabella sito.tagcomputer
CREATE TABLE IF NOT EXISTS `tagcomputer` (
  `IDProdotto` int(11) NOT NULL,
  `IdTag` int(11) NOT NULL,
  PRIMARY KEY (`IDProdotto`,`IdTag`),
  KEY `fk_tagcomputer_tag` (`IdTag`),
  CONSTRAINT `fk_tagcomputer_computer` FOREIGN KEY (`IDProdotto`) REFERENCES `computer` (`IDProdotto`) ON DELETE CASCADE,
  CONSTRAINT `fk_tagcomputer_tag` FOREIGN KEY (`IdTag`) REFERENCES `tag` (`IdTag`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella sito.tagcomputer: ~2 rows (circa)
DELETE FROM `tagcomputer`;
INSERT INTO `tagcomputer` (`IDProdotto`, `IdTag`) VALUES
	(10, 1),
	(11, 1);

-- Dump della struttura di tabella sito.utente
CREATE TABLE IF NOT EXISTS `utente` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `IDIndirizzo` int(11) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `banned` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `IDIndirizzo` (`IDIndirizzo`),
  CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`IDIndirizzo`) REFERENCES `indirizzo` (`IDIndirizzo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella sito.utente: ~1 rows (circa)
DELETE FROM `utente`;
INSERT INTO `utente` (`ID`, `Nome`, `mail`, `IDIndirizzo`, `pass`, `banned`) VALUES
	(1, 'admin', 'tanso2006@gmail.com', 3, '$2y$10$DFX1vcevGi8sYFTdcYwi4eQ8gFMT.2QCnCbRCLtzLghUl8TyoXLim', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
