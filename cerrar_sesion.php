<?php
// Inicia la sesión
session_start();

// Destruye todas las variables de sesión
session_destroy();

// Redirige al usuario a administrador.php
header("Location: administrador.php");
exit(); // Asegura que el código siguiente no se ejecute después de la redirección
?>
