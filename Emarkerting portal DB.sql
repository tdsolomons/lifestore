CREATE DATABASE  IF NOT EXISTS `EMarketingPortal` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `EMarketingPortal`;
-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
--
-- Host: EMarketingPortal.db.11358052.hostedresource.com    Database: EMarketingPortal
-- ------------------------------------------------------
-- Server version	5.5.43-37.2-log

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
-- Table structure for table `auction_item`
--

DROP TABLE IF EXISTS `auction_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auction_item` (
  `item_id` int(11) NOT NULL,
  `starting_bid` decimal(10,2) DEFAULT NULL,
  `minimum_increment` decimal(5,2) DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `winner` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `fk_auction_item_user_idx` (`winner`),
  CONSTRAINT `fk_auction_item_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_auction_item_user` FOREIGN KEY (`winner`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auction_item`
--

LOCK TABLES `auction_item` WRITE;
/*!40000 ALTER TABLE `auction_item` DISABLE KEYS */;
INSERT INTO `auction_item` VALUES (1,10.00,10.00,'2015-11-10 04:40:17',5),(2,15.00,2.00,'2015-12-10 04:40:17',3),(158,100.00,100.00,'2015-11-22 09:00:17',2),(161,150.00,10.00,'2015-07-10 04:40:17',5),(162,9000.00,500.00,'2015-07-01 04:40:17',5),(164,100.00,10.00,'2015-01-01 00:00:00',1),(165,10000.00,500.00,'2015-07-01 04:40:17',5),(167,500.00,100.00,'2015-11-08 13:00:00',1),(168,500.00,100.00,'2015-11-22 23:30:00',2),(172,500.00,10.00,'2015-11-08 00:00:00',3),(174,9000.00,500.00,'2015-12-23 00:00:00',4),(175,8000.00,500.00,'2015-11-23 00:00:00',5);
/*!40000 ALTER TABLE `auction_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bid`
--

DROP TABLE IF EXISTS `bid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bid` (
  `auction_item` int(11) DEFAULT NULL,
  `bid_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) DEFAULT NULL,
  `bid_datetime` datetime DEFAULT NULL,
  `bidder` int(11) DEFAULT NULL COMMENT 'id of the bidding user',
  PRIMARY KEY (`bid_id`),
  KEY `fk_bid_auction_item_idx` (`auction_item`),
  KEY `fk_bid_user_idx` (`bidder`),
  CONSTRAINT `fk_bid_auction_item` FOREIGN KEY (`auction_item`) REFERENCES `auction_item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bid_user` FOREIGN KEY (`bidder`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bid`
--

LOCK TABLES `bid` WRITE;
/*!40000 ALTER TABLE `bid` DISABLE KEYS */;
INSERT INTO `bid` VALUES (2,7,1.00,'2015-05-10 04:40:17',1),(1,8,4.00,'2015-05-10 04:43:40',1),(1,9,2.00,'2015-05-10 04:44:50',1),(1,10,5.00,'2015-05-10 04:53:34',1),(1,11,4.00,'2015-05-10 05:01:09',1),(1,12,6.00,'2015-05-10 05:01:15',1),(1,13,6.00,'2015-05-10 05:35:21',1),(2,14,8.00,'2015-05-10 05:41:40',1),(2,15,9.00,'2015-05-10 05:41:50',1),(1,27,12.00,'2015-05-10 20:08:13',3),(1,28,15.00,'2015-05-10 21:58:52',3),(1,29,20.00,'2015-05-10 22:46:18',2),(1,30,26.00,'2015-05-10 23:57:13',3),(1,31,26.00,'2015-05-10 23:59:30',3),(1,32,31.00,'2015-05-11 00:01:01',3),(1,33,40.00,'2015-05-21 04:27:03',3),(1,34,46.00,'2015-05-21 04:27:34',3),(1,35,46.00,'2015-05-21 04:27:34',3),(158,36,105.00,'2015-06-27 05:01:03',3),(158,37,210.00,'2015-06-27 05:03:04',3),(1,38,0.00,'2015-06-28 07:55:58',3),(1,39,0.00,'2015-06-28 08:49:18',3),(1,40,0.00,'2015-06-28 08:49:59',3),(1,41,0.00,'2015-06-28 08:51:24',3),(1,42,0.00,'2015-06-28 08:52:34',3),(1,43,0.00,'2015-06-28 08:54:17',3),(1,44,0.00,'2015-06-28 08:55:01',3),(1,45,0.00,'2015-06-28 08:57:23',3),(1,46,56.00,'2015-06-28 08:59:28',3),(1,47,67.00,'2015-06-28 09:01:01',3),(165,48,600.00,'2015-06-29 00:09:01',1),(168,49,500.00,'2015-06-29 00:11:26',1),(168,50,600.00,'2015-06-29 00:11:33',1),(168,51,750.00,'2015-06-29 02:09:57',1),(1,52,0.00,'2015-07-11 02:36:19',3),(1,53,80.00,'2015-07-11 02:36:58',3),(1,54,95.00,'2015-07-11 02:38:19',3),(1,55,130.00,'2015-07-12 10:49:15',3),(1,56,200.00,'2015-07-12 10:49:28',3),(1,57,210.00,'2015-07-15 22:22:48',5),(1,58,280.00,'2015-08-22 21:01:33',3),(1,59,300.00,'2015-08-23 01:33:56',5),(1,60,365.00,'2015-08-23 01:40:50',5),(1,61,350.00,'2015-08-23 01:46:43',3),(174,62,600.00,'2015-08-23 12:42:26',1),(174,63,700.00,'2015-08-23 12:43:33',1),(175,64,500.00,'2015-08-23 12:56:04',3),(175,65,9000.00,'2015-08-23 12:58:27',3),(167,66,650.00,'2015-08-30 12:05:01',3),(167,67,800.00,'2015-08-30 12:06:23',5),(167,68,950.00,'2015-08-30 12:06:34',5),(167,69,1050.00,'2015-08-30 12:08:17',5),(167,70,1150.00,'2015-08-30 12:08:44',3),(167,71,1250.00,'2015-08-30 12:12:29',3),(167,72,1350.00,'2015-08-30 12:13:45',3),(167,73,1450.00,'2015-08-30 12:18:47',5),(167,74,1550.00,'2015-08-30 12:20:05',3),(167,75,1650.00,'2015-08-30 12:22:18',3),(167,76,1750.00,'2015-08-30 12:26:46',5),(167,77,1850.00,'2015-08-30 12:28:38',5),(167,78,1850.00,'2015-08-30 12:29:22',5),(167,79,1950.00,'2015-08-30 12:39:09',5),(167,80,2050.00,'2015-08-30 12:51:13',5),(167,81,2150.00,'2015-08-30 12:56:33',5),(167,82,2250.00,'2015-08-30 12:57:03',5),(167,83,2350.00,'2015-08-30 12:57:40',3),(167,84,2450.00,'2015-08-30 13:05:17',5),(167,85,2550.00,'2015-08-30 21:05:49',5),(167,86,2750.00,'2015-08-30 21:07:06',3),(167,87,3000.00,'2015-09-01 01:53:42',5),(167,88,3200.00,'2015-09-01 01:54:16',3);
/*!40000 ALTER TABLE `bid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) DEFAULT NULL,
  `parent_category` varchar(45) DEFAULT '6',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name_UNIQUE` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Jewelry & Watches','6'),(2,'Cellphones & Accessories','1'),(3,'Antiques','1'),(5,'Arts','6'),(6,'Baby','1'),(7,'Books','2'),(8,'Business & Industrial','1'),(9,'Cameras & Photo','5'),(11,'Clothing,Shoes & Accessories','6'),(12,'Coins & Paper Money','6'),(13,'Collectibles','5'),(14,'Computers/Tablets & Networking','1'),(15,'Consumer Electronics','1'),(16,'Crafts','6'),(17,'Dolls & Bears','5'),(18,'DVDs & Movies','5'),(19,'Entertainment Memorabilia','6'),(20,'Gift Cards & Coupons','6'),(21,'Health & Beauty','10'),(22,'Home & Garden','6'),(24,'Music','5'),(25,'Musical Instruments & Gear','6'),(27,'Pottery & Glass','6'),(28,'Real Estate','6'),(29,'Specialty Services','6'),(30,'Sporting Goods','6'),(31,'Sports Mem, Cards & Fan Shop','6'),(32,'Stamps','6'),(33,'Tickets & Experiences','5'),(34,'Toys & Hobbies','6'),(35,'Travel','6'),(36,'Video Games & Consoles','1'),(47,NULL,NULL),(54,'clothes','3');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `color` (
  `color_name` varchar(45) DEFAULT NULL,
  `value` varchar(45) DEFAULT NULL,
  `color_id` int(3) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`color_id`),
  UNIQUE KEY `color_name_UNIQUE` (`color_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` VALUES ('Red','1',1),('Green','2',2),('Blue','3',3);
/*!40000 ALTER TABLE `color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `condition_type`
--

DROP TABLE IF EXISTS `condition_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `condition_type` (
  `condition_id` int(1) NOT NULL AUTO_INCREMENT,
  `condition_title` varchar(45) DEFAULT NULL,
  `condition_description` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`condition_id`),
  UNIQUE KEY `condition_title_UNIQUE` (`condition_title`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `condition_type`
--

LOCK TABLES `condition_type` WRITE;
/*!40000 ALTER TABLE `condition_type` DISABLE KEYS */;
INSERT INTO `condition_type` VALUES (1,'New','A brand-new, unused, unopened, undamaged item in its original packaging (where packaging is applicable). Packaging should be the same as what is found in a retail store, unless the item is handmade or was packaged by the manufacturer in non-retail packaging, such as an unprinted box or plastic bag.'),(2,'New other','A new, unused item with absolutely no signs of wear. The item may be missing the original packaging, or in the original packaging but not sealed. The item may be a factory second or a new, unused item with defects.'),(3,'Manufacturer refurbished','An item that has been professionally restored to working order by a manufacturer or manufacturer-approved vendor. This means the product has been inspected, cleaned, and repaired to meet manufacturer specifications and is in excellent condition. This item may or may not be in the original packaging.'),(4,'Used','An item that has been restored to working order by the eBay seller or a third party not approved by the manufacturer. This means the item has been inspected, cleaned, and repaired to full working order and is in excellent condition. This item may or may not be in original packaging.');
/*!40000 ALTER TABLE `condition_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deal`
--

DROP TABLE IF EXISTS `deal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deal` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `fixed_price_item` int(11) DEFAULT NULL,
  `off_percentage` int(2) DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`deal_id`),
  KEY `fk_deal_fixed_price_item_idx` (`fixed_price_item`),
  CONSTRAINT `fk_deal_fixed_price_item` FOREIGN KEY (`fixed_price_item`) REFERENCES `fixed_price_item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deal`
--

LOCK TABLES `deal` WRITE;
/*!40000 ALTER TABLE `deal` DISABLE KEYS */;
INSERT INTO `deal` VALUES (1,4,20,'2015-09-30 12:00:00',1),(2,1,15,'2015-10-07 02:28:07',1),(3,42,10,'2015-01-01 12:00:00',1),(4,42,12,'2015-10-04 21:39:02',1),(5,44,8,'2015-10-30 01:12:12',1),(6,3,2,'2015-09-30 12:54:47',1),(7,3,2,'2015-09-30 12:55:24',1),(8,43,15,'2015-09-30 12:55:34',1),(9,43,10,'2015-10-14 20:00:00',1),(10,3,1,'0000-00-00 00:00:00',1),(11,4,1,'2015-10-04 06:35:38',1),(12,4,1,'2015-10-04 06:35:57',1),(13,2,1,'2015-10-05 01:00:00',1),(14,182,5,'2015-10-05 00:06:41',1),(15,2,5,'2015-10-05 01:27:52',1),(16,3,1,'2015-10-21 04:00:00',1),(17,1,1,'0000-00-00 00:00:00',1),(18,1,1,'0007-00-00 00:00:00',1);
/*!40000 ALTER TABLE `deal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `buyer_rating` int(1) DEFAULT NULL COMMENT 'Buyer’s rating About seller',
  `seller_rating` int(1) DEFAULT NULL COMMENT 'seller’s rating about the buyer',
  `buyer_comment` varchar(100) DEFAULT NULL,
  `seller_comment` varchar(100) DEFAULT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`order`),
  CONSTRAINT `fk_feedback_order` FOREIGN KEY (`order`) REFERENCES `order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (4,NULL,'nice...',NULL,1),(3,5,'','Excellent buyer',116),(3,3,'','Thank you!. come back again',117),(2,NULL,'Thanks, Good Item.',NULL,142),(3,NULL,'',NULL,143),(2,NULL,NULL,NULL,144),(3,NULL,'',NULL,145),(5,NULL,'Nice',NULL,151),(2,NULL,'',NULL,157);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fixed_price_item`
