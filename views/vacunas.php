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
  exit(); // Importante salir después de redirigir
}
include 'navbar.php';

// Datos de ejemplo para la agenda de vacunas
// Idealmente, estos datos vendrían de una base de datos
$vacunas = [
    ['id' => 1, 'nombre' => 'Nombre', 'fecha_programada' => '2023-10-26', 'estado' => 'Pendiente'],
    ['id' => 2, 'nombre' => 'Nombre', 'fecha_programada' => '2023-11-15', 'estado' => 'Aplicada'],
    ['id' => 3, 'nombre' => 'Nombre', 'fecha_programada' => '2024-01-10', 'estado' => 'Pendiente'],
    ['id' => 4, 'nombre' => 'Nombre', 'fecha_programada' => '2024-02-20', 'estado' => 'Pendiente'],
    // Añadidas más entradas de ejemplo para demostrar que la tabla puede manejar más de 4
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agenda de Vacunas</title>
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
</head>
<body>

  <div class="container mt-4">
    <!-- Inicio del rectángulo blanco central -->
    <div class="bg-white p-5 rounded-lg shadow-lg mx-auto" style="max-width: 800px;">
      <h1>Agenda de Campañas de Vacunas</h1>
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

      <!-- Botón para agregar nueva vacuna -->
      <button class="btn btn-success mb-3" onclick="agregarFilaVacuna()">Agregar campaña</button>

      <table class="table table-striped mt-3">
        <thead>
          <tr>
            <th>Campaña</th>
            <th>Fecha Programada</th>
            <th>Estado</th>
            <th>Acciones</th> <!-- Nueva columna para acciones -->
          </tr>
        </thead>
        <tbody id="tablaVacunasBody">
          <?php foreach ($vacunas as $vacuna): ?>
            <tr>
              <td>
                <!-- Campo de entrada para el nombre de la vacuna -->
                <input type="text" class="form-control" value="<?= htmlspecialchars($vacuna['nombre']) ?>" id="nombre_vacuna_<?= $vacuna['id'] ?>">
              </td>
              <td>
                <!-- Campo de entrada de fecha -->
                <input type="date" class="form-control" value="<?= htmlspecialchars($vacuna['fecha_programada']) ?>" id="fecha_vacuna_<?= $vacuna['id'] ?>">
              </td>
              <td>
                <!-- Selector para el estado de la vacuna -->
                <select class="form-control" id="estado_vacuna_<?= $vacuna['id'] ?>">
                  <option value="Pendiente" <?= ($vacuna['estado'] == 'Pendiente') ? 'selected' : '' ?>>Pendiente</option>
                  <option value="Proceso" <?= ($vacuna['estado'] == 'Proceso') ? 'selected' : '' ?>>Proceso</option>
                  <option value="Finalizada" <?= ($vacuna['estado'] == 'Finalizada') ? 'selected' : '' ?>>Finalizada</option>
                </select>
              </td>
              <td>
                <!-- Botón para guardar los cambios (requiere JS y backend) -->
                <button class="btn btn-primary btn-sm" onclick="guardarVacuna(<?= $vacuna['id'] ?>)">Guardar</button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div> <!-- Fin del rectángulo blanco central -->
  </div>

  <script>
    // Contador para asignar IDs temporales a las nuevas filas añadidas en el cliente
    let nuevaVacunaIdCounter = 0;

    // Función para agregar una nueva fila a la tabla
    function agregarFilaVacuna() {
      nuevaVacunaIdCounter++;
      const nuevaFilaId = 'nueva_' + nuevaVacunaIdCounter; // ID temporal con prefijo

      const tablaBody = document.getElementById('tablaVacunasBody');

      const nuevaFilaHtml = `
        <tr>
          <td>
            <input type="text" class="form-control" value="" id="nombre_vacuna_${nuevaFilaId}">
          </td>
          <td>
            <input type="date" class="form-control" value="" id="fecha_vacuna_${nuevaFilaId}">
          </td>
          <td>
            <select class="form-control" id="estado_vacuna_${nuevaFilaId}">
              <option value="Pendiente">Pendiente</option>
              <option value="Proceso">Proceso</option>
              <option value="Finalizada">Finalizada</option>
            </select>
          </td>
          <td>
            <!-- El botón de guardar para filas nuevas podría necesitar lógica diferente en el backend -->
            <button class="btn btn-primary btn-sm" onclick="guardarVacuna('${nuevaFilaId}', true)">Guardar</button>
          </td>
        </tr>
      `;

      tablaBody.insertAdjacentHTML('beforeend', nuevaFilaHtml);
    }

    // Función de ejemplo para guardar los datos de la vacuna (requiere implementación backend)
    // Se añadió un parámetro opcional 'esNueva' para diferenciar filas existentes de nuevas
    function guardarVacuna(vacunaId, esNueva = false) {
      const nombreInput = document.getElementById('nombre_vacuna_' + vacunaId);
      const fechaInput = document.getElementById('fecha_vacuna_' + vacunaId);
      const estadoSelect = document.getElementById('estado_vacuna_' + vacunaId);

      const nuevoNombre = nombreInput.value;
      const nuevaFecha = fechaInput.value;
      const nuevoEstado = estadoSelect.value;

      if (nuevoNombre && nuevaFecha && nuevoEstado) {
        console.log(`Guardar datos para vacuna ID ${vacunaId} (¿Es nueva? ${esNueva}):`);
        console.log(`  Nombre: ${nuevoNombre}`);
        console.log(`  Fecha: ${nuevaFecha}`);
        console.log(`  Estado: ${nuevoEstado}`);

        // Aquí iría la lógica para enviar los nuevos datos al servidor
        // usando AJAX (fetch o XMLHttpRequest) para actualizar la base de datos.
        // Si 'esNueva' es true, el backend debería realizar un INSERT.
        // Si 'esNueva' es false, el backend debería realizar un UPDATE usando vacunaId.
        // Ejemplo (usando fetch - requiere un endpoint en el servidor):
        /*
        fetch('guardar_vacuna.php', { // Reemplaza 'guardar_vacuna.php' con tu endpoint
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            id: esNueva ? null : vacunaId, // Envía null o un indicador si es nueva
            nombre: nuevoNombre,
            fecha: nuevaFecha,
            estado: nuevoEstado,
            es_nueva: esNueva // Envía un indicador al backend
          })
        })
        .then(response => response.json())
        .then(data => {
          console.log('Respuesta del servidor:', data);
          // Mostrar mensaje de éxito o error al usuario
          if (data.success) {
            alert('Datos de la vacuna guardados con éxito.');
            // Si es una fila nueva y el backend devuelve el ID real,
            // podrías actualizar el ID de la fila en el frontend si es necesario.
          } else {
            alert('Error al guardar los datos: ' + data.message);
          }
        })
        .catch((error) => {
          console.error('Error:', error);
          alert('Ocurrió un error al comunicarse con el servidor.');
        });
        */
        alert(`Funcionalidad de guardar datos para vacuna ${vacunaId} no implementada en el backend.`);
      } else {
        alert('Por favor, completa todos los campos (Nombre, Fecha y Estado).');
      }
    }
  </script>

</body>
</html>
