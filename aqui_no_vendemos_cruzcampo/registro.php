
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8_unicode">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <?php
    header("Content-Type: text/html; charset=UTF-8_encode");
    $errores="";
    error_reporting(0);
    if (trim($_REQUEST['marca']) === "") {
    $errores.= "<li>Se requiere marca</li>";
    }
    if (trim($_REQUEST['advertencia']) === "") {
    $errores.= "<li>Se requiere la advertencia sobre el abuso del consumo de alcohol</li>";
    }
    if (trim($_REQUEST['fechacaducidad']) === "") {
    $errores.= "<li>Se requiere fecha</li>";
    }
    if (empty($_REQUEST['alergenos'])) {
    $errores.= "<li>Es obligatorio incluir alérgenos</li>";
    }

    if($errores != ""){
        print ("<p>No se ha insertado el producto debido a los siguientes errores:</p>\n");
        print ("<ul>$errores</ul>");
    } else {
        print "Tipo: ".$_REQUEST['tipo'].'<br>';
        print "Envase: ".$_REQUEST['envase'].'<br>';
        print "Denominación: ".$_REQUEST['denominacion'].'<br>';
        print "Cantidad: ".$_REQUEST['cantidad'].'<br>';
        print "Marca: ".$_REQUEST['marca'].'<br>';
        print "Advertencia: ".$_REQUEST['advertencia'].'<br>';
        print "Fecha caducidad: ".$_REQUEST['fechacaducidad'].'<br>';
        $alergenos = $_REQUEST['alergenos']??[];
        if (!empty($alergenos)) {
            print "Alérgenos: ";
            foreach ($alergenos as $alergeno) {
                print htmlspecialchars($alergeno) . " ";
            }
        } else {
            print "No se han incluido alérgenos.<br>";
        }
        print "<br>";
        print "Observaciones: ".$_REQUEST['observaciones'].'<br>';
    }
    $msgError = array(
        0 => 'El archivo de ha subido correctamente',
        1 => 'Excede el tamaño máximo del sistema',
        2 => 'Excede el tamaño máximo especificado',
        3 => 'El archivo no se ha subido completamente',
        4 => 'No se ha subido el archivo',
        6 => 'La carpeta temporal no existe',
        7 => 'Fallo al escribir en el disco',
        8 => 'Una extensión PHP ha detenido la descarga',
    );
 
    if(($_FILES["foto"]["type"]!="gif") || ($_FILES["foto"]["type"]!="jpeg") ||($_FILES["foto"]["type"]!="jpg") || ($_FILES["foto"]["type"]!="png")){
        print "<p>El formato no es un formato de imagen correcto.</p>";
    }
    else{
        if($_FILES["foto"]["error"] > 0)
    {
        print "Error: " . $msgError[$_FILES["foto"]["error"]] . "<br />";
    }
    else
    {
        
    if(file_exists("upload/" . $_FILES["foto"]["name"]))
    {
        print $_FILES["foto"]["name"] . " ya existe";
    }
    else
    {
        move_uploaded_file($_FILES["foto"]["tmp_name"],
            "upload/" . $_FILES["foto"]["name"]);
 
        print "Almacenado en: " . "upload/" . $_FILES["foto"]["name"];
        print "<p><img src='upload/' ". $_FILES['foto']['name']."/></p>";
        print "Nombre original: " . $_FILES["foto"]["name"] . "<br />";
        print "Tipo: " . $_FILES["foto"]["type"] . "<br />";
        print "Tamaño: " . ceil($_FILES["foto"]["size"] / 1024) . " Kb<br />";
        print "Nombre temporal: " . $_FILES["foto"]["tmp_name"] . "<br />";
    }
    }
    }
    
    print ("<p> [<a href= 'index.html'>Insertar otra cerveza</a>]</p>");
     
    ?>
</body>
</html>