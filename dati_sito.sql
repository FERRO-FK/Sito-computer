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
CREATE DATABASE IF NOT EXISTS `sito` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `sito`;

-- Dump dei dati della tabella sito.computer: ~8 rows (circa)
INSERT INTO `computer` (`IDProdotto`, `Nome`, `Descrizione`, `Prezzo`) VALUES
	(1, 'PC Gaming 4060', 'Scopri il massimo delle prestazioni con il nostro PC Gaming equipaggiato con la nuova tecnologia Nvidia Ada Lovelace. \r\nGrazie al potente processore Intel Core i5-12400F, ai 16GB di RAM DDR4 ad alta velocità e all\'SSD M.2 da 1TB, \r\nquesto sistema è progettato per garantire tempi di caricamento ridottissimi e sessioni di gioco fluide. \r\nLa scheda grafica Nvidia RTX 4060 da 8GB ti offrirà un\'esperienza visiva senza precedenti, perfetta per il gaming a dettagli ultra e il ray tracing.\r\n\r\nCaratteristiche principali:\r\n- Processore: Intel Core i5-12400F (6 Core, 2.5GHz)\r\n- Memoria RAM: 16GB DDR4 3200MHz\r\n- Storage: SSD M.2 da 1TB\r\n- Scheda Grafica: Nvidia RTX 4060 8GB Ada Lovelace\r\n- Case: PCS Spectrum II con 3 ventole RGB\r\n\r\n🔥💻 Con Tecno shop sei pronto a dominare ogni partita con stile, velocità e potenza! 💻🔥', 929.00),
	(2, 'PC Gaming 5080', 'Scatena la potenza del gaming di nuova generazione con la nuova RTX 5080.\r\nEquipaggiato con un Intel Core i9 di ultima generazione, 32GB di RAM DDR5 e una scheda grafica NVIDIA RTX 5080 da 16GB, questo PC è pronto per qualsiasi sfida: dal gaming competitivo all’editing video 4K.\r\n\r\nCaratteristiche principali:\r\nCPU: Intel Core i9-12900KF, fino a 5.2GHz\r\n\r\nRAM: 32GB DDR5 5200MHz\r\n\r\nStorage: SSD M.2 NVMe da 1TB\r\n\r\nScheda Grafica: NVIDIA RTX 5080 16GB GDDR7\r\n\r\nRaffreddamento: Sistema a liquido RGB con 5 ventole\r\n\r\n🔥🎯 Massime prestazioni, grafica eccezionale, zero compromessi — solo su Tecno shop. 🎯🔥', 2499.00),
	(3, 'PC Gaming 3060', 'Preparati a vivere un\'esperienza di gioco senza compromessi con il nostro PC Gaming ad alte prestazioni. \r\nEquipaggiato con un potente processore AMD Ryzen 7, 16GB di RAM veloce e un veloce SSD da 512GB, \r\nquesto computer è progettato per offrirti caricamenti rapidi e multitasking fluido. \r\nLa scheda grafica NVIDIA RTX 3060 ti garantisce immagini realistiche, ray tracing avanzato e prestazioni ottimali \r\nper affrontare i giochi più recenti a dettagli ultra.\r\n\r\nCaratteristiche principali:\r\n- Processore: AMD Ryzen 7\r\n- Memoria RAM: 16GB DDR4\r\n- Storage: SSD da 512GB\r\n- Scheda Grafica: NVIDIA RTX 3060 12GB\r\n- Ideale per: Gaming AAA, streaming, editing video\r\n\r\n🎮 Non lasciare che la tecnologia ti rallenti: porta il tuo gameplay al livello successivo con Tecno shop! 🚀', 899.00),
	(4, 'PC Gaming rx 6500 xt', 'Preparati a dominare ogni sfida con il nostro PC Gaming di nuova generazione.\r\nProgettato per prestazioni estreme, questo sistema è alimentato da un potente AMD Ryzen 5 7600X, supportato da 32GB di RAM Corsair VENGEANCE a 5600 MHz per un multitasking reattivo e senza interruzioni.\r\nL’SSD M.2 Samsung 990 EVO PLUS da 2TB assicura avvii fulminei e ampio spazio per giochi e contenuti.\r\nLa scheda madre ASUS® TUF GAMING B850-PLUS WIFI offre stabilità e connettività avanzata, mentre la scheda grafica AMD RADEON™ RX 6500 XT da 4GB garantisce performance solide nei giochi più popolari.\r\nTutto questo con Windows 11 Home, per un’esperienza moderna e fluida fin dal primo avvio.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 5 7600X\r\n\r\nRAM: 32GB Corsair VENGEANCE 5600 MHz\r\n\r\nScheda Grafica: AMD RADEON™ RX 6500 XT 4GB\r\n\r\nStorage: SSD M.2 Samsung 990 EVO PLUS da 2TB\r\n\r\nSistema operativo: Windows 11 Home\r\n\r\n🎮⚡ Spingi al massimo le tue performance: scopri la potenza del vero gaming con Tecno shop! ⚡🎮', 1145.00),
	(5, 'PC Gaming rx 7600', 'Preparati a dominare ogni sfida con un PC pensato per i veri gamer.\r\nCon il potente Ryzen 5 di ultima generazione e la scheda grafica Radeon RX 7600 da 8GB, questo sistema è perfetto per affrontare i titoli più moderni in full HD e oltre.\r\nLa RAM DDR5 ad alta frequenza e l’SSD Samsung ultraveloce assicurano caricamenti istantanei e multitasking fluido, mentre il case ARGB aggiunge un tocco di stile a ogni setup.\r\nPerfetto per chi vuole performance e affidabilità senza compromessi.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 5 7500F (6 Core, fino a 5.0 GHz)\r\n\r\nRAM: 16GB DDR5 Corsair VENGEANCE 5200 MHz\r\n\r\nScheda grafica: GIGABYTE Radeon RX 7600 8GB\r\n\r\nStorage: SSD Samsung 990 EVO PLUS M.2 1TB NVMe\r\n\r\nCase: PCS PRISM II ARGB con raffreddamento ad alte prestazioni\r\n\r\nScritta finale:\r\n\r\n🔥 Il gaming ad alte prestazioni inizia qui: accendi la potenza con Tecno shop! 🔥', 950.00),
	(6, 'PC Gaming rx 9070 xt', 'Spingi il tuo gaming oltre ogni limite con il massimo della tecnologia.', 2599.00),
	(7, 'PC Gaming rx 7600 xt', 'Preparati a un gaming fluido e reattivo con il nostro PC equipaggiato con il Ryzen 5 7600 e la potente Radeon RX 7600 XT da 16GB.', 1299.00),
	(8, 'PC Gaming rx 5700 xt', 'Preparati a vivere un\'esperienza di gioco senza compromessi con il nostro PC Gaming RX 5700 XT.\r\nEquipaggiato con un potente processore AMD Ryzen 5 7500F, 8GB di RAM DDR5, e un SSD da 512GB NVMe PCIe, questo PC è progettato per offrirti prestazioni incredibili e velocità eccezionale.\r\nLa scheda grafica GIGABYTE RADEON™ RX 5700 XT ti garantisce immagini realistiche e prestazioni ottimali per affrontare i giochi più recenti a dettagli ultra.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 5 7500F\r\n\r\nMemoria RAM: 8GB DDR5\r\n\r\nStorage: SSD M.2 512GB\r\n\r\nScheda Grafica: GIGABYTE RADEON™ RX 5700 XT\r\n\r\nAlimentatore: CORSAIR 650W CX SERIES™ CX-650\r\n\r\nRaffreddamento: Dissipatore PCS FrostFlow 100 V3 Series\r\n\r\nScheda Audio: Audio alta definizione integrato 6 canali\r\n\r\nScheda di rete: Porta LAN 2.5Gbe\r\n\r\n🚀 Non lasciare che la tecnologia ti rallenti: porta il tuo gameplay al livello successivo con Tecno shop! 🎮', 699.00);

-- Dump dei dati della tabella sito.indirizzo: ~2 rows (circa)
INSERT INTO `indirizzo` (`IDIndirizzo`, `Via`, `NumeroCivico`, `Citta`) VALUES
	(1, 'Alphonse Elric', '33', 'Milano'),
	(2, 'Nintendo', '120', 'Tokyo');

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
	(1, 4),
	(2, 7);

-- Dump dei dati della tabella sito.utente: ~2 rows (circa)
INSERT INTO `utente` (`ID`, `Nome`, `Cognome`, `mail`, `IDIndirizzo`, `pass`, `banned`) VALUES
	(1, 'Mario', 'Rossi', 'mario.rossi@gmail.com', 1, NULL, 0),
	(2, 'Mario mario', NULL, 'mario.mario@qualcosa.com', 2, '$2y$12$PMxV99WA55YnFKLRB2LJBOvWOZ3mvyozXculxsiJtKF19Lc44877y', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
