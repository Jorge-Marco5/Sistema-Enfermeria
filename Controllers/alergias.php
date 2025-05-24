<?php
include("../Config/conexion.php");

$sql = "SELECT nombre_alergia FROM Lista_Alergias ORDER BY nombre_alergia ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$alergias = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($alergias as $row) {
    echo '<option value="' . htmlspecialchars($row['nombre_alergia']) . '"></option>';
}
?>
