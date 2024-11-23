-- Execute as root user
CREATE USER IF NOT EXISTS 'civicrm_user'@'localhost' IDENTIFIED BY 'civicrm_password';
CREATE DATABASE IF NOT EXISTS `civicrm_wordpress` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
GRANT ALL ON civicrm_wordpress.* TO 'civicrm_user'@'localhost';
GRANT SUPER ON *.* TO civicrm_user@localhost;
