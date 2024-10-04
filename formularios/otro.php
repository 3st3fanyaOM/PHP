<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>   
    <?php
            $nombre = $_REQUEST['nombre'];
            $apellidos = $_REQUEST['apellidos'];
            $edad=$_REQUEST['edad'];
            echo $nombre, '<br>';
            echo $apellidos, '<br>';
            echo $edad, '<br>';
    ?>
</body>
</html>