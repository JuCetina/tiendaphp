<main class="detalle_pedido">
    <h3>Detalle del pedido</h3>
    <hr>

    <table>
        <caption>Artículos del pedido</caption>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Unidades</th>
                <th>Precio Unitario</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($ped)): 
            $total = 0;?>
            <?php while($pedido = $ped->fetch_object()): 
                $pedido_id = $pedido->id?>
                <tr>
                <?php if($pedido->imagen == null): ?>
                    <td><img src="<?=base_url.'assets/img/camiseta.png'?>" alt="Foto del producto: <?=$pedido->nombre?>"></td>
                <?php else: ?>
                    <td><img src="<?=base_url.'uploads/images/'.$pedido->imagen;?>" alt="Foto del producto: <?=$pedido->nombre?>"></td>
                <?php endif; ?>
                    <td><a href="<?=base_url."producto/ver&id=".$pedido->producto_id?>"><?=$pedido->nombre?></a></td>
                    <td><?=$pedido->unidades?></td>
                    <td>$<?=$pedido->precio_producto_formateado?></td>
                    <?php $total += $pedido->unidades * $pedido->precio?>
                </tr>    
            <?php endwhile; ?>
        <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total:</td>
                <?php if(!empty($ped)): ?>
                    <td>$<?=number_format($total, 2)?></td>      
                <?php endif; ?>
            </tr>
        </tfoot>
    </table>

    <?php if(isset($_SESSION['admin'])): ?>
        <h3>Cambiar estado del pedido</h3>
        <form action="<?=base_url?>pedido/estado&id=<?=$pedido_id?>" method="POST">
            <select name="estado">
                <option value="En preparación">En preparación</option>
                <option value="Enviado">Enviado</option>
            </select>
            <input type="submit" value="Enviar">
        </form>
    <?php endif; ?>

</main>