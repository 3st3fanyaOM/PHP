<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    define('PI',3.14);
    $radio = $_REQUEST['radio'];
    $h = $_REQUEST['altura'];
    $caudal = $_REQUEST['caudal'];

    $volumen = PI * ($radio*$radio) * $h;
    echo "Volumen : ".$volumen." cm2.\n";
    $litros = $volumen/1000;
    echo "El depósito tiene ".$litros." litros.\n";
    $tiempo = $litros/$caudal;
    echo "Tardará en llenarse ".$tiempo." minutos.";
    ?>
</body>
</html>