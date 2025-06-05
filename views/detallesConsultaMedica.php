<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Consulta Medica</title>
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
if (!isset($_SESSION['matricula'])){
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

    <?php
        if (isset($_GET['id_consulta'])) {
            $id_consulta = $_GET['id_consulta'];
            
            $sql = "SELECT fecha, motivo_consulta
            FROM consulta_medica 
            WHERE id_consulta = :id_consulta";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_consulta', $id_consulta, PDO::PARAM_STR);
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $fecha = $row['fecha'];
                $motivo_consulta = $row['motivo_consulta'];
                
            }

        } else {
            // Manejar el caso en que no se proporciona la matrícula
                header("Location: ../views/sinInformacion.php");
            exit;
        }

    ?>
    <div class="containerInfo container">

        <h3 class="text">
            <i class="iconify" data-icon="twemoji:stethoscope" style="color: #007bff;"></i>
            Detalles consulta Medica

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
                      <p class="text-left text-info text-uppercase font-weight-bold mb-1">Nombre:</p>
                      <p class="text-left text-dark"><?php echo htmlspecialchars($nombre, ENT_QUOTES); ?></p>
                </li>
                <li class="list-group-item">
                      <p class="text-left text-info text-uppercase font-weight-bold mb-1">Apellido Paterno:</p>
                      <p class="text-left text-dark"><?php echo htmlspecialchars($apellido_paterno, ENT_QUOTES); ?></p>
                </li>    
                <li class="list-group-item">
                     <p class="text-left text-info text-uppercase font-weight-bold mb-1">Apellido Materno:</p>
                     <p class="text-left text-dark"><?php echo htmlspecialchars($apellido_materno, ENT_QUOTES); ?></p>
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
            </ul>
        </div>


        <div class="col-md-12">
            <div class="bg-white text-dark basic-form">
                <!--form-->
                <form id="formConsultaMedica" action="../Controllers/aggConsultaMedica.php" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="matricula"
                        value="<?php echo htmlspecialchars($matricula, ENT_QUOTES); ?>">
                    <div class="card-body">
                        <br>
                        <div style="border-top: 1px solid #000; margin: 20px 0;"></div>
                        <br>

                        <div class="panel form-group">
                            <h1 class="nombreEtiqueta">Motivo de la consulta: </h1>
                            <p class="text-dark" style="text-align:justify; font-size: 18px;"><?php echo htmlspecialchars($motivo_consulta)?></p>
                        </div>
                        <br>
                    </div>

                </form>
            </div>

        </div>
    </div>

</body>

</html>