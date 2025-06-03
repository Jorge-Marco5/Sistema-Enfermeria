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
  $errorMensaje = '¡Por favor!, inicia sesion antes de ingresar al sistema';
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

  <!--Contenido principal-->

  <?php
  /*Obtenemos los registros de la base de datos */
  ?>

  <div class="container mt-4">
    <!-- Inicio del rectángulo blanco central -->
    <div class="bg-white p-5 rounded-lg shadow-lg mx-auto" style="max-width: 800px;">
      <h1>Agenda de Campañas medicas</h1>
      <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error! </strong> <?= htmlspecialchars($_POST['error']) ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mensaje'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Info! </strong> <?= htmlspecialchars($_POST['mensaje']) ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <table class="table table-striped mt-3">
        <thead>
          <tr>
            <th>Campaña</th>
            <th>Fecha Inicio</th>
            <th>Fecha Final</th>
            <th>Estado</th>
            <th>Acciones</th> <!-- Nueva columna para acciones -->
          </tr>
        </thead>
        <tbody id="tablaVacunasBody">

          <form action="../Controllers/agregarCampañaController.php" method="POST" enctype="multipart/form-data">
            <tr>
              <td>
                <input type="text" class="form-control" name="descripcion" id="nombre_vacuna_${nuevaFilaId}" required>
              </td>
              <td>
                <input type="date" class="form-control" name="fechaInicio" id="fecha_vacuna_${nuevaFilaId}" required>
              </td>
              <td>
                <input type="date" class="form-control" name="fechaFinal" id="fecha_vacuna_${nuevaFilaId}" required>
              </td>
              <td>
                <p>-</p>
              </td>
              <td>
                <!-- El botón de guardar para filas nuevas podría necesitar lógica diferente en el backend -->
                <button type="submit" class="btn btn-info btn-sm">Guardar</button>
              </td>
            </tr>
          </form>

          <?php
          include '../Controllers/verCampañaController.php';
          foreach ($result as $fila) {

            $fechaActual = new DateTime();
            $fechaInicio = new DateTime($fila['fechainicio']);
            $fechaFin = new DateTime($fila['fechafinal']);

            // Determinar el estado
            if ($fechaActual < $fechaInicio) {
              $estado = "Pendiente"; // La acción aún no ha comenzado
            } elseif ($fechaActual >= $fechaInicio && $fechaActual <= $fechaFin) {
              $estado = "En curso"; // La acción está en progreso
            } else {
              $estado = "Finalizada"; // La acción ya terminó
            }

            ?>
            <tr>
              <td>
                <!-- Campo de entrada para el nombre de la vacuna -->
                <label name="descripcion" cla ss="form-control"
                  id="nombre_vacuna_<?= $fila['id'] ?>"><?= htmlspecialchars($fila['descripcioncampaña']) ?></label>
              </td>
              <td>
                <!-- Campo de entrada de fecha -->
                <label name="fechaInicio" class="form-control"
                  id="fecha_vacuna_<?= $fila['id'] ?>"><?= htmlspecialchars($fila['fechainicio']) ?></label>
              </td>
              <td>
                <!-- Campo de entrada de fecha -->
                <label name="fechaFinal" class="form-control"
                  id="fecha_vacuna_<?= $fila['id'] ?>"><?= htmlspecialchars($fila['fechafinal']) ?></label>
              </td>
              <td>
                <!-- Selector para el estado de la vacuna -->
                <label name="estado" class="form-control" id="fecha_vacuna_<?= $fila['id'] ?>" style="display: flex; object-fit: cover;"><?= htmlspecialchars($estado) ?></label>
              </td>
              <td>
                <!-- Botón para guardar los cambios (requiere JS y backend) -->
                <button class="btn btn-primary btn-sm" onclick="location.href='../Controllers/eliminarCampañaController.php?id=<?= $fila['id'] ?>'">Eliminar</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div> <!-- Fin del rectángulo blanco central -->
  </div>
</body>

</html>