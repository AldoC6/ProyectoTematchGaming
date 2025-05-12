<?php
session_start();
include("includes/conexion.php");

// Redirigir si no ha iniciado sesión
if (!isset($_SESSION['id']) || ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2)) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

$sql = $conexion->query("SELECT * FROM usuarios WHERE id = $id");

if ($datos = $sql->fetch_object()) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("includes/header.php"); ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Perfil de Usuario</h3>
        </div>
        <div class="card-body">
            <p><strong>Nombre de usuario:</strong> <?php echo $datos->Usuario; ?></p>
            <p><strong>Correo:</strong> <?php echo $datos->Correo; ?></p>
            <p><strong>contraseña:</strong> <?php echo $datos->Contrasena; ?></p>

            <a href="editar_perfil.php" class="btn btn-primary">Editar perfil</a>
        </div>
    </div>
</div>

</body>
</html>
<?php
} else {
    echo "<div class='alert alert-danger'>No se encontró información del usuario.</div>";
}
?>


<?php

include ("includes/footer.php")

?>


