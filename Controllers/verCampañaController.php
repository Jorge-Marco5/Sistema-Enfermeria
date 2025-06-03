<?php
include("../Config/conexion.php");
$sql = "SELECT id, descripcioncampaña, fechaInicio, fechaFinal, fechaagregada FROM campañas ORDER BY fechaagregada DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);