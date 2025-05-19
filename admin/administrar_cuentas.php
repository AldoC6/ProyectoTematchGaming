<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rol'] != '1') {
    header("Location: ../index.php");
    exit();
}

include("../includes/header.php");

// Controlador para eliminar usuarios y preparar mensaje
$mensaje = "";

if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    // Eliminamos usuario (asegúrate que la tabla sea 'usuarios')
    $eliminar = $conexion->query("DELETE FROM usuarios WHERE id = '$id'");

    if ($eliminar === true) {
        $mensaje = "eliminado";
    } else {
        $mensaje = "error";
    }
}

// Parámetro para búsqueda
$buscar = isset($_GET['buscar_usuario']) ? $_GET['buscar_usuario'] : '';

// Consulta usuarios filtrando por búsqueda y contando reseñas
if ($buscar != '') {
    $sql = $conexion->query("
        SELECT usuarios.*, 
               (SELECT COUNT(*) FROM resenas WHERE resenas.id_usuario = usuarios.id) AS total_reseñas
        FROM usuarios
        WHERE usuarios.Usuario LIKE '%$buscar%'
    ");
} else {
    $sql = $conexion->query("
        SELECT usuarios.*, 
               (SELECT COUNT(*) FROM resenas WHERE resenas.id_usuario = usuarios.id) AS total_reseñas
        FROM usuarios
    ");
}

?>

<!-- Inicio de Body -->
<style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
</style>
<script>
    function confirmar() {
        return confirm("¿Estás seguro de eliminar el usuario?");
    }
</script>

<div class="row">
    <div class="admin-container col-3">
        <aside class="sidebar">
            <a class="nav-link text-light text-center" href="vista_Admin.php">
                <h5>Bienvenido<br>Administrador</h5>
            </a>
            <a href="añadir_juegos.php" class="nav-link">Juegos</a>
            <a href="administrar_reseñas.php" class="nav-link">Reseñas </a>
            <a href="administrar_genero.php" class="nav-link">Género </a>
            <a href="administrar_cuentas.php" class="nav-link">Usuarios</a>
            <a href="estadisticas.php" class="nav-link">Estadísticas</a>
        </aside>
    </div>

    <form class="col-2 p-3" method="GET" action="administrar_cuentas.php">
        <h3 class="text-center">Administrar Usuarios</h3>
        <div class="mb-3">
            <label for="buscar_usuario" class="form-label">Buscar Usuarios</label>
            <input type="text" id="buscar_usuario" class="form-control" name="buscar_usuario" placeholder="Escribe nombre de usuario" value="<?= htmlspecialchars($buscar) ?>">
        </div>
        <button type="submit" class="btn btn-dark">Buscar</button>
    </form>

    <div class="col-7 p-4">

        <!-- Mensaje de eliminación -->
        <?php if (!empty($mensaje)): ?>
            <div class="alert <?= $mensaje == 'eliminado' ? 'alert-success' : 'alert-danger' ?> text-center w-75 mx-auto">
                <?= $mensaje == 'eliminado' ? 'Usuario eliminado correctamente.' : 'Error al eliminar el usuario.' ?>
            </div>
        <?php endif; ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Usuarios</th>
                    <th scope="col">Reseñas</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <td><?= $datos->Usuario ?></td>
                        <td><?= $datos->total_reseñas ?? 0 ?></td>
                        <td>
                            <a href="administrar_cuentas.php?id=<?= $datos->id ?>" onclick="return confirmar()" class="btn btn-small btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

