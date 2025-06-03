<?php
require_once '../config/conexion.php'; // Asegúrate de tener la conexión aquí
include_once 'logger.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';

try {
    $pdo->beginTransaction();

    $sql = "DELETE FROM Administradores WHERE id_Admin = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "id" => $id,
    ]);

    $pdo->commit();
    registrarError(
        'Succesfuly inserted',
        'Info: Se elimino el administrador: ' . $nombre,
        'eliminarAdministradorController.php: línea 11'
    );
    $mensaje = 'Administrador '. $nombre. ' eliminado correctamente';
    ?>
    <html>
    <body>
        <form id="formRedirect" action="../views/administradores.php" method="post">
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
        'eliminarCampañaController.php: línea 11'
    );
    $errorMensaje = 'Error al procesar los datos: ' . $e->getMessage();
    ?>
    <html>
    <body>
        <form id="formRedirect" action="../views/administradores.php" method="post">
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