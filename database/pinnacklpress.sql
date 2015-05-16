-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 16 Mai 2015 à 19:19
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `pinnacklpress`
--

-- --------------------------------------------------------

--
-- Structure de la table `pp_comment`
--

CREATE TABLE IF NOT EXISTS `pp_comment` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL COMMENT 'post table : primary key',
  `com_content` varchar(45) DEFAULT NULL,
  `com_author` int(11) DEFAULT NULL COMMENT 'user table : primary key',
  `com_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `com_udate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `com_active` int(11) DEFAULT '1',
  PRIMARY KEY (`com_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pp_connected`
--

CREATE TABLE IF NOT EXISTS `pp_connected` (
  `connected_id` int(11) NOT NULL AUTO_INCREMENT,
  `connected_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`connected_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pp_field`
--

CREATE TABLE IF NOT EXISTS `pp_field` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(45) NOT NULL,
  `field_type` varchar(25) NOT NULL,
  `field_domname` varchar(45) NOT NULL,
  `field_domid` varchar(45) NOT NULL,
  `field_value` varchar(100) NOT NULL,
  `field_placeholder` varchar(100) NOT NULL,
  PRIMARY KEY (`field_id`),
  KEY `field_name` (`field_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `pp_field`
--

INSERT INTO `pp_field` (`field_id`, `field_name`, `field_type`, `field_domname`, `field_domid`, `field_value`, `field_placeholder`) VALUES
(1, 'name', 'text', 'name', 'email', 'alexis.thorel@gmail.com', ''),
(2, 'password', 'password', 'password', 'password', 'plopplopplop', '');

-- --------------------------------------------------------

--
-- Structure de la table `pp_field_rs`
--

CREATE TABLE IF NOT EXISTS `pp_field_rs` (
  `field_rs_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `validator_id` int(11) NOT NULL,
  PRIMARY KEY (`field_rs_id`),
  KEY `field_id` (`field_id`,`validator_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `pp_field_rs`
--

INSERT INTO `pp_field_rs` (`field_rs_id`, `field_id`, `validator_id`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `pp_form`
--

CREATE TABLE IF NOT EXISTS `pp_form` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(25) NOT NULL,
  `form_action` varchar(45) NOT NULL,
  `form_method` varchar(25) NOT NULL,
  `form_target` varchar(25) NOT NULL,
  `form_enctype` varchar(25) NOT NULL,
  PRIMARY KEY (`form_id`),
  UNIQUE KEY `form_name` (`form_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `pp_form`
--

INSERT INTO `pp_form` (`form_id`, `form_name`, `form_action`, `form_method`, `form_target`, `form_enctype`) VALUES
(1, 'inscription', 'login', 'post', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `pp_form_rs`
--

CREATE TABLE IF NOT EXISTS `pp_form_rs` (
  `form_rs_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  PRIMARY KEY (`form_rs_id`),
  KEY `form_id` (`form_id`,`field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `pp_form_rs`
--

INSERT INTO `pp_form_rs` (`form_rs_id`, `form_id`, `field_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `pp_gender`
--

CREATE TABLE IF NOT EXISTS `pp_gender` (
  `gender_id` int(11) NOT NULL AUTO_INCREMENT,
  `geder_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pp_history`
--

CREATE TABLE IF NOT EXISTS `pp_history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `history_date` varchar(45) DEFAULT NULL,
  `history_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pp_hstatus`
--

CREATE TABLE IF NOT EXISTS `pp_hstatus` (
  `hstatus_id` int(11) NOT NULL AUTO_INCREMENT,
  `hstatus_tag` varchar(45) DEFAULT NULL,
  `hstatus_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`hstatus_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pp_mail`
--

CREATE TABLE IF NOT EXISTS `pp_mail` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_name` varchar(128) NOT NULL,
  `mail_subject` varchar(255) NOT NULL,
  `mail_content` text NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pp_metafield`
--

CREATE TABLE IF NOT EXISTS `pp_metafield` (
  `fmeta_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `fmeta_name` varchar(45) NOT NULL,
  `fmeta_value` varchar(45) NOT NULL,
  PRIMARY KEY (`fmeta_id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pp_metalink`
--

CREATE TABLE IF NOT EXISTS `pp_metalink` (
  `mlink_id` int(11) NOT NULL AUTO_INCREMENT,
  `mlink_name` varchar(45) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL COMMENT 'post table : primary key',
  `page_id` int(11) DEFAULT NULL COMMENT 'page table : primary key',
  PRIMARY KEY (`mlink_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pp_option`
--

CREATE TABLE IF NOT EXISTS `pp_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(45) DEFAULT NULL,
  `option_value` varchar(45) DEFAULT NULL,
  `option_active` varchar(45) DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  KEY `option_name` (`option_name`),
  KEY `option_value` (`option_value`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `pp_option`
--

INSERT INTO `pp_option` (`option_id`, `option_name`, `option_value`, `option_active`) VALUES
(1, 'sitename', 'Pinnackl', NULL),
(2, 'sitedescription', 'le site de l''info', NULL),
(3, 'siteurl', 'http://127.0.0.1/pinnacklpress/', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `pp_page`
--

CREATE TABLE IF NOT EXISTS `pp_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_tag` varchar(45) DEFAULT '',
  `page_name` varchar(45) DEFAULT '',
  `page_order` int(11) DEFAULT NULL,
  `page_display` varchar(45) DEFAULT NULL,
  `page_connected` varchar(45) DEFAULT NULL,
  `page_active` varchar(45) DEFAULT NULL,
  `page_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`page_id`),
  KEY `page_display` (`page_display`),
  KEY `page_connected` (`page_connected`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `pp_page`
--

INSERT INTO `pp_page` (`page_id`, `page_tag`, `page_name`, `page_order`, `page_display`, `page_connected`, `page_active`, `page_type`) VALUES
(1, 'index', 'Accueil', 0, 'yes', 'all', NULL, NULL),
(2, 'mon-compte', 'Mon Compte', 1, 'yes', 'yes', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `pp_pagemeta`
--

CREATE TABLE IF NOT EXISTS `pp_pagemeta` (
  `pmeta_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `pmeta_name` varchar(45) DEFAULT NULL,
  `pmeta_value` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pmeta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pp_post`
--

CREATE TABLE IF NOT EXISTS `pp_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(45) NOT NULL,
  `post_content` varchar(45) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL COMMENT 'page table : primary key',
  `post_author` int(11) DEFAULT NULL COMMENT 'user table : primary key',
  `post_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `post_udate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_active` varchar(45) DEFAULT NULL,
  `post_comment` varchar(45) DEFAULT NULL,
  `post_ccount` float DEFAULT '0',
  PRIMARY KEY (`post_id`),
  UNIQUE KEY `post_title_UNIQUE` (`post_title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pp_postmeta`
--

CREATE TABLE IF NOT EXISTS `pp_postmeta` (
  `pmeta_id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `pmeta_name` varchar(45) DEFAULT NULL,
  `pmeta_value` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pmeta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pp_role`
--

CREATE TABLE IF NOT EXISTS `pp_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pp_user`
--

CREATE TABLE IF NOT EXISTS `pp_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_gender` int(11) NOT NULL,
  `user_firstname` varchar(45) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `user_pseudo` varchar(45) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_bdate` datetime DEFAULT NULL,
  `user_regdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_role` int(11) NOT NULL,
  `user_key` varchar(45) NOT NULL,
  `user_active` int(11) DEFAULT '0',
  `user_url` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email_UNIQUE` (`user_email`),
  UNIQUE KEY `user_pseudo_UNIQUE` (`user_pseudo`),
  UNIQUE KEY `user_url_UNIQUE` (`user_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pp_validator`
--

CREATE TABLE IF NOT EXISTS `pp_validator` (
  `validator_id` int(11) NOT NULL AUTO_INCREMENT,
  `validator_rule` varchar(45) NOT NULL,
  PRIMARY KEY (`validator_id`),
  KEY `validator_rule` (`validator_rule`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `pp_validator`
--

INSERT INTO `pp_validator` (`validator_id`, `validator_rule`) VALUES
(1, 'isMail'),
(2, 'isPassword');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
