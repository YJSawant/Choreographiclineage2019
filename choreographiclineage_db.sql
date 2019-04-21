-- MySQL dump 10.14  Distrib 5.5.60-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: choreographiclineage_db
-- ------------------------------------------------------
-- Server version	5.5.60-MariaDB

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
-- Table structure for table `artist_education`
--

DROP TABLE IF EXISTS `artist_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artist_education` (
  `artist_email_id` varchar(100) NOT NULL,
  `artist_profile_id` int(255) NOT NULL,
  `education_type` varchar(200) NOT NULL,
  `institution_name` varchar(200) NOT NULL,
  `major` varchar(200) NOT NULL,
  `degree` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist_education`
--

LOCK TABLES `artist_education` WRITE;
/*!40000 ALTER TABLE `artist_education` DISABLE KEYS */;
INSERT INTO `artist_education` VALUES ('wtuckerdance@gmail.com',1,'main','Arizona State University','Dance','BFA'),('gus.solomonsjr@nyu.edu',8,'main','Massachusetts Institute of Technology','','BFA'),('hep.three@mac.com',37,'main','Hollins','Dance','MFA');
/*!40000 ALTER TABLE `artist_education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artist_genres`
--

DROP TABLE IF EXISTS `artist_genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artist_genres` (
  `artist_genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_profile_id` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`artist_genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist_genres`
--

LOCK TABLES `artist_genres` WRITE;
/*!40000 ALTER TABLE `artist_genres` DISABLE KEYS */;
/*!40000 ALTER TABLE `artist_genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artist_profile`
--

DROP TABLE IF EXISTS `artist_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artist_profile` (
  `artist_profile_id` int(255) NOT NULL AUTO_INCREMENT,
  `is_user_artist` varchar(10) NOT NULL,
  `profile_name` varchar(50) NOT NULL,
  `artist_first_name` varchar(50) NOT NULL,
  `artist_last_name` varchar(100) NOT NULL,
  `artist_email_address` varchar(50) NOT NULL,
  `artist_living_status` varchar(10) NOT NULL,
  `artist_dob` date NOT NULL,
  `artist_dod` date NOT NULL,
  `artist_genre` varchar(150) NOT NULL,
  `artist_ethnicity` varchar(50) NOT NULL,
  `artist_gender` varchar(50) NOT NULL,
  `gender_other` varchar(100) NOT NULL,
  `genre_other` varchar(100) NOT NULL,
  `ethnicity_other` varchar(100) NOT NULL,
  `artist_residence_city` varchar(100) NOT NULL,
  `artist_residence_state` varchar(100) NOT NULL,
  `artist_residence_province` varchar(100) NOT NULL,
  `artist_residence_country` varchar(100) NOT NULL,
  `artist_birth_country` varchar(100) NOT NULL,
  `artist_biography` varchar(500) NOT NULL,
  `artist_biography_text` varchar(1000) NOT NULL,
  `artist_photo_path` varchar(500) NOT NULL,
  `artist_website` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`artist_profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist_profile`
--

LOCK TABLES `artist_profile` WRITE;
/*!40000 ALTER TABLE `artist_profile` DISABLE KEYS */;
INSERT INTO `artist_profile` VALUES (1,'artist','','Whitney','Tucker','wtuckerdance@gmail.com','living','1982-01-02','0000-00-00','','','female','','','','','','','United States of America','','','Whitney Rippelmeyer-Tucker, from the hills of southern Illinois, moved to New York in 2006 to pursue a career in modern dance.  She graduated Magna Cum Laude from Arizona State University with a BFA in Dance Education.  Her interests over time have led her to study Capoeira, Contact Improvisation, various lineages of yoga, boxing, and social dance.  She draws from experiences as a public school teacher (Vancouver, WA) and from those as the creator/facilitator of a movement-program for women who were recovering from prostitution (Phoenix, AZ).  She is a member of David Dorfman Dance and Tiffany Mills Company, is a teacher-trainer at the Kane School of Core Integration,  and is completing certification as a Birth Doula.  Most-recently, she became co-founder of Studio 26, a wellness-center located in Manhattan.','','www.studio26nyc.com'),(2,'other','','David','Dorfman','david.dorfman@conncoll.edu','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','www.daviddorfmandance.org'),(3,'other','','Jennifer','Tsukayama','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(4,'other','','Kathleen','Hermesdorf','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(5,'other','','Nita','Little','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(6,'other','','Tiffany','Mills','tiffany@tiffanymillscompany.org','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','www.tiffanymillscompany.org'),(7,'other','','Jen','Polins','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','www.wiremonkeydance.com'),(8,'artist','','Gus','Solomons Jr','gus.solomonsjr@nyu.edu','','0000-00-00','0000-00-00','','','male','','','','','','','','','upload/biography_upload_data/solomonsgus.pdf','','','paradigm-nyc.org'),(9,'other','','Merce','Cunningham','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(10,'other','','Robert','Cohan','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(11,'other','','Jan','Veem','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(12,'other','','Richard','Thomas','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(13,'other','','Donald','Mckayle','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(14,'other','','Pearl','Lang','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(15,'other','','Martha','Graham','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(16,'other','','Mio','Morales','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(17,'other','','Toby','Twining','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(18,'other','','Scott','DeVere','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(19,'artist','','Richard','Siegal','Richard@TheBakery.org','','0000-00-00','0000-00-00','','','','','','','','','','','','upload/biography_upload_data/richardsiegal.pdf','','','www.thebakery.org'),(20,'other','','Mary','Anthony','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(21,'other','','Albert','Reid','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(22,'other','','Lenore','Lattimer','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(23,'other','','Aileen','Pasloff','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(24,'other','','Jean','Churchill','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(25,'other','','Jan','Miller','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(26,'other','','Igal','Perry','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(27,'other','','Zvi','Gotheiner','zgd@mindspring.com','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','www.zvidance.com'),(28,'other','','Wayne','Byers','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(29,'other','','Janis','Brenner','Janisbren@aol.com','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','www.janisbrenner.com'),(30,'other','','San Cha','Hong','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(31,'other','','Doug','Elkins','doug5583@aol.com','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(32,'other','','William','Forsythe','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(33,'other','','Bruce','Gremo','bruce.gremo@gmail.com','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','www.suddensite.net/about.html'),(34,'other','','Christine','Peters','cp@hmach.com','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(35,'other','','Prue','Lang','pruex@hotmail.com','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','www.pruelang.com'),(36,'other','','Hillary','Goidell','hillfish@gmail.com','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','hillg.free.fr/home.html'),(37,'artist','','Helen','Picket','hep.three@mac.com','','1967-00-00','0000-00-00','','','female','','','','','','','','','upload/biography_upload_data/helenpicket.pdf','','','www.helenpickett.com'),(38,'other','','Kathryn','Irey','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(39,'other','','Thomas','DeFrantz','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(40,'other','','Larisa','Skylenskaya','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(41,'other','','Anatole','Vilsak','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(42,'other','','Nicole','Sowinska','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(43,'other','','Ohad','Naharin','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(44,'other','','Michael','Smuim','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(45,'other','','Saburo','Teshigawara','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(46,'other','','Alvin','Ailey','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(47,'other','','George','Balanchine','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(48,'other','','Pina','Bausch','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(49,'other','','Mats','Ek','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(50,'other','','Katherine','Dunham','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(51,'other','','Jiri','Kylian','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(52,'other','','Elisa','Monte','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL);
/*!40000 ALTER TABLE `artist_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artist_relation`
--

DROP TABLE IF EXISTS `artist_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artist_relation` (
  `relation_id` int(255) NOT NULL AUTO_INCREMENT,
  `artist_profile_id_1` int(255) NOT NULL,
  `artist_profile_id_2` int(255) NOT NULL,
  `artist_name_1` varchar(255) NOT NULL,
  `artist_email_id_1` varchar(100) NOT NULL,
  `artist_name_2` varchar(255) NOT NULL,
  `artist_email_id_2` varchar(100) NOT NULL,
  `artist_website_2` varchar(200) NOT NULL,
  `artist_relation` varchar(100) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date NOT NULL,
  `duration_years` int(255) NOT NULL,
  `duration_months` int(255) NOT NULL,
  `relation_identifier` varchar(250) NOT NULL,
  PRIMARY KEY (`relation_id`),
  UNIQUE KEY `relation_identifier` (`artist_profile_id_1`,`artist_profile_id_2`,`artist_relation`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist_relation`
--

LOCK TABLES `artist_relation` WRITE;
/*!40000 ALTER TABLE `artist_relation` DISABLE KEYS */;
INSERT INTO `artist_relation` VALUES (1,1,2,'Whitney-Tucker','wtuckerdance@gmail.com','David-Dorfman','david.dorfman@conncoll.edu','','Studied With',NULL,'0000-00-00',0,0,''),(2,1,3,'Whitney-Tucker','wtuckerdance@gmail.com','Jennifer-Tsukayama','','','Studied With',NULL,'0000-00-00',0,0,''),(3,1,4,'Whitney-Tucker','wtuckerdance@gmail.com','Kathleen-Hermesdorf','','','Studied With',NULL,'0000-00-00',0,0,''),(4,1,5,'Whitney-Tucker','wtuckerdance@gmail.com','Nita-Little','','','Studied With',NULL,'0000-00-00',0,0,''),(5,1,2,'Whitney-Tucker','wtuckerdance@gmail.com','David-Dorfman','david.dorfman@conncoll.edu','','Danced For',NULL,'0000-00-00',0,0,''),(6,1,6,'Whitney-Tucker','wtuckerdance@gmail.com','Tiffany-Mills','tiffany@tiffanymillscompany.org','','Danced For',NULL,'0000-00-00',0,0,''),(7,1,7,'Whitney-Tucker','wtuckerdance@gmail.com','Jen-Polins','','','Danced For',NULL,'0000-00-00',0,0,''),(8,8,9,'Gus-Solomons Jr','gus.solomonsjr@nyu.edu','Merce-Cunningham','','','Studied With',NULL,'0000-00-00',0,0,''),(9,8,10,'Gus-Solomons Jr','gus.solomonsjr@nyu.edu','Robert-Cohan','','','Studied With',NULL,'0000-00-00',0,0,''),(10,8,11,'Gus-Solomons Jr','gus.solomonsjr@nyu.edu','Jan-Veem','','','Studied With',NULL,'0000-00-00',0,0,''),(11,8,12,'Gus-Solomons Jr','gus.solomonsjr@nyu.edu','Richard-Thomas','','','Studied With',NULL,'0000-00-00',0,0,''),(12,8,10,'Gus-Solomons Jr','gus.solomonsjr@nyu.edu','Merce-Cunningham','','','Danced For',NULL,'0000-00-00',0,0,''),(13,8,13,'Gus-Solomons Jr','gus.solomonsjr@nyu.edu','Donald-Mckayle','','','Danced For',NULL,'0000-00-00',0,0,''),(14,8,14,'Gus-Solomons Jr','gus.solomonsjr@nyu.edu','Pearl-Lang','','','Danced For',NULL,'0000-00-00',0,0,''),(15,8,15,'Gus-Solomons Jr','gus.solomonsjr@nyu.edu','Martha-Graham','','','Danced For',NULL,'0000-00-00',0,0,''),(16,8,16,'Gus-Solomons Jr','gus.solomonsjr@nyu.edu','Mio-Morales','','','Collaborated With',NULL,'0000-00-00',0,0,''),(17,8,17,'Gus-Solomons Jr','gus.solomonsjr@nyu.edu','Toby-Twining','','','Collaborated With',NULL,'0000-00-00',0,0,''),(18,8,18,'Gus-Solomons Jr','gus.solomonsjr@nyu.edu','Scott-DeVere','','','Collaborated With',NULL,'0000-00-00',0,0,''),(19,19,20,'Richard-Siegal','Richard@TheBakery.org','Mary-Anthony','','','Studied With',NULL,'0000-00-00',0,0,''),(20,19,21,'Richard-Siegal','Richard@TheBakery.org','Albert-Reid','','','Studied With',NULL,'0000-00-00',0,0,''),(21,19,22,'Richard-Siegal','Richard@TheBakery.org','Lenore-Lattimer','','','Studied With',NULL,'0000-00-00',0,0,''),(22,19,23,'Richard-Siegal','Richard@TheBakery.org','Aileen-Pasloff','','','Studied With',NULL,'0000-00-00',0,0,''),(23,19,24,'Richard-Siegal','Richard@TheBakery.org','Jean-Churchill','','','Studied With',NULL,'0000-00-00',0,0,''),(24,19,25,'Richard-Siegal','Richard@TheBakery.org','Jan-Miller','','','Studied With',NULL,'0000-00-00',0,0,''),(25,19,26,'Richard-Siegal','Richard@TheBakery.org','Igal-Perry','','','Studied With',NULL,'0000-00-00',0,0,''),(26,19,27,'Richard-Siegal','Richard@TheBakery.org','Zvi-Gotheiner','zgd@mindspring.com','','Studied With',NULL,'0000-00-00',0,0,''),(27,19,28,'Richard-Siegal','Richard@TheBakery.org','Wayne-Byers','','','Studied With',NULL,'0000-00-00',0,0,''),(28,19,26,'Richard-Siegal','Richard@TheBakery.org','Igal-Perry','','','Danced For',NULL,'0000-00-00',0,0,''),(29,19,29,'Richard-Siegal','Richard@TheBakery.org','Janis-Brenner','Janisbren@aol.com','','Danced For',NULL,'0000-00-00',0,0,''),(30,19,30,'Richard-Siegal','Richard@TheBakery.org','Sin Cha-Hong','','','Danced For',NULL,'0000-00-00',0,0,''),(31,19,31,'Richard-Siegal','Richard@TheBakery.org','Doug-Elkins','doug5583@aol.com','','Danced For',NULL,'0000-00-00',0,0,''),(32,19,27,'Richard-Siegal','Richard@TheBakery.org','Zvi-Gotheiner','zgd@mindspring.com','','Danced For',NULL,'0000-00-00',0,0,''),(33,19,32,'Richard-Siegal','Richard@TheBakery.org','William-Forsythe','','','Danced For',NULL,'0000-00-00',0,0,''),(34,19,33,'Richard-Siegal','Richard@TheBakery.org','Bruce-Gremo','bruce.gremo@gmail.com','','Collaborated With',NULL,'0000-00-00',0,0,''),(35,19,34,'Richard-Siegal','Richard@TheBakery.org','Christine-Peters','cp@hmach.com','','Collaborated With',NULL,'0000-00-00',0,0,''),(36,19,35,'Richard-Siegal','Richard@TheBakery.org','Prue-Lang','pruex@hotmail.com','','Collaborated With',NULL,'0000-00-00',0,0,''),(37,19,36,'Richard-Siegal','Richard@TheBakery.org','Hillary-Goidell','hillfish@gmail.com','','Collaborated With',NULL,'0000-00-00',0,0,''),(38,37,32,'Helen-Picket','hep.three@mac.com','William-Forsythe','','','',NULL,'0000-00-00',0,0,''),(39,37,38,'Helen-Picket','hep.three@mac.com','Kathryn-Irey','','','',NULL,'0000-00-00',0,0,''),(40,37,39,'Helen-Picket','hep.three@mac.com','Thomas-DeFrantz','','','Studied With',NULL,'0000-00-00',0,0,''),(41,37,40,'Helen-Picket','hep.three@mac.com','Larisa-Skylenskaya','','','Studied With',NULL,'0000-00-00',0,0,''),(42,37,41,'Helen-Picket','hep.three@mac.com','Anatole-Vilsak','','','Studied With',NULL,'0000-00-00',0,0,''),(43,37,42,'Helen-Picket','hep.three@mac.com','Nicole-Sowinska','','','Studied With',NULL,'0000-00-00',0,0,''),(44,37,32,'Helen-Picket','hep.three@mac.com','William-Forsythe','','','Danced For',NULL,'0000-00-00',0,0,''),(45,37,43,'Helen-Picket','hep.three@mac.com','Ohad-Naharin','','','Danced For',NULL,'0000-00-00',0,0,''),(46,37,44,'Helen-Picket','hep.three@mac.com','Michael-Smuim','','','Danced For',NULL,'0000-00-00',0,0,''),(47,37,45,'Helen-Picket','hep.three@mac.com','Saburo-Teshigawara','','','Danced For',NULL,'0000-00-00',0,0,''),(48,37,46,'Helen-Picket','hep.three@mac.com','Alvin-Ailey','','','Influenced By',NULL,'0000-00-00',0,0,''),(49,37,47,'Helen-Picket','hep.three@mac.com','George-Balanchine','','','Influenced By',NULL,'0000-00-00',0,0,''),(50,37,48,'Helen-Picket','hep.three@mac.com','Pina-Bausch','','','Influenced By',NULL,'0000-00-00',0,0,''),(51,37,49,'Helen-Picket','hep.three@mac.com','Mats-Ek','','','Influenced By',NULL,'0000-00-00',0,0,''),(52,37,50,'Helen-Picket','hep.three@mac.com','Katherine-Dunham','','','Influenced By',NULL,'0000-00-00',0,0,''),(53,37,51,'Helen-Picket','hep.three@mac.com','Jiri-Kylian','','','Influenced By',NULL,'0000-00-00',0,0,''),(54,37,52,'Helen-Picket','hep.three@mac.com','Elisa-Monte','','','Influenced By',NULL,'0000-00-00',0,0,'');
/*!40000 ALTER TABLE `artist_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artist_works`
--

DROP TABLE IF EXISTS `artist_works`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artist_works` (
  `artist_works_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_profile_id` int(11) DEFAULT NULL,
  `work_id` int(11) DEFAULT NULL,
  `involvement` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`artist_works_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist_works`
--

LOCK TABLES `artist_works` WRITE;
/*!40000 ALTER TABLE `artist_works` DISABLE KEYS */;
/*!40000 ALTER TABLE `artist_works` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) DEFAULT NULL,
  `genre_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genres`
--

LOCK TABLES `genres` WRITE;
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone_appointments`
--

DROP TABLE IF EXISTS `phone_appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone_appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `note` varchar(300) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Undone',
  `Submitted_Date` varchar(100) NOT NULL DEFAULT '04/01/2019',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone_appointments`
--

LOCK TABLES `phone_appointments` WRITE;
/*!40000 ALTER TABLE `phone_appointments` DISABLE KEYS */;
/*!40000 ALTER TABLE `phone_appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profile` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_first_name` varchar(100) NOT NULL,
  `user_last_name` varchar(100) NOT NULL,
  `user_email_address` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_one_time_password` int(255) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'User',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email_address` (`user_email_address`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` VALUES (1,'Miki','Padhiary','mikipadh@buffalo.edu','miki',0,'User'),(2,'Shreyas','Rajguru','srajguru@buffalo.edu','shreyas',0,'User'),(3,'Amit','Banerjee','amitbane@buffalo.edu','amit',0,'User'),(4,'Yogesh','Sawant','yogeshja@buffalo.edu','yogesh',0,'User');
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `works`
--

DROP TABLE IF EXISTS `works`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works` (
  `work_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`work_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works`
--

LOCK TABLES `works` WRITE;
/*!40000 ALTER TABLE `works` DISABLE KEYS */;
/*!40000 ALTER TABLE `works` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-21  1:29:27
