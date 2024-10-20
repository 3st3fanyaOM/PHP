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

    if (trim($_REQUEST['marca'])=="")
        $errores=$errores."<li>Se requiere marca</li>";
    if (trim($_REQUEST['advertencia'])=="")
        $errores=$errores."<li>Se requiere la advertencia sobre el abuso del consumo de alcohol</li>";
    if (trim($_REQUEST['fecha'])=="")
        $errores=$errores."<li>Se requiere fecha</li>";
    if (!$_REQUEST['alergenos'])
        $errores=$errores."<li>Es obligatorio incluir alérgenos</li>";

    if($errores != ""){
        print ("<p>No se ha insertado el producto debido a los siguientes errores:</p>\n");
        print ("<ul>");
        print ($errores);
        print ("</ul>");
    } else {
        echo "Tipo: ".$_REQUEST['tipo'].'<br>';
        echo "Envase: ".$_REQUEST['envase'].'<br>';
        echo "Denominación: ".$_REQUEST['denominacion'].'<br>';
        echo "Cantidad: ".$_REQUEST['cantidad'].'<br>';
        echo "Marca: ".$_REQUEST['marca'].'<br>';
        echo "Advertencia: ".$_REQUEST['advertencia'].'<br>';
        echo "Fecha caducidad: ".$_REQUEST['fecha'].'<br>';
        echo "Alérgenos: ".$_REQUEST['alergenos'].'<br>';
        echo "Observaciones: ".$_REQUEST['observaciones'].'<br>';
    }
    
    ?>
</body>
</html>