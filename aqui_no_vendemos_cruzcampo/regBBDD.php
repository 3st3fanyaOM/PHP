<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Conectar a la base de datos
    include("conexion.php");

    // Inicializar errores
    $errores = [];

    // Validar "tipo" (obligatorio)
    $tipo = $_POST["tipo"] ?? '';
    $tiposPermitidos = ["lager", "pale ale", "cerveza negra", "abadia", "rubia"];
    if (!in_array($tipo, $tiposPermitidos)) {
        $errores[] = "El campo 'Tipo de cerveza' es obligatorio y debe ser válido.";
    }
        echo $tipo;
    // Validar "denominacion" (obligatorio)
    $denominacion = $_POST["denominacion"] ?? '';
    $denominacionesPermitidas = ["botellin", "tercio", "1/2litro", "1litro", "lata"];
    if (!in_array($denominacion, $denominacionesPermitidas)) {
        $errores[] = "El campo 'Denominación' es obligatorio y debe ser válido.";
    }
    echo $denominacion;
    // Validar "envase" (obligatorio)
    $envase = $_POST["envase"] ?? '';
    $envasesPermitidos = ["Botellin", "Litro", "Lata", "Tercio"];
    if (!in_array($envase, $envasesPermitidos)) {
        $errores[] = "El campo 'Envase' es obligatorio y debe ser válido.";
    }
    echo $envase;
    // Validar "cantidad" (obligatorio)
    $cantidad = $_POST["cantidad"] ?? '';
    $cantidadesPermitidas = ["25cl", "33cl", "1litro", "1/2litro", "2litros", "barril"];
    if (!in_array($cantidad, $cantidadesPermitidas)) {
        $errores[] = "El campo 'Cantidad' es obligatorio y debe ser válido.";
    }
    echo $cantidad;
    // Validar "marca" (obligatorio)
    $marca = trim($_POST["marca"] ?? '');
    if (empty($marca)) {
        $errores[] = "El campo 'Marca' es obligatorio.";
    }
    echo $marca;
    // Validar "fechacaducidad" (obligatorio)
    $fechacaducidad = $_POST["fechacaducidad"] ?? '';
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $fechacaducidad)) {
        $errores[] = "El campo 'Fecha de caducidad' es obligatorio y debe ser una fecha válida (YYYY-MM-DD).";
    }
    echo $fechacaducidad;
    // Validar "alergenos" (obligatorio)
    $alergenos = $_POST["alergenos"] ?? [];
    if (empty($alergenos)) {
        $errores[] = "Debe seleccionar al menos un alérgeno.";
    } else {
        $alergenos = array_map('htmlspecialchars', $alergenos); // Limpieza básica
        $alergenos = implode(", ", $alergenos); // Convertir en texto para almacenar
    }
    echo $alergenos;
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

    // Si hay errores, mostrarlos y detener la ejecución
    if (!empty($errores)) {
        echo "Se encontraron los siguientes errores:<br>";
        foreach ($errores as $error) {
            echo "- " . htmlspecialchars($error) . "<br>";
        }
        exit;
    }

    // Inserción en la base de datos
    $sql = "INSERT INTO cervezas (tipo, denominacion, envase, cantidad, marca, fechacaducidad, alergenos, foto)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $tipo, $denominacion, $envase, $cantidad, $marca, $fechacaducidad, $alergenos, $foto);

    if ($stmt->execute()) {
        echo "Cerveza insertada correctamente.";
    } else {
        echo "Error al insertar el registro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
