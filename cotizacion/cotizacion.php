<?php
require './account/auth.php';
include './frameworkng/common.php';
$orden='Selecciona Orden de Compra';
//session_start();  // Iniciar la sesión
$usr = $_SESSION['username'];  // Ahora puedes acceder a la variable de sesión
?>
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex align-items-center">
        <i class="fas fa-pencil-alt me-2"></i>
        <h1 class="h5 mb-0">Agregar nueva compra</h1>
    </div>
    <div class="card-body">
        <h2 class="h6">Nueva Compra</h2>
        <hr class="border-primary">
        <h3 class="h6">Detalles de la compra</h3>
        <form>
            <div class="row g-3">
                <!-- Campo Proveedor -->
                <div class="col-md-6">
                    <label for="proveedor" class="form-label">Proveedor</label>
                    <div class="input-group">
                        <select id="proveedor" class="form-select">
                            <option selected>Selecciona cliente</option>
                            <option selected>cliente 1</option>
                        </select>
                        <p id="usuario" style="display:none;"><?php echo $usr;?></p>
                        <p id="planta" style="display:none;">
                            <?php 
                                require './frameworkng/db/conexionmysql.php';
                                $sql = $conexion->query("SELECT * FROM usuarios where usuario = '$usr'");
                                while ($resultado = $sql->fetch_assoc()) {
                                    echo $resultado['planta'];
                                }
                            ?>
                        </p>
                        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#proveedores">+ Nuevo</button>
                    </div>
                </div>

                <!-- Campo N° Factura -->
                <div class="col-md-5">
                    <label for="compra-numero" class="form-label">N° Factura</label>
                    <input type="text" id="compra-numero" class="form-control" value="">
                </div>

                <!-- Botón para abrir modal de búsqueda de productos -->
                <div class="col-md-1 d-flex align-items-end">
                    <button class="btn btn-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#buscarProductosModal">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <!-- Tabla de Productos Seleccionados -->
                <table id="tablaSeleccionados" class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Costo</th>
                            <th>Total</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <!-- Resumen de Totales -->
                <div>
                    <p>Total Neto: <span id="neto">0.00</span></p>
                    <p>IVA: <input type="number" id="iva-amount" value="16">%</p>
                    <p>Total: <span id="total">0.00</span></p>
                </div>

            </div>

            <!-- Botón para Guardar Compra -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <button class="btn btn-success d-flex align-items-center" id="guardarCompra"> 
                    <i class="fas fa-save me-2"></i>Guardar datos
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Nuevo Proveedores -->
<div class="modal fade" id="proveedores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulario de Proveedores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="empresa-tab" data-bs-toggle="tab" data-bs-target="#empresa" type="button" role="tab" aria-controls="empresa" aria-selected="true">Empresa</button>
                    </li>
                </ul>  
                <form class="row g-3">
                    <div class="tab-content" id="myTabContent">
                        <!-- Tab Empresa -->
                        <div class="tab-pane fade show active" id="empresa" role="tabpanel" aria-labelledby="empresa-tab">
                            <div class="d-flex justify-content-center flex-column align-items-center">
                                <div class="col-md-12">
                                    <label for="bussines_name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="bussines_name" name="bussines_name" required><br>
                                </div>
                            </div>
                        </div>
                        <!-- Tab Empresa -->
                        <div class="tab-pane fade show active" id="contacto" role="tabpanel" aria-labelledby="empresa-tab">
                            <div class="d-flex justify-content-center flex-column align-items-center">
                                <div class="col-md-12">
                                    <label for="bussines_name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="bussines_name" name="bussines_name" required><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="guardarprov" type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Productos -->
