<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Usuario</title>
</head>
<body>
    <h1>Buscar Usuario para Modificar</h1>
    <!-- Formulario para obtener el ID del usuario -->
    <form method="POST" action="">
        <label for="id_usuario">ID del Usuario:</label>
        <input type="text" id="id_usuario" name="id_usuario" required>
        <input type="submit" value="Buscar Usuario">
    </form>
</body>
<?php
$con = mysqli_connect("localhost:3307", "root", "", "usuarios");

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "No se ha conectado a la base de datos: " . mysqli_connect_error();
    exit(); 
}

// Verificar si se ha enviado el formulario para buscar el usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el ID desde el formulario
    $id = $_POST['id_usuario'];

    // Validar que el ID sea numérico
    if (is_numeric($id)) {
        // Consulta para verificar si el usuario existe
        $sql = "SELECT id FROM usuarios WHERE id = $id";
        $result = $con->query($sql);

        // Si el usuario existe, redirigir a la página de edición
        if ($result && $result->num_rows > 0) {
            //si verifica el id redirige a otra página donde modifica el usuario
            header("Location: modificar_usuario.php?id=$id");//pasa el id por url
            exit();
        } else {
            echo "Usuario no encontrado.";
        }
    } else {
        echo "Por favor, ingrese un ID válido.";
    }
}


// Cerrar la conexión
mysqli_close($con);
?>
</html>
