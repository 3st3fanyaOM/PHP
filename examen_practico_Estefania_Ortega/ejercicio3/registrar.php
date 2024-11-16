<?php
include config.php;

// Inicializar variables
$errores = "";
error_reporting(0);

// Validación de los campos del formulario
if (trim($_REQUEST['nombre']) === "") {
    $errores .= "<li>El campo nombre no puede estar vacio</li>";
}
if (trim($_REQUEST['apellidos']) === "") {
    $errores .= "<li>El campo apellidos no puede estar vacio</li>";
}
if (trim($_REQUEST['dni']) === "") {
    $errores .= "<li>El campo dni no puede estar vacio</li>";
}
// Validación del tipo de imagen
if ($_FILES["foto"]["error"] == 0) {
    if (!in_array($_FILES["foto"]["type"], ["image/gif", "image/jpeg", "image/jpg", "image/png"])) {
        echo "<p>El formato no es un formato de imagen correcto.</p>";
    } else {
        // Verificar si hay un error con el archivo
        if ($_FILES["foto"]["error"] > 0) {
            echo "<p>El archivo no se ha podido cargar</p><br />";
        } else {
            // Verificar si el archivo ya existe en el servidor
            if (file_exists("upload/" . $_FILES["foto"]["name"])) {
                echo $_FILES["foto"]["name"] . " ya existe";
            } else {
                // Mover el archivo subido a la carpeta "upload"
                move_uploaded_file($_FILES["foto"]["tmp_name"], "upload/" . $_FILES["foto"]["name"]);
            }
        }
    }
} else {
    echo "<p>No se ha subido el archivo.</p>";
}
if (empty($_REQUEST['usuario'])) {
    $errores .= "<li>Es obligatorio un nombre de usuario</li>";
}
if (empty($_REQUEST['contrasenia'])) {
    $errores .= "<li>Es obligatorio establecer una contraseñao</li>";
}

?>
