<?php

require_once(__DIR__ . "/../../autoload.php");

// VALIDACION DE USUARIO
validate_session();

try {
    // CIERRE DE SESION
    $_SESSION["user_id"] = null;
    $_SESSION["user"] = null;

    session_destroy();
    custom_response("Sesion cerrada");
} catch (Exception $e) {
    custom_response("Hubo un error al iniciar sesión: {$e->getMessage()}");
}
