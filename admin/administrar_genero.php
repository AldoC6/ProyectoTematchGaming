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
      <h5>Bienvenido<br>administrador</h5>
      <a href="añadir_juegos.php" class="nav-link">Juegos</a>
      <a href="administrar_reseñas.php" class="nav-link">Reseñas </a>
      <a href="administrar_genero.php" class="nav-link">Género </a>
      <a href="administrar_cuentas.php" class="nav-link">Usuarios</a>
      <a href="estadisticas.php" class="nav-link">Estadísticas</a>
    </aside>
  </div>
  <form class="col-2 p-3" method="POST">
    <h3 class="text-center text-Light">Añadir Genero</h3>
    <?php
    include "../controlador/registro_genero.php";
    include "../controlador/eliminar_genero.php"
    ?>
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
        <?php
        $sql=$conexion ->query("select * from generos");

        while($datos=$sql->fetch_object()){?>
            <tr>
              <th scope="row"><?= $datos->id?></th>
              <td><?= $datos->nombre?></td>
              <td>
                <a href="editar/editar_genero.php?id=<?= $datos->id ?>" class="btn btn-small btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="administrar_genero.php?id=<?= $datos->id ?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
              </td>
            </tr>
        <?php }
        ?>
        
      </tbody>
    </table>
  </div>
</div>
</body>
</html>