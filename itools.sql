-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 09 2025 г., 20:08
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `itools`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`, `delete_status`, `created_at`) VALUES
(1, 'Фрезы', 0, '2025-03-02 19:25:59'),
(2, 'Пластины', 0, '2025-03-02 19:25:59'),
(3, 'Сверла', 0, '2025-03-04 17:26:21'),
(4, 'Метчики', 1, '2025-03-05 12:45:22');

-- --------------------------------------------------------

--
-- Структура таблицы `location`
--

CREATE TABLE `location` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `location`
--

INSERT INTO `location` (`id`, `title`, `created_at`) VALUES
(1, 'Шкаф 1', '2025-03-02 19:31:11'),
(2, 'Шкаф 2', '2025-03-02 19:31:11');

-- --------------------------------------------------------

--
-- Структура таблицы `material_made_of`
--

CREATE TABLE `material_made_of` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `material_made_of`
--

INSERT INTO `material_made_of` (`id`, `title`) VALUES
(1, 'vhm');

-- --------------------------------------------------------

--
-- Структура таблицы `material_use_for`
--

CREATE TABLE `material_use_for` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `material_use_for`
--

INSERT INTO `material_use_for` (`id`, `title`, `delete_status`) VALUES
(1, 'Сталь', 0),
(2, 'Цветные металлы', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tool_id` int(10) UNSIGNED DEFAULT NULL,
  `tool_other` varchar(255) DEFAULT NULL,
  `amount` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `deadline_at` timestamp NOT NULL,
  `order_status_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment_admin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `title`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `tool`
--

CREATE TABLE `tool` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `tool_maker_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `diameter` decimal(10,0) UNSIGNED NOT NULL,
  `full_length` decimal(10,0) NOT NULL,
  `work_length` decimal(10,0) NOT NULL,
  `material_made_of_id` int(10) UNSIGNED NOT NULL,
  `min_amount` int(10) UNSIGNED DEFAULT NULL COMMENT 'Для уведомлений, что нужно докупить',
  `location_id` int(10) UNSIGNED NOT NULL,
  `cell` varchar(255) DEFAULT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `inventory_time` timestamp NULL DEFAULT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0 COMMENT '0 - не удален, 1 - удален',
  `qr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tool`
--

