<?php
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/EscritorLibros.inc.php';

include_once 'plantilla/documento-declaracion.inc.php';
include_once 'plantilla/navbar.inc.php';
?>

    <div class="container">
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child notification navbar-brand">
                    <h1 class="title"><b>Flybook</b><img src="<?php echo RUTA_IMG ?>logo.png" width="50"
                                                         height="37">
                    </h1>
                    <p class="subtitle">Compra y venta de libros online</p>
                </article>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <p class="panel-heading">
                                Busqueda
                            </p>
                            <form role="form" method="post" action="<?php echo RUTA_BUSCAR ?>">
                                <div class="panel-block">
                                    <p class="control has-icons-left">
                                        <input class="input" type="search" name="busqueda" required
                                               placeholder="¿Qué libro buscas?">
                                        <span class="icon is-left">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </span>
                                    </p>
                                    <button class="button is-light" type="submit" name="buscar">Buscar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                        Últimos añadidos
                    </div>
                    <div class="row">
                        <?php
                        EscritorLibros::escribir_libros();
                        ?>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="content has-text-centered">
            <p><b>Flybook</b> por David Rodríguez y Daniel Alarcón. The source code is licensed
                <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
                is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
            </p>
        </div>
    </footer>
<?php
include_once 'plantilla/documento-cierre.inc.php';
?>