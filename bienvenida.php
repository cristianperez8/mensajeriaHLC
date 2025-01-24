<?php
session_start();
// Verifica que el alias este en la sesion
if (!isset($_SESSION['alias'])) {
    // Si no existe el alias detiene la ejecuccion
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="cssP3.css">
</head>
<body>
    <form>
        <h2>Hola, <?php echo $_SESSION['nombre_completo']; ?> has iniciado sesión.</h2>
        <button type="button" onclick="location.href='cerrar_sesion.php'">Cerrar Sesión</button>
        <button type="button" onclick="location.href='enviarSolicitud.html'">Buscar Amigos</button>
        <button type="button" onclick="location.href='mostrarSolicitudes.php'">Solicitudes Recibidas</button>
        <button type="button" onclick="location.href='selecionar_usuario.php'">Selecionar Usuario para Chat</button>
</body>
</html>
