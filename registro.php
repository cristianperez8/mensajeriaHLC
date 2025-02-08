<?php

require_once 'conexionBD.php';

// Verifica que la solicitud venga de un formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coge los datos enviados
    $alias = $_POST['alias'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $email = $_POST['email'];

    // Valida que el alias no exista con una consulta en la base de datos
    $stmt = $conn->prepare("SELECT COUNT(*) FROM usuario WHERE alias = ?");
    $stmt->execute([$alias]); // Ejecuta la consulta con el alias como parámetro

    // Verifica si el alias está registrado, si existe muestra el mensaje de error
    if ($stmt->fetchColumn() > 0) {
        $message = "El nombre de usuario no está disponible.";
    } else {
        // Inserta un nuevo usuario y cifra la contraseña
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO usuario (alias, password, nombre, apellidos, fecha_nacimiento, email) 
                               VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$alias, $hashed_password, $nombre, $apellidos, $fecha_nacimiento, $email]);
        $message = "Usuario registrado correctamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="cssP3.css">
</head>
<body>
    <form>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php if ($message === "Usuario registrado correctamente.") : ?>
            <button type="button" onclick="location.href='loginHTML.html'">Iniciar Sesión</button>
        <?php elseif ($message === "El nombre de usuario no está disponible.") : ?>
            <button type="button" onclick="location.href='registroHTML.html'">Registrarse</button>
        <?php endif; ?>
    </form>
</body>
</html>
