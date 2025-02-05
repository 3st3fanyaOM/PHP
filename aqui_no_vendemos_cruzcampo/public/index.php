<?php
// Conectar a la base de datos
include("../includes/conexion.php");


// Consulta para obtener cervezas
$sql = "SELECT id_cerveza, denominacion, marca, tipo, formato, tamanio, alergenos, foto, precio FROM cervezas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CerveSol | Las mejores cervezas </title>
  
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../styles/home.css" />
</head>
<body>
<header>
      <nav>
        <div class="logo">
          <img src="../assets/prohibido.png" alt="" style="width:80px"/>
        </div>
        <div class="nav-links">
          <a href="login.php" class="login-btn">
            <i class="fas fa-user"></i>Iniciar Sesión
          </a>
        </div>
        <div class="nav-links">
          <a href="carrito.html" class="login-btn">
            <i class="fas fa-shopping-cart"></i>Carrito
          </a>
        </div>
      </nav>
    </header>
<table>
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Denominación</th>
            <th>Marca</th>
            <th>Tipo</th>
            <th>Formato</th>
            <th>Tamaño</th>
            <th>Alergenos</th>
            <th>Precio (€)</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td><img src='{$row["foto"]}' width='50' height='50' alt='Imagen de {$row["denominacion"]}'></td>
                    <td>{$row['denominacion']}</td>
                    <td>{$row['marca']}</td>
                    <td>{$row['tipo']}</td>
                    <td>{$row['formato']}</td>
                    <td>{$row['tamanio']}</td>
                    <td>{$row['alergenos']}</td>
                    <td>{$row['precio']}€</td>
                    <td>
                        <form action='carrito.php' method='POST'>
                            <input type='hidden' name='id_cerveza' value='{$row["id_cerveza"]}'>
                            <input type='hidden' name='denominacion' value='{$row["denominacion"]}'>
                            <input type='hidden' name='precio' value='{$row["precio"]}'>
                            <button type='submit'>Añadir al carrito</button>
                        </form>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No hay productos disponibles.</td></tr>";
        }
        ?>
    </tbody>
</table>
<footer>
      <p>
        © Tienda de cervezas. Todos los derechos reservados |
        <a href="#" target="_blank">Aviso Legal</a> |
        <a href="#" target="_blank">Buzón de sugerencias</a>
      </p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
