<?php
session_start();
require 'conexionBD.php';

$usuario_alias = $_SESSION['alias']; // Suponiendo que el alias se guarda en la sesión
$amigo_alias = $_POST['amigo_alias'];

$sql = "INSERT INTO amigos (usuario_alias, amigo_alias, status) VALUES (?, ?, 'pendiente')";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $usuario_alias, $amigo_alias);

if ($stmt->execute()) {
    echo "Solicitud de amistad enviada.";
} else {
    echo "Error al enviar la solicitud.";
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Enviar Solicitud de Amistad</title>
</head>
<body>
    <h1>Enviar Solicitud de Amistad</h1>
    <form action="enviar_solicitud.php" method="post">
        <label for="amigo_alias">Alias del Amigo:</label>
        <input type="text" id="amigo_alias" name="amigo_alias" required>
        <button type="submit">Enviar Solicitud</button>
    </form>
</body>
</html>

