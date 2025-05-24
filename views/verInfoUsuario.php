<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>enfermería</title>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/bootstrap.min.css">

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css"
        integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

    <!-- jQuery (necesario para Bootstrap 4) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


    <!-- lazy styling -->
    <link rel="stylesheet" href="../assets/css/lazy.css">

    <link rel="stylesheet" href="../assets/css/verInfoUsuario.css">

    <?php
    $primary = "primary";
    $secondary = "secondary";
    $success = "success";
    $info = "info";
    $warning = "warning";
    $danger = "danger";
    $light = "light";
    $dark = "dark";
    ?>

</head>
<?php
include "../Controllers/logger.php";
session_start();
if (!isset($_SESSION['matricula'])) {
    registrarError(
        'Not session started',
        "Inicia sesion antes de ingresar al sistema.",
        'validarSesion.php: línea 8'
    );
    $errorMensaje = '¡Por favor!, inicia sesion antes de ingresar al sistema';
    ?>
    <html>

    <body>
        <form id="formRedirect" action="../views/Login.php" method="post">
            <input type="hidden" name="error" value="<?= htmlspecialchars($errorMensaje) ?>">
        </form>
        <script>
            document.getElementById('formRedirect').submit();
        </script>
    </body>

    </html>
    <?php
}
include 'navbar.php';
include '../Controllers/verInfoUsuarioController.php';
?>

