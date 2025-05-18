<?php

if(!empty($_POST['btmodificar'])){
    if(!empty($_POST['nombre'] and !empty($_POST['correo']) and !empty($_POST['contrasena']))){
        $id  = $_SESSION['id'];
        $usuario = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contrasena'];

        $consulta_actual = $conexion->query("SELECT Contrasena FROM usuarios WHERE id = '$id'");
        $fila = $consulta_actual->fetch_assoc();
        $contrasena_actual = $fila['Contrasena'];


        $check_sql = $conexion->query("SELECT * FROM usuarios WHERE Correo = '$correo' AND id != '$id'");
        if($check_sql->num_rows > 0){
            echo "<div class='alert alert-warning'>El correo ya está en uso</div>";
        } elseif ($contraseña == $contrasena_actual) {
            echo "<div class='alert alert-warning'>La nueva contraseña no puede ser igual a la actual</div>";
        } else {
            $check_sql = $conexion->query("SELECT * FROM usuarios WHERE Usuario = '$usuario' AND id != '$id'");
              if($check_sql->num_rows > 0){
            echo "<div class='alert alert-warning'>El nombre de usuario ya está en uso</div>";
            } else {
            $sql = $conexion->query("UPDATE usuarios SET Usuario = '$usuario', Correo = '$correo', Contrasena = '$contraseña' WHERE id='$id'");
            if($sql == 1){
                header("Location: ../perfil.php");
            } else {
                echo "<div class='alert alert-danger'>Error al modificar</div>";
            }
            }
        }
    } else {
        echo "<div class='alert alert-warning'>Campo vacío</div>";
    }
}

?>


