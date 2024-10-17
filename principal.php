<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'includes/conexion.php'; // Asegúrate de tener tu conexión a la base de datos
//session_start();

// Comprobar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirigir a index.php
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listado de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"] {
            width: 50px;
        }

        .logout-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #f44336; /* Rojo para cerrar sesión */
            color: white;
            border: none;
            cursor: pointer;
            text-align: center;
        }

        .logout-button:hover {
            background-color: #d32f2f; /* Rojo más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>

<h1>Listado de Productos</h1>

<!-- Botón de cerrar sesión -->
<a href="logout.php" class="logout-button">Cerrar Sesión</a>

<form action="actualizar_stock.php" method="POST">
    <table>
        <tr>
            <th>Título</th>
            <th>Stock</th>
            <th>Acción</th>
        </tr>

        <?php
        $sql = "SELECT id, titulo, stock FROM entradas";
        $result = $db->query($sql);

        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= htmlspecialchars($row['titulo']); ?></td>
            <td>
                <input type="number" name="stock[<?= $row['id']; ?>]" value="<?= htmlspecialchars($row['stock']); ?>" />
            </td>
            <td>
                <!-- Botón para actualizar -->
                <button type="submit" name="update_stock" value="<?= $row['id']; ?>">Actualizar</button>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</form>

</body>
</html>