-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Sie 2018, 11:46
-- Wersja serwera: 10.1.34-MariaDB
-- Wersja PHP: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `krs`
--
CREATE DATABASE IF NOT EXISTS `krs` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `krs`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `all_content`
--

CREATE TABLE IF NOT EXISTS `all_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `content2` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `firmy`
--

CREATE TABLE IF NOT EXISTS `firmy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `kodpocztowy` varchar(250) NOT NULL,
  `monitor` varchar(250) NOT NULL,
  `dzialalnosc` text,
  `wojewodztwo` varchar(250) DEFAULT NULL,
  `miejscowosc` varchar(250) DEFAULT NULL,
  `krs` varchar(250) DEFAULT NULL,
  `kodppkd` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `firmy_all`
--

CREATE TABLE IF NOT EXISTS `firmy_all` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `kodpocztowy` varchar(250) NOT NULL,
  `monitor` varchar(250) NOT NULL,
  `dzialalnosc` text,
  `wojewodztwo` varchar(250) DEFAULT NULL,
  `miejscowosc` varchar(250) DEFAULT NULL,
  `krs` varchar(250) DEFAULT NULL,
  `kodppkd` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `monitor`
--

CREATE TABLE IF NOT EXISTS `monitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monitor` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pozycje`
--

CREATE TABLE IF NOT EXISTS `pozycje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `KRS` varchar(50) NOT NULL,
  `f_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
