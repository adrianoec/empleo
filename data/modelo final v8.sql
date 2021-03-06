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
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(64) NULL DEFAULT NULL,
  `clave` VARCHAR(32) NULL DEFAULT NULL,
  `email` VARCHAR(64) NULL,
  `estado` INT(11) NULL DEFAULT 1,
  PRIMARY KEY (`codigo`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `empleo`.`rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`rol` ;

CREATE TABLE IF NOT EXISTS `empleo`.`rol` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(64) NULL,
  `estado` INT(11) NULL DEFAULT 1,
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
  `menu` VARCHAR(32) NULL DEFAULT NULL,
  `padre` INT(11) NULL DEFAULT NULL,
  `codigo_padre` INT(11) NULL DEFAULT NULL,
  `orden` INT(11) NULL DEFAULT NULL,
  `estado` INT(11) NULL DEFAULT 1,
  PRIMARY KEY (`codigo`),
  INDEX `idxpagina` USING BTREE (`padre` ASC))
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
  `codigo_usuario` INT(11) NULL,
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
  `estado` INT(11) NULL DEFAULT 1,
  `fecha_salida` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`codigo_pagina`, `codigo_rol`),
  INDEX `fk_permiso_pagina_rol1_idx` (`codigo_pagina` ASC, `codigo_rol` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `empleo`.`grupo_etnico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`grupo_etnico` ;

CREATE TABLE IF NOT EXISTS `empleo`.`grupo_etnico` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(64) NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`disponibilidad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`disponibilidad` ;

CREATE TABLE IF NOT EXISTS `empleo`.`disponibilidad` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`codigo`),
  INDEX `idxdispinibilidad` (`codigo` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`candidato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`candidato` ;

CREATE TABLE IF NOT EXISTS `empleo`.`candidato` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(64) NULL,
  `apellidos` VARCHAR(64) NULL,
  `cedula` VARCHAR(16) NULL,
  `fecha_nacimiento` TIMESTAMP NULL,
  `genero` VARCHAR(1) NULL,
  `telefono` VARCHAR(32) NULL,
  `movil` VARCHAR(32) NULL,
  `archivo` VARCHAR(512) NULL,
  `grupo_etnico` INT(11) NOT NULL,
  `disponibilidad` INT(11) NOT NULL,
  `foto` VARCHAR(512) NULL,
  `estado` INT(11) NULL DEFAULT 1,
  `usuario` INT(11) NULL,
  PRIMARY KEY (`codigo`, `disponibilidad`, `grupo_etnico`),
  INDEX `fk_candidato_grupo_etnico1_idx` (`grupo_etnico` ASC),
  INDEX `fk_candidato_disponibilidad1_idx` (`disponibilidad` ASC),
  CONSTRAINT `fk_candidato_grupo_etnico1`
    FOREIGN KEY (`grupo_etnico`)
    REFERENCES `empleo`.`grupo_etnico` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_candidato_disponibilidad1`
    FOREIGN KEY (`disponibilidad`)
    REFERENCES `empleo`.`disponibilidad` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`pais` ;

CREATE TABLE IF NOT EXISTS `empleo`.`pais` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(32) NOT NULL,
  `codigo_regularorio` VARCHAR(8) NULL,
  `estado` INT(11) NOT NULL DEFAULT 1,
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
  `estado` INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codigo`, `codigo_pais`),
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
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `codigo_provincia` INT(11) NOT NULL,
  `codigo_regulatorio` VARCHAR(8) NULL,
  `nombre` VARCHAR(32) NOT NULL,
  `estado` INT(11) NOT NULL DEFAULT 1,
  INDEX `fk_ciudad_provincia1_idx` (`codigo_provincia` ASC),
  PRIMARY KEY (`codigo`, `codigo_provincia`),
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
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `calle_principal` VARCHAR(64) NULL,
  `calle_secundaria` VARCHAR(64) NULL,
  `nro` VARCHAR(64) NULL,
  `referencia` VARCHAR(64) NULL,
  `codigo_ciudad` INT(11) NOT NULL,
  `codigo_candidato` INT(11) NOT NULL,
  `estado` INT(11) NULL DEFAULT 1,
  PRIMARY KEY (`codigo`, `codigo_candidato`, `codigo_ciudad`),
  INDEX `fk_direccion_candidato1_idx` USING BTREE (`codigo_candidato` ASC),
  INDEX `fk_direccion_ciudad1_idx` USING BTREE (`codigo_ciudad` ASC),
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
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(64) NULL,
  `tipo` VARCHAR(32) NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`tipo_nivel_academico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`tipo_nivel_academico` ;

CREATE TABLE IF NOT EXISTS `empleo`.`tipo_nivel_academico` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(32) NULL COMMENT 'Iidentificador  del tipo de estudio realizado por el candidato\n1.- Primaria\n2.- secundaria\n3.- universitario\n4.- postgrado\n5.- otros',
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`estudio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`estudio` ;

