<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Medica</title>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <!--IMPLEMENTACION DE Tagify-->
    <!-- Tagify CSS y JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">

    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

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
    <link rel="stylesheet" href="../assets/css/consultaMedica.css">

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
include "../Controllers/consultaMedicaController.php";
?>

<body>

    <?php
    if (isset($_SESSION["mensaje"])) {
        echo "<script>alert('" . $_SESSION["mensaje"] . "');</script>";
        unset($_SESSION["mensaje"]);
    } ?>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['error'])): ?>
        <div id="" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: block;">
            <strong>Error! </strong> <?= htmlspecialchars($_POST['error']) ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif;
    ?>


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

    <div class="containerInfo container">

        <h3 class="text">
            <i class="iconify" data-icon="twemoji:stethoscope" style="color: #007bff;"></i>
            Visita a enfermeria y vacunacion
        </h3>
        <div class="row">
            <ul class="list-group">
                <li class="list-group-item">
                    <p class="text-center text-dark font-weight-bold">INFORMACIÓN DEL PACIENTE</p>
                </li>
                <li class="list-group-item">
                    <p class="text-left text-info text-uppercase font-weight-bold">Matricula:&nbsp;
                    <p class="text-left text-dark"></p><?php echo htmlspecialchars($matricula, ENT_QUOTES); ?></p>
                </li>
                <li class="list-group-item">
                    <p class="text-left text-info text-uppercase font-weight-bold">Nombre del paciente:&nbsp;
                    <p class="text-left text-dark"></p><?php echo htmlspecialchars($nombre, ENT_QUOTES); ?>
                    <?php echo htmlspecialchars($apellido_paterno, ENT_QUOTES); ?>
                    <?php echo htmlspecialchars($apellido_materno, ENT_QUOTES); ?></p>
                </li>
                <li class="list-group-item">
                    <p class="text-left text-info text-uppercase font-weight-bold">Fecha de nacimiento:&nbsp;
                    <p class="text-left text-dark"></p><?php echo htmlspecialchars($fechaNacimiento, ENT_QUOTES); ?></p>
                </li>
                <li class="list-group-item">
                    <p class="text-left text-info text-uppercase font-weight-bold">Sexo:&nbsp;
                    <p class="text-left text-dark"></p><?php echo htmlspecialchars($genero, ENT_QUOTES); ?></p>
                </li>
                <li class="list-group-item">
                    <p class="text-left text-info text-uppercase font-weight-bold">Tipo de sangre:&nbsp;
                    <p class="text-left text-dark"></p><?php echo htmlspecialchars($tipo_sangre, ENT_QUOTES); ?></p>
                </li>
                <li class="list-group-item">
                    <p class="text-left text-info text-uppercase font-weight-bold">Mas informacion del paciente:&nbsp;
                    </p>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#grid1">
                        Mostrar
                    </button>
                </li>
            </ul>
        </div>


        <div class="col-md-12">
            <div style="border-top: 1px solid #000; margin: 20px 0;"></div>
            <div class="bg-white text-dark basic-form">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-page1"
                            role="tab" aria-controls="nav-home" aria-selected="true">Visita a enfermeria</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-page2" role="tab"
                            aria-controls="nav-profile" aria-selected="false">Registrar nueva vacuna</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <!--Inicia ventana 1-->
                    <div class="tab-pane fade show active col-md-12" id="nav-page1" role="tabpanel"
                        aria-labelledby="nav-home-tab" style="height: 300px;">
                        <!--Registrar visita medica-->
                        <!--form-->
                        <form id="formConsultaMedica" action="../Controllers/aggConsultaMedica.php" method="POST"
                            enctype="multipart/form-data">
                            <input type="hidden" name="matricula"
                                value="<?php echo htmlspecialchars($matricula, ENT_QUOTES); ?>">
                            <div class="card-body">
                                <br>

                                <div class="panel form-group">
                                    <h1 class="nombreEtiqueta">Motivo de la consulta: </h1>
                                    <textarea class="form-control" name="motivo_consulta" id="description1" rows="3"
                                        placeholder="Motivos y sintomas por el que asiste el paciente a consulta medica..."
                                        required></textarea>
                                </div>
                            </div>
                        </form>
                        <center><button type="submit" form="formConsultaMedica" class="btn btn-info">Guardar
                                consulta</button></center>
                    </div>

                    <!--Ventana 2-->
                    <div class="tab-pane fade" id="nav-page2" role="tabpanel" aria-labelledby="nav-profile-tab"
                        style="height: 300px;">
                        <!--Tabla para el registro de vacunas-->
                        <!-- Tabla de vacunas actualizado-->
                        <div class="col-12">
                            <h2 class="text-center">Agregar nuevo registro de vacuna aplicada</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nombre de Vacuna</th>
                                            <th>Dosis</th>
                                            <th>Observaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form id="formRegistrarVacuna"
                                            action="../Controllers/agregarRegistroVacunaController.php" method="POST"
                                            enctype="multipart/form-data">
                                            <td><input type="text" name="nombreVacuna" required style="margin: 10px; ">
                                            </td>
                                            <td><input type="number" name="dosis" placeholder="en ml" required><label
                                                    style="margin: 10px; font-size: 1.2rem;"><strong>ml</strong></label>
                                            </td>
                                            <td><textarea name="Observaciones" id="" style="margin: 10px;"></textarea>
                                            </td>
                                            <input name="matricula" value="<?php echo $matricula ?>" hidden>
                                        </form>
                                        </tr>
                                    </tbody>
                                </table>
                                <center><button type="submit" form="formRegistrarVacuna" class="btn btn-info">Guardar
                                        visita</button></center>
                            </div>
                        </div>
                    </div><!-- Termina fila -->
                </div><!--Termina el contenido de la ventana 2-->
            </div>
        </div>
    </div>


    <!--DISEÑO MODAL DE LA VISTA DE LA INFORMACION-->
    <?php include '../Controllers/verInfoUsuarioController.php'; ?>
    <div class="modal fade" id="grid1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informacion parcial del paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Contenido-->

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-page1"
                            role="tab" aria-controls="nav-home" aria-selected="true">Paciente</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-page2" role="tab"
                            aria-controls="nav-profile" aria-selected="false">Historial Medico</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-page3" role="tab"
                            aria-controls="nav-profile" aria-selected="false">Salud Mental</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-page4" role="tab"
                            aria-controls="nav-contact" aria-selected="false">Vacunación</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-page5" role="tab"
                            aria-controls="nav-contact" aria-selected="false">Seguro Medico</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-page1" role="tabpanel"
                        aria-labelledby="nav-home-tab">
                        <div class="row"><!--Inicia fila-->
                            <div class="col-sm-6 col-lg-3">
                                <div class="panel panel-blue contenidoEtiqueta">
                                    <h1 class="nombreEtiqueta">Matricula: </h1>
                                    <?php echo htmlspecialchars($matricula, ENT_QUOTES); ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="panel panel-blue contenidoEtiqueta">
                                    <h1 class="nombreEtiqueta">Nombre: </h1>
                                    <?php echo htmlspecialchars($nombre, ENT_QUOTES); ?>
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
                                    <h1 class="nombreEtiqueta">Genero: </h1>
                                    <?php echo htmlspecialchars($genero, ENT_QUOTES); ?>
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
                                    <h1 class="nombreEtiqueta">Rol: </h1>
                                    <?php echo htmlspecialchars($rol, ENT_QUOTES); ?>
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

                    <!-- Ventana 4 actualizado-->
                    <div class="tab-pane fade" id="nav-page4" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <p class="descripcion text-uppercase"
                            style="display: flex; justify-content: center; width: 100%;">
                            Paciente:
                            <?php echo htmlspecialchars($nombre, ENT_QUOTES); ?>&nbsp;<?php echo htmlspecialchars($apellidoPaterno, ENT_QUOTES); ?>&nbsp;<?php echo htmlspecialchars($apellidoMaterno, ENT_QUOTES); ?>,&nbsp;
                            <?php echo htmlspecialchars($matricula, ENT_QUOTES); ?>
                        </p>

                        <div class="row">
                            <!-- Imagen de cartilla -->
                            <div class="panel panel-blue contenidoImagen mb-4">
                                <h1 class="nombreEtiqueta">Cartilla de vacunación del paciente</h1>
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

                            <!-- Tabla de vacunas actualizado-->
                            <div class="col-12">
                                <h2 class="text-center">Registros de Vacunas Aplicadas</h2>
                                <?php if (!empty($resultVacunacion)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nombre de Vacuna</th>
                                                    <th>Fecha de Aplicación</th>
                                                    <th>Dosis</th>
                                                    <th>Observaciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($resultVacunas as $registro): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($registro['nombre_vacuna'], ENT_QUOTES); ?>
                                                        </td>
                                                        <td><?php echo htmlspecialchars($registro['fecha_aplicacion'], ENT_QUOTES); ?>
                                                        </td>
                                                        <td><?php echo htmlspecialchars($registro['dosis'], ENT_QUOTES); ?></td>
                                                        <td><?php echo htmlspecialchars($registro['observaciones'], ENT_QUOTES); ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <p class="text-center">No hay registros de vacunación disponibles.</p>
                                <?php endif; ?>
                            </div>
                        </div><!-- Termina fila -->
                    </div>

                    <!--Ventana 5-->
                    <div class="tab-pane fade" id="nav-page5" role="tabpanel" aria-labelledby="nav-contact-tab">
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

                </div>

            </div>
        </div>
    </div><!----Fin modal-->

</body>

</html>