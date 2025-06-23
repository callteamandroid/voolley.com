<?php
session_start();
$usr = isset($_SESSION['username']) ? $_SESSION['username'] : 'usuario desconocido';
$planta = isset($_SESSION['planta']) ? $_SESSION['planta'] : 'usuario desconocido';

include('../frameworkng/db/conexionmysql.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $nombreOrden = $_POST['nombreOrden'];
    $productos = json_decode($_POST['productos'], true);

    // Verificar si el número de orden ya existe en la base de datos
    $checkQuery = "SELECT COUNT(*) FROM orden WHERE noOrden = ?";
    $stmtCheck = $conexion->prepare($checkQuery);
    $stmtCheck->bind_param("s", $nombreOrden);
    $stmtCheck->execute();
    $stmtCheck->bind_result($count);
    $stmtCheck->fetch();
    $stmtCheck->close();

    if ($count > 0) {
        $response['status'] = 'error';
        $response['message'] = 'El número de orden de compra ya existe. Por favor, ingrese otro.';
    } else {
        $status = "ABIERTA";
        $productos_json = json_encode($productos);

        // Insertar los datos en la tabla orden
        $stmt = $conexion->prepare("INSERT INTO orden (noOrden, productos, usuario, status, planta, prodOriginal) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            $response['status'] = 'error';
            $response['message'] = 'Error en la preparación de la consulta: ' . $conexion->error;
        } else {
            $stmt->bind_param("ssssss", $nombreOrden, $productos_json, $usr, $status, $planta, $productos_json);
            $stmt->execute();
            $stmt->close();

            $response['status'] = 'success';
            $response['message'] = 'Orden de compra guardada correctamente.';
        }
    }
}

$conexion->close();

// Devolver la respuesta como JSON
echo json_encode($response);
?>
