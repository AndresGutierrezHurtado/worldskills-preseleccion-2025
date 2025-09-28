<?php

require_once(__DIR__ . "/server/autoload.php");

validate_guest();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Movies Manager</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <div class="login-container">
        <h1>🎬 Movies Manager</h1>
        <form action="./server/functions/auth/login.php" method="POST" class="login-form">
            <input type="text" name="user_alias" placeholder="Usuario" required>
            <input type="password" name="user_password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>

</html>