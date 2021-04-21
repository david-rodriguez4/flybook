<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidarRegistro.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/ControlSesion.inc.php';

if (ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}

if (isset($_POST['enviar'])) {
    Conexion:: abrir_conexion();
    $validador = new ValidarRegistro($_POST['nombre'], $_POST['apellido'], $_POST['docid'], $_POST['nacimiento'], $_POST['email'], $_POST['clave1'], $_POST['clave2'], $_POST['estado'], Conexion::getConexion());

    if ($validador->registroValido()) {
        $usuario = new Usuario('', $validador->getNombre(), $validador->getApellido(), $validador->getDocid(), $validador->getFechaNacimiento(), $validador->getEmail(), password_hash($validador->getClave(), PASSWORD_DEFAULT), '', $validador->getEstado());
        $usuario_insertado = RepositorioUsuario:: insertarUsuario(Conexion:: getConexion(), $usuario);

        if ($usuario_insertado) {
            Redireccion:: redirigir(RUTA_REGISTRO_CORRECTO . '/' . $usuario->getNombre());
        }
    }
    Conexion:: cerrar_conexion();
}

include_once 'plantilla/documento-declaracion.inc.php';
include_once 'plantilla/navbar.inc.php';
?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
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
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading">
                        Formulario de registro
                    </div>
                    <form role="form" method="post" action="<?php echo RUTA_REGISTRO ?>">
                        <?php
                        if (isset($_POST['enviar'])) {
                            include_once 'plantilla/registro_validado.inc.php';
                        } else {
                            include_once 'plantilla/registro_vacio.inc.php';
                        }
                        ?>
                    </form>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <script type="text/javascript">
        function mostrarPassword1() {
            var cambio = document.getElementById("clave1");
            if (cambio.type == "password") {
                cambio.type = "text";
                $('.shbtn1').removeClass('is-light').addClass('shbtn-active');
                $('.1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('.shbtn1').removeClass('shbtn-active').addClass('is-light');
                $('.1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }

        function mostrarPassword2() {
            var cambio = document.getElementById("clave2");
            if (cambio.type == "password") {
                cambio.type = "text";
                $('.shbtn2').removeClass('is-light').addClass('shbtn-active');
                $('.2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('.shbtn2').removeClass('shbtn-active').addClass('is-light');
                $('.2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }
    </script>

<?php
include_once 'plantilla/documento-cierre.inc.php';
?>