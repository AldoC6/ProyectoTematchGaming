<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include("conexion.php");

$usuario = $_SESSION['id'] ?? null;
$rol = $_SESSION['rol'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Temach Gaming</title>

  <link rel="stylesheet" href="/ProyectoTematchGaming/css/style.css">
  <link rel="stylesheet" href="/ProyectoTematchGaming/css/styleAdmin.css">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/d1e737fca6.js" crossorigin="anonymous"></script>
</head>

<body class="fondo">
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/ProyectoTematchGaming/index.php">Tematch Gaming</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Enlaces y redes a la izquierda -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
          <?php if (!$usuario): ?>
            <li class="nav-item"><a class="nav-link" href="/ProyectoTematchGaming/login.php">Iniciar Sesión</a></li>
            <li class="nav-item"><a class="nav-link" href="/ProyectoTematchGaming/registrarse.php">Registrarse</a></li>
            <li class="nav-item"><a class="nav-link" href="/ProyectoTematchGaming/catalogo.php">Catálogo</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="/ProyectoTematchGaming/index.php">Página Principal</a></li>
            <li class="nav-item"><a class="nav-link" href="/ProyectoTematchGaming/catalogo.php">Catálogo</a></li>
          <?php endif; ?>

          <!-- Redes sociales -->
          <li class="nav-item d-flex align-items-center mx-3">
            <a class="nav-link" href="#"><img class="imgNavBar" src="/ProyectoTematchGaming/img/NavBar/LogoFacebook.png" alt="Facebook"></a>
            <a class="nav-link" href="#"><img class="imgNavBar" src="/ProyectoTematchGaming/img/NavBar/LogoInstagram.png" alt="Instagram"></a>
            <a class="nav-link" href="#"><img class="imgNavBar" src="/ProyectoTematchGaming/img/NavBar/LogoX.png" alt="X"></a>
          </li>
        </ul>

        <!-- Buscador + dropdown (solo si logueado) -->
        <div class="d-flex align-items-center">
          <form class="d-flex me-3">
            <input class="form-control me-2" type="search" placeholder="Buscar">
            <button class="btn btn-outline-danger" type="submit">Buscar</button>
          </form>

          <?php if ($usuario): ?>
          <div class="dropdown me-2">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <img src="/ProyectoTematchGaming/img/NavBar/Usuario.png" width="32" height="32" class="rounded-circle">
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="/ProyectoTematchGaming/perfil.php">Ver perfil</a></li>
              <li><a class="dropdown-item" href="/ProyectoTematchGaming/includes/reset.php">Cerrar sesión</a></li>
            </ul>
          </div>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </nav>
