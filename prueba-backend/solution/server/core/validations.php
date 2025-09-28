<?php

function validate_session() {
    if (!isset($_SESSION["user_id"])) {
        custom_response("No tienes permisos para hacer esa acción");
    }
}

function validate_admin() {
    if ($_SESSION["user"]["user_alias"] !== "admin") {
        custom_response("No tienes permisos para hacer esa acción", "/catalog.php");
    }
}

function validate_guest() {
    if (isset($_SESSION["user_id"])) {
        custom_response("No tienes permisos para hacer esa acción, ya tienes una sesión activa", "/dashboard.php");
    }
}
