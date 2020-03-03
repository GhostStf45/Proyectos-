<?php
class Usuario{
    private $usuario_id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    
    private $db;
    
    public function __construct() {
        $this->db = DataBase::connect();
    }


    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password = password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost'=>4]);
    }

    function getRol() {
        return $this->rol;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellido($apellido) {
        $this->apellido = $this->db->real_escape_string($apellido);
    }

    function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }
    
    public function save(){
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellido()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', null);";
        $save = $this->db->query($sql);
        $result = false;
        if($save){
            $result = true;
            
        }
        return $result;
        
    }
    
    public function login(){
        $result=false;
        $email = $this->email;
        $password = $this->password;
        //comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE email='$email';";
        $login = $this->db->query($sql);
        if($login && $login->num_rows==1){
            $usuario = $login->fetch_object();
            
            //veficiar la contraseña
            $verify = password_verify($password, $usuario->password);
            if($verify){
                $result=$usuario;
            }
        }
        return $result;
    }


    
}

