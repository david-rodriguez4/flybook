<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidarLogin.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/ControlSesion.inc.php';

if (ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}

if (isset($_POST['login'])) {
    Conexion:: abrir_conexion();
    $validador = new ValidarLogin($_POST['email'], $_POST['clave'], Conexion:: getConexion());

    if ($validador->obtener_error() === '' && !is_null($validador->obtener_usuario())) {
        ControlSesion::iniciar_sesion($validador->obtener_usuario()->getId(), $validador->obtener_usuario()->getNombre(), $validador->obtener_usuario()->getEstado());
        Redireccion::redirigir(SERVIDOR);
    }

    Conexion:: cerrar_conexion();
}

include_once 'plantilla/documento-declaracion.inc.php';
include_once 'plantilla/navbar.inc.php';
?>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
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
            </div>
            <div class="col-md-4">
                <div class="panel">
                    <div class="panel-heading">
                        Inicio de sesión
                    </div>
                    <form role="form" method="post" action="<?php echo RUTA_LOGIN ?>">
                        <div class="panel-block">
                            <p class="control">
                                <input class="input" placeholder="Correo electrónico" type="email" name="email"
                                       id="email" <?php
                                if (isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email'])) {
                                    echo 'value="' . $_POST['email'] . '"';
                                }
                                ?>>
                            </p>
                        </div>
                        <div class="panel-block">
                            <p class="control">
                                <input class="input" type="password" name="clave" id="clave" placeholder="Contraseña">
                            </p>
                            <button id="show_password" class="button shbtn is-light" type="button"
                                    onclick="mostrarPassword()">
                                <i class="fa fa-eye-slash icon" aria-hidden="true"></i>
                            </button>
                        </div>
                        <?php
                        if (isset($_POST['login'])) {
                            $validador->mostrar_error();
                        }
                        ?>
                        <div class="panel-block">
                            <button type="submit" class="button is-light is-fullwidth" name="login">Enviar</button>
                        </div>
                        <br>
                        <div class="text-center">
                            <a href="#">¿Olvidaste tu contraseña?</a><br>
                            <a href="<?php echo RUTA_REGISTRO ?>">¿No te has registrado?</a>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function mostrarPassword() {
            var cambio = document.getElementById("clave");
            if (cambio.type == "password") {
                cambio.type = "text";
                $('.shbtn').removeClass('is-light').addClass('shbtn-active');
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('.shbtn').removeClass('shbtn-active').addClass('is-light');
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }
    </script>

<?php
include_once 'plantilla/documento-cierre.inc.php';
?>