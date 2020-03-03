<h1>Detalle del pedido</h1>
<?php if(isset($pedido)): ?>
            <?php if(isset($_SESSION['admin'])): ?>
                <!--Ver usuario que hizo el pedido-->
                <!--ver pedido-->
                <h3>Cambiar estado</h3>
                <form action="<?=base_url?>pedido/estado" method="POST">
                    
                    <input type="hidden" value="<?= $pedido->id_pedido?>" name="pedido_id">
                    
                    <select name="estado">
                        <option value="confirm"<?= $pedido->estado == 'confirm' ? 'selected': ''?>>Pendiente</option>
                        <option value="preparation" <?= $pedido->estado == 'preparation' ? 'selected': ''?>>En preparacion</option>
                        <option value="ready" <?= $pedido->estado == 'ready' ? 'selected': ''?>>Preparado para enviar</option>
                        <option value="sended" <?= $pedido->estado == 'sended' ? 'selected': ''?>>Enviado</option>
                    </select>
                    <input type="submit" value="Cambiar estado">
                </form>
            <?php endif; ?>
        <h3>Direccion de envio</h3>
            <p>Estado: <?= Utils::showStatus($pedido->estado) ?></p>
            <p>Provincia: <?= $pedido->provincia ?></p>
            <p>Ciudad: <?= $pedido->localidad ?></p>
            <p>Direccion: <?= $pedido->direccion ?></p>

        
        <h3>Datos del pedido: </h3>
        
        <p>Número de pedido:<?= $pedido->id_pedido ?></p>
        <p>Total a pagar: S/.<?= $pedido->coste_total ?></p>
        <p>Productos: </p>
        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
            </tr>
            <?php while($producto = $productos->fetch_object()):?>
                <tr>
                    <td>
                        <?php if ($producto->imagen_prod != null): ?>
                            <img src="<?= base_url ?>uploads/images/<?= $producto->imagen_prod ?>" class="img_carrito">
                        <?php else: ?>
                            <img src="<?= base_url ?>assets/img/camiseta.png" class="img_carrito">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>producto/ver&id=<?= $producto->id_producto ?>"><?=$producto->nombre_producto?></a>
                    </td>
                    <td>
                        S/.<?=$producto->precio?>
                    </td>
                    <td>
                        <?=$producto->unidades?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>