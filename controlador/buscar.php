<?php
include ("../includes/conexion.php");

if (isset($_GET['q'])) {
    $busqueda = trim($_GET['q']);
    
    // Preparar y ejecutar la búsqueda
    $stmt = $conexion->prepare("SELECT id FROM juegos WHERE nombreJ LIKE ?");
    $like = "%$busqueda%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($row = $resultado->fetch_assoc()) {
        // Redirige al primer resultado encontrado
        header("Location: ../reseña.php?id=" . $row['id']);
        exit();
    } else {
        echo "<script>alert('No se encontró el juego'); window.location.href='../index.php';</script>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>
