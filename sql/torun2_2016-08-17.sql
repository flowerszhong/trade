-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-08-16 20:42:41
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
(1, 'glc', '管理层', 'glc', 'sdafsdaf', 'sdafsaf', '2016-08-17 00:10:40', 1, 'sadfsadf', 'sdafsadf');

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
('a7be00e9ce3e6f33359d634afd3d293fb5d8c0cb', '127.0.0.1', 1471357296, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313335373237313b),
('11f6b8b0e207c5994b9b716699ee5b9b866e101f', '127.0.0.1', 1471357645, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313335373634353b),
('6b400c55dbcd069ef0c550dbe2b832d827c3ca65', '127.0.0.1', 1471358157, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313335383031353b),
('010242fb58e79fb6e59781d4ef94f859670a9ea6', '127.0.0.1', 1471359073, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313335383738303b),
('43b0001530787c815db5ae5c624635e3967381df', '127.0.0.1', 1471358840, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313335383834303b),
('f5f20dc18158368267f3e152c1166ebc04ba81e2', '127.0.0.1', 1471359120, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313335393131313b),
('9f2a07555670923e0c11e7789f755622f1e60e40', '127.0.0.1', 1471359331, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313335393333313b),
('b1f9c6ac023114240b92a00b3321e070d4b6ec84', '127.0.0.1', 1471360243, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313335393938353b),
('31233da00a66d9720eafa6f73ef5c7e93fa8923a', '127.0.0.1', 1471361327, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313336313033383b),
('545e6771e29db20e0b5a3903a8c6f480bc89d2ea', '127.0.0.1', 1471361651, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313336313337343b),
('8c5eaee6652282cb09c347440d06f8def74b555a', '127.0.0.1', 1471362028, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313336313936313b),
('a2312bb4f5077c467d59f53f7f6d3c90ae427b7f', '127.0.0.1', 1471362065, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313336323034363b),
('efddf48940178c75ead184efc875ddbb07c132ce', '127.0.0.1', 1471362999, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313336323738393b),
('2e66b31f0f1535426ea2b1967e79e521fa3d15d3', '127.0.0.1', 1471364080, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313336333831333b),
('89242dd1f95a0680ed9e015ce885e39aa8ce4600', '127.0.0.1', 1471364165, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313336343136343b),
('070f1a5b2fe8cde1ecaa7a619132256bf0699a88', '127.0.0.1', 1471365167, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313336353136363b),
('292a122fd5b949c705e3eb3e65dc0b604b8c3d98', '127.0.0.1', 1471366105, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313336363034363b),
('e66f58e9c0dca8ea5d367aaa55f7dcd49b95e542', '127.0.0.1', 1471372911, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313337323830323b);

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
  `pwd` varchar(20) NOT NULL DEFAULT '123456',
  `salt1` varchar(20) NOT NULL,
  `salt2` varchar(20) NOT NULL,
  `power` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `admin_manager`
--

INSERT INTO `admin_manager` (`id`, `company_id`, `name`, `username`, `title`, `qq`, `mobile`, `email`, `office`, `regdate`, `pwd`, `salt1`, `salt2`, `power`) VALUES
(1, 1, '代理人1', '客户经理1', '1111', 0, '1333333', 'sdfsfa', '11111111', '2016-08-16 16:11:55', '', '2706', '20188', 1),
(2, 1, '客户经理', 'admin2', '222', 222, '2222', '222', '2222', '2016-08-16 16:14:40', '68e0dacc9844df247cd2', '788', '569621', 1);

-- --------------------------------------------------------

--
-- 表的结构 `admin_price`
--

CREATE TABLE IF NOT EXISTS `admin_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel` tinyint(4) NOT NULL,
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
