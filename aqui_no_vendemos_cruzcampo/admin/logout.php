<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();


// Destruir la sesión
session_destroy();

// Redirigir al usuario a página principal
header("Location: ../public/index.php");
exit();
?>