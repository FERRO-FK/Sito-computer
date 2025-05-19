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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella sito.computer: ~29 rows (circa)
DELETE FROM `computer`;
INSERT INTO `computer` (`IDProdotto`, `Nome`, `Descrizione`, `Prezzo`) VALUES
	(1, 'PC Gaming', 'PC Gaming RTX 4060 - 929€\r\n\r\nScopri il massimo delle prestazioni con il nostro PC Gaming equipaggiato con la nuova tecnologia Nvidia Ada Lovelace. \r\nGrazie al potente processore Intel Core i5-12400F, ai 16GB di RAM DDR4 ad alta velocità e all\'SSD M.2 da 1TB, \r\nquesto sistema è progettato per garantire tempi di caricamento ridottissimi e sessioni di gioco fluide. \r\nLa scheda grafica Nvidia RTX 4060 da 8GB ti offrirà un\'esperienza visiva senza precedenti, perfetta per il gaming a dettagli ultra e il ray tracing.\r\n\r\nCaratteristiche principali:\r\n- Processore: Intel Core i5-12400F (6 Core, 2.5GHz)\r\n- Memoria RAM: 16GB DDR4 3200MHz\r\n- Storage: SSD M.2 da 1TB\r\n- Scheda Grafica: Nvidia RTX 4060 8GB Ada Lovelace\r\n- Case: PCS Spectrum II con 3 ventole RGB\r\n\r\n🔥💻 Con Tecno shop sei pronto a dominare ogni partita con stile, velocità e potenza! 💻🔥', 929.00),
	(2, 'PC Gaming 5080', 'PC Gaming 5080 - 2.499€\r\n\r\nScatena la potenza del gaming di nuova generazione con la nuova RTX 5080.\r\nEquipaggiato con un Intel Core i9 di ultima generazione, 32GB di RAM DDR5 e una scheda grafica NVIDIA RTX 5080 da 16GB, questo PC è pronto per qualsiasi sfida: dal gaming competitivo all’editing video 4K.\r\n\r\nCaratteristiche principali:\r\nCPU: Intel Core i9-12900KF, fino a 5.2GHz\r\n\r\nRAM: 32GB DDR5 5200MHz\r\n\r\nStorage: SSD M.2 NVMe da 1TB\r\n\r\nScheda Grafica: NVIDIA RTX 5080 16GB GDDR7\r\n\r\nRaffreddamento: Sistema a liquido RGB con 5 ventole\r\n\r\n🔥🎯 Massime prestazioni, grafica eccezionale, zero compromessi — solo su Tecno shop. 🎯🔥', 2499.00),
	(3, 'PC Gaming 3060', 'Preparati a vivere un\'esperienza di gioco senza compromessi con il nostro PC Gaming ad alte prestazioni. \r\nEquipaggiato con un potente processore AMD Ryzen 7, 16GB di RAM veloce e un veloce SSD da 512GB, \r\nquesto computer è progettato per offrirti caricamenti rapidi e multitasking fluido. \r\nLa scheda grafica NVIDIA RTX 3060 ti garantisce immagini realistiche, ray tracing avanzato e prestazioni ottimali \r\nper affrontare i giochi più recenti a dettagli ultra.\r\n\r\nCaratteristiche principali:\r\n- Processore: AMD Ryzen 7\r\n- Memoria RAM: 16GB DDR4\r\n- Storage: SSD da 512GB\r\n- Scheda Grafica: NVIDIA RTX 3060 12GB\r\n- Ideale per: Gaming AAA, streaming, editing video\r\n\r\n🎮 Non lasciare che la tecnologia ti rallenti: porta il tuo gameplay al livello successivo con Tecno shop! 🚀', 899.00),
	(4, 'PC Gaming rx 6500 xt', 'Preparati a dominare ogni sfida con il nostro PC Gaming di nuova generazione.\r\nProgettato per prestazioni estreme, questo sistema è alimentato da un potente AMD Ryzen 5 7600X, supportato da 32GB di RAM Corsair VENGEANCE a 5600 MHz per un multitasking reattivo e senza interruzioni.\r\nL’SSD M.2 Samsung 990 EVO PLUS da 2TB assicura avvii fulminei e ampio spazio per giochi e contenuti.\r\nLa scheda madre ASUS® TUF GAMING B850-PLUS WIFI offre stabilità e connettività avanzata, mentre la scheda grafica AMD RADEON™ RX 6500 XT da 4GB garantisce performance solide nei giochi più popolari.\r\nTutto questo con Windows 11 Home, per un’esperienza moderna e fluida fin dal primo avvio.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 5 7600X\r\n\r\nRAM: 32GB Corsair VENGEANCE 5600 MHz\r\n\r\nScheda Grafica: AMD RADEON™ RX 6500 XT 4GB\r\n\r\nStorage: SSD M.2 Samsung 990 EVO PLUS da 2TB\r\n\r\nSistema operativo: Windows 11 Home\r\n\r\n🎮⚡ Spingi al massimo le tue performance: scopri la potenza del vero gaming con Tecno shop! ⚡🎮', 1145.00),
	(5, 'PC Gaming rx 7600', 'Preparati a dominare ogni sfida con un PC pensato per i veri gamer.\r\nCon il potente Ryzen 5 di ultima generazione e la scheda grafica Radeon RX 7600 da 8GB, questo sistema è perfetto per affrontare i titoli più moderni in full HD e oltre.\r\nLa RAM DDR5 ad alta frequenza e l’SSD Samsung ultraveloce assicurano caricamenti istantanei e multitasking fluido, mentre il case ARGB aggiunge un tocco di stile a ogni setup.\r\nPerfetto per chi vuole performance e affidabilità senza compromessi.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 5 7500F (6 Core, fino a 5.0 GHz)\r\n\r\nRAM: 16GB DDR5 Corsair VENGEANCE 5200 MHz\r\n\r\nScheda grafica: GIGABYTE Radeon RX 7600 8GB\r\n\r\nStorage: SSD Samsung 990 EVO PLUS M.2 1TB NVMe\r\n\r\nCase: PCS PRISM II ARGB con raffreddamento ad alte prestazioni\r\n\r\nScritta finale:\r\n\r\n🔥 Il gaming ad alte prestazioni inizia qui: accendi la potenza con Tecno shop! 🔥', 950.00),
	(6, 'PC Gaming rx 9070 xt', 'Spingi il tuo gaming oltre ogni limite con il massimo della tecnologia.\r\nQuesto PC da battaglia è spinto dal nuovo AMD Ryzen 7 9800X3D, supportato da una scheda grafica Radeon RX 9070 XT da 16GB e ben 32GB di RAM DDR5 ultraveloce.\r\nL’SSD Samsung 990 PRO da 4TB offre velocità estreme e spazio abbondante per giochi e contenuti.\r\nIl case Fractal Design Torrent RGB completa il tutto con stile, raffreddamento ottimale e illuminazione spettacolare.\r\nIdeale per gaming 4K, streaming avanzato e creazione di contenuti professionale.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 7 9800X3D (8 Core, fino a 5.2 GHz, 104 MB cache)\r\n\r\nScheda grafica: Radeon RX 9070 XT 16GB\r\n\r\nRAM: 32GB DDR5 Corsair VENGEANCE RGB 6000 MHz\r\n\r\nStorage: SSD Samsung 990 PRO M.2 4TB NVMe\r\n\r\nCase: Fractal Design Torrent RGB con raffreddamento ad alte prestazioni\r\n\r\nScritta finale:\r\n\r\n🚀 La potenza senza compromessi esiste: scoprila oggi su Tecno shop! 💥', 2599.00),
	(7, 'PC Gaming rx 7600 xt', 'Preparati a un gaming fluido e reattivo con il nostro PC equipaggiato con il Ryzen 5 7600 e la potente Radeon RX 7600 XT da 16GB.\r\nGrazie ai 16GB di RAM DDR5 ultraveloce e all’SSD Samsung 990 PRO da 1TB, potrai contare su caricamenti lampo e multitasking impeccabile.\r\nLa scheda madre ASUS TUF X870-PLUS con Wi-Fi 7 assicura connettività di ultima generazione e massima stabilità.\r\nIl case Corsair 3500X ARGB in vetro temperato unisce estetica aggressiva e flusso d’aria ottimale.\r\nPerfetto per affrontare giochi AAA, streaming e lavoro creativo.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 5 7600 (6 Core, fino a 5.2 GHz, 38 MB cache)\r\n\r\nScheda grafica: Radeon RX 7600 XT 16GB\r\n\r\nRAM: 16GB DDR5 Corsair VENGEANCE RGB 6000 MHz\r\n\r\nStorage: SSD Samsung 990 PRO M.2 1TB NVMe\r\n\r\nCase: Corsair 3500X ARGB in vetro temperato\r\n\r\nScritta finale:\r\n\r\n🔥 Dai energia alle tue sessioni di gioco: performance e stile firmati Tecno shop! ⚡', 1299.00),
	(8, 'PC Gaming rx 5700 xt', 'Preparati a vivere un\'esperienza di gioco senza compromessi con il nostro PC Gaming RX 5700 XT.\r\nEquipaggiato con un potente processore AMD Ryzen 5 7500F, 8GB di RAM DDR5, e un SSD da 512GB NVMe PCIe, questo PC è progettato per offrirti prestazioni incredibili e velocità eccezionale.\r\nLa scheda grafica GIGABYTE RADEON™ RX 5700 XT ti garantisce immagini realistiche e prestazioni ottimali per affrontare i giochi più recenti a dettagli ultra.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 5 7500F\r\n\r\nMemoria RAM: 8GB DDR5\r\n\r\nStorage: SSD M.2 512GB\r\n\r\nScheda Grafica: GIGABYTE RADEON™ RX 5700 XT\r\n\r\nAlimentatore: CORSAIR 650W CX SERIES™ CX-650\r\n\r\nRaffreddamento: Dissipatore PCS FrostFlow 100 V3 Series\r\n\r\nScheda Audio: Audio alta definizione integrato 6 canali\r\n\r\nScheda di rete: Porta LAN 2.5Gbe\r\n\r\n🚀 Non lasciare che la tecnologia ti rallenti: porta il tuo gameplay al livello successivo con Tecno shop! 🎮', 699.00),
	(12, 'PC Gaming 3050', 'Preparati a vivere un\'esperienza di gioco senza compromessi con il nostro PC Gaming con GeForce RTX 3050.\r\nEquipaggiato con un potente processore AMD Ryzen 5 9600, 16GB di RAM DDR5, e un SSD da 1TB NVMe PCIe, questo PC è progettato per offrirti prestazioni straordinarie e velocità senza pari.\r\nLa scheda grafica PALIT GEFORCE RTX 3050 da 8GB ti garantirà immagini cristalline e un\'esperienza di gioco ultra fluida.\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 5 9600\r\n\r\nMemoria RAM: 16GB DDR5 Corsair VENGEANCE\r\n\r\nStorage: SSD M.2 1TB\r\n\r\nScheda Grafica: PALIT GEFORCE RTX 3050 8GB\r\n\r\nAlimentatore: CORSAIR 550W CX SERIES™ CX-550\r\n\r\n🚀 Non lasciare che la tecnologia ti rallenti: porta il tuo gameplay al livello successivo con Tecno shop! 🎮', 798.99),
	(13, 'PC Gaming 5060 ti', 'Preparati a vivere un\'esperienza di gioco senza compromessi con il nostro PC Gaming con GeForce RTX 5060 Ti.\r\nEquipaggiato con un potente processore AMD Ryzen 7 7800X3D, 16GB di RAM DDR5, e un SSD da 1TB NVMe PCIe, questo PC è progettato per offrirti prestazioni straordinarie e velocità senza pari.\r\nLa scheda grafica MSI GeForce RTX 5060 Ti da 8GB ti garantirà immagini realistiche e prestazioni ottimali per affrontare i giochi più recenti a dettagli ultra.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 7 7800X3D (8 Core, 4,2 GHz - 5,0 GHz, 104 MB Cache, AM5)\r\n\r\nMemoria RAM: 16GB DDR5 Corsair Vengeance RGB 5200 MHz (1 x 16GB)\r\n\r\nStorage: SSD M.2 Samsung 990 EVO Plus 1TB NVMe PCIe 4.0 & 5.0 (fino a 7150 MB/s R, 6300 MB/s W)\r\n\r\nScheda Grafica: MSI GeForce RTX 5060 Ti 8GB VENTUS 2X OC PLUS (HDMI, 3 x DP)\r\n\r\nAlimentatore: CORSAIR 750W CX SERIES™ CX-750\r\n\r\n🚀 Non lasciare che la tecnologia ti rallenti: porta il tuo gameplay al livello successivo con Tecno shop! 🎮', 1599.00),
	(14, 'laptop HP', 'Notebook HP 17" - 549€\r\n\r\nSperimenta la perfetta combinazione tra potenza e portabilità con il nuovo Notebook HP da 17,3 pollici. \r\nProgettato per chi desidera alte prestazioni anche in mobilità, integra un processore Intel Core i5 di 12ª generazione, \r\n8GB di RAM veloce e un capiente SSD da 512GB per avvii rapidi e gestione fluida delle attività quotidiane. \r\nIl display Full HD IPS da 17,3" assicura immagini nitide e colori brillanti, ideale per lavoro creativo, studio o intrattenimento.\r\n\r\nCaratteristiche principali:\r\n- Processore: Intel Core i5-1235U\r\n- Memoria RAM: 8GB DDR4 3200MHz\r\n- Storage: SSD PCIe NVMe da 512GB\r\n- Display: 17,3" Full HD IPS Antiriflesso\r\n- Sistema Operativo: Windows 11 Home\r\n\r\n💼 Affidati a Tecno shop per portare il tuo lavoro e la tua creatività ovunque senza compromessi! ✨', 549.00),
	(15, 'laptop HP i3-1315u', 'Affidati a prestazioni affidabili e portabilità con il notebook HP 15.6" con Intel Core i3 di 13ª generazione.\r\nQuesto laptop è ideale per uso quotidiano, ufficio, studio e intrattenimento leggero. Con un design elegante e compatto, offre fluidità grazie ai 16GB di RAM DDR4 e all\'SSD M.2 da 500GB.\r\nLo schermo FHD antiriflesso da 15,6", la tastiera italiana con tastierino numerico, la connettività Wi-Fi/Bluetooth e la batteria a lunga durata completano un pacchetto solido e pronto all’uso.\r\nWindows 11 Professional e LibreOffice sono già installati, con aggiornamenti e driver pronti grazie alla configurazione iniziale dei tecnici HP.\r\nPerfetto per lavorare ovunque, senza complicazioni.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: Intel Core i3-1315U (6 Core, fino a 4.5 GHz in Turbo Boost)\r\n\r\nMemoria RAM: 16GB DDR4\r\n\r\nStorage: SSD M.2 PCIe NVMe da 500GB\r\n\r\nDisplay: Schermo 15,6" FHD antiriflesso (Anti-Glare)\r\n\r\nSistema Operativo: Windows 11 Professional preinstallato, LibreOffice incluso\r\n\r\n💼 Affidati a Tecno shop per portare il tuo lavoro e la tua creatività ovunque senza compromessi! ✨', 359.00),
	(18, 'laptop HP Intel i7 13Th Gen', 'Prestazioni avanzate e design leggero con l\'HP 250 G10, il notebook ideale per il business e la produttività in mobilità.\r\nDotato del potente processore Intel Core i7-1355U di 13ª generazione (fino a 5 GHz), questo portatile garantisce reattività e multitasking fluido. Il display Full HD da 15.6" antiriflesso assicura una visione confortevole in qualsiasi ambiente.\r\nCon 32GB di RAM DDR4 e un veloce SSD M.2 PCIe NVMe da 1TB, hai spazio e potenza per affrontare qualsiasi progetto.\r\nLa connettività Wi-Fi 6, il Bluetooth 5.3 e una varietà di porte ti permettono di rimanere sempre collegato. Il tutto completato da Windows 11 Pro e software essenziali già installati per essere operativo fin da subito.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: Intel Core i7-1355U (fino a 5.0 GHz, base 1.7 GHz)\r\n\r\nMemoria RAM: 32GB DDR4\r\n\r\nStorage: SSD PCIe NVMe M.2 da 1TB\r\n\r\nDisplay: Schermo 15.6" FHD antiriflesso (1920x1080, 250 nits)\r\n\r\nSistema Operativo: Windows 11 Pro 64 bit, con LibreOffice, VLC, Chrome e Adobe Reader preinstallati\r\n\r\n💼 Affidati a Tecno shop per portare il tuo lavoro e la tua creatività ovunque senza compromessi! 🚀', 819.00),
	(19, 'laptop HP Intel N4500', 'HP 250 G9: il notebook essenziale per lo studio, il lavoro e l’intrattenimento quotidiano.\r\nCompatto e funzionale, questo laptop da 15,6" è dotato di un processore Intel Celeron Dual-Core, 8GB di RAM DDR4 e un veloce SSD da 256GB, garantendo reattività nelle operazioni di base.\r\nLa grafica integrata Intel UHD, la connettività Wi-Fi e le porte USB 3.0 e HDMI lo rendono un’ottima scelta per navigazione, gestione documenti e videolezioni.\r\nIl tutto con Windows preinstallato, in un design elegante e leggero da portare ovunque.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: Intel Celeron Dual-Core (1,1 GHz)\r\n\r\nMemoria RAM: 8GB DDR4 (espandibile fino a 16GB)\r\n\r\nStorage: SSD da 256GB\r\n\r\nDisplay: Schermo HD da 15,6" (1366x768 pixel)\r\n\r\nSistema Operativo: Windows preinstallato\r\n\r\n💻 Perfetto per lo studio e le attività quotidiane. Scegli la semplicità e l’affidabilità di Tecno shop! 📦', 269.00),
	(20, 'laptop HP Intel i5-1334u', 'HP ProBook 450 G10: produttività, sicurezza e prestazioni per il tuo lavoro quotidiano.\r\nDotato di un processore Intel Core i5 di 13ª generazione con 10 core e tecnologia Turbo Boost fino a 4.6 GHz, questo notebook combina potenza e affidabilità in un corpo compatto e resistente.\r\nCon 16GB di RAM DDR4 espandibili fino a 64GB, un veloce SSD NVMe da 512GB e grafica Intel Iris Xe, offre multitasking fluido, avvio rapido e prestazioni grafiche ottimizzate.\r\nPensato per l’ambiente professionale, include lettore di impronte digitali, tastiera resistente a liquidi, Wi-Fi 6E, doppia USB-C con DisplayPort e una dotazione completa di software già installato.\r\nIl tutto in un design elegante e robusto, pronto all’uso fin dal primo avvio.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: Intel Core i5-1334U (10 core, fino a 4.6 GHz)\r\n\r\nMemoria RAM: 16GB DDR4 (espandibile fino a 64GB)\r\n\r\nStorage: SSD NVMe da 512GB\r\n\r\nDisplay: Schermo IPS Full HD da 15,6"\r\n\r\nConnettività: Wi-Fi 6E, Bluetooth 5.3, doppia USB-C con DisplayPort 2.1\r\n\r\n💼 Il tuo compagno ideale per la produttività moderna. Con HP ProBook e Tecno shop, sei sempre un passo avanti! 🚀', 689.00),
	(21, 'laptop HP AMD Ryzen-5 7520u', 'HP Notebook 17,3” con AMD Ryzen 5 – Performance e Comfort per ogni attività.\r\nScopri la potenza e la praticità di un notebook pensato per semplificarti la vita quotidiana. Con Windows 11, potrai affrontare ogni attività in modo facile, veloce e senza interruzioni. Equipaggiato con un AMD Ryzen 5 7520U e 8 GB di RAM LPDDR5, questo laptop è perfetto per studenti, professionisti e per chi cerca una macchina fluida per multitasking e streaming.\r\nIl display da 17,3” Full HD IPS offre immagini cristalline e colori vividi, con una luminosità di 300 Nits che garantisce una visione chiara anche in ambienti luminosi.\r\nCon un SSD NVMe da 512 GB, l\'avvio del sistema e dei programmi è rapidissimo. E grazie alla tastiera full size con tastierino numerico e un design robusto e sostenibile, ogni battitura sarà confortevole.\r\nLa batteria a lunga durata con HP Fast Charge ti offre autonomia in movimento, mentre il design elegante e funzionale in Natural Silver si adatta a qualsiasi ambiente.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 5 7520U (potenza per multitasking e streaming)\r\n\r\nMemoria: 8 GB di RAM LPDDR5 a 5500 MHz\r\n\r\nStorage: SSD NVMe da 512 GB (per avvio e prestazioni rapide)\r\n\r\nDisplay: Schermo da 17,3" Full HD con tecnologia IPS (300 Nits, pannello antiriflesso)\r\n\r\nConnettività: HDMI 1.4b, 2 USB-A, 1 USB-C, jack audio (ideale per tutti i dispositivi)\r\n\r\n🚀 Affronta ogni sfida con un design elegante e prestazioni impeccabili. Con HP, il lavoro diventa più facile!💻', 429.00),
	(22, 'laptop HP AMD Ryzen-7 5700u', 'Il laptop HP con processore AMD Ryzen 7 5700U è ideale per chi cerca prestazioni elevate e multitasking senza compromessi. Con 16GB di RAM e un SSD da 512GB, offre velocità e spazio per ogni esigenza, mentre il display Full HD da 15,6" garantisce un\'esperienza visiva ottimale.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 7 5700U, fino a 4,3 GHz\r\n\r\nMemoria: 16GB DDR4 RAM, 3200MHz (non espandibile)\r\n\r\nStorage: SSD PCIe NVMe M.2 da 512GB\r\n\r\nDisplay: 15,6" Full HD, 250 Nits, Antiriflesso\r\n\r\nAutonomia: Fino a 9 ore e 30 minuti, ricarica rapida al 50% in 45 minuti\r\n\r\n🎮💼 Perfetto per lavoro e svago, sempre pronto a supportarti!', 549.00),
	(23, 'laptop HP AMD Ryzen-7 7730u', 'Il notebook HP IdeaPad Slim 3 è leggero (1,62 kg) e sottile (17,9 mm), perfetto per chi cerca portabilità senza sacrificare prestazioni. Il display Full HD da 15" e Dolby Audio offrono un\'esperienza multimediale straordinaria, mentre la batteria con tecnologia RapidCharge permette 2 ore di utilizzo con soli 15 minuti di ricarica.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 7\r\n\r\nMemoria: 16GB RAM, 3200MHz\r\n\r\nStorage: 1TB HDD\r\n\r\nDisplay: 15" Full HD con Dolby Audio\r\n\r\nAutonomia: 2 ore con 15 minuti di ricarica, batteria potenziata\r\n\r\n🔒💻 Con lettore di impronte e webcam con otturatore per la privacy, ideale per lavoro e intrattenimento!', 699.00),
	(24, 'laptop HP AMD Ryzen-7 7840u', 'Il notebook HP con Windows 11 Home è progettato per ottimizzare attività creative, come l\'editing video e la grafica. Grazie al potente processore AMD Ryzen 7-7840U, il display OLED 2,8K da 14" e una memoria LPDDR5x, è perfetto per un\'esperienza di lavoro fluida e di alta qualità. Inoltre, la batteria ad alta autonomia e la ricarica rapida sono ideali per lavorare in mobilità.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 7-7840U fino a 5,1 GHz, 8 core, 16 thread\r\n\r\nMemoria: 16GB LPDDR5x, 6400 MHz\r\n\r\nStorage: SSD PCIe NVMe M.2 da 1TB\r\n\r\nDisplay: 14" OLED 2,8K, 2880x1800p, 100% DCI-P3\r\n\r\nAutonomia: Fino a 12 ore e 30 min, ricarica rapida in 30 min per il 50%\r\n\r\n📸💻 Con fotocamera IR 5 MP, microfoni digitali e un design elegante in metallo, ideale per un utilizzo intensivo!', 1049.00),
	(25, 'laptop HP AMD Ryzen-5 7430u', 'Il notebook HP da 17,3" offre una potente combinazione di prestazioni e comfort, con una cerniera ergonomica e un design a cornice stretta per una visione ottimale. Equipaggiato con un processore AMD Ryzen 5 7430U, 32 GB di RAM e un ampio SSD da 1 TB, è perfetto per il multitasking e per gestire attività intense come streaming, videoconferenze e giochi casuali.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 5 7430U fino a 4,3 GHz, 6 core, 12 thread\r\n\r\nMemoria: 32GB DDR4 RAM\r\n\r\nStorage: SSD PCIe NVMe M.2 da 1TB\r\n\r\nDisplay: 17,3" FHD (1920x1080), IPS, antiriflesso\r\n\r\nAutonomia: Fino a 8 ore di batteria\r\n\r\n💻🎧 Connettività avanzata, porte USB-C e HDMI, e una webcam con otturatore privacy per sicurezza e praticità!', 1359.00),
	(26, 'PC Fisso Intel I5-14400', 'PC Fisso Intel I5-14400  - 599€\r\n\r\nOttimizza la tua produttività con il PC Office di Romagna Computer, pensato per offrire velocità, affidabilità e prestazioni quotidiane senza compromessi. \r\nCon il suo potente processore Intel Core i5 di ultima generazione e ben 32GB di RAM DDR4, questo computer garantisce un multitasking fluido, \r\ncaricamenti rapidi e un\'eccellente gestione delle applicazioni d\'ufficio. \r\nL\'SSD M.2 da 1TB assicura spazio e velocità di archiviazione, mentre Windows 11 Pro fornisce un ambiente di lavoro moderno e sicuro.\r\n\r\nCaratteristiche principali:\r\n- Processore: Intel Core i5-14400\r\n- Memoria RAM: 32GB DDR4\r\n- Storage: SSD M.2 NVMe da 1TB\r\n- Scheda Grafica: Intel UHD 730 integrata\r\n- Sistema Operativo: Windows 11 Pro\r\n\r\n💻 Affidati a Tecno shop per migliorare le tue giornate di lavoro con performance superiori e tecnologia affidabile! 🚀🔧\r\n', 599.00),
	(27, 'PC Fisso Intel i5-8500', 'Potente e pronto all\'uso, questo PC è equipaggiato con un processore Intel i5-8500 a 6 core, 16GB di RAM e SSD NVMe da 512GB, offrendo prestazioni veloci per multitasking e applicazioni professionali.\r\nIl display Full HD da 23,8" e il sistema audio Dolby garantiscono un\'esperienza visiva e sonora di qualità, ideale per lavoro e intrattenimento.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: Intel i5-8500 a 6 core\r\n\r\nMemoria: 16GB RAM\r\n\r\nStorage: SSD M.2 NVMe da 512GB\r\n\r\nDisplay: 23,8" Full HD\r\n\r\nAutonomia e Connettività: WiFi, Bluetooth, lettore DVD\r\n\r\n💻📈 Preinstallato con Windows 11 Pro e Microsoft Office 2021 per essere subito operativo!', 499.00),
	(28, 'PC Fisso Intel i5-12450h', 'Perfetto per produttività, intrattenimento e videochiamate, questo All-in-One da 27" offre prestazioni elevate grazie al processore Intel Core i5 di 12ª generazione, \r\n8GB di RAM DDR4 e grafica Intel UHD. Design moderno con cornice sottile e webcam integrata con otturatore per la privacy.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: Intel Core i5-12450H (12ª generazione)\r\n\r\nRAM: 8GB DDR4\r\n\r\nGrafica: Intel UHD integrata\r\n\r\nDisplay: 27" IPS FHD con tecnologia Acer BlueLightShield, reclinabile da -5° a 25°\r\n\r\nWebcam: 5 MP con microfoni stereo e otturatore per la privacy\r\n\r\nConnettività: Wi-Fi 6E, Bluetooth 5.0, USB 3.2 Gen 1/2, USB-C Gen 2\r\n\r\n💡 Ideale per chi cerca un PC elegante, funzionale e completo per casa, studio e ufficio.\r\n', 679.00),
	(29, 'PC Fisso AMD Ryzen-5 7520u', 'Questo All-in-One HP da 27" è progettato per offrire prestazioni fluide, intrattenimento di qualità e un design moderno e sostenibile.\r\nPerfetto per l\'uso quotidiano, combina velocità, ampio spazio di archiviazione e connettività rapida in un unico dispositivo elegante.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: Affidabile CPU da 2,8 GHz per un utilizzo reattivo\r\n\r\nMemoria: SSD da 1 TB per avvio rapido e ampio spazio per tutti i file\r\n\r\nGrafica: Integrata, ideale per video, streaming e attività quotidiane\r\n\r\nDisplay: Schermo IPS da 27" con risoluzione brillante e ampio angolo di visione\r\n\r\nFunzioni extra: HP QuickDrop per trasferimenti wireless da PC a smartphone\r\n\r\nDesign ecologico: realizzato con plastiche riciclate e materiali sostenibili\r\n\r\n💡 Ideale per chi cerca un PC all-in-one affidabile, ecologico e pronto per ogni esigenza quotidiana.', 890.00),
	(30, 'PC Fisso Intel i3-1315Uh', 'Questo All-in-One da 23,8" unisce eleganza, performance e versatilità in un unico dispositivo perfetto per casa o ufficio. \r\nOttimo per la produttività quotidiana, garantisce fluidità, reattività e uno stile moderno.\r\n\r\nCaratteristiche principali:\r\n\r\nDisplay: pannello IPS Full HD da 23,8" con risoluzione 1920x1080, refresh rate a 100Hz e luminosità fino a 250 nits con tecnologia Low Blue Light\r\n\r\nProcessore: Intel Core i3 di 13a generazione, prestazioni fluide con consumi contenuti\r\n\r\nStorage: SSD M.2 2280 PCIe 4.0x4 NVMe da 512GB, rapido e capiente per tutti i tuoi file\r\n\r\nRAM: 8GB DDR5-5200 espandibile fino a 16GB, per adattarsi a ogni esigenza operativa\r\n\r\nAccessori: tastiera italiana e mouse Wireless EOS Cloud Grey inclusi, design elegante e minimalista\r\n\r\n✨ Ideale per chi cerca un All-in-One compatto, performante e pronto per l’uso quotidiano ✨\r\n', 599.00),
	(31, 'PC Fisso Intel i5 3570', 'Affidabile e conveniente, questo PC VOKOT con Intel Core i5 di terza generazione è perfetto per l’uso personale quotidiano, grazie alla buona combinazione di potenza, connettività e memoria.\r\nIl case Middle Tower Leshi offre un design compatto e moderno con porte USB 3.0 e 2.0 integrate per un facile accesso.\r\nCon 16GB di RAM DDR3 e SSD da 500GB, potrai navigare, lavorare e studiare con tempi di caricamento ridotti.\r\nLa scheda madre H61 con Wi-Fi incluso garantisce una connessione stabile e veloce.\r\nIl sistema operativo Windows 11 Pro a 64 bit e Office 2019 già installati lo rendono pronto all’uso fin da subito.\r\n\r\nPerfetto per l’uso personale, attività da ufficio e navigazione web.\r\n\r\nCaratteristiche principali:\r\n\r\n  Processore: Intel Core i5-3570 (4 Core, fino a 3.8 GHz, 6 MB cache)\r\n \r\n  Scheda grafica: Intel HD 2000 integrata\r\n \r\n  RAM: 16GB DDR3 DIMM (2x8GB)\r\n \r\n  Storage: SSD SATA da 500GB (fino a 540 MB/s)\r\n \r\n  Case: Middle Tower Leshi Black con alimentatore da 250W e porte USB 3.0/2.0\r\n \r\n  Sistema operativo: Windows 11 Pro 64 bit + Office 2019\r\n\r\n🔥 Lavora, studia e naviga con semplicità: il tuo PC personale firmato Tecno shop! ⚡', 209.00),
	(32, 'PC Fisso Intel Core i7-14700', 'Preparati a superare i limiti della produttività con la Workstation Desktop Lenovo ThinkStation P2, progettata per i professionisti più esigenti. \r\nCon la potenza di elaborazione dei processori Intel Core i7-14700, 20 core e frequenza fino a 4,2 GHz, questa workstation offre prestazioni impeccabili per applicazioni \r\ntecniche e creative avanzate. La grafica NVIDIA RTX A2000 12GB assicura una resa visiva perfetta per rendering e progettazioni CAD.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: Intel Core i7-14700 (fino a 20 core, 4,2 GHz)\r\n\r\nMemoria RAM: fino a 128 GB DDR5\r\n\r\nStorage: fino a 12 TB (M.2 PCIe NVMe SSD e HDD SATA)\r\n\r\nScheda Grafica: NVIDIA RTX A2000 12GB\r\n\r\nConnettività: USB-C, USB-A, HDMI 2.1, DisplayPort 1.4, Ethernet\r\n\r\nSicurezza: TPM 2.0, BIOS auto-riparante, opzioni di blocco fisico\r\n\r\n🚀 Potenzia la tua creatività e produttività con Tecno shop! 💼', 1099.00),
	(33, 'PC Fisso AMD Ryzen-5 5600G', 'Scopri la potenza e la versatilità del Desktop HP con Windows 11 Home, pensato per soddisfare le esigenze di gaming, multitasking, creatività e produttività.\r\nEquipaggiato con un processore AMD Ryzen 5 5600G, che offre una frequenza fino a 4,4 GHz, e una GPU integrata AMD Radeon, è la soluzione ideale per una performance bilanciata.\r\nCon 16 GB di RAM DDR4, 512 GB di SSD PCIe NVMe e numerosi slot di espansione, questo PC si adatta perfettamente a ogni esigenza, dal lavoro smart al gaming entry level.\r\n\r\nCaratteristiche principali:\r\n\r\nProcessore: AMD Ryzen 5 5600G (6 Core, 12 thread, fino a 4,4 GHz)\r\n\r\nMemoria RAM: 16 GB DDR4 3200 MHz (single channel)\r\n\r\nStorage: 512 GB SSD PCIe Express NVMe, 2 M.2 slot di espansione\r\n\r\nScheda Grafica: AMD Radeon integrata\r\n\r\nConnettività: LAN GbE, Wi-Fi, Bluetooth 4.2, 8 USB Type-A, HDMI 1.4b, VGA, RJ-45\r\n\r\nDesign: case in metallo nero, pannello frontale in plastica riciclata, presa d\'aria laterale\r\n\r\n🚀 Potenzia la tua esperienza digitale con Tecno shop! 🎮💻', 529.00),
	(34, 'PC Fisso Intel Core i7-8700', 'Potenzia la tua produttività con il Desktop HP, progettato per offrire prestazioni elevate in ogni contesto, dal lavoro quotidiano all\'istruzione.\r\nEquipaggiato con un processore Intel Core i7-8700 che raggiunge i 4,6 GHz in turbo boost, 32 GB di RAM DDR4 e un SSD da 512 GB, questo PC è ideale per affrontare ogni \r\nattività con velocità e affidabilità. Con una varietà di porte USB, DisplayPort, e slot di espansione M.2, offre una connettività completa per le tue esigenze professionali.\r\n\r\nCaratteristiche principali:\r\n\r\nSistema Operativo: Windows 11 Pro con Licenza COA\r\n\r\nProcessore: Intel Core i7-8700 (6 Core, 12 Thread, fino a 4,6 GHz in turbo boost)\r\n\r\nMemoria RAM: 32 GB DDR4\r\n\r\nStorage: 512 GB SSD SATA III\r\n\r\nConnettività: 6 x USB 3.2 Gen1, 2 x USB 2.0, 2 x DisplayPort, 2 x M.2 NVMe, 2 x PCI-Express x16, 2 x PCI-Express x4\r\n\r\nGrafica: Intel UHD Graphics 630 (integrata)\r\n\r\n⚡ Ottieni il massimo dal tuo lavoro con Tecno shop! 💼', 339.00);

