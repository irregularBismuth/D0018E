-- MariaDB dump 10.19  Distrib 10.6.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: D0018E
-- ------------------------------------------------------
-- Server version	10.6.12-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `animals`
--

DROP TABLE IF EXISTS `animals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animals` (
  `animal_id` int(11) NOT NULL AUTO_INCREMENT,
  `animal_name` varchar(25) NOT NULL,
  `animal_price` int(11) NOT NULL,
  `animal_image` varchar(1000) DEFAULT NULL,
  `animal_category` varchar(45) NOT NULL,
  `animal_quantity` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`animal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animals`
--

LOCK TABLES `animals` WRITE;
/*!40000 ALTER TABLE `animals` DISABLE KEYS */;
INSERT INTO `animals` VALUES (6,'Mankey',55,'https://www.vermontteddybear.com/dw/image/v2/BDKM_PRD/on/demandware.static/-/Sites-master-catalog-vtb/default/dwe127d882/images/VTB/vtb-24791_13inchsnugglepalmonkey_FE1_221207_0358.jpg?sw=600','Coolest monkey in the jungle',46),(7,'Pingu',11,'https://upload.wikimedia.org/wikipedia/commons/0/07/Emperor_Penguin_Manchot_empereur.jpg','test',3),(8,'Panther',1350,'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Jaguar.jpg/1200px-Jaguar.jpg','Pantherino',9);
/*!40000 ALTER TABLE `animals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (22,13),(23,14),(24,15);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_item`
--

DROP TABLE IF EXISTS `cart_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_id` (`cart_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `animals` (`animal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_item`
--

LOCK TABLES `cart_item` WRITE;
/*!40000 ALTER TABLE `cart_item` DISABLE KEYS */;
INSERT INTO `cart_item` VALUES (36,24,6,2,55);
/*!40000 ALTER TABLE `cart_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `animal_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_comment_id` int(11) DEFAULT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_username` varchar(255) NOT NULL,
  `comment_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`comment_id`),
  KEY `animal_id` (`animal_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`animal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ode`
--

DROP TABLE IF EXISTS `ode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `ode_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ode`
--

LOCK TABLES `ode` WRITE;
/*!40000 ALTER TABLE `ode` DISABLE KEYS */;
INSERT INTO `ode` VALUES (1,13,'2023-03-14 17:36:23',55),(3,13,'2023-03-14 22:34:17',88),(5,14,'2023-03-15 08:15:16',55);
/*!40000 ALTER TABLE `ode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ode_item`
--

DROP TABLE IF EXISTS `ode_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ode_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `odeid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `odeid` (`odeid`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `ode_item_ibfk_1` FOREIGN KEY (`odeid`) REFERENCES `ode` (`id`),
  CONSTRAINT `ode_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `animals` (`animal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ode_item`
--

LOCK TABLES `ode_item` WRITE;
/*!40000 ALTER TABLE `ode_item` DISABLE KEYS */;
INSERT INTO `ode_item` VALUES (27,1,6,55,3),(29,3,6,11,8),(32,5,6,55,1);
/*!40000 ALTER TABLE `ode_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `animals` (`animal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rate` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `uid` (`uid`),
  CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `animals` (`animal_id`),
  CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` VALUES (9,5,6,14),(10,4,6,14),(11,3,6,14),(12,3,6,14),(13,4,6,14),(14,5,6,14),(15,2,6,14);
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactional`
--

DROP TABLE IF EXISTS `transactional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactional` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `dateTime_id` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(11) NOT NULL,
  `transactional_amount` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `transactional_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactional`
--

LOCK TABLES `transactional` WRITE;
/*!40000 ALTER TABLE `transactional` DISABLE KEYS */;
INSERT INTO `transactional` VALUES (1,'2023-03-09 18:47:00',2,0,'no status',NULL),(2,'2023-03-09 18:47:21',2,0,'no status',NULL),(18,'2023-03-10 03:41:22',2,0,'no status',NULL),(19,'2023-03-10 12:57:53',2,0,'no status',NULL),(21,'2023-03-10 13:52:37',2,0,'no status',NULL),(22,'2023-03-10 13:53:26',2,0,'no status',NULL),(23,'2023-03-10 13:54:00',2,0,'no status',NULL),(24,'2023-03-10 14:06:54',2,0,'no status',NULL),(25,'2023-03-10 14:08:39',2,0,'no status',NULL),(26,'2023-03-10 14:11:04',2,0,'no status',NULL),(27,'2023-03-10 14:11:59',2,0,'no status',NULL),(28,'2023-03-10 14:13:32',2,0,'no status',NULL),(29,'2023-03-10 14:15:56',2,0,'no status',NULL),(30,'2023-03-10 14:17:22',2,0,'no status',NULL),(31,'2023-03-10 14:19:31',2,0,'no status',NULL),(32,'2023-03-10 14:20:01',2,0,'no status',NULL),(33,'2023-03-10 14:20:47',2,0,'no status',NULL),(34,'2023-03-10 14:23:35',2,0,'no status',NULL),(35,'2023-03-10 14:24:28',2,0,'no status',NULL),(36,'2023-03-10 14:24:44',2,0,'no status',NULL),(37,'2023-03-10 14:36:47',2,0,'no status',NULL),(38,'2023-03-10 14:49:33',2,0,'no status',NULL),(39,'2023-03-10 14:50:11',2,0,'no status',NULL);
/*!40000 ALTER TABLE `transactional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `profileImage` varchar(255) NOT NULL DEFAULT '../images/defaultProfileImage.png',
  `adminbool` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (13,'a','b',9824,'test@ltu.se','../images/defaultProfileImage.png',1),(14,'oogabooga','o',934,'super@ltu.se','../images/defaultProfileImage.png',0),(15,'bob','bob',0,'bob@bob','../images/defaultProfileImage.png',0);
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

-- Dump completed on 2023-03-15  8:47:38
