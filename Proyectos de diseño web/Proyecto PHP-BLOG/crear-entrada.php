
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
        <h1>Crear entradas </h1>
        <p>Añade nuevas entradas al blog para que los usuarios
        puedan leerlas y disfrutar de nuestro contenido. </p>
        <form action="guardar-entrada.php" method="POST">
            <label for="titulo">Titulo: </label>
            <input type="text" name="titulo">
            
            <?php echo isset($_SESSION['errores_entrada']) ? mostrar_error($_SESSION['errores_entrada'],'error_titulo'):''; ?>
            

            <label for="descripcion">Descripcion: </label>
            
            <textarea name="descripcion"> </textarea>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrar_error($_SESSION['errores_entrada'],'error_descripcion'):''; ?>
            

            <label for="categoria">Categoria: </label>
            
            <select name="categoria">
                 <?php 
                        $categorias = conseguir_categorias($db); 
                      if(!empty($categorias)):

                        while($categoria = mysqli_fetch_assoc($categorias)): 
                    ?>
                            <option value="<?= $categoria['id_categoria']; ?>">
                                <?=  $categoria['nombre_categoria']; ?>
                            </option>
                    <?php 

                        endwhile;
                     endif;
                
                
                ?>
                
            </select>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrar_error($_SESSION['errores_entrada'],'error_categoria'):''; ?>

            
            <input type="submit" value="Guardar">
        </form>
        <?php borrar_errores();  ?>
    </div><!--Fin principal-->
<?php require_once './assets/includes/pie.php';   ?>