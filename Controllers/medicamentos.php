<?php
/*
Controlador que obtiene la lista de medicamentos registrados en la base de datos
*/
include("../Config/conexion.php");

$sql = "SELECT nombre_medicamento FROM Lista_Medicamentos ORDER BY nombre_medicamento ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$medicamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($medicamentos as $row) {
    echo '<option value="' . htmlspecialchars($row['nombre_medicamento']) . '"></option>';
}
?>
