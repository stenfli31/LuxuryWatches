-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 01 2025 г., 20:36
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
-- База данных: `LuxuryWatchesDB`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `id` int NOT NULL,
  `brand` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `brand`) VALUES
(1, 'Tissot'),
(2, 'Rado'),
(3, 'Casio'),
(4, 'Maurice'),
(5, 'Titoni'),
(6, 'Tag Heuer'),
(7, 'Raymond Weil');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `category_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Мужские'),
(2, 'Женские'),
(3, 'Крутые');

-- --------------------------------------------------------

--
-- Структура таблицы `favorites`
--

CREATE TABLE `favorites` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `product_id`) VALUES
(9, 1, 6),
(10, 1, 7),
(15, 2, 9),
(14, 2, 10),
(11, 2, 11),
(12, 4, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT 'В обработке',
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `created_at`, `total_amount`, `payment_method`, `status`, `phone`, `email`, `city`, `region`, `zip`, `comment`) VALUES
(1, 2, '7 микрорайон 12 дом', '2025-04-30 18:23:12', '10000000.00', 'card', 'В обработке', '+7 (705) 311-95-45', 'alik21201@gmail.com', 'Костанай', 'Костанайская область', '110004', 'тест'),
(2, 2, '7 микрорайон 12 дом', '2025-04-30 18:27:47', '10000000.00', 'cash', 'В обработке', '+7 (705) 311-95-45', 'alik21201@gmail.com', 'Костанай', 'Костанайская область', '110004', 'тест'),
(3, 2, '32131', '2025-05-01 20:17:57', '1558000.00', 'card', 'В обработке', '+7 (321) 321-__-__', '3213@32', '3213', '321', '321', '321');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 2, 2, 1, '10000000.00'),
(2, 3, 11, 2, '779000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int NOT NULL,
  `permission_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `permission_role`) VALUES
(1, 'Админ'),
(2, 'Покупатель');

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
(2, 'Часы человек паук', 10000000, 'Часы котторые носил человек паук', 3, 3, 'detskie-chasy-chelovek-pauk-2-1000x1000.jpg'),
(3, 'Rado Centrix', 456000, 'Люксовые часы', 2, 1, 'Rado Centrix.jpg'),
(4, 'Rado True Square', 564000, 'Люксовые часы', 2, 1, 'Rado True Square.jpg'),
(5, 'Maurice Lacroix Aikon', 654000, 'Люксовые часы', 4, 1, 'Maurice Lacroix Aikon.jpg'),
(6, 'Tissot T-My Lady', 740000, 'Люксовые часы', 1, 2, 'Tissot T-My Lady.jpg'),
(7, 'Rado True R27061012', 1740000, 'Люксовые часы', 2, 2, 'Rado True R27061012.jpg'),
(8, 'Raymond Weil 2790-ST-52051', 749000, 'Люксовые часы', 7, 1, '2790-ST-52051.jpg'),
(9, 'Titoni 83188-S-575R', 759000, 'Люксовые часы', 5, 1, '83188-S-575R.jpg'),
(10, 'TAG Heuer Carrera WBN2316', 429000, 'Люксовые часы', 6, 2, 'TAG Heuer Carrera WBN2316.jpg'),
(11, 'Raymond Weil 8160-ST-30041', 779000, 'Люксовые часы', 7, 1, 'Raymond Weil 8160-ST-30041.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `shopping_cart`
--

INSERT INTO `shopping_cart` (`id`, `user_id`, `product`, `quantity`) VALUES
(5, 3, 2, 2),
(6, 3, 7, 1),
(7, 3, 4, 1),
(8, 1, 10, 2),
(9, 1, 7, 2),
(14, 1, 6, 2),
(24, 4, 2, 1),
(25, 5, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_status`) VALUES
(1, 'Алишер', 'alik21201@gmail.com', '$2y$10$qc9ZYzbm8PUu8.z/AZiKjuzZq53tkieGA05qd0ohv4mRfC6HyRCou', 2),
(2, 'admin', 'admin@a', '$2y$10$jxYhdRmKrtfiG1/iQEIz9e.Czy2Zp5WHONpDNtxKQL.ocU.UaUonS', 1),
(3, 'альмазир', 'cikichlen@Email.ru', '$2y$10$qaYUsuDsXfHzvCNfkq9U2uPLf1Fk9LGi2eYw5gJmbj5dV9Rfu3gAm', 2),
(4, 'Денис', 'almazirchik@mail.su', '$2y$10$Ohh26Tn93RgiESJJKVPrgOX4i30XqQYfNFxMWycQ7zcAqkqT9C/ny', 2),
(5, 'Максим Юрьевич', 'teacher@mail.com', '$2y$10$2mBn2jdySJYpXJU9ulvXGu2EO5RpkA9DrvODx44qm1jc4ps/p7Ya.', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`product_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category` (`product_category`),
  ADD KEY `brand` (`brand`);

--
-- Индексы таблицы `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`product`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_category`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand`) REFERENCES `brands` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
