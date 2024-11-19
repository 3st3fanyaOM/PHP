<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
</head>
<body>
    <h1>Modificar Usuario</h1>

    <!-- Formulario para editar usuario -->
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
        <br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($usuario['apellidos']); ?>" required>
        <br>
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" value="<?php echo htmlspecialchars($usuario['dni']); ?>" required>
        <br>
        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" value="<?php echo htmlspecialchars($usuario['foto']); ?>" required>
        <br>
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($usuario['usuario']); ?>" required>
        <br>
        <label for="contrasenia">Contraseña:</label>
        <input type="password" id="contrasenia" name="contrasenia" value="<?php echo htmlspecialchars($usuario['contrasenia']); ?>" required>
        <br>
        <input type="submit" value="Actualizar Usuario">
    </form>

</body>
<?php
$con = mysqli_connect("localhost:3307", "root", "", "usuarios");

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "No se ha conectado a la base de datos: " . mysqli_connect_error();
    exit(); 
}

// Verificar si el ID ha sido pasado en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obtener los datos actuales del usuario
    $sql = "SELECT nombre, apellidos, dni, foto, usuario, contrasenia FROM usuarios WHERE id = $id";
    $result = $con->query($sql);

    // Verificar si se encontró el usuario
    if ($result && $result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        echo "Usuario no encontrado.";
        exit();
    }
}

// Verificar si se ha enviado el formulario para modificar el usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    // Obtener los valores del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $foto = $_POST['foto'];
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($apellidos) && !empty($dni) && !empty($foto) && !empty($usuario) &&!empty($contrasenia) ) {
        // Consulta para actualizar el usuario
        $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos',dni = '$dni', foto = '$foto',usuario = '$usuario', contrasenia = '$contrasenia' WHERE id = $id";

        // Ejecutar la consulta
        if ($con->query($sql) === TRUE) {
            echo "Usuario con ID $id ha sido actualizado exitosamente.";
        } else {
            echo "Error al actualizar el usuario: " . $con->error;
        }
    } else {
        echo "Por favor, ingrese datos válidos.";
    }
}


// Cerrar la conexión
mysqli_close($con);
echo "<br><p> [<a href='index.php'>Volver al menú</a>]</p>";
?>
</html>









