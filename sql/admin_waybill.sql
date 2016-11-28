-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-11-28 17:56:43
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
-- 表的结构 `admin_waybill`
--

CREATE TABLE IF NOT EXISTS `admin_waybill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `starttime` datetime NOT NULL,
  `signedtime` datetime NOT NULL,
  `num` varchar(30) NOT NULL,
  `customer_com` varchar(20) NOT NULL,
  `manager` varchar(20) NOT NULL,
  `transport_num` varchar(40) NOT NULL,
  `destination` varchar(40) NOT NULL,
  `departure` varchar(40) NOT NULL,
  `com` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `weight` float NOT NULL,
  `price` float NOT NULL,
  `fee` float NOT NULL,
  `agent_com` varchar(20) NOT NULL,
  `cost` float NOT NULL,
  `profit` float NOT NULL,
  `remarks` varchar(60) NOT NULL,
  `state` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `admin_waybill`
--

INSERT INTO `admin_waybill` (`id`, `starttime`, `signedtime`, `num`, `customer_com`, `manager`, `transport_num`, `destination`, `departure`, `com`, `amount`, `weight`, `price`, `fee`, `agent_com`, `cost`, `profit`, `remarks`, `state`) VALUES
(1, '2016-11-11 00:00:00', '0000-00-00 00:00:00', 'ydh001', 'kehu1', 'kh1_ywy', 'zdh001', '北京', '', 'DHL', 1, 10.1, 11.9, 21.56, '代理1', 25.11, 11.11, '客户1', 1),
(2, '2016-11-12 00:00:00', '0000-00-00 00:00:00', 'ydh002', 'kehu2', 'kh2_ywy', 'zdh002', '北京', '', 'DHL', 2, 10.1, 11.9, 21.56, '代理2', 25.11, 11.11, '客户2', 1),
(3, '2016-11-13 00:00:00', '0000-00-00 00:00:00', 'ydh003', 'kehu3', 'kh3_ywy', 'zdh003', '北京', '', 'DHL', 3, 10.1, 11.9, 21.56, '代理3', 25.11, 11.11, '客户3', 1),
(4, '2016-11-14 00:00:00', '0000-00-00 00:00:00', 'ydh004', 'kehu4', 'kh4_ywy', 'zdh004', '北京', '', 'DHL', 4, 10.1, 11.9, 21.56, '代理4', 25.11, 11.11, '客户4', 1),
(5, '2016-11-15 00:00:00', '0000-00-00 00:00:00', 'ydh005', 'kehu5', 'kh5_ywy', 'zdh005', '北京', '', 'DHL', 5, 10.1, 11.9, 21.56, '代理5', 25.11, 11.11, '客户5', 1),
(6, '2016-11-16 00:00:00', '0000-00-00 00:00:00', 'ydh006', 'kehu6', 'kh6_ywy', 'zdh006', '北京', '', 'DHL', 6, 10.1, 11.9, 21.56, '代理6', 25.11, 11.11, '客户6', 1),
(7, '2016-11-17 00:00:00', '0000-00-00 00:00:00', 'ydh007', 'kehu7', 'kh7_ywy', 'zdh007', '北京', '', 'DHL', 7, 10.1, 11.9, 21.56, '代理7', 25.11, 11.11, '客户7', 1),
(8, '2016-11-18 00:00:00', '0000-00-00 00:00:00', 'ydh008', 'kehu8', 'kh8_ywy', 'zdh008', '北京', '', 'DHL', 8, 10.1, 11.9, 21.56, '代理8', 25.11, 11.11, '客户8', 1),
(9, '2016-11-19 00:00:00', '0000-00-00 00:00:00', 'ydh009', 'kehu9', 'kh9_ywy', 'zdh009', '北京', '', 'DHL', 9, 10.1, 11.9, 21.56, '代理9', 25.11, 11.11, '客户9', 1),
(10, '2016-11-20 00:00:00', '0000-00-00 00:00:00', 'ydh010', 'kehu10', 'kh10_ywy', 'zdh010', '北京', '', 'DHL', 10, 10.1, 11.9, 21.56, '代理10', 25.11, 11.11, '客户10', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
