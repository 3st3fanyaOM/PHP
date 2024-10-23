<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <?php

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
        echo "Tipo: ".$_REQUEST['tipo'].'<br>';
        echo "Envase: ".$_REQUEST['envase'].'<br>';
        echo "Denominación: ".$_REQUEST['denominacion'].'<br>';
        echo "Cantidad: ".$_REQUEST['cantidad'].'<br>';
        echo "Marca: ".$_REQUEST['marca'].'<br>';
        echo "Advertencia: ".$_REQUEST['advertencia'].'<br>';
        echo "Fecha caducidad: ".$_REQUEST['fechacaducidad'].'<br>';
        $alergenos = $_REQUEST['alergenos']??[];
        if (!empty($alergenos)) {
            echo "Alérgenos: ";
            foreach ($alergenos as $alergeno) {
                echo htmlspecialchars($alergeno) . " ";
            }
        } else {
            echo "No se han incluido alérgenos.<br>";
        }
        echo "<br>";
        echo "Observaciones: ".$_REQUEST['observaciones'].'<br>';
    }
     
    ?>
</body>
</html>