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

<?php include '../includes/header.php'; ?>
<h1>¡Compra realizada con éxito!</h1>
<p>Gracias por tu compra.</p>
<p>Sesión cerrada</p>
<p> Si deseas realizar otra compra, por favor, vuelve a iniciar sesión.</p>

<p><a href="../public/index.php">Inicio</a></p>
<?php include '../includes/header.php'; ?>
