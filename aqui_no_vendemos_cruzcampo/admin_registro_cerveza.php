<?php
    // Conectar a la base de datos
    include("conexion.php");

    // Inicializar variables
    $denominacion = $_POST['denominacion'] ?? '';
    $marca = $_POST['marca'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $formato = $_POST['formato'] ?? '';
    $tamanio = $_POST['tamanio'] ?? '';
    $alergenos = $_POST["alergenos"] ?? [];
    $fechacaducidad = $_POST["fechacaducidad"] ?? '';
    $foto = $_FILES["foto"] ?? null;
    $observaciones = $_POST['observaciones'] ?? '';
    $precio = $_POST['precio'] ?? '';

    // inicializo errores
    $errores = [];


    // Validación de los campos del formulario
    if (trim($denominacion) === "") {
        $errores .= "<li>Se requiere denominacion</li>";
    }
    if (trim($marca) === "") {
        $errores .= "<li>Se requiere marca</li>";
    }
    if (trim($tipo) === "") {
        $errores .= "<li>Se requiere tipo</li>";
    }
    if (trim($formato) === "") {
        $errores .= "<li>Se requiere formato</li>";
    }
    if (empty($tamanio)) {
        $errores .= "<li>Es obligatorio incluir tamaño</li>";
    }

    // Validar alergenos
    if (empty($alergenos)) {
        $errores[] = "Debe seleccionar al menos un alérgeno.";
    } else {
        $alergenos = array_map('htmlspecialchars', $alergenos); 
        $alergenos = implode(", ", $alergenos); 
    }

    // Validar fecha de caducidad
    $fechacaducidad = $fechacaducidad ?? '';
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $fechacaducidad)) {
        $errores[] = "El campo 'Fecha de caducidad' es obligatorio y debe ser una fecha válida (YYYY-MM-DD).";
    }

    // Validar archivo "foto" (obligatorio)
    if ($foto && $foto["error"] === UPLOAD_ERR_OK) {
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

    if (trim($precio) === "") {
        $errores .= "<li>Se requiere precio</li>";
    }
    if (trim($observaciones) === "") {
        $errores .= "<li>Se requieren observaciones</li>";
    }

    // Si existen errores, mostrar el listado de errores
    if (!empty($errores)) {
        echo "<p>No se ha insertado el producto debido a los siguientes errores:</p>\n";
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    } else {
         // Inserción en la base de datos
        $sql = "INSERT INTO cervezas (denominacion, marca, tipo, formato, tamanio, alergenos, fecha, foto, precio, observaciones)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", $denominacion, $marca, $tipo, $formato, $tamanio, $alergenos, $fechacaducidad, $rutaArchivo, $precio, $observaciones);

        if ($stmt->execute()) {
        echo "Cerveza insertada correctamente.";
        } else {
        echo "Error al insertar el registro: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();

        // Mostrar los datos del formulario
        echo "<p class='success'>Datos insertados correctamente:</p>";
        echo "Denominación: " . htmlspecialchars($_REQUEST['denominacion']) . '<br>';
        echo "Marca: " . htmlspecialchars($_REQUEST['marca']) . '<br>';
        echo "Tipo: " . htmlspecialchars($_REQUEST['tipo']) . '<br>';
        echo "Formato: " . htmlspecialchars($_REQUEST['formato']) . '<br>';
        echo "Fecha caducidad: " . htmlspecialchars($_REQUEST['fechacaducidad']) . '<br>';
        echo "Foto: " . htmlspecialchars($rutaArchivo) . '<br>';
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

   
    // Enlace para insertar otra cerveza
    echo "<p> [<a href='admin_insertar_cerveza.html'>Insertar otra cerveza</a>]</p>";
    echo "<p> [<a href='admin_menu.html'>Menú administrador</a>]</p>";
    ?>