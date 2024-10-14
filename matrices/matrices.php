<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
      $matriz = ["uno" => "a", 2 => "bb", "tres" => "ccc"]; 
      print "<pre>\n"; 
      print_r($matriz); 
      print "</pre>\n"; 
      foreach ($matriz as $indice => $valor) { //recorre matriz
        print "<p>$indice - $valor</p>\n"; //imprime indice y valor
      } 

      foreach ($matriz as $valor) { //recorre matriz
        print "<p>$valor</p>\n"; //imprime valores
     } 
   
      print "<p>Final</p>\n"; 
    
    ?>
</body>
</html>