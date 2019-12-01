-- MySQL dump 10.13  Distrib 5.6.45, for Linux (x86_64)
--
-- Host: localhost    Database: predictb_database
-- ------------------------------------------------------
-- Server version	5.6.45

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
-- Table structure for table `allcommentary`
--

DROP TABLE IF EXISTS `allcommentary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `allcommentary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `myclub` varchar(100) NOT NULL DEFAULT 'barcelona',
  `opponentclub` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allcommentary`
--

LOCK TABLES `allcommentary` WRITE;
/*!40000 ALTER TABLE `allcommentary` DISABLE KEYS */;
INSERT INTO `allcommentary` (`id`, `myclub`, `opponentclub`, `comment`, `date`, `time`, `day`) VALUES (1,'barcelona','Espanyol','Match have started','30/03/19','03:19:33 pm','Sat'),(2,'barcelona','Espanyol','Barcelona vs Espanyol is on going','30/03/19','03:20:20 pm','Sat'),(3,'barcelona','Espanyol','5 minutes into the game','30/03/19','03:20:58 pm','Sat'),(4,'barcelona','Espanyol','24 minutes into the match','30/03/19','03:39:59 pm','Sat'),(5,'barcelona','Espanyol','Half time no goal','30/03/19','04:53:46 pm','Sat'),(6,'barcelona','Villarreal','The match is currently on','02/04/19','08:11:33 pm','Tue'),(7,'barcelona','Villarreal','Coutinho have scored a goal','02/04/19','08:12:02 pm','Tue'),(8,'barcelona','Villarreal','Malcolm added another goal','02/04/19','08:12:19 pm','Tue'),(9,'barcelona','Villarreal','There is 80% chance that Barcelona will win this match','02/04/19','08:13:37 pm','Tue'),(10,'barcelona','Villarreal','Gonzalez have receive a red card','02/04/19','09:18:35 pm','Tue'),(11,'barcelona','Villarreal','Messi scores at the last minute','02/04/19','09:22:17 pm','Tue'),(12,'barcelona','Villarreal','Luiz Suarez scores a goal','02/04/19','09:24:57 pm','Tue');
/*!40000 ALTER TABLE `allcommentary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alllivechat`
--

DROP TABLE IF EXISTS `alllivechat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alllivechat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `myclub` varchar(100) NOT NULL DEFAULT 'barcelona',
  `opponentclub` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alllivechat`
--

LOCK TABLES `alllivechat` WRITE;
/*!40000 ALTER TABLE `alllivechat` DISABLE KEYS */;
INSERT INTO `alllivechat` (`id`, `name`, `myclub`, `opponentclub`, `email`, `username`, `message`, `date`, `time`, `day`, `ip`) VALUES (1,'muhammad aliyu','barcelona','Espanyol','nafsun11@gmail.com','nafsun','This match will be great','30/03/19','02:08:00 am','Sat','105.112.68.207'),(2,'muhammad aliyu','barcelona','Espanyol','nafsun11@gmail.com','nafsun','Of course','30/03/19','02:08:16 am','Sat','105.112.68.207'),(3,'muhammad aliyu','barcelona','Espanyol','nafsun11@gmail.com','nafsun','I think the end score will be 4 - 1','30/03/19','02:08:51 am','Sat','105.112.68.207'),(4,'muhammad aliyu','barcelona','Espanyol','nafsun11@gmail.com','nafsun','I don\'t think of that','30/03/19','02:22:26 am','Sat','105.112.68.207'),(5,'muhammad aliyu','barcelona','Espanyol','nafsun11@gmail.com','nafsun','I think the end score will be 2 - 1','30/03/19','02:25:20 am','Sat','105.112.10.75'),(6,'chiweuba joachim ebuka','barcelona','Espanyol','chiweubaj@gmail.com','joachim007','4-0 in my opinion ','30/03/19','06:49:58 am','Sat','197.210.54.162'),(7,'muhammad aliyu','barcelona','Espanyol','nafsun11@gmail.com','nafsun','We will see, after the match','30/03/19','09:27:21 am','Sat','105.112.10.75'),(8,'khalid suleiman','barcelona','Espanyol','planetofstories8@gmail.com','khalid','All right then','30/03/19','10:50:46 am','Sat','105.112.10.75'),(9,'muhammad aliyu','barcelona','Espanyol','nafsun11@gmail.com','nafsun','How far about the match','30/03/19','03:40:25 pm','Sat','105.112.36.108'),(10,'muhammad aliyu','barcelona','Espanyol','nafsun11@gmail.com','nafsun','My guy we go win this match','30/03/19','03:40:45 pm','Sat','105.112.36.108'),(11,'muhammad aliyu','barcelona','Villarreal','nafsun11@gmail.com','nafsun','Hello everyone','02/04/19','04:29:20 pm','Tue','105.112.34.216'),(12,'muhammad aliyu','barcelona','Villarreal','nafsun11@gmail.com','nafsun','Hi what do you think will be the end result','02/04/19','04:29:39 pm','Tue','105.112.34.216');
/*!40000 ALTER TABLE `alllivechat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `allpredict`
--

