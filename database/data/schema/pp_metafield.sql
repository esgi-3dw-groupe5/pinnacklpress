CREATE TABLE `pp_metafield` (
  `fmeta_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `fmeta_name` varchar(45) NOT NULL,
  `fmeta_value` varchar(45) NOT NULL,
  PRIMARY KEY (`fmeta_id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8