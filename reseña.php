<?php
include("includes/header.php");

if (isset($_GET['id'])) {
    $id_juego = intval($_GET['id']); // Así tienes el ID disponible
} else {
    // Si no viene en la URL, redirige o lanza error
    echo "<script>alert('Juego no especificado.'); window.location.href = 'index.php';</script>";
    exit();
}



$id = $_GET['id'] ?? null;

if ($id) {
$query = "SELECT juegos.*, generos.nombre AS nombre_genero FROM juegos JOIN generos ON juegos.id_genero = generos.id WHERE juegos.id = $id";
  $resultado = mysqli_query($conexion, $query);

  if ($resultado && mysqli_num_rows($resultado) > 0) {
    $juego = mysqli_fetch_assoc($resultado);
  } else {
    echo "<p>Juego no encontrado</p>";
    exit;
  }
} else {
  echo "<p>ID no proporcionado</p>";
  exit;
}
?>

<style>
  .juego-container {
    display: flex;
    gap: 20px;
    padding: 20px;
    flex-wrap: wrap;
  }

  .imagen-juego {
    flex: 1;
    max-width: 300px;
  }

  .imagen-juego img {
    width: 100%;
    height: auto;
    border-radius: 10px;
  }

  .descripcion-juego {
    flex: 2;
    background: white;
    color: black;
    padding: 15px;
    border-radius: 10px;
  }

  .sidebar {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .rate-box,
  .user-reviews {
    background: white;
    color: black;
    padding: 15px;
    border-radius: 10px;
  }

  .star {
    font-size: 2em;
    cursor: pointer;
    color: gray;
    transition: color 0.2s;
  }

  .star.selected {
    color: gold;
  }

  .user-reviews .review {
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .user-reviews img {
    width: 40px;
    border-radius: 50%;
  }
</style>

<div class="juego-container">
  <div class="imagen-juego">
    <img src="<?php echo $juego['imagen']; ?>" alt="<?php echo $juego['nombreJ']; ?>">
  </div>

  <div class="descripcion-juego">
    <h2><?php echo $juego['nombreJ']; ?></h2>
    <p><strong>Fecha de lanzamiento:</strong> <?php echo $juego['fecha_lanzamiento']; ?></p>
  <p><strong>Género:</strong> <?php echo $juego['nombre_genero']; ?></p>
    <p><?php echo $juego['descripcion']; ?></p>
  </div>

  <div class="sidebar">
    <div class="rate-box">
      <strong>¿Has jugado este juego? ¡Califícalo!</strong>
      <div id="star-rating">
        <span class="star" data-value="1">☆</span>
        <span class="star" data-value="2">☆</span>
        <span class="star" data-value="3">☆</span>
        <span class="star" data-value="4">☆</span>
        <span class="star" data-value="5">☆</span>
      </div>
    </div>

    <div class="user-reviews">
      <strong>RESEÑAS</strong>
      <div class="review">
        <img src="https://via.placeholder.com/40" alt="user">
        <p>Gran juego, lo recomiendo mucho...</p>
      </div>
      <div class="review">
        <img src="https://via.placeholder.com/40" alt="user">
        <p>Me gustó mucho su jugabilidad...</p>
      </div>
      <a href="#">Ver más reseñas</a>
    </div>
  </div>
</div>

<!-- Modal para invitados -->
<div class="modal fade" id="modalInvitado" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Acceso restringido</h5></div>
      <div class="modal-body">Debes registrarte para calificar.</div>
      <div class="modal-footer">
        <a href="registrarse.php" class="btn btn-primary">Registrarse</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para confirmar calificación -->
<div class="modal fade" id="modalConfirmar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Confirmar calificación</h5></div>
      <div class="modal-body">¿Estás seguro de calificar con <span id="valorSeleccionado"></span> estrella(s)?</div>
      <div class="modal-footer">
        <?php echo "<!-- ID del juego: $id_juego -->"; ?>
        <form id="formCalificar" method="POST" action="/ProyectoTematchGaming/controlador/guardar_calif.php">
          <input type="hidden" name="id_juego" value="<?php echo $id_juego; ?>">
          <input type="hidden" name="estrellas" id="inputEstrellas">
          <button type="submit" class="btn btn-success">Sí, calificar</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


<script>
  document.querySelectorAll(".star").forEach(star => {
    star.addEventListener("click", function () {
      const valor = this.getAttribute("data-value");
      const esRegistrado = <?php echo isset($_SESSION['usuario']) && $_SESSION['rol'] == 2 ? 'true' : 'false'; ?>;

      if (esRegistrado) {
        // Mostrar modal de confirmación
        document.getElementById("valorSeleccionado").innerText = valor;
        document.getElementById("inputEstrellas").value = valor;
        new bootstrap.Modal(document.getElementById('modalConfirmar')).show();
      } else {
        // Mostrar modal para invitados
        new bootstrap.Modal(document.getElementById('modalInvitado')).show();
      }
    });
  });
</script>
<div style="height: 130px;"></div>
<!-- Fin de Body -->
<?php include("includes/footer.php"); ?>
<!--La linea de arriba es el final de la estructura html5, basicamente donde se cierra el body y la etiqueta html-->
