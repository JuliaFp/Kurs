-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Янв 31 2024 г., 01:39
-- Версия сервера: 10.11.6-MariaDB-1:10.11.6+maria~ubu2004
-- Версия PHP: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `filippova_flowers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `image` varchar(700) NOT NULL,
  `name` varchar(100) NOT NULL,
  `amount` int(5) NOT NULL,
  `price` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `region_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`image`, `name`, `amount`, `price`, `id_product`, `region_id`) VALUES
('dfgdfgdf/fgdf', 'Апельсин', 10, 45, 435665, 3),
('1234.jpg', 'Яблоко', 10, 12, 6, 9),
('1034.jpg', 'Груши', 12, 90, 5, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE `region` (
  `name` varchar(100) NOT NULL,
  `id_region` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `region`
--

INSERT INTO `region` (`name`, `id_region`) VALUES
('новая область', 2),
('новая станция', 6),
('Второй парк', 7),
('Третий парк', 8),
('Четвёртый парк', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(250) NOT NULL,
  `token` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_user`, `login`, `first_name`, `last_name`, `email`, `password`, `token`) VALUES
(2, 'Malianss', 'Portu', 'Ghost', 'ghoster@mail.ru', 'fefw341231f', 156),
(3, 'Sporwiev', 'Golldaniss', 'Marks', 'ghostw42@gmail.com', 'juw4342f', 5),
(4, 'Malianses', 'Golldanis', 'Mark', 'gerg3t34@gmail.com', '$2y$13$Bxtm72FodJZDxQU0kaggD.AxqBoux7YjnzYtNmZ7IgmUnjmu4rLN2', 0),
(5, 'Malianses', 'Golldanis', 'Gold', 'Hujy@gmail.com', '$2y$13$CfW3LyYEy3DvQHZ6qWcEyutzmHoRYWYgInRcscnbrkxahGH8/rtL6', 89),
(6, 'Hfie123', 'Juki', 'Goliy', 'JukiG@gmail.com', '$2y$13$ppmuZ4oGowfCy4OP31igZ..Lr2l6zW0vOnYWpaSxd1PIsWtFgaBAq', 0),
(7, 'Hostes1', 'Polyak', 'Bergin', 'PolyaBer@mail.com', '$2y$13$uKYKL8QQ0DGhIov1JYAXYeMspav6wg0PhqR6ZAJPPHiXHLfXgL07W', 0),
(8, 'Portup45', 'Vanek', 'Login', 'VanekLog@mail.com', '$2y$13$XrUKJIkhVVN1X.O3XO.8SO31VoRyGormSLWcJHDpZvtaUbvMAd5sS', 9000000),
(9, 'Fight100', 'Hup', 'Voluh', 'Hupek_01@mail.com', '$2y$13$I.3fJe5Y3fu/Ou4v5glZ2.FfMbmvocoRUNGW8NmEFGmn38miA8S.a', 10),
(10, 'Jastin540', 'Jastin', 'Fantola', 'Fantola_J@gmail.com', '$2y$13$2M.qqW9209yrKShGfQKO3uR.SRny8YFxC94E/LNRkowRYgkQ72Suq', 0),
(11, 'Jastin540', 'Fantola', 'Jastin', 'Fantola_J@gmail.com', '$2y$13$FMQAFW9a5rpSFuG/qq13quSGy9bapwOF8GQDt60LTk2jqP8IIYm.K', 0),
(12, 'Jastin540', 'Fantola', 'Jastin', 'Fantola_J@gmail.com', '$2y$13$22araasp4J7PZFW/rFn1MO7WZOTFHcuknu.m1xhwTo618R4W9qqja', 4),
(13, 'Jastin540', 'Fantola', 'Jastin', 'Fantola_J@gmail.com', '$2y$13$E1rac/t0fDt1Qm4t74aPfuUv5zL5d83LHFtLyHay4qhFO6FRUdEES', 0),
(14, 'Jastin540', 'Fantola', 'Jastin', 'Fantola_J@gmail.com', '$2y$13$uRyha0gVE0cYGTmP5NXNaeweo/FDvo8nJ6j0k1W6kguX4/SP1HX9a', 0),
(15, 'Jastin540', 'Fantola', 'Jastin', 'Fantola_J@gmail.com', '$2y$13$pj7ibXP4dxRiiGRRgXEc5.EiqKia7IdWtBQ.KmhwgRSiRh854YzBe', 0),
(16, 'Jastin540', 'Fantola', 'Jastin', 'Fantola_J@gmail.com', '$2y$13$yboouQA.qzbQe9OJ.g25UuO7.XVc/u/V.oNFU7/H1ahFFItjTaJZy', 7),
(17, 'Jastin540', 'Fantola', 'Jastin', 'Fantola_J@gmail.com', '$2y$13$CmHRTneWtuMu/VDnnuZJEuP0ZpDFOoDc3E5I.S2ML9y3Lq2tZLM2q', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`region_id`);

--
-- Индексы таблицы `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
