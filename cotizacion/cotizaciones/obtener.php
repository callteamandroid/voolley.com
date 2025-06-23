<?php
// Conectar a la base de datos
require '../frameworkng/db/conexionmysql.php';

// Verificar si se ha recibido el parámetro 'proveedor'
if (isset($_GET['proveedor'])) {
    $proveedor = $_GET['proveedor'];

    // Consulta SQL para obtener las órdenes de compra de este proveedor
    $query = "SELECT productos FROM orden WHERE id = '$proveedor' AND status = 'ABIERTA'"; // Ajusta la consulta según tu estructura de base de datos

    // Ejecutar la consulta
    $result = $conexion->query($query);
    
    // Verificar si hubo un error en la consulta
    if (!$result) {
        // Si hubo un error, enviamos una respuesta JSON con el error
        echo json_encode(["error" => "Error en la consulta: " . $conexion->error]);
        exit;  // Detenemos la ejecución del script aquí
    }

    // Crear un array para almacenar los productos
    $productos = [];

    // Recorrer los resultados de la consulta
    while ($row = $result->fetch_assoc()) {
        // Decodificar el campo 'productos' (en formato JSON) de la base de datos
        $productosarray = json_decode($row['productos'], true);

        // Si hay productos, los agregamos al array
        if (is_array($productosarray)) {
            $productos = array_merge($productos, $productosarray);
        }
    }

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si no encontramos productos, devolver un JSON vacío
    if (empty($productos)) {
        echo json_encode(["error" => "No se encontraron productos para este proveedor."]);
    } else {
        // Devolver los productos como un array JSON
        echo json_encode($productos);
    }
} else {
    // Si no se ha recibido el parámetro 'proveedor', enviar un error en formato JSON
    echo json_encode(["error" => "No se ha recibido el parámetro 'proveedor'."]);
}
?>
