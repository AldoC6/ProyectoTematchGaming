<?php
$host = "localhost";
$usuario = "root";
$contraseña = "";
$basededatos = "tematchgaming0";

$conexion = mysqli_connect($host, $usuario, $contraseña, $basededatos);

// Verificar conexión
if($conexion ->connect_errno){
    die("Conexion Fallida" . $conexion -> connect_errno);
}
?>
