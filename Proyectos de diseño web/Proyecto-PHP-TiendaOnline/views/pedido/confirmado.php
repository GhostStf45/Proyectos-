<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido']=='complete'):  ?>
    <h1>Tu pedido se ha confirmado</h1>
    <p>
        Tu pedido ha sido guardado con exito, una vez que realices
        la transferencia bancaria a la cuenta 123456789 con el coste del pedido, sera procesado
        y enviado.

    </p>
    <?php if(isset($pedido)): ?>
        <h3>Datos del pedido: </h3>
        
        <p>Número de pedido:<?= $pedido->id_pedido ?></p>
        <p>Total a pagar: S/.<?= $pedido->Costo ?></p>
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
   
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido']!='complete'): ?>
    <h1>Tu pedido no ha podido procesarse</h1>
<?php endif; ?>
