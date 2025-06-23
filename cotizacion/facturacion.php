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
                            <option selected>Selecciona Proveedor</option>
                            <option>Proveedor 1</option>
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
                            <th>Cantidad</th>
                            <th>Ubicación</th>
                            <th>Cant.</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="product-list">
                        <!-- Los productos se cargarán aquí dinámicamente con JavaScript -->
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
let productosOrden = [];

function guardarCompra(event) {
    event.preventDefault(); // Prevenir el comportamiento predeterminado del botón
    document.getElementById("provedori").disabled = false;

    // Recoger los datos de los campos del formulario
    var proveedor = document.getElementById('proveedor').value;
    var planta = document.getElementById('planta').innerText;
    var usuario = document.getElementById('usuario').innerText;
    var factura = document.getElementById('compra-numero').value;
    var iva = document.getElementById('iva-amount').value;
    var neto = parseFloat(document.getElementById('neto').textContent);
    var ivaAmount = parseFloat(document.getElementById('iva-amount').value);
    var total = parseFloat(document.getElementById('total').textContent);

    // Obtener el valor de la orden (esto se asume que es el valor del select)
    var orden = document.getElementById('provedori').value;

    // Validaciones
    if (!proveedor || proveedor === "Selecciona Proveedor") {
        alert('Por favor, seleccione un proveedor.');
        return;
    }

    if (!factura) {
        alert('Por favor, ingrese el número de factura.');
        return;
    }

    if (productosSeleccionados.length === 0) {
        alert('No hay productos seleccionados para guardar.');
        return;
    }

    // Llamar a la función para actualizar el estado (status)
    actualizarEstado(); // Asegurarnos de que el estado esté actualizado antes de enviar la compra

    // Crear los productos a guardar como arreglo de objetos
    var productos = productosSeleccionados.map(function(producto) {
        return {
            codigo: producto.codigo,
            nombre: producto.nombre,
            descripcion: producto.descripcion,  // Descripción del producto
            cantidad: producto.cantidad,
            costo: producto.costo,
            ubicacion: producto.ubicacion  // Ubicación seleccionada
        };
    });

    // Crear el JSON para la compra
    var compra = {
        proveedor: proveedor,
        planta: planta,
        usuario: usuario,
        factura: factura,
        iva: iva,
        neto: neto,
        ivaAmount: ivaAmount,
        total: total,
        status: status,  // Agregar el estado al objeto de la compra
        productos: productos,  // Enviar los productos como un arreglo
        productosOrden: productosOrden,  // Agregar el arreglo de productosOrden
        orden: orden  // Agregar la variable 'orden' con el valor de la orden seleccionada
    };
    console.log(compra);
    
    // Enviar la solicitud al servidor con los datos en formato JSON
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './ventas/guardar_compra.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                var respuesta = JSON.parse(xhr.responseText);
                if (respuesta.success) {
                    alert('Salida guardada exitosamente');
                    productosSeleccionados = []; // Limpiar los productos seleccionados
                    actualizarTablaSeleccionados(); // Actualizar la tabla de productos seleccionados
                } else {
                    alert('Error al guardar la compra: ' + respuesta.message);
                }
            } catch (e) {
                console.error('Error al procesar la respuesta:', e);
                alert('Error al procesar la respuesta del servidor');
            }
        }
    };
    xhr.send(JSON.stringify(compra)); // Enviar el JSON de la compra
}

// Agregar el evento de guardado al botón
document.getElementById('guardarCompra').addEventListener('click', guardarCompra);

// Variable global que almacena los productos seleccionados
var productosSeleccionados = [];

let status = 'ABIERTA'; // Inicializamos el estado como ABIERTA

