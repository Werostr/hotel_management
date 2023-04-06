-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Cze 2022, 18:13
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
CREATE DATABASE IF NOT EXISTS `hotel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hotel`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `guests`
--

CREATE TABLE `guests` (
  `LOGIN` varchar(30) NOT NULL,
  `PASSWORD` varchar(256) NOT NULL,
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
('abrach', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'Aleksander', 'Brachman', 0, NULL, NULL, 'NIE'),
('anowak', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'Adam', 'Nowak', 3, '2022-06-20', '2022-06-26', 'TAK'),
('iwona', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Iwona', 'Jagoda', 0, NULL, NULL, 'NIE'),
('jkowal', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Joanna', 'Kowalczyk', 1, '2022-06-22', '2022-06-25', 'NIE'),
('jurek', 'f3feeb1118922c8b1a31690172bc73bab784a510ae5cff6abf5c1ccc6bcdd3fe', 'Jerzy', 'Killer', 6, '2022-06-20', '2022-06-26', 'TAK'),
('kw', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'Kacper', 'Wojtyczkowski', 0, NULL, NULL, 'NIE'),
('ola', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Ola', 'Jagoda', 0, NULL, NULL, 'NIE'),
('test2', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Adam', 'Kowalski', 0, NULL, NULL, 'NIE'),
('wjasina', '73d5b2f4ba82d59c723c16a909524559d8f31e33c5d8fdcfc57065dca5c9f189', 'Wojciech', 'Jasina', 2, '2022-06-23', '2022-06-26', 'TAK'),
('zkotecki', 'abe31fe1a2113e7e8bf174164515802806d388cf4f394cceace7341a182271ab', 'Zbigniew', 'Kotecki', 4, '2022-06-23', '2022-06-26', 'TAK');

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
(1, 'NIE', 'TAK', 'NIE'),
(2, 'NIE', 'TAK', 'TAK'),
(3, 'NIE', 'TAK', 'TAK'),
(4, 'NIE', 'TAK', 'TAK'),
(5, 'TAK', 'NIE', 'NIE'),
(6, 'NIE', 'TAK', 'TAK');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `LOGIN` varchar(30) NOT NULL,
  `PASSWORD` varchar(256) NOT NULL,
  `ID` tinyint(1) NOT NULL,
  `IMIE` varchar(30) DEFAULT NULL,
  `NAZWISKO` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`LOGIN`, `PASSWORD`, `ID`, `IMIE`, `NAZWISKO`) VALUES
('abrach', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 0, 'Aleksander', 'Brachman'),
('anowak', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 0, 'Adam', 'Nowak'),
('employee', '97d1f0a40ce451fa201acdb44467b6a57208ac8f6aa968a455966a45198ee9c9', 1, 'Anna', 'Nowak'),
('iwona', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 0, 'Iwona', 'Jagoda'),
('jkowal', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0, 'Joanna', 'Kowalczyk'),
('jurek', 'f3feeb1118922c8b1a31690172bc73bab784a510ae5cff6abf5c1ccc6bcdd3fe', 0, 'Jerzy', 'Killer'),
('kw', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 0, 'Kacper', 'Wojtyczkowski'),
('manager', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 2, 'Tomasz', 'Sokołowski'),
('ola', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 0, 'Ola', 'Jagoda'),
('test2', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0, 'Adam', 'Kowalski'),
('wjasina', '73d5b2f4ba82d59c723c16a909524559d8f31e33c5d8fdcfc57065dca5c9f189', 0, 'Wojciech', 'Jasina'),
('zkotecki', 'abe31fe1a2113e7e8bf174164515802806d388cf4f394cceace7341a182271ab', 0, 'Zbigniew', 'Kotecki');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
