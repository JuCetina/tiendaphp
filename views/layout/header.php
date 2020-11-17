<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url?>assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&family=Roboto&display=swap" rel="stylesheet">
    <title>Tienda de muchas cosas</title>
</head>
<body>
    <div class="container">

        <!-- Cabecera -->
        <header class="header">
            <div class="logo">
                <a href="<?=base_url?>">
                    <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta">
                    <h1>Tienda de muchas cosas</h1>
                </a>
            </div>
        </header>
    
        <!-- Menú -->
        <nav class="menu">
            <ul>
                
                <a href="<?=base_url?>">
                    <li>
                        Inicio
                    </li>
                </a>

                <?php $categorias = Utils::mostrarCategorias(); 
                 if(!empty($categorias)): ?>
                    <?php  while($cat = $categorias->fetch_object()): ?>
                        <a href="<?=base_url."categoria/ver&id=".$cat->id?>">
                            <li>
                                <?=$cat->nombre?>
                            </li>
                        </a>
                    <?php endwhile; ?>
                <?php endif; ?>

            </ul>
        </nav>