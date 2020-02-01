-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 05, 2019 at 12:41 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(3) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(6, 'c++'),
(8, 'css'),
(9, 'php');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(3) NOT NULL AUTO_INCREMENT,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(3) NOT NULL AUTO_INCREMENT,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL DEFAULT '0',
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(20, 9, 'php', 'khloodkhaled', '2019-08-04', 'image_3.jpg', '<p>sssssssssssss</p><p>ddddddddddddd</p><p>iiiiiiiiiiiii</p><p>ppppppppppppppppppppppsmkx</p>', 'css, great ', 1, 'published', 12),
(21, 9, 'php', 'khloodkhaled', '2019-08-04', 'image_3.jpg', '<p>sssssssssssss</p><p>ddddddddddddd</p><p>iiiiiiiiiiiii</p><p>ppppppppppppppppppppppsmkx</p>', 'css, great ', 0, 'published', 1),
(22, 9, 'php', 'khloodkhaled', '2019-08-04', 'image_3.jpg', '<p>sssssssssssss</p><p>ddddddddddddd</p><p>iiiiiiiiiiiii</p><p>ppppppppppppppppppppppsmkx</p>', 'css, great ', 0, 'published', 0),
(23, 9, 'php', 'khloodkhaled', '2019-08-04', 'image_3.jpg', '<p>sssssssssssss</p><p>ddddddddddddd</p><p>iiiiiiiiiiiii</p><p>ppppppppppppppppppppppsmkx</p>', 'css, great ', 0, 'published', 0),
(24, 9, 'php', 'khloodkhaled', '2019-08-04', 'image_3.jpg', '<p>sssssssssssss</p><p>ddddddddddddd</p><p>iiiiiiiiiiiii</p><p>ppppppppppppppppppppppsmkx</p>', 'css, great ', 0, 'published', 0),
(25, 8, 'php', 'bzzgvzsg', '2019-08-04', 'image_4.jpg', '<p>tttrcrdesxx</p>', 'eeeee', 0, 'published', 1),
(26, 9, 'php', 'khlood', '2019-08-04', 'image_4.jpg', '<p>hhhhhhhhhhhhhhhhf</p>', 'php , great ', 0, 'published', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_role`) VALUES
(13, 'khloodkhaledahmed', '$2y$12$G2dTO4.OJ7hzilmaXvNWqOrfs06j3GZe30ag3LfkqZC9F70jRXBWa', 'khlood', 'swidan', 'khlood@yahoo.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

DROP TABLE IF EXISTS `users_online`;
CREATE TABLE IF NOT EXISTS `users_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, 'ogc1au02si9bivovefkqcm8533', 1563707242),
(2, '9cjjofnnog57go28ubcjm26vob', 1564171081),
(3, 'soc39f6g6nt6lbasua1lqu8noc', 1564157437),
(4, 'soscb1ut2ahrklnn52rj6s38n2', 1564187310),
(5, '2m9j9vpkc2nflh9ihdiqia4eua', 1564288465),
(6, '3nkmg98v83vf65bbkaqv1gkc10', 1564629911),
(7, '0t0tu4p9bkfsr1pcgtlvmqnlsf', 1564703759),
(8, 'pm0v0r0sgc798tk0g45ft7ba27', 1564878618),
(9, '7c8gp9phnv22tg22tep27pjpmm', 1564878861),
(10, 'ah5314ndcbrs30o4dc4aqf4m71', 1564881091),
(11, 'jsmbsuqo5lkgh42qfoamt8l6on', 1564881279),
(12, 'fu78ipp2v1imk4nj6381ingl5n', 1564881304),
(13, 'll97d0mbcv1ka3dn31pjr310vu', 1564882013),
(14, '07o5rns5o28likvi0slohd3lej', 1564936730);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
