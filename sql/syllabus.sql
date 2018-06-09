-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-06-09 13:32:47
-- 服务器版本： 5.6.37-log
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- 表的结构 `class`
--

CREATE TABLE `class` (
  `name` varchar(25) NOT NULL COMMENT '班级名称',
  `year` int(4) NOT NULL COMMENT '届',
  `id` varchar(8) NOT NULL COMMENT '班级ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `classtables`
--

CREATE TABLE `classtables` (
  `class_id` varchar(8) NOT NULL DEFAULT '',
  `Mon_1` varchar(30) DEFAULT NULL,
  `Mon_2` varchar(30) DEFAULT NULL,
  `Mon_3` varchar(30) DEFAULT NULL,
  `Mon_4` varchar(30) DEFAULT NULL,
  `Mon_5` varchar(30) DEFAULT NULL,
  `Mon_6` varchar(30) DEFAULT NULL,
  `Mon_7` varchar(30) DEFAULT NULL,
  `Mon_8` varchar(30) DEFAULT NULL,
  `Tues_1` varchar(30) DEFAULT NULL,
  `Tues_2` varchar(30) DEFAULT NULL,
  `Tues_3` varchar(30) DEFAULT NULL,
  `Tues_4` varchar(30) DEFAULT NULL,
  `Tues_5` varchar(30) DEFAULT NULL,
  `Tues_6` varchar(30) DEFAULT NULL,
  `Tues_7` varchar(30) DEFAULT NULL,
  `Tues_8` varchar(30) DEFAULT NULL,
  `Wed_1` varchar(30) DEFAULT NULL,
  `Wed_2` varchar(30) DEFAULT NULL,
  `Wed_3` varchar(30) DEFAULT NULL,
  `Wed_4` varchar(30) DEFAULT NULL,
  `Wed_5` varchar(30) DEFAULT NULL,
  `Wed_6` varchar(30) DEFAULT NULL,
  `Wed_7` varchar(30) DEFAULT NULL,
  `Wed_8` varchar(30) DEFAULT NULL,
  `Thur_1` varchar(30) DEFAULT NULL,
  `Thur_2` varchar(30) DEFAULT NULL,
  `Thur_3` varchar(30) DEFAULT NULL,
  `Thur_4` varchar(30) DEFAULT NULL,
  `Thur_5` varchar(30) DEFAULT NULL,
  `Thur_6` varchar(30) DEFAULT NULL,
  `Thur_7` varchar(30) DEFAULT NULL,
  `Thur_8` varchar(30) DEFAULT NULL,
  `Fir_1` varchar(30) DEFAULT NULL,
  `Fir_2` varchar(30) DEFAULT NULL,
  `Fir_3` varchar(30) DEFAULT NULL,
  `Fir_4` varchar(30) DEFAULT NULL,
  `Fir_5` varchar(30) DEFAULT NULL,
  `Fir_6` varchar(30) DEFAULT NULL,
  `Fir_7` varchar(30) DEFAULT NULL,
  `Fir_8` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `college`
--

CREATE TABLE `college` (
  `id` varchar(8) NOT NULL COMMENT '学院ID',
  `name` varchar(15) NOT NULL COMMENT '学院名称'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `major`
--

CREATE TABLE `major` (
  `id` varchar(8) NOT NULL COMMENT '专业ID',
  `name` varchar(15) NOT NULL COMMENT '专业名称'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classtables`
--
ALTER TABLE `classtables`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `class_id` (`class_id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
