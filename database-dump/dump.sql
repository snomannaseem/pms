-- MySQL dump 10.13  Distrib 5.7.11-4, for Linux (x86_64)
--
-- Host: localhost    Database: pms_db
-- ------------------------------------------------------
-- Server version	5.7.11-4

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
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Designing',0),(2,'QA',1),(3,'Managment',0),(4,'Sales',1);
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
  `type_id` int(10) unsigned DEFAULT NULL,
  `issue_id` int(10) unsigned DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_issue_comments` (`issue_id`),
  CONSTRAINT `fk_issue_comments` FOREIGN KEY (`issue_id`) REFERENCES `issues` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,NULL,5,'updated this comments',1,1,'2017-04-24 14:32:02',1,'2017-04-24 16:20:11'),(2,NULL,5,'working on this task .',1,1,'2017-04-24 16:21:10',1,'2017-04-24 16:27:04'),(3,NULL,5,'sdsad sdsad aasdsad sad',1,1,'2017-04-24 16:22:48',1,'2017-04-24 16:22:55'),(4,NULL,5,'Working on this task. updated',0,1,'2017-04-24 16:29:02',1,'2017-04-24 16:29:12'),(5,NULL,5,'this is second comments',0,1,'2017-04-24 16:55:31',NULL,NULL);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `issue_id` int(10) unsigned DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_history_issue` (`issue_id`),
  CONSTRAINT `fk_history_issue` FOREIGN KEY (`issue_id`) REFERENCES `issues` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (1,5,'Comment has been added',1,'2017-04-24 14:28:22'),(2,5,'Comment has been added',1,'2017-04-24 14:32:02'),(3,5,'Comment has been updated',1,'2017-04-24 15:46:41'),(4,5,'Comment has been updated',1,'2017-04-24 15:48:09'),(5,5,'Comment has been updated',1,'2017-04-24 16:20:11'),(6,5,'Comment has been added',1,'2017-04-24 16:21:10'),(7,5,'Comment has been added',1,'2017-04-24 16:22:48'),(8,5,'Comment has been updated',1,'2017-04-24 16:22:52'),(9,5,'Comment has been deleted',1,'2017-04-24 16:22:55'),(10,5,'Comment has been deleted',1,'2017-04-24 16:27:04'),(11,5,'Comment has been added',1,'2017-04-24 16:29:02'),(12,5,'Comment has been updated',1,'2017-04-24 16:29:12'),(13,5,'Comment has been added',1,'2017-04-24 16:55:31');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue_resolution_types`
--

DROP TABLE IF EXISTS `issue_resolution_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issue_resolution_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issue_resolution_types`
--

LOCK TABLES `issue_resolution_types` WRITE;
/*!40000 ALTER TABLE `issue_resolution_types` DISABLE KEYS */;
INSERT INTO `issue_resolution_types` VALUES (1,'open'),(2,'fixed'),(3,'repopend'),(4,'unable to reproduce');
/*!40000 ALTER TABLE `issue_resolution_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue_types`
--

DROP TABLE IF EXISTS `issue_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issue_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issue_types`
--

LOCK TABLES `issue_types` WRITE;
/*!40000 ALTER TABLE `issue_types` DISABLE KEYS */;
INSERT INTO `issue_types` VALUES (1,'task'),(2,'sub-task'),(3,'story'),(4,'bug'),(5,'epic'),(6,'incident'),(7,'change'),(8,'problem');
/*!40000 ALTER TABLE `issue_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `issue_type_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `est_time` decimal(9,2) DEFAULT NULL COMMENT 'Time in hours',
  `priority_id` int(10) unsigned DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL COMMENT '''open'',''in-progress'',''resolved'',''reopened'',''closed''',
  `resolution_id` int(10) unsigned DEFAULT NULL,
  `parent_issue_id` int(10) unsigned DEFAULT NULL,
  `assigned_to` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_issue_priority_id` (`priority_id`),
  KEY `fk_issue_category_id` (`category_id`),
  KEY `fk_issue_user_id` (`assigned_to`),
  KEY `fk_issue_resolution_id` (`resolution_id`),
  KEY `fk_issue_type_id` (`issue_type_id`),
  CONSTRAINT `fk_issue_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `fk_issue_priority_id` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`),
  CONSTRAINT `fk_issue_resolution_id` FOREIGN KEY (`resolution_id`) REFERENCES `issue_resolution_types` (`id`),
  CONSTRAINT `fk_issue_type_id` FOREIGN KEY (`issue_type_id`) REFERENCES `issue_types` (`id`),
  CONSTRAINT `fk_issue_user_id` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issues`
--

LOCK TABLES `issues` WRITE;
/*!40000 ALTER TABLE `issues` DISABLE KEYS */;
INSERT INTO `issues` VALUES (1,3,2,3,'setrs','',2.00,1,'open',NULL,NULL,1,'2017-04-19 16:53:01',1,NULL,NULL),(2,3,4,3,'Story: Create registration process for Project Fast','<ol>\r\n	<li>&nbsp;User First name&nbsp;</li>\r\n	<li>User Last name</li>\r\n	<li>Age</li>\r\n	<li>Sex</li>\r\n	<li>Date Of Birth</li>\r\n</ol>\r\n',55.00,1,'in progress',3,0,2,'2017-04-20 15:44:32',1,1,'2017-04-20 15:44:32'),(3,6,4,1,'LTF-1 Login panel','<p>added login panel</p>\r\n',2.00,2,'open',1,0,11,'2017-04-20 18:29:02',1,1,'2017-04-20 18:29:02'),(4,6,4,2,'Sub Task -1 LFT - : Create edit profile','<p>Create edi profile</p>\r\n',2.00,1,'open',1,0,11,'2017-04-21 10:34:45',1,NULL,NULL),(5,6,4,1,'Sub task -2 LTF: Profile update.','',2.00,2,'open',1,0,11,'2017-04-21 11:05:44',1,1,'2017-04-21 12:26:47');
/*!40000 ALTER TABLE `issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `priorities`
--

