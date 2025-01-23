<?php
include 'conexionBD.php';
session_start();

// Verifica que la solicitud venga de un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coge los datos enviados
    $alias = $_POST['alias'];
    $password = $_POST['password'];

    // Verificar si el alias existe con la consulta en la base de datos
    $sql = "SELECT * FROM usuario WHERE alias = :alias";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':alias', $alias);
    $stmt->execute();

    // Verifica si hay usuario con el mismo alias
    if ($stmt->rowCount() == 1) {
        // Recupera la información del usuario como un array asociativo
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Verificar contraseña
        if (password_verify($password, $user['password'])) {
            $_SESSION['alias'] = $alias;
            $_SESSION['nombre_completo'] = $user['nombre'] . ' ' . $user['apellidos'];
            // Redirige a la página de bienvenida.
            header("Location: bienvenida.php");
            exit;
        } else {
            $message = "La contraseña introducida es incorrecta.";
        }
    } else {
        $message = "El alias introducido es incorrecto.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Incorrecto</title>
    <link rel="stylesheet" href="cssP3.css">
</head>
<body>
    <form>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php if ($message === "La contraseña introducida es incorrecta.") : ?>
            <button type="button" onclick="location.href='loginHTML.html'">Iniciar Sesión</button>
        <?php elseif ($message === "El alias introducido es incorrecto.") : ?>
            <button type="button" onclick="location.href='loginHTML.html'">Iniciar Sesión</button>
        <?php endif; ?>
    </form>
</body>
</html>
