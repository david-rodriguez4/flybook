<?php
include_once 'plantilla/documento-declaracion.inc.php';
include_once 'plantilla/navbar.inc.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-heading">
                    Vender un libro
                </div>
                <form role="form" method="post" action="<?php echo RUTA_PUBLICAR ?>"
                      enctype="multipart/form-data">
                    <?php
                    if (isset($_POST['publicar'])) {
                        include_once 'plantilla/publicar_validado.php';
                    } else {
                        include_once 'plantilla/publicar_vacio.inc.php';
                    }
                    ?>
                </form>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<?php
include_once 'plantilla/documento-cierre.inc.php';
?>