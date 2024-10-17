<!-- reporte de errores -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Iniciar la sesión
session_start();

// Comprobar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirigir a index.php
    header("Location: index.php");
    exit();
}

require_once 'includes/conexion.php'; // Asegúrate de tener tu conexión

// Verificar si se ha enviado el formulario
if (!empty($_POST['stock'])) {
    // Iterar sobre el array de stock enviado en el formulario
    foreach ($_POST['stock'] as $id => $nuevo_stock) {
        $id = intval($id); // Convertir el ID a un entero
        $nuevo_stock = intval($nuevo_stock); // Convertir el stock a un entero
        
        if ($id > 0 && $nuevo_stock >= 0) { // Validación básica
            // Preparar la consulta SQL para actualizar el stock
            $sql = "UPDATE entradas SET stock = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("ii", $nuevo_stock, $id);
            
            if ($stmt->execute()) {
                echo "Stock del producto con ID $id actualizado correctamente<br />";
            } else {
                echo "Error al actualizar el stock del producto con ID $id: " . $stmt->error . "<br />";
            }
        } else {
            echo "ID no válido o stock no puede ser negativo para el producto con ID $id<br />";
        }
    }
} else {
    echo "No se ha enviado ningún stock para actualizar.";
}

// Redirigir a la página principal después de actualizar
header("Location: principal.php");
exit;
?>