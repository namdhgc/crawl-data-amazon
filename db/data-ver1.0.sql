-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: crawl-data-amazon
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

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
-- Table structure for table `agency`
--

DROP TABLE IF EXISTS `agency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8 NOT NULL,
  `address` varchar(200) CHARACTER SET utf8 NOT NULL,
  `country` varchar(200) CHARACTER SET utf8 NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Agency';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agency`
--

LOCK TABLES `agency` WRITE;
/*!40000 ALTER TABLE `agency` DISABLE KEYS */;
/*!40000 ALTER TABLE `agency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_news_categories`
--

DROP TABLE IF EXISTS `detail_news_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_news_categories` (
  `cate_id` int(11) NOT NULL,
  `lang_code` varchar(20) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_news_categories`
--

LOCK TABLES `detail_news_categories` WRITE;
/*!40000 ALTER TABLE `detail_news_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_news_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` int(11) DEFAULT '0',
  `remake` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES (1,'roles',0,''),(2,'permission',0,NULL),(3,'categories',0,NULL),(4,'agency',0,NULL),(5,'warehouse',0,NULL),(6,'transaction',0,NULL),(7,'price',0,NULL),(8,'product',0,NULL),(9,'news',0,NULL),(10,'product_categories',0,NULL),(11,'',0,NULL),(12,'',0,NULL);
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_categories`
--

DROP TABLE IF EXISTS `news_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_categories`
--

LOCK TABLES `news_categories` WRITE;
/*!40000 ALTER TABLE `news_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `news_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,0) NOT NULL DEFAULT '0',
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_roles`
--

DROP TABLE IF EXISTS `permission_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `read` tinyint(4) DEFAULT '0',
  `write` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_roles`
--

LOCK TABLES `permission_roles` WRITE;
/*!40000 ALTER TABLE `permission_roles` DISABLE KEYS */;
INSERT INTO `permission_roles` VALUES (1,1,1,0,1),(2,2,1,1,1),(3,1,2,0,0),(4,2,2,0,0),(5,3,1,1,1),(6,4,1,1,1),(7,5,1,1,1),(8,6,1,1,1),(9,7,1,1,1),(10,8,1,1,1),(11,9,1,1,1),(12,3,2,1,0),(13,4,2,1,0),(14,5,2,1,0),(15,6,2,1,0),(16,7,2,1,0),(17,8,2,1,0),(18,9,2,1,0),(19,1,4,1,0),(20,2,4,1,0),(21,3,4,1,1),(22,4,4,1,1),(23,5,4,1,1),(24,6,4,1,1),(25,7,4,1,1),(26,8,4,1,1),(27,9,4,1,1),(28,10,1,0,1),(29,10,2,1,0),(30,10,4,1,1);
/*!40000 ALTER TABLE `permission_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_list`
--

DROP TABLE IF EXISTS `price_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `description` varchar(100) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_list`
--

LOCK TABLES `price_list` WRITE;
/*!40000 ALTER TABLE `price_list` DISABLE KEYS */;
INSERT INTO `price_list` VALUES (1,'tetdddd',0,'wdwdwwdwd',1497232216,NULL,NULL);
/*!40000 ALTER TABLE `price_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_list_detail`
--

DROP TABLE IF EXISTS `price_list_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_list_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price_id` int(11) NOT NULL,
  `key` varchar(200) NOT NULL,
  `value` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_list_detail`
--

LOCK TABLES `price_list_detail` WRITE;
/*!40000 ALTER TABLE `price_list_detail` DISABLE KEYS */;
INSERT INTO `price_list_detail` VALUES (1,1,'vat',99);
/*!40000 ALTER TABLE `price_list_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `amazon_id` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `parent_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'本・コミック・雑誌 & Audible','0',0,'本・コミック・雑誌 & Audible'),(2,'本','465392',1,'本・コミック・雑誌 & Audible'),(3,'Kindle本','2275256051',1,'本・コミック・雑誌 & Audible'),(4,'洋書','52033011',1,'本・コミック・雑誌 & Audible'),(5,'コミック','466280',1,'本・コミック・雑誌 & Audible'),(6,'雑誌','13384021',1,'本・コミック・雑誌 & Audible'),(7,'古本・古書','255460011',1,'本・コミック・雑誌 & Audible'),(8,'Audible オーディオブック','3479195051',1,'本・コミック・雑誌 & Audible'),(9,'DVD・ミュージック・ゲーム','0',0,'DVD・ミュージック・ゲーム'),(10,'DVD','561958',9,'DVD・ミュージック・ゲーム'),(11,'ブルーレイ','403507011',9,'DVD・ミュージック・ゲーム'),(12,'ミュージック','561956',9,'DVD・ミュージック・ゲーム'),(13,'デジタルミュージック','2128134051',9,'DVD・ミュージック・ゲーム'),(14,'楽器','2123629051',9,'DVD・ミュージック・ゲーム'),(15,'TVゲーム','637394',9,'DVD・ミュージック・ゲーム'),(16,'PCゲーム','689132',9,'DVD・ミュージック・ゲーム'),(17,'ゲームダウンロード','2510863051',9,'DVD・ミュージック・ゲーム'),(18,'家電・カメラ・AV機器','0',0,'家電・カメラ・AV機器'),(19,'キッチン家電','3895771',18,'家電・カメラ・AV機器'),(20,'生活家電','3895791',18,'家電・カメラ・AV機器'),(21,'理美容家電','3895751',18,'家電・カメラ・AV機器'),(22,'空調・季節家電','3895761',18,'家電・カメラ・AV機器'),(23,'照明','2133982051',18,'家電・カメラ・AV機器'),(24,'すべての家電','124048011',18,'家電・カメラ・AV機器'),(25,'カメラ・ビデオカメラ','16462091',18,'家電・カメラ・AV機器'),(26,'業務用カメラ・プロ機材','3465736051',18,'家電・カメラ・AV機器'),(27,'双眼鏡・望遠鏡・光学機器','171350011',18,'家電・カメラ・AV機器'),(28,'携帯電話・スマートフォン','128187011',18,'家電・カメラ・AV機器'),(29,'テレビ・レコーダー','3477381',18,'家電・カメラ・AV機器'),(30,'オーディオ','16462081',18,'家電・カメラ・AV機器'),(31,'イヤホン・ヘッドホン','3477981',18,'家電・カメラ・AV機器'),(32,'ウェアラブルデバイス','3544106051',18,'家電・カメラ・AV機器'),(33,'アクセサリ','3371421',18,'家電・カメラ・AV機器'),(34,'すべてのカメラ・AV機器','3210981',18,'家電・カメラ・AV機器'),(35,'中古カメラ・ビデオカメラ','3573765051',18,'家電・カメラ・AV機器'),(36,'中古AV機器・携帯電話','3708582051',18,'家電・カメラ・AV機器'),(37,'すべての中古','3128558051',18,'家電・カメラ・AV機器'),(38,'パソコン・オフィス用品','0',0,'パソコン・オフィス用品'),(39,'パソコン・タブレット','2188762051',38,'パソコン・オフィス用品'),(40,'ディスプレイ・モニター','2151982051',38,'パソコン・オフィス用品'),(41,'プリンター・インク','2188763051',38,'パソコン・オフィス用品'),(42,'キーボード・マウス・入力機器','2151970051',38,'パソコン・オフィス用品'),(43,'無線LAN・ネットワーク機器','2151984051',38,'パソコン・オフィス用品'),(44,'PCパーツ・CPU・内蔵HDD','2151901051',38,'パソコン・オフィス用品'),(45,'外付けドライブ・ストレージ','2151950051',38,'パソコン・オフィス用品'),(46,'SD・microSDカード・USBメモリ','3481981',38,'パソコン・オフィス用品'),(47,'PCアクセサリ・記録メディア','2151826051',38,'パソコン・オフィス用品'),(48,'ゲーミングPC・関連アクセサリ','3378226051',38,'パソコン・オフィス用品'),(49,'すべてのパソコン・周辺機器','2127209051',38,'パソコン・オフィス用品'),(50,'ビジネス・オフィス','637644',38,'パソコン・オフィス用品'),(51,'セキュリティ','1040116',38,'パソコン・オフィス用品'),(52,'画像・映像制作','2449110051',38,'パソコン・オフィス用品'),(53,'PCゲーム','689132',38,'パソコン・オフィス用品'),(54,'ダウンロード版','2201422051',38,'パソコン・オフィス用品'),(55,'PCソフト定期購入','3465706051',38,'パソコン・オフィス用品'),(56,'すべてのPCソフト','637392',38,'パソコン・オフィス用品'),(57,'文具・学用品','2478562051',38,'パソコン・オフィス用品'),(58,'事務用品','89083051',38,'パソコン・オフィス用品'),(59,'筆記具','89088051',38,'パソコン・オフィス用品'),(60,'ノート・メモ帳','89085051',38,'パソコン・オフィス用品'),(61,'手帳・カレンダー','89090051',38,'パソコン・オフィス用品'),(62,'オフィス家具','89084051',38,'パソコン・オフィス用品'),(63,'オフィス機器','89086051',38,'パソコン・オフィス用品'),(64,'すべての文房具・オフィス用品','86731051',38,'パソコン・オフィス用品'),(65,'ホーム＆キッチン・ペット・DIY','0',0,'ホーム＆キッチン・ペット・DIY'),(66,'キッチン用品・食器','13938481',65,'ホーム＆キッチン・ペット・DIY'),(67,'インテリア・雑貨','3093567051',65,'ホーム＆キッチン・ペット・DIY'),(68,'カーペット・カーテン・クッション','2538755051',65,'ホーム＆キッチン・ペット・DIY'),(69,'家具','16428011',65,'ホーム＆キッチン・ペット・DIY'),(70,'収納用品・収納家具','13945081',65,'ホーム＆キッチン・ペット・DIY'),(71,'布団・枕・シーツ','2378086051',65,'ホーム＆キッチン・ペット・DIY'),(72,'掃除・洗濯・バス・トイレ','3093569051',65,'ホーム＆キッチン・ペット・DIY'),(73,'防犯・防災','2038875051',65,'ホーム＆キッチン・ペット・DIY'),(74,'家電','124048011',65,'ホーム＆キッチン・ペット・DIY'),(75,'手芸・画材','2189701051',65,'ホーム＆キッチン・ペット・DIY'),(76,'すべてのホーム＆キッチン','3828871',65,'ホーム＆キッチン・ペット・DIY'),(77,'電動工具','2031744051',65,'ホーム＆キッチン・ペット・DIY'),(78,'作業工具','2038157051',65,'ホーム＆キッチン・ペット・DIY'),(79,'リフォーム','2448361051',65,'ホーム＆キッチン・ペット・DIY'),(80,'ガーデニング','2361405051',65,'ホーム＆キッチン・ペット・DIY'),(81,'エクステリア','2039681051',65,'ホーム＆キッチン・ペット・DIY'),(82,'すべてのDIY・工具','2016929051',65,'ホーム＆キッチン・ペット・DIY'),(83,'ペット用品・ペットフード','2127212051',65,'ホーム＆キッチン・ペット・DIY'),(84,'食品・飲料・お酒','0',0,'食品・飲料・お酒'),(85,'食品・グルメ','57239051',84,'食品・飲料・お酒'),(86,'お米・麺・パン・シリアル','2439923051',84,'食品・飲料・お酒'),(87,'調味料・スパイス','71198051',84,'食品・飲料・お酒'),(88,'スイーツ・お菓子','71314051',84,'食品・飲料・お酒'),(89,'水・ソフトドリンク','71442051',84,'食品・飲料・お酒'),(90,'コーヒー・お茶','2422738051',84,'食品・飲料・お酒'),(91,'おとなセレクト','4152300051',84,'食品・飲料・お酒'),(92,'Nipponストア(ご当地グルメ・特産品)','2199930051',84,'食品・飲料・お酒'),(93,'ヤスイイね・お買い得情報','76366051',84,'食品・飲料・お酒'),(94,'Dash Button (ダッシュボタン)','4752863051',84,'食品・飲料・お酒'),(95,'Amazonフレッシュ','4477209051',84,'食品・飲料・お酒'),(96,'Amazonパントリー','3485873051',84,'食品・飲料・お酒'),(97,'Amazon定期おトク便','2799399051',84,'食品・飲料・お酒'),(98,'出前特集','3485688051',84,'食品・飲料・お酒'),(99,'ビール・発泡酒','71589051',84,'食品・飲料・お酒'),(100,'ワイン','71649051',84,'食品・飲料・お酒'),(101,'日本酒','71610051',84,'食品・飲料・お酒'),(102,'焼酎','71601051',84,'食品・飲料・お酒'),(103,'梅酒','71620051',84,'食品・飲料・お酒'),(104,'洋酒・リキュール','71625051',84,'食品・飲料・お酒'),(105,'チューハイ・カクテル','2422292051',84,'食品・飲料・お酒'),(106,'ノンアルコール飲料','2422338051',84,'食品・飲料・お酒'),(107,'すべてのお酒','71588051',84,'食品・飲料・お酒'),(108,'Amazonソムリエ','4097695051',84,'食品・飲料・お酒'),(109,'ドラッグストア・ビューティー','0',0,'ドラッグストア・ビューティー'),(110,'医薬品','2505532051',109,'ドラッグストア・ビューティー'),(111,'ヘルスケア・衛生用品','169911011',109,'ドラッグストア・ビューティー'),(112,'コンタクトレンズ','2356869051',109,'ドラッグストア・ビューティー'),(113,'サプリメント','344024011',109,'ドラッグストア・ビューティー'),(114,'ダイエット','3396823051',109,'ドラッグストア・ビューティー'),(115,'シニアサポート・介護','170432011',109,'ドラッグストア・ビューティー'),(116,'おむつ・おしりふき','170303011',109,'ドラッグストア・ビューティー'),(117,'日用品 (掃除・洗濯・キッチン)','170563011',109,'ドラッグストア・ビューティー'),(118,'ドラッグストアへ','160384011',109,'ドラッグストア・ビューティー'),(119,'Dash Button (ダッシュボタン)','4752863051',109,'ドラッグストア・ビューティー'),(120,'Amazonパントリー','3485873051',109,'ドラッグストア・ビューティー'),(121,'Amazon定期おトク便','2799399051',109,'ドラッグストア・ビューティー'),(122,'ヘアケア・スタイリング','169667011',109,'ドラッグストア・ビューティー'),(123,'スキンケア','170040011',109,'ドラッグストア・ビューティー'),(124,'メイクアップ・ネイル','170191011',109,'ドラッグストア・ビューティー'),(125,'バス・ボディケア','170267011',109,'ドラッグストア・ビューティー'),(126,'オーラルケア','169762011',109,'ドラッグストア・ビューティー'),(127,'男性化粧品・シェービング','3364474051',109,'ドラッグストア・ビューティー'),(128,'ラグジュアリービューティー','3396994051',109,'ドラッグストア・ビューティー'),(129,'ナチュラル・オーガニック','53048051',109,'ドラッグストア・ビューティー'),(130,'ドクターズコスメ','3501772051',109,'ドラッグストア・ビューティー'),(131,'トライアルキット','3217793051',109,'ドラッグストア・ビューティー'),(132,'ブランド一覧','3544982051',109,'ドラッグストア・ビューティー'),(133,'ビューティーストアへ','52374051',109,'ドラッグストア・ビューティー'),(134,'ベビー・おもちゃ・ホビー','0',0,'ベビー・おもちゃ・ホビー'),(135,'ベビー＆マタニティ','344845011',134,'ベビー・おもちゃ・ホビー'),(136,'おもちゃ','13299531',134,'ベビー・おもちゃ・ホビー'),(137,'絵本・児童書','466306',134,'ベビー・おもちゃ・ホビー'),(138,'ホビー','2277721051',134,'ベビー・おもちゃ・ホビー'),(139,'楽器','2123629051',134,'ベビー・おもちゃ・ホビー'),(140,'服・シューズ・バッグ ・腕時計','0',0,'服・シューズ・バッグ ・腕時計'),(141,'レディース','2230006051',140,'服・シューズ・バッグ ・腕時計'),(142,'メンズ','2230005051',140,'服・シューズ・バッグ ・腕時計'),(143,'キッズ＆ベビー','2230804051',140,'服・シューズ・バッグ ・腕時計'),(144,'バッグ・スーツケース','2221077051',140,'服・シューズ・バッグ ・腕時計'),(145,'スポーツウェア＆シューズ','2188968051',140,'服・シューズ・バッグ ・腕時計'),(146,'スポーツ＆アウトドア','0',0,'スポーツ＆アウトドア'),(147,'自転車','15337751',146,'スポーツ＆アウトドア'),(148,'アウトドア','14315411',146,'スポーツ＆アウトドア'),(149,'釣り','14315521',146,'スポーツ＆アウトドア'),(150,'フィットネス・トレーニング','14315501',146,'スポーツ＆アウトドア'),(151,'ゴルフ','14315441',146,'スポーツ＆アウトドア'),(152,'スポーツウェア＆シューズ','2188968051',146,'スポーツ＆アウトドア'),(153,'すべてのスポーツ＆アウトドア','14304371',146,'スポーツ＆アウトドア'),(154,'車＆バイク・産業・研究開発','0',0,'車＆バイク・産業・研究開発'),(155,'カー用品','2017304051',154,'車＆バイク・産業・研究開発'),(156,'バイク用品','2319890051',154,'車＆バイク・産業・研究開発'),(157,'自動車&バイク車体','3305008051',154,'車＆バイク・産業・研究開発'),(158,'DIY・工具','2016929051',154,'車＆バイク・産業・研究開発'),(159,'安全・保護用品','2031746051',154,'車＆バイク・産業・研究開発'),(160,'工業機器','3333565051',154,'車＆バイク・産業・研究開発'),(161,'研究開発用品','3037451051',154,'車＆バイク・産業・研究開発'),(162,'衛生・清掃用品','3450744051',154,'車＆バイク・産業・研究開発'),(163,'すべての産業・研究開発用品','3445393051',154,'車＆バイク・産業・研究開発');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `remake` varchar(150) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - owner\n1 - other',
  `slug` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'owner',0,NULL,0,'owner'),(2,'Customer',0,'haha',0,NULL),(4,'Admin',0,'admin',0,'admin');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `amazon_id` int(11) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `purchased_price` decimal(15,4) DEFAULT NULL,
  `purchased_date` int(11) DEFAULT NULL,
  `voucher` varchar(50) DEFAULT NULL,
  `payment` varchar(32) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_status`
--

DROP TABLE IF EXISTS `transaction_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_status`
--

LOCK TABLES `transaction_status` WRITE;
/*!40000 ALTER TABLE `transaction_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_information`
--

DROP TABLE IF EXISTS `user_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_information` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_information`
--

LOCK TABLES `user_information` WRITE;
/*!40000 ALTER TABLE `user_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_information` ENABLE KEYS */;
UNLOCK TABLES;

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
  `facebook_id` varchar(150) DEFAULT NULL,
  `google_id` varchar(150) DEFAULT NULL,
  `roles` int(11) DEFAULT NULL,
  `token_reset_password` varchar(100) DEFAULT NULL,
  `resert_password_at` int(11) DEFAULT NULL,
  `end_time_confirm` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'owner','$2y$10$KBRqq.oWW5LVEHvvF1Y0bubBYvluOkOupmhnuCtiuK2AVBR3pW.cm',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouse`
--

DROP TABLE IF EXISTS `warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouse`
--

LOCK TABLES `warehouse` WRITE;
/*!40000 ALTER TABLE `warehouse` DISABLE KEYS */;
INSERT INTO `warehouse` VALUES (1,'Kho số 12',3,1232132,'Tây Sơn','Hà Nội',NULL,1496646138,NULL),(2,'Kho số 2',4,438734567,'Hoàng Quốc Việt','Hà Nội',1496636425,1496645857,NULL);
/*!40000 ALTER TABLE `warehouse` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-13 13:50:01
