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
if (trim($_REQUEST['denominacion']) === "") {
    $errores .= "<li>Se requiere denominacion</li>";
}
if (trim($_REQUEST['marca']) === "") {
    $errores .= "<li>Se requiere marca</li>";
}
if (trim($_REQUEST['tipo']) === "") {
    $errores .= "<li>Se requiere tipo</li>";
}
if (trim($_REQUEST['formato']) === "") {
    $errores .= "<li>Se requiere formato</li>";
}
if (empty($_REQUEST['tamanio'])) {
    $errores .= "<li>Es obligatorio incluir tamaño</li>";
}
$alergenos = $_REQUEST["alergenos"] ?? [];
if (empty($alergenos)) {
    $errores[] = "Debe seleccionar al menos un alérgeno.";
} else {
    $alergenos = array_map('htmlspecialchars', $alergenos); // Limpieza básica
    $alergenos = implode(", ", $alergenos); // Convertir en texto para almacenar
}
$fechacaducidad = $_REQUEST["fechacaducidad"] ?? '';
if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $fechacaducidad)) {
    $errores[] = "El campo 'Fecha de caducidad' es obligatorio y debe ser una fecha válida (YYYY-MM-DD).";
}

// Validar archivo "foto" (obligatorio)
    $foto = "";
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
        $directorioUploads = "uploads/";
        $nombreArchivo = basename($_FILES["foto"]["name"]);
        $rutaArchivo = $directorioUploads . $nombreArchivo;

        // Validar tipo de archivo
        $tipoArchivo = mime_content_type($_FILES["foto"]["tmp_name"]);
        $formatosPermitidos = ["image/jpeg", "image/png", "image/gif"];
        if (!in_array($tipoArchivo, $formatosPermitidos)) {
            $errores[] = "El archivo subido debe ser una imagen válida (JPG, PNG o GIF).";
        } else {
            // Mover archivo
            if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $rutaArchivo)) {
                $errores[] = "No se pudo guardar el archivo de imagen.";
            } else {
                $foto = $rutaArchivo;
            }
        }
    } else {
        $errores[] = "El campo 'Archivo' es obligatorio.";
    }
if (trim($_REQUEST['precio']) === "") {
    $errores .= "<li>Se requiere precio</li>";
}
if (trim($_REQUEST['observaciones']) === "") {
    $errores .= "<li>Se requieren observaciones</li>";
}

// Si existen errores, mostrar el listado de errores
if ($errores != "") {
    echo "<p>No se ha insertado el producto debido a los siguientes errores:</p>\n";
    echo "<ul>$errores</ul>";
} else {
    // Mostrar los datos del formulario
    echo "<p class='success'>Datos insertados correctamente:</p>";
    echo "Denominación: " . htmlspecialchars($_REQUEST['denominacion']) . '<br>';
    echo "Marca: " . htmlspecialchars($_REQUEST['marca']) . '<br>';
    echo "Tipo: " . htmlspecialchars($_REQUEST['tipo']) . '<br>';
    echo "Formato: " . htmlspecialchars($_REQUEST['formato']) . '<br>';
    echo "Fecha caducidad: " . htmlspecialchars($_REQUEST['fechacaducidad']) . '<br>';
    echo "Foto: " . htmlspecialchars($_REQUEST['foto']) . '<br>';
    echo "Precio: " . htmlspecialchars($_REQUEST['precio']) . '<br>';


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
$uploadDir = "upload/";
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
    $allowedTypes = ["image/gif", "image/jpeg", "image/jpg", "image/png"];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if (!in_array($_FILES["foto"]["type"], $allowedTypes)) {
        echo "<p>El formato no es un formato de imagen correcto.</p>";
        } elseif ($_FILES["foto"]["size"] > $maxSize) {
        echo "<p class='error'>El archivo excede el tamaño máximo permitido de 2MB.</p>";
        } else {
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $uniqueName = uniqid() . "_" . basename($_FILES["foto"]["name"]);
            $targetFile = $uploadDir . $uniqueName;
    
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
                echo "<p class='success'>Archivo subido correctamente:</p>";
                echo "<img src='$targetFile' alt='Imagen subida'>";
                echo "<br><strong>Nombre original:</strong> " . htmlspecialchars($_FILES["foto"]["name"]);
                echo "<br><strong>Tipo:</strong> " . htmlspecialchars($_FILES["foto"]["type"]);
                echo "<br><strong>Tamaño:</strong> " . ceil($_FILES["foto"]["size"] / 1024) . " KB";
            } else {
                echo "<p class='error'>Error al mover el archivo al servidor.</p>";
            }
    }
} else {
    echo "<p class='error'>" . $msgError[$_FILES["foto"]["error"]] . "</p>";
}

// Inserción en la base de datos
$sql = "INSERT INTO cervezas (denominacion, marca, tipo, formato, tamanio, alergenos, fecha, foto, precio, observaciones)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssss", $denominacion, $marca, $tipo, $formato, $tamanio, $alergenos, $fechacaducidad, $foto, $precio, $observaciones);

if ($stmt->execute()) {
echo "Cerveza insertada correctamente.";
} else {
echo "Error al insertar el registro: " . $stmt->error;
}

$stmt->close();
$conn->close();
// Enlace para insertar otra cerveza
echo "<p> [<a href='index.html'>Insertar otra cerveza</a>]</p>";
?>
</body>
</html>