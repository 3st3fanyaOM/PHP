<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
   if (isset($_REQUEST['info'])){
    print "<p> Desea recibir información</p>";
   } 
   else{
    print "<p> No desea recibir información</p>";
   }
   ?>
</body>
</html>