--

DROP TABLE IF EXISTS `fixed_price_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fixed_price_item` (
  `item_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `allow_offers` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`item_id`),
  CONSTRAINT `fk_fixed_price_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fixed_price_item`
--

LOCK TABLES `fixed_price_item` WRITE;
/*!40000 ALTER TABLE `fixed_price_item` DISABLE KEYS */;
INSERT INTO `fixed_price_item` VALUES (1,10000.00,0),(2,140000.00,1),(3,34900.00,0),(4,650.00,0),(42,35000.00,0),(43,7990.00,0),(44,9000.00,0),(150,120000.00,0),(151,800.00,0),(152,700.00,0),(159,122.00,0),(160,122.00,0),(163,18000.00,0),(166,30000.00,0),(169,3000.00,0),(170,5000.00,0),(171,100.00,0),(173,100.00,1),(176,800.00,0),(177,900.00,0),(178,1800.00,0),(179,1800.00,0),(180,1800.00,0),(181,12200.00,0),(182,1200.00,0),(183,1800.00,1),(184,1800.00,0);
/*!40000 ALTER TABLE `fixed_price_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follow`
--

DROP TABLE IF EXISTS `follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follow` (
  `buyer` int(11) NOT NULL,
  `seller` int(11) NOT NULL,
  PRIMARY KEY (`buyer`,`seller`),
  KEY `fk_follow_seller_idx` (`seller`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follow`
--

LOCK TABLES `follow` WRITE;
/*!40000 ALTER TABLE `follow` DISABLE KEYS */;
INSERT INTO `follow` VALUES (1,3),(1,5),(3,1),(5,1),(5,3);
/*!40000 ALTER TABLE `follow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `followed_search`
--

DROP TABLE IF EXISTS `followed_search`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `followed_search` (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `keywords` varchar(100) NOT NULL,
  `sorting` varchar(10) DEFAULT NULL,
  `max_price` decimal(10,2) DEFAULT NULL,
  `min_price` decimal(10,2) DEFAULT NULL,
  `free_shipping` int(1) DEFAULT NULL,
  `conditions` varchar(10) DEFAULT NULL,
  `item_type` varchar(10) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `seller` int(11) DEFAULT NULL,
  PRIMARY KEY (`search_id`),
  KEY `fk_followed_search_user_idx` (`user`),
  CONSTRAINT `fk_followed_search_user` FOREIGN KEY (`user`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `followed_search`
--

LOCK TABLES `followed_search` WRITE;
/*!40000 ALTER TABLE `followed_search` DISABLE KEYS */;
INSERT INTO `followed_search` VALUES (14,'iphone','',-1.00,-1.00,0,'1,2,3','auction',1,-1),(16,'camera','',10000.00,1000.00,1,'','all',1,-1),(17,'iphone 6','',-1.00,-1.00,1,'3','all',1,-1),(18,'drone','',-1.00,-1.00,1,NULL,'all',1,-1),(19,'drone','',-1.00,-1.00,1,NULL,'all',1,-1),(20,'drone','',-1.00,-1.00,1,NULL,'all',1,-1),(21,'drone','',-1.00,-1.00,1,NULL,'all',1,-1),(22,'drone','',-1.00,-1.00,1,NULL,'all',1,-1),(23,'drone','',-1.00,-1.00,1,NULL,'all',1,-1),(24,'Mesns shoes','',10000.00,-1.00,1,NULL,'all',1,-1),(25,'iphone 4','',-1.00,-1.00,1,NULL,'all',1,-1),(26,'iphone','',-1.00,-1.00,0,NULL,'auction',1,-1),(27,'iphone','',-1.00,-1.00,0,NULL,'all',3,-1),(28,'watch','',-1.00,-1.00,0,NULL,'buynow',3,-1),(29,'watch','',-1.00,-1.00,0,NULL,'buynow',1,-1),(30,'watch','',-1.00,-1.00,1,NULL,'all',3,-1),(32,'drone','',-1.00,-1.00,0,NULL,'buynow',5,-1),(33,'iphone','',-1.00,-1.00,1,NULL,'all',5,-1),(34,'iphone','',-1.00,-1.00,1,NULL,'all',5,-1),(35,'iphone 6','',-1.00,-1.00,1,NULL,'buynow',5,-1),(36,'','',-1.00,-1.00,0,NULL,'buynow',3,-1);
/*!40000 ALTER TABLE `followed_search` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_has_condition`
--

DROP TABLE IF EXISTS `fs_has_condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fs_has_condition` (
  `followed_search` int(11) NOT NULL,
  `condition_type` int(1) NOT NULL,
  PRIMARY KEY (`followed_search`,`condition_type`),
  KEY `fk_fs_has_condition_condition_type_idx` (`condition_type`),
  CONSTRAINT `fk_fs_has_condition_followed_search` FOREIGN KEY (`followed_search`) REFERENCES `followed_search` (`search_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fs_has_condition_condition_type` FOREIGN KEY (`condition_type`) REFERENCES `condition_type` (`condition_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_has_condition`
--

LOCK TABLES `fs_has_condition` WRITE;
/*!40000 ALTER TABLE `fs_has_condition` DISABLE KEYS */;
INSERT INTO `fs_has_condition` VALUES (20,1),(23,1),(24,1),(26,1),(27,1),(28,1),(29,1),(30,1),(34,1),(35,1),(27,2),(34,2),(35,2),(25,3),(27,3),(20,4),(23,4),(25,4),(26,4),(27,4);
/*!40000 ALTER TABLE `fs_has_condition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gift_item`
--

DROP TABLE IF EXISTS `gift_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gift_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gift_name` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gift_item`
--

LOCK TABLES `gift_item` WRITE;
/*!40000 ALTER TABLE `gift_item` DISABLE KEYS */;
INSERT INTO `gift_item` VALUES (1,'LifeStore.lk Gift Card','500','2.png'),(2,'LifeStore.lk Gift Card','1000','1.png'),(3,'LifeStore.lk Gift Card','2000','3.png'),(4,'LifeStore.lk Gift Card','3000','4.png'),(12,'LifeStore.lk Gift Card','0',NULL);
/*!40000 ALTER TABLE `gift_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gift_purchased`
--

DROP TABLE IF EXISTS `gift_purchased`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gift_purchased` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gift_item_id` int(11) DEFAULT NULL,
  `gift_code` varchar(30) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `used` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gift_purchased`
--

LOCK TABLES `gift_purchased` WRITE;
/*!40000 ALTER TABLE `gift_purchased` DISABLE KEYS */;
INSERT INTO `gift_purchased` VALUES (1,2,'0',3,0),(2,2,'Sc8I4AUCMUx75eWd1F2n',3,1),(3,5,'CsaS0peZcms5zANEaIgW',3,1),(4,1,'1WU23syqaEC6iGJLLtcf',3,1),(5,1,'XEd9GHC0CYbEV5GZyfpJ',3,1),(6,1,'ncwBxKgf1PF3L6sTEyX9',3,0),(7,1,'XM4JeilcmUdK7KlFvCUw',1,0),(8,3,'sAAdG36kB4uyQyi5QDic',1,0),(9,3,'6PSv8Yk86u7lF8QIlHGS',1,0),(10,3,'5aYbCbpJB1jiORB61xCm',3,0),(11,3,'drEeJpgwhn8my7xaiXUU',3,0),(12,3,'ZdcN4OU6lxtyZ7NIx3fO',3,0),(13,1,'cwEUpdllKnITlBvayYSz',3,0),(14,1,'4yxeGyCsOK8MG9WN4WN3',3,0),(15,1,'pPMRfVYmDthTpS7ycXag',1,0),(16,1,'WhL7oSRTwCUnkOd0bENa',1,0),(17,1,'FvxB1z452IPZ0A6ptYi0',1,0),(18,2,'BdnV1AWdfJnUfVwguBmw',1,0),(19,2,'jbvjMCJfB2gcfD7he3vt',1,0),(20,2,'L535X7N1D8PTp2ADhXFo',1,0),(21,2,'TG73EkCLbh3Xm62keQmS',1,0),(22,2,'YbLndm1vkGTen1h1lUMw',1,0),(23,2,'CH137RSu0ZYuuLckNGw3',1,0),(24,2,'MSxYVWZCEmUg3WkbNdFN',1,0),(25,2,'7oQiogu5saPbNgQTuy4A',1,0),(26,1,'VP7Psrzmy6XCzmcmahjC',1,0),(27,1,'YKtdAPLg8Q08kJq09PEG',1,0),(28,1,'lW4M1ZvhK3kJNOXoDIEL',1,0),(29,1,'EJlhlEGfGtmuICzGoKgO',1,0),(30,1,'BIZXOtYPrOQSwohNc7Y3',1,0),(31,1,'iMyAN5LXYMdzvcxkGw98',1,0),(32,1,'k00QpiECpCFIpdjdi5bh',1,0),(33,1,'HbTOXodJ1gnxgBiBE2VM',1,0),(34,1,'SFFiPm2W9bFWONRh6MkU',3,1),(35,1,'82hziwQJk4qcJ6vzsxvB',3,0),(36,1,'JbyxYpP5caZkcgTuNKd7',3,0),(37,1,'OEkyKP7dnDO6PmENMuTY',3,0),(38,1,'ESjQ9clXWz4LdojYerbB',3,0),(39,1,'40ITnmHaQA8vtsmDFHAC',3,0),(40,1,'pUZoDTfhesSkwfPHDgJK',3,0),(41,1,'ZJO5OShS4K3ZAhJ9re1v',3,0),(42,2,'nSx95cB8jSwJXPaqqBcs',3,0),(43,3,'UfkSTPfOLpm9hUin6Uvq',3,0),(44,1,'pmVpCzaTfitCHgPaPjYt',3,0),(45,2,'AVrApvD440HHHdYnPprL',3,0);
/*!40000 ALTER TABLE `gift_purchased` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(45) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `button_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  UNIQUE KEY `file_name_UNIQUE` (`file_name`),
  KEY `fk_image_item_idx` (`item_id`),
  CONSTRAINT `fk_image_id_Cascade` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=654 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,'8934891393EW1',1,'8934891393EW1.jpg',1),(2,'8934891393EW2',1,'8934891393EW2.jpg',1),(3,'8934891393EW3',1,'8934891393EW3.jpg',1),(4,'8934891393EW4',1,'8934891393EW4.jpg',1),(5,'4234234123ER1',2,'4234234123ER1.jpg',1),(6,'4234234123ER2',2,'4234234123ER2.jpg',1),(7,'3432231SD1',3,'3432231SD1.jpg',1),(8,'3432231SD2',3,'3432231SD2.jpg',1),(9,'3432231SD3',3,'3432231SD3.jpg',1),(10,'4313213213WW',4,'4313213213WW.jpg',1),(14,'2321321232W1',42,'2321321232W1.jpg',1),(15,'2321321232W2',42,'2321321232W2.jpg',1),(16,'ERE1232131R1',43,'ERE1232131R1.jpg',1),(17,'ERE1232131R2',43,'ERE1232131R2.jpg',1),(18,'213213EEREE1',44,'213213EEREE1.jpg',1),(614,'44461740000150',150,'44461740000150.jpg',1),(615,'39078280000151',151,'39078280000151.jpg',1),(616,'45130560000152',152,'45130560000152.jpg',1),(622,'70650470000158',158,'70650470000158.JPG',1),(623,'34326420000160',160,'34326420000160.jpg',1),(624,'23859490000160',160,'23859490000160.jpg',2),(626,'99565110000159',159,'99565110000159.jpg',1),(630,'19358990000161',161,'19358990000161.JPG',1),(631,'55662920000162',162,'55662920000162.JPG',1),(632,'78870790000163',163,'78870790000163.jpg',1),(633,'50933700000164',164,'50933700000164.jpg',1),(634,'18225620000165',165,'18225620000165.jpg',1),(635,'15497120000166',166,'15497120000166.jpg',1),(636,'3444060000166',166,'3444060000166.jpg',2),(637,'63465560000167',167,'63465560000167.JPG',1),(638,'40170370000167',167,'40170370000167.jpg',2),(639,'56044150000168',168,'56044150000168.jpg',1),(640,'94620200000168',168,'94620200000168.jpg',2),(641,'89109800000169',169,'89109800000169.jpg',1),(642,'1641070000170',170,'1641070000170.jpg',1),(643,'67303420000171',171,'67303420000171.jpg',1),(644,'79226030000173',173,'79226030000173.jpg',1),(645,'15917910000174',174,'15917910000174.jpg',1),(646,'24521010000175',175,'24521010000175.jpg',1),(647,'43666970000176',176,'43666970000176.jpg',1),(648,'74900080000177',177,'74900080000177.jpg',1),(649,'98539080000178',178,'98539080000178.jpg',1),(650,'34969860000179',179,'34969860000179.jpg',1),(651,'4787210000180',180,'4787210000180.jpg',1),(652,'32617410000181',181,'32617410000181.jpg',1),(653,'14514860000182',182,'14514860000182.jpg',1);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `posted_date` datetime DEFAULT NULL,
  `shipping_cost` decimal(10,2) DEFAULT NULL,
  `category` int(2) DEFAULT NULL,
  `main_image` int(11) DEFAULT NULL,
  `seller` int(11) NOT NULL,
  `available_quantity` int(11) DEFAULT NULL,
  `condition_type` int(1) DEFAULT NULL COMMENT 'value from condition_type table',
  `item_status` int(1) DEFAULT '1',
  PRIMARY KEY (`item_id`),
  KEY `fk_item_category_idx` (`category`),
  KEY `fk_item_main_image_image_idx` (`main_image`),
  KEY `fk_item_seller_user_idx` (`seller`),
  KEY `fk_item_condition_type_idx` (`condition_type`),
  CONSTRAINT `fk_item_category` FOREIGN KEY (`category`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_condition_type` FOREIGN KEY (`condition_type`) REFERENCES `condition_type` (`condition_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_main_image_image` FOREIGN KEY (`main_image`) REFERENCES `image` (`image_id`),
  CONSTRAINT `fk_item_seller_user` FOREIGN KEY (`seller`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'Tommy Hilfiger Noah White Dial Blue Rubber Watch','New with tags: A brand-new Quartz, Analog watch. Brand:	\r\nTommy Hilfiger','2015-03-01 12:12:00',100.00,1,1,1,12,1,1),(2,'Apple iPhone 6 - 16GB - Silver - Warranty (Factory Unlocked)','New Condition, Original Box With All Accessories.\r\n\r\nFactory Unlocked -- Connect This iPhone To Any GSM Carrier Anywhere In The World.\r\n\r\n110V & 220V AC Chargers Included For Worldwide Use.\r\n\r\nApple One Year Warranty Coverage Until January 2016.\r\n\r\nFree Shipping in the United States By Priority Mail.\r\n\r\nLow Cost Fast Shipping To Anywhere In The World.\r\n\r\nBuy With Confidence From a 100% Rated Seller.\r\n\r\nMAKE ANY OFFER!! SUPER LOW RESERVE!!','2015-03-02 06:00:00',0.00,2,5,5,3,1,1),(3,'NEW GOPRO HERO 3 BLACK Camera/Camcorder 4K/2K/1080P + Extra Battery + Polarizer','Key Benefits: - Wearable, mountable design - Immersive, wide angle capture of your favorite activities\n- Professional quality HD video & 12MP photos\n- Built-in Wi-Fi enables remote control via included Wi-Fi Remote or live video preview and remote control on smartphones and tablets running the free GoPro app.\n- Rugged housing is waterproof to 197\'/60M and captures sharp images above and below water\n- Compatible with all GoPro mounts for attaching to gear, body, helmets, vehicles and more - \nCompatible with LCD Touch BacPac and second generation Battery BacPac - Backwards compatible with older generation BacPacs\n- New advanced camera settings: Looping video, Continuous Photo, Manual White Balance control, Protune Mode, allows to shoot photos while recording video and more.\n\nKey Specs: - Professional 4K Cinema 15 fps / 2.7K cinema 30 fps / 1440p 48 fps / 1080p 60 fps / 960p 100 fps /720p 120 fps and more video capture - 12MP photo capture with 30 fps burst - Wi-Fi Built-In - Wi-Fi Remote Compatible (included) - GoPro App Compatible (FREE) - 197\'/ 60m Waterproof Housing* - Assorted mounts and hardware included for attaching to helmets, gear and more','2015-03-04 01:23:01',0.00,47,7,1,10,1,1),(4,'CHANEL ROUGE ALLURE GLOSS  Lipgloss','An exceptional gloss to wear like a lipstick. The first gloss that combines lacquered shine with the bold style of an intense colour. A click and a black case that are now part of the ROUGE ALLURE legend. A gloss for women who love lipstick. A lipstick for women who love gloss. \r\n\r\nA high concentration of finely ground pigments for exceptional radiance, intensity and purity\r\n\r\nThe combination of a film-forming polymer and glass microbeads creates a mirror effect and optimises shine with a lacquered effect \r\n\r\nTwo polymers join forces to maintain shine and hold for hours on end \r\n\r\nA unique blend of active ingredients composed of sappan wood, matcha green tea butter and a Vitamin E derivative known for its ability to moisturise and protect the lips','2015-03-04 01:23:01',20.00,21,10,5,1,1,0),(42,'Canon Camera + Accessories','The Canon EOS Rebel T5 DSLR Camera is an 18MP APS-C format DSLR camera with a DIGIC 4 image processor. The combination of the T5\'s CMOS sensor and DIGIC 4 image processor provide high clarity, a wide tonal range, and natural color reproduction. With an ISO range of 100-6400 (expandable to 12800), you can shoot in low-light situations, reducing the need for a tripod or a flash. The nine-point autofocus system includes one center cross-type AF point to deliver accurate focus in both landscape and portrait orientations.','2015-03-23 07:00:00',2000.00,9,14,3,2,1,1),(43,'Canon PowerShot Elph 100 / Ixus 115 Digital Camera','This is a Canon Elph100 / IXus 115   Digital Camera\n\nit supports  x4 optical zoom ,12 megapixels. and more.\n\ncamera is fully functional\n\nSale include :\n\n* camera\n\n* 3rd party charger\n\n* battery\n\n* new pouch for camera\n\n* wrist strap\n\n* usb memory reader','2015-02-21 04:00:00',50.00,9,16,1,0,4,1),(44,'F39 HD 1080P WIFI Action Sports Camera 5.0MP Waterproof Camcorder','<p>This F39 Action camera features 5.0MP effective pixels, , 8.0MP pixel interpolation. 1080P 30fps/720P 60fps/720P 30fps. 4X zoom, 120 degree viewing angle. Wifi/IR remote comtroller/20 meters waterproof continuous shooting/self time/white balance. HDMI video output, support H.264 video format. Support IP Camera. Most support 32GB Min SD card. Built-in 1000mA battery. Vivitar OEM Pro Action Camcorder-- IR remote Underwater Action Camera connects to Android/IOS Smart</p>','2015-02-28 04:00:00',0.00,9,18,3,3,1,1),(150,'Dell Inspiron 17.3','Dell Inspiron 17.3\" Laptop , Intel i5 Dual-Core Processor\r\n8GB DDR3 RAM, 1TB HDD, HD Graphics 1600x900, HDMI\r\nDVD+/-RW, Bluetooth, HD Webcam, USB 3.0, Windows 8.1 \r\nColor (Silver), 1 Year Dell Warranty (Will Ship Worldwide)','2015-05-10 00:00:00',2500.00,14,614,3,4,1,0),(151,'NIB','NIKE\r\nJORDAN CP3.VII  \r\n\"BEL AIR\"\r\nBASKETBALL  SHOE\r\nBLACK / GAMMA BLUE - WHITE - FLASH LIME\r\nSKU #  616805 015','2015-05-10 00:00:00',20.00,11,615,3,2,1,1),(152,'Crystal 925 Sterling Silver Fashion Plated Pendant Necklace Chain Jewelry','100% brand new\r\nColor: Silver\r\nChain Size: 18 inch\r\nPendant size:1.7CM*1.0CM\r\nMaterial : 925 Silver Pleated Alloy\r\nPackage include : 1 X Necklace','2015-05-10 00:00:00',100.00,1,616,3,2,1,1),(158,'test','tsting','2015-05-10 00:00:00',100.00,3,622,5,1,1,0),(159,'test2','wert','2015-06-24 00:00:00',122.00,47,626,3,1,1,0),(160,'test3','wrert','2015-06-24 00:00:00',122.00,5,623,3,12,1,0),(161,'1/32 Scale Diecast Car Alloy Model Toy Audi A7 Super Sport Vehicle w/Light&Sound','Condition:New\r\nMaterial:Alloy,Plastic\r\nSize:15.5(L)*6.0(W)*4.5(H)cm\r\nProportion:1:32\r\nFunction:with light and sound,four doors could be opened and back power\r\nColor:Silver\r\nPackage includes: 1pc Audi A7 diecast car Alloy Model;\r\nImportance 1:children should be supervised by parents or guardians while playing.\r\nImportance 2:The item was made of Alloy,it may have a little paint stripping,if you mind,kindly do not purchase here\r\nImportance 3:Pls do not blow and damage','2015-06-27 00:00:00',50.00,34,630,3,1,1,0),(162,'Apple iPhone 4S 16GB \"Factory Unlocked\" Black and White Smartphone GSM','Just when you thought a smartphone couldn’t get any better, it just did — the iPhone 4S is sure to change the way you communicate. The Siri technology lets you talk to this Apple smartphone as you would talk to a person, turning the iPhone 4S into a personal assistant. The powerful dual-core A5 chip ensures that this Apple phone gives you a lightning-fast performance and life-like graphics. Shoot 1080p HD videos and click crystal-clear snaps with the 8 MP camera of this Apple smartphone. To make your life easier, this Apple phone runs on iOS 5 that lets you enjoy numerous features and an easy-to-use interface. That’s not all; with the iCloud feature of the iPhone 4S, you can stop worrying about managing your stuff, because your phone does it for you.\r\n\r\nProduct Highlights\r\nVideo \r\n\r\n\r\nProduct Identifiers\r\nBrand Apple\r\nMPN MD234LL/A\r\nCarrier Factory Unlocked\r\nFamily Line Apple iPhone\r\nModel 4s\r\nUPC 885909537945\r\nType Smartphone','2015-06-27 00:00:00',600.00,2,631,3,1,4,0),(163,'Apple iPhone 4s - 16GB - Black (Sprint Unlocked) Smartphone','Brand	Apple\r\nCarrier	Unlocked\r\nFamily Line	Apple iPhone\r\nModel	4s\r\nType	Smartphone\r\n\r\nKey Features\r\nStorage Capacity	16GB\r\nColor	Black\r\nNetwork Generation	3G\r\nNetwork Technology	CDMA2000 1X / GSM / WCDMA (UMTS), GSM / EDGE / WCDMA (UMTS) / HSDPA / HSUPA / CDMA EV-DO Rev. A\r\nBand	GSM/EDGE 850/900/1800/1900 (Quadband) WCDMA (UMTS)/HSDPA/HSUPA 850/900/1900/2100 CDMA EV-DO Rev. A 800/1900\r\nStyle	Bar\r\nCamera	8.0MP','2015-06-27 00:00:00',100.00,2,632,3,1,1,0),(164,'bid Test x','werw','2015-06-28 00:00:00',122.00,3,633,3,12,1,0),(165,'Apple iPhone 4S 16GB GSM Factory Unlocked iOS Smartphone - Black & White','Product Identifiers\r\nBrand Apple\r\nCarrier Unlocked\r\nFamily Line Apple iPhone\r\nModel 4s\r\nType Smartphone\r\n\r\nKey Features\r\nStorage Capacity 16GB\r\nColor White\r\nNetwork Generation 3G\r\nNetwork Technology CDMA2000 1X / GSM / WCDMA (UMTS), GSM / EDGE / WCDMA (UMTS) / HSDPA / HSUPA / CDMA EV-DO Rev. A\r\nBand GSM/EDGE 850/900/1800/1900 (Quadband) WCDMA (UMTS)/HSDPA/HSUPA 850/900/1900/2100 CDMA EV-DO Rev. A 800/1900\r\nStyle Bar\r\nCamera 8.0MP\r\n\r\nBattery\r\nBattery Type Lithium Ion\r\nBattery Capacity 1432 mAh\r\nBattery Talk Time Up to 840 min\r\nBattery Standby Time Up to 200 hr\r\n\r\nDisplay\r\nDisplay Technology TFT LCD\r\nDiagonal Screen Size 3.5\"\r\nDisplay Resolution 960 x 640 pixels','2015-06-28 00:00:00',600.00,2,634,3,1,4,1),(166,'Apple iPhone 5 16GB FACTORY UNLOCKED Smartphone Black or White PT4R','A slim and stylish design makes the Apple iPhone 5 smartphone lightweight and easy-to-carry around. The Apple iPhone 5 runs on the iOS 6 software which offers phone applications such as FaceTime, Safari, and Siri. Applications run faster and games load quickly as this black and slate Apple iPhone is powered by an A6 chip. An 8 MP iSight camera allows you to take crisper videos and self-portraits. Boredom is never an option with the Apple iPhone 5, as it gives direct access to iTunes, so you can listen to your favorite tracks anytime. And a 4-inch retina display with 326 pixels per inch on this Apple iPhone makes the text easier to read and movies more fun to watch. What’s more, this 16 GB smartphone, available factory unlocked, supports Wi-Fi connectivity, so you can browse the Web, stream videos, shop online, and chat with friends from wherever you are.\r\n\r\n\r\nProduct Identifiers\r\nBrand Apple\r\n\r\n\r\nCarrier Factory Unlocked\r\nFamily Line Apple iPhone\r\nModel 5\r\nType Smartphone\r\n\r\nKey Features\r\nStorage Capacity 16 GB\r\n\r\n\r\nNetwork Generation 2G, 3G, 4G\r\nStyle Smartphone\r\nCamera 8.0 MP\r\n\r\nBattery\r\nBattery Type Rechargeable Li-Ion Battery\r\nBattery Talk Time Up to 480 min\r\nBattery Standby Time Up to 225 hr\r\n\r\nDisplay\r\nDisplay Technology Retina\r\nDiagonal Screen Size 4 in.\r\nDisplay Resolution 1136 x 640 pixels','2015-06-28 00:00:00',0.00,2,635,3,4,2,1),(167,'Fashion Women Summer Chiffon Short Sleeve Casual Loose T Shirt Blouse Tops Shirt','Features:\r\n100% Brand New and High Quality!\r\n\r\nWeight: 120g\r\nAvailable Colors:As picture show!!\r\n\r\nMaterial: Chiffon\r\n\r\nStyle: Fashion, Charming\r\n\r\nSize: S/M/L/XL please allow 1-3cm differs due to manual measurement, thanks (all measurement in cm and please note 1cm=0.39inch) .\r\n\r\nNote: This is Label Size(Asian/China size)about 2/3 sizes smaller than US/AU/EU size. Please, make sure of these actual measurements will fit you,Thanks.','2015-06-28 00:00:00',100.00,11,637,1,1,1,1),(168,'Fashion Women\'s Sleeveless Loose V-neck Chiffon Vest Shirt Blouses Tops','Specification: Solid, Sleeveless, V-neck\r\n\r\nColor: White, Black\r\n\r\nMaterial: Chiffon\r\n\r\nSize: Asian Size S M L XL','2015-06-28 00:00:00',0.00,11,639,3,3,1,1),(169,'testItem1','testItem1 description','2015-06-29 00:00:00',25.00,47,641,11,3,1,1),(170,'testItem','test/item','2015-06-29 00:00:00',45.00,47,642,12,45,1,0),(171,'testingHTML','<p><strong><span style=\"background-color:#FFD700\">Test Page DES</span></strong></p>\r\n\r\n<h1><span style=\"color:#000000\"><span style=\"background-color:rgb(255, 215, 0)\">Test </span></span><span style=\"color:#FFD700\"><span style=\"background-color:#FFD700\">I</span></span></h1>\r\n\r\n<hr />\r\n<div class=\"videodetector\"><iframe frameborder=\"0\" src=\"https://www.youtube.com/embed/m3JAtvsqfF8?autohide=1&amp;controls=1&amp;showinfo=0\"></iframe></div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>','2015-07-13 00:00:00',1000.00,3,643,3,1,1,0),(172,'Apple iPhone 4S 16GB \"Factory Unlocked\" Black and White Smartphone GSM','test','2015-07-15 00:00:00',100.00,2,NULL,5,1,1,0),(173,'teatoffers','<p>qwerrty</p>','2015-08-20 00:00:00',10.00,3,644,3,1,1,0),(174,'FPV JJRC H8D 6-Axis Gyro RC Quadcopter Drone 5.8G HD Camera + Monitor +2 Battery','Feature\r\nBrand Name:JJRC\r\nModel:H8D\r\nColor: Red,Banggood Version-Orange\r\nRemote Frequency: 2.4G\r\nChannel: 4CH\r\nGyro: 6 axis\r\nTransmission Frequency: 5.8G\r\nFlight Duration: 8 Minutes\r\nRemote Control Distance: 300 meters\r\nRecharging Time: 110mins\r\nBattery For Quadcopter: 7.4V 500 mAh(included)\r\nBattery For Transmiter: 4 x 1.5V AA Battery (not included)\r\nSize:33 x 33 x 11.5cm\r\nCertificate: EN71,EN62115,EN60825,HR4040,6P,R&TTE,ROHS\r\nFunction: ascend/descend/forward/backward/side flying/360°rolling action/hover/3D/LED/camera/5.8G transmission/CF mode/One key return','2015-08-23 00:00:00',600.00,34,645,3,1,1,1),(175,'Syma X8W 2.4Ghz 6-Axis Gyro RC Quadcopter Drone UAV RTF UFO 2MP HD Wifi Camera','Brand Name:                  SYMA\r\nItem Name:                     6 Axis 4CH Venture explorers Quadcopter FPV Real-time Video Transmission\r\nItem NO.:                        X8W\r\nColor:                              White\r\nFrequency:                      2.4Ghz\r\nChannel:                          4CH With 6 Axis Gyro Stabilization System\r\nCamera:                           With One Wifi Camera  \r\nTransmitter:                      With One Transmitter(Remote Control)       \r\nMemory Card:                   With a 4GB Memory Card  \r\nBattery for Quadcopter:     2000mAh Li-poly\r\nCharging Time:                  About 120 mins\r\nFlying time:                        About 10-12 minutes\r\nDimension:                        50*50*19cm\r\nWeight:                             1484g\r\nFlight Distance                  About 50 meter','2015-08-23 00:00:00',100.00,34,646,1,1,1,1),(176,'New Fashion Men\'s Date Leather Stainless Steel Military Sport Quartz Wrist Watch','<table cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Style:</td>\r\n			<td>Luxury: Dress Styles</td>\r\n			<td>Movement:</td>\r\n			<td>Quartz : Battery</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Features:</td>\r\n			<td>Light</td>\r\n			<td>Display:</td>\r\n			<td>Analog</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Band Material:</td>\r\n			<td>PU Leather</td>\r\n			<td>Model:</td>\r\n			<td>\r\n			<h2>Watch</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Brand:</td>\r\n			<td>\r\n			<h2>Unbranded/Generic</h2>\r\n			</td>\r\n			<td>MPN:</td>\r\n			<td>\r\n			<h2>Not Applicable</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Dial Diameter:</td>\r\n			<td>Approx 40 mm</td>\r\n			<td>Serial Number:</td>\r\n			<td>Not Applicable</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Dial Thickness:</td>\r\n			<td>Approx 10.5mm</td>\r\n			<td>Country/Region of Manufacture:</td>\r\n			<td>China</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Watch Strap Length:</td>\r\n			<td>Approx 230mm</td>\r\n			<td>Gender:</td>\r\n			<td>Unisex</td>\r\n		</tr>\r\n		<tr>\r\n			<td>UPC:</td>\r\n			<td>\r\n			<h2>Not applicable</h2>\r\n			</td>\r\n			<td>ISBN:</td>\r\n			<td>\r\n			<h2>Not applicable</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>EAN:</td>\r\n			<td>\r\n			<h2>Not applicable</h2>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>','2015-10-04 00:00:00',0.00,1,647,5,9,1,1),(177,'Fashion Men\'s Analog Sport Steel Case Quartz Dial Synthetic Leather Wrist Watch','<p>-&nbsp;100% brand new and high quality.</p>\r\n\r\n<p>-&nbsp;Without date display.</p>\r\n\r\n<p>-&nbsp;Daily water resistance (not for showering and swimming).</p>\r\n\r\n<p>-&nbsp;Color may not appear as exactly as in real life due to variations between the computer monitors&nbsp;and nacked eye color difference.</p>','2015-10-04 00:00:00',100.00,1,648,5,13,1,1),(178,'Men\'s Fashion Black Stainless Steel Luxury Sport Analog Quartz Wrist Watch GIFT','<ul>\r\n	<li><strong>100% brand new and high quality</strong></li>\r\n	<li>Dial Window Material Type:Glass</li>\r\n	<li>Case Material:Alloy</li>\r\n	<li>Movement:Quartz</li>\r\n	<li>Style:Fashion &amp; Casual</li>\r\n	<li>Gender:Unisex</li>\r\n	<li>Dial Display:Analog</li>\r\n	<li>Case Shape:Round</li>\r\n	<li>Dial Diameter:&nbsp;Approx 43 mm</li>\r\n	<li>Dial Thickness: Approx 11 mm</li>\r\n	<li>Watch Strap Length: Approx 255 mm</li>\r\n	<li>Watch Strap Width: Approx 22 mm</li>\r\n</ul>','2015-10-04 00:00:00',0.00,1,649,5,10,1,1),(179,'Fashion Men\'s Analog Sport Steel Case Quartz Dial Synthetic Leather Wrist Watch','<table cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Strap Material:</td>\r\n			<td>Stainless Steel</td>\r\n			<td>Brand:</td>\r\n			<td>\r\n			<h2>CURREN</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Display:</td>\r\n			<td>Analogue</td>\r\n			<td>Movement:</td>\r\n			<td>Quartz : Battery</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Features:</td>\r\n			<td>Easy To Read, Date, Waterproof</td>\r\n			<td>Model:</td>\r\n			<td>\r\n			<h2>Quartz</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Style:</td>\r\n			<td>Sport</td>\r\n			<td>Power Source:</td>\r\n			<td>Battery</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Year of Manufacture:</td>\r\n			<td>2010-Now</td>\r\n			<td>Casing Material:</td>\r\n			<td>Stainless Steel</td>\r\n		</tr>\r\n	</tbody>\r\n</table>','2015-10-04 00:00:00',0.00,1,650,5,10,1,1),(180,'Men\'s Fashion Black Stainless Steel Luxury Sport Analog Quartz Wrist Watch GIFT','<p>watch</p>','2015-10-04 00:00:00',0.00,1,651,5,1,1,1),(181,'Men\'s Fashion Black Stainless Steel Luxury Sport Analog Quartz Wrist Watch GIFT','<p>Watch e</p>','2015-10-04 00:00:00',0.00,1,652,5,1,1,1),(182,'Men\'s Fashion Black Stainless Steel Luxury Sport Analog Quartz Wrist Watch GIFT','<p>Watch sd</p>','2015-10-04 00:00:00',0.00,1,653,5,1,1,1),(183,'Men\'s Fashion Black Stainless Steel Luxury Sport Analog Quartz Wrist Watch GIFT','<p>asd</p>','2015-10-07 00:00:00',0.00,5,NULL,1,1,1,1),(184,'Men\'s Fashion Black Stainless Steel Luxury Sport Analog Quartz Wrist Watch GIFT','<p>sdsd</p>','2015-10-07 00:00:00',0.00,5,NULL,1,1,1,1);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_has_color`
--

DROP TABLE IF EXISTS `item_has_color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_has_color` (
  `item_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`,`color_id`),
  KEY `fk_item_has_color_color_idx` (`color_id`),
  CONSTRAINT `fk_item_has_color_color` FOREIGN KEY (`color_id`) REFERENCES `color` (`color_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_has_color_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_has_color`
--

LOCK TABLES `item_has_color` WRITE;
/*!40000 ALTER TABLE `item_has_color` DISABLE KEYS */;
INSERT INTO `item_has_color` VALUES (1,1),(1,2),(2,2),(1,3),(2,3);
/*!40000 ALTER TABLE `item_has_color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_has_supplier`
--

DROP TABLE IF EXISTS `item_has_supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_has_supplier` (
  `item_id` int(11) NOT NULL,
  `supplier_id` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_has_supplier`
--

LOCK TABLES `item_has_supplier` WRITE;
/*!40000 ALTER TABLE `item_has_supplier` DISABLE KEYS */;
INSERT INTO `item_has_supplier` VALUES (150,'2'),(150,'4'),(151,'1'),(151,'1'),(42,'1'),(42,'1'),(42,'3'),(171,'1'),(168,'1'),(3,'1'),(175,'1'),(174,'3'),(165,'1'),(40,'1'),(163,'1'),(40,'2'),(175,'2');
/*!40000 ALTER TABLE `item_has_supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keyword`
--

DROP TABLE IF EXISTS `keyword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keyword` (
  `keyword` varchar(45) NOT NULL,
  `frequency` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`keyword`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keyword`
--

LOCK TABLES `keyword` WRITE;
/*!40000 ALTER TABLE `keyword` DISABLE KEYS */;
INSERT INTO `keyword` VALUES ('iphone',67),('iphone 6',18),('iphone 4',20),('HTML',2),('ip',10),('i',7),('Gopro',74),('Camera',43),('iplkdfd',3),('apple',4),('drone',10),('jew',0),('watch',34),('wat',0),('Dress',0),('camera tripod',0),('camera cover',0),('camera battery',0),('car cover',0),('card reader',1),('ipad',1),('ipod',0),('phone',1),('saree',1),('go',2),('red',0),('Mesns shoes',5),('new go pro',0),(' gopro',0),('sds',0),('lip gloss',2);
/*!40000 ALTER TABLE `keyword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) DEFAULT NULL,
  `receiver` int(11) DEFAULT NULL,
  `about_item` int(11) DEFAULT NULL,
  `content` varchar(2000) DEFAULT NULL,
  `sent_time` datetime DEFAULT NULL,
  `read` int(1) DEFAULT '0',
  `reply_thread` int(11) DEFAULT NULL,
  PRIMARY KEY (`message_id`),
  KEY `fk_message_sent_by_user_idx` (`sender`),
  KEY `fk_message_received_by_idx` (`receiver`),
  KEY `fk_message_about_item_idx` (`about_item`),
  CONSTRAINT `fk_message_about_item` FOREIGN KEY (`about_item`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_received_by` FOREIGN KEY (`receiver`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_sent_by_user` FOREIGN KEY (`sender`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,3,1,1,'I\'m interested in buying does it come with a warranty?',NULL,1,2),(6,1,3,42,'Hello','2015-05-10 12:02:54',1,3),(12,1,3,151,'Any other colors available?','2015-05-10 12:08:54',1,1),(14,1,3,1,'Yes, comes with  2 year warranty.','2015-05-10 13:17:47',1,2),(15,3,1,1,'Ok, that\'s great, Can I have it with leather straps?','2015-05-10 13:23:49',1,2),(16,1,3,1,'Sorry, No, Ony rubber straps available.','2015-05-10 13:30:49',1,2),(17,3,1,4,'Is there any discounts available?','2015-05-10 13:31:41',0,4),(19,3,1,2,'Do you have brand new ones?','2015-05-10 13:56:11',0,6),(20,3,1,42,'Hello, How can I assist you?','2015-05-10 14:04:30',1,3),(21,3,1,1,'Any other colours?','2015-05-10 16:45:41',1,2),(22,3,1,3,'Is it waterproof?','2015-05-10 16:46:19',0,7),(23,3,1,3,'Is it waterproof?','2015-05-10 16:47:34',0,8),(24,3,1,43,'Can you give me a discount? ','2015-05-10 16:49:54',1,9),(25,3,1,151,'Yes, We have blue, currently out of stock.','2015-05-10 16:59:31',1,1),(26,3,1,1,'Please send me detail of metirals','2015-05-10 23:32:42',0,10),(27,1,3,1,'ok','2015-05-10 23:34:26',1,2),(28,3,1,1,'Hello','2015-05-10 23:34:50',1,2),(29,3,1,1,'hello,\r\n','2015-05-21 04:17:05',1,2),(30,3,1,1,'Hi ','2015-05-21 04:22:19',1,2),(31,1,3,42,'What is the maximum memory capacity?','2015-06-25 02:34:09',1,3),(32,3,1,42,'64 GB','2015-06-25 02:35:34',1,3),(33,1,3,42,'Ok that\'s good. thanks','2015-06-25 02:36:01',1,3),(34,3,1,42,'Is there anything else i can help you with?','2015-06-25 02:46:26',1,3),(35,3,1,42,'And our Price is the lowest.','2015-06-25 02:53:59',1,3),(36,3,1,42,'You will get a free memory card too.','2015-06-25 03:03:12',1,3),(37,3,1,2,'How long is the warranty?','2015-06-25 03:05:45',1,11),(38,1,3,42,'Hello','2015-06-27 12:35:22',1,3),(39,1,3,42,'Hello','2015-06-27 13:29:17',1,3),(40,1,5,4,'Hello, Any discounts? ','2015-06-27 13:30:31',1,12),(41,1,5,4,'Interested in buying!','2015-06-28 08:51:54',1,12),(42,3,1,42,'How can I help you?','2015-06-28 23:21:14',0,3),(43,1,5,2,'Hello,\r\nIs silver available?','2015-06-29 00:06:34',1,13),(44,5,1,2,'Sorry No,','2015-06-29 00:08:10',0,13),(45,1,5,4,'Hello, any colors','2015-06-29 02:05:55',1,14),(46,5,1,4,'How can i help','2015-06-29 02:07:34',1,14),(47,5,1,1,'Hi','2015-07-15 22:23:38',0,15),(48,3,1,42,'TEST','2015-10-01 02:00:20',0,3),(49,5,5,1,'','2015-10-03 04:59:03',1,15);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `noti_id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user` int(11) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `noti_time` datetime DEFAULT NULL,
  `read` int(1) DEFAULT '0',
  PRIMARY KEY (`noti_id`),
  KEY `fk_notification_user_idx` (`to_user`),
  CONSTRAINT `fk_notification_user` FOREIGN KEY (`to_user`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (1,1,'tdsstore followed you','Profile/buyer/?buyer=1','2015-08-23 15:10:34',0),(2,1,'tset1 followed you','Profile/buyer/?buyer=3','2015-08-23 15:27:34',0),(3,1,'sachDee followed you','Profile/buyer/?buyer=5','2015-08-23 21:07:20',0),(4,3,'tdsstore followed you','Profile/buyer/?buyer=1','2015-08-23 21:35:29',0),(5,5,'tdsstore followed you','Profile/buyer/?buyer=1','2015-08-23 21:35:43',0),(6,5,'tdsstore followed you','Profile/buyer/?buyer=1','2015-08-24 01:42:03',0),(7,3,'tdsstore followed you','Profile/buyer/?buyer=1','2015-08-24 01:52:11',0),(8,1,'tset1 followed you','Profile/buyer/?buyer=3','2015-08-24 02:58:21',0);
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offers` (
  `offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `offer_status` int(11) DEFAULT '0',
  PRIMARY KEY (`offer_id`),
  KEY `fk_offers_item` (`item_id`),
  KEY `fk_offers_buyer_id` (`buyer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers`
--

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
INSERT INTO `offers` VALUES (1,151,100,2,2,1),(2,151,100,1,5,2),(3,152,100,1,5,0),(4,0,1000,1,3,0),(5,0,1000,1,3,0),(6,2,1000,1,3,0),(7,2,100,1,3,0),(8,2,4444,1,3,0),(9,2,4444,4,3,0),(10,2,200,4,3,0),(11,2,100000,1,3,0),(12,2,1400,1,3,0),(13,2,100000,1,3,0),(14,2,200,1,3,0),(15,2,1000,1,3,0),(16,2,1400,1,3,0),(17,2,0,1,3,0),(18,2,15,2,3,0),(19,2,60,1,3,0);
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordered_date` datetime DEFAULT NULL,
  `sold_price` varchar(45) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `bought_by_user` int(11) DEFAULT NULL,
  `order_status` int(11) DEFAULT '1',
  `ship_to_address` varchar(100) DEFAULT NULL,
  `ordered_quantity` int(5) DEFAULT NULL,
  `sold_by_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `fk_order_item_idx` (`item`),
  KEY `fk_order_bought_by_user_idx` (`bought_by_user`),
  KEY `fk_order_order_status_idx` (`order_status`),
  KEY `fk_order_sold_by_user` (`sold_by_user`),
  CONSTRAINT `fk_order_bought_by_user` FOREIGN KEY (`bought_by_user`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_item` FOREIGN KEY (`item`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_order_status` FOREIGN KEY (`order_status`) REFERENCES `order_status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_sold_by_user` FOREIGN KEY (`sold_by_user`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=279 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,'0000-00-00 00:00:00','100',1,1,1,'malabe,colombo',2,5),(116,'2015-05-10 14:20:47','280000',2,3,3,'malabe kaduwela colombo',2,5),(117,'2015-05-10 14:21:11','280000',2,3,3,'malabe kaduwela colombo',2,5),(142,'2015-05-10 14:21:11','100',44,2,5,'Colombo',1,3),(143,'2015-05-10 14:21:11','1000',150,5,2,'Galle',2,3),(144,'2015-05-10 14:21:11','1900',151,2,4,'Kandy',2,3),(145,'2015-05-10 14:21:11','4500',152,5,1,'Colombo',5,3),(147,'2015-05-10 22:17:17','30100',1,5,3,'dilini matara kaduwela colombo',3,NULL),(148,'2015-05-10 23:54:55','20100',1,1,1,'dilini matara kaduwela colombo',2,NULL),(149,'2015-05-10 23:55:49','40100',1,1,4,'malabe kaduwela colombo',4,NULL),(150,'2015-05-18 21:44:01','670',4,1,2,'malabe kaduwela colombo',1,NULL),(151,'2015-05-18 21:44:01','30100',1,1,4,'malabe kaduwela colombo',3,NULL),(152,'2015-05-21 04:25:11','20100',1,5,3,'malabe kaduwela colombo',2,NULL),(153,'2015-05-21 04:26:18','20100',1,1,1,'dilini   ',2,NULL),(155,'2015-06-24 09:05:32','140000',2,1,1,'malabe kaduwela colombo',1,NULL),(156,'2015-06-25 22:40:55','34900',3,1,1,'malabe kaduwela colombo',1,NULL),(157,'2015-06-25 22:40:55','34900',3,3,4,'malabe kaduwela colombo',1,NULL),(158,'2015-06-27 04:52:29','140000',2,1,1,'malabe kaduwela colombo',1,NULL),(159,'2015-06-27 04:56:53','140000',2,1,1,'malabe kaduwela colombo',1,NULL),(160,'2015-06-27 10:06:58','800',152,1,1,'   ',1,NULL),(161,'2015-06-27 10:09:33','280000',2,1,1,'   ',2,NULL),(162,'2015-06-28 02:53:11','34900',3,1,1,'   ',1,NULL),(163,'2015-06-28 08:21:52','670',4,1,1,'malabe kaduwela colombo',1,NULL),(164,'2015-06-28 08:40:45','800',152,1,1,'malabe kaduwela colombo',1,NULL),(165,'2015-06-28 08:40:45','9000',44,1,2,'malabe kaduwela colombo',1,NULL),(166,'2015-06-28 10:11:39','670',4,1,1,'aaaaaaa aaaaaaaaaaaaa  aaaaaaaaaaaaa',1,NULL),(167,'2015-06-28 10:11:39','10100',1,1,1,'aaaaaaa aaaaaaaaaaaaa  aaaaaaaaaaaaa',1,NULL),(168,'2015-06-28 10:13:20','670',4,1,1,'malabe kaduwela colombo',1,NULL),(169,'2015-06-28 10:13:34','670',4,1,1,'dilini kalutara  panadura colombo',1,NULL),(170,'2015-06-28 10:20:31','140000',2,1,1,'shashi matara kalutara colombo',1,NULL),(171,'2015-06-29 00:03:20','9000',44,1,1,'malabe kaduwela colombo',1,NULL),(172,'2015-06-29 00:04:18','140000',2,1,1,'Thilina Solomons 315,sedawatta,pamunugama  Ja-Ela',1,NULL),(173,'2015-06-29 00:04:18','670',4,1,1,'Thilina Solomons 315,sedawatta,pamunugama  Ja-Ela',1,NULL),(174,'2015-06-29 02:04:36','140000',2,1,1,'Thilina Solomons 315,sedawatta,pamunugama  Ja-Ela',1,NULL),(175,'2015-06-29 02:09:15','670',4,1,1,'malabe kaduwela colombo',1,NULL),(176,'2015-06-29 02:09:15','72000',42,1,1,'malabe kaduwela colombo',2,NULL),(177,'2015-07-12 19:58:18','6025',169,1,1,'malabe kaduwela colombo',2,NULL),(178,'2015-07-12 22:19:04','670',4,1,1,'malabe kaduwela colombo',1,NULL),(179,'2015-07-13 00:17:58','1970',4,1,1,'malabe kaduwela colombo',3,NULL),(180,'2015-07-13 00:59:44','1320',4,1,1,'malabe kaduwela colombo',2,NULL),(181,'2015-07-13 06:43:28','1320',4,1,1,'malabe kaduwela colombo',2,NULL),(182,'2015-07-13 06:43:28','10100',1,1,1,'malabe kaduwela colombo',1,NULL),(183,'2015-07-15 22:26:06','10100',1,1,1,'malabe kaduwela colombo',1,NULL),(184,'2015-07-15 22:26:06','34900',3,1,1,'malabe kaduwela colombo',1,NULL),(185,'2015-08-23 02:41:32','5220',4,1,1,'malabe kaduwela colombo',8,NULL),(186,'2015-08-23 14:21:22','10100',1,1,1,'malabe kaduwela colombo',1,NULL),(187,'2015-08-23 14:21:22','20100',1,1,1,'malabe kaduwela colombo',2,NULL),(188,'2015-08-23 14:21:22','20100',1,1,1,'malabe kaduwela colombo',2,NULL),(189,'2015-08-23 14:21:22','20100',1,1,1,'malabe kaduwela colombo',2,NULL),(190,'2015-08-23 14:26:59','280000',2,1,1,'malabe kaduwela colombo',2,NULL),(191,'2015-08-23 14:28:08','1260000',2,1,1,'malabe kaduwela colombo',9,NULL),(192,'2015-08-23 14:29:19','1260000',2,1,1,'malabe kaduwela colombo',9,NULL),(193,'2015-08-23 14:31:32','50100',1,1,1,'malabe kaduwela colombo',5,NULL),(194,'2015-08-23 14:33:31','20100',1,1,1,'malabe kaduwela colombo',2,NULL),(195,'2015-08-23 14:34:48','20100',1,1,1,'malabe kaduwela colombo',2,NULL),(196,'2015-08-23 14:37:14','30100',1,1,1,'malabe kaduwela colombo',3,NULL),(197,'2015-08-23 14:38:22','30100',1,1,1,'malabe kaduwela colombo',3,NULL),(198,'2015-08-23 14:38:57','30100',1,1,1,'malabe kaduwela colombo',3,NULL),(199,'2015-08-23 14:39:02','30100',1,1,1,'malabe kaduwela colombo',3,NULL),(200,'2015-08-23 14:39:39','30100',1,1,1,'malabe kaduwela colombo',3,NULL),(201,'2015-08-23 14:40:29','30100',1,1,1,'malabe kaduwela colombo',3,NULL),(202,'2015-08-23 14:40:53','30100',1,1,1,'malabe kaduwela colombo',3,NULL),(203,'2015-08-23 14:40:57','30100',1,1,1,'malabe kaduwela colombo',3,NULL),(204,'2015-08-23 14:41:02','30100',1,1,1,'malabe kaduwela colombo',3,NULL),(205,'2015-08-23 14:42:11','30100',1,1,1,'malabe kaduwela colombo',3,NULL),(206,'2015-08-23 14:45:05','30100',1,1,1,'malabe kaduwela colombo',3,NULL),(207,'2015-08-23 20:06:38','140000',2,1,1,'malabe kaduwela colombo',1,NULL),(208,'2015-08-23 20:07:47','140000',2,1,1,'dilini galle kalutara colomob',1,NULL),(209,'2015-08-23 20:31:40','40100',1,1,1,'malabe kaduwela colombo',4,NULL),(210,'2015-08-23 20:57:09','20100',1,1,1,'malabe kaduwela colombo',2,NULL),(211,'2015-08-23 21:04:42','20100',1,1,1,'malabe kaduwela colombo',2,NULL),(212,'2015-08-23 22:27:54','1320',4,1,1,'malabe kaduwela colombo',2,NULL),(213,'2015-08-23 22:33:37','1320',4,1,1,'malabe kaduwela colombo',2,NULL),(214,'2015-08-23 22:33:43','1320',4,1,1,'malabe kaduwela colombo',2,NULL),(215,'2015-08-23 22:34:30','11070',4,1,1,'malabe kaduwela colombo',17,NULL),(216,'2015-08-23 22:34:52','11070',4,1,1,'malabe kaduwela colombo',17,NULL),(217,'2015-08-23 22:36:42','11070',4,1,1,'malabe kaduwela colombo',17,NULL),(218,'2015-08-23 22:46:23','11070',4,1,1,'malabe kaduwela colombo',17,NULL),(219,'2015-08-23 22:46:24','11070',4,1,1,'malabe kaduwela colombo',17,NULL),(220,'2015-08-23 22:48:08','8040',43,1,1,'malabe kaduwela colombo',1,NULL),(221,'2015-08-23 23:50:02','20100',1,1,1,'malabe kaduwela colombo',2,NULL),(222,'2015-08-23 23:51:17','20100',1,1,1,'malabe kaduwela colombo',2,NULL),(223,'2015-08-23 23:52:34','20100',1,1,1,'malabe kaduwela colombo',2,NULL),(224,'2015-08-24 00:01:35','20100',1,1,1,'malabe kaduwela colombo',2,NULL),(225,'2015-08-24 00:05:22','10100',1,1,1,'malabe kaduwela colombo',1,NULL),(226,'2015-08-24 00:10:09','20100',1,1,1,'malabe kaduwela colombo',2,NULL),(227,'2015-08-24 00:11:25','20100',1,1,1,'malabe kaduwela colombo',2,NULL),(228,'2015-08-24 00:14:32','10100',1,1,1,'malabe kaduwela colombo',1,NULL),(229,'2015-08-24 00:17:02','10100',1,1,1,'malabe kaduwela colombo',1,NULL),(230,'2015-08-24 00:20:54','10100',1,1,1,'malabe kaduwela colombo',1,NULL),(231,'2015-08-24 00:25:07','10100',1,1,1,'malabe kaduwela colombo',1,NULL),(232,'2015-08-24 00:27:58','10100',1,1,1,'malabe kaduwela colombo',1,NULL),(233,'2015-08-24 00:29:24','40100',1,1,1,'malabe kaduwela colombo',4,NULL),(234,'2015-08-24 00:34:39','60100',1,1,1,'malabe kaduwela colombo',6,NULL),(235,'2015-08-24 00:36:50','60100',1,1,1,'malabe kaduwela colombo',6,NULL),(236,'2015-08-24 00:37:42','60100',1,1,1,'malabe kaduwela colombo',6,NULL),(237,'2015-08-24 00:37:47','40100',1,1,1,'malabe kaduwela colombo',4,NULL),(238,'2015-08-24 00:51:03','140000',2,1,1,'malabe kaduwela colombo',1,NULL),(239,'2015-08-24 00:55:37','34900',3,1,1,'malabe kaduwela colombo',1,NULL),(240,'2015-08-24 01:02:45','670',4,1,1,'malabe kaduwela colombo',1,NULL),(241,'2015-08-24 01:03:38','34900',3,1,1,'malabe kaduwela colombo',1,NULL),(242,'2015-08-24 01:04:50','1320',4,1,1,'malabe kaduwela colombo',2,NULL),(243,'2015-08-24 01:06:38','1320',4,1,1,'malabe kaduwela colombo',2,NULL),(244,'2015-08-24 01:07:54','34900',3,1,1,'malabe kaduwela colombo',1,NULL),(245,'2015-09-28 19:29:37','37000',42,1,1,'malabe kaduwela colombo',1,NULL),(246,'2015-09-28 19:29:37','18000',44,1,3,'malabe kaduwela colombo',2,NULL),(247,'2015-09-28 19:29:37','800',152,1,1,'malabe kaduwela colombo',1,NULL),(248,'2015-10-02 01:10:16','10100',1,1,1,'malabe kaduwela colombo',1,NULL),(249,'2015-10-02 23:34:24','670',4,1,1,'malabe kaduwela colombo',1,NULL),(250,'2015-10-02 23:34:24','140000',2,1,1,'malabe kaduwela colombo',1,NULL),(251,'2015-10-02 23:34:25','3920',4,1,1,'malabe kaduwela colombo',6,NULL),(252,'2015-10-02 23:38:07','670',4,1,1,'malabe kaduwela colombo',1,NULL),(253,'2015-10-03 13:43:42','280000',2,1,1,'malabe kaduwela colombo',2,NULL),(254,'2015-10-04 00:34:44','3025',169,1,1,'malabe kaduwela colombo',1,NULL),(255,'2015-10-04 00:44:05','1970',4,1,1,'malabe kaduwela colombo',3,NULL),(256,'2015-10-04 00:46:53','3270',4,1,1,'malabe kaduwela colombo',5,NULL),(257,'2015-10-04 00:46:54','1320',4,1,1,'malabe kaduwela colombo',2,NULL),(258,'2015-10-04 02:00:20','670',4,1,1,'malabe kaduwela colombo',1,NULL),(259,'2015-10-04 02:05:34','12025',169,1,1,'malabe kaduwela colombo',4,NULL),(260,'2015-10-04 02:07:00','12025',169,1,1,'malabe kaduwela colombo',4,NULL),(261,'2015-10-04 06:15:22','670',4,1,1,'malabe kaduwela colombo',1,NULL),(262,'2015-10-04 06:15:22','5220',4,1,1,'malabe kaduwela colombo',8,NULL),(263,'2015-10-04 21:22:44','140000',2,1,1,'malabe kaduwela colombo',1,NULL),(264,'2015-10-04 21:25:52','140000',2,1,1,'malabe kaduwela colombo',1,NULL),(265,'2015-10-04 21:25:52','3025',169,1,1,'malabe kaduwela colombo',1,NULL),(266,'2015-10-04 21:34:07','140000',2,1,1,'malabe kaduwela colombo',1,NULL),(267,'2015-10-04 21:34:48','140000',2,1,1,'malabe kaduwela colombo',1,NULL),(268,'2015-10-04 21:36:27','140000',2,1,1,'malabe kaduwela colombo',1,NULL),(269,'2015-10-05 00:11:28','1600',176,1,1,'malabe kaduwela colombo',2,NULL),(270,'2015-10-05 00:14:40','1600',176,1,1,'malabe kaduwela colombo',2,NULL),(271,'2015-10-05 00:20:31','800',176,1,1,'malabe kaduwela colombo',1,NULL),(272,'2015-10-05 00:33:15','3025',169,NULL,1,'malabe kaduwela colombo',1,NULL),(273,'2015-10-05 00:37:40','3025',169,5,1,'malabe kaduwela colombo',1,NULL),(274,'2015-10-05 17:07:31','3025',169,3,1,'Dilini wicky 7b gonagalapura bentota',1,NULL),(275,'2015-10-28 23:41:13','34900',3,NULL,1,'malabe kaduwela colombo',1,NULL),(276,'2015-10-28 23:43:09','8040',43,3,1,'malabe kaduwela colombo',1,NULL),(277,'2015-10-29 09:27:24','10100',1,NULL,1,'malabe kaduwela colombo',1,NULL),(278,'2015-10-29 10:00:09','10100',1,NULL,1,'Dilini wicky 7b gonagalapura bentota',1,NULL);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_status` (
  `status_id` int(1) NOT NULL AUTO_INCREMENT,
  `status_title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_status`
--

LOCK TABLES `order_status` WRITE;
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
INSERT INTO `order_status` VALUES (1,'Yet to Ship'),(2,'Shipped'),(3,'Delivered'),(4,'Received'),(5,'Returned');
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parent_category`
--

DROP TABLE IF EXISTS `parent_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parent_category` (
  `parent_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`parent_category_id`),
  UNIQUE KEY `parent_category_UNIQUE` (`parent_category`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parent_category`
--

LOCK TABLES `parent_category` WRITE;
/*!40000 ALTER TABLE `parent_category` DISABLE KEYS */;
INSERT INTO `parent_category` VALUES (1,'Electronic'),(2,'Automobile'),(3,'Fashion'),(4,'Household'),(5,'Leisure'),(6,'Other'),(10,'Family');
/*!40000 ALTER TABLE `parent_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refund_message`
--

DROP TABLE IF EXISTS `refund_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refund_message` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `req_id` int(11) DEFAULT NULL,
  `sent_time` datetime DEFAULT NULL,
  `read_status` int(11) DEFAULT '0',
  `content` varchar(800) DEFAULT NULL,
  PRIMARY KEY (`msg_id`),
  KEY `fk_msg_refund_request` (`req_id`),
  KEY `fk_msg_user_sender` (`sender_id`),
  KEY `fk_msg_user_receiver` (`receiver_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refund_message`
--

LOCK TABLES `refund_message` WRITE;
/*!40000 ALTER TABLE `refund_message` DISABLE KEYS */;
INSERT INTO `refund_message` VALUES (15,3,5,1,'2015-10-04 23:38:43',0,'test\r\n'),(14,3,5,1,'2015-10-04 23:32:39',0,'test\r\n'),(3,3,5,1,'2015-10-01 22:26:16',0,'test'),(4,3,5,1,'2015-10-01 22:26:41',0,'ettey\r\n'),(5,3,5,2,'2015-10-01 22:29:31',0,'I need a refund\r\n'),(6,5,5,1,'2015-10-02 21:36:54',0,'refund will be done soon'),(7,5,5,1,'2015-10-03 03:06:16',0,''),(8,5,3,1,'2015-10-03 04:57:44',0,'eee'),(9,5,3,1,'2015-10-03 04:57:59',0,'eeee'),(10,5,5,143,'2015-10-03 05:14:53',0,'need a refund'),(13,5,3,1,'2015-10-03 05:32:47',0,'t'),(16,3,1,4,'2015-10-05 01:08:51',0,'test'),(17,1,3,4,'2015-10-05 01:13:15',0,'ok');
/*!40000 ALTER TABLE `refund_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refund_request`
--

DROP TABLE IF EXISTS `refund_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refund_request` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `case_status` int(11) DEFAULT '1',
  `admin_status` int(11) DEFAULT '0',
  PRIMARY KEY (`req_id`),
  KEY `fk_refund_request_order` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refund_request`
--

LOCK TABLES `refund_request` WRITE;
/*!40000 ALTER TABLE `refund_request` DISABLE KEYS */;
INSERT INTO `refund_request` VALUES (1,116,1,1),(2,117,1,0),(3,143,0,1),(4,157,0,1);
/*!40000 ALTER TABLE `refund_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_details`
--

DROP TABLE IF EXISTS `supplier_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_details` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(45) NOT NULL,
  `supplier_email` varchar(45) NOT NULL,
  `supplier_contact_no` varchar(45) NOT NULL,
  `supplier_address` varchar(45) NOT NULL,
  PRIMARY KEY (`supplier_id`),
  UNIQUE KEY `supplier_id_UNIQUE` (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_details`
--

LOCK TABLES `supplier_details` WRITE;
/*!40000 ALTER TABLE `supplier_details` DISABLE KEYS */;
INSERT INTO `supplier_details` VALUES (1,'Kamal Senarathne','sachdeemansa@gmail.com','0112858636','Main Street, Malabe'),(2,'Sahan Samarawickrama','sahans@gmail.com','0112999777','Saman mawatha, Battaramulla'),(3,'Imashi Suppliers','imashisuppliers@yahoo.com','0112777555','Main Street, Aturugiriya'),(4,'James Patterson','james.p@live.com','0112444555','Hortan Place, Kollupitiya');
/*!40000 ALTER TABLE `supplier_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `user_status` int(1) DEFAULT '1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Thilina','Solomons','tdsolomons@gmail.com','12345','tdsstore','malabe','kaduwela','colombo',1),(2,'Hasantha','Premarathne','saman.weerasinghe.pdm@gmail.com','12345','iahsp','colombo','gampaha','colombo',1),(3,'saman','sampath','sales@instalikebooster.com','tset1','tset1','no:11','street1','colombo',1),(4,'aloka','weerasekara','aloka.weerasekara.pdm@gmail.com','12345','aloka','no:10','Malabe','Colombo',1),(5,'Deemansa','Karunasiri','sachdeemansa@gmail.com','sachdee','sachDee','117A','Thalangama North','Battaramulla',1),(6,'Dulanji','Pabasara','sachdeemansa53@gmail.com','pabad','pabaD','701C,','Thalangama North','Battharamulla',1),(9,'Randika','Fernando','randipro@gmail.com','12345','randika','Sliit','Kandy Rd','Malabe',1),(10,'Ruvini','Ramawickrama','rama@gmail.com','12345','ruvini','Sliit','Kandy Rd','Malabe',1),(11,'Dilini','Udeshika','usedhikadilini@gmail.com','dilini','diliniU','1263B','New Kandy Road','Malabe',1),(12,'sachink','dee','sachdee.dee@gmail.com','sachdeemansa','sachdeemansa','421/c parakumba place, athurugiriya road','421/c parakumba place, athurugiriya road','Malabe',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_phone`
--

DROP TABLE IF EXISTS `user_phone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_phone` (
  `user_id` int(11) NOT NULL,
  `phone` int(12) NOT NULL,
  PRIMARY KEY (`user_id`,`phone`),
  CONSTRAINT `fk_user_phone` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_phone`
--

LOCK TABLES `user_phone` WRITE;
/*!40000 ALTER TABLE `user_phone` DISABLE KEYS */;
INSERT INTO `user_phone` VALUES (1,777333555),(2,777555666),(3,777777888),(4,774550002),(5,774550002),(6,774550002),(9,719219592),(10,714567893),(11,777555666),(12,777555444);
/*!40000 ALTER TABLE `user_phone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_view_item`
--

DROP TABLE IF EXISTS `user_view_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_view_item` (
  `user` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `viewed_time` datetime DEFAULT NULL,
  PRIMARY KEY (`user`,`item`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_view_item`
--

LOCK TABLES `user_view_item` WRITE;
/*!40000 ALTER TABLE `user_view_item` DISABLE KEYS */;
INSERT INTO `user_view_item` VALUES (5,167,'2015-09-01 01:53:42'),(5,42,'2015-07-20 12:21:18'),(5,151,'2015-07-20 12:21:22'),(5,44,'2015-07-20 12:42:38'),(5,1,'2015-10-05 00:37:14'),(5,168,'2015-07-20 13:50:10'),(5,4,'2015-10-05 00:07:08'),(5,43,'2015-10-01 22:10:03'),(3,152,'2015-10-04 21:41:20'),(5,176,'2015-10-04 21:17:58'),(3,162,'2015-10-04 21:06:39'),(1,165,'2015-10-04 18:13:13'),(5,174,'2015-10-01 22:17:47'),(3,166,'2015-10-03 01:42:05'),(3,174,'2015-09-25 19:38:27'),(3,175,'2015-10-02 08:52:16'),(1,175,'2015-10-04 16:55:20'),(1,42,'2015-10-04 16:54:08'),(1,44,'2015-10-04 02:09:05'),(1,43,'2015-10-04 02:08:32'),(1,1,'2015-10-04 02:03:18'),(1,2,'2015-10-04 06:16:26'),(1,169,'2015-10-05 01:14:44'),(1,151,'2015-10-03 17:07:59'),(2,4,'2015-08-22 21:21:17'),(1,3,'2015-10-04 02:03:08'),(3,167,'2015-10-29 08:57:06'),(3,2,'2015-10-29 10:32:41'),(3,1,'2015-10-29 09:39:15'),(3,4,'2015-10-03 01:51:44'),(1,4,'2015-10-04 06:18:13'),(3,43,'2015-10-28 23:42:11'),(3,3,'2015-10-28 19:32:26'),(3,42,'2015-10-28 23:41:59'),(3,169,'2015-10-05 19:11:20'),(3,176,'2015-10-05 00:20:02'),(3,150,'2015-10-04 21:37:57'),(3,151,'2015-10-04 21:38:10'),(3,163,'2015-10-04 21:41:30'),(3,173,'2015-10-04 21:41:55'),(3,180,'2015-10-05 00:04:57'),(5,169,'2015-10-05 00:37:27'),(1,177,'2015-10-05 00:59:22'),(1,167,'2015-10-05 11:18:53'),(3,177,'2015-10-05 19:12:04'),(3,168,'2015-10-29 08:56:41');
/*!40000 ALTER TABLE `user_view_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wish_list`
--

DROP TABLE IF EXISTS `wish_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wish_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` varchar(45) NOT NULL,
  `userid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`itemid`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wish_list`
--

LOCK TABLES `wish_list` WRITE;
/*!40000 ALTER TABLE `wish_list` DISABLE KEYS */;
INSERT INTO `wish_list` VALUES (16,'4','1'),(13,'2','1'),(22,'3','3'),(15,'44','1'),(19,'3','3'),(20,'180','3'),(21,'2','3');
/*!40000 ALTER TABLE `wish_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'EMarketingPortal'
--
/*!50003 DROP PROCEDURE IF EXISTS `add_item_to_viewed_history` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`EMarketingPortal`@`%` PROCEDURE `add_item_to_viewed_history`(IN userId INT(11), IN itemId INT(11))
BEGIN

	DELETE FROM user_view_item WHERE user = userId AND item = itemId;
    INSERT INTO user_view_item (user, item, viewed_time) VALUES(userId, itemId, NOW());

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `add_or_update_keyword` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`EMarketingPortal`@`%` PROCEDURE `add_or_update_keyword`(IN inputKeyword VARCHAR(45))
BEGIN
	UPDATE keyword SET frequency = frequency + 1 WHERE keyword = inputKeyword;
    INSERT IGNORE INTO keyword (keyword) VALUES (inputKeyword);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `create_deal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`EMarketingPortal`@`%` PROCEDURE `create_deal`(IN item_id INT(11), 
								IN end_date DATETIME, 
                                IN off_perc INT(2), 
                                IN logged_user INT(11))
BEGIN
	DECLARE seller_id INT(11);
    
    SELECT i.seller INTO seller_id
    FROM fixed_price_item fpi, item i
    WHERE fpi.item_id = i.item_id AND fpi.item_id = item_id;
    
    IF(seller_id = logged_user) THEN
     INSERT INTO deal (fixed_price_item, off_percentage, end_time)
     VALUE (item_id, off_perc, end_date);
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `follow_seller` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`EMarketingPortal`@`%` PROCEDURE `follow_seller`(IN buyerId INT(11), IN sellerId INT(11))
BEGIN
	DECLARE buyerUserName VARCHAR(20);
    
    SELECT username INTO buyerUserName
    FROM user
    WHERE user_id = buyerId;
    
	INSERT INTO follow (buyer, seller) VALUES(buyerId, sellerId);
    INSERT INTO notification(to_user, message, link, noti_time) 
	VALUES (sellerId, CONCAT(buyerUserName, ' followed you'), CONCAT('Profile/buyer/?buyer=', buyerId), NOW());
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `set_reply_thread_for_new_msg` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`EMarketingPortal`@`%` PROCEDURE `set_reply_thread_for_new_msg`(IN msgId INT(11))
BEGIN
	DECLARE maxRT INT(11);
	SELECT COALESCE(MAX(reply_thread),0) INTO maxRT
    FROM message;
    
    UPDATE message 
	SET reply_thread = maxRT +1 
	WHERE message_id= msgId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-30  3:34:50
