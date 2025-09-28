START TRANSACTION;

-- CREACION DE BASE DE DATOS
DROP DATABASE IF EXISTS `movieflix_db`;
CREATE DATABASE `movieflix_db`;
USE `movieflix_db`;

-- CREACION DE TABLA DE ROLES
CREATE TABLE `roles` (
    `role_id` INT PRIMARY KEY AUTO_INCREMENT,
    `role_name` VARCHAR(200) NOT NULL
);

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Usuario'),
(2, 'Administrador');

-- CREACION DE TABLA DE USUARIOS
CREATE TABLE `users` (
    `user_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_alias` VARCHAR(200) NOT NULL,
    `user_password` TEXT,
    `role_id` INT NOT NULL
);

INSERT INTO `users` (`user_id`, `user_alias`, `user_password`, `role_id`) VALUES
(1, 'admin', '2097c69fbd54c190cd87c5eb3d1e7caa', 2),
(2, 'user', '2097c69fbd54c190cd87c5eb3d1e7caa', 1);

-- CREACION DE TABLA DE CATEGORIAS
CREATE TABLE `categories` (
    `category_id` INT PRIMARY KEY AUTO_INCREMENT,
    `category_name` VARCHAR(200) NOT NULL
);

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Accion'),
(2, 'Romance'),
(3, 'Comedia');

-- CREACION DE TABLA DE PELICULAS
CREATE TABLE movies (
    `movie_id` INT PRIMARY KEY AUTO_INCREMENT,
    `movie_name` VARCHAR(200) NOT NULL,
    `movie_year` BIGINT NOT NULL,
    `movie_image` VARCHAR(200) NOT NULL DEFAULT '/assets/imagenes/movies/default.png',
    `category_id` INT NOT NULL
);

-- CREACION DE RELACIONES
ALTER TABLE `movies` 
ADD CONSTRAINT `movie_category`
FOREIGN KEY (`category_id`)
REFERENCES `categories` (`category_id`)
ON UPDATE CASCADE
ON DELETE CASCADE;

COMMIT;