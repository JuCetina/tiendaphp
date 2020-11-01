        <div class="content">
            <!-- Barra lateral -->
            <aside class="sidebar">
                <?php if(isset($_SESSION['carrito'])): ?>
                    <div class="block-aside">
                        <h2>Carrito de compras</h2>
                        <ul>
                            <a href="<?=base_url?>carrito/principal">
                                <li><i class="icon-truck"></i> Ver carrito</li>
                            </a>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if(!isset($_SESSION['logueado'])): ?>
                    <!-- Login -->
                    <div id="login" class="block-aside">
                        <h2>Entrar a la web</h2>
                        <?php if(isset($_SESSION['error_login'])): ?>
                            <p class="alerta alerta-error"><?=$_SESSION['error_login']?></p>
                        <?php endif;
                            Utils::deleteSession('error_login');?>
                            <form action="<?=base_url?>usuario/login" method="POST">
                            <label for="email">E-mail</label>
                            <input type="email" name="email">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password">
                            <input type="submit" value="Entrar">
                        </form>
                        <p>Si no tienes cuenta <a href="<?=base_url?>usuario/registro">regístrate aquí</a></p>
                    </div>
                <?php else: ?>
                    <!-- Usuario logueado -->
                    <div class="block-aside">
                        <h2><?=$_SESSION['logueado']->nombres." ".$_SESSION['logueado']->apellidos;?></h2>
                    </div>
                    <!-- Enlaces -->
                    <ul>
                    <?php if(isset($_SESSION['admin'])): ?>
                        <a href="<?=base_url?>categoria/principal">
                            <li><i class="icon-stack"></i> Gestionar categorías</li>
                        </a>
                        <a href="<?=base_url?>producto/gestion">
                            <li><i class="icon-box-add"></i> Gestionar productos</li>
                        </a>
                        <a href="#">
                            <li><i class="icon-truck"></i> Gestionar pedidos</li>
                        </a>
                    <?php endif; ?>
                        <a href="#">
                            <li><i class="icon-gift"></i> Mis pedidos</li>
                        </a>
                        <a href="<?=base_url?>usuario/logout">
                            <li><i class="icon-exit"></i> Cerrar sesión</li>
                        </a>
                    </ul>
                <?php endif; ?>
            </aside>