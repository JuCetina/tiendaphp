<main class="confirmado">
    <h3>Confirmar el pedido</h3>
    <hr>

    <?php if(isset($_SESSION['pedido'])): ?>

        <?php if($_SESSION['pedido'] == 'completed'): ?>
            <h3>Pedido confirmado con éxito</h3>
            <p>Una vez realizada la transferencia bancaria a la cuenta de ahorros número 123456789 del Banco de Colombia con el total del pedido, este será procesado y enviado</p>
            <?php if(!empty($pedido)): ?>

                <h3>Datos del pedido</h3>
                <p><span>Número de pedido:</span> <?=$pedido->id?></p>
                
                <?php if(!empty($pedido_productos)): ?>

                        <p><span>Productos:</span></p>

                    <?php while($pp = $pedido_productos->fetch_object()): ?>

                        <p><?=$pp->nombre?> X <?=$pp->unidades?> unidad(es)</p>

                    <?php endwhile; ?>
                <?php endif; ?>

                <p><span>Total a pagar:</span> $<?=$pedido->costo_formateado?></p>

            <?php endif; ?>

        <?php else: ?>

            <h3>No fue posible confirmar el pedido</h3>
        <?php endif; ?>

    <?php endif; ?>

</main>