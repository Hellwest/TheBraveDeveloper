-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 26 2019 г., 17:54
-- Версия сервера: 10.1.36-MariaDB
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `thebravedeveloper`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `cityid` int(11) NOT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Название города',
  `country` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'В какой стране'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`cityid`, `city`, `country`) VALUES
(1, 'Ижевск', 'Россия'),
(2, 'Казань', 'Россия'),
(3, 'Ростов', 'Россия'),
(4, 'Воронеж', 'Россия'),
(5, 'Москва', 'Россия'),
(6, 'Санкт-Петербург', 'Россия'),
(7, 'Мурманск', 'Россия'),
(8, 'Ульяновск', 'Россия'),
(9, 'Нижний Новгород', 'Россия'),
(10, 'Челябинск', 'Россия'),
(11, 'Лейпциг', 'Германия'),
(12, 'Берлин', 'Германия'),
(13, 'Кёльн', 'Германия'),
(14, 'Мюнхен', 'Германия'),
(15, 'Гамбург', 'Германия'),
(16, 'Франкфурт', 'Германия'),
(17, 'Дрезден', 'Германия'),
(18, 'Нюрнберг', 'Германия'),
(19, 'Потсдам', 'Германия'),
(20, 'Дюссельдорф', 'Германия'),
(21, 'Гётеборг', 'Швеция'),
(22, 'Стокгольм', 'Швеция'),
(23, 'Мальмё', 'Швеция'),
(24, 'Уппсала', 'Швеция'),
(25, 'Хельсингборг', 'Швеция'),
(26, 'Лунд', 'Швеция'),
(27, 'Висбю', 'Швеция'),
(28, 'Вестерос', 'Швеция'),
(29, 'Линчёпинг', 'Швеция'),
(30, 'Умео', 'Швеция'),
(31, 'Нью-Йорк', 'США'),
(32, 'Лос-Анджелес', 'США'),
(33, 'Сан-Франциско', 'США'),
(34, 'Чикаго', 'США'),
(35, 'Бостон', 'США'),
(36, 'Майами', 'США'),
(37, 'Сиэтл', 'США'),
(38, 'Детройт', 'США'),
(39, 'Филадельфия', 'США'),
(40, 'Лас-Вегас', 'США'),
(41, 'Женева', 'Швейцария'),
(42, 'Цюрих', 'Швейцария'),
(43, 'Лозанна', 'Швейцария'),
(44, 'Базель', 'Швейцария'),
(45, 'Лугано', 'Швейцария'),
(46, 'Люцерн', 'Швейцария'),
(47, 'Монтрё', 'Швейцария'),
(48, 'Берн', 'Швейцария'),
(49, 'Интерлакен', 'Швейцария'),
(50, 'Локарно', 'Швейцария'),
(51, 'Симферополь', 'Россия'),
(52, 'Вашингтон', 'США');

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `countryid` int(5) NOT NULL,
  `CountryName` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`countryid`, `CountryName`) VALUES
(2, 'Германия'),
(1, 'Россия'),
(4, 'США'),
(5, 'Швейцария'),
(3, 'Швеция');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityid`),
  ADD KEY `Cascade_Relation` (`country`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countryid`),
  ADD UNIQUE KEY `Название страны` (`CountryName`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `cityid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `countryid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `Cascade_Relation` FOREIGN KEY (`country`) REFERENCES `countries` (`CountryName`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
