<!DOCTYPE html>
<html>
<head>
    <title>Tabla</title>
</head>
<body>
    <h1>Tabla</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $size = intval($_POST["num"]);
        //verificación del tamaño
        $size = ($size > 20) ? 20 : $size; 

        //formulario
        echo "<form action='resultado.php' method='post'>";
        echo "<table border='2' style='border-collapse: collapse;'>";
            //fila
            echo "<tr>";
            //bucle para columnas
            for ($col = 1; $col <= $size; $col++) {
                echo "<td'>";
                echo "<input type='checkbox' name='selected[]' value='$col'>$col";
                echo "</td>";
            }
            echo "</tr>";
        echo "</table>";
        echo "<input type='hidden' name='size' value='$size'>";
        echo "<br><button type='submit'>Contar</button>";
        echo "<br><button type='reset'>Borrar</button>";
        echo "</form>";
        //volver al formulario
        echo "<A HREF='javascript:history.back()'>Ir al formulario</A> </P>";
    } else {
        echo "Debe especificar el tamaño de la tabla";
    }
    ?>
</body>
</html>