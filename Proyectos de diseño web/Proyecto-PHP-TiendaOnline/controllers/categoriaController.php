<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';
class categoriaController{
    public function index() {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        require_once 'views/categoria/index.php';
    }
    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            //Conseguir categoria
            $categoria = new Categoria();
            $categoria->setId_categoria($id);
            $mi_categoria = $categoria->getOne();
            
            //Conseguir productos
            $producto = new Producto();
            $producto->setCategoria_id($id);
            
            $productos = $producto->getAllCategory();
            
        }
        
        require_once 'views/categoria/ver.php';
    }
    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }
    public function save(){
        Utils::isAdmin();
        
        //Guardar la categoria en la db
        if(isset($_POST) && isset($_POST['nombre'])){
            $categoria = new Categoria();
            $categoria->setNombre_categoria($_POST['nombre']);
            $categoria->save();
        }
            
        header("Location: ".base_url."categoria/index");
    }
}

