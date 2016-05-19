# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.42)
# Database: imdstagram
# Generation Time: 2016-05-19 06:33:57 +0000
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
	(44,2,15,'2016-05-16 18:15:13','The crow is feeling the vibe!'),
	(45,2,14,'2016-05-16 18:15:20','I like this one'),
	(46,2,13,'2016-05-16 18:15:35','Congrats'),
	(47,2,12,'2016-05-16 18:15:43','Hi there'),
	(48,2,11,'2016-05-16 18:16:46','Sun\'s out, guns out.'),
	(49,1,6,'2016-05-16 22:37:57','In tweede dan toch'),
	(50,2,8,'2016-05-16 18:17:46','W O O D S'),
	(51,2,21,'2016-05-16 22:40:19','Nice symmetry!'),
	(58,2,25,'2016-05-16 23:06:02','I agree, lovely shot.'),
	(59,2,17,'2016-05-16 23:06:13','Where is this?'),
	(60,2,6,'2016-05-16 23:06:30','Zwijgt.'),
	(61,2,36,'2016-05-18 23:22:46','Hi there!'),
	(62,2,39,'2016-05-19 08:19:20','You know me too well.'),
	(63,1,37,'2016-05-19 08:21:48','KING NICO'),
	(64,2,37,'2016-05-19 08:21:59','Was jij er?');

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table followrequests
# ------------------------------------------------------------

DROP TABLE IF EXISTS `followrequests`;

CREATE TABLE `followrequests` (
  `followID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `requestUserID` int(11) NOT NULL,
  `targetUserID` int(11) NOT NULL,
  PRIMARY KEY (`followID`),
  KEY `requestUserID` (`requestUserID`),
  KEY `targetUserID` (`targetUserID`),
  CONSTRAINT `followrequests_ibfk_1` FOREIGN KEY (`requestUserID`) REFERENCES `users` (`userID`),
  CONSTRAINT `followrequests_ibfk_2` FOREIGN KEY (`targetUserID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `followrequests` WRITE;
/*!40000 ALTER TABLE `followrequests` DISABLE KEYS */;

INSERT INTO `followrequests` (`followID`, `requestUserID`, `targetUserID`)
VALUES
	(5,2,3),
	(21,3,2),
	(24,1,2),
	(25,1,8),
	(26,2,8),
	(27,4,8),
	(28,5,8);

/*!40000 ALTER TABLE `followrequests` ENABLE KEYS */;
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
	(141,1,2,0),
	(142,2,1,0),
	(143,4,4,0),
	(144,5,5,0),
	(146,2,1,0),
	(147,2,4,0),
	(148,2,5,0),
	(149,6,6,0),
	(150,7,7,0),
	(151,2,6,0),
	(152,2,7,0),
	(153,8,8,0);

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
	(1200,10,1,2),
	(1201,25,2,1),
	(1202,21,2,1),
	(1203,17,2,1),
	(1204,16,2,3),
	(1205,5,2,1),
	(1206,4,2,1),
	(1207,20,2,1),
	(1208,39,2,7),
	(1209,37,1,6),
	(1210,37,2,6);

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
	(25,'files/1_1463241687.jpg','Beautiful sunset session during our surftrip at Taghazout, Morocco.','walden',1,'2016-05-14 18:01:27','Mechelen, BelgiÃ«'),
	(26,'files/2_1463471184.jpg','Jack Garratt!','xpro2',2,'2016-05-17 09:46:24',''),
	(27,'files/5_1463599517.jpg','Summer\'s here! I heard you like BBQ?','perpetua',5,'2016-05-18 21:25:17',''),
	(28,'files/4_1463599589.jpg','When in Vietnam...','brooklyn',4,'2016-05-18 21:27:11','Hanoi, Vietnam'),
	(29,'files/5_1463599670.jpg','Just add whisky.','perpetua',5,'2016-05-18 21:27:50','Holsbeek, BelgiÃ«'),
	(30,'files/4_1463599759.jpg','BEAUTIFUL SUNSET! OMG','earlybird',4,'2016-05-18 21:29:19','Holsbeek, BelgiÃ«'),
	(31,'files/5_1463599800.jpg','Coffee is love, coffee is life.','slumber',5,'2016-05-18 21:30:00','Holsbeek, BelgiÃ«'),
	(32,'files/4_1463599845.jpg','I miss London. Expensive city though...','Pick your filter',4,'2016-05-18 21:30:45','Holsbeek, BelgiÃ«'),
	(33,'files/5_1463599885.jpg','Food coma in 3, 2, 1...','lofi',5,'2016-05-18 21:31:25','Holsbeek, BelgiÃ«'),
	(34,'files/4_1463599918.jpg','Misty mountains...','Pick your filter',4,'2016-05-18 21:31:58','Holsbeek, BelgiÃ«'),
	(35,'files/5_1463599936.jpg','Taco Taco Taco!','Pick your filter',5,'2016-05-18 21:32:16','Holsbeek, BelgiÃ«'),
	(36,'files/4_1463599988.jpg','The Phillipines, my favourite travel destination!','Pick your filter',4,'2016-05-18 21:33:45','Banglao, Phillipines'),
	(37,'files/6_1463638566.jpg','He came, he saw, he conquered: Nico Morano!','Pick your filter',6,'2016-05-19 08:21:16','Houthalen-Helchteren, BelgiÃ«'),
	(38,'files/7_1463638653.jpg','Have you tried our Brie Burger?','Pick your filter',7,'2016-05-19 08:20:02','Leuven, BelgiÃ«'),
	(39,'files/7_1463638707.jpg','We know you want it!','walden',7,'2016-05-19 08:20:06','Leuven, BelgiÃ«'),
	(40,'files/8_1463639423.jpg','Work sucks, I know.','Pick your filter',8,'2016-05-19 08:31:07','De bergen, Zwitserland'),
	(41,'files/8_1463639492.jpg','VenetiÃ«, ideaal om even te ontspannen.','Pick your filter',8,'2016-05-19 08:31:51','Venezia, Italia');

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
  `avatar` varchar(255) DEFAULT 'images/profile.jpg',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`userID`, `email`, `fullname`, `username`, `password`, `private`, `bio`, `avatar`)
