<?php
/**
 * pinnacklpress tables creation
 */
////////////////////////////////////// Comment
$link->exec("CREATE TABLE IF NOT EXISTS `pp_comment` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL COMMENT 'post table : primary key',
  `com_content` varchar(45) DEFAULT NULL,
  `com_author` int(11) DEFAULT NULL COMMENT 'user table : primary key',
  `com_date` timestamp DEFAULT '0000-00-00 00:00:00',
  `com_udate` timestamp DEFAULT '0000-00-00 00:00:00',
  `com_active` int(11) DEFAULT '1',
  PRIMARY KEY (`com_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

//////////////////////////////////// field
$link->exec("CREATE TABLE IF NOT EXISTS `pp_field` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(45) NOT NULL,
  `field_type` varchar(25) NOT NULL,
  `field_domname` varchar(45) NOT NULL,
  `field_domid` varchar(45) NOT NULL,
  `field_value` varchar(100) NOT NULL,
  `field_placeholder` varchar(100) NOT NULL,
  PRIMARY KEY (`field_id`),
  KEY `field_name` (`field_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

//////////////////////////////////// field rs
$link->exec("CREATE TABLE IF NOT EXISTS `pp_field_rs` (
  `field_rs_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `validator_id` int(11) NOT NULL,
  PRIMARY KEY (`field_rs_id`),
  KEY `field_id` (`field_id`,`validator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8"); 

//////////////////////////////////// fieldmeta
$link->exec("CREATE TABLE IF NOT EXISTS `pp_fieldmeta` (
  `fmeta_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `fmeta_name` varchar(45) NOT NULL,
  `fmeta_value` varchar(45) NOT NULL,
  PRIMARY KEY (`fmeta_id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

//////////////////////////////////// form
$link->exec("CREATE TABLE IF NOT EXISTS `pp_form` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(25) NOT NULL,
  `form_action` varchar(45) NOT NULL,
  `form_method` varchar(25) NOT NULL,
  `form_target` varchar(25) NOT NULL,
  `form_enctype` varchar(25) NOT NULL,
  PRIMARY KEY (`form_id`),
  UNIQUE KEY `form_name` (`form_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8"); 

//////////////////////////////////// form rs
$link->exec("CREATE TABLE IF NOT EXISTS `pp_form_rs` (
  `form_rs_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  PRIMARY KEY (`form_rs_id`),
  KEY `form_id` (`form_id`,`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

//////////////////////////////////// history
$link->exec("CREATE TABLE IF NOT EXISTS `pp_history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `history_date` varchar(45) DEFAULT NULL,
  `history_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

//////////////////////////////////// linkmeta
$link->exec("CREATE TABLE IF NOT EXISTS `pp_linkmeta` (
  `mlink_id` int(11) NOT NULL AUTO_INCREMENT,
  `mlink_name` varchar(45) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL COMMENT 'post table : primary key',
  `page_id` int(11) DEFAULT NULL COMMENT 'page table : primary key',
  PRIMARY KEY (`mlink_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

//////////////////////////////////// menu
$link->exec("CREATE TABLE IF NOT EXISTS `pp_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(45) DEFAULT NULL,
  `menu_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `pp_menu_name` (`menu_name`),
  KEY `pp_menu_status` (`menu_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

//////////////////////////////////// menu_rs
$link->exec("CREATE TABLE IF NOT EXISTS `pp_menu_rs` (
  `menu_rs_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_rs_id`),
  KEY `menu_id` (`menu_id`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

//////////////////////////////////// option
$link->exec("CREATE TABLE IF NOT EXISTS `pp_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(45) DEFAULT NULL,
  `option_value` varchar(45) DEFAULT NULL,
  `option_active` varchar(45) DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  KEY `option_name` (`option_name`),
  KEY `option_value` (`option_value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

//////////////////////////////////// page
$link->exec("CREATE TABLE IF NOT EXISTS `pp_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_tag` varchar(45) DEFAULT NULL COMMENT 'URL name of the page/post',
  `page_name` varchar(45) DEFAULT NULL COMMENT 'Page title',
  `page_connectedAs` varchar(45) DEFAULT 'visitor' COMMENT 'Alternative : \n[superadmin/administrator/moderator/editor/author/member/visitor]',
  `page_type` varchar(45) DEFAULT 'page' COMMENT 'Alternative :\n[page/post/category]',
  `page_status` varchar(45) DEFAULT 'publish' COMMENT 'Alternative :\n[publish/draft/disable]',
  `page_comment_status` varchar(45) DEFAULT 'enable' COMMENT 'Alternative\n[enable/disable]',
  `page_author` int(11) DEFAULT '0',
  `page_date` timestamp DEFAULT '0000-00-00 00:00:00',
  `page_udate` timestamp DEFAULT '0000-00-00 00:00:00',
  `page_comment_count` double DEFAULT '0',
  `page_order` int(11) DEFAULT '0',
  `page_level` int(11) DEFAULT '1',
  `page_parent` int(11) DEFAULT '0',
  PRIMARY KEY (`page_id`),
  KEY `page_tag` (`page_tag`),
  KEY `page_connectedAs` (`page_connectedAs`),
  KEY `page_type` (`page_type`),
  KEY `page_status` (`page_status`),
  KEY `page_author` (`page_author`),
  KEY `page_order` (`page_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8"); 

////////////////////////////// pagemeta
$link->exec("CREATE TABLE IF NOT EXISTS `pp_pagemeta` (
  `pmeta_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `pmeta_name` varchar(45) DEFAULT NULL,
  `pmeta_value` text,
  PRIMARY KEY (`pmeta_id`),
  KEY `page_id` (`page_id`),
  KEY `pmeta_name` (`pmeta_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8"); 

/////////////////////////////// user
$link->exec("CREATE TABLE IF NOT EXISTS `pp_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_gender` int(11),
  `user_firstname` varchar(45) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `user_pseudo` varchar(45) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_bdate` timestamp DEFAULT '0000-00-00 00:00:00',
  `user_regdate` timestamp DEFAULT '0000-00-00 00:00:00',
  `user_role` varchar(32) NOT NULL,
  `user_key` varchar(45) NOT NULL,
  `user_active` int(11) DEFAULT '0',
  `user_url` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email_UNIQUE` (`user_email`),
  UNIQUE KEY `user_pseudo_UNIQUE` (`user_pseudo`),
  UNIQUE KEY `user_url_UNIQUE` (`user_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8"); 

/////////////////////////// validator
$link->exec("CREATE TABLE IF NOT EXISTS `pp_validator` (
  `validator_id` int(11) NOT NULL AUTO_INCREMENT,
  `validator_rule` varchar(45) NOT NULL,
  PRIMARY KEY (`validator_id`),
  KEY `validator_rule` (`validator_rule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");
