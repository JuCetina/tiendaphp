<main class="crear-categoria">
   
    <?php if(isset($editar) && isset($cat_consultada) && is_object($cat_consultada)): ?>
        <h3>Editar Categoría <?=$cat_consultada->nombre?></h3>
        <?php $url_action = base_url."categoria/guardar&id=".$cat_consultada->id ?>
    <?php else: ?>
        <h3>Crear Categoría</h3>
        <?php $url_action = base_url."categoria/guardar" ?>
    <?php endif; ?>
    
    <hr>

    <?php if(isset($_SESSION['categoria_crear'])): 
        if($_SESSION['categoria_crear'] == 'completed'): ?>
            <h3 class="alerta alerta-exito">Registro completado con éxito</h3>
        <?php else: ?>
            <h3 class="alerta alerta-error">Ocurrió un error, inténtelo nuevamente</h3>
        <?php endif; ?>
    <?php endif; 
        Utils::deleteSession('categoria_crear'); ?>

    <?php if(isset($_SESSION['categoria_actualizada'])): 
        if($_SESSION['categoria_actualizada'] == 'completed'): ?>
            <h3 class="alerta alerta-exito">Actualización completada con éxito</h3>
        <?php else: ?>
            <h3 class="alerta alerta-error">No fue posible actualizar la categoría</h3>
        <?php endif; ?>
    <?php endif; 
        Utils::deleteSession('categoria_actualizada'); ?>

    <form action="<?=$url_action?>" method="POST">
        <label for="nombre">Nombre</label>
        <?php if(isset($cat_consultada) && is_object($cat_consultada)): ?>
            <input type="text" name="nombre" value="<?=$cat_consultada->nombre?>" required>
        <?php else: ?>
            <input type="text" name="nombre" required>
        <?php endif ;?>
        <input type="submit" value="Guardar">
    </form>
</main>