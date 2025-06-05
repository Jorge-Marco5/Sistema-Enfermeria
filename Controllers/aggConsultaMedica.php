<?php
/*
Controlador que agrega una consulta medicas del usuario que asiste a enfermeria
*/
require "../Config/conexion.php";
include "logger.php";
$errorMensaje = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //INFORMACION GENERAL
    
    $matricula = $_POST["matricula"];
    $fecha = date("Y-m-d H:i:s");
    $motivo_consulta = $_POST["motivo_consulta"];


    $urlAnterior = '../views/verinfoUsuario.php?matricula='.$matricula;
    
            
    try {
        $pdo->beginTransaction();
        //INSERTAMOS DATOS GENERALES DEL USUARIO
        $sql = "INSERT INTO consulta_Medica (matricula, fecha, motivo_consulta) VALUES (:matricula, :fecha, :motivo_consulta)";
        //$sql = "INSERT INTO historialmedico (enfermedades, alergias, cirugias, medicacion, discapacidad) VALUES (:enfermedades, :alergias, :cirugias, :medicacion, :discapacidad)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["matricula"=>$matricula, "fecha"=>$fecha, "motivo_consulta"=>$motivo_consulta]);

        $pdo->commit();
        registrarError(
            'Succesfuly inserted',
            'Info: Se agrego a la base de datos consulta medica de la matricula:'.$matricula,
            'aggConsultaMedica.php: línea 37'
        );
        
        $errorMensaje = 'Se agregó a la base de datos consulta médica de la matrícula: '.$matricula;
        ?>
        <html>
        <body>
            <form id="formRedirect" action="../views/verInfoUsuario.php?matricula=<?= urlencode($matricula) ?>" method="post">
                <input type="hidden" name="mensaje" value="<?= htmlspecialchars($errorMensaje) ?>">
            </form>
            <script>
                document.getElementById('formRedirect').submit();
            </script>
        </body>
        </html>
        <?php exit();


    } catch (PDOException $e) {
        $pdo->rollBack();
        registrarError(
            'PDOException',
            "Error al guardar los datos. ".$e->getMessage(),
            'aggConsultaMedica.php: línea 32'
        );
        $errorMensaje = 'Error al guardar los datos: '.$e->getMessage();
        ?>
        <html> <body><form id="formRedirect" action="../views/ListaConsultaMedica.php" method="post">
                    <input type="hidden" name="error" value="<?= htmlspecialchars($errorMensaje) ?>">
                </form>
                <script>
                    document.getElementById('formRedirect').submit();
                </script>
        </body></html>
        <?php
        exit(); 

    }
               
}
?>
