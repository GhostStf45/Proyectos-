<!--requires e includes-->

<?php require_once './assets/includes/cabecera.php'; ?>
<?php require_once './assets/includes/redireccion.php'; ?>

<?php 
  $entrada_actual= conseguir_entrada($db, $_GET['id']);

  if(!isset($entrada_actual['id_entrada'])){
      header("Location: index.php");
  }
  
                       
?>
<?php require_once './assets/includes/lateral.php'; ?>

    <!--CAJA PRINCIPAL-->
    <div id="principal">
        <h1>Editar entradas </h1>
        <p>Edita tu entrada <?= $entrada_actual['titulo'] ?> </p>
        <form action="guardar-entrada.php?editar=<?= $entrada_actual['id_entrada'] ?>" method="POST">
            <label for="titulo">Titulo: </label>
            <input type="text" name="titulo" value="<?= $entrada_actual['titulo']; ?>">
            
            <?php echo isset($_SESSION['errores_entrada']) ? mostrar_error($_SESSION['errores_entrada'],'error_titulo'):''; ?>
            

            <label for="descripcion">Descripcion: </label>
            
            <textarea name="descripcion"> <?= $entrada_actual['descripcion']; ?> </textarea>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrar_error($_SESSION['errores_entrada'],'error_descripcion'):''; ?>
            

            <label for="categoria">Categoria: </label>
            
            <select name="categoria">
                 <?php 
                        $categorias = conseguir_categorias($db); 
                      if(!empty($categorias)):

                        while($categoria = mysqli_fetch_assoc($categorias)): 
                ?>
                    
                            <option value="<?= $categoria['id_categoria']; ?>" <?= ($categoria['id_categoria'] == $entrada_actual['id_categoria']) ? "selected='selected'" :''; ?>>
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

<?php require_once './assets/includes/pie.php'; ?>