<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio7</title>
</head>
<body>
    <!-- Dadas las siguientes variables.
    $valor = "qwert"
    $valor = 12345678901234567890
    $valor = true;
    $valor = 1234;
    $valor = NULL;
    Pinta en pantalla el tipo de variable
    Creado por: Estefania Ortega-->
<?php
    $valor = "qwert";
    $valor1 = 12345678901234567890;
    $valor2 = true;
    $valor3 = 1234;
    $valor4 = NULL;
    
    echo "Tipo de valor: ".var_dump($valor)."<br>";
    echo "Tipo de valor1: ".var_dump($valor1)."<br>";
    echo "Tipo de valor2: ".var_dump($valor2)."<br>";
    echo "Tipo de valor3: ".var_dump($valor3)."<br>";
    echo "Tipo de valor4: ".var_dump($valor4)."<br>";
?>
</body>
</html>
