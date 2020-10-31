 
            <!-- Contenido principal -->
            <main>
            <?php if(!empty($producto)): ?>
                <h3>Producto: <?=$producto->nombre?></h3>
                <hr>
                

                    <div class="product-detail">
                        <div class="img">
                        <?php if($producto->imagen != null): ?>
                            <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" alt="Foto del producto: <?=$producto->nombre?>">
                        <?php else: ?>
                            <img src="<?=base_url?>assets/img/camiseta.png" alt="Foto del producto">
                        <?php endif; ?>
                        </div>
                        <div class="detail">
                        <h4><?=$producto->nombre?></h4>
                        <p>Descripcion: <?=$producto->descripcion?></p>
                        <p>Precio: $<?=$producto->precio_formateado?></p>
                        <p>Oferta: <?=$producto->oferta?></p>
                        <p>Stock: <?=$producto->stock?></p>
                        <a class="button" href="<?=base_url?>producto/comprar&id=<?=$producto->id?>">Comprar</a>
                        </div>
                    </div>
                                                     
                
            <?php else: ?>
                <h3>No existe el producto</h3>
                <hr>
            <?php endif; ?>
            
            </main>

