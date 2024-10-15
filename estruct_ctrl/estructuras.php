<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //condicional if
    print "<h1>Tirada de dado</h1>\n"; 
   $dado = rand(1, 6); 
   print "<p>Ha sacado un $dado.</p>\n"; 
   if ($dado == 6) { 
      print "<p>¡Ha conseguido la máxima puntuación!</p>\n"; 
   } 
   print "<p>¡Hasta la próxima!</p>\n"; 

   //elsif
   if (condición_1) {
    bloque_de_sentencias_1;
        } elseif (condición_2) {
        bloque_de_sentencias_2;
        } else {
        bloque_de_sentencias_3;
    }

    //operador ternario

    print condicion_1 ? "cadena1" : "cadena2";

    //switch
    switch (expresión_1) {
        case valor_1:
            bloque_de_sentencias_1;
            break;
        case valor_2:
            bloque_de_sentencias_2;
            break;
        case valor_n:
            bloque_de_sentencias_n;
            break;
    }

    // bucle for

    print "<p>Comienzo</p>\n"; 
   for ($i = 0; $i < 3; $i++) { 
       print "<p>$i</p>\n"; 
   } 
   print "<p>Final</p>\n"; 

   //contador
   $contador = 0;
   if ($dado == 5) {
    $contador++;
    }

   //testigo : booleano para indicar si una condición se cumple
   $correcto = false;

   //acumulador
   $total = $total + $cantidad

   //bucles anidados
   print "<p>Comienzo</p>\n"; 
  for ($i = 1; $i < 3; $i++) { 
        // Bucle exterior 
    for ($j = 10; 
       $j < 12; $j++) { 
        // Bucle interior 
       print "<p>i: $i -- j: $j</p>\n";
    } 
  } 
  print "<p>Final</p>\n"; 


    ?>
</body>
</html>