-- MySQL Script generated by MySQL Workbench
-- Wed Mar  9 16:42:50 2022
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
  `firstname` VARCHAR(45) NULL,
  `lastname` VARCHAR(45) NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `role` ENUM('user', 'admin') NULL,
  `phone` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DonkeyStay`.`roomtype`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DonkeyStay`.`roomtype` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DonkeyStay`.`hometype`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DonkeyStay`.`hometype` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `hname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DonkeyStay`.`capacity`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DonkeyStay`.`capacity` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nb_traveler` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DonkeyStay`.`room`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DonkeyStay`.`room` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `roomtype_id` INT NOT NULL,
  `hometype_id` INT NOT NULL,
  `title` VARCHAR(80) NOT NULL,
  `description` MEDIUMTEXT NULL,
  `nb_bedroom` INT NOT NULL,
  `nb_bathroom` INT NOT NULL,
  `price` DECIMAL(6,2) NOT NULL,
  `adress` VARCHAR(200) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `has_tv` TINYINT(1) NOT NULL,
  `has_wifi` TINYINT(1) NOT NULL,
  `has_kitchen` TINYINT(1) NOT NULL,
  `has_aircon` TINYINT(1) NOT NULL,
  `start_dispo` DATE NOT NULL,
  `end_dispo` DATE NOT NULL,
  `user_id` INT NOT NULL,
  `capacity_id` INT NOT NULL,
  PRIMARY KEY (`id`, `roomtype_id`, `hometype_id`, `user_id`, `capacity_id`),
  CONSTRAINT `fk_Rooms_Roomtypes1`
    FOREIGN KEY (`roomtype_id`)
    REFERENCES `DonkeyStay`.`roomtype` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Rooms_Hometypes1`
    FOREIGN KEY (`hometype_id`)
    REFERENCES `DonkeyStay`.`hometype` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_room_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `DonkeyStay`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_room_capacity1`
    FOREIGN KEY (`capacity_id`)
    REFERENCES `DonkeyStay`.`capacity` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Rooms_Roomtypes1_idx` ON `DonkeyStay`.`room` (`roomtype_id` ASC) VISIBLE;

CREATE INDEX `fk_Rooms_Hometypes1_idx` ON `DonkeyStay`.`room` (`hometype_id` ASC) VISIBLE;

CREATE INDEX `fk_room_user1_idx` ON `DonkeyStay`.`room` (`user_id` ASC) VISIBLE;

CREATE INDEX `fk_room_capacity1_idx` ON `DonkeyStay`.`room` (`capacity_id` ASC) VISIBLE;


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
INSERT INTO `DonkeyStay`.`user` (`id`, `firstname`, `lastname`, `password`, `email`, `role`, `phone`) VALUES (2, 'Selina', 'Kyle', 'cat', 'catlover@catwoman.com', 'user', '0608080808');
INSERT INTO `DonkeyStay`.`user` (`id`, `firstname`, `lastname`, `password`, `email`, `role`, `phone`) VALUES (3, 'Harry', 'Yack', 'tipi', 'arnaque@yakari.com', 'user', '06010101010');
INSERT INTO `DonkeyStay`.`user` (`id`, `firstname`, `lastname`, `password`, `email`, `role`, `phone`) VALUES (4, 'Winnie', 'Thepooh', 'honney', 'honney@pooh.com', 'user', '0602020202');

COMMIT;


-- -----------------------------------------------------
-- Data for table `DonkeyStay`.`roomtype`
-- -----------------------------------------------------
START TRANSACTION;
USE `DonkeyStay`;
INSERT INTO `DonkeyStay`.`roomtype` (`id`, `rname`) VALUES (1, 'Entire home');
INSERT INTO `DonkeyStay`.`roomtype` (`id`, `rname`) VALUES (2, 'Private room');
INSERT INTO `DonkeyStay`.`roomtype` (`id`, `rname`) VALUES (3, 'Shared room');

COMMIT;


-- -----------------------------------------------------
-- Data for table `DonkeyStay`.`hometype`
-- -----------------------------------------------------
START TRANSACTION;
USE `DonkeyStay`;
INSERT INTO `DonkeyStay`.`hometype` (`id`, `hname`) VALUES (1, 'appartment');
INSERT INTO `DonkeyStay`.`hometype` (`id`, `hname`) VALUES (2, 'house');
INSERT INTO `DonkeyStay`.`hometype` (`id`, `hname`) VALUES (3, 'atypical');

COMMIT;


-- -----------------------------------------------------
-- Data for table `DonkeyStay`.`capacity`
-- -----------------------------------------------------
START TRANSACTION;
USE `DonkeyStay`;
INSERT INTO `DonkeyStay`.`capacity` (`id`, `nb_traveler`) VALUES (1, '1 Voyageur');
INSERT INTO `DonkeyStay`.`capacity` (`id`, `nb_traveler`) VALUES (2, '2 Voyageurs');
INSERT INTO `DonkeyStay`.`capacity` (`id`, `nb_traveler`) VALUES (3, '3 Voyageurs');
INSERT INTO `DonkeyStay`.`capacity` (`id`, `nb_traveler`) VALUES (4, '4 Voyageurs');
INSERT INTO `DonkeyStay`.`capacity` (`id`, `nb_traveler`) VALUES (5, '5 Voyageurs');
INSERT INTO `DonkeyStay`.`capacity` (`id`, `nb_traveler`) VALUES (6, '6 Voyageurs');
INSERT INTO `DonkeyStay`.`capacity` (`id`, `nb_traveler`) VALUES (7, '7  Voyageurs');
INSERT INTO `DonkeyStay`.`capacity` (`id`, `nb_traveler`) VALUES (8, '8  Voyageurs');
INSERT INTO `DonkeyStay`.`capacity` (`id`, `nb_traveler`) VALUES (9, '9 Voyageurs');
INSERT INTO `DonkeyStay`.`capacity` (`id`, `nb_traveler`) VALUES (10, '10  Voyageurs');

COMMIT;


-- -----------------------------------------------------
-- Data for table `DonkeyStay`.`room`
-- -----------------------------------------------------
START TRANSACTION;
USE `DonkeyStay`;
INSERT INTO `DonkeyStay`.`room` (`id`, `roomtype_id`, `hometype_id`, `title`, `description`, `nb_bedroom`, `nb_bathroom`, `price`, `adress`, `city`, `has_tv`, `has_wifi`, `has_kitchen`, `has_aircon`, `start_dispo`, `end_dispo`, `user_id`, `capacity_id`) VALUES (1, 1, 2, 'Le manoir Wayne', 'Mon superbe manoir', 2, 2, 150, '1007 Mountain Drive', 'Gotham City', 1, 1, 1, 1, '2022-03-07', '2022-04-07', 1, 10);
INSERT INTO `DonkeyStay`.`room` (`id`, `roomtype_id`, `hometype_id`, `title`, `description`, `nb_bedroom`, `nb_bathroom`, `price`, `adress`, `city`, `has_tv`, `has_wifi`, `has_kitchen`, `has_aircon`, `start_dispo`, `end_dispo`, `user_id`, `capacity_id`) VALUES (2, 2, 1, 'Superbe appartement en plein Centre-Ville', 'Un appartement cosy', 1, 1, 50, '20 rue somewhere 75020', 'Paris', 0, 1, 1, 0, '2022-03-14', '2022-03-31', 2, 2);
INSERT INTO `DonkeyStay`.`room` (`id`, `roomtype_id`, `hometype_id`, `title`, `description`, `nb_bedroom`, `nb_bathroom`, `price`, `adress`, `city`, `has_tv`, `has_wifi`, `has_kitchen`, `has_aircon`, `start_dispo`, `end_dispo`, `user_id`, `capacity_id`) VALUES (3, 1, 3, 'Grotte (quasi) aménagée, vue sur mer', 'Une magnifique grotte naturelle aménagée, elle ne vous laissera pas de marbre. Attention : chaussures étanches exigées !', 1, 1, 30, 'Grotte de Pair-non-Pair', 'Bordeau', 0, 0, 0, 0, '2022-03-07', '2023-03-07', 4, 6);
INSERT INTO `DonkeyStay`.`room` (`id`, `roomtype_id`, `hometype_id`, `title`, `description`, `nb_bedroom`, `nb_bathroom`, `price`, `adress`, `city`, `has_tv`, `has_wifi`, `has_kitchen`, `has_aircon`, `start_dispo`, `end_dispo`, `user_id`, `capacity_id`) VALUES (4, 1, 3, 'Une yourte de luxe dans le Larzac', 'Déja montée, plus qu\'a se poser. Le réchaud est fourni.', 1, 0, 300, 'La Plaine, 12230', 'La Cavalerie', 0, 0, 1, 0, '2022-03-20', '2022-05-20', 3, 4);

COMMIT;


-- -----------------------------------------------------
-- Data for table `DonkeyStay`.`image`
-- -----------------------------------------------------
START TRANSACTION;
USE `DonkeyStay`;
INSERT INTO `DonkeyStay`.`image` (`id`, `img`, `room_id`) VALUES (1, '/img/logements/wayneManor.jpg', 1);
INSERT INTO `DonkeyStay`.`image` (`id`, `img`, `room_id`) VALUES (2, '/img/logements/kyleAppt.png', 2);
INSERT INTO `DonkeyStay`.`image` (`id`, `img`, `room_id`) VALUES (3, '/img/logements/yackAtypical.jpg', 4);
INSERT INTO `DonkeyStay`.`image` (`id`, `img`, `room_id`) VALUES (4, '/img/logements/thepoohAtypical.jpg', 3);

COMMIT;

