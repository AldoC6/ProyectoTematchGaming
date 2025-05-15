<?php
if (!empty($_POST["iniciar"])) {
    if (empty($_POST["correo"]) and empty($_POST["contrasena"])) {
        echo '<div class="alert alert-danger">Debe llenar todos los campos</div>';
    } else {
        $correo = $_POST["correo"];
        $contraseña = $_POST["contrasena"];

        $sql = $conexion->query("SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$contraseña'");

        if ($datos = $sql->fetch_object()) {
            $_SESSION["id"] = $datos->id;
            $_SESSION["rol"] = $datos->id_rol;
            $_SESSION["usuario"] = $datos ->Usuario;

            if ($datos->id_rol == 1) {
                header("Location: admin/vista_admin.php");
            } else {
                header("Location: index.php");
            }
            exit(); 
        } else {
            echo '<div class="alert alert-danger">Acceso denegado</div>';
        }
    }
}
?>
