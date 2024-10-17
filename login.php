<!-- reporte de errores -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php
// Iniciar la sesión y la conexión a bd
session_start(); // Asegúrate de iniciar la sesión
require_once 'includes/conexion.php';

// Recoger datos del formulario
if(isset($_POST)){
	
    // Borrar error antiguo
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']); // Usar unset para eliminar el error anterior
    }
		
    // Recoger datos del formulario
    $email = trim($_POST['email']);
    $password = $_POST['password'];
	
    // Consulta para comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);
	
    if($login && mysqli_num_rows($login) == 1){
        $usuario = mysqli_fetch_assoc($login);
		
        // Comprobar la contraseña
        $verify = password_verify($password, $usuario['password']);
		
        if($verify){
            // Utilizar una sesión para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;
            // Redirigir a principal.php si el login es correcto
            header('Location: principal.php');
            exit(); // Asegúrate de detener la ejecución del script
        } else {
            // Si algo falla enviar una sesión con el fallo
            $_SESSION['error_login'] = "Login incorrecto!!";
        }
    } else {
        // mensaje de error
        $_SESSION['error_login'] = "Login incorrecto!!";
    }
}

// Redirigir al index.php si no se ha iniciado sesión
header('Location: index.php');
// exit(); // Detener la ejecución