-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Cze 2022, 16:27
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `hotel`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `guests`
--

CREATE TABLE `guests` (
  `LOGIN` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `IMIE` varchar(30) NOT NULL,
  `NAZWISKO` varchar(30) NOT NULL,
  `NR_POK` tinyint(2) DEFAULT NULL,
  `DATA_PRZYJAZDU` date DEFAULT NULL,
  `DATA_WYJAZDU` date DEFAULT NULL,
  `ZAMELDOWANY` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `guests`
--

INSERT INTO `guests` (`LOGIN`, `PASSWORD`, `IMIE`, `NAZWISKO`, `NR_POK`, `DATA_PRZYJAZDU`, `DATA_WYJAZDU`, `ZAMELDOWANY`) VALUES
('jkowal', '123', 'Joanna', 'Kowalczyk', 0, NULL, NULL, 'NIE'),
('test2', '123', 'Adam', 'Kowalski', 5, '2022-06-23', '2022-06-26', 'TAK'),
('wjasina', 'Qwerty', 'Wojciech', 'Jasina', 0, NULL, NULL, 'NIE'),
('zkotecki', 'haslo', 'Zbigniew', 'Kotecki', 4, '2022-07-01', '2022-07-08', 'NIE');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rooms`
--

CREATE TABLE `rooms` (
  `NR_POK` tinyint(1) NOT NULL,
  `WOLNY` varchar(3) NOT NULL,
  `CZYSTO` varchar(3) DEFAULT NULL,
  `ZAMELDOWANY` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `rooms`
--

INSERT INTO `rooms` (`NR_POK`, `WOLNY`, `CZYSTO`, `ZAMELDOWANY`) VALUES
(1, 'TAK', 'NIE', 'NIE'),
(2, 'TAK', 'NIE', 'NIE'),
(3, 'TAK', 'TAK', 'NIE'),
(4, 'NIE', 'TAK', 'NIE'),
(5, 'NIE', 'TAK', 'TAK'),
(6, 'TAK', 'TAK', 'NIE');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `LOGIN` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `ID` tinyint(1) NOT NULL,
  `IMIE` varchar(30) DEFAULT NULL,
  `NAZWISKO` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`LOGIN`, `PASSWORD`, `ID`, `IMIE`, `NAZWISKO`) VALUES
('employee', 'nicepass', 1, 'Anna', 'Nowak'),
('jkowal', '123', 0, 'Joanna', 'Kowalczyk'),
('manager', 'admin', 2, 'Tomasz', 'Sokołowski'),
('test2', '123', 0, 'Adam', 'Kowalski'),
('wjasina', 'Qwerty', 0, 'Wojciech', 'Jasina'),
('zkotecki', 'haslo', 0, 'Zbigniew', 'Kotecki');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`LOGIN`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`LOGIN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
