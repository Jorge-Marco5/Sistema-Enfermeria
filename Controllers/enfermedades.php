<?php
include("../Config/conexion.php");

$sql = "SELECT nombre_enfermedad FROM Lista_Enfermedades ORDER BY nombre_enfermedad ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$enfermedades = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($enfermedades as $row) {
    echo '<option value="' . htmlspecialchars($row['nombre_enfermedad']) . '"></option>';
}
?>
