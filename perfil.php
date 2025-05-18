<?php
session_start();
include("includes/header.php"); 

// Redirigir si no ha iniciado sesión
if (!isset($_SESSION['id']) || ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2)) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

$sql = $conexion->query("SELECT * FROM usuarios WHERE id = $id");

if ($datos = $sql->fetch_object()) {
?>


<style>
.perfil-container {
  display: flex;
  justify-content: space-around;
  padding: 40px 20px;
}

.perfil-box, .reseñas-box {
  background-color: rgba(0, 0, 0, 0.7);
  border-radius: 20px;
  padding: 30px;
  width: 40%;
  text-align: center;
  color: white;
}

.perfil-box img {
  width: 100px;
  border-radius: 50%;
  background: #fff;
  padding: 5px;
}

.perfil-box p {
  margin: 15px 0;
  font-size: 18px;
}

.perfil-box .editar {
  float: right;
  font-size: 20px;
  cursor: pointer;
}

.reseña-item {
  background-color: #444;
  margin: 10px 0;
  padding: 10px;
  border-radius: 10px;
  text-align: left;
  font-size: 15px;
}

.tabs {
  margin-top: 20px;
}

.tabs a {
  color: #ccc;
  text-decoration: none;
  margin: 0 10px;
  font-weight: bold;
}

.tabs a:hover {
  text-decoration: underline;
}
</style>



<div class="perfil-container">

    <!-- Caja de perfil -->
    <div class="perfil-box">
      <img src="img/NavBar/Usuario.png" alt="Usuario">
            <p><strong>Nombre de usuario:</strong> <?php echo $datos->Usuario; ?></p>
            <p><strong>Correo:</strong> <?php echo $datos->Correo; ?></p>
            <p><strong>contraseña:</strong><br>************</p>
      <div class="tabs">
        <a href="controlador/editar_perfil.php">Editar perfil</a>
      </div>
    </div>

    <!-- Caja de reseñas -->
    <div class="reseñas-box">
      <h2>Historial de Reseñas</h2>
      <?php if ($resenas > 0): ?>
        <?php while($r = $resenas->fetch_assoc()): ?>
          <div class="reseña-item">
            <?= htmlspecialchars($r['texto']) ?>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No hay reseñas.</p>
      <?php endif; ?>
      <div class="tabs">
        <a href="reseñas_completas.php">Ver más</a>
      </div>
    </div>

  </div>
<?php
} else {
    echo "<div class='alert alert-danger'>No se encontró información del usuario.</div>";
}
?>


<?php

include ("includes/footer.php")

?>