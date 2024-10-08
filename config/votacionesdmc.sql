-- MySQL Script generated by MySQL Workbench
-- Sat Jul 13 12:39:02 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema votacionesdmc
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `votacionesdmc` ;

-- -----------------------------------------------------
-- Schema votacionesdmc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `votacionesdmc` DEFAULT CHARACTER SET utf8 ;
SHOW WARNINGS;
USE `votacionesdmc` ;

-- -----------------------------------------------------
-- Table `Candidatos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Candidatos` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Candidatos` (
  `idCandidatos` VARCHAR(100) NOT NULL,
  `Nombres` VARCHAR(45) NOT NULL,
  `Apellidos` VARCHAR(45) NOT NULL,
  `Nodocumento` VARCHAR(100) NOT NULL,
  `Curso` VARCHAR(45) NOT NULL,
  `Imagen` BLOB NULL,
  PRIMARY KEY (`idCandidatos`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Cursos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Cursos` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Cursos` (
  `idCursos` VARCHAR(100) NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `Grado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCursos`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Grados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Grados` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Grados` (
  `idGrados` VARCHAR(100) NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idGrados`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Roles` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Roles` (
  `idRoles` VARCHAR(100) NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idRoles`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Usuarios` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Usuarios` (
  `idUsuarios` VARCHAR(100) NOT NULL,
  `Nombres` VARCHAR(45) NOT NULL,
  `Apellidos` VARCHAR(45) NOT NULL,
  `Nodocumento` INT NOT NULL,
  `Contraseña` VARCHAR(100) NOT NULL,
  `Rol` VARCHAR(45) NOT NULL,
  `Curso` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUsuarios`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Votos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Votos` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Votos` (
  `idVotos` VARCHAR(100) NOT NULL,
  `id_Usuario` VARCHAR(45) NOT NULL,
  `id_Candidato` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idVotos`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `id_Usuario_UNIQUE` ON `Votos` (`id_Usuario` ASC) VISIBLE;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
