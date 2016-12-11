-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-12-04 17:20:30
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `torun2`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_file`
--

CREATE TABLE IF NOT EXISTS `admin_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(60) NOT NULL,
  `orig_name` varchar(60) NOT NULL,
  `file_ext` varchar(20) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_size` float NOT NULL,
  `comments` varchar(200) NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  `available` tinyint(4) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;