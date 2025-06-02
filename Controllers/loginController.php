<?php
/*
Controlador que realiza el login de los administradores para ingresar al sistema
*/
require "../Config/conexion.php";
require "logger.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = trim($_POST["matricula"]);
    $password = trim($_POST["password"]);

    if (!$pdo) {
        registrarError(
            'PDOException',
            "Error de conexion con la base de datos. ".$e->getMessage(),
            'loginController.php: línea 6'
        );
        $errorMensaje = 'Error de conexion con la base de datos';
        ?>
        <html> <body><form id="formRedirect" action="../views/Login.php" method="post">
                    <input type="hidden" name="error" value="<?= htmlspecialchars($errorMensaje) ?>">
                </form>
                <script>
                    document.getElementById('formRedirect').submit();
                </script>
        </body></html>
        <?php
        exit(); // ← MUY IMPORTANTE
    }

    $sql = "SELECT id_admin, nombreadmin, matricula, password FROM administradores WHERE LOWER(matricula) = LOWER(:matricula)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["matricula" => $matricula]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        registrarError(
            'notFound',
            "Usuario no encontrado.",
            'loginController.php: línea 19'
        );
        $errorMensaje = 'Usuario no encontrado. Matrícula ingresada: '.$matricula;
        ?>
        <html> <body><form id="formRedirect" action="../views/Login.php" method="post">
                    <input type="hidden" name="error" value="<?= htmlspecialchars($errorMensaje) ?>">
                </form>
                <script>
                    document.getElementById('formRedirect').submit();
                </script>
        </body></html>
        <?php
        exit(); // ← MUY IMPORTANTE
    }

    if ($password === $usuario["password"]) {
        $_SESSION["id_admin"] = $usuario["id_admin"];
        $_SESSION["matricula"] = $usuario["matricula"];
        $_SESSION["nombreadmin"] = $usuario["nombreadmin"];

        ob_clean();
        header("Location: ../views/Index.php");
        exit;
    } else {
        registrarError(
            'Error 18456, login Error',
            "Matricula o contraseña incorrecta.",
            'loginController.php: línea 33'
        );
        $errorMensaje = 'Matricula o contraseña incorrecta';
        ?>
        <html> <body><form id="formRedirect" action="../views/Login.php" method="post">
                    <input type="hidden" name="error" value="<?= htmlspecialchars($errorMensaje) ?>">
                </form>
                <script>
                    document.getElementById('formRedirect').submit();
                </script>
        </body></html>
        <?php
        exit(); // ← MUY IMPORTANTE
    }
}
?>
