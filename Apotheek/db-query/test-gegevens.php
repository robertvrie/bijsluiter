SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema AAApotheek
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema AAApotheek
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `AAApotheek` DEFAULT CHARACTER SET utf8 ;
USE `AAApotheek` ;

-- -----------------------------------------------------
-- Table `AAApotheek`.`huisartsenpost`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AAApotheek`.`huisartsenpost` ;

CREATE TABLE IF NOT EXISTS `AAApotheek`.`huisartsenpost` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AAApotheek`.`huisarts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AAApotheek`.`huisarts` ;

CREATE TABLE IF NOT EXISTS `AAApotheek`.`huisarts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tussenvoegsel` VARCHAR(50) NULL,
  `achternaam` VARCHAR(100) NOT NULL,
  `tel` INT NOT NULL,
  `bignr` INT NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `wachtwoord` VARCHAR(100) NOT NULL,
  `post` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_Huisarts_Huisartsenpost_idx` (`post` ASC),
  UNIQUE INDEX `bignr_UNIQUE` (`bignr` ASC),
  CONSTRAINT `fk_Huisarts_Huisartsenpost`
    FOREIGN KEY (`post`)
    REFERENCES `AAApotheek`.`huisartsenpost` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AAApotheek`.`apotheek`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AAApotheek`.`apotheek` ;

CREATE TABLE IF NOT EXISTS `AAApotheek`.`apotheek` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(100) NOT NULL,
  `wnplts` VARCHAR(500) NOT NULL,
  `straat` VARCHAR(100) NOT NULL,
  `hsnr` VARCHAR(10) NOT NULL,
  `postcode` VARCHAR(10) NOT NULL,
  `tel` INT NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `wachtwoord` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AAApotheek`.`patient`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AAApotheek`.`patient` ;

CREATE TABLE IF NOT EXISTS `AAApotheek`.`patient` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `vzknr` INT NOT NULL,
  `voornaam` VARCHAR(100) NOT NULL,
  `tussenvoegsel` VARCHAR(50) NULL,
  `achternaam` VARCHAR(100) NOT NULL,
  `geboortedatum` DATE NOT NULL,
  `wnplts` VARCHAR(100) NOT NULL,
  `straat` VARCHAR(100) NOT NULL,
  `hsnr` VARCHAR(10) NOT NULL,
  `postcode` VARCHAR(10) NOT NULL,
  `tel` INT NOT NULL,
  `actief` TINYINT(1) NOT NULL,
  `huisarts` INT NOT NULL,
  `apotheek` INT NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Patient_Huisarts_idx` (`huisarts` ASC),
  INDEX `fk_Patient_Apotheker_idx` (`apotheek` ASC),
  UNIQUE INDEX `vzknr_UNIQUE` (`vzknr` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  CONSTRAINT `fk_Patient_Huisarts`
    FOREIGN KEY (`huisarts`)
    REFERENCES `AAApotheek`.`huisarts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Patient_Apotheker`
    FOREIGN KEY (`apotheek`)
    REFERENCES `AAApotheek`.`apotheek` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AAApotheek`.`betaalmethode`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AAApotheek`.`betaalmethode` ;

CREATE TABLE IF NOT EXISTS `AAApotheek`.`betaalmethode` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(100) NOT NULL,
  `oms` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AAApotheek`.`orderstatus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AAApotheek`.`orderstatus` ;

CREATE TABLE IF NOT EXISTS `AAApotheek`.`orderstatus` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `oms` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AAApotheek`.`order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AAApotheek`.`order` ;

CREATE TABLE IF NOT EXISTS `AAApotheek`.`order` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `patient` INT NOT NULL,
  `bedrag` FLOAT NOT NULL,
  `btlmet` INT NULL,
  `akng` INT NOT NULL,
  `orderstatus` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Order_Patient_idx` (`patient` ASC),
  INDEX `fk_Order_Betaalmethode_idx` (`btlmet` ASC),
  INDEX `fk_Order_Orderstatus_idx` (`orderstatus` ASC),
  CONSTRAINT `fk_Order_Patient`
    FOREIGN KEY (`patient`)
    REFERENCES `AAApotheek`.`patient` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Order_Betaalmethode`
    FOREIGN KEY (`btlmet`)
    REFERENCES `AAApotheek`.`betaalmethode` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Order_Orderstatus`
    FOREIGN KEY (`orderstatus`)
    REFERENCES `AAApotheek`.`orderstatus` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AAApotheek`.`medicijnen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AAApotheek`.`medicijnen` ;

CREATE TABLE IF NOT EXISTS `AAApotheek`.`medicijnen` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(100) NOT NULL,
  `types` VARCHAR(100) NULL,
  `beschrijving` VARCHAR(500) NULL,
  `voorraad` INT NOT NULL,
  `akb` INT NOT NULL,
  `verzekerd` TINYINT(1) NOT NULL,
  `bbt` INT NOT NULL,
  `wov` DATE NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AAApotheek`.`orderregels`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AAApotheek`.`orderregels` ;

CREATE TABLE IF NOT EXISTS `AAApotheek`.`orderregels` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `order` INT NOT NULL,
  `medicijn` INT NOT NULL,
  `aantal` INT NOT NULL,
  `datum` DATE NOT NULL,
  `tijd` VARCHAR(5) NOT NULL,
  `orderActief` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`, `order`, `medicijn`),
  INDEX `fk_Orderregels_Medicijnen_idx` (`medicijn` ASC),
  CONSTRAINT `fk_Orderregels_Order`
    FOREIGN KEY (`order`)
    REFERENCES `AAApotheek`.`order` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Orderregels_Medicijnen`
    FOREIGN KEY (`medicijn`)
    REFERENCES `AAApotheek`.`medicijnen` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AAApotheek`.`bezorger`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AAApotheek`.`bezorger` ;

CREATE TABLE IF NOT EXISTS `AAApotheek`.`bezorger` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `voornaam` VARCHAR(100) NOT NULL,
  `tussenvoegsel` VARCHAR(50) NULL,
  `achternaam` VARCHAR(100) NOT NULL,
  `tel` INT NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `wachtwoord` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AAApotheek`.`admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AAApotheek`.`admin` ;

CREATE TABLE IF NOT EXISTS `AAApotheek`.`admin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `voornaam` VARCHAR(100) NOT NULL,
  `tussenvoegsel` VARCHAR(50) NULL,
  `achternaam` VARCHAR(100) NOT NULL,
  `tel` INT NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `wachtwoord` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `AAApotheek`.`huisartsenpost`
-- -----------------------------------------------------
START TRANSACTION;
USE `AAApotheek`;
INSERT INTO `AAApotheek`.`huisartsenpost` (`id`, `naam`) VALUES (1, 'Kroonhorst');
INSERT INTO `AAApotheek`.`huisartsenpost` (`id`, `naam`) VALUES (2, 'Huisartsenpost');

COMMIT;


-- -----------------------------------------------------
-- Data for table `AAApotheek`.`huisarts`
-- -----------------------------------------------------
START TRANSACTION;
USE `AAApotheek`;
INSERT INTO `AAApotheek`.`huisarts` (`id`, `tussenvoegsel`, `achternaam`, `tel`, `bignr`, `email`, `wachtwoord`, `post`) VALUES (1, 'de', 'Groot', 568, 012345678, 'groot@mail.nl', 'e8636ea013e682faf61f56ce1cb1ab5c', 1);
INSERT INTO `AAApotheek`.`huisarts` (`id`, `tussenvoegsel`, `achternaam`, `tel`, `bignr`, `email`, `wachtwoord`, `post`) VALUES (2, NULL, 'Born', 569, 876543210, 'born@mail.nl', 'e8636ea013e682faf61f56ce1cb1ab5c', 1);
INSERT INTO `AAApotheek`.`huisarts` (`id`, `tussenvoegsel`, `achternaam`, `tel`, `bignr`, `email`, `wachtwoord`, `post`) VALUES (3, NULL, 'Vreendie', 612, 012348765, 'vreendie@mail.nl', 'e8636ea013e682faf61f56ce1cb1ab5c', 2);
INSERT INTO `AAApotheek`.`huisarts` (`id`, `tussenvoegsel`, `achternaam`, `tel`, `bignr`, `email`, `wachtwoord`, `post`) VALUES (4, 'van', 'Tol', 242, 234587601, 'a.van.tol@mboutrecht.nl', 'e8636ea013e682faf61f56ce1cb1ab5c', 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `AAApotheek`.`apotheek`
-- -----------------------------------------------------
START TRANSACTION;
USE `AAApotheek`;
INSERT INTO `AAApotheek`.`apotheek` (`id`, `naam`, `wnplts`, `straat`, `hsnr`, `postcode`, `tel`, `email`, `wachtwoord`) VALUES (1, 'Benu', 'Amsterdam', 'Bijlmerplein', '544', '1102 DS', 234, 'benu@mail.nl', 'e8636ea013e682faf61f56ce1cb1ab5c');
INSERT INTO `AAApotheek`.`apotheek` (`id`, `naam`, `wnplts`, `straat`, `hsnr`, `postcode`, `tel`, `email`, `wachtwoord`) VALUES (2, 'Alphega', 'Amsterdam', 'Annie Romeinplein', '34', '1103 JL', 895, 'alphega@mail.nl', 'e8636ea013e682faf61f56ce1cb1ab5c');
INSERT INTO `AAApotheek`.`apotheek` (`id`, `naam`, `wnplts`, `straat`, `hsnr`, `postcode`, `tel`, `email`, `wachtwoord`) VALUES (3, 'Ganzenhoef', 'Amsterdam', 'Bijlmerdreef', '1169', '1103 TT', 374, 'ganzenhoef@mail.nl', 'e8636ea013e682faf61f56ce1cb1ab5c');

COMMIT;


-- -----------------------------------------------------
-- Data for table `AAApotheek`.`patient`
-- -----------------------------------------------------
START TRANSACTION;
USE `AAApotheek`;
INSERT INTO `AAApotheek`.`patient` (`id`, `vzknr`, `voornaam`, `tussenvoegsel`, `achternaam`, `geboortedatum`, `wnplts`, `straat`, `hsnr`, `postcode`, `tel`, `actief`, `huisarts`, `apotheek`, `email`) VALUES (1, 311, 'Jan', NULL, 'Peters', '1990-11-16', 'Amsterdam', 'Dreef', '11', '1123 GH', 123, true, 2, 1, 'peters@mail.nl');
INSERT INTO `AAApotheek`.`patient` (`id`, `vzknr`, `voornaam`, `tussenvoegsel`, `achternaam`, `geboortedatum`, `wnplts`, `straat`, `hsnr`, `postcode`, `tel`, `actief`, `huisarts`, `apotheek`, `email`) VALUES (2, 323, 'Jurre', NULL, 'Mouni', '1990-10-30', 'Amsterdam', 'Reigersbos', '23', '1189 IJ', 456, true, 1, 3, 'mouni@mail.nl');
INSERT INTO `AAApotheek`.`patient` (`id`, `vzknr`, `voornaam`, `tussenvoegsel`, `achternaam`, `geboortedatum`, `wnplts`, `straat`, `hsnr`, `postcode`, `tel`, `actief`, `huisarts`, `apotheek`, `email`) VALUES (3, 334, 'Micheal', 'van', 'Veen', '1980-10-22', 'Amsterdam', 'Made', '5', '1190 UJ', 789, true, 2, 3, 'veen@mail.nl');
INSERT INTO `AAApotheek`.`patient` (`id`, `vzknr`, `voornaam`, `tussenvoegsel`, `achternaam`, `geboortedatum`, `wnplts`, `straat`, `hsnr`, `postcode`, `tel`, `actief`, `huisarts`, `apotheek`, `email`) VALUES (4, 355, 'Karel', NULL, 'Verwaaij', '1978-12-08', 'Amsterdam', 'Vink', '14', '1109 AS', 900, false, 1, 2, 'verwaaij@mail.nl');
INSERT INTO `AAApotheek`.`patient` (`id`, `vzknr`, `voornaam`, `tussenvoegsel`, `achternaam`, `geboortedatum`, `wnplts`, `straat`, `hsnr`, `postcode`, `tel`, `actief`, `huisarts`, `apotheek`, `email`) VALUES (5, 412, 'Kim', NULL, 'Ketam', '1969-08-05', 'Amsterdam', 'Dreef', '34', '1123 GH', 897, false, 2, 1, 'ketam@mail.nl');
INSERT INTO `AAApotheek`.`patient` (`id`, `vzknr`, `voornaam`, `tussenvoegsel`, `achternaam`, `geboortedatum`, `wnplts`, `straat`, `hsnr`, `postcode`, `tel`, `actief`, `huisarts`, `apotheek`, `email`) VALUES (6, 423, 'Samantha', NULL, 'Sinu', '1970-01-05', 'Amsterdam', 'Zaan', '39', '1187 YU', 563, false, 3, 2, 'sinu@mail.nl');
INSERT INTO `AAApotheek`.`patient` (`id`, `vzknr`, `voornaam`, `tussenvoegsel`, `achternaam`, `geboortedatum`, `wnplts`, `straat`, `hsnr`, `postcode`, `tel`, `actief`, `huisarts`, `apotheek`, `email`) VALUES (7, 466, 'Kees', NULL, 'Kauq', '1980-03-22', 'Amsterdam', 'Doorloop', '45', '1126 CV', 566, false, 1, 1, 'kauq@mail.nl');
INSERT INTO `AAApotheek`.`patient` (`id`, `vzknr`, `voornaam`, `tussenvoegsel`, `achternaam`, `geboortedatum`, `wnplts`, `straat`, `hsnr`, `postcode`, `tel`, `actief`, `huisarts`, `apotheek`, `email`) VALUES (8, 000, 'Dave', NULL, 'Oostendorp', '1998-11-05', 'Montfoort', 'Hannie Schaftstraat', '38', '3417 CT', 000, true, 4, 1, 'daveoostendorp@live.nl');

COMMIT;


-- -----------------------------------------------------
-- Data for table `AAApotheek`.`betaalmethode`
-- -----------------------------------------------------
START TRANSACTION;
USE `AAApotheek`;
INSERT INTO `AAApotheek`.`betaalmethode` (`id`, `naam`, `oms`) VALUES (1, 'PIN', 'Achteraf betalen met pin');
INSERT INTO `AAApotheek`.`betaalmethode` (`id`, `naam`, `oms`) VALUES (2, 'Contant', 'Betaald Contant');

COMMIT;


-- -----------------------------------------------------
-- Data for table `AAApotheek`.`orderstatus`
-- -----------------------------------------------------
START TRANSACTION;
USE `AAApotheek`;
INSERT INTO `AAApotheek`.`orderstatus` (`id`, `oms`) VALUES (1, 'Actief');
INSERT INTO `AAApotheek`.`orderstatus` (`id`, `oms`) VALUES (2, 'Voltooid');
INSERT INTO `AAApotheek`.`orderstatus` (`id`, `oms`) VALUES (3, 'Inactief verklaard');

COMMIT;


-- -----------------------------------------------------
-- Data for table `AAApotheek`.`medicijnen`
-- -----------------------------------------------------
START TRANSACTION;
USE `AAApotheek`;
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (1  ,"Diclofenac",                                          "Cataflam, Voltaren",     "Werkt als ontstekingsremmende pijnstiller; NSAID",                                            100, 100, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (2  ,"Amoxicilline",                                        "Clamoxyl",               "Antibioticum",                                                                                100, 99, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (3  ,"Omeprazol",                                           "Losec-mups",             "Remt productie overvloedig maagzuur",                                                         100, 98, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (4  ,"Doxycycline",                                         "Vibramycin",             "Antibioticum",                                                                                100, 97, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (5  ,"Ibuprofen",                                           "Brufen",                 "Pijnstiller",                                                                                 100, 96, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (6  ,"Metoprolol",                                          "Selokeen-zoc",           "Bètablokker welke de bloeddruk verlaagt",                                                     100, 95, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (7  ,"Augmentin",                                           NULL,                     "Amoxicilline met enzymremmer clavulaanzuur,antiparkinsonmiddel",                              100, 94, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (8  ,"Salbutamol",                                          "Ventolin",                "Luchtwegverwijders",                                                                          100, 93, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (9  ,"Simvastatine",                                        "Zocor",                  "Cholesterolsyntheseremmer (verlaagt het cholesterol- en vetgehalte in het bloed)",            100, 92, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (10 ,"Oxazepam",                                            "Seresta",                "Kalmeringsmiddel",                                                                            100, 91, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (11 ,"Codeine",                                             NULL,                     "Actief tegen overmatig hoesten",                                                              100, 90, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (12 ,"Hydrocortison met overige middelen",                  "Daktacort",              NULL,                                                                                          100, 89, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (13 ,"Acetylsalicylzuur",                                   "Aspirine-protect",       "Pijnstiller",                                                                                 100, 88, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (14 ,"Overige emollientia en protectiva",                   NULL,                     NULL,                                                                                          100, 87, false, 2, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (15 ,"Triamcinolon",                                        NULL,                     NULL,                                                                                          100, 86, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (16 ,"Nitrofurantoine",                                     "Furadantine",            NULL,                                                                                          100, 85, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (17 ,"Fusidinezuur",                                        "Fucidin",                NULL,                                                                                          100, 84, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (18 ,"Pantoprazol",                                         "Pantozol",               NULL,                                                                                          100, 83, false, 2, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (19 ,"Temazepam",                                           "Normison",               NULL,                                                                                          100, 82, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (20 ,"Carbasalaatcalcium",                                  "Ascal-cardio",           NULL,                                                                                          100, 81, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (21 ,"Macrogol combinatiepreparaten",                       "Movicolon",              NULL,                                                                                          100, 80, false, 2, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (22 ,"Naproxen",                                            "Naprovite",              NULL,                                                                                          100, 79, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (23 ,"Hydrochloorthiazide",                                 NULL,                     NULL,                                                                                          100, 78, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (24 ,"Metformine",                                          "Glucophage",             NULL,                                                                                          100, 77, false, 2, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (25 ,"Atorvastatine",                                       "Lipitor",                NULL,                                                                                          100, 76, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (26 ,"Desloratadine",                                       "Aerius",                 NULL,                                                                                          100, 75, false, 3, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (27 ,"Kunsttranen en andere indifferente preparaten",       "Duratears",              NULL,                                                                                          100, 74, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (28 ,"Fluticason",                                          "Propionaat, Flixonase",  NULL,                                                                                          100, 73, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (29 ,"Levocetirizine",                                      "Xyzal",                  NULL,                                                                                          100, 72, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (30 ,"Hydrocortison",                                       NULL,                     NULL,                                                                                          100, 71, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (31 ,"Diazepam",                                            "Stesolid",               NULL,                                                                                          100, 70, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (32 ,"Fusidinezuur",                                        "Fucithalmic",            NULL,                                                                                          100, 69, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (33 ,"Salmeterol met andere astma/copd-middelen",           "Seretide",               NULL,                                                                                          100, 68, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (34 ,"Prednisolon",                                         "Diadreson-f",            NULL,                                                                                          100, 67, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (35 ,"Azitromycine",                                        "Zithromax",              NULL,                                                                                          100, 66, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (36 ,"Furosemide",                                          "Lasix",                  NULL,                                                                                          100, 65, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (37 ,"Claritromycine",                                      "Klacid",                 NULL,                                                                                          100, 64, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (38 ,"Mometason",                                           "Nasonex",                NULL,                                                                                          100, 63, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (39 ,"Levothyroxine",                                       "Thyrax",                 NULL,                                                                                          100, 62, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (40 ,"Paracetamol combinatiepreparaten excl psycholeptica", NULL,                     NULL,                                                                                          100, 61, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (41 ,"Oestrogeen met levonorgestrel",                       "Microgynon",             NULL,                                                                                          100, 60, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (42 ,"Amlodipine",                                          "Norvasc",                NULL,                                                                                          100, 59, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (43 ,"Tramadol",                                            "Tramagetic",             NULL,                                                                                          100, 58, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (44 ,"Fluticason",                                          "Flixotide",              NULL,                                                                                          100, 57, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (45 ,"Enalapril/enalaprilaat",                              "Renitec",                NULL,                                                                                          100, 56, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (46 ,"Ketoconazol",                                         "Nizoral",                NULL,                                                                                          100, 55, true, 2, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (47 ,"Esomeprazol",                                         "Nexium",                 NULL,                                                                                          100, 54, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (48 ,"Diclofenac combinatiepreparaten",                     "Arthrotec",              NULL,                                                                                          100, 53, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (49 ,"Acenocoumarol",                                       NULL,                     NULL,                                                                                          100, 52, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (50 ,"Chlooramfenicol",                                     "Minims chlooramfenicol", NULL,                                                                                          100, 51, true, 2, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (51 ,"Betamethason",                                        "Diprosone",              NULL,                                                                                          100, 50, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (52 ,"Miconazol",                                           "Gyno-daktarin",          NULL,                                                                                          100, 49, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (53 ,"Paroxetine",                                          "Seroxat",                NULL,                                                                                          100, 48, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (54 ,"Feneticilline",                                       "Broxil",                 NULL,                                                                                          100, 47, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (55 ,"Dexamethason met antimicrobiele middelen",            "Sofradex",               NULL,                                                                                          100, 46, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (56 ,"Formoterol met andere astma/copd-middelen",           "Symbicort",              NULL,                                                                                          100, 45, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (57 ,"Ciprofloxacine",                                      "Ciproxin",               NULL,                                                                                          100, 44, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (58 ,"Flucloxacilline",                                     "Floxapen",               NULL,                                                                                          100, 43, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (59 ,"Codeine combinatiepreparaten",                        NULL,                     NULL,                                                                                          100, 42, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (60 ,"Lactulose",                                           "Legendal",               NULL,                                                                                          100, 41, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (61 ,"Ranitidine",                                          "Zantac",                 NULL,                                                                                          100, 40, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (62 ,"Cyproteron met oestrogeen",                           "Diane-35",               NULL,                                                                                          100, 39, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (63 ,"Levocabastine",                                       "Livocab",                NULL,                                                                                          100, 38, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (64 ,"Losartan",                                            "Cozaar",                 NULL,                                                                                          100, 37, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (65 ,"Rosuvastatine",                                       "Crestor",                NULL,                                                                                          100, 36, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (66 ,"Trimethoprim",                                        "Monotrim",               NULL,                                                                                          100, 35, false, 2, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (67 ,"Atenolol",                                            "Tenormin",               NULL,                                                                                          100, 34, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (68 ,"Ferrofumaraat",                                       NULL,                     NULL,                                                                                          100, 33, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (69 ,"Bisoprolol",                                          "Emcor",                  NULL,                                                                                          100, 32, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (70 ,"Tiotropium",                                          "Spiriva",                NULL,                                                                                          100, 31, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (71 ,"Clobetasol",                                          "Dermovate",              NULL,                                                                                          100, 30, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (72 ,"Calcium met andere middelen",                         NULL,                     NULL,                                                                                          100, 29, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (73 ,"Pravastatine",                                        "Selektine",              NULL,                                                                                          100, 28, false, 3, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (74 ,"Perindopril",                                         "Coversyl",               NULL,                                                                                          100, 27, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (75 ,"Hydrocortison met antimicrobiele middelen",           "Bacicoline-b",           NULL,                                                                                          100, 26, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (76 ,"Triamcinolon",                                        "Kenacort-a",             NULL,                                                                                          100, 25, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (77 ,"Dexamethason samen met antimicrobiele middelen",      "Tobradex",               NULL,                                                                                          100, 24, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (78 ,"Nifedipine",                                          "Adalat-oros",            NULL,                                                                                          100, 23, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (79 ,"Isosorbidemononitraat",                               "Mono-cedocard",          NULL,                                                                                          100, 22, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (80 ,"Lisinopril",                                          "Zestril",                NULL,                                                                                          100, 21, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (81 ,"Metoclopramide",                                      "Primperan",              NULL,                                                                                          100, 20, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (82 ,"Psylliumzaad",                                        "Metamucil",              NULL,                                                                                          100, 19, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (83 ,"Amitriptyline",                                       "Tryptizol",              NULL,                                                                                          100, 18, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (84 ,"Loperamide",                                          "Imodium en Diacure",     "Werkt tegen diarree",                                                                         100, 17, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (85 ,"Budesonide",                                          "Rhinocort",              NULL,                                                                                          100, 16, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (86 ,"Tamsulosine",                                         "Omnic-ocas",             NULL,                                                                                          100, 15, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (87 ,"Hydrocortisonbutyraat",                               "Locoid",                 NULL,                                                                                          100, 14, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (88 ,"Metronidazol",                                        "Flagyl",                 NULL,                                                                                          100, 13, false, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (89 ,"Sulfamethoxazol met trimethoprim",                    "Bactrimel",              NULL,                                                                                          100, 12, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (90 ,"Alendroninezuur",                                     "Fosamax",                NULL,                                                                                          100, 11, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (91 ,"Meloxicam",                                           "Movicox",                NULL,                                                                                          100, 10, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (92 ,"Mebeverine",                                          "Duspatal",               NULL,                                                                                          100, 9, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (93 ,"Citalopram",                                          "Cipramil",               NULL,                                                                                          100, 8, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (94 ,"Glimepiride",                                         "Amaryl",                 NULL,                                                                                          100, 7, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (95 ,"Lidocaine",                                           NULL,                     NULL,                                                                                          100, 6, true, 3, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (96 ,"Fluconazol",                                          "Diflucan",               NULL,                                                                                          100, 5, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (97 ,"Etoricoxib",                                          "Arcoxia",                NULL,                                                                                          100, 4, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (98 ,"Norfloxacine",                                        "Noroxin",                NULL,                                                                                          100, 3, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (99 ,"Lidocaine",                                           "Xylocaine",              NULL,                                                                                          100, 2, true, 1, NULL);
insert into `AAApotheek`.`medicijnen` (`id`,`naam`,`types`,`beschrijving`,`voorraad`,`akb`,`verzekerd`, `bbt`,`wov`) values (100,"Nitroglycerine",                                      "Nitrolingual",           NULL,                                                                                          100, 1, true, 1, NULL);
COMMIT;


-- -----------------------------------------------------
-- Data for table `AAApotheek`.`bezorger`
-- -----------------------------------------------------
START TRANSACTION;
USE `AAApotheek`;
INSERT INTO `AAApotheek`.`bezorger` (`id`, `voornaam`, `tussenvoegsel`, `achternaam`, `tel`, `email`, `wachtwoord`) VALUES (1, 'Robert-Jan', NULL, 'Vrieling', 312, 'robertvrie@gmail.com', 'e8636ea013e682faf61f56ce1cb1ab5c');

COMMIT;


-- -----------------------------------------------------
-- Data for table `AAApotheek`.`admin`
-- -----------------------------------------------------
START TRANSACTION;
USE `AAApotheek`;
INSERT INTO `AAApotheek`.`admin` (`id`, `voornaam`, `tussenvoegsel`, `achternaam`, `tel`, `email`, `wachtwoord`) VALUES (1, 'Dave', NULL, 'Oostendorp', 06312, 'daveoostendorp@live.nl', 'e8636ea013e682faf61f56ce1cb1ab5c');

COMMIT;