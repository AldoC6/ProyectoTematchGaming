<?php
include("includes/header.php");

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

<script>
  const stars = document.querySelectorAll('.star');
  stars.forEach(star => {
    star.addEventListener('click', () => {
      const rating = star.dataset.value;
      stars.forEach(s => {
        s.classList.toggle('selected', s.dataset.value <= rating);
      });

      // Puedes enviar el rating al servidor aquí con AJAX
    });
  });
</script>
<div style="height: 130px;"></div>
<!-- Fin de Body -->
<?php include("includes/footer.php"); ?>
<!--La linea de arriba es el final de la estructura html5, basicamente donde se cierra el body y la etiqueta html-->
