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

  <link rel="stylesheet" href="../assets/css/verListaPacientes.css">

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

include("../Config/conexion.php");
$sql = "SELECT matricula, nombre, apellido_paterno, apellido_materno, tipo_sangre FROM personas";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

  <main>
    <p class="text-uppercase text-dark">Ingresa la matricula del paciente para descargar su historial medico</p>
    <div style="display: flex; justify-content: center; margin: 10px;">
      <div class="input-group search-container" style="width: 50%;">
        <div class="input-group-prepend">
          <span class="icon iconify search-icon" data-icon="mdi:magnify" id="basic-addon1">
            <i class="icon fas fa-user" data-icon="ph:user-fill"></i>
          </span>
        </div>
        <input type="text" class="form-control" placeholder="Buscar por matricula..." aria-label="Username"
          aria-describedby="basic-addon1" onkeyup="filtrarTabla()" id="busqueda">
      </div>
    </div>

    <div class="container table-container"
      style="background-color: white; height: 400px; overflow-y: auto; margin-top: 0%;">
      <table class="table user-table">
        <thead style="position: sticky; top: 0; background-color: #2d8ca2; color: white;">
          <tr>
            <th style="width: 16.5%">Matricula</th>
            <th style="width: 16.5%">Nombre</th>
            <th style="width: 16.5%">Apellido Paterno</th>
            <th style="width: 16.5%">Apellido Materno</th>
            <th style="width: 16.5%">Tipo de Sangre</th>
            <th style="width: 16.5%">Ver Información</th>
            <th style="width: 16.5%">Descargar</th>
            <th style="width: 16.5%">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $fila) { ?>
            <tr>
              <td><?php echo htmlspecialchars($fila['matricula'], ENT_QUOTES); ?></td>
              <td><?php echo htmlspecialchars($fila['nombre'], ENT_QUOTES); ?></td>
              <td><?php echo htmlspecialchars($fila['apellido_paterno'], ENT_QUOTES); ?></td>
              <td><?php echo htmlspecialchars($fila['apellido_materno'], ENT_QUOTES); ?></td>
              <td><?php echo htmlspecialchars($fila['tipo_sangre'], ENT_QUOTES); ?></td>
              <td>
                <button class="btn" type="submit" name="verInformacion"
                  onclick="location.href='verInfoUsuario.php?matricula=<?php echo htmlspecialchars($fila['matricula'], ENT_QUOTES); ?>'">
                  <span class="icon"><i class="iconify" data-icon="material-symbols:info-i-rounded"
                      style="font-size: 25px;"></i></span></button>
              </td>
              <td>
                <a href="../Controllers/descargaExcel.php?matricula=<?php echo htmlspecialchars($fila['matricula'], ENT_QUOTES);  ?>">
                <button class="btn" type="submit" name="descargar" onclick="location.href='">
                  <span class="icon"><i class="iconify" data-icon="material-symbols:download"
                      style="font-size: 25px;"></i></span></button></a>
              </td>
              <td>
                <a href="../Controllers/eliminarUsuarioController.php?matricula=<?php echo htmlspecialchars($fila['matricula'], ENT_QUOTES);  ?>">
                <button class="btn" type="submit" name="descargar" onclick="location.href='">
                  <span class="icon"><i class="iconify" data-icon="material-symbols:delete"
                      style="font-size: 25px;"></i></span></button></a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </main>
  <script src="../assets/js/CambiarEstado.js"></script>

  <script src="../assets/js/Busqueda.js"></script>

</body>

</html>