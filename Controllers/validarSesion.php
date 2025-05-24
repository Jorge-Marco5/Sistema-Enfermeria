<?php
include("../Config/conexion.php");
include "logger.php";
session_start();
if(isset($_POST['submit'])){
   $user = $_POST['matricula'];
   $password = $_POST['password'];

   if (($user == "21ISIC050") AND ($password == "123456")) {
      $_SESSION['matricula'] = $user;
      header("location: ../Index.php");
   } else {
      registrarError(
         'Not session started',
         "Inicia sesion antes de ingresar al sistema.",
         'validarSesion.php: línea 8'
     );
     $errorMensaje = '¡Por favor!, inicia sesion antes de ingresar al sistema';
     ?>
     ?>
        <html> <body><form id="formRedirect" action="../views/Login.php" method="post">
                    <input type="hidden" name="error" value="<?= htmlspecialchars($errorMensaje) ?>">
                </form>
                <script>
                    document.getElementById('formRedirect').submit();
                </script>
        </body></html>
        <?php
        exit();
   }
}
?>