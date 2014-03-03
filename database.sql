-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 03 2014 г., 13:35
-- Версия сервера: 5.6.16
-- Версия PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `smd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `title`) VALUES
(37, 'Store Owner'),
(38, 'Store Owner (Full Time)'),
(39, 'Industry Professional'),
(40, 'Service Provider');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `city` tinytext,
  `country` tinytext,
  `location` tinytext,
  `forum_credentials` int(5) DEFAULT NULL,
  `online` int(1) DEFAULT '0',
  `area_experience` tinytext NOT NULL,
  `platform_knowledge` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `city`, `country`, `location`, `forum_credentials`, `online`, `area_experience`, `platform_knowledge`) VALUES
(14, 'AndrewYouderian', 'Bozeman', 'United States', 'Bozeman, MT', 110, 0, '<p><b>Drop Shipping</b></p><p>SEO, Blogging &amp; Content Marketing</p>', 'Magento, Zendesk, eCommHub, Rackspace, RingCentral'),
(150, 'JeremyWallace', NULL, NULL, 'Vancouver', 1, 1, '', ''),
(151, 'kelvinsnijman', NULL, NULL, NULL, NULL, 0, '', ''),
(152, 'AdamHodara', NULL, NULL, 'Costa Rica', 1, 0, '', ''),
(153, 'GauravKohli', NULL, NULL, 'Mumbai, India', 1, 0, '', ''),
(154, 'TristanKing', NULL, NULL, 'Melbourne, Australia', NULL, 0, '', ''),
(155, 'JonTucker', NULL, NULL, 'San Diego, CA', NULL, 0, '', ''),
(156, 'GrantMerriel', NULL, NULL, 'Cebu, Philippines', NULL, 0, '', ''),
(157, 'BradKopitz', NULL, NULL, 'Denver, CO', 2, 0, '', ''),
(158, 'BrandonRodak', NULL, NULL, '', 1, 0, '', ''),
(159, 'ChrisFotiou', NULL, NULL, 'Australia', 1, 0, '', ''),
(160, 'SeanWoodruff', NULL, NULL, 'Michigan', NULL, 0, '', ''),
(161, 'MattClark', NULL, NULL, NULL, NULL, 0, '', ''),
(162, 'sheraltorrecampo', NULL, NULL, NULL, 110, 0, '', ''),
(163, 'AndrewBleakley', NULL, NULL, 'Lennox Head, Australia', NULL, 0, '', ''),
(164, 'SanjayChannagiri', NULL, NULL, '', NULL, 0, '', ''),
(165, 'NadiaPaone', NULL, NULL, '', NULL, 0, '', ''),
(166, 'KavenAyotte', NULL, NULL, 'Canada', 1, 0, '', ''),
(167, 'LarsHundley', NULL, NULL, 'Dallas, TX', 4, 0, '', ''),
(169, 'TaylorFife', NULL, NULL, 'Asheville, NC', 1, 0, '', ''),
(170, 'RichardLazazzera', NULL, NULL, '', NULL, 0, '', ''),
(171, 'ClayClark', NULL, NULL, 'Austin, TX', NULL, 0, '', ''),
(172, 'Valentin Van Nhut', NULL, NULL, NULL, NULL, 0, '', ''),
(175, 'kamaltaylor', NULL, NULL, NULL, NULL, 0, '', ''),
(176, 'DarylMander', NULL, NULL, 'Malaysia', NULL, 0, '', ''),
(178, 'MichaelGeale', NULL, NULL, 'Gold Coast, QLD, Australia', 1, 0, '', ''),
(179, 'ChrisBricker', NULL, NULL, 'Cleveland, OH', NULL, 0, '', ''),
(180, 'MiracleWanzo', 'San Francisco', 'California', 'San Francisco Bay Area', 4, 0, '', ''),
(181, 'ChrisYouderian', NULL, NULL, 'Cincinnati, Ohio', 1, 0, '', ''),
(182, 'DavidScott', NULL, NULL, 'Russellville Kentucky', 2, 0, '', ''),
(183, 'GiancarloMassaro', NULL, NULL, 'New Haven, Connecticut, USA', 2, 0, '', ''),
(184, 'KatarzynaSubieta', NULL, NULL, 'Chicago, IL', NULL, 0, '', ''),
(185, 'RichardClaydon', NULL, NULL, 'Minneapolis, MN USA', NULL, 0, '', ''),
(187, 'EdHallen', NULL, NULL, 'Boston, MA USA', NULL, 0, '', ''),
(188, 'Vikas Patel', NULL, NULL, NULL, NULL, 0, '', ''),
(189, 'JeffRaymon', NULL, NULL, 'Saint Louis, Missouri USA', 1, 0, '', ''),
(190, 'RyanAtkins', NULL, NULL, 'York, UK', NULL, 0, '', ''),
(191, 'MichaelCai', NULL, NULL, 'Toronto, Ontario', 1, 0, '', ''),
(193, 'JulianPatrick', NULL, NULL, 'North Wales, UK', 1, 0, '', ''),
(194, 'PeterDawson', NULL, NULL, 'Sydney, Australia', NULL, 0, '', ''),
(195, 'DyShaunMuhammad', NULL, NULL, 'Greater Minneapolis, St. Paul Area           ', NULL, 0, '', ''),
(196, 'DaveStickland', NULL, NULL, 'Seattle, WA', NULL, 0, '', ''),
(197, 'JoelCarr', NULL, NULL, 'Bangkok', 2, 0, '', ''),
(198, 'AndySkipper', NULL, NULL, 'London, UK', 1, 0, '', ''),
(199, 'AmyFurrow', NULL, NULL, 'Indianapolis, Indiana', 1, 0, '', ''),
(200, 'PeepLaja', NULL, NULL, 'Austin, Texas', 1, 0, '', ''),
(201, 'JamesGurd', NULL, NULL, '', NULL, 0, '', ''),
(202, 'DavidRosenberg', NULL, NULL, 'MEMBER HAS LEFT THE COMMUNITY - Boulder, CO', NULL, 0, '', ''),
(203, 'Naeem Mahmood', NULL, NULL, '', NULL, 0, '', ''),
(204, 'APIUser', NULL, NULL, '', 110, 0, '', ''),
(205, 'GonzaloSarmiento', NULL, NULL, 'Cordoba, Argentina', 2, 0, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`) VALUES
(1, 200, 35),
(2, 201, 35),
(3, 202, 36),
(4, 203, 35),
(5, 204, 16),
(6, 204, 35),
(7, 205, 35),
(8, 14, 16),
(9, 14, 35),
(10, 14, 37);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
