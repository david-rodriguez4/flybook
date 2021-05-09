<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidarEditar.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Libro.inc.php';
include_once 'app/RepositorioLibro.inc.php';

if (ControlSesion::sesion_iniciada() && $_SESSION['id'] == $vendedor->getId()) {
    if (isset($_POST['editar'])) {
        Conexion::abrir_conexion();
        $validador = new ValidarEditar($_POST['titulo'], $_POST['autor'], $_POST['fecha_publicacion'], $_POST['precio'], $_POST['calidad']);
        if ($validador->editarValido()) {
            $libro_editado = RepositorioLibro:: editar_libro(Conexion:: getConexion(), $libro->getId(), $validador->getTitulo(), $validador->getAutor(), $_POST['editorial'], $_POST['edicion'], $validador->getFechaPublicacion(), $_POST['isbn'], $_POST['issn'], $validador->getPrecio(), $validador->getCalidad());
            if ($libro_editado) {
                Redireccion:: redirigir(SERVIDOR);
            }
        }
    }
} else {
    Redireccion::redirigir(SERVIDOR);
}

include_once 'plantilla/documento-declaracion.inc.php';
include_once 'plantilla/navbar.inc.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading">
                        Editar un libro
                    </div>
                    <form role="form" method="post" action="<?php echo RUTA_EDITAR . '/' . $libro->getId() ?>"
                          enctype="multipart/form-data">
                        <?php
                        if (isset($_POST['editar'])) {
                            include_once 'plantilla/editar_validado.php';
                        } else {
                            include_once 'plantilla/editar_vacio.inc.php';
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