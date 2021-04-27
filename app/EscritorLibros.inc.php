<?php
include_once 'app/RepositorioLibro.inc.php';
include_once 'app/Libro.inc.php';
include_once 'app/RepositorioCompraVenta.inc.php';
include_once 'app/CompraVenta.inc.php';
include_once 'app/Redireccion.inc.php';

class EscritorLibros
{
    public static function escribir_libros()
    {
        $libros = RepositorioLibro::obtener_todas_por_fecha_descendiente(Conexion::getConexion());
        if (count($libros)) {
            foreach ($libros as $libro) {
                self::escribir_libro($libro);
            }
        }
    }

    public static function escribir_libros_busqueda_titulo_autor($busqueda)
    {
        $libros = RepositorioLibro::obtener_libro_titulo_autor(Conexion::getConexion(), $busqueda);
        if (count($libros)) {
            foreach ($libros as $libro) {
                self::escribir_libro($libro);
            }
        } else {
            ?>
            <div class="panel-block">
                <h1>No hay resultados</h1>
            </div>
            <?php
        }
    }

    public static function escribir_libro($libro)
    {
        if (!isset($libro)) {
            return;
        }
        ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-image">
                    <figure class="image is-4by3 image-box">
                        <img src="<?php echo RUTA_UPLOADS ?><?php echo $libro->getImg1() ?>" alt="Img1">
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-content">
                            <p class="title is-6"><?php echo $libro->getTitulo() ?></p>
                            <p class="subtitle is-6"><?php echo $libro->getAutor() ?></p>
                        </div>
                    </div>
                    <div class="content">
                        <progress class="progress is-primary" value="<?php echo $libro->getCalidad() ?>"
                                  max="100"><?php echo $libro->getCalidad() ?></progress>
                        <p class="title is-6">
                            $<?php echo number_format(intval($libro->getPrecio()), 0, ",", "."); ?></p>
                        <a href="<?php echo RUTA_LIBRO . '/' . $libro->getId() ?>" class="button is-light is-fullwidth">Ver
                            más</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function escribir_mis_publicaciones()
    {
        $libros = RepositorioLibro::obtener_id_vendedor(Conexion::getConexion(), $_SESSION['id']);
        if (count($libros)) {
            foreach ($libros as $libro) {
                self::escribir_mi_publicacion($libro);
            }
        }
    }

    public static function escribir_mi_publicacion($libro)
    {
        Conexion::abrir_conexion();
        if (!isset($libro)) {
            return;
        }

        if ($libro->getActivo() == 1) {
            $vendido = "No";
        } else {
            $vendido = "Si";
        }

        if (isset($_POST[$libro->getId()])) {
            RepositorioLibro::eliminar_libro(Conexion::getConexion(), $libro->getId());
            unlink(getcwd() . "/uploads/" . $libro->getImg1());
            unlink(getcwd() . "/uploads/" . $libro->getImg2());
            unlink(getcwd() . "/uploads/" . $libro->getImg3());
            Redireccion::redirigir(RUTA_PUBLICACIONES);
        }

        ?>
        <tr class="trbody">
            <td><?php echo $libro->getTitulo() ?></td>
            <td>$<?php echo number_format(intval($libro->getPrecio()), 0, ",", ".") ?></td>
            <td><?php echo $vendido ?></td>
            <td class="gestionar">
                <button name="editar">Editar</button>
                <button onclick="show_modal()">Eliminar</button>
            </td>
        </tr>
        <div class="modal" id="borrar">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title"><strong>Eliminar</strong></p>
                </header>
                <section class="modal-card-body">
                    <p>¿Deseas eliminar el libro <strong><?php echo $libro->getTitulo() ?></strong>?</p>
                </section>
                <footer class="modal-card-foot">
                    <form role="form" method="post" action="<?php echo RUTA_PUBLICACIONES ?>">
                        <button class="button is-success" name="<?php echo $libro->getId() ?>">Eliminar</button>
                    </form>
                    <button class="button is-light" onclick="hide_modal()">Cancelar</button>
                </footer>
            </div>
        </div>
        <script type="text/javascript">
            function show_modal() {
                document.getElementById("borrar").classList.add("is-active");
            }

            function hide_modal() {
                document.getElementById("borrar").classList.remove("is-active");
            }
        </script>
        <?php
        Conexion::cerrar_conexion();
    }

    public static function escribir_mis_compras()
    {
        $compras = RepositorioCompraVenta::obtener_compras_id_comprador(Conexion::getConexion(), $_SESSION['id']);
        if (count($compras)) {
            foreach ($compras as $compra) {
                $libro = RepositorioLibro::obtener_libro_compras_por_id(Conexion::getConexion(), $compra->getIdLibro());
                self::escribir_mi_compra($libro, $compra);
            }
        }
    }

    public static function escribir_mi_compra($libro, $compra)
    {
        if (!isset($libro)) {
            return;
        }
        ?>
        <tr class="trbody">
            <td><?php echo $libro->getTitulo() ?></td>
            <td>$<?php echo number_format(intval($libro->getPrecio()), 0, ",", ".") ?></td>
            <td><?php echo $compra->getFechaCompra() ?></td>
        </tr>
        <?php
    }

    public static function libros_por_comprar()
    {
        $compras = RepositorioCompraVenta::obtener_compras_id_comprador_pagar(Conexion::getConexion(), $_SESSION['id']);
        if (count($compras)) {
            foreach ($compras as $compra) {
                $libro = RepositorioLibro::obtener_libro_compras_por_id(Conexion::getConexion(), $compra->getIdLibro());
                self::escribir_por_comprar($libro, $compra);
            }
        }
    }

    public static function escribir_por_comprar($libro, $compra)
    {
        if (!isset($libro)) {
            return;
        }
        ?>
        <option value="<?php echo $compra->getId() ?>"><?php echo $libro->getTitulo() ?> - <?php echo $libro->getAutor() ?></option>
        <?php
    }

}

?>