VALUES
	(1,'argentiero.leo@mail.com','Leandro Argentiero','Leandro','$2y$12$B1YDtwZvRgX/eQmKyRMM3Om1tnzntioxHamb9UOPrU03jhknPYZBy','no','Kidnapping moments','files/1_avatar.jpg'),
	(2,'diederik127@hotmail.com','Diederik Craps','Diederik','$2y$12$Jf8r7Y1sIXiUHCkJK5jn7uUQml6szHvtE8FeKYnCjupfKtC77oLmG','no','Ik ben Diederik, hoe gaat het met jou?','files/2_avatar.jpg'),
	(3,'hallo@thomas.be','Thomas Janssens','Tommie','$2y$12$YT1LdXxWMnp8Xf6EiuQ5ieaYArJcFcE6JsUkrdrbMlEUPeXBjCq8a','no',' ','images/profile.jpg'),
	(4,'travelgirl@travelmail.com','Lola Wanderlust','Wanderlola','$2y$12$F34j.hlz5/bN.0A6qVhxuuI.jl35isKdjQuEK3qTi0CJnM2UdVfH.','no','Where will I go next?','files/4_avatar.jpg'),
	(5,'bbqben@cookingmail.com','Ben Bridges','FoodboyBen','$2y$12$Q1OUBwB548ZdQjf7yQpTleIHviQEwJDY8bM71TZ0P/ZyQAPm8tpO2','no','Remember, food keeps us alive!','files/5_avatar.jpg'),
	(6,'xobe@mail.com','Extrema Outdoor Belgium','ExtremaOutdoor','$2y$12$t9.W4lL8N08HNlUvF5cNqOHqg22XIpzoxn9H4fpqN8/qoPIl3SDtm','no','House and Techno festival based in Houthalen-Helchteren, Belgium','files/6_avatar.jpg'),
	(7,'burgerfolie@mail.com','Burger Folie','BurgerFolie','$2y$12$yatU1EH0ifCMqgYqvT6Dyuhf0nN0FU/Rbcppxs277ePdFSSSwioXW','no','The best burgers in town. Don\'t believe us? Come and try for yourself! ','files/7_avatar.jpg'),
	(8,'pj@mail.com','Pieter-Jan','PJprive','$2y$12$DfoAL.DfD3Cky9sFV4aGjuCP29P5IHxZKyuwcTDvP8ydweUG8mmtW','yes','Pieter-Jan Donders, bijgenaamd PJ Thunder.','files/8_avatar.jpg');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
