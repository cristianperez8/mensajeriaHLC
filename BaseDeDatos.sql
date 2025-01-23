CREATE DATABASE IF NOT EXISTS practica3DB;

USE practica3DB;

-- Crear la tabla usuario

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

-- Crear la tabla de amigos
CREATE TABLE amigos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_alias VARCHAR(50) NOT NULL,
    amigo_alias VARCHAR(50) NOT NULL,
    status ENUM('pendiente', 'aceptado', 'rechazado') DEFAULT 'pendiente',
    FOREIGN KEY (usuario_alias) REFERENCES usuario(alias),
    FOREIGN KEY (amigo_alias) REFERENCES usuario(alias)
);

-- Crear la tabla de mensajes
CREATE TABLE mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    envia_alias VARCHAR(50) NOT NULL,
    recibe_alias VARCHAR(50) NOT NULL,
    mensaje TEXT NOT NULL,
    hora_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (envia_alias) REFERENCES usuario(alias),
    FOREIGN KEY (recibe_alias) REFERENCES usuario(alias)
);
