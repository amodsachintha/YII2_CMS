CREATE DATABASE  IF NOT EXISTS `sachithcms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sachithcms`;
-- MySQL dump 10.13  Distrib 5.7.11, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sachithcms
-- ------------------------------------------------------
-- Server version	5.7.11

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
-- Table structure for table `api`
--

DROP TABLE IF EXISTS `api`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hits` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api`
--

LOCK TABLES `api` WRITE;
/*!40000 ALTER TABLE `api` DISABLE KEYS */;
INSERT INTO `api` VALUES (1,'641a625545bd0036b67acaf0d2fba9d6',5),(2,'4ac1a2e928c00767e2119b94ab4d71ad',66),(3,'a8da983baf8ecdf9c840407dc2bf115b',2),(4,'5bed7acfaacf1da1b27bf6c8f6ec6962',0);
/*!40000 ALTER TABLE `api` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('editor','2',1545308716),('editor','4',1545308462),('media_editor','6',1545449497),('sadmin','1',1545309531),('sadmin','5',1545395168);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('createDocument',2,'Create a Document',NULL,NULL,1545298358,1545298358),('createUser',2,'Create new User',NULL,NULL,1545298358,1545298358),('deleteDocument',2,'Update Document',NULL,NULL,1545298358,1545298358),('deleteUser',2,'Delete user details',NULL,NULL,1545298358,1545298358),('editor',1,NULL,NULL,NULL,1545298358,1545298358),('media_editor',1,'',NULL,NULL,1545298358,1545298358),('readDocument',2,'Read a Document',NULL,NULL,1545298358,1545298358),('readUser',2,'Read user details',NULL,NULL,1545298358,1545298358),('sadmin',1,NULL,NULL,NULL,1545298359,1545298359),('updateDocument',2,'Update Document',NULL,NULL,1545298358,1545298358),('updateUser',2,'Update user details',NULL,NULL,1545298358,1545298358);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('editor','createDocument'),('sadmin','createUser'),('editor','deleteDocument'),('sadmin','deleteUser'),('sadmin','editor'),('editor','readDocument'),('media_editor','readDocument'),('sadmin','readUser'),('editor','updateDocument'),('media_editor','updateDocument'),('sadmin','updateUser');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Software Development','2018-12-20 11:33:43','2018-12-21 13:21:08'),(2,'YII2','2018-12-20 11:33:56','2018-12-20 11:33:57'),(3,'Machine Learning','2018-12-20 11:34:10','2018-12-21 13:31:46'),(4,'PHP','2018-12-21 06:59:12','2018-12-21 13:22:27'),(5,'NodeJS','2018-12-21 12:29:05','2018-12-21 12:29:05'),(6,'Web Development','2018-12-21 12:29:27','2018-12-21 13:18:12'),(7,'C++','2018-12-22 05:10:38','2018-12-22 05:10:42');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-document-user_id` (`user_id`),
  KEY `idx-document-category_id` (`category_id`),
  CONSTRAINT `fk-document-category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-document-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
INSERT INTO `document` VALUES (1,1,2,'Requests','<p><strong>Requests</strong></p>\r\n<p>Requests made to an application are represented in terms of <code>yii\\web\\Request</code> objects which provide information such as request parameters, HTTP headers, cookies, etc. For a given request, you can get access to the corresponding request object via the request application component which is an instance of <code>yii\\web\\Request</code>, by default. In this section, we will describe how you can make use of this component in your applications.</p>','2018-12-20 17:24:23','2018-12-21 10:59:31'),(2,2,1,'Authorization','<p>Authorization is the process of verifying that a user has enough permission to do something. Yii provides two authorization methods: Access Control Filter (ACF) and Role-Based Access Control (RBAC).</p>\r\n<p>&nbsp;</p>\r\n<h3>Access Control Filter</h3>\r\n<p>Access Control Filter (ACF) is a simple authorization method implemented as <code>yii\\filters\\AccessControl</code> which is best used by applications that only need some simple access control. As its name indicates, ACF is an action filter that can be used in a controller or a module. While a user is requesting to execute an action, ACF will check a list of access rules to determine if the user is allowed to access the requested action.</p>\r\n<p>&nbsp;</p>\r\n<p><code>use yii\\web\\Controller;</code><br /><code>use yii\\filters\\AccessControl;</code></p>\r\n<p><code>class SiteController extends Controller{</code></p>\r\n<p><code>&nbsp; &nbsp; public function behaviors()</code></p>\r\n<p><code>&nbsp; &nbsp; {</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp;return [</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \'access\' =&gt; [</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \'class\' =&gt; AccessControl::className(),</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \'only\' =&gt; [\'login\', \'logout\', \'signup\'],</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \'rules\' =&gt; [</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; [</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \'allow\' =&gt; true,</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \'actions\' =&gt; [\'login\', \'signup\'],</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \'roles\' =&gt; [\'?\'],</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ],</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; [</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \'allow\' =&gt; true,</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \'actions\' =&gt; [\'logout\'],</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \'roles\' =&gt; [\'@\'],</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ],</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ],</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ],</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; ];</code></p>\r\n<p><code>&nbsp; &nbsp; }</code></p>\r\n<p><code>&nbsp; &nbsp; // ...</code></p>\r\n<p><code>}</code></p>','2018-12-20 17:45:22','2018-12-20 17:45:22'),(3,1,3,'What is ML?','<p><strong>Machine learning</strong> (ML) is the scientific study of algorithms and statistical models that computer systems use to progressively improve their performance on a specific task. Machine learning algorithms build a mathematical model of sample data, known as \"training data\", in order to make predictions or decisions without being explicitly programmed to perform the task.[1][2]:2 Machine learning algorithms are used in the applications of email filtering, detection of network intruders, and computer vision, where it is infeasible to develop an algorithm of specific instructions for performing the task. Machine learning is closely related to computational statistics, which focuses on making predictions using computers. The study of mathematical optimization delivers methods, theory and application domains to the field of machine learning. Data mining is a field of study within machine learning, and focuses on exploratory data analysis through unsupervised learning.[3][4] In its application across business problems, machine learning is also referred to as predictive analytics.</p>','2018-12-21 10:46:04','2018-12-21 10:59:09'),(4,1,1,'Facebook Login Overview','<p>Facebook Login is a fast and convenient way for people to create accounts and log into your app across multiple platforms. It\'s available on iOS, Android, Web, Windows Phone, desktop apps and devices such as Smart TVs and Internet of Things objects. Facebook Login enables two scenarios, authentication and asking for permissions to access people\'s data. You can use Facebook Login simply for authentication or for both authentication and data access.</p>\r\n<h4>Use Cases</h4>\r\n<p>Facebook Login is used to enable the following experiences:</p>\r\n<h5>Account Creation</h5>\r\n<p>Facebook Login lets people quickly and easily create an account in your app without having to set (and likely later forget) a password. This simple and convenient experience leads to higher conversion. Once someone has created an account on one platform, they can log into your app&mdash;often with a single click&mdash;on all your other platforms. A validated email address means you\'re able to reach that person to re-engage them at a later date.</p>\r\n<h5>Personalization</h5>\r\n<p>Personalized experiences are more engaging and lead to higher retention. Facebook Login lets you access information which would be complex or arduous to collect via your own registration form. Even just importing someone\'s profile picture imported from Facebook gives them a stronger sense of connection with your app.</p>\r\n<h5>Social</h5>\r\n<p>Many highly retentive apps let people connect with their friends in order to enable shared in-app experiences. Facebook Login lets you know which of your app\'s users are also friends on Facebook so you can build value by connecting people together.</p>\r\n<h4>Success Stories</h4>\r\n<p>Developers who have implemented Facebook Login in their apps have seen dramatic increases in the number of people logging into their apps, higher levels of engagement, and continuing increases in the number of people using Facebook Login. For details, see Success Stories.</p>\r\n<p>For example, Saavn, a digital music service, experienced 65% higher engagement from people using Facebook Login, 3 times as many shares from people using Facebook Login, and 15 times as many visitors coming from Facebook. Skyscanner, an app for finding flights, hotels, and car rentals, has experienced a 100% increase in the number of people using Facebook Login to access the app.</p>','2018-12-21 12:20:08','2018-12-21 12:20:08'),(5,5,2,'YII Widgets','<p>Widgets are reusable building blocks used in&nbsp;<a style=\"box-sizing: border-box; background-color: transparent; color: #1e6887; transition: all 0.2s ease-in-out 0s;\" href=\"https://www.yiiframework.com/doc/guide/2.0/en/structure-views\">views</a>&nbsp;to create complex and configurable user interface elements in an object-oriented fashion. For example, a date picker widget may generate a fancy date picker that allows users to pick a date as their input. All you need to do is just to insert the code in a view like the following:</p>\r\n<pre style=\"box-sizing: border-box; overflow: auto; font-family: \'Fira Mono\', monospace; font-size: 15px; padding: 10.5px; margin-top: 0px; margin-bottom: 11px; line-height: 1.4; word-break: break-all; overflow-wrap: break-word; color: #333333; border-radius: 4px;\"><code class=\"hljs php language-php\" style=\"box-sizing: border-box; font-family: \'Fira Mono\', monospace; font-size: inherit; padding: 0.5em 0.5em 0.5em 4rem; color: #000000; background: #f2f9fa; border-radius: 0px; display: block; overflow: auto; text-size-adjust: none; border-left: 5px solid #ebf1f2; overflow-wrap: normal;\"><span class=\"hljs-preprocessor\" style=\"box-sizing: border-box; color: #999999; font-weight: bold;\">&lt;?php</span>\r\n<span class=\"hljs-keyword\" style=\"box-sizing: border-box; color: #333333; font-weight: bold;\">use</span> <span class=\"hljs-title\" style=\"box-sizing: border-box; color: #990000; font-weight: bold;\">yii</span>\\<span class=\"hljs-title\" style=\"box-sizing: border-box; color: #990000; font-weight: bold;\">jui</span>\\<span class=\"hljs-title\" style=\"box-sizing: border-box; color: #990000; font-weight: bold;\">DatePicker</span>;\r\n<span class=\"hljs-preprocessor\" style=\"box-sizing: border-box; color: #999999; font-weight: bold;\">?&gt;</span>\r\n<span class=\"hljs-preprocessor\" style=\"box-sizing: border-box; color: #999999; font-weight: bold;\">&lt;?</span>= DatePicker::widget([<span class=\"hljs-string\" style=\"box-sizing: border-box; color: #dd1144;\">\'name\'</span> =&gt; <span class=\"hljs-string\" style=\"box-sizing: border-box; color: #dd1144;\">\'date\'</span>]) <span class=\"hljs-preprocessor\" style=\"box-sizing: border-box; color: #999999; font-weight: bold;\">?&gt;</span>\r\n</code></pre>\r\n<p>There are a good number of widgets bundled with Yii, such as&nbsp;<a href=\"https://www.yiiframework.com/doc/api/2.0/yii-widgets-activeform\">active form</a>,&nbsp;<a href=\"https://www.yiiframework.com/doc/api/2.0/yii-widgets-menu\">menu</a>,&nbsp;<a href=\"https://www.yiiframework.com/extension/yiisoft/yii2-jui\">jQuery UI widgets</a>,&nbsp;<a href=\"https://www.yiiframework.com/extension/yiisoft/yii2-bootstrap\">Twitter Bootstrap widgets</a>. In the following, we will introduce the basic knowledge about widgets. Please refer to the class API documentation if you want to learn about the usage of a particular widget.</p>\r\n<h2 id=\"using-widgets\" style=\"box-sizing: border-box; font-family: pt_sansregular, sans-serif; font-weight: 500; line-height: 1.1; color: #333333; margin-top: 22px; margin-bottom: 11px; font-size: 34px;\">&nbsp;</h2>','2018-12-21 12:22:32','2018-12-21 14:08:42');
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-media-document_id` (`document_id`),
  CONSTRAINT `fk-media-document_id` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (2,1,'/uploads/df98bcdbdfc0cbddedde6dc5054a41ae-isS1Qx4j_400x400.jpg','Rick Sanchez','2018-12-20 18:16:41','2018-12-20 18:16:41'),(3,1,'/uploads/8b2648866cd92326650e7ccb78a4fa3a-demo.png','OAuth test','2018-12-21 12:13:03','2018-12-21 12:13:03'),(4,4,'/uploads/ad122ac731070259f028ed011d0f8a0e-download.png','Facebook Logo','2018-12-21 12:36:38','2018-12-21 12:36:38'),(5,3,'/uploads/f79790b8309164528386365a933356b0-gpgpu.png','ML info','2018-12-21 13:26:38','2018-12-21 13:26:38'),(6,5,'/uploads/c101e9b3f77972b18750748774d0c309-IMG-20181221-WA0004.jpg','Mirissa','2018-12-21 14:02:28','2018-12-21 14:02:28');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'sachith','amod077@gmail.com','$2y$13$018s5Iu5ZjaCUIcnFpClQ.tPGjH.c1xovNTOzmFS1WXTWi23LmVle','1234','123456','2018-12-20 07:16:20','2018-12-20 07:08:51'),(2,'editor','editor@scma.com','$2y$13$mEhzJyycW0yLYD5KaAtB1ei30LIWr9rpMnBKT3vIW.hXyg60V.qjy','507bee39e7','62a98c4f4e03046ac41236d25efb46c8','2018-12-20 06:38:11','2018-12-20 06:55:16'),(4,'test','akdmin@gmail.com','$2y$13$rm9fhGpoGgAnWoMKobOU2.8RESig8SVprTqMhFXQWLPX/9WMBzPYC','94292c0149','e5b6888c28b049be49112ed2ba3332c9','2018-12-20 06:51:02','2018-12-20 06:51:02'),(5,'sadmin','sadmin@scma.com','$2y$13$bnoE9rLUEeK2rcnQ1F.HTOJ2qvN/tdxKaMqP8VNoBZ8Q9cpIfTUFG','289c37e4ae','86c453718e6877ec5083e25262a0fb29','2018-12-21 12:26:08','2018-12-21 12:26:08'),(6,'mediaeditor','mediaeditor@scma.com','$2y$13$zeTt5fCreDmgnaZPjD0CseLUprODy347HPAj/NWFMpYkjLkgeI.w6','966aa734a2','1a24e4a4166cc280be6e9917bd62e271','2018-12-22 03:31:37','2018-12-22 03:31:37');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-22 21:36:51
