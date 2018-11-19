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
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `amazon_id` varchar(50) DEFAULT NULL,
  `buyer_address_id` int(11) DEFAULT NULL,
  `receiver_address_id` int(11) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `payment_type_detail` int(11) DEFAULT NULL,
  `promotion` int(11) DEFAULT NULL,
  `happy_code` int(11) DEFAULT NULL,
  `exchange_rate` float DEFAULT NULL,
  `price_list_id` int(11) DEFAULT NULL,
  `price_list_promotion_code` float DEFAULT NULL,
  `price_list_happy_code` float DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  `verify` tinyint(4) DEFAULT NULL COMMENT 'Kiem duyet don hang',
  `payment_status` int(11) DEFAULT NULL,
  `total_price_in_vn` float DEFAULT '0',
  `total_price_in_jp` float DEFAULT '0',
  `total_fee` float DEFAULT '0',
  `cost_incurred` float DEFAULT '0',
  `total_amount` float DEFAULT '0',
  `amount_unpaid` float DEFAULT '0',
  `amount_paid` float DEFAULT '0',
  `paid_before` float DEFAULT '0',
  `expected_day` int(11) DEFAULT NULL,
  `vnpSecureHash` varchar(200) DEFAULT NULL,
  `vnp_BankTranNo` varchar(150) DEFAULT NULL,
  `solution_payment` varchar(200) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (1,'AM-0CC8ADF4-886601',NULL,92,92,2,1,2,NULL,NULL,202.18,7,0,0,NULL,1,0,NULL,1571490,1208840,362651,0,1571490,1571490,0,1208840,NULL,NULL,NULL,NULL,NULL,1500886601,NULL,NULL);
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-25 22:38:02
