<?php if(isset($categoria)): ?>
    <h1><?= $mi_categoria->nombre_categoria; ?></h1>
    
    <?php if($productos->num_rows == 0): ?>
        <p>No hay productos para mostrar</p>
    <?php else: ?>
        <?php while($pro = $productos->fetch_object()): ?>
            <article class="product">
                <a href="<?=base_url?>producto/ver&id=<?=$pro->id_producto;?>">
                    <?php if($pro->imagen_prod!=null): ?>
                        <img src="<?=base_url?>uploads/images/<?= $pro->imagen_prod?>">
                        <?php else: ?>
                        <img src="<?=base_url?>assets/img/camiseta.png">
                    <?php endif; ?>
                    <h2><?= $pro->nombre_producto?></h2>
                </a>
                <p>S/.<?= $pro->precio?></p>
                <a href="<?= base_url ?>carrito/add&id=<?= $pro->id_producto ?>" class="button">Comprar</a>
            </article>
        <?php endwhile; ?>
    <?php endif;?>
<?php else: ?>
    <h1>La categoria no existe</h1>
<?php endif; ?>
