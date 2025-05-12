<!--La linea 2 representa el inicio de la estructura html5 y el navbar. includes/header.php -->
<?php 
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rol'] != '1') {
    header("Location: ../index.php");
    exit();
}


include("../includes/header.php"); 

?>
<!--Inicio de Body -->
<style>
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}
</style>

<script>
  function confirmar(){
    return confirm("¿Deseas eliminar el juego?");
  }
</script>

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



  <form class="col-2 p-3" method="POST">
    <h3 class="text-center text-Light">Añadir Juegos</h3>
    <?php 

    include ("../controlador/controlador_añadir_juego.php");
    include ("../controlador/controlador_eliminar_juegos.php");
    include ("../controlador/controlador_modificar_juego.php");
    
    ?>
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" class="form-control" name ="nombre"> <!-- <--- Nombre del input-->
    </div>
    <div class="mb-3">
      <label class="form-label">Género</label>
      <select class="form-select" aria-label="Default select example" name="txtgenero"> <!-- <--- Nombre del select-->
        <option selected>Seleccionar...</option>

        <?php
        $genero = $conexion -> query("select * from generos"); //nombre de tabla o nombre de campo?
        while($datos=$genero->fetch_object()){ ?>
          <option value="<?= $datos->id ?> "><?= $datos->nombre ?></option> <!--id o id_genero?-->
        <?php }
        ?>

      </select>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Fecha de Lanzamiento</label>
      <input type="Date" class="form-control" name ="fecha"> <!-- <--- Nombre del date-->
    </div>
    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <input type="text" class="form-control" name ="descripcion"> <!-- <--- Nombre del input-->
    </div>
    <div class="mb-3">
      <label class="form-label">Ruta de la imagen (ej: imagenesJuego/juego.jpg)</label>
      <input type="text" class="form-control" name="imagen" placeholder="imagenesJuego/mario.jpg" required>
    </div>
    <button type="submit" class="btn btn-dark" name="btnagregar" value="ok">Agregar</button> <!-- <--- Nombre del button-->
  </form>


  <div class="col-7 p-4">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Género</th>
          <th scope="col">Fecha Lanzamiento</th>
          <th scope="col">Descripción</th>
          <th scope="col">imagen</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        
        $juegos =$conexion->query("SELECT juegos.*,generos.nombre FROM juegos 
        INNER JOIN generos ON
        juegos.id_genero=generos.id");

        while($datos=$juegos->fetch_object()){ ?>

          <tr>
            <td><?= $datos ->id?></td>
            <td><?= $datos ->nombreJ?></td>
            <td><?= $datos ->nombre?></td>
            <td><?= $datos ->fecha_lanzamiento?></td>
            <td><?= $datos ->descripcion?></td>
            <td><?= $datos ->imagen?></td>
            <td>
              <a href="" class="btn btn-small btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$datos->id?>"><i class="fa-solid fa-pen-to-square"></i></a>
              <a href="añadir_juegos.php?id=<?= $datos->id ?>" onclick="return confirmar()" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
            </td>
          </tr>



          <!-- Modal -->
          <div class="modal fade" id="exampleModal<?=$datos->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Editar juegos</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="col-2" method="POST">

                    <input type="hidden" name="txtid" value="<?= $datos ->id?>">
                    <div class="mb-3">
                      <label class="form-label">Nombre</label>
                      <input type="text" class="form-control" name ="nombre" value="<?= $datos->nombreJ?>">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Género</label>
                      <select class="form-select" aria-label="Default select example" name="txtgenero">
                        <option selected>Seleccionar...</option>
                        <?php
                        $datosGenero = $conexion ->query("select * from generos");
                        while($datosgen=$datosGenero ->fetch_object( )){ ?>
                          <option <?= $datos ->id_genero==$datosgen ->id ? "selected" : "" ?> value="<?= $datosgen->id ?>"><?= $datosgen->nombre ?></option>

                        <?php }
                        ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Fecha de Lanzamiento</label>
                      <input type="Date" class="form-control" name ="fecha" value="<?= $datos->fecha_lanzamiento?>">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Descripción</label>
                      <input type="text" class="form-control" name ="descripcion" value="<?= $datos->descripcion?>">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Ruta de imagen del juego</label>
                      <input type="text" class="form-control" name="imagen" value="<?= $datos ->imagen ?>" required>
                    </div>
                    <button type="submit" class="btn btn-dark" name="btnmodificar" value="ok">Editar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        
        <?php }

        ?>
      </tbody>
    </table>
  </div>
</div>

<script src="/ProyectoTematchGaming/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>