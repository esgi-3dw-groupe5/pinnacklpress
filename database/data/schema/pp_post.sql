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
) ENGINE=MyISAM DEFAULT CHARSET=utf8