<?php

require_once(__DIR__ . "/../../autoload.php");

// VALIDACION DE USUARIO
validate_session();
validate_admin();

try {
    // VALIDACION DE DATOS
    $id = $_GET["id"];
    $data = $_POST;
    $image = $_FILES["movie_image"];

    // ACTUALIZACION DE PELICULA
    $sql = "UPDATE movies SET 
    movie_name = :name, 
    movie_year = :year, 
    category_id = :category 
    WHERE movie_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":name", $data["movie_name"]);
    $stmt->bindParam(":year", $data["movie_year"]);
    $stmt->bindParam(":category", $data["category_id"]);
    $stmt->execute();

    // SUBIDA DE IMAGEN
    if (isset($image) && $image["size"] > 0 ) {
        $image_path = "/assets/imagenes/movies/$id.png";
        $dir = (__DIR__ . "/../../..$image_path");

        if (!move_uploaded_file($image["tmp_name"], $dir)) {
            throw new Exception("Error al subir imagen");
        }

        $update_sql = "UPDATE movies SET movie_image = :image WHERE movie_id = :id";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bindParam(":image", $image_path);
        $update_stmt->bindParam(":id", $id);
        $update_stmt->execute();
    }

    // RESPUESTA
    custom_response("Pelicula actualizada correcatamente", "/dashboard.php");
} catch (Exception $e) {
    custom_response("Hubo un error al actualizar la pelicula: {$e->getMessage()}");
}