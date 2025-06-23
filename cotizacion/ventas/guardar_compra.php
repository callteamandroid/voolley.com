<?php
session_start();

$usr = isset($_SESSION['username']) ? $_SESSION['username'] : 'usuario desconocido';
$planta = isset($_SESSION['planta']) ? $_SESSION['planta'] : 'usuario desconocido';

require '../frameworkng/db/conexionmysql.php';

// Obtener los datos JSON enviados por AJAX
$data = json_decode(file_get_contents('php://input'), true);

// Verificar que los datos necesarios existan
if (empty($data['proveedor']) || empty($data['usuario']) || empty($data['factura']) || empty($data['iva']) || empty($data['neto']) || empty($data['total']) || empty($data['productos']) || empty($data['orden'])) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos.']);
    exit;
}

// Obtener los datos de la compra
$proveedor = $data['proveedor'];
$usuario = $data['usuario'];
$factura = $data['factura'];
$iva = $data['iva'];
$neto = $data['neto'];
$ivaAmount = $data['ivaAmount'];
$total = $data['total'];
$productos = $data['productos'];  // Este es el arreglo de productos para la tabla 'compras'
$productosOrden = $data['productosOrden'];  // Este es el arreglo de productos para la tabla 'compras'
$status = $data['status'];  // Recibimos el estado de la compra (ABIERTA o CERRADA)
$orden = $data['orden'];  // Obtener la variable orden

// Iniciar una transacción para asegurar la integridad de los datos
$conexion->begin_transaction();

try {
    // Insertar la compra en la base de datos
    $sql_compra = "INSERT INTO compras (proveedor, usuario, factura, neto, iva, total, productos, planta) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql_compra);
    $json_productos = json_encode($productos);  // Convertir productos a JSON antes de pasarlo
    $stmt->bind_param('sssdssss', $proveedor, $usuario, $factura, $neto, $iva, $total, $json_productos, $planta);

    if ($stmt->execute()) {
        // Si la compra se guarda exitosamente, obtener el ID de la compra
        $compra_id = $stmt->insert_id;

        // Ahora, actualizamos los productos de la orden de compra y el estado
        $json_productosOrden = json_encode($productosOrden);  // Los productos con las cantidades actualizadas

        // Consulta para actualizar los productos de la orden de compra y el estado
        $sql_update = "UPDATE orden SET productos = ?, status = ? WHERE id = ?";  // Asegúrate de que el campo 'id' es el correcto
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bind_param('ssi', $json_productosOrden, $status, $orden);  // Usamos el valor de 'orden' recibido
        $stmt_update->execute();

        // Aquí comienza la parte donde insertamos los productos en la tabla 'stock'
        $sql_stock = "INSERT INTO stock (codigo, ubicacion, planta, cantidad, precio, usuario) 
                      VALUES (?, ?, ?, ?, ?, ?)";
        
        // Filtrar y guardar solo los datos relevantes en la tabla 'stock'
        $stmt_stock = $conexion->prepare($sql_stock);

        // Iteramos sobre el arreglo de productos original (no sobre el JSON)
        foreach ($productos as $producto) {
            // Filtramos solo los campos necesarios
            $codigo = $producto['codigo'];
            $cantidad = $producto['cantidad'];
            $precio = isset($producto['costo']) ? $producto['costo'] : 0;  // Verificación si existe 'precio', si no se asigna 0
            $ubicacion = isset($producto['ubicacion']) ? $producto['ubicacion'] : 'desconocida';  // Verificación si existe 'ubicacion', si no se asigna 'desconocida'

            // Insertar en la tabla stock
            $stmt_stock->bind_param('ssssss', $codigo, $ubicacion, $planta, $cantidad, $precio, $usuario);
            $stmt_stock->execute();
        }

        // Si todo está bien, commit a la transacción
        $conexion->commit();
        echo json_encode(['success' => true, 'message' => 'Compra y productos guardados exitosamente']);

    } else {
        throw new Exception("Error al guardar la compra");
    }

    // Cerrar las sentencias
    $stmt->close();
    $stmt_update->close();
    $stmt_stock->close();

} catch (Exception $e) {
    // Si ocurre algún error, hacer rollback y mostrar el error
    $conexion->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conexion->close();
?>
