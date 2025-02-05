<?php
// Conectar a la base de datos
include("../includes/conexion.php");

// Comprobar si se pasa un ID a través de la URL
//var_dump($_GET);
// Comprobar si se pasa un ID a través de la URL
if (isset($_GET['id'])) {
    // Verifica que el parámetro ID esté presente y sea numérico
    if (is_numeric($_GET['id'])) {
        // Asignamos el valor como entero
        $id_cerveza = (int)$_GET['id']; 

        // Obtener los datos actuales de la cerveza desde la base de datos
        $sql = "SELECT * FROM cervezas WHERE id_cerveza = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_cerveza);
        $stmt->execute();
        $result = $stmt->get_result();
        $cerveza = $result->fetch_assoc();

        // Si no se encuentra la cerveza, redirigir o mostrar un error
        if (!$cerveza) {
            echo "Cerveza no encontrada.";
            exit;
        }
    } else {
        echo "El ID de cerveza no es válido.";
        exit;
    }
} else {
    echo "No se ha especificado un ID de cerveza.";
    exit;
}

// Si el formulario se ha enviado, actualizamos los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //var_dump($_POST);
    // Obtener los valores del formulario
    $denominacion = $_POST['denominacion'];
    $marca = $_POST['marca'];
    $tipo = $_POST['tipo'];
    $formato = $_POST['formato'];
    $tamanio = $_POST['tamanio'];
    $alergenos = isset($_POST['alergenos']) ? implode(", ", $_POST['alergenos']) : "";
    $fechacaducidad = $_POST['fechacaducidad'];
    $precio = $_POST['precio'];
    $observaciones = $_POST['observaciones'];

    // Actualizar los datos en la base de datos
    $sql_update = "UPDATE cervezas SET denominacion = ?, marca = ?, tipo = ?, formato = ?, tamanio = ?, alergenos = ?, fecha = ?, precio = ?, observaciones = ? WHERE id_cerveza = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssssssssi", $denominacion, $marca, $tipo, $formato, $tamanio, $alergenos, $fechacaducidad, $precio, $observaciones, $id_cerveza);

    if ($stmt_update->execute()) {
        echo "Cerveza actualizada correctamente.";
        header("Location: admin_listar.php");
        exit;
    } else {
        echo "Error al actualizar la cerveza: " . $stmt_update->error;
    }
}
?>

