<main class="registro">
    <h3>Registro</h3>
    <hr>
    
    <form action="index.php?controller=UsuarioController&action=guardar" method="POST">
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