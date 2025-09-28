<?php

require_once(__DIR__ . "/server/autoload.php");

validate_session();

$movies = $conn->query("SELECT * FROM movies INNER JOIN categories ON movies.category_id = categories.category_id")->fetchAll(PDO::FETCH_ASSOC);
$categories = $conn->query("SELECT * FROM categories;")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Películas</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>🎬 Gestor de Películas</h1>
        <p>Bienvenido <b><?= $_SESSION["user"]["user_alias"] ?></b> | <a href="#" onclick="if (confirm('¿Estás seguro que quieres cerrar sesión?')) window.location.href = '/server/functions/auth/logout.php'">Cerrar sesión</a></p>

        <p class="subtitle">Explora todas las películas disponibles</p>

        <?php if (count($movies) === 0): ?>
            <p>No hay películas disponibles</p>
        <?php endif; ?>

        <div class="grid">
            <?php foreach ($movies as $movie): ?>
                <div class="card">
                    <img src="<?= $movie["movie_image"] ?>" alt="Inception" class="card-img">
                    <div class="card-body">
                        <h3 class="card-title"><?= $movie["movie_name"] ?></h3>
                        <p><strong>Año:</strong> <?= $movie["movie_year"] ?></p>
                        <p><strong>Género:</strong> <?= $movie["category_name"] ?></p>
                        <a href="view.php?id=<?= $movie["movie_id"] ?>" class="btn">Ver Detalles</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>