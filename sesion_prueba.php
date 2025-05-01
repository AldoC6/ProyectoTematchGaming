<?php
session_start();

// ✅ Simular que el usuario "Aldo" ha iniciado sesión como admin
$_SESSION['usuario'] = "Aldo";
$_SESSION['rol'] = "admin"; // Cambia a "usuario" si quieres probar esa vista

// Redirigir a donde quieras
header("Location: admin/vista_Admin.php");
exit();
