

<?php include("../../includes/header.php");?>

<?php 
$id=$_GET["id"];
$sql=$conexion->query(" select * from generos where id=$id");
?>

<form class="col-2 p-3 m-auto" method="POST">
    <h3 class="text-center text-Light">Modificar Generos</h3>
    <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
    <?php
    include "../../controlador/editar_genero1.php";
    while($datos=$sql->fetch_object()){?>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Genero</label>
        <input type="text" class="form-control" name ="genero" value="<?= $datos->nombre?>">
        </div>
    <?php }
    ?>
    
    <button type="submit" class="btn btn-dark" name="btnagregar" value="ok">Modificar</button>
</form>

</body>
</html>