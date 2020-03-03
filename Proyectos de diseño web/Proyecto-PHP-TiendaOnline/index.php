<?php 
    session_start();
    require_once 'autoload.php';
    require_once './config/db.php';
    require_once './config/parameters.php';
    require_once './helpers/utils.php';
    require_once './views/layout/header.php';
    require_once './views/layout/sidebar.php';
    
   
    //----------------CONTROLADOR FRONTAL--------------------------
    
    
    function showServer_error(){
       $error = new errorController();
       $error->index();
    }
    if(isset($_GET['controller']))
    {
        $nombre_controlador = $_GET['controller'].'Controller';
    }elseif(!isset($_GET['controller']) && !isset($_GET['action']) ){
        $nombre_controlador = controller_default;
    }
    else{
       showServer_error();
       exit();
    }
    //verificar controlador
    if(class_exists($nombre_controlador))
    {
        $controlador = new $nombre_controlador();
        
        //verficar vistas
        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
            $action = $_GET['action'];

            $controlador->$action();

        }elseif(!isset($_GET['controller']) && !isset($_GET['action']) ){
            $default = action_default;
            
            $controlador->$default();
        }
        else{
            showServer_error();
        } 
    }
    else
    {
        showServer_error();
    }
    require_once './views/layout/footer.php';

 ?>