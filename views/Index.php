<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enfermería</title>
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
  <link rel="stylesheet" href="../assets/css/Hola.css">
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
include("../Controllers/logger.php");
session_start();
if (!isset($_SESSION['matricula'])) {
  registrarError(
    'Not session started',
    "Inicia sesion antes de ingresar al sistema.",
    'validarSesion.php: línea 8'
  );
  //$errorMensaje = '¡Por favor!, inicia sesion antes de ingresar al sistema';
  ?>
  <html>

  <body>
    <form id="formRedirect" action="Login.php" method="post">
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

  <div class="container">
    <div class="card" style="background-color:rgb(252, 146, 146);">
      <div class="card-header">
        <img class="card-img" src="../assets/img/Emergencia.jpg" alt="Emergencia">
      </div>
      <div class="card-body">
        <span class="badge badge-<?php echo $danger; ?>">Emergencia</span>
        <h4 class="card-title mt-2">🚨Emergencia</h4>
        <p class="card-text">En caso de una situación de emergencia grave, extrae un reporte resumido del paciente para
          posteriormente canalizarlo al hospital más cercano. </p>
      </div>
      <div class="card-footer">
        <a href="emergencia.php" class="btn btn-<?php echo $danger; ?>">Aceptar</a>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <img class="card-img" src="../assets/img/consultaMedica.jpg" alt="Consulta medica">
      </div>
      <div class="card-body">
        <span class="badge badge-<?php echo $warning; ?>">Urgente</span>
        <h4 class="card-title mt-2">Consulta Medica</h4>
        <p class="card-text">Urgencia sentida, Consulta el historial médico del paciente para su tratamiento inmediato y
          agrega al historial de consultas del paciente. </p>
      </div>
      <div class="card-footer">
        <a href="listaConsultaMedica.php" class="btn btn-<?php echo $info; ?>">Aceptar</a>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <img class="card-img" src="../assets/img/reporteMedico.jpg" alt="Reporte medico">
      </div>
      <div class="card-body">
        <span class="badge badge-<?php echo $success; ?>">información</span>
        <h4 class="card-title mt-2">Reporte medico</h4>
        <p class="card-text">Consulta los datos de un paciente y extrae un reporte completo a cerca de la información de
          su historial médico. </p>
      </div>
      <div class="card-footer">
        <a href="./verListaPacientes.php" class="btn btn-<?php echo $info; ?>">Aceptar</a>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <img class="card-img" src="../assets/img/nuevoPaciente.jpg" alt="Nuevo paciente">
      </div>
      <div class="card-body">
        <span class="badge badge-<?php echo $success; ?>">información</span>
        <h4 class="card-title mt-2">Agregar nuevo usuario</h4>
        <p class="card-text">Agrega un nuevo paciente y su historial médico para futuras consultas. </p>
      </div>
      <div class="card-footer">
        <a href="./agregarNuevoUsuario.php" class="btn btn-<?php echo $info; ?>">Aceptar</a>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <img class="card-img" src="../assets/img/inventarioMedicinas.jpg" alt="Inventario de Medicinas">
      </div>
      <div class="card-body">
        <span class="badge badge-<?php echo $success; ?>">información</span>
        <h4 class="card-title mt-2">Inventario de medicinas</h4>
        <p class="card-text">Lleva un control del inventario de medicamentos en el departamento de enfermería. </p>
      </div>
      <div class="card-footer">
        <a href="pagPrueba.php" class="btn btn-<?php echo $info; ?>">Aceptar</a>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <img class="card-img" src="../assets/img/correccionInformacion.jpg" alt="Corregir informacion">
      </div>
      <div class="card-body">
        <span class="badge badge-<?php echo $success; ?>">información</span>
        <h4 class="card-title mt-2">Campañas medicas</h4>
        <p class="card-text">Visualiza y registra algun evento clinico como campañas de vacunacion, informacion, etc</p>
      </div>
      <div class="card-footer">
        <a href="Campañas.php" class="btn btn-<?php echo $info; ?>">Aceptar</a>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <img class="card-img" src="../assets/img/enfermeros.jpg" alt="Personal de enfermería">
      </div>
      <div class="card-body">
        <span class="badge badge-<?php echo $success; ?>">Información</span>
        <h4 class="card-title mt-2">Personal de enfermería</h4>
        <p class="card-text">Consulta y registra la información del personal perteneciente al departamento de
          enfermería. </p>
      </div>
      <div class="card-footer">
        <a href="Administradores.php" class="btn btn-<?php echo $info; ?>">Aceptar</a>
      </div>
    </div>
    <div class="card" style="background-color:rgb(216, 216, 216);">
      <div class="card-header">
        <img class="card-img" src="../assets/img/infoDesarrollador.jpg" alt="Informacion del desarrollador">
      </div>
      <div class="card-body">
        <span class="badge badge-<?php echo $success; ?>">Información</span>
        <h4 class="card-title mt-2">Información del desarrollador</h4>
        <p class="card-text">Consulta la información del desarrollador para contactar en caso de errores en el sistema.
        </p>
      </div>
      <div class="card-footer">
        <a href="pagPrueba.php" class="btn btn-<?php echo $info; ?>">Aceptar</a>
      </div>
    </div>
    <!------------------------------------>
  </div>
</body>

</html>