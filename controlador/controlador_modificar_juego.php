<?php

if(!empty($_POST["btnmodificar"])) {

    $nombre = $_POST["nombre"];
    $genero = $_POST["txtgenero"];
    $fecha = $_POST["fecha"];
    $descripcion = $_POST["descripcion"];
    $id=$_POST["txtid"];

    if(!empty($nombre) and !empty($genero) and !empty($fecha) and !empty($descripcion)){
        $modificar = $conexion->query("update juegos set nombreJ='$nombre', id_genero='$genero', fecha_lanzamiento='$fecha', descripcion='$descripcion' where id = '$id'");
        if($modificar==true){
            echo "<div class='alert alert-success'>Juego Editado</div>";
        }else{
            echo "<div class='alert alert-danger'>Error al editar</div>";
        }
    }else{
        echo "<div class='alert alert-danger'>Faltan datos por llenar</div>";
    }?>

    <script>
        window.history.replaceState(null, null, window.location.pathname); //REFRESCA LA URL Y NO SE DUPLICA EL REGISTRO
    </script>

<?php }

