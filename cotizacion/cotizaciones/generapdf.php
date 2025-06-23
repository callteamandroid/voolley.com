<?php
require '../vendor/autoload.php'; // Asegúrate de tener PhpWord instalado
use PhpOffice\PhpWord\TemplateProcessor;

require '../frameworkng/db/conexionmysql.php'; // Conectar a la base de datos

// Establecer la zona horaria
date_default_timezone_set('America/Monterrey');

// Obtener el ID de la cotización
$id = $_POST['nid1'] ?? null;
$id = trim($id);

// Obtener datos de la cotización
$sql = $conexion->query("SELECT * FROM cotizaciones WHERE id = '$id'");

if (!$sql) {
    die("Error en la consulta: " . $conexion->error);
}

$resultado = $sql->fetch_assoc();
if (!$resultado) {
    die("No se encontró el registro.");
}

// Decodificar el campo productos (JSON)
$productos = json_decode($resultado['productos'], true); // Decodificamos el JSON a un arreglo de PHP

// Verificar si los productos fueron decodificados correctamente
if (!$productos) {
    die("Error al decodificar los productos.");
}

// Ruta del archivo Word plantilla
define('WORD_FILE_PATH', './formato.docx');

if (!file_exists(WORD_FILE_PATH)) {
    die('El archivo no existe en la ruta especificada.');
}

$tempDir = sys_get_temp_dir();
$templateProcessor = new TemplateProcessor(WORD_FILE_PATH);

// Verificar que el marcador 'producto' existe en la plantilla antes de clonarlo
$templateProcessor->cloneRow('producto', count($productos));  // Clona tantas filas como productos

// Llenar las filas clonadas con los datos de los productos
foreach ($productos as $index => $producto) {
    // Validamos que el producto tenga los datos esperados
    if (isset($producto['codigo'], $producto['nombre'], $producto['descripcion'], $producto['cantidad'], $producto['costo'])) {
        // Usamos los índices para llenar cada fila clonada
        $templateProcessor->setValue("producto#" . ($index + 1), trim($producto['nombre']));
        $templateProcessor->setValue("descripcion#" . ($index + 1), trim($producto['descripcion']));
        $templateProcessor->setValue("precio#" . ($index + 1), "$" . number_format($producto['costo'], 2, '.', ','));
        $templateProcessor->setValue("cant#" . ($index + 1), $producto['cantidad']);
        $templateProcessor->setValue("sub#" . ($index + 1), "$" . number_format($producto['costo'] * $producto['cantidad'], 2, '.', ','));
        $templateProcessor->setValue("total#" . ($index + 1), "$" . number_format($producto['costo'] * $producto['cantidad'], 2, '.', ','));
    }
}

// Guardar el archivo generado
$fileName = $tempDir . '/cotizacion_' . $id . '.docx';
$templateProcessor->saveAs($fileName);

// Descargar el archivo generado
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
readfile($fileName);
?>
