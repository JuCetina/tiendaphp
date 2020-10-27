<main class="gestion_producto">
    <h3>Gestionar Productos</h3>
    <hr>
    <div class="botones-contenedor">
        <a href="<?=base_url?>producto/crear" class="button boton-crear">Crear producto</a>
    </div>

    <?php if(isset($_SESSION['producto_eliminado'])): 
        if($_SESSION['producto_eliminado'] == 'completed'): ?>
            <h3 class="alerta alerta-exito">Producto eliminado con éxito</h3>
        <?php else: ?>
            <h3 class="alerta alerta-error">No fue posible eliminar el producto</h3>
        <?php endif; ?>
    <?php endif; 
        Utils::deleteSession('producto_eliminado'); ?>

    <table>
        <caption>Listado de Productos Existentes</caption>
        <thead>
            <tr>
                <th>Id</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($productos)): ?>
                <?php while($producto = $productos->fetch_object()): ?>
                    <tr>
                        <td><?=$producto->id;?></td>
                        <td><?=$producto->nombre;?></td>
                        <td><?=$producto->precio;?></td>
                        <td><?=$producto->stock;?></td>
                        <td>
                            <a href="<?=base_url?>producto/editar&id=<?=$producto->id?>">Editar</a>
                        </td>
                        <td>
                            <a href="<?=base_url?>producto/eliminar&id=<?=$producto->id?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay datos</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>