<body>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['error'])): ?>
        <div id="" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: block;">
            <strong>Error! </strong> <?= htmlspecialchars($_POST['error']) ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mensaje'])): ?>
        <div id="" class="alert alert-success alert-dismissible fade show" role="alert" style="display: block;">
            <strong>Info! </strong> <?= htmlspecialchars($_POST['mensaje']) ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Alerta solo para dispositivos moviles -->
    <div id="alerta-movil" class="alert alert-warning alert-dismissible fade show" role="alert" style="display: none;">
        <strong>Atención!</strong> La mayor parte del sistema fue hecho para su uso en computadora, por lo que algunas
        partes pueden mostrarse de forma incorrecta en dispositivos moviles.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        // Mostrar alerta solo si el ancho de la ventana es menor o igual a 768px
        if (window.innerWidth <= 768) {
            document.getElementById("alerta-movil").style.display = "block";
        }
    </script>
    <!--Contenido de la pagina-->

    <div class="containerInfo">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-page1" role="tab"
                    aria-controls="nav-home" aria-selected="true">Paciente</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-page2" role="tab"
                    aria-controls="nav-profile" aria-selected="false">Historial Medico</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-page3" role="tab"
                    aria-controls="nav-profile" aria-selected="false">Salud Mental</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-page4" role="tab"
                    aria-controls="nav-contact" aria-selected="false">Vacunación</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-page5" role="tab"
                    aria-controls="nav-contact" aria-selected="false">Seguro Medico</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-page6" role="tab"
                    aria-controls="nav-contact" aria-selected="false">Consultas medicas</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-page1" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row"><!--Inicia fila-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-blue contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Matricula: </h1>
                            <?php echo htmlspecialchars($matricula, ENT_QUOTES); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-blue contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Nombre: </h1><?php echo htmlspecialchars($nombre, ENT_QUOTES); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-purple contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Apellido Paterno: </h1>
                            <?php echo htmlspecialchars($apellidoPaterno, ENT_QUOTES); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-blue contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Apellido Materno: </h1>
                            <?php echo htmlspecialchars($apellidoMaterno, ENT_QUOTES); ?>
                        </div>
                    </div>
                </div><!--Termina fila-->
                <div class="row"><!--Inicia fila-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-purple contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Fecha de Nacimiento: </h1>
                            <?php echo htmlspecialchars($fechaNacimiento, ENT_QUOTES); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-blue contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Genero: </h1><?php echo htmlspecialchars($genero, ENT_QUOTES); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-purple contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Tipo de Sangre: </h1>
                            <?php echo htmlspecialchars($tipoSangre, ENT_QUOTES); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-blue contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Rol: </h1><?php echo htmlspecialchars($rol, ENT_QUOTES); ?>
                        </div>
                    </div>
                </div><!--Termina fila-->
                <div class="row"><!--Inicia fila-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-purple contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Tutor: </h1>
                            <?php echo htmlspecialchars($contactoEmergenciaNombre, ENT_QUOTES); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-blue contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Contacto Tutor: </h1>
                            <?php echo htmlspecialchars($contactoEmergenciaTelefono, ENT_QUOTES); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-purple contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Parentesco: </h1>
                            <?php echo htmlspecialchars($contactoEmergenciaRelacion, ENT_QUOTES); ?>
                        </div>
                    </div>
                </div><!--Termina fila-->
            </div>

            <!--Ventana 2-->
            <div class="tab-pane fade" id="nav-page2" role="tabpanel" aria-labelledby="nav-profile-tab">
                <p class="descripcion text-uppercase" style="display: flex; justify-content: center; width: 100%;">Paciente: <?php echo htmlspecialchars($nombre, ENT_QUOTES);?>&nbsp;<?php echo htmlspecialchars($apellidoPaterno, ENT_QUOTES);?>&nbsp;<?php echo htmlspecialchars($apellidoMaterno, ENT_QUOTES); ?>,&nbsp; <?php echo htmlspecialchars($matricula, ENT_QUOTES);?></p>
                <div class="row"><!--Inicia fila-->
                    
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-blue contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Enfermedades: </h1>
                            <ul>
                                <?php foreach ($resultHistorialMedico as $fila) { ?>
                                    <li><?php echo htmlspecialchars($fila['enfermedades'], ENT_QUOTES); ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-blue contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Alergias: </h1>
                            <ul>
                                <?php foreach ($resultHistorialMedico as $fila) { ?>
                                    <li><?php echo htmlspecialchars($fila['alergias'], ENT_QUOTES); ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-purple contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Cirugias: </h1>
                            <ul>
                                <?php foreach ($resultHistorialMedico as $fila) { ?>
                                    <li><?php echo htmlspecialchars($fila['cirugias'], ENT_QUOTES); ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-blue contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Medicación: </h1>
                            <ul>
                                <?php foreach ($resultHistorialMedico as $fila) { ?>
                                    <li><?php echo htmlspecialchars($fila['medicacion'], ENT_QUOTES); ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div><!--Termina fila-->
                <div class="row"><!--Inicia fila-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="panel panel-purple contenidoEtiqueta">
                            <h1 class="nombreEtiqueta">Discapacidad: </h1>
                            <ul>
                                <?php foreach ($resultHistorialMedico as $fila) { ?>
                                    <li><?php echo htmlspecialchars($fila['discapacidad'], ENT_QUOTES); ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                </div><!--Termina fila-->
            </div>

            <!--Ventana 3-->
            <div class="tab-pane fade" id="nav-page3" role="tabpanel" aria-labelledby="nav-contact-tab">
                <p class="descripcion text-uppercase" style="display: flex; justify-content: center; width: 100%;">Paciente: <?php echo htmlspecialchars($nombre, ENT_QUOTES);?>&nbsp;<?php echo htmlspecialchars($apellidoPaterno, ENT_QUOTES);?>&nbsp;<?php echo htmlspecialchars($apellidoMaterno, ENT_QUOTES); ?>,&nbsp; <?php echo htmlspecialchars($matricula, ENT_QUOTES);?></p>
                <div class="row"><!--Inicia fila-->
                    <?php foreach ($resultSaludMental as $fila) { ?>
                        <div class="col-sm-6 col-lg-3">
                            <div class="panel panel-blue contenidoEtiqueta">
                                <h1 class="nombreEtiqueta">Diagnostico: </h1>
                                <?php echo htmlspecialchars($fila['diagnostico'], ENT_QUOTES); ?>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="panel panel-blue contenidoEtiqueta">
                                <h1 class="nombreEtiqueta">Terapia: </h1>
                                <?php echo htmlspecialchars($fila['terapia'], ENT_QUOTES); ?>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="panel panel-purple contenidoEtiqueta">
                                <h1 class="nombreEtiqueta">Nombre Terapeuta: </h1>
                                <?php echo htmlspecialchars($fila['contacto_terapeuta'], ENT_QUOTES); ?>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="panel panel-blue contenidoEtiqueta">
                                <h1 class="nombreEtiqueta">Telefono terapeuta: </h1>
                                <?php echo htmlspecialchars($fila['telefono_terapeuta'], ENT_QUOTES); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div><!--Termina fila-->
            </div>

            <!--Ventana 4-->
            <div class="tab-pane fade" id="nav-page4" role="tabpanel" aria-labelledby="nav-contact-tab">
            <p class="descripcion text-uppercase" style="display: flex; justify-content: center; width: 100%;">Paciente: <?php echo htmlspecialchars($nombre, ENT_QUOTES);?>&nbsp;<?php echo htmlspecialchars($apellidoPaterno, ENT_QUOTES);?>&nbsp;<?php echo htmlspecialchars($apellidoMaterno, ENT_QUOTES); ?>,&nbsp; <?php echo htmlspecialchars($matricula, ENT_QUOTES);?></p>
                <div class="row"><!--Inicia fila-->
                    <div class="panel panel-blue contenidoImagen">
                        <h1 class="nombreEtiqueta">Cartilla de vacunacion del paciente</h1>
                        <?php foreach ($resultVacunacion as $fila):
                            $imgPath = "../assets/Img/CartillasVacunacion/" . htmlspecialchars($fila['direccion_img'], ENT_QUOTES);
                            if (!empty($fila['direccion_img']) && file_exists($imgPath)): ?>
                                <img src="<?php echo $imgPath; ?>" class="img-fluid mx-auto d-block"
                                    alt="Cartilla de vacunación">
                            <?php else: ?>
                                <p>No hay imagen de cartilla disponible.</p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div><!--Termina fila-->
            </div>

            <!--Ventana 5-->
            <div class="tab-pane fade" id="nav-page5" role="tabpanel" aria-labelledby="nav-contact-tab">
            <p class="descripcion text-uppercase" style="display: flex; justify-content: center; width: 100%;">Paciente: <?php echo htmlspecialchars($nombre, ENT_QUOTES);?>&nbsp;<?php echo htmlspecialchars($apellidoPaterno, ENT_QUOTES);?>&nbsp;<?php echo htmlspecialchars($apellidoMaterno, ENT_QUOTES); ?>,&nbsp; <?php echo htmlspecialchars($matricula, ENT_QUOTES);?></p>
                <div class="row"><!--Inicia fila-->
                    <?php foreach ($resultSeguroMedico as $fila) { ?>
                        <div class="col-sm-6 col-lg-3">
                            <div class="panel panel-blue contenidoEtiqueta">
                                <h1 class="nombreEtiqueta">Nombre del seguro: </h1>
                                <?php echo htmlspecialchars($fila['aseguradora'], ENT_QUOTES); ?>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="panel panel-blue contenidoEtiqueta">
                                <h1 class="nombreEtiqueta">Numero de poliza: </h1>
                                <?php echo htmlspecialchars($fila['numero_poliza'], ENT_QUOTES); ?>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="panel panel-purple contenidoEtiqueta">
                                <h1 class="nombreEtiqueta">Hospital de referencia: </h1>
                                <?php echo htmlspecialchars($fila['hospital_referencia'], ENT_QUOTES); ?>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="panel panel-purple contenidoEtiqueta">
                                <h1 class="nombreEtiqueta">Medico de Cabecera: </h1>
                                <?php echo htmlspecialchars($fila['medico_cabecera'], ENT_QUOTES); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div><!--Termina fila-->
            </div>
            <!--Consulta del historial de consultas medicas-->
            <?php $sql = "SELECT id_consulta, fecha, motivo_consulta FROM consulta_medica WHERE matricula = :matricula";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>
            
            <!--Ventana 6-->
            <div class="tab-pane fade show" id="nav-page6" role="tabpanel" aria-labelledby="nav-home-tab">
            <p class="descripcion text-uppercase" style="display: flex; justify-content: center; width: 100%;">Paciente: <?php echo htmlspecialchars($nombre, ENT_QUOTES);?>&nbsp;<?php echo htmlspecialchars($apellidoPaterno, ENT_QUOTES);?>&nbsp;<?php echo htmlspecialchars($apellidoMaterno, ENT_QUOTES); ?>,&nbsp; <?php echo htmlspecialchars($matricula, ENT_QUOTES);?></p>
            <div class="row"><!--Inicia fila-->
                    <p class="nombreEtiqueta">Historial de consultas medicas</p>
                    <p class="descripcion">🔴 El historial de consultas medicas solo muestra la informacion recopilada de consultas medicas del paciente, dentro del departamento de enfermeria en el ITSPR.</p>
                    <center><a href="consultaMedica.php?matricula=<?php echo htmlspecialchars($matricula, ENT_QUOTES); ?>">Agregar consulta medica</a> </center>   
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Motivo</th>
                            <th scope="col">Ver Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $fila) { ?>
                                <tr style="max-height: 20px;">
                                    <th scope="row" style="width: 50px;"><?php echo htmlspecialchars($fila['fecha'], ENT_QUOTES); ?></th>
                                    <td style="text-align: justify;"><?php echo htmlspecialchars($fila['motivo_consulta'], ENT_QUOTES); ?></td>
                                    <td><button type="button" class="btn btn-info" onclick="window.location.href='../views/detallesConsultaMedica.php?id_consulta=<?php echo htmlspecialchars($fila['id_consulta'], ENT_QUOTES); ?>&matricula=<?php echo htmlspecialchars($matricula, ENT_QUOTES); ?>'">
                                        Mostrar
                                    </button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
            </div>

        </div>
    </div>
</body>

</html>