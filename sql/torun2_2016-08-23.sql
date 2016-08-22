-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-08-22 18:19:17
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
-- 表的结构 `admin_agent`
--

CREATE TABLE IF NOT EXISTS `admin_agent` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `shortname` varchar(20) NOT NULL,
  `code` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `officephone` varchar(20) NOT NULL,
  `regdate` datetime DEFAULT NULL,
  `available` tinyint(1) DEFAULT NULL,
  `description` tinytext,
  `comments` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin_agent`
--

INSERT INTO `admin_agent` (`id`, `name`, `shortname`, `code`, `address`, `officephone`, `regdate`, `available`, `description`, `comments`) VALUES
(1, '深圳途瑞国际货运代理有限公司', '途瑞物流', 'torun', '深圳市宝安机场', '13800000000', '2016-08-22 23:55:57', 1, '一个高速发展的公司', '一个高速发展的公司');

-- --------------------------------------------------------

--
-- 表的结构 `admin_agent_manager`
--

CREATE TABLE IF NOT EXISTS `admin_agent_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `admin_agent_price`
--

CREATE TABLE IF NOT EXISTS `admin_agent_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `admin_area`
--

CREATE TABLE IF NOT EXISTS `admin_area` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` int(11) NOT NULL,
  `state` varchar(40) NOT NULL,
  `state_en` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `admin_bidding`
--

CREATE TABLE IF NOT EXISTS `admin_bidding` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `rules` varchar(255) DEFAULT NULL,
  `area1` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `admin_ci_sessions`
--

CREATE TABLE IF NOT EXISTS `admin_ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_ci_sessions`
--

INSERT INTO `admin_ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('420a32c3786334de76bdf1c1468ff3302e64f8dd', '127.0.0.1', 1471881487, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313838313231353b),
('97851192cc182649cf03a143761e23ae45469684', '127.0.0.1', 1471881592, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313838313534363b6d616e616765727c613a31353a7b733a323a226964223b733a313a2231223b733a31303a22636f6d70616e795f6964223b733a313a2231223b733a343a226e616d65223b733a31353a22e98094e7919ee7aea1e79086e59198223b733a383a22757365726e616d65223b733a31313a22746f72756e5f61646d696e223b733a353a227469746c65223b733a393a22e7aea1e79086e59198223b733a323a227171223b733a383a223132333435363738223b733a363a226d6f62696c65223b733a31313a223133383030303030303030223b733a353a22656d61696c223b733a31353a2261646d696e40746f72756e2e636f6d223b733a363a226f6666696365223b733a31323a223032302d3132333435363738223b733a373a2272656764617465223b733a31393a22323031362d30382d32322032333a35383a3036223b733a333a22707764223b733a34303a2261663930643465613130373765336464393965653861353834376464656537623038386438393038223b733a353a2273616c7431223b733a333a22333436223b733a353a2273616c7432223b733a353a223430333439223b733a353a22706f776572223b733a333a22313030223b733a393a2273686f72746e616d65223b733a31323a22e98094e7919ee789a9e6b581223b7d),
('f00a85932464551ca6435767cc2a9df55a8f235e', '127.0.0.1', 1471882351, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313838323335313b);

-- --------------------------------------------------------

--
-- 表的结构 `admin_consume`
--

CREATE TABLE IF NOT EXISTS `admin_consume` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `admin_history`
--

CREATE TABLE IF NOT EXISTS `admin_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `querytime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` varchar(30) NOT NULL,
  `weight` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `admin_manager`
--

CREATE TABLE IF NOT EXISTS `admin_manager` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `qq` int(11) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `office` varchar(20) DEFAULT NULL,
  `regdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pwd` varchar(40) NOT NULL DEFAULT '123456',
  `salt1` varchar(20) NOT NULL,
  `salt2` varchar(20) NOT NULL,
  `power` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin_manager`
--

INSERT INTO `admin_manager` (`id`, `company_id`, `name`, `username`, `title`, `qq`, `mobile`, `email`, `office`, `regdate`, `pwd`, `salt1`, `salt2`, `power`) VALUES
(1, 1, '途瑞管理员', 'torun_admin', '管理员', 12345678, '13800000000', 'admin@torun.com', '020-12345678', '2016-08-22 15:58:06', 'af90d4ea1077e3dd99ee8a5847ddee7b088d8908', '346', '40349', 100);

-- --------------------------------------------------------

--
-- 表的结构 `admin_price`
--

CREATE TABLE IF NOT EXISTS `admin_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel` tinyint(4) DEFAULT NULL,
  `cname` varchar(20) NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `company_id` int(11) NOT NULL,
  `firstrow` text NOT NULL,
  `firstcol` text NOT NULL,
  `pricedata` mediumtext NOT NULL,
  `areadata` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `admin_query_records`
--

CREATE TABLE IF NOT EXISTS `admin_query_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manager_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `weight` float NOT NULL,
  `query_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` varchar(30) NOT NULL,
  `ip` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
