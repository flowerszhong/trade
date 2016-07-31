-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-07-24 18:21:00
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
-- 表的结构 `agent`
--

CREATE TABLE IF NOT EXISTS `agent` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `shortname` varchar(20) NOT NULL,
  `code` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `officephone` varchar(20) NOT NULL,
  `regdate` datetime DEFAULT NULL,
  `available` tinyint(1) DEFAULT NULL,
  `description` blob,
  `comments` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `agent`
--

INSERT INTO `agent` (`id`, `name`, `shortname`, `code`, `address`, `officephone`, `regdate`, `available`, `description`, `comments`) VALUES
(1, '码中人', 'mzh.ren', 'mzhren', '深圳祝贺区华侨城189号', '18999999999', '2016-07-24 17:19:56', 1, 0xe4b880e4b8aae7a081e5869ce585ace58fb8, 0xe5a5bde585ace58fb8),
(2, '楚思公司01', 'truthedu', '代码行业', '新的生产力', '18923119144', '2016-07-24 17:22:10', 1, 0xe59cb0e69eb673646b666a616c6b7364666a, 0x61736b6a64666c6b61736a666c6b6a646c6b666a736466),
(3, '楚思公司02', 'truthedu', '代码行业', '新的生产力', '18923119144', '2016-07-24 17:22:10', 1, 0xe59cb0e69eb673646b666a616c6b7364666a, 0x61736b6a64666c6b61736a666c6b6a646c6b666a736466),
(4, '楚思公司03', 'truthedu', '代码行业', '新的生产力', '18923119144', '2016-07-24 17:22:10', 1, 0xe59cb0e69eb673646b666a616c6b7364666a, 0x61736b6a64666c6b61736a666c6b6a646c6b666a736466),
(5, '楚思公司04', 'truthedu', '代码行业', '新的生产力', '18923119144', '2016-07-24 17:22:10', 1, 0xe59cb0e69eb673646b666a616c6b7364666a, 0x61736b6a64666c6b61736a666c6b6a646c6b666a736466),
(6, '楚思公司05', 'truthedu', '代码行业', '新的生产力', '18923119144', '2016-07-24 17:22:10', 1, 0xe59cb0e69eb673646b666a616c6b7364666a, 0x61736b6a64666c6b61736a666c6b6a646c6b666a736466),
(7, '楚思公司06', 'truthedu', '代码行业', '新的生产力', '18923119144', '2016-07-24 17:22:10', 1, 0xe59cb0e69eb673646b666a616c6b7364666a, 0x61736b6a64666c6b61736a666c6b6a646c6b666a736466),
(8, '楚思公司07', 'truthedu', '代码行业', '新的生产力', '18923119144', '2016-07-24 17:22:10', 1, 0xe59cb0e69eb673646b666a616c6b7364666a, 0x61736b6a64666c6b61736a666c6b6a646c6b666a736466),
(9, '楚思公司08', 'truthedu', '代码行业', '新的生产力', '18923119144', '2016-07-24 17:22:10', 1, 0xe59cb0e69eb673646b666a616c6b7364666a, 0x61736b6a64666c6b61736a666c6b6a646c6b666a736466),
(10, '楚思公司09', 'truthedu', '代码行业', '新的生产力', '18923119144', '2016-07-24 17:22:10', 1, 0xe59cb0e69eb673646b666a616c6b7364666a, 0x61736b6a64666c6b61736a666c6b6a646c6b666a736466),
(11, '楚思公司10', 'truthedu', '代码行业', '新的生产力', '18923119144', '2016-07-24 17:22:10', 1, 0xe59cb0e69eb673646b666a616c6b7364666a, 0x61736b6a64666c6b61736a666c6b6a646c6b666a736466),
(12, '楚思公司11', 'truthedu', '代码行业', '新的生产力', '18923119144', '2016-07-24 17:22:10', 1, 0xe59cb0e69eb673646b666a616c6b7364666a, 0x61736b6a64666c6b61736a666c6b6a646c6b666a736466),
(13, '肯德机01', 'kendeji', 'kendj', '美国纽约', '大吃大喝dkk', '2016-07-24 17:27:51', 1, 0x73646b616a666c6b, 0x6b6473616a6b666c6a),
(14, '肯德机02', 'kendeji', 'kendj', '美国纽约', '大吃大喝dkk', '2016-07-24 17:27:51', 1, 0x73646b616a666c6b, 0x6b6473616a6b666c6a);

-- --------------------------------------------------------

--
-- 表的结构 `agent_manager`
--

CREATE TABLE IF NOT EXISTS `agent_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bidding`
--

CREATE TABLE IF NOT EXISTS `bidding` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `rules` varchar(255) DEFAULT NULL,
  `area1` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `consume`
--

CREATE TABLE IF NOT EXISTS `consume` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `nickname` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `qq` int(11) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `office` varchar(20) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `manager`
--

INSERT INTO `manager` (`id`, `company_id`, `name`, `nickname`, `title`, `qq`, `mobile`, `email`, `office`, `regdate`) VALUES
(1, 2, '钟云辉', '', '', 0, '18923119120', 'flowerszhong@gmail.com', 'sdfsf', '2016-03-24 23:31:03'),
(2, 2, '钟云辉', '', '', 0, 'sdfsdf', 'flowerszhong@gmail.com', 'sdfsdf', '2016-03-24 23:31:15'),
(3, 2, 'matthew zhong', '', '', 0, '', 'flowerszhong@hotmail.com', 'sdfsf', '2016-03-24 23:33:55'),
(4, 5, '钟云辉', 'mzhong', 'ceo', 456326, '34563', 'flowerszhong@gmail.com', '2335445', '2016-07-24 18:09:49'),
(5, 6, '钟云辉', 'sdfsf', 'sadfasfs', 0, 'sadfsaf', 'flowerszhong@gmail.com', 'sdfasdf', '2016-07-24 18:10:18'),
(6, 7, '肯德机', 'ksd', 'asjlkfj', 0, 'asfjlk', 'skdfjslkdfj@aaa.com', 'sakfjlk', '2016-07-24 18:10:50');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
