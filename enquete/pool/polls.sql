-- phpMyAdmin SQL Dump
-- version 2.11.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 15, 2009 at 05:53 AM
-- Server version: 5.0.41
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `polls`
--

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL auto_increment,
  `ques_id` int(11) NOT NULL,
  `value` varchar(300) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `ques_id`, `value`) VALUES
(1, 1, 'Bit.ly'),
(2, 1, 'TinyURL'),
(3, 1, 'is.gd'),
(4, 1, 'tr.im'),
(5, 1, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL auto_increment,
  `ques` text NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `ques`, `created_on`) VALUES
(1, 'Which URL Shortening service you use most?', '2009-10-13 07:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL auto_increment,
  `option_id` int(11) NOT NULL,
  `voted_on` datetime NOT NULL,
  `ip` varchar(16) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES
(1, 2, '2009-10-14 14:00:55', ''),
(2, 1, '2009-10-14 14:01:27', '127.0.0.1'),
(3, 1, '2009-10-14 14:02:04', '127.0.0.1'),
(4, 1, '2009-10-14 14:02:13', '127.0.0.1'),
(5, 3, '2009-10-14 14:02:16', '127.0.0.1'),
(6, 4, '2009-10-14 14:02:21', '127.0.0.1'),
(7, 3, '2009-10-14 14:02:24', '127.0.0.1'),
(8, 1, '2009-10-14 14:02:27', '127.0.0.1'),
(9, 2, '2009-10-14 14:02:31', '127.0.0.1'),
(10, 5, '2009-10-14 14:02:35', '127.0.0.1'),
(11, 1, '2009-10-14 14:02:38', '127.0.0.1'),
(12, 2, '2009-10-14 14:02:43', '127.0.0.1'),
(13, 1, '2009-10-14 14:02:46', '127.0.0.1'),
(14, 1, '2009-10-14 14:02:50', '127.0.0.1'),
(15, 1, '2009-10-14 14:05:26', '127.0.0.1'),
(16, 1, '2009-10-14 14:05:29', '127.0.0.1'),
(17, 4, '2009-10-14 14:05:33', '127.0.0.1'),
(18, 2, '2009-10-14 14:05:36', '127.0.0.1'),
(19, 1, '2009-10-14 14:05:40', '127.0.0.1'),
(20, 3, '2009-10-14 14:05:46', '127.0.0.1'),
(21, 2, '2009-10-14 14:05:49', '127.0.0.1'),
(22, 2, '2009-10-14 14:21:37', '127.0.0.1'),
(23, 1, '2009-10-14 14:21:53', '127.0.0.1'),
(24, 5, '2009-10-14 14:21:59', '127.0.0.1'),
(25, 1, '2009-10-14 14:35:27', '127.0.0.1'),
(26, 1, '2009-10-15 00:42:05', '127.0.0.1'),
(27, 3, '2009-10-15 00:49:42', '127.0.0.1'),
(28, 2, '2009-10-15 01:22:00', '127.0.0.1'),
(29, 2, '2009-10-15 01:24:51', '127.0.0.1'),
(30, 1, '2009-10-15 01:37:21', '127.0.0.1'),
(31, 1, '2009-10-15 01:38:48', '127.0.0.1'),
(32, 1, '2009-10-15 01:41:30', '127.0.0.1'),
(33, 1, '2009-10-15 01:42:21', '127.0.0.1'),
(34, 1, '2009-10-15 04:53:42', '127.0.0.1'),
(35, 3, '2009-10-15 05:09:14', '127.0.0.1'),
(36, 2, '2009-10-15 05:10:01', '127.0.0.1');
