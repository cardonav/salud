CREATE DATABASE cosfa_salud;
USE cosfa_salud;

CREATE TABLE usuarios (
 id INT AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(50),
 password VARCHAR(255)
);

INSERT INTO usuarios(username,password) VALUES(
'admin',
'1234'
); -- contraseña: 1234

CREATE TABLE estudiantes (
 id INT AUTO_INCREMENT PRIMARY KEY,
 documento VARCHAR(20),
 nombre VARCHAR(100),
 grado VARCHAR(10),
 telefono VARCHAR(20)
);

CREATE TABLE historia (
 id INT AUTO_INCREMENT PRIMARY KEY,
 estudiante_id INT,
 fecha DATE,
 sintomas TEXT,
 tratamiento TEXT
);