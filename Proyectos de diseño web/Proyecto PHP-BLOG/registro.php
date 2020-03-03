<?php
    
    if(isset($_POST))
    {
        //Conexion Base de datos
        require_once './assets/includes/conexion.php';
        //Sesion iniciada
        if(!isset($_SESSION['']))
        {
            session_start();
        }
        //Recoger los valores del formulario de registro
        /*VALOR TERNARIO*/
        /* el  mysqli_real_escape_string() nos servirá para que no se escapen datos diferentes a las letras como pueden ser las "" o caracteres 
         * especiales (@,#,$,&,/,etc) con el fin de tener mayor seguridad */
        $nombre= isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false;
        $apellidos= isset($_POST['apellidos']) ?  mysqli_real_escape_string($db,$_POST['apellidos']) : false;
        $email= isset($_POST['email']) ? mysqli_real_escape_string($db,trim($_POST['email'])) : false;
        $password= isset($_POST['password']) ?  mysqli_real_escape_string($db, trim($_POST['password'])) : false;
        //Array de errores
        $errores = array();
        
        //Validar los datos antes de guardarlos en la base de datos
        
        //Validar campo nombre
        if( !empty(trim($nombre)) && !is_numeric($nombre) && !preg_match("/[0-9]+/", $nombre)){
            $nombre_validado = true;
        }else{
            $nombre_validado = false;
            $errores['nombre']="El nombre no es valido";
        }
        
        //Validar campo apellidos
        if( !empty(trim($apellidos)) && !is_numeric($apellidos) && !preg_match("/[0-9]+/", $apellidos)){
            $apellido_validado = true;
        }else{
            $apellido_validado = false;
            $errores['apellidos']="El apellido no es valido";
        }
        
        //Validar campo email
        if( !empty(trim($email)) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_validado = true;
        }else{
            $email_validado = false;
            $errores['email']="El email no es valido";
        }
        //Validar campo password
        if( !empty(trim($password))){
            $password_validado = true;
        }else{
            $password_validado = false;
            $errores['password']="La contraseña esta vacia";
        }
        
        $guardar_usuario = false;
        if(count($errores) ==0){
            $guardar_usuario = true;
            //Cifrar la contraseña
                //PASSWORD_HASH = encriptacion de contraseñas
                //PASSWORD_VERIFY = desencriptar o cifrar contraseña
            $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
            //INSERTAR USUARIO EN LA BASE DE DATOS
            $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos','$email', '$password_segura', CURDATE())";
            $guardar = mysqli_query($db, $sql);

            if($guardar){
                $_SESSION['completado'] = "El registro se ha completado con exito";
            }
            else{
                $_SESSION['errores']['general'] = "Error al guardar en el registro porfavor verifique sus datos";
            }
        }else{
            $_SESSION['errores']=$errores;
            header("Location: index.php");
        }


    }
    header("Location: index.php");


?>