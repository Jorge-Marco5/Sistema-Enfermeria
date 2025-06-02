<?php
/*
Controlador para agregar un nuevo usuario
*/
require "../Config/conexion.php";
include "logger.php";
$errorMensaje = null;

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //INFORMACION GENERAL
    //Primero guardamos la informacion del usuario, para posteriormente obtener el id y guardar
    //la demas informacion de enfermedades con el dato del id relacionado al alumno.
    
    
    //INFORMACION GENERAL
    $matricula = $_POST["matricula"];
    $nombre = $_POST["nombre"];
    $apellidoPaterno = $_POST["apellidoPaterno"];
    $apellidoMaterno = $_POST["apellidoMaterno"];
    $fechaNacimiento = $_POST["fechaNacimiento"];
    $genero = $_POST["Genero"];
    $tipoSangre = $_POST["tipoSangre"];
    $rol = $_POST["rol"];
    $contactoEmergenciaNombre = $_POST["contactoEmergenciaNombre"];
    $contactoEmergenciaTelefono = $_POST["contactoEmergenciaTelefono"];
    $contactoEmergenciaRelacion = $_POST["contactoEmergenciaRelacion"];
    //HISTORIAL MEDICO
    $enfermedades = $_POST["enfermedades"];
    $alergias = $_POST["alergias"];
    $cirugias = $_POST["cirugias"];
    $medicacion = $_POST["medicacion"];
    $discapacidad = $_POST["discapacidad"];
    //SALUD MENTAL
    $diagnostico = $_POST["diagnostico"];
    $terapia = $_POST["terapia"];
    $contactoTerapeuta = $_POST["contactoTerapeuta"];
    $telefonoTerapeuta = $_POST["telefonoTerapeuta"];
    //SEGURO MEDICO
    $aseguradora = $_POST["aseguradora"];
    $numeroSeguroSocial = $_POST["numeroSeguroSocial"];
    $hospitalReferencia = $_POST["hospitalReferencia"];
    $medicoCabecera = $_POST["medicoCabecera"];

    $urlAnterior = '../views/verinfoUsuario.php?matricula=' . $matricula;
    
            
    try {
        $pdo->beginTransaction();
        //INSERTAMOS DATOS GENERALES DEL USUARIO
        $sql = "INSERT INTO personas (matricula, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, genero, tipo_sangre, rol, contacto_emergencia_nombre, contacto_emergencia_telefono, contacto_emergencia_relacion) VALUES (:matricula, :nombre, :apellido_paterno, :apellido_materno, :fecha_nacimiento, :genero, :tipo_sangre, :rol, :contacto_emergencia_nombre, :contacto_emergencia_telefono, :contacto_emergencia_relacion)";
        //$sql = "INSERT INTO historialmedico (enfermedades, alergias, cirugias, medicacion, discapacidad) VALUES (:enfermedades, :alergias, :cirugias, :medicacion, :discapacidad)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["matricula"=>$matricula, "nombre"=>$nombre, "apellido_paterno"=>$apellidoPaterno, "apellido_materno"=>$apellidoMaterno, "fecha_nacimiento"=>$fechaNacimiento, "genero"=>$genero, "tipo_sangre"=>$tipoSangre, "rol"=>$rol, "contacto_emergencia_nombre"=>$contactoEmergenciaNombre, "contacto_emergencia_telefono"=>$contactoEmergenciaTelefono, "contacto_emergencia_relacion"=>$contactoEmergenciaRelacion]);

        //INSERTAMOS DATOS DE LAS ENFERMEDADES DEL USUARIO
        $sql = "INSERT INTO historialmedico (matricula, enfermedades, alergias, cirugias, medicacion, discapacidad) VALUES (:matricula, :enfermedades, :alergias, :cirugias, :medicacion, :discapacidad)";
        //$sql = "INSERT INTO historialmedico (enfermedades, alergias, cirugias, medicacion, discapacidad) VALUES (:enfermedades, :alergias, :cirugias, :medicacion, :discapacidad)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["matricula"=>$matricula, "enfermedades"=>$enfermedades, "alergias"=>$alergias, "cirugias"=>$cirugias, "medicacion"=>$medicacion, "discapacidad"=>$discapacidad]);

        $sql = "INSERT INTO saludmental (matricula, diagnostico, terapia, contacto_terapeuta, telefono_terapeuta) VALUES (:matricula, :diagnostico, :terapia, :contacto_terapeuta, :telefono_terapeuta)";
        //$sql = "INSERT INTO historialmedico (enfermedades, alergias, cirugias, medicacion, discapacidad) VALUES (:enfermedades, :alergias, :cirugias, :medicacion, :discapacidad)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["matricula"=>$matricula, "diagnostico"=>$diagnostico, "terapia"=>$terapia, "contacto_terapeuta"=>$contactoTerapeuta, "telefono_terapeuta"=>$telefonoTerapeuta]);


        $firma_nombre = $_FILES['firma']['name'];
        $firma_tmp = $_FILES['firma']['tmp_name'];
        $firma_extension = pathinfo($firma_nombre, PATHINFO_EXTENSION);

        $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($firma_extension), $extensiones_permitidas)) {
            $pdo->rollBack();
            registrarError(
                'not valid image',
                "Error: La imagen de la cartilla de vacunacion tiene un formato no valido. ",
                'aggUserDataController.php: línea 69'
            );
            $errorMensaje = 'Cartilla de vacunacion. No se agrego una imagen o el formato no es valido';
            ?>
            <html> <body><form id="formRedirect" action="../views/agregarNuevoUsuario.php" method="post">
                        <input type="hidden" name="error" value="<?= htmlspecialchars($errorMensaje) ?>">
                    </form>
                    <script>
                        document.getElementById('formRedirect').submit();
                    </script>
            </body></html>
            <?php
            exit();
        }

        $firma_nuevo_nombre = "Cartilla_" . time() . "." . $firma_extension;
        $firma_ruta = "../assets/Img/CartillasVacunacion/" . $firma_nuevo_nombre;

        // Verifica si el directorio existe, si no, lo crea
        if (!file_exists("../assets/Img/CartillasVacunacion")) {
            mkdir("../assets/Img/CartillasVacunacion", 0777, true);
        }

        if (move_uploaded_file($firma_tmp, $firma_ruta)) {
            $sql = "INSERT INTO vacunacion (matricula, direccion_img) 
                    VALUES (:matricula, :direccion_img)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                "matricula" => $matricula,
                "direccion_img" => $firma_nuevo_nombre
            ]);
        } else {
            $pdo->rollBack();
            registrarError(//Registrar error en el log
                'move_uploaded_file',
                "Error al subir la imagen al servidor. verifique que el formato sea compatible y vuelva a intentar",
                'aggUserDataController.php: línea 87'
            );
            $errorMensaje = 'Error al subir la imagen al servidor.';
            ?>
            <html> <body><form id="formRedirect" action="../views/agregarNuevoUsuario.php" method="post">
                        <input type="hidden" name="error" value="<?= htmlspecialchars($errorMensaje) ?>">
                    </form>
                    <script>
                        document.getElementById('formRedirect').submit();
                    </script>
            </body></html>
            <?php
            exit(); // ← MUY IMPORTANTE
        }

        $sql = "INSERT INTO seguromedico (matricula, aseguradora, numero_poliza, hospital_referencia, medico_cabecera) VALUES (:matricula, :aseguradora, :numero_poliza, :hospital_referencia, :medico_cabecera)";
    //$sql = "INSERT INTO historialmedico (enfermedades, alergias, cirugias, medicacion, discapacidad) VALUES (:enfermedades, :alergias, :cirugias, :medicacion, :discapacidad)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["matricula"=>$matricula, "aseguradora"=>$aseguradora, "numero_poliza"=>$numeroSeguroSocial, "hospital_referencia"=>$hospitalReferencia, "medico_cabecera"=>$medicoCabecera]);

        $pdo->commit();
        echo "<script>alert('Usuario registrado exitosamente.');</script>";
        registrarError(
            'Succesfuly inserted',
            'Info: Se agrego a la base de datos informacion de la matricula:'.$matricula,
            'aggUserDataController.php: línea 127'
        );
        $errorMensaje = 'Se añadio correctamente la informacion de la matricula: '.$matricula;
        ?>
        <html> <body><form id="formRedirect" action="../views/verinfoUsuario.php?matricula=<?= urlencode($matricula) ?>" method="post">
                    <input type="hidden" name="mensaje" value="<?= htmlspecialchars($errorMensaje) ?>">
                </form>
                <script>
                    document.getElementById('formRedirect').submit();
                </script>
        </body></html>
        <?php
        exit();

    } catch (PDOException $e) {
        $pdo->rollBack();
        registrarError(
            'PDOException',
            "Error al guardar los datos. ".$e->getMessage(),
            'aggUserDataController.php: línea 127'
        );
        $errorMensaje = 'Error al guardar los datos: '.$e->getMessage();
        ?>
        <html> <body><form id="formRedirect" action="../views/agregarNuevoUsuario.php" method="post">
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
