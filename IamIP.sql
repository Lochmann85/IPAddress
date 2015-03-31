-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 31. Mrz 2015 um 13:24
-- Server Version: 5.5.41-0ubuntu0.14.04.1
-- PHP-Version: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `IamIP`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Austria'),
(2, 'Germany'),
(3, 'Italy');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `town`
--

CREATE TABLE IF NOT EXISTS `town` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8_bin NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `town`
--

INSERT INTO `town` (`id`, `name`, `country_id`) VALUES
(1, 'Vienna', 1),
(2, 'Graz', 1),
(3, 'Berlin', 2),
(4, 'Munich', 2),
(5, 'Innsbruck', 1),
(6, 'Rome', 3),
(7, 'Milano', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `voucher`
--

CREATE TABLE IF NOT EXISTS `voucher` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_compact` tinytext COLLATE utf8_bin NOT NULL,
  `town_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `town_id` (`town_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `voucher`
--

INSERT INTO `voucher` (`id`, `description_compact`, `town_id`) VALUES
(1, 'Hofer student wien', 1),
(2, 'Museumsquartier Wien', 1),
(3, 'Puntigamer Graz', 2),
(4, 'Book a table Graz', 2),
(5, 'BMW Gutschein', 4),
(6, 'Bayern München Ticket', 4),
(7, 'Berlinale', 3),
(8, 'Alexanderplatz', 3),
(9, 'Goldene Dachl', 5),
(10, 'Colloseum', 6),
(12, 'La scala', 7);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `town`
--
ALTER TABLE `town`
  ADD CONSTRAINT `town_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `voucher`
--
ALTER TABLE `voucher`
  ADD CONSTRAINT `voucher_ibfk_1` FOREIGN KEY (`town_id`) REFERENCES `town` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
