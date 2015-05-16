CREATE TABLE `pp_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(45) DEFAULT NULL,
  `option_value` varchar(45) DEFAULT NULL,
  `option_active` varchar(45) DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  KEY `option_name` (`option_name`),
  KEY `option_value` (`option_value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8