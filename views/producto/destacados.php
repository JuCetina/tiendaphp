 
            <!-- Contenido principal -->
            <main>
                <h3>Algunos de nuestros productos</h3>
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
                    <p>No existen productos destacados para mostrar</p>
                <?php endif; ?>
                     
                                        
                </div>
    
            </main>

