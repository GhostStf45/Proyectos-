<?php

    if(isset($_POST)){
        //CONEXION
        require_once './assets/includes/conexion.php';
        //ASIGNACION DE VALORES POR VALIDACION TERNARIA
        $titulo_entrada = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
        $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
        
        $categoria = isset($_POST['categoria']) ? (int) $_POST['categoria'] : false;
        
        $usuario =  $_SESSION['usuario']['id_usuario'];
        
        //Validacion
        //ARRAY DE ERRORES
        $errores = array();
        
        if(empty($titulo_entrada)){
            $errores['error_titulo'] = "El titulo no es valido";
        }
        
        if(empty(trim($descripcion)) || count($descripcion)==0){
            $errores['error_descripcion'] = "La descripcion no es valida";
        }
        if(empty($categoria) && !is_numeric($categoria)){
            $errores['error_categoria'] = "La categoria no es valida";
        }
        if(count($errores)==0){
            //EDITAR LAS ENTRADAS POR METODO GET
            if(isset($_GET['editar'])){
                $id_entrada = $_GET['editar'];
                $id_usuario = $_SESSION['usuario']['id_usuario'];
                $sql = "UPDATE entrada SET titulo= '$titulo_entrada', descripcion= '$descripcion', id_categoria= $categoria WHERE id_entrada = $id_entrada AND id_usuario = $id_usuario; ";
            }else{
                //INSERTAR ENTRADAS
                $sql = "INSERT INTO entrada VALUES(NULL, $categoria, $usuario, '$titulo_entrada', '$descripcion', CURDATE());";
            }
            //CONSULTA SQL
            $guardar_entrada = mysqli_query($db, $sql);
            header("Location: index.php");
            
        }else{
            //RECOPILACION DE ERRORES
            $_SESSION['errores_entrada'] = $errores;
            if(isset($_GET['editar'])){
                header("Location: editar-entrada.php?id= {$_GET['editar']}");
                
            }else{
               header("Location: crear-entrada.php");

            }

        }
        

        
    }

?>