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
) ENGINE=InnoDB DEFAULT CHARSET=utf8