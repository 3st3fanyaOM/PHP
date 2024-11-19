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

// Verificar si hay resultados
if ($result && $result->num_rows > 0) {
    echo "<h2>Lista de usuarios:</h2><br><br>";
    while ($usuario = $result->fetch_assoc()) {
        echo "ID: " . $usuario['id'] . "<br>";
        echo "Nombre: " . $usuario['nombre'] . "<br>";
        echo "Apellidos: " . $usuario['apellidos'] . "<br>";
        echo "DNI: " . $usuario['dni'] . "<br>";
        echo "Ruta de foto: " . $usuario['foto'] . "<br>";
        echo "Usuario: " . $usuario['usuario'] . "<br>";
        echo "Contraseña: " . $usuario['contrasenia'] . "<br><br>";
    }
} else {
    echo "No se encontraron usuarios.<br>";
}


// Cerrar la conexión
mysqli_close($con);
echo "<br><p> [<a href='index.php'>Volver al menú</a>]</p>";
?>