CREATE TABLE IF NOT EXISTS `empleo`.`estudio` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `codigo_candidato` INT(11) NOT NULL,
  `titulo` VARCHAR(128) NULL,
  `horas` INT(11) NULL,
  `fecha_inicio` TIMESTAMP NULL,
  `fecha_fin` TIMESTAMP NULL,
  `codigo_tipo_nivel_academico` INT(11) NOT NULL,
  `codigo_institucion` INT(11) NOT NULL,
  `estado` INT(11) NULL DEFAULT 1,
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
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `codigo_candidato` INT(11) NOT NULL,
  `fecha_inicio` TIMESTAMP NULL,
  `fecha_fin` TIMESTAMP NULL,
  `empresa` VARCHAR(64) NULL,
  `cargo` VARCHAR(64) NULL,
  `tareas` LONGTEXT NULL,
  `nro_empleados` INT(11) NULL,
  `estado` INT(11) NULL DEFAULT 1,
  PRIMARY KEY (`codigo`, `codigo_candidato`),
  INDEX `fk_experiencia_candidato1_idx` (`codigo_candidato` ASC),
  CONSTRAINT `fk_experiencia_candidato1`
    FOREIGN KEY (`codigo_candidato`)
    REFERENCES `empleo`.`candidato` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`empresa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`empresa` ;

CREATE TABLE IF NOT EXISTS `empleo`.`empresa` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `razon_social` VARCHAR(64) NULL,
  `direccion` VARCHAR(256) NULL,
  `representante` VARCHAR(64) NULL,
  `email` VARCHAR(64) NULL,
  `telefono1` VARCHAR(32) NULL,
  `telefono2` VARCHAR(32) NULL,
  `usuario` INT(11) NULL,
  `estado` INT(11) NULL DEFAULT 1,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`empleo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`empleo` ;

CREATE TABLE IF NOT EXISTS `empleo`.`empleo` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(256) NULL,
  `descripcion` TEXT(2048) NULL,
  `sueldo` DECIMAL(18,2) NULL,
  `codigo_empresa` INT(11) NOT NULL,
  `fecha_vigencia` TIMESTAMP NULL,
  `duracion_contrato` INT(11) NULL,
  `localizacion` VARCHAR(64) NULL,
  `disponibilidad` VARCHAR(64) NULL,
  `fecha_publicacion` TIMESTAMP NULL,
  `usuario` INT(11) NULL,
  `estado` INT(11) NULL DEFAULT 1,
  PRIMARY KEY (`codigo`, `codigo_empresa`),
  INDEX `fk_empleo_empresa1_idx` (`codigo_empresa` ASC),
  CONSTRAINT `fk_empleo_empresa1`
    FOREIGN KEY (`codigo_empresa`)
    REFERENCES `empleo`.`empresa` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`candidato_empleo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`candidato_empleo` ;

CREATE TABLE IF NOT EXISTS `empleo`.`candidato_empleo` (
  `empleo_codigo` INT(11) NOT NULL,
  `candidato_codigo` INT(11) NOT NULL,
  `fecha_aplicacion` TIMESTAMP NULL DEFAULT current_timestamp,
  `interesado` VARCHAR(64) NULL COMMENT 'interesado.-  puede ser candidato o empresa',
  PRIMARY KEY (`empleo_codigo`, `candidato_codigo`),
  INDEX `fk_candidato_empleo_candidato1_idx` (`candidato_codigo` ASC),
  CONSTRAINT `fk_candidato_empleo_empleo1`
    FOREIGN KEY (`empleo_codigo`)
    REFERENCES `empleo`.`empleo` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_candidato_empleo_candidato1`
    FOREIGN KEY (`candidato_codigo`)
    REFERENCES `empleo`.`candidato` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`estado` ;

