<main class="principal_carrito">
    <h3>Carrito de Compras</h3>
    <hr>

    <table>
        <caption>Artículos del carrito de compras</caption>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Unidades</th>
                <th>Precio Unitario</th>
            </tr>
        </thead>
        <tbody>
        <?php if(isset($_SESSION['carrito'])): ?>
            <?php foreach($_SESSION['carrito'] as $indice => $elemento): ?>
                <tr>
                <?php if($elemento['producto']->imagen == null): ?>
                    <td><img src="<?=base_url.'assets/img/camiseta.png'?>" alt="Foto del producto: <?=$elemento['producto']->nombre?>"></td>
                <?php else: ?>
                    <td><img src="<?=base_url.'uploads/images/'.$elemento['producto']->imagen;?>" alt="Foto del producto: <?=$elemento['producto']->nombre?>"></td>
                <?php endif; ?>
                    <td><a href="<?=base_url."producto/ver&id=".$elemento['producto']->id?>"><?=$elemento['producto']->nombre?></a></td>
                    <td><?=$elemento['unidades']?></td>
                    <td>$<?=$elemento['producto']->precio_formateado?></td>
                </tr>    
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total:</td>
            <?php if(isset($_SESSION['carrito'])): 
                $total = 0;?>
                <?php foreach($_SESSION['carrito'] as $indice => $elemento): 
                    $total += $elemento['producto']->precio * $elemento['unidades']?>
                <?php endforeach; ?>
                <td>$<?=number_format($total, 2)?></td>
            <?php endif; ?>
            </tr>
        </tfoot>
    </table>
    <a class="button pedido" href="<?=base_url?>pedido/comprar">Comprar</a>
</main>