####################
# ADMIN MySQL-Dump
# version 2.64
#  (download page)
#
# Host: localhost
# Generation Time: February 16, 2010 at 14:29
# Server version: 5.1.30-community
# PHP Version: 5.2.8
# Database : `alternative`
#####################


##########
# Table structure for table `acl`
#
# Creation: February 12, 2010 at 11:38
# Last update: February 12, 2010 at 17:05
##########

DROP TABLE IF EXISTS `acl`;;

CREATE TABLE `acl` (
  `group` varchar(64) NOT NULL,
  `resource` varchar(64) NOT NULL,
  `action` varchar(64) NOT NULL,
  `ad` datetime NOT NULL,
  `up` datetime NOT NULL,
  PRIMARY KEY (`group`,`resource`,`action`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 COMMENT='Доступ к ресурсам';;

##########
# Dumping data for table `acl`
##########

INSERT INTO `acl` VALUES ('guest', 'main', '', '2008-04-16 10:00:48', '2008-09-20 23:31:56');;
INSERT INTO `acl` VALUES ('guest', 'news', '', '2008-08-19 16:04:45', '2008-08-19 16:04:59');;
INSERT INTO `acl` VALUES ('guest', 'sitemap', '', '2008-08-18 18:56:28', '2008-08-18 18:56:28');;
INSERT INTO `acl` VALUES ('guest', 'auth', '', '2008-04-20 20:16:16', '2008-04-20 20:16:16');;
INSERT INTO `acl` VALUES ('guest', 'articles', '', '2008-08-20 11:14:38', '2008-08-20 11:14:38');;
INSERT INTO `acl` VALUES ('guest', 'bio', '', '2008-08-20 12:30:41', '2008-08-20 12:30:41');;
INSERT INTO `acl` VALUES ('guest', 'video', '', '2008-08-22 11:51:17', '2008-08-22 11:51:17');;
INSERT INTO `acl` VALUES ('guest', 'gallery', '', '2008-08-22 12:30:31', '2008-08-22 12:30:31');;
INSERT INTO `acl` VALUES ('guest', 'rss', '', '2008-08-27 15:53:56', '2008-08-27 15:53:56');;
INSERT INTO `acl` VALUES ('guest', 'tournament', '', '2008-09-04 14:56:22', '2008-09-04 14:56:22');;
INSERT INTO `acl` VALUES ('guest', 'press', '', '2008-10-06 23:04:02', '2008-10-06 23:04:02');;
INSERT INTO `acl` VALUES ('guest', 'vacancies', '', '2008-10-11 22:37:45', '2008-10-11 22:37:45');;
INSERT INTO `acl` VALUES ('guest', 'contacts', '', '2008-10-12 21:39:14', '2008-10-12 21:39:14');;
INSERT INTO `acl` VALUES ('guest', 'base', '', '2008-10-24 23:46:55', '2008-10-24 23:46:55');;
INSERT INTO `acl` VALUES ('guest', 'faq', '', '2008-10-25 20:27:06', '2008-10-25 20:27:06');;
INSERT INTO `acl` VALUES ('guest', 'portfolio', '', '2009-02-12 13:23:17', '2009-02-12 13:23:27');;
INSERT INTO `acl` VALUES ('guest', 'mapsites', '', '2010-02-12 16:37:38', '2010-02-12 16:37:38');;


##########
# Table structure for table `ci_sessions`
#
# Creation: February 12, 2010 at 11:38
# Last update: February 15, 2010 at 17:04
##########

DROP TABLE IF EXISTS `ci_sessions`;;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `session_data` text,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;;

##########
# Dumping data for table `ci_sessions`
##########

INSERT INTO `ci_sessions` VALUES ('02fad2d88f2e7330ee631965368b85ef', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.', '1266241708', 'a:2:{s:3:"log";s:19:"2010-02-15 12:38:34";s:7:"captcha";s:4:"5973";}');;


##########
# Table structure for table `config`
#
# Creation: February 12, 2010 at 11:38
# Last update: February 15, 2010 at 15:34
##########

DROP TABLE IF EXISTS `config`;;

CREATE TABLE `config` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `descr` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=cp1251 COMMENT='Конфигурация';;

##########
# Dumping data for table `config`
##########

INSERT INTO `config` VALUES ('1', 'mail', 'sachukanton@gmail.com', 'E-mail отсылки письма');;
INSERT INTO `config` VALUES ('2', 'title', 'Компания по разработке сайтов ALTERNATIVE', 'Заголовок сайта');;
INSERT INTO `config` VALUES ('3', 'keywords', 'Компания по разработке сайтов ALTERNATIVE в  Днепропетровске и Украине, лидерство, хорошие, создание сайтов, продвижение сайтов, разработка сайтов, раскрутка сайтов, оптимизация сайтов, У нас можно заказать сайт и его продвижение. Профессиональная разработка веб сайта, изготовление и создание корпоративных сайтов и порталов, создание web сайта, Профессиональная студия веб-дизайна ALTERNATIVE, Создание сайтов с нуля. Разработка сайтов корпоративный сайт, Фирменный стиль, продвижение, реклама, дизайн студии Днепропетровска, разработка сайтов Днепропетровск, Альтернатива, ALTERNATIVE, Company to develop sites ALTERNATIVE in Dnipropetrovsk and Ukraine, leadership, good, site development, promotion of sites, site development, promotion of web sites, optimization of sites, You can order a site and its promotion.', 'Keywords, на всех странницах сайта... ');;
INSERT INTO `config` VALUES ('4', 'description', 'Компания по разработке сайтов ALTERNATIVE в  Днепропетровске и Украине, лидерство, хорошие, создание сайтов, продвижение сайтов, разработка сайтов, раскрутка сайтов, оптимизация сайтов, У нас можно заказать сайт и его продвижение. Профессиональная разработка веб сайта, изготовление и создание корпоративных сайтов и порталов, создание web сайта, Профессиональная студия веб-дизайна ALTERNATIVE, Создание сайтов с нуля. Разработка сайтов корпоративный сайт, Фирменный стиль, продвижение, реклама, дизайн студии Днепропетровска, разработка сайтов Днепропетровск, Альтернатива, ALTERNATIVE, Company to develop sites ALTERNATIVE in Dnipropetrovsk and Ukraine, leadership, good, site development, promotion of sites, site development, promotion of web sites, optimization of sites, You can order a site and its promotion.', 'дескрипшен');;
INSERT INTO `config` VALUES ('5', 'copy', '2009 &copy; &laquo;ALTERNATIVE&raquo;<br/>Все права защищены', 'Копирайт');;
INSERT INTO `config` VALUES ('6', 'slogan', 'Мы поможем Вам стать известными на весь мир', 'Слоган компании');;
INSERT INTO `config` VALUES ('7', 'news_lenta', '5', 'Количество новостей на странице Новости');;
INSERT INTO `config` VALUES ('8', 'press', '5', 'Количество єлементов в прессе');;
INSERT INTO `config` VALUES ('9', 'tvacancies', 'Хотите работать в компании «ALTERNATIVE», но не нашли на этой странице подходящих вакансий?<br>Все равно пришлите нам краткую информацию о себе — когда у нас появятся вакансии, соответствующие Вашим стремлениям, мы с Вами свяжемся.', 'Этот текст выводится на страннице Вакансии...');;
INSERT INTO `config` VALUES ('11', 'news_lenta', '5', 'Количество новостей');;
INSERT INTO `config` VALUES ('12', 'kolblockpress', '5', 'Количество в перечне статей. Место нахождения - Блок.  ');;
INSERT INTO `config` VALUES ('13', 'portfolio_lenta', '5', 'Количество элементов на странице портфолио');;
INSERT INTO `config` VALUES ('14', 'contacts', '<p><h3>По всем вопросам обращайтесь к нам по:<br /><br /><strong>тел.:</strong> 8-063-702-19-22<br /><br /> <strong>e-mail:</strong> <a href="/contacts">info@alternatives.com.ua</a></h3></p>', '');;


##########
# Table structure for table `groups`
#
# Creation: February 12, 2010 at 11:38
# Last update: February 12, 2010 at 11:38
##########

DROP TABLE IF EXISTS `groups`;;

CREATE TABLE `groups` (
  `id` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `ad` datetime NOT NULL,
  `up` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 COMMENT='Группы';;

##########
# Dumping data for table `groups`
##########

INSERT INTO `groups` VALUES ('guest', 'Гость', '2008-04-12 09:59:57', '2008-04-12 09:59:57');;
INSERT INTO `groups` VALUES ('member', 'Зарегистрированый пользователь', '2008-04-12 10:00:20', '2008-04-12 10:00:20');;
INSERT INTO `groups` VALUES ('admin', 'Администратор', '2008-04-12 10:00:49', '2008-04-12 10:00:49');;


##########
# Table structure for table `map`
#
# Creation: February 12, 2010 at 11:38
# Last update: February 12, 2010 at 17:05
##########

DROP TABLE IF EXISTS `map`;;

CREATE TABLE `map` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `upId` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(64) NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `resource` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `sitemap` enum('y','n') NOT NULL DEFAULT 'y',
  `visible` enum('y','n') NOT NULL,
  `menu1` enum('n','y') NOT NULL,
  `msort1` mediumint(4) NOT NULL,
  `sort` smallint(5) unsigned NOT NULL,
  `ad` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dl` enum('n','y') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=cp1251 COMMENT='Карта сайта';;

##########
# Dumping data for table `map`
##########

INSERT INTO `map` VALUES ('1', '0', 'Домашняя страница', '', '', '', 'home', 'y', 'y', 'n', '0', '0', '2008-09-18 00:30:56', '2010-02-12 16:40:34', 'n');;
INSERT INTO `map` VALUES ('2', '1', 'Главная', '', '', 'main', '/', 'y', 'n', 'n', '0', '10', '2008-09-18 00:33:15', '2009-02-17 11:24:53', 'n');;
INSERT INTO `map` VALUES ('3', '1', 'О нас', '', '', 'main', 'company', 'y', 'y', 'n', '0', '10', '2008-09-18 12:56:44', '2009-02-17 00:05:47', 'n');;
INSERT INTO `map` VALUES ('4', '1', 'Услуги', '', '', 'main', 'services', 'y', 'y', 'n', '0', '20', '2008-09-18 12:57:47', '2009-01-17 23:06:09', 'n');;
INSERT INTO `map` VALUES ('8', '1', 'Контакты', '', '', 'contacts', 'contacts', 'y', 'y', 'n', '0', '100', '2008-09-18 13:00:50', '2008-10-24 23:53:58', 'n');;
INSERT INTO `map` VALUES ('16', '1', 'Опросы', '', '', 'main', 'opros', 'n', 'y', 'n', '0', '80', '2008-09-18 13:10:13', '2009-01-17 22:29:46', 'n');;
INSERT INTO `map` VALUES ('22', '1', 'Новости', '', '', 'news', 'news', 'y', 'y', 'n', '40', '30', '2008-09-18 13:22:38', '2009-01-17 23:06:19', 'n');;
INSERT INTO `map` VALUES ('24', '1', 'Статьи', '', '', 'news', 'press', 'y', 'y', 'n', '0', '40', '2008-09-18 13:24:29', '2009-07-03 14:17:29', 'n');;
INSERT INTO `map` VALUES ('25', '1', 'Мультимедиа', '', '', 'gallery', 'multimediya', 'n', 'y', 'n', '0', '40', '2008-09-18 13:24:56', '2009-01-17 22:52:02', 'n');;
INSERT INTO `map` VALUES ('27', '1', 'Вакансии', '', '', 'vacancies', 'vacancies', 'n', 'y', 'n', '0', '20', '2008-09-18 13:26:12', '2009-01-17 22:56:27', 'n');;
INSERT INTO `map` VALUES ('30', '8', 'captcha', '', '', 'contacts', 'captcha', 'y', 'n', 'n', '0', '0', '2008-10-11 00:33:32', '2009-02-09 15:12:51', 'n');;
INSERT INTO `map` VALUES ('31', '1', 'Портфолио', '', '', 'portfolio', 'portfolio', 'y', 'y', 'n', '0', '70', '2009-02-12 13:22:37', '2009-02-12 13:22:37', 'n');;
INSERT INTO `map` VALUES ('32', '1', 'Авторизация', '', '', 'auth', 'auth', 'y', 'n', 'n', '0', '0', '2009-03-04 13:57:30', '2009-03-04 13:57:30', 'n');;
INSERT INTO `map` VALUES ('33', '32', 'Регистрация', '', '', 'auth', 'register', 'y', 'n', 'n', '0', '0', '2009-03-04 14:00:54', '2009-03-04 14:00:54', 'n');;
INSERT INTO `map` VALUES ('34', '32', 'Активация', '', '', 'auth', 'activation', 'y', 'n', 'n', '0', '0', '2009-03-05 14:30:20', '2009-03-05 14:30:20', 'n');;
INSERT INTO `map` VALUES ('35', '32', 'Войти', '', '', 'auth', 'login', 'y', 'n', 'n', '0', '0', '2009-03-06 13:37:35', '2009-03-06 13:37:35', 'n');;
INSERT INTO `map` VALUES ('36', '1', '', '', '', 'main', 'main', 'y', 'n', 'n', '0', '0', '2009-09-21 15:03:51', '2009-09-21 15:03:51', 'n');;
INSERT INTO `map` VALUES ('37', '1', 'Карта сайта', '', '', 'mapsites', 'map', 'y', 'y', 'n', '0', '101', '2010-02-12 16:31:49', '2010-02-12 17:01:59', 'n');;


##########
# Table structure for table `user_groups`
#
# Creation: February 12, 2010 at 11:38
# Last update: February 12, 2010 at 11:38
##########

DROP TABLE IF EXISTS `user_groups`;;

CREATE TABLE `user_groups` (
  `login` varchar(64) NOT NULL,
  `group` varchar(64) NOT NULL,
  `ad` datetime NOT NULL,
  `up` datetime NOT NULL,
  PRIMARY KEY (`login`,`group`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 COMMENT='Группы пользователей';;

##########
# Dumping data for table `user_groups`
##########

INSERT INTO `user_groups` VALUES ('sachukanton@gmail.com', 'member', '2009-03-06 14:05:34', '0000-00-00 00:00:00');;


##########
# Table structure for table `users`
#
# Creation: February 12, 2010 at 11:38
# Last update: February 12, 2010 at 11:38
##########

DROP TABLE IF EXISTS `users`;;

CREATE TABLE `users` (
  `login` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `activated` enum('y','n') NOT NULL DEFAULT 'n',
  `code` varchar(32) NOT NULL,
  `date_gen` datetime NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `logdate` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `ad` datetime NOT NULL,
  `up` datetime NOT NULL,
  `dl` enum('y','n') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 COMMENT='Пользователи';;

##########
# Dumping data for table `users`
##########

INSERT INTO `users` VALUES ('stoha', 'dd603b2bc741ec2d05f3c45c89e0c534', 'y', 'rV2dE45fDKCO39LRdLWt1RjF0PNJVXs3', '2009-03-06 14:05:15', 'Сачук', 'sachukanton@gmail.com', '', '0000-00-00 00:00:00', '', '2009-03-06 14:05:15', '0000-00-00 00:00:00', 'n');;
INSERT INTO `nrad` VALUES ('kost', '69c12ff427dabfb5', 'Administrator', '65535', '', 'n', 'Стандарт', 'y', '2002-07-31 09:12:22', '2003-06-24 17:48:42', 'nail', 'r-r-');;
