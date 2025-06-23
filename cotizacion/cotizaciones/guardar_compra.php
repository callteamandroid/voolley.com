<?php
session_start();

// Activar la visualización de errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Obtener datos del usuario de la sesión
$usr = isset($_SESSION['username']) ? $_SESSION['username'] : 'usuario desconocido';
$planta = isset($_SESSION['planta']) ? $_SESSION['planta'] : 'usuario desconocido';

require '../frameworkng/db/conexionmysql.php';

// Obtener los datos JSON enviados por AJAX
$data = json_decode(file_get_contents('php://input'), true);

// Verificar que los datos necesarios existan
if (empty($data['proveedor']) || empty($data['usuario']) || empty($data['subtotal']) || empty($data['iva']) || empty($data['total']) || empty($data['productos'])) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos.']);
    exit;
}

// Obtener los datos de la compra
$proveedor = $data['proveedor'];
$usuario = $data['usuario'];
$subtotal = $data['subtotal'];
$iva = $data['iva'];
$total = $data['total'];
$productos = $data['productos'];  // Este es el arreglo de productos para la tabla 'cotizaciones'
$cliente = $data['cliente'];  // El cliente (proveedor)

// Iniciar una transacción para asegurar la integridad de los datos
$conexion->begin_transaction();

try {
    // Insertar la cotización en la base de datos (sin el campo 'factura')
    $sql_cotizacion = "INSERT INTO cotizaciones (productos, usuario, subtotal, iva, total, cliente) 
                       VALUES (?, ?, ?, ?, ?, ?)";

    // Verificar si la preparación de la consulta falla
    if (!$stmt = $conexion->prepare($sql_cotizacion)) {
        throw new Exception("Error al preparar la consulta SQL: " . $conexion->error);
    }

    $json_productos = json_encode($productos);  // Convertir productos a JSON antes de pasarlo

    // Vincular parámetros a la consulta preparada
    if (!$stmt->bind_param('ssssss', $json_productos, $usuario, $subtotal, $iva, $total, $cliente)) {
        throw new Exception("Error al vincular los parámetros: " . $conexion->error);
    }

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Si la cotización se guarda exitosamente
        $conexion->commit();
        echo json_encode(['success' => true, 'message' => 'Cotización guardada exitosamente']);
    } else {
        throw new Exception("Error al ejecutar la consulta: " . $conexion->error);
    }

    // Cerrar la sentencia
    $stmt->close();

} catch (Exception $e) {
    // Si ocurre algún error, hacer rollback y mostrar el error
    $conexion->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conexion->close();
