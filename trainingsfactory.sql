-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 17 apr 2017 om 15:56
-- Serverversie: 5.7.14
-- PHP-versie: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trainingfactory`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lessons`
--

CREATE TABLE `lessons` (
  `id` int(9) NOT NULL,
  `time` time(4) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `max_persons` int(9) NOT NULL,
  `training_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `lessons`
--

INSERT INTO `lessons` (`id`, `time`, `date`, `location`, `max_persons`, `training_id`) VALUES
(1, '09:45:00.0000', '2017-04-19', 'Den Haag', 10, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `personen`
--

CREATE TABLE `personen` (
  `id` int(9) NOT NULL,
  `loginname` varchar(9) NOT NULL,
  `password` varchar(9) NOT NULL,
  `firstname` varchar(9) NOT NULL,
  `preprovision` varchar(9) NOT NULL,
  `lastname` varchar(9) NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` varchar(9) NOT NULL,
  `emailadress` varchar(255) NOT NULL,
  `hiring_date` date DEFAULT NULL,
  `salary` int(9) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `role` enum('member','instructeur','administrator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `personen`
--

INSERT INTO `personen` (`id`, `loginname`, `password`, `firstname`, `preprovision`, `lastname`, `dateofbirth`, `gender`, `emailadress`, `hiring_date`, `salary`, `street`, `postal_code`, `place`, `role`) VALUES
(2, 'casey', 'qwerty', 'Casey', '', 'Vianen', '1998-10-05', 'Man', 'casey.vianen@gmail.com', '2017-04-04', 20, 'soestdijksekade 609', '2574 BH', 'Den Haag', 'member'),
(3, 'admin', 'qwerty', 'Tim', 'van de ', 'Ven', '2017-04-12', 'Man', 'admin@mondriaanict.nl', NULL, NULL, NULL, NULL, 'Den Haag', 'administrator'),
(5, 'Test', 'qwerty', 'Test', '', 'Test', '2017-04-04', '', '', NULL, NULL, NULL, NULL, NULL, 'instructeur');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `registrations`
--

CREATE TABLE `registrations` (
  `id` int(9) NOT NULL,
  `payment` tinyint(1) DEFAULT NULL,
  `lesson_id` int(9) NOT NULL,
  `person_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `registrations`
--

INSERT INTO `registrations` (`id`, `payment`, `lesson_id`, `person_id`) VALUES
(1, 1, 1, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `trainingen`
--

CREATE TABLE `trainingen` (
  `id` int(9) NOT NULL,
  `description` varchar(9) NOT NULL,
  `duration` int(9) NOT NULL,
  `extra_costs` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `trainingen`
--

INSERT INTO `trainingen` (`id`, `description`, `duration`, `extra_costs`) VALUES
(1, 'Boks les', 90, 20);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_id` (`training_id`),
  ADD KEY `training_id_2` (`training_id`),
  ADD KEY `training_id_3` (`training_id`),
  ADD KEY `training_id_4` (`training_id`);

--
-- Indexen voor tabel `personen`
--
ALTER TABLE `personen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_id` (`lesson_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexen voor tabel `trainingen`
--
ALTER TABLE `trainingen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `personen`
--
ALTER TABLE `personen`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `trainingen`
--
ALTER TABLE `trainingen`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `training_fk` FOREIGN KEY (`training_id`) REFERENCES `trainingen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `fk_lesson_id` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`),
  ADD CONSTRAINT `fk_lesson_id_2` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`),
  ADD CONSTRAINT `fk_person_id` FOREIGN KEY (`person_id`) REFERENCES `personen` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
