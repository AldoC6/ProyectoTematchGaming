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
  <form class="col-2 p-3">
    <h3 class="text-center text-Light">Administrar Reseñas</h3>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Genero</label>
      <input type="text" class="form-control" name ="genero">
    </div>
    <button type="submit" class="btn btn-dark" name="btnagregar" value="ok">Agregar</button>
  </form>
  <div class="col-7 p-4">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Genero</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Otto</td>
          <td>
            <a href="#" class="btn btn-small btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
            <a href="#" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>