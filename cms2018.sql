-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2018 at 08:07 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms2018`
--

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`routeid`, `action`, `type`, `id`, `mod_name`, `mod_real_name`, `mod_desc`, `status`) VALUES
(1, 'add', 'page', 0, 'add_page', 'Add Page', 'This is the add page module', 1),
(2, 'login', NULL, 0, 'login', 'Login', 'This is the login module ', 1),
(3, 'select', 'theme', 0, 'select_theme', 'Select a theme', 'This is the theme selection mod', 1);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `theme_machine_name` varchar(255) DEFAULT NULL,
  `theme_display_name` varchar(255) DEFAULT NULL,
  `theme_desc` text NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`tid`, `theme_machine_name`, `theme_display_name`, `theme_desc`, `status`) VALUES
(1, 'default', 'The Default theme', 'This is the default theme of the website.\r\nDO not delete this ', 1),
(2, 'theme1', 'This is the second very nice theme', 'Second theme of the site ', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
