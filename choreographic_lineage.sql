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
CREATE DATABASE choreographic_lineage;
USE choreographic_lineage;

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
INSERT INTO `artist_education` VALUES ('',56,'main','UB','CS','MS'),('',56,'other','MAD','','Associate'),('',82,'main','UB','CS','MS'),('',82,'other','Sathaye College','','SSC'),('',72,'main','University at Buffalo','Computer Science','Masters'),('',72,'main','VJTI','Information Technology','B.Tech'),('',72,'other','M.A.D','','Fellowship'),('',72,'other','S.R.A.','','Senate'),('',83,'main','UB','CS','MS'),('',83,'other','Institute','','Degree'),('',88,'main','','',''),('',88,'other','','',''),('',87,'main','','',''),('',87,'other','','',''),('',89,'main','SUNY Buffalo','',''),('',89,'other','','',''),('',91,'main','SUNY Buffalo','Computer Science and Engineering','Master of Science'),('',91,'other','','',''),('',92,'main','','',''),('',92,'other','','',''),('',95,'main','','',''),('',95,'other','','',''),('',94,'main','State University of NY at Geneseo','Psychology',''),('',94,'main','','',''),('',94,'other','','',''),('',94,'other','','',''),('',102,'main','','',''),('',102,'other','','',''),('',108,'main','','',''),('',108,'other','','',''),('',111,'main','State University of New York at Geneseo','Psychology and Dance','BA '),('',111,'main','New York University','Dance','MFA'),('',111,'other','Kane School of Core Integration','','Pilates Mat Certification'),('',114,'main','','',''),('',114,'other','','',''),('',116,'main','','',''),('',116,'other','','',''),('',122,'main','','',''),('',122,'other','','',''),('',85,'main','','',''),('',85,'other','','',''),('',130,'main','Indian Institute of Technology, Delhi','Mechanical','BTech'),('',130,'other','','',''),('',135,'main','','',''),('',135,'other','','',''),('',112,'main','','',''),('',112,'other','','',''),('',0,'main','','',''),('',0,'other','','',''),('',141,'main','State University of New York at Buffalo','Psychology','BA'),('',141,'main','New York University, Tisch School of the Arts','Dance','MFA'),('',141,'other','Kane School of Core Integration','','Pilates Mat Certification'),('',146,'main','','',''),('',146,'other','','',''),('',151,'main','State University of New York at Buffalo','Arts','MS'),('',151,'other','','','');
/*!40000 ALTER TABLE `artist_education` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist_profile`
--

LOCK TABLES `artist_profile` WRITE;
/*!40000 ALTER TABLE `artist_profile` DISABLE KEYS */;
INSERT INTO `artist_profile` VALUES (56,'other','','test1','test1','test1','living','1989-01-02','0000-00-00',',Actor,Composer,Other','other','other','Transgender','Singer','Phili','Buffalo','','Kabul','Afganistan','Afganistan','','','photo_upload_data/IMG_20170610_232036916.jpg','0'),(58,'other','','test2','test2','test2.com','living','1975-03-05','0000-00-00',',Actor,Composer','cw','male','','','','Buffalo','NY','','United States of America','United States of America','','','','website.com'),(71,'other','','test3','test3','test3.com','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','website.com'),(72,'artist','sumedh0192@gmail.com','Sumedh','Ambokar','sumedh0192@gmail.com','living','1992-01-01','0000-00-00',',Actor,Other','asian','male','','Singer','','Buffalo','NY','','United States of America','India','biography_upload_data/Amazon.pdf','','photo_upload_data/IMG-20160612-WA0009.jpg','sumedhambokar.com'),(73,'other','','Yash','Jain','yashnavi@buffalo.edu','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','yashnavi.com'),(74,'other','','Mitali','Bhiwande','mitalivi@buffalo.edu','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','acsu.buffalo.edu/~mitaliv'),(75,'other','','Mitali','Bhiwande','mitalivi@buffalo.edu','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','acsu.buffalo.edu/~mitalivi/'),(76,'other','','','','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',''),(77,'other','','Test','test','test','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','test'),(78,'other','','Akshay','Shah','akshaybh@buffalo.edu','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','akshaybh.com'),(79,'other','','Yash','Jain','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','yashnavi.com'),(80,'other','','Mitali','Bhiwande','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','acsu.buffalo.edu/~mitalivi/'),(81,'other','','Akshay','Shah','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','akshaybh.com'),(82,'other','sumedh0192@gmail.com','Saurabh','Bajoria','sbajoria@buffalo.edu','living','1990-08-14','0000-00-00',',Dancer,Filmmaker,Musician','other','male','','','Cannot Specify','Buffalo','NY','','United States of America','United States of America','','','',NULL),(83,'other','sumedh0192@gmail.com','Kaushik','Ramasubramanian','kaushik4r@gmail.com','deceased','1989-01-02','2017-08-10',',Actor,Costume_Designer,Dancer,Poet,Visual_Artist,Scenic_Designer','aab','male','','','','Buffalo','NY','','United States of America','India','biography_upload_data/Semester Intent to Return fall 2017.doc','','photo_upload_data/IMG_20170610_194324880.jpg',NULL),(84,'other','','Saurabh','Bajoria','sbajoria@buffalo.edu','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',''),(91,'artist','barathes@buffalo.edu','Barath','N','barathes@buffalo.edu','living','2017-12-14','0000-00-00',',Actor','','male','','','','','','','','','','','',NULL),(93,'artist','sumedhsa@buffalo.edu','Sumedh','Ambokar','sumedhsa@buffalo.edu','living','0000-00-00','0000-00-00',',Actor,Choreographer,Lighting_Designer','','','','','','','','','','','','','',NULL),(95,'other','okennedy@buffalo.edu','Steve','Jobs','spam@xthemage.net','deceased','0001-01-01','0002-11-01','','','','','','','','','','','','','','',NULL),(96,'artist','okennedy@buffalo.edu','Oliver','Kennedy','okennedy@buffalo.edu','living','0000-00-00','0000-00-00','','','','','','','','','','','','','','',NULL),(97,'other','','Monica','Barnes','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',''),(98,'artist','shivamsahu050992@gmail.com','Shivam','Sahu','shivamsahu050992@gmail.com','living','0000-00-00','0000-00-00',',Actor','','','','','','','','','','','','','',NULL),(100,'other','','Shivam','Sahu','shivamsahu050993@gmail.com','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',''),(102,'artist','sa32@buffalo.edu','James','Brown','sa32@buffalo.edu','living','1988-07-12','0000-00-00',',Musician','other','male','','','','','','','','','','						\r\n\r\nhello, i am james','',NULL),(103,'artist','sa32@buffalo.edu','James','Brown','sa32@buffalo.edu','living','0000-00-00','0000-00-00',',Filmmaker','','','','','','','','','','','','','',NULL),(112,'artist','shivamsahu050993@gmail.com','Shivam','Sahu','shivamsahu050993@gmail.com','living','2002-08-31','0000-00-00',',Filmmaker,Visual_Artist','','','','','','','','','','','','','photo_upload_data/DP.jpg',NULL),(123,'other','','Shailesh','Adhikari','shailadhikari@gmail.com','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',''),(130,'other','shivamsahu050993@gmail.com','Sanjay','Sahu','sanjay@gmail.com','living','2018-11-15','0000-00-00',',Scenic_Designer','asian','male','','','','Jhansi','','UP','India','India','','						Hello, I am Sanjay.','photo_upload_data/DP1.jpg',NULL),(133,'other','','Jhon','Brady','jhon@gmail.com','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',''),(135,'other','shivamsahu050993@gmail.com','Vikram ','Sethi','vikram@gmail.com','living','2018-10-12','0000-00-00',',Actor','asian','male','','','','','','','','','','','photo_upload_data/DsiplayPic2.jpg',NULL),(136,'other','','baba','bengali','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',''),(140,'artist','aceto@buffalo.edu','Melanie','Oct14Test','aceto@buffalo.edu','','0000-00-00','0000-00-00',',Choreographer,Dancer,Other','','','','','','','','','','','','','',NULL),(141,'artist','melanieaceto@yahoo.com','','','','','1973-07-26','0000-00-00','','cw','female','','','','Buffalo','NY','','United States of America','United States of America','biography_upload_data/Aceto_Shortbio_2018.docx','','photo_upload_data/20181206ph-0041-BW-web.jpg',NULL),(142,'other','','Ellis ','Wood','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',''),(143,'other','','Barry ','Blumenfeld','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',''),(144,'other','','Cherylyn','Lavagnino','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',''),(145,'other','','Jonette','','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',''),(146,'other','choreographiclineage@gmail.com','Isadora','Duncan','','deceased','1877-05-26','1927-09-14',',Choreographer,Dancer,Filmmaker','cw','female','','','','','','','','United States of America','','','',NULL),(147,'other','','Augustin','Daly','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',''),(148,'other','','Loie','Fuller','','','0000-00-00','0000-00-00','','','','','','','','','','','','','','',''),(150,'artist','mikipadh@buffalo.edu','Miki','Padhiary','mikipadh@buffalo.edu','','0000-00-00','0000-00-00',',Other','','','','','','','','','','','','','',NULL),(151,'artist','srajguru@buffalo.edu','Shreyas','Rajguru','srajguru@buffalo.edu','','1990-01-01','0000-00-00',',Choreographer,Composer','asian','male','','','','Los Angeles','CA','','United States of America','Lithuania','','Awesome','',NULL),(152,'other','','Melanie','Oct14Test','aceto@buffalo.edu','','0000-00-00','0000-00-00','','','','','','','','','','','','','','','');
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
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist_relation`
--

LOCK TABLES `artist_relation` WRITE;
/*!40000 ALTER TABLE `artist_relation` DISABLE KEYS */;
INSERT INTO `artist_relation` VALUES (66,82,72,'Saurabh-Bajoria','','Sumedh-Ambokar','sumedh0192@gmail.com','sumedhambokar.com','Studied With','2016-08-15','2017-08-18',1,0,''),(67,82,72,'Saurabh-Bajoria','','Sumedh-Ambokar','sumedh0192@gmail.com','sumedhambokar.com','Collaborated With','2016-08-15','2017-04-01',0,8,''),(68,82,78,'Saurabh-Bajoria','','Akshay-Shah','akshaybh@buffalo.edu','akshaybh.com','Studied With','2016-08-15','2017-08-18',1,0,''),(69,72,73,'Sumedh-Ambokar','','Yash-Jain','yashnavi@buffalo.edu','yashnavi.com','Studied With','2016-08-01','2017-08-18',1,1,''),(70,72,75,'Sumedh-Ambokar','','Mitali-Bhiwande','mitalivi@buffalo.edu','acsu.buffalo.edu/~mitalivi/','Collaborated With','2017-04-01','2017-08-18',0,5,''),(71,72,78,'Sumedh-Ambokar','','Akshay-Shah','akshaybh@buffalo.edu','akshaybh.com','Studied With','2009-06-06','2017-08-18',8,4,''),(72,72,78,'Sumedh-Ambokar','','Akshay-Shah','akshaybh@buffalo.edu','akshaybh.com','Collaborated With','0000-00-00','0000-00-00',5,0,''),(73,83,84,'Kaushik-Ramasubramanian','','Saurabh-Bajoria','sbajoria@buffalo.edu','','Studied With','2016-08-15','2017-08-18',1,0,''),(77,112,133,'Shivam-Sahu','','Jhon-Brady','jhon@gmail.com','','Studied With','2017-02-01','2018-01-01',0,11,''),(84,141,97,'melanie-Aceto','','Monica-Barnes','','','Studied With','1995-09-01','1997-05-01',1,8,''),(85,141,97,'melanie-Aceto','','Monica-Barnes','','','Influenced By','0000-00-00','0000-00-00',0,0,''),(86,141,142,'melanie-Aceto','','Ellis -Wood','','','Influenced By','0000-00-00','0000-00-00',0,0,''),(87,141,143,'melanie-Aceto','','Barry -Blumenfeld','','','Influenced By','0000-00-00','0000-00-00',0,0,''),(88,141,144,'melanie-Aceto','','Cherylyn-Lavagnino','','','Influenced By','0000-00-00','0000-00-00',0,0,''),(89,141,147,'-','','Augustin-Daly','','','Influenced By','0000-00-00','0000-00-00',0,0,''),(90,141,148,'-','','Loie-Fuller','','','Influenced By','0000-00-00','0000-00-00',0,0,''),(91,151,152,'Shreyas-Rajguru','','Melanie-Oct14Test','aceto@buffalo.edu','','Studied With','2006-02-01','2017-03-01',11,1,''),(92,151,152,'Shreyas-Rajguru','','Melanie-Oct14Test','aceto@buffalo.edu','','Danced For','2009-05-01','2016-03-01',0,10,''),(93,151,152,'Shreyas-Rajguru','','Melanie-Oct14Test','aceto@buffalo.edu','','Collaborated With','2013-07-01','2017-02-01',3,7,''),(94,151,152,'Shreyas-Rajguru','','Melanie-Oct14Test','aceto@buffalo.edu','','Influenced By','0000-00-00','0000-00-00',0,0,'');
/*!40000 ALTER TABLE `artist_relation` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone_appointments`
--

