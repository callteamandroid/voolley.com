<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$servidor= "svgt332.serverneubox.com.mx";
$usuario= "relianc1_vega";
$password = ".KubRL0V#Nj%";
$db= "relianc1_volley";
 
$conexion =new mysqli($servidor, $usuario, $password, $db);

if(!$conexion){
    echo "fallo conexion a mysql";
}
else{
    //echo "conexion ok";
}
?>