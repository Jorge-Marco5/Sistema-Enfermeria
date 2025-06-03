<?php
require_once '../config/conexion.php'; // Asegúrate de tener la conexión aquí
include_once 'logger.php';

$descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
$fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : '';
$fechaFinal = isset($_POST['fechaFinal']) ? $_POST['fechaFinal'] : '';
$fechaActual = date('Y-m-d H:i:s');

try {
    $pdo->beginTransaction();

    $sql = "INSERT INTO Campañas (descripcioncampaña, fechaInicio, fechaFinal, fechaagregada) 
            VALUES (:descripcion, :fechaInicio, :fechaFinal, :fechaActual)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "descripcion" => $descripcion,
        "fechaInicio" => $fechaInicio,
        "fechaFinal" => $fechaFinal,
        "fechaActual" => $fechaActual
    ]);

    $pdo->commit();
    registrarError(
        'Succesfuly inserted',
        'Info: Se agregó a la base de datos información de la campaña: ' . $descripcion,
        'agregarCampañaController.php: línea 14'
    );
    $mensaje = 'Se añadió correctamente la información de la campaña: ' . $descripcion;
    ?>
    <html>
    <body>
        <form id="formRedirect" action="../views/campañas.php" method="post">
            <input type="hidden" name="mensaje" value="<?= htmlspecialchars($mensaje) ?>">
        </form>
        <script>
            document.getElementById('formRedirect').submit();
        </script>
    </body>
    </html>
    <?php
    exit();

} catch (PDOException $e) {
    $pdo->rollBack();
    registrarError(
        'PDOException',
        "Error al guardar los datos. " . $e->getMessage(),
        'agregarCampañaController.php: línea 28'
    );
    $errorMensaje = 'Error al guardar los datos: ' . $e->getMessage();
    ?>
    <html>
    <body>
        <form id="formRedirect" action="../views/campañas.php" method="post">
            <input type="hidden" name="error" value="<?= htmlspecialchars($errorMensaje) ?>">
        </form>
        <script>
            document.getElementById('formRedirect').submit();
        </script>
    </body>
    </html>
    <?php
    exit();
}