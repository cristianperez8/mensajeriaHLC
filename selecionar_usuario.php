<?php
session_start();
require 'conexionBD.php';

$alias_actual = isset($_SESSION['alias']) ? $_SESSION['alias'] : '';

if (empty($alias_actual)) {
    die('Alias no encontrado en la sesión.');
}

// Obtener la lista de amigos aceptados del usuario actual
$sql = "SELECT amigo_alias AS amigo FROM amigos WHERE usuario_alias = :alias AND status = ''
        UNION 
        SELECT usuario_alias AS amigo FROM amigos WHERE amigo_alias = :alias AND status = ''";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':alias', $alias_actual);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$conn = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Usuario</title>
    <link rel="stylesheet" href="cssP3.css">
</head>
<body>
    <div class="container">
        <h1>Seleccionar Usuario para Enviar Mensaje</h1>
        <form action="chat.php" method="get">
            <label for="recibe_alias">Alias del Receptor:</label>
            <select id="recibe_alias" name="recibe_alias" required>
                <?php foreach ($result as $row) { ?>
                    <option value="<?php echo htmlspecialchars($row['amigo']); ?>"><?php echo htmlspecialchars($row['amigo']); ?></option>
                <?php } ?>
            </select>
            <button type="submit">Seleccionar Usuario</button>
        </form>
    </div>
</body>
</html>
