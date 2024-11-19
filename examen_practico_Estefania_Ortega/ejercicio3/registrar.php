<?php
$con = mysqli_connect("localhost:3307", "root", "", "usuarios");

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "No se ha conectado a la base de datos: " . mysqli_connect_error();
    exit(); 
}

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$foto = $_FILES['foto'];
$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];

// Validación de los campos
$errores = [];

// Validar que nombre no este vacío y no contenga números
if (empty($nombre) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombre)) {
    $errores[] = "El nombre debe contener solo letras y espacios.";
}

// Validar que apellidos no este vacío y no contenga números
if (empty($apellidos) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $apellidos)) {
    $errores[] = "Los apellidos deben contener solo letras y espacios.";
}

// Validar que dni tenga 8 numeros y una letra
if (empty($dni) || !preg_match("/^[0-9]{8}[A-Za-z]$/", $dni)) {
    $errores[] = "El DNI debe tener 8 dígitos seguidos de una letra.";
}

// Validar que usuario no este vacío y contenga más de 5 letras
if (empty($usuario) || strlen($usuario) < 5 || strlen($usuario) > 20) {
    $errores[] = "El usuario debe tener entre 5 y 20 caracteres.";
}

// Validar que contraseña no este vacío y sea mayor de 6 carácteres
if (empty($contrasenia) || strlen($contrasenia) < 6) {
    $errores[] = "La contraseña debe tener al menos 6 caracteres.";
}

// Validar que la foto sea el archivo y tamaño correcto
if ($_FILES['foto']['error'] == UPLOAD_ERR_OK) {
    $tipo_imagen = $_FILES['foto']['type'];
    $tamano_imagen = $_FILES['foto']['size'];

    // Limitar el tamaño
    if ($tamano_imagen > 2097152) {
        $errores[] = "La foto debe ser menor a 2 MB.";
    }

    // Verificar el tipo de archivo
    if (!in_array($tipo_imagen, ['image/jpeg', 'image/png', 'image/gif'])) {
        $errores[] = "La foto debe ser una imagen en formato JPG, PNG o GIF.";
    }
} else {
    $errores[] = "Debes cargar una foto.";
}

// Si hay errores, los mostramos
if (!empty($errores)) {
    foreach ($errores as $error) {
        echo "<p>$error</p>";
    }
    exit(); // Detener el script si hay errores
}

// Si no hay errores, procesamos los datos
$foto_nombre = $_FILES['foto']['name'];
$foto_tmp = $_FILES['foto']['tmp_name'];
$foto_destino = "uploads/" . $foto_nombre; // Guardar la foto en la carpeta "uploads"
move_uploaded_file($foto_tmp, $foto_destino);

//consulta para insercción
$sql = "INSERT INTO usuarios (nombre,apellidos,dni,foto,usuario,contrasenia) VALUES ('$nombre','$apellidos','$dni','$foto_destino','$usuario','$contrasenia')";

//ejecución de la consulta
if (mysqli_query($con, $sql)) {
    echo "Usuario registrado correctamente.";
} else {
    echo "Error: " . mysqli_error($con);
}

// Cerrar la conexión
mysqli_close($con);
echo "<br><p> [<a href='formulario.php'>Insertar nuevo usuario</a>]</p><br>";
echo "<br><p> [<a href='index.php'>Volver al menú</a>]</p>";
?>
