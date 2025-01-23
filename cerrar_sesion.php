<?php
session_start();
// Elimina todos los datos de la sesion
session_destroy();
header("Location: loginHTML.html");
exit;
?>
