<?php
require '../frameworkng/db/conexionmysql.php';

// Verificar si se pasa el código o la descripción
if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    // Consulta para verificar si el código existe en la base de datos
    $sql = "SELECT descripcion FROM productos WHERE codigo = ?";
    $stmt = $conexion->prepare($sql);
    
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conexion->error);
    }

    $stmt->bind_param('s', $codigo);  // Vincula el parámetro
    $stmt->execute();  // Ejecuta la consulta
    
    // Vinculamos el resultado
    $stmt->bind_result($descripcion);
    
    // Comprobamos si se encontraron filas
    if ($stmt->fetch()) {
        // Si se encuentra el código, devuelve la descripción
        echo json_encode(['exists' => true, 'descripcion' => $descripcion]);
    } else {
        // Si no se encuentra el código, devuelve "exists" como false
        echo json_encode(['exists' => false]);
    }

    // Cerramos la declaración
    $stmt->close();
} elseif (isset($_GET['descripcion'])) {
    $descripcion = $_GET['descripcion'];

    // Consulta para buscar por descripción y obtener el código correspondiente
    $sql = "SELECT codigo FROM productos WHERE descripcion LIKE ?";
    $stmt = $conexion->prepare($sql);
    
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conexion->error);
    }

    $descripcion = "%" . $descripcion . "%"; // Agregar comodines a la descripción
    $stmt->bind_param('s', $descripcion);  // Vincula el parámetro
    $stmt->execute();  // Ejecuta la consulta
    
    // Vinculamos el resultado
    $stmt->bind_result($codigo);
    
    // Arreglo para almacenar los códigos encontrados
    $results = [];
    
    while ($stmt->fetch()) {
        $results[] = $codigo;  // Guardamos los códigos encontrados
    }
    
    // Comprobamos si se encontraron filas
    if (count($results) > 0) {
        // Si se encuentra alguna descripción, devuelve el primer código encontrado
        echo json_encode(['exists' => true, 'codigo' => $results[0]]);
    } else {
        // Si no se encuentra la descripción, devuelve "exists" como false
        echo json_encode(['exists' => false]);
    }

    // Cerramos la declaración
    $stmt->close();
} else {
    // Si no se recibe ni código ni descripción, devuelve un error
    echo json_encode(['exists' => false]);
}
?>
