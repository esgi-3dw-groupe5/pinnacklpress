-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 04 Juillet 2015 à 12:41
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `pp_field`
--

INSERT INTO `pp_field` (`field_id`, `field_name`, `field_type`, `field_domname`, `field_domid`, `field_value`, `field_placeholder`) VALUES
(15, 'email', 'email', 'email', 'email', '', ''),
(16, 'password', 'password', 'password', 'password', '', ''),
(17, 'email', 'email', 'email', 'email', '', ''),
(18, 'pseudo', 'text', 'pseudo', 'text', '', ''),
(19, 'password', 'password', 'password', 'password', '', ''),
(20, 'firstname', 'text', 'firstname', 'text', '', ''),
(21, 'lastname', 'text', 'lastname', 'text', '', ''),
(22, 'birthdate', 'date', 'birthdate', 'date', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `pp_fieldmeta`
--

CREATE TABLE IF NOT EXISTS `pp_fieldmeta` (
  `fmeta_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `fmeta_name` varchar(45) NOT NULL,
  `fmeta_value` varchar(45) NOT NULL,
  PRIMARY KEY (`fmeta_id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `pp_field_rs`
--

INSERT INTO `pp_field_rs` (`field_rs_id`, `field_id`, `validator_id`) VALUES
(13, 17, 13),
(14, 19, 14),
(15, 22, 15);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `pp_form`
--

INSERT INTO `pp_form` (`form_id`, `form_name`, `form_action`, `form_method`, `form_target`, `form_enctype`) VALUES
(4, 'connection', '', 'post', '', ''),
(5, 'inscription', '', 'post', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `pp_form_rs`
--

INSERT INTO `pp_form_rs` (`form_rs_id`, `form_id`, `field_id`) VALUES
(11, 4, 15),
(12, 4, 16),
(13, 5, 17),
(14, 5, 18),
(15, 5, 19),
(16, 5, 20),
(17, 5, 21),
(18, 5, 22);

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
-- Structure de la table `pp_linkmeta`
--

CREATE TABLE IF NOT EXISTS `pp_linkmeta` (
  `mlink_id` int(11) NOT NULL AUTO_INCREMENT,
  `mlink_name` varchar(45) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL COMMENT 'post table : primary key',
  `page_id` int(11) DEFAULT NULL COMMENT 'page table : primary key',
  PRIMARY KEY (`mlink_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pp_menu`
--

CREATE TABLE IF NOT EXISTS `pp_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(45) DEFAULT NULL,
  `menu_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `pp_menu_name` (`menu_name`),
  KEY `pp_menu_status` (`menu_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `pp_menu`
--

INSERT INTO `pp_menu` (`menu_id`, `menu_name`, `menu_status`) VALUES
(1, 'main', 'primary');

-- --------------------------------------------------------

--
-- Structure de la table `pp_menu_rs`
--

CREATE TABLE IF NOT EXISTS `pp_menu_rs` (
  `menu_rs_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_rs_id`),
  KEY `menu_id` (`menu_id`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `pp_menu_rs`
--

INSERT INTO `pp_menu_rs` (`menu_rs_id`, `menu_id`, `page_id`) VALUES
(14, 1, 21),
(13, 1, 16),
(12, 1, 22),
(10, 1, 19),
(11, 1, 20);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `pp_option`
--

INSERT INTO `pp_option` (`option_id`, `option_name`, `option_value`, `option_active`) VALUES
(1, 'sitename', 'Pinnackl', NULL),
(2, 'sitedescription', 'Le site de l''info', NULL),
(3, 'siteurl', 'http://127.0.0.1/pinnacklpress/', NULL),
(4, 'theme', 'pure', 'yes'),
(5, 'sidebar', 'on', 'yes'),
(6, 'permalink', 'Y-m-d', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `pp_page`
--

CREATE TABLE IF NOT EXISTS `pp_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_tag` varchar(45) DEFAULT NULL COMMENT 'URL name of the page/post',
  `page_name` varchar(45) DEFAULT NULL COMMENT 'Page title',
  `page_connectedAs` varchar(45) DEFAULT 'visitor' COMMENT 'Alternative : \n[superadmin/administrator/moderator/editor/author/member/visitor]',
  `page_type` varchar(45) DEFAULT 'page' COMMENT 'Alternative :\n[page/post/category]',
  `page_status` varchar(45) DEFAULT 'publish' COMMENT 'Alternative :\n[publish/draft/disable]',
  `page_comment_status` varchar(45) DEFAULT 'enable' COMMENT 'Alternative\n[enable/disable]',
  `page_author` int(11) DEFAULT '0',
  `page_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `page_udate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `page_comment_count` double DEFAULT '0',
  `page_order` int(11) DEFAULT '0',
  `page_level` int(11) DEFAULT '0',
  `page_parent` int(11) DEFAULT '0',
  PRIMARY KEY (`page_id`),
  KEY `page_tag` (`page_tag`),
  KEY `page_connectedAs` (`page_connectedAs`),
  KEY `page_type` (`page_type`),
  KEY `page_status` (`page_status`),
  KEY `page_author` (`page_author`),
  KEY `page_order` (`page_order`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `pp_page`
--

INSERT INTO `pp_page` (`page_id`, `page_tag`, `page_name`, `page_connectedAs`, `page_type`, `page_status`, `page_comment_status`, `page_author`, `page_date`, `page_udate`, `page_comment_count`, `page_order`, `page_level`, `page_parent`) VALUES
(14, 'condition-general-d-utilisation', 'Condition gÃ©nÃ©ral d''utilisation', 'visitor', 'page', 'publish', 'enable', 0, '2015-05-23 03:39:30', '2015-06-21 17:54:19', 0, 9, 0, 0),
(16, 'term-of-use', 'Term of use', 'visitor', 'page', 'publish', 'enable', 0, '2015-05-22 23:33:28', '2015-07-02 00:41:59', 0, 1005, 1, 0),
(18, 'test-page', 'Test Page', 'member', 'category', 'publish', 'enable', NULL, '2015-05-23 13:54:28', '2015-05-24 01:10:11', NULL, 4, 0, NULL),
(19, 'index', 'Index', 'visitor', 'page', 'publish', 'enable', NULL, '2015-05-23 15:17:57', '2015-06-10 14:47:52', NULL, 1004, 1, 0),
(20, 'mon-premier-article', 'Mon premier article', 'visitor', 'post', 'publish', 'enable', NULL, '2015-05-23 20:20:09', '2015-06-23 02:37:26', 0, 1007, 2, 21),
(21, 'undefine', 'Undefine', 'visitor', 'category', 'publish', 'enable', 0, '2015-05-25 19:21:27', '2015-06-21 18:18:50', 0, 1006, 1, 0),
(22, 'my-new-article', 'My new article', 'visitor', 'post', 'publish', 'enable', NULL, '2015-06-25 02:26:07', '2015-06-25 02:34:30', 0, 1008, 2, 21),
(23, 'footer', 'footer', 'visitor', 'footer', 'publish', NULL, NULL, '2015-06-25 23:56:32', '2015-06-29 14:46:40', NULL, NULL, 0, NULL),
(25, 'inscription', 'inscription', 'visitor', 'page', 'publish', 'enable', NULL, '2015-07-04 12:12:03', '2015-07-04 12:19:04', NULL, 2, NULL, NULL),
(26, 'connection', 'connection', 'visitor', 'page', 'publish', 'enable', NULL, '2015-07-04 12:12:36', '2015-07-04 12:19:20', NULL, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `pp_pagemeta`
--

CREATE TABLE IF NOT EXISTS `pp_pagemeta` (
  `pmeta_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `pmeta_name` varchar(45) DEFAULT NULL,
  `pmeta_value` text,
  PRIMARY KEY (`pmeta_id`),
  KEY `page_id` (`page_id`),
  KEY `pmeta_name` (`pmeta_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Contenu de la table `pp_pagemeta`
--

INSERT INTO `pp_pagemeta` (`pmeta_id`, `page_id`, `pmeta_name`, `pmeta_value`) VALUES
(3, 1, 'content', '[{"line":[{"gridClass":"grid-7","gridModule":"[text]","gridContent":"test"},{"gridClass":"grid-7","gridModule":"null","gridContent":"null"},{"gridClass":"grid-7","gridModule":"null","gridContent":"null"},{"gridClass":"grid-7","gridModule":"null","gridContent":"null"},{"gridClass":"grid-7","gridModule":"null","gridContent":"null"},{"gridClass":"grid-7","gridModule":"null","gridContent":"null"},{"gridClass":"grid-7","gridModule":"null","gridContent":"null"}]}]'),
(6, 16, 'content', '[{"line":[{"gridClass":"grid-4_4","gridModule":"[text]","gridContent":"<br><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis iaculis tristique mi. Mauris orci mi, varius quis tristique scelerisque, ullamcorper quis sapien. Fusce vitae enim lacinia, commodo velit ac, volutpat velit. Morbi non sodales tellus. Sed ultrices enim pellentesque, placerat justo aliquet, volutpat velit. Morbi in est a lorem ultricies eleifend sit amet a velit. Sed fringilla velit vitae dui viverra, sit amet dictum nisi commodo. Sed sit amet convallis neque. Morbi laoreet risus in ligula lobortis mollis. Nam consectetur nisl vitae nulla suscipit, eu gravida nisi sodales. Curabitur metus dolor, facilisis in leo eget, sollicitudin molestie felis.<br><br>Nulla viverra pellentesque felis sit amet sollicitudin. Aenean iaculis, sem in volutpat elementum, est arcu porta urna, ac euismod magna turpis quis nunc. Nulla pharetra dolor sit amet rhoncus vulputate. Sed id elit volutpat, dignissim ligula ut, laoreet justo. Proin ornare, purus non scelerisque dignissim, nisi leo placerat felis, nec posuere lacus quam sit amet enim. Vestibulum pharetra, leo ac commodo pellentesque, lorem leo sagittis libero, et ultrices mi lectus a neque. Nullam tincidunt nibh sed consequat fringilla. Integer metus nunc, auctor nec consectetur sed, feugiat et erat. Integer eu magna efficitur purus sollicitudin aliquet. Fusce cursus urna eu magna posuere mattis. Nunc et finibus tortor.<br><br>Donec pharetra lacinia libero eget elementum. Ut rutrum massa quis purus facilisis iaculis. Quisque vel rutrum arcu. Sed tristique erat ut metus mollis dictum. Cras vel gravida orci. Nullam ante felis, malesuada vel molestie nec, consequat non quam. Proin et aliquet nulla.<br><br>Mauris rhoncus turpis et rhoncus lobortis. Integer viverra, massa eget viverra maximus, eros tortor luctus nibh, non auctor tellus ipsum sit amet lectus. Etiam dui lectus, bibendum sed purus et, semper ornare lorem. Nullam suscipit accumsan leo vel volutpat. Nunc porta nisi semper orci euismod tincidunt. Fusce vitae interdum lacus, pulvinar aliquet ligula. Proin sit amet leo at quam sodales consequat id in diam. Maecenas fermentum et ligula id varius. Maecenas tincidunt, quam sed commodo tempus, lectus nibh venenatis est, nec malesuada ipsum diam non ipsum. Pellentesque maximus, massa quis volutpat consequat, nisl ligula commodo leo, vitae lacinia dui justo ac augue. Maecenas et pharetra augue, a tempus orci. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec at ligula malesuada, varius neque tincidunt, consequat tortor.<br><br>Sed in vehicula justo. Quisque tincidunt leo purus, id rutrum tellus aliquet ut. Ut consequat leo ut commodo pretium. Vivamus quis posuere est. Ut ac nisi feugiat, consectetur arcu a, placerat dui. Donec blandit lacus sit amet diam feugiat sollicitudin. Vivamus eu enim varius, accumsan massa eget, mattis dui. Pellentesque mi quam, maximus eget molestie eget, ornare ac enim. Pellentesque a tempor nunc. Phasellus in odio libero. Quisque ultricies ligula nec nisl semper, ut tempor nisl fermentum. Quisque commodo augue dolor. Suspendisse eu consectetur magna. Donec nisl magna, consectetur sit amet nulla a, scelerisque molestie felis. Pellentesque non ante ac sapien sodales hendrerit. Curabitur aliquet mi elit, ac facilisis risus sodales quis. <br>"}]}]'),
(8, 19, 'content', '[{"line":[{"gridClass":"grid-1_4","gridModule":"[text]","gridContent":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi elit sem,\\n ullamcorper ac lobortis quis, placerat ac risus. In mollis augue mollis\\n sem scelerisque faucibus. Vestibulum sagittis, arcu nec vulputate \\nhendrerit, augue eros pulvinar neque, nec vulputate nunc velit vel odio.\\n Mauris tristique nulla velit, suscipit lacinia orci volutpat id. \\nPellentesque habitant morbi tristique senectus et netus et malesuada \\nfames ac turpis egestas. Integer dignissim sem faucibus, sollicitudin \\nlacus quis, porta mi. In hac habitasse platea dictumst. Fusce id \\nsagittis justo. Phasellus euismod feugiat molestie. Duis vel orci vitae \\npurus blandit blandit elementum ac est. Praesent vel commodo augue.\\n"},{"gridClass":"grid-3_4","gridModule":"[text]","gridContent":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi elit sem,\\n ullamcorper ac lobortis quis, placerat ac risus. In mollis augue mollis\\n sem scelerisque faucibus. Vestibulum sagittis, arcu nec vulputate \\nhendrerit, augue eros pulvinar neque, nec vulputate nunc velit vel odio.\\n Mauris tristique nulla velit, suscipit lacinia orci volutpat id. \\nPellentesque habitant morbi tristique senectus et netus et malesuada \\nfames ac turpis egestas. Integer dignissim sem faucibus, sollicitudin \\nlacus quis, porta mi. In hac habitasse platea dictumst. Fusce id \\nsagittis justo. Phasellus euismod feugiat molestie. Duis vel orci vitae \\npurus blandit blandit elementum ac est. Praesent vel commodo augue.\\n"}]}]'),
(9, 19, 'content', '[{"line":[{"gridClass":"grid-4_4","gridModule":"[text]","gridContent":"<p>Welcome to Pinnacklpress.</p><p><br></p><p>PinnacklPress est un CMS ou SystÃ¨me de Gestion de Contenue.</p><p><br></p><p>GrÃ¢ce Ã  cette outil, vous pouvez dÃ©sormais mettre en place votre propre site internet et le gÃ©rer depuis votre interface d''administration Ã  l''instar de CMS comme wordpress.</p><p><br></p><p>La particularitÃ© de PinnacklPress consiste dans le fait qu''il s''agisse d''un&nbsp; CMS pour dÃ©veloppeur. C''est Ã  dire qu''il s''agit d''un outil crÃ©er de tel sort qu''il soit facile pour un developpeur de le modifier Ã  sa guise et ainsi faire correspondre cette outils Ã  ces besoins sans avoir Ã  alourdir le site avec un grand nombre de plugings.</p><p><br></p><p>En tant que dÃ©veloppeurs nous savons Ã  quel point il est parfois difficile de modifier un grand ensemble de code qui peuvent parfois Ãªtre de vÃ©riutable usin Ã  gaz.</p><p><br></p><p>Nous espÃ©rons vraiment que vous aprÃ©cirez travaillez avec notre outil.</p><p><br></p><p>Et n''hÃ©sitez pas Ã  nous remonter toute requette sur des bug ou de nouvelle fonctionnaliter.</p><p><br></p><p>Toute l''Ã©quipe de PinnacklPress espÃ¨re que vous aimerez travailler avec notre outil.<br></p>"}]}]'),
(7, 17, 'content', '[{"line":[{"gridClass":"grid-6","gridModule":"null","gridContent":"null"},{"gridClass":"grid-6","gridModule":"[text]","gridContent":"Lundi"},{"gridClass":"grid-6","gridModule":"[text]","gridContent":"Mardi"},{"gridClass":"grid-6","gridModule":"[text]","gridContent":"Mercredi"},{"gridClass":"grid-6","gridModule":"[text]","gridContent":"Jeudi"},{"gridClass":"grid-6","gridModule":"[text]","gridContent":"Vendredi"}]},{"line":[{"gridClass":"grid-6","gridModule":"null","gridContent":"null"},{"gridClass":"grid-6","gridModule":"null","gridContent":"null"},{"gridClass":"grid-6","gridModule":"null","gridContent":"null"},{"gridClass":"grid-6","gridModule":"null","gridContent":"null"},{"gridClass":"grid-6","gridModule":"null","gridContent":"null"},{"gridClass":"grid-6","gridModule":"null","gridContent":"null"}]}]'),
(78, 20, 'category', '21'),
(77, 20, 'category', '18'),
(66, 14, 'content', '[{"line":[{"gridClass":"grid-4_4","gridModule":"[text]","gridContent":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis iaculis tristique mi. Mauris orci mi, varius quis tristique scelerisque, ullamcorper quis sapien. Fusce vitae enim lacinia, commodo velit ac, volutpat velit. Morbi non sodales tellus. Sed ultrices enim pellentesque, placerat justo aliquet, volutpat velit. Morbi in est a lorem ultricies eleifend sit amet a velit. Sed fringilla velit vitae dui viverra, sit amet dictum nisi commodo. Sed sit amet convallis neque. Morbi laoreet risus in ligula lobortis mollis. Nam consectetur nisl vitae nulla suscipit, eu gravida nisi sodales. Curabitur metus dolor, facilisis in leo eget, sollicitudin molestie felis.<br><br>Nulla viverra pellentesque felis sit amet sollicitudin. Aenean iaculis, sem in volutpat elementum, est arcu porta urna, ac euismod magna turpis quis nunc. Nulla pharetra dolor sit amet rhoncus vulputate. Sed id elit volutpat, dignissim ligula ut, laoreet justo. Proin ornare, purus non scelerisque dignissim, nisi leo placerat felis, nec posuere lacus quam sit amet enim. Vestibulum pharetra, leo ac commodo pellentesque, lorem leo sagittis libero, et ultrices mi lectus a neque. Nullam tincidunt nibh sed consequat fringilla. Integer metus nunc, auctor nec consectetur sed, feugiat et erat. Integer eu magna efficitur purus sollicitudin aliquet. Fusce cursus urna eu magna posuere mattis. Nunc et finibus tortor.<br><br>Donec pharetra lacinia libero eget elementum. Ut rutrum massa quis purus facilisis iaculis. Quisque vel rutrum arcu. Sed tristique erat ut metus mollis dictum. Cras vel gravida orci. Nullam ante felis, malesuada vel molestie nec, consequat non quam. Proin et aliquet nulla.<br><br>Mauris rhoncus turpis et rhoncus lobortis. Integer viverra, massa eget viverra maximus, eros tortor luctus nibh, non auctor tellus ipsum sit amet lectus. Etiam dui lectus, bibendum sed purus et, semper ornare lorem. Nullam suscipit accumsan leo vel volutpat. Nunc porta nisi semper orci euismod tincidunt. Fusce vitae interdum lacus, pulvinar aliquet ligula. Proin sit amet leo at quam sodales consequat id in diam. Maecenas fermentum et ligula id varius. Maecenas tincidunt, quam sed commodo tempus, lectus nibh venenatis est, nec malesuada ipsum diam non ipsum. Pellentesque maximus, massa quis volutpat consequat, nisl ligula commodo leo, vitae lacinia dui justo ac augue. Maecenas et pharetra augue, a tempus orci. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec at ligula malesuada, varius neque tincidunt, consequat tortor.<br><br>Sed in vehicula justo. Quisque tincidunt leo purus, id rutrum tellus aliquet ut. Ut consequat leo ut commodo pretium. Vivamus quis posuere est. Ut ac nisi feugiat, consectetur arcu a, placerat dui. Donec blandit lacus sit amet diam feugiat sollicitudin. Vivamus eu enim varius, accumsan massa eget, mattis dui. Pellentesque mi quam, maximus eget molestie eget, ornare ac enim. Pellentesque a tempor nunc. Phasellus in odio libero. Quisque ultricies ligula nec nisl semper, ut tempor nisl fermentum. Quisque commodo augue dolor. Suspendisse eu consectetur magna. Donec nisl magna, consectetur sit amet nulla a, scelerisque molestie felis. Pellentesque non ante ac sapien sodales hendrerit. Curabitur aliquet mi elit, ac facilisis risus sodales quis. <br>"}]}]'),
(80, 2, 'category', '18'),
(81, 22, 'content', '[{"line":[{"gridClass":"grid-4_4","gridModule":"text","gridContent":"<p>Some text<\\/p><br>"}]}]'),
(82, 23, 'footer', '[{"line":[{"gridClass":"grid-1_4","gridModule":"[text]","gridContent":"Footer 1<br>"},{"gridClass":"grid-1_4","gridModule":"[text]","gridContent":"Footer 2<br>"},{"gridClass":"grid-1_4","gridModule":"[text]","gridContent":"Footer 3<br>"},{"gridClass":"grid-1_4","gridModule":"[text]","gridContent":"Footer 4<br>"}]}]'),
(32, 20, 'content', '[{"line":[{"gridClass":"grid-4_4","gridModule":"text","gridContent":"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nec congue massa. Morbi iaculis dui mauris, at tristique nibh maximus id. Fusce feugiat sem at enim porta posuere. Suspendisse eleifend turpis a quam tincidunt accumsan. Proin et est vel leo vehicula pellentesque. Suspendisse eu lacinia enim, ut pretium dolor. Curabitur laoreet bibendum felis eget cursus. Aenean convallis vulputate mi, pellentesque volutpat massa facilisis id. Praesent eu convallis libero, ut finibus magna. Vivamus dui erat, euismod sit amet tortor eu, sagittis bibendum metus.<\\/p><p>Morbi interdum magna sit amet purus egestas ultrices. Cras nec odio sed tortor sollicitudin lacinia. Fusce porttitor, odio ut semper aliquam, mauris sem tincidunt sapien, ac tempus metus ex sit amet odio. Integer id nibh laoreet, semper sapien vitae, rhoncus lorem. Cras ante dui, congue sit amet ligula dignissim, auctor interdum velit. Donec auctor, justo ac dapibus tincidunt, velit massa convallis erat, non egestas est erat id velit. Aenean ac ex suscipit, placerat dolor eget, ultrices tellus. Sed porttitor leo felis, vel tincidunt erat malesuada nec. Morbi et nunc luctus, tempor lacus id, tincidunt neque. Sed varius aliquam elit, eu sodales lectus iaculis non. Donec elementum consequat vehicula.<\\/p><p>Maecenas dapibus rutrum leo at finibus. Nam tristique facilisis urna sit amet pellentesque. Fusce mattis ullamcorper aliquet. Ut in suscipit est. In maximus lacinia maximus. Donec metus tellus, varius sed sapien vel, pellentesque condimentum leo. Sed congue sed nunc in laoreet. Sed quis condimentum tellus. Donec dictum venenatis fringilla. Ut pellentesque, augue nec efficitur ultrices, lorem quam condimentum nibh, consequat suscipit velit sapien eget eros. Vestibulum id euismod tortor, quis aliquet ex. Vestibulum fringilla nec nunc a consectetur.<\\/p><p>Donec orci orci, consequat vitae placerat sed, sagittis vel quam. Curabitur ultricies vitae sem quis interdum. Donec at pharetra purus, a posuere risus. In consequat tellus et mi dignissim, vitae tincidunt mauris facilisis. Nam eleifend vulputate urna, at tempus dui bibendum vitae. Nunc a sapien mi. Praesent ac elit quis nisl suscipit sollicitudin. Nam finibus tristique risus eget pretium. Vestibulum tristique mi ut placerat efficitur.<\\/p><p>Duis pulvinar eu orci nec finibus. Nulla eu mattis massa, sed venenatis tellus. Nulla at enim non lectus cursus pretium et sit amet arcu. Fusce condimentum neque ligula. Pellentesque aliquam, ex vitae molestie tristique, magna nulla tempus sapien, vitae lobortis tellus elit eget diam. Fusce ut mauris sodales, dictum metus sit amet, accumsan justo. In et velit venenatis, consequat lacus facilisis, vestibulum enim. Nunc justo nisl, rutrum at dolor quis, viverra finibus nulla. Etiam eget interdum ligula. Vivamus quis commodo urna. Sed mi enim, dignissim in justo eget, pretium ultricies mi <\\/p>"}]}]'),
(79, 2, 'content', '[{"line":[{"gridClass":"grid-4_4","gridModule":"text","gridContent":"Here if some new article<img src=\\"\\/pinnacklpress\\/nimda\\/template\\/js\\/builder\\/libs\\/Trumbowyg\\/dist\\/plugins\\/upload\\/uploaded-files\\/Games-Wallpaper-HD-661.jpg\\" height=\\"118\\" width=\\"210\\"><br>"}]}]'),
(83, 24, 'content', '[{"line":[{"gridClass":"grid-4_4","gridModule":"[form]","gridContent":"connection"}]}]'),
(84, 15, 'content', '[{"line":[{"gridClass":"grid-4_4","gridModule":"[form]","gridContent":"inscription"}]}]'),
(85, 25, 'content', '[{"line":[{"gridClass":"grid-4_4","gridModule":"[form]","gridContent":"inscription"}]}]'),
(86, 26, 'content', '[{"line":[{"gridClass":"grid-4_4","gridModule":"[form]","gridContent":"connection"}]}]');

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
  `user_role` varchar(32) NOT NULL,
  `user_key` varchar(45) NOT NULL,
  `user_active` int(11) DEFAULT '0',
  `user_url` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email_UNIQUE` (`user_email`),
  UNIQUE KEY `user_pseudo_UNIQUE` (`user_pseudo`),
  UNIQUE KEY `user_url_UNIQUE` (`user_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `pp_user`
--

INSERT INTO `pp_user` (`user_id`, `user_gender`, `user_firstname`, `user_name`, `user_pseudo`, `user_email`, `user_password`, `user_bdate`, `user_regdate`, `user_role`, `user_key`, `user_active`, `user_url`) VALUES
(1, 2, 'Lorem', 'Ipsum', 'loremipsum', 'lorem@ipsum.eu', '$2y$10$SrMlGj9sZXttVB7rZ9RZke0yoavLeLB/8n.8.s8lVHv8UH1Xp0aD.', NULL, NULL, 'visitor', '343fce6a695cbf84da9d9271097555e3', 0, 'loremipsum');

-- --------------------------------------------------------

--
-- Structure de la table `pp_validator`
--

CREATE TABLE IF NOT EXISTS `pp_validator` (
  `validator_id` int(11) NOT NULL AUTO_INCREMENT,
  `validator_rule` varchar(45) NOT NULL,
  PRIMARY KEY (`validator_id`),
  KEY `validator_rule` (`validator_rule`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `pp_validator`
--

INSERT INTO `pp_validator` (`validator_id`, `validator_rule`) VALUES
(15, 'isDate'),
(13, 'isMail'),
(14, 'isPassword');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
