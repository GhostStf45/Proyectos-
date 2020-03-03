
    <!--Sidebar-->
        <aside id="sidebar">
            <div id="buscador" class="bloque">
                    <h3>Buscar</h3>
                    <form action="buscar.php" method="POST">
                        <input type="text" name="busqueda">
                        <input type="submit" value="Buscar">
                    </form>
            </div>
            <?php  if(isset($_SESSION['usuario'])): ?>
                <div id="usuario-logueado" class="bloque">
                    <h3>Bienvenido, <?=$_SESSION['usuario']['nombres'].' '. $_SESSION['usuario']['apellidos']; ?></h3>
                    <!--Botones-->
                    <a href="crear-entrada.php" class="boton boton-naranja">Crear entradas</a>
                    <a href="crear-categoria.php" class="boton">Crear categoría</a>
                    <a href="mis-datos.php" class="boton boton-verde">Mis datos</a>
                    <a href="cerrar.php" class="boton boton-rojo">Cerrar sesión</a>
                    
                </div>
            <?php endif; ?>
            <?php if(!isset($_SESSION['usuario'])): ?>
                <div id="login" class="bloque">
                    <h3>Identificate</h3>
                <?php  if(isset($_SESSION['error_login'])): ?>
                    <div id="usuario-logueado" class="alerta alerta error">
                        <?=$_SESSION['error_login']; ?>
                    </div>
                <?php endif; ?>

                    <form action="login.php" method="POST">
                        <label for="email">Email: </label>
                        <input type="email" name="email">
                        <label for="password">Contraseña: </label>
                        <input type="password" name="password">
                        <input type="submit" value="Entrar">
                    </form>
                </div>
                <div id="register" class="bloque">
                    <h3>Registrate</h3>
                    <!--MOSTRAR ERRORES-->
                    <?php if(isset($_SESSION['completado'])): ?>
                        <div class="alerta_exito"> 

                            <?= $_SESSION['completado'];?>

                        </div>
                    <?php elseif(isset($_SESSION['errores']['general'])) :  ?>
                        <?= $_SESSION['errores']['general'];?>
                    <?php endif; ?>
                    <form action="registro.php" method="POST">
                        <label for="nombre">Nombre: </label>
                        <input type="text" name="nombre">

                        <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'],'nombre'):''; ?>

                        <label for="apellidos">Apellidos: </label>
                        <input type="text" name="apellidos">

                        <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'],'apellidos'):''; ?>

                        <label for="email">Email: </label>
                        <input type="email" name="email">

                        <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'],'email'):''; ?>

                        <label for="password">Contraseña: </label>
                        <input type="password" name="password">

                        <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'],'password'):''; ?>

                        <input type="submit" value="Registrar" name="submit">
                    </form>
                    <?php borrar_errores(); ?>
                </div>
            <?php endif;  ?>
        </aside>