<div class="modal fade" id="buscarProductosModal" tabindex="-1" aria-labelledby="buscarProductosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buscarProductosModalLabel">Buscar productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group">
                        <?php 
                        $inputGenerator = new InputGenerator();
                        // select proveedores
                        $sql1 = $conexion->query("SELECT * FROM productos ORDER BY nombre");
                        $oc = ["Selecciona producto"];
                        while ($resultado1 = $sql1->fetch_assoc()) {
                            $idOc = $resultado1['id'];
                            $noOc = $resultado1['codigo'];
                            $des =  $resultado1['descripcion'];
                            $oc[$noOc] = $noOc . "-" . $des;     
                        }
                        $proveedor1 = $inputGenerator->selectInput('proveedori', $oc, 'No', ['class' => 'form-select', 'id' => 'provedori']);
                        echo $proveedor1;
                        ?>
                        <button class="btn btn-outline-secondary" type="button" onclick="searchProducts()"><i class="fas fa-search"></i> Buscar</button>
                    </div>
                </div>
                <table id="productosOC" class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Costo</th>
                            <th>Cantidad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="product-list">
                        <?php
                        require './frameworkng/db/conexionmysql.php';
                        $conexion->set_charset('utf8');

                        // Obtener el término de búsqueda
                        $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

                        // Asegúrate de que el término de búsqueda esté sanitizado para evitar inyección SQL
                        $searchTerm = mysqli_real_escape_string($conexion, $searchTerm);

                        // Modificar la consulta para buscar por id, nombre, fecha sin distinguir entre mayúsculas y minúsculas
                        $sql = $conexion->query("SELECT * FROM productos WHERE 
                                                LOWER(id) LIKE LOWER('%$searchTerm%') OR
                                                LOWER(nombre) LIKE LOWER('%$searchTerm%') OR 
                                                LOWER(fecha) LIKE LOWER('%$searchTerm%')
                                                ORDER BY nombre ASC;");

                        // Verificar si la consulta fue exitosa
                        if (!$sql) {
                            die("Error en la consulta: " . $conexion->error);
                        }

                        // Mostrar los resultados
                        while ($resultado = $sql->fetch_assoc()) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($resultado['codigo']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($resultado['nombre']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($resultado['descripcion']); ?>
                                </td>
                                <td>
                                    <?php echo "$" . number_format($resultado['precio'], 2, '.', ','); ?>
                                </td>
                                <td>
                                    <input type="number" class="form-control" value="1" min="1" max="10" id="cantidad_<?php echo $resultado['codigo']; ?>" data-max="10" data-original="1">
                                </td>
                                <td>
                                    <button class="btn btn-success agregar"
                                            data-codigo="<?php echo htmlspecialchars($resultado['codigo']); ?>"
                                            data-nombre="<?php echo htmlspecialchars($resultado['nombre']); ?>"
                                            data-descripcion="<?php echo htmlspecialchars($resultado['descripcion']); ?>"
                                            data-costo="<?php echo $resultado['precio']; ?>">
                                        <i class="fas fa-plus"></i> Agregar
                                    </button>
                                </td>
                            </tr>
                        <?php
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Variable global que almacena los productos seleccionados
let productosSeleccionados = [];

document.getElementById('guardarCompra').addEventListener('click', function(event) {
    event.preventDefault(); // Prevenir el comportamiento predeterminado del botón

    // Recoger los datos de los campos del formulario
    const proveedor = document.getElementById('proveedor').value;
    const usuario = document.getElementById('usuario').innerText;
    const factura = document.getElementById('compra-numero').value;
    const ivaAmount = document.getElementById('iva-amount').value;

    const productos = productosSeleccionados;

    // Calcular el subtotal (total neto de todos los productos)
    let subtotal = 0;
    productos.forEach(producto => {
        subtotal += producto.cantidad * producto.costo;
    });

    // Calcular el IVA y el total
    const iva = subtotal * (parseFloat(ivaAmount) / 100);
    const total = subtotal + iva;

    // Validación de campos
    if (!proveedor || !factura || productos.length === 0) {
        alert('Por favor, completa todos los campos antes de guardar.');
        return;
    }

    // Enviar los datos al servidor
    fetch('./cotizaciones/guardar_compra.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            proveedor,
            usuario,
            factura,
            ivaAmount,
            subtotal,
            iva,
            total,
            productos,
            cliente: proveedor // Enviar el cliente (proveedor) al backend
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Compra guardada exitosamente');
            productosSeleccionados = []; // Limpiar productos seleccionados
            actualizarTablaSeleccionados();
        } else {
            alert('Error al guardar la compra');
        }
    });
});

// Función para actualizar la tabla de productos seleccionados
function actualizarTablaSeleccionados() {
    const tabla = document.getElementById('tablaSeleccionados').getElementsByTagName('tbody')[0];
    tabla.innerHTML = ''; // Limpiar tabla antes de agregar los productos

    let totalNeto = 0;
    productosSeleccionados.forEach(function(producto, index) {
        var fila = tabla.insertRow();

        // Insertar el código del producto
        fila.insertCell(0).textContent = producto.codigo;

        // Insertar el nombre del producto
        fila.insertCell(1).textContent = producto.nombre;

        // Insertar la descripción del producto
        fila.insertCell(2).textContent = producto.descripcion;

        // Insertar un input para la cantidad
        var celdaCantidad = fila.insertCell(3);
        var inputCantidad = document.createElement('input');
        inputCantidad.type = 'number';
        inputCantidad.value = producto.cantidad;
        inputCantidad.min = 1;  // Asegura que la cantidad sea al menos 1
        inputCantidad.classList.add('form-control');
        inputCantidad.addEventListener('change', function() {
            producto.cantidad = parseInt(inputCantidad.value);
            actualizarTablaSeleccionados(); // Actualizar tabla cuando se cambie la cantidad
        });
        celdaCantidad.appendChild(inputCantidad);

        // Insertar el costo del producto
        fila.insertCell(4).textContent = producto.costo.toFixed(2); // Aquí se imprime el costo

        // Insertar el total (cantidad * costo)
        var celdaTotal = fila.insertCell(5);
        celdaTotal.textContent = (producto.cantidad * producto.costo).toFixed(2);

        // Insertar el botón de eliminar
        var eliminarBtn = fila.insertCell(6);
        var icon = document.createElement('i');
        icon.classList.add('fas', 'fa-trash-alt', 'text-primary', 'cursor-pointer');
        icon.onclick = function() {
            // Eliminar el producto del arreglo productosSeleccionados por su índice
            productosSeleccionados.splice(index, 1);
            actualizarTablaSeleccionados(); // Actualiza la tabla después de eliminar el producto
        };
        eliminarBtn.appendChild(icon);

        totalNeto += producto.cantidad * producto.costo;
    });

    // Actualizar valores de neto, IVA y total
    document.getElementById('neto').textContent = totalNeto.toFixed(2);
    const iva = parseFloat(document.getElementById('iva-amount').value);
    const ivaAmount = totalNeto * (iva / 100);
    document.getElementById('total').textContent = (totalNeto + ivaAmount).toFixed(2);
}

// Función para agregar productos seleccionados
document.querySelectorAll('.agregar').forEach(button => { 
    button.addEventListener('click', function() {
        // Obtener el valor del input de cantidad asociado al producto
        var codigo = this.getAttribute('data-codigo');
        var cantidad = document.getElementById('cantidad_' + codigo).value;
        var descripcion = this.getAttribute('data-descripcion');
        var costo = parseFloat(this.getAttribute('data-costo')); // Asegúrate de convertirlo a número
        var nombre = this.closest('tr').querySelector('td:nth-child(2)').textContent; // Obtener el nombre del producto
        
        var producto = {
            codigo: codigo,
            nombre: nombre,
            descripcion: descripcion,
            cantidad: parseInt(cantidad),
            costo: costo // El costo ya es un número
        };

        productosSeleccionados.push(producto);

        // Actualizar la tabla de productos seleccionados
        actualizarTablaSeleccionados();
    });
});

</script>
