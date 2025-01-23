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
        echo "Solicitud de amistad $estado.";
    } else {
        echo "Error al actualizar la solicitud.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
