-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2014 at 05:44 PM
-- Server version: 5.5.25-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test_catalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
(1, 'Фільми', 17),
(2, 'Мультфільми', 18),
(3, 'Комедія', 20),
(4, 'Драма', 20),
(5, 'Фентезі', 20),
(6, 'Бойовик', 20),
(7, 'Триллер', 20),
(8, 'Дитячий', 2),
(9, 'Сімейний', 22),
(10, 'Аніме', 22),
(11, 'Фентезі', 22),
(12, 'Бойовик', 22),
(13, 'Комедія', 22),
(14, 'Фантастика', 20),
(15, 'Драма', 22),
(16, 'Фантастика', 22),
(17, 'Аудіо файли', 0),
(18, 'Відео файли', 0),
(19, 'Наші', 1),
(20, 'Закордонні', 1),
(21, 'Наші', 2),
(22, 'Закордонні', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`) VALUES
(1, 'Капитан Америка: Другая война', '69'),
(2, '47 ронинов', '79'),
(3, 'Начало', '65'),
(4, 'Властелин колец: Возвращение Короля', '139'),
(5, 'Мстители', '59'),
(6, 'Призрачный патруль', '64'),
(7, 'Шанхайский полдень', '75'),
(8, 'Храбрая сердцем', '84'),
(9, 'Холодне сердце', '78'),
(10, 'Триган', '64'),
(11, 'Мастера меча онлайн', '76');

-- --------------------------------------------------------

--
-- Table structure for table `product_to_categories`
--

CREATE TABLE IF NOT EXISTS `product_to_categories` (
  `product_id` int(11) NOT NULL DEFAULT '0',
  `categ_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_to_categories`
--

INSERT INTO `product_to_categories` (`product_id`, `categ_id`) VALUES
(7, 3),
(7, 6),
(6, 3),
(6, 6),
(6, 14),
(5, 14),
(5, 6),
(4, 5),
(4, 0),
(3, 14),
(3, 7),
(3, 4),
(2, 4),
(2, 5),
(2, 6),
(1, 14),
(1, 6),
(8, 9),
(8, 11),
(8, 13),
(9, 13),
(9, 15),
(9, 11),
(10, 10),
(10, 12),
(10, 13),
(10, 15),
(10, 16),
(11, 10),
(11, 11),
(11, 15),
(11, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