DROP TABLE IF EXISTS `allpredict`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `allpredict` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `myclub` varchar(100) NOT NULL DEFAULT 'barcelona',
  `opponentclub` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `scores` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allpredict`
--

LOCK TABLES `allpredict` WRITE;
/*!40000 ALTER TABLE `allpredict` DISABLE KEYS */;
INSERT INTO `allpredict` (`id`, `name`, `myclub`, `opponentclub`, `email`, `username`, `scores`, `date`, `time`, `day`, `ip`) VALUES (1,'chiweuba joachim ebuka','barcelona','Espanyol','chiweubaj@gmail.com','joachim007','4-0','30/03/19','06:48:26 am','Sat','197.210.226.71'),(2,'muhammad aliyu','barcelona','Espanyol','nafsun11@gmail.com','nafsun','2-1','30/03/19','09:30:31 am','Sat','105.112.36.13'),(3,'khalid suleiman','barcelona','Espanyol','planetofstories8@gmail.com','khalid','3-2','30/03/19','10:51:05 am','Sat','105.112.10.75'),(4,'muhammad aliyu','barcelona','Villarreal','nafsun11@gmail.com','nafsun','2-0','02/04/19','04:30:29 pm','Tue','105.112.36.13'),(5,'sarvesh tavasalkar','barcelona','Villarreal','sarveshtavasalkar11@gmail.com','sarveshkt3','3-1','02/04/19','05:41:40 pm','Tue','103.234.242.240');
/*!40000 ALTER TABLE `allpredict` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barcelonamatches`
--

