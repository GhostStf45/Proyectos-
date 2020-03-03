
<?php 
    require_once './assets/includes/cabecera.php';
?>
<?php 
  $categoria = conseguir_categoria($db, $_GET['id']);
  if(!isset($categoria['id_categoria'])){
      header("Location: index.php");
  }
                       
?>
<?php 
    require_once './assets/includes/lateral.php';
?>
 <div id="principal">
            
            <h1>Entradas de <?=  $categoria['nombre_categoria'];  ?></h1>
            <?php    
                $entradas = conseguirEntradas($db, null, $_GET['id']);

                if(!empty($entradas) && mysqli_num_rows($entradas)>=1):
                    while($entrada  = mysqli_fetch_assoc($entradas)):
                        
            ?>
                        <article class="entrada">
                            <a href="entrada.php?id= <?= $entrada['id_entrada']?>">
                                <h2><?= $entrada['titulo'];?></h2>
                                <span class="fecha"><?= $entrada['Categoria'].' | '. $entrada['fecha_entrada'] ?></span>
                                <p>
                                    <?= substr($entrada['descripcion'], 0, 180).'...';?>
                                </p>
                            </a>
                        </article>
            <?php
                    endwhile;    
                else:
            ?>
            <div class="alerta ">No hay entradas</div>
            <?php endif; ?>
        </div><!--Fin principal-->
<?php 
    require_once './assets/includes/pie.php';

?>