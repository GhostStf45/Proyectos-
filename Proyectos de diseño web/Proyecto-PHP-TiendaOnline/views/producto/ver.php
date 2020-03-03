<?php if(isset($pro)): ?>
    <h1><?= $pro->nombre_producto; ?></h1>
    <div id="detail-product">
            <div class="image">
                <a href="<?= base_url ?>producto/ver&id=<?= $pro->id_producto; ?>">
                    <?php if ($pro->imagen_prod != null): ?>
                        <img src="<?= base_url ?>uploads/images/<?= $pro->imagen_prod ?>">
                    <?php else: ?>
                        <img src="<?= base_url ?>assets/img/camiseta.png">
                    <?php endif; ?>
                </a>
            </div>
            <div class="data">
                <p class="description"><?= $pro->descripcion ?></p>
                <p class="price">S/.<?= $pro->precio ?></p>
                <a href="<?= base_url ?>carrito/add&id=<?= $pro->id_producto ?>" class="button">Comprar</a>
            </div>
        </div>

<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>
