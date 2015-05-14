CREATE DATABASE  IF NOT EXISTS `sophk` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sophk`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sophk
-- ------------------------------------------------------
-- Server version	5.6.15-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pp_comment`
--

DROP TABLE IF EXISTS `pp_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_comment` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL COMMENT 'post table : primary key',
  `com_content` varchar(45) DEFAULT NULL,
  `com_author` int(11) DEFAULT NULL COMMENT 'user table : primary key',
  `com_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `com_udate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `com_active` int(11) DEFAULT '1',
  PRIMARY KEY (`com_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pp_connected`
--

DROP TABLE IF EXISTS `pp_connected`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_connected` (
  `connected_id` int(11) NOT NULL AUTO_INCREMENT,
  `connected_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`connected_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pp_gender`
--

DROP TABLE IF EXISTS `pp_gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_gender` (
  `gender_id` int(11) NOT NULL AUTO_INCREMENT,
  `geder_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pp_history`
--

DROP TABLE IF EXISTS `pp_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `history_date` varchar(45) DEFAULT NULL,
  `history_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pp_hstatus`
--

DROP TABLE IF EXISTS `pp_hstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_hstatus` (
  `hstatus_id` int(11) NOT NULL AUTO_INCREMENT,
  `hstatus_tag` varchar(45) DEFAULT NULL,
  `hstatus_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`hstatus_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pp_metalink`
--

DROP TABLE IF EXISTS `pp_metalink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_metalink` (
  `mlink_id` int(11) NOT NULL AUTO_INCREMENT,
  `mlink_name` varchar(45) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL COMMENT 'post table : primary key',
  `page_id` int(11) DEFAULT NULL COMMENT 'page table : primary key',
  PRIMARY KEY (`mlink_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pp_option`
--

DROP TABLE IF EXISTS `pp_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(45) DEFAULT NULL,
  `option_value` varchar(45) DEFAULT NULL,
  `option_active` varchar(45) DEFAULT 'yes',
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pp_page`
--

DROP TABLE IF EXISTS `pp_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_tag` varchar(45) DEFAULT '',
  `page_name` varchar(45) DEFAULT '',
  `page_order` int(11) DEFAULT NULL,
  `page_display` varchar(45) DEFAULT NULL,
  `page_connected` varchar(45) DEFAULT NULL,
  `page_active` varchar(45) DEFAULT NULL,
  `page_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pp_pagemeta`
--

DROP TABLE IF EXISTS `pp_pagemeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_pagemeta` (
  `pmeta_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `pmeta_name` varchar(45) DEFAULT NULL,
  `pmeta_value` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pmeta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pp_post`
--

DROP TABLE IF EXISTS `pp_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_post` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pp_postmeta`
--

DROP TABLE IF EXISTS `pp_postmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_postmeta` (
  `pmeta_id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `pmeta_name` varchar(45) DEFAULT NULL,
  `pmeta_value` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pmeta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pp_role`
--

DROP TABLE IF EXISTS `pp_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pp_user`
--

DROP TABLE IF EXISTS `pp_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_user` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-07 15:33:47
