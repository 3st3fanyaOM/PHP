<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['email'])) {
    // Si no está autenticado, redirigirlo al login
    header("Location: login.html");
    exit();
}

// Verificar si el carrito tiene productos
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<p>Tu carrito está vacío.</p>";
    echo "<a href='index.php'>Ver productos</a><br>";
    exit();
}

// Obtener el total de la sesión
if (!isset($_SESSION['total'])) {
    echo "<p>Error: No se encontró el total de la compra.</p>";
    echo "<a href='carrito.php'>Volver al carrito</a><br>";
    exit();
}

$total = $_SESSION['total'];

// Mostrar la factura
include '../includes/header.php';
echo "<h2>Factura de Compra</h2>";
echo "<table border='1'>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>";
    foreach ($_SESSION['carrito'] as $producto) {
        $subtotal = $producto['precio'] * $producto['cantidad'];
        echo "<tr>
            <td>{$producto['nombre']}</td>
            <td>{$producto['precio']}€</td>
            <td>{$producto['cantidad']}</td>
            <td>{$subtotal}€</td>
        </tr>";
    }
    
    echo "</tbody></table>";
    
    echo "<h3>Total de la compra: {$total}€</h3>";
    echo "<p>Gracias por su compra, {$_SESSION['email']}.</p>";

// Limpiar el carrito
unset($_SESSION['carrito']);  // Elimina el carrito de la sesión

// Cerrar la sesión del usuario
session_unset();  // Elimina todas las variables de sesión
session_destroy();  // Destruye la sesión

 include '../includes/footer.php'; ?>
