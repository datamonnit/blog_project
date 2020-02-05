CREATE DATABASE  IF NOT EXISTS `blog_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `blog_db`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: blog_db
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.6-MariaDB

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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Eläimet','Keskustelua eläimistä ja niiden hyvinvoinnista.',7),(2,'Kalastus','Kaikille kalastuksen ystäville tarkoitettu kanava.',3),(3,'Kokeillaan',NULL,4);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `body` varchar(45) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `posts_id` int(10) unsigned NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_posts1_idx` (`posts_id`),
  KEY `fk_comments_users1_idx` (`users_id`),
  CONSTRAINT `fk_comments_posts1` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topic` varchar(45) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `categories_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_posts_users_idx` (`users_id`),
  KEY `fk_posts_categories1_idx` (`categories_id`),
  CONSTRAINT `fk_posts_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_posts_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags_has_posts`
--

DROP TABLE IF EXISTS `tags_has_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags_has_posts` (
  `tags_id` int(10) unsigned NOT NULL,
  `posts_id` int(10) unsigned NOT NULL,
  KEY `fk_tags_has_posts_tags1_idx` (`tags_id`),
  KEY `fk_tags_has_posts_posts1_idx` (`posts_id`),
  CONSTRAINT `fk_tags_has_posts_posts1` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tags_has_posts_tags1` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags_has_posts`
--

LOCK TABLES `tags_has_posts` WRITE;
/*!40000 ALTER TABLE `tags_has_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags_has_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(150) DEFAULT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `hash_expire` datetime DEFAULT NULL,
  `banned` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `password_hint` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Pelle','Peloton','pelle@esedu.fi','$2y$10$.TjdyUyGWkjnu9xQdrzRf.laV5EYSKXPYe8y6SVfWAVhiYsLqpjh2','5e3814e300116','2020-02-04 14:41:07',0,'2020-02-03 12:37:42','qwerty'),(3,'Tessi','Testaaja','tessi.testaaja@esedulainen.fi','$2y$10$UmlhaVAVg7CZ9brBIdsjg.LOXnvLMOwuA02vlJGOvdRbIBiSQuPHq',NULL,NULL,0,'2020-02-03 13:20:54','qweqwe'),(4,'Ossi','Opiskelija','ossi.opiskelija@esedulainen.fi','$2y$10$8CmbImd6Yg.ujuXFTWLtU.k/7hjMG/.sNDb4bwVGx2Mkh7gP9KZIK','5e38120f02216','2020-02-04 14:29:03',0,'2020-02-03 13:23:23','qweqwe'),(5,'Tuomas','Puro','tuomas@esedu.fi','qweqwe',NULL,NULL,0,'2020-02-04 12:01:14','qweqwe'),(6,'Jaakko','Kulta','jaakko@esedu.fi','$2y$10$iGdjWBPdogXktO9nHKALK.8WziBpxNPmUQWIOLd0VWtT3E.RjNvMW',NULL,NULL,0,'2020-02-04 12:05:15','qwerty'),(8,'Elmeri','Huttunen','elmeri@esedu.fi','$2y$10$EoB892nF4wDeXJ8yEKjeNOBXZv63/dBUcc5uRvsd8ZekTqyYUkU.K',NULL,NULL,0,'2020-02-04 12:38:40','qweqwe'),(9,'Mooses','Makkonen','mooses@esedu.fi','$2y$10$ByhRmE8GaRhylZJRkgJ2zOOJIH/16oXJBGD.fD5lNDzcTA3bjU5Im',NULL,NULL,0,'2020-02-04 12:59:51','qweqwe'),(11,'Jeppe','Makkonen','jeppe@esedu.fi','$2y$10$IQZYPETuIBXeWiIQbj6JO.dZ2IcZLFkKkvFUtYBOVBDQUJwATNfOi',NULL,NULL,0,'2020-02-04 13:05:41','moi');
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

-- Dump completed on 2020-02-05 13:58:42
