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

-- Dump della struttura di tabella sito.ordini
CREATE TABLE IF NOT EXISTS `ordini` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utente` int(11) NOT NULL,
  `totale` decimal(10,2) NOT NULL,
  `data` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_utente` (`id_utente`),
  CONSTRAINT `ordini_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dump dei dati della tabella sito.ordini: ~4 rows (circa)
DELETE FROM `ordini`;
INSERT INTO `ordini` (`id`, `id_utente`, `totale`, `data`) VALUES
	(1, 8, 2706.99, '2025-05-18 16:34:39'),
	(2, 8, 4051.99, '2025-05-18 16:45:09'),
	(3, 8, 4051.99, '2025-05-18 16:45:19'),
	(4, 8, 9783.98, '2025-05-18 16:48:35');

-- Dump della struttura di tabella sito.ordini_prodotti
CREATE TABLE IF NOT EXISTS `ordini_prodotti` (
  `id_ordine` int(11) NOT NULL,
  `id_prodotto` int(11) NOT NULL,
  `quantita` int(11) NOT NULL,
  KEY `id_ordine` (`id_ordine`),
  KEY `id_prodotto` (`id_prodotto`),
  CONSTRAINT `ordini_prodotti_ibfk_1` FOREIGN KEY (`id_ordine`) REFERENCES `ordini` (`id`),
  CONSTRAINT `ordini_prodotti_ibfk_2` FOREIGN KEY (`id_prodotto`) REFERENCES `computer` (`IDProdotto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dump dei dati della tabella sito.ordini_prodotti: ~16 rows (circa)
DELETE FROM `ordini_prodotti`;
INSERT INTO `ordini_prodotti` (`id_ordine`, `id_prodotto`, `quantita`) VALUES
	(1, 3, 3),
	(2, 3, 1),
	(2, 4, 1),
	(2, 8, 1),
	(2, 7, 1),
	(3, 3, 1),
	(3, 4, 1),
	(3, 8, 1),
	(3, 7, 1),
	(4, 1, 1),
	(4, 2, 1),
	(4, 3, 1),
	(4, 6, 1),
	(4, 5, 1),
	(4, 12, 1),
	(4, 32, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
