<?php
// Conectar a la base de datos
include("conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar la consulta para eliminar la cerveza
    $sql = "DELETE FROM cervezas WHERE id_cerveza = ?";
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación fue exitosa
    if ($stmt === false) {
        echo "Error en la preparación de la consulta: " . $conn->error;
        exit;
    }

    // Vincular el parámetro
    $stmt->bind_param("i", $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Cerveza eliminada.";
    } else {
        echo "Error al borrar cerveza: " . $stmt->error;
    }

    // Cerrar la sentencia
    $stmt->close();
}

$conn->close();
?>

