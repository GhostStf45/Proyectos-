<h1>Registrarse</h1>
<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'):?>
<strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['errores']['general'])): ?>
    <?php echo $_SESSION['errores']['general'];  ?>
<?php endif; ?>
    

    
<form action="<?=base_url?>usuario/save" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre">
    
    <?php echo isset($_SESSION['errores']) ? Utils::showError($_SESSION['errores'], 'nombre'): '';  ?>
    
    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos">
    
    <?php echo isset($_SESSION['errores']) ? Utils::showError($_SESSION['errores'], 'apellidos'): '';  ?>
    
    <label for="email">Email</label>
    <input type="email" name="email">
    
    <?php echo isset($_SESSION['errores']) ? Utils::showError($_SESSION['errores'], 'email'): '';  ?>
    
    <label for="password">Contraseña</label>
    <input type="password" name="password">
    
    <?php echo isset($_SESSION['errores']) ? Utils::showError($_SESSION['errores'], 'password'): '';  ?>
    
    <input type="submit" value="Registrarse">
    
</form> 
<?php Utils::deleteSession('errores'); ?>
<?php Utils::deleteSession('register'); ?>