-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Сен 01 2023 г., 21:16
-- Версия сервера: 8.0.34-0ubuntu0.20.04.1
-- Версия PHP: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `olimp_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `intro` text NOT NULL,
  `text` text NOT NULL,
  `date` int NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `title`, `intro`, `text`, `date`, `author`) VALUES
(13, 'qweqweqweq', 'wqweqweqweqw', 'qweqweqweqwe', 1690747581, 'Jipeg'),
(16, 'йцуйцуйцуйцуй цуйц уй цуйцу', 'йцуйцуйцуйцуцйуйуйцуй', 'йцуйцуйцуйцуйу йцуйцуйцуйц у', 1691226560, 'Jipeg');

-- --------------------------------------------------------

--
-- Структура таблицы `problems`
--

CREATE TABLE `problems` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `intro` text NOT NULL,
  `text` text NOT NULL,
  `date` int NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `solutions`
--

CREATE TABLE `solutions` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(25) NOT NULL,
  `code` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `problem_id` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `login` varchar(20) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `yandex` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `login`, `pass`, `yandex`) VALUES
(1, 'Николай', 'nickandronick@gmail.com', 'Jipeg', 'f5b33ed0d078669e7745c5fcb8ff362e', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `problems`
--
ALTER TABLE `problems`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `solutions`
--
ALTER TABLE `solutions`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `solutions`
--
ALTER TABLE `solutions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
