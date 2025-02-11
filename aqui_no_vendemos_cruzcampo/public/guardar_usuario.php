<?php
// Conectar a la base de datos
include("../includes/conexion.php");

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
       

        // Comprobar si el email ya existe en la base de datos
        $sql_check_email = "SELECT id_usuario FROM usuarios WHERE correo = '$email'";
        $result = $conn->query($sql_check_email);

        if ($result->num_rows > 0) {
            include '../includes/header.php';
            echo "El email ya está registrado.<br>";
            // Si el email ya existe, mostrar un mensaje de error
            echo "<br><p> [<a href='login.php'>Volver al login</a>]</p><br>";
            include '../includes/footer.php';
        } else {
            // Si el email no existe, proceder con el registro
            // Cifrar la contraseña
            $passwd = md5($password);
            $password_cifrado = crypt($password, $passwd);

            // Preparar la consulta SQL para insertar el nuevo usuario
            $sql = "INSERT INTO usuarios (correo, password, edad, perfil, password_sin) 
                    VALUES ('$email', '$password_cifrado', $age, 'usuario', '$password')";

            // Ejecutar la consulta
            if ($conn->query($sql) === TRUE) {
                include '../includes/header.php';
                echo "Usuario registrado con éxito";
                echo "<br><p> [<a href='index.php'>Volver al catálogo</a>]</p><br>";
                include '../includes/footer.php';
            } else {
                echo "Error al registrar el usuario: " . $conn->error . "<br>";
            }
        }
    }
}

// Cerrar la conexión
$conn->close();
?>