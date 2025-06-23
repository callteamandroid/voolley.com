<?php include '../headerdashsub.php'; ?>
<?php
require '../account/auth.php';
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
          <a class="nav-link " href="../pages/virtual-reality.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Virtual Reality</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/rtl.html">
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
          <a class="nav-link " href="../pages/profile.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/sign-in.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/sign-up.html">
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
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Gramol</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Registro de Usuarios</h6>
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
                <span id="usr" class="d-sm-inline d-none"><?php echo $usr;?>
                <?php
                    // Include config file
                    require ("../conexion.php");                    
                    $sql= $conexion->query("SELECT * FROM users WHERE username= '".$_SESSION['username']."'");
                    while($resultado=$sql->fetch_assoc()){
                    ?>
                   
                </span>
                <p id="adm" onload="user()" style="display:none;" value="<?php echo $resultado['tipo']; ?>"><?php echo $resultado['tipo']; ?></p>
                <?php 
                  }
                ?>
                <!--span class="d-sm-inline d-none">Cerrar Sesion</span-->
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
                        <img src="./assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
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
                        <img src="./assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
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
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Registro de Usuarios <a class="btn btn-outline-primary" href="./addUser.php"> <i class="fa fa-circle-plus"></i> Nuevo</a></h6>
              
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table id="myTable" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre de Usuario</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tipo</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Planta</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Funciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    // Include config file
                    require ("../conexion.php");
                    
                    $sql= $conexion->query("SELECT * FROM users ORDER BY id");

                    while($resultado=$sql->fetch_assoc()){

                    
                    ?>
                    <tr id="<?php echo $resultado['id']; ?>">
                        <td> 
                            <h6 class="text-xs font-weight-bold mb-0"><?php echo $resultado['username']?></h6>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0"><?php echo $resultado['tipo']?></p>
                            <!--p class="text-xs text-secondary mb-0"></p-->
                        </td>                        
                        <td> 
                            <p class="text-xs font-weight-bold mb-0"><?php echo $resultado['ciudad']?></p>                          
                        </td>
                        
                        <td class="align-middle text-center text-sm">                          
                            <form action="">
                              <button id="update1" onclick="update('<?php echo $resultado['id']; ?>')" class=" mt-2 align-middle btn btn-outline-info">
                              <i class="fa fa-pen"></i> Editar
                              </button>                              
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>  
                  </tbody>
                </table>
              </div>
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
          <h5 class="mt-3 mb-0">Argon Configurator</h5>
          <p>See our dashboard options.</p>
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
        <div>
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
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
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
        </div>
      </div>
    </div>
  </div>
<script>
   var adm = document.getElementById('adm').innerHTML;
      console.log(adm);

      Admin = document.getElementById('admin');
      Guess = document.getElementById("guess");
      Admin2 = document.getElementById('admin2');
      //Auditor = document.getElementById("auditor");
      //echo=document.getElementById("admin").value;
      if (adm=='Admin'){      
        Admin.style.display = "";        
        Guess.style.display = "none";   
        //Auditor.style.display = "none";   
      }else{
        Admin.style.display = "none";
        Admin2.style.display = "none";
        Guess.style.display = "";
        //Auditor.style.display = "none";
      }

var alertPlaceholder = document.getElementById('liveAlertPlaceholder')
var alertTrigger = document.getElementById('liveAlertBtn')

function alert(message, type) {
  var wrapper = document.createElement('div')
  wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

  alertPlaceholder.append(wrapper)
}

if (alertTrigger) {
  alertTrigger.addEventListener('click', function () {
    alert('Genial, activaste este mensaje de alerta.', 'success')
  })
}


function update(id_){
  var id=id_;
  var update = "id="+id;
  //event.preventDefault();
  $.ajax({
      url: './update.php',
      type: 'POST',
      data: update,
    })
    .done(function(res){
      $('#myTable').html();
    })
    .fail(function(){
      console.log("error");
    })
    .always(function(){
      console.log("completo");
    })
}
</script>
<script>
  var id=document.getElementById('id1').innerHTML;
  //var id_=document.getElementById('update').value;
  var id_;
  //console.log(id_);
    //fFin= document.getElementById('adm').value;
    //var auditor="sin auditar";
    //var status="pendiente";
  //var fFinc;
  /*
  $('#update1').on('click', '#myTable tr', function() {
    var id_ = $(this).attr('id');
    console.log(id_);
    if(id<>""){
      console.log("valor" id_);
    }else{
      console.log("valor de variable " id_);
    }
    
  });
  */
  /*
  $('#update').click(function(){
    id_= document.getElementById(this).val;
    //id_= $(this).attr('idtabla');
    var update = "id="+id_;
    event.preventDefault();
  //  alert(id_);

    $.ajax({
      url: './update.php',
      type: 'POST',
      data: update,
    })
    .done(function(res){
      $('#i').html(id);
    })
    .fail(function(){
      console.log("error");
    })
    .always(function(){
      console.log("completo");
    })
  });
  */
/*
  var id=document.getElementById('id1').innerHTML;
  //var auditor=document.getElementById('usr').innerHTML;
  //console.log(id, auditor);
  $('#update1').click(function(){
    var update = "id="+id;
    event.preventDefault();
    console.log(id);
   
    $.ajax({
      url: './update.php',
      type: 'POST',
      data: update,
    })
    .done(function(res){
      $('#i').html(res);
    })
    .fail(function(){
      console.log("error");
    })
    .always(function(){
      console.log("completo");
    })
  });
  */
</script>
<?php include '../scriptsdash.php'; ?>