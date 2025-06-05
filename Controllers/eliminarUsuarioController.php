<?php
require_once '../config/conexion.php'; // Asegúrate de tener la conexión aquí
include_once 'logger.php';

$matricula = $_GET['matricula'];

try {
    $pdo->beginTransaction();

    $sql = "DELETE FROM personas WHERE matricula = :matricula";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "matricula" => $matricula,
    ]);

    $pdo->commit();
    registrarError(
        'Succesfuly deleted',
        'Info: Se elimino el usuario: ' . $matricula,
        'eliminarUsuarioController.php: línea 11'
    );
    $mensaje = 'Usuario '. $matricula. ' eliminado correctamente';
    ?>
    <html>
    <body>
        <form id="formRedirect" action="../views/verListaPacientes.php" method="post">
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
        "Error al procesar los datos. " . $e->getMessage(),
        'eliminarUsuarioController.php: línea 11'
    );
    $errorMensaje = 'Error al procesar los datos: ' . $e->getMessage();
    ?>
    <html>
    <body>
        <form id="formRedirect" action="../views/verListaPacientes.php" method="post">
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