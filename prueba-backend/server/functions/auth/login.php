<?php

require_once(__DIR__ . "/../../autoload.php");

validate_guest();

try {
    // VALIDACION DE DATOS
    $data = $_POST;

    $sql = "SELECT * FROM users WHERE user_alias = :alias";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":alias", $data["user_alias"]);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // VALIDACION DE USUARIO Y CONTRASEÑA
    if (!$user) {
        throw new Exception("No se encontró ese usuario");
    }

    if ($user["user_password"] !== md5($data["user_password"])){
        throw new Exception("La contraseña no coincide");
    }

    // CREACION DE SESION
    $_SESSION["user_id"] = $user["user_id"];
    $_SESSION["user"] = $user;

    // RESPUESTA
    custom_response("Sesion iniciada correctamente", $user["user_alias"] === "admin" ? "/dashboard.php" : "/catalog.php");
} catch (Exception $e) {
    custom_response("Hubo un error al iniciar sesión: {$e->getMessage()}");
}