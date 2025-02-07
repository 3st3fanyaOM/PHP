<?php
// Iniciar sesión
session_start();

// Conectar a la base de datos
include("../includes/conexion.php");


// Comprobar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $email = $_POST['mail'];
    $input_password = $_POST['password'];


    // Consulta para obtener el hash de la contraseña desde la base de datos
    $sql = "SELECT id_usuario, password, perfil FROM usuarios WHERE correo = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    // Si el usuario existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario, $hashed_password, $perfil);
        echo $hashed_password;
        $stmt->fetch();

        // Verificar si la contraseña proporcionada coincide con el hash almacenado
        if (password_verify($input_password, $hashed_password)) {

            // Contraseña correcta, redirigir a una página de éxito o dashboard
            $_SESSION['email'] = $email; // Guardar sesión si es necesario
            $_SESSION['perfil'] = $perfil; // Guardar perfil
            $_SESSION['id_usuario'] = $id_usuario;  // Guardar id del usuario


            // Redirigir según el perfils
            if ($perfil === 'administrador') {
                header("Location: ../admin/admin_menu.php"); // Página de administrador
            } elseif ($perfil=== 'usuario') {
                header("Location: carrito.php"); // Página de usuario
            } else {
                echo "Perfil desconocido. Comunícate con el administrador.";
            }
            exit(); 
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta. Intenta nuevamente.";
            echo "<br><p> [<a href='login.php'>Volver al login</a>]</p><br>";
        }
    } else {
        // Usuario no encontrado
        echo "No se encontró el usuario. Verifica tu correo electrónico.";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
