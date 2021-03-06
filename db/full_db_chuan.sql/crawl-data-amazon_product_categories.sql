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
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amazon_id` varchar(100) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `parent_name` varchar(100) DEFAULT NULL,
  `level` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'0','本・コミック・雑誌 & Audible',0,'本・コミック・雑誌 & Audible',0),(2,'465392','本',1,'本・コミック・雑誌 & Audible',0),(3,'2275256051','Kindle本',1,'本・コミック・雑誌 & Audible',0),(4,'52033011','洋書',1,'本・コミック・雑誌 & Audible',0),(5,'466280','コミック',1,'本・コミック・雑誌 & Audible',0),(6,'13384021','雑誌',1,'本・コミック・雑誌 & Audible',0),(7,'255460011','古本・古書',1,'本・コミック・雑誌 & Audible',0),(8,'3479195051','Audible オーディオブック',1,'本・コミック・雑誌 & Audible',0),(9,'0','DVD・ミュージック・ゲーム',0,'DVD・ミュージック・ゲーム',0),(10,'561958','DVD',9,'DVD・ミュージック・ゲーム',0),(11,'403507011','ブルーレイ',9,'DVD・ミュージック・ゲーム',0),(12,'561956','ミュージック',9,'DVD・ミュージック・ゲーム',0),(13,'2128134051','デジタルミュージック',9,'DVD・ミュージック・ゲーム',0),(14,'2123629051','楽器',9,'DVD・ミュージック・ゲーム',0),(15,'637394','TVゲーム',9,'DVD・ミュージック・ゲーム',0),(16,'689132','PCゲーム',9,'DVD・ミュージック・ゲーム',0),(17,'2510863051','ゲームダウンロード',9,'DVD・ミュージック・ゲーム',0),(18,'0','家電・カメラ・AV機器',0,'家電・カメラ・AV機器',0),(19,'3895771','キッチン家電',18,'家電・カメラ・AV機器',0),(20,'3895791','生活家電',18,'家電・カメラ・AV機器',0),(21,'3895751','理美容家電',18,'家電・カメラ・AV機器',0),(22,'3895761','空調・季節家電',18,'家電・カメラ・AV機器',0),(23,'2133982051','照明',18,'家電・カメラ・AV機器',0),(24,'124048011','すべての家電',18,'家電・カメラ・AV機器',0),(25,'16462091','カメラ・ビデオカメラ',18,'家電・カメラ・AV機器',0),(26,'3465736051','業務用カメラ・プロ機材',18,'家電・カメラ・AV機器',0),(27,'171350011','双眼鏡・望遠鏡・光学機器',18,'家電・カメラ・AV機器',0),(28,'128187011','携帯電話・スマートフォン',18,'家電・カメラ・AV機器',0),(29,'3477381','テレビ・レコーダー',18,'家電・カメラ・AV機器',0),(30,'16462081','オーディオ',18,'家電・カメラ・AV機器',0),(31,'3477981','イヤホン・ヘッドホン',18,'家電・カメラ・AV機器',0),(32,'3544106051','ウェアラブルデバイス',18,'家電・カメラ・AV機器',0),(33,'3371421','アクセサリ',18,'家電・カメラ・AV機器',0),(34,'3210981','すべてのカメラ・AV機器',18,'家電・カメラ・AV機器',0),(35,'3573765051','中古カメラ・ビデオカメラ',18,'家電・カメラ・AV機器',0),(36,'3708582051','中古AV機器・携帯電話',18,'家電・カメラ・AV機器',0),(37,'3128558051','すべての中古',18,'家電・カメラ・AV機器',0),(38,'0','パソコン・オフィス用品',0,'パソコン・オフィス用品',0),(39,'2188762051','パソコン・タブレット',38,'パソコン・オフィス用品',0),(40,'2151982051','ディスプレイ・モニター',38,'パソコン・オフィス用品',0),(41,'2188763051','プリンター・インク',38,'パソコン・オフィス用品',0),(42,'2151970051','キーボード・マウス・入力機器',38,'パソコン・オフィス用品',0),(43,'2151984051','無線LAN・ネットワーク機器',38,'パソコン・オフィス用品',0),(44,'2151901051','PCパーツ・CPU・内蔵HDD',38,'パソコン・オフィス用品',0),(45,'2151950051','外付けドライブ・ストレージ',38,'パソコン・オフィス用品',0),(46,'3481981','SD・microSDカード・USBメモリ',38,'パソコン・オフィス用品',0),(47,'2151826051','PCアクセサリ・記録メディア',38,'パソコン・オフィス用品',0),(48,'3378226051','ゲーミングPC・関連アクセサリ',38,'パソコン・オフィス用品',0),(49,'2127209051','すべてのパソコン・周辺機器',38,'パソコン・オフィス用品',0),(50,'637644','ビジネス・オフィス',38,'パソコン・オフィス用品',0),(51,'1040116','セキュリティ',38,'パソコン・オフィス用品',0),(52,'2449110051','画像・映像制作',38,'パソコン・オフィス用品',0),(53,'689132','PCゲーム',38,'パソコン・オフィス用品',0),(54,'2201422051','ダウンロード版',38,'パソコン・オフィス用品',0),(55,'3465706051','PCソフト定期購入',38,'パソコン・オフィス用品',0),(56,'637392','すべてのPCソフト',38,'パソコン・オフィス用品',0),(57,'2478562051','文具・学用品',38,'パソコン・オフィス用品',0),(58,'89083051','事務用品',38,'パソコン・オフィス用品',0),(59,'89088051','筆記具',38,'パソコン・オフィス用品',0),(60,'89085051','ノート・メモ帳',38,'パソコン・オフィス用品',0),(61,'89090051','手帳・カレンダー',38,'パソコン・オフィス用品',0),(62,'89084051','オフィス家具',38,'パソコン・オフィス用品',0),(63,'89086051','オフィス機器',38,'パソコン・オフィス用品',0),(64,'86731051','すべての文房具・オフィス用品',38,'パソコン・オフィス用品',0),(65,'0','ホーム＆キッチン・ペット・DIY',0,'ホーム＆キッチン・ペット・DIY',0),(66,'13938481','キッチン用品・食器',65,'ホーム＆キッチン・ペット・DIY',0),(67,'3093567051','インテリア・雑貨',65,'ホーム＆キッチン・ペット・DIY',0),(68,'2538755051','カーペット・カーテン・クッション',65,'ホーム＆キッチン・ペット・DIY',0),(69,'16428011','家具',65,'ホーム＆キッチン・ペット・DIY',0),(70,'13945081','収納用品・収納家具',65,'ホーム＆キッチン・ペット・DIY',0),(71,'2378086051','布団・枕・シーツ',65,'ホーム＆キッチン・ペット・DIY',0),(72,'3093569051','掃除・洗濯・バス・トイレ',65,'ホーム＆キッチン・ペット・DIY',0),(73,'2038875051','防犯・防災',65,'ホーム＆キッチン・ペット・DIY',0),(74,'124048011','家電',65,'ホーム＆キッチン・ペット・DIY',0),(75,'2189701051','手芸・画材',65,'ホーム＆キッチン・ペット・DIY',0),(76,'3828871','すべてのホーム＆キッチン',65,'ホーム＆キッチン・ペット・DIY',0),(77,'2031744051','電動工具',65,'ホーム＆キッチン・ペット・DIY',0),(78,'2038157051','作業工具',65,'ホーム＆キッチン・ペット・DIY',0),(79,'2448361051','リフォーム',65,'ホーム＆キッチン・ペット・DIY',0),(80,'2361405051','ガーデニング',65,'ホーム＆キッチン・ペット・DIY',0),(81,'2039681051','エクステリア',65,'ホーム＆キッチン・ペット・DIY',0),(82,'2016929051','すべてのDIY・工具',65,'ホーム＆キッチン・ペット・DIY',0),(83,'2127212051','ペット用品・ペットフード',65,'ホーム＆キッチン・ペット・DIY',0),(84,'0','食品・飲料・お酒',0,'食品・飲料・お酒',0),(85,'57239051','食品・グルメ',84,'食品・飲料・お酒',0),(86,'2439923051','お米・麺・パン・シリアル',84,'食品・飲料・お酒',0),(87,'71198051','調味料・スパイス',84,'食品・飲料・お酒',0),(88,'71314051','スイーツ・お菓子',84,'食品・飲料・お酒',0),(89,'71442051','水・ソフトドリンク',84,'食品・飲料・お酒',0),(90,'2422738051','コーヒー・お茶',84,'食品・飲料・お酒',0),(91,'4152300051','おとなセレクト',84,'食品・飲料・お酒',0),(92,'2199930051','Nipponストア(ご当地グルメ・特産品)',84,'食品・飲料・お酒',0),(93,'76366051','ヤスイイね・お買い得情報',84,'食品・飲料・お酒',0),(94,'4752863051','Dash Button (ダッシュボタン)',84,'食品・飲料・お酒',0),(95,'4477209051','Amazonフレッシュ',84,'食品・飲料・お酒',0),(96,'3485873051','Amazonパントリー',84,'食品・飲料・お酒',0),(97,'2799399051','Amazon定期おトク便',84,'食品・飲料・お酒',0),(98,'3485688051','出前特集',84,'食品・飲料・お酒',0),(99,'71589051','ビール・発泡酒',84,'食品・飲料・お酒',0),(100,'71649051','ワイン',84,'食品・飲料・お酒',0),(101,'71610051','日本酒',84,'食品・飲料・お酒',0),(102,'71601051','焼酎',84,'食品・飲料・お酒',0),(103,'71620051','梅酒',84,'食品・飲料・お酒',0),(104,'71625051','洋酒・リキュール',84,'食品・飲料・お酒',0),(105,'2422292051','チューハイ・カクテル',84,'食品・飲料・お酒',0),(106,'2422338051','ノンアルコール飲料',84,'食品・飲料・お酒',0),(107,'71588051','すべてのお酒',84,'食品・飲料・お酒',0),(108,'4097695051','Amazonソムリエ',84,'食品・飲料・お酒',0),(109,'0','ドラッグストア・ビューティー',0,'ドラッグストア・ビューティー',0),(110,'2505532051','医薬品',109,'ドラッグストア・ビューティー',0),(111,'169911011','ヘルスケア・衛生用品',109,'ドラッグストア・ビューティー',0),(112,'2356869051','コンタクトレンズ',109,'ドラッグストア・ビューティー',0),(113,'344024011','サプリメント',109,'ドラッグストア・ビューティー',0),(114,'3396823051','ダイエット',109,'ドラッグストア・ビューティー',0),(115,'170432011','シニアサポート・介護',109,'ドラッグストア・ビューティー',0),(116,'170303011','おむつ・おしりふき',109,'ドラッグストア・ビューティー',0),(117,'170563011','日用品 (掃除・洗濯・キッチン)',109,'ドラッグストア・ビューティー',0),(118,'160384011','ドラッグストアへ',109,'ドラッグストア・ビューティー',0),(119,'4752863051','Dash Button (ダッシュボタン)',109,'ドラッグストア・ビューティー',0),(120,'3485873051','Amazonパントリー',109,'ドラッグストア・ビューティー',0),(121,'2799399051','Amazon定期おトク便',109,'ドラッグストア・ビューティー',0),(122,'169667011','ヘアケア・スタイリング',109,'ドラッグストア・ビューティー',0),(123,'170040011','スキンケア',109,'ドラッグストア・ビューティー',0),(124,'170191011','メイクアップ・ネイル',109,'ドラッグストア・ビューティー',0),(125,'170267011','バス・ボディケア',109,'ドラッグストア・ビューティー',0),(126,'169762011','オーラルケア',109,'ドラッグストア・ビューティー',0),(127,'3364474051','男性化粧品・シェービング',109,'ドラッグストア・ビューティー',0),(128,'3396994051','ラグジュアリービューティー',109,'ドラッグストア・ビューティー',0),(129,'53048051','ナチュラル・オーガニック',109,'ドラッグストア・ビューティー',0),(130,'3501772051','ドクターズコスメ',109,'ドラッグストア・ビューティー',0),(131,'3217793051','トライアルキット',109,'ドラッグストア・ビューティー',0),(132,'3544982051','ブランド一覧',109,'ドラッグストア・ビューティー',0),(133,'52374051','ビューティーストアへ',109,'ドラッグストア・ビューティー',0),(134,'0','ベビー・おもちゃ・ホビー',0,'ベビー・おもちゃ・ホビー',0),(135,'344845011','ベビー＆マタニティ',134,'ベビー・おもちゃ・ホビー',0),(136,'13299531','おもちゃ',134,'ベビー・おもちゃ・ホビー',0),(137,'466306','絵本・児童書',134,'ベビー・おもちゃ・ホビー',0),(138,'2277721051','ホビー',134,'ベビー・おもちゃ・ホビー',0),(139,'2123629051','楽器',134,'ベビー・おもちゃ・ホビー',0),(140,'0','服・シューズ・バッグ ・腕時計',0,'服・シューズ・バッグ ・腕時計',0),(141,'2230006051','レディース',140,'服・シューズ・バッグ ・腕時計',0),(142,'2230005051','メンズ',140,'服・シューズ・バッグ ・腕時計',0),(143,'2230804051','キッズ＆ベビー',140,'服・シューズ・バッグ ・腕時計',0),(144,'2221077051','バッグ・スーツケース',140,'服・シューズ・バッグ ・腕時計',0),(145,'2188968051','スポーツウェア＆シューズ',140,'服・シューズ・バッグ ・腕時計',0),(146,'0','スポーツ＆アウトドア',0,'スポーツ＆アウトドア',0),(147,'15337751','自転車',146,'スポーツ＆アウトドア',0),(148,'14315411','アウトドア',146,'スポーツ＆アウトドア',0),(149,'14315521','釣り',146,'スポーツ＆アウトドア',0),(150,'14315501','フィットネス・トレーニング',146,'スポーツ＆アウトドア',0),(151,'14315441','ゴルフ',146,'スポーツ＆アウトドア',0),(152,'2188968051','スポーツウェア＆シューズ',146,'スポーツ＆アウトドア',0),(153,'14304371','すべてのスポーツ＆アウトドア',146,'スポーツ＆アウトドア',0),(154,'0','車＆バイク・産業・研究開発',0,'車＆バイク・産業・研究開発',0),(155,'2017304051','カー用品',154,'車＆バイク・産業・研究開発',0),(156,'2319890051','バイク用品',154,'車＆バイク・産業・研究開発',0),(157,'3305008051','自動車&バイク車体',154,'車＆バイク・産業・研究開発',0),(158,'2016929051','DIY・工具',154,'車＆バイク・産業・研究開発',0),(159,'2031746051','安全・保護用品',154,'車＆バイク・産業・研究開発',0),(160,'3333565051','工業機器',154,'車＆バイク・産業・研究開発',0),(161,'3037451051','研究開発用品',154,'車＆バイク・産業・研究開発',0),(162,'3450744051','衛生・清掃用品',154,'車＆バイク・産業・研究開発',0),(163,'3445393051','すべての産業・研究開発用品',154,'車＆バイク・産業・研究開発',0);
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
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
