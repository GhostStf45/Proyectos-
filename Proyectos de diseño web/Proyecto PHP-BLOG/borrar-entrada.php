<?php
    require_once './assets/includes/conexion.php';
    session_start();
    if(isset($_SESSION['usuario']) && isset($_GET['id'])){
        $entrada_id = $_GET['id'];
        $usuario_id = $_SESSION['usuario']['id_usuario'];
        $sql="DELETE FROM entrada WHERE id_usuario = $usuario_id AND id_entrada = $entrada_id ;";
        mysqli_query($db, $sql);
    }
    header("Location: index.php");

?>