<?php

    //Conexion
    $servidor = 'localhost';
    $usuario = 'root';
    $password = '';
    $base_de_datos = 'blog_master';
    $db = mysqli_connect($servidor, $usuario, $password, $base_de_datos);
    mysqli_query($db, "SET NAMES 'utf8'");
    
    
    //Iniciar sesion
    if(!isset($_SESSION)){
       session_start();
   }
?>
