<?php
include "../Config/conexion.php";

if (isset($_GET["matricula"])):
    $matricula = $_GET["matricula"];
    $sql = "SELECT matricula, nombre, apellido_paterno, apellido_materno, genero, fecha_nacimiento, tipo_sangre FROM personas WHERE matricula = :matricula";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $matricula = $row["matricula"];
        $nombre = $row["nombre"];
        $apellido_paterno = $row["apellido_paterno"];
        $apellido_materno = $row["apellido_materno"];
        $fechaNacimiento = $row['fecha_nacimiento']; // Formato de fecha
        $genero = $row["genero"];
        $tipo_sangre = $row["tipo_sangre"];
    } else {
        registrarError(
            'Error en la consulta',
            "No se encontró el paciente con la matrícula proporcionada.",
            'consultaMedicaController.php: línea 20'
        );
        $errorMensaje = 'Info: No se encontro al paciente con la matricula proporcionada: '.$matricula;
        ?>
        <html> <body><form id="formRedirect" action="../views/sinInformacion.php" method="post">
                    <input type="hidden" name="error" value="<?= htmlspecialchars($errorMensaje) ?>">
                </form>
                <script>
                    document.getElementById('formRedirect').submit();
                </script>
        </body></html>
        <?php
        exit();
    }
else:
    $matricula = $_SESSION["matricula"];

endif;
?>