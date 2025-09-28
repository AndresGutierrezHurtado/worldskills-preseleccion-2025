<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=movieflix_db;charset=utf8mb4;port=3307;", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    echo "Hubo un error al conectarse a la base de datos {$e->getMessage()}";
    die();
}