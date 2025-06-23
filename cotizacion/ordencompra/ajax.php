<?php
require '../frameworkng/db/conexionmysql.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchTerm = mysqli_real_escape_string($conexion, $searchTerm);

$sql = $conexion->query("SELECT * FROM orden WHERE 
                          LOWER(noOrden) LIKE LOWER('%$searchTerm%') OR
                          LOWER(productos) LIKE LOWER('%$searchTerm%') OR 
                          LOWER(fecha) LIKE LOWER('%$searchTerm%')
                          ORDER BY fecha ASC;");

if (!$sql) {
    die("Error en la consulta: " . $conexion->error);
}

$compras = [];
while ($resultado = $sql->fetch_assoc()) {
    // Decodificar productos
    $productos = json_decode($resultado['productos'], true);
    
    // Calcular el total de precio
    $totalPrecio = 0;
    foreach ($productos as $producto) {
        if (isset($producto['precio']) && is_numeric($producto['precio'])) {
            $totalPrecio += $producto['precio'];
        }
    }

    $compras[] = [
        'id' => $resultado['id'],
        'noOrden' => $resultado['noOrden'],
        'productos' => json_encode($productos), // Codificar los productos nuevamente
        'fecha' => $resultado['fecha'],
        'usuario' => $resultado['usuario'],
        'planta' => $resultado['planta'],
        'status' => $resultado['status'],
        'precio' => number_format($totalPrecio, 2)
    ];
}

// Establecer encabezado de respuesta como JSON
header('Content-Type: application/json');

// Devolver los datos en formato JSON
echo json_encode($compras);
?>
