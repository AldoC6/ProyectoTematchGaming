<?php
session_start();

include ("../includes/conexion.php");

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 2) {
    echo "<script>alert('Solo usuarios registrados pueden calificar.'); window.location.href = '/ProyectoTematchGaming/reseña.php';</script>";
    exit();
}

$id_usuario = $_SESSION['id'];
$id_juego = intval($_POST['id_juego']);
$estrellas = intval($_POST['estrellas']);

if ($id_juego <= 0 || $estrellas < 1 || $estrellas > 5) {
    echo "<script>alert('Datos inválidos.'); window.history.back();</script>";
    exit();
}

$verificar = $conexion->query("SELECT * FROM calificaciones WHERE id_usuario = $id_usuario AND id_juego = $id_juego");

if ($verificar->num_rows > 0) {
    echo "<script>alert('Ya has calificado este juego.'); window.history.back();</script>";
} else {
    $insertar = $conexion->query("INSERT INTO calificaciones (id_usuario, id_juego, estrellas) VALUES ($id_usuario, $id_juego, $estrellas)");
    if ($insertar) {
        echo "<script>alert('¡Gracias por calificar!'); window.location.href = '/ProyectoTematchGaming/reseña.php?id=$id_juego';</script>";
    } else {
        echo "<script>alert('Error al guardar calificación.'); window.history.back();</script>";
    }
}
?>
