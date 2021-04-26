<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/Redireccion.inc.php';

include_once 'plantilla/documento-declaracion.inc.php';
include_once 'plantilla/navbar.inc.php';
?>
    <div class="container">
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child notification navbar-brand">
                    <h1 class="title"><b>Flybook</b><img src="<?php echo RUTA_IMG?>logo.png" width="50" height="37"></h1>
                    <p class="subtitle">Compra y venta de libros online</p>
                </article>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel is-success">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registro correcto
                    </div>
                    <div class="panel-block">
                        <h2><b>¡Gracias por registrarte</b>!</h2>
                        <br>
                        <h3>Inicia sesión <a href="<?php echo RUTA_LOGIN ?>">aquí</a> para comenzar a usar tu cuenta.
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include_once 'plantilla/documento-cierre.inc.php';
?>