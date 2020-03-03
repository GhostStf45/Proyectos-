<?php if(isset($gestion)): ?>
    <h1>Gestionar pedidos</h1>
<?php else: ?>
    <h1>Mis pedidos</h1>
<?php endif;  ?>
<table class="">
    <tr>
        <th>N° Pedido</th>
        <th>Costo</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
    <?php 
        while($mis_pedidos = $pedidos->fetch_object()):
    ?>
        <tr>
            <td>
                <a href="<?= base_url ?>pedido/detalle&id=<?=$mis_pedidos->id_pedido?>"><?=$mis_pedidos->id_pedido ?></a>
            </td>
            <td>
                S/.<?=$mis_pedidos->coste_total ?>
            </td>
            <td>
                <?=$mis_pedidos->fecha_pedido?>
            </td>
            <td>
                <?= Utils::showStatus($mis_pedidos->estado)?>
            </td>
        </tr>
        
        
    <?php endwhile; ?>
</table>
