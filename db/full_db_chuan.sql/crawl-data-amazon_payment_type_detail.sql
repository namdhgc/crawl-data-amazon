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
-- Table structure for table `payment_type_detail`
--

DROP TABLE IF EXISTS `payment_type_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_type_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `payment_value` int(3) DEFAULT NULL,
  `type` int(3) DEFAULT NULL,
  `cost_incurred` int(2) DEFAULT NULL,
  `specified_value` decimal(15,0) DEFAULT NULL,
  `bonus` int(10) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `payment_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_type_detail`
--

LOCK TABLES `payment_type_detail` WRITE;
/*!40000 ALTER TABLE `payment_type_detail` DISABLE KEYS */;
INSERT INTO `payment_type_detail` VALUES (1,'Thanh toán toàn bộ chi phí đơn hàng','Quý khách được miễn phí xử lý giao dịch, phí vận chuyển trong nước, và khi đơn hàng hoàn tất quý khách sẽ được tặng một mã khuyến mãi trị giá 116,100 VNĐ cho lần mua hàng kế tiếp. (chỉ áp dụng cho đơn hàng có tổng chi phí trên 2,322,000 VNĐ)',100,0,0,2322000,50000,2147483647,NULL,NULL,1),(2,'Thanh toán trước 100% giá sản phẩm sau thuế tại Nhật','Quý khách được miễn phí xử lý giao dịch nếu thanh toán 100% của phí sau thuế tại Mỹ trong đơn hàng của quý khách.',100,1,0,0,0,2147483647,NULL,NULL,1),(3,'Thanh toán trước 80% giá sản phẩm sau thuế tại Nhật','Nếu quý khách thanh toán trước 80%. Chúng tôi sẽ cộng thêm 2% của phí sau thuế tại Mỹ vào đơn hàng của quý khách.',80,2,2,0,0,NULL,1499859886,NULL,1),(4,'Thanh toán trước 50% giá sản phẩm sau thuế tại Nhật','Nếu quý khách thanh toán trước 50%. Chúng tôi sẽ cộng thêm 3% của phí sau thuế tại Mỹ vào đơn hàng của quý khách.',50,2,3,0,0,2147483647,1500880051,NULL,1);
/*!40000 ALTER TABLE `payment_type_detail` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-25 22:37:59
