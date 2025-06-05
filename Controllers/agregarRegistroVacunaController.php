<?php
require_once '../config/conexion.php'; // Asegúrate de tener la conexión aquí
include_once 'logger.php';

$nombreVacuna = isset($_POST['nombreVacuna']) ? trim((string)$_POST['nombreVacuna']) : ''; // varchar
$dosis = isset($_POST['dosis']) ? floatval($_POST['dosis']) : 0.0; // float
$observaciones = isset($_POST['Observaciones']) ? trim((string)$_POST['Observaciones']) : ''; // varchar
$fechaActual = date('Y-m-d H:i:s'); // fecha y hora
$matricula = isset($_POST['matricula']) ? (string)$_POST['matricula'] : ''; // varchar

try {
    $pdo->beginTransaction();

    $sql = "INSERT INTO vacunas (nombre_vacuna, fecha_aplicacion, dosis, observaciones, matricula) 
            VALUES (:nombre_vacuna, :fecha_aplicacion, :dosis, :observaciones, :matricula)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "nombre_vacuna" => $nombreVacuna,
        "fecha_aplicacion" => $fechaActual,
        "dosis" => $dosis,
        "observaciones" => $observaciones,
        "matricula" => $matricula
    ]);

    $pdo->commit();
    registrarError(
        'Succesfuly inserted',
        'Info: Se agregó a la base de datos registro de vacuna para el usuario: ' . $matricula,
        'agregarRegistroVacunaController.php: línea 14'
    );
    $mensaje = 'Se añadió correctamente el registro de vacunacion del usuario: ' . $matricula;
    ?>
    <html>
    <body>
        <form id="formRedirect" action="../views/verInfoUsuario.php?matricula=<?= urlencode($matricula) ?>" method="post">
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
        'agregarRegistroVacunaController.php: línea 28'
    );
    $errorMensaje = 'Error al guardar los datos: ' . $e->getMessage();
    ?>
    <html>
    <body>
        <form id="formRedirect" action="../views/verInfoUsuario.php?matricula=<?= urlencode($matricula) ?>" method="post">
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