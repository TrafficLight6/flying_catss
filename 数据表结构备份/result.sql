# Host: localhost  (Version: 5.7.26)
# Date: 2023-01-05 14:39:02
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "user_table"
#

DROP TABLE IF EXISTS `user_table`;
CREATE TABLE `user_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `join_date` date NOT NULL DEFAULT '1960-01-01',
  `ban` varchar(5) NOT NULL DEFAULT 'false',
  `ban_date` date DEFAULT NULL,
  `activate` varchar(5) DEFAULT 'false',
  `class` float(2,1) NOT NULL DEFAULT '1.0',
  `av` int(2) NOT NULL DEFAULT '30',
  `aav` int(2) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "user_table"
#

/*!40000 ALTER TABLE `user_table` DISABLE KEYS */;
INSERT INTO `user_table` VALUES (1,'root','63a9f0ea7bb98050796b649e85481845',NULL,'1960-01-01','false',NULL,'false',5.0,30,0);
/*!40000 ALTER TABLE `user_table` ENABLE KEYS */;
