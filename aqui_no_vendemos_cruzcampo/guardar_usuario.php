<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "daw";

$conn = mysqli_connect("localhost:3307", "root", "", "daw");

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "No se ha conectado a la base de datos: " . mysqli_connect_error();
    exit(); 
}

// Variables para los mensajes de error
$email_error = $password_error = $age_error = "";
$email = $password = $age = "";

// Comprobar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recoger datos del formulario y sanitizarlos
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $age = (int) $_POST['age'];

    // usu_validación: Ningún campo debe estar vacío
    $usu_valido = true;

    if (empty($email)) {
        $email_error = "El email es obligatorio.";
        $usu_valido = false;
    }

    if (empty($password)) {
        $password_error = "La contraseña es obligatoria.";
        $usu_valido = false;
    }

    if (empty($age)) {
        $age_error = "La edad es obligatoria.";
        $usu_valido = false;
    }

    if ($usu_valido) {
        // Cifrar la contraseña
        $password_cifrado = password_hash($password, PASSWORD_BCRYPT);

        // Preparar la consulta SQL
        $sql = "INSERT INTO usuarios (correo, password, edad, perfil, password_sin) 
                VALUES ('$email', '$password_cifrado', $age, 'usuario', '$password')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            echo "Usuario registrado con éxito";
            echo "<br><p> [<a href='index.html'>Volver al catálogo</a>]</p><br>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Cerrar la conexión
$conn->close();
?>