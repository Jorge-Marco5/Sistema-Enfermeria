<?php
/*
Controlador que obtiene la lista de cirugias registradas en la base de datos
*/
include("../Config/conexion.php");

$sql = "SELECT nombre_cirugia FROM Lista_Cirugias ORDER BY nombre_cirugia ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$cirugias = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($cirugias as $row) {
    echo '<option value="' . htmlspecialchars($row['nombre_cirugia']) . '"></option>';
}
?>
