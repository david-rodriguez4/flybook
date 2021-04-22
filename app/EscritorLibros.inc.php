<?php
include_once 'app/RepositorioLibro.inc.php';
include_once 'app/Libro.inc.php';
include_once 'app/RepositorioCompraVenta.inc.php';
include_once 'app/CompraVenta.inc.php';

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
        if (!isset($libro)) {
            return;
        }

        if ($libro->getActivo() == 1) {
            $vendido = "No";
        } else {
            $vendido = "Si";
        }
        ?>
        <tr>
            <td><?php echo $libro->getTitulo() ?></td>
            <td>$<?php echo number_format(intval($libro->getPrecio()), 0, ",", ".") ?></td>
            <td><?php echo $libro->getFechaSubida() ?></td>
            <td><?php echo $vendido ?></td>
        </tr>
        <?php
    }

    public static function escribir_mis_compras()
    {
        $compras = RepositorioCompraVenta::obtener_compras_id_comprador(Conexion::getConexion(), $_SESSION['id']);
        if (count($compras)){
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
        <tr>
            <td><?php echo $libro->getTitulo() ?></td>
            <td>$<?php echo number_format(intval($libro->getPrecio()), 0, ",", ".") ?></td>
            <td><?php echo $compra->getFechaCompra() ?></td>
        </tr>
        <?php
    }

}

?>
