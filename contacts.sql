-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Време на генериране: 30 юни 2021 в 06:08
-- Версия на сървъра: 5.7.31
-- Версия на PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `contacts`
--

-- --------------------------------------------------------

--
-- Структура на таблица `contact_data`
--

DROP TABLE IF EXISTS `contact_data`;
CREATE TABLE IF NOT EXISTS `contact_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `family` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `city` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `age` int(11) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `sex` char(11) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `notes` text CHARACTER SET utf8mb4,
  `avatar` varchar(255) DEFAULT NULL,
  `createdAt` date DEFAULT NULL,
  `editedAt` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
