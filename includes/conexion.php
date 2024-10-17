<?php
// Conexión
$servidor = '192.168.1.163';
$usuario = 'juan';
$password = 'teleline1981';
$basededatos = 'blog_database';
$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

mysqli_query($db, "SET NAMES 'utf8'");

// Iniciar la sesión
if(!isset($_SESSION)){
	session_start();
}