INSERT INTO `tool` (`id`, `created_at`, `updated_at`, `tool_maker_id`, `category_id`, `diameter`, `full_length`, `work_length`, `material_made_of_id`, `min_amount`, `location_id`, `cell`, `project_id`, `inventory_time`, `delete_status`, `qr`) VALUES
(1, '2025-03-02 19:36:31', NULL, 1, 2, '0', '0', '0', 1, 1, 1, '1', NULL, NULL, 0, NULL),
(2, '2025-03-04 09:46:40', NULL, 1, 1, '0', '0', '0', 1, NULL, 1, '2', NULL, NULL, 0, NULL),
(3, '2025-03-04 10:20:17', NULL, 1, 1, '0', '0', '0', 1, NULL, 2, '', NULL, NULL, 0, NULL),
(4, '2025-03-04 10:25:02', NULL, 1, 2, '0', '0', '0', 1, 5, 1, '', NULL, NULL, 0, NULL),
(20, '2025-03-07 21:13:10', NULL, 2, 3, '15', '10', '9', 1, NULL, 1, '', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tool_comment`
--

CREATE TABLE `tool_comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(10) UNSIGNED NOT NULL,
  `tool_id` int(10) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `tool_history`
--

CREATE TABLE `tool_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tool_status_id` int(10) UNSIGNED NOT NULL,
  `tool_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tool_history`
--

INSERT INTO `tool_history` (`id`, `created_at`, `tool_status_id`, `tool_id`, `user_id`) VALUES
(24, '2025-03-06 10:16:03', 3, 4, 1),
(26, '2025-03-06 10:17:38', 3, 2, 1),
(27, '2025-03-06 10:17:50', 1, 1, 1),
(85, '2025-03-06 11:26:40', 2, 3, 3),
(86, '2025-03-06 10:16:56', 1, 4, 1),
(87, '2025-03-06 20:23:56', 1, 2, 1),
(89, '2025-03-06 20:24:33', 5, 1, 1),
(91, '2025-03-07 10:18:06', 3, 4, 3),
(92, '2025-03-07 10:18:09', 1, 4, 3),
(93, '2025-03-07 21:13:10', 1, 20, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tool_image`
--

CREATE TABLE `tool_image` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tool_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tool_image`
--

INSERT INTO `tool_image` (`id`, `created_at`, `tool_id`, `image`) VALUES
(1, '2025-03-04 09:46:40', 2, '1_mZpmYEx.jpg'),
(2, '2025-03-04 09:46:40', 2, '1_QVNreTY.jpg'),
(6, '2025-03-04 11:33:35', 1, '1_WAbtZJS.jpg'),
(7, '2025-03-04 11:33:35', 1, '1_70vQBoB.jpg'),
(13, '2025-03-07 21:15:25', 4, '1_PkunaS4.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `tool_maker`
--

CREATE TABLE `tool_maker` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tool_maker`
--

INSERT INTO `tool_maker` (`id`, `title`) VALUES
(1, 'YG1'),
(2, 'BOSCH');

-- --------------------------------------------------------

--
-- Структура таблицы `tool_material_use_for`
--

CREATE TABLE `tool_material_use_for` (
  `id` int(10) UNSIGNED NOT NULL,
  `tool_id` int(10) UNSIGNED NOT NULL,
  `material_use_for_id` int(10) UNSIGNED NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tool_material_use_for`
--

INSERT INTO `tool_material_use_for` (`id`, `tool_id`, `material_use_for_id`, `delete_status`) VALUES
(20, 20, 1, 0),
(21, 20, 2, 0),
(22, 4, 1, 0),
(23, 3, 1, 0),
(24, 3, 2, 0),
(25, 1, 2, 0),
(26, 2, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tool_status`
--

CREATE TABLE `tool_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tool_status`
--

INSERT INTO `tool_status` (`id`, `title`) VALUES
(1, 'Доступен'),
(2, 'Сломан'),
(3, 'В работе'),
(4, 'В ремонте'),
(5, 'Утерян');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `auth_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `created_at`, `name`, `surname`, `patronymic`, `email`, `password`, `phone`, `role_id`, `auth_key`) VALUES
(1, '2025-03-05 11:33:26', 'Админ', 'Админыч', '', 'adminka@mail.ru', '$2y$13$CgWqBzmIUQEwJBUsCZ7gVePKyOakVn5AijSr88IbRIriHkP1KVql6', '+7-911-295-67-63', 2, 'R7fyKSVb4jD73uZN5gQHRD7JD_lICyHk'),
(3, '2025-03-05 11:44:16', 'Анастасия', 'Бойко', '', 'nastya@mail.ru', '$2y$13$/UbhKe431isv16bjWid4Juf3vrUxnpYM2GbYAWY2pYGtZJvaXfG/m', '+7-911-295-67-61', 1, '7LqKLYjxQu4QMyk4MJgVew3_1ptmoie2'),
(6, '2025-03-09 13:54:14', 'Новый', 'Пользователь', '', 'user2@mail.ru', '$2y$13$IczfgXycUuul3fAnHxqkNexkfM888l.dNGz01cCqaMwd1UZIKlHG2', '+7-911-295-67-62', 1, 'xfxtiPEe6TKB5YNWkI8cOp4FJIV5mYoz'),
(7, '2025-03-09 13:56:21', 'Новый', 'Пользователь', 'Пользователевич', 'user3@mail.ru', '$2y$13$gWiXc46/01kT9MptLpIjluqJTL1yQrsh8dVLbt03jSSdiMbM9n/lG', '+7-911-295-67-65', 1, '_LwXtpAh65LXsvPRvxEd1dtVScAHYiyG'),
(9, '2025-03-09 16:37:54', 'Тест', 'Тест', '', 'test@mail.ru', '$2y$13$EHut0YX5x9ad3lv9OZ3gGOy9x9Ab6KtI.luL8CExJmzHn6fFimjOW', '+7-111-111-11-11', 1, 'KpGaP0ORL10blGR5u62zjhIHmznCMqLL');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material_made_of`
--
ALTER TABLE `material_made_of`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material_use_for`
--
ALTER TABLE `material_use_for`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_status_id` (`order_status_id`),
  ADD KEY `tool_id` (`tool_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tool`
--
ALTER TABLE `tool`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `material_made_of_id` (`material_made_of_id`),
  ADD KEY `tool_maker_id` (`tool_maker_id`);

--
-- Индексы таблицы `tool_comment`
--
ALTER TABLE `tool_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tool_id` (`tool_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `tool_history`
--
ALTER TABLE `tool_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tool_id` (`tool_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tool_status_id` (`tool_status_id`);

--
-- Индексы таблицы `tool_image`
--
ALTER TABLE `tool_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tool_id` (`tool_id`);

--
-- Индексы таблицы `tool_maker`
--
ALTER TABLE `tool_maker`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tool_material_use_for`
--
ALTER TABLE `tool_material_use_for`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_use_for_id` (`material_use_for_id`),
  ADD KEY `tool_id` (`tool_id`);

--
-- Индексы таблицы `tool_status`
--
ALTER TABLE `tool_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `location`
--
ALTER TABLE `location`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `material_made_of`
--
ALTER TABLE `material_made_of`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `material_use_for`
--
ALTER TABLE `material_use_for`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tool`
--
ALTER TABLE `tool`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `tool_comment`
--
ALTER TABLE `tool_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tool_history`
--
ALTER TABLE `tool_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT для таблицы `tool_image`
--
ALTER TABLE `tool_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `tool_maker`
--
ALTER TABLE `tool_maker`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tool_material_use_for`
--
ALTER TABLE `tool_material_use_for`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `tool_status`
--
ALTER TABLE `tool_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`tool_id`) REFERENCES `tool` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_4` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tool`
--
ALTER TABLE `tool`
  ADD CONSTRAINT `tool_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tool_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tool_ibfk_4` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tool_ibfk_5` FOREIGN KEY (`material_made_of_id`) REFERENCES `material_made_of` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tool_ibfk_6` FOREIGN KEY (`tool_maker_id`) REFERENCES `tool_maker` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tool_comment`
--
ALTER TABLE `tool_comment`
  ADD CONSTRAINT `tool_comment_ibfk_1` FOREIGN KEY (`tool_id`) REFERENCES `tool` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tool_comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tool_history`
--
ALTER TABLE `tool_history`
  ADD CONSTRAINT `tool_history_ibfk_1` FOREIGN KEY (`tool_id`) REFERENCES `tool` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tool_history_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tool_history_ibfk_3` FOREIGN KEY (`tool_status_id`) REFERENCES `tool_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tool_image`
--
ALTER TABLE `tool_image`
  ADD CONSTRAINT `tool_image_ibfk_1` FOREIGN KEY (`tool_id`) REFERENCES `tool` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tool_material_use_for`
--
ALTER TABLE `tool_material_use_for`
  ADD CONSTRAINT `tool_material_use_for_ibfk_1` FOREIGN KEY (`material_use_for_id`) REFERENCES `material_use_for` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tool_material_use_for_ibfk_2` FOREIGN KEY (`tool_id`) REFERENCES `tool` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
