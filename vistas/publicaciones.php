<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/EscritorLibros.inc.php';

if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(RUTA_LOGIN);
}

include_once 'plantilla/documento-declaracion.inc.php';
include_once 'plantilla/navbar.inc.php';
?>
<br>
<div class="container is-max-desktop">
    <table class="table is-narrow is-bordered">
        <thead>
        <tr class="trhead">
            <th>Título</th>
            <th>Precio</th>
            <th>Vendido</th>
            <th>Gestionar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        EscritorLibros::escribir_mis_publicaciones();
        ?>

        </tbody>
    </table>
    <br>
</div>
