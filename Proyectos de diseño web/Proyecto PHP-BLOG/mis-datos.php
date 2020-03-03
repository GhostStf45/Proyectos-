<?php
    require_once './assets/includes/cabecera.php';

?>
<?php 
    require_once './assets/includes/redireccion.php';

?>
<?php 
    require_once './assets/includes/lateral.php';
?>

<!--CAJA PRINCIPAL-->

<div id="principal">
    <h1>Mis datos</h1>
    <?php if(isset($_SESSION['completado'])): ?>
        <div class="alerta_exito"> 

            <?= $_SESSION['completado'];?>

        </div>
    <?php elseif(isset($_SESSION['errores']['general'])) :  ?>
             <?= mostrar_error($_SESSION['errores'],'general');?>
   <?php endif; ?>
    
    <form action="actualizar-usuario.php" method="POST">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" value='<?= $_SESSION['usuario']['nombres'];   ?>'>

        <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'],'nombre'):''; ?>

        <label for="apellidos">Apellidos: </label>
        <input type="text" name="apellidos" value='<?= $_SESSION['usuario']['apellidos'];   ?>'>

        <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'],'apellidos'):''; ?>

        <label for="email">Email: </label>
        <input type="email" name="email" value='<?= $_SESSION['usuario']['email'];   ?>'>

        <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'],'email'):''; ?>

        <input type="submit" value="Actualizar" name="submit">
    </form>
    <?php borrar_errores(); ?>
</div><!--Fin principal-->


<?php require_once './assets/includes/pie.php';   ?>