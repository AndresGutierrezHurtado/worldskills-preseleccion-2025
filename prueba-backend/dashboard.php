<?php

require_once(__DIR__ . "/server/autoload.php");

validate_session();
validate_admin();

$movies = $conn->query("SELECT * FROM movies INNER JOIN categories ON movies.category_id = categories.category_id")->fetchAll(PDO::FETCH_ASSOC);
$categories = $conn->query("SELECT * FROM categories;")->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Movies Manager</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>🎬 Gestor de Películas</h1>
        <p>Bienvenido <b><?= $_SESSION["user"]["user_alias"] ?></b> | <a href="#" onclick="if (confirm('¿Estás seguro que quieres cerrar sesión?')) window.location.href = '/server/functions/auth/logout.php'">Cerrar sesión</a></p>

        <h2>Agregar Película</h2>
        <form action="./server/functions/movies/create.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="movie_name" placeholder="Título" required>
            <input type="number" name="movie_year" placeholder="Año" required>
            <select name="category_id" id="category_id" required>
                <option value="">Genero</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category["category_id"] ?>"><?= $category["category_name"] ?></option>
                <?php endforeach; ?>
            </select>
            <input type="file" name="movie_image" accept="image/*" required>
            <button type="submit">Agregar</button>
        </form>

        <h2>Lista de Películas</h2>
        <?php if (count($movies) === 0): ?>
            <p>No hay películas disponibles</p>
        <?php endif; ?>

        <div class="card-grid">
            <?php foreach ($movies as $movie): ?>
                <div class="card">
                    <img src="<?= $movie["movie_image"] ?>" alt="Imagen de la pelicula<?= $movie["movie_name"] ?>">
                    <h3><?= $movie["movie_name"] ?></h3>
                    <p><?= $movie["movie_year"] ?> | <?= $movie["category_name"] ?></p>
                    <div class="actions">
                        <a href="./edit.php?id=<?= $movie["movie_id"] ?>">Editar</a>
                        <a href="./delete.php?id=<?= $movie["movie_id"] ?>">Eliminar</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>