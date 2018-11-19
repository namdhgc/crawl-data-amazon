use `crawl-data-amazon`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
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
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(5) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `home_payment` int(1) DEFAULT '0',
  `free_shipping` int(1) DEFAULT '0',
  `focus` int(1) DEFAULT '0',
  `rural` int(1) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,29,'Hồ Chí Minh',0,0,0,0,1499924405,NULL,NULL),(2,22,'Hà Nội',0,0,0,0,1499924407,NULL,NULL),(3,15,'Đà Nẵng',0,0,0,0,1499924409,NULL,NULL),(4,56,'Huế',0,0,0,0,1499924411,NULL,NULL),(5,27,'Hải Phòng',0,0,0,0,1499924413,NULL,NULL),(6,14,'Cần Thơ',0,0,0,0,1499924415,NULL,NULL),(7,12,'Cà Mau',0,0,0,0,1499924417,NULL,NULL),(8,3,'Vũng Tàu',0,0,0,0,1499924419,NULL,NULL),(9,8,'Bình Dương',0,0,0,0,1499924421,NULL,NULL),(10,44,'Phú Yên',0,0,0,0,1499924423,NULL,NULL),(11,49,'Quảng Trị',0,0,0,0,1499924425,NULL,NULL),(12,48,'Quảng Ninh',0,0,0,0,1499924427,NULL,NULL),(13,47,'Quảng Ngãi',0,0,0,0,1499924429,NULL,NULL),(14,40,'Nghệ An',0,0,0,0,1499924431,NULL,NULL),(15,46,'Quảng Nam',0,0,0,0,1499924433,NULL,NULL),(16,41,'Ninh Bình',0,0,0,0,1499924435,NULL,NULL),(17,42,'Ninh Thuận',0,0,0,0,1499924437,NULL,NULL),(18,43,'Phú Thọ',0,0,0,0,1499924439,NULL,NULL),(19,39,'Nam Định',0,0,0,0,1499924441,NULL,NULL),(20,45,'Quảng Bình',0,0,0,0,1499924443,NULL,NULL),(21,65,'Hậu Giang',0,0,0,0,1499924445,NULL,NULL),(22,50,'Sơn La',0,0,0,0,1499924447,NULL,NULL),(23,51,'Sóc Trăng',0,0,0,0,1499924449,NULL,NULL),(24,64,'Điện Biên',0,0,0,0,1499924451,NULL,NULL),(25,63,'Đắc Nông',0,0,0,0,1499924453,NULL,NULL),(26,62,'Yên Bái',0,0,0,0,1499924455,NULL,NULL),(27,61,'Vĩnh Phúc',0,0,0,0,1499924457,NULL,NULL),(28,60,'Vĩnh Long',0,0,0,0,1499924459,NULL,NULL),(29,59,'Tuyên Quang',0,0,0,0,1499924461,NULL,NULL),(30,58,'Trà Vinh',0,0,0,0,1499924463,NULL,NULL),(31,57,'Tiền Giang',0,0,0,0,1499924465,NULL,NULL),(32,55,'Thanh Hóa',0,0,0,0,1499924467,NULL,NULL),(33,54,'Thái Nguyên',0,0,0,0,1499924469,NULL,NULL),(34,53,'Thái Bình',0,0,0,0,1499924471,NULL,NULL),(35,52,'Tây Ninh',0,0,0,0,1499924474,NULL,NULL),(36,38,'Long An',0,0,0,0,1499924476,NULL,NULL),(37,37,'Lâm Đồng',0,0,0,0,1499924478,NULL,NULL),(38,17,'Đồng Nai',0,0,0,0,1499924480,NULL,NULL),(39,16,'Đắc Lắc',0,0,0,0,1499924482,NULL,NULL),(40,13,'Cao Bằng',0,0,0,0,1499924484,NULL,NULL),(41,11,'Bình Thuận',0,0,0,0,1499924486,NULL,NULL),(42,10,'Bình Phước',0,0,0,0,1499924488,NULL,NULL),(43,9,'Bình Định',0,0,0,0,1499924490,NULL,NULL),(44,7,'Bến Tre',0,0,0,0,1499924492,NULL,NULL),(45,6,'Bắc Ninh',0,0,0,0,1499924494,NULL,NULL),(46,5,'Bắc Giang',0,0,0,0,1499924496,NULL,NULL),(47,4,'Bắc Kạn',0,0,0,0,1499924498,NULL,NULL),(48,2,'Bạc Liêu',0,0,0,0,1499924500,NULL,NULL),(49,1,'An Giang',0,0,0,0,1499924502,NULL,NULL),(50,19,'Đồng Tháp',0,0,0,0,1499924504,NULL,NULL),(51,20,'Gia Lai',0,0,0,0,1499924506,NULL,NULL),(52,21,'Hà Giang',0,0,0,0,1499924508,NULL,NULL),(53,36,'Lào Cai',0,0,0,0,1499924510,NULL,NULL),(54,35,'Lạng Sơn',0,0,0,0,1499924512,NULL,NULL),(55,34,'Lai Châu',0,0,0,0,1499924514,NULL,NULL),(56,33,'Kon Tum',0,0,0,0,1499924516,NULL,NULL),(57,32,'Kiên Giang',0,0,0,0,1499924518,NULL,NULL),(58,31,'Khánh Hòa',0,0,0,0,1499924520,NULL,NULL),(59,30,'Hưng Yên',0,0,0,0,1499924521,NULL,NULL),(60,28,'Hòa Bình',0,0,0,0,1499924523,NULL,NULL),(61,26,'Hải Dương',0,0,0,0,1499924525,NULL,NULL),(62,25,'Hà Tĩnh',0,0,0,0,1499924527,NULL,NULL),(63,24,'Hà Tây',0,0,0,0,1499924529,NULL,NULL),(64,23,'Hà Nam',0,0,0,0,1499924531,NULL,NULL),(65,66,'Khác',0,0,0,0,1499924533,NULL,NULL);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-13 14:12:29
