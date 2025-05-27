-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Май 27 2025 г., 16:20
-- Версия сервера: 8.0.42
-- Версия PHP: 8.2.27

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
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `delete_status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`, `delete_status`, `created_at`) VALUES
(1, 'Фрезы', 0, '2025-03-02 19:25:59'),
(2, 'Пластины', 0, '2025-03-02 19:25:59'),
(3, 'Сверла', 0, '2025-03-04 17:26:21'),
(4, 'Метчики', 1, '2025-03-05 12:45:22'),
(5, 'Метчики', 0, '2025-05-08 20:47:02');

-- --------------------------------------------------------

--
-- Структура таблицы `location`
--

CREATE TABLE `location` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `material_made_of`
--

INSERT INTO `material_made_of` (`id`, `title`) VALUES
(1, 'vhm'),
(2, 'Р9'),
(3, 'Р12'),
(4, 'Р6М5'),
(5, 'ВК8');

-- --------------------------------------------------------

--
-- Структура таблицы `material_use_for`
--

CREATE TABLE `material_use_for` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `delete_status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `material_use_for`
--

INSERT INTO `material_use_for` (`id`, `title`, `delete_status`) VALUES
(1, 'Сталь', 0),
(2, 'Цветные металлы', 0),
(3, 'Алюминий', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tool_id` int UNSIGNED DEFAULT NULL,
  `tool_other` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `amount` int UNSIGNED NOT NULL,
  `project_id` int UNSIGNED DEFAULT NULL,
  `deadline_at` timestamp NOT NULL,
  `order_status_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `comment_admin` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tool_maker_id` int UNSIGNED NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `diameter` decimal(10,0) UNSIGNED NOT NULL,
  `full_length` decimal(10,0) NOT NULL,
  `work_length` decimal(10,0) NOT NULL,
  `material_made_of_id` int UNSIGNED NOT NULL,
  `min_amount` int UNSIGNED DEFAULT NULL COMMENT 'Для уведомлений, что нужно докупить',
  `location_id` int UNSIGNED NOT NULL,
  `cell` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `project_id` int UNSIGNED DEFAULT NULL,
  `inventory_time` timestamp NULL DEFAULT NULL,
  `delete_status` int NOT NULL DEFAULT '0' COMMENT '0 - не удален, 1 - удален',
  `qr` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tool`
--

INSERT INTO `tool` (`id`, `created_at`, `updated_at`, `tool_maker_id`, `category_id`, `diameter`, `full_length`, `work_length`, `material_made_of_id`, `min_amount`, `location_id`, `cell`, `project_id`, `inventory_time`, `delete_status`, `qr`) VALUES
(1, '2025-03-02 19:36:31', NULL, 1, 2, 0, 0, 0, 1, 1, 1, '1', NULL, NULL, 0, '1_qrcode_681777cf379a9.png'),
(2, '2025-03-04 09:46:40', NULL, 1, 1, 0, 0, 0, 1, NULL, 1, '2', NULL, NULL, 0, '2_qrcode_68177a3bb0d7f.png'),
(3, '2025-03-04 10:20:17', NULL, 1, 1, 0, 0, 0, 1, NULL, 2, '', NULL, NULL, 0, '3_qrcode_68177aea46928.png'),
(4, '2025-03-04 10:25:02', NULL, 1, 5, 0, 0, 0, 1, 5, 1, '123', NULL, NULL, 0, '4_qrcode_681777a540276.png'),
(20, '2025-03-07 21:13:10', NULL, 2, 2, 15, 10, 9, 1, NULL, 1, '33', NULL, NULL, 0, '20_qrcode_681777b8e4740.png'),
(26, '2025-05-09 12:02:31', NULL, 1, 5, 100, 100, 100, 1, NULL, 1, '21', NULL, NULL, 0, '26_qrcode_681deed716eb5.png'),
(28, '2025-05-27 15:21:27', NULL, 7, 3, 15, 10, 1, 1, NULL, 1, '', NULL, NULL, 0, '28_qrcode_6835d8772b711.png'),
(29, '2025-05-27 15:24:21', NULL, 7, 5, 15, 100, 9, 1, NULL, 2, '', NULL, NULL, 0, '29_qrcode_6835d9250bcad.png'),
(30, '2025-05-27 15:25:45', NULL, 8, 5, 1, 5, 4, 1, NULL, 2, '', NULL, NULL, 0, '30_qrcode_6835d979be45e.png'),
(31, '2025-05-27 15:26:30', NULL, 8, 2, 3, 7, 4, 1, 5, 2, '', NULL, NULL, 0, '31_qrcode_6835d9a652c5e.png'),
(32, '2025-05-27 15:45:56', NULL, 9, 1, 15, 19, 14, 1, NULL, 1, '', NULL, NULL, 0, '32_qrcode_6835de34ce0d9.png'),
(33, '2025-05-27 16:03:19', NULL, 9, 5, 10, 19, 14, 2, NULL, 2, '', NULL, NULL, 0, '33_qrcode_6835e247ef599.png');

-- --------------------------------------------------------

--
-- Структура таблицы `tool_comment`
--

CREATE TABLE `tool_comment` (
  `id` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int UNSIGNED NOT NULL,
  `tool_id` int UNSIGNED NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tool_history`
