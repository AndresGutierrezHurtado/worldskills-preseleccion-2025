<?php

try {
    if (isset($_SESSION["user_id"])) {
        $id = $_SESSION["user_id"];
        $sql = "SELECT * FROM `users` INNER JOIN `roles` ON `users`.`role_id` = `roles`.`role_id` WHERE `user_id` = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $_SESSION["user"] = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION["user_id"] = $id;
    }
} catch (Exception $e) {
    custom_response("Hubo un error al conectarse al obtener la sesión: {$e->getMessage()}");
}
