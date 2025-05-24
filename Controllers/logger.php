<?php
function registrarError($tipo, $mensaje, $ubicacion) {
    require "../Config/conexion.php";

    $sql = "INSERT INTO Log (tipo_error, mensaje, ubicacion_error) VALUES (:tipo, :mensaje, :ubicacion)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':mensaje', $mensaje);
    $stmt->bindParam(':ubicacion', $ubicacion);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        // Si falla incluso el registro del log, muestra error silencioso (o log local)
        error_log("Error al registrar en el log: " . $e->getMessage());
    }
    return "Ocurrió un error: $mensaje";
}
?>
