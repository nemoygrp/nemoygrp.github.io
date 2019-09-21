-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 29 2019 г., 09:08
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
-- База данных: `php_2_level_nebolsin`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_session` text NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_orders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `dateCreate`, `id_session`, `id_product`, `id_user`, `id_orders`) VALUES
(64, '2019-03-26 00:00:00', '19dounboebflp4clfkpvb0r2g3789drl', 1, 7, 2),
(65, '2019-03-26 00:00:00', '19dounboebflp4clfkpvb0r2g3789drl', 1, 7, 2),
(69, '2019-03-27 18:31:21', '19dounboebflp4clfkpvb0r2g3789drl', 3, 7, 2),
(70, '2019-03-27 18:31:22', '19dounboebflp4clfkpvb0r2g3789drl', 3, 7, 2),
(71, '2019-03-27 20:12:50', '19dounboebflp4clfkpvb0r2g3789drl', 5, 7, 4),
(72, '2019-03-27 20:12:51', '19dounboebflp4clfkpvb0r2g3789drl', 5, 7, 4),
(73, '2019-03-27 20:12:55', '19dounboebflp4clfkpvb0r2g3789drl', 7, 7, 4),
(74, '2019-03-27 20:12:55', '19dounboebflp4clfkpvb0r2g3789drl', 7, 7, 4),
(76, '2019-03-28 17:28:54', '19dounboebflp4clfkpvb0r2g3789drl', 3, 0, 8),
(77, '2019-03-28 17:28:56', '19dounboebflp4clfkpvb0r2g3789drl', 3, 0, 8),
(78, '2019-03-28 17:29:33', '19dounboebflp4clfkpvb0r2g3789drl', 4, 0, 8),
(79, '2019-03-28 17:29:34', '19dounboebflp4clfkpvb0r2g3789drl', 4, 0, 8),
(80, '2019-03-28 17:42:13', '19dounboebflp4clfkpvb0r2g3789drl', 4, 0, 9),
(81, '2019-03-28 17:42:14', '19dounboebflp4clfkpvb0r2g3789drl', 4, 0, 9),
(82, '2019-03-28 17:42:30', '19dounboebflp4clfkpvb0r2g3789drl', 3, 0, 10),
(83, '2019-03-28 17:42:34', '19dounboebflp4clfkpvb0r2g3789drl', 3, 0, 10),
(84, '2019-03-28 17:43:43', '19dounboebflp4clfkpvb0r2g3789drl', 2, 0, 11),
(85, '2019-03-28 17:43:43', '19dounboebflp4clfkpvb0r2g3789drl', 2, 0, 11),
(86, '2019-03-28 17:44:46', '19dounboebflp4clfkpvb0r2g3789drl', 3, 0, 12),
(87, '2019-03-28 17:44:47', '19dounboebflp4clfkpvb0r2g3789drl', 3, 0, 12),
(88, '2019-03-28 17:46:27', '19dounboebflp4clfkpvb0r2g3789drl', 3, 0, 13),
(89, '2019-03-28 17:46:28', '19dounboebflp4clfkpvb0r2g3789drl', 3, 0, 13),
(90, '2019-03-28 17:47:21', '19dounboebflp4clfkpvb0r2g3789drl', 1, 7, 14),
(91, '2019-03-28 17:47:22', '19dounboebflp4clfkpvb0r2g3789drl', 1, 7, 14),
(92, '2019-03-28 17:51:10', '19dounboebflp4clfkpvb0r2g3789drl', 2, 6, 15),
(93, '2019-03-28 17:51:11', '19dounboebflp4clfkpvb0r2g3789drl', 2, 6, 15),
(94, '2019-03-28 18:43:55', 'tci3r2k56japeki4a7hh7btb4hpfjn8o', 2, 7, 16);

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
(199, 'Джамшут', 'Дед Зашем продайоте, верните мой метла, ворюгимана', 2, 'products'),
(200, 'Снеговик', 'Хочу купить себе на шапку', 3, 'products'),
(201, 'Хипстер', 'Олд скул', 1, 'products'),
(202, 'Миша', 'О МОЙ БОГ всего за 300 рублей, дайте 3!!!!!!!!', 3, 'products'),
(203, 'Игнат', 'Девченки не ссорьтесь', 6, 'gallery'),
(215, 'Медведев', 'Ах ты падаль усатая!!!', 22, 'gallery'),
(216, 'medvedev', 'Как живая!!', 6, 'products'),
(217, 'medvedev', 'хочу себе такую домой', 6, 'products'),
(219, 'Медведев', 'плавали знаем', 32, 'gallery'),
(220, 'medvedev', 'как у меня', 5, 'products'),
(227, 'ИГНАТ', 'И мост не плох', 8, 'gallery'),
(228, 'ИГНАТ', 'Ну так покупай!!!!', 6, 'products'),
(229, 'Валера', 'Отличная вещь! Всем советую!', 4, 'products'),
(230, 'Валера', 'Очень крутые спички', 1, 'products'),
(231, 'Валера', 'У меня такой был!', 8, 'products');

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
(1, '01.jpg', 1, 6, 1),
(6, '06.jpg', 36, 144, 3),
(8, '08.jpg', 52, 165, 1),
(13, '13.jpg', 13, 34, 0),
(14, '14.jpg', 0, 3, 0),
(20, '03.jpg', 2, 8, 1),
(21, '07.jpg', 10, 70, 0),
(22, '09.jpg', 24, 106, 3),
(31, '12.jpg', 53, 168, 1),
(32, '10.jpg', 33, 116, 2),
(33, '15.jpg', 10, 27, 1),
(34, '02.jpg', 0, 1, 0),
(35, '04.jpg', 0, 3, 0),
(36, '05.jpg', 0, 3, 0),
(37, '11.jpg', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `added` datetime DEFAULT NULL,
  `status` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_session` text NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `added`, `status`, `id_user`, `id_session`, `phone`) VALUES
