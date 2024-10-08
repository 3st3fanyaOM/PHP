<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio5</title>
</head>
<body>
    <!-- Dado el numero 8, calcular y presentar en pantalla:
        Suma 2
        Resta 2
        Multiplica por 5 el ultimo valor
        Divide por 3 el último valor
        Incrementa en 1 el resultado
        Decrementa el resultado en 1 

    Creado por: Estefania Ortega-->
<?php
    $num = 8;
    $num += 2;
    $num -= 2;
    $num *= 5;
    $num /= 3;
    $num++;
    $num--;

    echo "Número: ".$num;
?>
</body>
</html>
