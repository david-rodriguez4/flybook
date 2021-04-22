<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';

Conexion:: abrir_conexion();
$total_usuarios = RepositorioUsuario:: getUsuarios(Conexion::getConexion());

include_once 'plantilla/documento-declaracion.inc.php';
?>
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="<?php echo SERVIDOR ?>"><b>Flybook</b><img src="<?php echo RUTA_IMG ?>logo.png" width="" height=""></a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
               data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <?php
            if (ControlSesion::sesion_iniciada()) {
                ?>
                <div class="navbar-end">
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">Mi perfil</a>
                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="<?php echo RUTA_PUBLICAR ?>">Vender un libro</a>
                            <hr class="navbar-divider">
                            <a class="navbar-item" href="<?php echo RUTA_COMPRAS ?>">Mis compras</a>
                            <hr class="navbar-divider">
                            <a class="navbar-item" href="<?php echo RUTA_PUBLICACIONES ?>">Mis publicaciones</a>
                            <hr class="navbar-divider">
                            <a class="navbar-item" href="<?php echo RUTA_LOGOUT ?>">Cerrar sesión</a>
                        </div>
                    </div>
                </div>

                <?php
            } else {
                ?>
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary" href="<?php echo RUTA_REGISTRO ?>">
                                <strong>Registro</strong>
                            </a>
                            <a class="button is-light" href="<?php echo RUTA_LOGIN ?>">
                                <strong>Iniciar sesión</strong>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
        if ($navbarBurgers.length > 0) {
            $navbarBurgers.forEach(el => {
                el.addEventListener('click', () => {
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');
                });
            });
        }
    });
</script>

