<main class="registro">
    <h3>Registro</h3>
    <hr>
    <?php if(isset($_SESSION['registro'])):
            if($_SESSION['registro'] == 'completed'): ?>
                <h3 class="alerta alerta-exito">Registro completado con éxito</h3>
            <?php else: ?>
                <h3 class="alerta alerta-error">Ocurrió un error, inténtelo nuevamente</h3>
            <?php endif; ?>
    <?php endif; 
        Utils::deleteSession('registro'); ?>
    <form action="<?=base_url?>usuario/guardar" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>
    
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" required>
    
        <label for="email">E-mail</label>
        <input type="email" name="email" required>
    
        <label for="password">Contraseña</label>
        <input type="password" name="password" required>
    
        <input type="submit" value="Registrarse">
    </form>
</main>