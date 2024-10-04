<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operadores</title>
</head>
<body>
    <?php
    $a = 23; 
    $b = 3; 
    $c = $a - $b; 
    $x = 5; 
    //concatenar
    $x += 5; //$x valdrá 10 
    $cadena = "Hola "; 
    $cadena .= "mundo"; //$cadena ahora vale "hola mundo" 
    $cadena2 = "cruel";
    $cadenaConcatenada = $cadena . $cadena2;
     
    //condicional if
    $a = 20; 
    $b = 30; 

    if($a < $b) { 
        echo '$a es menor que $b'; //no tiene en cuenta los tipos
    } 

    //otro ejemplo
    $a = true; 
    $b = false; 
        
    if($a && $b) { 
        echo '$a y $b son los dos verdaderos'; 
    } else { 
        echo 'o uno de $a o $b son falsos, o los dos son falsos'; 
    } 
        
    ?>
</body>
</html>