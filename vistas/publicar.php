<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidarPublicar.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Libro.inc.php';
include_once 'app/RepositorioLibro.inc.php';

if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(RUTA_LOGIN);
}

if (isset($_POST['publicar'])) {
    Conexion:: abrir_conexion();

    $images1 = $_FILES['img1']['name'];
    $images2 = $_FILES['img2']['name'];
    $images3 = $_FILES['img3']['name'];

    $ruta1 = $_FILES['img1']['tmp_name'];
    $ruta2 = $_FILES['img2']['tmp_name'];
    $ruta3 = $_FILES['img3']['tmp_name'];

    $imgExt1 = strtolower(pathinfo($images1, PATHINFO_EXTENSION));
    $imgExt2 = strtolower(pathinfo($images2, PATHINFO_EXTENSION));
    $imgExt3 = strtolower(pathinfo($images3, PATHINFO_EXTENSION));

    if (isset($images1) && !empty($images1)) {
        $pic1 = $_SESSION['id'] . "+" . rand(1, 1000000) . "." . $imgExt1;
        $target_file1 = "uploads/" . $pic1;
    } else {
        $pic1 = null;
        $target_file1 = "";
    }

    if (isset($images2) && !empty($images2)) {
        $pic2 = $_SESSION['id'] . "+" . rand(1, 1000000) . "." . $imgExt2;
        $target_file2 = "uploads/" . $pic2;
    } else {
        $pic2 = null;
        $target_file2 = "";
    }

    if (isset($images3) && !empty($images3)) {
        $pic3 = $_SESSION['id'] . "+" . rand(1, 1000000) . "." . $imgExt3;
        $target_file3 = "uploads/" . $pic3;
    } else {
        $pic3 = null;
        $target_file3 = "";
    }

    $validador = new ValidarPublicar($_POST['titulo'], $_POST['autor'], $_POST['editor'], $pic1, $pic2, $pic3, $_POST['fecha_publicacion'], $_POST['isbn'], $_POST['issn'], $_POST['precio'], $_POST['calidad']);

    if ($validador->publicarValido()) {
        $libro = new Libro('', $_SESSION['id'], $validador->getTitulo(), $validador->getAutor(), $validador->getEditor(), $validador->getImg1(), $validador->getImg2(), $validador->getImg3(), $validador->getFechaPublicacion(), $validador->getIsbn(), $validador->getIssn(), '', $validador->getPrecio(), $validador->getCalidad(), '');
        $libro_insertado = RepositorioLibro:: insertar_libro(Conexion:: getConexion(), $libro);

        if ($libro_insertado) {
            move_uploaded_file($ruta1, $target_file1);
            move_uploaded_file($ruta2, $target_file2);
            move_uploaded_file($ruta3, $target_file3);
            Redireccion:: redirigir(SERVIDOR);
        }
    }
    Conexion:: cerrar_conexion();
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
