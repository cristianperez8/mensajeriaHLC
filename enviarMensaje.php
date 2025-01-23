<?php
session_start();
require 'conexionBD.php';

$envia_alias = $_SESSION['alias'];
$recibe_alias = $_POST['recibe_alias'];
$mensaje = $_POST['mensaje'];

$sql = "INSERT INTO mensajes (envia_alias, recibe_alias, mensaje, hora_envio) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $envia_alias, $recibe_alias, $mensaje);

if ($stmt->execute()) {
    echo "Mensaje enviado.";
} else {
    echo "Error al enviar el mensaje.";
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Enviar Mensaje</title>
</head>
<body>
    <h1>Enviar Mensaje</h1>
    <form action="enviar_mensaje.php" method="post">
        <label for="recibe_alias">Alias del Receptor:</label>
        <input type="text" id="recibe_alias" name="recibe_alias" required>
        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" required></textarea>
        <button type="submit">Enviar Mensaje</button>
    </form>
</body>
</html>

