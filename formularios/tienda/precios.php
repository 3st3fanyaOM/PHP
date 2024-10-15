<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $media = ($_REQUEST['precio1']+$_REQUEST['precio2']+$_REQUEST['precio3'])/3;
    echo "El precio del producto es ".$media." €.";
    ?>
</body>
</html>