(8, '2019-03-28 17:33:26', 'Заказ подтвержден', 0, '19dounboebflp4clfkpvb0r2g3789drl', '+7 (904) 222-22-22'),
(9, '2019-03-28 17:42:21', 'Заказ отменен', 0, '19dounboebflp4clfkpvb0r2g3789drl', '+7 (904) 222-22-22'),
(10, '2019-03-28 17:42:41', 'Заказ отправлен', 0, '19dounboebflp4clfkpvb0r2g3789drl', '+7 (904) 222-22-22'),
(11, '2019-03-28 17:43:52', 'Заказ подтвержден', 0, '19dounboebflp4clfkpvb0r2g3789drl', '+7 (904) 222-22-22'),
(12, '2019-03-28 17:44:53', 'Заказ подтвержден', 0, '19dounboebflp4clfkpvb0r2g3789drl', '+7 (904) 222-22-22'),
(13, '2019-03-28 17:46:35', 'Ожидает подтверждения', 0, '19dounboebflp4clfkpvb0r2g3789drl', '+7 (904) 222-22-22'),
(14, '2019-03-28 17:47:27', 'Ожидает подтверждения', 7, '19dounboebflp4clfkpvb0r2g3789drl', '+7 (907) 456-45-78'),
(15, '2019-03-28 17:51:17', 'Заказ отменен', 6, '19dounboebflp4clfkpvb0r2g3789drl', '+7 (093) 333-33-33'),
(16, '2019-03-28 18:44:01', 'Ожидает подтверждения', 7, 'tci3r2k56japeki4a7hh7btb4hpfjn8o', '+7 (907) 456-45-78');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
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
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `img`, `name`, `price`, `likes`, `looks`, `discount`, `commentCount`) VALUES
(1, 'img/catalog/001.jpg', 'Спички', 50, 3, 90, 0, 2),
(2, 'img/catalog/002.jpg', 'Метла', 150, 63, 189, 0, 1),
(3, 'img/catalog/003.jpg', 'Ведро', 300, 15, 262, 0, 2),
(4, 'img/catalog/004.jpg', 'Антикварный табурет', 400, 3, 16, 0, 1),
(5, 'img/catalog/005.jpg', 'Винтажные носки', 400, 30, 106, 0, 1),
(6, 'img/catalog/006.jpg', 'Уникальное чучело лисы', 1500, 22, 97, 0, 3),
(7, 'img/catalog/007.jpg', 'История КПСС', 1000, 8, 21, 0, 0),
(8, 'img/catalog/008.jpg', 'Москвич б/у требует ремонта', 12000, 37, 18, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `access` text NOT NULL,
  `pass` text NOT NULL,
  `hash` text NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `access`, `pass`, `hash`, `name`, `phone`, `email`) VALUES
(2, 'user23', 'user', '$2y$11$asdafgfsagasdfasdfasdO3f1dVc.QXCgYy.jnmNrh1k665Njngra', '10106282395c6fd2fdb7d141.01775120', 'Киркоров', '0', ''),
(3, 'admin', 'admin', '$2y$11$asdafgfsagasdfasdfasdOU0eGK3LJbP7k4QZw1vkLeYnkalWaYR6', '2633183015c9ced85357b19.40443858', 'ИГНАТ', '0', ''),
(4, 'oper', 'operator', '$2y$11$asdafgfsagasdfasdfasdOhzNGKYTsfEWqsWi4n/D1F/7jdt6M6xq', '2157510185c9ceb09b68be4.24326820', 'Ниночка', '0', ''),
(6, 'user', 'user', '$2y$11$asdafgfsagasdfasdfasdOv3OBTBXO4IoUrU2groz.A9jIFgr/sfm', '11181914555c9cdf596c4a80.73334470', 'Валера', '0', 'valeronMogushiyBolt@bk.ru'),
(7, 'medvedev', 'user', '$2y$11$asdafgfsagasdfasdfasdOU0eGK3LJbP7k4QZw1vkLeYnkalWaYR6', '5356953725c9cebb578bc52.04274876', 'Медведев', '79074564578', 'medvedev@sutulaya.org'),
(9, 'Putin', 'user', '$2y$11$asdafgfsagasdfasdfasdOU0eGK3LJbP7k4QZw1vkLeYnkalWaYR6', '6014881115c9ca421568954.31981543', 'Володька', '79000000000', 'imperator@galaxy.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_ibfk_1` (`id_user`),
  ADD KEY `cart_ibfk_3` (`id_orders`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`id_user`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
