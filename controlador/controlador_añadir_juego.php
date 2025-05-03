<?php

include ("../includes/conexion.php");
if(!empty($_POST["btnagregar"])){ // <-- nombre del boton de "añadir_juegos.php"
    
    $nombre = $_POST["nombre"];
    $genero = $_POST["txtgenero"];
    $fecha = $_POST["fecha"];
    $descripcion = $_POST["descripcion"];

    if(!empty($_POST["nombre"]) and !empty($_POST["txtgenero"]) and !empty($_POST["fecha"]) and !empty($_POST["descripcion"])) {
        $registrar = $conexion -> query(" insert into juegos(nombreJ,id_genero,fecha_lanzamiento,descripcion) values('$nombre', '$genero', '$fecha','$descripcion')");

        if($registrar==true){
            echo "<div class='alert alert-success'>Producto Registrado</div>";
        }else{
            echo "<div class='alert alert-danger'>Error al registrar</div>";
        }
    }else{
        echo "<div class='alert alert-danger'>Debe llenar todos los campos</div>";
    }

?>

    <script>

        window.history.replaceState(null, null, window.location.pathname); //REFRESCA LA URL Y NO SE DUPLICA EL REGISTRO

    </script>

<?php }
