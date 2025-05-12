<!--La linea 2 representa el inicio de la estructura html5 y el navbar. includes/header.php -->
<?php include("includes/header.php"); ?>
<!--Inicio de Body -->
<style>
    .register-container {
    text-align: center;
    padding-top: 30px; /* Puedes ajustar este valor */
    background-color: rgba(0, 0, 0, 0.5);
    width: 320px; /* Ajusta el ancho según sea necesario */
    margin: 20px auto; /* Centra el contenedor */
    padding: 30px;
    border-radius: 10px;
    position: relative;
}

.register-container h2 {
    font-size: 2em;
    font-weight: bold;
    color: #eee; /* Cambiado a color claro para el fondo oscuro */
    text-shadow: 1px 1px 1px #000;
    margin-bottom: 20px; /* Añadido margen inferior */
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 15px; /* Añadido margen inferior entre los grupos */
}

.form-group label {
    text-align: left;
    font-weight: bold;
    color: #ddd;
    font-size: 18px;
    text-shadow: 1px 1px 1px #000;
}

.form-group input {
    padding: 10px;
    border: none;
    border-radius: 20px;
    font-size: 16px;
    outline: none;
    background-color: #333; /* Fondo oscuro para los inputs */
    color: #eee; /* Texto claro para los inputs */
}

.register-button {
    margin-top: 10px;
    padding: 10px;
    border: none;
    border-radius: 20px;
    background-color: #000;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 2px 2px 5px #333;
}

.login-link {
    font-size: 14px;
    color: #ccc;
    margin-top: 15px;
    display: block; /* Cambiado a block para que ocupe toda la línea */
    text-decoration: none;
}

.login-alternative {
    display: block;
    margin-top: 10px;
    font-size: 14px;
    color: #ccc;
    text-decoration: none;
}

.login-link a,
.login-alternative a {
    color: #ccc;
}

.login-link a:hover,
.login-alternative a:hover {
    text-decoration: underline;
}

.alerta{
    text-align: center;
    color: red;
}

.success{
    text-align: center;
    color: green;
}
</style>
<div class="register-container">
    <h2>Registrarse</h2>
    <form method="POST" action="">
        <?php
            include("controlador/registro_usuario.php");
        ?>

        <div class="form-group">
            <label for="email">Correo:</label>
            <input type="" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirmar contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password">
        </div>
        <button type="submit" class="register-button" name="registro" value="ok">Continuar</button>
    </form>
    <div class="login-link">
        ¿Ya tienes una cuenta? <a href="#">Iniciar sesión</a>
    </div>
    <div class="login-alternative">
        O <a href="#">Iniciar sesión</a>
    </div>
</div>





<!-- Fin de Body -->
<?php include("includes/footer.php"); ?>
<!--La linea de arriba es el final de la estructura html5, basicamente donde se cierra el body y la etiqueta html-->