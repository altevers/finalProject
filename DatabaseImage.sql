-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: csweb.hh.nku.edu    Database: db_spring18_alteversa1
-- ------------------------------------------------------
-- Server version	5.5.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `book_categories`
--

DROP TABLE IF EXISTS `book_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_categories` (
  `isbn` varchar(45) NOT NULL,
  `categoryid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_categories`
--

LOCK TABLES `book_categories` WRITE;
/*!40000 ALTER TABLE `book_categories` DISABLE KEYS */;
INSERT INTO `book_categories` VALUES ('0-672-31697-8',1),('0-672-31745-1',1),('0-672-31769-9',1),('18224',1),('0-672-31509-2',1),('0-672-31509-2',3),('69696969',1),('7070',2),('707070',2),('123456789',1),('123456789',2);
/*!40000 ALTER TABLE `book_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_reviews`
--

DROP TABLE IF EXISTS `book_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_reviews` (
  `isbn` char(13) NOT NULL,
  `review` text,
  PRIMARY KEY (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_reviews`
--

LOCK TABLES `book_reviews` WRITE;
/*!40000 ALTER TABLE `book_reviews` DISABLE KEYS */;
INSERT INTO `book_reviews` VALUES ('0-672-31697-8','Morgan\'s book is clearly written and goes well beyond \n                     most of the basic Java books out there.');
/*!40000 ALTER TABLE `book_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `isbn` char(13) NOT NULL,
  `author` char(50) DEFAULT NULL,
  `title` char(100) DEFAULT NULL,
  `price` float(4,2) DEFAULT NULL,
  PRIMARY KEY (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES ('0-672-31509-2','Pruitt, et al.','Teach Yourself GIMP in 24 Hours',24.99),('0-672-31697-8','Michael Morgan','Java 2 for Professional Developers',34.99),('0-672-31745-1','Thomas Down','Installing Debian GNU/Linux',24.99),('0-672-31769-9','Thomas Schenk','Caldera OpenLinux System Administration Unleashed',49.99),('123456789','Trent','Kappa Pride!',50.00),('18224','Jesse Hockenbury','Book 3',12.12),('69696969','Alex','Hello',69.00),('707070','Alex','Dreamweaver for dummies',10.00);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Technology'),(2,'English'),(3,'Science'),(4,'Fiction'),(5,'Sports'),(6,'Space'),(7,'Eating'),(8,'Breaking News');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapter`
--

DROP TABLE IF EXISTS `chapter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter` (
  `chapterID` int(11) NOT NULL AUTO_INCREMENT,
  `chapterName` varchar(40) NOT NULL,
  `localName` varchar(40) NOT NULL,
  `foundingDate` date NOT NULL,
  `missionStatement` text NOT NULL,
  `gender` varchar(1) NOT NULL,
  `logoURL` varchar(45) DEFAULT NULL,
  `president` int(11) DEFAULT NULL,
  `recruitment` int(11) DEFAULT NULL,
  PRIMARY KEY (`chapterID`),
  UNIQUE KEY `chapterID_UNIQUE` (`chapterID`),
  UNIQUE KEY `chapterName_UNIQUE` (`chapterName`),
  KEY `fk_chapter_president_idx` (`president`),
  KEY `fk_chapter_recruitment_idx` (`recruitment`),
  CONSTRAINT `fk_chapter_president` FOREIGN KEY (`president`) REFERENCES `membership` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_chapter_recruitment` FOREIGN KEY (`recruitment`) REFERENCES `membership` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapter`
--

LOCK TABLES `chapter` WRITE;
/*!40000 ALTER TABLE `chapter` DISABLE KEYS */;
INSERT INTO `chapter` VALUES (1,'Alpha Tau Omega','Theta Omega','1865-09-11','To bind men together in a brotherhood based upon eternal and immutable principles, \n    with a bond as strong as right itself and as lasting as humanity; to know no North, no South, no East, no West, but to know man as man, \n    to teach that true men the world over should stand together and contend for supremacy of good over evil; to teach, not politics, but \n    morals; to foster, not partisanship, but the recognition of true merit wherever found; to have no narrower limits within which to work \n    together for the elevation of man than the outlines of the world: these were the thoughts and hopes uppermost in the minds of the founders \n    of the Alpha Tau Omega Fraternity.','M','images/logos/AlphaTauOmega.jpg',NULL,NULL),(2,'Alpha Sigma Phi','Eta Phi','1845-12-06','Alpha Sigma Phi is not interested in only becoming the fraternity of choice, for this perspective\n    unnecessarily narrows our recruitment efforts to those inclined to go Greek. We instead, will be focused on appealing to a broader base of \n    undergraduate men, thereby competing directly with other activities and organizations on today\'s campuses. By so doing, we help to ensure \n    that we attract and recruit the very best and brightest undergraduate men.','M','images/logos/AlphaSigmaPhi.png',NULL,NULL),(3,'Phi Gamma Delta','Delta Colony','1848-05-01','Phi Gamma Delta exists to promote lifelong friendships, to reaffirm high ethical standards \n    and values, and to foster personal development in the pursuit of excellence. Phi Gamma Delta is committed to provide opportunities to each \n    brother to develop responsibility, leadership, scholarship and social skills in order to become a fully contributing member of society.','M','images/logos/PhiGammaDelta.png',NULL,NULL),(4,'Pi Kappa Alpha','Eta Rho','1868-03-01','Pi Kappa Alpha will set the standard of integrity, intellect, and achievement for our members, \n    host institutions, and the communities in which we live','M','images/logos/PiKappaAlpha.png',NULL,NULL),(5,'Delta Zeta','Kappa Beta','1902-10-24','The Delta Zeta Creed To the World, I Promise Temperance and Insight and Courage; To Crusade for justice, \n    To seek the truth and defend it always; To those whom my life may touch in slight measure, May I give graciously of what is mine; To my friends, \n    Understanding and appreciation; To those closers one, Love that is ever steadfast; To my mind, Growth; To myself, Faith; That I may walk truly In \n    the light of the Flame.','F','images/logos/DeltaZeta.png',NULL,NULL),(6,'Kappa Delta','Eta Eta','1897-10-23','Kappa Delta Sorority is a national organization for women committed to: inspiring our members to reach their \n    full potential; preparing our members for community service, active leadership and responsible citizenship; creating opportunities for lifetime \n    involvement through innovative and responsive programs and strategic collaborations and partnerships; and fostering the development of our time-honored \n    values within the context of friendship.','F','images/logos/KappaDelta.jpg',NULL,NULL),(7,'Delta Gamma','Zeta Sigma','1873-12-25','Delta Gamma Executive Offices\' mission is to advance the values of Delta Gamma Fraternity by providing professional\n    expertise, purpose-driven support and passionate commitment to members, friends and colleagues in the interest of “Doing Good.”','F','images/logos/DeltaGamma.png',NULL,NULL);
/*!40000 ALTER TABLE `chapter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `chapterID` int(11) NOT NULL,
  `postedAbout` int(11) NOT NULL,
  `postedBy` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`commentID`),
  UNIQUE KEY `commentID_UNIQUE` (`commentID`),
  KEY `fk_recruit_membership_idx` (`postedAbout`),
  KEY `fk_member_membership_idx` (`postedBy`),
  KEY `fk_chapter_membership_idx` (`chapterID`),
  CONSTRAINT `fk_chapter_membership` FOREIGN KEY (`chapterID`) REFERENCES `membership` (`chapterID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_member_membership` FOREIGN KEY (`postedBy`) REFERENCES `membership` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_recruit_membership` FOREIGN KEY (`postedAbout`) REFERENCES `membership` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,6,1,'Good guy, trys hard, loves the game.'),(2,1,6,1,'Hey, whats your name again?'),(4,1,6,1,'Makes good cake.'),(5,1,6,1,'He\'s the man!'),(6,1,8,1,'Knew him growing up. Great family. Culture fit.'),(7,1,13,1,'Really good guy!');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customerid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `address` char(100) NOT NULL,
  `city` char(30) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`customerid`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Julie Smith','25 Oak Street','Airport West','admin','password1'),(2,'Alan Wong','1/47 Haines Avenue','Box Hill',NULL,NULL),(3,'Michelle Arthur','357 North Road','Yarraville',NULL,NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `eventID` int(11) NOT NULL AUTO_INCREMENT,
  `chapterID` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `eventDate` date NOT NULL,
  `eventTime` time NOT NULL,
  `location` varchar(45) NOT NULL,
  `description` text,
  PRIMARY KEY (`eventID`),
  UNIQUE KEY `eventID_UNIQUE` (`eventID`),
  KEY `chapter_events_idx` (`chapterID`),
  CONSTRAINT `chapter_events` FOREIGN KEY (`chapterID`) REFERENCES `chapter` (`chapterID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (4,1,'Glow in the Dark Frisbee','2017-09-06','07:00:00','University Soccer Stadium','Come play some ultimate frisbee with the brothers of Alpha Tau Omega! Free food and drinks as well.'),(5,1,'Poker Night','2017-09-08','07:00:00','135 16th St. Newport, KY','Wins some chips with the brothers of Theta Omega! This is will take place \n    at one of our houses, The Clubhouse'),(6,1,'Cornhole Tournament','2017-09-09','11:00:00','Eli\'s BBQ','Eli\'s is one of the nations best BBQ joints. Enjoy a great lunch and a friendly\n    competition of cornhole, the Tri-State area\'s game!');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership`
--

DROP TABLE IF EXISTS `membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membership` (
  `membershipID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `chapterID` int(11) NOT NULL,
  `responsibilityID` int(11) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`membershipID`),
  UNIQUE KEY `membershipID_UNIQUE` (`membershipID`),
  KEY `fk_membership_users_idx` (`userID`),
  KEY `fk_membership_chapter_idx` (`chapterID`),
  KEY `fk_membership_responsibility_idx` (`responsibilityID`),
  CONSTRAINT `fk_membership_chapter` FOREIGN KEY (`chapterID`) REFERENCES `chapter` (`chapterID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_membership_responsibility` FOREIGN KEY (`responsibilityID`) REFERENCES `responsibility` (`responsibilityID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_membership_users` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership`
--

LOCK TABLES `membership` WRITE;
/*!40000 ALTER TABLE `membership` DISABLE KEYS */;
INSERT INTO `membership` VALUES (1,1,1,1,'Y'),(2,6,1,3,'Y'),(12,6,2,3,'N'),(13,8,2,3,'N'),(14,10,6,2,'Y'),(15,11,6,3,'N'),(16,11,7,3,'Y'),(17,8,1,3,'Y'),(18,13,1,3,'Y');
/*!40000 ALTER TABLE `membership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `orderid` int(10) unsigned NOT NULL,
  `isbn` char(13) NOT NULL,
  `quantity` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`orderid`,`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,'0-672-31697-8',2),(2,'0-672-31769-9',1),(3,'0-672-31509-2',1),(3,'0-672-31769-9',1),(4,'0-672-31745-1',3);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `orderid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customerid` int(10) unsigned NOT NULL,
  `amount` float(6,2) DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,3,69.98,'2000-04-02'),(2,1,49.99,'2000-04-15'),(3,2,74.98,'2000-04-19'),(4,3,24.99,'2000-05-01');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responsibility`
--

DROP TABLE IF EXISTS `responsibility`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responsibility` (
  `responsibilityID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`responsibilityID`),
  UNIQUE KEY `responsibilityID_UNIQUE` (`responsibilityID`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsibility`
--

LOCK TABLES `responsibility` WRITE;
/*!40000 ALTER TABLE `responsibility` DISABLE KEYS */;
INSERT INTO `responsibility` VALUES (1,'Administrator'),(2,'Chapter Member'),(4,'Guest'),(3,'Recruit');
/*!40000 ALTER TABLE `responsibility` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social`
--

DROP TABLE IF EXISTS `social`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social` (
  `socialID` int(11) NOT NULL AUTO_INCREMENT,
  `chapterID` int(11) NOT NULL,
  `platform` varchar(10) NOT NULL,
  `url` varchar(50) NOT NULL,
  `video` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`socialID`),
  UNIQUE KEY `socialID_UNIQUE` (`socialID`),
  KEY `fk_social_chapter_idx` (`chapterID`),
  CONSTRAINT `fk_social_chapter` FOREIGN KEY (`chapterID`) REFERENCES `chapter` (`chapterID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social`
--

LOCK TABLES `social` WRITE;
/*!40000 ALTER TABLE `social` DISABLE KEYS */;
INSERT INTO `social` VALUES (1,1,'Twitter','https://twitter.com/ATO_NKU',NULL),(2,1,'Instagram','https://instagram.com/ato_thetaomega',0),(3,1,'Vimeo','https://vimeo.com/232506928',0);
/*!40000 ALTER TABLE `social` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `nkuID` varchar(12) NOT NULL,
  `password` varchar(40) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `email` varchar(40) NOT NULL,
  `membership` int(11) NOT NULL DEFAULT '0',
  `gpa` decimal(4,3) DEFAULT NULL,
  `classLevel` varchar(10) DEFAULT NULL,
  `highSchool` varchar(40) DEFAULT NULL,
  `cellPhone` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userID_UNIQUE` (`userID`),
  UNIQUE KEY `nkuID_UNIQUE` (`nkuID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'alteversa1','password','Alexander','Altevers','M','alteversa1@nku.edu',1,3.788,'Senior','Boone County High School','8596409118'),(2,'andersonb11','JimmyJohns','Benjamin','Anderson','M','andersonb11@nku.edu',2,3.800,'Senior','Woodford County High School','8597974414'),(6,'bertrumc1','kitty','Craig','Bertrum','M','craigmaster@yahoo.com',3,NULL,NULL,NULL,NULL),(8,'koenigz1','blitzen','Zach','Koenig','M','zachattack@gmail.com',3,NULL,NULL,NULL,NULL),(10,'cooneyc1','1107Nku!!!!!!!','Claire','Cooney','F','cooneyc1@nku.edu',2,NULL,NULL,NULL,NULL),(11,'cooneyI1','1107Nku!!!!!!!','Isabella','Cooney','F','cooneyI1@nku.edu',3,4.000,'Junior','Notre Dame Academy','8599059858'),(12,'foxton','password','Shannon','Foxton','F','emailemail',1,4.000,'Junior',NULL,NULL),(13,'joej1','password','John','Joe','M','mailmail',3,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-25 16:55:58
