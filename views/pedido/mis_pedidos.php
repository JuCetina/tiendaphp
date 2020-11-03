<main class="mis_pedidos">
    <?php if(!isset($gestion)): ?>
        <h3>Mis pedidos</h3>
    <?php else:?>
        <h3>Gestión de pedidos</h3>
    <?php endif; ?>
    <hr>

    <?php if(isset($_SESSION['estado'])): 
        if($_SESSION['estado'] == 'completed'): ?>
            <h3 class="alerta alerta-exito">Estado actualizado con éxito</h3>
        <?php else: ?>
            <h3 class="alerta alerta-error">Ocurrió un error, no fue posible actualizar el estado del pedido</h3>
        <?php endif; ?>
    <?php endif; 
        Utils::deleteSession('estado'); ?>

    <table>
        <caption>Listado de Pedidos</caption>
        <thead>
            <tr>
                <th>Número</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Departamento</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Detalle</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($pedidos)): ?>
                <?php while($pedido = $pedidos->fetch_object()): ?>
                <tr>
                    <td><?=$pedido->id;?></td>
                    <td>$<?=$pedido->costo_formateado;?></td>
                    <td><?=$pedido->fecha;?></td>
                    <td><?=$pedido->estado;?></td>
                    <td><?=$pedido->departamento;?></td>
                    <td><?=$pedido->ciudad;?></td>
                    <td><?=$pedido->direccion;?></td>
                    <td>
                        <a href="<?=base_url?>pedido/detalle&id=<?=$pedido->id?>">Ver</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No hay datos</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>