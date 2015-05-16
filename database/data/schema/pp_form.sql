CREATE TABLE `pp_form` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(25) NOT NULL,
  `form_action` varchar(45) NOT NULL,
  `form_method` varchar(25) NOT NULL,
  `form_target` varchar(25) NOT NULL,
  `form_enctype` varchar(25) NOT NULL,
  PRIMARY KEY (`form_id`),
  UNIQUE KEY `form_name` (`form_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8