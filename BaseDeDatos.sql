CREATE DATABASE IF NOT EXISTS practica3DB;

USE practica3DB;

CREATE TABLE IF NOT EXISTS usuario (
    alias VARCHAR(50) PRIMARY KEY,
    password VARCHAR(50) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE
);

-- Insertar datos de ejemplo
INSERT INTO usuario (alias, password, nombre, apellidos, fecha_nacimiento) VALUES
('diegoto88', '123456', 'Diego', 'Rodríguez Rebolló', '2002-07-11'),
('cr8perez', 'cris', 'Cristian', 'Pérez García', '2003-04-28'),
('ngale', '1234', 'Alejandro', 'Castro Domínguez', '1999-01-01');