-- Dump della struttura di tabella sito.indirizzo
CREATE TABLE IF NOT EXISTS `indirizzo` (
  `IDIndirizzo` int(11) NOT NULL AUTO_INCREMENT,
  `Via` varchar(255) DEFAULT NULL,
  `NumeroCivico` varchar(10) DEFAULT NULL,
  `Citta` varchar(100) DEFAULT NULL,
  `idutente` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDIndirizzo`),
  KEY `idutente` (`idutente`),
  CONSTRAINT `idutente` FOREIGN KEY (`idutente`) REFERENCES `utente` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella sito.indirizzo: ~0 rows (circa)
DELETE FROM `indirizzo`;

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

-- Dump della struttura di tabella sito.ordini
CREATE TABLE IF NOT EXISTS `ordini` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utente` int(11) NOT NULL,
  `totale` decimal(10,2) NOT NULL,
  `data` timestamp NULL DEFAULT current_timestamp(),
  `idindirizzo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utente` (`id_utente`),
  KEY `idindirizzo` (`idindirizzo`),
  CONSTRAINT `idindirizzo` FOREIGN KEY (`idindirizzo`) REFERENCES `indirizzo` (`IDIndirizzo`),
  CONSTRAINT `ordini_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dump dei dati della tabella sito.ordini: ~0 rows (circa)
DELETE FROM `ordini`;

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

-- Dump dei dati della tabella sito.ordini_prodotti: ~0 rows (circa)
DELETE FROM `ordini_prodotti`;

-- Dump della struttura di tabella sito.recensione
CREATE TABLE IF NOT EXISTS `recensione` (
  `IDRecensione` int(11) NOT NULL AUTO_INCREMENT,
  `Punteggio` int(11) DEFAULT NULL CHECK (`Punteggio` between 1 and 5),
  `Descrizione` text DEFAULT NULL,
  `IDUtente` int(11) DEFAULT NULL,
  `IDProdotto` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDRecensione`),
  KEY `IDUtente` (`IDUtente`),
  KEY `IDProdotto` (`IDProdotto`),
  CONSTRAINT `recensione_ibfk_1` FOREIGN KEY (`IDUtente`) REFERENCES `utente` (`ID`),
  CONSTRAINT `recensione_ibfk_2` FOREIGN KEY (`IDProdotto`) REFERENCES `computer` (`IDProdotto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella sito.recensione: ~0 rows (circa)
DELETE FROM `recensione`;

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

-- Dump dei dati della tabella sito.tagcomputer: ~102 rows (circa)
DELETE FROM `tagcomputer`;
INSERT INTO `tagcomputer` (`IDProdotto`, `IdTag`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(12, 1),
	(22, 1),
	(23, 1),
	(27, 1),
	(32, 1),
	(1, 2),
	(14, 3),
	(15, 3),
	(18, 3),
	(19, 3),
	(20, 3),
	(21, 3),
	(22, 3),
	(23, 3),
	(24, 3),
	(25, 3),
	(27, 4),
	(28, 4),
	(29, 4),
	(33, 4),
	(34, 4),
	(1, 5),
	(4, 5),
	(5, 5),
	(6, 5),
	(7, 5),
	(8, 5),
	(12, 5),
	(13, 5),
	(21, 5),
	(22, 5),
	(23, 5),
	(24, 5),
	(25, 5),
	(29, 5),
	(33, 5),
	(3, 6),
	(12, 6),
	(2, 7),
	(13, 7),
	(8, 8),
	(3, 9),
	(8, 9),
	(19, 9),
	(24, 9),
	(29, 9),
	(30, 9),
	(31, 9),
	(34, 9),
	(4, 10),
	(5, 11),
	(7, 11),
	(6, 12),
	(2, 13),
	(14, 13),
	(15, 13),
	(18, 13),
	(19, 13),
	(20, 13),
	(26, 13),
	(27, 13),
	(28, 13),
	(30, 13),
	(31, 13),
	(32, 13),
	(34, 13),
	(4, 14),
	(8, 14),
	(14, 14),
	(15, 14),
	(20, 14),
	(26, 14),
	(28, 14),
	(30, 14),
	(34, 14),
	(15, 15),
	(18, 15),
	(20, 15),
	(21, 15),
	(22, 15),
	(25, 15),
	(4, 16),
	(6, 16),
	(13, 16),
	(18, 16),
	(21, 16),
	(24, 16),
	(25, 16),
	(26, 16),
	(27, 16),
	(28, 16),
	(29, 16),
	(30, 16),
	(31, 16),
	(32, 16),
	(33, 16);

-- Dump della struttura di tabella sito.utente
CREATE TABLE IF NOT EXISTS `utente` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `carrello` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella sito.utente: ~0 rows (circa)
DELETE FROM `utente`;