DROP TABLE IF EXISTS `barcelonamatches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barcelonamatches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club` varchar(100) NOT NULL DEFAULT 'barcelona',
  `opponentclub` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barcelonamatches`
--

LOCK TABLES `barcelonamatches` WRITE;
/*!40000 ALTER TABLE `barcelonamatches` DISABLE KEYS */;
INSERT INTO `barcelonamatches` (`id`, `club`, `opponentclub`, `date`, `time`, `day`) VALUES (1,'barcelona','espanyol','30th March, 2019','4:15 pm','saturday'),(2,'barcelona','getafe cf','2nd April, 2019','7:30 pm','tuesday'),(3,'barcelona','atletico madrid','6th April, 2019','7:45 pm','saturday'),(4,'barcelona','manchester united','10th April, 2019','8:00 pm','wednesday'),(5,'barcelona','huesca','13th April, 2019','3:15 pm','saturday'),(6,'barcelona','manchester united','16th April, 2019','8:00 pm','tuesday'),(7,'barcelona','real sociedad','20th April, 2019','7:45 pm','saturday'),(8,'barcelona','alaves','23rd April, 2019','8:30 pm','tuesday'),(9,'barcelona','levante','27th April, 2019','7:45 pm','saturday'),(10,'barcelona','liverpool','1st May, 2019','8:00 pm','wednesday');
/*!40000 ALTER TABLE `barcelonamatches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barcelonapages`
--

DROP TABLE IF EXISTS `barcelonapages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barcelonapages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageurl` varchar(100) NOT NULL,
  `titleofpage` varchar(100) NOT NULL,
  `keywordofpage` varchar(100) NOT NULL,
  `descriptionofpage` varchar(100) NOT NULL,
  `h1title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `video` varchar(100) NOT NULL,
  `titleofcontent` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  `newstype` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barcelonapages`
--

LOCK TABLES `barcelonapages` WRITE;
/*!40000 ALTER TABLE `barcelonapages` DISABLE KEYS */;
INSERT INTO `barcelonapages` (`id`, `pageurl`, `titleofpage`, `keywordofpage`, `descriptionofpage`, `h1title`, `image`, `video`, `titleofcontent`, `content`, `date`, `time`, `day`, `newstype`) VALUES (1,'barcelona-planning-to-buy-matthijs-de-ligt','FC Barcelona plan to pay â‚¬60 million for Matthijs De Ligt','Barcelona, 60 million, pay, Matthijs','FC Barcelona have just made an offer of â‚¬60 million for Ajax centre-back Matthijs De Ligt.','MATTHIJS DE LIGT TRANSFER NEWS','matthijs.jpg','','Barcelona have just made an offer of â‚¬60 million for Ajax centre-back Matthijs De Ligt','FC Barcelona have just made an offer of â‚¬60 million for Ajax centre-back Matthijs De Ligt in which Ajax where demanding â‚¬70 million. It is also reported that Barcelona have placed a five year contract for the Ajax player. It is important to note that the hard work and dedication of the player have recently help his team to defeat Real Madrid from the Champions league','11/04/19','05:04:07 pm','Thu','transfer news'),(2,'barcelona-could-sell-coutinho','Barcelona could sell Coutinho at â‚¬80 million','Barcelona, could, sell, coutinho, 80 million','Barcelona could sell Coutinho at â‚¬80 million due to poor performance.','COUTINHO TRANSFER NEWS','coutinho.jpg','','Barcelona could sell Coutinho at â‚¬80 million','Coutinho is increasely struggling at Barcelona. However, he is not interested in living the club too soon due to the fact that he want to turn his situation around. Although selling Coutinho in his current form will bring a huge lost to the club, Barcelona is currently ready to listen to offers for Coutinho and so far no club have made any move for the player. On the other hand, since Coutinho is not interested in moving back to premiere league, Ligue 1 will be the best place to be (PSG)','11/04/19','05:03:27 pm','Thu','transfer news'),(3,'barcelona-are-prepared-for-messi-retirement','Barcelona are prepared for Messi Retirement','Messi, retirement, prepared, barcelona, president','Barcelona are prepared for Messi retirement said Barcelona President.','MESSI RETIREMENT','messi.jpg','','Barcelona are prepared for Messi retirement','During an interview with BBC Sport, Barcelona president Bartomeu said that the club is currently preparing for Messi\'s retirement.\r\nHe said: \"I know that one day â€‹Messi will stop playing, I hope it will be four or five years from now, but we have to prepare the club for the future.\r\n\r\n\"That is why we have been bringing young talent to â€‹Barcelona - â€‹Dembele, [Philippe] Coutinho and Frenkie de Jong. We have to continue this period of excellency and success.\r\n\r\n\"Being president of Barcelona really is an honour. One of the best parts of Barca is when you help young players from our youth academy, or when we go visit other players to bring them to Barcelona.\r\n\r\n\"Recently, in the case of Frenkie de Jong, when I thought that there was a possibility that Frenkie would not move to Barcelona, I decided to take a plane and talk with him and with his family, to try and explain to them the things that Barcelona can offer them. \r\n\r\n\r\n\"For him, in the next 12 or 14 years of his life, he will be at our club, in our city, and that is a decision that players must take when they join our club. They will change their life forever.\r\n\r\n\"My mandate ends in two seasons and I want to prepare the club for the future, to leave the club with many more followers, much more income and many more projects, so that the team remains a competitive team\"','11/04/19','05:02:57 pm','Thu','latest barcelona news'),(4,'what-alena-said-about-lionel-messi','What Alena said about Lionel Messi','Alena, said, messi, about','What Alena said about Lionel Messi being the best footballer in the world.','ALENA TALKS ABOUT MESSI','alena.jpg','','What Alena said about Lionel Messi','My words have run out for Messi and I have only worked closely with him for a year. He has left me without adjectives. He\'s No. 1, there are no comparisons. They have all finished. There are no more Ballon d\'Ors, nor is he the fifth best in the world. People think it\'s a joke but it\'s reality. He\'s the best and he has been for 12 years. He has broken all the records. There are great players, but there won\'t be any more like him. All that\'s left to know is how many more years he\'ll be at this level','11/04/19','05:02:26 pm','Thu','latest barcelona news'),(5,'umtiti-will-definitely-leave-barcelona','Umtiti will definitely leave Barcelona','umtiti, leave, barcelona','Umtiti will definitely leave Barcelona for Manchester United.','UMTITI TRANSFER TO MAN UNITED','umtiti.jpg','','Umtiti will definitely leave Barcelona','Barcelona are ready to sell the French world cup winner at a fee ranging from â‚¬70 million to â‚¬90 million. After leaving Lyon to join Barcelona in order to replace mascherano on the central defence, due to his injury, he has currently being placed as third choice after Gerard Pique and Clement Lenglet. Umtiti is currently seen by Barcelona as an opportunity to fund the transfer of Matthijs de Ligt who is playing for Ajax','11/04/19','05:01:38 pm','Thu','transfer news'),(6,'griezmann-in-deep-regrets-for-not-joining-barcelona','Griezmann in deep regret for not joining Barcelona','Griezmann, regret, not, joining, Barcelona','Griezmann in deep regret for not joining Barcelona when he had the chance.','GRIEZMANN TRANSFER NEWS','griezmann.jpg','','Griezmann in deep regret for not joining Barcelona','The France world cup winner, Antoine Griezmann is currently regretting his decision of turning down Barcelona offer in the summer and is desperately hoping to secure a move to Camp Nou at the end of the season. Griezmann who not long ago extend his contract with Atletico till 2023 is now deeply regretting his decision. Now that Atletico Madrid is out of the champions league and could even end up finishing the season without a single trophy as Barcelona is currently 10 point above the club in the Spanish league','11/04/19','05:01:08 pm','Thu','transfer news'),(7,'only-messi-can-score-a-panenka-free-kick','Only Messi can score a panenka free kick ','messi, score, panenka, free, kick, against, espanyol','What Ernesto Valverde said about Messi panenka free kick.','MESSI PANENKA FREE KICK','messi.jpg','','Only Messi can score a panenka free kick','After scoring a double against Espanyol, Messi led Barcelona step closer to the La liga trophy. Valverde said \"I had no idea what he was going to do\"','11/04/19','05:00:37 pm','Thu','latest barcelona news'),(9,'barcelona-no-longer-want-griezmann','Barcelona no longer want Griezmann','Barcelona, no, longer, wants, griezmann','What former Barcelona president said about Griezmann chance of joining Barcelona. ','GRIEZMANN BARCELONA TRANSFER','griezmann.jpg','','Barcelona no longer want Griezmann','In 2018, the France striker have a chance to join Barcelona but choose to remain in Atletico Madrid. Former Barcelona president Joan Laporta said: The France man is no longer welcome by Barcelona supporters at Camp Nou. The fans no longer need Griezmann on their side.','13/04/19','06:33:47 pm','Sat','transfer news'),(10,'messi-will-win-the-ballon-dor-said-rivaldo','Messi will win the ballon dor - Rivaldo','Messi, will, win, the, ballon, dor, said, rivaldo','Messi will win the ballon dor said Rivaldo.','MESSI BALLON DOR WINNER','lionel-messi.jpg','','Messi will win the ballon dor - Rivaldo','Messi who has help his team to secure the laliga title and also reach the copa dey rel final against Valencia deserves to win the ballon dor regardless of whether he won the champions league or not said Rivaldo. Rivaldo said Its impossible to describe Messi, I like him so much and I always say I feel so sad because he never won the World Cup withÂ Argentina, It is an award he deserves because a world class player like him must be a world champion.','19/04/19','11:21:37 am','Fri','latest barcelona news');
/*!40000 ALTER TABLE `barcelonapages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barcelonascores`
--

DROP TABLE IF EXISTS `barcelonascores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barcelonascores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club` varchar(100) NOT NULL DEFAULT 'barcelona',
  `opponentclub` varchar(100) NOT NULL,
  `scores` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barcelonascores`
