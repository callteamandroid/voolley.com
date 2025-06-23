<?php
require '../frameworkng/db/conexionmysql.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $familia = $_POST['familia'];
    $codigo = $_POST['codigo'];
    $modelo = $_POST['modelo'];
    $parte = $_POST['parte'];
    $unidad = $_POST['unidad'];
    $descripcion = $_POST['descripcion'];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO productos (nombre, familia, codigo, modelo, noParte, unidad, descripcion)
            VALUES ('$nombre', '$familia', '$codigo', '$modelo', '$parte', '$unidad', '$descripcion')";

    if ($conexion->query($sql) === TRUE) {
        echo "Producto guardado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    $conexion->close();
}
?>
