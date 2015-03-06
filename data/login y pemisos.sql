-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema empleo
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema empleo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `empleo` DEFAULT CHARACTER SET utf8 ;
USE `empleo` ;

-- -----------------------------------------------------
-- Table `empleo`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`usuario` ;

CREATE TABLE IF NOT EXISTS `empleo`.`usuario` (
  `codigo` BIGINT(20) NOT NULL,
  `nombre` VARCHAR(64) NULL DEFAULT NULL,
  `clave` VARCHAR(32) NULL DEFAULT NULL,
  `estado` TINYINT(1) NULL DEFAULT 1,
  PRIMARY KEY (`codigo`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `empleo`.`rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`rol` ;

CREATE TABLE IF NOT EXISTS `empleo`.`rol` (
  `codigo` INT(11) NOT NULL,
  `nombre` VARCHAR(64) NULL,
  `estado` TINYINT(1) NULL DEFAULT 1,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`pagina`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`pagina` ;

CREATE TABLE IF NOT EXISTS `empleo`.`pagina` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(128) NULL DEFAULT NULL,
  `pagina` VARCHAR(128) NULL DEFAULT NULL,
  `estado` INT(11) NULL DEFAULT '1',
  `menu` VARCHAR(32) NULL DEFAULT NULL,
  `padre` INT(11) NULL DEFAULT NULL,
  `codigo_padre` INT(11) NULL DEFAULT NULL,
  `orden` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `empleo`.`pagina_rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`pagina_rol` ;

CREATE TABLE IF NOT EXISTS `empleo`.`pagina_rol` (
  `codigo_pagina` INT(11) NOT NULL,
  `codigo_rol` INT(11) NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codigo_usuario` INT(11) NULL DEFAULT NULL,
  INDEX `fk_pagina_rol_rol1_idx` (`codigo_rol` ASC),
  PRIMARY KEY (`codigo_pagina`, `codigo_rol`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `empleo`.`rol_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`rol_usuario` ;

CREATE TABLE IF NOT EXISTS `empleo`.`rol_usuario` (
  `codigo_usuario` INT(11) NOT NULL,
  `codigo_rol` INT(11) NOT NULL,
  PRIMARY KEY (`codigo_usuario`, `codigo_rol`),
  INDEX `fk_rol_usuario_usuario1_idx` (`codigo_usuario` ASC),
  INDEX `fk_rol_usuario_rol1_idx` (`codigo_rol` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `empleo`.`permiso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`permiso` ;

CREATE TABLE IF NOT EXISTS `empleo`.`permiso` (
  `codigo_pagina` INT(11) NOT NULL,
  `codigo_rol` INT(11) NOT NULL,
  `descripcion` VARCHAR(32) NULL DEFAULT NULL,
  `acceso_menu` INT(11) NULL DEFAULT NULL,
  `acceso_consulta` INT(11) NULL DEFAULT NULL,
  `acceso_guardar` INT(11) NULL DEFAULT NULL,
  `acceso_actualizar` INT(11) NULL DEFAULT NULL,
  `acceso_eliminar` INT(11) NULL DEFAULT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` TINYINT(1) NULL DEFAULT '1',
  `fecha_salida` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`codigo_pagina`, `codigo_rol`),
  INDEX `fk_permiso_pagina_rol1_idx` (`codigo_pagina` ASC, `codigo_rol` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `empleo`.`candidato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`candidato` ;

CREATE TABLE IF NOT EXISTS `empleo`.`candidato` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(64) NULL,
  `apellidos` VARCHAR(64) NULL,
  `fecha_nacimiento` TIMESTAMP NULL,
  `genero` VARCHAR(1) NULL,
  `telefono` VARCHAR(32) NULL,
  `movil` VARCHAR(32) NULL,
  `codigo_direccion` BIGINT(20) NULL,
  `archivo` VARCHAR(512) NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`pais` ;

CREATE TABLE IF NOT EXISTS `empleo`.`pais` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(32) NOT NULL,
  `estado` TINYINT(1) NOT NULL,
  `codigo_regularorio` VARCHAR(8) NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`provincia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`provincia` ;

CREATE TABLE IF NOT EXISTS `empleo`.`provincia` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_pais` INT NOT NULL,
  `codigo_regulatorio` VARCHAR(8) NULL,
  `nombre` VARCHAR(32) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`),
  INDEX `fk_provincia_pais1_idx` (`codigo_pais` ASC),
  CONSTRAINT `fk_provincia_pais1`
    FOREIGN KEY (`codigo_pais`)
    REFERENCES `empleo`.`pais` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`ciudad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`ciudad` ;

CREATE TABLE IF NOT EXISTS `empleo`.`ciudad` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_provincia` INT NOT NULL,
  `codigo_regulatorio` VARCHAR(8) NULL,
  `nombre` VARCHAR(32) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT '1',
  INDEX `fk_ciudad_provincia1_idx` (`codigo_provincia` ASC),
  PRIMARY KEY (`codigo`),
  CONSTRAINT `fk_ciudad_provincia1`
    FOREIGN KEY (`codigo_provincia`)
    REFERENCES `empleo`.`provincia` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`direccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`direccion` ;

CREATE TABLE IF NOT EXISTS `empleo`.`direccion` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `calle principal` VARCHAR(64) NULL,
  `calle secundaria` VARCHAR(64) NULL,
  `nro` VARCHAR(64) NULL,
  `referencia` VARCHAR(64) NULL,
  `codigo_ciudad` INT(11) NULL,
  `codigo_candidato` INT(11) NOT NULL,
  PRIMARY KEY (`codigo`, `codigo_candidato`),
  INDEX `fk_direccion_candidato1_idx` (`codigo_candidato` ASC),
  INDEX `fk_direccion_ciudad1_idx` (`codigo_ciudad` ASC),
  CONSTRAINT `fk_direccion_candidato1`
    FOREIGN KEY (`codigo_candidato`)
    REFERENCES `empleo`.`candidato` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_direccion_ciudad1`
    FOREIGN KEY (`codigo_ciudad`)
    REFERENCES `empleo`.`ciudad` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`test`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`test` ;

CREATE TABLE IF NOT EXISTS `empleo`.`test` (
  `codigo` INT NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`institucion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`institucion` ;

CREATE TABLE IF NOT EXISTS `empleo`.`institucion` (
  `codigo` INT NOT NULL,
  `nombre` VARCHAR(64) NULL,
  `tipo` VARCHAR(32) NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`tipo_nivel_academico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`tipo_nivel_academico` ;

CREATE TABLE IF NOT EXISTS `empleo`.`tipo_nivel_academico` (
  `codigo` INT NOT NULL,
  `nombre` VARCHAR(32) NULL COMMENT 'Iidentificador  del tipo de estudio realizado por el candidato\n1.- Primaria\n2.- secundaria\n3.- universitario\n4.- postgrado\n5.- otros',
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`estudio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`estudio` ;

CREATE TABLE IF NOT EXISTS `empleo`.`estudio` (
  `codigo` INT(11) NOT NULL,
  `codigo_candidato` INT(11) NOT NULL,
  `titulo` VARCHAR(128) NULL,
  `horas` INT(11) NULL,
  `fecha_inicio` TIMESTAMP NULL,
  `fecha_fin` TIMESTAMP NULL,
  `codigo_tipo_nivel_academico` INT(11) NOT NULL,
  `codigo_institucion` INT(11) NOT NULL,
  PRIMARY KEY (`codigo`, `codigo_candidato`, `codigo_tipo_nivel_academico`, `codigo_institucion`),
  INDEX `fk_estudio_candidato1_idx` (`codigo_candidato` ASC),
  INDEX `fk_estudio_institucion1_idx` (`codigo_institucion` ASC),
  INDEX `fk_estudio_tipo_estudio1_idx` (`codigo_tipo_nivel_academico` ASC),
  CONSTRAINT `fk_estudio_candidato1`
    FOREIGN KEY (`codigo_candidato`)
    REFERENCES `empleo`.`candidato` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estudio_institucion1`
    FOREIGN KEY (`codigo_institucion`)
    REFERENCES `empleo`.`institucion` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estudio_tipo_estudio1`
    FOREIGN KEY (`codigo_tipo_nivel_academico`)
    REFERENCES `empleo`.`tipo_nivel_academico` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`experiencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`experiencia` ;

CREATE TABLE IF NOT EXISTS `empleo`.`experiencia` (
  `codigo` INT(11) NOT NULL,
  `codigo_candidato` INT(11) NOT NULL,
  `fecha_inicio` TIMESTAMP NULL,
  `fecha_fin` TIMESTAMP NULL,
  `empresa` VARCHAR(64) NULL,
  `cargo` VARCHAR(64) NULL,
  `tareas` LONGTEXT NULL,
  `nro_empleados` INT(11) NULL,
  PRIMARY KEY (`codigo`, `codigo_candidato`),
  INDEX `fk_experiencia_candidato1_idx` (`codigo_candidato` ASC),
  CONSTRAINT `fk_experiencia_candidato1`
    FOREIGN KEY (`codigo_candidato`)
    REFERENCES `empleo`.`candidato` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `empleo`.`rol`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`rol` (`codigo`, `nombre`, `estado`) VALUES (1, 'Usuario', 1);
INSERT INTO `empleo`.`rol` (`codigo`, `nombre`, `estado`) VALUES (2, 'Empresa', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`pagina`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `estado`, `menu`, `padre`, `codigo_padre`, `orden`) VALUES (1, 'Pagina Principal', 'index.php', 1, 'Administracion', 0, 0, 0);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `estado`, `menu`, `padre`, `codigo_padre`, `orden`) VALUES (2, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`pais`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`pais` (`codigo`, `nombre`, `estado`, `codigo_regularorio`) VALUES (1, 'Ecuador', 1, 'EC');

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`institucion`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`institucion` (`codigo`, `nombre`, `tipo`) VALUES (1, 'UCE', NULL);
INSERT INTO `empleo`.`institucion` (`codigo`, `nombre`, `tipo`) VALUES (2, 'EPN', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`tipo_nivel_academico`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`tipo_nivel_academico` (`codigo`, `nombre`) VALUES (1, 'Primaria');
INSERT INTO `empleo`.`tipo_nivel_academico` (`codigo`, `nombre`) VALUES (2, 'Secundaria');
INSERT INTO `empleo`.`tipo_nivel_academico` (`codigo`, `nombre`) VALUES (3, 'Universidad');
INSERT INTO `empleo`.`tipo_nivel_academico` (`codigo`, `nombre`) VALUES (4, 'Postgrado');
INSERT INTO `empleo`.`tipo_nivel_academico` (`codigo`, `nombre`) VALUES (5, 'Otro');

COMMIT;