document.getElementById('provedori').addEventListener('change', function() {
    const proveedor = this.value;  // Obtenemos el proveedor seleccionado
    const orden = this.options[this.selectedIndex].text;  // Obtenemos el texto de la opción seleccionada como la orden

    if (proveedor) {
        fetch('./ventas/obtener.php?proveedor=' + proveedor)
            .then(response => response.text())  // Cambiar a text() porque estamos esperando HTML
            .then(html => {
                // Insertar el HTML recibido en el modal
                document.getElementById('productosOC').querySelector('tbody').innerHTML = html;

                // Agregar eventos a los botones "Agregar"
                const botonesAgregar = document.querySelectorAll('.agregar');
                botonesAgregar.forEach(boton => {
                    boton.addEventListener('click', function() {
                        const codigo = this.getAttribute('data-codigo');
                        const ubicacion = this.getAttribute('data-ubicacion');
                        const cantidad = parseInt(this.getAttribute('data-cantidad'));

                        // Validar y agregar el producto al carrito de selección
                        const productoSeleccionado = {
                            codigo: codigo,
                            ubicacion: ubicacion,
                            cantidad: cantidad
                        };

                        productosSeleccionados.push(productoSeleccionado);

                        // Actualizar la tabla de productos seleccionados (esto se debe definir en tu función)
                        actualizarTablaSeleccionados();
                    });
                });
            })
            .catch(error => {
                console.error('Error al cargar los productos:', error);
            });
    } else {
        alert('Selecciona un proveedor');
    }
});

// Función para actualizar el estado (status)
function actualizarEstado() {
    // Verificar si todas las cantidades de los productos son 0
    const todasCerradas = productosOrden.every(producto => producto.cantidad === 0);

    if (todasCerradas) {
        status = 'CERRADA';
    } else {
        status = 'ABIERTA';
    }

    console.log('Estado actual:', status); // Mostrar el estado actual en consola
}

// Función para actualizar la tabla de productos seleccionados
function actualizarTablaSeleccionados() {
    const tabla = document.getElementById('tablaSeleccionados').getElementsByTagName('tbody')[0];
    tabla.innerHTML = ''; // Limpiar tabla antes de agregar los productos

    let totalNeto = 0;
    productosSeleccionados.forEach(function(producto, index) {
        var fila = tabla.insertRow();

        // Insertar el código del producto
        fila.insertCell(0).textContent = producto.codigo;

        // Insertar la descripción del producto
        fila.insertCell(1).textContent = producto.descripcion;

        // Insertar un input para la cantidad
        var celdaCantidad = fila.insertCell(2);
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
        fila.insertCell(3).textContent = producto.costo.toFixed(2);

        // Insertar el total (cantidad * costo)
        var celdaTotal = fila.insertCell(4);
        celdaTotal.textContent = (producto.cantidad * producto.costo).toFixed(2);

        // Insertar el botón de eliminar
        var eliminarBtn = fila.insertCell(5);
        var icon = document.createElement('i');
        icon.classList.add('fas', 'fa-trash-alt', 'text-primary', 'cursor-pointer');
        icon.onclick = function() {
            // Calcular la diferencia de cantidad entre la cantidad eliminada y la original en productosOrden
            let cantidadEliminada = producto.cantidad;

            // Eliminar el producto del arreglo productosSeleccionados por su índice
            productosSeleccionados.splice(index, 1);

            // Ahora actualizamos productosOrden sumando la cantidad eliminada
            let productoOrdenExistente = productosOrden.find(function(p) {
                return p.codigo === producto.codigo;
            });

            if (productoOrdenExistente) {
                // Restauramos la cantidad eliminada en productosOrden
                productoOrdenExistente.cantidad += cantidadEliminada;

                // Mostrar el estado de productosOrden después de restaurar la cantidad
                console.log('productosOrden después de restaurar la cantidad:', productosOrden);
            }

            // Mostrar el arreglo productosOrden en la consola después de la modificación
            console.log('productosOrden actualizado después de eliminar un producto:', productosOrden);

            actualizarTablaSeleccionados(); // Actualiza la tabla después de eliminar el producto
            actualizarEstado(); // Actualizar estado al eliminar un producto
        };
        eliminarBtn.appendChild(icon);

        totalNeto += producto.cantidad * producto.costo;
    });

    // Actualizar valores de neto, IVA y total
    document.getElementById('neto').textContent = totalNeto.toFixed(2);
    const iva = parseFloat(document.getElementById('iva-amount').value);
    const ivaAmount = totalNeto * (iva / 100);
    document.getElementById('total').textContent = (totalNeto + ivaAmount).toFixed(2);

    // Mostrar el arreglo productosOrden en la consola cada vez que se actualiza la tabla
    console.log('productosOrden actualizado después de actualizar la tabla:', productosOrden);
}

