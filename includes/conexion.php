<?php
// Conexión
$servidor = 'localhost';
$usuario = 'usuario';
$password = 'password';
$basededatos = 'database_name';
$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

mysqli_query($db, "SET NAMES 'utf8'");

// Iniciar la sesión
if(!isset($_SESSION)){
	session_start();
}
