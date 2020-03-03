<?php

class Producto{
    private $id_producto;
    private $categoria_id;
    private $nombre_producto;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen_producto;
    
    
    private $db;
    
    public function __construct() {
        $this->db= DataBase::connect();
    }


    function getCategoria_id() {
        return $this->categoria_id;
    }

    function getNombre_producto() {
        return $this->nombre_producto;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getStock() {
        return $this->stock;
    }

    function getOferta() {
        return $this->oferta;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getImagen_producto() {
        return $this->imagen_producto;
    }
    function getId_producto() {
        return $this->id_producto;
    }

    
    function setCategoria_id($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    function setNombre_producto($nombre_producto) {
        $this->nombre_producto = $this->db->real_escape_string($nombre_producto);
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function setPrecio($precio) {
        $this->precio = $this->db->real_escape_string($precio);
    }

    function setStock($stock) {
        $this->stock = $this->db->real_escape_string($stock);
    }

    function setOferta($oferta) {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setImagen_producto($imagen_producto) {
        $this->imagen_producto = $this->db->real_escape_string($imagen_producto);
    }
    
    function setId_producto($id_producto) {
        $this->id_producto = $id_producto;
    }

    public function getAll(){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id_producto DESC ;");
        return $productos;
       
    }
    
    public function getAllCategory(){
        $sql = "SELECT p.*, c.nombre_categoria FROM productos p"
                . " INNER JOIN categorias c ON c.id_categoria = p.id_categoria"
                . " WHERE p.id_categoria = {$this->getCategoria_id()}"
                . " ORDER BY id_producto DESC ;";
        $productos = $this->db->query($sql);
        
        return $productos;
       
    }
    
    
    
    
    
    public function getOne(){
        $producto = $this->db->query("SELECT * FROM productos WHERE id_producto = {$this->getId_producto()} ;");
        return $producto->fetch_object();
    }
    public function getRandom($limit){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit;");
        return $productos;
    }
    
    public function save(){
     
        $sql = "INSERT INTO productos VALUES(NULL, '{$this->getCategoria_id()}', '{$this->getNombre_producto()}', '{$this->getDescripcion()}', {$this->getPrecio()},{$this->getStock()}, '{$this->getOferta()}', CURDATE(), '{$this->getImagen_producto()}');";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
            
        }
        return $result;
        
    }
    
    public function edit(){
     
        $sql = "UPDATE productos SET nombre_producto='{$this->getNombre_producto()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()},stock={$this->getStock()}, id_categoria = {$this->getCategoria_id()}";
        if($this->getImagen_producto()!=null){
            $sql.= ",imagen_prod= '{$this->getImagen_producto()}' WHERE id_producto={$this->getId_producto()};";
        }else{
            $sql.= " WHERE id_producto={$this->getId_producto()};";
        }
        
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
            
        }
        return $result;
        
    }
    public function delete(){
        $sql = "DELETE FROM productos WHERE id_producto={$this->id_producto};";
        $delete = $this->db->query($sql);
        
        $result = false;
        if($delete){
            $result = true;
            
        }
        return $result;
    }


}



?>