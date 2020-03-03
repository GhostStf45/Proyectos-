<?php

    if(isset($_POST)){
        require_once './assets/includes/conexion.php';
        
        $nombre_categorias = $_POST['nombre_categoria'] ? mysqli_real_escape_string($db, $_POST['nombre_categoria']): false ;
        
        
        $errores = array();
        
        //Validar los datos antes de guardarlos en la base de datos
        
        //Validar campo nombre
        if( !empty(trim($nombre_categorias)) && !is_numeric($nombre_categorias) && !preg_match("/[0-9]+/", $nombre_categorias)){
            $nombre_categoria_validado = true;
        }else{
            $nombre_categoria_validado = false;
            $errores['nombre_categorias']="El nombre de la categoria no es valido";
        }
        if(count($errores)==0){
            $sql= "INSERT INTO categorias VALUES(NULL, '$nombre_categorias');";
            $guardar = mysqli_query($db, $sql);
        }
    }
    header("Location: index.php");
?>
