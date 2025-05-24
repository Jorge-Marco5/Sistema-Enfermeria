<?php
include("../Config/conexion.php");

$sql = "SELECT nombre_discapacidad FROM Lista_Discapacidades ORDER BY nombre_discapacidad ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$discapacidad = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($discapacidad as $row) {
    echo '<option value="' . htmlspecialchars($row['nombre_discapacidad']) . '"></option>';
}
?>
