<?php

require_once(__DIR__ . "/../../autoload.php");

// VALIDACION DE USUARIO
validate_session();
validate_admin();

try {
    // VALIDACION DE DATOS
    $id = $_GET["id"];

    // ELIMINACION DE PELICULA
    $sql = "DELETE FROM movies WHERE movie_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    // RESPUESTA
    custom_response("Pelicula eliminada correcatamente", "/dashboard.php");
} catch (Exception $e) {
    custom_response("Hubo un error al eliminar la pelicula: {$e->getMessage()}", "dashboard.php");
}