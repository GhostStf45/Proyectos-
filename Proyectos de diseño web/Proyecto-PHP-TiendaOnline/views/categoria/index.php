<h1>Gestionar categorias</h1>
<a href="<?= base_url ?>categoria/crear" class="button button-small">Crear categoria</a>
<table >
    <th>Id de la categoria</th>
    <th>Nombre de la categoria</th>
    <?php while($cat = $categorias->fetch_object()): ?>
        <tr>
            <td><?=$cat->id_categoria;?></td>
            <td><?=$cat->nombre_categoria;?></td>
        </tr>
    <?php endwhile; ?>
</table>

