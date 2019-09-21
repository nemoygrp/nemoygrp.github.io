-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 04 2019 г., 12:01
-- Версия сервера: 5.7.23
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shopdedignat`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `dateCreate` date DEFAULT NULL,
  `id_session` text NOT NULL,
  `id_goods` int(11) NOT NULL,
  `user` text NOT NULL,
  `id_orders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `dateCreate`, `id_session`, `id_goods`, `user`, `id_orders`) VALUES
(111, '2019-02-28', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 3, 'user', 12),
(112, '2019-02-28', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 3, 'user', 12),
(113, '2019-02-28', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 2, 'user', 13),
(114, '2019-02-28', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 2, 'user', 13),
(116, '2019-03-01', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 3, 'user', 15),
(117, '2019-03-01', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 3, 'user', 15),
(118, '2019-03-01', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 2, 'user', 15),
(119, '2019-03-01', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 2, 'user', 15),
(120, '2019-03-01', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 1, 'user', 15),
(121, '2019-03-01', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 1, 'user', 15),
(122, '2019-03-01', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 1, 'user', 15);

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `feedback` text NOT NULL,
  `id_parent` int(11) NOT NULL,
  `from_table` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `feedback`, `id_parent`, `from_table`) VALUES
(93, 'Маруся', 'Сам ты маруся', 6, 'gallery'),
(94, 'Дуся', 'Перестань называть меня то Дусей то Марусей', 6, 'gallery'),
(184, 'Герасим', 'Надо сплавать', 32, 'gallery'),
(188, 'Хью Грант', 'Что я вообще тут делаю?', 20, 'gallery'),
(189, 'Киркоров', 'О Мой цвет настроения!', 31, 'gallery'),
(190, 'Медведев', 'У меня такая есть!!', 22, 'gallery'),
(192, 'Елка', 'Вот от сюда и в прованс', 33, 'gallery'),
(193, 'ГУФ', 'Я помню был тут', 1, 'gallery'),
(194, 'КОНЬ', 'Любимая сфотала когда я бегал, люблю ее', 8, 'gallery'),
(196, 'Песков', 'Шел бы ты петушок', 22, 'gallery'),
(199, 'Джамшут', 'Дед Зашем продайоте, верните мой метла, ворюгимана', 2, 'goods'),
(200, 'Снеговик', 'Хочу купить себе на шапку', 3, 'goods'),
(201, 'Хипстер', 'Олд скул', 1, 'goods'),
(202, 'Миша', 'О МОЙ БОГ всего за 300 рублей, дайте 3!!!!!!!!', 3, 'goods'),
(203, 'Игнат', 'Девченки не ссорьтесь', 6, 'gallery'),
(215, 'Медведев', 'Ах ты падаль усатая!!!', 22, 'gallery'),
(216, 'medvedev', 'Как живая!!', 6, 'goods'),
(217, 'medvedev', 'хочу себе такую домой', 6, 'goods'),
(219, 'Медведев', 'плавали знаем', 32, 'gallery'),
(220, 'medvedev', 'как у меня', 5, 'goods'),
(227, 'ИГНАТ', 'И мост не плох', 8, 'gallery'),
(228, 'ИГНАТ', 'Ну так покупай!!!!', 6, 'goods'),
(229, 'Валера', 'Отличная вещь! Всем советую!', 4, 'goods'),
(230, 'Валера', 'Очень крутые спички', 1, 'goods'),
(231, 'Валера', 'У меня такой был!', 8, 'goods');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL,
  `likes` int(11) NOT NULL,
  `looks` int(11) NOT NULL,
  `commentCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `likes`, `looks`, `commentCount`) VALUES
(1, '01.jpg', 1, 5, 1),
(6, '06.jpg', 36, 140, 3),
(8, '08.jpg', 52, 164, 1),
(13, '13.jpg', 13, 34, 0),
(14, '14.jpg', 0, 3, 0),
(20, '03.jpg', 2, 7, 1),
(21, '07.jpg', 10, 62, 0),
(22, '09.jpg', 24, 99, 3),
(31, '12.jpg', 53, 166, 1),
(32, '10.jpg', 33, 115, 2),
(33, '15.jpg', 10, 27, 1),
(34, '02.jpg', 0, 1, 0),
(35, '04.jpg', 0, 3, 0),
(36, '05.jpg', 0, 3, 0),
(37, '11.jpg', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `name` text NOT NULL,
  `price` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `looks` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `commentCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `img`, `name`, `price`, `likes`, `looks`, `discount`, `commentCount`) VALUES
