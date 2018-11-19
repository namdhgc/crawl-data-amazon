-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: crawl-data-amazon
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.19-MariaDB

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(75) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `facebook_id` varchar(150) DEFAULT NULL,
  `google_id` varchar(150) DEFAULT NULL,
  `roles` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `token_reset_password` varchar(100) DEFAULT NULL,
  `reset_password_at` int(11) DEFAULT NULL,
  `end_time_confirm` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `group_customer` int(11) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `ward_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT '1' COMMENT 'type of user. 0 is Admin, 1 is User.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'owner','$2y$10$KBRqq.oWW5LVEHvvF1Y0bubBYvluOkOupmhnuCtiuK2AVBR3pW.cm',NULL,'Đinh','Hoài Nam',NULL,NULL,1,'iJ7L5F4Dhr8VT6K0omwHhWXA4wwPDcJm7PiLvPeNPjL4K1s7TssvML6b8MC7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(9,'namdhinsight@gmail.com',NULL,'namdhinsight@gmail.com','Đinh','Hoài nam',NULL,'114890277420539346554',4,'Za9JXpcESu0i6L3OcqO04amVP8aQKwHOO3tijVkNY75CwIyifRvROaiTHqiR',NULL,NULL,NULL,1499054816,1500880547,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(10,'Đinh Nam Hoài',NULL,NULL,NULL,NULL,'1827053080644607',NULL,2,'D1QPuhC4axInOlnkRo8cmjmacrnjz05T6pmP28lEhjItL746u6u786Yj31db',NULL,NULL,NULL,1499663781,1500880389,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(22,'tendangnhap','$2y$10$F7FLhWmJXCmPiLWevuSoGecLYephv8.FavL345d4rK8ztTKYavSMC','abc@info.123','Ten','Hoo',NULL,NULL,2,NULL,NULL,NULL,NULL,1500880681,NULL,NULL,NULL,'0438734567','ng Quoc Viet',NULL,NULL,NULL,NULL,0);
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

-- Dump completed on 2017-07-25 22:38:01
