-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 mei 2025 om 10:20
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news`
--
CREATE DATABASE IF NOT EXISTS `news` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `news`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `news` text NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `articles`
--

INSERT INTO `articles` (`id`, `title`, `news`, `category_id`) VALUES
(1, 'WhatsApp toont geen waarschuwing bij openen Python- en PHP-bijlagen', 'BleepingComputer schrijft dat WhatsApp voor Windows geen waarschuwing toont als gebruikers een Python- of PHP-bijlage openen via een chatgesprek. De bijlagen worden rechtstreeks geopend en dat zou voor mogelijke beveiligingsproblemen kunnen zorgen.', 1),
(2, 'Nieuw klimaatscenario baart onderzoekers zorgen: juist kouder Nederland', 'Niet warmer, maar wellicht juist een kouder Nederland. Dat is een nieuw scenario dat het ministerie van Infrastructuur en Waterstaat in alle stilte laat onderzoeken. Een werkgroep met experts van de TU Delft, kennisinstituut Deltares en het KNMI brengt de gevolgen van een koeler klimaat in Nederland nu in kaart.', 2),
(3, 'Sporten wordt voor studenten voorlopig toch niet duurder', 'Het wordt voor studenten voorlopig niet duurder om te sporten bij de universiteit. Dat heeft minister Eppo Bruins (Onderwijs, Cultuur en Wetenschap, NSC) woensdagmiddag toegezegd in de Tweede Kamer.', 3),
(4, 'Nieuwe AI-chip van Nederlandse makelij gepresenteerd', 'Een consortium van Nederlandse bedrijven en universiteiten heeft een nieuwe AI-chip ontwikkeld die efficiënter omgaat met energie. De chip wordt volgend jaar getest in diverse datacenters.', 1),
(5, 'Recordhoeveelheid zonne-energie opgewekt in mei', 'In de maand mei is er in Nederland een recordhoeveelheid zonne-energie opgewekt. Volgens het CBS was het aandeel zonne-energie in de totale elektriciteitsproductie nog nooit zo hoog.', 2),
(6, 'Nederlandse hockeyers plaatsen zich voor Olympische Spelen', 'Het Nederlandse hockeyteam heeft zich geplaatst voor de Olympische Spelen na een spannende wedstrijd tegen Duitsland. De beslissende goal viel in de laatste minuut.', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'technologie'),
(2, 'klimaat'),
(3, 'sport');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('member','admin') NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
