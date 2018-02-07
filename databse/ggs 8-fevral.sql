-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 07 2018 г., 22:20
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Дамп данных таблицы `faculty`
--

INSERT INTO `faculty` (`id`, `fname`, `lname`, `email`, `phone`, `address`, `full_available`, `created_at`, `updated_at`) VALUES
(21, 'Kamola', 'Raximova', 'Kamola-7@mail.ru', '998908903289', 'Sirdaryo viloyati, Sayxunobod tumani, Navoi ko''cha', 1, '2018-02-07 22:20:07', '2018-02-07 22:20:07'),
(22, 'Aziza', 'Hasanova', 'Aziza-2@mail.ru', '998937031494', 'Sirdaryo viloyati, Baxt shahri, Mustaqillik ko''cha', 0, '2018-02-07 22:20:07', '2018-02-07 22:20:07'),
(23, 'Abdulla', 'Mansurov', 'Abdulla-2@mail.ru', '998916347595', 'Buxoro viloyati, G''ijduvon tumani, Abdulla Avloniy', 0, '2018-02-07 22:20:07', '2018-02-07 22:20:07'),
(24, 'Lobar', 'Yo''ldosheva', 'Lobar-9@mail.ru', '998919623443', 'Sirdaryo viloyati, Sirdaryo shahri, Pushkin ko''cha', 0, '2018-02-07 22:20:07', '2018-02-07 22:20:07'),
(25, 'Mamlakat', 'Zokirova', 'Mamlakat-7@mail.ru', '998994341217', 'Sirdaryo viloyati, Sardoba tumani, Abdulla Avloniy', 0, '2018-02-07 22:20:07', '2018-02-07 22:20:07'),
(26, 'Mamlakat', 'Yo''ldosheva', 'Mamlakat-3@mail.ru', '998999949462', 'Sirdaryo viloyati, Sirdaryo shahri, Abdulla Avloni', 0, '2018-02-07 22:20:07', '2018-02-07 22:20:07'),
(27, 'Shaxnoza', 'Mansurova', 'Shaxnoza-9@mail.ru', '998905907318', 'Buxoro viloyati, Romitan tumani, Abdulla Avloniy k', 0, '2018-02-07 22:20:07', '2018-02-07 22:20:07'),
(28, 'Sarvar', 'Latipov', 'Sarvar-5@mail.ru', '998945279449', 'Andijon viloyati, Marhamat tumani, Pushkin ko''chas', 0, '2018-02-07 22:20:07', '2018-02-07 22:20:07'),
(29, 'Maftuna', 'Yo''ldosheva', 'Maftuna-4@mail.ru', '998916531616', 'Toshkent shahri, Mirobod tumani, Pushkin ko''chasi,', 0, '2018-02-07 22:20:07', '2018-02-07 22:20:07'),
(30, 'Dilshod', 'Qodirov', 'Dilshod-6@mail.ru', '998949179595', 'Toshkent shahri, Olmazor tumani, Bunyodkor ko''chas', 0, '2018-02-07 22:20:07', '2018-02-07 22:20:07');

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
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_subject_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_subject_id` (`sub_subject_id`)
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
-- Структура таблицы `mysubject`
--

CREATE TABLE IF NOT EXISTS `mysubject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `sub_subject_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=151 ;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`id`, `code`, `fname`, `lname`, `bdate`, `email`, `passport`, `address`, `phone`, `parent_id`, `created_at`, `updated_at`) VALUES
(51, '4405', 'Kamol', 'Raximov', '1997-05-22', 'Kamol-1@mail.ru', 'SG8545959', 'Sirdaryo viloyati, Sardoba tumani, O''zbekiston ko''chasi, 226-uy.', '998992312316', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(52, '2285', 'Mamlakat', 'Raximova', '1998-08-09', 'Mamlakat-5@mail.ru', 'LY4164337', 'Sirdaryo viloyati, Baxt shahri, O''zbekiston ko''chasi, 290-uy.', '998942701232', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(53, '7045', 'Abdulla', 'Raximov', '1994-07-08', 'Abdulla-3@mail.ru', 'TG4467010', 'Toshkent shahri, Chilonzor tumani, Amir Temur ko''chasi, 59-uy.', '998932365325', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(54, '1163', 'Malika', 'Mansurova', '1990-03-24', 'Malika-8@mail.ru', 'DF7300109', 'Toshkent shahri, Mirobod tumani, Abdulla Avloniy ko''chasi, 79-uy.', '998972194488', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(55, '9965', 'Maftuna', 'Raximova', '1992-03-02', 'Maftuna-3@mail.ru', 'NP4752105', 'Buxoro viloyati, Kogon tumani, Amir Temur ko''chasi, 9-uy.', '998972462280', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(56, '9986', 'Jalol', 'Saidov', '1994-03-11', 'Jalol-3@mail.ru', 'TD1493011', 'Andijon viloyati, Asaka tumani, Mustaqillik ko''chasi, 67-uy.', '998942875366', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(57, '8128', 'Sevinch', 'Saidova', '1996-04-12', 'Sevinch-7@mail.ru', 'KE6102600', 'Buxoro viloyati, G''ijduvon tumani, Abdulla Avloniy ko''chasi, 283-uy.', '998997181457', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(58, '6110', 'Toxir', 'Mansurov', '1994-03-12', 'Toxir-1@mail.ru', 'ZU7805480', 'Andijon viloyati, Asaka tumani, Mustaqillik ko''chasi, 226-uy.', '998995439025', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(59, '5256', 'Kamol', 'Latipov', '1990-11-10', 'Kamol-4@mail.ru', 'MW3606231', 'Toshkent shahri, Mirobod tumani, Navoi ko''chasi, 227-uy.', '998917250122', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(60, '1915', 'Alijon', 'Yo''ldoshev', '1992-09-29', 'Alijon-4@mail.ru', 'BR6973541', 'Buxoro viloyati, G''ijduvon tumani, Abdulla Avloniy ko''chasi, 199-uy.', '998906693939', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(61, '7634', 'Akbar', 'Qodirov', '1992-01-15', 'Akbar-8@mail.ru', 'ZA3242034', 'Toshkent shahri, Sirg''ali tumani, Pushkin ko''chasi, 287-uy.', '998955874908', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(62, '8035', 'Lobar', 'Qodirova', '1995-05-01', 'Lobar-8@mail.ru', 'XE7907653', 'Andijon viloyati, Asaka tumani, Abdulla Avloniy ko''chasi, 145-uy.', '998978325958', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(63, '1845', 'Saodat', 'Qodirova', '1993-11-17', 'Saodat-7@mail.ru', 'DI1922302', 'Sirdaryo viloyati, Sirdaryo shahri, Amir Temur ko''chasi, 195-uy.', '998919302642', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(64, '8277', 'Toxir', 'Raximov', '1991-09-07', 'Toxir-2@mail.ru', 'DL1450164', 'Buxoro viloyati, Buxoro shahri, Mustaqillik ko''chasi, 162-uy.', '998957167999', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(65, '9496', 'Jalol', 'Hasanov', '1995-05-18', 'Jalol-7@mail.ru', 'OG6134460', 'Buxoro viloyati, Romitan tumani, O''zbekiston ko''chasi, 273-uy.', '998975647491', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(66, '2937', 'Sarvar', 'Qodirov', '1993-04-05', 'Sarvar-1@mail.ru', 'TW3866058', 'Toshkent shahri, Shayxontohur tumani, Pushkin ko''chasi, 6-uy.', '998943631225', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(67, '5293', 'Vali', 'Hasanov', '1995-03-11', 'Vali-6@mail.ru', 'RN8073822', 'Toshkent shahri, Mirobod tumani, Navoi ko''chasi, 38-uy.', '998953552398', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(68, '1587', 'Sitora', 'Qodirova', '1994-03-23', 'Sitora-6@mail.ru', 'KS5390411', 'Andijon viloyati, Marhamat tumani, Pushkin ko''chasi, 239-uy.', '998975372558', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(69, '8550', 'Malika', 'Saidova', '1996-12-10', 'Malika-10@mail.ru', 'KM2459533', 'Buxoro viloyati, Buxoro shahri, Abdulla Avloniy ko''chasi, 25-uy.', '998955164916', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(70, '1263', 'Aziza', 'Raximova', '1994-03-23', 'Aziza-10@mail.ru', 'YX9310882', 'Buxoro viloyati, Romitan tumani, Mustaqillik ko''chasi, 274-uy.', '998905458526', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(71, '8854', 'Shaxnoza', 'Hasanova', '1993-03-25', 'Shaxnoza-4@mail.ru', 'EU5048187', 'Buxoro viloyati, Romitan tumani, Bunyodkor ko''chasi, 23-uy.', '998952231842', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(72, '3170', 'Kamol', 'Zokirov', '1992-03-13', 'Kamol-4@mail.ru', 'JW9956329', 'Buxoro viloyati, Kogon tumani, Mustaqillik ko''chasi, 41-uy.', '998995049835', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(73, '9452', 'Saodat', 'Alimova', '1993-11-19', 'Saodat-1@mail.ru', 'ZN3081359', 'Andijon viloyati, Baliqchi shahri, Amir Temur ko''chasi, 19-uy.', '998978100738', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(74, '7018', 'Mamlakat', 'Latipova', '1996-10-16', 'Mamlakat-8@mail.ru', 'XF3142883', 'Toshkent shahri, Yunusobod tumani, Mustaqillik ko''chasi, 222-uy.', '998954881469', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(75, '9586', 'Alijon', 'Mansurov', '1994-10-27', 'Alijon-10@mail.ru', 'NI1793487', 'Andijon viloyati, Marhamat tumani, Abdulla Avloniy ko''chasi, 168-uy.', '998946579406', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(76, '5713', 'Akbar', 'Saidov', '1996-11-26', 'Akbar-10@mail.ru', 'XM5244018', 'Sirdaryo viloyati, Sirdaryo shahri, Navoi ko''chasi, 44-uy.', '998978085906', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(77, '5717', 'Vali', 'Zokirov', '1990-01-08', 'Vali-7@mail.ru', 'YH8745361', 'Toshkent shahri, Shayxontohur tumani, Amir Temur ko''chasi, 159-uy.', '998957289123', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(78, '4029', 'Saodat', 'Zokirova', '1998-08-04', 'Saodat-5@mail.ru', 'ON9908813', 'Sirdaryo viloyati, Sardoba tumani, Abdulla Avloniy ko''chasi, 285-uy.', '998974972381', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(79, '2287', 'Mamlakat', 'Raximova', '1997-01-01', 'Mamlakat-9@mail.ru', 'TB7936218', 'Sirdaryo viloyati, Sardoba tumani, O''zbekiston ko''chasi, 224-uy.', '998946098480', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(80, '5593', 'Saodat', 'Alimova', '1992-08-13', 'Saodat-1@mail.ru', 'BQ4156646', 'Sirdaryo viloyati, Sirdaryo shahri, O''zbekiston ko''chasi, 192-uy.', '998934542266', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(81, '6385', 'Davron', 'Hasanov', '1992-06-24', 'Davron-9@mail.ru', 'TR4322814', 'Sirdaryo viloyati, Sayxunobod tumani, Abdulla Avloniy ko''chasi, 242-uy.', '998939828063', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(82, '8188', 'Lobar', 'Alimova', '1993-08-02', 'Lobar-1@mail.ru', 'NF6840057', 'Buxoro viloyati, Kogon tumani, Mustaqillik ko''chasi, 266-uy.', '998942795166', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(83, '2203', 'Kamola', 'Hasanova', '1991-12-21', 'Kamola-8@mail.ru', 'RR3288177', 'Buxoro viloyati, G''ijduvon tumani, Bunyodkor ko''chasi, 108-uy.', '998915369812', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(84, '1735', 'Abdulla', 'Djo''rayev', '1991-05-09', 'Abdulla-2@mail.ru', 'QZ5231933', 'Toshkent shahri, Sirg''ali tumani, O''zbekiston ko''chasi, 202-uy.', '998997840087', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(85, '9357', 'Kamol', 'Saidov', '1998-05-29', 'Kamol-7@mail.ru', 'KA2774291', 'Toshkent shahri, Mirzo Ulug''bek tumani, Amir Temur ko''chasi, 68-uy.', '998912075286', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(86, '7275', 'Shaxnoza', 'Mansurova', '1992-12-13', 'Shaxnoza-1@mail.ru', 'PT9374877', 'Buxoro viloyati, Kogon tumani, Navoi ko''chasi, 224-uy.', '998991963500', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(87, '8564', 'Sarvar', 'Hasanov', '1990-10-21', 'Sarvar-5@mail.ru', 'YW4368133', 'Sirdaryo viloyati, Sayxunobod tumani, Bunyodkor ko''chasi, 121-uy.', '998974901794', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(88, '3403', 'Kamol', 'Latipov', '1992-12-04', 'Kamol-8@mail.ru', 'SQ7721710', 'Toshkent shahri, Olmazor tumani, Abdulla Avloniy ko''chasi, 54-uy.', '998907064178', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(89, '4520', 'Jalol', 'Raximov', '1993-08-07', 'Jalol-4@mail.ru', 'VZ6248992', 'Andijon viloyati, Marhamat tumani, Abdulla Avloniy ko''chasi, 220-uy.', '998938471527', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(90, '8467', 'Vali', 'Djo''rayev', '1991-03-08', 'Vali-4@mail.ru', 'SN6580230', 'Buxoro viloyati, G''ijduvon tumani, Bunyodkor ko''chasi, 284-uy.', '998931305694', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(91, '9113', 'Toxir', 'Mansurov', '1998-10-31', 'Toxir-6@mail.ru', 'MD4446136', 'Toshkent shahri, Chilonzor tumani, Bunyodkor ko''chasi, 20-uy.', '998937354217', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(92, '3789', 'Mamlakat', 'Latipova', '1998-11-24', 'Mamlakat-8@mail.ru', 'HY8320465', 'Toshkent shahri, Shayxontohur tumani, Bunyodkor ko''chasi, 29-uy.', '998938389678', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(93, '1304', 'Abdulla', 'Yo''ldoshev', '1992-10-31', 'Abdulla-5@mail.ru', 'WG6114685', 'Toshkent shahri, Shayxontohur tumani, Amir Temur ko''chasi, 191-uy.', '998904967163', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(94, '9782', 'Sarvar', 'Hasanov', '1996-07-11', 'Sarvar-8@mail.ru', 'UE6878509', 'Toshkent shahri, Yunusobod tumani, Amir Temur ko''chasi, 4-uy.', '998903184356', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(95, '3199', 'Vali', 'Djo''rayev', '1990-05-12', 'Vali-9@mail.ru', 'EG9895355', 'Andijon viloyati, Asaka tumani, Amir Temur ko''chasi, 228-uy.', '998954301666', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(96, '4491', 'Vali', 'Zokirov', '1995-05-03', 'Vali-8@mail.ru', 'NI5146240', 'Andijon viloyati, Andijon shahri, Mustaqillik ko''chasi, 19-uy.', '998948034820', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(97, '1358', 'Kamol', 'Zokirov', '1991-08-07', 'Kamol-6@mail.ru', 'NV2161254', 'Toshkent shahri, Shayxontohur tumani, Mustaqillik ko''chasi, 82-uy.', '998951627868', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(98, '6545', 'Malika', 'Zokirova', '1992-11-27', 'Malika-5@mail.ru', 'BG3307128', 'Toshkent shahri, Shayxontohur tumani, O''zbekiston ko''chasi, 83-uy.', '998904080017', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(99, '6005', 'Shaxnoza', 'Zokirova', '1992-03-24', 'Shaxnoza-4@mail.ru', 'ZB4927612', 'Andijon viloyati, Asaka tumani, O''zbekiston ko''chasi, 127-uy.', '998907168273', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(100, '7792', 'Abdulla', 'Raximov', '1990-11-11', 'Abdulla-7@mail.ru', 'DE4765289', 'Toshkent shahri, Olmazor tumani, Pushkin ko''chasi, 264-uy.', '998933076690', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(101, '2967', 'Maftuna', 'Raximova', '1993-09-13', 'Maftuna-2@mail.ru', 'QI4946838', 'Sirdaryo viloyati, Baxt shahri, Mustaqillik ko''chasi, 295-uy.', '998916618682', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(102, '2345', 'Kamol', 'Saidov', '1996-03-29', 'Kamol-1@mail.ru', 'ND5040496', 'Toshkent shahri, Olmazor tumani, Bunyodkor ko''chasi, 199-uy.', '998997780487', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(103, '7377', 'Shaxnoza', 'Alimova', '1994-06-16', 'Shaxnoza-4@mail.ru', 'OP6757385', 'Sirdaryo viloyati, Guliston shahri, Amir Temur ko''chasi, 258-uy.', '998933965759', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(104, '7265', 'Toxir', 'Alimov', '1994-09-26', 'Toxir-1@mail.ru', 'ZQ7584106', 'Buxoro viloyati, Kogon tumani, Navoi ko''chasi, 179-uy.', '998903725158', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(105, '1231', 'Akbar', 'Alimov', '1994-04-23', 'Akbar-6@mail.ru', 'IK9832733', 'Sirdaryo viloyati, Sayxunobod tumani, Navoi ko''chasi, 64-uy.', '998991111785', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(106, '5721', 'Maftuna', 'Alimova', '1994-06-22', 'Maftuna-4@mail.ru', 'TQ2245849', 'Toshkent shahri, Yunusobod tumani, Bunyodkor ko''chasi, 89-uy.', '998916552215', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(107, '3881', 'Kamol', 'Djo''rayev', '1997-10-01', 'Kamol-7@mail.ru', 'XO3582061', 'Buxoro viloyati, Romitan tumani, Pushkin ko''chasi, 73-uy.', '998972518310', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(108, '8974', 'Maftuna', 'Djo''rayeva', '1994-06-08', 'Maftuna-4@mail.ru', 'KH6263275', 'Sirdaryo viloyati, Sayxunobod tumani, Amir Temur ko''chasi, 262-uy.', '998918362487', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(109, '3305', 'Kamola', 'Djo''rayeva', '1991-12-12', 'Kamola-8@mail.ru', 'RQ5555480', 'Sirdaryo viloyati, Sardoba tumani, Navoi ko''chasi, 43-uy.', '998947123504', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(110, '9058', 'Kamola', 'Djo''rayeva', '1998-03-15', 'Kamola-2@mail.ru', 'TY8066131', 'Andijon viloyati, Baliqchi shahri, Abdulla Avloniy ko''chasi, 284-uy.', '998971454284', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(111, '7286', 'Saodat', 'Alimova', '1991-01-05', 'Saodat-6@mail.ru', 'IO7928527', 'Toshkent shahri, Olmazor tumani, Bunyodkor ko''chasi, 124-uy.', '998914054473', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(112, '5384', 'Davron', 'Alimov', '1997-10-16', 'Davron-10@mail.ru', 'LM9723693', 'Buxoro viloyati, Buxoro shahri, Pushkin ko''chasi, 33-uy.', '998936018005', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(113, '3800', 'Abdulla', 'Hasanov', '1993-05-31', 'Abdulla-9@mail.ru', 'ND7029296', 'Buxoro viloyati, Kogon tumani, O''zbekiston ko''chasi, 289-uy.', '998941401275', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(114, '4300', 'Vali', 'Saidov', '1993-09-01', 'Vali-3@mail.ru', 'VM6202850', 'Sirdaryo viloyati, Sayxunobod tumani, Abdulla Avloniy ko''chasi, 256-uy.', '998948925537', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(115, '9430', 'Abdulla', 'Hasanov', '1991-09-24', 'Abdulla-4@mail.ru', 'XC3597442', 'Buxoro viloyati, Kogon tumani, Navoi ko''chasi, 239-uy.', '998944120666', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(116, '4123', 'Kamola', 'Saidova', '1992-03-07', 'Kamola-9@mail.ru', 'LD8081512', 'Buxoro viloyati, G''ijduvon tumani, Navoi ko''chasi, 128-uy.', '998942023925', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(117, '7454', 'Malika', 'Saidova', '1997-03-21', 'Malika-7@mail.ru', 'CL6047668', 'Toshkent shahri, Yunusobod tumani, O''zbekiston ko''chasi, 96-uy.', '998915618927', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(118, '2015', 'Jalol', 'Hasanov', '1990-06-14', 'Jalol-5@mail.ru', 'OS6422851', 'Toshkent shahri, Mirobod tumani, Navoi ko''chasi, 11-uy.', '998949408111', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(119, '9648', 'Lobar', 'Djo''rayeva', '1990-07-13', 'Lobar-4@mail.ru', 'ZQ4626586', 'Andijon viloyati, Marhamat tumani, Mustaqillik ko''chasi, 98-uy.', '998952370544', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(120, '4422', 'Kamola', 'Djo''rayeva', '1990-06-01', 'Kamola-5@mail.ru', 'YS6445922', 'Toshkent shahri, Sirg''ali tumani, O''zbekiston ko''chasi, 8-uy.', '998903465881', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(121, '7185', 'Aziza', 'Saidova', '1996-05-03', 'Aziza-10@mail.ru', 'UR7732696', 'Andijon viloyati, Asaka tumani, Pushkin ko''chasi, 193-uy.', '998934866363', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(122, '7158', 'Toxir', 'Saidov', '1995-10-24', 'Toxir-9@mail.ru', 'MG2209594', 'Sirdaryo viloyati, Sirdaryo shahri, Amir Temur ko''chasi, 187-uy.', '998931887695', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(123, '4485', 'Kamol', 'Qodirov', '1997-12-26', 'Kamol-1@mail.ru', 'VQ1028564', 'Andijon viloyati, Andijon shahri, Amir Temur ko''chasi, 208-uy.', '998906705749', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(124, '7289', 'Toxir', 'Saidov', '1994-11-16', 'Toxir-6@mail.ru', 'TE7344055', 'Sirdaryo viloyati, Guliston shahri, Navoi ko''chasi, 125-uy.', '998937751647', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(125, '8443', 'Alijon', 'Qodirov', '1997-10-04', 'Alijon-7@mail.ru', 'QL5826293', 'Toshkent shahri, Mirzo Ulug''bek tumani, Pushkin ko''chasi, 254-uy.', '998942268096', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(126, '3167', 'Jalol', 'Yo''ldoshev', '1993-03-04', 'Jalol-8@mail.ru', 'FW8497619', 'Toshkent shahri, Sirg''ali tumani, Navoi ko''chasi, 206-uy.', '998932049743', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(127, '1968', 'Jalol', 'Qodirov', '1998-08-13', 'Jalol-1@mail.ru', 'TS2488098', 'Andijon viloyati, Andijon shahri, Bunyodkor ko''chasi, 263-uy.', '998919336700', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(128, '3708', 'Sitora', 'Mansurova', '1990-10-20', 'Sitora-5@mail.ru', 'IS7129547', 'Buxoro viloyati, Kogon tumani, Pushkin ko''chasi, 217-uy.', '998908449554', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(129, '8144', 'Vali', 'Zokirov', '1990-01-02', 'Vali-9@mail.ru', 'KW2950073', 'Sirdaryo viloyati, Guliston shahri, Abdulla Avloniy ko''chasi, 253-uy.', '998916891693', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(130, '1823', 'Abdulla', 'Yo''ldoshev', '1995-05-11', 'Abdulla-8@mail.ru', 'VG6873291', 'Sirdaryo viloyati, Baxt shahri, Abdulla Avloniy ko''chasi, 110-uy.', '998933264282', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(131, '3571', 'Vali', 'Yo''ldoshev', '1995-02-08', 'Vali-4@mail.ru', 'DP4938323', 'Buxoro viloyati, Buxoro shahri, Pushkin ko''chasi, 213-uy.', '998979158996', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(132, '6646', 'Abdulla', 'Zokirov', '1990-11-07', 'Abdulla-10@mail.ru', 'TN5208587', 'Toshkent shahri, Mirobod tumani, Bunyodkor ko''chasi, 150-uy.', '998996296234', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(133, '4116', 'Kamola', 'Raximova', '1996-06-26', 'Kamola-8@mail.ru', 'HJ4657348', 'Sirdaryo viloyati, Baxt shahri, O''zbekiston ko''chasi, 163-uy.', '998906915588', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(134, '8957', 'Toxir', 'Saidov', '1992-12-17', 'Toxir-1@mail.ru', 'MK7624755', 'Buxoro viloyati, Romitan tumani, Amir Temur ko''chasi, 188-uy.', '998995240722', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(135, '7801', 'Toxir', 'Zokirov', '1997-03-03', 'Toxir-3@mail.ru', 'FV1434509', 'Sirdaryo viloyati, Baxt shahri, Navoi ko''chasi, 266-uy.', '998994165710', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(136, '4803', 'Jalol', 'Raximov', '1991-01-30', 'Jalol-8@mail.ru', 'ME2802856', 'Toshkent shahri, Shayxontohur tumani, Pushkin ko''chasi, 42-uy.', '998999524291', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(137, '3399', 'Saodat', 'Hasanova', '1995-03-20', 'Saodat-3@mail.ru', 'KC5880401', 'Andijon viloyati, Baliqchi shahri, Abdulla Avloniy ko''chasi, 133-uy.', '998956531341', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(138, '1296', 'Mamlakat', 'Yo''ldosheva', '1991-05-17', 'Mamlakat-6@mail.ru', 'QO3112396', 'Toshkent shahri, Mirzo Ulug''bek tumani, Navoi ko''chasi, 159-uy.', '998919553405', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(139, '7257', 'Nigora', 'Saidova', '1994-07-25', 'Nigora-7@mail.ru', 'PZ7847229', 'Andijon viloyati, Andijon shahri, O''zbekiston ko''chasi, 163-uy.', '998909696777', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(140, '6099', 'Jalol', 'Yo''ldoshev', '1995-02-14', 'Jalol-8@mail.ru', 'EW5580200', 'Toshkent shahri, Mirzo Ulug''bek tumani, Navoi ko''chasi, 293-uy.', '998976954315', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(141, '9138', 'Akbar', 'Mansurov', '1991-01-29', 'Akbar-5@mail.ru', 'IA2876739', 'Buxoro viloyati, Romitan tumani, Mustaqillik ko''chasi, 30-uy.', '998911212036', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(142, '4105', 'Maftuna', 'Alimova', '1998-04-22', 'Maftuna-5@mail.ru', 'XA7923034', 'Buxoro viloyati, Buxoro shahri, Pushkin ko''chasi, 236-uy.', '998909218872', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(143, '3285', 'Davron', 'Alimov', '1996-03-23', 'Davron-8@mail.ru', 'RL5631561', 'Buxoro viloyati, G''ijduvon tumani, Bunyodkor ko''chasi, 219-uy.', '998941076904', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(144, '7806', 'Kamol', 'Mansurov', '1993-07-22', 'Kamol-8@mail.ru', 'WA9181243', 'Buxoro viloyati, Buxoro shahri, Amir Temur ko''chasi, 95-uy.', '998915514831', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(145, '2811', 'Saodat', 'Saidova', '1991-09-04', 'Saodat-5@mail.ru', 'ZI3126403', 'Sirdaryo viloyati, Sirdaryo shahri, Abdulla Avloniy ko''chasi, 58-uy.', '998937770324', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(146, '2330', 'Davron', 'Qodirov', '1997-04-26', 'Davron-9@mail.ru', 'NC8665985', 'Sirdaryo viloyati, Sirdaryo shahri, Abdulla Avloniy ko''chasi, 25-uy.', '998917877990', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(147, '7606', 'Kamola', 'Zokirova', '1996-08-24', 'Kamola-7@mail.ru', 'VH3530700', 'Buxoro viloyati, Kogon tumani, Bunyodkor ko''chasi, 240-uy.', '998942861907', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(148, '6755', 'Mamlakat', 'Saidova', '1994-01-20', 'Mamlakat-2@mail.ru', 'XD1659179', 'Buxoro viloyati, G''ijduvon tumani, Navoi ko''chasi, 219-uy.', '998993564208', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(149, '1093', 'Saodat', 'Yo''ldosheva', '1995-03-25', 'Saodat-9@mail.ru', 'HH9209808', 'Buxoro viloyati, G''ijduvon tumani, Navoi ko''chasi, 269-uy.', '998945599975', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57'),
(150, '4240', 'Jalol', 'Latipov', '1995-11-15', 'Jalol-9@mail.ru', 'SQ8919219', 'Andijon viloyati, Baliqchi shahri, Pushkin ko''chasi, 160-uy.', '998939287261', NULL, '2018-02-07 22:12:57', '2018-02-07 22:12:57');

-- --------------------------------------------------------

--
-- Структура таблицы `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `subject`
--

