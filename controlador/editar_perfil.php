<?php 

include("../includes/header.php"); 
$id=$_SESSION["id"];
$sql=$conexion->query(" select * from usuarios where id=$id");
?>

<style>
    .formulario-editar {
      max-width: 500px;
      margin: 40px auto;
      background-color: rgba(0,0,0,0.8);
      padding: 30px;
      border-radius: 20px;
      color: white;
    }

    .formulario-editar input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 10px;
      border: none;
      font-size: 16px;
    }

    .formulario-editar label {
      font-weight: bold;
    }

    .formulario-editar button {
      padding: 10px 20px;
      background-color: #222;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
    }

    .formulario-editar img {
      width: 100px;
      border-radius: 50%;
      margin-bottom: 15px;
    }
</style>
    
<form method="POST" class="formulario-editar">
  <h2>Editar Perfil</h2>

  <?php

  include("actualizar_datos.php");
  while($datos = $sql ->fetch_object()){?>
  
  
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?= $datos -> Usuario ?>" required>

    <label for="correo">Correo:</label>
    <input type="email" name="correo" value="<?= $datos -> Correo ?>" required>

    <label for="contrasena">Nueva Contraseña:</label>
    <input type="password" name="contrasena" placeholder="Ingrese aqui su nueva contraseña">
    <label for="contrasena">Confirmar Contraseña</label>
    <input type="password" name="contrasenaCon" placeholder="Ingrese aqui de nuevo su contraseña">

    <input type="hidden" name="id" value="<?= $_SESSION["id"] ?>">
    
  <?php }
  ?>

  <button type="submit" class="btn btn-dark" name="btmodificar" value="ok">Modificar</button> 

</form>


<?php
include ("../includes/footer.php");
?>