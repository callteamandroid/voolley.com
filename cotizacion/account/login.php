<?php 
// Evitar la ejecución múltiple de session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../headerlogin.php'; 
include '../frameworkng/commonsub.php'; 
?>

<?php
// Verifica si el usuario ya está logueado y lo redirige
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../index.php");
    exit;
}

// Conexión a la base de datos
//require_once "../frameworkng/db/config.php"; 

// Definir las variables y inicializarlas con valores vacíos
$username = $password = "";
$username_err = $password_err = "";

// Procesar los datos del formulario cuando se envía
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Verificar si el campo de usuario está vacío
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese su usuario.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Verificar si el campo de contraseña está vacío
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese su contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validar las credenciales
    if(empty($username_err) && empty($password_err)){
        // Preparar la consulta para seleccionar el usuario
        $sql = "SELECT id, usuario, password, planta FROM usuarios WHERE usuario = ?";

        if($stmt = mysqli_prepare($conexion, $sql)){
            // Vincular las variables a la consulta preparada
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Establecer los parámetros
            $param_username = $username;

            // Intentar ejecutar la consulta
            if(mysqli_stmt_execute($stmt)){
                // Almacenar el resultado
                mysqli_stmt_store_result($stmt);

                // Verificar si el usuario existe, si es así, verificar la contraseña
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Vincular las variables de resultado
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $planta);
                    if(mysqli_stmt_fetch($stmt)){
                        // Verificar si la contraseña es correcta
                        if(password_verify($password, $hashed_password)){
                            // La contraseña es correcta, iniciar una nueva sesión
                            session_start();
                            
                            // Almacenar datos en las variables de sesión
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["planta"] = $planta; 
                            
                            // Redirigir al usuario a la página de inicio
                            header("location: ../index.php");
                        } else{
                            // Contraseña incorrecta
                            $password_err = "La contraseña ingresada no es válida.";
                        }
                    }
                } else{
                    // El usuario no existe
                    $username_err = "El usuario no existe.";
                }
            } else{
                echo "Algo salió mal, por favor intenta nuevamente.";
            }
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
?>  

<main class="main-content mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">Iniciar Sesión</h4>
                                <p class="mb-0">Ingrese su usuario y contraseña para iniciar sesión.</p>
                            </div>
                            <div class="card-body">
                                <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="mb-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                        <input type="email" name="username" class="form-control form-control-lg" placeholder="Usuario (Correo electrónico)" value="<?php echo $username; ?>" aria-label="Email">
                                        <span class="help-block"><?php echo $username_err; ?></span>
                                    </div>
                                    <div class="mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Contraseña" aria-label="Password">
                                        <span class="help-block"><?php echo $password_err; ?></span>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Recordar</label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Iniciar Sesión</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <!-- Puedes agregar un enlace para registro aquí si lo deseas -->
                            </div>
                        </div>
                    </div>
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://img.freepik.com/fotos-premium/lugar-construccion-grua-edificio_1290089-7505.jpg?w=740'); background-size: cover;">
                            <span class="mask bg-gradient-primary opacity-6"></span>
                            <h4 class="mt-5 text-white font-weight-bolder position-relative">Voolley</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include '../scriptslogin.php'; ?>
