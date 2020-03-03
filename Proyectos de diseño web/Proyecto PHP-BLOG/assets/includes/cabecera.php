<?php 
    require_once 'conexion.php';

?>
<?php 
    require_once 'helpers.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=}, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog de videojuegos</title>
    <link rel="stylesheet" type="text/css" href="assets/css/estilos.css"
</head>
<body>
    <!--Cabecera-->
    <header id="cabecera">
        <!--Logo-->
        <div id="logo">
            <a href="index.php">
               Blog de Videojuegos
            </a>
        </div>
        <!--Menu-->
        
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">Inicio</a> 
                </li>
                <?php 
                    $categorias = conseguir_categorias($db); 
                  if(!empty($categorias)):

                    while($categoria = mysqli_fetch_assoc($categorias)): 
                ?>
                        <li>
                        <a href="categoria.php?id= <?= $categoria['id_categoria'] ?>" ><?=  $categoria['nombre_categoria']; ?></a> 
                        </li>
                <?php 
                
                    endwhile;
                 endif;
                
                
                ?>
                
                <!--<li>
                    <a href="index.php">Categoria 1</a> 
                </li>
                <li>
                    <a href="index.php">Categoria 2</a> 
                </li>
                <li>
                    <a href="index.php">Categoria 3</a> 
                </li>
                <li>
                    <a href="index.php">Categoria 4</a> 
                </li>-->
                <li>
                    <a href="index.php">Sobre nosotros</a> 
                </li>
                <li>
                    <a href="index.php">Contacto</a> 
                </li>
            </ul>
        </nav>
        <div class="clearfix">
        </div>
        
</header>
    <div id="contenedor">