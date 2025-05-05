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

-- Dump dei dati della tabella sito.computer: ~2 rows (circa)
INSERT INTO `computer` (`IDProdotto`, `Nome`, `Descrizione`, `Prezzo`) VALUES
	(1, 'PC Gaming', 'Scopri il massimo delle prestazioni con il nostro PC Gaming equipaggiato con la nuova tecnologia Nvidia Ada Lovelace. ', 929.00),
	(2, 'PC Gaming 5080', 'Scatena la potenza del gaming di nuova generazione con la nuova RTX 5080.\r\n', 2499.00);

-- Dump dei dati della tabella sito.indirizzo: ~0 rows (circa)
INSERT INTO `indirizzo` (`IDIndirizzo`, `Via`, `NumeroCivico`, `Citta`) VALUES
	(1, 'Alphonse Elric', '33', 'Milano');

-- Dump dei dati della tabella sito.interessiutente: ~3 rows (circa)
INSERT INTO `interessiutente` (`IdUtente`, `IdTag`, `Punteggio`) VALUES
	(1, 2, 1),
	(1, 3, 1),
	(1, 4, 0);

-- Dump dei dati della tabella sito.ordine: ~0 rows (circa)

-- Dump dei dati della tabella sito.recensione: ~0 rows (circa)

-- Dump dei dati della tabella sito.tag: ~16 rows (circa)
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

-- Dump dei dati della tabella sito.tagcomputer: ~6 rows (circa)
INSERT INTO `tagcomputer` (`IDProdotto`, `IdTag`) VALUES
	(1, 1),
	(2, 1),
	(1, 2),
	(2, 3),
	(2, 7),
	(1, 4);

-- Dump dei dati della tabella sito.utente: ~1 rows (circa)
INSERT INTO `utente` (`ID`, `Nome`, `mail`, `IDIndirizzo`, `pass`, `banned`) VALUES
	(1, 'Mario', 'mario.rossi@gmail.com', 1, $12$yGAx.zenZOerT8By5GH.R.Pwy8zh8Li8TAJln3pe31h8VBnQ3V.4y, 0); --campo password="ciao"

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
