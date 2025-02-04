<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['email'])) {
    // Si no está autenticado, redirigirlo al login
    header("Location: login.html");
    exit();
}

// Limpiar el carrito
unset($_SESSION['carrito']);  // Elimina el carrito de la sesión

// Cerrar la sesión del usuario
session_unset();  // Elimina todas las variables de sesión
session_destroy();  // Destruye la sesión

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Realizada</title>
<link rel="stylesheet" href="./styles.home.css">
</head>
<body>
<header>
      <nav>
        <div class="logo">
          <img src="./assets/prohibido.png" alt="" style="width:80px"/>
        </div>
      </nav>
    </header>
<h1>¡Compra realizada con éxito!</h1>
<p>Gracias por tu compra. Hemos procesado tu pedido y hemos limpiado tu carrito.</p>
<p>Te hemos cerrado la sesión. Si deseas realizar otra compra, por favor, vuelve a iniciar sesión.</p>

<p><a href="index.php">Inicio</a></p>
<footer>
      <p>
        © Tienda de cervezas. Todos los derechos reservados |
        <a href="#" target="_blank">Aviso Legal</a> |
        <a href="#" target="_blank">Buzón de sugerencias</a>
      </p>
    </footer>
</body>
</html>
