<?php
require_once 'models/usuario.php';
class usuarioController{
    
    public function registro(){
        require_once 'views/usuario/registro.php';
    }
    public  function save(){
        if(isset($_POST)){
            
            $nombre = isset($_POST['nombre']) ? $_POST['nombre']: false;
            $apellido = isset($_POST['apellidos']) ? $_POST['apellidos']: false;
            $email = isset($_POST['email']) ? $_POST['email']: false;
            $password = isset($_POST['password']) ? $_POST['password']: false;
            //Array de errores
            $errores = array();

            //VALIDAR LOS DATOS ANTES DE GUARDARLOS EN LA BASE DE DATOS
            if(!empty(trim($nombre)) && !is_numeric($nombre) && !preg_match("/[0-9]+/", $nombre)){
                $nombre_validado = true;
            }else{
                $nombre_validado = false;
                $errores['nombre'] = "El nombre no es valido";
            }
            if(!empty(trim($apellido)) && !is_numeric($apellido) && !preg_match("/[0-9]+/", $apellido)){
                $apellido_validado = true;
            }else{
                $apellido_validado = false;
                $errores['apellidos'] = "El apellido no es valido";
            }
            if(!empty(trim($email)) && filter_var($email, FILTER_VALIDATE_EMAIL)){
                $email_validado = true;
            }else{
                $email_validado = false;
                $errores['email'] = "El email no es valido";
            }
            if(!empty(trim($password))){
                $password_validado=true;
            }else{
                $password_validado = false;
                $errores['password'] = "La contraseña esta vacia";
            }
            
            if(count($errores) ==0)
            {
                if($nombre && $apellido && $email && $password)
                {

                    $usuario = new Usuario();
                    $usuario->setNombre($nombre);
                    $usuario->setApellido($apellido);
                    $usuario->setEmail($email);
                    $usuario->setPassword($password);

                    $save = $usuario->save();

                    if($save){
                        $_SESSION['register'] = "complete";
                    }else{
                        $_SESSION['errores']['general']= "Registro fallido";
                    }
                }
            }
            else{
                $_SESSION['errores'] = $errores;
            }
            
        }else{
            $_SESSION['errores']['general'] = "No se envio ningun dato";
            header("Location:".base_url.'usuario/registro');
        }
        
        header("Location:".base_url.'usuario/registro');

    }
    public function login(){
        if(isset($_POST)){
            //Identificar al usuario
            //consulta  a la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            $identity = $usuario->login();
            //sesion usuario
            if($identity  && is_object($identity)){
                $_SESSION['identity'] = $identity;
                //si es administrador
                if($identity->rol =='admin'){
                    $_SESSION['admin'] = true;
                }
            }else{
                $_SESSION['error_login'] = "Identificacion fallida";
            }
            
            
            //crear una sesion
        }
        header("Location: ".base_url);
    }
    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        header("Location: ".base_url);
    }
}//fin clase

