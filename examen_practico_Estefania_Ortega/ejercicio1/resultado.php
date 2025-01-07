<!DOCTYPE html>
<html>
<head>
    <title>Resultado</title>
</head>
<body>
    <h1>Resultado</h1>
    <?php
    //comprobamos que se ha enviado
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $selected = isset($_POST['selected']) ? $_POST['selected'] : [];
        $size = intval($_POST["size"]);
        //contamos las casilas seleccionadas
        echo "<p>Has marcado <b>" . count($selected) . "</b> casillas de <b>".$size."</b>:</p>";

        if (!empty($selected)) {
            foreach ($selected as $value) {
                echo "<b>   Casilla $value</b>";
            }
        } else {
            echo "<p>No seleccionaste ninguna casilla.</p>";
        }
    } else {
        echo "Por favor, regrese a la página anterior para interactuar con la tabla.";
    }
    echo "<A HREF='javascript:history.back()'>Volver</A> </P>";
    ?>
</body>
</html>