LOCK TABLES `phone_appointments` WRITE;
/*!40000 ALTER TABLE `phone_appointments` DISABLE KEYS */;
INSERT INTO `phone_appointments` VALUES (1,'Yash','jain','yashjain284@gmail.com','7165454395','Yash'),(2,'Akshay','Shah','akshaybh@buffalo.edu','7165454390','Gaali khaaya'),(20,'Shivam','Sahu','ssahu3@buffalo.edu','7165973085',''),(21,'Shivam','Sahu','shivamsahu050992@gmail.com','7165973085',''),(22,'Melanie','Aceto','aceto@buffalo.edu','5852010656','Please contact me during the summer.\r\nbest,\r\nMelanie'),(23,'Shivam','Sahu','shivamsahu050993@gmail.com','7165973085',''),(24,'shuchi ','xyz','shuchitr@buffalo.edu','8283937137','shuchitr@buffalo.edu'),(25,'Shivam','Sahu','shivamsahu050993@gmail.com','7165973085',''),(26,'Shivam','Sahu','shivamsahu050993@gmail.com','7165973085',''),(27,'Shailesh','Adhikari','sa32@buffalo.edu','7165973628','Hello A'),(28,'Priya','Murthy','priyamur@buffalo.edu','7165973085',''),(29,'Melanie','Aceto','melanieaceto@yahoo.com','5852010656','Please contact me on Fridays. \r\nThanks!');
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
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email_address` (`user_email_address`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` VALUES (26,'Sumedh','Ambokar','sumedh0192@gmail.com','sumedh123',615941),(27,'Yash','Jain','test@test.com','test',796976),(28,'Barath','N','barathes@buffalo.edu','barath',976657),(31,'Sumedh','Ambokar','sumedhsa@buffalo.edu','Sumedh123',530135),(33,'Shivam','Sahu','shivamsahu050992@gmail.com','sahu123',216934),(35,'James','Brown','sa32@buffalo.edu','buffalo@123',809616),(36,'Shivam ','Sahu','ssahu3@buffalo.edu','PGlYFveq56MdwCoEiCaC',267697),(37,'dhu','dghg','sdasd@hhsfnma.cim','PGlYFveq56MdwCoEiCaC',405076),(38,'Shivam','Sahu','shivamsahu050993@gmail.com','sahu123',961640),(39,'Melanie','Oct14Test','aceto@buffalo.edu','10162018',890110),(40,'melanie','Aceto','melanieaceto@yahoo.com','testpassword',775221),(41,'melanietest','acetotest','msaceto2@gmail.com','testpassword',481749),(42,'Melanie','Susan','choreographiclineage@gmail.com','testpassword',349818),(43,'amit','banerjee','rosicky210@gmail.com','mh04cj5913',249588),(44,'Miki','Padhiary','mikipadh@buffalo.edu','miki',468472),(45,'Shreyas','Rajguru','srajguru@buffalo.edu','s',174700);
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-21 19:11:28