--

LOCK TABLES `barcelonascores` WRITE;
/*!40000 ALTER TABLE `barcelonascores` DISABLE KEYS */;
INSERT INTO `barcelonascores` (`id`, `club`, `opponentclub`, `scores`, `date`, `time`, `day`) VALUES (1,'barcelona','Real Betis','4-1','17/03/19','06:41:00 am','Wed'),(2,'barcelona','Espanyol','2-0','30/03/19','06:19:05 pm','Sat'),(3,'barcelona','Villarreal','4-4','02/04/19','10:29:26 pm','Tue'),(4,'barcelona','Manchester United','1-0','10/04/19','08:24:51 am','Wed'),(5,'barcelona','Huesca','0-0','13/04/19','06:58:33 pm','Sat'),(6,'barcelona','Manchester United','3-0','16/04/19','12:09:19 am','Wed'),(7,'barcelona','Real Sociedad','2-1','20/04/19','09:03:25 am','Sun'),(8,'barcelona','Alaves','2-0','23/04/19','09:07:32 am','Tue'),(9,'barcelona','Levante','1-0','28/04/19','03:50:02 pm','Sun');
/*!40000 ALTER TABLE `barcelonascores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barcelonasquad`
--

DROP TABLE IF EXISTS `barcelonasquad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barcelonasquad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(100) NOT NULL,
  `playername` varchar(100) NOT NULL,
  `playerbio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barcelonasquad`
--

LOCK TABLES `barcelonasquad` WRITE;
/*!40000 ALTER TABLE `barcelonasquad` DISABLE KEYS */;
INSERT INTO `barcelonasquad` (`id`, `image`, `playername`, `playerbio`) VALUES (1,'ter-stegen.jpg','Marc-Andre ter Stegen','He was born on 30th April 1992. He is a German goalkeeper. He joined Barcelona for &euro;12 million in 2014.'),(2,'jordi-alba.jpg','Jordi Alba','He was born on 21th March, 1989. He is a Spanish player. He started his football career at Barcelona, but was released after being deemed too small. He joined Cornella, after which he move to Valencia and in 2012, he moves back to Barcelona.');
/*!40000 ALTER TABLE `barcelonasquad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentary`
--

DROP TABLE IF EXISTS `commentary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `myclub` varchar(100) NOT NULL DEFAULT 'barcelona',
  `opponentclub` varchar(100) NOT NULL DEFAULT 'barcelona',
  `comment` text NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentary`
--

LOCK TABLES `commentary` WRITE;
/*!40000 ALTER TABLE `commentary` DISABLE KEYS */;
/*!40000 ALTER TABLE `commentary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livechat`
--

DROP TABLE IF EXISTS `livechat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livechat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `myclub` varchar(100) NOT NULL DEFAULT 'barcelona',
  `opponentclub` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livechat`
--

LOCK TABLES `livechat` WRITE;
/*!40000 ALTER TABLE `livechat` DISABLE KEYS */;
/*!40000 ALTER TABLE `livechat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginpredictor`
--

DROP TABLE IF EXISTS `loginpredictor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loginpredictor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginpredictor`
--

LOCK TABLES `loginpredictor` WRITE;
/*!40000 ALTER TABLE `loginpredictor` DISABLE KEYS */;
INSERT INTO `loginpredictor` (`id`, `username`, `password`) VALUES (1,'nafsun','2600'),(2,'ahmad','1234'),(3,'mickky','nagatomo'),(4,'legacymiracle','09064008841'),(5,'tonykedi','baresi1990'),(6,'fadilan','malcom'),(7,'brawn@','mbboniface'),(8,'smark','1088023'),(9,'fm8','mycousin'),(10,'abbotyy','0000abbey'),(11,'jules ','daniella'),(12,'abdul','445566'),(13,'joachim007','007joachim'),(14,'blackpanther','1472580369ba'),(15,'olayinkababs','grace'),(16,'elsulaim','nakowa'),(17,'mico','125483'),(18,'kwesi201','koomson20'),(19,'obinnabarca11','messi10'),(20,'cjoe','08141daniel'),(21,'preciouslight','chinenye064'),(22,'hamza','2600'),(23,'khalid','1234'),(24,'simon','simon12345'),(25,'kayode2001','emmanuel310501'),(26,'sarveshkt3','sarveshkt'),(27,'abdulyoung99@gmail.com','08142180198'),(28,'hardeyneyran asuni ','kwellsfargo'),(29,'onyearmy20','08035018682'),(30,'adamuadejakusko','70237223'),(31,'victory junior','icui4cu'),(32,'m fifa','mskidyy29'),(33,'thanee','cls15mbb00313'),(34,'awolesi44','dayo2222'),(35,'shuajo1','eniola'),(36,'oku','oku2000'),(37,'girl','071279s');
/*!40000 ALTER TABLE `loginpredictor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `verify` varchar(100) NOT NULL DEFAULT '0',
  `hash` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter`
--

LOCK TABLES `newsletter` WRITE;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
INSERT INTO `newsletter` (`id`, `email`, `verify`, `hash`) VALUES (1,'nafsun11@gmail.com','1','c7e1249ffc03eb9ded908c236bd1996d'),(2,'terence83@mteen.net','1','8e296a067a37563370ded05f5a3bf3ec'),(3,'naijasp@gmail.com','2','7f39f8317fbdb1988ef4c628eba02591'),(4,'bailey45@mteen.net','1','3ef815416f775098fe977004015c6193'),(5,'trey_rosenbaum@mteen.net','1','93db85ed909c13838ff95ccfa94cebd9'),(6,'naijasp@gmail.com','1','54229abfcfa5649e7003b83dd4755294'),(7,'aliyumoha.ma@gmail.com','1','e369853df766fa44e1ed0ff613f563bd'),(8,'cash@gmail.com','0','ad61ab143223efbc24c7d2583be69251'),(9,'gbengamicheal52@gmail.com','0','c20ad4d76fe97759aa27a0c99bff6710'),(10,'','0','b6d767d2f8ed5d21a44b0e5886680cb9'),(11,'legacymiracle@gmail.com','0','3ef815416f775098fe977004015c6193'),(12,'fadipesunday20@gmail.com','0','c16a5320fa475530d9583c34fd356ef5'),(13,'kodibernard200@gmail.com','0','6364d3f0f495b6ab9dcf8d3b5c6e0b01'),(14,'u.halilu7@gmail.com','0','735b90b4568125ed6c3f678819b6e058'),(15,'imoroabdulhakim@mail.co','0','67c6a1e7ce56d3d6fa748ab6d9af3fd7'),(16,'mbengbrawnboniface1994@gmail.com','0','14bfa6bb14875e45bba028a21ed38046'),(17,'hilaryfualefeh421@gmail.com','0','1c383cd30b7c298ab50293adfecb7b18'),(18,'581088','0','19ca14e7ea6328a42e0eb13d585e4c22'),(19,'akawaarasmose@gmail.com','0','b6d767d2f8ed5d21a44b0e5886680cb9'),(20,'adeboy94992@gmail.com','0','44f683a84163b3523afe57c2e008bc8c'),(21,'femiolorunsuyi8@gmail.com','0','9bf31c7ff062936a96d3c8bd1f8f2ff3'),(22,'wahabwasii22@gmail.com','0','9f61408e3afb633e50cdf1b20de6f466'),(23,'wahabwasii22@gmail.com','0','54229abfcfa5649e7003b83dd4755294'),(24,'rilwanuzakiru@gmail.com','0','a3f390d88e4c41f2747bfa2f1b5f87db'),(25,'kajlaaryaman772244@gmail.com','0','fbd7939d674997cdb4692d34de8633c4'),(26,'julestchoupou1999@gmail.com','0','c16a5320fa475530d9583c34fd356ef5'),(27,'abdulhamida104@gmail.com','0','c7e1249ffc03eb9ded908c236bd1996d'),(28,'abdulhamida104@gmail.com','0','812b4ba287f5ee0bc9d43bbf5bbe87fb'),(29,'Timothyaramide2@gmail.com','0','6c8349cc7260ae62e3b1396831a8398f'),(30,'ekundayo5500@gmail','0','a1d0c6e83f027327d8461063f4ac58a6'),(31,'ekundayo5500@gmail.com','0','7f39f8317fbdb1988ef4c628eba02591'),(32,'agboolahalik108@gmail.com','0','7cbbc409ec990f19c78c75bd1e06f215'),(33,'chiweubaj@gmail.com','1','6c8349cc7260ae62e3b1396831a8398f'),(34,'oladokool@gmail.com','1','3295c76acbf4caaed33c36b1b5fc2cb1'),(35,'danielcjoe@gmail.com','0','17e62166fc8586dfa4d1bc0e1742c08b'),(36,'aminuyussif4@gmail.com','0','f899139df5e1059396431415e770c6dd'),(37,'ashrubasit@gmail.com','1','fbd7939d674997cdb4692d34de8633c4'),(38,'boamahisaac024@gmail.com','0','6c8349cc7260ae62e3b1396831a8398f'),(39,'oladokool@gmail.com','1','26657d5ff9020d2abefe558796b99584'),(40,'www.adamtauheed29@gmail.com','0','3416a75f4cea9109507cacd8e2f2aefc'),(41,'louischimaobi28@gmail.com','0','3295c76acbf4caaed33c36b1b5fc2cb1'),(42,'contactsirajok@gmail.com','0','a5bfc9e07964f8dddeb95fc584cd965d'),(43,'sulaimanabubakar787@gmail.com','0','7f39f8317fbdb1988ef4c628eba02591'),(44,'michaelsunday7292@gmail.com','1','72b32a1f754ba1c09b3695e0cb6cde7f'),(45,'adoyik398@gmail.com','0','67c6a1e7ce56d3d6fa748ab6d9af3fd7'),(46,'dreamisaac101@gmail.com','0','92cc227532d17e56e07902b254dfad10'),(47,'danielcjoe9@gmail.com','0','fc490ca45c00b1249bbe3554a4fdf6fb'),(48,'preciouslight064@gmail.com','0','d9d4f495e875a2e075a1a4a6e1b9770f'),(49,'naijagsp@gmail.com','0','c7e1249ffc03eb9ded908c236bd1996d'),(50,'planetofstories8@gmail.com','1','26657d5ff9020d2abefe558796b99584'),(51,'danielcjoe9@gmail.com','0','9a1158154dfa42caddbd0694a4e9bdc8'),(52,'sulymanishaq@gmail.com','1','98dce83da57b0395e163467c9dae521b'),(53,'sulymanarq09@gmail.com','0','d9d4f495e875a2e075a1a4a6e1b9770f'),(54,'abioladamlare@gmail.com','0','7f39f8317fbdb1988ef4c628eba02591'),(55,'olasupoemmanuel2001@gmail.com','0','a3f390d88e4c41f2747bfa2f1b5f87db'),(56,'sarveshtavasalkar11@gmail.com','1','6364d3f0f495b6ab9dcf8d3b5c6e0b01'),(57,'abdulyoungstar99@gmail.com','0','ac627ab1ccbdb62ec96e702f07f6425b'),(58,'reneemartell56@gmail.com','0','e2ef524fbf3d9fe611d5a8e90fefdc9c'),(59,'ugochukwuude@gmail.com','0','c16a5320fa475530d9583c34fd356ef5'),(60,'adamubabajiade@gmail.com','0','19ca14e7ea6328a42e0eb13d585e4c22'),(61,'victorymichael223@gmail.com','1','ad61ab143223efbc24c7d2583be69251'),(62,'naseermisbahu001@gmail.com','0','c7e1249ffc03eb9ded908c236bd1996d'),(63,'saniyakubusulaiman@gmail.com','1','28dd2c7955ce926456240b2ff0100bde'),(64,'ekundayoawolesi3@gmail.com','0','2a38a4a9316c49e5a833517c45d31070'),(65,'','0','26657d5ff9020d2abefe558796b99584'),(66,'oku 2000','0','9778d5d219c5080b9a6a17bef029331c'),(67,'nt1shinga@gmail.com','1','72b32a1f754ba1c09b3695e0cb6cde7f'),(68,'test@mail.com','0','37693cfc748049e45d87b8c7d8b9aacd');
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `predict`
--

DROP TABLE IF EXISTS `predict`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `predict` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `myclub` varchar(100) NOT NULL DEFAULT 'barcelona',
  `opponentclub` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `scores` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `predict`
--

LOCK TABLES `predict` WRITE;
/*!40000 ALTER TABLE `predict` DISABLE KEYS */;
/*!40000 ALTER TABLE `predict` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `predictbarcaupdates`
--

DROP TABLE IF EXISTS `predictbarcaupdates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `predictbarcaupdates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `predictbarcaupdates`
--

LOCK TABLES `predictbarcaupdates` WRITE;
/*!40000 ALTER TABLE `predictbarcaupdates` DISABLE KEYS */;
INSERT INTO `predictbarcaupdates` (`id`, `content`) VALUES (1,'We are a new platform, we just launch our website on 19th March, 2019.');
/*!40000 ALTER TABLE `predictbarcaupdates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registerpredictor`
--

DROP TABLE IF EXISTS `registerpredictor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registerpredictor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phonenumber` varchar(100) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `age` varchar(3) DEFAULT NULL,
  `hobby` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `localgovt` varchar(100) DEFAULT NULL,
  `bankaccountname` varchar(100) DEFAULT NULL,
  `bankaccountno` varchar(100) DEFAULT NULL,
  `bankname` varchar(100) DEFAULT NULL,
  `activation` varchar(100) DEFAULT '0',
  `hash` varchar(100) DEFAULT NULL,
  `woncount` varchar(100) NOT NULL DEFAULT '0',
  `dateofreg` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registerpredictor`
--

LOCK TABLES `registerpredictor` WRITE;
/*!40000 ALTER TABLE `registerpredictor` DISABLE KEYS */;
INSERT INTO `registerpredictor` (`id`, `fullname`, `email`, `username`, `phonenumber`, `gender`, `age`, `hobby`, `country`, `state`, `localgovt`, `bankaccountname`, `bankaccountno`, `bankname`, `activation`, `hash`, `woncount`, `dateofreg`, `ip`) VALUES (1,'muhammad aliyu','nafsun11@gmail.com','nafsun','07088172088','Male','19','Programming','Nigeria','Kano','Gwale','Muhammad Aliyu Mustapha','0005119574','Unity Bank','1','c7e1249ffc03eb9ded908c236bd1996d','0','20/03/19','105.112.36.13'),(2,'ahmad salisu','naijasp@gmail.com','ahmad',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','54229abfcfa5649e7003b83dd4755294','0','20/03/19','105.112.32.105'),(3,'gbenga micheal ','gbengamicheal52@gmail.com','mickky',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','c20ad4d76fe97759aa27a0c99bff6710','0','21/03/19','105.112.37.78'),(4,'ikegwuonu miracle ikechukwu','legacymiracle@gmail.com','legacymiracle',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','3ef815416f775098fe977004015c6193','0','21/03/19','41.203.78.223'),(5,'fadipe sunday','fadipesunday20@gmail.com','tonykedi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','c16a5320fa475530d9583c34fd356ef5','0','21/03/19','105.112.42.8'),(6,'imoro abdul hakim ','imoroabdulhakim@mail.co','fadilan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','67c6a1e7ce56d3d6fa748ab6d9af3fd7','0','21/03/19','154.160.30.191'),(7,'boniface ','mbengbrawnboniface1994@gmail.com','brawn@',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','14bfa6bb14875e45bba028a21ed38046','0','21/03/19','129.0.204.23'),(8,'brandy','581088','smark',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','19ca14e7ea6328a42e0eb13d585e4c22','0','21/03/19','129.0.78.194'),(9,'femi olorunsuyi ','femiolorunsuyi8@gmail.com','fm8',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','9bf31c7ff062936a96d3c8bd1f8f2ff3','0','22/03/19','105.112.96.59'),(10,'wahab wasiu','wahabwasii22@gmail.com','abbotyy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','54229abfcfa5649e7003b83dd4755294','0','23/03/19','129.205.113.143'),(11,'tchoupou','julestchoupou1999@gmail.com','jules ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','c16a5320fa475530d9583c34fd356ef5','0','23/03/19','41.202.207.10'),(12,'abdulhid','abdulhamida104@gmail.com','abdul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','812b4ba287f5ee0bc9d43bbf5bbe87fb','0','24/03/19','105.112.75.40'),(13,'chiweuba joachim ebuka','chiweubaj@gmail.com','joachim007','07035709732','Male','25','Play football','Nigeria','Enugu','Ezeagu','Chiweuba Joachim Ebuka','2088181992','UBA bank','1','6c8349cc7260ae62e3b1396831a8398f','0','24/03/19','197.210.226.71'),(14,'ashiru basit','ashrubasit@gmail.com','blackpanther',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','fbd7939d674997cdb4692d34de8633c4','0','24/03/19','41.203.78.232'),(15,'olayinka babalola','oladokool@gmail.com','olayinkababs',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','26657d5ff9020d2abefe558796b99584','0','24/03/19','129.205.113.149'),(16,'sulaiman abubakat','sulaimanabubakar787@gmail.com','elsulaim',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','7f39f8317fbdb1988ef4c628eba02591','0','25/03/19','41.203.72.188'),(17,'michael sunday','michaelsunday7292@gmail.com','mico',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','72b32a1f754ba1c09b3695e0cb6cde7f','0','25/03/19','41.203.72.191'),(18,'innocent ','adoyik398@gmail.com','kwesi201',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','67c6a1e7ce56d3d6fa748ab6d9af3fd7','0','25/03/19','41.203.72.196'),(19,'okolo obinna isaac ','dreamisaac101@gmail.com','obinnabarca11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','92cc227532d17e56e07902b254dfad10','0','25/03/19','41.203.78.245'),(20,'daniel joe','danielcjoe9@gmail.com','cjoe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','fc490ca45c00b1249bbe3554a4fdf6fb','0','25/03/19','41.203.72.196'),(21,'emenike chinenyenwa','preciouslight064@gmail.com','preciouslight',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','d9d4f495e875a2e075a1a4a6e1b9770f','0','27/03/19','41.203.72.198'),(22,'hamza sani','naijagsp@gmail.com','hamza',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','c7e1249ffc03eb9ded908c236bd1996d','0','30/03/19','105.112.10.75'),(23,'khalid suleiman','planetofstories8@gmail.com','khalid',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','26657d5ff9020d2abefe558796b99584','0','30/03/19','105.112.10.75'),(24,'simon joe','danielcjoe9@gmail.com','simon',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','9a1158154dfa42caddbd0694a4e9bdc8','0','30/03/19','41.203.72.204'),(25,'olasupo emmanuel ','olasupoemmanuel2001@gmail.com','kayode2001',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','a3f390d88e4c41f2747bfa2f1b5f87db','0','02/04/19','41.203.78.52'),(26,'sarvesh tavasalkar','sarveshtavasalkar11@gmail.com','sarveshkt3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','6364d3f0f495b6ab9dcf8d3b5c6e0b01','0','02/04/19','103.234.242.240'),(27,'abdullahi musa','abdulyoungstar99@gmail.com','abdulyoung99@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','ac627ab1ccbdb62ec96e702f07f6425b','0','02/04/19','197.210.226.146'),(28,'kenny wellsfargo ','reneemartell56@gmail.com','hardeyneyran asuni ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','e2ef524fbf3d9fe611d5a8e90fefdc9c','0','02/04/19','41.203.78.57'),(29,'ude ugochukwu ','ugochukwuude@gmail.com','onyearmy20',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','c16a5320fa475530d9583c34fd356ef5','0','02/04/19','41.203.78.49'),(30,'adamubabajiade','adamubabajiade@gmail.com','adamuadejakusko',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','19ca14e7ea6328a42e0eb13d585e4c22','0','02/04/19','197.210.226.120'),(31,'victory michael','victorymichael223@gmail.com','victory junior','','Male','','','','','','','','','1','ad61ab143223efbc24c7d2583be69251','0','03/04/19','197.210.227.131'),(32,'misbahu muhammad nasiru ','naseermisbahu001@gmail.com','m fifa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','c7e1249ffc03eb9ded908c236bd1996d','0','04/04/19','129.205.112.43'),(33,'sani yakubu sulaiman','saniyakubusulaiman@gmail.com','thanee',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','28dd2c7955ce926456240b2ff0100bde','0','05/04/19','41.190.14.112'),(34,'awolesi ekundayo','ekundayoawolesi3@gmail.com','awolesi44',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2a38a4a9316c49e5a833517c45d31070','0','05/04/19','41.203.78.54'),(35,'','','shuajo1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','26657d5ff9020d2abefe558796b99584','0','09/04/19','129.205.112.56'),(36,'oku','oku 2000','oku',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','9778d5d219c5080b9a6a17bef029331c','0','19/04/19','105.112.44.82'),(37,'nonduduzo','nt1shinga@gmail.com','girl',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','72b32a1f754ba1c09b3695e0cb6cde7f','0','26/07/19','41.115.76.238');
/*!40000 ALTER TABLE `registerpredictor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `todaysmatch`
--

DROP TABLE IF EXISTS `todaysmatch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `todaysmatch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clubimage` varchar(100) NOT NULL DEFAULT 'barcelona.jpg',
  `opponentclubimage` varchar(100) NOT NULL,
  `clubname` varchar(100) NOT NULL DEFAULT 'barcelona',
  `opponentclubname` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  `valid` varchar(100) DEFAULT NULL,
  `started` varchar(2) NOT NULL DEFAULT '0',
  `myclubscore` varchar(100) NOT NULL DEFAULT '0',
  `opponentclubscore` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `todaysmatch`
--

LOCK TABLES `todaysmatch` WRITE;
/*!40000 ALTER TABLE `todaysmatch` DISABLE KEYS */;
/*!40000 ALTER TABLE `todaysmatch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `whoscores`
--

DROP TABLE IF EXISTS `whoscores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whoscores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `who` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `whoscores`
--

LOCK TABLES `whoscores` WRITE;
/*!40000 ALTER TABLE `whoscores` DISABLE KEYS */;
/*!40000 ALTER TABLE `whoscores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `won`
--

DROP TABLE IF EXISTS `won`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `won` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(100) NOT NULL DEFAULT 'barcelona.jpg',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `myclub` varchar(100) NOT NULL DEFAULT 'barcelona',
  `opponentclub` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `won`
--

LOCK TABLES `won` WRITE;
/*!40000 ALTER TABLE `won` DISABLE KEYS */;
/*!40000 ALTER TABLE `won` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'predictb_database'
--

--
-- Dumping routines for database 'predictb_database'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-01 13:14:49
