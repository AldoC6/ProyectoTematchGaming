<?php

if(!empty($_GET["id"])){
    $id = $_GET["id"];

    $eliminar=$conexion->query("delete from juegos where id = '$id'");

    if ($eliminar == true) {
        echo "<div class='alert alert-success'>Juego eliminado</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar</div>";
    }?>
    

    <script>
         window.history.replaceState(null, null, window.location.pathname); //REFRESCA LA URL Y NO SE DUPLICA EL REGISTRO
    </script>

<?php }

