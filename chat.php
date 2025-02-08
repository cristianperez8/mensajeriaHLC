<?php
session_start();
require 'conexionBD.php';

$envia_alias = $_SESSION['alias'];
$recibe_alias = $_GET['recibe_alias'];

// Obtener solo los últimos 17 mensajes en orden cronológico correcto
$sql = "SELECT envia_alias, mensaje, hora_envio 
        FROM mensajes 
        WHERE (envia_alias = :envia_alias AND recibe_alias = :recibe_alias) 
           OR (envia_alias = :recibe_alias AND recibe_alias = :envia_alias) 
        ORDER BY hora_envio DESC 
        LIMIT 17";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':envia_alias', $envia_alias);
$stmt->bindParam(':recibe_alias', $recibe_alias);
$stmt->execute();
$result = array_reverse($stmt->fetchAll(PDO::FETCH_ASSOC)); // Invertimos el orden para que aparezcan correctamente

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chat con <?php echo htmlspecialchars($recibe_alias); ?></title>
    <link rel="stylesheet" href="cssP3.css">
</head>
<body>
    <form action="enviarMensaje.php" method="post">
        <div class="container">
            <h1>Chat con <?php echo htmlspecialchars($recibe_alias); ?></h1>
            <div class="chat-messages">
                <!-- Muestra cada mensaje del chat -->
                <?php foreach ($result as $row) { ?>
                    <p><strong><?php echo htmlspecialchars($row['envia_alias']); ?>:</strong> <?php echo htmlspecialchars($row['mensaje']); ?> <em>(<?php echo $row['hora_envio']; ?>)</em></p>
                <?php } ?>
            </div>
            <input type="hidden" name="recibe_alias" value="<?php echo htmlspecialchars($recibe_alias); ?>">
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" required></textarea>    
            <button type="submit">Enviar Mensaje</button>
        </div>
    </form>
</body>
</html>

<?php
$conn = null;
?>
