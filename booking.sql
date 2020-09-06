# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 8.0.19)
# Database: booking
# Generation Time: 2020-09-06 21:54:52 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table car_reservation
# ------------------------------------------------------------

CREATE TABLE `car_reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_cat_id` int NOT NULL,
  `licence_plate` varchar(50) NOT NULL,
  `car_owner` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `lot_id` int DEFAULT NULL,
  `cost` varchar(50) DEFAULT NULL,
  `event_id` varchar(50) DEFAULT NULL,
  `user` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



# Dump of table events
# ------------------------------------------------------------

CREATE TABLE `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `home` varchar(100) NOT NULL,
  `away` varchar(100) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



# Dump of table lot
# ------------------------------------------------------------

CREATE TABLE `lot` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `capacity` int NOT NULL,
  `max_time` int NOT NULL,
  `cost` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



# Dump of table teams
# ------------------------------------------------------------

CREATE TABLE `teams` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `crest` varchar(100) NOT NULL,
  `stadium` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



# Dump of table transaction
# ------------------------------------------------------------

CREATE TABLE `transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` text,
  `fullname` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `payment` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `seats` int DEFAULT NULL,
  `ref_id` varchar(100) DEFAULT NULL,
  `cost` varchar(100) DEFAULT NULL,
  `user` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



# Dump of table users
# ------------------------------------------------------------

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_type` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



# Dump of table vehicle_cat
# ------------------------------------------------------------

CREATE TABLE `vehicle_cat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  `cost` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
