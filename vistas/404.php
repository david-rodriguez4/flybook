<?php
header($_SERVER['SERVER_PROTOCOL'] . "404 not found", true, 404);

include_once 'plantilla/documento-declaracion.inc.php';
include_once 'plantilla/navbar.inc.php';
?>
<br>
<div class="container is-max-desktop">
    <div class="notification is-danger is-light notfound">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        <h1 class="title cuatro">404</h1>
        <h2 class="subtitle">Página no encontrada</h2>
        <h2 class="subtitle">Oops! La página que estás buscando no existe. Puede que haya sido movida o eliminada.</h2>
    </div>
</div>
