<?php
session_start();
require 'conexionBD.php';

$usuario_alias = $_SESSION['alias'];
$amigo_alias = $_POST['amigo_alias'];

$sql = "UPDATE friends SET status = 'aceptado' WHERE usuario_alias = ? AND amigo_alias = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $amigo_alias, $usuario_alias);

if ($stmt->execute()) {
    echo "Solicitud de amistad aceptada.";
} else {
    echo "Error al aceptar la solicitud.";
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aceptar Solicitud de Amistad</title>
</head>
<body>
    <h1>Aceptar Solicitud de Amistad</h1>
    <form action="aceptar_solicitud.php" method="post">
        <label for="amigo_alias">Alias del Amigo:</label>
        <input type="text" id="amigo_alias" name="amigo_alias" required>
        <button type="submit">Aceptar Solicitud</button>
    </form>
</body>
</html>

