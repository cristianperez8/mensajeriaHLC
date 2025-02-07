<?php
session_start();
require 'conexionBD.php';

// Verifica que el alias esté en la sesión
if (!isset($_SESSION['alias'])) {
    exit;
}

$usuario_alias = $_SESSION['alias'];

try {
    // Recupera solicitudes de amistad pendientes
    $stmt = $conn->prepare("SELECT * FROM amigos WHERE amigo_alias = :usuario_alias AND status = 'pendiente'");
    $stmt->bindParam(':usuario_alias', $usuario_alias);
    $stmt->execute();
    $solicitudes = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitudes de Amistad</title>
    <link rel="stylesheet" href="cssP3.css">
</head>
<body>
    <div class="container">
    <h1>Solicitudes de Amistad</h1>
        <?php foreach ($solicitudes as $solicitud): ?>
            <div class="solicitud">
                <p><?php echo $solicitud['usuario_alias']; ?> te ha enviado una solicitud de amistad.</p>
                <form action="gestionarSolicitud.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $solicitud['id']; ?>">
                    <button type="submit" name="accion" value="aceptar">Aceptar</button>
                    <button type="submit" name="accion" value="rechazar">Rechazar</button>
                </form>
            </div>
        <?php endforeach; ?>
        <button type="button" onclick="location.href='bienvenida.php'">Volver al Menú</button>
    </div>
</body>
</html>
