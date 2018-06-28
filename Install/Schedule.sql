DROP TABLE IF EXISTS `cms_schedule`;
CREATE TABLE `cms_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_type` tinyint(1) NOT NULL,
  `target_type` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cms_schedule_rule`;
CREATE TABLE `cms_schedule_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_id` int(11) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `year` varchar(4) NOT NULL,
  `month` varchar(2) NOT NULL,
  `day` varchar(2) NOT NULL,
  `week` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
