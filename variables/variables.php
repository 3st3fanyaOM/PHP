<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $total = 300;
    $entero = 2000;
    $real= 3.14;
    $cadenaAlfanumerica = "Hola mundo";
    $booleano = true;
    $array[1] ="palabra";
    //tipado dinámico
    $cadena="5"; //esto es una cadena
    $entero=3; //esto es un entero 
    echo $cadena+$entero;
    //sensible a mayusc y minusc
    //casting cambiar tipo de la variable
    settype($cadena,"integer"); 
    //otra forma
    $cadena = "23"; 
    $cadena = (int) $variable; 
    //variable de sistema
    var_dump($_SERVER); //proporciona toda la info de sistema
    ?>
</body>
</html>