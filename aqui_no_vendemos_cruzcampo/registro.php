<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <?php

$erroresSubidaArchivo = array(
    0 => 'El archivo de ha subido correctamente',
    1 => 'Excede el tamaño máximo del sistema',
    2 => 'Excede el tamaño máximo especificado',
    3 => 'El archivo no se ha subido completamente',
    4 => 'No se ha subido el archivo',
    6 => 'La carpeta temporal no existe',
    7 => 'Fallo al escribir en el disco',
    8 => 'Una extensión PHP ha detenido la descarga',
);

if($_FILES["fichero"]["error"] > 0)
{
echo "Error: " . $msgError[$_FILES["fichero"]["error"]] . "<br />";
}
else
{
echo "Nombre original: " . $_FILES["fichero"]["name"] . "<br />";
echo "Tipo: " . $_FILES["fichero"]["type"] . "<br />";
echo "Tamaño: " . ceil($_FILES["fichero"]["size"] / 1024) . " Kb<br />";
echo "Nombre temporal: " . $_FILES["fichero"]["tmp_name"] . "<br />";
if(file_exists("upload/" . $_FILES["fichero"]["name"]))
{
echo $_FILES["fichero"]["name"] . " ya existe";
}
else
{
move_uploaded_file($_FILES["fichero"]["tmp_name"],
"upload/" . $_FILES["fichero"]["name"]);
 
echo "Almacenado en: " . "upload/" . $_FILES["fichero"]["name"];
}
}


    $errores="";
    error_reporting(0);
    if (trim($_REQUEST['marca'])=="")
        $errores=$errores."<li>Se requiere marca</li>";
    if (trim($_REQUEST['advertencia'])=="")
        $errores=$errores."<li>Se requiere la advertencia sobre el abuso del consumo de alcohol</li>";
    if (trim($_REQUEST['fechacaducidad'])=="")
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
        echo "Fecha caducidad: ".$_REQUEST['fechacaducidad'].'<br>';
        foreach ($alergenos as $alergeno){
            echo $alergeno." ";
        }
        echo "Alérgenos: ".$_REQUEST['alergenos'].'<br>';
        echo "Observaciones: ".$_REQUEST['observaciones'].'<br>';
    }
    
    ?>
</body>
</html>