</script>





 <!--optgroup label='RACKs'>
                                        <option value='RACK_A1'>RACK A - Peldaño 1</option>
                                        <option value='RACK_A2'>RACK A - Peldaño 2</option>
                                        <option value='RACK_A3'>RACK A - Peldaño 3</option>
                                        <option value='RACK_A4'>RACK A - Peldaño 4</option>
                                        
                                        <option value='RACK_B1'>RACK B - Peldaño 1</option>
                                        <option value='RACK_B2'>RACK B - Peldaño 2</option>
                                        <option value='RACK_B3'>RACK B - Peldaño 3</option>
                                        <option value='RACK_B4'>RACK B - Peldaño 4</option>
                                
                                        <option value='RACK_C1'>RACK C - Peldaño 1</option>
                                        <option value='RACK_C2'>RACK C - Peldaño 2</option>
                                        <option value='RACK_C3'>RACK C - Peldaño 3</option>
                                        <option value='RACK_C4'>RACK C - Peldaño 4</option>
                                
                                        <option value='RACK_D1'>RACK D - Peldaño 1</option>
                                        <option value='RACK_D2'>RACK D - Peldaño 2</option>
                                        <option value='RACK_D3'>RACK D - Peldaño 3</option>
                                        <option value='RACK_D4'>RACK D - Peldaño 4</option>
                                
                                        <option value='RACK_E1'>RACK E - Peldaño 1</option>
                                        <option value='RACK_E2'>RACK E - Peldaño 2</option>
                                        <option value='RACK_E3'>RACK E - Peldaño 3</option>
                                        <option value='RACK_E4'>RACK E - Peldaño 4</option>
                                
                                        <option value='RACK_F1'>RACK F - Peldaño 1</option>
                                        <option value='RACK_F2'>RACK F - Peldaño 2</option>
                                        <option value='RACK_F3'>RACK F - Peldaño 3</option>
                                        <option value='RACK_F4'>RACK F - Peldaño 4</option>
                                
                                        <option value='RACK_G1'>RACK G - Peldaño 1</option>
                                        <option value='RACK_G2'>RACK G - Peldaño 2</option>
                                        <option value='RACK_G3'>RACK G - Peldaño 3</option>
                                        <option value='RACK_G4'>RACK G - Peldaño 4</option>
                                
                                        <option value='RACK_H1'>RACK H - Peldaño 1</option>
                                        <option value='RACK_H2'>RACK H - Peldaño 2</option>
                                        <option value='RACK_H3'>RACK H - Peldaño 3</option>
                                        <option value='RACK_H4'>RACK H - Peldaño 4</option>
                                
                                        <option value='RACK_I1'>RACK I - Peldaño 1</option>
                                        <option value='RACK_I2'>RACK I - Peldaño 2</option>
                                        <option value='RACK_I3'>RACK I - Peldaño 3</option>
                                        <option value='RACK_I4'>RACK I - Peldaño 4</option>
                                
                                        <option value='RACK_J1'>RACK J - Peldaño 1</option>
                                        <option value='RACK_J2'>RACK J - Peldaño 2</option>
                                        <option value='RACK_J3'>RACK J - Peldaño 3</option>
                                        <option value='RACK_J4'>RACK J - Peldaño 4</option>
                                
                                        <option value='RACK_K1'>RACK K - Peldaño 1</option>
                                        <option value='RACK_K2'>RACK K - Peldaño 2</option>
                                        <option value='RACK_K3'>RACK K - Peldaño 3</option>
                                        <option value='RACK_K4'>RACK K - Peldaño 4</option>
                                
                                        <option value='RACK_L1'>RACK L - Peldaño 1</option>
                                        <option value='RACK_L2'>RACK L - Peldaño 2</option>
                                        <option value='RACK_L3'>RACK L - Peldaño 3</option>
                                        <option value='RACK_L4'>RACK L - Peldaño 4</option>
                                
                                        <option value='RACK_M1'>RACK M - Peldaño 1</option>
                                        <option value='RACK_M2'>RACK M - Peldaño 2</option>
                                        <option value='RACK_M3'>RACK M - Peldaño 3</option>
                                        <option value='RACK_M4'>RACK M - Peldaño 4</option>
                                        
                                        <option value='RACK_N1'>RACK N - Peldaño 1</option>
                                        <option value='RACK_N2'>RACK N - Peldaño 2</option>
                                        <option value='RACK_N3'>RACK N - Peldaño 3</option>
                                        <option value='RACK_N4'>RACK N - Peldaño 4</option>
                                
                                        <option value='RACK_O1'>RACK O - Peldaño 1</option>
                                        <option value='RACK_O2'>RACK O - Peldaño 2</option>
                                        <option value='RACK_O3'>RACK O - Peldaño 3</option>
                                        <option value='RACK_O4'>RACK O - Peldaño 4</option>
                                
                                        <option value='RACK_P1'>RACK P - Peldaño 1</option>
                                        <option value='RACK_P2'>RACK P - Peldaño 2</option>
                                        <option value='RACK_P3'>RACK P - Peldaño 3</option>
                                        <option value='RACK_P4'>RACK P - Peldaño 4</option>
                                
                                        <option value='RACK_Q1'>RACK Q - Peldaño 1</option>
                                        <option value='RACK_Q2'>RACK Q - Peldaño 2</option>
                                        <option value='RACK_Q3'>RACK Q - Peldaño 3</option>
                                        <option value='RACK_Q4'>RACK Q - Peldaño 4</option>
                                
                                        <option value='RACK_R1'>RACK R - Peldaño 1</option>
                                        <option value='RACK_R2'>RACK R - Peldaño 2</option>
                                        <option value='RACK_R3'>RACK R - Peldaño 3</option>
                                        <option value='RACK_R4'>RACK R - Peldaño 4</option>
                                
                                        <option value='RACK_S1'>RACK S - Peldaño 1</option>
                                        <option value='RACK_S2'>RACK S - Peldaño 2</option>
                                        <option value='RACK_S3'>RACK S - Peldaño 3</option>
                                        <option value='RACK_S4'>RACK S - Peldaño 4</option>
                                
                                        <option value='RACK_T1'>RACK T - Peldaño 1</option>
                                        <option value='RACK_T2'>RACK T - Peldaño 2</option>
                                        <option value='RACK_T3'>RACK T - Peldaño 3</option>
                                        <option value='RACK_T4'>RACK T - Peldaño 4</option>
                                
                                        <option value='RACK_U1'>RACK U - Peldaño 1</option>
                                        <option value='RACK_U2'>RACK U - Peldaño 2</option>
                                        <option value='RACK_U3'>RACK U - Peldaño 3</option>
                                        <option value='RACK_U4'>RACK U - Peldaño 4</option>
                                
                                        <option value='RACK_V1'>RACK V - Peldaño 1</option>
                                        <option value='RACK_V2'>RACK V - Peldaño 2</option>
                                        <option value='RACK_V3'>RACK V - Peldaño 3</option>
                                        <option value='RACK_V4'>RACK V - Peldaño 4</option>
                                
                                        <option value='RACK_W1'>RACK W - Peldaño 1</option>
                                        <option value='RACK_W2'>RACK W - Peldaño 2</option>
                                        <option value='RACK_W3'>RACK W - Peldaño 3</option>
                                        <option value='RACK_W4'>RACK W - Peldaño 4</option>
                                
                                        <option value='RACK_X1'>RACK X - Peldaño 1</option>
                                        <option value='RACK_X2'>RACK X - Peldaño 2</option>
                                        <option value='RACK_X3'>RACK X - Peldaño 3</option>
                                        <option value='RACK_X4'>RACK X - Peldaño 4</option>
                                
                                        <option value='RACK_Y1'>RACK Y - Peldaño 1</option>
                                        <option value='RACK_Y2'>RACK Y - Peldaño 2</option>
                                        <option value='RACK_Y3'>RACK Y - Peldaño 3</option>
                                        <option value='RACK_Y4'>RACK Y - Peldaño 4</option>
                                
                                        <option value='RACK_Z1'>RACK Z - Peldaño 1</option>
                                        <option value='RACK_Z2'>RACK Z - Peldaño 2</option>
                                        <option value='RACK_Z3'>RACK Z - Peldaño 3</option>
                                        <option value='RACK_Z4'>RACK Z - Peldaño 4</option>
                                    </optgroup-->

