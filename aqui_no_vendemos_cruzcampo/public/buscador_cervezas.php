<?php
include("../includes/conexion.php");
include '../includes/header.php';

//variables
$denominacion = $_GET['denominacion'] ?? '';
$marca = $_GET['marca'] ?? '';
$alergenos = $_GET['alergenos'] ?? [];
$formato = $_GET['formato'] ?? '';
$tamanio = $_GET['tamanio'] ?? '';

//verificar envio datos
$formularioEnviado = !empty($_GET);

//consulta SQL
if($formularioEnviado){
    $sql = "SELECT * FROM cervezas WHERE 1=1";

if (!empty($denominacion)) {
    $sql .= " AND denominacion LIKE '%$denominacion%'";
}
if (!empty($marca)) {
    $sql .= " AND marca = '$marca'";
}
if (!empty($alergenos)) {
    $sql .= " AND (";
    foreach ($alergenos as $alergeno) {
        $sql .= " alergenos LIKE '%$alergeno%' OR";
    }
    $sql = rtrim($sql, "OR") . ")";
}
if (!empty($formato)) {
    $sql .= " AND formato = '$formato'";
}
if (!empty($tamanio)) {
    $sql .= " AND tamanio = '$tamanio'";
}

$result = $conn->query($sql);
}


?>
<!--formulario de búsqueda-->
<h4>¿Qué cerveza quieres buscar?</h4>
<form action="buscador_cervezas.php" method="GET" class="product-form">
    <fieldset class="formulario">
    <label for="denominacion">Denominación:</label><br>
    <input type="text" id="denominacion" name="denominacion" value="<?= $denominacion ?>" /><br>
    <label for="marca">Marca:</label><br>
            <select name="marca" id="marca">
                <option value="">Seleccione una marca</option>
                <?php $marcas = ["Heineken", "Mahou", "DAM", "Estrella Galicia", "Alhambra"];
                foreach ($marcas as $m) {
                    echo "<option value='$m' " . ($marca == $m ? "selected" : "") . ">$m</option>";
                } ?>
            </select><br>
    <label>Al&eacute;rgenos:</label>
            <?php
            $opciones_alergenos = ["Gluten", "Cacahuete", "Soja", "Lácteo", "Sulfitos", "Huevo", "Sin alérgenos"];
            foreach ($opciones_alergenos as $al) {
                $checked = in_array($al, $alergenos) ? "checked" : "";
                echo "<label>$al</label>
                <input type='checkbox' name='alergenos[]' value='$al' $checked />";
            }
            ?><br />
    <label for="formato">Formato:</label><br>
            <select name="formato" id="formato">
                <option value="">Seleccione un formato</option>
                <?php $formatos = ["lata", "botella", "pack"];
                foreach ($formatos as $f) {
                    echo "<option value='$f' " . ($formato == $f ? "selected" : "") . ">$f</option>";
                } ?>
            </select><br>
    <label for="tamanio">Tamaño:</label><br />
            <select name="tamanio" id="tamanio">
                <option value="">Seleccione un tamaño</option>
                <option value="botellin" <?= ($tamanio == "botellin") ? "selected" : "" ?>>Botellin</option>
                <option value="tercio" <?= ($tamanio == "tercio") ? "selected" : "" ?>>Tercio</option>
                <option value="media" <?= ($tamanio == "media") ? "selected" : "" ?>>Media</option>
                <option value="litrona" <?= ($tamanio == "litrona") ? "selected" : "" ?>>Litrona</option>
            </select><br />
            <button class="btn" type="submit">Buscar</button>
    </fieldset>
</form>
<!--resultados-->
<?php if ($formularioEnviado) : ?>
    <h4>Resultados de la búsqueda:</h4>
    <?php if (isset($result) && $result->num_rows > 0) : ?>
<table>
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Denominación</th>
            <th>Marca</th>
            <th>Tipo</th>
            <th>Formato</th>
            <th>Tamaño</th>
            <th>Alergenos</th>
            <th>Precio (€)</th>
        </tr>
    </thead>
    <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td><img src='../admin/{$row["foto"]}' width='50' height='50' alt='Imagen de {$row["denominacion"]}'></td>
                        <td>{$row['denominacion']}</td>
                        <td>{$row['marca']}</td>
                        <td>{$row['tipo']}</td>
                        <td>{$row['formato']}</td>
                        <td>{$row['tamanio']}</td>
                        <td>{$row['alergenos']}</td>
                        <td>{$row['precio']}€</td>

                    </tr>";
                }
                ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No se encontraron cervezas que coincidan con los criterios de búsqueda.</p>
    <?php endif; ?>
<?php endif; ?>

<?php
include '../includes/footer.php';
?>