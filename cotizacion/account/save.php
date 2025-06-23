<?php
    
    $username= $_POST['username'];
    $password= $_POST['password'];
    $tipo= $_POST['tipo'];
    $planta= $_POST['planta'];
    $nombre= $_POST['nombre'];
    $passwordhash=password_hash($password, PASSWORD_DEFAULT);

    $conexion = mysqli_connect("svgt332.serverneubox.com.mx","relianc1_vega",".KubRL0V#Nj%","relianc1_inventario");
    if (!$conexion) {
        echo "Error: No se pudo conectar a MySQL. Error " . mysqli_connect_errno() . " : ". mysqli_connect_error() . PHP_EOL;
        die;
    }else{
        //$sql="INSERT INTO users (username, password) VALUES (?, ?)";
        $consulta = "INSERT INTO usuarios (usuario, password, tipo, planta, nombre) VALUES('$username', '$passwordhash', '$tipo', '$planta', '$nombre')";
        
        $resultado = mysqli_query($conexion,$consulta);
        //print_r ($resultado);
        if($resultado){
            echo "datos guardados con exito";
        }else{
            echo "error al registrar datos";
        }
        mysqli_close($conexion);
    }
?>