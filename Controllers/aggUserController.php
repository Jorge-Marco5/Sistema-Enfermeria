<?php
require "../Config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    
    

    $sql = "INSERT INTO personas (matricula, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, genero, tipo_sangre, rol, contacto_emergencia_nombre, contacto_emergencia_telefono, contacto_emergencia_relacion) VALUES (:matricula, :nombre, :apellido_paterno, :apellido_materno, :fecha_nacimiento, :genero, :tipo_sangre, :rol, :contacto_emergencia_nombre, :contacto_emergencia_telefono, :contacto_emergencia_relacion)";
    //$sql = "INSERT INTO historialmedico (enfermedades, alergias, cirugias, medicacion, discapacidad) VALUES (:enfermedades, :alergias, :cirugias, :medicacion, :discapacidad)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute(["matricula"=>$matricula, "nombre"=>$nombre, "apellido_paterno"=>$apellidoPaterno, "apellido_materno"=>$apellidoMaterno, "fecha_nacimiento"=>$fechaNacimiento, "genero"=>$genero, "tipo_sangre"=>$tipoSangre, "rol"=>$rol, "contacto_emergencia_nombre"=>$contactoEmergenciaNombre, "contacto_emergencia_telefono"=>$contactoEmergenciaTelefono, "contacto_emergencia_relacion"=>$contactoEmergenciaRelacion]);
        header("Location: ../views/Adm/agregarDatosMedicosUsuario.php?matricula=$matricula");
    } catch (PDOException $e) {
        registrarError(
            'PDOException',
            $e->getMessage(),
            'aggUserController.php: línea 24'
        );
        echo "Error al registrar: " . $e->getMessage();
    }
}
?>
