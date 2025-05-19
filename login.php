<!--La linea 2 representa el inicio de la estructura html5 y el navbar. includes/header.php -->
<?php include("includes/header.php"); ?>
<!--Inicio de Body -->
<style>
  /*Tabla del login */
.login-container {
  text-align: center;
  padding-top: 30px;
}

h1 {
  font-size: 2em;
  font-weight: bold;
  color: #000;
  text-shadow: 1px 1px 1px #aaa;
}

.login-box {
  background-color: rgba(0, 0, 0, 0.5);
  width: 320px;
  margin: 20px auto;
  padding: 30px;
  border-radius: 10px;
  position: relative;
}

.icon img {
  width: 80px;
  border-radius: 50%;
  margin-bottom: 20px;
  background: #fff;
  padding: 10px;
}

label {
  text-align: left;
  font-weight: bold;
  color: #ddd;
  font-size: 18px;
  text-shadow: 1px 1px 1px #000;
}

input {
  padding: 10px;
  border: none;
  border-radius: 20px;
  font-size: 16px;
  outline: none;
}

button {
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

.register {
  display: block;
  margin-top: 15px;
  font-size: 16px;
  color: #ccc;
  text-decoration: none;
}

</style>

<div class="login-container">
    <h1>Iniciar sesión</h1>
    <div class="login-box">
      <div class="icon">
        <img src="img/NavBar/Usuario.png" alt="Usuario">
      </div>

      <form method="POST" action="">
        <?php
        include ("controlador/controlador_login.php")
        ?>

        <label for="correo">Correo:</label>
        <input type="email" name="correo">

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena">

        <button type="submit" name="iniciar" value="ok">Continuar</button>
      </form>

      <a href="registrarse.php" class="register">Registrarse</a>
    </div>
  </div>

<!-- Fin de Body -->
<?php include("includes/footer.php"); ?>
<!--La linea de arriba es el final de la estructura html5, basicamente donde se cierra el body y la etiqueta html-->