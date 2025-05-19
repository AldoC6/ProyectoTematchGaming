<?php

if(!empty($_POST["registro"])){
    if (empty($_POST["email"]) or empty($_POST["username"]) or empty($_POST["password"]) or empty($_POST["confirm_password"])){
        echo '<div class="alert alert-danger">Debe llenar todos los campos</div>';
    } else {
        $correo=$_POST["email"];
        $usuario=$_POST["username"];
        $contraseña=$_POST["password"];
        $confirmar_contraseña=$_POST["confirm_password"];

        // Validaciones
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="alert alert-danger">El formato del correo electrónico no es válido</div>';
        } elseif (strlen($usuario) < 3) {
            echo '<div class="alert alert-danger">El nombre de usuario debe tener al menos 3 caracteres</div>';
        } elseif (strlen($contraseña) < 6) {
            echo '<div class="alert alert-danger">La contraseña debe tener al menos 6 caracteres</div>';
        } elseif ($contraseña !== $confirmar_contraseña) {
            echo '<div class="alert alert-danger">Las contraseñas no coinciden</div>';
        } else {

            $verificarcorreo = $conexion->query("SELECT * FROM usuarios WHERE Correo = '$correo' ");
            $verificarusuario = $conexion->query("SELECT * FROM usuarios WHERE Usuario = '$usuario' ");

            if($verificarusuario ->num_rows>0){
                echo "<div class='alert alert-danger'>El nombre de usuario ya está en uso</div>";
                return 0;
            }elseif($verificarcorreo ->num_rows>0){
                echo "<div class='alert alert-danger'>El correo ya está en uso por otro usuario</div>";
                return 0;
            }else{
                $sql = $conexion -> query(" insert into usuarios(Usuario, Correo, Contrasena, id_rol)values('$usuario','$correo','$contraseña', 2) ");
                if ($sql==1) {
                    echo '<div class="alert alert-success">Usuario Registrado</div>';
                } else {
                    echo '<div class="alert alert-danger">Error al registrar usuario</div>';
                }
            }
            
        }

    }

}