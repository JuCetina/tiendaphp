<main class="mis_pedidos">
    <h3>Mis pedidos</h3>
    <hr>

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