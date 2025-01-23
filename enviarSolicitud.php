<?php
session_start();
require 'conexionBD.php';

// Verifica que el alias esté en la sesión
if (!isset($_SESSION['alias'])) {
    exit;
}

$usuario_alias = $_SESSION['alias'];
$amigo_alias = $_POST['amigo_alias'];

try {
    // Prepara la consulta
    $stmt = $conn->prepare("INSERT INTO amigos (usuario_alias, amigo_alias, status) VALUES (:usuario_alias, :amigo_alias, 'pendiente')");
    // Vincula los parámetros
    $stmt->bindParam(':usuario_alias', $usuario_alias);
    $stmt->bindParam(':amigo_alias', $amigo_alias);

    // Debugging: Verifica los datos
    echo "Alias de usuario: $usuario_alias <br>";
    echo "Alias del amigo: $amigo_alias <br>";
    
    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "Solicitud de amistad enviada.";
    } else {
        echo "Error al enviar la solicitud.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
