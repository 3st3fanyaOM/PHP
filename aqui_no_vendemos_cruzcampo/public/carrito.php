<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");  // Redirigir al login si no está autenticado
    exit();
}

// Verificar si se está añadiendo un producto al carrito
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        // Añadir producto al carrito
        $id_producto = $_POST['id_cerveza'];
        $nombre = $_POST['denominacion'];
        $precio = $_POST['precio'];

        // Si no existe el carrito en la sesión, crear uno
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Verificar si el producto ya está en el carrito
        $productoExistente = false;
        foreach ($_SESSION['carrito'] as &$producto) {
            if ($producto['id'] == $id_producto) {
                // Si el producto ya existe, aumentar la cantidad
                $producto['cantidad'] += 1;
                $productoExistente = true;
                break;
            }
        }

        // Si el producto no existe, agregarlo al carrito
        if (!$productoExistente) {
            $_SESSION['carrito'][] = [
                'id' => $id_producto,
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => 1
            ];
        }

        // Redirigir al carrito después de añadir el producto
        header("Location: carrito.php");
        exit();
    } elseif ($_POST['action'] == 'remove') {
        // Eliminar una unidad del carrito
        $id_producto = $_POST['id_cerveza'];

        // Buscar el producto en el carrito
        foreach ($_SESSION['carrito'] as $key => &$producto) {
            if ($producto['id'] == $id_producto) {
                if ($producto['cantidad'] > 1) {
                    $producto['cantidad'] -= 1; // Reducir la cantidad
                } else {
                    unset($_SESSION['carrito'][$key]); // Eliminar el producto si cantidad es 1
                }
                break;
            }
        }

        // Redirigir al carrito después de eliminar el producto
        header("Location: carrito.php");
        exit();
    }
}
?>

<?php
include '../includes/header.php';
// Verificar si el carrito tiene productos
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<p>Tu carrito está vacío.</p>";
    echo "<a href='index.php'>Ver productos</a><br>";
} else {
    echo "<table border='1'>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>";

    $total = 0;
    foreach ($_SESSION['carrito'] as $producto) {
        $subtotal = $producto['precio'] * $producto['cantidad'];
        $total += $subtotal;

        echo "<tr>
            <td>{$producto['nombre']}</td>
            <td>{$producto['precio']}€</td>
            <td>{$producto['cantidad']}</td>
            <td>{$subtotal}€</td>
            <td>
                <form action='carrito.php' method='POST'>
                    <input type='hidden' name='id_cerveza' value='{$producto['id']}'>
                    <input type='hidden' name='action' value='remove'>
                    <button type='submit'>Eliminar</button>
                </form>
            </td>
        </tr>";
    }

    echo "</tbody></table>";

    echo "<h3>Total: {$total}€</h3>";
    echo "<a href='index.php'>Seguir comprando</a><br>";
    echo "<a href='usuario_procesar_pedido.php'>Finalizar compra</a>";
}
include '../includes/footer.php';
?>
