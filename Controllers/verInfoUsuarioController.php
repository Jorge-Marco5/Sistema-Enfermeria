<?php 
/*
Controlador que obtiene la informacion de algun usuario registrado en el sistema
*/
include('../config/conexion.php');

if (isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];

    $sql = "SELECT id_persona, matricula, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, genero, tipo_sangre, rol, contacto_emergencia_nombre, contacto_emergencia_telefono, contacto_emergencia_relacion 
            FROM personas 
            WHERE matricula = :matricula";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $nombre = $row['nombre'];
        $apellidoPaterno = $row['apellido_paterno'];
        $apellidoMaterno = $row['apellido_materno'];
        $fechaNacimiento = $row['fecha_nacimiento'];
        $genero = $row['genero'];
        $tipoSangre = $row['tipo_sangre'];
        $rol = $row['rol'];
        $matricula = $row['matricula'];
        $contactoEmergenciaNombre = $row['contacto_emergencia_nombre'];
        $contactoEmergenciaTelefono = $row['contacto_emergencia_telefono'];
        $contactoEmergenciaRelacion = $row['contacto_emergencia_relacion'];
    } else {
        registrarError(
            'PDOException',
            "Error: No existen datos de esta matricula. ",
            'verInfoUsuarioController.php: línea 8'
        );
        $errorMensaje = 'No existen datos de esta matricula.';
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

    $sql = "SELECT enfermedades, alergias, cirugias, medicacion, discapacidad FROM historialmedico WHERE matricula = :matricula";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
    $stmt->execute();
    $resultHistorialMedico = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT diagnostico, terapia, contacto_terapeuta, telefono_terapeuta FROM saludmental WHERE matricula = :matricula";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
    $stmt->execute();
    $resultSaludMental = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT direccion_img FROM vacunacion WHERE matricula = :matricula";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
    $stmt->execute();
    $resultVacunacion = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT aseguradora, numero_poliza, hospital_referencia, medico_cabecera FROM seguromedico WHERE matricula = :matricula";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
    $stmt->execute();
    $resultSeguroMedico = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    registrarError(
        'PDOException',
        "Error: No se proporciono una matricula. ",
        'verInfoUsuarioController.php: línea 5'
    );
    $errorMensaje = 'No se proporciono una matricula.';
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

?>