INSERT INTO `subject` (`id`, `name`) VALUES
(1, 'Matematika'),
(2, 'Fizika'),
(3, 'Ona tili'),
(4, 'Adabiyot'),
(5, 'Tarix'),
(6, 'Kimyo'),
(7, 'Biologiya'),
(8, 'Ingliz tili');

-- --------------------------------------------------------

--
-- Структура таблицы `sub_subject`
--

CREATE TABLE IF NOT EXISTS `sub_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `sub_subject`
--

INSERT INTO `sub_subject` (`id`, `subject_id`, `name`) VALUES
(1, 1, 'Boshlang''ich matematika'),
(2, 1, 'Elementar matematika'),
(3, 1, 'Oliy matematika'),
(4, 2, 'Fizika 1'),
(5, 2, 'Fizika 2'),
(6, 3, 'Ona tili 1'),
(7, 3, 'Ona tili 2'),
(8, 4, 'Adabiyot 1'),
(9, 4, 'Adabiyot 2'),
(10, 5, 'Tarix 1'),
(11, 5, 'Tarix 2'),
(12, 6, 'Kimyo 1'),
(13, 6, 'Kimyo 2'),
(14, 7, 'Biologiya 1'),
(15, 7, 'Biologiya 2'),
(16, 8, 'Beginner'),
(17, 8, 'Elemntary'),
(18, 8, 'IELETS');

-- --------------------------------------------------------

--
-- Структура таблицы `times`
--

CREATE TABLE IF NOT EXISTS `times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `weekday` tinyint(3) unsigned NOT NULL,
  `time` tinyint(3) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
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
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Ограничения внешнего ключа таблицы `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`sub_subject_id`) REFERENCES `sub_subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Ограничения внешнего ключа таблицы `sub_subject`
--
ALTER TABLE `sub_subject`
  ADD CONSTRAINT `sub_subject_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
