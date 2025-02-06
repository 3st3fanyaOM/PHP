<?php
include("../includes/conexion.php");

$errores = [];
$denominacion = $marca = $tipo = $formato = $tamanio = $fechacaducidad = $precio = $observaciones = "";
$alergenos = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validaciones
    $denominacion = empty($_POST["denominacion"]) ? $errores["denominacion"] = "Este campo no puede estar vacío." : htmlspecialchars($_POST["denominacion"]);
    $marca = empty($_POST["marca"]) ? $errores["marca"] = "Debe seleccionar una marca." : $_POST["marca"];
    $tipo = empty($_POST["tipo"]) ? $errores["tipo"] = "Debe seleccionar un tipo de cerveza." : $_POST["tipo"];
    $formato = empty($_POST["formato"]) ? $errores["formato"] = "Debe seleccionar un formato." : $_POST["formato"];
    $tamanio = empty($_POST["tamanio"]) ? $errores["tamanio"] = "Debe seleccionar un tamaño." : $_POST["tamanio"];
    $fechacaducidad = empty($_POST["fechacaducidad"]) ? $errores["fechacaducidad"] = "Debe seleccionar una fecha válida." : $_POST["fechacaducidad"];
    $precio = (empty($_POST["precio"]) || !is_numeric($_POST["precio"]) || $_POST["precio"] <= 0) ? $errores["precio"] = "Debe ingresar un precio válido." : $_POST["precio"];
    if (empty($_POST["alergenos"])) {
      $errores["alergenos"] = "Debe seleccionar al menos un alérgeno.";
    } else {
      $alergenos = $_POST["alergenos"]; // Aquí se guardan los alérgenos seleccionados
    }
    $observaciones = !empty($_POST["observaciones"]) ? htmlspecialchars($_POST["observaciones"]) : "";

    // Procesar imagen
    if ($_FILES["foto"]["error"] == 0) {
        $directorio = "uploads/";
        $rutaArchivo = $directorio . basename($_FILES["foto"]["name"]);
        $tipoArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        
        if ($check !== false && in_array($tipoArchivo, ["jpg", "jpeg", "png", "gif"])) {
            move_uploaded_file($_FILES["foto"]["tmp_name"], $rutaArchivo);
        } else {
            $errores["foto"] = "El archivo debe ser una imagen (JPG, JPEG, PNG o GIF).";
        }
    } else {
        $errores["foto"] = "Debe subir una imagen.";
    }

    // Insertar en base de datos si no hay errores
    if (empty($errores)) {
      $alergenos_str = json_encode($alergenos);
        $sql = "INSERT INTO cervezas (denominacion, marca, tipo, formato, tamanio, alergenos, fecha, foto, precio, observaciones)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", $denominacion, $marca, $tipo, $formato, $tamanio, $alergenos_str, $fechacaducidad, $rutaArchivo, $precio, $observaciones);
        
        if ($stmt->execute()) {
            echo "<p style='color:blue;'>Cerveza registrada con éxito.</p>";
            echo "<p> [<a href='admin_insertar_cerveza.php'>Insertar otra cerveza</a>]</p>";
            echo "<p> [<a href='admin_menu.php'>Menú administrador</a>]</p>";
        } else {
            echo "<p style='color:red;'>Error al insertar el registro: " . $stmt->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<p style='color:red;'>Ha habido algún problema con la inserción en la base de datos.</p>";
    }
}

include '../includes/header.php';
?>

