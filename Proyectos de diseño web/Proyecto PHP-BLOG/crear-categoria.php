

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
        <h1>Crear categorias </h1>
        <p>Añade nuevas categorias al blog para que los usuarios
        puedan usarlas al crear sus entradas. </p>
        <form action="guardar-categoria.php" method="POST">
            <label for="nombre">Nombre de la categoria: </label>
            <input type="text" name="nombre_categoria">
            
            <input type="submit" value="Guardar">
            
        </form>
    </div><!--Fin principal-->
<?php require_once './assets/includes/pie.php';   ?>