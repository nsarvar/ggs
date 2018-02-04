-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 04 2018 г., 22:18
-- Версия сервера: 5.5.41-log
-- Версия PHP: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ggs`
--

-- --------------------------------------------------------

--
-- Структура таблицы `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `account_log`
--

CREATE TABLE IF NOT EXISTS `account_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `device` varchar(200) NOT NULL,
  `event` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_log_fk0` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `account_role`
--

CREATE TABLE IF NOT EXISTS `account_role` (
  `role_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  KEY `account_role_fk0` (`role_id`),
  KEY `account_role_fk1` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', 1, 1517739230),
('author', 2, NULL),
('author', 3, 1517751390);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Администратор', NULL, NULL, 1517736951, 1517736951),
('author', 1, 'Автор', NULL, NULL, 1517736951, 1517736951),
('banned', 1, 'Иплос', NULL, NULL, 1517737403, 1517737403),
('canAdmin', 2, 'Adminkaga kirish imkoniyati', NULL, NULL, 1517738139, 1517738139),
('updateOwnPost', 2, 'O''zini Post ini update qilish imkoniyati', 'isAuthor', NULL, 1517752626, 1517752626),
('updatePost', 2, 'Post ni update qilish imkoniyati', NULL, NULL, 1517752124, 1517752124);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'canAdmin'),
('author', 'canAdmin'),
('author', 'updateOwnPost'),
('admin', 'updatePost'),
('updateOwnPost', 'updatePost');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isAuthor', 0x4f3a32333a22636f6d6d6f6e5c72756c65735c417574686f7252756c65223a333a7b733a343a226e616d65223b733a383a226973417574686f72223b733a393a22637265617465644174223b693a313531373735323333313b733a393a22757064617465644174223b693a313531373735323333313b7d, 1517752331, 1517752331);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `desciption` text NOT NULL,
  `other_detail` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_fk0` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `course_category`
--

CREATE TABLE IF NOT EXISTS `course_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_category_category` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `course_enroll`
--

CREATE TABLE IF NOT EXISTS `course_enroll` (
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  KEY `course_enroll_fk0` (`course_id`),
  KEY `course_enroll_fk1` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `exam_date` date NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_course` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `full_available` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `faculty_course`
--

CREATE TABLE IF NOT EXISTS `faculty_course` (
  `course_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  KEY `faculty_course_fk0` (`course_id`),
  KEY `faculty_course_fk1` (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `faculty_hours`
--

CREATE TABLE IF NOT EXISTS `faculty_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` int(11) NOT NULL,
  `weekday` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `faculty_hours_faculty` (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='it defines the available time of the faculty\r\n' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `grades_course` (`course_id`),
  KEY `grades_exam` (`exam_id`),
  KEY `grades_student` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1517553082),
('m130524_201442_init', 1517553086),
('m140506_102106_rbac_init', 1517722617),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1517722617);

-- --------------------------------------------------------

--
-- Структура таблицы `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `body` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `notice_fk0` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `parents`
--

CREATE TABLE IF NOT EXISTS `parents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `father_name` varchar(200) NOT NULL,
  `mother_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile_phone` varchar(200) DEFAULT NULL,
  `home_phone` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `description` varchar(128) DEFAULT NULL,
  `creator` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `creator` (`creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `title`, `description`, `creator`) VALUES
(1, 'test', 'sjhdfjbj', 3),
(2, 'as sfa fa f', 'd fg dfg dfgdfg djtedhr erher', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `day` varchar(1) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `schedule_fk0` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `bdate` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `passport` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_fk0` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'VLnq_3vrysz7iFEzQRwu5nLmAGzzuc09', '$2y$13$1VD46sdvL9aBA0FG1X71oeWu1lPQS.53/ksLko1KzUqBJMz6.X/j.', NULL, 'admin@mail.ru', 10, 1517553237, 1517553237),
(2, 'test', 'OfBIf0VQWn-pPo8KKrGFnp0Cc776aIGP', '$2y$13$DX3gYf7LkGQL1iA1XxC6b.RG0Xb2VhTSevQyP3eG2nbcyFhe3pf0e', NULL, 'test@mail.ru', 10, 1517738845, 1517738845),
(3, 'content', 'kRrkJ7CkU8FPOR3Z9gs39dLZyziaQqlk', '$2y$13$Utwf9Adxo/Q4zZgvuztVnuOtuY5yd59KIJ84mZ7sHh6T12sfuor4i', NULL, 'content@mail.ru', 10, 1517749900, 1517749900);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `account_log`
--
ALTER TABLE `account_log`
  ADD CONSTRAINT `account_log_fk0` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);

--
-- Ограничения внешнего ключа таблицы `account_role`
--
ALTER TABLE `account_role`
  ADD CONSTRAINT `account_role_fk0` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `account_role_fk1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`);

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_fk0` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Ограничения внешнего ключа таблицы `course_category`
--
ALTER TABLE `course_category`
  ADD CONSTRAINT `course_category_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Ограничения внешнего ключа таблицы `course_enroll`
--
ALTER TABLE `course_enroll`
  ADD CONSTRAINT `course_enroll_fk0` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `course_enroll_fk1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Ограничения внешнего ключа таблицы `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Ограничения внешнего ключа таблицы `faculty_course`
--
ALTER TABLE `faculty_course`
  ADD CONSTRAINT `faculty_course_fk0` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `faculty_course_fk1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`);

--
-- Ограничения внешнего ключа таблицы `faculty_hours`
--
ALTER TABLE `faculty_hours`
  ADD CONSTRAINT `faculty_hours_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`);

--
-- Ограничения внешнего ключа таблицы `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `grades_exam` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `grades_student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Ограничения внешнего ключа таблицы `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_fk0` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_fk0` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_fk0` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
