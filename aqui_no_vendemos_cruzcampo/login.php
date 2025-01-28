<?php
// Iniciar sesión
session_start();

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

// Comprobar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $email = $_POST['mail'];
    $input_password = $_POST['password'];

     // Depuración: Mostrar los datos que se reciben del formulario
     echo "Correo recibido: " . $email . "<br>";
     echo "Contraseña recibida (en texto claro): " . $input_password . "<br>";

    // Consulta para obtener el hash de la contraseña desde la base de datos
    $sql = "SELECT password, perfil FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    // Si el usuario existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password,$perfil);
        $stmt->fetch();
        
         // Depuración: Mostrar el hash almacenado en la base de datos
         echo "Hash almacenado en la base de datos: " . $hashed_password . "<br>";
        
        // Verificar si la contraseña proporcionada coincide con el hash almacenado
        if (password_verify($input_password, $hashed_password)) {

            // Contraseña correcta, redirigir a una página de éxito o dashboard
            echo "Contraseña verificada correctamente. Redirigiendo...<br>";
            // Contraseña correcta, redirigir a una página de éxito o dashboard
            $_SESSION['email'] = $email; // Guardar sesión si es necesario
            $_SESSION['perfil'] = $perfil; // Guardar perfil

            // Redirigir según el perfil
            if ($perfil === 'administrador') {
                header("Location: menu_admin.html"); // Página de administrador
            } elseif ($perfil=== 'usuario') {
                header("Location: index.html"); // Página de usuario
            } else {
                echo "Perfil desconocido. Comunícate con el administrador.";
            }
            exit(); 
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta. Intenta nuevamente.";
            echo "<br><p> [<a href='login.html'>Volver al login</a>]</p><br>";
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
