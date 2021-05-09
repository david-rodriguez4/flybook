<?php
include_once 'app/RepositorioLibro.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/Libro.inc.php';
include_once 'app/Usuario.inc.php';
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

        $compra = RepositorioCompraVenta::obtener_compra_id_vendedor_id_libro(Conexion::getConexion(), $_SESSION['id'], $libro->getId());
        $cliente = RepositorioUsuario::getUsuarioId(Conexion::getConexion(), $compra->getIdComprador());

        if ($compra == null) {
            $estado = "Listo";
        } else {
            if ($compra->getEstado() == 0) {
                $estado = "Publicado";
            } elseif ($compra->getEstado() == 1) {
                $estado = "Pagado";
            } elseif ($compra->getEstado() == 2) {
                $estado = "Enviado";
            }
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
            <td><?php echo $estado ?></td>
            <td class="gestionar">
                <a href="<?php echo RUTA_EDITAR . '/' . $libro->getId() ?>">Editar</a>
                <a onclick="show_modal()">Eliminar</a>
                <?php
                if ($estado == "Pagado") {
                    ?>
                    <a onclick="show_modal_ver()">Ver</a>
                    <?php
                }
                ?>
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
        <div class="modal" id="ver">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title"><strong>Información del cliente</strong></p>
                </header>
                <section class="modal-card-body">
                    <p id="nombre"></p>
                    <p id="documento"></p>
                    <p id="email"></p>
                    <p id="numero"></p>
                    <p id="direccion"></p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-light" onclick="hide_modal_ver()">Cerrar</button>
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

            function show_modal_ver() {
                document.getElementById("ver").classList.add("is-active");
                document.getElementById("nombre").innerHTML = "<b>Nombre: </b><?php echo $cliente->getNombre() ?>";
                document.getElementById("documento").innerHTML = "<b>Documento de identidad: </b><?php echo $cliente->getDocumento() ?>";
                document.getElementById("email").innerHTML = "<b>Correo electrónico: </b><?php echo $cliente->getEmail() ?>";
                document.getElementById("numero").innerHTML = "<b>Teléfono: </b><?php echo $cliente->getTelefono() ?>";
                document.getElementById("direccion").innerHTML = "<b>Dirección: </b><?php echo $cliente->getDireccion() ?>";

            }

            function hide_modal_ver() {
                document.getElementById("ver").classList.remove("is-active");
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
        if ($compra->getEstado() == 1) {
            $estado = "Pagado";
        } elseif ($compra->getEstado() == 2) {
            $estado = "Enviado";
        }

        ?>
        <tr class="trbody">
            <td><?php echo $libro->getTitulo() ?></td>
            <td>$<?php echo number_format(intval($libro->getPrecio()), 0, ",", ".") ?></td>
            <td><?php if ($compra->getEstado() == 3) {
                    echo $estado; ?>
                    <a>Ver</a>
                    <?php
                } else {
                    echo $estado;
                } ?></td>
            <td><?php echo $compra->getFechaPago() ?></td>
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
        <option value="<?php echo $compra->getId() ?>"><?php echo $libro->getTitulo() ?>
            - <?php echo $libro->getAutor() ?> -
            $<?php echo number_format(intval($libro->getPrecio()), 0, ",", ".") ?></option>
        <?php
    }

    public static function libros_por_enviar()
    {
        Conexion::abrir_conexion();
        $ventas = RepositorioCompraVenta::obtener_compras_id_vendedor_enviar(Conexion::getConexion(), $_SESSION['id']);
        if (count($ventas)) {
            foreach ($ventas as $venta) {
                $libro = RepositorioLibro::obtener_libro_compras_por_id(Conexion::getConexion(), $venta->getIdLibro());
                self::escribir_por_enviar($libro, $venta);
            }
        }
    }

    public static function escribir_por_enviar($libro, $venta)
    {
        if (!isset($libro)) {
            return;
        }
        echo $_SESSION['id'];
        ?>
        <option value="<?php echo $venta->getId() ?>"><?php echo $libro->getTitulo() ?>
            - <?php echo $libro->getAutor() ?> -
            $<?php echo number_format(intval($libro->getPrecio()), 0, ",", ".") ?></option>
        <?php
    }

}

?>
