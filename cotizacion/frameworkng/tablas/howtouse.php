$tableGenerator = new TableGenerator();

// Establecer atributos de la tabla
$tableGenerator->setAttributes(['class' => 'table', 'id' => 'myTable']);

// Agregar cabeceras a la tabla
$tableGenerator->addHeader('Nombre');
$tableGenerator->addHeader('Edad');
$tableGenerator->addHeader('Email');

// Agregar filas a la tabla
$tableGenerator->addRow(['Juan Pérez', 30, 'juan@example.com']);
$tableGenerator->addRow(['Ana Gómez', 25, 'ana@example.com']);
$tableGenerator->addRow(['Luis Rodríguez', 28, 'luis@example.com']);

// Generar la tabla y mostrarla
echo $tableGenerator->generateTable();
