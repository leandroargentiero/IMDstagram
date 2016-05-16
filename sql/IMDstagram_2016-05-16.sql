# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.42)
# Database: IMDstagram
# Generation Time: 2016-05-16 16:26:35 +0000
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

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`commentID`, `commentUserID`, `commentImageID`, `commentTimestamp`, `commentText`)
VALUES
	(7,1,25,'2016-05-16 16:12:44','This one\'s my favourite! '),
	(13,1,20,'2016-05-16 16:41:25','Forza Pouvri\n'),
	(44,1,15,'2016-05-16 18:25:54','The crow is feeling the vibe!'),
	(45,1,14,'2016-05-16 18:25:58','I like this one'),
	(46,1,13,'2016-05-16 18:26:01','Congrats'),
	(47,1,12,'2016-05-16 18:26:17','Hi there'),
	(48,1,11,'2016-05-16 18:26:10','Sun\'s out, guns out.'),
	(49,1,6,'2016-05-16 18:26:12','In tweede dan toch'),
	(50,1,8,'2016-05-16 18:26:14','W O O D S'),
	(51,1,10,'2016-05-16 18:26:16','jeje'),
	(52,1,9,'2016-05-16 18:25:47','yess');

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `follows` WRITE;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;

INSERT INTO `follows` (`followID`, `requestUserID`, `targetUserID`, `accepted`)
VALUES
	(7,2,2,0),
	(8,2,3,0),
	(10,1,1,0),
	(141,1,2,0);

/*!40000 ALTER TABLE `follows` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;

INSERT INTO `likes` (`likeID`, `likeImageID`, `likeSenderID`, `likeReceiverID`)
VALUES
	(2,8,1,2),
	(29,9,1,2),
	(42,11,1,2),
	(1061,7,1,2),
	(1176,17,1,1),
	(1178,13,1,2),
	(1184,15,1,2),
	(1186,4,1,1),
	(1195,20,1,1),
	(1199,25,1,1),
	(1200,10,1,2);

/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`imageID`, `fileLocation`, `description`, `filter`, `imageUserID`, `timestamp`, `location`)
VALUES
	(1,'files/1_1462281437.jpg','Albertone leo',NULL,1,'2016-05-03 15:17:17',NULL),
	(2,'files/1_1462281453.jpg','Balloons bologna leo',NULL,1,'2016-05-03 15:17:33',NULL),
	(3,'files/1_1462281464.jpg','Baseball leo',NULL,1,'2016-05-03 15:17:44',NULL),
	(4,'files/1_1462281476.jpg','Zarautz leo',NULL,1,'2016-05-03 15:17:56',NULL),
	(5,'files/1_1462281501.jpg','Park Hotel leo',NULL,1,'2016-05-03 15:18:21',NULL),
	(6,'files/2_1462281789.jpg','Crazy times!',NULL,2,'2016-05-03 15:23:09',NULL),
	(7,'files/2_1462281812.jpg','De Hoorn, magical place for an outdoor party.',NULL,2,'2016-05-03 15:23:32',NULL),
	(8,'files/2_1462281841.jpg','On the road',NULL,2,'2016-05-03 15:24:01',NULL),
	(9,'files/2_1462281871.jpg','Will you look at that!',NULL,2,'2016-05-03 15:24:31',NULL),
	(10,'files/2_1462281884.jpg','Great album',NULL,2,'2016-05-03 15:24:44',NULL),
	(11,'files/2_1462281915.jpg','Sun is shining, the weather is sweet.',NULL,2,'2016-05-03 15:25:15',NULL),
	(12,'files/2_1462281929.jpg','Come say hi!',NULL,2,'2016-05-03 15:25:29',NULL),
	(13,'files/2_1462281941.jpg','Happy birthday!',NULL,2,'2016-05-03 15:25:41',NULL),
	(14,'files/2_1462281975.jpg','My best picture. Yet.',NULL,2,'2016-05-03 15:26:15',NULL),
	(15,'files/2_1462282002.jpg','Kid Ink in opdracht voor Wannabes.',NULL,2,'2016-05-03 15:26:42',NULL),
	(16,'files/3_1462626517.jpg','Very nice album by Amenra.',NULL,3,'2016-05-07 15:08:37',NULL),
	(17,'files/1_1462875308.jpg','Road to Tamri surfspot leo',NULL,1,'2016-05-12 14:55:42',NULL),
	(20,'files/1_1463238351.jpg','Team Pouvri Meisportmaand','mayfair',1,'2016-05-14 17:05:51',NULL),
	(21,'files/1_1463238846.jpg','Islamic ceiling art','Pick your filter',1,'2016-05-14 17:14:06',NULL),
	(25,'files/1_1463241687.jpg','Beautiful sunset session during our surftrip at Taghazout, Morocco.','walden',1,'2016-05-14 18:01:27','Mechelen, BelgiÃ«');

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


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
	(1,'argentiero.leo@mail.com','Leandro Argentiero','Leandro','$2y$12$B1YDtwZvRgX/eQmKyRMM3Om1tnzntioxHamb9UOPrU03jhknPYZBy','yes','Kidnapping moments','files/1_avatar.jpg'),
	(2,'diederik127@hotmail.com','Diederik Craps','Diederik','$2y$12$Jf8r7Y1sIXiUHCkJK5jn7uUQml6szHvtE8FeKYnCjupfKtC77oLmG','no','Ik ben Diederik, hoe gaat het met jou?','files/2_avatar.jpg'),
	(3,'hallo@thomas.be','Thomas Janssens','Tommie','$2y$12$YT1LdXxWMnp8Xf6EiuQ5ieaYArJcFcE6JsUkrdrbMlEUPeXBjCq8a','no',' ',NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