<form class="product-form" action="admin_editar_cerveza.php?id=<?php echo $id_cerveza; ?>" method="POST" enctype="multipart/form-data">

    <fieldset class="formulario">
    <?php include '../includes/header.php'; ?>
        <h4>Editar los datos de la cerveza:</h4>
        <hr /><br />
        
        <!-- denominacion -->
        <label for="denominacion">Denominaci&oacute;n:</label><br />
        <input type="text" id="denominacion" name="denominacion" value="<?php echo htmlspecialchars($cerveza['denominacion']); ?>" /><br /><br />

        <!-- marca -->
        <label for="marca">Marca:</label><br />
        <select name="marca" id="marca">
            <option value="Heineken" <?php echo ($cerveza['marca'] == 'Heineken') ? 'selected' : ''; ?>>Heineken</option>
            <option value="Mahou" <?php echo ($cerveza['marca'] == 'Mahou') ? 'selected' : ''; ?>>Mahou</option>
            <option value="DAM" <?php echo ($cerveza['marca'] == 'DAM') ? 'selected' : ''; ?>>DAM</option>
            <option value="Estrella Galicia" <?php echo ($cerveza['marca'] == 'Estrella Galicia') ? 'selected' : ''; ?>>Estrella Galicia</option>
            <option value="Cruzcampo" <?php echo ($cerveza['marca'] == 'Cruzcampo') ? 'selected' : ''; ?>>Cruzcampo</option>
            <option value="Alhambra" <?php echo ($cerveza['marca'] == 'Alhambra') ? 'selected' : ''; ?>>Alhambra</option>
        </select><br /><br />
        
        <!-- tipo -->
        <label for="tipo">Tipo de cerveza:</label><br />
        <input type="radio" id="lager" name="tipo" value="lager" <?php echo ($cerveza['tipo'] == 'lager') ? 'checked' : ''; ?>>
        <label for="lager">LAGER</label><br>
        <input type="radio" id="pale ale" name="tipo" value="pale ale" <?php echo ($cerveza['tipo'] == 'pale ale') ? 'checked' : ''; ?>>
        <label for="pale ale">PALE ALE</label><br>
        <input type="radio" id="cerveza negra" name="tipo" value="cerveza negra" <?php echo ($cerveza['tipo'] == 'cerveza negra') ? 'checked' : ''; ?>>
        <label for="cerveza negra">CERVEZA NEGRA</label><br>
        <input type="radio" id="abadia" name="tipo" value="abadia" <?php echo ($cerveza['tipo'] == 'abadia') ? 'checked' : ''; ?>>
        <label for="abadia">ABADIA</label><br>
        <input type="radio" id="rubia" name="tipo" value="rubia" <?php echo ($cerveza['tipo'] == 'rubia') ? 'checked' : ''; ?>>
        <label for="rubia">RUBIA</label><br><br />

        <!-- formato -->
        <label for="formato">Formato:</label><br />
        <select name="formato" id="formato">
            <option value="lata" <?php echo ($cerveza['formato'] == 'lata') ? 'selected' : ''; ?>>Lata</option>
            <option value="botella" <?php echo ($cerveza['formato'] == 'botella') ? 'selected' : ''; ?>>Botella</option>
            <option value="pack" <?php echo ($cerveza['formato'] == 'pack') ? 'selected' : ''; ?>>Pack</option>
        </select><br /><br />

        <!-- tamaño -->
        <label for="tamanio">Tamaño:</label><br />
        <select name="tamanio" id="tamanio">
            <option value="botellin" <?php echo ($cerveza['tamanio'] == 'botellin') ? 'selected' : ''; ?>>Botellin</option>
            <option value="tercio" <?php echo ($cerveza['tamanio'] == 'tercio') ? 'selected' : ''; ?>>Tercio</option>
            <option value="media" <?php echo ($cerveza['tamanio'] == 'media') ? 'selected' : ''; ?>>Media</option>
            <option value="litrona" <?php echo ($cerveza['tamanio'] == 'litrona') ? 'selected' : ''; ?>>Litrona</option>
            <option value="pack" <?php echo ($cerveza['tamanio'] == 'pack') ? 'selected' : ''; ?>>Pack</option>
        </select><br /><br />

        <!-- alergenos -->
        <p><label>Al&eacute;rgenos:</label></p>
        <label>Gluten</label>
        <input type="checkbox" id="gluten" name="alergenos[]" value="Gluten" <?php echo (in_array('Gluten', explode(", ", $cerveza['alergenos']))) ? 'checked' : ''; ?> />
        <label>Cacahuete</label>
        <input type="checkbox" id="cacahuete" name="alergenos[]" value="Cacahuete" <?php echo (in_array('Cacahuete', explode(", ", $cerveza['alergenos']))) ? 'checked' : ''; ?> />
        <label>Soja</label>
        <input type="checkbox" id="soja" name="alergenos[]" value="Soja" <?php echo (in_array('Soja', explode(", ", $cerveza['alergenos']))) ? 'checked' : ''; ?> />
        <label>L&aacute;cteo</label>
        <input type="checkbox" id="lacteo" name="alergenos[]" value="Lacteo" <?php echo (in_array('Lacteo', explode(", ", $cerveza['alergenos']))) ? 'checked' : ''; ?> />
        <label>Sulfitos</label>
        <input type="checkbox" id="sulfitos" name="alergenos[]" value="Sulfitos" <?php echo (in_array('Sulfitos', explode(", ", $cerveza['alergenos']))) ? 'checked' : ''; ?> />
        <label>Huevo</label>
        <input type="checkbox" id="huevo" name="alergenos[]" value="Huevo" <?php echo (in_array('Huevo', explode(", ", $cerveza['alergenos']))) ? 'checked' : ''; ?> />
        <label>Sin alérgenos</label>
        <input type="checkbox" id="sinalergenos" name="alergenos[]" value="Sin alérgenos" <?php echo (in_array('Sin alérgenos', explode(", ", $cerveza['alergenos']))) ? 'checked' : ''; ?> /><br /><br />

        <!-- caducidad -->
        <label for="fechacaducidad">Fecha de consumo preferente:</label>
        <input type="date" id="fechacaducidad" name="fechacaducidad" value="<?php echo $cerveza['fecha']; ?>" /><br /><br />

        <!-- precio -->
        <label for="precio">Precio:</label><br />
        <input type="number" id="precio" name="precio" value="<?php echo $cerveza['precio']; ?>" /><span>€</span><br /><br />

        <!-- observaciones -->
        <label for="observaciones">Observaciones:</label><br />
        <textarea name="observaciones" id="observaciones"><?php echo htmlspecialchars($cerveza['observaciones']); ?></textarea><br /><br />

        <!-- submit -->
        <input type="submit" value="Actualizar Cerveza" /><br /><br />
    </fieldset>
</form>
<?php include '../includes/footer.php'; ?>
