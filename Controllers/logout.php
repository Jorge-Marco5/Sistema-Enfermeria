<?php
include "../Controllers/logger.php";
session_start();
session_unset();
session_destroy();
registrarError(
    'Sesion cerrada',
    "Cierrede la sesion en el sistema.",
    'logout.php: línea 5'
);
$errorMensaje = 'Cerraste la sesion correctamente';
?>
<html> <body><form id="formRedirect" action="../views/Login.php" method="post">
            <input type="hidden" name="mensaje" value="<?= htmlspecialchars($errorMensaje) ?>">
        </form>
        <script>
            document.getElementById('formRedirect').submit();
        </script>
</body></html>
<?php
exit();
?>