<?php
require_once '../config/conexion.php'; // Asegúrate de tener la conexión aquí
include_once 'logger.php';

$nombre = isset($_POST['nombreAdmin']) ? trim($_POST['nombreAdmin']) : '';
$matricula = isset($_POST['matriculaAdmin']) ? $_POST['matriculaAdmin'] : '';
$contraseña = isset($_POST['passwordAdmin']) ? $_POST['passwordAdmin'] : '';
$fechaActual = date('Y-m-d H:i:s');

try {
    $pdo->beginTransaction();

    $sql = "INSERT INTO Administradores (nombreAdmin, matricula, password, fecha) 
            VALUES (:nombreAdmin, :matricula, :password, :fecha)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "nombreAdmin" => $nombre,
        "matricula" => $matricula,
        "password" => $contraseña,
        "fecha" => $fechaActual
    ]);

    $pdo->commit();
    registrarError(
        'Succesfuly inserted',
        'Info: Se agregóun nuevo administrador a la base de datos: ' . $nombre,
        'agregarAdministradorController.php: línea 13'
    );
    $mensaje = 'Administrador '. $nombre.' se añadio correctamente: ';
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
        "Error al guardar los datos. " . $e->getMessage(),
        'agregarAdministradorController.php: línea 13'
    );
    $errorMensaje = 'Error al guardar los datos: ' . $e->getMessage();
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