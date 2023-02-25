-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 24, 2023 alle 09:39
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `Username` varchar(30) NOT NULL,
  `Id_Prodotto` int(11) NOT NULL,
  `Quantità` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `Id_Ordine` int(11) NOT NULL,
  `Totale` decimal(10,2) NOT NULL,
  `Data` datetime NOT NULL,
  `Username` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini_prodotti`
--

CREATE TABLE `ordini_prodotti` (
  `Id_Ordine` int(11) NOT NULL,
  `Id_Prodotto` int(11) NOT NULL,
  `Quantità` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `Id_Prodotto` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Prezzo` decimal(10,2) NOT NULL,
  `Descrizione` text NOT NULL,
  `Link_Immagine` varchar(100) NOT NULL DEFAULT 'https://dummyimage.com/600x400/dee2e6/6c757d.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`Id_Prodotto`, `Nome`, `Prezzo`, `Descrizione`, `Link_Immagine`) VALUES
(1, 'Cacciavite', '8.19', 'Philips', 'https://www.aquatuning.it/media/image/74/e4/58/32046_1_600x600.jpg'),
(2, 'Viti', '2.37', 'Duratool', 'https://standardbolts.net/wp-content/uploads/2018/10/CARRIAGE-BOLT-ZINC.png?v=1603699697'),
(3, 'Martello', '20.03', 'Stanley', 'https://i.ebayimg.com/images/g/y9EAAOSwSatiAqIt/s-l640.jpg'),
(4, 'Trapano', '169.99', 'Hitachi', 'https://tcdn.storeden.com/product/13511939/14652184'),
(5, 'Seghetto', '22.99', 'Brixo', 'https://images-eu.ssl-images-amazon.com/images/I/31eAqeh0zwL._AC_UL600_SR600,400_.jpg'),
(6, 'Presa', '5.00', 'Vimar', 'https://images-eu.ssl-images-amazon.com/images/I/41m53mRpn7L._AC_UL600_SR600,400_.jpg'),
(7, 'Nastro adesivo', '5.00', 'Scotch', 'https://images-eu.ssl-images-amazon.com/images/I/71XZvIRXqxL._AC_UL600_SR600,400_.jpg'),
(8, 'Lucchetto', '4.98', 'Abus', 'https://images-eu.ssl-images-amazon.com/images/I/61mlQbD4a7S._AC_UL600_SR600,400_.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `Username` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD UNIQUE KEY `Username_2` (`Username`,`Id_Prodotto`),
  ADD KEY `Utenti_Carrello` (`Username`),
  ADD KEY `Prodotti_Carrello` (`Id_Prodotto`),
  ADD KEY `Username` (`Username`);

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`Id_Ordine`),
  ADD KEY `Ordini_Utenti` (`Username`);

--
-- Indici per le tabelle `ordini_prodotti`
--
ALTER TABLE `ordini_prodotti`
  ADD KEY `Id_Ordine` (`Id_Ordine`,`Id_Prodotto`),
  ADD KEY `OrdiniProdotti_Prodotti` (`Id_Prodotto`);

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`Id_Prodotto`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `Id_Ordine` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prodotti`
--
ALTER TABLE `prodotti`
  MODIFY `Id_Prodotto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `Carrello_Prodotti` FOREIGN KEY (`Id_Prodotto`) REFERENCES `prodotti` (`Id_Prodotto`),
  ADD CONSTRAINT `Carrello_Utenti` FOREIGN KEY (`Username`) REFERENCES `utenti` (`Username`);

--
-- Limiti per la tabella `ordini`
--
ALTER TABLE `ordini`
  ADD CONSTRAINT `Ordini_Utenti` FOREIGN KEY (`Username`) REFERENCES `utenti` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ordini_prodotti`
--
ALTER TABLE `ordini_prodotti`
  ADD CONSTRAINT `OrdiniProdotti_Prodotti` FOREIGN KEY (`Id_Prodotto`) REFERENCES `prodotti` (`Id_Prodotto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
