<?php


    if(isset($_POST))
    {
        //Conexion Base de datos
        require_once './assets/includes/conexion.php';
        //Recoger los valores del formulario de actualizacion
        /*VALOR TERNARIO*/
        /* el  mysqli_real_escape_string() nos servirá para que no se escapen datos diferentes a las letras como pueden ser las "" o caracteres 
         * especiales (@,#,$,&,/,etc) con el fin de tener mayor seguridad */
        $nombre= isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false;
        $apellidos= isset($_POST['apellidos']) ?  mysqli_real_escape_string($db,$_POST['apellidos']) : false;
        $email= isset($_POST['email']) ? mysqli_real_escape_string($db,trim($_POST['email'])) : false;
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
            $errores['email']="El apellido no es valido";
        }
        $guardar_usuario = false;
        if(count($errores) ==0){
            
            //COMPROBAR SI EL EMAIL YA EXISTE
            $sql = "SELECT id_usuario, email FROM usuarios WHERE email ='$email'; ";
            $isset_email = mysqli_query($db, $sql);
            $isset_user = mysqli_fetch_assoc($isset_email);
            
            if($isset_user['id_usuario'] == $_SESSION['usuario']['id_usuario'] || empty($isset_user)){
            
            

                $guardar_usuario = true;
                //ACTUALIZAR USUARIO EN LA BASE DE DATOS
                $sql = "UPDATE usuarios SET nombres = '$nombre', apellidos = '$apellidos', email = '$email' WHERE id_usuario = {$_SESSION['usuario']['id_usuario']};";
                $guardar = mysqli_query($db, $sql);



                if($guardar){
                    $_SESSION['usuario']['nombres']= $nombre;
                    $_SESSION['usuario']['apellidos']= $apellidos;
                    $_SESSION['usuario']['email']= $email;

                    $_SESSION['completado'] = "Tus datos se han actualizado con exito";
                    header("Location: mis-datos.php");

                }
                else{
                    $_SESSION['errores']['general'] = "Fallo al actualizar tus datos";
                    header("Location: mis-datos.php");

                }
            }else{
                $_SESSION['errores']['general'] = "El usuario ya exite";
                header("Location: mis-datos.php");

            }
        }else{
            $_SESSION['errores']=$errores;
            header("Location: mis-datos.php");
        }


    }

?>