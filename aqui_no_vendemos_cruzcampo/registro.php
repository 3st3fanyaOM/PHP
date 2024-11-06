<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
<?php
// Inicializar variables
$errores = "";
error_reporting(0);

// Validación de los campos del formulario
if (trim($_REQUEST['marca']) === "") {
    $errores .= "<li>Se requiere marca</li>";
}
if (trim($_REQUEST['advertencia']) === "") {
    $errores .= "<li>Se requiere la advertencia sobre el abuso del consumo de alcohol</li>";
}
if (trim($_REQUEST['fechacaducidad']) === "") {
    $errores .= "<li>Se requiere fecha</li>";
}
if (empty($_REQUEST['alergenos'])) {
    $errores .= "<li>Es obligatorio incluir alérgenos</li>";
}

// Si existen errores, mostrar el listado de errores
if ($errores != "") {
    echo "<p>No se ha insertado el producto debido a los siguientes errores:</p>\n";
    echo "<ul>$errores</ul>";
} else {
    // Mostrar los datos del formulario
    echo "Tipo: " . htmlspecialchars($_REQUEST['tipo']) . '<br>';
    echo "Envase: " . htmlspecialchars($_REQUEST['envase']) . '<br>';
    echo "Denominación: " . htmlspecialchars($_REQUEST['denominacion']) . '<br>';
    echo "Cantidad: " . htmlspecialchars($_REQUEST['cantidad']) . '<br>';
    echo "Marca: " . htmlspecialchars($_REQUEST['marca']) . '<br>';
    echo "Advertencia: " . htmlspecialchars($_REQUEST['advertencia']) . '<br>';
    echo "Fecha caducidad: " . htmlspecialchars($_REQUEST['fechacaducidad']) . '<br>';

    // Mostrar los alérgenos seleccionados
    $alergenos = $_REQUEST['alergenos'] ?? [];
    if (!empty($alergenos)) {
        echo "Alérgenos: ";
        foreach ($alergenos as $alergeno) {
            echo htmlspecialchars($alergeno) . " ";
        }
    } else {
        echo "No se han incluido alérgenos.<br>";
    }

    echo "<br>";
    echo "Observaciones: " . htmlspecialchars($_REQUEST['observaciones']) . '<br>';
}

// Mensajes de error para la carga de archivos
$msgError = array(
    0 => 'El archivo ha subido correctamente',
    1 => 'Excede el tamaño máximo del sistema',
    2 => 'Excede el tamaño máximo especificado',
    3 => 'El archivo no se ha subido completamente',
    4 => 'No se ha subido el archivo',
    6 => 'La carpeta temporal no existe',
    7 => 'Fallo al escribir en el disco',
    8 => 'Una extensión PHP ha detenido la descarga',
);

// Validación del tipo de imagen
if ($_FILES["foto"]["error"] == 0) {
    if (!in_array($_FILES["foto"]["type"], ["image/gif", "image/jpeg", "image/jpg", "image/png"])) {
        echo "<p>El formato no es un formato de imagen correcto.</p>";
    } else {
        // Verificar si hay un error con el archivo
        if ($_FILES["foto"]["error"] > 0) {
            echo "Error: " . $msgError[$_FILES["foto"]["error"]] . "<br />";
        } else {
            // Verificar si el archivo ya existe en el servidor
            if (file_exists("upload/" . $_FILES["foto"]["name"])) {
                echo $_FILES["foto"]["name"] . " ya existe";
            } else {
                // Mover el archivo subido a la carpeta "upload"
                move_uploaded_file($_FILES["foto"]["tmp_name"], "upload/" . $_FILES["foto"]["name"]);
                echo "Almacenado en: " . "upload/" . $_FILES["foto"]["name"];
                echo "<p><img src='upload/" . $_FILES['foto']['name'] . "' /></p>";
                echo "Nombre original: " . $_FILES["foto"]["name"] . "<br />";
                echo "Tipo: " . $_FILES["foto"]["type"] . "<br />";
                echo "Tamaño: " . ceil($_FILES["foto"]["size"] / 1024) . " Kb<br />";
                echo "Nombre temporal: " . $_FILES["foto"]["tmp_name"] . "<br />";
            }
        }
    }
} else {
    echo "<p>No se ha subido el archivo.</p>";
}

// Enlace para insertar otra cerveza
echo "<p> [<a href='index.html'>Insertar otra cerveza</a>]</p>";
?>
</body>
</html>