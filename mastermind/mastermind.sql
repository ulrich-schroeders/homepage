-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Jul 2022 um 22:27
-- Server-Version: 10.4.22-MariaDB
-- PHP-Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `d03b468f`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `icar`
--

CREATE TABLE `icar` (
  `ID` int(11) NOT NULL,
  `items` int(11) NOT NULL,
  `picture` text NOT NULL,
  `solution` int(11) NOT NULL,
  `headline` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `icar`
--

INSERT INTO `icar` (`ID`, `items`, `picture`, `solution`, `headline`) VALUES
(1, 6, 'icar/r1.png', 3, 'Welches Bild A-F vervollstaendigt die Matrix?'),
(2, 6, 'icar/r2.png', 2, 'Welches Bild A-F vervollstaendigt die Matrix?'),
(3, 6, 'icar/r3.png', 4, 'Welches Bild A-F vervollstaendigt die Matrix?'),
(4, 6, 'icar/r4.png', 1, 'Welches Bild A-F vervollstaendigt die Matrix?'),
(5, 6, 'icar/r5.png', 1, 'Welches Bild A-F vervollstaendigt die Matrix?'),
(6, 6, 'icar/r6.png', 3, 'Welches Bild A-F vervollstaendigt die Matrix?'),
(7, 6, 'icar/r7.png', 4, 'Welches Bild A-F vervollstaendigt die Matrix?'),
(8, 6, 'icar/r8.png', 2, 'Welches Bild A-F vervollstaendigt die Matrix?'),
(9, 6, 'icar/r9.png', 0, 'Welches Bild A-F vervollstaendigt die Matrix?'),
(10, 6, 'icar/r10.png', 3, 'Welches Bild A-F vervollstaendigt die Matrix?'),
(11, 6, 'icar/r11.png', 4, 'Welches Bild A-F vervollstaendigt die Matrix?');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `icarlines`
--

CREATE TABLE `icarlines` (
  `ID` int(11) NOT NULL,
  `orderIndex` int(11) NOT NULL,
  `icarID` int(11) NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `icarlines`
--

INSERT INTO `icarlines` (`ID`, `orderIndex`, `icarID`, `picture`) VALUES
(1, 0, 1, 'icar/r1a.png'),
(2, 1, 1, 'icar/r1b.png'),
(3, 2, 1, 'icar/r1c.png'),
(4, 3, 1, 'icar/r1d.png'),
(5, 4, 1, 'icar/r1e.png'),
(6, 5, 1, 'icar/r1f.png'),
(7, 0, 2, 'icar/r2a.png'),
(8, 1, 2, 'icar/r2b.png'),
(9, 2, 2, 'icar/r2c.png'),
(10, 3, 2, 'icar/r2d.png'),
(11, 4, 2, 'icar/r2e.png'),
(12, 5, 2, 'icar/r2f.png'),
(13, 0, 3, 'icar/r3a.png'),
(14, 1, 3, 'icar/r3b.png'),
(15, 2, 3, 'icar/r3c.png'),
(16, 3, 3, 'icar/r3d.png'),
(17, 4, 3, 'icar/r3e.png'),
(18, 5, 3, 'icar/r3f.png'),
(19, 0, 4, 'icar/r4a.png'),
(20, 1, 4, 'icar/r4b.png'),
(21, 2, 4, 'icar/r4c.png'),
(22, 3, 4, 'icar/r4d.png'),
(23, 4, 4, 'icar/r4e.png'),
(24, 5, 4, 'icar/r4f.png'),
(25, 0, 5, 'icar/r5a.png'),
(26, 1, 5, 'icar/r5b.png'),
(27, 2, 5, 'icar/r5c.png'),
(28, 3, 5, 'icar/r5d.png'),
(29, 4, 5, 'icar/r5e.png'),
(30, 5, 5, 'icar/r5f.png'),
(31, 0, 6, 'icar/r6a.png'),
(32, 1, 6, 'icar/r6b.png'),
(33, 2, 6, 'icar/r6c.png'),
(34, 3, 6, 'icar/r6d.png'),
(35, 4, 6, 'icar/r6e.png'),
(36, 5, 6, 'icar/r6f.png'),
(37, 0, 7, 'icar/r7a.png'),
(38, 1, 7, 'icar/r7b.png'),
(39, 2, 7, 'icar/r7c.png'),
(40, 3, 7, 'icar/r7d.png'),
(41, 4, 7, 'icar/r7e.png'),
(42, 5, 7, 'icar/r7f.png'),
(43, 0, 8, 'icar/r8a.png'),
(44, 1, 8, 'icar/r8b.png'),
(45, 2, 8, 'icar/r8c.png'),
(46, 3, 8, 'icar/r8d.png'),
(47, 4, 8, 'icar/r8e.png'),
(48, 5, 8, 'icar/r8f.png'),
(49, 0, 9, 'icar/r9a.png'),
(50, 1, 9, 'icar/r9b.png'),
(51, 2, 9, 'icar/r9c.png'),
(52, 3, 9, 'icar/r9d.png'),
(53, 4, 9, 'icar/r9e.png'),
(54, 5, 9, 'icar/r9f.png'),
(55, 0, 10, 'icar/r10a.png'),
(56, 1, 10, 'icar/r10b.png'),
(57, 2, 10, 'icar/r10c.png'),
(58, 3, 10, 'icar/r10d.png'),
(59, 4, 10, 'icar/r10e.png'),
(60, 5, 10, 'icar/r10f.png'),
(61, 0, 11, 'icar/r11a.png'),
(62, 1, 11, 'icar/r11b.png'),
(63, 2, 11, 'icar/r11c.png'),
(64, 3, 11, 'icar/r11d.png'),
(65, 4, 11, 'icar/r11e.png'),
(66, 5, 11, 'icar/r11f.png');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `participants`
--

CREATE TABLE `participants` (
  `ID` int(11) NOT NULL,
  `hashid` text NOT NULL,
  `gender` int(11) NOT NULL DEFAULT 0,
  `age` int(11) NOT NULL DEFAULT 0,
  `education` int(11) NOT NULL DEFAULT 0,
  `mastermind` int(11) NOT NULL DEFAULT 0,
  `created` timestamp NULL DEFAULT NULL,
  `itemset` int(11) NOT NULL DEFAULT 0,
  `nextriddle` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Tabellenstruktur für Tabelle `riddlelines`
--

CREATE TABLE `riddlelines` (
  `ID` int(11) NOT NULL,
  `lineIndex` int(11) NOT NULL,
  `lineEntries` text NOT NULL,
  `correctPositions` int(11) NOT NULL,
  `correctColors` int(11) NOT NULL,
  `riddleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `riddlelines`
--

INSERT INTO `riddlelines` (`ID`, `lineIndex`, `lineEntries`, `correctPositions`, `correctColors`, `riddleID`) VALUES
(1, 0, '[0,2,3]', 0, 2, 1),
(2, 1, '[1,0,2]', 0, 3, 1),
(3, 0, '[3,1,0]', 1, 1, 2),
(4, 1, '[2,3,0]', 0, 3, 2),
(5, 0, '[4,2,0]', 1, 1, 3),
(6, 1, '[2,3,0]', 0, 3, 3),
(7, 0, '[1,2,0]', 0, 1, 4),
(8, 1, '[4,3,1]', 0, 3, 4),
(9, 0, '[1,2,4]', 0, 2, 5),
(10, 1, '[4,1,3]', 1, 2, 5),
(11, 2, '[1,4,3]', 0, 3, 5),
(12, 0, '[0,1,3]', 0, 2, 6),
(13, 1, '[2,0,1]', 1, 1, 6),
(14, 2, '[1,0,2]', 0, 2, 6),
(15, 3, '[0,2,3]', 0, 3, 6),
(16, 0, '[1,3,0]', 1, 1, 7),
(17, 1, '[0,1,3]', 0, 2, 7),
(18, 2, '[3,1,2]', 0, 3, 7),
(19, 0, '[2,1,0]', 1, 2, 8),
(20, 1, '[1,0,3]', 1, 1, 8),
(21, 2, '[2,3,1]', 2, 0, 8),
(22, 0, '[0,1,2]', 2, 0, 9),
(23, 1, '[3,2,0]', 0, 2, 9),
(24, 0, '[2,1,3]', 2, 0, 10),
(25, 1, '[3,0,1]', 1, 1, 10),
(26, 0, '[2,0,3]', 0, 2, 11),
(27, 1, '[2,3,1]', 1, 1, 11),
(28, 2, '[0,1,2]', 1, 2, 11),
(29, 0, '[1,3,2]', 2, 0, 12),
(30, 1, '[3,1,0]', 0, 2, 12),
(31, 2, '[2,3,0]', 1, 2, 12),
(32, 0, '[1,2,3]', 2, 0, 13),
(33, 1, '[1,3,0]', 2, 0, 13),
(34, 0, '[4,1,2]', 0, 1, 14),
(35, 1, '[1,4,3]', 0, 1, 14),
(36, 2, '[2,0,3]', 1, 2, 14),
(37, 0, '[3,2,1]', 1, 2, 15),
(38, 1, '[1,3,4]', 1, 1, 15),
(39, 2, '[1,0,4]', 1, 0, 15),
(40, 0, '[1,0,2,3]', 2, 2, 16),
(41, 1, '[0,1,2,3]', 0, 4, 16),
(42, 0, '[2,0,1,3]', 2, 2, 17),
(43, 1, '[1,2,0,3]', 2, 2, 17),
(44, 2, '[1,0,3,2]', 2, 2, 17),
(45, 0, '[2,1,3,0]', 0, 4, 18),
(46, 1, '[3,1,2,0]', 0, 4, 18),
(47, 2, '[0,3,1,2]', 2, 2, 18),
(48, 3, '[2,0,1,3]', 2, 2, 18),
(49, 0, '[0,4,3]', 0, 2, 19),
(50, 1, '[2,0,4]', 1, 1, 19),
(51, 2, '[3,1,0]', 1, 0, 19),
(52, 0, '[3,2,1]', 2, 0, 20),
(53, 1, '[4,1,2]', 0, 1, 20),
(54, 2, '[4,3,0]', 1, 1, 20),
(55, 0, '[2,4,3]', 2, 0, 21),
(56, 1, '[1,3,0]', 1, 1, 21),
(57, 0, '[3,2,1,0]', 1, 3, 22),
(58, 1, '[0,1,2,3]', 1, 3, 22),
(59, 2, '[1,3,0,2]', 0, 4, 22),
(60, 3, '[2,1,3,0]', 0, 4, 22),
(61, 0, '[0,3,1,2]', 1, 3, 23),
(62, 1, '[1,3,0,2]', 0, 4, 23),
(63, 2, '[3,2,1,0]', 0, 4, 23),
(64, 0, '[3,2,1,0]', 2, 1, 24),
(65, 1, '[2,4,1,0]', 0, 3, 24),
(66, 2, '[4,3,0,1]', 1, 2, 24),
(67, 3, '[2,0,3,4]', 1, 3, 24),
(68, 0, '[2,4,3,1]', 1, 3, 25),
(69, 1, '[0,1,3,4]', 2, 1, 25),
(70, 2, '[3,4,2,0]', 0, 3, 25),
(71, 3, '[0,3,1,2]', 0, 3, 25),
(72, 0, '[2,3,1,0]', 1, 2, 26),
(73, 1, '[3,0,4,2]', 1, 2, 26),
(74, 2, '[4,0,3,1]', 0, 3, 26),
(75, 3, '[1,2,0,4]', 0, 4, 26),
(76, 0, '[3,0,4,1]', 0, 4, 27),
(77, 1, '[0,3,4,2]', 2, 1, 27),
(78, 0, '[1,4,0]', 0, 1, 28),
(79, 1, '[0,2,3]', 0, 2, 28),
(80, 2, '[3,0,1]', 1, 1, 28),
(81, 3, '[1,3,4]', 0, 2, 28),
(82, 0, '[3,0,1,4]', 2, 1, 29),
(83, 1, '[1,3,4,2]', 1, 2, 29),
(84, 2, '[1,2,0,3]', 1, 2, 29),
(85, 0, '[2,1,4,3]', 2, 1, 30),
(86, 1, '[3,0,2,1]', 2, 1, 30),
(87, 0, '[0,1]', 0, 0, 31),
(88, 1, '[2,3]', 0, 2, 31),
(89, 0, '[0,2,1]', 0, 3, 32),
(90, 1, '[2,1,0]', 0, 3, 32);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `riddles`
--

CREATE TABLE `riddles` (
  `ID` int(11) NOT NULL,
  `Columns` int(11) NOT NULL,
  `Colors` int(11) NOT NULL,
  `solution` text NOT NULL,
  `itemset` int(11) NOT NULL DEFAULT 0,
  `tutorialText` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `riddles`
--

INSERT INTO `riddles` (`ID`, `Columns`, `Colors`, `solution`, `itemset`, `tutorialText`) VALUES
(1, 3, 4, '[2,1,0]', 1, 'Aufgabe 1 \r\n'),
(2, 3, 4, '[3,0,2]', 2, 'Aufgabe 1 \r\n'),
(3, 3, 5, '[0,2,3]', 1, 'Aufgabe 2 \r\n'),
(4, 3, 5, '[3,1,4]', 2, 'Aufgabe 2 \r\n'),
(5, 3, 5, '[4,3,1]', 1, 'Aufgabe 3 \r\n'),
(5, 3, 5, '[4,3,1]', 2, 'Aufgabe 3 \r\n'),
(6, 3, 4, '[2,3,0]', 1, 'Aufgabe 4 \r\n'),
(6, 3, 4, '[2,3,0]', 2, 'Aufgabe 4 \r\n'),
(7, 3, 4, '[2,3,1]', 1, 'Aufgabe 5 \r\n'),
(7, 3, 4, '[2,3,1]', 2, 'Aufgabe 5 \r\n'),
(8, 3, 4, '[2,0,1]', 1, 'Aufgabe 6 \r\n'),
(9, 3, 4, '[0,1,3]', 1, 'Aufgabe 7 \r\n'),
(10, 3, 4, '[2,0,3]', 2, 'Aufgabe 6 \r\n'),
(11, 3, 4, '[0,2,1]', 1, 'Aufgabe 8 \r\n'),
(12, 3, 4, '[0,3,2]', 2, 'Aufgabe 7 \r\n'),
(13, 3, 4, '[1,2,0]', 2, 'Aufgabe 8 \r\n'),
(14, 3, 5, '[2,3,0]', 1, 'Aufgabe 9 \r\n'),
(15, 3, 5, '[1,2,3]', 2, 'Aufgabe 9 \r\n'),
(16, 4, 4, '[1,0,3,2]', 1, 'Aufgabe 10 \r\n'),
(17, 4, 4, '[1,0,2,3]', 1, 'Aufgabe 11 \r\n'),
(17, 4, 4, '[1,0,2,3]', 2, 'Aufgabe 10 \r\n'),
(18, 4, 4, '[0,2,1,3]', 1, 'Aufgabe 12 \r\n'),
(18, 4, 4, '[0,2,1,3]', 2, 'Aufgabe 11 \r\n'),
(19, 3, 5, '[3,2,4]', 1, 'Aufgabe 13 \r\n'),
(20, 3, 5, '[3,2,0]', 2, 'Aufgabe 12 \r\n'),
(21, 3, 5, '[1,4,3]', 2, 'Aufgabe 13 \r\n'),
(22, 4, 4, '[3,0,2,1]', 1, 'Aufgabe 14 \r\n'),
(23, 4, 4, '[0,1,2,3]', 2, 'Aufgabe 14 \r\n'),
(24, 4, 5, '[3,2,0,4]', 1, 'Aufgabe 15 \r\n'),
(25, 4, 5, '[1,2,3,4]', 2, 'Aufgabe 15 \r\n'),
(26, 4, 5, '[0,4,1,2]', 1, 'Aufgabe 16 \r\n'),
(27, 4, 5, '[0,3,1,4]', 2, 'Aufgabe 16 \r\n'),
(28, 3, 5, '[3,1,2]', 1, 'Aufgabe 17 \r\n'),
(28, 3, 5, '[3,1,2]', 2, 'Aufgabe 17 \r\n'),
(29, 4, 5, '[1,0,2,4]', 1, 'Aufgabe 18 \r\n'),
(30, 4, 5, '[2,0,4,1]', 2, 'Aufgabe 18 \r\n'),
(31, 2, 4, '[3,2]', 0, 'Dies ist die erste Uebungsaufgabe. Ziehen Sie die Kugeln auf die freien \r\nKreise in der untersten Zeile!\r\n\r\nWenn Sie die Uebungsaufgabe korrekt geloest haben, kommen Sie zur zweiten \r\nUebungsaufgabe. Falls Sie den Code nicht geknackt haben, koennen Sie die \r\nUebungsaufgabe ein weiteres Mal bearbeiten.\r\n'),
(32, 3, 3, '[1,0,2]', 0, 'Dies ist die zweite und letzte Uebungsaufgabe. \r\nZiehen Sie wieder die Kugeln auf die freien Kreise in der untersten Zeile, \r\num den Code zu knacken!\r\n\r\nWenn Sie auch die zweite Uebungsaufgabe korrekt geloest haben, beginnt der\r\nTest. Bei den Testaufgaben erhalten Sie keine Rueckmeldung mehr, ob die\r\nAufgabe korrekt geloest wurde.\r\n');


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `submittedsolutions`
--

CREATE TABLE `submittedsolutions` (
  `ID` int(11) NOT NULL,
  `participantID` int(11) NOT NULL,
  `riddleID` int(11) NOT NULL DEFAULT -1,
  `icarID` int(11) NOT NULL DEFAULT -1,
  `timestampStart` timestamp NULL DEFAULT NULL,
  `timestampEnd` timestamp NULL DEFAULT NULL,
  `time` int(11) NOT NULL,
  `solution` text NOT NULL,
  `correct` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `winnerlist`
--

CREATE TABLE `winnerlist` (
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `icar`
--
ALTER TABLE `icar`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `icarlines`
--
ALTER TABLE `icarlines`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `lines` (`orderIndex`,`icarID`);

--
-- Indizes für die Tabelle `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `HASHID` (`hashid`(768)) USING HASH;

--
-- Indizes für die Tabelle `riddlelines`
--
ALTER TABLE `riddlelines`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `lineIndex` (`lineIndex`),
  ADD KEY `riddleID` (`riddleID`);

--
-- Indizes für die Tabelle `riddles`
--
ALTER TABLE `riddles`
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `itemsetIndex` (`itemset`);

--
-- Indizes für die Tabelle `submittedsolutions`
--
ALTER TABLE `submittedsolutions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `participant` (`participantID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `icar`
--
ALTER TABLE `icar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `icarlines`
--
ALTER TABLE `icarlines`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT für Tabelle `participants`
--
ALTER TABLE `participants`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT für Tabelle `riddles`
--
ALTER TABLE `riddles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT für Tabelle `submittedsolutions`
--
ALTER TABLE `submittedsolutions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
