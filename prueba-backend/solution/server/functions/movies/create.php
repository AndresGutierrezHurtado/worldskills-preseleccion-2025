<?php

require_once(__DIR__ . "/../../autoload.php");

// VALIDACION DE USUARIO
validate_session();
validate_admin();

try {
    // VALIDACION DE DATOS
    $data = $_POST;
    $image = $_FILES["movie_image"];
    $placeholder = "/assets/imagenes/movies/default.png";

    $data["movie_year"] = (int) $data["movie_year"];

    // CREACION DE PELICULA
    $sql = "INSERT INTO `movies` (`movie_name`, `movie_year`, `movie_image`, `category_id`) VALUES (:name, :year, :image, :category)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":name", $data["movie_name"]);
    $stmt->bindParam(":year", $data["movie_year"]);
    $stmt->bindParam(":image", $placeholder);
    $stmt->bindParam(":category", $data["category_id"]);
    $stmt->execute();

    // SUBIDA DE IMAGEN
    $id = $conn->lastInsertId();
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
    custom_response("Pelicula creada correcatamente", "/dashboard.php");
} catch (Exception $e) {
    custom_response("Hubo un error al crear la pelicula: {$e->getMessage()}", "/dashboard.php");
}