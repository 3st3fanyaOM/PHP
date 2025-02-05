<?php
// Conectar a la base de datos
include("../includes/conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar la consulta para obtener los datos de la cerveza
    $sql = "SELECT id_cerveza, tipo, marca FROM cervezas WHERE id_cerveza = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cerveza = $result->fetch_assoc();

    if ($cerveza) {
        // Si el formulario se ha enviado para confirmar la eliminación
        if (isset($_POST['confirmar']) && $_POST['confirmar'] == 'yes') {
            // Preparar la consulta para eliminar la cerveza
            $sql_delete = "DELETE FROM cervezas WHERE id_cerveza = ?";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param("i", $id);

            if ($stmt_delete->execute()) {
                echo "Cerveza eliminada correctamente.";
                header("Location: admin_listar.php");
                exit;
            } else {
                echo "Error al eliminar la cerveza: " . $stmt_delete->error;
            }

            // Cerrar la sentencia de eliminación
            $stmt_delete->close();
        }
        // Si no se ha confirmado la eliminación, mostrar el mensaje de confirmación
        else {
            include '../includes/header.php';
            echo "<h3>¿Estás seguro de que quieres eliminar la cerveza?</h3>";
            echo "<p><strong>ID:</strong> " . $cerveza['id_cerveza'] . "</p>";
            echo "<p><strong>Tipo:</strong> " . $cerveza['tipo'] . "</p>";
            echo "<p><strong>Marca:</strong> " . $cerveza['marca'] . "</p>";
            
            // Formulario de confirmación
            echo '<form method="POST">
                    <input type="hidden" name="confirmar" value="yes">
                    <input type="submit" value="Confirmar eliminación">
                  </form>';
            echo '<a href="admin_lista_cervezas.php">Volver a la lista</a>';
            include '../includes/footer.php';
        }
    } else {
        echo "Cerveza no encontrada.";
    }

    // Cerrar la sentencia
    $stmt->close();
}

$conn->close();
?>


