-- MySQL Workbench Synchronization
-- Generated: 2015-04-19 12:59
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Adriano

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `empleo`.`candidato_empleo` 
CHANGE COLUMN `fecha _aplicacion` `fecha _aplicacion` TIMESTAMP NULL DEFAULT current_timestamp ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
