<?php

require_once(__DIR__ . "/server/autoload.php");

validate_session();
validate_admin();

$id = $_GET["id"];
$sql = "SELECT * FROM movies INNER JOIN categories ON movies.category_id = categories.category_id WHERE movie_id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

$categories = $conn->query("SELECT * FROM categories;")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Película</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>✏️ Editar Película</h1>
        <form action="./server/functions/movies/update.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="text" name="movie_name" placeholder="Título" value="<?= $movie["movie_name"] ?>" required>
            <input type="number" name="movie_year" placeholder="Año" value="<?= $movie["movie_year"] ?>" required>
            <select name="category_id" id="category_id" required>
                <option value="">Genero</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category["category_id"] ?>" <?= $movie["category_id"] === $category["category_id"] ? 'selected' : '' ?>><?= $category["category_name"] ?></option>
                <?php endforeach; ?>
            </select>
            <label>Poster actual:</label><br>
            <img src="<?= $movie["movie_image"] ?>" alt="Imagen de la pelicula <?= $movie["movie_name"] ?>"><br><br>
            <input type="file" name="movie_image" accept="image/*">
            <button type="submit">Guardar Cambios</button>
            <a href="dashboard.php">Cancelar</a>
        </form>
    </div>
</body>

</html>