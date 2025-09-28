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

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Película</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>🗑️ Eliminar Película</h1>
        <p>¿Estás seguro de que deseas eliminar la película <b><?= $movie["movie_name"] ?></b>?</p>
        <form action="./server/functions/movies/delete.php?id=<?= $_GET["id"] ?>" method="POST">
            <input type="hidden" name="id" value="1">
            <button type="submit">Sí, eliminar</button>
            <a href="dashboard.php">Cancelar</a>
        </form>
    </div>
</body>

</html>