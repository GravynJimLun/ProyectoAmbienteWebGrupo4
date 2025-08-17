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
 usuario VARCHAR(50) NOT NULL UNIQUE,
 contrasena VARCHAR(255) NOT NULL
);

CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_cliente VARCHAR(100) NOT NULL,
    mascota VARCHAR(100) NOT NULL,
    servicio VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    fecha DATETIME NOT NULL
);

Select * from citas;
Select * from Clientes;