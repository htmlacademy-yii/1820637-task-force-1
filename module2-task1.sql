SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `1820637_task_force_1` DEFAULT CHARACTER SET utf8 ;
USE `1820637_task_force_1` ;

CREATE TABLE IF NOT EXISTS `1820637_task_force_1`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `creation_time` DATETIME NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `email` VARCHAR(40) NOT NULL,
   PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `1820637_task_force_1`.`profiles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `file_id` VARCHAR(20) NULL,
  `download_files_url` VARCHAR(50) NULL,
  `birthday` DATETIME NOT NULL,
  `address` VARCHAR(100) NULL,
  `city_id` INT NOT NULL,
  `about` VARCHAR(200) NOT NULL,
  `email` VARCHAR(40) NOT NULL,
  `phone` INT NULL,
  `skype` VARCHAR(20) NULL,
  `other_contact` VARCHAR(20) NULL,
  `rating` INT NULL,
  `last_activity` DATETIME NOT NULL,
  `hide_contacts` TINYINT(1) NULL,
  `hide_profile` TINYINT(1) NOT NULL,
  `message` TINYINT(1) NOT NULL,
  `actions` TINYINT(1) NOT NULL,
  `reply` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `1820637_task_force_1`.`tasks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `creation_time` DATETIME NOT NULL,
  `short_description` VARCHAR(50) NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  `category_id` INT NOT NULL,
  `point` POINT NULL,
  `city_id` INT NULL,
  `expire_time` DATETIME NULL,
  `budget` INT NULL,
  `owner_id` INT NOT NULL,
  `worker_id` INT NULL,
  `status` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `1820637_task_force_1`.`files` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `path` VARCHAR(50) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `1820637_task_force_1`.`task_files` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `task_id` INT NOT NULL,
  `file_id` INT NOT NULL,
  INDEX `task_ind` (`task_id`),
  FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `1820637_task_force_1`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category` VARCHAR(20) NOT NULL,
  `icon_url` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `1820637_task_force_1`.`cities` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `city` VARCHAR(20) NOT NULL,
  `point` POINT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `1820637_task_force_1`.`replies` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `creation_time` DATETIME NOT NULL,
  `user_id` INT NOT NULL,
  `task_id` INT NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  `budjet` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `1820637_task_force_1`.`opinions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `creation_time` DATETIME NOT NULL,
  `user_id` INT NOT NULL,
  `task_id` INT NOT NULL,
  `rate` INT NULL,
  `description` VARCHAR(100) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `1820637_task_force_1`.`chat` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `sender_id` INT NOT NULL COMMENT 'Таблица чата',
  `receiver_id` INT NOT NULL,
  `message` VARCHAR(200) NOT NULL,
  `read` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `1820637_task_force_1`.`user_category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  INDEX `user_ind` (`user_id`),
  INDEX `category_ind` (`category_id`),
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_category` FOREIGN KEY (`category_id`)
        REFERENCES `categories` (`id`) ON DELETE CASCADE,
PRIMARY KEY ('id'),
UNIQUE KEY `relation_row_unique` (`user_id`, `category_id`)
)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
