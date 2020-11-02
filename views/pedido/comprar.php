<main class="comprar">
    <h3>Confirmar el pedido</h3>
    <hr>
    <?php if(!isset($_SESSION['logueado'])): ?>
        <h3>Debes estar identificado para confirmar el pedido</h3>
    <?php else: ?>
        
        <?php if(isset($_SESSION['pedido'])): 
            if($_SESSION['pedido'] == 'failed'): ?>
                <h3 class="alerta alerta-error">Se generó un error, inténtelo de nuevo</h3>
            <?php endif; ?>
        <?php endif; 
        Utils::deleteSession('pedido'); ?>

        <h3>Datos para el envío</h3>
        <form action="<?=base_url?>pedido/guardar" method="POST">
            <label for="depto">Departamento</label>
            <input type="text" name="depto" required>

            <label for="ciudad">Ciudad</label>
            <input type="text" name="ciudad" required>

            <label for="direccion">Dirección</label>
            <input type="text" name="direccion">

            <input type="submit" value="Confirmar pedido" required>    
        </form>
    <?php endif; ?>
</main>