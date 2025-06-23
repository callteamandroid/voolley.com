<?php
session_start();
$usr = $_SESSION['username'];
if($usr==''){
    header('Location: https://voolley.com/cotizacion/account/login.php');
}else{
    
    //header('Location: index.php'); 
}
?>