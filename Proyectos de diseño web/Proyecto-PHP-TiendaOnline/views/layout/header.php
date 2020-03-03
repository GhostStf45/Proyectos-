<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tienda de camisetas</title>
    <!--Con la constante base_url podremos llamar a nuestros estilos y archivos sin ningun conflico-->
    <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
</head>
<body>
    <div id="container">
        <!--CABECERA-->
        <header id="header">
            <div id="logo">
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="camiseta_logo">
                <a href="index.php">
                    Tienda de camisetas
                </a>
            </div>
        </header>
        <!--MENU-->
        <?php $categorias=Utils::showCategorias(); ?>
        <nav id="menu">
            <ul>
                <li>
                    <a href="<?=base_url?>">Inicio</a>
                </li>
                <?php while($cat = $categorias->fetch_object()): ?>
                <li>
                    <a href="<?= base_url?>categoria/ver&id=<?= $cat->id_categoria; ?>"><?= $cat->nombre_categoria; ?></a>
                </li>
                <?php endwhile; ?>
            </ul>
        </nav>
        <div id="content">