<h1 style="text-align:center">Inserción de cervezas</h1>
<div class="container">
    <form class="product-form" action="admin_insertar_cerveza.php" method="POST" enctype="multipart/form-data" id="cervezaForm">
        <fieldset class="formulario">
            <h4>Introduzca los datos de la cerveza:</h4>
            <hr />
            <!-- denominación -->
            <label for="denominacion">Denominación:</label><br>
            <input type="text" id="denominacion" name="denominacion" value="<?= $denominacion ?>" /><br>
            <span class="error-message"><?= $errores["denominacion"] ?? "" ?></span>
            <!-- marca -->
            <label for="marca">Marca:</label><br>
            <select name="marca" id="marca">
                <option value="">Seleccione una marca</option>
                <?php $marcas = ["Heineken", "Mahou", "DAM", "Estrella Galicia", "Alhambra"];
                foreach ($marcas as $m) {
                    echo "<option value='$m' " . ($marca == $m ? "selected" : "") . ">$m</option>";
                } ?>
            </select><br>
            <span class="error-message"><?= $errores["marca"] ?? "" ?></span>
            <!-- tipo -->
            <label for="tipo">Tipo de cerveza:</label><br>
            <?php $tipos = ["lager", "pale ale", "cerveza negra", "abadia", "rubia"];
            foreach ($tipos as $t) {
                echo "<input type='radio' name='tipo' value='$t' " . (($tipo == $t) ? "checked" : "") . "> " . strtoupper($t) . "<br>";
            } ?>
            <span class="error-message"><?= $errores["tipo"] ?? "" ?></span>
            <!-- formato -->
            <label for="formato">Formato:</label><br>
            <select name="formato" id="formato">
                <option value="">Seleccione un formato</option>
                <?php $formatos = ["lata", "botella", "pack"];
                foreach ($formatos as $f) {
                    echo "<option value='$f' " . ($formato == $f ? "selected" : "") . ">$f</option>";
                } ?>
            </select><br>
            <span class="error-message"><?= $errores["formato"] ?? "" ?></span>
            <!-- tamaño -->
            <label for="tamanio">Tamaño:</label><br />
              <select name="tamanio" id="tamanio">
                <option value="">Seleccione un tamaño</option>
                <option value="botellin" <?= ($tamanio == "botellin") ? "selected" : "" ?>>Botellin</option>
                <option value="tercio" <?= ($tamanio == "tercio") ? "selected" : "" ?>>Tercio</option>
                <option value="media" <?= ($tamanio == "media") ? "selected" : "" ?>>Media</option>
                <option value="litrona" <?= ($tamanio == "litrona") ? "selected" : "" ?>>Litrona</option>
              </select><br />
              <span class="error-message"><?= $errores["tamanio"] ?? "" ?></span><br />
            <!-- alergenos -->
            <p><label>Al&eacute;rgenos:</label></p>
            <?php
            $opciones_alergenos = ["Gluten", "Cacahuete", "Soja", "Lácteo", "Sulfitos", "Huevo", "Sin alérgenos"];
              foreach ($opciones_alergenos as $al) {
                echo "<label>$al</label>
                  <input type='checkbox' name='alergenos[]' value='$al' " . (in_array($al, $alergenos) ? "checked" : "") . " />";
              }
            ?><br /><br />
           <!-- fecha caducidad -->
            <label for="fechacaducidad">Fecha de consumo preferente:</label>
            <input type="date" id="fechacaducidad" name="fechacaducidad" value="<?= $fechacaducidad ?>" /><br />
           <span class="error-message"><?= $errores["fechacaducidad"] ?? "" ?></span><br /><br />
           <!-- foto -->
            <label for="foto">Foto:</label><br>
            <input type="file" name="foto" /><br>
            <span class="error-message"><?= $errores["foto"] ?? "" ?></span>
            <!-- precio -->
            <label for="precio">Precio:</label><br>
            <input type="number" id="precio" name="precio" value="<?= $precio ?>" step="0.01" /><span> €</span><br>
            <span class="error-message"><?= $errores["precio"] ?? "" ?></span>
            <!-- observaciones -->
            <label for="observaciones">Observaciones:</label><br>
            <textarea id="observaciones" name="observaciones" rows="4" cols="50"></textarea><br>
            <span class="error-message"><?= $errores["observaciones"] ?? "" ?></span>

            <input type="submit" value="Insertar Cerveza" />
            <input type="reset" value="Resetear Formulario"/>
        </fieldset>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
