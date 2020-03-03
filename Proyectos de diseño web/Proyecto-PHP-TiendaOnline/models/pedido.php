<?php

class Pedido{
    private $id_pedido;
    private $id_usuario;
    private $provincia;
    private $localidad;
    private $direccion;
    private $costo_total;
    private $estado;
    private $fecha;
    private $hora;
    
    private $db;
    
    public function __construct() {
        $this->db = DataBase::connect();
    }
    
    function getId_pedido() {
        return $this->id_pedido;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCosto_total() {
        return $this->costo_total;
    }

    function getEstado() {
        return $this->estado;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function setId_pedido($id_pedido) {
        $this->id_pedido = $id_pedido;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setProvincia($provincia) {
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    function setLocalidad($localidad) {
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    function setDireccion($direccion) {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setCosto_total($costo_total) {
        $this->costo_total = $costo_total;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }
    public function getAll(){
        $pedidos = $this->db->query("SELECT * FROM pedidos ORDER BY id_pedido DESC;");
        return $pedidos;
    }
    
    public function getOne(){
        $producto = $this->db->query("SELECT * FROM pedidos WHERE id_pedido = {$this->getId_pedido()};");
        return $producto->fetch_object();
    }
    
    public function getOneByUser(){
        $sql = "SELECT p.id_pedido as 'id_pedido', p.coste_total as 'Costo' FROM pedidos p "
                //. "INNER JOIN lineas_pedidos lp ON lp.id_pedido = p.id_pedido "
                . "WHERE p.id_usuario = {$this->getId_usuario()} ORDER BY p.id_pedido DESC LIMIT 1;";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }
    
    public function getProductsByPedido($id_pedido){
        
        $sql = "SELECT pr.*, lp.unidades as 'unidades' FROM productos pr "
                . "INNER JOIN lineas_pedidos lp ON pr.id_producto = lp.id_producto "
                . "WHERE lp.id_pedido = {$id_pedido}";
                
        $productos = $this->db->query($sql);
        
        return $productos;
    }
    
    public function getAllByUser(){
        
        $sql = "SELECT p.* FROM pedidos p "
                . "WHERE p.id_usuario = {$this->getId_usuario()} ORDER BY p.id_pedido DESC;";
        $pedido = $this->db->query($sql);
        
        
        
        return $pedido;
    }
    
    public function save(){
        
        $sql = "INSERT INTO pedidos VALUES(NULL, '{$this->getId_usuario()}', "
        . "'{$this->getProvincia()}', '{$this->getLocalidad()}', "
        . "'{$this->getDireccion()}', {$this->getCosto_total()}, 'confirm', CURDATE(), CURTIME());";
        
        $save = $this->db->query($sql);
        $result = false;
        
        if($save){
            $result = true;
        }
        return $result;
    }
    
    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        
        foreach ($_SESSION['carrito'] as $elemento){
            $producto = $elemento['producto'];
            
            $insert= "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id_producto}, {$elemento['unidades']});";
            
            $save = $this->db->query($insert);
        }
        
        $result = false;
        
        if($save){
            $result = true;
        }
        return $result;
        

        
        
    }
    public function edit(){
        $sql = "UPDATE pedidos SET estado='{$this->getEstado()}' ";
        $sql.= " WHERE id_pedido={$this->getId_pedido()};";
        
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
            
        }
        return $result;
    }

}

