CREATE TABLE `pp_form_rs` (
  `form_rs_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  PRIMARY KEY (`form_rs_id`),
  KEY `form_id` (`form_id`,`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8