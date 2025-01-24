<?php
session_start();
require 'conexionBD.php';

$envia_alias = $_SESSION['alias'];
$recibe_alias = $_POST['recibe_alias'];
$mensaje = $_POST['mensaje'];

try {
    $sql = "INSERT INTO mensajes (envia_alias, recibe_alias, mensaje, hora_envio) VALUES (:envia_alias, :recibe_alias, :mensaje, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':envia_alias', $envia_alias);
    $stmt->bindParam(':recibe_alias', $recibe_alias);
    $stmt->bindParam(':mensaje', $mensaje);

    if ($stmt->execute()) {
        // Redirigir al chat después de enviar el mensaje
        header("Location: chat.php?recibe_alias=" . urlencode($recibe_alias));
        exit;
    } else {
        echo "Error al enviar el mensaje.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
