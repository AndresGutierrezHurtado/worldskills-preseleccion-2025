<?php

require_once(__DIR__ . "/server/autoload.php");

validate_session();

$id = $_GET["id"];
$sql = "SELECT * FROM movies INNER JOIN categories ON movies.category_id = categories.category_id WHERE movie_id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Película</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Detalle de la Película</h1>

        <div class="movie-detail">
            <img src="<?= $movie["movie_image"] ?>" alt="Poster de la película" class="poster-detail">

            <div class="movie-info">
                <h2 id="movie-title"><?= $movie["movie_name"] ?></h2>
                <p><strong>Año:</strong> <span id="movie-year"><?= $movie["movie_year"] ?></span></p>
                <p><strong>Género:</strong> <span id="movie-genre"><?= $movie["category_name"] ?></span></p>
            </div>
        </div>

        <div class="actions">
            <a href="catalog.php" class="btn">Volver al catalogo</a>
        </div>
    </div>
</body>

</html>