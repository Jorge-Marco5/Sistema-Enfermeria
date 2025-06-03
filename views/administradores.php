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
  <?php
  include '../config/conexion.php';
  $sql = "SELECT id_admin, nombreadmin, matricula FROM administradores ORDER BY fecha DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <div class="bg-white p-5 rounded-lg shadow-lg mx-auto" style="max-width: 800px;">

    <div class="container">
      <h2 class="mb-4">Administradores registrados</h2>
      <p>🔴El personal medico que este registrado podra iniciar sesion y tendra acceso completo al sistema</p>
      <h4 class="text-dark" style="margin-top: 0px;">Agregar nuevo administrador</h4>
      <form action="../Controllers/agregarAdministradorController.php" method="POST" class="row g-3"
        onsubmit="return confirm('¿Seguro que deseas agregar este administrador?');">
        <div class="col-md-4">
          <input type="text" name="nombreAdmin" class="form-control" placeholder="Nombre completo" required>
        </div>
        <div class="col-md-3">
          <input type="text" name="matriculaAdmin" class="form-control" placeholder="Matrícula" required>
        </div>
        <div class="col-md-3">
          <input type="password" name="passwordAdmin" class="form-control" placeholder="Contraseña" required>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary w-100">Agregar</button>
        </div>
      </form>
    </div>

    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Matrícula</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($resultado as $admin): ?>
          <tr>
            <td><?= htmlspecialchars($admin['id_admin']) ?></td>
            <td><?= htmlspecialchars($admin['nombreadmin']) ?></td>
            <td><?= htmlspecialchars($admin['matricula']) ?></td>
            <td>
              <form method="POST" action="../Controllers/eliminarAdministradorController.php"
                onsubmit="return confirm('¿Seguro que deseas eliminar este administrador?');">
                <input type="hidden" name="id" value="<?= $admin['id_admin'] ?>">
                <input type="hidden" name="nombre" value="<?= $admin['nombreadmin'] ?>">
                <button class="btn btn-danger btn-sm">Eliminar</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>


  </div>
</body>

<?php 
/*Validador de contraseña antes de ingresar a ver los administradores*/

?>

</html>