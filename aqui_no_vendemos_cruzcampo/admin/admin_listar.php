<?php
// Conectar a la base de datos
include("../includes/conexion.php");

// obtener cervezas
$sql = "SELECT id_cerveza, denominacion, marca, tipo, formato, tamanio, alergenos, fecha, foto, precio, observaciones FROM cervezas";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    include '../includes/header.php';
    echo "<h2>Lista de Cervezas</h2>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Denominación</th><th>Marca</th><th>Tipo</th><th>Formato</th><th>Tamaño</th><th>Alergenos</th><th>Fecha Caducidad</th><th>Foto</th><th>Precio</th><th>Observaciones</th><th>Acciones</th></tr>";

// Recorrer los resultados y mostrar cada cerveza
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['denominacion']) . "</td>";
    echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
    echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
    echo "<td>" . htmlspecialchars($row['formato']) . "</td>";
    echo "<td>" . htmlspecialchars($row['tamanio']) . "</td>";
    echo "<td>" . htmlspecialchars($row['alergenos']) . "</td>";
    echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
    echo "<td><img src='" . htmlspecialchars($row['foto']) . "' alt='cerveza' width='100'></td>";
    echo "<td>" . htmlspecialchars($row['precio']) . "</td>";
    echo "<td>" . htmlspecialchars($row['observaciones']) . "</td>";

    // Botones de editar y eliminar con el ID de la cerveza
    echo "<td>
    <span>
        <a href='admin_editar_cerveza.php?id=" . $row['id_cerveza'] . "'><button>Editar</button></a>
        <a href='admin_eliminar_cerveza.php?id=" . $row['id_cerveza'] . "'><button>Eliminar</button></a>
    </span>
</td>";

    echo "</tr>";
    
}

echo "</table>";
echo "<a href='logout.php'>Cerrar sesión</a>";
include '../includes/footer.php';
} else {
echo "No se encontraron cervezas en la base de datos.";
}
//cerrar conex
$conn->close();
?>