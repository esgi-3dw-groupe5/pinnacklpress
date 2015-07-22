CREATE DATABASE  IF NOT EXISTS `pinnacklpress` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pinnacklpress`;
-- MySQL dump 10.13  Distrib 5.6.23, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: pinnacklpress
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
-- Dumping data for table `pp_comment`
--

LOCK TABLES `pp_comment` WRITE;
/*!40000 ALTER TABLE `pp_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `pp_comment` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pp_connected`
--

LOCK TABLES `pp_connected` WRITE;
/*!40000 ALTER TABLE `pp_connected` DISABLE KEYS */;
/*!40000 ALTER TABLE `pp_connected` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pp_field`
--

DROP TABLE IF EXISTS `pp_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_field` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(45) NOT NULL,
  `field_type` varchar(25) NOT NULL,
  `field_domname` varchar(45) NOT NULL,
  `field_domid` varchar(45) NOT NULL,
  `field_value` varchar(100) NOT NULL,
  `field_placeholder` varchar(100) NOT NULL,
  PRIMARY KEY (`field_id`),
  KEY `field_name` (`field_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pp_field`
--

LOCK TABLES `pp_field` WRITE;
/*!40000 ALTER TABLE `pp_field` DISABLE KEYS */;
INSERT INTO `pp_field` VALUES (1,'name','text','name','email','alexis.thorel@gmail.com',''),(2,'password','password','password','password','plopplopplop','');
/*!40000 ALTER TABLE `pp_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pp_field_rs`
--

DROP TABLE IF EXISTS `pp_field_rs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_field_rs` (
  `field_rs_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `validator_id` int(11) NOT NULL,
  PRIMARY KEY (`field_rs_id`),
  KEY `field_id` (`field_id`,`validator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pp_field_rs`
--

LOCK TABLES `pp_field_rs` WRITE;
/*!40000 ALTER TABLE `pp_field_rs` DISABLE KEYS */;
INSERT INTO `pp_field_rs` VALUES (1,1,1),(2,2,2);
/*!40000 ALTER TABLE `pp_field_rs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pp_fieldmeta`
--

DROP TABLE IF EXISTS `pp_fieldmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_fieldmeta` (
  `fmeta_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `fmeta_name` varchar(45) NOT NULL,
  `fmeta_value` varchar(45) NOT NULL,
  PRIMARY KEY (`fmeta_id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pp_fieldmeta`
--

LOCK TABLES `pp_fieldmeta` WRITE;
/*!40000 ALTER TABLE `pp_fieldmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `pp_fieldmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pp_form`
--

DROP TABLE IF EXISTS `pp_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_form` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(25) NOT NULL,
  `form_action` varchar(45) NOT NULL,
  `form_method` varchar(25) NOT NULL,
  `form_target` varchar(25) NOT NULL,
  `form_enctype` varchar(25) NOT NULL,
  PRIMARY KEY (`form_id`),
  UNIQUE KEY `form_name` (`form_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pp_form`
--

LOCK TABLES `pp_form` WRITE;
/*!40000 ALTER TABLE `pp_form` DISABLE KEYS */;
INSERT INTO `pp_form` VALUES (1,'inscription','login','post','','');
/*!40000 ALTER TABLE `pp_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pp_form_rs`
--

DROP TABLE IF EXISTS `pp_form_rs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_form_rs` (
  `form_rs_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  PRIMARY KEY (`form_rs_id`),
  KEY `form_id` (`form_id`,`field_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pp_form_rs`
--

LOCK TABLES `pp_form_rs` WRITE;
/*!40000 ALTER TABLE `pp_form_rs` DISABLE KEYS */;
INSERT INTO `pp_form_rs` VALUES (1,1,1),(2,1,2);
/*!40000 ALTER TABLE `pp_form_rs` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pp_gender`
--

LOCK TABLES `pp_gender` WRITE;
/*!40000 ALTER TABLE `pp_gender` DISABLE KEYS */;
/*!40000 ALTER TABLE `pp_gender` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pp_history`
--

LOCK TABLES `pp_history` WRITE;
/*!40000 ALTER TABLE `pp_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `pp_history` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pp_hstatus`
--

LOCK TABLES `pp_hstatus` WRITE;
/*!40000 ALTER TABLE `pp_hstatus` DISABLE KEYS */;
/*!40000 ALTER TABLE `pp_hstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pp_linkmeta`
--

DROP TABLE IF EXISTS `pp_linkmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_linkmeta` (
  `mlink_id` int(11) NOT NULL AUTO_INCREMENT,
  `mlink_name` varchar(45) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL COMMENT 'post table : primary key',
  `page_id` int(11) DEFAULT NULL COMMENT 'page table : primary key',
  PRIMARY KEY (`mlink_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pp_linkmeta`
--

LOCK TABLES `pp_linkmeta` WRITE;
/*!40000 ALTER TABLE `pp_linkmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `pp_linkmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pp_menu`
--

DROP TABLE IF EXISTS `pp_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_menu` (
  `pp_menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `pp_menu_name` varchar(45) DEFAULT NULL,
  `pp_menu_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pp_menu_id`),
  KEY `pp_menu_name` (`pp_menu_name`),
  KEY `pp_menu_status` (`pp_menu_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pp_menu`
--

LOCK TABLES `pp_menu` WRITE;
/*!40000 ALTER TABLE `pp_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `pp_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pp_menu_rs`
--

DROP TABLE IF EXISTS `pp_menu_rs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_menu_rs` (
  `menu_rs_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_rs_id`),
  KEY `menu_id` (`menu_id`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pp_menu_rs`
--

LOCK TABLES `pp_menu_rs` WRITE;
/*!40000 ALTER TABLE `pp_menu_rs` DISABLE KEYS */;
/*!40000 ALTER TABLE `pp_menu_rs` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`option_id`),
  KEY `option_name` (`option_name`),
  KEY `option_value` (`option_value`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pp_option`
--

LOCK TABLES `pp_option` WRITE;
/*!40000 ALTER TABLE `pp_option` DISABLE KEYS */;
INSERT INTO `pp_option` VALUES (1,'sitename','Pinnackl',NULL),(2,'sitedescription','le site de l\'info',NULL),(3,'siteurl','http://127.0.0.1/pinnacklpress/',NULL),(4,'theme','pure','yes');
/*!40000 ALTER TABLE `pp_option` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`page_id`),
  KEY `page_display` (`page_display`),
  KEY `page_connected` (`page_connected`),
  KEY `page_tag` (`page_tag`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pp_page`
--

LOCK TABLES `pp_page` WRITE;
/*!40000 ALTER TABLE `pp_page` DISABLE KEYS */;
INSERT INTO `pp_page` VALUES (17,'test','Test',0,'Yes','visitor','Yes',''),(14,'index','Acceuil',1,'Yes','visitor','Yes',''),(15,'inscription','Inscription',3,'Yes','visitor','Yes',''),(16,'term-of-use','Term of use',0,'Yes','visitor','Yes','');
/*!40000 ALTER TABLE `pp_page` ENABLE KEYS */;
UNLOCK TABLES;

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
  `pmeta_value` text,
  PRIMARY KEY (`pmeta_id`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pp_pagemeta`
--

LOCK TABLES `pp_pagemeta` WRITE;
/*!40000 ALTER TABLE `pp_pagemeta` DISABLE KEYS */;
INSERT INTO `pp_pagemeta` VALUES (3,1,'content','[{\"line\":[{\"gridClass\":\"grid-7\",\"gridModule\":\"[text]\",\"gridContent\":\"test\"},{\"gridClass\":\"grid-7\",\"gridModule\":\"null\",\"gridContent\":\"null\"},{\"gridClass\":\"grid-7\",\"gridModule\":\"null\",\"gridContent\":\"null\"},{\"gridClass\":\"grid-7\",\"gridModule\":\"null\",\"gridContent\":\"null\"},{\"gridClass\":\"grid-7\",\"gridModule\":\"null\",\"gridContent\":\"null\"},{\"gridClass\":\"grid-7\",\"gridModule\":\"null\",\"gridContent\":\"null\"},{\"gridClass\":\"grid-7\",\"gridModule\":\"null\",\"gridContent\":\"null\"}]}]'),(4,14,'content','[{\"line\":[{\"gridClass\":\"grid-4_4\",\"gridModule\":\"[text]\",\"gridContent\":\"<p></p><p>Conditions dâ€™utilisation</p><p></p>\\n<p><br>\\n</p>\\n<p><a href=\\\"https://wikimediafoundation.org/wiki/File:Wikimedia-logo.svg\\\" class=\\\"image\\\"><img alt=\\\"Wikimedia-logo.svg\\\" src=\\\"https://upload.wikimedia.org/wikipedia/commons/thumb/8/81/Wikimedia-logo.svg/75px-Wikimedia-logo.svg.png\\\" data-file-width=\\\"1024\\\" data-file-height=\\\"1024\\\" height=\\\"75\\\" width=\\\"75\\\"></a></p>\\n<p></p><center>Ceci est un rÃ©sumÃ© des Conditions dâ€™utilisation.</center><p></p>\\n<p>Avertissement&nbsp;:\\n ce rÃ©sumÃ© ne fait pas partie des Conditions dâ€™utilisation et n\'a pas \\nvaleur juridique. C\'est uniquement un guide pratique qui aide Ã  leur \\ncomprÃ©hension, dans un langage plus aisÃ© Ã  lire que le langage juridique\\n du document complet.</p>\\n<p><strong>Une partie de notre mission est</strong>&nbsp;:\\n</p><ul><li> d\'<strong>offrir la possibilitÃ© et inciter</strong> les personnes partout\\n dans le monde Ã  dÃ©velopper du contenu Ã©ducatif, soit en le publiant \\nsous licences libres, soit en le dÃ©diant au domaine public&nbsp;; </li><li> de <strong>diffuser</strong> ce contenu efficacement et globalement, et ce gratuitement.</li></ul>\\n<p><br>\\n<strong>Vous Ãªtes libre de</strong>&nbsp;:\\n</p>\\n<ul><li> <strong>Lire</strong> nos articles et autres mÃ©dias, gratuitement.</li><li> <strong>RÃ©utiliser</strong> nos articles et autres mÃ©dias sous licences libres.</li><li> <strong>Contribuer Ã </strong> et <strong>modifier</strong> nos diffÃ©rents sites et Projets sous licences libres.</li></ul>\\n<p><br>\\n<strong>Sous les conditions suivantes</strong>&nbsp;:\\n</p>\\n<ul><li> <strong>ResponsabilitÃ©</strong> â€” Vous Ãªtes responsables de vos modifications (puisque que nous ne faisons quâ€™<em>hÃ©berger</em> votre contenu).</li><li> <strong>Courtoisie</strong> â€” Vous restez poli, courtois et respectueux, et vous ne vous livrez pas Ã  des attaques contre les autres personnes.</li><li> <strong>Comportement rÃ©gulier</strong> â€” Vous ne violez pas les rÃ¨gles sur le\\n copyright ou le droit d\'auteur, et ne commettez pas d\'actions \\ndÃ©lictueuses ou inappropriÃ©es.</li><li> <strong>Pas de nuisance</strong> â€” Vous ne cherchez pas Ã  porter prÃ©judice Ã  notre infrastructure technique.</li><li> <strong>Conditions dâ€™utilisation et rÃ¨glement</strong> â€” Vous adhÃ©rez aux \\nConditions dâ€™utilisation ci-dessous aux rÃ¨glements applicables de la \\ncommunautÃ© quand vous visitez nos sites ou que vous participez Ã  nos \\ncommunautÃ©s.</li></ul>\\n<p><br>\\n<strong>Ã‰tant bien entendu que</strong>&nbsp;:\\n</p>\\n<ul><li> <strong>Vos contributions sont libres</strong> â€” vous placez vos \\ncontributions et modifications de nos sites sous licences libres et \\nouvertes (Ã  moins que votre contribution ne soit dans le domaine \\npublic).</li><li> <strong>Absence d\'avis professionnel</strong> â€” le contenu de nos articles et\\n de nos autres projets est uniquement Ã  titre d\'information, et ne \\nconstitue pas l\'avis d\'un professionnel.</li></ul><p></p> \\n\\n\\n\\n<p><br><br>\\n<span style=\\\"font-size: 150%\\\">Nos conditions dâ€™utilisation</span>\\n</p><p><em><strong>Imaginez un monde dans lequel chaque Ãªtre humain peut \\nlibrement obtenir et partager des connaissances. Ceci est notre \\nengagement.</strong></em> â€“ <a href=\\\"https://wikimediafoundation.org/wiki/Vision\\\" title=\\\"Vision\\\">Notre vision.</a>\\n</p><p>Bienvenue sur Wikimedia&nbsp;! La â€œ<em>Wikimedia Foundation, Inc.</em>â€ (Â«&nbsp;nous&nbsp;Â») est une association caritative Ã  but non lucratif dont la <a href=\\\"https://wikimediafoundation.org/wiki/Mission_statement\\\" title=\\\"Mission statement\\\">mission</a> consiste Ã  donner aux gens du monde entier la possibilitÃ© et lâ€™envie de rassembler et de produire des contenus sous une <a href=\\\"https://en.wikipedia.org/wiki/fr:%C5%92uvre_libre\\\" class=\\\"extiw\\\" title=\\\"w:fr:Å’uvre libre\\\">licence libre</a> ou dans le domaine public, et de les propager de maniÃ¨re efficace et globale, gratuitement.\\n</p><p>Afin de soutenir notre communautÃ© active, nous fournissons les \\ninfrastructures essentielles et le cadre organisationnel permettant le \\ndÃ©veloppement de Projects wiki multilingues, leur Ã©ditions (comme \\nexpliquÃ© <a href=\\\"https://wikimediafoundation.org/wiki/Our_projects\\\" title=\\\"Our projects\\\">ici</a>)\\n et dâ€™autres efforts utiles Ã  cette mission. Nous nous battons pour \\ncrÃ©er et maintenir les contenus Ã©ducatifs et informatifs de nos Projets Ã \\n disposition sur Internet, gratuitement et Ã  jamais.\\n</p><p>Nous vous (Â«&nbsp;vous&nbsp;Â» ou Â«&nbsp;lâ€™utilisateur&nbsp;Â») souhaitons la bienvenue\\n en tant que lecteur, modificateur, auteur ou contributeur des Projets \\nWikimedia, et nous vous encourageons Ã  rejoindre la communautÃ© \\nWikimedia. NÃ©anmoins, avant de participer, nous vous demandons de bien \\nvouloir lire et accepter les Conditions dâ€™utilisation suivantes (Â«&nbsp;les \\nConditions dâ€™utilisation&nbsp;Â»).\\n</p>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"R.C3.A9sum.C3.A9\\\">RÃ©sumÃ©</span></h2>\\n<p>Ces Conditions dâ€™utilisation vous informent sur les services de la <em>Wikimedia Foundation</em>\\n accessibles au public, sur notre relation avec vous en tant \\nquâ€™utilisateur, et sur les droits et responsabilitÃ©s qui guident chacun \\nde nous. Nous voulons que vous sachiez que nous hÃ©bergeons une quantitÃ© \\nincroyable de contenus Ã©ducatifs et informatifs, qui a Ã©tÃ© entiÃ¨rement \\napportÃ©e et rendue possible par des utilisateurs tels que vous-mÃªme. En \\nrÃ¨gle gÃ©nÃ©rale nous nâ€™apportons, ni ne surveillons, ni ne supprimons de \\ncontenu (Ã  la rare exception des politiques telles que ces Conditions \\ndâ€™utilisation ou pour se conformer lÃ©galement aux avis du <a href=\\\"https://en.wikipedia.org/wiki/en:Digital_Millennium_Copyright_Act\\\" class=\\\"extiw\\\" title=\\\"w:en:Digital Millennium Copyright Act\\\">DMCA</a> amÃ©ricain sur le droit dâ€™auteur&nbsp;; voir en franÃ§ais&nbsp;: <a href=\\\"https://en.wikipedia.org/wiki/fr:Digital_Millennium_Copyright_Act\\\" class=\\\"extiw\\\" title=\\\"w:fr:Digital Millennium Copyright Act\\\">DMCA</a>).\\n Cela signifie que le contrÃ´le Ã©ditorial est entre vos mains et celles \\nde vos collÃ¨gues utilisateurs qui crÃ©ent et gÃ¨rent le contenu. Nous ne \\nfaisons quâ€™hÃ©berger ce contenu.\\n</p><p>La communautÃ©&nbsp;â€” le rÃ©seau des utilisateurs qui constamment \\nbÃ¢tissent et utilisent les divers sites ou Projets&nbsp;â€” est la principale \\nressource Ã  travers laquelle les buts de la mission sont rÃ©alisÃ©s. La \\ncommunautÃ© contribue Ã  nos sites et aide Ã  les rÃ©gir. La communautÃ© a la\\n responsabilitÃ© essentielle de crÃ©er et faire appliquer des politiques \\nsur les Ã©ditions spÃ©cifiques des Projets (telles ques les Ã©ditions \\nlinguistiques pour le Projet WikipÃ©dia ou lâ€™Ã©dition multilingue \\nWikimedia Commons).\\n</p><p>Vous Ãªtes encouragÃ© Ã  participer en tant que contributeur, \\nÃ©diteur ou auteur, mais vous devez suivre les rÃ¨gles qui gouvernent \\nchacune des Ã©ditions indÃ©pendantes des Projets. Le plus grand de nos \\nProjets est WikipÃ©dia, mais nous hÃ©bergeons Ã©galement dâ€™autres Projets, \\nchacun avec des objectifs diffÃ©rents et des mÃ©thodes de travail \\ndiffÃ©rentes. Chaque Ã©dition de Projet a une Ã©quipe de contributeurs, \\nmodificateurs et auteurs qui travaillent ensemble pour crÃ©er et gÃ©rer le\\n contenu de cette Ã©dition de Projet. Vous Ãªtes encouragÃ© Ã  rejoindre ces\\n Ã©quipes et travailler avec eux pour amÃ©liorer ces Projets. Ã‰tant donnÃ© \\nque notre but est de crÃ©er du contenu librement accessible au public, \\nnous requÃ©rons gÃ©nÃ©ralement que tout le contenu auquel vous contribuez \\nsoit disponible sous une licence libre ou dans le domaine public.\\n</p><p>Soyez conscient que vous Ãªtes lÃ©galement responsable de toutes \\nvos contributions, Ã©ditions ou rÃ©utilisations des contenus Wikimedia au \\nregard des lois des Ã‰tats-Unis dâ€™AmÃ©rique ou des autres lois applicables\\n (qui peuvent inclure les lois oÃ¹ vous vivez ou de lâ€™endroit oÃ¹ vous \\nvisionnez ou Ã©ditez le contenu). Ceci signifie quâ€™il est important que \\nvous fassiez attention lorsque vous postez du contenu. Au regard de \\ncette responsabilitÃ©, nous avons quelques rÃ¨gles sur ce que vous ne \\npouvez pas publier, la plupart Ã©tant soit pour votre propre protection \\nsoit pour la protection dâ€™autres utilisateurs semblables Ã  vous-mÃªme. \\nVeuillez garder Ã  lâ€™esprit que le contenu que nous hÃ©bergeons a pour \\nfinalitÃ© de lâ€™information gÃ©nÃ©rale seulement, donc que si vous avez \\nbesoin dâ€™un conseil expert sur une question prÃ©cise (par exemple des \\nquestions mÃ©dicales, lÃ©gales ou financiÃ¨res), vous devriez rechercher \\nlâ€™aide dâ€™un professionnel licenciÃ© ou qualifiÃ©. Nous incluons Ã©galement \\ndâ€™autres notices ou dÃ©nis importants, donc veuillez lire entiÃ¨rement ces\\n Conditions dâ€™utilisation.\\n</p><p>Pour plus de clartÃ©, d\'autres organisations, telles que <a href=\\\"https://wikimediafoundation.org/wiki/Chapters/en\\\" title=\\\"Chapters/en\\\" class=\\\"mw-redirect\\\">sections locales de Wikimedia</a>\\n et associations, qui peuvent partager la mÃªme mission sont cependant \\njuridiquement indÃ©pendantes et distinctes de la Wikimedia Foundation et \\nnâ€™ont aucune responsabilitÃ© pour les opÃ©rations sur le site Web ou son \\ncontenu. <br></p><p><br></p><h2><span class=\\\"mw-headline\\\" id=\\\"1._Nos_services\\\">1. Nos services</span></h2>\\n<p>La Wikimedia Foundation a pour but dâ€™encourager la croissance, le \\ndÃ©veloppement et la distribution de contenu libre multilingue, et \\ndâ€™hÃ©berger entiÃ¨rement le contenu de ces Projets basÃ©s sur des wikis Ã  \\ndestination du public pour un usage gratuit. Notre rÃ´le est dâ€™hÃ©berger \\nquelques-uns des plus grands Projets de rÃ©fÃ©rence Ã©ditÃ©s \\ncollaborativement dans le monde, ce qui peut Ãªtre trouvÃ© sur <a class=\\\"external text\\\" href=\\\"http://www.wikimedia.org\\\">cette page</a>.\\n Cependant, nous nâ€™agissons quâ€™en tant que service dâ€™hÃ©bergement, en \\nmaintenant une infrastructure et un cadre organisationnel qui permet Ã  \\nnos utilisateurs de construire les Projets Wikimedia en contribuant et \\nen Ã©ditant le contenu eux-mÃªmes. En raison de notre unique rÃ´le, il y a \\ncertaines choses dont vous devez Ãªtre conscient en considÃ©rant notre \\nrelation avec vous, les Projets et les autres utilisateurs&nbsp;:\\n</p>\\n<ol style=\\\"list-style-type: lower-alpha\\\"><li><b>Nous nâ€™exerÃ§ons pas de rÃ´le Ã©ditorial&nbsp;: </b>puisque\\n les Projets Wikimedia sont Ã©ditÃ©s collaborativement, tout le contenu \\nque nous hÃ©bergeons est fourni par des utilisateurs comme vous, et nous \\nnâ€™exerÃ§ons pas de rÃ´le Ã©ditorial. Ceci signifie que gÃ©nÃ©ralement nous ne\\n surveillons ni ne modifions aucun contenu des Projets Wikimedia, et \\nnous ne prenons pas de responsabilitÃ© quant Ã  ce contenu. De faÃ§on \\nsimilaire, nous nâ€™approuvons pas les opinions exprimÃ©es via nos services\\n et nous ne prÃ©sentons ou garantissons aucune vÃ©ritÃ©, prÃ©cision ou \\nfiabilitÃ© des contenus envoyÃ©s par la communautÃ©. En revanche, nous \\nfournissons simplement lâ€™accÃ¨s au contenu que vos collÃ¨gues utilisateurs\\n ont apportÃ© et Ã©ditÃ©.</li><li><b>Vous Ãªtes responsable de vos propres actions&nbsp;: </b>vous Ãªtes \\nlÃ©galement responsable de vos modifications et des contributions sur les\\n Projets Wikimedia, donc pour votre propre protection, vous devriez \\nfaire preuve de prudence et Ã©viter de mettre en ligne tout contenu qui \\npeut entraÃ®ner une responsabilitÃ© civile ou criminelle sous le coup de \\ntoute loi applicable. Pour Ãªtre plus prÃ©cis, les lois applicables \\nincluent au moins les lois des Ã‰tats-Unis dâ€™AmÃ©rique. Bien qu\'il soit \\npossible que nous ne soyons pas dâ€™accord avec de telles actions, nous \\navertissons les Ã©diteurs et contributeurs que des autoritÃ©s peuvent \\nchercher Ã  vous appliquer les lois dâ€™autres pays, comme les lois locales\\n du lieu oÃ¹ vous habitez ou celles du lieu oÃ¹ vous visualisez ou \\nmodifiez le contenu. WMF ne peut gÃ©nÃ©ralement pas offrir de protection, \\ngarantie, immunitÃ© ou indemnisation.</li></ol>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"2._Politique_de_confidentialit.C3.A9\\\">2. Politique de confidentialitÃ©</span></h2>\\n<p>Nous vous demandons de consulter attentivement les termes de notre <a href=\\\"https://wikimediafoundation.org/wiki/Politique_de_confidentialit%C3%A9\\\" title=\\\"Politique de confidentialitÃ©\\\" class=\\\"mw-redirect\\\">politique de confidentialitÃ©</a>,\\n afin que vous soyez conscient de la faÃ§on par laquelle nous collectons \\net utilisons vos informations personnelles. Puisque nos services sont \\nutilisÃ©s par des personnes partout dans le monde, des informations \\npersonnelles que nous collectons pourraient Ãªtre stockÃ©es et traitÃ©es \\naux Ã‰tats-Unis dâ€™AmÃ©rique, ou dans tout autre pays oÃ¹ nous ou nos agents\\n maintiennent des Ã©tablissements. En utilisant nos services, vous \\nconsentez Ã  de tels transferts dâ€™informations hors de votre pays.\\n</p>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"3._Contenu_h.C3.A9berg.C3.A9\\\">3. Contenu hÃ©bergÃ©</span></h2>\\n<ol style=\\\"list-style-type: lower-alpha\\\"><li><b>Vous pourriez trouver certains Ã©lÃ©ments de contenu problÃ©matiques ou erronÃ©s&nbsp;:</b>\\n puisque nous fournissons un vaste ensemble de contenus qui sont \\nproduits ou rassemblÃ©s par des utilisateurs semblables Ã  vous, vous \\npourriez rencontrer des Ã©lÃ©ments que vous trouvez offensifs, erronÃ©s, \\nmenant dans de mauvaises directions, mal identifiÃ©s ou autrement \\nproblÃ©matiques. Nous demandons par consÃ©quent que vous utilisiez le bon \\nsens et votre propre jugement lorsque vous utilisez nos services.</li><li><b>Notre contenu nâ€™a pour but que de fournir des informations&nbsp;:</b> \\nBien que nous hÃ©bergions une grande quantitÃ© dâ€™informations qui relÃ¨vent\\n des domaines techniques, y compris le domaine mÃ©dical, juridique et \\nfinancier, le contenu nâ€™est proposÃ© quâ€™Ã  titre informatif. Il ne saurait\\n en aucun cas Ãªtre considÃ©rÃ© comme un avis professionnel. Veuillez vous \\nadresser Ã  des professionnels licenciÃ©s ou qualifiÃ©s dans le domaine \\napplicable plutÃ´t que dâ€™agir en fonction dâ€™informations, dâ€™opinions ou \\nde conseils contenus sur les sites Web de Projets.</li></ol>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"4._Restrictions_de_certaines_activit.C3.A9s\\\">4. Restrictions de certaines activitÃ©s</span></h2>\\n<p>Les Projets hÃ©bergÃ©s par la Fondation Wikimedia nâ€™existent que grÃ¢ce Ã \\n la communautÃ© vibrante dâ€™utilisateurs comme vous qui travaillent \\nensemble pour rÃ©diger, Ã©diter et organiser le contenu. Nous sommes \\nheureux de vous accueillir dans cette communautÃ©. Nous vous encourageons\\n Ã  Ãªtre civil et poli dans vos interactions avec la communautÃ©, Ã  agir \\nen toute bonne foi, et Ã  effectuer des corrections et contributions \\nvisant Ã  perpÃ©tuer la mission du Projet commun.\\n</p><p>Certaines activitÃ©s, quâ€™elles soient lÃ©gales ou illÃ©gales, \\npeuvent porter atteinte Ã  dâ€™autres utilisateurs et violer nos rÃ¨gles. \\nCertaines activitÃ©s peuvent Ã©galement mettre en cause votre \\nresponsabilitÃ©. Câ€™est la raison pour laquelle, pour vous protÃ©ger et \\nprotÃ©ger les autres utilisateurs, vous ne devez pas perpÃ©trer de telles \\nactivitÃ©s sur nos sites. Parmi ces activitÃ©s figurent le fait de&nbsp;:\\n</p>\\n<dl><dd> <b>Harceler et commettre des abus contre les autres utilisateurs&nbsp;:</b></dd></dl>\\n<dl><dd><dl><dd><ul><li> commettre du harcÃ¨lement, des menaces, des propos outrageants, des postages massifs indÃ©sirables ou du vandalisme&nbsp;; et</li><li> transmettre des courriers en chaÃ®ne, des dÃ©chets, ou des courriers massifs indÃ©sirables Ã  dâ€™autres utilisateurs.</li></ul></dd></dl></dd></dl>\\n<dl><dd> <b>Entrer en violation de la confidentialitÃ© des autres&nbsp;:</b></dd></dl>\\n<dl><dd><dl><dd><ul><li> enfreindre les droits de confidentialitÃ© des \\nautres selon les lois des Ã‰tats-Unis ou dâ€™autres lois applicables (qui \\npeuvent inclure les lois du lieu oÃ¹ vous vivez ou celle du lieu oÃ¹ vous \\nvisualisez ou modifiez le contenu)&nbsp;;</li><li> solliciter des informations personnellement identifiables dans des \\nbuts de harcÃ¨lement, dâ€™exploitation, de violation de confidentialitÃ©, ou\\n tout autre but promotionnel ou commercial non explicitement approuvÃ© \\npar la Wikimedia Foundation&nbsp;; et</li><li> solliciter des informations personnellement identifiables de \\nquiconque Ã¢gÃ© de moins de 18 ans dans un but illÃ©gal ou violer toute loi\\n applicable regardant la santÃ© et le bien-Ãªtre des personnes mineures.</li></ul></dd></dl></dd></dl>\\n<dl><dd> <b>Sâ€™engager dans de fausses dÃ©clarations, lâ€™usurpation dâ€™identitÃ© ou la fraude&nbsp;:</b></dd></dl>\\n<dl><dd><dl><dd><ul><li> publier intentionnellement ou en connaissance de cause tout contenu qui constitue un outrage ou une diffamation&nbsp;;</li><li> publier tout contenu qui est faux ou inexact dans lâ€™intention de tromper&nbsp;;</li><li> tenter dâ€™usurper lâ€™identitÃ© dâ€™un autre utilisateur ou individu, \\nvous reprÃ©senter avec une fausse affiliation avec tout individu ou toute\\n entitÃ©, ou utiliser le nom utilisateur dâ€™un autre utilisateur dans \\nlâ€™intention de tromper&nbsp;; et</li><li> sâ€™engager dans la fraude.</li></ul></dd></dl></dd></dl>\\n<dl><dd> <b>Commettre des infractions aux droits rÃ©servÃ©s&nbsp;:</b></dd></dl>\\n<dl><dd><dl><dd><ul><li> Enfreindre les droits dâ€™auteur, de marque de \\ncommerce, de brevet ou autres droits de propriÃ©tÃ© industrielle et \\ncommerciale dans le cadre des lois applicables.</li></ul></dd></dl></dd></dl>\\n<dl><dd> <b>DÃ©tourner lâ€™utilisation de nos services pour dâ€™autres fins illÃ©gales&nbsp;:</b></dd></dl>\\n<dl><dd><dl><dd><ul><li> publier de la pornographie impliquant des \\nmineurs ou tout autre contenu qui contrevient aux lois applicables  \\nconcernant la pornographie des enfants&nbsp;;</li><li> publier ou faire un trafic de contenus ou matÃ©riels obscÃ¨nes, illÃ©gaux en vertu des lois applicables&nbsp;; et</li><li> utiliser les services dâ€™une faÃ§on incompatible avec la loi applicable.</li></ul></dd></dl></dd></dl>\\n<dl><dd> <b>Faire un usage perturbant et illÃ©gal des Ã©quipements et services&nbsp;:</b></dd></dl>\\n<dl><dd><dl><dd><ul><li> Afficher ou distribuer un contenu contenant des\\n virus, des programmes malveillants, des vers informatiques, des chevaux\\n de Troie, des codes malveillants ou autres dispositifs pouvant porter \\natteinte Ã  notre infrastructure ou systÃ¨me technique ou Ã  ceux des \\nutilisateurs.</li><li> Faire un usage automatisÃ© du site qui est abusif ou destructeur \\npour les services et qui nâ€™a pas Ã©tÃ© avalisÃ© par la communautÃ© \\nWikimedia.</li><li> Perturber les services en plaÃ§ant une charge excessive sur le site \\nWeb dâ€™un Projet, ou sur les rÃ©seaux ou serveurs connectÃ©s au site Web \\ndâ€™un Projet.</li><li> Perturber les services en inondant un site Web de Projet par des \\ncommunications ou autres trafics qui ne dÃ©montrent pas de tentative \\ncrÃ©dible dâ€™utiliser le site Web de Projet dans le but qui est le sien.</li><li> Ã‰valuer sciemment, saboter ou utiliser lâ€™une quelconque des zones \\nnon publiques de nos systÃ¨mes informatiques sans autorisation.</li><li> VÃ©rifier, scanner ou tester la vulnÃ©rabilitÃ© de lâ€™un quelconque de \\nnos systÃ¨mes ou rÃ©seaux techniques sauf si lâ€™ensemble des conditions \\nsuivantes sont remplies&nbsp;:</li></ul></dd></dl></dd></dl>\\n<dl><dd><dl><dd><dl><dd><ul><li>De telles actions nâ€™abusent pas de maniÃ¨re excessive ni ne perturbent nos systÃ¨mes ou rÃ©seaux techniques.</li><li>De telles actions ne sont pas perpÃ©trÃ©es Ã  des fins de profit personnel (Ã  lâ€™exception de la rÃ©tribution de votre travail).</li><li>Vous signaliez lâ€™ensemble des vulnÃ©rabilitÃ©s aux dÃ©veloppeurs MediaWiki (ou vous les rÃ©solviez vous-mÃªme).</li><li>Vous ne perpÃ©triez pas de telles actions dans un but malveillant ou destructeur.</li></ul></dd></dl></dd></dl></dd></dl>\\n<dl><dd><b>Contributions rÃ©munÃ©rÃ©es sans divulgation</b></dd></dl>\\n<dl><dd><dl><dd>Les prÃ©sentes Conditions dâ€™utilisation interdisent de \\nsâ€™engager dans des activitÃ©s trompeuses, y compris une dÃ©claration \\ninexacte dâ€™affiliation, une usurpation dâ€™identitÃ© et des actes \\nfrauduleux. Pour garantir le respect de ces obligations, vous devez \\ndivulguer lâ€™identitÃ© de votre employeur, de votre client et de votre \\naffiliation relativement Ã  toute contribution Ã  tout projet Wikimedia \\npour laquelle vous percevez, ou espÃ©rez percevoir, une rÃ©munÃ©ration. \\nVous devez procÃ©der Ã  cette divulgation au moins dâ€™une des maniÃ¨res \\nsuivantes&nbsp;:</dd></dl></dd></dl>\\n<dl><dd><dl><dd><ul><li>par une dÃ©claration sur votre page dâ€™utilisateur,</li><li>par une dÃ©claration sur la page de discussion qui accompagne toute contribution rÃ©munÃ©rÃ©e, ou</li><li>par une dÃ©claration sur le rÃ©sumÃ© des rÃ©visions qui accompagne toute contribution rÃ©munÃ©rÃ©e.</li></ul></dd></dl></dd></dl>\\n<dl><dd><dl><dd>La lÃ©gislation en vigueur, ou les politiques et \\ndirectives de la communautÃ© et de la Fondation, notamment celles qui \\nrÃ©gissent les conflits dâ€™intÃ©rÃªts, peuvent limiter davantage les \\ncontributions rÃ©munÃ©rÃ©es ou exiger une divulgation plus dÃ©taillÃ©e. </dd><dd>Un Projet de la communautÃ© Wikimedia peut adopter une politique \\nalternative de divulgation des contributions rÃ©munÃ©rÃ©es. Si un Projet \\nadopte une politique de divulgation alternative, vous pouvez vous \\nconformer Ã  celle-ci au lieu des exigences de la prÃ©sente section en \\ncontribuant audit Projet. Une politique alternative pour les \\ncontributions rÃ©munÃ©rÃ©es ne se substituera aux prÃ©sentes conditions que \\nsi elle est approuvÃ©e par la communautÃ© chargÃ©e du Projet et mentionnÃ©e \\nsur la <a href=\\\"https://meta.wikimedia.org/wiki/Alternative_paid_contribution_disclosure_policies\\\" class=\\\"extiw\\\" title=\\\"m:Alternative paid contribution disclosure policies\\\">page de politique de divulgation alternative</a>.</dd></dl></dd></dl>\\n<dl><dd><dl><dd>Pour de plus amples informations, veuillez consulter nos <a href=\\\"https://meta.wikimedia.org/wiki/Terms_of_use/FAQ_on_paid_contributions_without_disclosure/fr\\\" class=\\\"extiw\\\" title=\\\"m:Terms of use/FAQ on paid contributions without disclosure/fr\\\">questions et rÃ©ponses sur la divulgation des contributions rÃ©munÃ©rÃ©es</a>.</dd></dl></dd></dl>\\n<p>Nous nous rÃ©servons le droit de faire respecter ce qui prÃ©cÃ¨de conformÃ©ment aux prÃ©sentes conditions.\\n</p>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"5._S.C3.A9curit.C3.A9_des_mots_de_passe\\\">5. SÃ©curitÃ© des mots de passe</span></h2>\\n<p>Vous Ãªtes responsable de la protection de votre propre mot de passe et ne devez jamais le divulguer Ã  des tiers.\\n</p>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"6._Marques_commerciales\\\">6. Marques commerciales</span></h2>\\n<p>Si vous bÃ©nÃ©ficiez dâ€™une grande latitude concernant la rÃ©utilisation \\ndu contenu des sites Web de Projets, il est important pour la Fondation \\nWikimedia de protÃ©ger ses droits de propriÃ©tÃ© industrielle et \\ncommerciale de faÃ§on Ã  protÃ©ger ses utilisateurs contre les usurpations \\nfrauduleuses. Câ€™est pourquoi nous vous demandons de respecter nos \\nmarques de commerce. Toutes les marques de commerce de la Fondation \\nWikimedia appartiennent Ã  la Fondation Wikimedia, et toutes les \\nutilisations de noms commerciaux, marques de commerce, marques de \\nservice, logos ou noms de domaine doivent Ãªtres conformes aux prÃ©sentes \\nainsi quâ€™Ã  la <a href=\\\"https://wikimediafoundation.org/wiki/Trademark_Policy\\\" title=\\\"Trademark Policy\\\" class=\\\"mw-redirect\\\">Politique relative aux marques de commerce</a>.\\n</p>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"7._Licences_applicables_au_contenu\\\">7. Licences applicables au contenu</span></h2>\\n<p>Afin de faire croÃ®tre les biens communs de connaissance et de culture\\n libres, tous les utilisateurs qui contribuent aux Projets doivent \\naccorder au public gÃ©nÃ©ral des permissions Ã©tendues de redistribuer et \\nrÃ©utiliser leurs contributions librement, tant que cette utilisation \\nreste proprement attribuÃ©e et que la mÃªme libertÃ© de rÃ©utiliser et \\nredistribuer est accordÃ©e Ã  toutes les Å“uvres dÃ©rivÃ©es. En gardant notre\\n but de fournir des informations libres Ã  une audience la plus large \\npossible, nous requÃ©rons que, quand cela est nÃ©cessaire, tous les \\ncontenus soumis soient placÃ©s sous une licence leur permettant dâ€™Ãªtre \\nrÃ©utilisables par quiconque voudrait y accÃ©der.\\n</p><p>Vous Ãªtes dâ€™accord avec les obligations de licence suivantes&nbsp;:\\n</p>\\n<ol style=\\\"list-style-type: lower-alpha\\\"><li><b>Texte dont vous dÃ©tenez les droits dâ€™auteur&nbsp;:</b> lorsque vous publiez du texte dont vous dÃ©tenez les droits dâ€™auteur, vous acceptez de la placer sous les deux licences&nbsp;:\\n<ul><li> <a rel=\\\"nofollow\\\" class=\\\"external text\\\" href=\\\"http://creativecommons.org/licenses/by-sa/3.0/\\\"><i>Creative Commons Attribution-ShareAlike 3.0 Unported License</i></a> (â€œCC BY-SAâ€)&nbsp;; et</li><li> <a rel=\\\"nofollow\\\" class=\\\"external text\\\" href=\\\"http://www.gnu.org/copyleft/fdl.html\\\"><i>GNU Free Documentation License</i></a> (â€œGFDLâ€) (non versionÃ©e, sans section invariante, ni texte initial de couverture, ni texte de fin de couverture).</li></ul>\\n(Les rÃ©utilisateurs peuvent satisfaire Ã  lâ€™une ou lâ€™autre des licences ou aux deux.)<br><br>\\n\\nLa seule exception est lorsque lâ€™Ã©dition ou le caractÃ¨re du Projet \\nnÃ©cessite une licence diffÃ©rente. Dans ce cas, vous consentez Ã  accorder\\n une licence pour tous les textes que vous fournissez dans le cadre de \\nladite licence. Par exemple, au moment de la publication des prÃ©sentes \\nConditions dâ€™utilisation, English Wikinews prÃ©voit que tous les contenus\\n textuels soient accordÃ©s en licence en fonction de la Licence gÃ©nÃ©rique\\n Creative Commons Attribution 2.5 (CC BY 2.5) et ne requiÃ¨rent pas une \\nlicence double avec GFDL.<br><br>\\n\\nVeuillez noter que les conditions de ces licences autorisent \\neffectivement des utilisations commerciales de vos contributions, tant \\nque de telles utilisations se conforment avec ces conditions.\\n\\n</li><li><b>Attribution&nbsp;:</b> lâ€™attribution est une partie importante de\\n ces licences. Nous la considÃ©rons comme donner le crÃ©dit Ã  qui ce \\ncrÃ©dit est dÃ»&nbsp;â€” aux auteurs tels que vous-mÃªme. Lorsque vous contribuez \\ndu texte, vous acceptez dâ€™en Ãªtre crÃ©ditÃ© comme auteur dâ€™une quelconque \\ndes faÃ§ons suivantes&nbsp;:\\n<ol style=\\\"list-style:lower-roman\\\"><li>par un hyperlien (si possible) ou une URL vers lâ€™article auquel vous\\n avez contribuÃ© (puisque chaque article comporte une page historique qui\\n liste les auteurs et modificateurs)&nbsp;;</li><li>par un hyperlien (si possible) ou une URL vers une copie en ligne \\nalternative et stable, qui est librement accessible et en conformitÃ© \\navec la licence, et qui donne crÃ©dit aux auteurs dâ€™une faÃ§on Ã©quivalente\\n au crÃ©dit donnÃ© sur le site Internet du Projet&nbsp;; ou</li><li>par une liste de tous les auteurs (mais veuillez noter que toute \\nliste dâ€™auteurs pourrait Ãªtre filtrÃ©e pour exclure des contributions \\ntrÃ¨s petites ou inappropriÃ©es).</li></ol>\\n</li><li><b>Texte importÃ©&nbsp;:</b> Vous pouvez importer un texte que vous \\navez trouvÃ© ailleurs ou que vous avez coÃ©crit avec dâ€™autres, mais dans \\nce cas vous garantissez que le texte est disponible conformÃ©ment Ã  des \\nconditions compatibles avec la licence CC BY-SA 3.0 (ou, tel quâ€™indiquÃ© \\nplus haut, Ã  une autre licence lorsque celle-ci est exceptionnellement \\nrequise par lâ€™Ã©dition ou le caractÃ¨re du Projet) (Â«&nbsp;CC BY-SA&nbsp;Â»). Tout \\ncontenu uniquement disponible par le biais du GFDL est interdit.</li><br><br>\\nVous acceptez que, si vous importez du texte sous une licence CC BY-SA \\nqui requiert une attribution, vous devez en crÃ©diter le ou les auteurs \\ndâ€™une faÃ§on raisonnable. LÃ  oÃ¹ un tel crÃ©dit est communÃ©ment donnÃ© au \\nmoyen des historiques de page (par exemple la copie interne Ã  \\nWikimedia), il est suffisant de donner lâ€™attribution dans le rÃ©sumÃ© de \\nmodification, qui est enregistrÃ© dans lâ€™historique de page, lors de \\nlâ€™importation du texte. Les nÃ©cessitÃ©s dâ€™attribution sont parfois trop \\nintrusives dans certaines circonstances particuliÃ¨res (indÃ©pendamment de\\n la licence) et il peut exister des cas oÃ¹ la communautÃ© Wikimedia \\ndÃ©cide que le texte importÃ© ne peut pas Ãªtre utilisÃ© pour cette raison.\\n<li><b>MÃ©dia non textuel&nbsp;:</b> Les mÃ©dias non textuels des Projets sont \\naccessibles par le biais de diverses licences qui tendent toutes Ã  \\npermettre une rÃ©utilisation et une redistribution sans restriction. \\nLorsque vous soumettez des mÃ©dias non textuels, vous consentez Ã  vous \\nconformer aux exigences des licences dÃ©crites dans notre <a href=\\\"https://wikimediafoundation.org/wiki/Resolution:Licensing_policy/fr\\\" title=\\\"Resolution:Licensing policy/fr\\\">Politique relative aux licences</a>\\n et de respecter les exigences liÃ©es Ã  lâ€™Ã©dition et au caractÃ¨re du \\nProjet spÃ©cifique auquel vous contribuez. RÃ©fÃ©rez-vous Ã©galement Ã  la <a href=\\\"https://commons.wikimedia.org/wiki/Commons:%C3%80_propos_des_licences\\\" class=\\\"extiw\\\" title=\\\"commons:Commons:Ã€ propos des licences\\\">Politique de licences Wikimedia Commons</a> pour obtenir plus dâ€™informations sur la soumission de mÃ©dias non textuels pour ce Projet.</li><li><b>Non-rÃ©vocation de licence&nbsp;:</b> Sauf Ã  ce que votre licence le \\nprÃ©voie, vous consentez Ã  ne pas rÃ©voquer ou tenter de faire invalider, \\nde maniÃ¨re unilatÃ©rale, une licence que vous avez accordÃ©e en vertu des \\nprÃ©sentes Conditions dâ€™utilisation concernant les contenus textuels ou \\nnon textuels que vous avez soumis aux Projets ou fonctions Wikimedia, \\nmÃªme si vous rÃ©siliez nos services.</li><li><b>Contenu appartenant au domaine public&nbsp;:</b> Le contenu faisant \\npartie du domaine public est bienvenu&nbsp;! Il est important, cependant, que\\n vous confirmiez le statut de domaine public du contenu conformÃ©ment aux\\n lois des Ã‰tats-Unis dâ€™AmÃ©rique ainsi quâ€™aux lois de tout autre pays \\nselon les exigences de lâ€™Ã©dition spÃ©cifique du Projet. Lorsque vous \\nsoumettez un contenu faisant partie du domaine public, vous garantissez \\nque les informations appartiennent effectivement au domaine public et \\nconsentez Ã  signaler cette appartenance de maniÃ¨re adÃ©quate.</li><li><b>RÃ©utilisation&nbsp;:</b> la rÃ©utilisation du contenu que nous \\nhÃ©bergeons est bienvenue, bien que des exceptions existent pour le \\ncontenu limitÃ© contribuÃ© selon la rÃ¨gle amÃ©ricaine de â€œ<i>fair use</i>â€ \\nou bien des exceptions similaires relevant des lois sur le droit \\ndâ€™auteur. Toute rÃ©utilisation doit se conformer avec la ou les licences \\nsous-jacentes.<br><br>\\n\\nLorsque vous rÃ©utilisez ou redistribuez une page de texte dÃ©veloppÃ©e par\\n la communautÃ© Wikimedia, vous acceptez dâ€™en attribuer les auteurs dâ€™une\\n quelconque des faÃ§ons suivantes&nbsp;:\\n<ol style=\\\"list-style:lower-roman\\\"><li>par un hyperlien (si possible) ou une URL vers la page ou les pages \\nque vous rÃ©utilisez (puisque chaque page comporte une page historique \\nqui liste les auteurs et modificateurs)&nbsp;;</li><li>par un hyperlien (si possible) ou une URL vers une copie en ligne \\nalternative et stable, qui est librement accessible et en conformitÃ© \\navec la licence, et qui donne crÃ©dit aux auteurs dâ€™une faÃ§on Ã©quivalente\\n au crÃ©dit donnÃ© sur le site Internet du Projet&nbsp;; ou</li><li>par une liste de tous les auteurs (mais veuillez noter que toute \\nliste dâ€™auteurs pourrait Ãªtre filtrÃ©e pour exclure des contributions \\ntrÃ¨s petites ou inappropriÃ©es).</li></ol>\\n<p>Si le texte a Ã©tÃ© importÃ© dâ€™une autre source, il est possible que le \\ncontenu soit placÃ© sous une licence compatible CC BY-SA mais pas GFDL \\n(tel que dÃ©crit dans Â«&nbsp;Importation de texte&nbsp;Â» ci-dessus). Dans ce cas, \\nvous acceptez de vous conformer avec la licence compatible CC BY-SA et \\nnâ€™avez pas lâ€™option de la placer aussi sous licence GFDL. Pour \\ndÃ©terminer la licence qui sâ€™applique au contenu que vous cherchez Ã  \\nrÃ©utiliser ou redistribuer, vous devriez consulter le pied de page, \\nlâ€™historique de la page et la page de discussion associÃ©e.\\n</p><p>De plus, soyez conscient que du texte, dont lâ€™origine remonte Ã  \\ndes sources externes et qui a Ã©tÃ© importÃ© dans un Projet, peut Ãªtre \\nplacÃ© sous une licence qui lui attache des obligations dâ€™attribution \\nsupplÃ©mentaires. Les utilisateurs acceptent dâ€™indiquer de faÃ§on claire \\nces obligations dâ€™attributions additionnelles. Selon le Projet, de \\ntelles obligations peuvent apparaÃ®tre dans une banniÃ¨re ou une autre \\nnotation dÃ©signant que tout ou partie du contenu a Ã©tÃ© Ã  lâ€™origine \\npubliÃ© ailleurs. LÃ  oÃ¹ de telles notations sont visibles, les \\nrÃ©utilisateurs devraient les prÃ©server.\\n</p>\\nConcernant tout mÃ©dia non textuel, vous acceptez de vous conformer avec \\ntoute licence sous laquelle lâ€™Å“uvre a Ã©tÃ© rendue disponible (ce qui peut\\n Ãªtre dÃ©couvert en cliquant sur lâ€™Å“uvre et en consultant la section au \\nsujet de la licence sur sa page de description ou en consultant une page\\n source applicable Ã  cette Å“uvre). Lors de la rÃ©utilisation de tout \\ncontenu que nous hÃ©bergeons, vous acceptez de vous conformer avec les \\nobligations dâ€™attribution appropriÃ©es, telles que requises par la ou les\\n licences sous-jacentes.</li><li><b>Modifications ou additions Ã  des informations rÃ©utilisÃ©es&nbsp;:</b> \\nLorsque vous modifiez ou faites des ajouts Ã  un texte que vous avez \\nobtenu sur un site Web de Projet, vous consentez Ã  placer le contenu \\nmodifiÃ© ou ajoutÃ© sous une licence CC BY-SA 3.0 ou dâ€™une version plus \\nrÃ©cente (ou, tel quâ€™indiquÃ© plus haut, sous une autre licence lorsque \\nlâ€™Ã©dition ou le caractÃ¨re dâ€™un Projet spÃ©cifique lâ€™exige).<br><br>\\n\\nLorsque vous modifiez ou effectuez des additions Ã  tout mÃ©dia non \\ntextuel que vous avez obtenu depuis un site Internet de Projet, vous \\nacceptez de placer le contenu modifiÃ© ou ajoutÃ© sous une licence \\ncompatible avec nâ€™importe laquelle des licences sous laquelle lâ€™Å“uvre \\noriginale a Ã©tÃ© rendue disponible.<br><br>\\n\\nConcernant Ã  la fois les mÃ©dias textuels et non textuels, vous consentez\\n Ã  indiquer clairement que lâ€™Å“uvre originale a Ã©tÃ© modifiÃ©e. Si vous \\nrÃ©utilisez un contenu textuel dans un wiki, il vous suffit dâ€™indiquer \\nsur la page dâ€™historique que vous avez effectuÃ© des changements au texte\\n importÃ©. Pour chaque exemplaire ou version modifiÃ©e que vous \\ndistribuez, vous consentez Ã  inclure un avis de licence indiquant la \\nlicence sous laquelle lâ€™Å“uvre a Ã©tÃ© publiÃ©e ainsi que lâ€™hyperlien ou \\nlâ€™adresse URL vers le texte de la licence, ou une copie de la licence \\nelle-mÃªme.</li></ol>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"8._Conformit.C3.A9_.C3.A0_la_DMCA_am.C3.A9ricaine\\\">8. ConformitÃ© Ã  la DMCA amÃ©ricaine</span></h2>\\n<p>La Wikimedia Foundation veut sâ€™assurer que le contenu que nous \\nhÃ©bergeons peut Ãªtre rÃ©utilisÃ© par dâ€™autres utilisateurs sans crainte de\\n responsabilitÃ© et que celui-ci nâ€™enfreint pas les droits propriÃ©taires \\ndes autres. Par Ã©quitÃ© avec nos utilisateurs, de mÃªme quâ€™envers les \\nautres crÃ©ateurs et dÃ©tenteurs de droits dâ€™auteurs, notre politique est \\nde rÃ©pondre aux notices dâ€™infractions allÃ©guÃ©es qui satisfont aux \\nformalitÃ©s amÃ©ricaines de la <i>Digital Millennium Copyright Act</i> \\n(â€œDMCAâ€). ConformÃ©ment Ã  la DMCA, nous terminerons, dans des \\ncirconstances appropriÃ©es, les utilisateurs et titulaires de comptes sur\\n nos systÃ¨mes et rÃ©seaux qui ont enfreint de faÃ§on rÃ©pÃ©tÃ©e les droits \\ndes autres.\\n</p><p>Cependant, nous reconnaissons Ã©galement que tous les avis de \\nplainte ne sont pas valides ou de bonne foi. Le cas Ã©chÃ©ant, nous \\nencourageons les utilisateurs Ã  dÃ©poser des contre-notifications \\nlorsquâ€™ils jugent quâ€™une plainte en vertu du DMCA est invalide ou \\ninopportune. Pour plus dâ€™informations sur ce que vous devez faire si \\nvous pensez quâ€™un avis DMCA est abusif, vous pouvez consulter le site \\nWeb <a rel=\\\"nofollow\\\" class=\\\"external text\\\" href=\\\"http://www.chillingeffects.org/\\\"><i>Chilling Effects</i></a>.\\n</p><p>Si vous Ãªtes le propriÃ©taire du contenu qui a Ã©tÃ© utilisÃ© \\nabusivement dans lâ€™un des Projets sans votre permission, vous pouvez \\ndemander que le contenu soit retirÃ© en vertu du DMCA. Pour en faire la \\ndemande, veuillez nous envoyer un e-mail Ã  <tt>legal</tt> <span class=\\\"nowrap\\\"><img alt=\\\"@\\\" src=\\\"https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/At_sign.svg/15px-At_sign.svg.png\\\" title=\\\"@\\\" data-file-width=\\\"145\\\" data-file-height=\\\"145\\\" height=\\\"15\\\" width=\\\"15\\\"></span> <tt>wikimedia.org</tt> ou envoyer un courrier postal Ã  notre agent dÃ©signÃ© Ã  lâ€™adresse suivante <a href=\\\"https://wikimediafoundation.org/wiki/Designated_agent\\\" title=\\\"Designated agent\\\" class=\\\"mw-redirect\\\">adresse</a>.\\n</p><p>Par ailleurs, vous pouvez faire une demande auprÃ¨s de notre \\ncommunautÃ© qui est souvent Ã  mÃªme de traiter les problÃ¨mes de droits \\ndâ€™auteur plus rapidement et plus efficacement que le DMCA ne le prÃ©voit.\\n Dans pareil cas, vous pouvez afficher un avis expliquant vos problÃ¨mes \\nde droit dâ€™auteur. Pour obtenir une liste non exhaustive et ne faisant \\npas autoritÃ© des procÃ©dures pertinentes aux diverses Ã©ditions de \\nProjets, rendez-vous <a href=\\\"https://meta.wikimedia.org/wiki/Copyright_problems\\\" class=\\\"extiw\\\" title=\\\"meta:Copyright problems\\\">ici</a>. Avant de dÃ©poser une plainte DMCA, vous pouvez Ã©galement envoyer un e-mail Ã  la communautÃ© Ã  <tt>info<span class=\\\"nowrap\\\"><img alt=\\\"@\\\" src=\\\"https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/At_sign.svg/15px-At_sign.svg.png\\\" title=\\\"@\\\" data-file-width=\\\"145\\\" data-file-height=\\\"145\\\" height=\\\"15\\\" width=\\\"15\\\"></span>wikimedia.org</tt>.\\n</p>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"9._Sites_Internet_et_ressources_provenant_de_tiers\\\">9. Sites Internet et ressources provenant de tiers</span></h2>\\n<p>Vous Ãªtes seul responsable de votre utilisation de tous les sites \\nInternet ou toutes les ressources en provenance de tiers. Bien que les \\nProjets puissent contenir des liens vers des sites Internet et \\nressources de tiers, nous nâ€™endossons pas et ne sommes pas tenus \\nresponsables de leur disponibilitÃ© ou de leur exactitude, ni de leurs \\ncontenus, produits ou services liÃ©s (y compris, sans limitation, tous \\nvirus ou tous autres dysfonctionnements quâ€™ils pourraient provoquer), de\\n mÃªme que nous nâ€™avons aucune obligation Ã  surveiller de tels contenus \\ntiers.\\n</p>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"10._Gestion_des_sites_Internet\\\">10. Gestion des sites Internet</span></h2>\\n<p>La communautÃ© a le rÃ´le le plus important dans la crÃ©ation et \\nlâ€™application des rÃ¨glements affÃ©rents aux diverses Ã©ditions de Projets.\\n Ã€ la Fondation Wikimedia, nous intervenons rarement dans les dÃ©cisions \\nde la communautÃ© en ce qui concerne les rÃ¨glements et leur application. \\nExceptionnellement, il peut sâ€™avÃ©rer nÃ©cessaire, ou la communautÃ© peut \\nnous demander dâ€™intervenir concernant un utilisateur particuliÃ¨rement \\nproblÃ©matique en raison de son attitude perturbante et dangereuse pour \\nle Projet. Dans ce cas-lÃ , nous nous rÃ©servons le droit mais nâ€™avons pas\\n lâ€™obligation d\'effectuer ce qui suit&nbsp;:\\n</p>\\n<ul><li> EnquÃªter sur votre usage du service (a) afin de dÃ©terminer sâ€™il\\n y a eu violation des prÃ©sentes Conditions dâ€™utilisation, de la \\nPolitique dâ€™Ã©dition du Projet ou de toute autre loi ou politique, ou (b)\\n afin de faire appliquer une loi, une procÃ©dure juridique ou une requÃªte\\n gouvernementale appropriÃ©e.</li><li> DÃ©tecter, prÃ©venir ou traiter de toute autre maniÃ¨re un problÃ¨me de\\n fraude, de sÃ©curitÃ© ou technique, ou rÃ©pondre Ã  la demande dâ€™assistance\\n dâ€™un utilisateur.</li><li> Refuser, dÃ©sactiver ou restreindre lâ€™accÃ¨s Ã  la contribution dâ€™un \\nutilisateur ayant violÃ© les prÃ©sentes Conditions dâ€™utilisation.</li><li> Interdire Ã  un utilisateur dâ€™Ã©diter ou de contribuer, ou bloquer le\\n compte ou lâ€™accÃ¨s dâ€™un utilisateur, suite Ã  des actes violant les \\nprÃ©sentes Conditions dâ€™utilisation, y compris en enfreignant de maniÃ¨re \\nrÃ©pÃ©tÃ©e les droits dâ€™auteur.</li><li> Engager une procÃ©dure judiciaire contre des utilisateurs ayant \\nviolÃ© les prÃ©sentes Conditions dâ€™utilisation (en les signalant, le cas \\nÃ©chÃ©ant, aux autoritÃ©s compÃ©tentes).</li><li> GÃ©rer de toute autre maniÃ¨re les sites Web de Projets afin de \\nfaciliter leur bon fonctionnement et de protÃ©ger nos droits, nos biens \\net notre sÃ©curitÃ© ainsi que ceux de nos utilisateurs, concÃ©dants, \\npartenaires et ceux du public.</li></ul>\\n<p>Dans lâ€™intÃ©rÃªt de nos utilisateurs et des Projets, dans le cas \\nextrÃªme oÃ¹ une personne aurait vu son compte ou son accÃ¨s bloquÃ© en \\nvertu de la prÃ©sente disposition, elle ne sera plus autorisÃ©e Ã  crÃ©er ou\\n Ã  utiliser un autre compte, ou Ã  chercher Ã  accÃ©der au mÃªme Projet, Ã  \\nmoins que nous lui en fournissions lâ€™autorisation expresse. Nonobstant \\nlâ€™autoritÃ© de la communautÃ©, la Fondation Wikimedia elle-mÃªme \\nnâ€™interdira pas Ã  un utilisateur dâ€™Ã©diter ou de contribuer, ni ne \\nbloquera le compte ou lâ€™accÃ¨s dâ€™un utilisateur au seul motif dâ€™une \\ncritique de bonne foi nâ€™ayant pas entraÃ®nÃ© dâ€™actes enfreignant les \\nprÃ©sentes Conditions dâ€™utilisation ou les politiques de la communautÃ©.\\n</p><p>La communautÃ© Wikimedia et ses membres peuvent Ã©galement agir \\nlorsquâ€™ils y sont autorisÃ©s par la communautÃ© ou les politiques de la \\nFondation applicables Ã  lâ€™Ã©dition de Projets, y compris mais pas \\nexclusivement, en avertissant, enquÃªtant, bloquant ou interdisant les \\nutilisateurs qui violent lesdites politiques. Vous consentez Ã  respecter\\n les dÃ©cisions finales des organismes de rÃ©solution des litiges qui sont\\n Ã©tablis par la communautÃ© en ce qui concerne les Ã©ditions de Projets \\nspÃ©cifiques (tels que les comitÃ©s dâ€™arbitrage). Ces dÃ©cisions peuvent \\nprÃ©voir des sanctions tel quâ€™indiquÃ© dans la politique affÃ©rente Ã  \\nlâ€™Ã©dition spÃ©cifique dâ€™un Projet.\\n</p><p>Les utilisateurs particuliÃ¨rement problÃ©matiques, qui ont eu des \\ncomptes ou leur accÃ¨s bloquÃ©s sur plusieurs projets peuvent Ãªtre bannis \\nde lâ€™ensemble des projets, conformÃ©ment Ã  <a href=\\\"https://meta.wikimedia.org/wiki/Global_bans\\\" class=\\\"extiw\\\" title=\\\"meta:Global bans\\\">Politique de bannissement  global</a>.\\n Contrairement aux rÃ©solutions du Conseil ou Ã  ces conditions \\ndâ€™utilisation, les politiques Ã©tablies par la communautÃ©, qui peuvent \\ncouvrir un projet unique ou plusieurs projets (comme la politique de \\nbannissement global), peuvent Ãªtre modifiÃ©es par la communautÃ© concernÃ©e\\n en fonction de ses propres procÃ©dures.\\n</p><p>Le blocage dâ€™un compte ou dâ€™un accÃ¨s, ou lâ€™interdiction dâ€™un \\nutilisateur conformÃ©ment Ã  la prÃ©sente disposition doit se conformer Ã  \\nlâ€™Article 12 des prÃ©sentes.\\n</p>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"11._R.C3.A9solutions_et_politiques_des_Projets\\\">11. RÃ©solutions et politiques des Projets</span></h2>\\n<p>Le Conseil dâ€™administration de la Fondation Wikimedia Ã©tablit des <a href=\\\"https://wikimediafoundation.org/wiki/R%C3%A9solutions\\\" title=\\\"RÃ©solutions\\\">politiques officielles</a>,\\n le cas Ã©chÃ©ant. Certaines de ces politiques sont obligatoires pour un \\nProjet ou lâ€™Ã©dition dâ€™un Projet particulier et, dans ce cas, vous \\nconsentez Ã  vous y conformer, le cas Ã©chÃ©ant.\\n</p>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"12._Terminaison_de_cet_Accord\\\">12. Terminaison de cet Accord</span></h2>\\n<p>Bien que nous espÃ©rions que vous resterez et continuerez Ã  contribuer\\n aux Projets, vous pouvez dÃ©cider dâ€™arrÃªter dâ€™utiliser nos services Ã  \\ntout moment. Dans certains cas (que nous espÃ©rons improbables), il peut \\nsâ€™avÃ©rer nÃ©cessaire pour nous, pour la communautÃ© Wikimedia ou pour ses \\nmembres (tels que dÃ©crits Ã  lâ€™Article 10) de rÃ©silier tout ou partie de \\nnos services, de rÃ©silier les prÃ©sentes Conditions dâ€™utilisation, de \\nbloquer votre compte ou votre accÃ¨s, ou de vous radier en tant \\nquâ€™utilisateur. Si votre compte ou accÃ¨s est bloquÃ© ou rÃ©siliÃ© dâ€™une \\nautre maniÃ¨re, pour quelque raison que ce soit, vos contributions \\npubliques resteront accessibles au public (conformÃ©ment aux politiques \\napplicables) et, Ã  moins que nous vous informions du contraire, vous \\npourrez continuer Ã  accÃ©der Ã  nos pages publiques dans le seul but de \\nlire le contenu des Projets accessible au public. Dans ces \\ncirconstances, cependant, vous ne pourrez pas accÃ©der Ã  votre compte ou Ã \\n ses paramÃ¨tres. Nous nous rÃ©servons le droit de suspendre ou de mettre \\nun terme aux services Ã  tout moment, avec ou sans raison, avec ou sans \\nprÃ©avis. MÃªme une fois que votre utilisation ou participation ont Ã©tÃ© \\ninterdites, bloquÃ©es ou autrement suspendues, les prÃ©sentes Conditions \\ndâ€™utilisation restent en vigueur eu Ã©gard aux dispositions pertinentes, y\\n compris les Articles 1, 3, 4, 6, 7, 9-15 et 17.\\n</p>\\n<div style=\\\"background: #FFFFCD;\\\">\\n<h2><span class=\\\"mw-headline\\\" id=\\\"13._Litiges_et_juridiction_comp.C3.A9tente\\\">13. Litiges et juridiction compÃ©tente</span></h2>\\n<p><i>Section mise en Ã©vidence Ã  dessein</i>\\n</p><p>Nous espÃ©rons quâ€™aucun dÃ©sagrÃ©ment sÃ©rieux ne se produira vous \\nconcernant mais, au cas oÃ¹ un litige surviendrait, nous vous \\nencourageons Ã  chercher Ã  le rÃ©soudre par le biais des procÃ©dures ou des\\n mÃ©canismes de rÃ©solution de litiges fournis dans les Projets ou \\nÃ©ditions de Projets et la Fondation Wikimedia. Si vous souhaitez dÃ©poser\\n une plainte contre nous, vous consentez Ã  la dÃ©poser exclusivement \\ndevant un tribunal dâ€™Ã‰tat ou fÃ©dÃ©ral du ComtÃ© de San Francisco \\n(Californie) et Ã  en accepter le jugement. Vous consentez Ã©galement Ã  ce\\n que les lois de Californie et, le cas Ã©chÃ©ant, les lois des Ã‰tats-Unis \\ndâ€™AmÃ©rique rÃ©gissent les prÃ©sentes Conditions dâ€™utilisation, de mÃªme que\\n tout litige dâ€™ordre lÃ©gal se produisant Ã©ventuellement entre vous et \\nnous (nonobstant les principes sur les conflits de lois). Vous consentez\\n Ã  vous soumettre Ã  la juridiction personnelle des tribunaux du ComtÃ© de\\n San Francisco (Californie) dont vous reconnaissez lâ€™autoritÃ© en ce qui \\nconcerne toute action ou procÃ©dure lÃ©gale affÃ©rente Ã  nous ou aux \\nprÃ©sentes Conditions dâ€™utilisation.\\n</p><p>Afin de garantir que les litiges soient traitÃ©s dÃ¨s quâ€™ils \\napparaissent, vous consentez Ã  ce que, quoique les statuts et lois \\npuissent stipuler de contraire, toute plainte ou motif dâ€™action que vous\\n pouvez avoir relativement Ã  lâ€™utilisation de nos services ou des \\nprÃ©sentes Conditions dâ€™utilisation, seront enregistrÃ©s dans le cadre des\\n statuts de limitation applicables ou, avant cela, un (1) an aprÃ¨s que \\nles faits ayant donnÃ© lieu Ã  ladite plainte ou audit motif dâ€™action \\naient Ã©tÃ© dÃ©couverts moyennant une diligence raisonnable (sous peine \\ndâ€™Ãªtre prescrits).\\n</p>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"14._D.C3.A9nis\\\">14. DÃ©nis</span></h2>\\n<p><i>Section mise en Ã©vidence Ã  dessein</i>\\n</p><p>Ã€ la Fondation Wikimedia, nous nous efforÃ§ons de fournir un \\ncontenu Ã©ducatif et informatif Ã  une trÃ¨s large audience mais votre \\nutilisation de nos services est Ã  vos risques et pÃ©rils. Nous \\nfournissons ces services comme tels en fonction de leur disponibilitÃ© et\\n nous dÃ©gageons expressÃ©ment notre responsabilitÃ© en ce qui concerne \\ntoutes les garanties expresses ou implicites, y compris mais pas \\nexclusivement, les garanties implicites de qualitÃ© marchande, \\ndâ€™adaptation Ã  un usage particulier et de non-infraction. Nous ne \\ngarantissons aucunement que nos services remplissent vos exigences, sont\\n sÃ»rs, sÃ©curitaires, non interrompus, rapides, prÃ©cis et sans erreurs, \\nou que vos informations seront Ã  lâ€™abri du risque.\\n</p><p>Nous ne sommes pas responsables du contenu, donnÃ©es ou actes de \\ntiers et vous nous dÃ©gagez de toute responsabilitÃ© ainsi que nos \\ndirecteurs, dirigeants, employÃ©s et agents concernant les plaintes et \\ndommages Ã©ventuels, connus ou non, dÃ©coulant ou autrement liÃ©s Ã  une \\nplainte que vous pouvez avoir contre lesdits tiers. Aucun conseil et \\naucune information, que ceux-ci soient oraux ou Ã©crits, obtenus par vous\\n auprÃ¨s de nous ou par le biais de nos services ne crÃ©ent de garantie si\\n celle-ci nâ€™a pas Ã©tÃ© expressÃ©ment stipulÃ©e dans les prÃ©sentes.\\n</p><p>Tout Ã©lÃ©ment tÃ©lÃ©chargÃ© ou sinon obtenu au moyen de votre \\nutilisation de nos Services, ne se fera quâ€™Ã  votre propre discrÃ©tion et Ã \\n vos propres risques, et vous serez le seul responsable pour tout \\ndommage Ã  votre systÃ¨me informatique ou perte de donnÃ©es qui rÃ©sulte de \\nlâ€™obtention dâ€™un tel Ã©lÃ©ment. Vous acceptez que nous nâ€™avons aucune \\nresponsabilitÃ© pour lâ€™effacement, ou lâ€™Ã©chec lors du stockage ou de la \\ntransmission de tout contenu ou toute communication maintenue par le \\nService. Nous nous rÃ©servons le droit de crÃ©er des limites dâ€™usage et de\\n stockage Ã  notre seule discrÃ©tion, en toute heure, avec ou sans \\navertissement prÃ©alable.\\n</p><p>Certains Ã‰tats ou juridictions ne permettent pas les types de \\nclauses de non-responsabilitÃ© stipulÃ©s dans le prÃ©sent article. Il se \\npeut donc que tout ou partie de celui-ci ne sâ€™applique pas Ã  votre cas \\nen fonction de la loi.\\n</p>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"15._Limitation_de_responsabilit.C3.A9\\\">15. Limitation de responsabilitÃ©</span></h2>\\n<p><i>Section mise en Ã©vidence Ã  dessein</i>\\n</p>\\nLa Wikimedia Foundation se sera pas tenue responsable envers vous ou \\nenvers toute autre partie pour tous dommages directs, indirects, \\nincidents, spÃ©ciaux, consÃ©cutifs ou exemplaires, y compris mais sans sâ€™y\\n limiter, les dommages pour pertes de profits, dâ€™image, de donnÃ©es ou \\nautres pertes intangibles, quand bien mÃªme nous aurions Ã©tÃ© avisÃ©s de la\\n possibilitÃ© de tels dommages. En aucun cas notre responsabilitÃ© ne \\ndevra excÃ©der mille dollars amÃ©ricains (1&nbsp;000,00&nbsp;USD) pour la totalitÃ©. \\nAu cas oÃ¹ la loi applicable nâ€™autoriserait pas la limitation ou \\nlâ€™exclusion de responsabilitÃ© ou des dommages incidents ou consÃ©cutifs, \\nla limitation ou lâ€™exclusion pourrait ne pas sâ€™appliquer Ã  vous, bien \\nque notre responsabilitÃ© sera limitÃ©e aussi pleinement que permis par la\\n loi applicable.</div>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"16._Modifications_des_pr.C3.A9sentes_Conditions_d.E2.80.99utilisation\\\">16. Modifications des prÃ©sentes Conditions dâ€™utilisation</span></h2>\\n<p>De mÃªme que lâ€™apport de la communautÃ© Wikimedia est essentiel Ã  la \\ncroissance et Ã  la maintenance des Projets, nous croyons que cet apport \\nest essentiel pour que les prÃ©sentes servent nos utilisateurs de maniÃ¨re\\n adÃ©quate. Il est Ã©galement essentiel pour Ã©tablir un contrat Ã©quitable.\\n Câ€™est pourquoi, nous fournirons les prÃ©sentes ainsi que toutes les \\nrÃ©visions substantielles futures des prÃ©sentes, Ã  la communautÃ© afin que\\n celle-ci les commente au moins trente (30) jours avant la fin de la \\npÃ©riode de commentaires. Si une future rÃ©vision proposÃ©e est \\nsubstantielle, nous fournirons 30 jours supplÃ©mentaires pour recueillir \\nles commentaires aprÃ¨s affichage de ladite rÃ©vision traduite en au moins\\n trois langues (sÃ©lectionnÃ©es Ã  notre discrÃ©tion). La communautÃ© sera \\nencouragÃ©e Ã  traduire ladite rÃ©vision dans dâ€™autres langues, le cas \\nÃ©chÃ©ant. Concernant les modifications dâ€™ordre juridique ou \\nadministratif, la correction dâ€™une information erronÃ©e ou les \\nchangements effectuÃ©s suite aux commentaires de la communautÃ©, nous \\nfournirons un prÃ©avis dâ€™au minimum trois (3) jours.\\n</p><p>Dans la mesure oÃ¹ il peut sâ€™avÃ©rer nÃ©cessaire de modifier les \\nprÃ©sentes Conditions dâ€™utilisation, le cas Ã©chÃ©ant, nous annoncerons \\nlesdites modifications et la possibilitÃ© de les commenter par le biais \\ndes sites Web de Projets et par avis sur <a class=\\\"external text\\\" href=\\\"https://lists.wikimedia.org/mailman/listinfo/WikimediaAnnounce-l\\\">WikimediaAnnounce-L</a>.\\n Cependant, nous vous demandons dâ€™avoir lâ€™obligeance de vÃ©rifier \\npÃ©riodiquement les versions les plus rÃ©centes des prÃ©sentes (disponibles\\n sur <a href=\\\"https://wikimediafoundation.org/wiki/Terms_of_use\\\" title=\\\"Terms of use\\\" class=\\\"mw-redirect\\\">http://wikimediafoundation.org/wiki/Terms of use</a>).\\n Le fait que vous continuiez dâ€™utiliser nos services aprÃ¨s que les \\nprÃ©sentes Conditions dâ€™utilisation sont devenues officielles suite Ã  un \\nprÃ©avis et Ã  la pÃ©riode de vÃ©rification constitue acceptation des \\nprÃ©sentes Conditions dâ€™utilisation de votre part. Afin de protÃ©ger la \\nFondation Wikimedia et les autres utilisateurs comme vous-mÃªme, si vous \\nnâ€™acceptez pas les prÃ©sentes, vous nâ€™Ãªtes pas autorisÃ© Ã  utiliser nos \\nservices.\\n</p>\\n<h2><span class=\\\"mw-headline\\\" id=\\\"17._Autres_termes\\\">17. Autres termes</span></h2>\\n<p>Les prÃ©sentes Conditions dâ€™utilisation ne crÃ©ent pas de relation \\ndâ€™emploi, dâ€™agence, de partenariat ou de coentreprise entre vous et \\nnous, la Fondation Wikimedia. Si vous nâ€™avez pas signÃ© de contrat \\ndistinct avec nous, les prÃ©sentes constituent lâ€™intÃ©gralitÃ© du contrat \\nnous liant Ã  vous. En cas de conflit entre les prÃ©sentes et un contrat \\nÃ©crit signÃ© entre vous et nous, le contrat signÃ© prÃ©vaudra.\\n</p><p>Vous consentez Ã  recevoir des avis de notre part, y compris les \\navis concernant les modifications aux prÃ©sentes Conditions \\ndâ€™utilisation, par e-mail, courrier postal ou affichages sur les sites \\nWeb des Projets.\\n</p><p>Le fait que nous nâ€™appliquions pas ou ne faisions pas respecter \\nune des dispositions des prÃ©sentes ne signifie aucunement que nous \\nrenonÃ§ons Ã  ladite disposition.\\n</p><p>Vous comprenez que, sauf Ã  ce quâ€™il en ait Ã©tÃ© convenu autrement \\npar Ã©crit par nous, vous ne pouvez prÃ©tendre Ã  aucune rÃ©munÃ©ration au \\ntitre des activitÃ©s, contributions ou idÃ©es que vous nous fournissez \\nainsi quâ€™Ã  la communautÃ©, aux Projets Wikimedia ou aux Ã©ditions de \\nProjets.\\n</p><p>Nonobstant les dispositions des prÃ©sentes stipulant \\nÃ©ventuellement le contraire, nous (la Fondation Wikimedia) et vous \\nconsentons Ã  ne pas modifier les termes et exigences des licences \\ngratuites employÃ©s dans les Projets ou dans les Ã©ditions de Projets \\nlorsque lesdites licences sont autorisÃ©es par les prÃ©sentes.\\n</p><p>Les prÃ©sentes Conditions dâ€™utilisation ont Ã©tÃ© rÃ©digÃ©es en \\nanglais (U.S.). Nous espÃ©rons que les traductions des prÃ©sentes sont \\nexactes, cependant, dans le cas de diffÃ©rences Ã©ventuelles entre le sens\\n de la version anglaise originale et sa traduction, la version anglaise \\noriginale prÃ©vaudra.\\n</p><p>Si une des dispositions des prÃ©sentes sâ€™avÃ¨re en tout ou partie \\nillÃ©gale, nulle ou inexÃ©cutable, ladite disposition ou la partie de la \\ndisposition concernÃ©e sera dissociable des prÃ©sentes Conditions \\ndâ€™utilisation et sera exÃ©cutÃ©e dans toute la mesure permise, et toutes \\nles autres dispositions des prÃ©sentes resteront en vigueur et pleinement\\n exÃ©cutoires.\\n</p>\"}]}]'),(5,15,'content','[{\"line\":[{\"gridClass\":\"grid-2_4\",\"gridModule\":\"[text]\",\"gridContent\":\"plop\"},{\"gridClass\":\"grid-2_4\",\"gridModule\":\"[text]\",\"gridContent\":\"plop\"}]}]'),(6,16,'content','[{\"line\":[{\"gridClass\":\"grid-4_4\",\"gridModule\":\"[text]\",\"gridContent\":\"<div style=\\\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.3999996185303px; text-align: center; font-weight: bold; padding-top: 0.3em; padding-bottom: 0.3em; background-color: rgb(142, 180, 230);\\\"><div style=\\\"font-size: 21px;\\\">Conditions dâ€™utilisation</div><div style=\\\"font-size: 16.7999992370605px;\\\"></div></div><p style=\\\"margin-top: 0.5em; margin-bottom: 0.5em; line-height: 22.3999996185303px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; background-color: rgb(249, 252, 255);\\\"><br></p><div class=\\\"floatright\\\" style=\\\"clear: right; float: right; position: relative; margin-bottom: 0.5em; margin-left: 0.5em; border: 0px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.3999996185303px; background-color: rgb(249, 252, 255);\\\"><a href=\\\"https://wikimediafoundation.org/wiki/File:Wikimedia-logo.svg\\\" class=\\\"image\\\" style=\\\"text-decoration: none; color: rgb(11, 0, 128); background: none;\\\"><img alt=\\\"Wikimedia-logo.svg\\\" src=\\\"https://upload.wikimedia.org/wikipedia/commons/thumb/8/81/Wikimedia-logo.svg/75px-Wikimedia-logo.svg.png\\\" width=\\\"75\\\" height=\\\"75\\\" srcset=\\\"//upload.wikimedia.org/wikipedia/commons/thumb/8/81/Wikimedia-logo.svg/113px-Wikimedia-logo.svg.png 1.5x, //upload.wikimedia.org/wikipedia/commons/thumb/8/81/Wikimedia-logo.svg/150px-Wikimedia-logo.svg.png 2x\\\" data-file-width=\\\"1024\\\" data-file-height=\\\"1024\\\" style=\\\"border: none; vertical-align: middle;\\\"></a></div><div style=\\\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.3999996185303px; padding: 0.3em; background-color: rgb(249, 252, 255);\\\"><center>Ceci est un rÃ©sumÃ© des Conditions dâ€™utilisation.</center></div><div style=\\\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 11.1999998092651px; font-style: italic; padding: 0.3em; margin-left: 75px; margin-right: 75px; background-color: rgb(249, 252, 255);\\\">Avertissement&nbsp;: ce rÃ©sumÃ© ne fait pas partie des Conditions dâ€™utilisation et n\'a pas valeur juridique. C\'est uniquement un guide pratique qui aide Ã  leur comprÃ©hension, dans un langage plus aisÃ© Ã  lire que le langage juridique du document complet.</div><br style=\\\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.3999996185303px; background-color: rgb(249, 252, 255);\\\"><div style=\\\"color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.3999996185303px; padding: 0.3em; background-color: rgb(249, 252, 255);\\\"><b>Une partie de notre mission est</b>&nbsp;:<ul style=\\\"line-height: 1.5em; margin-top: 0.3em; margin-left: 1.6em; list-style-image: url(data:image/svg+xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%3F%3E%0A%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%225%22%20height%3D%2213%22%3E%0A%3Ccircle%20cx%3D%222.5%22%20cy%3D%229.5%22%20r%3D%222.5%22%20fill%3D%22%2300528c%22%2F%3E%0A%3C%2Fsvg%3E%0A);\\\"><li style=\\\"margin-bottom: 0.1em;\\\">d\'<b>offrir la possibilitÃ© et inciter</b>&nbsp;les personnes partout dans le monde Ã  dÃ©velopper du contenu Ã©ducatif, soit en le publiant sous licences libres, soit en le dÃ©diant au domaine public&nbsp;;</li><li style=\\\"margin-bottom: 0.1em;\\\">de&nbsp;<b>diffuser</b>&nbsp;ce contenu efficacement et globalement, et ce gratuitement.</li></ul><p style=\\\"margin-top: 0.5em; margin-bottom: 0.5em; line-height: inherit;\\\"><br><b>Vous Ãªtes libre de</b>&nbsp;:</p><ul style=\\\"line-height: 1.5em; margin-top: 0.3em; margin-left: 1.6em; list-style-image: url(data:image/svg+xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%3F%3E%0A%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%225%22%20height%3D%2213%22%3E%0A%3Ccircle%20cx%3D%222.5%22%20cy%3D%229.5%22%20r%3D%222.5%22%20fill%3D%22%2300528c%22%2F%3E%0A%3C%2Fsvg%3E%0A);\\\"><li style=\\\"margin-bottom: 0.1em;\\\"><b>Lire</b>&nbsp;nos articles et autres mÃ©dias, gratuitement.</li><li style=\\\"margin-bottom: 0.1em;\\\"><b>RÃ©utiliser</b>&nbsp;nos articles et autres mÃ©dias sous licences libres.</li><li style=\\\"margin-bottom: 0.1em;\\\"><b>Contribuer Ã </b>&nbsp;et&nbsp;<b>modifier</b>&nbsp;nos diffÃ©rents sites et Projets sous licences libres.</li></ul><p style=\\\"margin-top: 0.5em; margin-bottom: 0.5em; line-height: inherit;\\\"><br><b>Sous les conditions suivantes</b>&nbsp;:</p><ul style=\\\"line-height: 1.5em; margin-top: 0.3em; margin-left: 1.6em; list-style-image: url(data:image/svg+xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%3F%3E%0A%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%225%22%20height%3D%2213%22%3E%0A%3Ccircle%20cx%3D%222.5%22%20cy%3D%229.5%22%20r%3D%222.5%22%20fill%3D%22%2300528c%22%2F%3E%0A%3C%2Fsvg%3E%0A);\\\"><li style=\\\"margin-bottom: 0.1em;\\\"><b>ResponsabilitÃ©</b>&nbsp;â€” Vous Ãªtes responsables de vos modifications (puisque que nous ne faisons quâ€™<i>hÃ©berger</i>&nbsp;votre contenu).</li><li style=\\\"margin-bottom: 0.1em;\\\"><b>Courtoisie</b>&nbsp;â€” Vous restez poli, courtois et respectueux, et vous ne vous livrez pas Ã  des attaques contre les autres personnes.</li><li style=\\\"margin-bottom: 0.1em;\\\"><b>Comportement rÃ©gulier</b>&nbsp;â€” Vous ne violez pas les rÃ¨gles sur le copyright ou le droit d\'auteur, et ne commettez pas d\'actions dÃ©lictueuses ou inappropriÃ©es.</li><li style=\\\"margin-bottom: 0.1em;\\\"><b>Pas de nuisance</b>&nbsp;â€” Vous ne cherchez pas Ã  porter prÃ©judice Ã  notre infrastructure technique.</li><li style=\\\"margin-bottom: 0.1em;\\\"><b>Conditions dâ€™utilisation et rÃ¨glement</b>&nbsp;â€” Vous adhÃ©rez aux Conditions dâ€™utilisation ci-dessous aux rÃ¨glements applicables de la communautÃ© quand vous visitez nos sites ou que vous participez Ã  nos communautÃ©s.</li></ul><p style=\\\"margin-top: 0.5em; margin-bottom: 0.5em; line-height: inherit;\\\"><br><b>Ã‰tant bien entendu que</b>&nbsp;:</p><ul style=\\\"line-height: 1.5em; margin-top: 0.3em; margin-left: 1.6em; list-style-image: url(data:image/svg+xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%3F%3E%0A%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%225%22%20height%3D%2213%22%3E%0A%3Ccircle%20cx%3D%222.5%22%20cy%3D%229.5%22%20r%3D%222.5%22%20fill%3D%22%2300528c%22%2F%3E%0A%3C%2Fsvg%3E%0A);\\\"><li style=\\\"margin-bottom: 0.1em;\\\"><b>Vos contributions sont libres</b>&nbsp;â€” vous placez vos contributions et modifications de nos sites sous licences libres et ouvertes (Ã  moins que votre contribution ne soit dans le domaine public).</li><li style=\\\"margin-bottom: 0.1em;\\\"><b>Absence d\'avis professionnel</b>&nbsp;â€” le contenu de nos articles et de nos autres projets est uniquement Ã  titre d\'information, et ne constitue pas l\'avis d\'un professionnel.</li></ul></div>\"}]}]'),(7,17,'content','[{\"line\":[{\"gridClass\":\"grid-6\",\"gridModule\":\"null\",\"gridContent\":\"null\"},{\"gridClass\":\"grid-6\",\"gridModule\":\"[text]\",\"gridContent\":\"Lundi\"},{\"gridClass\":\"grid-6\",\"gridModule\":\"[text]\",\"gridContent\":\"Mardi\"},{\"gridClass\":\"grid-6\",\"gridModule\":\"[text]\",\"gridContent\":\"Mercredi\"},{\"gridClass\":\"grid-6\",\"gridModule\":\"[text]\",\"gridContent\":\"Jeudi\"},{\"gridClass\":\"grid-6\",\"gridModule\":\"[text]\",\"gridContent\":\"Vendredi\"}]},{\"line\":[{\"gridClass\":\"grid-6\",\"gridModule\":\"null\",\"gridContent\":\"null\"},{\"gridClass\":\"grid-6\",\"gridModule\":\"null\",\"gridContent\":\"null\"},{\"gridClass\":\"grid-6\",\"gridModule\":\"null\",\"gridContent\":\"null\"},{\"gridClass\":\"grid-6\",\"gridModule\":\"null\",\"gridContent\":\"null\"},{\"gridClass\":\"grid-6\",\"gridModule\":\"null\",\"gridContent\":\"null\"},{\"gridClass\":\"grid-6\",\"gridModule\":\"null\",\"gridContent\":\"null\"}]}]');
/*!40000 ALTER TABLE `pp_pagemeta` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pp_post`
--

LOCK TABLES `pp_post` WRITE;
/*!40000 ALTER TABLE `pp_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `pp_post` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pp_postmeta`
--

LOCK TABLES `pp_postmeta` WRITE;
/*!40000 ALTER TABLE `pp_postmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `pp_postmeta` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pp_role`
--

LOCK TABLES `pp_role` WRITE;
/*!40000 ALTER TABLE `pp_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `pp_role` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Dumping data for table `pp_user`
--

LOCK TABLES `pp_user` WRITE;
/*!40000 ALTER TABLE `pp_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `pp_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pp_validator`
--

DROP TABLE IF EXISTS `pp_validator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pp_validator` (
  `validator_id` int(11) NOT NULL AUTO_INCREMENT,
  `validator_rule` varchar(45) NOT NULL,
  PRIMARY KEY (`validator_id`),
  KEY `validator_rule` (`validator_rule`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pp_validator`
--

LOCK TABLES `pp_validator` WRITE;
/*!40000 ALTER TABLE `pp_validator` DISABLE KEYS */;
INSERT INTO `pp_validator` VALUES (1,'isMail'),(2,'isPassword');
/*!40000 ALTER TABLE `pp_validator` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-20 14:32:07
