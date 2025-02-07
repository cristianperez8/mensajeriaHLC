<?php
session_start();
require 'conexionBD.php';

// Inicializa el mensaje vacío
$mensaje = "";

// Verifica que el alias esté en la sesión
if (!isset($_SESSION['alias'])) {
    $mensaje = "Error: No has iniciado sesión.";
} elseif (!isset($_POST['amigo_alias']) || empty(trim($_POST['amigo_alias']))) {
    $mensaje = "Error: No se ha proporcionado un alias válido.";
} else {
    $usuario_alias = $_SESSION['alias'];
    $amigo_alias = trim($_POST['amigo_alias']);

    if ($usuario_alias === $amigo_alias) {
        $mensaje = "Error: No puedes enviarte una solicitud a ti mismo.";
    } else {
        try {
            // Prepara la consulta
            $stmt = $conn->prepare("INSERT INTO amigos (usuario_alias, amigo_alias, status) VALUES (:usuario_alias, :amigo_alias, 'pendiente')");
            $stmt->bindParam(':usuario_alias', $usuario_alias);
            $stmt->bindParam(':amigo_alias', $amigo_alias);

            // Guarda los mensajes en la variable en lugar de imprimirlos con echo
            $mensaje .= "Alias de usuario: $usuario_alias <br>";
            $mensaje .= "Alias del amigo: $amigo_alias <br>";

            if ($stmt->execute()) {
                $mensaje .= "Solicitud de amistad enviada.";
            } else {
                $mensaje .= "Error al enviar la solicitud.";
            }
        } catch (PDOException $e) {
            $mensaje = "Error en la base de datos: " . $e->getMessage();
        }
    }
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Amistad</title>
    <link rel="stylesheet" href="cssP3.css">
</head>
<body>
    <form class="container">
        <h2>Solicitud de Amistad</h2>
        <p><?php echo $mensaje; ?></p>
        <button type="button" onclick="location.href='enviarSolicitud.html'">Volver</button>
    </form>
</body>
</html>
