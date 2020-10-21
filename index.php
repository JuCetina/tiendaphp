<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Tienda de camisetas</title>
</head>
<body>
    <div class="container">

        <!-- Cabecera -->
        <header class="header">
            <div class="logo">
                <a href="index.php">
                    <img src="img/camiseta.png" alt="Camiseta">
                    <h1>Tienda de camisetas</h1>
                </a>
            </div>
        </header>
    
        <!-- Menú -->
        <nav class="menu">
            <ul>
                
                <a href="index.php">
                    <li>
                        Inicio
                    </li>
                </a>
                <a href="index.php">
                    <li>
                        Categoría 1
                    </li>
                </a>
                <a href="index.php">
                    <li>
                        Categoría 2
                    </li>
                </a>
                <a href="index.php">
                    <li>
                        Categoría 3
                    </li>
                </a>
                <a href="index.php">
                    <li>
                        Categoría 4
                    </li>
                </a>

            </ul>
        </nav>
    
        <div class="content">
            <!-- Barra lateral -->
            <aside class="sidebar">
    
                <!-- Login -->
                <div id="login" class="block-aside">
                    <h3>Entrar a la web</h3>
                    <form action="" method="POST">
                        <label for="email">E-mail</label>
                        <input type="email" name="email">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password">
                        <input type="submit" value="Entrar">
                    </form>
                </div>
    
                <!-- Enlaces -->
                <ul>
                    <a href="#">
                        <li><i class="icon-box-add"></i> Mis pedidos</li>
                    </a>
        
                    <a href="#">
                        <li><i class="icon-pencil2"></i> Gestionar pedidos</li>
                    </a>
                
                    <a href="#">
                        <li><i class="icon-drawer2"></i> Gestionar categorias</li>
                    </a>
                </ul>
    
            </aside>
    
            <!-- Contenido principal -->
            <div class="central">
    
                <div class="product">
                    <img src="img/camiseta.png" alt="Camiseta">
                    <h2>Camiseta azul</h2>
                    <p>$30.000</p>
                    <a href="#">Comprar</a>
                </div>
                <div class="product">
                    <img src="img/camiseta.png" alt="Camiseta">
                    <h2>Camiseta azul</h2>
                    <p>$30.000</p>
                    <a href="#">Comprar</a>
                </div>
                <div class="product">
                    <img src="img/camiseta.png" alt="Camiseta">
                    <h2>Camiseta azul</h2>
                    <p>$30.000</p>
                    <a href="#">Comprar</a>
                </div>
                <div class="product">
                    <img src="img/camiseta.png" alt="Camiseta">
                    <h2>Camiseta azul</h2>
                    <p>$30.000</p>
                    <a href="#">Comprar</a>
                </div>
                <div class="product">
                    <img src="img/camiseta.png" alt="Camiseta">
                    <h2>Camiseta azul</h2>
                    <p>$30.000</p>
                    <a href="#">Comprar</a>
                </div>
    
            </div>
        </div>
        
        <!-- Footer -->
        <footer>
            <p>Desarrollado por Juliette Cetina &copy;<?=date('Y')?></p>
        </footer>
    </div>
</body>
</html>