<?php
include_once 'app/EscritorLibros.inc.php';
include_once 'plantilla/documento-declaracion.inc.php';
include_once 'plantilla/navbar.inc.php';
?>

<div class="container is-max-desktop">
    <div class="columns is-mobile is-centered">
        <div class="column">
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
    <div class="columns is-mobile is-centered resbusc">
        <div class="column">
            <div class="panel">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    Resultados de busqueda
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