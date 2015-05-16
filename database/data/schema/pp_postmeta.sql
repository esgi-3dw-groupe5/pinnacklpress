CREATE TABLE `pp_postmeta` (
  `pmeta_id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `pmeta_name` varchar(45) DEFAULT NULL,
  `pmeta_value` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pmeta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8