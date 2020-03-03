<?php

//Iniciar la sesion y la conexion a db
require_once './assets/includes/conexion.php';
//Recoger datos del formulario
if(isset($_POST)){
    //Borrar error antiguo
     if(isset($_SESSION['error_login'])){
                
        session_unset();
       
      }
    $email =trim($_POST['email']);
    $password = trim($_POST['password']);
    //Consulta para comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    if($login == true && mysqli_num_rows($login) == 1){
        $usuario = mysqli_fetch_assoc($login);
        //Comprobar la contraseña 
        $verify = password_verify($password, $usuario['password']);
        
        if($verify){
            //Utilizar una sesion para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;

        }else{
            //Si algo falla enviar una sesion con el fallo
            $_SESSION['error_login'] = "Login incorrecto!!";
        }
        
    }
    else{
        //mensaje de error
        $_SESSION['error_login'] = "Login incorrecto!!";
   }
}

//Redirigir al index.php
header("Location: index.php");

?>