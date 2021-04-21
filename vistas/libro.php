<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/Libro.inc.php';
include_once 'app/RepositorioLibro.inc.php';
include_once 'app/RepositorioUsuario.inc.php';

include_once 'plantilla/documento-declaracion.inc.php';
include_once 'plantilla/navbar.inc.php';
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
                        <figure id="zoom" class="image is-square zoom" style='background-image: url(<?php echo RUTA_UPLOADS ?><?php echo $libro->getImg1() ?>)' onmousemove='zoom(event)'>
                            <img id="img" class="img imgzoom" src="<?php echo RUTA_UPLOADS ?><?php echo $libro->getImg1() ?>" width="500" height="500">
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
                                <p><strong>Editorial: </strong><?php echo $libro->getEditor() ?></p>
                            </div>
                            <div class="panel-block">
                                <p><strong>Año: </strong><?php echo $libro->getFechaPublicacion() ?></p>
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
                                <p><strong>Vendedor: </strong><?php echo $vendedor->getNombre() ?> <?php echo $vendedor->getApellido() ?></p>
                            </div>
                            <div class="panel-block">
                                <p>
                                    <strong>Precio: </strong>$<?php echo number_format(intval($libro->getPrecio()), 0, ",", ".") ?>
                                </p>
                            </div>
                            <div class="panel-block">
                                <a href="<?php echo RUTA_LIBRO . '/' . $libro->getId() ?>" class="button is-light is-fullwidth">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            if (valor >= 0 && valor < (100/3)) {
                document.getElementById(h).classList.remove("is-primary");
                document.getElementById(h).classList.add("is-danger");
            } else if (valor > (100/3) && valor < ((100/3)+(100/3))) {
                document.getElementById(h).classList.remove("is-primary");
                document.getElementById(h).classList.add("is-warning");
            } else if (valor > ((100/3)+(100/3)) && valor <= 100) {
                document.getElementById(h).classList.remove("is-primary");
                document.getElementById(h).classList.add("is-success");
            }
            j++;
        }
    </script>
    <script type="text/javascript">
        function zoom(e){
            var zoomer = e.currentTarget;
            e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
            e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
            x = offsetX/zoomer.offsetWidth*100
            y = offsetY/zoomer.offsetHeight*100
            zoomer.style.backgroundPosition = x + '% ' + y + '%';
        }
        document.addEventListener('dragstart', function(evt) {
            if (evt.target.tagName == 'IMG') {
                evt.preventDefault();
            }
        });
    </script>
<?php
include_once 'plantilla/documento-cierre.inc.php';
?>