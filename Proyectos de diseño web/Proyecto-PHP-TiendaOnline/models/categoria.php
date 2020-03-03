
<?php

    class Categoria{
        private $id_categoria;
        private $nombre_categoria;
        private $db;
        
        public function __construct() {
            $this->db = DataBase::connect();
        }
        function getId_categoria() {
            return $this->id_categoria;
        }

        function getNombre_categoria() {
            return $this->nombre_categoria;
        }

        function setId_categoria($id_categoria) {
            $this->id_categoria = $id_categoria;
        }

        function setNombre_categoria($nombre_categoria) {
            $this->nombre_categoria = $this->db->real_escape_string($nombre_categoria);
        }
        
        public function getAll(){
            
            $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id_categoria DESC;");
            return $categorias;
            
            
        }
        
        
        public function getOne(){
            $categoria = $this->db->query("SELECT * FROM categorias WHERE id_categoria={$this->getId_categoria()};");
            return $categoria->fetch_object();
        }
        
        
        
        public function save(){
            
           $sql = "INSERT INTO categorias VALUES(NULL,'{$this->getNombre_categoria()}');";
           $save = $this->db->query($sql);
           
           $result = false;
           if($save){
               $result = true;
           }
           return $result;
        }
    }
?>
