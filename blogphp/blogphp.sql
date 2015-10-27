-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2015 at 09:55 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blogphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `pid`, `aid`, `uid`, `comment`, `date`, `time`) VALUES
(4, 3, 0, 4, 'fewf', '27-10-2015', '12:00:46 PM'),
(9, 22, 0, 4, 'hello World', '27-10-2015', '03:53:32 PM'),
(13, 7, 0, 4, 'Welcome on the Stylish Text Generator, This generator let you add effect on a text. Two kinds of effects are available in this generator, the text effect and the text decoration. The text effect changes the letters of you text using special characters, accentuated characters, symbols or other languages characters. Decorations are sets of characters surrounding the text.', '27-10-2015', '04:27:06 PM'),
(16, 7, 29, 0, 'Not Bad Update', '27-10-2015', '11:16:19 PM'),
(17, 7, 29, 0, 'Supr', '27-10-2015', '06:02:58 PM'),
(19, 7, 29, 0, 'Not Bad Update', '27-10-2015', '11:16:19 PM');

-- --------------------------------------------------------

--
-- Table structure for table `create_admin`
--

CREATE TABLE IF NOT EXISTS `create_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial_id` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `categore` varchar(40) NOT NULL,
  `stat` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `create_admin`
--

INSERT INTO `create_admin` (`id`, `serial_id`, `name`, `email`, `password`, `categore`, `stat`) VALUES
(29, '546', 's00', 'superadmin@example.com', '123', 'super-admin', '1'),
(30, '33849', 'Example Admin', 'admin@example.com', 'password', 'Admin', '1'),
(31, '564165', 'Example SubAdmin', 'subadmin@example.com', 'password', 'Sub-Admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `mainpost`
--

CREATE TABLE IF NOT EXISTS `mainpost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(400) NOT NULL,
  `image` varchar(400) NOT NULL,
  `description` varchar(1200) NOT NULL,
  `aid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `mainpost`
--

INSERT INTO `mainpost` (`id`, `title`, `image`, `description`, `aid`, `uid`, `date`, `time`) VALUES
(3, 'B13', 'image/127_Golden_Apple.jpg', 'Welcome on the Stylish Text Generator, This generator let you add effect on a text. Two kinds of effects are available in this generator, the text effect and the text decoration. The text effect changes the letters of you text using special characters, accentuated characters, symbols or other languages characters. Decorations are sets of characters surrounding the text.', 29, 0, '26-10-2015', '11:07:41 PM'),
(4, 'Example post 04', 'image/Black-Porsche-Car-in-the-Autumn-Forest-Wallpaper.jpg', 'Welcome on the Stylish Text Generator, This generator let you add effect on a text. Two kinds of effects are available in this generator, the text effect and the text decoration. The text effect changes the letters of you text using special characters, accentuated characters, symbols or other languages characters. Decorations are sets of characters surrounding the text. ', 0, 4, '26-10-2015', '11:09:25 PM'),
(7, 'Sub-Category1', 'image/2011-porsche-911-turbos-car-2.jpg', 'Welcome on the Stylish Text Generator, This generator let you add effect on a text. Two kinds of effects are available in this generator, the text effect and the text decoration. The text effect changes the letters of you text using special characters, accentuated characters, symbols or other languages characters. Decorations are sets of characters surrounding the text.', 29, 0, '26-10-2015', '11:08:16 PM'),
(21, 'Sub-Category2', 'image/2013-Porsche-918-spyder-Prototype-3.jpg', 'xxx', 29, 0, '26-10-2015', '11:08:22 PM'),
(22, 'Sub-Category1', 'image/Lavender-Field-Sunset-awesome-hd-wallpapers-free-download-incredible-high-definition-wallpapers-of-sunset-field.jpg', 'Welcome on the Stylish Text Generator, This generator let you add effect on a text. Two kinds of effects are available in this generator, the text effect and the text decoration. The text effect changes the letters of you text using special characters, accentuated characters, symbols or other languages characters. Decorations are sets of characters surrounding the text.', 0, 4, '26-10-2015', '11:09:34 PM'),
(28, 'Sub-Category', 'image/Awesome-High-Resolution-Video-Game-Wallpaper.jpg', 'Welcome on the Stylish Text Generator, This generator let you add effect on a text. Two kinds of effects are available in this generator, the text effect and the text decoration. The text effect changes the letters of you text using special characters, accentuated characters, symbols or other languages characters. Decorations are sets of characters surrounding the text.', 29, 0, '26-10-2015', '11:08:28 PM');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1200) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `image` varchar(1200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `description`, `image`) VALUES
(34, 'Slider 03', 'Slider 01 Welcome on the Stylish Text Generator, This generator let you add effect on a text. Two kinds of effects are available in this generator, the text effect and the text decoration. The text effect changes the letters of you text using special characters, accentuated characters, symbols or other languages characters. Decorations are sets of characters surrounding the text.', 'image/Awesome-High-Resolution-Video-Game-Wallpaper.jpg'),
(37, 'Slider 01', 'Welcome on the Stylish Text Generator, This generator let you add effect on a text. Two kinds of effects are available in this generator, the text effect and the text decoration. The text effect changes the letters of you text using special characters, accentuated characters, symbols or other languages characters. Decorations are sets of characters surrounding the text. ', 'image/8541_green_world.jpg'),
(38, 'Sub-Category2', '00', 'image/127_Golden_Apple.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_sign_up`
--

CREATE TABLE IF NOT EXISTS `user_sign_up` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_sign_up`
--

INSERT INTO `user_sign_up` (`id`, `name`, `email`, `password`) VALUES
(2, 's00', 'sofikul.alam@yahoo.com', '123'),
(3, 'hasan', 'likhon01@gmail.com', '123'),
(4, 'Hasa', 'sabbir_s00@yahoo.com', '123'),
(5, 'hellossssss', 'sofikul.alam@yahoo.com', '123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
