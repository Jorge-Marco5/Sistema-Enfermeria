<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../assets/img/Logo.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="/assets/css/login.css">
</head>

<body>
    <div class="container login-wrapper">
        <div class="Login-card1">
            <h1 class="title1">Sistema de control de enfermería</h1>
            <div class="img-container">
                <img src="../assets/img/Logo.jpeg" alt="Logo" class="img">
            </div>
        </div>

        <div class="container">
            <div class="Login-card">

                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['error'])): ?>
                    <div id=""
                        style="background-color: #E01E5B; color: white; text-align: center; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-family: Arial, Helvetica, sans-serif;">
                        <strong>Error! </strong> <?= htmlspecialchars($_POST['error']) ?>
                    </div>
                <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mensaje'])): ?>
                    <div id=""
                        style="background-color: #007A5B; color: white; text-align: center; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-family: Arial, Helvetica, sans-serif;">
                        <strong>Info: </strong> <?= htmlspecialchars($_POST['mensaje']) ?>
                    </div>
                <?php endif; ?>

                <h1>Iniciar sesión</h1>
                <form action="../Controllers/LoginController.php" method="POST">
                    <span class="items_description">Matricula</span>
                    <div class="input-container">
                        <span class="icon"><i class="iconify" data-icon="ph:user-fill"></i></span>
                        <input type="text" name="matricula" required><br><br>
                    </div>
                    <span class="items_description">Contraseña</span>
                    <div class="input-container">
                        <span class="icon"><i class="iconify" data-icon="uis:padlock"></i></span>
                        <input type="password" name="password" required><br><br>
                    </div>
                    <button type="submit" id="Iniciar sesión" name="login">Iniciar sesión</button>
                </form>
            </div>
        </div>
</body>

</html>