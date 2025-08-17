CREATE DATABASE IF NOT EXISTS proyecto_web;

USE proyecto_web;

CREATE TABLE clientes (
 id_cliente INT AUTO_INCREMENT PRIMARY KEY,
 identificacion VARCHAR(20) NOT NULL UNIQUE,
 apellidos VARCHAR(100) NOT NULL,
 nombre VARCHAR(100) NOT NULL,
 telefono_personal VARCHAR(20),
 direccion_personal VARCHAR(255),
 email VARCHAR(150) UNIQUE,
 lugar_trabajo VARCHAR(150),
 direccion_trabajo VARCHAR(255),
 telefono_trabajo VARCHAR(20),
 usuario VARCHAR(50) NOT NULL UNIQUE,
 contrasena VARCHAR(255) NOT NULL
);

Select * from Clientes;