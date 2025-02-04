<?php
$conn = mysqli_connect("localhost:3307", "root", "", "daw");

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "No se ha conectado a la base de datos: " . mysqli_connect_error();
    exit(); 
}
?>