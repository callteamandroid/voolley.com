    <div class="container my-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar por nombre">
                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <!--MODAL NUEVO PRODUCTO></--MODAL-->
             <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingresa el nombre completo del usuario">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" placeholder="Ingresa el usuario">
                        </div>
                        
                        <div class="mb-3">
                            <label for="permissionGroup" class="form-label">Grupo de permisos</label>
                            <select class="form-select" id="tipo">
                                <?php   
                                    require './conexion.php';
                                    $sql= $conexion->query("SELECT * FROM tipo order by id");
                                    //$sql = "SELECT * FROM plantas order by id";
                                    //$result = $conexion->query($sql);
                                    while($resultado=$sql->fetch_assoc()){
                                      $id = $resultado['id'];
                                      $tipo = $resultado['tipo'];                  
                                      
                                      echo "<option value='$tipo'>$tipo</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Planta</label>
                            <select class="form-select" id="planta">
                                <?php   
                                    require './conexion.php';
                                    $sql= $conexion->query("SELECT * FROM plantas order by id");
                                    //$sql = "SELECT * FROM plantas order by id";
                                    //$result = $conexion->query($sql);
                                    while($resultado=$sql->fetch_assoc()){
                                      $tipo = $resultado['UBICACION'];  
                                      echo "<option value='$tipo'>$tipo</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" placeholder="******">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Repite contraseña</label>
                            <input type="password" class="form-control" id="confpassword" placeholder="******">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="guardar" type="button" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
    </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-outline-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#userModal">+ Nuevo</button>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Mostrar
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Acción</a></li>
                        <li><a class="dropdown-item" href="#">Otra acción</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Listado de Usuarios</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>usuario</th>
                            <th>Grupo</th>
                            <th>Agregado</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require "./frameworkng/db/conexionmysql.php";
                            // Obtener el término de búsqueda
                            $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
            
                            // Asegúrate de que el término de búsqueda esté sanitizado para evitar inyección SQL
                            $searchTerm = mysqli_real_escape_string($conexion, $searchTerm);
            
                            // Modificar la consulta para buscar por nombre, correo, dirección o RFC sin distinguir entre mayúsculas y minúsculas
                            $sql = $conexion->query("SELECT * FROM usuarios WHERE 
                                                      LOWER(id) LIKE LOWER('%$searchTerm%') OR
                                                      LOWER(nombre) LIKE LOWER('%$searchTerm%') OR 
                                                      LOWER(usuario) LIKE LOWER('%$searchTerm%')
                                                      ORDER BY nombre ASC;");
            
                            // Verificar si la consulta fue exitosa
                            if (!$sql) {
                                die("Error en la consulta: " . $conexion->error);
                            }
            
                            // Mostrar los resultados
                            while ($resultado = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($resultado['id']); ?></td>
                            <td><?php echo htmlspecialchars($resultado['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($resultado['usuario']); ?></td>
                            <td><?php echo htmlspecialchars($resultado['tipo']); ?></td>
                            <td><?php echo htmlspecialchars($resultado['fecha_registro']); ?></td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Acción</a></li>
                                        <li><a class="dropdown-item" href="#">Otra acción</a></li>
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
                    <span>Mostrando 1 a 1 de 1 registros</span>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Anterior</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Siguiente</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <script>
     $('#guardar').click(function() {      
        var nombre = document.getElementById('nombre').value;
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var confpassword = document.getElementById('confpassword').value;
        var tipo = document.getElementById('tipo').value;
        var planta = document.getElementById('planta').value;
        console.log(username, password, tipo, planta, nombre);
    
        var capturar = "username=" + username + "&password=" + password + "&tipo=" + tipo + "&planta=" + planta + "&nombre=" + nombre;
    
        //event.preventDefault();
          
        $.ajax({
            url: './account/save.php',
            type: 'POST',
            data: capturar,
        })
        .done(function(res) {
            alert('Datos Guardados'); // Eliminado el paréntesis extra
            //window.open('./account/index.php');
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("completo");
        });
    });
</script>