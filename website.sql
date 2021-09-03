-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 02 Eyl 2021, 17:13:48
-- Sunucu sürümü: 5.7.34
-- PHP Sürümü: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `website`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comment`
--

CREATE TABLE `comment` (
  `topic_name` varchar(255) NOT NULL,
  `comment_text` varchar(255) NOT NULL,
  `comment_like_num` int(255) NOT NULL,
  `comment_dislike_num` int(255) NOT NULL,
  `comment_date` varchar(255) NOT NULL,
  `comment_username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `disliked_comment`
--

CREATE TABLE `disliked_comment` (
  `topic_name` varchar(255) NOT NULL,
  `comment_text` varchar(255) NOT NULL,
  `comment_username` varchar(255) NOT NULL,
  `comment_date` varchar(255) NOT NULL,
  `disliked_username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `feedback`
--

CREATE TABLE `feedback` (
  `username` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `star` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hot_topics`
--

CREATE TABLE `hot_topics` (
  `EMA` decimal(4,4) NOT NULL,
  `topic_title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `interval_comment`
--

CREATE TABLE `interval_comment` (
  `topic_title` varchar(127) NOT NULL,
  `comment_text` varchar(255) NOT NULL,
  `comment_date` varchar(127) NOT NULL,
  `comment_username` varchar(127) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `interval_dislike`
--

CREATE TABLE `interval_dislike` (
  `topic_title` varchar(255) NOT NULL,
  `comment_text` varchar(255) NOT NULL,
  `comment_username` varchar(255) NOT NULL,
  `comment_date` varchar(255) NOT NULL,
  `disliked_username` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `interval_like`
--

CREATE TABLE `interval_like` (
  `topic_title` varchar(255) NOT NULL,
  `comment_text` varchar(255) NOT NULL,
  `comment_username` varchar(255) NOT NULL,
  `comment_date` varchar(255) NOT NULL,
  `liked_username` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `liked_comment`
--

CREATE TABLE `liked_comment` (
  `topic_name` varchar(255) NOT NULL,
  `comment_text` varchar(255) NOT NULL,
  `comment_username` varchar(255) NOT NULL,
  `comment_date` varchar(255) NOT NULL,
  `liked_username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `metaphone_topic`
--

CREATE TABLE `metaphone_topic` (
  `topic_name` varchar(255) NOT NULL,
  `topic_metaphone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `metaphone_user`
--

CREATE TABLE `metaphone_user` (
  `username` varchar(255) NOT NULL,
  `user_metaphone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `topic`
--

CREATE TABLE `topic` (
  `topic_name` varchar(255) NOT NULL,
  `topic_type` varchar(255) NOT NULL,
  `topic_creator_username` varchar(255) NOT NULL,
  `created_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `total_user_click`
--

CREATE TABLE `total_user_click` (
  `user_ip` varchar(255) NOT NULL,
  `topic_title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `trend`
--

CREATE TABLE `trend` (
  `topic_title` varchar(255) NOT NULL,
  `ema` varchar(255) NOT NULL,
  `trend_date` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_click`
--

CREATE TABLE `user_click` (
  `user_ip` varchar(255) NOT NULL,
  `topic_title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_follow`
--

CREATE TABLE `user_follow` (
  `username` varchar(255) NOT NULL,
  `following_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_profile`
--

CREATE TABLE `user_profile` (
  `username` varchar(255) NOT NULL,
  `user_realname` varchar(255) NOT NULL,
  `user_realsurname` varchar(255) NOT NULL,
  `user_age` int(255) NOT NULL,
  `user_gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `verification`
--

CREATE TABLE `verification` (
  `mail` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`topic_name`,`comment_text`,`comment_date`,`comment_username`);

--
-- Tablo için indeksler `disliked_comment`
--
ALTER TABLE `disliked_comment`
  ADD PRIMARY KEY (`comment_date`,`disliked_username`);

--
-- Tablo için indeksler `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`username`);

--
-- Tablo için indeksler `hot_topics`
--
ALTER TABLE `hot_topics`
  ADD PRIMARY KEY (`topic_title`);

--
-- Tablo için indeksler `interval_comment`
--
ALTER TABLE `interval_comment`
  ADD PRIMARY KEY (`topic_title`,`comment_text`,`comment_date`,`comment_username`);

--
-- Tablo için indeksler `interval_dislike`
--
ALTER TABLE `interval_dislike`
  ADD PRIMARY KEY (`comment_date`,`disliked_username`);

--
-- Tablo için indeksler `interval_like`
--
ALTER TABLE `interval_like`
  ADD PRIMARY KEY (`comment_date`,`liked_username`);

--
-- Tablo için indeksler `liked_comment`
--
ALTER TABLE `liked_comment`
  ADD PRIMARY KEY (`comment_date`,`liked_username`);

--
-- Tablo için indeksler `metaphone_topic`
--
ALTER TABLE `metaphone_topic`
  ADD PRIMARY KEY (`topic_name`);

--
-- Tablo için indeksler `metaphone_user`
--
ALTER TABLE `metaphone_user`
  ADD PRIMARY KEY (`username`);

--
-- Tablo için indeksler `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`topic_name`);

--
-- Tablo için indeksler `total_user_click`
--
ALTER TABLE `total_user_click`
  ADD PRIMARY KEY (`user_ip`,`topic_title`);

--
-- Tablo için indeksler `trend`
--
ALTER TABLE `trend`
  ADD PRIMARY KEY (`topic_title`,`trend_date`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `user_click`
--
ALTER TABLE `user_click`
  ADD PRIMARY KEY (`user_ip`,`topic_title`);

--
-- Tablo için indeksler `user_follow`
--
ALTER TABLE `user_follow`
  ADD PRIMARY KEY (`username`,`following_user`);

--
-- Tablo için indeksler `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`username`);

--
-- Tablo için indeksler `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`mail`,`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
