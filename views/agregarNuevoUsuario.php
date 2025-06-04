<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar nuevo usuario</title>
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

  <link rel="stylesheet" href="../assets/css/aggNuevoUsuario.css">

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
  <!--Formulario para crear un nuevo usuario-->
<form id="createUserForm" action="../Controllers/aggUserDataController.php" method="POST" enctype="multipart/form-data">
  <div class="containerInfo container mt-4">
    <h2 class="card-title">Datos de salud del paciente</h2>
    <div class="row g-4">

      <!-- PASO 1 -->
      <div class="step" id="step-1">
        <div class="col-md-12">
          <div class="bg-white text-dark basic-form">
            <div class="card-body">
              <h5 class="card-title">Datos generales del paciente</h5>
              <div class="panel panel-blue contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Matricula: </h1><input type="text" name="matricula" class="form-control" placeholder="Matricula" required>
              </div>
              <div class="panel panel-blue contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Nombre: </h1><input type="text" name="nombre" class="form-control" placeholder="Nombre del paciente" required>
              </div>
              <div class="panel panel-purple contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Apellido Paterno: </h1><input type="text" name="apellidoPaterno" class="form-control" placeholder="Apellido Paterno" required>
              </div>
              <div class="panel panel-blue contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Apellido Materno: </h1><input type="text" name="apellidoMaterno" class="form-control" placeholder="Apellido Materno" required>
              </div>
              <div class="panel panel-purple contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Fecha de Nacimiento: </h1><input type="date" name="fechaNacimiento" class="form-control" placeholder="Fecha de Nacimiento" required>
              </div>
              <div class="panel panel-blue contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Genero: </h1>
                <select class="custom-select" name="Genero" required>
                  <option selected disabled>Selecciona una opcion</option>
                  <option value="Masculino">Masculino</option>
                  <option value="Femenino">Femenino</option>
                </select>
              </div>
              <div class="panel panel-purple contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Tipo de Sangre: </h1>
                <select class="custom-select" name="tipoSangre" required>
                  <option selected disabled>Selecciona una opcion</option>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                </select>
              </div>
              <div class="panel panel-blue contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Rol: </h1>
                <select class="custom-select" name="rol" required>
                  <option selected disabled>Selecciona una opcion</option>
                  <option value="Alumno">Alumno</option>
                  <option value="Docente">Docente</option>
                  <option value="Administrativo">Administrativo</option>
                </select>
              </div>
              <button type="button" class="btn btn-info mt-3" onclick="nextStep()">Siguiente</button>
            </div>
          </div>
        </div>
      </div>

      <!-- PASO 2 -->
      <div class="step" id="step-2" style="display:none;">
        <div class="col-md-12">
          <div class="bg-white text-white basic-form">
            <div class="card-body">
              <h5 class="card-title">Datos de emergencia y seguro del paciente</h5>
              <div class="panel panel-purple contenidoEtiqueta">
                <h1 class="nombreEtiqueta">En caso de emergencia llamar a: </h1><input type="text" name="contactoEmergenciaNombre" class="form-control" placeholder="Nombre del Tutor" required>
              </div>
              <div class="panel panel-blue contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Numero de telefono: </h1><input type="text" name="contactoEmergenciaTelefono" class="form-control" placeholder="Numero de telefono del tutor" required>
              </div>
              <div class="panel panel-purple contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Parentesco: </h1><input type="text" name="contactoEmergenciaRelacion" class="form-control" placeholder="Parentesco del paciente" required>
              </div>
              <div class="panel panel-blue contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Nombre del seguro: </h1><input type="text" name="aseguradora" class="form-control" placeholder="Nombre del seguro medico del paciente">
              </div>
              <div class="panel panel-blue contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Numero de poliza: </h1><input type="text" name="numeroSeguroSocial" class="form-control" placeholder="Numero de seguro social">
              </div>
              <div class="panel panel-purple contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Hospital de referencia: </h1><input type="text" name="hospitalReferencia" class="form-control" placeholder="Hospital de referencia">
              </div>
              <div class="panel panel-purple contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Medico de Cabecera: </h1><input type="text" name="medicoCabecera" class="form-control" placeholder="Nombre de medico del paciente">
              </div>
              <button type="button" class="btn btn-secondary mt-3" onclick="prevStep()">Anterior</button>
              <button type="button" class="btn btn-info mt-3" onclick="nextStep()">Siguiente</button>
            </div>
          </div>
        </div>
      </div>

      <!-- PASO 3 -->
      <div class="step" id="step-3" style="display:none;">
        <div class="col-md-12">
          <div class="bg-white text-white basic-form">
            <div class="card-body">
              <h5 class="card-title">Enfermedades del paciente</h5>
              <div class="panel panel-blue contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Enfermedades: </h1>
                <input id="enfermedades" name="enfermedades" placeholder="Enfermedades del paciente..." required>
              </div>
              <div class="panel panel-blue contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Alergias: </h1>
                <input id="alergias" name="alergias" placeholder="Alergias del paciente..." required>
              </div>
              <div class="panel panel-purple contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Cirugias: </h1>
                <input id="cirugias" name="cirugias" placeholder="Cirugias del paciente..." required>
              </div>
              <div class="panel panel-blue contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Medicación: </h1>
                <input id="medicamentos" name="medicacion" placeholder="Madicacion del paciente..." required>
              </div>
              <div class="panel panel-purple contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Discapacidad: </h1>
                <input id="discapacidad" name="discapacidad" placeholder="Discapacidades del paciente..." required>
              </div>
              <button type="button" class="btn btn-secondary mt-3" onclick="prevStep()">Anterior</button>
              <button type="button" class="btn btn-info mt-3" onclick="nextStep()">Siguiente</button>
            </div>
          </div>
        </div>
      </div>

      <!-- PASO 4 -->
      <div class="step" id="step-4" style="display:none;">
        <div class="col-md-12">
          <div class="bg-white text-dark basic-form">
            <div class="card-body">
              <h5 class="card-title">Salud mental e historial de vacunación</h5>
              <div class="panel panel-purple contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Diagnostico: </h1><input type="text" name="diagnostico" class="form-control" placeholder="Diagnostico de la salud mental del paciente">
              </div>
              <div class="panel panel-purple contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Terapia: </h1><input type="text" name="terapia" class="form-control" placeholder="Tratamiento terapeutico del paciente">
              </div>
              <div class="panel panel-purple contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Nombre terapeuta: </h1><input type="text" name="contactoTerapeuta" class="form-control" placeholder="Nombre del terapeuta del paciente">
              </div>
              <div class="panel panel-purple contenidoEtiqueta">
                <h1 class="nombreEtiqueta">Contacto del terapeuta: </h1><input type="text" name="telefonoTerapeuta" class="form-control" placeholder="Numero de telefono del terapeuta">
              </div>
              <div class="panel panel-purple contenidoEtiqueta">
                <h5 class="nombreEtiqueta">Historial de Vacunacion: </h5>
                <p class="form-text text-dark">Sube una imagen de la cartilla de vacunacion del paciente: </p>
                <div class="form-group">
                  <label for="file" class="form-label"></label>
                  <input type="file" name="firma" id="file" class="form-control-file">
                </div>
              </div>
              <button type="button" class="btn btn-secondary mt-3" onclick="prevStep()">Anterior</button>
              <button type="submit" class="btn btn-info btn-lg mt-3">Aceptar</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</form>

<script>
  let currentStep = 1;
  const totalSteps = 4;

  function showStep(step) {
    for(let i = 1; i <= totalSteps; i++) {
      document.getElementById('step-' + i).style.display = (i === step) ? 'block' : 'none';
    }
  }

  function nextStep() {
    if (currentStep < totalSteps) {
      currentStep++;
      showStep(currentStep);
    }
  }

  function prevStep() {
    if (currentStep > 1) {
      currentStep--;
      showStep(currentStep);
    }
  }

  // Inicializar mostrando el paso 1
  showStep(currentStep);
</script>
  <!--SCRIPT PARA LA FUNCION DE BUSQUEDA DE ENFERMEDADES-->
  <script src="../assets/js/BusquedaEnfermedades.js"></script>
</body>

</html>