<main class="crear-prodcuto">
   
    <?php if(isset($editar) && isset($pro_consultado) && is_object($pro_consultado)): ?>
        <h3>Editar Producto <?=$pro_consultado->nombre?></h3>
        <?php $url_action = base_url."producto/guardar&id=".$pro_consultado->id ?>
    <?php else: ?>
        <h3>Crear Producto</h3>
        <?php $url_action = base_url."producto/guardar" ?>
    <?php endif; ?>
    
    <hr>

    <?php if(isset($_SESSION['producto_crear'])): 
        if($_SESSION['producto_crear'] == 'completed'): ?>
            <h3 class="alerta alerta-exito">Registro completado con éxito</h3>
        <?php else: ?>
            <h3 class="alerta alerta-error">Ocurrió un error, inténtelo nuevamente</h3>
        <?php endif; ?>
    <?php endif; 
        Utils::deleteSession('producto_crear'); ?>

    <?php if(isset($_SESSION['producto_actualizado'])): 
        if($_SESSION['producto_actualizado'] == 'completed'): ?>
            <h3 class="alerta alerta-exito">Actualización completada con éxito</h3>
        <?php else: ?>
            <h3 class="alerta alerta-error">No fue posible actualizar el producto</h3>
        <?php endif; ?>
    <?php endif; 
        Utils::deleteSession('producto_actualizado'); ?>

    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=isset($pro_consultado) && is_object($pro_consultado) ? $pro_consultado->nombre : '' ?>" required>

        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" required><?=isset($pro_consultado) && is_object($pro_consultado) ? $pro_consultado->descripcion : '' ?></textarea>

        <label for="categoria">Categoría</label>
        <select name="categoria" required>
            <?php $categorias = Utils::mostrarCategorias(); 
            while($cat = $categorias->fetch_object()): ?>
                <option value="<?=$cat->id?>" <?=isset($pro_consultado) && is_object($pro_consultado) && $cat->id == $pro_consultado->categoria_id ? 'selected' : '' ?>
                >
                    <?=$cat->nombre?>
                </option>
            <?php endwhile; ?>            
        </select>

        <label for="precio">Precio</label>
        <input type="text" name="precio" value="<?=isset($pro_consultado) && is_object($pro_consultado) ? $pro_consultado->precio : '' ?>" required>

        <label for="stock">Stock</label>
        <input type="number" name="stock" value="<?=isset($pro_consultado) && is_object($pro_consultado) ? $pro_consultado->stock : '' ?>" required>

        <label for="oferta">Oferta</label>
        <input type="text" name="oferta" value="<?=isset($pro_consultado) && is_object($pro_consultado) ? $pro_consultado->oferta : '' ?>">

        <label for="imagen">Imagen</label>
        <?php if(isset($pro_consultado) && is_object($pro_consultado) && !empty($pro_consultado->imagen)): ?>
            <img class="miniatura" src="<?=base_url.'uploads/images/'.$pro_consultado->imagen?>" alt="Imagen del producto">
        <?php endif; ?>
        <input type="file" name="imagen">
        
        <input type="submit" value="Guardar">
    </form>
</main>