<?php
session_start();
require 'conexionBD.php';

// Verifica que el alias esté en la sesión
if (!isset($_SESSION['alias'])) {
    exit;
}

$id = $_POST['id'];
$accion = $_POST['accion'];

try {
    if ($accion == 'aceptar') {
        $estado = 'aceptada';
    } else {
        $estado = 'rechazada';
    }

    // Actualiza el estado de la solicitud
    $stmt = $conn->prepare("UPDATE amigos SET status = :estado WHERE id = :id");
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $mensaje = "Solicitud de amistad $estado.";
    } else {
        $mensaje = "Error al actualizar la solicitud.";
    }
} catch (PDOException $e) {
    $mensaje = "Error: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de la Solicitud</title>
    <link rel="stylesheet" href="cssP3.css">
</head>
<body>
    <div class="container">
        <h2><?php echo $mensaje; ?></h2>
        <button type="button" onclick="location.href='mostrarSolicitudes.php'">Solicitudes Recibidas</button>
    </div>
</body>
</html>
