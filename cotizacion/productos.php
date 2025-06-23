<?php
include './frameworkng/common.php'; 
$inputGenerator = new InputGenerator();
$name =  $inputGenerator->textInput('name', '', '', ['class' => 'form-control',  'id'=>'name']);
$modelo =  $inputGenerator->textInput('modelo', '', '', ['class' => 'form-control',  'id'=>'modelo']);
$parte =  $inputGenerator->textInput('parte', '', '', ['class' => 'form-control',  'id'=>'parte']);
$codigo =  $inputGenerator->textInput('codigo', '', '', ['class' => 'form-control',  'id'=>'codigo']);
$descripcion =  $inputGenerator->textArea('descripcion', '', '', ['class' => 'form-control',  'id'=>'descripcion']);
$costo =  $inputGenerator->textInput('costo', '', '', ['class' => 'form-control',  'id'=>'costo']);
$precio =  $inputGenerator->textInput('precio', '', '', ['class' => 'form-control',  'id'=>'precio']);
$utilidad =  $inputGenerator->textInput('utilidad', '', '', ['class' => 'form-control',  'id'=>'utilidad']);
$stock =  $inputGenerator->textInput('stock', '', '', ['class' => 'form-control',  'id'=>'stock']);
$ubicacion=  $inputGenerator->textInput('ubicacion', '', '', ['class' => 'form-control',  'id'=>'ubicacion']);
$docsasig = $inputGenerator->cameraInput('docsasig', ['id' => 'docsasig', 'style'=>'display:none;'], ['application/pdf', 'image/jpeg', 'image/png']);


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
</style>
<body>
    
            
    <!--MODAL NUEVO PRODUCTO></--MODAL-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="" ><i class="fas fa-pencil-alt"></i>Agregar nuevo producto o servicio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="f1">
          <div class="modal-body">
            <div class="container mt-1">
                <div class="row">
                    <div class="col-md-2">
                        <img src="https://storage.googleapis.com/a1aa/image/fUS2Ky9qBFSvSSHwd7rxz17S7TYVNli7X9cy2nf2zZ26SP5TA.jpg" alt="Image of a cardboard box with shipping symbols and a barcode" class="img-fluid">
                    </div>
                    <div class="col-md-10">
                        <div class="card p-1">
                            <form id="formulario" method="POST">
    <div class="modal-body">
        <div class="container mt-1">
            <div class="row">
                <div class="col-md-4">
                    <h6>Detalles del producto</h6>
                    <label for="nombre" class="form-label">Nombre</label>
                    <?php echo $name; ?>
                </div>
                <div class="col-md-4 p-4">
                    <label for="familia" class="form-label">Familia</label>
                    <div class="input-group">
                        <select class="form-select" id="familia" name="familia">
                            <option selected>Selecciona familia</option>
                            <?php
                                require './frameworkng/db/conexionmysql.php';
                                $conexion->set_charset("utf8");
                                $sql = $conexion->query("SELECT * FROM familia ORDER BY id");
                                while ($resultado = $sql->fetch_assoc()) {
                                    $tipo = $resultado['nombre'];
                                    echo "<option value='$tipo'>$tipo</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 p-4">
                    <label for="codigo" class="form-label">Código</label>
                    <?php echo $codigo ?>
                </div>
                <div class="col-md-4">
                    <label for="modelo" class="form-label">Modelo</label>
                    <?php echo $modelo ?>
                </div>
                <div class="col-md-4">
                    <label for="parte" class="form-label">No parte</label>
                    <?php echo $parte ?>
                </div>
                <div class="col-md-4">
                    <label for="estado" class="form-label">Unidad de medida</label>
                    <div class="input-group">
                        <select class="form-select" id="unidad">
                            <option selected>Seleccione una unidad</option>
                            <option value="kg">Kilogramo (kg)</option>
                            <option value="lt">Litro (L)</option>
                            <option value="unidad">Unidad</option>
                            <option value="m3">Metro cúbico (m³)</option>
                            <option value="cm3">Centímetro cúbico (cm³)</option>
                            <option value="g">Gramo (g)</option>
                            <option value="ml">Mililitro (ml)</option>
                            <option value="m">Metro (m)</option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#proveedores">+ Nuevo</button>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <?php echo $descripcion; ?>
                </div>
                <div class="modal-footer">
                    <button id="cerrar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="Guardar" type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

                        </div>
                    </div>
                </div>
            </div>
          </div>
          
          </form>
        </div>
      </div>
    </div>
    <div class="row mb-3">
    <div class="col-md-3">
     <input class="form-control" placeholder="Buscar por nombre" type="text"/>
    </div>
    <div class="col-md-3">
        <div class="input-group">
             <select class="form-select">
                  <option selected="">
                       Selecciona Familia
                  </option>
                  <?php
                    // Asegurarse de que la conexión utiliza UTF-8
                    require './frameworkng/db/conexionmysql.php';
                    $conexion->set_charset('utf8'); // Establecer el conjunto de caracteres a UTF-8
                
                    $sql = $conexion->query("SELECT * FROM familia ORDER BY id");
                
                    while ($resultado = $sql->fetch_assoc()) {
                        $tipo = $resultado['nombre'];
                        // Utiliza htmlspecialchars para evitar problemas con caracteres especiales
                        echo "<option value='" . htmlspecialchars($tipo, ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($tipo, ENT_QUOTES, 'UTF-8') . "</option>";
                    }
                ?>

             </select>
        </div>
    </div>
    <div class="col-auto">
             <button class="btn btn-outline-secondary w-100 mt-0">
              <i class="fas fa-search">
              </i>
             </button>
        </div>
    <div class="col-auto">
     <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <i class="fas fa-plus">
      </i>
      Nuevo
     </button>
    </div>
    <div class="col-auto">
     <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fas fa-ellipsis-v">
      </i>
      Mostrar
     </button>
    </div>
   </div>

            <h4 class="mt-4">Listado de Productos o Servicios</h4>
            
            <table class="table table-bordered">
                <thead>
                 <tr>
                  <th>Modelo</th>
                  <th>No. Parte</th>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Precio</th>
                  <th>Familia</th>
                  
                  <th>Acciones</th>
                 </tr>
                </thead>
                <tbody>
                    <?php
                    require './frameworkng/db/conexionmysql.php';
                     $conexion->set_charset('utf8');
                // Obtener el término de búsqueda
                $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

                // Asegúrate de que el término de búsqueda esté sanitizado para evitar inyección SQL
                $searchTerm = mysqli_real_escape_string($conexion, $searchTerm);

                // Modificar la consulta para buscar por nombre, correo, dirección o RFC sin distinguir entre mayúsculas y minúsculas
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
       <?php echo $resultado['modelo'];?>
      </td>
      <td>
      <?php echo $resultado['noParte'];?>
      </td>
      <td>
       <?php echo $resultado['codigo'];?>
      </td>
      
      <td>
       <?php echo $resultado['nombre'];?>
      </td>
      <td>
       <?php echo $resultado['descripcion'];?>
      </td>
      
      <td>
      <?php echo "$" . number_format($resultado['precio'], 2, '.', ','); ?>
      </td>
      
      <td>
       <?php echo $resultado['familia'];?>
      </td>
      <td>
       <div class="dropdown">
        <button aria-expanded="false" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" id="dropdownMenuButton1" type="button">
         Acciones
        </button>
        <ul aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
         <li>
          <a class="dropdown-item" href="#">
           Editar
          </a>
         </li>
         <li>
          <a class="dropdown-item" href="#">
           Borrar
          </a>
         </li>
        </ul>
       </div>
      </td>
     </tr>
                    <?php
                        }
                    ?>
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
   /*** AJAX GUARDAR ***/
 $(document).ready(function() {
        $("#Guardar").click(function() {
            // Obtener los valores de los campos del formulario
            var nombre = $("#name").val();
            var familia = $("#familia").val();
            var codigo = $("#codigo").val();
            var modelo = $("#modelo").val();
            var parte = $("#parte").val();
            var unidad = $("#unidad").val();
            var descripcion = $("#descripcion").val();

            // Enviar los datos mediante Ajax
            $.ajax({
                url: './productos/savem.php', // archivo PHP que procesará los datos
                type: 'POST',
                data: {
                    nombre: nombre,
                    familia: familia,
                    codigo: codigo,
                    modelo: modelo,
                    parte: parte,
                    unidad: unidad,
                    descripcion: descripcion
                },
                success: function(response) {
                    // Acción si la solicitud es exitosa
                    alert("Producto guardado correctamente");
                    console.log(response); // Ver respuesta del servidor (si es necesario)
                   $('#f1').trigger('reset'); // Limpiar el formulario
                },
                error: function(xhr, status, error) {
                    // Acción si hay un error en la solicitud
                    alert("Hubo un error al guardar el producto.");
                    console.log(error);
                }
            });
        });
    });
    // Limpiar campos del modal al cerrarlo
$(document).ready(function () {
    $('#exampleModal').on('hidden.bs.modal', function () {
        // Limpiar campos del formulario
        $('#f1').trigger('reset');
        //console.log("listo");
    });
});
</script>

  