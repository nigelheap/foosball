/*
SQLyog Ultimate v10.2 
MySQL - 5.5.24-0ubuntu0.12.04.1 : Database - foosball_primary
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `fb_game` */

DROP TABLE IF EXISTS `fb_game`;

CREATE TABLE `fb_game` (
  `g_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `g_time` datetime DEFAULT NULL,
  `g_player1` int(10) unsigned DEFAULT NULL,
  `g_score1` tinyint(2) unsigned DEFAULT NULL,
  `g_player2` int(10) unsigned DEFAULT NULL,
  `g_score2` tinyint(2) unsigned DEFAULT NULL,
  `g_points` float(5,2) DEFAULT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `fb_game` */

/*Table structure for table `fb_player` */

DROP TABLE IF EXISTS `fb_player`;

CREATE TABLE `fb_player` (
  `p_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `p_firstname` varchar(255) DEFAULT NULL,
  `p_lastname` varchar(255) DEFAULT NULL,
  `p_email` varchar(255) DEFAULT NULL,
  `p_password` varchar(255) DEFAULT NULL,
  `p_points` float(6,2) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `fb_player` */

insert  into `fb_player`(`p_id`,`p_firstname`,`p_lastname`,`p_email`,`p_password`,`p_points`) values (1,'Jude','Aakjaer','santouras@gmail.com','dfs',500.00);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
