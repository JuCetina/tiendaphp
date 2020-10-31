 
            <!-- Contenido principal -->
            <main>
            <?php if(!empty($cat)): ?>
                <h3><?=$cat->nombre?></h3>
                <hr>
                <div class="products">

                <?php if(!empty($productos)): ?>
                    <?php while($producto = $productos->fetch_object()): ?>
                        <div class="product">
                            <?php if($producto->imagen != null): ?>
                                <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" alt="Foto del producto">
                            <?php else: ?>
                                <img src="<?=base_url?>assets/img/camiseta.png" alt="Foto del producto">
                            <?php endif; ?>
                            <h4><?=$producto->nombre?></h4>
                            <p>$<?=$producto->precio_formateado?></p>
                            <a class="button" href="<?=base_url?>producto/ver&id=<?=$producto->id?>">Ver</a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No existen productos para mostrar en esta categoría</p>
                <?php endif; ?>
                                                             
                </div>
            <?php else: ?>
                <h3>No existe la categoría</h3>
                <hr>
            <?php endif; ?>

            </main>