(1, 'img/catalog/001.jpg', 'Спички', 50, 2, 80, 0, 2),
(2, 'img/catalog/002.jpg', 'Метла', 150, 4, 140, 0, 1),
(3, 'img/catalog/003.jpg', 'Ведро', 300, 8, 171, 0, 2),
(4, 'img/catalog/004.jpg', 'Антикварный табурет', 400, 2, 9, 0, 1),
(5, 'img/catalog/005.jpg', 'Винтажные носки', 400, 0, 6, 0, 1),
(6, 'img/catalog/006.jpg', 'Уникальное чучело лисы', 1500, 2, 63, 0, 3),
(7, 'img/catalog/007.jpg', 'История КПСС', 1000, 2, 11, 0, 0),
(8, 'img/catalog/008.jpg', 'Москвич б/у требует ремонта', 12000, 0, 6, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `added` datetime NOT NULL,
  `id_session` text NOT NULL,
  `user` text NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `e-mail` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `added`, `id_session`, `user`, `name`, `phone`, `e-mail`, `status`) VALUES
(12, '2019-02-28 22:00:51', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 'user', 'Валера', '+7 (222) 222-22-22', '', 'Ожидает подтверждения'),
(13, '2019-02-28 22:01:09', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 'user', 'Валера', '+7 (333) 333-33-33', '', 'Ожидает подтверждения'),
(14, '2019-03-01 18:45:19', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 'user', 'Валера', '+7 (0', '', 'Заказ отправлен'),
(15, '2019-03-01 19:30:58', '4so2ccgqrb27qitq1v49jcid5ju8ob8j', 'user', 'Валера', '+7 (944) 444-44-44', '', 'Заказ подтвержден');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `access` text NOT NULL,
  `login` text NOT NULL,
  `pass` text NOT NULL,
  `hash` text NOT NULL,
  `name` text NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `access`, `login`, `pass`, `hash`, `name`, `phone`, `email`) VALUES
(1, 'user', 'user', '$2y$11$asdafgfsagasdfasdfasdOv3OBTBXO4IoUrU2groz.A9jIFgr/sfm', '577174405c7a2e4ce8af23.16356776', 'Валера', 0, ''),
(2, 'user', 'user23', '$2y$11$asdafgfsagasdfasdfasdO3f1dVc.QXCgYy.jnmNrh1k665Njngra', '10106282395c6fd2fdb7d141.01775120', 'Киркоров', 0, ''),
(3, 'admin', 'admin', '$2y$11$asdafgfsagasdfasdfasdOU0eGK3LJbP7k4QZw1vkLeYnkalWaYR6', '6343945985c7a6ae2861340.04589914', 'ИГНАТ', 0, ''),
(4, 'operator', 'oper', '$2y$11$asdafgfsagasdfasdfasdOhzNGKYTsfEWqsWi4n/D1F/7jdt6M6xq', '15214175325c7a6826d43217.08795314', 'Ниночка', 0, ''),
(7, 'user', 'medvedev', '$2y$11$asdafgfsagasdfasdfasdOU0eGK3LJbP7k4QZw1vkLeYnkalWaYR6', '8174125805c7a6ab14915b7.33743214', 'Медведев', 79074564578, 'medvedev@sutulaya.org');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
