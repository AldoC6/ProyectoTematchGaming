<?php

if(!empty($_POST["btnagregar"])){

    if(!empty($_POST["genero"])){
        
        $nombre=$_POST["genero"];

        $sql=$conexion->query(" insert into generos(nombre)values('$nombre')");

        if($sql==1){
            echo '<div class="alert alert-success">Genero Agregado Correctamente</div>';
        }else{
            echo '<div class="alert alert-danger">Error al registrar</div>';
        }
    }else{
        echo '<div class="alert alert-danger">El campo "Genero" esta vacio</div>';
    }
}

?>