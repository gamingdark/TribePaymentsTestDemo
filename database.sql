-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 02, 2020 at 05:21 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tribe`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'Users', 'Basic users (only user list)'),
(2, 'Mods', 'Group moderators (users and groups)'),
(3, 'Admins', 'Administrators (groups and permissions)');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`) VALUES
(1, 'permission_list', 'Display permission list (admins)'),
(2, 'group_list', 'Display group list (mods + admins)'),
(3, 'user_list', 'Display user list (users + mods)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@site.com'),
(2, 'mod', 'ad148a3ca8bd0ef3b48c52454c493ec5', 'mod@site.com'),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@site.com'),
(4, 'combo', 'c69c522d7937f66ff7becd10515a95f7', 'combo@site.com');

-- --------------------------------------------------------

--
-- Table structure for table `groups_permissions_pivot`
--

DROP TABLE IF EXISTS `permissions_groups_pivot`;
CREATE TABLE IF NOT EXISTS `permissions_groups_pivot` (
  `permission_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  UNIQUE KEY `group_permission` (`permission_id`,`group_id`),
  INDEX (`permission_id`),
  INDEX (`group_id`),
  FOREIGN KEY (`group_id`)
      REFERENCES `groups`(`id`)
      ON DELETE CASCADE,
  FOREIGN KEY (`permission_id`)
      REFERENCES `permissions`(`id`)
      ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_groups_pivot`
--

DROP TABLE IF EXISTS `users_groups_pivot`;
CREATE TABLE IF NOT EXISTS `users_groups_pivot` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  UNIQUE KEY `user_group` (`user_id`,`group_id`),
  INDEX (`user_id`),
  INDEX (`group_id`),
  FOREIGN KEY (`user_id`)
      REFERENCES `users`(`id`)
      ON DELETE CASCADE,
  FOREIGN KEY (`group_id`)
      REFERENCES `groups`(`id`)
      ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO `users_groups_pivot` (`user_id`, `group_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 2),
(4, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO `permissions_groups_pivot` (`group_id`, `permission_id`) VALUES
(3, 1),
(3, 2),
(2, 2),
(2, 3),
(1, 3);

COMMIT;
