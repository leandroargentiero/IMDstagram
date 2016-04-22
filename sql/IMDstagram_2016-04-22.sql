# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.42)
# Database: IMDstagram
# Generation Time: 2016-04-22 11:16:13 +0000
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
  CONSTRAINT `imageID` FOREIGN KEY (`commentImageID`) REFERENCES `posts` (`imageID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table follows
# ------------------------------------------------------------

DROP TABLE IF EXISTS `follows`;

CREATE TABLE `follows` (
  `followID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `requestUserID` int(11) NOT NULL,
  `targetUserID` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`followID`),
  KEY `requestUserID` (`requestUserID`),
  KEY `targetUserID` (`targetUserID`),
  CONSTRAINT `requestUserID` FOREIGN KEY (`requestUserID`) REFERENCES `users` (`userID`),
  CONSTRAINT `targetUserID` FOREIGN KEY (`targetUserID`) REFERENCES `users` (`userID`)
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



# Dump of table likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `likeID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `likeImageID` int(11) DEFAULT NULL,
  `likeSenderID` int(11) NOT NULL,
  `likeReceiverID` int(11) NOT NULL,
  PRIMARY KEY (`likeID`),
  KEY `likeImageID` (`likeImageID`),
  KEY `likeSenderID` (`likeSenderID`),
  KEY `likeReceiverID` (`likeReceiverID`),
  CONSTRAINT `likeImageID` FOREIGN KEY (`likeImageID`) REFERENCES `posts` (`imageID`),
  CONSTRAINT `likeReceiverID` FOREIGN KEY (`likeReceiverID`) REFERENCES `users` (`userID`),
  CONSTRAINT `likeSenderID` FOREIGN KEY (`likeSenderID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `imageID` int(11) NOT NULL AUTO_INCREMENT,
  `fileLocation` varchar(300) NOT NULL DEFAULT '',
  `description` varchar(300) NOT NULL DEFAULT '',
  `filter` varchar(45) DEFAULT NULL,
  `imageUserID` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`imageID`)
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
  `bio` varchar(150) DEFAULT '',
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`userID`, `email`, `fullname`, `username`, `password`, `private`, `bio`, `avatar`)
VALUES
	(1,'argentiero.leo@mail.com','Leandro Argentiero','leaero','$2y$12$B1YDtwZvRgX/eQmKyRMM3Om1tnzntioxHamb9UOPrU03jhknPYZBy','no','leo','files/1_avatar.jpg');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
