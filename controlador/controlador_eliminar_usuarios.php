<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $eliminar=$conexion->query("delete from usuarios where id='$id'");
if ($eliminar==true) {
    echo "<div class'alert alert-succes'>Usuario eliminado </div>";
} else {
   echo "<div class'alert alert-danger'>Error al eliminar </div>";
}
}?>
<script>
    window.history.replaceState(null,null, window.location.pathname);
</script>