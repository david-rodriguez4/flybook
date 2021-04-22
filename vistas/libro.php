<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/CompraVenta.inc.php';
include_once 'app/Libro.inc.php';
include_once 'app/RepositorioLibro.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioCompraVenta.inc.php';
include_once 'app/ControlSesion.inc.php';

include_once 'plantilla/documento-declaracion.inc.php';
include_once 'plantilla/navbar.inc.php';

if (isset($_POST['confirmar']) && ControlSesion::sesion_iniciada()) {
    Conexion::abrir_conexion();
    $id = md5(password_hash(rand(0, 100000), PASSWORD_DEFAULT));
    $id_comprador = $_SESSION['id'];
    $compraventa = new CompraVenta($id, $vendedor->getId(), $id_comprador, $libro->getId(), '', '');

    $compraventa_insertada = RepositorioCompraVenta:: insertar_compraventa(Conexion:: getConexion(), $compraventa);

    if ($compraventa_insertada) {
        RepositorioLibro::desactivar_libro(Conexion:: getConexion(), $libro->getId());
        ?>
        <script type="text/javascript">
            alert("Se ha registrado tu compra.");
        </script>
        <?php
    }
    Conexion::cerrar_conexion();
}
?>
    <div class="container is-max-desktop">
        <div class="row">
            <div class="col-md-8">
                <div class="panel">
                    <p class="panel-heading">
                        Imagenes
                    </p>

                    <div class="containerimgselect">
                        <figure class="image is-64x64">
                            <img class="imgselect" src="<?php echo RUTA_UPLOADS ?><?php echo $libro->getImg1() ?>"
                                 onclick="image(this)">
                        </figure>
                        <figure class="image is-64x64">
                            <img class="imgselect" src="<?php echo RUTA_UPLOADS ?><?php echo $libro->getImg2() ?>"
                                 onclick="image(this)">
                        </figure>
                        <figure class="image is-64x64">
                            <img class="imgselect" src="<?php echo RUTA_UPLOADS ?><?php echo $libro->getImg3() ?>"
                                 onclick="image(this)">
                        </figure>
                    </div>
                    <div class="columns is-mobile is-centered imagen">
                        <div class="column">
                            <figure id="zoom" class="image is-square zoom"
                                    style='background-image: url(<?php echo RUTA_UPLOADS ?><?php echo $libro->getImg1() ?>)'
                                    onmousemove='zoom(event)'>
                                <img id="img" class="img imgzoom"
                                     src="<?php echo RUTA_UPLOADS ?><?php echo $libro->getImg1() ?>" width="500"
                                     height="500">
                            </figure>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <p class="panel-heading">
                                Información del libro
                            </p>
                            <div class="panel-block">
                                <p><strong>Título: </strong><?php echo $libro->getTitulo() ?></p>
                            </div>
                            <div class="panel-block">
                                <p><strong>Autor: </strong><?php echo $libro->getAutor() ?></p>
                            </div>
                            <div class="panel-block">
                                <p><strong>Editorial: </strong><?php echo $libro->getEditorial() ?></p>
                            </div>
                            <div class="panel-block">
                                <p><strong>Edición: </strong><?php echo $libro->getEdicion() ?></p>
                            </div>
                            <div class="panel-block">
                                <p><strong>Año: </strong><?php echo $libro->getYearPublicacion() ?></p>
                            </div>
                            <div class="panel-block">
                                <p><strong>ISBN: </strong><?php echo $libro->getIsbn() ?></p>
                            </div>
                            <div class="panel-block">
                                <p><strong>ISSN: </strong><?php echo $libro->getIssn() ?></p>
                            </div>
                            <div class="panel-block">
                                <p><strong>Estado: </strong></p>
                                <progress class="progress is-primary" value="<?php echo $libro->getCalidad() ?>"
                                          max="100"><?php echo $libro->getCalidad() ?></progress>
                            </div>
                            <div class="panel-block">
                                <p>
                                    <strong>Vendedor: </strong><?php echo $vendedor->getNombre() ?> <?php echo $vendedor->getApellido() ?>
                                </p>
                            </div>
                            <div class="panel-block">
                                <p>
                                    <strong>Precio: </strong>$<?php echo number_format(intval($libro->getPrecio()), 0, ",", ".") ?>
                                </p>
                            </div>
                            <div class="panel-block">
                                <button class="button is-light is-fullwidth" onclick="show_modal()">Comprar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title"><strong>Confirmación</strong></p>
                </header>
                <section class="modal-card-body">
                    <p>¿Deseas confirmar la compra del libro <strong><?php echo $libro->getTitulo() ?></strong>?</p>
                    <p>El método de pago es contra entrega.</p>
                </section>
                <footer class="modal-card-foot">
                    <form role="form" method="post" action="<?php echo RUTA_LIBRO . '/' . $libro->getId() ?>">
                        <button class="button is-success" name="confirmar">Confirmar compra</button>
                        <button class="button is-light" onclick="hide_modal()">Cancelar</button>
                    </form>
                </footer>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function show_modal() {
            document.getElementById("modal").classList.add("is-active");
        }

        function hide_modal() {
            document.getElementById("modal").classList.remove("is-active");
        }
    </script>
    <script type="text/javascript">
        function image(img) {
            var src = img.src;
            var src2 = "url(";
            var src3 = src2.concat('', src);
            src3 = src3.concat('', ')');
            document.getElementById("img").src = src;
            document.getElementById("zoom").style.backgroundImage = src3;
        }
    </script>
    <script type="text/javascript">
        var list = document.getElementsByClassName("progress");
        var valor;
        var j = 1;
        var h;
        for (var i = 0; i < list.length; i++) {
            h = 'barra' + j;
            list[i].id = h;
            valor = document.getElementById(h).value;
            if (valor >= 0 && valor < (100 / 3)) {
                document.getElementById(h).classList.remove("is-primary");
                document.getElementById(h).classList.add("is-danger");
            } else if (valor > (100 / 3) && valor < ((100 / 3) + (100 / 3))) {
                document.getElementById(h).classList.remove("is-primary");
                document.getElementById(h).classList.add("is-warning");
            } else if (valor > ((100 / 3) + (100 / 3)) && valor <= 100) {
                document.getElementById(h).classList.remove("is-primary");
                document.getElementById(h).classList.add("is-success");
            }
            j++;
        }
    </script>
    <script type="text/javascript">
        function zoom(e) {
            var zoomer = e.currentTarget;
            e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
            e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
            x = offsetX / zoomer.offsetWidth * 100
            y = offsetY / zoomer.offsetHeight * 100
            zoomer.style.backgroundPosition = x + '% ' + y + '%';
        }

        document.addEventListener('dragstart', function (evt) {
            if (evt.target.tagName == 'IMG') {
                evt.preventDefault();
            }
        });
    </script>
<?php
include_once 'plantilla/documento-cierre.inc.php';
?>