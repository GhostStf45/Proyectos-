<?php
require_once 'models/producto.php';
    class carritoController{
        //Listar elementos
        public function index() {
            if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){
                $carrito = $_SESSION['carrito'];
            }else{
                $carrito = array();
            }
            
            require_once 'views/carrito/index.php';
        }
        public function add(){
            //conseguir id del producto
            if(isset($_GET['id'])){
                $producto_id = $_GET['id'];
            }else{
                header("Location: ".base_url);
            }
            

            if(isset($_SESSION['carrito'])){
                //aumentar unidades al carrito
                $counter = 0;
                foreach ($_SESSION['carrito'] as $indice => $elemento){
                    if($elemento['id_producto'] == $producto_id){
                        
                        $_SESSION['carrito'][$indice]['unidades']++;
                        $counter++;
                        
                    }
                }

            }
            if(!isset($counter) || $counter == 0 ){
                //Conseguir producto
                $producto = new Producto();
                $producto->setId_producto($producto_id);
                $mi_producto = $producto->getOne();
                
                if(is_object($mi_producto)){
                    //añadir al carrito mediante un array asociativo
                    $_SESSION['carrito'][] = array(
                        "id_producto" => $mi_producto->id_producto,
                        "precio" => $mi_producto->precio,
                        "unidades" => 1,
                        "producto" => $mi_producto
                    );
                }
            }
            header("Location: ".base_url.'carrito/index');

        }
        public function delete(){
            if(isset($_GET['index'])){
                $index = $_GET['index'];
                unset($_SESSION['carrito'][$index]);
            }
            header("Location: ".base_url.'carrito/index');
        }
        
        
        public function up(){
            if(isset($_GET['index'])){
                $index = $_GET['index'];
                $_SESSION['carrito'][$index]['unidades']++;
            }
            header("Location: ".base_url.'carrito/index');
        }
        public function down(){
            if(isset($_GET['index'])){
                $index = $_GET['index'];
                $_SESSION['carrito'][$index]['unidades']--;
                
                if($_SESSION['carrito'][$index]['unidades']==0){
                    unset($_SESSION['carrito'][$index]);
                }
                //Disminuir stock
            }
            header("Location: ".base_url.'carrito/index');
        }
        
        
        
        public function delete_all(){
            unset($_SESSION['carrito']);
            header("Location: ".base_url.'carrito/index');
            
        }
    }

?>
