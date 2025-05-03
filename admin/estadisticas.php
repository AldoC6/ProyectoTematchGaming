<!--La linea 2 representa el inicio de la estructura html5 y el navbar. includes/header.php -->
<?php include("../includes/header.php"); ?>
<!--Inicio de Body -->
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
      <a class="nav-link text-light text-center" href="vista_Admin.php"><h5>Bienvenido<br>Administrador</h5></a>
      <a href="añadir_juegos.php" class="nav-link">Juegos</a>
      <a href="administrar_reseñas.php" class="nav-link">Reseñas </a>
      <a href="administrar_genero.php" class="nav-link">Género </a>
      <a href="administrar_cuentas.php" class="nav-link">Usuarios</a>
      <a href="estadisticas.php" class="nav-link">Estadísticas</a>
    </aside>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

