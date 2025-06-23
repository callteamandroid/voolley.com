<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'svgt332.serverneubox.com.mx');
define('DB_USERNAME', 'relianc1_vega');
define('DB_PASSWORD', '.KubRL0V#Nj%');
define('DB_NAME', 'relianc1_inventario');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>