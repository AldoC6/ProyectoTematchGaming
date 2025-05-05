<!--La linea 2 representa el inicio de la estructura html5 y el navbar. includes/header.php -->
<?php include("includes/header.php"); ?>
<!--Inicio de Body -->

<div class="mt-5">
    <h3 class="text-center text-white">Juegos</h3>
</div>
<div class="container mt-2 p-5">
  
  <div class="d-flex overflow-auto" style="gap: 20px;">
    <?php
      $sql = "SELECT * FROM juegos";
      $result = $conexion->query($sql);

      while ($row = $result->fetch_assoc()) {
          echo "
          <div class='card' style='min-width: 200px;'>
              <img src='{$row['imagen']}' class='card-img-top object-fit-cover' style='height: 350px; width: 100%;' alt='{$row['nombreJ']}'>
              <div class='card-body text-center'>
                  <h5 class='card-title'>{$row['nombreJ']}</h5>
                  <a href='reseña.php?id={$row['id']}' class='btn btn-primary btn-sm'>Ver reseña</a>
              </div>
          </div>
          ";
      }
    ?>
  </div>
</div>







<!-- Fin de Body -->
<?php include("includes/footer.php"); ?>
<!--La linea de arriba es el final de la estructura html5, basicamente donde se cierra el body y la etiqueta html-->

