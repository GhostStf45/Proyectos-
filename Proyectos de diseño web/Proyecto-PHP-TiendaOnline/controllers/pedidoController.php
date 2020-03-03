<?php
require_once 'models/pedido.php';
class pedidoController{
    public function hacer() {
        
        require_once 'views/pedido/hacer.php';
    }
    public function add(){
        if(isset($_SESSION['identity'])){
            $id_usuario = $_SESSION['identity']->id_usuario;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia']: false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad']: false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion']: false;
            
            $stats = Utils::statsCarrito();
            $costo_total = $stats['total'];
            
            //Guardar datos en bd
            if($provincia && $localidad && $direccion)
            {
                $pedido = new Pedido();
                $pedido->setId_usuario($id_usuario);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                
                $pedido->setCosto_total($costo_total);
                
                $save = $pedido->save();
                
                //Guardar pedido
                $save_linea = $pedido->save_linea();
                
                if($save &&  $save_linea){
                    $_SESSION['pedido'] = 'complete';
                }else{
                    $_SESSION['pedido'] = 'failed';
                }
                
               
            }else{
                $_SESSION['pedido'] = 'failed';
            }
            
            header("Location: ".base_url.'pedido/confirmado');
                
            
        
        }else{
            //Redirigir al index
            header("Location: ".base_url);
        }
    }
    public function confirmado(){
        
        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            
            //Pedido por el usuario
            $pedido = new Pedido();
            $pedido->setId_usuario($identity->id_usuario);
            $pedido = $pedido->getOneByUser();
            
            //Productos pedidos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductsByPedido($pedido->id_pedido);
        }
        
      require_once 'views/pedido/confirmado.php';
    }
     public function mis_pedidos(){
         
         Utils::isIdentity();
         $id_usuario =$_SESSION['identity']->id_usuario;
         $pedido = new Pedido();
         //SACAR LOS PEDIDOS DEL USUARIO
         $pedido->setId_usuario($id_usuario);
         $pedidos = $pedido->getAllByUser();
         require_once 'views/pedido/mis_pedidos.php';
    }
    public function detalle(){
        Utils::isIdentity();
        
        if(isset($_GET['id'])){
            
            $id_pedido = $_GET['id'];
            
            //sacar pedido
            $pedido = new Pedido();
            $pedido->setId_pedido($id_pedido);
            $pedido = $pedido->getOne();
            
            //sacar los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductsByPedido($id_pedido);
            
            
            require_once 'views/pedido/detalle.php';
        }else{
            header("Location: ".base_url.'pedido/mis_pedidos');
        }
        
        
    }
    public function gestion(){
        Utils::isAdmin();
        
        $gestion = true;
        
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        
        require_once 'views/pedido/mis_pedidos.php';
    }
    public function estado(){
        Utils::isAdmin();
        
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            
            //Recoger datos form
            $id_pedido = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            
            //Update del pedido
            $pedido = new Pedido();
            $pedido->setId_pedido($id_pedido);
            $pedido->setEstado($estado);
            $pedido->edit();
            
            header("Location: ".base_url. 'pedido/detalle&id='.$id_pedido);
            
        }else{
            header("Location: ".base_url);
        }
    }
}