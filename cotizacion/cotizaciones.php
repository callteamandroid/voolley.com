<?php
include './frameworkng/common.php'; 
$inputGenerator = new InputGenerator();
$name =  $inputGenerator->textInput('name', '', 'No. de Orden', ['class' => 'form-control',  'id' => 'name']);
?>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .sidebar {
        height: 100vh;
        background-color: #343a40;
        color: white;
        padding-top: 20px;
    }
    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 10px 20px;
    }
    .sidebar a:hover {
        background-color: #495057;
    }
    .sidebar .active {
        background-color: #495057;
    }
    .content {
        padding: 20px;
    }
    .navbar {
        background-color: #28a745;
        color: white;
    }
    .navbar .form-control {
        width: 200px;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .badge-active {
        background-color: #28a745;
        color: white;
    }
    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }
    .table-container {
        max-height: 300px;
        overflow-y: auto;
    }
</style>

<body>
    <!-- Modal para Nueva Orden de Compra -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><i class="fas fa-pencil-alt"></i> Agregar Nueva Orden de Compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formulario">
                    <div class="modal-body">
                        <div class="container mt-1">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="https://storage.googleapis.com/a1aa/image/fUS2Ky9qBFSvSSHwd7rxz17S7TYVNli7X9cy2nf2zZ26SP5TA.jpg" alt="Imagen caja" class="img-fluid">
                                </div>
                                <div class="col-md-10">
                                    <div class="card p-1">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <h6>Orden de Compra</h6>
                                                <label for="name">No. de Orden de Compra</label>
                                                <div><?php echo $name; ?></div>
                                            </div>
                                        </div>
                                        <div class="table-container">
                                            <table class="table table-bordered" id="miTabla">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>No. Fila</th>
                                                        <th>No. Parte</th>
                                                        <th>Descripción</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <button type="button" class="btn btn-primary" onclick="agregarFila()">Agregar Fila</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="Guardar" type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <input class="form-control" placeholder="Buscar por nombre" type="text" id="searchInput"/>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <select class="form-select">
                    <option selected>Selecciona fabricante</option>
                    <?php
                        require './frameworkng/db/conexionmysql.php';
                        $sql = $conexion->query("SELECT * FROM fabricantes ORDER BY id");
                        while ($resultado = $sql->fetch_assoc()) {
                            $tipo = $resultado['nombre'];  
                            echo "<option value='$tipo'>$tipo</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-secondary w-100 mt-0">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-plus"></i> Nuevo
            </button>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i> Mostrar
            </button>
        </div>
    </div>

    <h4 class="mt-4">Órdenes de Compra</h4>

    <table id="compras" class="table table-bordered">
        <thead>
            <tr>
                <th>No. Orden</th>
                <th>Productos</th>
                <th>Fecha Registro</th>
                <th>Usuario</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require './frameworkng/db/conexionmysql.php';
            $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
            $searchTerm = mysqli_real_escape_string($conexion, $searchTerm);

            $sql = $conexion->query("SELECT * FROM cotizaciones WHERE 
                                      LOWER(id) LIKE LOWER('%$searchTerm%') OR
                                      LOWER(productos) LIKE LOWER('%$searchTerm%') OR 
                                      LOWER(registro) LIKE LOWER('%$searchTerm%')
                                      ORDER BY registro ASC;");

            if (!$sql) {
                die("Error en la consulta: " . $conexion->error);
            }

            while ($resultado = $sql->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $resultado['id']; ?><br>
                    <form method="POST" action="./cotizaciones/generapdf.php">
                                            <input style="display:none;" type="hidden" name="nid1" id="nid1" value="<?php echo $resultado['id']; ?> ">
                                            <button  type="submimt" class="mt-2 align-middle btn btn-outline-info">
                                                <i class="fa fa-file-pdf" style="color: #ff0000;"></i> Resguardo
                                            </button>
                                        </form></td>
                    <td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#productosModal<?php echo $resultado['id'];?>">Ver Productos</button>
                        <div class="modal fade" id="productosModal<?php echo $resultado['id'];?>" tabindex="-1" aria-labelledby="productosModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="productosModalLabel">Lista de Productos</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $productos = json_decode($resultado['productos'], true);
                                                if (!empty($productos)) {
                                                    foreach ($productos as $producto) {
                                                        echo "<tr>";
                                                        echo "<td>" . htmlspecialchars($producto['codigo']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($producto['nombre']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($producto['descripcion']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($producto['cantidad']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($producto['costo']) . "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='4'>No hay productos disponibles.</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><?php echo $resultado['registro']; ?></td>
                    <td><?php echo $resultado['usuario']; ?></td>
                    <!--td>
                        <?php //echo ($resultado['status'] == "CERRADA") ? "<span class='badge bg-danger'>CERRADA</span>" : "<span class='badge bg-success'>ABIERTA</span>"; ?>
                    </td-->
                    <td>$
                        <?php
                            $productos = json_decode($resultado['productos'], true);
                            $totalPrecio = 0;
                            foreach ($productos as $producto) {
                                if (isset($producto['costo']) && is_numeric($producto['costo'])) {
                                    $totalPrecio += $producto['costo'];
                                }
                            }
                            echo number_format($totalPrecio, 2);
                        ?>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button aria-expanded="false" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" type="button">
                                Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Editar</a></li>
                                <li><a class="dropdown-item" href="#">Borrar</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        <span>Mostrando 1 al 4 de 4 registros</span>
        <nav>
            <ul class="pagination mb-0">
                <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
            </ul>
        </nav>
    </div>
</body>
<script>
var contadorFila = 1; // Asegúrate de declarar esto solo una vez en el ámbito global o fuera de cualquier función repetida.

$(document).ready(function () {
    $('#exampleModal').on('hidden.bs.modal', function () {
         contadorFila = 1;
        // Resetear el formulario
        $('#formulario')[0].reset();
        
        // Eliminar todas las filas de la tabla (excepto la cabecera)
        $('#miTabla tbody').empty();

        // Reiniciar el contador de filas a 1
         // Reiniciar contador solo cuando sea necesario
         actualizarTablaCompras(); 
        
    });
});

// Esta es la función donde agregas las filas a la tabla
function agregarFila() {
    
    const table = document.getElementById('miTabla').getElementsByTagName('tbody')[0];
    const newRow = table.insertRow();
    
    // Crear las celdas para la nueva fila
    const cell1 = newRow.insertCell(0);  // No. Fila
    const cell2 = newRow.insertCell(1);  // Código
    const cell3 = newRow.insertCell(2);  // Descripción
    const cell4 = newRow.insertCell(3);  // Cantidad
    const cell5 = newRow.insertCell(4);  // Precio
    
    // Establecer el contenido de la primera celda (número de fila)
    cell1.innerHTML = contadorFila;

    // Establecer los inputs para "Código" y "Descripción" en las celdas correspondientes
    cell2.innerHTML = `
        <input list="codigo-list-${contadorFila}" class="form-control" name="codi${contadorFila}" placeholder="Selecciona Código" onchange="verificarCodigo(${contadorFila})">
        <datalist id="codigo-list-${contadorFila}">
            <?php
                require './frameworkng/db/conexionmysql.php';
                $sql = $conexion->query("SELECT * FROM productos ORDER BY id");
                while ($resultado = $sql->fetch_assoc()) {
                    $codigo = $resultado['codigo'];  
                    echo "<option value='$codigo'>$codigo</option>";
                }
            ?>
        </datalist>
    `;
    cell3.innerHTML = `
        <input list="descripcion-list-${contadorFila}" class="form-control" name="descripc${contadorFila}" placeholder="Selecciona Descripción"  onchange="verificarDescripcion(${contadorFila})">
        <datalist id="descripcion-list-${contadorFila}">
            <?php
                $sql = $conexion->query("SELECT * FROM productos ORDER BY id");
                while ($resultado = $sql->fetch_assoc()) {
                    $descripcion = $resultado['descripcion'];  
                    echo "<option value='$descripcion'>$descripcion</option>";
                }
            ?>
        </datalist>
    `;
    
    
    cell4.innerHTML = '<input type="number" class="form-control" name="cantidad[]" placeholder="Cantidad">';
    cell5.innerHTML = '<input type="number" class="form-control" name="precio[]" placeholder="Precio">';
    
    contadorFila++; // Incrementar solo cuando se agrega una nueva fila
}

function verificarCodigo(rowNumber) {
    // Obtener el código ingresado en el input correspondiente a la fila
    var codigo = document.querySelector(`input[name='codi${rowNumber}']`).value;

    if (codigo.trim() !== '') {
        // Hacer la petición AJAX a PHP
        $.ajax({
            url: './productos/ajax.php',  // Archivo PHP que verifica el código
            method: 'GET',
            data: { codigo: codigo },  // Enviar el código ingresado al PHP
            success: function(response) {
                var data = JSON.parse(response);

                // Si el código existe, agregar la descripción al campo de descripción
                if (data.exists) {
                    // Ahora usamos el id dinámico correcto basado en rowNumber
                    document.querySelector(`input[name='descripc${rowNumber}']`).value = data.descripcion;
                } else {
                    // Si no existe, limpiar el campo de descripción
                    document.querySelector(`input[name='descripc${rowNumber}']`).value = '';
                }
            },
            error: function(xhr, status, error) {
                console.log("Error al verificar el código:", error);
            }
        });
    }
}

function verificarDescripcion(rowNumber) {
    // Obtener el valor de la descripción
    var descripcion = document.querySelector(`input[name='descripc${rowNumber}']`).value;

    if (descripcion.trim() !== '') {
        // Hacer la petición AJAX a PHP para buscar por descripción
        $.ajax({
            url: './productos/ajax.php',  // Archivo PHP que verifica el código o descripción
            method: 'GET',
            data: { descripcion: descripcion },  // Enviar la descripción al PHP
            success: function(response) {
                var data = JSON.parse(response);

                // Si la descripción existe, devuelve el código
                if (data.exists) {
                    // Colocar el código en el campo correspondiente
                    document.querySelector(`input[name='codi${rowNumber}']`).value = data.codigo;
                } else {
                    // Si no se encuentra, limpiar el campo de código
                    document.querySelector(`input[name='codi${rowNumber}']`).value = '';
                }
            },
            error: function(xhr, status, error) {
                console.log("Error al verificar la descripción:", error);
            }
        });
    }
}


$('#Guardar').click(function() {
    contadorFila = 1;
    var formData = new FormData($('#formulario')[0]);
    formData.append('nombreOrden', document.getElementById('name').value);
    formData.append('usuario', document.getElementById('name').value);  // Este campo parece estar duplicado. Quizás sea otro valor.
    formData.append('planta', document.getElementById('name').value);    // Este también puede ser otro campo.

    console.log(formData); // Imprime los datos de formData para asegurarse de que estén bien formateados

    // Capturar productos de la tabla
    var productos = [];
    $('#miTabla tbody tr').each(function() {
        var noParteInput = $(this).find('input[name^="codi"]');
        var noParte = noParteInput.length > 0 ? noParteInput.val().trim() : '';
        
        var descripcionInput = $(this).find('input[name^="descripc"]');
        var descripcion = descripcionInput.length > 0 ? descripcionInput.val().trim() : '';
        
        var cantidadInput = $(this).find('input[name^="cantidad"]');
        var cantidad = cantidadInput.length > 0 ? parseFloat(cantidadInput.val().trim()) : 0; // Asegúrate de convertirlo a número
        
        var precioInput = $(this).find('input[name^="precio"]');
        var precio = precioInput.length > 0 ? parseFloat(precioInput.val().trim()) : 0; // Asegúrate de convertirlo a número

        // Verificar que los campos no estén vacíos y que los números sean válidos
        if (noParte && descripcion && cantidad > 0 && precio > 0) {
            var producto = {
                noParte: noParte,
                descripcion: descripcion,
                cantidad: cantidad,
                precio: precio
            };
            productos.push(producto); // Solo agregar el producto si tiene todos los campos llenos
        }
    });

    // Verificar si hay productos en el arreglo antes de enviar
    if (productos.length > 0) {
        formData.append('productos', JSON.stringify(productos));

        $.ajax({
            url: './ordencompra/guardar.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                var response = JSON.parse(res);

                if(response.status === 'success') {
                    alert(response.message);
                    
                    // Aquí puedes hacer algo con la respuesta para actualizar la tabla de compras sin recargar
                    // Ejemplo: Actualizar una tabla de compras, o agregar la nueva orden al front-end
                    
                   // Asegúrate de definir esta función según el formato de la respuesta
                    
                    
                } else {
                    alert(response.message);
                }
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.log("Error al guardar los datos:", error);
                alert("Hubo un error al guardar los datos.");
            }
        });
    } else {
        alert("No hay productos válidos para guardar.");
    }
});
function actualizarTablaCompras() {
    $.ajax({
        url: './ordencompra/ajax.php',  // Ruta al archivo PHP que devuelve los datos de las compras
        type: 'POST',  // Cambié el tipo de solicitud a POST
        dataType: 'json',  // Asegúrate de que la respuesta sea JSON
        success: function(data) {
            var tableBody = $('#compras tbody');
            //tableBody.empty();  // Limpiar la tabla

            // Verificar si hay datos
            if (data.status === 'success' && data.compras.length > 0) {
                data.compras.forEach(function(compra) {
                    var tr = $('<tr></tr>');

                    // Añadir los datos a cada celda
                    tr.append('<td>' + compra.noOrden + '</td>');
                    tr.append('<td>' +
                        '<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#productosModal' + compra.id + '">Ver Productos</button>' +
                        '<div class="modal fade" id="productosModal' + compra.id + '" tabindex="-1" aria-labelledby="productosModalLabel" aria-hidden="true">' +
                            '<div class="modal-dialog">' +
                                '<div class="modal-content">' +
                                    '<div class="modal-header">' +
                                        '<h5 class="modal-title" id="productosModalLabel">Lista de Productos</h5>' +
                                        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                    '</div>' +
                                    '<div class="modal-body">' +
                                        '<table class="table table-bordered">' +
                                            '<thead class="table-dark">' +
                                                '<tr><th>No. Parte</th><th>Descripción</th><th>Cantidad</th><th>Precio</th></tr>' +
                                            '</thead>' +
                                            '<tbody>' + 
                                                getProductosModal(compra.productos) +
                                            '</tbody>' +
                                        '</table>' +
                                    '</div>' +
                                    '<div class="modal-footer">' +
                                        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</td>');
                    tr.append('<td>' + compra.fecha + '</td>');
                    tr.append('<td>' + compra.usuario + '</td>');
                    tr.append('<td>' + compra.planta + '</td>');
                    tr.append('<td>' +
                        (compra.status === "CERRADA" ? "<span class='badge bg-danger'>CERRADA</span>" : "<span class='badge bg-success'>ABIERTA</span>") +
                    '</td>');
                    tr.append('<td>$' + compra.precio + '</td>');
                    tr.append('<td>' +
                        '<div class="dropdown">' +
                            '<button aria-expanded="false" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" type="button">Acciones</button>' +
                            '<ul class="dropdown-menu">' +
                                '<li><a class="dropdown-item" href="#">Editar</a></li>' +
                                '<li><a class="dropdown-item" href="#">Borrar</a></li>' +
                            '</ul>' +
                        '</div>' +
                    '</td>');

                    tableBody.append(tr);  // Añadir la fila a la tabla
                });
            } else {
                tableBody.append('<tr><td colspan="8">No hay compras disponibles.</td></tr>');
            }
        },
        error: function(xhr, status, error) {
            console.log("Error al obtener las compras:", error);
            alert("Hubo un error al obtener las compras.");
        }
    });
}

// Función auxiliar para generar el contenido del modal de productos
function getProductosModal(productosJson) {
    var productos = JSON.parse(productosJson);
    var html = '';
    productos.forEach(function(producto) {
        html += '<tr>';
        html += '<td>' + producto.noParte + '</td>';
        html += '<td>' + producto.descripcion + '</td>';
        html += '<td>' + producto.cantidad + '</td>';
        html += '<td>' + producto.precio + '</td>';
        html += '</tr>';
    });
    return html;
}






</script>
