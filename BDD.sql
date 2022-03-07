-- MySQL Script generated by MySQL Workbench
-- Mon Mar  7 16:19:44 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema DonkeyStay
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema DonkeyStay
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DonkeyStay` DEFAULT CHARACTER SET utf8 ;
USE `DonkeyStay` ;

-- -----------------------------------------------------
-- Table `DonkeyStay`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DonkeyStay`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `role` ENUM('user', 'admin') NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DonkeyStay`.`roomtype`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DonkeyStay`.`roomtype` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DonkeyStay`.`hometype`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DonkeyStay`.`hometype` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DonkeyStay`.`room`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DonkeyStay`.`room` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `roomtype_id` INT NOT NULL,
  `hometype_id` INT NOT NULL,
  `description` MEDIUMTEXT NULL,
  `capacity` INT NOT NULL,
  `nb_bedroom` INT NOT NULL,
  `nb_bathroom` INT NOT NULL,
  `price` DECIMAL(6,2) NOT NULL,
  `adress` VARCHAR(200) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `has_tv` TINYINT NOT NULL,
  `has_wifi` TINYINT NOT NULL,
  `has_kitchen` TINYINT NOT NULL,
  `has_aircon` TINYINT NOT NULL,
  PRIMARY KEY (`id`, `roomtype_id`, `hometype_id`),
  CONSTRAINT `fk_Rooms_Roomtypes1`
    FOREIGN KEY (`roomtype_id`)
    REFERENCES `DonkeyStay`.`roomtype` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Rooms_Hometypes1`
    FOREIGN KEY (`hometype_id`)
    REFERENCES `DonkeyStay`.`hometype` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Rooms_Roomtypes1_idx` ON `DonkeyStay`.`room` (`roomtype_id` ASC) VISIBLE;

CREATE INDEX `fk_Rooms_Hometypes1_idx` ON `DonkeyStay`.`room` (`hometype_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `DonkeyStay`.`booking`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DonkeyStay`.`booking` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `room_id` INT NOT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  `nb_person` INT NOT NULL,
  `total_price` INT NOT NULL,
  `booking_date` DATETIME NOT NULL,
  `create_date` DATETIME NOT NULL,
  `update_date` DATETIME NOT NULL,
  PRIMARY KEY (`id`, `user_id`, `room_id`),
  CONSTRAINT `fk_Bookings_Users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `DonkeyStay`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Bookings_Rooms1`
    FOREIGN KEY (`room_id`)
    REFERENCES `DonkeyStay`.`room` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Bookings_Users1_idx` ON `DonkeyStay`.`booking` (`user_id` ASC) VISIBLE;

CREATE INDEX `fk_Bookings_Rooms1_idx` ON `DonkeyStay`.`booking` (`room_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `DonkeyStay`.`image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DonkeyStay`.`image` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `img` VARCHAR(200) NOT NULL,
  `room_id` INT NOT NULL,
  PRIMARY KEY (`id`, `room_id`),
  CONSTRAINT `fk_Images_Rooms1`
    FOREIGN KEY (`room_id`)
    REFERENCES `DonkeyStay`.`room` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Images_Rooms1_idx` ON `DonkeyStay`.`image` (`room_id` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `DonkeyStay`.`user`
-- -----------------------------------------------------
START TRANSACTION;
USE `DonkeyStay`;
INSERT INTO `DonkeyStay`.`user` (`id`, `firstname`, `lastname`, `password`, `email`, `role`, `phone`) VALUES (1, 'Bruce', 'Wayne', 'bat', 'darknight@batman.com', 'user', '0609090909');

COMMIT;


-- -----------------------------------------------------
-- Data for table `DonkeyStay`.`roomtype`
-- -----------------------------------------------------
START TRANSACTION;
USE `DonkeyStay`;
INSERT INTO `DonkeyStay`.`roomtype` (`id`, `name`) VALUES (1, 'Entire home');
INSERT INTO `DonkeyStay`.`roomtype` (`id`, `name`) VALUES (2, 'Private room');
INSERT INTO `DonkeyStay`.`roomtype` (`id`, `name`) VALUES (3, 'Shared room');

COMMIT;


-- -----------------------------------------------------
-- Data for table `DonkeyStay`.`hometype`
-- -----------------------------------------------------
START TRANSACTION;
USE `DonkeyStay`;
INSERT INTO `DonkeyStay`.`hometype` (`id`, `name`) VALUES (1, 'appartment');
INSERT INTO `DonkeyStay`.`hometype` (`id`, `name`) VALUES (2, 'house');
INSERT INTO `DonkeyStay`.`hometype` (`id`, `name`) VALUES (3, 'atypical');

COMMIT;


-- -----------------------------------------------------
-- Data for table `DonkeyStay`.`room`
-- -----------------------------------------------------
START TRANSACTION;
USE `DonkeyStay`;
INSERT INTO `DonkeyStay`.`room` (`id`, `roomtype_id`, `hometype_id`, `description`, `capacity`, `nb_bedroom`, `nb_bathroom`, `price`, `adress`, `city`, `has_tv`, `has_wifi`, `has_kitchen`, `has_aircon`) VALUES (1, 1, 2, 'mon super manoir', 4, 2, 2, 150, '1007 Mountain Drive', 'Gotham City', DEFAULT, DEFAULT, DEFAULT, DEFAULT);

COMMIT;

