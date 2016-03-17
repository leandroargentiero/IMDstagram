# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.42)
# Database: IMDstagram
# Generation Time: 2016-03-17 17:12:53 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `commentUserID` int(11) NOT NULL,
  `commentImageID` int(11) NOT NULL,
  `commentTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `commentText` mediumtext NOT NULL,
  PRIMARY KEY (`commentID`),
  KEY `imageID_idx` (`commentImageID`),
  KEY `userID_idx` (`commentUserID`),
  CONSTRAINT `commentUserID` FOREIGN KEY (`commentUserID`) REFERENCES `users` (`userID`),
  CONSTRAINT `imageID` FOREIGN KEY (`commentImageID`) REFERENCES `images` (`imageID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table follows
# ------------------------------------------------------------

DROP TABLE IF EXISTS `follows`;

CREATE TABLE `follows` (
  `followID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `requestUserID` int(11) NOT NULL,
  `targetUserID` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`followID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `imageID` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(45) NOT NULL,
  `desc` varchar(300) NOT NULL,
  `filter` varchar(45) DEFAULT NULL,
  `imageUserID` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`imageID`),
  KEY `userID_idx` (`imageUserID`),
  CONSTRAINT `userID` FOREIGN KEY (`imageUserID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `private` varchar(45) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