CREATE TABLE IF NOT EXISTS `empleo`.`estado` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`codigo`),
  INDEX `idxestado` USING BTREE (`codigo` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleo`.`duracion_contrato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empleo`.`duracion_contrato` ;

CREATE TABLE IF NOT EXISTS `empleo`.`duracion_contrato` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`codigo`),
  INDEX `idxduracion` USING BTREE (`codigo` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `empleo`.`usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`usuario` (`codigo`, `nombre`, `clave`, `email`, `estado`) VALUES (1, '1', '2', 'adminuio@empleo.com.ec', 1);
INSERT INTO `empleo`.`usuario` (`codigo`, `nombre`, `clave`, `email`, `estado`) VALUES (2, '1', '2', 'candidato@empleo.com.ec', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`rol`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`rol` (`codigo`, `nombre`, `estado`) VALUES (1, 'Administrador', 1);
INSERT INTO `empleo`.`rol` (`codigo`, `nombre`, `estado`) VALUES (2, 'Empresa', 1);
INSERT INTO `empleo`.`rol` (`codigo`, `nombre`, `estado`) VALUES (3, 'Candidato', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`pagina`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (1, 'Administracion', 'Administracion', 'Administracion', 1, 0, 1, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (2, 'Salir', 'salir.php', 'Salir', 0, 1, 5, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (3, 'Gestion Permisos', 'Gestion Permisos', 'Gestion Permisos', 1, 1, 4, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (4, 'Paginas', 'pagina.php', 'Paginas', 0, 3, 0, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (5, 'Asignacion de paginas a perfil', 'paginaperfil.php', 'Asignacion de paginas a perfil', 0, 3, 1, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (6, 'Permisos', 'permiso.php', 'Permisos', 0, 3, 2, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (7, 'Candidatos', 'Candidatos', 'Candidatos', 1, 0, 2, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (8, 'Candidato', 'Candidato', 'Candidato', 1, 7, 1, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (9, 'Empleo', 'empleo.php', 'Empleo', 0, 10, 2, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (10, 'Empresas', 'Empresas', 'Empresas', 1, 0, 3, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (11, 'Empresa', 'empresa.php', 'Empresa', 0, 10, 1, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (12, 'Experiencia', 'experiencia.php', 'Experiencia', 0, 8, 2, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (13, 'Candidato', 'candidato.php', 'Candidato', 0, 7, 1, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (14, 'Estudio', 'estudio.php', 'Estudios', 0, 8, 3, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (15, 'Direccion', 'direccion.php', 'Direccion', 0, 8, 4, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (16, 'Reporte de empleos disponibles', 'aplicar_empleo.php', 'Aplicar Empleo', 0, 7, 4, 1);
INSERT INTO `empleo`.`pagina` (`codigo`, `descripcion`, `pagina`, `menu`, `padre`, `codigo_padre`, `orden`, `estado`) VALUES (17, 'Reporte de candidatos q aplican a un empleo', 'empresa_empleo.php', 'Candidatos Empleo', 0, 10, 3, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`pagina_rol`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (1, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (2, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (3, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (4, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (5, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (6, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (7, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (8, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (9, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (10, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (11, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (12, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (13, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (14, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (15, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (16, 1, '2015-03-08', 1);
INSERT INTO `empleo`.`pagina_rol` (`codigo_pagina`, `codigo_rol`, `fecha`, `codigo_usuario`) VALUES (17, 1, '2015-03-08', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`rol_usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`rol_usuario` (`codigo_usuario`, `codigo_rol`) VALUES (1, 1);
INSERT INTO `empleo`.`rol_usuario` (`codigo_usuario`, `codigo_rol`) VALUES (2, 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`permiso`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (1, 1, NULL, 1, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (2, 1, NULL, 1, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (3, 1, NULL, 1, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (4, 1, NULL, 1, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (5, 1, NULL, 1, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (6, 1, NULL, 1, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (7, 1, NULL, 1, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (8, 1, NULL, 0, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (9, 1, NULL, 1, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (10, 1, NULL, 1, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (11, 1, NULL, 1, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (12, 1, NULL, 0, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (13, 1, NULL, 1, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (14, 1, NULL, 0, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (15, 1, NULL, 0, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (16, 1, NULL, 1, 1, 1, 1, 1, '2015-03-08', 1, NULL);
INSERT INTO `empleo`.`permiso` (`codigo_pagina`, `codigo_rol`, `descripcion`, `acceso_menu`, `acceso_consulta`, `acceso_guardar`, `acceso_actualizar`, `acceso_eliminar`, `fecha`, `estado`, `fecha_salida`) VALUES (17, 1, NULL, 1, 1, 1, 1, 1, '2015-03-08', 1, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`grupo_etnico`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`grupo_etnico` (`codigo`, `nombre`) VALUES (1, 'Meztizo');
INSERT INTO `empleo`.`grupo_etnico` (`codigo`, `nombre`) VALUES (2, 'Afroecuatoriano');
INSERT INTO `empleo`.`grupo_etnico` (`codigo`, `nombre`) VALUES (3, 'Indigena');
INSERT INTO `empleo`.`grupo_etnico` (`codigo`, `nombre`) VALUES (4, 'Otro');

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`disponibilidad`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`disponibilidad` (`codigo`, `nombre`) VALUES (1, 'Inmediata');
INSERT INTO `empleo`.`disponibilidad` (`codigo`, `nombre`) VALUES (2, 'Semana');
INSERT INTO `empleo`.`disponibilidad` (`codigo`, `nombre`) VALUES (3, 'Otro');

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`pais`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`pais` (`codigo`, `nombre`, `codigo_regularorio`, `estado`) VALUES (1, 'Ecuador', 'EC', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`provincia`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`provincia` (`codigo`, `codigo_pais`, `codigo_regulatorio`, `nombre`, `estado`) VALUES (1, 1, NULL, 'Pichincha', 1);
INSERT INTO `empleo`.`provincia` (`codigo`, `codigo_pais`, `codigo_regulatorio`, `nombre`, `estado`) VALUES (2, 1, NULL, 'Guayas', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`ciudad`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`ciudad` (`codigo`, `codigo_provincia`, `codigo_regulatorio`, `nombre`, `estado`) VALUES (1, 1, NULL, 'Quito', 1);
INSERT INTO `empleo`.`ciudad` (`codigo`, `codigo_provincia`, `codigo_regulatorio`, `nombre`, `estado`) VALUES (2, 1, NULL, 'Cayambe', 1);
INSERT INTO `empleo`.`ciudad` (`codigo`, `codigo_provincia`, `codigo_regulatorio`, `nombre`, `estado`) VALUES (3, 2, NULL, 'Guayaquil', 1);
INSERT INTO `empleo`.`ciudad` (`codigo`, `codigo_provincia`, `codigo_regulatorio`, `nombre`, `estado`) VALUES (4, 2, NULL, 'Daule', 1);

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


-- -----------------------------------------------------
-- Data for table `empleo`.`estado`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`estado` (`codigo`, `nombre`) VALUES (1, 'Activo');
INSERT INTO `empleo`.`estado` (`codigo`, `nombre`) VALUES (2, 'Inactivo');

COMMIT;


-- -----------------------------------------------------
-- Data for table `empleo`.`duracion_contrato`
-- -----------------------------------------------------
START TRANSACTION;
USE `empleo`;
INSERT INTO `empleo`.`duracion_contrato` (`codigo`, `nombre`) VALUES (1, 'Mensual');
INSERT INTO `empleo`.`duracion_contrato` (`codigo`, `nombre`) VALUES (2, 'Semestral');
INSERT INTO `empleo`.`duracion_contrato` (`codigo`, `nombre`) VALUES (3, 'Anual');
INSERT INTO `empleo`.`duracion_contrato` (`codigo`, `nombre`) VALUES (4, 'Otro');

COMMIT;

