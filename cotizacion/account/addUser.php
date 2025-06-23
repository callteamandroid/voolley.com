<?php include '../headerdashsub.php'; ?>
<?php
  require '../account/auth.php';
  date_default_timezone_set('America/Monterrey');

  $id_ =  strtolower(uniqid());
  $fInicio=date("Y-m-d H:i:s"); 
  
  /*$status= "Pendiente";
    $usr="test@gruposerver.com";
    $auditor="sin auditar";
    $fInicio=date("Y-m-d H:i:s"); 
  */
  // Include config file
  /*
    require ("./conexion.php");
    
    $sql= $conexion->query("SELECT * FROM users");

    while($resultado=$sql->fetch_assoc()){}
  */
  
?>

<script>
	function selectBomba(sel) {
      if (user=="admin"){
           
      }
      else if (user=="auditor"){

      }
      else{

      }
}
</script>
<?php
//session_start();
$usr = $_SESSION['username'];
?>

<div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
      <img src="../img/server.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold"></span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav" style="position: fixed;">
      <?php
                    // Include config file
                    require ("../conexion.php");                    
                    $sql= $conexion->query("SELECT * FROM users WHERE username= '".$_SESSION['username']."'");
                    while($resultado=$sql->fetch_assoc()){

                   
                    
        if($resultado['tipo']=='Admin'){
          echo '<li class="nav-item">
                  <a class="nav-link" href="../index.php">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fa fa-house-user text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                  </a>
                </li>
                <li id="admin1" class="nav-item">
                  <a class="nav-link " href="../auditoria/index.php">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fa fa-clipboard-check text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Auditoria</span>
                  </a>
                </li>
                <li id="admin1" class="nav-item">
                  <a class="nav-link" href="../activos/index.php">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fa fa-clipboard-check text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Activos</span>
                  </a>
                </li>
                <li id="admin1" class="nav-item">
                  <a class="nav-link" href="../activos/asig.php">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fa fa-users-viewfinder text-primary text-sm opacity-10" ></i>
                    </div>
                    <span class="nav-link-text ms-1">Asingación</span>
                  </a>
                </li>
                <li id="admin2" class="nav-item">
                  <a class="nav-link " href="../empleados/index.php">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fa fa-users text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Empleados</span>
                  </a>
                </li>
                <li id="admin3" class="nav-item">
                  <a class="nav-link " href="../proveedores/index.php">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fa fa-gas-pump text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Proveedores</span>
                  </a>
                </li>        
                <li id="admin6" class="nav-item">
                  <a class="nav-link active" href="../account/index.php">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user text-warning" style=" top:1px; font-size: 15px !important;"></i>
                    </div>
                    <span class="nav-link-text ms-1">Usuarios</span>
                  </a>
                </li>
                <br><br>
                <li id="admin5" class="nav-item">
                  <a class="nav-link" href="../config/index.php">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-industry text-dark text-sm" style=" top:1px; font-size: 15px !important;"></i>
                    </div>
                    <span class="nav-link-text ms-1">Empresas</span>
                  </a>
                </li>';
            }else
            if($resultado['tipo']=='Activos'){
              echo '<li class="nav-item">
                      <a class="nav-link" href="../index.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="fa fa-house-user text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                      </a>
                    </li>
                    <li id="admin1" class="nav-item">
                      <a class="nav-link" href="../activos/index.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="fa fa-clipboard-check text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Activos</span>
                      </a>
                    </li>
                    <li id="admin1" class="nav-item">
                      <a class="nav-link" href="../activos/asig.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="fa fa-users-viewfinder text-primary text-sm opacity-10" ></i>
                        </div>
                        <span class="nav-link-text ms-1">Asingación</span>
                      </a>
                    </li>
                    <li id="admin2" class="nav-item">
                      <a class="nav-link " href="../empleados/index.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="fa fa-users text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Empleados</span>
                      </a>
                    </li>
                    <li id="admin3" class="nav-item">
                      <a class="nav-link " href="../proveedores/index.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="fa fa-gas-pump text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Proveedores</span>
                      </a>
                    </li> 
                    <li id="admin5" class="nav-item">
                      <a class="nav-link" href="../config/index.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-industry text-dark text-sm" style=" top:1px; font-size: 15px !important;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Empresas</span>
                      </a>
                    </li>';
            }
            else
            if($resultado['tipo']=='Auditor'){
              echo '<li class="nav-item">
                      <a class="nav-link" href="../index.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="fa fa-house-user text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                      </a>
                    </li>
                    <li id="admin1" class="nav-item">
                      <a class="nav-link " href="../auditoria/index.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="fa fa-clipboard-check text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Auditoria</span>
                      </a>
                    </li>
                    ';
            }else
            if($resultado['tipo']=='Guess'){
              echo '<li class="nav-item">
                      <a class="nav-link" href="../index.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="fa fa-house-user text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                      </a>
                    </li>';
            }
          }
        ?>
        <!--li class="nav-item">
          <a class="nav-link " href="./pages/virtual-reality.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Virtual Reality</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/rtl.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">RTL</span>
          </a>
        </li-->
        <!--li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/profile.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/sign-in.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/sign-up.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-collection text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li-->
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div  class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Registrar Bomba</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="../account/logout.php" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span id="usr"class="d-sm-inline d-none"><?php echo $usr;?>
                <?php
                    // Include config file
                    require ("../conexion.php");                    
                    $sql= $conexion->query("SELECT * FROM users WHERE username= '".$_SESSION['username']."'");
                    while($resultado=$sql->fetch_assoc()){
                    ?>
                    <p id="adm" onload="user()" style="display:none;" value="<?php echo $resultado['tipo']; ?>"><?php echo $resultado['tipo']; ?></p>
                </span>
                <?php 
                  }
                ?>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!--End Navbar -->
    <!--CONTAINER USER=ADMIN-->
   
 
  </div>
    <!--CONTAINER USER=GUESS-->
    <div id="admin" style="" class="container-fluid py-4">
      <!--IMAGENES BOMBA 1-->
      <!--div id="b1" class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">INICIO BOMBA 1</p>
                    <img id="Bom1I" style="width:200px;" src=".img/imgserv/bom1I<?php echo $id_; ?>.png">  
                    
                   
                  </div>
                </div>
                <div class="col-4 text-end">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">INICIO CAMION 1</p>
                    <img id="Cam1I" style="width:200px;" src=".img/imgserv/cam1I<?php echo $id_; ?>.png">                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">FIN BOMBA 1</p>
                    <img id="Bom1F" style="width:200px;" src=".img/imgserv/bom1F<?php echo $id_; ?>.png">                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">FIN CAMION 1</p>
                    <img id="Cam1F" style="width:200px;" src=".img/imgserv/Cam1F<?php echo $id_; ?>.png">                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div-->
      <!--IMAGENES BOMBA 2-->
      <!--div id="b2" style="display:none;" class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">INICIO BOMBA 2</p>
                    <img id="Bom2I" style="width:200px;" src=".img/imgserv/Bom2I<?php echo $id_; ?>.png">                    
                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">INICIO CAMION 2</p>
                    <img id="Cam2I" style="width:200px;" src=".img/imgserv/cam2I<?php echo $id_; ?>.png">                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">FIN BOMBA 1</p>
                    <img id="Bom2F" style="width:200px;" src=".img/imgserv/bom2F<?php echo $id_; ?>.png">                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">FIN CAMION</p>
                    <img id="Cam2F" style="width:200px;" src=".img/imgserv/cam2F<?php echo $id_; ?>.png">                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div-->
      <!--FORMULARIO DE CAPTURA-->
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card ">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-2">Capture los datos solicitados</h6>
              </div>
              
              <form action="">
                <div class="mb-3">
                  <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre completo"  >
                </div>
                <div class="mb-3 ">
                  <input type="email" id="username" name="username" class="form-control" placeholder="Correo" >
                  <span class="help-block"></span>
                </div>  
                <div class="mb-3">
                  <span>Seleccione tipo de usuario</span>
                    <select id="tipo" name="tipo" class="form-select form-select-lg mb-3">
                      <?php   
                        require '../conexion.php';
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
                <div class="mb-3 ">                
                  <span>Seleccione planta</span>
                  <select id="ciudad" name="ciudad" class="form-select form-select-lg mb-3" >
                    <?php   
                      require '../conexion.php';
                      $sql= $conexion->query("SELECT * FROM plantas order by id");
                      //$sql = "SELECT * FROM plantas order by id";
                      //$result = $conexion->query($sql);
                      while($resultado=$sql->fetch_assoc()){
                        $id = $resultado['id'];
                        $ciudad = $resultado['UBICACION'];                  
                        
                        echo "<option value='$ciudad'>$ciudad</option>";
                      }
                    ?>
                  </select-->                 
                </div>
                
                <div class="mb-3">
                  <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña"  >
                  <span class="help-block"></span>
                </div>
                <div class="mb-3 ">
                  <input type="password" id="confpassword" name="confirm_password" class="form-control" placeholder="Confirmar Contraseña" >
                  <span class="help-block"></span>
                </div>
                
                <div class="text-center">
                  <button  id="guardar" class="btn bg-gradient-dark w-100 my-4 mb-2">
                    Registrar
                  </button>
                  <span id="a"></span>
                </div>
                <p class="text-sm mt-3 mb-0">ya tienes alguna cuenta? 
                    <a href="./login.php" class="text-dark font-weight-bolder">
                        Iniciar Sesion
                    </a>
                </p>
              </form>
              <P id="a"></P>
              <P id="b"></P>
              <P id="c"></P>
              <P id="d"></P>
            </div>            
          </div>
        </div>
      </div>
      
    </div>
    
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Configuración </h5>
          <p>selecciona tu configuración.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <!--div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a-->
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Tipo de barras</h6>
          <p class="text-sm">Escoge el tipo de barra que mas te guste.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">Blanco</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Oscuro</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Barra de navegación fija</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Blanco / Oscuro</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <!--a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div-->
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="http://127.0.0.1/auditoriacombus/assets/js/core/popper.min.js"></script>
  <script src="http://127.0.0.1/auditoriacombus/assets/js/core/bootstrap.min.js"></script>
  <script src="http://127.0.0.1/auditoriacombus/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="http://127.0.0.1/auditoriacombus/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="http://127.0.0.1/auditoriacombus/assets/js/plugins/chartjs.min.js"></script>
 
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script>
      var adm = document.getElementById('adm').innerHTML;
      console.log(adm);

      Admin = document.getElementById('admin');
      Admin1 = document.getElementById('admin1');
      Admin2 = document.getElementById('admin2');
      Guess = document.getElementById("guess");
      //Auditor = document.getElementById("auditor");
      //echo=document.getElementById("admin").value;
      if (adm=='Admin'){      
        Admin.style.display = "";        
        Guess.style.display = "none";   
        //Auditor.style.display = "none";   
      }else{
        Admin.style.display = "none";
        Admin1.style.display = "none";
        Admin2.style.display = "none";
        Guess.style.display = "";
        //Auditor.style.display = "none";
      }
 /*else if(document.getElementById("adm").value=='guess'){
        Admin.style.display = "none";
        //Auditor.style.display = "";
        Guess.style.display = "none";
      }*/
    function selectBomba(sel) {
      if (sel.value=="B1"){
          divC = document.getElementById("b1");
          divC.style.display = "";

          divT = document.getElementById("b2");
          divT.style.display = "none";

      }else{

          divC = document.getElementById("b1");
          divC.style.display="none";

          divT = document.getElementById("b2");
          divT.style.display = "";
      }
}

</script>
<script>
     nombre;
       username;
       password;
       confpassword;
       tipo;
       ciudad
        
       $('#guardar').click(function() {      
    var nombre = document.getElementById('nombre').value;
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var confpassword = document.getElementById('confpassword').value;
    var tipo = document.getElementById('tipo').value;
    var ciudad = document.getElementById('ciudad').value;
    //console.log(username, password, tipo, ciudad, nombre);

    var capturar = "username=" + username + "&password=" + password + "&tipo=" + tipo + "&ciudad=" + ciudad + "&nombre=" + nombre;

    //event.preventDefault();
      
    $.ajax({
        url: './save.php',
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  <?php include '../scriptsdash.php'; ?>