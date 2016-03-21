-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: finproj
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `ideal_spending` decimal(18,2) NOT NULL,
  `actual_spending` decimal(18,2) NOT NULL,
  `sp_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'1','Food',2000.00,20.00,1),(2,'2','Food',200.00,5.00,1),(3,'1','Food',2000.00,50.00,2),(5,'1','Poop',5000.00,20.00,1),(6,'1','Alex',50.00,0.00,10),(7,'4','Food',550.00,1554.00,1),(8,'4','Clothing',120.00,0.00,1),(9,'4','Utilities',100.00,0.00,1),(10,'4','Entertainment',50.00,35.00,1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `item` varchar(255) NOT NULL,
  `money_spent` decimal(18,2) NOT NULL,
  `spending_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,1,'poop',20.00,'2015-12-05'),(2,2,'Ice cream',5.00,'2015-12-05'),(4,7,'turkey',30.00,'2015-12-05'),(5,10,'Taylor Swift Album',30.00,'2015-12-05'),(6,7,'ice cream',200.00,'2015-12-05'),(7,7,'Berryline',20.00,'2015-12-05'),(8,7,'Pink Berry',200.00,'2015-12-05'),(9,10,'computer',3.00,'2015-12-05'),(10,7,'tar',3.00,'2015-06-07'),(11,10,'cheese',2.00,'2015-09-07'),(12,7,'food',100.00,'2015-09-08'),(13,7,'food',1.00,'2015-06-07'),(14,7,'tiger',1000.00,'2015-04-05');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `total_budget` decimal(18,2) NOT NULL,
  `spending_start` date NOT NULL,
  `spending_end` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `alert_options` int(10) NOT NULL,
  `money_spent` decimal(18,2) NOT NULL,
  `curr_sp` int(10) NOT NULL,
  `period_length` int(3) NOT NULL,
  `alert_sent` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Joy','joyjin','$2y$10$85G7X2R.i8DlLApLIU101Oj/eJAeJQoAll4L5M5OEeIhA7SU346CK',55.00,'2015-12-06','2015-12-11','joyjin@college.harvard.edu',0,0.00,10,5,0),(2,'Dill','pickle','$2y$10$DFqXVNL1e7TcdvScBMB/VefPVh/31ZaIMsjKPIRfRBnKPl3ESaZ9S',200.00,'2015-12-05','2015-12-07','a@a.com',0,5.00,1,1,0),(3,'Ice cream','icecream','$2y$10$cOEGNJjNW.b54hT59quP6.7iNTh3UyaDKDvcuFN3YnxWGbmQJ5JZe',0.00,'2015-12-06','2015-12-11','icecream@gmail.com',1,0.00,1,5,0),(4,'Alex Lin','ski_bunnies','$2y$10$.iTjV4SW/KEk/.f2TFuIku1CONec0ZpwAlBMmFq2Va//anqLhcCES',820.00,'2015-12-06','2016-01-25','alin5250@gmail.com',1,1589.00,1,50,1);
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

-- Dump completed on 2015-12-06  4:06:21
