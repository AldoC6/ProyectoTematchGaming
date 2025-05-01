<?php   

if(!empty($_POST["btnagregar"])){
    if(!empty($_POST["genero"])){
        $id=$_POST["id"];
        $nombre=$_POST["genero"];
        $sql=$conexion->query(" update generos set nombre='$nombre' where id=$id ");

        if($sql==1){
            header("location: /ProyectoTematchGaming/admin/administrar_genero.php");
        }else{
            echo "<div class='alert alert-danger'>Error al modificar</div>";
        }
    }else{
        echo "<div class='alert alert-warning'>Campo vacio</div>";
    }
}

?>