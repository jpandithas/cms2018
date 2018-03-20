-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 19, 2018 at 06:59 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms2018`
--

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `pageid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `alias` varchar(255) NOT NULL,
  `timeadd` timestamp NOT NULL,
  `timeedit` timestamp NOT NULL,
  PRIMARY KEY (`pageid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`pageid`, `title`, `content`, `alias`, `timeadd`, `timeedit`) VALUES
(2, 'title', 'My first page content ', 'alias', '2018-03-19 16:03:41', '2018-03-19 16:03:41'),
(6, 'title', 'Content goes here', 'alias1', '2018-03-19 16:38:11', '2018-03-19 16:38:11'),
(7, 'title', 'Content goes here', 'alias2', '2018-03-19 16:39:43', '2018-03-19 16:39:43'),
(8, 'This is my Fourth Page!!!', 'Fourth Page content', 'fourth-page', '2018-03-19 18:56:07', '2018-03-19 18:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE IF NOT EXISTS `routes` (
  `routeid` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(100) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `id` tinyint(1) DEFAULT NULL,
  `mod_name` varchar(256) NOT NULL,
  `mod_real_name` varchar(256) NOT NULL,
  `mod_desc` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`routeid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`routeid`, `action`, `type`, `id`, `mod_name`, `mod_real_name`, `mod_desc`, `status`) VALUES
(1, 'add', 'page', 0, 'add_page', 'Add Page', 'This is the add page module', 1),
(2, 'login', NULL, 0, 'login', 'Login', 'This is the login module ', 1),
(3, 'select', 'theme', 0, 'select_theme', 'Select a theme', 'This is the theme selection mod', 1),
(4, 'logout', NULL, 0, 'logout', 'Logout', 'This is the logout module. ', 1),
(5, 'display', 'page', 1, 'display_page', 'Display Page', 'This is the display page module', 1);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `theme_machine_name` varchar(255) DEFAULT NULL,
  `theme_display_name` varchar(255) DEFAULT NULL,
  `theme_desc` text NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`tid`, `theme_machine_name`, `theme_display_name`, `theme_desc`, `status`) VALUES
(1, 'default', 'The Default theme', 'This is the default theme of the website.\r\nDO not delete this ', 1),
(2, 'theme1', 'This is the second very nice theme', 'Second theme of the site ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `userlevel` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `userlevel`) VALUES
(1, 'admin', '9cd2a2a4fc09b8d8792943ffb19f493c', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
