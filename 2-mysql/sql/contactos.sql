/*
Existen 2 tipos del sentencias SQL:

1. Sentencias Estructurales: Son las que nos permitiran crear,
modificar o eliminar objectos, usuarios y propiedades de nuestra BD

2. Sentencias de Datos: Son las uqe nos permitiran insertar, eliminar, modificar y buscar informacion
en nuestra BD

En MySQL existen 2 tipos de engine para tablas:
1. MyISAM - tablas planas, son como si fueran excel
2. InnoDB - tablas relacionales

http://mysql.conclase.net/curso/index.php

*/

CREATE DATABASE contactos_php;

USE contactos_php;

CREATE TABLE contactos(
    email VARCHAR(50) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    sexo CHAR(1),
    nacimiento DATE,
    telefono VARCHAR(13),
    pais VARCHAR(50) NOT NULL,
    imagen VARCHAR(100),
    PRIMARY KEY(email),
    FULLTEXT KEY buscador(email, nombre, sexo, telefono, pais)
)ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- FULLTEXT solo funciona en MyISAM

CREATE TABLE pais(
    id_pais INT NOT NULL AUTO_INCREMENT,
    pais VARCHAR(50) NOT NULL,
    PRIMARY KEY(id_pais)
)ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO pais (id_pais, pais) VALUES 
(1, "Mexico"),
(2, "Colombia"),
(3, "Guatemala"),
(4, "España"),
(5, "Brasil"),
(6, "Uruguay"),
(7, "Perú"),
(8, "Argentina"),
(9, "Chile"),
(10, "Paraguay"),
(11, "Honduras"),
(12, "El salvador"),
(13, "Nicaragua"),
(14, "Costa Rica"),
(15, "Panamá"),
(16, "Venezuela"),
(17, "Ecuador"),
(18, "Bolivia"),
(19, "Canada"),
(20, "Estados Unidos"),
(21, "Groenlandia"),
(22, "Republica Dominicana"),
(23, "Haiti"),
(24, "Cuba"),
(25, "Belice"),
(26, "Inglaterra"),
(27, "Francia"),
(28, "Alemania"),
(29, "Italia"),
(30, "Japon"),
(31, "China"),
(32, "Egipto"),
(33, "Sudafrica"),
(34, "Australia"),
(35, "Nueva Zelanda");

ALTER TABLE pais
ADD FOREIGN KEY (id_pais) REFERENCES contactos(pais);



