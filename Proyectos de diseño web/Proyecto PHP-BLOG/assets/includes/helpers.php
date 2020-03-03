
<?php

    function mostrar_error($errores, $campo){
        $alerta = "";
        if(isset($errores[$campo]) && !empty($campo)){
            $alerta= "<div class='alerta alerta error'>".$errores[$campo].'</div>';
        }
        return $alerta;
    }
    function borrar_errores(){
        $borrado = false;
        if(isset($_SESSION['errores'])){
            $_SESSION['errores'] = null;
            $borrado = true;
        }
        if(isset($_SESSION['errores_entrada'])){
            $_SESSION['errores_entrada'] = null;
            $borrado = true;
            
        }
        if(isset($_SESSION['completado'])){
            
            $_SESSION['completado'] = null;
            $borrado = true;
        
        }
        return $borrado;
    }
    
    function conseguir_categorias($conexion){
        $sql = "SELECT * FROM categorias ORDER BY id_categoria ASC;";
        $categorias = mysqli_query($conexion, $sql);
        $result = array();
        if($categorias && mysqli_num_rows($categorias) >= 1){
            $result = $categorias;
        }
        return $result;
    }
    function conseguir_categoria($conexion, $id){
        $sql = "SELECT * FROM categorias WHERE id_categoria = $id;";
        $categorias = mysqli_query($conexion, $sql);
        $result = array();
        if($categorias && mysqli_num_rows($categorias) >= 1){
            $result = mysqli_fetch_assoc($categorias);
        }
        return $result;
    }
    
    function conseguir_entrada($conexion, $id){
        $sql = "SELECT e.*, c.nombre_categoria AS 'Categoria', CONCAT(u.nombres, ' ', u.apellidos) AS usuario FROM entrada e INNER JOIN categorias c ON e.id_categoria = c.id_categoria INNER JOIN usuarios u ON e.id_usuario = u.id_usuario WHERE e.id_entrada = $id;";
        $entrada = mysqli_query($conexion, $sql);
        
        $resultado = array();
        if($entrada && mysqli_num_rows($entrada)>=1){
            $resultado = mysqli_fetch_assoc($entrada);
        }

        return $resultado;
        
    }
    
    function  conseguirEntradas($conexion, $limit = null, $categoria = null, $busqueda = null){
        $sql = "SELECT e.*, c.nombre_categoria AS 'Categoria' FROM entrada e INNER JOIN categorias c ON c.id_categoria = e.id_categoria ORDER BY e.id_categoria DESC;";
        
        if(!empty($categoria)){
             $sql = "SELECT e.*, c.nombre_categoria AS 'Categoria' FROM entrada e INNER JOIN categorias c ON c.id_categoria = e.id_categoria  WHERE e.id_categoria= $categoria ORDER BY e.id_categoria DESC;";
        }
        
        if(!empty($busqueda)){
             $sql = "SELECT e.*, c.nombre_categoria AS 'Categoria' FROM entrada e INNER JOIN categorias c ON c.id_categoria = e.id_categoria  WHERE e.titulo LIKE '%$busqueda%' ORDER BY e.id_categoria DESC;";
        }
        
        if($limit == true){
           $sql = "SELECT e.*, c.nombre_categoria AS 'Categoria' FROM entrada e INNER JOIN categorias c ON c.id_categoria = e.id_categoria ORDER BY e.id_categoria DESC LIMIT 4;";
        }
        
        
        $entradas = mysqli_query($conexion, $sql);
        $result = array();
        if($entradas && mysqli_num_rows($entradas)>=1){
            $result = $entradas;
        }
        return $result;
        
        
    }   

?>