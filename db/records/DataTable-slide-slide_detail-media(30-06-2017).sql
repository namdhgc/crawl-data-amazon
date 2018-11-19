-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: crawl-data-amazon
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.22-MariaDB

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
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `patch` varchar(500) NOT NULL,
  `tmp_patch` varchar(500) NOT NULL,
  `url` varchar(500) NOT NULL,
  `tmp_url` varchar(500) NOT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `deleted_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (38,'3kfl99fhxxm1lx1ig3h','assets/uploads/tmp/3kfl99fhxxm1lx1ig3h.jpg','assets/uploads/tmp/3kfl99fhxxm1lx1ig3h.jpg','','','','','image/jpeg',0,1498815938,2,NULL,NULL,NULL,NULL),(39,'3kfl99lwnp25xzsjgp6','assets/uploads/tmp/3kfl99lwnp25xzsjgp6.jpg','assets/uploads/tmp/3kfl99lwnp25xzsjgp6.jpg','','','','','image/jpeg',0,1498815981,2,NULL,NULL,NULL,NULL),(40,'3kfl9e0jo51su3g8trtyc','assets/uploads/tmp/3kfl9e0jo51su3g8trtyc.jpg','assets/uploads/tmp/3kfl9e0jo51su3g8trtyc.jpg','','','','','image/jpeg',0,1498816090,2,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slide`
--

DROP TABLE IF EXISTS `slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `lang_code` varchar(30) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slide`
--

LOCK TABLES `slide` WRITE;
/*!40000 ALTER TABLE `slide` DISABLE KEYS */;
INSERT INTO `slide` VALUES (2,'Slide main 1','Slide main 12','vi',1,NULL,1498814029,NULL),(3,'Slide main 2','Slide main 22','ja',0,1498442954,1498726392,NULL);
/*!40000 ALTER TABLE `slide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slide_detail`
--

DROP TABLE IF EXISTS `slide_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slide_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `link` varchar(500) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slide_detail`
--

LOCK TABLES `slide_detail` WRITE;
/*!40000 ALTER TABLE `slide_detail` DISABLE KEYS */;
INSERT INTO `slide_detail` VALUES (9,2,38,'title 1','https://www.amazon.co.jp/Amazon-Video/b/ref=nav__aiv_vid?ie=UTF8&node=2351649051',1498815938,NULL,NULL),(10,2,39,'title 2','https://www.amazon.co.jp/Amazon-Video/b/ref=nav__aiv_vid?ie=UTF8&node=2351649051',1498815981,NULL,NULL),(11,2,40,'title 3','https://www.amazon.co.jp/Amazon-Video/b/ref=nav__aiv_vid?ie=UTF8&node=2351649051',1498816090,NULL,NULL);
/*!40000 ALTER TABLE `slide_detail` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-30 17:00:50
