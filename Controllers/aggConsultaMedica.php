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

    $temperatura = $_POST["temperatura"];
    $presion_arterial = $_POST["presion_arterial"];
    $frecuencia_cardiaca = $_POST["frecuencia_cardiaca"];
    $peso = $_POST["peso"];
    $estatura = $_POST["estatura"];
    $diagnostico = $_POST["diagnostico"];
    $tratamiento = $_POST["tratamiento"];
    $requiere_urgencia  = $_POST["requiere_urgencia"]?? 'False';

    $urlAnterior = '../views/verinfoUsuario.php?matricula='.$matricula;
    
            
    try {
        $pdo->beginTransaction();
        //INSERTAMOS DATOS GENERALES DEL USUARIO
        $sql = "INSERT INTO consulta_Medica (matricula, fecha, motivo_consulta, temperatura, presion_arterial, frecuencia_cardiaca, peso, estatura, diagnostico, tratamiento, requiere_urgencia) VALUES (:matricula, :fecha, :motivo_consulta, :temperatura, :presion_arterial, :frecuencia_cardiaca, :peso, :estatura, :diagnostico, :tratamiento, :requiere_urgencia)";
        //$sql = "INSERT INTO historialmedico (enfermedades, alergias, cirugias, medicacion, discapacidad) VALUES (:enfermedades, :alergias, :cirugias, :medicacion, :discapacidad)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["matricula"=>$matricula, "fecha"=>$fecha, "motivo_consulta"=>$motivo_consulta, "temperatura"=>$temperatura, "presion_arterial"=>$presion_arterial, "frecuencia_cardiaca"=>$frecuencia_cardiaca, "peso"=>$peso, "estatura"=>$estatura, "diagnostico"=>$diagnostico, "tratamiento"=>$tratamiento, "requiere_urgencia"=>$requiere_urgencia]);

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
        exit(); // ← MUY IMPORTANTE

    }
               
}
?>
