<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Si el usuario está autenticado, redirige a principal.php
if (isset($_SESSION['usuario'])) {
    header("Location: principal.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Formulario de Login</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body>
<aside id="sidebar">
    <?php if(!isset($_SESSION['usuario'])): ?>
    <div id="login" class="bloque">
        <h3>Identifícate</h3>
        
        <?php if(isset($_SESSION['error_login'])): ?>
            <div class="alerta alerta-error">
                <?= $_SESSION['error_login']; ?>
            </div>
        <?php endif; ?>
        
        <form action="login.php" method="POST"> 
            <label for="email">Email</label>
            <input type="email" id="email" name="email">

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password">

            <input type="submit" value="Entrar">
        </form>
    </div>
    <?php endif; ?>
</aside>
</body>
</html>
