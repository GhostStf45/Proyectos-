<?php 
    require_once './assets/includes/cabecera.php';
?>
<?php 
  $entrada_actual= conseguir_entrada($db, $_GET['id']);
  
  

  if(!isset($entrada_actual['id_categoria'])){
      header("Location: index.php");
  }
                       
?>
<?php 
    require_once './assets/includes/lateral.php';
?>
 <div id="principal">
            
            <h1><?=  $entrada_actual['titulo'];  ?></h1>
            <a href="categoria.php?id=<?= $entrada_actual['id_categoria'] ?>">
                <h2><?=  $entrada_actual['Categoria'];  ?></h2>
            </a>
            <h4><?=  $entrada_actual['fecha_entrada'];  ?> || <?= $entrada_actual['usuario']; ?></h4>
            
            <p><?=  $entrada_actual['descripcion'];  ?></p>
            <?php 
                if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id_usuario'] == $entrada_actual['id_usuario']):
            ?>
                <a href="editar-entrada.php?id=<?= $entrada_actual['id_entrada']  ?>" class="boton boton-naranja">Editar entrada</a>
                <a href="borrar-entrada.php?id=<?= $entrada_actual['id_entrada']  ?>" class="boton boton-rojo">Eliminar entrada</a>
            <?php endif; ?>
           
  </div><!--Fin principal-->
<?php 
    require_once './assets/includes/pie.php';

?>