CREATE TABLE IF NOT EXISTS `groups` (
  `groups_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` text COLLATE latin1_general_ci NOT NULL,
  `group_name` text COLLATE latin1_general_ci NOT NULL,
  `date_modified` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`groups_id`)
);

CREATE TABLE IF NOT EXISTS `people` (
  `people_id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `first_name` text COLLATE latin1_general_ci NOT NULL,
  `last_name` text COLLATE latin1_general_ci NOT NULL,
  `email_address` text COLLATE latin1_general_ci NOT NULL,
  `group_id` text COLLATE latin1_general_ci NOT NULL,
  `state` text COLLATE latin1_general_ci NOT NULL,
  `date_modified` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`people_id`)
);