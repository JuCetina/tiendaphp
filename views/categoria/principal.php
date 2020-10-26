<main class="principal_categorias">
    <h3>Gestionar Categorías</h3>
    <hr>
    <div class="botones-contenedor">
        <a href="<?=base_url?>categoria/crear" class="button boton-crear">Crear categoría</a>
    </div>

    <?php if(isset($_SESSION['categoria_eliminada'])): 
        if($_SESSION['categoria_eliminada'] == 'completed'): ?>
            <h3 class="alerta alerta-exito">Categoría eliminada con éxito</h3>
        <?php else: ?>
            <h3 class="alerta alerta-error">No fue posible eliminar la categoría</h3>
        <?php endif; ?>
    <?php endif; 
        Utils::deleteSession('categoria_eliminada'); ?>

    <table>
        <caption>Listado de Categorías Existentes</caption>
        <thead>
            <tr>
                <th>Id</th>
                <th>Categoría</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($categorias)): ?>
                <?php while($cat = $categorias->fetch_object()): ?>
                <tr>
                    <td><?=$cat->id;?></td>
                    <td><?=$cat->nombre;?></td>
                    <td>
                        <a href="<?=base_url?>categoria/editar&id=<?=$cat->id?>">Editar</a>
                    </td>
                    <td>
                        <a href="<?=base_url?>categoria/eliminar&id=<?=$cat->id?>">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay datos</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>