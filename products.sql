-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 10 2025 г., 03:46
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `LuxuryWatchesShop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` int NOT NULL,
  `product_desc` varchar(100) NOT NULL,
  `brand` int NOT NULL,
  `product_category` int NOT NULL,
  `product_img` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `product_desc`, `brand`, `product_category`, `product_img`) VALUES
(1, 'Tissot T-Classic', 456000, 'Люксовые часы', 1, 1, 'Tissot T-Classic.jpg'),
(2, 'Часы человек паук', 10000000, 'Часы котторые носил человек паук', 3, 1, 'detskie-chasy-chelovek-pauk-2-1000x1000.jpg'),
(3, 'Rado Centrix', 456000, 'Люксовые часы', 2, 1, 'Rado Centrix.jpg'),
(4, 'Rado True Square', 564000, 'Люксовые часы', 2, 1, 'Rado True Square.jpg'),
(5, 'Maurice Lacroix Aikon', 654000, 'Люксовые часы', 4, 1, 'Maurice Lacroix Aikon.jpg'),
(6, 'Tissot T-My Lady', 740000, 'Люксовые часы', 1, 2, 'Tissot T-My Lady.jpg'),
(7, 'Rado True R27061012', 1740000, 'Люксовые часы', 2, 2, 'Rado True R27061012.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category` (`product_category`),
  ADD KEY `brand` (`brand`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_category`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand`) REFERENCES `brands` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
