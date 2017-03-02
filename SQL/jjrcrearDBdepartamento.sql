
create database `jjrDBdepartamento`;
use `jjrDBdepartamento`;

CREATE TABLE `Departamento` (
  `codDepartamento` VARCHAR(3) NOT NULL,
  `descDepartamento` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`codDepartamento`));


CREATE TABLE `Usuario` (
  `codUsuario` VARCHAR(8) NOT NULL,
  `descUsuario` VARCHAR(255) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `perfil` VARCHAR(20),
  PRIMARY KEY (`codUsuario`));


GRANT ALL PRIVILEGES ON jjrDBdepartamento.* TO 'usDepartamento'@'%' IDENTIFIED BY 'paso';
