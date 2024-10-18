<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <?php
    echo "Tipo: ".$_REQUEST['tipo'].'<br>';
    echo "Envase: ".$_REQUEST['envase'].'<br>';
    echo "Cantidad: ".$_REQUEST['cantidad'].'<br>';
    if (isset($_REQUEST['marca'])){
        print "<p>Se requiere marca</p>";
    } else {
        print "<p>Marca: ".$_REQUEST['marca'].'<br>';
       }
    if (isset($_REQUEST['advertencia'])){
        print "<p>Es obligatoria la advertencia sobre el abuso del consumo de alcohol</p>";
    } else {
        print "<p>Advertencia: ".$_REQUEST['advertencia'].'<br>';
       }
    if (isset($_REQUEST['marca'])){
        print "<p>No ha introducido fecha</p>";
    } else {
        print "<p>Fecha caducidad: ".$_REQUEST['marca'].'<br>';
    }
    if (isset($_REQUEST['alergenos'])){
        print "<p>Es obligatorio incluir alérgenos</p>";
    } else {
        print "<p>Alérgenos: ".$_REQUEST['alergenos'].'<br>';
    }
    echo "Observaciones: ".$_REQUEST['observaciones'].'<br>';
    ?>
</body>
</html>