--

CREATE TABLE `tool_history` (
  `id` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tool_status_id` int UNSIGNED NOT NULL,
  `tool_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tool_history`
--

INSERT INTO `tool_history` (`id`, `created_at`, `tool_status_id`, `tool_id`, `user_id`) VALUES
(24, '2025-03-06 10:16:03', 3, 4, 1),
(26, '2025-03-06 10:17:38', 3, 2, 1),
(27, '2025-03-06 10:17:50', 1, 1, 1),
(85, '2025-03-06 11:26:40', 2, 3, 3),
(86, '2025-03-06 10:16:56', 1, 4, 1),
(87, '2025-03-06 20:23:56', 1, 2, 7),
(89, '2025-03-06 20:24:33', 5, 1, 9),
(91, '2025-03-07 10:18:06', 3, 4, 3),
(92, '2025-03-07 10:18:09', 1, 4, 3),
(95, '2025-05-03 13:19:37', 3, 4, 3),
(96, '2025-05-03 13:19:47', 1, 4, 3),
(97, '2025-05-03 21:07:04', 4, 4, 10),
(98, '2025-04-06 18:54:27', 3, 20, 9),
(108, '2025-05-09 11:39:28', 3, 2, 3),
(109, '2025-05-09 12:02:31', 1, 26, 1),
(110, '2025-05-09 13:13:50', 3, 26, 3),
(111, '2025-05-09 13:14:02', 1, 26, 3),
(113, '2025-05-27 15:21:27', 1, 28, 1),
(114, '2025-05-27 15:24:21', 1, 29, 1),
(115, '2025-05-27 15:25:45', 1, 30, 1),
(116, '2025-05-27 15:26:30', 1, 31, 1),
(117, '2025-05-27 15:45:56', 1, 32, 1),
(118, '2025-05-27 15:56:27', 3, 32, 3),
(119, '2025-05-27 15:56:32', 4, 31, 3),
(120, '2025-05-27 15:56:37', 5, 30, 3),
(121, '2025-05-27 15:56:43', 2, 28, 3),
(122, '2025-05-27 16:03:19', 1, 33, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tool_image`
--

CREATE TABLE `tool_image` (
  `id` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tool_id` int UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tool_image`
--

INSERT INTO `tool_image` (`id`, `created_at`, `tool_id`, `image`) VALUES
(18, '2025-05-09 13:05:48', 26, '26_1_1746795948_T7ayuU02_y.jpg'),
(19, '2025-05-09 13:09:21', 26, '26_1_1746796161_K5noRWf3Qs.webp'),
(20, '2025-05-09 13:14:32', 3, '3_1_1746796472_JXSIP4TiAA.webp'),
(21, '2025-05-09 13:14:32', 3, '3_1_1746796472_2uNkOqiD7-.webp'),
(22, '2025-05-09 13:18:40', 2, '2_1_1746796720_daFInL2q3L.webp'),
(23, '2025-05-09 13:18:56', 1, '1_1_1746796736_bXpj3UGEYl.jpg'),
(24, '2025-05-09 13:18:56', 1, '1_1_1746796736_9O0mpttqNB.png'),
(25, '2025-05-09 13:18:56', 1, '1_1_1746796736_-bsHzf3197.webp'),
(26, '2025-05-09 13:19:20', 20, '20_1_1746796760_YjXdLNA0eI.png'),
(27, '2025-05-09 13:20:16', 4, '4_1_1746796816_y7zmiDIpF9.webp'),
(28, '2025-05-09 13:20:16', 4, '4_1_1746796816_9P5BG3SPQ1.webp'),
(29, '2025-05-27 15:21:27', 28, '_1_1748359287_8zpb9_VZ8J.webp'),
(30, '2025-05-27 15:24:21', 29, '_1_1748359461_zsPZLQT95v.webp'),
(31, '2025-05-27 15:24:21', 29, '_1_1748359461_y3vtoFxBwc.jpg'),
(32, '2025-05-27 15:25:45', 30, '_1_1748359545_CZxbfLqkdB.webp'),
(33, '2025-05-27 15:26:54', 31, '31_1_1748359614_m06OoljU6N.webp'),
(34, '2025-05-27 15:45:56', 32, '_1_1748360756_wca1OuUUu4.webp'),
(35, '2025-05-27 15:45:56', 32, '_1_1748360756_h9nfqA1f3e.webp'),
(36, '2025-05-27 16:03:19', 33, '_1_1748361799_0mnwkCx4iX.webp');

-- --------------------------------------------------------

--
-- Структура таблицы `tool_maker`
--

CREATE TABLE `tool_maker` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tool_maker`
--

INSERT INTO `tool_maker` (`id`, `title`) VALUES
(1, 'YG1'),
(2, 'BOSCH'),
(3, 'Russ'),
(7, 'Инсистенс'),
(8, 'ГК Инструмент'),
(9, 'РТ-Инструмент');

-- --------------------------------------------------------

--
-- Структура таблицы `tool_material_use_for`
--

CREATE TABLE `tool_material_use_for` (
  `id` int UNSIGNED NOT NULL,
  `tool_id` int UNSIGNED NOT NULL,
  `material_use_for_id` int UNSIGNED NOT NULL,
  `delete_status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(26, 2, 1, 0),
(27, 1, 1, 0),
(28, 2, 2, 0),
(29, 26, 2, 0),
(32, 28, 2, 0),
(33, 29, 2, 0),
(34, 30, 1, 0),
(35, 31, 1, 0),
(36, 31, 3, 0),
(37, 32, 1, 0),
(38, 32, 3, 0),
(39, 33, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tool_status`
--

CREATE TABLE `tool_status` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `patronymic` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  `auth_key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `created_at`, `name`, `surname`, `patronymic`, `email`, `password`, `phone`, `role_id`, `auth_key`) VALUES
(1, '2025-03-05 11:33:26', 'Админ', 'Админов', '', 'adminka@mail.ru', '$2y$13$T05XA2iaYn4pCOprySrnvuKfAuHZqlRc2ckZd6.XaO9.LNxl25YBu', '+7-911-295-67-63', 2, 'R7fyKSVb4jD73uZN5gQHRD7JD_lICyHk'),
(3, '2025-03-05 11:44:16', 'Анастасия', 'Бойко', 'Сергеевна', 'nastya@mail.ru', '$2y$13$mW/wjXSprDlON.Z/4v1eVOOZaOjOpDyD3B3bxRM527zRLQPniw.4q', '+7-911-295-67-68', 1, '7LqKLYjxQu4QMyk4MJgVew3_1ptmoie2'),
(6, '2025-03-09 13:54:14', 'Новый', 'Пользователь', '', 'user2@mail.ru', '$2y$13$IczfgXycUuul3fAnHxqkNexkfM888l.dNGz01cCqaMwd1UZIKlHG2', '+7-911-295-67-62', 1, 'xfxtiPEe6TKB5YNWkI8cOp4FJIV5mYoz'),
(7, '2025-03-09 13:56:21', 'Новый', 'Пользователь', 'Пользователевич', 'user3@mail.ru', '$2y$13$gWiXc46/01kT9MptLpIjluqJTL1yQrsh8dVLbt03jSSdiMbM9n/lG', '+7-911-295-67-65', 1, '_LwXtpAh65LXsvPRvxEd1dtVScAHYiyG'),
(9, '2025-03-09 16:37:54', 'Тест', 'Тест', '', 'test@mail.ru', '$2y$13$EHut0YX5x9ad3lv9OZ3gGOy9x9Ab6KtI.luL8CExJmzHn6fFimjOW', '+7-111-111-11-11', 1, 'KpGaP0ORL10blGR5u62zjhIHmznCMqLL'),
(10, '2025-05-03 16:46:57', 'Леонид', 'Бойко', '', 'kartman1717@yandex.ru', '$2y$13$c..e0LE9hUFhtYupIB2WgujVWNn2pNcBQTiN8eH6aO09Y0JU65z1e', '+7-952-369-64-93', 1, '1VMH-xAILc6iO7PW_HsSP6108bhaMSYw'),
(12, '2025-05-08 19:52:09', 'Тест', 'Тестов', 'Тестович', 'testo@mail.ru', '$2y$13$.ZBq.o0bn0PpRenJ3THKkO4Elu3WNhQOZCV4oBfgjfwArzDmO3WEq', '+7-952-369-64-99', 1, 'WDlhoKombs9rsLMzJjsECs92wGF8JHtL');

-- --------------------------------------------------------

--
-- Структура таблицы `user_extras`
--

CREATE TABLE `user_extras` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `telegram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_extras`
--

INSERT INTO `user_extras` (`id`, `user_id`, `status`, `position`, `about`, `telegram`, `vk`, `avatar`) VALUES
(1, 3, 'Все идет по плану', 'Ведущий разработчик', '<p>Привет, меня зовут Петр Круизер. Я работаю в индустрии дизайна и разработки уже несколько лет.                                    Моя карьера началась в далеком 2007 году, когда я впервые попробовал себя в роли дизайнера.\r\n                                    С тех пор я успешно реализовал множество проектов различной сложности.\r\n                                    В работе мне помогают такие качества как: креативность, внимательность к деталям и умение работать в команде.\r\n                                    За годы практики я освоил множество инструментов и технологий в области дизайна и веб-разработки.</p>\r\n                                <div>\r\n                                    <h4 class=\"fs-15 text-uppercase mt-3\">Опыт работы</h4>\r\n                                    <div class=\" p-t-10\">\r\n                                        <h5 class=\"text-primary fs-14\">Ведущий дизайнер / Разработчик</h5>\r\n                                        <p class=\"\">websitename.com</p>\r\n                                        <p><b>2010-2015</b></p>\r\n                                        <p class=\"text-muted fs-13\">За время работы в этой компании я создал множество успешных проектов,\r\n                                            от простых лендингов до сложных многостраничных сайтов. Работал с различными CMS системами,\r\n                                            внедрял современные технологии и подходы в разработке. Также занимался обучением новых сотрудников\r\n                                            и координированием работы дизайн-студии.</p>\r\n                                    </div>\r\n                                    <div class=\"\">\r\n                                        <h5 class=\"text-primary fs-14\">Старший графический дизайнер</h5>\r\n                                        <p class=\"\">coderthemes.com</p>\r\n                                        <p><b>2007-2009</b></p>\r\n                                        <p class=\"text-muted fs-13 mb-0\">Моя карьера началась именно здесь. В этой компании я получил бесценный опыт\r\n                                            создания различных дизайнов для веб-сайтов и мобильных приложений. Научился работать с клиентами,\r\n                                            понимать их потребности и воплощать идеи в жизнь. За время работы выполнил более 100 успешных проектов\r\n                                            для клиентов из разных стран мира.</p>\r\n                                    </div>\r\n                                </div>', '@mishka17n', 'https://vk.com/willofpower', '3_1746736444_YhINipd5Dj.jpg'),
(2, 10, 'Лучший', 'Исполнительный директор', 'ИТМО', NULL, NULL, '10_1746294418_dMWaV8udaa.jpg'),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, NULL, NULL, 'Учился потом нет', NULL, NULL, '1_1746793889_rasfg6zORK.jpg'),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 9, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 12, NULL, NULL, NULL, NULL, NULL, NULL);

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
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `role_id` (`role_id`);

--
-- Индексы таблицы `user_extras`
--
ALTER TABLE `user_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `location`
--
ALTER TABLE `location`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `material_made_of`
--
ALTER TABLE `material_made_of`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `material_use_for`
--
ALTER TABLE `material_use_for`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tool`
--
ALTER TABLE `tool`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `tool_comment`
--
ALTER TABLE `tool_comment`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tool_history`
--
ALTER TABLE `tool_history`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT для таблицы `tool_image`
--
ALTER TABLE `tool_image`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `tool_maker`
--
ALTER TABLE `tool_maker`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `tool_material_use_for`
--
ALTER TABLE `tool_material_use_for`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `tool_status`
--
ALTER TABLE `tool_status`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `user_extras`
--
ALTER TABLE `user_extras`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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

--
-- Ограничения внешнего ключа таблицы `user_extras`
--
ALTER TABLE `user_extras`
  ADD CONSTRAINT `user_extras_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
