<?php

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar si existen juegos asociados al género
    $verificar = $conexion->query("SELECT COUNT(*) AS total FROM juegos WHERE id_genero = $id");
    $fila = $verificar->fetch_assoc();

    if ($fila['total'] > 0) {
        echo "<div class='alert alert-warning'>No se puede eliminar el género porque hay uno o más juegos asociados.</div>";
    } else {
        $delete = $conexion->query("DELETE FROM generos WHERE id = $id");

        if ($delete) {
            echo "<div class='alert alert-success'>Género eliminado correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al eliminar el género.</div>";
        }
    }
}


/*if(!empty($_GET["id"])){
    $id=$_GET["id"];
    $sql=$conexion->query(" delete from generos where id=$id");
    if($sql==1){
        echo "<div class='alert alert-success'>Genero Eliminado</div>";
    }else{
        echo "<div class='alert alert-danger'>Error al eliminar</div>";
    }
}*/


?>