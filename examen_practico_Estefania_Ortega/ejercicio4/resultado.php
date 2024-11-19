<?php
// Verificar si los datos han sido enviados a través del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores enviados
    $peso = $_POST['peso'];
    $altura = $_POST['altura'] / 100; // Convertir la altura de cm a metros

    // Validar que el peso y la altura sean números mayores que cero
    if (is_numeric($peso) && $peso > 0 && is_numeric($altura) && $altura > 0) {
        // cálculo del imc
        $imc = $peso / ($altura * $altura); // Fórmula IMC

        // quitar los decimales para un resultado óptimo
        $imc = (int) $imc;

        // apartado extra para ver si es sobrepeso
        $categoria = "";
        if ($imc < 18.5) {
            $categoria = "Bajo peso";
        } elseif ($imc >= 18.5 && $imc <= 24.9) {
            $categoria = "Peso normal";
        } elseif ($imc >= 25 && $imc <= 29.9) {
            $categoria = "Sobrepeso";
        } else {
            $categoria = "Obesidad";
        }

        echo "<h1>Tu Índice de Masa Corporal (IMC) es: $imc</h1>";
        echo "<p>Diagnóstico: $categoria</p>";
    } else {
        echo "<p>Error: Por favor, ingrese valores válidos para peso y altura (mayores que cero).</p>";
    }
} else {
    echo "<p>No se recibieron datos del formulario.</p>";
}
?>