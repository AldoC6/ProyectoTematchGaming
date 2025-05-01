<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../index.php");
    exit();
}
include("../includes/header.php");
?>
<style>
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}
</style>

<div class="row">
  <div class="admin-container col-3">
    <aside class="sidebar">
      <h5>Bienvenido<br>administrador</h5>
      <a href="añadir_juegos.php" class="nav-link">Juegos</a>
      <a href="administrar_reseñas.php" class="nav-link">Reseñas </a>
      <a href="administrar_genero.php" class="nav-link">Género </a>
      <a href="administrar_cuentas.php" class="nav-link">Usuarios</a>
      <a href="estadisticas.php" class="nav-link">Estadísticas</a>
    </aside>
  </div>
  
</div>
</body>
</html>


