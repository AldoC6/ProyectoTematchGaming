<?php


if(!empty($_POST['btmodificar'])){
    if(!empty($_POST['nombre'] and !empty( $_POST['correo']) and !empty( $_POST['contrasena']) and !empty($_POST['contrasenaCon']))){
        $id  = $_SESSION['id'];
        $usuario = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contrasena'];
        $confirmar_contraseña = $_POST['contrasenaCon'];
        
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="alert alert-danger">El formato del correo electrónico no es válido</div>';
        } elseif (strlen($usuario) < 3) {
            echo '<div class="alert alert-danger">El nombre de usuario debe tener al menos 3 caracteres</div>';
        } elseif (strlen($contraseña) < 6) {
            echo '<div class="alert alert-danger">La contraseña debe tener al menos 6 caracteres</div>';
        } elseif ($contraseña !== $confirmar_contraseña) {
            echo '<div class="alert alert-danger">Las contraseñas no coinciden</div>';
        }else{

            $verificarcorreo = $conexion->query("SELECT * FROM usuarios WHERE Correo = '$correo' AND id != $id");
            $verificarusuario = $conexion->query("SELECT * FROM usuarios WHERE Usuario = '$usuario' AND id != $id");
            if($verificarusuario ->num_rows>0){
                echo "<div class='alert alert-danger'>El nombre de usuario ya está en uso</div>";
                return 0;
            }elseif($verificarcorreo ->num_rows>0){
                echo "<div class='alert alert-danger'>El correo ya está en uso por otro usuario</div>";
                return 0;
            }else{
                $sql=$conexion->query(" update usuarios set Usuario = '$usuario', Correo = '$correo', Contrasena = '$contraseña' where id=$id  ");
                if ($sql==1) {
                    header("Location: ../perfil.php");
                } else {
                    echo '<div class="alert alert-danger">Error al registrar usuario</div>';
                }
            }
        }
    }else{
        echo "<div class='alert alert-warning'>Campos vacios</div>";
    }
    
}

?>

