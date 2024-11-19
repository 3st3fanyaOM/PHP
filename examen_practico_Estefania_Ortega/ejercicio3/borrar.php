<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Usuario</title>
</head>
<body>
    <h1>Borrar Usuario</h1>
    <form method="POST" action="">
        <label for="id">ID del Usuario a Borrar:</label>
        <input type="text" id="id" name="id" required>
        <input type="submit" value="Borrar Usuario">
    </form>
    <?php
//conectarse a la base de datos
$con = mysqli_connect("localhost:3307", "root", "", "usuarios");

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "No se ha conectado a la base de datos: " . mysqli_connect_error();
    exit(); 
}

// Consulta para obtener usuarios
$sql = "SELECT id, nombre, apellidos, dni, foto, usuario, contrasenia FROM usuarios";
$result = $con->query($sql);

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el ID
    $id = $_POST['id'];

    // Validar que el ID sea un número
    if (is_numeric($id)) {
        // Consulta para borrar el usuario por su ID
        $sql = "DELETE FROM usuarios WHERE id = $id";

        // Ejecutar la consulta
        if ($con->query($sql) === TRUE) {
            echo "Usuario con ID $id ha sido borrado exitosamente.";
        } else {
            echo "Error al borrar el usuario: " . $conn->error;
        }
    } else {
        echo "Por favor, ingrese un ID válido.";
    }
}


// Cerrar la conexión
mysqli_close($con);
echo "<br><p> [<a href='index.php'>Volver al menú</a>]</p>";
?>
</body>
</html>