DROP TABLE IF EXISTS `priorities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `priorities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `priorities`
--

LOCK TABLES `priorities` WRITE;
/*!40000 ALTER TABLE `priorities` DISABLE KEYS */;
INSERT INTO `priorities` VALUES (1,'highest'),(2,'high'),(3,'medium'),(4,'low'),(5,'lowest');
/*!40000 ALTER TABLE `priorities` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`192.168.0.72`*/ /*!50003 TRIGGER `pms_db`.`prevent_insert` BEFORE INSERT
    ON `pms_db`.`priorities`
    FOR EACH ROW BEGIN
      SIGNAL SQLSTATE '45000' -- "unhandled user-defined exception"
      
      -- Here comes your custom error message that will be returned by MySQL
      SET MESSAGE_TEXT = 'This table is sacred! You are not allowed to insert in it!!';
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`192.168.0.72`*/ /*!50003 TRIGGER `pms_db`.`prevent_update` BEFORE UPDATE
    ON `pms_db`.`priorities`
    FOR EACH ROW BEGIN
      SIGNAL SQLSTATE '45000' -- "unhandled user-defined exception"
      
      -- Here comes your custom error message that will be returned by MySQL
      SET MESSAGE_TEXT = 'This table is sacred! You are not allowed to add/update/remove it!!';
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`192.168.0.72`*/ /*!50003 trigger `priority_prevent_delete` BEFORE DELETE on `pms_db`.`priorities` for each row BEGIN
      SIGNAL SQLSTATE '45000' -- "unhandled user-defined exception"
      
      -- Here comes your custom error message that will be returned by MySQL
      SET MESSAGE_TEXT = 'This record is sacred! You are not allowed to remove it!!';
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `est_time` int(11) DEFAULT NULL COMMENT 'Time in days',
  `est_deadline` datetime DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_projects_team_id` (`team_id`),
  CONSTRAINT `fk_projects_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,1,'adpad','',1,NULL,'0',1,'2017-04-18 14:09:40',1,'2017-04-18 14:09:40'),(2,1,'Updated Updated Project MI','<p><strong>Launch a misle to kill Vin Diesel updated</strong></p>\r\n\r\n<ol>\r\n	<li><strong>This is one line&nbsp;</strong></li>\r\n	<li><strong>This is sceond line</strong></li>\r\n	<li><strong>This is three line</strong></li>\r\n</ol>\r\n',5,'2017-04-18 00:00:00','2',1,'2017-04-18 16:56:44',1,'2017-04-18 16:56:44'),(3,1,'adpad007','<blockquote>\r\n<p>adpad 007 project launch for abc</p>\r\n</blockquote>\r\n',8,'2017-04-27 00:00:00','1',1,'2017-04-18 16:57:25',1,'2017-04-18 16:57:25'),(4,1,'Project 008','',8,'2017-04-18 00:00:00','1',1,'2017-04-18 11:08:49',1,'2017-04-18 11:08:49'),(5,1,'Project Fast 7 Furious','<p>Launch a misle to kill Vin Diesel</p>\r\n',2,'2017-04-18 00:00:00','1',1,'2017-04-18 11:17:16',1,'2017-04-18 11:17:16'),(6,1,'Love That Fit','<p>This is the description of the Love That Fit.</p>\r\n\r\n<p>&nbsp;</p>\r\n',8,'2017-04-20 00:00:00','1',1,'2017-04-20 18:20:07',1,'2017-04-20 18:20:07');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_resources`
--

DROP TABLE IF EXISTS `projects_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `project_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_resources_user_id` (`user_id`),
  KEY `fk_resources_project_id` (`project_id`),
  CONSTRAINT `fk_resources_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  CONSTRAINT `fk_resources_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_resources`
--

LOCK TABLES `projects_resources` WRITE;
/*!40000 ALTER TABLE `projects_resources` DISABLE KEYS */;
INSERT INTO `projects_resources` VALUES (1,1,3),(2,3,3),(3,2,5),(4,11,6),(5,12,6);
/*!40000 ALTER TABLE `projects_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_resources`
--

DROP TABLE IF EXISTS `team_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_team_resources_team_id` (`team_id`),
  KEY `fk_team_resources_user_id` (`user_id`),
  CONSTRAINT `fk_team_resources_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  CONSTRAINT `fk_team_resources_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_resources`
--

LOCK TABLES `team_resources` WRITE;
/*!40000 ALTER TABLE `team_resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL COMMENT 'active,inactive,archived',
  `created_by` int(10) unsigned NOT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'eZanga','active',1,'2017-04-20 22:00:16'),(2,'Atif','active',1,NULL),(3,'NetStride','active',1,NULL),(4,'NetStride','active',1,NULL);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `desig_id` int(11) DEFAULT NULL COMMENT 'designation id',
  `remember_token` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Noman','noman@email.com','$2y$10$WqjNhenzdgkLlQf.6.v.Te2IPFAEkl1fCykBIdUeQxCWw3eBeIU1a',NULL,NULL,0),(2,'Adnan Kamal','adnan@hotmail.com','123',NULL,NULL,0),(3,'Suresh Babo','suresh@babo.com','123',NULL,NULL,0),(4,'Raja Muneeb','muneeb@raja.com','123',NULL,NULL,0),(5,'Atif k..k..kiran','1234','22',NULL,NULL,0),(6,'Farhan Silent feature','silent@violent.com','123',NULL,NULL,0),(7,'Atif','atif@cs.com','$2y$10$lbpaBhlQf64ct1WhG.t3m.oJ5QgM4FqvLvcT0nRsEdxSJRbYP803C',NULL,'u0Iuw8UZpigDul0ZAFX5ynD88Zvla2wSFb4y4sQpZHCs24pX5zbkVe9oCFE8',1),(8,'Noman Naseem4','noman2@email.com','123',NULL,NULL,1),(9,'Kashaan','atif2@cs.com','12345',NULL,NULL,1),(10,'Kashaan','atif3@cs.com','12345',NULL,NULL,1),(11,'Kashaan','atif4@cs.com','12345',NULL,NULL,1),(12,'Pagal Aadmi','pagal@aadmi.com','12345',NULL,NULL,NULL),(13,'Suresh k','suresh@kumar.com','',NULL,NULL,1),(14,'NetStride',NULL,NULL,NULL,NULL,1),(15,'NetStride',NULL,NULL,NULL,NULL,1),(16,'NetStride',NULL,NULL,NULL,NULL,1),(17,'test',NULL,NULL,NULL,NULL,1),(18,'test',NULL,NULL,NULL,NULL,1),(19,'Atif',NULL,NULL,NULL,NULL,1),(20,'Atif',NULL,NULL,NULL,NULL,1),(21,'Atif',NULL,NULL,NULL,NULL,1),(22,'NetStride',NULL,NULL,NULL,NULL,1),(23,'Atif',NULL,NULL,NULL,NULL,1);
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

-- Dump completed on 2017-04-24 23:13:02
