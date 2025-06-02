<!--Barra superior que se muestra en las pantallas de emergencia-->
<head>
  <link rel="icon" href="../assets/img/Logo.jpeg" type="image/x-icon">
</head>
<!--Hoja de estilos en la parte inferior-->
<header class="index">
  <nav class="navbar navbar-expand-lg navbar-dark bg-<?php echo $danger; ?> mb-4">
    <div class="container">
      <div><img src="../assets/img/Logo.jpeg" alt="" class="imgLogo"></div>
      <a class="navbar-brand d-flex align-items-center" href="Index.php">Enfermería</a>
      <div class="collapse show navbar-collapse text-center" id="navbarNavDropdown-1">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="Index.php">Inicio
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/Controllers/logout.php">Cerrar sesión
              <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<style type="text/css">
  .imgLogo {
    width: 50px;
    height: 50px;
    margin-right: 10px;
  }

  .navbar-brand {
    font-size: 24px;
    font-weight: bold;
  }

  .navbar-nav .nav-link {
    font-size: 18px;
    margin-right: 20px;
  }
</style>