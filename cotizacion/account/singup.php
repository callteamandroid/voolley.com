<?php include '../headerlogin.php'; ?>
  <main class="">
    <div class="page-header align-items-start min-vh-100 pt-12 pb-12 m-5 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <!--h1 class="text-white mb-2 mt-5">Welcome!</h1>
            <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p-->
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div style="margin-top: -40rem !important;" class="row mt-lg-n10 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Registrar</h5>
            </div>
            
            <div class="card-body">
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-4 mx-auto text-center">
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Company
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            About Us
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Team
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Products
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Blog
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Pricing
          </a>
        </div>
        <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-dribbble"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-twitter"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-instagram"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-pinterest"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-github"></span>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> Soft by Creative Tim.
          </p>
        </div>
      </div>
    </div>
  </footer-->
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
 
  <script>
     nombre;
       username;
       password;
       confpassword;
       tipo;
       ciudad
        
    $('#guardar').click(function(){      
       nombre = document.getElementById('nombre').value;
       username = document.getElementById('username').value;
       password = document.getElementById('password').value;
       confpassword = document.getElementById('confpassword').value;
       tipo = document.getElementById('tipo').value;
       ciudad = document.getElementById('ciudad').value;
      //console.log(username, password, tipo, ciudad, nombre);

      var capturar = "username="+username+ "&password="+password+ "&tipo="+tipo+ "&ciudad="+ciudad+ "&nombre="+nombre;
      //event.preventDefault();
      
        $.ajax({
        url: './save.php',
        type: 'POST',
        data: capturar,
        })
        .done(function(res){
          window.open('./account/index.php');
        })
        .fail(function(){
          console.log("error");
        })
        .always(function(){
          console.log("completo");
        })
    });
  </script>
<?php include '../scriptslogin.php'; ?>