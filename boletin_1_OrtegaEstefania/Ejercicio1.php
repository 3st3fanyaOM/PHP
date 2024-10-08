<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
</head>
<body>
    <!-- Imprimir por pantalla usando variables, tu nombre, tu primer apellido, 
    tu segundo apellido, el curso en el que estás y la foto de tu DNI 
    Creado por: Estefania Ortega-->
<?php
    $nombre = "Estefania";
    $apellido1 = "Ortega";
    $apellido2 = "Muñoz";
    $curso = "2DAW";
    $foto = "foto.jpg";
    
    echo "Nombre: ".$nombre."<br>";
    echo "Apellido 1: ".$apellido1."<br>";
    echo "Apellido 2: ".$apellido2."<br>";
    echo "Curso: ".$curso."<br>";
    echo "Foto: <br><img style='width:100px;height:auto;'src='foto.jpg'>";
?>
</body>
</html>