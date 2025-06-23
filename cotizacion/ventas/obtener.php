<?php
// Conectar a la base de datos
require '../frameworkng/db/conexionmysql.php';

// Verificar si se ha recibido el parámetro 'proveedor'
if (isset($_GET['proveedor'])) {
    $proveedor = $_GET['proveedor'];

    // Consulta SQL para obtener los productos agrupados por 'codigo' y 'ubicacion', sumando las cantidades
    $query = "SELECT codigo, ubicacion, SUM(cantidad) AS cantidad_total
              FROM stock 
              WHERE codigo = '$proveedor'
              GROUP BY codigo, ubicacion;";  // Agrupar por 'codigo' y 'ubicacion' y sumar las cantidades

    // Ejecutar la consulta
    $result = $conexion->query($query);
    
    // Verificar si hubo un error en la consulta
    if (!$result) {
        // Si hubo un error, mostrar mensaje de error
        echo "Error en la consulta: " . $conexion->error;
        exit;
    }

    // Si hay productos, generar la tabla HTML
    if ($result->num_rows > 0) {
        // Iniciar la tabla
        

        // Recorrer los resultados de la consulta y generar las filas de la tabla
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['codigo']) . "</td>";  // Código
            echo "<td>" . htmlspecialchars($row['cantidad_total']) . "</td>";  // Cantidad total
            echo "<td>" . htmlspecialchars($row['ubicacion']) . "</td>";  // Ubicación
            echo '<td><input type="number" class="form-control" value="1" min="1" max="1" id="cantidad_'.$row['codigo'].'" data-max="1" data-original="1"></td>'; // Ubicación
            echo "<td>
                    <button class='btn btn-success agregar' 
                            data-codigo='" . htmlspecialchars($row['codigo']) . "' 
                            data-ubicacion='" . htmlspecialchars($row['ubicacion']) . "' 
                            data-cantidad='" . htmlspecialchars($row['cantidad_total']) . "'>
                        <i class='fas fa-plus'></i> Agregar
                    </button>
                  </td>";
            
            echo "</tr>";
        }

    } else {
        echo "<p>No se encontraron productos para este proveedor.</p>";
    }
} else {
    echo "<p>No se ha recibido el parámetro 'proveedor'.</p>";
}
?>
