-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2019 at 06:09 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `choreographiclineage_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist_education`
--

CREATE TABLE `artist_education` (
  `artist_email_id` varchar(100) NOT NULL,
  `artist_profile_id` int(255) NOT NULL,
  `education_type` varchar(200) NOT NULL,
  `institution_name` varchar(200) NOT NULL,
  `major` varchar(200) NOT NULL,
  `degree` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist_education`
--

INSERT INTO `artist_education` (`artist_email_id`, `artist_profile_id`, `education_type`, `institution_name`, `major`, `degree`) VALUES
('wtuckerdance@gmail.com', 1, 'main', 'Arizona State University', 'Dance', 'BFA'),
('gus.solomonsjr@nyu.edu', 8, 'main', 'Massachusetts Institute of Technology', '', 'BFA'),
('hep.three@mac.com', 37, 'main', 'Hollins', 'Dance', 'MFA'),
('', 58, 'main', '', '', ''),
('', 58, 'other', '', '', ''),
('', 60, 'main', '', '', ''),
('', 60, 'other', '', '', ''),
('', 61, 'main', '', '', ''),
('', 61, 'other', '', '', ''),
('', 63, 'main', '', '', ''),
('', 63, 'other', '', '', ''),
('', 64, 'main', '', '', ''),
('', 64, 'other', '', '', ''),
('', 65, 'main', '', '', ''),
('', 65, 'other', '', '', ''),
('', 67, 'main', '', '', ''),
('', 67, 'other', '', '', ''),
('', 94, 'main', '', '', ''),
('', 94, 'other', '', '', ''),
('', 98, 'main', '', '', ''),
('', 98, 'other', '', '', ''),
('', 100, 'main', '', '', ''),
('', 100, 'other', '', '', ''),
('', 102, 'main', '', '', ''),
('', 102, 'other', '', '', ''),
('', 103, 'main', '', '', ''),
('', 103, 'other', '', '', ''),
('', 104, 'main', 'dssda', 'dasdad', 'dcscsdcsd'),
('', 104, 'other', '', '', ''),
('', 105, 'main', '', '', ''),
('', 105, 'other', '', '', ''),
('', 106, 'main', '', '', ''),
('', 106, 'other', '', '', ''),
('', 108, 'main', '', '', ''),
('', 108, 'other', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `artist_genres`
--

CREATE TABLE `artist_genres` (
  `artist_genre_id` int(11) NOT NULL,
  `artist_profile_id` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `artist_profile`
--

CREATE TABLE `artist_profile` (
  `artist_profile_id` int(255) NOT NULL,
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
  `STATUS` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist_profile`
--

INSERT INTO `artist_profile` (`artist_profile_id`, `is_user_artist`, `profile_name`, `artist_first_name`, `artist_last_name`, `artist_email_address`, `artist_living_status`, `artist_dob`, `artist_dod`, `artist_genre`, `artist_ethnicity`, `artist_gender`, `gender_other`, `genre_other`, `ethnicity_other`, `artist_residence_city`, `artist_residence_state`, `artist_residence_province`, `artist_residence_country`, `artist_birth_country`, `artist_biography`, `artist_biography_text`, `artist_photo_path`, `artist_website`, `STATUS`) VALUES
(1, 'artist', '', 'Whitney', 'Tucker', 'wtuckerdance@gmail.com', 'living', '1982-01-02', '0000-00-00', '', '', 'female', '', '', '', '', '', '', 'United States of America', '', '', 'Whitney Rippelmeyer-Tucker, from the hills of southern Illinois, moved to New York in 2006 to pursue a career in modern dance.  She graduated Magna Cum Laude from Arizona State University with a BFA in Dance Education.  Her interests over time have led her to study Capoeira, Contact Improvisation, various lineages of yoga, boxing, and social dance.  She draws from experiences as a public school teacher (Vancouver, WA) and from those as the creator/facilitator of a movement-program for women who were recovering from prostitution (Phoenix, AZ).  She is a member of David Dorfman Dance and Tiffany Mills Company, is a teacher-trainer at the Kane School of Core Integration,  and is completing certification as a Birth Doula.  Most-recently, she became co-founder of Studio 26, a wellness-center located in Manhattan.', '', 'www.studio26nyc.com', 0),
(2, 'other', '', 'David', 'Dorfman', 'david.dorfman@conncoll.edu', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'www.daviddorfmandance.org', 0),
(3, 'other', '', 'Jennifer', 'Tsukayama', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(4, 'other', '', 'Kathleen', 'Hermesdorf', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(5, 'other', '', 'Nita', 'Little', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(6, 'other', '', 'Tiffany', 'Mills', 'tiffany@tiffanymillscompany.org', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'www.tiffanymillscompany.org', 0),
(7, 'other', '', 'Jen', 'Polins', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'www.wiremonkeydance.com', 0),
(8, 'artist', '', 'Gus', 'Solomons Jr', 'gus.solomonsjr@nyu.edu', '', '0000-00-00', '0000-00-00', '', '', 'male', '', '', '', '', '', '', '', '', 'upload/biography_upload_data/solomonsgus.pdf', '', '', 'paradigm-nyc.org', 0),
(9, 'other', '', 'Merce', 'Cunningham', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(10, 'other', '', 'Robert', 'Cohan', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(11, 'other', '', 'Jan', 'Veem', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(12, 'other', '', 'Richard', 'Thomas', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(13, 'other', '', 'Donald', 'Mckayle', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(14, 'other', '', 'Pearl', 'Lang', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(15, 'other', '', 'Martha', 'Graham', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(16, 'other', '', 'Mio', 'Morales', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(17, 'other', '', 'Toby', 'Twining', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(18, 'other', '', 'Scott', 'DeVere', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(19, 'artist', '', 'Richard', 'Siegal', 'Richard@TheBakery.org', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'upload/biography_upload_data/richardsiegal.pdf', '', '', 'www.thebakery.org', 0),
(20, 'other', '', 'Mary', 'Anthony', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(21, 'other', '', 'Albert', 'Reid', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(22, 'other', '', 'Lenore', 'Lattimer', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(23, 'other', '', 'Aileen', 'Pasloff', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(24, 'other', '', 'Jean', 'Churchill', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(25, 'other', '', 'Jan', 'Miller', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(26, 'other', '', 'Igal', 'Perry', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(27, 'other', '', 'Zvi', 'Gotheiner', 'zgd@mindspring.com', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'www.zvidance.com', 0),
(28, 'other', '', 'Wayne', 'Byers', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(29, 'other', '', 'Janis', 'Brenner', 'Janisbren@aol.com', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'www.janisbrenner.com', 0),
(30, 'other', '', 'San Cha', 'Hong', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(31, 'other', '', 'Doug', 'Elkins', 'doug5583@aol.com', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(32, 'other', '', 'William', 'Forsythe', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(33, 'other', '', 'Bruce', 'Gremo', 'bruce.gremo@gmail.com', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'www.suddensite.net/about.html', 0),
(34, 'other', '', 'Christine', 'Peters', 'cp@hmach.com', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(35, 'other', '', 'Prue', 'Lang', 'pruex@hotmail.com', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'www.pruelang.com', 0),
(36, 'other', '', 'Hillary', 'Goidell', 'hillfish@gmail.com', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'hillg.free.fr/home.html', 0),
(37, 'artist', '', 'Helen', 'Picket', 'hep.three@mac.com', '', '1967-00-00', '0000-00-00', '', '', 'female', '', '', '', '', '', '', '', '', 'upload/biography_upload_data/helenpicket.pdf', '', '', 'www.helenpickett.com', 0),
(38, 'other', '', 'Kathryn', 'Irey', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(39, 'other', '', 'Thomas', 'DeFrantz', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(40, 'other', '', 'Larisa', 'Skylenskaya', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(41, 'other', '', 'Anatole', 'Vilsak', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(42, 'other', '', 'Nicole', 'Sowinska', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(43, 'other', '', 'Ohad', 'Naharin', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(44, 'other', '', 'Michael', 'Smuim', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(45, 'other', '', 'Saburo', 'Teshigawara', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(46, 'other', '', 'Alvin', 'Ailey', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(47, 'other', '', 'George', 'Balanchine', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(48, 'other', '', 'Pina', 'Bausch', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(49, 'other', '', 'Mats', 'Ek', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(50, 'other', '', 'Katherine', 'Dunham', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(51, 'other', '', 'Jiri', 'Kylian', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(52, 'other', '', 'Elisa', 'Monte', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0),
(99, 'other', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0),
(109, 'artist', 'yogeshja@buffalo.edu', 'Yogesh', 'Sawant', 'yogeshja@buffalo.edu', 'living', '0000-00-00', '0000-00-00', ',Actor', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 25);

-- --------------------------------------------------------

--
-- Table structure for table `artist_relation`
--

CREATE TABLE `artist_relation` (
  `relation_id` int(255) NOT NULL,
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
  `relation_identifier` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist_relation`
--

INSERT INTO `artist_relation` (`relation_id`, `artist_profile_id_1`, `artist_profile_id_2`, `artist_name_1`, `artist_email_id_1`, `artist_name_2`, `artist_email_id_2`, `artist_website_2`, `artist_relation`, `start_date`, `end_date`, `duration_years`, `duration_months`, `relation_identifier`) VALUES
(1, 1, 2, 'Whitney-Tucker', 'wtuckerdance@gmail.com', 'David-Dorfman', 'david.dorfman@conncoll.edu', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(2, 1, 3, 'Whitney-Tucker', 'wtuckerdance@gmail.com', 'Jennifer-Tsukayama', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(3, 1, 4, 'Whitney-Tucker', 'wtuckerdance@gmail.com', 'Kathleen-Hermesdorf', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(4, 1, 5, 'Whitney-Tucker', 'wtuckerdance@gmail.com', 'Nita-Little', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(5, 1, 2, 'Whitney-Tucker', 'wtuckerdance@gmail.com', 'David-Dorfman', 'david.dorfman@conncoll.edu', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(6, 1, 6, 'Whitney-Tucker', 'wtuckerdance@gmail.com', 'Tiffany-Mills', 'tiffany@tiffanymillscompany.org', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(7, 1, 7, 'Whitney-Tucker', 'wtuckerdance@gmail.com', 'Jen-Polins', '', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(8, 8, 9, 'Gus-Solomons Jr', 'gus.solomonsjr@nyu.edu', 'Merce-Cunningham', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(9, 8, 10, 'Gus-Solomons Jr', 'gus.solomonsjr@nyu.edu', 'Robert-Cohan', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(10, 8, 11, 'Gus-Solomons Jr', 'gus.solomonsjr@nyu.edu', 'Jan-Veem', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(11, 8, 12, 'Gus-Solomons Jr', 'gus.solomonsjr@nyu.edu', 'Richard-Thomas', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(12, 8, 10, 'Gus-Solomons Jr', 'gus.solomonsjr@nyu.edu', 'Merce-Cunningham', '', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(13, 8, 13, 'Gus-Solomons Jr', 'gus.solomonsjr@nyu.edu', 'Donald-Mckayle', '', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(14, 8, 14, 'Gus-Solomons Jr', 'gus.solomonsjr@nyu.edu', 'Pearl-Lang', '', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(15, 8, 15, 'Gus-Solomons Jr', 'gus.solomonsjr@nyu.edu', 'Martha-Graham', '', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(16, 8, 16, 'Gus-Solomons Jr', 'gus.solomonsjr@nyu.edu', 'Mio-Morales', '', '', 'Collaborated With', NULL, '0000-00-00', 0, 0, ''),
(17, 8, 17, 'Gus-Solomons Jr', 'gus.solomonsjr@nyu.edu', 'Toby-Twining', '', '', 'Collaborated With', NULL, '0000-00-00', 0, 0, ''),
(18, 8, 18, 'Gus-Solomons Jr', 'gus.solomonsjr@nyu.edu', 'Scott-DeVere', '', '', 'Collaborated With', NULL, '0000-00-00', 0, 0, ''),
(19, 19, 20, 'Richard-Siegal', 'Richard@TheBakery.org', 'Mary-Anthony', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(20, 19, 21, 'Richard-Siegal', 'Richard@TheBakery.org', 'Albert-Reid', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(21, 19, 22, 'Richard-Siegal', 'Richard@TheBakery.org', 'Lenore-Lattimer', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(22, 19, 23, 'Richard-Siegal', 'Richard@TheBakery.org', 'Aileen-Pasloff', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(23, 19, 24, 'Richard-Siegal', 'Richard@TheBakery.org', 'Jean-Churchill', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(24, 19, 25, 'Richard-Siegal', 'Richard@TheBakery.org', 'Jan-Miller', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(25, 19, 26, 'Richard-Siegal', 'Richard@TheBakery.org', 'Igal-Perry', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(26, 19, 27, 'Richard-Siegal', 'Richard@TheBakery.org', 'Zvi-Gotheiner', 'zgd@mindspring.com', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(27, 19, 28, 'Richard-Siegal', 'Richard@TheBakery.org', 'Wayne-Byers', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(28, 19, 26, 'Richard-Siegal', 'Richard@TheBakery.org', 'Igal-Perry', '', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(29, 19, 29, 'Richard-Siegal', 'Richard@TheBakery.org', 'Janis-Brenner', 'Janisbren@aol.com', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(30, 19, 30, 'Richard-Siegal', 'Richard@TheBakery.org', 'Sin Cha-Hong', '', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(31, 19, 31, 'Richard-Siegal', 'Richard@TheBakery.org', 'Doug-Elkins', 'doug5583@aol.com', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(32, 19, 27, 'Richard-Siegal', 'Richard@TheBakery.org', 'Zvi-Gotheiner', 'zgd@mindspring.com', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(33, 19, 32, 'Richard-Siegal', 'Richard@TheBakery.org', 'William-Forsythe', '', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(34, 19, 33, 'Richard-Siegal', 'Richard@TheBakery.org', 'Bruce-Gremo', 'bruce.gremo@gmail.com', '', 'Collaborated With', NULL, '0000-00-00', 0, 0, ''),
(35, 19, 34, 'Richard-Siegal', 'Richard@TheBakery.org', 'Christine-Peters', 'cp@hmach.com', '', 'Collaborated With', NULL, '0000-00-00', 0, 0, ''),
(36, 19, 35, 'Richard-Siegal', 'Richard@TheBakery.org', 'Prue-Lang', 'pruex@hotmail.com', '', 'Collaborated With', NULL, '0000-00-00', 0, 0, ''),
(37, 19, 36, 'Richard-Siegal', 'Richard@TheBakery.org', 'Hillary-Goidell', 'hillfish@gmail.com', '', 'Collaborated With', NULL, '0000-00-00', 0, 0, ''),
(38, 37, 32, 'Helen-Picket', 'hep.three@mac.com', 'William-Forsythe', '', '', '', NULL, '0000-00-00', 0, 0, ''),
(39, 37, 38, 'Helen-Picket', 'hep.three@mac.com', 'Kathryn-Irey', '', '', '', NULL, '0000-00-00', 0, 0, ''),
(40, 37, 39, 'Helen-Picket', 'hep.three@mac.com', 'Thomas-DeFrantz', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(41, 37, 40, 'Helen-Picket', 'hep.three@mac.com', 'Larisa-Skylenskaya', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(42, 37, 41, 'Helen-Picket', 'hep.three@mac.com', 'Anatole-Vilsak', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(43, 37, 42, 'Helen-Picket', 'hep.three@mac.com', 'Nicole-Sowinska', '', '', 'Studied With', NULL, '0000-00-00', 0, 0, ''),
(44, 37, 32, 'Helen-Picket', 'hep.three@mac.com', 'William-Forsythe', '', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(45, 37, 43, 'Helen-Picket', 'hep.three@mac.com', 'Ohad-Naharin', '', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(46, 37, 44, 'Helen-Picket', 'hep.three@mac.com', 'Michael-Smuim', '', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(47, 37, 45, 'Helen-Picket', 'hep.three@mac.com', 'Saburo-Teshigawara', '', '', 'Danced For', NULL, '0000-00-00', 0, 0, ''),
(48, 37, 46, 'Helen-Picket', 'hep.three@mac.com', 'Alvin-Ailey', '', '', 'Influenced By', NULL, '0000-00-00', 0, 0, ''),
(49, 37, 47, 'Helen-Picket', 'hep.three@mac.com', 'George-Balanchine', '', '', 'Influenced By', NULL, '0000-00-00', 0, 0, ''),
(50, 37, 48, 'Helen-Picket', 'hep.three@mac.com', 'Pina-Bausch', '', '', 'Influenced By', NULL, '0000-00-00', 0, 0, ''),
(51, 37, 49, 'Helen-Picket', 'hep.three@mac.com', 'Mats-Ek', '', '', 'Influenced By', NULL, '0000-00-00', 0, 0, ''),
(52, 37, 50, 'Helen-Picket', 'hep.three@mac.com', 'Katherine-Dunham', '', '', 'Influenced By', NULL, '0000-00-00', 0, 0, ''),
(53, 37, 51, 'Helen-Picket', 'hep.three@mac.com', 'Jiri-Kylian', '', '', 'Influenced By', NULL, '0000-00-00', 0, 0, ''),
(54, 37, 52, 'Helen-Picket', 'hep.three@mac.com', 'Elisa-Monte', '', '', 'Influenced By', NULL, '0000-00-00', 0, 0, ''),
(55, 58, 59, 'Yogesh-Sawant', '', '-', '', '', 'Danced For', '0000-00-00', '0000-00-00', 0, 12, ''),
(56, 60, 59, 'Yogesh-Sawant', '', '-', '', '', 'Danced For', '0000-00-00', '0000-00-00', 0, 12, ''),
(57, 63, 59, 'Yogesh-Sawant', '', '-', '', '', 'Danced For', '0000-00-00', '0000-00-00', 0, 12, ''),
(58, 98, 99, 'Yogesh-Sawant', '', '-', '', '', 'Danced For', '0000-00-00', '0000-00-00', 0, 12, '');

-- --------------------------------------------------------

--
-- Table structure for table `artist_works`
--

CREATE TABLE `artist_works` (
  `artist_works_id` int(11) NOT NULL,
  `artist_profile_id` int(11) DEFAULT NULL,
  `work_id` int(11) DEFAULT NULL,
  `involvement` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `genre_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phone_appointments`
--

CREATE TABLE `phone_appointments` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `note` varchar(300) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Undone',
  `Submitted_Date` varchar(100) NOT NULL DEFAULT '04/01/2019'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `user_id` int(255) NOT NULL,
  `user_first_name` varchar(100) NOT NULL,
  `user_last_name` varchar(100) NOT NULL,
  `user_email_address` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_one_time_password` int(255) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`user_id`, `user_first_name`, `user_last_name`, `user_email_address`, `user_password`, `user_one_time_password`, `user_type`) VALUES
(1, 'Miki', 'Padhiary', 'mikipadh@buffalo.edu', 'miki', 0, 'User'),
(2, 'Shreyas', 'Rajguru', 'srajguru@buffalo.edu', 'shreyas', 0, 'User'),
(3, 'Amit', 'Banerjee', 'amitbane@buffalo.edu', 'amit', 0, 'User'),
(4, 'Yogesh', 'Sawant', 'yogeshja@buffalo.edu', 'yogesh', 0, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `work_id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist_genres`
--
ALTER TABLE `artist_genres`
  ADD PRIMARY KEY (`artist_genre_id`);

--
-- Indexes for table `artist_profile`
--
ALTER TABLE `artist_profile`
  ADD PRIMARY KEY (`artist_profile_id`);

--
-- Indexes for table `artist_relation`
--
ALTER TABLE `artist_relation`
  ADD PRIMARY KEY (`relation_id`),
  ADD UNIQUE KEY `relation_identifier` (`artist_profile_id_1`,`artist_profile_id_2`,`artist_relation`);

--
-- Indexes for table `artist_works`
--
ALTER TABLE `artist_works`
  ADD PRIMARY KEY (`artist_works_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `phone_appointments`
--
ALTER TABLE `phone_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email_address` (`user_email_address`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`work_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist_genres`
--
ALTER TABLE `artist_genres`
  MODIFY `artist_genre_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artist_profile`
--
ALTER TABLE `artist_profile`
  MODIFY `artist_profile_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `artist_relation`
--
ALTER TABLE `artist_relation`
  MODIFY `relation_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `artist_works`
--
ALTER TABLE `artist_works`
  MODIFY `artist_works_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_appointments`
--
ALTER TABLE `phone_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
