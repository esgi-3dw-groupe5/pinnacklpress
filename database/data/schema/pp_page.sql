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
) ENGINE=MyISAM DEFAULT CHARSET=utf8